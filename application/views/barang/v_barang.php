<div class="col-md">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Barang</h3>

            <div class="card-tools">
                <a href="<?= base_url('barang/tambah_barang') ?>" class="btn btn-success btn-xs"><i class="fas fa-plus"> Tambah Barang</i>
                </a>
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
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>


                    <?php $no = 1;
                    foreach ($barang as $b) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b['nama_barang'] ?></td>
                            <td><?= $b['nama_kategori'] ?></td>
                            <td><?= 'Rp. ' . number_format($b['harga'], 0, ',', '.') ?></td>
                            <td><?= $b['deskripsi'] ?></td>
                            <td class="text-center"> <img src="<?= base_url('assets/img/produk/' . $b['gambar']) ?>" alt="" class="img-thumbnail" width="100"> </td>

                            <td class="text-center">
                                <a href="<?= base_url('barang/edit/') . $b['id_barang']  ?>" class="btn btn-sm btn-primary m-1"><i class="fa fa-pen"></i></a>
                                <button class="btn btn-sm btn-danger " data-toggle="modal" data-target="#delete<?= $b['id_barang'] ?>"><i class="fa fa-trash"></i></button>
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



<!-- /.modal Delete-->
<?php foreach ($barang as $b) { ?>
    <div class="modal fade" id="delete<?= $b['id_barang'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-primary">
                    <h4 class="modal-title">Hapus <strong><?= $b['nama_barang'] ?></strong>..?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">

                    <h5><strong> Apakah anda yakin akan menghapus data <?= $b['nama_barang'] ?>..?</strong></h5>

                    <p>Data yang sudah dihapus tidak dapat dikembalikan lagi.</p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('barang/delete/' . $b['id_barang']) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>