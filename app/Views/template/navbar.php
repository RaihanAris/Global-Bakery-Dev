<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title; ?></title>

    <!-- Responsive Display -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/responsive.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/toastr/toastr.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/adminlte.min.css" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/daterangepicker/daterangepicker.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/summernote/summernote-bs4.min.css" />

</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <a class="nav-link" href="<?php echo (base_url()) ?>profile">
                    <?= session()->get('userRole') ?>, <?= session()->get('userName') ?> <i class="far fa-user pl-2"></i>
                </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?php echo base_url(); ?>assets/adminlte/dist/img/logo.png" alt="Hanasta Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Laporan Aktivitas</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?php echo (base_url()) ?>dashboard" class="nav-link <?= ($menu == 'dashboard') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url()) ?>pengguna" class="nav-link <?= ($menu == 'pengguna') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url()) ?>rencana" class="nav-link <?= ($menu == 'rencana') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Rencana</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url()) ?>projek" class="nav-link <?= ($menu == 'projek') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-bullseye"></i>
                                <p>Projek</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?= $this->renderSection('content') ?>
        <!-- Modal HTML Change Plan Status -->
        <div class="modal fade" id="change-status">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-bold">Ganti Status Rencana</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="changeStatus" action="">
                        <div class="modal-body">
                            <p>Apakah anda yakin akan mangganti status <span id="titleToChange" class="text-bold"></span>? (Status saat ini <span id="statusBefore" class="text-bold"></span>) </p>
                            <div class="form-group">
                                <label>Ganti Status</label>
                                <select class="form-control select2" style="width: 100%" name="status">
                                    <option selected value="progress">Progress</option>
                                    <option value="complete">Complete</option>
                                </select>
                                <input type="hidden" id="planId" name="id" value="">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

                            <button type="submit" class="btn btn-danger">Ganti</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- Modal HTML Delete User/Division -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-bold">Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan menghapus <span id="userNameToDelete" class="text-bold"></span>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <form method="post" id="deleteForm" action="">
                            <input type="hidden" id="userIdToDelete" name="id" value="">
                            <input type="hidden" id="dataType" name="type" value="">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

        <!-- Modal HTML Delete Role User -->
        <div class="modal fade" id="modal-lg2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-bold">Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan menghapus <span id="userNameToDeleteRole" class="text-bold"></span> pada pengguna ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <form method="post" id="deleteForm2" action="">
                            <input type="hidden" id="userIdToDeleteRole" name="id" value="">
                            <input type="hidden" id="dataTypeRole" name="type" value="">
                            <input type="hidden" id="userIdBefore" name="idUser" value="">
                            <button type="submit" onclick="removeRoleDivisionPair(this)" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha384-7+JkRtbhsh3HfiIC42SAOikX7qerTxv5u8TL7bLym/Py6sTPKJHdG0lG+keCF2E8" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha384-ZbBKV4/YrxMzDs/5b2pZ1do+yooaAqPiT9xQ0HgyaFdjEkDpUAtk2A1U5yN06NfQ" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Select2 -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/js/select2.full.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- ChartJS -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/chart.js/Chart.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Toastr -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/toastr/toastr.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/moment/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url(); ?>assets/adminlte/dist/js/pages/dashboard.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {

                $("#example1").DataTable({
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#example1_wrapper .col-md-6:eq(0)");
                $("#divisi").DataTable({
                        responsive: true,
                        lengthChange: false,
                        autoWidth: false,
                        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#divisi_wrapper .col-md-6:eq(0)");
                $("#example2").DataTable({
                    paging: true,
                    lengthChange: false,
                    searching: false,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                });

            });

            $(".select2").select2();

            //Initialize Select2 Elements
            $(".select2bs4").select2({
                theme: "bootstrap4",
            });
        </script>
        <!-- GRAPH Evaluasi -->
        <script>
            $(function() {
                // Data dari PHP
                var dailyValues = <?= json_encode(isset($dailyValues) ? $dailyValues : []) ?>;
                var date = <?= json_encode(isset($date) ? $date : []) ?>;

                // Ubah nilai string menjadi integer
                var dataValues = dailyValues.map(function(value) {
                    return parseInt(value, 10);
                });

                // Tentukan label (tanggal) untuk data tersebut
                var labels = date;

                // Sales Graph Data
                var salesData = {
                    labels: labels,
                    datasets: [{
                        backgroundColor: 'transparent',
                        borderColor: 'rgb(0,0,0)',
                        data: dataValues
                    }]
                };

                // Sales Graph Options
                var salesOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Hari', // Label for X-axis
                                fontColor: 'rgb(0,0,0)'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontColor: 'rgb(0,0,0)'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Nilai', // Label for Y-axis
                                fontColor: 'rgb(0,0,0)'
                            },
                            gridLines: {
                                display: true,
                                color: 'rgb(243,235,222)'
                            },
                            ticks: {
                                beginAtZero: false,
                                fontColor: 'rgb(0,0,0)',
                                max: 3,
                                min: 1,
                                stepSize: 1,
                                callback: function(value, index, values) {
                                    // Mengubah nilai numerik menjadi A, B, C
                                    if (value === 1) return 'C';
                                    if (value === 2) return 'B';
                                    if (value === 3) return 'A';
                                    return value;
                                }
                            }
                        }]
                    }
                };

                // Get the context of the canvas element we want to select
                var salesChartCanvas = $('#evaluation').get(0).getContext('2d');

                // Create the line chart
                var salesChart = new Chart(salesChartCanvas, {
                    type: 'line',
                    data: salesData,
                    options: salesOptions
                });
            });
        </script>
        <!-- GRAPH Aktivitas -->
        <script>
            $(function() {
                var graphCount = <?= json_encode(isset($graphCount) ? $graphCount : []) ?>;
                var graphDate = <?= json_encode(isset($graphDate) ? $graphDate : []) ?>;

                // Ubah nilai string menjadi integer
                var dataValues = graphCount.map(function(value) {
                    return parseInt(value, 10);
                });

                // Tentukan label (tanggal) untuk data tersebut
                var labels = graphDate;

                console.log(dataValues);
                console.log(labels);

                // Sales Graph Data
                var salesData = {
                    labels: labels,
                    datasets: [{
                        backgroundColor: 'rgb(255,193,7)',
                        borderColor: 'rgb(243,235,222)',
                        data: dataValues
                    }]
                };

                // Sales Graph Options
                var salesOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontColor: 'rgb(255,255,255)'
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: true,
                                color: 'rgb(243,235,222)'
                            },
                            ticks: {
                                beginAtZero: false,
                                fontColor: 'rgb(255,255,255)'
                            }
                        }]
                    }
                };

                // Get the context of the canvas element we want to select
                var salesChartCanvas = $('#line-chart').get(0).getContext('2d');

                // Create the line chart
                var salesChart = new Chart(salesChartCanvas, {
                    type: 'line',
                    data: salesData,
                    options: salesOptions
                });
            });
        </script>

        <!-- Project graph -->
        <script>
            // Data untuk chart Projek (contoh data)
            var barData = {
                labels: ["Pembukaan Projek Baru", "Pembukaan Cabang Baru"],
                datasets: [{
                    label: '',
                    backgroundColor: 'rgb(255,193,7)',
                    borderColor: 'rgb(255,193,7)',
                    data: [20, 70]
                }]
            };

            // Options untuk chart
            var barOptions = {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true,
                            color: 'rgb(255,255,255)'
                        },
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'rgb(255,255,255)',
                            max: 100,
                            stepSize: 20
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display: true,
                            color: 'rgb(255,255,255)'
                        },
                        ticks: {
                            fontColor: 'rgb(255,255,255)',
                        }
                    }]
                },

            };

            // Inisialisasi Chart
            var ctx = document.getElementById('myBarChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: barData,
                options: barOptions
            });
        </script>
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
                <?php if (session()->getFlashdata('successUpdate')) : ?>
                    toastr.success(
                        '<?= session()->getFlashdata('successUpdate') ?>'
                    );
                <?php endif; ?>
                <?php if (session()->getFlashdata('errorUpdate')) : ?>
                    toastr.error(
                        '<?= session()->getFlashdata('errorUpdate') ?>'
                    );
                <?php endif; ?>
                <?php if (session()->getFlashdata('errorInfo')) : ?>
                    toastr.info(
                        '<?= session()->getFlashdata('errorInfo') ?>'
                    );
                <?php endif; ?>

            });
        </script>

        <!-- Passing ID dan Nama untuk di delete -->
        <script>
            $(document).ready(function() {
                // untuk role dan user
                let userIdToDelete;
                let userNameToDelete;
                // untuk plan
                let planId;
                let planTitle;
                let planStatus;

                let dataType;

                $('#change-status').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget).closest('h3');

                    var planTitle = button.data('title');
                    var planStatus = button.data('status');
                    var planId = button.data('plan-id');

                    console.log('Title', planTitle);
                    console.log('Progress', planId);
                    console.log('Status', planStatus);

                    var modal = $(this);
                    modal.find('#titleToChange').text(planTitle);
                    modal.find('#statusBefore').text(planStatus);
                    modal.find('#planId').val(planId);

                    modal.find('#changeStatus').attr('action', `<?php echo base_url('dashboard/update-plan'); ?>`);
                });
                $('#modal-lg').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);

                    var userIdToDelete = button.closest('tr').data('user-id');
                    var userNameToDelete = button.closest('tr').data('user-name');
                    var dataType = button.closest('tr').data('type');

                    if (!userIdToDelete) {
                        var trSelector = button.data('tr-selector');
                        var tr = $(trSelector); // Menemukan elemen tr berdasarkan selector

                        var userIdToDelete = tr.data('user-id');
                        var userNameToDelete = tr.data('user-name');
                        var dataType = tr.data('type');
                    }

                    var modal = $(this);
                    modal.find('#userNameToDelete').text(userNameToDelete);
                    modal.find('#userIdToDelete').val(userIdToDelete);
                    modal.find('#dataType').val(dataType);

                    // Menyesuaikan URL action form
                    let actionUrl;
                    switch (dataType) {
                        case 'Pengguna':
                            actionUrl = `<?php echo base_url('pengguna/delete-pengguna'); ?>`;
                            break;
                        case 'Divisi':
                            actionUrl = `<?php echo base_url('pengguna/delete-divisi'); ?>`;
                            break;
                        case 'role':
                            actionUrl = `<?php echo base_url('pengguna/delete-role'); ?>`;
                            break;
                    }
                    modal.find('#deleteForm').attr('action', actionUrl);
                });
                $('#modal-lg2').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var userDataDiv = button.closest('button');

                    var userIdToDelete = userDataDiv.data('user-id');
                    var userNameToDelete = userDataDiv.data('user-name');
                    var dataType = userDataDiv.data('type');
                    var userIdBefore = userDataDiv.data('user-id-before');

                    var modal = $(this);
                    modal.find('#userNameToDeleteRole').text(userNameToDelete);
                    modal.find('#userIdToDeleteRole').val(userIdToDelete);
                    modal.find('#dataTypeRole').val(dataType);
                    modal.find('#userIdBefore').val(userIdBefore);

                    // Menyesuaikan URL action form
                    let actionUrl;
                    switch (dataType) {
                        case 'UserRole':
                            actionUrl = `<?php echo base_url('pengguna/delete-user-role'); ?>`;
                            break;
                    }
                    modal.find('#deleteForm2').attr('action', actionUrl);
                });
            });
        </script>
        <!-- Passing ID dan Nama untuk delete user role-->



</body>

</html>