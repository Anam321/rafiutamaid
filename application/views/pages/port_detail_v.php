 <?php
    function waktu_lalu($timestamp)
    {
        $selisih = time() - strtotime($timestamp);
        $detik = $selisih;
        $menit = round($selisih / 60);
        $jam = round($selisih / 3600);
        $hari = round($selisih / 86400);
        $minggu = round($selisih / 604800);
        $bulan = round($selisih / 2419200);
        $tahun = round($selisih / 29030400);
        if ($detik <= 60) {
            $waktu = $detik . ' detik yang lalu';
        } else if ($menit <= 60) {
            $waktu = $menit . ' menit yang lalu';
        } else if ($jam <= 24) {
            $waktu = $jam . ' jam yang lalu';
        } else if ($hari <= 7) {
            $waktu = $hari . ' hari yang lalu';
        } else if ($minggu <= 4) {
            $waktu = $minggu . ' minggu yang lalu';
        } else if ($bulan <= 12) {
            $waktu = $bulan . ' bulan yang lalu';
        } else {
            $waktu = $tahun . ' tahun yang lalu';
        }
        return $waktu;
    }
    ?>


 <main id="main">
     <?php foreach ($produkbyslug as $port) : ?>
         <!-- ======= Breadcrumbs ======= -->
         <div class="breadcrumbs d-flex align-items-center" style="background-image: url('<?= base_url() ?>assets/frontend/img/projects/design-2.jpg');">
             <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                 <h2><?= $port->judul ?></h2>
                 <ol>
                     <li><a href="index.html">Home</a></li>
                     <li>Project Details</li>
                 </ol>

             </div>
         </div><!-- End Breadcrumbs -->

         <!-- ======= Projet Details Section ======= -->



         <section id="project-details" class="project-details">
             <div class="container" data-aos="fade-up" data-aos-delay="100">
                 <div class="position-relative h-100">
                     <div class="slides-1 portfolio-details-slider swiper">
                         <div class="swiper-wrapper align-items-center">

                             <div class="swiper-slide">
                                 <img src="<?= base_url() ?>assets/upload/artikel/<?= $port->foto ?>" alt="">
                             </div>
                             <?php
                                $id = $port->id;
                                $subfoto = $this->db->query("SELECT * FROM gallery WHERE produk_id='" . $id . "'")->result_array(); ?>
                             <?php foreach ($subfoto as $sf) : ?>

                                 <div class="swiper-slide">
                                     <img src="<?= base_url() ?>assets/upload/artikel/<?= $sf['foto'] ?>" alt="">
                                 </div>
                             <?php endforeach ?>
                         </div>
                         <div class="swiper-pagination"></div>
                     </div>
                     <div class="swiper-button-prev"></div>
                     <div class="swiper-button-next"></div>
                 </div>

                 <div class="row justify-content-between gy-4 mt-4">
                     <div class="col-lg-8">
                         <div class="portfolio-description">
                             <h2><?= $port->judul ?></h2>
                             <?= $port->konten ?>
                         </div>
                     </div>

                     <div class="col-lg-3">
                         <!-- <div class="portfolio-info">
                             <h3>Project information</h3>
                             <ul>
                                 <li><strong>Category</strong> <span>Web design</span></li>
                                 <li><strong>Client</strong> <span>ASU Company</span></li>
                                 <li><strong>Project date</strong> <span>01 March, 2020</span></li>
                                 <li><strong>Project URL</strong> <a href="#">www.example.com</a></li>
                                 <li><a href="#" class="btn-visit align-self-start">Visit Website</a></li>
                             </ul>
                         </div> -->

                         <div id="blog" class="blog">
                             <div class="sidebar">
                                 <div class="sidebar-item recent-posts">
                                     <h3 class="sidebar-title">Recent Posts</h3>
                                     <div class="mt-3">
                                         <?php foreach ($produkWidget as $pw) : ?>
                                             <div class="post-item mt-3">
                                                 <img src="<?= base_url() ?>assets/upload/artikel/<?= $pw->foto ?>" alt="">
                                                 <div>
                                                     <h4><a href="<?= base_url() ?><?= $pw->slug ?>/<?= $pw->id ?>"><?= $pw->judul ?></a></h4>
                                                     <time datetime="2020-01-01"><?= waktu_lalu($pw->date_post) ?></time>
                                                 </div>
                                             </div>
                                         <?php endforeach ?>
                                     </div>
                                 </div>
                                 <div class="sidebar-item recent-posts">
                                     <h3 class="sidebar-title">Berita Terkini</h3>
                                     <div class="mt-3">
                                         <?php foreach ($berita as $b) : ?>
                                             <div class="post-item mt-3">
                                                 <img src="<?= base_url() ?>assets/upload/artikel/<?= $b->foto ?>" alt="">
                                                 <div>
                                                     <h4><a href="<?= base_url() ?>berita-terkini/<?= $b->slug ?>/<?= $b->id ?>"><?= $b->judul ?></a></h4>
                                                     <time datetime="2020-01-01"><?= waktu_lalu($b->date_post) ?></time>
                                                 </div>
                                             </div>

                                         <?php endforeach ?>

                                     </div>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </section>
     <?php endforeach ?>
 </main>