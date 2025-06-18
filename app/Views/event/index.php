<?= $this->extend('layout/default'); ?>

<?= $this->section('style'); ?>
<!-- DataTables -->
<link
    rel="stylesheet"
    href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link
    rel="stylesheet"
    href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<link
    rel="stylesheet"
    href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />

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
                                <h3 class="card-title"><?= $table_name ?></h3>
                                <a href="/menu/event/create" type="button" class="btn btn-info">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table
                                id="tableEvent"
                                class="table table-bordered table-striped display nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Event</th>
                                        <th>Jumlah Peserta</th>
                                        <th>Tanggal Event</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tanggal Diupdate</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($event as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $value->name; ?></td>
                                            <td><?= $value->max_participant; ?></td>
                                            <td><?= date('d-m-Y H:i:s', strtotime($value->event_date)); ?></td>
                                            <td>
                                                <?php if ($value->status === 'Berjalan') { ?>
                                                    <?= '<span class="badge badge-primary">Berjalan</span>' ?>
                                                <?php } elseif ($value->status === 'Selesai') { ?>
                                                    <?= '<span class="badge badge-success">Selesai</span>' ?>
                                                <?php } else { ?>
                                                    <?= '<span class="badge badge-danger">Gagal</span>' ?>
                                                <?php } ?>
                                            </td>
                                            <td><?= $value->created_at ? date('d-m-Y H:i:s', strtotime($value->created_at)) : '-' ?></td>
                                            <td><?= $value->updated_at ? date('d-m-Y H:i:s', strtotime($value->updated_at)) : '-' ?></td>
                                            <td>
                                                <a href="<?= '/menu/event/show/' . $value->id ?>" type="button" class="btn btn-primary">
                                                    <i class="nav-icon fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- DataTables  & Plugins -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<!-- SweetAlert2 -->
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(function() {
        $("#tableEvent")
            .DataTable({
                responsive: false,
                lengthChange: false,
                autoWidth: false,
                scrollX: true,
                pageLength: 5,
                columnDefs: [{
                        targets: 0,
                        searchable: false,
                        width: '25px'
                    },
                    {
                        targets: 1,
                        searchable: true,
                    },
                    {
                        targets: 2,
                        searchable: true,
                    },
                    {
                        targets: 3,
                        searchable: true,
                    },
                    {
                        targets: 4,
                        searchable: true,
                    },
                    {
                        targets: 5,
                        searchable: true,
                    },
                    {
                        targets: 6,
                        searchable: true,
                    },
                    {
                        targets: 7,
                        searchable: false,
                        orderable: false,
                        className: 'text-center'
                    },
                ]
            })
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