-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2023 at 06:23 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clarity-valley`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `source_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` int(11) NOT NULL COMMENT '1.stripe',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `source_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` int(11) NOT NULL COMMENT '1.stripe',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`id`, `user_id`, `source_id`, `name`, `card_number`, `exp_month`, `exp_year`, `type`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 38, 'card_1MSERjSJwDWno347YupNd9Aj', 'Test', '4242', 2, 2025, 'VISA', 1, '2023-01-20 01:21:59', '2023-01-20 01:21:59'),
(9, 26, 'card_1MSERjSJwDWno347YupNd9Aj', 'Test', '4242', 2, 2025, 'VISA', 1, '2023-01-20 01:21:59', '2023-01-20 01:21:59'),
(12, 38, 'card_1MTe5oSJwDWno347oomxsxSY', 'Test', '4242', 2, 2025, 'VISA', 1, '2023-01-23 22:57:16', '2023-01-23 22:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_thumb_img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1.active, 2.inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `category_thumb_img`, `background`, `colour`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Relationship', 'img/category_thumb_images/1668747836.jpg', NULL, NULL, 1, '2022-11-17 23:30:50', '2022-11-17 23:33:56'),
(2, 'Communication', 'img/category_thumb_images/1668747796.png', NULL, NULL, 2, '2022-11-17 23:31:10', '2022-11-24 05:44:15'),
(3, 'Stress Relief', 'img/category_thumb_images/1668747684.png', NULL, NULL, 1, '2022-11-17 23:31:24', '2022-11-17 23:31:24'),
(4, 'Work Challenges', 'img/category_thumb_images/1668747812.png', NULL, NULL, 1, '2022-11-17 23:31:43', '2022-11-24 04:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` int(11) DEFAULT NULL COMMENT '1.audio, 2.video',
  `media_thumb_img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1.active, 2.inactive',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media_title`, `media`, `media_type`, `media_thumb_img`, `category_id`, `sub_category_id`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(10, 'Test Media1', 'media/audio/1668750940file_example_MP3_1MG.mp3', 1, 'thumb_images/1668750940.png', 4, 4, 1, 1, '2022-11-18 00:25:40', '2022-11-18 00:25:40'),
