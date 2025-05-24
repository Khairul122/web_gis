-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2025 at 08:33 AM
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
-- Database: `db_gis`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_analisis`
--

CREATE TABLE `detail_analisis` (
  `id_detail` int NOT NULL,
  `id_hasil` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `nilai_asli` float NOT NULL,
  `skor` int NOT NULL,
  `nilai_utilitas` float NOT NULL,
  `nilai_terbobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `detail_analisis`
--

INSERT INTO `detail_analisis` (`id_detail`, `id_hasil`, `id_kriteria`, `nilai_asli`, `skor`, `nilai_utilitas`, `nilai_terbobot`) VALUES
(139, 27, 1, 5, 5, 1, 0.41),
(140, 27, 2, 3, 3, 0.5, 0.125),
(141, 27, 3, 4, 4, 0.6667, 0.1067),
(142, 27, 4, 5, 5, 1, 0.11),
(143, 27, 5, 5, 5, 1, 0.07),
(144, 27, 6, 5, 5, 1, 0.03),
(145, 28, 1, 5, 5, 1, 0.41),
(146, 28, 2, 3, 3, 0.5, 0.125),
(147, 28, 3, 4, 4, 0.6667, 0.1067),
(148, 28, 4, 5, 5, 1, 0.11),
(149, 28, 5, 5, 5, 1, 0.07),
(150, 28, 6, 5, 5, 1, 0.03),
(151, 29, 1, 4, 4, 0.75, 0.3075),
(152, 29, 2, 4, 4, 0.75, 0.1875),
(153, 29, 3, 5, 5, 1, 0.16),
(154, 29, 4, 4, 4, 0.6667, 0.0733),
(155, 29, 5, 5, 5, 1, 0.07),
(156, 29, 6, 3, 3, 0.5, 0.015),
(157, 30, 1, 4, 4, 0.75, 0.3075),
(158, 30, 2, 4, 4, 0.75, 0.1875),
(159, 30, 3, 5, 5, 1, 0.16),
(160, 30, 4, 4, 4, 0.6667, 0.0733),
(161, 30, 5, 5, 5, 1, 0.07),
(162, 30, 6, 3, 3, 0.5, 0.015),
(163, 31, 1, 5, 5, 1, 0.41),
(164, 31, 2, 2, 2, 0.25, 0.0625),
(165, 31, 3, 4, 4, 0.6667, 0.1067),
(166, 31, 4, 5, 5, 1, 0.11),
(167, 31, 5, 5, 5, 1, 0.07),
(168, 31, 6, 5, 5, 1, 0.03),
(169, 32, 1, 5, 5, 1, 0.41),
(170, 32, 2, 3, 3, 0.5, 0.125),
(171, 32, 3, 4, 4, 0.6667, 0.1067),
(172, 32, 4, 5, 5, 1, 0.11),
(173, 32, 5, 4, 4, 0, 0),
(174, 32, 6, 5, 5, 1, 0.03),
(175, 33, 1, 4, 4, 0.75, 0.3075),
(176, 33, 2, 4, 4, 0.75, 0.1875),
(177, 33, 3, 4, 4, 0.6667, 0.1067),
(178, 33, 4, 4, 4, 0.6667, 0.0733),
(179, 33, 5, 5, 5, 1, 0.07),
(180, 33, 6, 3, 3, 0.5, 0.015),
(181, 34, 1, 4, 4, 0.75, 0.3075),
(182, 34, 2, 3, 3, 0.5, 0.125),
(183, 34, 3, 4, 4, 0.6667, 0.1067),
(184, 34, 4, 5, 5, 1, 0.11),
(185, 34, 5, 5, 5, 1, 0.07),
(186, 34, 6, 5, 5, 1, 0.03),
(187, 35, 1, 4, 4, 0.75, 0.3075),
(188, 35, 2, 3, 3, 0.5, 0.125),
(189, 35, 3, 4, 4, 0.6667, 0.1067),
(190, 35, 4, 5, 5, 1, 0.11),
(191, 35, 5, 5, 5, 1, 0.07),
(192, 35, 6, 4, 4, 0.75, 0.0225),
(193, 36, 1, 3, 3, 0.5, 0.205),
(194, 36, 2, 5, 5, 1, 0.25),
(195, 36, 3, 5, 5, 1, 0.16),
(196, 36, 4, 3, 3, 0.3333, 0.0367),
(197, 36, 5, 5, 5, 1, 0.07),
(198, 36, 6, 1, 1, 0, 0),
(199, 37, 1, 3, 3, 0.5, 0.205),
(200, 37, 2, 4, 4, 0.75, 0.1875),
(201, 37, 3, 5, 5, 1, 0.16),
(202, 37, 4, 4, 4, 0.6667, 0.0733),
(203, 37, 5, 5, 5, 1, 0.07),
(204, 37, 6, 3, 3, 0.5, 0.015),
(205, 38, 1, 4, 4, 0.75, 0.3075),
(206, 38, 2, 3, 3, 0.5, 0.125),
(207, 38, 3, 4, 4, 0.6667, 0.1067),
(208, 38, 4, 4, 4, 0.6667, 0.0733),
(209, 38, 5, 5, 5, 1, 0.07),
(210, 38, 6, 3, 3, 0.5, 0.015),
(211, 39, 1, 4, 4, 0.75, 0.3075),
(212, 39, 2, 3, 3, 0.5, 0.125),
(213, 39, 3, 4, 4, 0.6667, 0.1067),
(214, 39, 4, 4, 4, 0.6667, 0.0733),
(215, 39, 5, 5, 5, 1, 0.07),
(216, 39, 6, 3, 3, 0.5, 0.015),
(217, 40, 1, 4, 4, 0.75, 0.3075),
(218, 40, 2, 3, 3, 0.5, 0.125),
(219, 40, 3, 4, 4, 0.6667, 0.1067),
(220, 40, 4, 4, 4, 0.6667, 0.0733),
(221, 40, 5, 5, 5, 1, 0.07),
(222, 40, 6, 3, 3, 0.5, 0.015),
(223, 41, 1, 2, 2, 0.25, 0.1025),
(224, 41, 2, 5, 5, 1, 0.25),
(225, 41, 3, 5, 5, 1, 0.16),
(226, 41, 4, 3, 3, 0.3333, 0.0367),
(227, 41, 5, 5, 5, 1, 0.07),
(228, 41, 6, 2, 2, 0.25, 0.0075),
(229, 42, 1, 3, 3, 0.5, 0.205),
(230, 42, 2, 4, 4, 0.75, 0.1875),
(231, 42, 3, 5, 5, 1, 0.16),
(232, 42, 4, 3, 3, 0.3333, 0.0367),
(233, 42, 5, 4, 4, 0, 0),
(234, 42, 6, 4, 4, 0.75, 0.0225),
(235, 43, 1, 2, 2, 0.25, 0.1025),
(236, 43, 2, 5, 5, 1, 0.25),
(237, 43, 3, 5, 5, 1, 0.16),
(238, 43, 4, 2, 2, 0, 0),
(239, 43, 5, 5, 5, 1, 0.07),
(240, 43, 6, 1, 1, 0, 0),
(241, 44, 1, 2, 2, 0.25, 0.1025),
(242, 44, 2, 5, 5, 1, 0.25),
(243, 44, 3, 5, 5, 1, 0.16),
(244, 44, 4, 2, 2, 0, 0),
(245, 44, 5, 5, 5, 1, 0.07),
(246, 44, 6, 1, 1, 0, 0),
(247, 45, 1, 2, 2, 0.25, 0.1025),
(248, 45, 2, 3, 3, 0.5, 0.125),
(249, 45, 3, 4, 4, 0.6667, 0.1067),
(250, 45, 4, 5, 5, 1, 0.11),
(251, 45, 5, 5, 5, 1, 0.07),
(252, 45, 6, 3, 3, 0.5, 0.015),
(253, 46, 1, 1, 1, 0, 0),
(254, 46, 2, 2, 2, 0.25, 0.0625),
(255, 46, 3, 2, 2, 0, 0),
(256, 46, 4, 5, 5, 1, 0.11),
(257, 46, 5, 4, 4, 0, 0),
(258, 46, 6, 5, 5, 1, 0.03),
(259, 47, 1, 1, 1, 0, 0),
(260, 47, 2, 2, 2, 0.25, 0.0625),
(261, 47, 3, 2, 2, 0, 0),
(262, 47, 4, 5, 5, 1, 0.11),
(263, 47, 5, 4, 4, 0, 0),
(264, 47, 6, 5, 5, 1, 0.03),
(265, 48, 1, 1, 1, 0, 0),
(266, 48, 2, 2, 2, 0.25, 0.0625),
(267, 48, 3, 2, 2, 0, 0),
(268, 48, 4, 5, 5, 1, 0.11),
(269, 48, 5, 4, 4, 0, 0),
(270, 48, 6, 5, 5, 1, 0.03),
(271, 49, 1, 1, 1, 0, 0),
(272, 49, 2, 1, 1, 0, 0),
(273, 49, 3, 2, 2, 0, 0),
(274, 49, 4, 5, 5, 1, 0.11),
(275, 49, 5, 4, 4, 0, 0),
(276, 49, 6, 4, 4, 0.75, 0.0225);

