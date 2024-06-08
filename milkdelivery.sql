-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2024 at 09:44 AM
-- Server version: 10.6.17-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milkdelivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver_routes`
--

CREATE TABLE `driver_routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_name` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `loading_distributions`
--

CREATE TABLE `loading_distributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `onloading_id` bigint(20) UNSIGNED DEFAULT NULL,
  `loading_transfer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_name` varchar(255) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `start_mtr_reading` double(8,2) NOT NULL,
  `end_mtr_reading` double(8,2) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loading_transfers`
--

CREATE TABLE `loading_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `onloading_id` bigint(20) UNSIGNED NOT NULL,
  `salesman_id` bigint(20) UNSIGNED NOT NULL,
  `transferred_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loading_transfer_product_relations`
--

CREATE TABLE `loading_transfer_product_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loading_transfer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_15_141722_create_products_table', 1),
(6, '2023_05_15_142612_create_sales_table', 1),
(7, '2023_05_15_200052_create_sales_product_relations_table', 1),
(8, '2023_05_20_152921_create_onloadings_table', 2),
(9, '2023_05_20_153631_create_product_onloading_relations_table', 2),
(12, '2023_05_20_162851_create_product_offloading_relations_table', 3),
(13, '2023_05_20_162921_create_offloadings_table', 3),
(14, '2023_05_24_213223_create_returns_table', 4),
(15, '2023_05_24_213412_create_sale_return_product_relations_table', 4),
(16, '2023_06_14_124759_roles', 5),
(18, '2023_06_17_155419_add_column_to_product_onloading_relations_table', 6),
(19, '2023_06_18_074246_add_column_to_sales_product_relations_table', 7),
(20, '2023_06_18_102819_add_column_to_sale_return_product_relations_table', 8),
(21, '2023_06_18_150357_add_column_to_products_table', 9),
(23, '2023_06_20_203226_add_column_to_salesmans_table', 10),
(24, '2023_06_20_210009_create_loading_transfers_table', 11),
(25, '2023_06_20_210237_create_loading_transfer_product_relations_table', 11),
(26, '2023_06_20_210401_create_loading_distributions_table', 11),
(27, '2023_06_20_210544_create_driver_routes_table', 11),
(28, '2023_06_20_215330_alter_tabel_add_column_status_to_onloadings_table', 12),
(29, '2023_06_23_123808_create_start_onloading_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `offloadings`
--

CREATE TABLE `offloadings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `onloading_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offloadings`
--

