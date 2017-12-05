-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-05 18:29:06
-- 服务器版本： 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `ke_admin`
--

CREATE TABLE IF NOT EXISTS `ke_admin` (
  `id` int(11) NOT NULL,
  `user` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `private` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ke_admin`
--

INSERT INTO `ke_admin` (`id`, `user`, `pass`, `private`, `token`, `role_id`, `group_id`, `create_time`, `update_time`) VALUES
(1, 'admin', 'd531dc34c3375fe241afdb4104528423', 'c9csijw5pi', 'c2e88b51ded2705d44b18fd5c1c5a7ee', 0, 0, 1512359668, 1512469705);

-- --------------------------------------------------------

--
-- 表的结构 `ke_admin_group`
--

CREATE TABLE IF NOT EXISTS `ke_admin_group` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `valid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ke_admin_group`
--

INSERT INTO `ke_admin_group` (`id`, `parent_id`, `name`, `content`, `create_time`, `update_time`, `valid`) VALUES
(1, 0, 'w', '', 0, 0, 0),
(2, 0, 'xs', '', 0, 0, 0),
(3, 0, 'xxx', '', 1512445457, 1512445457, 0),
(4, 0, 'qqqqqqqq', '', 1512446705, 1512446705, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ke_admin`
--
ALTER TABLE `ke_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ke_admin_group`
--
ALTER TABLE `ke_admin_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ke_admin`
--
ALTER TABLE `ke_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ke_admin_group`
--
ALTER TABLE `ke_admin_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