-- --------------------------------------------------------

--
-- Table structure for table `geojson_kecamatan`
--

CREATE TABLE `geojson_kecamatan` (
  `id_geojson` int NOT NULL,
  `id_kecamatan` int NOT NULL,
  `data_geojson` mediumtext COLLATE utf8mb3_swedish_ci NOT NULL COMMENT 'Data GeoJSON untuk peta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `geojson_kecamatan`
--

INSERT INTO `geojson_kecamatan` (`id_geojson`, `id_kecamatan`, `data_geojson`) VALUES
(4, 4, 'penyabungan.geojson'),
(5, 5, 'kotanopan.geojson'),
(6, 6, 'batang_natal.geojson'),
(7, 7, 'muara_sipongi.geojson'),
(8, 8, 'natal.geojson'),
(9, 9, 'siabu.geojson'),
(10, 10, 'batahan.geojson'),
(11, 11, 'lingga_bayu.geojson'),
(12, 12, 'muara_batang_gadis.geojson'),
(13, 13, 'bukit_malintang.geojson'),
(14, 14, 'penyabungan_utara.geojson'),
(15, 15, 'penyabungan_selatan.geojson'),
(16, 16, 'penyabungan_timur.geojson'),
(17, 17, 'penyabungan_barat.geojson'),
(18, 18, 'lembah_sorik_merapi.geojson'),
(19, 19, 'tambangan.geojson'),
(20, 20, 'ulu_pungkut.geojson'),
(21, 21, 'pakantan.geojson'),
(22, 22, 'ranto_baek.geojson'),
(23, 23, 'huta_bargot.geojson'),
(24, 24, 'puncak_sorik_marapi.geojson'),
(25, 25, 'sinunukan.geojson'),
(26, 26, 'naga_juang.geojson');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_analisis`
--

CREATE TABLE `hasil_analisis` (
  `id_hasil` int NOT NULL,
  `id_kecamatan` int NOT NULL,
  `total_skor` float NOT NULL,
  `id_kelas` int NOT NULL,
  `tanggal_analisis` date NOT NULL,
  `keterangan` text COLLATE utf8mb3_swedish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `hasil_analisis`
--

INSERT INTO `hasil_analisis` (`id_hasil`, `id_kecamatan`, `total_skor`, `id_kelas`, `tanggal_analisis`, `keterangan`) VALUES
(27, 14, 0.8517, 1, '2025-05-24', 'Analisis MAUT - Sangat Sesuai'),
(28, 15, 0.8517, 1, '2025-05-24', 'Analisis MAUT - Sangat Sesuai'),
(29, 5, 0.8133, 1, '2025-05-24', 'Analisis MAUT - Sangat Sesuai'),
(30, 19, 0.8133, 1, '2025-05-24', 'Analisis MAUT - Sangat Sesuai'),
(31, 16, 0.7892, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(32, 4, 0.7817, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(33, 22, 0.76, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(34, 9, 0.7492, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(35, 17, 0.7417, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(36, 24, 0.7217, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(37, 18, 0.7108, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(38, 13, 0.6975, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(39, 23, 0.6975, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(40, 26, 0.6975, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(41, 7, 0.6267, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(42, 6, 0.6117, 2, '2025-05-24', 'Analisis MAUT - Sesuai'),
(43, 20, 0.5825, 3, '2025-05-24', 'Analisis MAUT - Cukup Sesuai'),
(44, 21, 0.5825, 3, '2025-05-24', 'Analisis MAUT - Cukup Sesuai'),
(45, 11, 0.5292, 3, '2025-05-24', 'Analisis MAUT - Cukup Sesuai'),
(46, 8, 0.2025, 4, '2025-05-24', 'Analisis MAUT - Tidak Sesuai'),
(47, 10, 0.2025, 4, '2025-05-24', 'Analisis MAUT - Tidak Sesuai'),
(48, 25, 0.2025, 4, '2025-05-24', 'Analisis MAUT - Tidak Sesuai'),
(49, 12, 0.1325, 4, '2025-05-24', 'Analisis MAUT - Tidak Sesuai');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int NOT NULL,
  `nama_kecamatan` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `luas` float DEFAULT NULL COMMENT 'Luas area dalam km2',
  `keterangan` text COLLATE utf8mb3_swedish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`, `luas`, `keterangan`) VALUES
