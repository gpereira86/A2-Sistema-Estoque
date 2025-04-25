-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2025 at 04:50 PM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadclientes`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `uploaded_at`) VALUES
(1, 'Alimentação', '2024-01-15 12:30:00', NULL),
(2, 'Transporte', '2024-02-20 17:10:00', NULL),
(3, 'Moradia', '2024-03-05 14:45:00', NULL),
(4, 'Educação', '2024-06-10 11:00:00', NULL),
(5, 'Saúde', '2024-10-25 20:20:00', NULL),
(6, 'Lazer', '2025-01-08 16:00:00', NULL),
(7, 'Assinaturas e Serviços', '2025-02-18 19:30:00', NULL),
(8, 'Impostos e Taxas', '2025-03-30 15:15:00', NULL),
(9, 'Investimentos', '2025-04-10 13:40:00', NULL),
(10, 'Doações', '2025-04-20 18:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productcode` int(20) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `category_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `user_id_updated` int(11) DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productcode`, `productname`, `description`, `price`, `quantity`, `status`, `category_id`, `user_id`, `created_at`, `user_id_updated`, `uploaded_at`) VALUES
(1, 8610, 'Culpa reiciendis', NULL, 98.48, 139, 0, 1, 15, '2024-10-02 11:10:24', NULL, NULL),
(2, 1206, 'Adipisci quas', NULL, 1189.15, 168, 0, 2, 2, '2024-09-12 19:44:13', NULL, NULL),
(3, 5814, 'Earum', 'In itaque', 727.97, 54, 0, 8, 13, '2024-07-21 00:50:06', NULL, NULL),
(4, 8599, 'Maxime sint', 'Voluptatum numquam itaque voluptatem', 901.53, 104, 0, 6, 0, '2024-12-19 01:09:20', NULL, NULL),
(5, 9995, 'Tempore quod ratione', NULL, 1010.46, 78, 0, 6, 10, '2025-04-07 04:25:13', 5, '2025-01-21 01:34:40'),
(6, 9327, 'Dolore', 'Sequi ratione', 654.23, 169, 1, 2, 15, '2024-05-12 08:27:10', NULL, NULL),
(7, 4298, 'Itaque', 'Nesciunt eaque assumenda', 1159.80, 186, 0, 7, 13, '2024-07-06 14:33:08', 1, '2024-06-10 01:41:58'),
(8, 5221, 'Cupiditate beatae', 'Ad tempora labore', 1464.26, 87, 0, 3, 12, '2024-09-19 12:57:15', NULL, NULL),
(9, 4889, 'Totam', NULL, 761.88, 31, 0, 1, 2, '2024-11-08 09:54:04', NULL, NULL),
(10, 1645, 'Tenetur', NULL, 1105.58, 134, 1, 3, 13, '2024-08-23 21:56:36', NULL, NULL),
(11, 2279, 'Porro', NULL, 1277.20, 46, 1, 4, 6, '2024-08-04 15:52:33', NULL, NULL),
(12, 8935, 'At', 'Quae eos est', 548.04, 35, 0, 10, 4, '2024-08-26 01:46:13', NULL, NULL),
(13, 121, 'Ullam sed velit', 'A suscipit architecto', 1112.25, 100, 1, 10, 14, '2024-06-29 23:55:38', NULL, NULL),
(14, 3469, 'Corporis voluptate', NULL, 958.01, 120, 1, 10, 15, '2024-07-05 11:28:47', NULL, NULL),
(15, 686, 'Minus dolor', 'Illo tenetur', 1466.31, 84, 0, 4, 10, '2024-10-02 17:12:22', NULL, NULL),
(16, 2468, 'Inventore fugit', 'Corrupti eius sed', 68.08, 79, 1, 5, 5, '2025-01-10 10:06:56', NULL, NULL),
(17, 8685, 'Culpa id', NULL, 790.64, 52, 1, 6, 15, '2024-06-11 10:26:01', NULL, NULL),
(18, 9062, 'Quo', 'Officia consequatur aut', 1072.28, 105, 1, 7, 15, '2025-01-25 17:40:27', NULL, NULL),
(19, 2085, 'Harum enim', NULL, 1068.01, 186, 0, 5, 1, '2025-01-18 02:38:21', NULL, NULL),
(20, 2526, 'Saepe', NULL, 1116.95, 10, 0, 10, 8, '2024-08-13 04:26:39', NULL, NULL),
(21, 5946, 'Sunt', NULL, 36.02, 162, 0, 10, 7, '2025-03-28 12:22:32', 14, '2025-03-19 01:56:00'),
(22, 8134, 'Minima', 'Sed ut tempore ullam', 950.95, 13, 1, 6, 9, '2024-08-06 10:18:15', 14, '2024-09-17 09:17:19'),
(23, 6863, 'Commodi', NULL, 432.10, 187, 0, 7, 13, '2024-08-03 19:07:26', NULL, NULL),
(24, 5920, 'Corrupti', NULL, 1473.76, 128, 0, 4, 2, '2024-08-08 05:01:07', NULL, NULL),
(25, 7489, 'Aspernatur quasi', NULL, 104.14, 140, 0, 7, 7, '2024-11-14 09:59:32', 12, '2024-08-04 03:34:10'),
(26, 6594, 'Iure maxime', NULL, 822.32, 47, 1, 2, 2, '2025-01-17 15:11:09', 2, '2025-02-26 06:54:34'),
(27, 7996, 'Quos', 'Quis in et', 306.50, 9, 1, 1, 10, '2025-01-03 12:05:20', NULL, NULL),
(28, 4740, 'Corrupti eveniet repellendus', 'Iste at ipsam', 150.61, 164, 1, 6, 2, '2024-09-14 20:32:11', 4, '2025-03-11 08:12:20'),
(29, 1975, 'Consectetur aliquid accusamus', 'Error quam sapiente temporibus', 238.34, 188, 1, 3, 1, '2025-03-10 20:33:51', NULL, '2025-04-05 13:16:03'),
(30, 4693, 'Quisquam', NULL, 106.51, 199, 1, 8, 6, '2024-05-23 17:45:10', NULL, NULL),
(31, 9863, 'Consectetur', 'Magnam esse laboriosam', 864.87, 63, 1, 8, 15, '2025-02-26 19:15:06', NULL, NULL),
(32, 2877, 'Placeat', NULL, 1034.82, 11, 1, 3, 2, '2024-11-11 21:15:44', 1, '2025-01-02 12:02:04'),
(33, 9075, 'Nesciunt facere', NULL, 1268.86, 144, 1, 4, 10, '2025-01-18 14:23:06', NULL, NULL),
(34, 188, 'Impedit', 'Commodi cupiditate', 1249.29, 95, 1, 6, 3, '2025-01-18 10:14:02', NULL, NULL),
(35, 2743, 'Architecto', 'Voluptatum', 97.74, 154, 0, 0, 14, '2024-08-26 16:53:11', NULL, NULL),
(36, 1880, 'Asperiores', NULL, 1066.73, 162, 1, 3, 7, '2024-12-17 23:22:25', NULL, NULL),
(37, 7578, 'Qui facere nostrum', NULL, 1398.82, 63, 1, 6, 3, '2024-09-16 04:41:14', NULL, '2024-10-25 21:38:40'),
(38, 2072, 'Ullam', NULL, 1191.46, 115, 1, 4, 2, '2025-01-31 05:15:24', NULL, NULL),
(39, 5742, 'Rem', 'Ex temporibus consectetur rem', 1159.16, 13, 1, 9, 7, '2024-11-03 08:13:40', NULL, NULL),
(40, 1740, 'Consequatur', 'Nisi ipsa', 1065.24, 101, 0, 3, 12, '2025-03-11 08:29:15', NULL, NULL),
(41, 2789, 'Mollitia', NULL, 1261.19, 144, 0, 6, 1, '2024-06-07 22:38:51', NULL, NULL),
(42, 4735, 'Iusto magnam', NULL, 1355.53, 69, 1, 4, 15, '2025-02-05 01:32:26', 7, '2025-01-03 11:21:14'),
(43, 4130, 'Et labore', NULL, 306.46, 19, 1, 2, 14, '2024-05-17 10:13:54', NULL, NULL),
(44, 2601, 'Laborum rerum', NULL, 332.32, 114, 1, 4, 10, '2025-01-04 13:21:57', 3, '2024-07-25 16:45:24'),
(45, 3431, 'Vel possimus', NULL, 1225.85, 164, 1, 6, 5, '2025-03-05 09:25:27', NULL, NULL),
(46, 5700, 'Neque', 'Excepturi quam error deserunt', 238.35, 162, 0, 8, 3, '2024-11-25 05:32:43', NULL, NULL),
(47, 4868, 'Ratione delectus', NULL, 1130.42, 137, 1, 3, 4, '2025-03-18 12:11:55', NULL, NULL),
(48, 5738, 'Reprehenderit qui quos', NULL, 303.23, 38, 0, 9, 9, '2024-08-24 17:17:53', 7, '2024-10-30 12:46:05'),
(49, 8233, 'Earum laboriosam soluta', NULL, 818.10, 123, 0, 4, 8, '2025-03-12 18:11:42', 4, '2024-12-20 04:03:35'),
(50, 5968, 'Corrupti nisi', 'Laboriosam labore ea soluta', 656.85, 86, 0, 3, 7, '2025-03-01 20:48:15', NULL, NULL),
(51, 2387, 'Aut quaerat veritatis nobis', 'Tempore facere cupiditate quidem mollitia adipisci', 1201.94, 11, 0, 1, 2, '2024-10-13 05:19:48', NULL, NULL),
(52, 2609, 'Omnis doloribus perspiciatis', 'Necessitatibus molestias saepe', 683.11, 84, 0, 3, 13, '2025-01-08 02:57:04', NULL, NULL),
(53, 8618, 'Neque perspiciatis repudiandae', NULL, 622.79, 44, 1, 4, 4, '2024-10-12 11:28:28', 5, '2024-05-17 05:51:58'),
(54, 4101, 'Culpa mollitia ipsam', 'Laborum', 1001.66, 143, 1, 9, 1, '2025-01-08 23:28:18', NULL, NULL),
(55, 623, 'Corporis', 'Neque distinctio ut ipsum animi', 801.59, 133, 1, 10, 4, '2024-06-27 06:30:18', NULL, NULL),
(56, 8866, 'Facilis blanditiis', 'Mollitia molestiae', 1140.10, 32, 1, 1, 12, '2024-06-19 06:51:55', NULL, NULL),
(57, 9148, 'Expedita necessitatibus', 'Quaerat adipisci culpa sint', 1272.34, 98, 1, 0, 10, '2024-12-21 06:57:38', 6, '2024-08-31 12:35:42'),
(58, 2924, 'Minus nihil', NULL, 1020.92, 130, 0, 1, 12, '2025-01-24 07:25:56', 13, '2024-10-17 03:25:00'),
(59, 2040, 'Odit', NULL, 1000.71, 140, 0, 9, 7, '2025-03-14 18:54:11', NULL, NULL),
(60, 5732, 'Ad eum perferendis nemo', NULL, 1310.11, 125, 0, 1, 2, '2024-05-25 17:27:40', 2, '2024-12-30 05:33:17'),
(61, 8356, 'Adipisci repellat', 'Dolorum ea qui molestias deleniti', 133.03, 163, 1, 5, 5, '2024-12-13 02:05:25', NULL, NULL),
(62, 3171, 'Sequi quis', 'Error illo', 533.17, 169, 1, 1, 14, '2024-07-08 09:51:45', NULL, NULL),
(63, 1459, 'Asperiores', NULL, 81.93, 74, 1, 1, 12, '2024-05-05 00:20:53', NULL, NULL),
(64, 6986, 'Pariatur error et', 'Sequi sequi accusantium', 1432.83, 98, 0, 3, 5, '2025-03-23 06:48:04', NULL, NULL),
(65, 3508, 'Accusamus', NULL, 874.67, 85, 0, 1, 11, '2024-05-02 22:23:28', 12, '2024-07-10 21:52:53'),
(66, 1183, 'Iure illum', 'Deleniti beatae ipsa', 408.91, 111, 1, 8, 4, '2025-04-18 17:44:47', 9, '2024-07-03 18:27:49'),
(67, 4923, 'Cum earum consectetur necessitatibus', NULL, 355.51, 198, 0, 2, 9, '2024-08-13 12:16:27', NULL, NULL),
(68, 9067, 'Ipsum nihil', NULL, 550.42, 4, 1, 0, 9, '2025-04-22 05:58:42', NULL, NULL),
(69, 9860, 'Porro', NULL, 573.17, 118, 0, 8, 6, '2024-09-15 02:32:33', 8, '2024-10-20 12:29:16'),
(70, 7061, 'Necessitatibus', 'Suscipit doloremque neque', 98.86, 159, 0, 10, 2, '2024-06-06 11:18:11', NULL, NULL),
(71, 2973, 'Mollitia', 'Nulla quos aspernatur', 257.62, 159, 0, 7, 10, '2025-01-07 18:13:37', NULL, NULL),
(72, 1006, 'Id', 'Voluptatem nemo tempora eaque repudiandae nam', 768.63, 135, 0, 10, 11, '2024-08-05 23:26:52', NULL, NULL),
(73, 9516, 'Veniam', NULL, 1095.75, 116, 0, 2, 1, '2024-10-10 08:05:47', NULL, NULL),
(74, 3217, 'Minus', NULL, 661.18, 38, 1, 6, 2, '2025-04-22 01:46:44', NULL, NULL),
(75, 1152, 'Quasi', 'Voluptatibus doloribus reiciendis', 1338.46, 104, 1, 6, 6, '2024-11-05 17:23:37', NULL, NULL),
(76, 3017, 'Animi velit voluptatem', NULL, 221.51, 182, 1, 0, 4, '2024-07-16 06:31:43', NULL, NULL),
(77, 5702, 'Necessitatibus', 'Dolor culpa libero', 335.52, 133, 1, 3, 15, '2024-07-14 17:02:45', 9, '2024-08-05 23:05:27'),
(78, 1743, 'Expedita labore nisi ducimus', NULL, 88.93, 52, 1, 9, 9, '2025-02-26 12:23:32', NULL, NULL),
(79, 6916, 'Minima', NULL, 733.03, 105, 0, 9, 8, '2025-01-15 11:02:16', 12, '2024-05-10 15:48:19'),
(80, 8385, 'Doloremque consequuntur', NULL, 1157.80, 43, 1, 8, 4, '2024-05-13 18:36:21', NULL, '2025-03-20 05:22:28'),
(81, 3542, 'Velit officia sunt', NULL, 238.81, 67, 1, 8, 9, '2025-02-24 23:03:33', NULL, NULL),
(82, 8622, 'Praesentium', NULL, 1270.99, 113, 0, 8, 11, '2024-07-07 12:24:35', NULL, NULL),
(83, 3352, 'Itaque reiciendis', NULL, 751.45, 166, 1, 5, 14, '2025-03-10 15:44:53', NULL, NULL),
(84, 9004, 'Numquam', NULL, 273.32, 131, 0, 7, 2, '2024-06-30 09:02:11', 13, '2024-08-19 14:14:34'),
(85, 3361, 'Velit', NULL, 804.75, 73, 1, 6, 7, '2024-05-31 03:27:51', NULL, NULL),
(86, 5577, 'Consectetur perferendis', NULL, 601.06, 82, 1, 7, 14, '2024-10-13 05:02:03', 11, '2024-06-26 09:22:28'),
(87, 9444, 'Est', NULL, 1174.50, 84, 1, 5, 5, '2024-08-07 02:08:32', NULL, NULL),
(88, 7289, 'Nobis', 'Numquam placeat fuga', 1222.39, 40, 0, 8, 5, '2024-06-01 11:43:45', 11, '2024-08-06 21:09:04'),
(89, 6047, 'Saepe nihil commodi quisquam', 'Totam velit quos delectus', 812.63, 147, 0, 2, 15, '2024-10-18 04:28:12', NULL, NULL),
(90, 1512, 'Ipsam', NULL, 578.90, 31, 0, 3, 4, '2024-06-02 06:56:46', NULL, NULL),
(91, 6194, 'Ratione ut enim odit', 'Sapiente dignissimos ut similique', 1279.62, 103, 1, 5, 15, '2024-12-14 01:12:24', NULL, NULL),
(92, 5842, 'Culpa', NULL, 663.93, 126, 1, 0, 13, '2024-05-03 01:37:36', NULL, NULL),
(93, 5428, 'Nulla mollitia', NULL, 903.73, 72, 1, 4, 0, '2025-02-11 16:46:21', NULL, NULL),
(94, 7211, 'Fugit nulla ipsa', 'Doloribus dolorum est earum nisi', 83.33, 76, 0, 7, 5, '2024-06-15 22:08:21', 8, '2024-10-28 22:51:53'),
(95, 6034, 'Hic id', NULL, 460.95, 129, 0, 10, 3, '2024-08-12 03:50:10', NULL, NULL),
(96, 9232, 'Repudiandae', 'Eveniet nihil assumenda', 337.39, 118, 1, 6, 0, '2025-04-12 01:51:21', NULL, NULL),
(97, 7817, 'Corrupti eaque', NULL, 1288.14, 68, 0, 4, 5, '2024-05-01 11:15:34', 11, '2025-03-03 20:42:05'),
(98, 9659, 'Illo nemo mollitia', NULL, 982.20, 22, 1, 10, 14, '2024-11-27 23:57:54', NULL, NULL),
(99, 7185, 'Quo non', NULL, 1069.10, 180, 0, 6, 11, '2024-12-09 17:44:29', 1, '2024-11-20 07:05:57'),
(100, 8578, 'Unde', 'Quibusdam provident itaque consectetur dolore accusamus', 902.06, 196, 1, 10, 11, '2024-12-08 03:20:33', 3, '2024-11-18 12:49:02'),
(101, 2787, 'Eos modi nemo', NULL, 454.85, 161, 0, 4, 7, '2024-12-19 16:04:34', 1, '2025-03-31 20:51:28'),
(102, 4801, 'Adipisci', NULL, 796.76, 31, 0, 4, 6, '2025-04-16 00:08:28', NULL, NULL),
(103, 8754, 'Consequuntur', 'Eos ipsum praesentium vel', 1256.08, 32, 1, 0, 13, '2024-11-01 11:53:15', 1, '2025-04-04 12:28:53'),
(104, 1376, 'Aliquid eos', 'Molestias facilis', 351.97, 30, 1, 10, 4, '2025-01-24 20:18:11', 10, '2024-05-03 01:21:43'),
(105, 1073, 'Vel', NULL, 1138.43, 88, 1, 4, 10, '2024-11-03 20:10:58', NULL, NULL),
(106, 6299, 'Doloribus', NULL, 190.36, 104, 0, 3, 12, '2025-02-23 15:05:34', 7, '2024-10-09 22:08:21'),
(107, 5916, 'Ut', NULL, 177.37, 127, 1, 4, 7, '2024-08-18 11:15:41', NULL, NULL),
(108, 903, 'Suscipit', 'Rerum voluptates amet ullam expedita maiores', 654.78, 117, 1, 10, 1, '2024-05-23 17:15:58', NULL, NULL),
(109, 1081, 'Aut dolores a', NULL, 780.19, 55, 1, 7, 4, '2024-11-28 02:03:05', NULL, NULL),
(110, 5266, 'Vel', 'Quam ipsa', 1324.82, 45, 0, 6, 8, '2025-04-02 01:51:16', NULL, NULL),
(111, 9906, 'Qui', 'Sapiente labore sed exercitationem', 26.54, 174, 1, 6, 10, '2025-04-01 00:17:45', 7, '2024-05-26 18:52:36'),
(112, 2400, 'Explicabo officia odit', NULL, 94.09, 109, 0, 3, 4, '2025-02-22 03:01:55', 6, '2024-08-05 13:41:22'),
(113, 9165, 'Quia quo', NULL, 514.89, 130, 0, 2, 13, '2024-11-29 15:16:14', 13, '2025-01-11 11:37:18'),
(114, 6007, 'Ex eius', NULL, 1411.86, 123, 1, 4, 13, '2025-04-19 23:52:47', NULL, NULL),
(115, 1802, 'Minus', NULL, 14.59, 12, 1, 3, 12, '2024-06-13 05:22:56', NULL, NULL),
(116, 9270, 'Dolores', 'Blanditiis odit alias', 171.43, 77, 1, 10, 1, '2024-05-02 19:38:57', NULL, NULL),
(117, 7414, 'Aspernatur', NULL, 1431.10, 126, 0, 3, 8, '2024-08-09 10:55:16', NULL, NULL),
(118, 1019, 'Quibusdam', 'Ipsa illum quae', 903.28, 57, 0, 6, 3, '2025-03-25 11:49:55', 2, '2024-04-26 22:19:46'),
(119, 3441, 'Libero', NULL, 82.95, 126, 1, 4, 4, '2024-06-25 10:21:59', NULL, NULL),
(120, 4350, 'Nulla', 'Non deserunt voluptatibus neque officia', 21.84, 163, 0, 4, 1, '2024-06-11 00:30:16', NULL, NULL),
(121, 1713, 'Rem', NULL, 461.32, 174, 0, 1, 6, '2024-08-27 08:29:03', NULL, NULL),
(122, 2545, 'Aspernatur incidunt', NULL, 686.21, 65, 0, 0, 14, '2025-01-12 15:41:04', NULL, NULL),
(123, 7330, 'Voluptate delectus dicta', 'At nam id molestias iure', 721.41, 57, 0, 0, 7, '2024-04-24 11:01:17', NULL, NULL),
(124, 6788, 'Nemo sint quae', NULL, 7.60, 115, 0, 3, 8, '2025-03-24 15:30:34', 13, '2024-05-22 22:35:54'),
(125, 9667, 'Expedita', 'Ratione atque', 214.43, 175, 0, 1, 1, '2024-05-17 19:58:12', 13, '2024-05-19 07:39:52'),
(126, 1135, 'Beatae eligendi', 'Ducimus quisquam amet repellat iste', 1406.68, 200, 0, 0, 12, '2025-01-16 07:49:44', NULL, NULL),
(127, 1585, 'Illum', NULL, 966.10, 150, 0, 4, 4, '2024-12-21 19:23:20', NULL, NULL),
(128, 4184, 'Magnam', NULL, 575.51, 25, 1, 7, 1, '2024-11-01 17:39:58', NULL, NULL),
(129, 5054, 'Minus', NULL, 1417.51, 128, 0, 1, 14, '2025-03-10 09:23:16', NULL, NULL),
(130, 7050, 'Vel', NULL, 1220.38, 159, 1, 4, 2, '2025-03-20 12:37:04', NULL, NULL),
(131, 841, 'Nisi ipsam', 'Accusantium nulla tenetur esse', 172.73, 199, 1, 2, 13, '2024-10-04 00:28:00', 8, '2024-09-20 01:21:10'),
(132, 1921, 'Maxime ullam', NULL, 441.63, 120, 0, 5, 4, '2024-08-05 00:33:32', NULL, NULL),
(133, 1534, 'Beatae', 'Necessitatibus', 829.89, 155, 0, 5, 12, '2024-12-19 00:16:19', NULL, NULL),
(134, 2986, 'Vel', 'Reprehenderit impedit excepturi sint', 918.10, 129, 1, 7, 2, '2025-04-12 15:00:45', NULL, NULL),
(135, 3693, 'Consequatur alias', NULL, 541.31, 139, 1, 8, 14, '2024-04-30 22:21:58', 10, '2024-06-05 00:06:34'),
(136, 8823, 'Ipsa adipisci', NULL, 168.59, 93, 0, 2, 7, '2024-06-27 21:15:13', NULL, NULL),
(137, 8548, 'Ratione distinctio beatae', 'Magnam placeat laudantium', 1175.72, 5, 1, 6, 11, '2024-12-12 17:43:06', NULL, NULL),
(138, 7548, 'Aperiam occaecati', NULL, 33.45, 0, 1, 5, 4, '2024-08-31 20:39:35', 3, '2024-11-23 21:25:36'),
(139, 2760, 'Reprehenderit', 'Autem eos praesentium voluptatum', 1412.54, 191, 1, 0, 13, '2024-11-08 21:42:31', NULL, NULL),
(140, 6200, 'Aperiam', NULL, 1414.42, 138, 1, 3, 8, '2024-05-29 14:57:26', NULL, NULL),
(141, 8759, 'Possimus', NULL, 1305.24, 26, 1, 6, 0, '2024-07-27 16:45:29', 12, '2024-08-22 16:25:53'),
(142, 3555, 'Temporibus', 'Fugit tempora soluta', 1157.12, 114, 0, 8, 12, '2024-11-29 15:44:47', 14, '2025-01-11 18:54:31'),
(143, 3612, 'Itaque', 'In tempore in minus', 837.08, 137, 0, 5, 12, '2024-10-09 02:39:16', 7, '2024-10-30 06:25:39'),
(144, 5286, 'Repudiandae', 'Optio sit nulla alias natus possimus', 27.50, 194, 1, 6, 10, '2025-03-09 02:44:02', NULL, NULL),
(145, 1721, 'Reprehenderit minus labore illo', 'Eos impedit eum', 519.44, 63, 0, 3, 8, '2025-01-04 18:15:15', NULL, NULL),
(146, 3308, 'Officia', NULL, 1139.92, 25, 0, 2, 3, '2024-07-04 15:57:59', NULL, NULL),
(147, 2592, 'Earum at', NULL, 346.44, 98, 1, 1, 3, '2025-04-05 02:40:18', 4, '2025-01-28 01:58:51'),
(148, 5072, 'Quaerat', NULL, 31.06, 143, 0, 7, 7, '2025-03-16 16:30:40', 1, '2024-12-05 13:41:28'),
(149, 4986, 'Accusamus', 'Recusandae modi quo quod voluptatibus', 917.30, 68, 1, 8, 14, '2024-05-28 21:16:37', NULL, NULL),
(150, 9697, 'Eos', 'Assumenda temporibus', 571.11, 143, 0, 5, 2, '2024-11-06 11:04:53', NULL, NULL),
(151, 9789, 'Maiores voluptates enim', NULL, 490.03, 9, 0, 6, 15, '2024-07-25 14:45:46', 10, '2024-05-07 19:49:28'),
(152, 1503, 'Quaerat sapiente aperiam', NULL, 663.31, 46, 0, 4, 7, '2024-06-20 06:18:29', 4, '2024-07-28 17:40:10'),
(153, 2067, 'Repellendus', 'Quaerat earum odio', 441.02, 31, 0, 7, 14, '2024-04-25 15:29:17', NULL, NULL),
(154, 7513, 'Laboriosam', 'Facilis praesentium quos', 1000.74, 73, 1, 8, 10, '2025-03-28 17:31:38', 5, '2024-07-22 00:21:21'),
(155, 9485, 'Ab', 'Numquam enim porro accusamus voluptatibus', 640.33, 31, 0, 9, 14, '2024-09-16 15:55:17', NULL, NULL),
(156, 1205, 'Voluptatem ipsum', NULL, 1463.99, 35, 1, 1, 10, '2025-01-05 04:51:21', 14, '2024-12-17 20:44:49'),
(157, 3830, 'Cupiditate', NULL, 1265.40, 72, 0, 2, 8, '2024-08-22 19:06:32', 11, '2024-09-27 23:01:27'),
(158, 5390, 'Porro', 'Numquam quam animi', 488.07, 37, 0, 4, 6, '2024-09-26 21:17:48', NULL, NULL),
(159, 3686, 'Reiciendis', NULL, 1393.52, 182, 0, 1, 1, '2024-08-22 16:28:52', NULL, NULL),
(160, 3480, 'Molestias', NULL, 811.93, 81, 1, 1, 9, '2024-07-31 21:19:08', NULL, NULL),
(161, 8119, 'Dolorum sapiente', NULL, 462.49, 142, 1, 1, 1, '2025-04-23 21:16:43', NULL, NULL),
(162, 1078, 'Debitis ducimus tempore', NULL, 720.36, 58, 0, 6, 15, '2024-05-10 04:29:25', 9, '2024-11-22 10:40:44'),
(163, 8340, 'Tempore fugit', 'Tempore alias dolore perspiciatis', 774.75, 131, 0, 10, 10, '2024-09-28 22:43:46', NULL, NULL),
(164, 8133, 'Commodi sit', NULL, 1283.27, 19, 1, 10, 10, '2024-10-18 15:37:32', NULL, NULL),
(165, 1360, 'Soluta', NULL, 156.22, 99, 0, 9, 9, '2024-08-01 07:23:47', NULL, NULL),
(166, 6595, 'Amet natus', 'Quis facere vitae', 887.73, 119, 1, 6, 10, '2024-12-22 18:06:13', 9, '2025-02-09 11:14:47'),
(167, 3625, 'Delectus enim', NULL, 1133.97, 106, 1, 4, 7, '2025-04-21 08:18:32', 8, '2024-06-26 16:56:29'),
(168, 9781, 'Earum', NULL, 527.69, 59, 0, 7, 4, '2025-01-26 20:30:58', 11, '2024-10-24 20:06:07'),
(169, 5919, 'Aut ad magni', 'Iste minima officiis voluptatem inventore repudiandae', 113.74, 179, 0, 5, 7, '2025-03-26 17:53:44', NULL, NULL),
(170, 7076, 'A in dolorum', NULL, 945.77, 97, 0, 10, 15, '2025-01-20 12:10:32', 5, '2024-08-03 14:43:22'),
(171, 2480, 'Odit sequi', NULL, 1494.80, 8, 1, 0, 11, '2025-04-09 04:27:39', 6, '2024-06-15 06:29:20'),
(172, 4356, 'Necessitatibus', NULL, 705.95, 63, 0, 10, 2, '2024-07-10 02:00:56', 13, '2024-07-28 01:05:12'),
(173, 3574, 'Nesciunt sed suscipit', 'Ut facilis', 585.03, 27, 1, 7, 12, '2024-11-28 15:21:07', NULL, NULL),
(174, 3134, 'Illo', NULL, 118.26, 153, 1, 10, 4, '2024-12-17 11:39:01', NULL, NULL),
(175, 2976, 'Vel', 'Molestias', 227.96, 8, 0, 3, 12, '2025-01-17 13:25:49', 4, '2024-11-10 06:25:52'),
(176, 8537, 'Corporis porro nisi', 'Corrupti quis', 1479.77, 189, 0, 8, 13, '2025-03-12 16:26:13', 3, '2024-11-03 16:31:08'),
(177, 2230, 'Magnam', 'Quisquam debitis quod cupiditate', 1239.18, 135, 0, 7, 1, '2025-01-24 05:53:27', 5, '2025-02-04 20:57:57'),
(178, 19, 'Totam', 'Quo perspiciatis ullam eveniet', 256.50, 35, 1, 8, 11, '2024-09-17 02:49:01', NULL, NULL),
(179, 497, 'Dolorum amet', NULL, 1173.03, 111, 1, 5, 2, '2024-05-17 04:24:37', NULL, NULL),
(180, 6970, 'Sunt', NULL, 805.94, 49, 1, 7, 3, '2024-10-25 15:05:36', 15, '2024-05-14 16:08:04'),
(181, 2103, 'Explicabo', NULL, 1199.26, 64, 1, 8, 3, '2024-12-05 02:26:52', NULL, '2025-03-20 03:46:40'),
(182, 8966, 'Ipsa', 'Distinctio dolorum', 1098.69, 65, 0, 7, 7, '2024-12-22 15:42:13', 7, '2024-11-27 08:11:38'),
(183, 7054, 'Facere sequi delectus', 'Quas doloremque nihil recusandae commodi', 409.19, 107, 1, 10, 11, '2024-12-06 14:08:42', 14, '2024-08-03 18:36:14'),
(184, 7929, 'Voluptatem', NULL, 556.93, 12, 1, 2, 11, '2025-01-15 02:21:27', NULL, NULL),
(185, 4640, 'Quibusdam', NULL, 884.02, 148, 1, 0, 14, '2024-11-23 06:38:08', NULL, '2024-10-23 17:09:46'),
(186, 2637, 'Ex nam fugiat', 'Culpa culpa optio architecto itaque', 781.87, 190, 1, 8, 13, '2024-07-03 04:02:11', NULL, NULL),
(187, 4295, 'Nemo', NULL, 511.99, 109, 1, 1, 6, '2024-06-28 20:39:32', 11, '2024-11-18 22:49:35'),
(188, 6872, 'At ullam eius', NULL, 1082.22, 25, 0, 10, 12, '2024-09-29 02:26:10', NULL, NULL),
(189, 1429, 'Aliquid', NULL, 860.74, 74, 1, 2, 6, '2024-07-28 09:12:13', NULL, NULL),
(190, 4880, 'Inventore quibusdam', 'Error perferendis numquam soluta', 1336.10, 126, 0, 9, 15, '2024-09-08 23:56:26', NULL, NULL),
(191, 8645, 'Ea ab mollitia', 'Dolores aut molestiae voluptatibus', 1452.30, 125, 1, 10, 0, '2024-11-22 22:01:02', NULL, NULL),
(192, 8596, 'Cum', 'A recusandae facilis', 1439.81, 127, 1, 9, 6, '2024-05-19 07:52:17', NULL, NULL),
(193, 8421, 'Nihil quaerat', NULL, 1453.91, 190, 0, 1, 15, '2024-07-24 15:53:23', 10, '2024-06-21 07:38:38'),
(194, 8714, 'Corporis', NULL, 757.93, 60, 0, 5, 9, '2025-04-23 13:36:10', 13, '2024-11-22 06:24:54'),
(195, 7196, 'Dignissimos', NULL, 1217.26, 82, 1, 7, 3, '2024-09-16 16:15:37', 8, '2025-03-30 22:47:50'),
(196, 6962, 'Modi nam', NULL, 1445.43, 111, 0, 0, 1, '2024-10-17 05:28:42', 5, '2025-04-14 16:52:12'),
(197, 6083, 'Rem', NULL, 890.67, 88, 1, 3, 12, '2024-07-06 20:17:06', NULL, '2024-06-19 03:20:33'),
(198, 584, 'Natus', 'Praesentium enim porro qui excepturi consequatur', 362.10, 139, 0, 0, 14, '2025-01-28 17:13:03', NULL, NULL),
(199, 7412, 'Iste architecto', NULL, 1232.83, 74, 0, 10, 1, '2024-07-14 06:04:44', NULL, NULL),
(200, 736, 'Iusto praesentium', NULL, 1137.69, 168, 1, 8, 11, '2025-02-14 09:13:49', NULL, NULL),
(201, 1978, 'Commodi', NULL, 43.34, 140, 0, 5, 0, '2025-04-07 04:32:26', 4, '2024-12-25 16:40:25'),
(202, 4886, 'Voluptatum mollitia tempora', 'Provident quos atque', 1186.93, 133, 1, 10, 2, '2024-12-24 19:30:17', NULL, NULL),
(203, 3986, 'Officiis', NULL, 1185.12, 172, 0, 2, 0, '2025-01-19 03:25:41', NULL, NULL),
(204, 706, 'Sit veniam', 'Asperiores itaque asperiores excepturi', 46.96, 5, 0, 3, 6, '2025-03-23 23:50:42', NULL, NULL),
(205, 539, 'Vel', NULL, 1174.27, 171, 0, 2, 8, '2024-08-26 02:05:58', 13, '2025-03-31 03:02:50'),
(206, 3777, 'Eligendi eaque', 'Dolore ad laborum', 821.69, 186, 0, 10, 1, '2024-10-05 20:39:28', NULL, '2024-09-12 22:35:48'),
(207, 934, 'Odit soluta', 'Saepe suscipit', 713.16, 157, 1, 7, 15, '2024-09-22 00:58:33', 1, '2024-07-06 19:27:54'),
(208, 2033, 'Dolorem', NULL, 990.02, 90, 0, 5, 12, '2024-07-20 18:30:49', NULL, NULL),
(209, 4802, 'Neque assumenda', 'Sit nesciunt facere earum facere culpa', 1076.33, 81, 0, 4, 6, '2025-03-04 08:14:34', NULL, NULL),
(210, 3250, 'Dicta', NULL, 720.21, 42, 1, 0, 14, '2024-07-03 03:30:44', NULL, NULL),
(211, 4958, 'Explicabo', NULL, 1198.69, 91, 0, 3, 11, '2025-03-09 08:46:16', NULL, '2025-04-18 17:12:42'),
(212, 8168, 'Unde', NULL, 1020.12, 85, 0, 5, 4, '2024-04-27 05:09:06', NULL, NULL),
(213, 3976, 'Voluptates', 'Delectus eaque modi non', 1235.65, 93, 0, 9, 0, '2025-01-20 10:09:07', 7, '2024-10-24 03:17:32'),
(214, 7743, 'Molestias', 'Quas sint modi ipsam animi', 865.51, 199, 0, 7, 13, '2024-09-25 06:46:41', NULL, NULL),
(215, 8343, 'Accusantium', NULL, 1168.79, 199, 0, 8, 1, '2024-11-19 16:05:03', 10, '2025-01-13 07:07:05'),
(216, 3, 'Quasi et animi', NULL, 1218.76, 124, 0, 8, 6, '2025-02-11 18:38:27', NULL, NULL),
(217, 7774, 'Dolorem harum', 'Blanditiis error dignissimos consectetur dicta deserunt', 354.45, 10, 0, 10, 11, '2025-03-06 05:07:35', NULL, NULL),
(218, 1773, 'Adipisci', NULL, 1253.12, 116, 1, 9, 6, '2024-07-12 05:46:09', NULL, NULL),
(219, 8262, 'Inventore laborum', 'Quaerat repellat architecto', 174.98, 141, 1, 4, 10, '2024-05-07 21:38:45', 4, '2024-12-10 12:30:53'),
(220, 1293, 'Et unde', 'Modi iure autem in dolorem', 612.13, 83, 0, 6, 13, '2024-10-14 14:32:56', NULL, NULL),
(221, 8462, 'Non', 'Expedita explicabo deleniti animi vel', 78.25, 109, 0, 3, 0, '2024-12-24 22:02:49', NULL, NULL),
(222, 4218, 'Delectus sed', NULL, 218.08, 20, 0, 2, 13, '2024-11-29 13:51:12', 2, '2024-10-31 16:53:59'),
(223, 9692, 'Suscipit eum', NULL, 1251.71, 130, 0, 8, 10, '2024-06-01 02:25:05', 1, '2025-02-27 00:59:26'),
(224, 4393, 'Rerum', NULL, 105.26, 134, 0, 3, 10, '2024-08-27 15:14:13', 6, '2025-03-03 16:44:02'),
(225, 4171, 'Velit hic', 'Incidunt non', 123.68, 8, 0, 0, 14, '2025-03-15 11:52:56', NULL, NULL),
(226, 3254, 'Totam odio', NULL, 24.82, 116, 1, 1, 10, '2024-11-04 16:15:13', NULL, NULL),
(227, 174, 'Laborum quia', 'Vitae debitis voluptatibus', 1327.09, 1, 1, 6, 0, '2024-12-24 02:16:27', 9, '2025-01-11 17:46:01'),
(228, 4734, 'Odit unde', NULL, 1131.44, 138, 1, 5, 0, '2025-01-18 11:50:02', 2, '2024-11-17 14:01:48'),
(229, 9312, 'Reiciendis', 'Pariatur doloribus repudiandae atque', 588.33, 150, 0, 10, 10, '2024-08-04 11:40:04', NULL, NULL),
(230, 3944, 'Unde ipsa occaecati', NULL, 423.46, 18, 1, 7, 2, '2024-07-25 22:18:14', NULL, NULL),
(231, 698, 'Accusamus consequuntur sint', 'Quam magnam', 344.20, 102, 0, 7, 15, '2024-12-27 20:53:33', 2, '2024-10-13 01:25:11'),
(232, 4873, 'Numquam eum neque', 'Commodi eos', 672.14, 91, 1, 7, 4, '2025-01-21 14:24:55', 10, '2024-06-02 09:29:48'),
(233, 7736, 'Delectus', NULL, 816.19, 29, 0, 3, 2, '2024-07-04 20:25:59', NULL, NULL),
(234, 8320, 'Magnam tempore id', 'Odio ullam voluptate', 853.42, 55, 0, 7, 8, '2024-10-01 11:25:50', NULL, NULL),
(235, 28, 'Voluptatum dignissimos', NULL, 1064.16, 170, 0, 9, 14, '2024-10-22 10:09:45', 14, '2025-03-17 11:19:02'),
(236, 7099, 'Ad', 'Beatae pariatur sequi cupiditate', 875.44, 194, 0, 4, 14, '2024-10-02 07:07:44', NULL, NULL),
(237, 763, 'Id eius eaque', 'Repellendus mollitia illo atque voluptatibus maiores', 592.64, 42, 1, 5, 10, '2024-10-07 11:29:51', NULL, NULL),
(238, 5749, 'Reiciendis provident', 'A cum architecto', 1250.29, 20, 1, 2, 4, '2024-10-19 18:43:46', 1, '2024-07-14 13:00:16'),
(239, 9606, 'Laudantium', NULL, 1275.78, 150, 0, 10, 6, '2024-07-29 00:52:53', NULL, NULL),
(240, 1730, 'Dolores asperiores', NULL, 396.18, 48, 0, 2, 5, '2025-04-07 19:34:07', NULL, NULL),
(241, 6807, 'Harum tenetur', NULL, 200.84, 120, 1, 8, 5, '2024-05-22 21:36:46', 12, '2025-02-10 06:40:10'),
(242, 4585, 'Possimus provident', 'In at sed', 119.50, 185, 0, 8, 15, '2024-07-04 12:43:12', 12, '2024-08-26 22:47:01'),
(243, 3270, 'Asperiores cupiditate', 'Cumque a', 646.61, 26, 1, 3, 11, '2025-04-13 00:47:12', NULL, NULL),
(244, 225, 'Eius ducimus', 'Esse optio adipisci', 872.40, 136, 0, 5, 13, '2025-01-28 16:23:44', NULL, NULL),
(245, 4300, 'Aliquam', 'Sequi sequi esse pariatur', 207.49, 7, 0, 8, 0, '2024-06-22 07:49:56', NULL, NULL),
(246, 7915, 'Aliquam in ab', NULL, 48.60, 66, 0, 6, 8, '2025-02-18 14:27:51', NULL, NULL),
(247, 5019, 'Aliquam', NULL, 1163.31, 86, 0, 7, 12, '2025-03-30 14:02:34', NULL, NULL),
(248, 1717, 'Deserunt', NULL, 903.55, 189, 1, 1, 10, '2025-03-31 23:18:06', 11, '2025-01-27 08:27:15'),
(249, 166, 'Magnam numquam', NULL, 376.99, 127, 0, 8, 1, '2024-09-05 17:32:06', 3, '2024-11-21 06:12:21'),
(250, 6015, 'Aspernatur', NULL, 674.12, 115, 0, 10, 9, '2024-05-17 09:02:14', 1, '2024-04-25 01:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` int(2) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `level`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Glauco', 'teste@teste.com', 1, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2025-04-22 21:48:33', NULL),
(2, 'Roy', 'rsapey0@miibeian.gov.cn', 3, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-10-08 03:24:51', '2024-08-07 01:30:12'),
(3, 'Dione', 'dhurne1@miibeian.gov.cn', 3, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2025-01-06 01:09:23', '2024-09-12 05:17:03'),
(4, 'Panchito', 'pstickney2@cargocollective.com', 1, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-11-19 06:29:37', '2024-09-15 16:52:06'),
(5, 'Vonny', 'vdosedale3@shutterfly.com', 2, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2025-03-08 17:22:11', '2024-10-17 14:55:32'),
(6, 'Angeline', 'anapoleone4@baidu.com', 2, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-10-01 08:24:54', '2025-02-20 22:07:34'),
(7, 'Marietta', 'mfermoy5@state.tx.us', 3, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2025-03-02 12:05:14', '2025-02-02 18:27:34'),
(8, 'Leanor', 'learwaker6@cafepress.com', 3, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-07-21 11:33:31', '2024-09-23 11:41:29'),
(9, 'Ashia', 'aseman7@amazon.de', 2, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2025-03-21 03:03:55', '2024-08-07 09:53:02'),
(10, 'Boycie', 'bvarlow8@blinklist.com', 2, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-08-03 18:37:53', '2024-08-08 01:20:13'),
(11, 'Minnie', 'mham9@addthis.com', 1, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-06-18 12:06:53', '2024-06-12 06:10:42'),
(12, 'Griffith', 'gkobierskia@phpbb.com', 1, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-08-19 09:57:58', '2024-08-23 09:01:12'),
(13, 'Karin', 'kmowsonb@nbcnews.com', 3, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2025-01-26 10:02:11', '2024-10-26 10:09:43'),
(14, 'Matty', 'mjosskowitzc@networksolutions.com', 1, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-10-15 02:21:23', '2025-01-19 23:48:23'),
(15, 'Penny', 'pdabneyd@mozilla.org', 2, '$2y$10$nRR3uom9Xhx0e1uWvw5LnuiQluzLdpwzq8MbM/IboOVxAP6lU2xWq', '2024-10-18 10:42:45', '2024-10-03 22:18:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productcode` (`productcode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
