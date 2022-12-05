<div class="col-md">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Gambar Barang : <span class="badge badge-warning "> <?= $barang['nama_barang'] ?></span></h3>


            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            // notifikasi gagal upload gambar.
            if (isset($error_upload)) {

                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban mb-2"></i>Alert!' . $error_upload . '</h5></div>';
            }

            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>';
                echo $this->session->flashdata('pesan');
                echo '</div>';
            }
            ?>
            <?= form_open_multipart('gambar_barang/tambah/' . $barang['id_barang']) ?>



            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Keterangan Gambar</label>
                        <input name="keterangan" class="form-control" placeholder="Keterangan Gambar" value="<?= set_value('keterangan') ?>">
                        <?= form_error('keterangan', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="preview_gambar">
                    </div>
                </div>

                <div class="col-sm-4">
                    <label class="ml-4">Preview</label>
                    <div class="form-group">
                        <img src="<?= base_url('assets/img/noimage.png') ?>" class=" ml-4 img-thumbnail" width="250" alt="" id="gambar_load">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm btn-block">Simpan</button>
                <a href="<?= base_url('gambar_barang') ?>" class="btn btn-success btn-sm btn-block">Kembali</a>
            </div>

            <?= form_close() ?>
            <hr>


            <div class="row text-center">
                <?php foreach ($gambar as $g) { ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <img src="<?= base_url('assets/img/produk-detail/' . $g['gambar']) ?>" class="ml-4" width="250" height="180" alt="" required id="gambar_load">
                        </div>
                        <p>keterangan : <?= $g['keterangan'] ?></p>

                        <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#delete<?= $g['id_gambar'] ?>"><i class="fa fa-trash mr-2"></i> Hapus</button>
                    </div>
                <?php } ?>
            </div>


        </div>
    </div>
    <!-- /.card -->
</div>


<!-- /.modal Delete-->
<?php foreach ($gambar as $b) { ?>
    <div class="modal fade" id="delete<?= $b['id_gambar'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-primary">
                    <h4 class="modal-title">Hapus <strong><?= $b['keterangan'] ?></strong>..?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center ">

                    <div class="form-group ">
                        <img src="<?= base_url('assets/img/produk-detail/' . $g['gambar']) ?>" class="ml-4" width="250" height="180" alt="" required id="gambar_load">
                    </div>
                    <h5><strong> Apakah anda yakin akan menghapus foto ini..?</strong></h5>

                    <p>Data yang sudah dihapus tidak dapat dikembalikan lagi.</p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('gambar_barang/delete/' . $b['id_barang'] . '/' . $b['id_gambar']) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>


<!-- javascript untuk menampilkan gambar sebelum di submit -->
<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function() {
        bacaGambar(this);
    });
</script>