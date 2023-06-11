-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2023 at 07:03 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pat_owner`
--

-- --------------------------------------------------------

--
-- Table structure for table `pet_certificates`
--

CREATE TABLE `pet_certificates` (
  `id` bigint UNSIGNED NOT NULL,
  `animal_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sample_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_certificates`
--

INSERT INTO `pet_certificates` (`id`, `animal_id`, `code`, `owner_id`, `image`, `image2`, `name`, `breed`, `gender`, `color`, `dob`, `sample_id`, `order_id`, `report_date`, `created_at`, `updated_at`) VALUES
(2, '123456', '007', 16, 'OJXXEivdcR1685642038.jpeg', 'cLkfFm40mc1683910564.png', 'Tobby Rayn', 'Hybrid', 2, 'Brown', '2023-03-05', '1234', 'asdfg', '2023-03-06', '2023-03-04 18:21:05', '2023-06-01 23:53:58'),
(3, '54321', '009', 12, 'au7LFGlxUX1685642050.jpeg', 'KLH4pPGTpg1679247989.jpeg', 'New Test Cats', 'Test Data', 1, 'Black', '2023-03-04', 'wsedtrfyg', '54324', '2023-03-05', '2023-03-04 18:27:59', '2023-06-01 23:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `pet_failed_jobs`
--

CREATE TABLE `pet_failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet_findpets`
--

CREATE TABLE `pet_findpets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `found_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_findpets`
--

