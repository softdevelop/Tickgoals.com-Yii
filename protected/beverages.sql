/*
Navicat MySQL Data Transfer

Source Server         : PHIMTV
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : cfcn2

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-10-03 23:07:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `beverages`
-- ----------------------------
DROP TABLE IF EXISTS `beverages`;
CREATE TABLE `beverages` (
  `id` binary(16) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of beverages
-- ----------------------------
INSERT INTO beverages VALUES (0x506AF3D89C944F78B2C7176078787878, 'Cafe sữa đá', '8000');
INSERT INTO beverages VALUES (0x506AF44610784571BB6D176078787878, 'Cafe sữa nóng', '7000');
INSERT INTO beverages VALUES (0x506AF4519D78473B825F176078787878, 'Cafe đen nóng', '7000');
INSERT INTO beverages VALUES (0x506AF4729CE84D2E8583176078787878, 'Cafe đen đá', '7000');
INSERT INTO beverages VALUES (0x506AF47A9DF04B628A6D176078787878, 'C2', '10000');
INSERT INTO beverages VALUES (0x506AF488574847F58282176078787878, 'C2 (anh bình)', '8000');
INSERT INTO beverages VALUES (0x506AF4BC6B0445958378176078787878, 'Revice chai', '14000');
INSERT INTO beverages VALUES (0x506AF4CF660840FCA0B5176078787878, 'Nurtri', '12000');
INSERT INTO beverages VALUES (0x506AF4DA32EC4A849ECE176078787878, 'Sữa chua', '8000');
INSERT INTO beverages VALUES (0x506AF4E8CB944883A4C9176078787878, 'Carem', '8000');
INSERT INTO beverages VALUES (0x506AF4EF5F644E44B325176078787878, 'Sting', '8000');

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` binary(16) NOT NULL,
  `name` varchar(200) NOT NULL,
  `alias` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO categories VALUES (0x5033946CB4E44125A8ED10C078787878, 'Nhân sự', 'nhan-su');
INSERT INTO categories VALUES (0x50339481B01847AEB5F810C078787878, 'Spam', 'spam');
INSERT INTO categories VALUES (0x503394A0D8CC4F1E9BA410C078787878, 'Công nghệ', 'cong-ngh');
INSERT INTO categories VALUES (0x503394DA6AE4479D812110C078787878, 'Sinh nhật', 'sinh-nhật');
INSERT INTO categories VALUES (0x5033950C17B04E2B9FB110C078787878, 'Review', 'review');
INSERT INTO categories VALUES (0x503BA5F7F77841EC8F0110C078787878, 'Công đoàn', 'cong-oan');

-- ----------------------------
-- Table structure for `departments`
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` binary(16) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO departments VALUES (0x503A3B08E170471FA681148078787878, 'Phòng Tổng Hợp');
INSERT INTO departments VALUES (0x503A3B1495604BA5B5EE148078787878, 'Phòng Công Nghệ 1');
INSERT INTO departments VALUES (0x503A3B1D2434486DBFFD148078787878, 'Phòng Công Nghệ 2');
INSERT INTO departments VALUES (0x503A3B34E0784507872B148078787878, 'Phòng Thiết Kế');
INSERT INTO departments VALUES (0x503A3B419E84416AA593148078787878, 'Phòng Slices-Html');
INSERT INTO departments VALUES (0x503A3B4FEAD84CDA94D7148078787878, 'Phòng Kinh Doanh');
INSERT INTO departments VALUES (0x503A3B78A3C04D02AB0B148078787878, 'Phòng Công Nghệ 3');

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
INSERT INTO groups VALUES (0x502BCC25D378467487CC15C878787878, 'Người dùng', '7');

-- ----------------------------
-- Table structure for `map_departments`
-- ----------------------------
DROP TABLE IF EXISTS `map_departments`;
CREATE TABLE `map_departments` (
  `id` binary(16) NOT NULL,
  `user_id` binary(16) NOT NULL,
  `department_id` binary(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of map_departments
-- ----------------------------
INSERT INTO map_departments VALUES (0x503BA576D378474E8CFB10C078787878, 0x503B9ED54EB846DDA2A910C078787878, 0x503A3B08E170471FA681148078787878);
INSERT INTO map_departments VALUES (0x503F8595AE3042BF9090116878787878, 0x502D257398104517A7F011B078787878, 0x503A3B1D2434486DBFFD148078787878);
INSERT INTO map_departments VALUES (0x504778F4ECA04E20B4BD13C878787878, 0x502D14FF654849C582E111B078787878, 0x503A3B08E170471FA681148078787878);
INSERT INTO map_departments VALUES (0x504E166BFD784F1E924C10CC78787878, 0x504E166BDB78450BAA1310CC78787878, 0x503A3B419E84416AA593148078787878);
INSERT INTO map_departments VALUES (0x506AEB4F3F544A50A523176078787878, 0x502D250B8D684673AC8111B078787878, 0x503A3B1D2434486DBFFD148078787878);
INSERT INTO map_departments VALUES (0x506AEB6078A441EBA779176078787878, 0x502D166918A84FEB9F1D11B078787878, 0x503A3B1D2434486DBFFD148078787878);
INSERT INTO map_departments VALUES (0x506AEB7817F84BC78D78176078787878, 0x502D14A7266445749E7811B078787878, 0x503A3B1D2434486DBFFD148078787878);
INSERT INTO map_departments VALUES (0x506B107E57B440AC93BC176078787878, 0x506B107EBBF846B2A00C176078787878, 0x503A3B1D2434486DBFFD148078787878);
INSERT INTO map_departments VALUES (0x506B10D33690451686E1176078787878, 0x506B10D323BC4A368DB1176078787878, 0x503A3B1D2434486DBFFD148078787878);
INSERT INTO map_departments VALUES (0x506B10F3C3884098A0C2176078787878, 0x506B10F374B0491F996C176078787878, 0x503A3B1D2434486DBFFD148078787878);
INSERT INTO map_departments VALUES (0x506B112626B047ECA167176078787878, 0x506B112621C445AEB7CC176078787878, 0x503A3B1D2434486DBFFD148078787878);

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
INSERT INTO map_permissions VALUES (0x5033835B572449398A4010C078787878, 0x502A71209B244A32966E147C78787878, 0x00000000000000000000000000000000);

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` binary(16) NOT NULL,
  `title` varchar(200) NOT NULL,
  `user_id` binary(16) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `category_id` binary(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO news VALUES (0x503652658FC44B729FD6064478787878, 'Spam nè', 0x502D14A7266445749E7811B078787878, '<p style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent; color: rgb(34, 34, 34); \">HTML tags problem</p>\r\n\r\n<p style=\"margin: 0.5em 0px 0px; padding: 0px; border: 1px solid rgb(245, 245, 245); outline: 0px; vertical-align: baseline; background-color: transparent; color: rgb(34, 34, 34); \"></p>\r\n<p style=\"margin: 0px 0px 20px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent; \">If you\'re like me and got a problem that displays the HTML tags when using this editor make sure you don\'t use the CHTML::encode designed for yii. instead just use<span id=\"pastemarkerend\">&nbsp;</span></p>\r\n\r\n\r\n', '2012-08-23 17:55:17', 0x5033950C17B04E2B9FB110C078787878);
INSERT INTO news VALUES (0x50365705A6F44B368B1F064478787878, 'Đấu cờ', 0x502D14A7266445749E7811B078787878, '<p><span style=\"color: rgb(34, 34, 34); \">Hi mọi người,</span><br style=\"color: rgb(34, 34, 34); \"><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">Mình có hẹn với bên thể thao Đà Nẵng trong năm đi thi đấu 2 giải. Giải</span><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">thứ 2 của năm là tháng 9 tới đây từ ngày 19-29 (còn 1 tháng nữa). Mình</span><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">sẽ đi Sài Gòn và vắng mặt ở công ty trong khoảng 8 ngày làm việc,</span><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">trong đó có khoảng 3 ngày là mình có toàn bộ thời gian giờ hành chính</span><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">rảnh để làm việc công ty, các ngày còn lại thì chỉ có ngoài giờ.</span><br style=\"color: rgb(34, 34, 34); \"><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">Chuyến du đấu này hứa hẹn nhiều thành công hơn không trắng tay như</span><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">chuyến rồi. Chuyến rồi đã bị mất 1 mớ tiền thưởng và mặt mũi.</span>&nbsp;<span id=\"pastemarkerend\">&nbsp;</span><br>\r\n\r\n</p>\r\n', '2012-08-23 18:15:00', 0x5033946CB4E44125A8ED10C078787878);
INSERT INTO news VALUES (0x503BA60E364C4EAA9D9810C078787878, 'Tổ chức tour du lịch Suối và Hoa', 0x502D14A7266445749E7811B078787878, '<p><span style=\"color: rgb(34, 34, 34); \">Hi hi hi cả nhà thân mến ! (Lưu ý: Đọc 222 cấm đọc hihihi)</span><br style=\"color: rgb(34, 34, 34); \"><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">Đã rất rất lâu rồi các Greenglobaler chúng ta chiến đấu không mệt mỏi để mang về các kết quả vô cùng khả quan cho các dự án của chúng ta. Và rồi một điều tất yếu xảy ra khi các bạn làm việc quá tốt đó là gì? Đó là \"xiền rơi trúng u cái đầu\", chắc các bạn vẫn còn nhớ cảm giác \"xiền xưởng\" về với mọi người mọi nhà cuối tuần vừa rồi. Tuy nhiên đi kèm với tín hiệu tốt sẽ là một số dấu hiệu đáng lo ngại về các cảm xúc khác của chính các bạn. Theo thống kê của tổ chức WHO thì 99% số người sau khi nhận thưởng mà không đi chơi sẽ mắc các bệnh sau: \"</span><b style=\"color: rgb(34, 34, 34); \">trầm cảm không thuyên giảm</b><span style=\"color: rgb(34, 34, 34); \">\", \"</span><b style=\"color: rgb(34, 34, 34); \">ham làm nên lảm nhảm</b><span style=\"color: rgb(34, 34, 34); \">\" và đặc biệt là dấu hiệu của \"</span><b style=\"color: rgb(34, 34, 34); \">làm nhiều cho dượng hưởng</b><span style=\"color: rgb(34, 34, 34); \">\".&nbsp;</span><br style=\"color: rgb(34, 34, 34); \"><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">Vậy thì các bạn hãy yên tâm, nhằm làm giảm nguy cơ mắc các bệnh khó đỡ này công đoàn công ty sẽ tổ chức một tour du lịch vào kì nghỉ 02/09 với đối tượng tham gia là đại gia đình Toàn Cầu Xanh chúng ta. Về phần chi phí hãy yên tâm rằng \"xiền xưởng\" vẫn là của các bạn khi&nbsp;</span><span size=\"4\" style=\" color: rgb(0, 0, 153); \"><b>công ty tài trợ 100%</b></span><span style=\"color: rgb(34, 34, 34); \">&nbsp;</span><span style=\"color: rgb(34, 34, 34); \">cho chương trình tén tén tén tèn. Sau đây xin bật mí một số thông tin về tour để các bạn tham khảo.</span><br style=\"color: rgb(34, 34, 34); \">\r\n</p>\r\n\r\n<ol style=\"color: rgb(34, 34, 34); \">\r\n\r\n	<li style=\"margin-left: 15px; \">Thời gian: 01/09/2012 (như thông tin nghỉ lễ đã được thông báo chúng ta nghỉ từ thứ 7 và nếu ai không tham gia thì hok được nghỉ thì phải&nbsp;<img goomoji=\"329\" src=\"https://mail.google.com/mail/e/329\" style=\"margin: 0px 0.2ex; vertical-align: middle; \">&nbsp;)</li>\r\n\r\n	<li style=\"margin-left: 15px; \">Địa điểm: Subject mail là tour Suối và Hoa do đó chúng ta đi Suối Hoa là hợp lý nhất&nbsp;<img goomoji=\"338\" src=\"https://mail.google.com/mail/e/338\" style=\"margin: 0px 0.2ex; vertical-align: middle; \">.</li>\r\n\r\n	<li style=\"margin-left: 15px; \">Khung chương trình: chắc hẳn các bạn đã tham gia tour Tắm Nóng Phước Nhơn trong dịp 30/04 vừa rồi sẽ không quên được các trò chơi gay cấn hấp dẫn và không kém phần sexy do bạn Thànhnt phòng CN1 dàn dựng. Lần này ban tổ chức hưá hẹn một chương trình có phần gay cấn hơn, hồi hộp hơn và đặc biệt là nguy hiểm hơn để bảo đảm rằng khi các bạn quay lại làm việc sẽ thấy rằng còn được ngồi code là một hạnh phúc lớn&nbsp;<img goomoji=\"1B2\" src=\"https://mail.google.com/mail/e/1B2\" style=\"margin: 0px 0.2ex; vertical-align: middle; \"></li>\r\n\r\n	<li style=\"margin-left: 15px; \">Địa điểm tập trung: Công ty Toàn Cầu Xanh 24 Lê Đình Dương.<br>\r\n\r\n</li>\r\n\r\n	<li style=\"margin-left: 15px; \">Thời gian xuất phát: đúng 6h30 AM ngày 01/09/2012. Hậu quả của giờ cao su ư? Đó là các bạn có thể sẽ phải đi bằng xe máy, một mình và bị phạt. Trong khi các mem đi đúng giờ sẽ được gì ???<br>\r\n\r\n</li>\r\n\r\n	<li style=\"margin-left: 15px; \">Đi bằng ôtô, với thật là đông các anh chị em (chủ yếu là với các chị em&nbsp;<img goomoji=\"327\" src=\"https://mail.google.com/mail/e/327\" style=\"margin: 0px 0.2ex; vertical-align: middle; \">) không hít bụi, không lạc đường không bị phạt, WOW so cool !!!</li>\r\n\r\n	<li style=\"margin-left: 15px; \">Để tham gia tour mời các anh chị em vào link sau để ghi danh.&nbsp;<a href=\"https://docs.google.com/a/webdev.vn/spreadsheet/ccc?key=0AtICtZrA2R9AdDMtbW5wRDRCWkMzbnhwOFF1ZTdNY3c&amp;pli=1#gid=0\" target=\"_blank\" style=\"color: rgb(17, 85, 204); \">Click here</a></li>\r\n\r\n	<li style=\"margin-left: 15px; \">Lưu ý: Các thành phần cần cưỡng ép, cưỡng bức thậm chí bắt cóc tham gia và nếu còn không tham gia sẽ bị gây khó dễ về sau với nhiều các hình thức trêu ghẹo ném đá giấu tay, thọc gậy bánh xe gồm các đối tượng sau:</li></ol>\r\n\r\n\r\n<ul style=\"color: rgb(34, 34, 34); \">\r\n\r\n	<li style=\"margin-left: 15px; \">Đã vào công ty lâu năm mà chưa tham gia picnic lần nào cùng công ty.</li>\r\n\r\n	<li style=\"margin-left: 15px; \">Các thành viên mới của các phòng tính từ 30/04/2012.</li></ul>\r\n\r\n<span style=\"color: rgb(34, 34, 34); \"> &nbsp; 9.&nbsp; Còn các thành phần ham vui (tức là lần nào cũng có mặt) thì chỉ có một yêu cầu là khi tham gia thì đừng có vui quá mà làm các anh chị em mới sợ sệt, cảnh giác và xa lánh.</span><br style=\"color: rgb(34, 34, 34); \"><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">Với sự chuẩn bị rất chu đáo lần này, ban lãnh đạo cùng với công đoàn công ty muốn mang đến các bạn một kì nghỉ vui vẻ. Đồng thời mục đích to lớn hơn đó là nhằm gắn kết các thành viên của đại gia định Toàn Cầu Xanh với nhau gần hơn nữa, khăng khít hơn nữa. Khi mà việc kể hết tên&nbsp;</span><b style=\"color: rgb(34, 34, 34); \">tất cả các thành viên</b><span style=\"color: rgb(34, 34, 34); \">&nbsp;trong công ty với bất kì ai đang là một điều quá khó khăn thì rõ ràng đây là cơ hội rất tốt để chúng ta có thể thực hiện được điều đó dễ dàng hơn. Rất mong danh sách ghi danh sẽ có tên tất cả các anh chị em gia đình Toàn Cầu Xanh chúng ta, xin chân thành cảm ơn!</span><br style=\"color: rgb(34, 34, 34); \"><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">Thay mặt ban chấp hành công đoàn !</span><br style=\"color: rgb(34, 34, 34); \"><span style=\"color: rgb(34, 34, 34); \">Thân, Bíchnh</span>&nbsp;<span id=\"pastemarkerend\">&nbsp;</span><br>\r\n\r\n', '2012-08-27 18:53:34', 0x503BA5F7F77841EC8F0110C078787878);

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
-- Table structure for `predict`
-- ----------------------------
DROP TABLE IF EXISTS `predict`;
CREATE TABLE `predict` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `name` varchar(200) NOT NULL,
  `ty_so_z` tinyint(2) NOT NULL,
  `ty_so_n` tinyint(2) NOT NULL,
  `obj_z_id` binary(16) NOT NULL,
  `obj_n_id` binary(16) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of predict
-- ----------------------------
INSERT INTO predict VALUES (0x506C60C12A1C4534A1D517D478787878, 'haha', '2', '3', 0x506C2AFD78BC4274B52617D478787878, 0x506C2ECA1C2C4F7EA35517D478787878, '2012-10-03 17:58:57');
INSERT INTO predict VALUES (0x506C78EA14A84C46845217D478787878, 'Công nghệ 1 - Liên Hợp', '1', '1', 0x506C2AFD78BC4274B52617D478787878, 0x506C2ECA1C2C4F7EA35517D478787878, '2012-10-03 17:42:34');

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
INSERT INTO roles VALUES (0x50318763BDA84BD18BC011C878787878, null, 'Site', 'Error', 0x502A71837D044E23A778147C78787878, 0x503187638078446C8ECF11C878787878);
INSERT INTO roles VALUES (0x50318763C0F44CE599F611C878787878, null, 'Site', 'Index', 0x502A71837D044E23A778147C78787878, 0x503187638078446C8ECF11C878787878);
INSERT INTO roles VALUES (0x503187CB72084B58A78B11C878787878, null, 'Site', 'Contact', 0x502A71837D044E23A778147C78787878, 0x503187CB5B704FB385AE11C878787878);
INSERT INTO roles VALUES (0x503187CB82C046638D2411C878787878, null, 'Site', 'Index', 0x502A71837D044E23A778147C78787878, 0x503187CB5B704FB385AE11C878787878);
INSERT INTO roles VALUES (0x5032669E8AD442A4BAE1020878787878, null, 'Site', 'Index', 0x502BCC25D378467487CC15C878787878, 0x5032669ED92C49BFAB2E020878787878);
INSERT INTO roles VALUES (0x5033835B9BAC439BBEAC10C078787878, null, 'Site', 'Index', 0x502A71209B244A32966E147C78787878, 0x5033835B572449398A4010C078787878);
INSERT INTO roles VALUES (0x5033866E0B3845E384CC10C078787878, 'user', 'ChangePassword', 'Index', 0x502BCC78DF084665B96315C878787878, null);
INSERT INTO roles VALUES (0x5033866E24A043F682A910C078787878, 'user', 'ChangePassword', 'Index', 0x502BCC0B43D4490E8D3315C878787878, null);
INSERT INTO roles VALUES (0x5033866E2B784CDBAC2A10C078787878, 'user', 'ChangePassword', 'Index', 0x502A71837D044E23A778147C78787878, null);
INSERT INTO roles VALUES (0x5033866E36584F72B9C710C078787878, 'user', 'ChangePassword', 'Index', 0x502D2A9232684477883811B078787878, null);
INSERT INTO roles VALUES (0x5033866E54B840E4AC7610C078787878, 'user', 'ChangePassword', 'Index', 0x502BCC1953144123A7C615C878787878, null);
INSERT INTO roles VALUES (0x5033866E5D8049798D9E10C078787878, 'user', 'ChangePassword', 'Index', 0x502D7841CAB8401ABC8111B078787878, null);
INSERT INTO roles VALUES (0x5033866E6F8447B893BA10C078787878, 'user', 'ChangePassword', 'Index', 0x502A71209B244A32966E147C78787878, null);
INSERT INTO roles VALUES (0x5033866E88244CFE8F7810C078787878, 'user', 'ChangePassword', 'Index', 0x502BCC3209904C0CB79415C878787878, null);
INSERT INTO roles VALUES (0x5033866E9EA44EB7A06F10C078787878, 'user', 'ChangePassword', 'Index', 0x502BCC25D378467487CC15C878787878, null);
INSERT INTO roles VALUES (0x5033866EAB4C4686813210C078787878, 'user', 'ChangePassword', 'Index', 0x502BCBE6E4B0463F931115C878787878, null);
INSERT INTO roles VALUES (0x5033866EFE7840B6AB7210C078787878, 'user', 'ChangePassword', 'Index', 0x502A713A87F4444890C0147C78787878, null);
INSERT INTO roles VALUES (0x50338C048878474B915410C078787878, 'user', 'Admin', 'Index', 0x502D7841CAB8401ABC8111B078787878, null);
INSERT INTO roles VALUES (0x5033B3466B4446F89E5610C078787878, 'user', 'Groups', 'Admin', 0x502A713A87F4444890C0147C78787878, null);
INSERT INTO roles VALUES (0x503649E0912049A09F06064478787878, 'new', 'Category', 'Create', 0x502A71209B244A32966E147C78787878, null);
INSERT INTO roles VALUES (0x503649E8A8904B7F82C8064478787878, 'new', 'Category', 'Update', 0x502A71209B244A32966E147C78787878, null);
INSERT INTO roles VALUES (0x503649F0AA7447959530064478787878, 'new', 'Category', 'Delete', 0x502A71209B244A32966E147C78787878, null);
INSERT INTO roles VALUES (0x50364A7F23AC42789E0C064478787878, 'user', 'Admin', 'Index', 0x502BCC25D378467487CC15C878787878, null);
INSERT INTO roles VALUES (0x50364B0911504AA4A9F0064478787878, 'user', 'Logout', 'Index', 0x502BCBE6E4B0463F931115C878787878, null);
INSERT INTO roles VALUES (0x50364B09249C46529DF0064478787878, 'user', 'Logout', 'Index', 0x502BCC0B43D4490E8D3315C878787878, null);
INSERT INTO roles VALUES (0x50364B0950744743BD3B064478787878, 'user', 'Logout', 'Index', 0x502BCC1953144123A7C615C878787878, null);
INSERT INTO roles VALUES (0x50364B095FD84C8FA96D064478787878, 'user', 'Logout', 'Index', 0x502BCC25D378467487CC15C878787878, null);
INSERT INTO roles VALUES (0x50364B0965D04AFB8178064478787878, 'user', 'Logout', 'Index', 0x502A71209B244A32966E147C78787878, null);
INSERT INTO roles VALUES (0x50364B09EE744384A81F064478787878, 'user', 'Logout', 'Index', 0x502A71837D044E23A778147C78787878, null);
INSERT INTO roles VALUES (0x50364B09F7DC42BBBA37064478787878, 'user', 'Logout', 'Index', 0x502A713A87F4444890C0147C78787878, null);
INSERT INTO roles VALUES (0x50364B78AE344F0494AF064478787878, 'user', 'Logout', 'Index', 0x502BCC3209904C0CB79415C878787878, null);
INSERT INTO roles VALUES (0x50364B78BF78468D9D58064478787878, 'user', 'Logout', 'Index', 0x502BCC78DF084665B96315C878787878, null);
INSERT INTO roles VALUES (0x50364B78DFD4477883EC064478787878, 'user', 'Logout', 'Index', 0x502D7841CAB8401ABC8111B078787878, null);
INSERT INTO roles VALUES (0x50364B78E7E04959A4D8064478787878, 'user', 'Logout', 'Index', 0x502D2A9232684477883811B078787878, null);
INSERT INTO roles VALUES (0x504E17C5FCBC41CC99AE10CC78787878, 'user', 'Admin', 'Index', 0x502D2A9232684477883811B078787878, null);
INSERT INTO roles VALUES (0x506B181D188C41FBA48D176078787878, 'common', 'Order', 'Index', 0x502BCC25D378467487CC15C878787878, null);
INSERT INTO roles VALUES (0x506B1878526448E0B92B176078787878, 'common', 'Order', 'Upload', 0x502BCC25D378467487CC15C878787878, null);

-- ----------------------------
-- Table structure for `schedule`
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `object_o_id` binary(16) DEFAULT NULL,
  `object_n_id` binary(16) DEFAULT NULL,
  `filter` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of schedule
-- ----------------------------
INSERT INTO schedule VALUES (0x506C4721AE044E778C3917D478787878, 0x506C2AFD78BC4274B52617D478787878, 0x506C2EC0CF1040318F0117D478787878, '0');
INSERT INTO schedule VALUES (0x506C472E6098426897B617D478787878, 0x506C2EC0CF1040318F0117D478787878, 0x506C2ECA1C2C4F7EA35517D478787878, '1');
INSERT INTO schedule VALUES (0x506C4734B5CC4542AE7117D478787878, 0x506C2AFD78BC4274B52617D478787878, 0x506C2ECA1C2C4F7EA35517D478787878, '2');

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` binary(16) NOT NULL,
  `key` text NOT NULL,
  `value` text NOT NULL,
  `category` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO settings VALUES (0x5078E3FE33D046D690B4085078787878, 'cong-doan', '0.01', 'Quỹ công đoàn');
INSERT INTO settings VALUES (0x5078E479C304466D9C86085078787878, 'BHXH', '200000', 'Bảo hiểm xã hội');
INSERT INTO settings VALUES (0x5078E4F5F3784614BED1085078787878, 'BHYT', '150000', 'Bảo hiểm y tế');

-- ----------------------------
-- Table structure for `team`
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` binary(16) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of team
-- ----------------------------
INSERT INTO team VALUES (0x506C2AFD78BC4274B52617D478787878, 'Công nghệ 1', '');
INSERT INTO team VALUES (0x506C2EC0CF1040318F0117D478787878, 'Công nghệ 2', '');
INSERT INTO team VALUES (0x506C2ECA1C2C4F7EA35517D478787878, 'Liên Hợp', '');

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
  `salary` int(11) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES (0x502D14A7266445749E7811B078787878, 'Administrator', '', '0', '1989-09-08', '2012-10-02 15:24:29', 'sadmin@cfcn2.vn', '1349265492', 'd8406e8445cc99a16ab984cc28f6931615c766fc', '0', '201576599', 0x502A71209B244A32966E147C78787878, '934477703', null, 'admin', '1', '2500000', '13491922801449.jpg');
INSERT INTO users VALUES (0x502D166918A84FEB9F1D11B078787878, 'Quán', 'Đức Bình', '0', '2012-08-08', '2012-10-02 15:25:52', 'binhqd@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', '435345435', 0x502BCC25D378467487CC15C878787878, '5464565', null, null, '0', '2500000', null);
INSERT INTO users VALUES (0x502D250B8D684673AC8111B078787878, 'Phan', 'Ngọc Lợi', '0', '1984-01-04', '2012-10-02 15:25:35', 'loipn@webdev.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, '905687987', null, null, '0', '2500000', null);
INSERT INTO users VALUES (0x502D2536D7FC4B17A87F11B078787878, 'Huỳnh', 'Đức Dũng', '0', '2012-08-07', '2012-08-16 18:52:06', 'dunghd@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, '905687987', null, null, '0', null, null);
INSERT INTO users VALUES (0x502D257398104517A7F011B078787878, 'Phan', 'Quốc Thịnh', '0', '2012-08-14', '2012-08-30 17:24:05', 'thinhpq@appdev.vn', '1349195761', '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0', '5500000', '1349195995401.jpg');
INSERT INTO users VALUES (0x502D2593D93841F6929411B078787878, 'Nguyễn', 'Đại Đồng', '0', '2012-08-16', '2012-08-16 18:53:39', 'dongnd@appdev.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0', null, null);
INSERT INTO users VALUES (0x502D25B67B744B23BB3B11B078787878, 'Võ', 'Văn Đức', '0', '2012-08-13', '2012-08-16 18:54:14', 'ducvv@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, 'a', '0', null, null);
INSERT INTO users VALUES (0x502D25E978704FED90B311B078787878, 'Bùi', 'Thị Thu Thủy', '0', '2012-08-09', '2012-08-16 18:55:05', 'thuybtt@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0', null, null);
INSERT INTO users VALUES (0x502D261676B842E0911211B078787878, 'Phạm', ' Cao Diệu Kha', '0', '2012-05-22', '2012-10-02 15:25:16', 'khapcd@appdev.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0', '2500000', null);
INSERT INTO users VALUES (0x502D263BB1C04F5DBC4511B078787878, 'Nguyễn ', 'Công Minh', '0', '1989-08-11', '2012-10-02 15:25:04', 'minhnc@appdev.vn', null, '17295414f6b30cc4387c2508e0b9283c7f4bc23d', '0', null, 0x502BCC25D378467487CC15C878787878, null, '0', null, '0', '2500000', null);
INSERT INTO users VALUES (0x502D26806C844278948111B078787878, 'Tạ', 'Bá Thành Huy', '0', '1990-11-07', '2012-08-16 18:57:36', 'huytbt@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0', null, null);
INSERT INTO users VALUES (0x502D26A6488C46B3918711B078787878, 'Đinh ', 'Đức Trọng', '0', '1977-05-02', '2012-08-16 18:58:14', 'trongdd@toancauxanh.vn', null, '909b29a84c6710434d9321287038f3ee3dadbb4b', '0', null, 0x502BCC25D378467487CC15C878787878, null, null, null, '0', null, null);
INSERT INTO users VALUES (0x506B107EBBF846B2A00C176078787878, 'Nguyễn Thị', 'Tằm', '0', '2012-10-04', '2012-10-02 18:04:14', 'ntam5292@gmail.com', null, '10470c3b4b1fed12c3baac014be15fac67c6e815', '0', null, 0x502BCC25D378467487CC15C878787878, null, '1', null, '0', '2500000', null);
INSERT INTO users VALUES (0x506B10D323BC4A368DB1176078787878, 'Nguyễn Minh', 'Ngọc', '0', '2012-10-02', '2012-10-02 18:05:39', 'nguyenminhngoc1089@gmail.com', null, '10470c3b4b1fed12c3baac014be15fac67c6e815', '0', null, 0x502BCC25D378467487CC15C878787878, null, '0', null, '0', '2500000', null);
INSERT INTO users VALUES (0x506B10F374B0491F996C176078787878, 'Nguyễn', 'Trường Thành', '0', '2012-10-11', '2012-10-02 18:06:11', 'nguyentruongthanhdn@gmail.com', null, '10470c3b4b1fed12c3baac014be15fac67c6e815', '0', null, 0x502BCC25D378467487CC15C878787878, null, '0', null, '0', '2500000', null);
INSERT INTO users VALUES (0x506B112621C445AEB7CC176078787878, 'Hồ', 'Viết Thiên', '0', '2012-10-04', '2012-10-02 18:07:02', 'thienhv@toancauxanh.vn', null, '10470c3b4b1fed12c3baac014be15fac67c6e815', '0', null, 0x502BCC25D378467487CC15C878787878, null, '0', null, '0', '2500000', null);

-- ----------------------------
-- Table structure for `wages`
-- ----------------------------
DROP TABLE IF EXISTS `wages`;
CREATE TABLE `wages` (
  `id` binary(16) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wages
-- ----------------------------
INSERT INTO wages VALUES (0x503F824489044276B274116878787878, 'Thử việc', '2500000');
INSERT INTO wages VALUES (0x503F83D29278490989C8116878787878, 'Chính thức', '3500000');
INSERT INTO wages VALUES (0x503F83EBA64840F7A28F116878787878, 'Mức 1', '4000000');
INSERT INTO wages VALUES (0x503F83F8B6D44C2F98AD116878787878, 'Mức 2', '4500000');
INSERT INTO wages VALUES (0x503F8417BF9C40AFA9A4116878787878, 'Mức 3', '5000000');
INSERT INTO wages VALUES (0x503F843B5AB44F958252116878787878, 'Mức 4', '5500000');
