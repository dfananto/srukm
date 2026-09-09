<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?? 'SRUKM' ?></title>

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">

    <!-- Vendor CSS -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">

    <!-- Main CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/styleyamin.css') ?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/css/dataTables.bootstrap5.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables/css/buttons.bootstrap5.min.css') ?>">
</head>

<body>

    <?= $this->include('template/header') ?>
    <?= $this->include('template/sidebar') ?>

    <main id="main" class="main">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('template/footer') ?>

    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <!-- Bootstrap JS (WAJIB untuk Modal, Dropdown, Collapse, dll) -->
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- DataTables -->
    <script src="<?= base_url('assets/vendor/datatables/js/dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/js/dataTables.bootstrap5.js') ?>"></script>

    <!-- DataTables Buttons -->
    <script src="<?= base_url('assets/vendor/datatables/js/buttons/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/js/buttons/buttons.bootstrap5.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/datatables/js/buttons/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/js/buttons/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/js/buttons/vfs_fonts.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/datatables/js/buttons/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/js/buttons/buttons.print.min.js') ?>"></script>

    <!-- Script dari setiap View -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>