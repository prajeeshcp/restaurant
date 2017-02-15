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
(5, 2, 'Menu ing 3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  MODIFY `ingredient_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Ingredient ID', AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  ADD CONSTRAINT `menu_entity_ingredients_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
