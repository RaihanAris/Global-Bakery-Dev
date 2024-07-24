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
                                <h1 class="text-bold">Detail Posisi <?php echo ($posisi['nama']); ?></h1>
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
                                        <tr>
                                            <td data-label="No">1</td>
                                            <td data-label="Nama">Raihan</td>
                                            <td data-label="Posisi"><?php echo ($posisi['nama']); ?></td>
                                            <td data-label="Divisi">IT</td>
                                            <td data-label="Action" class="d-flex">
                                                <div class="p-1">
                                                    <a href="<?php echo (base_url()) ?>pengguna/detail-pengguna" class="btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <a href="<?php echo (base_url()) ?>pengguna/update-pengguna" class="btn btn-warning">
                                                        <i class="nav-icon fas fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <button href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td data-label="No">2</td>
                                            <td data-label="Nama">Nurul Anwar</td>
                                            <td data-label="Posisi"><?php echo ($posisi['nama']); ?></td>
                                            <td data-label="Divisi">Marketing</td>
                                            <td data-label="Action" class="d-flex">
                                                <div class="p-1">
                                                    <a href="#" class="btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <a href="#" class="btn btn-warning">
                                                        <i class="nav-icon fas fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <button href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td data-label="No">3</td>
                                            <td data-label="Nama">Bagus Rahul</td>
                                            <td data-label="Posisi"><?php echo ($posisi['nama']); ?></td>
                                            <td data-label="Divisi">Marketing</td>
                                            <td data-label="Action" class="d-flex">
                                                <div class="p-1">
                                                    <a href="#" class="btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <a href="#" class="btn btn-warning">
                                                        <i class="nav-icon fas fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <button href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </button>
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

<!-- Modal/Alert -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin akan menghapus ...</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-danger toastrDefaultSuccess" data-dismiss="modal">
                    <i class="nav-icon fas fa-trash pr-2"></i>Hapus
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php $this->endSection(); ?>