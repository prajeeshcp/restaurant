-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2017 at 09:13 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prajeesh_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_details`
--

CREATE TABLE IF NOT EXISTS `table_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_number` varchar(75) NOT NULL,
  `capacity` int(11) NOT NULL,
  `table_cat_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `table_cat_id` (`table_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `table_details`
--

INSERT INTO `table_details` (`id`, `table_number`, `capacity`, `table_cat_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'table one ', 4, 1, 1, 2017, 0),
(2, 'table two ', 6, 1, 1, 2017, 0),
(3, 'table three', 4, 3, 1, 2017, 2017);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_details`
--
ALTER TABLE `table_details`
  ADD CONSTRAINT `table_details_ibfk_1` FOREIGN KEY (`table_cat_id`) REFERENCES `table_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
