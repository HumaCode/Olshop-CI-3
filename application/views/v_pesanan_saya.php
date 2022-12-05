<div class="row">



    <div class="col-12">

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
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Saya</a>
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
                        <table class="table table-striped">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal</th>
                                <th>Expedisi</th>
                                <th>Total Bayar</th>
                                <th>Aksi</th>
                            </tr>

                            <?php foreach ($belum_bayar as $bb) : ?>
                                <tr>
                                    <td><?= $bb['no_order'] ?></td>
                                    <td><?= $bb['tgl_order'] ?></td>
                                    <td>
                                        <strong><?= $bb['expedisi'] ?></strong><br>
                                        paket : <?= $bb['paket'] ?><br>
                                        ongkir : <?= "Rp. " . number_format($bb['ongkir'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?= "Rp. " . number_format($bb['total_bayar'], 0, ',', '.') ?><br>

                                        <?php if ($bb['status_bayar'] == 0) { ?>
                                            <span class="badge badge-warning">Belum Bayar</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Sudah Bayar</span><br>
                                            <span class="badge badge-primary">Menunggu Verifikasi</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($bb['status_bayar'] == 1) { ?>
                                            <span class="badge badge-success">LUNAS</span>
                                        <?php } else { ?>
                                            <a href="<?= base_url('pesanan_saya/bayar/' . $bb['id_transaksi']) ?>" class="btn btn-sm btn-primary">Bayar Sekarang</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                        <table class="table table-striped">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal</th>
                                <th>Expedisi</th>
                                <th>Total Bayar</th>
                            </tr>

                            <?php foreach ($dikemas as $dk) : ?>
                                <tr>
                                    <td><?= $dk['no_order'] ?></td>
                                    <td><?= $dk['tgl_order'] ?></td>
                                    <td>
                                        <strong><?= $dk['expedisi'] ?></strong><br>
                                        paket : <?= $dk['paket'] ?><br>
                                        ongkir : <?= "Rp. " . number_format($dk['ongkir'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?= "Rp. " . number_format($dk['total_bayar'], 0, ',', '.') ?><br>

                                        <span class="badge badge-success">Terverifikasi</span><br>
                                        <span class="badge badge-primary">Sedang Diproses</span>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        <table class="table table-striped">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal</th>
                                <th>Expedisi</th>
                                <th>Total Bayar</th>
                                <th>No. Resi</th>
                                <th>Action</th>
                            </tr>

                            <?php foreach ($dikirim as $krm) : ?>
                                <tr>
                                    <td><?= $krm['no_order'] ?></td>
                                    <td><?= $krm['tgl_order'] ?></td>
                                    <td>
                                        <strong><?= $krm['expedisi'] ?></strong><br>
                                        paket : <?= $krm['paket'] ?><br>
                                        ongkir : <?= "Rp. " . number_format($krm['ongkir'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?= "Rp. " . number_format($krm['total_bayar'], 0, ',', '.') ?><br>

                                        <span class="badge badge-success">Dikirim</span>

                                    </td>
                                    <td>
                                        <h4><strong><?= $krm['no_resi']; ?></strong></h4>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#diterima<?= $krm['id_transaksi'] ?>">Diterima</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                        <table class="table table-striped">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal</th>
                                <th>Expedisi</th>
                                <th>Total Bayar</th>
                                <th>No. Resi</th>
                                <th>Status</th>
                            </tr>

                            <?php foreach ($selesai as $end) : ?>
                                <tr>
                                    <td><?= $end['no_order'] ?></td>
                                    <td><?= $end['tgl_order'] ?></td>
                                    <td>
                                        <strong><?= $end['expedisi'] ?></strong><br>
                                        paket : <?= $end['paket'] ?><br>
                                        ongkir : <?= "Rp. " . number_format($end['ongkir'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?= "Rp. " . number_format($end['total_bayar'], 0, ',', '.') ?><br>

                                        <span class="badge badge-success">Diterima</span>

                                    </td>
                                    <td>
                                        <h4><strong><?= $end['no_resi']; ?></strong></h4>
                                    </td>
                                    <td>
                                        <h5><span class="badge badge-success">Selesai</span></h5>
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
</div>
</div>


<!-- Modal diterima/barang telah diterima -->
<?php foreach ($dikirim as $krm) { ?>
    <div class="modal fade" id="diterima<?= $krm['id_transaksi'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pesanan Diterima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah pesanan anda sudah diterima..?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('pesanan_saya/diterima/' . $krm['id_transaksi']) ?>" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>