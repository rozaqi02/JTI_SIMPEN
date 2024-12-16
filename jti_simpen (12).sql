-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2024 at 03:46 PM
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
-- Database: `jti_simpen`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '01 2024_11_20_123554_create_m_level_table', 1),
(2, '02 2024_12_07_114747_create_m_user_table', 1),
(3, '03 2024_11_20_130035_create_m_admin_table', 1),
(4, '04 2024_11_20_130038_create_m_dosen_table', 1),
(5, '05 2024_11_20_130044_create_m_tendik_table', 1),
(6, '06 2024_12_04_033332_create_t_bidkom_table', 1),
(7, '07 2024_12_10_071949_create_m_mahasiswa_table', 1),
(8, '08 2024_12_06_144313_create_t_periode_table', 1),
(9, '09 2024_12_06_151438_create_t_alpa_table', 1),
(10, '10 2024_12_10_071618_create_t_detail_bidkom_table', 1),
(11, '11 2024_12_06_142738_create_m_jenis_kompen_table', 1),
(12, '12 2024_12_06_115709_create_m_detail_tugas_table', 1),
(13, '13 2024_12_07_103232_create_m_tugas_table', 1),
(14, '14 2024_11_13_091607_create_t_qr_code_table', 1),
(15, '15 2024_12_07_103723_create_t_riwayat_tugas_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_admin`
--

CREATE TABLE `m_admin` (
  `id_admin` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_admin`
--

INSERT INTO `m_admin` (`id_admin`, `id_user`, `nip`, `email`, `nama_admin`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 1, '1987654321', 'ahmad.abror@example.com', 'Ahmad Abror', '081234567890', '2024-12-16 07:59:03', '2024-12-16 07:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `m_detail_tugas`
--

CREATE TABLE `m_detail_tugas` (
  `id_detail_tugas` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_jenis_kompen` bigint UNSIGNED NOT NULL,
  `nama_tugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_tugas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int NOT NULL,
  `nilai_kompen` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_detail_tugas`
--

INSERT INTO `m_detail_tugas` (`id_detail_tugas`, `id_user`, `id_jenis_kompen`, `nama_tugas`, `deskripsi_tugas`, `kuota`, `nilai_kompen`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 'Pengabdian Desa Maibit', 'Melakukan Pengabdian desa guna membangun masyarakat yang solutif', 10, 10, '2024-12-16 08:00:48', '2024-12-16 08:00:48'),
(4, 2, 3, 'Penelitian P.DIddy', 'Melakukan analisis dan penulisan laporan terkait proyek B dengan fokus pada efisiensi.', 15, 30, '2024-12-16 08:00:48', '2024-12-16 08:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `m_dosen`
--

CREATE TABLE `m_dosen` (
  `id_dosen` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_dosen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_dosen`
--

INSERT INTO `m_dosen` (`id_dosen`, `id_user`, `nip`, `email`, `nama_dosen`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 2, '1986543210', 'afifah.rahma@example.com', 'Afifah Rahma', '081234567891', '2024-12-16 07:59:10', '2024-12-16 07:59:10'),
(2, 5, NULL, NULL, 'dosen namaaaa', NULL, '2024-12-16 08:23:21', '2024-12-16 08:23:21'),
(3, 6, NULL, NULL, 'joyo sugito', NULL, '2024-12-16 08:29:49', '2024-12-16 08:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_kompen`
--

CREATE TABLE `m_jenis_kompen` (
  `id_jenis_kompen` bigint UNSIGNED NOT NULL,
  `nama_jenis_kompen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_jenis_kompen`
--

INSERT INTO `m_jenis_kompen` (`id_jenis_kompen`, `nama_jenis_kompen`, `created_at`, `updated_at`) VALUES
(1, 'Pengabdian', '2024-12-16 07:59:31', '2024-12-16 07:59:31'),
(2, 'Penelitian', '2024-12-16 07:59:31', '2024-12-16 07:59:31'),
(3, 'Teknis', '2024-12-16 07:59:31', '2024-12-16 07:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'ADMIN', NULL, NULL),
(2, 'DSN', 'DOSEN', NULL, NULL),
(3, 'TDK', 'TENDIK', NULL, NULL),
(4, 'MHS', 'MAHASISWA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_mahasiswa`
--

CREATE TABLE `m_mahasiswa` (
  `id_mahasiswa` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_studi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_masuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_mahasiswa`
--

INSERT INTO `m_mahasiswa` (`id_mahasiswa`, `id_user`, `nama_mahasiswa`, `nim`, `email`, `no_telepon`, `program_studi`, `tahun_masuk`, `created_at`, `updated_at`) VALUES
(1, 4, 'Amanda Jasmyne', '2241760123', 'amandajbp04@gmail.com', '081237621316', 'Sistem Informasi Bisnis', '2024', '2024-12-16 07:58:57', '2024-12-16 07:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `m_tendik`
--

CREATE TABLE `m_tendik` (
  `id_tendik` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_tendik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_tendik`
--

INSERT INTO `m_tendik` (`id_tendik`, `id_user`, `nip`, `email`, `nama_tendik`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 3, '1987456123', 'anas.nurhidayat@example.com', 'Anas Nurhidayat', '081234567892', '2024-12-16 07:59:14', '2024-12-16 07:59:14'),
(2, 7, '123123', NULL, 'Tendik Ahmad', NULL, '2024-12-16 08:42:00', '2024-12-16 08:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_tugas`
--

CREATE TABLE `m_tugas` (
  `id_tugas` bigint UNSIGNED NOT NULL,
  `id_detail_tugas` bigint UNSIGNED NOT NULL,
  `id_alpa` bigint UNSIGNED NOT NULL,
  `progress_tugas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_tugas`
--

INSERT INTO `m_tugas` (`id_tugas`, `id_detail_tugas`, `id_alpa`, `progress_tugas`, `created_at`, `updated_at`) VALUES
(12, 3, 1, 'Belum Mulai', '2024-12-16 08:02:59', '2024-12-16 08:02:59'),
(13, 4, 2, 'Dalam Progres', '2024-12-16 08:02:59', '2024-12-16 08:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id_user` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'image/profile/avatar.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id_user`, `level_id`, `username`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ahmad Abror', '$2y$12$/gGAdtVLlti.Fu6IfwAYC.iFZes1flFMCTcm6Og2DmqKmy3SsV.si', 'image/profile/avatar.png\r\n', '2024-12-16 07:58:47', '2024-12-16 07:58:47'),
(2, 2, 'Afifah Rahma', '$2y$12$kU/HK1sItQ/SCs.zJ/8dVeh/GcOZ2OaZ6nHIXWTR2YWzuR.5l/9Yq', 'image/profile/avatar.png', '2024-12-16 07:58:47', '2024-12-16 07:58:47'),
(3, 3, 'Anas Nur Hidayat', '$2y$12$A4vhUiLM92czypGRMLJLY.lIB/dH70RsTGlaK7r9D7b5UMA432wZu', 'image/profile/avatar.png', '2024-12-16 07:58:47', '2024-12-16 07:58:47'),
(4, 4, 'Amanda Jasmyne', '$2y$12$WDK8.kDaKd5lkK4GAbGrdOw8DkoUEpxC3/EWDpkYWcku.yLusyhg.', 'image/profile/avatar.png', '2024-12-16 07:58:47', '2024-12-16 07:58:47'),
(5, 2, 'Ahmad Dosen', '$2y$12$5xnFVEi9rm/0LGvlhDSO5eLjW8F0ybaGVVqo0OgpRneomeomosUWW', NULL, '2024-12-16 08:23:21', '2024-12-16 08:23:21'),
(6, 2, 'Joyo', '$2y$12$McufKOx.RNzgU3HbP1omF.OlZpN18BvDDp6cBZZp.6VUPzUlE7Vn.', 'image/profile/1734363005.png', '2024-12-16 08:29:49', '2024-12-16 08:30:05'),
(7, 3, 'Ahmad Tendik', '$2y$12$d7EAL10uKOcZ/lXvCVtTkeHjqnl6hdF8LxIi9nnSxLZ6.x80dNUVy', 'image/profile/avatar.png', '2024-12-16 08:42:00', '2024-12-16 08:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_alpa`
--

CREATE TABLE `t_alpa` (
  `id_alpa` bigint UNSIGNED NOT NULL,
  `id_mahasiswa` bigint UNSIGNED NOT NULL,
  `id_periode` bigint UNSIGNED NOT NULL,
  `jam_alpa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_alpa`
--

INSERT INTO `t_alpa` (`id_alpa`, `id_mahasiswa`, `id_periode`, `jam_alpa`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '3 Jam', '2024-12-16 07:59:51', '2024-12-16 07:59:51'),
(2, 1, 3, '80 Jam', '2024-12-16 07:59:51', '2024-12-16 07:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `t_bidkom`
--

CREATE TABLE `t_bidkom` (
  `id_bidkom` bigint UNSIGNED NOT NULL,
  `kode_bidkom` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bidkom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_bidkom`
--

INSERT INTO `t_bidkom` (`id_bidkom`, `kode_bidkom`, `nama_bidkom`, `created_at`, `updated_at`) VALUES
(1, 'WEB', 'WEB DVEELOPER', NULL, NULL),
(2, 'MOBILE', 'MOBILE DEVELOPER', NULL, NULL),
(3, 'VISUAL', 'VISUALISASI DESAIN', NULL, NULL),
(4, 'UI', 'DESIGN', NULL, NULL),
(5, 'SPEAK', 'PUBLIC SPEAKING', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_bidkom`
--

CREATE TABLE `t_detail_bidkom` (
  `id_detail_bidkom` bigint UNSIGNED NOT NULL,
  `id_bidkom` bigint UNSIGNED NOT NULL,
  `id_mahasiswa` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_detail_bidkom`
--

INSERT INTO `t_detail_bidkom` (`id_detail_bidkom`, `id_bidkom`, `id_mahasiswa`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-12-16 08:01:40', '2024-12-16 08:01:40'),
(2, 2, 1, '2024-12-16 08:01:40', '2024-12-16 08:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `t_periode`
--

CREATE TABLE `t_periode` (
  `id_periode` bigint UNSIGNED NOT NULL,
  `nama_periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_periode`
--

INSERT INTO `t_periode` (`id_periode`, `nama_periode`, `created_at`, `updated_at`) VALUES
(1, '2021 - Ganjil', '2024-12-16 07:59:37', '2024-12-16 07:59:37'),
(2, '2021 - Genap', '2024-12-16 07:59:37', '2024-12-16 07:59:37'),
(3, '2022 - Ganjil', '2024-12-16 07:59:37', '2024-12-16 07:59:37'),
(4, '2022 - Genap', '2024-12-16 07:59:37', '2024-12-16 07:59:37'),
(5, '2023 - Ganjil', '2024-12-16 07:59:37', '2024-12-16 07:59:37'),
(6, '2023 - Genap', '2024-12-16 07:59:37', '2024-12-16 07:59:37'),
(7, '2024 - Ganjil', '2024-12-16 07:59:37', '2024-12-16 07:59:37'),
(8, '2024 - Genap', '2024-12-16 07:59:37', '2024-12-16 07:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `t_qr_code`
--

CREATE TABLE `t_qr_code` (
  `id_QRCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tugas` bigint UNSIGNED NOT NULL,
  `id_mahasiswa` bigint UNSIGNED NOT NULL,
  `image_qrcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_riwayat_tugas`
--

CREATE TABLE `t_riwayat_tugas` (
  `id_riwayat_tugas` bigint UNSIGNED NOT NULL,
  `id_QRCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tugas` bigint UNSIGNED NOT NULL,
  `tanggal_dilaksanakan` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_admin`
--
ALTER TABLE `m_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `m_admin_nip_unique` (`nip`),
  ADD KEY `m_admin_id_user_foreign` (`id_user`);

--
-- Indexes for table `m_detail_tugas`
--
ALTER TABLE `m_detail_tugas`
  ADD PRIMARY KEY (`id_detail_tugas`),
  ADD KEY `m_detail_tugas_id_user_foreign` (`id_user`),
  ADD KEY `m_detail_tugas_id_jenis_kompen_foreign` (`id_jenis_kompen`);

--
-- Indexes for table `m_dosen`
--
ALTER TABLE `m_dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `m_dosen_nip_unique` (`nip`),
  ADD KEY `m_dosen_id_user_foreign` (`id_user`);

--
-- Indexes for table `m_jenis_kompen`
--
ALTER TABLE `m_jenis_kompen`
  ADD PRIMARY KEY (`id_jenis_kompen`);

--
-- Indexes for table `m_level`
--
ALTER TABLE `m_level`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `m_level_level_kode_unique` (`level_kode`);

--
-- Indexes for table `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `m_mahasiswa_nim_unique` (`nim`),
  ADD KEY `m_mahasiswa_id_user_foreign` (`id_user`);

--
-- Indexes for table `m_tendik`
--
ALTER TABLE `m_tendik`
  ADD PRIMARY KEY (`id_tendik`),
  ADD UNIQUE KEY `m_tendik_nip_unique` (`nip`),
  ADD KEY `m_tendik_id_user_foreign` (`id_user`);

--
-- Indexes for table `m_tugas`
--
ALTER TABLE `m_tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `m_tugas_id_detail_tugas_foreign` (`id_detail_tugas`),
  ADD KEY `m_tugas_id_alpa_foreign` (`id_alpa`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `m_user_level_id_foreign` (`level_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `t_alpa`
--
ALTER TABLE `t_alpa`
  ADD PRIMARY KEY (`id_alpa`),
  ADD KEY `t_alpa_id_mahasiswa_foreign` (`id_mahasiswa`),
  ADD KEY `t_alpa_id_periode_foreign` (`id_periode`);

--
-- Indexes for table `t_bidkom`
--
ALTER TABLE `t_bidkom`
  ADD PRIMARY KEY (`id_bidkom`),
  ADD UNIQUE KEY `t_bidkom_kode_bidkom_unique` (`kode_bidkom`);

--
-- Indexes for table `t_detail_bidkom`
--
ALTER TABLE `t_detail_bidkom`
  ADD PRIMARY KEY (`id_detail_bidkom`),
  ADD KEY `t_detail_bidkom_id_bidkom_foreign` (`id_bidkom`),
  ADD KEY `t_detail_bidkom_id_mahasiswa_foreign` (`id_mahasiswa`);

--
-- Indexes for table `t_periode`
--
ALTER TABLE `t_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `t_qr_code`
--
ALTER TABLE `t_qr_code`
  ADD PRIMARY KEY (`id_QRCode`),
  ADD KEY `t_qr_code_id_tugas_foreign` (`id_tugas`),
  ADD KEY `t_qr_code_id_mahasiswa_foreign` (`id_mahasiswa`);

--
-- Indexes for table `t_riwayat_tugas`
--
ALTER TABLE `t_riwayat_tugas`
  ADD PRIMARY KEY (`id_riwayat_tugas`),
  ADD KEY `t_riwayat_tugas_id_tugas_foreign` (`id_tugas`),
  ADD KEY `t_riwayat_tugas_id_qrcode_foreign` (`id_QRCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `m_admin`
--
ALTER TABLE `m_admin`
  MODIFY `id_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_detail_tugas`
--
ALTER TABLE `m_detail_tugas`
  MODIFY `id_detail_tugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_dosen`
--
ALTER TABLE `m_dosen`
  MODIFY `id_dosen` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_jenis_kompen`
--
ALTER TABLE `m_jenis_kompen`
  MODIFY `id_jenis_kompen` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  MODIFY `id_mahasiswa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_tendik`
--
ALTER TABLE `m_tendik`
  MODIFY `id_tendik` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_tugas`
--
ALTER TABLE `m_tugas`
  MODIFY `id_tugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alpa`
--
ALTER TABLE `t_alpa`
  MODIFY `id_alpa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_bidkom`
--
ALTER TABLE `t_bidkom`
  MODIFY `id_bidkom` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_detail_bidkom`
--
ALTER TABLE `t_detail_bidkom`
  MODIFY `id_detail_bidkom` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_periode`
--
ALTER TABLE `t_periode`
  MODIFY `id_periode` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_riwayat_tugas`
--
ALTER TABLE `t_riwayat_tugas`
  MODIFY `id_riwayat_tugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_admin`
--
ALTER TABLE `m_admin`
  ADD CONSTRAINT `m_admin_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id_user`);

--
-- Constraints for table `m_detail_tugas`
--
ALTER TABLE `m_detail_tugas`
  ADD CONSTRAINT `m_detail_tugas_id_jenis_kompen_foreign` FOREIGN KEY (`id_jenis_kompen`) REFERENCES `m_jenis_kompen` (`id_jenis_kompen`) ON DELETE CASCADE,
  ADD CONSTRAINT `m_detail_tugas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `m_dosen`
--
ALTER TABLE `m_dosen`
  ADD CONSTRAINT `m_dosen_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id_user`);

--
-- Constraints for table `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  ADD CONSTRAINT `m_mahasiswa_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id_user`);

--
-- Constraints for table `m_tendik`
--
ALTER TABLE `m_tendik`
  ADD CONSTRAINT `m_tendik_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `m_user` (`id_user`);

--
-- Constraints for table `m_tugas`
--
ALTER TABLE `m_tugas`
  ADD CONSTRAINT `m_tugas_id_alpa_foreign` FOREIGN KEY (`id_alpa`) REFERENCES `t_alpa` (`id_alpa`) ON DELETE CASCADE,
  ADD CONSTRAINT `m_tugas_id_detail_tugas_foreign` FOREIGN KEY (`id_detail_tugas`) REFERENCES `m_detail_tugas` (`id_detail_tugas`) ON DELETE CASCADE;

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `m_level` (`level_id`);

--
-- Constraints for table `t_alpa`
--
ALTER TABLE `t_alpa`
  ADD CONSTRAINT `t_alpa_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `m_mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `t_alpa_id_periode_foreign` FOREIGN KEY (`id_periode`) REFERENCES `t_periode` (`id_periode`);

--
-- Constraints for table `t_detail_bidkom`
--
ALTER TABLE `t_detail_bidkom`
  ADD CONSTRAINT `t_detail_bidkom_id_bidkom_foreign` FOREIGN KEY (`id_bidkom`) REFERENCES `t_bidkom` (`id_bidkom`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_detail_bidkom_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `m_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE;

--
-- Constraints for table `t_qr_code`
--
ALTER TABLE `t_qr_code`
  ADD CONSTRAINT `t_qr_code_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `m_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_qr_code_id_tugas_foreign` FOREIGN KEY (`id_tugas`) REFERENCES `m_tugas` (`id_tugas`) ON DELETE CASCADE;

--
-- Constraints for table `t_riwayat_tugas`
--
ALTER TABLE `t_riwayat_tugas`
  ADD CONSTRAINT `t_riwayat_tugas_id_qrcode_foreign` FOREIGN KEY (`id_QRCode`) REFERENCES `t_qr_code` (`id_QRCode`) ON DELETE SET NULL,
  ADD CONSTRAINT `t_riwayat_tugas_id_tugas_foreign` FOREIGN KEY (`id_tugas`) REFERENCES `m_tugas` (`id_tugas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
