/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : framework

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2015-03-04 22:52:51
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `answers`
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question` bigint(20) NOT NULL,
  `answer` text NOT NULL,
  `ordered` bigint(20) NOT NULL DEFAULT '1',
  `enabled` int(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of answers
-- ----------------------------

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_content` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `ddate` varchar(50) NOT NULL,
  `ip` varchar(10) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `admin_note` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for `contacts`
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `gender` enum('m','f') NOT NULL DEFAULT 'f',
  `phone` varchar(255) DEFAULT NULL,
  `notes` mediumtext,
  `ddate` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `typee` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contacts
-- ----------------------------

-- ----------------------------
-- Table structure for `content`
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `parent` varchar(11) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `descr` text,
  `body` longtext,
  `language` int(3) NOT NULL,
  `is_control` int(1) NOT NULL DEFAULT '1',
  `menu` int(1) NOT NULL DEFAULT '1',
  `icon` varchar(255) DEFAULT 'dark_folder_image.png',
  `keywords` varchar(255) DEFAULT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `ordered` int(5) NOT NULL DEFAULT '1',
  `main` int(1) NOT NULL DEFAULT '1',
  `brand` varchar(11) DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT '1',
  `rating_score` int(11) NOT NULL DEFAULT '1',
  `rating_no` int(11) NOT NULL DEFAULT '1',
  `permission` int(1) NOT NULL DEFAULT '1',
  `_date` date DEFAULT NULL,
  `_author` varchar(255) DEFAULT '',
  `_file` varchar(255) DEFAULT NULL,
  `footer_menu` int(1) NOT NULL DEFAULT '1',
  `header_menu` int(1) NOT NULL DEFAULT '1',
  `ads` int(1) NOT NULL DEFAULT '1',
  `marquee` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14805 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('318', '', 'sec', 'About RLC', 'About RLC', null, '1', '1', '2', 'dark_folder_image.png', 'About RLC', '2', '10', '1', '', '368', '2', '1', '1', null, '', null, '1', '1', '1', '0');
