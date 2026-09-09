<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

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

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">
                        Form Rekomendasi UKM
                    </h5>
                </div>

                <div class="card-body pt-4">

                    <p class="text-muted mb-4">
                        Pilih 3 sampai 5 kriteria yang sesuai dengan minat dan kemampuan Anda.
                    </p>

                    <form id="kriteriaForm">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label">
                                Nama
                            </label>

                            <input type="text"
                                   id="nama"
                                   class="form-control"
                                   maxlength="100"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                NIM
                            </label>

                            <input type="number"
                                   id="nim"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Pilih 3 sampai 5 Kriteria
                            </label>

                            <div class="border rounded p-3">

                                <?php foreach ($kriteria as $k): ?>

                                    <div class="form-check mb-2">

                                        <input class="form-check-input kriteria"
                                               type="checkbox"
                                               value="<?= $k['idKriteria'] ?>"
                                               id="<?= $k['idKriteria'] ?>">

                                        <label class="form-check-label"
                                               for="<?= $k['idKriteria'] ?>">

                                            <?= esc($k['kriteria']) ?>

                                        </label>

                                       <button type="button"
        class="btn btn-info btn-sm ms-2 btn-info-kriteria"
        data-deskripsi="<?= esc($k['deskripsi']) ?>">

    Info

</button>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        </div>

                        <button type="button"
                                class="btn btn-primary"
                                onclick="validateAndSubmit()">

                            <i class="bi bi-search"></i>
                            Lakukan Rekomendasi

                        </button>

                    </form>

                    <div id="hasilRekomendasi" class="mt-4"></div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Modal Kriteria -->
<div class="modal fade"
     id="kriteriaModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Deskripsi Kriteria
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body"
                 id="modalBody">
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>

// Modal info kriteria
$(document).on('click', '.btn-info-kriteria', function(){

    let deskripsi = $(this).data('deskripsi');

    $('#modalBody').text(deskripsi);

    let modal = new bootstrap.Modal(
        document.getElementById('kriteriaModal')
    );

    modal.show();

});

function validateAndSubmit()
{
    let nama = $('#nama').val().trim();
    let nim = $('#nim').val().trim();

    let kriteria = [];

    $('.kriteria:checked').each(function(){

        kriteria.push($(this).val());

    });

    if(nama === '')
    {
        alert('Nama wajib diisi');
        $('#nama').focus();
        return;
    }

    if(nim === '')
    {
        alert('NIM wajib diisi');
        $('#nim').focus();
        return;
    }

    if(kriteria.length < 3 || kriteria.length > 5)
    {
        alert('Pilih 3 sampai 5 kriteria');
        return;
    }

    rekomendasi();
}

function rekomendasi()
{
    let kriteria = [];

    $('.kriteria:checked').each(function(){

        kriteria.push($(this).val());

    });

    $.ajax({

        url: "<?= site_url('rekomendasi/proses') ?>",

        type: "POST",

        dataType: "json",

        data: {

            nama: $('#nama').val(),
            nim: $('#nim').val(),
            kriteria: kriteria

        },

        success: function(response)
        {
            let html = '';

            if(response.status === 'success')
            {
                html += `
                    <div class="alert alert-success">

                       <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="mb-0">
            Hasil Rekomendasi
        </h4>

        <button type="button"
        class="btn btn-primary btn-sm"
        onclick="kirimMasukkan()">
    <i class="bi bi-file-earmark-text"></i>
    Laporkan error, kritik maupun saran
</button>

    </div>

                        <h5 class="fw-bold">
                        UKM Rekomendasi:
                            ${response.ukmUtama.nama}
                        </h5>

                        <p>
                            ${response.ukmUtama.deskripsi}
                        </p>

                        <p>
                            <strong>Alasan :</strong><br>
                            ${response.alasan}
                        </p>
                `;

                if(response.ukmOpsi)
                {
                    html += `
                        <hr>

                        <h5 class="fw-bold">
                            UKM Opsi :
                            ${response.ukmOpsi.nama}
                        </h5>

                        <p>
                            ${response.ukmOpsi.deskripsi}
                        </p>

                        <p>
                            <strong>Alasan Opsi :</strong><br>
                            ${response.alasanOpsi}
                        </p>
                    `;
                }

                html += `
                    </div>
                `;
            }
else
{
    html = `
        <div class="alert alert-warning">

            ${response.message}

            <hr>
<div class="d-flex justify-content-end">
            <button type="button"
                    class="btn btn-primary btn-sm"
                    onclick="kirimMasukkan()">

                <i class="bi bi-file-earmark-text"></i>
                Laporkan error

            </button>
</div>
        </div>
    `;
}

            $('#hasilRekomendasi').html(html);
        },

        error: function(xhr)
        {
            $('#hasilRekomendasi').html(`
                <div class="alert alert-danger">
                    Terjadi kesalahan pada server.
                </div>
            `);

            console.log(xhr.responseText);
        }

    });
}

function kirimMasukkan()
{
    let nama = $('#nama').val();
    let nim = $('#nim').val();

    let kriteria = [];

    $('.kriteria:checked').each(function () {

        kriteria.push($(this).val());

    });

    let url =
        "<?= base_url('masukkan') ?>" +
        "?nama=" + encodeURIComponent(nama) +
        "&nim=" + encodeURIComponent(nim) +
        "&kriteria=" + encodeURIComponent(kriteria.join(','));

    window.location.href = url;
}
</script>

<?= $this->endSection() ?>