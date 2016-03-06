


CREATE TABLE  `ci_user` (
 `uid` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `username` VARCHAR( 16 ) NOT NULL,
 `name` VARCHAR( 16 ) NOT NULL DEFAULT  '',
 `phone` VARCHAR( 11 ) NOT NULL,
 `qq` VARCHAR( 11 ) NOT NULL DEFAULT  '',
 `password` VARCHAR( 50 ) NOT NULL,
 `email` VARCHAR( 50 ) NOT NULL,
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `sex` TINYINT( 1 ) NOT NULL DEFAULT  '0',
 `pic` VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '头像路径',
 `vip` int(10) NOT NULL DEFAULT  '0',
 `level` int(10) NOT NULL DEFAULT  '0',
 `other` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 `reg_time` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '注册时间',
PRIMARY KEY (  `uid` )
) ENGINE = MYISAM CHARSET = utf8;


--required
CREATE TABLE  `ci_required` (
 `required_id` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `stage` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '阶段',
 `grade` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '年级',
 `subject` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '科目',
 `title` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '标题',
 `detail` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '介绍',
 `teacher` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '老师',
 `img` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '图片',
 `status` int( 10 ) NOT NULL DEFAULT '0' COMMENT '状态',
 `difficulty` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '难度',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `add_time` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '添加时间',
PRIMARY KEY (  `required_id` )
) ENGINE = MYISAM CHARSET = utf8;

--国学类
--required
CREATE TABLE  `ci_elective` (
 `elective_id` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `name` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '课程名',
 `title` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '标题',
 `detail` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '介绍',
 `teacher` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '老师',
 `img` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '图片',
 `difficulty` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '难度',
 `status` int( 10 ) NOT NULL DEFAULT '0' COMMENT '状态',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `add_time` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '添加时间',
PRIMARY KEY (  `elective_id` )
) ENGINE = MYISAM CHARSET = utf8;

--技能类
CREATE TABLE  `ci_skill` (
 `skill_id` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `name` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '课程名',
 `title` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '标题',
 `detail` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '介绍',
 `teacher` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '老师',
 `img` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '图片',
 `difficulty` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '难度',
 `status` int( 10 ) NOT NULL DEFAULT '0' COMMENT '状态',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `add_time` DATE NOT NULL DEFAULT  '0000-00-00' COMMENT '添加时间',
PRIMARY KEY (  `skill_id` )
) ENGINE = MYISAM CHARSET = utf8;

-- --技能类
-- CREATE TABLE  `ci_guoxue` (
--  `jnid` mediumint(7) unsigned NOT NULL auto_increment default '0',
--  `name` int(10) unsigned NOT NULL default '0' COMMENT '名字',
--  `status` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '状态',
-- PRIMARY KEY (  `gxid` )
-- ) ENGINE = MYISAM CHARSET = utf8;

-- 订单表
CREATE TABLE  `ci_order` (
 `order_id` int(11) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `uid` int(11) unsigned NOT NULL default '0' COMMENT '用户id',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `order_name` VARCHAR( 1000 ) NOT NULL DEFAULT '0000-00-00' COMMENT '',
 `starttime` VARCHAR( 50 ) NOT NULL DEFAULT '0000-00-00' COMMENT '下单时间',
 `endtime` VARCHAR( 50 ) NOT NULL DEFAULT '0000-00-00' COMMENT '结束时间',
 `status` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '状态',
PRIMARY KEY (  `order_id` )
) ENGINE = MYISAM CHARSET = utf8;


-- link
CREATE TABLE  `ci_link` (
 `link` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `name` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '网站名',
 `url` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT 'url',
 `add_time` datetime NOT NULL DEFAULT '0000-00-00' COMMENT '添加时间',
PRIMARY KEY (  `link` )
) ENGINE = MYISAM CHARSET = utf8;


-- //流水细明
CREATE TABLE  `ci_blance` (
 `blance_id` int(11) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `uid` int(11) unsigned NOT NULL default '0' COMMENT '用户id',
 `pay` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '支付',
 `blance` DECIMAL( 10,2 ) NOT NULL DEFAULT '0.00' COMMENT '金额',
 `datetime` datetime NOT NULL DEFAULT  '0000-00-00' COMMENT '时间',
PRIMARY KEY (  `blance_id` )
) ENGINE = MYISAM CHARSET = utf8;


-- //课程
CREATE TABLE  `ci_course` (
 `kid` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `stage` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '阶段',
 `grade` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '年级',
 `subject` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '科目',
 `title` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '标题',
 `detail` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '介绍',
 `teacher` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '老师',
 `img` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '图片',
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
 `tid` int(10) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `uid` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '用户id',
 `name` VARCHAR( 50 ) NOT NULL,
 `pic` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '头像路径',
 `phone` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '电话',
 `intro` VARCHAR( 255 ) NOT NULL DEFAULT '0' COMMENT '简介',
 `test_video` VARCHAR( 255 ) NOT NULL DEFAULT '' COMMENT '', 
 `check` int( 11 ) NOT NULL DEFAULT '0' COMMENT '审核',
  `like` int(11)  NOT NULL DEFAULT '0' COMMENT '点赞',
  `num` int(11)  NOT NULL DEFAULT '0' COMMENT '课程数',
 `apply_time` datetime NOT NULL DEFAULT  '0000-00-00' COMMENT '注册时间',
PRIMARY KEY (  `tid` )
) ENGINE = MYISAM CHARSET = utf8;


-- //评论表
CREATE TABLE  `ci_comment` (
 `comment_id` int(11) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
 `course_id` int(11) unsigned NOT NULL default '0' COMMENT '课id',
 `uid` int(11) unsigned NOT NULL default '0' COMMENT '用户id',
 `nickname` VARCHAR( 50 ) NOT NULL default '0' COMMENT '用户名',
 `comment` VARCHAR( 50 ) NOT NULL DEFAULT '0' COMMENT '内容',
 `add_time` datetime NOT NULL DEFAULT  '0000-00-00',
PRIMARY KEY (  `comment_id` )
) ENGINE = MYISAM CHARSET = utf8;


-- //  反馈表
	CREATE TABLE  `ci_feedback` (
	`feedback_id` int(11) unsigned NOT NULL auto_increment COMMENT 'primary key,autoincrement',
	 `username` VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '',
	 `email` VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '',
	 `phone` VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '',
	 `vip` VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '',
	  `title` VARCHAR( 50 ) NOT NULL DEFAULT '' COMMENT '',
	 `contact` VARCHAR( 50 ) NOT NULL default '' COMMENT '联系方式',
	 `info` VARCHAR( 250 ) NOT NULL DEFAULT '0' COMMENT '反馈内容',
	 `feedback_time` datetime NOT NULL DEFAULT  '0000-00-00',
	PRIMARY KEY (  `feedback_id` )
	) ENGINE = MYISAM CHARSET = utf8;