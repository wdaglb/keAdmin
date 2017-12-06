-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-07 00:02:29
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
  `group_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ke_admin`
--

INSERT INTO `ke_admin` (`id`, `user`, `pass`, `private`, `token`, `group_id`, `create_time`, `update_time`) VALUES
(1, 'admin', 'd531dc34c3375fe241afdb4104528423', 'c9csijw5pi', '59c8c7aa51e45e778f48dfaba52905fa', 4, 1512359668, 1512576124),
(2, 'wdaglb', 'fa0c9b4d94cb1c15a019de4e6ae3944a', 'uheqhx9zc8', '', 4, 0, 0),
(3, 'admins', '14f0aead929248e2947f13911952e186', '8qzmmsuuuz', '', 4, 0, 1512565097),
(5, 'admin0', 'a', '', '', 5, 1512567061, 0),
(6, 'admin1', 'a', '', '', 5, 1512567061, 0),
(7, 'admin2', 'a', '', '', 5, 1512567061, 0),
(8, 'admin3', 'a', '', '', 5, 1512567061, 0),
(9, 'admin4', 'a', '', '', 5, 1512567061, 0),
(10, 'admin5', 'a', '', '', 5, 1512567061, 0),
(11, 'admin6', 'a', '', '', 5, 1512567061, 0),
(12, 'admin7', 'a', '', '', 5, 1512567061, 0),
(13, 'admin8', 'a', '', '', 5, 1512567061, 0),
(14, 'admin9', 'a', '', '', 5, 1512567061, 0),
(15, 'admin10', 'a', '', '', 5, 1512567061, 0),
(16, 'admin11', 'a', '', '', 5, 1512567061, 0),
(17, 'admin12', 'a', '', '', 5, 1512567061, 0),
(18, 'admin13', 'a', '', '', 5, 1512567061, 0),
(19, 'admin14', 'a', '', '', 5, 1512567061, 0),
(20, 'admin15', 'a', '', '', 5, 1512567061, 0),
(21, 'admin16', 'a', '', '', 5, 1512567061, 0),
(22, 'admin17', 'a', '', '', 5, 1512567061, 0),
(23, 'admin18', 'a', '', '', 5, 1512567061, 0),
(24, 'admin19', 'a', '', '', 5, 1512567061, 0),
(25, 'admin20', 'a', '', '', 5, 1512567061, 0),
(26, 'admin21', 'a', '', '', 5, 1512567061, 0),
(27, 'admin22', 'a', '', '', 5, 1512567061, 0),
(28, 'admin23', 'a', '', '', 5, 1512567061, 0),
(29, 'admin24', 'a', '', '', 5, 1512567061, 0),
(30, 'admin25', 'a', '', '', 5, 1512567061, 0),
(31, 'admin26', 'a', '', '', 5, 1512567061, 0),
(32, 'admin27', 'a', '', '', 5, 1512567061, 0),
(33, 'admin28', 'a', '', '', 5, 1512567061, 0),
(34, 'admin29', 'a', '', '', 5, 1512567061, 0),
(35, 'admin30', 'a', '', '', 5, 1512567061, 0),
(36, 'admin31', 'a', '', '', 5, 1512567061, 0),
(37, 'admin32', 'a', '', '', 5, 1512567061, 0),
(38, 'admin33', 'a', '', '', 5, 1512567061, 0),
(39, 'admin34', 'a', '', '', 5, 1512567061, 0),
(40, 'admin35', 'a', '', '', 5, 1512567061, 0),
(41, 'admin36', 'a', '', '', 5, 1512567061, 0),
(42, 'admin37', 'a', '', '', 5, 1512567061, 0),
(43, 'admin38', 'a', '', '', 5, 1512567061, 0),
(44, 'admin39', 'a', '', '', 5, 1512567061, 0),
(45, 'admin40', 'a', '', '', 5, 1512567061, 0),
(46, 'admin41', 'a', '', '', 5, 1512567061, 0),
(47, 'admin42', 'a', '', '', 5, 1512567061, 0),
(48, 'admin43', 'a', '', '', 5, 1512567061, 0),
(49, 'admin44', 'a', '', '', 5, 1512567061, 0),
(50, 'admin45', 'a', '', '', 5, 1512567061, 0),
(51, 'admin46', 'a', '', '', 5, 1512567061, 0),
(52, 'admin47', 'a', '', '', 5, 1512567061, 0),
(53, 'admin48', 'a', '', '', 5, 1512567061, 0),
(54, 'admin49', 'a', '', '', 5, 1512567061, 0),
(55, 'admin50', 'a', '', '', 5, 1512567061, 0),
(56, 'admin51', 'a', '', '', 5, 1512567061, 0),
(57, 'admin52', 'a', '', '', 5, 1512567061, 0),
(58, 'admin53', 'a', '', '', 5, 1512567061, 0),
(59, 'admin54', 'a', '', '', 5, 1512567061, 0),
(60, 'admin55', 'a', '', '', 5, 1512567061, 0),
(61, 'admin56', 'a', '', '', 5, 1512567061, 0),
(62, 'admin57', 'a', '', '', 5, 1512567061, 0),
(63, 'admin58', 'a', '', '', 5, 1512567061, 0),
(64, 'admin59', 'a', '', '', 5, 1512567061, 0),
(65, 'admin60', 'a', '', '', 5, 1512567061, 0),
(66, 'admin61', 'a', '', '', 5, 1512567061, 0),
(67, 'admin62', 'a', '', '', 5, 1512567061, 0),
(68, 'admin63', 'a', '', '', 5, 1512567061, 0),
(69, 'admin64', 'a', '', '', 5, 1512567061, 0),
(70, 'admin65', 'a', '', '', 5, 1512567061, 0),
(71, 'admin66', 'a', '', '', 5, 1512567061, 0),
(72, 'admin67', 'a', '', '', 5, 1512567061, 0),
(73, 'admin68', 'a', '', '', 5, 1512567061, 0),
(74, 'admin69', 'a', '', '', 5, 1512567061, 0),
(75, 'admin70', 'a', '', '', 5, 1512567061, 0),
(76, 'admin71', 'a', '', '', 5, 1512567061, 0),
(77, 'admin72', 'a', '', '', 5, 1512567061, 0),
(78, 'admin73', 'a', '', '', 5, 1512567061, 0),
(79, 'admin74', 'a', '', '', 5, 1512567061, 0),
(80, 'admin75', 'a', '', '', 5, 1512567061, 0),
(81, 'admin76', 'a', '', '', 5, 1512567061, 0),
(82, 'admin77', 'a', '', '', 5, 1512567061, 0),
(83, 'admin78', 'a', '', '', 5, 1512567061, 0),
(84, 'admin79', 'a', '', '', 5, 1512567061, 0),
(85, 'admin80', 'a', '', '', 5, 1512567061, 0),
(86, 'admin81', 'a', '', '', 5, 1512567061, 0),
(87, 'admin82', 'a', '', '', 5, 1512567061, 0),
(88, 'admin83', 'a', '', '', 5, 1512567061, 0),
(89, 'admin84', 'a', '', '', 5, 1512567061, 0),
(90, 'admin85', 'a', '', '', 5, 1512567061, 0),
(91, 'admin86', 'a', '', '', 5, 1512567061, 0),
(92, 'admin87', 'a', '', '', 5, 1512567061, 0),
(93, 'admin88', 'a', '', '', 5, 1512567061, 0),
(94, 'admin89', 'a', '', '', 5, 1512567061, 0),
(95, 'admin90', 'a', '', '', 5, 1512567061, 0),
(96, 'admin91', 'a', '', '', 5, 1512567061, 0),
(97, 'admin92', 'a', '', '', 5, 1512567061, 0),
(98, 'admin93', 'a', '', '', 5, 1512567061, 0),
(99, 'admin94', 'a', '', '', 5, 1512567061, 0),
(100, 'admin95', 'a', '', '', 5, 1512567061, 0),
(101, 'admin96', 'a', '', '', 5, 1512567061, 0),
(102, 'admin97', 'a', '', '', 5, 1512567061, 0),
(103, 'admin98', 'a', '', '', 5, 1512567061, 0),
(104, 'admin99', 'a', '', '', 5, 1512567061, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ke_admin_group`
--

INSERT INTO `ke_admin_group` (`id`, `parent_id`, `name`, `content`, `create_time`, `update_time`, `valid`) VALUES
(1, 0, 'w', '', 0, 0, 0),
(2, 0, 'xs', '', 0, 0, 0),
(4, 0, 'qqqqqqqq', '', 1512446705, 1512446705, 0),
(5, 0, '测试', '', 1512538949, 1512538949, 0),
(6, 0, '测试w', '', 1512538974, 1512538974, 0),
(7, 0, 'qa', '', 1512539050, 1512539050, 0),
(8, 0, 'qar', '', 1512539099, 1512539099, 0),
(9, 0, 'q', '', 1512539373, 1512539373, 0),
(10, 6, 'qwe', '', 1512539408, 1512539408, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ke_admin_role`
--

CREATE TABLE IF NOT EXISTS `ke_admin_role` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ke_admin_role`
--

INSERT INTO `ke_admin_role` (`id`, `group_id`, `name`, `content`) VALUES
(4, 0, '管理员', ''),
(5, 0, '15', ''),
(6, 0, '5', ''),
(7, 1, '50', '');

-- --------------------------------------------------------

--
-- 表的结构 `ke_admin_rule`
--

CREATE TABLE IF NOT EXISTS `ke_admin_rule` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '绑定URL',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '规则中文名',
  `controller` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '规则'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ke_admin_rule`
--

INSERT INTO `ke_admin_rule` (`id`, `parent_id`, `name`, `title`, `controller`) VALUES
(1, 0, 'sys', '系统', ''),
(2, 1, 'setting/system', '系统设置', 'setting/system'),
(3, 1, 'auth.group/lists', '权限设置', 'auth.group/*'),
(4, 1, 'auth.manage/lists', '管理员管理', 'auth.manage/*'),
(5, 1, 'auth.log/lists', '日志管理', 'auth.log/*');

-- --------------------------------------------------------

--
-- 表的结构 `ke_admin_rule_access`
--

CREATE TABLE IF NOT EXISTS `ke_admin_rule_access` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `rule_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ke_admin_rule_access`
--

INSERT INTO `ke_admin_rule_access` (`role_id`, `rule_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5);

-- --------------------------------------------------------

--
-- 表的结构 `ke_site`
--

CREATE TABLE IF NOT EXISTS `ke_site` (
  `id` int(11) NOT NULL,
  `use` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '站点状态',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '站点标题',
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `ke_admin_role`
--
ALTER TABLE `ke_admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ke_admin_rule`
--
ALTER TABLE `ke_admin_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ke_site`
--
ALTER TABLE `ke_site`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ke_admin`
--
ALTER TABLE `ke_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `ke_admin_group`
--
ALTER TABLE `ke_admin_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ke_admin_role`
--
ALTER TABLE `ke_admin_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ke_admin_rule`
--
ALTER TABLE `ke_admin_rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ke_site`
--
ALTER TABLE `ke_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
