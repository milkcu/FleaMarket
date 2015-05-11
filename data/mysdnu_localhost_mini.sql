-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015-05-11 11:36:40
-- 服务器版本: 5.5.43-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mysdnu`
--

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_categories`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `detail` text NOT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `topics` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `sdnuflea_categories`
--

INSERT INTO `sdnuflea_categories` (`cid`, `name`, `detail`, `icon`, `topics`) VALUES
(1, '图书教材', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', 'mysdnu-index-category-1.jpg', 0),
(2, '手机数码', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', 'mysdnu-index-category-2.jpg', 0),
(3, '生活娱乐', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', 'mysdnu-index-category-6.jpg', 0),
(4, '运动户外', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', 'mysdnu-index-category-4.jpg', 0),
(5, '衣物百货', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', 'mysdnu-index-category-5.jpg', 0),
(6, '其他分类', '这里是分类描述，可以简短描述一下。这里是分类描述，可以简短描述一下。', 'mysdnu-index-category-3.jpg', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_groups`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`),
  KEY `id_index` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sdnuflea_groups`
--

INSERT INTO `sdnuflea_groups` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Public'),
(3, 'Default');

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_orders`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `fromid` int(11) NOT NULL,
  `toid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `logs` text,
  `payment` varchar(16) NOT NULL,
  `delivery` varchar(16) NOT NULL,
  `receiver` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `remark` text NOT NULL,
  `state` varchar(16) NOT NULL,
  `comment` text,
  `ip` varchar(16) DEFAULT NULL,
  `ua` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_perms`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_perms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `definition` text,
  PRIMARY KEY (`id`),
  KEY `id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_perm_to_group`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_perm_to_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perm_id_group_id_index` (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_perm_to_user`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_perm_to_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perm_id_user_id_index` (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_pms`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_pms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text,
  `date` datetime DEFAULT NULL,
  `isread` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`isread`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_products`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
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
  `ua` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_system_variables`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_system_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` text NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_users`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_index` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `sdnuflea_users`
--

INSERT INTO `sdnuflea_users` (`id`, `email`, `pass`, `name`, `banned`, `last_login`, `last_activity`, `last_login_attempt`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `ip_address`, `login_attempts`, `created_on`) VALUES
(1, 'admin@admin.com', 'dd5073c93fb477a167fd69072e95455834acd93df8fed41a2c468c45b394bfe3', 'Admin', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2015-04-01 17:33:56'),
(3, 'milkcu@163.com', 'c5b93c7e00ac43e89eeb59f111eabb2a5d4a337ca8a87baa2072327d0c0f6dee', '201101110407', 0, '2015-05-11 10:26:36', '2015-05-11 10:26:36', '2015-05-11 10:00:00', NULL, NULL, NULL, NULL, '127.0.0.1', NULL, '2015-04-01 17:33:56');

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_user_to_group`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_user_to_group` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `user_id_group_id_index` (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sdnuflea_user_to_group`
--

INSERT INTO `sdnuflea_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 3),
(2, 3),
(3, 1),
(3, 3);

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_user_variables`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_user_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` text NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `sdnuflea_user_variables`
--

INSERT INTO `sdnuflea_user_variables` (`id`, `user_id`, `key`, `value`) VALUES
(1, 3, 'contact', '{"email":"milkcu@163.com","phone":"18353115149","qq":"184324224","public":["phone"]}'),
(2, 3, 'sdnuinfo', '{"user_id":"201101110407","user_type":0,"bind_cellphone":null,"bind_email":"mil***@163.com","identity_number":"201101110407","name":"\\u5218\\u65b0\\u6850","id_card_number_hash":"F7CA217765329B6BB4ACC75A262271CB17F5A3F2","sex":"\\u7537","nation":"\\u6c49\\u65cf","organization_id":"010310","organization_name":"\\u4fe1\\u606f\\u79d1\\u5b66\\u4e0e\\u5de5\\u7a0b\\u5b66\\u9662"}'),
(8, 3, 'avatar', 'Fq6cIBDtHYmrG3Ei-FK5v7EQSBQR');

-- --------------------------------------------------------

--
-- 表的结构 `sdnuflea_wants`
--

CREATE TABLE IF NOT EXISTS `sdnuflea_wants` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `comment` text,
  `views` int(11) NOT NULL DEFAULT '0',
  `state` varchar(16) NOT NULL,
  `ip` int(11) DEFAULT NULL,
  `ua` int(11) DEFAULT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
