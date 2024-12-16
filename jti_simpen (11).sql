-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2024 at 08:24 AM
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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_13_085828_create_t_periode_alpa_table', 1),
(6, '2024_11_20_123554_create_m_level_table', 2),
(7, '2024_11_20_125527_create_m_user_table', 2),
(8, '2024_11_20_130001_create_t_bidkom_table', 2),
(10, '2024_11_20_130035_create_m_admin_table', 2),
(11, '2024_11_20_130038_create_m_dosen_table', 2),
(12, '2024_11_20_130044_create_m_tendik_table', 2),
(13, '2024_12_03_092759_create_m_mahasiswa_table', 3),
(14, '2024_12_04_033332_create_t_bidkom_table', 4),
(15, '2024_12_04_042100_create_m_jenis_kompen_table', 5),
(16, '2024_12_04_044935_create_m_tugas_mahasiswa_table', 6),
(18, '2024_12_05_065430_create_t_periode', 7),
(19, '2024_12_05_071047_create_m_tugas_mahasiswa', 8),
(20, '2024_12_05_082752_create_m_tugas_pendidik', 9),
(24, '2024_12_05_083212_create_m_mahasiswa', 10),
(25, '2024_12_06_144313_create_t_periode_table', 11),
(26, '2024_12_06_142738_create_m_jenis_kompen_table', 12),
(30, '2024_12_06_115022_create_t_alpa_table', 13),
(31, '2024_12_06_115709_create_m_detail_tugas_table', 13),
(32, '2024_12_06_145201_create_m_tugas_table', 14),
(33, '2024_12_06_145038_create_t_riwayat_tugas_table', 15),
(34, '2024_12_06_151239_create_m_tugas_table', 16),
(35, '2024_12_06_151438_create_t_alpa_table', 17),
(36, '2024_12_07_103232_create_m_tugas_table', 18),
(37, '2024_12_07_103723_create_t_riwayat_tugas_table', 19),
(38, '2024_12_07_114747_create_m_user_table', 20),
(39, '2024_12_10_071618_create_t_detail_bidkom_table', 21),
(41, '2024_12_10_071949_create_m_mahasiswa_table', 22);

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
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_admin`
--

INSERT INTO `m_admin` (`id_admin`, `id_user`, `nip`, `email`, `nama_admin`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 1, '113242322212w', 'ahmad.abror@gmail.com', 'Ahmad Abror Rozaqi', '08122222', '2024-12-09 23:51:38', '2024-12-12 06:19:42'),
(8, 47, '11324233', 'rojaki13419@gmail.com', 'namaada', '0822459640', '2024-12-14 04:47:26', '2024-12-14 22:49:25'),
(9, 50, NULL, 'karindev@gmail.comfuycfehcjreh', 'nama admin huhhu', '232323232323', '2024-12-15 00:03:40', '2024-12-15 00:03:59'),
(10, 52, NULL, NULL, 'joyojoyo', NULL, '2024-12-15 06:30:00', '2024-12-15 06:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_detail_tugas`
--

