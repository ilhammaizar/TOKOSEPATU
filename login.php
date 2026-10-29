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
    } elseif ($username === '' || strlen($username) > 32 || !is_string($password) || $password === '' || strlen($password) > 72) {
        $error = 'Username atau password tidak sesuai.';
    } else {
        try {
            require_once __DIR__ . '/service/koneksi.php';

            $statement = $db->prepare('SELECT username, password FROM users WHERE username = ? LIMIT 1');
            $statement->bind_param('s', $username);
            $statement->execute();
            $user = $statement->get_result()->fetch_assoc();

            $passwordIsValid = $user && password_verify($password, $user['password']);
            if ($user && !$passwordIsValid && password_get_info($user['password'])['algo'] === null) {
                $passwordIsValid = hash_equals($user['password'], $password);

                if ($passwordIsValid) {
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $upgrade = $db->prepare('UPDATE users SET password = ? WHERE username = ?');
                    $upgrade->bind_param('ss', $newHash, $username);
                    $upgrade->execute();
                }
            }

            if ($passwordIsValid) {
                session_regenerate_id(true);
                $_SESSION['user'] = $user['username'];
                unset($_SESSION['csrf_token']);

                $returnTo = $_SESSION['redirect_after_login'] ?? 'index.php';
                unset($_SESSION['redirect_after_login']);
                $allowedDestinations = ['index.php', 'layout/keranjang.php', 'layout/pembayaran.php'];
                if (!in_array($returnTo, $allowedDestinations, true)) {
                    $returnTo = 'index.php';
                }

                header('Location: ' . $returnTo);
                exit;
            }

            $error = 'Username atau password tidak sesuai.';
        } catch (Throwable $exception) {
            error_log('Login failed: ' . $exception->getMessage());
            $error = 'Layanan masuk sedang bermasalah. Silakan coba beberapa saat lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Masuk ke akun StoreSter." />
    <title>Masuk — StoreSter</title>
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
          <a class="header-login" href="login.php" aria-current="page">Masuk</a>
          <a class="header-register" href="registrasi.php">Daftar</a>
          <a class="cart-link" href="layout/keranjang.php">
            <span class="cart-icon" aria-hidden="true">+</span>
            Keranjang
          </a>
        </div>
      </div>
    </header>

    <main class="account-main">
      <section class="account-card" aria-labelledby="account-title">
        <p class="eyebrow"><span></span> Senang melihatmu kembali</p>
        <h1 id="account-title">Masuk akun</h1>
        <p class="account-description">
          Masuk untuk melanjutkan pengalaman belanjamu di StoreSter.
        </p>
        <?php if ($error !== ''): ?>
          <p class="account-alert" role="alert"><?= h($error) ?></p>
        <?php endif; ?>
        <form class="account-form" action="login.php" method="POST">
          <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>" />
          <label for="username">Username</label>
          <input id="username" type="text" placeholder="Masukkan username" name="username" autocomplete="username" maxlength="32" required value="<?= h($username) ?>" />

          <label for="password">Password</label>
          <input id="password" type="password" placeholder="Masukkan password" name="password" autocomplete="current-password" maxlength="72" required />

          <button class="button button-primary account-submit" type="submit">
            Masuk sekarang <span aria-hidden="true">→</span>
          </button>
        </form>
        <p class="account-switch">
          Belum punya akun? <a href="registrasi.php">Buat akun</a>
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
