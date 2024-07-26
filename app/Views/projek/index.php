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
                                <h1 class="text-bold">Projek Global Bakery</h1>
                                <a href="<?php echo (base_url()) ?>projek/tambah" class="btn btn-success align-items-center d-flex">
                                    <i class="nav-icon fas fa-plus fa-xs pr-2"></i>
                                    Tambah Projek
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama Projek</th>
                                            <th>Status</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Progress</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($projects as $project) : ?>
                                            <tr>
                                                <td data-label="No" class="align-middle"><?= $i++ ?></td>
                                                <td data-label="Nama Projek" class="align-middle"><?= $project['title'] ?></td>
                                                <td data-label="Status" class="align-middle">
                                                    <?= $project['status'] ?>
                                                </td>
                                                <td data-label="Tanggal Mulai" class="align-middle">
                                                    <?= $project['created_at'] ?>
                                                </td>
                                                <td data-label="Progress" class="align-middle">
                                                    <div class="progress-rencana">
                                                        <div class="progress progress-xs progress-striped active">
                                                            <div class="progress-bar bg-primary" style="width: <?= $project['progress'] ?>%"></div>
                                                        </div>
                                                        <span class="badge bg-success"><?= $project['progress'] ?>%</span>
                                                    </div>
                                                </td>
                                                <td data-label="Action" class="align-middle d-flex">
                                                    <div class="p-1">
                                                        <a href="<?php echo (base_url()) ?>projek/detail/<?= $project['id'] ?>" class="btn btn-primary">
                                                            <i class="nav-icon fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div class="p-1">
                                                        <a href="<?php echo (base_url()) ?>projek/update/<?= $project['id'] ?>" class="btn btn-warning">
                                                            <i class="nav-icon fas fa-pen"></i>
                                                        </a>
                                                    </div>
                                                    <div class="p-1">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg">
                                                            <i class="nav-icon fas fa-trash"></i>
                                                        </button>
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