CREATE TABLE `m_detail_tugas` (
  `id_detail_tugas` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_jenis_kompen` bigint UNSIGNED NOT NULL,
  `nama_tugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_tugas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int NOT NULL,
  `nilai_kompen` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_detail_tugas`
--

INSERT INTO `m_detail_tugas` (`id_detail_tugas`, `id_user`, `id_jenis_kompen`, `nama_tugas`, `deskripsi_tugas`, `kuota`, `nilai_kompen`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Pengabdian Desa', 'Melakukan Pengabdian desa guna membangun masyarakat yang solutif', 10, 20, '2024-12-09 00:18:00', '2024-12-09 00:18:00'),
(2, 2, 2, 'Penelitian P', 'Melakukan analisis dan penulisan laporan terkait proyek B dengan fokus pada efisiensi.', 15, 30, '2024-12-09 00:18:00', '2024-12-09 00:18:00'),
(3, 1, 2, 'Pengabdian Desa Maibit', 'Melakukan Pengabdian desa guna membangun masyarakat yang solutif', 10, 10, '2024-12-11 00:10:40', '2024-12-11 00:10:40'),
(4, 2, 3, 'Penelitian P.DIddy', 'Melakukan analisis dan penulisan laporan terkait proyek B dengan fokus pada efisiensi.', 15, 30, '2024-12-11 00:10:40', '2024-12-11 00:10:40'),
(5, 1, 1, 'dsfsdfdsfsad', 'asdasdasdaad', 12, 22, '2024-12-11 05:56:01', '2024-12-11 05:56:01'),
(6, 1, 2, 'anas suka kpeju', 'kpeju nya adalah milik zaki', 69, 96, '2024-12-11 05:59:14', '2024-12-11 05:59:14'),
(7, 2, 3, 'Ngeprint lampiran', 'Ngeprint 70 lembar', 32, 9, '2024-12-11 08:18:00', '2024-12-11 08:18:00'),
(8, 2, 2, 'Coliin wiwing', 'Wiwing suka crot 5x', 7, 21, '2024-12-11 08:22:49', '2024-12-11 08:22:49'),
(9, 1, 2, 'testing ajanihh', 'testing asaja', 12, 23, '2024-12-14 05:03:22', '2024-12-14 05:03:22'),
(10, 2, 2, 'Ngeprint lampiran dokumen', 'Ngeprint lampiraaaaan', 8, 10, '2024-12-16 01:17:26', '2024-12-16 01:17:26');

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
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_dosen`
--

INSERT INTO `m_dosen` (`id_dosen`, `id_user`, `nip`, `email`, `nama_dosen`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 2, '1986543210', 'afifah.rahma@example.com', 'Afifah Rahma', '081234567891', '2024-12-09 01:48:55', '2024-12-09 01:48:55'),
(4, 51, '32123123', 'asdasdsad@faadas', 'dosen namaaaa', '123123123123', '2024-12-15 00:04:38', '2024-12-15 00:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_kompen`
--

CREATE TABLE `m_jenis_kompen` (
  `id_jenis_kompen` bigint UNSIGNED NOT NULL,
  `nama_jenis_kompen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_jenis_kompen`
--

INSERT INTO `m_jenis_kompen` (`id_jenis_kompen`, `nama_jenis_kompen`, `created_at`, `updated_at`) VALUES
(1, 'Pengabdian', '2024-12-08 05:23:02', '2024-12-08 05:23:02'),
(2, 'Penelitian', '2024-12-08 05:23:02', '2024-12-08 05:23:02'),
(3, 'Teknis', '2024-12-08 05:23:02', '2024-12-08 05:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_studi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_masuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_mahasiswa`
--

INSERT INTO `m_mahasiswa` (`id_mahasiswa`, `id_user`, `nama_mahasiswa`, `nim`, `email`, `no_telepon`, `program_studi`, `tahun_masuk`, `created_at`, `updated_at`) VALUES
(1, 4, 'Amanda Jasmyne', '2241760123', 'amandajbp04@gmail.com', '081237621316', 'Sistem Informasi Bisnis', '2024', '2024-12-10 00:41:50', '2024-12-12 04:37:50');

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
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_tendik`
--

INSERT INTO `m_tendik` (`id_tendik`, `id_user`, `nip`, `email`, `nama_tendik`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 3, '1987456123', 'anas.nurhidayat@example.com', 'Anas Nurhidayat', '081234567892', '2024-12-09 01:50:09', '2024-12-09 01:50:09'),
(2, 32, '113242322', 'sdqwj@h2H3WE22.com', '123455', NULL, '2024-12-12 05:33:06', '2024-12-12 05:33:06'),
(3, 42, '22343123', NULL, 'Asasndjasnl', NULL, '2024-12-14 04:36:01', '2024-12-14 04:36:01'),
(5, 49, '123123', 'asdasd@3123', 'namanama', '21312323213', '2024-12-14 23:58:36', '2024-12-15 00:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `m_tugas`
--

CREATE TABLE `m_tugas` (
  `id_tugas` bigint UNSIGNED NOT NULL,
  `id_detail_tugas` bigint UNSIGNED NOT NULL,
  `id_alpa` bigint UNSIGNED DEFAULT NULL,
  `progress_tugas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_tugas`
--

INSERT INTO `m_tugas` (`id_tugas`, `id_detail_tugas`, `id_alpa`, `progress_tugas`, `created_at`, `updated_at`) VALUES
(2, 6, 1, '80', '2024-12-14 14:10:37', '2024-12-14 14:10:37'),
(3, 2, 1, 'Dalam Proses', '2024-12-15 03:37:43', '2024-12-15 03:37:43'),
(4, 9, 1, 'Dalam Proses', '2024-12-15 03:39:08', '2024-12-15 03:39:08'),
(5, 7, 1, 'Dalam Proses', '2024-12-16 00:56:39', '2024-12-16 00:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id_user` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id_user`, `level_id`, `username`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ahmad Abror', '$2y$12$coRcSaCYh.7ayZNbUGW1d.qqHSu/PS0i85ri6MnP98wEPJe2eOjUK', 'image/profile/1733639063.png', '2024-12-07 04:48:46', '2024-12-09 23:51:51'),
(2, 2, 'Afifah Rahma', '$2y$12$SQmFSExBpGefgMgCd4u/I.RAQ88AGLuL/5xHaz738caJRjg4.2xpq', 'image/profile/1733900478.jpg', '2024-12-07 04:48:46', '2024-12-11 00:01:18'),
(3, 3, 'Anas Nur Hidayat', '$2y$12$MlfmQqv/CXH6UlA2tZZMAuh/YK.7nB/jjiUMuZULJuNuD9PQVm5Qe', NULL, '2024-12-07 04:48:47', '2024-12-07 04:48:47'),
(4, 4, 'Amanda Jasmyne', '$2y$12$j.5uNsNvIl1XmyLRM8tfuuyl/MFl8jVrr8WDIdNTrIVrnT0kBZAsO', 'image/profile/1733637001.png', '2024-12-07 04:48:47', '2024-12-09 03:24:34'),
(32, 3, 'kunu234', '$2y$12$3TKi/feO1Ts3M50gwYcbGOBfNla6O6kTaUaNqFQlQ3sDUCW2BitD2', NULL, '2024-12-12 05:33:06', '2024-12-12 05:33:06'),
(33, 2, 'tsania', '$2y$12$KeAyZLw9nPeMYPeWFsKiK.VEq5jWIKMC6FL7P4Wj/0ShTsCb44/VW', NULL, '2024-12-12 05:33:47', '2024-12-12 05:33:47'),
(41, 2, 'Pak Danin', '$2y$12$W.ZhK7AKGoNXyuKwTpnMguMFCPB2mR2ji.o9SzbeE2kmEcdVTJW/6', NULL, '2024-12-13 03:28:20', '2024-12-13 03:28:20'),
(42, 3, 'Pak testing', '$2y$12$V5xBfjycW.2HPFrF/YCP..Mg/qX4jfdarANA/tM8N.aLlYvwkyWKO', NULL, '2024-12-14 04:36:01', '2024-12-14 04:36:01'),
(47, 1, 'namapengadmin', '$2y$12$NWVDNtPuwa4TuDFiJLuVuuw2f6hpDeNXoT4.TAVeIRyEslacrC5Za', NULL, '2024-12-14 04:47:26', '2024-12-14 04:47:26'),
(48, 4, 'kintil', '$2y$12$Cv88hgFhG..DAev/aVS/VelcDteqHEv/1wjJFt5.FJ/eXr4CW7y.q', NULL, '2024-12-14 22:46:48', '2024-12-14 22:46:48'),
(49, 3, 'Ahmad Tendik', '$2y$12$aSMePWYNZL8aIXI.mVNOvutgver7C/EHaPXSsNVzvvWVQfgpegRoe', 'image/profile/1734246613.png', '2024-12-14 23:58:36', '2024-12-15 00:10:13'),
(50, 1, 'Ahmad Admin', '$2y$12$6F94gXuyPsT0IQC0sd3aBOFcVdHcqyY2119Kital.sEG9VrAxltZS', NULL, '2024-12-15 00:03:40', '2024-12-15 00:03:40'),
(51, 2, 'Ahmad Dosen', '$2y$12$.xz0kaQWaUBfgxFg/qskCebgscryH6M5JGkxUVRhVqCaAMSRaxQqm', NULL, '2024-12-15 00:04:38', '2024-12-15 00:04:38'),
(52, 1, 'joyo', '$2y$12$jnav4KA3tBCBt.aVx1b5quJkKo0T3qb40JtWTNxE7DpDn00A./xqq', 'image/profile/1734269457.png', '2024-12-15 06:30:00', '2024-12-15 06:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `jam_alpa` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_alpa`
--

INSERT INTO `t_alpa` (`id_alpa`, `id_mahasiswa`, `id_periode`, `jam_alpa`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '3 Jam', '2024-12-11 00:24:36', '2024-12-11 00:24:36'),
(2, 1, 1, '3 Jam', '2024-12-11 01:10:30', '2024-12-11 01:10:30'),
(3, 1, 3, '80 Jam', '2024-12-11 01:10:30', '2024-12-11 01:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `t_bidkom`
--

CREATE TABLE `t_bidkom` (
  `id_bidkom` bigint UNSIGNED NOT NULL,
  `kode_bidkom` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bidkom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_bidkom`
--

INSERT INTO `t_bidkom` (`id_bidkom`, `kode_bidkom`, `nama_bidkom`, `created_at`, `updated_at`) VALUES
(1, 'WEB', 'WEB DEVELOPER', NULL, '2024-12-11 05:15:07'),
(2, 'MOBILE', 'MOBILE DEVELOPER', NULL, '2024-12-08 04:35:39'),
(3, 'VISUAL', 'VISUALISASI DESAIN', NULL, NULL),
(4, 'UI', 'DESIGN', NULL, NULL),
(5, 'SPEAK', 'PUBLIC SPEAKING', NULL, NULL),
(11, 'kelas', 'kelasking12', '2024-12-08 03:34:06', '2024-12-08 07:19:38');

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
(1, 1, 1, '2024-12-10 01:03:43', '2024-12-10 01:03:43'),
(2, 2, 1, '2024-12-10 01:03:43', '2024-12-10 01:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `t_periode`
--

CREATE TABLE `t_periode` (
  `id_periode` bigint UNSIGNED NOT NULL,
  `nama_periode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_periode`
--

INSERT INTO `t_periode` (`id_periode`, `nama_periode`, `created_at`, `updated_at`) VALUES
(1, '2021 - Ganjil', '2024-12-07 03:38:41', '2024-12-07 03:38:41'),
(2, '2021 - Genap', '2024-12-07 03:38:41', '2024-12-07 03:38:41'),
(3, '2022 - Ganjil', '2024-12-07 03:38:41', '2024-12-07 03:38:41'),
(4, '2022 - Genap', '2024-12-07 03:38:41', '2024-12-07 03:38:41'),
(5, '2023 - Ganjil', '2024-12-07 03:38:41', '2024-12-07 03:38:41'),
(6, '2023 - Genap', '2024-12-07 03:38:41', '2024-12-07 03:38:41'),
(7, '2024 - Ganjil', '2024-12-07 03:38:41', '2024-12-07 03:38:41'),
(8, '2024 - Genap', '2024-12-07 03:38:41', '2024-12-07 03:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `t_qr_code`
--

CREATE TABLE `t_qr_code` (
  `id_QRCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tugas` bigint UNSIGNED NOT NULL,
  `id_mahasiswa` bigint UNSIGNED NOT NULL,
  `deskripsi_qrcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_qrcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai_berlaku` datetime NOT NULL,
  `akhir_berlaku` datetime NOT NULL,
  `status` enum('selesai','aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_riwayat_tugas`
--

CREATE TABLE `t_riwayat_tugas` (
  `id_riwayat_tugas` bigint UNSIGNED NOT NULL,
  `id_tugas` bigint UNSIGNED NOT NULL,
  `tanggal_dilaksanakan` datetime DEFAULT CURRENT_TIMESTAMP,
  `tanggal_selesai` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_riwayat_tugas`
--

INSERT INTO `t_riwayat_tugas` (`id_riwayat_tugas`, `id_tugas`, `tanggal_dilaksanakan`, `tanggal_selesai`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-12-14 21:27:16', '2024-12-14 21:27:16', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD KEY `t_qr_code_id_tugas_foreign` (`id_tugas`);

--
-- Indexes for table `t_riwayat_tugas`
--
ALTER TABLE `t_riwayat_tugas`
  ADD PRIMARY KEY (`id_riwayat_tugas`),
  ADD KEY `t_riwayat_tugas_id_tugas_foreign` (`id_tugas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `m_admin`
--
ALTER TABLE `m_admin`
  MODIFY `id_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_detail_tugas`
--
ALTER TABLE `m_detail_tugas`
  MODIFY `id_detail_tugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_dosen`
--
ALTER TABLE `m_dosen`
  MODIFY `id_dosen` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_jenis_kompen`
--
ALTER TABLE `m_jenis_kompen`
  MODIFY `id_jenis_kompen` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  MODIFY `id_mahasiswa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `m_tendik`
--
ALTER TABLE `m_tendik`
  MODIFY `id_tendik` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_tugas`
--
ALTER TABLE `m_tugas`
  MODIFY `id_tugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_alpa`
--
ALTER TABLE `t_alpa`
  MODIFY `id_alpa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_bidkom`
--
ALTER TABLE `t_bidkom`
  MODIFY `id_bidkom` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id_riwayat_tugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `t_qr_code_id_tugas_foreign` FOREIGN KEY (`id_tugas`) REFERENCES `m_tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `t_riwayat_tugas`
--
ALTER TABLE `t_riwayat_tugas`
  ADD CONSTRAINT `t_riwayat_tugas_id_tugas_foreign` FOREIGN KEY (`id_tugas`) REFERENCES `m_tugas` (`id_tugas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
