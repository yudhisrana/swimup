<?= $this->extend('layout/default'); ?>

<?= $this->section('style'); ?>
<!-- SweetAlert2 -->
<link
    rel="stylesheet"
    href="/assets/plugins/sweetalert2/sweetalert2.min.css" />
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title"><?= $form_name; ?></h3>
                                <a href="/master-data/kategori-umur" type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $validation = session()->getFlashdata('validation') ?>
                            <form action="<?= '/master-data/kategori-umur/update/' . $kategori_umur->id; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="kategori_umur">Kategori Umur</label>
                                    <input type="text" class="form-control <?= $validation && $validation->hasError('kategori_umur') ? 'is-invalid' : '' ?>" id="kategori_umur" name="kategori_umur" placeholder="Kategori umur" value="<?= old('kategori_umur', $kategori_umur->name) ?>">
                                    <span id="kategori_umur-error" class="error invalid-feedback">
                                        <?= $validation ? $validation->getError('kategori_umur') : '' ?>
                                    </span>
                                </div>
                                <div>
                                    <button type="submit" id="submitModal" class="btn btn-info">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- SweetAlert2 -->
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    <?php if (session()->getFlashdata('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Opss..',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>