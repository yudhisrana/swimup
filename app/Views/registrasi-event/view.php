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
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title"><?= $card_name; ?></h3>
                                <a href="/menu/registrasi-event" type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Kolom Foto -->
                                <div class="col-md-4 text-center mb-4">
                                    <?php if (!empty($peserta->image)) : ?>
                                        <img src="<?= base_url('/assets/img/registration/' . $peserta->image) ?>" alt="Foto Peserta" class="img-fluid img-thumbnail" style="max-height: 300px;">
                                    <?php else : ?>
                                        <div class="border p-4">Tidak ada foto</div>
                                    <?php endif; ?>
                                </div>

                                <!-- Kolom Biodata -->
                                <div class="col-md-8">
                                    <dl class="row">
                                        <dt class="col-sm-4">Nama Event</dt>
                                        <dd class="col-sm-8">: <?= esc($peserta->event_name); ?></dd>

                                        <dt class="col-sm-4">Nama Peserta</dt>
                                        <dd class="col-sm-8">: <?= esc($peserta->nama_peserta); ?></dd>

                                        <dt class="col-sm-4">Tanggal Lahir</dt>
                                        <dd class="col-sm-8">: <?= date('d M Y', strtotime($peserta->tanggal_lahir)); ?></dd>

                                        <dt class="col-sm-4">Jenis Kelamin</dt>
                                        <dd class="col-sm-8">: <?= esc($peserta->gender === 'L' ? 'Laki-laki' : 'Perempuan'); ?></dd>

                                        <dt class="col-sm-4">Email</dt>
                                        <dd class="col-sm-8">: <?= esc($peserta->email); ?></dd>

                                        <dt class="col-sm-4">No Telepon</dt>
                                        <dd class="col-sm-8">: <?= esc($peserta->phone); ?></dd>

                                        <dt class="col-sm-4">Alamat</dt>
                                        <dd class="col-sm-8">: <?= esc($peserta->address); ?></dd>

                                        <dt class="col-sm-4">Status</dt>
                                        <dd class="col-sm-8">
                                            <?php if ($peserta->status === 'Disetujui') : ?>
                                                <span class="badge badge-success"><?= esc($peserta->status) ?></span>
                                            <?php elseif ($peserta->status === 'Pending') : ?>
                                                <span class="badge badge-warning"><?= esc($peserta->status) ?></span>
                                            <?php else : ?>
                                                <span class="badge badge-danger"><?= esc($peserta->status) ?></span>
                                            <?php endif; ?>
                                        </dd>

                                        <dt class="col-sm-4">Didaftarkan Pada</dt>
                                        <dd class="col-sm-8">: <?= date('d M Y H:i', strtotime($peserta->created_at)); ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <!-- Tombol Disetujui dan Ditolak -->
                            <div class="d-flex align-items-center justify-content-end">
                                <button class="btn btn-info btn-modal"
                                    data-id="<?= $peserta->id; ?>"
                                    data-mode="update"
                                    data-status="Disetujui">
                                    <i class="fas fa-check mr-1"></i>
                                    Disetujui
                                </button>

                                <button class="btn btn-danger ml-2 btn-modal"
                                    data-id="<?= $peserta->id; ?>"
                                    data-mode="update"
                                    data-status="Ditolak">
                                    <i class="fas fa-times mr-1"></i>
                                    Ditolak
                                </button>

                                <?php if (session()->get('role_id') != 3) { ?>
                                    <button class="btn btn-danger ml-2 btn-modal"
                                        data-id="<?= $peserta->id; ?>"
                                        data-mode="hapus">
                                        <i class="fas fa-trash-alt mr-1"></i>
                                        Hapus
                                    </button>
                                <?php } ?>
                            </div>
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
    let mode = '';
    let title = '';
    let text = '';
    let icon = '';
    let confirmColor = '';
    let url = '';
    let method = '';

    // sweet alert button
    $(function() {
        $('.btn-modal').click(function() {
            const baseUrl = '<?= base_url(); ?>'
            const csrfToken = '<?= csrf_token(); ?>'
            const csrfHash = '<?= csrf_hash(); ?>'

            const id = $(this).data('id')
            mode = $(this).data('mode')
            const status = $(this).data('status')

            if (mode == "update") {
                title = "Update data peserta?";
                text = "Data peserta " + status;
                icon = "question";
                confirmColor = "#17a2b8";
                url = baseUrl + "menu/registrasi-event/update/" + id;
                method = "POST";
            } else {
                title = "Yakin hapus data?";
                text = "Data yang dihapus tidak dapat dikembalikan!";
                icon = "warning";
                confirmColor = "#C82333";
                url = baseUrl + "menu/registrasi-event/delete/" + id;
                method = "POST";
            }

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmColor,
                confirmButtonText: "Ya, " + mode + '!',
                cancelButtonColor: "#5A6268",
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: method,
                        data: {
                            [csrfToken]: csrfHash,
                            status: status,
                        },
                        success: function(res) {
                            if (res.success) {
                                Swal.fire({
                                    title: status,
                                    text: res.message,
                                    icon: "success"
                                }).then(() => {
                                    if (mode == 'update') {
                                        location.reload();
                                    } else {
                                        window.location.href = baseUrl + "/menu/registrasi-event/";
                                    }
                                })
                            }
                        },
                        error: function(xhr) {
                            const errMsg = xhr.responseJSON.message;
                            Swal.fire({
                                title: 'Opsss..',
                                text: errMsg,
                                icon: "error"
                            })
                        }
                    })
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>