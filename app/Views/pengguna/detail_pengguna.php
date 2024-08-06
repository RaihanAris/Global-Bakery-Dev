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
                                            <td data-label="Nama">
                                                <?php if ($details['picture'] != null) : ?>
                                                    <img src="<?= $details['picture'] ?>" class="rounded mx-auto d-block" alt="Foto <?= $details['name'] ?>">
                                                <?php endif; ?>
                                                <?= $details['name']; ?>
                                            </td>
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
                                <canvas class="chart" id="evaluation" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                                            <th>Nama</th>
                                            <th>Detail Rencana</th>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($plansByDate as $plans) : ?>
                                            <tr>
                                                <td data-label="No" class="align-middle"><?= $i++ ?></td>
                                                <td data-label="Nama Pengguna" class="align-middle"> <?= $details['name'] ?></td>
                                                <td data-label="Detail Rencana" class="align-middle">
                                                    <?php foreach ($plans as $plan) : ?>

                                                        <!-- card -->
                                                        <div class="card bg-gradient-warning collapsed-card mb-1">
                                                            <div class="card-header">
                                                                <h3 class="card-title text-bold">
                                                                    <li><?= $plan['title'] ?></li>
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
                                                                <p><?= $plan['description'] ?></p>
                                                            </div>
                                                            <!-- /.card-body -->
                                                        </div>
                                                        <!-- /.card -->
                                                    <?php endforeach; ?>

                                                    <!-- card -->
                                                    <div class="card bg-gradient-info collapsed-card mb-1">
                                                        <div class="card-header">
                                                            <h3 class="card-title text-bold">
                                                                <li>Detail Aktivitas</li>
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
                                                            <?php foreach ($workHours as $workHour) : ?>
                                                                <li class="text-bold"><?= $workHour['name'] ?></li>
                                                                <?php foreach ($plans as $plan) : ?>
                                                                    <?php foreach ($userActivities as $activity) :
                                                                        if ($activity['categoryId'] == $workHour['id'] && $plan['id'] == $activity['planId']) {
                                                                            $activity = $activity['title'];
                                                                        } else {
                                                                            $activity = null;
                                                                        } ?>
                                                                        <p style="text-align: left;"><?= $activity ?></p>
                                                                    <?php endforeach; ?>
                                                                <?php endforeach; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                </td>
                                                <td data-label="Tanggal" class="align-middle">
                                                    <?= $plan['created_at'] ?>
                                                </td>
                                                <td data-label="Kategori" class="align-middle">
                                                    <?= $plan['category'] ?>
                                                </td>
                                                <td data-label="Progress" class="align-middle">
                                                    <?php foreach ($plans as $plan) : ?>
                                                        <li><?= $plan['status'] ?>
                                                            <?php if ($plan['progress'] == 100) {
                                                                $color = 'success';
                                                            } elseif ($plan['progress'] > 50 && $plan['progress'] < 100) {
                                                                $color = 'warning';
                                                            } else {
                                                                $color = 'danger';
                                                            } ?>
                                                            <span class="badge bg-<?= $color ?>"><?= $plan['progress'] ?>%</span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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