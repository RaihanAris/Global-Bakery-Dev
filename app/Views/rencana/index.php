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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($user_plan_list as $user_plans) : ?>
                                            <tr>
                                                <td data-label="No" class="align-middle"><?= $i++ ?></td>
                                                <td data-label="Nama Pengguna" class="align-middle">
                                                    <?= $user_plans['user_name'] ?>
                                                    <br>
                                                    <?php foreach ($user_plans['role'] as $role_division) : ?>
                                                        <span class="badge text-bg-warning text-sm"><?= $role_division['role'] ?> - <?= $role_division['division'] ?></span>
                                                        <br>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td data-label="Detail Rencana" class="align-middle">
                                                    <?php foreach ($user_plans['plans'] as $user_plan) : ?>
                                                        <!-- card -->
                                                        <div class="card bg-gradient-warning collapsed-card mb-1">
                                                            <div class="card-header">
                                                                <h3 class="card-title text-bold" data-title="<?= $user_plan['title'] ?>" data-status="<?= $user_plan['status'] ?>" data-progress="<?= $user_plan['progress'] ?>" data-plan-id="<?= $user_plan['id'] ?>">
                                                                    <?php if ($user_plan['progress'] == 100 || $user_plan['status'] == 'complete') {
                                                                        $statusBg = 'success';
                                                                    } else {
                                                                        $statusBg = 'danger';
                                                                    } ?>
                                                                    <li class="text-sm"><?= $user_plan['title'] ?> <span class="badge text-bg-primary text-sm"> <?= $user_plan['category'] ?></span> <button class="badge text-bg-<?= $statusBg ?> text-sm" data-toggle="modal" data-target="#change-status"><?= $user_plan['status'], " ", $user_plan['progress'] ?>%</button> </li>
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
                                                                <p class="text-bold">Created at: <?= $user_plan['created_at'] ?></p>
                                                                <p>Deskripsi: <br><?= $user_plan['description'] ?></p>
                                                            </div>
                                                            <!-- /.card-body -->
                                                        </div>
                                                        <!-- /.card -->
                                                    <?php endforeach; ?>
                                                    <!-- card -->
                                                    <div class="card bg-gradient-info collapsed-card mb-1">
                                                        <div class="card-header">
                                                            <h3 class="card-title text-bold text-sm">
                                                                Detail Aktivitas
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
                                                            <?php foreach ($plan_category as $work_hour) : ?>
                                                                <li class="text-bold"><?= $work_hour['name'] ?></li>
                                                                <?php foreach ($activity_list as $activities) : ?>
                                                                    <?php foreach ($user_plans['plans'] as $user_plan) :
                                                                        if ($user_plan['id'] == ($activities['planId']) && $activities['categoryId'] == $work_hour['id']) {
                                                                            $activity = $activities['title'];
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
                                                <td data-label="Kategori" class="align-middle">
                                                    <?= $user_plan['created_at'] ?>
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