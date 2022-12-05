<div class="col-md-5 offset-md-4">
    <div class="card">
        <div class="card-body register-card-body">
            <h4 class="login-box-msg">Daftar Sebagai User</h4>

            <!-- flash alert -->
            <?php

            if ($this->session->flashdata('error')) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>';
                echo $this->session->flashdata('error');
                echo '</div>';
            }

            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>';
                echo $this->session->flashdata('pesan');
                echo '</div>';
            }

            ?>


            <?= form_open('pelanggan/register') ?>
            <div class="input-group mt-3">
                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('nama_pelanggan') ?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <?= form_error('nama_pelanggan', '<small class="text-danger pl-2">', '</small>'); ?>

            <div class="input-group mt-3">
                <input type="text" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>

            <div class="input-group mt-3">
                <input type="password" name="password1" class="form-control" placeholder="Password" value="<?= set_value('password1') ?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>

            <div class="input-group mb-3 mt-3">
                <input type="password" name="password2" class="form-control" placeholder="Ulangi password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <a href="<?= base_url('pelanggan/login') ?>" class="text-center">Sudah punya akun.? Silahkan Login !</a>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </div>
                <!-- /.col -->
            </div>
            <?= form_close() ?>


        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
</div>