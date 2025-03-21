-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 10:01 AM
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
('34274232-b71a-4fd6-b871-da859a2cffe8', 'Menu Usulan', 'Usulan', '2025-03-10 04:01:35', NULL, '2025-03-10 04:01:35', NULL),
('3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', 'User', 'User', '2024-10-17 07:29:49', NULL, '2024-10-17 07:29:49', NULL),
('42634834-66e0-45bf-8835-99f2004a3b05', 'Dashboard', 'Dashboard', '2024-10-17 03:56:14', NULL, '2024-10-17 03:57:23', NULL),
('78eefbc3-b248-4d7c-a355-a83ed0103c4b', 'Module', 'Module', '2024-10-17 07:29:38', NULL, '2024-10-17 07:29:38', NULL),
('8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', 'Disdukcapil', 'Disdukcapil', '2025-03-17 04:36:33', NULL, '2025-03-17 04:36:33', NULL),
('98bb7a50-9edb-4356-90c8-409cf75cd962', 'Pemohon', 'Pemohon', '2025-03-06 05:40:47', NULL, '2025-03-06 06:23:17', NULL),
('a9e39221-3834-4e48-88f2-455daae1cf24', 'Profile', 'Profile', '2025-03-06 02:20:40', NULL, '2025-03-06 02:20:40', NULL);

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
-- Table structure for table `pemohon`
--

