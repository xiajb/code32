CREATE TABLE  `ci_user` (
 `uid` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `nickname` VARCHAR( 16 ) NOT NULL,
 `phone` VARCHAR( 11 ) NOT NULL,
 `password` VARCHAR( 50 ) NOT NULL,
 `email` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `sex` TINYINT( 1 ) NOT NULL DEFAULT  '0',
 `pic` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '头像路径',
 `vip` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `other2` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `other3` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `reg_time` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '注册时间',--用datetime比较好
PRIMARY KEY (  `uid` )
) ENGINE = MYISAM CHARSET = utf8;



-- 订单表
CREATE TABLE  `ci_indent` (
 `did` mediumint(7) unsigned NOT NULL auto_increment default '0',
 `uid` int(10) unsigned NOT NULL default '0' COMMENT '用户id',
 `kid` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '课程id',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `starttime` VARCHAR( 50 ) NOT NULL DEFAULT '0000-00-00' COMMENT '下单时间',
 `status` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '状态',
PRIMARY KEY (  `gid` )
) ENGINE = MYISAM CHARSET = utf8;


-- //流水细明
CREATE TABLE  `ci_blance` (
 `mid` mediumint(7) unsigned NOT NULL auto_increment default '0',
 `uid` int(10) unsigned NOT NULL default '0' COMMENT '用户id',
 `pay` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '支付',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `datetime` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '时间',--时间都弄细一点
PRIMARY KEY (  `mid` )
) ENGINE = MYISAM CHARSET = utf8;


-- //课程
CREATE TABLE  `ci_course` (
 `kid` mediumint(7) unsigned NOT NULL auto_increment default '0',
 `sid` int(10) unsigned NOT NULL default '0',
 `title` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '标题',
 `detail` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '介绍',
 `teacher` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '老师',
 `grade` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '年级',
 `subject` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '科目',
 `difficulty` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '难度',
PRIMARY KEY (  `kid` )
) ENGINE = MYISAM CHARSET = utf8;


-- //课小结表
CREATE TABLE  `ci_nodulus` (
 `sid` mediumint(7) unsigned NOT NULL auto_increment default '0',
 `kid` int(10) unsigned NOT NULL default '0' COMMENT '课程id',
 `uid` int(10) unsigned NOT NULL default '0' COMMENT '老师id',
 `title` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '标题',
 `student` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '关注学生人数',
 `num` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '小结序号',
 `path` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '视屏路径',
 `create_time` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '上传时间',
PRIMARY KEY (  `sid` )
) ENGINE = MYISAM CHARSET = utf8;


-- //老师表
CREATE TABLE  `ci_teacher` (
 `tid` mediumint(7) unsigned NOT NULL auto_increment default '0',
 `user` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '名字',
 `name` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '姓名',
 `password` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '密码',
 `pic` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '头像路径',
 `phone` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '电话',
 `email` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '邮箱',
 `check` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '审核',
 `reg_time` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '注册时间',
PRIMARY KEY (  `gid` )
) ENGINE = MYISAM CHARSET = utf8;


-- //评论表
CREATE TABLE  `ci_comment` (
 `tid` mediumint(7) unsigned NOT NULL auto_increment default '0',
 `sid` int(10) unsigned NOT NULL default '0' COMMENT '课小节id,
 `uid` int(10) unsigned NOT NULL default '0' COMMENT '用户id,
 `username` int(10) unsigned NOT NULL default '0' COMMENT '用户名,
 `comment` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '内容',
 `reg_time` DATE NOT NULL DEFAULT  '0000-00-00',
PRIMARY KEY (  `gid` )
) ENGINE = MYISAM CHARSET = utf8;