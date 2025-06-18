<?= $this->extend('layout/public'); ?>

<?= $this->section('style'); ?>
<!-- SweetAlert2 -->
<link
    rel="stylesheet"
    href="/assets/plugins/sweetalert2/sweetalert2.min.css" />
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container w-50">
        <div class="card card-outline card-info shadow">
            <div class="card-header text-center">
                <h1 class="h4"><?= 'Form Pendaftaran ' . esc($event->name); ?></h1>
            </div>
            <div class="card-body">

                <!-- Informasi Event -->
                <div class="mb-4 p-3 border rounded bg-light">
                    <p class="mb-1"><strong>Tanggal Event:</strong> <?= date('d M Y, H:i', strtotime($event->event_date)) ?></p>
                    <p class="mb-1"><strong>Kuota Maksimum:</strong> <?= $event->max_participant ?> peserta</p>
                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge badge-<?= $event->status == 'Berjalan' ? 'success' : ($event->status == 'Selesai' ? 'secondary' : 'danger') ?>">
                            <?= esc($event->status) ?>
                        </span>
                    </p>
                </div>

                <!-- Jika status tidak berjalan dan quota sudah penuh, tampilkan alert -->
                <?php if (!$join_event) { ?>
                    <?php if ($event->status !== 'Berjalan') { ?>
                        <div class="alert alert-warning text-center">
                            Pendaftaran ditutup karena status event adalah : <strong><?= esc($event->status) ?></strong>.
                        </div>
                    <?php } elseif ($approved_count >= $event->max_participant) { ?>
                        <div class="alert alert-warning text-center">
                            Pendaftaran ditutup karena quota event sudah full.
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <!-- Form Pendaftaran -->
                    <?php $validation = session()->getFlashdata('validation') ?: [] ?>
                    <form id="form-registration" action="<?= '/regristrasi/event/store/' . $event->id; ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_peserta">Nama Peserta</label>
                                <input type="text" class="form-control <?= array_key_exists('nama_peserta', $validation) ? 'is-invalid' : '' ?>" id="nama_peserta" name="nama_peserta" value="<?= trim(old('nama_peserta')) ?>" placeholder="Nama Peserta">
                                <span id="nama_peserta-error" class="error invalid-feedback">
                                    <?= $validation['nama_peserta'] ?? '' ?>
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <div class="input-group date" id="tanggal_lahir" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input <?= array_key_exists('tanggal_lahir', $validation) ? 'is-invalid' : '' ?>" data-target="#tanggal_lahir" name="tanggal_lahir" value="<?= trim(old('tanggal_lahir')) ?>" placeholder="01/01/2025" />
                                    <div class="input-group-append" data-target="#tanggal_lahir" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <span id="tanggal_lahir-error" class="error invalid-feedback">
                                        <?= $validation['tanggal_lahir'] ?? '' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control <?= array_key_exists('jenis_kelamin', $validation) ? 'is-invalid' : '' ?>" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki - Laki</option>
                                    <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <span id="jenis_kelamin-error" class="error invalid-feedback">
                                    <?= $validation['jenis_kelamin'] ?? '' ?>
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control <?= array_key_exists('email', $validation) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= trim(old('email')) ?>" placeholder="user@email.com">
                                <span id="email-error" class="error invalid-feedback">
                                    <?= $validation['email'] ?? '' ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">No Telepon</label>
                                <input type="text" class="form-control <?= array_key_exists('phone', $validation) ? 'is-invalid' : '' ?>" id="phone" name="phone" value="<?= trim(old('phone')) ?>" placeholder="08123456789">
                                <span id="phone-error" class="error invalid-feedback">
                                    <?= $validation['phone'] ?? '' ?>
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Foto</label>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="image">Pilih Foto</label>
                                    <input type="file" class="form-control custom-file-input <?= array_key_exists('image', $validation) ? 'is-invalid' : '' ?>" id="image" name="image" onchange="imgPreview()">
                                    <span id="image-error" class="error invalid-feedback">
                                        <?= $validation['image'] ?? '' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" rows="3" class="form-control <?= array_key_exists('address', $validation) ? 'is-invalid' : '' ?>"><?= trim(old('address')) ?></textarea>
                            <span id="address-error" class="error invalid-feedback">
                                <?= $validation['address'] ?? '' ?>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">Kirim Pendaftaran</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<!-- SweetAlert2 -->
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    //Date picker
    $('#tanggal_lahir').datetimepicker({
        format: 'L'
    });

    // image preview
    function imgPreview() {
        const image = $('#image').get(0);
        const label = $('.custom-file-label');

        const file = image.files[0];
        file ? label.text(file.name) : label.text('Pilih Gambar');
    }

    // popup confirmation
    $(function() {
        $('#form-registration').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin mendaftar?',
                text: "Pastikan data yang kamu isi sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    });

    <?php if (session()->getFlashdata('success')) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('success') ?>'
        });
    <?php } ?>

    <?php if (session()->getFlashdata('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Opss..',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>