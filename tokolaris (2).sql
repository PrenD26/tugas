-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2022 at 11:01 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokolaris`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `bayarProduk` (IN `idPesanan` INT(5), IN `totalHarga` INT(15), IN `tglPembayaran` VARCHAR(20))   BEGIN
DECLARE cekPembayaran BOOLEAN;
START TRANSACTION;
INSERT INTO tbl_pembayaran
VALUES (null,idPesanan,totalHarga,tglPembayaran);
SET cekPembayaran = ROW_COUNT();
IF cekPembayaran IS TRUE THEN
COMMIT;
ELSE 
ROLLBACK;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailPesanan` (IN `id` INT(5))   BEGIN
SELECT * FROM `tbl_pesanan` 
LEFT JOIN tbl_pembayaran USING(id_pesanan) 
JOIN tbl_produk USING(id_produk) 
JOIN tbl_user ON id_pembeli = id_user
WHERE id_pesanan = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailProduk` (IN `id` INT(5))   BEGIN
SELECT p.id_produk, p.nama_produk, 
p.harga_produk, p.stok, p.deskripsi_produk
,p.id_supplier,u.username 
FROM `tbl_produk` p 
JOIN `tbl_user` u ON 
p.id_supplier = u.id_user 
WHERE p.id_produk = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPesanan` ()   BEGIN
SELECT * FROM `tbl_pesanan` 
LEFT JOIN tbl_pembayaran USING(id_pesanan) 
JOIN tbl_produk USING(id_produk) 
JOIN tbl_user ON id_pembeli = id_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pesanProduk` (IN `idProduk` INT(5), IN `idPembeli` INT(5), IN `qty` INT(5), IN `tglPesanan` VARCHAR(20), IN `pesan` TEXT)   BEGIN
DECLARE cekPesanan BOOLEAN;
START TRANSACTION;
INSERT INTO tbl_pesanan
VALUES (null,idProduk,idPembeli,qty,tglPesanan,pesan);
SET cekPesanan = ROW_COUNT();
IF cekPesanan IS TRUE THEN
COMMIT;
ELSE 
ROLLBACK;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahStok` (IN `idProduk` INT(5), IN `tambahanStok` INT(5))   BEGIN
UPDATE tbl_produk
SET stok = stok + tambahanStok
WHERE id_produk = idProduk;

INSERT INTO tbl_arus_barang
VALUES(null,idProduk,tambahanStok,
'masuk',CURRENT_TIMESTAMP);

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getIdProduk` (`idPesanan` INT(5)) RETURNS INT(5)  BEGIN
DECLARE idProduk INT;
SELECT id_produk INTO idProduk 
FROM tbl_pesanan
WHERE id_pesanan = idPesanan;
RETURN idProduk;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `getQty` (`idPesanan` INT(5)) RETURNS INT(5)  BEGIN
DECLARE getQty INT;
SELECT qty INTO getQty 
FROM tbl_pesanan
WHERE id_pesanan = idPesanan;
RETURN getQty;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_arus_barang`
--

