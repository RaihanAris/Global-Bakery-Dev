<?php $this->extend('template/navbar'); ?>

<?php $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-bold">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>2</h3>

                            <p>Jumlah Manager</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-user-tie"></i>
                        </div>
                        <a href="<?php echo (base_url()) ?>pengguna" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>10</h3>

                            <p>Jumlah Staff</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-user"></i>
                        </div>
                        <a href="<?php echo (base_url()) ?>pengguna" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>440</h3>

                            <p>Aktivitas</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-list"></i>
                        </div>
                        <a href="<?php echo (base_url()) ?>rencana" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>2</h3>

                            <p>Jumlah Projek</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-bullseye"></i>
                        </div>
                        <a href="<?php echo (base_url()) ?>projek" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Calendar -->
                    <div class="card bg-gradient-info">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                Progres Projek
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->

                                <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <canvas class="chart" id="myBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">

                    <!-- solid sales graph -->
                    <div class="card bg-gradient-info">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                Aktivitas
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->

                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
            <div class="card" style="border-top: 5px solid yellow;">
                <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                    <h1 class="text-bold">Rencana Hari Ini</h1>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Nama Pengguna</th>
                                <th>Detail Rencana</th>
                                <th>Tanggal</th>
                                <th>Posisi</th>
                                <th>Divisi</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="No" class="align-middle">1</td>
                                <td data-label="Nama Pengguna" class="align-middle">Raihan</td>
                                <td data-label="Detail Rencana" class="align-middle">
                                    <!-- card -->
                                    <div class="card bg-gradient-warning collapsed-card mb-1">
                                        <div class="card-header">
                                            <h3 class="card-title text-bold">
                                                <li>Follow Up Pembayaran Pajak</li>
                                            </h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <li>Ke kantor Pajak</li>
                                            <li>Print dokumen Pajak</li>
                                            <li>Ambil uang di ATM</li>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </td>
                                <td data-label="Tanggal" class="align-middle">
                                    28-06-2024
                                </td>
                                <td data-label="Posisi" class="align-middle">
                                    <span class="badge text-bg-warning">Manager</span>
                                </td>
                                <td data-label="Divisi" class="align-middle">
                                    <span class="badge text-bg-warning">IT</span>
                                </td>
                                <td data-label="Progress" class="align-middle">
                                    <div class="progress-rencana">
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-primary" style="width: 70%"></div>
                                        </div>
                                        <span class="badge bg-success">70%</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->endsection(); ?>