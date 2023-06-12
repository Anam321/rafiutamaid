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




  <section id="hero" class="hero">

      <div class="info d-flex align-items-center">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-lg-6 text-center">
                      <h2 data-aos="fade-down">Selamat Datang Di <span><?= $perusahaan ?></span></h2>
                      <p data-aos="fade-up">Perusahan yang bergerak di bidang Jasa konstruksi, Bangunan Rumah, Bengkel Las, Dan Interior</p>
                      <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get Started</a>
                  </div>
              </div>
          </div>
      </div>

      <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

          <div class="carousel-item active" style="background-image: url(<?= base_url() ?>assets/upload/logo/logo2.png)"></div>
          <?php foreach ($slide as $hero) : ?>
              <div class="carousel-item" style="background-image: url(<?= base_url() ?>assets/upload/artikel/<?= $hero->foto ?>)"></div>

          <?php endforeach ?>
          <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
          </a>

          <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
          </a>

      </div>

  </section>


  <section id="alt-services" class="alt-services">
      <div class="container" data-aos="fade-up">

          <div class="row justify-content-around gy-4">
              <div class="col-lg-6 img-bg" data-aos="zoom-in" data-aos-delay="100">

                  <video width="550" height="500" controls>
                      <source src="<?= base_url() ?>assets/upload/<?= $video ?>" type="video/mp4">
                      <source src="<?= base_url() ?>assets/upload/<?= $video ?>" type="video/ogg">

                  </video>

              </div>

              <div class="col-lg-5 d-flex flex-column justify-content-center">
                  <h3>KENAPA MEMILIH KAMI</h3>
                  <p>Perusahaan kami didukung oleh tim yang profesional dan berpengalaman, dengan harga yang fleksible, tepat waktu, dan bergaransi.</p>

                  <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="100">
                      <i class="fas fa-university flex-shrink-0"></i>
                      <div>
                          <h4><a href="" class="stretched-link">Pengerjaan dengan Pakar</a></h4>
                          <p>Perusahaan kami berdiri sudah sejak lama,dengan legalitas yang jelas tentunya kami sudah berpengalaman dalam bidang ini. jadi anda tidak perlu khawatir dengan Pengalaman kami.</p>
                      </div>
                  </div><!-- End Icon Box -->

                  <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                      <i class="bi bi-alarm-fill flex-shrink-0"></i>
                      <div>
                          <h4><a href="" class="stretched-link">Flexible</a></h4>
                          <p>Dengan banyaknya tenaga kerja di Bengkel Las kami, sehingga waktu pengerjaan sesuai deadline.</p>
                      </div>
                  </div><!-- End Icon Box -->

                  <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
                      <i class="fas fa-tag flex-shrink-0"></i>
                      <div>
                          <h4><a href="" class="stretched-link">Biaya Hemat</a></h4>
                          <p>Harga yang kami Tawarkan sangat murah, sehingga Anda bisa menghemat Uang anda untuk keperluan lainnya. Silahkan Hubungi kami untuk Konsultasi terlebih dahulu untuk penyesuaian budget anda.</p>
                      </div>
                  </div><!-- End Icon Box -->

                  <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                      <i class="fas fa-user-tie flex-shrink-0"></i>
                      <div>
                          <h4><a href="" class="stretched-link">Kepercayaan</a></h4>
                          <p>Portpolio pengalaman kami dalam menyediakan jasa konstruksi rumah serta jasa lainnya merupakan benar benar pekerjaan yang telah kami kerjakan dan bisa di cek langsung ke lokasi.</p>
                      </div>
                  </div><!-- End Icon Box -->

              </div>
          </div>

      </div>
  </section>



  <section id="blog" class="blog">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="section-header">
              <h2>Produk Dan Jasa</h2>
              <p>Berikut Adalah Produk Dan Jasa Yang Kami Bisa Kerjakan</p>
          </div>
          <div class="row gy-4 posts-list">
              <?php foreach ($Produk as $pro) : ?>
                  <?php $text = $pro->deskripsi;
                    $limitext = word_limiter($text, 35);
                    ?>
                  <div class="col-xl-4 col-md-6">
                      <div class="post-item position-relative h-100">

                          <div class="post-img position-relative overflow-hidden">
                              <img src="<?= base_url() ?>assets/upload/artikel/<?= $pro->foto ?>" class="img-fluid" alt="">
                              <span class="post-date"><?= waktu_lalu($pro->date_post) ?></span>
                          </div>

                          <div class="post-content d-flex flex-column">

                              <h3 class="post-title"><?= $pro->judul ?></h3>

                              <!-- <div class="meta d-flex align-items-center">
                                  <div class="d-flex align-items-center">
                                      <i class="bi bi-person"></i> <span class="ps-2"><?= $pro->penerbit ?></span>
                                  </div>
                                  <span class="px-3 text-black-50">/</span>
                                  <div class="d-flex align-items-center">
                                      <i class="bi bi-folder2"></i> <span class="ps-2"><?= $pro->kategori ?></span>
                                  </div>
                                  <span class="px-3 text-black-50">/</span>
                                  <?php $id = $pro->id ?>
                                  <?php $lihat = $this->db->query("SELECT * FROM section_visit WHERE produk_id='" . $id . "'")->num_rows(); ?>
                                  <div class="d-flex align-items-center">
                                      <i class="fa fa-eye"></i> <span class="ps-2"><?= $lihat ?> view</span>
                                  </div>
                              </div> -->

                              <p>
                                  <?= $limitext ?>
                              </p>

                              <hr>

                              <a href="<?= base_url() ?><?= $pro->slug ?>/<?= $pro->id ?>" class="readmore stretched-link"><span>Lihat Selengkapnya..</span><i class="bi bi-arrow-right"></i></a>

                          </div>

                      </div>
                  </div><!-- End post list item -->

              <?php endforeach ?>

          </div>

      </div>
  </section>


  <section id="projects" class="projects">
      <div class="container" data-aos="fade-up">

          <div class="section-header">
              <h2>Our Projects</h2>
              <p>Berikut ini adalah beberapa projek yang telah kami kerjakan</p>
          </div>

          <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">

              <ul class="portfolio-flters" data-aos="fade-up" data-aos-delay="100">
                  <li data-filter="*" class="filter-active">All</li>
                  <?php foreach ($kategori as $k) : ?>
                      <li data-filter=".filter-<?= $k->kategori ?>"><?= $k->kategori ?></li>
                  <?php endforeach ?>

              </ul><!-- End Projects Filters -->

              <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                  <?php foreach ($portfolio as $port) : ?>
                      <?php $text = $port->deskripsi;
                        $limitext = word_limiter($text, 35);
                        ?>
                      <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $port->kategori ?>">
                          <div class="portfolio-content h-100">
                              <img src="<?= base_url() ?>assets/upload/artikel/<?= $port->foto ?>" class="img-fluid" alt="">
                              <div class="portfolio-info">
                                  <h4><?= $port->judul ?></h4>
                                  <p><?= $limitext ?></p>
                                  <a href="<?= base_url() ?>assets/upload/artikel/<?= $port->foto ?>" title="Remodeling 1" data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                  <a href="<?= base_url() ?>portfolio/<?= $port->slug ?>/<?= $port->id ?>" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                              </div>
                          </div>
                      </div>
                  <?php endforeach ?>
              </div>

          </div>

      </div>
  </section>




  <section id="features" class="features section-bg">
      <div class="container" data-aos="fade-up">

          <ul class="nav nav-tabs row  g-2 d-flex">

              <li class="nav-item col-3">
                  <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                      <h4>Rancangan</h4>
                  </a>
              </li><!-- End tab nav item -->

              <li class="nav-item col-3">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                      <h4>Sistem Pembayaran</h4>
                  </a><!-- End tab nav item -->

              <li class="nav-item col-3">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                      <h4>Biaya Terbatas</h4>
                  </a>
              </li><!-- End tab nav item -->

              <li class="nav-item col-3">
                  <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                      <h4>Tentang Design</h4>
                  </a>
              </li><!-- End tab nav item -->

          </ul>

          <div class="tab-content">

              <div class="tab-pane active show" id="tab-1">
                  <div class="row">
                      <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                          <h3>Tentang Rancangan Anda</h3>
                          <p class="fst-italic">
                              Rancangan apapun yang ingin anda wujudkan akan kami bantu. Cukup beritahukan rancangan yang anda inginkan dan akan kami bantu untuk rincian modifikasi rancangan dan pengerjaannya di lokasi.
                          </p>

                      </div>
                      <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                          <img src="<?= base_url() ?>assets/frontend/img/cov/r2.jpg" alt="" class="img-fluid">
                      </div>
                  </div>
              </div><!-- End tab content item -->

              <div class="tab-pane" id="tab-2">
                  <div class="row">
                      <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                          <h3>Sistem Pembayaran </h3>
                          <p class="fst-italic">
                              Sistem pembayaran kami berdasarkan pada pembayaran bertahap sesuai dengan progress. Booking fee, DP 1, Progress Payment, dan Finalisasi. Pembayaran dilakukan dengan melakukan transfer ke rekening resmi perusahaan kami.
                          </p>

                      </div>
                      <div class="col-lg-6 order-1 order-lg-2 text-center">
                          <img src="<?= base_url() ?>assets/frontend/img/cov/p2.webp" alt="" class="img-fluid">
                      </div>
                  </div>
              </div><!-- End tab content item -->

              <div class="tab-pane" id="tab-3">
                  <div class="row">
                      <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                          <h3>Pembiayaan anda Terbatas Tenang Saja</h3>
                          Kami akan menyesuaikan rancangan yang anda pilih dengan budget anda. Tidak perlu khawatir karena tim profesional kami akan tetap menjaga kualitas dengan memilih material yang paling sesuai untuk rancangan anda.
                      </div>
                      <div class="col-lg-6 order-1 order-lg-2 text-center">
                          <img src="<?= base_url() ?>assets/frontend/img/cov/b1.png" alt="" class="img-fluid">
                      </div>
                  </div>
              </div><!-- End tab content item -->

              <div class="tab-pane" id="tab-4">
                  <div class="row">
                      <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                          <h3>Anda Ingin Mengubah Design</h3>
                          <p class="fst-italic">
                              Selama belum finalisasi kontrak, anda bebas mengubah rancangan. Kami akan memperhitungkan biaya sesuai rancangan terakhir. Jika di tengah pelaksanaan proyek anda ingin mengubah design, maka kami akan menyesuaikan biaya sesuai perubahan yang terjadi, baik itu berupa penambahan maupun pengurangan.
                          </p>

                      </div>
                      <div class="col-lg-6 order-1 order-lg-2 text-center">
                          <img src="<?= base_url() ?>assets/frontend/img/cov/de1.jpg" alt="" class="img-fluid">
                      </div>
                  </div>
              </div><!-- End tab content item -->

          </div>

      </div>
  </section>

  <section id="stats-counter" class="stats-counter section-bg">
      <div class="container">

          <div class="row gy-4">

              <div class="col-lg-3 col-md-6">
                  <div class="stats-item d-flex align-items-center w-100 h-100">
                      <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
                      <div>
                          <span data-purecounter-start="0" data-purecounter-end="43" data-purecounter-duration="1" class="purecounter"></span>
                          <p>Karyawan</p>
                      </div>
                  </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-3 col-md-6">
                  <div class="stats-item d-flex align-items-center w-100 h-100">
                      <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
                      <div>
                          <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                          <p>Projects Selesai</p>
                      </div>
                  </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-3 col-md-6">
                  <div class="stats-item d-flex align-items-center w-100 h-100">
                      <i class="bi bi-file-arrow-down color-green flex-shrink-0"></i>
                      <div>
                          <?php $date = date("Y-m-d"); ?>
                          <?php $pengunjungHariini = $this->db->query("SELECT * FROM visitor WHERE date='" . $date . "'")->num_rows(); ?>


                          <span data-purecounter-start="0" data-purecounter-end="<?= $pengunjungHariini ?>" data-purecounter-duration="1" class="purecounter"></span>
                          <p>Pengunjung Hari Ini</p>
                      </div>
                  </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-3 col-md-6">
                  <div class="stats-item d-flex align-items-center w-100 h-100">
                      <i class="bi bi-people color-pink flex-shrink-0"></i>
                      <div>
                          <?php $allpengunjung = $this->db->query("SELECT * FROM visitor")->num_rows(); ?>
                          <span data-purecounter-start="0" data-purecounter-end="<?= $allpengunjung ?>" data-purecounter-duration="1" class="purecounter"></span>
                          <p>Total Pengunjung</p>
                      </div>
                  </div>
              </div><!-- End Stats Item -->

          </div>

      </div>
  </section>



  <section id="recent-blog-posts" class="recent-blog-posts">
      <div class="container" data-aos="fade-up"">

    
    
  <div class=" section-header">
          <h2>Berita Terkini</h2>
          <p>Temukan Berita Terkini</p>
      </div>

      <div class="row gy-5">
          <?php foreach ($berita as $art) : ?>
              <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                  <div class="post-item position-relative h-100">

                      <div class="post-img position-relative overflow-hidden">
                          <img src="<?= base_url() ?>assets/upload/artikel/<?= $art->foto ?>" class="img-fluid" alt="">
                          <span class="post-date"><?= waktu_lalu($art->date_post) ?></span>
                      </div>

                      <div class="post-content d-flex flex-column">

                          <h3 class="post-title"><?= $art->judul ?></h3>

                          <div class="meta d-flex align-items-center">
                              <div class="d-flex align-items-center">
                                  <i class="bi bi-person"></i> <span class="ps-2"><?= $art->penerbit ?></span>
                              </div>
                              <span class="px-3 text-black-50">/</span>
                              <div class="d-flex align-items-center">
                                  <i class="bi bi-folder2"></i> <span class="ps-2"><?= $art->kategori ?></span>
                              </div>
                          </div>

                          <hr>

                          <a href="<?= base_url() ?>berita-terkini/<?= $art->slug ?>" class="readmore stretched-link"><span>Lihat Selengkapnya</span><i class="bi bi-arrow-right"></i></a>

                      </div>

                  </div>
              </div><!-- End post item -->
          <?php endforeach ?>


      </div>

      </div>
  </section>
  <!-- End Recent Blog Posts Section -->

  </main>







  <script>
      function showAlert(type, msg) {

          toastr.options.closeButton = true;
          toastr.options.progressBar = true;
          toastr.options.extendedTimeOut = 1000; //1000

          toastr.options.timeOut = 3000;
          toastr.options.fadeOut = 250;
          toastr.options.fadeIn = 250;

          toastr.options.positionClass = 'toast-top-center';
          toastr[type](msg);
      }

      function fileValidation() {
          var fileInput = document.getElementById('file');
          var filePath = fileInput.value;
          var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
          if (!allowedExtensions.exec(filePath)) {
              alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
              fileInput.value = '';
              return false;
          } else {
              //Image preview
              if (fileInput.files && fileInput.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                      document.getElementById('imagePreview').innerHTML = '<img style="max-width:350px;" src="' + e.target
                          .result + '"/>';
                  };
                  reader.readAsDataURL(fileInput.files[0]);
              }
          }
      }

      function addtesti() {

          $('#form')[0].reset();
          // $('#imagePreview').html('');

          $('#modaltesti').modal('show');
          $('.modal-title').text('Tambah Testimoni Anda');
      }


      $('#form').submit(function(e) {
          e.preventDefault();
          var form = $('#form')[0];
          var data = new FormData(form);

          if ($('[name="foto"]').val() == '') {
              alert('Pilih Foto Produk Yang Akan di Upload !');
              return false;
          }

          $('#btnSave').text('Sedang Proses, Mohon tunggu...'); //change button text
          $('#btnSave').attr('disabled', true); //set button disable
          $.ajax({
              url: "<?php echo site_url('home/inputtesti/') ?>",
              type: "POST",
              //contentType: 'multipart/form-data',
              cache: false,
              contentType: false,
              processData: false,
              method: 'POST',
              data: data,
              dataType: "JSON",

              success: function(data) {
                  if (data.status == '00') {
                      showAlert(data.type, data.mess);
                      $('#modaltesti').modal('hide');
                      $('#form')[0].reset();
                  } else {
                      showAlert(data.type, data.mess);
                  }
                  $('#btnSave').text('Simpan'); //change button text
                  $('#btnSave').attr('disabled', false); //set button enable
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  type = 'error';
                  msg = 'Error adding / update data';
                  showAlert(type, msg); //utk show alert
                  $('#btnSave').text('Simpan'); //change button text
                  $('#btnSave').attr('disabled', false); //set button enable
              }
          });

      });
  </script>