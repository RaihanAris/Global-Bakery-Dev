<?php $this->extend('template/navbar'); ?>

<?php $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="col-12">
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Detail Pengguna</h1>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo (base_url()) ?>pengguna/update-pengguna/<?= $idmembers ?>" class="btn btn-warning align-items-center d-flex">
                                        <i class="nav-icon fas fa-pen fa-xs pr-2"></i>
                                        Update Pengguna
                                    </a>
                                    <button type="button" class="btn btn-danger align-items-center d-flex" data-toggle="modal" data-target="#modal-lg" data-tr-selector="tr[data-user-id='<?= $details['id'] ?>']">
                                        <i class="nav-icon fas fa-trash fa-xs pr-2"></i>
                                        Hapus Pengguna
                                    </button>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Posisi</th>
                                            <th>Divisi</th>
                                            <th>Email</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-user-id="<?= $details['id'] ?>" data-user-name=" Pengguna : <?= $details['name'] ?>" data-type="Pengguna">
                                            <td data-label="Nama"><?= $details['name']; ?></td>
                                            <td data-label="Posisi">
                                                <?php foreach ($details['role'] as $role) : ?>
                                                    <span class="badge text-bg-warning">
                                                        <?= $role['role']; ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </td>
                                            <td data-label="Divisi">
                                                <?php foreach ($details['role'] as $role) : ?>
                                                    <span class="badge text-bg-warning">
                                                        <?= $role['division']; ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </td>
                                            <td data-label="Email"><?= $details['email']; ?></td>
                                            <td data-label="Jenis Kelamin"><?= $details['sex']; ?></td>
                                            <td data-label="Tanggal Lahir"><?= $details['birthday']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Grafik Penilaian Harian</h1>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Daftar Rencana</h1>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Detail Rencana</th>
                                            <th>Tanggal</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-label="No">1</td>
                                            <td data-label="Detail Rencana">
                                                <!-- card -->
                                                <div class="card bg-gradient-warning collapsed-card">
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
                                            <td data-label="Tanggal">28-06-2024</td>
                                            <td data-label="Progress">
                                                <div class="progress-rencana">
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar bg-primary" style="width: 70%"></div>
                                                    </div>
                                                    <span class="badge bg-success">70%</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td data-label="No">2</td>
                                            <td data-label="Detail Rencana">
                                                <!-- card -->
                                                <div class="card bg-gradient-warning collapsed-card">
                                                    <div class="card-header">
                                                        <h3 class="card-title text-bold">
                                                            <li>Kunjungan Ke Outlet baru</li>
                                                            <li>Finalisasi Logo Baru</li>
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
                                                        <li>Beli Bensin Mobil</li>
                                                        <li>memberikan seserahan</li>
                                                        <li>diskusi logo dengan tim designer</li>
                                                        <li>penentuan logo baru</li>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </td>
                                            <td data-label="Tanggal">29-06-2024</td>
                                            <td data-label="Progress">
                                                <div class="progress-rencana">
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                    </div>
                                                    <span class="badge bg-success fs-7">100%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->endSection(); ?>