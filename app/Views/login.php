<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login Sistem</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon.png') ?>?v=2" rel="icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>?v=2" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/styleyamin.css') ?>" rel="stylesheet">
</head>

<body style="background-color: #0dbd0d;">

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3" style="background-color: white;">
                                <div class="card-body mt-4">

                                    <div class="text-center">
                                        <img class="img mb-2"
                                             src="<?= base_url('assets/img/logo.png') ?>"
                                             alt="Logo"
                                             style="width: 100px;">

                                        <p style="font-size: 15px; font-family: Arial, sans-serif; font-weight: bold;">
                                            SISTEM REKOMENDASI <br>
                                            UNIT KEGIATAN MAHASISWA
                                        </p>
                                    </div>

                                    <form class="row g-3 needs-validation"
                                          novalidate
                                          action="<?= base_url('login') ?>"
                                          method="post">

                                        <?= csrf_field() ?>

                                        <div class="col-12">
                                            <label for="yourNama" class="form-label">Nama</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text">
                                                    <i class="bi bi-person-fill"></i>
                                                </span>

                                                <input type="text"
                                                       name="nama"
                                                       class="form-control"
                                                       id="yourNama"
                                                       value="<?= old('nama') ?>"
                                                       required>

                                                <div class="invalid-feedback">
                                                    Masukkan Nama!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text">
                                                    <i class="bi bi-lock-fill"></i>
                                                </span>

                                                <input type="password"
                                                       name="password"
                                                       class="form-control"
                                                       id="yourPassword"
                                                       required>

                                                <div class="invalid-feedback">
                                                    Masukkan Password!
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       id="showPassword"
                                                       onclick="togglePassword()">

                                                <label class="form-check-label"
                                                       for="showPassword">
                                                    Tampilkan Password
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn w-100 text-light"
                                                    style="background-color: #388E3C;"
                                                    type="submit">
                                                Login
                                                <i class="bi bi-box-arrow-in-right"></i>
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/chart.js/chart.umd.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/quill/quill.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('yourPassword');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>

</body>

</html>
