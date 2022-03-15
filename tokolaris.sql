-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Mar 2022 pada 00.44
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

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
-- Prosedur
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
-- Fungsi
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
-- Struktur dari tabel `tbl_arus_barang`
--

CREATE TABLE `tbl_arus_barang` (
  `id_arus_barang` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `tgl_arus_barang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_arus_barang`
--

INSERT INTO `tbl_arus_barang` (`id_arus_barang`, `id_produk`, `qty`, `keterangan`, `tgl_arus_barang`) VALUES
(1, 1, 2, 'masuk', '2022-03-15 00:39:22'),
(2, 2, 98, 'masuk', '2022-03-15 00:39:56'),
(3, 3, 3, 'masuk', '2022-03-15 00:40:52'),
(4, 4, 4, 'masuk', '2022-03-15 00:42:15'),
(5, 1, 1, 'keluar', '2022-03-15 00:43:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(5) NOT NULL,
  `id_pesanan` int(5) NOT NULL,
  `total_harga` int(15) NOT NULL,
  `tgl_pembayaran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_pesanan`, `total_harga`, `tgl_pembayaran`) VALUES
(1, 1, 100000, '2022-03-15 00:43:41');

--
-- Trigger `tbl_pembayaran`
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
-- Struktur dari tabel `tbl_pesanan`
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
-- Dumping data untuk tabel `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `id_produk`, `id_pembeli`, `qty`, `tgl_pesanan`, `pesan`) VALUES
(1, 1, 2, 1, '2022-03-15 00:43:28', 'Tolong segera dikirim,karena akan saya pakai besok lusa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
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
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `harga_produk`, `stok`, `deskripsi_produk`, `id_supplier`) VALUES
(1, 'Sepatu Menggokil XD', 50000, 1, 'Sepatu yang dapat membuatmu menggokil', 4),
(2, 'Sepatu Adadas ', 1250000, 98, 'Sepatu mahal nih boss,beli dong', 3),
(3, 'Sepatu NIKE ARDILLA', 100000, 3, 'Sepatu warna biru yang kemren abis bro', 4),
(4, 'Sepatu Menggokil XXL ', 500000, 4, 'Sepatu berkualitas premium,dibuat dengan sisik ular alami', 4);

--
-- Trigger `tbl_produk`
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
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '123', 'admin@gmail.com', 'admin'),
(2, 'frendy', '123', 'frendyrahma26@gmail.com', 'pembeli'),
(3, 'sella', '123', 'sellachan26@gmail.com', 'supplier'),
(4, 'keni', '123', 'kenikeni@gmail.com', 'supplier');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_supplier`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_supplier` (
`id_user` int(5)
,`username` varchar(50)
,`role` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_supplier`
--
DROP TABLE IF EXISTS `v_supplier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_supplier`  AS SELECT `tbl_user`.`id_user` AS `id_user`, `tbl_user`.`username` AS `username`, `tbl_user`.`role` AS `role` FROM `tbl_user` WHERE (`tbl_user`.`role` = 'supplier')  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_arus_barang`
--
ALTER TABLE `tbl_arus_barang`
  ADD PRIMARY KEY (`id_arus_barang`);

--
-- Indeks untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_arus_barang`
--
ALTER TABLE `tbl_arus_barang`
  MODIFY `id_arus_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
