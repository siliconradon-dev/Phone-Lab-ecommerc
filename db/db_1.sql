-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 12:54 PM
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
-- Database: `phone_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', 'samsung', 'uploads/brands/20260515065434.jpg', '2026-05-15 01:24:34', '2026-05-15 01:24:34'),
(2, 'Oppo', 'oppo', 'uploads/brands/20260515065511.jpg', '2026-05-15 01:25:11', '2026-05-15 01:25:11'),
(3, 'Asus', 'asus', 'uploads/brands/20260515065607.png', '2026-05-15 01:26:07', '2026-05-15 01:26:07'),
(4, 'Apple', 'apple', 'uploads/brands/20260518062513.png', '2026-05-15 10:50:32', '2026-05-18 00:55:13'),
(5, 'Other', 'other', NULL, '2026-05-17 22:58:47', '2026-05-17 22:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `brand_categories`
--

CREATE TABLE `brand_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_categories`
--

INSERT INTO `brand_categories` (`id`, `brand_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 4, 3, NULL, NULL),
(5, 5, 6, NULL, NULL),
(6, 4, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Android', 'android', 'uploads/categories/20260515065349.webp', '2026-05-15 01:23:49', '2026-05-15 01:23:49'),
(2, 'Laptops', 'laptops', 'uploads/categories/20260515065406.png', '2026-05-15 01:24:06', '2026-05-15 01:24:06'),
(3, 'Ear Buds', 'ear-buds', NULL, '2026-05-15 10:49:09', '2026-05-15 10:49:09'),
(4, 'Handfree', 'handfree', 'uploads/categories/20260518035149.jpg', '2026-05-17 22:21:49', '2026-05-17 22:21:49'),
(5, 'Back Covers', 'back-covers', 'uploads/categories/20260518035503.jpg', '2026-05-17 22:25:03', '2026-05-17 22:25:03'),
(6, 'Chargers', 'chargers', 'uploads/categories/20260518060901.webp', '2026-05-17 22:30:08', '2026-05-18 00:39:01');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2026_05_04_120450_create_sessions_table', 1),
(7, '2026_05_14_065648_create_categories_table', 1),
(8, '2026_05_14_065652_create_brands_table', 1),
(9, '2026_05_14_080220_create_brand_categories_table', 1),
(10, '2026_05_15_120601_create_products_table', 1),
(11, '2026_05_15_120614_create_product_variants_table', 1),
(12, '2026_05_15_120627_create_product_images_table', 1),
(13, '2026_05_15_144046_create_stocks_table', 2),
(14, '2026_05_15_144102_create_product_imeis_table', 2),
(15, '2026_05_16_055200_create_settings_table', 3);

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
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `base_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `has_variants` tinyint(1) NOT NULL DEFAULT 0,
  `featured_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `slug`, `description`, `category_id`, `brand_id`, `base_price`, `has_variants`, `featured_image`, `created_at`, `updated_at`) VALUES
