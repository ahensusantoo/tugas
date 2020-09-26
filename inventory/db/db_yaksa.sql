-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2020 pada 19.50
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_yaksa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`level_id`, `level`) VALUES
(1, 'administrator'),
(2, 'fakturis'),
(3, 'logistik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount_item` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `item_id`, `price`, `qty`, `discount_item`, `total`, `user_id`) VALUES
(1, 3, 5000, 5, 0, 25000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `kode_item` varchar(50) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `kategory_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `image` varchar(50) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `created` date DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `kode_item`, `barcode`, `nama_item`, `kategory_id`, `unit_id`, `price`, `stock`, `image`, `deskripsi`, `created`, `updated`) VALUES
(3, 'BA001', 'BA001', 'monitor', 1, 5, '5000', 4, 'item-200924-29c08a4bae.jpg', 'full HD', '2020-09-24', '2020-09-24 02:42:44'),
(4, 'BA002', 'BA002', 'PC', 1, 5, '10000', 7, 'item-200924-0c0bf917c7.jpg', 'spek gaming', NULL, '2020-09-24 03:16:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategory`
--

CREATE TABLE `tbl_kategory` (
  `kategory_id` int(11) NOT NULL,
  `nama_kategory` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategory`
--

INSERT INTO `tbl_kategory` (`kategory_id`, `nama_kategory`, `created`, `updated`) VALUES
(1, 'hardware', '2020-09-24', '2020-09-24 02:40:12'),
(2, 'pakaian', '2020-09-24', '2020-09-24 02:40:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `kode_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `created` date DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`pelanggan_id`, `kode_pelanggan`, `nama_pelanggan`, `phone`, `alamat`, `created`, `updated`) VALUES
(1, 'PE001', 'dimas', '0852523265', 'jl adisupcipto', '2020-09-24', '2020-09-24 00:15:47'),
(2, 'PE002', 'elly', '0825252', 'jl nologaten', NULL, '2020-09-24 00:30:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `sale_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `final_price` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaning` int(11) NOT NULL,
  `note` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sale`
--

INSERT INTO `tbl_sale` (`sale_id`, `invoice`, `pelanggan_id`, `total_price`, `discount`, `final_price`, `cash`, `remaning`, `note`, `date`, `user_id`, `created`) VALUES
(5, 'TJ2009250001', 2, 15000, 0, 15000, 20000, 5000, 'lunas', '2020-09-25', 2, '2020-09-25 15:39:37'),
(6, 'TJ2009250002', 1, 5000, 0, 5000, 10000, 5000, 'credit', '2020-09-25', 1, '2020-09-25 15:40:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sale_detail`
--

CREATE TABLE `tbl_sale_detail` (
  `detail_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount_item` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sale_detail`
--

INSERT INTO `tbl_sale_detail` (`detail_id`, `sale_id`, `item_id`, `price`, `qty`, `discount_item`, `total`) VALUES
(9, 5, 3, 5000, 1, 0, 5000),
(10, 5, 4, 10000, 1, 0, 10000),
(11, 6, 3, 5000, 1, 0, 5000);

--
-- Trigger `tbl_sale_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `tbl_sale_detail` FOR EACH ROW BEGIN
	UPDATE tbl_item SET stock = stock - NEW.qty
    WHERE item_id = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(100) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `item_id`, `type`, `detail`, `supplier_id`, `qty`, `date`, `created`, `updated`, `user_id`) VALUES
(7, 3, 'in', 'kulkan', 1, 13, '2020-09-24', '2020-09-24 20:36:26', '2020-09-24 13:36:26', 1),
(8, 3, 'out', 'rusak', NULL, 3, '2020-09-24', '2020-09-24 20:36:40', '2020-09-24 13:36:40', 1),
(9, 4, 'in', 'kulakan', 1, 5, '2020-09-23', '2020-09-24 23:31:12', '2020-09-24 16:31:12', 1),
(10, 4, 'in', 'satua', 1, 5, '2020-09-24', '2020-09-25 00:40:54', '2020-09-24 17:40:54', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `kode_supplier` varchar(50) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `deskripsi` text,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `kode_supplier`, `nama_supplier`, `phone`, `alamat`, `deskripsi`, `created`, `updated`) VALUES
(1, 'SU001', 'toko A', '0982828282', 'jl banguntapan', 'menjual mainan', '2020-09-23 00:00:00', '2020-09-23 13:45:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `unit_id` int(11) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  `created` date DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_unit`
--

INSERT INTO `tbl_unit` (`unit_id`, `nama_unit`, `created`, `updated`) VALUES
(4, 'kg', '2020-09-24', '2020-09-24 01:29:58'),
(5, 'pcs', '2020-09-24', '2020-09-24 01:29:58'),
(6, 'liter', '2020-09-24', '2020-09-24 01:31:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `level`, `created`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2020-09-23 00:00:00'),
(2, 'fakturis', '3ee26157a0f4db41c8bd794b9e6f05d8a583009f', 2, '2020-09-23 00:00:00'),
(3, 'logistik', 'f32de7d33fc7852aedaa8149320057fb028ada41', 3, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indeks untuk tabel `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `kategory_id` (`kategory_id`);

--
-- Indeks untuk tabel `tbl_kategory`
--
ALTER TABLE `tbl_kategory`
  ADD PRIMARY KEY (`kategory_id`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indeks untuk tabel `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indeks untuk tabel `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks untuk tabel `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indeks untuk tabel `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategory`
--
ALTER TABLE `tbl_kategory`
  MODIFY `kategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `tbl_item_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`unit_id`),
  ADD CONSTRAINT `tbl_item_ibfk_2` FOREIGN KEY (`kategory_id`) REFERENCES `tbl_kategory` (`kategory_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_sale_detail`
--
ALTER TABLE `tbl_sale_detail`
  ADD CONSTRAINT `tbl_sale_detail_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_item` (`item_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD CONSTRAINT `tbl_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `tbl_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`),
  ADD CONSTRAINT `tbl_stock_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