CREATE TABLE `pemohon` (
  `uid` varchar(40) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('PRIA','WANITA') DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(40) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemohon`
--

INSERT INTO `pemohon` (`uid`, `name`, `nik`, `tanggal_lahir`, `tempat_lahir`, `alamat`, `email`, `no_telp`, `jenis_kelamin`, `agama`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('96a50cef-981f-40ff-bbc5-543354570163', 'Rifky Pratama', '0987098709870987', '2004-03-31', 'Sleman', 'Dekat UNIBI, kampus tercinta', 'abumilhan78@gmail.com', '081212341234', 'PRIA', 'islam', 'k', '2025-03-11 02:38:28', NULL, '2025-03-17 07:17:06', NULL),
('c7c18c4d-b8bc-4ff5-8215-fb549cd9fa92', 'Indra Pratama', '3273022912990013', '1999-03-18', 'bandung', 'Jl. Logam', 'kevinbramasta321@gmail.com', '08562122827', 'PRIA', 'islam', 'bk', '2025-03-18 03:05:12', NULL, '2025-03-18 03:05:12', NULL),
('d825dab2-809b-4361-865a-ca190a62d7ff', 'Tonny Heru Susanto', '1234123412341234', '2001-03-01', 'Bandung', 'disini', 'tonnyheru29@gmail.com', '081212341234', 'PRIA', 'kristen', 'ch', '2025-03-10 01:10:45', NULL, '2025-03-13 08:00:08', NULL);

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
('1e65f1cc-4a52-4a25-949f-18e436984511', 'Module List View Permit', 'Module List View', 'module.list', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:30:45', NULL, '2024-10-17 07:30:45', NULL),
('2c37e04b-3293-46d9-aee1-6f1ab7c1f40c', 'Mutasi Create Permit', 'Mutasi Create', 'mutasi.create', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:56:06', NULL, '2025-03-03 03:56:06', NULL),
('2c6e01c9-e38b-4a67-9c4d-27301c627ac3', 'Disdukcapil List View Permit', 'Disdukcapil List View', 'disdukcapil.list', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:36:57', NULL, '2025-03-17 04:36:57', NULL),
('30d81e9f-7196-49c9-adbf-ab69396f2c1b', 'Mutasi Delete Permit', 'Mutasi Delete', 'mutasi.delete', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:56:21', NULL, '2025-03-03 03:56:21', NULL),
('34925feb-b789-4a74-8760-f52e103d7074', 'Disdukcapil Update Permit', 'Disdukcapil Update', 'disdukcapil.update', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:38:00', NULL, '2025-03-17 04:38:00', NULL),
('3d12e466-c9f3-4a82-ac6f-84bf0c15a16e', 'Pemohon Create Permit', 'Pemohon Create', 'pemohon.create', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:23:38', NULL, '2025-03-06 06:23:38', NULL),
('46d77d3e-690f-4305-bdb5-6f77e4a173c8', 'Usulan Create Permit', 'Usulan Create', 'usulan.create', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:03:18', NULL, '2025-03-10 04:03:18', NULL),
('47ba3e64-04be-4844-a58d-b12edce8a10d', 'Usulan Update Permit', 'Usulan Update', 'usulan.update', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:02:34', NULL, '2025-03-10 04:02:34', NULL),
('48c95475-d35a-44c6-8047-9e2ab901ae44', 'Mutasi Update Permit', 'Mutasi Update', 'mutasi.update', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:55:13', NULL, '2025-03-03 03:55:13', NULL),
('4b4a3ae2-ce54-47a5-b682-0ef8e86ae0f6', 'User Create Permit', 'User Create', 'user.create', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:34:20', NULL, '2024-10-17 07:34:20', NULL),
('54932999-cc85-4131-a857-107714f4edc5', 'Role Update Permit', 'Role Update', 'role.update', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:33:04', NULL, '2024-10-17 07:33:04', NULL),
('55c3c286-5727-44cc-8693-ab369406fd1d', 'User List View Permit', 'User List View', 'user.list', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:33:47', NULL, '2024-10-17 07:33:47', NULL),
('5851c5a8-325b-434e-a36c-75ba0f2e2bd6', 'Module Create Permit', 'Module Create', 'module.create', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:30:57', NULL, '2024-10-17 07:30:57', NULL),
('64cc6edf-0f5d-422a-9583-325bdca9f369', 'Usulan Approve Disdukcapil', 'Usulan Approve Disdukcapil', 'usulan.approve_disdukcapil', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-12 05:07:51', NULL, '2025-03-12 05:07:51', NULL),
('6e54c5fe-a64f-4fa4-b1b6-0621fa29005b', 'Pemohon Update Permit', 'Pemohon Update', 'pemohon.update', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:24:42', NULL, '2025-03-06 06:24:42', NULL),
('7776567b-4902-4324-bab0-51959b7a0d76', 'Usulan Approve Panitra Permit', 'Usulan Approve Panitra', 'usulan.approve_panitra', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-12 05:07:31', NULL, '2025-03-12 05:07:31', NULL),
('79028af7-0408-4ec0-8e9e-22b1b751ae0a', 'Pemohon Delete Permit', 'Pemohon Delete', 'pemohon.delete', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:24:58', NULL, '2025-03-06 06:24:58', NULL),
('7d5b5ed0-38b9-4830-82dd-592f1468e9a6', 'Disdukcapil Create', 'Disdukcapil Create', 'disdukcapil.create', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:38:14', NULL, '2025-03-17 04:38:14', NULL),
('7f214497-e3c8-44d0-86b2-b8cc63260740', 'Profile View Permit', 'Profile View', 'profile.view', 'a9e39221-3834-4e48-88f2-455daae1cf24', '2025-03-06 02:21:07', NULL, '2025-03-06 02:21:07', NULL),
('7f32c8e5-1b4a-450b-bdcb-394b895c9cc7', 'Usulan Delete Permit', 'Usulan Delete', 'usulan.delete', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:03:01', NULL, '2025-03-10 04:03:01', NULL),
('8e977c1b-cea8-4a86-b04b-e63d44db6940', 'Pemohon List View Permit', 'Pemohon List View', 'pemohon.list', '98bb7a50-9edb-4356-90c8-409cf75cd962', '2025-03-06 06:23:54', NULL, '2025-03-06 06:24:13', NULL),
('96803e1a-f019-4518-a8fb-12334d079922', 'Module Update Permit', 'Module Update', 'module.update', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:31:15', NULL, '2024-10-17 07:31:15', NULL),
('aa1f7900-4741-4f75-8854-9506cc4bacc9', 'Role Delete Permit', 'Role Delete', 'role.delete', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:33:15', NULL, '2024-10-17 07:33:15', NULL),
('be784f9b-9c10-409d-ae84-21f270d680de', 'Module Delete Permit', 'Module Delete', 'module.delete', '78eefbc3-b248-4d7c-a355-a83ed0103c4b', '2024-10-17 07:31:53', NULL, '2024-10-17 07:31:53', NULL),
('c4114751-4829-45a2-88f9-96b07f8c3ff8', 'Dashboard View Permit', 'Dashboard View', 'dashboard.view', '42634834-66e0-45bf-8835-99f2004a3b05', '2024-10-17 04:28:31', NULL, '2024-10-17 04:32:15', NULL),
('ca64c1af-3bd1-4804-9181-7f4b325d2368', 'User Delete Permit', 'User Delete', 'user.delete', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:34:46', NULL, '2024-10-17 07:34:46', NULL),
('cd0961fd-245d-4016-be6b-8aa556b51cd0', 'Mutasi List View Permit', 'Mutasi List View', 'mutasi.list', '100085fd-e69b-4db4-9f12-a2a33e118214', '2025-03-03 03:54:52', NULL, '2025-03-03 03:54:52', NULL),
('cd4b4da7-2d45-4729-b717-785e1cb7ffab', 'Usulan List View Permit', 'Usulan List View', 'usulan.list', '34274232-b71a-4fd6-b871-da859a2cffe8', '2025-03-10 04:02:14', NULL, '2025-03-10 04:02:14', NULL),
('cd7e7337-b2f6-4ad2-bd0f-c27d2de0cc96', 'User Update Permit', 'User Update', 'user.update', '3cf3d831-0a27-4c1d-8cce-cd7a6649ecd7', '2024-10-17 07:34:36', NULL, '2024-10-17 07:34:36', NULL),
('f2238d3b-9cc8-4cba-ae56-1abe592c990e', 'Role List View Permit', 'Role List View', 'role.list', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:32:37', NULL, '2024-10-17 07:32:37', NULL),
('f4ab031d-e016-455a-b2fc-e40a8c280c6b', 'Disdukcapil Delete Permit', 'Disdukcapil Delete', 'disdukcapil.delete', '8bf009a8-6326-4f93-8bdb-fb3cc475e7ba', '2025-03-17 04:37:38', NULL, '2025-03-17 04:37:38', NULL),
('f99117e0-ba23-4a96-8aef-b428916a7001', 'Role Create Permit', 'Role Create', 'role.create', '10aa1d11-270c-47ab-8c03-d20bc20225e8', '2024-10-17 07:32:52', NULL, '2024-10-17 07:32:52', NULL);

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
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '1e65f1cc-4a52-4a25-949f-18e436984511'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '2c37e04b-3293-46d9-aee1-6f1ab7c1f40c'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '2c6e01c9-e38b-4a67-9c4d-27301c627ac3'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '30d81e9f-7196-49c9-adbf-ab69396f2c1b'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '34925feb-b789-4a74-8760-f52e103d7074'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '3d12e466-c9f3-4a82-ac6f-84bf0c15a16e'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '46d77d3e-690f-4305-bdb5-6f77e4a173c8'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '47ba3e64-04be-4844-a58d-b12edce8a10d'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '48c95475-d35a-44c6-8047-9e2ab901ae44'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '4b4a3ae2-ce54-47a5-b682-0ef8e86ae0f6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '54932999-cc85-4131-a857-107714f4edc5'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '55c3c286-5727-44cc-8693-ab369406fd1d'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '5851c5a8-325b-434e-a36c-75ba0f2e2bd6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '6e54c5fe-a64f-4fa4-b1b6-0621fa29005b'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '79028af7-0408-4ec0-8e9e-22b1b751ae0a'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '7d5b5ed0-38b9-4830-82dd-592f1468e9a6'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '7f32c8e5-1b4a-450b-bdcb-394b895c9cc7'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '8e977c1b-cea8-4a86-b04b-e63d44db6940'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', '96803e1a-f019-4518-a8fb-12334d079922'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'aa1f7900-4741-4f75-8854-9506cc4bacc9'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'be784f9b-9c10-409d-ae84-21f270d680de'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'ca64c1af-3bd1-4804-9181-7f4b325d2368'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cd0961fd-245d-4016-be6b-8aa556b51cd0'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'cd7e7337-b2f6-4ad2-bd0f-c27d2de0cc96'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'f2238d3b-9cc8-4cba-ae56-1abe592c990e'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'f4ab031d-e016-455a-b2fc-e40a8c280c6b'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'f99117e0-ba23-4a96-8aef-b428916a7001');

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
-- Dumping data for table `usulan`
--

INSERT INTO `usulan` (`uid`, `no_perkara`, `jenis_perkara`, `path_ktp`, `path_kk`, `path_akta`, `path_pendukung`, `path_penetapan`, `path_nikah`, `path_pengantar`, `delegasi`, `pemohon_uid`, `disdukcapil_uid`, `catatan`, `is_approve`, `approved_at`, `approved_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('5efbda93-4e7d-462b-acfb-1afc69899f71', 'PERKARA KE 1', 'ASUSILA', 'f909c76ed015b1d419b3f5fa9780ecc91742449523_pattern-dark.png', '5a6103b35bd3d2f9b1642c97583171201742449523_pattern.png', 'f909c76ed015b1d419b3f5fa9780ecc91742449523_Screenshot 2025-03-11 151342.png', 'f909c76ed015b1d419b3f5fa9780ecc91742449523_picture-1585152466.jpg', 'f909c76ed015b1d419b3f5fa9780ecc91742449523_flowchart_perubahan nama (1).png', 'f909c76ed015b1d419b3f5fa9780ecc91742449523_terbaru (1).png', 'f909c76ed015b1d419b3f5fa9780ecc91742449523_coret.png', '1c39d652-51f0-4cf8-b833-791eb6372528', '96a50cef-981f-40ff-bbc5-543354570163', '1c39d652-51f0-4cf8-b833-791eb6372528', '[{\"role\":\"Disdukcapil Kabupaten Bandung Barat\",\"name\":\"Disdukcapil Kabupaten Bandung Barat\",\"status\":\"0\",\"catatan\":\"catatan ditolak\",\"timestamp\":\"2025-03-21 15:37:57\"}]', '0', '2025-03-21 08:37:57', 'b425d1d9-7613-44be-bb87-48fd6d0e2d89', '2025-03-20 05:45:23', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-21 08:37:57', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`uid`);

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
