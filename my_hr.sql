-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2022 at 04:09 AM
-- Server version: 8.0.29-0ubuntu0.22.04.2
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_hr_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `check_in_outs`
--

CREATE TABLE `check_in_outs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `date` date DEFAULT NULL,
  `check_in` timestamp NULL DEFAULT NULL,
  `check_out` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

CREATE TABLE `company_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `break_start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `break_end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_department_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `total_employees` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `head_department_id`, `phone`, `email`, `start_date`, `total_employees`, `created_at`, `updated_at`) VALUES
(1, 'Web Devloper', '1', '33333334444', 'webdev@gmail.com', '2022-06-01', '10', '2022-06-28 06:56:55', '2022-06-28 06:56:55');

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
-- Table structure for table `head_of_deps`
--

CREATE TABLE `head_of_deps` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `head_of_deps`
--

INSERT INTO `head_of_deps` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Digital Marketing', '2022-06-28 06:55:43', '2022-06-28 06:55:43'),
(2, 'Marketing', '2022-06-28 06:55:51', '2022-06-28 06:55:51'),
(3, 'Management', '2022-06-28 06:56:09', '2022-06-28 06:56:09');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_10_205114_create_departments_table', 1),
(6, '2022_04_10_211349_create_head_of_deps_table', 1),
(7, '2022_04_14_155501_create_permission_tables', 1),
(8, '2022_04_15_054220_create_company_infos_table', 1),
(9, '2022_04_15_150230_create_check_in_outs_table', 1),
(10, '2022_04_17_134256_create_salaries_table', 1),
(11, '2022_04_18_142113_create_projects_table', 1),
(12, '2022_04_18_142508_create_project_leaders_table', 1),
(13, '2022_04_18_142519_create_project_members_table', 1),
(14, '2022_04_21_095304_create_tasks_table', 1),
(15, '2022_04_21_095719_create_task_members_table', 1),
(16, '2022_04_24_110635_add_serial_number_col_to_tasks_table', 1);

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
(4, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3);

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
(1, 'view_employee', 'web', '2022-06-28 06:59:40', '2022-06-28 06:59:40'),
(2, 'create_employee', 'web', '2022-06-28 06:59:49', '2022-06-28 06:59:49'),
(3, 'edit_employee', 'web', '2022-06-28 06:59:58', '2022-06-28 06:59:58'),
(4, 'delete_employee', 'web', '2022-06-28 07:00:08', '2022-06-28 07:00:08'),
(5, 'view_project', 'web', '2022-06-28 07:17:52', '2022-06-28 07:17:52'),
(6, 'create_permission', 'web', '2022-06-28 07:17:59', '2022-06-28 07:17:59'),
(7, 'edit_project', 'web', '2022-06-28 07:18:16', '2022-06-28 07:18:16'),
(8, 'view_permission', 'web', '2022-07-28 02:41:29', '2022-07-28 02:41:29'),
(9, 'edit_permission', 'web', '2022-07-28 02:41:45', '2022-07-28 02:41:45'),
(10, 'delete_permission', 'web', '2022-07-28 02:42:00', '2022-07-28 02:42:00'),
(11, 'view_role', 'web', '2022-07-28 02:45:30', '2022-07-28 02:45:30'),
(12, 'create_role', 'web', '2022-07-28 02:45:36', '2022-07-28 02:45:36'),
(13, 'edit_role', 'web', '2022-07-28 02:45:42', '2022-07-28 02:45:42'),
(14, 'delete_role', 'web', '2022-07-28 02:45:47', '2022-07-28 02:45:47'),
(15, 'view_payroll', 'web', '2022-07-28 02:52:10', '2022-07-28 02:52:10'),
(16, 'create_payroll', 'web', '2022-07-28 02:52:20', '2022-07-28 02:52:20'),
(17, 'edit_payroll', 'web', '2022-07-28 02:52:27', '2022-07-28 02:52:27'),
(18, 'delete_payroll', 'web', '2022-07-28 02:52:37', '2022-07-28 02:52:37'),
(19, 'view_salary', 'web', '2022-07-28 02:52:57', '2022-07-28 02:52:57'),
(20, 'create_salary', 'web', '2022-07-28 02:53:05', '2022-07-28 02:53:05'),
(21, 'edit_salary', 'web', '2022-07-28 02:53:11', '2022-07-28 02:53:11'),
(22, 'delete_salary', 'web', '2022-07-28 02:53:19', '2022-07-28 02:53:19'),
(23, 'view_attendance', 'web', '2022-07-28 02:56:59', '2022-07-28 02:56:59'),
(24, 'create_attendance', 'web', '2022-07-28 02:57:07', '2022-07-28 02:57:07'),
(25, 'edit_attendance', 'web', '2022-07-28 02:57:15', '2022-07-28 02:57:15'),
(26, 'delete_attendance', 'web', '2022-07-28 02:57:23', '2022-07-28 02:57:23'),
(27, 'view_department', 'web', '2022-07-28 02:58:14', '2022-07-28 02:58:14'),
(28, 'edit_department', 'web', '2022-07-28 02:58:27', '2022-07-28 02:58:27'),
(29, 'create_department', 'web', '2022-07-28 02:58:43', '2022-07-28 02:58:43'),
(30, 'delete_department', 'web', '2022-07-28 02:58:52', '2022-07-28 02:58:52'),
(31, 'view_head-dept', 'web', '2022-07-28 03:00:09', '2022-07-28 03:00:09'),
(32, 'create_head-dept', 'web', '2022-07-28 03:00:18', '2022-07-28 03:00:53'),
(33, 'edit_head-dept', 'web', '2022-07-28 03:01:00', '2022-07-28 03:01:00'),
(34, 'delete_head-dept', 'web', '2022-07-28 03:01:08', '2022-07-28 03:01:08'),
(35, 'create_project', 'web', '2022-07-28 03:06:03', '2022-07-28 03:06:03'),
(36, 'delete_project', 'web', '2022-07-28 03:06:24', '2022-07-28 03:06:24');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `priority` enum('high','middle','low') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','in_progress','complete') COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` text COLLATE utf8mb4_unicode_ci,
  `photos` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `start_date`, `deadline`, `priority`, `status`, `files`, `photos`, `created_at`, `updated_at`) VALUES
