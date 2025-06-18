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
                                <div class="py-2">
                                    <h3 class="card-title"><?= $table_name ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table
                                id="tablePendaftaran"
                                class="table table-bordered table-striped display nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Event</th>
                                        <th>Status</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendaftaran as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= esc($value->nama_peserta); ?></td>
                                            <td><?= esc($value->event_name); ?></td>
                                            <td>
                                                <?php if ($value->status === 'Pending') { ?>
                                                    <?= '<span class="badge badge-warning">Pending</span>' ?>
                                                <?php } elseif ($value->status === 'Disetujui') { ?>
                                                    <?= '<span class="badge badge-success">Disetujui</span>' ?>
                                                <?php } else { ?>
                                                    <?= '<span class="badge badge-danger">Ditolak</span>' ?>
                                                <?php } ?>
                                            </td>
                                            <td><?= date('d-m-Y H:i:s', strtotime($value->created_at)); ?></td>
                                            <td>
                                                <a href="<?= '/menu/registrasi-event/show/' . $value->id ?>" type="button" class="btn btn-primary">
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
        $("#tablePendaftaran")
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
                        searchable: false,
                        orderable: false,
                        className: 'text-center',
                    },
                ]
            })
    });

    // sweet alert delete
    $(function() {
        $('.btn-delete').click(function() {
            const baseUrl = '<?= base_url(); ?>'
            const csrfToken = '<?= csrf_token(); ?>'
            const csrfHash = '<?= csrf_hash(); ?>'

            const id = $(this).data('id')
            url = baseUrl + 'setting/user/delete/' + id;
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
                                    location.reload();
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

    <?php if (session()->getFlashdata('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Opss..',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    <?php } ?>
</script>
<?= $this->endSection(); ?>