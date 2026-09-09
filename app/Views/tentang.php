<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Tentang Aplikasi</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                Tentang Aplikasi
            </li>
        </ol>
    </nav>
</div>

<section class="section profile">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show floating-alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show floating-alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    <?php endif; ?>

    <div class="row">

        <!-- Daftar UKM -->
        <div class="col-xl-4">

            <!-- Young Researchers -->
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/img/yorr.jpeg') ?>"
                        alt="Young Researchers"
                        class="rounded-circle">
                    <h4 class="text-center mt-3">
                        UKM Young Researchers
                    </h4>
                    <p class="text-center text-muted">
                        Unit kegiatan mahasiswa yang bergerak di bidang penelitian dan karya ilmiah.
                    </p>
                    <div class="social-links mt-2">
                        <a href="https://www.instagram.com/ukmyoungresearchers?igsh=bzU4YWlzMWo2aGg2"
                            target="_blank"
                            class="ig">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kewirausahaan -->
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?= base_url('assets/img/kwu.jpeg') ?>"
                        alt="Technosantri"
                        class="rounded-circle">

                    <h4 class="text-center mt-3">
                        UKM Kewirausahaan Technosantri
                    </h4>

                    <p class="text-center text-muted">
                        Unit Kegiatan Mahasiswa yang bergerak di bidang pengembangan jiwa kewirausahaan mahasiswa berbasis teknologi dan nilai-nilai kepesantrenan.
                    </p>

                    <div class="social-links mt-2">
                        <a href="https://www.instagram.com/kewirausahaan_technosantri?igsh=MXB5aWExazgyMmthag=="
                            target="_blank"
                            class="ig">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>

                </div>
            </div>

            <!-- MADDA -->
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?= base_url('assets/img/mada.png') ?>"
                        alt="MADDA"
                        class="rounded-circle">

                    <h4 class="text-center mt-3">
                        UKM MADDA
                    </h4>

                    <p class="text-center text-muted">
                        Unit kegiatan mahasiswa yang bergerak di bidang multimedia dan jurnalistik.
                    </p>

                    <div class="social-links mt-2">
                        <a href="https://www.instagram.com/maddamedia?igsh=MXg3MGp6ajVsMjcwNA=="
                            target="_blank"
                            class="ig">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>

                </div>
            </div>
                            <!-- Mapala -->
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/img/2.png') ?>"
                        alt="Mapala Batik"
                        class="rounded-circle">
                    <h4 class="text-center mt-3">
                        UKM Mapala Batik
                    </h4>
                    <p class="text-center text-muted">
                        Unit kegiatan mahasiswa yang bergerak di bidang Pecinta alam.
                    </p>
                    <div class="social-links mt-2">
                        <a href="https://www.instagram.com/mapala.batik?igsh=YzZ3ZG9kMWQycTlw"
                            target="_blank"
                            class="ig">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

                            <!-- Hiitsnu -->
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/img/4.png') ?>"
                        alt="Hiitsnu"
                        class="rounded-circle">
                    <h4 class="text-center mt-3">
                        UKM HIITSNU
                    </h4>
                    <p class="text-center text-muted">
                        Unit kegiatan mahasiswa yang bergerak di bidang rohani islam.
                    </p>
                    <div class="social-links mt-2">
                        <a href="https://www.instagram.com/hiitsnu_pekalongan?igsh=cGw1bXd2MWpnb3dv"
                            target="_blank"
                            class="ig">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

                            <!-- Aksen -->
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/img/3.png') ?>"
                        alt="Aksen"
                        class="rounded-circle">
                    <h4 class="text-center mt-3">
                        UKM Aksen
                    </h4>
                    <p class="text-center text-muted">
                        Unit kegiatan mahasiswa yang bergerak di bidang kesenian.
                    </p>
                    <div class="social-links mt-2">
                        <a href="https://www.instagram.com/aksen_itsnupkl?igsh=eXR5YTg2amVpd2Fk"
                            target="_blank"
                            class="ig">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

                <!-- Sport -->
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/img/5.png') ?>"
                        alt="sport"
                        class="rounded-circle">
                    <h4 class="text-center mt-3">
                        UKM Sport
                    </h4>
                    <p class="text-center text-muted">
                        Unit kegiatan mahasiswa yang bergerak di bidang olahraga.
                    </p>
                    <div class="social-links mt-2">
                        <a href="https://www.instagram.com/ukmsport_itsnupekalongan?igsh=MXA5bjFyc2R3NGJ6ZQ=="
                            target="_blank"
                            class="ig">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>



        <!-- Informasi Sistem -->
        <div class="col-xl-8">

            <div class="card">

                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center">

                        <ul class="nav nav-tabs nav-tabs-bordered mb-0">
                            <li class="nav-item">
                                <button class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#overview">
                                    Overview
                                </button>
                            </li>
                        </ul>

                        <a href="<?= base_url('masukkanKritik') ?>"
                            class="btn btn-primary btn-sm">
                            <i class="bi bi-chat-dots"></i>
                            Kritik dan Saran
                        </a>

                    </div>

                    <div class="tab-pane fade show active"
                        id="overview">
                        <div class="tab-content pt-3">

                            <div class="tab-pane fade show active"
                                id="overview">

                                <h5 class="card-title">
                                    Tentang Sistem
                                </h5>

                                <p class="text-justify">
                                    Website ini membantu merekomendasikan Unit Kegiatan Mahasiswa (UKM)
                                    di ITSNU Pekalongan kepada mahasiswa yang masih bingung menentukan
                                    UKM yang sesuai dengan minat dan kemampuan mereka.
                                </p>

                                <h5 class="card-title">
                                    Cara Menggunakan Sistem
                                </h5>

                                <ol>
                                    <li>Buka menu <strong>Cari UKM Terbaikmu</strong>.</li>
                                    <li>Pilih 3 sampai 5 kriteria yang sesuai dengan diri Anda.</li>
                                    <li>Klik tombol <strong>Lakukan Rekomendasi</strong>.</li>
                                    <li>Sistem akan menampilkan UKM yang paling sesuai denganmu.</li>
                                    <li>Klik info untuk melihat deskripsi kriteria.</li>
                                </ol>

                                <hr>
                                <div class="mt-3">

                                    <p class="text-justify">
                                        Jika Anda menemukan error, bug, atau sistem tidak dapat memberikan rekomendasi silakan gunakan menu
                                        <strong>Kritik dan Saran</strong>. dan ceritakan apa yang terjadi saat kamu memakai website
                                        Informasi yang Anda berikan akan sangat membantu dalam
                                        pengembangan dan penyempurnaan sistem.Jika memiliki kritik dan saran terhadap sistem rekomendasi UKM ini, kamu bisa memberikan kritik dan saran dengan from yang sama.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

</section>

<?= $this->endSection() ?>