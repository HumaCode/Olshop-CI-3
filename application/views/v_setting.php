<div class="col-md">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Setting Lokasi</h3>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->



        <div class="card-body">

            <?php

            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>';
                echo $this->session->flashdata('pesan');
                echo '</div>';
            }
            ?>


            <?= form_open('admin/setting') ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select name="provinsi" class="form-control" id="provinsi"></select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <select name="kota" class="form-control" id="kota">
                            <option value="<?= $setting['lokasi'] ?>"><?= $setting['lokasi'] ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko</label>
                        <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="<?= $setting['nama_toko'] ?>">
                        <?= form_error('nama_toko', '<small class="text-danger ">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_tlp">No. Telepon</label>
                        <input type="text" name="no_tlp" id="no_tlp" class="form-control" value="<?= $setting['no_telepon'] ?>">
                        <?= form_error('no_tlp', '<small class="text-danger ">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat_toko">Alamat Toko</label>
                <input type="text" name="alamat_toko" id="alamat_toko" class="form-control" value="<?= $setting['alamat_toko'] ?>">
                <?= form_error('alamat_toko', '<small class="text-danger ">', '</small>'); ?>
            </div>

            <div class="form-group float-right">
                <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>

                <a href="<?= base_url('admin') ?>" class="btn btn-sm btn-success">Kembali</a>
            </div>
            <?= form_close() ?>

        </div>
    </div>

</div>



<script>
    // ajax untuk data provinsi dan kota
    $(document).ready(function() {
        //  input data provinsi
        $.ajax({
            type: "post",
            url: "<?= base_url('raja_ongkir/provinsi') ?>",
            success: function(hasil_provinsi) {
                // console.log(hasil_provinsi);

                $("select[name=provinsi]").html(hasil_provinsi);
            }
        });

        // input data kota.
        $("select[name=provinsi]").on("change", function() {
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

            $.ajax({
                type: "post",
                url: "<?= base_url('raja_ongkir/kota') ?>",
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(hasil_kota) {
                    // console.log(hasil_kota);

                    $("select[name=kota]").html(hasil_kota);
                }
            });
        });
    });
</script>