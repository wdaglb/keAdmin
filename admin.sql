-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-06 19:07:10
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
(1, 'admin', 'd531dc34c3375fe241afdb4104528423', 'c9csijw5pi', '2e8488106f5103e09a713b7b996fe447', 0, 0, 1512359668, 1512550330);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 5);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ke_admin_group`
--
ALTER TABLE `ke_admin_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ke_admin_role`
--
ALTER TABLE `ke_admin_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
