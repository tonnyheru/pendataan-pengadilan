-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 07:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengadilan`
--

-- --------------------------------------------------------

--
-- Table structure for table `akta_kematian_details`
--

CREATE TABLE `akta_kematian_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nik_jenazah` varchar(16) DEFAULT NULL,
  `nama_jenazah` varchar(255) DEFAULT NULL,
  `wilayah_kelahiran` enum('dalam_negeri','luar_negeri') DEFAULT NULL,
  `provinsi_kelahiran` varchar(100) DEFAULT NULL,
  `tanggal_kematian` date DEFAULT NULL,
  `waktu_kematian` time DEFAULT NULL,
  `tempat_kematian` varchar(255) DEFAULT NULL,
  `sebab_kematian` varchar(255) DEFAULT NULL,
  `yang_menerangkan` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `nik_ayah` varchar(16) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nik_ibu` varchar(16) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nik_saksi1` varchar(16) DEFAULT NULL,
  `nama_saksi1` varchar(255) DEFAULT NULL,
  `nik_saksi2` varchar(16) DEFAULT NULL,
  `nama_saksi2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akta_kematian_details`
--

INSERT INTO `akta_kematian_details` (`uid`, `submission_uid`, `nik_jenazah`, `nama_jenazah`, `wilayah_kelahiran`, `provinsi_kelahiran`, `tanggal_kematian`, `waktu_kematian`, `tempat_kematian`, `sebab_kematian`, `yang_menerangkan`, `keterangan`, `nik_ayah`, `nama_ayah`, `nik_ibu`, `nama_ibu`, `nik_saksi1`, `nama_saksi1`, `nik_saksi2`, `nama_saksi2`) VALUES
('88aa6e9b-373f-400a-9653-87721bbae297', '603c7c1a-9b62-430b-9ebb-4397cda9cb16', '1234123412341234', 'JENAZAH', 'dalam_negeri', '32', '2025-05-08', '12:00:00', 'Masjid', 'Tidur', 'Asatidz', 'meninggal karena dipanggil', '1234123412341234', 'Ayah Jenazah', '1234123412341234', 'Ibu Jenazah', '1234123412341234', 'Saksi 1 Jenazah', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `akta_perceraian_details`
--

CREATE TABLE `akta_perceraian_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nik_suami` varchar(16) DEFAULT NULL,
  `kk_suami` varchar(16) DEFAULT NULL,
  `paspor_suami` varchar(50) DEFAULT NULL,
  `nama_suami` varchar(255) DEFAULT NULL,
  `tempat_lahir_suami` varchar(100) DEFAULT NULL,
  `tanggal_lahir_suami` date DEFAULT NULL,
  `alamat_suami` text DEFAULT NULL,
  `perceraian_ke` varchar(10) DEFAULT NULL,
  `kewarganegaraan_suami` varchar(50) DEFAULT NULL,
  `nik_istri` varchar(16) DEFAULT NULL,
  `kk_istri` varchar(16) DEFAULT NULL,
  `paspor_istri` varchar(50) DEFAULT NULL,
  `nama_istri` varchar(255) DEFAULT NULL,
  `tempat_lahir_istri` varchar(100) DEFAULT NULL,
  `tanggal_lahir_istri` date DEFAULT NULL,
  `alamat_istri` text DEFAULT NULL,
  `kewarganegaraan_istri` varchar(50) DEFAULT NULL,
  `yang_mengajukan` varchar(10) DEFAULT NULL,
  `no_akta_kawin` varchar(100) DEFAULT NULL,
  `tanggal_akta_kawin` date DEFAULT NULL,
  `tempat_perkawinan` varchar(255) DEFAULT NULL,
  `no_putusan` varchar(100) DEFAULT NULL,
  `tanggal_putusan` date DEFAULT NULL,
  `sebab_perceraian` text DEFAULT NULL,
  `tanggal_lapor` date DEFAULT NULL,
  `waktu_lapor` time DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akta_perceraian_details`
--

INSERT INTO `akta_perceraian_details` (`uid`, `submission_uid`, `nik_suami`, `kk_suami`, `paspor_suami`, `nama_suami`, `tempat_lahir_suami`, `tanggal_lahir_suami`, `alamat_suami`, `perceraian_ke`, `kewarganegaraan_suami`, `nik_istri`, `kk_istri`, `paspor_istri`, `nama_istri`, `tempat_lahir_istri`, `tanggal_lahir_istri`, `alamat_istri`, `kewarganegaraan_istri`, `yang_mengajukan`, `no_akta_kawin`, `tanggal_akta_kawin`, `tempat_perkawinan`, `no_putusan`, `tanggal_putusan`, `sebab_perceraian`, `tanggal_lapor`, `waktu_lapor`, `keterangan`) VALUES
('c3048324-465d-4adf-9bd1-b1206fbdc5e4', '98728984-188a-4041-8831-6c83bfa996d7', '1234123412341234', '1234123412341234', NULL, 'Suami', 'Bandung', '2025-05-01', 'Alamat Suami', '1', 'Indonesia', '1234123412341234', '1234123412341234', NULL, 'Istri', 'Bandung', '2025-05-15', 'Alamat Istri', 'Indonesia', 'Suami', 'AKTA.KAWIN/V/2025', '2025-05-14', 'Gedung', 'PUTUSAN/V/2025', '2025-05-21', 'Meninggal', '2025-05-14', '12:00:00', 'ini keterangan');

-- --------------------------------------------------------

--
-- Table structure for table `akta_perkawinan_details`
--

CREATE TABLE `akta_perkawinan_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nik_suami` varchar(16) DEFAULT NULL,
  `kk_suami` varchar(16) DEFAULT NULL,
  `nama_suami` varchar(255) DEFAULT NULL,
  `kewarganegaraan_suami` varchar(50) DEFAULT NULL,
  `alamat_suami` text DEFAULT NULL,
  `anak_ke_suami` varchar(10) DEFAULT NULL,
  `perkawinan_ke_suami` varchar(10) DEFAULT NULL,
  `nama_istri_terakhir` varchar(255) DEFAULT NULL,
  `istri_ke` varchar(10) DEFAULT NULL,
  `nik_ayah_suami` varchar(16) DEFAULT NULL,
  `nama_ayah_suami` varchar(255) DEFAULT NULL,
  `nik_ibu_suami` varchar(16) DEFAULT NULL,
  `nama_ibu_suami` varchar(255) DEFAULT NULL,
  `nik_istri` varchar(16) DEFAULT NULL,
  `kk_istri` varchar(16) DEFAULT NULL,
  `nama_istri` varchar(255) DEFAULT NULL,
  `kewarganegaraan_istri` varchar(50) DEFAULT NULL,
  `alamat_istri` text DEFAULT NULL,
  `anak_ke_istri` varchar(10) DEFAULT NULL,
  `perkawinan_ke_istri` varchar(10) DEFAULT NULL,
  `nama_suami_terakhir` varchar(255) DEFAULT NULL,
  `nik_ayah_istri` varchar(16) DEFAULT NULL,
  `nama_ayah_istri` varchar(255) DEFAULT NULL,
  `nik_ibu_istri` varchar(16) DEFAULT NULL,
  `nama_ibu_istri` varchar(255) DEFAULT NULL,
  `nik_saksi1` varchar(16) DEFAULT NULL,
  `nama_saksi1` varchar(255) DEFAULT NULL,
  `nik_saksi2` varchar(16) DEFAULT NULL,
  `nama_saksi2` varchar(255) DEFAULT NULL,
  `tanggal_pemberkatan` date DEFAULT NULL,
  `tempat_pemberkatan` varchar(255) DEFAULT NULL,
  `tanggal_lapor` date DEFAULT NULL,
  `waktu_lapor` time DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `nama_pemuka_agama` varchar(255) DEFAULT NULL,
  `no_putusan` varchar(100) DEFAULT NULL,
  `tanggal_putusan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akta_perkawinan_details`
--

