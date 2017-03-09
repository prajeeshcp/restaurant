-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2017 at 09:44 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `entity_id` int(10) UNSIGNED NOT NULL COMMENT 'Attribute Id',
  `attribute_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Attribute Name',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`entity_id`, `attribute_name`, `status`) VALUES
(1, 'None', 1),
(2, 'veg', 1),
(3, 'non-veg', 2),
(4, 'New Attributes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_entity`
--

CREATE TABLE `bill_entity` (
  `entity_id` int(10) UNSIGNED NOT NULL COMMENT 'Entity Id',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  `order_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Order Id',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'User Id',
  `increment_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Increment Id',
  `grand_total` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Grand Total',
  `subtotal` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Sub Total',
  `tax_amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Tax Amount',
  `total_paid` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Total Paid',
  `discount_amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Discount Amount',
  `delivery_charge` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Delivery Charge',
  `total_qty_ordered` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Total Qty Ordered',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_entity`
--

INSERT INTO `bill_entity` (`entity_id`, `status`, `order_id`, `user_id`, `increment_id`, `grand_total`, `subtotal`, `tax_amount`, `total_paid`, `discount_amount`, `delivery_charge`, `total_qty_ordered`, `created_at`, `updated_at`) VALUES
(7, 'closed', 81, 8, '10001', '1500.00', '1492.54', '7.46', '1500.00', '0.00', '0.00', 3, '2017-03-09 19:59:37', '2017-03-09 14:29:37'),
(8, 'closed', 82, 8, '10002', '760.00', '757.51', '2.49', '760.00', '0.00', '0.00', 4, '2017-03-09 20:02:38', '2017-03-09 14:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `bill_entity_items`
--

CREATE TABLE `bill_entity_items` (
  `item_id` int(10) UNSIGNED NOT NULL COMMENT 'Item Id',
  `bill_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Bill Id',
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Menu Id',
  `order_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Order Type',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name',
  `qty_ordered` int(10) UNSIGNED NOT NULL COMMENT 'Qty Ordered',
  `price` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Price',
  `tax_percent` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Tax Percent',
  `tax_amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Tax Amount',
  `row_total` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Row Total',
  `price_incld_tax` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Price Include Tax',
  `row_total_incld_tax` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Row total Include tax',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_entity_items`
--

INSERT INTO `bill_entity_items` (`item_id`, `bill_id`, `menu_id`, `order_type`, `name`, `qty_ordered`, `price`, `tax_percent`, `tax_amount`, `row_total`, `price_incld_tax`, `row_total_incld_tax`, `created_at`, `updated_at`) VALUES
(6, 7, 2, 'undefined', 'Second menu edit (Normal)', 3, '497.51', '0.50', '7.46', '1492.54', '500.00', '1500.00', '2017-03-09 19:59:37', '2017-03-09 14:29:37'),
(7, 8, 1, 'undefined', 'First Menu Edit (Normal)', 1, '10.00', '0.00', '0.00', '10.00', '10.00', '10.00', '2017-03-09 20:02:38', '2017-03-09 14:32:38'),
(8, 8, 4, 'undefined', 'First Menu (Normal)', 1, '150.00', '0.00', '0.00', '150.00', '150.00', '150.00', '2017-03-09 20:02:38', '2017-03-09 14:32:38'),
(9, 8, 3, 'undefined', 'New menu (Normal)', 1, '100.00', '0.00', '0.00', '100.00', '100.00', '100.00', '2017-03-09 20:02:38', '2017-03-09 14:32:38'),
(10, 8, 2, 'undefined', 'Second menu edit (Normal)', 1, '497.51', '0.50', '2.49', '497.51', '500.00', '500.00', '2017-03-09 20:02:38', '2017-03-09 14:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `category_entity`
--

CREATE TABLE `category_entity` (
  `entity_id` int(10) UNSIGNED NOT NULL COMMENT 'Category Id',
  `attribute_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Attribute Id',
  `entity_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Category Name',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Updated At',
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_entity`
--

INSERT INTO `category_entity` (`entity_id`, `attribute_id`, `entity_name`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'Default Category', '0000-00-00 00:00:00', '2017-02-15 12:04:36', 1),
(2, 4, 'North Indian Thali', '2017-02-14 19:55:19', '2017-02-21 13:37:20', 1),
(3, 2, 'Ice cream', '2017-02-21 19:07:34', '2017-02-24 06:18:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'cashier', 'Cashier'),
(3, 'waiter', 'Waiter');

-- --------------------------------------------------------

--
-- Table structure for table `kot_entity`
--

CREATE TABLE `kot_entity` (
  `entity_id` int(10) UNSIGNED NOT NULL COMMENT 'Entity Id',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  `table_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Table Id',
  `order_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Order Id',
  `increment_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Increment Id',
  `qty_ordered` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'QTY Ordered',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `Updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kot_entity`
--

INSERT INTO `kot_entity` (`entity_id`, `status`, `table_id`, `order_id`, `increment_id`, `qty_ordered`, `created_at`, `Updated_at`) VALUES
(77, 'complete', 3, 81, '10001', '3.00', '2017-03-09 19:55:44', '2017-03-09 14:29:07'),
(78, 'complete', 2, 82, '10002', '4.00', '2017-03-09 20:02:00', '2017-03-09 14:32:24'),
(79, 'processing', 3, 83, '10003', '1.00', '2017-03-09 20:07:24', '2017-03-09 14:38:18'),
(80, 'processing', 3, 84, '10004', '2.00', '2017-03-09 20:08:36', '2017-03-09 14:55:05'),
(81, 'processing', 3, 85, '10005', '1.00', '2017-03-09 20:12:56', '2017-03-09 14:42:59'),
(82, 'processing', 3, 86, '10006', '2.00', '2017-03-09 20:13:44', '2017-03-09 14:53:48'),
(83, 'pending', 3, 87, '10007', '0.00', '2017-03-09 20:27:21', '2017-03-09 14:57:21'),
(84, 'pending', 3, 88, '10008', '0.00', '2017-03-09 20:27:26', '2017-03-09 14:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `kot_entity_items`
--

CREATE TABLE `kot_entity_items` (
  `item_id` int(10) UNSIGNED NOT NULL COMMENT 'Item Id',
  `kot_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'KOT ID',
  `is_kot` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'is KOT genarated',
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Menu Id',
  `order_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Order Type',
  `price_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Price Type',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name',
  `qty_ordered` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'QTY Ordered',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kot_entity_items`
--

INSERT INTO `kot_entity_items` (`item_id`, `kot_id`, `is_kot`, `menu_id`, `order_type`, `price_type`, `name`, `qty_ordered`, `created_at`, `updated_at`) VALUES
(88, 77, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '3.00', '2017-03-09 19:55:46', '2017-03-09 14:26:37'),
(89, 78, 1, 1, 'undefined', 1, 'First Menu Edit (Normal)', '1.00', '2017-03-09 20:02:02', '2017-03-09 14:32:09'),
(90, 78, 1, 4, 'undefined', 1, 'First Menu (Normal)', '1.00', '2017-03-09 20:02:04', '2017-03-09 14:32:09'),
(91, 78, 1, 3, 'undefined', 1, 'New menu (Normal)', '1.00', '2017-03-09 20:02:05', '2017-03-09 14:32:09'),
(92, 78, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '2017-03-09 20:02:06', '2017-03-09 14:32:09'),
(93, 79, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '2017-03-09 20:07:26', '2017-03-09 14:38:18'),
(95, 80, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '2017-03-09 20:08:40', '2017-03-09 14:55:05'),
(98, 81, 1, 3, 'undefined', 1, 'New menu (Normal)', '1.00', '2017-03-09 20:12:58', '2017-03-09 14:42:59'),
(100, 82, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '2017-03-09 20:13:46', '2017-03-09 14:53:48'),
(102, 82, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '2017-03-09 20:14:01', '2017-03-09 14:53:48'),
(103, 80, 1, 1, 'undefined', 1, 'First Menu Edit (Normal)', '1.00', '2017-03-09 20:14:40', '2017-03-09 14:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu_entity`
--

CREATE TABLE `menu_entity` (
  `entity_id` int(11) UNSIGNED NOT NULL COMMENT 'Menu Entity Id',
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Category Id',
  `menu_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Manu Name',
  `tax_class` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Tax Class',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ctrated At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_entity`
--

INSERT INTO `menu_entity` (`entity_id`, `category_id`, `menu_name`, `tax_class`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'First Menu Edit', 1, '2017-02-15 15:30:55', '2017-02-24 06:22:40', 1),
(2, 2, 'Second menu edit', 2, '2017-02-15 16:27:47', '2017-02-24 16:06:15', 1),
(3, 2, 'New menu', 1, '2017-02-19 05:56:12', '2017-02-19 06:15:23', 1),
(4, 3, 'First Menu', 0, '2017-02-21 13:37:56', '2017-02-24 16:02:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_entity_ingredients`
--

CREATE TABLE `menu_entity_ingredients` (
  `ingredient_id` int(10) UNSIGNED NOT NULL COMMENT 'Ingredient ID',
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Menu Id',
  `ingredient_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ingredient Name',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_entity_ingredients`
--

INSERT INTO `menu_entity_ingredients` (`ingredient_id`, `menu_id`, `ingredient_name`, `status`) VALUES
(1, 1, 'Rice', 1),
(2, 1, '', 1),
(3, 1, 'Coriyander', 1),
(4, 2, 'Menu Ing 1 ', 1),
(5, 2, 'Menu ing 3', 1),
(6, 2, 'New Ingreadiant', 1),
(7, 2, '1', 1),
(8, 2, '2', 1),
(9, 3, '', 1),
(10, 4, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_entity_price`
--

CREATE TABLE `menu_entity_price` (
  `price_id` int(10) UNSIGNED NOT NULL COMMENT 'Price Id',
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Menu Id',
  `price_type` int(10) NOT NULL DEFAULT '0' COMMENT 'Price Type',
  `price_amount` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Amount'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_entity_price`
--

INSERT INTO `menu_entity_price` (`price_id`, `menu_id`, `price_type`, `price_amount`) VALUES
(1, 3, 1, 100),
(2, 3, 2, 200),
(3, 1, 1, 10),
(4, 1, 2, 5),
(5, 4, 1, 150),
(6, 4, 2, 0),
(7, 2, 1, 500),
(8, 2, 2, 300);

-- --------------------------------------------------------

--
-- Table structure for table `menu_entity_price_type`
--

CREATE TABLE `menu_entity_price_type` (
  `entity_id` int(10) UNSIGNED NOT NULL COMMENT 'Price Type Id',
  `type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Type Name',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_entity_price_type`
--

INSERT INTO `menu_entity_price_type` (`entity_id`, `type_name`, `status`) VALUES
(1, 'Normal', 1),
(2, 'Half ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_entity`
--

CREATE TABLE `order_entity` (
  `entity_id` int(10) UNSIGNED NOT NULL COMMENT 'Order Id',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Order Status',
  `is_bill` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Is Bill 0 is processing, 1 is ready, 2 compleated',
  `table_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Table Id',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'User Id',
  `increment_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Increment Id',
  `grand_total` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Grand Total',
  `subtotal` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Subtotal',
  `tax_amount` float(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Tax Amount',
  `total_paid` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Total Paid',
  `discount_amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Discount Amount',
  `delivery_charge` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Delivery Charge',
  `total_qty_ordered` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Toatal Qty Ordered',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_entity`
--

INSERT INTO `order_entity` (`entity_id`, `status`, `is_bill`, `table_id`, `user_id`, `increment_id`, `grand_total`, `subtotal`, `tax_amount`, `total_paid`, `discount_amount`, `delivery_charge`, `total_qty_ordered`, `created_at`, `updated_at`) VALUES
(81, 'closed', 2, 3, 9, '10001', '1500.00', '1492.54', 7.46, '1500.00', '0.00', '0.00', 3, '2017-03-09 19:55:44', '2017-03-09 18:59:37'),
(82, 'closed', 2, 2, 9, '10002', '760.00', '757.51', 2.49, '760.00', '0.00', '0.00', 4, '2017-03-09 20:02:00', '2017-03-09 19:02:39'),
(83, 'processing', 0, 3, 9, '10003', '500.00', '497.51', 2.49, '0.00', '0.00', '0.00', 1, '2017-03-09 20:07:24', '2017-03-09 14:38:18'),
(84, 'processing', 0, 3, 9, '10004', '510.00', '507.51', 2.49, '0.00', '0.00', '0.00', 2, '2017-03-09 20:08:36', '2017-03-09 14:55:05'),
(85, 'processing', 0, 3, 9, '10005', '100.00', '100.00', 0.00, '0.00', '0.00', '0.00', 1, '2017-03-09 20:12:56', '2017-03-09 14:42:59'),
(86, 'processing', 0, 3, 9, '10006', '1000.00', '995.02', 4.98, '0.00', '0.00', '0.00', 2, '2017-03-09 20:13:44', '2017-03-09 14:53:48'),
(87, 'pending', 0, 3, 9, '10007', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-03-09 20:27:21', '2017-03-09 14:57:21'),
(88, 'pending', 0, 3, 9, '10008', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-03-09 20:27:26', '2017-03-09 14:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_entity_items`
--

CREATE TABLE `order_entity_items` (
  `item_id` int(10) UNSIGNED NOT NULL COMMENT 'Item Id',
  `order_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Order Id',
  `is_kot` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'i for created KOT',
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Menu Item Id',
  `order_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'table' COMMENT 'Type of order like parcel',
  `price_type` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Price Type',
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of Item',
  `qty_ordered` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Qty',
  `price` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Price for single ',
  `tax_percent` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Tax Percent',
  `tax_amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Tax Amount',
  `row_total` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Total Amount',
  `price_incld_tax` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Price Include Tax',
  `row_total_incld_tax` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Row total Include tax',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_entity_items`
--

INSERT INTO `order_entity_items` (`item_id`, `order_id`, `is_kot`, `menu_id`, `order_type`, `price_type`, `name`, `qty_ordered`, `price`, `tax_percent`, `tax_amount`, `row_total`, `price_incld_tax`, `row_total_incld_tax`, `created_at`, `updated_at`) VALUES
(90, 81, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '3.00', '497.51', '0.50', '7.46', '1492.54', '500.00', '1500.00', '2017-03-09 19:55:46', '2017-03-09 14:26:37'),
(91, 82, 1, 1, 'undefined', 1, 'First Menu Edit (Normal)', '1.00', '10.00', '0.00', '0.00', '10.00', '10.00', '10.00', '2017-03-09 20:02:02', '2017-03-09 14:32:09'),
(92, 82, 1, 4, 'undefined', 1, 'First Menu (Normal)', '1.00', '150.00', '0.00', '0.00', '150.00', '150.00', '150.00', '2017-03-09 20:02:04', '2017-03-09 14:32:09'),
(93, 82, 1, 3, 'undefined', 1, 'New menu (Normal)', '1.00', '100.00', '0.00', '0.00', '100.00', '100.00', '100.00', '2017-03-09 20:02:05', '2017-03-09 14:32:09'),
(94, 82, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '497.51', '0.50', '2.49', '497.51', '500.00', '500.00', '2017-03-09 20:02:06', '2017-03-09 14:32:09'),
(95, 83, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '497.51', '0.50', '2.49', '497.51', '500.00', '500.00', '2017-03-09 20:07:26', '2017-03-09 14:38:18'),
(97, 84, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '497.51', '0.50', '2.49', '497.51', '500.00', '500.00', '2017-03-09 20:08:40', '2017-03-09 14:55:05'),
(100, 85, 1, 3, 'undefined', 1, 'New menu (Normal)', '1.00', '100.00', '0.00', '0.00', '100.00', '100.00', '100.00', '2017-03-09 20:12:58', '2017-03-09 14:42:59'),
(102, 86, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '497.51', '0.50', '2.49', '497.51', '500.00', '500.00', '2017-03-09 20:13:46', '2017-03-09 14:53:48'),
(104, 86, 1, 2, 'undefined', 1, 'Second menu edit (Normal)', '1.00', '497.51', '0.50', '2.49', '497.51', '500.00', '500.00', '2017-03-09 20:14:01', '2017-03-09 14:53:48'),
(105, 84, 1, 1, 'undefined', 1, 'First Menu Edit (Normal)', '1.00', '10.00', '0.00', '0.00', '10.00', '10.00', '10.00', '2017-03-09 20:14:40', '2017-03-09 14:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status` varchar(32) NOT NULL COMMENT 'Status',
  `label` varchar(128) NOT NULL COMMENT 'Label'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Order Status Table';

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status`, `label`) VALUES
('canceled', 'Canceled'),
('closed', 'Closed'),
('complete', 'Complete'),
('fraud', 'Suspected Fraud'),
('holded', 'On Hold'),
('payment_review', 'Payment Review'),
('pending', 'Pending'),
('pending_payment', 'Pending Payment'),
('processing', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `table_category`
--

CREATE TABLE `table_category` (
  `id` int(10) NOT NULL,
  `name` varchar(75) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_category`
--

INSERT INTO `table_category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bill desk', 1, '2017-02-21 20:52:11', '2017-02-21 16:22:11'),
(2, 'couples', 1, '2017-02-21 20:52:26', '2017-02-21 16:22:26'),
(3, 'party', 1, '2017-02-21 18:06:09', '2017-02-21 13:36:09'),
(4, 'Lovers Room', 1, '2017-02-21 17:56:21', '2017-02-21 13:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `table_details`
--

CREATE TABLE `table_details` (
  `id` int(10) NOT NULL,
  `table_number` varchar(75) NOT NULL,
  `capacity` int(11) NOT NULL,
  `table_cat_id` int(10) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_details`
--

INSERT INTO `table_details` (`id`, `table_number`, `capacity`, `table_cat_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bill Desk 001', 0, 1, 1, 2017, 2017),
(2, '00001', 6, 3, 1, 2017, 2017),
(3, '00002', 4, 2, 1, 2017, 2017),
(4, '00003', 5, 3, 1, 2017, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `tax_entity`
--

CREATE TABLE `tax_entity` (
  `entity_id` int(10) UNSIGNED NOT NULL COMMENT 'Tax Id',
  `tax_class` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tax Class',
  `tax_rate` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT 'Tax Rate',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tax_entity`
--

INSERT INTO `tax_entity` (`entity_id`, `tax_class`, `tax_rate`, `status`) VALUES
(1, 'None', '0.00', 1),
(2, 'VAT', '0.50', 1),
(3, 'INCOME', '14.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$eFoSZ7WQx7o9Iq5cbDbDeOYyjYCs/FSztxBQUM/vJEJ6iNBCLD7gS', '', 'admin@admin.com', '', NULL, NULL, 'rsiHKaGjhgYtuffqAflwBu', 1268889823, 1489088185, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(8, '', 'haridas', '$2y$08$eFoSZ7WQx7o9Iq5cbDbDeOYyjYCs/FSztxBQUM/vJEJ6iNBCLD7gS', NULL, 'haridas@gmail.com', NULL, NULL, NULL, 'QTz6nH2EDULiwoh4MVoxeO', 1268889823, 1489086154, 1, 'Haridas K', 'Kurup', 'IT', '8904055898'),
(9, '::1', 'ullas', '$2y$08$sL/wunNESizPpYf9VJQ6BeDl54Ezjs5/gMVKVzCEiip8ndlUYJNiu', NULL, 'ullas@gmail.com', NULL, NULL, NULL, 'QIRFOb/yzwoOjBX2XOCa/O', 1488818723, 1489086274, 1, 'Ullas', 'Kodoth', 'Address', '8904055898');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(8, 8, 2),
(9, 9, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `bill_entity`
--
ALTER TABLE `bill_entity`
  ADD PRIMARY KEY (`entity_id`),
  ADD UNIQUE KEY `increment_id` (`increment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `bill_entity_items`
--
ALTER TABLE `bill_entity_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `category_entity`
--
ALTER TABLE `category_entity`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_entity`
--
ALTER TABLE `kot_entity`
  ADD PRIMARY KEY (`entity_id`),
  ADD UNIQUE KEY `increment_id` (`increment_id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `kot_entity_items`
--
ALTER TABLE `kot_entity_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `kot_id` (`kot_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_entity`
--
ALTER TABLE `menu_entity`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `tax_class` (`tax_class`);

--
-- Indexes for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `menu_entity_price`
--
ALTER TABLE `menu_entity_price`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `price_type` (`price_type`);

--
-- Indexes for table `menu_entity_price_type`
--
ALTER TABLE `menu_entity_price_type`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `order_entity`
--
ALTER TABLE `order_entity`
  ADD PRIMARY KEY (`entity_id`),
  ADD UNIQUE KEY `increment_id` (`increment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `order_entity_items`
--
ALTER TABLE `order_entity_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `table_category`
--
ALTER TABLE `table_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_details`
--
ALTER TABLE `table_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_cat_id` (`table_cat_id`);

--
-- Indexes for table `tax_entity`
--
ALTER TABLE `tax_entity`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Attribute Id', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bill_entity`
--
ALTER TABLE `bill_entity`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Entity Id', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `bill_entity_items`
--
ALTER TABLE `bill_entity_items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item Id', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category_entity`
--
ALTER TABLE `category_entity`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Category Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kot_entity`
--
ALTER TABLE `kot_entity`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Entity Id', AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `kot_entity_items`
--
ALTER TABLE `kot_entity_items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item Id', AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_entity`
--
ALTER TABLE `menu_entity`
  MODIFY `entity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Menu Entity Id', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  MODIFY `ingredient_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Ingredient ID', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `menu_entity_price`
--
ALTER TABLE `menu_entity_price`
  MODIFY `price_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Price Id', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `menu_entity_price_type`
--
ALTER TABLE `menu_entity_price_type`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Price Type Id', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_entity`
--
ALTER TABLE `order_entity`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Order Id', AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `order_entity_items`
--
ALTER TABLE `order_entity_items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item Id', AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `table_category`
--
ALTER TABLE `table_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `table_details`
--
ALTER TABLE `table_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tax_entity`
--
ALTER TABLE `tax_entity`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Tax Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_entity`
--
ALTER TABLE `bill_entity`
  ADD CONSTRAINT `bill_entity_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_entity_items`
--
ALTER TABLE `bill_entity_items`
  ADD CONSTRAINT `bill_entity_items_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_entity`
--
ALTER TABLE `category_entity`
  ADD CONSTRAINT `category_entity_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kot_entity`
--
ALTER TABLE `kot_entity`
  ADD CONSTRAINT `kot_entity_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kot_entity_items`
--
ALTER TABLE `kot_entity_items`
  ADD CONSTRAINT `kot_entity_items_ibfk_1` FOREIGN KEY (`kot_id`) REFERENCES `kot_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_entity`
--
ALTER TABLE `menu_entity`
  ADD CONSTRAINT `menu_entity_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  ADD CONSTRAINT `menu_entity_ingredients_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_entity_price`
--
ALTER TABLE `menu_entity_price`
  ADD CONSTRAINT `menu_entity_price_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_entity_items`
--
ALTER TABLE `order_entity_items`
  ADD CONSTRAINT `order_entity_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_details`
--
ALTER TABLE `table_details`
  ADD CONSTRAINT `table_details_ibfk_1` FOREIGN KEY (`table_cat_id`) REFERENCES `table_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
