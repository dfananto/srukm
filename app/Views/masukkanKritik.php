<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Masukan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Laporkan error, Masukan, kritik dan saran</li>
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

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0">
                        Form Kritik dan Saran
                    </h5>
                </div>

                <div class="card-body pt-4">

                    <form action="<?= base_url('masukkan/simpan') ?>"
                          method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label">
                                Nama
                            </label>

                            <input type="text"
                                   name="nama"
                                   class="form-control" placeholder="Nama kamu...">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                NIM
                            </label>

                            <input type="text"
                                   name="nim"
                                   class="form-control" placeholder="NIM kamu...">

                        </div>

                        <div class="mb-3">

                        <div class="mb-3">

                            <label class="form-label">
                                Kritik / Saran
                            </label>

                            <textarea name="masukkan"
                                      class="form-control"
                                      rows="5"
                                      placeholder="Masukkan kritik atau saran..."
                                      required></textarea>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="<?= base_url('tentang') ?>"
                               class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>
                                Kembali

                            </a>

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-send"></i>
                                Kirim

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>
<?= $this->endSection() ?>