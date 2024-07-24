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
                                <h1 class="text-bold">Cek Email Anda! </h1>
                                <p>Akun anda, Muhammad Dava</p>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="passLama" class="form-label">Masukkan Kode</label>
                                        <input type="password" class="form-control" id="passLama" aria-describedby="emailHelp" required />
                                    </div>

                                    <a href="<?php echo (base_url()) ?>profile/new-pass" class="btn btn-success mb-2">
                                        <i class="nav-icon fas fa-pen fa-xs pr-2"></i>Atur Kata Sandi Baru
                                    </a>
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