(1, 'PS-SAMGALA56-6064', 'Samsung Galaxy A56 5G', 'samsung-galaxy-a56-5g-1778830755', '<h2>Samsung Galaxy A56 5G in Sri Lanka – Official Warranty</h2><p>The Samsung Galaxy A56 5G combines refined design, powerful performance, and next-generation connectivity. Available in Sri Lanka from Present Solution, it is built for users who want flagship-level features in a stylish and reliable smartphone.</p><h3>Main Performance Heading</h3><p>Powered by the Samsung Exynos 1580 processor and paired with up to 12GB RAM, the Galaxy A56 5G delivers fast, smooth performance for multitasking, gaming, and everyday use. Samsung’s optimized One UI experience ensures long-term reliability and smooth operation.</p><h3>Display</h3><p>The 6.7-inch Super AMOLED display with Full HD+ resolution and a 120Hz refresh rate offers vivid colours, deep contrast, and ultra-smooth scrolling. It’s perfect for streaming, gaming, and browsing even under bright outdoor conditions.</p><h3>Camera (If Applicable)</h3><p>The Galaxy A56 5G features a versatile triple camera system with a 50MP main camera with OIS, a 12MP ultra-wide lens, and a 5MP macro camera. Capture sharp photos and steady videos, while the 32MP front camera delivers high-quality selfies and video calls.</p><h3>Battery &amp; Charging</h3><p>Equipped with a 5000mAh battery, the Samsung Galaxy A56 5G easily lasts a full day of heavy use. It supports fast wired charging, allowing you to power up quickly and stay connected longer.</p><h3>Why Buy from Present Solution</h3><ul><li>100% genuine products</li><li>Official warranty</li><li>Competitive Sri Lankan pricing</li><li>Islandwide delivery</li></ul><h3>Payment &amp; Installments</h3><p>Installments via banks and KoKo are available, making it easy to purchase the Samsung Galaxy A56 5G with flexible monthly payments.</p><h3>Warranty &amp; Support</h3><p>The Samsung Galaxy A56 5G comes with official warranty coverage in Sri Lanka. Present Solution ensures dependable after-sales support and customer care.</p><p>&nbsp;</p><ul><li>8GB / 128GB</li><li>8GB / 256GB</li><li>12GB / 256GB</li><li>Available Colors: Pink, White, Graphite, Olive</li><li>Size: 6.7-inch</li></ul>', 1, 1, 0.00, 1, 'uploads/products/featured_1778830755.webp', '2026-05-15 02:09:15', '2026-05-15 02:43:21'),
(2, 'PS-SAMGALA07-7315', 'Samsung Galaxy A07 (TRCSL)', 'samsung-galaxy-a07-trcsl-1778833107', '<h2>Samsung A07 in Sri Lanka – Official Warranty</h2><p>Buy the Samsung A07 in Sri Lanka from Present Solution and enjoy a reliable daily smartphone built for smooth browsing, streaming, and social media. This is a TRCSL approved device and comes with a one year company warranty plus one time break free for the display for extra peace of mind.</p><h3>Main Performance Heading</h3><p>Powered by a 6nm MediaTek Helio G99 chipset, Samsung A07 keeps apps responsive and multitasking smooth. With multiple RAM and storage options and a microSD dedicated slot, you can choose the right variant for your usage and expand storage when you need more space.</p><h3>Display</h3><p>Enjoy a large 6.7″ HD+ display with a 90Hz refresh rate for smoother scrolling and a more comfortable viewing experience. The wide screen is ideal for YouTube, TikTok, online classes, and everyday work on the go.</p><h3>Camera (If Applicable)</h3><p>Capture clear photos with a 50MP main camera and add natural depth with the secondary lens. The 8MP front camera is great for selfies and video calls, while 1080p video support helps you record sharp moments with ease.</p><h3>Battery &amp; Charging</h3><p>Samsung A07 packs a 5000mAh battery designed to last through your day. When it is time to recharge, 25W wired charging helps you power up faster so you can get back to what matters.</p><h3>Why Buy from Present Solution</h3><ul><li>100% genuine products</li><li>TRCSL approved device</li><li>1-year company warranty + 1-time display break-free</li><li>Competitive Sri Lankan pricing</li><li>Islandwide delivery</li></ul><h3>Payment &amp; Installments</h3><p>Pay your way with card payments, bank transfers, and flexible installments via leading Sri Lankan banks and KoKo. Enjoy an easier upgrade with affordable monthly plans at Present Solution.</p><h3>Warranty &amp; Support</h3><p>This Samsung A07 is a TRCSL approved phone with one year company warranty, including one time break free for the display. Our team supports you with smooth order handling, delivery updates, and after-sales guidance.</p><p>&nbsp;</p><ul><li>4GB/64GB</li><li>4GB/128GB</li><li>6GB/128GB</li><li>8GB/256GB</li><li>Colors: Black, Green, Light Violet</li><li>Size: 6.7-inch display</li></ul>', 1, 1, 0.00, 1, 'uploads/products/featured_1778833107.webp', '2026-05-15 02:48:27', '2026-05-15 02:48:27'),
(3, 'PS-APPAIRANC-5726', 'Apple AirPods 4 ANC', 'apple-airpods-4-anc-1778862118', '<h2>Apple AirPods 4 ANC in Sri Lanka</h2><p>Apple AirPods 4 with Active Noise Cancellation are designed for users who want powerful sound, intelligent noise control, and everyday comfort in a refined open-ear design. Available in Sri Lanka from Present Solution with official Apple warranty.</p><h3>High-Quality Sound Performance</h3><p>Featuring a custom Apple-designed driver and Adaptive EQ, AirPods 4 ANC deliver rich bass, clear vocals, and balanced audio that adjusts in real time to your ears.</p><h3>Active Noise Cancellation &amp; Transparency</h3><p>Advanced Active Noise Cancellation helps reduce background noise, while Transparency Mode allows you to hear the world around you without removing your earbuds.</p><h3>Comfort &amp; Design</h3><p>The lightweight open-ear design ensures a secure and comfortable fit for long listening sessions, making AirPods 4 ANC ideal for daily use.</p><h3>Battery Life &amp; Charging</h3><p>Enjoy up to 4 hours of listening with ANC enabled and up to 20 hours total with the USB-C charging case. Fast charging provides quick power boosts when needed.</p><h3>Connectivity &amp; Controls</h3><p>Bluetooth 5.3 ensures stable connectivity with Apple and Android devices. Force sensor controls allow easy management of music, calls, and noise modes.</p><h3>Why Buy from Present Solution</h3><ul><li>100% genuine Apple products</li><li>Official warranty</li><li>Competitive Sri Lankan pricing</li><li>Islandwide delivery</li></ul>', 3, 4, 53999.00, 0, 'uploads/products/featured_1778862118.webp', '2026-05-15 10:51:58', '2026-05-15 10:51:58'),
(5, 'CH-gffg66778', '40W Dynamic Power Adapter with 60W Max', '40w-dynamic-power-adapter-with-60w-max-1779078823', '<p>The 40W Dynamic Power Adapter with 60W Max is uniquely designed to dynamically deliver up to 60W of output, providing a powerful boost in charging speeds.¹</p><p>With Dynamic Power, you get many of the same benefits of higher-wattage chargers in a compact, pocket-size form factor to make charging at home, in the office, or on the go faster and more convenient than ever. For fast charging, pair the Dynamic Power Adapter with iPhone 17, iPhone 17 Pro, iPhone 17 Pro Max (up to 50 percent charge in 20 minutes) or iPhone Air (up to 50 percent charge in 30 minutes). Or pair it with iPad&nbsp;Pro 11-inch models (up to 50 percent charge in 30 minutes) or iPad Pro 13-inch models (up to 50 percent charge in 35 minutes).</p><p>Compatible with USB-C–enabled devices. Charging cable sold separately.</p>', 6, 5, 12000.00, 0, 'uploads/products/featured_1779078823.png', '2026-05-17 23:03:43', '2026-05-17 23:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_imeis`
--

CREATE TABLE `product_imeis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `imei_number` varchar(255) NOT NULL,
  `status` enum('available','sold','returned') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_imeis`
--

INSERT INTO `product_imeis` (`id`, `product_id`, `product_variant_id`, `imei_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 25, 'fghfghgf56545', 'available', '2026-05-15 10:46:36', '2026-05-15 10:46:36'),
(2, 2, 25, 'fdghfdgyfd565', 'available', '2026-05-15 10:46:36', '2026-05-15 10:46:36'),
(3, 2, 25, 'gffdhfddtgr546', 'available', '2026-05-15 10:46:36', '2026-05-15 10:46:36'),
(4, 2, 25, 'hgfhfgh4354yt', 'available', '2026-05-15 10:46:36', '2026-05-15 10:46:36'),
(5, 2, 25, '654gfhgfy56hh', 'available', '2026-05-15 10:46:36', '2026-05-15 10:46:36'),
(6, 1, 19, 'gfdyfy5654554gf', 'available', '2026-05-15 10:47:39', '2026-05-15 10:47:39'),
(7, 1, 19, 'gfdghdt4et4eggf', 'available', '2026-05-15 10:47:39', '2026-05-15 10:47:39'),
(8, 1, 19, 'gfdgt46456547rg', 'available', '2026-05-15 10:47:39', '2026-05-15 10:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `variant_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `color`, `storage`, `ram`, `price`, `variant_image`, `created_at`, `updated_at`) VALUES
(19, 1, 'Pink', '128GB', '8GB', 107999.00, 'uploads/products/variants/6a06d44b7c809.webp', '2026-05-15 02:43:21', '2026-05-15 02:43:21'),
(20, 1, 'Graphite', '128GB', '8GB', 107999.00, 'uploads/products/variants/6a06d5a10f305.webp', '2026-05-15 02:43:21', '2026-05-15 02:43:21'),
(21, 1, 'Pink', '256GB', '12GB', 123999.00, 'uploads/products/variants/6a06d44b85e44.webp', '2026-05-15 02:43:21', '2026-05-15 02:43:21'),
(22, 1, 'White', '128GB', '8GB', 107999.00, 'uploads/products/variants/6a06d44b86887.webp', '2026-05-15 02:43:21', '2026-05-15 02:43:21'),
(23, 1, 'White', '256GB', '8GB', 116999.00, 'uploads/products/variants/6a06d44b876c5.webp', '2026-05-15 02:43:21', '2026-05-15 02:43:21'),
(24, 1, 'White', '256GB', '12GB', 123999.00, 'uploads/products/variants/6a06d44b887d1.webp', '2026-05-15 02:43:21', '2026-05-15 02:43:21'),
(25, 2, 'Black', '64GB', '4GB', 35500.00, 'uploads/products/variants/variant_6a06d6d324c8d.webp', '2026-05-15 02:48:27', '2026-05-15 02:48:27'),
(26, 2, 'Black', '128GB', '4GB', 42900.00, 'uploads/products/variants/variant_6a06d6d3259f5.webp', '2026-05-15 02:48:27', '2026-05-15 02:48:27'),
(27, 2, 'Green', '64GB', '4GB', 35500.00, 'uploads/products/variants/variant_6a06d6d3266ae.webp', '2026-05-15 02:48:27', '2026-05-15 02:48:27'),
(28, 2, 'Green', '128GB', '4GB', 42900.00, 'uploads/products/variants/variant_6a06d6d327715.webp', '2026-05-15 02:48:27', '2026-05-15 02:48:27');

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
('ANYHT1KRryUGpo6FH8PvEM91s5zVD2DB8oOv9EGO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmVHMExrcDZhcXVtdFd2THhINmFFYkdmeDhNaHlvaGhTZlZGOFB5MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779101479),
('eDQIHgCqlPRDnvoXTqy8aqkkgQl2lBmsRbqKMjBF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnV0Y0dqcTFmcmRCUGpSWTZ4SzlHQXZuTWRXdUE2VVcxMkZiZFdHNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779083339),
('OJ4iwe8nq53HtMGwwvGU1w1Jt37fpEUijohW8Anz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUk8wS0cxWUJwRGhBa21kcVd5SDNtd3J6a3IxU2haNTN3UHBueFAyeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkRjFKRUprcWJ4d29PTy5SR2tTVElPdUpNNGNFY3hSM0tJS0gxNGlRc2dJZms5WGRsRlpZTm0iO30=', 1779085645);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Phone Lab', '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(2, 'site_address', NULL, '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(3, 'site_phone', NULL, '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(4, 'site_email', NULL, '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(5, 'social_facebook', 'https://facebook.com/yourpage', '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(6, 'social_instagram', NULL, '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(7, 'social_youtube', NULL, '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(8, 'social_tiktok', NULL, '2026-05-16 01:17:22', '2026-05-16 01:17:22'),
(9, 'site_logo', 'uploads/settings/logo_1778914864.png', '2026-05-16 01:31:04', '2026-05-16 01:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `type` enum('in','out') NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `product_variant_id`, `quantity`, `type`, `note`, `created_at`, `updated_at`) VALUES
(3, 2, 25, 5, 'in', 'First stock added', '2026-05-15 10:46:36', '2026-05-15 10:46:36'),
(4, 1, 19, 3, 'in', NULL, '2026-05-15 10:47:39', '2026-05-15 10:47:39'),
(5, 3, NULL, 10, 'in', 'White color stock', '2026-05-15 10:52:32', '2026-05-15 10:52:32'),
(6, 5, NULL, 10, 'in', 'Charger lot', '2026-05-18 00:01:05', '2026-05-18 00:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role_id`, `status`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', NULL, '$2y$10$F1JEJkqbxwoOO.RGkSTIOuJM4cEcxR3KIKH14iQsgIfk9XdlFZYNm', NULL, NULL, NULL, 1, 'active', NULL, NULL, NULL, '2026-05-15 01:23:17', '2026-05-15 01:23:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `brand_categories`
--
ALTER TABLE `brand_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_categories_brand_id_foreign` (`brand_id`),
  ADD KEY `brand_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_imeis`
--
ALTER TABLE `product_imeis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_imeis_imei_number_unique` (`imei_number`),
  ADD KEY `product_imeis_product_id_foreign` (`product_id`),
  ADD KEY `product_imeis_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`),
  ADD KEY `stocks_product_variant_id_foreign` (`product_variant_id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_categories`
--
ALTER TABLE `brand_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_imeis`
--
ALTER TABLE `product_imeis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand_categories`
--
ALTER TABLE `brand_categories`
  ADD CONSTRAINT `brand_categories_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_imeis`
--
ALTER TABLE `product_imeis`
  ADD CONSTRAINT `product_imeis_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_imeis_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
