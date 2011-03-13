-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2011 at 12:06 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `zfcms`
--
CREATE DATABASE `zfcms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `zfcms`;

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE IF NOT EXISTS `bugs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `description` text,
  `priority` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `author`, `email`, `date`, `url`, `description`, `priority`, `status`) VALUES
(1, 'V Natarajan', 'natrajv@yahoo.com', 917893800, 'http://localhost/brass', 'Nothing to describe!xww\r\nzzz', 'low', 'new'),
(2, 'MJ Gireesh', 'gireeshmj@yahoo.com', 917893800, 'http://localhost/brass', 'Something to describe!\r\nand now it is edited!exx', 'high', 'new'),
(3, 'R Rajagopal', 'rrgopal@yahoo.com', 917893800, 'http://localhost/brass', 'Something to describe!', 'high', 'new'),
(5, 'Jittu', 'jittu@jittu.in', 917893800, 'http://localhost/brass', 'Tseting', 'low', 'new'),
(6, 'Jittu', 'jittu@jittu.in', 946665000, 'http://localhost/brass', 'Testing _forward\r\nlll', 'high', 'in_progress');
