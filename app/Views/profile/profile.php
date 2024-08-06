<?php $this->extend('template/navbar'); ?>

<?php $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="col-12">
                        <div class="card" style="border-top: 5px solid yellow;">
                            <div class="mx-4 mt-3 pb-3 border-bottom d-flex justify-content-between align-items-center">
                                <h1 class="text-bold">Profile Admin</h1>
                                <form action="<?php echo (base_url()) ?>profile/logout" method="post">
                                    <button type="submit" class="btn btn-danger align-items-center d-flex">
                                        Logout
                                    </button>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pl-4">
                                <p class="text-bold mb-0">Nama</p>
                                <p><?= $name ?></p>
                                <p class="text-bold mb-0">Email</p>
                                <p><?= $email ?></p>
                                <p class="text-bold mb-0">Jenis Kelamin</p>
                                <?php
                                if ($sex == "male") {
                                    $sex = "Laki - laki";
                                } elseif ($sex == "female") {
                                    $sex = "Perempuan";
                                }
                                ?>
                                <p><?= $sex ?></p>
                                <p class="text-bold mb-0">Tanggal Lahir</p>
                                <p><?= $birth ?></p>
                                <p class="text-bold mb-0">Keamanan</p>
                                <a href="<?php echo (base_url()) ?>profile/ganti-password">Ganti Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php $this->endsection(); ?>