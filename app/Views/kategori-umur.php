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
                                <button type="button" id="btnModalTambah" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table
                                id="tableKategoriUmur"
                                class="table table-bordered table-striped display nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori Umur</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tanggal Diupdate</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kategori_umur as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $value->name; ?></td>
                                            <td><?= $value->created_at ? date('d-m-Y H:i:s') : '-' ?></td>
                                            <td><?= $value->updated_at ? date('d-m-Y H:i:s') : '-' ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btnModalEdit"
                                                    data-id="<?= $value->id; ?>"
                                                    data-kategori_umur="<?= $value->name; ?>">
                                                    <i class="nav-icon fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btnModalDelete"
                                                    data-id="<?= $value->id; ?>">
                                                    <i class="nav-icon fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal -->
<div class="modal fade" id="modalKategoriUmur" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalKategoriUmurLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKategoriUmurLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <form id="formKategoriUmur">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="kategori_umur">Nama Kategori Umur</label>
                        <input type="text" class="form-control" id="kategori_umur" name="kategori_umur" placeholder="Masukan nama gaya">
                        <span id="kategori_umur-error" class="error invalid-feedback" style="display: none;"></span>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" id="cancelModal" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
                        <button type="submit" id="submitModal" class="btn btn-primary">-</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    // csrf token
    let csrfToken = "<?= csrf_token(); ?>"
    let csrfHash = "<?= csrf_hash(); ?>"

    $(function() {
        $("#tableKategoriUmur")
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
                        searchable: false,
                        orderable: false,
                        className: 'text-center'
                    }
                ]
            })
    });

    $(function() {
        // function reset
        function reset() {
            $('#formKategoriUmur')[0].reset();
            $('#kategori_umur').removeClass('is-invalid');
            $('#kategori_umur-error').text('').hide();
        }

        // modal tambah
        $('#btnModalTambah').click(function() {
            modeModal = 'tambah';
            url = baseUrl + 'master-data/kategori-umur/create';
            method = 'POST';

            $('#modalKategoriUmurLabel').text('Tambah Data');
            $('#submitModal').text('Simpan');
            $('#modalKategoriUmur').modal('show');
        });

        // modal edit
        $('.btnModalEdit').click(function() {
            const id = $(this).data('id')
            const kategoriUmur = $(this).data('kategori_umur')
            modeModal = 'edit';
            url = baseUrl + 'master-data/kategori-umur/update/' + id;
            method = 'POST';

            $('#modalKategoriUmurLabel').text('Edit Data');
            $('#submitModal').text('Update');
            $('#kategori_umur').val(kategoriUmur)
            $('#modalKategoriUmur').modal('show');
        });

        // tambah dan update
        $('#formKategoriUmur').submit(function(e) {
            e.preventDefault();
            const kategoriUmur = $('#kategori_umur').val();

            $.ajax({
                url: url,
                method: method,
                data: {
                    [csrfToken]: csrfHash,
                    kategori_umur: kategoriUmur,
                },
                success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            title: "Sukses",
                            text: res.message,
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errMsg = xhr.responseJSON.errors;
                        $('#kategori_umur').addClass('is-invalid');
                        $('#kategori_umur-error').text(errMsg.kategori_umur).show();
                    } else {
                        const errMsg = xhr.responseJSON.message;
                        Swal.fire({
                            title: 'Opsss..',
                            text: errMsg,
                            icon: "error"
                        })
                    }
                }
            })
        });

        // modal delete
        $('.btnModalDelete').click(function() {
            const id = $(this).data('id')
            url = baseUrl + 'master-data/kategori-umur/delete/' + id;
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

        // focus input saat modal ditampilkan
        $('#modalKategoriUmur').on('shown.bs.modal', function() {
            if (modeModal === 'tambah') {
                $('#kategori_umur').trigger('focus');
            }
        });

        // reset batal
        $('#cancelModal').click(function() {
            document.activeElement.blur();
            reset();
        });
    });
</script>
<?= $this->endSection(); ?>