 <footer id="footer" class="footer">

     <div class="footer-content position-relative">
         <div class="container">
             <div class="row">

                 <div class="col-lg-4 col-md-6">
                     <div class="footer-info">
                         <h3><?= $perusahaan ?></h3>
                         <p>
                             <?= $alamat ?> <br>
                             Indonesia<br><br>
                             <strong>Phone:</strong> +62 <?= $telpon ?><br>
                             <strong>Email:</strong> <?= $email ?><br>
                         </p>
                         <div class="social-links d-flex mt-3">
                             <a href="<?= $tiktok ?>" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-tiktok"></i></a>
                             <a href="<?= $facebook ?>" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                             <a href="<?= $instagram ?>" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                             <a href="https://api.whatsapp.com/send?phone=+62<?= $whatsap ?>&text=Halo%20<?= $perusahaan ?>%20Mohon%20informasi%20produk%20produk%20dan%20pemesanan" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-Whatsapp"></i></a>
                         </div>
                     </div>
                 </div><!-- End footer info column-->

                 <div class="col-lg-2 col-md-3 footer-links">
                     <h4>Useful Links</h4>
                     <ul>
                         <li><a href="<?= base_url() ?>">Home</a></li>
                         <li><a href="<?= base_url() ?>about">Tentang</a></li>
                         <li><a href="<?= base_url() ?>jasa">Layanan</a></li>
                         <li><a href="<?= base_url() ?>portfolio">Portfolio</a></li>
                         <li><a href="<?= base_url() ?>berita">Berita</a></li>
                         <li><a href="<?= base_url() ?>kontak">Kontak</a></li>
                     </ul>
                 </div><!-- End footer links column-->

                 <div class="col-lg-2 col-md-3 footer-links">
                     <h4>Berita Terbaru</h4>
                     <ul>
                         <?php foreach ($berita as $art) : ?>
                             <li><a href="<?= base_url() ?>berita/<?= $art->slug ?>"><?= $art->judul ?></a></li>
                         <?php endforeach ?>
                     </ul>
                 </div><!-- End footer links column-->

                 <div class="col-lg-2 col-md-3 footer-links">
                     <h4>Produk Dan Jasa</h4>
                     <ul>
                         <?php foreach ($Produk as $jasa) : ?>
                             <li><a href="<?= base_url() ?>portfolio/<?= $jasa->slug ?>"><?= $jasa->judul ?></a></li>
                         <?php endforeach ?>
                     </ul>
                 </div><!-- End footer links column-->



             </div>
         </div>
     </div>

     <div class="footer-legal text-center position-relative">
         <div class="container">
             <div class="copyright">
                 &copy; Copyright <strong><span><?= $perusahaan ?></span></strong>. All Rights Reserved
             </div>
             <div class="credits">
                 <!-- All the links in the footer should remain intact. -->
                 <!-- You can delete the links only if you purchased the pro version. -->
                 <!-- Licensing information: https://bootstrapmade.com/license/ -->
                 <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/ -->
                 Designed by <a href="<?= base_url() ?>">AnbomekerDev</a>
             </div>
         </div>
     </div>

 </footer>
 <!-- End Footer -->

 <a href=" #" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <div id="preloader"></div>

 <!-- Vendor JS Files -->
 <script src="<?= base_url() ?>assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="<?= base_url() ?>assets/frontend/vendor/aos/aos.js"></script>
 <script src="<?= base_url() ?>assets/frontend/vendor/glightbox/js/glightbox.min.js"></script>
 <script src="<?= base_url() ?>assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
 <script src="<?= base_url() ?>assets/frontend/vendor/swiper/swiper-bundle.min.js"></script>
 <script src="<?= base_url() ?>assets/frontend/vendor/purecounter/purecounter_vanilla.js"></script>
 <script src="<?= base_url() ?>assets/frontend/vendor/php-email-form/validate.js"></script>

 <!-- Template Main JS File -->
 <script src="<?= base_url() ?>assets/frontend/js/main.js"></script>

 </body>

 </html>