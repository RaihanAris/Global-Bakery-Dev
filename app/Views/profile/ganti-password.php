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
                            <div class="mx-4 mt-3 pb-1 border-bottom">
                                <h1 class="text-bold">Ganti Kata Sandi</h1>
                                <p>Akun anda, Muhammad Dava</p>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="passLama" class="form-label">Kata Sandi Lama</label>
                                        <input type="password" class="form-control" id="passLama" aria-describedby="emailHelp" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="passLama" class="form-label">Kata Sandi Baru</label>
                                        <input type="password" class="form-control" id="passLama" aria-describedby="emailHelp" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="passLama" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                        <input type="password" class="form-control" id="passLama" aria-describedby="emailHelp" required />
                                    </div>

                                    <button type="submit" class="btn btn-success align-items-center d-flex mb-2">
                                        <i class="nav-icon fas fa-pen fa-xs pr-2"></i>Ganti Kata Sandi
                                    </button>
                                    <a href="<?php echo (base_url()) ?>profile/reset-password">Lupa Kata Sandi?</a>
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
<?php $this->endsection(); ?>