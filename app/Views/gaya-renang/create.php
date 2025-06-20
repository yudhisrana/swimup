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
                                <a href="/master-data/gaya-renang" type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $validation = session()->getFlashdata('validation') ?>
                            <form action="/master-data/gaya-renang/store" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="gaya_renang">Gaya Renang</label>
                                    <input type="text" class="form-control <?= $validation && $validation->hasError('gaya_renang') ? 'is-invalid' : '' ?>" id="gaya_renang" name="gaya_renang" placeholder="Nama gaya renang" value="<?= old('gaya_renang') ?>">
                                    <span id="gaya_renang-error" class="error invalid-feedback">
                                        <?= $validation ? $validation->getError('gaya_renang') : '' ?>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button type="submit" id="submitModal" class="btn btn-info">Simpan</button>
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