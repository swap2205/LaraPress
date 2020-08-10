-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2020 at 04:30 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_navigations`
--

CREATE TABLE `admin_navigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nav_order` bigint(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_navigations`
--

INSERT INTO `admin_navigations` (`id`, `title`, `uri`, `icon_class`, `parent_id`, `status`, `created_at`, `updated_at`, `nav_order`) VALUES
(1, 'Dashboard', 'admin/dashboard', 'fas fa-tachometer-alt', 0, 1, '2020-07-26 12:53:31', '2020-07-26 22:00:07', 1),
(2, 'Users', 'admin/users', 'fa fa-users', 0, 1, '2020-07-26 12:55:31', '2020-07-26 23:34:00', 2),
(3, 'CMS', '#', 'fas fa-palette', 0, 1, '2020-07-26 13:02:02', '2020-07-27 04:09:29', 3),
(4, 'News', 'admin/cms/list/news', 'far fa-newspaper', 3, 1, '2020-07-26 13:04:02', '2020-07-27 03:32:39', 5),
(5, 'Blogs', 'admin/cms/list/blog', 'fa fa-file', 3, 1, '2020-07-26 13:04:41', '2020-07-27 03:32:39', 6),
(6, 'Pages', 'admin/cms/list/page', 'far fa-file-alt', 3, 1, '2020-07-26 13:23:06', '2020-07-27 03:32:39', 4),
(7, 'Setup', '#', 'fa fa-cogs', 0, 1, '2020-07-26 23:20:16', '2020-08-08 23:16:18', 11),
(8, 'App Settings', 'app/settings', 'fa fa-cog', 7, 1, '2020-07-26 23:55:02', '2020-08-08 23:16:18', 13),
(9, 'Admin Navigation', 'app/settings/admin_nav', 'fa fa-cog', 7, 1, '2020-07-27 00:31:39', '2020-08-10 02:27:53', 12),
(10, 'User Navigation', 'app/settings/user_nav', 'fa fa-cog', 12, 1, '2020-07-28 11:51:59', '2020-07-30 12:14:42', 9),
(11, 'Gallery', '#', 'fa fa-image', 3, 1, '2020-07-28 11:52:44', '2020-07-29 10:47:32', 7),
(12, 'Appearance', '#', 'fa fa-palette', 0, 1, '2020-07-29 10:50:20', '2020-07-29 10:52:08', 8),
(13, 'My Themes', 'app/themes', 'fa fa-palette', 12, 1, '2020-08-08 23:15:47', '2020-08-09 07:34:43', 10);

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Create Tasks', 'create-tasks', '2020-06-13 00:09:43', '2020-06-13 00:09:43'),
(2, 'Edit Users', 'edit-users', '2020-06-13 00:09:43', '2020-06-13 00:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Front-end Developer', 'developer', '2020-06-13 00:09:41', '2020-06-13 00:09:41'),
(2, 'Assistant Manager', 'manager', '2020-06-13 00:09:43', '2020-06-13 00:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `is_super`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Swapnil', 'swap@test.com', 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2020-06-08 16:50:48', '2020-06-08 16:50:48'),
(2, 'Kumar Vinnakota 123', 'kumar123@gmail.com', 0, NULL, '$2y$10$1dAGjh/vrnuq5FzFESV2ROdHpXZHyjz3WnKoB3DYd81HtgpjRPvGu', NULL, '2020-06-11 22:59:38', '2020-06-15 00:59:27'),
(3, 'Swapnil M.', 'skm@gmail.com', 0, NULL, '$2y$10$Xo/E5lJSMjZxY3p5LNPIpeK9BQWYutpeji3fwhD08kAR.2PoCr5lq', NULL, '2020-06-13 00:09:43', '2020-06-13 00:09:43'),
(4, 'Anil 123', 'anilv@gmail.com', 0, NULL, '$2y$10$EWoz8wU/kNwgCs6TA4kgLe8OxcyoFXKsB9PVZqeTdLmi3gFsHPLrC', NULL, '2020-06-13 00:09:44', '2020-06-15 01:01:17'),
(5, 'KM Swapnil', 'swap@yahoo.com', 1, NULL, '$2y$10$V/Z9SIjEEvhljq1LeZr65edei6tQ9ne5IqmLwzIFzPoRrGzW/qRXO', NULL, '2020-06-14 07:59:13', '2020-06-14 07:59:13'),
(6, 'test 123', 'test@swap.com', 0, NULL, '$2y$10$W5UnXyE7wL4XlZAE2NHegeMwtZMECx1Fj0a1QvO5qLUrwyDc1VsJO', NULL, '2020-06-15 00:53:01', '2020-06-15 00:53:01'),
(7, 'test 345', 'test345@gmail.com', 0, NULL, '$2y$10$ekc6vbXhIH8a.aoE4zsn/uy6IKI2RPnig/8dlj3QFFA/CFCBHmEuS', NULL, '2020-06-15 00:53:43', '2020-06-15 00:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_permissions`
--

CREATE TABLE `admin_users_permissions` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users_permissions`
--

INSERT INTO `admin_users_permissions` (`user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, NULL),
(4, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_roles`
--

CREATE TABLE `admin_users_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users_roles`
--

INSERT INTO `admin_users_roles` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, NULL),
(4, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `end_users`
--

CREATE TABLE `end_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` smallint(6) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_07_131445_create_admin_users_table', 1),
(5, '2020_06_07_131848_create_end_users_table', 1),
(6, '2020_06_07_133532_create_admin_password_resets_table', 1),
(7, '2020_06_11_111302_create_admin_roles_table', 2),
(8, '2020_06_11_111354_create_admin_permissions_table', 2),
(9, '2020_06_11_112715_create_admin_users_permissions_table', 2),
(10, '2020_06_11_133424_create_admin_users_roles_table', 2),
(11, '2020_06_11_134529_create_permissions_roles_table', 2),
(12, '2020_06_15_173601_create_pages_table', 3),
(13, '2020_07_11_141330_create_page_types_table', 4),
(15, '2020_07_25_093210_create_settings_table', 5),
(17, '2020_07_26_083822_create_admin_navigation_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `meta_keywords`, `meta_description`, `slug`, `page_type`, `content`, `template_name`, `featured_image`, `status`, `parent_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test 1234', 'test 123', 'test 123', 'test-123-user', 'page', 'test 123', 'layout', NULL, 1, 0, 1, 1, '2020-06-17 11:37:58', '2020-06-17 11:56:49'),
(2, 'My Blog 123', 'Blog 123', 'Blog 123', 'blog-123', 'blog', '<blockquote class=\"blockquote\">Blog 123</blockquote>', 'layout', NULL, 1, 0, 1, 1, '2020-06-20 07:09:37', '2020-06-28 07:26:07'),
(3, 'My Blog 456', 'My Blog 456', 'My Blog 456', 'my-blog-456', 'blog', 'My <span style=\"background-color: rgb(255, 255, 0);\">Blog </span>456', 'sidebar', NULL, 1, 0, 1, 1, '2020-06-20 07:20:20', '2020-06-28 07:27:51'),
(4, 'News 123', 'News 123', 'News 123', 'news-123', 'news', 'News 123', 'layout', NULL, 1, 0, 1, 1, '2020-06-20 07:29:58', '2020-06-20 07:29:58'),
(5, 'My new Project 1 heyyyyyyy', 'My new Project 1 heyyyyyyy', 'My new Project 1 heyyyyyyy', 'post-no-2', 'news', 'My new Project 1 heyyyyyyy', 'Page', 'images/nYUf4GZrNJsuGFyabMtE0Hv5R5oQPguJX1otmCPm.jpeg', 1, 0, 1, 1, '2020-06-20 12:11:50', '2020-08-08 22:53:24'),
(6, 'MSME Admin projectt launched', 'MSME Admin projectt launched', 'MSME Admin projectt launched', 'msme-admin-projectt-launched', 'news', '<p><b>MSME Admin projectt launched</b>,&nbsp;<u>MSME Admin <span style=\"background-color: rgb(255, 255, 0);\">projectt</span> launched</u><br></p>', 'layout', 'images/2Cuk0WZ627On6YSgSRuUMPIyKJGCbJABHFzcr9H9.png', 1, 0, 1, 1, '2020-07-04 07:42:29', '2020-07-04 07:42:29'),
(7, 'My product 1', 'My product 1', 'My product 1', 'my-product-one', 'news', '<p>My product 1.&nbsp;<b>My product 1</b><br></p>', 'layout', 'images/aBdYyBmDxxtdnlv5nOyC1zhSxzwknYmR51AjdFCP.jpeg', 1, 0, 1, 1, '2020-07-05 06:11:15', '2020-07-05 07:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `page_types`
--

CREATE TABLE `page_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_types`
--

INSERT INTO `page_types` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'My News', 'news', '2020-07-11 08:59:19', '2020-07-11 08:59:19'),
(2, 'Our Blogs', 'blog', '2020-07-11 09:00:49', '2020-07-11 09:00:49'),
(3, 'General Page', 'page', '2020-07-11 09:01:34', '2020-07-11 09:01:34'),
(4, 'Our Services', 'services', '2020-07-11 12:19:21', '2020-07-11 12:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions_roles`
--

CREATE TABLE `permissions_roles` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions_roles`
--

INSERT INTO `permissions_roles` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'swapnil app', 'general', '2020-07-25 07:46:22', '2020-07-30 12:14:04'),
(2, 'app_description', 'My CMS Portal for web', 'general', '2020-07-25 07:46:22', '2020-07-25 08:19:48'),
(3, 'maintennance_mode', '1', 'general', '2020-07-25 07:46:22', '2020-07-26 00:47:16'),
(4, 'app_theme', 'business-casual', 'options', '2020-07-25 08:20:49', '2020-08-10 02:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_navigations`
--
ALTER TABLE `admin_navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `admin_users_permissions`
--
ALTER TABLE `admin_users_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `admin_users_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `admin_users_roles`
--
ALTER TABLE `admin_users_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `admin_users_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `end_users`
--
ALTER TABLE `end_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `end_users_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_types`
--
ALTER TABLE `page_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions_roles`
--
ALTER TABLE `permissions_roles`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permissions_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

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
-- AUTO_INCREMENT for table `admin_navigations`
--
ALTER TABLE `admin_navigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `end_users`
--
ALTER TABLE `end_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `page_types`
--
ALTER TABLE `page_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_users_permissions`
--
ALTER TABLE `admin_users_permissions`
  ADD CONSTRAINT `admin_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `admin_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admin_users_roles`
--
ALTER TABLE `admin_users_roles`
  ADD CONSTRAINT `admin_users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions_roles`
--
ALTER TABLE `permissions_roles`
  ADD CONSTRAINT `permissions_roles_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `admin_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permissions_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
