/*
Navicat MySQL Data Transfer

Source Server         : zhan-database
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : uyunshi_mysql

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-05-23 22:14:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(25) NOT NULL,
  `passwd` char(65) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'billowtonadmin', '6dc860a07661194735f25bd9d7262e91', '3');
INSERT INTO `t_admin` VALUES ('2', 'zmjadmin', 'cf754a24bd1c129b16a906b2618b3f14', '2');
INSERT INTO `t_admin` VALUES ('3', 'zyjadmin', 'e10adc3949ba59abbe56e057f20f883e', '1');

-- ----------------------------
-- Table structure for t_autologin
-- ----------------------------
DROP TABLE IF EXISTS `t_autologin`;
CREATE TABLE `t_autologin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `token_exptime` int(11) NOT NULL,
  `verify` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_autologin
-- ----------------------------
INSERT INTO `t_autologin` VALUES ('1', '23', '1401802051', '49163355da569b5673492882ac1208d6');
INSERT INTO `t_autologin` VALUES ('2', '20', '1401888945', '633ec8dad3a25bf212f4e2bcb1c93d3d');
INSERT INTO `t_autologin` VALUES ('3', '36', '1401967534', 'be313999512bc5e31368bb5873acfe2f');
INSERT INTO `t_autologin` VALUES ('4', '37', '1401968865', '7c4f1a393a170efbd2d298479fabb5a3');
INSERT INTO `t_autologin` VALUES ('5', '38', '1401969306', '9f27543f1bcc9ee7589ce2c8ed27ff82');
INSERT INTO `t_autologin` VALUES ('6', '49', '1403014706', 'd66a2101c70b42d272b005ca4b3cddd9');
INSERT INTO `t_autologin` VALUES ('7', '50', '1403106996', 'e1f71b762e184260961444c988c77fcb');
INSERT INTO `t_autologin` VALUES ('8', '51', '1403165383', '25dd6885ae5747a43d70ca8eb694c953');
INSERT INTO `t_autologin` VALUES ('12', '84', '1405673019', 'cd0698faf1db416179bb78fc1c01b22f');
INSERT INTO `t_autologin` VALUES ('13', '87', '1405825247', '1de846f5180cb64f243f7c8aa99a9fa7');

-- ----------------------------
-- Table structure for t_avatar
-- ----------------------------
DROP TABLE IF EXISTS `t_avatar`;
CREATE TABLE `t_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `path` varchar(70) NOT NULL DEFAULT 'public/images/home/avatar/default_64_auto.jpg',
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_temp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_avatar
-- ----------------------------
INSERT INTO `t_avatar` VALUES ('4', '19', 'uploads/avatar/2015-05-14/55545f4a9b5b1.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('5', '20', 'uploads/avatar/2014-06-23/53a7c7e120f58.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('6', '21', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('7', '22', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('8', '23', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('9', '24', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('10', '25', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('11', '26', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('12', '27', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('13', '28', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('14', '29', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('15', '30', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('16', '31', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('17', '32', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('18', '33', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('19', '34', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('20', '35', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('21', '36', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('22', '37', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('23', '38', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('24', '39', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('25', '40', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('26', '41', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('27', '42', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('28', '43', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('29', '44', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('30', '45', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('31', '46', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('32', '47', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('33', '48', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('34', '49', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('35', '50', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('36', '51', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('37', '52', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('38', '53', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('41', '56', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('42', '57', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('45', '66', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('44', '65', 'uploads/avatar/2014-07-04/53b65e369e2a3.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('46', '67', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('47', '68', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('48', '69', 'uploads/avatar/2014-08-03/53dde723b9881.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('49', '70', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('50', '71', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('51', '72', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('52', '73', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('53', '74', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('54', '75', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('55', '76', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('56', '77', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('57', '78', 'uploads/avatar/2014-07-07/53ba3fc13474b.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('58', '79', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('59', '80', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('60', '81', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('61', '82', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('62', '83', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('63', '84', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('64', '85', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('65', '86', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('66', '87', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('67', '88', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('68', '89', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('70', '92', 'uploads/avatar/2014-08-03/53dde7f697dbb.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('71', '93', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('72', '94', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('73', '95', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');
INSERT INTO `t_avatar` VALUES ('74', '96', 'public/images/home/avatar/default_64_auto.jpg', '0', '0', '0');

-- ----------------------------
-- Table structure for t_btype
-- ----------------------------
DROP TABLE IF EXISTS `t_btype`;
CREATE TABLE `t_btype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `note` char(50) NOT NULL DEFAULT '0',
  `sptypeid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sptypeid` (`sptypeid`),
  CONSTRAINT `t_btype_ibfk_1` FOREIGN KEY (`sptypeid`) REFERENCES `t_sptype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='????';

-- ----------------------------
-- Records of t_btype
-- ----------------------------
INSERT INTO `t_btype` VALUES ('25', '书籍杂志', '1');
INSERT INTO `t_btype` VALUES ('26', '自行车代步', '2');
INSERT INTO `t_btype` VALUES ('27', '体育用品', '2');
INSERT INTO `t_btype` VALUES ('28', '电脑手机', '3');
INSERT INTO `t_btype` VALUES ('29', '数码配件', '3');
INSERT INTO `t_btype` VALUES ('30', '小家电', '3');
INSERT INTO `t_btype` VALUES ('31', '配饰', '4');
INSERT INTO `t_btype` VALUES ('32', '服装', '4');
INSERT INTO `t_btype` VALUES ('36', '个护化妆', '5');
INSERT INTO `t_btype` VALUES ('37', ' 生活日用', '5');
INSERT INTO `t_btype` VALUES ('38', '家纺', '5');
INSERT INTO `t_btype` VALUES ('39', '休闲食品', '6');
INSERT INTO `t_btype` VALUES ('40', '进口水果', '7');
INSERT INTO `t_btype` VALUES ('42', '小家电', '9');
INSERT INTO `t_btype` VALUES ('49', '时鲜水果', '7');
INSERT INTO `t_btype` VALUES ('50', '电子资源', '1');
INSERT INTO `t_btype` VALUES ('51', '电脑手机', '9');
INSERT INTO `t_btype` VALUES ('52', '孕妇服饰', '11');
INSERT INTO `t_btype` VALUES ('53', '钟表类', '10');

-- ----------------------------
-- Table structure for t_helporder
-- ----------------------------
DROP TABLE IF EXISTS `t_helporder`;
CREATE TABLE `t_helporder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(25) NOT NULL COMMENT '?????',
  `userid` int(11) NOT NULL COMMENT '???',
  `publishdate` int(50) NOT NULL COMMENT '????????',
  `description` varchar(255) NOT NULL COMMENT '????',
  ` duedate` int(11) NOT NULL COMMENT '????????',
  `view` tinyint(5) DEFAULT '0' COMMENT '浏览次数',
  `publictel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否公开联系电话',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `t_helporder_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `t_userinfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_helporder
-- ----------------------------
INSERT INTO `t_helporder` VALUES ('1', '小伙伴们来发求助吧  :-)', '19', '1401350032', '无', '0', '57', '0');
INSERT INTO `t_helporder` VALUES ('2', '高数书下册', '20', '1401355887', '我需要一本高数书下册的，有的可以联系我哈，最好便宜点', '0', '48', '1');
INSERT INTO `t_helporder` VALUES ('5', '二手电瓶车', '45', '1402315485', '需要一台二手电瓶车，请尽快联系', '0', '69', '0');
INSERT INTO `t_helporder` VALUES ('8', '求吉他', '69', '1404655538', '有木有二手的吉他的。。太贵了买不起', '0', '44', '0');
INSERT INTO `t_helporder` VALUES ('9', 'hhh', '19', '1414983436', 'hhgk', '0', '12', '1');

-- ----------------------------
-- Table structure for t_notice
-- ----------------------------
DROP TABLE IF EXISTS `t_notice`;
CREATE TABLE `t_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` varchar(255) NOT NULL,
  `publishdate` int(50) NOT NULL,
  `iseffective` tinyint(255) NOT NULL DEFAULT '1' COMMENT '???????',
  `adminname` char(20) NOT NULL DEFAULT '' COMMENT '??????',
  `effectivedays` int(255) NOT NULL DEFAULT '10' COMMENT '??????',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_notice
-- ----------------------------

-- ----------------------------
-- Table structure for t_orders
-- ----------------------------
DROP TABLE IF EXISTS `t_orders`;
CREATE TABLE `t_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) NOT NULL COMMENT 'userid买家id',
  `sid` int(11) NOT NULL COMMENT 'sellid卖家id',
  `spid` int(11) NOT NULL COMMENT 'shangpinid商品id',
  `isread` tinyint(1) DEFAULT '0' COMMENT '订单是否已读',
  `createtime` int(11) NOT NULL COMMENT '下单时间',
  `description` varchar(255) CHARACTER SET utf8 DEFAULT '无',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COMMENT='订单';

-- ----------------------------
-- Records of t_orders
-- ----------------------------
INSERT INTO `t_orders` VALUES ('3', '22', '21', '3', '1', '1401181689', '无');
INSERT INTO `t_orders` VALUES ('4', '22', '21', '10', '1', '1401181714', '无');
INSERT INTO `t_orders` VALUES ('5', '21', '19', '12', '1', '1401182474', '无');
INSERT INTO `t_orders` VALUES ('14', '39', '19', '81', '1', '1401559819', '无');
INSERT INTO `t_orders` VALUES ('15', '39', '19', '82', '1', '1401561034', '无');
INSERT INTO `t_orders` VALUES ('16', '39', '19', '83', '1', '1401694471', '你好');
INSERT INTO `t_orders` VALUES ('17', '39', '19', '83', '1', '1401694529', '无');
INSERT INTO `t_orders` VALUES ('18', '39', '19', '83', '1', '1401694563', '圣达菲');
INSERT INTO `t_orders` VALUES ('19', '19', '38', '75', '1', '1403358753', '无');
INSERT INTO `t_orders` VALUES ('21', '39', '19', '94', '1', '1403798162', '无');
INSERT INTO `t_orders` VALUES ('23', '19', '38', '72', '1', '1404719624', '无');
INSERT INTO `t_orders` VALUES ('24', '82', '38', '77', '0', '1404803149', '广告费');
INSERT INTO `t_orders` VALUES ('25', '39', '19', '101', '1', '1408765594', '无');
INSERT INTO `t_orders` VALUES ('26', '39', '19', '88', '1', '1411114050', 's');
INSERT INTO `t_orders` VALUES ('27', '39', '19', '101', '1', '1416712917', '你好');
INSERT INTO `t_orders` VALUES ('28', '39', '19', '110', '1', '1431351273', 'hi~');
INSERT INTO `t_orders` VALUES ('29', '39', '19', '88', '0', '1431592280', '无');

-- ----------------------------
-- Table structure for t_qqlogin
-- ----------------------------
DROP TABLE IF EXISTS `t_qqlogin`;
CREATE TABLE `t_qqlogin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `acesstoken` varchar(255) NOT NULL,
  `userid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='QQ登录信息表';

-- ----------------------------
-- Records of t_qqlogin
-- ----------------------------
INSERT INTO `t_qqlogin` VALUES ('6', 'DA23CA1700EAC88E11B92BE8598F7932', 'EC74C1993D7086EF26F58B3C1BEF59F7', '69');
INSERT INTO `t_qqlogin` VALUES ('9', 'C368664F8876C16176B2A061A38570E1', '82B9ED3CD1E9534010B6671035C5A690', '72');
INSERT INTO `t_qqlogin` VALUES ('10', 'D558FBCCA873A7D62841CE32D77809ED', 'AF16A1A55F5A54D5CB313F7F96C9FB4F', '73');
INSERT INTO `t_qqlogin` VALUES ('11', '1002327EA6AA6C0A447A665B97E444C6', 'F3BD1D24D02C263FC4CC1BC840BAB2BA', '74');
INSERT INTO `t_qqlogin` VALUES ('12', '9AB96688EF6DC603E35C76C674BDD118', '9DB39CB79FFE584A8018A72D7E4CDBA2', '75');
INSERT INTO `t_qqlogin` VALUES ('15', 'B47A876EE37D124A88ABDE44BF633697', '3C51063FEA063976D776962C8DB87474', '78');
INSERT INTO `t_qqlogin` VALUES ('16', 'C7AA28A72C5CEE61069F13261644C9FB', 'E4D42114F001762EBDF0C23394BCA42F', '80');
INSERT INTO `t_qqlogin` VALUES ('17', 'CFD02044D0AF84B39252D076ED72730D', 'BADD0253712C8377379734D05B4A5AB6', '86');
INSERT INTO `t_qqlogin` VALUES ('18', 'E6B20940C233CE46AF7D6B008630AC0C', 'E59416925B5F8DA742C05779BAC8C659', '88');
INSERT INTO `t_qqlogin` VALUES ('19', '36D6DCF768C84D9DEB56336BA164BF4D', 'ED672269F630741FE2B478F0B159C9E7', '89');
INSERT INTO `t_qqlogin` VALUES ('20', 'B0ECF9537C02C6FE3AA10E8A6C830133', '7D773544EFAEC87ABB25B976B7F956D2', '90');
INSERT INTO `t_qqlogin` VALUES ('21', '459CC97917AF7E24D452365BCCD088CD', '944FA02453ED579F210D386EF9773296', '94');
INSERT INTO `t_qqlogin` VALUES ('22', '61042DF57F1B062C5BB08D8C02E4B811', '693D4F0268EF572EA6D23742427E0C2E', '95');
INSERT INTO `t_qqlogin` VALUES ('23', '8BE71AEBC389C40D71EA72D578105E89', 'DAFEE349C7FB28BCF9B858B88FA14691', '96');

-- ----------------------------
-- Table structure for t_resetpasswd
-- ----------------------------
DROP TABLE IF EXISTS `t_resetpasswd`;
CREATE TABLE `t_resetpasswd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1?????????0????',
  `token` varchar(128) NOT NULL,
  `token_exptime` int(11) NOT NULL,
  `userinfoid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userinfoid`),
  CONSTRAINT `t_resetpasswd_ibfk_1` FOREIGN KEY (`userinfoid`) REFERENCES `t_userinfo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_resetpasswd
-- ----------------------------
INSERT INTO `t_resetpasswd` VALUES ('2', '1', '888fcae2069ca942a8197403f20c5fef', '1401262798', '19');
INSERT INTO `t_resetpasswd` VALUES ('3', '0', '56a6925a45f119514fb2634cdd861e8a', '1401533657', '20');
INSERT INTO `t_resetpasswd` VALUES ('4', '1', '777166a774b46b5c66688493182fa73d', '1403843861', '19');
INSERT INTO `t_resetpasswd` VALUES ('5', '0', 'a3ebc572690405eda4f55e6759127259', '1403964183', '21');
INSERT INTO `t_resetpasswd` VALUES ('6', '1', '02354152ad56cdd3c3838f65b0c192ad', '1404196586', '20');
INSERT INTO `t_resetpasswd` VALUES ('7', '1', 'a25bc3e77eb2f76fe84234be4ae00d08', '1406708267', '85');

-- ----------------------------
-- Table structure for t_shangpin
-- ----------------------------
DROP TABLE IF EXISTS `t_shangpin`;
CREATE TABLE `t_shangpin` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL COMMENT '用户id',
  `chatcount` int(10) NOT NULL DEFAULT '0' COMMENT '约谈次数',
  `publishdate` int(30) NOT NULL COMMENT '发布时间',
  `ishandled` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已经处理',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态0',
  `stypeid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `costprice` float NOT NULL DEFAULT '0' COMMENT '原价',
  `duedate` int(50) NOT NULL COMMENT '过期时间',
  `image` varchar(255) NOT NULL DEFAULT '',
  `price` float NOT NULL DEFAULT '0' COMMENT '现价',
  `isnew` tinyint(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`userid`),
  KEY `stype` (`stypeid`),
  CONSTRAINT `t_shangpin_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `t_userinfo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_shangpin_ibfk_2` FOREIGN KEY (`stypeid`) REFERENCES `t_stype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COMMENT='?????';

-- ----------------------------
-- Records of t_shangpin
-- ----------------------------
INSERT INTO `t_shangpin` VALUES ('20', '20', '1', '1401200717', '1', '<pre><p>高数课本A上册，，便宜大甩卖</p></pre>', '1', '48', '《高等数学A上》', '34', '1416925517', '/test/2014-05-27/5384a04d2e176.jpg', '5', '0');
INSERT INTO `t_shangpin` VALUES ('21', '20', '0', '1401200842', '1', '<pre><p>高数下册便宜甩卖</p></pre>', '1', '48', '《高等数学A下》', '29', '1416925642', '/test/2014-05-27/5384a0ca0bf97.jpg', '3', '0');
INSERT INTO `t_shangpin` VALUES ('24', '20', '1', '1401201582', '1', '<pre><p>8成新，便宜送，非诚勿扰</p></pre>', '1', '48', '《新编大学英语3》 ', '42', '1416926382', '/test/2014-05-27/5384a3ae84108.jpg', '2', '0');
INSERT INTO `t_shangpin` VALUES ('25', '23', '0', '1401205844', '1', '<pre><p>高数上下册都有 笔记不多 6成新 上下册都要的10元两本</p></pre>', '1', '48', '高等数学 下 同济大学', '29.4', '1416930644', '/test/2014-05-27/5384b454c34c0.jpg', '6', '0');
INSERT INTO `t_shangpin` VALUES ('26', '23', '1', '1401205986', '1', '<pre><p>同济大学版高等教育出版社 5成新 略有笔记 上下册都有 同时要10元两本</p></pre>', '1', '48', '高等数学 上 同济大学版', '34.4', '1416930786', '/test/2014-05-27/5384b4e22ec51.jpg', '6', '0');
INSERT INTO `t_shangpin` VALUES ('27', '23', '1', '1401206140', '1', '<pre><p>高等教育出版社 何钦铭 颜辉主编 7成新 有程序笔记</p></pre>', '1', '49', 'C语言程序设计 何钦铭主编', '26', '1416930940', '/test/2014-05-27/5384b57c32d33.jpg', '8', '0');
INSERT INTO `t_shangpin` VALUES ('28', '23', '0', '1401206305', '1', '<pre><p>这门课相当坑爹但又蛮重要的 我是没听懂 so基本没有笔记::&gt;_&lt;::</p></pre>', '1', '49', '数据结构（C语言版）', '35', '1416931105', '/test/2014-05-27/5384b6210554d.jpg', '10', '0');
INSERT INTO `t_shangpin` VALUES ('31', '20', '1', '1401241737', '1', '<pre><p>便宜甩卖了</p></pre>', '1', '48', '《新编大学英语4》', '40', '1416966537', '/test/2014-05-28/538540899d75b.jpg', '2.5', '0');
INSERT INTO `t_shangpin` VALUES ('33', '20', '1', '1401249514', '1', '<pre><p>40*50*60cm  \r\n8成新，只有10只欲购从速</p></pre>', '1', '112', '纸箱', '6', '1416974314', '/test/2014-05-28/53855eea236e8.jpg', '3', '0');
INSERT INTO `t_shangpin` VALUES ('35', '23', '1', '1401255650', '1', '<pre><p>高等教育出版社 2010年修订版 跟最新版本基本一样，8成新 无笔记</p></pre>', '1', '48', '中国近代史纲要', '19.5', '1416980450', '/test/2014-05-28/538576e219fd1.jpg', '3', '0');
INSERT INTO `t_shangpin` VALUES ('36', '23', '0', '1401255829', '1', '<pre><p>高等教育出版社 苏德矿主编 购书可附赠答案电子版 8成新 重点处有笔记</p></pre>', '1', '48', '概率论与数理统计', '22.8', '1416980629', '/test/2014-05-28/53857795ab822.jpg', '5', '0');
INSERT INTO `t_shangpin` VALUES ('37', '23', '0', '1401256175', '1', '<pre><p>高等教育出版社 苏德矿主编 7成新 重点处有笔记   附赠电子版题库</p></pre>', '1', '48', '线性代数', '17.9', '1416980975', '/test/2014-05-28/538578ef58de2.jpg', '3', '0');
INSERT INTO `t_shangpin` VALUES ('38', '23', '1', '1401256694', '1', '<pre><p>8成新 略有笔记 上下册一起买有优惠 附赠【大学物理实验 张晓波主编】</p></pre>', '1', '49', '普通物理学上册', '42.9', '1416981494', '/test/2014-05-28/53857af60aabd.jpg', '12', '0');
INSERT INTO `t_shangpin` VALUES ('39', '23', '0', '1401256826', '1', '<pre><p>9成新 无笔记 上下册一起买有优惠 附赠上册电子版题库 【大学物理实验 张晓波主编】（只买下册不赠送的喔）</p></pre>', '1', '48', '普通物理学 下册', '32.1', '1416981626', '/test/2014-05-28/53857b7acda2c.jpg', '10', '0');
INSERT INTO `t_shangpin` VALUES ('40', '23', '0', '1401257094', '1', '<pre><p>9成新 无笔记  附赠【视听说教程第三版】上听力课配套用的，也9成新无笔记定价为38 光盘都在。  英语4一起买有优惠同样附赠上述配套东西。</p></pre>', '1', '48', '新编大学英语3', '43.9', '1416981894', '/test/2014-05-28/53857c860bf23.jpg', '15', '0');
INSERT INTO `t_shangpin` VALUES ('41', '23', '0', '1401257255', '1', '<pre><p>8成新 基本无笔记 附赠【视听说教程4第三版】（上听力课配套使用 也是9成新无笔记 定价38元）  和英语3一起买有优惠喔</p></pre>', '1', '48', '新编大学英语4', '42.9', '1416982055', '/test/2014-05-28/53857d27d6a18.jpg', '15', '0');
INSERT INTO `t_shangpin` VALUES ('43', '36', '0', '1401362955', '1', '<pre><p>欢迎采购</p></pre>', '1', '58', '马克思课本九成新', '20.999', '1417087755', '/test/2014-05-29/53871a0b8d51b.jpg', '4.9999', '0');
INSERT INTO `t_shangpin` VALUES ('45', '38', '0', '1401366290', '1', '<pre><p>尺码齐全，三色，深蓝，枣红，浅蓝</p></pre>', '1', '117', '特价春季新款韩版板鞋男鞋子英伦风时尚休闲潮流行男鞋透气休闲鞋', '128', '1417091090', '/test/2014-05-29/53872712e589c.jpg', '68', '1');
INSERT INTO `t_shangpin` VALUES ('46', '38', '0', '1401366690', '1', '<pre><p>尺码齐全，三色，红色，蓝色，黑色</p></pre>', '1', '117', '春夏季低帮透气男士帆布鞋男鞋子休闲鞋韩版潮懒人鞋系带运动板鞋', '118', '1417091490', '/test/2014-05-29/538728a2c0150.jpg', '60', '1');
INSERT INTO `t_shangpin` VALUES ('47', '38', '0', '1401366773', '1', '<pre><p>尺码齐全，三色，墨绿色，蓝色，绿色</p></pre>', '1', '117', '2014最新款休闲时尚潮流韩版学生懒人脚套一脚蹬懒人男鞋驾车鞋', '120', '1417091573', '/test/2014-05-29/538728f5de033.png', '65', '1');
INSERT INTO `t_shangpin` VALUES ('48', '38', '0', '1401366868', '1', '<pre><p>尺码齐全，三色，绿色，蓝色，灰色</p></pre>', '1', '117', '2014春夏新款帆布鞋学生鞋男韩版潮一脚蹬懒人鞋板鞋子休闲鞋', '128', '1417091668', '/test/2014-05-29/53872954766cb.png', '68', '1');
INSERT INTO `t_shangpin` VALUES ('50', '38', '0', '1401367072', '1', '<pre><p>尺码齐全，四色，浅灰色，蓝色，橘黄色，月蓝色</p></pre>', '1', '117', '2014春男鞋休闲鞋夏季透气网鞋运动休闲板鞋网布鞋一脚蹬懒人鞋子', '96', '1417091872', '/test/2014-05-29/53872a200e27c.png', '48', '1');
INSERT INTO `t_shangpin` VALUES ('51', '38', '0', '1401367152', '1', '<pre><p>尺码齐全，三色，白色，蓝色，棕色</p></pre>', '1', '117', '2014夏季黑白色低帮系带男式帆布鞋英伦风日韩透气一脚蹬男士板鞋', '128', '1417091952', '/test/2014-05-29/53872a70285b9.png', '75', '1');
INSERT INTO `t_shangpin` VALUES ('52', '38', '0', '1401367242', '1', '<pre><p>尺码齐全，三色，白色，蓝色，天蓝色</p></pre>', '1', '117', '2014新款男鞋韩版时尚休闲潮流豆豆鞋英伦风驾车懒人鞋学生帆船鞋', '120', '1417092042', '/test/2014-05-29/53872acac4319.png', '65', '1');
INSERT INTO `t_shangpin` VALUES ('53', '38', '0', '1401367431', '1', '<pre><p>尺码齐全，四色，深灰色，蓝色，深卡其色，浅灰色</p></pre>', '1', '117', '夏天新款透气日常休闲鞋男鞋子韩版潮懒人系带运动低帮板鞋男生鞋', '108', '1417092231', '/test/2014-05-29/53872b8739d6b.png', '58', '1');
INSERT INTO `t_shangpin` VALUES ('54', '38', '0', '1401367552', '1', '<pre><p>尺码齐全，三色，深卡其布色，蓝色，黑色</p></pre>', '1', '117', '2014春透气时尚潮流英伦风男鞋子男士休闲鞋平底板鞋懒人鞋单鞋潮', '160', '1417092352', '/test/2014-05-29/53872c00727da.png', '89', '1');
INSERT INTO `t_shangpin` VALUES ('55', '38', '0', '1401367623', '1', '<pre><p>尺码齐全，三色，米色，灰色，黄色</p></pre>', '1', '117', '2014最新款潮流时尚透气鞋休闲鞋韩版春季新款豆豆男鞋懒人驾车鞋', '120', '1417092423', '/test/2014-05-29/53872c47cdb58.png', '65', '1');
INSERT INTO `t_shangpin` VALUES ('56', '38', '0', '1401367686', '1', '<pre><p>尺码齐全，三色，红色，蓝色，湖绿色</p></pre>', '1', '117', '春夏原创潮人款休闲鞋韩版透气男鞋子英伦风套脚懒人鞋豆豆鞋男潮', '120', '1417092486', '/test/2014-05-29/53872c86ebd0a.png', '65', '1');
INSERT INTO `t_shangpin` VALUES ('57', '38', '0', '1401367764', '1', '<pre><p>尺码齐全，三色，墨绿色，蓝色，卡其色</p></pre>', '1', '117', '2014最新款潮流韩版英伦风时尚休闲男鞋舒适商务低帮鞋子板鞋', '128', '1417092564', '/test/2014-05-29/53872cd484365.jpg', '68', '1');
INSERT INTO `t_shangpin` VALUES ('58', '38', '0', '1401367829', '1', '<pre><p>尺码齐全，三色，黑色，深蓝色，卡其色</p></pre>', '1', '117', '2014春夏四季款新款男士鞋韩版时尚休闲板鞋学生鞋青少年帆布男鞋', '128', '1417092629', '/test/2014-05-29/53872d15c48d5.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('59', '38', '0', '1401367887', '1', '<pre><p>尺码齐全，三色，卡其色，浅灰色，黑色</p></pre>', '1', '117', '2014四季款春款男式鞋时尚韩版反绒皮板鞋帆布时尚平底休闲鞋单鞋', '128', '1417092687', '/test/2014-05-29/53872d4fa1c49.jpg', '68', '1');
INSERT INTO `t_shangpin` VALUES ('60', '38', '0', '1401367949', '1', '<pre><p>尺码齐全，三色，橘色，天蓝色，黑色</p></pre>', '1', '117', '2014新款流行男鞋潮韩版时尚豆豆鞋男士超纤牛绒皮低帮单鞋驾车鞋', '128', '1417092749', '/test/2014-05-29/53872d8d45c1f.jpg', '68', '1');
INSERT INTO `t_shangpin` VALUES ('61', '38', '0', '1401368007', '1', '<pre><p>尺码齐全，三色，绿色，蓝色，浅灰色</p></pre>', '1', '117', '2014春夏秋季布鞋男士帆布鞋男韩版潮时尚男生板鞋休闲鞋平底男鞋', '120', '1417092807', '/test/2014-05-29/53872dc700bb7.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('62', '38', '0', '1401368107', '1', '<pre><p>尺码齐全，三色，卡其布色，蓝色，黑色</p></pre>', '1', '117', '2014春款新款时尚休闲鞋韩版水洗帆布男士阿甘鞋男式鞋低帮跑步鞋', '128', '1417092907', '/test/2014-05-29/53872e2b16feb.jpg', '68', '1');
INSERT INTO `t_shangpin` VALUES ('63', '38', '0', '1401368165', '1', '<pre><p>尺码齐全，三色，红色，蓝色，黑色</p></pre>', '1', '117', '春季新款潮流豆豆鞋 男士透气韩版帆布鞋套脚懒人鞋驾车鞋英伦风', '108', '1417092965', '/test/2014-05-29/53872e6525e40.jpg', '58', '1');
INSERT INTO `t_shangpin` VALUES ('64', '38', '0', '1401368249', '1', '<pre><p>尺码齐全，三色，灰色，蓝色，黑色</p></pre>', '1', '117', '2014春季帆布鞋男韩版低帮休闲潮流男式鞋子透气时尚百搭男板鞋', '120', '1417093049', '/test/2014-05-29/53872eb9d105d.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('65', '38', '0', '1401368315', '1', '<pre><p>尺码齐全，三色，灰色，蓝色，黑色</p></pre>', '1', '117', '夏季透气休闲鞋男士洞洞鞋英伦潮流凉网鞋男镂空鞋休闲凉鞋男鞋子', '100', '1417093115', '/test/2014-05-29/53872efb8bf28.jpg', '45', '1');
INSERT INTO `t_shangpin` VALUES ('66', '38', '0', '1401368453', '1', '<pre><p>尺码齐全，两色，蓝色，黑色</p></pre>', '1', '117', '春夏季男士休闲鞋韩版潮流透气帆布鞋低帮布鞋潮鞋板鞋豆豆男鞋子', '120', '1417093253', '/test/2014-05-29/53872f855d4f4.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('67', '38', '0', '1401368520', '1', '<pre><p>尺码齐全，三色，绿色，蓝色，白色</p></pre>', '1', '117', '新品低帮男鞋春秋季男士帆布鞋 男 韩版潮流男款时尚懒人驾车鞋潮', '120', '1417093320', '/test/2014-05-29/53872fc860b4a.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('68', '38', '0', '1401368614', '1', '<pre><p>尺码齐全，六色，红色，蓝色，黑色，灰色，浅蓝色，米白色</p></pre>', '1', '117', '2014春夏日韩托马斯男鞋一脚蹬轻质懒人驾车鞋时尚手绘低帮帆布鞋', '118', '1417093414', '/test/2014-05-29/5387302623026.jpg', '60', '1');
INSERT INTO `t_shangpin` VALUES ('69', '38', '0', '1401368713', '1', '<pre><p>尺码齐全，三色，绿色，蓝色，灰色</p></pre>', '1', '117', '夏季新款男士凉拖鞋子网布潮流洞洞鞋日韩版时尚休闲半拖鞋男潮拖', '118', '1417093513', '/test/2014-05-29/53873089391f9.jpg', '60', '1');
INSERT INTO `t_shangpin` VALUES ('70', '38', '0', '1401368815', '1', '<pre><p>尺码齐全，三色，白色，深蓝色，浅蓝色</p></pre>', '1', '117', '2014春夏新款英伦风 潮流时尚休闲 商务男士PU皮鞋子懒人驾车', '120', '1417093615', '/test/2014-05-29/538730ef93e05.jpg', '60', '1');
INSERT INTO `t_shangpin` VALUES ('71', '38', '0', '1401368876', '1', '<pre><p>尺码齐全，三色，白色，深蓝色，浅蓝色</p></pre>', '1', '117', '2014夏季新款男士透气休闲鞋 驾车懒人鞋一脚蹬韩版英伦风帆布鞋', '108', '1417093676', '/test/2014-05-29/5387312c6d51f.jpg', '58', '1');
INSERT INTO `t_shangpin` VALUES ('72', '38', '1', '1401369002', '1', '<pre><p>尺码齐全，三色，红色，深蓝色，米白色</p></pre>', '1', '117', '欧美潮流休闲时尚流行斑马托马斯男士鞋子拼色一脚蹬懒人脚套鞋', '118', '1417093802', '/test/2014-05-29/538731aa4e041.jpg', '60', '1');
INSERT INTO `t_shangpin` VALUES ('73', '38', '0', '1401369121', '1', '<pre><p>尺码齐全，四色，红色，蓝色，深卡其色，浅灰色</p></pre>', '1', '117', '2014夏季新款英伦风时尚休闲帆布鞋潮流驾车懒人鞋男鞋布鞋学生鞋', '118', '1417093921', '/test/2014-05-29/53873221c3865.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('74', '38', '0', '1401369215', '1', '<pre><p>尺码齐全，两色，深灰色，深蓝色</p></pre>', '1', '117', '2014夏季新款透气帆布男鞋子男士休闲鞋韩版 时尚板鞋 潮低帮鞋', '120', '1417094015', '/test/2014-05-29/5387327f0bd62.jpg', '68', '1');
INSERT INTO `t_shangpin` VALUES ('75', '38', '1', '1401369309', '1', '<pre><p>尺码齐全，三色，浅灰色，深蓝色，浅蓝色</p></pre>', '1', '117', '2014夏季流行男鞋春夏季透气板鞋男士休闲鞋 韩版潮男低帮帆布鞋', '120', '1417094109', '/test/2014-05-29/538732dd53b9f.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('76', '38', '0', '1401369387', '1', '<pre><p>尺码齐全，三色，黑白色，蓝白色，灰白色</p></pre>', '1', '117', '2014夏季新款时尚休闲套脚豆豆男鞋舒适布鞋韩版克罗心驾车懒人鞋', '120', '1417094187', '/test/2014-05-29/5387332b6df0e.jpg', '65', '1');
INSERT INTO `t_shangpin` VALUES ('77', '38', '1', '1401369458', '1', '<pre><p>尺码齐全，三色，白色，蓝色，灰色</p></pre>', '1', '117', '2014男士帆布N字鞋阿甘鞋夏季韩版男布鞋休闲鞋透气林弯弯板鞋潮', '140', '1417094258', '/test/2014-05-29/5387337211f5a.jpg', '89', '1');
INSERT INTO `t_shangpin` VALUES ('85', '46', '0', '1402322397', '1', '<pre><p>强推的!超级好用!! 最近自己新购的mascara玛思卡华洗发套装 !!真的是洗一次就有效果的噢会越洗越好的! 真的我自己在用拉啦头发实在是 300ml活性碳洗发水+300ml胶原蛋白护发素 ❶多功能修复，对于头发，❷烫染后损伤 ❸静电 ❹无营养 ❺脱发 ❻出油等有明显修复作用 针对打结 毛躁 分岔等等噢跑理发店护理水疗什么的也不敌它噢!!</p></pre>', '1', '104', 'mascara玛思卡华洗发套装', '160', '1418047197', '/test/2014-06-09/5395bddd544c5.jpg', '120', '1');
INSERT INTO `t_shangpin` VALUES ('86', '46', '0', '1402322594', '1', '<pre><p>台湾za美白焕颜两用粉饼 自用款!! 遮瑕控油都很 没有粉质感哦! 粉饼加za15周年限量粉盒!! za的彩妆效果都是很棒的啦啦 因为价格也很实惠噢!!</p></pre>', '1', '105', '台湾za美白焕颜两用粉饼', '180', '1418047394', '/test/2014-06-09/5395bea2a8d69.jpg', '160', '1');
INSERT INTO `t_shangpin` VALUES ('87', '50', '0', '1402502441', '1', '<pre><p>九成新</p></pre>', '1', '86', '卷发棒', '100', '1418227241', '/test/2014-06-12/53987d2946983.jpg', '60', '0');
INSERT INTO `t_shangpin` VALUES ('88', '19', '4', '1403701150', '1', '<pre><p>测试</p></pre>', '1', '101', 'test', '12', '1419425950', '/test/2014-06-25/53aac79ef32f3.jpg', '123', '0');
INSERT INTO `t_shangpin` VALUES ('89', '19', '0', '1403701519', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '111', '该数据为测试数据', '2', '1419426319', '/test/2014-06-25/53aac90f7a4a6.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('90', '19', '0', '1403701546', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '111', '该数据为测试数据       该数据为测试数据    *_*', '12', '1419426346', '/test/2014-06-25/53aac92a0bbf5.jpg', '123', '1');
INSERT INTO `t_shangpin` VALUES ('91', '19', '0', '1403701569', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '111', '该数据为测试数据       该数据为测试数据    *_*', '12', '1419426369', '/test/2014-06-25/53aac941d6003.jpg', '123', '1');
INSERT INTO `t_shangpin` VALUES ('92', '19', '0', '1403701587', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '111', '该数据为测试数据       该数据为测试数据    *_*', '12', '1419426387', '/test/2014-06-25/53aac95339a70.jpg', '123', '1');
INSERT INTO `t_shangpin` VALUES ('93', '19', '0', '1403701620', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '111', '该数据为测试数据       该数据为测试数据    *_*', '23', '1419426420', '/test/2014-06-25/53aac974d6290.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('95', '19', '0', '1403701697', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '111', '该数据为测试数据       该数据为测试数据    *_*', '2', '1419426497', '/test/2014-06-25/53aac9c195934.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('96', '19', '0', '1403701710', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '111', '该数据为测试数据       该数据为测试数据    *_*', '3', '1419426510', '/test/2014-06-25/53aac9cee98a4.jpg', '34', '1');
INSERT INTO `t_shangpin` VALUES ('97', '19', '0', '1403701877', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '106', '该数据为测试数据       该数据为测试数据    *_*', '12', '1419426677', '/test/2014-06-25/53aaca75ede07.jpg', '123', '0');
INSERT INTO `t_shangpin` VALUES ('98', '19', '0', '1403701893', '1', '<pre><p>该数据为测试数据\r\n      该数据为测试数据\r\n\r\n  *_*</p></pre>', '1', '104', '该数据为测试数据       该数据为测试数据    *_*', '12', '1419426693', '/test/2014-06-25/53aaca850cdb5.jpg', '123', '1');
INSERT INTO `t_shangpin` VALUES ('99', '19', '0', '1403701983', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '105', '该数据为测试数据，与真实类目不符', '2', '1419426783', '/test/2014-06-25/53aacadf240af.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('100', '19', '0', '1403701992', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '107', '该数据为测试数据，与真实类目不符', '2', '1419426792', '/test/2014-06-25/53aacae8cbef5.jpeg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('101', '19', '2', '1403702003', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '108', '该数据为测试数据，与真实类目不符', '22', '1419426803', '/test/2014-06-25/53aacaf34e195.jpg', '122', '1');
INSERT INTO `t_shangpin` VALUES ('102', '19', '0', '1403702011', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '110', '该数据为测试数据，与真实类目不符', '22', '1419426811', '/test/2014-06-25/53aacafbb8f33.jpg', '122', '1');
INSERT INTO `t_shangpin` VALUES ('103', '19', '0', '1403702035', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '109', '该数据为测试数据，与真实类目不符', '454', '1419426835', '/test/2014-06-25/53aacb131ca83.jpg', '1', '1');
INSERT INTO `t_shangpin` VALUES ('104', '19', '0', '1403702153', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '22', '1419426953', '/test/2014-06-25/53aacb890281b.jpg', '1222', '1');
INSERT INTO `t_shangpin` VALUES ('105', '19', '0', '1403702159', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '22', '1419426959', '/test/2014-06-25/53aacb8fa691f.jpg', '122', '1');
INSERT INTO `t_shangpin` VALUES ('106', '19', '0', '1403702169', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '22', '1419426969', '/test/2014-06-25/53aacb995a525.jpg', '122', '1');
INSERT INTO `t_shangpin` VALUES ('107', '19', '0', '1403702177', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '22', '1419426977', '/test/2014-06-25/53aacba1b5e9d.jpg', '122', '1');
INSERT INTO `t_shangpin` VALUES ('108', '19', '0', '1403702270', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '22', '1419427070', '/test/2014-06-25/53aacbfe97d4d.jpg', '122', '1');
INSERT INTO `t_shangpin` VALUES ('109', '19', '0', '1403702281', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '22', '1419427081', '/test/2014-06-25/53aacc09293dc.jpg', '122', '1');
INSERT INTO `t_shangpin` VALUES ('110', '19', '1', '1403702329', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '2', '1419427129', '/test/2014-06-25/53aacc3925939.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('111', '19', '0', '1403702341', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '2', '1419427141', '/test/2014-06-25/53aacc45efcba.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('112', '19', '0', '1403702348', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '99', '该数据为测试数据，与真实类目不符', '2', '1419427148', '/test/2014-06-25/53aacc4c38b5a.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('113', '19', '0', '1403702562', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '71', '该数据为测试数据，与真实类目不符', '2', '1419427362', '/test/2014-06-25/53aacd2298bf4.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('114', '19', '0', '1403702577', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '67', '该数据为测试数据，与真实类目不符', '2', '1419427377', '/test/2014-06-25/53aacd31a06c6.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('115', '19', '0', '1403702590', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '64', '该数据为测试数据，与真实类目不符', '2', '1419427390', '/test/2014-06-25/53aacd3e2664f.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('117', '19', '0', '1403702614', '1', '<pre><p>该数据为测试数据，与真实类目不符\r\n网站正式推广后会删除所有测试数据\r\n ^_^</p></pre>', '1', '68', '该数据为测试数据，与真实类目不符', '2', '1419427414', '/test/2014-06-25/53aacd56638b1.jpg', '12', '1');
INSERT INTO `t_shangpin` VALUES ('132', '96', '0', '1407724551', '0', '<pre><p>123123</p></pre>', '0', '64', '123213', '123123', '1423449351', '/test/2014-08-11/53e82c070f695.jpg', '123213', '0');
INSERT INTO `t_shangpin` VALUES ('133', '19', '0', '1427040574', '0', '<pre><p>ss</p></pre>', '0', '65', 'd', '23', '1442765374', '/test/2015-03-23/550ee93e73ee4.jpg', '12', '0');

-- ----------------------------
-- Table structure for t_sptype
-- ----------------------------
DROP TABLE IF EXISTS `t_sptype`;
CREATE TABLE `t_sptype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` char(255) NOT NULL,
  `isnew` tinyint(10) NOT NULL DEFAULT '0',
  `icon` char(255) NOT NULL COMMENT '前缀图标',
  `image` char(255) NOT NULL COMMENT '背景图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sptype
-- ----------------------------
INSERT INTO `t_sptype` VALUES ('1', '文化书籍', '0', '1.gif', 'bg1.jpg');
INSERT INTO `t_sptype` VALUES ('2', '户外运动', '0', '2.gif', 'bg2.jpg');
INSERT INTO `t_sptype` VALUES ('3', '数码家电', '0', '3.gif', 'bg3.jpg');
INSERT INTO `t_sptype` VALUES ('4', '衣装配饰', '1', '4.gif', 'bg4.jpg');
INSERT INTO `t_sptype` VALUES ('5', '家居日用', '1', '5.gif', 'bg5.jpg');
INSERT INTO `t_sptype` VALUES ('6', '零食特产', '1', '6.gif', 'bg6.jpg');
INSERT INTO `t_sptype` VALUES ('7', '缤纷水果', '1', '7.gif', 'bg7.jpg');
INSERT INTO `t_sptype` VALUES ('9', '数码家电', '1', '3.gif', 'bg3.jpg');
INSERT INTO `t_sptype` VALUES ('10', '珠宝收藏', '0', '4.gif', 'bg4.jpg');
INSERT INTO `t_sptype` VALUES ('11', '闲置母婴', '0', '5.gif', 'bg5.jpg');

-- ----------------------------
-- Table structure for t_stype
-- ----------------------------
DROP TABLE IF EXISTS `t_stype`;
CREATE TABLE `t_stype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `note` char(50) NOT NULL DEFAULT '0' COMMENT '小类名称',
  `btypeid` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `btype` (`btypeid`),
  KEY `btypeid` (`btypeid`),
  CONSTRAINT `FK_t_stype_btypeid` FOREIGN KEY (`btypeid`) REFERENCES `t_btype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_stype_ibfk_1` FOREIGN KEY (`btypeid`) REFERENCES `t_btype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_stype
-- ----------------------------
INSERT INTO `t_stype` VALUES ('48', '通识课程类', '25');
INSERT INTO `t_stype` VALUES ('49', '电子信息类(有)', '25');
INSERT INTO `t_stype` VALUES ('50', '工业技术类', '25');
INSERT INTO `t_stype` VALUES ('51', '材纺服装类', '25');
INSERT INTO `t_stype` VALUES ('52', '自然科学类', '25');
INSERT INTO `t_stype` VALUES ('53', '建筑工程类', '25');
INSERT INTO `t_stype` VALUES ('54', '文化教育类', '25');
INSERT INTO `t_stype` VALUES ('55', '语言文学类', '25');
INSERT INTO `t_stype` VALUES ('56', '外语类', '25');
INSERT INTO `t_stype` VALUES ('57', '财经管理类', '25');
INSERT INTO `t_stype` VALUES ('58', '政治法律类', '25');
INSERT INTO `t_stype` VALUES ('59', '哲学类', '25');
INSERT INTO `t_stype` VALUES ('60', '杂志小说', '25');
INSERT INTO `t_stype` VALUES ('62', '自行车', '26');
INSERT INTO `t_stype` VALUES ('63', '山地车', '26');
INSERT INTO `t_stype` VALUES ('64', '电动车', '26');
INSERT INTO `t_stype` VALUES ('65', '羽毛球', '27');
INSERT INTO `t_stype` VALUES ('66', '乒乓球', '27');
INSERT INTO `t_stype` VALUES ('67', '篮球', '27');
INSERT INTO `t_stype` VALUES ('68', '足球', '27');
INSERT INTO `t_stype` VALUES ('69', '排球', '27');
INSERT INTO `t_stype` VALUES ('70', '网球(拍)', '27');
INSERT INTO `t_stype` VALUES ('71', '杠哑铃', '27');
INSERT INTO `t_stype` VALUES ('72', '其他', '27');
INSERT INTO `t_stype` VALUES ('74', '笔记本', '28');
INSERT INTO `t_stype` VALUES ('75', 'iphone', '28');
INSERT INTO `t_stype` VALUES ('76', 'ipad', '28');
INSERT INTO `t_stype` VALUES ('77', '小米', '28');
INSERT INTO `t_stype` VALUES ('78', '其他', '28');
INSERT INTO `t_stype` VALUES ('85', '电风扇', '30');
INSERT INTO `t_stype` VALUES ('86', '电吹风', '30');
INSERT INTO `t_stype` VALUES ('87', '台灯', '30');
INSERT INTO `t_stype` VALUES ('88', '其他', '30');
INSERT INTO `t_stype` VALUES ('89', '移动硬盘', '29');
INSERT INTO `t_stype` VALUES ('90', '音响', '29');
INSERT INTO `t_stype` VALUES ('91', '鼠标', '29');
INSERT INTO `t_stype` VALUES ('92', 'U盘', '29');
INSERT INTO `t_stype` VALUES ('93', '耳机', '29');
INSERT INTO `t_stype` VALUES ('94', '三星', '28');
INSERT INTO `t_stype` VALUES ('95', '其他', '25');
INSERT INTO `t_stype` VALUES ('99', '水果', '49');
INSERT INTO `t_stype` VALUES ('100', '创意DIY', '31');
INSERT INTO `t_stype` VALUES ('101', '项链/吊坠', '31');
INSERT INTO `t_stype` VALUES ('102', '手镯/手链/脚链', '31');
INSERT INTO `t_stype` VALUES ('103', '袜子', '32');
INSERT INTO `t_stype` VALUES ('104', '洗发露', '36');
INSERT INTO `t_stype` VALUES ('105', '洁面乳', '36');
INSERT INTO `t_stype` VALUES ('106', '沐浴露', '36');
INSERT INTO `t_stype` VALUES ('107', '纸巾', '37');
INSERT INTO `t_stype` VALUES ('108', '水杯', '37');
INSERT INTO `t_stype` VALUES ('109', '床单/被套', '38');
INSERT INTO `t_stype` VALUES ('110', '枕头', '38');
INSERT INTO `t_stype` VALUES ('111', '巧克力', '39');
INSERT INTO `t_stype` VALUES ('112', '纸箱', '37');
INSERT INTO `t_stype` VALUES ('113', '实验报告', '50');
INSERT INTO `t_stype` VALUES ('114', '包', '32');
INSERT INTO `t_stype` VALUES ('117', '男鞋', '32');
INSERT INTO `t_stype` VALUES ('118', '平板电脑', '51');
INSERT INTO `t_stype` VALUES ('119', '电子书籍', '50');
INSERT INTO `t_stype` VALUES ('120', '学习资料', '50');
INSERT INTO `t_stype` VALUES ('122', '短上衣', '52');
INSERT INTO `t_stype` VALUES ('123', '劳伦斯钟表', '53');

-- ----------------------------
-- Table structure for t_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `t_userinfo`;
CREATE TABLE `t_userinfo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `isqq` tinyint(5) DEFAULT '0',
  `username` char(20) NOT NULL COMMENT '用户名',
  `passwd` char(255) NOT NULL COMMENT '密码',
  `tel` char(20) NOT NULL COMMENT '电话话吗',
  `email` char(50) NOT NULL COMMENT 'email',
  `regdate` int(50) NOT NULL COMMENT '注册日期',
  `addr` varchar(100) NOT NULL COMMENT '地址',
  `number` char(20) DEFAULT NULL COMMENT 'qq号码',
  `vip` tinyint(4) DEFAULT '0' COMMENT '是否vip',
  `isseller` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否卖家',
  `truename` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_exptime` int(11) NOT NULL,
  `lastlogindate` int(15) NOT NULL DEFAULT '0',
  `maxsell` int(10) NOT NULL DEFAULT '20',
  `signupdate` int(11) NOT NULL COMMENT '签到日期',
  `coin` int(8) NOT NULL DEFAULT '0' COMMENT 'ǩ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_userinfo
-- ----------------------------
INSERT INTO `t_userinfo` VALUES ('19', '0', 'zhan', '96e79218965eb72c92a549dd5a330112', '611111', 'htmlgit@163.com', '1401172539', 'zstu', '553676333', '0', '1', '占榆杰', '1', 'a69578aaf87fd4109d92f4149b235f5f', '1401258939', '1432390437', '1000', '0', '0');
INSERT INTO `t_userinfo` VALUES ('20', '0', 'billowton', '6d81e1c4ed4c8341fbb039ec453dcc6e', '615983', '851616601@qq.com', '1401178827', '浙江理工大学', '1915699835', '0', '1', '汪涛涛', '1', '3b1c0a39f079ef538abf411f0b866e18', '1401265227', '1407137638', '100', '0', '0');
INSERT INTO `t_userinfo` VALUES ('21', '0', 'zhaomingjie', '96e79218965eb72c92a549dd5a330112', '15757126264', 'zhao523520704@163.com', '1401180234', '浙江理工大学生活三区B1E526寝室', '523520704', '0', '1', '赵明杰', '1', 'c8661ab13d144ea628a503190eb1236b', '1401266634', '1401198232', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('23', '0', '种蘑菇的小提莫', '96e79218965eb72c92a549dd5a330112', '567027', '523520704@qq.com', '1401197206', '浙江理工大学生活三区B1E526寝室', '523520704', '0', '1', '赵明杰', '1', '839a74b178b5a77f6892861849839c5b', '1401283606', '1404624050', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('24', '0', '1209985002', '6d66fd5a85b8451da38c92e5d0846b77', '15757126257', '1209985002@qq.com', '1401202201', '理工三区', null, '0', '0', '', '1', 'dc3c91e3df5460b99a3b79777e261505', '1401288601', '1401202251', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('25', '0', 'friendship', '55504f0e17c00bfa4fbad580d04fa32d', '15757126164', '1064890298@qq.com', '1401202427', '理工生活二区一号楼512', '1064890298', '0', '1', '钟嘉烽', '1', '50c1256a251beb11a65dc84ecc4ead9c', '1401288827', '1402055985', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('26', '0', '921103zmm', '89b3975e222552f58bc2ea2fdb07d63f', '18814886794', '582104438@qq.com', '1401243565', '理工生活3区3E219', null, '0', '0', '', '1', 'fcc0f11ea9df770b273f3f3f6d96314e', '1401329965', '1402463129', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('32', '0', 'cll', 'e2c6d672eed83709e51562020d859e78', '18258225234', '1041869769@qq.com', '1401266195', '浙江传媒', '1041869769', '0', '1', '蔡琳琳', '1', '277dcc97852d6a43632fccd153916184', '1401352595', '1401266279', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('33', '0', 'wym_01', '9a1f364a6f9e443433414d47ee048ecc', '13616551322', '765744240@qq.com', '1401280161', '二区6S', '765744240', '0', '1', '王毓铭', '1', '2d41ecd63255c0b5f433a07ae4ed55b4', '1401366561', '1401280221', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('35', '0', 'fannie', 'ccdf1161522ef26cb04ceda7afc7cf42', '18768124865', 'fannie@uyunshi.com', '1401284091', '一区4s622', null, '0', '0', '', '1', 'fde43bb9319c9ba1d3053f70ed1f0448', '1401370491', '1401364764', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('36', '0', '哈哈哈哈哈哈哈哈哈哈哈', '02c75fb22c75b23dc963c7eb91a062cc', '611942', '1971773087@qq.com', '1401362672', '619', '1971773087', '0', '1', '哈哈哈', '1', '03f255acedebb47b897c8d1588c55186', '1401449072', '1401362734', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('37', '0', 'xyfuil', 'f3e7cb0a7b19269683535e8d0a4c5556', '611947', 'xyfuil@qq.com', '1401363978', '理工4号南楼619室', null, '0', '0', '', '1', 'd5bec2c68035843e4b26c60ec5e7b939', '1401450378', '1401364065', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('38', '0', '小东东潮鞋店', '6477b5f1acf96876feea55dc8d3fae2b', '18658887475', '747782795@qq.com', '1401364483', '浙江省温州市瓯海区梧田街道德绣苑7幢', '2011046539', '0', '1', '吴东', '1', 'd298fad9d5198fe230b6af6366adca5e', '1401450883', '1404719681', '40', '0', '0');
INSERT INTO `t_userinfo` VALUES ('39', '0', 'zhan2', '96e79218965eb72c92a549dd5a330112', '611122', '553676333@qq.com', '1401370377', 'zstu', null, '0', '0', '', '1', '894a79a01c7e23404b5bba4f1647f8d1', '1401456777', '1431592519', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('40', '0', '123', 'e10adc3949ba59abbe56e057f20f883e', '12345678901', '1225733380@qq.com', '1401426636', '123', null, '0', '0', '', '1', '15a38ab8a29db190f7f3205ed180e6a3', '1401513036', '1401426683', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('44', '0', '小猪猪', 'e462234837c1ba0c0a39cc79011d63d2', '18768428144', 'jerry1224@qq.com', '1402186835', '杭州滨江区滨兴西苑', '1574978515', '0', '1', '陈文婷', '1', '2a5c540b8afea4632d0c44c6adf8b429', '1402273235', '1402405574', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('45', '0', '勤vIc', '991793afe7a34c8e412599e4060125d5', '18768194775', '370128846@qq.com', '1402315375', '学林街656-5', '370128846', '0', '1', '陈伟勤', '1', 'af009c8f766f997b13cdc5446b6610c7', '1402401775', '1402315432', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('46', '0', 'lwzhy', '00a5f1e772a201ffafb2d26c9d8ae699', '18658005022', '584291616@qq.com', '1402322059', '浙江理工大学', '584291616', '0', '1', '张虹雨', '1', '9384a3289e72ba3ca83dca2bc726a965', '1402408459', '1403868539', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('49', '0', '年七sred', 'e93cbb1afa7b33d1a82eef364257bd1d', '18067978472', '791649229@qq.com', '1402409877', '浙理工', null, '0', '0', '', '1', '585fd332cf7763316da50eb3a5632a12', '1402496277', '1402409906', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('50', '0', 'liumengxin', 'b09feda5658ca5050586d1a9b01bb3f3', '15757160714', '542560574@qq.com', '1402502138', '杭州下沙东城大厦', '542560574', '0', '1', '刘梦欣', '1', '7231b7ae7ad686c61f3d3dd9e81deff1', '1402588538', '1402502196', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('51', '0', 'DebenChou', 'b265a31e29affd9fb0a5d782468727b7', '15858189575', '992462202@qq.com', '1402560529', '理工二区六南', null, '0', '0', '', '1', 'f207a1aadedad75b3b9521f5c7babeb8', '1402646929', '1402560583', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('52', '0', '伊若影雪', '4a48c51593dc26ebba154b9ed1b83ef0', '611932', '919043324@qq.com', '1402754135', '浙江理工大学', null, '0', '0', '', '1', '93d9f752c1398e6e7f962a2757b770dd', '1402840535', '1402754182', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('53', '0', 'variya', 'e1a8d7f527418ae77b167096e37df6bf', '18612312312', '24252463@qq.com', '1402815595', 'dalian', null, '0', '0', '', '1', 'c84a5b777126afc0f5e0fbe8d0b08188', '1402901995', '1402815629', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('56', '0', 'zigawei', '22b8fc94db903b76409507dbd990aa78', '18668158901', '1254621296@qq.com', '1403940100', '二区', '1254621296', '0', '1', '朱嘉伟', '1', 'd87c7377ba2bc86bacdf7c8408e8386d', '1404026500', '1404033725', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('67', '0', 'a188', '67c04e88926b781ad6726ba134c4e760', '611803', '1813907195@qq.com', '1404552817', '123456', null, '0', '0', '', '1', '3160cfd686152d805dc0511668ea4eec', '1404639217', '1406366936', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('69', '1', 'dsfdsfs', 'uyunshi', '18888888888', 'sfdf@dfdsf.com', '1404566497', '请自行修改地址', '1915699835', '0', '1', '汪涛涛', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('74', '1', '优云网', 'uyunshi', '615983', '1915699835@qq.com', '1404644448', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('75', '1', 'a1881', 'uyunshi', '18888888888', 'asd@asd.com', '1404654687', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('78', '1', 'zhan_qq', 'uyunshi', '18888888888', '5536763333@qq.com', '1404657065', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('79', '0', '木子新春', '3a2382ba632efded1da0a910778c51c3', '18814887160', '1937291090@qq.com', '1404663430', '4S617', null, '0', '0', '', '1', '69715554a0700aa90091bd0c4b92497c', '1404749830', '1404663470', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('80', '1', '王毓铭', 'uyunshi', '18888888888', '765744240@qq.com', '1404688538', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('81', '0', '杜娟Summer', '2b312fe5343296df7ea5b85b66786f8f', '18814887363', 'lovecuckoodj@163.com', '1404723472', '杭州', null, '0', '0', '', '1', '43355f79cfa0cb272dfd0a0230cfa321', '1404809872', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('82', '0', 'stronger11', 'b628382c97124173dd283bf7b83f1eec', '15708455524', '1025465224@qq.com', '1404802960', '成都', null, '0', '0', '', '1', '5b72f643eb9c309199267d2d5aacafc2', '1404889360', '1404802989', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('83', '0', 'test_', '96e79218965eb72c92a549dd5a330112', '1111111', 'sdfkljadsjfljxjldftest@163.com', '1404804619', '1123', null, '0', '0', '', '0', 'ea96658660efe0a37ca59e1d49ac8b2e', '1404891019', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('84', '0', '艾艾艾', '9c32d6523556378b8b1632720f7ab1e1', '15019419567', '563486809@qq.com', '1405068177', '深圳', null, '0', '0', '', '1', 'b841867b180338441c182d635da07d5f', '1405154577', '1405068219', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('85', '0', 'dandan', '25d55ad283aa400af464c76d713c07ad', '15757126010', '2273713586@qq.com', '1405175077', '三区', null, '0', '0', '', '1', '5135349827f1545297c1eb448a64293f', '1405261477', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('86', '1', '廖绪雄', 'uyunshi', '18888888888', '1459902482@qq.com', '1405187669', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('87', '0', '苍茫游客', 'efe3cebe7eaaad63635a3ad50a963b30', '15757124981', '997410501@qq.com', '1405220362', '浙江理工大学', null, '0', '0', '', '1', '7420b02ea230aa98c14a3125e58689c5', '1405306762', '1407833889', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('88', '1', '汪葆乐', 'uyunshi', '18888888888', '745164744@qq.com', '1405320133', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('89', '1', '小优云', 'uyunshi', '18888888888', 'qimaixian@qq.com', '1406709768', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('90', '1', '1407049566uyun', 'uyunshi', '18888888888', 'uyunshi@uyunshi.com', '1407049566', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('92', '2', 'billowton1407051750', 'uyunshi', '18888888888', '1915699835@qq.com', '1407051750', '请自行修改地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('93', '2', 'zhan1407431071', 'uyunshi', '18888888888', 'htmlgit@163.com', '1407431071', '请自行修改地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('95', '1', '1407660224uyun', 'uyunshi', '18888888888', 'uyunshi@uyunshi.com', '1407660224', '未填写地址', null, '0', '0', '', '1', '', '0', '0', '20', '0', '0');
INSERT INTO `t_userinfo` VALUES ('96', '1', 'asdasd', 'uyunshi', '18888888888', 'asdasd@13.com', '1407724471', '未填写地址', 'a12312312312', '0', '1', 'asdsd', '1', '', '0', '0', '20', '0', '0');

-- ----------------------------
-- Table structure for t_uyunshilogin
-- ----------------------------
DROP TABLE IF EXISTS `t_uyunshilogin`;
CREATE TABLE `t_uyunshilogin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `acesstoken` varchar(255) NOT NULL,
  `userid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='QQ登录信息表';

-- ----------------------------
-- Records of t_uyunshilogin
-- ----------------------------
INSERT INTO `t_uyunshilogin` VALUES ('2', 'cc8fcf5fd7703cce814ca7394b1b28dd', 'uyunshilogin', '92');
INSERT INTO `t_uyunshilogin` VALUES ('3', '0c107d12f934ed983248f29d8929bb42', 'uyunshilogin', '93');
