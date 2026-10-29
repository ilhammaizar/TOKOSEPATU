<?php
require_once __DIR__ . '/../service/auth.php';
require_login('layout/pembayaran.php');
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Informasi cara melanjutkan pesanan StoreSter." />
    <title>Pembayaran — StoreSter</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="pembayaran.css" />
  </head>
  <body>
    <header class="site-header">
      <div class="header-inner">
        <a class="brand" href="../index.php" aria-label="StoreSter, kembali ke beranda">
          <span class="brand-mark" aria-hidden="true">S</span>
          <span>storester<span class="brand-period">.</span></span>
        </a>
        <nav aria-label="Navigasi utama">
          <ul class="nav-links">
            <li><a class="nav-link" href="../index.php#home">Beranda</a></li>
            <li><a class="nav-link" href="../index.php#produk">Koleksi</a></li>
            <li><a class="nav-link" href="kontak.html">Kontak</a></li>
          </ul>
        </nav>
        <div class="header-actions">
          <span class="header-user">Hai, <?= h($_SESSION['user']) ?></span>
          <form class="header-logout" action="../logout.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>" />
            <button class="header-login" type="submit">Keluar</button>
          </form>
          <a class="cart-link" href="keranjang.php">
            <span class="cart-icon" aria-hidden="true">+</span>
            Keranjang
          </a>
        </div>
      </div>
    </header>

    <main class="page-main">
      <section class="page-shell payment-page" aria-labelledby="payment-title">
        <div class="page-intro">
          <p class="eyebrow"><span></span> Langkah terakhir</p>
          <h1 id="payment-title">Konfirmasi pesanan.</h1>
          <p>
            Tim StoreSter akan membantu memastikan stok, ongkos kirim, dan
            metode pembayaran sebelum pesanan diproses.
          </p>
        </div>

        <div class="payment-layout">
          <section class="payment-panel" aria-labelledby="payment-methods-title">
            <p class="panel-kicker">01 <span>Proses pemesanan</span></p>
            <h2 id="payment-methods-title">Pembayaran dikonfirmasi bersama tim kami</h2>
            <p class="payment-copy">
              Saat ini pembayaran online belum tersedia. Hubungi kami untuk
              konfirmasi produk dan detail pembayaran yang aman.
            </p>
            <ul class="payment-methods">
              <li><span aria-hidden="true">01</span> Transfer bank</li>
              <li><span aria-hidden="true">02</span> Metode lain sesuai konfirmasi</li>
            </ul>
            <a class="button button-primary payment-contact" href="kontak.html">
              Hubungi StoreSter <span aria-hidden="true">→</span>
            </a>
            <p class="payment-safety">
              Jangan kirim kata sandi, PIN, atau nomor kartu melalui pesan.
            </p>
          </section>

          <aside class="payment-summary" aria-labelledby="payment-summary-title">
            <p class="panel-kicker">02 <span>Ringkasan</span></p>
            <h2 id="payment-summary-title">Pesananmu</h2>
            <div class="payment-product">
              <img src="sepatu01.jpg" alt="Nike Air Force 1 07 LX" />
              <div>
                <p class="product-brand">NIKE</p>
                <h3>Air Force 1 07 LX</h3>
                <p>1 item</p>
              </div>
            </div>
            <div class="payment-total">
              <span>Total sementara</span>
              <strong>Rp 1.699.000</strong>
            </div>
            <p class="payment-summary-note">
              Total akhir dapat berubah setelah ongkos kirim dan stok
              dikonfirmasi.
            </p>
            <a class="back-link" href="keranjang.php">← Kembali ke keranjang</a>
          </aside>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <a class="brand footer-brand" href="../index.php">
        <span class="brand-mark" aria-hidden="true">S</span>
        <span>storester<span class="brand-period">.</span></span>
      </a>
      <p>Temukan langkah terbaikmu.</p>
      <span>© 2026 StoreSter</span>
    </footer>
  </body>
</html>
