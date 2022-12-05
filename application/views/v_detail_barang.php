<!-- Default box -->
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?= $barang['nama_barang'] ?></h3>
                <div class="col-12">
                    <img src="<?= base_url('assets/img/produk/' . $barang['gambar']) ?>" class="product-image" alt="<?= $barang['gambar'] ?>">
                </div>
                <div class="col-12 product-image-thumbs">

                    <div class="product-image-thumb active"><img src="<?= base_url('assets/img/produk/' . $barang['gambar']) ?>" alt="<?= $barang['gambar'] ?>"></div>

                    <?php foreach ($gambar as $g) { ?>
                        <div class="product-image-thumb"><img src="<?= base_url('assets/img/produk-detail/' . $g['gambar']) ?>" alt="<?= $g['gambar'] ?>"></div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-12 col-sm-6">

                <h3 class="my-3"><?= $barang['nama_barang'] ?></h3>
                <hr>
                <h4><?= $barang['nama_kategori'] ?></h4>
                <hr>
                <p><?= $barang['deskripsi'] ?></p>
                <hr>


                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        <?= 'Rp. ' . number_format($barang['harga'], 0, ',', '.') ?>
                    </h2>
                </div>
                <hr>

                <h4>Stok : <?= $barang['stok'] ?></h4>
                <hr>




                <?= form_open('belanja/add/' . $barang['id_barang']) ?>
                <div class="mt-4">
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" class="form-control" value="1" min="1" name="qty" autocomplete="off">
                        </div>
                        <div class="col-sm-8">


                            <button type="submit" class="btn btn-primary swalDefaultSuccess"><i class="fas fa-cart-plus mr-2"></i>Tambah Ke Keranjang</button>

                        </div>
                    </div>
                </div>
                <?= form_close() ?>

            </div>
        </div>



    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- SweetAlert2 -->
<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="<?= base_url() ?>template/dist/js/demo.js"></script>



<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });




        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Ditambahkan Ke Keranjang.!'
            })
        });
    });
</script>