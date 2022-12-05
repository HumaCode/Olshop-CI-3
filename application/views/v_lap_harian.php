<div class="col-12">


    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-shopping-cart"></i> <?= $title ?>
                    <small class="float-right">Tanggal : <?= $tanggal, '/' . $bulan, '/' . $tahun ?></small>
                </h4>
            </div>
            <!-- /.col -->
        </div>

        <!-- Table row -->
        <div class="row mt-3">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Order</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>QTY</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        $grand_total = 0;
                        foreach ($laporan as $l) {

                            $total_harga = $l['harga'] * $l['qty'];

                            $grand_total = $grand_total + $total_harga;

                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $l['no_order'] ?></td>
                                <td><?= $l['nama_barang'] ?></td>
                                <td><?= 'Rp. ' . number_format($l['harga'], 0, ',', '.') ?></td>
                                <td><?= $l['qty'] ?></td>
                                <td><?= 'Rp. ' . number_format($total_harga, 0, ',', '.') ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <div class="float-right mr-4">
                    <h3>Grand Total : <?= 'Rp. ' . number_format($grand_total, 0, ',', '.') ?></h3>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->