(12, 'Test Media1', 'media/video/1672375536file_example_MP4_640_3MG.mp4', 2, 'thumb_images/1672375536.png', 3, 0, 1, 1, '2022-12-29 23:15:36', '2022-12-29 23:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `media_favourite`
--

CREATE TABLE `media_favourite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0.No,1.Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_likes`
--

CREATE TABLE `media_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0.unlike , 1.Like',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_reviews`
--

CREATE TABLE `media_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `rating` double(18,2) NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_reviews`
--

INSERT INTO `media_reviews` (`id`, `user_id`, `media_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(4, 38, 3, 4.00, 'testing', '2023-01-04 23:51:06', '2023-01-04 23:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `media_views`
--

CREATE TABLE `media_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_views`
--

INSERT INTO `media_views` (`id`, `user_id`, `media_id`, `view_count`, `created_at`, `updated_at`) VALUES
(31, 38, 12, 7, '2023-01-10 05:57:46', '2023-01-16 00:49:04'),
(32, 38, 10, 8, '2023-01-10 05:58:04', '2023-01-10 06:13:59'),
(33, 38, 15, 2, '2023-01-10 06:02:00', '2023-01-10 06:31:14'),
(34, 30, 10, 5, '2023-01-10 05:58:04', '2023-01-10 06:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_15_125326_add_field_to_users', 1),
(6, '2022_06_18_045322_create_categories_table', 1),
(7, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(8, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(9, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(10, '2016_06_01_000004_create_oauth_clients_table', 2),
(11, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(12, '2022_08_08_062322_add_login_type_to_users', 3),
(13, '2022_08_08_072501_add_login_token_to_users', 4),
(14, '2022_08_08_095130_update_name_to_users', 4),
(16, '2022_10_13_122830_create_notes_table', 5),
(17, '2022_10_15_064048_create_sub_categories_table', 6),
(18, '2022_10_28_055500_create_questions_table', 7),
(19, '2022_11_07_103145_create_media_tabel', 8),
(20, '2022_11_07_115353_create_media_table', 9),
(21, '2022_11_12_051953_add_image_to_categories', 10),
(22, '2022_11_18_051440_add_image_to_sub_categories', 11),
(23, '2022_12_08_091958_add_field_to_notes', 12),
(24, '2022_12_15_113112_add_datetime_to_notes', 13),
(26, '2022_12_22_063528_create_quotes_table', 14),
(27, '2022_12_27_084737_create_table_media_likes', 15),
(29, '2022_12_27_112920_create_media_reviews_table', 16),
(32, '2022_12_29_043416_create_table_media_faviourite', 17),
(33, '2023_01_05_060808_create_site_bg_table', 18),
(34, '2023_01_10_060530_create_media_views_table', 19),
(38, '2023_01_12_130046_create_trainers_table', 20),
(39, '2023_01_12_130117_create_trainer_reviews_table', 20),
(40, '2023_01_18_054012_create_subscriptions_table', 20),
(41, '2023_01_19_115058_create_cards_table', 21),
(42, '2023_01_20_045911_create_card_details_table', 22),
(43, '2023_01_20_063035_add_field_to_users', 23),
(44, '2023_01_20_090640_add_field_to_categories_table', 24),
(45, '2023_01_20_093020_add_field_to_sub_categories_table', 24),
(46, '2023_01_20_094426_add_colour_to_site_bg_table', 24),
(47, '2023_01_23_100357_create_transactions_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `description`, `date`, `time`, `created_at`, `updated_at`) VALUES
(1, 34, NULL, 'Lorem Ipsum is a simply dummy text !', NULL, NULL, '2022-10-14 00:42:30', '2022-10-14 00:42:30'),
(3, 1, NULL, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,', NULL, NULL, '2022-10-14 00:53:42', '2022-10-14 00:53:42'),
(5, 34, NULL, 'Lorem Ipsum 123', NULL, NULL, '2022-10-14 03:39:41', '2022-10-14 03:39:41'),
(6, 34, NULL, 'Test', NULL, NULL, '2022-10-14 03:40:06', '2022-11-24 04:07:09'),
(7, 26, NULL, 'Test', NULL, NULL, '2022-10-14 03:40:09', '2022-10-14 05:58:01'),
(8, 26, NULL, 'Test123', NULL, NULL, '2022-11-06 23:15:17', '2022-11-06 23:15:17'),
(9, 26, 'Lorem ipsum', 'Lorem Ipsum is a dummy text!', NULL, NULL, '2022-11-24 03:47:49', '2022-12-08 04:12:39'),
(10, 34, 'Test', 'Lorem Ipsum is a simply dummy text !!', NULL, NULL, '2022-12-08 04:13:49', '2022-12-08 04:13:49'),
(11, 34, 'Lorem Ipsum is a simply dummy text !!', 'Description', NULL, NULL, '2022-12-15 05:39:21', '2022-12-15 05:39:21'),
(12, 34, 'Lorem Ipsum is a simply dummy text !!', 'Description', '2009-10-16', '21:30:45', '2022-12-15 06:48:45', '2022-12-15 06:48:45'),
(13, 34, 'Lorem Ipsum is a simply dummy text !!', 'Description', '2009-10-15', '21:30:45', '2022-12-15 07:16:01', '2022-12-15 07:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('03209b8ea67350c89bd7c2bbf8eae85b728e605508b543b6438e2d9455f360120107491f498617a3', 36, 1, 'login', '[]', 0, '2022-12-27 06:24:39', '2022-12-27 06:24:39', '2023-12-27 11:54:39'),
('05c4f0f429b4c37455d5547d542c88282b8b72c1f0f74d5cb5b2a10450676bbb64665b4296a8a3e1', 34, 1, 'login', '[]', 0, '2022-11-24 04:11:06', '2022-11-24 04:11:06', '2023-11-24 09:41:06'),
('08f32e766a58fbd79ef537a9fe8665b038a52760c7d5c1faa305bfec325b512a407319ee67cd929b', 34, 1, 'login', '[]', 0, '2022-12-22 05:20:55', '2022-12-22 05:20:55', '2023-12-22 10:50:55'),
('12a04c29de84010122249df0e86e58fccb2705305675ce0f2a5ce02e28ec3be1807f7e0a647b0560', 26, 1, 'login', '[]', 0, '2022-10-13 06:11:27', '2022-10-13 06:11:27', '2023-10-13 11:41:27'),
('1705817d5795b87a7592c66fdf67b4ff2a13b831586de94dbb3ff45ca486cba250391b169bf746ba', 38, 3, 'login', '[]', 0, '2023-01-23 23:08:49', '2023-01-23 23:08:49', '2024-01-24 04:38:49'),
('1dc289b3172d8f809c6e19f3e5b004e8674e4d032cc6a65da8466b740b4d479c9da837d1396da361', 38, 3, 'login', '[]', 0, '2023-01-16 00:47:46', '2023-01-16 00:47:46', '2024-01-16 06:17:46'),
('2162b968093904361f3251400628d2227dfdd2a007777d64d26265cfb9b3ad3d03ef9555d8749820', 26, 1, 'login', '[]', 0, '2022-10-13 23:44:04', '2022-10-13 23:44:04', '2023-10-14 05:14:04'),
('22249fa044a9e45246b28681023676cbb7dabd8ce38ddde9b08197d0aa34b2df85d1170b80225588', 38, 3, 'login', '[]', 0, '2023-01-05 06:16:43', '2023-01-05 06:16:43', '2024-01-05 11:46:43'),
('288ce53b15424b9ee202f73d22ea7e8e99266e145062c880462bbfb47a5b2c433d06678d40c0417b', 38, 3, 'login', '[]', 0, '2023-01-12 23:17:24', '2023-01-12 23:17:24', '2024-01-13 04:47:24'),
('289e337bc84f420fa02c6675f11da3cbfa7d1f39c4778382397813de2ef4e5e2d56e985a52a97798', 34, 1, 'login', '[]', 0, '2022-12-07 22:37:15', '2022-12-07 22:37:15', '2023-12-08 04:07:15'),
('2f7b9106d60279ecdee67deccf641422170ec498f7f6a18045b4305dd6b5000ba37b768022fcefc6', 38, 3, 'login', '[]', 0, '2023-01-10 04:25:30', '2023-01-10 04:25:30', '2024-01-10 09:55:30'),
('37edfa50ae1370f86c03ea8ff71b1bf35364072dc23cf57007d26231b0c4609e3051c69e75c91d33', 26, 1, 'login', '[]', 0, '2022-10-20 00:23:01', '2022-10-20 00:23:01', '2023-10-20 05:53:01'),
('397de471726c7f7aa1b2346f05a09bdcb33ae1be66984f1d852f92553c344d16dc5504b286f87e32', 34, 1, 'login', '[]', 0, '2022-12-22 06:35:23', '2022-12-22 06:35:23', '2023-12-22 12:05:23'),
('3c8b1588672379e0c3bdbf1f395bfa560b7453135615a941ff12d1be7cbb4e22de2bc834cba3c96e', 38, 3, 'login', '[]', 0, '2023-01-12 06:13:41', '2023-01-12 06:13:41', '2024-01-12 11:43:41'),
('3d9a85e7cd16bc1000ab200841059e8737586991493f3838fd6fdb40c56c0f0c47b04b05957decb8', 36, 1, 'login', '[]', 0, '2022-12-30 01:53:40', '2022-12-30 01:53:40', '2023-12-30 07:23:40'),
('5751d863075a9d84a5ac92b4041ab525f803972baec503c292e4fc3af81c36f60020138c5ff327d4', 38, 3, 'login', '[]', 0, '2023-01-10 00:04:52', '2023-01-10 00:04:52', '2024-01-10 05:34:52'),
('58a10134fa1850fb89748b7076ed665744e2243b69c16263f1cc8897e684a24ff4ffe494591a1df5', 34, 1, 'login', '[]', 0, '2022-12-15 00:34:03', '2022-12-15 00:34:03', '2023-12-15 06:04:03'),
('599f804c5134cca2b554a9ca415332c4bb6389307ed7f57c5b1ec7f833ebfcbe8116e62a9cedcf8c', 38, 3, 'login', '[]', 0, '2023-01-23 22:43:48', '2023-01-23 22:43:48', '2024-01-24 04:13:48'),
('5c091eb4002cb7a5ac34c8db9267ab2e8b8c2b0f865df6ab8b04b47856c5edcfa2881baf6e91395b', 38, 3, 'login', '[]', 0, '2023-01-22 23:29:52', '2023-01-22 23:29:52', '2024-01-23 04:59:52'),
('5cee3125ccb60012621a2ce600eaf2fc31b74630178e6b8fa0b100b8381a9c21ba96fc6fdb38507b', 34, 1, 'login', '[]', 0, '2022-12-15 00:39:21', '2022-12-15 00:39:21', '2023-12-15 06:09:21'),
('621df3bdfd1834909389caf2423fb8a454daee3b13941e1da9003892d00300f1124f7634f5451b79', 38, 3, 'login', '[]', 0, '2023-01-16 23:50:20', '2023-01-16 23:50:20', '2024-01-17 05:20:20'),
('693e390665e8a1805b00edc39b1efa90768fe8a2ee096baec4ec84dafac97c253fc82955ca792bf8', 34, 1, 'login', '[]', 0, '2022-12-21 23:17:52', '2022-12-21 23:17:52', '2023-12-22 04:47:52'),
('6976a8c183b55e2d7b32117b5f8972bf0ea1bf589d040164d877fc7b54d99b49e2f21ee013cfe11d', 37, 1, 'login', '[]', 0, '2022-12-27 03:13:56', '2022-12-27 03:13:56', '2023-12-27 08:43:56'),
('6c71b0ba4d6ade7d24bfb5f0f0806b3b1c852c636db7032ae92efcd4c6a257cb67ab1d4f4b902060', 38, 3, 'login', '[]', 0, '2023-01-19 22:35:11', '2023-01-19 22:35:12', '2024-01-20 04:05:11'),
('70de18d8c108c75e521c8e66d280a42e009764faba261104c65f8dd1c1b778e9099465a347b1e354', 38, 3, 'login', '[]', 0, '2023-01-23 22:43:21', '2023-01-23 22:43:21', '2024-01-24 04:13:21'),
('7390b1e83fa65c40383f515403c3e242b318b4c8872e1a723d8c9441321974bd6415af5c01fb0175', 34, 1, 'login', '[]', 0, '2022-12-08 03:34:12', '2022-12-08 03:34:12', '2023-12-08 09:04:12'),
('77b28c8b8155fa4dad812c7cb15d96f09667359d018ca00280cb15e3be4a3527d0b34536894f73de', 36, 1, 'login', '[]', 0, '2022-12-29 23:09:40', '2022-12-29 23:09:40', '2023-12-30 04:39:40'),
('7eeff91eb697c77a70a2a2b9f7249d4c9b779e06dcc473c296cbfb8f0c90e8bcd1c31cbee440411f', 34, 1, 'login', '[]', 0, '2022-12-21 23:06:15', '2022-12-21 23:06:16', '2023-12-22 04:36:15'),
('8175f2ce95507835dd35bd5c0138b369fe45e1a0fd90aacce40f1bd9797d642dace346ee2c019afd', 34, 1, 'login', '[]', 0, '2022-12-22 04:10:26', '2022-12-22 04:10:26', '2023-12-22 09:40:26'),
('82b00159c07c4790b4e8754dbc41b81187ceb2a86a09f02fa58b579ca7b931db1125538f58416b86', 36, 1, 'login', '[]', 0, '2022-12-28 22:58:36', '2022-12-28 22:58:36', '2023-12-29 04:28:36'),
('8335f584115cdbad3c2380f2811a880f5976995379a9ef8efe0b75cb3bfcc2d99411aeb82984a246', 34, 1, 'login', '[]', 0, '2022-12-08 01:47:00', '2022-12-08 01:47:00', '2023-12-08 07:17:00'),
('83e2de21d80b87ba29eab21e17cdccb6957d7da8c9f5ea4412f5fa4dd6a9d0a824ec253b89d5f5f1', 38, 3, 'login', '[]', 0, '2023-01-20 03:32:26', '2023-01-20 03:32:26', '2024-01-20 09:02:26'),
('84dce67645f871a227eb4d565fde8e2d7aa53a728c0f3e6816b44e09e45cf73f00a9a94cfe833dfe', 34, 1, 'login', '[]', 0, '2022-12-15 00:33:58', '2022-12-15 00:33:58', '2023-12-15 06:03:58'),
('8644a13248c243485c21cb2e42610e7bcce41c8636a61232e54d9050a559c8f7643b6e6c6fe9b53d', 36, 1, 'login', '[]', 0, '2022-12-29 00:02:05', '2022-12-29 00:02:05', '2023-12-29 05:32:05'),
('887107897a74f16c184aa21389e3544a2629db1c8bb550159bf4e42fba5b9a0c80aa136570e7bc81', 38, 3, 'login', '[]', 0, '2023-01-04 23:15:10', '2023-01-04 23:15:10', '2024-01-05 04:45:10'),
('89d82b4d2ed9e105e88364565c9c42812ec05c042b5b6f3642fa6ac71e87a8e5a4a70766946139c9', 26, 1, 'login', '[]', 0, '2022-10-13 01:53:37', '2022-10-13 01:53:37', '2023-10-13 07:23:37'),
('912e94b0dcf22e30f0fece33d6dbc07c3d7957dcc103f86505116016ef0b67389496c712717bb37d', 26, 1, 'login', '[]', 0, '2022-10-20 00:43:55', '2022-10-20 00:43:55', '2023-10-20 06:13:55'),
('98006addbccbb330f0251408cb13991e88ad65d19d38b2bd0b82bf0ee375f266cfbaead88ebd49ef', 34, 1, 'login', '[]', 0, '2022-12-15 00:34:09', '2022-12-15 00:34:09', '2023-12-15 06:04:09'),
('9c7250e92b2589bd3a1d63cf3c65a229c3cc0784fc49739cc737312a5d04a48ee6867fb1f50578ba', 38, 3, 'login', '[]', 0, '2023-01-24 03:51:06', '2023-01-24 03:51:06', '2024-01-24 09:21:06'),
('9d1c097cb71a7a4cda86466a6dc35bbbc99ce9bb26a85fb907f7a13b9c3717bda6583fd03c950611', 34, 1, 'login', '[]', 0, '2022-12-22 04:10:43', '2022-12-22 04:10:43', '2023-12-22 09:40:43'),
('9e78a03fbab297b06184a257f184d6ae5802991d4edd38cd28e86a9540da48a8780f523bce32e5ab', 38, 3, 'login', '[]', 0, '2023-01-20 00:20:33', '2023-01-20 00:20:33', '2024-01-20 05:50:33'),
('a6abd90a07bba05ccd28b3c2eb451fd594ab1daa1ccbefb66f8ce2a0143aaa6ee4480c50eee564db', 38, 3, 'login', '[]', 0, '2023-01-13 01:05:49', '2023-01-13 01:05:49', '2024-01-13 06:35:49'),
('abac1ecf05543b91b9303bfe848bd4ab7689f364a4919f22bd0a55c5998bb3b3fc4094341f3e6fe0', 38, 3, 'login', '[]', 0, '2023-01-25 00:03:38', '2023-01-25 00:03:39', '2024-01-25 05:33:38'),
('abbed007a38a7d64345f0c5040cebee24c2a17f312642f86d9caba97b180c88265d96446a58f6a45', 34, 1, 'login', '[]', 0, '2022-12-22 04:07:00', '2022-12-22 04:07:01', '2023-12-22 09:37:00'),
('b53d0d0bd44f440feeb7e950f826a87361cb03c501914b3a1f55d150bd6df4e6e335dcad8321dcf3', 34, 1, 'login', '[]', 0, '2022-12-22 07:17:00', '2022-12-22 07:17:00', '2023-12-22 12:47:00'),
('ba39c035a35c07f8d15326072c25b90708f164baad1e0e441f94cd63d39dfa237ebf2bb605c2a31d', 34, 1, 'login', '[]', 0, '2022-12-15 00:41:21', '2022-12-15 00:41:21', '2023-12-15 06:11:21'),
('bf18bf9d1986c0bb8d848d65d7d361fefea3907fe0406ad5fee69edecd87b92e0cfdf3642d1ce21f', 34, 1, 'login', '[]', 0, '2022-12-15 00:34:20', '2022-12-15 00:34:20', '2023-12-15 06:04:20'),
('c648f7c0f18e49b9ce31d1d3fbf2327c80ebaf2485305b6a7227008712dc5649c6b5906f55e17149', 26, 1, 'login', '[]', 0, '2022-10-13 06:13:10', '2022-10-13 06:13:10', '2023-10-13 11:43:10'),
('c7d471b6ebbec26411748cc48497386d81202ce44761b7e90e53864f2f2f5e69573ed74e1b11a0db', 34, 1, 'login', '[]', 0, '2022-12-15 00:39:10', '2022-12-15 00:39:10', '2023-12-15 06:09:10'),
('ccdcefb2cb3ccecd2eba71c13bfc61e6b156e1bc0a43a93138e08253fae7d9286fd134441acbe7e3', 34, 1, 'login', '[]', 0, '2022-12-15 00:40:17', '2022-12-15 00:40:17', '2023-12-15 06:10:17'),
('d02f02871c26bfb782a02de8befbaf136c788d5e7cbb3d91cef48dcb31ef6ac9ee00efc16cdbd027', 38, 3, 'login', '[]', 0, '2023-01-12 07:26:00', '2023-01-12 07:26:00', '2024-01-12 12:56:00'),
('d1f92a949961dbd1b72713e2b96f4d6a57c24078be84505fcda20a55f74f59b0a7cfab89b92e4a15', 34, 1, 'login', '[]', 0, '2022-12-07 05:56:06', '2022-12-07 05:56:06', '2023-12-07 11:26:06'),
('d361ddba9453296250e006871ac012f2b6a1d9f952df91f73ebe072b9f2fdc560057c4534ca2e3c2', 38, 3, 'login', '[]', 0, '2023-01-20 04:51:16', '2023-01-20 04:51:16', '2024-01-20 10:21:16'),
('d559ab1fe53f238f58f564bb8c07da0850a77155b51909ec0e4112a586fff6a43decd6a8afebce7a', 34, 1, 'login', '[]', 0, '2022-11-24 04:06:30', '2022-11-24 04:06:30', '2023-11-24 09:36:30'),
('dbdc0b62c5fe2c9b251839399613e3640bf25eb1175206b5561668754855979ae28f55b82af2ab1a', 34, 1, 'login', '[]', 0, '2022-12-15 00:39:02', '2022-12-15 00:39:02', '2023-12-15 06:09:02'),
('e1f69ddb004160591e26bc58996c4d56a1cd9ee4eedfe72d88b6b0a24928a62e860b9b1f88e00b57', 34, 1, 'login', '[]', 0, '2022-12-15 03:37:39', '2022-12-15 03:37:39', '2023-12-15 09:07:39'),
('e54b60d7f3140ed19b982482c37a0c9dacffc285d2b83a96c0cc29716f492ebab9d091cd9c4985c3', 38, 3, 'login', '[]', 0, '2023-01-23 22:43:37', '2023-01-23 22:43:37', '2024-01-24 04:13:37'),
('ec175885c21d1cee479886e47c39bc4055aa655ce1bcc13c5860f99b131c341de867021f0d591831', 38, 3, 'login', '[]', 0, '2023-01-11 23:56:24', '2023-01-11 23:56:24', '2024-01-12 05:26:24'),
('eccaa2893521d58fed467f9edbca93066c8a9b8877b750318bc029c262d3315050955fad8d4c3acd', 34, 1, 'login', '[]', 0, '2022-12-15 00:34:11', '2022-12-15 00:34:11', '2023-12-15 06:04:11'),
('ed0182d2ce0c6e38b048bed746901ae8cbdabf3562dbd4c77d64f275c279f975bdf6211f9e3bbf29', 38, 3, 'login', '[]', 0, '2023-01-19 03:59:18', '2023-01-19 03:59:18', '2024-01-19 09:29:18'),
('ed1bedbac97916ec9e3a1c47abe2b91ca5c1d31993ffdbb2887551ece238ab299566f38cec80409c', 37, 1, 'login', '[]', 0, '2022-12-26 05:38:20', '2022-12-26 05:38:20', '2023-12-26 11:08:20'),
('f2ed03ec0ecec3030f376dc36691165870bc49ed4ac99f61ea6ed12d29952857717a45364be9bb82', 34, 1, 'login', '[]', 0, '2022-12-22 07:31:59', '2022-12-22 07:31:59', '2023-12-22 13:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '5zOvyLtZ510uQ8q5g477S55UWsLDG74QDp2yw7QW', NULL, 'http://localhost', 1, 0, 0, '2022-10-13 00:21:28', '2022-10-13 00:21:28'),
(2, NULL, 'Laravel Password Grant Client', '88sYW8bqt03fJCjYMmb1c3P4Ood2VjkOSmQ3hgwO', 'users', 'http://localhost', 0, 1, 0, '2022-10-13 00:21:28', '2022-10-13 00:21:28'),
(3, NULL, 'Laravel Personal Access Client', 'LSSVWSAjlJb7gQKDh1jAGGyNKVHWGkR5LNNDtD98', NULL, 'http://localhost', 1, 0, 0, '2023-01-04 23:14:49', '2023-01-04 23:14:49'),
(4, NULL, 'Laravel Password Grant Client', '9dY7LXcCodfg6onyzZ5DcW6HhNNFxIckbUWMMDen', 'users', 'http://localhost', 0, 1, 0, '2023-01-04 23:14:49', '2023-01-04 23:14:49');

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

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-08-07 23:11:28', '2022-08-07 23:11:28'),
(2, 3, '2022-10-13 00:20:30', '2022-10-13 00:20:30'),
(3, 5, '2022-10-13 00:20:58', '2022-10-13 00:20:58'),
(4, 1, '2022-10-13 00:21:28', '2022-10-13 00:21:28'),
(5, 3, '2023-01-04 23:14:49', '2023-01-04 23:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_one` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_two` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1.active, 2.inactive',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option_one`, `option_two`, `answer`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'At a party do you', 'Interact with many, including strangers', 'Interact with a few, known to you', 1, 1, 1, '2022-10-28 06:38:09', '2022-10-28 06:38:09'),
(2, 'Is it worse to', 'Interact with many, including strangers', 'gss', 1, 1, 1, '2022-10-28 07:27:24', '2022-11-02 01:41:15'),
(18, 'At a party do you', 'Interact with many, including strangers', 'Interact with a few, known to you', 2, 1, 1, '2022-11-07 04:10:24', '2022-11-07 04:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `writer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `user_id`, `writer_name`, `quote`, `created_at`, `updated_at`) VALUES
(2, '1', 'Maulik', 'When Requesting Authorization Codes', '2022-12-22 05:33:19', '2022-12-22 05:33:19'),
(5, '34', 'Maulik123', 'Lorem Ipsum', '2022-12-22 05:41:42', '2022-12-22 07:22:01'),
(8, '34', 'Maulik', 'Lorem Ipsum is a summy text !!', '2022-12-22 07:15:07', '2022-12-22 07:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `site_bg`
--

CREATE TABLE `site_bg` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_bg`
--

INSERT INTO `site_bg` (`id`, `name`, `image`, `colour`, `created_by`, `created_at`, `updated_at`) VALUES
(6, 'Test Background', 'img/sitebg_images/1672919018.png', NULL, 1, '2023-01-05 06:13:02', '2023-01-05 06:13:38'),
(7, 'Tst BG', 'img/sitebg_images/1673325438.png', NULL, 1, '2023-01-05 06:17:15', '2023-01-09 23:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `subscription_duration` int(11) NOT NULL COMMENT 'in month',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `price`, `subscription_duration`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Stater', 1000, 1, 1, '2023-01-18 22:44:43', '2023-01-18 22:45:12'),
(2, 'Premium', 5000, 6, 1, '2023-01-18 22:53:52', '2023-01-18 22:54:45'),
(3, 'Standerd', 10000, 12, 1, '2023-01-18 22:54:24', '2023-01-18 22:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_thumb_img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1.active, 2.inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `subcategory_thumb_img`, `background`, `colour`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Communication Sub', 'img/subcategory_thumb_images/1668749929.png', NULL, NULL, 1, '2022-11-17 23:39:35', '2022-11-24 05:44:28'),
(2, 2, 'Test', NULL, NULL, NULL, 1, '2022-11-17 23:50:44', '2022-11-24 05:44:21'),
(4, 4, 'dffdgg', 'img/subcategory_thumb_images/1668749907.jpg', NULL, NULL, 1, '2022-11-18 00:08:27', '2022-11-24 04:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1.english, 2.hindi, 3.gujarati',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_reviews`
--

CREATE TABLE `trainer_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `rating` double(18,2) NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainer_reviews`
--

INSERT INTO `trainer_reviews` (`id`, `user_id`, `trainer_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 38, 2, 4.50, 'Test Review', '2023-01-19 23:44:56', '2023-01-19 23:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL COMMENT 'as a user_id',
  `subscription_id` int(11) NOT NULL,
  `accept_with` int(11) NOT NULL COMMENT '1.visa, 2.master',
  `card_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `sender_id`, `subscription_id`, `accept_with`, `card_id`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 38, 2, 1, 1, 5000, 'Test paid INR 5000 for plan Premium', '2023-01-23 05:51:20', '2023-01-23 05:51:20'),
(2, 38, 2, 1, 1, 5000, 'Test paid INR 5000 for plan Premium', '2023-01-23 05:57:30', '2023-01-23 05:57:30'),
(3, 38, 2, 1, 1, 5000, 'Test paid INR 5000 for plan Premium', '2023-01-23 06:10:44', '2023-01-23 06:10:44'),
(4, 38, 2, 1, 1, 5000, 'Test paid INR 5000 for plan Premium', '2023-01-23 22:57:33', '2023-01-23 22:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` int(11) NOT NULL DEFAULT 3 COMMENT '1.male, 2.female, 3.other',
  `role` int(11) NOT NULL COMMENT '1.super admin, 2.sub admin, 3.user',
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_type` int(11) DEFAULT NULL COMMENT '1.web, 2.google, 3.apple, 4.facebook',
  `customer_stripe_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `age`, `sex`, `role`, `image`, `message`, `login_type`, `customer_stripe_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$gocJy.HXBQuEX4Vc7N7UjONMX.g0h5TsFKr1DXO.dW8VE3v.Foes2', NULL, NULL, 1, 1, NULL, NULL, 1, NULL, NULL, '2022-06-18 04:57:07', '2022-08-08 03:24:16'),
(26, 'admin1', 'admin12@gmail.com', '$2y$10$OYUbl8mtKRsxcFkv5D04SOJjPrfQLeip0.zKF6kTfy9z2uoGoLO5K', '9874563210', '2022-10-20', 1, 2, '1665654672.jpg', 'asdsad', 1, NULL, NULL, '2022-10-12 04:26:56', '2022-11-01 03:55:16'),
(34, 'Test12', 'test12@gmail.com', '$2y$10$3XIuf8Sc9M0r.SXXqo89ge9xJL9dX4jaVfN6Oyio25tBkk3i1OB3S', '9876543210', '2001-01-01', 3, 3, '1671706297.png', NULL, 1, NULL, NULL, '2022-11-24 04:06:12', '2022-12-22 07:31:59'),
(38, 'Test', 'test@gmail.com', '$2y$10$rmvTny7kcoet/7My.r8F4uL3swsVx9c5nD5NHbBp0CCBxGqgbgV2m', NULL, NULL, 3, 2, NULL, NULL, 1, 'cus_NCdb0kZAqwueQg', NULL, '2023-01-04 23:12:26', '2023-01-25 00:03:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_favourite`
--
ALTER TABLE `media_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_likes`
--
ALTER TABLE `media_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_reviews`
--
ALTER TABLE `media_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_views`
--
ALTER TABLE `media_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_foreign` (`user_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_bg`
--
ALTER TABLE `site_bg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_categories_id_foreign` (`category_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer_reviews`
--
ALTER TABLE `trainer_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_details`
--
ALTER TABLE `card_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `media_favourite`
--
ALTER TABLE `media_favourite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media_likes`
--
ALTER TABLE `media_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media_reviews`
--
ALTER TABLE `media_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media_views`
--
ALTER TABLE `media_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_bg`
--
ALTER TABLE `site_bg`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer_reviews`
--
ALTER TABLE `trainer_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_categories_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
