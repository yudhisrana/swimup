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
                                <h3 class="card-title"><?= $card_name; ?></h3>
                                <a href="/menu/event" type="button" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Nama Event</dt>
                                <dd class="col-sm-9">: <?= esc($event->name); ?></dd>

                                <dt class="col-sm-3">Link Event</dt>
                                <dd class="col-sm-9">
                                    : <a href="<?= base_url('regristrasi/event/' . $event->slug) ?>" target="_blank"><?= base_url('regristrasi/event/' . $event->slug) ?></a>
                                </dd>

                                <dt class="col-sm-3">Kategori Umur</dt>
                                <dd class="col-sm-9">: <?= esc($event->kategori_umur_name); ?></dd>

                                <dt class="col-sm-3">Gaya Renang</dt>
                                <dd class="col-sm-9">: <?= esc($event->gaya_renang_name); ?></dd>

                                <dt class="col-sm-3">Jarak Renang</dt>
                                <dd class="col-sm-9">: <?= esc($event->jarak_renang_name); ?></dd>

                                <dt class="col-sm-3">Jumlah Peserta</dt>
                                <dd class="col-sm-9">: <?= esc($event->max_participant); ?></dd>

                                <dt class="col-sm-3">Tanggal Event</dt>
                                <dd class="col-sm-9">: <?= date('d M Y H:i A', strtotime($event->event_date)); ?></dd>

                                <dt class="col-sm-3">Deskripsi</dt>
                                <dd class="col-sm-9">: <?= esc($event->description); ?></dd>

                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9">:
                                    <?php if ($event->status === 'Berjalan') { ?>
                                        <span class="badge badge-primary"><?= $event->status; ?></span>
                                    <?php } elseif ($event->status === 'Selesai') { ?>
                                        <span class="badge badge-success"><?= $event->status; ?></span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger"><?= $event->status; ?></span>
                                    <?php } ?>
                                </dd>

                                <dt class="col-sm-3">Dibuat Oleh</dt>
                                <dd class="col-sm-9">: <?= esc($creator->name); ?></dd>

                                <dt class="col-sm-3">Diupdate Oleh</dt>
                                <dd class="col-sm-9">: <?= $editor->name ? esc($editor->name) : '-'; ?></dd>
                            </dl>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex align-items-center justify-content-end">
                                <a href="<?= '/menu/event/edit/' . $event->id ?>" type="button" class="btn btn-warning">
                                    <i class="nav-icon fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-delete ml-2"
                                    data-id="<?= $event->id; ?>">
                                    <i class="nav-icon fas fa-trash-alt mr-1"></i>
                                    Hapus
                                </button>
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
    // sweet alert delete
    $(function() {
        $('.btn-delete').click(function() {
            const baseUrl = '<?= base_url(); ?>'
            const csrfToken = '<?= csrf_token(); ?>'
            const csrfHash = '<?= csrf_hash(); ?>'

            const id = $(this).data('id')
            url = baseUrl + 'menu/event/delete/' + id;
            method = 'POST';

            Swal.fire({
                title: "Yakin hapus data?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#C82333",
                confirmButtonText: "Ya, hapus!",
                cancelButtonColor: "#5A6268",
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: method,
                        data: {
                            [csrfToken]: csrfHash,
                        },
                        success: function(res) {
                            if (res.success) {
                                Swal.fire({
                                    title: "Dihapus",
                                    text: res.message,
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = baseUrl + "/menu/event/";
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

    <?php if (session()->getFlashdata('success')) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('success') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>