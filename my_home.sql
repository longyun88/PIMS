

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型',
  `belong_id` int(11) NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activities
-- ----------------------------

-- ----------------------------
-- Table structure for catalog_column
-- ----------------------------
DROP TABLE IF EXISTS `catalog_column`;
CREATE TABLE `catalog_column` (
  `id` int(11) NOT NULL DEFAULT '0',
  `catalog_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of catalog_column
-- ----------------------------

-- ----------------------------
-- Table structure for catalog_row
-- ----------------------------
DROP TABLE IF EXISTS `catalog_row`;
CREATE TABLE `catalog_row` (
  `id` int(11) NOT NULL DEFAULT '0',
  `catalog_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updaded_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of catalog_row
-- ----------------------------

-- ----------------------------
-- Table structure for catalog_value
-- ----------------------------
DROP TABLE IF EXISTS `catalog_value`;
CREATE TABLE `catalog_value` (
  `id` int(11) NOT NULL DEFAULT '0',
  `catalog_id` int(11) NOT NULL DEFAULT '0',
  `column_id` int(11) NOT NULL,
  `row_id` int(11) NOT NULL DEFAULT '0',
  `value` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of catalog_value
-- ----------------------------

-- ----------------------------
-- Table structure for catalogues
-- ----------------------------
DROP TABLE IF EXISTS `catalogues`;
CREATE TABLE `catalogues` (
  `id` int(11) NOT NULL DEFAULT '0',
  `column` int(11) NOT NULL DEFAULT '0',
  `row` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `order` varchar(64) CHARACTER SET utf8 NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of catalogues
-- ----------------------------

-- ----------------------------
-- Table structure for chats
-- ----------------------------
DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `source_id` int(11) NOT NULL COMMENT '发送人',
  `object_id` int(11) NOT NULL COMMENT '接收人',
  `content` text CHARACTER SET utf8,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of chats
-- ----------------------------

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_version` int(11) DEFAULT NULL,
  `source_id` int(11) NOT NULL COMMENT '评论者',
  `object_id` int(11) DEFAULT NULL COMMENT '评论接受者',
  `reply_id` int(11) DEFAULT NULL COMMENT '回复id',
  `dialog_id` int(11) DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for dialogs
-- ----------------------------
DROP TABLE IF EXISTS `dialogs`;
CREATE TABLE `dialogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `dialog_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `alert` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否提示 0 不提示，1 提示',
  `unread` int(11) NOT NULL DEFAULT '0' COMMENT '未读信息数',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 0 未激活 1 正常状态 2 接收消息不提示',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of dialogs
-- ----------------------------
INSERT INTO `dialogs` VALUES ('1', '1', '0', '120', '120', '1200', '1', '1', '1', '1501682648', '1501682880');
INSERT INTO `dialogs` VALUES ('16', '2', '0', '120', '1', '0', '0', '0', '1', '1501726884', '1501726884');
INSERT INTO `dialogs` VALUES ('17', '2', '0', '120', '3', '0', '0', '0', '1', '1501726959', '1501765347');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned zerofill NOT NULL COMMENT '型类',
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `origin_price` int(11) DEFAULT NULL COMMENT '原价',
  `discount` tinyint(3) unsigned zerofill DEFAULT NULL COMMENT '扣折 100为不打折',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------

-- ----------------------------
-- Table structure for item_ext
-- ----------------------------
DROP TABLE IF EXISTS `item_ext`;
CREATE TABLE `item_ext` (
  `id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `theme` varchar(1024) DEFAULT NULL,
  `content` text,
  `attaching` text,
  `attachment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_ext
-- ----------------------------

-- ----------------------------
-- Table structure for item_goods
-- ----------------------------
DROP TABLE IF EXISTS `item_goods`;
CREATE TABLE `item_goods` (
  `id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_goods
-- ----------------------------

-- ----------------------------
-- Table structure for item_quote
-- ----------------------------
DROP TABLE IF EXISTS `item_quote`;
CREATE TABLE `item_quote` (
  `id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `quote_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_quote
-- ----------------------------

-- ----------------------------
-- Table structure for item_timer
-- ----------------------------
DROP TABLE IF EXISTS `item_timer`;
CREATE TABLE `item_timer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL,
  `time_type` tinyint(1) NOT NULL DEFAULT '1',
  `start_type` tinyint(1) NOT NULL DEFAULT '0',
  `end_type` tinyint(1) NOT NULL,
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_timer
-- ----------------------------

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of items
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2017_02_17_195218_create_jobs_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for relations
-- ----------------------------
DROP TABLE IF EXISTS `relations`;
CREATE TABLE `relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `belong_id` int(11) NOT NULL DEFAULT '0',
  `object_id` int(11) NOT NULL DEFAULT '0',
  `rename` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `relationship` tinyint(4) NOT NULL DEFAULT '0',
  `permission` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of relations
-- ----------------------------
INSERT INTO `relations` VALUES ('1', '1', '1', '1', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('2', '1', '2', '2', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('3', '1', '3', '3', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('4', '1', '61', '61', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('5', '1', '62', '62', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('6', '1', '63', '63', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('7', '1', '64', '64', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('8', '1', '65', '65', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('9', '1', '66', '66', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('10', '1', '67', '67', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('11', '1', '68', '68', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('12', '1', '69', '69', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('13', '1', '70', '70', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('14', '1', '71', '71', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('15', '1', '72', '72', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('16', '1', '73', '73', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('17', '1', '74', '74', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('18', '1', '75', '75', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('19', '1', '76', '76', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('20', '1', '77', '77', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('21', '1', '78', '78', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('22', '1', '79', '79', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('23', '1', '80', '80', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('24', '1', '81', '81', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('25', '1', '82', '82', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('26', '1', '83', '83', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('27', '1', '84', '84', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('28', '1', '85', '85', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('29', '1', '86', '86', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('30', '1', '87', '87', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('31', '1', '88', '88', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('32', '1', '89', '89', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('33', '1', '90', '90', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('34', '1', '91', '91', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('35', '1', '92', '92', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('36', '1', '93', '93', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('37', '1', '94', '94', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('38', '1', '95', '95', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('39', '1', '96', '96', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('40', '1', '97', '97', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('41', '1', '98', '98', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('42', '1', '99', '99', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('43', '1', '100', '100', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('44', '1', '120', '120', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('45', '1', '121', '121', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('46', '1', '122', '122', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('47', '1', '123', '123', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('48', '1', '124', '124', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('49', '1', '125', '125', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('50', '1', '126', '126', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('51', '1', '127', '127', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('52', '1', '128', '128', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('53', '1', '129', '129', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('54', '1', '130', '130', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('55', '1', '133', '133', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('56', '1', '333', '333', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('57', '1', '1000', '1000', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('58', '1', '1011', '1011', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('59', '1', '1012', '1012', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('60', '1', '11111', '11111', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('61', '1', '11113', '11113', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('62', '1', '11114', '11114', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('63', '1', '11115', '11115', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('64', '1', '11116', '11116', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('65', '1', '11117', '11117', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('66', '1', '11118', '11118', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('67', '1', '11119', '11119', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('68', '1', '11120', '11120', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('69', '1', '11121', '11121', null, '1', '0', null, null);
INSERT INTO `relations` VALUES ('107', '1', '120', '121', null, '51', '0', '1502480008', '1503111346');
INSERT INTO `relations` VALUES ('108', '1', '121', '120', null, '51', '0', '1502480008', '1502480778');
INSERT INTO `relations` VALUES ('109', '1', '120', '122', null, '31', '0', null, null);
INSERT INTO `relations` VALUES ('110', '1', '122', '120', null, '31', '0', null, null);
INSERT INTO `relations` VALUES ('111', '1', '120', '123', null, '31', '0', null, null);
INSERT INTO `relations` VALUES ('112', '1', '123', '120', null, '31', '0', null, null);

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `alert` tinyint(4) NOT NULL DEFAULT '0',
  `unread` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `realname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itemCount` int(10) unsigned NOT NULL DEFAULT '0',
  `gender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1 男 2 女',
  `birth` int(11) NOT NULL DEFAULT '0',
  `autograph` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '个性签名',
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机',
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `company` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '企业',
  `company_department` varchar(23) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '部门',
  `company_position` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '职位',
  `school` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '学校',
  `school_department` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '院系',
  `school_major` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '专业',
  `present` varchar(32) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '现居地',
  `hometown` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '家乡',
  `permission` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `space` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11132 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES ('1', '1', '莲花树', '莲花树', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('2', '2', '莲花推广', '莲花推广', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('3', '3', '莲花小莲', '莲花小莲', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('61', '61', 'U61', 'U61', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('62', '62', 'U62', 'U62', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('63', '63', 'U63', 'U63', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('64', '64', '莲花科技2', '莲花科技', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('65', '65', 'U65', 'U65', '0', '1', '623260800', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('66', '66', '莲花体育2', '莲花体育', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('67', '67', '莲花娱乐2', '莲花娱乐', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('68', '68', '莲花影视2', '莲花影视', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('69', '69', '莲花动漫', '莲花动漫', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('70', '70', '莲花推荐x', '莲花推荐x', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('71', '71', '莲花头条2', '莲花头条', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('72', '72', '莲花旅行2', '莲花旅行', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('73', '73', '莲花美食2', '莲花美食', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('74', '74', '莲花公开课', '莲花公开课', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('75', '75', '轻博户外', '轻博户外', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('76', '76', 'U76', 'U76', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('77', '77', 'U77', 'U77', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('78', '78', '看客', '看客', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('79', '79', '开心一刻', '开心一刻', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('80', '80', '诸子百家', '诸子百家', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('81', '81', '罗辑思维', '罗辑思维', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('82', '82', '晓松奇谈', '晓松奇谈', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('83', '83', '锵锵三人行', '锵锵三人行', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('84', '84', 'U84', 'U84', '0', '1', '506102400', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('85', '85', 'U85', 'U85', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('86', '86', '财经郎眼', '财经郎眼', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('87', '87', '头脑风暴', '头脑风暴', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('88', '88', 'U88', 'U88', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('89', '89', 'U89', 'U89', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('90', '90', 'U90', 'U90', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('91', '91', '知乎', '知乎', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('92', '92', '知乎日报', '知乎日报', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('93', '93', '果壳网', '果壳网', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('94', '94', '极客公园', '极客公园', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('95', '95', '抽屉新热榜', '抽屉新热榜', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('96', '96', '百思不得姐', '百思不得姐', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('97', '97', 'U97', 'U97', '0', '1', '661881600', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('98', '98', '奇葩说', '奇葩说', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('99', '99', '测试用户99', '测试用户99', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('100', '100', '莲花精选', '莲花精选', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('120', '120', '内测号', '内测120', '0', '1', '600710400', '当我不去想我是谁的时候我是谁！', '15800689433', 'longyun-cui@163.com', '梅斯医药', '技术部', 'php 工程师', '上海应用技术大学', '计算机系', '计算机科学与技术', '上海', '黑龙江', '1', '1', null, '1503569480');
INSERT INTO `user_info` VALUES ('121', '121', '内测121', '内测121', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1502480789');
INSERT INTO `user_info` VALUES ('122', '122', '崔龙云', '崔龙云', '0', '1', '600710400', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1502472544');
INSERT INTO `user_info` VALUES ('123', '123', '鲜鲜', '鲜鲜', '0', '1', '624988800', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('124', '124', '龙猫', '夏天', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('125', '125', '苗大咪', '金晶', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('126', '126', '爸爸不爱你', 'Gym', '0', '1', '-23788800', '真爱万岁', '', '', '造纸厂', '人力资源部', '狗腿子', '上海应用技术学院', '经管学院', '市场营销（中加）', '牡丹江', '林口', '1', '1', null, '1505398675');
INSERT INTO `user_info` VALUES ('127', '127', 'U127', 'U127', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('128', '128', 'U128', 'U128', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('129', '129', 'U129', 'U129', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('130', '130', 'U130', 'U130', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('133', '133', '轻博艺术', '轻博艺术', '0', '1', '0', '', '', null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('333', '333', '轻博小轻', '轻博小轻', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('1000', '1000', 'guest', 'guest', '0', '1', '631123200', '游客体验账户，', null, null, '', '', '', null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('1011', '1011', '莲花体育', '莲花体育', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1503111303');
INSERT INTO `user_info` VALUES ('1012', '1012', '轻博娱乐', '轻博娱乐', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11111', '11111', '旅程', '旅程', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1502979301');
INSERT INTO `user_info` VALUES ('11113', '11113', '时间头条', '时间头条', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11114', '11114', '莲花展会', '莲花展会', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11115', '11115', '投资日历', '投资日历', '0', '1', '0', null, '11111111111', null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11116', '11116', '莲花出行', '莲花出行', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11117', '11117', '在上海', '在上海', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11118', '11118', '在北京', '轻博北京', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11119', '11119', '在广州', '轻博广州', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11120', '11120', '在深圳', '轻薄深圳', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11121', '11121', 'longyun', 'longyun', '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', null, '1501411475');
INSERT INTO `user_info` VALUES ('11130', '11130', '321', null, '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', '1503246186', '1503246186');
INSERT INTO `user_info` VALUES ('11131', '11131', 'Daisy', null, '0', '1', '0', null, null, null, null, null, null, null, null, null, '0', null, '1', '1', '1503308268', '1503308268');

-- ----------------------------
-- Table structure for user_item
-- ----------------------------
DROP TABLE IF EXISTS `user_item`;
CREATE TABLE `user_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `item_belong_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL,
  `favor_is` tinyint(1) NOT NULL DEFAULT '0',
  `favor_time` int(11) NOT NULL DEFAULT '0',
  `score_is` tinyint(4) NOT NULL DEFAULT '0',
  `score_num` tinyint(4) NOT NULL DEFAULT '0',
  `score_time` int(11) NOT NULL DEFAULT '0',
  `collect_is` tinyint(1) NOT NULL DEFAULT '0',
  `collect_time` int(11) NOT NULL DEFAULT '0',
  `focus_is` tinyint(1) NOT NULL DEFAULT '0',
  `focus_time` int(11) NOT NULL DEFAULT '0',
  `work_is` tinyint(1) NOT NULL DEFAULT '0',
  `work_time` int(11) NOT NULL DEFAULT '0',
  `importance` tinyint(1) NOT NULL DEFAULT '0',
  `agenda_is` tinyint(1) NOT NULL DEFAULT '0',
  `agenda_time` int(11) NOT NULL DEFAULT '0',
  `time_type` tinyint(1) NOT NULL DEFAULT '0',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL,
  `remind_time` int(11) NOT NULL,
  `answer_is` tinyint(1) NOT NULL DEFAULT '0',
  `answer_time` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_item
-- ----------------------------
INSERT INTO `user_item` VALUES ('1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1501028162', '1501028162');
INSERT INTO `user_item` VALUES ('33', '120', '1230', '126', '0', '1', '1501916403', '0', '0', '0', '99', '1502602258', '99', '1501916411', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1501857195', '1502602258');
INSERT INTO `user_item` VALUES ('34', '120', '1229', '11111', '0', '99', '1502614784', '1', '1', '1502614714', '99', '1502614794', '0', '0', '99', '1502617873', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1502599033', '1502617873');
INSERT INTO `user_item` VALUES ('35', '120', '1228', '11111', '0', '1', '1502599387', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1502599142', '1502599387');
INSERT INTO `user_item` VALUES ('36', '120', '1213', '11111', '0', '0', '0', '0', '0', '0', '1', '1502599397', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1502602565', '1502602565');
INSERT INTO `user_item` VALUES ('37', '120', '1212', '11111', '0', '0', '0', '0', '0', '0', '1', '1502599487', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1502602615', '1502602615');
INSERT INTO `user_item` VALUES ('38', '120', '1220', '1011', '0', '0', '0', '0', '0', '0', '99', '1502618456', '0', '0', '99', '1502607763', '0', '99', '1503326761', '1', '1496515500', '1496591999', '0', '0', '0', '1502603051', '1503326761');
INSERT INTO `user_item` VALUES ('39', '1011', '1220', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '99', '1502969654', '0', '1', '1502969654', '1', '1496515500', '1496591999', '0', '0', '0', '1502969645', '1502969654');
INSERT INTO `user_item` VALUES ('40', '1011', '1219', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '99', '1502969659', '0', '1', '1502969659', '1', '1495651500', '1495727999', '0', '0', '0', '1502969650', '1502969659');
INSERT INTO `user_item` VALUES ('41', '120', '1245', '11111', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503316024', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1503316024', '1503316024');
INSERT INTO `user_item` VALUES ('42', '120', '1244', '11111', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503329577', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1503329577', '1503329577');
INSERT INTO `user_item` VALUES ('67', '1011', '1282', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503380104', '1', '1503403200', '1503417599', '0', '0', '0', '1503380104', '1503380104');
INSERT INTO `user_item` VALUES ('68', '1011', '1286', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503673098', '1', '1503795600', '1503849599', '0', '0', '0', '1503673098', '1503673098');
INSERT INTO `user_item` VALUES ('69', '1011', '1287', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503673531', '1', '1504166400', '1504195199', '0', '0', '0', '1503673531', '1503673531');
INSERT INTO `user_item` VALUES ('70', '1011', '1288', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503673605', '1', '1504598400', '1504627199', '0', '0', '0', '1503673605', '1503673605');
INSERT INTO `user_item` VALUES ('71', '120', '1233', '120', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503815989', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1503815957', '1503815989');
INSERT INTO `user_item` VALUES ('72', '120', '1286', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1503818068', '1', '1503795600', '1503849599', '0', '0', '0', '1503818068', '1503818068');
INSERT INTO `user_item` VALUES ('73', '120', '1064', '122', '0', '1', '1503823043', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1503823043', '1503823043');
INSERT INTO `user_item` VALUES ('74', '126', '1230', '126', '0', '1', '1507007986', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1505397774', '1507007986');
INSERT INTO `user_item` VALUES ('75', '1011', '1300', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1509171236', '1', '1509175800', '1509206399', '0', '0', '0', '1509171236', '1509171236');
INSERT INTO `user_item` VALUES ('76', '1011', '1301', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1509171290', '1', '1509262200', '1509292799', '0', '0', '0', '1509171290', '1509171290');
INSERT INTO `user_item` VALUES ('77', '1011', '1302', '1011', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1509771404', '1', '1509778800', '1509811199', '0', '0', '0', '1509771404', '1509771404');

-- ----------------------------
-- Table structure for user_item_schedule
-- ----------------------------
DROP TABLE IF EXISTS `user_item_schedule`;
CREATE TABLE `user_item_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `time_type` tinyint(4) NOT NULL DEFAULT '0',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_item_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for user_item_todolist
-- ----------------------------
DROP TABLE IF EXISTS `user_item_todolist`;
CREATE TABLE `user_item_todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL,
  `importance` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_item_todolist
-- ----------------------------
INSERT INTO `user_item_todolist` VALUES ('26', '120', '1233', '1', '0', '0', '0');
INSERT INTO `user_item_todolist` VALUES ('27', '120', '1230', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for user_log
-- ----------------------------
DROP TABLE IF EXISTS `user_log`;
CREATE TABLE `user_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `owner` int(10) unsigned NOT NULL DEFAULT '0',
  `pass_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass_phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nickname` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `realname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_alert` int(10) unsigned NOT NULL DEFAULT '0',
  `session_unread` int(10) unsigned NOT NULL DEFAULT '0',
  `session_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `session_id` int(10) unsigned NOT NULL DEFAULT '0',
  `session_last_time` bigint(20) unsigned NOT NULL DEFAULT '0',
  `session_read_time` bigint(20) unsigned NOT NULL DEFAULT '0',
  `log` int(10) unsigned NOT NULL DEFAULT '0',
  `last` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `version` int(10) unsigned NOT NULL DEFAULT '0',
  `permission` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `inputway` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pass email` (`pass_email`),
  UNIQUE KEY `pass name` (`pass_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11132 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_log
-- ----------------------------
INSERT INTO `user_log` VALUES ('1', '1', '1', '0', '0', null, null, null, 'longyun', '莲花树', '莲花树', '0', '0', '0', '0', '0', '0', '12', '1449226473', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('2', '1', '1', '0', '0', null, null, null, 'longyun', '莲花推广', '莲花推广', '0', '0', '0', '0', '0', '0', '8', '1449115083', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('3', '1', '1', '0', '0', null, null, null, 'longyun', '莲花小莲', '莲花小莲', '0', '0', '0', '0', '0', '0', '8', '1449152577', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('61', '1', '1', '0', '0', 'U61', null, null, '1', 'U61', 'U61', '0', '0', '0', '0', '0', '0', '11', '1491854733', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('62', '1', '1', '0', '0', 'U62', null, null, '1', 'U62', 'U62', '0', '0', '0', '0', '0', '0', '8', '1461309291', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('63', '1', '1', '0', '0', null, null, null, '1', 'U63', 'U63', '0', '0', '0', '0', '0', '0', '17', '1491851043', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('64', '1', '2', '0', '0', null, null, null, '1', '莲花科技2', '莲花科技', '0', '0', '0', '0', '0', '0', '18', '1491854228', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('65', '1', '1', '0', '0', 'U65', null, null, '1', 'U65', 'U65', '0', '0', '0', '0', '0', '0', '10', '1491851545', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('66', '1', '2', '0', '0', null, null, null, '1', '莲花体育2', '莲花体育', '0', '0', '0', '0', '0', '0', '45', '1491853965', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('67', '1', '2', '0', '0', null, null, null, '1', '莲花娱乐2', '莲花娱乐', '0', '0', '0', '0', '0', '0', '16', '1492617647', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('68', '1', '2', '0', '0', null, null, null, '1', '莲花影视2', '莲花影视', '0', '0', '0', '0', '0', '0', '19', '1491854256', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('69', '1', '2', '0', '0', null, null, null, '1', '莲花动漫', '莲花动漫', '0', '0', '0', '0', '0', '0', '11', '1491854305', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('70', '1', '2', '0', '0', null, null, null, '1', '莲花推荐x', '莲花推荐x', '0', '0', '0', '0', '0', '0', '11', '1492617754', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('71', '1', '2', '0', '0', null, null, null, '1', '莲花头条2', '莲花头条', '0', '0', '0', '0', '0', '0', '9', '1450206474', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('72', '1', '2', '0', '0', null, null, null, '1', '莲花旅行2', '莲花旅行', '0', '0', '0', '0', '0', '0', '8', '1449057378', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('73', '1', '2', '0', '0', null, null, null, '1', '莲花美食2', '莲花美食', '0', '0', '0', '0', '0', '0', '8', '1449057416', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('74', '1', '2', '0', '0', null, null, null, '1', '莲花公开课', '莲花公开课', '0', '0', '0', '0', '0', '0', '18', '1491854185', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('75', '1', '2', '0', '0', null, null, null, '1', '轻博户外', '轻博户外', '0', '0', '0', '0', '0', '0', '9', '1491854324', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('76', '1', '1', '0', '0', 'U76', null, null, '1', 'U76', 'U76', '0', '0', '0', '0', '0', '0', '9', '1492620056', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('77', '1', '1', '0', '0', 'U77', null, null, '1', 'U77', 'U77', '0', '0', '0', '0', '0', '0', '9', '1454674821', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('78', '1', '2', '0', '0', null, null, null, '1', '看客', '看客', '0', '0', '0', '0', '0', '0', '9', '1492617837', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('79', '1', '2', '0', '0', null, null, null, '1', '开心一刻', '开心一刻', '0', '0', '0', '0', '0', '0', '10', '1491854333', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('80', '1', '2', '0', '0', null, null, null, '1', '诸子百家', '诸子百家', '0', '0', '0', '0', '0', '0', '9', '1492618188', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('81', '1', '2', '0', '0', null, null, null, '1', '罗辑思维', '罗辑思维', '0', '0', '0', '0', '0', '0', '31', '1492617861', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('82', '1', '2', '0', '0', null, null, null, '1', '晓松奇谈', '晓松奇谈', '0', '0', '0', '0', '0', '0', '20', '1492618436', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('83', '1', '2', '0', '0', null, null, null, '1', '锵锵三人行', '锵锵三人行', '0', '0', '0', '0', '0', '0', '12', '1492618234', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('84', '1', '1', '0', '0', 'U84', null, null, '1', 'U84', 'U84', '0', '0', '0', '0', '0', '0', '13', '1492622863', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('85', '1', '1', '0', '0', null, null, null, '1', 'U85', 'U85', '0', '0', '0', '0', '0', '0', '9', '1492622800', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('86', '1', '2', '0', '0', null, null, null, '1', '财经郎眼', '财经郎眼', '0', '0', '0', '0', '0', '0', '11', '1492618221', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('87', '1', '2', '0', '0', null, null, null, '1', '头脑风暴', '头脑风暴', '0', '0', '0', '0', '0', '0', '9', '1492618270', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('88', '1', '1', '0', '0', 'U88', null, null, '1', 'U88', 'U88', '0', '0', '0', '0', '0', '0', '12', '1491854660', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('89', '1', '1', '0', '0', 'U89', null, null, '1', 'U89', 'U89', '0', '0', '0', '0', '0', '0', '9', '1492618506', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('90', '1', '2', '0', '0', 'U90', null, null, '1', 'U90', 'U90', '0', '0', '0', '0', '0', '0', '18', '1492619488', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('91', '1', '2', '0', '0', null, null, null, '1', '知乎', '知乎', '0', '0', '0', '0', '0', '0', '14', '1492618277', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('92', '1', '2', '0', '0', null, null, null, '1', '知乎日报', '知乎日报', '0', '0', '0', '0', '0', '0', '8', '1450597379', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('93', '1', '2', '0', '0', null, null, null, '1', '果壳网', '果壳网', '0', '0', '0', '0', '0', '0', '10', '1492618364', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('94', '1', '2', '0', '0', null, null, null, '1', '极客公园', '极客公园', '0', '0', '0', '0', '0', '0', '8', '1461130470', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('95', '1', '2', '0', '0', null, null, null, '1', '抽屉新热榜', '抽屉新热榜', '0', '0', '0', '0', '0', '0', '19', '1491854485', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('96', '1', '2', '0', '0', null, null, null, '1', '百思不得姐', '百思不得姐', '0', '0', '0', '0', '0', '0', '14', '1491854545', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('97', '1', '1', '0', '0', null, null, null, '1', 'U97', 'U97', '0', '0', '0', '0', '0', '0', '12', '1452743510', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('98', '1', '2', '0', '0', null, null, null, '1', '奇葩说', '奇葩说', '0', '0', '0', '0', '0', '0', '12', '1492618381', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('99', '1', '2', '0', '0', null, null, null, '1', '测试用户99', '测试用户99', '0', '0', '0', '0', '0', '0', '20', '1483005062', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('100', '1', '0', '0', '0', null, null, null, '123', '莲花精选', '莲花精选', '0', '0', '0', '310', '1500795415', '1500795424', '77', '1500795339', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('120', '1', '1', '0', '0', 'test2', null, 'longyun@qingbo8.cn', '1', '内测号', '内测120', '0', '0', '0', '111', '1499128212', '1510947044', '544', '1501342420', '180.156.222.98', '0', '1', '1', null, '1510947042', 'pLhMecWvgDffajUxW9NcjPcg1wRCN51FwGJ6aNXAJ2YSh3YNumBqb0FQ4VKx');
INSERT INTO `user_log` VALUES ('121', '1', '1', '0', '0', 'test1', null, null, '1', '内测121', '内测121', '0', '0', '0', '17', '1492794435', '1502480583', '62', '1492794428', '58.39.62.162', '0', '1', '1', null, '1502480789', '41js3LfnDNPhGi7DxZdPgeeSqOb4FjXQUxSG231yBI5loBesrgXDCSzuON1u');
INSERT INTO `user_log` VALUES ('122', '1', '1', '0', '0', 'longyun88', null, null, 'longyun', '崔龙云', '崔龙云', '0', '0', '0', '72', '1500644268', '1504024239', '412', '1500644261', '116.224.232.18', '0', '1', '1', null, '1504024241', 'rnPUsTYcAsYkZ5DWm2i2dYiI7CAMAjLFZD9ZYobiCHpfWAk87VUl0pHeneQE');
INSERT INTO `user_log` VALUES ('123', '1', '1', '0', '0', null, null, null, 'xianxian', '鲜鲜', '鲜鲜', '0', '0', '0', '0', '0', '0', '70', '1492622002', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('124', '1', '1', '0', '0', null, null, null, '1', '龙猫', '夏天', '0', '0', '0', '0', '0', '0', '8', '1449538940', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('125', '1', '1', '0', '0', null, null, null, '123qwe', '苗大咪', '金晶', '0', '0', '0', '0', '0', '0', '11', '1492622850', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('126', '1', '1', '0', '0', null, null, null, 'heheHEHE', 'heheHEHE', 'Gym', '0', '1', '0', '10', '1500644268', '1505397744', '27', '1501386843', '113.3.244.63', '0', '1', '1', null, '1505397263', 'nCkmFOddhCGyMU2dVKPnxk6LzbspACYERQJoqCJt2sfhSav0KfW8oJZBC2bQ');
INSERT INTO `user_log` VALUES ('127', '1', '1', '0', '0', 'U127', null, null, '1', 'U127', 'U127', '0', '0', '0', '0', '0', '0', '8', '1449577440', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('128', '1', '1', '0', '0', 'U128', null, null, '1', 'U128', 'U128', '0', '0', '0', '0', '0', '1494252749', '41', '1494252746', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('129', '1', '1', '0', '0', 'U129', null, null, '1', 'U129', 'U129', '0', '0', '0', '0', '0', '0', '9', '1488787415', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('130', '1', '1', '0', '0', 'U130', null, null, '1', 'U130', 'U130', '0', '0', '0', '0', '0', '0', '8', '1450755567', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('133', '1', '1', '0', '0', null, null, null, '1', '轻博艺术', '轻博艺术', '0', '0', '0', '0', '0', '0', '15', '1490812132', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('333', '1', '1', '0', '0', 'qingbo333', null, null, '1', '轻博小轻', '轻博小轻', '0', '0', '0', '0', '0', '0', '40', '1492621873', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('1000', '1', '1', '0', '0', 'guest', null, null, '123', 'guest', 'guest', '0', '0', '0', '0', '0', '0', '60', '1476081998', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('1011', '1', '1', '0', '0', 'qingbotiy', null, null, '1', '莲花体育', '莲花体育', '0', '2', '0', '116', '1495594852', '1509771368', '62', '1495594825', '180.156.223.140', '0', '1', '1', null, '1509771409', 'eO1v5Ap1yB5qXpGfu77Gz5t2BVFrd6QTl567eEpTI2wmvT7Fzz245xgMGvHm');
INSERT INTO `user_log` VALUES ('1012', '1', '1', '0', '0', 'qingboyule2', null, null, '1', '轻博娱乐', '轻博娱乐', '0', '0', '0', '0', '0', '0', '15', '1492622016', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11111', '1', '1', '0', '0', 'longyun', '15800689433', null, 'longyun', '旅程', '旅程', '0', '42', '0', '5', '1493928325', '1504105817', '38', '1500550741', '116.224.232.18', '0', '1', '1', null, '1504105818', '6bpy0hFZLwsdAenNnCB0he8kYvyiRHDMgjHf0d8rEQx8z8W9EKLwTd1mKnJl');
INSERT INTO `user_log` VALUES ('11113', '1', '1', '0', '0', 'qingbotuijian', '', null, '1', '时间头条', '时间头条', '0', '27', '0', '12', '1500795415', '1500795474', '28', '1500795441', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11114', '1', '1', '0', '0', 'zhanhui', '13798762534', null, '1', '莲花展会', '莲花展会', '0', '0', '0', '0', '0', '0', '11', '1492621150', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11115', '1', '1', '0', '0', 'touzirili', '13765678987', null, '1', '投资日历', '投资日历', '0', '0', '0', '0', '0', '0', '12', '1492621185', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11116', '1', '1', '0', '0', 'chuxing', '13787657788', null, '1', '莲花出行', '莲花出行', '0', '0', '0', '0', '0', '0', '11', '1490691765', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11117', '1', '1', '0', '0', 'shanghai', '13888888888', null, '1', '在上海', '在上海', '0', '0', '0', '0', '0', '0', '14', '1492621927', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11118', '1', '1', '0', '0', 'qingbobeijing', '13898989898', null, '1', '在北京', '轻博北京', '0', '0', '0', '0', '0', '0', '10', '1490690968', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11119', '1', '1', '0', '0', 'qingboguangzhou', '13899998989', null, '1', '在广州', '轻博广州', '0', '0', '0', '0', '0', '0', '7', '0', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11120', '1', '1', '0', '0', 'qingboshenzhen', '13899998889', null, '1', '在深圳', '轻薄深圳', '0', '0', '0', '0', '0', '0', '7', '0', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11121', '0', '1', '0', '0', 'longyun22', '15998741236', null, '1', 'longyun', 'longyun', '0', '0', '0', '0', '0', '0', '7', '0', '116.238.69.200', '0', '1', '1', null, '1501411475', null);
INSERT INTO `user_log` VALUES ('11130', '0', '0', '0', '0', null, null, '123@1234.com', '123', '321', null, '0', '0', '0', '0', '0', '1503246285', '1', '0', '116.224.232.18', '0', '1', '1', '1503246186', '1503246292', 'JsVh5yQvMLOBogFPnkb8w22IXMh9lXdcj5buqvVxmZwBcWbLJJJPTsJ50jj8');
INSERT INTO `user_log` VALUES ('11131', '0', '0', '0', '0', null, null, '634559887@qq.com', 'mingji212', 'Daisy', null, '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '1', '1', '1503308268', '1503308268', null);

-- ----------------------------
-- Table structure for user_login
-- ----------------------------
DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `time` bigint(20) unsigned NOT NULL,
  `ip` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2518 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_login
-- ----------------------------
INSERT INTO `user_login` VALUES ('23', '0', '0', '1450920620', '112.65.193.15', null, null);
INSERT INTO `user_login` VALUES ('24', '0', '0', '1450920621', '1.182.31.33', null, null);
INSERT INTO `user_login` VALUES ('25', '0', '0', '1450920621', '101.226.33.221', null, null);
INSERT INTO `user_login` VALUES ('26', '0', '0', '1450921475', '120.42.41.182', null, null);
INSERT INTO `user_login` VALUES ('28', '0', '0', '1450923303', '223.104.255.238', null, null);
INSERT INTO `user_login` VALUES ('29', '0', '0', '1450924522', '61.129.106.230', null, null);
INSERT INTO `user_login` VALUES ('30', '136', '1', '1450924541', '61.129.106.230', null, null);
INSERT INTO `user_login` VALUES ('31', '0', '0', '1450924542', '180.153.206.29', null, null);
INSERT INTO `user_login` VALUES ('50', '0', '0', '1450934968', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('51', '0', '0', '1450938462', '1.183.13.47', null, null);
INSERT INTO `user_login` VALUES ('52', '0', '0', '1450938489', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('53', '132', '1', '1450938509', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('54', '0', '0', '1450943556', '180.173.157.43', null, null);
INSERT INTO `user_login` VALUES ('55', '0', '0', '1450943872', '180.173.157.43', null, null);
INSERT INTO `user_login` VALUES ('56', '0', '0', '1450943967', '180.173.157.43', null, null);
INSERT INTO `user_login` VALUES ('70', '0', '0', '1451026676', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('71', '132', '1', '1451026794', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('76', '0', '0', '1451046658', '101.85.243.152', null, null);
INSERT INTO `user_login` VALUES ('90', '0', '0', '1451206597', '101.226.66.180', null, null);
INSERT INTO `user_login` VALUES ('92', '0', '0', '1451209036', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('93', '0', '0', '1451209036', '101.226.33.225', null, null);
INSERT INTO `user_login` VALUES ('95', '0', '0', '1451209579', '119.147.146.193', null, null);
INSERT INTO `user_login` VALUES ('97', '0', '0', '1451211408', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('100', '0', '0', '1451221763', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('108', '0', '0', '1451233938', '121.42.0.17', null, null);
INSERT INTO `user_login` VALUES ('116', '0', '0', '1451278315', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('117', '0', '0', '1451278546', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('118', '0', '0', '1451279246', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('122', '0', '0', '1451288486', '220.181.108.97', null, null);
INSERT INTO `user_login` VALUES ('138', '0', '0', '1451321342', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('139', '0', '0', '1451321509', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('141', '0', '0', '1451321723', '119.147.146.189', null, null);
INSERT INTO `user_login` VALUES ('143', '0', '0', '1451351362', '101.226.66.180', null, null);
INSERT INTO `user_login` VALUES ('144', '0', '0', '1451351362', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('146', '0', '0', '1451355497', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('151', '0', '0', '1451367693', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('152', '0', '0', '1451367694', '180.153.212.13', null, null);
INSERT INTO `user_login` VALUES ('155', '0', '0', '1451369863', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('158', '0', '0', '1451370709', '218.7.106.2', null, null);
INSERT INTO `user_login` VALUES ('159', '126', '1', '1451370741', '218.7.106.2', null, null);
INSERT INTO `user_login` VALUES ('160', '0', '0', '1451371050', '14.17.18.147', null, null);
INSERT INTO `user_login` VALUES ('162', '0', '0', '1451372163', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('164', '0', '0', '1451379808', '180.173.152.196', null, null);
INSERT INTO `user_login` VALUES ('165', '129', '1', '1451379832', '180.173.152.196', null, null);
INSERT INTO `user_login` VALUES ('166', '0', '0', '1451386633', '122.225.27.24', null, null);
INSERT INTO `user_login` VALUES ('167', '0', '0', '1451389354', '124.77.192.87', null, null);
INSERT INTO `user_login` VALUES ('170', '0', '0', '1451401123', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('178', '0', '0', '1451407026', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('184', '0', '0', '1451450841', '221.231.6.246', null, null);
INSERT INTO `user_login` VALUES ('185', '0', '0', '1451450841', '221.231.6.246', null, null);
INSERT INTO `user_login` VALUES ('186', '0', '0', '1451450841', '221.231.6.246', null, null);
INSERT INTO `user_login` VALUES ('187', '0', '0', '1451450841', '221.231.6.246', null, null);
INSERT INTO `user_login` VALUES ('198', '0', '0', '1451467506', '180.156.254.120', null, null);
INSERT INTO `user_login` VALUES ('206', '0', '0', '1451500528', '180.153.163.209', null, null);
INSERT INTO `user_login` VALUES ('207', '0', '0', '1451500535', '119.147.146.192', null, null);
INSERT INTO `user_login` VALUES ('209', '0', '0', '1451527548', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('210', '132', '1', '1451527607', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('211', '0', '0', '1451527690', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('212', '132', '1', '1451527722', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('213', '0', '0', '1451527890', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('214', '0', '0', '1451527966', '218.30.137.139', null, null);
INSERT INTO `user_login` VALUES ('215', '0', '0', '1451528036', '218.7.106.2', null, null);
INSERT INTO `user_login` VALUES ('218', '0', '0', '1451531140', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('219', '132', '1', '1451531148', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('227', '0', '0', '1451538744', '119.147.146.189', null, null);
INSERT INTO `user_login` VALUES ('228', '0', '0', '1451556302', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('229', '0', '0', '1451575492', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('230', '0', '0', '1451606556', '121.42.0.37', null, null);
INSERT INTO `user_login` VALUES ('231', '0', '0', '1451623088', '116.224.100.62', null, null);
INSERT INTO `user_login` VALUES ('232', '66', '1', '1451623166', '116.224.100.62', null, null);
INSERT INTO `user_login` VALUES ('233', '100', '1', '1451623486', '116.224.100.62', null, null);
INSERT INTO `user_login` VALUES ('234', '0', '0', '1451623642', '116.224.100.62', null, null);
INSERT INTO `user_login` VALUES ('235', '0', '0', '1451624102', '116.238.209.119', null, null);
INSERT INTO `user_login` VALUES ('236', '0', '0', '1451629740', '121.42.0.18', null, null);
INSERT INTO `user_login` VALUES ('243', '0', '0', '1451735939', '112.64.235.252', null, null);
INSERT INTO `user_login` VALUES ('244', '0', '0', '1451735941', '1.183.197.243', null, null);
INSERT INTO `user_login` VALUES ('245', '0', '0', '1451735942', '112.64.235.245', null, null);
INSERT INTO `user_login` VALUES ('246', '0', '0', '1451740288', '121.42.0.17', null, null);
INSERT INTO `user_login` VALUES ('256', '0', '0', '1451827981', '121.42.0.36', null, null);
INSERT INTO `user_login` VALUES ('264', '0', '0', '1451842689', '101.226.69.108', null, null);
INSERT INTO `user_login` VALUES ('270', '0', '0', '1451883755', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('273', '0', '0', '1451894651', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('274', '123', '1', '1451894671', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('277', '0', '0', '1451909732', '123.125.71.81', null, null);
INSERT INTO `user_login` VALUES ('279', '0', '0', '1451915215', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('280', '0', '0', '1451915217', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('281', '0', '0', '1451915505', '113.7.72.109', null, null);
INSERT INTO `user_login` VALUES ('282', '0', '0', '1451916342', '101.226.68.217', null, null);
INSERT INTO `user_login` VALUES ('283', '0', '0', '1451916344', '58.40.71.173', null, null);
INSERT INTO `user_login` VALUES ('284', '0', '0', '1451916435', '120.39.22.97', null, null);
INSERT INTO `user_login` VALUES ('286', '0', '0', '1451917242', '58.37.46.165', null, null);
INSERT INTO `user_login` VALUES ('289', '0', '0', '1451918454', '121.42.0.39', null, null);
INSERT INTO `user_login` VALUES ('297', '0', '0', '1451963015', '119.147.146.189', null, null);
INSERT INTO `user_login` VALUES ('301', '0', '0', '1451976119', '1.183.27.35', null, null);
INSERT INTO `user_login` VALUES ('302', '0', '0', '1451976119', '101.226.33.226', null, null);
INSERT INTO `user_login` VALUES ('303', '0', '0', '1451981498', '117.136.8.238', null, null);
INSERT INTO `user_login` VALUES ('304', '0', '0', '1451997170', '221.231.6.246', null, null);
INSERT INTO `user_login` VALUES ('305', '0', '0', '1451997217', '221.231.6.246', null, null);
INSERT INTO `user_login` VALUES ('306', '0', '0', '1451997224', '221.231.6.246', null, null);
INSERT INTO `user_login` VALUES ('307', '0', '0', '1451998301', '101.90.253.107', null, null);
INSERT INTO `user_login` VALUES ('309', '0', '0', '1452006202', '116.230.76.63', null, null);
INSERT INTO `user_login` VALUES ('310', '0', '0', '1452006677', '123.125.71.29', null, null);
INSERT INTO `user_login` VALUES ('311', '0', '0', '1452006692', '220.181.108.77', null, null);
INSERT INTO `user_login` VALUES ('316', '0', '0', '1452008883', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('317', '122', '1', '1452008900', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('318', '0', '0', '1452009005', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('324', '0', '0', '1452010160', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('325', '122', '1', '1452010175', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('327', '0', '0', '1452010367', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('333', '0', '0', '1452163270', '111.126.216.146', null, null);
INSERT INTO `user_login` VALUES ('334', '0', '0', '1452163270', '180.153.163.209', null, null);
INSERT INTO `user_login` VALUES ('335', '0', '0', '1452165048', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('336', '0', '0', '1452165050', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('337', '0', '0', '1452166383', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('338', '132', '1', '1452166431', '116.227.24.224', null, null);
INSERT INTO `user_login` VALUES ('339', '0', '0', '1452166460', '220.181.132.217', null, null);
INSERT INTO `user_login` VALUES ('340', '0', '0', '1452166474', '101.199.112.55', null, null);
INSERT INTO `user_login` VALUES ('342', '0', '0', '1452180833', '121.42.0.30', null, null);
INSERT INTO `user_login` VALUES ('343', '0', '0', '1452183871', '27.188.65.0', null, null);
INSERT INTO `user_login` VALUES ('344', '0', '0', '1452184356', '123.125.71.24', null, null);
INSERT INTO `user_login` VALUES ('354', '0', '0', '1452271687', '121.42.0.19', null, null);
INSERT INTO `user_login` VALUES ('360', '0', '0', '1452335568', '121.42.0.15', null, null);
INSERT INTO `user_login` VALUES ('362', '0', '0', '1452343826', '111.126.216.146', null, null);
INSERT INTO `user_login` VALUES ('363', '0', '0', '1452343828', '101.226.33.216', null, null);
INSERT INTO `user_login` VALUES ('364', '0', '0', '1452414905', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('365', '0', '0', '1452414907', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('369', '0', '0', '1452425591', '121.42.0.37', null, null);
INSERT INTO `user_login` VALUES ('370', '0', '0', '1452436420', '121.42.0.16', null, null);
INSERT INTO `user_login` VALUES ('379', '0', '0', '1452488889', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('381', '0', '0', '1452495128', '101.90.126.77', null, null);
INSERT INTO `user_login` VALUES ('382', '0', '0', '1452495128', '101.226.65.106', null, null);
INSERT INTO `user_login` VALUES ('384', '0', '0', '1452530029', '101.85.249.160', null, null);
INSERT INTO `user_login` VALUES ('386', '0', '0', '1452530168', '119.147.146.193', null, null);
INSERT INTO `user_login` VALUES ('389', '0', '0', '1452538599', '180.153.206.21', null, null);
INSERT INTO `user_login` VALUES ('391', '0', '0', '1452540075', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('392', '0', '0', '1452540077', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('394', '0', '0', '1452573309', '121.42.0.17', null, null);
INSERT INTO `user_login` VALUES ('395', '0', '0', '1452585584', '121.56.10.23', null, null);
INSERT INTO `user_login` VALUES ('396', '0', '0', '1452605861', '121.42.0.18', null, null);
INSERT INTO `user_login` VALUES ('404', '0', '0', '1452663503', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('405', '0', '0', '1452663505', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('408', '0', '0', '1452718405', '119.147.146.194', null, null);
INSERT INTO `user_login` VALUES ('411', '0', '0', '1452743372', '218.30.137.139', null, null);
INSERT INTO `user_login` VALUES ('412', '131', '1', '1452743510', '218.30.137.139', null, null);
INSERT INTO `user_login` VALUES ('414', '152', '1', '1452756527', '121.56.10.23', null, null);
INSERT INTO `user_login` VALUES ('415', '0', '0', '1452756528', '101.226.65.104', null, null);
INSERT INTO `user_login` VALUES ('416', '0', '0', '1452756542', '180.153.214.198', null, null);
INSERT INTO `user_login` VALUES ('418', '0', '0', '1452768710', '220.181.108.87', null, null);
INSERT INTO `user_login` VALUES ('419', '0', '0', '1452788195', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('420', '0', '0', '1452788197', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('421', '0', '0', '1452823900', '121.42.0.36', null, null);
INSERT INTO `user_login` VALUES ('422', '0', '0', '1452824178', '121.42.0.36', null, null);
INSERT INTO `user_login` VALUES ('430', '0', '0', '1452911170', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('431', '0', '0', '1452911172', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('434', '0', '0', '1452924920', '207.46.13.78', null, null);
INSERT INTO `user_login` VALUES ('437', '0', '0', '1452929037', '121.42.0.36', null, null);
INSERT INTO `user_login` VALUES ('440', '0', '0', '1452930712', '121.42.0.16', null, null);
INSERT INTO `user_login` VALUES ('442', '0', '0', '1452932128', '116.238.167.5', null, null);
INSERT INTO `user_login` VALUES ('443', '153', '1', '1452932430', '116.238.167.5', null, null);
INSERT INTO `user_login` VALUES ('446', '0', '0', '1453027830', '123.125.71.112', null, null);
INSERT INTO `user_login` VALUES ('447', '0', '0', '1453037263', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('448', '0', '0', '1453037265', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('450', '0', '0', '1453038861', '121.42.0.19', null, null);
INSERT INTO `user_login` VALUES ('451', '0', '0', '1453090823', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('452', '123', '1', '1453090960', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('453', '0', '0', '1453091204', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('454', '0', '0', '1453093936', '101.226.66.191', null, null);
INSERT INTO `user_login` VALUES ('456', '0', '0', '1453133166', '121.42.0.38', null, null);
INSERT INTO `user_login` VALUES ('458', '0', '0', '1453172666', '71.100.48.61', null, null);
INSERT INTO `user_login` VALUES ('461', '0', '0', '1453194284', '218.30.137.139', null, null);
INSERT INTO `user_login` VALUES ('466', '0', '0', '1453215575', '116.224.230.187', null, null);
INSERT INTO `user_login` VALUES ('467', '0', '0', '1453215594', '116.224.230.187', null, null);
INSERT INTO `user_login` VALUES ('468', '0', '0', '1453261729', '123.125.71.38', null, null);
INSERT INTO `user_login` VALUES ('469', '0', '0', '1453273119', '218.7.106.2', null, null);
INSERT INTO `user_login` VALUES ('470', '0', '0', '1453273134', '220.181.132.217', null, null);
INSERT INTO `user_login` VALUES ('471', '0', '0', '1453273152', '101.199.112.52', null, null);
INSERT INTO `user_login` VALUES ('472', '0', '0', '1453273152', '220.181.132.217', null, null);
INSERT INTO `user_login` VALUES ('473', '0', '0', '1453273171', '101.199.112.45', null, null);
INSERT INTO `user_login` VALUES ('474', '0', '0', '1453273215', '220.181.132.217', null, null);
INSERT INTO `user_login` VALUES ('475', '0', '0', '1453273225', '101.199.108.52', null, null);
INSERT INTO `user_login` VALUES ('478', '0', '0', '1453290502', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('479', '0', '0', '1453290504', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('482', '0', '0', '1453346394', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('483', '123', '1', '1453346436', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('512', '0', '0', '1453558662', '61.135.190.221', null, null);
INSERT INTO `user_login` VALUES ('513', '0', '0', '1453559043', '61.135.190.223', null, null);
INSERT INTO `user_login` VALUES ('514', '0', '0', '1453559054', '61.135.190.103', null, null);
INSERT INTO `user_login` VALUES ('515', '0', '0', '1453559160', '61.135.190.221', null, null);
INSERT INTO `user_login` VALUES ('522', '0', '0', '1453637278', '123.125.71.77', null, null);
INSERT INTO `user_login` VALUES ('523', '0', '0', '1453644072', '121.42.0.37', null, null);
INSERT INTO `user_login` VALUES ('530', '0', '0', '1453697545', '101.90.124.244', null, null);
INSERT INTO `user_login` VALUES ('532', '0', '0', '1453699614', '101.90.124.244', null, null);
INSERT INTO `user_login` VALUES ('533', '0', '0', '1453699663', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('534', '123', '1', '1453699697', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('535', '123', '1', '1453699951', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('536', '123', '1', '1453699980', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('537', '123', '1', '1453700062', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('538', '123', '1', '1453700117', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('539', '123', '1', '1453700126', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('540', '123', '1', '1453700138', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('542', '0', '0', '1453700271', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('543', '123', '1', '1453700285', '101.231.89.54', null, null);
INSERT INTO `user_login` VALUES ('553', '0', '0', '1453820417', '121.42.0.30', null, null);
INSERT INTO `user_login` VALUES ('554', '0', '0', '1453885642', '140.207.47.130', null, null);
INSERT INTO `user_login` VALUES ('555', '0', '0', '1453885646', '119.147.146.189', null, null);
INSERT INTO `user_login` VALUES ('556', '0', '0', '1453916718', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('557', '0', '0', '1453916720', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('560', '0', '0', '1453960252', '121.42.0.37', null, null);
INSERT INTO `user_login` VALUES ('562', '0', '0', '1453966540', '61.151.218.118', null, null);
INSERT INTO `user_login` VALUES ('566', '0', '0', '1453970727', '123.125.71.58', null, null);
INSERT INTO `user_login` VALUES ('572', '0', '0', '1454042375', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('573', '0', '0', '1454042377', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('576', '0', '0', '1454044732', '111.13.102.7', null, null);
INSERT INTO `user_login` VALUES ('584', '0', '0', '1454056244', '220.181.108.143', null, null);
INSERT INTO `user_login` VALUES ('587', '0', '0', '1454077305', '121.42.0.16', null, null);
INSERT INTO `user_login` VALUES ('588', '0', '0', '1454082514', '123.125.71.110', null, null);
INSERT INTO `user_login` VALUES ('597', '0', '0', '1454168590', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('598', '0', '0', '1454168592', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('605', '0', '0', '1454215363', '121.42.0.19', null, null);
INSERT INTO `user_login` VALUES ('610', '0', '0', '1454249541', '61.135.190.103', null, null);
INSERT INTO `user_login` VALUES ('611', '0', '0', '1454249959', '61.135.190.220', null, null);
INSERT INTO `user_login` VALUES ('620', '0', '0', '1454293592', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('621', '0', '0', '1454293593', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('625', '0', '0', '1454299103', '119.147.146.194', null, null);
INSERT INTO `user_login` VALUES ('629', '0', '0', '1454323637', '121.42.0.15', null, null);
INSERT INTO `user_login` VALUES ('630', '0', '0', '1454324410', '121.42.0.15', null, null);
INSERT INTO `user_login` VALUES ('632', '0', '0', '1454333518', '123.125.71.83', null, null);
INSERT INTO `user_login` VALUES ('633', '154', '1', '1454334282', '114.83.64.250', null, null);
INSERT INTO `user_login` VALUES ('647', '0', '0', '1454419434', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('648', '0', '0', '1454419436', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('649', '0', '0', '1454421211', '121.42.0.30', null, null);
INSERT INTO `user_login` VALUES ('650', '0', '0', '1454423650', '117.169.19.21', null, null);
INSERT INTO `user_login` VALUES ('652', '0', '0', '1454426158', '121.42.0.16', null, null);
INSERT INTO `user_login` VALUES ('656', '0', '0', '1454429925', '121.42.0.16', null, null);
INSERT INTO `user_login` VALUES ('668', '0', '0', '1454607503', '119.147.146.192', null, null);
INSERT INTO `user_login` VALUES ('672', '0', '0', '1454650390', '114.83.64.250', null, null);
INSERT INTO `user_login` VALUES ('681', '154', '1', '1454674821', '114.83.114.188', null, null);
INSERT INTO `user_login` VALUES ('682', '0', '0', '1454734670', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('683', '0', '0', '1454734672', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('685', '0', '0', '1454761351', '123.125.71.43', null, null);
INSERT INTO `user_login` VALUES ('686', '0', '0', '1454767638', '121.42.0.37', null, null);
INSERT INTO `user_login` VALUES ('695', '0', '0', '1455091783', '121.42.0.15', null, null);
INSERT INTO `user_login` VALUES ('696', '0', '0', '1455107182', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('697', '0', '0', '1455107183', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('699', '0', '0', '1455189454', '61.135.190.220', null, null);
INSERT INTO `user_login` VALUES ('700', '0', '0', '1455189836', '61.135.190.223', null, null);
INSERT INTO `user_login` VALUES ('710', '0', '0', '1455292853', '220.181.108.140', null, null);
INSERT INTO `user_login` VALUES ('712', '0', '0', '1455341224', '123.125.71.46', null, null);
INSERT INTO `user_login` VALUES ('717', '0', '0', '1455355467', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('718', '0', '0', '1455355469', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('719', '0', '0', '1455372514', '121.42.0.36', null, null);
INSERT INTO `user_login` VALUES ('729', '0', '0', '1455503828', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('733', '0', '0', '1455517939', '71.100.48.61', null, null);
INSERT INTO `user_login` VALUES ('740', '0', '0', '1455535428', '121.42.0.31', null, null);
INSERT INTO `user_login` VALUES ('741', '0', '0', '1455548970', '119.147.146.193', null, null);
INSERT INTO `user_login` VALUES ('743', '0', '0', '1455590006', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('744', '123', '1', '1455590029', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('745', '123', '1', '1455590099', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('746', '0', '0', '1455594869', '123.125.71.60', null, null);
INSERT INTO `user_login` VALUES ('750', '0', '0', '1455602666', '220.181.108.104', null, null);
INSERT INTO `user_login` VALUES ('751', '0', '0', '1455603667', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('752', '0', '0', '1455603669', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('753', '0', '0', '1455606930', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('754', '122', '1', '1455606953', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('755', '0', '0', '1455607040', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('756', '0', '0', '1455607509', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('757', '122', '1', '1455607521', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('758', '122', '1', '1455607562', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('759', '122', '1', '1455607613', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('760', '0', '0', '1455607620', '101.85.49.88', null, null);
INSERT INTO `user_login` VALUES ('761', '0', '0', '1455681678', '180.173.157.108', null, null);
INSERT INTO `user_login` VALUES ('762', '0', '0', '1455703334', '119.147.146.195', null, null);
INSERT INTO `user_login` VALUES ('763', '0', '0', '1455727135', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('764', '0', '0', '1455727137', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('767', '0', '0', '1455856353', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('768', '123', '1', '1455856381', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('769', '0', '0', '1455856466', '58.247.64.146', null, null);
INSERT INTO `user_login` VALUES ('770', '0', '0', '1455856621', '112.17.243.135', null, null);
INSERT INTO `user_login` VALUES ('773', '0', '0', '1455940570', '123.125.71.12', null, null);
INSERT INTO `user_login` VALUES ('775', '0', '0', '1455964107', '123.125.71.51', null, null);
INSERT INTO `user_login` VALUES ('776', '0', '0', '1455976641', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('777', '0', '0', '1455976642', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('781', '0', '0', '1456030815', '123.125.71.18', null, null);
INSERT INTO `user_login` VALUES ('782', '0', '0', '1456039428', '112.65.188.93', null, null);
INSERT INTO `user_login` VALUES ('783', '0', '0', '1456039797', '112.65.188.93', null, null);
INSERT INTO `user_login` VALUES ('784', '122', '1', '1456040198', '112.65.188.93', null, null);
INSERT INTO `user_login` VALUES ('785', '0', '0', '1456040479', '223.104.5.205', null, null);
INSERT INTO `user_login` VALUES ('790', '0', '0', '1456117730', '123.125.71.92', null, null);
INSERT INTO `user_login` VALUES ('793', '0', '0', '1456190924', '101.226.65.106', null, null);
INSERT INTO `user_login` VALUES ('794', '0', '0', '1456190924', '1.180.1.1', null, null);
INSERT INTO `user_login` VALUES ('795', '0', '0', '1456190924', '101.226.33.216', null, null);
INSERT INTO `user_login` VALUES ('796', '0', '0', '1456191194', '119.147.146.189', null, null);
INSERT INTO `user_login` VALUES ('797', '0', '0', '1456204260', '220.181.108.102', null, null);
INSERT INTO `user_login` VALUES ('798', '0', '0', '1456220049', '220.181.108.151', null, null);
INSERT INTO `user_login` VALUES ('800', '0', '0', '1456225565', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('801', '0', '0', '1456225567', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('803', '0', '0', '1456293231', '123.125.71.26', null, null);
INSERT INTO `user_login` VALUES ('807', '0', '0', '1456460208', '123.125.71.107', null, null);
INSERT INTO `user_login` VALUES ('810', '0', '0', '1456475864', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('811', '0', '0', '1456475866', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('812', '0', '0', '1456482532', '123.125.71.108', null, null);
INSERT INTO `user_login` VALUES ('813', '0', '0', '1456548195', '123.125.71.91', null, null);
INSERT INTO `user_login` VALUES ('816', '0', '0', '1456565447', '61.135.190.102', null, null);
INSERT INTO `user_login` VALUES ('817', '0', '0', '1456565902', '61.135.190.103', null, null);
INSERT INTO `user_login` VALUES ('818', '0', '0', '1456639678', '220.181.108.179', null, null);
INSERT INTO `user_login` VALUES ('827', '0', '0', '1456711318', '140.207.23.180', null, null);
INSERT INTO `user_login` VALUES ('828', '122', '1', '1456711339', '140.207.23.180', null, null);
INSERT INTO `user_login` VALUES ('829', '0', '0', '1456722349', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('830', '0', '0', '1456722351', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('831', '0', '0', '1456726292', '123.125.71.84', null, null);
INSERT INTO `user_login` VALUES ('834', '0', '0', '1456764449', '101.226.93.233', null, null);
INSERT INTO `user_login` VALUES ('844', '0', '0', '1456842669', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('845', '0', '0', '1456842671', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('858', '0', '0', '1456910861', '106.40.178.23', null, null);
INSERT INTO `user_login` VALUES ('874', '0', '0', '1456964948', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('875', '0', '0', '1456964950', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('890', '0', '0', '1456997747', '101.89.34.100', null, null);
INSERT INTO `user_login` VALUES ('891', '0', '0', '1457001384', '180.153.206.25', null, null);
INSERT INTO `user_login` VALUES ('892', '0', '0', '1457001473', '58.247.35.94', null, null);
INSERT INTO `user_login` VALUES ('893', '0', '0', '1457001834', '220.181.132.217', null, null);
INSERT INTO `user_login` VALUES ('894', '0', '0', '1457001855', '101.199.108.118', null, null);
INSERT INTO `user_login` VALUES ('895', '0', '0', '1457001969', '119.188.16.37', null, null);
INSERT INTO `user_login` VALUES ('896', '0', '0', '1457002633', '220.181.132.217', null, null);
INSERT INTO `user_login` VALUES ('897', '0', '0', '1457002647', '101.199.108.51', null, null);
INSERT INTO `user_login` VALUES ('898', '0', '0', '1457004292', '101.81.216.152', null, null);
INSERT INTO `user_login` VALUES ('899', '122', '1', '1457004433', '101.81.216.152', null, null);
INSERT INTO `user_login` VALUES ('900', '122', '1', '1457004640', '101.81.216.152', null, null);
INSERT INTO `user_login` VALUES ('901', '0', '0', '1457005593', '121.42.0.16', null, null);
INSERT INTO `user_login` VALUES ('914', '0', '0', '1457088554', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('915', '0', '0', '1457088556', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('919', '0', '0', '1457199019', '61.135.190.220', null, null);
INSERT INTO `user_login` VALUES ('922', '0', '0', '1457255107', '111.126.194.249', null, null);
INSERT INTO `user_login` VALUES ('923', '0', '0', '1457255107', '101.226.65.104', null, null);
INSERT INTO `user_login` VALUES ('924', '0', '0', '1457255108', '180.153.206.38', null, null);
INSERT INTO `user_login` VALUES ('925', '0', '0', '1457263971', '218.81.131.134', null, null);
INSERT INTO `user_login` VALUES ('926', '0', '0', '1457264180', '220.181.108.182', null, null);
INSERT INTO `user_login` VALUES ('937', '0', '0', '1457337871', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('938', '0', '0', '1457337873', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('939', '0', '0', '1457338132', '101.90.126.150', null, null);
INSERT INTO `user_login` VALUES ('940', '0', '0', '1457422982', '123.125.71.114', null, null);
INSERT INTO `user_login` VALUES ('942', '0', '0', '1457443864', '36.102.150.243', null, null);
INSERT INTO `user_login` VALUES ('943', '0', '0', '1457443865', '101.226.66.179', null, null);
INSERT INTO `user_login` VALUES ('944', '0', '0', '1457443865', '101.226.89.121', null, null);
INSERT INTO `user_login` VALUES ('951', '0', '0', '1457462549', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('952', '0', '0', '1457462551', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('961', '0', '0', '1457516773', '180.153.4.19', null, null);
INSERT INTO `user_login` VALUES ('974', '0', '0', '1457585062', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('975', '0', '0', '1457585064', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('986', '0', '0', '1457685342', '106.125.129.24', null, null);
INSERT INTO `user_login` VALUES ('987', '0', '0', '1457685342', '180.153.206.21', null, null);
INSERT INTO `user_login` VALUES ('988', '0', '0', '1457685342', '180.153.206.16', null, null);
INSERT INTO `user_login` VALUES ('990', '0', '0', '1457708236', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('991', '0', '0', '1457708238', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('995', '0', '0', '1457754525', '220.181.108.103', null, null);
INSERT INTO `user_login` VALUES ('999', '0', '0', '1457795564', '139.196.198.206', null, null);
INSERT INTO `user_login` VALUES ('1021', '0', '0', '1457955271', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1022', '0', '0', '1457955273', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1031', '0', '0', '1458013801', '123.125.71.32', null, null);
INSERT INTO `user_login` VALUES ('1036', '0', '0', '1458059861', '61.135.190.104', null, null);
INSERT INTO `user_login` VALUES ('1037', '0', '0', '1458060255', '61.135.190.105', null, null);
INSERT INTO `user_login` VALUES ('1040', '0', '0', '1458102022', '220.181.108.99', null, null);
INSERT INTO `user_login` VALUES ('1046', '0', '0', '1458144720', '27.188.47.117', null, null);
INSERT INTO `user_login` VALUES ('1048', '0', '0', '1458185401', '121.42.0.39', null, null);
INSERT INTO `user_login` VALUES ('1054', '0', '0', '1458203135', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1055', '0', '0', '1458203137', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1057', '0', '0', '1458203417', '101.90.126.168', null, null);
INSERT INTO `user_login` VALUES ('1072', '0', '0', '1458280221', '119.147.146.189', null, null);
INSERT INTO `user_login` VALUES ('1081', '0', '0', '1458365615', '223.104.5.234', null, null);
INSERT INTO `user_login` VALUES ('1082', '0', '0', '1458365753', '116.231.225.16', null, null);
INSERT INTO `user_login` VALUES ('1084', '0', '0', '1458375118', '140.206.255.241', null, null);
INSERT INTO `user_login` VALUES ('1088', '0', '0', '1458454220', '223.104.31.55', null, null);
INSERT INTO `user_login` VALUES ('1108', '0', '0', '1458531649', '180.153.206.19', null, null);
INSERT INTO `user_login` VALUES ('1109', '0', '0', '1458531650', '183.60.35.29', null, null);
INSERT INTO `user_login` VALUES ('1110', '0', '0', '1458531657', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1114', '0', '0', '1458537028', '101.81.143.27', null, null);
INSERT INTO `user_login` VALUES ('1115', '0', '0', '1458537028', '101.226.33.202', null, null);
INSERT INTO `user_login` VALUES ('1116', '0', '0', '1458537028', '180.153.201.217', null, null);
INSERT INTO `user_login` VALUES ('1121', '0', '0', '1458538515', '180.175.209.95', null, null);
INSERT INTO `user_login` VALUES ('1125', '0', '0', '1458553118', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1126', '0', '0', '1458553120', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1142', '0', '0', '1458625344', '101.226.64.174', null, null);
INSERT INTO `user_login` VALUES ('1143', '0', '0', '1458626375', '61.129.106.230', null, null);
INSERT INTO `user_login` VALUES ('1146', '0', '0', '1458651664', '220.181.108.158', null, null);
INSERT INTO `user_login` VALUES ('1150', '0', '0', '1458713538', '140.207.22.30', null, null);
INSERT INTO `user_login` VALUES ('1151', '0', '0', '1458720479', '116.216.30.10', null, null);
INSERT INTO `user_login` VALUES ('1152', '0', '0', '1458720711', '116.216.30.10', null, null);
INSERT INTO `user_login` VALUES ('1153', '122', '1', '1458723094', '116.216.30.10', null, null);
INSERT INTO `user_login` VALUES ('1165', '0', '0', '1458807970', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1166', '0', '0', '1458807972', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1168', '0', '0', '1458816636', '123.125.71.42', null, null);
INSERT INTO `user_login` VALUES ('1173', '0', '0', '1458959901', '106.39.60.184', null, null);
INSERT INTO `user_login` VALUES ('1174', '0', '0', '1458983834', '180.175.93.177', null, null);
INSERT INTO `user_login` VALUES ('1175', '0', '0', '1458993682', '27.188.75.222', null, null);
INSERT INTO `user_login` VALUES ('1176', '0', '0', '1458999840', '123.125.71.50', null, null);
INSERT INTO `user_login` VALUES ('1178', '0', '0', '1459058674', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1179', '0', '0', '1459058676', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1185', '123', '1', '1459151623', '116.226.106.22', null, null);
INSERT INTO `user_login` VALUES ('1187', '0', '0', '1459152730', '220.181.132.217', null, null);
INSERT INTO `user_login` VALUES ('1188', '0', '0', '1459152748', '220.181.132.194', null, null);
INSERT INTO `user_login` VALUES ('1190', '0', '0', '1459155288', '223.104.5.238', null, null);
INSERT INTO `user_login` VALUES ('1210', '0', '0', '1459247609', '112.90.78.22', null, null);
INSERT INTO `user_login` VALUES ('1211', '0', '0', '1459247616', '112.64.235.87', null, null);
INSERT INTO `user_login` VALUES ('1212', '0', '0', '1459247620', '223.104.5.198', null, null);
INSERT INTO `user_login` VALUES ('1213', '0', '0', '1459247855', '101.90.252.66', null, null);
INSERT INTO `user_login` VALUES ('1216', '0', '0', '1459272684', '94.102.49.164', null, null);
INSERT INTO `user_login` VALUES ('1219', '0', '0', '1459273457', '94.102.49.164', null, null);
INSERT INTO `user_login` VALUES ('1227', '0', '0', '1459311171', '42.62.58.250', null, null);
INSERT INTO `user_login` VALUES ('1228', '0', '0', '1459313577', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1229', '0', '0', '1459313579', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1236', '0', '0', '1459336139', '114.90.13.34', null, null);
INSERT INTO `user_login` VALUES ('1239', '121', '1', '1459336481', '114.90.13.34', null, null);
INSERT INTO `user_login` VALUES ('1240', '0', '0', '1459356799', '121.42.0.14', null, null);
INSERT INTO `user_login` VALUES ('1243', '0', '0', '1459401919', '42.62.58.250', null, null);
INSERT INTO `user_login` VALUES ('1248', '0', '0', '1459410483', '101.90.254.252', null, null);
INSERT INTO `user_login` VALUES ('1261', '0', '0', '1459444207', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1262', '0', '0', '1459444209', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1274', '0', '0', '1459570152', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1275', '0', '0', '1459570154', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1281', '0', '0', '1459696045', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1282', '0', '0', '1459696047', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1285', '0', '0', '1459755449', '121.42.0.39', null, null);
INSERT INTO `user_login` VALUES ('1286', '0', '0', '1459764548', '116.227.159.9', null, null);
INSERT INTO `user_login` VALUES ('1288', '0', '0', '1459764612', '101.226.66.187', null, null);
INSERT INTO `user_login` VALUES ('1289', '0', '0', '1459764616', '14.17.34.189', null, null);
INSERT INTO `user_login` VALUES ('1290', '0', '0', '1459764644', '116.227.159.9', null, null);
INSERT INTO `user_login` VALUES ('1291', '132', '1', '1459764724', '116.227.159.9', null, null);
INSERT INTO `user_login` VALUES ('1295', '0', '0', '1459782051', '116.99.145.0', null, null);
INSERT INTO `user_login` VALUES ('1301', '0', '0', '1459822390', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1302', '0', '0', '1459822392', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1305', '0', '0', '1459834875', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1306', '132', '1', '1459834922', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1313', '0', '0', '1459860892', '121.42.0.39', null, null);
INSERT INTO `user_login` VALUES ('1322', '0', '0', '1460007236', '180.156.232.31', null, null);
INSERT INTO `user_login` VALUES ('1323', '0', '0', '1460007239', '101.226.66.191', null, null);
INSERT INTO `user_login` VALUES ('1324', '0', '0', '1460007239', '180.153.214.176', null, null);
INSERT INTO `user_login` VALUES ('1325', '0', '0', '1460023663', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1326', '0', '0', '1460023665', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1328', '0', '0', '1460031567', '171.224.200.32', null, null);
INSERT INTO `user_login` VALUES ('1332', '0', '0', '1460204522', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1333', '132', '1', '1460205903', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1335', '0', '0', '1460224297', '180.153.214.191', null, null);
INSERT INTO `user_login` VALUES ('1336', '0', '0', '1460224297', '101.226.51.229', null, null);
INSERT INTO `user_login` VALUES ('1345', '0', '0', '1460309737', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1346', '0', '0', '1460309739', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1348', '0', '0', '1460354139', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1349', '132', '1', '1460354169', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1350', '0', '0', '1460354610', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('1352', '0', '0', '1460386781', '106.39.60.184', null, null);
INSERT INTO `user_login` VALUES ('1354', '0', '0', '1460438004', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1355', '0', '0', '1460438006', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1360', '0', '0', '1460459313', '42.62.58.250', null, null);
INSERT INTO `user_login` VALUES ('1361', '0', '0', '1460465528', '116.227.28.253', null, null);
INSERT INTO `user_login` VALUES ('1363', '132', '1', '1460465728', '116.227.28.253', null, null);
INSERT INTO `user_login` VALUES ('1368', '0', '0', '1460527682', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1369', '0', '0', '1460527803', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1370', '0', '0', '1460527856', '220.181.132.198', null, null);
INSERT INTO `user_login` VALUES ('1371', '0', '0', '1460527966', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1372', '0', '0', '1460527999', '101.199.108.54', null, null);
INSERT INTO `user_login` VALUES ('1373', '123', '1', '1460528313', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1374', '0', '0', '1460528415', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1379', '0', '0', '1460534158', '101.226.33.217', null, null);
INSERT INTO `user_login` VALUES ('1380', '0', '0', '1460534161', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1381', '0', '0', '1460551485', '14.183.33.194', null, null);
INSERT INTO `user_login` VALUES ('1388', '0', '0', '1460604666', '180.153.214.200', null, null);
INSERT INTO `user_login` VALUES ('1389', '0', '0', '1460604667', '112.90.82.195', null, null);
INSERT INTO `user_login` VALUES ('1390', '0', '0', '1460604669', '14.17.34.191', null, null);
INSERT INTO `user_login` VALUES ('1391', '0', '0', '1460604688', '61.129.106.230', null, null);
INSERT INTO `user_login` VALUES ('1392', '0', '0', '1460620653', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1393', '123', '1', '1460620666', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1394', '0', '0', '1460620729', '106.120.160.109', null, null);
INSERT INTO `user_login` VALUES ('1395', '0', '0', '1460620747', '106.120.160.109', null, null);
INSERT INTO `user_login` VALUES ('1396', '0', '0', '1460620776', '106.120.160.109', null, null);
INSERT INTO `user_login` VALUES ('1397', '0', '0', '1460620777', '101.199.108.50', null, null);
INSERT INTO `user_login` VALUES ('1398', '0', '0', '1460620801', 'unknown', null, null);
INSERT INTO `user_login` VALUES ('1399', '0', '0', '1460620822', '101.199.108.51', null, null);
INSERT INTO `user_login` VALUES ('1400', '0', '0', '1460620841', '106.120.160.109', null, null);
INSERT INTO `user_login` VALUES ('1401', '0', '0', '1460620930', '220.181.132.195', null, null);
INSERT INTO `user_login` VALUES ('1413', '0', '0', '1460688931', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1414', '0', '0', '1460688933', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1417', '0', '0', '1460735674', '121.42.0.15', null, null);
INSERT INTO `user_login` VALUES ('1418', '0', '0', '1460736179', '121.42.0.16', null, null);
INSERT INTO `user_login` VALUES ('1421', '0', '0', '1460815456', '180.162.1.139', null, null);
INSERT INTO `user_login` VALUES ('1422', '0', '0', '1460815669', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1423', '0', '0', '1460815671', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1451', '0', '0', '1460993639', '121.42.0.15', null, null);
INSERT INTO `user_login` VALUES ('1459', '0', '0', '1461041198', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1460', '0', '0', '1461041200', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1495', '0', '0', '1461144487', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1497', '0', '0', '1461162181', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1498', '0', '0', '1461162182', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1499', '132', '1', '1461163113', '58.33.252.130', null, null);
INSERT INTO `user_login` VALUES ('1515', '0', '0', '1461294257', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1516', '0', '0', '1461294836', '116.228.85.178', null, null);
INSERT INTO `user_login` VALUES ('1517', '0', '0', '1461295061', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1518', '0', '0', '1461295150', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1519', '0', '0', '1461295158', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1520', '0', '0', '1461295172', '220.181.132.196', null, null);
INSERT INTO `user_login` VALUES ('1521', '0', '0', '1461295232', 'unknown', null, null);
INSERT INTO `user_login` VALUES ('1522', '0', '0', '1461295294', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1523', '0', '0', '1461295323', '101.199.108.120', null, null);
INSERT INTO `user_login` VALUES ('1525', '0', '0', '1461303588', '223.62.202.121', null, null);
INSERT INTO `user_login` VALUES ('1539', '0', '0', '1461311481', '211.138.116.22', null, null);
INSERT INTO `user_login` VALUES ('1540', '0', '0', '1461311518', '1.180.0.220', null, null);
INSERT INTO `user_login` VALUES ('1541', '180', '1', '1461311633', '1.180.0.220', null, null);
INSERT INTO `user_login` VALUES ('1544', '0', '0', '1461312362', '117.136.7.20', null, null);
INSERT INTO `user_login` VALUES ('1545', '0', '0', '1461316295', '140.207.21.229', null, null);
INSERT INTO `user_login` VALUES ('1546', '0', '0', '1461317655', '61.148.243.223', null, null);
INSERT INTO `user_login` VALUES ('1547', '0', '0', '1461322010', '112.17.235.177', null, null);
INSERT INTO `user_login` VALUES ('1548', '0', '0', '1461330615', '112.64.189.197', null, null);
INSERT INTO `user_login` VALUES ('1549', '0', '0', '1461331567', '114.83.114.188', null, null);
INSERT INTO `user_login` VALUES ('1550', '0', '0', '1461338720', '116.216.0.26', null, null);
INSERT INTO `user_login` VALUES ('1553', '0', '0', '1461406085', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1554', '0', '0', '1461406086', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1556', '0', '0', '1461408150', '117.136.7.24', null, null);
INSERT INTO `user_login` VALUES ('1558', '0', '0', '1461420517', '58.33.250.135', null, null);
INSERT INTO `user_login` VALUES ('1559', '132', '1', '1461423423', '58.33.250.135', null, null);
INSERT INTO `user_login` VALUES ('1563', '122', '1', '1461556623', '101.90.255.7', null, null);
INSERT INTO `user_login` VALUES ('1564', '0', '0', '1461576962', '42.62.58.250', null, null);
INSERT INTO `user_login` VALUES ('1566', '0', '0', '1461649749', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1567', '0', '0', '1461649751', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1568', '0', '0', '1461678145', '121.42.0.89', null, null);
INSERT INTO `user_login` VALUES ('1569', '0', '0', '1461679290', '121.42.0.18', null, null);
INSERT INTO `user_login` VALUES ('1572', '0', '0', '1462428523', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1573', '0', '0', '1462428630', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1574', '0', '0', '1462428656', '220.181.132.196', null, null);
INSERT INTO `user_login` VALUES ('1575', '0', '0', '1462428766', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1576', '0', '0', '1462428787', '101.199.108.56', null, null);
INSERT INTO `user_login` VALUES ('1578', '0', '0', '1462497755', '116.231.156.122', null, null);
INSERT INTO `user_login` VALUES ('1579', '0', '0', '1462497850', '106.120.160.119', null, null);
INSERT INTO `user_login` VALUES ('1580', '0', '0', '1462497873', '101.199.108.58', null, null);
INSERT INTO `user_login` VALUES ('1582', '0', '0', '1462501043', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1583', '0', '0', '1462501045', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1585', '0', '0', '1462518917', '121.42.0.30', null, null);
INSERT INTO `user_login` VALUES ('1586', '0', '0', '1462521814', '121.42.0.18', null, null);
INSERT INTO `user_login` VALUES ('1587', '0', '0', '1462540987', '42.62.58.250', null, null);
INSERT INTO `user_login` VALUES ('1589', '0', '0', '1462620045', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1590', '0', '0', '1462620047', '123.56.64.43', null, null);
INSERT INTO `user_login` VALUES ('1593', '0', '0', '1462638571', '218.82.148.179', null, null);
INSERT INTO `user_login` VALUES ('1596', '0', '0', '1462719528', '180.170.185.204', null, null);
INSERT INTO `user_login` VALUES ('1597', '0', '0', '1462719551', '180.170.185.204', null, null);
INSERT INTO `user_login` VALUES ('1598', '132', '1', '1462719656', '180.170.185.204', null, null);
INSERT INTO `user_login` VALUES ('1614', '0', '0', '1462783994', '::1', null, null);
INSERT INTO `user_login` VALUES ('1615', '122', '1', '1462784603', '::1', null, null);
INSERT INTO `user_login` VALUES ('1616', '0', '0', '1462787853', '::1', null, null);
INSERT INTO `user_login` VALUES ('1618', '0', '0', '1462790790', '::1', null, null);
INSERT INTO `user_login` VALUES ('1619', '0', '0', '1462795988', '::1', null, null);
INSERT INTO `user_login` VALUES ('1620', '0', '0', '1462852730', '::1', null, null);
INSERT INTO `user_login` VALUES ('1621', '0', '0', '1462868507', '::1', null, null);
INSERT INTO `user_login` VALUES ('1958', '123', '1', '1487919031', '116.231.231.243', null, null);
INSERT INTO `user_login` VALUES ('1959', '123', '1', '1487919031', '116.231.231.243', null, null);
INSERT INTO `user_login` VALUES ('1960', '123', '1', '1487919771', '116.231.231.243', null, null);
INSERT INTO `user_login` VALUES ('1961', '1011', '1', '1487927480', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1962', '100', '1', '1487927809', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1963', '333', '1', '1488168464', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1964', '123', '1', '1488178037', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1968', '100', '1', '1488276513', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1969', '123', '1', '1488336589', '116.231.26.85', null, null);
INSERT INTO `user_login` VALUES ('1970', '1011', '1', '1488349792', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1971', '1011', '1', '1488350925', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1972', '100', '1', '1488350936', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1973', '123', '1', '1488354618', '116.231.26.33', null, null);
INSERT INTO `user_login` VALUES ('1975', '123', '1', '1488356060', '116.231.26.33', null, null);
INSERT INTO `user_login` VALUES ('1984', '1011', '1', '1488511199', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1989', '123', '1', '1488617504', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1990', '123', '1', '1488618838', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1992', '123', '1', '1488618993', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('1997', '132', '1', '1488629447', '101.80.139.219', null, null);
INSERT INTO `user_login` VALUES ('2001', '121', '1', '1488646677', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2003', '121', '1', '1488646801', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2004', '122', '1', '1488646896', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2006', '122', '1', '1488647705', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2008', '122', '1', '1488648194', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2009', '121', '1', '1488648240', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2012', '121', '1', '1488648589', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2015', '121', '1', '1488649040', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2017', '121', '1', '1488649285', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2019', '1011', '1', '1488706214', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2020', '100', '1', '1488706434', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2021', '1011', '1', '1488706626', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2022', '11114', '1', '1488713714', '180.170.210.10', null, null);
INSERT INTO `user_login` VALUES ('2023', '11115', '1', '1488714236', '180.170.210.10', null, null);
INSERT INTO `user_login` VALUES ('2024', '100', '1', '1488731801', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2026', '11113', '1', '1488783349', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2027', '100', '1', '1488784350', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2028', '11113', '1', '1488784679', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2029', '100', '1', '1488784828', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2030', '11113', '1', '1488785812', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2031', '100', '1', '1488786452', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2032', '134', '1', '1488787415', '116.228.85.178', null, null);
INSERT INTO `user_login` VALUES ('2033', '126', '1', '1488788214', '218.7.106.2', null, null);
INSERT INTO `user_login` VALUES ('2035', '133', '1', '1488789385', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2036', '128', '1', '1488790328', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2037', '333', '1', '1488790626', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2038', '333', '1', '1488790778', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2039', '333', '1', '1488792015', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2040', '333', '1', '1488792778', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2041', '333', '1', '1488793168', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2042', '11113', '1', '1488793391', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2043', '100', '1', '1488793707', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2044', '1011', '1', '1488799344', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2045', '100', '1', '1488799962', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2048', '11113', '1', '1488808504', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2049', '333', '1', '1488816833', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2050', '11113', '1', '1488822213', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2052', '1011', '1', '1488941762', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2053', '11115', '1', '1488957206', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('2054', '11115', '1', '1488957511', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('2055', '11114', '1', '1488957525', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('2056', '11116', '1', '1488957727', '211.136.124.98', null, null);
INSERT INTO `user_login` VALUES ('2057', '100', '1', '1488962241', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2059', '122', '1', '1488991655', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2061', '1011', '1', '1489121303', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2062', '100', '1', '1489121478', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2072', '100', '1', '1489346728', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2073', '11114', '1', '1489405595', '116.227.152.155', null, null);
INSERT INTO `user_login` VALUES ('2074', '11115', '1', '1489405776', '116.227.152.155', null, null);
INSERT INTO `user_login` VALUES ('2076', '121', '1', '1489416520', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2077', '121', '1', '1489434839', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2081', '11117', '1', '1489583390', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2083', '122', '1', '1489645886', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2085', '122', '1', '1489650472', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2086', '122', '1', '1489673344', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2089', '121', '1', '1489689979', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2091', '100', '1', '1489690460', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2093', '121', '1', '1489690920', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2095', '121', '1', '1489691173', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2097', '121', '1', '1489723483', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2098', '123', '1', '1489731804', '116.231.227.141', null, null);
INSERT INTO `user_login` VALUES ('2101', '121', '1', '1489741495', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2104', '122', '1', '1489764406', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2106', '122', '1', '1489779038', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2110', '122', '1', '1489880080', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2111', '122', '1', '1489932360', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2113', '122', '1', '1489946122', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2114', '122', '1', '1489947094', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2117', '122', '1', '1489986051', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2118', '1011', '1', '1489986239', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2119', '100', '1', '1489986576', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2120', '100', '1', '1489986791', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2122', '122', '1', '1489993897', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2124', '11113', '1', '1490085588', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2125', '100', '1', '1490085927', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2130', '122', '1', '1490237020', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2132', '126', '1', '1490356396', '218.10.39.124', null, null);
INSERT INTO `user_login` VALUES ('2134', '126', '1', '1490377491', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2136', '126', '1', '1490377768', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2139', '126', '1', '1490475093', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2141', '122', '1', '1490476872', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2144', '122', '1', '1490477656', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2145', '122', '1', '1490483620', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2147', '100', '1', '1490528526', '180.156.209.60', null, null);
INSERT INTO `user_login` VALUES ('2148', '126', '1', '1490532872', '113.7.75.183', null, null);
INSERT INTO `user_login` VALUES ('2150', '122', '1', '1490586729', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2151', '122', '1', '1490590388', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2152', '1011', '1', '1490593422', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2153', '1011', '1', '1490594822', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2154', '100', '1', '1490601167', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2156', '122', '1', '1490605861', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2159', '1011', '1', '1490611179', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2160', '100', '1', '1490611393', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2162', '11117', '1', '1490681263', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2163', '11117', '1', '1490687416', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2164', '100', '1', '1490687742', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2165', '100', '1', '1490688632', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2166', '11118', '1', '1490688998', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2167', '11117', '1', '1490690108', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2168', '11118', '1', '1490690332', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2169', '11116', '1', '1490690456', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2170', '11118', '1', '1490690968', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2171', '100', '1', '1490691022', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2172', '11116', '1', '1490691356', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2173', '1012', '1', '1490691519', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2174', '100', '1', '1490691736', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2175', '11116', '1', '1490691765', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2176', '1011', '1', '1490693412', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2177', '100', '1', '1490694265', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2178', '11117', '1', '1490694524', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2179', '1012', '1', '1490712260', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2180', '333', '1', '1490718200', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2181', '100', '1', '1490718479', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2182', '137', '1', '1490718930', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2183', '138', '1', '1490718987', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2184', '139', '1', '1490719029', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2185', '181', '1', '1490719120', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2192', '133', '1', '1490812132', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2193', '126', '1', '1490963601', '113.3.255.15', null, null);
INSERT INTO `user_login` VALUES ('2194', '11111', '1', '1490980260', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2195', '11111', '1', '1490984278', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2196', '1011', '1', '1490985545', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2197', '100', '1', '1490986014', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2198', '11111', '1', '1491055838', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2201', '11117', '1', '1491407526', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2202', '126', '1', '1491704318', '1.190.66.217', null, null);
INSERT INTO `user_login` VALUES ('2203', '11111', '1', '1491741097', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2204', '21', '1', '1491851043', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2206', '128', '1', '1491851459', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2208', '136', '1', '1491851545', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2209', '1011', '1', '1491852030', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2210', '1011', '1', '1491852150', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2211', '138', '1', '1491852414', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2212', '100', '1', '1491852450', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2213', '138', '1', '1491853217', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2214', '1011', '1', '1491853381', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2215', '100', '1', '1491853660', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2216', '1011', '1', '1491853759', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2217', '66', '1', '1491853965', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2218', '74', '1', '1491854138', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2219', '74', '1', '1491854185', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2220', '64', '1', '1491854228', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2221', '68', '1', '1491854256', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2222', '69', '1', '1491854305', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2223', '75', '1', '1491854324', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2224', '79', '1', '1491854333', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2225', '81', '1', '1491854383', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2226', '82', '1', '1491854450', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2227', '95', '1', '1491854485', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2228', '96', '1', '1491854545', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2229', '137', '1', '1491854608', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2230', '139', '1', '1491854649', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2231', '153', '1', '1491854660', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2232', '161', '1', '1491854733', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2233', '333', '1', '1491854939', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2234', '1012', '1', '1491855097', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2235', '333', '1', '1491855152', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2236', '11113', '1', '1491855209', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2237', '100', '1', '1491855265', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2238', '1011', '1', '1491855313', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2239', '122', '1', '1491855370', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2240', '11113', '1', '1491855441', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2241', '100', '1', '1491855474', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2242', '11113', '1', '1491855534', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2243', '333', '1', '1491855639', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2244', '122', '1', '1491856162', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2245', '98', '1', '1491883300', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2247', '11111', '1', '1491972647', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2250', '11111', '1', '1492108392', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2251', '11111', '1', '1492141826', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2252', '11111', '1', '1492150007', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2253', '11111', '1', '1492154172', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2254', '11111', '1', '1492192740', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2255', '11111', '1', '1492338118', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2256', '67', '1', '1492617560', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2257', '100', '1', '1492617609', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2258', '67', '1', '1492617647', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2259', '70', '1', '1492617754', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2260', '78', '1', '1492617837', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2261', '81', '1', '1492617861', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2262', '80', '1', '1492618188', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2263', '86', '1', '1492618221', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2264', '83', '1', '1492618234', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2265', '87', '1', '1492618270', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2266', '91', '1', '1492618277', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2267', '98', '1', '1492618309', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2268', '93', '1', '1492618364', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2269', '98', '1', '1492618381', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2270', '151', '1', '1492618408', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2271', '82', '1', '1492618436', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2272', '151', '1', '1492618506', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2274', '121', '1', '1492618890', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2275', '146', '1', '1492619270', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2276', '122', '1', '1492619289', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2277', '146', '1', '1492619488', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2278', '181', '1', '1492619545', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2279', '181', '1', '1492619749', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2280', '122', '1', '1492619786', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2281', '181', '1', '1492619804', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2282', '152', '1', '1492620056', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2283', '122', '1', '1492620205', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2284', '126', '1', '1492620452', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2286', '333', '1', '1492620513', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2287', '100', '1', '1492620544', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2288', '100', '1', '1492620877', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2289', '100', '1', '1492620954', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2290', '100', '1', '1492620995', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2291', '11114', '1', '1492621150', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2292', '11115', '1', '1492621185', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2293', '1011', '1', '1492621803', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2294', '333', '1', '1492621873', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2295', '1012', '1', '1492621898', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2296', '11117', '1', '1492621927', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2297', '123', '1', '1492622002', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2298', '1012', '1', '1492622016', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2299', '132', '1', '1492622768', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2300', '130', '1', '1492622800', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2301', '125', '1', '1492622850', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2302', '125', '1', '1492622850', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2303', '129', '1', '1492622863', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2304', '122', '1', '1492624474', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2305', '122', '1', '1492624691', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2309', '122', '1', '1492679677', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2313', '100', '1', '1492688497', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2317', '100', '1', '1492694412', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2324', '122', '1', '1492767695', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2326', '121', '1', '1492794428', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2328', '11111', '1', '1492803374', '180.156.199.22', null, null);
INSERT INTO `user_login` VALUES ('2343', '122', '1', '1493801353', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2345', '122', '1', '1493877302', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2348', '122', '1', '1493901256', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2349', '11111', '1', '1493907997', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2351', '122', '1', '1493926528', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2353', '122', '1', '1493926980', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2355', '122', '1', '1493930307', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2361', '132', '1', '1494252746', '140.207.47.130', null, null);
INSERT INTO `user_login` VALUES ('2364', '126', '1', '1494422398', '1.188.140.77', null, null);
INSERT INTO `user_login` VALUES ('2365', '11111', '1', '1494692215', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2366', '11111', '1', '1494806272', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2367', '11111', '1', '1494908177', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2368', '11113', '1', '1494920334', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2369', '11113', '1', '1494936620', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2370', '100', '1', '1494938012', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2371', '11113', '1', '1494938100', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2372', '100', '1', '1494938210', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2373', '11113', '1', '1494938618', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2374', '100', '1', '1494946431', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2375', '1011', '1', '1494951879', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2377', '11113', '1', '1495081175', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2378', '100', '1', '1495081293', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2379', '11111', '1', '1495083616', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2380', '11111', '1', '1495203669', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2381', '11111', '1', '1495376306', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2382', '11113', '1', '1495390430', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2383', '11113', '1', '1495390445', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2384', '100', '1', '1495397231', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2385', '1011', '1', '1495594553', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2386', '100', '1', '1495594805', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2387', '1011', '1', '1495594825', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2388', '100', '1', '1495594843', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2389', '100', '1', '1495594901', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2390', '11113', '1', '1495595024', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2391', '100', '1', '1495595182', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2392', '100', '1', '1495788889', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2393', '11113', '1', '1495788934', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2394', '11111', '1', '1496205016', '221.239.144.51', null, null);
INSERT INTO `user_login` VALUES ('2396', '126', '1', '1498139797', '218.9.35.102', null, null);
INSERT INTO `user_login` VALUES ('2403', '11111', '1', '1500474826', '221.239.147.239', null, null);
INSERT INTO `user_login` VALUES ('2404', '11111', '1', '1500550741', '221.239.147.239', null, null);
INSERT INTO `user_login` VALUES ('2405', '126', '1', '1500560989', '113.7.73.14', null, null);
INSERT INTO `user_login` VALUES ('2406', '122', '1', '1500644261', '221.239.147.239', null, null);
INSERT INTO `user_login` VALUES ('2407', '11113', '1', '1500795317', '58.39.47.134', null, null);
INSERT INTO `user_login` VALUES ('2408', '100', '1', '1500795339', '58.39.47.134', null, null);
INSERT INTO `user_login` VALUES ('2409', '11113', '1', '1500795441', '58.39.47.134', null, null);
INSERT INTO `user_login` VALUES ('2412', '126', '1', '1501386843', '113.5.220.148', null, null);
INSERT INTO `user_login` VALUES ('2442', '122', '1', '0', '116.238.69.200', '1501423452', '1501423452');
INSERT INTO `user_login` VALUES ('2448', '122', '1', '0', '116.238.69.200', '1501511843', '1501511843');
INSERT INTO `user_login` VALUES ('2457', '122', '1', '0', '58.39.62.162', '1502287229', '1502287229');
INSERT INTO `user_login` VALUES ('2458', '11111', '1', '0', '58.39.62.162', '1502287455', '1502287455');
INSERT INTO `user_login` VALUES ('2465', '122', '1', '0', '58.39.62.162', '1502472521', '1502472521');
INSERT INTO `user_login` VALUES ('2467', '121', '1', '0', '58.39.62.162', '1502480048', '1502480048');
INSERT INTO `user_login` VALUES ('2469', '121', '1', '0', '58.39.62.162', '1502480581', '1502480581');
INSERT INTO `user_login` VALUES ('2474', '120', '1', '0', '58.39.62.162', '1502623165', '1502623165');
INSERT INTO `user_login` VALUES ('2475', '120', '1', '0', '58.39.62.162', '1502802668', '1502802668');
INSERT INTO `user_login` VALUES ('2476', '120', '1', '0', '58.39.62.162', '1502804923', '1502804923');
INSERT INTO `user_login` VALUES ('2477', '120', '1', '0', '58.39.62.162', '1502804945', '1502804945');
INSERT INTO `user_login` VALUES ('2478', '11111', '1', '0', '58.39.62.162', '1502808075', '1502808075');
INSERT INTO `user_login` VALUES ('2479', '120', '1', '0', '58.39.62.162', '1502966335', '1502966335');
INSERT INTO `user_login` VALUES ('2480', '1011', '1', '0', '58.39.62.162', '1502969386', '1502969386');
INSERT INTO `user_login` VALUES ('2481', '120', '1', '0', '58.39.62.162', '1502974378', '1502974378');
INSERT INTO `user_login` VALUES ('2482', '1011', '1', '0', '58.39.62.162', '1502974451', '1502974451');
INSERT INTO `user_login` VALUES ('2483', '120', '1', '0', '116.224.232.18', '1503111319', '1503111319');
INSERT INTO `user_login` VALUES ('2484', '120', '1', '0', '116.224.232.18', '1503117550', '1503117550');
INSERT INTO `user_login` VALUES ('2485', '120', '1', '0', '116.224.232.18', '1503117970', '1503117970');
INSERT INTO `user_login` VALUES ('2486', '120', '1', '0', '116.224.232.18', '1503157749', '1503157749');
INSERT INTO `user_login` VALUES ('2487', '120', '1', '0', '116.224.232.18', '1503222072', '1503222072');
INSERT INTO `user_login` VALUES ('2488', '120', '1', '0', '116.224.232.18', '1503222111', '1503222111');
INSERT INTO `user_login` VALUES ('2489', '11130', '1', '0', '116.224.232.18', '1503246284', '1503246284');
INSERT INTO `user_login` VALUES ('2490', '120', '1', '0', '61.172.57.230', '1503315989', '1503315989');
INSERT INTO `user_login` VALUES ('2491', '1011', '1', '0', '116.224.232.18', '1503325586', '1503325586');
INSERT INTO `user_login` VALUES ('2492', '120', '1', '0', '116.224.232.18', '1503325677', '1503325677');
INSERT INTO `user_login` VALUES ('2493', '120', '1', '0', '116.224.232.18', '1503325706', '1503325706');
INSERT INTO `user_login` VALUES ('2494', '120', '1', '0', '116.224.232.18', '1503362841', '1503362841');
INSERT INTO `user_login` VALUES ('2495', '1011', '1', '0', '116.224.232.18', '1503379660', '1503379660');
INSERT INTO `user_login` VALUES ('2496', '120', '1', '0', '116.224.232.18', '1503447860', '1503447860');
INSERT INTO `user_login` VALUES ('2497', '120', '1', '0', '116.224.232.18', '1503498193', '1503498193');
INSERT INTO `user_login` VALUES ('2498', '120', '1', '0', '116.224.232.18', '1503562305', '1503562305');
INSERT INTO `user_login` VALUES ('2499', '1011', '1', '0', '116.224.232.18', '1503673031', '1503673031');
INSERT INTO `user_login` VALUES ('2500', '120', '1', '0', '116.224.232.18', '1503813260', '1503813260');
INSERT INTO `user_login` VALUES ('2501', '11111', '1', '0', '116.224.232.18', '1503850590', '1503850590');
INSERT INTO `user_login` VALUES ('2502', '120', '1', '0', '61.172.57.230', '1503979227', '1503979227');
INSERT INTO `user_login` VALUES ('2503', '120', '1', '0', '116.224.232.18', '1504009264', '1504009264');
INSERT INTO `user_login` VALUES ('2504', '120', '1', '0', '116.224.232.18', '1504016871', '1504016871');
INSERT INTO `user_login` VALUES ('2505', '120', '1', '0', '116.224.232.18', '1504024128', '1504024128');
INSERT INTO `user_login` VALUES ('2506', '122', '1', '0', '116.224.232.18', '1504024159', '1504024159');
INSERT INTO `user_login` VALUES ('2507', '120', '1', '0', '116.224.232.18', '1504024246', '1504024246');
INSERT INTO `user_login` VALUES ('2508', '120', '1', '0', '116.224.232.18', '1504052026', '1504052026');
INSERT INTO `user_login` VALUES ('2509', '11111', '1', '0', '116.224.232.18', '1504102360', '1504102360');
INSERT INTO `user_login` VALUES ('2510', '120', '1', '0', '61.172.57.230', '1505107514', '1505107514');
INSERT INTO `user_login` VALUES ('2511', '126', '1', '0', '116.224.232.18', '1505395928', '1505395928');
INSERT INTO `user_login` VALUES ('2512', '126', '1', '0', '116.224.232.18', '1505396357', '1505396357');
INSERT INTO `user_login` VALUES ('2513', '126', '1', '0', '113.3.244.63', '1505397263', '1505397263');
INSERT INTO `user_login` VALUES ('2514', '120', '1', '0', '116.224.232.18', '1505482489', '1505482489');
INSERT INTO `user_login` VALUES ('2515', '1011', '1', '0', '180.156.223.140', '1509171124', '1509171124');
INSERT INTO `user_login` VALUES ('2516', '1011', '1', '0', '180.156.223.140', '1509771367', '1509771367');
INSERT INTO `user_login` VALUES ('2517', '120', '1', '0', '180.156.222.98', '1510947042', '1510947042');

-- ----------------------------
-- Table structure for user_person
-- ----------------------------
DROP TABLE IF EXISTS `user_person`;
CREATE TABLE `user_person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `realname` varchar(64) NOT NULL DEFAULT '',
  `gender` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `birth` int(11) NOT NULL DEFAULT '0',
  `birthShared` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `hometown` int(11) NOT NULL DEFAULT '0',
  `homeShared` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `school` int(11) NOT NULL DEFAULT '0',
  `schoolDepartment` int(11) NOT NULL DEFAULT '0',
  `schoolMajor` int(11) NOT NULL DEFAULT '0',
  `schoolShared` tinyint(3) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_person
-- ----------------------------

-- ----------------------------
-- Table structure for user_verification
-- ----------------------------
DROP TABLE IF EXISTS `user_verification`;
CREATE TABLE `user_verification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `userId` int(10) unsigned NOT NULL DEFAULT '0',
  `verificationCode` varchar(64) NOT NULL DEFAULT '',
  `time` bigint(20) unsigned NOT NULL,
  `deadline` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sort` (`sort`),
  UNIQUE KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_verification
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for users_communication
-- ----------------------------
DROP TABLE IF EXISTS `users_communication`;
CREATE TABLE `users_communication` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `item_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `item_belong_id` int(10) unsigned NOT NULL DEFAULT '0',
  `item_version` int(10) unsigned DEFAULT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `object_id` int(10) unsigned DEFAULT NULL,
  `point_id` int(10) unsigned DEFAULT NULL,
  `dialog` int(10) unsigned DEFAULT NULL,
  `quote_item_id` int(10) unsigned DEFAULT NULL,
  `quote_belong_id` int(10) unsigned DEFAULT NULL,
  `content` varchar(2048) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tip` int(10) NOT NULL DEFAULT '0' COMMENT '赏打金额',
  `score` tinyint(3) NOT NULL DEFAULT '0' COMMENT '评分',
  `favor_num` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `dislike_num` int(11) NOT NULL DEFAULT '0' COMMENT '点踩数',
  `reply_num` int(11) NOT NULL DEFAULT '0' COMMENT '回复数',
  `isShared` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `permission` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=632 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_communication
-- ----------------------------
INSERT INTO `users_communication` VALUES ('478', '20', '1', '1155', '11111', null, '120', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1493784054', '1493784054');
INSERT INTO `users_communication` VALUES ('501', '49', '1', '1155', '11111', null, '120', null, null, null, null, null, '', '0', '5', '0', '0', '0', '99', '0', '1493825815', '1493825815');
INSERT INTO `users_communication` VALUES ('508', '49', '2', '1155', '11111', null, '120', null, null, null, null, null, '', '0', '4', '0', '0', '0', '99', '0', '1493826177', '1493826177');
INSERT INTO `users_communication` VALUES ('511', '50', '1', '1155', '11111', null, '120', null, null, null, null, null, '', '0', '0', '0', '0', '0', '99', '0', '1493834063', '1493834063');
INSERT INTO `users_communication` VALUES ('512', '49', '1', '1155', '11111', null, '122', null, null, null, null, null, '', '0', '4', '0', '0', '0', '99', '0', '1493877322', '1493877322');
INSERT INTO `users_communication` VALUES ('513', '50', '1', '1155', '11111', null, '122', null, null, null, null, null, '', '0', '0', '0', '0', '0', '99', '0', '1493877355', '1493877355');
INSERT INTO `users_communication` VALUES ('514', '21', '1', '1155', '11111', null, '120', null, null, null, null, null, '', '0', '0', '0', '0', '0', '21', '0', '1493918115', '1493918115');
INSERT INTO `users_communication` VALUES ('515', '21', '1', '1178', '120', null, '120', null, null, null, null, null, '', '0', '0', '0', '0', '0', '21', '0', '1493922777', '1493922777');
INSERT INTO `users_communication` VALUES ('516', '21', '2', '1155', '11111', null, '120', null, null, null, null, null, '', '0', '0', '0', '0', '0', '21', '0', '1493928325', '1493928325');
INSERT INTO `users_communication` VALUES ('517', '22', '1', '1202', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1494938026', '1494938026');
INSERT INTO `users_communication` VALUES ('518', '22', '1', '1201', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1494938030', '1494938030');
INSERT INTO `users_communication` VALUES ('519', '22', '1', '1203', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1494938219', '1494938219');
INSERT INTO `users_communication` VALUES ('520', '22', '1', '1205', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1494946441', '1494946441');
INSERT INTO `users_communication` VALUES ('521', '22', '1', '1206', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1494946445', '1494946445');
INSERT INTO `users_communication` VALUES ('522', '22', '1', '1207', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495081305', '1495081305');
INSERT INTO `users_communication` VALUES ('523', '22', '1', '1208', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495081309', '1495081309');
INSERT INTO `users_communication` VALUES ('524', '22', '1', '1214', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495397239', '1495397239');
INSERT INTO `users_communication` VALUES ('525', '22', '1', '1215', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495397244', '1495397244');
INSERT INTO `users_communication` VALUES ('526', '22', '1', '1216', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495397248', '1495397248');
INSERT INTO `users_communication` VALUES ('527', '22', '1', '1217', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495397252', '1495397252');
INSERT INTO `users_communication` VALUES ('528', '22', '1', '1218', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495397256', '1495397256');
INSERT INTO `users_communication` VALUES ('529', '22', '1', '1220', '1011', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495594818', '1495594818');
INSERT INTO `users_communication` VALUES ('530', '22', '1', '1219', '1011', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495594852', '1495594852');
INSERT INTO `users_communication` VALUES ('531', '22', '2', '1215', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495595001', '1495595001');
INSERT INTO `users_communication` VALUES ('532', '22', '1', '1221', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495595192', '1495595192');
INSERT INTO `users_communication` VALUES ('533', '22', '2', '1217', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495788901', '1495788901');
INSERT INTO `users_communication` VALUES ('534', '22', '2', '1221', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1495788905', '1495788905');
INSERT INTO `users_communication` VALUES ('535', '1', '1', '1225', '126', null, '126', '0', null, '535', null, null, '图片加不了啊擦', '0', '0', '0', '0', '0', '100', '0', '1498140324', '1498140324');
INSERT INTO `users_communication` VALUES ('536', '22', '1', '1218', '11113', null, '120', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1499128130', '1499128130');
INSERT INTO `users_communication` VALUES ('537', '21', '1', '1218', '11113', null, '120', null, null, null, null, null, '', '0', '0', '0', '0', '0', '21', '0', '1499128212', '1499128212');
INSERT INTO `users_communication` VALUES ('538', '30', '1', '1230', '126', null, '122', null, null, null, null, null, '', '0', '0', '0', '0', '0', '99', '0', '1500644268', '1500644268');
INSERT INTO `users_communication` VALUES ('539', '22', '2', '1216', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795357', '1500795357');
INSERT INTO `users_communication` VALUES ('540', '22', '2', '1214', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795363', '1500795363');
INSERT INTO `users_communication` VALUES ('541', '22', '2', '1218', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795367', '1500795367');
INSERT INTO `users_communication` VALUES ('542', '22', '2', '1207', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795375', '1500795375');
INSERT INTO `users_communication` VALUES ('543', '22', '2', '1208', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795380', '1500795380');
INSERT INTO `users_communication` VALUES ('544', '22', '2', '1201', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795386', '1500795386');
INSERT INTO `users_communication` VALUES ('545', '22', '2', '1202', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795390', '1500795390');
INSERT INTO `users_communication` VALUES ('546', '22', '2', '1205', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795407', '1500795407');
INSERT INTO `users_communication` VALUES ('547', '22', '2', '1206', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795411', '1500795411');
INSERT INTO `users_communication` VALUES ('548', '22', '2', '1203', '11113', null, '100', null, null, null, null, null, '', '0', '0', '0', '0', '0', '100', '0', '1500795415', '1500795415');
INSERT INTO `users_communication` VALUES ('620', '1', '0', '1233', '0', null, '122', '0', null, '620', null, null, '1', '0', '0', '0', '0', '0', '100', '0', '1504023438', '1504023438');
INSERT INTO `users_communication` VALUES ('621', '1', '0', '1233', '0', null, '122', '0', null, '621', null, null, '2', '0', '0', '0', '0', '0', '100', '0', '1504023458', '1504023458');
INSERT INTO `users_communication` VALUES ('626', '1', '0', '1233', '0', null, '120', '0', null, '626', null, null, '1', '0', '0', '0', '0', '0', '100', '0', '1504024033', '1504024033');
INSERT INTO `users_communication` VALUES ('627', '2', '0', '1233', '0', null, '120', '122', '621', '621', null, null, '2-1', '0', '0', '0', '0', '0', '100', '0', '1504024088', '1504024088');
INSERT INTO `users_communication` VALUES ('628', '2', '0', '1233', '0', null, '120', '122', '620', '620', null, null, '1-1', '0', '0', '0', '0', '0', '0', '0', '1504024101', '1504024101');
INSERT INTO `users_communication` VALUES ('629', '2', '0', '1233', '0', null, '122', '120', '628', '620', null, null, '1-1-2', '0', '0', '0', '0', '0', '100', '0', '1504024186', '1504024186');
INSERT INTO `users_communication` VALUES ('630', '2', '0', '1233', '0', null, '122', '120', '627', '621', null, null, '2-1-2', '0', '0', '0', '0', '0', '100', '0', '1504024200', '1504024200');
INSERT INTO `users_communication` VALUES ('631', '1', '0', '1230', '0', null, '126', '0', null, '631', null, null, '赞全是我自己点的', '0', '0', '0', '0', '0', '100', '0', '1505397797', '1505397797');

-- ----------------------------
-- Table structure for users_item
-- ----------------------------
DROP TABLE IF EXISTS `users_item`;
CREATE TABLE `users_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1.news 19.pm 21.note 41.words 44.ask 48.goods',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `form` tinyint(4) NOT NULL DEFAULT '0',
  `revisable_is` tinyint(1) NOT NULL DEFAULT '0' COMMENT '修改 0.不能修改 1. 可修改',
  `time` int(11) NOT NULL,
  `modified` int(11) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL COMMENT '标记',
  `version` int(10) NOT NULL DEFAULT '1',
  `belongType` tinyint(4) NOT NULL DEFAULT '1',
  `belongId` int(11) NOT NULL,
  `sourceId` int(11) DEFAULT NULL,
  `objectId` int(11) DEFAULT NULL,
  `receiverIds` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `opposite_id` int(11) DEFAULT NULL,
  `origin_item_id` int(11) DEFAULT NULL COMMENT '引用 item_id',
  `origin_belong_id` int(11) DEFAULT NULL COMMENT '引用 belong_id',
  `quote_item_id` int(11) DEFAULT NULL COMMENT '转发 item_id',
  `quote_belong_id` int(11) DEFAULT NULL COMMENT '转发 belong_id',
  `quote_content` varchar(2048) CHARACTER SET utf8 DEFAULT NULL COMMENT '转发内容',
  `theme` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `attaching` text CHARACTER SET utf8,
  `attachment` text CHARACTER SET utf8,
  `tag` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `tip` int(11) unsigned NOT NULL DEFAULT '0',
  `time_type` tinyint(4) NOT NULL DEFAULT '0',
  `start_type` tinyint(4) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_type` tinyint(4) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `isWorked` tinyint(1) DEFAULT NULL,
  `importance` tinyint(1) DEFAULT NULL,
  `read_is` tinyint(1) NOT NULL DEFAULT '0',
  `read_time` bigint(20) unsigned DEFAULT NULL,
  `complete_is` tinyint(1) NOT NULL DEFAULT '0',
  `complete_time` int(11) unsigned DEFAULT NULL,
  `finish_is` tinyint(1) NOT NULL DEFAULT '0',
  `finish_time` bigint(20) unsigned DEFAULT NULL,
  `comment_num` int(11) NOT NULL DEFAULT '0',
  `comment_best_id` int(11) NOT NULL DEFAULT '0' COMMENT '最佳评论',
  `forward_num` int(11) NOT NULL DEFAULT '0' COMMENT '转发数量',
  `work_num` int(11) NOT NULL DEFAULT '0' COMMENT '加添为待办数量',
  `agenda_num` int(11) NOT NULL DEFAULT '0' COMMENT '加添日程数量',
  `favor_num` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `dislike_num` int(11) NOT NULL DEFAULT '0' COMMENT '点踩数量',
  `collect_num` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `focus_num` int(11) NOT NULL DEFAULT '0',
  `track_num` int(11) NOT NULL DEFAULT '0',
  `attention_num` int(11) NOT NULL DEFAULT '0',
  `score_num` int(11) NOT NULL DEFAULT '0' COMMENT '打分数量',
  `score_total` int(11) NOT NULL DEFAULT '0' COMMENT '总分',
  `score_AVG` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '平均分',
  `isShared` tinyint(4) NOT NULL DEFAULT '0',
  `permission` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(64) CHARACTER SET utf8 DEFAULT NULL COMMENT '密码',
  `created_at` int(11) DEFAULT '0',
  `updated_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `update` (`updated_at`),
  KEY `timeType` (`time_type`)
) ENGINE=InnoDB AUTO_INCREMENT=1303 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_item
-- ----------------------------
INSERT INTO `users_item` VALUES ('21', '21', '0', '0', '1', '1449204086', '1449204086', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '中国四大名著 必看！！', '中国古典长篇小说四大名著，简称四大名著，是指《三国演义》、《水浒传》、《西游记》、《红楼梦》这四部巨著。四大名著是汉语文学史中不可多得的经典作品，是中国乃至全人类共同拥有的宝贵文化遗产。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449204086', '1504023458');
INSERT INTO `users_item` VALUES ('22', '21', '0', '0', '1', '1449204121', '1449204121', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '资产和净资产的区别', '资产是指由企业过去经营交易或各项事项形成的，由企业拥有或控制的，预期会给企业带来经济利益的资源。\n资产指任何公司、机构和个人拥有的任何具有商业或交换价值的东西。资产的分类很多，如流动资产、固定资产、有形资产、无形资产、不动产等。\n  \n净资产（Net asset）是属企业所有，并可以自由支配的资产，即所有者权益。企业的净资产(net asset value)，是指企业的资产总额减去负债以后的净额，它由两大部分组成，一部分是企业开办当初投入的资本，包括溢价部分，另一部分是企业在经营之中创造的，也包括接受捐赠的资产,属于所有者权益。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204121', '1504023458');
INSERT INTO `users_item` VALUES ('23', '21', '0', '0', '1', '1449204164', '1449204164', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '科学的现代化财务管理方法 资本的融道 现金流量及利润分配', '明晰市场的发展\n会计核算资料\n社会诚信机制', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204164', '1504023458');
INSERT INTO `users_item` VALUES ('24', '21', '0', '0', '1', '1449204203', '1449204203', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '潜力股', '【马云双十一首度发声，阐释“中国速度“，称双11至少还有93年】\n马云：\n①强大的内需潜力是中国巨大的经济机会所在；\n②从来没想过双十一属于我们，双十一可能活得比阿里巴巴还要长，因为它是一个节日，阿里巴巴是一家公司；\n③中国企业学会为别人创造价值、财富，就业。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204203', '1504023458');
INSERT INTO `users_item` VALUES ('25', '21', '0', '0', '1', '1449204256', '1449204256', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '总分类账祥细的科目', '一、资产类\n　　1 1001 库存现金\n　　2 1002 银行存款\n　　3 1003 存放中央银行款项 银行专用\n　　4 1011 存放同业 银行专用\n　　5 1015 其他货币资金\n　　6 1021 结算备付金 证券专用\n　　7 1031 存出保证金 金融共用\n　　8 1051 拆出资金 金融共用\n　　9 1101 交易性金融资产\n　　10 1111 买入返售金融资产 金融共用\n　　11 1121 应收票据\n　　12 1122 应收账款\n　　13 1123 预付账款\n　　14 1131 应收股利\n　　15 1132 应收利息\n　　16 1211 应收保户储金 保险专用\n　　17 1221 应收代位追偿款 保险专用\n　　18 1222 应收分保账款 保险专用\n　　19 1223 应收分保未到期责任准备金 保险专用\n　　20 1224 应收分保保险责任准备金 保险专用\n　　21 1231 其他应收款\n　　22 1241 坏账准备\n　　23 1251 贴现资产 银行专用\n　　24 1301 贷款 银行和保险共用\n　　25 1302 贷款损失准备 银行和保险共用\n　　26 1311 代理兑付证券 银行和证券共用\n　　27 1321 代理业务资产\n　　28 1401 材料采购\n　　29 1402 在途物资\n　　30 1403 原材料\n　　31 1404 材料成本差异\n　　32 1406 库存商品\n　　33 1407 发出商品\n　　34 1410 商品进销差价\n　　35 1411 委托加工物资\n　　36 1412 包装物及低值易耗品\n　　37 1421 消耗性生物资产 农业专用\n　　38 1431 周转材料 建造承包商专用\n　　39 1441 贵金属 银行专用\n　　40 1442 抵债资产 金融共用\n　　41 1451 损余物资 保险专用 \n　　42 1461 存货跌价准备\n　　43 1501 待摊费用\n　　44 1511 独立账户资产 保险专用\n　　45 1521 持有至到期投资\n　　46 1522 持有至到期投资减值准备\n　　47 1523 可供出售金融资产\n　　48 1524 长期股权投资\n　　49 1525 长期股权投资减值准备\n　　50 1526 投资性房地产\n　　51 1531 长期应收款\n　　52 1541 未实现融资收益\n　　53 1551 存出资本保证金 保险专用\n　　54 1601 固定资产\n　　55 1602 累计折旧\n　　56 1603 固定资产减值准备\n　　57 1604 在建工程\n　　58 1605 工程物资\n　　59 1606 固定资产清理\n　　60 1611 融资租赁资产 租赁专用\n　　61 1612 未担保余值 租赁专用\n　　62 1621 生产性生物资产 农业专用\n　　　　63 1622 生产性生物资产累计折旧 农业专用\n　　64 1623 公益性生物资产 农业专用\n　　65 1631 油气资产 石油天然气开采专用\n　　66 1632 累计折耗 石油天然气开采专用\n　　67 1701 无形资产\n　　68 1702 累计摊销\n　　69 1703 无形资产减值准备\n　　70 1711 商誉\n　　71 1801 长期待摊费用\n　　72 1811 递延所得税资产\n　　73 1901 待处理财产损溢\n\n　　二、负债类\n　　74 2001 短期借款\n　　75 2002 存入保证金 金融共用\n　　76 2003 拆入资金 金融共用\n　　77 2004 向中央银行借款 银行专用\n　　78 2011 同业存放 银行专用\n　　79 2012 吸收存款 银行专用\n　　80 2021 贴现负债 银行专用\n　　81 2101 交易性金融负债\n　　82 2111 卖出回购金融资产款 金融共用\n　　83 2201 应付票据\n　　84 2202 应付账款\n　　85 2205 预收账款\n　　86 2211 应付职工薪酬\n　　87 2221 应交税费\n　　88 2231 应付股利\n　　89 2232 应付利息\n　　90 2241 其他应付款\n　　91 2251 应付保户红利 保险专用\n　　92 2261 应付分保账款 保险专用\n　　93 2311 代理买卖证券款 证券专用\n　　94 2312 代理承销证券款 证券和银行共用\n　　95 2313 代理兑付证券款 证券和银行共用\n　　96 2314 代理业务负债\n　　97 2401 预提费用\n　　98 2411 预计负债\n　　99 2501 递延收益\n　　100 2601 长期借款\n　　101 2602 长期债券\n　　102 2701 未到期责任准备金 保险专用\n　　103 2702 保险责任准备金 保险专用\n　　104 2711 保户储金 保险专用\n　　105 2721 独立账户负债 保险专用\n　　106 2801 长期应付款\n　　107 2802 未确认融资费用\n　　108 2811 专项应付款\n　　109 2901 递延所得税负债\n\n　　三、共同类\n　　110 3001 清算资金往来 银行专用\n　　111 3002 外汇买卖 金融共用\n　　112 3101 衍生工具\n　　113 3201 套期工具\n　　114 3202 被套期项目\n\n　　四、所有者权益类\n　　115 4001 实收资本\n　　116 4002 资本公积\n　　117 4101 盈余公积\n　　118 4102 一般风险准备 金融共用\n　　119 4103 本年利润\n　　120 4104 利润分配\n　　121 4201 库存股\n\n　　五、成本类\n　　122 5001 生产成本\n　　123 5101 制造费用\n　　124 5201 劳务成本\n　　125 5301 研发支出\n　　126 5401 工程施工 建造承包商专用\n　　127 5402 工程结算 建造承包商专用\n　　128 5403 机械作业 建造承包商专用\n\n　　六、损益类\n　　129 6001 主营业务收入\n　　130 6011 利息收入 金融共用\n　　131 6021 手续费收入 金融共用\n　　132 6031 保费收入 保险专用\n　　133 6032 分保费收入 保险专用\n　　134 6041 租赁收入 租赁专用\n　　135 6051 其他业务收入\n　　136 6061 汇兑损益 金融专用\n　　137 6101 公允价值变动损益\n　　138 6111 投资收益\n　　139 6201 摊回保险责任准备金 保险专用\n　　140 6202 摊回赔付支出 保险专用\n　　141 6203 摊回分保费用 保险专用\n　　142 6301 营业外收入\n　　143 6401 主营业务成本\n　　144 6402 其他业务支出\n　　145 6405 营业税金及附加\n　　146 6411 利息支出 金融共用\n　　147 6421 手续费支出 金融共用\n　　148 6501 提取未到期责任准备金 保险专用\n　　149 6502 提取保险责任准备金 保险专用\n　　150 6511 赔付支出 保险专用\n　　151 6521 保户红利支出 保险专用\n　　152 6531 退保金 保险专用\n　　153 6541 分出保费 保险专用\n　　154 6542 分保费用 保险专用\n　　155 6601 销售费用\n　　156 6602 管理费用\n　　157 6603 财务费用\n　　158 6604 勘探费用\n　　159 6701 资产减值损失\n　　160 6711 营业外支出\n　　161 6801 所得税\n　　162 6901 以前年度损益调整', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204256', '1504023458');
INSERT INTO `users_item` VALUES ('26', '21', '0', '0', '1', '1449204334', '1449204334', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '如何备份账套', '双击桌面“系统管理”图标，在用户名处输入“admin”进入系统管理\n\n会计做账之用友T3：[2]如何备份账套\n点击“账套”菜单下的“备份”\n会计做账之用友T3：[2]如何备份账套\n选择要备份的账套号，点击确认\n注意：一定不要勾选“删除当前输出账套”\n会计做账之用友T3：[2]如何备份账套\n4\n选择好要备份的路径（将文件备份到哪里），然后点击确认\n会计做账之用友T3：[2]如何备份账套\n5\n一个账套正常备份出来的文件有两个，名称分别是UF2KAct.Lst和UFDATA.BA_', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204334', '1504023458');
INSERT INTO `users_item` VALUES ('27', '21', '0', '0', '1', '1449204370', '1449204370', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '新公司建账做账报税     ', '建账：新建单位和原有单位在年度开始时，会计人员均应根据核算工作的需要设置应用账簿，即平常所说的“建账”。  建账的基本流程： \n 第一步：按照需用的各种账簿的格式要求，预备各种账页，并将活页的账页用账夹装订成册。\n   第二步：在账簿的“启用表”上，写明单位名称、账簿名称、册数、编号、起止页数、启用日期以及记账人员和会计主管人员姓名，并加盖名章和单位公章。    第三步：按照会计科目表的顺序、名称，在总账账页上建立总账账户；并根据总账账户明细核算的要求，在各个所属明细账户上建立二、三级明细账户。\n   第四步：启用订本式账簿，应从第一页起到最后一页止顺序编定号码，不得跳页、缺号；使用活页式账簿，应按账户顺序编本户页次号码。   在建账时都要首先考虑以下问题： \n 第一，与企业相适应。企业规模与业务量是成正比的，规模大的企业，业务量大，分工也复杂，会计账簿需要的册数也多。 \n   第二，依据企业管理需要。建立账簿是为了满足企业管理需要，为管理提供有用的会计信息，所以在建账时以满足管理需要为前提，避免重复设账、记账。         第三，依据账务处理程序。企业业务量大小不同，所采用的账务处理程序也不同。   做账应应取得的资料：  主要有企业章程、企业法人营业执照、国地税税务登记证、验资报告等。特别是验资报告，其用处主要有：一是能佐证企业的注册资本金额，以便确定账务中实收资本金额；二是能反映股东的出资方式，是货币或是实物等。取得验资报告主要目的是为了确定股东的出资方式。不能确定股东的出资方式是无法建账的，建账时一定要让企业主找到成立时的验资报告，注册资本发生变动的，应取得历次的验资报告。若是以实物出资，还要找到当时的评估报告。  按表项目核实资产负债额： \n 1．盘点现金及单据，注意需要换发票的白条也应考虑进去，确定现金金额；   2．取得银行存款对账单，并核实未达账项，确定银行存款金额；   3．盘点原材料、库存商品等，确定存货金额；    4．编制应收、应付、其他应收、其他应付等往来款项表，注意最好让往来单位盖章或签字确认，确定往来款项金额；检查有无长短期借款、应付工资、应交税金等项目；   5．盘点固定资产，确定固定资产金额；    6．取得企业法人营业执照和验资报告，确定实收资本金额；     7．根据公式“资产-负债=所有者权益，所有者权益-实收资本(股东多投入的资金暂挂其他应付款)=未分配利润”推算出未分配利润金额，\n 8．根据结果编制出资产负债表，并据此做第一号凭证；     9．启用账薄，将第一号凭证内容登记入账。在账薄日期栏填写登记入账的日期，摘要栏可写“盘点建账”。  \n特别说明：  1.这种情况下最好只编制一张资产负债表，因其建立在盘点基础上，数据比较准确；但若编制利润表有一定的难度，数据也不易做准确。          2.因时间紧等原因若期后发现有关数据未盘点准确，应在发现的当期编制凭证调整相关项目及未分配利润金额。          3.若盘点时间和建账时间不一致，如8月份准备建账，盘点时间只能为8月，而却要从6月份建账，这时就要注意全面搜集所发生业务的相关资料，根据资料倒推出6月份的资产负债情况。  1.我公司营业执照还没有下来，现在装修费（包括人工费及材料费）及购入的固定资产费用都没有发票，只有收据（有的没有盖章），还有用手写的收条，请问这样要怎么做账呢？  2.公司进的原材料没有入库单，只有出库单，到正式营业的时候是否需重新盘点入库呢？这个流程应该怎么走呢？  请教各位老师了！ 2009-04-15 12:13 补充问题  1.请问收据如何换发票呢？其它行业的发票也可以吗？   2.如果在营业执照下来之后把所进材料入库，再出库，是否营业收入需交税呀？可否避税呢？而且所购材料均无发票。  1.我公司营业执照还没有下来，现在装修费（包括人工费及材料费）及购入的固定资产费用都没有发票，只有收据（有的没有盖章），还有用手写的收条，请问这样要怎么做账呢？  (1)先暂时按收据入账   借：预付账款--装修费、固定资产等  贷：银行存款等   （2）营业执照办下后，收据换正式发票，根据发票入帐时  借：固定资产、长期待摊费用--装修费等科目  贷：预付账款--装修费、固定资产等   2.公司进的原材料没有入库单，只有出库单，到正式营业的时候是否需重新盘点入库呢？这个流程应该怎么走呢？   （1）可以到商店购买入库单。   （2）购进材料时，填写入库单，根据入库单和购货发票入账。  （3）出库时，填写出库单，根据出库单和相关的票据入账。  2009-04-15 12:13 补充问题   1.请问收据如何换发票呢？其它行业的发票也可以吗？   我所说的收据换发票，是到单位采购的商店，让其开正式发票。特别是固定资产入账，要用正式发票。如果固定资产没有正式发票入账，提取的折旧费用不能税前扣除。   2.如果在营业执照下来之后把所进材料入库，再出库，是否营业收入需交税呀？可否避税呢？而且所购材料均无发票。   （1）只要有销售收入，就要交税的。   （2）购买材料没有发票，材料成本也不能税前扣除。 ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204370', '1504023458');
INSERT INTO `users_item` VALUES ('28', '21', '0', '0', '1', '1449204406', '1449204406', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '非正常损失”与“非常损失”的区别', '甲公司库存A产成品的月初数量为1 000台，月初账面余额为8 000万元;A在产品的月初数量为400台，月初账面余额为600万元。当月为生产A产品耗用原材料、发生直接人工和制造费用共计l5 400万元，其中包括因台风灾害而发生的停工损失300万元。当月，甲公司完成生产并入库A产成品2 000台，销售A产成品2 400台。当月末甲公司库存A产成品数量为600台，无在产品。甲公司采用一次加权平均法按月计算发出A产成品的成本。\n要求：根据上述资料，不考虑其他因素，回答下列第(1)题至第(2)题。(2011年)\n(1)下列各项关于因台风灾害而发生的停工损失会计处理的表述中，正确的是( )。\nA.作为管理费用计入当期损益\nB.作为制造费用计入产品成本\nC.作为非正常损失计入营业外支出\nD.作为当期已售A产成品的销售成本\n正确答案：C\n知识点：存货成本的结转\n答案解析：由于台风灾害而发生的停工损失，属于非正常损益，应当作为营业外支出处理。\n2)甲公司A产成品当月末的账面余额为( )。\nA.4 710万元\nB.4 740万元\nC.4 800万元\nD.5 040万元\n正确答案：B\n知识点：月末一次加权平均法\n答案解析：根据一次加权平均法按月计算发出A产成品的成本=(8 000+600+15 400-300)/(1 000+2 000)=7.9(万元)，A产品当月末的余额=7.9×600=4 740(万元)。\n【提问】：\n非正常原因是指哪些原因?他造成的存货盘亏或毁损计入哪个科目?进项税能否抵扣?\n非常原因指哪些原因?他造成的存货盘亏或毁损计入哪个科目?进项税怎么处理？\n【东奥会计在线回答】：\n尊敬的学员，您好：\n●“非正常损失”与“非常损失”\n在会计上，“非正常损失”与“非常损失”没有严格的区分，在2010年版准则讲解中指出：固定资产、生物资产，属于生产经营期间由于自然灾害等非正常原因造成的,借记“营业外支出——非常损失”科目。会计上的非常损失与非正常损失是一个意思。\n而税法上使用“非正常损失”的提法。\n在增值税方面，非正常损失是指是指因管理不善造成被盗、丢失、霉烂变质的损失。其他情况不属于非正常损失的范围。\n在所得税方面括因，损失原因被分为正常损失(包括正常转让、报废、清理等)、非正常损失(包战争、自然灾害等不可抗力造成损失，因人为管理责任毁损、被盗造成损失，政策因素造成损失等)、发生改组等评估损失和永久实质性损害。(《企业财产损失所得税前扣除管理办法》第三条)', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204406', '1504023458');
INSERT INTO `users_item` VALUES ('29', '21', '0', '0', '1', '1449204432', '1449204432', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '计提坏账准备账务处理', '例：某企业按照应收账款余额的3‰提取坏账准备。该企业第一年的应收账款余额为1000000元；第二年发生坏账6000元，其中甲单位1000元，乙单位5000元，年末应收账款余额为1200000元；第三年，已冲销的上年乙单位的应收账款5000元又收回，期末应收账款余额为1300000元。\n１、借：资产减值损失 3000\n\n　　贷：坏账准备 3000\n\n　2、第2年发生坏账损失\n\n　　借：坏账准备 6000\n\n　　　　贷：应收账款——甲单位 1000\n\n　　　　　　应收账款——乙单位 5000\n\n　　3、年末应收账款余额为1200000时，计提：1200000×3‰=3600，但由于第一年计提数3000元不够支付损失数6000元，因此，在第二年末时应补提第一年多损失的3000元，即，第二年末共计提6600元。\n\n　　借：资产减值损失 6600\n\n　　　　贷：坏账准备 6600\n\n　　4、已冲销的上年应收账款又收回\n\n　　借：应收账款——乙单位 5000\n\n　　　　贷：坏账准备 5000\n\n　　同时：\n\n　　借：银行存款 5000\n\n　　　　贷：应收账款 5000\n\n　　5、期末应收账款余额为1300000时，1300000×3‰－（3600+5000）＝－4700\n\n　　由于第3年收回已前冲销的坏账5000元，因此，年末坏账准备的贷方余额已经为8600元了，而当年按应收账款余额计算，只能将坏账准备贷方余额保持为3900元，因此，应将多计提的4700元冲回。\n\n　　借：坏账准备 4700\n\n　　　　贷：资产减值损失 4700 \n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204432', '1504023458');
INSERT INTO `users_item` VALUES ('30', '21', '0', '0', '1', '1449204460', '1449204460', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '简并增值税征收率新旧政策对比表新政策', '财税（2014）57号、国家税务总局公告2014年第36号\n旧政策一般纳税人销售自己使用过固定资产（符合简易计税方法条件的）\n含：财税[2009]9号、财税[2008]170号、国税函[2009]90号、国家税务总局公告2012年第1号\n按照简易办法依照3%征收率减按2%征收增值税。\n计算：含税卖价/(1+3%)*2%，按简易办法依4%征收率减半征收增值税，纳税人销售旧货县级及县级以下小型水力发电单位生产的电力，依照3%征收率\n依照6%征收率建筑用和生产建筑材料所用的砂、土、石料\n以自己采掘的砂、土、石料或其他矿物连续生产的砖、瓦、石灰(不含粘土实心砖、瓦)。\n用微生物、微生物代谢产物、动物毒素、人或动物的血液或组织制成的生物制品\n自来水，商品混凝土(仅限于以水泥为原料生产的水泥混凝土)\n寄售商店代销寄售物品(包括居民个人寄售的物品在内)\n依照3%征收率，依照4%征收率，典当业销售死当物品\n固定业户临时外出经营,经营地税务机关按6%的征收率征税\n3%6%，拍卖行取得的拍卖收入3%，4%\n属于增值税一般纳税人的单采血浆站销售非临床用人体血液\n可按简易办法依3%征收率减按2%征收增值税\n按简易办法依4%征收率减半征收增值税', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204460', '1504023458');
INSERT INTO `users_item` VALUES ('31', '21', '0', '0', '1', '1449204481', '1449204481', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '计算土地增值税 　', '计算土地增值税\n　　计算土地增值税的公式为：应纳土地增值税＝增值额×税率\n　　1、公式中的“增值额”为纳税人转让房地产所取得的收入减除扣除项目金额后的余额。\n　　纳税人转让房地产所取得的收入，包括货币收入、实物收入和其他收入。\n　　计算增值额的扣除项目：\n　　（1）取得土地使用权所支付的金额；\n　　（2）开发土地的成本、费用；\n　　（3）新建房及配套设施的成本、费用，或者旧房及建筑物的评估价格；\n　　（4）与转让房地产有关的税金；\n　　（5）财政部规定的其他扣除项目。\n　　2、土地增值税实行四级超率累进税率：\n　　增值额未超过扣除项目金额50％的部分，税率为30％。\n　　增值额超过扣除项目金额50％、未超过扣除项目金额100％的部分，税率为40％。\n　　增值额超过扣除项目金额100％、未超过扣除项目金额200％的部分，税率为50％。\n　　增值额超过扣除项目金额200％的部分，税率为60％。\n　　上面所列四级超率累进税率，每级“增值额未超过扣除项目金额”的比例，均包括本比例数。\n　　纳税人计算土地增值税时，也可用下列简便算法：\n　　计算土地增值税税额，可按增值额乘以适用的税率减去扣除项目金额乘以速算扣除系数的简便方法计算，具体公式如下：\n　　（一）增值额未超过扣除项目金额50％\n　　土地增值税税额=增值额×30％\n　　（二）增值额超过扣除项目金额50％，未超过100％的土地增值税税额＝增值额×40％－扣除项目金额×5％\n　　（三）增值额超过扣除项目金额100％，未超过200％的土地增值税税额=增值额×50％－扣除项目金额×15％\n　　（四）增值额超过扣除项目金额200％\n　　土地增值税税额=增值额×60％－扣除项目金额×35％\n　　公式中的5％，15％，35％为速算扣除系数。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204481', '1504023458');
INSERT INTO `users_item` VALUES ('32', '21', '0', '0', '1', '1449204514', '1449204514', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '等额本金和等额本息的区别（含计算公式） ', '对于大多数人来说，买房都需要向银行借贷，这里面就牵扯到一个重要问题，一般向银行贷款有两种方式：等额本金法和等额本息法。许多人对这两种方法不甚了解，以至于在贷款方面吃了大亏，今天笔者就详细的向大家讲述等额本金和等额本息的区别和各自适用的人群。 \n等额本金和等额本息的区别（含计算公式） \n等额本息法\n等额本息法最重要的一个特点是每月的还款额相同，从本质上来说是本金所占比例逐月递增，利息所占比例逐月递减，月还款数不变，即在月供“本金与利息”的分配比例中，前半段时期所还的利息比例大、本金比例小，还款期限过半后逐步转为本金比例大、利息比例小，其计算公式为：\n每月还本付息金额 =[ 本金 x 月利率 x(1+月利率)贷款月数 ] / [(1+月利率)还款月数 - 1]\n　每月利息 = 剩余本金x贷款月利率\n　还款总利息=贷款额*贷款月数*月利率*（1+月利率）贷款月数/【（1+月利率）还款月数 - 1】-贷款额\n   还款总额=还款月数*贷款额*月利率*（1+月利率）贷款月数/【（1+月利率）还款月数 - 1】\n注意：在等额本息法中，银行一般先收剩余本金利息，后收本金，所以利息在月供款中的比例会随本金的减少而降低，本金在月供款中的比例因而升高，但月供总额保持不变。\n 等额本金法\n等额本金法最大的特点是每月的还款额不同，呈现逐月递减的状态;它是将贷款本金按还款的总月数均分，再加上上期剩余本金的利息，这样就形成月还款额，所以等额本金法第一个月的还款额最多 ，然后逐月减少，越还越少，计算公式为：\n每月还本付息金额=(本金/还款月数)+(本金-累计已还本金)×月利率\n每月本金=总本金/还款月数\n每月利息=(本金-累计已还本金)×月利率\n还款总利息=（还款月数+1）*贷款额*月利率/2\n还款总额=(还款月数+1)*贷款额*月利率/2+贷款额\n注意：在等额本金法中，人们每月归还的本金额始终不变，利息随剩余本金的减少而减少，因而其每月还款额逐渐减少。\n从上面我们可以看出，在一般的情况下，等额本息所支出的总利息比等额本金要多，而且贷款期限越长，利息相差越大。\n等额本金和等额本息的区别（含计算公式）\n等额本息适合的人群\n等额本息每月的还款额度相同，所以比较适宜有正常开支计划的家庭，特别是年青人，而且随着年龄增大或职位升迁，收入会增加，生活水平自然会上升;如果这类人选择本金法的话，前期压力会非常大。\n 等额本金适合的人群\n等额本金法因为在前期的还款额度较大，而后逐月递减，所以比较适合在前段时间还款能力强的贷款人，当然一些年纪稍微大一点的人也比较适合这种方式，因为随着年龄增大或退休，收入可能会减少。\n说了这么多，可能许多读者看的也是云里雾里的，下面笔者通过一个实例来说明等额本金和等额本息的区别和优劣。\n例：李先生买了一套商品房，面积120平米，他向银行贷款60万，还款期限为20年，年利率为6%(月利率为5‰)现在我们分别用等额本金和等额本息法进行分析：\n　　等额本息：每月还款金额=【600000*5‰*(1+5‰)240】/【(1+5‰)*240-1】=3012.5元\n　　等额本金：第一个月=(600000/240) + (600000-0)×5‰=5500\n　　第二个月=(600000/240) + (600000-2500)×5‰=5487.5\n　　......\n　　实质上，等额本金法与等额本息法并没有很大的优劣之分，大部分是根据每个人的现状和需求而定的。等额本息利于记忆、规划、方便还款。事实上绝大多数人都宁愿选择“等额还款方式”，因为这种方式月还款额固定还款压力均衡，与等额本金法差别也不是非常的大，况且随着时间的增长，会使资金的使用价值产生了不同。当然，也有许多人经济相对宽裕，想使自己以后的生活更加轻松及节约成本，会选择等额本金法。简单来说选择哪种还款方式，需根据每个人的现状和对未来的规划而定，不要一味的相信别人的话。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204514', '1504023458');
INSERT INTO `users_item` VALUES ('33', '21', '0', '0', '1', '1449204534', '1449204534', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '用友里结转的系数是什么意思？', '所谓结转系数指的是结转的比例。即按全额结转，还是按百分之多少结转。全额结转的系数为1.', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204534', '1504023458');
INSERT INTO `users_item` VALUES ('34', '21', '0', '0', '1', '1449204572', '1449204572', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '2014年最新印花税税目税率2014年最新印花税税目税率表', '印花税的纳税人包括在中国境内书立、领受规定的经济凭证的企业、行政单位、事业单位、军事单位、社会团体、其他单位、个体工商户和其他个人。\n（一）纳税人\n印花税的纳税人包括在中国境内书立、领受规定的经济凭证的企业、行政单位、事业单位、军事单位、社会团体、其他单位、个体工商户和其他个人。\n（二）税目和税率（税额标准）\n根据应纳税凭证性质的不同，印花税分别采用比例税率和定额税率，具体税目、税额标准详见《印花税税目、税率（税额标准）表》：此外，根据国务院的专门规定，股份制企业向社会公开发行的股票，因买卖、继承、赠与所书立的股权转让书据，应当按照书据书立的时候证券市场当日实际成交价格计算的金额，由出让方按照1‰的税率缴纳印花税。\n（三）计税方法\n印花税以应纳税凭证所记载的金额、费用、收入额和凭证的件数为计税依据，按照适用税率或者税额标准计算应纳税额。\n应纳税额计算公式：\n1.应纳数额=应纳税凭证记载的金额（费用、收入额）×适用税率\n2.应纳税额=应纳税凭证的件数×适用税额标准\n（四）免税\n1.下列凭证可以免征印花税：\n（1）已经缴纳印花税的凭证的副本、抄本，但是视同正本使用者除外；\n（2）财产所有人将财产赠给政府、抚养孤老伤残人员的社会福利单位、学校所立的书据；\n（3）国家指定的收购部门与村民委员会、农民个人书立的农副产品收购合同；\n（4）无息、贴息贷款合同；\n（5）外国政府、国际金融组织向中国政府、国家金融机构提供优惠贷款所书立的合同；\n（6）企业因改制而签订的产权转移书据；\n（7）农民专业合作社与本社成员签订的农业产品和农业生产资料购销合同；\n（8）个人出租、承租住房签订的租赁合同，廉租住房、经济适用住房经营管理单位与廉租住房、经济适用住房有关的凭证，廉租住房承租人、经济适用住房购买人与廉租住房、经济适用住房有关的凭证。\n2.下列项目可以暂免征收印花税：\n（1）农林作物、牧业畜类保险合同；\n（2）书、报、刊发行单位之间，发行单位与订阅单位、个人之间书立的凭证；\n（3）投资者买卖证券投资基金单位；\n（4）经国务院和省级人民政府决定或者批准进行政企脱钩、对企业（集团）进行改组和改变管理体制、变更企业隶属关系，国有企业改制、盘活国有企业资产，发生的国有股权无偿划转行为；\n（5）个人销售、购买住房。\n3.自2010年9月27日起3年以内，公共租赁住房（以下简称公租房）经营管理单位建造公租房涉及的印花税可以免征。在其他住房项目中配套建设公租房，根据政府部门出具的相关材料，可以按照公租房建筑面积占总建筑面积的比例免征建造、管理公租房涉及的印花税。公租房经营管理单位购买住房作为公租房，可以免征印花税；公租房租赁双方签订租赁协议设计的印花税可以免征\n印花税的纳税人包括在中国境内书立、领受规定的经济凭证的企业、行政单位、事业单位、军事单位、社会团体、其他单位、个体工商户和其他个人。\n（一）纳税人\n印花税的纳税人包括在中国境内书立、领受规定的经济凭证的企业、行政单位、事业单位、军事单位、社会团体、其他单位、个体工商户和其他个人。\n（二）税目和税率（税额标准）\n根据应纳税凭证性质的不同，印花税分别采用比例税率和定额税率，具体税目、税额标准详见《印花税税目、税率（税额标准）表》：此外，根据国务院的专门规定，股份制企业向社会公开发行的股票，因买卖、继承、赠与所书立的股权转让书据，应当按照书据书立的时候证券市场当日实际成交价格计算的金额，由出让方按照1‰的税率缴纳印花税。\n（三）计税方法\n印花税以应纳税凭证所记载的金额、费用、收入额和凭证的件数为计税依据，按照适用税率或者税额标准计算应纳税额。\n应纳税额计算公式：\n1.应纳数额=应纳税凭证记载的金额（费用、收入额）×适用税率\n2.应纳税额=应纳税凭证的件数×适用税额标准\n（四）免税\n1.下列凭证可以免征印花税：\n（1）已经缴纳印花税的凭证的副本、抄本，但是视同正本使用者除外；\n（2）财产所有人将财产赠给政府、抚养孤老伤残人员的社会福利单位、学校所立的书据；\n（3）国家指定的收购部门与村民委员会、农民个人书立的农副产品收购合同；\n（4）无息、贴息贷款合同；\n（5）外国政府、国际金融组织向中国政府、国家金融机构提供优惠贷款所书立的合同；\n（6）企业因改制而签订的产权转移书据；\n（7）农民专业合作社与本社成员签订的农业产品和农业生产资料购销合同；\n（8）个人出租、承租住房签订的租赁合同，廉租住房、经济适用住房经营管理单位与廉租住房、经济适用住房有关的凭证，廉租住房承租人、经济适用住房购买人与廉租住房、经济适用住房有关的凭证。\n2.下列项目可以暂免征收印花税：\n（1）农林作物、牧业畜类保险合同；\n（2）书、报、刊发行单位之间，发行单位与订阅单位、个人之间书立的凭证；\n（3）投资者买卖证券投资基金单位；\n（4）经国务院和省级人民政府决定或者批准进行政企脱钩、对企业（集团）进行改组和改变管理体制、变更企业隶属关系，国有企业改制、盘活国有企业资产，发生的国有股权无偿划转行为；\n（5）个人销售、购买住房。\n3.自2010年9月27日起3年以内，公共租赁住房（以下简称公租房）经营管理单位建造公租房涉及的印花税可以免征。在其他住房项目中配套建设公租房，根据政府部门出具的相关材料，可以按照公租房建筑面积占总建筑面积的比例免征建造、管理公租房涉及的印花税。公租房经营管理单位购买住房作为公租房，可以免征印花税；公租房租赁双方签订租赁协议设计的印花税可以免征。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204572', '1504023458');
INSERT INTO `users_item` VALUES ('36', '21', '0', '0', '1', '1449204649', '1449204649', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '时光', '每一天都在倒数，人生到底追求的是什么？迷茫  纠结 一直困惑与我', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204649', '1504023458');
INSERT INTO `users_item` VALUES ('37', '21', '0', '0', '1', '1449204673', '1449204673', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '为什么我们更喜欢得不到的人', '为什么人喜欢得不到的人，因为人人都入戏。为什么我们更喜欢得不到的人？\n得不到的人，都是梦。\n人人都喜欢做梦。\n得到了，就是抓在手里的现实，现实没有梦那么好。\n你喜欢某一个人，你从不知道，她也有恼怒的样子，发起脾气，也要和你扯破脸皮。所以你以为，你二人相处得来，也该是一对伉俪，一对绝配，总有特别好的恩爱，一句一句的默契，但那都是你以为。\n你越是得不到，越是会想，会以为，会将那些电视里，书中，聪明人写给你的山盟海誓，双宿双飞，当成一种必然，一种理所应当。\n也许你随了他，随了她，你们现在都在赌气，都打破头，都抱在一起，说些不知道为什么，忽然不爱你。\n谁知道呢。\n当然，这只是一种绝对，其实大多数人，没这么傻，他们很聪明，聪明得很呢。\n\n但是，就算聪明人，就算像我，这个还算是有些感触的人，想得明白的人，也在某些不自觉的时候，偶尔流连一下这种得不到的快感。\n人都需要做梦，也需要童话的慰藉。\n世界上，能让我们自己骗自己的事情，有一个算一个，总是会牢牢抓住，于是就有了这样一种人，在你记忆长河的深处，泛舟而去，你凑近了，也不过雾中倩影，走远了，更是梦幻琉璃，然后转过身，骗骗自己。如果他答应了你。\n如果她答应了我。\n我们不知倦怠的，无论愚蠢还是聪慧的，乐此不疲的，将这种自我的伤感放大，建立在那些根本不存在的结局上。\n谢谢他们给了你我一个，哄哄自己的理由，让我们觉得，每个人都是至尊宝，好在熄灯的水帘洞里，自我陶醉地，念出一段台词。\n为什么人喜欢得不到的人，因为人人都入戏，\n“可是，\n没有你，\n一切都没有意义', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204673', '1504023458');
INSERT INTO `users_item` VALUES ('38', '21', '0', '0', '1', '1449204707', '1449204707', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '心    疼', '感此伤妆心，坐愁红颜老。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449204707', '1504023458');
INSERT INTO `users_item` VALUES ('39', '21', '0', '0', '1', '1449204763', '1449204763', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '再别康桥 - 徐志摩 1928.11.6', '轻轻的我走了，正如我轻轻的来； \n我轻轻的招手，作别西天的云彩。 \n那河畔的金柳，是夕阳中的新娘； \n波光里的艳影，在我的心头荡漾。 \n软泥上的青荇，油油的在水底招摇； \n在康河的柔波里，我甘心做一条水草！ \n那榆荫下的一潭，不是清泉，是天上虹； \n揉碎在浮藻间，沉淀著彩虹似的梦。 \n寻梦? 撑一支长篙，向青草更青处漫溯； \n满载一船星辉，在星辉斑斓里放歌。 \n但我不能放歌，悄悄是别离的笙箫； \n夏虫也为我沉默，沉默是今晚的康桥！ \n悄悄的我走了，正如我悄悄的来； \n我挥一挥衣袖，不带走一片云彩。 \n ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449204763', '1504023458');
INSERT INTO `users_item` VALUES ('45', '21', '0', '0', '1', '1449464314', '1449464314', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '原问题', '1.人类最大的信任来源于共识，一个共识能够换来合作，协作。\n2.制度，是自上而下的，\n3.好的愿望未必有好的结果，一切制度要首先源于人性；\n4.自下而上形成的共识是最有力量的制度。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449464314', '1504023458');
INSERT INTO `users_item` VALUES ('46', '21', '0', '0', '1', '1449464496', '1449464496', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '制度的研究', '1.政治学，经济学，\n2.发展的学科，\n3.生产 VS 分配；\n4.生产和分配是直接相关的，\n5.政府再分配的研究方法，', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449464496', '1504023458');
INSERT INTO `users_item` VALUES ('47', '21', '0', '0', '1', '1449496877', '1449496877', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '读历史目录', '1.读史\n2.文物', null, null, 'history', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449496877', '1504023458');
INSERT INTO `users_item` VALUES ('48', '21', '0', '0', '1', '1449505298', '1449505298', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《必然》 凯文·凯利', '目录\n第1章 形成 Becoming\n第2章 知化 Cognifying\n第3章 流动 Flowing\n第4章 屏读 Screening\n第5章 使用 Accessing\n第6章 共享 Sharing\n第7章 过虑 Filtering\n第8章 重混 Remixing\n第9章 互动 Interacting\n第10章 追踪 Tracking\n第11章 提问 Questioning\n第12章 开始 Beginning\n\n罗振宇读书笔记\n2015-11-10_笔记（1） 读书笔记：什么是“必然”？  http://www.luofans.com/articles/1634\n2015-11-12_机会（2） 《必然》干货版之二：你没迟到 http://www.luofans.com/articles/1641\n2015-11-16_智能（3） 《必然》干货版之三：人工智能，下一个商机 http://www.luofans.com/articles/1655\n2015-11-18_价值（4） 《必然》干货版之四：应对流动的8个方案 http://www.luofans.com/articles/1661\n2015-11-23_内容（5） 《必然》干货版之五：屏幕崛起将改变的五件事 http://www.luofans.com/articles/1677\n2015-11-25_过滤（6？） 注意力，未来唯一有价值的资源 http://www.luofans.com/articles/1683\n2015-11-29_未来（7？） 结婚不买房，一篇文章说服丈母娘 http://www.luofans.com/articles/1696\n2015-12-06_效率（8） 在分享时代，如何挣到钱 http://www.luofans.com/articles/1719 \n2015-12-14_方法（9） 世界不是“新”的，世界是“混”的 http://www.luofans.com/articles/1749\n2015-12-22_未来（10） 未来已来，只是尚未流行 http://www.luofans.com/articles/1780\n2015-12-28_变化（11） 一场永远持续的“核爆炸 http://www.luofans.com/articles/1802\n2016-01-17_问题（12） 谁有问题谁牛逼 http://www.luofans.com/articles/1873\n2016-02-17_开始（13） 来吧，一切才刚刚开始 http://www.luofans.com/articles/1988\n\n', null, null, 'reading 读书', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449505298', '1504023458');
INSERT INTO `users_item` VALUES ('49', '21', '0', '0', '1', '1449506649', '1449506649', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '古墓', '满城汉墓 http://baike.baidu.com/view/5219.htm\n满城汉墓是西汉中山靖王刘胜及其妻窦绾之墓。 河北保定市满城县\n\n马王堆汉墓 http://baike.baidu.com/view/48966.htm\n马王堆汉墓是西汉初期长沙国丞相利苍及其家属的墓葬，位于中国中部湖南省的长沙市。', null, null, '文物 历史 history', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449506649', '1504023458');
INSERT INTO `users_item` VALUES ('50', '21', '0', '0', '1', '1449514485', '1449514485', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《如何在人生中推销自己》  拿破仑·希尔 ', '1.能够影响人而不激怒他人，是一门最有利可图的艺术。P3\n2.没有阿谀奉承的情况下得到朋友并影响他人。P3', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449514485', '1504023458');
INSERT INTO `users_item` VALUES ('51', '21', '0', '0', '1', '1449514868', '1449514868', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《老子》 又 《道德经》', '道德经 http://baike.baidu.com/view/16516.htm\n帛书老子 http://baike.baidu.com/view/3899093.htm\n楚简老子 http://baike.baidu.com/view/3899117.htm\n\n道德经有多个版本：《道德经》通行本（王弼本）是最常见的，另外郭店出土的楚简《老子》残篇与马王堆汉墓出土的帛书《老子（甲、乙）》展示了早期《道德经》的不同文字风貌，备受当今多数学者的重视。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449514868', '1504023458');
INSERT INTO `users_item` VALUES ('58', '21', '0', '0', '1', '1449542232', '1449542232', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '罗辑思维团队&罗辑思维说什么', '罗振宇：“自带信息，不装系统，随时插拔，自由协作”\n罗振宇,安徽桐城 1973.1.11 华中科技大学（武汉） 中国传媒大学（北京）\n创始人：申音、罗振宇\nCEO：李天田（脱不花妹妹）\n\nhttp://www.luofans.com/\nhttp://www.jianshu.com/collection/bf62efd5b9bc\nhttp://www.jianshu.com/p/11887dee56a6\n\n罗辑思维店铺：http://wap.koudaitong.com/v2/showcase/homepage?kdt_id=54023\n\n罗辑思维说什么\n1.互联网创业，人与人的协作方式，陌生人合作的可能性；\n2.自由主义以及自由主义经济；\n3.法制；\n4.历史；\n\n罗辑思维 文字版\n二蛋曰的博客：http://blog.sina.com.cn/s/articlelist_3860041441_1_7.html\n罗辑思维电子书合集的QQ空间：http://user.qzone.qq.com/348533194/2\n豆丁：http://www.docin.com/450900080\n罗辑思维吧（连接豆丁）：http://tieba.baidu.com/p/4022482886?see_lz=1&pn=1\nhttp://search.kdnet.net/?q=%C2%DE%BC%AD%CB%BC%CE%AC&sa=%CB%D1%CB%F7&category=title&boardid=0&arrival=2012-10-12&departure=2015-10-12&p=3&m=04685\n\n书单：\nhttp://user.qzone.qq.com/348533194/2?t=0.20627768756821752\n第一季：http://book.douban.com/doulist/3511145/\n第二季：http://www.douban.com/doulist/3525421/\n\n张宏杰，著有《中国国民性演变历程》、《大明王朝的七张面孔》、《曾国藩的正面与侧面》、《坐天下很累》、《饥饿的盛世：乾隆时代的得与失》等。\n李洁非，著有《龙床 : 明六帝纪》、《黑洞 : 弘光纪事》、《野哭 : 弘光列传》等。\n李开元，著有《秦崩》《楚亡》等。\n李子暘，北京大学，铅笔经济研究社。\n冯启娜，人民大学。\n陈兴杰，公众号菁城子。\n李源同学：人民大学，清史研究生。', null, null, '罗辑思维', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449542232', '1504023458');
INSERT INTO `users_item` VALUES ('79', '21', '0', '0', '1', '1449573256', '1449573256', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '测试', '', null, null, '', '0', '0', '0', null, null, null, null, null, '1', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449573256', '1504023458');
INSERT INTO `users_item` VALUES ('85', '21', '0', '0', '1', '1449636471', '1449636471', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '互联网大事件 - 合并潮', '搜狐新闻 盘点中国互联网十大合并案例 http://www.sohu.com/i/?pvid=bfd96a6b41a6bcaa', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449636471', '1504023458');
INSERT INTO `users_item` VALUES ('87', '48', '3', '0', '0', '1449640153', '1449640153', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '测试k，', '陪说话，陪聊天，陪唠嗑，', 'sinaimg-/90b68290gw1eyyzlbk1fuj218g0p0mzk.jpg', null, '', '1', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449640153', '1504023458');
INSERT INTO `users_item` VALUES ('89', '21', '0', '0', '1', '1449647140', '1449647140', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《番茄工作法图解》 中的提问', '一、一次只做一件事\n 1.什么让你半途而废？\n 2.在哪些地方读书，更容易让你集中精力？\n 3.你是怎么逃避做无聊琐事？\n 4.通常哪类活动会让你花费的时间超过预期？\n 5.你的时间是否经常被事务型活动填满，即使有更重要的事要办？\n\n二、背景\n 1.在一份耗费脑力的活动上你能专注多久？\n 2.你的私人生活和职业生活的节奏是怎样的？\n 3.对于考验记忆游戏，你能玩好吗？\n 4.你上一次拖延是什么时候？为什么？\n 5.你做决定的时候是凭直觉还是凭意识？如何平衡？\n\n三、方法\n 1.你是否有过一个长长的工作清单并受其害？\n 2.你的精神奖励是什么？\n 3.那种计时器适合你？\n 4.你的工作当中多久休息一次？\n 5.你在什么时间对工作习惯进行反思？\n\n四、中断\n 1.你在工作中经常被哪类中断困扰？\n 2.当有人拿毫不相干的问题烦你的时候，你会怎么做？\n 3.你如何保存灵光一现的新想法？\n 4.你在什么时间设法专心做事？\n 5.你总是能够记得按照承诺答复对方吗？\n\n五、预估\n 1.你通常能按照每天的计划完成工作吗？\n 2.你是否经常修改自己的预期？\n 3.要将你承诺的事情全部完成，你知道需要多久吗？\n 4.你所预估的活动时间，最长要花多久？以天，小时还是分钟计？\n 5.你所预估的活动时间，最短要花多久？以天，小时还是分钟计？\n\n六、应变\n 1.你在哪些事物型工作中使用笔和纸？\n 2.你上班时在哪个时间段打电话和发电子邮件？\n 3.你通常多久休息一次？\n 4.你什么时候会长时间连续专注工作，而不休息？\n 5.你如何在工作中使用索引卡片？\n\n七、团队\n 1.你们开会用多长时间？\n 2.在两个配搭工作期间，你们多久休息一次？\n 3.在团队协同工作期间，你们多久休息一次？\n 4.哪些类型的工作不适合两个配搭完成？\n 5.即使有人没准备好，你们的会议仍然会开始么？', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449647140', '1504023458');
INSERT INTO `users_item` VALUES ('90', '21', '0', '0', '1', '1449647405', '1449647405', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'lotusmartree 思维导图', '0.为什么做这样一件事？\n1.lotusmartree 是什么？\n2.lotusmartree 想要做什么 & 能做什么？ 产业布局\n3.lotusmartree 远景是什么 & 企业文化是什么？\n4.lotusmartree 产品形态，提供什么服务，解决什么需求？\n5.lotusmartree 为什么可以成功 （亮点是什么，哪里与众不同？）\n6.lotusmartree 商业化：商业模式 & 推广方案 BP', null, null, 'lotusmartree', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449647405', '1504023458');
INSERT INTO `users_item` VALUES ('91', '21', '0', '0', '1', '1449647824', '1449647824', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '我的思维导图 YW\' Mind Map', '1.读书学知 Reading : open your eyes\n2.学习研究 Studying\n3.修身 Learning & Training\n4.立业 Career\n5.生活 Life\n\n读书目录 reading [122.82]', null, null, 'mindmap 导图', '0', '0', '0', null, null, null, null, null, '1', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1449647824', '1504023458');
INSERT INTO `users_item` VALUES ('212', '21', '0', '0', '1', '1449986649', '1449986649', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '会计法律构成及会计工作管理体制', '1、会计法律 （全国人民代表大会及其常务委员会及经过一定立法程序制定的有关会计工作的法律）。\n2、会计行政法规\n3、会计部门规章\n4、地方性会计法规\n\n我国会计工作管理体制总原则：统一领导 分级管理\n1、会计工作的行政管理 \n2、会计工作的自律管理\n3、单位会计工作管理\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449986649', '1504023458');
INSERT INTO `users_item` VALUES ('231', '21', '0', '0', '1', '1449987582', '1449987582', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '会计法律构成及会计工作管理体制', '1、会计法律 （全国人民代表大会及其常务委员会及经过一定立法程序制定的有关会计工作的法律）。\n2、会计行政法规\n3、会计部门规章\n4、地方性会计法规\n\n我国会计工作管理体制总原则：统一领导 分级管理\n1、会计工作的行政管理 （制定国家统一的会计准则制度、会计市场管理、会计专业人才评价、会计监督检查）\n2、会计工作的自律管理 （中国注册会计师协会、社会团体登记条例）\n3、单位会计工作管理    (单位负责人的职责、会计机构的设置、会计人员的选拔任用、会计人员回避制度） \n\n\n\n\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449987582', '1504023458');
INSERT INTO `users_item` VALUES ('245', '29', '1', '0', '0', '1449988921', '1449988921', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '', '云想衣裳花想容，春风拂槛露花浓。\n若非群玉山头见，会向瑶台月下逢。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449988921', '1504023458');
INSERT INTO `users_item` VALUES ('246', '29', '1', '0', '0', '1449988961', '1449988961', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '再别康桥 - 徐志摩 1928.11.6', '轻轻的我走了，正如我轻轻的来； \n我轻轻的招手，作别西天的云彩。 \n那河畔的金柳，是夕阳中的新娘； \n波光里的艳影，在我的心头荡漾。 \n软泥上的青荇，油油的在水底招摇； \n在康河的柔波里，我甘心做一条水草！ \n那榆荫下的一潭，不是清泉，是天上虹； \n揉碎在浮藻间，沉淀著彩虹似的梦。 \n寻梦? 撑一支长篙，向青草更青处漫溯； \n满载一船星辉，在星辉斑斓里放歌。 \n但我不能放歌，悄悄是别离的笙箫； \n夏虫也为我沉默，沉默是今晚的康桥！ \n悄悄的我走了，正如我悄悄的来； \n我挥一挥衣袖，不带走一片云彩。 \n ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449988961', '1504023458');
INSERT INTO `users_item` VALUES ('248', '21', '0', '0', '1', '1449992704', '1449992704', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '会计账簿 及账目核对', '1、总账。也称总分类账，是根据会计科目设置的账簿，用于分类登记单位的全部经济事项业务，提供资产、负债、资本、费用、成本、收入和 成果等总括核算的资料。总账一般使用订本账。 \n2、明细账。也称明细分类账是根据总账科目所属的明细科目设置的，用于分类登记某一类经济业务事项，提供有关明细核算资料。明细账一般采用活页账。\n3、日记账。是一种特殊的序时明细账，它是按照经济业务发生的时间先后顺序，逐日逐笔的进行登记的账簿。包括现金日记账和银行存款日记账。日记账一般使用订本帐。\n4、其他辅助账簿。也称备查账簿，是为备忘备查而设置的。主要包括各种租借设备、物资的辅助登记或有关应收、应付款项的备查簿，担保、抵押备查簿等。\n\n账目核对要做到账实相符、账证相符、账账相符和账表相符。\n1、账实相符是会计账簿记录与实务、款项实有数核对相符的简称。\n2、账证相符是会计账簿记录与会计凭证有关内容核对相符的简称。\n3、账账相符是会计账簿之间对应记录核对相符的简称。\n4、账表相符是会计账簿记录与会计报表有关内容核对相符的简称。\n\n\n', null, null, '财务报表：资产负债表 利润表 现金流量表 所有者权益变动表 附注。', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1449992704', '1504023458');
INSERT INTO `users_item` VALUES ('249', '21', '0', '0', '1', '1450009499', '1450009499', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '教育', '孩子的教育 [122.223]\n《吾国教育病理》 [122.224]\n英国有个“儿童十大宣言” [122.225]\n论教育 [122.226]\n', null, null, 'edu', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450009499', '1504023458');
INSERT INTO `users_item` VALUES ('250', '48', '9', '0', '0', '1450058248', '1450058248', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '测试商品', '一个棒球棒', 'sinaimg-/90b68290gw1eyyybw6n6bj21kw23u1kx.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1450058248', '1504023458');
INSERT INTO `users_item` VALUES ('252', '21', '0', '0', '1', '1450082519', '1450082519', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '马尔科姆·格拉德威尔 Malcolm T.Gladwell', '1.马尔科姆·格拉德威尔（Malcolm T.Gladwell）1963年9月3日出生于，英裔加拿大人，身兼记者、畅销书作者和演讲家，“加拿大总督功勋奖”获得者。\n\n2.经典著作：\n 《引爆点》 The Tipping Point: How Little Things Make a Big Difference (2000) [122.20]\n 《决断两秒间 眨眼之间》 Blink: The Power of Thinking Without Thinking (2005)\n 《异类:不一样的成功启示录》 Outliers : The Story of Success (2008)\n 《小狗看世界 大开眼界》 What the Dog Saw: And Other Adventures (2009)\n 《逆转》 David and Goliath (2013)', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450082519', '1504023458');
INSERT INTO `users_item` VALUES ('253', '21', '0', '0', '1', '1450082891', '1450082891', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《引爆点》 The Tipping Point: How Little Things Make a Big Difference (2000)', '1.流行三法则：1个别人物法则； 2.附着力因素法则； 3.环境威力法则。 —— 《引爆点》\n\n2.个别人物法则：联系人 Connectors； 内行 Mavens； 推销员 Salesmen。\n\n3.所有人生来都有一种冲动和好奇心，想要了解我们身处的这个纷繁的世界究竟如何在运行，以及我们该如何去理解它，我们同这个世界的关系究竟怎样？普通人的回答，很少能超出几个大脑早已做出的界定：亚当?斯密的“看不见的手”、凯恩斯的“调控”、哈耶克的“自发生成秩序”、*的辩证唯物主义和历史唯物主义、弗洛伊德的心理分析……\n\n4.而变革者则提出解释理解世界的新方法：凯恩斯在对斯密进行修补；弗洛伊德另辟蹊径；毕加索挑战马蒂斯；爱因斯坦修订牛顿为大自然的立法；德鲁克对组织的研究，和他提出的“知识工人”与受雇阶层。\n\n5.一位有新意的变革者，重要的是提出新的理解世界的方法，甚至能够因此而改变人们的生活方式。\n\n6.格拉德威尔的两本书，都是各种学科的结合体，包括了心理学、管理学、社会学等各门学科的理论。\n\n7.正如以赛亚?伯林所说，值得尊敬的知识人是提供理解世界的钥匙的人。格拉德威尔的流行理论，就是一把新钥匙，理解世界的新钥匙。', null, null, 'reading 读书', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450082891', '1504023458');
INSERT INTO `users_item` VALUES ('254', '21', '0', '0', '1', '1450083249', '1450083249', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《决断两秒间 眨眼之间》 Blink: The Power of Thinking Without Thinking (2005)', '1.约翰·戈特曼 SPAFF代码系统 P6\n\n2.薄片分析法 （thin-slicing）\n薄片分析法是快速认知的一个重要的组成部分，指人们通过极少的经验即可理解事物和行为规律的潜意识能力。 P8\n\n3.这样的人有许多，他们把自己想象得比实际更加热情或更加消沉，只有在他们看到自己录像时才会意识到，他们对自己沟通的方式认知是错误的。 P24', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450083249', '1504023458');
INSERT INTO `users_item` VALUES ('255', '21', '0', '0', '1', '1450090658', '1450090658', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《逆转》 David and Goliath (2013)', '1.弱者的策略是艰难的策略。 P15\n2.值得经历的困难理论。 P69\n3.大五人格模型（或称“大五”理论）\n 神经质，外向性，开放性，尽责性，随和性，\n4.发明家和革新者多为混合性格——尤其是后三种性格：开放性、尽责性、随和性（不随和）。\n5.一个拥有好主意却缺乏将主意变成现实的自律和坚持的发明家只能是一个梦想家。 P86\n6.我们所有人都不只会害怕，我们也会因为害怕而害怕，而克服恐惧会让我们产生狂喜的情绪……，我们害怕自己自己会在遭受空袭时变得恐慌。而当空袭真的发生时，我们却会因为风平浪静的环境而感到窃喜，现在我们安全了，之前的担心与害怕与现在的解脱形成了强烈的对比；这种安全感会产生自信，这种自信就是勇气的源泉。 P99\n7.天才儿童无法获得显著成就的原因之一就是他们从父母那里获得了过多心理健康。\n他说“这些失败的孩子“太传统，太因循守旧，太没有想象力，所以他们没能贡献出突破性的思想以影响所处的时代。”\n他接着说“人们通常认为天才儿童大多出现在条件优越的家庭，然而事实上，天才通常都来自一些条件不是太好的家庭。” P107\n8.悉达多·穆克吉 Siddhartha Mukherjee 《众病之王·癌症传》 《The Emperor of All Maladies : A Biography of Cancer》\n8.正确的说法应该是：我们这个社会是否需要经历过某种创伤的人？答案是肯定的。这是一个令人不怎么愉快的事实。有一个人因为灾难而变得更强大，就有无数侥幸脱险的人被他们经历的一切压垮。这要看时间，地点，当然还要看人——我们相信的是那些因自身经历而变得更加坚强的人们。 P124\n\n\n', null, null, 'reading', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450090658', '1504023458');
INSERT INTO `users_item` VALUES ('262', '21', '0', '0', '1', '1450202394', '1450202394', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '袁腾飞 《两宋风云》', '1.百度百科 http://baike.baidu.com/subview/2643492/10951549.htm\n2.视频地址 http://tv.cntv.cn/videoset/C37773\n3.目录\n  第一讲 徽宗即位 \n  第二讲 奸相辅政 \n  第三讲 宦官掌兵 \n  第四讲 风流天子 \n  第五讲 靖康之变 \n  第六讲 康王赵构 \n  第七讲 赵构继统 \n  第八讲 书生抗金 \n  第九讲 逃跑皇帝 \n  第十讲 苗刘兵变 \n  第十一讲 韩五破金\n  第十二讲 将帅失和\n  第十三讲 吴玠守蜀\n  第十四讲 精忠岳飞\n  第十五讲 傀儡刘豫\n  第十六讲 伪齐灭亡\n  第十七讲 中兴四将\n  第十八讲 君臣反目\n  第十九讲 淮西军变\n  第二十讲 宋金谈判\n  第二十一讲 战端再起\n  第二十二讲 顺昌大捷\n  第二十三讲 功亏一篑\n  第二十四讲 死里逃生\n  第二十五讲 岳飞之死 \n  第二十六讲 宋金和议 \n  第二十七讲 奸相秦桧 \n  第二十八讲 金国易主 \n  第二十九讲 宋金再战 \n  第三十讲 高宗禅位', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450202394', '1504023458');
INSERT INTO `users_item` VALUES ('277', '21', '0', '0', '1', '1450330057', '1450330057', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '会计法律之法律责任', '一、法律责任的概述\n    法律责任是指违反法律规定的行为应当承担的法律的后果，也就是对违法者的制裁。\n二、不依法设置会计账本等违法会计行为的法律责任\n 根据《会计法》规定，应承担法律责任的会计违法行为包括：\n1、不依法设置会计账本的行为。\n2、私设会计账本的行为。\n3、未按照规定填制、取的原始凭证或者填制、取的原始凭证不符合规定的行为。\n4、以未经审核的会计凭证为依据登记会计账本或者登记会计账簿不符合规定的行为。\n5、随意变更会计处理方法的行为。\n6、向不同的会计使用者提供的财务报告编制不一致的行为。\n7、未按照规定使用会计记录文字或记账本位币的行为。\n8、未按照规定保管会计资料、致使会计资料损毁、灭失等行为。\n9、未按照规定建立并实施单位内部会计制度，或者拒绝依法实施的监督，或者不如实提供会计资料及有关情况的行为。\n10、任用会计员不符合本法的规定’\n三、违反会计规定应承担的法律责任\n 1、责令期限改正\n2、罚款\n3、给予行政处分\n4、吊销会计从业资格证书\n5、依法追究刑事责任\n四、其他会计违法行为的法律责任\n（一）伪造 变造会计凭证 会计账簿，编制虚假的财务会计报告的法律责任。\n伪造会计凭证的行为，是指以虚假的经济业务或者资金往来为前提，编造虚假的会计凭证行为。变造会计凭证的行为是指采取涂改、挖补以及其他方法改变会计凭证真实的内容的行为。伪造会计账簿的行为是指违法《会计法》和国家统一会计制度的规定，根据伪造或者编造的虚假会计凭证填制会计账簿或不按要求登记会计账簿，或者对内对外采用不同的标准计量方法等手段编造虚假的会计行为。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '41', '0', null, '1450330057', '1504023458');
INSERT INTO `users_item` VALUES ('278', '21', '0', '0', '1', '1450331533', '1450331533', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '第二章 结算法律制度', '第一节 现金结算\n一、现金结算的概念与特点\n现金结算是指在商品交易、劳务供应等经济往来中，直接使用现金进行应收 应付款结算的一种行为。在我国主要适用于单位和个人之间的款项支付以及单位之间的转账结算起点金额以下的零星小额收付。\n二、现金结算的特点\n1、直接便利\n2、不安全性\n3、不易宏观控制和管理\n4、费用较高 \n三、现金结算的渠道\n1、职工工资 津贴\n2、个人劳务报酬\n3、根据国家规定颁发给个人的科学艺术 文化艺术 体育等各项奖金\n4、各种劳务福利费用以及国家规定的对个人的其他支出\n5、向个人收付的农副产品和其他物资的价款\n6、出差人员必须携带的差旅费\n7、结算起点（1000）的零星支出\n8、中国人民银行确定的其他需要的支出\n  上述款项起点为1000元，结算起点的调整由中国人民银行确定，报国务院备案。\n五、现金使用的限额\n 我国 《现金管理暂行条例》规定，开户银行应根据开户单位的实际需要，核定开户单位3-5天的日常所需的库存现金限额。边远地区或交通不便的开户单位其库存现金限额可多于5天，但不超过15天日常零星开支。\n一、现金管理的要求\n1、凡在银行和其他金融开户账户的机关、团体、部队 企业 事业单位和其他单位必须按照规定收支和使用现金，接受开户银行的监督\n2、开户单位之间的经济往来，除按规定使用的现金外，应当通过开户银行进行转账结算。\n3、各级人民银行应当严格履行金融主管的职责，负责对开户银行现金管理情况进行监督和审核。\n4、开户银行依据《条例》和中国人民银行的规定，负责现金管理的具体实施，对开户单位收支 使用现金进行监督管理。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '41', '0', null, '1450331533', '1504023458');
INSERT INTO `users_item` VALUES ('311', '21', '0', '0', '1', '1450409735', '1450409735', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'lotusmartree : smart life management system 智能生活管理系统', '1.system builder : lotusmartree is a bridge for people manage information\n  1.PIMS Personal Information Management System 个人信息管理系统\n  2.PDBS Personal Database System 个人数据库系统\n  3.PFIR Personal Finacial Information Record 个人财务系统\n  4.家庭及企业数据库管理系统\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450409735', '1504023458');
INSERT INTO `users_item` VALUES ('312', '21', '0', '0', '1', '1450411592', '1450411592', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'lotusmartree 产业布局', '1.PIMS Personal Information Management System\n2.lotus OS 莲花操作系统\n3.家庭/企业服务器\n4.智能I/O 智能键盘……\n5.个人信息智能卡 smart card\n  可穿戴设备，可携带信息的移动存储主机\n6.智能家居 与 室内设计\n  可共享的家居设计\n7.智能社区 社区服务（物业与环保）：\n  1.社区医疗服务：社区医院与养老院\n  2.社区养老服务：社区养老院\n  3.废物回收计划：垃圾分类，危害物回收，废电池，usb充电电池（电池标准化）\n8.众创空间：社群服务\n  1.创想家园（创业人计划）\n    1.创业直播间，创业选拔直播平台\n    2.赢得一个月的办公室和食宿\n  2.莲花树咖啡\n  3.莲花树体育健身馆：体育与健康\n9.莲花树大学\n  1.公开课程\n  2.内部推荐制\n  3.信用互联网化（试卷公开化）\n10.莲花树公益\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450411592', '1504023458');
INSERT INTO `users_item` VALUES ('313', '21', '0', '0', '1', '1450412334', '1450412334', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'lotusmartree 想要做什么？ 愿景', '1.建立网络数据系统，塑造虚拟网络的真是人格，构建互联网真实社会，提升自我存在感\n2.想要的两个结果：高效能 & 正向价值\n3.两件事要做：撘平台 & 提供解决方案\n4.建立个人数据库系统，以及个人信用，个人健康系统，一个综合性系统\n5.信息图书馆：由每个人组成的信息图书馆\n6.社群服务\n7.福利系统\n8.信息社交平台\n9.个人管理系统:提高信息质量，即有效性，高效性\n10.个人财务系统', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450412334', '1504023458');
INSERT INTO `users_item` VALUES ('314', '21', '0', '0', '1', '1450413138', '1450413138', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'lotusmartree 为什么可以成功？ （亮点是什么，哪里与众不同？）', '1.信息可定位，可追踪：信息图书馆，信息Id（可追踪，可追责）\n2.社交实现管理：私信代办/日程，日程关注……\n3.即刻工作\n4.信息社交：信息本身具有即时社交属性，信息分类，各得所需，\n5.深化朋友圈：求助，商品，收藏，关注，打赏的朋友圈可见，\n6.信息透明化：权限设置，全体可见，\n7.信息归属于信息发布者，包括所有权，使用权，甚至解释权。（全民专利，全平台公开）\n8.共同创建的社群，\n9.提供管理方法，建立标准和制度。\n\n背景分析：\n1.信息碎片化，数据是被割裂的\n2.没有个人的管理系统\n3.没有专属个人的数据库系统\n4.每个人都在寻找自己的存在感，\n\n1.广告词：塑造自我，为自己代言，做自我的主人。\n2.每个人都要为自己代言，每一个人都会为自己代言，证明自我的价值，为自己负责。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450413138', '1504023458');
INSERT INTO `users_item` VALUES ('315', '21', '0', '0', '1', '1450419193', '1450419193', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PIMS 理论', '1.信息世界函数：F(word) = x * [ (Item + y·Communication) * z·Connection ]\n\n2.PIMS建高楼理论：\n 1.条件1：大丰收年代，无需争夺自然资源的年代\n 2.条件2：移动互联网时代，信息无时差\n 3.每一个人都是完整的市场：既是买家也是卖家，提供服务也享受服务\n 4.商业竞争不是自然资源的竞争，而是争夺人的兴趣和时间\n 5.网络世界没有地域性，也没有边界，人们只需要建造自己的高楼，分享与被分享\n 6.每个人都是有差异的\n 7.兴趣是结成社群的第一要因\n\n3.对于人来说，唯一不能舍弃的东西就是记忆，是一个人的经历。\n 1.记录一个人的人生要有时间维度以及事件维度\n 2.每一个生命的意义在于传承\n 3.高级的人生是独立自由的\n 4.生活本无意义，但需要解释与慰藉\n\n4.为什么要塑造自我人格，能够解决人的两个问题：（解决方案：有一份事业）\n 1.空虚，空洞，无聊\n 2.缺乏存在感\n\n5.社交年代的尊重与自我实现的需求：\n 1.时代的发展到了一个更关注自我的年代，人们摆脱了贫穷，不再为油米柴盐操劳\n 2.更高级的享受是目标：高品质的生活\n 3.追求事业以自我实现是时代的主流风向\n 4.寻找自我的人生意义\n 5.互联网时代，每个人都在一个公开的舞台，是展示给陌生人的舞台\n\n6.以人为本，关注自我\n 1.每个人都是自我为中心的向外部世界辐射能量：分享知识以及资源\n 2.百家之言，去中心化，去权威化的世界，每个人都是世界中心\n 3.社群为主的社交形式\n 4.每个人都有专属于自己的圈子\n \n7.信息爆炸，信息碎片化', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450419193', '1504023458');
INSERT INTO `users_item` VALUES ('316', '21', '0', '0', '1', '1450419249', '1450419249', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PIMS 是什么', '1.信息管理平台\n2.个人数据库管理平台\n3.个人商业平台\n4.个人直播平台\n5.专利平台', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450419249', '1504023458');
INSERT INTO `users_item` VALUES ('317', '21', '0', '0', '1', '1450420093', '1450420093', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PIMS 能提供什么服务', '1.提供一个系统化的信息管理系统：管理与记录\n 1.弱化管理，信息分类 & 社交实现管理，使人专注做事，提高效率（实现无形管理）\n 2.即刻工作，没有延时的交流与管理转换，任何一条信息都可以当做聊天对话框（以信息为主的社交）\n 3.简化操作，尤其简化输入操作\n 4.专注信息分享与人的协作关系\n 5.信息分类：智能化信息管理的过虑机制，解决信息碎片化的信息管理问题\n\n2.个人商业平台，发布商品，发布广告……\n 1.买卖商品，个人店铺\n 2.发布广告\n\n3.提供专利保护的法律支持（专利平台）：\n 1.提供专利申请与保护的法律服务，可以贩售知识与资源\n 2.新的经济模式：打赏经济（赠予系统）\n\n4.互联网金融（信用平台）：借钱\n\n5.信息所有权交给用户，完全属于自己的信息空间，每个人都有唯一身份标识（用户需要认证）\n 1.信息可追踪，使信息拥有可追责性\n 2.习惯一个没有隐私的网络环境\n\n6.将生活，工作，娱乐三位一体的平台\n\n7.个人直播平台', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450420093', '1504023458');
INSERT INTO `users_item` VALUES ('318', '21', '0', '0', '1', '1450420632', '1450420632', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PIMS 内部演说', '1.PIMS 想要成为一个认真与世界对话的窗口和平台\n2.PIMS 建立一个没有陌生人的世界：面向网络的真是名片\n3.PIMS 能够拥有一个完整的外向人格\n\n1.PIMS 专注自我，追随内心，塑造自我，实现自我\n2.PIMS 能够使人们重新塑造自我：关注自我多一点，热爱自我多一点，离梦想实现近一点\n\n1.PIMS 是指向未来的产品\n2.PIMS 充分考虑人的生活方式，借鉴计算机工作原理以及面向对象的程序开发原理的管理系统\n3.PIMS 整合的力量：2007年macworld大会，苹果推出iPhone，惊艳世界\n ipod + phone + internet = iPhone\n4.信息很重要，管理很重要，信息需要管理', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450420632', '1504023458');
INSERT INTO `users_item` VALUES ('319', '21', '0', '0', '1', '1450423318', '1450423318', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'BP Business Plan 商业计划书', '1.项目名字\n2.介绍\n3.项目详细介绍\n4.目标用户（客户）群体\n 目前困扰或需求定位\n5.功能介绍\n6.满足目标用户需求的产品\n 服务模式说明\n7.项目盈利模式说明\n8.项目优势 核心竞争力\n9.市场主要同行或竞争对手概述\n10.团队成员介绍\n11.成史情况\n12.历史支出与收入\n13.未来计划\n14.未来计划支出与收入\n15.资金要用到哪里去\n16.融资需求\n17.投资退出方式', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450423318', '1504023458');
INSERT INTO `users_item` VALUES ('320', '21', '0', '0', '1', '1450423531', '1450423531', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'lotusmartree.BP', '1.三句话说明你的项目\n2.解决了什么问题\n3.如何实现，你的解决方案是？\n4.亮点是什么，优势在哪里\n5.团队介绍\n6.市场调研与竞争对手分析\n7.商业模式&推广\n8.融资需求与退出方式', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450423531', '1504023458');
INSERT INTO `users_item` VALUES ('322', '21', '0', '0', '1', '1450589612', '1450589612', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '出纳工作要细致', '出纳的工作：   \n   一、办理银行存款和现金领取。    \n   二、负责支票、汇票、发票、收据管理。   \n   三、做银行帐和现金帐，并负责保管财务章。    \n   四、负责报销差旅费的工作。     \n    1、员工出差分借支和不可借支，若需要借支就必须填写借支单，然后交总经理审批签名，交由财务审核，确认无误后，     由出纳发款。 \n    2、员工出差回来后，据实填写支付证明单，并在单后面贴上收据或发票，先交由证明人签名，然后给总经理签名，      进行实报实销，再经会计审核后，由出纳给予报销。     \n   五、员工工资的发放。  \n      1、现金收付的，要当面点清金额，并注意票面的真伪、若收到假币予以没收，由责任人负责。   \n      2、现金一经付清，应在原单据上加盖\"现金付讫章\"。 多付或少付金额，由责任人负责。\n      3、附在支付证明单后的原始票据是否有涂改。 若有，问明原因或不予报销。     \n      4、正规发票是否与收据混贴、 若有，应分开贴。  \n      5、支付证明单上填写的项目是否超过3项。若超过，应重填。     \n      6、大、小金额是否相符。 若不相符，应更正重填。     \n      7、报销内容是否属合理的报销。 若不属，应拒绝报销，有特殊原因，应经审批。  \n      8、支付证明单上是否有总经理签字。若无，不予报销。  \n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '41', '0', null, '1450589612', '1504023458');
INSERT INTO `users_item` VALUES ('323', '21', '0', '0', '1', '1450589666', '1450589666', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '寻找投资方', '1.准备内容：\n 1.产品 2.企业规划方案 3.团队 4.PPT演讲稿\n\n2.演讲方案：一个番茄时钟 25分钟 15分钟 + 10分钟\n 1.产品简述 5\'\n 2.产品演示（功能与操作） 5\'\n 3.产品核心以及未来规划 5\'\n 4.提问时间\n\n3.营销理念 准备材料\n 1.产品\n 2.核心团队\n 3.企业规划\n 4.盈利模式\n 5.优势以及行业竞争\n 6.营销方案\n 7.投资方案\n 8.资金用处\n\n4.遇到的挑战和问题：\n 1.推广方案\n 2.避免竞争\n\n ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450589666', '1504023458');
INSERT INTO `users_item` VALUES ('324', '21', '0', '0', '1', '1450591322', '1450591322', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '税收的概念与特征', '一、税收的概念与分类   \n（一）税收概念与分类  \n 1.税收的概念    \n税收是政府为了满足社会公共需要，凭借政治权力，强制、无偿地取得财政收入的一种手段。 \n  2.税收的作用    （1）税收是国家组织财政收入的主要形式。   \n（2）税收是国家调控经济运行的重要手段。   \n（3）税收具有维护国家政权的作用。    \n（4）税收是国际经济交往中维护国家利益的可靠保证。   \n（二）税收的特征（注意多选）   \n 税收具有强制性、无偿性和固定性三个特征。税收三性 \n\n按征税对象分类	流转税	以流转额为课税对象（增值税、消费税、营业税、关税等） 															\n	所得税	以纳税人的所得额为课税对象（企业所得税、个人所得税															\n	财产税	以纳税人所拥有或支配的财产数量或价值为课税对象（房产税、车船税）															\n	资源税	对在我国境内从事资源开发和使用为征税对象的一类税（资源税、土地增值税、 城镇土地使用税等															\n	行为税	以纳税人的某些特定行为为课税对象（印花税、车辆购置税、城市维护建设税、契税、耕地占用税等）															', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450591322', '1504023458');
INSERT INTO `users_item` VALUES ('328', '21', '0', '0', '1', '1450613942', '1450613942', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '每日食谱', '酸辣土豆丝\n青椒土豆丝\n番茄炒蛋\n酸辣白菜\n素炒白菜\n\n板栗烧肉\n红烧肉\n糖醋排骨\n\n鸡蛋饼\n千成饼\n韭菜饼\n煎饼\n\n皮蛋豆腐\n蒜泥黄瓜', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450613942', '1504023458');
INSERT INTO `users_item` VALUES ('351', '21', '0', '0', '1', '1450687634', '1450687634', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PHP Ctype函数', 'http://www.cnblogs.com/wenzichiqingwa/archive/2012/09/05/2671359.html\n1.ctype_alnum(string $text)：//检查是否是字母或数字或字母数字的组合 [A-Za-z0-9]\n2.ctype_alpha(string $text)：check for alphabetic character(s) //检查字符串是否是字母 [A-Za-z]\n3.ctype_cntrl(string $text)：check for control character(s) //是否是控制字符如\\n,\\r,\\t\n4.ctype_digit(strint $text)：check for numeric character(s) //是否是数字表示的字符（0-9）\n\n5.ctype_graph(string $text)：Check for any printable character(s) except space //检查是否有任何可打印字符，除了空格（补）\n6.ctype_lower()：check for lowercase character(s)//检查是否是小写字母\n7.ctype_upper()：check for uppercase character(s)//检查是否是大写字母\n8.ctype_space： check for whitespace character(s)//是否是空白字符\n9.ctype_xdigit： check for character(s) representing a hexadecimal digit//检查是否是十六进制数字\n', null, null, 'coder php', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450687634', '1504023458');
INSERT INTO `users_item` VALUES ('352', '21', '0', '0', '1', '1450709222', '1450709222', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '罗辑思维 139 日本为什么会失败 节选', '最近很火的文章：强大的日本究竟败给了谁？ http://bbs.tiexue.net/post_9531513_1.html\n\n然后就是大打出手。先拿下了中国的北平和天津，剑锋所指，直达山西。等日本人出现在山西的时候，国民政府的高层可就紧张了。蒋介石身边的人都是读过中国历史的。知道山西的战略位置太重要了，一旦失手，党羽日本人就打开了三条南下通道。第一条往西打陕西，然后拿下四川，那中国的战略大后方就没有了，后来的什么重庆抗战就没有了。当年的蒙元打南宋走的就是这条路。那第二条路呢？是从山西过河南，拿下武汉，这等于是给中国拿了一个窝心拳，东西两部分就分开了。这时候再去打南京，就是瓮中捉鳖，当年的宋太祖赵匡胤南下，走的就是这条路。还有第三条路，那就更不费劲了。从山西过太行山，进河北，进山东，然后南下江苏，往南打，这就是清代灭亡南明的这条路。这三条路基本上都很难挡住。\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450709222', '1504023458');
INSERT INTO `users_item` VALUES ('353', '21', '0', '0', '1', '1450714642', '1450714642', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'JS ', 'JavaScript slice() 方法 slice() 方法可从已有的数组中返回选定的元素。\nhttp://www.w3school.com.cn/jsref/jsref_slice_array.asp\n\nJavaScript indexOf() 方法 indexOf() 方法可返回某个指定的字符串值在字符串中首次出现的位置。\nhttp://www.w3school.com.cn/jsref/jsref_indexOf.asp\n\nJavaScript test() 方法 test() 方法用于检测一个字符串是否匹配某个模式.\nhttp://www.w3school.com.cn/jsref/jsref_test_regexp.asp', null, null, 'coder js', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450714642', '1504023458');
INSERT INTO `users_item` VALUES ('362', '48', '9', '0', '0', '1450752363', '1450752363', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '有一个华硕电脑包，基本没用过，', '', 'sinaimg-/90b68290gw1ez88oen64zj21kw16ondw.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1450752363', '1504023458');
INSERT INTO `users_item` VALUES ('363', '48', '9', '0', '0', '1450752565', '1450752565', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '有一个mm的单肩包，背了几年了，', '', 'sinaimg-/90b68290gw1ez88orsmmrj21kw16owyp.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1450752565', '1504023458');
INSERT INTO `users_item` VALUES ('365', '21', '0', '0', '1', '1450755804', '1450755804', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'family 一家人吃饭', '2015.12.20 去吃奥莱烤肉 ￥260\n2016.1.8 去吃酸菜鱼 ￥199', null, null, 'family', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450755804', '1504023458');
INSERT INTO `users_item` VALUES ('381', '48', '2', '0', '0', '1450839479', '1450839479', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '有一个闲置路由器，包邮，', '', 'sinaimg-/90b68290gw1ez9en9m1eej21kw16oak8.jpg', null, '', '40', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1450839479', '1504023458');
INSERT INTO `users_item` VALUES ('386', '21', '0', '0', '1', '1450885166', '1450885166', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '家庭聚餐', '2015.12.23 樱花过生日，在明太鱼吃饭，', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450885166', '1504023458');
INSERT INTO `users_item` VALUES ('387', '21', '0', '0', '1', '1450885212', '1450885212', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '姬鲜鲜', '安徽省 蚌埠市 怀远县 古城乡 张八营街 227号\n1989.10.22 九月二十三 天秤座\n2014.9.28 认识\n2014.10.16 第一次做爱\n2015.3.21\n2015.12.5 去鲜鲜家\n2015.12.6 回上海', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450885212', '1504023458');
INSERT INTO `users_item` VALUES ('388', '21', '0', '0', '1', '1450885237', '1450885237', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '徐莹', '安徽 1989.9.18（农历） 处女座\n抑郁\n鼻炎，咽炎，支气管炎，中耳炎，\n现代 sonata8 沪A PQ508\n宝马X1\n有个弟弟\n\n2015.1.10 认识\n2015.3.11 七宝 烤肉谈\n2015.7.19 七宝 煎饼侠\n2015.11.02 九亭 你好咖啡\n2015.11.24 九亭 胖子肉蟹煲（烤肉没吃成）\n2015.12.08 星中路 丰味港式餐厅\n2016.1.8 和别人约，没避孕，\n2016.1.13 七宝 小辉哥\n2016.2.18 七宝 美人鱼 & 家有好面\n2016.2.29 七宝 青冥宝剑 & 汇宝广场 吃望湘园 & 九亭 你好咖啡\n2016.3.28 七宝 小辉哥 & 疯狂动物城', null, null, 'people', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450885237', '1504023458');
INSERT INTO `users_item` VALUES ('389', '21', '0', '0', '1', '1450885311', '1450885311', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'Lien 崔莲', '桂花 1968.5.3 四月初七 \n李勇军 1966.2.23 二月初四 \n喜欢的品牌：KENO LILY Dior\n2015.5.26 巴黎贝甜 78 买被子 2000', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450885311', '1504023458');
INSERT INTO `users_item` VALUES ('436', '21', '0', '0', '1', '1450983932', '1450983932', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '论中国文化', '1.中国文化的老态龙钟\n2.中国有好的工程师，却很少有成就的科学家\n3.回退机制\n4.老祖宗的东西太好\n5.皇权统治\n6.老树难发新芽\n7.中医是中国文化最重要的体现\n8.虚\n9.玄\n10.故弄玄虚\n11.中国是个缺乏创造力的国度，中国人没有想象力，\n12.虚伪教育\n13.做人做事不脚踏实地，没有专业操守，\n14.职业道德感差，\n15.猜谜\n', null, null, '文化', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450983932', '1504023458');
INSERT INTO `users_item` VALUES ('437', '21', '0', '0', '1', '1450984145', '1450984145', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '奖项', '1.诺贝尔奖 http://baike.baidu.com/view/6170.htm\n诺贝尔奖，是以瑞典著名的化学家、硝化甘油炸药的发明人阿尔弗雷德·贝恩哈德·诺贝尔的部分遗产（3100万瑞典克朗）作为基金在1900年创立的。诺贝尔奖分设物理、化学、生理或医学、文学、和平五个奖项，以基金每年的利息或投资收益授予世界上在这些领域对人类做出重大贡献的人，于1901年首次颁发。诺贝尔奖包括金质奖章、证书和奖金。1968年，瑞典国家银行在成立300周年之际，捐出大额资金给诺贝尔基金，增设“瑞典国家银行纪念诺贝尔经济科学奖”，1969年首次颁发，人们习惯上称这个额外的奖项为诺贝尔经济学奖。\n\n2.图灵奖 http://baike.baidu.com/view/16372.htm\n图灵奖（A.M. Turing Award，又译“杜林奖”），由美国计算机协会（ACM）于1966年设立，又叫“A.M. 图灵奖”，专门奖励那些对计算机事业作出重要贡献的个人。其名称取自计算机科学的先驱、英国科学家艾伦·麦席森·图灵。由于图灵奖对获奖条件要求极高，评奖程序又是极严，一般每年只奖励一名计算机科学家，只有极少数年度有两名合作者或在同一方向作出贡献的科学家共享此奖。因此它是计算机界最负盛名、最崇高的一个奖项，有“计算机界的诺贝尔奖”之称。\n\n3.菲尔兹奖 http://baike.baidu.com/view/6110.htm\n菲尔兹奖（Fields Medal，全名The International Medals for Outstanding Discoveries in Mathematics）是一个在国际数学联盟的国际数学家大会上颁发的奖项。它每四年颁奖一次，颁给二至四名有卓越贡献的年轻数学家。得奖者须在该年元旦前未满四十岁。菲尔兹奖是据加拿大数学家约翰·查尔斯·菲尔兹的要求设立的。被视为数学界的诺贝尔奖(诺贝尔奖未设数学奖)。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1450984145', '1504023458');
INSERT INTO `users_item` VALUES ('441', '21', '0', '0', '1', '1451232526', '1451232526', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '自适应的网页设计', 'http://www.ruanyifeng.com/blog/2012/05/responsive_web_design.html\nhttp://segmentfault.com/q/1010000000305316\nhttp://weizhifeng.net/viewports.html\nhttp://weizhifeng.net/viewports2.html\n', null, null, 'css3', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1451232526', '1504023458');
INSERT INTO `users_item` VALUES ('442', '21', '0', '0', '1', '1451303546', '1451303546', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '人工智能', '1.生命是一个系统，人类生命只是一个复杂的自治系统，\n2.智能机器人是一个类人系统，\n3.逻辑脱离人是否在存在？\n4.人工智能：遗传，适者生存\n5.识别 - 分析 - 求解 -记忆库\n 识别 - 分写 - 求解 - 新问题 - 是非\n6.学习模式：1.经验（外部传授） 2.学习（通过实战开发）\n7.人工智能，就是人在通往神的道路，\n\n7.alphaGo vs 李世乭\n 1.人会判断形势，\n 2.机器如何作解释，\n 3.复杂的神经网络，\n 4.人类智能是一种逻辑，推理逻辑，\n 5.人工智能：大数据+相关性，\n 6.正相关性，\n 7.alphaGo是怎么做到的？\n\n8.最终的人工智能可能只是一团程序方程式以及数据，只要能够有存储记忆，就可以永远的保存下去，\n9.人工智能最后是很多不同的智能体，还是一个终极超级计算机？\n\n10.宇宙规律的本质是数学，在数学模型中，可以有无限的维度，\n11.\n\n\n', null, null, 'AI', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1451303546', '1504023458');
INSERT INTO `users_item` VALUES ('443', '21', '0', '0', '1', '1451306657', '1451306657', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '掌握烹饪法国菜的艺术 - 目录', 'http://article.yeeyan.org/view/124069/104567', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1451306657', '1504023458');
INSERT INTO `users_item` VALUES ('444', '21', '0', '0', '1', '1451368178', '1451368178', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '日历', 'https://www.baidu.com/s?wd=html5%20%E6%BB%9A%E5%8A%A8%E6%97%A5%E5%8E%86\nhttp://www.17sucai.com/pins/tag/1829.html\nhttp://www.topthink.com/topic/7751.html', null, null, '', '0', '0', '0', null, null, null, null, null, '1', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1451368178', '1504023458');
INSERT INTO `users_item` VALUES ('452', '21', '0', '0', '1', '1451843066', '1451843066', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '随记', '“凡著中国古代哲学史者，其对于古人之学说，应具了解之同情，方可下笔。盖古人著书立说，皆有所为而发；故其所处之环境，所受之背景，非完全明了则其学说不易评论。”陈寅恪\n\n斯利姆元帅说日本军队如果它计划得当，而且顺利的时候，他们会像蚂蚁一样的勇敢而残忍，如果他们的计划被打乱，他们变得不顺利的时候，他们就会变得像蚂蚁一样的混乱，这就是日本军队的一个特点。\n斯利姆后来还讲了一句很重要的话，说日本军队其实是真正的怯懦，他们不是勇气上的怯懦，他们是精神上的怯懦，因为他们从来不敢改变计划。\n\n8.不要想改变他人的想法，更不要想控制其他人。', null, null, 'longyun 随记', '0', '0', '0', null, null, null, null, null, '1', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1451843066', '1504023458');
INSERT INTO `users_item` VALUES ('457', '21', '0', '0', '1', '1452242299', '1452242299', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '屏幕分辨率 & 浏览器分辨率', '1.浏览器分辨率是：\ndocument.documentElement.clientWidth\ndocument.documentElement.clientHeight\n\n2.屏幕分辨率是：\nwindow.screen.width\nwindow.screen.height', null, null, 'js jquery', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452242299', '1504023458');
INSERT INTO `users_item` VALUES ('458', '21', '0', '0', '1', '1452497671', '1452497671', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '辕黄之争', '清河王太傅辕固生者，齐人也。以治《诗》，孝景时为博士。与黄生争论景帝前。\n黄生曰：“汤武非受命，乃弒也。”\n辕固生曰：“不然。夫桀纣虐乱，天下之心皆归汤武，汤武与天下之心而诛桀、纣，桀、纣之民不为之使而归汤武，汤武不得已而立，非受命为何？”\n黄生曰：“冠虽敝，必加于首；履虽新，必关于足。何者？上下之分也。今桀纣虽失道，然君上也；汤武虽圣，臣下也。夫主有失行，臣下不能正言匡过以尊天子，反因过而诛之，代立践南面，非弒而何也？”\n辕固生曰：“必若所云，是高帝代秦即天子之位，非邪？”\n于是景帝曰：“食肉不食马肝，不为不知味；言学者无言汤、武受命，不为愚。”遂罢。是后学者莫敢明受命放杀者。\n《史记·儒林列传》', null, null, 'history material', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452497671', '1504023458');
INSERT INTO `users_item` VALUES ('459', '21', '1', '0', '1', '1452610303', '1452610303', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '会计基本理论', '一、会计的概念\n会计是以货币为主要计量单位，反映和监督一个单位经济活动的一种经济管理工作。\n二、会计的基本假设\n会计的基本假设包括会计主体、持续经营、会计分期和货币计量。\n 1、会计主体\n  会计主体是指确认、计量、和报告的空间范围。\n在会计主体的假设下，企业应当对其本身发生的交易事项或事项进行确认、计量、和报告，反映企业本身所从事的各项生产经营活动。\n2、持续经营\n持续经营是指会计主体在可预见的未来，会按照当前的规模和状态继续经营下去，不会破产也不会大规模消减业务。\n三 会计分期\n会计分期是指将一个会计主体持续经营的生产活动人为 的划为若干相等的会计期间，以便分期结算账目和编制财务报告。\n会计分期分为年度 半年度 季度和月度，且均按公历起讫日期确定。半年度 季度和月度称为会计中期。\n由于会计分期，才产生了当期与其他期间的差别，从而形成了权责发生制和收付实现制不同记账的基础， 进而出现了应收、应付、预收、预付、预提、待摊处理方法。\n四、货币计量\n货币计量是指会计主体在会计核算过程中采用货币作为统一的计量单位，记录和核算会计主体的财务状况和经营成果。\n在货币计量的前提下，我国的会计核算应以人民币作为记账本位币，业务收支以外币为主的企业也可以选择某种外币，但向外编制财务报告时应折算人民币反映。\n五、会计记账基础\n一、权责发生制\n权责发生制的定义：权责发生制也称应计制，它是以收入、费用是否发生而不是以款项是否收到或付出为标准来确认收入和费用的一种记账基础。\n权责发生制的两个凡是：\n1、凡是当期以实现的收入和已经发生应当负担的费用，不论款项是否收到都应当作为当期的收入和费用。\n2、凡是不属于当期的收入和费用，及时款项已在当期收付，也不应当作为当期的收入和费用。\n二、收付实现制\n收付实现制是与权责发生制相对应的一种会计记账基础\n收付实现制\n也称现金制或现收现付制，它是以款项的实际收付为标准来确认本期收入和费用的一种方法。\n目前我国的政府与非营利组织会计一般采用收付实现制，事业单位除经营业务采用权责发生制，其他业务也采用收付实现制。\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '41', '0', null, '1452610303', '1504023458');
INSERT INTO `users_item` VALUES ('460', '21', '0', '0', '1', '1452615465', '1452615465', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '金晶', '在一家医药互联网企业工作，\n\n2015.4.25 第一次联系\n2015.5.3 第一次见面 耀华路 咖啡馆\n2015.5.30 来办公室\n2015.10.4 合川路 麻浦屋 ￥160\n2015.10.18 合川路 草屋 ￥182（他付）\n2015.11.8 在办公室见面，金汇路吃烤肉 ￥202\n2015.11.28 在办公室见面 聊大表 \n2016.1.12 耀华路，拿渡干锅 Y143（他付）\n2016.2.21 耀华路，麦当劳\n2016.3.7 耀华路，拿渡干锅 ￥148（他付）\n\n2016.4.8 14:39 微信语音25分钟\n 1.写需求分析\n 2.价格\n 3.李旋风\n\na.打断机制\nb.写给小白用户看的需求分析\n\n2016.4.12 20:46 微信通话50分钟 \n聊需求分析', null, null, 'people', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '41', '0', null, '1452615465', '1504023458');
INSERT INTO `users_item` VALUES ('461', '21', '0', '0', '1', '1452618028', '1452618028', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '2016.1.12', '1.和鲜鲜去九亭医院看眼睛 11:00 - 13:30\n2.看勇士比赛 13:30 - 14:00\n3.和金晶见面 16:30 - 22:30', null, null, 'diary', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452618028', '1504023458');
INSERT INTO `users_item` VALUES ('462', '21', '0', '0', '1', '1452618897', '1452618897', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '读书目录', '历史：\n1.《人类的群星闪耀时》 斯蒂芬·茨威格 [奥地利]\n2.《决战葛底斯堡》 迈克尔·夏拉 [美国]\n\n管理工具：\n1.《时间当做朋友：运用心智获得解放》 李笑来', null, null, '书单 booklist', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452618897', '1504023458');
INSERT INTO `users_item` VALUES ('463', '21', '0', '0', '1', '1452664662', '1452664662', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '决定你生活品质的10个经济学思维 - 张维迎', 'https://shop246191.koudaitong.com/v2/showcase/feature?alias=ujf2o6co&spm=m1452663501369814659810998.autoreply&sf=wx_sm\n1.人的行为是有目的的\n2.只有个体才有能力决策\n3.世上没有免费的午餐\n4.人在边际上做选择\n5.自由交换是互利的\n6.分工是进步的源泉\n7.结果比动机更为重要\n8.自由竞争是件好事情\n9.制度比人强\n10.世界是不确定的，企业家是最重要的', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452664662', '1504023458');
INSERT INTO `users_item` VALUES ('464', '21', '0', '0', '1', '1452667077', '1452667077', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '行程', '2013.1.15 王彦生日还有王媛斐 倪工，钟一涵，王冠&女友\n\n2014.9.6 王彦&俞小兰 倪工，顾琪俊&女友，boss 江haoming，nclong 龙哥，Chuck，周君俊，', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452667077', '1504023458');
INSERT INTO `users_item` VALUES ('465', '21', '0', '0', '1', '1452735626', '1452735626', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '随记', '1.拒绝寂寞最好的方式就是不断地走路，从一个陌生的城市到另一个陌生的城市。\n2.每个人出生时都是原创，悲哀的是，很多人渐渐成了盗版。\n3.所谓浪漫就是帮老婆买菜时顺手带回一朵玫瑰。\n4.对于一个父亲来说，想孩子表达爱意最重要的方式莫过于爱他的妈妈。\n5.我们常和爱的人吵架，却和陌生人讲心里话。\n6.每个人都有一个不为人知的角落，不愿被人揭起的伤疤。\n7.总有些事，我们不愿它发生，却必须接受；总有些东西，我们不想知道，却必须了解；总有些人，我们不能没有，却必须放手。\n8.简单的生活，何尝不是一场华丽的冒险。\n9.喜欢花的人会采花，爱花的人会浇花。\n10.既然做不到相濡以沫，至少要做到守口如瓶。\n11.传奇就是传的离奇，离奇就是离谱的传奇。\n12.如果必须失去，但愿是忧愁；如果必将遗忘，但愿是烦恼。\n13.我并不失望，我也没有受伤，没有生气，我只是有点累了，我厌倦了付出太多回报太少。\n14.你以为你想死，其实，你只是想被别人拯救。\n15.伤害不是伤害对方，而是在对方有所期待时让他失望，在对方脆弱时没有去帮助他。\n16.别人帮你，那是情分，不帮你，那是本分。容不容得下是你的气度，能不能让你容得下是我的本事，人活着给自己看的，不是他人的一句话就能左右自己。\n17.文凭不代表学历，年龄也不代表经历。\n18.放下是指不再期待拥有，最初，我们为什么想要拥有并试图得到，这便是痛苦的根源吧。\n19.看不穿的是你瞳孔若隐若现的目光，猜不透的是你嘴角似有似无的笑靥。\n20.你要对自己说，因为她有缺点，有时做错事，才没有找到更理想的丈夫。', null, null, 'longyun', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452735626', '1504023458');
INSERT INTO `users_item` VALUES ('466', '21', '0', '0', '1', '1452738163', '1452738163', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《2011语录》', '1.中国的战略就像“围棋”，着眼于积蓄潜能争取相对优势；美国的战略就像国际象棋，着眼于对攻厮杀一决高下。 基辛格 P89\n\n2.在今天这个时代，我们大多数的思考是一种抄袭，我们大多数的生活是一种模仿，我们大多数的感情是一种廉价，我们大多数的幸福是一种交换。 朱德庸 《我们都有病》 P117\n\n3.金钱买不到幸福，但确实带来了一种更令人愉悦的痛苦形式。 斯派克·米利根 P121\n\n4.美国动画舍得钱，欧洲动画舍得脑子，中国动画舍得孩子。 P154\n\n5.妈妈，我的压力好大，一分一秒滴答，外面的鸟儿早已飞回家，无论是寒冬还是酷暑，时光一天一天被学习打发，学习的内容难度越来越大，不要让大自然和我没有关系，给我放个假，妈妈妈妈，我的阳历真的好大。 P155\n\n6.看一个城市的好坏，就是看书商的鸟，水中的鱼，野猫野狗过得怎么样，弱势它们都干干净净，从容不迫，对人没有恐惧感，那么这个城市一定是个幸福指标很高的城市。 王晓明 上海大学教授 P161\n\n7.请永远不要怀疑，一小拨有思想，不懈追求目标的公民，可以改变世界，事实上，改变从来就是这样发生的。 玛格丽特·米德 P183\n\n8.若无批评自由，赞美毫无意义。 博马舍 法国18世纪作家 P188\n\n9.人们过去常说每一个文明都有两个祖国：一是自己的国家，另一个是法国。 西蒙·库珀 P189\n\n10.毕加索曾经说过，好的艺术家抄袭，而伟大的艺术家窃取，我并不介意窃取伟大的创意。 P197\n\n11.屈辱是人类感情中最有威力的，雪耻次之。 托马斯·弗里德曼 纽约时报专栏作家 P224\n\n12.幸福如果作为生活的副产品，是很棒的小东西，但把幸福当做目标来追求，只会导致灾难。 巴里·施瓦茨 P227\n\n13.如果你认为这个人有足够的责任心，可以选择政府，选择终身伴侣……，你怎么能说这个人不能为自己的决定负责。 伊姆兰汗（宝莱坞演员，宣布用法律手段推翻禁令，新法律将合法饮酒年龄从21岁提高到25岁。）\n\n13.同样是穿越剧，美国人总是往前穿，中国人总是往后穿。一个想不出历史，一个想不出未来。 P231\n\n14.一切为了生活，生活啥也不为。 P233\n\n15.成人有成人的需要，不能禁止承认的需要。这是一个世俗社会，而非圣人社会。一个宽松有活力的社会，应该允许有普通人的需求，才是自信成熟的文化环境的常态。所谓国庆特殊，包含着对国人的一种贬低。 贾樟柯 P235\n\n\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452738163', '1504023458');
INSERT INTO `users_item` VALUES ('468', '21', '0', '0', '1', '1452785723', '1452785723', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《全球通史》', '1.新世界需要新史学。 P10\n2.物理学家 沃纳·海森伯格(Werner Heisenberg) 总结说：“人类有史以来第一次在世界上只面对自己，而不再有其他任何伙伴和敌人。” P11\n3.在科学革命兴起的17世纪，英国哲学家培根(Francis Bacon)曾提到科学革命的潜力，也警告过它可能带来的危险。\n\n4.20世纪影响世界的是本书：\n 1.《梦的解析》 - 弗洛伊德 [奥地利]\n 2.《全球通史》 - 斯塔夫里阿诺斯 [美]\n 3.《狭义与广义相对论浅说》 - 爱因斯坦 [美]  \n 4.《太阳照样升起》 - 厄内斯特.海明威 [美]  \n 5.《就业、利息和货币通论》 - 约翰·梅纳德·凯恩斯[美]  \n 6.《存在与虚无》 - 让-保尔·萨特 [法]  \n 7.《在路上》 - 杰克·凯鲁亚克\n 8.《寂静的春天》 - 蕾切尔·卡森 [美]  \n 9.《时间简史》 - 史蒂芬·霍金 [英]  \n 10.《未来之路》 - 比尔・盖茨\n\n5.史宾格勒 《西方的没落》 \n汤比因 《历史研究》 \n韦尔斯 《世界史纲》\n麦克尼尔 《西方的兴起——人类共同体的历史》 《世界历史》\n斯塔夫里阿诺斯 《全球通史》\n\n6.英国历史学家巴勒克拉夫：全球史观问题\n 1955年，论文集 《处于变动世界中的史学》\n 1967年，《当代史导论》\n 1978年，《当代史学主要趋势》\n 1978年，《泰晤士历史地图集》\n\n7.斯塔夫里阿诺斯的两卷本《全球通史》(1970,1971)和W.H.麦克尼尔的《世界通史》(1967)，则被巴特克拉夫视为体现了“全球史观”的代表作。\n\n\n', null, null, 'reading history', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1452785723', '1504023458');
INSERT INTO `users_item` VALUES ('473', '21', '0', '0', '1', '1453437416', '1453437416', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'longyun', '1.文明的最终是数字化，就是一串密码，例如DNA双螺旋结构的密码，\n2.共享经济是一个悖论，只不过是多了一种选择，最终会专业化，\n3.让兴趣变成事业，会让你更专注。\n4.从新选择事业，让你的兴趣变成事业，更专注就能更高效。\n5.环境是被扩充的。\n6.有些人提出了一个好问题，给了世界更加有说服力的解释，但却给了人类一个坏的解决方案。\n7.人是精力有限的动物，\n8.人们通过各种制度设计，包括战争的各种事件，不断的试探人性，人们用了上万年的政治改革，战争杀戮反复的试探人性，并且驯服人性。\n9.人到底是怎样的存在。\n10.人类的政治、经济、法律都是人性的外延。\n11.道德乌托邦：不承认本能需求，也不承认人性。\n12.唯物主义一点也不唯物。', null, null, '', '0', '0', '0', null, null, null, null, null, '1', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453437416', '1504023458');
INSERT INTO `users_item` VALUES ('474', '21', '0', '0', '1', '1453439835', '1453439835', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '佛学', 'http://baike.baidu.com/view/188238.htm\n1.有想，无想，非有想，非无想。\n2.三界（梵语：trayo dhātava? ，巴利语：tisso dhātuyo）指众生所居之欲界、色界、无色界。\nhttp://baike.baidu.com/subview/21051/11069643.htm\n3.无色界中，也因修行的深浅而分四种差别即无色界四空天：空无边处天，识无边处天，无所有处天，非想非非想处天。在此非想非非想处天就是天之尽头处了。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453439835', '1504023458');
INSERT INTO `users_item` VALUES ('475', '21', '0', '0', '1', '1453441163', '1453441163', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '余秀华', '1.我最大的成功就是生了一个孩子，但是，孩子你把他生下来之后，首先他是他自己，他，你不能想象他依附着你，或者我以后依附着他，这个想法我从来不这么想，我觉得这个不对。所以说如果人是一个个体，你不能说我依靠任何一个人过自己的生活，那不对，那你没有了自己，那你活着的就不是你自己。\n\n2.首先孩子是独立的，你把他生下来之后，只是因为他通过你这个渠道来到这个世界，然后他就独立成活。和你真的关系已经不是很大。虽然你要养育他，培养他成人，但这样的一种感情，和你的精神，你的生命，它关系已经淡化。所以说，我觉得每个人都应该有自己独立的精神生活。\n\n3.因为我想你写诗的人是什么人都可以写诗，他没有规定说这个农妇你不能写诗，你要饭的你不能写诗吗，因为你写诗的时候就是你的一个状态，它是不需要任何身份，任何标签的。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453441163', '1504023458');
INSERT INTO `users_item` VALUES ('482', '21', '0', '0', '1', '1453451010', '1453451010', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '成为一个好作家', '1.一个好的作者：\n 第一，懂人类的语言；第二，懂民族的语言；第三，懂自己地方的语言。\n\n2.作家的三个等级：1.写出自己；2.写出人群；3.写出人类。\n\n3.好的作家的作品是超越时代的，是让你升华到全人类的高度，换了时代，背景，故事依然符合现实。\n\n4.文学的表达能力 vs 文学的社会性\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453451010', '1504023458');
INSERT INTO `users_item` VALUES ('501', '21', '0', '0', '1', '1453565697', '1453565697', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '诺贝尔经济学奖得主弗里德曼说', '花自己的钱办自己的事，最为经济；\n花自己的钱给别人办事，最有效率；\n花别人的钱为自己办事，最为浪费；\n花别人的钱为别人办事，最不负责任。\n\n1、花自己的钱办自己的事，既讲节约又讲效果； \n2、花自己的钱办别人的事，只讲节约不讲效果； \n3、花别人的钱办自己的事，不讲节约只讲效果； \n4、花别人的钱办别人的事，不讲节约不讲效果。', null, null, '经济', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453565697', '1504023458');
INSERT INTO `users_item` VALUES ('503', '21', '0', '0', '1', '1453884758', '1453884758', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '梁小薇', 'qq:274610808', null, null, 'people', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453884758', '1504023458');
INSERT INTO `users_item` VALUES ('504', '21', '0', '0', '1', '1453915260', '1453915260', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '如何读书', '第一，要实证，尤其读古书，以及翻译的图书，\n第二，研究作者的写作背景以及心理，缘由，\n第三，带有批判精神，不要以为认同，也不要以否定者姿态批判；\n', null, null, 'longyun 准则', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453915260', '1504023458');
INSERT INTO `users_item` VALUES ('505', '21', '0', '0', '1', '1453915411', '1453915411', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '程序设计 —— 如何做好一个程序员', '1.写代码不仅仅让机器看懂，也要让人看懂，勤写注释，\n2.写代码符合一般规范，\n3.自顶向下的设计理念，\n4.一个功能多个程序入口，写入口entrance，通过入口完成功能，\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453915411', '1504023458');
INSERT INTO `users_item` VALUES ('506', '21', '0', '0', '1', '1453915708', '1453915708', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '样式设计 —— 如何做一个好的UI设计师', '1.House & Furniture 房子和家居的设计模式，\n2.house 就是布局，furniture 就是具体实例，\n3.style.选择器\n 1.special : only 1 selector\n 2.same : N same class\n 3.smarty : 1 class N copy', null, null, 'coder', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1453915708', '1504023458');
INSERT INTO `users_item` VALUES ('507', '21', '0', '0', '1', '1454057023', '1454057023', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'setTimeout()', 'setTimeout(\"alert(\'2.2 seconds!\')\",2200)', null, null, 'js jquery', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057023', '1504023458');
INSERT INTO `users_item` VALUES ('508', '21', '0', '0', '1', '1454057074', '1454057074', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 去掉两端空格 $.trim() ', '', null, null, 'js jquery', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057074', '1504023458');
INSERT INTO `users_item` VALUES ('509', '21', '0', '0', '1', '1454057129', '1454057129', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 删除元素', '1.remove(); 删除节点\n2.empty(); 清空内容', null, null, 'coder js jquery', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057129', '1504023458');
INSERT INTO `users_item` VALUES ('510', '21', '0', '0', '1', '1454057205', '1454057205', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 显示与隐藏', '\n$(selector).hide()	隐藏被选元素\n$(selector).show()	显示被选元素\n$(selector).toggle()	切换（在隐藏与显示之间）被选元素 toggle(speed,callback,switch)\n$(selector).slideDown()	向下滑动（显示）被选元素\n$(selector).slideUp()	向上滑动（隐藏）被选元素\n$(selector).slideToggle()	对被选元素切换向上滑动和向下滑动\n$(selector).fadeIn()	淡入被选元素\n$(selector).fadeOut()	淡出被选元素\n$(selector).fadeTo()	把被选元素淡出为给定的不透明度\n$(selector).animate()', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057205', '1504023458');
INSERT INTO `users_item` VALUES ('511', '21', '0', '0', '1', '1454057232', '1454057232', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 焦点函数', '1.focus(); 获得焦点\n2.blur(); 失去焦点', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057232', '1504023458');
INSERT INTO `users_item` VALUES ('512', '21', '0', '0', '1', '1454057257', '1454057257', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 插入节点', '1.A.append(B);\n2.B.appendTo(A);\n3.A.prepend(B);\n4.B.prependTo(A);\n5.A.before(B);\n6.B.inertBefore(A);\n7.A.after(B);\n8.B.isertAfter(A); ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057257', '1504023458');
INSERT INTO `users_item` VALUES ('513', '21', '0', '0', '1', '1454057316', '1454057316', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 自定义函数 animate();', 'animate();\n动画效果：http://wenku.baidu.com/view/a65d9184b9d528ea81c77913.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057316', '1504023458');
INSERT INTO `users_item` VALUES ('514', '21', '0', '0', '1', '1454057343', '1454057343', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 替换', '1.replaceWith()\n使用括号内的内容替换所选择的内容。\n$(\"#div\").replaceWith(\"<div id=\"div2\">div2</div>\");\n使用方法如上，将ID为div的元素替换为ID为div2的DIV元素。\n\n2.replaceAll()\n将选择的内容替换到括号内的选择器。\n$(\"<div>替换后的内容</div>\").replaceAll(\"p\");\n使用方法如上，将所有的p标签替换为选择的DIV标签。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057343', '1504023458');
INSERT INTO `users_item` VALUES ('515', '21', '0', '0', '1', '1454057486', '1454057486', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 高度 & 滚动条', 'js 控制滚动条位置 http://blog.csdn.net/shanghui815/article/details/5816775\nJS控制滚动条的位置：window.scrollTo(x,y);\n\n竖向滚动条置顶(window.scrollTo(0,0);\n竖向滚动条置底 window.scrollTo(0,document.body.scrollHeight)\n\nJS控制TextArea滚动条自动滚动到最下部\ndocument.getElementById(\'textarea\').scrollTop = document.getElementById(\'textarea\').scrollHeight\n\nhttp://yuxisanren.iteye.com/blog/1829494\n\n$(window).height()/width();\n$(document).height();\n$(document).scrollTop();\n$(document.body).height();\n$(document.body).outerHeight(true);\n$(document).scrollTop();\nvar X = $(this).offset().top;\n\njquery 滚动条\nhttp://noraesae.github.io/perfect-scrollbar/\nhttp://www.juerblog.com/blog/128.html\n\njs 窗体滚动条置顶\nwindow.scrollTo(0,0);\n滚动条属性：scrollTop & scrollHeight\n$(window).height();\n$(window).weight();', null, null, 'coder js jquery', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057486', '1504023458');
INSERT INTO `users_item` VALUES ('516', '21', '0', '0', '1', '1454057702', '1454057702', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'js 跳转', 'http://hi.baidu.com/lufan5250156/item/4922554e613676e21e19bc87\n1.在原来的窗体中直接跳转用\nwindow.location.href=\"你所要跳转的页面\";\n2、在新窗体中打开页面用：\nwindow.open(\'你所要跳转的页面\');\nwindow.history.back(-1);返回上一页', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454057702', '1504023458');
INSERT INTO `users_item` VALUES ('517', '21', '0', '0', '1', '1454079894', '1454079894', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'js 字符串转换', '1.parseInt();\n2.parseFloat(); ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454079894', '1504023458');
INSERT INTO `users_item` VALUES ('518', '21', '0', '0', '1', '1454079957', '1454079957', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'js 时间', 'http://www.cnblogs.com/carekee/articles/1678041.html\njs时间转毫秒   Date.parse()\nJS获得时间戳   Math.round(new Date.getTime()/1000)\nJS获得毫秒   getTime()', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454079957', '1504023458');
INSERT INTO `users_item` VALUES ('519', '21', '0', '0', '1', '1454079987', '1454079987', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery addClass()', 'hasClass();\naddClass();\nremoveClass();\n\nremoveAttr();\n\n.is(\".hidden\"); 是否隐藏\n.unbind*(); 取消绑定\n\n.test() 相当于 innerText();\n\nempty();\ndetach();', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454079987', '1504023458');
INSERT INTO `users_item` VALUES ('520', '21', '0', '0', '1', '1454080019', '1454080019', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'js 复制剪贴板', 'http://www.steamdev.com/zclip/#\nhttp://bbs.blueidea.com/thread-3061098-1-1.html\n\n1.clearData(sDataFormat) 删除剪贴板中指定格式的数据。 \n2.getData(sDataFormat) 从剪贴板获取指定格式的数据。 \n3.setData(sDataFormat, sData) 给剪贴板赋予指定格式的数据。返回 true 表示操作成功。 \n\n$(\"#input_theme\").select();\ndocument.execCommand(\"Copy\");', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454080019', '1504023458');
INSERT INTO `users_item` VALUES ('521', '21', '0', '0', '1', '1454084516', '1454084516', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery 上传', 'https://www.baidu.com/s?wd=%E7%B1%BB%E4%BC%BC%E5%BE%AE%E5%8D%9A%20%E5%BC%80%E5%8F%91%20%E4%B8%8A%E4%BC%A0%E5%9B%BE%E7%89%87&rsv_spt=1&rsv_iqid=0xc8add4cb00005862&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&tn=baiduhome_pg&rsv_enter=1&oq=%E7%B1%BB%E4%BC%BC%E5%BE%AE%E5%8D%9A%E4%B8%8A%E4%BC%A0%E5%9B%BE%E7%89%87&rsv_t=987cdIZ0e92Txskqd6tQcrhkb4UYmikHivwyzOtUhGXT6H7t8ajhtDV7ClnHRgC%2F2ZRF&inputT=1337&rsv_sug3=15&rsv_sug1=7&rsv_pq=b3055f320000767a&rsv_sug2=0&rsv_sug4=2143&rsv_sug=1\nhttps://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=1&tn=baidu&wd=jquery%20%E4%B8%8A%E4%BC%A0&oq=php%E6%96%B0%E6%B5%AA%E5%BE%AE%E5%8D%9A%E4%B8%8A%E4%BC%A0%E5%9B%BE%E7%89%87&rsv_pq=cea999f400008d42&rsv_t=118bRaBmskiXWPag5GKrHTC6T7G2XVIppfN0ox9xvSNHM2WNn234ocOFZrQ&rsv_enter=1&rsv_sug3=5&rsv_sug1=4&rsv_sug2=0&inputT=2696&rsv_sug4=2696\nhttp://www.oschina.net/project/tag/356/jquery-file-upload\nhttp://segmentfault.com/search?q=php+%E4%B8%8A%E4%BC%A0+%E6%8F%92%E4%BB%B6\nhttp://segmentfault.com/q/1010000000444683\nhttp://jquery.malsup.com/form/#getting-started\nhttp://blog.163.com/qingshui1bei@yeah/blog/static/124078678201111122109707/', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454084516', '1504023458');
INSERT INTO `users_item` VALUES ('522', '21', '0', '0', '1', '1454084541', '1454084541', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'css3 自适应网页设计', 'https://www.baidu.com/s?wd=css3%20%E8%87%AA%E9%80%82%E5%BA%94%E7%BD%91%E9%A1%B5%E8%AE%BE%E8%AE%A1\nhttp://yusi123.com/2539.html\nhttp://www.divcss5.com/jiqiao/j662.shtml', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454084541', '1504023458');
INSERT INTO `users_item` VALUES ('523', '21', '0', '0', '1', '1454084698', '1454084698', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'jquery uploadify', 'http://www.jqcool.net/jquery-uploadify.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454084698', '1504023458');
INSERT INTO `users_item` VALUES ('524', '21', '0', '0', '1', '1454085019', '1454085019', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PHP.Func', '1.strtolower() 函数把字符串转换为小写。\n\n2.strrpos() 函数查找字符串在另一字符串中最后一次出现的位置。\nhttp://www.w3school.com.cn/php/func_string_strrpos.asp\nstripos() - 查找字符串在另一字符串中第一次出现的位置（不区分大小写）\nstrpos() - 查找字符串在另一字符串中第一次出现的位置（区分大小写）\nstrripos() - 查找字符串在另一字符串中最后一次出现的位置（不区分大小写）\n\n3.strrchr() 函数查找字符串在另一个字符串中最后一次出现的位置，并返回从该位置到字符串结尾的所有字符。\n\n4.字符串乱码 \n$content = iconv(\"GBK\", \"UTF-8\", $content);\nhttp://www.jb51.net/article/14530.htm\n\nphp上传文件中文文件名乱码的解决方法\nhttp://www.jb51.net/article/42660.htm\n\n5.pathinfo() 函数以数组的形式返回文件路径的信息。\nhttp://www.w3school.com.cn/php/func_filesystem_pathinfo.asp\n\n6.explode() 函数把字符串打散为数组\nhttp://www.w3school.com.cn/php/func_string_explode.asp\n\n7.去掉最后一个字符串\nhttp://www.jb51.net/article/26604.htm\n\n8.PHP中获取文件扩展名的N种方法小结\nhttp://www.jb51.net/article/29765.htm\n\n9.php 文件续写函数write_a($url,$content);   文件续写函数；\n\n10.php 重写URL htaccessRewriterule\n\nphp 销毁变量 unset();\n\nisnumeric(); 是否为数字\nexplode(\"-\",$str);\nsubstr($str,位置,截取长度);\nstrlen($str);\nrtrim($str,\",\");\n\n11.php 获得当前目录函数\n1.getswd();\n2.dirname(__File__); \n\n12.php 特殊函数\nphp 特殊字符转义 htmlspecialchars();\nphp 换行，在\\n前加<br> nl2br(); \n\n13php.func 二维数组按照某个键值排序\nhttp://blog.163.com/wangxiaoxia1221@126/blog/static/10768017420124253954505/ ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454085019', '1504023458');
INSERT INTO `users_item` VALUES ('525', '21', '0', '0', '1', '1454085184', '1454085184', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '正则替换', '.replace(/\\n/g,\"<br/>\");\n.replace(/\\n/g,\"<br/>\"); ', null, null, 'coder php js', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454085184', '1504023458');
INSERT INTO `users_item` VALUES ('526', '21', '0', '0', '1', '1454085289', '1454085289', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'php 框架', 'http://www.php100.com/html/it/mobile/2014/0312/6629.html\nhttp://www.chinaz.com/program/2015/0427/401755.shtml', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454085289', '1504023458');
INSERT INTO `users_item` VALUES ('527', '21', '0', '0', '1', '1454085371', '1454085371', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'php flash 上传图片 uploadify', 'https://www.baidu.com/s?ie=UTF-8&wd=uploadify\nhttp://www.pooy.net/uploadify-php.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454085371', '1504023458');
INSERT INTO `users_item` VALUES ('528', '21', '0', '0', '1', '1454085392', '1454085392', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'php include 与 require 的区别', 'include 取时用\nrequire 写在头上，全局使用 ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454085392', '1504023458');
INSERT INTO `users_item` VALUES ('529', '21', '0', '0', '1', '1454085415', '1454085415', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'php 取整函数', '1.floor(); 去掉小数\n2.ceil(); 进一取整\n3.round(); 四舍五入', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454085415', '1504023458');
INSERT INTO `users_item` VALUES ('530', '21', '0', '0', '1', '1454086272', '1454086272', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'php 时间函数', '1.time(); 取当前时间unix时间戳\n2.getDate();\n3.date(str,[timestamp]);\n4.mktime(h,m,s m,d,y);\n5.microtime();\n6.strtotime(str);\n7.date_default_timezone_set(\"PRC\"); \n\n---年---\nY 4 位 1999 or 2003 | y 2 位 99 or 03\nL 是否为闰年 闰年为 1，否则为 0\no ISO-8601 格式年份数字。这和 Y 的值相同，只除了如果 ISO 的星期数（W）属于前一年或下一年，则用那一年。（PHP 5.1.0 新加） Examples: 1999 or 2003\n\n---月---\nm 01 - 12 | n	1 - 12\nt 给定月份所应有的天数	28 - 31\nF 完整的文本格式 January - December\nM 3个字母 Jan - Dec\n\n---日---\nd 01 - 31 | j 1 - 31\nS 每月天数后面的英文后缀，2 个字符	st，nd，rd 或者 th。可以和 j 一起用\nD 3个字母 Mon 到 Sun\nl（L小写） 完整的文本格式 Sunday 到 Saturday\n\nN ISO-8601 格式数字表示的星期中的第几天（PHP 5.1.0 新加）	1（表示星期一）到 7（表示星期天）\nw 星期中的第几天，数字表示 0（表示星期天）到 6（表示星期六）\nz 年份中的第几天 0 到 366\n\n---星期---\nW	ISO-8601 格式年份中的第几周，每周从星期一开始（PHP 4.1.0 新加的）\n例如：42（当年的第 42 周）\n\n---时分秒---\n12 小时格式 g 1 - 12 | h 01 - 12\n24 小时格式 G 0 - 23 | H 00 - 23\ni 分钟数，有前导零的 00 - 59\ns 秒数，有前导零 00 - 59 \n\n---时间---\na	am 或 pm\nA	AM 或 PM\nB	Swatch Internet 标准时	000 到 999', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086272', '1504023458');
INSERT INTO `users_item` VALUES ('531', '21', '0', '0', '1', '1454086334', '1454086334', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '程序员的技巧', '有一根主线，就是运用一套逻辑，保存数据，取得数据，显示数据；\n像一棵树，一根主干，枝叶繁茂……\n每一个功能都写成一个单独的函数里；【散】\n将实现功能函数的过程，集中统一为一个过程函数；【统】\n将底层操作数据库的操作细致的写成函数；【散】', null, null, 'coder', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086334', '1504023458');
INSERT INTO `users_item` VALUES ('532', '21', '0', '0', '1', '1454086398', '1454086398', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'mysql 增删改查', '1.创建表语句：create table if not exists t_name (……)\n2.删除表语句：drop table if exists t_name\n3.修改表字段属性语句：alter table t_name add/modify/change(改名字)/DROP\n\n4.插入字段语句：insert into t_name (……) values (……)\n5.更新表字段语句：update t_name set attr = value\n6.删除语句：delete from t_name ……', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086398', '1504023458');
INSERT INTO `users_item` VALUES ('533', '21', '0', '0', '1', '1454086462', '1454086462', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'mysql 表复制', 'insert into table1 select * from table2\n\nMysql 复制一条数据\n1.从不同的表复制\ninsert into 表1 select * from 表2 where id =1\n \n2.同一张表中复制（无主键）\ninsert into 表1 select * from 表2 where id =1\n \n3.同一张表中复制（有主键）\ninsert into 表1(字段1,字段2,字段3) select 字段1,字段2,字段3 from 表1 where id=1\n\n正序排列最后几条\nSELECT * FROM (select id,name from table order by id desc limit 0,3) as tbl order by tbl.id asc', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086462', '1504023458');
INSERT INTO `users_item` VALUES ('534', '21', '0', '0', '1', '1454086623', '1454086623', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'mysql 正序查询最后的数据', '得到最后5条记录，ASC 排序。\nSELECT * FROM (SELECT * FROM table ORDER BY id DESC LIMIT 5) AS tbl ORDER BY tbl.id', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086623', '1504023458');
INSERT INTO `users_item` VALUES ('535', '21', '0', '0', '1', '1454086666', '1454086666', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'mysql 查询两个表按照某一个相同字段排序', 'select a,b,c ,null d,null e,null b as b2 FROM A \nunion \nselect null a,null b as B2,null c,d,b,e from B\norder by b ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086666', '1504023458');
INSERT INTO `users_item` VALUES ('536', '21', '0', '0', '1', '1454086704', '1454086704', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'sql 排序', 'order by field (id,\'\');\norder by substring_index (\"\",id,1);\norder by find_in_set (id,\"\");', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086704', '1504023458');
INSERT INTO `users_item` VALUES ('537', '21', '0', '0', '1', '1454086729', '1454086729', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'mysql join', 'http://www.cnblogs.com/BeginMan/p/3754322.html\n1.select A.x,A.y from B left join A on A.a = B.b where ……\n\n2.inner join case\ninner join case\nhttp://www.myexception.cn/sql-server/156788.html\n\nINNER JOIN 多个表的情况\nhttp://blog.sina.com.cn/s/blog_532751d90100pw0c.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086729', '1504023458');
INSERT INTO `users_item` VALUES ('538', '21', '0', '0', '1', '1454086787', '1454086787', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'sql insert into', '1.insert into t_a(x,y,z) select x,y,z from t_b\n2.e.g. insert into person1.my_item (time,theme,content,tag) select time,theme,content,tag from longyun.my_item', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086787', '1504023458');
INSERT INTO `users_item` VALUES ('539', '21', '0', '0', '1', '1454086874', '1454086874', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'SQL Case when 的使用方法', 'http://www.cnblogs.com/yazdao/archive/2009/12/09/1620482.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454086874', '1504023458');
INSERT INTO `users_item` VALUES ('540', '21', '0', '0', '1', '1454087134', '1454087134', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'css', '1.下划线 text-decoration : none || underline || blink || overline || line-through\n2.字间距 letter-spacing\n3.cursor:*\nhand是手型\npointer也是手型，这里推荐使用这种，因为这可以在多种浏览器下使用。\ncrosshair是十字型\ntext是移动到文本上的那种效果\nwait是等待的那种效果\ndefault是默认效果\nhelp是问号\ne-resize是向右的箭头\nne-resize是向右上的箭头\nn-resize是向上的箭头\nnw-resize是向左上的箭头\nw-resize是向左的箭头\nsw-resize是左下的箭头\ns-resize是向下的箭头\nse-resize是向右下的箭头 \n\n4.表格 边框 空白 border-collapse\nseparate 默认值。边框会被分开。不会忽略 border-spacing 和 empty-cells 属性。\ncollapse 如果可能，边框会合并为一个单一的边框。会忽略 border-spacing 和 empty-cells 属性。 \n\n5.全透明 background:transparent;', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087134', '1504023458');
INSERT INTO `users_item` VALUES ('541', '21', '0', '0', '1', '1454087255', '1454087255', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'css 技巧', '1.css 截断文字（换行）\nword-wrap:break-word;\nword-break:break-all;\noverflow:hidden; \n\n2.css 文字溢出\ntext-overflow:clip | ellipsis;\nwhite-space:nowrap;\noverflow:hidden;\n1.clip：不显示省略标记\n2.ellipsis：显示省略标记（……） \n\n3.css 自动适应div高度\nmin-height;\noverflow(auto,hidden); \n\n4.css 表格去掉空白\nborder-collapse:collapse;\nborder-spacing:0px;\ncellspacing:0;\ncellpadding:0; \n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087255', '1504023458');
INSERT INTO `users_item` VALUES ('542', '21', '0', '0', '1', '1454087333', '1454087333', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'css', '1.css 透明度（兼容）\nfilter:Alpha(Opacity=30); IE\n-moz-opacity:0.8; FF\nopacity:1; chrome \n\n2.css 阴影\n#box-shadow {\n -moz-box-shadow:5px 5px 5px #999 inset;/* For Firefox3.6+ */\n -webkit-box-shadow:5px 5px 5px #999 inset; /* For Chrome5+, Safari5+ */\n box-shadow:5px 5px 5px #999 inset;/* For Latest Opera */\n}\n#box-shadow：length length length length color\nlength：阴影水平偏移值\nlength：阴影垂直偏移值\nlength：阴影模糊值\nlength：阴影边框\ncolor：阴影颜色 ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087333', '1504023458');
INSERT INTO `users_item` VALUES ('543', '21', '0', '0', '1', '1454087440', '1454087440', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'css3', 'gradient 渐进\nborder-radius 圆角\nopacity 透明度 \n\n1.CSS3 Transform\nhttp://www.w3cplus.com/content/css3-transform/\n\n变形(transform)、转换(transition)和动画(animation)\ntransform主要包括以下几种：旋转rotate、扭曲skew、缩放scale和移动translate以及矩阵变形matrix。\ntransform: rotate | scale | skew | translate |matrix;\n\n2.css3 Filter\nhttp://www.w3cplus.com/css3/ten-effects-with-css3-filter\nCSS3 Filter的十种特效\n\ngrayscale灰度\nsepia褐色（求专业指点翻译）\nsaturate饱和度\nfilter: none | <filter-function > [ <filter-function> ]* \n\nhue-rotate色相旋转\ninvert反色\nopacity透明度\nbrightness亮度\ncontrast对比度\nblur模糊\ndrop-shadow阴影', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087440', '1504023458');
INSERT INTO `users_item` VALUES ('544', '21', '0', '0', '1', '1454087456', '1454087456', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'css IE支持fixed属性', 'top:expression(documentElement.Scrolltop + 0 + \"px\"); ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087456', '1504023458');
INSERT INTO `users_item` VALUES ('545', '21', '0', '0', '1', '1454087484', '1454087484', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'SDK', 'http://open.weibo.com/\nhttp://open.qq.com/', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087484', '1504023458');
INSERT INTO `users_item` VALUES ('546', '21', '0', '0', '1', '1454087734', '1454087734', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '马克思经典著作描述共产主义的的六大基本特征', '1. 社会生产力高度发展,人民生活水平的极大丰富.\n2. 社会成果共同占有全部生产资料,\n3. 实行各尽所能,按需分配的原则、\n4. 彻底消灭阶级差别和重大社会差别.\n5. 全体社会成员具有高度的共产主义觉悟和道德品质.\n6. 国家消亡', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087734', '1504023458');
INSERT INTO `users_item` VALUES ('547', '21', '0', '0', '1', '1454087779', '1454087779', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '男女大不同', '1.女性最爱：包包，闺蜜，小鲜肉\n   1.包包：是标签，是心情；\n   2.闺蜜：是述说对象，是情感交际，以为是情感维系的关系，实际上是这个女人的定位，是关系，是影响力。\n   3.小鲜肉：喜欢的诉求对象，爱意，年轻的肉体，\n\n2.闺蜜，是女人之间另类的关系，是非常有影响力的关系。\n\n3.女性化，被爱，被关注，被呵护。（重相关性）\n男性化，被尊重，（重因果性）\n一言蔽之，满足需求，首先判断“性别”，在提供服务。\n\n4.因果性与相关性\n男性思维：先需求后功能，正向逻辑，重因果性，内在特质；\n女性思维：先喜欢后需求，反向逻辑，重相关性。\n\n5.她经济：美，喜欢，给予她们相关，外在行为，提供服务；\n他经济：需求，给与他们因果，内在特质，创造需求。\n\n6.美甲生意，真正关注自我的美，愉悦，提升自己的女王气质，不想做杂务，不想做家务。\n\n7.（女性）你是不是真的了解自己，了解自己的需求？\n你是不是真的想知道真实的你自己？\n引申：真是的自己是什么样子？\n1.自己以为的自己； 2.他人眼中的自己； 3.一个人时候的自己； 4.极限状态下的自己。\n\n8.东亚女性爱美白，其实是因为他们爱美。\n\n9.男人想要房子，车子，女人，是因为他们渴望拥有身份。\n\n10.女人在男人主导的世界中，地位不断的提升，购买力的提升使市场找到女人市场，在服装，电影，娱乐产业中，女性的购买力占主导地位。\n能够吸引当代女性的东西，就能够占有市场。\n\n11.女人看童话，男人看神话。\n\n12.都说是性别导致差异，其实是情况不同，并没有真正的两性差异。大部分是文化背景不同，我们对待两性的态度产生了两性差异。\n社会期待，文化背景导致两性差异。\n男人需要身份，女人需要爱情。\n\n13.当男人和女人谈恋爱若她涉世未深，就带她看尽人间繁华； 若她心已沧桑，就带她坐旋转木马。\n若他情窦初开，你就宽衣解带；若他阅人无数，你就灶边炉台。\n\n14.男人无论多大，心里永远住着小孩，好奇，争强好胜，无望无穷；\n女人无论多小，心里永远是一个妈妈，喜欢管束，教育别人。', null, null, '课题 两性', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087779', '1504023458');
INSERT INTO `users_item` VALUES ('548', '21', '0', '0', '1', '1454087855', '1454087855', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '不确定性、演化和经济理论', 'https://en.wikipedia.org/wiki/Uncertainty,_Evolution,_and_Economic_Theory\nhttp://wenku.baidu.com/search?word=%B2%BB%C8%B7%B6%A8%D0%D4%A1%A2%BD%F8%BB%AF%BA%CD%BE%AD%BC%C3%C0%ED%C2%DB&lm=0&od=0&fr=top_home\nhttps://www.baidu.com/s?ie=UTF-8&wd=%E4%B8%8D%E7%A1%AE%E5%AE%9A%E6%80%A7%E3%80%81%E8%BF%9B%E5%8C%96%E5%92%8C%E7%BB%8F%E6%B5%8E%E7%90%86%E8%AE%BA\nhttp://blog.sina.com.cn/s/blog_4496de750100wiqb.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087855', '1504023458');
INSERT INTO `users_item` VALUES ('549', '21', '0', '0', '1', '1454087872', '1454087872', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '哈耶克，似乎有知识', 'http://weibo.com/p/230418687da5750102vs3r', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454087872', '1504023458');
INSERT INTO `users_item` VALUES ('550', '21', '0', '0', '1', '1454088022', '1454088022', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '统治哲学与组织管理', '1.统治者的目标假设：稳定而有活力。\n2.生产力源于对回报的期望，前提是个人利益的回报。\n3.拥有生产力就可以解决很多问题，掩盖很多问题。\n4.人性是在不同环境下有不同的彰显。\n5.获得长期稳定的生产力是很难的：\n 1.既得利益会阻碍新生利益；（资源的诅咒，既得利益者不能为了发展未来而舍弃利益）\n 2.长期稳态会使人结党营私；（就是以损害其他人的利益为前提）\n 3.不稳定型社会，即调任制度，会是每体制内人只会追逐私立，政绩，而不能为当地造福，很难被乡里文化所影响，没有乡亲压力；\n\n6.明规则与潜规则。\n 1.问题1 明规则是不是一个完善的规则体系，不完善的规则体系必然存在潜规则；\n 2.问题2 有没有可能有完善的明规则体系；\n\n7.亚文化是少数人的事。\n\n8.以公谋私的特点：\n 1.对组织的依赖性比较强；\n 2.会损害其他人的能动性，积极性；\n 3.\n\n9.道德统治的效果不会很好。', null, null, 'YM sociology 课题', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454088022', '1504023458');
INSERT INTO `users_item` VALUES ('551', '21', '0', '0', '1', '1454088074', '1454088074', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '韩国之行 2015.11.10 - 2015.11.17', '11日 换钱\n12日 去蔚山看四姨\n14日 回首尔 见英怡姐 见大姑、小姑、青花，在小姑在住；\n15日 去免税店买东西 见元春哥，在元春哥家住；\n16日 回桂花姐夫家；\n收 小姑 40W 大姑 20W 元春哥 500\n给 四姨 20W 哈呀 10W', null, null, 'record tour', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454088074', '1504023458');
INSERT INTO `users_item` VALUES ('552', '21', '0', '0', '1', '1454088218', '1454088218', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '时事记录', '1.彭宇案 http://baike.baidu.com/view/1380384.htm\n2.药家鑫 http://baike.baidu.com/view/4800971.htm\n3.小悦悦 http://baike.baidu.com/view/4682882.htm', null, null, '时事', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454088218', '1504023458');
INSERT INTO `users_item` VALUES ('553', '21', '0', '0', '1', '1454179522', '1454179522', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《番茄工作法》', '一、一次只做一件事\n 1.什么让你半途而废？\n 2.在哪些地方读书，更容易让你集中精力？\n 3.你是怎么逃避做无聊琐事？\n 4.通常哪类活动会让你花费的时间超过预期？\n 5.你的时间是否经常被事务型活动填满，即使有更重要的事要办？\n\n二、背景\n 1.在一份耗费脑力的活动上你能专注多久？\n 2.你的私人生活和职业生活的节奏是怎样的？\n 3.对于考验记忆游戏，你能玩好吗？\n 4.你上一次拖延是什么时候？为什么？\n 5.你做决定的时候是凭直觉还是凭意识？如何平衡？\n\n三、方法\n 1.你是否有过一个长长的工作清单并受其害？\n 2.你的精神奖励是什么？\n 3.那种计时器适合你？\n 4.你的工作当中多久休息一次？\n 5.你在什么时间对工作习惯进行反思？\n\n四、中断\n 1.你在工作中经常被哪类中断困扰？\n 2.当有人拿毫不相干的问题烦你的时候，你会怎么做？\n 3.你如何保存灵光一现的新想法？\n 4.你在什么时间设法专心做事？\n 5.你总是能够记得按照承诺答复对方吗？\n\n五、预估\n 1.你通常能按照每天的计划完成工作吗？\n 2.你是否经常修改自己的预期？\n 3.要将你承诺的事情全部完成，你知道需要多久吗？\n 4.你所预估的活动时间，最长要花多久？以天，小时还是分钟计？\n 5.你所预估的活动时间，最短要花多久？以天，小时还是分钟计？\n\n六、应变\n 1.你在哪些事物型工作中使用笔和纸？\n 2.你上班时在哪个时间段打电话和发电子邮件？\n 3.你通常多久休息一次？\n 4.你什么时候会长时间连续专注工作，而不休息？\n 5.你如何在工作中使用索引卡片？\n\n七、团队\n 1.你们开会用多长时间？\n 2.在两个配搭工作期间，你们多久休息一次？\n 3.在团队协同工作期间，你们多久休息一次？\n 4.哪些类型的工作不适合两个配搭完成？\n 5.即使有人没准备好，你们的会议仍然会开始么？\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454179522', '1504023458');
INSERT INTO `users_item` VALUES ('554', '21', '0', '0', '1', '1454340321', '1454340321', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '杂记 - 经济学', '1.经济学有一句话：脱离成本，不提质量。 《45.你怎么知道他该死》', null, null, '杂记', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454340321', '1504023458');
INSERT INTO `users_item` VALUES ('555', '21', '0', '0', '1', '1454340435', '1454340435', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '杂记 - 历史', '1.雾月政变，拿破仑上台，颁布拿破仑法典', null, null, '杂记', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454340435', '1504023458');
INSERT INTO `users_item` VALUES ('556', '21', '0', '0', '1', '1454600507', '1454600507', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《逍遥游：当《庄子》遭遇现实》 —— 熊逸', '目录\n自序：乱世读庄子——从王先谦的两篇序言说起\n第一章 庄子的人和书\n第二章 寓言之书——《庄子》的读法\n第三章 《庄子》关键词之一：逍遥\n第四章 《庄子》关键词之二：齐物\n第五章 《庄子》关键词之三：物化\n第六章 《庄子》关键词之四：无知\n第七章 《庄子》关键词之五：不得已\n后记：像人类学家那样走进历史——谈谈“中国思想地图”系列的写作缘起\n\n共七章，一个自序以及后记，预计一周读完。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1454600507', '1504023458');
INSERT INTO `users_item` VALUES ('560', '21', '0', '0', '1', '1455198410', '1455198410', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '会计基础总结', '2.1会计结算种类：  银行汇票、银行本票、商业汇票（商业承兑汇票、银行承兑汇票）、支票、信用卡、汇兑、委托收款、托付承付、信用证 2.2会计的职能：  会计核算、会计监督 \n\n2.3会计基本六要素：  ①、资产：流动资产、长期投资、固定资产、无形资产、长期待摊费用 ②、负债：流动负债、长期负债  ③、所有者权益：实收资本、资本公积、盈余公积、未分配利润 ④、收入  ⑤、费用：制造费用、期间费用 ⑥、利润  \n\n2.4利润计算公式：  营业利润=主营业务利润+其他业务利润—期间费用  主营业务利润=主营业务收入—主营业务成本—主营业务税金及附加 其他业务利润=其他业务收入—其他业务支出  利润总额=营业利润+投资收益+补贴收入+营业外收入—营业外支出 净利润=利润总额—所得税 \n\n2.5确认收入与费用的两种标准：  权责发生制（应计制）、间界限可分割性、 经济信息可靠性、未来经济利益的可能性、经济信息的相关性、会计确认的审谨性  3.3.2会计计量： \n①、会计计量单位：货币、实物量、劳动量  ②、会计计量基础；历史成本、现行成本、可变价值、现行市价、现值、 公允价值  3.3.3会计报告：  包括——资产负债表、利润表、现金流量表 3.\n3.4会计科目：（总分类科目、明细分类科目） \n3.5会计分录：（简单会计分录、符合会计分录）  原则——有借必有贷、借贷必相等 \n3.3.6试算平衡：（帐户发生额试算平衡法、帐户余额试算平衡法）  依据——资产=负债+所有者权益\n 3.3.7会计凭证：  ①、原始凭证（单据）：         外来原始凭证          自制原始凭证（一次凭证、累计凭证、记帐编制凭证、汇总原始凭证）  ②、记帐凭证          按反映经济业务与货币资金是否有关——收款凭证、付款凭证、转帐凭证          按填制方式不同——复式记帐凭证、单式记帐凭证 \n3.3.8会计帐簿  \n3.3.9会计帐务处理程序  一般企业采用——记帐凭证处理程序  第4章 主要会计科目与会计要素  \n4.1资产类科目  \n4.1.1货币资金——企业可以立即投入流动的资金。包括：现金、银行存款、其他货币资金 \n 4.1.2短期投资——“短期投资”科目期末余额—“短期投资跌价准备”的期末余额 \n 4.1.3应收帐款——“应收帐款”各明细科目期末余额合计—“坏帐准备”的期末余额 \n 4.1.4其它应收款——各明细科目期末借方余额合计—“坏帐准备”科目中计提的坏帐准备期末余额 \n 4.1.5存货——各科目的期末借方余额合计—“存货跌价准备”科目计提的期末余额  \n4.1.6待摊费用——企业已指出，但应由本期和以后各期分别负担且分摊期在1年内（含1年）的各项费用。如：低值易耗品摊销、预付保险费、固定资产修理费   \n 4.1.7长期投资——长期股权和债权投资项目下各科目期末余额合计—“长期投资减值准备“计提的期末余额  \n4.1.8固定资产——使用期限超过1年的硬件；单价在2000以上，使用期限超过2年的不属生产、经营主要设备的物品      “减值准备”的计提（余额计提、差额提取）、计提折旧 \n4.1.9在建工程——各明细科目的期末余额合计—“在建工程减值准备”科目计提的工程减值准备期末余额 \n 4.1.10无形资产——无形资产的摊余价值；      期末借方余额—“无形资产减值准备”中计提的期末余额  \n4.1.11长期待摊费用——企业已支出，但摊销在1年以上（不含1年）的各项费用\n  4.2负债类科目  \n4.2.1短期借款——企业向银行、金融机构借入的期限在1年以下（含1年）的各项借款  \n4.2.2应付帐款——企业因购材料、商品，接受劳务等应付供应单位的款项 \n4.2.3预收帐款——企业按合同规定向购货单位预收的款项 \n 4.2.4应付工资——企业应付职工的工资总额（不属于真正的负债）\n 4.2.5应缴税金 \n 4.2.6预提费用——企业按规定从成本费中预先提取但尚未支付的费用                   \n4.2.7预计负债  \n4.2.8长期借款——企业向银行、金融机构借入的期限在1年以上（不含1年）的各项借款 \n4.3权益类科目  \n4.3.1实收资本（股本）——企业实际收到的投资人拨入的资本金的会计科目 4.3.2资本公积——企业通过各种渠道形成的资本公积（资本（股本）溢价、接受非现金资产准备捐赠、接受现金捐赠、股权投资准备、拨款转入、外币折算差额、其他资本公积）\n 4.3.3盈余公积——企业生产经营活动取得的利益形成的     法定盈余公积=企业净利润的10%；     法定公益金=企业净利润的5%~10%  \n4.3.4未分配利润——企业历年积累的未分配利润（或未弥补亏损）      未分配利润=净利润（税后利润）—弥补亏损—提取的盈余公积—分配的股利\n 4.4收入 \n 4.4.1销售商品的收入（现金折扣、销售折让、销售退回、代销业务、分期收款销售业务）\n 4.4.2提供劳务的收入  \n4.4.3他人使用本企业资产的收入（使用费收入）\n 4.5费用类科目 \n费用确认原则：权责发生制原则、配比原则 \n（生产费用、非生产费用，产品成本，期间费用[管理费用、\n利润总额=营业利润+投资净收益+营业外收支净额+补贴收入', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '41', '0', null, '1455198410', '1504023458');
INSERT INTO `users_item` VALUES ('568', '21', '0', '0', '1', '1455555094', '1455555094', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '每日一语 名人名言', '1.不以结婚为目的恋爱就是耍流氓，仅以结婚为目的恋爱难道是做买卖吗？\n2.能够左右买卖的是政治局势。\n3.悲观主义者通常是对的，乐观主义者通常是错的。但是伟大的转变通常都是由乐观主义者完成的。 —— 托马斯·弗里德曼（1953—） 作家 《世界是平的：21世纪简史）\n4.财富在少数精英手中轮转，他们拥有资本和信息，并通过世袭和联姻保住财富。\n5.罗斯柴尔德：在一起祈祷的家庭将凝聚在一起。\n6.有的人湮没无闻，他们死去，无人知晓，仿佛他们从来没来过这个世界一样。 —— 《便西拉智训》\n7.有些人夸夸其谈，却缺乏知识和见地来阐述一个他们自己并不理解的真理。 —— 纪伯伦 《沙与沫》\n8.要学会在轻淡无形，不给别人施加压力的情况下去爱一个人。很好的爱一个人需要经历漫长的时间，甚至用一生的时间才能办到——保持足够距离，拥有适宜谦卑。 —— 梅·萨藤 《独居日记》\n9.苏格拉底：我知道我不知道。\n10.习惯是人生的伟大指南。——休谟 《人性论\n11.当你付出爱时，不要说“上帝在我心中”，而应说“我在上帝心中”。——纪伯伦 《沙与沫》\n12.钱钟书：大抵学问是荒江野老屋中，二三素心人商量培养之事，朝市之显学，必成俗学。\n13.语言和思想本身令我们既熟悉又陌生，我们往往不假思索地使用它们，如自由、民主和公平，但我们对它们的含义和隐含的假设知识半解，根本不了解它们的出处。——节选《政治思想导读》\n14.维特根斯坦：对于不可言说之物，人们必须以沉默待之。\n15.俾斯麦：政治是可能性的艺术。\n16.霍姆斯大法官：一切行为的性质，应由行为时的环境来确定。\n17.哈耶克：未经设计的情况下生成的秩序，能够大大超越人们自觉追求的计划。\n18.诚然，在不同种类劳动的不同产品相互交换时，通常也对艰难和技巧有些认同，然而，这不是用任何精确尺度来调整的，而是通过市场上的争执和讨价还价来进行的，即根据能满足日常生活的那种商业行为的大致而非精确的计算平衡的。——亚达·斯密 《国富论》\n19.我愿意深深地扎入生活，吮尽生活的骨髓，过得扎实，简单，把一切不属于生活的内容剔除得干净利落，把生活逼到绝处，简单最基本的形式，简单，简单，再简单。《瓦尔登湖》\n20.当我画一个太阳，我希望人们感觉它在以惊人的速度旋转，正在发出骇人的光热巨浪。\n当我画一片麦田，我希望人们感觉到原子正朝着它们最后的成熟和绽放努力。\n当我画一棵苹果树，我希望人们能感觉到苹果里面的果汁正把苹果皮撑开，果核中的种子正在为结出果实奋进。\n当我画一个男人，我就要画出他滔滔的一生。\n—— 凡高\n21.冯唐 ：如果你有一个期望，这个期望长期挥之不去，而且需要别人来满足，这个期望就是妄念。\n22.索罗斯退休感言： “世界经济史是一部基于假象和谎言的连续剧。要获得财富，做法就是认清其假象，投入其中，然后在假象被公众认识之前退出游戏。”\n23.卢梭看中国：我看到世界上人口最多最出名的国家被一群盗匪统治着。我进一步仔细观察这个出色的民族，我发现他们当奴隶，我并不感到惊讶。这个民族一次又一次被征服，总是听天由命，听任盗匪的宰割。我看他们连叹息的勇气都没有。这个民族的人是有学问的，但却是胆怯的，伪善的和有江湖气的。他们话说得多但不说明问题，富有知识而毫无才敢，很会装腔作势而缺乏理想。他们有礼貌，态度殷勤，举动灵活，但却狡猾刁奸，老于世故。他们把一切义务道德看做礼节仪式，却只知道敬礼和鞠躬，而不知道什么是人性。\n24.梵高的弟弟提奥劝告他不要做平庸的艺术家时，梵高答：我只能尽力而为，因为我一点儿也不轻视平庸这个词中包含的朴素意义。如果有人轻视平庸的东西，那他肯定不会比平庸更高明。平凡亦是如此吧。\n25.钱钟书： 俗意味着比合适更过度。\n26.如果你不出去走走，你就会以为这就是全世界。 - <天堂电影院>\n27.一个人如果你不及时按照自己所想的活，那你就总有一天会按照自己所活的方式去想。', null, null, 'longyun mis', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1455555094', '1504023458');
INSERT INTO `users_item` VALUES ('569', '21', '0', '0', '1', '1455600669', '1455600669', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '杂记 - 科学', '1.物理界三个奇迹年：\n 1.1543年 哥白尼\n 2.16666年 牛顿\n 3.1905年 爱因斯坦', null, null, '杂记', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1455600669', '1504023458');
INSERT INTO `users_item` VALUES ('570', '21', '0', '0', '1', '1455819478', '1455819478', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'family 亲戚', '2016.2.18 吃烤鳗鱼 合川路 海花姐姐请客，善花姐姐，国花姐姐及男友，鲜鲜，\n七宝 打保龄球', null, null, 'family', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1455819478', '1504023458');
INSERT INTO `users_item` VALUES ('571', '21', '0', '0', '1', '1455820047', '1455820047', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '阿班', '2015.5.20 第一次见阿班\n2015.6.2 第二次见阿班（和姐夫一起吃饭）\n2015.11.29 介绍邓兴华\n2015.11.30 在vision story 阿班见投资人\n2016.2.17 和阿班在你好咖啡见面，主要是谈加入他的团队，做婚庆摄影师，', null, null, 'people', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1455820047', '1504023458');
INSERT INTO `users_item` VALUES ('590', '21', '0', '0', '1', '1457285833', '1457285833', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '强者哲学 vs 穷人思维', '1.个人自由主义，\n2.为自己的行为（决策、选择）负责，\n3.不会不劳而获，不占小便宜，\n4.对自己的态度：不计较存量，是不是有惯性，路径依赖，资源的诅咒，\n5.对现实的态度：看不惯现实，认为道德沦丧，社会浮躁，向往过去不会有进步，强者哲学不抱怨，\n6.对待未来，强者哲学人一定是认为现在比过去好，未来未到的一定比现在好了，保持一个乐观主义者，\n7.不偷懒，\n8.左派 vs 右派（保守派）', null, null, '课题', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457285833', '1504023458');
INSERT INTO `users_item` VALUES ('591', '21', '0', '0', '1', '1457333397', '1457333397', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '2016.3.7 要义', 'a.有五件事要谈：1.理念，2.功能，3.入口，4.运营，5.推广，\n\n 1.理念：提供更有效的信息，做一个个人信息管理系统，\n 2.功能：信息分类，主打日程信息，社交实现管理，\n 3.入口：app & html5\n 4.运营：发展一些自营的公众号\n 5.推广：需要找到投资，再找到专业的推广团队，\n\n\nb.合作方式：各自拥有的资源\n\n 1.成立新的团队，还是合作，\n 2.如果有可能合作，我们能不能掌控项目，', null, null, '', '0', '0', '0', null, null, null, null, null, '1', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457333397', '1504023458');
INSERT INTO `users_item` VALUES ('592', '21', '0', '0', '1', '1457333487', '1457333487', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《不会说话的爱情》节选 周云蓬', '解开你红肚带，\n撒一床雪花白，\n普天下所有的水，\n都在你眼里荡开，', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457333487', '1504023458');
INSERT INTO `users_item` VALUES ('593', '21', '0', '0', '1', '1457458392', '1457458392', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '高效能人士培养计划', '', null, null, '高效能 effective', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457458392', '1504023458');
INSERT INTO `users_item` VALUES ('594', '21', '0', '0', '1', '1457460297', '1457460297', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '去韩国', '大韩民国驻上海总领事馆\n1.Address : 中国 上海市 长宁区 万山路 60号\n2.Tel : (021) 6295-5000\n\n个人旅行签证准备材料：身份证，社保记录，信用卡六个月记录，在职证明，所属公司的营业执照复印件，\n\n上海中妇旅国际旅行社\n1.地址：徐汇区 中山西路 2281号\n2.电话：5489-3868 or 5489-3805', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457460297', '1504023458');
INSERT INTO `users_item` VALUES ('609', '21', '0', '0', '1', '1457634630', '1457634630', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'people', '高成洙 230921197510020112', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457634630', '1504023458');
INSERT INTO `users_item` VALUES ('610', '21', '0', '0', '1', '1457634811', '1457634811', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '王彦', '2016.3.5 耀华路，他家，吃烧烤，', null, null, 'people', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457634811', '1504023458');
INSERT INTO `users_item` VALUES ('611', '21', '0', '0', '1', '1457635500', '1457635500', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《经济解释》 张五常', '1.个体伦假设：每个人都是独立选择的，无论理性与否。\n2.价值理论 price theory 也称选择理论，choice theory 。\n3.理论被事实推翻的可能性。\n4.P88 公理1，P90 第二基础假设\n5.斯密的名言自然淘汰观；\n6.世界是复杂构成，认识通过简化来理解，并解释世界的；\n 理论是有限分析，真是是多维综合的结果，理论中可能有许多未加入的有限不确定性，有未量化的模糊。\n7.', null, null, 'YW reading economic', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457635500', '1504023458');
INSERT INTO `users_item` VALUES ('612', '21', '0', '0', '1', '1457635549', '1457635549', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《经济学通识》 薛兆丰', '薛兆丰，经济学者，现任北京大学国家发展研究院（前身中国经济研究中心）教授，北京大学法律经济学研究中心联席主任。', null, null, 'YW reading economic', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457635549', '1504023458');
INSERT INTO `users_item` VALUES ('613', '21', '0', '0', '1', '1457718080', '1457718080', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '关于人机围棋大战', '1.围棋的变化确实可能无法穷尽，围棋的最优解可能还没能找得到，\n2.但是在一个有明确规则的棋盘，人类的思维就一定会高于人工智能么，\n3.人类不会对固有的围棋思路存在错误么？\n4.人类最后能够安慰自己的一句可能是，alphaGo不懂棋盘的艺术美，\n5.围棋是一类有明确规则博弈竞技，一个明确的博弈规则就会有一套正解逻辑，在一个无法穷尽的棋盘，也许人工智能更加有优势，\n6.如果，人工智能真的可以超越既有的人类神经元，就一定会像人类一样选择杀戮么？\n7.是什么让人们如此迷恋人类的大脑？\n8.人所擅长的是为人类自己解释，AI的世界，不需要解释，一切都是概率问题，\n9.人为什么可以有围棋这么复杂的博弈，是基于对于图形的判断，\n10.你说人有情绪、情感，机器却没有，我反问一句，情绪情感是什么，再一个，它们是怎么形成的？\n11.逻辑是怎么形成的，简化是逻辑形成的手段。', null, null, '人工智能 ai', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457718080', '1504023458');
INSERT INTO `users_item` VALUES ('614', '21', '0', '0', '1', '1457718913', '1457718913', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '学英语', 'Friendship is love minus sex and plus reason. Love is friendship plus sex minus reason.\n友谊就是无性加理智的一种关系。爱情就是友谊加上性减去理智。\n\nI was not when you were born , You were old when I was born . （君生我未生，我生君已老。）\n\nThe best thing about the worst time of your life is that you get to see the true colors of everyone.\n人生低谷时最好的一点就在于能够认清每个人的本色。', null, null, 'engs', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457718913', '1504023458');
INSERT INTO `users_item` VALUES ('617', '21', '1', '0', '1', '1457868131', '1457868131', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '人机大战 第四战 - 李世石 VS 谷歌AlphaGo。', '真高兴，李世乭能赢！\n李世乭能赢下第四盘真心不易，为李世乭鼓掌喝彩，为李世乭的胜利感到骄傲。\n当看到李世乭笑容绽放的一刻，真的一种想哭的情绪。\n对于这么一场人机大战，一场人工智能的检验大战，抱枕一种对人类智慧的钦佩之意，怀着复杂的情感看了四场直播。\n对于网上种种观点以及各方说法有一个大致了解以后，只想说Google AlphaGo 的胜利才是是属于人类智能的胜利，然后对于李世乭赢得对人类智慧结晶阿尔法围棋第四场比赛的胜利，这是李世乭个人的胜利，是李的又一个高光时刻。\n对于这样一种胜利，我是感动的，惊喜的，甚至是仰望的。\n相比之下，我不想关心围棋的未来是怎样，专业的棋手的尊严荣辱，我想说，我们人类是如何拥有智慧，又如何使用我们人类的智慧才是一个很大的问题。\n\n对于这样一场人机大战，我想问自己几个问题：\n1.围棋是什么？\n2.Google AlphaGo 是怎样战胜李世乭的？\n3.为什么如此复杂围棋，对于人工智能是一个挑战的高峰，而对于人却并没有那么难？\n4.智能是什么？\n5.谁代表人类智慧，李世乭还是Google AlphaGo ？\n6.人类智慧的边疆在哪里？\n\n当我们还在自我安慰的提出，Google AlphaGo 是看不懂围棋的艺术性，是体会不到人的情绪，只是单纯的计算工具的时候，是不是在说，我们人类仅仅剩下艺术性以及情感情绪对于人工智能是有优势的呢？我不喜欢听到这样的说法，人机大战也许是人类对人工智能的竞赛，对于围棋人来讲，也许是一场关于人类智慧的博弈。但我想问一句，围棋可以代表人类的智慧么，再有一个问题，难道人类对围棋的理解全部都是对的么？\n当我们怀着我们人类的情绪去想想人工智能的未来，但我们失去了我们对智能绝对拥有权的时候，我们应该抱着怎样的感情对待呢，脱去高傲的面容以外，我们人类还可以做些什么？\n\n李不代表人类，严格的说也不能代表围棋界，更不代表人类智慧。对于这一场大战结果，我想说这不是人类的胜利，而是李世乭的胜利，扩大一点说是围棋人的胜利。\n（ps 古力的解说很有魅力。）\n\n对于那些欢庆的人们来说，只有Google AlphaGo 完全战胜人类的时候，才是人类智慧的胜利，最重要的因素是，李世乭或者围棋界并不能创造一个更好的人类世界，但是Google AlphaGo 代表的人工智能才会让我们的世界变得更加美好。也许我们会把我们的人工智能带进医学领域，带入无人驾驶，只有当Google AlphaGo真正胜利的那一刻，才是证明人类智慧不仅仅是作为一个生命体的高光表现，不仅仅是对待我们的地球上的其他生物才拥有的优势。而是作为有创造力，有想象力，甚至是可以达到神的级的生物，我们想要创造更加智能的生命体，我们想要探索智慧的奥秘，甚至我们想要了解宇宙存在以及生长的奥秘，这些才是我们作为最高等生物的体现。\n\n今天这场比赛，李世乭的胜利让我们看到了人类的无限可能，让我们看到Google AlphaGo 还没有完全成功。很欣喜作为人类代表的李世乭赢下写进历史的一场比赛，相比较他的十几个世界冠军的头衔，这一场比赛更加被历史所铭记。作为一个围棋人，李世乭可以骄傲的说，他是围棋界的骄傲。\n真高兴可以见证这样一个历史，作为同一种的人类，李世乭是我们的骄傲。\n同时也希望看到人类对于人工智能一次又一次的极限测试，期待Google AlphaGo越来越好，也祝愿我们这个世界会越来越好。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1457868131', '1504023458');
INSERT INTO `users_item` VALUES ('620', '21', '0', '0', '1', '1457971728', '1457971728', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '美文美句', '1.两个人在一起能做最多的事，就是陪伴。我忙我的，你忙你的，有两三个小时的晚间黄金时间，他们都是独享的。但你知道一个空间里有另一个人坐在那儿，你就感到很踏实——这就是所谓的“个人空间”。虽然那两三个小时他们都在自己的世界里，但不同的是，身边伴着另一个人——这就是爱情，最常态的爱情。\n\n2.我愿意深深地扎入生活，吮尽生活的骨髓，过得扎实，简单，把一切不属于生活的内容剔除得干净利落，把生活逼到绝处，简单最基本的形式，简单，简单，再简单。—— 《瓦尔登湖》节选。\n\n3.如能忘掉渴望 岁月长 衣裳薄 —— 林夕 《再见二丁目》\n\n4.两个人相互辉映，光芒胜过夜晚繁星 我为你翻山越岭，却无心看风景 —— 林夕 《爱就一个字》\n\n5.落花有意随流水，流水无心恋落花。\n\n6，执子之手，与子偕老。——《诗经·邶风·击鼓》\n 执子之手，与子共著；执子之手，与子同眠； 执子之手，与子偕老；执子之手，夫复何求？\n 得妻如此/女亦如此/人生如此，夫复何求？', null, null, '美文', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457971728', '1504023458');
INSERT INTO `users_item` VALUES ('621', '21', '0', '0', '1', '1457971894', '1457971894', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '想念的十个瞬间', '[掌纹]\n常常傻傻的相信一切宿命。\n喜欢在无事可做的时候研究掌心的纹路，看那些纠缠的曲线在纤细的手掌里穿插、寻觅，没有来时，没有去路，却始终不肯越过边缘，是不肯离去？还是不忍离去？\n在今夜，将你的心付于掌心，便有了纵横交错的线，从远古细细地划来，织就了我一生的宿命。落一滴泪在你的掌中，便签下了来生的约定。\n握紧那些缠绵的曲线，在乍暖还寒的季节里，那是我唯一的想象。\n\n[花开]　　\n无法拒绝季节的到来，如同无法拒绝你的痕迹潜入爬墙的青藤，浸醉了春天的蓓蕾，开成娇媚的颜色。\n窗外，记忆蘸着恬淡的芬芳，和风一起舞蹈，那个时刻，是一种无瑕的美丽。\n蓝天上，手指划过的痕迹，暖了阳光，暖了眼眸，却湿润了心。\n\n[疼痛]　　\n想要握一把阳光，写成诗句，却找不到入口和方向，任痛楚的感觉深入骨髓，却只能无能为力的让幻想，作一次轻纱妙舞的飞翔。\n把你的名字，一笔一划的写在心上，夜夜牵着月光，凭窗想象，无声叹息。\n终于知道，一种快乐决定一种疼痛。\n\n[声音]\n在无人的时候，感受一切声音，倾诉与被倾诉，寂寞与繁华，湮灭与存在，和风一起，散成只言片语，丝丝入扣，又无迹可求。\n失手打碎了一些笑颜，憔悴成昨日的故事，空气里，到处都是写满诺言的词句，我站在镜前，把诺言叠成你的影子。\n你的声音，轻松地穿透的我的身体，在血液里游走，经过心脏的那一瞬间，层层包裹的心事，渲泻成无法收拾的河，从眼里奔流而出。\n在暗夜里，抱着你的声音，入睡。\n\n[雨滴]\n青鸟不来天也老，人间空恨雨和风。\n一季的相思被春风拉长，终于不胜重负，扑面而落，在心上湿成蓦然回首的丝丝缕缕，湿成了一起走过的点点印记，湿了你的衣角，湿了你的面容。湿成了一生也无法抹去的斑斑苔痕。\n有人说，雨滴是春天的灵魂，如果是这样，我选择做你一生的雨滴。\n\n[颜色]\n穿着暖色调的衣服，渴望留下这一季的色彩，每天都在寻找红尘的颜色，直到把自己变成透明。\n时间无情地冲洗掉旧日的对白，余下的只是燃成灰烬的色彩，一次次地，坠入凡尘。\n一直以为用眼睛就能分辨色彩，孰不知太多的层叠已使我们看不清对方，又或者，那些颜色一直未变，只是心，动了。\n\n[踏青]\n一树柔嫩的枝，承载不动太多的阳光，春风似剪，却总也剪不断穿行的脉络。\n习惯了在独坐的温馨里，看双栖双飞的故事，渴望着，在晨风中与你牵手，沉溺于多情的缱绻。\n逃出了寒冷的包围，穿行在渐行渐远的绿色中，爱如春草疯长，恨亦如春草蔓延，不忍轻踏，终是不忍。\n\n[融化]\n以为加一把锁，就可以锁住情感的流动，呼吸着空气中温情的味道，我的气息无处飘散，只为你蹁跹。\n复苏的记忆，融化在你唇齿间的温柔，融化在你身体的每一个角落。\n在你晶莹的视线里，融化，原来也是一种感动。\n\n[传说]\n很多事情，注定了开始，也注定了结局。\n时光已醒，而流年未醒。当你剥开尘封的心事的时候，注定了，今生，我会为你守候成一种姿式，在水的影子中盈盈而立。\n折一束月光为镜，为自己雕琢一个精致的表情，静静数花开花落，所有的故事，沉陷为凝眸的传说。\n\n[风景]\n一滴雨里的伤痕，在你一饮而尽的刹那，慌乱的心绪，便溢成了满满的包围。\n不要承诺，不要誓言，只要用一杯茶的温度，品茗一生的幸福，\n有一种牵挂，在心底反复缠绕，纠缠成不变的风景，我是你的水，你是我的山\n\n', null, null, '美文', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457971894', '1504023458');
INSERT INTO `users_item` VALUES ('622', '21', '0', '0', '1', '1457971962', '1457971962', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '英语美文', 'Memory is a wonderful thing if you don\'t have to deal with the past.\nThere\'s an Einstein quote I really really like. \nHe said, \"If you don\'t believe in any kind of magic or mystery you\'re basically as good as dead.\"\n<爱在日落黄昏时 Before Sunset>', null, null, '美文 engs', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457971962', '1504023458');
INSERT INTO `users_item` VALUES ('623', '21', '0', '0', '1', '1457972748', '1457972748', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '日子 -- 北岛', '用抽屉锁住自己的秘密\n在喜爱的书上留下批语\n信投进邮箱 默默地站一会儿\n风中打量着行人 毫无顾忌\n留意着霓虹灯闪烁的橱窗\n电话间里投进一枚硬币\n问桥下钓鱼的老头要支香烟\n河上的轮船拉响了空旷的汽笛\n在剧场门口幽暗的穿衣镜前\n透过烟雾凝视着自己\n当窗帘隔绝了星海的喧嚣\n灯下翻开褪色的照片和字迹', null, null, '诗词歌赋', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1457972748', '1504023458');
INSERT INTO `users_item` VALUES ('627', '21', '0', '0', '1', '1458111734', '1458111734', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'MY Girls', '1.夏珊珊 1987.11.4 农历九月十三\n2.胡亮亮 1987\n3.樊经纬 1990.4.16\n4.石慧\n5.张连慧\n6.马明燕 1990.2.9 \n P 130****8766\n7.崔莲 1990.12.23\n8.朴玲娟 1986.2.16 正月初八 属虎\n9.王澄澄 1990.10.2\n10.郑茜\n\n胡杏南 1989.6.12\n何丽 何雨霏 1985.9.4 四川南充\nQ: 934441063 / 398413016 / 1359550445', null, null, 'people', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458111734', '1504023458');
INSERT INTO `users_item` VALUES ('628', '21', '0', '0', '1', '1458115699', '1458115699', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《逆转》 马尔科姆·格拉德维尔', '罗辑思维解读：https://wap.koudaitong.com/v2/showcase/feature?alias=8rrdtmkl\n\n1. 不要害怕冲突。\n那些我们看来有价值的东西，往往产生于不平衡的冲突中，人在渺茫时候做出的反应，往往让事情变得美丽且伟大。\n2. 换个视角理解力量。\n人们对力量的理解通常是错误的，强者身上的那些看似优势的东西，经常会变成劣势。\n3. 优势不一定依赖物质资源。\n有些优势依赖于物质资源，这反而会限制人们做出选择；而另一些优势只有在缺乏物质资源的时候才会产生。\n4. 敢于重新定义规则。\n想“逆转”，就是要做一个不接受常规标准，敢于打破规则，并重新定义规则的人。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458115699', '1504023458');
INSERT INTO `users_item` VALUES ('630', '21', '0', '0', '1', '1458197567', '1458197567', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '人文地理', '1.新奥尔良，法式风情\n2.迈阿密，多层海滩，\n3.奥兰多，迪士尼主题公园，6个园，\n4.最美公路，一号公路，\n5.黄石公园，', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458197567', '1504023458');
INSERT INTO `users_item` VALUES ('633', '21', '0', '0', '1', '1458227640', '1458227640', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '乌合之众', '1.群体不善于推理，却急于采取行动。\n2.群体感，以及个人存在感，\n3.', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458227640', '1504023458');
INSERT INTO `users_item` VALUES ('634', '21', '0', '0', '1', '1458229379', '1458229379', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《时间的朋友 2015》 逻辑思维', '1.社交货币\n2.稀缺性：有价值却没有价格，比如空气，\n3.银行：风险定价\n4.马云：我们集团本质上，是一家扩大数据价值的公司。\n5.马云：和未来潜力相比，云计算和大数据还是个婴儿。\n6.未来已经来临，知识尚未流行。\n7.微信的本质是人在移动物联网世界的ID。\n8.愉快，愤怒，恐惧，所有动物共有的情绪，\n 爱，恨，忧伤，人特有的情感，\n9.古龙：勤奋的男人，爱笑的女人，运气都不会太差。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458229379', '1504023458');
INSERT INTO `users_item` VALUES ('636', '21', '0', '0', '1', '1458237789', '1458237789', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '投资理财', '1.中国股市是一个赌场，想致富，远离股市；\n2.投资渠道，房子，股票，基金，债券，黄金，\n3.年化收益15%是非常好的收益率，\n4.价值投资，\n5.长期投资比短期投机更有收益，\n6.不要让环境影响既定判断，\n7.人民币在贬值，', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458237789', '1504023458');
INSERT INTO `users_item` VALUES ('637', '21', '0', '0', '1', '1458237943', '1458237943', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '购物清单', '1.鞋子：air gordan 18 2K4\n2.包：Jump from paper漫画包 登山包\n3.手表：odm swatch\n4.MP3：shuffle\n5.相机：Canon G1X', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458237943', '1504023458');
INSERT INTO `users_item` VALUES ('642', '21', '0', '0', '1', '1458278806', '1458278806', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《世界为何存在》 [美]吉姆·霍尔特（Jim Holt）', '1.模态逻辑 20世纪 库尔特·哥德尔，索尔·克里普克\n2.本体论证明\n3.圣母大学教授 阿尔文·普兰丁格 《必然性的本质》\n4.莱布尼茨：世界上为什么存在万物而非一无所有？ \n5.马丁·海德格尔 《形而上学导论》\n6.让-保罗·萨特 《存在与虚无》', null, null, 'reading', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458278806', '1504023458');
INSERT INTO `users_item` VALUES ('669', '21', '0', '0', '1', '1458501422', '1458501422', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '李旋风', '小时候叫李国庆\n1992.10.01\n2016.3.19 人民广场 西藏中路 星巴克 还有金晶一起见\n没上大学，做过清洁工，做过游戏代练，自学程序，\n现在是职位，项目组长，\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458501422', '1504023458');
INSERT INTO `users_item` VALUES ('677', '21', '0', '0', '1', '1458611844', '1458611844', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'Y70-70 Touth', '电脑型号 联想 Lenovo Y70-70 Touch 80DU 笔记本电脑  (扫描时间：2016年03月22日)\n操作系统 Windows 10 64位 ( DirectX 12 )\n处理器	英特尔 Core i7-4710HQ @ 2.50GHz 四核\n主板	联想 Y70-70 Touch ( 英特尔 Haswell )\n内存	16 GB ( 三星 DDR3L 1600MHz )\n主硬盘	三星 MZ7TE512HMHP-000L2 ( 512 GB / 固态硬盘 )\n显卡	英特尔 HD Graphics 4600 ( 1 GB / 联想 )\n显示器	LG LGD0469 ( 17.1 英寸  )\n声卡	瑞昱  @ 英特尔 Lynx Point  高保真音频\n网卡	英特尔 Dual Band Wireless AC 3160\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458611844', '1504023458');
INSERT INTO `users_item` VALUES ('678', '21', '0', '0', '1', '1458753991', '1458753991', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '不断更新的系统', '1.软件维护，数据备份\n2.重装系统的流程化\n3.开发环境的搭建\n\n1.LAMP开发环境：Apache + MySQL + PHP \n a.当前：Apache 2.2.9 / MySQL 5.1 / PHP 5.2\n b.目标：Apache 2.4 / MySQL 5.6 / PHP 7\n\n2.杀毒工具：金山毒霸\n3.思维工具：Mindjet MindManager 2016\n4.编辑工具：\n  1.UltraEdit V21.20\n  2.Navicat Life for MySQL\n5.办公软件：Office\n6.日常软件：Chrome Picasa qq 暴风影音 迅雷 搜狗输入法 ', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458753991', '1504023458');
INSERT INTO `users_item` VALUES ('680', '21', '0', '0', '1', '1458793268', '1458793268', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PT 详细参数设置 状态保持ON ', '1.白平衡 - 色温\na.3000K 夜晚，光线偏暖偏黄时，拍出来的照片偏黄，\nb.5500K 默认值，日常白天时用，\nc.6500K 环境偏冷时，拍出来的照片偏黄，\n注：用来调色调的，数值越大效果越越黄，\n\n2.ISO感光度 \nA 视频模式\na.6400 环境特别暗的时候，拍出来亮的效果，但噪点也大，\nb.1600 默认值，\nc.400 环境特别亮的时候，拍出来暗的效果，\nB 拍照模式\na.800 默认值，环境特别暗的时候，拍出来亮的效果，但噪点也大，\nb.400 日常白天时用，\nc.200 环境特别亮的时候，拍出来暗的效果，\n注：用来调亮度的，数值越大效果越亮，噪点也越大，噪点大有会磨砂的感觉，\n\n3.曝光补偿EV值\na.-2.0 \nb.0 默认值\nc.+2.0\n注：用来调亮度的，数值越大效果越亮，在ISO下微调亮度，\n\n4.光圈，数值越大光圈越小，光圈小进光量少，光圈大进光量大但是景深会浅，\n\n5.时间间隔 / 延时拍摄（增加曝光）\n\n长按设置键，启动or关闭WIFI，\n使用遥控器电源键+设置键搜索WIFI，确认键确认匹配，', null, null, '摄影', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458793268', '1504023458');
INSERT INTO `users_item` VALUES ('682', '21', '0', '0', '1', '1458836594', '1458836594', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '思维导图', '知乎：求推荐 iPad 能用的思维导图软件？\nhttps://www.zhihu.com/question/20244590', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458836594', '1504023458');
INSERT INTO `users_item` VALUES ('683', '21', '0', '0', '1', '1458866017', '1458866017', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'Teamwork', 'Teamwork工作流程\n1.判定形势：大概就是评判目前的工作状态以及环境形势，\n2.设定目标：挑选出几个比较关键目标，然后进行讨论，\n3.制定计划：为选定的目标分配时间和资源，\n4.严格执行：这个就是要不断反馈和交流工作进度。\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458866017', '1504023458');
INSERT INTO `users_item` VALUES ('684', '21', '0', '0', '1', '1458872435', '1458872435', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '笔记目录', '1.数学与科学\n2.理论物理与哲学 [122.192]\n3.逻辑哲学和方法论\n4.人性，情感，情绪\n5.形而上哲学与道德\n6.哲学：什么样的社会形态是好的，怎样的条件才可以实现\n\n1.历史：历史年表，人物与事件\n2.历史大事件\n3.战争史\n\n1.政治与统治哲学（政治思想与制度建设）\n2.政治经济学\n3.百家争鸣的中国古代哲学时期（统治哲学）\n4.王朝、帝国、政府与企业，大组织的架构与管理\n5.什么是好的管理：组织管理与个人管理\n6.军事的妙用：组织管理与负和博弈\n\n1.经济学理论与经典著作\n\n1.社会学与社会道德\n2.社会群体——文化共同体\n3.人文地理，生存环境与人类社会 [122.173]\n4.公共教育\n\n1.读书\n2.名言警句\n3.心理学及其应用\n4.学习专业知识：技能裹身\n\n\n1.文学、戏剧、电影\n2.艺术品鉴赏\n\n1.个人理财\n2.强者哲学 [122.155]\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458872435', '1504023458');
INSERT INTO `users_item` VALUES ('686', '21', '0', '0', '1', '1458885525', '1458885525', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '修身', '1.像蟑螂一样活着。\n2.像狗一样活着，像蜗牛一样爬行。\n3.心里装下整个宇宙，把自己当做一粒尘埃。\n2.主角配角都能演，台上台下都自在（当主角当仁不让，当配角为人做嫁衣）。\n3.你之所以平凡是因为你不甘于平凡。\n\n1.一个男人，一定要有一个方向，有了目标就一定要实现，不能想着失败了会怎么样。做事情一定要有破釜沉舟的决心。\n\n3.做事不可率性而为，不能意气用事。\n4.守时。\n5.走路的时候，抬头。\n6.一笔一划的写字，把字写方正。\n7.做人，就是要做一个优秀的人，要有信念，要有情怀，不要做一个贪心而不努力的人。\n8.只要想的足够多，就可以做到任何事情。\n9.做事情要讲究方式，效果以及心情。\n10.对别人真诚，让别人很难读懂你。\n\n1.备胎精神：随叫随到，任劳任怨，默默付出，不求回报，只求女神呵呵一笑。\n\n1.学着讲故事。\n\n1.和家人一起吃饭，散步，聊天。\n2.在家里，只有三个身份，儿子，丈夫和父亲。\n3.肯为家人、女友出头，甚至丢脸。\n。\n6.善于学习别人的成功模式，依靠别人的智慧做事。\n7.不要为失败找借口，但要找到原因。\n9.找一个依靠，寻一个对手。\n10.亲近朋友，了解敌人，把他们当做朋友，接近认识他们，用他们的思维思考问题。\n\n10.赢得他人的尊重和信赖，为自己建立一个印象。\n11.让自己尽快成为行业专家，并了解其他不同行业，学习新知识。\n12.建立一个联系人档案，保持交友弹性。\n13.观察其他人的衣着，记下印象。\n14.记住身边人的性格，习惯以及喜好，用本子记下来。\n15.越老越交不到朋友。\n16.如果想得到其他人的认可，最好用你的成果说话。\n11.不要顶嘴。\n\n17.别人没有请求，不要轻易给别人意见。\n18.当你给别人建议的时候，潜在的是有说话的愿望或者教导他人的冲动，还是就事论事给出你的意见。要讲究，你有没有考虑对方感受，以及对方能否接受和理解。\n\n13.与其你死我活，不如在一起活下去，找到利益共同点，找一个平衡。\n14.逢山开路，遇水架桥，学会投其所好。\n15.小心突然升温的“友情”，保持“不推，不迎，礼尚往来”的态度。\n16.不要当众与人争执，尤其是与亲近的人。\n\n17.让时间验证，用其他人的评价了解一个人。\n18.人是多面的，认识一个人也要多方便观察，不要妄自评价一个人。\n19.在没有更加深入了解时，不要妄加评论，或者褒奖或者批评，先登上三分钟。\n\n18.适时适当地毛遂自荐。\n\n1.事情可能看不懂，但是人可以看懂。\n\n5.时刻要有危机意识\n19.不思不语。\n20.博览，倾听，沉默并深思。\n21.多闻，多见，慎言，慎行。\n22.有些话只能对自己说，放在心底，不要告诉别人。\n\n\n20.尊重每一个生命个体，一视同仁，不能傲慢，不要有偏见。\n21.在人之上，把人当人；在人之下，把自己当人。\n22.把人当人，不必是神，不应是狗；把自己当人，不能做狗，并且心中怀有谦卑，按人的方式活着。\n\n21.一般事情都具有滞后性，所以不要妄加评论，事物的缘由以及评定让历史来书写，让其他人来讲，不要反驳和你不同的观点。\n22.对那些没有抱怨的人们，不要用自己的价值观或者社会普遍价值观评价他们。\n23.乐观的人，知足的人是快乐的，也是真正能够体会生活，明白什么是生存的人们。\n24.\n\n1.不能给予承诺，就不要奢望拥有，也不要试图去拥有。\n1.没有怦然心动，就不要轻易对人产生喜欢和好感。\n8.不打没有把握仗，凡事预先准备，计划得当再去做。\n23.没有准备就不要开始，没有能力就不要承诺。\n24.做事要坚持，不可以虎头蛇尾，也不轻言放弃，不要轻易开始。\n\n23.弱者才会述说和抱怨。\n24.抱怨是一种很好的品质，不要抱怨，更不能埋怨。\n25.当别人抱怨社会不公平的时候，问一下对方，问一下自己，你做过些什么对他人有益的事情。\n\n24.我们总是会看到，听到，想到我们所希望，想要发生的事情，所以要时刻以怀疑的态度看到我们看到、听到、想到的样子，是否与真相保持一致。\n25.不要悲天悯人，生活中太多的事情你没办法决定和改变，更不要用同情的心态安慰自己。\n26.生活已经足够艰难，不必要太在乎其他人的想法。\n27.不要事后才思考说过的话、做过的事产生的后果，要在事前就应该想清楚。\n28.不可以懦弱，更不要叹息。\n29.尊重这个社会，也尊重规则。\n30.\n3.不乱于心，不困于情，不畏将来，不念过往。\n\n1.不要想要改变一个人，尤其在价值观上，最多用自身影响身边人；\n2.不要想对别人令行禁止，除非他是军人，而你是他长官；\n\n1.在没有完全理解他人的意图，不要轻易说出我知道了，我懂了，以免让对方误以为明白了。\n2.人总有成功之时，切忌得意忘形。\n\n1.时刻问自己在做什么，为什么，目标是什么，怎么去做。\n\n1.多用例如美丽的，辛勤的，幸福的，快乐的，悲伤的，艰苦的，这样的形容词来描述一个人的人生，而不单单是成功和失败这样简单的形容词，人生是包含了太多太多形容词的生活，比如美好的。\n\n2.问清楚对方的需求，做两份方案，第一份按照对方的要求做一份，再做一份自己的备案。\n3.送礼，送人情必定要给收礼者足够的面子。\n\n1.历史的角度上看，作品第一，人物第二。\n2.当下的角度，作品、人品一样重要。\n\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458885525', '1504023458');
INSERT INTO `users_item` VALUES ('687', '21', '0', '0', '1', '1458958810', '1458958810', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'Lotusmartree', '1.PIMS 也就是这个网站的名字，指产品设计与程序开发；\n2.Content Operating 网站的内容运营；\n3.BP 设计我们的商业计划书；\n4.Teamwork 我们的工作协作方式； [122.184]\n5.Company Operating 公司运营，这个我们暂时用不到。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458958810', '1504023458');
INSERT INTO `users_item` VALUES ('689', '21', '0', '0', '1', '1458964761', '1458964761', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '研究课题目录', '1.两性：男女大不同 [122.137]\n2.夫妻相处 [122.197]\n3.代际之争 [122.189]\n4.强者哲学 vs 穷人思维 [122.155]', null, null, 'menu 课题', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458964761', '1504023458');
INSERT INTO `users_item` VALUES ('690', '21', '0', '0', '1', '1458965931', '1458965931', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '政治经济学', '1.对于政府，如何提高“公共品”的价格？\nA. 提供更优质的服务，逐步升级，形成分级产品。\n\n2.一般服务标准品需要规模经济，如石油，社区保安，城市警察。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458965931', '1504023458');
INSERT INTO `users_item` VALUES ('691', '21', '0', '0', '1', '1458972071', '1458972071', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '理论物理与哲学', '1.时间的对应面是速度，时间的体现是过程。\n2.有限存在，有限世界才需要平衡。\n3.生命是由内部组织，外部反应的系统。\n4.思想是生命反应的集合，思想是一个生命的内部宇宙，内力影响外力。\n5.当自身存在感消失的时候，恐惧不在，\n6.实物存在与思想存在，思想世界的表征是符号，符号构建智能，理想符号是生命的高阶表现。\n7.所有的存在逻辑都存在与人类的大脑里。\n8.所有结果的必然都有偶然的另一面，所有必然都是偶然的一种可能，所有必然的证明都来自与结果本身。\n9.每一个逻辑都有范围，系统内部自序合理存在。\n10.逻辑关系的适用范围决定逻辑高度。\n11.如果没有思维和想象存在，那么宇宙是否需要造物主，没有人类，是否还存在上帝？\n12.每一个思维逻辑都有原点，每一次抗争都是想要维护远点。\n13.自然选择还是神造，对人类的发展影响几何？\n14.提出伟大的问题和观点本身是伟大的。提出伟大的问题未必能回答这个伟大的问题。\n15.我们假设真理是永恒的事业，真理等待人们去发现，真理也许只能无限接近，而不能达到。\n16.除了真理以外的辩解都是对人类自我的安慰。\n17.人对人的三个问题：\n a.为什么我会思考这些脑中的东西，而不是其他？\n b.世界上的事是命中注定还是所有的一切都是随机选择的结果？\n c.每一样事物的意义是什么？\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458972071', '1504023458');
INSERT INTO `users_item` VALUES ('692', '21', '0', '0', '1', '1458973959', '1458973959', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '怎样的世界是最好的', '1.最好的时代是接近无尽选择，每一个人做选择的动因是内心的喜好，前提不伤害其他人的生命与权力。\n2.道德其实是一种约束。\n3.制度也是约束，官僚制度也是最坏而最实用的制度，为自己的位置负责，却不能为事情负责，是影响生产力的制度。\n4.自由的宽度在于与环境的博弈。\n5.自由需要底层的共识。\n6.真正的自由是包容。\n7.自由就是不受迫。', null, null, '哲学', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458973959', '1504023458');
INSERT INTO `users_item` VALUES ('693', '21', '0', '0', '1', '1458974290', '1458974290', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '腹肌撕裂者', '视频：http://my.tv.sohu.com/us/63275331/59032421.shtml\n图文：http://jingyan.baidu.com/article/63acb44af9a52b61fcc17e86.html\n\n1.In & Outs （屈伸） - 25个 难度：*\n2.Bicycles（自行车踏步）- 正反向各25圈 难度：**\n3.Crunchy Frog （嘎吱嘎吱的青蛙 – 瞎翻译~）- 25个 难度：**\n4.Cross/wideLeg Sit-ups （盘腿/叉腿仰卧起坐）- 25个 难度：***\n5.Fifer Scissors（吹笛人的剪刀。。。）– 25个 难度：****\n6.Hip Rock & Raise （揺臀翘屁股） - 25个 难度：**\n7.PulseUp – Heels to Heaven（脚跟朝天） - 25个 难度：****\n8.V-Up/Roll-Up Combo (V型仰卧起坐-卷腹组合) – 24个（或26个） 难度：*****\n9.Oblique V-Ups（腹斜肌仰卧起坐） – 50个（两边各25个） 难度：***\n10.Leg Climbs（爬腿）- 24个（两边各12个） 难度：** （也可以是****）\n11.Mason Twist（梅森扭转） - 40-50个 难度：***\n12.Recover 休息 ', null, null, '运动 健身', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1458974290', '1504023458');
INSERT INTO `users_item` VALUES ('694', '21', '0', '0', '1', '1459152144', '1459152144', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '	 融资租赁会计处理办法', '', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459152144', '1504023458');
INSERT INTO `users_item` VALUES ('695', '21', '0', '0', '1', '1459160638', '1459160638', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'M 随写', '1.国民性这种东西是如何存在的，我们经历的历史起了决定性的作用，写历史的方式，读历史的方式都会影响当今的国民性。\n\n2.中国历史像麻将，就是一部推倒重来的一部大戏，你方唱罢我登场。\n 历史特性，200年一次的大洗牌。\n\n3、工具是影响人的主要因素，包括我们的思维方式。\n 人们是因为工具的改变，从而发展为思维的改变，生活方式的改变主要在于生产力的形式在改变。\n\n4.社会的进步是形态上的进步。\n 什么时候会进步，会有创新，就是后来者在既有领域无法赶超前者。\n 例如诗被唐人写尽了，才有了宋人写词，后来的元曲，明清小说，都是在形式上有了因为无法赶超的而形成的突破。\n 人类是在技术改进的方向上改变了自己的生活。\n\n5.礼仪，仪式是社会中形成的某一种默契，可以降低许多沟通交流包括做事的成本，但是，一旦时过境迁，有些礼仪会成为高成本的形式，就会被替代。\n\n6.所有的决策，尤其是政策，以及文化决策，成本应该是最重要的因素之一。\n\n7.你的梦想是什么？\n a.不要问你的梦想是什么，问你自己，你为你的梦想做过什么。\n b.抓住生命里那一点有意义的事情，包括财务自由，思想自由。\n\n8.什么是你独有的能力，就是你个人的思维逻辑。\n\n9.反映真实的市场才是好市场。\n 好的市场就是等价交换，货币量反应需求。\n\n10.通用智能技术，AlphaGo 是一个项通用智能技术的一个应用。\n\n11.文明来自于物质的富足。\n 文化不是文明，而是一种习惯，一种乐趣。\n\n12.总是说中国是一个特殊的国度，那么，那一个国家不是特殊的一个呢？\n\n13.角度：1.人情 2.法理 3.哲学 4.结果（如何断尾）\n\n14.中国人在乎精神传承，却轻视物质的传承。\n\n15.评论家都是空谈者，学者都是评论家，政客才能实干。\n 真正要做一件事，要寻找各方冲突的平衡，真正要实干需要一定的能力。\n\n16.我们在为我们创造的系统打工，而系统本身就是生命体。\n 生命体是可持续的系统。\n\n17.政府不应该用道德绑架市场。\n\n1.很多时候，悼念者除了表现出悼念者对死去的人的思念以外，并不其他，对于悼念这类行为，知识一个自我感情的释放与抒发。\n2.很多人认为自己是爱国的，在做慈善，但是他们并非真正了解什么才是真正的爱国、做慈善，有时候只是他们自以为是而已。\n3.无论是为自己跳舞还是为观众跳舞，都是痴迷于舞蹈本身，舞蹈自然会有灵魂，这样身体才可以灵动起来。\n4.人们常因为没有时间，没有足够的资源而不去做一件事情，最简单地来说就是他没有能力去做这件事，剩下所有的理由都是他的借口。\n5.有两类人目光很狭窄，容易成为井底之蛙，一种是真的没有见过世面的人，这很好解释，还有一类人也许是形成了一套自我体系的人，也许是生活半径比较小，甚至是食物链顶端的人们，他们处于一个优越的位置，却可能会忽视其他人的真实生活状态。\n6.到一个城市就要看它的博物馆与公园，走进它的大街小巷，走到人们的日常生活中。\n7.命运这个东西，是在你把所有你能做的都做完了以后才能说的东西。\n8.很多时候，我们以第一眼判断一个人，似乎很准，而且可以通过短时间了解对方的许多信息，包括性情喜好。但是我们却很难在比较短的时间内了解对方的处世态度，思维行为方式，也不可能知道他们的价值观。对于我们来说，重要的是我们试图了解一个人就是全面的认识他，从而让我们的确定性变得更加多一点。\n9.一想到自己想象的那种永恒的爱是不存在的，就觉得很难受。\n10.别无期待，只希望你能回来。\n11.我们放不下的不是对方，而是我们逝去的回忆；\n12.有些人，有些事，刻意地不去想，不去念，希冀着能遗忘；\n13.我知道有一天我会忘记你，我没有期待，没有悲伤，只是知道而已。\n\n1.情不知所起，一往而深。\n如果你问我我喜欢她什么，我会说，最初被她的某一些特质所吸引，也许是那份单纯善良，可爱聪明，喜欢这些特质以及散发出来的气质，就是那种舒服的感觉吸引了我，让自己着迷。然而，一旦由喜欢变成了爱，这一切就都不重要了，有了动心的感觉，然后一切都能接受了，觉得是可爱的，是好的，这就是我所谓的爱了。\n\n2.爱情还在，只是它不在眷顾着你和她。\n\n3.无论男女，只要你离开，即使曾经山盟海誓，一旦你离开，他依然会找到另一个人陪伴，即使情浓不曾忘记。在生活面前，幸福的人生才是人们真正需要的。\n\n4.曾经的朋友，现在却没了曾经的情分，那是因为你们变了，环境变了，心境也就变了。', null, null, 'longyun 随写 M', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459160638', '1504023458');
INSERT INTO `users_item` VALUES ('696', '21', '0', '0', '1', '1459160762', '1459160762', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '诠景', '2016.3.22 晚上第一去青年城\n2016.3.23 去学习相机 14:00 - \n2016.3.25 练习相机 15:00 - 17:00', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459160762', '1504023458');
INSERT INTO `users_item` VALUES ('697', '21', '0', '0', '1', '1459169331', '1459169331', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '夫妻相处', '爱与沟通、财富、性，三个方面至少要有两个方面是和谐的。', null, null, '课题 两性 夫妻', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459169331', '1504023458');
INSERT INTO `users_item` VALUES ('698', '21', '0', '0', '1', '1459169431', '1459169431', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '两性关系', '聪明的男人会给女人安全感：\n1.让她知道她的重要性；\n2.你想要抓紧她；\n3.给她所想要的；\n4.相信她；\n\n聪明的女人会给男人空间：\n1.让他放心；\n2.让他知道你可以在背后支撑他；\n3.能体谅他的忙碌；\n4.能鼓励低落时候的他；\n5.能装傻原谅男人犯的错；\n6.给男人面子；\n\n总结，聪明的人会给予对方想要的事物，而不是自己拥有的，也不是自己认为对方需要的，也不是你想要给对方的东西；', null, null, '课题 两性 关系', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459169431', '1504023458');
INSERT INTO `users_item` VALUES ('709', '21', '0', '0', '1', '1459175427', '1459175427', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'PIMS 目录', 'PIMS 理论 [122.49]\nPIMS 是什么 [122.50]\nPIMS 能提供什么服务 [122.51]\nPIMS 内部演说 [122.52]', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459175427', '1504023458');
INSERT INTO `users_item` VALUES ('710', '21', '0', '0', '1', '1459180378', '1459180378', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '弗里德曼的花钱理论（消费理论）', 'I：花自己的钱为自己办事。\n私人消费基本都属于这种情况，比如花自己的钱去饭馆吃一顿。这个时候无需其他人的监管，绝大多数的人都会尽量地让这笔钱的效用最大化，因为花自己的钱自然不会故意去浪费，其次自己明白自己的需求。\n\nII：花自己钱，为别人办事。\n例如买东西送礼，或者慈善活动。这类消费，因为还是花自己的钱，自然会注意是否浪费；然而由于不一定了解别人的需求（例如接受礼品朋友的爱好，或者慈善活动中受助者的实际需求），花钱的效用难以最大化。\n\nIII：花被人的钱，为自己办事。\n报销就属于这种类型。如果说公司每个月可以报销150元用于买书（实报实销），那么就会发现几乎所有的员工每个月都会买150元左右的书。这类消费的效用则比较可疑，花别人的钱不心疼。员工如果自己买书，则会判断自己是否需要这本书，书的价值和价格是否相符等等；而公司报销的情况，则容易对价格不敏感，同时可能会为了花完150元的限额而买一些永远都不看到书回来。\n\nIV：花别人的钱，为别人办事，这是一个万恶的花钱方式。\n第一，花别人的钱，自然不心疼，没有什么动力去将精打细算，第二，为别人办事，也很难了解他人的真实需求，难以真正达到效果。', null, null, '经济学', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459180378', '1504023458');
INSERT INTO `users_item` VALUES ('711', '21', '0', '0', '1', '1459181186', '1492767790', null, '2', '1', '122', '122', null, null, null, null, null, null, null, null, '马尔科姆·格拉德威尔', '《引爆点：如何引发流行》 The Tipping Point : How Little Things Make a Big Difference 2000 [122.202]\n《眨眼之间：不假思索的决断力》 Blink : The Power of Thinking Without Thinking 2005 [122.203]\n《异类：不一样的成功启示录》 Outliers : The Story of Success 2008 [122.204]\n《大开眼界：用另一双眼睛看透这疯狂世界、奇妙生活和美丽人生》 What the Dog Saw : And Other Adventures 2009 [122.205]\n《逆转：弱者如何找到优势，反败为胜？》 David and Goliath : Underdogs, Misfits, and the Art of Battling Giants 2013 [122.206]', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459181186', '1504023458');
INSERT INTO `users_item` VALUES ('717', '21', '0', '0', '1', '1459183260', '1459183260', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '《时间管理：如何充分利用你的24小时》 —— 吉姆·兰德尔', '时间日志\n回忆每一天的时间点，记下日记是一个好习惯，\n上面是今日行程，下面是心得，\n时间管理是一个自我意识，\n时间是转瞬即逝的资产，\n目标是成功的催化剂，\n每周时间目标，设定一个目标，标记完成时间，以及百分比进度条，\n记录锚点，添加进度，\n每周生活，月与季度目标，一年总结，\n周对比，年对比，\n你不喜欢的做的事情，其他人也不喜欢，但是成功人士回去做，\n选择是一个难点，\n\n设定目标，一周目标读书会，\n\n时间管理不能提高效率，只有在精力旺盛时做事才最有效率，\n所以把最棘手的事情留在精力最好的时候，\n当一个人专注时，他的行动效率最高，\n每个人都有不能专注的理由，运动员与之对应的是体能下降，一个办公室职员对应的是事务管理的混乱，\n\n\n运用好空隙可以提高效率，\n填字游戏可以开发你的大脑，\n\n一天能够专注工作8小时，是非常了不起的，\n忙碌不过是一个避难所，\n\n\n如何制定计划，\n将你要做的事情逐条记录下，然后写下你想要完成的时间，将时间相加看一周是不是168小时，\n然后平衡你的时间，并标记优先级，\n优先级1，象限，重要而紧急，重要而不紧急，紧急而不重要，不重要不紧急，\n优先级2，ABC 按照你的意愿，\n\n一个较长时间的事物标记进度条，\n一次只做一件事，', null, null, 'reading manage LT 个人管理 修身 ST', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459183260', '1504023458');
INSERT INTO `users_item` VALUES ('721', '21', '0', '0', '1', '1459226408', '1459226408', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '营销——怪诞行为学', '1.世人不怕得不到，但怕失去既有的。\n2.让你的营销产品对于用户有损失感因素，方可事半功倍。\n3.我们提供了一个让你变得更聪明，更高效的系统，请不要选择无视。', null, null, 'skill', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459226408', '1504023458');
INSERT INTO `users_item` VALUES ('736', '21', '0', '0', '1', '1459403236', '1459403236', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '莲花树团队', '2016.3.19 人民广场 西藏中路 星巴克 金晶 李旋风 聊 LOTUS\n2016.3.30 人民广场 KFC 金晶 李旋风 聊 LOTUS', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459403236', '1504023458');
INSERT INTO `users_item` VALUES ('738', '21', '0', '0', '1', '1459409064', '1459409064', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '下载 Download', 'http://www.rmdown.com/link.php?hash=\nmagnet:?xt=urn:btih:\nhttp://torrentproject.se', null, null, 'down', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459409064', '1504023458');
INSERT INTO `users_item` VALUES ('743', '21', '0', '0', '1', '1459445074', '1459445074', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'longyun\' 印象管理', '1.不要对他人的外貌，衣着品头论足。\n2.不要对他人的第一印象下定义或评论。\n3.不在一个人面前评价或评论另一个人，更不能传播其他人的言论。\n4.不要在公共或者公开场合谈论政治。\n5.不要在公共或者公开场合与人争论，切忌争强好胜。\n6.说话前先准备好内容，使用说话技巧，说三分让对方明白七分。\n7.不要把自己的想法或者意愿说给其他人听（家人除外）。\n8.不同家人一起喝酒。\n9.任何时候，也不夸夸其谈。\n10.尊重对方的思想以及行为，不要打断对方的说话。\n\n1.完成一个创业者的形象的构建。', null, null, 'CST', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459445074', '1504023458');
INSERT INTO `users_item` VALUES ('745', '21', '0', '0', '1', '1459450797', '1459450797', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'longyun\' 人生愿望 2014.6.18', '目标1 2014年6、7、8 学车\n目标2 2014年6月31日 lovelotus 初版\n目标3 2015年5月 骑自行车去北京\n目标4 2017年2月 new zealand working holiday', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459450797', '1504023458');
INSERT INTO `users_item` VALUES ('751', '21', '0', '0', '1', '1459765900', '1459765900', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '德鲁克的经典五问', '1.我是谁？什么是我的优势？我的价值观是什么？\n2.我在哪里工作？我属于谁？是决策者、参与者还是执行者？\n3.我应做什么？我如何工作？会有什么贡献？\n4.我在人际关系上承担什么责任？\n5.我的后半生的目标和计划是什么？', null, null, '个人管理 skill', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1459765900', '1504023458');
INSERT INTO `users_item` VALUES ('752', '21', '0', '0', '1', '1459766142', '1459766142', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '做品牌要懂营销', '1.做营销必须熟悉三门学科：心理学、行为学、传播学；\n2.网络营销就是帮助消费者进行自我心理说服；\n3.危机公关五要素:抢时间、给事实、给态度、给服务、给答案； \n4.被记忆是一个品牌最需要做到的；\n5.消费者都是“我要”,你只需要解决他的“我怕”, 即可打消顾虑,完成交易。', null, null, '营销 skill', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459766142', '1504023458');
INSERT INTO `users_item` VALUES ('753', '21', '0', '0', '1', '1459766421', '1459766421', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '财富智商 Financial IQ', '1.市场，讲供求关系的学科；\n2.投资，钱生钱的艺术；\n3.会计，财务知识；\n4.法律，进与退的标志线；\n5.管理，运营的机器。\n\nE:Employee 雇员\nS:Self-employee 自由职业者\nB:Business owner 企业所有人\nI:Investor 投资人', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1459766421', '1504023458');
INSERT INTO `users_item` VALUES ('761', '21', '0', '0', '1', '1460013423', '1460013423', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '黑社会的性质', '1.处处都有黑社会化的形态\n2.痰盂\n3.中国特色维稳\n4.医闹组织化\n5.私行\n6.暴力行为', null, null, '课题', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1460013423', '1504023458');
INSERT INTO `users_item` VALUES ('766', '21', '0', '0', '1', '1460024993', '1460024993', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '论教育', '1.这个社会不缺乏机器，也不缺少idea，缺少的是润滑剂，有效管理和平台，包括有效沟通及执行。\n2.教条主义以及强制性并不能开发创造力。\n3.上一辈的价值观和道德观不应该夹杂在教导的知识体系中，仅作为参考。\n4.开心的童年有利于社会发展。\n5.改革不可急功近利，也不该功效化，应潜移默化。\n\n一个人很难成功，尤其是天赋一般的人，让自己督促甚至鞭策自己是一件很难的事情，所以，有一个伙伴并且选择恰当的竞争对手，有助于激发自己更加努力，勤于思考，发挥潜能。\n\n是谁让教育变得困难？\n1.如何介绍一门课程？\n目的，背景，流程，重点，后续学习；\n2.概念是知识的最简要概括，应该配有实例说明，其基础在学生了解背景；\n3.定义，定理，定律；\n4.如何讲述知识点；\n背景，例子，概念（知识点），应用；\n\n教育的模式？\n每一门科目都应该是选修；\n在证书上标清学习科目认证，以及等级；\n考试应该是有统考，\n导师的认可很重要；\n\n高尚还是自私，教育还是控制；\n指导别人的人生，出于经验，输出价值观，道德观，是否合理？\n1.家长为孩子铺路；\n2.前辈指导后辈；\n3.政府的舆论向导；\n输出的价值观、道德观是否正确，是否符合当下时代；\n如何输出我们的价值观、道德观；\n', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1460024993', '1504023458');
INSERT INTO `users_item` VALUES ('767', '21', '0', '0', '1', '1460025346', '1460025346', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, 'TED 如何在六个月内学会一门外语', 'http://www.iqiyi.com/w_19rqz8xl65.html', null, null, 'CST', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1460025346', '1504023458');
INSERT INTO `users_item` VALUES ('768', '21', '0', '0', '1', '1460050386', '1460050386', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '政治，政客博弈', '1.选民政治\n2.寡头政治\n3.媒体影响力\n4.媒体喜欢政治事件\n5.权利是什么，是人心，也是人们的信心\n6.为什么追求权利，因为权利在获得利益的手段中，最有优势的，是获得利益的捷径。\n7.权利，信仰，真相\n8.圆桌政治：有力量，有权利的政治\n9.选民：政治的门槛\n10.人们越来越不在意政治，人们只喜欢看show，人们只要娱乐。', null, null, '政治', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1460050386', '1504023458');
INSERT INTO `users_item` VALUES ('769', '21', '0', '0', '1', '1460050406', '1460050406', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '博弈论', '1.博弈：人，目标，欲望，预期，策略，变量，结果', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1460050406', '1504023458');
INSERT INTO `users_item` VALUES ('774', '21', '0', '0', '1', '1460357223', '1460357223', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '雷蕾 Cathy', '辽宁 阜新\n1988.3.15 （公历生日）\n属龙 正月二十八\n有个大八岁的姐姐，\n在花旗银行工作', null, null, 'people', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1460357223', '1504023458');
INSERT INTO `users_item` VALUES ('788', '21', '0', '0', '1', '1460620680', '1460620680', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '财经法规与职业道德', 'http://www.doc88.com/p-3823971043931.html', null, null, '', '0', '0', '0', null, null, null, null, null, '1', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1460620680', '1504023458');
INSERT INTO `users_item` VALUES ('789', '21', '0', '0', '1', '1460620797', '1460620797', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '财经法规与职业道德', 'http://www.doc88.com/p-3823971043931.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1460620797', '1504023458');
INSERT INTO `users_item` VALUES ('790', '21', '0', '0', '1', '1460620810', '1460620810', null, '1', '1', '123', '123', null, null, null, null, null, null, null, null, '财经法规与职业道德', 'http://www.doc88.com/p-3823971043931.html', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1460620810', '1504023458');
INSERT INTO `users_item` VALUES ('893', '21', '0', '0', '1', '1475127235', '1488790726', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第1期 许志远对话罗振宇', '精简版视频： http://v.qq.com/x/cover/0qbilvjksvt6zhw/z0300nu2jbx.html\n完整版视频（2小时47分无剪良品）： http://v.qq.com/x/cover/0qbilvjksvt6zhw/m0300kama2e.html ', 'sinaimg-/6d338e20ly1feavqtm96xj20do0j6dkw.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1475127235', '1504023458');
INSERT INTO `users_item` VALUES ('894', '21', '0', '0', '1', '1475127302', '1488790992', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第2期 许志远对话姚晨', '精简版视频：http://v.qq.com/x/cover/gtmnp5b34m9c2yo/y03114v2yc1.html\n完整版视频（3小时36分无剪良品）：http://v.qq.com/x/cover/gtmnp5b34m9c2yo/b002006v3cm.html', 'sinaimg-/006tzts3jw1f5r8i9x9ubj30ku112k3a.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1475127302', '1504023458');
INSERT INTO `users_item` VALUES ('960', '21', '0', '0', '1', '1477892726', '1477892726', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第3期 许知远对话二次元', '精简版视频：http://v.qq.com/x/cover/0se329q2kl5kxxz/n0326u7jbp8.html', 'sinaimg-/006tzts3jw1f7kz0moi2lj30ku112aja.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1477892726', '1504023458');
INSERT INTO `users_item` VALUES ('961', '21', '0', '0', '1', '1477892812', '1488790923', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第4期 许志远对话冯小刚', '精简版：https://v.qq.com/x/cover/zujzovzqmz7bxwl/j0335peor05.html\n完整版（88分钟）：http://v.qq.com/x/cover/zujzovzqmz7bxwl/v0335ipvrl7.html', 'sinaimg-/6d338e20ly1feavqtm96xj20do0j6dkw.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1477892812', '1504023458');
INSERT INTO `users_item` VALUES ('1031', '21', '0', '0', '1', '1488791192', '1488791266', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第5期 - 许知远对话叶准 ', '叶问的功夫究竟练到了什么境界？\n精简版（34分钟）： https://v.qq.com/x/cover/97wyc4al8pkgruq/y0343jdhy0m.html\n北京单向街篇完整版（102分钟）： https://v.qq.com/x/cover/97wyc4al8pkgruq/a0342qwzpxo.html\n香港篇完整版（1小时）： https://v.qq.com/x/cover/97wyc4al8pkgruq/c034267nj92.html', 'sinaimg-/006tzts3jw1f9g05jnyrdj30ku112ad5.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1488791192', '1504023458');
INSERT INTO `users_item` VALUES ('1032', '21', '0', '0', '1', '1488791362', '1488791362', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第6期 - 许知远对话李安', '精剪版（30分钟）： https://v.qq.com/x/cover/gjvby2cbbebga8i/a03483srgg0.html\n完整版（63分钟）： https://v.qq.com/x/cover/gjvby2cbbebga8i/v03484p21gt.html', 'sinaimg-/006tzts3jw1fa13efxln1j30ku1120vv.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1488791362', '1504023458');
INSERT INTO `users_item` VALUES ('1033', '21', '0', '0', '1', '1488791442', '1488791452', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第7期 - 许知远对话张楚', '精简版（37分钟）： https://v.qq.com/x/cover/eq1w9bdhoinsmwf/a0353v4qery.html\n完整版（1小时55分钟）： https://v.qq.com/x/cover/4oocb872jxju3c6/a0353j2m9il.html', 'sinaimg-/006tzts3jw1faihdb1lw4j30ku112ah4.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1488791442', '1504023458');
INSERT INTO `users_item` VALUES ('1034', '21', '0', '0', '1', '1488792207', '1488792207', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第8期 - 许知远对话蔡澜', '精剪版（44分钟）： https://v.qq.com/x/cover/7oktvjkab7pp2cc/i0360a0mhpr.html\n完整版之火锅篇（2小时05分钟）： https://v.qq.com/x/cover/7oktvjkab7pp2cc/t0359j2gdlg.html\n完整版之早茶篇（50分钟）： https://v.qq.com/x/cover/7oktvjkab7pp2cc/n0360dr13zl.html\n', 'sinaimg-/006tzts3jw1fb5oyutc0fj30ku112dlg.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1488792207', '1504023458');
INSERT INTO `users_item` VALUES ('1035', '21', '0', '0', '1', '1488792369', '1488792369', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第9期 - 许知远对话俞飞鸿之', '精剪版（41分钟）： https://v.qq.com/x/cover/nhrxn3jxcsraxd7/e03653qlkg5.html\n完整版之初见品茶篇（1小时54分钟）：https://v.qq.com/x/cover/nhrxn3jxcsraxd7/d0365bn0eyv.html\n完整版之坐而论道篇（2小时09分钟）： https://v.qq.com/x/cover/nhrxn3jxcsraxd7/p036575z4ag.html\n完整版之共享电影篇（42分钟）： https://v.qq.com/x/cover/nhrxn3jxcsraxd7/h0365fcdl5m.html', 'sinaimg-/006tzts3ly1fboummqh3uj30ku112tgu.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1488792369', '1504023458');
INSERT INTO `users_item` VALUES ('1036', '21', '0', '0', '1', '1488792798', '1488792798', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第10期 - 许知远对话陈嘉映 ', '陈嘉映被认为是“中国最可能接近哲学家称呼的人”。\n精剪版（54分钟）： https://v.qq.com/x/cover/wy6gil0bjqlfdpt/f0375ahngm2.html\n完整版之神奇的希腊人（1小时35分钟）： https://v.qq.com/x/cover/wy6gil0bjqlfdpt/v0374sr6ind.html\n完整版之哲学家的体验（2小时54分钟）： https://v.qq.com/x/cover/wy6gil0bjqlfdpt/s0374tofdun.html\n完整版之中国人浮世绘（1小时14分钟）： https://v.qq.com/x/cover/wy6gil0bjqlfdpt/e0374nkkvdd.html', 'sinaimg-/006tzts3ly1fcq95yynn3j30ku112gqh.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1488792798', '1504023458');
INSERT INTO `users_item` VALUES ('1037', '21', '0', '0', '1', '1488792820', '1488792820', null, '1', '1', '333', '333', null, null, null, null, null, null, null, null, '《十三邀》 第11期 - 许知远对话贾樟柯', '精剪版（48分钟）： https://v.qq.com/x/cover/7o02cpwtoumb2q3/w038075o2a6.html\n完整版之回乡的原因（1小时53分钟）： https://v.qq.com/x/cover/7o02cpwtoumb2q3/h0378ihj3n7.html\n完整版之男人的饭局（2小时02分钟）： https://v.qq.com/x/cover/7o02cpwtoumb2q3/m03781volva.html\n完整版之单向街篇（53分钟）： https://v.qq.com/x/cover/7o02cpwtoumb2q3/g0378kidyx8.html', 'sinaimg-/006tzts3ly1fd9ud9kwexj30ku112n4s.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1488792820', '1504023458');
INSERT INTO `users_item` VALUES ('1064', '44', '0', '0', '0', '1489764550', '1489764550', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '都知道中国的房地产泡沫一定会破，什么时候破？', '能不能说说自己的判断，以及判断的思考模型？', 'sinaimg-/90b68290gy1fdq9eyaa6ij208c08c3yc.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1489764550', '1504023458');
INSERT INTO `users_item` VALUES ('1094', '41', '0', '0', '1', '1490357814', '1490357814', null, '1', '1', '126', '126', null, null, null, null, null, null, null, null, ' 伟大的女性', '我是小心眼儿的。\n习惯用比较高但是有没什么逼用的标准衡量我和媳妇儿的生活琐碎，例如沙发垫子上的褶皱，在被她怼了几回之后不得不开始反思——我他妈的是不是有点太苛刻了？于是试着降低了一下标准，也确实有了成效，起码我可以忍受沙发垫子上的褶皱，但底线止于褶皱的面积和持续的时间。几次三番，我才开始意识到我就是这样一个事儿逼，这玩意儿跟性取向一样改不了，想通了这点之后我开始不由地同情媳妇儿——跟我这么一个事儿逼共同生活个几十年，到死那天才真的是解脱吧。', 'qingbo-/96fcbe32de4421ea792b2b6374149331.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1490357814', '1504023458');
INSERT INTO `users_item` VALUES ('1100', '21', '0', '0', '1', '1490483659', '1490483659', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '苏格拉底：未经审视的人生不值得一过。', '', 'sinaimg-/90b68290gy1fdzu12vbj6j21kw1kwna0.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1490483659', '1504023458');
INSERT INTO `users_item` VALUES ('1103', '21', '0', '0', '1', '1490533192', '1490533192', null, '1', '1', '126', '126', null, null, null, null, null, null, null, null, '', '鸟儿（儿化音）', 'qingbo-/94c13c50d5465702255b7d75c8a86951.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1490533192', '1504023458');
INSERT INTO `users_item` VALUES ('1104', '21', '0', '0', '1', '1490588238', '1490590445', null, '1', '1', '122', '122', null, null, null, null, null, null, null, null, '图书推荐 - 马尔科姆·格拉德威尔 【系列】', '《引爆点：如何引发流行》 \nThe Tipping Point : How Little Things Make a Big Difference (2000) \n豆瓣链接：https://book.douban.com/subject/25876611\n\n《眨眼之间：不假思索的决断力》 \nBlink : The Power of Thinking Without Thinking (2005) \n豆瓣链接：https://book.douban.com/subject/25875190\n\n《异类：不一样的成功启示录》 \nOutliers : The Story of Success (2008) \n豆瓣链接：https://book.douban.com/subject/25863621\n\n《大开眼界：用另一双眼睛看透这疯狂世界、奇妙生活和美丽人生》 \nWhat the Dog Saw : And Other Adventures (2009) \n豆瓣链接：https://book.douban.com/subject/25866871\n\n《逆转：弱者如何找到优势，反败为胜？》 \nDavid and Goliath : Underdogs, Misfits, and the Art of Battling Giants (2013) \n豆瓣链接：https://book.douban.com/subject/20480678', 'sinaimg-/90b68290gy1fei8t5saymj208i0c3aa6.jpg<|>sinaimg-/90b68290gy1fei8tdxrw2j208i0c3mxc.jpg<|>sinaimg-/90b68290gy1fei8tf02ioj208f0c674l.jpg<|>sinaimg-/90b68290gy1fei8tk9odmj208i0c3mxc.jpg<|>sinaimg-/90b68290gy1fei8tn2ookj208i0c374j.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1490588238', '1504023458');
INSERT INTO `users_item` VALUES ('1121', '21', '0', '0', '1', '1490963853', '1490963853', null, '1', '1', '126', '126', null, null, null, null, null, null, null, null, '一个逼样儿', '想想没参加工作的时候，真是自大得不行，如果真有穿越这么回事儿，估计现在的我会回去好好劝导一下自己，再不济嘲讽两句也行吧，只怕穿越完事儿回到现在后得唏嘘一阵儿——当年吹的那么多牛皮，怎么这么多年过去了就没想起去圆呢，害得老子现在恨不得买菜都要杀价。无奈笑笑，自嘲了两句——“妈的现在不也是一个逼样儿。”', 'qingbo-/995cce236d4fa6e516c1db30628bfb26.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1490963853', '1504023458');
INSERT INTO `users_item` VALUES ('1122', '21', '0', '0', '1', '1490982938', '1490984331', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '手绘上海', '', 'sinaimg-/90b68290gy1fe6kpbguiej20p009udjs.jpg<|>sinaimg-/90b68290gy1fe6kpbnw10j20p00b0dmj.jpg<|>sinaimg-/90b68290gy1fe6kpcea4yj20p00h7gwo.jpg<|>sinaimg-/90b68290gy1fe6kpcqkzyj20p00h7k0a.jpg<|>sinaimg-/90b68290gy1fe6kpdejgcj20p00h7ajd.jpg<|>sinaimg-/90b68290gy1fe6kpdam8rj20p00h77ei.jpg<|>sinaimg-/90b68290gy1fe6kpe4xnbj20p00h7drj.jpg<|>sinaimg-/90b68290gy1fe6kpe0qh6j20p00h7wpr.jpg<|>sinaimg-/90b68290gy1fe6kpcf5a5j20p00h7qca.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1490982938', '1504023458');
INSERT INTO `users_item` VALUES ('1127', '21', '0', '0', '1', '1491055861', '1491055861', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '手绘建筑简图', '', 'sinaimg-/90b68290gy1fe7j622axdj20go0gomy6.jpg<|>sinaimg-/90b68290gy1fe7j62sk1bj20go0go3z0.jpg<|>sinaimg-/90b68290gy1fe7j636v8qj20go0go3yx.jpg<|>sinaimg-/90b68290gy1fe7j6427v2j20go0gomy2.jpg<|>sinaimg-/90b68290gy1fe7j649kntj20go0goq3u.jpg<|>sinaimg-/90b68290gy1fe7j64vkloj20go0gomxp.jpg<|>sinaimg-/90b68290gy1fe7j652w64j20go0godg5.jpg<|>sinaimg-/90b68290gy1fe7j65cyyjj20go0goq3q.jpg<|>sinaimg-/90b68290gy1fe7j65kxpjj20go0go3z9.jpg<|>sinaimg-/90b68290gy1fe7j6jbw00j20go0go3z7.jpg<|>sinaimg-/90b68290gy1fe7j6je3btj20go0godha.jpg<|>sinaimg-/90b68290gy1fe7j6jl2kej20go0go75q.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1491055861', '1504023458');
INSERT INTO `users_item` VALUES ('1128', '21', '0', '0', '1', '1491742361', '1491742361', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '凯旋门', '', 'sinaimg-/90b68290gy1feln5fr8psj21kw11zh1i.jpg<|>sinaimg-/90b68290gy1feln5fkrahj21kw11znc7.jpg<|>sinaimg-/90b68290gy1feln5gcau4j21kw0vztlt.jpg<|>sinaimg-/90b68290gy1feln5gzvrlj21kw11zqid.jpg<|>sinaimg-/90b68290gy1feln5e7kj2j20qo0hsdmh.jpg<|>sinaimg-/90b68290gy1feln021hx3j21hc0u010k.jpg<|>sinaimg-/90b68290gy1feln0kqg6uj20rs0ijgrd.jpg<|>sinaimg-/90b68290gy1feln1begeuj21jk15rnj0.jpg<|>sinaimg-/90b68290gy1felmxpdz2bj20go0oqdpc.jpg<|>sinaimg-/90b68290gy1felmxqmjpqj20sg0mj7f3.jpg<|>sinaimg-/90b68290gy1feln4wg149j21jk118kd5.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1491742361', '1504023458');
INSERT INTO `users_item` VALUES ('1129', '21', '0', '0', '1', '1491742723', '1491742723', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '威斯敏斯特宫（英国议会大厦）', '', 'sinaimg-/90b68290gy1fegq5y1ojjj21jl0v9ahd.jpg<|>sinaimg-/90b68290gy1fegq5yg82qj21jk0vaah1.jpg<|>sinaimg-/90b68290gy1fegq5yxz6yj21jk0vagsy.jpg<|>sinaimg-/90b68290gy1fegq5zm9afj21jk0vaguj.jpg<|>sinaimg-/90b68290gy1fegq604c5uj21jl0v9dsa.jpg<|>sinaimg-/90b68290gy1fegq60nianj21ao0v4n4w.jpg<|>sinaimg-/90b68290gy1fegq61ad4dj21kw11xwvi.jpg<|>sinaimg-/90b68290gy1fegq61zpm5j20sg0lc46o.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1491742723', '1504023458');
INSERT INTO `users_item` VALUES ('1149', '21', '0', '0', '1', '1492108896', '1492108896', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '埃菲尔铁塔', '', 'sinaimg-/90b68290gy1felnezztk1j20iw0ei0vn.jpg<|>sinaimg-/90b68290gy1felnf06pkaj20iw0cltb7.jpg<|>sinaimg-/90b68290gy1felnf0gj2oj20iw0ck0wn.jpg<|>sinaimg-/90b68290gy1felnf04ck0j20iw0clads.jpg<|>sinaimg-/90b68290gy1felnf0pg4kj20iw0cmae6.jpg<|>sinaimg-/90b68290gy1felnf1g3m2j211y0lcaco.jpg<|>sinaimg-/90b68290gy1felnf1tvvkj21hc0xctfc.jpg<|>sinaimg-/90b68290gy1felnfk8dzej20sg0lcdh6.jpg<|>sinaimg-/90b68290gy1felnfk88wbj20qo0m80ur.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1492108896', '1504023458');
INSERT INTO `users_item` VALUES ('1150', '21', '0', '0', '1', '1492111661', '1492111661', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '手绘城市', '', 'sinaimg-/90b68290gy1felnvg1zg4j20rm0hpq6s.jpg<|>sinaimg-/90b68290gy1felnvgnabbj20rm0beju4.jpg<|>sinaimg-/90b68290gy1felnvgaiwdj20rm0d6dj1.jpg<|>sinaimg-/90b68290gy1felnvgp58pj20rm0bego4.jpg<|>sinaimg-/90b68290gy1felnvgy7nnj20rm0iigoa.jpg<|>sinaimg-/90b68290gy1felnvh231hj20rm0ch41j.jpg<|>sinaimg-/90b68290gy1felnvhsg0sj20rm0fddiy.jpg<|>sinaimg-/90b68290gy1felnvhmo8sj20rm0dggoy.jpg<|>sinaimg-/90b68290gy1felnvhr9lbj20rm0ibmzt.jpg<|>sinaimg-/90b68290gy1felnvt3mk8j20rm0jj77y.jpg<|>sinaimg-/90b68290gy1felnvtaqdtj20rm0jc789.jpg<|>sinaimg-/90b68290gy1felnvtwlcjj20rm0jsdkv.jpg<|>sinaimg-/90b68290gy1felnvu878gj20rm0f1juh.jpg<|>sinaimg-/90b68290gy1felnvuf768j20rm0epgpb.jpg<|>sinaimg-/90b68290gy1felnvuuql1j20rm0fd77y.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1492111661', '1504023458');
INSERT INTO `users_item` VALUES ('1151', '21', '0', '0', '1', '1492141835', '1492150158', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '莫斯科红场 - 圣瓦西里升天大教堂', '', 'sinaimg-/90b68290gy1fem66eh8b6j21hc0u0woj.jpg<|>sinaimg-/90b68290gy1fem680salsj21e00xcn3u.jpg<|>sinaimg-/90b68290gy1fem67zc3cmj212w0szn80.jpg<|>sinaimg-/90b68290gy1fem67zne12j212w0qywn8.jpg<|>sinaimg-/90b68290gy1fem6808zqfj20r30xctjy.jpg<|>sinaimg-/90b68290gy1fem680lw4oj20uk0j4dk1.jpg<|>sinaimg-/90b68290gy1fem681d3tej21hc0xc4ek.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1492141835', '1504023458');
INSERT INTO `users_item` VALUES ('1152', '21', '0', '0', '1', '1492150330', '1492150330', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '莫斯科红场 - 莫斯科国家历史博物馆', '', 'sinaimg-/90b68290gy1fem6usgcnvj218g0u9ahf.jpg<|>sinaimg-/90b68290gy1fem6usrenhj20tb0jgack.jpg<|>sinaimg-/90b68290gy1fem6ut08t7j20rs0ku773.jpg<|>sinaimg-/90b68290gy1fem6utcsk2j218g0tjn4l.jpg<|>sinaimg-/90b68290gy1fem6uu9bszj20qo0zkte7.jpg<|>sinaimg-/90b68290gy1fem6uurxz2j218g0p0ag8.jpg<|>sinaimg-/90b68290gy1fem6uty9c0j20sg0j2mzf.jpg<|>sinaimg-/90b68290gy1fem6uv35qhj21hc0u0113.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1492150330', '1504023458');
INSERT INTO `users_item` VALUES ('1153', '21', '0', '0', '1', '1492152425', '1492152425', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '米兰大教堂', '', 'sinaimg-/90b68290gy1fem8n5i0n3j21hc0xck4l.jpg<|>sinaimg-/90b68290gy1fem8n6cr31j21jk10mwpi.jpg<|>sinaimg-/90b68290gy1fem8n8x0xoj20yq0md7li.jpg<|>sinaimg-/66a584cfgw1eu3ec7eq0rj20xc0m5n5l.jpg<|>sinaimg-/66a584cfgw1eu3ecfbp6xj20xc0m5dob.jpg<|>sinaimg-/66a584cfgw1eu3ecgawu2j20xc0m5dpk.jpg<|>sinaimg-/66a584cfgw1eu3ecv8u9oj20xc0m5ag8.jpg<|>sinaimg-/66a584cfgw1eu3ecvwv79j20xc0m57d4.jpg<|>sinaimg-/66a584cfgw1eu3ecx960ij20m50xc7g2.jpg<|>sinaimg-/66a584cfgw1eu3ecxwml8j20xc0m50zz.jpg<|>sinaimg-/66a584cfgw1eu3ecyov04j20xc0m5gss.jpg<|>sinaimg-/66a584cfgw1eu3edzhld7j20m50xcn8v.jpg<|>sinaimg-/66a584cfgw1eu3ed8og5oj20m50xcqeg.jpg<|>sinaimg-/66a584cfgw1eu3ed9g38yj20xc0m5gst.jpg<|>sinaimg-/66a584cfgw1eu3ed9vpx3j20xc0m5jse.jpg<|>sinaimg-/66a584cfgw1eu3edaeg8kj20xc0m50ve.jpg<|>sinaimg-/66a584cfgw1eu3edb0p9ej20m50xcdoj.jpg<|>sinaimg-/66a584cfgw1eu3edc8a70j20m50xc77g.jpg<|>sinaimg-/66a584cfgw1eu3edcrd8wj20xc0m5jwx.jpg<|>sinaimg-/66a584cfgw1eu3edej2zvj20m50xcagm.jpg<|>sinaimg-/66a584cfgw1eu3efy7u8vj20xc0m57a8.jpg<|>sinaimg-/66a584cfgw1eu3eg2drtcj20xc0m5gqh.jpg<|>sinaimg-/66a584cfgw1eu3eedxfa8j20xc0m544l.jpg<|>sinaimg-/66a584cfgw1eu3eee65jdj20xc0m57bn.jpg<|>sinaimg-/66a584cfgw1eu3eeihmrfj20xc0m510x.jpg<|>sinaimg-/66a584cfgw1eu3eentji3j20m50xcdqq.jpg', '123', '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1492152425', '1504023458');
INSERT INTO `users_item` VALUES ('1154', '21', '0', '0', '1', '1492338185', '1492338185', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '日本姬路城（兵库县姬路市）', '', 'sinaimg-/90b68290gy1feoot68enkj20sg0lc75v.jpg<|>sinaimg-/90b68290gy1feoot5qsntj20xc0p0dje.jpg<|>sinaimg-/90b68290gy1feoot7bseej20zk0qote7.jpg<|>sinaimg-/90b68290gy1feoot7rgqdj20xc0p00vr.jpg<|>sinaimg-/90b68290gy1feoot73w0oj218g0tnwio.jpg<|>sinaimg-/90b68290gy1feoot8rovej20xc0mlwiq.jpg<|>sinaimg-/90b68290gy1feoot7560lj218g0tjq8i.jpg<|>sinaimg-/90b68290gy1feoot532htj20sg0lctc4.jpg<|>sinaimg-/90b68290gy1feoot55ii2j20xc0p0784.jpg<|>sinaimg-/90b68290gy1feoot57jx3j215o0rqqaj.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1492338185', '1504023458');
INSERT INTO `users_item` VALUES ('1155', '21', '0', '0', '1', '1492338362', '1492338362', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '鸟居 （日本神社附属建筑）', '鸟居是类似牌坊的日本神社附属建筑，代表神域的入口，用于区分神栖息的神域和人类居住的世俗界。鸟居的存在提醒来访者，踏入鸟居即意味着进入神域，之后所有的行为举止都应特别注意。', 'sinaimg-/90b68290gy1fem9xdkkxbj20rs0qygn5.jpg<|>sinaimg-/90b68290gy1fem9xdsaebj20p00e2dg4.jpg<|>sinaimg-/90b68290gy1fem9xdgvg7j20j60izaak.jpg<|>sinaimg-/90b68290gy1feop59vkhmj20zk0qoacq.jpg<|>sinaimg-/90b68290gy1feop3qgsrqj218g0tj43e.jpg<|>sinaimg-/90b68290gy1fem9xdq6z3j218g0xcdk0.jpg<|>sinaimg-/90b68290gy1fem9xdmp9fj218g0tj784.jpg<|>sinaimg-/90b68290gy1fem9xdujf4j20p00p00up.jpg<|>sinaimg-/90b68290gy1fem9xdway2j20ci0adglw.jpg<|>sinaimg-/90b68290gy1fem9xduvowj20c40bqdgm.jpg<|>sinaimg-/90b68290gy1fem9xdlwq6j20rs0kejue.jpg<|>sinaimg-/90b68290gy1fem9xdo39xj20rs0jnta8.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '44', '0', '7', '0', '0', '2', '0', '1', '0', '0', '0', '2', '8', '8.0', '100', '0', null, '1492338362', '1504023458');
INSERT INTO `users_item` VALUES ('1178', '21', '0', '0', '1', '1493271903', '1494308959', null, '8', '1', '120', '120', null, null, null, null, null, null, null, null, '<div>[11111.1155]', '\n<p>@11111</p>\n<p>@11111.1155</p>\n<p>[11111.1155]</p>\n', null, null, '', '0', '0', '0', null, null, null, null, '1', null, '0', null, '0', null, '0', null, '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1493271903', '1504023458');
INSERT INTO `users_item` VALUES ('1193', '21', '0', '0', '1', '1494692268', '1494806457', null, '2', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《蒙娜丽莎》 列奥纳多·达·芬奇，1503 - 1507年创作。', '', 'sinaimg-/90b68290gy1ffk6v4ofo9j21kw2dcnpe.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494692268', '1504023458');
INSERT INTO `users_item` VALUES ('1194', '21', '0', '0', '1', '1494692592', '1494806433', null, '2', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《The Last Supper》最后的晚餐，列奥纳多·达·芬奇，1494 - 1498年创作。', '', 'sinaimg-/90b68290gy1ffk713211cj21kw0ux4qq.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494692592', '1504023458');
INSERT INTO `users_item` VALUES ('1195', '21', '0', '0', '1', '1494692748', '1494806410', null, '2', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《拿破仑一世加冕大典》 达雅克·路易·大卫（法国），1805-1807年创作。 ​​​​', '', 'sinaimg-/90b68290gy1ffk74v7n6kj21kw0zsnpe.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494692748', '1504023458');
INSERT INTO `users_item` VALUES ('1196', '21', '0', '0', '1', '1494806305', '1494806305', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《日出印象》 克劳德·莫奈（法国），1872年。 ​​​​', '', 'sinaimg-/90b68290gy1fflpt48r3ej21k61a27fp.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494806305', '1504023458');
INSERT INTO `users_item` VALUES ('1197', '21', '0', '0', '1', '1494908196', '1494908196', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《戴珍珠耳环的少女》，约翰内斯·维米尔（荷兰），1665年创作。', '', 'sinaimg-/90b68290gy1ffn2y8dyf4j21kw1pmwk0.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494908196', '1504023458');
INSERT INTO `users_item` VALUES ('1198', '21', '0', '0', '1', '1494913794', '1494913794', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《暴风雪：汉尼拔和他的军队越过阿尔卑斯山》，威廉·透纳（英国），1812年创作。', '约瑟夫·马洛德·威廉·透纳（Joseph Mallord William Turner，1775年4月23日－1851年12月19日）是英国最为著名，技艺最为精湛的艺术家之一，19世纪上半叶英国学院派画家的代表，在西方艺术史上无可置疑地位于最杰出的风景画家之列。', 'sinaimg-/90b68290gy1ffn5lafauej216k0q40xb<|>sinaimg-/90b68290gy1ffn5lasfvtj20zk0m64qp<|>sinaimg-/90b68290gy1ffn5law9u8j20xp0ku76j.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494913794', '1504023458');
INSERT INTO `users_item` VALUES ('1199', '21', '0', '0', '1', '1494915432', '1494915432', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《夜巡》，伦勃朗（荷兰），1642年创作。', '伦勃朗·哈尔曼松·凡·莱因（Rembrandt Harmenszoon van Rijn，1606-1669）欧洲17世纪最伟大的画家之一，也是荷兰历史上最伟大的画家。台湾简称为林布兰特。', 'sinaimg-/90b68290gy1ffn6evweutj21kw1bke82<|>sinaimg-/90b68290gy1ffn6etcygyj20pt0lbwj8.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494915432', '1504023458');
INSERT INTO `users_item` VALUES ('1200', '21', '0', '0', '1', '1494915926', '1494915926', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《宫娥》，委拉斯开兹（西班牙），1659年创作。', '迭戈·罗德里格斯·德席尔瓦-委拉斯开兹（Velazquez，1599年6月6日－1660年8月6日），十七世纪巴洛克时期西班牙画家，是文艺复兴后期西班牙最伟大的画家，对后来的画家影响很大，弗朗西斯科·戈雅认为他是自己的“伟大教师之一”。对印象派的影响也很大。', 'sinaimg-/90b68290gy1ffn6mp6uy7j21kw1tzkjl.jpg<|>sinaimg-/90b68290gy1ffn6mnza8oj20q00t67an.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1494915926', '1504023458');
INSERT INTO `users_item` VALUES ('1209', '21', '0', '0', '1', '1495083739', '1495083739', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《星夜》，梵高，1889年6月创作。', '《星月夜》，也被译为《星夜》（The Starry Night） （荷兰语：De sterrennacht）是荷兰后印象派画家文森特·梵高于1889年在法国圣雷米的一家精神病院里创作的一幅著名油画，是梵高的代表作之一，现藏纽约现代艺术博物馆。\n文森特·威廉·梵·高(Vincent Willem van Gogh，1853-1890)，中文又称\"凡高\"，荷兰后印象派画家。出生于新教牧师家庭，是后印象主义的先驱，并深深地影响了二十世纪艺术，尤其是野兽派与表现主义。作品受法国现实主义画家米勒的影响。', 'sinaimg-/90b68290gy1ffpfi53fa4j21kw19snpd.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1495083739', '1504023458');
INSERT INTO `users_item` VALUES ('1210', '21', '0', '0', '1', '1495084613', '1495084613', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《罗纳河上的星夜》，梵高，1888年创作。', '《罗纳河上的星夜》是荷兰后印象派画家文生·梵高于1888年创作的著名油画。显示了法国南部城市阿尔勒的罗纳河上的夜景。该画现藏于法国巴黎的奥塞美术馆。\n运用冷色迷人的深蓝短线铺满整个夜空，强而有力的笔触表达出夜的深沉神秘与无法预测，而点缀其上的微明星子，与倒映在河面上的瓦斯灯灯影相互辉映，深蓝与 亮黄的强烈对比让作品表达出画家内心澎湃的感动，略带稚拙地描绘平静河面上的灯影，是梵高内心急欲分享与寂寞的率直表现。', 'sinaimg-/90b68290gy1ffpfxtj74kj218g0rstkp.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1495084613', '1504023458');
INSERT INTO `users_item` VALUES ('1211', '21', '0', '0', '1', '1495084935', '1495084935', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《有乌鸦的麦田》，梵高，1890年7月创作。', '《有乌鸦的麦田》是荷兰后印象派画家文生·梵高创作于1890年7月的一幅油画。通常的解释是，这幅画是以黑暗，严酷的天空显示了梵高的精神状态的困扰，与徘徊不决的通往不同方向的三种途径，与黑色乌鸦架空的预示死亡迹象。\n在这幅画上仍然有着人们熟悉的他那特有的金黄色，但它却充满不安和阴郁感，乌云密布的沉沉蓝天，死死压住金黄色的麦田，沉重得叫人透不过气来，空气似乎也凝固了，一群凌乱低飞的乌鸦、波动起伏的地平线和狂暴跳动的激荡笔触更增加了压迫感、反抗感和不安感。画面极度骚动，绿色的小路在黄色麦田中深入远方，这更增添了不安和激奋情绪，这种画面处处流露出紧张和不详的预兆，好像是一幅色彩和线条组成的无言绝命书。', 'sinaimg-/90b68290gy1ffpg2vpjajj20zk0gntd6.jpg<|>sinaimg-/90b68290gy1ffpg2vik07j215o0jkagq.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1495084935', '1504023458');
INSERT INTO `users_item` VALUES ('1212', '21', '0', '0', '1', '1495085196', '1495085196', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '油画《向日葵》两幅，梵高。', '', 'sinaimg-/90b68290gy1ffpg7hq3euj21k81yb1aw.jpg<|>sinaimg-/90b68290gy1ffpg7i5a1fj21kw232hcz.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1495085196', '1504023458');
INSERT INTO `users_item` VALUES ('1213', '21', '0', '0', '1', '1495203798', '1495376346', null, '2', '1', '11111', '11111', null, null, null, null, null, null, null, null, '西斯廷礼拜堂壁画《创造亚当》，米开朗基罗（意大利，1475 - 1564年）。', '上帝所在的部分像似人的大脑，到底是上帝创造了亚当，还是上帝存在于人脑之中？', 'sinaimg-/90b68290gy1ffr17kbdbgj21kw0qiu11.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1495203798', '1504023458');
INSERT INTO `users_item` VALUES ('1219', '21', '0', '0', '1', '1495594702', '1495594702', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '2016/17赛季 欧罗巴联赛决赛 - 阿贾克斯 vs 曼联', '乐视体育视频直播：http://sports.le.com/match/1034015003.html\nPPTV视频直播：http://v.pptv.com/show/l0uyMJjibbqwPjfU.html', null, null, '', '0', '0', '1', '1', '1495651500', '0', '1495727999', null, null, '0', null, '0', null, '0', null, '1', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1495594702', '1504023458');
INSERT INTO `users_item` VALUES ('1220', '21', '0', '0', '1', '1495594787', '1495594787', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '欧冠决赛 - 尤文图斯 vs 皇家马德里', '', null, null, '', '0', '0', '1', '1', '1496515500', '0', '1496591999', null, null, '0', null, '0', null, '0', null, '1', '0', '0', '1', '1', '2', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1495594787', '1504023458');
INSERT INTO `users_item` VALUES ('1222', '21', '0', '0', '1', '1496206406', '1496209126', null, '6', '1', '11111', '11111', null, null, null, null, null, null, null, null, '中国十大传世名画', '《洛神赋图》 顾恺之（东晋） 北京故宫博物院\n故宫博物馆部分 https://upload.wikimedia.org/wikipedia/commons/b/bd/Gu_Kaizhi-Nymph_of_the_Luo_River_%28full%29%2C_Palace_Museum%2C_Beijing.jpg\n弗利尔美术馆（华盛顿）部分 https://upload.wikimedia.org/wikipedia/commons/d/dd/A_Gu_Kaizhi._Nymph_of_the_Luo_River._%2824%2C2x310%2C9_cm%29_Southern_Song_Copy._Freer_Gallery_of_Art._Washington..jpg\n辽宁博物馆 部分 https://upload.wikimedia.org/wikipedia/commons/9/97/B_Gu_Kaizhi._Nymph_of_the_Luo_River._%28section%29_Southern_Song_Copy._Liaoning_Provincial_museum.jpg\n\n《步辇图》 阎立本（唐） 北京故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/9/95/Yan_Liben._Emperor_Taizong_gives_an_audience_to_the_ambassador_of_Tibet_Palace_Museum%2C_Beijing1.jpg\n\n《唐宫仕女图》\n \n《虢国夫人游春图》 张萱（唐） 辽宁省博物馆\n李公麟（宋）摹本 高清图 https://upload.wikimedia.org/wikipedia/commons/c/c7/Li_Kung-lin_001.jpg\n《捣练图》 张萱（唐） 美国波士顿博物馆\n宋徽宗摹本 高清图 https://upload.wikimedia.org/wikipedia/commons/1/18/Court_Ladies_Preparing_Newly_Woven_Silk.jpg\n\n《挥扇仕女图》 周昉（唐） 北京故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/1/1f/Zhou_Fang._Lady_With_Servants_%28or_Lady_With_Fan%29._%2833%2C7x204%2C8%29_Beijing_Palace_Museum.jpg\n《簪花仕女图》 周昉（唐） 辽宁省博物馆\n高清图 https://upload.wikimedia.org/wikipedia/commons/0/06/Zhou_Fang._Court_Ladies_Wearing_Flowered_Headdresses._%2846x180%29_Liaoning_Provincial_Museum%2C_Shenyang..jpg\n\n《宫乐图》 唐晚期 台北故宫博物院\n\n《五牛图》 韩滉（唐） 北京故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/8/81/Wuniutu.jpg\n\n《韩熙载夜宴图》 顾闳中（五代） 北京故宫博物院\n前半部分高清图 https://upload.wikimedia.org/wikipedia/commons/f/f8/Gu_Hongzhong%27s_Night_Revels_1.jpg\n后半部分高清图 https://upload.wikimedia.org/wikipedia/commons/9/9d/Gu_Hongzhong%27s_Night_Revels_2.jpg\n\n《千里江山图》 王希孟（北宋） 北京故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/3/37/Wang_Ximeng._A_Thousand_Li_of_Rivers_and_Mountains._%28Complete%2C_51%2C3x1191%2C5_cm%29._1113._Palace_museum%2C_Beijing.jpg\n\n《清明上河图》 张择端（北宋） 北京故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/8/86/Alongtheriver_QingMing.jpg\n\n《富春山居图》 黄公望（元）\n前段《剩山图》浙江博物馆\n高清图 https://upload.wikimedia.org/wikipedia/commons/a/af/%E5%AF%8C%E6%98%A5%E5%B1%B1%E5%B1%85%E5%9C%96%28%E5%89%A9%E5%B1%B1%E5%9C%96%29.jpg\n后段《无用师卷》台北故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/6/6d/%E5%AF%8C%E6%98%A5%E5%B1%B1%E5%B1%85%E5%9C%96%28%E7%84%A1%E7%94%A8%E5%B8%AB%E5%8D%B7%29.jpg\n\n《汉宫春晓图》 仇英（明） 台北故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/5/55/Qiu_Ying-Han_Palace_Spring_Daybreak.jpg\n\n《百骏图》 郎世宁（清） 台北故宫博物院\n高清图 https://upload.wikimedia.org/wikipedia/commons/8/8c/A_Hundred_Steeds.jpg', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1496206406', '1504023458');
INSERT INTO `users_item` VALUES ('1223', '21', '0', '0', '1', '1498011083', '1498011298', null, '4', '1', '120', '120', null, null, null, null, null, null, null, null, '\\\" /\' insert ', '\"\'', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1498011083', '1504023458');
INSERT INTO `users_item` VALUES ('1225', '41', '0', '0', '1', '1498140313', '1498140313', null, '1', '1', '126', '126', null, null, null, null, null, null, null, null, '口头禅', '最近的口头禅:\"Call me bitch and fuck me.\"\n意译的话应该是：“来咬我啊。”\n直译的话应该是：“来口交我啊。”\n————————————\n讲真，汉语真尼玛勃大茎深。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1498140313', '1504023458');
INSERT INTO `users_item` VALUES ('1228', '21', '0', '0', '1', '1500474983', '1500475081', null, '2', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《亚维农的少女》 毕加索，1907年。', '维基百科：https://en.wikipedia.org/wiki/Les_Demoiselles_d%27Avignon\n百度百科：http://baike.baidu.com/item/%E4%BA%9A%E5%A8%81%E5%86%9C%E5%B0%91%E5%A5%B3', 'sinaimg-/90b68290gy1fhpko7te8rj21kw1mx7tu.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '4', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1500474983', '1504023458');
INSERT INTO `users_item` VALUES ('1229', '21', '0', '0', '1', '1500551211', '1500551211', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《呐喊》 （挪威画家爱德华·蒙克1893年绘画作品）', '', 'sinaimg-/90b68290gy1fhqma5kc0sj21kw20htof.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0.0', '100', '0', null, '1500551211', '1504023458');
INSERT INTO `users_item` VALUES ('1230', '41', '0', '0', '1', '1500561313', '1500561313', null, '1', '1', '126', '126', null, null, null, null, null, null, null, null, '', '年轻时不懂爱情，就想找个漂亮的，后来发现会腻，不如找个有趣的，阴差阳错找到个一般有趣的，过了几年发现还是他妈会腻，只有两人的默契这个东西流了下来。庆幸自己发现了真相之余又有些感伤：早知道死皮赖脸守个漂亮点儿的培养默契就好了。趁这个想法生根之前啪啪抽了自己俩嘴巴——漂亮的谁他妈跟你丫——在这一点上我和我媳妇达成高度共识——你看，这话又说回来了，这就是妈的默契，于是我在经历了一个思想上的循环后又开心起来了。', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '2', '0', '0', '0', '0', '30', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1500561313', '1507007986');
INSERT INTO `users_item` VALUES ('1233', '21', '0', '0', '1', '1501598392', '1501772452', null, '4', '1', '120', '120', null, null, null, null, null, null, null, null, '<div>1</div>', '<div>  1  </div>\n<div>  2', null, null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '11', '0', '0', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1501598392', '1504024256');
INSERT INTO `users_item` VALUES ('1244', '21', '0', '0', '1', '1502808089', '1502808089', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《格尔尼卡》 毕加索，1937年，马德里国家索菲亚王妃美术馆。', '', 'sinaimg-/90b68290gy1fikse0nsdtj21kw0lcgsm.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1502808089', '1504023458');
INSERT INTO `users_item` VALUES ('1245', '21', '0', '0', '1', '1502808781', '1502808781', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《苏格拉底之死》 雅克-路易·大卫，1787年，纽约大都会博物馆。', '', 'sinaimg-/90b68290gy1fiksrctaqaj21kw11etp0.jpg', null, '', '0', '0', '0', null, null, null, null, null, null, '0', null, '0', null, '0', null, '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1502808781', '1504023458');
INSERT INTO `users_item` VALUES ('1282', '21', '0', '0', '1', '1503380104', '1503380104', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '亚冠1/4决赛首回合 - 上海上港  vs   广州恒大', '', '', '', '', '0', '0', '1', '1', '1503403200', '0', '1503417599', null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503380104', '1504023458');
INSERT INTO `users_item` VALUES ('1286', '21', '0', '0', '1', '1503673098', '1503673098', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '跨界世纪大战 - 梅威瑟 vs 麦格雷戈', 'PPTV视频直播：http://v.pptv.com/show/vmjPTbUbia8ksqhI.html', '', '', '', '0', '0', '1', '1', '1503795600', '0', '1503849599', null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503673098', '1504023458');
INSERT INTO `users_item` VALUES ('1287', '21', '0', '0', '1', '1503673531', '1503673531', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '2018世预赛亚洲区12强赛（第9轮） - 中国 vs 乌兹别克斯坦', '', '', '', '', '0', '0', '1', '1', '1504166400', '0', '1504195199', null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503673531', '1504023458');
INSERT INTO `users_item` VALUES ('1288', '21', '0', '0', '1', '1503673605', '1503673605', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '2018世预赛亚洲区12强赛（第10轮） - 卡塔尔 vs 中国', '', '', '', '', '0', '0', '1', '1', '1504598400', '0', '1504627199', null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503673605', '1504023458');
INSERT INTO `users_item` VALUES ('1289', '21', '0', '0', '1', '1503850662', '1503850662', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《阿德勒·布罗赫-鲍尔像》古斯塔夫·克里姆特，1907年。', '', 'sinaimg-/90b68290gy1fiyquqy5dkj213b13ch70.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503850662', '1504023458');
INSERT INTO `users_item` VALUES ('1290', '21', '0', '0', '1', '1503850723', '1503850723', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《吻》古斯塔夫·克里姆特，1907-08年。', '', 'sinaimg-/90b68290gy1fiyqwwroowj21kw1l2npd.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503850723', '1504023458');
INSERT INTO `users_item` VALUES ('1291', '21', '0', '0', '1', '1503851031', '1503851031', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《满足》古斯塔夫·克里姆特。', '', 'sinaimg-/90b68290gy1fiyqxbdsdcj21jk2ha7wi.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503851031', '1504023458');
INSERT INTO `users_item` VALUES ('1292', '21', '0', '0', '1', '1503851660', '1503851660', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《女人的三个阶段》 古斯塔夫·克里姆特，1905年。', '', 'sinaimg-/90b68290gy1fiyr6rqvh6j21k81k04av.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503851660', '1504023458');
INSERT INTO `users_item` VALUES ('1293', '21', '0', '0', '1', '1503851695', '1503851695', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《达娜厄》 古斯塔夫·克里姆特，1907年。', '', 'sinaimg-/90b68290gy1fiyr77km6zj21k81ign5e.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1503851695', '1504023458');
INSERT INTO `users_item` VALUES ('1294', '21', '0', '0', '0', '1504102367', '1504102367', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《自画像》 埃贡·席勒（奥地利），1912年。', '', 'sinaimg-/90b68290gy1fj23vqns0uj217s1j9qar.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1504102367', '1504102367');
INSERT INTO `users_item` VALUES ('1295', '21', '0', '0', '0', '1504102566', '1504102566', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《拥抱》 埃贡·席勒（奥地利），1917年。', '', 'sinaimg-/90b68290gy1fj23ymb2ptj21kw0xidrl.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1504102566', '1504102566');
INSERT INTO `users_item` VALUES ('1296', '21', '0', '0', '0', '1504102577', '1504102577', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《家庭》 埃贡·席勒（奥地利），1918年。', '', 'sinaimg-/90b68290gy1fj24148jfaj20ws0uk152.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1504102577', '1504102577');
INSERT INTO `users_item` VALUES ('1297', '21', '0', '0', '0', '1504103018', '1504103018', null, '1', '1', '11111', '11111', null, null, null, null, null, null, null, null, '《隐士》 埃贡·席勒（奥地利），1912年。', '', 'sinaimg-/90b68290gy1fj248qmgjcj20j60jpdhd.jpg', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1504103018', '1504103018');
INSERT INTO `users_item` VALUES ('1298', '41', '0', '0', '0', '1505398336', '1505398336', null, '1', '1', '126', '126', null, null, null, null, null, null, null, null, '', '我是那种为了100块钱的优惠券买1500块钱东西的人。\n却从没因为2块钱的彩票中过10块钱以上的奖。\n我以为我活明白了，觉得人啊，真是他妈的可笑——直到前几天喝6块钱的红牛中了136块钱。\n我的人生观崩塌了。\n觉得我啊，真是他妈的可笑——打从6岁第一回买彩票到现在的每一天都狠狠打了我一巴掌。\n妈卖批的排队打。', 'qingbo-/aff2356b3e4d5d697207097625778638.jpg<|>', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1505398336', '1505398336');
INSERT INTO `users_item` VALUES ('1299', '21', '0', '0', '0', '1505482512', '1505482512', null, '1', '1', '120', '120', null, null, null, null, null, null, null, null, '123', '123', 'qingbo-/f86371703585b0b77155be4caef3fd3c.jpg<|>', '', '', '0', '0', '0', null, null, null, null, null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '21', '0', null, '1505482512', '1505482512');
INSERT INTO `users_item` VALUES ('1300', '21', '0', '0', '0', '1509171236', '1509171236', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '英雄联盟全球总决赛半决赛 SKT - RNG', '腾讯体育直播：http://sports.qq.com/kbsweb/game.htm?mid=100002:24425', '', '', '', '0', '0', '1', '1', '1509175800', '0', '1509206399', null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1509171236', '1509171236');
INSERT INTO `users_item` VALUES ('1301', '21', '0', '0', '0', '1509171290', '1509171290', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '英雄联盟全球总决赛半决赛 WE - SSG', '腾讯体育直播：http://sports.qq.com/kbsweb/game.htm?mid=100002:24426', '', '', '', '0', '0', '1', '1', '1509262200', '0', '1509292799', null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1509171290', '1509171290');
INSERT INTO `users_item` VALUES ('1302', '21', '0', '0', '0', '1509771404', '1509771404', null, '1', '1', '1011', '1011', null, null, null, null, null, null, null, null, '英雄联盟全球总决赛 SKT - SSG', 'QQ视频直播：http://sports.qq.com/kbsweb/game.htm?mid=100002:25168', '', '', '', '0', '0', '1', '1', '1509778800', '0', '1509811199', null, '0', '0', null, '0', null, '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0.0', '100', '0', null, '1509771404', '1509771404');

-- ----------------------------
-- Table structure for users_test
-- ----------------------------
DROP TABLE IF EXISTS `users_test`;
CREATE TABLE `users_test` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `age` int(11) NOT NULL,
  `tip` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=382 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_test
-- ----------------------------
INSERT INTO `users_test` VALUES ('1', 'update', '16', null);
INSERT INTO `users_test` VALUES ('2', 'dafdf', '16', null);
INSERT INTO `users_test` VALUES ('281', 'sas', '17', '24');
INSERT INTO `users_test` VALUES ('375', 'sas', '17', '');
INSERT INTO `users_test` VALUES ('376', 'update', '16', '');
INSERT INTO `users_test` VALUES ('377', 'dafdf', '16', '');
INSERT INTO `users_test` VALUES ('378', 'sas', '17', '');
INSERT INTO `users_test` VALUES ('379', 'sas', '17', '');
INSERT INTO `users_test` VALUES ('380', 'sas', '17', '');
INSERT INTO `users_test` VALUES ('381', 'sas', '17', '24');
