-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 06:54 PM
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
-- Database: `ecommerce-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `seller_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s', 'mens', NULL, 'admin/img/category-img/84download (5).png', 1, '2025-07-26 09:51:06', '2025-07-26 09:51:06'),
(2, 'Women\'s', 'womens', NULL, 'admin/img/category-img/66download (4).png', 1, '2025-07-26 09:51:18', '2025-07-26 09:51:18'),
(3, 'Baby', 'baby', NULL, 'admin/img/category-img/79download (6).png', 1, '2025-07-26 09:51:29', '2025-07-26 09:51:29'),
(4, 'Unisex', 'unisex', NULL, 'admin/img/category-img/99download (7).png', 1, '2025-07-26 09:52:05', '2025-07-26 15:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `date_of_birth` text DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `ssn` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedIn` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `marital_status` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `image`, `email`, `mobile`, `address`, `date_of_birth`, `blood_group`, `gender`, `street_address`, `city`, `state`, `post`, `country`, `ssn`, `company`, `website`, `facebook`, `linkedIn`, `twitter`, `youtube`, `instagram`, `marital_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tanvir Hasan Nahid', NULL, 'customer@gmail.com', '01318987587', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-07-26 10:54:14', '2025-07-26 10:54:14');

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
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_10_19_082748_create_sessions_table', 1),
(7, '2023_10_19_102335_create_categories_table', 1),
(8, '2023_10_31_085300_create_units_table', 1),
(9, '2023_10_31_085331_create_sizes_table', 1),
(11, '2023_11_02_083551_create_product_images_table', 1),
(12, '2023_11_14_074532_create_product_offers_table', 1),
(13, '2023_11_26_102049_create_customers_table', 1),
(15, '2023_11_26_102126_create_order_details_table', 1),
(16, '2023_12_24_052114_create_features_table', 1),
(17, '2023_12_26_093737_add_mobile_column_to_users_table', 1),
(18, '2024_01_04_093218_create_settings_table', 1),
(19, '2024_01_16_035148_create_privacy_policies_table', 1),
(20, '2024_01_16_042600_create_about_us_table', 1),
(21, '2024_01_21_071042_add_vendor_id_column_to_products_table', 1),
(22, '2024_06_03_085919_create_carts_table', 1),
(23, '2024_06_07_181507_create_coupon_useds_table', 1),
(24, '2024_07_28_060917_create_tickets_table', 1),
(25, '2024_07_30_185718_create_billings_table', 1),
(26, '2024_07_30_185743_create_shippings_table', 1),
(27, '2024_10_23_144926_create_tags_table', 1),
(28, '2024_10_25_183731_create_product_tags_table', 1),
(29, '2023_11_02_050424_create_products_table', 2),
(30, '2023_11_26_102105_create_orders_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` bigint(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `tax_total` int(11) NOT NULL DEFAULT 0,
  `shipping_total` int(11) NOT NULL DEFAULT 0,
  `shipping_discount_amount` int(11) NOT NULL DEFAULT 0,
  `cod_charge` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `special_discount` int(11) NOT NULL DEFAULT 0,
  `order_date` text NOT NULL,
  `order_timestamp` text NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `delivery_partner` bigint(20) DEFAULT NULL,
  `delivery_address` longtext NOT NULL,
  `mobile` longtext NOT NULL,
  `zip` longtext DEFAULT NULL,
  `house_road_area` longtext DEFAULT NULL,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `payment_method` text NOT NULL,
  `payment_amount` int(11) NOT NULL DEFAULT 0,
  `payment_date` text DEFAULT NULL,
  `payment_timestamp` text DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `currency` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `order_note` text DEFAULT NULL,
  `stock_out` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_id`, `order_total`, `tax_total`, `shipping_total`, `shipping_discount_amount`, `cod_charge`, `discount`, `special_discount`, `order_date`, `order_timestamp`, `order_status`, `delivery_partner`, `delivery_address`, `mobile`, `zip`, `house_road_area`, `delivery_status`, `payment_method`, `payment_amount`, `payment_date`, `payment_timestamp`, `payment_status`, `currency`, `transaction_id`, `order_note`, `stock_out`, `created_at`, `updated_at`) VALUES
(1, 242463, 2, 2440, 0, 0, 0, 0, 0, 0, '2025-07-26', '1753466400', 'Pending', NULL, 'Cillum labore amet', '680', '36113', 'Necessitatibus et ut', 'Pending', 'Cash', 2440, '2025-07-26', '1753466400', 'Paid', NULL, NULL, 'Quaerat nisi nostrud', 0, '2025-07-26 11:06:09', '2025-07-26 15:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Mens Premium T-Shirt- Creative', 500, 2, '2025-07-26 11:06:09', '2025-07-26 11:06:09'),
(2, 1, 1, 'Winter T-Shirt Collection For Men', 720, 2, '2025-07-26 11:06:09', '2025-07-26 11:06:09');

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
  `category_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` longtext DEFAULT NULL,
  `image` text DEFAULT NULL,
  `back_image` text DEFAULT NULL,
  `regular_price` double(11,2) NOT NULL,
  `selling_price` double(11,2) NOT NULL,
  `stock_amount` int(11) NOT NULL DEFAULT 0,
  `mrp` double(11,2) DEFAULT 0.00,
  `hit_count` int(11) NOT NULL DEFAULT 0,
  `sales_count` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `vendor_id`, `name`, `slug`, `code`, `short_description`, `long_description`, `image`, `back_image`, `regular_price`, `selling_price`, `stock_amount`, `mrp`, `hit_count`, `sales_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Winter T-Shirt Collection For Men', 'winter-t-shirt-collection-for-men', 'C3MC2MN5', 'Winter T-Shirt Collection For Men Winter T-Shirt Collection For Men .\r\n\r\nWinter T-Shirt Collection For Men Winter T-Shirt Collection For Men .\r\n\r\nWinter T-Shirt Collection For Men\r\n\r\n Winter T-Shirt Collection For Men', '<p style=\"margin-right: 0px; margin-bottom: 5px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-variant-emoji: inherit; font-stretch: inherit; font-size: 1rem; line-height: 24px; font-family: Lato, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: rgb(70, 91, 82);\">Winter T-Shirt Collection For Men&nbsp;Winter T-Shirt Collection For Men .</p><p style=\"margin-right: 0px; margin-bottom: 5px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-variant-emoji: inherit; font-stretch: inherit; font-size: 1rem; line-height: 24px; font-family: Lato, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: rgb(70, 91, 82);\">Winter T-Shirt Collection For Men&nbsp;Winter T-Shirt Collection For Men .</p><p style=\"margin-right: 0px; margin-bottom: 5px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-variant-emoji: inherit; font-stretch: inherit; font-size: 1rem; line-height: 24px; font-family: Lato, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: rgb(70, 91, 82);\">Winter T-Shirt Collection For Men</p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-variant-emoji: inherit; font-stretch: inherit; font-size: 1rem; line-height: 24px; font-family: Lato, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: rgb(70, 91, 82);\">&nbsp;Winter T-Shirt Collection For Men</p>', 'admin/img/product-img/66e2e8eec1650-square.jpg', 'admin/img/product-img/651c1eacee7eb-square.jpeg', 720.00, 720.00, 100, 720.00, 0, 0, 1, '2025-07-26 10:04:29', '2025-07-26 10:04:29'),
(2, 4, 1, 'Mens Premium T-Shirt- Creative', 'mens-premium-t-shirt-creative', 'I40UBNZF', 'Mens Premium T-Shirt- Creative', '<p><span style=\"font-size: 13.4px;\">Mens Premium T-Shirt- Creative</span></p>', 'admin/img/product-img/66fe6a303eb85-square.jpg', 'admin/img/product-img/628e443549a5d-square.jpg', 500.00, 500.00, 50, 500.00, 0, 0, 1, '2025-07-26 10:05:24', '2025-07-26 10:05:24'),
(3, 2, 1, 'Fabrilife Mens Premium Designer Edition T Shirt - Mankind', 'fabrilife-mens-premium-designer-edition-t-shirt-mankind', 'KPZ6SK6C', 'Fabrilife Mens Premium Designer Edition T Shirt - Mankind', '<p>Fabrilife Mens Premium Designer Edition T Shirt - Mankind</p>', 'admin/img/product-img/66e2e8eec1650-square.jpg', 'admin/img/product-img/651c1eacee7eb-square.jpeg', 300.00, 300.00, 20, 300.00, 0, 0, 1, '2025-07-26 15:31:27', '2025-07-26 15:33:33'),
(4, 1, 1, 'Whit Polo T-shirt for men', 'whit-polo-t-shirt-for-men', 'ND3MEXL2', 'Whit Polo T-shirt for men', '<p>Whit Polo T-shirt for men</p>', 'admin/img/product-img/631de4b914d9b-square.jpg', 'admin/img/product-img/65c5f9588838f-square.jpg', 1500.00, 1500.00, 50, 1300.00, 0, 0, 1, '2025-07-26 15:32:18', '2025-07-26 15:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `alt_text` text DEFAULT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cqsEIszFW4pX8oRm7V0GSWn1KogvoUA5WNLbdrvo', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkxMVXk5UEU3NGJhSVdWNG45bkdCU2sydlNmSzVCbjI0ZlFRb3lZaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1753544379),
('UANyZkXW2gEscvWylHwZbyjxvYOfvIuVd11N14H6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHVqNGNpN0FtRFF2OTM4aUxZN2Y4ajVaU3FvZVl3a3kyTFJ3aVBpRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi1sb2dpbiI7fX0=', 1753546802);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` text NOT NULL,
  `slogan` text NOT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `support_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `support_email` varchar(255) DEFAULT NULL,
  `office_hour` varchar(255) DEFAULT NULL,
  `facebook_link` text DEFAULT NULL,
  `twitter_link` text DEFAULT NULL,
  `linkedin_link` text DEFAULT NULL,
  `youtube_link` text DEFAULT NULL,
  `instagram_link` text DEFAULT NULL,
  `google_map_api_link` text DEFAULT NULL,
  `android_app_image` text DEFAULT NULL,
  `android_app_url` text DEFAULT NULL,
  `ios_app_image` text DEFAULT NULL,
  `ios_app_url` text DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `logo_jpg` text DEFAULT NULL,
  `logo_png` text DEFAULT NULL,
  `favicon` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `payment_method_image` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_author` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `slogan`, `contact_phone`, `support_phone`, `contact_email`, `support_email`, `office_hour`, `facebook_link`, `twitter_link`, `linkedin_link`, `youtube_link`, `instagram_link`, `google_map_api_link`, `android_app_image`, `android_app_url`, `ios_app_image`, `ios_app_url`, `company_address`, `logo_jpg`, `logo_png`, `favicon`, `title`, `payment_method_image`, `meta_title`, `meta_keyword`, `meta_author`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'TOP ECOMMERCE', 'TOP ECOMMERCE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin/img/setting/11953.png', 'admin/img/setting/41759.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 09:40:13', '2025-07-26 15:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `es` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `es`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `status`, `created_at`, `updated_at`, `mobile`) VALUES
(1, 'Super Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$MSHrsLydRl.mhyc3WhPguOTrPEAMRhPl423769eVTxNKL1q3sChtO', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-07-26 09:48:17', '2025-07-26 09:48:17', NULL),
(2, 'Tanvir Hasan Nahid', 'customer@gmail.com', NULL, NULL, '$2y$10$xF6sDeDvoUjOIOoC83zBcOXf8c96GALsHDCO7ad27tR2WhVd4CsXC', NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-07-26 10:54:14', '2025-07-26 10:54:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_mobile_unique` (`mobile`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
