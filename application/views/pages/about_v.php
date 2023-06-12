 <main id="main">

     <!-- ======= Breadcrumbs ======= -->
     <div class="breadcrumbs d-flex align-items-center" style="background-image: url('<?= base_url() ?>assets/frontend/img/cov/tentang.jpg');">
         <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

             <h2>About</h2>
             <ol>
                 <li><a href="index.html">Home</a></li>
                 <li>About</li>
             </ol>

         </div>
     </div><!-- End Breadcrumbs -->

     <!-- ======= About Section ======= -->
     <section id="about" class="about">
         <div class="container" data-aos="fade-up">

             <div class="row position-relative">

                 <div class="col-lg-7 about-img" style="background-image: url(<?= base_url() ?>assets/upload/poto/<?= $foto ?>);"></div>

                 <div class="col-lg-7">
                     <h2><?= $perusahaan ?></h2>
                     <div class="our-story">
                         <?= $tentang ?>
                         <div class="watch-video d-flex align-items-center position-relative">
                             <i class="bi bi-play-circle"></i>
                             <a href="<?= base_url() ?>assets/upload/<?= $video ?>" class="glightbox stretched-link">Watch Video</a>
                         </div>
                     </div>
                 </div>

             </div>

         </div>
     </section>


 </main>