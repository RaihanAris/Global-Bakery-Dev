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
                        <form action="<?php echo (base_url()) ?>pengguna/update/<?= $idmembers ?>" method="post">
                            <div class="card" style="border-top: 5px solid yellow;">
                                <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                    <h1 class="text-bold">Update Pengguna</h1>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleInputNama" class="form-label">Nama Pengguna</label>
                                        <input type="text" name="namaPengguna" class="form-control" id="exampleInputNama" aria-describedby="emailHelp" value="<?= $details['name'] ?>" required />
                                    </div>

                                    <input type="hidden" name="emailPengguna" class="form-control" id="inputEmail" value="<?= $details['email'] ?>" />

                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control select2" name="sexPengguna" style="width: 100%">
                                            <option <?= $details['sex'] == 'male' ? 'selected' : '' ?> value="male">Male</option>
                                            <option <?= $details['sex'] == 'female' ? 'selected' : '' ?> value="female">Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputBirth" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="birthPengguna" class="form-control" id="inputBirth" value="<?= $details['birthday'] ?>" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputPicture" class="form-label">Foto</label>
                                        <input type="file" name="fotoPengguna" class="form-control" id="inputPicture" value="<?= $details['picture'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="border-top: 5px solid yellow;">
                                <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                    <h1 class="text-bold">Posisi & Divisi Pengguna</h1>
                                    <button type="button" onclick="addRoleDivisionPair()" class="btn btn-success align-items-center d-flex">
                                        <i class="nav-icon fas fa-plus fa-xs pr-2"></i>Tambah
                                    </button>
                                </div>

                                <!-- Tambah Divisi dan Posisi -->
                                <div class="card-body role-division-pair" id="rolesDivisionsContainer">
                                    <?php foreach ($user_roles as $user_role) : ?>
                                        <div class="form-group role-division-pair">
                                            <div class="form-group ">
                                                <label>Posisi</label>
                                                <select class="form-control select2" name="roles[]">
                                                    <?php foreach ($roles as $role) : ?>
                                                        <option value="<?= $role['code'] ?>" <?= $user_role['role'] == $role['code'] ? 'selected' : '' ?>><?= $role['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group ">
                                                <label>Divisi</label>
                                                <select class="form-control select2" name="divisions[]">
                                                    <?php foreach ($divisions as $division) : ?>
                                                        <option value="<?= $division['id'] ?>" <?= $user_role['divisionId'] == $division['id'] ? 'selected' : '' ?>><?= $division['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger delete-user-btn" data-toggle="modal" data-target="#modal-lg2" data-user-id="<?= $user_role['id'] ?>" data-user-name="Role : <?= $user_role['role'] ?>" data-type="UserRole" data-user-id-before="<?= $details['id'] ?>">
                                                    <i class="nav-icon fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success align-items-center d-flex">
                                <i class="nav-icon fas fa-pen fa-xs pr-2"></i>Update
                                Pengguna
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    function addRoleDivisionPair() {
        var container = document.getElementById('rolesDivisionsContainer');
        var pairDiv = document.createElement('div');
        pairDiv.className = 'form-group role-division-pairNew';
        pairDiv.innerHTML = `
                <div class="form-group ">
                    <label>Posisi</label>
                    <select class="form-control select2" name="roles[]">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role['code'] ?>" ><?= $role['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group ">
                    <label>Divisi</label>
                    <select class="form-control select2" name="divisions[]">
                        <?php foreach ($divisions as $division) : ?>
                            <option value="<?= $division['id'] ?>" ><?= $division['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <button type="button" class="btn btn-danger align-items-center d-flex" onclick="removeRoleDivisionPair(this)">
                        <i class="nav-icon fas fa-trash fa-xs pr-2"></i>Hapus
                    </button>
                </div>
            `;
        container.appendChild(pairDiv);
        $(pairDiv).find('.select2').select2();
    }

    function removeRoleDivisionPair(button) {
        var pairDiv = button.closest('.role-division-pairNew');
        pairDiv.remove();
    }
</script>
<?php $this->endSection(); ?>