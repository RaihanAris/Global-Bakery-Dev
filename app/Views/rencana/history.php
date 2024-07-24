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
                                <h1 class="text-bold">History Rencana Harian</h1>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Tanggal</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-label="No" class="align-middle">1</td>
                                            <td data-label="Tanggal" class="align-middle">28-06-2024</td>
                                            <td data-label="Detail" class="align-middle">
                                                <div class="p-1">
                                                    <a href="<?php echo (base_url()) ?>rencana/history/detail" class=" btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td data-label="No" class="align-middle">1</td>
                                            <td data-label="Tanggal" class="align-middle">27-06-2024</td>
                                            <td data-label="Detail" class="align-middle">
                                                <div class="p-1">
                                                    <a href="<?php echo (base_url()) ?>rencana/history/detail" class="btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td data-label="No" class="align-middle">1</td>
                                            <td data-label="Tanggal" class="align-middle">26-2024</td>
                                            <td data-label="Detail" class="align-middle">
                                                <div class="p-1">
                                                    <a href="<?php echo (base_url()) ?>rencana/history/detail" class="btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
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
<?php $this->endSection(); ?>