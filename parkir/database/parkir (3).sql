-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Okt 2026 pada 11.25
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_area_parkir`
--

CREATE TABLE `tb_area_parkir` (
  `id_area` int(11) NOT NULL,
  `nama_area` varchar(50) NOT NULL,
  `kapasitas` int(20) NOT NULL,
  `terisi` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(4, 'area motor', 32, 10),
(9, 'area mobil', 20, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `plat_nomer` varchar(50) NOT NULL,
  `jenis_kendaraan` varchar(30) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `penilik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomer`, `jenis_kendaraan`, `warna`, `penilik`) VALUES
(2021, 'D 2378 TOYO', 'Motor', 'biru', 'fabin'),
(2023, 'Z 2454 SD', 'motor', 'hitam', 'bim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(15) NOT NULL,
  `aktivitas` varchar(100) NOT NULL,
  `waktu_aktivitas` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu_aktivitas`) VALUES
(1, 1, 'Login ke sistem', '2026-09-09 06:55:00.000000'),
(2, 2, 'Mencatat kendaraan masuk', '2026-09-09 07:00:00.000000'),
(16, 1, 'Menambahkan user baru: nadira', '2026-09-24 18:43:59.000000'),
(17, 1, 'Menambahkan kendaraan: D 0000 XGN', '2026-09-24 18:44:50.000000'),
(18, 1, 'Mengedit kendaraan: D 0000 XGN', '2026-09-24 18:44:55.000000'),
(19, 2, 'Mencatat kendaraan masuk: ID kendaraan 2022', '2026-09-24 19:07:11.000000'),
(20, 2, 'Mencatat kendaraan masuk: ID kendaraan 2020', '2026-09-24 19:11:55.000000'),
(21, 2, 'Mencatat kendaraan masuk: ID kendaraan 2021', '2026-09-24 19:12:04.000000'),
(22, 2, 'Mencatat kendaraan keluar', '2026-09-24 19:23:00.000000'),
(23, 2, 'Mencatat kendaraan keluar', '2026-09-24 19:23:35.000000'),
(24, 2, 'Mencatat kendaraan masuk: ID kendaraan 2018', '2026-09-24 19:50:13.000000'),
(25, 2, 'Mencatat kendaraan masuk: ID kendaraan 2010', '2026-09-24 19:50:31.000000'),
(26, 2, 'Mencatat kendaraan keluar', '2026-09-24 19:50:54.000000'),
(27, 2, 'Mencatat kendaraan keluar', '2026-09-24 19:51:27.000000'),
(28, 2, 'Mencatat kendaraan masuk: ID kendaraan 2016', '2026-09-24 19:51:41.000000'),
(29, 2, 'Mencatat kendaraan keluar', '2026-09-24 20:00:09.000000'),
(30, 2, 'Mencatat kendaraan keluar', '2026-09-24 20:07:47.000000'),
(31, 2, 'Mencatat kendaraan masuk: ID kendaraan 2022', '2026-09-24 20:27:52.000000'),
(32, 2, 'Mencatat kendaraan masuk: ID kendaraan 2019', '2026-09-24 20:28:18.000000'),
(33, 2, 'Mencatat kendaraan masuk: ID kendaraan 2010', '2026-09-24 20:29:00.000000'),
(34, 2, 'Mencatat kendaraan keluar', '2026-09-24 20:29:28.000000'),
(35, 1, 'Mengedit area parkir: gedung b', '2026-09-24 20:37:47.000000'),
(36, 1, 'Menambahkan area parkir: area a', '2026-09-24 20:40:02.000000'),
(37, 1, 'Mengedit tarif parkir jenis: Motor', '2026-09-25 06:57:45.000000'),
(38, 2, 'Mencatat kendaraan keluar', '2026-09-25 06:58:19.000000'),
(39, 2, 'Mencatat kendaraan masuk: ID kendaraan 2022', '2026-09-25 07:23:19.000000'),
(40, 2, 'Mencatat kendaraan keluar', '2026-09-27 11:33:35.000000'),
(41, 2, 'Mencatat kendaraan masuk: ID kendaraan 2021', '2026-09-28 11:36:07.000000'),
(42, 1, 'Mengedit area parkir: area b', '2026-09-28 20:04:03.000000'),
(43, 1, 'Mengedit area parkir: area b', '2026-09-28 20:07:40.000000'),
(44, 1, 'Menambahkan kendaraan: Z 2454 SD', '2026-09-28 20:10:29.000000'),
(45, 2, 'Mencatat kendaraan masuk: ID kendaraan 2023', '2026-09-28 20:17:25.000000'),
(46, 1, 'Menghapus user: nadira', '2026-09-28 20:30:56.000000'),
(47, 1, 'Menambahkan kendaraan: R 2314 DF', '2026-09-29 12:52:42.000000'),
(48, 2, 'Mencatat kendaraan masuk: ID kendaraan 2024', '2026-09-29 18:12:08.000000'),
(49, 2, 'Mencatat kendaraan keluar', '2026-09-29 18:12:51.000000'),
(50, 2, 'Mencatat kendaraan keluar', '2026-09-29 18:14:54.000000'),
(51, 2, 'Kendaraan keluar - ID: 18 - Jenis: motor - Durasi: 23 jam - Biaya: Rp 115.000', '2026-09-29 18:19:53.000000'),
(52, 2, 'Mencatat kendaraan masuk: ID kendaraan 2020', '2026-09-29 18:27:46.000000'),
(53, 2, 'Kendaraan keluar - ID: 20 - Jenis: motor - Durasi: 1 jam - Biaya: Rp 5.000', '2026-09-29 18:28:11.000000'),
(54, 1, 'Menghapus area parkir ID: 1', '2026-09-29 18:39:17.000000'),
(55, 1, 'Menghapus area parkir ID: 7', '2026-09-30 09:56:07.000000'),
(56, 1, 'Mengedit area parkir: area motor', '2026-09-30 09:56:16.000000'),
(57, 1, 'Menambahkan tarif parkir jenis: Mobil', '2026-09-30 11:26:56.000000'),
(58, 2, 'Mencatat kendaraan masuk: ID kendaraan 2010', '2026-09-30 11:27:40.000000'),
(59, 2, 'Kendaraan keluar - ID: 21 - Jenis: mobil - Durasi: 1 jam - Biaya: Rp 10.000', '2026-09-30 11:27:54.000000'),
(60, 1, 'Menambahkan kendaraan: DK 1234 RT', '2026-09-30 22:06:26.000000'),
(61, 1, 'Menambahkan kendaraan: D 3215 UA', '2026-09-30 22:11:24.000000'),
(62, 2, 'Mencatat kendaraan masuk: ID kendaraan 2026', '2026-09-30 22:11:53.000000'),
(63, 2, 'Kendaraan keluar - ID: 22 - Jenis: mobil - Durasi: 1 jam - Biaya: Rp 10.000', '2026-09-30 22:12:06.000000'),
(64, 2, 'Mencatat kendaraan masuk: ID kendaraan 2025', '2026-09-30 22:13:56.000000'),
(65, 1, 'Menghapus user: alpii', '2026-10-20 11:13:12.000000'),
(66, 1, 'Menghapus user: aripkii', '2026-10-20 20:26:55.000000'),
(67, 1, 'Menambahkan user baru: oyy', '2026-10-20 20:27:13.000000'),
(68, 1, 'Mengedit kendaraan: R 2467 RX', '2026-10-20 20:28:36.000000'),
(69, 1, 'Menghapus kendaraan: D 2378 XGN', '2026-10-20 20:52:01.000000'),
(70, 1, 'Menghapus kendaraan: D 1235 SAX', '2026-10-20 20:52:11.000000'),
(71, 1, 'Menghapus kendaraan: D 3214 SK', '2026-10-20 20:52:19.000000'),
(72, 2, 'Kendaraan keluar - ID: 17 - Jenis: motor - Durasi: 538 jam - Biaya: Rp 2.690.000', '2026-10-20 20:53:20.000000'),
(73, 1, 'Mengedit area parkir: area motor', '2026-10-20 20:54:28.000000'),
(74, 1, 'Menambahkan kendaraan: Z 2345 RE', '2026-10-20 20:55:24.000000'),
(75, 1, 'Menghapus kendaraan: Z 2345 RE', '2026-10-20 20:55:34.000000'),
(76, 1, 'Menghapus kendaraan: R 2314 DF', '2026-10-20 20:57:59.000000'),
(77, 1, 'Menghapus kendaraan: D 3215 UA', '2026-10-20 21:12:45.000000'),
(78, 1, 'Menghapus kendaraan: DK 1234 RT', '2026-10-20 21:12:51.000000'),
(79, 1, 'Mengedit user: oy', '2026-10-20 22:24:03.000000'),
(80, 1, 'Mengedit user: oy', '2026-10-21 15:01:07.000000'),
(81, 1, 'Menghapus user: oy', '2026-10-21 15:01:13.000000'),
(82, 1, 'Menambahkan user baru: oy', '2026-10-21 15:01:30.000000'),
(83, 1, 'Menghapus area parkir ID: 2', '2026-10-21 15:02:31.000000'),
(84, 1, 'Mengedit area parkir: area motor', '2026-10-21 15:02:48.000000'),
(85, 1, 'Menambahkan area parkir: area mobil', '2026-10-21 15:03:21.000000'),
(86, 2, 'Mencatat kendaraan masuk: ID kendaraan 2023', '2026-10-21 15:05:06.000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int(11) NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','lainnya') NOT NULL,
  `tarif_per_jam` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`) VALUES
(2, 'motor', '5000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int(11) NOT NULL,
  `id_kendaraan` int(20) NOT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `id_tarif` int(30) NOT NULL,
  `durasi_jam` int(25) NOT NULL DEFAULT 0,
  `biaya_total` decimal(10,0) NOT NULL DEFAULT 0,
  `status` enum('masuk','keluar',',') NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `id_kendaraan`, `waktu_masuk`, `waktu_keluar`, `id_tarif`, `durasi_jam`, `biaya_total`, `status`, `id_user`, `id_area`) VALUES
(17, 2021, '2026-09-28 11:35:00', '2026-10-20 20:53:20', 2, 538, '2690000', 'keluar', 2, 4),
(18, 2023, '2026-09-28 20:17:00', '2026-09-29 18:19:53', 2, 23, '115000', 'keluar', 2, 4),
(24, 2023, '2026-10-21 15:05:00', NULL, 2, 0, '0', 'masuk', 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','petugas','owner') NOT NULL,
  `status_aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `status_aktif`) VALUES
(1, 'Administrator', 'reyhan', 'admin123', 'admin', 1),
(2, 'Petugas Parkir 1', 'veliu', 'petugas123', 'petugas', 1),
(12, 'oy', 'oyy', '123', 'owner', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  ADD PRIMARY KEY (`id_area`);

--
-- Indeks untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indeks untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `idx_id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `idx_id_tarif` (`id_tarif`),
  ADD KEY `idx_id_user_transaksi` (`id_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2028;

--
-- AUTO_INCREMENT untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `tb_log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`),
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_tarif`) REFERENCES `tb_tarif` (`id_tarif`),
  ADD CONSTRAINT `tb_transaksi_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
