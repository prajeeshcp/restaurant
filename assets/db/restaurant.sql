-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2017 at 05:40 PM
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
(2, 'Veg', 1),
(3, 'Non Veg', 1);

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
(2, 2, 'North Indian Thali', '2017-02-14 19:55:19', '2017-02-15 14:50:04', 1);

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
(2, 'members', 'General User');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ctrated At',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated At',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_entity`
--

INSERT INTO `menu_entity` (`entity_id`, `category_id`, `menu_name`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 'First Menu Edit', '2017-02-15 15:30:55', '2017-02-15 16:26:54', 1),
(2, 2, 'Second menu edit', '2017-02-15 16:27:47', '2017-02-16 15:08:07', 2);

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
(8, 2, '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_category`
--

CREATE TABLE `table_category` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_category`
--

INSERT INTO `table_category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'family', 1, '2017-02-15 16:16:19', '2017-02-15 16:16:19'),
(2, 'couples', 2, '2017-02-16 18:33:24', '2017-02-16 14:03:24'),
(3, 'party', 1, '2017-02-16 12:24:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_details`
--

CREATE TABLE `table_details` (
  `id` int(11) NOT NULL,
  `table_number` varchar(75) NOT NULL,
  `capacity` int(11) NOT NULL,
  `table_cat_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_details`
--

INSERT INTO `table_details` (`id`, `table_number`, `capacity`, `table_cat_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'table one ', 4, 1, 1, 2017, 0),
(2, 'table two ', 6, 1, 1, 2017, 2017),
(3, 'table three', 4, 3, 1, 2017, 2017);

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
(1, '127.0.0.1', 'administrator', '$2y$08$eFoSZ7WQx7o9Iq5cbDbDeOYyjYCs/FSztxBQUM/vJEJ6iNBCLD7gS', '', 'admin@admin.com', '', NULL, NULL, 'cIpDKHmOD.QSFNMiyW4Wje', 1268889823, 1487262878, 1, 'Admin', 'istrator', 'ADMIN', '0');

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
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `category_entity`
--
ALTER TABLE `category_entity`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `menu_id` (`menu_id`);

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
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Attribute Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category_entity`
--
ALTER TABLE `category_entity`
  MODIFY `entity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Category Id', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_entity`
--
ALTER TABLE `menu_entity`
  MODIFY `entity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Menu Entity Id', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_entity_ingredients`
--
ALTER TABLE `menu_entity_ingredients`
  MODIFY `ingredient_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Ingredient ID', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `table_category`
--
ALTER TABLE `table_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_details`
--
ALTER TABLE `table_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

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
-- Constraints for table `table_details`
--
ALTER TABLE `table_details`
  ADD CONSTRAINT `table_details_ibfk_1` FOREIGN KEY (`table_cat_id`) REFERENCES `table_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
