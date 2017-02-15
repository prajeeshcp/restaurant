-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2017 at 10:03 PM
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
-- Table structure for table `menu_entity`
--

CREATE TABLE `menu_entity` (
  `entity_id` int(11) UNSIGNED NOT NULL COMMENT 'Menu Entity Id',
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Category Id',
  `menu_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Manu Name',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ctrated At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_entity`
--

INSERT INTO `menu_entity` (`entity_id`, `category_id`, `menu_name`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 'First Menu Edit', '2017-02-15 15:30:55', '2017-02-15 16:26:54', 1),
(2, 2, 'Second menu edit', '2017-02-15 16:27:47', '2017-02-15 16:31:10', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_entity`
--
ALTER TABLE `menu_entity`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_entity`
--
ALTER TABLE `menu_entity`
  MODIFY `entity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Menu Entity Id', AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_entity`
--
ALTER TABLE `menu_entity`
  ADD CONSTRAINT `menu_entity_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
