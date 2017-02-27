-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2017 at 05:47 PM
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
  `total_qty-ordered` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Total Qty Ordered',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(2, 'Cashier', 'Cashier'),
(3, 'Waiter', 'Waiter');

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
(22, 'pending', 3, 26, '10001', '0.00', '2017-02-27 16:53:58', '2017-02-27 11:23:58'),
(23, 'pending', 3, 27, '10002', '0.00', '2017-02-27 17:08:45', '2017-02-27 11:38:45'),
(24, 'pending', 3, 28, '10003', '0.00', '2017-02-27 17:10:53', '2017-02-27 11:40:53'),
(25, 'pending', 3, 29, '10004', '0.00', '2017-02-27 17:17:46', '2017-02-27 11:47:46'),
(26, 'pending', 3, 30, '10005', '0.00', '2017-02-27 17:20:34', '2017-02-27 11:50:34'),
(27, 'pending', 3, 31, '10006', '0.00', '2017-02-27 17:20:44', '2017-02-27 11:50:44'),
(28, 'pending', 3, 32, '10007', '0.00', '2017-02-27 17:21:06', '2017-02-27 11:51:06'),
(29, 'pending', 3, 33, '10008', '0.00', '2017-02-27 17:33:46', '2017-02-27 12:03:46');

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
(15, 22, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '2.00', '2017-02-27 16:54:02', '2017-02-27 11:24:09'),
(16, 23, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '2017-02-27 17:08:47', '2017-02-27 11:38:47'),
(17, 24, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '2017-02-27 17:10:56', '2017-02-27 11:40:56'),
(18, 25, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '2017-02-27 17:17:49', '2017-02-27 11:47:49'),
(19, 26, 0, 2, 'table', 1, 'Second menu edit (Normal)', '2.00', '2017-02-27 17:20:36', '2017-02-27 11:50:38'),
(20, 27, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '2017-02-27 17:20:46', '2017-02-27 11:50:46'),
(21, 27, 0, 2, 'table', 1, 'Second menu edit (Normal)', '1.00', '2017-02-27 17:20:48', '2017-02-27 11:50:48'),
(22, 27, 0, 3, 'table', 1, 'New menu (Normal)', '1.00', '2017-02-27 17:20:50', '2017-02-27 11:50:50'),
(23, 28, 0, 2, 'table', 1, 'Second menu edit (Normal)', '1.00', '2017-02-27 17:21:15', '2017-02-27 11:51:15'),
(24, 28, 0, 2, 'table', 2, 'Second menu edit (Half )', '1.00', '2017-02-27 17:21:17', '2017-02-27 11:51:17'),
(25, 28, 0, 3, 'table', 2, 'New menu (Half )', '1.00', '2017-02-27 17:21:20', '2017-02-27 11:51:20'),
(26, 28, 0, 3, 'table', 1, 'New menu (Normal)', '2.00', '2017-02-27 17:21:21', '2017-02-27 11:51:26'),
(27, 29, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '2017-02-27 17:33:52', '2017-02-27 12:03:52');

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

