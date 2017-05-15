/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tsclass

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-15 22:03:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tsc_answered`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_answered`;
CREATE TABLE `tsc_answered` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `sid` int(6) NOT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `cid` int(6) NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_answered
-- ----------------------------
INSERT INTO `tsc_answered` VALUES ('1', 'wenti', '1', 'daan', '1', '2017-05-15 14:44:37');

-- ----------------------------
-- Table structure for `tsc_course`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_course`;
CREATE TABLE `tsc_course` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 NOT NULL,
  `allowed` tinyint(1) NOT NULL DEFAULT '0',
  `tid` int(6) NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique course` (`title`,`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_course
-- ----------------------------
INSERT INTO `tsc_course` VALUES ('1', 'JAVA课程设计', '0', '1', '描述描述,不可描述', '1.jpg');

-- ----------------------------
-- Table structure for `tsc_notice`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_notice`;
CREATE TABLE `tsc_notice` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `cid` int(6) NOT NULL,
  `content` varchar(50) NOT NULL,
  `sid` int(6) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_notice
-- ----------------------------
INSERT INTO `tsc_notice` VALUES ('1', '1', '全部同学 通知通知!', '0', '2017-05-15 15:22:58');

-- ----------------------------
-- Table structure for `tsc_selected`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_selected`;
CREATE TABLE `tsc_selected` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `cid` int(6) NOT NULL,
  `sid` int(6) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique selected` (`cid`,`sid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_selected
-- ----------------------------
INSERT INTO `tsc_selected` VALUES ('1', '1', '1', '2017-05-15 14:20:35');

-- ----------------------------
-- Table structure for `tsc_student`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_student`;
CREATE TABLE `tsc_student` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_student
-- ----------------------------
INSERT INTO `tsc_student` VALUES ('1', 'test', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `tsc_student` VALUES ('2', 'student', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for `tsc_teacher`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_teacher`;
CREATE TABLE `tsc_teacher` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_teacher
-- ----------------------------
INSERT INTO `tsc_teacher` VALUES ('1', 'teacher', 'e10adc3949ba59abbe56e057f20f883e');
