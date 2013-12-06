-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2013 at 09:06 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `referral_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d078ff9c0d2a1d6b76434145e7aa3d8c', '195.95.211.234', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0', 1384425264, 'a:10:{s:9:"user_data";s:0:"";s:10:"DX_user_id";s:1:"1";s:11:"DX_username";s:5:"admin";s:10:"DX_role_id";s:1:"2";s:12:"DX_role_name";s:5:"Admin";s:18:"DX_parent_roles_id";a:0:{}s:20:"DX_parent_roles_name";a:0:{}s:13:"DX_permission";a:0:{}s:21:"DX_parent_permissions";a:0:{}s:12:"DX_logged_in";b:1;}'),
('0d0d49d0e7adc553a602a01e3020e888', '195.95.211.234', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0', 1384333654, 'a:10:{s:9:"user_data";s:0:"";s:10:"DX_user_id";s:1:"1";s:11:"DX_username";s:5:"admin";s:10:"DX_role_id";s:1:"2";s:12:"DX_role_name";s:5:"Admin";s:18:"DX_parent_roles_id";a:0:{}s:20:"DX_parent_roles_name";a:0:{}s:13:"DX_permission";a:0:{}s:21:"DX_parent_permissions";a:0:{}s:12:"DX_logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` text,
  `users_id` int(11) NOT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `called` datetime DEFAULT NULL,
  `customerQuality` varchar(45) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customers_users1_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4002012 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `state`, `address`, `users_id`, `sex`, `called`, `customerQuality`, `notes`) VALUES
