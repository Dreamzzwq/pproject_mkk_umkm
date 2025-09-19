-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2025 at 02:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail`
--

CREATE TABLE `tb_detail` (
  `id_detail` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `subtotal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_detail`
--

INSERT INTO `tb_detail` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga_satuan`, `subtotal`) VALUES
(53, 40, 28, 1, 17000, 17000),
(57, 44, 31, 1, 300000, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Kerajinan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `id_kategori` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id`, `nama`, `harga`, `stok`, `foto`, `deskripsi`, `id_kategori`) VALUES
(9, 'Empal Gentong', 30000, 18, 'assets/empalgentong.jpg', 'Gulai daging sapi khas Cirebon dengan kuah santan gurih.', 1),
(10, 'Nasi Lengko', 18000, 20, 'assets/nasilengko.jpg', 'Nasi dengan tahu, tempe, tauge, dan sambal kacang khas Cirebon.', 1),
(11, 'Tahu Gejrot', 10000, 30, 'assets/tahugejrot.jpg', 'Tahu goreng dengan bumbu kuah pedas manis khas Cirebon.', 1),
(12, 'Docang', 15000, 22, 'assets/docang.jpg', 'Nasi dengan lontong, tauge, daun singkong, kerupuk, dan sambal oncom.', 1),
(13, 'Mie Koclok', 17000, 25, 'assets/miekoclok.jpg', 'Mie kuah kental dengan suwiran ayam khas Cirebon.', 1),
(14, 'Sate Kalong', 25000, 15, 'assets/satekalong.jpg', 'Sate khas Cirebon dari daging sapi manis gurih, bukan kelelawar.', 1),
(15, 'Empal Asem', 28000, 12, 'assets/empalasem.jpg', 'Empal sapi dengan kuah bening segar asam khas Cirebon.', 1),
(16, 'Bubur Sop', 16000, 20, 'assets/bubursop.jpg', 'Bubur nasi khas Cirebon dengan kuah sop gurih.', 1),
(17, 'Sega Bogana', 20000, 15, 'assets/segabogana.jpg', 'Nasi dengan lauk pauk beragam dibungkus daun pisang.', 1),
(18, 'Sate Kentang', 8000, 40, 'assets/satekentang.jpg', 'Kentang goreng dibentuk bola-bola ditusuk sate khas Cirebon.', 1),
(19, 'Gado-Gado Cirebon', 18000, 18, 'assets/1758241434_225.avif', 'Sayuran rebus dengan bumbu kacang khas Cirebon.', 1),
(21, 'Empal Gentong Spesial', 35000, 15, 'assets/1758241309_320.jpeg', 'Empal gentong dengan tambahan usus dan babat khas Cirebon.', 1),
(22, 'Sate Ayam Cirebon', 20000, 30, 'assets/1758241133_567.jpeg', 'Sate ayam dengan bumbu kacang khas Cirebon.', 1),
(23, 'Lontong Kari', 18000, 25, 'assets/1758241037_929.jpg', 'Lontong dengan kuah kari gurih khas Cirebon.', 1),
(24, 'Bubur Ayam Cirebon', 15000, 28, 'assets/1758240927_950.jpg', 'Bubur ayam gurih dengan topping ayam suwir dan cakwe.', 1),
(25, 'Nasi Lengko Telur Dadar', 20000, 22, 'assets/1758240847_386.jpeg', 'Nasi lengko khas Cirebon ditambah telur dadar tebal.', 1),
(26, 'Sate Kambing Cirebon', 30000, 18, 'assets/1758240767_268.jpg', 'Sate kambing empuk dengan bumbu kecap dan sambal khas Cirebon.', 1),
(27, 'Gulai Kambing Cirebon', 35000, 12, 'assets/1758240699_551.avif', 'Gulai kambing kuah santan gurih khas Cirebon.', 1),
(28, 'Nasi Kuning Cirebon', 17000, 19, 'assets/1758240595_162.jpeg', 'Nasi kuning dengan lauk pauk sederhana khas Cirebon.', 1),
(31, 'yuew', 300000, 2, 'assets/1758245890_320.jpeg', 'daad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_harga` int NOT NULL,
  `metode_bayar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode_kirim` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_kirim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pelanggan`, `tanggal`, `total_harga`, `metode_bayar`, `metode_kirim`, `alamat_kirim`, `status`) VALUES
(24, 21, '2025-09-18 15:53:52', 40000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(25, 21, '2025-09-18 16:14:43', 15000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(26, 21, '2025-09-18 16:15:37', 25000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(27, 21, '2025-09-18 16:44:21', 25000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(28, 21, '2025-09-18 16:44:53', 25000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(29, 21, '2025-09-18 16:50:09', 30000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(30, 21, '2025-09-18 19:00:52', 30000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(31, 21, '2025-09-18 19:02:24', 25000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(32, 21, '2025-09-18 19:02:57', 25000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(36, 21, '2025-09-19 06:45:43', 30000, 'Bank', 'Silintar Delivery', 'smknegeri2cirebon', 'baru'),
(37, 21, '2025-09-19 06:48:00', 235000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(38, 21, '2025-09-19 06:48:48', 25000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(39, 21, '2025-09-19 06:49:01', 25000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(40, 21, '2025-09-19 07:43:49', 17000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(41, 21, '2025-09-19 07:43:56', 40000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(42, 21, '2025-09-19 07:54:06', 10000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(43, 21, '2025-09-19 07:56:34', 39999, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru'),
(44, 21, '2025-09-19 08:59:13', 300000, 'Qris', 'Grab Express', 'smknegeri2cirebon', 'baru');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pelanggan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `username`, `password`, `hp`, `alamat`, `role`) VALUES
(20, 'dimascantik', 'dimaslovevania@gmail.com', 'anjay', 'dimas123', '08876777723', 'smknegeir2cirebon', 'pelanggan'),
(21, 'admineper', 'admin@yahoo.com', 'admineper', 'admin321', '087657823', 'smknegeri2cirebon', 'admin'),
(24, 'erwinaja', 'erwing@gmail.com', 'erwinganteng', 'erwin123', '07822824', 'smknegeri1cirebon', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_transaksi` (`id_transaksi`),
  ADD KEY `fk_detail_produk` (`id_produk`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produk_kategori` (`id_kategori`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_user` (`id_pelanggan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail`
--
ALTER TABLE `tb_detail`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON DELETE CASCADE;

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
