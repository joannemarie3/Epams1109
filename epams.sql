-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2016 at 11:24 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epams`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `id` int(11) unsigned NOT NULL,
  `device_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'device name',
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chipset` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gpu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `screenSize` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graphics` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `internalStorage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `simSupport` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrivalDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrivalNotes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mac` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assetType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subAsset` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imei` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `storageAllocation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL COMMENT 'category FK',
  `condition_id` int(11) NOT NULL COMMENT 'condition, FK',
  `status_id` int(11) NOT NULL,
  `tracker_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `device_id`, `barcode`, `name`, `brand`, `model`, `resolution`, `processor`, `ram`, `os`, `chipset`, `gpu`, `bit`, `screenSize`, `graphics`, `internalStorage`, `simSupport`, `arrivalDate`, `arrivalNotes`, `mac`, `serial`, `assetType`, `subAsset`, `imei`, `storageAllocation`, `category_id`, `condition_id`, `status_id`, `tracker_id`) VALUES
(16, '1234', '5431', 'Lappytop', 'MSI', 'GP60', '1367 x 1080', '2ghz intel I5', '8gb', 'Windows 100', 'Family Chipset', 'GTX 1080TI', 'x64', '15"', 'Nigga', '100TB', 'Hell Yea', 'Today', 'Ganda', NULL, '130481958', 'Intern', 'Sub', '2481279', '1tb', 1, 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL COMMENT 'category name'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Android'),
(2, 'Phone'),
(3, 'Tablet'),
(4, 'Adapter'),
(5, 'Cord'),
(6, 'Extension Cord'),
(27, 'Watch Ios');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`) VALUES
(1, 'VainGlory'),
(2, 'Boboboi'),
(3, 'Pokemon');

-- --------------------------------------------------------

--
-- Table structure for table `condition`
--

CREATE TABLE IF NOT EXISTS `condition` (
  `condition_id` int(11) NOT NULL,
  `condition_name` varchar(100) DEFAULT NULL COMMENT 'condition status'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `condition`
--

INSERT INTO `condition` (`condition_id`, `condition_name`) VALUES
(1, 'Bad'),
(2, 'Broken'),
(3, 'Good'),
(7, 'New'),
(8, 'Old'),
(9, 'Shiny');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL,
  `empId` varchar(11) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `tracker_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `empId`, `firstName`, `lastName`, `created_by`, `created_date`, `modified_by`, `modified_date`, `shift`, `tracker_id`) VALUES
(3, '2013-02113', 'Doe', 'DJ', NULL, NULL, NULL, NULL, 2, 0),
(4, '2013-02613', 'Fitzpatrick', 'Foo', NULL, NULL, NULL, NULL, 3, 0),
(6, '1209-71487', 'Miguel', 'De Jesus', NULL, NULL, NULL, NULL, 1, 0),
(7, '12487', 'Denise', 'Ros', NULL, NULL, NULL, NULL, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `timestamp` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `release`
--

CREATE TABLE IF NOT EXISTS `release` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `dev_id` int(11) NOT NULL,
  `release_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `release_logs`
--

CREATE TABLE IF NOT EXISTS `release_logs` (
  `release_id` int(11) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `dev_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Borrowed',
  `release_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE IF NOT EXISTS `shifts` (
  `shift_id` int(11) NOT NULL,
  `shift_name` varchar(99) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`shift_id`, `shift_name`) VALUES
(1, '1st Shift'),
(2, '2nd Shift'),
(3, '3rd Shift'),
(4, '4th Shift'),
(5, 'GY Shift');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Borrowed'),
(2, 'Returned'),
(3, 'On Hand'),
(4, 'On Shelf'),
(8, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `usertype_id` int(11) DEFAULT NULL COMMENT '1-admin, 2-rm, 2-member',
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `employee_id`, `username`, `password`, `created_by`, `created_date`, `usertype_id`, `modified_by`, `modified_date`) VALUES
(4, NULL, 'RM', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, 2, NULL, NULL),
(6, NULL, 'Admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 1, NULL, NULL),
(7, NULL, 'Tester', '1a1dc91c907325c69271ddf0c944bc72', NULL, NULL, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `usertype_id` int(11) NOT NULL,
  `usertype_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`usertype_id`, `usertype_name`) VALUES
(1, 'Admin'),
(2, 'RM'),
(3, 'Tester');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `device_id` (`device_id`), ADD KEY `category_id` (`category_id`), ADD KEY `condition_id` (`condition_id`), ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `condition`
--
ALTER TABLE `condition`
  ADD PRIMARY KEY (`condition_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `empId` (`empId`), ADD KEY `shift` (`shift`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`), ADD KEY `id` (`history_id`);

--
-- Indexes for table `release`
--
ALTER TABLE `release`
  ADD KEY `id` (`id`), ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `release_logs`
--
ALTER TABLE `release_logs`
  ADD PRIMARY KEY (`release_id`), ADD KEY `emp_id` (`emp_id`), ADD KEY `dev_id` (`dev_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`), ADD KEY `usertype_id` (`usertype_id`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`usertype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `condition`
--
ALTER TABLE `condition`
  MODIFY `condition_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `release`
--
ALTER TABLE `release`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `release_logs`
--
ALTER TABLE `release_logs`
  MODIFY `release_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `usertype_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
