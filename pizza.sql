-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 23, 2022 at 07:56 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
CREATE TABLE IF NOT EXISTS `about_us` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calzone_categries`
--

DROP TABLE IF EXISTS `calzone_categries`;
CREATE TABLE IF NOT EXISTS `calzone_categries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calzone_categries`
--

INSERT INTO `calzone_categries` (`id`, `name`, `price`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 0, '2022-03-07 08:55:34', '2022-03-07 08:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `calzone_sizes`
--

DROP TABLE IF EXISTS `calzone_sizes`;
CREATE TABLE IF NOT EXISTS `calzone_sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `add_size` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `parent_id`, `add_size`, `created_at`, `updated_at`) VALUES
(1, '/images/image/15871.png', 'Pizza', 0, 1, '2022-03-05 14:15:04', '2022-03-05 14:15:04'),
(2, '/images/image/52146.png', 'Calozone', 0, 0, '2022-03-05 14:18:01', '2022-03-05 14:18:01'),
(3, '/images/image/72011.png', 'Salads', 0, 0, '2022-03-05 14:18:36', '2022-03-05 14:18:36'),
(4, '/images/image/35613.png', 'Pasta', 0, 0, '2022-03-05 14:20:50', '2022-03-05 14:20:50'),
(5, '/images/image/36854.png', 'Appetiser', 0, 0, '2022-03-05 14:21:33', '2022-03-05 14:21:33'),
(6, '/images/image/84234.png', 'Baked-Subs', 0, 0, '2022-03-05 14:22:46', '2022-03-05 14:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int UNSIGNED DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_state_id_foreign` (`state_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_replay` tinyint(1) NOT NULL DEFAULT '0',
  `replay_text` text COLLATE utf8mb4_unicode_ci,
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `day_product`
--

DROP TABLE IF EXISTS `day_product`;
CREATE TABLE IF NOT EXISTS `day_product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `day_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entrees`
--

DROP TABLE IF EXISTS `entrees`;
CREATE TABLE IF NOT EXISTS `entrees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entrees_products`
--

DROP TABLE IF EXISTS `entrees_products`;
CREATE TABLE IF NOT EXISTS `entrees_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `entrees_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entrees_products_entrees_id_foreign` (`entrees_id`),
  KEY `entrees_products_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

DROP TABLE IF EXISTS `extras`;
CREATE TABLE IF NOT EXISTS `extras` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `extras_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `name`, `price`, `product_id`, `created_at`, `updated_at`) VALUES
(12, 'olive', '1', 1, '2022-03-07 09:56:31', '2022-03-07 09:56:31'),
(11, 'mozelia cheeze', '2', 1, '2022-03-07 09:56:31', '2022-03-07 09:56:31'),
(10, 'mashroum', '3', 1, '2022-03-07 09:56:31', '2022-03-07 09:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_mangers`
--

DROP TABLE IF EXISTS `file_mangers`;
CREATE TABLE IF NOT EXISTS `file_mangers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('photo','file') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'photo',
  `table_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_big` tinyint(1) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  `photo_caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_mangers`
--

INSERT INTO `file_mangers` (`id`, `name`, `file_name`, `type`, `table_type`, `is_big`, `is_main`, `photo_caption`, `tags`, `created_at`, `updated_at`) VALUES
(2, '52843.png', '/images/image/52843.png', 'photo', NULL, NULL, NULL, 'logo.png', NULL, '2022-03-05 13:39:51', '2022-03-05 13:39:51'),
(3, '15871.png', '/images/image/15871.png', 'photo', NULL, NULL, NULL, 'pizza.png', NULL, '2022-03-05 14:14:29', '2022-03-05 14:14:29'),
(4, '81466.png', '/images/image/81466.png', 'photo', NULL, NULL, NULL, '12inch.png', NULL, '2022-03-05 14:17:23', '2022-03-05 14:17:23'),
(5, '78602.png', '/images/image/78602.png', 'photo', NULL, NULL, NULL, '10inch.png', NULL, '2022-03-05 14:17:23', '2022-03-05 14:17:23'),
(6, '33183.png', '/images/image/33183.png', 'photo', NULL, NULL, NULL, '14inch.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(7, '55479.png', '/images/image/55479.png', 'photo', NULL, NULL, NULL, '18inch.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(8, '19488.png', '/images/image/19488.png', 'photo', NULL, NULL, NULL, 'add2.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(9, '88983.png', '/images/image/88983.png', 'photo', NULL, NULL, NULL, 'add1.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(10, '96090.png', '/images/image/96090.png', 'photo', NULL, NULL, NULL, 'add3.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(11, '98206.png', '/images/image/98206.png', 'photo', NULL, NULL, NULL, 'add4.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(12, '14309.png', '/images/image/14309.png', 'photo', NULL, NULL, NULL, 'Baked-Subs.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(13, '36854.png', '/images/image/36854.png', 'photo', NULL, NULL, NULL, 'Appetiser.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(14, '52146.png', '/images/image/52146.png', 'photo', NULL, NULL, NULL, 'Calzone.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(15, '10649.png', '/images/image/10649.png', 'photo', NULL, NULL, NULL, 'cart1.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(16, '52075.png', '/images/image/52075.png', 'photo', NULL, NULL, NULL, 'cart3.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(17, '63304.png', '/images/image/63304.png', 'photo', NULL, NULL, NULL, 'cart2.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(18, '15240.png', '/images/image/15240.png', 'photo', NULL, NULL, NULL, 'check.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(19, '77359.png', '/images/image/77359.png', 'photo', NULL, NULL, NULL, 'clock.png', NULL, '2022-03-05 14:17:24', '2022-03-05 14:17:24'),
(20, '68745.png', '/images/image/68745.png', 'photo', NULL, NULL, NULL, 'cloth.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(21, '19860.png', '/images/image/19860.png', 'photo', NULL, NULL, NULL, 'delivery.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(22, '71402.png', '/images/image/71402.png', 'photo', NULL, NULL, NULL, 'location.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(23, '11198.png', '/images/image/11198.png', 'photo', NULL, NULL, NULL, 'email.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(24, '97279.png', '/images/image/97279.png', 'photo', NULL, NULL, NULL, 'logo.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(25, '57080.png', '/images/image/57080.png', 'photo', NULL, NULL, NULL, 'map.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(26, '23961.png', '/images/image/23961.png', 'photo', NULL, NULL, NULL, 'p1.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(27, '66330.png', '/images/image/66330.png', 'photo', NULL, NULL, NULL, 'p2.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(28, '67583.png', '/images/image/67583.png', 'photo', NULL, NULL, NULL, 'p3.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(29, '61673.png', '/images/image/61673.png', 'photo', NULL, NULL, NULL, 'p4.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(30, '44219.png', '/images/image/44219.png', 'photo', NULL, NULL, NULL, 'p5.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(31, '98979.png', '/images/image/98979.png', 'photo', NULL, NULL, NULL, 'p6.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(32, '76619.png', '/images/image/76619.png', 'photo', NULL, NULL, NULL, 'p7.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(33, '91420.png', '/images/image/91420.png', 'photo', NULL, NULL, NULL, 'Pasta.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(34, '95324.png', '/images/image/95324.png', 'photo', NULL, NULL, NULL, 'payment2.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(35, '95964.png', '/images/image/95964.png', 'photo', NULL, NULL, NULL, 'payment3.png', NULL, '2022-03-05 14:17:25', '2022-03-05 14:17:25'),
(36, '11832.png', '/images/image/11832.png', 'photo', NULL, NULL, NULL, 'payment4.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(37, '89933.png', '/images/image/89933.png', 'photo', NULL, NULL, NULL, 'phone.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(38, '75761.png', '/images/image/75761.png', 'photo', NULL, NULL, NULL, 'piza-logo.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(39, '48512.png', '/images/image/48512.png', 'photo', NULL, NULL, NULL, 'pizza.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(40, '35571.png', '/images/image/35571.png', 'photo', NULL, NULL, NULL, 'pizza-build.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(41, '72299.png', '/images/image/72299.png', 'photo', NULL, NULL, NULL, 'pizza-slice.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(42, '11563.png', '/images/image/11563.png', 'photo', NULL, NULL, NULL, 'pizza-slice-1.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(43, '72371.png', '/images/image/72371.png', 'photo', NULL, NULL, NULL, 'radio-dot-1.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(44, '72011.png', '/images/image/72011.png', 'photo', NULL, NULL, NULL, 'Salads.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(45, '31810.png', '/images/image/31810.png', 'photo', NULL, NULL, NULL, 'take-away.png', NULL, '2022-03-05 14:17:26', '2022-03-05 14:17:26'),
(46, '35613.png', '/images/image/35613.png', 'photo', NULL, NULL, NULL, 'Pasta.png', NULL, '2022-03-05 14:20:46', '2022-03-05 14:20:46'),
(47, '84234.png', '/images/image/84234.png', 'photo', NULL, NULL, NULL, 'Baked-Subs.png', NULL, '2022-03-05 14:22:27', '2022-03-05 14:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `general_sizes`
--

DROP TABLE IF EXISTS `general_sizes`;
CREATE TABLE IF NOT EXISTS `general_sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `general_sizes_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_sizes`
--

INSERT INTO `general_sizes` (`id`, `size`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, '2022-03-05 14:15:04', '2022-03-05 14:15:04'),
(2, NULL, NULL, 2, '2022-03-05 14:18:01', '2022-03-05 14:18:01'),
(3, NULL, NULL, 3, '2022-03-05 14:18:36', '2022-03-05 14:18:36'),
(4, NULL, NULL, 4, '2022-03-05 14:20:50', '2022-03-05 14:20:50'),
(5, NULL, NULL, 5, '2022-03-05 14:21:33', '2022-03-05 14:21:33'),
(6, NULL, NULL, 6, '2022-03-05 14:22:46', '2022-03-05 14:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'cheeze', '2022-03-05 14:23:32', '2022-03-05 14:23:32'),
(2, 'onions', '2022-03-05 14:23:40', '2022-03-05 14:23:40'),
(3, 'chicken', '2022-03-05 14:23:49', '2022-03-05 14:23:49'),
(4, 'green paper', '2022-03-05 14:24:02', '2022-03-05 14:24:02'),
(5, 'black olive', '2022-03-05 14:24:12', '2022-03-05 14:24:12'),
(6, 'green olive', '2022-03-05 14:24:24', '2022-03-05 14:24:24'),
(7, 'bread', '2022-03-07 08:47:26', '2022-03-07 08:47:26'),
(8, 'meat', '2022-03-07 08:47:33', '2022-03-07 08:47:33'),
(9, 'paprika', '2022-03-07 08:48:02', '2022-03-07 08:48:02'),
(10, 'lettuce', '2022-03-07 08:48:42', '2022-03-07 08:48:42'),
(11, 'lettuce', '2022-03-07 08:48:45', '2022-03-07 08:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_product`
--

DROP TABLE IF EXISTS `ingredient_product`;
CREATE TABLE IF NOT EXISTS `ingredient_product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingredient_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_product`
--

INSERT INTO `ingredient_product` (`id`, `ingredient_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 4, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(5, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-active',
  `is_delivery` bigint NOT NULL DEFAULT '0',
  `is_takeaway` bigint NOT NULL DEFAULT '0',
  `person_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_person_id_foreign` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_06_090352_create_file_mangers_table', 1),
(5, '2020_08_12_082805_create_settings_table', 1),
(6, '2020_08_12_115723_create_about_us_table', 1),
(7, '2020_08_16_115204_create_contact_us_table', 1),
(8, '2020_08_29_065309_create_products_table', 1),
(9, '2020_08_29_093430_create_categories_table', 1),
(10, '2020_08_29_164201_create_extras_table', 1),
(11, '2020_08_31_092956_create_days_table', 1),
(12, '2020_08_31_095740_create_ingredients_table', 1),
(13, '2020_08_31_102009_create_day_product_table', 1),
(14, '2020_08_31_154403_create_ingredient_product_table', 1),
(15, '2020_09_19_170351_create_terms_table', 1),
(16, '2020_09_20_102027_create_sizes_table', 1),
(17, '2020_09_20_110402_create_entrees_table', 1),
(18, '2020_09_21_082442_create_entrees_products_table', 1),
(19, '2020_09_23_075858_create_general_sizes_table', 1),
(20, '2020_09_23_082812_create_pizza_categories_table', 1),
(21, '2020_09_23_092447_create_pizza_sizes_table', 1),
(22, '2020_09_25_144228_create_toppings_table', 1),
(23, '2020_09_29_121303_create_coupons_table', 1),
(24, '2020_10_05_125233_create_payment_methods_table', 1),
(25, '2020_10_06_074459_create_states_table', 1),
(26, '2020_10_06_081813_create_cities_table', 1),
(27, '2020_10_08_072424_create_orders_table', 1),
(28, '2020_10_08_090408_create_order_pizza_sizes_table', 1),
(29, '2020_10_08_090816_create_order_pizza_extras_table', 1),
(30, '2020_10_08_091110_create_order_special_pizza_sizes_table', 1),
(31, '2020_10_08_091414_create_order_special_pizza_types_table', 1),
(32, '2020_10_08_101942_create_people_table', 1),
(33, '2020_10_11_182107_create_invoices_table', 1),
(34, '2020_10_26_074206_create_calzone_categries_table', 1),
(35, '2020_10_26_074308_create_calzone_sizes_table', 1),
(36, '2020_10_27_092720_create_zip_codes_table', 1),
(37, '2020_10_31_140357_create_payments_table', 1),
(38, '2020_10_31_185836_create_payment_logs_table', 1),
(39, '2020_11_02_204326_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int UNSIGNED DEFAULT NULL,
  `person_id` int UNSIGNED DEFAULT NULL,
  `order_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-active',
  `instructions` longtext COLLATE utf8mb4_unicode_ci,
  `quantity` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_product_id_foreign` (`product_id`),
  KEY `orders_person_id_foreign` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_pizza_extras`
--

DROP TABLE IF EXISTS `order_pizza_extras`;
CREATE TABLE IF NOT EXISTS `order_pizza_extras` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int UNSIGNED DEFAULT NULL,
  `product_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_pizza_extras_order_id_foreign` (`order_id`),
  KEY `order_pizza_extras_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_pizza_sizes`
--

DROP TABLE IF EXISTS `order_pizza_sizes`;
CREATE TABLE IF NOT EXISTS `order_pizza_sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int UNSIGNED DEFAULT NULL,
  `product_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_pizza_sizes_order_id_foreign` (`order_id`),
  KEY `order_pizza_sizes_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_special_pizza_sizes`
--

DROP TABLE IF EXISTS `order_special_pizza_sizes`;
CREATE TABLE IF NOT EXISTS `order_special_pizza_sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int UNSIGNED DEFAULT NULL,
  `product_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_special_pizza_sizes_order_id_foreign` (`order_id`),
  KEY `order_special_pizza_sizes_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_special_pizza_types`
--

DROP TABLE IF EXISTS `order_special_pizza_types`;
CREATE TABLE IF NOT EXISTS `order_special_pizza_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int UNSIGNED DEFAULT NULL,
  `product_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_special_pizza_types_order_id_foreign` (`order_id`),
  KEY `order_special_pizza_types_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

DROP TABLE IF EXISTS `payment_logs`;
CREATE TABLE IF NOT EXISTS `payment_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` double(8,2) NOT NULL,
  `name_on_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-active',
  `state_id` int UNSIGNED DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `people_state_id_foreign` (`state_id`),
  KEY `people_city_id_foreign` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizza_categories`
--

DROP TABLE IF EXISTS `pizza_categories`;
CREATE TABLE IF NOT EXISTS `pizza_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `required` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-required',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pizza_categories`
--

INSERT INTO `pizza_categories` (`id`, `name`, `price`, `parent_id`, `required`, `created_at`, `updated_at`) VALUES
(2, 'cheeze', NULL, 0, 'not-required', '2022-03-07 08:56:03', '2022-03-07 08:56:03'),
(3, 'mozelia', '5', 2, 'not_required', '2022-03-07 08:56:18', '2022-03-07 08:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_sizes`
--

DROP TABLE IF EXISTS `pizza_sizes`;
CREATE TABLE IF NOT EXISTS `pizza_sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pizza_sizes`
--

INSERT INTO `pizza_sizes` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, '12 inch', '5', '2022-03-07 08:49:54', '2022-03-07 08:49:54'),
(2, '16 inch', '8', '2022-03-07 08:50:07', '2022-03-07 08:50:31'),
(3, '18 inch', '12', '2022-03-07 08:50:22', '2022-03-07 08:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int UNSIGNED DEFAULT NULL,
  `ingredients` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_special` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `ingredients`, `image`, `description`, `is_special`, `created_at`, `updated_at`) VALUES
(1, 'pizza', '1', 1, NULL, '/images/image/33183.png', 'cheeze , mashroum , black olive ,', 0, '2022-03-07 09:00:57', '2022-03-07 09:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_bio` longtext COLLATE utf8mb4_unicode_ci,
  `iframe` longtext COLLATE utf8mb4_unicode_ci,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linked_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_website_description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `website_name`, `about_us_title`, `website_bio`, `iframe`, `logo`, `favicon`, `mobile_1`, `mobile_2`, `mobile_3`, `address_1`, `address_2`, `facebook`, `instagram`, `twitter`, `linked_in`, `seo_keyword`, `time_from`, `time_to`, `delivery_cost`, `currency`, `tax`, `seo_website_description`, `created_at`, `updated_at`) VALUES
(1, 'florence-pizza@gmail.com', 'florence-pizza', NULL, NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d408613.09192975913!2d174.9863076009309!3d-36.85948204413637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d0d47fb5a9ce6fb%3A0x500ef6143a29917!2z2KPZiNmD2YTYp9mG2K_YjCDZhtmK2YjYstmK2YTZhtiv2Kc!5e0!3m2!1sar!2s!4v1646496749231!5m2!1sar!2s\" width=\"550\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '/images/image/52843.png', '/images/image/52843.png', '(1700)  400  400', NULL, NULL, 'Palestine, Ramallah \n\nErsal street, al-Safa Buliding', NULL, NULL, NULL, NULL, NULL, 'florence-pizza', '8:00', '12:00', '3', '$', '4', 'florence-pizza', NULL, '2022-03-05 14:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sizes_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `price`, `image`, `product_id`, `created_at`, `updated_at`) VALUES
(12, '18 inch', '12', '/images/image/55479.png', 1, '2022-03-07 09:56:31', '2022-03-07 09:56:31'),
(11, '14 inch', '10', '/images/image/33183.png', 1, '2022-03-07 09:56:31', '2022-03-07 09:56:31'),
(10, '12 inch', '7', '/images/image/61673.png', 1, '2022-03-07 09:56:31', '2022-03-07 09:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
CREATE TABLE IF NOT EXISTS `terms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

DROP TABLE IF EXISTS `toppings`;
CREATE TABLE IF NOT EXISTS `toppings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '/images/image/75761.png', NULL, '$2y$10$x73nDArGZOapQhBoKPr7B.lfipxFz7t9n14fGKhPy6hQ8OfDVLQMy', 'kqBVVx58KfvQmNT1bWf5fM4PMXt73WGogKahH2nvlqNbvVOEgGLgxpPywMKS', '2022-03-05 13:29:39', '2022-03-07 08:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `zip_codes`
--

DROP TABLE IF EXISTS `zip_codes`;
CREATE TABLE IF NOT EXISTS `zip_codes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id` int UNSIGNED DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zip_codes_city_id_foreign` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
