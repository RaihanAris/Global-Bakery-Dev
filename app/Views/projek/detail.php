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
                        <!-- /.card -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold"><?= $details['title'] ?></h1>
                            </div>
                            <p class="mt-3 px-4">
                                <?= $details['description'] ?>
                            </p>
                            <table class="table table-bordered">
                                <thead style="font-size: 18px;">
                                    <tr>
                                        <th>Dibuat Oleh</th>
                                        <th>Kategori</th>
                                        <th>Mulai</th>
                                        <th>Edit Terakhir</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 18px;">
                                    <tr>
                                        <td data-label="Dibuat Oleh" class="align-middle"> <?= $creator ?></td>
                                        <td data-label="Kategori" class="align-middle"><?= $details['category'] ?></td>
                                        <td data-label="Mulai" class="align-middle"> <?= $details['created_at'] ?></td>
                                        <td data-label="Edit Terakhir" class="align-middle"> <?= $details['updated_at'] ?></td>
                                        <td data-label="Status" class="align-middle"> <?= $details['status'] ?></td>
                                        <td data-label="Progress" class="align-middle" class="align-middle">
                                            <div class="progress-rencana">
                                                <div class="progress progress-xs progress-striped active">
                                                    <div class="progress-bar bg-primary" style="width: <?= $details['progress'] ?>%"></div>
                                                </div>
                                                <span class="badge bg-success"><?= $details['progress'] ?>%</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- /.card-header -->

                        </div>
                        <!-- /.card -->
                        <!-- Divisi -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                <h3 class="text-bold">Divisi Keuangan</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead style="font-size: 18px;">
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th>Posisi</th>
                                            <th>Rencana</th>
                                            <th>Progres</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 18px;">
                                        <tr>
                                            <td data-label="No" class="align-middle">1.</td>
                                            <td data-label="Nama" class="align-middle">Budi Handoko</td>
                                            <td data-label="Posisi" class="align-middle"> <span class="badge text-bg-warning">Manager</span></td>
                                            <td data-label="Rencana" class="align-middle">
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
                                            <td data-label="Progress" class="align-middle" class="align-middle">
                                                <div class="progress-rencana">
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                                                    </div>
                                                    <span class="badge bg-success">10%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Divisi -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                <h3 class="text-bold">Divisi Marketing</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead style="font-size: 18px;">
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th>Posisi</th>
                                            <th>Rencana</th>
                                            <th>Progres</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 18px;">
                                        <tr>
                                            <td data-label="No" class="align-middle">1.</td>
                                            <td data-label="Nama" class="align-middle">Budi Handoko</td>
                                            <td data-label="Posisi" class="align-middle"> <span class="badge text-bg-warning">Manager</span></td>
                                            <td data-label="Rencana" class="align-middle">
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
                                            <td data-label="Progress" class="align-middle" class="align-middle">
                                                <div class="progress-rencana">
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar bg-primary" style="width: 10%"></div>
                                                    </div>
                                                    <span class="badge bg-success">10%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php $this->endSection(); ?>