INSERT INTO `order_entity` (`entity_id`, `status`, `table_id`, `user_id`, `increment_id`, `grand_total`, `subtotal`, `tax_amount`, `total_paid`, `discount_amount`, `delivery_charge`, `total_qty_ordered`, `created_at`, `updated_at`) VALUES
(26, 'pending', 3, 8, '10001', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 16:53:58', '2017-02-27 11:23:58'),
(27, 'pending', 3, 8, '10002', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 17:08:45', '2017-02-27 11:38:45'),
(28, 'pending', 3, 8, '10003', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 17:10:53', '2017-02-27 11:40:53'),
(29, 'pending', 3, 8, '10004', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 17:17:46', '2017-02-27 11:47:46'),
(30, 'pending', 3, 8, '10005', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 17:20:34', '2017-02-27 11:50:34'),
(31, 'pending', 3, 8, '10006', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 17:20:44', '2017-02-27 11:50:44'),
(32, 'pending', 3, 8, '10007', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 17:21:06', '2017-02-27 11:51:06'),
(33, 'pending', 3, 8, '10008', '0.00', '0.00', 0.00, '0.00', '0.00', '0.00', 0, '2017-02-27 17:33:46', '2017-02-27 12:03:46');

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
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_entity_items`
--

INSERT INTO `order_entity_items` (`item_id`, `order_id`, `is_kot`, `menu_id`, `order_type`, `price_type`, `name`, `qty_ordered`, `price`, `tax_percent`, `tax_amount`, `row_total`, `created_at`, `updated_at`) VALUES
(17, 26, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '2.00', '10.00', '0.00', '0.00', '20.00', '2017-02-27 16:54:02', '2017-02-27 11:24:09'),
(18, 27, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '10.00', '0.00', '0.00', '10.00', '2017-02-27 17:08:47', '2017-02-27 11:38:47'),
(19, 28, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '10.00', '0.00', '0.00', '10.00', '2017-02-27 17:10:56', '2017-02-27 11:40:56'),
(20, 29, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '10.00', '0.00', '0.00', '10.00', '2017-02-27 17:17:49', '2017-02-27 11:47:49'),
(21, 30, 0, 2, 'table', 1, 'Second menu edit (Normal)', '2.00', '500.00', '0.00', '0.00', '1000.00', '2017-02-27 17:20:36', '2017-02-27 11:50:38'),
(22, 31, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '10.00', '0.00', '0.00', '10.00', '2017-02-27 17:20:46', '2017-02-27 11:50:46'),
(23, 31, 0, 2, 'table', 1, 'Second menu edit (Normal)', '1.00', '500.00', '0.00', '0.00', '500.00', '2017-02-27 17:20:48', '2017-02-27 11:50:48'),
(24, 31, 0, 3, 'table', 1, 'New menu (Normal)', '1.00', '100.00', '0.00', '0.00', '100.00', '2017-02-27 17:20:50', '2017-02-27 11:50:50'),
(25, 32, 0, 2, 'table', 1, 'Second menu edit (Normal)', '1.00', '500.00', '0.00', '0.00', '500.00', '2017-02-27 17:21:15', '2017-02-27 11:51:15'),
(26, 32, 0, 2, 'table', 2, 'Second menu edit (Half )', '1.00', '300.00', '0.00', '0.00', '300.00', '2017-02-27 17:21:17', '2017-02-27 11:51:17'),
(27, 32, 0, 3, 'table', 2, 'New menu (Half )', '1.00', '200.00', '0.00', '0.00', '200.00', '2017-02-27 17:21:20', '2017-02-27 11:51:20'),
(28, 32, 0, 3, 'table', 1, 'New menu (Normal)', '2.00', '100.00', '0.00', '0.00', '200.00', '2017-02-27 17:21:21', '2017-02-27 11:51:26'),
(29, 33, 0, 1, 'table', 1, 'First Menu Edit (Normal)', '1.00', '10.00', '0.00', '0.00', '10.00', '2017-02-27 17:33:52', '2017-02-27 12:03:52');

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
(1, '127.0.0.1', 'administrator', '$2y$08$eFoSZ7WQx7o9Iq5cbDbDeOYyjYCs/FSztxBQUM/vJEJ6iNBCLD7gS', '', 'admin@admin.com', '', NULL, NULL, '9B3CyEPK1b0mcCKWB3NGW.', 1268889823, 1487872439, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(8, '', 'haridas', '$2y$08$eFoSZ7WQx7o9Iq5cbDbDeOYyjYCs/FSztxBQUM/vJEJ6iNBCLD7gS', NULL, 'haridas@gmail.com', NULL, NULL, NULL, 'Jx7N0PfIeYwFgHGi/PUXsO', 1268889823, 1488200342, 1, 'Haridas K', 'Kurup', 'IT', '8904055898');

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
(8, 8, 2);

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
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Entity Id';
--
-- AUTO_INCREMENT for table `bill_entity_items`
--
ALTER TABLE `bill_entity_items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item Id';
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
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Entity Id', AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `kot_entity_items`
--
ALTER TABLE `kot_entity_items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item Id', AUTO_INCREMENT=28;
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
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Order Id', AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `order_entity_items`
--
ALTER TABLE `order_entity_items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Item Id', AUTO_INCREMENT=30;
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_entity`
--
ALTER TABLE `bill_entity`
  ADD CONSTRAINT `bill_entity_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_entity`
--
ALTER TABLE `category_entity`
  ADD CONSTRAINT `category_entity_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
