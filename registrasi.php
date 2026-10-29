<?php
require_once __DIR__ . '/service/auth.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedUsername = $_POST['username'] ?? '';
    $username = is_string($submittedUsername) ? trim($submittedUsername) : '';
    $password = $_POST['password'] ?? '';

    if (!valid_csrf_token($_POST['csrf_token'] ?? null)) {
        $error = 'Sesi formulir tidak valid. Muat ulang halaman dan coba lagi.';
    } elseif (!preg_match('/\A[a-zA-Z0-9_]{3,32}\z/', $username)) {
        $error = 'Username harus berisi 3–32 karakter: huruf, angka, atau garis bawah.';
    } elseif (!is_string($password) || strlen($password) < 8 || strlen($password) > 72) {
        $error = 'Password harus berisi minimal 8 karakter dan maksimal 72 byte.';
    } else {
        try {
            require_once __DIR__ . '/service/koneksi.php';

            $statement = $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $statement->bind_param('ss', $username, $passwordHash);
            $statement->execute();

            session_regenerate_id(true);
            $_SESSION['user'] = $username;
            unset($_SESSION['csrf_token']);

            $returnTo = $_SESSION['redirect_after_login'] ?? 'index.php';
            unset($_SESSION['redirect_after_login']);
            $allowedDestinations = ['index.php', 'layout/keranjang.php', 'layout/pembayaran.php'];
            if (!in_array($returnTo, $allowedDestinations, true)) {
                $returnTo = 'index.php';
            }

            header('Location: ' . $returnTo);
            exit;
        } catch (mysqli_sql_exception $exception) {
            if ($exception->getCode() === 1062) {
                $error = 'Username sudah digunakan. Silakan pilih username lain.';
            } else {
                error_log('Registration failed: ' . $exception->getMessage());
                $error = 'Layanan pendaftaran sedang bermasalah. Silakan coba beberapa saat lagi.';
            }
        } catch (Throwable $exception) {
            error_log('Registration failed: ' . $exception->getMessage());
            $error = 'Layanan pendaftaran sedang bermasalah. Silakan coba beberapa saat lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Buat akun StoreSter." />
    <title>Daftar — StoreSter</title>
    <link rel="stylesheet" href="layout/style.css" />
  </head>
  <body class="account-page">
    <header class="site-header">
      <div class="header-inner">
        <a class="brand" href="index.php" aria-label="StoreSter, kembali ke beranda">
          <span class="brand-mark" aria-hidden="true">S</span>
          <span>storester<span class="brand-period">.</span></span>
        </a>
        <nav aria-label="Navigasi utama">
          <ul class="nav-links">
            <li><a class="nav-link" href="index.php">Beranda</a></li>
            <li><a class="nav-link" href="index.php#produk">Koleksi</a></li>
            <li><a class="nav-link" href="layout/kontak.html">Kontak</a></li>
          </ul>
        </nav>
        <div class="header-actions">
          <a class="header-login" href="login.php">Masuk</a>
          <a class="header-register" href="registrasi.php" aria-current="page">Daftar</a>
          <a class="cart-link" href="layout/keranjang.php">
            <span class="cart-icon" aria-hidden="true">+</span>
            Keranjang
          </a>
        </div>
      </div>
    </header>

    <main class="account-main">
      <section class="account-card" aria-labelledby="account-title">
        <p class="eyebrow"><span></span> Mulai langkah barumu</p>
        <h1 id="account-title">Buat akun</h1>
        <p class="account-description">
          Daftar untuk menikmati pengalaman belanja yang lebih mudah.
        </p>
        <?php if ($error !== ''): ?>
          <p class="account-alert" role="alert"><?= h($error) ?></p>
        <?php endif; ?>
        <form class="account-form" action="registrasi.php" method="POST">
          <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>" />
          <label for="username">Username</label>
          <input id="username" type="text" placeholder="Pilih username" name="username" autocomplete="username" minlength="3" maxlength="32" pattern="[A-Za-z0-9_]{3,32}" title="Gunakan 3–32 karakter: huruf, angka, atau garis bawah." required value="<?= h($username) ?>" />

          <label for="password">Password</label>
          <input id="password" type="password" placeholder="Buat password (minimal 8 karakter)" name="password" autocomplete="new-password" minlength="8" maxlength="72" required />

          <button class="button button-primary account-submit" type="submit">
            Buat akun <span aria-hidden="true">→</span>
          </button>
        </form>
        <p class="account-switch">
          Sudah punya akun? <a href="login.php">Masuk</a>
        </p>
      </section>
    </main>

    <footer class="site-footer">
      <a class="brand footer-brand" href="index.php">
        <span class="brand-mark" aria-hidden="true">S</span>
        <span>storester<span class="brand-period">.</span></span>
      </a>
      <p>Temukan langkah terbaikmu.</p>
      <span>© 2026 StoreSter</span>
    </footer>
  </body>
</html>
