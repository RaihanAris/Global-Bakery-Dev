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
                                <h1 class="text-bold">Tambah Pengguna</h1>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?php echo (base_url()) ?>pengguna/save" method="post">
                                    <div class="mb-3">
                                        <label for="nama-pengguna" class="form-label">Nama Pengguna</label>
                                        <input type="text" class="form-control" id="nama-pengguna" name="nama-pengguna" aria-describedby="emailHelp" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="email-pengguna" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email-pengguna" name="email-pengguna" required />
                                    </div>

                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control select2" style="width: 100%" name="gender-pengguna">
                                            <option selected="selected" value="male">Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="inputBirth" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="lahir-pengguna" class="form-control" id="inputBirth" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="pass-pengguna" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="pass-pengguna" name="pass-pengguna" required />
                                    </div>

                                    <button type="submit" class="btn btn-success align-items-center d-flex">
                                        <i class="nav-icon fas fa-plus fa-xs pr-2"></i>Tambah
                                        Pengguna
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