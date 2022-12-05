<div class="col-md">
    <!-- general form elements disabled -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Edit Barang</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            // notifikasi gagal upload gambar.
            if (isset($error_upload)) {

                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>' . $error_upload . '</h5></div>';
            }
            ?>
            <?= form_open_multipart('barang/edit/' . $barang['id_barang']) ?>

            <div class="form-group">
                <label>Nama Barang</label>
                <input name="nama_barang" class="form-control" placeholder="Nama Barang" value="<?= $barang['nama_barang'] ?>">
                <?= form_error('nama_barang', '<small class="text-danger pl-2">', '</small>'); ?>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <label>Berat</label>
                    <input type="number" name="berat" min="1" class="form-control" value="<?= $barang['berat'] ?>">
                    <?= form_error('berat', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>

                <div class="col-sm-6">
                    <label>Stok</label>
                    <input name="stok" type="number" min="1" class="form-control" value="<?= $barang['stok'] ?>">
                    <?= form_error('stok', '<small class="text-danger pl-2">', '</small>'); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="nama_kategori" class="form-control">
                            <option value="">-- Pilih Kategori --</option>

                            <?php foreach ($kategori as $k) { ?>
                                <?php if ($k['id_kategori'] == $barang['id_kategori']) { ?>
                                    <option value="<?= $k['id_kategori'] ?>" selected><?= $k['nama_kategori'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                                <?php } ?>
                            <?php } ?>

                        </select>
                        <?= form_error('nama_kategori', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Harga</label>
                        <input name="harga" class="form-control" placeholder="Harga" value="<?= $barang['harga'] ?>">
                    </div>
                    <?= form_error('harga', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" cols="30" rows="7"><?= $barang['deskripsi'] ?></textarea>
                <?= form_error('deskripsi', '<small class="text-danger pl-2">', '</small>'); ?>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="preview_gambar">
                    </div>
                </div>

                <div class="col-sm-6">
                    <label class="ml-4">Preview</label>
                    <div class="form-group">
                        <img src="<?= base_url('assets/img/produk/' . $barang['gambar']) ?>" class="img-thumbnail ml-4" width="250" alt="" id="gambar_load">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm btn-block">Simpan</button>
                <a href="<?= base_url('barang') ?>" class="btn btn-success btn-sm btn-block">Kembali</a>
            </div>
            <?= form_close() ?>

        </div>
    </div>
</div>



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