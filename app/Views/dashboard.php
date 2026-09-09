<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <hr>
        </div>
    <?php endif; ?>

    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Selamat Datang</h5>

                    <p align="justify">
                        Website ini membantu merekomendasikan Unit Kegiatan Mahasiswa
                        kampus ITSNU Pekalongan yang cocok untuk mahasiswa ITSNU
                        Pekalongan yang masih bingung memilih UKM.
                        <br><br>

                        <strong>**Cara Menggunakan Website**</strong>
                        <br>1. Klik halaman rekomendasi.
                        <br>2. Pilih 3 sampai 5 kriteria yang sesuai dengan kamu.
                        <br>3. Website akan menampilkan rekomendasi yang cocok untuk kamu.
                        <br>4. Klik tombol Info untuk melihat deskripsi kriteria.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="card">
                <div id="carouselExampleControls"
                     class="carousel slide"
                     data-bs-ride="carousel">

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="p-3 bg-white rounded shadow"
                                 style="height:200px;display:flex;align-items:center;justify-content:center;">
                                <img src="<?= base_url('assets/img/its 3.png') ?>"
                                     class="img-fluid">
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="p-3 bg-white rounded shadow"
                                 style="height:200px;display:flex;align-items:center;justify-content:center;">
                                <img src="<?= base_url('assets/img/its 1.png') ?>"
                                     class="img-fluid">
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="p-3 bg-white rounded shadow"
                                 style="height:200px;display:flex;align-items:center;justify-content:center;">
                                <img src="<?= base_url('assets/img/its 2.png') ?>"
                                     class="img-fluid">
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="p-3 bg-white rounded shadow"
                                 style="height:200px;display:flex;align-items:center;justify-content:center;">
                                <img src="<?= base_url('assets/img/its 4.png') ?>"
                                     class="img-fluid">
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="p-3 bg-white rounded shadow"
                                 style="height:200px;display:flex;align-items:center;justify-content:center;">
                                <img src="<?= base_url('assets/img/its 5.png') ?>"
                                     class="img-fluid">
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="p-3 bg-white rounded shadow"
                                 style="height:200px;display:flex;align-items:center;justify-content:center;">
                                <img src="<?= base_url('assets/img/its 6.png') ?>"
                                     class="img-fluid">
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev"
                            type="button"
                            data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next"
                            type="button"
                            data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">
                        Total Diagnosis <span>| Keseluruhan</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-clipboard-check"></i>
                        </div>

                        <div class="ps-3">
                            <h6><?= $totalDiagnosis ?></h6>
                            <span class="text-success small pt-1 fw-bold">
                                Orang
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">
                        Diagnosis <span>| Hari Ini</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-clipboard-plus"></i>
                        </div>

                        <div class="ps-3">
                            <h6><?= $diagnosisHariIni ?></h6>
                            <span class="text-success small pt-1 fw-bold">
                                Orang
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">
                        Rule <span>| Mesin Inferensi</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cpu"></i>
                        </div>

                        <div class="ps-3">
                            <h6><?= $totalRule ?></h6>
                            <span class="text-success small pt-1 fw-bold">
                                Rule
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</section>

<?= $this->endSection() ?>