<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="<?= base_url() ?>" class="navbar-brand">
            <i class="fas fa-store text-primary mr-1"></i>
            <span class="brand-text font-weight-light"><strong>Toko Online</strong></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link">Home</a>
                </li>


                <!-- mengambil data kategori dari M_home -->
                <?php $kategori = $this->m_home->get_all_kategori(); ?>


                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kategori</a>

                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                        <!-- looping data kategori -->
                        <?php foreach ($kategori as $k) { ?>
                            <li><a href="<?= base_url('home/kategori/' . $k['id_kategori']) ?>" class="dropdown-item"><?= $k['nama_kategori'] ?></a></li>
                        <?php } ?>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item">Some action </a></li>
                        <li><a href="#" class="dropdown-item">Some other action</a></li>
                    </ul>
                </li>
                <!-- End Level two -->
            </ul>
            </li>
            </ul>


        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <!-- ikon pelanggan -->
            <li class="nav-item">

                <?php if ($this->session->userdata('email') == "") { ?>

                    <a class="nav-link" href="<?= base_url('pelanggan/login') ?>">
                        <strong> Login</strong>
                    </a>

                <?php } else { ?>

                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="brand-text font-weight-light mr-1"><strong> <?= $this->session->userdata('nama_pelanggan'); ?></strong></span>

                        <img src="<?= base_url('assets/img/profile/' . $this->session->userdata('gambar')) ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>

                        <a href="<?= base_url('pelanggan/akun') ?>" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Akun Saya
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="<?= base_url('pesanan_saya') ?>" class="dropdown-item">
                            <i class="fas fa-shopping-cart mr-2"></i></i> Pesanan Saya
                        </a>

                        <div class="dropdown-divider"></div>


                        <a href="<?= base_url('pelanggan/logout') ?>" class="dropdown-item dropdown-footer">Logout</a>
                    </div>

                <?php } ?>
            </li>

            <?php

            // Menentukan jumlah item yg akna di masukan ke keranjang belanja.
            $keranjang = $this->cart->contents();
            $jml_item = 0;

            foreach ($keranjang as $k) {
                $jml_item = $jml_item + $k['qty'];
            }

            ?>


            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-danger navbar-badge"><?= $jml_item ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <?php if (empty($keranjang)) { ?>
                        <div class="bg-danger p-2">
                            Keranjang Masih kosong.!
                        </div>
                    <?php } else { ?>
                        <?php foreach ($keranjang as $k) {

                            $barang = $this->m_home->detail_barang($k['id']);

                        ?>
                            <!-- Tampilan keranjang belanja / Start -->
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="<?= base_url('assets/img/produk/' . $barang['gambar']) ?>" alt=" User Avatar" class="img-size-50 mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            <?= $k['name'] ?>
                                        </h3>
                                        <p class="text-sm mb-1"><?= $k['qty'] ?> x <?= 'Rp. ' . number_format($k['price'], 0, ',', '.') ?></p>
                                        <p class="text-sm text-muted"><i class="fa fa-calculator mr-1"></i> <?= 'Rp. ' . number_format($k['subtotal'], 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- Tampilan keranjang belanja / End -->
                        <?php } ?>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="media-body text-center">
                                    <tr>
                                        <td colspan="2"> </td>
                                        <td class="right"><strong>Total :</strong></td>
                                        <td class="right"><strong> Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?></strong></td>
                                    </tr>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('belanja') ?>" class="dropdown-item dropdown-footer bg-primary">Lihat Keranjang Belanja</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer bg-success">Check Out</a>
                </div>
            </li>




        </ul>

    </div>
<?php } ?>
</nav>
<!-- /.navbar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Toko Online</a></li>
                        <li class="breadcrumb-item"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">