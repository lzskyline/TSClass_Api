/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : tsclass

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2017-06-07 19:07:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tsc_answered
-- ----------------------------
DROP TABLE IF EXISTS `tsc_answered`;
CREATE TABLE `tsc_answered` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `sid` int(6) NOT NULL,
  `answer` varchar(255) NOT NULL DEFAULT '',
  `cid` int(6) NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `existed cid` (`cid`),
  KEY `existed sid` (`sid`),
  CONSTRAINT `existed cid` FOREIGN KEY (`cid`) REFERENCES `tsc_course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `existed sid` FOREIGN KEY (`sid`) REFERENCES `tsc_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_answered
-- ----------------------------
INSERT INTO `tsc_answered` VALUES ('1', 'wenti', '1', '', '1', '2017-05-15 14:44:37');
INSERT INTO `tsc_answered` VALUES ('2', '问题问题', '2', '', '1', '2017-05-16 17:12:29');
INSERT INTO `tsc_answered` VALUES ('3', '问题问题', '1', '', '1', '2017-05-21 23:31:04');

-- ----------------------------
-- Table structure for tsc_chapter
-- ----------------------------
DROP TABLE IF EXISTS `tsc_chapter`;
CREATE TABLE `tsc_chapter` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `cid` int(6) NOT NULL,
  `title` varchar(20) NOT NULL,
  `pid` int(6) NOT NULL DEFAULT '0',
  `rank` smallint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `existed course` (`cid`),
  CONSTRAINT `existed course` FOREIGN KEY (`cid`) REFERENCES `tsc_course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_chapter
-- ----------------------------
INSERT INTO `tsc_chapter` VALUES ('1', '1', '序章', '0', '0');
INSERT INTO `tsc_chapter` VALUES ('2', '1', '简述', '0', '0');
INSERT INTO `tsc_chapter` VALUES ('3', '1', '入门', '0', '0');
INSERT INTO `tsc_chapter` VALUES ('4', '1', '精通', '0', '0');
INSERT INTO `tsc_chapter` VALUES ('5', '1', '实战', '0', '0');
INSERT INTO `tsc_chapter` VALUES ('6', '1', '序章1小节', '1', '0');
INSERT INTO `tsc_chapter` VALUES ('7', '1', '入门1小节', '3', '0');
INSERT INTO `tsc_chapter` VALUES ('8', '1', '入门2小节', '3', '0');
INSERT INTO `tsc_chapter` VALUES ('9', '2', '测测测', '0', '0');
INSERT INTO `tsc_chapter` VALUES ('15', '1', '1313', '14', '0');
INSERT INTO `tsc_chapter` VALUES ('17', '2', '444', '9', '0');

-- ----------------------------
-- Table structure for tsc_course
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_course
-- ----------------------------
INSERT INTO `tsc_course` VALUES ('1', 'JAVA课程设计', '1', '1', '描述描述,不可描述', '1.jpg');
INSERT INTO `tsc_course` VALUES ('2', 'JAVA面向对象设计', '0', '1', '描述JAVA', '5921718db3491.jpg');

-- ----------------------------
-- Table structure for tsc_courseware
-- ----------------------------
DROP TABLE IF EXISTS `tsc_courseware`;
CREATE TABLE `tsc_courseware` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pid` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_courseware
-- ----------------------------
INSERT INTO `tsc_courseware` VALUES ('1', '序章课件', 'http://baidu.com/', '6');
INSERT INTO `tsc_courseware` VALUES ('2', '百度', 'http://baidu.com/', '7');

-- ----------------------------
-- Table structure for tsc_homework
-- ----------------------------
DROP TABLE IF EXISTS `tsc_homework`;
CREATE TABLE `tsc_homework` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `question` varchar(100) NOT NULL DEFAULT '',
  `choices` varchar(200) NOT NULL DEFAULT '',
  `answer` smallint(1) NOT NULL DEFAULT '0',
  `pid` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_homework
-- ----------------------------
INSERT INTO `tsc_homework` VALUES ('1', '这个问题的正确答案是选择2,你选哪个?', '选择1\r\n选择2\r\n选择3\r\n选择4', '1', '6');

-- ----------------------------
-- Table structure for tsc_notice
-- ----------------------------
DROP TABLE IF EXISTS `tsc_notice`;
CREATE TABLE `tsc_notice` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `cid` int(6) NOT NULL,
  `content` varchar(50) NOT NULL,
  `sid` int(6) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique notice` (`cid`,`content`,`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_notice
-- ----------------------------
INSERT INTO `tsc_notice` VALUES ('1', '1', '全部同学 通知通知!', '0', '2017-05-15 15:22:58');
INSERT INTO `tsc_notice` VALUES ('2', '2', '开始签到', '0', '2017-05-24 07:57:24');
INSERT INTO `tsc_notice` VALUES ('3', '1', '老师发布了新的作业', '0', '2017-05-24 08:03:48');
INSERT INTO `tsc_notice` VALUES ('4', '1', '老师发布了新的课件', '0', '2017-05-24 08:04:09');

-- ----------------------------
-- Table structure for tsc_punch
-- ----------------------------
DROP TABLE IF EXISTS `tsc_punch`;
CREATE TABLE `tsc_punch` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `sid` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `existed course` (`cid`),
  KEY `existed student` (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_punch
-- ----------------------------
INSERT INTO `tsc_punch` VALUES ('1', '2', '1', '2017-05-14 16:35:51');
INSERT INTO `tsc_punch` VALUES ('2', '2', '2', '2017-05-15 17:35:57');
INSERT INTO `tsc_punch` VALUES ('3', '2', '1', '2017-05-16 15:36:00');
INSERT INTO `tsc_punch` VALUES ('4', '1', '1', '2017-05-16 17:36:03');
INSERT INTO `tsc_punch` VALUES ('5', '1', '2', '2017-05-15 15:31:50');

-- ----------------------------
-- Table structure for tsc_score
-- ----------------------------
DROP TABLE IF EXISTS `tsc_score`;
CREATE TABLE `tsc_score` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `sid` int(6) NOT NULL,
  `pid` int(6) NOT NULL,
  `score` int(3) NOT NULL DEFAULT '0',
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique score` (`sid`,`pid`) USING BTREE,
  CONSTRAINT `existed student` FOREIGN KEY (`sid`) REFERENCES `tsc_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsc_score
-- ----------------------------
INSERT INTO `tsc_score` VALUES ('1', '1', '6', '1', '2017-05-22 22:45:35');

-- ----------------------------
-- Table structure for tsc_selected
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
INSERT INTO `tsc_selected` VALUES ('2', '1', '2', '2017-05-21 20:18:17');

-- ----------------------------
-- Table structure for tsc_student
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
-- Table structure for tsc_teacher
-- ----------------------------
DROP TABLE IF EXISTS `tsc_teacher`;
CREATE TABLE `tsc_teacher` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tsc_teacher
-- ----------------------------
INSERT INTO `tsc_teacher` VALUES ('1', 'teacher', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `tsc_teacher` VALUES ('2', '13800138000', 'e10adc3949ba59abbe56e057f20f883e');
SET FOREIGN_KEY_CHECKS=1;