INSERT INTO `content` VALUES ('323', '318', 'link', 'RSS', 'RSS', 'rss.php?l=1', '1', '1', '2', 'dark_folder_image.png', 'RSS', '2', '8', '1', '', '449', '2', '1', '1', null, '', null, '1', '1', '1', '0');
INSERT INTO `content` VALUES ('334', '318', 'ext', 'join us', 'join us for our newsletter', 'join', '1', '1', '2', 'dark_folder_image.png', 'join', '2', '14', '1', '', '519', '2', '1', '1', null, '', null, '2', '1', '1', '1');
INSERT INTO `content` VALUES ('388', '318', 'body', 'About us', 'about us', '<p>\r\n	About us</p>\r\n', '1', '1', '2', 'dark_folder_image.png', 'about us', '2', '30', '2', '', '6865', '2', '1', '1', null, '', null, '1', '2', '1', '2');
INSERT INTO `content` VALUES ('391', '318', 'ext', 'Sitemap', 'sitemap', 'map', '1', '1', '2', '/images/sitemap.png', 'sitemap', '2', '16', '1', '', '388', '2', '1', '1', null, '', null, '2', '1', '2', '1');
INSERT INTO `content` VALUES ('392', '318', 'ext', 'Contact Us', 'contact us', 'contactus', '1', '1', '2', 'dark_folder_image.png', 'contact us', '2', '17', '1', '', '671', '2', '1', '1', null, '', null, '2', '2', '1', '1');
INSERT INTO `content` VALUES ('14799', '', 'sec', 'من نحن', 'حول من نحن', null, '2', '1', '2', 'dark_folder_image.png', 'حول،من نحن', '2', '1', '1', '', '6', '1', '1', '1', null, '', null, '2', '2', '1', '2');
INSERT INTO `content` VALUES ('14800', '14799', 'body', 'حول المشروع', 'حول المشروع', '<p dir=\"rtl\">\r\n	<strong><span style=\"font-size: 16px\"><span style=\"color: #696969\">نموذج</span></span></strong></p>\r\n', '2', '2', '2', 'dark_folder_image.png', 'حول المشروع', '2', '1', '2', '', '9', '1', '1', '1', null, '', null, '2', '2', '1', '2');
INSERT INTO `content` VALUES ('14801', '14799', 'ext', 'RSS', 'RSS', 'rss_', '2', '1', '2', 'dark_folder_image.png', 'RSS', '2', '2', '1', '', '1', '1', '1', '1', null, '', null, '2', '1', '1', '1');
INSERT INTO `content` VALUES ('14802', '14799', 'ext', 'انضم لقائمتنا البريدية', 'انضم لقائمتنا البريدية', 'join', '2', '1', '2', 'dark_folder_image.png', 'القائمة البريدية، انضم', '2', '3', '1', '', '1', '1', '1', '1', null, '', null, '2', '1', '1', '2');
INSERT INTO `content` VALUES ('14803', '14799', 'ext', 'خريطة الموقع', 'خريطة الموقع', 'map', '2', '1', '2', '/images/sitemap.png', 'خريطة الموقع', '2', '4', '1', '', '1', '1', '1', '1', null, '', null, '2', '1', '2', '1');
INSERT INTO `content` VALUES ('14804', '14799', 'ext', 'اتصل بنا', 'اتصل بنا', 'contactus', '2', '1', '2', 'dark_folder_image.png', 'اتصل بنا', '2', '5', '1', '', '4', '1', '1', '1', null, '', null, '2', '2', '1', '1');

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `country_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=493 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('247', 'AF', 'Afghanistan', '2');
INSERT INTO `countries` VALUES ('248', 'AL', 'Albania', '2');
INSERT INTO `countries` VALUES ('249', 'DZ', 'Algeria', '2');
INSERT INTO `countries` VALUES ('250', 'AS', 'American Samoa', '2');
INSERT INTO `countries` VALUES ('251', 'AD', 'Andorra', '2');
INSERT INTO `countries` VALUES ('252', 'AO', 'Angola', '2');
INSERT INTO `countries` VALUES ('253', 'AI', 'Anguilla', '2');
INSERT INTO `countries` VALUES ('254', 'AQ', 'Antarctica', '2');
INSERT INTO `countries` VALUES ('255', 'AG', 'Antigua And Barbuda', '2');
INSERT INTO `countries` VALUES ('256', 'AR', 'Argentina', '2');
INSERT INTO `countries` VALUES ('257', 'AM', 'Armenia', '2');
INSERT INTO `countries` VALUES ('258', 'AW', 'Aruba', '2');
INSERT INTO `countries` VALUES ('259', 'AU', 'Australia', '2');
INSERT INTO `countries` VALUES ('260', 'AT', 'Austria', '2');
INSERT INTO `countries` VALUES ('261', 'AZ', 'Azerbaijan', '2');
INSERT INTO `countries` VALUES ('262', 'BS', 'Bahamas', '2');
INSERT INTO `countries` VALUES ('263', 'BH', 'Bahrain', '2');
INSERT INTO `countries` VALUES ('264', 'BD', 'Bangladesh', '2');
INSERT INTO `countries` VALUES ('265', 'BB', 'Barbados', '2');
INSERT INTO `countries` VALUES ('266', 'BY', 'Belarus', '2');
INSERT INTO `countries` VALUES ('267', 'BE', 'Belgium', '2');
INSERT INTO `countries` VALUES ('268', 'BZ', 'Belize', '2');
INSERT INTO `countries` VALUES ('269', 'BJ', 'Benin', '2');
INSERT INTO `countries` VALUES ('270', 'BM', 'Bermuda', '2');
INSERT INTO `countries` VALUES ('271', 'BT', 'Bhutan', '2');
INSERT INTO `countries` VALUES ('272', 'BO', 'Bolivia, Plurinational State Of', '2');
INSERT INTO `countries` VALUES ('273', 'BA', 'Bosnia And Herzegovina', '2');
INSERT INTO `countries` VALUES ('274', 'BW', 'Botswana', '2');
INSERT INTO `countries` VALUES ('275', 'BV', 'Bouvet Island', '2');
INSERT INTO `countries` VALUES ('276', 'BR', 'Brazil', '2');
INSERT INTO `countries` VALUES ('277', 'IO', 'British Indian Ocean Territory', '2');
INSERT INTO `countries` VALUES ('278', 'BN', 'Brunei Darussalam', '2');
INSERT INTO `countries` VALUES ('279', 'BG', 'Bulgaria', '2');
INSERT INTO `countries` VALUES ('280', 'BF', 'Burkina Faso', '2');
INSERT INTO `countries` VALUES ('281', 'BI', 'Burundi', '2');
INSERT INTO `countries` VALUES ('282', 'KH', 'Cambodia', '2');
INSERT INTO `countries` VALUES ('283', 'CM', 'Cameroon', '2');
INSERT INTO `countries` VALUES ('284', 'CA', 'Canada', '2');
INSERT INTO `countries` VALUES ('285', 'CV', 'Cape Verde', '2');
INSERT INTO `countries` VALUES ('286', 'KY', 'Cayman Islands', '2');
INSERT INTO `countries` VALUES ('287', 'CF', 'Central African Republic', '2');
INSERT INTO `countries` VALUES ('288', 'TD', 'Chad', '2');
INSERT INTO `countries` VALUES ('289', 'CL', 'Chile', '2');
INSERT INTO `countries` VALUES ('290', 'CN', 'China', '2');
INSERT INTO `countries` VALUES ('291', 'CX', 'Christmas Island', '2');
INSERT INTO `countries` VALUES ('292', 'CC', 'Cocos (Keeling) Islands', '2');
INSERT INTO `countries` VALUES ('293', 'CO', 'Colombia', '2');
INSERT INTO `countries` VALUES ('294', 'KM', 'Comoros', '2');
INSERT INTO `countries` VALUES ('295', 'CG', 'Congo', '2');
INSERT INTO `countries` VALUES ('296', 'CD', 'Congo, The Democratic Republic Of The', '2');
INSERT INTO `countries` VALUES ('297', 'CK', 'Cook Islands', '2');
INSERT INTO `countries` VALUES ('298', 'CR', 'Costa Rica', '2');
INSERT INTO `countries` VALUES ('299', 'CI', 'CÃ´te D\'Ivoire', '2');
INSERT INTO `countries` VALUES ('300', 'HR', 'Croatia', '2');
INSERT INTO `countries` VALUES ('301', 'CU', 'Cuba', '2');
INSERT INTO `countries` VALUES ('302', 'CY', 'Cyprus', '2');
INSERT INTO `countries` VALUES ('303', 'CZ', 'Czech Republic', '2');
INSERT INTO `countries` VALUES ('304', 'DK', 'Denmark', '2');
INSERT INTO `countries` VALUES ('305', 'DJ', 'Djibouti', '2');
INSERT INTO `countries` VALUES ('306', 'DM', 'Dominica', '2');
INSERT INTO `countries` VALUES ('307', 'DO', 'Dominican Republic', '2');
INSERT INTO `countries` VALUES ('308', 'EC', 'Ecuador', '2');
INSERT INTO `countries` VALUES ('309', 'EG', 'Egypt', '2');
INSERT INTO `countries` VALUES ('310', 'SV', 'El Salvador', '2');
INSERT INTO `countries` VALUES ('311', 'GQ', 'Equatorial Guinea', '2');
INSERT INTO `countries` VALUES ('312', 'ER', 'Eritrea', '2');
INSERT INTO `countries` VALUES ('313', 'EE', 'Estonia', '2');
INSERT INTO `countries` VALUES ('314', 'ET', 'Ethiopia', '2');
INSERT INTO `countries` VALUES ('315', 'FK', 'Falkland Islands (Malvinas)', '2');
INSERT INTO `countries` VALUES ('316', 'FO', 'Faroe Islands', '2');
INSERT INTO `countries` VALUES ('317', 'FJ', 'Fiji', '2');
INSERT INTO `countries` VALUES ('318', 'FI', 'Finland', '2');
INSERT INTO `countries` VALUES ('319', 'FR', 'France', '2');
INSERT INTO `countries` VALUES ('320', 'GF', 'French Guiana', '2');
INSERT INTO `countries` VALUES ('321', 'PF', 'French Polynesia', '2');
INSERT INTO `countries` VALUES ('322', 'TF', 'French Southern Territories', '2');
INSERT INTO `countries` VALUES ('323', 'GA', 'Gabon', '2');
INSERT INTO `countries` VALUES ('324', 'GM', 'Gambia', '2');
INSERT INTO `countries` VALUES ('325', 'GE', 'Georgia', '2');
INSERT INTO `countries` VALUES ('326', 'DE', 'Germany', '2');
INSERT INTO `countries` VALUES ('327', 'GH', 'Ghana', '2');
INSERT INTO `countries` VALUES ('328', 'GI', 'Gibraltar', '2');
INSERT INTO `countries` VALUES ('329', 'GR', 'Greece', '2');
INSERT INTO `countries` VALUES ('330', 'GL', 'Greenland', '2');
INSERT INTO `countries` VALUES ('331', 'GD', 'Grenada', '2');
INSERT INTO `countries` VALUES ('332', 'GP', 'Guadeloupe', '2');
INSERT INTO `countries` VALUES ('333', 'GU', 'Guam', '2');
INSERT INTO `countries` VALUES ('334', 'GT', 'Guatemala', '2');
INSERT INTO `countries` VALUES ('335', 'GG', 'Guernsey', '2');
INSERT INTO `countries` VALUES ('336', 'GN', 'Guinea', '2');
INSERT INTO `countries` VALUES ('337', 'GW', 'Guinea-Bissau', '2');
INSERT INTO `countries` VALUES ('338', 'GY', 'Guyana', '2');
INSERT INTO `countries` VALUES ('339', 'HT', 'Haiti', '2');
INSERT INTO `countries` VALUES ('340', 'HM', 'Heard Island And Mcdonald Islands', '2');
INSERT INTO `countries` VALUES ('341', 'HN', 'Honduras', '2');
INSERT INTO `countries` VALUES ('342', 'HK', 'Hong Kong', '2');
INSERT INTO `countries` VALUES ('343', 'HU', 'Hungary', '2');
INSERT INTO `countries` VALUES ('344', 'IS', 'Iceland', '2');
INSERT INTO `countries` VALUES ('345', 'IN', 'India', '2');
INSERT INTO `countries` VALUES ('346', 'ID', 'Indonesia', '2');
INSERT INTO `countries` VALUES ('347', 'IR', 'Iran, Islamic Republic Of', '2');
INSERT INTO `countries` VALUES ('348', 'IQ', 'Iraq', '2');
INSERT INTO `countries` VALUES ('349', 'IE', 'Ireland', '2');
INSERT INTO `countries` VALUES ('350', 'IM', 'Isle Of Man', '2');
INSERT INTO `countries` VALUES ('351', 'IL', 'Israel', '1');
INSERT INTO `countries` VALUES ('352', 'IT', 'Italy', '2');
INSERT INTO `countries` VALUES ('353', 'JM', 'Jamaica', '2');
INSERT INTO `countries` VALUES ('354', 'JP', 'Japan', '2');
INSERT INTO `countries` VALUES ('355', 'JE', 'Jersey', '2');
INSERT INTO `countries` VALUES ('356', 'JO', 'Jordan', '2');
INSERT INTO `countries` VALUES ('357', 'KZ', 'Kazakhstan', '2');
INSERT INTO `countries` VALUES ('358', 'KE', 'Kenya', '2');
INSERT INTO `countries` VALUES ('359', 'KI', 'Kiribati', '2');
INSERT INTO `countries` VALUES ('360', 'KP', 'Korea, Democratic People\'s Republic Of', '2');
INSERT INTO `countries` VALUES ('361', 'KR', 'Korea, Republic Of', '2');
INSERT INTO `countries` VALUES ('362', 'KW', 'Kuwait', '2');
INSERT INTO `countries` VALUES ('363', 'KG', 'Kyrgyzstan', '2');
INSERT INTO `countries` VALUES ('364', 'LA', 'Lao People\'s Democratic Republic', '2');
INSERT INTO `countries` VALUES ('365', 'LV', 'Latvia', '2');
INSERT INTO `countries` VALUES ('366', 'LB', 'Lebanon', '2');
INSERT INTO `countries` VALUES ('367', 'LS', 'Lesotho', '2');
INSERT INTO `countries` VALUES ('368', 'LR', 'Liberia', '2');
INSERT INTO `countries` VALUES ('369', 'LY', 'Libyan Arab Jamahiriya', '2');
INSERT INTO `countries` VALUES ('370', 'LI', 'Liechtenstein', '2');
INSERT INTO `countries` VALUES ('371', 'LT', 'Lithuania', '2');
INSERT INTO `countries` VALUES ('372', 'LU', 'Luxembourg', '2');
INSERT INTO `countries` VALUES ('373', 'MO', 'Macao', '2');
INSERT INTO `countries` VALUES ('374', 'MK', 'Macedonia, The Former Yugoslav Republic Of', '2');
INSERT INTO `countries` VALUES ('375', 'MG', 'Madagascar', '2');
INSERT INTO `countries` VALUES ('376', 'MW', 'Malawi', '2');
INSERT INTO `countries` VALUES ('377', 'MY', 'Malaysia', '2');
INSERT INTO `countries` VALUES ('378', 'MV', 'Maldives', '2');
INSERT INTO `countries` VALUES ('379', 'ML', 'Mali', '2');
INSERT INTO `countries` VALUES ('380', 'MT', 'Malta', '2');
INSERT INTO `countries` VALUES ('381', 'MH', 'Marshall Islands', '2');
INSERT INTO `countries` VALUES ('382', 'MQ', 'Martinique', '2');
INSERT INTO `countries` VALUES ('383', 'MR', 'Mauritania', '2');
INSERT INTO `countries` VALUES ('384', 'MU', 'Mauritius', '2');
INSERT INTO `countries` VALUES ('385', 'YT', 'Mayotte', '2');
INSERT INTO `countries` VALUES ('386', 'MX', 'Mexico', '2');
INSERT INTO `countries` VALUES ('387', 'FM', 'Micronesia, Federated States Of', '2');
INSERT INTO `countries` VALUES ('388', 'MD', 'Moldova, Republic Of', '2');
INSERT INTO `countries` VALUES ('389', 'MC', 'Monaco', '2');
INSERT INTO `countries` VALUES ('390', 'MN', 'Mongolia', '2');
INSERT INTO `countries` VALUES ('391', 'ME', 'Montenegro', '2');
INSERT INTO `countries` VALUES ('392', 'MS', 'Montserrat', '2');
INSERT INTO `countries` VALUES ('393', 'MA', 'Morocco', '2');
INSERT INTO `countries` VALUES ('394', 'MZ', 'Mozambique', '2');
INSERT INTO `countries` VALUES ('395', 'MM', 'Myanmar', '2');
INSERT INTO `countries` VALUES ('396', 'NA', 'Namibia', '2');
INSERT INTO `countries` VALUES ('397', 'NR', 'Nauru', '2');
INSERT INTO `countries` VALUES ('398', 'NP', 'Nepal', '2');
INSERT INTO `countries` VALUES ('399', 'NL', 'Netherlands', '2');
INSERT INTO `countries` VALUES ('400', 'AN', 'Netherlands Antilles', '2');
INSERT INTO `countries` VALUES ('401', 'NC', 'New Caledonia', '2');
INSERT INTO `countries` VALUES ('402', 'NZ', 'New Zealand', '2');
INSERT INTO `countries` VALUES ('403', 'NI', 'Nicaragua', '2');
INSERT INTO `countries` VALUES ('404', 'NE', 'Niger', '2');
INSERT INTO `countries` VALUES ('405', 'NG', 'Nigeria', '2');
INSERT INTO `countries` VALUES ('406', 'NU', 'Niue', '2');
INSERT INTO `countries` VALUES ('407', 'NF', 'Norfolk Island', '2');
INSERT INTO `countries` VALUES ('408', 'MP', 'Northern Mariana Islands', '2');
INSERT INTO `countries` VALUES ('409', 'NO', 'Norway', '2');
INSERT INTO `countries` VALUES ('410', 'OM', 'Oman', '2');
INSERT INTO `countries` VALUES ('411', 'PK', 'Pakistan', '2');
INSERT INTO `countries` VALUES ('412', 'PW', 'Palau', '2');
INSERT INTO `countries` VALUES ('413', 'PS', 'Palestinian Territory, Occupied', '2');
INSERT INTO `countries` VALUES ('414', 'PA', 'Panama', '2');
INSERT INTO `countries` VALUES ('415', 'PG', 'Papua New Guinea', '2');
INSERT INTO `countries` VALUES ('416', 'PY', 'Paraguay', '2');
INSERT INTO `countries` VALUES ('417', 'PE', 'Peru', '2');
INSERT INTO `countries` VALUES ('418', 'PH', 'Philippines', '2');
INSERT INTO `countries` VALUES ('419', 'PN', 'Pitcairn', '2');
INSERT INTO `countries` VALUES ('420', 'PL', 'Poland', '2');
INSERT INTO `countries` VALUES ('421', 'PT', 'Portugal', '2');
INSERT INTO `countries` VALUES ('422', 'PR', 'Puerto Rico', '2');
INSERT INTO `countries` VALUES ('423', 'QA', 'Qatar', '2');
INSERT INTO `countries` VALUES ('424', 'RE', 'RÃ©union', '2');
INSERT INTO `countries` VALUES ('425', 'RO', 'Romania', '2');
INSERT INTO `countries` VALUES ('426', 'RU', 'Russian Federation', '2');
INSERT INTO `countries` VALUES ('427', 'RW', 'Rwanda', '2');
INSERT INTO `countries` VALUES ('428', 'BL', 'Saint BarthÃ©lemy', '2');
INSERT INTO `countries` VALUES ('429', 'SH', 'Saint Helena, Ascension And Tristan Da Cunha', '2');
INSERT INTO `countries` VALUES ('430', 'KN', 'Saint Kitts And Nevis', '2');
INSERT INTO `countries` VALUES ('431', 'LC', 'Saint Lucia', '2');
INSERT INTO `countries` VALUES ('432', 'MF', 'Saint Martin', '2');
INSERT INTO `countries` VALUES ('433', 'PM', 'Saint Pierre And Miquelon', '2');
INSERT INTO `countries` VALUES ('434', 'VC', 'Saint Vincent And The Grenadines', '2');
INSERT INTO `countries` VALUES ('435', 'WS', 'Samoa', '2');
INSERT INTO `countries` VALUES ('436', 'SM', 'San Marino', '2');
INSERT INTO `countries` VALUES ('437', 'ST', 'Sao Tome And Principe', '2');
INSERT INTO `countries` VALUES ('438', 'SA', 'Saudi Arabia', '2');
INSERT INTO `countries` VALUES ('439', 'SN', 'Senegal', '2');
INSERT INTO `countries` VALUES ('440', 'RS', 'Serbia', '2');
INSERT INTO `countries` VALUES ('441', 'SC', 'Seychelles', '2');
INSERT INTO `countries` VALUES ('442', 'SL', 'Sierra Leone', '2');
INSERT INTO `countries` VALUES ('443', 'SG', 'Singapore', '2');
INSERT INTO `countries` VALUES ('444', 'SK', 'Slovakia', '2');
INSERT INTO `countries` VALUES ('445', 'SI', 'Slovenia', '2');
INSERT INTO `countries` VALUES ('446', 'SB', 'Solomon Islands', '2');
INSERT INTO `countries` VALUES ('447', 'SO', 'Somalia', '2');
INSERT INTO `countries` VALUES ('448', 'ZA', 'South Africa', '2');
INSERT INTO `countries` VALUES ('449', 'GS', 'South Georgia And The South Sandwich Islands', '2');
INSERT INTO `countries` VALUES ('450', 'ES', 'Spain', '2');
INSERT INTO `countries` VALUES ('451', 'LK', 'Sri Lanka', '2');
INSERT INTO `countries` VALUES ('452', 'SD', 'Sudan', '2');
INSERT INTO `countries` VALUES ('453', 'SR', 'Suriname', '2');
INSERT INTO `countries` VALUES ('454', 'SJ', 'Svalbard And Jan Mayen', '2');
INSERT INTO `countries` VALUES ('455', 'SZ', 'Swaziland', '2');
INSERT INTO `countries` VALUES ('456', 'SE', 'Sweden', '2');
INSERT INTO `countries` VALUES ('457', 'CH', 'Switzerland', '2');
INSERT INTO `countries` VALUES ('458', 'SY', 'Syrian Arab Republic', '2');
INSERT INTO `countries` VALUES ('459', 'TW', 'Taiwan, Province Of China', '2');
INSERT INTO `countries` VALUES ('460', 'TJ', 'Tajikistan', '2');
INSERT INTO `countries` VALUES ('461', 'TZ', 'Tanzania, United Republic Of', '2');
INSERT INTO `countries` VALUES ('462', 'TH', 'Thailand', '2');
INSERT INTO `countries` VALUES ('463', 'TL', 'Timor-Leste', '2');
INSERT INTO `countries` VALUES ('464', 'TG', 'Togo', '2');
INSERT INTO `countries` VALUES ('465', 'TK', 'Tokelau', '2');
INSERT INTO `countries` VALUES ('466', 'TO', 'Tonga', '2');
INSERT INTO `countries` VALUES ('467', 'TT', 'Trinidad And Tobago', '2');
INSERT INTO `countries` VALUES ('468', 'TN', 'Tunisia', '2');
INSERT INTO `countries` VALUES ('469', 'TR', 'Turkey', '2');
INSERT INTO `countries` VALUES ('470', 'TM', 'Turkmenistan', '2');
INSERT INTO `countries` VALUES ('471', 'TC', 'Turks And Caicos Islands', '2');
INSERT INTO `countries` VALUES ('472', 'TV', 'Tuvalu', '2');
INSERT INTO `countries` VALUES ('473', 'UG', 'Uganda', '2');
INSERT INTO `countries` VALUES ('474', 'UA', 'Ukraine', '2');
INSERT INTO `countries` VALUES ('475', 'AE', 'United Arab Emirates', '2');
INSERT INTO `countries` VALUES ('476', 'GB', 'United Kingdom', '2');
INSERT INTO `countries` VALUES ('477', 'US', 'United States', '2');
INSERT INTO `countries` VALUES ('478', 'UM', 'United States Minor Outlying Islands', '2');
INSERT INTO `countries` VALUES ('479', 'UY', 'Uruguay', '2');
INSERT INTO `countries` VALUES ('480', 'UZ', 'Uzbekistan', '2');
INSERT INTO `countries` VALUES ('481', 'VU', 'Vanuatu', '2');
INSERT INTO `countries` VALUES ('482', 'VA', 'Vatican City State', '2');
INSERT INTO `countries` VALUES ('483', 'VE', 'Venezuela, Bolivarian Republic Of', '2');
INSERT INTO `countries` VALUES ('484', 'VN', 'Viet Nam', '2');
INSERT INTO `countries` VALUES ('485', 'VG', 'Virgin Islands, British', '2');
INSERT INTO `countries` VALUES ('486', 'VI', 'Virgin Islands, U.S.', '2');
INSERT INTO `countries` VALUES ('487', 'WF', 'Wallis And Futuna', '2');
INSERT INTO `countries` VALUES ('488', 'EH', 'Western Sahara', '2');
INSERT INTO `countries` VALUES ('489', 'YE', 'Yemen', '2');
INSERT INTO `countries` VALUES ('490', 'ZM', 'Zambia', '2');
INSERT INTO `countries` VALUES ('491', 'ZW', 'Zimbabwe', '2');
INSERT INTO `countries` VALUES ('492', 'AX', 'Ã…land Islands', '2');

-- ----------------------------
-- Table structure for `forms`
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` int(1) NOT NULL,
  `ordered` int(3) NOT NULL DEFAULT '1',
  `evaluation` int(11) NOT NULL DEFAULT '0',
  `permission` int(1) NOT NULL DEFAULT '2',
  `intro` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forms
