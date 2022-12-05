<div class="col-12">


    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-shopping-cart"></i> <?= $title ?>
                    <small class="float-right">Tahun : <?= $tahun ?></small>
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
                            <th>Tanggal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        $grand_total = 0;
                        foreach ($laporan as $lt) {

                            $grand_total = $grand_total + $lt['grand_total'];
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $lt['no_order'] ?></td>
                                <td><?= $lt['tgl_order'] ?></td>
                                <td><?= 'Rp. ' . number_format($lt['grand_total'], 0, ',', '.') ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <div class="float-right mr-4">
                    <h3>Grand Total : <?= 'Rp. ' . number_format($grand_total, 0, ',', '.') ?> </h3>
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