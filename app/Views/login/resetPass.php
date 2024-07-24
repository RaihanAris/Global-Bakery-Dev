<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Reset Password (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://localhost:8080/Global-Bakery-Dev/public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="http://localhost:8080/Global-Bakery-Dev/public/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost:8080/Global-Bakery-Dev/public/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <p class="h1"><b>Admin</b><br>Global Bakery</p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masukkan Password Baru.</p>
                <form action="#" method="post">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning btn-block">Change password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 mb-1 text-center">
                    <a href="<?php echo (base_url()) ?>">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="http://localhost:8080/Global-Bakery-Dev/public/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="http://localhost:8080/Global-Bakery-Dev/public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="http://localhost:8080/Global-Bakery-Dev/public/adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>