<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        <?= $title; ?>
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="/assets/plugins/fontawesome-free/css/all.min.css" />
    <!-- SweetAlert2 -->
    <link
        rel="stylesheet"
        href="/assets/plugins/sweetalert2/sweetalert2.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/css/adminlte.min.css" />
</head>

<body class="hold-transition login-page">
    <?= $this->renderSection('content'); ?>

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/js/adminlte.min.js"></script>

    <?= $this->renderSection('script'); ?>
</body>

</html>