(1, 'Graphic', 'client hold the project', '2022-06-01', '2022-06-30', 'high', 'in_progress', '[\"project_62baad68daed5.pdf\",\"project_62baad68e1c34.pdf\"]', '[\"project_62e1fca0d2f5b.jpeg\"]', '2022-06-28 07:26:55', '2022-07-28 03:04:00'),
(2, 'Video Production 1', 'OM Video Production', '2022-06-29', '2022-06-30', 'high', 'in_progress', NULL, NULL, '2022-06-28 08:39:35', '2022-06-28 08:39:35'),
(3, 'Job Request', 'Client Information Sharing', '2022-07-28', '2022-07-31', 'middle', 'in_progress', '[\"project_62e2018eb5ed8.pdf\"]', NULL, '2022-07-28 03:25:02', '2022-07-28 03:25:02'),
(4, 'Job Request', 'Client Information Sharing', '2022-07-28', '2022-07-30', 'middle', 'in_progress', '[\"project_62e203ad7ea9a.pdf\"]', NULL, '2022-07-28 03:34:05', '2022-07-28 03:34:05'),
(5, 'Job Request', 'Client Information Sharing', '2022-07-28', '2022-07-29', 'high', 'in_progress', '[\"project_62e204595cb1b.pdf\"]', NULL, '2022-07-28 03:36:57', '2022-07-28 03:36:57'),
(6, 'Job Request', 'Client Information Sharing', '2022-07-28', '2022-07-29', 'low', 'pending', '[\"project_62e20485ba86a.pdf\"]', NULL, '2022-07-28 03:37:41', '2022-07-28 03:37:41'),
(7, 'Job Request', 'Client Information Sharing', '2022-07-28', '2022-07-29', 'high', 'pending', '[\"project_62e204f28a97d.pdf\"]', NULL, '2022-07-28 03:39:30', '2022-07-28 03:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `project_leaders`
--

CREATE TABLE `project_leaders` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_leaders`
--

INSERT INTO `project_leaders` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 5, 3, NULL, NULL),
(6, 6, 3, NULL, NULL),
(7, 7, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 2, NULL, NULL),
(6, 6, 2, NULL, NULL),
(7, 7, 3, NULL, NULL);

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
(1, 'Staff', 'web', '2022-06-28 07:01:14', '2022-07-28 02:47:35'),
(4, 'MD', 'web', '2022-07-28 02:46:35', '2022-07-28 02:46:35');

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
(5, 1),
(7, 1),
(35, 1),
(36, 1),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `serial_number` int NOT NULL DEFAULT '0',
  `project_id` bigint NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `priority` enum('high','middle','low') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','in_progress','complete') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `serial_number`, `project_id`, `title`, `description`, `start_date`, `deadline`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'jr for motion designer', 'dfafjdakf;adsjfk;lasd', '2022-06-01', '2022-06-29', 'middle', 'pending', '2022-06-28 07:28:41', '2022-07-28 02:55:09'),
(2, 1, 1, 'san kyi tar par', 'dfafafd', '2022-06-03', '2022-06-17', 'low', 'pending', '2022-06-28 07:30:21', '2022-07-28 02:55:09'),
(3, 0, 1, 'AE JR', 'Job Description', '2022-06-28', '2022-06-29', 'middle', 'in_progress', '2022-06-28 08:37:24', '2022-06-28 09:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `task_members`
--

CREATE TABLE `task_members` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_members`
--

INSERT INTO `task_members` (`id`, `task_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '123456',
  `nrc_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `dep_id` bigint DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_img`, `employee_id`, `phone`, `pin_code`, `nrc_number`, `birthday`, `gender`, `address`, `dep_id`, `date_of_join`, `is_present`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Seo Jun', 'seojun@gmail.com', NULL, '$2y$10$nPtiCyhrAGtWiDpe3XX9k.72gEDD535.2vK2FEuhMsARivK2mO6qS', 'profile_62e1fa7d7e9e6.png', '12345', '09421711078', '123456', '3/BaAhNa(N)295279', '2012-12-04', 'male', 'vdafaf', 1, '2022-05-23', 1, NULL, '2022-06-17 06:55:34', '2022-07-28 02:54:53'),
(2, 'Ma Sone', 'mario@gmail.com', NULL, '$2y$10$JKDd/OzFizcxymlJGPFMB.McdciAhAjYLBL0BKFVbXrONN1W7.uP.', NULL, '14215', '09421711079', '123123', '4/asdf123', '1998-06-02', 'male', 'Yangon', 1, '2022-05-24', 1, 'VTv8EvhCLJGSCbDFG48JfeVxXxG3ENemWRQY4Huvs7gxfz1NujWbRR8JLsIw', '2022-06-28 07:12:50', '2022-07-28 03:27:32'),
(3, 'Ma Mya', 'mamya@gmail.com', NULL, '$2y$10$Z/7fTiTSOJSJNAEWHnd3VeMNOxKpiRe.XcCUMbQYyiIbKj9f8AOBK', NULL, '12346', '09421711077', '111111', '3/abc123321', '1995-03-30', 'female', 'Yangon', 1, '2022-01-04', 1, NULL, '2022-07-28 03:33:20', '2022-07-28 03:33:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_in_outs`
--
ALTER TABLE `check_in_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_infos`
--
ALTER TABLE `company_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `head_of_deps`
--
ALTER TABLE `head_of_deps`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_leaders`
--
ALTER TABLE `project_leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_user_id_foreign` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_members`
--
ALTER TABLE `task_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_nrc_number_unique` (`nrc_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_in_outs`
--
ALTER TABLE `check_in_outs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_infos`
--
ALTER TABLE `company_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `head_of_deps`
--
ALTER TABLE `head_of_deps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_leaders`
--
ALTER TABLE `project_leaders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_members`
--
ALTER TABLE `task_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
