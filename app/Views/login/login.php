<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/toastr/toastr.min.css" />

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <p class="h1"><b>Admin</b><br>Global Bakery</p>
            </div>
            <div class="card-body">

                <form action="<?php echo (base_url()) ?>dashboard" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-eye cursor-pointer" id="togglePassword"></span>
                            </div>
                        </div>
                    </div>

                    <div class="social-auth-links text-center mt-2 mb-3">
                        <button type="submit" class="btn btn-block btn-warning">
                            Sign in
                        </button>
                    </div>

                    <?php if (session()->getFlashdata('error_login')) : ?>
                        <div class="alert alert-danger d-block" role="alert" id="loginAlert">
                            <?= session()->getFlashdata('error_login') ?>
                        </div>
                    <?php endif; ?>
                </form>
                <!-- /.social-auth-links -->

                <p class="mb-1 text-center">
                    <a href="login/forgotPass">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/toastr/toastr.min.js"></script>

    <!-- Lihat Pass -->
    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                var passwordInput = $('#password');
                var passwordFieldType = passwordInput.attr('type');
                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    $(this).removeClass('fas fa-eye').addClass('far fa-eye');
                } else {
                    passwordInput.attr('type', 'password');
                    $(this).removeClass('far fa-eye').addClass('fas fa-eye');
                }
            });
        });
    </script>
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    <script>
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
            });
            <?php if (session()->getFlashdata('success')) : ?>
                toastr.success(
                    '<?= session()->getFlashdata('success') ?>'
                );
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                toastr.error(
                    '<?= session()->getFlashdata('error') ?>'
                );
            <?php endif; ?>
        });
    </script>

</body>

</html>