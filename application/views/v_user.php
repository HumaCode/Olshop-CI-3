<div class="col-md">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data User</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-success btn-xs"><i class="fas fa-plus" data-toggle="modal" data-target="#add"> Tambah User</i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->

        <?php

        if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>';
            echo $this->session->flashdata('pesan');
            echo '</div>';
        }
        ?>

        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center bg-secondary color-palette">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>


                    <?php $no = 1;
                    foreach ($user as $u) {

                        // mengubah level user mejadi string.
                        if ($u['level_user'] == 1) {
                            $u['level'] = '<span class="badge badge-primary">Administrator</span>';
                        } else {
                            $u['level'] = '<span class="badge badge-success">Member</span>';
                        }

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $u['nama_user'] ?></td>
                            <td><?= $u['username'] ?></td>
                            <td><?= $u['password'] ?></td>
                            <td><?= $u['level'] ?></td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#edit<?= $u['id_user'] ?>"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-sm btn-danger " data-toggle="modal" data-target="#delete<?= $u['id_user'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


<!-- /.modal Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?= form_open('user/add') ?>

                <div class="form-group">
                    <label for="nama_user">Nama User</label>
                    <input type="text" class="form-control" id="nama_user" name="nama_user">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="level">Level User</label>
                    <select name="level_user" id="level" class="form-control">
                        <option value="1">Administrator</option>
                        <option value="2">Member</option>
                    </select>
                </div>



            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- /.modal Edit-->
<?php foreach ($user as $u) { ?>
    <div class="modal fade" id="edit<?= $u['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?= form_open('user/edit/' . $u['id_user']) ?>

                    <div class="form-group">
                        <label for="nama_user">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= $u['nama_user'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $u['username'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?= $u['password'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="level">Level User</label>
                        <select name="level_user" id="level" class="form-control">
                            <option value="1" <?php
                                                if ($u['level_user'] == 1) {
                                                    echo 'selected';
                                                } ?>>Administrator</option>
                            <option value="2" <?php
                                                if ($u['level_user'] == 2) {
                                                    echo 'selected';
                                                } ?>>Member</option>
                        </select>
                    </div>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
                <?= form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>




<!-- /.modal Delete-->
<?php foreach ($user as $u) { ?>
    <div class="modal fade" id="delete<?= $u['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-primary">
                    <h4 class="modal-title">Hapus <strong><?= $u['nama_user'] ?></strong>..?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">

                    <h5><strong> Apakah anda yakin akan menghapus data <?= $u['nama_user'] ?>..?</strong></h5>

                    <p>Data yang sudah dihapus tidak dapat dikembalikan lagi.</p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('user/delete/' . $u['id_user']) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>