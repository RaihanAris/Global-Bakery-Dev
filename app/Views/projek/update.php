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
                                <h1 class="text-bold">Update Projek</h1>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputNamaProjek" class="form-label">Nama Projek</label>
                                        <input type="text" class="form-control" id="exampleInputNamaProjek" aria-describedby="emailHelp" value="Pembukaan Outlet Baru" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputDetail" class="form-label">Detail</label>
                                        <textarea class="form-control" id="inputDetail" rows="3" required>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit saepe sequi dolor reprehenderit, aut rem sed nostrum, dolorem similique est provident minima quibusdam animi, omnis iste blanditiis unde! Sequi, mollitia! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero omnis impedit sequi quisquam. Incidunt error minus impedit quam? Eaque voluptatum facilis inventore itaque quas. Earum expedita dolores quaerat necessitatibus praesentium nihil.</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputBudget" class="form-label">Estimasi Budget</label>
                                        <input type="number" class="form-control" id="inputBudget" value="23000000" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputPengeluaran" class="form-label">Estimasi Pengeluaran</label>
                                        <input type="number" class="form-control" id="inputPengeluaran" value="2000000" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputDurasi" class="form-label">Estimasi Durasi Projek</label>
                                        <input type="number" class="form-control" id="inputDurasi" value="20" required />
                                    </div>

                                    <button type="submit" class="btn btn-success align-items-center d-flex">
                                        <i class="nav-icon fas fa-pen fa-xs pr-2"></i>Update
                                        Projek
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Divisi -->
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold ">Update Divisi</h1>
                                <button class="btn btn-success align-items-center d-flex" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                    <i class="nav-icon fas fa-plus fa-xs pr-2"></i>
                                    Tambah Divisi
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class=" table table-bordered">
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
                                        <tr>
                                            <td data-label="No" class="align-middle">1.</td>
                                            <td data-label="Nama" class="align-middle">Raihan</td>
                                            <td data-label="Posisi" class="align-middle">Manager</td>
                                            <td data-label="Divisi" class="align-middle"><span class="badge text-bg-warning fs-6">IT</span></td>
                                            <td data-label="Action" class="d-flex">
                                                <div class="p-1">
                                                    <a href="<?php echo (base_url()) ?>pengguna/detail-pengguna" class="btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td data-label="No" class="align-middle">1.</td>
                                            <td data-label="Nama" class="align-middle">Raihan</td>
                                            <td data-label="Posisi" class="align-middle">Manager</td>
                                            <td data-label="Divisi" class="align-middle"><span class="badge text-bg-warning fs-6">IT</span></td>
                                            <td data-label="Action" class="d-flex">
                                                <div class="p-1">
                                                    <a href="<?php echo (base_url()) ?>pengguna/detail-pengguna" class="btn btn-primary">
                                                        <i class="nav-icon fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="p-1">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg">
                                                        <i class="nav-icon fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group pt-2">
                                    <button class="btn btn-success align-items-center d-flex" data-bs-toggle="modal" data-bs-target="#exampleAnggota" data-bs-whatever="@mdo">
                                        <i class="nav-icon fas fa-plus fa-xs pr-2"></i>
                                        Tambah Anggota
                                    </button>
                                </div>
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
<!-- /.content-wrapper -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-bold" id="exampleModalLabel">Tambah Divisi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama-divisi" class="col-form-label">Nama Divisi</label>
                        <select class="form-control select2" style="width: 100%">
                            <option selected="selected">IT</option>
                            <option>Marketing</option>
                            <option>Social Media</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Divisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-bold" id="exampleModalLabel">Tambah Anggota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama-divisi" class="col-form-label">Nama Anggota</label>
                        <select class="form-control select2" style="width: 100%">
                            <option selected="selected">Firmansyah Wibowo</option>
                            <option>Alam Nur Rian</option>
                            <option>Haidar iskandar</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>