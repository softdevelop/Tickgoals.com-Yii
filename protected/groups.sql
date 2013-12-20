/*
Navicat MySQL Data Transfer

Source Server         : PHIMTV
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : dnbusiness

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-08-21 00:27:08
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `name` varchar(200) NOT NULL,
  `level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO groups VALUES (0x502A71209B244A32966E147C78787878, 'Admin', '0');
INSERT INTO groups VALUES (0x502A713A87F4444890C0147C78787878, 'Giám đốc', '1');
INSERT INTO groups VALUES (0x502A71837D044E23A778147C78787878, 'Phó giám đốc', '2');
INSERT INTO groups VALUES (0x502BCBE6E4B0463F931115C878787878, 'Giám đốc dự án', '3');
INSERT INTO groups VALUES (0x502BCC0B43D4490E8D3315C878787878, 'Phó phòng', '5');
INSERT INTO groups VALUES (0x502BCC1953144123A7C615C878787878, 'Quản lý dự án', '6');
INSERT INTO groups VALUES (0x502BCC25D378467487CC15C878787878, 'Nhân viên lập trình', '7');
INSERT INTO groups VALUES (0x502BCC3209904C0CB79415C878787878, 'Nhân viên kiểm thử', '8');
INSERT INTO groups VALUES (0x502BCC78DF084665B96315C878787878, 'Trưởng phòng', '4');
INSERT INTO groups VALUES (0x502D2A9232684477883811B078787878, 'Học việc', '10');
INSERT INTO groups VALUES (0x502D7841CAB8401ABC8111B078787878, 'Nhân viên Front-End', '9');

-- ----------------------------
-- Table structure for `map_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `map_permissions`;
CREATE TABLE `map_permissions` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `group_id` binary(16) DEFAULT NULL,
  `permission_id` binary(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of map_permissions
-- ----------------------------
INSERT INTO map_permissions VALUES (0x503187CB5B704FB385AE11C878787878, 0x502A71837D044E23A778147C78787878, 0x00000000000000000000000000000000);
INSERT INTO map_permissions VALUES (0x5032669ED92C49BFAB2E020878787878, 0x502BCC25D378467487CC15C878787878, 0x00000000000000000000000000000000);

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `name` varchar(200) DEFAULT NULL,
  `alias` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO permissions VALUES (0x5030664D387C4CCCB695125078787878, 'Create', 'create');
INSERT INTO permissions VALUES (0x5030666BA394466BA29B125078787878, 'Update', 'update');
INSERT INTO permissions VALUES (0x503067B9B8F44FA78E4D125078787878, 'Remove', 'remove');
INSERT INTO permissions VALUES (0x50306834CE0C46D18A1B125078787878, 'View', 'view');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `module` varchar(200) DEFAULT NULL,
  `controller` varchar(200) DEFAULT NULL,
  `view` varchar(200) DEFAULT NULL,
  `group_id` binary(16) DEFAULT NULL,
  `map_per` binary(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO roles VALUES (0x503115BC05DC4010A0D2045478787878, 'user', 'Admin', 'Index', 0x502A71209B244A32966E147C78787878, 0x503102FCA6F0419AB5AB045478787878);
INSERT INTO roles VALUES (0x503115E909A042878F24045478787878, 'user', 'Admin', 'Index', 0x502BCC25D378467487CC15C878787878, 0x5030AC5D17344B3BABD5125078787878);
INSERT INTO roles VALUES (0x50318763BDA84BD18BC011C878787878, null, 'Site', 'Error', 0x502A71837D044E23A778147C78787878, 0x503187638078446C8ECF11C878787878);
INSERT INTO roles VALUES (0x50318763C0F44CE599F611C878787878, null, 'Site', 'Index', 0x502A71837D044E23A778147C78787878, 0x503187638078446C8ECF11C878787878);
INSERT INTO roles VALUES (0x503187CB72084B58A78B11C878787878, null, 'Site', 'Contact', 0x502A71837D044E23A778147C78787878, 0x503187CB5B704FB385AE11C878787878);
INSERT INTO roles VALUES (0x503187CB82C046638D2411C878787878, null, 'Site', 'Index', 0x502A71837D044E23A778147C78787878, 0x503187CB5B704FB385AE11C878787878);
INSERT INTO roles VALUES (0x5032669E8AD442A4BAE1020878787878, null, 'Site', 'Index', 0x502BCC25D378467487CC15C878787878, 0x5032669ED92C49BFAB2E020878787878);
INSERT INTO roles VALUES (0x5032669EC8B84EF0A081020878787878, 'user', 'Admin', 'Index', 0x502BCC25D378467487CC15C878787878, 0x5032669ED92C49BFAB2E020878787878);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `actived` tinyint(4) DEFAULT '0',
  `birth` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `lastvisit` int(11) DEFAULT NULL,
  `password` text NOT NULL,
  `is_closed` tinyint(4) DEFAULT '0',
  `identity_card` int(10) DEFAULT NULL,
  `group_id` binary(16) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT '0',
  `username` varchar(200) DEFAULT NULL,
  `superuser` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES (0x502D14A7266445749E7811B078787878, 'Administrator', '', '0', '1989-09-08', '2012-08-16 17:41:27', 'thinhpq1@appdev.vn', '1345476890', '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', '201576599', 0x502A71209B244A32966E147C78787878, '934477703', null, 'admin', '1');
INSERT INTO users VALUES (0x502D14FF654849C582E111B078787878, 'Lê', 'Trí Hải', '0', '2012-08-03', '2012-08-16 17:42:55', 'hailt@webdev.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502A713AEFBFBDEFBFBD4448EFBFBDEF, '905055555', null, null, '0');
INSERT INTO users VALUES (0x502D166918A84FEB9F1D11B078787878, 'Quán', 'Đức Bình', '0', '2012-08-08', '2012-08-16 17:48:57', 'binhqd@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', '435345435', 0x502BCC78DF084665B96315C878787878, '5464565', null, null, '0');
INSERT INTO users VALUES (0x502D250B8D684673AC8111B078787878, 'Phan', 'Ngọc Lợi', '0', '1984-01-04', '2012-08-16 18:51:23', 'loipn@webdev.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC0B43D4490E8D3315C878787878, '905687987', null, null, '0');
INSERT INTO users VALUES (0x502D2536D7FC4B17A87F11B078787878, 'Huỳnh', 'Đức Dũng', '0', '2012-08-07', '2012-08-16 18:52:06', 'dunghd@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, '905687987', null, null, '0');
INSERT INTO users VALUES (0x502D257398104517A7F011B078787878, 'Phan', 'Quốc Thịnh', '0', '2012-08-14', '2012-08-19 18:14:48', 'thinhpq@appdev.vn', '1345481324', '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0');
INSERT INTO users VALUES (0x502D2593D93841F6929411B078787878, 'Nguyễn', 'Đại Đồng', '0', '2012-08-16', '2012-08-16 18:53:39', 'dongnd@appdev.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0');
INSERT INTO users VALUES (0x502D25B67B744B23BB3B11B078787878, 'Võ', 'Văn Đức', '0', '2012-08-13', '2012-08-16 18:54:14', 'ducvv@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, 'a', '0');
INSERT INTO users VALUES (0x502D25E978704FED90B311B078787878, 'Bùi', 'Thị Thu Thủy', '0', '2012-08-09', '2012-08-16 18:55:05', 'thuybtt@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0');
INSERT INTO users VALUES (0x502D261676B842E0911211B078787878, 'Phạm', ' Cao Diệu Kha', '0', '2012-05-22', '2012-08-16 18:55:50', 'khapcd@appdev.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC3209904C0CB79415C878787878, null, null, null, '0');
INSERT INTO users VALUES (0x502D263BB1C04F5DBC4511B078787878, 'Nguyễn ', 'Công Minh', '0', '1989-08-11', '2012-08-16 19:56:37', 'minhnc@appdev.vn', null, '17295414f6b30cc4387c2508e0b9283c7f4bc23d', '0', null, 0x502D2A9232684477883811B078787878, null, '0', null, '0');
INSERT INTO users VALUES (0x502D265F6C7C4A99B66811B078787878, 'Hồ ', 'Viết Thiên', '0', '1985-09-02', '2012-08-16 18:57:03', 'thienhv@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0');
INSERT INTO users VALUES (0x502D26806C844278948111B078787878, 'Tạ', 'Bá Thành Huy', '0', '1990-11-07', '2012-08-16 18:57:36', 'huytbt@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0');
INSERT INTO users VALUES (0x502D26A6488C46B3918711B078787878, 'Đinh ', 'Đức Trọng', '0', '1977-05-02', '2012-08-16 18:58:14', 'trongdd@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0');
INSERT INTO users VALUES (0x503188BA844C45A8806F11C878787878, 'Phan', 'Ngọc Tuấn', '0', '1977-08-02', '2012-08-20 02:45:46', 'tuanpn@toancauxanh.vn', '1345423637', '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502A71837D044E23A778147C78787878, '934477703', '0', null, '0');
