-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 01 月 05 日 20:23
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ysmusic`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` int(11) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_auth_item`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_auth_itemchild`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_itemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tbl_playlist`
--

CREATE TABLE IF NOT EXISTS `tbl_playlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(180) NOT NULL DEFAULT '''''',
  `create_date` int(11) NOT NULL DEFAULT '0',
  `update_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tbl_playlist`
--

INSERT INTO `tbl_playlist` (`id`, `user_id`, `name`, `create_date`, `update_date`) VALUES
(2, 1, 'testadmin', 1325595547, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_song`
--

CREATE TABLE IF NOT EXISTS `tbl_song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `order_in_playlist` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `playlist_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `lyric` text,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `playlist_id` (`playlist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tbl_song`
--

INSERT INTO `tbl_song` (`id`, `name`, `order_in_playlist`, `playlist_id`, `url`, `lyric`, `description`) VALUES
(1, '我们都是好孩子', 1, 2, 'http://ikk.me/usr/uploads/2011/07/2038744757.ogg', '﻿[00:07.51]推开窗看天边白色的鸟  \r\n[00:14.42]想起你薄荷味的笑  \r\n[00:19.65]那时你在操场上奔跑  \r\n[00:27.53]大声喊 我爱你 \r\n[00:30.51]你知不知道  \r\n[00:35.12]那时我们什么都不怕  \r\n[00:41.45]看咖啡色夕阳又要落下  \r\n[00:48.01]你说要 一直爱一直好  \r\n[00:55.24]就这样 永远不分开  \r\n[01:01.85]我们都是好孩子  \r\n[01:05.10]异想天开的孩子  \r\n[01:08.86]相信爱 可以永远啊  \r\n[01:15.47]我们都是好孩子  \r\n[01:19.04]最最善良的孩子  \r\n[01:23.06]怀念着 伤害我们的  \r\n[01:49.49]大声喊 我爱你 \r\n[01:57.62]那时我们什么都不怕  \r\n[02:05.64]看咖啡色夕阳又要落下  \r\n[02:11.62]你说要 一直爱一直好  \r\n[02:18.69]就这样 永远不分开  \r\n[02:25.40]我们都是好孩子  \r\n[02:28.64]最最天真的孩子  \r\n[02:32.52]灿烂的 孤单的 变遥远的啊  \r\n[02:39.01]我们都是好孩子  \r\n[02:42.50]最最可爱的孩子  \r\n[02:46.49]在一起 为幸福落泪啊\r\n[02:52.94]我们都是好孩子  \r\n[02:56.44]异想天开的孩子  \r\n[03:00.37]相信爱 可以永远啊  \r\n[03:06.86]我们都是好孩子  \r\n[03:10.33]最最善良的孩子  \r\n[03:14.33]怀念着 伤害我们的  \r\n[03:21.15]推开窗看天边白色的鸟  \r\n[03:28.85]想起你薄荷味的笑  \r\n[03:34.37]那时你在操场上奔跑  \r\n[03:42.13]大声喊 我爱你 \r\n[03:45.34]你知不知道 ', 'test'),
(2, '守候', 2, 2, 'http://www.google.com.hk/search?gcx=c&sourceid=chrome&client=ubuntu&channel=cs&ie=UTF-8&q=bai', 'http://www.google.com.hk/search?gcx=c&sourceid=chrome&client=ubuntu&channel=cs&ie=UTF-8&q=bai', 'http://www.google.com.hk/search?gcx=c&sourceid=chrome&client=ubuntu&channel=cs&ie=UTF-8&q=bai');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `regdate` int(11) NOT NULL DEFAULT '0',
  `lastvisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `regdate`, `lastvisit`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'rainyjune@live.cn', 1325593265, 1325720064);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_user_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_user_profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `blog` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tbl_user_profile`
--

INSERT INTO `tbl_user_profile` (`user_id`, `name`, `email`, `blog`, `description`) VALUES
(1, 'Kang Chen', 'kangchen@sohu-inc.com', 'http://y-projects.tk/', 'Hello,world.');

--
-- 限制导出的表
--

--
-- 限制表 `tbl_auth_assignment`
--
ALTER TABLE `tbl_auth_assignment`
  ADD CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_auth_itemchild`
--
ALTER TABLE `tbl_auth_itemchild`
  ADD CONSTRAINT `tbl_auth_itemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_auth_itemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_playlist`
--
ALTER TABLE `tbl_playlist`
  ADD CONSTRAINT `tbl_playlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_song`
--
ALTER TABLE `tbl_song`
  ADD CONSTRAINT `tbl_song_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `tbl_playlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD CONSTRAINT `tbl_user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
