<div class="row">
    <div class="col-sm-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">No Rekening Toko</h3>
            </div>
            <div class="card-body">
                <p>Silahkan Transfer Ke Salah Satu Rekening Dibawah Ini Sebesar :
                <h1 class="text-primary">Rp. <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></h1>
                </p>

                <table class="table">
                    <tr>
                        <th>Bank</th>
                        <th>No. Rekening</th>
                        <th>Atas Nama</th>
                    </tr>

                    <?php foreach ($rekening as $reg) : ?>
                        <tr>
                            <td><?= $reg['nama_bank'] ?></td>
                            <td><?= $reg['no_rek'] ?></td>
                            <td><?= $reg['atas_nama'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>


    <div class="col-sm-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php echo form_open_multipart('pesanan_saya/bayar/' . $pesanan['id_transaksi']) ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="atas_nama">Atas Nama</label>
                    <input type="text" class="form-control" name="atas_nama" id="atas_nama" placeholder="Atas Nama">
                </div>
                <div class="form-group">
                    <label for="nama_bank">Nama Bank</label>
                    <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama Bank">
                </div>
                <div class="form-group">
                    <label for="no_rek">No. Rekening</label>
                    <input type="text" class="form-control" name="no_rek" id="no_rek" placeholder="No. Rekening">
                </div>
                <div class="form-group">
                    <label for="bukti_bayar" required>Bukti Pembayaran</label>
                    <input type="file" class="form-control" name="bukti_bayar" id="bukti_bayar" required>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-success">Kembali</a>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
</div>