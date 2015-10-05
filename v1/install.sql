-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2011 at 05:26 下午
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clientmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` text,
  `case` text,
  `photo` text,
  `photoext` text,
  `name` text,
  `ic` text,
  `gender` enum('male','female') DEFAULT NULL,
  `placeofbirth` text,
  `education` text,
  `language` text,
  `race` text,
  `faith` text,
  `maritalstatus` text,
  `nationality` text,
  `profession` text,
  `address` text,
  `epf` text,
  `banker` text,
  `contactno` text,
  `email` text,
  `platesno` text,
  `assets` text,
  `height` decimal(10,0) DEFAULT NULL,
  `weight` decimal(10,0) DEFAULT NULL,
  `blood` enum('O+','A+','B+','AB+','O-','A-','B-','AB-') DEFAULT NULL,
  `eye` text,
  `hair` text,
  `skin` text,
  `dna` text,
  `casereport` text,
  `wife` text,
  `childs` text,
  `family` text,
  `company` text,
  `remarks` text,
  `status` text NOT NULL,
  `lastupdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;