INSERT INTO `pet_findpets` (`id`, `user_id`, `image`, `name`, `color`, `gender`, `weight`, `found_location`, `contact_info`, `note`, `created_at`, `updated_at`) VALUES
(2, 16, '5bJST2EPNi1679340070.jpeg', 'Goff', 'Brown', 1, '4', 'new york city', '123 456 777', 'Call or text with any information', '2023-03-20 19:21:10', '2023-03-21 11:31:25'),
(3, 16, 'YmQ7i9Kded1679771066.jpeg', 'my doll', 'red', 2, '2', 'new city', '111 222 333', 'this is note', '2023-03-25 19:04:27', '2023-03-25 19:04:39'),
(4, 12, 'dU9AoEqKUL1679771204.jpeg', 'new cat', 'white', 1, '3', 'old town', '999 888 77', 'please contact us', '2023-03-25 19:06:44', '2023-03-25 19:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `pet_lostpets`
--

CREATE TABLE `pet_lostpets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lost_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_lostpets`
--

INSERT INTO `pet_lostpets` (`id`, `user_id`, `image`, `name`, `color`, `gender`, `weight`, `reward`, `lost_location`, `contact_info`, `note`, `created_at`, `updated_at`) VALUES
(1, 16, 'IwSNc4YdCJ1679342278.jpeg', 'Kalia Gomez', 'red', 1, '5', '220', 'washington city', '123 456 789', 'Call or text with any information', '2023-03-20 19:52:28', '2023-03-25 19:10:09'),
(2, 12, '5K5BA1YqtS1679771284.jpeg', 'Lance Bush', 'black', 1, '5', '550', 'from the park', '444 555', 'Minima qui autem des', '2023-03-25 19:08:04', '2023-03-25 19:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `pet_markers`
--

CREATE TABLE `pet_markers` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_id` int DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_markers`
--

INSERT INTO `pet_markers` (`id`, `owner_id`, `text`, `created_at`, `updated_at`) VALUES
(2, 16, 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTN38QtkQ08hanH-GxUtyBmZ7a2kolCrk25nxWAxgGWZeUXY1B2E3IbGRlDLKLSYWwSUgz6HZGeSwp6/pubhtml?gid=0', '2023-04-15 20:24:45', '2023-04-15 20:55:16'),
(3, 11, 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTN38QtkQ08hanH-GxUtyBmZ7a2kolCrk25nxWAxgGWZeUXY1B2E3IbGRlDLKLSYWwSUgz6HZGeSwp6/pubhtml?gid=0', '2023-04-15 21:00:59', '2023-04-15 21:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `pet_migrations`
--

CREATE TABLE `pet_migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_migrations`
--

INSERT INTO `pet_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_31_034055_create_contacts_table', 2),
(6, '2022_10_31_082238_create_login_logs_table', 3),
(7, '2022_10_31_144743_create_roles_table', 4),
(8, '2022_11_05_095147_create_abouts_table', 5),
(9, '2022_11_05_123809_create_sliders_table', 6),
(10, '2022_11_05_142951_create_promotions_table', 7),
(11, '2022_11_06_094047_create_categories_table', 8),
(12, '2022_11_06_111137_create_products_table', 9),
(13, '2022_11_10_111240_create_outlets_table', 10),
(14, '2022_11_13_143451_create_visitors_table', 11),
(15, '2022_11_15_145432_create_franchisees_table', 12),
(16, '2022_11_15_170150_create_feedback_table', 13),
(17, '2022_11_15_170409_create_complains_table', 13),
(18, '2022_11_18_121544_create_zones_table', 14),
(20, '2022_11_24_113521_create_languages', 15),
(21, '2022_11_25_004328_create_point_of_sales_table', 16),
(22, '2022_11_25_233700_create_businesses_table', 17),
(23, '2022_11_27_110205_create_homepages_table', 18),
(24, '2022_11_28_103019_create_franchiseepages_table', 19),
(25, '2022_11_29_110123_create_trademarks_table', 20),
(26, '2022_12_03_121317_create_posts_table', 21),
(27, '2023_01_25_222050_create_website_infos_table', 22),
(28, '2023_03_04_200507_create_certificates_table', 23),
(29, '2023_03_20_233811_create_findpets_table', 24),
(30, '2023_03_20_234004_create_lostpets_table', 24),
(31, '2023_03_25_002130_create_pet_passports_table', 25),
(32, '2023_04_16_015712_create_markers_table', 26),
(33, '2023_05_11_011253_create_pet_concierges_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `pet_password_resets`
--

CREATE TABLE `pet_password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet_personal_access_tokens`
--

CREATE TABLE `pet_personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet_pet_concierges`
--

CREATE TABLE `pet_pet_concierges` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `business_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address_map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_pet_concierges`
--

INSERT INTO `pet_pet_concierges` (`id`, `user_id`, `business_name`, `contact_person`, `address`, `address_map`, `phone_no`, `website`, `email`, `created_at`, `updated_at`) VALUES
(1, 16, 'Blaze Kirkland', 'Eiusmod anim delenit', 'Necessitatibus sed n', 'Ratione dolor sit r', '+1 (797) 617-5399', 'https://www.tum.org', 'jutyp@mailinator.com', '2023-05-10 19:42:33', '2023-05-10 19:42:33'),
(2, 16, 'Xantha Cantu', 'Molestiae ullam dele', 'Nemo ut quae elit a', 'Quidem velit distinc', '+1 (392) 384-2648', 'https://www.jofowuzej.in', 'lecuzak@mailinator.com', '2023-05-10 19:47:30', '2023-05-11 16:46:01'),
(4, 0, 'ADJoan Dixon', 'Quibusdam provident', 'Ut aliquip nostrud q', 'Id modi consequuntur', '+1 (252) 719-9941', 'https://www.vudyje.biz', 'pajapefel@mailinator.com', '2023-05-11 17:12:58', '2023-05-11 17:12:58'),
(5, 0, 'ADDalton Moody', 'Maxime eligendi aut', 'Autem dolore dolor s', 'Nam unde neque deser', '+1 (431) 145-4016', 'https://www.botugyfezofi.in', 'mahycevoxa@mailinator.com', '2023-05-11 17:13:01', '2023-05-11 17:18:28'),
(6, 0, 'ADYetta Winters', 'Dolor quia placeat', 'Quod aut sed quo est', 'https://www.google.com/maps', '+1 (334) 582-1169', 'https://www.google.com', 'myfiwagob@mailinator.com', '2023-05-11 17:18:40', '2023-05-11 17:30:05'),
(7, 16, 'Chloe Soto', 'Tempora in exercitat', 'Voluptas ut esse a', 'Velit ipsam ipsam el', '+1 (858) 916-8198', 'https://www.kiri.biz', 'tyrihoq@mailinator.com', '2023-05-11 17:50:47', '2023-05-11 17:50:47'),
(8, 0, 'Quynn Underwood', 'Et veniam voluptate', 'Voluptatibus nesciun', 'Fugit anim odio min', '+1 (234) 746-4311', 'https://www.memyj.biz', 'lacuhyl@mailinator.com', '2023-05-12 01:20:12', '2023-05-12 01:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `pet_pet_passports`
--

CREATE TABLE `pet_pet_passports` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image7` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image8` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image9` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image10` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_pet_passports`
--

INSERT INTO `pet_pet_passports` (`id`, `user_id`, `image`, `image2`, `image3`, `image4`, `image5`, `image6`, `image7`, `image8`, `image9`, `image10`, `created_at`, `updated_at`) VALUES
(1, 16, '9pRxYoxQoZ1679733639.png', 'bunOihaoEe1679685346.png', 'QD2qDPptaf1679685346.png', NULL, 'YcgN2LNgXo1679734092.png', NULL, NULL, NULL, NULL, NULL, '2023-03-24 19:15:47', '2023-03-25 08:48:13'),
(2, 12, 'hffF5mHqyM1679770235.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-25 18:50:35', '2023-03-25 18:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `pet_roles`
--

CREATE TABLE `pet_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_roles`
--

INSERT INTO `pet_roles` (`id`, `name`, `slug`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 1, '2022-10-31 08:58:03', '2022-10-31 09:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `pet_users`
--

CREATE TABLE `pet_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `deleted_temp` int NOT NULL DEFAULT '0',
  `deleted_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_users`
--

INSERT INTO `pet_users` (`id`, `name`, `u_type`, `email`, `mobile_no`, `status`, `email_verified_at`, `password`, `remember_token`, `last_activity`, `deleted_temp`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Solaman', 'sa', 'solaman@gmail.com', '01814944730', 1, NULL, '123456', '', '2023-06-12 00:09:00', 0, NULL, '2022-10-30 06:32:09', '2023-06-11 18:04:01'),
(4, 'Damian Webster', 'po', 'myzo@mailinator.com', '555666777888', 1, NULL, '$2y$10$a8LoIGSrkEPRCo2ipmF1zuGGWli1kX7z7E2iydunAlkXZlWrI9mhy', NULL, NULL, 1, '1', '2022-10-30 05:26:32', '2023-03-04 14:19:12'),
(7, 'Cameron Gutierrez', 'po', 'hapiq@mailinator.com', '19020021312312', 0, NULL, '$2y$10$9ftIXLju2CoVlOeplCv8i.Fsycl5guhy/FTZj1HM1H0W0lFakBEiq', NULL, NULL, 1, '1', '2022-10-30 06:03:04', '2022-10-31 01:03:11'),
(11, 'solaman badsha', 'po', 'user@gmail.com', '01814944730', 1, NULL, '112233', NULL, '2022-11-17 12:55:00', 0, NULL, '2022-11-01 03:54:14', '2022-11-17 06:50:15'),
(12, 'Mason Case', 'po', 'zevywonac@mailinator.com', '697999', 1, NULL, '123456', NULL, NULL, 0, '1', '2022-11-05 12:11:49', '2022-11-05 12:24:05'),
(15, 'Mr Badsha', 'sa', 'badsha@mailinator.com', '01814944730', 1, NULL, '123456', '', '2023-01-29 17:33:00', 0, NULL, '2023-01-23 04:43:36', '2023-05-10 18:35:56'),
(16, 'Jack Rayn', 'po', 'jack@gmail.com', '123121234', 1, NULL, '123456', NULL, '2023-06-08 11:56:00', 0, NULL, '2023-03-05 08:48:45', '2023-06-08 05:51:00'),
(18, 'MBA MUNNA', 'sa', 'eng.mbamunna@gmail.com', '01719329734', 1, NULL, 'mba28gba', NULL, '2023-06-10 16:36:00', 0, NULL, '2023-06-02 00:13:41', '2023-06-10 10:31:19'),
(19, 'sumon', 'sa', 'sumon@gmail.com', '01515223366', 1, NULL, '123456', NULL, '2023-06-10 16:44:00', 0, NULL, '2023-06-10 10:31:19', '2023-06-10 10:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `pet_user_roles`
--

CREATE TABLE `pet_user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_user_roles`
--

INSERT INTO `pet_user_roles` (`id`, `user_id`, `role_id`, `created_by`, `created_at`, `updated_at`) VALUES
(20, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pet_website_infos`
--

CREATE TABLE `pet_website_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_plus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_website_infos`
--

INSERT INTO `pet_website_infos` (`id`, `image`, `facebook`, `youtube`, `google_plus`, `line`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '', 'https://www.facebook.com/', 'https://www.youtube.com/', 'https://www.google.com/', 'https://www.google.com/', 1, '2023-01-25 16:23:37', '2023-01-30 05:34:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pet_certificates`
--
ALTER TABLE `pet_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_failed_jobs`
--
ALTER TABLE `pet_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `pet_findpets`
--
ALTER TABLE `pet_findpets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_lostpets`
--
ALTER TABLE `pet_lostpets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_markers`
--
ALTER TABLE `pet_markers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_migrations`
--
ALTER TABLE `pet_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_password_resets`
--
ALTER TABLE `pet_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pet_personal_access_tokens`
--
ALTER TABLE `pet_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pet_pet_concierges`
--
ALTER TABLE `pet_pet_concierges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_pet_passports`
--
ALTER TABLE `pet_pet_passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_roles`
--
ALTER TABLE `pet_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_users`
--
ALTER TABLE `pet_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `pet_user_roles`
--
ALTER TABLE `pet_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_website_infos`
--
ALTER TABLE `pet_website_infos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pet_certificates`
--
ALTER TABLE `pet_certificates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pet_failed_jobs`
--
ALTER TABLE `pet_failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pet_findpets`
--
ALTER TABLE `pet_findpets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pet_lostpets`
--
ALTER TABLE `pet_lostpets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pet_markers`
--
ALTER TABLE `pet_markers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pet_migrations`
--
ALTER TABLE `pet_migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pet_personal_access_tokens`
--
ALTER TABLE `pet_personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pet_pet_concierges`
--
ALTER TABLE `pet_pet_concierges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pet_pet_passports`
--
ALTER TABLE `pet_pet_passports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pet_roles`
--
ALTER TABLE `pet_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `pet_users`
--
ALTER TABLE `pet_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pet_user_roles`
--
ALTER TABLE `pet_user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pet_website_infos`
--
ALTER TABLE `pet_website_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
