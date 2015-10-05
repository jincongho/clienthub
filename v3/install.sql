-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 05, 2015 at 01:35 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clienthub`
--

-- --------------------------------------------------------

--
-- Table structure for table `ch_attachments`
--

CREATE TABLE IF NOT EXISTS `ch_attachments` (
  `id` varchar(13) NOT NULL,
  `filename` text NOT NULL,
  `filetype` enum('music','video','document','image','others') NOT NULL,
  `fileext` text NOT NULL,
  `mimetype` text NOT NULL,
  `clientid` int(11) NOT NULL,
  `uploaddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ch_clients`
--

CREATE TABLE IF NOT EXISTS `ch_clients` (
`id` int(11) NOT NULL,
  `gravatar` varchar(18) DEFAULT NULL,
  `name` text NOT NULL,
  `status` enum('active','trash') NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ch_clientsdata`
--

CREATE TABLE IF NOT EXISTS `ch_clientsdata` (
  `id` int(11) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `sex` enum('','男','女') DEFAULT NULL,
  `ic` text,
  `placeofbirth` text,
  `education` text,
  `language` text,
  `race` text,
  `faith` text,
  `maritalstatus` enum('已婚','单身','其他','不详') DEFAULT NULL,
  `nationality` text,
  `address` longtext,
  `epf` text,
  `banker` text,
  `contactno` text,
  `platesno` text,
  `asset` text,
  `height` int(3) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL,
  `blood` enum('','O+','O-','AB+','AB-','A+','A-','B+','B-') DEFAULT NULL,
  `eye` text,
  `hair` text,
  `skin` text,
  `case` longtext,
  `family` longtext,
  `company` longtext,
  `remarks` longtext,
  `topprior` tinyint(1) DEFAULT NULL,
  `dna` text,
  `file` text,
  `profession` text,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ch_clientsdata_meta`
--

CREATE TABLE IF NOT EXISTS `ch_clientsdata_meta` (
  `fieldname` text NOT NULL,
  `slugname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ch_clientsdata_meta`
--

INSERT INTO `ch_clientsdata_meta` (`fieldname`, `slugname`) VALUES
('Age 年龄', 'age'),
('Sex 性别', 'sex'),
('IC 身份证', 'ic'),
('File 档案', 'file'),
('Case Report 案情', 'case'),
('Place of Birth 出生地', 'placeofbirth'),
('Education 教育', 'education'),
('Language 语言', 'language'),
('Race 种族', 'race'),
('Faith 信仰', 'faith'),
('Marital Status 婚姻状态', 'maritalstatus'),
('Nationality 国籍', 'nationality'),
('Profession 职业', 'profession'),
('Address 地址', 'address'),
('EPF', 'epf'),
('Banker', 'banker'),
('Contact No. 联络号码', 'contactno'),
('Email 电邮', 'email'),
('Plates No. 车牌号码', 'platesno'),
('Assets 资产', 'asset'),
('Height 身高', 'height'),
('Weight 体重', 'weight'),
('Blood 血型', 'blood'),
('Eye 眼睛', 'eye'),
('Hair 头发', 'hair'),
('DNA', 'dna'),
('Skin 肤色', 'skin'),
('Family 家庭', 'family'),
('Company 公司', 'company'),
('Top Prior', 'topprior'),
('Remarks 备注', 'remarks');

-- --------------------------------------------------------

--
-- Table structure for table `ch_general`
--

CREATE TABLE IF NOT EXISTS `ch_general` (
`id` int(11) NOT NULL,
  `key` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ch_general`
--

INSERT INTO `ch_general` (`id`, `key`, `value`) VALUES
(1, 'per_page', '25'),
(2, 'site_title', 'Client Information Hub'),
(3, 'show_unset', 'true'),
(4, 'in_list', 'file|case'),
(5, 'gravatar', 'gravatar1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ch_groups`
--

CREATE TABLE IF NOT EXISTS `ch_groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ch_groups`
--

INSERT INTO `ch_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(3, 'staff', 'Company Staff');

-- --------------------------------------------------------

--
-- Table structure for table `ch_login_attempts`
--

CREATE TABLE IF NOT EXISTS `ch_login_attempts` (
`id` mediumint(8) unsigned NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ch_preference`
--

CREATE TABLE IF NOT EXISTS `ch_preference` (
  `key` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ch_users`
--

CREATE TABLE IF NOT EXISTS `ch_users` (
`id` mediumint(8) unsigned NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ch_users`
--

INSERT INTO `ch_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 0x7f5c305c30, 'admin', '48edd08fe0d92dedd436c5f3750b897cf4c533d3', '9462e8eee0', 'admin@admin.com', '58c0ab7eb3429a1d8e6e11cd06b50dfabd99423c', NULL, NULL, '77e664028b1c6cb3733047c154285ffdea2946ea', 1268889823, 1444044319, 1, 'istrator', 'Admin', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `ch_users_groups`
--

CREATE TABLE IF NOT EXISTS `ch_users_groups` (
`id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ch_users_groups`
--

INSERT INTO `ch_users_groups` (`id`, `user_id`, `group_id`) VALUES
(9, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ch_clients`
--
ALTER TABLE `ch_clients`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_general`
--
ALTER TABLE `ch_general`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_groups`
--
ALTER TABLE `ch_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_login_attempts`
--
ALTER TABLE `ch_login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_users`
--
ALTER TABLE `ch_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_users_groups`
--
ALTER TABLE `ch_users_groups`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ch_clients`
--
ALTER TABLE `ch_clients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ch_general`
--
ALTER TABLE `ch_general`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ch_groups`
--
ALTER TABLE `ch_groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ch_login_attempts`
--
ALTER TABLE `ch_login_attempts`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ch_users`
--
ALTER TABLE `ch_users`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ch_users_groups`
--
ALTER TABLE `ch_users_groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
