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
                                <h1 class="text-bold">Tambah Divisi</h1>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?php echo (base_url()) ?>pengguna/tambah-divisi" method="post">
                                    <div class="mb-3">
                                        <label for="nama-divisi" class="form-label">Nama Divisi</label>
                                        <input type="text" name="nama-divisi" class="form-control" id="nama-divisi" aria-describedby="emailHelp" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi-divisi" class="form-label">Deskripsi</label>
                                        <input type="text" name="deskripsi-divisi" class="form-control" id="deskripsi-divisi" aria-describedby="emailHelp" required />
                                    </div>

                                    <button type="submit" class="btn btn-success align-items-center d-flex">
                                        <i class="nav-icon fas fa-plus fa-xs pr-2"></i>Tambah
                                        Divisi
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