CREATE TABLE `tbl_arus_barang` (
  `id_arus_barang` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `tgl_arus_barang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_arus_barang`
--

INSERT INTO `tbl_arus_barang` (`id_arus_barang`, `id_produk`, `qty`, `keterangan`, `tgl_arus_barang`) VALUES
(1, 1, 1, 'keluar', '2020-11-04 03:48:28'),
(2, 2, 2, 'keluar', '2020-11-04 03:49:12'),
(4, 3, 1, 'keluar', '2020-11-05 09:19:43'),
(5, 4, 1, 'keluar', '2020-11-05 13:44:58'),
(6, 4, 2, 'keluar', '2020-11-05 13:45:11'),
(7, 5, 5, 'keluar', '2020-11-05 14:39:52'),
(8, 5, 10, 'masuk', '2020-11-05 14:42:07'),
(9, 4, 11, 'keluar', '2020-11-05 16:35:14'),
(10, 2, 1, 'keluar', '2022-03-07 13:02:16'),
(11, 7, 30, 'masuk', '2022-03-14 08:39:33'),
(12, 8, 80, 'masuk', '2022-03-14 08:49:48'),
(13, 8, 2, 'masuk', '2022-03-14 08:54:19'),
(14, 9, 2, 'masuk', '2022-03-14 10:58:51'),
(15, 9, 2, 'keluar', '2022-03-14 11:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(5) NOT NULL,
  `id_pesanan` int(5) NOT NULL,
  `total_harga` int(15) NOT NULL,
  `tgl_pembayaran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_pesanan`, `total_harga`, `tgl_pembayaran`) VALUES
(7, 9, 2750000, '2020-11-05 16:35:14'),
(9, 11, 100000, '2022-03-14 11:00:06');

--
-- Triggers `tbl_pembayaran`
--
DELIMITER $$
CREATE TRIGGER `produkTerjual` AFTER INSERT ON `tbl_pembayaran` FOR EACH ROW BEGIN
DECLARE newQty INT;
DECLARE newIdProduk INT;
SET newQty = getQty(NEW.id_pesanan);
SET newIdProduk = getIdProduk(NEW.id_pesanan);

UPDATE tbl_produk
SET stok = stok - newQty
WHERE id_produk = newIdProduk;

INSERT INTO tbl_arus_barang
VALUES(null,newIdProduk,newQty,
'keluar',NEW.tgl_pembayaran);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `id_pembeli` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `tgl_pesanan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `id_produk`, `id_pembeli`, `qty`, `tgl_pesanan`, `pesan`) VALUES
(9, 4, 7, 11, '2020-11-05 16:35:04', 'Tolong dibawa yang hati2'),
(11, 9, 10, 2, '2022-03-14 10:59:57', 'Tolong segera dikemas dan dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(5) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` int(5) NOT NULL,
  `stok` int(5) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `id_supplier` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `harga_produk`, `stok`, `deskripsi_produk`, `id_supplier`) VALUES
(1, 'Sepatu Nike Air Jordan 1 Retro High OG', 2569000, 15, 'Sepatu Ori', 3),
(2, 'Sepatu Nike Air Jordan 1 Low', 1429000, 24, 'Sepatu Ori', 4),
(3, 'Sepatu Nike Air Zoom Pegasus', 1438000, 29, 'Sepatu Ori', 3),
(4, 'Sepatu Nike Air Max 2021', 1488000, 6, 'Sepatu Ori', 4),
(5, 'Sepatu Nike Dunk High Up', 1438000, 15, 'Sepatu Ori', 3),
(6, 'Sepatu Nike Zoom Freak 3', 1438000, 20, 'Sepatu Ori', 6),
(9, 'Sepatu Menggokil XD', 50000, 0, 'Menggokil Banget bang xixixi', 4);

--
-- Triggers `tbl_produk`
--
DELIMITER $$
CREATE TRIGGER `insertProduk` AFTER INSERT ON `tbl_produk` FOR EACH ROW BEGIN

INSERT INTO tbl_arus_barang
VALUES(null,NEW.id_produk,NEW.stok,
'masuk',CURRENT_TIMESTAMP);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `email`, `role`) VALUES
(4, 'eko', 'eko', 'eko@gmail.com', 'supplier'),
(5, 'admin', 'admin', 'admin@gmail.com', 'admin'),
(6, 'agus', 'agus', 'agus@gmail.com', 'supplier'),
(7, 'bambang', 'bambang', 'bambang@gmail.com', 'pembeli'),
(10, 'frendy', '123', 'frendyrahma26@gmail.com', 'pembeli');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_supplier`
-- (See below for the actual view)
--
CREATE TABLE `v_supplier` (
`id_user` int(5)
,`username` varchar(50)
,`role` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `v_supplier`
--
DROP TABLE IF EXISTS `v_supplier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_supplier`  AS SELECT `tbl_user`.`id_user` AS `id_user`, `tbl_user`.`username` AS `username`, `tbl_user`.`role` AS `role` FROM `tbl_user``tbl_user`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_arus_barang`
--
ALTER TABLE `tbl_arus_barang`
  ADD PRIMARY KEY (`id_arus_barang`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_arus_barang`
--
ALTER TABLE `tbl_arus_barang`
  MODIFY `id_arus_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
