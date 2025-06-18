<?= $this->extend('layout/default'); ?>

<?= $this->section('style'); ?>
<!-- SweetAlert2 -->
<link
    rel="stylesheet"
    href="/assets/plugins/sweetalert2/sweetalert2.min.css" />
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
                                <a href="<?= '/menu/event/show/' . $event->id; ?>" type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $validation = session()->getFlashdata('validation') ?>
                            <form action="<?= '/menu/event/update/' . $event->id; ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="event_name">Nama Event</label>
                                        <input type="text" class="form-control <?= $validation && $validation->hasError('event_name') ? 'is-invalid' : '' ?>" id="event_name" name="event_name" placeholder="Nama Event" value="<?= old('event_name', $event->name) ?>">
                                        <span id="event_name-error" class="error invalid-feedback">
                                            <?= $validation ? $validation->getError('event_name') : '' ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kategori_umur">Kategori Umur</label>
                                        <select name="kategori_umur" id="kategori_umur" class="form-control <?= $validation && $validation->hasError('kategori_umur') ? 'is-invalid' : '' ?>">
                                            <option value="" selected disabled>Pilih Kategori Umur</option>
                                            <?php foreach ($kategori_umur as $kategoriUmur) { ?>
                                                <option value="<?= $kategoriUmur->id ?>" <?= old('kategori_umur', $kategoriUmur->id) == $kategoriUmur->id ? 'selected' : '' ?>><?= $kategoriUmur->name ?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="kategori_umur-error" class="error invalid-feedback">
                                            <?= $validation ? $validation->getError('kategori_umur') : '' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gaya_renang">Gaya Renang</label>
                                        <select name="gaya_renang" id="gaya_renang" class="form-control <?= $validation && $validation->hasError('gaya_renang') ? 'is-invalid' : '' ?>">
                                            <option value="" selected disabled>Pilih Gaya Renang</option>
                                            <?php foreach ($gaya_renang as $gayaRenang) { ?>
                                                <option value="<?= $gayaRenang->id ?>" <?= old('gaya_renang', $gayaRenang->id) == $gayaRenang->id ? 'selected' : '' ?>><?= $gayaRenang->name ?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="gaya_renang-error" class="error invalid-feedback">
                                            <?= $validation ? $validation->getError('gaya_renang') : '' ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jarak_renang">Jarak Renang</label>
                                        <select name="jarak_renang" id="jarak_renang" class="form-control <?= $validation && $validation->hasError('jarak_renang') ? 'is-invalid' : '' ?>">
                                            <option value="" selected disabled>Pilih Jarak Renang</option>
                                            <?php foreach ($jarak_renang as $jarakRenang) { ?>
                                                <option value="<?= $jarakRenang->id ?>" <?= old('jarak_renang', $jarakRenang->id) == $jarakRenang->id ? 'selected' : '' ?>><?= $jarakRenang->name ?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="jarak_renang-error" class="error invalid-feedback">
                                            <?= $validation ? $validation->getError('jarak_renang') : '' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="jumlah_peserta">Jumlah Peserta</label>
                                        <input type="text" class="form-control <?= $validation && $validation->hasError('jumlah_peserta') ? 'is-invalid' : '' ?>" id="jumlah_peserta" name="jumlah_peserta" placeholder="50" value="<?= old('jumlah_peserta', $event->max_participant) ?>">
                                        <span id="jumlah_peserta-error" class="error invalid-feedback">
                                            <?= $validation ? $validation->getError('jumlah_peserta') : '' ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tanggal_event">Tanggal Event</label>
                                        <div class="input-group date" id="tanggal_event" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input <?= $validation && $validation->hasError('tanggal_event') ? 'is-invalid' : '' ?>" data-target="#tanggal_event" name="tanggal_event" placeholder="06/17/2025 00:00 AM" value="<?= old('tanggal_event', date('m/d/Y h:i A', strtotime($event->event_date))) ?>">
                                            <div class="input-group-append" data-target="#tanggal_event" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span id="tanggal_event-error" class="error invalid-feedback">
                                            <?= $validation ? $validation->getError('tanggal_event') : '' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi Event</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control <?= $validation && $validation->hasError('deskripsi') ? 'is-invalid' : '' ?>"><?= old('deskripsi', $event->description) ?></textarea>
                                    <span id="deskripsi-error" class="error invalid-feedback">
                                        <?= $validation ? $validation->getError('deskripsi') : '' ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Berjalan" <?= old('status', $event->status) == 'Berjalan' ? 'selected' : '' ?>>Berjalan</option>
                                        <option value="Selesai" <?= old('status', $event->status) == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                        <option value="Gagal" <?= old('status', $event->status) == 'Gagal' ? 'selected' : '' ?>>Gagal</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
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
<!-- InputMask -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
    //Date and time picker
    $('#tanggal_event').datetimepicker({
        icons: {
            time: 'far fa-clock'
        },
    });

    <?php if (session()->getFlashdata('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Opss..',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>