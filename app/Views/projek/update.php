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
                        <form method="post" action="<?php echo (base_url()) ?>projek/save-update-project/<?= $details['id'] ?>">
                            <div class="card" style="border-top: 5px solid yellow;">
                                <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                    <h1 class="text-bold">Update Projek</h1>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleInputNamaProjek" class="form-label">Nama Projek</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputNamaProjek" value="" aria-describedby="emailHelp" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputDetail" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="description" id="inputDetail" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="progress" class="form-label">Progress (%)</label>
                                        <input type="number" name="progress" class="form-control" id="progress" value="" min="0" max="100" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="status" value="" required />
                                    </div>
                                    <input type="hidden" name="category" class="form-control" id="inputPengeluaran" value="project" required />

                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- card -->
                            <div class="card" style="border-top: 5px solid yellow;">
                                <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                    <h1 class="text-bold">Anggota Projek</h1>
                                    <button type="button" onclick="addRoleDivisionPair()" class="btn btn-success align-items-center d-flex">
                                        <i class="nav-icon fas fa-plus fa-xs pr-2"></i>Tambah
                                    </button>
                                </div>
                                <!-- Divisi -->
                                <div class="card-body role-division-pair" id="rolesDivisionsContainer">
                                    <div class="form-group role-division-pair">
                                        <div class="form-group ">
                                            <label>Divisi</label>
                                            <select class="form-control select2" name="divisions[]">
                                                <option value=""></option>
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label>User</label>
                                            <select class="form-control select2" name="users[]">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger delete-user-btn" data-toggle="modal" data-target="#modal-lg2" data-user-id="" data-user-name="" data-type="UserRole" data-user-id-before="">
                                                <i class="nav-icon fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success align-items-center d-flex">
                                <i class="nav-icon fas fa-pen fa-xs pr-2"></i>Update
                                Projek
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->endSection(); ?>