(22, 'Roman Zaglinskiy', 'NSW', 'Zavalna 103', 1, 'm', '2013-10-12 00:44:48', '1', 'test notes, iii8'),
(32, 'Natalia Zaglinskaya', 'NSW', 'gogol 3-a', 1, 'm', '2013-10-16 00:00:00', '1', 'test notes, iii9'),
(4001062, 'Ace Global Services', 'SA', 'ADD ALL REFERRALS WITHOUT A REFERRAL TO THIS CUSTOMER FILE.', 1, 'm', '2013-11-02 07:37:45', '1', 'DO NOT ADD PHONE NUMBERS TO THIS CUSTOMER.'),
(4001122, 'Natalia Ivanova', 'NSW', '', 1, 'm', '2013-11-06 12:36:05', '1', ''),
(4001132, 'Fiona Smart', 'QLD', '', 1, 'f', '2013-11-06 11:28:45', '1', ''),
(4001442, 'Obie Brown', 'WA', '', 1, 'm', '2013-11-07 03:20:40', '1', ''),
(4001452, 'MS. JOANNE ATTWOOD', '---', NULL, 1, '---', '2013-11-07 06:09:17', NULL, NULL),
(4001462, 'DAVID BROWN', '---', NULL, 1, '---', '2013-11-07 06:10:18', NULL, NULL),
(4001472, 'PHILLIPA BATTLE', 'SA', '', 1, 'm', '2013-11-07 06:10:45', '1', ''),
(4001482, 'Shiantha Cox', '---', NULL, 1, '---', '2013-11-07 09:43:19', NULL, NULL),
(4001492, 'Ms.Agnes Joyce Riley', '---', NULL, 1, '---', '2013-11-08 11:04:37', NULL, NULL),
(4001502, 'amelie', '---', NULL, 1, '---', '2013-11-08 11:39:11', NULL, NULL),
(4001512, 'Lisa ', '---', NULL, 1, '---', '2013-11-08 11:39:27', NULL, NULL),
(4001522, 'cythia', '---', NULL, 1, '---', '2013-11-08 11:39:58', NULL, NULL),
(4001532, 'james', '---', NULL, 1, '---', '2013-11-08 11:39:59', NULL, NULL),
(4001542, 'georgina', '---', NULL, 1, '---', '2013-11-08 11:40:30', NULL, NULL),
(4001552, 'roseanne ', 'NSW', '', 1, 'm', '2013-11-08 11:40:30', '1', ''),
(4001562, 'roberta', '---', NULL, 1, '---', '2013-11-08 11:40:31', NULL, NULL),
(4001572, 'bryant', '---', NULL, 1, '---', '2013-11-08 12:12:38', NULL, NULL),
(4001582, 'anthony', 'NSW', '', 1, '', '2013-11-08 12:13:16', '1', ''),
(4001592, 'gloria', 'NSW', '', 1, '', '2013-11-08 12:13:16', '1', ''),
(4001602, 'Donita ', 'NSW', '', 1, '', '2013-11-08 12:13:16', '1', ''),
(4001612, 'debra', '---', NULL, 1, '---', '2013-11-08 12:17:10', NULL, NULL),
(4001622, 'rowina ', '---', NULL, 1, '---', '2013-11-08 12:17:10', NULL, NULL),
(4001632, 'daniel   ', '---', NULL, 1, '---', '2013-11-08 12:17:10', NULL, NULL),
(4001642, 'MS. JUDITH', '---', NULL, 1, '---', '2013-11-08 12:19:30', NULL, NULL),
(4001652, 'MS. JULIE', '---', NULL, 1, '---', '2013-11-08 12:19:30', NULL, NULL),
(4001662, 'MS. JEANNIE', '---', NULL, 1, '---', '2013-11-08 12:19:31', NULL, NULL),
(4001672, 'MS. GERALDINE', '---', NULL, 1, '---', '2013-11-08 12:19:31', NULL, NULL),
(4001682, 'MS. DIANNE', '---', NULL, 1, '---', '2013-11-08 12:19:31', NULL, NULL),
(4001692, 'MS. SARAH', '---', NULL, 1, '---', '2013-11-08 12:19:32', NULL, NULL),
(4001702, 'MS. KAITLEEN', '---', NULL, 1, '---', '2013-11-08 12:19:32', NULL, NULL),
(4001712, 'MS. BEATRICE', '---', NULL, 1, '---', '2013-11-08 12:19:33', NULL, NULL),
(4001722, 'BRUNETTE', 'NSW', '', 1, '', '2013-11-08 12:19:54', '1', ''),
(4001752, 'CHERYL', '---', NULL, 1, '---', '2013-11-08 09:17:07', NULL, NULL),
(4001892, 'Marilyn Manson', 'WA', '', 1, 'm', '2013-11-09 01:21:08', '1', ''),
(4001902, 'Jastin Bieber', '---', NULL, 1, '---', '2013-11-09 01:26:25', NULL, NULL),
(4001912, 'Oksana Bieber', '---', NULL, 1, '---', '2013-11-09 01:29:46', NULL, NULL),
(4001922, 'Ivan Bieber', 'NSW', '', 1, '', '2013-11-09 01:29:46', '3', ''),
(4001972, 'CHERYL2', '---', NULL, 1, '---', '2013-11-12 12:19:01', NULL, NULL),
(4001982, '', '---', NULL, 1, '---', '2013-11-12 01:02:52', NULL, NULL),
(4001992, 'Sally Smith', 'SA', '', 1, 'm', '2013-11-12 01:03:13', '1', ''),
(4002002, 'Marilyn Manson', 'WA', NULL, 1, 'm', '2013-11-12 01:09:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers_phones`
--

CREATE TABLE IF NOT EXISTS `customers_phones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `customers_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customers_phones_customers1_idx` (`customers_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3223 ;

--
-- Dumping data for table `customers_phones`
--

INSERT INTO `customers_phones` (`id`, `phone`, `customers_id`) VALUES
(3152, '61407889889', 4001962),
(3162, '61402324567', 4001892),
(3172, '61402992177', 4001892),
(3142, '61407889889', 4001952),
(3132, '61407889889', 4001942),
(3222, '61402992177', 4002002),
(3212, '61408496187', 4001992),
(3202, '61408496187', 4001982),
(3192, '61407889889', 22),
(3182, '61408496187', 4001972),
(3062, '61404569877', 4001472),
(3052, '61408496189', 4001902),
(3042, '61407889889', 4001932),
(3032, '61407889888', 22),
(3022, '61408496112', 4001922),
(3012, '61408496111', 4001912),
(3002, '61408496188', 4001902),
(2992, '61408496188', 4001892),
(2982, '61408496187', 4001752);

-- --------------------------------------------------------

--
-- Table structure for table `customers_qualities`
--

CREATE TABLE IF NOT EXISTS `customers_qualities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quality` int(2) NOT NULL,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `customers_qualities`
--

INSERT INTO `customers_qualities` (`id`, `quality`, `title`) VALUES
(2, 1, 'Bad'),
(12, 2, '2'),
(22, 3, 'Average'),
(32, 4, '4'),
(42, 5, 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `customers_services`
--

CREATE TABLE IF NOT EXISTS `customers_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quality` char(255) DEFAULT NULL,
  `leadStatus` text,
  `services_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `postedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customers_services_services_idx` (`services_id`),
  KEY `fk_customers_services_customers1_idx` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=522 ;

--
-- Dumping data for table `customers_services`
--

INSERT INTO `customers_services` (`id`, `quality`, `leadStatus`, `services_id`, `customers_id`, `postedDate`) VALUES
(162, NULL, 'brand new', 2, 32, '2013-10-24 02:35:56'),
(172, NULL, 'brand new', 5, 32, '2013-10-24 02:36:20'),
(182, NULL, 'working lead', 10, 32, '2013-10-24 03:45:25'),
(402, NULL, 'bad lead', 12, 32, '2013-10-28 10:02:32'),
(412, NULL, 'working lead', 2, 32, '2013-10-28 10:48:20'),
(422, NULL, 'callback', 22, 32, '2013-10-28 10:49:33'),
(432, NULL, 'working lead', 10, 32, '2013-10-28 10:51:21'),
(442, NULL, 'call back', 5, 32, '2013-10-28 10:52:53'),
(492, NULL, 'not interested', 2, 4001062, '2013-11-05 01:53:42'),
(512, NULL, 'sale made', 12, 4001692, '2013-11-10 09:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `relationships_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_referral` (`customers_id`,`referral_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1373 ;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `customers_id`, `referral_id`, `relationships_id`, `users_id`) VALUES
(1312, 22, 4001972, 0, 1),
(1302, 22, 4001892, 0, 1),
(1292, 22, 4001752, 0, 1),
(1282, 4001472, 4001962, 0, 1),
(1272, 4001472, 4001952, 0, 1),
(1262, 4001472, 4001942, 0, 1),
(1252, 4001902, 4001932, 0, 1),
(1242, 4001902, 4001922, 0, 1),
(1232, 4001902, 4001912, 0, 1),
(1222, 4001472, 4001902, 0, 1),
(1212, 4001472, 4001892, 0, 1),
(1202, 4001472, 4001752, 0, 1),
(1322, 32, 4001982, 0, 1),
(1332, 32, 4001972, 0, 1),
(1342, 32, 4001752, 0, 1),
(1352, 32, 4001992, 142, 1),
(1362, 4001992, 4001992, 1, 1),
(1372, 32, 4002002, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `title`) VALUES
(102, 'Aunty'),
(32, 'Brother'),
(132, 'Brother In Law'),
(112, 'Cousin'),
(2, 'Father'),
(42, 'Friend'),
(1, 'Mother'),
(52, 'Partner'),
(22, 'Sister'),
(142, 'Sister In Law'),
(122, 'Uncle'),
(92, 'x - Other'),
(82, 'x - Other Family'),
(0, 'NO RELATION');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'User'),
(2, 0, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`) VALUES
(2, 'Tablet PC - 7" Mobile'),
(5, 'DoDo - Home Phone'),
(10, 'DoDo - ADSL'),
(12, '4.7" DAXIAN XY100S Quad Core MTK6589 1.5GHz Android 4.2 Smartphone Mobile Phone'),
(22, 'Wood Design Natural Throw Pillow Car Lumbar Back Soft Cushion Home Decor Support'),
(32, 'No Chemicals Washing Laundry Dryer Ball Soften Cloth');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`) VALUES
(2, 'NSW'),
(12, 'VIC'),
(22, 'QLD'),
(32, 'SA'),
(42, 'WA'),
(52, 'NT'),
(62, 'TAS'),
(72, 'ACT');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(25) COLLATE utf8_bin NOT NULL,
  `password` varchar(34) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `newpass` varchar(34) COLLATE utf8_bin DEFAULT NULL,
  `newpass_key` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `newpass_time` datetime DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 2, 'admin', '$1$PQwYdN3n$y7WYCh5v3Z/rL0Krm5mTC1', 'roman.zaglinskij@gmail.com', 0, NULL, NULL, NULL, NULL, '195.95.211.234', '2013-11-14 21:04:24', '2008-11-30 04:56:32', '2013-11-14 10:34:24'),
