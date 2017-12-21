-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Des 2017 pada 17.11
-- Versi Server: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `presdispora`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE IF NOT EXISTS `gaji` (
`ID_GAJI` int(11) NOT NULL,
  `NOMINAL` int(11) DEFAULT NULL,
  `id_jabatan` varchar(12) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`ID_GAJI`, `NOMINAL`, `id_jabatan`) VALUES
(1, 2500000, 'J1'),
(4, 2700000, 'J2'),
(5, 3200000, 'J3'),
(6, 1800000, 'J4'),
(7, 2500000, 'J5'),
(8, 2000000, 'J10'),
(18, 2200000, 'J7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `izin`
--

CREATE TABLE IF NOT EXISTS `izin` (
`ID_IZIN` int(11) NOT NULL,
  `ID_KAR` varchar(12) NOT NULL,
  `TGL_IZIN` date DEFAULT NULL,
  `KET_IZIN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `izin`
--

INSERT INTO `izin` (`ID_IZIN`, `ID_KAR`, `TGL_IZIN`, `KET_IZIN`) VALUES
(4, 'KR1', '2017-12-15', 'Rapat dengan Wali Kota Surabaya Ibu Risma');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `ID_JABATAN` varchar(12) NOT NULL,
  `NAMA_JABATAN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`ID_JABATAN`, `NAMA_JABATAN`) VALUES
('J1', 'Administrator Aplikasi'),
('J10', 'IT Support'),
('J11', 'Administrasi Negara'),
('J2', 'Administrasi Umum'),
('J3', 'Mengagenda Surat Keluar Masuk'),
('J4', 'Staff IT Support'),
('J5', 'Sasaka (Pengirim Surat)'),
('J6', 'Pengurus Barang Persediaan'),
('J7', 'Resepsional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `ID_KAR` varchar(12) NOT NULL,
  `ID_JABATAN` varchar(12) NOT NULL,
  `NAMA_KAR` varchar(100) DEFAULT NULL,
  `ALAMAT_KAR` varchar(150) DEFAULT NULL,
  `NO_TELP_KAR` char(12) DEFAULT NULL,
  `STS_KAR` char(1) DEFAULT NULL,
  `KODE_KAR` varchar(6) DEFAULT NULL,
  `TGL_LHR_KAR` date DEFAULT NULL,
  `AGAMA_KAR` varchar(50) DEFAULT NULL,
  `JKEL_KAR` char(1) DEFAULT NULL,
  `TL_KAR` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`ID_KAR`, `ID_JABATAN`, `NAMA_KAR`, `ALAMAT_KAR`, `NO_TELP_KAR`, `STS_KAR`, `KODE_KAR`, `TGL_LHR_KAR`, `AGAMA_KAR`, `JKEL_KAR`, `TL_KAR`) VALUES
('KR1', 'J10', 'Aditya Pratama', 'Geluran', '085645998969', '1', '4D1T12', '1995-06-24', 'ISLAM', 'l', 'SURABAYA'),
('KR2', 'J7', 'Putri Aisyah', 'Puri Sedati indah J-25 Sidoarjo', '0856464646', '1', 'ZJH3TR', '1994-04-06', 'Islam', 'p', 'Surabaya'),
('KR3', 'J2', 'Sinta Dewi P', 'Sawo Tratap 3 Sidoarjo', '08989898998', '0', '9D4PSM', '1990-07-13', 'Hindu', 'p', 'Sidoarjo'),
('KR4', 'J5', 'Fulan Bin Fulan', 'Jalan Raya Kedurus No. 5', '085656565656', '1', 'E8RF49', '2017-05-21', 'Islam', 'l', 'Sidoarjo'),
('KR5', 'J10', 'Adi Retno Sugianto', 'dispora jawa timur', '08385547907', '1', '4DM1N', '2017-10-04', 'Islam', 'l', 'Surabaya'),
('KR6', 'J5', 'Cahyo Putro', 'Jl. Pabean Timur No 24 Sidoarjo', '08696969', '1', 'PVR7VT', '1983-12-02', 'Islam', 'l', 'Sidoarjo'),
('KR7', 'J3', 'Abdi Negara', 'Jl Cendrawasi No 7 Sidosermo', '08569657746', '1', 'ZYE96M', '1978-07-28', 'Kristen', 'l', 'Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajian`
--

CREATE TABLE IF NOT EXISTS `penggajian` (
`NO_SLIP` int(20) NOT NULL,
  `ID_KAR` varchar(12) NOT NULL,
  `TGL_PENGGAJIAN` date DEFAULT NULL,
  `periode` varchar(6) DEFAULT NULL,
  `TOTAL_GAJI` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `penggajian`
--

INSERT INTO `penggajian` (`NO_SLIP`, `ID_KAR`, `TGL_PENGGAJIAN`, `periode`, `TOTAL_GAJI`) VALUES
(1, 'KR1', '2017-12-03', '122017', 2700000),
(2, 'KR2', '2017-12-03', '122017', 2200000),
(3, 'KR3', '2017-12-03', '122017', 2700000),
(4, 'KR4', '2017-12-03', '122017', 2200000),
(5, 'KR5', '2017-12-03', '122017', 3200000),
(6, 'KR1', '2018-01-04', '012018', 2000000),
(7, 'KR1', '2018-02-02', '022018', 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE IF NOT EXISTS `presensi` (
`ID_PRES` int(12) NOT NULL,
  `JAM_MASUK` datetime DEFAULT NULL,
  `JAM_PULANG` datetime DEFAULT NULL,
  `ID_KAR` varchar(12) NOT NULL,
  `TGL_PRES` date DEFAULT NULL,
  `STS_PRES` char(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`ID_PRES`, `JAM_MASUK`, `JAM_PULANG`, `ID_KAR`, `TGL_PRES`, `STS_PRES`) VALUES
(1, '2017-05-01 07:28:31', '2017-05-01 16:28:39', 'KR1', '2017-05-01', '1'),
(2, '2017-05-10 07:28:31', '2017-05-10 16:28:39', 'KR1', '2017-05-10', '1'),
(3, '2017-05-11 07:28:31', '2017-05-11 16:28:39', 'KR1', '2017-05-11', '1'),
(4, '2017-05-12 07:28:31', '2017-05-12 16:28:39', 'KR1', '2017-05-12', '1'),
(5, '2017-05-13 07:28:31', '2017-05-13 16:28:39', 'KR1', '2017-05-13', '1'),
(6, '2017-05-15 07:28:31', '2017-05-15 16:28:39', 'KR1', '2017-05-15', '1'),
(7, '2017-05-16 07:28:31', '2017-05-16 16:28:39', 'KR1', '2017-05-16', '1'),
(8, '2017-05-17 07:28:31', '2017-05-17 16:28:39', 'KR1', '2017-05-17', '1'),
(9, '2017-05-18 07:28:31', '2017-05-18 16:28:39', 'KR1', '2017-05-18', '1'),
(10, '2017-05-19 07:28:31', '2017-05-19 16:28:39', 'KR1', '2017-05-19', '1'),
(11, '2017-05-02 07:28:31', '2017-05-02 16:28:39', 'KR1', '2017-05-02', '1'),
(12, '2017-05-20 07:28:31', '2017-05-20 16:28:39', 'KR1', '2017-05-20', '1'),
(13, '2017-05-22 07:28:31', '2017-05-22 16:28:39', 'KR1', '2017-05-22', '0'),
(14, '2017-05-23 07:28:31', '2017-05-23 16:28:39', 'KR1', '2017-05-23', '0'),
(15, '2017-05-24 07:28:31', '2017-05-24 16:28:39', 'KR1', '2017-05-24', '1'),
(16, '2017-05-25 07:28:31', '2017-05-25 16:28:39', 'KR1', '2017-05-25', '1'),
(17, '2017-05-26 07:28:31', '2017-05-26 16:28:39', 'KR1', '2017-05-26', '1'),
(18, '2017-05-27 07:28:31', '2017-05-27 16:28:39', 'KR1', '2017-05-27', '1'),
(19, '2017-05-29 07:28:31', '2017-05-29 16:28:39', 'KR1', '2017-05-29', '1'),
(20, '2017-05-03 07:28:31', '2017-05-03 16:28:39', 'KR1', '2017-05-03', '1'),
(21, '2017-05-30 07:28:31', '2017-05-30 16:28:39', 'KR1', '2017-05-30', '1'),
(22, '2017-05-31 07:28:31', '2017-05-31 16:28:39', 'KR1', '2017-05-31', '1'),
(23, '2017-05-01 07:28:31', '2017-05-01 16:28:39', 'KR2', '2017-05-01', '1'),
(24, '2017-05-02 07:28:31', '2017-05-02 16:28:39', 'KR2', '2017-05-02', '1'),
(25, '2017-05-03 07:28:31', '2017-05-03 16:28:39', 'KR2', '2017-05-03', '1'),
(26, '2017-05-04 07:28:31', '2017-05-04 16:28:39', 'KR2', '2017-05-04', '1'),
(27, '2017-05-05 07:28:31', '2017-05-05 16:28:39', 'KR2', '2017-05-05', '1'),
(28, '2017-05-06 07:28:31', '2017-05-06 16:28:39', 'KR2', '2017-05-06', '1'),
(29, '2017-05-08 07:28:31', '2017-05-08 16:28:39', 'KR2', '2017-05-08', '1'),
(30, '2017-05-04 07:28:31', '2017-05-04 16:28:39', 'KR1', '2017-05-04', '1'),
(31, '2017-05-09 07:28:31', '2017-05-09 16:28:39', 'KR2', '2017-05-09', '1'),
(32, '2017-05-10 07:28:31', '2017-05-10 16:28:39', 'KR2', '2017-05-10', '1'),
(33, '2017-05-11 07:28:31', '2017-05-11 16:28:39', 'KR2', '2017-05-11', '1'),
(34, '2017-05-12 07:28:31', '2017-05-12 16:28:39', 'KR2', '2017-05-12', '1'),
(35, '2017-05-13 07:28:31', '2017-05-13 16:28:39', 'KR2', '2017-05-13', '1'),
(36, '2017-05-15 07:28:31', '2017-05-15 16:28:39', 'KR2', '2017-05-15', '0'),
(37, '2017-05-16 07:28:31', '2017-05-16 16:28:39', 'KR2', '2017-05-16', '1'),
(38, '2017-05-17 07:28:31', '2017-05-17 16:28:39', 'KR2', '2017-05-17', '1'),
(39, '2017-05-18 07:28:31', '2017-05-18 16:28:39', 'KR2', '2017-05-18', '1'),
(40, '2017-05-05 07:28:31', '2017-05-05 16:28:39', 'KR1', '2017-05-05', '1'),
(41, '2017-05-19 07:28:31', '2017-05-19 16:28:39', 'KR2', '2017-05-19', '1'),
(42, '2017-05-20 07:28:31', '2017-05-20 16:28:39', 'KR2', '2017-05-20', '1'),
(43, '2017-05-23 07:28:31', '2017-05-23 16:28:39', 'KR2', '2017-05-23', '1'),
(44, '2017-05-24 07:28:31', '2017-05-24 16:28:39', 'KR2', '2017-05-24', '1'),
(45, '2017-05-25 07:28:31', '2017-05-25 16:28:39', 'KR2', '2017-05-25', '0'),
(46, '2017-05-26 07:28:31', '2017-05-26 16:28:39', 'KR2', '2017-05-26', '1'),
(47, '2017-05-27 07:28:31', '2017-05-27 16:28:39', 'KR2', '2017-05-27', '1'),
(48, '2017-05-06 07:28:31', '2017-05-06 16:28:39', 'KR1', '2017-05-06', '1'),
(49, '2017-05-29 07:28:31', '2017-05-29 16:28:39', 'KR2', '2017-05-29', '1'),
(50, '2017-05-30 07:28:31', '2017-05-30 16:28:39', 'KR2', '2017-05-30', '1'),
(51, '2017-05-31 07:28:31', '2017-05-31 16:28:39', 'KR2', '2017-05-31', '0'),
(52, '2017-05-08 07:28:31', '2017-05-08 16:28:39', 'KR1', '2017-05-08', '1'),
(53, '2017-05-09 07:28:31', '2017-05-09 16:28:39', 'KR1', '2017-05-09', '1'),
(54, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'KR2', '2017-05-22', '2'),
(62, NULL, NULL, 'KR1', '2017-12-15', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
 ADD PRIMARY KEY (`ID_GAJI`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
 ADD PRIMARY KEY (`ID_IZIN`), ADD KEY `MELAKUKAN1_FK` (`ID_KAR`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
 ADD PRIMARY KEY (`ID_JABATAN`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
 ADD PRIMARY KEY (`ID_KAR`), ADD KEY `MEMPUNYAI_FK` (`ID_JABATAN`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
 ADD PRIMARY KEY (`NO_SLIP`), ADD KEY `FK_PENGGAJI_RELATION__KARYAWAN` (`ID_KAR`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
 ADD PRIMARY KEY (`ID_PRES`), ADD KEY `MELAKUKAN_FK` (`ID_KAR`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
MODIFY `ID_GAJI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
MODIFY `ID_IZIN` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `penggajian`
--
ALTER TABLE `penggajian`
MODIFY `NO_SLIP` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
MODIFY `ID_PRES` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
ADD CONSTRAINT `FK_PENGGAJI_RELATION__KARYAWAN` FOREIGN KEY (`ID_KAR`) REFERENCES `karyawan` (`ID_KAR`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
