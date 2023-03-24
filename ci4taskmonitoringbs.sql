-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Mar 2023 pada 01.37
-- Versi server: 8.0.30
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4taskmonitoringbs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'abccfbe449faf58cc1ead45126ab914c', '2023-02-11 07:30:44'),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '77d4aba8e52ecb822b0120cc70e020df', '2023-03-09 02:46:53'),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'a33c25d1323dba29d72bac97f5ca1b27', '2023-03-10 08:51:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 2),
(1, 8),
(1, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'jonathanclase4@gmail.com', 1, '2023-02-11 07:31:17', 0),
(2, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-02-11 07:31:55', 0),
(3, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-11 07:33:06', 1),
(4, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-11 07:39:28', 0),
(6, '::1', 'muhammadrizkylubis@students.polmed.ac.id', NULL, '2023-02-16 15:33:03', 0),
(7, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-16 15:33:21', 1),
(8, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-16 15:35:15', 1),
(9, '::1', 'iqbalgobal99@gmail.com', 6, '2023-02-16 16:34:19', 1),
(10, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-02-16 16:35:25', 0),
(11, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-16 16:35:32', 1),
(12, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-16 16:59:07', 1),
(13, '::1', 'iqbalgobal99@gmail.com', 6, '2023-02-16 17:10:56', 1),
(14, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-02-22 13:25:37', 0),
(15, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-22 13:25:48', 1),
(16, '::1', 'iqbalgobal99@gmail.com', NULL, '2023-02-22 13:27:17', 0),
(17, '::1', 'iqbalgobal99@gmail.com', NULL, '2023-02-22 13:27:26', 0),
(18, '::1', 'iqbalgobal99@gmail.com', NULL, '2023-02-22 13:27:41', 0),
(19, '::1', 'iqbalgobal99@gmail.com', 6, '2023-02-22 13:27:53', 1),
(20, '::1', 'iqbalgobal99@gmail.com', 6, '2023-02-22 23:31:57', 1),
(21, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-02-26 17:21:18', 0),
(22, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-02-26 17:21:23', 0),
(23, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-26 17:21:31', 1),
(24, '::1', 'Jonathan', 7, '2023-02-27 02:08:25', 0),
(25, '::1', 'Jonathan', 7, '2023-02-27 02:09:28', 0),
(26, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-02-27 02:09:52', 0),
(27, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-02-27 02:10:08', 0),
(28, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-27 02:10:37', 1),
(29, '::1', 'revand2022@gmail.com', NULL, '2023-02-27 02:25:12', 0),
(30, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-27 02:25:44', 1),
(31, '::1', 'revand2022@gmail.com', NULL, '2023-02-27 04:08:16', 0),
(32, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-27 04:08:38', 1),
(33, '::1', 'revand2022@gmail.com', NULL, '2023-02-27 07:45:57', 0),
(34, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-27 07:46:00', 1),
(35, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-02-28 08:02:57', 1),
(36, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-01 04:23:30', 1),
(37, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-01 08:15:46', 1),
(38, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-01 14:53:55', 1),
(39, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-02 01:33:43', 1),
(40, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-03 01:44:44', 1),
(41, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-03 03:41:54', 1),
(42, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 01:38:53', 1),
(43, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:01:02', 1),
(44, '::1', 'revand2022@gmail.com', NULL, '2023-03-09 02:04:47', 0),
(45, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:04:52', 1),
(46, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:09:19', 1),
(47, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:09:54', 1),
(48, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:10:16', 1),
(49, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:13:01', 1),
(50, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:14:22', 1),
(51, '::1', 'revand2022@gmail.com', NULL, '2023-03-09 02:15:46', 0),
(52, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:15:50', 1),
(53, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:18:41', 1),
(54, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:20:47', 1),
(55, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:27:40', 1),
(56, '::1', 'alvarrodanny@gmail.com', NULL, '2023-03-09 02:47:06', 0),
(57, '::1', 'alvarrodanny@gmail.com', 8, '2023-03-09 02:47:21', 1),
(58, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:49:59', 1),
(59, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:51:29', 1),
(60, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:52:28', 1),
(61, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:56:22', 1),
(62, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-03-09 02:58:58', 0),
(63, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 02:59:17', 1),
(64, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 03:35:03', 1),
(65, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 03:41:15', 1),
(66, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:02:21', 1),
(67, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:35:51', 1),
(68, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:40:30', 1),
(69, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:40:54', 1),
(70, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:41:27', 1),
(71, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:46:18', 1),
(72, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:46:18', 1),
(73, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:47:32', 1),
(74, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 04:50:00', 1),
(75, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 07:13:36', 1),
(76, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 07:18:35', 1),
(77, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 07:56:44', 1),
(78, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 08:00:19', 1),
(79, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 08:00:29', 1),
(80, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-09 08:08:14', 1),
(81, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-10 02:58:40', 1),
(82, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-10 03:06:03', 1),
(83, '::1', 'mrizkylubis2022@gmail.com', 2, '2023-03-10 07:24:31', 1),
(84, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-10 08:51:31', 1),
(85, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-12 09:05:13', 1),
(86, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-12 12:50:24', 1),
(87, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-12 15:15:18', 1),
(88, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-13 01:50:16', 1),
(89, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-13 02:33:31', 1),
(90, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-13 07:37:39', 1),
(91, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-13 14:24:22', 1),
(92, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-14 01:24:43', 1),
(93, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-14 07:23:25', 1),
(94, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-14 08:54:30', 1),
(95, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-14 14:30:27', 1),
(96, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-03-14 15:27:16', 0),
(97, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-03-14 15:27:21', 0),
(98, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-03-14 15:27:28', 0),
(99, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-03-14 15:27:37', 0),
(100, '::1', 'mrizkylubis2022@gmail.com', NULL, '2023-03-14 15:27:52', 0),
(101, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-14 15:28:25', 1),
(102, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-19 16:26:51', 1),
(103, '::1', 'jonathanls19', NULL, '2023-03-20 15:09:42', 0),
(104, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-20 15:09:57', 1),
(105, '::1', 'jonathanlase@students.polmed.ac.id', 9, '2023-03-20 15:21:39', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int NOT NULL,
  `divisi_id` int NOT NULL,
  `nama_bidang` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `divisi_id`, `nama_bidang`, `created_at`, `updated_at`) VALUES
(3, 1, 'OSA', '2023-02-08 13:30:50', '2023-03-13 02:11:36'),
(34, 1, 'PATI', '2023-02-09 15:07:12', '2023-02-26 17:53:12'),
(35, 1, 'PASI', '2023-02-09 15:07:20', '2023-02-09 15:07:20'),
(59, 1, 'IDS', '2023-03-10 09:32:27', '2023-03-10 09:32:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int NOT NULL,
  `nama_cabang` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `kota_provinsi` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `nama_cabang`, `alamat`, `kota_provinsi`, `no_telp`) VALUES
(1, 'Koordinator Medan', 'Jl. Imam Bonjol No.18', 'Medan, Sumatera Utara', '061-4515100 / 415510'),
(2, 'Koordinator Pematang Siantar', 'Jl. Merdeka No.10', 'Pematang Siantar, Sumatera Utara', '0622-21446'),
(3, 'Koordinator Padang Sidimpuan', 'Jl. Merdeka/Ex Sudirman No.1-A', 'Padang Sidempuan, Sumatera Utara', '0634-24074'),
(4, 'Rantau Prapat', 'Jl. Jend.Gatot Subroto No.1-A', 'Labuhan Batu, Sumatera Utara', '0624-21242'),
(5, 'Balige', 'Jl. Sisingamangaraja No. 42', 'Toba Samosir, Sumatera Utara', '0632-21092 / 21358'),
(6, 'Kabanjahe', 'Jl. Kapten Pala Bangun No.3', 'Karo, Sumatera Utara', '0628-20448'),
(7, 'Kisaran', 'Jl. Cokroaminoto No.25 Kisaran', 'Asahan, Sumatera Utara', '0623-41426'),
(8, 'Gunung Sitoli', 'Jl. Moh.Hatta No.1-A', 'Gunung Sitoli, Sumatera Utara', '0639-21454'),
(9, 'Sidikalang', 'Jl. Sisingamangaraja No.172', 'Dairi, Sumatera Utara', '0627-21125'),
(10, 'Sibolga', 'Jl. K.H. Zainul Arifin No.15', 'Kota Sibolga, Sumatera Utara', '0631-21092 / 23939'),
(11, 'Tebing Tinggi', 'Jl. Sutomo No.26', 'Tebing Tinggi, Sumatera Utara', '0621-21540'),
(12, 'Binjai', 'Jl. Sudirman No.16', 'Binjai, Sumatera Utara', '061-8821865'),
(13, 'Tarutung', 'Jl. Balige No.9', 'Tapanuli Utara, Sumatera Utara', '0633-20500 / 21144'),
(14, 'Tanjung Balai', 'Jl. Jend Sudirman No.39-A', 'Tanjung Balai, Sumatera Utara', '0623-92090'),
(15, 'Panyabungan', 'Jl. Wiliam Iskandar No.154-A', 'Mandailing Natal, Sumatera Utara', '0636-20155'),
(16, 'Lubuk Pakam', 'Jl. Kartini No. 2 B Lubuk Pakam', 'Deli Serdang, Sumatera Utara', '061-7954000'),
(17, 'Stabat', 'Jl. Zainul Arifin No. 58', 'Langkat, Sumatera Utara', '061-8910495 / 891045'),
(18, 'Medan Iskandar Muda', 'Jl. Iskandar Muda No.49', 'Medan, Sumatera Utara', '061-4575226 / 457231'),
(19, 'Medan Sukaramai', 'Jl. Denai No. 9 Kel. Tegal Sari I', 'Medan, Sumatera Utara', '061-7321489'),
(20, 'Teluk Dalam', 'Jl. Diponegoro No. 79 Kel. Pasar Teluk Dalam', 'Nias Selatan, Sumatera Utara', '0631-7321302'),
(21, 'Dolok Sanggul', 'Jl. Sentosa No.55 A', 'Humbang Hasundutan, Sumatera Utara', '0633-31368'),
(22, 'Pangururan', 'Jl. Kejaksaan No.40', 'Samosir, Sumatera Utara', '0626-20736'),
(23, 'Sei Rampah', 'Jl. Raya Medan - Tebing Tinggi Km 60 Komp. Asia Bisnis Center No.88 BW', 'Serdang Bedagai, Sumatera Utara', '0621-441638 / 441778'),
(24, 'Tembung', 'Jl. Besar Tembung No.4', 'Deli Serdang, Sumatera Utara', '061-738 2185 / 73803'),
(25, 'Kampung Lalang', 'Jl. Jend.Gatot Subroto No.556 AB', 'Medan, Sumatera Utara', '061-8463523'),
(26, 'Simpang Kwala', 'Jl. Jamin Ginting Km 8.5 Komp. Perumahan Buena Vista ruko No.1 & 2', 'Medan, Sumatera Utara', '061-8364244 / 836456'),
(27, 'Gunung Tua', 'Jl. SM Raja LK I', 'Padang Lawas Utara, Sumatera Utara', '0635-510602'),
(28, 'Melawai', 'Jl. Melawai Raya No.27 A-B Kel. Melawai', 'Jakarta Selatan, DKI Jakarta', '021-7233557'),
(29, 'Pematang Raya', 'Jl. Sutomo Blok A No. 2-3 Nagori Sondiraya', 'Simalungun, Sumatera Utara', '0622-331445 / 331446'),
(30, 'Sibuhuan', 'Jl. K.H. Dewantara No. 99 Lingk. VI Kel. Pasar Sibuhuan', 'Padang Lawas, Sumatera Utara', '0636-421655'),
(31, 'Lima Puluh', 'Jl. Medan - Limapuluh No. 1', 'Batu Bara, Sumatera Utara', '0622-697589 / 96100'),
(32, 'Aek Kanopan', 'Jl. Sudirman No. 142-A Aek Kanopan', 'Labuhan Batu Utara, Sumatera Utara', '0624-92078'),
(33, 'Kota Pinang', 'Jl. Bukit No. 84 D', 'Labuhan Batu Selatan, Sumatera Utara', '0624-496883'),
(34, 'Pandan', 'Jl. Sisingamangaraja No. 18 - A Pandan', 'Tapanuli Tengah, Sumatera Utara', '0631-372305'),
(35, 'Sipirok', 'Jl. Merdeka Sipirok - P Sidempuan No.5 Desa Simaninggir', 'Tapanuli Selatan, Sumatera Utara', '0634-41789'),
(36, 'Batam', 'Jl. T. Umar Kompleks Sulaiman Blok A No. 4 - 5', 'Batam, Kepulauan Riau', '0778-452271');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `divisi`, `timestamp`) VALUES
(1, 'Divisi Teknologi Informasi', '2021-09-26 15:52:14'),
(4, 'Unit Usaha Syariah', '2021-10-02 07:17:09'),
(5, 'Sekretariat Perusahaan', '2021-10-03 09:51:25'),
(6, 'Divisi Sumber Daya Manusia', '2021-10-03 09:51:42'),
(7, 'Divisi Pengawasan', '2021-10-03 09:52:04'),
(8, 'Center of Excellent', '2021-10-03 09:52:18'),
(9, 'Divisi Treasury', '2021-10-03 09:52:41'),
(10, 'Divisi Kredit', '2021-10-03 09:52:56'),
(11, 'Divisi Keuangan dan Perencanaan', '2021-10-03 09:53:56'),
(12, 'Divisi Penyelamatan Kredit', '2021-10-03 09:55:36'),
(13, 'Divisi Ritel', '2021-10-03 09:56:40'),
(14, 'Divisi Dana dan Jasa', '2021-10-03 09:57:16'),
(15, 'Divisi Umum', '2021-10-03 09:57:30'),
(16, 'Divisi Resiko Kredit', '2021-10-03 09:57:41'),
(17, 'Divisi Sentra Operasional', '2021-10-03 09:58:01'),
(18, 'Divisi Kepatuhan', '2021-10-03 09:58:14'),
(20, 'UKK APU-PPT', '2021-10-03 09:58:45'),
(21, 'Divisi Manajemen Resiko', '2021-11-14 12:40:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keterangan_project`
--

CREATE TABLE `keterangan_project` (
  `id_keterangan` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `project_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'App\\Database\\Migrations\\CreateAuthTables', 'default', 'App', 1676099616, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id_project` int NOT NULL,
  `name_project` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang_id` int NOT NULL,
  `nama_pic` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `start` date NOT NULL,
  `deadline` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id_project`, `name_project`, `bidang_id`, `nama_pic`, `start`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
(35, 'Tes', 3, 'Testing', '2023-03-20', '2023-03-31', 0, '2023-03-20 15:10:19', '2023-03-21 01:34:18'),
(36, 'Woi', 3, 'Jose', '2023-03-20', '2023-03-31', 0, '2023-03-20 16:12:10', '2023-03-20 17:43:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(200) NOT NULL,
  `avatar` varchar(200) DEFAULT 'avatar.png',
  `cabang_id` int NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `avatar`, `cabang_id`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'mrizkylubis2022@gmail.com', '2105112030', 'Muhammad Rizky Lubis', 'avatar.png', 1, '$2y$10$fFXrCyqh9KtA9id3OaEqTORBt8vUMjtQAEdbV0vq1a2pm6hdI4/9.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-11 07:29:06', '2023-02-11 07:30:44', NULL),
(8, 'alvarrodanny@gmail.com', 'Madani', '', 'avatar.png', 0, '$2y$10$q7SzVkIVYcoBfVMH96uKEOHOcYITz.EroCKTaJUQGlUuvtbBp8h9e', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-03-09 02:45:15', '2023-03-09 02:46:53', NULL),
(9, 'jonathanlase@students.polmed.ac.id', 'jonathanls19', '', 'avatar.png', 0, '$2y$10$ris68KvMnWfknhXAyAXkqeY2db4T0UzD2Sit.Oqf66zO48sSzLWw6', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-03-10 08:50:41', '2023-03-10 08:51:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `divisi_id` (`divisi_id`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`) USING BTREE;

--
-- Indeks untuk tabel `keterangan_project`
--
ALTER TABLE `keterangan_project`
  ADD PRIMARY KEY (`id_keterangan`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `pic_id` (`bidang_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `keterangan_project`
--
ALTER TABLE `keterangan_project`
  MODIFY `id_keterangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keterangan_project`
--
ALTER TABLE `keterangan_project`
  ADD CONSTRAINT `keterangan_project_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
