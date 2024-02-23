-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th1 25, 2024 lúc 03:16 AM
-- Phiên bản máy phục vụ: 10.3.39-MariaDB-cll-lve
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `zdemodichvuvnnet_tele`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_configs`
--

CREATE TABLE `api_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `api_configs`
--

INSERT INTO `api_configs` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'charging_card', '{\"fees\":{\"VIETTEL\":\"20\",\"VINAPHONE\":\"20\",\"MOBIFONE\":\"20\",\"ZING\":\"20\"},\"api_url\":\"https:\\/\\/thesieure.com\\/\",\"partner_id\":null,\"partner_key\":null}', '2023-11-17 17:31:35', '2024-01-19 05:50:10'),
(2, 'auth_google', '\"\"', '2023-12-21 20:08:44', '2023-12-21 20:08:44'),
(3, 'smtp_detail', '\"\"', '2023-12-23 13:12:01', '2023-12-23 13:12:01'),
(4, 'paypal', '\"\"', '2024-01-03 13:48:10', '2024-01-03 13:48:10'),
(5, 'web2m_vietcombank', '\"\"', '2024-01-07 21:26:57', '2024-01-07 21:26:57'),
(6, 'web2m_mbbank', '\"\"', '2024-01-08 20:49:58', '2024-01-08 20:49:58'),
(7, 'perfect_money', '\"\"', '2024-01-25 10:11:33', '2024-01-25 10:11:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `owner` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `card_lists`
--

CREATE TABLE `card_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `sys_note` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `request_id` varchar(255) DEFAULT NULL,
  `channel_charge` varchar(255) DEFAULT NULL,
  `transaction_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `card_lists`
--

INSERT INTO `card_lists` (`id`, `type`, `code`, `serial`, `value`, `amount`, `status`, `user_id`, `username`, `sys_note`, `content`, `order_id`, `request_id`, `channel_charge`, `transaction_code`, `created_at`, `updated_at`) VALUES
(3, 'VIETTEL', '914167493548825', '10010153317256', 20000, 16000, 'Completed', '10', 'WilliamsfanKiric', NULL, 'CARD_CORRECT', '16526198', 'WilliamsfanKiric_0gljnl', 'https://thesieure.com/', 'CARD-QMYBLB', '2024-01-07 13:53:13', '2024-01-07 13:53:19'),
(4, 'MOBIFONE', '588239559614', '096892000843088', 20000, 16000, 'Completed', '13', 'Dominus', NULL, 'CARD_CORRECT', '16526268', 'Dominus_GRMePz', 'https://thesieure.com/', 'CARD-KJXXD5', '2024-01-07 14:01:54', '2024-01-07 14:02:11'),
(5, 'VIETTEL', '916174072276357', '10010248033860', 20000, 16000, 'Completed', '20', 'nguyen', NULL, 'CARD_CORRECT', '16589542', 'nguyen_EjJKQ2', 'https://thesieure.com/', 'CARD-2F0WN1', '2024-01-14 16:35:15', '2024-01-14 16:35:24'),
(6, 'VIETTEL', '013294275526287', '10010248033855', 20000, 16000, 'Completed', '20', 'nguyen', NULL, 'CARD_CORRECT', '16589559', 'nguyen_MIJwXH', 'https://thesieure.com/', 'CARD-R9UTJA', '2024-01-14 16:36:50', '2024-01-14 16:37:12'),
(7, 'VIETTEL', '313249083314197', '10010539707356', 100000, 80000, 'Completed', '21', 'longla22', NULL, 'CARD_CORRECT', '16628863', 'longla22_jCkmve', 'https://thesieure.com/', 'CARD-N0GYL4', '2024-01-19 10:01:19', '2024-01-19 10:01:25'),
(8, 'VIETTEL', '617783383514737', '10010539707351', 100000, 80000, 'Completed', '21', 'longla22', NULL, 'CARD_CORRECT', '16628875', 'longla22_q64Itz', 'https://thesieure.com/', 'CARD-ZPXKFD', '2024-01-19 10:04:12', '2024-01-19 10:04:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `_lft`, `status`, `username`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'Game Liên Quân Mobile', 'game-lien-quan-mobile', NULL, '1', 'Administrator', 1, '2024-01-25 10:02:30', '2024-01-25 10:02:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_v2_s`
--

CREATE TABLE `category_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `configs`
--

INSERT INTO `configs` (`id`, `name`, `value`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'theme_custom', '{\"card_stats\":\"1\",\"product_info_type\":\"1\",\"buy_button_img\":\"_assets\\/images\\/stores\\/view-all.gif\",\"enable_custom_theme\":\"1\",\"show_thongbao\":\"1\",\"show_lsmua\":\"1\",\"show_banner\":\"1\",\"show_all_account_img\":\"1\",\"youtube\":\"lRK7uXnRUCY\",\"background_image\":\"https:\\/\\/wallpapercave.com\\/wp\\/wp11165436.png\",\"minigame_pos\":\"0\",\"type\":\"theme_custom\",\"banner\":\"\\/uploads\\/08-01-2024\\/8d99549e-2c96-441a-8037-88805a9d73db.jpg\"}', NULL, '2023-11-17 16:27:52', '2024-01-08 21:10:30'),
(2, 'shop_info', '{\"footer_text_1\":null,\"footer_text_2\":null,\"dashboard_text_1\":\"Shop B\\u00e1n \\u0110\\u1ed3 Uy T\\u00edn Gi\\u00e1 R\\u1ebb\"}', NULL, '2023-11-17 16:27:52', '2024-01-25 09:55:33'),
(3, 'general', '{\"title\":\"Shop B\\u00e1n \\u0110\\u1ed3 Roblox Uy T\\u00edn Gi\\u00e1 R\\u1ebb\",\"keywords\":\"Shop uy t\\u00edn , Shop gi\\u00e1 r\\u1ebb , Kiric Gaming , Shop Roblox Uy T\\u00edn, Item Roblox Gi\\u00e1 R\\u1ebb, Haiduong bbs\",\"description\":\"GAMEPASS V\\u00c0 ROBUX UY T\\u00cdN V\\u00c0 GI\\u00c1 R\\u1eba NH\\u1ea4T TH\\u1eca TR\\u01af\\u1edcNG\",\"primary_color\":\"#000000\",\"email\":\"accruler1@gmail.com\",\"time_wait_free\":\"10\",\"max_ip_reg\":\"5\",\"logo_dark\":\"\\/uploads\\/25-01-2024\\/5b02f97e-67f5-41e0-a890-f3acadfed126.png\",\"logo_light\":\"\\/uploads\\/25-01-2024\\/e9d9da70-7788-49fc-8921-7889853cc100.png\",\"favicon\":\"\\/uploads\\/25-01-2024\\/9d581872-8940-493b-be55-2f2ea546113c.png\"}', NULL, '2023-11-17 16:27:52', '2024-01-25 09:56:04'),
(4, 'contact_info', '{\"email\":\"accruler1@gmail.com\",\"twitter\":null,\"discord\":null,\"facebook\":null,\"telegram\":null,\"phone_no\":null,\"instagram\":null}', NULL, '2023-11-17 16:27:52', '2023-12-31 23:19:11'),
(5, 'version_code', '2006', NULL, '2023-11-17 16:28:40', '2024-01-25 10:14:27'),
(6, 'mng_withdraw', NULL, NULL, '2023-11-17 17:18:59', '2023-11-17 17:18:59'),
(7, 'deposit_info', '{\"prefix\":\"NAPTIEN_T\\u00ean t\\u00e0i Kho\\u1ea3n\",\"discount\":0}', NULL, '2023-11-17 17:18:59', '2023-12-31 23:15:38'),
(8, 'deposit_port', '{\"card\":\"1\",\"bank\":\"1\",\"crypto\":\"1\",\"paypal\":\"1\",\"perfect_money\":\"1\"}', NULL, '2023-12-20 20:31:54', '2024-01-25 09:58:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` longtext DEFAULT NULL,
  `meta_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `descr_seo` longtext DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `game_type` varchar(255) NOT NULL DEFAULT 'game-khac',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`, `image`, `type`, `slug`, `descr`, `meta_seo`, `descr_seo`, `sold`, `status`, `game_type`, `priority`, `username`, `category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Liên Quân', '/uploads/25-01-2024/6a37b91d-afcd-4ade-8577-b7e9d66a5eec.gif', 'account', 'lien-quan', '', '{\"title\":\"T\\u00e0i Kho\\u1ea3n - MUA NICK LI\\u00caN QU\\u00c2N GI\\u00c1 R\\u1eba\",\"keywords\":\"T\\u00e0i Kho\\u1ea3n - MUA NICK LI\\u00caN QU\\u00c2N GI\\u00c1 R\\u1eba\"}', '', 0, '1', 'game-khac', 1, 'Administrator', 1, 'Game Liên Quân Mobile', '2024-01-25 10:03:24', '2024-01-25 10:03:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_v2_s`
--

CREATE TABLE `group_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` longtext DEFAULT NULL,
  `meta_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `descr_seo` longtext DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `game_type` varchar(255) NOT NULL DEFAULT 'game-khac',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_categories`
--

CREATE TABLE `g_b_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `g_b_categories`
--

INSERT INTO `g_b_categories` (`id`, `name`, `slug`, `_lft`, `status`, `username`, `priority`, `created_at`, `updated_at`) VALUES
(8, 'Cày thuê liên quân', 'cay-thue-lien-quan', NULL, '1', 'Administrator', 0, '2024-01-25 10:01:12', '2024-01-25 10:01:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_groups`
--

CREATE TABLE `g_b_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` text DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_orders`
--

CREATE TABLE `g_b_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `input_user` varchar(255) NOT NULL,
  `input_pass` varchar(255) NOT NULL,
  `input_extra` varchar(500) NOT NULL,
  `payment` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `package_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `order_note` varchar(255) DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_packages`
--

CREATE TABLE `g_b_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `input` varchar(255) NOT NULL DEFAULT 'note',
  `price` double NOT NULL,
  `descr` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `priority` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `sold_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `histories`
--

INSERT INTO `histories` (`id`, `role`, `user_id`, `username`, `content`, `data`, `ip_address`, `domain`, `created_at`, `updated_at`) VALUES
(498, 'admin', 26, 'Administrator', 'Tạo vòng quay mới (Vòng Quay Nhập Học)', '[]', '42.116.185.194', NULL, '2024-01-25 10:00:19', '2024-01-25 10:00:19'),
(499, 'admin', 26, 'Administrator', 'Thêm danh mục cày thuê Cày thuê liên quân', '[]', '42.116.185.194', NULL, '2024-01-25 10:01:12', '2024-01-25 10:01:12'),
(500, 'admin', 26, 'Administrator', 'Thêm danh mục Game Liên Quân Mobile', '[]', '42.116.185.194', NULL, '2024-01-25 10:02:30', '2024-01-25 10:02:30'),
(501, 'admin', 26, 'Administrator', 'Thêm nhóm Liên Quân cho danh mục Game Liên Quân Mobile', '[]', '42.116.185.194', NULL, '2024-01-25 10:03:24', '2024-01-25 10:03:24'),
(502, 'admin', 26, 'Administrator', 'Thêm 1 sản phẩm cho nhóm Liên Quân', '[]', '42.116.185.194', NULL, '2024-01-25 10:05:04', '2024-01-25 10:05:04'),
(503, 'admin', 26, 'Administrator', 'Xóa tài khoản ngân hàng 9704150122240388 #1', '[]', '42.116.185.194', NULL, '2024-01-25 10:11:45', '2024-01-25 10:11:45'),
(504, 'user', 26, 'Administrator', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '42.116.185.194', 'tools.dichvuvn.net', '2024-01-25 10:12:07', '2024-01-25 10:12:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'VND',
  `request_id` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `payment_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_data`
--

CREATE TABLE `item_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'item',
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sold_count` int(11) NOT NULL DEFAULT 0,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'VND',
  `description` longtext DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_groups`
--

CREATE TABLE `item_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` text DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_orders`
--

CREATE TABLE `item_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'item',
  `code` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `payment` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `input_user` varchar(255) DEFAULT NULL,
  `input_pass` varchar(255) DEFAULT NULL,
  `input_auth` varchar(255) DEFAULT NULL,
  `input_ingame` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `order_note` varchar(255) DEFAULT NULL,
  `extra_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_items`
--

CREATE TABLE `list_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cost` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `domain` varchar(255) DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `list_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'VND',
  `description` longtext DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `list_skin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `raw_skins` text DEFAULT NULL,
  `list_champ` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `raw_champions` text DEFAULT NULL,
  `cf_the_loai` varchar(255) DEFAULT NULL,
  `cf_vip_ingame` int(11) DEFAULT NULL,
  `cf_vip_amount` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `buyer_code` varchar(255) DEFAULT NULL,
  `buyer_paym` double NOT NULL DEFAULT 0,
  `buyer_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `list_items`
--

INSERT INTO `list_items` (`id`, `name`, `type`, `code`, `image`, `cost`, `price`, `domain`, `discount`, `status`, `list_image`, `currency`, `description`, `username`, `password`, `extra_data`, `highlights`, `priority`, `list_skin`, `raw_skins`, `list_champ`, `raw_champions`, `cf_the_loai`, `cf_vip_ingame`, `cf_vip_amount`, `group_id`, `buyer_name`, `buyer_code`, `buyer_paym`, `buyer_date`, `created_at`, `updated_at`) VALUES
(1, 'ACC 1 JACK', 'account', '1', '/uploads/25-01-2024/items/1/f11e57ce-2956-4226-8630-6dba0a992c0b.png', 400000, 5000000, NULL, 10, 1, '[]', 'VND', '<p>cấp độ 1 con</p>', 'dfsfdsfsf', '', '', '[\"c\\u1ea5p \\u0111\\u1ed9 1 con\"]', 0, '[]', '', '[]', NULL, NULL, NULL, 0, 1, NULL, NULL, 0, NULL, '2024-01-25 10:05:04', '2024-01-25 10:05:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_item_archives`
--

CREATE TABLE `list_item_archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_item_v2_s`
--

CREATE TABLE `list_item_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cost` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `list_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` longtext DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `resource_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_25_182626_create_configs_table', 1),
(7, '2023_07_25_182939_create_api_configs_table', 1),
(8, '2023_07_25_205042_create_notifications_table', 1),
(9, '2023_07_27_141621_create_histories_table', 1),
(10, '2023_07_27_165146_create_transactions_table', 1),
(11, '2023_07_28_201434_create_bank_accounts_table', 1),
(12, '2023_07_30_090744_create_invoices_table', 1),
(13, '2023_07_30_172801_create_posts_table', 1),
(14, '2023_07_30_204908_create_categories_table', 1),
(15, '2023_07_30_212509_create_groups_table', 1),
(16, '2023_07_30_231608_create_list_items_table', 1),
(17, '2023_07_31_003930_create_card_lists_table', 1),
(18, '2023_08_25_203135_create_item_categories_table', 1),
(19, '2023_08_25_203225_create_item_groups_table', 1),
(20, '2023_08_25_203317_create_item_data_table', 1),
(21, '2023_08_25_203409_create_item_orders_table', 1),
(22, '2023_08_26_145954_create_g_b_categories_table', 1),
(23, '2023_08_26_145958_create_g_b_groups_table', 1),
(24, '2023_08_26_150004_create_g_b_packages_table', 1),
(25, '2023_08_26_150008_create_g_b_orders_table', 1),
(26, '2023_10_17_182536_create_list_item_archives_table', 1),
(27, '2023_10_21_192813_create_group_v2_s_table', 1),
(28, '2023_10_21_192839_create_category_v2_s_table', 1),
(29, '2023_10_21_192850_create_list_item_v2_s_table', 1),
(30, '2023_10_21_193944_create_resource_v2_s_table', 1),
(31, '2023_11_02_174007_create_spin_quests_table', 1),
(32, '2023_11_02_174138_create_spin_quest_logs_table', 1),
(33, '2023_11_05_174916_create_withdraw_logs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `type`, `value`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'home_dashboard', NULL, '<h2 style=\"text-align:center;\"><strong><span style=\"font-family:Verdana, Geneva, sans-serif;\"><span style=\"font-size:48px;\">DICHVUVN</span></span></strong><br />\n </h2>', NULL, '2023-11-17 16:27:52', '2024-01-25 09:56:40'),
(2, 'modal_dashboard', NULL, '<p><span style=\"font-size:72px;\"><img alt=\"\" src=\"https://cdn.discordapp.com/attachments/1140654828289282096/1195007805032255558/Them_tieu_e_5.png?ex=65b26cbe&amp;is=659ff7be&amp;hm=eab9f799e9dbd1d6a56077e4ae8138d4a6697d7baea7ec1c10046e88f84c117b&amp;\" /></span></p>', NULL, '2023-11-17 16:27:52', '2024-01-11 21:14:45'),
(3, 'header_script', NULL, NULL, NULL, '2023-11-17 16:27:52', '2023-11-17 19:31:28'),
(4, 'footer_script', NULL, '', NULL, '2023-11-17 16:27:52', '2023-11-17 16:27:52'),
(5, 'page_deposit', NULL, '', NULL, '2023-11-17 17:31:45', '2023-12-31 23:17:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 2, 'access_token', '630c140c5022da9c95fea1506eeb7e4fdd74ab2096e55d7643d45322252fbfd8', '[\"*\"]', NULL, NULL, '2023-12-20 20:38:31', '2023-12-20 20:38:31'),
(3, 'App\\Models\\User', 3, 'access_token', 'f18a195241d61a0c9b6c42c118ffcab6354a89bb029077eb2003e19643b18a0f', '[\"*\"]', '2024-01-09 11:19:24', NULL, '2023-12-23 16:20:53', '2024-01-09 11:19:24'),
(4, 'App\\Models\\User', 4, 'access_token', '37fea5df44f36092ff42362f39e81d464ffabe47d0b0b0463eb6217309db1137', '[\"*\"]', '2024-01-19 10:59:54', NULL, '2023-12-25 14:15:18', '2024-01-19 10:59:54'),
(5, 'App\\Models\\User', 5, 'access_token', '75aed6192098dab3e78aebbd143ed499a170aa1915d445f4cc4902a79e6a63be', '[\"*\"]', NULL, NULL, '2023-12-30 16:16:43', '2023-12-30 16:16:43'),
(6, 'App\\Models\\User', 6, 'access_token', 'bb5ea57eb7dc605d95b43797759db8d8353f9e2d4a42a4b6bac427af4f24a8e0', '[\"*\"]', NULL, NULL, '2023-12-31 23:24:41', '2023-12-31 23:24:41'),
(7, 'App\\Models\\User', 7, 'access_token', '93b081354d5af50e3c857faadd8e8bbe113ce32d54f33fdac0ebe423d88d1912', '[\"*\"]', NULL, NULL, '2024-01-03 17:26:02', '2024-01-03 17:26:02'),
(8, 'App\\Models\\User', 8, 'access_token', 'b257c4e5f65e339433059367a3d078a58ddf5722e019a56513e3b2bc98f00da5', '[\"*\"]', '2024-01-19 11:22:45', NULL, '2024-01-03 23:33:01', '2024-01-19 11:22:45'),
(9, 'App\\Models\\User', 9, 'access_token', '87d92cfc530e96ab5f790b6895a406c1058fab7fdb2200cd1477e500c306d999', '[\"*\"]', '2024-01-04 19:06:02', NULL, '2024-01-04 19:00:41', '2024-01-04 19:06:02'),
(10, 'App\\Models\\User', 10, 'access_token', 'e80e831914cc7ebe49e3fdb5a4f9e90ecb4113c3f180826d805af773ea52fe75', '[\"*\"]', '2024-01-07 14:02:38', NULL, '2024-01-04 19:08:52', '2024-01-07 14:02:38'),
(11, 'App\\Models\\User', 11, 'access_token', 'e8e497b3636093c3e9cbeba160b0f68e5fa347389db4e3c50bb3b1a95d9274ab', '[\"*\"]', '2024-01-08 20:25:37', NULL, '2024-01-05 19:31:03', '2024-01-08 20:25:37'),
(12, 'App\\Models\\User', 12, 'access_token', '92f07a700dddb4f7fbd63e4f2849be564baa171f68cbbc08aeb089ba4e621e2f', '[\"*\"]', '2024-01-07 21:24:46', NULL, '2024-01-06 17:04:24', '2024-01-07 21:24:46'),
(13, 'App\\Models\\User', 13, 'access_token', '41ce4852e1e5af6b5768738c7d892208f4094268d2624471ec81f26319ad0601', '[\"*\"]', '2024-01-09 19:43:01', NULL, '2024-01-07 14:00:40', '2024-01-09 19:43:01'),
(14, 'App\\Models\\User', 14, 'access_token', '0c5dcf5e89c818cfae948984034aa0cb1c054f3707f3c513a51d7cca7958dde7', '[\"*\"]', '2024-01-07 21:06:06', NULL, '2024-01-07 21:01:39', '2024-01-07 21:06:06'),
(15, 'App\\Models\\User', 15, 'access_token', '489df4188b5534169f2f95f9e9bda9f2dee26c954f3e13f5d1ee426c1cd2e8ce', '[\"*\"]', NULL, NULL, '2024-01-07 23:14:32', '2024-01-07 23:14:32'),
(16, 'App\\Models\\User', 16, 'access_token', '71e82066f24c42df080eb7aae4c4c863a2c33a788601da3737851ccf11c4e8c6', '[\"*\"]', '2024-01-08 18:31:45', NULL, '2024-01-08 18:15:26', '2024-01-08 18:31:45'),
(17, 'App\\Models\\User', 17, 'access_token', '37881d0730ac9b1b5ee2c09bc85f46d7d15c95446eb380a856ea72608e743e8b', '[\"*\"]', '2024-01-17 19:26:02', NULL, '2024-01-08 18:25:28', '2024-01-17 19:26:02'),
(18, 'App\\Models\\User', 18, 'access_token', 'bd8651b9c28792c2a819c403d6fd8e0cedb050b028a85a9351bdbefe3529097f', '[\"*\"]', NULL, NULL, '2024-01-09 13:42:57', '2024-01-09 13:42:57'),
(19, 'App\\Models\\User', 19, 'access_token', '2707a650e51d94984870a0d502e7c00d860f1d73d17137809878f4c5d8b0a273', '[\"*\"]', NULL, NULL, '2024-01-10 19:18:00', '2024-01-10 19:18:00'),
(20, 'App\\Models\\User', 20, 'access_token', '2a9af0c3a20c9a3895fde155769dfab873df6d40c92567effef47ab0d31665a8', '[\"*\"]', '2024-01-14 16:55:51', NULL, '2024-01-14 14:40:26', '2024-01-14 16:55:51'),
(21, 'App\\Models\\User', 21, 'access_token', '10276f33383fa4455cd4aa3d539126114c83f4040e1300703c54ef9d0101e2f1', '[\"*\"]', '2024-01-19 10:31:06', NULL, '2024-01-16 16:23:10', '2024-01-19 10:31:06'),
(22, 'App\\Models\\User', 22, 'access_token', 'f29638466667a6a1a4ce32f73c37610df1d98c78ca6d71b3eba2f2f2588eaae2', '[\"*\"]', NULL, NULL, '2024-01-16 18:06:25', '2024-01-16 18:06:25'),
(23, 'App\\Models\\User', 23, 'access_token', 'fddbc563268fa9187afe9001bacf1cd8369fbde0686d5b6763eea6335aaf1d4d', '[\"*\"]', NULL, NULL, '2024-01-17 06:29:52', '2024-01-17 06:29:52'),
(24, 'App\\Models\\User', 24, 'access_token', '346bfb10c674d55ec9fe67d213a3ace4be0332eaf19da6e0e9b03ebce3675937', '[\"*\"]', NULL, NULL, '2024-01-19 12:14:54', '2024-01-19 12:14:54'),
(25, 'App\\Models\\User', 25, 'access_token', 'f6953dbc5ca34248c27e9c3ab37ee705d7731f5c1675395b4a262818f9d3d874', '[\"*\"]', '2024-01-19 05:50:45', NULL, '2024-01-19 05:47:25', '2024-01-19 05:50:45'),
(26, 'App\\Models\\User', 26, 'access_token', '32bd3a101470273e9f795746653990527b116d8c6081ef824d92185ae65624d0', '[\"*\"]', '2024-01-25 10:14:59', NULL, '2024-01-25 09:51:09', '2024-01-25 10:14:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `type` varchar(255) NOT NULL DEFAULT 'post',
  `priority` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `description` text DEFAULT NULL,
  `author_id` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `resource_v2_s`
--

CREATE TABLE `resource_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `domain` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `buyer_code` varchar(255) DEFAULT NULL,
  `buyer_paym` varchar(255) DEFAULT NULL,
  `buyer_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spin_quests`
--

CREATE TABLE `spin_quests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'custom',
  `prizes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `image` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `descr` longtext DEFAULT NULL,
  `price` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `spin_quests`
--

INSERT INTO `spin_quests` (`id`, `name`, `type`, `prizes`, `image`, `cover`, `descr`, `price`, `store_id`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'Vòng Quay Nhập Học', 'custom', '[]', 'https://i.imgur.com/fdQh9xv.png', 'https://i.imgur.com/khCnyhK.png', NULL, 10000, NULL, 1, 0, '2024-01-25 10:00:19', '2024-01-25 10:00:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spin_quest_logs`
--

CREATE TABLE `spin_quest_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `prize` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `content` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `spin_quest_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `cost_amount` bigint(20) NOT NULL DEFAULT 0,
  `balance_after` bigint(20) NOT NULL,
  `balance_before` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `extras` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `sys_note` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `code`, `amount`, `cost_amount`, `balance_after`, `balance_before`, `type`, `extras`, `order_id`, `sys_note`, `status`, `content`, `user_id`, `username`, `domain`, `created_at`, `updated_at`) VALUES
(18, 'SP3-UB3QY2U', 30000, 0, 30000, 0, 'deposit', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#3: ', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-08 23:51:24', '2024-01-08 23:51:24'),
(19, 'GB-LATH3RYR', 30000, 0, 0, 30000, 'boosting-buy', '{\"group_id\":10,\"package_id\":125}', NULL, NULL, 'paid', 'Thuê gói cày Soul; Nhóm Haze Piece', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-08 23:52:07', '2024-01-08 23:52:07'),
(20, 'CARD-2F0WN1', 16000, 0, 16000, 0, 'deposit', '{\"card_id\":5}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010248033860; phí 20%', 20, 'nguyen', 'haiduongbbs.vn', '2024-01-14 16:35:24', '2024-01-14 16:35:24'),
(21, 'CARD-R9UTJA', 16000, 0, 32000, 16000, 'deposit', '{\"card_id\":6}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010248033855; phí 20%', 20, 'nguyen', 'haiduongbbs.vn', '2024-01-14 16:37:12', '2024-01-14 16:37:12'),
(22, 'OG-KAJJKQFX', 24000, 0, 8000, 32000, 'item-buy', '{\"group_id\":\"5\",\"account_id\":10029}', NULL, NULL, 'paid', 'Mua dịch vụ 1000000 Gem (1M gem); Nhóm Gem và Item Pet99', 20, 'nguyen', 'haiduongbbs.vn', '2024-01-14 16:37:47', '2024-01-14 16:37:47'),
(23, 'SP3-MCLHM38', 48000, 0, 48000, 0, 'deposit', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-15 13:52:34', '2024-01-15 13:52:34'),
(24, 'SP3-SFUMLFELUS', 48000, 0, 0, 48000, 'admin-change', '{\"reason\":\"\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-15 13:53:12', '2024-01-15 13:53:12'),
(25, 'SP3-JP3LPPQ', 80000, 0, 80000, 0, 'deposit', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', NULL, '2024-01-16 13:48:18', '2024-01-16 13:48:18'),
(26, 'SP3-DFYARNPCVL', 80000, 0, 0, 80000, 'admin-change', '{\"reason\":\"\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', NULL, '2024-01-17 08:36:49', '2024-01-17 08:36:49'),
(27, 'CARD-N0GYL4', 80000, 0, 80000, 0, 'deposit', '{\"card_id\":7}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010539707356; phí 20%', 21, 'longla22', NULL, '2024-01-19 10:01:25', '2024-01-19 10:01:25'),
(28, 'CARD-ZPXKFD', 80000, 0, 160000, 80000, 'deposit', '{\"card_id\":8}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010539707351; phí 20%', 21, 'longla22', NULL, '2024-01-19 10:04:20', '2024-01-19 10:04:20'),
(29, 'OG-MTANFB3B', 150000, 0, 10000, 160000, 'item-buy', '{\"group_id\":\"3\",\"account_id\":100}', NULL, NULL, 'paid', 'Mua dịch vụ Upgraded Titan Cinemaman; Nhóm Tollet Tower Defense', 21, 'longla22', NULL, '2024-01-19 10:06:25', '2024-01-19 10:06:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `balance_1` double NOT NULL DEFAULT 0,
  `balance_2` int(11) NOT NULL DEFAULT 0,
  `total_deposit` double NOT NULL DEFAULT 0,
  `total_withdraw` double NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `referral_by` varchar(255) DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `register_by` varchar(255) DEFAULT NULL,
  `register_ip` varchar(255) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `withdraw_logs`
--

CREATE TABLE `withdraw_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `user_note` varchar(255) DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `current_balance` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `api_configs`
--
ALTER TABLE `api_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_configs_name_unique` (`name`);

--
-- Chỉ mục cho bảng `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `card_lists`
--
ALTER TABLE `card_lists`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `category_v2_s`
--
ALTER TABLE `category_v2_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_v2_s_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `group_v2_s`
--
ALTER TABLE `group_v2_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_v2_s_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `g_b_categories`
--
ALTER TABLE `g_b_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `g_b_categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `g_b_groups`
--
ALTER TABLE `g_b_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `g_b_groups_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `g_b_orders`
--
ALTER TABLE `g_b_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `g_b_packages`
--
ALTER TABLE `g_b_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `g_b_packages_code_unique` (`code`);

--
-- Chỉ mục cho bảng `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_code_unique` (`code`);

--
-- Chỉ mục cho bảng `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `item_data`
--
ALTER TABLE `item_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_data_code_unique` (`code`);

--
-- Chỉ mục cho bảng `item_groups`
--
ALTER TABLE `item_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_groups_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_orders_code_unique` (`code`);

--
-- Chỉ mục cho bảng `list_items`
--
ALTER TABLE `list_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `list_items_code_unique` (`code`);

--
-- Chỉ mục cho bảng `list_item_archives`
--
ALTER TABLE `list_item_archives`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_item_v2_s`
--
ALTER TABLE `list_item_v2_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `list_item_v2_s_code_unique` (`code`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `resource_v2_s`
--
ALTER TABLE `resource_v2_s`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `spin_quests`
--
ALTER TABLE `spin_quests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `spin_quest_logs`
--
ALTER TABLE `spin_quest_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spin_quest_logs_user_id_foreign` (`user_id`),
  ADD KEY `spin_quest_logs_spin_quest_id_foreign` (`spin_quest_id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraw_logs_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `api_configs`
--
ALTER TABLE `api_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `card_lists`
--
ALTER TABLE `card_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `category_v2_s`
--
ALTER TABLE `category_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `group_v2_s`
--
ALTER TABLE `group_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `g_b_categories`
--
ALTER TABLE `g_b_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `g_b_groups`
--
ALTER TABLE `g_b_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `g_b_orders`
--
ALTER TABLE `g_b_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `g_b_packages`
--
ALTER TABLE `g_b_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT cho bảng `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `item_data`
--
ALTER TABLE `item_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10091;

--
-- AUTO_INCREMENT cho bảng `item_groups`
--
ALTER TABLE `item_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `item_orders`
--
ALTER TABLE `item_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `list_items`
--
ALTER TABLE `list_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `list_item_archives`
--
ALTER TABLE `list_item_archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `list_item_v2_s`
--
ALTER TABLE `list_item_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `resource_v2_s`
--
ALTER TABLE `resource_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `spin_quests`
--
ALTER TABLE `spin_quests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `spin_quest_logs`
--
ALTER TABLE `spin_quest_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `spin_quest_logs`
--
ALTER TABLE `spin_quest_logs`
  ADD CONSTRAINT `spin_quest_logs_spin_quest_id_foreign` FOREIGN KEY (`spin_quest_id`) REFERENCES `spin_quests` (`id`),
  ADD CONSTRAINT `spin_quest_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  ADD CONSTRAINT `withdraw_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
