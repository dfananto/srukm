<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Rule</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Rule</li>
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
                        Rule Yang Bertindak Sebagai Mesin Inferensi
                    </h5>

                    <button class="btn btn-primary mb-2"
                        data-bs-toggle="modal"
                        data-bs-target="#tambahRuleModal">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Rule
                    </button>

                    <div class="table-responsive">

                        <table id="userTable" class="table">

                            <thead>
                                <tr>
                                    <th>ID Rule</th>
                                    <th>Kriteria Terpilih</th>
                                    <th>Keputusan</th>
                                    <th>Opsi Keputusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($rule as $r): ?>

                                    <tr>
                                        <td class="text-center"><?= esc($r['idRule']) ?></td>
                                        <td class="text-center"><?= esc($r['kriteriaTerpilih']) ?></td>
                                        <td class="text-center"> <span
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="<?= esc($r['alasan']) ?>">
                                                <?= esc($r['namaUkm']) ?>
                                            </span></td>
                                        <td class="text-center"> <?php if (!empty($r['namaOpsi'])) : ?>
                                                <span
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="<?= esc($r['alasanOpsi']) ?>">
                                                    <?= esc($r['namaOpsi']) ?>
                                                </span>
                                            <?php else : ?>
                                                -
                                                <?php endif; ?>
                                        </td>

                                        <td>
                                            <button
                                                class="btn btn-danger btn-sm btn-hapus hapusKriteria mt-1"
                                                data-id="<?= $r['idRule']; ?>"
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

<div class="modal fade"
    id="tambahRuleModal"
    tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah Rule
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <form id="tambahRuleForm">

                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">
                            ID Rule
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">R</span>
                            <input type="number"
                                class="form-control"
                                id="idRule"
                                name="idRule"
                                required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Kriteria Terpilih
                        </label>
                        <div id="kriteriaCheckboxContainer" name="kriteria[]"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Keputusan
                        </label>

                        <div id="ukmRadioContainer" name="keputusan"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Alasan
                        </label>

                        <textarea class="form-control"
                            id="alasan" name="alasan" placeholder="Masukkan alasan..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Opsi
                        </label>

                        <div id="ukmRadioContainerOpsi" name="opsi"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Alasan Opsi
                        </label>

                        <textarea class="form-control"
                            id="alasanOpsi" placeholder="Masukkan alasan opsi..."></textarea>
                    </div>

                    <button type="submit"
                        class="btn btn-primary">
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
                <form id="formHapusRule" action="" method="post">
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
    $(document).on('click', '.btn-hapus', function() {

        let id = $(this).data('id');

        $('#formHapusRule').attr(
            'action',
            "<?= base_url('rule/delete') ?>/" + id
        );

        console.log('ID:', id);
        console.log('ACTION:', $('#formHapusRule').attr('action'));
    });


    $('#userTable').DataTable({
        layout: {
            topStart: {
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:eq(4))'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:eq(4))'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:eq(4))'
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'portrait',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(:eq(4))'
                        },
                        customize: function(doc) {

                            var table = doc.content.find(function(item) {
                                return item.table;
                            });

                            if (table) {

                                table.table.widths = ['20%', '30%', '25%', '25%'];

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

    function loadKriteriaUkm() {

        $.get("<?= site_url('rule/getKriteria') ?>", function(data) {

            $('#kriteriaCheckboxContainer').empty();

            data.forEach(function(item) {

                $('#kriteriaCheckboxContainer').append(`
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           value="${item.idKriteria}">

                    <label class="form-check-label">
                        ${item.idKriteria} - ${item.kriteria}
                    </label>
                </div>
            `);

            });

        });

        $.get("<?= site_url('rule/getUkm') ?>", function(data) {

            $('#ukmRadioContainer').empty();
            $('#ukmRadioContainerOpsi').empty();

            data.forEach(function(item) {

                $('#ukmRadioContainer').append(`
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="idUkm"
                           value="${item.idUkm}">

                    <label class="form-check-label">
                        ${item.nama}
                    </label>
                </div>
            `);

                $('#ukmRadioContainerOpsi').append(`
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="opsi"
                           value="${item.idUkm}">

                    <label class="form-check-label">
                        ${item.nama}
                    </label>
                </div>
            `);

            });

        });

    }

    $('#tambahRuleModal').on('shown.bs.modal', function() {

        loadKriteriaUkm();

    });

    $('#tambahRuleForm').submit(function(e) {

        e.preventDefault();

        let kriteria = [];

        $('#kriteriaCheckboxContainer input:checked').each(function() {

            kriteria.push($(this).val());

        });

        $.ajax({

            url: "<?= site_url('rule/store') ?>",
            type: "POST",
            dataType: "json",

            data: {
                idRule: $('#idRule').val(),
                kriteriaTerpilih: kriteria.join(','),
                idUkm: $('input[name=idUkm]:checked').val(),
                opsi: $('input[name=opsi]:checked').val(),
                alasan: $('#alasan').val(),
                alasanOpsi: $('#alasanOpsi').val()
            },

            success: function(response) {

                alert(response.message);

                if (response.status === 'success') {
                    location.reload();
                }

            },

            error: function(xhr) {

                console.log(xhr.responseText);

                alert(xhr.responseText);

            }

        });

    });

    document.addEventListener('DOMContentLoaded', function () {

    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );

    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

});

</script>

<?= $this->endSection() ?>