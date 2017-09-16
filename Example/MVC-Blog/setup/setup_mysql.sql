-- --------------------------------------------------------

--
-- 表的结构 `mvcblog_posts`
--

DROP TABLE IF EXISTS `mvcblog_posts`;
CREATE TABLE IF NOT EXISTS `mvcblog_posts` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`)
);

--
-- 导出表中的数据 `mvcblog_posts`
--

INSERT INTO `mvcblog_posts` (`id`, `title`, `body`, `created`, `updated`) VALUES(1, '标题1', '内容1', '2007-09-28 09:11:37', '2007-09-28 09:11:37');
INSERT INTO `mvcblog_posts` (`id`, `title`, `body`, `created`, `updated`) VALUES(2, '标题2', '内容2', '2007-09-28 09:11:37', '2007-09-28 09:11:37');
INSERT INTO `mvcblog_posts` (`id`, `title`, `body`, `created`, `updated`) VALUES(3, '标题3', '内容3', '2007-09-28 09:11:37', '2007-09-28 09:11:37');
