<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="<?= base_url() ?>assets/upload/logo/<?= $logo ?>" alt="">
            <!-- <h1>UpConstruction<span>.</span></h1> -->
        </a>
        <!-- <?= base_url() ?>assets/upload/logo/<?= $logo ?> -->
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="<?= base_url() ?>" class="active">Home</a></li>
                <li><a href="<?= base_url('about') ?>">Tentang</a></li>
                <li><a href="<?= base_url('jasa-layanan') ?>">Layanan</a></li>
                <li><a href="<?= base_url('portfolio') ?>">Portfolio</a></li>
                <li><a href="<?= base_url('berita') ?>">Berita</a></li>
                <li><a href="<?= base_url('kontak') ?>">Kontak</a></li>
            </ul>
        </nav><!-- .navbar -->

    </div>
</header>