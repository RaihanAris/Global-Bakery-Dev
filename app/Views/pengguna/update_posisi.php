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
                                <h1 class="text-bold">Update Posisi <?php echo ($posisi['nama']); ?></h1>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputNama" class="form-label">Nama Posisi</label>
                                        <input type="text" class="form-control" id="exampleInputNama" aria-describedby="emailHelp" value="<?php echo ($posisi['nama']) ?>" required />
                                    </div>

                                    <button type="submit" class="btn btn-success align-items-center d-flex">
                                        <i class="nav-icon fas fa-pen fa-xs pr-2"></i>Update
                                        Posisi
                                    </button>
                                </form>
                            </div>
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