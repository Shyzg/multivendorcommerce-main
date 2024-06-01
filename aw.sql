-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 30, 2024 at 03:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `vendor_id`, `mobile`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Yahya', 'superadmin', 0, '9800000000', 'admin@admin.com', '$2a$12$xvkjSScUPRexfcJTAy9ATutIeGUuRgJrjDIdL/.xlrddEvRZINpeC', '', NULL, NULL),
(2, 'Jero', 'vendor', 1, '9700000000', 'jero@gmail.com', '$2a$12$xvkjSScUPRexfcJTAy9ATutIeGUuRgJrjDIdL/.xlrddEvRZINpeC', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_discount` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Makanan', '', 0, '', 'makanan', NULL, NULL),
(2, 1, 'Minuman', '', 0, '', 'minuman', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `province_id`, `city_id`, `type`, `postal_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 'Kabupaten', '80351', 'Kabupaten Badung', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(2, 1, 32, 'Kabupaten', '80619', 'Kabupaten Bangli', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(3, 1, 94, 'Kabupaten', '81111', 'Kabupaten Buleleng', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(4, 1, 114, 'Kota', '80227', 'Kota Denpasar', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(5, 1, 128, 'Kabupaten', '80519', 'Kabupaten Gianyar', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(6, 1, 161, 'Kabupaten', '82251', 'Kabupaten Jembrana', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(7, 1, 170, 'Kabupaten', '80819', 'Kabupaten Karangasem', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(8, 1, 197, 'Kabupaten', '80719', 'Kabupaten Klungkung', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(9, 1, 447, 'Kabupaten', '82119', 'Kabupaten Tabanan', '2024-05-29 18:17:12', '2024-05-29 18:17:12'),
(10, 2, 27, 'Kabupaten', '33212', 'Kabupaten Bangka', '2024-05-29 18:17:13', '2024-05-29 18:17:13'),
(11, 2, 28, 'Kabupaten', '33315', 'Kabupaten Bangka Barat', '2024-05-29 18:17:13', '2024-05-29 18:17:13'),
(12, 2, 29, 'Kabupaten', '33719', 'Kabupaten Bangka Selatan', '2024-05-29 18:17:13', '2024-05-29 18:17:13'),
(13, 2, 30, 'Kabupaten', '33613', 'Kabupaten Bangka Tengah', '2024-05-29 18:17:13', '2024-05-29 18:17:13'),
(14, 2, 56, 'Kabupaten', '33419', 'Kabupaten Belitung', '2024-05-29 18:17:13', '2024-05-29 18:17:13'),
(15, 2, 57, 'Kabupaten', '33519', 'Kabupaten Belitung Timur', '2024-05-29 18:17:13', '2024-05-29 18:17:13'),
(16, 2, 334, 'Kota', '33115', 'Kota Pangkal Pinang', '2024-05-29 18:17:13', '2024-05-29 18:17:13'),
(17, 3, 106, 'Kota', '42417', 'Kota Cilegon', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(18, 3, 232, 'Kabupaten', '42319', 'Kabupaten Lebak', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(19, 3, 331, 'Kabupaten', '42212', 'Kabupaten Pandeglang', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(20, 3, 402, 'Kabupaten', '42182', 'Kabupaten Serang', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(21, 3, 403, 'Kota', '42111', 'Kota Serang', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(22, 3, 455, 'Kabupaten', '15914', 'Kabupaten Tangerang', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(23, 3, 456, 'Kota', '15111', 'Kota Tangerang', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(24, 3, 457, 'Kota', '15435', 'Kota Tangerang Selatan', '2024-05-29 18:17:14', '2024-05-29 18:17:14'),
(25, 4, 62, 'Kota', '38229', 'Kota Bengkulu', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(26, 4, 63, 'Kabupaten', '38519', 'Kabupaten Bengkulu Selatan', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(27, 4, 64, 'Kabupaten', '38319', 'Kabupaten Bengkulu Tengah', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(28, 4, 65, 'Kabupaten', '38619', 'Kabupaten Bengkulu Utara', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(29, 4, 175, 'Kabupaten', '38911', 'Kabupaten Kaur', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(30, 4, 183, 'Kabupaten', '39319', 'Kabupaten Kepahiang', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(31, 4, 233, 'Kabupaten', '39264', 'Kabupaten Lebong', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(32, 4, 294, 'Kabupaten', '38715', 'Kabupaten Muko Muko', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(33, 4, 379, 'Kabupaten', '39112', 'Kabupaten Rejang Lebong', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(34, 4, 397, 'Kabupaten', '38811', 'Kabupaten Seluma', '2024-05-29 18:17:16', '2024-05-29 18:17:16'),
(35, 5, 39, 'Kabupaten', '55715', 'Kabupaten Bantul', '2024-05-29 18:17:17', '2024-05-29 18:17:17'),
(36, 5, 135, 'Kabupaten', '55812', 'Kabupaten Gunung Kidul', '2024-05-29 18:17:17', '2024-05-29 18:17:17'),
(37, 5, 210, 'Kabupaten', '55611', 'Kabupaten Kulon Progo', '2024-05-29 18:17:17', '2024-05-29 18:17:17'),
(38, 5, 419, 'Kabupaten', '55513', 'Kabupaten Sleman', '2024-05-29 18:17:17', '2024-05-29 18:17:17'),
(39, 5, 501, 'Kota', '55111', 'Kota Yogyakarta', '2024-05-29 18:17:17', '2024-05-29 18:17:17'),
(40, 6, 151, 'Kota', '11220', 'Kota Jakarta Barat', '2024-05-29 18:17:18', '2024-05-29 18:17:18'),
(41, 6, 152, 'Kota', '10540', 'Kota Jakarta Pusat', '2024-05-29 18:17:18', '2024-05-29 18:17:18'),
(42, 6, 153, 'Kota', '12230', 'Kota Jakarta Selatan', '2024-05-29 18:17:18', '2024-05-29 18:17:18'),
(43, 6, 154, 'Kota', '13330', 'Kota Jakarta Timur', '2024-05-29 18:17:18', '2024-05-29 18:17:18'),
(44, 6, 155, 'Kota', '14140', 'Kota Jakarta Utara', '2024-05-29 18:17:18', '2024-05-29 18:17:18'),
(45, 6, 189, 'Kabupaten', '14550', 'Kabupaten Kepulauan Seribu', '2024-05-29 18:17:18', '2024-05-29 18:17:18'),
(46, 7, 77, 'Kabupaten', '96319', 'Kabupaten Boalemo', '2024-05-29 18:17:19', '2024-05-29 18:17:19'),
(47, 7, 88, 'Kabupaten', '96511', 'Kabupaten Bone Bolango', '2024-05-29 18:17:19', '2024-05-29 18:17:19'),
(48, 7, 129, 'Kabupaten', '96218', 'Kabupaten Gorontalo', '2024-05-29 18:17:19', '2024-05-29 18:17:19'),
(49, 7, 130, 'Kota', '96115', 'Kota Gorontalo', '2024-05-29 18:17:19', '2024-05-29 18:17:19'),
(50, 7, 131, 'Kabupaten', '96611', 'Kabupaten Gorontalo Utara', '2024-05-29 18:17:19', '2024-05-29 18:17:19'),
(51, 7, 361, 'Kabupaten', '96419', 'Kabupaten Pohuwato', '2024-05-29 18:17:19', '2024-05-29 18:17:19'),
(52, 8, 50, 'Kabupaten', '36613', 'Kabupaten Batang Hari', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(53, 8, 97, 'Kabupaten', '37216', 'Kabupaten Bungo', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(54, 8, 156, 'Kota', '36111', 'Kota Jambi', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(55, 8, 194, 'Kabupaten', '37167', 'Kabupaten Kerinci', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(56, 8, 280, 'Kabupaten', '37319', 'Kabupaten Merangin', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(57, 8, 293, 'Kabupaten', '36311', 'Kabupaten Muaro Jambi', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(58, 8, 393, 'Kabupaten', '37419', 'Kabupaten Sarolangun', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(59, 8, 442, 'Kota', '37113', 'Kota Sungaipenuh', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(60, 8, 460, 'Kabupaten', '36513', 'Kabupaten Tanjung Jabung Barat', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(61, 8, 461, 'Kabupaten', '36719', 'Kabupaten Tanjung Jabung Timur', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(62, 8, 471, 'Kabupaten', '37519', 'Kabupaten Tebo', '2024-05-29 18:17:21', '2024-05-29 18:17:21'),
(63, 9, 22, 'Kabupaten', '40311', 'Kabupaten Bandung', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(64, 9, 23, 'Kota', '40111', 'Kota Bandung', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(65, 9, 24, 'Kabupaten', '40721', 'Kabupaten Bandung Barat', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(66, 9, 34, 'Kota', '46311', 'Kota Banjar', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(67, 9, 54, 'Kabupaten', '17837', 'Kabupaten Bekasi', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(68, 9, 55, 'Kota', '17121', 'Kota Bekasi', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(69, 9, 78, 'Kabupaten', '16911', 'Kabupaten Bogor', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(70, 9, 79, 'Kota', '16119', 'Kota Bogor', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(71, 9, 103, 'Kabupaten', '46211', 'Kabupaten Ciamis', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(72, 9, 104, 'Kabupaten', '43217', 'Kabupaten Cianjur', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(73, 9, 107, 'Kota', '40512', 'Kota Cimahi', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(74, 9, 108, 'Kabupaten', '45611', 'Kabupaten Cirebon', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(75, 9, 109, 'Kota', '45116', 'Kota Cirebon', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(76, 9, 115, 'Kota', '16416', 'Kota Depok', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(77, 9, 126, 'Kabupaten', '44126', 'Kabupaten Garut', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(78, 9, 149, 'Kabupaten', '45214', 'Kabupaten Indramayu', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(79, 9, 171, 'Kabupaten', '41311', 'Kabupaten Karawang', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(80, 9, 211, 'Kabupaten', '45511', 'Kabupaten Kuningan', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(81, 9, 252, 'Kabupaten', '45412', 'Kabupaten Majalengka', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(82, 9, 332, 'Kabupaten', '46511', 'Kabupaten Pangandaran', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(83, 9, 376, 'Kabupaten', '41119', 'Kabupaten Purwakarta', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(84, 9, 428, 'Kabupaten', '41215', 'Kabupaten Subang', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(85, 9, 430, 'Kabupaten', '43311', 'Kabupaten Sukabumi', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(86, 9, 431, 'Kota', '43114', 'Kota Sukabumi', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(87, 9, 440, 'Kabupaten', '45326', 'Kabupaten Sumedang', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(88, 9, 468, 'Kabupaten', '46411', 'Kabupaten Tasikmalaya', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(89, 9, 469, 'Kota', '46116', 'Kota Tasikmalaya', '2024-05-29 18:17:22', '2024-05-29 18:17:22'),
(90, 10, 37, 'Kabupaten', '53419', 'Kabupaten Banjarnegara', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(91, 10, 41, 'Kabupaten', '53114', 'Kabupaten Banyumas', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(92, 10, 49, 'Kabupaten', '51211', 'Kabupaten Batang', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(93, 10, 76, 'Kabupaten', '58219', 'Kabupaten Blora', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(94, 10, 91, 'Kabupaten', '57312', 'Kabupaten Boyolali', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(95, 10, 92, 'Kabupaten', '52212', 'Kabupaten Brebes', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(96, 10, 105, 'Kabupaten', '53211', 'Kabupaten Cilacap', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(97, 10, 113, 'Kabupaten', '59519', 'Kabupaten Demak', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(98, 10, 134, 'Kabupaten', '58111', 'Kabupaten Grobogan', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(99, 10, 163, 'Kabupaten', '59419', 'Kabupaten Jepara', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(100, 10, 169, 'Kabupaten', '57718', 'Kabupaten Karanganyar', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(101, 10, 177, 'Kabupaten', '54319', 'Kabupaten Kebumen', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(102, 10, 181, 'Kabupaten', '51314', 'Kabupaten Kendal', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(103, 10, 196, 'Kabupaten', '57411', 'Kabupaten Klaten', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(104, 10, 209, 'Kabupaten', '59311', 'Kabupaten Kudus', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(105, 10, 249, 'Kabupaten', '56519', 'Kabupaten Magelang', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(106, 10, 250, 'Kota', '56133', 'Kota Magelang', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(107, 10, 344, 'Kabupaten', '59114', 'Kabupaten Pati', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(108, 10, 348, 'Kabupaten', '51161', 'Kabupaten Pekalongan', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(109, 10, 349, 'Kota', '51122', 'Kota Pekalongan', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(110, 10, 352, 'Kabupaten', '52319', 'Kabupaten Pemalang', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(111, 10, 375, 'Kabupaten', '53312', 'Kabupaten Purbalingga', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(112, 10, 377, 'Kabupaten', '54111', 'Kabupaten Purworejo', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(113, 10, 380, 'Kabupaten', '59219', 'Kabupaten Rembang', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(114, 10, 386, 'Kota', '50711', 'Kota Salatiga', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(115, 10, 398, 'Kabupaten', '50511', 'Kabupaten Semarang', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(116, 10, 399, 'Kota', '50135', 'Kota Semarang', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(117, 10, 427, 'Kabupaten', '57211', 'Kabupaten Sragen', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(118, 10, 433, 'Kabupaten', '57514', 'Kabupaten Sukoharjo', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(119, 10, 445, 'Kota', '57113', 'Kota Surakarta (Solo)', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(120, 10, 472, 'Kabupaten', '52419', 'Kabupaten Tegal', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(121, 10, 473, 'Kota', '52114', 'Kota Tegal', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(122, 10, 476, 'Kabupaten', '56212', 'Kabupaten Temanggung', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(123, 10, 497, 'Kabupaten', '57619', 'Kabupaten Wonogiri', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(124, 10, 498, 'Kabupaten', '56311', 'Kabupaten Wonosobo', '2024-05-29 18:17:23', '2024-05-29 18:17:23'),
(125, 11, 31, 'Kabupaten', '69118', 'Kabupaten Bangkalan', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(126, 11, 42, 'Kabupaten', '68416', 'Kabupaten Banyuwangi', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(127, 11, 51, 'Kota', '65311', 'Kota Batu', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(128, 11, 74, 'Kabupaten', '66171', 'Kabupaten Blitar', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(129, 11, 75, 'Kota', '66124', 'Kota Blitar', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(130, 11, 80, 'Kabupaten', '62119', 'Kabupaten Bojonegoro', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(131, 11, 86, 'Kabupaten', '68219', 'Kabupaten Bondowoso', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(132, 11, 133, 'Kabupaten', '61115', 'Kabupaten Gresik', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(133, 11, 160, 'Kabupaten', '68113', 'Kabupaten Jember', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(134, 11, 164, 'Kabupaten', '61415', 'Kabupaten Jombang', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(135, 11, 178, 'Kabupaten', '64184', 'Kabupaten Kediri', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(136, 11, 179, 'Kota', '64125', 'Kota Kediri', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(137, 11, 222, 'Kabupaten', '64125', 'Kabupaten Lamongan', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(138, 11, 243, 'Kabupaten', '67319', 'Kabupaten Lumajang', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(139, 11, 247, 'Kabupaten', '63153', 'Kabupaten Madiun', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(140, 11, 248, 'Kota', '63122', 'Kota Madiun', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(141, 11, 251, 'Kabupaten', '63314', 'Kabupaten Magetan', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(142, 11, 256, 'Kota', '65112', 'Kota Malang', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(143, 11, 255, 'Kabupaten', '65163', 'Kabupaten Malang', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(144, 11, 289, 'Kabupaten', '61382', 'Kabupaten Mojokerto', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(145, 11, 290, 'Kota', '61316', 'Kota Mojokerto', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(146, 11, 305, 'Kabupaten', '64414', 'Kabupaten Nganjuk', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(147, 11, 306, 'Kabupaten', '63219', 'Kabupaten Ngawi', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(148, 11, 317, 'Kabupaten', '63512', 'Kabupaten Pacitan', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(149, 11, 330, 'Kabupaten', '69319', 'Kabupaten Pamekasan', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(150, 11, 342, 'Kabupaten', '67153', 'Kabupaten Pasuruan', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(151, 11, 343, 'Kota', '67118', 'Kota Pasuruan', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(152, 11, 363, 'Kabupaten', '63411', 'Kabupaten Ponorogo', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(153, 11, 369, 'Kabupaten', '67282', 'Kabupaten Probolinggo', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(154, 11, 370, 'Kota', '67215', 'Kota Probolinggo', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(155, 11, 390, 'Kabupaten', '69219', 'Kabupaten Sampang', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(156, 11, 409, 'Kabupaten', '61219', 'Kabupaten Sidoarjo', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(157, 11, 418, 'Kabupaten', '68316', 'Kabupaten Situbondo', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(158, 11, 441, 'Kabupaten', '69413', 'Kabupaten Sumenep', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(159, 11, 444, 'Kota', '60119', 'Kota Surabaya', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(160, 11, 487, 'Kabupaten', '66312', 'Kabupaten Trenggalek', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(161, 11, 489, 'Kabupaten', '62319', 'Kabupaten Tuban', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(162, 11, 492, 'Kabupaten', '66212', 'Kabupaten Tulungagung', '2024-05-29 18:17:25', '2024-05-29 18:17:25'),
(163, 12, 61, 'Kabupaten', '79213', 'Kabupaten Bengkayang', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(164, 12, 168, 'Kabupaten', '78719', 'Kabupaten Kapuas Hulu', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(165, 12, 176, 'Kabupaten', '78852', 'Kabupaten Kayong Utara', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(166, 12, 195, 'Kabupaten', '78874', 'Kabupaten Ketapang', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(167, 12, 208, 'Kabupaten', '78311', 'Kabupaten Kubu Raya', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(168, 12, 228, 'Kabupaten', '78319', 'Kabupaten Landak', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(169, 12, 279, 'Kabupaten', '78619', 'Kabupaten Melawi', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(170, 12, 364, 'Kabupaten', '78971', 'Kabupaten Pontianak', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(171, 12, 365, 'Kota', '78112', 'Kota Pontianak', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(172, 12, 388, 'Kabupaten', '79453', 'Kabupaten Sambas', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(173, 12, 391, 'Kabupaten', '78557', 'Kabupaten Sanggau', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(174, 12, 395, 'Kabupaten', '79583', 'Kabupaten Sekadau', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(175, 12, 415, 'Kota', '79117', 'Kota Singkawang', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(176, 12, 417, 'Kabupaten', '78619', 'Kabupaten Sintang', '2024-05-29 18:17:26', '2024-05-29 18:17:26'),
(177, 13, 18, 'Kabupaten', '71611', 'Kabupaten Balangan', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(178, 13, 33, 'Kabupaten', '70619', 'Kabupaten Banjar', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(179, 13, 35, 'Kota', '70712', 'Kota Banjarbaru', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(180, 13, 36, 'Kota', '70117', 'Kota Banjarmasin', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(181, 13, 43, 'Kabupaten', '70511', 'Kabupaten Barito Kuala', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(182, 13, 143, 'Kabupaten', '71212', 'Kabupaten Hulu Sungai Selatan', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(183, 13, 144, 'Kabupaten', '71313', 'Kabupaten Hulu Sungai Tengah', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(184, 13, 145, 'Kabupaten', '71419', 'Kabupaten Hulu Sungai Utara', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(185, 13, 203, 'Kabupaten', '72119', 'Kabupaten Kotabaru', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(186, 13, 446, 'Kabupaten', '71513', 'Kabupaten Tabalong', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(187, 13, 452, 'Kabupaten', '72211', 'Kabupaten Tanah Bumbu', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(188, 13, 454, 'Kabupaten', '70811', 'Kabupaten Tanah Laut', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(189, 13, 466, 'Kabupaten', '71119', 'Kabupaten Tapin', '2024-05-29 18:17:27', '2024-05-29 18:17:27'),
(190, 14, 44, 'Kabupaten', '73711', 'Kabupaten Barito Selatan', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(191, 14, 45, 'Kabupaten', '73671', 'Kabupaten Barito Timur', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(192, 14, 46, 'Kabupaten', '73881', 'Kabupaten Barito Utara', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(193, 14, 136, 'Kabupaten', '74511', 'Kabupaten Gunung Mas', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(194, 14, 167, 'Kabupaten', '73583', 'Kabupaten Kapuas', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(195, 14, 174, 'Kabupaten', '74411', 'Kabupaten Katingan', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(196, 14, 205, 'Kabupaten', '74119', 'Kabupaten Kotawaringin Barat', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(197, 14, 206, 'Kabupaten', '74364', 'Kabupaten Kotawaringin Timur', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(198, 14, 221, 'Kabupaten', '74611', 'Kabupaten Lamandau', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(199, 14, 296, 'Kabupaten', '73911', 'Kabupaten Murung Raya', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(200, 14, 326, 'Kota', '73112', 'Kota Palangka Raya', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(201, 14, 371, 'Kabupaten', '74811', 'Kabupaten Pulang Pisau', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(202, 14, 405, 'Kabupaten', '74211', 'Kabupaten Seruyan', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(203, 14, 432, 'Kabupaten', '74712', 'Kabupaten Sukamara', '2024-05-29 18:17:28', '2024-05-29 18:17:28'),
(204, 15, 19, 'Kota', '76111', 'Kota Balikpapan', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(205, 15, 66, 'Kabupaten', '77311', 'Kabupaten Berau', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(206, 15, 89, 'Kota', '75313', 'Kota Bontang', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(207, 15, 214, 'Kabupaten', '75711', 'Kabupaten Kutai Barat', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(208, 15, 215, 'Kabupaten', '75511', 'Kabupaten Kutai Kartanegara', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(209, 15, 216, 'Kabupaten', '75611', 'Kabupaten Kutai Timur', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(210, 15, 341, 'Kabupaten', '76211', 'Kabupaten Paser', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(211, 15, 354, 'Kabupaten', '76311', 'Kabupaten Penajam Paser Utara', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(212, 15, 387, 'Kota', '75133', 'Kota Samarinda', '2024-05-29 18:17:30', '2024-05-29 18:17:30'),
(213, 16, 96, 'Kabupaten', '77211', 'Kabupaten Bulungan (Bulongan)', '2024-05-29 18:17:31', '2024-05-29 18:17:31'),
(214, 16, 257, 'Kabupaten', '77511', 'Kabupaten Malinau', '2024-05-29 18:17:31', '2024-05-29 18:17:31'),
(215, 16, 311, 'Kabupaten', '77421', 'Kabupaten Nunukan', '2024-05-29 18:17:31', '2024-05-29 18:17:31'),
(216, 16, 450, 'Kabupaten', '77611', 'Kabupaten Tana Tidung', '2024-05-29 18:17:31', '2024-05-29 18:17:31'),
(217, 16, 467, 'Kota', '77114', 'Kota Tarakan', '2024-05-29 18:17:31', '2024-05-29 18:17:31'),
(218, 17, 48, 'Kota', '29413', 'Kota Batam', '2024-05-29 18:17:32', '2024-05-29 18:17:32'),
(219, 17, 71, 'Kabupaten', '29135', 'Kabupaten Bintan', '2024-05-29 18:17:32', '2024-05-29 18:17:32'),
(220, 17, 172, 'Kabupaten', '29611', 'Kabupaten Karimun', '2024-05-29 18:17:32', '2024-05-29 18:17:32'),
(221, 17, 184, 'Kabupaten', '29991', 'Kabupaten Kepulauan Anambas', '2024-05-29 18:17:32', '2024-05-29 18:17:32'),
(222, 17, 237, 'Kabupaten', '29811', 'Kabupaten Lingga', '2024-05-29 18:17:32', '2024-05-29 18:17:32'),
(223, 17, 302, 'Kabupaten', '29711', 'Kabupaten Natuna', '2024-05-29 18:17:32', '2024-05-29 18:17:32'),
(224, 17, 462, 'Kota', '29111', 'Kota Tanjung Pinang', '2024-05-29 18:17:32', '2024-05-29 18:17:32'),
(225, 18, 21, 'Kota', '35139', 'Kota Bandar Lampung', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(226, 18, 223, 'Kabupaten', '34814', 'Kabupaten Lampung Barat', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(227, 18, 224, 'Kabupaten', '35511', 'Kabupaten Lampung Selatan', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(228, 18, 225, 'Kabupaten', '34212', 'Kabupaten Lampung Tengah', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(229, 18, 226, 'Kabupaten', '34319', 'Kabupaten Lampung Timur', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(230, 18, 227, 'Kabupaten', '34516', 'Kabupaten Lampung Utara', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(231, 18, 282, 'Kabupaten', '34911', 'Kabupaten Mesuji', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(232, 18, 283, 'Kota', '34111', 'Kota Metro', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(233, 18, 355, 'Kabupaten', '35312', 'Kabupaten Pesawaran', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(234, 18, 356, 'Kabupaten', '35974', 'Kabupaten Pesisir Barat', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(235, 18, 368, 'Kabupaten', '35719', 'Kabupaten Pringsewu', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(236, 18, 458, 'Kabupaten', '35619', 'Kabupaten Tanggamus', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(237, 18, 490, 'Kabupaten', '34613', 'Kabupaten Tulang Bawang', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(238, 18, 491, 'Kabupaten', '34419', 'Kabupaten Tulang Bawang Barat', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(239, 18, 496, 'Kabupaten', '34711', 'Kabupaten Way Kanan', '2024-05-29 18:17:33', '2024-05-29 18:17:33'),
(240, 19, 14, 'Kota', '97222', 'Kota Ambon', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(241, 19, 99, 'Kabupaten', '97371', 'Kabupaten Buru', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(242, 19, 100, 'Kabupaten', '97351', 'Kabupaten Buru Selatan', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(243, 19, 185, 'Kabupaten', '97681', 'Kabupaten Kepulauan Aru', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(244, 19, 258, 'Kabupaten', '97451', 'Kabupaten Maluku Barat Daya', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(245, 19, 259, 'Kabupaten', '97513', 'Kabupaten Maluku Tengah', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(246, 19, 260, 'Kabupaten', '97651', 'Kabupaten Maluku Tenggara', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(247, 19, 261, 'Kabupaten', '97465', 'Kabupaten Maluku Tenggara Barat', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(248, 19, 400, 'Kabupaten', '97561', 'Kabupaten Seram Bagian Barat', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(249, 19, 401, 'Kabupaten', '97581', 'Kabupaten Seram Bagian Timur', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(250, 19, 488, 'Kota', '97612', 'Kota Tual', '2024-05-29 18:17:35', '2024-05-29 18:17:35'),
(251, 20, 138, 'Kabupaten', '97757', 'Kabupaten Halmahera Barat', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(252, 20, 139, 'Kabupaten', '97911', 'Kabupaten Halmahera Selatan', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(253, 20, 140, 'Kabupaten', '97853', 'Kabupaten Halmahera Tengah', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(254, 20, 141, 'Kabupaten', '97862', 'Kabupaten Halmahera Timur', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(255, 20, 142, 'Kabupaten', '97762', 'Kabupaten Halmahera Utara', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(256, 20, 191, 'Kabupaten', '97995', 'Kabupaten Kepulauan Sula', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(257, 20, 372, 'Kabupaten', '97771', 'Kabupaten Pulau Morotai', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(258, 20, 477, 'Kota', '97714', 'Kota Ternate', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(259, 20, 478, 'Kota', '97815', 'Kota Tidore Kepulauan', '2024-05-29 18:17:36', '2024-05-29 18:17:36'),
(260, 21, 1, 'Kabupaten', '23681', 'Kabupaten Aceh Barat', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(261, 21, 2, 'Kabupaten', '23764', 'Kabupaten Aceh Barat Daya', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(262, 21, 3, 'Kabupaten', '23951', 'Kabupaten Aceh Besar', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(263, 21, 4, 'Kabupaten', '23654', 'Kabupaten Aceh Jaya', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(264, 21, 5, 'Kabupaten', '23719', 'Kabupaten Aceh Selatan', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(265, 21, 6, 'Kabupaten', '24785', 'Kabupaten Aceh Singkil', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(266, 21, 7, 'Kabupaten', '24476', 'Kabupaten Aceh Tamiang', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(267, 21, 8, 'Kabupaten', '24511', 'Kabupaten Aceh Tengah', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(268, 21, 9, 'Kabupaten', '24611', 'Kabupaten Aceh Tenggara', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(269, 21, 10, 'Kabupaten', '24454', 'Kabupaten Aceh Timur', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(270, 21, 11, 'Kabupaten', '24382', 'Kabupaten Aceh Utara', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(271, 21, 20, 'Kota', '23238', 'Kota Banda Aceh', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(272, 21, 59, 'Kabupaten', '24581', 'Kabupaten Bener Meriah', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(273, 21, 72, 'Kabupaten', '24219', 'Kabupaten Bireuen', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(274, 21, 127, 'Kabupaten', '24653', 'Kabupaten Gayo Lues', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(275, 21, 230, 'Kota', '24412', 'Kota Langsa', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(276, 21, 235, 'Kota', '24352', 'Kota Lhokseumawe', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(277, 21, 300, 'Kabupaten', '23674', 'Kabupaten Nagan Raya', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(278, 21, 358, 'Kabupaten', '24116', 'Kabupaten Pidie', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(279, 21, 359, 'Kabupaten', '24186', 'Kabupaten Pidie Jaya', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(280, 21, 384, 'Kota', '23512', 'Kota Sabang', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(281, 21, 414, 'Kabupaten', '23891', 'Kabupaten Simeulue', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(282, 21, 429, 'Kota', '24882', 'Kota Subulussalam', '2024-05-29 18:17:37', '2024-05-29 18:17:37'),
(283, 22, 68, 'Kabupaten', '84171', 'Kabupaten Bima', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(284, 22, 69, 'Kota', '84139', 'Kota Bima', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(285, 22, 118, 'Kabupaten', '84217', 'Kabupaten Dompu', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(286, 22, 238, 'Kabupaten', '83311', 'Kabupaten Lombok Barat', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(287, 22, 239, 'Kabupaten', '83511', 'Kabupaten Lombok Tengah', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(288, 22, 240, 'Kabupaten', '83612', 'Kabupaten Lombok Timur', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(289, 22, 241, 'Kabupaten', '83711', 'Kabupaten Lombok Utara', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(290, 22, 276, 'Kota', '83131', 'Kota Mataram', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(291, 22, 438, 'Kabupaten', '84315', 'Kabupaten Sumbawa', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(292, 22, 439, 'Kabupaten', '84419', 'Kabupaten Sumbawa Barat', '2024-05-29 18:17:38', '2024-05-29 18:17:38'),
(293, 23, 13, 'Kabupaten', '85811', 'Kabupaten Alor', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(294, 23, 58, 'Kabupaten', '85711', 'Kabupaten Belu', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(295, 23, 122, 'Kabupaten', '86351', 'Kabupaten Ende', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(296, 23, 125, 'Kabupaten', '86213', 'Kabupaten Flores Timur', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(297, 23, 212, 'Kabupaten', '85362', 'Kabupaten Kupang', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(298, 23, 213, 'Kota', '85119', 'Kota Kupang', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(299, 23, 234, 'Kabupaten', '86611', 'Kabupaten Lembata', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(300, 23, 269, 'Kabupaten', '86551', 'Kabupaten Manggarai', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(301, 23, 270, 'Kabupaten', '86711', 'Kabupaten Manggarai Barat', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(302, 23, 271, 'Kabupaten', '86811', 'Kabupaten Manggarai Timur', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(303, 23, 301, 'Kabupaten', '86911', 'Kabupaten Nagekeo', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(304, 23, 304, 'Kabupaten', '86413', 'Kabupaten Ngada', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(305, 23, 383, 'Kabupaten', '85982', 'Kabupaten Rote Ndao', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(306, 23, 385, 'Kabupaten', '85391', 'Kabupaten Sabu Raijua', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(307, 23, 412, 'Kabupaten', '86121', 'Kabupaten Sikka', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(308, 23, 434, 'Kabupaten', '87219', 'Kabupaten Sumba Barat', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(309, 23, 435, 'Kabupaten', '87453', 'Kabupaten Sumba Barat Daya', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(310, 23, 436, 'Kabupaten', '87358', 'Kabupaten Sumba Tengah', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(311, 23, 437, 'Kabupaten', '87112', 'Kabupaten Sumba Timur', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(312, 23, 479, 'Kabupaten', '85562', 'Kabupaten Timor Tengah Selatan', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(313, 23, 480, 'Kabupaten', '85612', 'Kabupaten Timor Tengah Utara', '2024-05-29 18:17:40', '2024-05-29 18:17:40'),
(314, 24, 16, 'Kabupaten', '99777', 'Kabupaten Asmat', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(315, 24, 67, 'Kabupaten', '98119', 'Kabupaten Biak Numfor', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(316, 24, 90, 'Kabupaten', '99662', 'Kabupaten Boven Digoel', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(317, 24, 111, 'Kabupaten', '98784', 'Kabupaten Deiyai (Deliyai)', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(318, 24, 117, 'Kabupaten', '98866', 'Kabupaten Dogiyai', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(319, 24, 150, 'Kabupaten', '98771', 'Kabupaten Intan Jaya', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(320, 24, 157, 'Kabupaten', '99352', 'Kabupaten Jayapura', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(321, 24, 158, 'Kota', '99114', 'Kota Jayapura', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(322, 24, 159, 'Kabupaten', '99511', 'Kabupaten Jayawijaya', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(323, 24, 180, 'Kabupaten', '99461', 'Kabupaten Keerom', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(324, 24, 193, 'Kabupaten', '98211', 'Kabupaten Kepulauan Yapen (Yapen Waropen)', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(325, 24, 231, 'Kabupaten', '99531', 'Kabupaten Lanny Jaya', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(326, 24, 263, 'Kabupaten', '99381', 'Kabupaten Mamberamo Raya', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(327, 24, 264, 'Kabupaten', '99553', 'Kabupaten Mamberamo Tengah', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(328, 24, 274, 'Kabupaten', '99853', 'Kabupaten Mappi', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(329, 24, 281, 'Kabupaten', '99613', 'Kabupaten Merauke', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(330, 24, 284, 'Kabupaten', '99962', 'Kabupaten Mimika', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(331, 24, 299, 'Kabupaten', '98816', 'Kabupaten Nabire', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(332, 24, 303, 'Kabupaten', '99541', 'Kabupaten Nduga', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(333, 24, 335, 'Kabupaten', '98765', 'Kabupaten Paniai', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(334, 24, 347, 'Kabupaten', '99573', 'Kabupaten Pegunungan Bintang', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(335, 24, 373, 'Kabupaten', '98981', 'Kabupaten Puncak', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(336, 24, 374, 'Kabupaten', '98979', 'Kabupaten Puncak Jaya', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(337, 24, 392, 'Kabupaten', '99373', 'Kabupaten Sarmi', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(338, 24, 443, 'Kabupaten', '98164', 'Kabupaten Supiori', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(339, 24, 484, 'Kabupaten', '99411', 'Kabupaten Tolikara', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(340, 24, 495, 'Kabupaten', '98269', 'Kabupaten Waropen', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(341, 24, 499, 'Kabupaten', '99041', 'Kabupaten Yahukimo', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(342, 24, 500, 'Kabupaten', '99481', 'Kabupaten Yalimo', '2024-05-29 18:17:41', '2024-05-29 18:17:41'),
(343, 25, 124, 'Kabupaten', '98651', 'Kabupaten Fakfak', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(344, 25, 165, 'Kabupaten', '98671', 'Kabupaten Kaimana', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(345, 25, 272, 'Kabupaten', '98311', 'Kabupaten Manokwari', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(346, 25, 273, 'Kabupaten', '98355', 'Kabupaten Manokwari Selatan', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(347, 25, 277, 'Kabupaten', '98051', 'Kabupaten Maybrat', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(348, 25, 346, 'Kabupaten', '98354', 'Kabupaten Pegunungan Arfak', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(349, 25, 378, 'Kabupaten', '98489', 'Kabupaten Raja Ampat', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(350, 25, 424, 'Kabupaten', '98431', 'Kabupaten Sorong', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(351, 25, 425, 'Kota', '98411', 'Kota Sorong', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(352, 25, 426, 'Kabupaten', '98454', 'Kabupaten Sorong Selatan', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(353, 25, 449, 'Kabupaten', '98475', 'Kabupaten Tambrauw', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(354, 25, 474, 'Kabupaten', '98551', 'Kabupaten Teluk Bintuni', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(355, 25, 475, 'Kabupaten', '98591', 'Kabupaten Teluk Wondama', '2024-05-29 18:17:42', '2024-05-29 18:17:42'),
(356, 26, 60, 'Kabupaten', '28719', 'Kabupaten Bengkalis', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(357, 26, 120, 'Kota', '28811', 'Kota Dumai', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(358, 26, 147, 'Kabupaten', '29212', 'Kabupaten Indragiri Hilir', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(359, 26, 148, 'Kabupaten', '29319', 'Kabupaten Indragiri Hulu', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(360, 26, 166, 'Kabupaten', '28411', 'Kabupaten Kampar', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(361, 26, 187, 'Kabupaten', '28791', 'Kabupaten Kepulauan Meranti', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(362, 26, 207, 'Kabupaten', '29519', 'Kabupaten Kuantan Singingi', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(363, 26, 350, 'Kota', '28112', 'Kota Pekanbaru', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(364, 26, 351, 'Kabupaten', '28311', 'Kabupaten Pelalawan', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(365, 26, 381, 'Kabupaten', '28992', 'Kabupaten Rokan Hilir', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(366, 26, 382, 'Kabupaten', '28511', 'Kabupaten Rokan Hulu', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(367, 26, 406, 'Kabupaten', '28623', 'Kabupaten Siak', '2024-05-29 18:17:44', '2024-05-29 18:17:44'),
(368, 27, 253, 'Kabupaten', '91411', 'Kabupaten Majene', '2024-05-29 18:17:46', '2024-05-29 18:17:46'),
(369, 27, 262, 'Kabupaten', '91362', 'Kabupaten Mamasa', '2024-05-29 18:17:46', '2024-05-29 18:17:46'),
(370, 27, 265, 'Kabupaten', '91519', 'Kabupaten Mamuju', '2024-05-29 18:17:46', '2024-05-29 18:17:46'),
(371, 27, 266, 'Kabupaten', '91571', 'Kabupaten Mamuju Utara', '2024-05-29 18:17:46', '2024-05-29 18:17:46'),
(372, 27, 362, 'Kabupaten', '91311', 'Kabupaten Polewali Mandar', '2024-05-29 18:17:46', '2024-05-29 18:17:46'),
(373, 28, 38, 'Kabupaten', '92411', 'Kabupaten Bantaeng', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(374, 28, 47, 'Kabupaten', '90719', 'Kabupaten Barru', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(375, 28, 87, 'Kabupaten', '92713', 'Kabupaten Bone', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(376, 28, 95, 'Kabupaten', '92511', 'Kabupaten Bulukumba', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(377, 28, 123, 'Kabupaten', '91719', 'Kabupaten Enrekang', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(378, 28, 132, 'Kabupaten', '92111', 'Kabupaten Gowa', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(379, 28, 162, 'Kabupaten', '92319', 'Kabupaten Jeneponto', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(380, 28, 244, 'Kabupaten', '91994', 'Kabupaten Luwu', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(381, 28, 245, 'Kabupaten', '92981', 'Kabupaten Luwu Timur', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(382, 28, 246, 'Kabupaten', '92911', 'Kabupaten Luwu Utara', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(383, 28, 254, 'Kota', '90111', 'Kota Makassar', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(384, 28, 275, 'Kabupaten', '90511', 'Kabupaten Maros', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(385, 28, 328, 'Kota', '91911', 'Kota Palopo', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(386, 28, 333, 'Kabupaten', '90611', 'Kabupaten Pangkajene Kepulauan', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(387, 28, 336, 'Kota', '91123', 'Kota Parepare', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(388, 28, 360, 'Kabupaten', '91251', 'Kabupaten Pinrang', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(389, 28, 396, 'Kabupaten', '92812', 'Kabupaten Selayar (Kepulauan Selayar)', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(390, 28, 408, 'Kabupaten', '91613', 'Kabupaten Sidenreng Rappang/Rapang', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(391, 28, 416, 'Kabupaten', '92615', 'Kabupaten Sinjai', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(392, 28, 423, 'Kabupaten', '90812', 'Kabupaten Soppeng', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(393, 28, 448, 'Kabupaten', '92212', 'Kabupaten Takalar', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(394, 28, 451, 'Kabupaten', '91819', 'Kabupaten Tana Toraja', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(395, 28, 486, 'Kabupaten', '91831', 'Kabupaten Toraja Utara', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(396, 28, 493, 'Kabupaten', '90911', 'Kabupaten Wajo', '2024-05-29 18:17:47', '2024-05-29 18:17:47'),
(397, 29, 25, 'Kabupaten', '94711', 'Kabupaten Banggai', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(398, 29, 26, 'Kabupaten', '94881', 'Kabupaten Banggai Kepulauan', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(399, 29, 98, 'Kabupaten', '94564', 'Kabupaten Buol', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(400, 29, 119, 'Kabupaten', '94341', 'Kabupaten Donggala', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(401, 29, 291, 'Kabupaten', '94911', 'Kabupaten Morowali', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(402, 29, 329, 'Kota', '94111', 'Kota Palu', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(403, 29, 338, 'Kabupaten', '94411', 'Kabupaten Parigi Moutong', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(404, 29, 366, 'Kabupaten', '94615', 'Kabupaten Poso', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(405, 29, 410, 'Kabupaten', '94364', 'Kabupaten Sigi', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(406, 29, 482, 'Kabupaten', '94683', 'Kabupaten Tojo Una-Una', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(407, 29, 483, 'Kabupaten', '94542', 'Kabupaten Toli-Toli', '2024-05-29 18:17:48', '2024-05-29 18:17:48'),
(408, 30, 53, 'Kota', '93719', 'Kota Bau-Bau', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(409, 30, 85, 'Kabupaten', '93771', 'Kabupaten Bombana', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(410, 30, 101, 'Kabupaten', '93754', 'Kabupaten Buton', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(411, 30, 102, 'Kabupaten', '93745', 'Kabupaten Buton Utara', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(412, 30, 182, 'Kota', '93126', 'Kota Kendari', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(413, 30, 198, 'Kabupaten', '93511', 'Kabupaten Kolaka', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(414, 30, 199, 'Kabupaten', '93911', 'Kabupaten Kolaka Utara', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(415, 30, 200, 'Kabupaten', '93411', 'Kabupaten Konawe', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(416, 30, 201, 'Kabupaten', '93811', 'Kabupaten Konawe Selatan', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(417, 30, 202, 'Kabupaten', '93311', 'Kabupaten Konawe Utara', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(418, 30, 295, 'Kabupaten', '93611', 'Kabupaten Muna', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(419, 30, 494, 'Kabupaten', '93791', 'Kabupaten Wakatobi', '2024-05-29 18:17:50', '2024-05-29 18:17:50'),
(420, 31, 73, 'Kota', '95512', 'Kota Bitung', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(421, 31, 81, 'Kabupaten', '95755', 'Kabupaten Bolaang Mongondow (Bolmong)', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(422, 31, 82, 'Kabupaten', '95774', 'Kabupaten Bolaang Mongondow Selatan', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(423, 31, 83, 'Kabupaten', '95783', 'Kabupaten Bolaang Mongondow Timur', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(424, 31, 84, 'Kabupaten', '95765', 'Kabupaten Bolaang Mongondow Utara', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(425, 31, 188, 'Kabupaten', '95819', 'Kabupaten Kepulauan Sangihe', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(426, 31, 190, 'Kabupaten', '95862', 'Kabupaten Kepulauan Siau Tagulandang Biaro (Sitaro)', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(427, 31, 192, 'Kabupaten', '95885', 'Kabupaten Kepulauan Talaud', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(428, 31, 204, 'Kota', '95711', 'Kota Kotamobagu', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(429, 31, 267, 'Kota', '95247', 'Kota Manado', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(430, 31, 285, 'Kabupaten', '95614', 'Kabupaten Minahasa', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(431, 31, 286, 'Kabupaten', '95914', 'Kabupaten Minahasa Selatan', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(432, 31, 287, 'Kabupaten', '95995', 'Kabupaten Minahasa Tenggara', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(433, 31, 288, 'Kabupaten', '95316', 'Kabupaten Minahasa Utara', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(434, 31, 485, 'Kota', '95416', 'Kota Tomohon', '2024-05-29 18:17:51', '2024-05-29 18:17:51'),
(435, 32, 12, 'Kabupaten', '26411', 'Kabupaten Agam', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(436, 32, 93, 'Kota', '26115', 'Kota Bukittinggi', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(437, 32, 116, 'Kabupaten', '27612', 'Kabupaten Dharmasraya', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(438, 32, 186, 'Kabupaten', '25771', 'Kabupaten Kepulauan Mentawai', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(439, 32, 236, 'Kabupaten', '26671', 'Kabupaten Lima Puluh Koto/Kota', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(440, 32, 318, 'Kota', '25112', 'Kota Padang', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(441, 32, 321, 'Kota', '27122', 'Kota Padang Panjang', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(442, 32, 322, 'Kabupaten', '25583', 'Kabupaten Padang Pariaman', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(443, 32, 337, 'Kota', '25511', 'Kota Pariaman', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(444, 32, 339, 'Kabupaten', '26318', 'Kabupaten Pasaman', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(445, 32, 340, 'Kabupaten', '26511', 'Kabupaten Pasaman Barat', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(446, 32, 345, 'Kota', '26213', 'Kota Payakumbuh', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(447, 32, 357, 'Kabupaten', '25611', 'Kabupaten Pesisir Selatan', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(448, 32, 394, 'Kota', '27416', 'Kota Sawah Lunto', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(449, 32, 411, 'Kabupaten', '27511', 'Kabupaten Sijunjung (Sawah Lunto Sijunjung)', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(450, 32, 420, 'Kabupaten', '27365', 'Kabupaten Solok', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(451, 32, 421, 'Kota', '27315', 'Kota Solok', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(452, 32, 422, 'Kabupaten', '27779', 'Kabupaten Solok Selatan', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(453, 32, 453, 'Kabupaten', '27211', 'Kabupaten Tanah Datar', '2024-05-29 18:17:52', '2024-05-29 18:17:52'),
(454, 33, 40, 'Kabupaten', '30911', 'Kabupaten Banyuasin', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(455, 33, 121, 'Kabupaten', '31811', 'Kabupaten Empat Lawang', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(456, 33, 220, 'Kabupaten', '31419', 'Kabupaten Lahat', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(457, 33, 242, 'Kota', '31614', 'Kota Lubuk Linggau', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(458, 33, 292, 'Kabupaten', '31315', 'Kabupaten Muara Enim', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(459, 33, 297, 'Kabupaten', '30719', 'Kabupaten Musi Banyuasin', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(460, 33, 298, 'Kabupaten', '31661', 'Kabupaten Musi Rawas', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(461, 33, 312, 'Kabupaten', '30811', 'Kabupaten Ogan Ilir', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(462, 33, 313, 'Kabupaten', '30618', 'Kabupaten Ogan Komering Ilir', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(463, 33, 314, 'Kabupaten', '32112', 'Kabupaten Ogan Komering Ulu', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(464, 33, 315, 'Kabupaten', '32211', 'Kabupaten Ogan Komering Ulu Selatan', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(465, 33, 316, 'Kabupaten', '32312', 'Kabupaten Ogan Komering Ulu Timur', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(466, 33, 324, 'Kota', '31512', 'Kota Pagar Alam', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(467, 33, 327, 'Kota', '30111', 'Kota Palembang', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(468, 33, 367, 'Kota', '31121', 'Kota Prabumulih', '2024-05-29 18:17:55', '2024-05-29 18:17:55'),
(469, 34, 15, 'Kabupaten', '21214', 'Kabupaten Asahan', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(470, 34, 52, 'Kabupaten', '21655', 'Kabupaten Batu Bara', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(471, 34, 70, 'Kota', '20712', 'Kota Binjai', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(472, 34, 110, 'Kabupaten', '22211', 'Kabupaten Dairi', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(473, 34, 112, 'Kabupaten', '20511', 'Kabupaten Deli Serdang', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(474, 34, 137, 'Kota', '22813', 'Kota Gunungsitoli', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(475, 34, 146, 'Kabupaten', '22457', 'Kabupaten Humbang Hasundutan', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(476, 34, 173, 'Kabupaten', '22119', 'Kabupaten Karo', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(477, 34, 217, 'Kabupaten', '21412', 'Kabupaten Labuhan Batu', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(478, 34, 218, 'Kabupaten', '21511', 'Kabupaten Labuhan Batu Selatan', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(479, 34, 219, 'Kabupaten', '21711', 'Kabupaten Labuhan Batu Utara', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(480, 34, 229, 'Kabupaten', '20811', 'Kabupaten Langkat', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(481, 34, 268, 'Kabupaten', '22916', 'Kabupaten Mandailing Natal', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(482, 34, 278, 'Kota', '20228', 'Kota Medan', '2024-05-29 18:17:56', '2024-05-29 18:17:56');
INSERT INTO `cities` (`id`, `province_id`, `city_id`, `type`, `postal_code`, `name`, `created_at`, `updated_at`) VALUES
(483, 34, 307, 'Kabupaten', '22876', 'Kabupaten Nias', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(484, 34, 308, 'Kabupaten', '22895', 'Kabupaten Nias Barat', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(485, 34, 309, 'Kabupaten', '22865', 'Kabupaten Nias Selatan', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(486, 34, 310, 'Kabupaten', '22856', 'Kabupaten Nias Utara', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(487, 34, 319, 'Kabupaten', '22763', 'Kabupaten Padang Lawas', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(488, 34, 320, 'Kabupaten', '22753', 'Kabupaten Padang Lawas Utara', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(489, 34, 323, 'Kota', '22727', 'Kota Padang Sidempuan', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(490, 34, 325, 'Kabupaten', '22272', 'Kabupaten Pakpak Bharat', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(491, 34, 353, 'Kota', '21126', 'Kota Pematang Siantar', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(492, 34, 389, 'Kabupaten', '22392', 'Kabupaten Samosir', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(493, 34, 404, 'Kabupaten', '20915', 'Kabupaten Serdang Bedagai', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(494, 34, 407, 'Kota', '22522', 'Kota Sibolga', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(495, 34, 413, 'Kabupaten', '21162', 'Kabupaten Simalungun', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(496, 34, 459, 'Kota', '21321', 'Kota Tanjung Balai', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(497, 34, 463, 'Kabupaten', '22742', 'Kabupaten Tapanuli Selatan', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(498, 34, 464, 'Kabupaten', '22611', 'Kabupaten Tapanuli Tengah', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(499, 34, 465, 'Kabupaten', '22414', 'Kabupaten Tapanuli Utara', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(500, 34, 470, 'Kota', '20632', 'Kota Tebing Tinggi', '2024-05-29 18:17:56', '2024-05-29 18:17:56'),
(501, 34, 481, 'Kabupaten', '22316', 'Kabupaten Toba Samosir', '2024-05-29 18:17:56', '2024-05-29 18:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'IND', 'Indonesia', '2024-05-29 18:17:56', '2024-05-29 18:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `coupon_option` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `categories` text NOT NULL,
  `users` text NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `amount_type` varchar(255) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `vendor_id`, `coupon_option`, `coupon_code`, `categories`, `users`, `coupon_type`, `amount_type`, `amount`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Manual', 'Welcome', '1', '', 'Single Time', 'Percentage', 10.00, '2022-12-31', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `name`, `address`, `city`, `state`, `country`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Shyzago Nakamoto', 'Puri Lidah Kulon Indah D-10', 'Kota Surabaya', 'Jawa Timur', 'Indonesia', '1255642718', 1, NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_08_09_172927_create_vendors_table', 1),
(11, '2022_08_09_175014_create_admins_table', 1),
(12, '2022_08_14_013126_create_vendors_business_details_table', 1),
(13, '2022_08_18_133204_create_sections_table', 1),
(14, '2022_08_20_154959_create_categories_table', 1),
(15, '2022_08_28_003445_create_products_table', 1),
(16, '2022_09_06_163819_create_products_attributes_table', 1),
(17, '2022_09_17_195644_create_products_images_table', 1),
(18, '2022_09_27_134607_update_products_table', 1),
(19, '2022_11_03_143550_create_carts_table', 1),
(20, '2022_11_09_144019_add_columns_to_users', 1),
(21, '2022_12_14_025719_create_coupons_table', 1),
(22, '2023_01_14_012938_create_delivery_addresses_table', 1),
(23, '2023_02_27_200827_create_orders_table', 1),
(24, '2023_02_27_201841_create_orders_products_table', 1),
(25, '2023_03_04_161126_create_order_statuses_table', 1),
(26, '2023_03_05_000428_create_order_item_statuses_table', 1),
(27, '2023_03_08_003018_create_orders_logs_table', 1),
(28, '2023_03_09_144122_update_orders_table', 1),
(29, '2023_03_09_235853_update_orders_products_table', 1),
(30, '2023_03_10_001719_update_orders_logs_table', 1),
(31, '2023_03_29_151313_create_payments_table', 1),
(32, '2023_04_01_140344_create_shipping_charges_table', 1),
(33, '2023_04_04_234905_drop_column_from_shipping_charges_table', 1),
(34, '2023_04_04_235424_add_columns_to_shipping_charges_table', 1),
(35, '2023_04_16_211726_add_is_pushed_column_to_orders_table', 1),
(36, '2023_04_23_225334_add_access_token_column_to_users_table', 1),
(37, '2024_05_12_124112_add_column_snap_token_midtrans', 1),
(38, '2024_05_15_031419_create_provinces_table', 1),
(39, '2024_05_15_031426_create_cities_table', 1),
(40, '2024_05_21_045828_countries', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shipping_charges` double(8,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_amount` double(8,2) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_gateway` varchar(255) NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `courier_name` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `is_pushed` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `snap_token` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_logs`
--

CREATE TABLE `orders_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `item_status` varchar(255) NOT NULL,
  `courier_name` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item_statuses`
--

CREATE TABLE `order_item_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_item_statuses`
--

INSERT INTO `order_item_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, NULL, NULL),
(2, 'In Progress', 1, NULL, NULL),
(3, 'Shipped', 1, NULL, NULL),
(4, 'Delivered', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', 1, NULL, NULL),
(2, 'Pending', 1, NULL, NULL),
(3, 'Canceled', 1, NULL, NULL),
(4, 'In Progress', 1, NULL, NULL),
(5, 'Shipped', 1, NULL, NULL),
(6, 'Partially Shipped', 1, NULL, NULL),
(7, 'Delivered', 1, NULL, NULL),
(8, 'Partially Delivered', 1, NULL, NULL),
(9, 'Paid', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_type` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_discount` double(8,2) NOT NULL,
  `product_weight` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_featured` enum('No','Yes') NOT NULL,
  `is_bestseller` enum('No','Yes') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `category_id`, `vendor_id`, `admin_id`, `admin_type`, `product_name`, `product_price`, `product_discount`, `product_weight`, `product_image`, `description`, `is_featured`, `is_bestseller`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 'vendor', 'Makanan Racun', 15000.00, 10.00, 500, '', NULL, 'Yes', 'No', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'MKN1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `province_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bali', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(2, 2, 'Bangka Belitung', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(3, 3, 'Banten', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(4, 4, 'Bengkulu', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(5, 5, 'DI Yogyakarta', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(6, 6, 'DKI Jakarta', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(7, 7, 'Gorontalo', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(8, 8, 'Jambi', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(9, 9, 'Jawa Barat', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(10, 10, 'Jawa Tengah', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(11, 11, 'Jawa Timur', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(12, 12, 'Kalimantan Barat', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(13, 13, 'Kalimantan Selatan', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(14, 14, 'Kalimantan Tengah', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(15, 15, 'Kalimantan Timur', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(16, 16, 'Kalimantan Utara', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(17, 17, 'Kepulauan Riau', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(18, 18, 'Lampung', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(19, 19, 'Maluku', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(20, 20, 'Maluku Utara', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(21, 21, 'Nanggroe Aceh Darussalam (NAD)', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(22, 22, 'Nusa Tenggara Barat (NTB)', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(23, 23, 'Nusa Tenggara Timur (NTT)', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(24, 24, 'Papua', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(25, 25, 'Papua Barat', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(26, 26, 'Riau', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(27, 27, 'Sulawesi Barat', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(28, 28, 'Sulawesi Selatan', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(29, 29, 'Sulawesi Tengah', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(30, 30, 'Sulawesi Tenggara', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(31, 31, 'Sulawesi Utara', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(32, 32, 'Sumatera Barat', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(33, 33, 'Sumatera Selatan', '2024-05-29 18:17:11', '2024-05-29 18:17:11'),
(34, 34, 'Sumatera Utara', '2024-05-29 18:17:11', '2024-05-29 18:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Healthy', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `0_500g` double(8,2) NOT NULL,
  `501g_1000g` double(8,2) NOT NULL,
  `1001_2000g` double(8,2) NOT NULL,
  `2001g_5000g` double(8,2) NOT NULL,
  `above_5000g` double(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country`, `0_500g`, `501g_1000g`, `1001_2000g`, `2001g_5000g`, `above_5000g`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Indonesia', 0.00, 0.00, 0.00, 0.00, 0.00, 1, '2024-05-29 18:17:56', '2024-05-29 18:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `city`, `state`, `country`, `mobile`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Reza Mahendra', 'Puri Lidah Kulon Indah D-10', 'Kota Surabaya', 'Jawa Timur', 'Indonesia', '9700000000', 'reza@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_business_details`
--

CREATE TABLE `vendors_business_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `shop_address` varchar(255) DEFAULT NULL,
  `shop_city` varchar(255) DEFAULT NULL,
  `shop_state` varchar(255) DEFAULT NULL,
  `shop_country` varchar(255) DEFAULT NULL,
  `shop_mobile` varchar(255) DEFAULT NULL,
  `shop_website` varchar(255) DEFAULT NULL,
  `shop_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_business_details`
--

INSERT INTO `vendors_business_details` (`id`, `vendor_id`, `shop_name`, `shop_address`, `shop_city`, `shop_state`, `shop_country`, `shop_mobile`, `shop_website`, `shop_email`, `created_at`, `updated_at`) VALUES
(1, 1, 'HaverCrunch', 'Puri Lidah Kulon Indah D-10', 'Kota Surabaya', 'Jawa Timur', 'Indonesia', '1253247745', 'amazon.com.eg', 'john@admin.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_logs`
--
ALTER TABLE `orders_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item_statuses`
--
ALTER TABLE `order_item_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_logs`
--
ALTER TABLE `orders_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item_statuses`
--
ALTER TABLE `order_item_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
