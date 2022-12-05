<div class="col-md">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Gambar Barang</h3>


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
                        <th width="40">No</th>
                        <th>Nama Barang</th>
                        <th>Cover</th>
                        <th>Jumlah Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $no = 1;
                    foreach ($gambar as $gb) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $gb['nama_barang'] ?></td>
                            <td class="text-center"><img src="<?= base_url('assets/img/produk/' . $gb['gambar']) ?>" alt="" class="img-thumbnail" width="100"></td>
                            <td width="150" class="text-center"><span class="badge badge-success">
                                    <h5><?= $gb['total_gambar'] ?></h5>
                                </span></td>

                            <td class="text-center">
                                <a href="<?= base_url('gambar_barang/tambah/' . $gb['id_barang']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Tambah Gambar</a>
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