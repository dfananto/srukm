```php
<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Edit Profil</h1>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('user') ?>">
                    Kelola Data Pengguna
                </a>
            </li>

            <li class="breadcrumb-item active">
                Edit Profil
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">
                        Form Edit Profil
                    </h5>
                </div>

                <div class="card-body pt-4">

                    <form action="<?= base_url('user/update/' . $user['idUser']) ?>"
                          method="post">

                        <?= csrf_field() ?>

                        <input type="hidden"
                               name="idUser"
                               value="<?= $user['idUser'] ?>">

                        <!-- Informasi Pribadi -->
                        <h6 class="fw-bold text-primary mb-3">
                            Informasi Pribadi
                        </h6>

                        <div class="mb-3">

                            <label class="form-label">
                                Nama
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="nama"
                                   value="<?= esc($user['nama']) ?>"
                                   readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Umur
                            </label>

                            <input type="number"
                                   class="form-control"
                                   name="umur"
                                   value="<?= esc($user['umur']) ?>">

                        </div>

                                                <div class="mb-3">

                            <label class="form-label">
                                Jenis Kelamin
                            </label>

                            <select class="form-select"
                                    name="jenisKelamin">

                                <option value="Laki-laki"
                                    <?= $user['jenisKelamin'] == 'Laki-laki' ? 'selected' : '' ?>>
                                    Laki-laki
                                </option>

                                <option value="Perempuan"
                                    <?= $user['jenisKelamin'] == 'Perempuan' ? 'selected' : '' ?>>
                                    Perempuan
                                </option>

                            </select>

                        </div>

                        <?php if (
                            session()->get('idUser') == 14 &&
                            $user['idUser'] != 14
                        ) : ?>

                            <div class="mb-3">

                                <label class="form-label">
                                    Role
                                </label>

                                <select class="form-select"
                                        name="role">

                                    <option value="admin"
                                        <?= $user['role'] == 'admin' ? 'selected' : '' ?>>
                                        Admin
                                    </option>

                                    <option value="user"
                                        <?= $user['role'] == 'user' ? 'selected' : '' ?>>
                                        User
                                    </option>

                                </select>

                            </div>

                        <?php endif; ?>

                        <hr>

                        <!-- Informasi Akademik -->
                        <h6 class="fw-bold text-primary mb-3">
                            Informasi Akademik
                        </h6>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label">
                                        NIM
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           name="nim"
                                           value="<?= esc($user['nim']) ?>">

                                </div>

                            </div>

                            <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Kelas
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="kelas"
                                   value="<?= esc($user['kelas']) ?>">

                        </div>


                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Jurusan
                            </label>

                            <select class="form-select"
                                    name="jurusan">

                                <option value="Informatika" <?= $user['jurusan'] == 'Informatika' ? 'selected' : '' ?>>
                                    Informatika
                                </option>

                                <option value="Teknik Informasi" <?= $user['jurusan'] == 'Teknik Informasi' ? 'selected' : '' ?>>
                                    Teknik Informasi
                                </option>

                                <option value="Teknik Industri" <?= $user['jurusan'] == 'Teknik Industri' ? 'selected' : '' ?>>
                                    Teknik Industri
                                </option>

                                <option value="Administrasi Perkantoran" <?= $user['jurusan'] == 'Administrasi Perkantoran' ? 'selected' : '' ?>>
                                    Administrasi Perkantoran
                                </option>

                                <option value="Akutansi" <?= $user['jurusan'] == 'Akutansi' ? 'selected' : '' ?>>
                                    Akutansi
                                </option>

                                <option value="Kriya Batik" <?= $user['jurusan'] == 'Kriya Batik' ? 'selected' : '' ?>>
                                    Kriya Batik
                                </option>

                            </select>

                        </div>

                        <hr>

                        <!-- Informasi Kontak -->
                        <h6 class="fw-bold text-primary mb-3">
                            Informasi Kontak
                        </h6>

                        <div class="mb-3">

                            <label class="form-label">
                                Nomor HP
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="nohp"
                                   value="<?= esc($user['nohp']) ?>">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                E-Mail
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="email"
                                   value="<?= esc($user['email']) ?>">

                        </div>

                        <hr>

                        <!-- Keamanan Akun -->
                        <h6 class="fw-bold text-primary mb-3">
                            Keamanan Akun
                        </h6>

                        <div class="mb-3">

                            <label class="form-label">
                                Password Baru
                            </label>

                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   autocomplete="new-password">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Konfirmasi Password Baru
                            </label>

                            <input type="password"
                                   class="form-control"
                                   name="confirm_password"
                                   autocomplete="new-password">

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="<?= base_url('user') ?>"
                               class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>
                                Kembali

                            </a>

                            <button type="submit"
                                    class="btn btn-success">

                                <i class="bi bi-save"></i>
                                Simpan Perubahan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

<?= $this->endSection() ?>
```
