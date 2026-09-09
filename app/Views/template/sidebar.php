<?php
$currentPage = service('uri')->getSegment(1);
$role = session()->get('role');
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="background-color: #0dbd0d">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?= ($currentPage == 'dashboard' || $currentPage == '') ? '' : 'collapsed' ?>"
               href="<?= base_url('dashboard') ?>">

                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <?php if ($role == 'admin') : ?>
            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'user') ? '' : 'collapsed' ?>"
                   href="<?= base_url('user') ?>">
                    <i class="bi bi-people"></i>
                    <span>User</span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link <?= ($currentPage == 'rekomendasi') ? '' : 'collapsed' ?>"
               href="<?= base_url('rekomendasi') ?>">

                <i class="bi bi-clipboard-plus"></i>
                <span>Cari UKM Terbaikmu</span>
            </a>
        </li>

        <?php if ($role == 'admin') : ?>

            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'kriteria') ? '' : 'collapsed' ?>"
                   href="<?= base_url('kriteria') ?>">

                    <i class="bi bi-thermometer-half"></i>
                    <span>Kriteria</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'ukm') ? '' : 'collapsed' ?>"
                   href="<?= base_url('ukm') ?>">

                    <i class="bi bi-file-medical"></i>
                    <span>UKM</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'rule') ? '' : 'collapsed' ?>"
                   href="<?= base_url('rule') ?>">

                    <i class="bi bi-file-check"></i>
                    <span>Rule</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'laporan') ? '' : 'collapsed' ?>"
                   href="<?= base_url('laporan') ?>">

                    <i class="bi bi-files-alt"></i>
                    <span>Laporan</span>
                </a>
            </li>
                        <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'kelolamasukkan') ? '' : 'collapsed' ?>"
                   href="<?= base_url('kelolamasukkan') ?>">

                    <i class="bi bi-chat-dots"></i>
                    <span>Kritik Saran</span>
                </a>
            </li>

        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link <?= ($currentPage == 'tentang') ? '' : 'collapsed' ?>"
               href="<?= base_url('tentang') ?>">

                <i class="bi bi-info-circle"></i>
                <span>Tentang Aplikasi</span>
            </a>
        </li>

    </ul>

</aside>
<!-- End Sidebar -->