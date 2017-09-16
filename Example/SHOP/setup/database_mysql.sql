-- --------------------------------------------------------

--
-- 表的结构 `shop_products`
--

DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE IF NOT EXISTS `shop_products` (
  `product_id` int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  `price` float NOT NULL default '0',
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `overview` mediumtext NOT NULL,
  `thumb_filename` varchar(255) default NULL,
  PRIMARY KEY  (`product_id`)
);

-- --------------------------------------------------------

--
-- 表的结构 `shop_products_to_classes`
--

DROP TABLE IF EXISTS `shop_products_to_classes`;
CREATE TABLE IF NOT EXISTS `shop_products_to_classes` (
  `product_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY  (`product_id`,`class_id`)
);

-- --------------------------------------------------------

--
-- 表的结构 `shop_product_classes`
--

DROP TABLE IF EXISTS `shop_product_classes`;
CREATE TABLE IF NOT EXISTS `shop_product_classes` (
  `class_id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `left_value` int(11) NOT NULL,
  `right_value` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY  (`class_id`),
  KEY `left_value` (`left_value`),
  KEY `right_value` (`right_value`),
  KEY `parent_id` (`parent_id`)
);

-- --------------------------------------------------------

--
-- 表的结构 `shop_product_photos`
--

DROP TABLE IF EXISTS `shop_product_photos`;
CREATE TABLE IF NOT EXISTS `shop_product_photos` (
  `photo_id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0',
  `photo_filename` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY  (`photo_id`),
  KEY `product_id` (`product_id`)
);

-- --------------------------------------------------------

--
-- 表的结构 `shop_sysroles`
--

DROP TABLE IF EXISTS `shop_sysroles`;
CREATE TABLE IF NOT EXISTS `shop_sysroles` (
  `role_id` int(11) NOT NULL auto_increment,
  `rolename` varchar(64) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY  (`role_id`)
);

--
-- 导出表中的数据 `shop_sysroles`
--

INSERT INTO `shop_sysroles` (`role_id`, `rolename`, `created`, `updated`) VALUES
(1, 'SYSTEM_ADMIN', 1160384341, 1160384341);

-- --------------------------------------------------------

--
-- 表的结构 `shop_sysusers`
--

DROP TABLE IF EXISTS `shop_sysusers`;
CREATE TABLE IF NOT EXISTS `shop_sysusers` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(32) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `email` varchar(128) NOT NULL default '',
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`)
);

--
-- 导出表中的数据 `shop_sysusers`
--

INSERT INTO `shop_sysusers` (`user_id`, `username`, `password`, `email`, `created`, `updated`) VALUES
(1, 'admin', '$1$.y3.ta3.$Jk5.iyx3OT9IZlhJ8CKQy/', 'admin@fleaphp.org', 1147346244, 1149173702);

-- --------------------------------------------------------

--
-- 表的结构 `shop_sysusers_has_sysroles`
--

DROP TABLE IF EXISTS `shop_sysusers_has_sysroles`;
CREATE TABLE IF NOT EXISTS `shop_sysusers_has_sysroles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
);

--
-- 导出表中的数据 `shop_sysusers_has_sysroles`
--

INSERT INTO `shop_sysusers_has_sysroles` (`user_id`, `role_id`) VALUES
(1, 1);