(2, 1, 'user', '$1$bO..IR4.$CxjJBjKJ5QW2/BaYKDS7f.', 'user@localhost.com', 0, NULL, NULL, NULL, NULL, '195.95.211.234', '2013-10-09 01:11:57', '2008-12-01 14:01:53', '2013-10-08 14:41:57'),
(12, 1, 'roman', '$1$PQwYdN3n$y7WYCh5v3Z/rL0Krm5mTC1', 'tinki.vinki@inbox.ru', 0, NULL, NULL, NULL, NULL, '195.95.211.234', '2013-10-09 01:11:23', '2013-10-08 21:48:49', '2013-10-08 14:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('0a1a8d0ec38ae175742773e09850c9a3', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36', '1.127.127.234', '2013-10-16 10:54:55'),
('4c70cb64d09c1d9ae14c875d42d704c1', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0', '195.95.211.234', '2013-10-24 15:53:38'),
('57ac154419d7470ea3a1b52fc3b2c528', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36', '195.95.211.234', '2013-10-09 07:05:07'),
('898f2e1e6c6104389a54e7683e41c1d6', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36', '114.30.97.146', '2013-10-09 02:33:52'),
('9b730ca85fe2a99961e7dad41825945c', 1, 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0_1 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A523 Safari/8536.25', '49.183.19.157', '2013-10-15 03:48:45'),
('ad1de2d2e1e687b0954fbbb74419e7b5', 1, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36', '95.133.75.162', '2013-11-10 10:55:31'),
('c2b164b33a7d0c80d20d471e0fa0bec8', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0', '95.135.33.111', '2013-10-27 17:27:52'),
('e8af6e454607f168161601e212915127', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0', '219.90.162.249', '2013-11-07 06:36:59'),
('fd1868153a404dc66d36b9c8e9d539da', 1, 'Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/20100101 Firefox/24.0', '95.132.70.252', '2013-10-26 13:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tabs` text,
  `user_profilecol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `country`, `website`, `tabs`, `user_profilecol`) VALUES
(1, 1, NULL, NULL, '{"customer":["22"]}', NULL),
(2, 12, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_temp`
--

CREATE TABLE IF NOT EXISTS `user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(34) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activation_key` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers_services`
--
ALTER TABLE `customers_services`
  ADD CONSTRAINT `fk_customers_services_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customers_services_services` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
