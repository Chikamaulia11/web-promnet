-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 04:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `kategori_id`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Lampu', 1, 'Lampu untuk menerangi ruangan atau tempat outdoor.', '2026-01-01 07:25:06', '2026-01-02 19:13:29'),
(2, 'Meja', 2, 'Menyediakan beberapa bentuk meja.', '2026-01-02 20:50:44', '2026-01-02 20:50:44'),
(3, 'Vas Bunga', 4, 'Menyediakan vas bunga plastik.', '2026-01-02 20:57:09', '2026-01-02 20:57:09'),
(4, 'Karpet', 3, 'Menyediakan karpet dengan beberapa pilihan warna.', '2026-01-02 21:07:24', '2026-01-02 21:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `barang_variants`
--

CREATE TABLE `barang_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `nama_variant` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_variants`
--

INSERT INTO `barang_variants` (`id`, `barang_id`, `nama_variant`, `sku`, `harga`, `stok`, `foto`, `created_at`, `updated_at`) VALUES
(7, 1, 'Lampu lighting', 'LAMPU-LIGHTING-342', 30000, 12, '1767411700_images.jpg', '2026-01-02 20:41:40', '2026-01-02 20:41:40'),
(8, 1, 'Lampu hias', 'LAMPU-HIAS-659', 45000, 20, '1767411733_lampu hias.jpeg', '2026-01-02 20:42:13', '2026-01-02 20:42:13'),
(9, 2, 'Meja bundar', 'MEJA-BUNDAR-867', 20000, 50, '1767413198_meja bundar.png', '2026-01-02 20:51:23', '2026-01-02 21:06:38'),
(10, 2, 'Meja persegi panjang', 'MEJA-PERSEGI-PANJANG-230', 20000, 50, '1767412316_meja panjang.png', '2026-01-02 20:51:56', '2026-01-02 20:51:56'),
(11, 3, 'Vas bunga pendek', 'VAS-BUNGA-PENDEK-370', 25000, 10, '1767412683_vas bunga pendek.jpeg', '2026-01-02 20:58:03', '2026-01-02 20:58:03'),
(12, 3, 'Vas bunga panjang', 'VAS-BUNGA-PANJANG-591', 30000, 5, '1767413166_vas bunga panjang.png', '2026-01-02 21:06:06', '2026-01-02 21:06:06'),
(13, 4, 'Karpet merah', 'KARPET-MERAH-953', 50000, 25, '1767413284_karpet merah.jpeg', '2026-01-02 21:08:04', '2026-01-02 21:08:04'),
(14, 4, 'Karpet hijau', 'KARPET-HIJAU-264', 50000, 16, '1767413321_karpet hijau.jpeg', '2026-01-02 21:08:41', '2026-01-03 19:54:10'),
(15, 4, 'Karpet biru', 'KARPET-BIRU-409', 50000, 10, '1767413354_karpet biru.jpeg', '2026-01-02 21:09:14', '2026-01-02 21:09:14');

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
-- Table structure for table `data_kategoris`
--

CREATE TABLE `data_kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_kategoris`
--

INSERT INTO `data_kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', '2026-01-01 07:25:06', '2026-01-01 07:25:06'),
(2, 'Furniture', '2026-01-02 19:07:50', '2026-01-02 19:07:50'),
(3, 'Perlengkapan Lantai', '2026-01-02 19:08:09', '2026-01-02 19:08:09'),
(4, 'Dekorasi', '2026-01-02 19:08:26', '2026-01-02 19:08:26');

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
(4, '2025_12_30_082136_create_data_kategoris_table', 1),
(5, '2025_12_31_135611_create_barangs_table', 1),
(6, '2025_12_31_144854_create_barang_variants_table', 1),
(7, '2026_01_01_072922_create_transaksis_table', 1),
(8, '2026_01_01_081330_create_transaksi_details_table', 1),
(9, '2026_01_03_195748_add_photo_to_users_table', 2);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2026-01-01 07:19:28', '2026-01-01 07:19:28'),
(2, 'User', '2026-01-01 07:19:28', '2026-01-01 07:19:28');

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

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL,
  `nama_orang` varchar(255) NOT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `kode_transaksi`, `jenis`, `nama_orang`, `kontak`, `keterangan`, `tanggal`, `created_at`, `updated_at`) VALUES
(6, 'TRX-20260103-597', 'keluar', 'Novi', '0812292876414', 'Meminjam untuk event di purwakarta.', '2026-01-23', '2026-01-02 21:16:03', '2026-01-02 21:16:03'),
(7, 'TRX-20260104-146', 'masuk', 'Novi', NULL, 'dikembalikan dari event alamat purwakarta', '2026-01-31', '2026-01-03 19:54:10', '2026-01-03 19:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_details`
--

CREATE TABLE `transaksi_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_satuan` bigint(20) NOT NULL DEFAULT 0,
  `sub_total` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_details`
--

INSERT INTO `transaksi_details` (`id`, `transaksi_id`, `variant_id`, `qty`, `harga_satuan`, `sub_total`, `created_at`, `updated_at`) VALUES
(6, 6, 14, 5, 50000, 250000, '2026-01-02 21:16:03', '2026-01-02 21:16:03'),
(7, 7, 14, 1, 50000, 50000, '2026-01-03 19:54:10', '2026-01-03 19:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('submitted','approved','rejected') NOT NULL DEFAULT 'submitted',
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `photo`, `email`, `email_verified_at`, `password`, `status`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'admin@gmail.com', NULL, '$2y$12$71ah9MvvMsXCkbPDKH11VOl0UIKjahwvErNv.VexiJhWWpGNZ/LfO', 'approved', 1, NULL, '2026-01-01 07:19:29', '2026-01-01 07:19:29'),
(2, 'Habibah', '1767471326.png', 'bibah@gmail.com', NULL, '$2y$12$QZ1rAjsQedRY7f20WAuh/u5igMsgzKJpguCs04HPygqQAXQl2OQYW', 'rejected', 2, NULL, '2026-01-02 02:15:33', '2026-01-03 13:15:26'),
(3, 'Bagas', '1767486883.png', 'bagas@gmail.com', NULL, '$2y$12$vKWsrU.hw2tKJznu/HUYPeISHCyChpOqhVo9ii7JeHsN1GG.ae1Su', 'approved', 2, NULL, '2026-01-02 22:48:30', '2026-01-03 18:04:27'),
(4, 'Bayu', NULL, 'bayu@gmail.com', NULL, '$2y$12$Xk/03zyDzwBi4g.11hGgZuDifTpv74JOe5gmyA5gBP0oAw0aQgIni', 'submitted', 2, NULL, '2026-01-03 00:28:36', '2026-01-03 00:28:36'),
(5, 'Ayu', '1767492576.jpg', 'ayu@gmail.com', NULL, '$2y$12$rA4Hn6/dbIObqN1R6IWb6urszbEN0br6Xc5Qs9phaCr0W4Ir70zvy', 'approved', 2, NULL, '2026-01-03 19:05:07', '2026-01-03 19:09:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `barang_variants`
--
ALTER TABLE `barang_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_variants_sku_unique` (`sku`),
  ADD KEY `barang_variants_barang_id_foreign` (`barang_id`);

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
-- Indexes for table `data_kategoris`
--
ALTER TABLE `data_kategoris`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksis_kode_transaksi_unique` (`kode_transaksi`);

--
-- Indexes for table `transaksi_details`
--
ALTER TABLE `transaksi_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_details_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_details_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_variants`
--
ALTER TABLE `barang_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `data_kategoris`
--
ALTER TABLE `data_kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_details`
--
ALTER TABLE `transaksi_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `data_kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barang_variants`
--
ALTER TABLE `barang_variants`
  ADD CONSTRAINT `barang_variants_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_details`
--
ALTER TABLE `transaksi_details`
  ADD CONSTRAINT `transaksi_details_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_details_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `barang_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
