DROP TABLE IF EXISTS `import_data`;

CREATE TABLE IF NOT EXISTS `import_data` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(32) NOT NULL,
  `level_ix` smallint(6) NOT NULL,
  `credits` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);

