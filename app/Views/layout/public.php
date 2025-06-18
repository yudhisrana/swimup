<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        <?= $title; ?>
    </title>

    <link rel="icon" href="<?= base_url('assets/img/logo.png'); ?>" type="image/gif">
    <!-- Google Font: Source Sans Pro -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="/assets/plugins/fontawesome-free/css/all.min.css" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- SweetAlert2 -->
    <link
        rel="stylesheet"
        href="/assets/plugins/sweetalert2/sweetalert2.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/css/adminlte.min.css" />

    <!-- additional style -->
    <?= $this->renderSection('style'); ?>
</head>

<body class="hold-transition">
    <?= $this->renderSection('content'); ?>

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- InputMask -->
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/js/adminlte.min.js"></script>

    <!-- additional script -->
    <?= $this->renderSection('script'); ?>
</body>

</html>