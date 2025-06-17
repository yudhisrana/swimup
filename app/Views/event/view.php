<?= $this->extend('layout/default'); ?>

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
                                    : <a href="<?= base_url('event/' . $event->slug) ?>"><?= base_url('event/' . $event->slug) ?></a>
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
                                        <?= '<span class="badge badge-primary">Berjalan</span>' ?>
                                    <?php } elseif ($event->status === 'Selesai') { ?>
                                        <?= '<span class="badge badge-success">Selesai</span>' ?>
                                    <?php } else { ?>
                                        <?= '<span class="badge badge-danger">Gagal</span>' ?>
                                    <?php } ?>
                                </dd>

                                <dt class="col-sm-3">Dibuat Oleh</dt>
                                <dd class="col-sm-9">: <?= esc($creator->name); ?></dd>

                                <dt class="col-sm-3">Diupdate Oleh</dt>
                                <dd class="col-sm-9">: <?= $editor['name'] ? esc($editor['name']) : '-'; ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>