INSERT INTO `akta_perkawinan_details` (`uid`, `submission_uid`, `nik_suami`, `kk_suami`, `nama_suami`, `kewarganegaraan_suami`, `alamat_suami`, `anak_ke_suami`, `perkawinan_ke_suami`, `nama_istri_terakhir`, `istri_ke`, `nik_ayah_suami`, `nama_ayah_suami`, `nik_ibu_suami`, `nama_ibu_suami`, `nik_istri`, `kk_istri`, `nama_istri`, `kewarganegaraan_istri`, `alamat_istri`, `anak_ke_istri`, `perkawinan_ke_istri`, `nama_suami_terakhir`, `nik_ayah_istri`, `nama_ayah_istri`, `nik_ibu_istri`, `nama_ibu_istri`, `nik_saksi1`, `nama_saksi1`, `nik_saksi2`, `nama_saksi2`, `tanggal_pemberkatan`, `tempat_pemberkatan`, `tanggal_lapor`, `waktu_lapor`, `agama`, `nama_pemuka_agama`, `no_putusan`, `tanggal_putusan`) VALUES
('3a92c61f-8b56-45f1-bd6d-204b302162c2', 'ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', '1234123412341234', '1234123412341234', 'Suami', 'Indonesia', 'Alamat Suami', '1', '1', NULL, '1', '1234123412341234', 'Ayah Suami', '1234123412341234', 'Ibu Suami', '1234123412341234', '1234123412341234', 'Istri', 'Indonesia', 'Alamat Istri', '1', '1', NULL, '1234123412341234', 'Ayah Istri', '1234123412341234', 'Ibu Istri', '1234123412341234', 'Saksi 1', '1234123412341234', 'Saksi 2', '2025-05-15', 'Gedung', '2025-05-23', '12:00:00', 'islam', 'Ustadz', 'PUTUSAN/V/2025', '2025-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disdukcapil`
--

CREATE TABLE `disdukcapil` (
  `uid` varchar(40) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cdn_picture` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disdukcapil`
--

INSERT INTO `disdukcapil` (`uid`, `nama`, `alamat`, `no_telp`, `email`, `cdn_picture`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('1c39d652-51f0-4cf8-b833-791eb6372528', 'Disdukcapil Kabupaten Bandung Barat', 'Komplek Pemda KBB Jl. Raya Padalarang Cisarua Km.2 Ngamprah, Jawa Barat, Indonesia', '08562122827', 'kevinbramasta321@gmail.com', 'https://raw.githubusercontent.com/tonnyheru/cdn-pengadilan/refs/heads/main/bandung_barat.png', '2025-03-17 05:25:07', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-20 02:21:26', NULL),
('8a7fb795-51c5-49c1-a91d-403f43138a4e', 'Disdukcapil Kabupaten Bandung', 'Jl. Raya Soreang, Kabupaten Bandung 40911', '085318202833', 'kevinbramasta321@gmail.com', 'https://raw.githubusercontent.com/tonnyheru/cdn-pengadilan/refs/heads/main/logo-bandung.png', '2025-03-17 05:24:23', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-17 15:57:42', NULL),
('b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', 'Disdukcapil Kota Cimahi', 'Mal Pelayanan Publik Kota Cimahi, Jl. Aruman Lt. 3, Pasirkaliki, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40514', '(022) 6631885', 'tonnyheru29@gmail.com', 'https://raw.githubusercontent.com/tonnyheru/cdn-pengadilan/refs/heads/main/logo-cimahi.png', '2025-03-17 05:21:13', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-18 02:48:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(15, 'default', '{\"uuid\":\"8586ab54-7c48-4697-9f9c-9dc06d66027b\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732602469, 1732602469),
(16, 'default', '{\"uuid\":\"8b80ab09-56a4-4247-ae2b-e5be676359e5\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732602472, 1732602472),
(17, 'default', '{\"uuid\":\"30fb5f08-59d1-4083-a4c6-c45902c338da\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732602732, 1732602732),
(18, 'default', '{\"uuid\":\"15e5a1d2-609c-4a5c-8842-3d08c28b4205\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732851178, 1732851178),
(19, 'default', '{\"uuid\":\"2f9bce35-6cf5-4a43-8b2b-d0d3517fc2f9\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732851179, 1732851179),
(20, 'default', '{\"uuid\":\"1e214d9f-0134-4617-9409-f2b2ea05baf2\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732851181, 1732851181),
(21, 'default', '{\"uuid\":\"353a75bf-6baa-4fa1-a935-43095a403bba\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732851191, 1732851191),
(22, 'default', '{\"uuid\":\"b0127e39-2b17-47a2-b105-424b8e5b2200\",\"displayName\":\"App\\\\Events\\\\ChatEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:20:\\\"App\\\\Events\\\\ChatEvent\\\":1:{s:7:\\\"message\\\";s:4:\\\"chat\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1732851195, 1732851195);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(5, '2024_11_14_999999_add_active_status_to_users', 2),
(6, '2024_11_14_999999_add_avatar_to_users', 2),
(7, '2024_11_14_999999_add_dark_mode_to_users', 2),
(8, '2024_11_14_999999_add_messenger_color_to_users', 2),
(9, '2024_11_14_999999_create_chatify_favorites_table', 2),
(10, '2024_11_14_999999_create_chatify_messages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `uid` varchar(40) NOT NULL,
  `description` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`uid`, `description`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('100085fd-e69b-4db4-9f12-a2a33e118214', 'Mutasi', 'Mutasi', '2025-03-03 03:54:19', NULL, '2025-03-03 03:54:19', NULL),
('10aa1d11-270c-47ab-8c03-d20bc20225e8', 'Role', 'Role', '2024-10-17 07:29:42', NULL, '2024-10-17 07:29:42', NULL),
('2bdd61da-92ef-4208-af2d-0ea0425efe41', 'Menu Pembatalan Akta Kelahiran', 'Pembatalan Akta Kelahiran', '2025-05-21 01:35:24', NULL, '2025-05-21 01:35:24', NULL),
('34274232-b71a-4fd6-b871-da859a2cffe8', 'Menu Usulan', 'Usulan', '2025-03-10 04:01:35', NULL, '2025-03-10 04:01:35', NULL),
('34aafef3-453f-40ad-a9a0-851459faccee', 'Menu Penerbitan Akta Perkawinan', 'Penerbitan Akta Perkawinan', '2025-05-21 01:34:24', NULL, '2025-05-21 01:34:24', NULL),
('3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', 'User', 'User', '2024-10-17 07:29:49', NULL, '2024-10-17 07:29:49', NULL),
('42634834-66e0-45bf-8835-99f2004a3b05', 'Dashboard', 'Dashboard', '2024-10-17 03:56:14', NULL, '2024-10-17 03:57:23', NULL),
('5820277c-ee1e-444c-b24b-ef781f54a727', 'Menu Pembatalan Perceraian', 'Pembatalan Perceraian', '2025-05-21 01:35:44', NULL, '2025-05-22 01:30:32', NULL),
('768899c4-1011-4149-b9ef-a7864b3516d7', 'Menu Penerbitan Akta Kematian', 'Penerbitan Akta Kematian', '2025-05-21 01:34:10', NULL, '2025-05-21 01:34:10', NULL),
('78eefbc3-b248-4d7c-a355-a83ed0103c4b', 'Module', 'Module', '2024-10-17 07:29:38', NULL, '2024-10-17 07:29:38', NULL),
('8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', 'Disdukcapil', 'Disdukcapil', '2025-03-17 04:36:33', NULL, '2025-03-17 04:36:33', NULL),
('8f791e07-3c28-4745-a517-9fc7316f24b0', 'Menu Pengangkatan Anak', 'Pengangkatan Anak', '2025-05-21 01:34:54', NULL, '2025-05-21 01:34:54', NULL),
('98bb7a50-9edb-4356-90c8-409cf75cd962', 'Pemohon', 'Pemohon', '2025-03-06 05:40:47', NULL, '2025-03-06 06:23:17', NULL),
('a81dcc89-90ca-4bcb-a87b-5c512b573118', 'Menu Perbaikan Akta', 'Perbaikan Akta', '2025-05-21 01:33:50', NULL, '2025-05-21 01:33:50', NULL),
('a9e39221-3834-4e48-88f2-455daae1cf24', 'Profile', 'Profile', '2025-03-06 02:20:40', NULL, '2025-03-06 02:20:40', NULL),
('c9a260f1-235d-4d2a-94b9-72557d42ddd0', 'Menu Penerbitan Akta Perceraian', 'Penerbitan Akta Perceraian', '2025-05-21 01:34:38', NULL, '2025-05-21 01:34:38', NULL),
('c9a7887e-180e-41b5-a51d-1217e1863017', 'Menu Pengakuan Anak', 'Pengakuan Anak', '2025-05-21 01:35:08', NULL, '2025-05-21 01:35:08', NULL),
('d91f05b6-d2e4-4dc4-ba23-dd0b9aa25335', 'Menu Pembatalan Perkawinan', 'Pembatalan Perkawinan', '2025-05-21 01:36:05', NULL, '2025-05-21 01:36:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `uid` varchar(40) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `origin_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembatalan_akta_kelahiran_details`
--

CREATE TABLE `pembatalan_akta_kelahiran_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_pemilik_akta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembatalan_akta_kelahiran_details`
--

INSERT INTO `pembatalan_akta_kelahiran_details` (`uid`, `submission_uid`, `nama_pemilik_akta`) VALUES
('c65a36cd-22b0-4c6d-bf5d-50031b73f9a2', '3812eb78-39e7-492f-bb7b-ee27aec6b620', 'Robert Edit');

-- --------------------------------------------------------

--
-- Table structure for table `pembatalan_perceraian_details`
--

CREATE TABLE `pembatalan_perceraian_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_suami` varchar(255) DEFAULT NULL,
  `nama_istri` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembatalan_perceraian_details`
--

INSERT INTO `pembatalan_perceraian_details` (`uid`, `submission_uid`, `nama_suami`, `nama_istri`) VALUES
('ce38fd9b-5bcf-4d6f-8e9b-70c291853673', 'ffbfe124-09ca-42b0-991a-b557e413524a', 'Suami Edit', 'Istri Edit');

-- --------------------------------------------------------

--
-- Table structure for table `pembatalan_perkawinan_details`
--

CREATE TABLE `pembatalan_perkawinan_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_suami` varchar(255) DEFAULT NULL,
  `nama_istri` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembatalan_perkawinan_details`
--

INSERT INTO `pembatalan_perkawinan_details` (`uid`, `submission_uid`, `nama_suami`, `nama_istri`) VALUES
('65c8b6c4-f0d7-44b6-981d-9428cc1bbb35', '01c5532f-7c29-4f7b-a915-fda98ed4dab7', 'Suami Edit', 'Istri Edit');

-- --------------------------------------------------------

--
-- Table structure for table `pemohon`
--

CREATE TABLE `pemohon` (
  `uid` varchar(40) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `province` varchar(10) DEFAULT NULL,
  `regency` varchar(10) DEFAULT NULL,
  `district` varchar(10) DEFAULT NULL,
  `village` varchar(10) DEFAULT NULL,
  `kk` varchar(20) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `akta_kelahiran` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `blood_type` varchar(3) NOT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `status_kawin` varchar(5) DEFAULT NULL,
  `akta_kawin` varchar(255) DEFAULT NULL,
  `tanggal_kawin` date DEFAULT NULL,
  `akta_cerai` varchar(255) DEFAULT NULL,
  `tanggal_cerai` date DEFAULT NULL,
  `family_relationship` varchar(3) DEFAULT NULL,
  `education` varchar(3) DEFAULT NULL,
  `job` varchar(3) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nomor_paspor` varchar(100) DEFAULT NULL,
  `tanggal_berlaku_paspor` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemohon`
--

INSERT INTO `pemohon` (`uid`, `name`, `province`, `regency`, `district`, `village`, `kk`, `nik`, `tanggal_lahir`, `tempat_lahir`, `akta_kelahiran`, `alamat`, `email`, `no_telp`, `jenis_kelamin`, `blood_type`, `agama`, `status_kawin`, `akta_kawin`, `tanggal_kawin`, `akta_cerai`, `tanggal_cerai`, `family_relationship`, `education`, `job`, `nama_ibu`, `nama_ayah`, `nomor_paspor`, `tanggal_berlaku_paspor`, `keterangan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('468239ba-5c5b-4e16-b356-90ae1260084b', 'Mochammad Qaysa Al-Haq', '32', '3204', '3204260', '3204260004', '1234123412341234', '1234123412341234', '2025-05-01', 'Bandung', 'asd akta', 'Margahayu Permai, Blok S10, No 10', 'abumilhan78@gmail.com', '085156283616', 'Laki-laki', '2', '1', '2', NULL, NULL, NULL, NULL, '2', '5', '3', 'asd ibu edit', 'asd ayah edit', NULL, NULL, NULL, '2025-05-16 02:27:59', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-16 07:11:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengakuan_anak_details`
--

CREATE TABLE `pengakuan_anak_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_anak` varchar(255) DEFAULT NULL,
  `tipe` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengakuan_anak_details`
--

INSERT INTO `pengakuan_anak_details` (`uid`, `submission_uid`, `nama_anak`, `tipe`) VALUES
('d127a189-76fe-4b5c-b6b7-98090621d77c', '9ce27308-4db8-49ac-9507-d5799a65df31', 'Indra Pratama Edit', 'pengakuan');

-- --------------------------------------------------------

--
-- Table structure for table `pengangkatan_anak_details`
--

CREATE TABLE `pengangkatan_anak_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_anak` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengangkatan_anak_details`
--

INSERT INTO `pengangkatan_anak_details` (`uid`, `submission_uid`, `nama_anak`) VALUES
('1c4b421d-80b9-4935-afe4-8b7300b97fff', 'f3926883-8b35-44d7-8878-ed6d7c6486d9', 'Indra Pratama Edit');

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_akta_details`
--

CREATE TABLE `perbaikan_akta_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `jenis_akta` varchar(50) DEFAULT NULL,
  `nomor_akta` varchar(100) DEFAULT NULL,
  `jenis_elemen_perbaikan` varchar(100) DEFAULT NULL,
  `data_sebelum` text DEFAULT NULL,
  `data_sesudah` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perbaikan_akta_details`
--

INSERT INTO `perbaikan_akta_details` (`uid`, `submission_uid`, `jenis_akta`, `nomor_akta`, `jenis_elemen_perbaikan`, `data_sebelum`, `data_sesudah`) VALUES
('bef04c2c-05a8-4a09-881e-5384a982d56b', '23f85fef-752a-438c-a659-c5afbf463732', 'akta_kelahiran', 'NOMORAKTA/123/2004', 'nama', 'Mochammad Qaysa Al-Haq', 'Mochammad Robert Maulana');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `uid` varchar(40) NOT NULL,
  `description` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `module_uid` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`uid`, `description`, `name`, `slug`, `module_uid`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('0078d88f-1885-4299-a532-353d22239f2b', 'Pembatalan Perkawinan Delete Permit', 'Pembatalan Perkawinan Delete', 'pembatalan_perkawinan.delete', 'd91f05b6-d2e4-4dc4-ba23-dd0b9aa25335', '2025-05-22 01:29:52', NULL, '2025-05-22 01:29:52', NULL),
('00bd6f1b-fe53-424c-9ea6-c5cc870006da', 'Perbaikan Akta List View Permit', 'Perbaikan Akta List View', 'perbaikan_akta.list', 'a81dcc89-90ca-4bcb-a87b-5c512b573118', '2025-05-21 01:43:40', NULL, '2025-05-21 01:43:40', NULL),
('0843e35a-ed58-4eb1-8eac-4b34e7f52f09', 'Akta Perceraian Create Permit', 'Akta Perceraian Create', 'akta_perceraian.create', 'c9a260f1-235d-4d2a-94b9-72557d42ddd0', '2025-05-22 01:14:52', NULL, '2025-05-22 01:14:52', NULL),
('0d02c8c1-720b-41d5-983f-6f5f91b57d02', 'Pengakuan Anak Delete Permit', 'Pengakuan Anak Delete', 'pengakuan_anak.delete', 'c9a7887e-180e-41b5-a51d-1217e1863017', '2025-05-22 01:24:38', NULL, '2025-05-22 01:24:38', NULL),
('1ac41272-ca54-4ade-9a6c-50875c3498fd', 'Pengakuan Anak Update Permit', 'Pengakuan Anak Update', 'pengakuan_anak.update', 'c9a7887e-180e-41b5-a51d-1217e1863017', '2025-05-22 01:24:13', NULL, '2025-05-22 01:24:13', NULL),
('1e65f1cc-4a52-4a25-949f-18e436984511', 'Module List View Permit', 'Module List View', 'module.list', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:30:45', NULL, '2024-10-17 07:30:45', NULL),
('20a6b097-5227-49c7-813a-1a87556da2fe', 'Perbaikan Akta Create Permit', 'Perbaikan Akta Create', 'perbaikan_akta.create', 'a81dcc89-90ca-4bcb-a87b-5c512b573118', '2025-05-22 01:07:13', NULL, '2025-05-22 01:07:13', NULL),
('27d41c86-3e10-4c7d-92d1-eb31af7f4709', 'Pembatalan Akta Kelahiran Update Permit', 'Pembatalan Akta Kelahiran Update', 'pembatalan_akta_kelahiran.update', '2bdd61da-92ef-4208-af2d-0ea0425efe41', '2025-05-22 01:25:53', NULL, '2025-05-22 01:25:53', NULL),
('2c37e04b-3293-46d9-aee1-6f1ab7c1f40c', 'Mutasi Create Permit', 'Mutasi Create', 'mutasi.create', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:56:06', NULL, '2025-03-03 03:56:06', NULL),
('2c6e01c9-e38b-4a67-9c4d-27301c627ac3', 'Disdukcapil List View Permit', 'Disdukcapil List View', 'disdukcapil.list', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:36:57', NULL, '2025-03-17 04:36:57', NULL),
('30d81e9f-7196-49c9-adbf-ab69396f2c1b', 'Mutasi Delete Permit', 'Mutasi Delete', 'mutasi.delete', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:56:21', NULL, '2025-03-03 03:56:21', NULL),
('34925feb-b789-4a74-8760-f52e103d7074', 'Disdukcapil Update Permit', 'Disdukcapil Update', 'disdukcapil.update', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:38:00', NULL, '2025-03-17 04:38:00', NULL),
('3d12e466-c9f3-4a82-ac6f-84bf0c15a16e', 'Pemohon Create Permit', 'Pemohon Create', 'pemohon.create', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:23:38', NULL, '2025-03-06 06:23:38', NULL),
('3d3a4bda-5b82-4184-8b52-f4858ef39aba', 'Akta Perceraian Delete Permit', 'Akta Perceraian Delete', 'akta_perceraian.delete', 'c9a260f1-235d-4d2a-94b9-72557d42ddd0', '2025-05-22 01:15:10', NULL, '2025-05-22 01:15:10', NULL),
('46d77d3e-690f-4305-bdb5-6f77e4a173c8', 'Usulan Create Permit', 'Usulan Create', 'usulan.create', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:03:18', NULL, '2025-03-10 04:03:18', NULL),
('47ba3e64-04be-4844-a58d-b12edce8a10d', 'Usulan Update Permit', 'Usulan Update', 'usulan.update', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:02:34', NULL, '2025-03-10 04:02:34', NULL),
('47fd87da-5f6b-4caf-8a5f-cdf8dfc28faf', 'Pengakuan Anak List View Permit', 'Pengakuan Anak List View', 'pengakuan_anak.list', 'c9a7887e-180e-41b5-a51d-1217e1863017', '2025-05-22 01:23:39', NULL, '2025-05-22 01:23:39', NULL),
('48c95475-d35a-44c6-8047-9e2ab901ae44', 'Mutasi Update Permit', 'Mutasi Update', 'mutasi.update', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:55:13', NULL, '2025-03-03 03:55:13', NULL),
('498d24cf-602a-4814-9b3f-a59fa12016e7', 'Akta Kematian Delete Permit', 'Akta Kematian Delete', 'akta_kematian.delete', '768899c4-1011-4149-b9ef-a7864b3516d7', '2025-05-22 01:09:41', NULL, '2025-05-22 01:09:41', NULL),
('4aab5536-0cae-4a5c-9b19-d8543fb0a109', 'Akta Perceraian List View Permit', 'Akta Perceraian List View', 'akta_perceraian.list', 'c9a260f1-235d-4d2a-94b9-72557d42ddd0', '2025-05-22 01:14:32', NULL, '2025-05-22 01:14:32', NULL),
('4b4a3ae2-ce54-47a5-b682-0ef8e86ae0f6', 'User Create Permit', 'User Create', 'user.create', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:34:20', NULL, '2024-10-17 07:34:20', NULL),
('54932999-cc85-4131-a857-107714f4edc5', 'Role Update Permit', 'Role Update', 'role.update', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:33:04', NULL, '2024-10-17 07:33:04', NULL),
('55c3c286-5727-44cc-8693-ab369406fd1d', 'User List View Permit', 'User List View', 'user.list', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:33:47', NULL, '2024-10-17 07:33:47', NULL),
('57e808cf-797f-4237-9182-b0ff29cdce7d', 'Akta Perkawinan Create Permit', 'Akta Perkawinan Create', 'akta_perkawinan.create', '34aafef3-453f-40ad-a9a0-851459faccee', '2025-05-22 01:10:39', NULL, '2025-05-22 01:10:39', NULL),
('5851c5a8-325b-434e-a36c-75ba0f2e2bd6', 'Module Create Permit', 'Module Create', 'module.create', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:30:57', NULL, '2024-10-17 07:30:57', NULL),
('64cc6edf-0f5d-422a-9583-325bdca9f369', 'Usulan Approve Disdukcapil', 'Usulan Approve Disdukcapil', 'usulan.approve_disdukcapil', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-12 05:07:51', NULL, '2025-03-12 05:07:51', NULL),
('677e33b8-3229-427a-85dc-ec7862d2de9e', 'Akta Perceraian Update Permit', 'Akta Perceraian Update', 'akta_perceraian.update', 'c9a260f1-235d-4d2a-94b9-72557d42ddd0', '2025-05-22 01:15:23', NULL, '2025-05-22 01:15:23', NULL),
('6e54c5fe-a64f-4fa4-b1b6-0621fa29005b', 'Pemohon Update Permit', 'Pemohon Update', 'pemohon.update', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:24:42', NULL, '2025-03-06 06:24:42', NULL),
('70b30490-2541-404f-a701-acbd75761a35', 'Pembatalan Perkawinan Update Permit', 'Pembatalan Perkawinan Update', 'pembatalan_perkawinan.update', 'd91f05b6-d2e4-4dc4-ba23-dd0b9aa25335', '2025-05-22 01:30:10', NULL, '2025-05-22 01:30:10', NULL),
('7776567b-4902-4324-bab0-51959b7a0d76', 'Usulan Approve Panitra Permit', 'Usulan Approve Panitra', 'usulan.approve_panitra', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-12 05:07:31', NULL, '2025-03-12 05:07:31', NULL),
('79028af7-0408-4ec0-8e9e-22b1b751ae0a', 'Pemohon Delete Permit', 'Pemohon Delete', 'pemohon.delete', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:24:58', NULL, '2025-03-06 06:24:58', NULL),
('7d5b5ed0-38b9-4830-82dd-592f1468e9a6', 'Disdukcapil Create', 'Disdukcapil Create', 'disdukcapil.create', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:38:14', NULL, '2025-03-17 04:38:14', NULL),
('7f214497-e3c8-44d0-86b2-b8cc63260740', 'Profile View Permit', 'Profile View', 'profile.view', 'a9e39221-3834-4e48-88f2-455daae1cf24', '2025-03-06 02:21:07', NULL, '2025-03-06 02:21:07', NULL),
('7f32c8e5-1b4a-450b-bdcb-394b895c9cc7', 'Usulan Delete Permit', 'Usulan Delete', 'usulan.delete', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:03:01', NULL, '2025-03-10 04:03:01', NULL),
('80071e9d-4ec2-4c90-847f-fd404f903abd', 'Perbaikan Akta Delete Permit', 'Perbaikan Akta Delete', 'perbaikan_akta.delete', 'a81dcc89-90ca-4bcb-a87b-5c512b573118', '2025-05-22 01:06:53', NULL, '2025-05-22 01:06:53', NULL),
('883d1b85-9356-4811-a8f4-96a21c67ad2d', 'Pembatalan Perkawinan List View Permit', 'Pembatalan Perkawinan List View', 'pembatalan_perkawinan.list', 'd91f05b6-d2e4-4dc4-ba23-dd0b9aa25335', '2025-05-22 01:29:17', NULL, '2025-05-22 01:29:17', NULL),
('89811ebd-cbf1-4e31-90d3-c2ab5cdfc605', 'Perbaikan Akta Update Permit', 'Perbaikan Akta Update', 'perbaikan_akta.update', 'a81dcc89-90ca-4bcb-a87b-5c512b573118', '2025-05-22 01:06:36', NULL, '2025-05-22 01:06:36', NULL),
('8c5f1f2c-c38a-48e5-9e86-d6c73c753763', 'Pembatalan Perceraian Create Permit', 'Pembatalan Perceraian Create', 'pembatalan_perceraian.create', '5820277c-ee1e-444c-b24b-ef781f54a727', '2025-05-22 01:27:22', NULL, '2025-05-22 01:27:22', NULL),
('8d1a79f2-2c22-4ed2-b193-5cf296ee533e', 'Pengakuan Anak Create Permit', 'Pengakuan Anak Create', 'pengakuan_anak.create', 'c9a7887e-180e-41b5-a51d-1217e1863017', '2025-05-22 01:23:54', NULL, '2025-05-22 01:23:54', NULL),
('8e977c1b-cea8-4a86-b04b-e63d44db6940', 'Pemohon List View Permit', 'Pemohon List View', 'pemohon.list', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:23:54', NULL, '2025-03-06 06:24:13', NULL),
('906bfcbd-b722-481b-b237-2a9056983481', 'Pembatalan Perceraian Update Permit', 'Pembatalan Perceraian Update', 'pembatalan_perceraian.update', '5820277c-ee1e-444c-b24b-ef781f54a727', '2025-05-22 01:27:39', NULL, '2025-05-22 01:27:39', NULL),
('92a2947d-5e7d-4be5-8a28-66cb9501b8dd', 'Akta Kematian List View Permit', 'Akta Kematian List View', 'akta_kematian.list', '768899c4-1011-4149-b9ef-a7864b3516d7', '2025-05-22 01:07:58', NULL, '2025-05-22 01:07:58', NULL),
('96803e1a-f019-4518-a8fb-12334d079922', 'Module Update Permit', 'Module Update', 'module.update', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:31:15', NULL, '2024-10-17 07:31:15', NULL),
('9befd6a1-14f7-4b1a-b559-5745321138e6', 'Pembatalan Perceraian Delete Permit', 'Pembatalan Perceraian Delete', 'pembatalan_perceraian.delete', '5820277c-ee1e-444c-b24b-ef781f54a727', '2025-05-22 01:28:03', NULL, '2025-05-22 01:28:03', NULL),
('9f72d445-d180-46ad-bb4d-fef86e893850', 'Pengangkatan Anak List View Permit', 'Pengangkatan Anak List View', 'pengangkatan_anak.list', '8f791e07-3c28-4745-a517-9fc7316f24b0', '2025-05-22 01:15:53', NULL, '2025-05-22 01:15:53', NULL),
('aa1f7900-4741-4f75-8854-9506cc4bacc9', 'Role Delete Permit', 'Role Delete', 'role.delete', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:33:15', NULL, '2024-10-17 07:33:15', NULL),
('ac83c03e-c664-4f44-9b6e-9cc6a33188c0', 'Pembatalan Akta Kelahiran Create Permit', 'Pembatalan Akta Kelahiran Create', 'pembatalan_akta_kelahiran.create', '2bdd61da-92ef-4208-af2d-0ea0425efe41', '2025-05-22 01:25:32', NULL, '2025-05-22 01:25:32', NULL),
('b35f6f6f-c042-4224-9be9-4e814968f4d6', 'Pengangkatan Anak Update Permit', 'Pengangkatan Anak Update', 'pengangkatan_anak.update', '8f791e07-3c28-4745-a517-9fc7316f24b0', '2025-05-22 01:16:50', NULL, '2025-05-22 01:16:50', NULL),
('bc812bd0-4aee-48e1-8220-a6c9762a2873', 'Pembatalan Perceraian List View Permit', 'Pembatalan Perceraian List View', 'pembatalan_perceraian.list', '5820277c-ee1e-444c-b24b-ef781f54a727', '2025-05-22 01:27:04', NULL, '2025-05-22 01:27:04', NULL),
('be784f9b-9c10-409d-ae84-21f270d680de', 'Module Delete Permit', 'Module Delete', 'module.delete', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:31:53', NULL, '2024-10-17 07:31:53', NULL),
('c4114751-4829-45a2-88f9-96b07f8c3ff8', 'Dashboard View Permit', 'Dashboard View', 'dashboard.view', '42634834-66e0-45bf-8835-99f2004a3b05', '2024-10-17 04:28:31', NULL, '2024-10-17 04:32:15', NULL),
('ca64c1af-3bd1-4804-9181-7f4b325d2368', 'User Delete Permit', 'User Delete', 'user.delete', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:34:46', NULL, '2024-10-17 07:34:46', NULL),
('cab0f9e9-c179-4971-b7bb-44ac99ace796', 'Akta Perkawinan Delete Permit', 'Akta Perkawinan Delete', 'akta_perkawinan.delete', '34aafef3-453f-40ad-a9a0-851459faccee', '2025-05-22 01:11:41', NULL, '2025-05-22 01:11:41', NULL),
('cd0961fd-245d-4016-be6b-8aa556b51cd0', 'Mutasi List View Permit', 'Mutasi List View', 'mutasi.list', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:54:52', NULL, '2025-03-03 03:54:52', NULL),
('cd4b4da7-2d45-4729-b717-785e1cb7ffab', 'Usulan List View Permit', 'Usulan List View', 'usulan.list', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:02:14', NULL, '2025-03-10 04:02:14', NULL),
('cd7e7337-b2f6-4ad2-bd0f-c27d2de0cc96', 'User Update Permit', 'User Update', 'user.update', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:34:36', NULL, '2024-10-17 07:34:36', NULL),
('cec51eea-cfc6-47c4-8c00-b73c11f937cf', 'Akta Kematian Update Permit', 'Akta Kematian Update', 'akta_kematian.update', '768899c4-1011-4149-b9ef-a7864b3516d7', '2025-05-22 01:09:27', NULL, '2025-05-22 01:09:27', NULL),
('d55eefa2-0b1f-4149-a3b9-8f627fb92b38', 'Akta Perkawinan List View Permit', 'Akta Perkawinan List View', 'akta_perkawinan.list', '34aafef3-453f-40ad-a9a0-851459faccee', '2025-05-22 01:10:17', NULL, '2025-05-22 01:10:17', NULL),
('d738a5fe-3249-43a6-aa31-8164153cf708', 'Pembatalan Akta Kelahiran Delete Permit', 'Pembatalan Akta Kelahiran Delete', 'pembatalan_akta_kelahiran.delete', '2bdd61da-92ef-4208-af2d-0ea0425efe41', '2025-05-22 01:26:08', NULL, '2025-05-22 01:26:08', NULL),
('d765dd81-dc3f-4e2b-b147-41cf5632850a', 'Pembatalan Perkawinan Create Permit', 'Pembatalan Perkawinan Create', 'pembatalan_perkawinan.create', 'd91f05b6-d2e4-4dc4-ba23-dd0b9aa25335', '2025-05-22 01:29:35', NULL, '2025-05-22 01:29:35', NULL),
('dae149a1-6d0d-43f9-842e-23ed2c8f6950', 'Akta Perkawinan Update Permit', 'Akta Perkawinan Update', 'akta_perkawinan.update', '34aafef3-453f-40ad-a9a0-851459faccee', '2025-05-22 01:11:08', NULL, '2025-05-22 01:11:08', NULL),
('dc1057fb-e68e-4128-8f2e-2f6a5d756557', 'Pengangkatan Anak Create Permit', 'Pengangkatan Anak Create', 'pengangkatan_anak.create', '8f791e07-3c28-4745-a517-9fc7316f24b0', '2025-05-22 01:16:14', NULL, '2025-05-22 01:16:14', NULL),
('e405f552-9417-449e-8905-6db9e73c75b5', 'Pengangkatan Anak Delete Permit', 'Pengangkatan Anak Delete', 'pengangkatan_anak.delete', '8f791e07-3c28-4745-a517-9fc7316f24b0', '2025-05-22 01:16:30', NULL, '2025-05-22 01:16:30', NULL),
('f2238d3b-9cc8-4cba-ae56-1abe592c990e', 'Role List View Permit', 'Role List View', 'role.list', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:32:37', NULL, '2024-10-17 07:32:37', NULL),
('f2e353ad-d987-42e8-95d9-b084cbaf6acd', 'Akta Kematian Create Permit', 'Akta Kematian Create', 'akta_kematian.create', '768899c4-1011-4149-b9ef-a7864b3516d7', '2025-05-22 01:09:01', NULL, '2025-05-22 01:09:01', NULL),
('f4ab031d-e016-455a-b2fc-e40a8c280c6b', 'Disdukcapil Delete Permit', 'Disdukcapil Delete', 'disdukcapil.delete', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:37:38', NULL, '2025-03-17 04:37:38', NULL),
('f99117e0-ba23-4a96-8aef-b428916a7001', 'Role Create Permit', 'Role Create', 'role.create', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:32:52', NULL, '2024-10-17 07:32:52', NULL),
('fa54349a-60d3-44bf-9784-8cc249f628aa', 'Pembatalan Akta Kelahiran List View Permit', 'Pembatalan Akta Kelahiran List View', 'pembatalan_akta_kelahiran.list', '2bdd61da-92ef-4208-af2d-0ea0425efe41', '2025-05-22 01:25:06', NULL, '2025-05-22 01:25:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `uid` varchar(40) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`uid`, `name`, `slug`, `description`) VALUES
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'Disdukcapil Kota Cimahi', 'disdukcapil_kota_cimahi', 'Operator Disdukcapil Kota Cimahi'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'Disdukcapil Kabupaten Bandung Barat', 'disdukcapil_kabupaten_bandung_barat', 'Disdukcapil Kabupaten Bandung Barat'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'Disdukcapil Kabupaten Bandung', 'disdukcapil_kabupaten_bandung', 'Disdukcapil Kabupaten Bandung'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', 'Admin', 'admin', 'Admin Pengadilan'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'Super Admin', 'super_admin', 'Being a super admin');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_uid` varchar(40) NOT NULL,
  `permission_uid` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_uid`, `permission_uid`) VALUES
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '64cc6edf-0f5d-422a-9583-325bdca9f369'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '64cc6edf-0f5d-422a-9583-325bdca9f369'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '64cc6edf-0f5d-422a-9583-325bdca9f369'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '3d12e466-c9f3-4a82-ac6f-84bf0c15a16e'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '46d77d3e-690f-4305-bdb5-6f77e4a173c8'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '47ba3e64-04be-4844-a58d-b12edce8a10d'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '6e54c5fe-a64f-4fa4-b1b6-0621fa29005b'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '79028af7-0408-4ec0-8e9e-22b1b751ae0a'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '7f32c8e5-1b4a-450b-bdcb-394b895c9cc7'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', '8e977c1b-cea8-4a86-b04b-e63d44db6940'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '0078d88f-1885-4299-a532-353d22239f2b'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '00bd6f1b-fe53-424c-9ea6-c5cc870006da'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '0843e35a-ed58-4eb1-8eac-4b34e7f52f09'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '0d02c8c1-720b-41d5-983f-6f5f91b57d02'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '1ac41272-ca54-4ade-9a6c-50875c3498fd'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '1e65f1cc-4a52-4a25-949f-18e436984511'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '20a6b097-5227-49c7-813a-1a87556da2fe'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '27d41c86-3e10-4c7d-92d1-eb31af7f4709'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '2c37e04b-3293-46d9-aee1-6f1ab7c1f40c'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '2c6e01c9-e38b-4a67-9c4d-27301c627ac3'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '30d81e9f-7196-49c9-adbf-ab69396f2c1b'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '34925feb-b789-4a74-8760-f52e103d7074'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '3d12e466-c9f3-4a82-ac6f-84bf0c15a16e'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '3d3a4bda-5b82-4184-8b52-f4858ef39aba'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '46d77d3e-690f-4305-bdb5-6f77e4a173c8'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '47ba3e64-04be-4844-a58d-b12edce8a10d'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '47fd87da-5f6b-4caf-8a5f-cdf8dfc28faf'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '48c95475-d35a-44c6-8047-9e2ab901ae44'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '498d24cf-602a-4814-9b3f-a59fa12016e7'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '4aab5536-0cae-4a5c-9b19-d8543fb0a109'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '4b4a3ae2-ce54-47a5-b682-0ef8e86ae0f6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '54932999-cc85-4131-a857-107714f4edc5'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '55c3c286-5727-44cc-8693-ab369406fd1d'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '57e808cf-797f-4237-9182-b0ff29cdce7d'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '5851c5a8-325b-434e-a36c-75ba0f2e2bd6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '64cc6edf-0f5d-422a-9583-325bdca9f369'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '677e33b8-3229-427a-85dc-ec7862d2de9e'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '6e54c5fe-a64f-4fa4-b1b6-0621fa29005b'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '70b30490-2541-404f-a701-acbd75761a35'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '7776567b-4902-4324-bab0-51959b7a0d76'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '79028af7-0408-4ec0-8e9e-22b1b751ae0a'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '7d5b5ed0-38b9-4830-82dd-592f1468e9a6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '7f32c8e5-1b4a-450b-bdcb-394b895c9cc7'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '80071e9d-4ec2-4c90-847f-fd404f903abd'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '883d1b85-9356-4811-a8f4-96a21c67ad2d'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '89811ebd-cbf1-4e31-90d3-c2ab5cdfc605'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '8c5f1f2c-c38a-48e5-9e86-d6c73c753763'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '8d1a79f2-2c22-4ed2-b193-5cf296ee533e'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '8e977c1b-cea8-4a86-b04b-e63d44db6940'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '906bfcbd-b722-481b-b237-2a9056983481'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '92a2947d-5e7d-4be5-8a28-66cb9501b8dd'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '96803e1a-f019-4518-a8fb-12334d079922'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '9befd6a1-14f7-4b1a-b559-5745321138e6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '9f72d445-d180-46ad-bb4d-fef86e893850'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'aa1f7900-4741-4f75-8854-9506cc4bacc9'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'ac83c03e-c664-4f44-9b6e-9cc6a33188c0'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'b35f6f6f-c042-4224-9be9-4e814968f4d6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'bc812bd0-4aee-48e1-8220-a6c9762a2873'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'be784f9b-9c10-409d-ae84-21f270d680de'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'ca64c1af-3bd1-4804-9181-7f4b325d2368'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cab0f9e9-c179-4971-b7bb-44ac99ace796'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cd0961fd-245d-4016-be6b-8aa556b51cd0'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cd7e7337-b2f6-4ad2-bd0f-c27d2de0cc96'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cec51eea-cfc6-47c4-8c00-b73c11f937cf'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'd55eefa2-0b1f-4149-a3b9-8f627fb92b38'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'd738a5fe-3249-43a6-aa31-8164153cf708'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'd765dd81-dc3f-4e2b-b147-41cf5632850a'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'dae149a1-6d0d-43f9-842e-23ed2c8f6950'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'dc1057fb-e68e-4128-8f2e-2f6a5d756557'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'e405f552-9417-449e-8905-6db9e73c75b5'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'f2238d3b-9cc8-4cba-ae56-1abe592c990e'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'f2e353ad-d987-42e8-95d9-b084cbaf6acd'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'f4ab031d-e016-455a-b2fc-e40a8c280c6b'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'f99117e0-ba23-4a96-8aef-b428916a7001'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'fa54349a-60d3-44bf-9784-8cc249f628aa');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FObRuouRR6zazM1l5V4r9zyglAOGXF6bkXm5bVNC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjhLMlJXTWFtY0lYemtTd1JjMFlWM3V4M3h0NGZhbklTUTc2WGtlZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731547014),
('I5kGvl0De1BaMuEpRJdYuZ0sLmkzlr1i1F61QwPs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid2hyajN5czdCQThQV2VsN1pDMkJIMjdiNXV0ZllzeDU2dzVWcDFncyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731547233);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `uid` varchar(40) NOT NULL,
  `no_perkara` varchar(40) DEFAULT NULL,
  `submission_type` enum('perbaikan_akta','akta_kematian','akta_perkawinan','akta_perceraian','pengangkatan_anak','pengesahan_anak','pengakuan_anak','pembatalan_akta_kelahiran','pembatalan_perceraian','pembatalan_perkawinan') DEFAULT NULL,
  `pemohon_uid` varchar(40) DEFAULT NULL,
  `disdukcapil_uid` varchar(40) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`uid`, `no_perkara`, `submission_type`, `pemohon_uid`, `disdukcapil_uid`, `status`, `catatan`, `approved_at`, `approved_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('01c5532f-7c29-4f7b-a915-fda98ed4dab7', 'PEMBATALAN.PERKAWINAN/V/2025', 'pembatalan_perkawinan', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"CATATAN PEMBATALAN PERKAWINAN\",\"timestamp\":\"2025-05-27 05:09:12\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"disetujui\",\"timestamp\":\"2025-05-27 12:37:20\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"4\",\"catatan\":\"CATATAN PEMBATALAN PERKAWINAN\",\"timestamp\":\"2025-05-27 05:38:32\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 12:38:44\"}]', '2025-05-27 05:38:44', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 05:09:12', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 05:39:22', 'a9467865-37c1-4104-bd63-b26a33c915db'),
('23f85fef-752a-438c-a659-c5afbf463732', 'NOPER/123/V/ASD', 'perbaikan_akta', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"Ini catatan saya\",\"timestamp\":\"2025-05-23 03:30:08\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak karena ga jelas\",\"timestamp\":\"2025-05-26 09:17:38\"}]', '2025-05-26 02:17:38', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-23 03:30:08', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-26 02:41:09', NULL),
('3812eb78-39e7-492f-bb7b-ee27aec6b620', 'PEMBATALAN.AKTA.KELAHIRAN/V/2025', 'pembatalan_akta_kelahiran', '468239ba-5c5b-4e16-b356-90ae1260084b', '8a7fb795-51c5-49c1-a91d-403f43138a4e', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"CATATAN PEMBATALAN AKTA\",\"timestamp\":\"2025-05-27 04:33:53\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"4\",\"catatan\":\"CATATAN PEMBATALAN AKTA\",\"timestamp\":\"2025-05-27 04:37:19\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"diterima\",\"timestamp\":\"2025-05-27 11:38:38\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 11:39:03\"}]', '2025-05-27 04:39:03', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 04:33:53', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 04:39:15', 'a9467865-37c1-4104-bd63-b26a33c915db'),
('603c7c1a-9b62-430b-9ebb-4397cda9cb16', 'AKTA.KEMATIAN/123/V/ASD', 'akta_kematian', '468239ba-5c5b-4e16-b356-90ae1260084b', '8a7fb795-51c5-49c1-a91d-403f43138a4e', '0', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"ini catatan pertama\",\"timestamp\":\"2025-05-26 07:15:18\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"approve lengkap\",\"timestamp\":\"2025-05-26 14:24:27\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak karena palsu matinya\",\"timestamp\":\"2025-05-26 14:29:28\"}]', '2025-05-26 07:29:28', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-26 07:15:18', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-26 07:29:28', NULL),
('98728984-188a-4041-8831-6c83bfa996d7', 'AKTA.PERCERAIAN/V/2025', 'akta_perceraian', '468239ba-5c5b-4e16-b356-90ae1260084b', '8a7fb795-51c5-49c1-a91d-403f43138a4e', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"ini catatan perceraian\",\"timestamp\":\"2025-05-27 02:36:34\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"diterima\",\"timestamp\":\"2025-05-27 09:38:37\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 09:38:57\"}]', '2025-05-27 02:38:57', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 02:36:34', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 02:39:11', NULL),
('9ce27308-4db8-49ac-9507-d5799a65df31', 'PENGAKUAN.ANAK/V/2025', 'pengakuan_anak', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"ini catatan pengakuan anak\",\"timestamp\":\"2025-05-27 04:04:52\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"4\",\"catatan\":\"ini catatan pengangkatan anak\",\"timestamp\":\"2025-05-27 04:09:10\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"diakui\",\"timestamp\":\"2025-05-27 11:15:11\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 11:15:25\"}]', '2025-05-27 04:15:25', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 04:04:52', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 04:15:34', 'a9467865-37c1-4104-bd63-b26a33c915db'),
('ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', 'AKTA.PERKAWINAN/V/2025', 'akta_perkawinan', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '0', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"ASD\",\"timestamp\":\"2025-05-27 01:24:50\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"Disetujui\",\"timestamp\":\"2025-05-27 08:30:44\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 08:31:52\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 08:32:27\"}]', '2025-05-27 01:32:27', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 01:24:50', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 01:32:27', NULL),
('f3926883-8b35-44d7-8878-ed6d7c6486d9', 'PENGANGKATAN.ANAK/V/2025', 'pengangkatan_anak', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"ini catatan pengangkatan anak\",\"timestamp\":\"2025-05-27 03:24:05\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"4\",\"catatan\":\"ini catatan pengangkatan anak edit\",\"timestamp\":\"2025-05-27 03:27:25\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"diterima\",\"timestamp\":\"2025-05-27 10:28:18\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 10:28:35\"}]', '2025-05-27 03:28:35', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 03:24:05', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 03:30:11', 'a9467865-37c1-4104-bd63-b26a33c915db'),
('ffbfe124-09ca-42b0-991a-b557e413524a', 'PEMBATALAN.PERCERAIAN', 'pembatalan_perceraian', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"CATATAN PEMBATALAN PERCERAIAN\",\"timestamp\":\"2025-05-27 04:56:15\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"4\",\"catatan\":\"CATATAN PEMBATALAN PERCERAIAN\",\"timestamp\":\"2025-05-27 04:59:57\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"2\",\"catatan\":\"disetujui\",\"timestamp\":\"2025-05-27 12:00:51\"},{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"0\",\"catatan\":\"ditolak\",\"timestamp\":\"2025-05-27 12:01:15\"}]', '2025-05-27 05:01:15', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 04:56:15', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-05-27 05:01:20', 'a9467865-37c1-4104-bd63-b26a33c915db');

-- --------------------------------------------------------

--
-- Table structure for table `submission_documents`
--

CREATE TABLE `submission_documents` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_type` varchar(100) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submission_documents`
--

INSERT INTO `submission_documents` (`uid`, `submission_uid`, `document_name`, `document_type`, `file_path`, `uploaded_at`) VALUES
('09701b19-9907-48c0-bf94-2cec1580d99c', '01c5532f-7c29-4f7b-a915-fda98ed4dab7', 'permintaan-akses.pdf', 'kk', '30c21f9ec3ce95f518cd584e509f922e1748322552.pdf', '2025-05-26 22:09:12'),
('0f7d330d-bfec-406a-88fd-ef4e80daf6c6', '9ce27308-4db8-49ac-9507-d5799a65df31', 'akses-operasi.pdf', 'akta_kelahiran', '8189d51cf55bf79f0214f80f8742516f1748318692.pdf', '2025-05-26 21:04:52'),
('1072c9e6-3e69-42a4-a0cd-ae4049738a06', 'ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', 'akses-operasi.pdf', 'penetapan_pengadilan', 'e2ab25249a182d07747ca39aef8a185a1748309090.pdf', '2025-05-26 18:24:50'),
('14b54753-083d-4c55-9f4f-e8950e7fc1f7', 'ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', 'activity-list-komputer.drawio.png', 'ktp_suami', 'bd69b44f3a1ac6b4dd290967e49032711748309090.png', '2025-05-26 18:24:50'),
('17fc11e1-cb1d-4cc9-b5e1-fc1698d5a73c', '603c7c1a-9b62-430b-9ebb-4397cda9cb16', 'activity-show-history-komputer.drawio.png', 'kk_pemohon', 'd5b32d50ea4a23094ae07c69ad1f0df31748243718.png', '2025-05-26 00:15:18'),
('1a364e8f-0707-43e9-9ee1-d5e01f5dd064', 'ffbfe124-09ca-42b0-991a-b557e413524a', 'activity-create-karyawan.drawio.png', 'ktp_pemohon', '535bc2001d708a778c79949fbb3fd3161748321775.png', '2025-05-26 21:56:15'),
('1d0a67d7-d73e-4c83-9c5c-75e72a83f0d7', '9ce27308-4db8-49ac-9507-d5799a65df31', 'permintaan-akses.pdf', 'kk_orangtua', 'ad259815e0f51991326540f2b8c621791748318692.pdf', '2025-05-26 21:04:52'),
('262cfe49-9c07-452b-8b58-6a60909091ef', '603c7c1a-9b62-430b-9ebb-4397cda9cb16', 'WhatsApp Image 2025-04-25 at 1.52.12 PM.jpeg', 'surat_kematian', '92c2a02bd48ee6a1db31e1e7f3777a291748243718.jpeg', '2025-05-26 00:15:18'),
('2c9babb4-b5e7-42e1-9d95-b2b800fbd1eb', '01c5532f-7c29-4f7b-a915-fda98ed4dab7', 'surat_undangan_Irman[1].pdf', 'penetapan_pengadilan', 'e6d110545cf6dc54af1a7e4eca4976eb1748322552.pdf', '2025-05-26 22:09:12'),
('37d20a2e-70f8-4451-bfb2-ada3d361a1f6', 'f3926883-8b35-44d7-8878-ed6d7c6486d9', 'surat_undangan_Irman[1].pdf', 'penetapan_pengadilan', '443b11c491e9f7a4b4079190eecdecba1748316245.pdf', '2025-05-26 20:24:05'),
('43c8847b-7a53-437e-bce4-5a2f0d19d66c', 'ffbfe124-09ca-42b0-991a-b557e413524a', 'akses-operasi.pdf', 'akta_perceraian', '2cf0557b7d9ee19d718d2344cc31eb5e1748321775.pdf', '2025-05-26 21:56:15'),
('44e4f3c3-51fc-4f66-bc9a-63a4431de9ff', '603c7c1a-9b62-430b-9ebb-4397cda9cb16', 'Khilda_j-sika.pdf', 'penetapan_pengadilan', '5a5c0b261111fbf8e864ba3827fa24b21748243718.pdf', '2025-05-26 00:15:18'),
('48e76cea-968e-4b68-84c5-78c5090c695d', '9ce27308-4db8-49ac-9507-d5799a65df31', 'surat_undangan_Irman[1].pdf', 'penetapan_pengadilan', 'f53e37c0e15f4b542fa512bcd2ff0c8c1748318692.pdf', '2025-05-26 21:04:52'),
('4b729b30-2d41-48f8-b3be-d568bf41cb3a', '3812eb78-39e7-492f-bb7b-ee27aec6b620', '20250505145352[250430] sp-akun-gsb-pn-bale-bandung.pdf', 'ktp_pemohon', '2db92d1a1b9987d57d30c795ea8051b41748320433.pdf', '2025-05-26 21:33:53'),
('5137857e-0646-4d3f-b62f-cdcc10f902b0', '23f85fef-752a-438c-a659-c5afbf463732', 'akses-operasi.pdf', 'akta_kelahiran', '6db7082b9afd54cce83d40ae75f5c7601747971008.pdf', '2025-05-22 20:30:08'),
('534a1c14-1612-4fd7-be51-66efac8d2903', '98728984-188a-4041-8831-6c83bfa996d7', 'activity-list-karyawan.drawio.png', 'ktp_istri', '8159c148721b7d12130508d83fac1f151748313394.png', '2025-05-26 19:36:34'),
('5a1e8f35-aa50-45e5-8e22-469d6dfe2047', '98728984-188a-4041-8831-6c83bfa996d7', 'activity-edit-karyawan.drawio.png', 'ktp_suami', '316e70594ed6957cf1521fa7fd08c22f1748313394.png', '2025-05-26 19:36:34'),
('5c0930a6-be24-437c-95df-7d291c736025', '603c7c1a-9b62-430b-9ebb-4397cda9cb16', 'Analisis-Prediksi-BMI-dengan-KNN-Regressor.pdf', 'ktp_pemohon', '37e327e2e73d8f6f1fb558a6cdcc92c01748243718.pdf', '2025-05-26 00:15:18'),
('661e603e-b3ed-4423-824a-8d37760c8c2d', '23f85fef-752a-438c-a659-c5afbf463732', 'surat_undangan_Irman[1].pdf', 'penetapan_pengadilan', 'befb7c5c07d98ef182ddf8bfb6a8eb1e1747971008.pdf', '2025-05-22 20:30:08'),
('68d81bec-5887-4e1c-ac56-af8fc309e534', '3812eb78-39e7-492f-bb7b-ee27aec6b620', 'akses-operasi.pdf', 'akta_kelahiran', '22c1d18ffba6d78da239df67d8220bcb1748320433.pdf', '2025-05-26 21:33:53'),
('6af5e3ae-d81e-4a11-b279-dd8afc6f7c76', 'ffbfe124-09ca-42b0-991a-b557e413524a', 'permintaan-akses.pdf', 'kk', '3768c8824ba35ac663c1e69573c72deb1748321775.pdf', '2025-05-26 21:56:15'),
('83e2a590-654c-4d36-80a8-64955944597d', '3812eb78-39e7-492f-bb7b-ee27aec6b620', 'permintaan-akses.pdf', 'kk', 'b5498d5a6f3034efa16ffc5f515b2ad41748320433.pdf', '2025-05-26 21:33:53'),
('8bcbf1c3-01f6-48e4-aba7-0bb65c396b9f', 'ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', 'activity-login.drawio.png', 'kk_istri', '5988b3c16472fc154348ca9782645e371748309090.png', '2025-05-26 18:24:50'),
('8bffe9fb-293c-47e9-b761-3951033a721b', '98728984-188a-4041-8831-6c83bfa996d7', 'surat_undangan_Irman[1].pdf', 'penetapan_pengadilan', '16edd3fdef52b4da23c7260f6026de5e1748313394.pdf', '2025-05-26 19:36:34'),
('9f65028c-d7fd-4644-ada5-afec30448a75', '98728984-188a-4041-8831-6c83bfa996d7', 'permintaan-akses.pdf', 'kk_suami', 'ce8975e8e685b7860d880264c6f687d91748313394.pdf', '2025-05-26 19:36:34'),
('a6eb27f8-e1fa-48d6-a148-b8e587d20543', '23f85fef-752a-438c-a659-c5afbf463732', 'activity-create-komputer.drawio.png', 'ktp_pemohon', '2126e04e75acb19c15147847203bc7aa1747971008.png', '2025-05-22 20:30:08'),
('a785b99c-1e43-4642-bd41-4a38f0f09a2e', 'f3926883-8b35-44d7-8878-ed6d7c6486d9', '20250505145352[250430] sp-akun-gsb-pn-bale-bandung.pdf', 'ktp_pemohon', 'ffb9b1345a445ca36627cd80e8414dc41748316245.pdf', '2025-05-26 20:24:05'),
('aa33aa21-9ccd-462e-a8df-01af160edb03', '01c5532f-7c29-4f7b-a915-fda98ed4dab7', 'akses-operasi.pdf', 'akta_perkawinan', 'fa9f7de6cad1c1c4fedaf4c370e227541748322552.pdf', '2025-05-26 22:09:12'),
('ba647425-76d6-441a-96fa-7baad700c298', 'f3926883-8b35-44d7-8878-ed6d7c6486d9', 'akses-operasi.pdf', 'akta_kelahiran', 'ac8a5f5ed99d2b3ac2b05b7904987cc21748316245.pdf', '2025-05-26 20:24:05'),
('bc5c5928-0560-4c97-822f-ea4f1c65dbd8', '23f85fef-752a-438c-a659-c5afbf463732', 'permintaan-akses.pdf', 'kk_pemohon', '6dc6065b3160d12b981f947aecc864421747971008.pdf', '2025-05-22 20:30:08'),
('d096d123-5bea-46d4-9c08-7d320f40e286', 'f3926883-8b35-44d7-8878-ed6d7c6486d9', 'permintaan-akses.pdf', 'kk_orang_tua_angkat', '3e49b2c4b42f9ac0650a7b3e6deb03021748316245.pdf', '2025-05-26 20:24:05'),
('d453ee7b-15ab-4f1f-b786-bc3db06a671c', '98728984-188a-4041-8831-6c83bfa996d7', 'akses-operasi.pdf', 'akta_perkawinan', '46749c32b5b4dec9c29f3a28069c09701748313394.pdf', '2025-05-26 19:36:34'),
('d99e1e8a-f5df-4020-acdc-0f6941de60e2', '9ce27308-4db8-49ac-9507-d5799a65df31', 'activity-list-karyawan.drawio.png', 'ktp_pemohon', '25009a588faa38d7346ac0ce047252d51748318692.png', '2025-05-26 21:04:52'),
('ddd9e238-4842-4043-8600-aa835deae1c5', '98728984-188a-4041-8831-6c83bfa996d7', 'activity-delete-komputer.drawio.png', 'kk_istri', '79599ca609d0d7f4b113abb1e106aa391748313394.png', '2025-05-26 19:36:34'),
('e06c79f3-4775-4fcf-8345-48b5bebaa752', 'ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', 'activity-create-komputer.drawio.png', 'kk_suami', '8ffe2efd84f4ee68e0497b9e97b180551748309090.png', '2025-05-26 18:24:50'),
('e35e4415-de53-48bd-8455-9c87e8bc2800', '23f85fef-752a-438c-a659-c5afbf463732', 'activity-list-karyawan.drawio.png', 'keabsahan', 'ff8f92f5b58ea442fde3e13104400b3f1747971008.png', '2025-05-22 20:30:08'),
('e5597f41-87f4-44b1-b8e7-06a764d07a5c', '3812eb78-39e7-492f-bb7b-ee27aec6b620', 'surat_undangan_Irman[1].pdf', 'penetapan_pengadilan', '3a4f7cdd9155b272f39c912210ca213e1748320433.pdf', '2025-05-26 21:33:53'),
('e9da2add-7c51-40a4-af06-5d7278a517a9', 'ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', 'permintaan-akses.pdf', 'pemberkatan_nikah', '50efd9456a7352c648bc4cf6fae2d3d11748309090.pdf', '2025-05-26 18:24:50'),
('ef8f669d-c102-4d6f-91da-8aaaa552559e', '01c5532f-7c29-4f7b-a915-fda98ed4dab7', 'activity-delete-karyawan.drawio.png', 'ktp_pemohon', '04063754ae22579638c83624cd1a9e3d1748322552.png', '2025-05-26 22:09:12'),
('f3b485d5-dcfb-43e5-aec5-4df0e439656f', 'ffbfe124-09ca-42b0-991a-b557e413524a', 'surat_undangan_Irman[1].pdf', 'penetapan_pengadilan', '19767bf4ea95a6b10e3141b6c5963ede1748321775.pdf', '2025-05-26 21:56:15'),
('f6d0b40a-b549-4d94-a49b-759fe90d0bbb', 'ae880c44-6ab2-42b3-83f6-d5fb661ef2a4', 'activity-delete-karyawan.drawio.png', 'ktp_istri', '2aab865a40c6f2ac15ec8ff1751f35441748309090.png', '2025-05-26 18:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(40) NOT NULL,
  `id` bigint(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `ekstansi` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `role_uid` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `id`, `name`, `profile_picture`, `username`, `password`, `nip`, `ekstansi`, `email`, `no_telp`, `active`, `role_uid`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
('37035b97-0a5d-498c-b5f5-c75cee6f106e', 9, 'Operator', NULL, 'operator', '$2y$10$uAkukMsRWh7CjjK/wLo0zOAcIPYw8uEoXTtG2r9CD2I//hyXMDuYy', NULL, NULL, NULL, NULL, 1, '4dd36f70-7a68-44e3-9b43-42d85c179f77', '2025-03-12 00:48:57', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-12 00:48:57', NULL, 0, 'avatar.png', 0, NULL),
('a9467865-37c1-4104-bd63-b26a33c915db', 5, 'Super Admin', NULL, 'admin', '$2y$12$ZW/e7ChmDQjTZ5S04FD9ZuGlnSkFxPcLplevfGfcrIYTLQNDDU6hm', '132456', 'Kantor Pusat Pengadilan', 'admin@email.com', '081212341234', 1, '731f53cb-5c48-4b5f-add6-bb5e6abc9698', '2024-10-18 06:52:21', NULL, '2025-03-12 20:21:34', NULL, 0, 'avatar.png', 0, '#2180f3'),
('a9c33661-69a2-44b6-bf89-28b11ca14994', 7, 'Disdukcapil Kota Cimahi', NULL, 'disdukcapil', '$2y$10$TinXKy.WIvF400cS34SfxOCBvhr9jEynaZCK2Dhz40Ay5Rd1ey6zG', '222222', 'Disdukcapil Kota Cimahi', 'disduk@gmail.com', '081212341234', 1, '03a16a0c-88a3-4811-ae39-9afbd62c238c', '2025-03-12 00:48:15', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-13 20:21:15', NULL, 0, 'avatar.png', 0, NULL),
('b425d1d9-7613-44be-bb87-48fd6d0e2d89', 11, 'Disdukcapil Kabupaten Bandung Barat', NULL, 'disdukcapil2', '$2y$10$AyPaB9WQW7LIpymF1p002eOIy.z0u4tB5RMcTCuo.TNK0xBBPe2tG', '3333333', 'Disdukcapil Kabupaten Bandung Barat', 'disdukkabanbar@gmail.com', '081212341234', 1, '0ed489f1-ba09-401d-a6e7-769755f3d916', '2025-03-13 20:23:09', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-13 20:23:09', NULL, 0, 'avatar.png', 0, NULL),
('c17c84ad-dfd5-40b4-8eb4-94fb5a863187', 10, 'Disdukcapil Kabupaten Bandung', NULL, 'disdukcapil1', '$2y$10$6W7GLw6D/bvfBdF0NkfQHe9bzdUtch7LtA5s86I6hN/YhYa3.KcEG', '1111111', 'Disdukcapil Kabupaten Bandung', 'disdukkaban@gmail.com', '081212341234', 1, '36b9c86f-ec74-4100-b097-7621ac8e15a6', '2025-03-13 20:22:07', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-13 20:22:07', NULL, 0, 'avatar.png', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usulan`
--

CREATE TABLE `usulan` (
  `uid` varchar(40) NOT NULL,
  `no_perkara` varchar(40) DEFAULT NULL,
  `jenis_perkara` varchar(255) DEFAULT NULL,
  `path_ktp` varchar(255) DEFAULT NULL,
  `path_kk` varchar(255) DEFAULT NULL,
  `path_akta` varchar(255) DEFAULT NULL,
  `path_pendukung` varchar(255) DEFAULT NULL,
  `path_penetapan` varchar(255) DEFAULT NULL,
  `path_nikah` varchar(255) DEFAULT NULL,
  `path_pengantar` varchar(255) DEFAULT NULL,
  `delegasi` varchar(255) DEFAULT NULL,
  `pemohon_uid` varchar(40) DEFAULT NULL,
  `disdukcapil_uid` varchar(40) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `is_approve` varchar(1) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akta_kematian_details`
--
ALTER TABLE `akta_kematian_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `akta_perceraian_details`
--
ALTER TABLE `akta_perceraian_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `akta_perkawinan_details`
--
ALTER TABLE `akta_perkawinan_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `disdukcapil`
--
ALTER TABLE `disdukcapil`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembatalan_akta_kelahiran_details`
--
ALTER TABLE `pembatalan_akta_kelahiran_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `pembatalan_perceraian_details`
--
ALTER TABLE `pembatalan_perceraian_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `pembatalan_perkawinan_details`
--
ALTER TABLE `pembatalan_perkawinan_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `pengakuan_anak_details`
--
ALTER TABLE `pengakuan_anak_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `pengangkatan_anak_details`
--
ALTER TABLE `pengangkatan_anak_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `perbaikan_akta_details`
--
ALTER TABLE `perbaikan_akta_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `module_uid` (`module_uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `unique_uid` (`uid`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_uid`,`permission_uid`),
  ADD KEY `permission_uid` (`permission_uid`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `no_perkara` (`no_perkara`),
  ADD KEY `pemohon_uid` (`pemohon_uid`),
  ADD KEY `disdukcapil_uid` (`disdukcapil_uid`);

--
-- Indexes for table `submission_documents`
--
ALTER TABLE `submission_documents`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `unique_uid` (`uid`),
  ADD UNIQUE KEY `user_id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_uid` (`role_uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `no_perkara` (`no_perkara`),
  ADD KEY `pemohon_uid` (`pemohon_uid`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `disdukcapil_uid` (`disdukcapil_uid`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akta_kematian_details`
--
ALTER TABLE `akta_kematian_details`
  ADD CONSTRAINT `akta_kematian_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `akta_perceraian_details`
--
ALTER TABLE `akta_perceraian_details`
  ADD CONSTRAINT `akta_perceraian_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `akta_perkawinan_details`
--
ALTER TABLE `akta_perkawinan_details`
  ADD CONSTRAINT `akta_perkawinan_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `disdukcapil`
--
ALTER TABLE `disdukcapil`
  ADD CONSTRAINT `disdukcapil_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `disdukcapil_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `modules_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`);

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `mutasi_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `pembatalan_akta_kelahiran_details`
--
ALTER TABLE `pembatalan_akta_kelahiran_details`
  ADD CONSTRAINT `pembatalan_akta_kelahiran_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `pembatalan_perceraian_details`
--
ALTER TABLE `pembatalan_perceraian_details`
  ADD CONSTRAINT `pembatalan_perceraian_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `pembatalan_perkawinan_details`
--
ALTER TABLE `pembatalan_perkawinan_details`
  ADD CONSTRAINT `pembatalan_perkawinan_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `pengakuan_anak_details`
--
ALTER TABLE `pengakuan_anak_details`
  ADD CONSTRAINT `pengakuan_anak_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `pengangkatan_anak_details`
--
ALTER TABLE `pengangkatan_anak_details`
  ADD CONSTRAINT `pengangkatan_anak_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `perbaikan_akta_details`
--
ALTER TABLE `perbaikan_akta_details`
  ADD CONSTRAINT `perbaikan_akta_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`module_uid`) REFERENCES `modules` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `permissions_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_uid`) REFERENCES `roles` (`uid`),
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_uid`) REFERENCES `permissions` (`uid`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`pemohon_uid`) REFERENCES `pemohon` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`disdukcapil_uid`) REFERENCES `disdukcapil` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `submission_documents`
--
ALTER TABLE `submission_documents`
  ADD CONSTRAINT `submission_documents_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_uid`) REFERENCES `roles` (`uid`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`);

--
-- Constraints for table `usulan`
--
ALTER TABLE `usulan`
  ADD CONSTRAINT `fk_usulan_disdukcapil` FOREIGN KEY (`disdukcapil_uid`) REFERENCES `disdukcapil` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usulan_ibfk_1` FOREIGN KEY (`pemohon_uid`) REFERENCES `pemohon` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usulan_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usulan_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `usulan_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
