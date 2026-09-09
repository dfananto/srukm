<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Kelola Data Kriteria</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                Kelola Data Kriteria
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
                        Daftar Kriteria Tersedia
                    </h5>
                    <?php if (session()->get('role') == 'admin') : ?>
                        <button class="btn btn-primary btn-sm mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#tambahKriteriaModal">
                            <i class="bi bi-plus"></i>
                            Tambah Kriteria
                        </button>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="userTable" class="table">
                            <thead>
                                <tr>
                                    <th>ID Kriteria</th>
                                    <th>Kriteria</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kriteria as $k) : ?>
                                    <tr>
                                        <td class="text-center"><?= esc($k['idKriteria']) ?></td>
                                        <td><?= esc($k['kriteria']) ?></td>
                                        <td><?= esc($k['deskripsi']) ?></td>
                                        <td>
                                            <button
                                                class="btn btn-primary btn-sm editKriteria"
                                                data-id="<?= $k['idKriteria']; ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editKriteriaModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger btn-sm btn-hapus hapusKriteria mt-1"
                                                data-id="<?= $k['idKriteria']; ?>"
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
<div class="modal fade" id="tambahKriteriaModal" tabindex="-1" aria-labelledby="tambahKriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKriteriaModalLabel">Tambah Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('kriteria/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="idKriteria" class="form-label">ID Kriteria</label>
                        <div class="input-group">
                            <span class="input-group-text" id="idKriteriaPrefix">K</span>
                            <input type="number" class="form-control" id="idKriteria" name="idKriteria" placeholder="Masukkan angka ID Kriteria" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kriteria" class="form-label">Kriteria</label>
                        <input type="text" class="form-control" id="kriteria" name="kriteria" maxlength="255" placeholder="Minat, Bakat atau Asset" required>
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
                <form id="formHapusKriteria" action="" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editKriteriaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kriteria</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>
            <form id="editKriteriaForm">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden"
                           id="editKriteriaId"
                           name="idKriteria">
                    <div class="mb-3">
                        <label class="form-label">Kriteria</label>
                        <input type="text"
                               class="form-control"
                               id="editKriteria"
                               name="kriteria"
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
        const formHapus = document.getElementById('formHapusKriteria');

        tombolHapus.forEach(function(btn) {

            btn.addEventListener('click', function() {

                let id = this.getAttribute('data-id');

                formHapus.action = "<?= base_url('kriteria/delete') ?>/" + id;

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
    
    $(document).ready(function () {

    $('.editKriteria').click(function () {

        let id = $(this).data('id');

        $.get(
            "<?= site_url('kriteria/getById') ?>/" + id,
            function (data) {

                $('#editKriteriaId').val(data.idKriteria);
                $('#editKriteria').val(data.kriteria);
                $('#editDeskripsi').val(data.deskripsi);
            }
        );
    });

    $('#editKriteriaForm').submit(function (e) {

    e.preventDefault();

    $.ajax({
        url: "<?= site_url('kriteria/update') ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",

        success: function (response) {

            if (response.status === 'success') {

                alert(response.message);

                $('#editKriteriaModal').modal('hide');

                location.reload();
            }
        }
    });

});

});
</script>
<?= $this->endSection() ?>