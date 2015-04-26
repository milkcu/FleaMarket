-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-04-07 16:13:06
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aptana`
--

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_categories`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_categories` (
`cid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `detail` text NOT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `topics` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sdnuflea_categories`
--

INSERT INTO `sdnuflea_categories` (`cid`, `name`, `detail`, `icon`, `topics`) VALUES
(1, '图书教材', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', '2015040623114466-3.jpg', 0),
(2, '手机数码', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', '2015040623124922-3.jpg', 0),
(3, '电脑配件', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', '2015040623132839-3.jpg', 0),
(4, '运动户外', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', '2015040623135672-3.jpg', 0),
(5, '衣物百货', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', '2015040623142677-3.jpg', 0),
(6, '生活娱乐', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', '2015040623150168-3.jpg', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_groups`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_groups` (
`id` int(11) NOT NULL,
  `name` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sdnuflea_groups`
--

INSERT INTO `sdnuflea_groups` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Public'),
(3, 'Default');

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_perms`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_perms` (
`id` int(11) NOT NULL,
  `name` text,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_perm_to_group`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_perm_to_group` (
`id` int(11) NOT NULL,
  `perm_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_perm_to_user`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_perm_to_user` (
`id` int(11) NOT NULL,
  `perm_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_pms`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_pms` (
`id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text,
  `date` datetime DEFAULT NULL,
  `read` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 表的结构 `sdnuflea_products`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_products` (
`pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `detail` text NOT NULL,
  `original` float NOT NULL,
  `current` float NOT NULL,
  `place` varchar(128) NOT NULL,
  `images` text,
  `created` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `follows` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '0',
  `isdel` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(16) DEFAULT NULL,
  `ua` varchar(128) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

--
-- 表的结构 `sdnuflea_sdnuinfo`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_sdnuinfo` (
  `uid` int(11) NOT NULL,
  `user_id` varchar(16) NOT NULL,
  `user_type` int(11) NOT NULL,
  `bind_cellphone` varchar(16) DEFAULT NULL,
  `bind_email` varchar(32) DEFAULT NULL,
  `id_card_number_hash` varchar(64) NOT NULL,
  `identity_number` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `sex` varchar(32) NOT NULL,
  `nation` varchar(32) NOT NULL,
  `organization_id` varchar(16) NOT NULL,
  `organization_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_system_variables`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_system_variables` (
`id` int(11) NOT NULL,
  `key` text NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_users`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_users` (
`id` int(11) NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `name` text,
  `banned` int(11) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `ip_address` text,
  `login_attempts` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sdnuflea_users`
--

INSERT INTO `sdnuflea_users` (`id`, `email`, `pass`, `name`, `banned`, `last_login`, `last_activity`, `last_login_attempt`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `ip_address`, `login_attempts`, `created_on`) VALUES
(1, 'admin@admin.com', 'dd5073c93fb477a167fd69072e95455834acd93df8fed41a2c468c45b394bfe3', 'Admin', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2015-04-01 17:33:56');

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_user_to_group`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_user_to_group` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sdnuflea_user_to_group`
--

INSERT INTO `sdnuflea_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3);

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_user_variables`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_user_variables` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` text NOT NULL,
  `value` text
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sdnuflea_categories`
--
ALTER TABLE `sdnuflea_categories`
 ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `sdnuflea_groups`
--
ALTER TABLE `sdnuflea_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `id_index` (`id`);

--
-- Indexes for table `sdnuflea_perms`
--
ALTER TABLE `sdnuflea_perms`
 ADD PRIMARY KEY (`id`), ADD KEY `id_index` (`id`);

--
-- Indexes for table `sdnuflea_perm_to_group`
--
ALTER TABLE `sdnuflea_perm_to_group`
 ADD PRIMARY KEY (`id`), ADD KEY `perm_id_group_id_index` (`perm_id`,`group_id`);

--
-- Indexes for table `sdnuflea_perm_to_user`
--
ALTER TABLE `sdnuflea_perm_to_user`
 ADD PRIMARY KEY (`id`), ADD KEY `perm_id_user_id_index` (`perm_id`,`user_id`);

--
-- Indexes for table `sdnuflea_pms`
--
ALTER TABLE `sdnuflea_pms`
 ADD PRIMARY KEY (`id`), ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`read`);

--
-- Indexes for table `sdnuflea_products`
--
ALTER TABLE `sdnuflea_products`
 ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `sdnuflea_sdnuinfo`
--
ALTER TABLE `sdnuflea_sdnuinfo`
 ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `sdnuflea_system_variables`
--
ALTER TABLE `sdnuflea_system_variables`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdnuflea_users`
--
ALTER TABLE `sdnuflea_users`
 ADD PRIMARY KEY (`id`), ADD KEY `id_index` (`id`);

--
-- Indexes for table `sdnuflea_user_to_group`
--
ALTER TABLE `sdnuflea_user_to_group`
 ADD PRIMARY KEY (`user_id`,`group_id`), ADD KEY `user_id_group_id_index` (`user_id`,`group_id`);

--
-- Indexes for table `sdnuflea_user_variables`
--
ALTER TABLE `sdnuflea_user_variables`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sdnuflea_categories`
--
ALTER TABLE `sdnuflea_categories`
MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sdnuflea_groups`
--
ALTER TABLE `sdnuflea_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sdnuflea_perms`
--
ALTER TABLE `sdnuflea_perms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sdnuflea_perm_to_group`
--
ALTER TABLE `sdnuflea_perm_to_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sdnuflea_perm_to_user`
--
ALTER TABLE `sdnuflea_perm_to_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sdnuflea_pms`
--
ALTER TABLE `sdnuflea_pms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sdnuflea_products`
--
ALTER TABLE `sdnuflea_products`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `sdnuflea_system_variables`
--
ALTER TABLE `sdnuflea_system_variables`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sdnuflea_users`
--
ALTER TABLE `sdnuflea_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sdnuflea_user_variables`
--
ALTER TABLE `sdnuflea_user_variables`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
