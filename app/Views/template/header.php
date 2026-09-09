<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #0dbd0d;">

    <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn me-2"></i>

        <a href="<?= base_url('dashboard') ?>" class="logo d-flex align-items-center">
            <img src="<?= base_url('assets/img/LOGO.png') ?>" alt="">
            <span class="d-none d-lg-block">SRUKM</span>
        </a>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0"
                   href="#"
                   data-bs-toggle="dropdown">

                    <img src="<?= base_url('assets/img/profil.png') ?>"
                         alt="Profile"
                         class="rounded-circle">

                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        <?= ucwords(session()->get('nama')) ?>
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                    <li class="dropdown-header">
                        <h6><?= ucwords(session()->get('nama')) ?></h6>
                        <span><?= ucfirst(session()->get('role')) ?></span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form id="editProfileForm"
                              action="<?= base_url('user/update') ?>"
                              method="post"
                              class="d-none">

                            <input type="hidden"
                                   name="idUser"
                                   value="<?= session()->get('idUser') ?>">
                        </form>

                <a class="dropdown-item d-flex align-items-center"
   href="<?= base_url('profil') ?>">
    <i class="bi bi-person"></i>
    <span>Kelola Profil Saya</span>
</a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                           href="<?= base_url('logout') ?>">

                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>

            </li>

        </ul>
    </nav>

</header>
<!-- End Header -->