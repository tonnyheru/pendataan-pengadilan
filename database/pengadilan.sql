-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2025 pada 03.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

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
-- Struktur dari tabel `akta_kematian_details`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_perceraian_details`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_perkawinan_details`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `disdukcapil`
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
-- Dumping data untuk tabel `disdukcapil`
--

INSERT INTO `disdukcapil` (`uid`, `nama`, `alamat`, `no_telp`, `email`, `cdn_picture`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('1c39d652-51f0-4cf8-b833-791eb6372528', 'Disdukcapil Kabupaten Bandung Barat', 'Komplek Pemda KBB Jl. Raya Padalarang Cisarua Km.2 Ngamprah, Jawa Barat, Indonesia', '08562122827', 'sipalingg340@gmail.com', 'https://raw.githubusercontent.com/tonnyheru/cdn-pengadilan/refs/heads/main/bandung_barat.png', '2025-03-17 05:25:07', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-06-20 08:36:46', NULL),
('8a7fb795-51c5-49c1-a91d-403f43138a4e', 'Disdukcapil Kabupaten Bandung', 'Jl. Raya Soreang, Kabupaten Bandung 40911', '08562122827', 'sipalingg340@gmail.com', 'https://raw.githubusercontent.com/tonnyheru/cdn-pengadilan/refs/heads/main/logo-bandung.png', '2025-03-17 05:24:23', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-06-20 08:36:53', NULL),
('b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', 'Disdukcapil Kota Cimahi', 'Mal Pelayanan Publik Kota Cimahi, Jl. Aruman Lt. 3, Pasirkaliki, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40514', '08562122827', 'sipalingg340@gmail.com', 'https://raw.githubusercontent.com/tonnyheru/cdn-pengadilan/refs/heads/main/logo-cimahi.png', '2025-03-17 05:21:13', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-06-20 08:36:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Dumping data untuk tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `modules`
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
-- Dumping data untuk tabel `modules`
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
-- Struktur dari tabel `mutasi`
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
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembatalan_akta_kelahiran_details`
--

CREATE TABLE `pembatalan_akta_kelahiran_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_pemilik_akta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembatalan_perceraian_details`
--

CREATE TABLE `pembatalan_perceraian_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_suami` varchar(255) DEFAULT NULL,
  `nama_istri` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembatalan_perkawinan_details`
--

CREATE TABLE `pembatalan_perkawinan_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_suami` varchar(255) DEFAULT NULL,
  `nama_istri` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemohon`
--

CREATE TABLE `pemohon` (
  `uid` varchar(40) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `regency` varchar(20) DEFAULT NULL,
  `district` varchar(20) DEFAULT NULL,
  `village` varchar(20) DEFAULT NULL,
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
-- Dumping data untuk tabel `pemohon`
--

INSERT INTO `pemohon` (`uid`, `name`, `province`, `regency`, `district`, `village`, `kk`, `nik`, `tanggal_lahir`, `tempat_lahir`, `akta_kelahiran`, `alamat`, `email`, `no_telp`, `jenis_kelamin`, `blood_type`, `agama`, `status_kawin`, `akta_kawin`, `tanggal_kawin`, `akta_cerai`, `tanggal_cerai`, `family_relationship`, `education`, `job`, `nama_ibu`, `nama_ayah`, `nomor_paspor`, `tanggal_berlaku_paspor`, `keterangan`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('468239ba-5c5b-4e16-b356-90ae1260084b', 'M Tonny Heru Susanto', '32', '32.73', '32.73.25', '32.73.25.1002', '3273022912990013', '3273022912990013', '1999-12-29', 'Bandung', '1234567890', 'Margahayu Permai, Blok S10, No 10', 'tonnyheru29@gmail.com', '08562122827', 'Laki-laki', '2', '1', '1', NULL, NULL, NULL, NULL, '4', '8', '3', 'Nikita', 'Kevin', NULL, NULL, NULL, '2025-05-16 02:27:59', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-07-03 04:01:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengakuan_anak_details`
--

CREATE TABLE `pengakuan_anak_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_anak` varchar(255) DEFAULT NULL,
  `tipe` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengangkatan_anak_details`
--

CREATE TABLE `pengangkatan_anak_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `nama_anak` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan_akta_details`
--

CREATE TABLE `perbaikan_akta_details` (
  `uid` varchar(40) NOT NULL,
  `submission_uid` varchar(40) DEFAULT NULL,
  `jenis_akta` varchar(50) DEFAULT NULL,
  `nomor_akta` varchar(100) DEFAULT NULL,
  `jenis_elemen_perbaikan` varchar(100) DEFAULT NULL,
  `data_sebelum` text DEFAULT NULL,
  `data_sesudah` text DEFAULT NULL,
  `data_subject` text DEFAULT NULL,
  `response_cimahi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perbaikan_akta_details`
--

INSERT INTO `perbaikan_akta_details` (`uid`, `submission_uid`, `jenis_akta`, `nomor_akta`, `jenis_elemen_perbaikan`, `data_sebelum`, `data_sesudah`, `data_subject`, `response_cimahi`) VALUES
('5353ef5a-c4c6-4f23-abe9-400c48f5f341', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'akta_kelahiran', 'akta kelahiran', 'nama', 'tonny', 'rodriguez', '{\"province\":\"32\",\"regency\":\"32.77\",\"district\":\"32.77.02\",\"village\":\"32.77.02.1004\",\"nik\":\"1234123412341234\",\"name\":\"Indra Pratama\",\"gender\":\"1\",\"tempat_lahir\":\"Sleman\",\"tanggal_lahir\":\"2004-07-08\",\"akta_kelahiran\":\"akta kelahiran\",\"blood_type\":\"2\",\"religion\":\"1\",\"status_kawin\":\"1\",\"akta_kawin\":\"akta kawin\",\"tanggal_kawin\":\"2025-07-01\",\"akta_cerai\":\"akta cerai\",\"tanggal_cerai\":\"2025-07-15\",\"family_relationship\":\"1\",\"education\":\"8\",\"job\":\"3\",\"nama_ibu\":\"ibu Indra\",\"nama_ayah\":\"Ayah Indra\",\"nomor_paspor\":\"12331\",\"tanggal_berlaku_paspor\":\"2025-07-23\",\"keterangan\":null}', '{\"data\":{\"id\":null,\"status_code\":\"STATUS_UNCONNECTED\",\"status_name\":\"Koneksi API Tidak Terhubung\",\"notes\":null,\"created_at\":null,\"updated_at\":null}}'),
('c1557bc5-7e1b-4d93-b11c-c32e4fabe892', '0a0579bd-8c6c-4c06-a713-3f68eb87dcdf', 'akta_kelahiran', '12345', 'nama', 'Tonny Heru', 'Spongebob Squarepants', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
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
-- Dumping data untuk tabel `permissions`
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
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `uid` varchar(40) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`uid`, `name`, `slug`, `description`) VALUES
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'Disdukcapil Kota Cimahi', 'disdukcapil_kota_cimahi', 'Operator Disdukcapil Kota Cimahi'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'Disdukcapil Kabupaten Bandung Barat', 'disdukcapil_kabupaten_bandung_barat', 'Disdukcapil Kabupaten Bandung Barat'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'Disdukcapil Kabupaten Bandung', 'disdukcapil_kabupaten_bandung', 'Disdukcapil Kabupaten Bandung'),
('4dd36f70-7a68-44e3-9b43-42d85c179f77', 'Admin', 'admin', 'Admin Pengadilan'),
('731f53cb-5c48-4b5f-add6-bb5e6abc9698', 'Super Admin', 'super_admin', 'Being a super admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_uid` varchar(40) NOT NULL,
  `permission_uid` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role_permissions`
--

INSERT INTO `role_permissions` (`role_uid`, `permission_uid`) VALUES
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '00bd6f1b-fe53-424c-9ea6-c5cc870006da'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '47fd87da-5f6b-4caf-8a5f-cdf8dfc28faf'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '4aab5536-0cae-4a5c-9b19-d8543fb0a109'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '64cc6edf-0f5d-422a-9583-325bdca9f369'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '883d1b85-9356-4811-a8f4-96a21c67ad2d'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '92a2947d-5e7d-4be5-8a28-66cb9501b8dd'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', '9f72d445-d180-46ad-bb4d-fef86e893850'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'bc812bd0-4aee-48e1-8220-a6c9762a2873'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'd55eefa2-0b1f-4149-a3b9-8f627fb92b38'),
('03a16a0c-88a3-4811-ae39-9afbd62c238c', 'fa54349a-60d3-44bf-9784-8cc249f628aa'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '00bd6f1b-fe53-424c-9ea6-c5cc870006da'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '47fd87da-5f6b-4caf-8a5f-cdf8dfc28faf'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '4aab5536-0cae-4a5c-9b19-d8543fb0a109'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '64cc6edf-0f5d-422a-9583-325bdca9f369'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '883d1b85-9356-4811-a8f4-96a21c67ad2d'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '92a2947d-5e7d-4be5-8a28-66cb9501b8dd'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', '9f72d445-d180-46ad-bb4d-fef86e893850'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'bc812bd0-4aee-48e1-8220-a6c9762a2873'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'd55eefa2-0b1f-4149-a3b9-8f627fb92b38'),
('0ed489f1-ba09-401d-a6e7-769755f3d916', 'fa54349a-60d3-44bf-9784-8cc249f628aa'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '00bd6f1b-fe53-424c-9ea6-c5cc870006da'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '47fd87da-5f6b-4caf-8a5f-cdf8dfc28faf'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '4aab5536-0cae-4a5c-9b19-d8543fb0a109'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '64cc6edf-0f5d-422a-9583-325bdca9f369'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '7f214497-e3c8-44d0-86b2-b8cc63260740'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '883d1b85-9356-4811-a8f4-96a21c67ad2d'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '92a2947d-5e7d-4be5-8a28-66cb9501b8dd'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', '9f72d445-d180-46ad-bb4d-fef86e893850'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'bc812bd0-4aee-48e1-8220-a6c9762a2873'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'c4114751-4829-45a2-88f9-96b07f8c3ff8'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'cd4b4da7-2d45-4729-b717-785e1cb7ffab'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'd55eefa2-0b1f-4149-a3b9-8f627fb92b38'),
('36b9c86f-ec74-4100-b097-7621ac8e15a6', 'fa54349a-60d3-44bf-9784-8cc249f628aa'),
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
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FObRuouRR6zazM1l5V4r9zyglAOGXF6bkXm5bVNC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjhLMlJXTWFtY0lYemtTd1JjMFlWM3V4M3h0NGZhbklTUTc2WGtlZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731547014),
('I5kGvl0De1BaMuEpRJdYuZ0sLmkzlr1i1F61QwPs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid2hyajN5czdCQThQV2VsN1pDMkJIMjdiNXV0ZllzeDU2dzVWcDFncyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731547233);

-- --------------------------------------------------------

--
-- Struktur dari tabel `submissions`
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
-- Dumping data untuk tabel `submissions`
--

INSERT INTO `submissions` (`uid`, `no_perkara`, `submission_type`, `pemohon_uid`, `disdukcapil_uid`, `status`, `catatan`, `approved_at`, `approved_by`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('0a0579bd-8c6c-4c06-a713-3f68eb87dcdf', 'NOPER.09/IV/2025', 'perbaikan_akta', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":\"spongbob\",\"timestamp\":\"2025-06-24 15:37:50\"}]', NULL, NULL, '2025-06-24 08:37:50', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-06-24 08:37:50', NULL),
('af06101a-97c9-4d4d-97ed-ab676e68f001', 'PERBAIKANAKTA.092/VII/2025', 'perbaikan_akta', '468239ba-5c5b-4e16-b356-90ae1260084b', 'b7ae3d2f-0243-4a83-9092-8ee3ee36afeb', '1', '[{\"role\":\"Super Admin\",\"name\":\"Super Admin\",\"status\":\"1\",\"catatan\":null,\"timestamp\":\"2025-07-11 14:57:04\"}]', NULL, NULL, '2025-07-11 07:57:04', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-07-11 07:57:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `submission_documents`
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
-- Dumping data untuk tabel `submission_documents`
--

INSERT INTO `submission_documents` (`uid`, `submission_uid`, `document_name`, `document_type`, `file_path`, `uploaded_at`) VALUES
('0578dea6-a8e1-4cc5-aaef-670d794cf95b', '0a0579bd-8c6c-4c06-a713-3f68eb87dcdf', 'penetapan.jpeg', 'penetapan_pengadilan', '7b6f6feeac8941a393b161b5e9f690521750754270.jpeg', '2025-06-24 08:37:50'),
('0b88a141-6916-443e-8ac5-1c9d57647d9a', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'ktp.jpg', 'ktp_pemohon', '9c19fe3641d12c6aad8bcc3c335627d61752220624.jpg', '2025-07-11 07:57:04'),
('141ed789-2f74-4b86-82f9-d600a5c1f5db', '0a0579bd-8c6c-4c06-a713-3f68eb87dcdf', 'kk.jpg', 'kk_pemohon', '9b5e188f2e5f431f061077d24d1932f31750754270.jpg', '2025-06-24 08:37:50'),
('1c000615-02b6-4e14-8365-8d0096ab677c', '0a0579bd-8c6c-4c06-a713-3f68eb87dcdf', 'akta.jpg', 'akta_kelahiran', '73d38f911a61bd6377fb0360a50b9d461750754270.jpg', '2025-06-24 08:37:50'),
('2b2fe66c-258d-45d6-8688-a0a088a31d2d', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'penetapan.jpeg', 'dokumen_tambahan', 'f0ed8568658de0c2e2a630fe629142921752220624.jpeg', '2025-07-11 07:57:04'),
('3550965d-cee8-43f9-8d8b-6b835dfccef5', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'akta.jpg', 'keabsahan', '85591b71194765c104d07ae5942a7f2d1752220624.jpg', '2025-07-11 07:57:04'),
('40e1bfb1-a89d-490a-a2ec-c9536b9ccaf3', '0a0579bd-8c6c-4c06-a713-3f68eb87dcdf', 'ktp.jpg', 'ktp_pemohon', '14aaec079f1dc7f4f0e660da43f1752c1750754270.jpg', '2025-06-24 08:37:50'),
('71f42ca3-44bc-43f2-9fea-986b858716dd', '0a0579bd-8c6c-4c06-a713-3f68eb87dcdf', 'surat pengantar.jpeg', 'keabsahan', 'b7ac3eac57eeb4d6af8c8f85be85dff31750754270.jpeg', '2025-06-24 08:37:50'),
('7e298445-f5c5-44c8-acf5-2b92c275a019', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'penetapan.jpeg', 'penetapan_pengadilan', '36cf90e1ef43c8cf22b5233b12d266be1752220624.jpeg', '2025-07-11 07:57:04'),
('80d7bfe2-7450-46f1-8d88-2eae02a9432f', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'surat nikah.jpeg', 'akta_perkawinan', '270373080ebe893d185f5178e33717ad1752220624.jpeg', '2025-07-11 07:57:04'),
('84ab7daa-57aa-4dc0-90d6-9842bc92062a', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'dokumen pendukung.jpg', 'keterangan_medis', '12d8f21209086722b41ed0288dd35dc21752220624.jpg', '2025-07-11 07:57:04'),
('886d1b69-ccdc-45e6-8f5d-5392dc2ca505', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'kk.jpg', 'sptjm', '8c453b22b33c66ab6604c9724eba6d531752220624.jpg', '2025-07-11 07:57:04'),
('aeca1291-33c8-4606-a601-28b36307b43f', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'penetapan.jpeg', 'ijazah', '38c4d8d7e648c6a932763b93f9f04da81752220624.jpeg', '2025-07-11 07:57:04'),
('b8e3600a-cd67-4caa-9250-04b44ea2fa72', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'surat pengantar.jpeg', 'akta_perceraian', '379adaf8aa5d27d754e16b1cd84620201752220624.jpeg', '2025-07-11 07:57:04'),
('bb52e690-2308-42e5-8c50-0eb890042f0b', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'surat nikah.jpeg', 'keterangan_status_pekerjaan', '21ac44ce1306e5b020683edd88c6bfe71752220624.jpeg', '2025-07-11 07:57:04'),
('c37e53af-1087-48a8-a113-59509da108e9', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'surat pengantar.jpeg', 'paspor', 'a065e9cb7dbfe51924811239ecfb400a1752220624.jpeg', '2025-07-11 07:57:04'),
('eb888d24-843e-4ab2-ba88-d04858c29a1b', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'kk.jpg', 'kk_pemohon', '688a1925277917d53af139d4a386dee41752220624.jpg', '2025-07-11 07:57:04'),
('eca9acf3-feba-41a9-9435-9643c694829d', 'af06101a-97c9-4d4d-97ed-ab676e68f001', 'akta.jpg', 'akta_kelahiran', 'f7fb45fc614ecc758981bee57fd015741752220624.jpg', '2025-07-11 07:57:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`uid`, `id`, `name`, `profile_picture`, `username`, `password`, `nip`, `ekstansi`, `email`, `no_telp`, `active`, `role_uid`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
('37035b97-0a5d-498c-b5f5-c75cee6f106e', 9, 'Operator', NULL, 'operator', '$2y$10$uAkukMsRWh7CjjK/wLo0zOAcIPYw8uEoXTtG2r9CD2I//hyXMDuYy', NULL, NULL, NULL, NULL, 1, '4dd36f70-7a68-44e3-9b43-42d85c179f77', '2025-03-12 00:48:57', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-12 00:48:57', NULL, 0, 'avatar.png', 0, NULL),
('a9467865-37c1-4104-bd63-b26a33c915db', 5, 'Super Admin', NULL, 'admin', '$2y$12$ZW/e7ChmDQjTZ5S04FD9ZuGlnSkFxPcLplevfGfcrIYTLQNDDU6hm', '132456', 'Kantor Pusat Pengadilan', 'admin@email.com', '081212341234', 1, '731f53cb-5c48-4b5f-add6-bb5e6abc9698', '2024-10-18 06:52:21', NULL, '2025-03-12 20:21:34', NULL, 0, 'avatar.png', 0, '#2180f3'),
('a9c33661-69a2-44b6-bf89-28b11ca14994', 7, 'Disdukcapil Kota Cimahi', NULL, 'disdukcapil', '$2y$10$TinXKy.WIvF400cS34SfxOCBvhr9jEynaZCK2Dhz40Ay5Rd1ey6zG', '222222', 'Disdukcapil Kota Cimahi', 'disduk@gmail.com', '081212341234', 1, '03a16a0c-88a3-4811-ae39-9afbd62c238c', '2025-03-12 00:48:15', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-13 20:21:15', NULL, 0, 'avatar.png', 0, NULL),
('b425d1d9-7613-44be-bb87-48fd6d0e2d89', 11, 'Disdukcapil Kabupaten Bandung Barat', NULL, 'disdukcapil2', '$2y$10$AyPaB9WQW7LIpymF1p002eOIy.z0u4tB5RMcTCuo.TNK0xBBPe2tG', '3333333', 'Disdukcapil Kabupaten Bandung Barat', 'disdukkabanbar@gmail.com', '081212341234', 1, '0ed489f1-ba09-401d-a6e7-769755f3d916', '2025-03-13 20:23:09', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-13 20:23:09', NULL, 0, 'avatar.png', 0, NULL),
('c17c84ad-dfd5-40b4-8eb4-94fb5a863187', 10, 'Disdukcapil Kabupaten Bandung', NULL, 'disdukcapil1', '$2y$10$6W7GLw6D/bvfBdF0NkfQHe9bzdUtch7LtA5s86I6hN/YhYa3.KcEG', '1111111', 'Disdukcapil Kabupaten Bandung', 'disdukkaban@gmail.com', '081212341234', 1, '36b9c86f-ec74-4100-b097-7621ac8e15a6', '2025-03-13 20:22:07', 'a9467865-37c1-4104-bd63-b26a33c915db', '2025-03-13 20:22:07', NULL, 0, 'avatar.png', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan`
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
-- Indeks untuk tabel `akta_kematian_details`
--
ALTER TABLE `akta_kematian_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `akta_perceraian_details`
--
ALTER TABLE `akta_perceraian_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `akta_perkawinan_details`
--
ALTER TABLE `akta_perkawinan_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `disdukcapil`
--
ALTER TABLE `disdukcapil`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pembatalan_akta_kelahiran_details`
--
ALTER TABLE `pembatalan_akta_kelahiran_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `pembatalan_perceraian_details`
--
ALTER TABLE `pembatalan_perceraian_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `pembatalan_perkawinan_details`
--
ALTER TABLE `pembatalan_perkawinan_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`uid`);

--
-- Indeks untuk tabel `pengakuan_anak_details`
--
ALTER TABLE `pengakuan_anak_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `pengangkatan_anak_details`
--
ALTER TABLE `pengangkatan_anak_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `perbaikan_akta_details`
--
ALTER TABLE `perbaikan_akta_details`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `module_uid` (`module_uid`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `unique_uid` (`uid`);

--
-- Indeks untuk tabel `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_uid`,`permission_uid`),
  ADD KEY `permission_uid` (`permission_uid`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `no_perkara` (`no_perkara`),
  ADD KEY `pemohon_uid` (`pemohon_uid`),
  ADD KEY `disdukcapil_uid` (`disdukcapil_uid`);

--
-- Indeks untuk tabel `submission_documents`
--
ALTER TABLE `submission_documents`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `submission_uid` (`submission_uid`);

--
-- Indeks untuk tabel `users`
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
-- Indeks untuk tabel `usulan`
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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akta_kematian_details`
--
ALTER TABLE `akta_kematian_details`
  ADD CONSTRAINT `akta_kematian_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `akta_perceraian_details`
--
ALTER TABLE `akta_perceraian_details`
  ADD CONSTRAINT `akta_perceraian_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `akta_perkawinan_details`
--
ALTER TABLE `akta_perkawinan_details`
  ADD CONSTRAINT `akta_perkawinan_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `disdukcapil`
--
ALTER TABLE `disdukcapil`
  ADD CONSTRAINT `disdukcapil_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `disdukcapil_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `modules_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`);

--
-- Ketidakleluasaan untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `mutasi_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembatalan_akta_kelahiran_details`
--
ALTER TABLE `pembatalan_akta_kelahiran_details`
  ADD CONSTRAINT `pembatalan_akta_kelahiran_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembatalan_perceraian_details`
--
ALTER TABLE `pembatalan_perceraian_details`
  ADD CONSTRAINT `pembatalan_perceraian_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembatalan_perkawinan_details`
--
ALTER TABLE `pembatalan_perkawinan_details`
  ADD CONSTRAINT `pembatalan_perkawinan_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengakuan_anak_details`
--
ALTER TABLE `pengakuan_anak_details`
  ADD CONSTRAINT `pengakuan_anak_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengangkatan_anak_details`
--
ALTER TABLE `pengangkatan_anak_details`
  ADD CONSTRAINT `pengangkatan_anak_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `perbaikan_akta_details`
--
ALTER TABLE `perbaikan_akta_details`
  ADD CONSTRAINT `perbaikan_akta_details_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`module_uid`) REFERENCES `modules` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `permissions_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`);

--
-- Ketidakleluasaan untuk tabel `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_uid`) REFERENCES `roles` (`uid`),
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_uid`) REFERENCES `permissions` (`uid`);

--
-- Ketidakleluasaan untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`pemohon_uid`) REFERENCES `pemohon` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`disdukcapil_uid`) REFERENCES `disdukcapil` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `submission_documents`
--
ALTER TABLE `submission_documents`
  ADD CONSTRAINT `submission_documents_ibfk_1` FOREIGN KEY (`submission_uid`) REFERENCES `submissions` (`uid`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_uid`) REFERENCES `roles` (`uid`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`uid`);

--
-- Ketidakleluasaan untuk tabel `usulan`
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
