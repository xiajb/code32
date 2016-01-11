-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-01-10 17:13:03
-- 服务器版本: 5.5.46-0ubuntu0.14.04.2
-- PHP 版本: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `code`
--

-- --------------------------------------------------------

--
-- 表的结构 `ci_chapter`
--

CREATE TABLE IF NOT EXISTS `ci_chapter` (
  `chapter_id` int(11) NOT NULL,
  `chapter_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `course_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  PRIMARY KEY (`chapter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='章节';

--
-- 转存表中的数据 `ci_chapter`
--

-- INSERT INTO `ci_chapter` (`chapter_id`, `chapter_name`, `course_id`, `order_no`) VALUES
-- (1, 'HTML入门', 1, 1),
-- (2, 'JavaScript入门', 1, 2),
-- (3, 'Html介绍', 2, 1),
-- (4, '认识标签(第一部分)', 2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `ci_classify`
--

CREATE TABLE IF NOT EXISTS `ci_classify` (
  `classify_id` int(11) NOT NULL,
  `classify_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `direction_id` int(11) NOT NULL,
  PRIMARY KEY (`classify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `ci_classify`
--

-- INSERT INTO `ci_classify` (`classify_id`, `classify_name`, `direction_id`) VALUES
-- (1, 'HTML/CSS', 1),
-- (2, 'JavaScript', 1),
-- (3, 'CSS3', 1),
-- (4, 'Html5', 1),
-- (5, 'jQuery', 1),
-- (6, 'AngularJS', 1),
-- (7, 'Node.js', 1),
-- (8, 'Bootstrap', 1),
-- (9, 'WebApp', 1),
-- (10, '前端工具', 1),
-- (11, 'PHP', 2),
-- (12, 'JAVA', 2),
-- (13, 'Linux', 2),
-- (14, 'Python', 2),
-- (15, 'C', 2),
-- (16, 'C++', 2),
-- (17, 'Go', 2),
-- (18, 'C#', 2),
-- (19, '数据结构', 2);

-- --------------------------------------------------------

--
-- 表的结构 `ci_course`
--

CREATE TABLE IF NOT EXISTS `ci_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(11) COLLATE utf8_bin NOT NULL,
  `course_synopsis` text COLLATE utf8_bin NOT NULL,
  `classify_id` int(11) NOT NULL,
  `course_lectruer_id` int(11) NOT NULL,
  `course_level` varchar(10) COLLATE utf8_bin NOT NULL,
  `attentions` int(11) NOT NULL,
  `enrolls` int(11) NOT NULL,
  `img_path` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `ci_course`
--

-- INSERT INTO `ci_course` (`course_id`, `course_name`, `course_synopsis`, `classify_id`, `course_lectruer_id`, `course_level`, `attentions`, `enrolls`, `img_path`) VALUES
-- (1, 'PHP', '0', 0, 0, '', 0, 0, ''),
-- (2, 'HTML+CSS基础课', '本课程从最基本的概念开始讲起，步步深入，带领大家学习HTML、CSS样式基础知识，了解各种常用标签的意义以及基本用法，后半部分讲解CSS样式代码添加，为后面的案例课程打下基础。', 1, 0, '初级', 0, 0, 'http://img.imooc.com/529dc3380001379906000338-240-135.jpg'),
-- (3, '网页布局基础', '网页布局是进行网页制作的基础。本课程将讲解CSS中三种定位机制——标准文档流、浮动和绝对定位，并对标准文档流、盒子模型、float属性以及position属性等进行详细分析。从晦涩的理论讲解到编辑器环境的逐步验证，让你彻底掌握网页布局的相关知识。', 1, 0, '初级', 0, 0, 'http://img.imooc.com/53eafb44000146c706000338-240-135.jpg'),
-- (4, '手把手教你实现电商网站', '课程介绍\r\n电商网站基本制作流程，通过整站分步的教学让学员了解和掌握电商网站制作的流程和注意事项，运用网站内学过的知识点的连接掌握整站的开发过程，增加开发经验。', 1, 0, '高级', 0, 0, 'http://img.imooc.com/53c4bf8200011aac06000338-240-135.jpg'),
-- (5, '如何用CSS进行网页布', '如何用CSS进行网页布局？这可是前端工程师最最基本的技能，本课程教你怎么制作一列布局、二列布局、三列布局当然还有最通用的混合布局，而且你还可以选择让它固定还是自适应。用CSS重新规划你的网页，让你的网页从此更美观、更友好。', 1, 0, '中级', 0, 0, 'http://img.imooc.com/53eafb7a0001828906000338-240-135.jpg'),
-- (6, 'JjavaScript', '本课程让您快速认识JavaScript，熟悉基本语法、窗口交互方法和通过DOM进行网页元素的操作，学会如何编写JS代码，如何运用JavaScript去操作HTML元素和CSS样式，为JavaScript深入学习打下基础。', 2, 0, '初级', 0, 0, 'http://img.imooc.com/53e1d0470001ad1e06000338-240-135.jpg'),
-- (7, 'impress让你的内', '本课程讲解一个功能强大的制作演示文稿的工具，他叫做impress.js，如果你已经厌烦了PPT，那么不妨开始学习使用impress.js，他将会使你随便设置几个参数就能实现效果炫酷吊炸天的演示文稿', 2, 0, '初级', 0, 0, 'http://img.imooc.com/5386fece00016e0006000338-240-135.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `ci_direction`
--

CREATE TABLE IF NOT EXISTS `ci_direction` (
  `direction_id` int(11) NOT NULL,
  `direction_name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`direction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `ci_direction`
--

-- INSERT INTO `ci_direction` (`direction_id`, `direction_name`) VALUES
-- (1, '前端开发'),
-- (2, '后端开发'),
-- (3, '移动开发'),
-- (4, '数据处理'),
-- (5, '图像处理');

-- --------------------------------------------------------

--
-- 表的结构 `ci_elective`
--

CREATE TABLE IF NOT EXISTS `ci_elective` (
  `elective_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `name` varchar(50) NOT NULL DEFAULT '0' COMMENT '课程名',
  `title` varchar(50) NOT NULL DEFAULT '0' COMMENT '标题',
  `detail` varchar(50) NOT NULL DEFAULT '0' COMMENT '介绍',
  `teacher` varchar(50) NOT NULL DEFAULT '0' COMMENT '老师',
  `img` varchar(50) NOT NULL DEFAULT '0' COMMENT '图片',
  `difficulty` varchar(50) NOT NULL DEFAULT '0' COMMENT '难度',
  `status` varchar(50) NOT NULL DEFAULT '0' COMMENT '状态',
  `blance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `add_time` date NOT NULL DEFAULT '0000-00-00' COMMENT '添加时间',
  PRIMARY KEY (`elective_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ci_lecturer`
--

CREATE TABLE IF NOT EXISTS `ci_lecturer` (
  `lecturer_id` int(11) NOT NULL,
  `lecturer_name` int(11) NOT NULL,
  `lecturer_info` int(11) NOT NULL,
  PRIMARY KEY (`lecturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `ci_required`
--

CREATE TABLE IF NOT EXISTS `ci_required` (
  `required_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `stage` varchar(50) NOT NULL DEFAULT '0' COMMENT '阶段',
  `grade` varchar(50) NOT NULL DEFAULT '0' COMMENT '年级',
  `subject` varchar(50) NOT NULL DEFAULT '0' COMMENT '科目',
  `title` varchar(50) NOT NULL DEFAULT '0' COMMENT '标题',
  `detail` varchar(50) NOT NULL DEFAULT '0' COMMENT '介绍',
  `teacher` varchar(50) NOT NULL DEFAULT '0' COMMENT '老师',
  `img` varchar(50) NOT NULL DEFAULT '0' COMMENT '图片',
  `status` varchar(50) NOT NULL DEFAULT '0' COMMENT '状态',
  `difficulty` varchar(50) NOT NULL DEFAULT '0' COMMENT '难度',
  `blance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `add_time` date NOT NULL DEFAULT '0000-00-00' COMMENT '添加时间',
  PRIMARY KEY (`required_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ci_section`
--

CREATE TABLE IF NOT EXISTS `ci_section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `create_time` datetime NOT NULL,
  `creater` varchar(50) COLLATE utf8_bin NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `section_path` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `ci_section`
--

-- INSERT INTO `ci_section` (`section_id`, `section_name`, `create_time`, `creater`, `chapter_id`, `order_no`, `section_path`) VALUES
-- (1, 'HTML5特性简介', '2015-12-01 00:00:00', '谭旭', 1, 1, ''),
-- (2, 'HTML5元素、属性和格式化', '2015-12-01 04:12:09', '谭旭', 1, 2, ''),
-- (3, 'JavaScript基础教程 ', '2015-12-01 04:12:09', '谭旭', 2, 1, 'http://code32.b0.upaiyun.com/video/Taylor%20Swift%20-%20Shake%20It%20Off.mp4'),
-- (4, 'JavaScript语法详解', '2015-12-03 07:00:00', '谭旭', 2, 2, 'http://code32.b0.upaiyun.com/video/Taylor%20Swift%20-%20Shake%20It%20Off.mp4'),
-- (5, 'HTML5样式、链接和表格', '2015-12-01 00:00:00', '冉子文', 1, 5, ''),
-- (6, '代码初体验，制作我的第一个网页', '2016-01-01 00:00:00', '谭旭', 3, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `ci_skill`
--

CREATE TABLE IF NOT EXISTS `ci_skill` (
  `skill_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `name` varchar(50) NOT NULL DEFAULT '0' COMMENT '课程名',
  `title` varchar(50) NOT NULL DEFAULT '0' COMMENT '标题',
  `detail` varchar(50) NOT NULL DEFAULT '0' COMMENT '介绍',
  `teacher` varchar(50) NOT NULL DEFAULT '0' COMMENT '老师',
  `img` varchar(50) NOT NULL DEFAULT '0' COMMENT '图片',
  `difficulty` varchar(50) NOT NULL DEFAULT '0' COMMENT '难度',
  `status` varchar(50) NOT NULL DEFAULT '0' COMMENT '状态',
  `blance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `add_time` date NOT NULL DEFAULT '0000-00-00' COMMENT '添加时间',
  PRIMARY KEY (`skill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ci_user`
--

CREATE TABLE IF NOT EXISTS `ci_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key,autoincrement',
  `username` varchar(16) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `blance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `pic` varchar(50) NOT NULL DEFAULT '0' COMMENT '头像路径',
  `vip` int(10) NOT NULL DEFAULT '0',
  `level` int(10) NOT NULL DEFAULT '0',
  `other` varchar(50) NOT NULL DEFAULT '',
  `reg_time` date NOT NULL DEFAULT '0000-00-00' COMMENT '注册时间',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
