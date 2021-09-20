-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 14, 2021 at 05:19 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tehran_ftth`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

DROP TABLE IF EXISTS `bugs`;
CREATE TABLE IF NOT EXISTS `bugs` (
  `bug_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) NOT NULL,
  `bug_virtual_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bug_last` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>قرمز و چشمک زن\r\n1=>خاموش',
  `bug_pan` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>سبز ثابت\r\n1=>سبز چشمک زن',
  `bug_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bug_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>مشاهده نشده\r\n1=>در حال بررسی\r\n2=>اعلام نتیجه',
  `bug_answer` longtext COLLATE utf8_unicode_ci,
  `bug_create` datetime NOT NULL,
  `bug_update` datetime DEFAULT NULL,
  PRIMARY KEY (`bug_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) NOT NULL,
  `comment_to` int(10) UNSIGNED DEFAULT NULL,
  `comment_text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment_readed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>unread\r\n1=>readed',
  `comment_create` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_from` (`user_id`),
  KEY `comment_to` (`comment_to`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `user_id` bigint(10) NOT NULL,
  `cu_company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cu_namayande` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cu_addresss` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cu_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cu_create` datetime NOT NULL,
  `cu_update` datetime DEFAULT NULL,
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `file_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_create` datetime NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `file_request_id` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) NOT NULL,
  `request_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>مشاهده نشده\r\n1=> در حال بررسی\r\n2=>اعلام نتیجه',
  `request_answer` longtext COLLATE utf8_unicode_ci,
  `request_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `request_buildstatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>درحال ساخت\r\n1=>در حال بازسازی\r\nنوساز<=2\r\nعمر تا 10 سال<=3\r\nبیشتر از 10 سال<=4',
  `request_owner` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>مالک\r\n1=> اجاره ای',
  `request_count_unit` int(11) NOT NULL,
  `request_count_request` int(11) NOT NULL,
  `request_build_request` int(11) NOT NULL,
  `request_fix_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `request_base` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>در ساختمان وجود دارد .\r\n1=>در واحد پریز فیبر نوری وجود دارد . \r\nدر کوچه باکس فیبر<=2\r\nنورب دارد . \r\n3=>همسایه ها سرویس فیبر نوری دارند .\r\n ندارد .\r\n4=>همسایه ها سرویس فیبر نوری دارند .\r\n ندارد \r\n5=> نمی دانم ',
  `request_karshenasi` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>ندارد\r\n1=>دارد',
  `request_create` datetime NOT NULL,
  `request_update` datetime DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

DROP TABLE IF EXISTS `resetpassword`;
CREATE TABLE IF NOT EXISTS `resetpassword` (
  `user_phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `reset_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `reset_expired` datetime NOT NULL,
  KEY `user_phone` (`user_phone`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `resetpassword`
--

INSERT INTO `resetpassword` (`user_phone`, `reset_code`, `reset_expired`) VALUES
('09127266505', '910659', '2021-09-14 09:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>auth\r\n1=>customer\r\n2=>admin\r\n3=>superadmin',
  `user_session` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_create` datetime NOT NULL,
  `user_update` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_phone` (`user_phone`) USING BTREE,
  UNIQUE KEY `user_email` (`user_email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_phone`, `user_password`, `user_email`, `user_type`, `user_session`, `user_create`, `user_update`) VALUES
(2, 'مدیر', '09127266505', '$2y$10$.KrWc/dv5G4v4LFv9W0zYOCGjZ6BBMp9KY5Ydxl.APDn25ExJTbam', 'test@test.com', 3, NULL, '2021-08-29 23:30:43', '2021-09-13 11:21:58');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bugs`
--
ALTER TABLE `bugs`
  ADD CONSTRAINT `bugs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD CONSTRAINT `resetpassword_ibfk_1` FOREIGN KEY (`user_phone`) REFERENCES `users` (`user_phone`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