INSERT INTO `offloadings` (`id`, `onloading_id`, `salesman_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 55, 53, '2023-05-27 06:11:22', '2023-05-27 06:11:22', NULL),
(3, 60, 55, '2023-06-13 12:37:25', '2023-06-13 12:37:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `onloadings`
--

CREATE TABLE `onloadings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salesman_id` bigint(20) UNSIGNED NOT NULL,
  `is_approved` int(11) NOT NULL DEFAULT 0,
  `warehouse` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `onloadings`
--

INSERT INTO `onloadings` (`id`, `salesman_id`, `is_approved`, `warehouse`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 55, 0, '', '2023-05-21 02:24:03', '2023-05-21 08:46:11', '2023-05-21 08:46:11'),
(6, 55, 0, '', '2023-05-21 02:25:08', '2023-05-27 06:09:10', '2023-05-27 06:09:10'),
(55, 55, 0, '', '2023-05-21 10:42:17', '2023-06-18 03:57:54', '2023-06-18 03:57:54'),
(56, 55, 0, '', '2023-05-21 10:43:45', '2023-05-27 06:09:05', '2023-05-27 06:09:05'),
(57, 55, 0, '', '2023-05-27 06:05:46', '2023-05-27 06:09:19', '2023-05-27 06:09:19'),
(58, 55, 0, '', '2023-05-27 06:07:53', '2023-06-18 03:57:57', '2023-06-18 03:57:57'),
(59, 55, 0, '', '2023-06-13 12:34:15', '2023-06-13 12:35:14', '2023-06-13 12:35:14'),
(60, 55, 0, '', '2023-06-17 14:02:17', '2023-06-17 14:02:17', NULL),
(61, 55, 0, '', '2023-06-18 05:25:20', '2023-06-18 05:25:20', NULL),
(62, 55, 0, '', '2023-06-19 13:49:34', '2023-06-19 13:49:34', NULL),
(63, 55, 0, '', '2023-06-19 21:34:55', '2023-06-19 21:34:55', NULL),
(73, 56, 2, '1', '2023-06-24 15:14:14', '2023-06-23 16:01:30', NULL),
(74, 56, 2, '1', '2023-06-19 02:07:33', '2023-06-25 02:10:58', NULL),
(75, 56, 2, '1', '2023-06-25 03:24:43', '2023-06-25 03:47:18', NULL);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sap_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `unit_price` double NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sap_id`, `name`, `group`, `unit_price`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ertrtryt34545', 'Milk bottle', 'bottle', 12.8, 'yshd fbshsdbvsh d', 0, NULL, '2023-05-20 08:40:18', '2023-06-18 09:57:37'),
(2, 'milk 250-20', 'Milk Pauch 250gm', 'pack', 20, 'milk', 0, NULL, '2023-05-21 10:31:40', '2023-05-27 05:33:34'),
(3, 'Ml500', 'Milk Pack 500ML', 'pack', 40, 'this is the test description', 0, NULL, '2023-05-27 05:28:42', '2023-06-18 09:57:55'),
(4, 'Milk 567', 'Milk bottle 1Ltr', 'pack', 25, 'milk', 0, NULL, '2023-06-13 12:31:46', '2023-06-13 12:32:00'),
(5, '111', 'Test Product', 'Milk', 10, 'Test', 0, NULL, '2023-06-23 00:03:45', '2023-06-23 00:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_offloading_relations`
--

CREATE TABLE `product_offloading_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offloading_id` int(11) NOT NULL,
  `onloading_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_offloading_relations`
--

INSERT INTO `product_offloading_relations` (`id`, `offloading_id`, `onloading_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(6, 2, 55, 1, 5.00, '2023-05-27 14:05:36', '2023-05-27 14:05:36'),
(7, 3, 55, 3, 30.00, '2023-06-13 12:37:25', '2023-06-13 12:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_onloading_relations`
--

CREATE TABLE `product_onloading_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `onloading_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `batch_no` varchar(255) DEFAULT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_onloading_relations`
--

INSERT INTO `product_onloading_relations` (`id`, `onloading_id`, `product_id`, `batch_no`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
(46, 68, 3, '65', -16.00, NULL, '2023-06-23 01:37:24', '2023-06-23 01:37:24'),
(47, 68, 5, '65', -16.00, NULL, '2023-06-23 01:37:24', '2023-06-23 01:37:24'),
(48, 69, 1, 'Test', -149.00, NULL, '2023-06-23 02:20:38', '2023-06-23 02:20:38'),
(49, 69, 3, '1', -80.00, NULL, '2023-06-23 02:20:38', '2023-06-23 02:20:38'),
(50, 69, 5, '10', 19.00, NULL, '2023-06-23 02:20:38', '2023-06-23 02:20:38'),
(57, 64, 1, 'ABC112321', -50.00, NULL, '2023-06-23 05:07:16', '2023-06-23 05:07:16'),
(58, 64, 3, 'ADF112321', 19.00, NULL, '2023-06-23 05:07:16', '2023-06-23 05:07:16'),
(59, 64, 5, 'FBC112321', 19.00, NULL, '2023-06-23 05:07:16', '2023-06-23 05:07:16'),
(60, 70, 1, 'yt', -85.00, NULL, '2023-06-23 14:06:08', '2023-06-23 14:06:08'),
(61, 70, 3, '65', -16.00, NULL, '2023-06-23 14:06:08', '2023-06-23 14:06:08'),
(62, 70, 5, '65', -16.00, NULL, '2023-06-23 14:06:08', '2023-06-23 14:06:08'),
(63, 71, 1, '98', -52.00, NULL, '2023-06-23 14:07:35', '2023-06-23 14:07:35'),
(64, 71, 3, '989', 17.00, NULL, '2023-06-23 14:07:35', '2023-06-23 14:07:35'),
(65, 71, 5, '98', 17.00, NULL, '2023-06-23 14:07:35', '2023-06-23 14:07:35'),
(66, 72, 1, '9', -141.00, NULL, '2023-06-23 14:49:14', '2023-06-23 14:49:14'),
(67, 72, 3, '9', -72.00, NULL, '2023-06-23 14:49:14', '2023-06-23 14:49:14'),
(68, 72, 5, '9', -72.00, NULL, '2023-06-23 14:49:14', '2023-06-23 14:49:14'),
(72, 73, 1, 'TEST', -76.00, NULL, '2023-06-23 15:16:23', '2023-06-23 15:16:23'),
(73, 73, 3, 'Test', 19.00, NULL, '2023-06-23 15:16:23', '2023-06-23 15:16:23'),
(74, 73, 5, 'Test', -1.00, NULL, '2023-06-23 15:16:23', '2023-06-23 15:16:23'),
(75, 74, 1, 'Test', 100.00, NULL, '2023-06-25 02:07:33', '2023-06-25 02:07:33'),
(76, 74, 2, 'Test', 100.00, NULL, '2023-06-25 02:07:33', '2023-06-25 02:07:33'),
(77, 74, 3, 'Test', 100.00, NULL, '2023-06-25 02:07:33', '2023-06-25 02:07:33'),
(78, 74, 4, 'Test', 100.00, NULL, '2023-06-25 02:07:33', '2023-06-25 02:07:33'),
(79, 74, 5, '0', 0.00, NULL, '2023-06-25 02:07:33', '2023-06-25 02:07:33'),
(80, 75, 1, '10A', 10.00, NULL, '2023-06-25 03:24:43', '2023-06-25 03:24:43'),
(81, 75, 2, 'ABC', 150.00, NULL, '2023-06-25 03:24:43', '2023-06-25 03:24:43'),
(82, 75, 3, '0', 0.00, NULL, '2023-06-25 03:24:43', '2023-06-25 03:24:43'),
(83, 75, 4, '0', 0.00, NULL, '2023-06-25 03:24:43', '2023-06-25 03:24:43'),
(84, 75, 5, '0', 0.00, NULL, '2023-06-25 03:24:43', '2023-06-25 03:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `total_amount` double(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `customer_id`, `salesman_id`, `total_amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 240.00, NULL, '2023-05-26 11:36:09', '2023-05-26 11:36:09'),
(2, 2, 5, 240.00, NULL, '2023-05-26 11:36:41', '2023-05-26 11:36:41'),
(3, 2, 5, 240.00, NULL, '2023-05-26 11:37:26', '2023-05-26 11:37:26'),
(4, 2, 5, 240.00, NULL, '2023-05-26 11:37:49', '2023-05-26 11:37:49'),
(5, 2, 5, 240.00, NULL, '2023-05-26 11:37:51', '2023-05-26 11:37:51'),
(6, 2, 5, 240.00, NULL, '2023-05-26 11:42:04', '2023-05-26 11:42:04'),
(7, 54, 53, 515.00, NULL, '2023-05-26 11:45:52', '2023-05-27 16:18:01'),
(8, 2, 5, 115.00, NULL, '2023-05-26 11:48:32', '2023-05-26 11:48:32'),
(9, 54, 53, 1050.00, NULL, '2023-05-27 06:18:36', '2023-05-27 06:18:36'),
(10, 54, 53, 480.00, NULL, '2023-06-13 12:41:24', '2023-06-13 12:41:24'),
(14, 54, 55, 16284.00, NULL, '2023-06-18 05:03:24', '2023-06-18 05:03:24'),
(15, 2, 5, 2000.00, NULL, '2023-06-22 12:30:54', '2023-06-22 12:30:54'),
(16, 2, 56, 14.00, NULL, '2023-06-25 03:55:35', '2023-06-25 03:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Customer', 'This is general User', NULL, NULL),
(2, 'Salesman', 'This is membership user', NULL, NULL),
(102, 'Admin', 'This is special user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `total_amount` double(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `salesman_id`, `total_amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(15, 2, 5, 340.00, NULL, '2023-05-24 15:44:56', '2023-05-24 15:44:56'),
(16, 54, 53, 1780.00, NULL, '2023-05-27 06:17:01', '2023-06-13 12:39:45'),
(17, 2, 55, 2300.00, NULL, '2023-06-18 02:30:03', '2023-06-18 03:12:02'),
(18, 2, 55, 600.00, NULL, '2023-06-19 16:00:15', '2023-06-19 16:00:15'),
(19, 54, 55, 1035.00, NULL, '2023-06-19 16:02:19', '2023-06-19 16:02:19'),
(20, 2, 5, 5000.00, NULL, '2023-06-22 12:29:52', '2023-06-22 12:29:52'),
(21, 2, 56, 3.00, NULL, '2023-06-23 03:06:55', '2023-06-23 03:06:55'),
(22, 2, 56, 243.00, NULL, '2023-06-25 00:43:00', '2023-06-25 00:43:00'),
(23, 2, 56, 972.00, NULL, '2023-06-25 00:43:58', '2023-06-25 00:43:58'),
(24, 2, 56, 972.00, NULL, '2023-06-25 00:46:55', '2023-06-25 00:46:55'),
(25, 2, 56, 972.00, NULL, '2023-06-25 00:48:10', '2023-06-25 00:48:10'),
(26, 2, 56, 13100.00, NULL, '2023-06-25 00:49:56', '2023-06-25 00:49:56'),
(27, 2, 56, 16281.00, NULL, '2023-06-25 01:00:06', '2023-06-25 01:00:06'),
(28, 54, 56, 97200.00, NULL, '2023-06-25 01:01:45', '2023-06-25 01:01:45'),
(29, 2, 56, 175420.00, NULL, '2023-06-25 01:10:20', '2023-06-25 01:10:20'),
(30, 2, 56, 551.00, NULL, '2023-06-25 01:17:24', '2023-06-25 01:17:24'),
(35, 2, 56, 102.00, NULL, '2023-06-25 01:36:38', '2023-06-25 01:36:38'),
(37, 2, 56, 551.00, NULL, '2023-06-25 01:40:30', '2023-06-25 01:40:30'),
(40, 2, 56, 243.00, NULL, '2023-06-25 01:45:05', '2023-06-25 01:45:05'),
(42, 2, 56, 225.00, NULL, '2023-06-25 03:49:40', '2023-06-25 03:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `sales_product_relations`
--

CREATE TABLE `sales_product_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `batch_no` varchar(255) DEFAULT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_product_relations`
--

INSERT INTO `sales_product_relations` (`id`, `sale_id`, `product_id`, `batch_no`, `qty`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(7, 15, 1, NULL, 20.00, 12.00, 240.00, '2023-05-24 15:44:56', '2023-05-24 15:44:56'),
(8, 15, 2, NULL, 10.00, 10.00, 100.00, '2023-05-24 15:44:56', '2023-05-24 15:44:56'),
(14, 16, 1, NULL, 10.00, 50.00, 500.00, '2023-06-13 12:39:45', '2023-06-13 12:39:45'),
(15, 16, 1, NULL, 40.00, 12.00, 480.00, '2023-06-13 12:39:45', '2023-06-13 12:39:45'),
(16, 16, 3, NULL, 40.00, 20.00, 800.00, '2023-06-13 12:39:45', '2023-06-13 12:39:45'),
(19, 17, 1, '8955', 30.00, 10.00, 300.00, '2023-06-18 03:12:02', '2023-06-18 03:12:02'),
(20, 17, 3, '6bn5675', 100.00, 20.00, 2000.00, '2023-06-18 03:12:02', '2023-06-18 03:12:02'),
(21, 18, 1, 'b755', 20.00, 20.00, 400.00, '2023-06-19 16:00:15', '2023-06-19 16:00:15'),
(22, 18, 3, 'p9595', 20.00, 10.00, 200.00, '2023-06-19 16:00:15', '2023-06-19 16:00:15'),
(23, 19, 1, 'b755', 5.00, 67.00, 335.00, '2023-06-19 16:02:19', '2023-06-19 16:02:19'),
(24, 19, 3, 'p9595', 10.00, 70.00, 700.00, '2023-06-19 16:02:19', '2023-06-19 16:02:19'),
(25, 20, 1, 'TEST', 10.00, 100.00, 1000.00, '2023-06-22 12:29:52', '2023-06-22 12:29:52'),
(26, 20, 3, 'TEST1', 20.00, 200.00, 4000.00, '2023-06-22 12:29:52', '2023-06-22 12:29:52'),
(27, 21, 1, '0', 1.00, 1.00, 1.00, '2023-06-23 03:06:55', '2023-06-23 03:06:55'),
(28, 21, 3, '1', 1.00, 1.00, 1.00, '2023-06-23 03:06:55', '2023-06-23 03:06:55'),
(29, 21, 5, '1', 1.00, 1.00, 1.00, '2023-06-23 03:06:55', '2023-06-23 03:06:55'),
(30, 22, 1, '09', 9.00, 9.00, 81.00, '2023-06-25 00:43:00', '2023-06-25 00:43:00'),
(31, 22, 3, '09', 9.00, 9.00, 81.00, '2023-06-25 00:43:00', '2023-06-25 00:43:00'),
(32, 22, 5, '09', 9.00, 9.00, 81.00, '2023-06-25 00:43:00', '2023-06-25 00:43:00'),
(33, 23, 1, '09', 9.00, 9.00, 81.00, '2023-06-25 00:43:58', '2023-06-25 00:43:58'),
(34, 23, 3, '09', 9.00, 9.00, 81.00, '2023-06-25 00:43:58', '2023-06-25 00:43:58'),
(35, 23, 5, '09', 90.00, 9.00, 810.00, '2023-06-25 00:43:58', '2023-06-25 00:43:58'),
(36, 24, 1, '09', 9.00, 9.00, 81.00, '2023-06-25 00:46:55', '2023-06-25 00:46:55'),
(37, 24, 3, '09', 9.00, 9.00, 81.00, '2023-06-25 00:46:55', '2023-06-25 00:46:55'),
(38, 24, 5, '09', 90.00, 9.00, 810.00, '2023-06-25 00:46:55', '2023-06-25 00:46:55'),
(39, 25, 1, '09', 9.00, 9.00, 81.00, '2023-06-25 00:48:10', '2023-06-25 00:48:10'),
(40, 25, 3, '09', 9.00, 9.00, 81.00, '2023-06-25 00:48:10', '2023-06-25 00:48:10'),
(41, 25, 5, '09', 90.00, 9.00, 810.00, '2023-06-25 00:48:10', '2023-06-25 00:48:10'),
(42, 26, 1, 'test', 100.00, 10.00, 1000.00, '2023-06-25 00:49:56', '2023-06-25 00:49:56'),
(43, 26, 3, 'test', 120.00, 100.00, 12000.00, '2023-06-25 00:49:56', '2023-06-25 00:49:56'),
(44, 26, 5, '60', 10.00, 10.00, 100.00, '2023-06-25 00:49:56', '2023-06-25 00:49:56'),
(45, 27, 1, '909', 909.00, 9.00, 8181.00, '2023-06-25 01:00:06', '2023-06-25 01:00:06'),
(46, 27, 3, '80', 0.00, 0.00, 0.00, '2023-06-25 01:00:06', '2023-06-25 01:00:06'),
(47, 27, 5, '90', 90.00, 90.00, 8100.00, '2023-06-25 01:00:06', '2023-06-25 01:00:06'),
(48, 28, 1, '90', 90.00, 900.00, 81000.00, '2023-06-25 01:01:45', '2023-06-25 01:01:45'),
(49, 28, 3, '90', 90.00, 90.00, 8100.00, '2023-06-25 01:01:45', '2023-06-25 01:01:45'),
(50, 28, 5, '90', 90.00, 90.00, 8100.00, '2023-06-25 01:01:45', '2023-06-25 01:01:45'),
(51, 29, 1, '98', 890.00, 89.00, 79210.00, '2023-06-25 01:10:20', '2023-06-25 01:10:20'),
(52, 29, 3, '89', 890.00, 99.00, 88110.00, '2023-06-25 01:10:20', '2023-06-25 01:10:20'),
(53, 29, 5, '90', 90.00, 90.00, 8100.00, '2023-06-25 01:10:20', '2023-06-25 01:10:20'),
(54, 30, 1, '9', 9.00, 9.00, 81.00, '2023-06-25 01:17:24', '2023-06-25 01:17:24'),
(55, 30, 3, '9', 50.00, 9.00, 450.00, '2023-06-25 01:17:24', '2023-06-25 01:17:24'),
(56, 30, 5, '9', 10.00, 2.00, 20.00, '2023-06-25 01:17:24', '2023-06-25 01:17:24'),
(61, 35, 1, '10', 10.00, 10.00, 100.00, '2023-06-25 01:36:38', '2023-06-25 01:36:38'),
(62, 35, 3, '10', 1.00, 1.00, 1.00, '2023-06-25 01:36:38', '2023-06-25 01:36:38'),
(63, 35, 5, '1', 1.00, 1.00, 1.00, '2023-06-25 01:36:38', '2023-06-25 01:36:38'),
(65, 37, 1, '9', 9.00, 9.00, 81.00, '2023-06-25 01:40:30', '2023-06-25 01:40:30'),
(66, 37, 3, '9', 50.00, 9.00, 450.00, '2023-06-25 01:40:30', '2023-06-25 01:40:30'),
(67, 37, 5, '9', 10.00, 2.00, 20.00, '2023-06-25 01:40:30', '2023-06-25 01:40:30'),
(70, 40, 1, '09', 9.00, 9.00, 81.00, '2023-06-25 01:45:05', '2023-06-25 01:45:05'),
(71, 40, 3, '09', 9.00, 9.00, 81.00, '2023-06-25 01:45:05', '2023-06-25 01:45:05'),
(72, 40, 5, '09', 9.00, 9.00, 81.00, '2023-06-25 01:45:05', '2023-06-25 01:45:05'),
(74, 42, 1, '10A', 3.00, 2.00, 6.00, '2023-06-25 03:49:40', '2023-06-25 03:49:40'),
(75, 42, 2, 'ABC', 73.00, 3.00, 219.00, '2023-06-25 03:49:40', '2023-06-25 03:49:40'),
(76, 42, 3, '0', 0.00, 0.00, 0.00, '2023-06-25 03:49:40', '2023-06-25 03:49:40'),
(77, 42, 4, '0', 0.00, 0.00, 0.00, '2023-06-25 03:49:40', '2023-06-25 03:49:40'),
(78, 42, 5, '0', 0.00, 0.00, 0.00, '2023-06-25 03:49:40', '2023-06-25 03:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_product_relations`
--

CREATE TABLE `sale_return_product_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `returns_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `batch_no` varchar(255) DEFAULT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_return_product_relations`
--

INSERT INTO `sale_return_product_relations` (`id`, `sale_id`, `returns_id`, `product_id`, `batch_no`, `qty`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 15, 1, 1, NULL, 12.00, 20.00, 240.00, '2023-05-26 11:36:09', '2023-05-26 11:36:09'),
(2, 15, 2, 1, NULL, 12.00, 20.00, 240.00, '2023-05-26 11:36:41', '2023-05-26 11:36:41'),
(3, 15, 3, 1, NULL, 12.00, 20.00, 240.00, '2023-05-26 11:37:26', '2023-05-26 11:37:26'),
(4, 15, 4, 1, NULL, 12.00, 20.00, 240.00, '2023-05-26 11:37:49', '2023-05-26 11:37:49'),
(5, 15, 5, 1, NULL, 12.00, 20.00, 240.00, '2023-05-26 11:37:51', '2023-05-26 11:37:51'),
(6, 15, 6, 1, NULL, 12.00, 20.00, 240.00, '2023-05-26 11:42:04', '2023-05-26 11:42:04'),
(8, 15, 8, 2, NULL, 23.00, 5.00, 115.00, '2023-05-26 11:48:32', '2023-05-26 11:48:32'),
(9, 15, 9, 1, NULL, 5.00, 50.00, 250.00, '2023-05-27 06:18:36', '2023-05-27 06:18:36'),
(10, 15, 9, 3, NULL, 10.00, 80.00, 800.00, '2023-05-27 06:18:36', '2023-05-27 06:18:36'),
(11, 16, 7, 1, NULL, 23.00, 5.00, 115.00, '2023-05-27 16:18:01', '2023-05-27 16:18:01'),
(12, 16, 7, 3, NULL, 40.00, 10.00, 400.00, '2023-05-27 16:18:01', '2023-05-27 16:18:01'),
(13, 16, 10, 1, NULL, 12.00, 40.00, 480.00, '2023-06-13 12:41:24', '2023-06-13 12:41:24'),
(14, 0, 14, 1, '675756', 30.00, 23.00, 690.00, '2023-06-18 05:03:24', '2023-06-18 05:03:24'),
(15, 0, 14, 3, '46765756', 678.00, 23.00, 15594.00, '2023-06-18 05:03:24', '2023-06-18 05:03:24'),
(16, 0, 15, 1, 'demo', 20.00, 100.00, 2000.00, '2023-06-22 12:30:54', '2023-06-22 12:30:54'),
(17, 0, 15, 3, 'demo1', 0.00, 0.00, 0.00, '2023-06-22 12:30:54', '2023-06-22 12:30:54'),
(18, 0, 16, 1, '0', 0.00, 0.00, 0.00, '2023-06-25 03:55:35', '2023-06-25 03:55:35'),
(19, 0, 16, 2, 'ABC', 7.00, 2.00, 14.00, '2023-06-25 03:55:35', '2023-06-25 03:55:35'),
(20, 0, 16, 3, '0', 0.00, 0.00, 0.00, '2023-06-25 03:55:35', '2023-06-25 03:55:35'),
(21, 0, 16, 4, '0', 0.00, 0.00, 0.00, '2023-06-25 03:55:35', '2023-06-25 03:55:35'),
(22, 0, 16, 5, '0', 0.00, 0.00, 0.00, '2023-06-25 03:55:35', '2023-06-25 03:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `start_onloading`
--

CREATE TABLE `start_onloading` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `onloading_id` int(11) NOT NULL,
  `offloading_id` int(11) NOT NULL DEFAULT 0,
  `driver_name` varchar(255) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `start_km` varchar(255) NOT NULL,
  `end_km` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `start_onloading`
--

INSERT INTO `start_onloading` (`id`, `onloading_id`, `offloading_id`, `driver_name`, `vehicle_no`, `start_km`, `end_km`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:18:52', '2023-06-23 12:18:52'),
(2, 0, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:19:11', '2023-06-23 12:19:11'),
(3, 69, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:19:38', '2023-06-23 12:19:38'),
(4, 69, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:21:25', '2023-06-23 12:21:25'),
(5, 69, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:22:06', '2023-06-23 12:22:06'),
(6, 69, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:22:17', '2023-06-23 12:22:17'),
(7, 69, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:23:54', '2023-06-23 12:23:54'),
(8, 69, 0, 'Test', 'Test01', '1200', '0', '2023-06-23 12:41:53', '2023-06-23 12:41:53'),
(9, 68, 0, 'Deepu', 'KA01EQ0001', '1310', '0', '2023-06-23 13:19:22', '2023-06-23 13:19:22'),
(10, 69, 0, 'tr', 'tr', 'tr', '0', '2023-06-23 13:47:53', '2023-06-23 13:47:53'),
(11, 69, 0, 'tr', 'tr', 'tr', '0', '2023-06-23 13:48:11', '2023-06-23 13:48:11'),
(12, 69, 0, 'tr', 'tr', 'tr', '0', '2023-06-23 13:48:33', '2023-06-23 13:48:33'),
(13, 69, 0, 'tr', 'tr', 'tr', '0', '2023-06-23 13:49:07', '2023-06-23 13:49:07'),
(14, 69, 0, 'Deepesh', 'KA01EQ0001', '1500', '0', '2023-06-23 13:53:55', '2023-06-23 13:53:55'),
(15, 73, 0, 'Deepesh', 'TESTVIN', '1200', '0', '2023-06-23 16:01:30', '2023-06-23 16:01:30'),
(16, 74, 0, 'Test Driver', 'KA01EQ0001', '1500', '0', '2023-06-25 02:10:58', '2023-06-25 02:10:58'),
(17, 75, 0, 'Test Person', '12345', '5899', '0', '2023-06-25 03:47:18', '2023-06-25 03:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `sap_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `monthly_target` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact_name`, `contact_number`, `role_id`, `sap_id`, `email`, `email_verified_at`, `password`, `status`, `monthly_target`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Suhail', 'Admin', '686151', 102, 'sdfg454', 'admin@admin.com', NULL, '$2y$10$SSoCqoYh2bbVjx3Rhz4TD.af1OJkVwU9SCHVtKD6/Y0a2QdAOWU9y', 0, NULL, 'ZRFJ5smhqCMW8ke3Ylu0a2olks3mKQchj88R35NU07VyJy2RY4pkuIvlhNZs', NULL, NULL, NULL),
(2, 'Sahil', 'Suhail Khan', '999999999', 1, 'Hu78438', NULL, NULL, NULL, 1, 10, NULL, NULL, '2023-05-20 05:07:40', '2023-05-20 05:07:54'),
(3, 'tst', 'egdgfdgfd', '45t46455', 1, '345', NULL, NULL, NULL, 1, NULL, NULL, '2023-05-20 05:08:28', '2023-05-20 05:08:21', '2023-05-20 05:08:28'),
(4, 'Riyaz', 'dhdn', '874738943', 1, 'ml8674738', NULL, NULL, NULL, 1, NULL, NULL, '2023-05-27 05:36:33', '2023-05-20 06:13:10', '2023-05-27 05:36:33'),
(5, 'Sajid Dealer', NULL, '988930384', 2, '42672', 'salsesman@gmail.com', NULL, '$2y$10$DBh0NxY.PrNrN9GLNNqjgOFy0k72YSras.37Zum/3dja74YEgCyMO', 1, 5000, NULL, NULL, '2023-05-20 08:29:40', '2023-06-25 04:29:10'),
(6, 'sdsdfgbds', NULL, '43656554', 2, 'test', 'sadfgsdf@gmail.com', NULL, '$2y$10$a0rcla5UlWN18Isi3hWEH.8cXBjei.K0QAiQ9ekFNALkUakZX5OEm', 1, NULL, NULL, '2023-05-20 09:36:34', '2023-05-20 09:36:28', '2023-05-20 09:36:34'),
(53, 'Riyaz Khan', NULL, '45218 89', 2, 'Sales 8787', 'riyaz@gmail.com', NULL, '$2y$10$eZJ3XZ4gQWPgzfCk.nVA2OfeZge9qGRUdb/J275Q6f5eug2fwmsjK', 1, 30, NULL, NULL, '2023-05-21 08:56:14', '2023-05-27 13:50:06'),
(54, 'Martin Junkar', 'Mitch Junker', '45 - (45988) - 89', 1, 'CUST318821', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2023-05-27 05:35:45', '2023-05-27 05:36:07'),
(55, 'BOB', NULL, '9999999999', 2, 'sal4343', 'bob@gmail.com', NULL, '$2y$10$BpmfSkgK5JeoBbj13hVpe.Wqi5Rv1la8NF7SrIcb28Mn.XTapH6XW', 1, 30, NULL, NULL, '2023-05-27 05:42:50', '2023-06-25 02:01:14'),
(56, 'Junaid Khan', NULL, '345 (34554) 748', 2, 'SAP321', 'junaid@gmail.com', NULL, '$2y$10$vSQubcU3ElbvcKO5t9h1k.mN9noye4pjOskCrb2lu0R61TOJbtf7W', 1, 30, 'MeydLGGanMFt9uSx7Fo8TZQDaEX7IhPFjdLilWal9udIse9PjBIaNn6CLGGX', NULL, '2023-06-13 12:30:08', '2023-06-23 00:31:33'),
(57, 'Test', NULL, '9090909090', 2, '12', 'test@abc.com', NULL, '$2y$10$Us8VZ4JrdNGSXVFw/Jf9A.SKgeGFdtaBEGOmEXXFx/qfd3m4n5hDu', 1, 5000, NULL, NULL, '2023-06-22 13:28:11', '2023-06-25 01:59:03'),
(58, 'tr', NULL, '86677667676', 2, '12', 'gfgf@hgh.com', NULL, '$2y$10$tsV.FLRSMQrnSFY7rVx8WueBjnWa05zlYgwfP3EUKBXA0fT29kE2S$2y$10$LIJh5hZ75hBKJUJZ/AEgPO5V1F5uE8.a8JHtk25309TbekOMQC0oi', 1, 65, NULL, NULL, '2023-06-22 23:52:34', '2023-06-22 23:52:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver_routes`
--
ALTER TABLE `driver_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `loading_distributions`
--
ALTER TABLE `loading_distributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loading_distributions_loading_transfer_id_foreign` (`loading_transfer_id`),
  ADD KEY `loading_distributions_onloading_id_foreign` (`onloading_id`);

--
-- Indexes for table `loading_transfers`
--
ALTER TABLE `loading_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loading_transfers_onloading_id_foreign` (`onloading_id`),
  ADD KEY `loading_transfers_salesman_id_foreign` (`salesman_id`),
  ADD KEY `loading_transfers_transferred_by_foreign` (`transferred_by`);

--
-- Indexes for table `loading_transfer_product_relations`
--
ALTER TABLE `loading_transfer_product_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loading_transfer_product_relations_loading_transfer_id_foreign` (`loading_transfer_id`),
  ADD KEY `loading_transfer_product_relations_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offloadings`
--
ALTER TABLE `offloadings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onloadings`
--
ALTER TABLE `onloadings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_offloading_relations`
--
ALTER TABLE `product_offloading_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_onloading_relations`
--
ALTER TABLE `product_onloading_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_product_relations`
--
ALTER TABLE `sales_product_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_return_product_relations`
--
ALTER TABLE `sale_return_product_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `start_onloading`
--
ALTER TABLE `start_onloading`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `driver_routes`
--
ALTER TABLE `driver_routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loading_distributions`
--
ALTER TABLE `loading_distributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loading_transfers`
--
ALTER TABLE `loading_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loading_transfer_product_relations`
--
ALTER TABLE `loading_transfer_product_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `offloadings`
--
ALTER TABLE `offloadings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `onloadings`
--
ALTER TABLE `onloadings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_offloading_relations`
--
ALTER TABLE `product_offloading_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_onloading_relations`
--
ALTER TABLE `product_onloading_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sales_product_relations`
--
ALTER TABLE `sales_product_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `sale_return_product_relations`
--
ALTER TABLE `sale_return_product_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `start_onloading`
--
ALTER TABLE `start_onloading`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loading_distributions`
--
ALTER TABLE `loading_distributions`
  ADD CONSTRAINT `loading_distributions_loading_transfer_id_foreign` FOREIGN KEY (`loading_transfer_id`) REFERENCES `loading_transfers` (`id`),
  ADD CONSTRAINT `loading_distributions_onloading_id_foreign` FOREIGN KEY (`onloading_id`) REFERENCES `onloadings` (`id`);

--
-- Constraints for table `loading_transfers`
--
ALTER TABLE `loading_transfers`
  ADD CONSTRAINT `loading_transfers_onloading_id_foreign` FOREIGN KEY (`onloading_id`) REFERENCES `onloadings` (`id`),
  ADD CONSTRAINT `loading_transfers_salesman_id_foreign` FOREIGN KEY (`salesman_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `loading_transfers_transferred_by_foreign` FOREIGN KEY (`transferred_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `loading_transfer_product_relations`
--
ALTER TABLE `loading_transfer_product_relations`
  ADD CONSTRAINT `loading_transfer_product_relations_loading_transfer_id_foreign` FOREIGN KEY (`loading_transfer_id`) REFERENCES `loading_transfers` (`id`),
  ADD CONSTRAINT `loading_transfer_product_relations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