-- ----------------------------

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `enabled` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'الناطقين', '2');
INSERT INTO `groups` VALUES ('3', 'المقيمين', '2');

-- ----------------------------
-- Table structure for `groups_forms`
-- ----------------------------
DROP TABLE IF EXISTS `groups_forms`;
CREATE TABLE `groups_forms` (
  `groups` int(11) NOT NULL,
  `forms` int(11) NOT NULL,
  PRIMARY KEY (`groups`,`forms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups_forms
-- ----------------------------
INSERT INTO `groups_forms` VALUES ('3', '6');

-- ----------------------------
-- Table structure for `groups_members`
-- ----------------------------
DROP TABLE IF EXISTS `groups_members`;
CREATE TABLE `groups_members` (
  `groups` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  PRIMARY KEY (`groups`,`members`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups_members
-- ----------------------------
INSERT INTO `groups_members` VALUES ('1', '39');
INSERT INTO `groups_members` VALUES ('1', '40');
INSERT INTO `groups_members` VALUES ('3', '1');

-- ----------------------------
-- Table structure for `groups_news`
-- ----------------------------
DROP TABLE IF EXISTS `groups_news`;
CREATE TABLE `groups_news` (
  `groups` int(11) NOT NULL,
  `news` int(11) NOT NULL,
  PRIMARY KEY (`groups`,`news`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups_news
-- ----------------------------
INSERT INTO `groups_news` VALUES ('1', '2504');
INSERT INTO `groups_news` VALUES ('1', '2510');
INSERT INTO `groups_news` VALUES ('1', '3538');
INSERT INTO `groups_news` VALUES ('3', '2504');
INSERT INTO `groups_news` VALUES ('3', '2510');
INSERT INTO `groups_news` VALUES ('3', '3538');
INSERT INTO `groups_news` VALUES ('3', '3752');

-- ----------------------------
-- Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sitename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `shortcut` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT 'en',
  `flag` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `default` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', 'Home', 'framework', '2', 'en', null, 'framework', 'framework', '2');
INSERT INTO `languages` VALUES ('2', 'الرئيسية', 'نموذج', '2', 'ar', null, 'نموذج', 'نموذج', '1');

-- ----------------------------
-- Table structure for `members`
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `ddate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES ('46', 'test', 'test', 'test1', 'hikmat.salman62@gmail.com', '', '2', '1360871617');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `descc` varchar(255) DEFAULT NULL,
  `body` text,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for `newsletter`
-- ----------------------------
DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `gender` enum('m','f') NOT NULL DEFAULT 'f',
  `phone` varchar(255) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `ddate` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of newsletter
-- ----------------------------

-- ----------------------------
-- Table structure for `news_type`
-- ----------------------------
DROP TABLE IF EXISTS `news_type`;
CREATE TABLE `news_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` int(1) NOT NULL,
  `ordered` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_type
-- ----------------------------
INSERT INTO `news_type` VALUES ('7', 'غير ذلك', '2', '10');

-- ----------------------------
-- Table structure for `questions`
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form` bigint(20) NOT NULL,
  `question` text NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `enabled` int(1) NOT NULL DEFAULT '2',
  `ordered` int(11) NOT NULL DEFAULT '1',
  `group` int(11) DEFAULT NULL,
  `intro` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions
-- ----------------------------

-- ----------------------------
-- Table structure for `results`
-- ----------------------------
DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `session` bigint(20) NOT NULL,
  `question` bigint(20) NOT NULL,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of results
-- ----------------------------

-- ----------------------------
-- Table structure for `search_words`
-- ----------------------------
DROP TABLE IF EXISTS `search_words`;
CREATE TABLE `search_words` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `q` varchar(50) NOT NULL DEFAULT '',
  `search_time` datetime NOT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `results` int(11) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '2',
  `language` tinyint(3) DEFAULT NULL,
  `no` bigint(22) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `q` (`q`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of search_words
-- ----------------------------

-- ----------------------------
-- Table structure for `search_words_old`
-- ----------------------------
DROP TABLE IF EXISTS `search_words_old`;
CREATE TABLE `search_words_old` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `q` varchar(50) NOT NULL DEFAULT '',
  `search_time` datetime NOT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `results` int(11) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '2',
  `language` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of search_words_old
-- ----------------------------

-- ----------------------------
-- Table structure for `send_mail`
-- ----------------------------
DROP TABLE IF EXISTS `send_mail`;
CREATE TABLE `send_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `sent` int(1) NOT NULL,
  `body` longtext,
  `sent_date` datetime DEFAULT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of send_mail
-- ----------------------------

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `forms` int(11) NOT NULL,
  `device` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `referrer_page` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `spokesman` varchar(50) DEFAULT NULL,
  `member` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for `towns`
-- ----------------------------
DROP TABLE IF EXISTS `towns`;
CREATE TABLE `towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of towns
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) CHARACTER SET cp1256 NOT NULL,
  `pass` varchar(255) CHARACTER SET cp1256 NOT NULL,
  `perm` varchar(20) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('6', 'manager', '202cb962ac59075b964b07152d234b70', 'manager', '2');
INSERT INTO `users` VALUES ('34', 'test', '098f6bcd4621d373cade4e832627b4f6', 'supervisor', '2');

-- ----------------------------
-- Table structure for `vote`
-- ----------------------------
DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `an1` varchar(255) NOT NULL,
  `an2` varchar(255) NOT NULL,
  `an3` varchar(255) DEFAULT NULL,
  `an4` varchar(255) DEFAULT NULL,
  `an5` varchar(255) DEFAULT NULL,
  `an6` varchar(255) DEFAULT NULL,
  `an7` varchar(255) DEFAULT NULL,
  `an8` varchar(255) DEFAULT NULL,
  `an9` varchar(255) DEFAULT NULL,
  `an10` varchar(255) DEFAULT NULL,
  `vo1` int(11) NOT NULL,
  `vo2` int(11) NOT NULL,
  `vo3` int(11) DEFAULT NULL,
  `vo4` int(11) DEFAULT NULL,
  `vo5` int(11) DEFAULT NULL,
  `vo6` int(11) DEFAULT NULL,
  `vo7` int(11) DEFAULT NULL,
  `vo8` int(11) DEFAULT NULL,
  `vo9` int(11) DEFAULT NULL,
  `vo10` int(11) DEFAULT NULL,
  `voters` int(11) NOT NULL,
  `enabled` int(11) NOT NULL,
  `insertdate` varchar(250) NOT NULL,
  `siteId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote
-- ----------------------------
INSERT INTO `vote` VALUES ('1', 'هل تحب الصيف أكثر أم الشتاء؟', 'الصيف', 'الشتاء', 'كليهما', 'لا أحبهما', '', '', '', '', '', '', '16', '19', '18', '9', '4', '1', '2', '0', '0', '0', '67', '2', '1970/1/1 0-32-49', '2');
