/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50711
 Source Host           : localhost
 Source Database       : slackbotdemo

 Target Server Type    : MySQL
 Target Server Version : 50711
 File Encoding         : utf-8

 Date: 09/23/2017 16:38:04 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_date` datetime NOT NULL,
  `speakers` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `events`
-- ----------------------------
BEGIN;
INSERT INTO `events` VALUES ('1', 'Bot Party', '2017-09-23 23:00:50', '[{\n	\"name\": \"Omolara Adejuwon\",\n	\"title\": \"Building slackbots\"\n}, {\n	\"name\": \"Jedidah Alagbe\",\n	\"title\": \"Design thinking\"\n}, {\n	\"name\": \"Ada Nyom\",\n	\"title\": \"Building facebook bots\"\n}] '), ('2', 'Another Event', '2017-09-29 21:51:31', ' [{\n	\"name\": \"Omolara Adejuwon\",\n	\"title\": \"Building slackbots\"\n}, {\n	\"name\": \"Jedidah Alagbe\",\n	\"title\": \"Design thinking\"\n}, {\n	\"name\": \"Ada Nyom\",\n	\"title\": \"Building facebook bots\"\n}]'), ('3', 'Old event', '2017-09-19 21:52:26', '[{\n	\"name\": \"Omolara Adejuwon\",\n	\"title\": \"Building slackbots\"\n}, {\n	\"name\": \"Jedidah Alagbe\",\n	\"title\": \"Design thinking\"\n}, {\n	\"name\": \"Ada Nyom\",\n	\"title\": \"Building facebook bots\"\n}]');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
