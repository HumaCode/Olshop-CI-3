<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="<?= base_url() ?>assets/img/slider/slider1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url() ?>assets/img/slider/slider2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url() ?>assets/img/slider/slider3.jpg" alt="Third slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url() ?>assets/img/slider/slider4.jpg" alt="Fourth slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- Default box -->
<div class="card card-solid">
    <div class="card-body">
        <div class="row d-flex align-items-stretch">


            <?php if (empty($barang)) { ?>
                <div class="card-body bg-danger text-center">
                    <h4>Data kategori <?= $kategori['nama_kategori']; ?> belum ada.!</h4>
                </div>
            <?php } ?>



            <?php foreach ($barang as $b) { ?>

                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-stretch mb-3 ">
                    <div class="card bg-light">
                        <div class="card-header border-bottom-0 bg-secondary">
                            <h6><strong><?= $b['nama_barang'] ?></strong></h6>
                        </div>

                        <div class="card-body pt-0">
                            <p class="text-muted text-sm"><strong>Kategori : </strong> <?= $b['nama_kategori'] ?></p>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img src="<?= base_url('assets/img/produk/' . $b['gambar']) ?>" alt="" class="img-circle img-fluid mt-2">
                                </div>
                            </div>
                        </div>

                        <div class="ml-3 mb-2">
                            <h5><span class="text-danger"> Harga :</span>
                                <strong class="badge badge-secondary"><?= 'Rp. ' . number_format($b['harga'], 0, ',', '.') ?></strong>
                            </h5>
                        </div>

                        <div class="card-footer">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-left">
                                        <a href="<?= base_url('home/detail_barang/' . $b['id_barang']) ?>" class="btn btn-xs btn-success btn-block mb-2"><i class="fas fa-eye  mr-1"></i>Detail
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <?= anchor('belanja/add/' . $b['id_barang'], '<div class="btn btn-xs btn-primary btn-block swalDefaultSuccess"><i class="fas fa-cart-plus mr-1"></i>Add</div>') ?>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>