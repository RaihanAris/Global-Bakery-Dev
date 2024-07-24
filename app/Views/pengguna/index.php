<?= $this->extend('template/navbar'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="col-12">
                        <!-- Posisi -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Posisi</h1>
                                <a href="pengguna/tambah-posisi" class="btn btn-success align-items-center d-flex">
                                    <i class="nav-icon fas fa-plus fa-xs pr-2"></i>
                                    Posisi
                                </a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead style="font-size: 18px;">
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama Posisi</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 18px;">
                                        <?php $i = 1; ?>
                                        <?php foreach ($roles as $role) : ?>
                                            <tr>
                                                <td data-label="No"><?= ($i++); ?></td>
                                                <td data-label="Nama Posisi"><?= $role['name'] ?></td>
                                                <td data-label="Deskripsi"><?= $role['description'] ?></td>
                                                <td data-label="Action" class="d-flex">
                                                    <div class="p-1">
                                                        <a href="pengguna/detail-posisi/detail" class="btn btn-primary">
                                                            <i class="nav-icon fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div class="p-1">
                                                        <a href="pengguna/update-posisi/update" class="btn btn-warning">
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
                        </div>
                        <!-- Divisi -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Divisi</h1>
                                <a href="pengguna/tambah-divisi" class="btn btn-success align-items-center d-flex">
                                    <i class="nav-icon fas fa-plus fa-xs pr-2"></i>
                                    Divisi
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead style="font-size: 18px;">
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama Divisi</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 18px;">
                                        <?php $i = 1; ?>
                                        <?php foreach ($divisions as $division) : ?>
                                            <tr data-user-id="<?= $division['id'] ?>" data-user-name="Divisi : <?= $division['name'] ?>" data-type="Divisi">
                                                <td data-label="No"><?= ($i++); ?></td>
                                                <td data-label="Nama Divisi"><?= $division['name']; ?></td>
                                                <td data-label="Deskripsi"><?= $division['description']; ?></td>
                                                <td data-label="Action" class="d-flex">
                                                    <div class="p-1">
                                                        <a href="<?php echo (base_url()) ?>pengguna/detail-divisi/<?= $division['id'] ?>" class="btn btn-primary">
                                                            <i class="nav-icon fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div class="p-1">
                                                        <a href="<?php echo (base_url()) ?>pengguna/update-divisi/<?= $division['id'] ?>" class="btn btn-warning">
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
                        </div>
                        <!-- Pengguna -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Pengguna</h1>
                                <a href="<?php echo (base_url()) ?>pengguna/tambah-pengguna" class="btn btn-success align-items-center d-flex">
                                    <i class="nav-icon fas fa-plus fa-xs pr-2"></i>
                                    Pengguna
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="font-size: 18px;">
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th>Posisi</th>
                                            <th>Divisi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 18px;">
                                        <?php $i = 1; ?>
                                        <?php foreach ($members as $member) : ?>
                                            <tr data-user-id="<?= $member['id'] ?>" data-user-name=" Pengguna : <?= $member['name'] ?>" data-type="Pengguna">
                                                <td data-label="No"><?= ($i++); ?></td>
                                                <td data-label="Nama"><?= $member['name'] ?></td>
                                                <td data-label="Posisi">Staff</td>
                                                <td data-label="Divisi">IT</td>
                                                <td data-label="Action" class="d-flex">
                                                    <div class="p-1">
                                                        <a href="<?php echo (base_url()) ?>pengguna/detail-pengguna/<?= $member['id'] ?>" class="btn btn-primary">
                                                            <i class="nav-icon fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div class="p-1">
                                                        <a href="<?php echo (base_url()) ?>pengguna/update-pengguna/<?= $member['id'] ?>" class="btn btn-warning">
                                                            <i class="nav-icon fas fa-pen"></i>
                                                        </a>
                                                    </div>
                                                    <div class="p-1">
                                                        <button class="btn btn-danger delete-user-btn" data-toggle="modal" data-target="#modal-lg">
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
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<?= $this->endSection(); ?>