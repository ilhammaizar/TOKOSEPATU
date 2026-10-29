<?php
require_once __DIR__ . '/service/auth.php';
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Temukan sneakers pilihan untuk menemani setiap langkahmu di StoreSter."
    />
    <title>StoreSter — Sneakers untuk Setiap Langkah</title>
    <link rel="stylesheet" href="layout/style.css" />
  </head>
  <body>
    <header class="site-header">
      <div class="header-inner">
        <a class="brand" href="#home" aria-label="StoreSter, kembali ke beranda">
          <span class="brand-mark" aria-hidden="true">S</span>
          <span>storester<span class="brand-period">.</span></span>
        </a>

        <nav aria-label="Navigasi utama">
          <ul class="nav-links">
            <li><a class="nav-link is-current" href="#home">Beranda</a></li>
            <li><a class="nav-link" href="#produk">Koleksi</a></li>
            <li><a class="nav-link" href="layout/kontak.html">Kontak</a></li>
          </ul>
        </nav>

        <div class="header-actions">
          <?php if (isset($_SESSION['user'])): ?>
          <span class="header-user">Hai, <?= h($_SESSION['user']) ?></span>
          <form class="header-logout" action="logout.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>" />
            <button class="header-login" type="submit">Keluar</button>
          </form>
          <?php else: ?>
          <a class="header-login" href="login.php">Masuk</a>
          <a class="header-register" href="registrasi.php">Daftar</a>
          <?php endif; ?>
          <a class="cart-link" href="layout/keranjang.php">
            <span class="cart-icon" aria-hidden="true">+</span>
            Keranjang
          </a>
        </div>
      </div>
    </header>

    <main>
      <section class="hero" id="home" aria-labelledby="hero-title">
        <div class="hero-copy">
          <p class="eyebrow"><span></span> Langkah baru dimulai di sini</p>
          <h1 id="hero-title">Temukan langkah <em>terbaikmu.</em></h1>
          <p class="hero-description">
            Sneakers pilihan dengan desain ikonik dan kenyamanan yang pas
            untuk menemani harimu.
          </p>
          <div class="hero-actions">
            <a class="button button-primary" href="#produk">
              Jelajahi koleksi <span aria-hidden="true">→</span>
            </a>
            <a class="text-link" href="layout/kontak.html">Butuh bantuan?</a>
          </div>
          <div class="hero-note">
            <span class="note-line" aria-hidden="true"></span>
            Pilihan gaya, kualitas yang terasa.
          </div>
        </div>

        <div class="hero-visual">
          <div class="visual-label">
            <span class="label-dot" aria-hidden="true"></span>
            Pilihan minggu ini
          </div>
          <img
            src="layout/sepatu01.jpg"
            alt="Nike Air Force 1 07 LX dengan warna hijau, biru, dan aksen emas"
          />
          <div class="hero-product">
            <div>
              <p class="product-kicker">Nike · Air Force</p>
              <p class="hero-product-name">Air Force 1 07 LX</p>
            </div>
            <a href="#produk" aria-label="Lihat koleksi sepatu">↗</a>
          </div>
          <span class="visual-index" aria-hidden="true">01 / 04</span>
        </div>
      </section>

      <section class="collection section-wrap" id="produk" aria-labelledby="collection-title">
        <div class="section-heading">
          <div>
            <p class="eyebrow"><span></span> Kurasi StoreSter</p>
            <h2 id="collection-title">Temukan favoritmu<span>.</span></h2>
          </div>
          <p class="section-description">
            Empat pilihan ikonik, siap menemani langkahmu ke mana saja.
          </p>
        </div>

        <div class="product-grid">
          <article class="product-card">
            <a class="product-image" href="layout/kontak.html" aria-label="Tanya tentang Nike Air Force 1 07 LX">
              <span class="product-tag">Pilihan populer</span>
              <img
                src="layout/sepatu01.jpg"
                alt="Nike Air Force 1 07 LX berwarna hijau, biru, dan emas"
                loading="lazy"
              />
              <span class="image-arrow" aria-hidden="true">↗</span>
            </a>
            <div class="product-info">
              <div>
                <p class="product-brand">NIKE</p>
                <h3>Air Force 1 07 LX</h3>
              </div>
              <p class="product-price">Rp 1.699.000</p>
            </div>
            <a class="product-action" href="layout/kontak.html">Tanya produk <span aria-hidden="true">→</span></a>
          </article>

          <article class="product-card">
            <a class="product-image" href="layout/kontak.html" aria-label="Tanya tentang Nike Cortez">
              <img
                src="layout/sepatu02.jpg"
                alt="Nike Cortez putih dengan logo hijau"
                loading="lazy"
              />
              <span class="image-arrow" aria-hidden="true">↗</span>
            </a>
            <div class="product-info">
              <div>
                <p class="product-brand">NIKE</p>
                <h3>Cortez</h3>
              </div>
              <p class="product-price">Rp 1.199.000</p>
            </div>
            <a class="product-action" href="layout/kontak.html">Tanya produk <span aria-hidden="true">→</span></a>
          </article>

          <article class="product-card">
            <a class="product-image" href="layout/kontak.html" aria-label="Tanya tentang Adidas Stan Smith">
              <img
                src="layout/sepatu3.jpg"
                alt="Adidas Stan Smith putih dengan aksen biru"
                loading="lazy"
              />
              <span class="image-arrow" aria-hidden="true">↗</span>
            </a>
            <div class="product-info">
              <div>
                <p class="product-brand">ADIDAS</p>
                <h3>Stan Smith</h3>
              </div>
              <p class="product-price">Rp 1.599.000</p>
            </div>
            <a class="product-action" href="layout/kontak.html">Tanya produk <span aria-hidden="true">→</span></a>
          </article>

          <article class="product-card">
            <a class="product-image" href="layout/kontak.html" aria-label="Tanya tentang Adidas Rivalry 86">
              <span class="product-tag product-tag-muted">Gaya klasik</span>
              <img
                src="layout/sepatu4.jpg"
                alt="Adidas Rivalry 86 putih dengan aksen cokelat dan merah"
                loading="lazy"
              />
              <span class="image-arrow" aria-hidden="true">↗</span>
            </a>
            <div class="product-info">
              <div>
                <p class="product-brand">ADIDAS</p>
                <h3>Rivalry 86</h3>
              </div>
              <p class="product-price">Rp 1.799.000</p>
            </div>
            <a class="product-action" href="layout/kontak.html">Tanya produk <span aria-hidden="true">→</span></a>
          </article>
        </div>
      </section>

      <section class="contact-strip" aria-labelledby="contact-title">
        <div>
          <p class="eyebrow"><span></span> Kami siap membantu</p>
          <h2 id="contact-title">Ada yang ingin ditanyakan?</h2>
          <p>Hubungi kami untuk informasi produk dan pemesanan.</p>
        </div>
        <a class="button button-light" href="layout/kontak.html">
          Hubungi StoreSter <span aria-hidden="true">→</span>
        </a>
      </section>
    </main>

    <footer class="site-footer">
      <a class="brand footer-brand" href="#home">
        <span class="brand-mark" aria-hidden="true">S</span>
        <span>storester<span class="brand-period">.</span></span>
      </a>
      <p>Temukan langkah terbaikmu.</p>
      <span>© 2026 StoreSter</span>
    </footer>
  </body>
</html>
