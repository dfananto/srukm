<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>User</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                Kelola Data Pengguna
            </li>
        </ol>
    </nav>
</div>

<section class="section">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show floating-alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show floating-alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">
                        Daftar Pengguna Tersedia
                    </h5>

                    <?php if (session()->get('role') == 'admin') : ?>
                        <button class="btn btn-primary btn-sm mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#tambahUserModal">
                            <i class="bi bi-person-plus"></i>
                            Tambah Pengguna
                        </button>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table id="userTable" class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($users as $user) : ?>

                                    <tr>

                                        <td><?= esc($user['nama']) ?></td>
                                        <td><?= esc($user['nim']) ?></td>
                                        <td><?= esc($user['kelas']) ?></td>
                                        <td><?= esc($user['jurusan']) ?></td>
                                        <td><?= esc($user['role']) ?></td>

                                        <td>

                                            <button
                                                class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailModal<?= $user['idUser'] ?>">
                                                Detail
                                            </button>

                                            <?php if ($user['idUser'] != 14) : ?>

                                                <a href="<?= base_url('profile/' . $user['idUser']) ?>"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                    Edit
                                                </a>

                                            <?php endif; ?>
                                            <?php if ($user['idUser'] != 14) : ?>
                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm btn-hapus"
                                                data-id="<?= $user['idUser']; ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal">
                                                Hapus
                                            </button>
                                            <?php endif; ?>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>

</section>

<?php foreach ($users as $user) : ?>
    <div class="modal fade"
        id="detailModal<?= $user['idUser'] ?>"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail User</h5>
                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Nama :</b> <?= esc($user['nama']) ?></p>
                    <p><b>NIM :</b> <?= esc($user['nim']) ?></p>
                    <p><b>Umur :</b> <?= esc($user['umur']) ?></p>
                    <p><b>Jenis Kelamin :</b> <?= esc($user['jenisKelamin']) ?></p>
                    <p><b>Jurusan :</b> <?= esc($user['jurusan']) ?></p>
                    <p><b>Kelas :</b> <?= esc($user['kelas']) ?></p>
                    <p><b>No HP :</b> <?= esc($user['nohp']) ?></p>
                    <p><b>Email :</b> <?= esc($user['email']) ?></p>
                    <p><b>Role :</b> <?= esc($user['role']) ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUserModalLabel">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="<?= base_url('user/store') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="mb-2">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Umur</label>
                        <input type="number" class="form-control" name="umur">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="jenisKelamin">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" name="kelas">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Nomor Handphone</label>
                        <input type="text" class="form-control" name="nohp">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="input-group-text" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                    </div>

                    <?php if (session()->get('idUser') == 14): ?>
                        <div class="mb-2">
                            <label class="form-label">Role</label>
                            <select class="form-control" name="role">
                                <option value="admin">Admin</option>
                                <option value="user" selected>User</option>
                            </select>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <form id="formHapusUser" action="" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tombolHapus = document.querySelectorAll('.btn-hapus');
        const formHapus = document.getElementById('formHapusUser');

        tombolHapus.forEach(function(btn) {

            btn.addEventListener('click', function() {

                let id = this.getAttribute('data-id');

                formHapus.action = "<?= base_url('user/delete') ?>/" + id;

            });

        });

    });

 $('#userTable').DataTable({
      layout: {
        topStart: {
          buttons: [{
              extend: 'copy',
              exportOptions: {
                columns: ':not(:eq(5))'
              }
            },
            {
              extend: 'excel',
              exportOptions: {
                columns: ':not(:eq(5))'
              }
            },
            {
              extend: 'print',
              exportOptions: {
                columns: ':not(:eq(5))'
              }
            },
            {
                    extend: 'pdf',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':not(:eq(5))'
                    },
                    customize: function (doc) {

                        // Cari tabel PDF
                        var table = doc.content.find(function(item) {
                            return item.table;
                        });

                        if (table) {
                            table.table.widths = ['20%', '20%', '20%', '20%', '20%'];
                        }

                        doc.styles.title.alignment = 'center';
                        doc.styles.tableHeader.alignment = 'center';
                        doc.defaultStyle.alignment = 'center';
                    }
                }
          ]
        }
      }
    });
</script>
<?= $this->endSection() ?>