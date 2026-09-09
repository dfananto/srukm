<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Kelola Masukan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Kelola masukan</li>
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

            <h5 class="card-title">Masukan kritik dan saran</h5>

            <div class="table-responsive">

                <table class="table table-bordered" id="userTable">

                    <thead>
                        <tr>
                            <th width="2%">No</th>
                            <th>Nama</th>
                            <th>Kriteria Dipilih</th>
                            <th>Masukkan</th>
                            <th width="15%">Tanggal</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1; ?>
                        <?php foreach ($masukkan as $m) : ?>

                            <tr>

                                <td class="text-center">
                                    <?= $no++; ?>
                                </td>

                                <td>
                                    <?= esc($m['nama']); ?>
                                </td>
                                <td>
                                    <?= esc($m['kriteriaTerpilih']); ?>
                                </td>

                                <td>
                                    <?= esc($m['masukkan']); ?>
                                </td>

                                <td class="text-center">
                                    <?= date('d-m-Y', strtotime($m['tanggal'])); ?>
                                </td>

                                <td class="text-center">

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm"
                                        onclick="hapusData(<?= $m['idMasukkan']; ?>)">

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

        form.action = "<?= base_url('masukkan/delete'); ?>/" + id;

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
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:eq(5))'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:eq(5))'
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