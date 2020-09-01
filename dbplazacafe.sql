/*
 Navicat Premium Data Transfer

 Source Server         : gustoysabor
 Source Server Type    : MySQL
 Source Server Version : 50730
 Source Host           : localhost:3306
 Source Schema         : dbplazacafe

 Target Server Type    : MySQL
 Target Server Version : 50730
 File Encoding         : 65001

 Date: 06/07/2020 17:20:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tblautonumber
-- ----------------------------
DROP TABLE IF EXISTS `tblautonumber`;
CREATE TABLE `tblautonumber`  (
  `AUTOID` int(11) NOT NULL AUTO_INCREMENT,
  `AUTOSTART` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AUTOEND` int(11) NOT NULL,
  `AUTOKEY` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AUTOID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tblautonumber
-- ----------------------------
INSERT INTO `tblautonumber` VALUES (1, '000', 17, 'userid');
INSERT INTO `tblautonumber` VALUES (2, '201700', 8, 'MENUID');
INSERT INTO `tblautonumber` VALUES (4, '0', 344, 'ordernumber');
INSERT INTO `tblautonumber` VALUES (5, '2017-M-0', 24, 'MEALID');
INSERT INTO `tblautonumber` VALUES (6, '2017', 111, 'CUSTOMER');

-- ----------------------------
-- Table structure for tblcategory
-- ----------------------------
DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE `tblcategory`  (
  `CATEGORYID` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(90) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`CATEGORYID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tblcategory
-- ----------------------------
INSERT INTO `tblcategory` VALUES (3, 'PASTA');
INSERT INTO `tblcategory` VALUES (10, 'DESAYUNOS');
INSERT INTO `tblcategory` VALUES (11, 'ALMUERZOS');
INSERT INTO `tblcategory` VALUES (12, 'ENTRADAS');

-- ----------------------------
-- Table structure for tblmeals
-- ----------------------------
DROP TABLE IF EXISTS `tblmeals`;
CREATE TABLE `tblmeals`  (
  `MEALID` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MEALS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CATEGORIES` varchar(90) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PRICE` double NOT NULL,
  `CATEGORYID` int(11) NOT NULL,
  `MEALPHOTO` varchar(90) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`MEALID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tblmeals
-- ----------------------------
INSERT INTO `tblmeals` VALUES ('2017-M-022', 'ARROZ CON POLLO', 'ALMUERZOS', 10000, 11, 'uploaded_photos/arrozonconpollo.jpg');
INSERT INTO `tblmeals` VALUES ('2017-M-023', 'arros con pollo', 'ENTRADAS', 3500, 12, 'uploaded_photos/laser marking - SKF Blue.png');

-- ----------------------------
-- Table structure for tblorders
-- ----------------------------
DROP TABLE IF EXISTS `tblorders`;
CREATE TABLE `tblorders`  (
  `ORDERID` int(11) NOT NULL AUTO_INCREMENT,
  `DATEORDERED` datetime(0) NOT NULL,
  `ORDERNO` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DESCRIPTION` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PRICE` double NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `SUBTOTAL` double NOT NULL,
  `TABLENO` int(11) NOT NULL,
  `MEALID` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USERID` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUS` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `REMARKS` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ORDERID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tblpayments
-- ----------------------------
DROP TABLE IF EXISTS `tblpayments`;
CREATE TABLE `tblpayments`  (
  `PAYMENTID` int(11) NOT NULL AUTO_INCREMENT,
  `ORDERNO` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TRANSDATE` datetime(0) NOT NULL,
  `TOTALPAYMENT` double NOT NULL,
  `DISCOUNTSENIOR` double NOT NULL,
  `OVERALLTOTAL` double NOT NULL,
  `TENDEREDAMOUNT` double NOT NULL,
  `PCHANGE` double NOT NULL,
  `USERSNAME` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CUSTOMER` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TABLENO` int(11) NOT NULL,
  `REMARK` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SENIORID` varchar(90) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`PAYMENTID`) USING BTREE,
  UNIQUE INDEX `ORDERNO`(`ORDERNO`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbltable
-- ----------------------------
DROP TABLE IF EXISTS `tbltable`;
CREATE TABLE `tbltable`  (
  `TABLEID` int(11) NOT NULL AUTO_INCREMENT,
  `TABLENO` int(11) NOT NULL,
  `CUSTOMER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `RESERVEDDATE` date NOT NULL,
  `RESERVEDTIME` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUS` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Available',
  PRIMARY KEY (`TABLEID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbltitle
-- ----------------------------
DROP TABLE IF EXISTS `tbltitle`;
CREATE TABLE `tbltitle`  (
  `TItleID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Subtitle` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`TItleID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbltitle
-- ----------------------------
INSERT INTO `tbltitle` VALUES (1, 'Gusto y Sabor', 'Restaurante');

-- ----------------------------
-- Table structure for tblusers
-- ----------------------------
DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE `tblusers`  (
  `USERID` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FULLNAME` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USERNAME` varchar(90) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PASS` varchar(90) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ROLE` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`USERID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tblusers
-- ----------------------------
INSERT INTO `tblusers` VALUES ('00010', 'Mark Gustab', 'mesero1', 'A94A8FE5CCB19BA61C4C0873D391E987982FBBD3', 'Waiter');
INSERT INTO `tblusers` VALUES ('00014', 'Rhea S. Calvo', 'mesero2', 'A94A8FE5CCB19BA61C4C0873D391E987982FBBD3', 'Waiter');
INSERT INTO `tblusers` VALUES ('00015', 'Jiggy Anthony V. Alteros', 'mesero3', 'A94A8FE5CCB19BA61C4C0873D391E987982FBBD3', 'Waiter');
INSERT INTO `tblusers` VALUES ('1', 'Administrator', 'admin', 'A94A8FE5CCB19BA61C4C0873D391E987982FBBD3', 'Administrator');
INSERT INTO `tblusers` VALUES ('2', 'Jayson Cayao', 'cajero', 'A94A8FE5CCB19BA61C4C0873D391E987982FBBD3', 'Cashier');
INSERT INTO `tblusers` VALUES ('3', 'Jennie Faith Joy Y. Resano', 'mesero4', 'A94A8FE5CCB19BA61C4C0873D391E987982FBBD3', 'Waiter');

SET FOREIGN_KEY_CHECKS = 1;
