-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2016 at 05:34 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socshare`
--
CREATE DATABASE IF NOT EXISTS `socshare` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `socshare`;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `gid` int(16) NOT NULL AUTO_INCREMENT,
  `uid` int(16) NOT NULL,
  `gname` text NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gid`, `uid`, `gname`) VALUES
(2, 1, 'diidi');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msgId` int(16) NOT NULL AUTO_INCREMENT,
  `uidSender` int(16) NOT NULL,
  `uidReceiver` int(16) NOT NULL,
  `Recname` text NOT NULL,
  `Message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgId`, `uidSender`, `uidReceiver`, `Recname`, `Message`, `time`) VALUES
(1, 2, 1, 'karuna', 'hello', '2016-02-18 05:30:12'),
(2, 2, 1, 'karuna', 'hello', '2016-02-18 05:30:12'),
(3, 1, 2, 'Varun', 'lol', '2016-02-18 05:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(16) NOT NULL AUTO_INCREMENT,
  `uid` int(16) NOT NULL,
  `name` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `uid`, `name`, `message`) VALUES
(1, 1, 'Varun', 'Nothing much');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `username` text NOT NULL,
  `Password` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `username`, `Password`, `email`) VALUES
(1, 'Varun', 'dvarun', '25d55ad283aa400af464c76d713c07ad', 'dvarun@hotmail.com'),
(2, 'karuna', 'karuna', 'e10adc3949ba59abbe56e057f20f883e', 'karuna@lol.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE IF NOT EXISTS `user_admin` (
  `aid` int(16) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`aid`, `user`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
