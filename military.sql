-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 10:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `military`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_forms`
--

CREATE TABLE `exam_forms` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_enabled` tinyint(4) NOT NULL DEFAULT 0,
  `level_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_forms`
--

INSERT INTO `exam_forms` (`id`, `name`, `is_enabled`, `level_id`, `created_at`, `updated_at`) VALUES
(97, 'طبوغرافيا - مستوى أ', 1, 1, '2022-01-20 17:00:33', '2022-01-20 17:00:33'),
(98, 'طبوغرافيا - مستوى ب', 1, 2, '2022-01-20 17:00:33', '2022-01-20 17:00:33'),
(100, 'لغة عربية - مستوى ج', 1, 3, '2022-01-20 17:00:33', '2022-01-20 17:00:33'),
(101, 'لغة عربية - مستوى د', 1, 4, '2022-01-20 17:00:33', '2022-01-20 17:00:33'),
(102, 'قتال عسكرى - مستوى أ', 1, 1, '2022-01-20 17:00:33', '2022-01-20 17:00:33'),
(103, 'قتال عسكرى - مستوى ج', 1, 3, '2022-01-20 17:00:33', '2022-01-20 17:00:33'),
(104, 'قتال عسكرى - مستوى د', 1, 4, '2022-01-20 17:00:33', '2022-01-20 17:00:33'),
(105, 'اختبار إضافة مادة - مستوى أ', 1, 1, NULL, NULL),
(106, 'اختبار إضافة مادة - مستوى ب', 1, 2, NULL, NULL),
(107, 'اختبار إضافة مادة - مستوى د', 1, 4, NULL, NULL),
(108, 'بببببب - مستوى ج', 1, 3, NULL, NULL),
(109, 'مدرعات - مستوى أ', 1, 1, NULL, NULL),
(110, 'مدرعات - مستوى ج', 1, 3, NULL, NULL),
(111, 'مدرعات - مستوى ضباط الصف', 1, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_form_questions`
--

CREATE TABLE `exam_form_questions` (
  `id` int(10) NOT NULL,
  `exam_form_id` int(10) NOT NULL,
  `questions_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_form_questions`
--

INSERT INTO `exam_form_questions` (`id`, `exam_form_id`, `questions_id`, `created_at`, `updated_at`) VALUES
(4027, 97, 2, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4028, 98, 2, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4029, 102, 3, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4030, 97, 4, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4031, 101, 7, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4032, 101, 3, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4033, 101, 2, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4034, 104, 8, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4035, 104, 9, '2022-01-20 17:01:10', '2022-01-20 17:01:10'),
(4036, 100, 10, NULL, NULL),
(4037, 102, 10, NULL, NULL),
(4038, 104, 10, NULL, NULL),
(4039, 107, 11, NULL, NULL),
(4040, 101, 12, NULL, NULL),
(4041, 101, 13, NULL, NULL),
(4042, 101, 14, NULL, NULL),
(4043, 101, 15, NULL, NULL),
(4044, 101, 16, NULL, NULL),
(4045, 101, 17, NULL, NULL),
(4046, 101, 18, NULL, NULL),
(4047, 101, 19, NULL, NULL),
(4048, 109, 20, NULL, NULL),
(4049, 110, 20, NULL, NULL),
(4050, 111, 20, NULL, NULL);

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
-- Table structure for table `final_result`
--

CREATE TABLE `final_result` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `total_correct` int(10) NOT NULL,
  `total_failed` int(10) NOT NULL,
  `exam_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `final_result`
--

INSERT INTO `final_result` (`id`, `user_id`, `exam_name`, `total_correct`, `total_failed`, `exam_count`, `created_at`, `updated_at`) VALUES
(257, 9, 'لغة_عربية_-_مستوى_د', 3, 7, 1, '2022-01-24 17:13:06', '2022-01-24 17:13:06'),
(258, 9, 'قتال_عسكرى_-_مستوى_د', 1, 2, 1, '2022-01-24 17:13:06', '2022-01-24 17:13:06'),
(259, 9, 'اختبار_إضافة_مادة_-_مستوى_د', 0, 1, 1, '2022-01-24 17:13:06', '2022-01-24 17:13:06'),
(260, 9, 'لغة_عربية_-_مستوى_د', 3, 7, 2, '2022-01-24 18:13:45', '2022-01-24 18:13:45'),
(261, 9, 'قتال_عسكرى_-_مستوى_د', 1, 2, 2, '2022-01-24 18:13:45', '2022-01-24 18:13:45'),
(262, 9, 'اختبار_إضافة_مادة_-_مستوى_د', 0, 1, 2, '2022-01-24 18:13:45', '2022-01-24 18:13:45'),
(263, 9, 'لغة_عربية_-_مستوى_د', 3, 7, 3, '2022-01-24 19:44:39', '2022-01-24 19:44:39'),
(264, 9, 'قتال_عسكرى_-_مستوى_د', 1, 2, 3, '2022-01-24 19:44:39', '2022-01-24 19:44:39'),
(265, 9, 'اختبار_إضافة_مادة_-_مستوى_د', 0, 1, 3, '2022-01-24 19:44:39', '2022-01-24 19:44:39'),
(266, 9, 'لغة_عربية_-_مستوى_د', 3, 7, 4, '2022-01-27 16:31:37', '2022-01-27 16:31:37'),
(267, 9, 'قتال_عسكرى_-_مستوى_د', 1, 2, 4, '2022-01-27 16:31:37', '2022-01-27 16:31:37'),
(268, 9, 'اختبار_إضافة_مادة_-_مستوى_د', 0, 1, 4, '2022-01-27 16:31:37', '2022-01-27 16:31:37'),
(269, 9, 'لغة_عربية_-_مستوى_د', 4, 6, 5, '2022-01-27 16:32:28', '2022-01-27 16:32:28'),
(270, 9, 'قتال_عسكرى_-_مستوى_د', 1, 2, 5, '2022-01-27 16:32:28', '2022-01-27 16:32:28'),
(271, 9, 'اختبار_إضافة_مادة_-_مستوى_د', 0, 1, 5, '2022-01-27 16:32:28', '2022-01-27 16:32:28'),
(272, 9, 'لغة_عربية_-_مستوى_د', 3, 7, 6, '2022-01-27 16:32:56', '2022-01-27 16:32:56'),
(273, 9, 'قتال_عسكرى_-_مستوى_د', 3, 0, 6, '2022-01-27 16:32:56', '2022-01-27 16:32:56'),
(274, 9, 'اختبار_إضافة_مادة_-_مستوى_د', 0, 1, 6, '2022-01-27 16:32:56', '2022-01-27 16:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `original_name` varchar(600) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `original_name`, `category`, `created_at`, `updated_at`, `subject_id`, `section_id`) VALUES
(18, '16431871540.txt', 'GPL.txt', 2, '2022-01-26 06:52:34', '2022-01-26 06:52:34', 3, 2),
(19, '16433115510.txt', 'GPL.txt', 1, '2022-01-27 17:25:51', '2022-01-27 17:25:51', 7, 3),
(20, '16433115511.txt', 'README_License.txt', 1, '2022-01-27 17:25:51', '2022-01-27 17:25:51', 7, 1),
(22, '16431871540.txt', 'GPL.txt', 2, '2022-01-26 06:52:34', '2022-01-26 06:52:34', 5, 2),
(23, '16433125430.txt', 'GPL.txt', 2, '2022-01-27 17:42:23', '2022-01-27 17:42:23', 6, 1),
(24, '16433125431.txt', 'README_License.txt', 2, '2022-01-27 17:42:23', '2022-01-27 17:42:23', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lending_library`
--

CREATE TABLE `lending_library` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_code` varchar(255) NOT NULL,
  `book_description` varchar(255) NOT NULL,
  `book_year` int(11) NOT NULL,
  `book_copies` int(11) NOT NULL,
  `available_copies` int(11) NOT NULL,
  `pending_copies` int(11) NOT NULL,
  `book_place` varchar(255) NOT NULL,
  `library_id` int(11) NOT NULL,
  `library_section` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lending_library`
--

INSERT INTO `lending_library` (`id`, `book_name`, `book_code`, `book_description`, `book_year`, `book_copies`, `available_copies`, `pending_copies`, `book_place`, `library_id`, `library_section`, `created_at`, `updated_at`) VALUES
(1, 'تأمين رؤوس الكبارى', 'ac25se8', 'ضرب تل العقارب', 1987, 5, 4, 1, 'الرف الثالث العمود الرابع', 1, 0, '2022-01-27 07:57:09', '2022-01-27 11:18:44'),
(2, 'تأمين رؤوس الكبارى', 'ac25se8', 'ضرب تل العقارب', 1987, 5, 5, 0, 'الرف الثالث العمود الرابع', 2, 1, '2022-01-27 07:57:09', '2022-01-27 12:53:04'),
(3, 'تأمين رؤوس الكبارى', 'ac25se8', 'ضرب تل العقارب', 1987, 5, 4, 1, 'الرف الثالث العمود الرابع', 2, 2, '2022-01-27 07:57:09', '2022-01-27 11:18:44'),
(4, 'تأمين رؤوس الكبارى', 'ac25se8', 'ضرب تل العقارب', 1987, 5, 4, 1, 'الرف الثالث العمود الرابع', 1, 0, '2022-01-27 07:57:09', '2022-01-27 11:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `lending_log`
--

CREATE TABLE `lending_log` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `lending_start_date` varchar(255) NOT NULL,
  `lending_end_date` varchar(255) NOT NULL,
  `rotba` varchar(255) NOT NULL,
  `lender_name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lending_log`
--

INSERT INTO `lending_log` (`id`, `book_id`, `lending_start_date`, `lending_end_date`, `rotba`, `lender_name`, `unit`, `mobile_number`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'sadfasd', 'fasdfasd', 'fasdfasdf', 'asdfas', 'fdasdfasdf', 34563456, 1, '2022-01-27 11:19:14', '2022-01-27 11:19:14'),
(2, 2, '27/1/2022', '1/3/2022', 'عميد', 'محمد ابراهيم', 'الاشارة', 1066763260, 0, '2022-01-27 12:25:14', '2022-01-27 12:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'أ', '2022-01-27 21:49:13', '2022-01-27 21:49:13'),
(2, 'ب', '2022-01-27 21:49:13', '2022-01-27 21:49:13'),
(3, 'ج', '2022-01-27 21:49:13', '2022-01-27 21:49:13'),
(4, 'د', '2022-01-27 21:49:13', '2022-01-27 21:49:13'),
(5, 'ضباط صف', '2022-01-27 21:49:13', '2022-01-27 21:49:13');

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
(5, '2022_01_11_084008_create_factions_table', 1),
(6, '2022_01_11_083854_create_exam-forms_table', 2),
(7, '2022_01_11_083926_create_exam-form-questions_table', 3),
(8, '2022_01_11_083812_create_question_choises_table', 4),
(9, '2022_01_11_112436_create_roles_table', 5),
(10, '2022_01_11_113023_create_user_roles_table', 6);

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
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'سؤال تجريبى للمواد', NULL, NULL),
(2, 'سؤال تجريبى للمواد', NULL, NULL),
(3, 'السؤال التجريبى الثانى ؟', NULL, NULL),
(4, 'ujnyhbbgvhj', NULL, NULL),
(5, 'سؤال 1 لغة عربيىة', NULL, NULL),
(6, 'سؤال 1 لغة عربيىة', NULL, NULL),
(7, 'سؤال 1 لغة عربيىة', NULL, NULL),
(8, 'سؤال تجريبى', NULL, NULL),
(9, 'السؤال الثانى', NULL, NULL),
(10, 'سؤال اختبارى ؟', '2022-01-20 20:03:30', '2022-01-20 20:03:30'),
(11, 'سؤال اختبارى', '2022-01-20 20:12:57', '2022-01-20 20:12:57'),
(12, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', '2022-01-20 20:13:46', '2022-01-20 20:13:46'),
(13, 'سؤالسؤالسؤالسؤالسؤالسؤال', '2022-01-20 20:13:58', '2022-01-20 20:13:58'),
(14, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', '2022-01-20 20:14:06', '2022-01-20 20:14:06'),
(15, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', '2022-01-20 20:14:17', '2022-01-20 20:14:17'),
(16, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', '2022-01-20 20:14:26', '2022-01-20 20:14:26'),
(17, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', '2022-01-20 20:14:33', '2022-01-20 20:14:33'),
(18, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', '2022-01-20 20:14:43', '2022-01-20 20:14:43'),
(19, 'لباييلايلايلا', '2022-01-20 20:16:13', '2022-01-20 20:16:13'),
(20, 'إسم الممدرعة ؟', '2022-01-21 10:34:33', '2022-01-21 10:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `question_choises`
--

CREATE TABLE `question_choises` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `question_id` int(10) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_choises`
--

INSERT INTO `question_choises` (`id`, `title`, `question_id`, `is_correct`, `is_enabled`, `created_at`, `updated_at`) VALUES
(40, 'الاختيار الاول', 2, 0, 1, NULL, NULL),
(41, 'الاختيار الثانى', 2, 0, 1, NULL, NULL),
(42, 'الاختيار الثالث', 2, 1, 1, NULL, NULL),
(43, 'الاختيار الرابع', 2, 0, 1, NULL, NULL),
(44, 'الاختيار الأول', 3, 0, 1, NULL, NULL),
(45, 'الاختيار الثانى', 3, 0, 1, NULL, NULL),
(46, 'الاختيار الثالث', 3, 0, 1, NULL, NULL),
(47, 'كل ما سبق', 3, 1, 1, NULL, NULL),
(48, 'jyhtgvrfcghy', 4, 0, 1, NULL, NULL),
(49, 'jnhygtghju', 4, 1, 1, NULL, NULL),
(50, 'hyjunh', 4, 0, 1, NULL, NULL),
(51, 'hyjunbhybhy', 4, 0, 1, NULL, NULL),
(52, 'اختيارررررر', 5, 0, 1, NULL, NULL),
(53, 'اختياررررررررراختيارررررر', 5, 1, 1, NULL, NULL),
(54, 'اختيارررررراختيارررررراختيارررررر', 5, 0, 1, NULL, NULL),
(55, 'اختيارررررراختيارررررراختيارررررراختيارررررر', 5, 0, 1, NULL, NULL),
(56, 'اختيارررررر', 6, 0, 1, NULL, NULL),
(57, 'اختياررررررررراختيارررررر', 6, 1, 1, NULL, NULL),
(58, 'اختيارررررراختيارررررراختيارررررر', 6, 0, 1, NULL, NULL),
(59, 'اختيارررررراختيارررررراختيارررررراختيارررررر', 6, 0, 1, NULL, NULL),
(60, 'اختيارررررر', 7, 0, 1, NULL, NULL),
(61, 'اختياررررررررراختيارررررر', 7, 1, 1, NULL, NULL),
(62, 'اختيارررررراختيارررررراختيارررررر', 7, 0, 1, NULL, NULL),
(63, 'اختيارررررراختيارررررراختيارررررراختيارررررر', 7, 0, 1, NULL, NULL),
(64, 'اختيار اول', 8, 0, 1, NULL, NULL),
(65, 'اختيار اولاختيار اول', 8, 1, 1, NULL, NULL),
(66, 'اختيار اولاختيار اولاختيار اول', 8, 0, 1, NULL, NULL),
(67, 'اختيار اولاختيار اولاختيار اولاختيار اول', 8, 0, 1, NULL, NULL),
(68, 'اختيار اولاختيار اولاختيار اولاختيار اول', 9, 0, 1, NULL, NULL),
(69, 'اختيار اولاختيار اولاختيار اولاختيار اولاختيار اول', 9, 1, 1, NULL, NULL),
(70, 'اختيار اولاختيار اولاختيار اولاختيار اولاختيار اولاختيار اول', 9, 0, 1, NULL, NULL),
(71, 'اختيار اولاختيار اولاختيار اولاختيار اولاختيار اولاختيار اولاختيار اول', 9, 0, 1, NULL, NULL),
(72, 'اختيار اختبارى', 10, 0, 1, '2022-01-20 20:03:30', '2022-01-20 20:03:30'),
(73, 'اختيار اختبارى اختيار اختبارى', 10, 0, 1, '2022-01-20 20:03:30', '2022-01-20 20:03:30'),
(74, 'اختيار اختبارى اختيار اختبارى اختيار اختبارى', 10, 1, 1, '2022-01-20 20:03:30', '2022-01-20 20:03:30'),
(75, 'اختيار اختبارى اختيار اختبارى اختيار اختبارى', 10, 0, 1, '2022-01-20 20:03:30', '2022-01-20 20:03:30'),
(76, 'اختيارر', 11, 1, 1, '2022-01-20 20:12:57', '2022-01-20 20:12:57'),
(77, 'اختيارراختيارر', 11, 0, 1, '2022-01-20 20:12:57', '2022-01-20 20:12:57'),
(78, 'اختيارراختيارراختيارراختيارر', 11, 0, 1, '2022-01-20 20:12:57', '2022-01-20 20:12:57'),
(79, 'اختيارراختيارراختيارراختيارر', 11, 0, 1, '2022-01-20 20:12:57', '2022-01-20 20:12:57'),
(80, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 12, 0, 1, '2022-01-20 20:13:46', '2022-01-20 20:13:46'),
(81, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 12, 1, 1, '2022-01-20 20:13:46', '2022-01-20 20:13:46'),
(82, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤال', 12, 0, 1, '2022-01-20 20:13:46', '2022-01-20 20:13:46'),
(83, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 12, 0, 1, '2022-01-20 20:13:46', '2022-01-20 20:13:46'),
(84, 'سؤالسؤالسؤالسؤالسؤالسؤال', 13, 0, 1, '2022-01-20 20:13:58', '2022-01-20 20:13:58'),
(85, 'سؤالسؤال', 13, 1, 1, '2022-01-20 20:13:58', '2022-01-20 20:13:58'),
(86, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 13, 0, 1, '2022-01-20 20:13:58', '2022-01-20 20:13:58'),
(87, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 13, 0, 1, '2022-01-20 20:13:58', '2022-01-20 20:13:58'),
(88, 'سؤالسؤال', 14, 1, 1, '2022-01-20 20:14:06', '2022-01-20 20:14:06'),
(89, 'سؤالسؤال', 14, 0, 1, '2022-01-20 20:14:06', '2022-01-20 20:14:06'),
(90, 'سؤال', 14, 0, 1, '2022-01-20 20:14:06', '2022-01-20 20:14:06'),
(91, 'سؤال', 14, 0, 1, '2022-01-20 20:14:06', '2022-01-20 20:14:06'),
(92, 'سؤالسؤالسؤالسؤال', 15, 0, 1, '2022-01-20 20:14:17', '2022-01-20 20:14:17'),
(93, 'سؤالسؤالسؤال', 15, 0, 1, '2022-01-20 20:14:17', '2022-01-20 20:14:17'),
(94, 'سؤالسؤالسؤال', 15, 0, 1, '2022-01-20 20:14:17', '2022-01-20 20:14:17'),
(95, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 15, 1, 1, '2022-01-20 20:14:17', '2022-01-20 20:14:17'),
(96, 'سؤال', 16, 0, 1, '2022-01-20 20:14:26', '2022-01-20 20:14:26'),
(97, 'سؤال', 16, 0, 1, '2022-01-20 20:14:26', '2022-01-20 20:14:26'),
(98, 'سؤال', 16, 1, 1, '2022-01-20 20:14:26', '2022-01-20 20:14:26'),
(99, 'سؤال', 16, 0, 1, '2022-01-20 20:14:26', '2022-01-20 20:14:26'),
(100, 'سؤال', 17, 1, 1, '2022-01-20 20:14:33', '2022-01-20 20:14:33'),
(101, 'سؤال', 17, 0, 1, '2022-01-20 20:14:33', '2022-01-20 20:14:33'),
(102, 'سؤال', 17, 0, 1, '2022-01-20 20:14:33', '2022-01-20 20:14:33'),
(103, 'سؤال', 17, 0, 1, '2022-01-20 20:14:33', '2022-01-20 20:14:33'),
(104, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 18, 0, 1, '2022-01-20 20:14:43', '2022-01-20 20:14:43'),
(105, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 18, 1, 1, '2022-01-20 20:14:43', '2022-01-20 20:14:43'),
(106, 'سؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤالسؤال', 18, 0, 1, '2022-01-20 20:14:43', '2022-01-20 20:14:43'),
(107, 'سؤالسؤالسؤالسؤال', 18, 0, 1, '2022-01-20 20:14:43', '2022-01-20 20:14:43'),
(108, 'لايلاييبلايل', 19, 0, 1, '2022-01-20 20:16:13', '2022-01-20 20:16:13'),
(109, 'بلبلللايبال', 19, 1, 1, '2022-01-20 20:16:13', '2022-01-20 20:16:13'),
(110, 'بيللايباليلاي', 19, 0, 1, '2022-01-20 20:16:13', '2022-01-20 20:16:13'),
(111, 'ليلايبلايلااي', 19, 0, 1, '2022-01-20 20:16:13', '2022-01-20 20:16:13'),
(112, 'اختيار 1', 20, 0, 1, '2022-01-21 10:34:33', '2022-01-21 10:34:33'),
(113, 'اختيار 1اختيار 1', 20, 0, 1, '2022-01-21 10:34:33', '2022-01-21 10:34:33'),
(114, 'اختيار 1اختيار 1اختيار 1', 20, 1, 1, '2022-01-21 10:34:33', '2022-01-21 10:34:33'),
(115, 'اختيار 1اختيار 1اختيار 1اختيار 1', 20, 0, 1, '2022-01-21 10:34:33', '2022-01-21 10:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', ''),
(2, 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `rotba`
--

CREATE TABLE `rotba` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rotba`
--

INSERT INTO `rotba` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'عريف', NULL, NULL),
(2, 'رقيب', NULL, NULL),
(3, 'رقيب أ', NULL, NULL),
(4, 'مساعد', NULL, NULL),
(5, 'مساعد أ', NULL, NULL),
(6, 'ملازم ش', NULL, NULL),
(7, 'ملازم أ ش', NULL, NULL),
(8, 'ملازم', NULL, NULL),
(9, 'ملازم أ', NULL, NULL),
(10, 'نقيب', NULL, NULL),
(11, 'رائد', NULL, NULL),
(12, 'رائد أح', NULL, NULL),
(13, 'مقدم', NULL, NULL),
(14, 'مقدم أح', NULL, NULL),
(15, 'عقيد', NULL, NULL),
(16, 'عقيد أح', NULL, NULL),
(17, 'عميد أح', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `library_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `library_id`, `section_id`, `created_at`, `updated_at`) VALUES
(3, 'قتال عسكرى', 1, 2, '2022-01-26 06:52:16', '2022-01-26 06:52:16'),
(5, 'قتال عسكرى', 1, 2, '2022-01-26 06:52:16', '2022-01-26 06:52:16'),
(6, 'قتال عسكرى', 2, 1, '2022-01-26 06:52:16', '2022-01-26 06:52:16'),
(7, 'مادة للمكتبة الثقافية قسم كتب ومراجع', 1, 1, '2022-01-27 17:21:12', '2022-01-27 17:21:12'),
(8, 'قتال عسكرى', 2, 3, '2022-01-26 06:52:16', '2022-01-26 06:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

CREATE TABLE `timer` (
  `id` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timer`
--

INSERT INTO `timer` (`id`, `duration`, `created_at`, `updated_at`) VALUES
(0, '60', NULL, '2022-01-21 10:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'قيا ل ٩ مش ميكا', NULL, NULL),
(2, 'الكتيبة ٤٠٧ مش ميكا', NULL, NULL),
(3, 'الكتيبة ٤٠٨ مش ميكا', NULL, NULL),
(4, 'الكتيبة ٤٠٩', NULL, NULL),
(5, 'الكتيبة ٩ بب', NULL, NULL),
(6, 'الكتيبة ٩ تو', NULL, NULL),
(7, 'الكتيبة ٥٤٣ مد وسط', NULL, NULL),
(8, 'الكتيبة ٥٦٣ مد م ط', NULL, NULL),
(9, 'سرية القيادة ', NULL, NULL),
(10, 'سرية الإشارة', NULL, NULL),
(11, 'سرية التأمين الفني', NULL, NULL),
(12, 'سرية الإستطلاع', NULL, NULL),
(13, 'سرية النقل', NULL, NULL),
(14, 'سرية المهندسين', NULL, NULL),
(15, 'السرية الطبية', NULL, NULL),
(16, 'فصيلة الشرطة العسكرية', NULL, NULL),
(17, 'فصيلة الحرب الكيميائية', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `mil_number` bigint(50) NOT NULL,
  `rotba_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `job_name` varchar(255) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL,
  `level_id` int(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_user_did_exam_before` tinyint(1) NOT NULL DEFAULT 0,
  `exams_counter` int(11) NOT NULL,
  `last_exam_percentage` int(11) DEFAULT NULL,
  `last_exam_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mil_number`, `rotba_id`, `name`, `unit_id`, `job_name`, `weapon_name`, `email`, `email_verified_at`, `password`, `level_id`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `is_user_did_exam_before`, `exams_counter`, `last_exam_percentage`, `last_exam_date`) VALUES
(1, 0, NULL, 'admin', NULL, '', '', 'admin@military.com', '2022-01-18 12:53:36', '$2y$10$/dcglFLfMuJHJU.XzFy1SOtWodpc4CfanPBMvhQJwCetvl7NXrIUe', NULL, NULL, '2022-01-12 10:31:27', '2022-01-12 10:31:27', 1, 0, 0, NULL, NULL),
(9, 123456789, 5, 'كريم محمد احمد', 2, 'قائد الوحدة', 'الاشارة', '123456789@military.com', '2022-01-27 18:32:56', '$2y$10$3zCqOPKnoRkPK158HRCOBOH2S2H3.mmryI/LJG4bTSknJOlB.j9Oi', 4, NULL, '2022-01-17 19:22:26', '2022-01-27 16:32:56', 0, 1, 6, 43, '2022-01-27 16:32:56'),
(11, 12345678910, 11, 'عبدالفتاح عصام', 1, 'حكمدار', 'المشاة', '12345678910@military.com', '2022-01-18 17:11:59', '$2y$10$8IwZPmmuVT8OFHYcqYkz4OkR6DIbct51grHpnzsfgabyLx3IRQUCq', NULL, NULL, '2022-01-18 17:11:59', '2022-01-18 17:11:59', 0, 0, 0, NULL, NULL),
(12, 1234567895, 4, 'dfghjghfdsgh', 5, 'fdghgdfgdsf', 'dfghdhdfhg', '1234567895@military.com', '2022-01-18 18:53:09', '$2y$10$8cDd5Cofe1e5/BdyBFRtC.m9tOTAta1OLOspqJ2l7hGdQUGgR7W72', NULL, NULL, '2022-01-18 18:53:09', '2022-01-18 18:53:09', 0, 0, 0, NULL, NULL),
(13, 1234567891, 5, 'مساعد محسن', 12, 'قائد الوحدة', 'مشاة', '1234567891@military.com', '2022-01-18 19:16:46', '$2y$10$0qumPzI5Yxe5kTviPDyZrODY7YWjqHn9K7QEFSd.v2Sp4j.D6edw2', NULL, NULL, '2022-01-18 19:16:46', '2022-01-18 19:16:46', 0, 0, 0, NULL, NULL),
(14, 1234785575, 3, 'كريم محمد احمد', 14, 'قائد الوحدة', 'مشاة', '1234785575@military.com', '2022-01-19 18:55:31', '$2y$10$OLnR8Qa/1JjheVsJ2FLkleaB.22M2jhmCtugIb8PIZpQttYFInWM6', 1, NULL, '2022-01-19 17:21:01', '2022-01-19 17:21:01', 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-01-12 12:53:02', '2022-01-12 12:53:02'),
(2, 2, 2, '2022-01-12 12:53:02', '2022-01-12 12:53:02'),
(3, 5, 2, '2022-01-12 10:55:04', '2022-01-12 10:55:04'),
(6, 9, 2, '2022-01-17 19:22:26', '2022-01-17 19:22:26'),
(7, 10, 2, '2022-01-17 19:29:11', '2022-01-17 19:29:11'),
(8, 11, 2, '2022-01-18 17:11:59', '2022-01-18 17:11:59'),
(9, 12, 2, '2022-01-18 18:53:09', '2022-01-18 18:53:09'),
(10, 13, 2, '2022-01-18 19:16:46', '2022-01-18 19:16:46'),
(11, 14, 2, '2022-01-19 17:21:01', '2022-01-19 17:21:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_forms`
--
ALTER TABLE `exam_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factions_id` (`level_id`);

--
-- Indexes for table `exam_form_questions`
--
ALTER TABLE `exam_form_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_form_FK` (`exam_form_id`),
  ADD KEY `questsson_FK` (`questions_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `final_result`
--
ALTER TABLE `final_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usesr_FK` (`user_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_FK` (`subject_id`);

--
-- Indexes for table `lending_library`
--
ALTER TABLE `lending_library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lending_log`
--
ALTER TABLE `lending_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_FFK` (`book_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `question_choises`
--
ALTER TABLE `question_choises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_FK` (`question_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rotba`
--
ALTER TABLE `rotba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniquee` (`email`),
  ADD KEY `factions_FK` (`level_id`),
  ADD KEY `rotba_FK` (`rotba_id`),
  ADD KEY `unit_FK` (`unit_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_FK` (`user_id`),
  ADD KEY `role_FK` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_forms`
--
ALTER TABLE `exam_forms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `exam_form_questions`
--
ALTER TABLE `exam_form_questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4051;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_result`
--
ALTER TABLE `final_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lending_library`
--
ALTER TABLE `lending_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lending_log`
--
ALTER TABLE `lending_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `question_choises`
--
ALTER TABLE `question_choises`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rotba`
--
ALTER TABLE `rotba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_forms`
--
ALTER TABLE `exam_forms`
  ADD CONSTRAINT `factions_id` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`);

--
-- Constraints for table `exam_form_questions`
--
ALTER TABLE `exam_form_questions`
  ADD CONSTRAINT `exam_form_FK` FOREIGN KEY (`exam_form_id`) REFERENCES `exam_forms` (`id`),
  ADD CONSTRAINT `questsson_FK` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `final_result`
--
ALTER TABLE `final_result`
  ADD CONSTRAINT `usesr_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `subject_FK` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `lending_log`
--
ALTER TABLE `lending_log`
  ADD CONSTRAINT `book_FFK` FOREIGN KEY (`book_id`) REFERENCES `lending_library` (`id`);

--
-- Constraints for table `question_choises`
--
ALTER TABLE `question_choises`
  ADD CONSTRAINT `question_FK` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `levels_FK` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`),
  ADD CONSTRAINT `rotba_FK` FOREIGN KEY (`rotba_id`) REFERENCES `rotba` (`id`),
  ADD CONSTRAINT `unit_FK` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `role_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
