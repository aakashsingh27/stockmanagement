-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2023 at 06:00 PM
-- Server version: 8.0.34
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sabredge_stock_managment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_product`
--

CREATE TABLE `assign_product` (
  `id` int NOT NULL,
  `assign_user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `created_by` int NOT NULL,
  `status` int NOT NULL COMMENT '1 for assign and 2 for sold',
  `added_on` datetime DEFAULT NULL,
  `price_product_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assign_product`
--

INSERT INTO `assign_product` (`id`, `assign_user_id`, `product_id`, `qty`, `created_by`, `status`, `added_on`, `price_product_id`) VALUES
(5, 11, 2, 15, 1, 1, '2023-08-11 12:16:36', 250),
(6, 12, 2, 10, 1, 1, '2023-08-11 12:16:53', 250),
(7, 12, 3, 3, 1, 1, '2023-08-11 12:55:56', 530),
(8, 11, 3, 5, 1, 1, '2023-08-11 12:56:17', 250),
(9, 12, 2, 5, 11, 1, '2023-08-16 12:33:34', 250),
(10, 11, 2, -5, 1, 2, '2023-08-16 00:00:00', 250),
(11, 11, 2, -3, 1, 2, '2023-08-16 00:00:00', 250),
(12, 11, 2, -1, 1, 2, '2023-08-16 01:55:51', 250),
(13, 11, 3, 20, 1, 1, '2023-08-16 16:58:26', 530),
(14, 11, 4, 10, 1, 1, '2023-08-16 16:59:17', 540),
(15, 11, 3, -10, 1, 2, '2023-08-16 16:59:58', 250),
(16, 11, 4, -1, 1, 2, '2023-08-16 16:59:58', 540),
(17, 11, 3, -10, 1, 2, '2023-08-16 17:04:37', 250),
(18, 11, 4, -1, 1, 2, '2023-08-16 17:04:37', 540),
(19, 2, 6, 100, 1, 1, '2023-08-21 18:47:21', 50),
(20, 14, 8, 20, 1, 1, '2023-08-26 15:41:03', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `assign_product_to_user`
--

CREATE TABLE `assign_product_to_user` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `assigned_to` int DEFAULT NULL COMMENT 'This field is contain user id of the assigned person',
  `assign_by` int DEFAULT NULL,
  `assign_date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buclet_sell`
--

CREATE TABLE `buclet_sell` (
  `id` int NOT NULL,
  `bucket_id` int NOT NULL,
  `selled_user_id` int NOT NULL,
  `qty` int NOT NULL,
  `created_by` int NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buclet_sell`
--

INSERT INTO `buclet_sell` (`id`, `bucket_id`, `selled_user_id`, `qty`, `created_by`, `added_on`) VALUES
(2, 4, 7, 1, 1, '2023-08-07 11:16:24'),
(3, 4, 7, 1, 1, '2023-08-07 12:56:38'),
(4, 4, 7, 1, 1, '2023-08-07 18:45:59'),
(5, 4, 7, 1, 1, '2023-08-09 13:27:51'),
(6, 4, 7, 2, 1, '2023-08-16 16:31:39'),
(7, 4, 10, 1, 1, '2023-08-16 16:33:24'),
(8, 4, 8, 1, 1, '2023-08-16 16:35:48'),
(9, 4, 7, 1, 1, '2023-08-16 16:42:12'),
(10, 4, 7, 1, 11, '2023-08-16 16:59:58'),
(11, 4, 7, 1, 11, '2023-08-16 17:04:37'),
(12, 7, 14, 1, 1, '2023-08-26 15:50:53'),
(13, 5, 7, 1, 1, '2023-08-31 14:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_by_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_by_id`, `created_by_name`, `date_time`) VALUES
(1, 'Books', '1', 'Admin', '2023-07-21 13:12:53'),
(2, 'Abacus', '1', 'Admin', '2023-07-21 13:15:01'),
(3, 'JKA Advance', '1', 'Admin', '2023-07-21 13:43:29'),
(4, 'pamplates', '1', 'Admin', '2023-08-21 18:35:15'),
(5, 'dvfgn', '1', 'Admin', '2023-08-24 18:17:05'),
(6, 'Jewellary', '1', 'Admin', '2023-08-26 15:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `default_price`
--

CREATE TABLE `default_price` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `added_by` int NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `default_price`
--

INSERT INTO `default_price` (`id`, `product_id`, `price`, `added_by`, `added_on`) VALUES
(7, 4, 33, 1, '2023-08-01 17:42:34'),
(8, 3, 250, 1, '2023-08-01 17:42:58'),
(9, 5, 780, 1, '2023-08-01 17:43:11'),
(10, 2, 45, 1, '2023-08-01 17:43:20'),
(11, 6, 50, 1, '2023-08-21 18:38:14'),
(12, 8, 100000, 1, '2023-08-26 15:22:37'),
(13, 7, 540, 1, '2023-08-29 12:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `unit_id` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `category_id`, `unit_id`, `status`, `created_by`, `added_on`) VALUES
(2, 'jaw basic', 1, 4, 'enable', 1, '2023-07-24 11:17:54'),
(3, 'JIgsaw advance abacus', 1, 4, 'enable', 1, '2023-07-25 10:53:19'),
(4, 'jigsaw kinder abacus', 1, 4, 'enable', 1, '2023-07-25 10:54:17'),
(5, 'jigsaw module', 1, 4, 'enable', 1, '2023-07-25 10:55:08'),
(6, 'jigsaw module3', 1, 4, 'enable', 1, '2023-08-21 18:37:42'),
(7, 'jigsaw module4', 1, 4, 'enable', 1, '2023-08-24 18:26:38'),
(8, 'Diamon Ring', 6, 9, 'enable', 1, '2023-08-26 15:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_bucket`
--

CREATE TABLE `product_bucket` (
  `id` int NOT NULL,
  `product_id` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `product_qty` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `bucket_name` varchar(255) DEFAULT NULL,
  `added_by` int DEFAULT NULL,
  `created_date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_bucket`
--

INSERT INTO `product_bucket` (`id`, `product_id`, `product_qty`, `bucket_name`, `added_by`, `created_date_time`) VALUES
(5, '5 ,6', '2 ,3', 'regular kit', 1, '2023-08-21 18:40:20'),
(6, '', '', 'sdfg', 1, '2023-08-24 18:34:00'),
(8, '2 ,3', '1 ,2', 'vishk', 1, '2023-08-29 15:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_sale`
--

CREATE TABLE `product_sale` (
  `id` int NOT NULL,
  `discount` float(65,2) DEFAULT NULL COMMENT 'Discount',
  `sub_total` float(65,2) DEFAULT NULL COMMENT 'Subtotal',
  `product_id` int DEFAULT NULL COMMENT 'product id',
  `quantity` int DEFAULT NULL COMMENT 'quantity',
  `sale_by_id` int DEFAULT NULL COMMENT 'jo sale kar rha h uski id ',
  `sale_to_id` int DEFAULT NULL COMMENT 'jisko sale hua hai uski id',
  `sale_date_time` date DEFAULT NULL COMMENT 'date of sale',
  `price` float(65,2) DEFAULT NULL COMMENT 'price',
  `invoice_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_sale`
--

INSERT INTO `product_sale` (`id`, `discount`, `sub_total`, `product_id`, `quantity`, `sale_by_id`, `sale_to_id`, `sale_date_time`, `price`, `invoice_number`) VALUES
(10, 1.00, 990.00, 2, 25, 1, 7, '2023-08-05', 40.00, 'JGSW70279'),
(11, 0.00, 165.00, 4, 5, 1, 7, '2023-08-05', 33.00, 'JGSW70279'),
(12, 0.00, 250.00, 3, 1, 1, 7, '2023-08-09', 250.00, 'BJGSW.55203'),
(13, 0.00, 33.00, 4, 1, 1, 7, '2023-08-09', 33.00, 'BJGSW.55203'),
(14, 0.00, 200.00, 2, 5, 11, 7, '2023-08-16', 40.00, 'JGSW56066'),
(15, 0.00, 120.00, 2, 3, 11, 7, '2023-08-16', 40.00, 'JGSW97500'),
(16, 0.00, 40.00, 2, 1, 11, 7, '2023-08-16', 40.00, 'JGSW35538'),
(17, 0.00, 500.00, 3, 2, 1, 7, '2023-08-16', 250.00, 'BJGSW.98058'),
(18, 0.00, 66.00, 4, 2, 1, 7, '2023-08-16', 33.00, 'BJGSW.98058'),
(19, 0.00, 250.00, 3, 1, 1, 10, '2023-08-16', 250.00, 'BJGSW43866'),
(20, 0.00, 33.00, 4, 1, 1, 10, '2023-08-16', 33.00, 'BJGSW43866'),
(21, 0.00, 250.00, 3, 1, 1, 8, '2023-08-16', 250.00, 'BJGSW75081'),
(22, 0.00, 33.00, 4, 1, 1, 8, '2023-08-16', 33.00, 'BJGSW75081'),
(23, 0.00, 250.00, 3, 10, 1, 7, '2023-08-16', 250.00, 'BJGSW6002'),
(24, 0.00, 33.00, 4, 1, 1, 7, '2023-08-16', 33.00, 'BJGSW6002'),
(25, 0.00, 250.00, 3, 10, 11, 7, '2023-08-16', 250.00, 'BJGSW87989'),
(26, 0.00, 33.00, 4, 1, 11, 7, '2023-08-16', 33.00, 'BJGSW87989'),
(27, 0.00, 250.00, 3, 10, 11, 7, '2023-08-16', 250.00, 'BJGSW13790'),
(28, 0.00, 33.00, 4, 1, 11, 7, '2023-08-16', 33.00, 'BJGSW13790'),
(29, 5.00, 190000.00, 8, 2, 1, 10, '2023-08-26', 100000.00, 'JGSW92974'),
(30, 6.00, 385.00, 2, 10, 1, 10, '2023-08-26', 41.00, 'JGSW92974'),
(31, 0.00, 40.00, 2, 1, 1, 14, '2023-08-26', 40.00, 'BJGSW21343'),
(32, 0.00, 250.00, 3, 1, 1, 14, '2023-08-26', 250.00, 'BJGSW21343'),
(33, 0.00, 100000.00, 8, 1, 1, 14, '2023-08-26', 100000.00, 'BJGSW21343'),
(34, 1.00, 49.50, 3, 2, 1, 7, '2023-08-29', 25.00, 'JGSW32310'),
(35, 0.00, 45.00, 2, 1, 1, 7, '2023-08-31', 45.00, 'JGSW1689120230831'),
(36, 0.00, 780.00, 5, 2, 1, 7, '2023-08-31', 780.00, 'BJGSW9877020230831'),
(37, 0.00, 50.00, 6, 3, 1, 7, '2023-08-31', 50.00, 'BJGSW9877020230831');

-- --------------------------------------------------------

--
-- Table structure for table `roles_and_permission`
--

CREATE TABLE `roles_and_permission` (
  `id` int NOT NULL,
  `roles_name` varchar(255) DEFAULT NULL,
  `permissions` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `added_by` int DEFAULT NULL,
  `created_date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles_and_permission`
--

INSERT INTO `roles_and_permission` (`id`, `roles_name`, `permissions`, `added_by`, `created_date_time`) VALUES
(1, 'Accountants', 'view_user ,view_quantity ,check_quantity ,view_role', 2, '2023-08-10 12:19:44'),
(2, 'Vishal', 'view_role ,add_role ,edit_role ,delete_role ,view_user ,add_user ,edit_user ,delete_user ,view_unit ,add_unit ,edit_unit ,delete_unit ,check_quantityview_role ,add_role ,edit_role ,delete_role ,view_...', 1, '2023-07-26 16:55:23'),
(3, 'Dinesh', 'view_user ,add_user ,edit_user ,delete_user', 1, '2023-07-26 16:28:59'),
(4, 'customer', '', 1, '2023-07-28 13:08:22'),
(5, 'Admin', 'view_role ,add_role ,edit_role ,delete_role ,view_user ,add_user ,edit_user ,delete_user ,view_category ,add_category ,edit_category ,delete_category ,view_unit ,add_unit ,edit_unit ,delete_unit ,view_vendor ,add_vendor ,edit_vendor ,delete_vendor ,view_product ,add_product ,edit_product ,delete_product ,view_quantity ,add_quantity ,edit_quantity ,delete_quantity ,view_bucket ,add_bucket ,edit_bucket ,delete_bucket ,view_product_sale_price ,add_product_sale_price ,edit_product_sale_price ,view_assign_product ,assign_product ,unassign_product ,view_sale_product ,sales_product ,sales_bucket ,view_basic_price ,add_basic_price ,edit_basic_price ,check_quantity', 1, '2023-08-28 13:58:49'),
(6, 'Checker', 'view_product ,view_assign_product ,assign_product ,unassign_product ,view_sale_product ,sales_product ,sales_bucket', 1, '2023-08-17 13:16:13'),
(7, 'chetan', 'view_user', 1, '2023-08-21 18:29:38'),
(8, 'sdfghj', '', 1, '2023-08-24 18:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `set_product_price`
--

CREATE TABLE `set_product_price` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `price` float(65,2) DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `assign_by_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `set_product_price`
--

INSERT INTO `set_product_price` (`id`, `product_id`, `price`, `customer_id`, `assign_by_id`) VALUES
(1, 3, 25.00, 7, 1),
(2, 5, 81.00, 7, 1),
(3, 4, 455.00, 9, 1),
(4, 3, 540.00, 8, 1),
(5, 2, 41.00, 10, 1),
(6, 6, 60.00, 7, 1),
(7, 8, 150000.00, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_quantity`
--

CREATE TABLE `stock_quantity` (
  `id` int NOT NULL,
  `sale_to_id` int DEFAULT NULL COMMENT 'THis field is fill when any product is sale otherwise it is blank',
  `sale_by_id` int DEFAULT NULL COMMENT 'THis field is fill when any product is sale otherwise it is blank	',
  `vendor_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `per_product_price` float(65,2) DEFAULT NULL,
  `add_by_user_id` int DEFAULT NULL,
  `added_on_date` date DEFAULT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_quantity`
--

INSERT INTO `stock_quantity` (`id`, `sale_to_id`, `sale_by_id`, `vendor_id`, `product_id`, `per_product_price`, `add_by_user_id`, `added_on_date`, `quantity`) VALUES
(15, NULL, NULL, 5, 2, 250.00, 1, '2023-08-05', 140),
(16, NULL, NULL, 3, 3, 530.00, 1, '2023-08-05', 153),
(17, NULL, NULL, 1, 4, 540.00, 1, '2023-08-05', 52),
(18, NULL, NULL, 1, 5, 85.00, 1, '2023-08-05', 65),
(19, 7, 1, NULL, 2, NULL, NULL, '2023-08-05', -25),
(20, 7, 1, NULL, 4, NULL, NULL, '2023-08-05', -5),
(21, 7, 1, NULL, 3, 250.00, NULL, '2023-08-09', -1),
(22, 7, 1, NULL, 4, 33.00, NULL, '2023-08-09', -1),
(23, 7, 11, NULL, 2, NULL, NULL, '2023-08-16', -5),
(24, 7, 11, NULL, 2, NULL, NULL, '2023-08-16', -3),
(25, 7, 11, NULL, 2, NULL, NULL, '2023-08-16', -1),
(26, 7, 1, NULL, 3, 250.00, NULL, '2023-08-16', -2),
(27, 7, 1, NULL, 4, 33.00, NULL, '2023-08-16', -2),
(28, 10, 1, NULL, 3, 250.00, NULL, '2023-08-16', -1),
(29, 10, 1, NULL, 4, 33.00, NULL, '2023-08-16', -1),
(30, 8, 1, NULL, 3, 250.00, NULL, '2023-08-16', -1),
(31, 8, 1, NULL, 4, 33.00, NULL, '2023-08-16', -1),
(32, 7, 1, NULL, 3, 250.00, NULL, '2023-08-16', -10),
(33, 7, 1, NULL, 4, 33.00, NULL, '2023-08-16', -1),
(34, 7, 11, NULL, 3, 250.00, NULL, '2023-08-16', -10),
(35, 7, 11, NULL, 4, 33.00, NULL, '2023-08-16', -1),
(36, 7, 11, NULL, 3, 250.00, NULL, '2023-08-16', -10),
(37, 7, 11, NULL, 4, 33.00, NULL, '2023-08-16', -1),
(38, NULL, NULL, 5, 6, 50.00, 1, '2023-08-21', 1000),
(39, NULL, NULL, 7, 8, 200000.00, 1, '2023-08-26', 500),
(40, 10, 1, NULL, 8, NULL, NULL, '2023-08-26', -2),
(41, 10, 1, NULL, 2, NULL, NULL, '2023-08-26', -10),
(42, 14, 1, NULL, 2, 40.00, NULL, '2023-08-26', -1),
(43, 14, 1, NULL, 3, 250.00, NULL, '2023-08-26', -1),
(44, 14, 1, NULL, 8, 100000.00, NULL, '2023-08-26', -1),
(45, NULL, NULL, 1, 3, 100.00, 1, '2023-08-28', 1),
(46, 7, 1, NULL, 3, NULL, NULL, '2023-08-29', -2),
(47, 7, 1, NULL, 2, NULL, NULL, '2023-08-31', -1),
(48, 7, 1, NULL, 5, 780.00, NULL, '2023-08-31', -2),
(49, 7, 1, NULL, 6, 50.00, NULL, '2023-08-31', -3);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_by_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `created_by_id`, `created_by_name`, `date_time`) VALUES
(4, 'Kg', '1', 'Admin', '2023-07-21 14:15:40'),
(5, 'meters', '1', 'Admin', '2023-07-21 14:15:57'),
(6, 'cm', '1', 'Admin', '2023-07-21 15:07:36'),
(7, 'Pieces', '1', 'Admin', '2023-07-25 10:52:46'),
(9, 'gram', '1', 'Admin', '2023-08-26 15:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `without_md5_pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `company`, `contact`, `address`, `username`, `password`, `without_md5_pwd`, `role_id`, `created_by`, `status`, `added_on`) VALUES
(1, 'Admin', NULL, '', '', 'admin', 'e9510081ac30ffa83f10b68cde1cac07', '6666', 5, '', 'enable', '2023-07-21 12:07:17'),
(2, 'rahul singh', 'sabre', '99999', 'address', 'rahul@123', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 1, '1', 'enable', '2023-07-21 13:39:27'),
(3, 'vanshika raheja', NULL, '', '', 'webdeveloper@jigsaw.edu.in', '81dc9bdb52d04dc20036dbd8313ed055', '1234', NULL, '1', 'enable', '2023-07-21 13:40:54'),
(5, 'eeeeeeeee', 'ggg', '8888888888', 'address', 'golu@gmail.com', 'ecd4bde5ff2cba0d3655118404ffa135', '289273', 3, '1', 'enable', '2023-07-26 16:09:42'),
(6, 'golt', 'golu', '89898989', 'address', 'kk', '2a38a4a9316c49e5a833517c45d31070', '88', 3, '1', 'disable', '2023-07-27 11:38:39'),
(7, 'radhika mam', 'golden bells', '999999999', 'address', 'radhika123', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 4, '1', 'enable', '2023-07-27 11:50:13'),
(8, 'Vikram Goyal', 'Glorious public school', '8745784510', 'Tilak nagar near tilak nagar main market', 'Vikramgoyal2233@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 4, '1', 'disable', '2023-07-31 11:20:25'),
(9, 'Saurabh Ahuja', 'Mount Abu public school', '7412548785', 'Sec 16 rohini delhi 110086', 'saurabhahuja@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 4, '1', 'enable', '2023-07-31 11:21:48'),
(10, 'Ashok kumar', 'Indraprastha public school', '8541002548', 'SECTOR 22 Rohini delhi 110086', 'ashokkumar.ippps.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 4, '1', 'enable', '2023-07-31 11:23:58'),
(11, 'Demo2', 'sabredge', '7410852963', 'Delhi', 'demo2', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 6, '1', 'enable', '2023-08-11 12:15:35'),
(12, 'Demo3', 'sabredge', '7410852963', 'Delhi', 'demo3', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 6, '1', 'enable', '2023-08-11 12:15:54'),
(13, 'Yash', 'jigsaw', '7878747847', 'Delhi', 'yash77', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 7, '1', 'enable', '2023-08-21 18:33:21'),
(14, 'Dinesh', '', '2342342343', 'xyz', 'dinesh', '9c9f1c65b1dc1f79498c9f09eb610e1a', 'dinesh', 3, '1', 'enable', '2023-08-24 18:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `venders`
--

CREATE TABLE `venders` (
  `id` int NOT NULL,
  `company` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `venders`
--

INSERT INTO `venders` (`id`, `company`, `name`, `phone`, `email`, `address`, `created_by`, `status`, `added_on`) VALUES
(1, 'sabre', 'rahul', '2222222222', 'admin@gmail.com', 'd', 1, 'enable', '2023-07-22 11:21:04'),
(3, 'jigsaw', 'Aakash', '234567897', 'admin@gmail.com', 'address', 1, 'enable', '2023-07-24 10:54:03'),
(4, 'sabre', 'ww', '11', 'sadmin@gmail.com', 'add', 1, 'enable', '2023-08-10 15:59:20'),
(5, 'balaji ad print', 'Balaji', '7777777777', 'blala@gmail.com', 'Pitampura', 1, 'enable', '2023-08-21 18:36:44'),
(7, 'jigsaw	', 'dinesh', '234234233', 'dinesh@gmail.com', 'dfhskdhf', 1, 'enable', '2023-08-24 18:25:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_product`
--
ALTER TABLE `assign_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_product_to_user`
--
ALTER TABLE `assign_product_to_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buclet_sell`
--
ALTER TABLE `buclet_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_price`
--
ALTER TABLE `default_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_bucket`
--
ALTER TABLE `product_bucket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sale`
--
ALTER TABLE `product_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_and_permission`
--
ALTER TABLE `roles_and_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_product_price`
--
ALTER TABLE `set_product_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_quantity`
--
ALTER TABLE `stock_quantity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venders`
--
ALTER TABLE `venders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_product`
--
ALTER TABLE `assign_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assign_product_to_user`
--
ALTER TABLE `assign_product_to_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buclet_sell`
--
ALTER TABLE `buclet_sell`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `default_price`
--
ALTER TABLE `default_price`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_bucket`
--
ALTER TABLE `product_bucket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_sale`
--
ALTER TABLE `product_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `roles_and_permission`
--
ALTER TABLE `roles_and_permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `set_product_price`
--
ALTER TABLE `set_product_price`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_quantity`
--
ALTER TABLE `stock_quantity`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `venders`
--
ALTER TABLE `venders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
