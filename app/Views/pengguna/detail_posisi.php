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
                                <h1 class="text-bold">Detail Posisi <?= $posisi; ?></h1>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th>Posisi</th>
                                            <th>Divisi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($members as $member) : ?>
                                            <tr data-user-id="<?= $member['id'] ?>" data-user-name=" Pengguna : <?= $member['name'] ?>" data-type="Pengguna">
                                                <td data-label="No"><?= $i++; ?></td>
                                                <td data-label="Nama"><?= $member['name'] ?></td>
                                                <td data-label="Posisi"><?= $member['role']['role'] ?></td>
                                                <td data-label="Divisi"><?= $member['role']['division'] ?></td>
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

<?php $this->endSection(); ?>