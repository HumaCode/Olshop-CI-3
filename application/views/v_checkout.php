<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12 mb-4">
            <h4>
                <i class="fas fa-shopping-cart"></i> Checkout.
                <small class="float-right">Tanggal : <?= date('d-m-Y') ?></small>
            </h4>
        </div>
        <!-- /.col -->
    </div>


    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="50">Qty</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                        <th width="100">Berat</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>

                    <?php

                    // deklarasikan variabel total berat.
                    $total_berat = 0;

                    foreach ($this->cart->contents() as $items) {

                        // mengambil data dari model home.
                        $barang = $this->m_home->detail_barang($items['id']);

                        // ketika qty bertambah, maka beratnya juga akan bertambah.
                        $berat = $barang['berat'] * $items['qty'];
                        $total_berat = $total_berat + $berat;
                    ?>

                        <tr>
                            <td><?= $items['qty'] ?></td>
                            <td><?= $items['name']; ?></td>
                            <td><?= 'Rp. ' . number_format($items['price'], 0, ',', '.'); ?></td>
                            <td>Rp. <?= number_format($items['subtotal'], 0, ',', '.'); ?></td>
                            <td><?= $berat ?> Gr</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <?php

    echo form_open('belanja/checkout');

    // buat variabel no_order dengan mengisikan hari dan random string berjumlah 8 digit.
    $no_order = date('Ymd') . strtoupper(random_string('alnum', 8));

    ?>
    <div class="row ">
        <!-- accepted payments column -->
        <div class="col-8 ">
            <div class="card p-2 mt-4 card-solid mr-2">
                <div class="card-header bg-primary">
                    <strong>Tujuan :</strong>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <select name="provinsi" class="form-control" id="provinsi"></select>
                            <?= form_error('provinsi', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <select name="kota" class="form-control" id="kota"></select>
                            <?= form_error('kota', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expedisi">Expedisi</label>
                            <select name="expedisi" class="form-control" id="expedisi"></select>
                            <?= form_error('expedisi', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paket">Paket</label>
                            <select name="paket" class="form-control" id="paket"></select>
                            <?= form_error('paket', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat">
                            <?= form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kode_pos">Kode POS</label>
                            <input type="number" name="kode_pos" class="form-control" min="1" id="kode_pos">
                            <?= form_error('kode_pos', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_penerima">Nama Penerima</label>
                            <input type="text" name="nama_penerima" class="form-control" id="nama_penerima">
                            <?= form_error('nama_penerima', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tlp_penerima">Telepon Penerima</label>
                            <input type="number" name="tlp_penerima" class="form-control" id="tlp_penerima" min="1">
                            <?= form_error('tlp_penerima', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4 mt-4">

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Grand Total:</th>
                        <td>Rp. <?= number_format($this->cart->total(), 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td><?= $total_berat ?> Gram</td>
                    </tr>
                    <tr>
                        <th>Ongkir :</th>
                        <td><label id="ongkir">
                                <?php if (empty($dataOngkir)) : ?>
                                    Rp. 0
                                <?php endif; ?>
                            </label></td>
                    </tr>
                    <tr>
                        <th>Total Bayar:</th>
                        <td><label id="total_bayar">
                                <?php if (empty($total)) : ?>
                                    Rp. 0
                                <?php endif; ?>
                            </label></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- simpan transaksi -->
    <input name="no_order" value="<?= $no_order ?>" hidden>
    <input name="estimasi" hidden>
    <input name="ongkir" hidden>
    <input name="berat" value="<?= $total_berat ?>" hidden><br>
    <input name="grand_total" value="<?= $this->cart->total() ?>" hidden>
    <input name="total_bayar" hidden>
    <!-- end simpan transaksi -->

    <!-- Simpan Rincian Transaksi -->
    <?php

    $i = 1;
    foreach ($this->cart->contents() as $items) {
        echo form_hidden('qty' . $i++, $items['qty']);
    }

    ?>
    <!-- end Simpan Rincian Transaksi -->

    <!-- this row -->
    <div class="row no-print">
        <div class="col-12">
            <a href="<?= base_url('belanja') ?>" class="btn btn-danger"><i class="fas fa-backward mr-1"></i>Kembali</a>

            <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-shopping-cart text-danger mr-1"></i> Proses Checkout
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>
<!-- /.invoice -->


<script>
    // ajax untuk data provinsi dan kota
    // javascript carikan saya di dalam dokumen, ketika sudah ready/halamanya di akses maka jalankan function berikut.
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

        // input data expedisi
        // javascript, ketika kota di input, maka lakukan penggantian, dan jalankan fungsi berikut.
        $("select[name=kota]").on("change", function() {

            // jalankan ajax.
            $.ajax({
                type: "post",
                url: "<?= base_url('raja_ongkir/expedisi') ?>",
                success: function(hasil_expedisi) {
                    // console.log(hasil_expedisi);

                    $("select[name=expedisi]").html(hasil_expedisi);
                }
            });
        });

        // input data paket
        $("select[name=expedisi]").on("change", function() {

            // mendapatkan expedisi terpilih.
            // buat variabel baru yg berisi data expedisi yg dipilih.
            var expedisi_terpilih = $("select[name=expedisi]").val();

            // mendapatkan id kota tujuan yg terpilih.
            var id_kota_tujuan_terpilih = $("option:selected", "select[name=kota]").attr('id_kota');

            // mendapatkan data ongkir diambil dari total berat barang yang di checkout.
            var total_berat = <?= $total_berat ?>;


            // jalankan ajax.
            $.ajax({
                type: "post",
                url: "<?= base_url('raja_ongkir/paket') ?>",
                data: 'expedisi=' + expedisi_terpilih + '&id_kota=' + id_kota_tujuan_terpilih + '&berat=' + total_berat,
                success: function(hasil_paket) {
                    // console.log(hasil_paket);

                    $("select[name=paket]").html(hasil_paket);
                }
            });
        });


        // menampilkan jumlah ongkir, 
        // ketika paket di pilih maka lakukan perubahan dan jalankan function berikut.
        $("select[name=paket]").on("change", function() {

            // menghitung data ongkir.
            // buat variabel dataOngkir yg berisi jumlah ongkir.
            var dataOngkir = $("option:selected", this).attr('ongkir');
            // javascript, tolong carikan saya id yg namanya ongkir, di dalam html yaitu dataOngkir.

            // var angka = 15000000;
            var reverse = dataOngkir.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            $("#ongkir").html("Rp. " + ribuan)


            // menghitung total belanja+ongkir.
            var total = parseInt(dataOngkir) + parseInt(<?= $this->cart->total() ?>)
            // alert(total);
            var reverse = total.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            $("#total_bayar").html("Rp. " + ribuan)



            // mendapatkan data estimasi.
            // buat variabel namanya estimasi, yg isinya javascript, tolong carikan saya option selected dihalaman ini yg atributnya adalah estimasi.
            // kemudian, javascript  tolong carikan saya input yg name nya adalah estimasi value nya diisi dengan estimasi(variabel estimasi).
            var estimasi = $("option:selected", this).attr('estimasi');
            $("input[name=estimasi]").val(estimasi);

            // mendapatkan data ongkir
            $("input[name=ongkir]").val(dataOngkir);

            // mendapatkan data total_bayar
            $("input[name=total_bayar]").val(total);
        });
    });
</script>