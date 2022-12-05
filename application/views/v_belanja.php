<div class="card card-solid">
    <div class="card-body ">
        <div class="row d-flex align-items-stretch">
            <div class="col-sm">


                <?php if ($this->session->flashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible mt-2">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>';
                    echo $this->session->flashdata('pesan');
                    echo '
                </div>';
                }

                ?>



                <?php echo form_open('belanja/update'); ?>

                <?php if (empty($this->cart->contents())) { ?>
                    <div class="bg-danger mt-2 p-3">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Keranjang Masih Kosong, Silahkan berbelanja terlebih dahulu.! <a href="<?= base_url() ?>" class="text-warning"> Klik DIsini</a></h5>
                    </div>
                <?php } else { ?>

                    <table class="table " cellpadding="6" cellspacing="1">

                        <tr>
                            <th width="90">QTY</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Berat (Gr)</th>
                            <th style="text-align:right">Harga</th>
                            <th style="text-align:right">Sub-Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>

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
                                <td><?php
                                    echo form_input(array(
                                        'name'      => $i . '[qty]',
                                        'value'     => $items['qty'],
                                        'maxlength' => '3',
                                        'size'      => '5',
                                        'type'      => 'number',
                                        'class'     => 'form-control',
                                        'min'       => '0'
                                    ));
                                    ?>
                                </td>

                                <td class="text-center"><?= $items['name']; ?></td>
                                <td class="text-center"><?= $berat ?> Gr</td>
                                <td style="text-align:right"><?= 'Rp. ' . number_format($items['price'], 0, ',', '.'); ?></td>
                                <td style="text-align:right">Rp. <?= number_format($items['subtotal'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('belanja/delete/' . $items['rowid']) ?>" class="btn btn-xs btn-danger"><i class="fas fa-times-circle"></i></a>
                                </td>
                            </tr>

                            <?php $i++; ?>

                        <?php } ?>


                        <tr>
                            <td></td>
                            <td align="right">
                                <strong>Total Berat</strong>
                            </td>
                            <td align="center">
                                <strong><?= $total_berat ?> Gr</strong>
                            </td>

                            <td align="right">
                                <strong>Total Belanja</strong>
                            </td>
                            <td align="right">
                                <strong>Rp. <?= number_format($this->cart->total(), 0, ',', '.'); ?></strong>
                            </td>
                        </tr>

                    </table>

                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i> Update</button>
                    <a href="<?= base_url('belanja/clear') ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-1"></i>Bersihkan Keranjang</a>
                    <a href="<?= base_url('belanja/checkout') ?>" class="btn btn-sm btn-success"><i class="fab fa-cc-mastercard mr-1"></i>Checkout</a>
                <?php } ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>