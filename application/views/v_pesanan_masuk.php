<div class="col-md-12">

    <?php

    if ($this->session->flashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>';
        echo $this->session->flashdata('pesan');
        echo '</div>';
    }

    ?>

    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Dikemas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dikirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <table class="table table-striped table-responsive-md">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>
                        </tr>

                        <?php foreach ($pesanan as $p) : ?>
                            <tr>
                                <td><?= $p['no_order'] ?></td>
                                <td><?= $p['tgl_order'] ?></td>
                                <td>
                                    <strong><?= $p['expedisi'] ?></strong><br>
                                    paket : <?= $p['paket'] ?><br>
                                    ongkir : <?= "Rp. " . number_format($p['ongkir'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?= "Rp. " . number_format($p['total_bayar'], 0, ',', '.') ?><br>

                                    <?php if ($p['status_bayar'] == 0) { ?>
                                        <span class="badge badge-warning">Belum Bayar</span>
                                    <?php } else { ?>
                                        <span class="badge badge-success">Sudah Bayar</span><br>
                                        <span class="badge badge-primary">Menunggu Verifikasi</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($p['status_bayar'] == 1) { ?>
                                        <button class="btn btn-sm btn-success btn-flat mb-2 mt-2" data-toggle="modal" data-target="#cek<?= $p['id_transaksi'] ?>">Lihat Bukti Bayar</button>
                                        <a href="<?= base_url('admin/proses/' . $p['id_transaksi']) ?>" class="btn btn-sm btn-primary">Proses</a>

                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table table-striped table-responsive-md">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>
                        </tr>

                        <?php foreach ($pesanan_diproses as $pp) : ?>
                            <tr>
                                <td><?= $pp['no_order'] ?></td>
                                <td><?= $pp['tgl_order'] ?></td>
                                <td>
                                    <strong><?= $pp['expedisi'] ?></strong><br>
                                    paket : <?= $pp['paket'] ?><br>
                                    ongkir : <?= "Rp. " . number_format($pp['ongkir'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?= "Rp. " . number_format($pp['total_bayar'], 0, ',', '.') ?><br>

                                    <span class="badge badge-primary">Diproses/Dikemas</span>


                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#kirim<?= $pp['id_transaksi'] ?>"><i class="fas fa-paper-plane mr-1"></i> Kirim</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    <table class="table table-striped table-responsive-md">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>No. Resi</th>
                        </tr>

                        <?php foreach ($pesanan_dikirim as $pd) : ?>
                            <tr>
                                <td><?= $pd['no_order'] ?></td>
                                <td><?= $pd['tgl_order'] ?></td>
                                <td>
                                    <strong><?= $pd['expedisi'] ?></strong><br>
                                    paket : <?= $pd['paket'] ?><br>
                                    ongkir : <?= "Rp. " . number_format($pd['ongkir'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?= "Rp. " . number_format($pd['total_bayar'], 0, ',', '.') ?><br>

                                    <span class="badge badge-success">Dikirim</span>

                                </td>
                                <td>
                                    <h4><strong><?= $pd['no_resi'] ?></strong></h4>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                    <table class="table table-striped table-responsive-md">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal</th>
                            <th>Expedisi</th>
                            <th>Total Bayar</th>
                            <th>No. Resi</th>
                            <th>Status</th>
                        </tr>

                        <?php foreach ($pesanan_selesai as $ps) : ?>
                            <tr>
                                <td><?= $ps['no_order'] ?></td>
                                <td><?= $ps['tgl_order'] ?></td>
                                <td>
                                    <strong><?= $ps['expedisi'] ?></strong><br>
                                    paket : <?= $ps['paket'] ?><br>
                                    ongkir : <?= "Rp. " . number_format($ps['ongkir'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?= "Rp. " . number_format($ps['total_bayar'], 0, ',', '.') ?><br>

                                    <span class="badge badge-success">Diterima</span>

                                </td>
                                <td>
                                    <h4><strong><?= $ps['no_resi'] ?></strong></h4>
                                </td>
                                <td>
                                    <h4><span class="badge badge-success">Selesai</span></h4>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>



<!-- Modal Bukti pembayaran -->
<?php foreach ($pesanan as $p) { ?>

    <div class="modal fade" id="cek<?= $p['id_transaksi'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $p['no_order'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <tr>
                            <th>Nama Bank</th>
                            <th>:</th>
                            <td><?= $p['nama_bank'] ?></td>
                        </tr>
                        <tr>
                            <th>No. Rek</th>
                            <th>:</th>
                            <td><?= $p['no_rek'] ?></td>
                        </tr>
                        <tr>
                            <th>Atas Nama</th>
                            <th>:</th>
                            <td><?= $p['atas_nama'] ?></td>
                        </tr>
                        <tr>
                            <th>Total Bayar</th>
                            <th>:</th>
                            <td><?= 'Rp. ' . number_format($p['total_bayar'], 0, ',', '.') ?></td>
                        </tr>
                    </table>

                    <img src="<?= base_url('assets/img/bukti_bayar/' . $p['bukti_bayar']) ?>" class="img-fluid pad" alt="">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<?php } ?>




<!-- modal kirim resi -->
<?php foreach ($pesanan_diproses as $pp) { ?>
    <div class="modal fade" id="kirim<?= $pp['id_transaksi'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $pp['no_order'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?= form_open('admin/kirim_resi/' . $pp['id_transaksi']) ?>
                    <table class="table">
                        <tr>
                            <th>Expedisi</th>
                            <th>:</th>
                            <td><?= $pp['expedisi'] ?></td>
                        </tr>

                        <tr>
                            <th>Paket</th>
                            <th>:</th>
                            <td><?= $pp['paket'] ?></td>
                        </tr>

                        <tr>
                            <th>Ongkir</th>
                            <th>:</th>
                            <td><?= 'Rp. ' . number_format($pp['ongkir'], 0, ',', '.') ?></td>
                        </tr>

                        <tr>
                            <th>No. Resi</th>
                            <th>:</th>
                            <td><input type="text" name="no_resi" class="form-control" placeholder="Masukan Nomor Resi" required></td>
                        </tr>
                    </table>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
                <?= form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>