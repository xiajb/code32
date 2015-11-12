CREATE TABLE  `ci_user` (
 `uid` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `username` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `password` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `email` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `money` VARCHAR( 50 ) NOT NULL DEFAULT  '0',
 `sex` TINYINT( 1 ) NOT NULL DEFAULT  '0',
 `vip` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `other` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `other2` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `other3` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `reg_time` DATE NOT NULL DEFAULT  '0000-00-00',
PRIMARY KEY (  `uid` )
) ENGINE = MYISAM CHARSET = utf8;