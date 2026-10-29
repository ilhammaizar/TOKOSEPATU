<?php
require_once __DIR__ . '/../service/auth.php';
require_login('layout/keranjang.php');
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Periksa pilihan sneakers di keranjang StoreSter." />
    <title>Keranjang — StoreSter</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="keranjang.css" />
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
          <a class="cart-link" href="keranjang.php" aria-current="page">
            <span class="cart-icon" aria-hidden="true">+</span>
            Keranjang
          </a>
        </div>
      </div>
    </header>

    <main class="page-main">
      <section class="page-shell cart-page" aria-labelledby="cart-title">
        <div class="page-intro">
          <p class="eyebrow"><span></span> Hampir jadi milikmu</p>
          <h1 id="cart-title">Keranjang belanja</h1>
          <p>Periksa kembali pilihanmu sebelum melanjutkan.</p>
        </div>

        <div class="cart-layout">
          <div class="cart-panel">
            <p class="panel-kicker">Pilihanmu <span>01 item</span></p>
            <article class="cart-item">
              <div class="cart-product-image">
                <img src="sepatu01.jpg" alt="Nike Air Force 1 07 LX" />
              </div>
              <div class="cart-item-details">
                <p class="product-brand">NIKE</p>
                <h2>Air Force 1 07 LX</h2>
                <p class="cart-item-note">Warna pilihan · Stok dapat dikonfirmasi</p>
                <p class="cart-item-price">Rp 1.699.000</p>
              </div>
            </article>
            <a class="back-link" href="../index.php#produk">← Lanjut belanja</a>
          </div>

          <aside class="order-summary" aria-labelledby="summary-title">
            <h2 id="summary-title">Ringkasan pesanan</h2>
            <div class="summary-row">
              <span>Subtotal</span>
              <span>Rp 1.699.000</span>
            </div>
            <div class="summary-row summary-muted">
              <span>Pengiriman</span>
              <span>Dikonfirmasi saat pemesanan</span>
            </div>
            <div class="summary-total">
              <span>Total sementara</span>
              <strong>Rp 1.699.000</strong>
            </div>
            <a href="pembayaran.php" class="button button-primary checkout-button">
              Lanjut ke pembayaran <span aria-hidden="true">→</span>
            </a>
            <p class="summary-note">
              Biaya pengiriman dan ketersediaan akan dikonfirmasi oleh tim kami.
            </p>
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
