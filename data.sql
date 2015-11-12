DROP TABLE IF EXISTS ci_user;
CREATE TABLE `ci_user` (
  `uid` mediumint(7) unsigned NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `money` varchar(50) NOT NULL default '',
  `sex` tinyint(1) NOT NULL default '0',
  `vip` varchar(50) NOT NULL default '',
  `time` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`uid`)
) TYPE=MyISAM;

