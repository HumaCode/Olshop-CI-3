-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2021 pada 06.33
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_olshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga`, `deskripsi`, `gambar`, `berat`, `stok`) VALUES
(1, 'Hp Samsul Bimasakti note 2', 8, 2500000, 'Kondisi baru pakai 7 tahun', 'hp.jpg', NULL, NULL),
(2, 'Laptop Sumsang GGL4', 8, 5000000, 'Spesifikasi Ram 1 GB, internal 100 GB, intel celeron', 'laptop.jpg', NULL, NULL),
(3, 'Kemeja', 1, 550000, 'Tersedia ukuran M, L,  S,  XL', 'kemeja.jpg', NULL, NULL),
(4, 'Kamera Conan eos keos 1000', 8, 5000500, 'Kondisi baru, mulus lensa baru', 'kamera21.jpg', 300, 0),
(5, 'Jam Tangan Pria', 4, 250000, 'Terbuat dari emas KW 9', 'Jam-tangan.jpg', 90, 1),
(9, 'vga msi 1650 gddr6', 8, 3800000, 'Kondisi Baru,\r\nSpesifikasi :\r\nMemory : 4GB\r\nMerek : MSI\r\nCuda : 870', 'vga2.jpg', 550, -3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_gambar`
--

INSERT INTO `tb_gambar` (`id_gambar`, `id_barang`, `keterangan`, `gambar`) VALUES
(1, 2, 'Gambar1', 'gambar1.jpg'),
(2, 2, 'gambar2', 'gambar2.jpg'),
(3, 2, 'gambar3', 'gambar3.jpg'),
(4, 2, 'Gambar4', 'gambar4.jpg'),
(5, 4, 'gambar kamera', 'canon2.jpg'),
(7, 5, 'gambar jam', 'jam_1.jpg'),
(8, 9, 'vga', 'vga.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Pakaian Pria'),
(2, 'Pakaian Wanita'),
(4, 'Aksesoris'),
(5, 'Sepatu Pria'),
(6, 'Sepatu Wanita'),
(8, 'Elektronik'),
(9, 'Mainan Anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password`, `gambar`) VALUES
(3, 'Humaidi Zakaria', 'humaidi@gmail.com', '1234', 'default.jpg'),
(4, 'user', 'user@gmail.com', '123', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `atas_nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rekening`
--

INSERT INTO `tb_rekening` (`id_rekening`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'BRI', '3333-4444-4444-1111', 'Fulan'),
(2, 'BCA', '0000-222-1111', 'Fulan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rincian`
--

CREATE TABLE `tb_rincian` (
  `id_rincian` int(11) NOT NULL,
  `no_order` varchar(20) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rincian`
--

INSERT INTO `tb_rincian` (`id_rincian`, `no_order`, `id_barang`, `qty`) VALUES
(8, '20210227Y4JPGST6', 9, 1),
(9, '20210227Y4JPGST6', 4, 1),
(10, '20210227Y4JPGST6', 3, 1),
(11, '20210227Y4JPGST6', 1, 1),
(12, '202102271NMCXPYD', 3, 1),
(13, '202102271NMCXPYD', 1, 1),
(14, '202102271NMCXPYD', 2, 1),
(15, '202102271NMCXPYD', 4, 1),
(16, '20210227HDBCFNUQ', 1, 2),
(17, '20210227HDBCFNUQ', 4, 2),
(18, '20210227HDBCFNUQ', 5, 1),
(19, '20210227HDBCFNUQ', 9, 2),
(20, '20210303IAXEVU5J', 3, 1),
(21, '20210303IAXEVU5J', 9, 1),
(22, '20210303IAXEVU5J', 2, 1),
(23, '20210303IAXEVU5J', 1, 1),
(24, '20210303XCNOFHQK', 4, 1),
(25, '20210303XCNOFHQK', 9, 1),
(26, '20210303XCNOFHQK', 2, 1);

--
-- Trigger `tb_rincian`
--
DELIMITER $$
CREATE TRIGGER `rincian_transaksi` AFTER INSERT ON `tb_rincian` FOR EACH ROW BEGIN
	UPDATE tb_barang SET stok = stok-NEW.qty
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(50) DEFAULT NULL,
  `lokasi` int(11) DEFAULT NULL,
  `alamat_toko` text DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id`, `nama_toko`, `lokasi`, `alamat_toko`, `no_telepon`) VALUES
(1, 'Zulfa Collection', 349, 'Kajen', '082324118692');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_order` varchar(30) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_penerima` varchar(30) DEFAULT NULL,
  `tlp_penerima` varchar(15) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `expedisi` varchar(50) DEFAULT NULL,
  `paket` varchar(50) DEFAULT NULL,
  `estimasi` varchar(50) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT NULL,
  `bukti_bayar` text DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  `no_resi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pelanggan`, `no_order`, `tgl_order`, `nama_penerima`, `tlp_penerima`, `provinsi`, `kota`, `alamat`, `kode_pos`, `expedisi`, `paket`, `estimasi`, `ongkir`, `berat`, `grand_total`, `total_bayar`, `status_bayar`, `bukti_bayar`, `atas_nama`, `nama_bank`, `no_rek`, `status_order`, `no_resi`) VALUES
(6, 4, '20210227Y4JPGST6', '2021-02-27', 'Kopet', '022125454512', 'Jawa Timur', 'Sidoarjo', 'sss', '51161', 'jne', 'REG', '1-2  Hari', 17000, 850, 11850500, 11867500, 1, 'PicsArt_12-12-10_05_52.jpg', 'Humaidi', 'BRI', NULL, 0, NULL),
(7, 3, '202102271NMCXPYD', '2021-02-27', 'Sugeng', '01234568', 'Kalimantan Timur', 'Balikpapan', 'aaa', '12345', 'jne', 'OKE', '3-5  Hari', 45000, 300, 13050500, 13095500, 1, 'cupang-spade-tail.jpg', 'Lepet', 'Mandiri', '0212-5465-5454', 0, NULL),
(8, 3, '20210227HDBCFNUQ', '2021-02-27', 'Sugeng', '0123456878', 'Jawa Tengah', 'Semarang', 'aaa', '12345', 'jne', 'OKE', '3-6  Hari', 22000, 1790, 22851000, 22873000, 1, 'cupang-sawah.jpg', 'Humaidi Zakaria', 'Dana', NULL, 1, NULL),
(9, 4, '20210303IAXEVU5J', '2021-03-03', 'Susan', '0123245453232', 'Kalimantan Utara', 'Bulungan (Bulongan)', 'pekalonganssss', '51161', 'jne', 'OKE', '3-5  Hari', 60000, 550, 11850000, 11910000, 1, 'IMG_20201212_152309.jpg', 'Amir', 'BRI', NULL, 3, 'PKL123562P454152'),
(10, 4, '20210303XCNOFHQK', '2021-03-03', 'Sugeng', '012356879865', 'Bengkulu', 'Kepahiang', 'asdas', '12345', 'tiki', 'REG', '3  Hari', 45000, 850, 13800500, 13845500, 1, 'cupang-dumbo.jpg', 'Kopet', 'BCA', NULL, 3, 'KJN123532323LPJ1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level_user` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level_user`) VALUES
(1, 'Amir', 'admin', 'admin', 1),
(2, 'Humaidi', 'user', 'user', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `tb_rincian`
--
ALTER TABLE `tb_rincian`
  ADD PRIMARY KEY (`id_rincian`);

--
-- Indeks untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_rincian`
--
ALTER TABLE `tb_rincian`
  MODIFY `id_rincian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
