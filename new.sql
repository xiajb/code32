-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-03-06 18:37:46
-- 服务器版本: 5.5.47-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `new`
--

-- --------------------------------------------------------

--
-- 表的结构 `ci_blance`
--

CREATE TABLE IF NOT EXISTS `ci_blance` (
  `blance_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `pay` varchar(2048) NOT NULL DEFAULT '0' COMMENT '支付',
  `blance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '时间',
  PRIMARY KEY (`blance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ci_chapter`
--

CREATE TABLE IF NOT EXISTS `ci_chapter` (
  `chapter_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `chapter_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `course_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  PRIMARY KEY (`chapter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='章节' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ci_chapter`
--

INSERT INTO `ci_chapter` (`chapter_id`, `chapter_name`, `course_id`, `order_no`) VALUES
(1, 'HTML入门', 1, 1),
(2, 'JavaScript入门', 1, 2),
(3, 'Html介绍', 2, 1),
(4, '认识标签(第一部分)', 2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `ci_classify`
--

CREATE TABLE IF NOT EXISTS `ci_classify` (
  `classify_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `classify_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `direction_id` int(11) NOT NULL,
  PRIMARY KEY (`classify_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ci_classify`
--

INSERT INTO `ci_classify` (`classify_id`, `classify_name`, `direction_id`) VALUES
(1, '国学修身', 1),
(2, '朝圣修学', 1),
(3, '公职面试', 3),
(4, '互联网+', 3),
(5, '语文', 2),
(6, '英语', 2);

-- --------------------------------------------------------

--
-- 表的结构 `ci_comment`
--

CREATE TABLE IF NOT EXISTS `ci_comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `course_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '课id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `nickname` varchar(64) NOT NULL DEFAULT '0' COMMENT '用户名',
  `comment` varchar(1024) NOT NULL DEFAULT '0' COMMENT '内容',
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ci_course`
--

CREATE TABLE IF NOT EXISTS `ci_course` (
  `course_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `course_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `course_synopsis` text COLLATE utf8_bin NOT NULL,
  `classify_id` int(11) NOT NULL,
  `course_lectruer_id` int(11) NOT NULL,
  `course_level` varchar(16) COLLATE utf8_bin NOT NULL,
  `attentions` int(11) NOT NULL,
  `enrolls` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `img_path` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ci_course`
--

INSERT INTO `ci_course` (`course_id`, `course_name`, `course_synopsis`, `classify_id`, `course_lectruer_id`, `course_level`, `attentions`, `enrolls`, `status`, `add_time`, `img_path`) VALUES
(2, 'HTML+CSS基础课', '本课程从最基本的概念开始讲起，步步深入，带领大家学习HTML、CSS样式基础知识，了解各种常用标签的意义以及基本用法，后半部分讲解CSS样式代码添加，为后面的案例课程打下基础。', 1, 2, '初级', 0, 0, 1, '2016-02-16 00:00:00', 'http://img.imooc.com/529dc3380001379906000338-240-135.jpg'),
(3, '网页布局基础', '网页布局是进行网页制作的基础。本课程将讲解CSS中三种定位机制——标准文档流、浮动和绝对定位，并对标准文档流、盒子模型、float属性以及position属性等进行详细分析。从晦涩的理论讲解到编辑器环境的逐步验证，让你彻底掌握网页布局的相关知识。', 1, 2, '初级', 0, 0, 1, '2016-02-16 00:00:00', 'http://img.imooc.com/53eafb44000146c706000338-240-135.jpg'),
(4, '手把手教你实现电商网站', '课程介绍\r\n电商网站基本制作流程，通过整站分步的教学让学员了解和掌握电商网站制作的流程和注意事项，运用网站内学过的知识点的连接掌握整站的开发过程，增加开发经验。', 1, 2, '高级', 0, 0, 1, '2016-02-16 00:00:00', 'http://img.imooc.com/53c4bf8200011aac06000338-240-135.jpg'),
(5, '如何用CSS进行网页布', '如何用CSS进行网页布局？这可是前端工程师最最基本的技能，本课程教你怎么制作一列布局、二列布局、三列布局当然还有最通用的混合布局，而且你还可以选择让它固定还是自适应。用CSS重新规划你的网页，让你的网页从此更美观、更友好。', 1, 2, '中级', 0, 0, 1, '2016-02-16 00:00:00', 'http://img.imooc.com/53eafb7a0001828906000338-240-135.jpg'),
(6, 'JjavaScript', '本课程让您快速认识JavaScript，熟悉基本语法、窗口交互方法和通过DOM进行网页元素的操作，学会如何编写JS代码，如何运用JavaScript去操作HTML元素和CSS样式，为JavaScript深入学习打下基础。', 2, 2, '初级', 0, 0, 1, '2016-02-16 00:00:00', 'http://img.imooc.com/53e1d0470001ad1e06000338-240-135.jpg'),
(7, 'impress让你的内', '本课程讲解一个功能强大的制作演示文稿的工具，他叫做impress.js，如果你已经厌烦了PPT，那么不妨开始学习使用impress.js，他将会使你随便设置几个参数就能实现效果炫酷吊炸天的演示文稿', 2, 2, '初级', 0, 0, 1, '2016-02-16 00:00:00', 'http://img.imooc.com/5386fece00016e0006000338-240-135.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `ci_direction`
--

CREATE TABLE IF NOT EXISTS `ci_direction` (
  `direction_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `direction_name` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`direction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ci_direction`
--

INSERT INTO `ci_direction` (`direction_id`, `direction_name`) VALUES
(1, '选修课程'),
(2, '必修课程'),
(3, '技能课程');

-- --------------------------------------------------------

--
-- 表的结构 `ci_feedback`
--

CREATE TABLE IF NOT EXISTS `ci_feedback` (
  `feedback_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `vip` varchar(11) NOT NULL DEFAULT '',
  `title` varchar(64) NOT NULL DEFAULT '',
  `contact` varchar(50) NOT NULL DEFAULT '' COMMENT '联系方式',
  `info` varchar(2048) NOT NULL DEFAULT '0' COMMENT '反馈内容',
  `feedback_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ci_link`
--

CREATE TABLE IF NOT EXISTS `ci_link` (
  `link` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `name` varchar(64) NOT NULL DEFAULT '0' COMMENT '网站名',
  `url` varchar(50) NOT NULL DEFAULT '0' COMMENT 'url',
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  PRIMARY KEY (`link`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ci_link`
--

INSERT INTO `ci_link` (`link`, `name`, `url`, `add_time`) VALUES
(1, '百度', 'www.baidu.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `ci_order`
--

CREATE TABLE IF NOT EXISTS `ci_order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `blance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `order_name` varchar(1000) NOT NULL DEFAULT '0000-00-00',
  `starttime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '下单时间',
  `endtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '结束时间',
  `status` varchar(16) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ci_section`
--

CREATE TABLE IF NOT EXISTS `ci_section` (
  `section_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `section_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `chapter_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `free` int(11) NOT NULL,
  `section_path` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ci_section`
--

INSERT INTO `ci_section` (`section_id`, `section_name`, `create_time`, `chapter_id`, `status`,`order_no`, `free`, `section_path`) VALUES
(1, 'JavaScript基础教程 ', '2015-12-01 04:12:09', 2, 1, 1, 0, 'http://code32.b0.upaiyun.com/video/Taylor%20Swift%20-%20Shake%20It%20Off.mp4'),
(2, 'JavaScript语法详解', '2015-12-03 07:00:00', 2, 1, 2, 0, 'http://code32.b0.upaiyun.com/video/Taylor%20Swift%20-%20Shake%20It%20Off.mp4');

-- --------------------------------------------------------

--
-- 表的结构 `ci_teacher`
--

CREATE TABLE IF NOT EXISTS `ci_teacher` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL DEFAULT '0' COMMENT '头像路径',
  `phone` varchar(50) NOT NULL DEFAULT '0' COMMENT '电话',
  `intro` varchar(255) NOT NULL DEFAULT '0' COMMENT '简介',
  `test_video` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(11) NOT NULL DEFAULT '0' COMMENT '审核',
  `likes` int(11) NOT NULL DEFAULT '0' COMMENT '点赞',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '课程数',
  `apply_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ci_teacher`
--

INSERT INTO `ci_teacher` (`tid`, `uid`, `name`, `pic`, `phone`, `intro`, `test_video`, `status`, `likes`, `num`, `apply_time`) VALUES
(1, 2, '刘洋', 'http://code32.b0.upaiyun.com/2016/03/06/5fa4809069', '15607101196', '华南理工大学工程硕士，西门子（中国）有限公司工程师，负责项目设计执行、OEM样机开发，技术支持，客户培训。曾获比亚迪、深圳地铁等大型企业邀请对其相关技术人员进行系统的专业培训，擅长PLC、工业网络、HMI等设备的教学。授课深入浅出、全面细致，结合实际工程经验，详细实际应用和工程现场中遇到的常见问题。', '', '1', 55, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `ci_user`
--

CREATE TABLE IF NOT EXISTS `ci_user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `name` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(16) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `qq` varchar(11) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `pic` varchar(255) NOT NULL DEFAULT '0' COMMENT '头像路径',
  `vip` int(11) NOT NULL DEFAULT '0',
  `level` varchar(11) NOT NULL DEFAULT '0',
  `vip_endtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'vip到期时间',
  `other` varchar(255) NOT NULL DEFAULT '',
  `reg_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ci_user`
--

INSERT INTO `ci_user` (`uid`,`name` ,`username`, `phone`, `password`, `email`, `qq`,`sex`, `pic`, `vip`, `level`, `vip_endtime`, `other`, `reg_time`) VALUES
(1,'李白', 'admin', '15607101196', '36f17c3939ac3e7b2fc9396fa8e953ea', '877077145@qq.com','877077145', 1, '0', 0, '2', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(2,'杜甫' ,'tanxu', '15607101196', '36f17c3939ac3e7b2fc9396fa8e953ea', '877077145@qq.com', '877077145',1, '0', 0, '1', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

CREATE TABLE IF NOT EXISTS `ci_activity` (
  `activity_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `num` int(11) NOT NULL DEFAULT '0',
  `title` varchar(32) NOT NULL DEFAULT '',
  `pic` varchar(255) NOT NULL DEFAULT '0' COMMENT '图片路径',
  `starttime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开始时间',
  `endtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '结束时间',
  `overtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '报名结束时间',
  `place` varchar(1000) NOT NULL DEFAULT '' COMMENT '地点',
  `info` text NOT NULL DEFAULT '',
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;



CREATE TABLE IF NOT EXISTS `ci_join` (
  `join_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `activity_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动id',
  PRIMARY KEY (`join_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

