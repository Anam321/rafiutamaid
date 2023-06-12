<html lang="en">

<head>
    <title><?= $judul ?></title>

    <meta name="google-site-verification" content="rW4W4gUvwTUf6V2erznO1nAvkUqhVoB7p4m3igIWyC8" />

    <meta charset="utf-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="<?= $deskripsi ?>" />



    <link rel="canonical" href="https://bengkellasmutiara.com/" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $judul ?>" />
    <meta property="og:description" content="<?= $deskripsi ?>" />
    <meta property="og:url" content="<?= $url ?>" />
    <meta property="og:site_name" content="<?= $company_name ?>" />
    <meta property="article:modified_time" content="2021-08-31T02:05:21+00:00" />

    <meta name="author" content="<?= $company_name ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:label1" content="Estimasi waktu membaca" />
    <meta name="twitter:data1" content="8 menit" />
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="<?= base_url() ?>assets/upload/logo/<?= $logo ?>"> -->


    <link href="<?= base_url() ?>assets/upload/logo/<?= $logo ?>" rel="icon">
    <link href="<?= base_url() ?>assets/upload/logo/<?= $logo ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/frontend/css/main.css" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style>
        .note-editor .dropdown-toggle::after {
            all: unset;

        }

        .note-editor .note-dropdown-menu {
            box-sizing: content-box;
        }

        .note-editor .note-modal-footer {
            box-sizing: content-box;
        }


        .cs-demo-switcher {
            position: fixed;
            display: block;
            top: 50%;
            right: 1rem;
            z-index: 100;
        }

        .cs-demo-switcher-inner {
            width: 3rem;
            height: 3rem;
            border: 1px solid #e5e8ed;
            border-radius: 50%;
            background-color: #fff;
            color: #1e212c;
            font-size: 1.25rem;
            line-height: 3rem;
            text-align: center;
            text-decoration: none;
            box-shadow: 0px 10px 15px 0px rgba(30, 33, 44, 0.10);
        }
    </style>


    <script type="application/ld+json">
        {
            "name": "Bengkel Las tralis canopi Mutiara",
            "description": "Bengkel Las Handal Melayani Pembuatan Pagar Rumah, Kanopi, Railling Tangga, Balkon, Teralis, Stainless, Kontruksi Baja, gorden, folding gate, dll. Kontruksi Bangunan Di Jakarta, Bogor, Depok, Tangerang gratis survey dan konsultasi 100%",
            "author": {
                "@type": "Person",
                "name": "Bengkel Las tralis canopi"
            },
            "@type": "WebSite",
            "url": "https://bengkellasmutiara.com/",
            "headline": "Bengkel las kanopi",
            "@context": "http://schema.org"
        }
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RJ887LVP6N"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-RJ887LVP6N');
    </script>

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQH378Q" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <a onclick="whatsappTracking()" href="https://api.whatsapp.com/send?phone=+62<?= $whatsap ?>&text=Halo%20<?= $perusahaan ?>%20Mohon%20informasi%20produk%20produk%20dan%20pemesanan" target="_blank" class="cs-demo-switcher">
        <div class="cs-demo-switcher-inner bg-warning" data-toggle="tooltip" data-placement="left" title="Hubungi ahh..">
            <img src="<?= base_url('assets/frontend/iconwa.png'); ?>" alt="">
        </div>
    </a>

    <script>
        function whatsappTracking() {
            $.ajax({
                url: "<?php echo site_url('home/whatsappTracking') ?>",
                type: "POST",
            });

        }
    </script>