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
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputNamaProjek" class="form-label">Nama Projek</label>
                                        <input type="text" class="form-control" id="exampleInputNamaProjek" aria-describedby="emailHelp" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputDetail" class="form-label">Detail</label>
                                        <textarea class="form-control" id="inputDetail" rows="3" required>
</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBudget" class="form-label">Estimasi Budget</label>
                                        <input type="number" class="form-control" id="inputBudget" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputPengeluaran" class="form-label">Estimasi Pengeluaran</label>
                                        <input type="number" class="form-control" id="inputPengeluaran" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputDurasi" class="form-label">Estimasi Durasi Projek</label>
                                        <input type="number" class="form-control" id="inputDurasi" required />
                                    </div>

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