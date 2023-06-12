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
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('<?= base_url() ?>assets/frontend/img/cov/service1.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

            <h2>SERVICES</h2>
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>SERVICES</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 posts-list">
                <?php foreach ($produk_konten as $pro) : ?>
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

                                <div class="meta d-flex align-items-center">
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
                                </div>

                                <p>
                                    <?= $limitext ?>
                                </p>

                                <hr>

                                <a href="<?= base_url() ?><?= $pro->slug ?>/<?= $pro->id ?>" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                            </div>

                        </div>
                    </div><!-- End post list item -->

                <?php endforeach ?>

            </div>

            <!-- <div class="blog-pagination">
                <ul class="justify-content-center">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                </ul>
            </div> -->

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->