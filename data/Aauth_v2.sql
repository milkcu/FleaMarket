/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : sdnuflea_v2_dev

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-07-03 21:23:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `sdnuflea_groups`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_groups`;
CREATE TABLE `sdnuflea_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`),
  KEY `id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_groups
-- ----------------------------
INSERT INTO `sdnuflea_groups` VALUES ('1', 'Admin');
INSERT INTO `sdnuflea_groups` VALUES ('2', 'Public');
INSERT INTO `sdnuflea_groups` VALUES ('3', 'Default');

-- ----------------------------
-- Table structure for `sdnuflea_perms`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_perms`;
CREATE TABLE `sdnuflea_perms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `definition` text,
  PRIMARY KEY (`id`),
  KEY `id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_perms
-- ----------------------------

-- ----------------------------
-- Table structure for `sdnuflea_perm_to_group`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_perm_to_group`;
CREATE TABLE `sdnuflea_perm_to_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perm_id_group_id_index` (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_perm_to_group
-- ----------------------------

-- ----------------------------
-- Table structure for `sdnuflea_perm_to_user`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_perm_to_user`;
CREATE TABLE `sdnuflea_perm_to_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perm_id_user_id_index` (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_perm_to_user
-- ----------------------------

-- ----------------------------
-- Table structure for `sdnuflea_pms`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_pms`;
CREATE TABLE `sdnuflea_pms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text,
  `date` datetime DEFAULT NULL,
  `read` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_pms
-- ----------------------------

-- ----------------------------
-- Table structure for `sdnuflea_system_variables`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_system_variables`;
CREATE TABLE `sdnuflea_system_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` text NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_system_variables
-- ----------------------------

-- ----------------------------
-- Table structure for `sdnuflea_users`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_users`;
CREATE TABLE `sdnuflea_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8_general_ci NOT NULL,
  `pass` text COLLATE utf8_general_ci NOT NULL,
  `name` text COLLATE utf8_general_ci,
  `banned` int(11) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text COLLATE utf8_general_ci,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text COLLATE utf8_general_ci,
  `verification_code` text COLLATE utf8_general_ci,
  `ip_address` text COLLATE utf8_general_ci,
  `login_attempts` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of sdnuflea_users
-- ----------------------------
INSERT INTO `sdnuflea_users` VALUES ('1', 'admin@admin.com', 'dd5073c93fb477a167fd69072e95455834acd93df8fed41a2c468c45b394bfe3', 'Admin', '0', null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `sdnuflea_user_to_group`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_user_to_group`;
CREATE TABLE `sdnuflea_user_to_group` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `user_id_group_id_index` (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_user_to_group
-- ----------------------------
INSERT INTO `sdnuflea_user_to_group` VALUES ('1', '1');
INSERT INTO `sdnuflea_user_to_group` VALUES ('1', '3');

-- ----------------------------
-- Table structure for `sdnuflea_user_variables`
-- ----------------------------
DROP TABLE IF EXISTS `sdnuflea_user_variables`;
CREATE TABLE `sdnuflea_user_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` text NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sdnuflea_user_variables
-- ----------------------------
