-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2015 at 11:41 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `viz_posts`
--

CREATE TABLE `viz_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `posts_ID` bigint(20) unsigned NOT NULL COMMENT 'FK',
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
  `term_order` int(11) NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
  `taxonomy` varchar(32) NOT NULL DEFAULT '''''' COMMENT 'wp_term_taxonomy',
  `description` longtext NOT NULL COMMENT 'wp_term_taxonomy',
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
  `count` bigint(20) NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
  PRIMARY KEY (`id`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`posts_ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `viz_posts`
--

INSERT INTO `viz_posts` VALUES(1, 1, 1, '2015-05-24 19:08:36', '2015-05-24 19:08:36', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2015-05-24 19:08:36', '2015-05-24 19:08:36', '', 0, 'http://localhost/wordpress/?p=1', 0, 'post', '', 2, 1, 1, 0, 1, 'category', '', 0, 6);
INSERT INTO `viz_posts` VALUES(2, 4, 1, '2015-05-29 11:05:27', '2015-05-29 11:05:27', '<a href="http://localhost/wordpress/wp-content/uploads/2015/05/jay1.jpg"><img class="alignnone size-medium wp-image-5" src="http://localhost/wordpress/wp-content/uploads/2015/05/jay1-300x225.jpg" alt="jay1" width="300" height="225" /></a>', 'aaaaaaa', '', 'publish', 'open', 'open', '', 'aaaaaaa', '', '', '2015-05-29 11:05:27', '2015-05-29 11:05:27', '', 0, 'http://localhost/wordpress/?p=4', 0, 'post', '', 0, 4, 1, 0, 1, 'category', '', 0, 6);
INSERT INTO `viz_posts` VALUES(3, 7, 1, '2015-05-29 13:26:12', '2015-05-29 13:26:12', '<a href="http://localhost/wordpress/wp-content/uploads/2015/05/jay2.jpg"><img class="alignnone size-medium wp-image-8" src="http://localhost/wordpress/wp-content/uploads/2015/05/jay2-300x225.jpg" alt="jay2" width="300" height="225" /></a>\r\n\r\njay2 test', 'jay2', '', 'publish', 'open', 'open', '', 'jay2', '', '', '2015-05-29 13:26:12', '2015-05-29 13:26:12', '', 0, 'http://localhost/wordpress/?p=7', 0, 'post', '', 0, 7, 1, 0, 1, 'category', '', 0, 6);
INSERT INTO `viz_posts` VALUES(4, 12, 1, '2015-05-29 13:52:04', '2015-05-29 13:52:04', '<a href="/wordpress/wp-content/uploads/2015/05/jay4.jpg"><img class="alignnone size-medium wp-image-13" src="/wordpress/wp-content/uploads/2015/05/jay4.jpg" alt="jay4" width="202" height="237" /></a>\r\n\r\njay3', 'jay3', '', 'publish', 'open', 'open', '', 'jay3', '', '', '2015-05-29 13:52:04', '2015-05-29 13:52:04', '', 0, 'http://localhost/wordpress/?p=12', 0, 'post', '', 0, 12, 1, 0, 1, 'category', '', 0, 6);
INSERT INTO `viz_posts` VALUES(5, 16, 1, '2015-06-02 20:48:56', '2015-06-02 20:48:56', 'I am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.', 'Post4', '', 'publish', 'open', 'open', '', 'post4', '', '', '2015-06-02 20:48:56', '2015-06-02 20:48:56', '', 0, 'http://localhost/wordpress/?p=16', 0, 'post', '', 0, 16, 1, 0, 1, 'category', '', 0, 6);
INSERT INTO `viz_posts` VALUES(6, 18, 1, '2015-06-02 20:49:34', '2015-06-02 20:49:34', 'I am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.', 'Post5', '', 'publish', 'open', 'open', '', 'post5', '', '', '2015-06-02 20:49:34', '2015-06-02 20:49:34', '', 0, 'http://localhost/wordpress/?p=18', 0, 'post', '', 0, 18, 1, 0, 1, 'category', '', 0, 6);
