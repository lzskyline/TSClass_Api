/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tsclass

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-14 23:47:44
*/

SET FOREIGN_KEY_CHECKS=0;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_course
-- ----------------------------
INSERT INTO `tsc_course` VALUES ('1', 'JAVA课程设计', '0', '1', '描述描述,不可描述', '1.jpg');

-- ----------------------------
-- Table structure for `tsc_selected`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_selected`;
CREATE TABLE `tsc_selected` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `cid` int(6) NOT NULL,
  `sid` int(6) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_selected
-- ----------------------------
INSERT INTO `tsc_selected` VALUES ('1', '1', '1', null);

-- ----------------------------
-- Table structure for `tsc_student`
-- ----------------------------
DROP TABLE IF EXISTS `tsc_student`;
CREATE TABLE `tsc_student` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_teacher
-- ----------------------------
INSERT INTO `tsc_teacher` VALUES ('1', 'teacher', 'e10adc3949ba59abbe56e057f20f883e');
