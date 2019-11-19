-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 19 2019 г., 23:46
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravel_mod`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `datas`
--

CREATE TABLE `datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `field_id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

CREATE TABLE `emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `template` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `title`, `type`, `template`, `created_at`, `updated_at`) VALUES
(1, 'Confirm registration', 1, '----', NULL, NULL),
(2, 'Reset Password', 2, '----', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `faqs`
--

CREATE TABLE `faqs` (
  `id` int(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `faq_contents`
--

CREATE TABLE `faq_contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `language_id` int(10) UNSIGNED NOT NULL,
  `faq_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `fields`
--

CREATE TABLE `fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', NULL, NULL),
(2, 'Russian', 'ru', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `leads`
--

CREATE TABLE `leads` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_processed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `isQualityLead` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `count_create` int(11) NOT NULL DEFAULT '1',
  `is_express_delivery` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_add_sale` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_robot` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `leads`
--

INSERT INTO `leads` (`id`, `link`, `phone`, `source_id`, `unit_id`, `user_id`, `is_processed`, `created_at`, `updated_at`, `status_id`, `isQualityLead`, `count_create`, `is_express_delivery`, `is_add_sale`, `is_robot`) VALUES
(7, 'dsfsdfsdf', NULL, 3, 2, 1, '1', '2019-11-14 18:59:59', '2019-11-14 18:59:59', 1, '0', 1, '1', '1', '0'),
(8, 'dsfsdfsdf', NULL, 3, 2, 1, '1', '2019-11-14 19:00:59', '2019-11-14 19:00:59', 1, '0', 1, '1', '1', '0'),
(9, 'dsfsdfsdf', NULL, 3, 2, 1, '1', '2019-11-14 19:03:40', '2019-11-14 19:03:40', 1, '0', 1, '1', '1', '0'),
(10, 'asdasdasdasd', NULL, 4, 3, 1, '1', '2019-11-14 19:04:57', '2019-11-14 19:04:57', 1, '0', 1, '1', '1', '0'),
(11, 'asdasdasdasd', NULL, 4, 3, 1, '1', '2019-11-14 19:07:03', '2019-11-14 19:07:03', 1, '0', 1, '1', '1', '0'),
(12, 'http://google.com', NULL, 2, 1, 1, '1', '2019-11-19 18:34:02', '2019-11-19 18:34:02', 1, '0', 1, '1', '1', '0'),
(13, 'http://google.com', NULL, 2, 2, 1, '1', '2019-11-19 18:42:56', '2019-11-19 18:42:56', 1, '0', 2, '1', '1', '0'),
(14, 'http://google.com', NULL, 4, 2, 1, '0', '2019-11-19 18:44:47', '2019-11-19 18:44:47', 1, '0', 2, '0', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `lead_comments`
--

CREATE TABLE `lead_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lead_id` int(10) UNSIGNED DEFAULT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `comment_value` text COLLATE utf8mb4_unicode_ci,
  `is_event` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lead_comments`
--

INSERT INTO `lead_comments` (`id`, `text`, `user_id`, `created_at`, `updated_at`, `lead_id`, `status_id`, `comment_value`, `is_event`) VALUES
(1, 'Автор <strong> admin</strong> создал лид 2019-11-14 21:00:59 <strong> со статусом</strong> Новые заявки', 1, '2019-11-14 19:00:59', '2019-11-14 19:00:59', 8, 1, NULL, 1),
(2, 'Автор <strong> admin</strong> создал лид 2019-11-14 21:03:40 <strong> со статусом</strong> Новые заявки', 1, '2019-11-14 19:03:40', '2019-11-14 19:03:40', 9, 1, NULL, 1),
(3, 'Пользователь <strong> admin</strong> оставил <strong>комментарий</strong> sad asd asd as das asd', 1, '2019-11-14 19:04:57', '2019-11-14 19:04:57', 10, 1, 'sad asd asd as das asd', 0),
(4, 'Автор <strong> admin</strong> создал лид 2019-11-14 21:04:57 <strong> со статусом</strong> Новые заявки', 1, '2019-11-14 19:04:57', '2019-11-14 19:04:57', 10, 1, 'sad asd asd as das asd', 1),
(5, 'Пользователь <strong> admin</strong> оставил <strong>комментарий</strong> sad asd asd as das asd', 1, '2019-11-14 19:07:03', '2019-11-14 19:07:03', 11, 1, 'sad asd asd as das asd', 0),
(6, 'Автор <strong> admin</strong> создал лид 2019-11-14 21:07:03 <strong> со статусом</strong> Новые заявки', 1, '2019-11-14 19:07:03', '2019-11-14 19:07:03', 11, 1, 'sad asd asd as das asd', 1),
(7, 'Пользователь <strong> admin</strong> оставил <strong>комментарий</strong> asdas dsa das das dasd', 1, '2019-11-19 18:34:02', '2019-11-19 18:34:02', 12, 1, 'asdas dsa das das dasd', 0),
(8, 'Автор <strong> admin</strong> создал лид 2019-11-19 20:34:02 <strong> со статусом</strong> Новые заявки', 1, '2019-11-19 18:34:02', '2019-11-19 18:34:02', 12, 1, 'asdas dsa das das dasd', 1),
(9, 'Пользователь <strong> admin</strong> оставил <strong>комментарий</strong> dsf sdfs df sdsdf', 1, '2019-11-19 18:37:37', '2019-11-19 18:37:37', 13, 1, 'dsf sdfs df sdsdf', 0),
(10, 'Автор <strong> admin</strong> создал лид 2019-11-19 20:37:37 <strong> со статусом</strong> Новые заявки', 1, '2019-11-19 18:37:37', '2019-11-19 18:37:37', 13, 1, 'dsf sdfs df sdsdf', 1),
(11, 'Пользователь <strong> admin</strong> оставил <strong>комментарий</strong> sdf sdf sd fsd fsd f', 1, '2019-11-19 18:42:56', '2019-11-19 18:42:56', 13, 1, NULL, 0),
(12, 'Пользователь <strong> admin</strong> изменил <strong>источник</strong> на Viber', 1, '2019-11-19 18:42:56', '2019-11-19 18:42:56', 13, 1, NULL, 1),
(13, 'Пользователь <strong> admin</strong> изменил <strong>подразделение</strong> на Shop 2', 1, '2019-11-19 18:42:56', '2019-11-19 18:42:56', 13, 1, NULL, 1),
(14, 'Автор <strong> admin </strong>создал лид 2019-11-19 20:42:56 <strong>со статусом</strong> Новые заявки', 1, '2019-11-19 18:42:56', '2019-11-19 18:42:56', 13, 1, 'sdf sdf sd fsd fsd f', 1),
(15, 'Пользователь <strong> admin</strong> оставил <strong>комментарий</strong> sd fsd fsd f sdf sd', 1, '2019-11-19 18:43:33', '2019-11-19 18:43:33', 14, 1, 'sd fsd fsd f sdf sd', 0),
(16, 'Автор <strong> admin</strong> создал лид 2019-11-19 20:43:33 <strong> со статусом</strong> Новые заявки', 1, '2019-11-19 18:43:33', '2019-11-19 18:43:33', 14, 1, 'sd fsd fsd f sdf sd', 1),
(17, 'Пользователь <strong> admin</strong> оставил <strong>комментарий</strong> sdf sdf sdf sd f', 1, '2019-11-19 18:44:47', '2019-11-19 18:44:47', 14, 1, NULL, 0),
(18, 'Автор <strong> admin </strong>создал лид 2019-11-19 20:44:47 <strong>со статусом</strong> Новые заявки', 1, '2019-11-19 18:44:47', '2019-11-19 18:44:47', 14, 1, 'sdf sdf sdf sd f', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `lead_status`
--

CREATE TABLE `lead_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED DEFAULT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lead_status`
--

INSERT INTO `lead_status` (`id`, `lead_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 9, 1, '2019-11-14 19:03:40', '2019-11-14 19:03:40'),
(2, 10, 1, '2019-11-14 19:04:57', '2019-11-14 19:04:57'),
(3, 11, 1, '2019-11-14 19:07:03', '2019-11-14 19:07:03'),
(4, 12, 1, '2019-11-19 18:34:03', '2019-11-19 18:34:03'),
(5, 13, 1, '2019-11-19 18:37:37', '2019-11-19 18:37:37'),
(6, 14, 1, '2019-11-19 18:43:33', '2019-11-19 18:43:33');

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `title`, `path`, `parent`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Pages', 'pages.index', 0, '2019-10-04 21:00:00', '2019-10-04 21:00:00', 'admin'),
(2, 'Roles', 'roles.index', 0, NULL, NULL, 'admin'),
(3, 'Permissions', 'permissions.index', 0, NULL, NULL, 'admin'),
(4, 'Settings', 'settings.index', 0, NULL, NULL, 'admin'),
(5, 'Email', 'emails.index', 0, NULL, NULL, 'admin'),
(6, 'Users', 'users.index', 0, NULL, NULL, 'admin'),
(7, 'Dashboard', '/', 0, NULL, NULL, 'front'),
(8, 'Gate', 'gate', 0, NULL, NULL, 'front'),
(9, 'Users', 'users', 0, NULL, NULL, 'front'),
(10, 'Units', 'units', 0, NULL, NULL, 'front'),
(11, 'Sources', 'sources', 0, NULL, NULL, 'front'),
(12, 'Archives', 'archives', 0, NULL, NULL, 'front');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_13_090822_role_table', 1),
(4, '2019_02_13_090937_permission_table', 1),
(5, '2019_02_13_091036_permission_role_table', 1),
(6, '2019_02_13_091438_role_user_table', 1),
(7, '2019_02_13_091617_pages_table', 1),
(8, '2019_02_13_091741_settings_table', 1),
(9, '2019_02_20_142753_change_users_table_add_status', 1),
(10, '2019_03_01_094618_create_emails_table', 1),
(11, '2019_03_01_095430_change_users_table_add_token', 1),
(12, '2019_04_03_113013_faq_table', 1),
(13, '2019_04_03_135915_create_fields', 1),
(14, '2019_04_03_135947_create_datas', 1),
(15, '2019_04_03_140241_change_pages_table', 1),
(16, '2019_04_05_102800_create_contact_messages_table', 1),
(17, '2019_04_08_102602_create_scripts_table', 1),
(18, '2019_04_08_110001_change_scripts_table', 1),
(19, '2019_04_08_111422_change_scripts_table2', 1),
(20, '2019_08_19_000000_create_failed_jobs_table', 1),
(21, '2019_10_05_124248_create_menus_table', 2),
(22, '2019_10_08_171716_change_menu_table', 3),
(24, '2019_10_09_174220_change_menus_table_add_perm', 1),
(25, '2019_10_09_185401_create_faqs_table', 4),
(26, '2019_10_09_185441_create_blogs_table', 4),
(27, '2019_10_09_185501_create_settings_table', 5),
(29, '2019_10_15_185359_create_languages_table', 6),
(30, '2019_09_19_085923_create_page_contents_table', 7),
(31, '2019_09_19_092400_change_pages_table_remove_fields', 7),
(32, '2019_09_23_125646_create_faq_contents_table', 8),
(33, '2019_11_04_192311_create_sources_table', 9),
(37, '2018_10_23_103002_create_leads_table', 10),
(38, '2018_10_23_103710_create_units_table', 10),
(39, '2018_10_23_104949_change_leads_table', 10),
(40, '2018_10_23_111952_create_statuses_table', 10),
(41, '2018_10_24_092653_lead_status', 10),
(42, '2018_10_24_111751_change_leads_table_add_current_status', 10),
(43, '2018_10_30_081709_change_leads_table_add_quality_lead', 10),
(44, '2018_10_30_095559_changeleads_table_add_default_count', 10),
(45, '2019_02_27_130825_change_leads_table_is_express', 10),
(46, '2019_07_01_102303_change_leads_add_is_add_sale', 10),
(47, '2019_07_05_081327_change_leads_table_add_is_robot', 10),
(48, '2018_10_24_092247_change_statuses_table', 11),
(50, '2018_10_23_103815_create_lead_coments_table', 12),
(51, '2018_10_23_105906_change_comments_table', 12),
(52, '2018_10_24_081854_change_leads_comments_table_add_token', 12),
(53, '2018_10_24_111826_change_leads_comment_table_add_current_status', 12),
(54, '2019_02_28_100822_change_leads_comments_table_add_comment', 12),
(55, '2019_08_29_064532_add_column_is_event_to_lead_comments_table', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `related_entity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `alias`, `created_at`, `updated_at`, `related_entity`) VALUES
(1, 'home', NULL, NULL, 'home'),
(2, 'about', NULL, NULL, 'about'),
(3, 'contact', NULL, NULL, 'order-form'),
(4, 'blog', NULL, NULL, 'blog'),
(5, 'faq', NULL, NULL, 'faq'),
(6, 'asdasd', '2019-10-16 15:48:16', '2019-10-16 15:48:16', 'asdasd');

-- --------------------------------------------------------

--
-- Структура таблицы `page_contents`
--

CREATE TABLE `page_contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `titleH1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `page_contents`
--

INSERT INTO `page_contents` (`id`, `title`, `text`, `titleH1`, `description`, `page_id`, `language_id`, `created_at`, `updated_at`) VALUES
(1, 'asdasd12', '<p>asdasdasd</p>', 'sdad1', 'sadasdad1', 6, 1, '2019-10-16 15:48:16', '2019-10-16 16:25:09'),
(2, 'asdasd2', '<p><br />\r\nsadasdasd</p>', 'sadads2', 'sadasd2', 6, 2, '2019-10-16 15:48:16', '2019-10-16 16:24:59');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `alias`, `title`, `created_at`, `updated_at`) VALUES
(1, 'SUPER_ADMINISTRATOR', 'Super Administrator Access', NULL, NULL),
(2, 'ADMINISTRATOR_ACCESS', 'Administrator Access', NULL, NULL),
(3, 'SETTINGS_ACCESS', 'Settings Access', NULL, NULL),
(4, 'USERS_ACCESS', 'Users Access', NULL, NULL),
(5, 'BLOG_ACCESS', 'Blog Access', NULL, NULL),
(6, 'FAQ_ACCESS', 'Faq Access', NULL, NULL),
(7, 'ROLES_ACCESS', 'Roles Access', NULL, NULL),
(8, 'DASHBOARD_VIEW', 'DASHBOARD VIEW', NULL, NULL),
(9, 'GATE_VIEW', 'GATE VIEW', NULL, NULL),
(10, 'HISTORY_VIEW', 'HISTORY VIEW', NULL, NULL),
(11, 'ADMIN_VIEW', 'ADMIN VIEW', NULL, NULL),
(12, 'LEADS_CREATE', 'LEADS CREATE', NULL, NULL),
(13, 'LEADS_EDIT', 'LEADS EDIT', NULL, NULL),
(14, 'TASKS_CREATE', 'TASKS CREATE', NULL, NULL),
(15, 'TASKS_EDIT', 'TASKS EDIT', NULL, NULL),
(16, 'TASKS_VIEW', 'TASKS VIEW', NULL, NULL),
(17, 'ANALITICS_VIEW', 'ANALITICS VIEW', NULL, NULL),
(18, 'CHANGE_AUTHORS', 'CHANGE AUTHORS', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `permission_menu`
--

CREATE TABLE `permission_menu` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_menu`
--

INSERT INTO `permission_menu` (`permission_id`, `menu_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3),
(1, 4),
(2, 4),
(1, 5),
(2, 5),
(1, 6),
(2, 6),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 8, NULL, NULL),
(3, 1, 9, NULL, NULL),
(4, 1, 10, NULL, NULL),
(5, 1, 11, NULL, NULL),
(6, 1, 12, NULL, NULL),
(7, 1, 13, NULL, NULL),
(8, 1, 14, NULL, NULL),
(9, 1, 15, NULL, NULL),
(10, 1, 16, NULL, NULL),
(11, 1, 17, NULL, NULL),
(12, 1, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `alias`, `title`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', NULL, NULL),
(2, 'guest', 'Guest', NULL, NULL),
(3, 'manager', 'Manager', NULL, NULL),
(4, 'manager_admin', 'Manager Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `scripts`
--

CREATE TABLE `scripts` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `field`, `value`, `title`, `type`, `created_at`, `updated_at`) VALUES
(1, 'system_email', 'rani@ranimaree.com', 'From Emai', 'text', NULL, NULL),
(2, 'system_email_name', '-', 'From Name', 'text', NULL, '2019-10-16 16:37:29'),
(3, 'system_host', '-', 'SMTP Host', 'text', NULL, '2019-10-16 16:37:29'),
(4, 'system_email_port', '-', 'SMTP Port', 'text', NULL, '2019-10-16 16:37:29'),
(5, 'system_email_username', '-', 'SMTP Username', 'text', NULL, '2019-10-16 16:37:29'),
(6, 'system_email_password', '-', 'SMTP Password', 'text', NULL, '2019-10-16 16:37:29'),
(7, 'system_email_encryption', '-', 'System Email Enc', 'text', NULL, '2019-10-16 16:37:29'),
(8, 'contact_to', '-', 'Contact form email recipient', 'text', NULL, '2019-10-16 16:37:29'),
(9, 'contact_subject', '-', 'Contact form email subject', 'text', NULL, '2019-10-16 16:37:29'),
(10, 'system_photo', 'TXmSeGefeV.png', 'Administrator Photo', 'file', NULL, NULL),
(11, 'sdf', 'sdf', 'sdf', 'text', '2019-10-17 15:28:33', '2019-10-17 15:28:33');

-- --------------------------------------------------------

--
-- Структура таблицы `sources`
--

CREATE TABLE `sources` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sources`
--

INSERT INTO `sources` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Instagram1213123123', NULL, '2019-11-06 16:20:24'),
(2, 'Viber', NULL, NULL),
(3, 'Telegram', NULL, NULL),
(4, 'Message', NULL, NULL),
(5, 'Сайт', NULL, NULL),
(6, 'Звонок', NULL, NULL),
(7, 'Почта', NULL, NULL),
(8, 'OLX', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `title`, `created_at`, `updated_at`, `title_ru`) VALUES
(1, 'new', NULL, NULL, 'Новые заявки'),
(2, 'process', NULL, NULL, 'В работе'),
(3, 'done', NULL, NULL, 'Выполнено');

-- --------------------------------------------------------

--
-- Структура таблицы `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `units`
--

INSERT INTO `units` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Shop 1', NULL, NULL),
(2, 'Shop 2', NULL, NULL),
(3, 'Shop 3', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `token` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `email_verified_at`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`, `status`, `token`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin', NULL, '$2y$10$Onv0/sD4D0CeSwOflBlBiecLQo0XuuxAotj40JU/XXiew1HepgDK2', '1RWPL0eCuZERa1XQTeDFWKmAz4e1JXkHfzqK76p5t3f1rCPuTE1B7QJiFdlFl4', NULL, NULL, '2019-11-18 18:04:00', 1, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datas_page_id_foreign` (`page_id`),
  ADD KEY `datas_field_id_foreign` (`field_id`);

--
-- Индексы таблицы `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `faq_contents`
--
ALTER TABLE `faq_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faq_contents_language_id_foreign` (`language_id`),
  ADD KEY `faq_contents_faq_id_foreign` (`faq_id`);

--
-- Индексы таблицы `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leads_source_id_foreign` (`source_id`),
  ADD KEY `leads_unit_id_foreign` (`unit_id`),
  ADD KEY `leads_user_id_foreign` (`user_id`),
  ADD KEY `leads_status_id_foreign` (`status_id`);

--
-- Индексы таблицы `lead_comments`
--
ALTER TABLE `lead_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_comments_user_id_foreign` (`user_id`),
  ADD KEY `lead_comments_lead_id_foreign` (`lead_id`),
  ADD KEY `lead_comments_status_id_foreign` (`status_id`);

--
-- Индексы таблицы `lead_status`
--
ALTER TABLE `lead_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_status_lead_id_foreign` (`lead_id`),
  ADD KEY `lead_status_status_id_foreign` (`status_id`);

--
-- Индексы таблицы `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_contents_page_id_foreign` (`page_id`),
  ADD KEY `page_contents_language_id_foreign` (`language_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permission_menu`
--
ALTER TABLE `permission_menu`
  ADD KEY `permission_menu_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_menu_menu_id_foreign` (`menu_id`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `scripts`
--
ALTER TABLE `scripts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `datas`
--
ALTER TABLE `datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `faq_contents`
--
ALTER TABLE `faq_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `lead_comments`
--
ALTER TABLE `lead_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `lead_status`
--
ALTER TABLE `lead_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `scripts`
--
ALTER TABLE `scripts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `datas`
--
ALTER TABLE `datas`
  ADD CONSTRAINT `datas_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `datas_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `faq_contents`
--
ALTER TABLE `faq_contents`
  ADD CONSTRAINT `faq_contents_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faqs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faq_contents_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`),
  ADD CONSTRAINT `leads_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `leads_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `leads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `lead_comments`
--
ALTER TABLE `lead_comments`
  ADD CONSTRAINT `lead_comments_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`),
  ADD CONSTRAINT `lead_comments_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `lead_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `lead_status`
--
ALTER TABLE `lead_status`
  ADD CONSTRAINT `lead_status_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`),
  ADD CONSTRAINT `lead_status_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `page_contents`
--
ALTER TABLE `page_contents`
  ADD CONSTRAINT `page_contents_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_contents_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_menu`
--
ALTER TABLE `permission_menu`
  ADD CONSTRAINT `permission_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_menu_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
