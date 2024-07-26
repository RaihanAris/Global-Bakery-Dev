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
                                <h1 class="text-bold">Tambah Projek</h1>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="<?php echo (base_url()) ?>projek/create-project">
                                    <div class="mb-3">
                                        <label for="exampleInputNamaProjek" class="form-label">Nama Projek</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputNamaProjek" aria-describedby="emailHelp" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputDetail" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="description" id="inputDetail" rows="3" required>
</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="progress" class="form-label">Progress (%)</label>
                                        <input type="number" name="progress" class="form-control" id="progress" value="0" min="0" max="100" required />
                                    </div>
                                    <input type="hidden" name="category" class="form-control" id="inputPengeluaran" value="project" required />


                                    <button type="submit" class="btn btn-success align-items-center d-flex">
                                        <i class="nav-icon fas fa-pen fa-xs pr-2"></i>Tambah
                                        Projek
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