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

     <!-- ======= Breadcrumbs ======= -->
     <div class="breadcrumbs d-flex align-items-center" style="background-image: url('<?= base_url() ?>assets/frontend/img/services.jpg');">
         <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

             <h2>Layanan</h2>
             <ol>
                 <li><a href="index.html">Home</a></li>
                 <li>Layanan</li>
             </ol>

         </div>
     </div><!-- End Breadcrumbs -->

     <!-- ======= Blog Details Section ======= -->
     <section id="blog" class="blog">
         <div class="container" data-aos="fade-up" data-aos-delay="100">

             <div class="row g-5">

                 <div class="col-lg-8">
                     <?php foreach ($produkbyslug as $slug) : ?>
                         <article class="blog-details">

                             <div class="post-img">
                                 <img src="<?= base_url() ?>assets/upload/artikel/<?= $slug->foto ?>" alt="" class="img-fluid">
                             </div>

                             <h2 class="title"><?= $slug->judul ?></h2>

                             <div class="meta-top">
                                 <ul>
                                     <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html"><?= $slug->penerbit ?></a></li>
                                     <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01"><?= waktu_lalu($slug->date_post) ?></time></a></li>
                                     <li class="d-flex align-items-center"><i class="bi bi-folder2"></i> <a href="blog-details.html"><?= $slug->kategori ?></a></li>
                                     <?php $id = $slug->id ?>
                                     <?php $lihat = $this->db->query("SELECT * FROM section_visit WHERE produk_id='" . $id . "'")->num_rows(); ?>
                                     <li class="d-flex align-items-center"><i class="fa fa-eye"></i> <a href="blog-details.html"><?= $lihat ?> view</a></li>
                                 </ul>
                             </div><!-- End meta top -->

                             <div class="content">
                                 <?= $slug->konten ?>

                             </div><!-- End post content -->

                             <div class="meta-bottom">
                                 <i class="bi bi-folder"></i>
                                 <ul class="cats">
                                     <li><a href="#">Business</a></li>
                                 </ul>

                                 <i class="bi bi-tags"></i>
                                 <ul class="tags">
                                     <li><a href="#">Creative</a></li>
                                     <li><a href="#">Tips</a></li>
                                     <li><a href="#">Marketing</a></li>
                                 </ul>
                             </div><!-- End meta bottom -->

                         </article><!-- End blog post -->
                     <?php endforeach ?>
                 </div>






                 <div class="col-lg-4">

                     <div class="sidebar">

                         <!-- <div class="sidebar-item search-form">
                             <h3 class="sidebar-title">Search</h3>
                             <form action="" class="mt-3">
                                 <input type="text">
                                 <button type="submit"><i class="bi bi-search"></i></button>
                             </form>
                         </div> -->



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
     </section>

 </main>