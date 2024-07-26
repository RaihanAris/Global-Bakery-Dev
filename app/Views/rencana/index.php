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
                                <h1 class="text-bold">History Rencana Harian</h1>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">
                                <a href="<?php echo (base_url()) ?>rencana/history" class="btn btn-warning align-items-center d-flex justify-content-center">
                                    <i class="nav-icon fas fa-eye fa-xs pr-2"></i>
                                    Lihat History Rencana
                                </a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Rencana Harian, 28-06-2024</h1>
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
                                            <th>Ketegori</th>
                                            <th>Role</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($user_plan_list as $user_plan) : ?>
                                            <tr>
                                                <td data-label="No" class="align-middle"><?= $i++ ?></td>
                                                <td data-label="Nama Pengguna" class="align-middle"><?= $user_plan['user_name'] ?></td>
                                                <td data-label="Detail Rencana" class="align-middle">
                                                    <!-- card -->
                                                    <div class="card bg-gradient-warning collapsed-card mb-1">
                                                        <div class="card-header">
                                                            <h3 class="card-title text-bold">
                                                                <li><?= $user_plan['title'] ?></li>
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
                                                            <p><?= $user_plan['description'] ?></p>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                </td>
                                                <td data-label="Tanggal" class="align-middle">
                                                    <?= $user_plan['created_at'] ?>
                                                </td>
                                                <td data-label="Kategori" class="align-middle">
                                                    <?= $user_plan['category'] ?>
                                                </td>
                                                <td data-label="Posisi" class="align-middle">
                                                    <?php foreach ($user_plan['role'] as $role_division) : ?>
                                                        <span class="badge text-bg-warning text-sm"><?= $role_division['role'] ?> - <?= $role_division['division'] ?></span>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td data-label="Progress" class="align-middle">
                                                    <div class="progress-rencana">
                                                        <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar bg-primary" style="width: <?= $user_plan['progress'] ?>%"></div>
                                                        </div>
                                                        <span class="badge bg-success"><?= $user_plan['progress'] ?>%</span>
                                                    </div>
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
<?php $this->endSection(); ?>