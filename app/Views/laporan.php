<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Laporan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Laporan</li>
        </ol>
    </nav>
</div>

<section class="section">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Laporan Riwayat Keputusan</h5>

            <div class="table-responsive">

                <table class="table table-bordered" id="userTable">

                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Kriteria Dipilih</th>
                            <th>Rekomendasi</th>
                            <th>Tanggal</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1; ?>
                        <?php foreach ($riwayat as $row) : ?>

                            <tr>

                                <td class="text-center">
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <?= esc($row['nama']); ?>
                                </td>

                                <td>
                                    <?= esc($row['nim']); ?>
                                </td>

                                <td>
                                    <?= esc($row['kriteriaTerpilih']); ?>
                                </td>

                                <td>
                                    <?= esc($row['rekomendasi']); ?>
                                </td>

                                <td class="text-center">
                                    <?= date('d-m-Y', strtotime($row['tanggal'])); ?>
                                </td>

                                <td class="text-center">

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm"
                                        onclick="hapusData(<?= $row['idRiwayat']; ?>)">

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

</section>

<form id="formHapus" method="post">
    <?= csrf_field(); ?>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>

function hapusData(id)
{
    if(confirm('Anda yakin ingin menghapus laporan ini?'))
    {
        let form = document.getElementById('formHapus');

        form.action = "<?= base_url('laporan/delete'); ?>/" + id;

        form.submit();
    }
}

$(document).ready(function () {

    $('#userTable').DataTable({

        layout: {
            topStart: {
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:eq(6))'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:eq(6))'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:eq(6))'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:eq(6))'
                        }
                    }
                ]
            }
        },

        order: [[5, 'desc']],

        drawCallback: function () {

            var api = this.api();

            api.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {

                cell.innerHTML = i + 1;

            });

        }

    });

});

</script>

<?= $this->endSection() ?>