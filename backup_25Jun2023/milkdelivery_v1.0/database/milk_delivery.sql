-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2023 at 06:41 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milk_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(16, '2023_06_14_124759_roles', 5);

-- --------------------------------------------------------

--
-- Table structure for table `offloadings`
--

CREATE TABLE `offloadings` (
  `id` bigint UNSIGNED NOT NULL,
  `onloading_id` int NOT NULL,
  `salesman_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offloadings`
--

INSERT INTO `offloadings` (`id`, `onloading_id`, `salesman_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 55, 53, '2023-05-27 06:11:22', '2023-05-27 06:11:22', NULL),
(3, 55, 53, '2023-06-13 12:37:25', '2023-06-13 12:37:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `onloadings`
--

CREATE TABLE `onloadings` (
  `id` bigint UNSIGNED NOT NULL,
  `salesman_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `onloadings`
--

INSERT INTO `onloadings` (`id`, `salesman_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 5, '2023-05-21 02:24:03', '2023-05-21 08:46:11', '2023-05-21 08:46:11'),
(6, 5, '2023-05-21 02:25:08', '2023-05-27 06:09:10', '2023-05-27 06:09:10'),
(55, 53, '2023-05-21 10:42:17', '2023-05-21 10:42:17', NULL),
(56, 5, '2023-05-21 10:43:45', '2023-05-27 06:09:05', '2023-05-27 06:09:05'),
(57, 55, '2023-05-27 06:05:46', '2023-05-27 06:09:19', '2023-05-27 06:09:19'),
(58, 5, '2023-05-27 06:07:53', '2023-05-27 06:07:53', NULL),
(59, 56, '2023-06-13 12:34:15', '2023-06-13 12:35:14', '2023-06-13 12:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `sap_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sap_id`, `name`, `unit_price`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ertrtryt34545', 'Milk bottle', 12.8, 'yshd fbshsdbvsh d', 0, NULL, '2023-05-20 08:40:18', '2023-05-27 05:32:55'),
(2, 'milk 250-20', 'Milk Pauch 250gm', 20, NULL, 0, '2023-05-27 05:33:34', '2023-05-21 10:31:40', '2023-05-27 05:33:34'),
(3, 'Ml500', 'Milk Pack 500ML', 40, 'this is the test description', 0, NULL, '2023-05-27 05:28:42', '2023-05-27 05:32:19'),
(4, 'Milk 567', 'Milk bottle 1Ltr', 25, NULL, 0, '2023-06-13 12:32:00', '2023-06-13 12:31:46', '2023-06-13 12:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_offloading_relations`
--

CREATE TABLE `product_offloading_relations` (
  `id` bigint UNSIGNED NOT NULL,
  `offloading_id` int NOT NULL,
  `onloading_id` int NOT NULL,
  `product_id` int NOT NULL,
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
  `id` bigint UNSIGNED NOT NULL,
  `onloading_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_onloading_relations`
--

INSERT INTO `product_onloading_relations` (`id`, `onloading_id`, `product_id`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
(20, 58, 1, 90.00, NULL, '2023-05-27 14:07:48', '2023-05-27 14:07:48'),
(21, 55, 1, 46.00, NULL, '2023-05-27 15:19:55', '2023-05-27 15:19:55'),
(22, 55, 3, 34.00, NULL, '2023-05-27 15:19:55', '2023-05-27 15:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `salesman_id` int NOT NULL,
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
(10, 54, 53, 480.00, NULL, '2023-06-13 12:41:24', '2023-06-13 12:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `salesman_id` int NOT NULL,
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
(16, 54, 53, 1780.00, NULL, '2023-05-27 06:17:01', '2023-06-13 12:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `sales_product_relations`
--

CREATE TABLE `sales_product_relations` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_product_relations`
--

INSERT INTO `sales_product_relations` (`id`, `sale_id`, `product_id`, `qty`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(7, 15, 1, 20.00, 12.00, 240.00, '2023-05-24 15:44:56', '2023-05-24 15:44:56'),
(8, 15, 2, 10.00, 10.00, 100.00, '2023-05-24 15:44:56', '2023-05-24 15:44:56'),
(14, 16, 1, 10.00, 50.00, 500.00, '2023-06-13 12:39:45', '2023-06-13 12:39:45'),
(15, 16, 1, 40.00, 12.00, 480.00, '2023-06-13 12:39:45', '2023-06-13 12:39:45'),
(16, 16, 3, 40.00, 20.00, 800.00, '2023-06-13 12:39:45', '2023-06-13 12:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_product_relations`
--

CREATE TABLE `sale_return_product_relations` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` int NOT NULL,
  `returns_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_return_product_relations`
--

INSERT INTO `sale_return_product_relations` (`id`, `sale_id`, `returns_id`, `product_id`, `qty`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 15, 1, 1, 12.00, 20.00, 240.00, '2023-05-26 11:36:09', '2023-05-26 11:36:09'),
(2, 15, 2, 1, 12.00, 20.00, 240.00, '2023-05-26 11:36:41', '2023-05-26 11:36:41'),
(3, 15, 3, 1, 12.00, 20.00, 240.00, '2023-05-26 11:37:26', '2023-05-26 11:37:26'),
(4, 15, 4, 1, 12.00, 20.00, 240.00, '2023-05-26 11:37:49', '2023-05-26 11:37:49'),
(5, 15, 5, 1, 12.00, 20.00, 240.00, '2023-05-26 11:37:51', '2023-05-26 11:37:51'),
(6, 15, 6, 1, 12.00, 20.00, 240.00, '2023-05-26 11:42:04', '2023-05-26 11:42:04'),
(8, 15, 8, 2, 23.00, 5.00, 115.00, '2023-05-26 11:48:32', '2023-05-26 11:48:32'),
(9, 15, 9, 1, 5.00, 50.00, 250.00, '2023-05-27 06:18:36', '2023-05-27 06:18:36'),
(10, 15, 9, 3, 10.00, 80.00, 800.00, '2023-05-27 06:18:36', '2023-05-27 06:18:36'),
(11, 16, 7, 1, 23.00, 5.00, 115.00, '2023-05-27 16:18:01', '2023-05-27 16:18:01'),
(12, 16, 7, 3, 40.00, 10.00, 400.00, '2023-05-27 16:18:01', '2023-05-27 16:18:01'),
(13, 16, 10, 1, 12.00, 40.00, 480.00, '2023-06-13 12:41:24', '2023-06-13 12:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL,
  `sap_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact_name`, `contact_number`, `role_id`, `sap_id`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Suhail', 'Sahil', '686151', 102, 'sdfg454', 'admin@admin.com', NULL, '$2y$10$SSoCqoYh2bbVjx3Rhz4TD.af1OJkVwU9SCHVtKD6/Y0a2QdAOWU9y', 0, 'l4LMKfJdXqyz1RXhxeApVh2LBzUjyC7GYrA1x4NsfPs8e5Pn9KM9qpPYGShI', NULL, NULL, NULL),
(2, 'Sahil', 'Suhail Khan', '999999999', 1, 'Hu78438', NULL, NULL, NULL, 1, NULL, NULL, '2023-05-20 05:07:40', '2023-05-20 05:07:54'),
(3, 'tst', 'egdgfdgfd', '45t46455', 1, '345', NULL, NULL, NULL, 1, NULL, '2023-05-20 05:08:28', '2023-05-20 05:08:21', '2023-05-20 05:08:28'),
(4, 'Riyaz', 'dhdn', '874738943', 1, 'ml8674738', NULL, NULL, NULL, 1, NULL, '2023-05-27 05:36:33', '2023-05-20 06:13:10', '2023-05-27 05:36:33'),
(5, 'Sajid Dealer', NULL, '988930384', 2, '42672', 'salsesman@gmail.com', NULL, '$2y$10$em.FjV/lQKKpsec4//ZjjOJztj6Tv9kTo9KIbpoWgpEdBbnVyDlpK', 1, NULL, NULL, '2023-05-20 08:29:40', '2023-05-21 10:29:12'),
(6, 'sdsdfgbds', NULL, '43656554', 2, 'test', 'sadfgsdf@gmail.com', NULL, '$2y$10$a0rcla5UlWN18Isi3hWEH.8cXBjei.K0QAiQ9ekFNALkUakZX5OEm', 1, NULL, '2023-05-20 09:36:34', '2023-05-20 09:36:28', '2023-05-20 09:36:34'),
(53, 'Riyaz Khan', NULL, '45218 89', 2, 'Sales 8787', 'riyaz@gmail.com', NULL, '$2y$10$eZJ3XZ4gQWPgzfCk.nVA2OfeZge9qGRUdb/J275Q6f5eug2fwmsjK', 1, NULL, NULL, '2023-05-21 08:56:14', '2023-05-27 13:50:06'),
(54, 'Martin Junkar', 'Mitch Junker', '45 - (45988) - 89', 1, 'CUST318821', NULL, NULL, NULL, 1, NULL, NULL, '2023-05-27 05:35:45', '2023-05-27 05:36:07'),
(55, 'BOB', NULL, '9999999999', 2, 'sal4343', 'bob@gmail.com', NULL, '$2y$10$1aoCujNrMJBq.frzuiwjYeH3z5FW5zA8TC8bPEMQCAHCgiuZKeKj.', 1, NULL, NULL, '2023-05-27 05:42:50', '2023-06-13 09:25:34'),
(56, 'Junaid Khan', NULL, '345 (34554) 748', 2, 'SAP321', 'junaid@gmail.com', NULL, '$2y$10$YXO7plcIoHSsIA9N9FccjOUsF97zRue3UagXqdm8AYWcjqedM8BVG', 1, NULL, NULL, '2023-06-13 12:30:08', '2023-06-13 12:30:42');

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `offloadings`
--
ALTER TABLE `offloadings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `onloadings`
--
ALTER TABLE `onloadings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_offloading_relations`
--
ALTER TABLE `product_offloading_relations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_onloading_relations`
--
ALTER TABLE `product_onloading_relations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales_product_relations`
--
ALTER TABLE `sales_product_relations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_return_product_relations`
--
ALTER TABLE `sale_return_product_relations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
