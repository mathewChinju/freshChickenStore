-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2026 at 04:45 AM
-- Server version: 9.2.0
-- PHP Version: 8.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `is_active`, `sort_order`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Chicken', 'chicken', 'Fresh farm chicken cuts', '1774246113.jpg', 1, 1, NULL, '2026-03-20 06:00:52', '2026-03-23 00:38:33'),
(2, 'Beef', 'beef', 'Premium beef cuts & roasts', '1774246156.jpg', 1, 2, NULL, '2026-03-23 00:39:16', '2026-03-23 00:41:45'),
(3, 'Lamb', 'lamb', 'Succulent lamb & goat meat', '1774246187.jpg', 1, 4, NULL, '2026-03-23 00:39:47', '2026-03-23 00:41:16'),
(4, 'Pork', 'pork', 'Tender pork chops & ribs', '1774246230.jpg', 1, 3, NULL, '2026-03-23 00:40:30', '2026-03-23 00:41:09'),
(6, 'Sea foods', 'sea-foods', NULL, NULL, 0, 5, NULL, '2026-03-23 01:14:26', '2026-03-23 02:04:03'),
(7, 'Check', 'check', NULL, NULL, 1, 0, 4, '2026-03-23 06:17:14', '2026-03-23 06:17:14'),
(8, 'Check-2', 'check-2', NULL, NULL, 1, 0, 4, '2026-03-24 01:16:31', '2026-03-24 01:16:31');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(13, '0001_01_01_000000_create_users_table', 1),
(14, '0001_01_01_000001_create_cache_table', 1),
(15, '0001_01_01_000002_create_jobs_table', 1),
(16, '2026_03_10_135738_create_products_table', 1),
(17, '2026_03_10_135739_create_orders_table', 1),
(18, '2026_03_10_135759_add_admin_fields_to_users_table', 1),
(19, '2026_03_11_051951_create_permission_tables', 1),
(20, '2026_03_11_093410_create_categories_table', 1),
(21, '2026_03_11_093727_add_category_id_to_products_table', 1),
(22, '2026_03_11_110131_add_stock_at_order_time_to_orders_table', 1),
(23, '2026_03_11_130409_add_parent_id_to_categories_table', 1),
(24, '2026_03_13_091652_add_is_featured_to_products_table', 1),
(25, '2026_03_20_123127_create_product_images_table', 2),
(26, '2026_03_23_092255_change_weight_column_in_products_table', 3),
(28, '2026_03_23_111304_add_rating_and_manual_stock_to_products_table', 4),
(29, '2026_03_24_073253_add_tags_to_products_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `stock_at_order_time` int NOT NULL DEFAULT '0' COMMENT 'Stock quantity at the time of order',
  `unit_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Unit price at the time of order',
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','processing','shipped','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_whatsapp_inquiry` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard-access', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(2, 'product-list', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(3, 'product-create', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(4, 'product-edit', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(5, 'product-delete', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(6, 'order-list', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(7, 'order-create', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(8, 'order-edit', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(9, 'order-delete', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(10, 'user-list', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(11, 'user-create', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(12, 'user-edit', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(13, 'user-delete', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(14, 'category-list', 'web', '2026-03-10 22:42:07', '2026-03-10 22:42:07'),
(15, 'category-create', 'web', '2026-03-10 22:42:07', '2026-03-10 22:42:07'),
(16, 'category-edit', 'web', '2026-03-10 22:42:07', '2026-03-10 22:42:07'),
(17, 'category-delete', 'web', '2026-03-10 22:42:07', '2026-03-10 22:42:07'),
(18, 'role-list', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20'),
(19, 'role-create', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20'),
(20, 'role-edit', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20'),
(21, 'role-delete', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20'),
(22, 'permission-list', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20'),
(23, 'permission-create', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20'),
(24, 'permission-edit', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20'),
(25, 'permission-delete', 'web', '2026-03-17 20:25:20', '2026-03-17 20:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '4.50',
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_quantity` int DEFAULT NULL,
  `is_out_of_stock` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `categories` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `rating`, `price`, `image`, `stock_quantity`, `is_out_of_stock`, `is_active`, `is_featured`, `sku`, `weight`, `tags`, `category_id`, `categories`, `created_at`, `updated_at`) VALUES
(1, 'Whole Beef Brisket', 'Whole beef brisket — the king of BBQ and slow-cook cuts. Perfect for smoking, braising, or low-and-slow oven roasting.\r\n\r\nGrass-fed beef\r\nVacuum packed\r\nPerfect for BBQ & smoking\r\nChilled, not frozen', 4.50, 400.00, '1774246601.jpg', NULL, 0, 1, 1, 'BFF-01', '1.00', 'Daily Fresh, Hormone Free, Premium Quality', 2, NULL, '2026-03-20 06:18:34', '2026-03-24 03:16:14'),
(2, 'Whole Chicken — Size 12', 'Whole fresh chicken, available in four sizes to suit any occasion — from a quick weeknight roast to a large family feast.\r\n\r\nHormone & antibiotic free\r\nVacuum packed\r\nChilled, not frozen\r\nWeight range is approximate', 4.50, 200.00, '1774246500.jpg', NULL, 0, 1, 0, 'CHK-02', '1.00', 'Fresh, Quality, Whole Chicken — Size 12', 1, NULL, '2026-03-20 06:19:58', '2026-03-24 03:19:40'),
(3, 'Chicken Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 2.50, 100.00, '1774265513.jpg', NULL, 0, 1, 0, 'CHK-3', '500g,1kg,2kg', 'Fresh, Quality, Chicken Skinless Breast', 1, NULL, '2026-03-20 08:31:33', '2026-03-24 03:19:40'),
(4, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-4', '1100-1200g, 1200-1300g', 'Fresh, Quality, Boneless Skinless Breast', 1, NULL, '2026-03-20 08:31:33', '2026-03-24 03:19:40'),
(5, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-5', '1500-1600g', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 05:10:11'),
(6, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-6', '0.50', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 03:27:28'),
(7, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-7', '0.50', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 03:27:28'),
(8, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-8\r\n', '0.50', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 03:27:28'),
(9, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-9\r\n', '0.50', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 03:27:28'),
(10, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-10\r\n', '0.50', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 03:27:28'),
(11, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-11\r\n', '0.50', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 03:27:28'),
(12, 'Boneless Skinless Breast', 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.\r\n\r\nHormone & antibiotic free\r\nVacuum packed for freshness\r\nChilled, not frozen\r\nPicture is for illustrative purposes only', 4.50, 100.00, '1774256248.jpg', NULL, 0, 1, 0, 'CHK-12\r\n', '0.50', NULL, 1, NULL, '2026-03-20 08:31:33', '2026-03-23 03:27:28'),
(13, 'Check new', 'check new for test', 4.90, 100.00, '1774266291.jpg', NULL, 1, 1, 0, 'CHN-01', '500g,1kg,2kg', NULL, 7, NULL, '2026-03-23 06:14:51', '2026-03-24 04:49:52'),
(14, 'Check new-2', 'check new category 2', 5.00, 300.00, NULL, NULL, 1, 1, 0, 'CHKN-2', '1200-1300 g,1400-1500 g', 'abc,def,nbc,fdc', 8, NULL, '2026-03-24 01:17:19', '2026-03-24 05:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `sort_order`, `is_primary`, `created_at`, `updated_at`) VALUES
(17, 2, '1774246454_0.jpg', 0, 1, '2026-03-23 00:44:14', '2026-03-23 00:44:14'),
(18, 2, '1774246454_1.jpg', 1, 0, '2026-03-23 00:44:14', '2026-03-23 00:44:14'),
(20, 1, '1774246601_0.jpg', 0, 1, '2026-03-23 00:46:41', '2026-03-23 00:46:41'),
(21, 1, '1774246601_1.jpg', 1, 0, '2026-03-23 00:46:41', '2026-03-23 00:46:41'),
(22, 1, '1774246601_2.jpg', 2, 0, '2026-03-23 00:46:41', '2026-03-23 00:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(2, 'Admin', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53'),
(3, 'User', 'web', '2026-03-10 18:23:53', '2026-03-10 18:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(1, 3),
(2, 3),
(6, 3),
(14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('D3mxtpYXkcEr5hRxjso9k5c8jp7IDpRmDPR1XDZn', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWJDQUR3Ukh2Mm9pTVJ6b09TdXlKVVBwWW0xYmMxNXFQNHFVdjlCNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1774355906);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `phone`, `address`) VALUES
(5, 'Super Admin', 'superadmin@store.com', NULL, '$2y$12$uPJ.4VGq.oxNycJJe/2BjOtx0daDNj8o12oJCPCaSoLVrtCa9exPS', NULL, '2026-03-10 23:57:19', '2026-03-10 23:57:19', 1, '+1234567890', '123 Store Street, City, Country'),
(6, 'Regular Admin', 'admin@store.com', NULL, '$2y$12$4E4KajP0S/vW5JYk0jb8F.pRYfTMlCP90/Nk402gKXnEEtVGbuASe', NULL, '2026-03-10 23:57:20', '2026-03-10 23:57:20', 1, '+1234567891', '456 Admin Street, City, Country'),
(21, 'Chinju', 'chinju@gmail.com', NULL, '$2y$12$4piY3mak94rtGHN5KkghdOF5jub97xhYNSzx8NLH4YVCvqPOASYGC', NULL, '2026-03-18 04:38:30', '2026-03-18 04:38:30', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_sort_order_index` (`product_id`,`sort_order`),
  ADD KEY `product_images_product_id_is_primary_index` (`product_id`,`is_primary`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
