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
                                <a href="/setting/user" type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $validation = session()->getFlashdata('validation') ?: [] ?>
                            <form action="<?= '/setting/user/update/' . $user->id; ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" id="old-img" name="old-img" value="<?= $user->image ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control <?= array_key_exists('name', $validation) ? 'is-invalid' : '' ?>" id="name" name="name" placeholder="Nama lengkap" value="<?= old('name', $user->name) ?>">
                                        <span id="name-error" class="error invalid-feedback">
                                            <?= $validation['name'] ?? '' ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" class="form-control <?= array_key_exists('role', $validation) ? 'is-invalid' : '' ?>">
                                            <option value="" selected disabled>Pilih Role</option>
                                            <?php foreach ($roles as $role) { ?>
                                                <option value="<?= $role->id; ?>" <?= old('role', $role->id) == $role->id ? 'selected' : '' ?>><?= $role->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="role-error" class="error invalid-feedback">
                                            <?= $validation['role'] ?? '' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control <?= array_key_exists('username', $validation) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Username" value="<?= old('username', $user->username) ?>">
                                        <span id="username-error" class="error invalid-feedback">
                                            <?= $validation['username'] ?? '' ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control <?= array_key_exists('password', $validation) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="******" value="<?= old('password') ?>">
                                        <span id="password-error" class="error invalid-feedback">
                                            <?= $validation['password'] ?? '' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control <?= array_key_exists('email', $validation) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="user@email.com" value="<?= old('email', $user->email) ?>">
                                        <span id="email-error" class="error invalid-feedback">
                                            <?= $validation['email'] ?? '' ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">No Tlp</label>
                                        <input type="text" class="form-control <?= array_key_exists('phone', $validation) ? 'is-invalid' : '' ?>" id="phone" name="phone" placeholder="08123456789" value="<?= old('phone', $user->phone) ?>">
                                        <span id="phone-error" class="error invalid-feedback">
                                            <?= $validation['phone'] ?? '' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" rows="3" class="form-control <?= array_key_exists('address', $validation) ? 'is-invalid' : '' ?>"><?= trim(old('address', $user->address)) ?></textarea>
                                    <span id="address-error" class="error invalid-feedback">
                                        <?= $validation['address'] ?? '' ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="image">Pilih gambar</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="image"><?= $user->image; ?></label>
                                        <input type="file" class="custom-file-input <?= array_key_exists('image', $validation) ? 'is-invalid' : '' ?>" id="image" name="image" onchange="imgPreview()">
                                    </div>
                                    <span id="image-error" class="error invalid-feedback">
                                        <?= $validation['image'] ?? '' ?>
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
    function imgPreview() {
        const image = $('#image').get(0);
        const label = $('.custom-file-label');

        const file = image.files[0];
        file ? label.text(file.name) : label.text('Pilih Gambar');
    }

    <?php if (session()->getFlashdata('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Opss..',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>