<div class="col-md">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Kategori</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-success btn-xs"><i class="fas fa-plus" data-toggle="modal" data-target="#add"> Tambah Kategori</i>
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
                        <th width="30">No</th>
                        <th>Nama Kategori</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $no = 1;
                    foreach ($kategori as $k) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $k['nama_kategori'] ?></td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#edit<?= $k['id_kategori'] ?>"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-sm btn-danger " data-toggle="modal" data-target="#delete<?= $k['id_kategori'] ?>"><i class="fa fa-trash"></i></button>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?= form_open('kategori/add') ?>

                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<!-- /.modal Edit-->
<?php foreach ($kategori as $k) { ?>
    <div class="modal fade" id="edit<?= $k['id_kategori'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?= form_open('kategori/edit/' . $k['id_kategori']) ?>

                    <div class="form-group">
                        <label for="nama_kategori">Nama User</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $k['nama_kategori'] ?>">
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
<?php foreach ($kategori as $_COOKIE) { ?>
    <div class="modal fade" id="delete<?= $_COOKIE['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-primary">
                    <h4 class="modal-title">Hapus <strong><?= $_COOKIE['nama_kategori'] ?></strong>..?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">

                    <h5><strong> Apakah anda yakin akan menghapus Kategori <?= $_COOKIE['nama_kategori'] ?>..?</strong></h5>

                    <p>Data yang sudah dihapus tidak dapat dikembalikan lagi.</p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('kategori/delete/' . $_COOKIE['id_kategori']) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>