(4, 'Penyabungan', 229.54, '	Ibu kota kabupaten dengan 30 desa dan 9 kelurahan.'),
(5, 'Kotanopan', 325.15, '	Dikenal dengan tradisi Lubuk Larangan.'),
(6, 'Batang Natal', 651.51, 'Batang Natal bergunung, berhujan lebat, dialiri sungai-sungai besar.'),
(7, 'Muara Sipongi', 135.7, '	Terletak di perbatasan dengan Provinsi Sumatera Barat.'),
(8, 'Natal', 1435.05, 'Kecamatan pesisir dengan potensi perikanan'),
(9, 'Siabu', 345.36, 'Wilayah agraris dengan banyak desa'),
(10, 'Batahan', 497.07, 'Kecamatan dengan 18 desa'),
(11, 'Lingga Bayu', 192.67, 'Wilayah dengan 17 desa dan 2 kelurahan'),
(12, 'Muara Batang Gadis', 1435.05, 'Kecamatan terluas di Mandailing Natal'),
(13, 'Bukit Malintang', 68.7, 'Wilayah dengan 11 desa'),
(14, 'Panyabungan Utara', 63.73, 'Kecamatan dengan ketinggian 231-1540 mdpl'),
(15, 'Panyabungan Selatan', 87, 'Wilayah dengan 11 desa'),
(16, 'Panyabungan Timur', 39.79, 'Kecamatan dengan 14 desa'),
(17, 'Panyabungan Barat', 129.09, 'Wilayah dengan 9 desa dan 1 kelurahan'),
(18, 'Lembah Sorik Marapi', 34.73, 'Kecamatan dengan 9 desa'),
(19, 'Tambangan', 158.6, 'Wilayah dengan 20 desa'),
(20, 'Ulu Pungkut', 68.7, 'Kecamatan dengan 12 desa dan 1 kelurahan'),
(21, 'Pakantan', 93.6, 'Wilayah dengan 8 desa'),
(22, 'Ranto Baek', 152.72, 'Kecamatan dengan 16 desa'),
(23, 'Huta Bargot', 68.7, 'Wilayah dengan 11 desa'),
(24, 'Puncak Sorik Marapi', 68.7, 'Kecamatan dengan 11 desa'),
(25, 'Sinunukan', 68.7, 'Wilayah dengan 11 desa'),
(26, 'Naga Juang', 58.69, 'Kecamatan dengan 9 desa');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_kesesuaian`
--

CREATE TABLE `kelas_kesesuaian` (
  `id_kelas` int NOT NULL,
  `kode` varchar(5) COLLATE utf8mb3_swedish_ci NOT NULL,
  `nama_kelas` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `skor_min` int NOT NULL,
  `skor_max` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb3_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `kelas_kesesuaian`
--

INSERT INTO `kelas_kesesuaian` (`id_kelas`, `kode`, `nama_kelas`, `skor_min`, `skor_max`, `keterangan`) VALUES
(1, 'S1', 'Sangat Sesuai', 80, 100, 'Lahan sangat sesuai untuk budidaya tanaman'),
(2, 'S2', 'Sesuai', 60, 79, 'Lahan sesuai dengan pembatasan ringan'),
(3, 'S3', 'Cukup Sesuai', 40, 59, 'Lahan cukup sesuai dengan pembatasan sedang'),
(4, 'N', 'Tidak Sesuai', 0, 39, 'Lahan tidak sesuai untuk budidaya tanaman');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int NOT NULL,
  `nama_kriteria` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb3_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `keterangan`) VALUES
(1, 'C1', 0.41, 'Tekstur Tanah'),
(2, 'C2', 0.25, 'Curah Hujan'),
(3, 'C3', 0.16, 'Drainase Tanah'),
(4, 'C4', 0.11, 'Kemiringan Lahan'),
(5, 'C5', 0.07, 'Suhu'),
(6, 'C6', 0.03, 'Ph Tanah');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai` int NOT NULL,
  `id_kecamatan` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai`, `id_kecamatan`, `id_kriteria`, `nilai`) VALUES
(2, 10, 1, 1),
(3, 10, 2, 2),
(4, 10, 3, 2),
(5, 10, 4, 5),
(6, 10, 5, 4),
(7, 10, 6, 5),
(8, 6, 1, 3),
(9, 6, 2, 4),
(10, 6, 3, 5),
(11, 6, 4, 3),
(12, 6, 5, 4),
(13, 6, 6, 4),
(14, 4, 1, 5),
(15, 4, 2, 3),
(16, 4, 3, 4),
(17, 4, 4, 5),
(18, 4, 5, 4),
(19, 4, 6, 5),
(20, 5, 1, 4),
(21, 5, 2, 4),
(22, 5, 3, 5),
(23, 5, 4, 4),
(24, 5, 5, 5),
(25, 5, 6, 3),
(26, 7, 1, 2),
(27, 7, 2, 5),
(28, 7, 3, 5),
(29, 7, 4, 3),
(30, 7, 5, 5),
(31, 7, 6, 2),
(32, 8, 1, 1),
(33, 8, 2, 2),
(34, 8, 3, 2),
(35, 8, 4, 5),
(36, 8, 5, 4),
(37, 8, 6, 5),
(38, 9, 1, 4),
(39, 9, 2, 3),
(40, 9, 3, 4),
(41, 9, 4, 5),
(42, 9, 5, 5),
(43, 9, 6, 5),
(44, 11, 1, 2),
(45, 11, 2, 3),
(46, 11, 3, 4),
(47, 11, 4, 5),
(48, 11, 5, 5),
(49, 11, 6, 3),
(50, 12, 1, 1),
(51, 12, 2, 1),
(52, 12, 3, 2),
(53, 12, 4, 5),
(54, 12, 5, 4),
(55, 12, 6, 4),
(56, 13, 1, 4),
(57, 13, 2, 3),
(58, 13, 3, 4),
(59, 13, 4, 4),
(60, 13, 5, 5),
(61, 13, 6, 3),
(62, 14, 1, 5),
(63, 14, 2, 3),
(64, 14, 3, 4),
(65, 14, 4, 5),
(66, 14, 5, 5),
(67, 14, 6, 5),
(68, 15, 1, 5),
(69, 15, 2, 3),
(70, 15, 3, 4),
(71, 15, 4, 5),
(72, 15, 5, 5),
(73, 15, 6, 5),
(74, 16, 1, 5),
(75, 16, 2, 2),
(76, 16, 3, 4),
(77, 16, 4, 5),
(78, 16, 5, 5),
(79, 16, 6, 5),
(80, 17, 1, 4),
(81, 17, 2, 3),
(82, 17, 3, 4),
(83, 17, 4, 5),
(84, 17, 5, 5),
(85, 17, 6, 4),
(86, 18, 1, 3),
(87, 18, 2, 4),
(88, 18, 3, 5),
(89, 18, 4, 4),
(90, 18, 5, 5),
(91, 18, 6, 3),
(92, 19, 1, 4),
(93, 19, 2, 4),
(94, 19, 3, 5),
(95, 19, 4, 4),
(96, 19, 5, 5),
(97, 19, 6, 3),
(98, 20, 1, 2),
(99, 20, 2, 5),
(100, 20, 3, 5),
(101, 20, 4, 2),
(102, 20, 5, 5),
(103, 20, 6, 1),
(104, 21, 1, 2),
(105, 21, 2, 5),
(106, 21, 3, 5),
(107, 21, 4, 2),
(108, 21, 5, 5),
(109, 21, 6, 1),
(110, 22, 1, 4),
(111, 22, 2, 4),
(112, 22, 3, 4),
(113, 22, 4, 4),
(114, 22, 5, 5),
(115, 22, 6, 3),
(116, 23, 1, 4),
(117, 23, 2, 3),
(118, 23, 3, 4),
(119, 23, 4, 4),
(120, 23, 5, 5),
(121, 23, 6, 3),
(122, 24, 1, 3),
(123, 24, 2, 5),
(124, 24, 3, 5),
(125, 24, 4, 3),
(126, 24, 5, 5),
(127, 24, 6, 1),
(128, 25, 1, 1),
(129, 25, 2, 2),
(130, 25, 3, 2),
(131, 25, 4, 5),
(132, 25, 5, 4),
(133, 25, 6, 5),
(134, 26, 1, 4),
(135, 26, 2, 3),
(136, 26, 3, 4),
(137, 26, 4, 4),
(138, 26, 5, 5),
(139, 26, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `deskripsi` varchar(200) COLLATE utf8mb3_swedish_ci NOT NULL,
  `nilai` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `deskripsi`, `nilai`) VALUES
(5, 1, 'Berpasir', '1'),
(6, 1, 'Lempung Berliat', '2'),
(7, 1, 'Lempung Berdebu', '3'),
(8, 1, 'Lempung', '4'),
(9, 1, 'Lempung Berpasir', '5'),
(15, 3, 'Cepat', '2'),
(16, 3, 'Sedang', '4'),
(17, 3, 'Baik', '5'),
(18, 4, '< 8', '5'),
(19, 4, '8 – <15', '4'),
(20, 4, '15 – <30', '3'),
(21, 4, '30 – 45', '2'),
(22, 4, '> 45', '1'),
(23, 5, '< 20 atau > 34', '1'),
(24, 5, '20 – <22 atau 32 – ≤34', '2'),
(25, 5, '22 – 28', '5'),
(26, 5, '28 – <30', '4'),
(27, 5, '30 – <32', '3'),
(33, 2, '< 2000', '1'),
(34, 2, '2000 – <2200', '2'),
(35, 2, '2200 – <2400', '3'),
(36, 2, '2400 – <2600', '4'),
(37, 2, '≥ 2600', '5'),
(38, 6, '< 5.0', '1'),
(39, 6, '5.0 – <5.3', '2'),
(40, 6, '5.3 – <5.7', '3'),
(41, 6, '5.7 – <6.0', '4'),
(42, 6, '6.0 – 6.5', '5'),
(43, 6, '> 6.5', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb3_swedish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_swedish_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb3_swedish_ci NOT NULL,
  `level` enum('admin','user') COLLATE utf8mb3_swedish_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin'),
(2, 'user', '12345', 'User1', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_analisis`
--
ALTER TABLE `detail_analisis`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_hasil` (`id_hasil`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `geojson_kecamatan`
--
ALTER TABLE `geojson_kecamatan`
  ADD PRIMARY KEY (`id_geojson`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `hasil_analisis`
--
ALTER TABLE `hasil_analisis`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kelas_kesesuaian`
--
ALTER TABLE `kelas_kesesuaian`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_analisis`
--
ALTER TABLE `detail_analisis`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `geojson_kecamatan`
--
ALTER TABLE `geojson_kecamatan`
  MODIFY `id_geojson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `hasil_analisis`
--
ALTER TABLE `hasil_analisis`
  MODIFY `id_hasil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kelas_kesesuaian`
--
ALTER TABLE `kelas_kesesuaian`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_analisis`
--
ALTER TABLE `detail_analisis`
  ADD CONSTRAINT `detail_analisis_ibfk_1` FOREIGN KEY (`id_hasil`) REFERENCES `hasil_analisis` (`id_hasil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_analisis_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `geojson_kecamatan`
--
ALTER TABLE `geojson_kecamatan`
  ADD CONSTRAINT `geojson_kecamatan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_analisis`
--
ALTER TABLE `hasil_analisis`
  ADD CONSTRAINT `hasil_analisis_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_analisis_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas_kesesuaian` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD CONSTRAINT `nilai_kriteria_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
