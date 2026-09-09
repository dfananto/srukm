<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Kelola Data UKM</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                Unit Kegiatan Mahasiswa
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
                        Daftar UKM Tersedia
                    </h5>
                    <?php if (session()->get('role') == 'admin') : ?>
                        <button class="btn btn-primary btn-sm mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#tambahUkmModal">
                            <i class="bi bi-plus"></i>
                            Tambah UKM
                        </button>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="userTable" class="table">
                            <thead>
                                <tr>
                                    <th>ID UKM</th>
                                    <th>Nama UKM</th>
                                    <th>Deskripsi</th>
                                    <th class="noExport">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ukm as $u) : ?>
                                    <tr>
                                        <td class="text-center"><?= esc($u['idUkm']) ?></td>
                                        <td><?= esc($u['nama']) ?></td>
                                        <td><?= esc($u['deskripsi']) ?></td>
                                        <td class="noExport">
                                            <button
                                                class="btn btn-primary btn-sm editUkm"
                                                data-id="<?= $u['idUkm']; ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUkmModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger btn-sm btn-hapus hapusKriteria mt-1"
                                                data-id="<?= $u['idUkm']; ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal">
                                                <i class="bi bi-trash"></i>
                                            </button>
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

<!-- Modal Tambah Kriteria -->
<div class="modal fade" id="tambahUkmModal" tabindex="-1" aria-labelledby="tambahUkmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUkmModalLabel">Tambah UKM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('ukm/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="idUkm" class="form-label">ID UKM</label>
                        <div class="input-group">
                            <span class="input-group-text" id="idKriteriaPrefix">UKM</span>
                            <input type="number" class="form-control" id="idUkm" name="idUkm" placeholder="Masukkan angka ID UKM" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ukm" class="form-label">Nama UKM</label>
                        <input type="text" class="form-control" id="nama" name="nama" maxlength="255" placeholder="Nama UKM" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tidak wajib (opsional)"></textarea>
                    </div>
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
                <form id="formHapusUkm" action="" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editUkmModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit UKM</h5>
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>
            <form id="editUkmForm">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden"
                        id="editUkmId"
                        name="idUkm">
                    <div class="mb-3">
                        <label class="form-label">Nama UKM</label>
                        <input type="text"
                            class="form-control"
                            id="editUkm"
                            name="nama"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control"
                            id="editDeskripsi"
                            name="deskripsi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tombolHapus = document.querySelectorAll('.btn-hapus');
        const formHapus = document.getElementById('formHapusUkm');

        tombolHapus.forEach(function(btn) {

            btn.addEventListener('click', function() {

                let id = this.getAttribute('data-id');

                formHapus.action = "<?= base_url('ukm/delete') ?>/" + id;

            });

        });

    });

    $('#userTable').DataTable({
        layout: {
            topStart: {
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:eq(3))'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:eq(3))'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:eq(3))'
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'portrait',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(:eq(3))'
                        },
                        customize: function(doc) {

                            var table = doc.content.find(function(item) {
                                return item.table;
                            });

                            if (table) {

                                table.table.widths = ['15%', '20%', '65%'];

                                table.table.body.forEach(function(row, index) {

                                    if (index > 0) { // selain header

                                        row[0].alignment = 'center'; // ID UKM
                                        row[1].alignment = 'left'; // Nama UKM
                                        row[2].alignment = 'left'; // Deskripsi

                                    }

                                });

                            }

                            doc.styles.title.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';

                        }
                    }
                ]
            }
        }
    });

    $(document).ready(function() {

        $('.editUkm').click(function() {

            let id = $(this).data('id');

            $.get(
                "<?= site_url('ukm/getById') ?>/" + id,
                function(data) {

                    $('#editUkmId').val(data.idUkm);
                    $('#editUkm').val(data.nama);
                    $('#editDeskripsi').val(data.deskripsi);
                }
            );
        });

        $('#editUkmForm').submit(function(e) {

            e.preventDefault();

            $.ajax({
                url: "<?= site_url('ukm/update') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",

                success: function(response) {

                    if (response.status === 'success') {

                        alert(response.message);

                        $('#editUkmModal').modal('hide');

                        location.reload();
                    }
                }
            });

        });

    });
</script>
<?= $this->endSection() ?>