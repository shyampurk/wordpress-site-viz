-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2015 at 08:00 PM
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
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wp_commentmeta`
--


-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` VALUES(1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2015-05-24 19:08:36', '2015-05-24 19:08:36', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0);
INSERT INTO `wp_comments` VALUES(2, 1, 'admin', 'jaybharatjay@gmail.com', '', '::1', '2015-05-26 18:57:03', '2015-05-26 18:57:03', 'tututuyt', 0, '1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:38.0) Gecko/20100101 Firefox/38.0', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wp_links`
--


-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=270 ;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` VALUES(1, 'siteurl', 'http://localhost/wordpress', 'yes');
INSERT INTO `wp_options` VALUES(2, 'home', 'http://localhost/wordpress', 'yes');
INSERT INTO `wp_options` VALUES(3, 'blogname', 'wordpress', 'yes');
INSERT INTO `wp_options` VALUES(4, 'blogdescription', 'Just another WordPress site', 'yes');
INSERT INTO `wp_options` VALUES(5, 'users_can_register', '0', 'yes');
INSERT INTO `wp_options` VALUES(6, 'admin_email', 'jaybharatjay@gmail.com', 'yes');
INSERT INTO `wp_options` VALUES(7, 'start_of_week', '1', 'yes');
INSERT INTO `wp_options` VALUES(8, 'use_balanceTags', '0', 'yes');
INSERT INTO `wp_options` VALUES(9, 'use_smilies', '1', 'yes');
INSERT INTO `wp_options` VALUES(10, 'require_name_email', '1', 'yes');
INSERT INTO `wp_options` VALUES(11, 'comments_notify', '1', 'yes');
INSERT INTO `wp_options` VALUES(12, 'posts_per_rss', '10', 'yes');
INSERT INTO `wp_options` VALUES(13, 'rss_use_excerpt', '0', 'yes');
INSERT INTO `wp_options` VALUES(14, 'mailserver_url', 'mail.example.com', 'yes');
INSERT INTO `wp_options` VALUES(15, 'mailserver_login', 'login@example.com', 'yes');
INSERT INTO `wp_options` VALUES(16, 'mailserver_pass', 'password', 'yes');
INSERT INTO `wp_options` VALUES(17, 'mailserver_port', '110', 'yes');
INSERT INTO `wp_options` VALUES(18, 'default_category', '1', 'yes');
INSERT INTO `wp_options` VALUES(19, 'default_comment_status', 'open', 'yes');
INSERT INTO `wp_options` VALUES(20, 'default_ping_status', 'open', 'yes');
INSERT INTO `wp_options` VALUES(21, 'default_pingback_flag', '1', 'yes');
INSERT INTO `wp_options` VALUES(22, 'posts_per_page', '10', 'yes');
INSERT INTO `wp_options` VALUES(23, 'date_format', 'F j, Y', 'yes');
INSERT INTO `wp_options` VALUES(24, 'time_format', 'g:i a', 'yes');
INSERT INTO `wp_options` VALUES(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes');
INSERT INTO `wp_options` VALUES(26, 'comment_moderation', '0', 'yes');
INSERT INTO `wp_options` VALUES(27, 'moderation_notify', '1', 'yes');
INSERT INTO `wp_options` VALUES(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes');
INSERT INTO `wp_options` VALUES(29, 'gzipcompression', '0', 'yes');
INSERT INTO `wp_options` VALUES(30, 'hack_file', '0', 'yes');
INSERT INTO `wp_options` VALUES(31, 'blog_charset', 'UTF-8', 'yes');
INSERT INTO `wp_options` VALUES(32, 'moderation_keys', '', 'no');
INSERT INTO `wp_options` VALUES(33, 'active_plugins', 'a:4:{i:0;s:24:"jayplugin/jayplugin1.php";i:1;s:21:"jayplugin2/index1.php";i:2;s:37:"relative-image-urls/relativeimage.php";i:3;s:29:"relative-url/relative-url.php";}', 'yes');
INSERT INTO `wp_options` VALUES(34, 'category_base', '', 'yes');
INSERT INTO `wp_options` VALUES(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes');
INSERT INTO `wp_options` VALUES(36, 'advanced_edit', '0', 'yes');
INSERT INTO `wp_options` VALUES(37, 'comment_max_links', '2', 'yes');
INSERT INTO `wp_options` VALUES(38, 'gmt_offset', '0', 'yes');
INSERT INTO `wp_options` VALUES(39, 'default_email_category', '1', 'yes');
INSERT INTO `wp_options` VALUES(40, 'recently_edited', '', 'no');
INSERT INTO `wp_options` VALUES(41, 'template', 'twentyfifteen', 'yes');
INSERT INTO `wp_options` VALUES(42, 'stylesheet', 'twentyfifteen', 'yes');
INSERT INTO `wp_options` VALUES(43, 'comment_whitelist', '1', 'yes');
INSERT INTO `wp_options` VALUES(44, 'blacklist_keys', '', 'no');
INSERT INTO `wp_options` VALUES(45, 'comment_registration', '0', 'yes');
INSERT INTO `wp_options` VALUES(46, 'html_type', 'text/html', 'yes');
INSERT INTO `wp_options` VALUES(47, 'use_trackback', '0', 'yes');
INSERT INTO `wp_options` VALUES(48, 'default_role', 'subscriber', 'yes');
INSERT INTO `wp_options` VALUES(49, 'db_version', '31535', 'yes');
INSERT INTO `wp_options` VALUES(50, 'uploads_use_yearmonth_folders', '1', 'yes');
INSERT INTO `wp_options` VALUES(51, 'upload_path', '', 'yes');
INSERT INTO `wp_options` VALUES(52, 'blog_public', '1', 'yes');
INSERT INTO `wp_options` VALUES(53, 'default_link_category', '2', 'yes');
INSERT INTO `wp_options` VALUES(54, 'show_on_front', 'posts', 'yes');
INSERT INTO `wp_options` VALUES(55, 'tag_base', '', 'yes');
INSERT INTO `wp_options` VALUES(56, 'show_avatars', '1', 'yes');
INSERT INTO `wp_options` VALUES(57, 'avatar_rating', 'G', 'yes');
INSERT INTO `wp_options` VALUES(58, 'upload_url_path', '', 'yes');
INSERT INTO `wp_options` VALUES(59, 'thumbnail_size_w', '150', 'yes');
INSERT INTO `wp_options` VALUES(60, 'thumbnail_size_h', '150', 'yes');
INSERT INTO `wp_options` VALUES(61, 'thumbnail_crop', '1', 'yes');
INSERT INTO `wp_options` VALUES(62, 'medium_size_w', '300', 'yes');
INSERT INTO `wp_options` VALUES(63, 'medium_size_h', '300', 'yes');
INSERT INTO `wp_options` VALUES(64, 'avatar_default', 'mystery', 'yes');
INSERT INTO `wp_options` VALUES(65, 'large_size_w', '1024', 'yes');
INSERT INTO `wp_options` VALUES(66, 'large_size_h', '1024', 'yes');
INSERT INTO `wp_options` VALUES(67, 'image_default_link_type', 'file', 'yes');
INSERT INTO `wp_options` VALUES(68, 'image_default_size', '', 'yes');
INSERT INTO `wp_options` VALUES(69, 'image_default_align', '', 'yes');
INSERT INTO `wp_options` VALUES(70, 'close_comments_for_old_posts', '0', 'yes');
INSERT INTO `wp_options` VALUES(71, 'close_comments_days_old', '14', 'yes');
INSERT INTO `wp_options` VALUES(72, 'thread_comments', '1', 'yes');
INSERT INTO `wp_options` VALUES(73, 'thread_comments_depth', '5', 'yes');
INSERT INTO `wp_options` VALUES(74, 'page_comments', '0', 'yes');
INSERT INTO `wp_options` VALUES(75, 'comments_per_page', '50', 'yes');
INSERT INTO `wp_options` VALUES(76, 'default_comments_page', 'newest', 'yes');
INSERT INTO `wp_options` VALUES(77, 'comment_order', 'asc', 'yes');
INSERT INTO `wp_options` VALUES(78, 'sticky_posts', 'a:0:{}', 'yes');
INSERT INTO `wp_options` VALUES(79, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(80, 'widget_text', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(81, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(82, 'uninstall_plugins', 'a:0:{}', 'no');
INSERT INTO `wp_options` VALUES(83, 'timezone_string', '', 'yes');
INSERT INTO `wp_options` VALUES(84, 'page_for_posts', '0', 'yes');
INSERT INTO `wp_options` VALUES(85, 'page_on_front', '0', 'yes');
INSERT INTO `wp_options` VALUES(86, 'default_post_format', '0', 'yes');
INSERT INTO `wp_options` VALUES(87, 'link_manager_enabled', '0', 'yes');
INSERT INTO `wp_options` VALUES(88, 'initial_db_version', '31535', 'yes');
INSERT INTO `wp_options` VALUES(89, 'wp_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:62:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes');
INSERT INTO `wp_options` VALUES(90, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(91, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(92, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(93, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(94, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(95, 'sidebars_widgets', 'a:3:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:13:"array_version";i:3;}', 'yes');
INSERT INTO `wp_options` VALUES(228, 'rewrite_rules', 'a:70:{s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:58:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:68:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:88:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$";s:85:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1";s:77:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:65:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(/[0-9]+)?/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]";s:47:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:57:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:77:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]";s:51:"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]";s:38:"([0-9]{4})/comment-page-([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&cpage=$matches[2]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)(/[0-9]+)?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";}', 'yes');
INSERT INTO `wp_options` VALUES(97, 'cron', 'a:5:{i:1433574516;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1433576640;a:1:{s:20:"wp_maybe_auto_update";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1433588673;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1433617730;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes');
INSERT INTO `wp_options` VALUES(112, 'can_compress_scripts', '1', 'yes');
INSERT INTO `wp_options` VALUES(107, '_transient_random_seed', '1bd11a060707f84eba2fba18db73f6ae', 'yes');
INSERT INTO `wp_options` VALUES(101, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:58:"http://downloads.wordpress.org/release/wordpress-4.2.2.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:58:"http://downloads.wordpress.org/release/wordpress-4.2.2.zip";s:10:"no_content";s:69:"http://downloads.wordpress.org/release/wordpress-4.2.2-no-content.zip";s:11:"new_bundled";s:70:"http://downloads.wordpress.org/release/wordpress-4.2.2-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.2.2";s:7:"version";s:5:"4.2.2";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1433536401;s:15:"version_checked";s:5:"4.2.2";s:12:"translations";a:0:{}}', 'yes');
INSERT INTO `wp_options` VALUES(103, '_site_transient_update_plugins', 'O:8:"stdClass":5:{s:12:"last_checked";i:1433536436;s:7:"checked";a:6:{s:19:"akismet/akismet.php";s:5:"3.1.1";s:9:"hello.php";s:3:"1.6";s:21:"jayplugin2/index1.php";s:15:"1.0/26-may-2015";s:24:"jayplugin/jayplugin1.php";s:15:"1.0/26-may-2015";s:37:"relative-image-urls/relativeimage.php";s:3:"2.0";s:29:"relative-url/relative-url.php";s:6:"0.0.11";}s:8:"response";a:0:{}s:12:"translations";a:0:{}s:9:"no_update";a:4:{s:19:"akismet/akismet.php";O:8:"stdClass":6:{s:2:"id";s:2:"15";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:5:"3.1.1";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:55:"http://downloads.wordpress.org/plugin/akismet.3.1.1.zip";}s:9:"hello.php";O:8:"stdClass":6:{s:2:"id";s:4:"3564";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:9:"hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:57:"http://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";}s:37:"relative-image-urls/relativeimage.php";O:8:"stdClass":7:{s:2:"id";s:5:"13788";s:4:"slug";s:19:"relative-image-urls";s:6:"plugin";s:37:"relative-image-urls/relativeimage.php";s:11:"new_version";s:3:"2.0";s:3:"url";s:50:"https://wordpress.org/plugins/relative-image-urls/";s:7:"package";s:65:"http://downloads.wordpress.org/plugin/relative-image-urls.2.0.zip";s:14:"upgrade_notice";s:93:"Fixed issue that caused plugin installation to fail.\nCompatible up to WordPress version 3.5.1";}s:29:"relative-url/relative-url.php";O:8:"stdClass":7:{s:2:"id";s:5:"34725";s:4:"slug";s:12:"relative-url";s:6:"plugin";s:29:"relative-url/relative-url.php";s:11:"new_version";s:6:"0.0.11";s:3:"url";s:43:"https://wordpress.org/plugins/relative-url/";s:7:"package";s:61:"http://downloads.wordpress.org/plugin/relative-url.0.0.11.zip";s:14:"upgrade_notice";s:69:"External resources no longer processed.\nCompatibility check for 4.2.2";}}}', 'yes');
INSERT INTO `wp_options` VALUES(263, '_site_transient_timeout_theme_roots', '1433538202', 'yes');
INSERT INTO `wp_options` VALUES(264, '_site_transient_theme_roots', 'a:3:{s:13:"twentyfifteen";s:7:"/themes";s:14:"twentyfourteen";s:7:"/themes";s:14:"twentythirteen";s:7:"/themes";}', 'yes');
INSERT INTO `wp_options` VALUES(106, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1433536411;s:7:"checked";a:3:{s:13:"twentyfifteen";s:3:"1.2";s:14:"twentyfourteen";s:3:"1.4";s:14:"twentythirteen";s:3:"1.5";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'yes');
INSERT INTO `wp_options` VALUES(237, '_site_transient_timeout_browser_c5b1639cdf201c6e9d0fe6c6012caacf', '1433880517', 'yes');
INSERT INTO `wp_options` VALUES(238, '_site_transient_browser_c5b1639cdf201c6e9d0fe6c6012caacf', 'a:9:{s:8:"platform";s:9:"Macintosh";s:4:"name";s:7:"Firefox";s:7:"version";s:4:"38.0";s:10:"update_url";s:23:"http://www.firefox.com/";s:7:"img_src";s:50:"http://s.wordpress.org/images/browsers/firefox.png";s:11:"img_src_ssl";s:49:"https://wordpress.org/images/browsers/firefox.png";s:15:"current_version";s:2:"16";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes');
INSERT INTO `wp_options` VALUES(266, '_transient_timeout_plugin_slugs', '1433622837', 'no');
INSERT INTO `wp_options` VALUES(267, '_transient_plugin_slugs', 'a:6:{i:0;s:19:"akismet/akismet.php";i:1;s:9:"hello.php";i:2;s:21:"jayplugin2/index1.php";i:3;s:24:"jayplugin/jayplugin1.php";i:4;s:37:"relative-image-urls/relativeimage.php";i:5;s:29:"relative-url/relative-url.php";}', 'no');
INSERT INTO `wp_options` VALUES(268, '_transient_timeout_dash_4077549d03da2e451c8b5f002294ff51', '1433579635', 'no');
INSERT INTO `wp_options` VALUES(269, '_transient_dash_4077549d03da2e451c8b5f002294ff51', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: error:0D0890A1:asn1 encoding routines:ASN1_verify:unknown message digest algorithm</p></div><div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: error:0D0890A1:asn1 encoding routines:ASN1_verify:unknown message digest algorithm</p></div><div class="rss-widget"><ul></ul></div>', 'no');
INSERT INTO `wp_options` VALUES(119, 'recently_activated', 'a:0:{}', 'yes');
INSERT INTO `wp_options` VALUES(184, 'widget_calendar', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(251, '_transient_twentyfifteen_categories', '1', 'yes');
INSERT INTO `wp_options` VALUES(220, '_site_transient_timeout_available_translations', '1432933508', 'yes');
INSERT INTO `wp_options` VALUES(147, '_site_transient_wordpress_credits_en_US', 'a:2:{s:6:"groups";a:6:{s:15:"project-leaders";a:4:{s:4:"name";s:15:"Project Leaders";s:4:"type";s:6:"titles";s:7:"shuffle";b:1;s:4:"data";a:6:{s:4:"matt";a:4:{i:0;s:14:"Matt Mullenweg";i:1;s:32:"767fc9c115a1b989744c755db47feb60";i:2;s:4:"matt";i:3;s:23:"Cofounder, Project Lead";}s:5:"nacin";a:4:{i:0;s:12:"Andrew Nacin";i:1;s:32:"01cfe9feaafb068590891bbd1f6a7f5a";i:2;s:5:"nacin";i:3;s:14:"Lead Developer";}s:11:"markjaquith";a:4:{i:0;s:12:"Mark Jaquith";i:1;s:32:"097a87a525e317519b5ee124820012fb";i:2;s:11:"markjaquith";i:3;s:14:"Lead Developer";}s:6:"azaozz";a:4:{i:0;s:10:"Andrew Ozz";i:1;s:32:"4e84843ebff0918d72ade21c6ee7b1e4";i:2;s:6:"azaozz";i:3;s:14:"Lead Developer";}s:5:"helen";a:4:{i:0;s:16:"Helen Hou-Sandí";i:1;s:32:"6506162ada6b700b151ad8a187f65842";i:2;s:5:"helen";i:3;s:14:"Lead Developer";}s:4:"dd32";a:4:{i:0;s:10:"Dion Hulse";i:1;s:32:"4af2825655b46fb1206b08d9041d8e3e";i:2;s:4:"dd32";i:3;s:14:"Lead Developer";}}}s:15:"core-developers";a:4:{s:4:"name";s:23:"Contributing Developers";s:4:"type";s:6:"titles";s:7:"shuffle";b:0;s:4:"data";a:9:{s:12:"DrewAPicture";a:4:{i:0;s:11:"Drew Jaynes";i:1;s:32:"95c934fa2c3362794bf62ff8c59ada08";i:2;s:12:"DrewAPicture";i:3;s:12:"Release Lead";}s:7:"ocean90";a:4:{i:0;s:17:"Dominik Schilling";i:1;s:32:"3e8e161d97d793bd8fc2dcd62583bb76";i:2;s:7:"ocean90";i:3;s:14:"Core Developer";}s:14:"SergeyBiryukov";a:4:{i:0;s:15:"Sergey Biryukov";i:1;s:32:"750b7b0fcd855389264c2b1294d61bd6";i:2;s:14:"SergeyBiryukov";i:3;s:14:"Core Developer";}s:14:"wonderboymusic";a:4:{i:0;s:12:"Scott Taylor";i:1;s:32:"112ca15732a80bb928c52caec9d2c8dd";i:2;s:14:"wonderboymusic";i:3;s:14:"Core Developer";}s:11:"johnbillion";a:4:{i:0;s:15:"John Blackbourn";i:1;s:32:"0000ba6dd1b089e1746abbfe6281ee3b";i:2;s:11:"johnbillion";i:3;s:14:"Core Developer";}s:12:"boonebgorges";a:4:{i:0;s:15:"Boone B. Gorges";i:1;s:32:"9cf7c4541a582729a5fc7ae484786c0c";i:2;s:12:"boonebgorges";i:3;s:14:"Core Developer";}s:5:"pento";a:4:{i:0;s:15:"Gary Pendergast";i:1;s:32:"1ad9e5c98d81c6815a65dab5b6e1f669";i:2;s:5:"pento";i:3;s:14:"Core Developer";}s:4:"ryan";a:4:{i:0;s:10:"Ryan Boren";i:1;s:32:"c22398fb9602c967d1dac8174f4a1a4e";i:2;s:4:"ryan";i:3;s:0:"";}s:12:"lancewillett";a:4:{i:0;s:13:"Lance Willett";i:1;s:32:"47976847383b324bd35e228a91eb1a0f";i:2;s:12:"lancewillett";i:3;s:0:"";}}}s:23:"contributing-developers";a:4:{s:4:"name";b:0;s:4:"type";s:6:"titles";s:7:"shuffle";b:1;s:4:"data";a:3:{s:7:"iseulde";a:4:{i:0;s:22:"Ella Iseulde Van Dorpe";i:1;s:32:"fee611dacac99d496068e201d81650d6";i:2;s:7:"iseulde";i:3;s:0:"";}s:6:"jorbin";a:4:{i:0;s:12:"Aaron Jorbin";i:1;s:32:"b3e2b94eb305bf95a1bee11bc7705fb7";i:2;s:6:"jorbin";i:3;s:0:"";}s:10:"jeremyfelt";a:4:{i:0;s:11:"Jeremy Felt";i:1;s:32:"d1759b1c669981b7c52ec9a97d19e6bd";i:2;s:10:"jeremyfelt";i:3;s:0:"";}}}s:16:"recent-rockstars";a:4:{s:4:"name";b:0;s:4:"type";s:6:"titles";s:7:"shuffle";b:1;s:4:"data";a:9:{s:8:"stephdau";a:4:{i:0;s:14:"Stephane Daury";i:1;s:32:"5b8d74a711e183850bd70ccdd440d15e";i:2;s:8:"stephdau";i:3;s:0:"";}s:15:"michael-arestad";a:4:{i:0;s:15:"Michael Arestad";i:1;s:32:"e8b4c8470f61ff15b9c98f7a1556c16b";i:2;s:15:"michael-arestad";i:3;s:0:"";}s:7:"kraftbj";a:4:{i:0;s:13:"Brandon Kraft";i:1;s:32:"6e238edcb0664c975ccb9e8e80abb307";i:2;s:7:"kraftbj";i:3;s:0:"";}s:16:"celloexpressions";a:4:{i:0;s:11:"Nick Halsey";i:1;s:32:"42e659bb8c86851c230e527f8ce1764b";i:2;s:16:"celloexpressions";i:3;s:0:"";}s:11:"westonruter";a:4:{i:0;s:12:"Weston Ruter";i:1;s:32:"22ed378fbf1d918ef43a45b2a1f34634";i:2;s:11:"westonruter";i:3;s:0:"";}s:7:"afercia";a:4:{i:0;s:13:"Andrea Fercia";i:1;s:32:"074af62ea5ff218b6a6eeab89104f616";i:2;s:7:"afercia";i:3;s:0:"";}s:12:"valendesigns";a:4:{i:0;s:12:"Derek Herman";i:1;s:32:"ca0dc28865ede5a2b2a9e22971b87993";i:2;s:12:"valendesigns";i:3;s:0:"";}s:9:"joedolson";a:4:{i:0;s:10:"Joe Dolson";i:1;s:32:"ee77adf6adc6fe90b388f97b0bd912b2";i:2;s:9:"joedolson";i:3;s:0:"";}s:5:"tyxla";a:4:{i:0;s:14:"Marin Atanasov";i:1;s:32:"cf58282ee2e95590510aaa24b734c186";i:2;s:5:"tyxla";i:3;s:0:"";}}}s:5:"props";a:4:{s:4:"name";s:33:"Core Contributors to WordPress %s";s:12:"placeholders";a:1:{i:0;s:3:"4.2";}s:4:"type";s:4:"list";s:4:"data";a:260:{s:7:"mercime";s:8:"@mercime";s:10:"a5hleyrich";s:10:"A5hleyRich";s:13:"aaroncampbell";s:17:"Aaron D. Campbell";s:11:"abhishekfdd";s:11:"abhishekfdd";s:15:"adamsilverstein";s:16:"Adam Silverstein";s:12:"mrahmadawais";s:11:"Ahmad Awais";s:11:"alexkingorg";s:9:"Alex King";s:12:"viper007bond";s:25:"Alex Mills (Viper007Bond)";s:6:"deconf";s:10:"Alin Marcu";s:15:"collinsinternet";s:13:"Allan Collins";s:7:"awbauer";s:12:"Andrew Bauer";s:8:"norcross";s:15:"Andrew Norcross";s:18:"ankitgadertcampcom";s:10:"Ankit Gade";s:13:"ankit-k-gupta";s:13:"Ankit K Gupta";s:7:"atimmer";s:16:"Anton Timmermans";s:6:"aramzs";s:19:"Aram Zucker-Scharff";s:10:"arminbraun";s:10:"ArminBraun";s:7:"ashfame";s:7:"Ashfame";s:8:"filosofo";s:13:"Austin Matzko";s:5:"avryl";s:5:"avryl";s:10:"barrykooij";s:11:"Barry Kooij";s:10:"beaulebens";s:11:"Beau Lebens";s:6:"bendoh";s:24:"Ben Doherty (Oomph, Inc)";s:15:"bananastalktome";s:15:"Billy Schneider";s:9:"krogsgard";s:15:"Brian Krogsgard";s:8:"bswatson";s:12:"Brian Watson";s:8:"calevans";s:8:"CalEvans";s:13:"carolinegeven";s:13:"carolinegeven";s:20:"caseypatrickdriscoll";s:14:"Casey Driscoll";s:6:"caspie";s:6:"Caspie";s:4:"cdog";s:14:"Catalin Dogaru";s:11:"chipbennett";s:12:"Chip Bennett";s:7:"chipx86";s:7:"chipx86";s:6:"chrico";s:6:"ChriCo";s:11:"cbaldelomar";s:16:"Chris Baldelomar";s:10:"c3mdigital";s:14:"Chris Olbekson";s:10:"cfoellmann";s:19:"Christian Foellmann";s:6:"cfinke";s:17:"Christopher Finke";s:11:"clifgriffin";s:15:"Clifton Griffin";s:5:"codix";s:11:"Code Master";s:6:"corphi";s:6:"Corphi";s:12:"couturefreak";s:13:"Courtney Ivey";s:13:"craig-ralston";s:13:"Craig Ralston";s:7:"cweiske";s:7:"cweiske";s:11:"extendwings";s:17:"Daisuke Takahashi";s:8:"timersys";s:6:"Damian";s:15:"danielbachhuber";s:16:"Daniel Bachhuber";s:10:"redsweater";s:27:"Daniel Jalkut (Red Sweater)";s:7:"dkotter";s:12:"Darin Kotter";s:6:"nerrad";s:22:"Darren Ethier (nerrad)";s:4:"dllh";s:26:"Daryl L. L. Houston (dllh)";s:7:"dmchale";s:11:"Dave McHale";s:13:"davidakennedy";s:16:"David A. Kennedy";s:13:"davidanderson";s:14:"David Anderson";s:8:"folletto";s:24:"Davide ''Folletto'' Casali";s:16:"davideugenepratt";s:16:"davideugenepratt";s:14:"davidhamiltron";s:14:"davidhamiltron";s:3:"dlh";s:13:"David Herrera";s:17:"denis-de-bernardy";s:17:"Denis de Bernardy";s:6:"dsmart";s:11:"Derek Smart";s:12:"designsimply";s:12:"designsimply";s:14:"dipeshkakadiya";s:15:"dipesh.kakadiya";s:11:"doublesharp";s:11:"doublesharp";s:7:"dzerycz";s:7:"DzeryCZ";s:6:"kucrut";s:11:"Dzikri Aziz";s:12:"emazovetskiy";s:13:"e.mazovetskiy";s:10:"oso96_2000";s:15:"Eduardo Reveles";s:4:"cais";s:14:"Edward Caissie";s:10:"eliorivero";s:11:"Elio Rivero";s:14:"elliottcarlson";s:14:"elliottcarlson";s:4:"enej";s:4:"enej";s:9:"ericlewis";s:17:"Eric Andrew Lewis";s:8:"ebinnion";s:12:"Eric Binnion";s:8:"ethitter";s:12:"Erick Hitter";s:11:"evansolomon";s:12:"Evan Solomon";s:6:"fab1en";s:17:"Fabien Quatravaux";s:7:"fhwebcs";s:7:"fhwebcs";s:13:"floriansimeth";s:14:"Florian Simeth";s:7:"bueltge";s:13:"Frank Bueltge";s:7:"frankpw";s:22:"Frank P. Walentynowicz";s:10:"f-j-kaiser";s:18:"Franz Josef Kaiser";s:7:"garyc40";s:8:"Gary Cao";s:5:"garyj";s:10:"Gary Jones";s:7:"geertdd";s:16:"Geert De Deckere";s:8:"genkisan";s:8:"genkisan";s:15:"georgestephanis";s:16:"George Stephanis";s:14:"grahamarmfield";s:15:"Graham Armfield";s:6:"webord";s:15:"Gustavo Bordoni";s:5:"hakre";s:5:"hakre";s:15:"harishchaudhari";s:16:"Harish Chaudhari";s:7:"hauvong";s:7:"hauvong";s:12:"herbmillerjr";s:12:"herbmillerjr";s:3:"hew";s:3:"Hew";s:4:"hnle";s:7:"Hinaloe";s:6:"horike";s:6:"horike";s:11:"hlashbrooke";s:15:"Hugh Lashbrooke";s:9:"hugobaeta";s:10:"Hugo Baeta";s:7:"iandunn";s:8:"Ian Dunn";s:9:"ianmjones";s:9:"ianmjones";s:8:"idealien";s:8:"idealien";s:5:"imath";s:5:"imath";s:7:"ipstenu";s:22:"Ipstenu (Mika Epstein)";s:8:"jdgrimes";s:11:"J.D. Grimes";s:9:"jacklenox";s:10:"Jack Lenox";s:12:"jamescollins";s:13:"James Collins";s:11:"janhenckens";s:11:"janhenckens";s:11:"jfarthing84";s:13:"Jeff Farthing";s:9:"cheffheid";s:14:"Jeffrey de Wit";s:5:"jesin";s:7:"Jesin A";s:8:"jipmoors";s:8:"jipmoors";s:6:"jartes";s:10:"Joan Artes";s:8:"yo-l1982";s:14:"Joel Bernerman";s:9:"joemcgill";s:10:"Joe McGill";s:4:"joen";s:13:"Joen Asmussen";s:10:"johneckman";s:11:"John Eckman";s:15:"johnjamesjacoby";s:17:"John James Jacoby";s:12:"jlevandowski";s:16:"John Levandowski";s:7:"desrosj";s:19:"Jonathan Desrosiers";s:14:"joostdekeijzer";s:16:"joost de keijzer";s:11:"joostdevalk";s:13:"Joost de Valk";s:10:"jcastaneda";s:14:"Jose Castaneda";s:12:"joshlevinson";s:13:"Josh Levinson";s:6:"jphase";s:6:"jphase";s:8:"juliobox";s:12:"Julio Potier";s:9:"kopepasah";s:16:"Justin Kopepasah";s:11:"jtsternberg";s:16:"Justin Sternberg";s:11:"justincwatt";s:11:"Justin Watt";s:10:"kadamwhite";s:12:"K.Adam White";s:7:"trepmal";s:16:"Kailey (trepmal)";s:6:"ryelle";s:10:"Kelly Dwan";s:12:"kevdotbadger";s:12:"Kevin Ruscoe";s:8:"kpdesign";s:11:"Kim Parsell";s:7:"ixkaito";s:4:"Kite";s:9:"kovshenin";s:20:"Konstantin Kovshenin";s:8:"obenland";s:19:"Konstantin Obenland";s:7:"mindrun";s:7:"Leonard";s:6:"leopeo";s:16:"Leonardo Giacone";s:7:"lgladdy";s:11:"Liam Gladdy";s:9:"maimairel";s:9:"maimairel";s:6:"mako09";s:4:"Mako";s:11:"funkatronic";s:15:"Manny Fleurmond";s:12:"marcelomazza";s:12:"marcelomazza";s:11:"marcochiesi";s:12:"Marco Chiesi";s:4:"mkaz";s:18:"Marcus Kazmierczak";s:9:"nofearinc";s:12:"Mario Peshev";s:7:"clorith";s:16:"Marius (Clorith)";s:12:"markoheijnen";s:13:"Marko Heijnen";s:5:"senff";s:10:"Mark Senff";s:9:"mgibbs189";s:10:"Matt Gibbs";s:7:"mboynes";s:14:"Matthew Boynes";s:19:"mattheweppelsheimer";s:20:"Matthew Eppelsheimer";s:7:"mattheu";s:20:"Matthew Haines-Young";s:5:"sivel";s:10:"Matt Martz";s:9:"mattwiebe";s:10:"Matt Wiebe";s:8:"mattyrob";s:8:"mattyrob";s:4:"mzak";s:8:"Matt Zak";s:9:"maxcutler";s:10:"Max Cutler";s:13:"mehulkaklotar";s:13:"mehulkaklotar";s:9:"melchoyce";s:10:"Mel Choyce";s:7:"meloniq";s:7:"meloniq";s:8:"mdawaffe";s:24:"Michael Adams (mdawaffe)";s:6:"tw2113";s:16:"Michael Beckwith";s:11:"michalzuber";s:11:"michalzuber";s:4:"mdgl";s:16:"Mike Glendinning";s:12:"mikehansenme";s:11:"Mike Hansen";s:9:"thaicloud";s:11:"Mike Jordan";s:12:"mikengarrett";s:12:"MikeNGarrett";s:12:"mikeschinkel";s:13:"Mike Schinkel";s:7:"dimadin";s:11:"Milan Dinic";s:5:"mmn-o";s:5:"mmn-o";s:6:"batmoo";s:15:"Mohammad Jangda";s:6:"momdad";s:6:"MomDad";s:11:"morganestes";s:12:"Morgan Estes";s:8:"morpheu5";s:8:"Morpheu5";s:3:"Nao";s:12:"Naoko Takano";s:13:"nathan_dawson";s:13:"nathan_dawson";s:8:"neil_pie";s:8:"Neil Pie";s:14:"nicnicnicdevos";s:14:"nicnicnicdevos";s:4:"nikv";s:12:"Nikhil Vimal";s:10:"ninnypants";s:10:"ninnypants";s:5:"nitkr";s:5:"nitkr";s:14:"nunomorgadinho";s:15:"Nuno Morgadinho";s:11:"originalexe";s:11:"OriginalEXE";s:16:"pareshradadiya-1";s:15:"Paresh Radadiya";s:8:"pathawks";s:9:"Pat Hawks";s:7:"pbearne";s:11:"Paul Bearne";s:13:"paulschreiber";s:14:"Paul Schreiber";s:9:"paulwilde";s:10:"Paul Wilde";s:9:"pavelevap";s:9:"pavelevap";s:10:"sirbrillig";s:12:"Payton Swick";s:8:"petemall";s:9:"Pete Mall";s:10:"gungeekatx";s:11:"Pete Nelson";s:13:"peterwilsoncc";s:12:"Peter Wilson";s:7:"mordauk";s:17:"Pippin Williamson";s:9:"podpirate";s:9:"podpirate";s:14:"postpostmodern";s:14:"postpostmodern";s:11:"nprasath002";s:17:"Prasath Nadarajah";s:11:"prasoon2211";s:11:"prasoon2211";s:5:"cyman";s:13:"Primoz Cigler";s:5:"r-a-y";s:5:"r-a-y";s:11:"rachelbaker";s:12:"Rachel Baker";s:13:"rahulbhangale";s:13:"rahulbhangale";s:5:"ramiy";s:14:"Rami Yushuvaev";s:7:"lamosty";s:15:"Rastislav Lamos";s:18:"ravindra-pal-singh";s:18:"Ravindra Pal Singh";s:12:"rianrietveld";s:13:"Rian Rietveld";s:12:"ritteshpatel";s:12:"Ritesh Patel";s:11:"miqrogroove";s:13:"Robert Chapin";s:13:"rodrigosprimo";s:13:"Rodrigo Primo";s:15:"magicroundabout";s:11:"Ross Wintle";s:6:"rmarks";s:10:"Ryan Marks";s:11:"sagarjadhav";s:11:"sagarjadhav";s:12:"solarissmoke";s:10:"Samir Shah";s:8:"samo9789";s:8:"samo9789";s:12:"samuelsidler";s:13:"Samuel Sidler";s:13:"scottgonzalez";s:14:"scott.gonzalez";s:6:"sgrant";s:11:"Scott Grant";s:11:"coffee2code";s:12:"Scott Reilly";s:8:"greglone";s:12:"ScreenfeedFr";s:6:"scribu";s:6:"scribu";s:10:"seanchayes";s:10:"Sean Hayes";s:13:"sergejmueller";s:13:"Sergej Muller";s:10:"sevenspark";s:10:"sevenspark";s:13:"simonwheatley";s:14:"Simon Wheatley";s:7:"siobhan";s:7:"Siobhan";s:6:"sippis";s:6:"sippis";s:13:"slobodanmanic";s:14:"Slobodan Manic";s:9:"sillybean";s:15:"Stephanie Leary";s:6:"netweb";s:13:"Stephen Edgar";s:13:"stevegrunwell";s:14:"Steve Grunwell";s:17:"stevehickeydesign";s:17:"stevehickeydesign";s:11:"stevenkword";s:11:"Steven Word";s:5:"taka2";s:5:"taka2";s:10:"iamtakashi";s:12:"Takashi Irie";s:5:"hissy";s:16:"Takuro Hishikawa";s:8:"themiked";s:8:"theMikeD";s:8:"thomaswm";s:8:"thomaswm";s:11:"ipm-frommen";s:16:"Thorsten Frommen";s:10:"tillkruess";s:4:"Till";s:17:"timothyblynjacobs";s:14:"Timothy Jacobs";s:6:"tiqbiz";s:6:"tiqbiz";s:8:"tmatsuur";s:8:"tmatsuur";s:8:"tmeister";s:8:"tmeister";s:8:"tobiasbg";s:8:"TobiasBg";s:9:"tschutter";s:15:"Tobias Schutter";s:6:"tomdxw";s:6:"tomdxw";s:15:"travisnorthcutt";s:16:"Travis Northcutt";s:11:"trishasalas";s:11:"trishasalas";s:7:"tywayne";s:10:"Ty Carlson";s:4:"uamv";s:4:"UaMV";s:10:"desaiuditd";s:10:"Udit Desai";s:8:"sorich87";s:13:"Ulrich Sossou";s:11:"veritaserum";s:11:"Veritaserum";s:14:"voldemortensen";s:14:"voldemortensen";s:10:"volodymyrc";s:10:"VolodymyrC";s:6:"vortfu";s:6:"vortfu";s:7:"welcher";s:7:"welcher";s:7:"earnjam";s:17:"William Earnhardt";s:9:"willstedt";s:9:"willstedt";s:13:"wordpressorru";s:11:"WordPressor";}}s:9:"libraries";a:3:{s:4:"name";s:18:"External Libraries";s:4:"type";s:9:"libraries";s:4:"data";a:29:{i:0;a:2:{i:0;s:11:"Backbone.js";i:1;s:22:"http://backbonejs.org/";}i:1;a:2:{i:0;s:10:"Class POP3";i:1;s:24:"http://squirrelmail.org/";}i:2;a:2:{i:0;s:16:"Color Animations";i:1;s:32:"http://plugins.jquery.com/color/";}i:3;a:2:{i:0;s:15:"Horde Text Diff";i:1;s:22:"http://pear.horde.org/";}i:4;a:2:{i:0;s:11:"hoverIntent";i:1;s:45:"http://plugins.jquery.com/project/hoverIntent";}i:5;a:2:{i:0;s:13:"imgAreaSelect";i:1;s:42:"http://odyniec.net/projects/imgareaselect/";}i:6;a:2:{i:0;s:4:"Iris";i:1;s:34:"https://github.com/Automattic/Iris";}i:7;a:2:{i:0;s:6:"jQuery";i:1;s:18:"http://jquery.com/";}i:8;a:2:{i:0;s:9:"jQuery UI";i:1;s:20:"http://jqueryui.com/";}i:9;a:2:{i:0;s:14:"jQuery Hotkeys";i:1;s:41:"https://github.com/tzuryby/jquery.hotkeys";}i:10;a:2:{i:0;s:22:"jQuery serializeObject";i:1;s:49:"http://benalman.com/projects/jquery-misc-plugins/";}i:11;a:2:{i:0;s:12:"jQuery.query";i:1;s:39:"http://plugins.jquery.com/query-object/";}i:12;a:2:{i:0;s:14:"jQuery.suggest";i:1;s:41:"http://plugins.jquery.com/project/suggest";}i:13;a:2:{i:0;s:21:"jQuery UI Touch Punch";i:1;s:27:"http://touchpunch.furf.com/";}i:14;a:2:{i:0;s:5:"json2";i:1;s:43:"https://github.com/douglascrockford/JSON-js";}i:15;a:2:{i:0;s:7:"Masonry";i:1;s:28:"http://masonry.desandro.com/";}i:16;a:2:{i:0;s:15:"MediaElement.js";i:1;s:26:"http://mediaelementjs.com/";}i:17;a:2:{i:0;s:6:"PclZip";i:1;s:33:"http://www.phpconcept.net/pclzip/";}i:18;a:2:{i:0;s:6:"PemFTP";i:1;s:50:"http://www.phpclasses.org/browse/package/1743.html";}i:19;a:2:{i:0;s:6:"phpass";i:1;s:31:"http://www.openwall.com/phpass/";}i:20;a:2:{i:0;s:9:"PHPMailer";i:1;s:55:"http://code.google.com/a/apache-extras.org/p/phpmailer/";}i:21;a:2:{i:0;s:8:"Plupload";i:1;s:24:"http://www.plupload.com/";}i:22;a:2:{i:0;s:9:"SimplePie";i:1;s:21:"http://simplepie.org/";}i:23;a:2:{i:0;s:27:"The Incutio XML-RPC Library";i:1;s:34:"http://scripts.incutio.com/xmlrpc/";}i:24;a:2:{i:0;s:8:"Thickbox";i:1;s:32:"http://codylindley.com/thickbox/";}i:25;a:2:{i:0;s:7:"TinyMCE";i:1;s:23:"http://www.tinymce.com/";}i:26;a:2:{i:0;s:7:"Twemoji";i:1;s:34:"https://github.com/twitter/twemoji";}i:27;a:2:{i:0;s:13:"Underscore.js";i:1;s:24:"http://underscorejs.org/";}i:28;a:2:{i:0;s:6:"zxcvbn";i:1;s:33:"https://github.com/dropbox/zxcvbn";}}}}s:4:"data";a:2:{s:8:"profiles";s:33:"https://profiles.wordpress.org/%s";s:7:"version";s:3:"4.2";}}', 'yes');
INSERT INTO `wp_options` VALUES(146, '_site_transient_timeout_wordpress_credits_en_US', '1432740460', 'yes');
INSERT INTO `wp_options` VALUES(221, '_site_transient_available_translations', 'a:56:{s:2:"ar";a:8:{s:8:"language";s:2:"ar";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 06:57:37";s:12:"english_name";s:6:"Arabic";s:11:"native_name";s:14:"العربية";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/ar.zip";s:3:"iso";a:2:{i:1;s:2:"ar";i:2;s:3:"ara";}s:7:"strings";a:1:{s:8:"continue";s:16:"المتابعة";}}s:2:"az";a:8:{s:8:"language";s:2:"az";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-02 03:57:09";s:12:"english_name";s:11:"Azerbaijani";s:11:"native_name";s:16:"Azərbaycan dili";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/az.zip";s:3:"iso";a:2:{i:1;s:2:"az";i:2;s:3:"aze";}s:7:"strings";a:1:{s:8:"continue";s:5:"Davam";}}s:5:"bg_BG";a:8:{s:8:"language";s:5:"bg_BG";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-27 06:36:25";s:12:"english_name";s:9:"Bulgarian";s:11:"native_name";s:18:"Български";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/bg_BG.zip";s:3:"iso";a:2:{i:1;s:2:"bg";i:2;s:3:"bul";}s:7:"strings";a:1:{s:8:"continue";s:22:"Продължение";}}s:5:"bs_BA";a:8:{s:8:"language";s:5:"bs_BA";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-25 18:55:51";s:12:"english_name";s:7:"Bosnian";s:11:"native_name";s:8:"Bosanski";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/bs_BA.zip";s:3:"iso";a:2:{i:1;s:2:"bs";i:2;s:3:"bos";}s:7:"strings";a:1:{s:8:"continue";s:7:"Nastavi";}}s:2:"ca";a:8:{s:8:"language";s:2:"ca";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-24 05:23:15";s:12:"english_name";s:7:"Catalan";s:11:"native_name";s:7:"Català";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/ca.zip";s:3:"iso";a:2:{i:1;s:2:"ca";i:2;s:3:"cat";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continua";}}s:2:"cy";a:8:{s:8:"language";s:2:"cy";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-27 19:16:32";s:12:"english_name";s:5:"Welsh";s:11:"native_name";s:7:"Cymraeg";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/cy.zip";s:3:"iso";a:2:{i:1;s:2:"cy";i:2;s:3:"cym";}s:7:"strings";a:1:{s:8:"continue";s:6:"Parhau";}}s:5:"da_DK";a:8:{s:8:"language";s:5:"da_DK";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 18:34:01";s:12:"english_name";s:6:"Danish";s:11:"native_name";s:5:"Dansk";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/da_DK.zip";s:3:"iso";a:2:{i:1;s:2:"da";i:2;s:3:"dan";}s:7:"strings";a:1:{s:8:"continue";s:12:"Forts&#230;t";}}s:5:"de_CH";a:8:{s:8:"language";s:5:"de_CH";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:08";s:12:"english_name";s:20:"German (Switzerland)";s:11:"native_name";s:17:"Deutsch (Schweiz)";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/de_CH.zip";s:3:"iso";a:1:{i:1;s:2:"de";}s:7:"strings";a:1:{s:8:"continue";s:10:"Fortfahren";}}s:5:"de_DE";a:8:{s:8:"language";s:5:"de_DE";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-28 23:38:57";s:12:"english_name";s:6:"German";s:11:"native_name";s:7:"Deutsch";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/de_DE.zip";s:3:"iso";a:1:{i:1;s:2:"de";}s:7:"strings";a:1:{s:8:"continue";s:10:"Fortfahren";}}s:2:"el";a:8:{s:8:"language";s:2:"el";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-10 21:13:03";s:12:"english_name";s:5:"Greek";s:11:"native_name";s:16:"Ελληνικά";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/el.zip";s:3:"iso";a:2:{i:1;s:2:"el";i:2;s:3:"ell";}s:7:"strings";a:1:{s:8:"continue";s:16:"Συνέχεια";}}s:5:"en_GB";a:8:{s:8:"language";s:5:"en_GB";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:09";s:12:"english_name";s:12:"English (UK)";s:11:"native_name";s:12:"English (UK)";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/en_GB.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:5:"en_AU";a:8:{s:8:"language";s:5:"en_AU";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:09";s:12:"english_name";s:19:"English (Australia)";s:11:"native_name";s:19:"English (Australia)";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/en_AU.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:5:"en_CA";a:8:{s:8:"language";s:5:"en_CA";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:08";s:12:"english_name";s:16:"English (Canada)";s:11:"native_name";s:16:"English (Canada)";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/en_CA.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:2:"eo";a:8:{s:8:"language";s:2:"eo";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:09";s:12:"english_name";s:9:"Esperanto";s:11:"native_name";s:9:"Esperanto";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/eo.zip";s:3:"iso";a:2:{i:1;s:2:"eo";i:2;s:3:"epo";}s:7:"strings";a:1:{s:8:"continue";s:8:"Daŭrigi";}}s:5:"es_MX";a:8:{s:8:"language";s:5:"es_MX";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-24 16:03:38";s:12:"english_name";s:16:"Spanish (Mexico)";s:11:"native_name";s:19:"Español de México";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/es_MX.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_PE";a:8:{s:8:"language";s:5:"es_PE";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-25 13:39:01";s:12:"english_name";s:14:"Spanish (Peru)";s:11:"native_name";s:17:"Español de Perú";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/es_PE.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_ES";a:8:{s:8:"language";s:5:"es_ES";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-18 10:50:06";s:12:"english_name";s:15:"Spanish (Spain)";s:11:"native_name";s:8:"Español";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/es_ES.zip";s:3:"iso";a:1:{i:1;s:2:"es";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_CL";a:8:{s:8:"language";s:5:"es_CL";s:7:"version";s:3:"4.0";s:7:"updated";s:19:"2014-09-04 19:47:01";s:12:"english_name";s:15:"Spanish (Chile)";s:11:"native_name";s:17:"Español de Chile";s:7:"package";s:61:"http://downloads.wordpress.org/translation/core/4.0/es_CL.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:2:"eu";a:8:{s:8:"language";s:2:"eu";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:09";s:12:"english_name";s:6:"Basque";s:11:"native_name";s:7:"Euskara";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/eu.zip";s:3:"iso";a:2:{i:1;s:2:"eu";i:2;s:3:"eus";}s:7:"strings";a:1:{s:8:"continue";s:8:"Jarraitu";}}s:5:"fa_IR";a:8:{s:8:"language";s:5:"fa_IR";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-16 10:01:41";s:12:"english_name";s:7:"Persian";s:11:"native_name";s:10:"فارسی";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/fa_IR.zip";s:3:"iso";a:2:{i:1;s:2:"fa";i:2;s:3:"fas";}s:7:"strings";a:1:{s:8:"continue";s:10:"ادامه";}}s:2:"fi";a:8:{s:8:"language";s:2:"fi";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-15 10:49:37";s:12:"english_name";s:7:"Finnish";s:11:"native_name";s:5:"Suomi";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/fi.zip";s:3:"iso";a:2:{i:1;s:2:"fi";i:2;s:3:"fin";}s:7:"strings";a:1:{s:8:"continue";s:5:"Jatka";}}s:5:"fr_FR";a:8:{s:8:"language";s:5:"fr_FR";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-29 17:08:38";s:12:"english_name";s:15:"French (France)";s:11:"native_name";s:9:"Français";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/fr_FR.zip";s:3:"iso";a:1:{i:1;s:2:"fr";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuer";}}s:2:"gd";a:8:{s:8:"language";s:2:"gd";s:7:"version";s:3:"4.0";s:7:"updated";s:19:"2014-09-05 17:37:43";s:12:"english_name";s:15:"Scottish Gaelic";s:11:"native_name";s:9:"Gàidhlig";s:7:"package";s:58:"http://downloads.wordpress.org/translation/core/4.0/gd.zip";s:3:"iso";a:3:{i:1;s:2:"gd";i:2;s:3:"gla";i:3;s:3:"gla";}s:7:"strings";a:1:{s:8:"continue";s:15:"Lean air adhart";}}s:5:"gl_ES";a:8:{s:8:"language";s:5:"gl_ES";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:08";s:12:"english_name";s:8:"Galician";s:11:"native_name";s:6:"Galego";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/gl_ES.zip";s:3:"iso";a:2:{i:1;s:2:"gl";i:2;s:3:"glg";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:3:"haz";a:8:{s:8:"language";s:3:"haz";s:7:"version";s:5:"4.1.5";s:7:"updated";s:19:"2015-03-26 15:20:27";s:12:"english_name";s:8:"Hazaragi";s:11:"native_name";s:15:"هزاره گی";s:7:"package";s:61:"http://downloads.wordpress.org/translation/core/4.1.5/haz.zip";s:3:"iso";a:1:{i:2;s:3:"haz";}s:7:"strings";a:1:{s:8:"continue";s:10:"ادامه";}}s:5:"he_IL";a:8:{s:8:"language";s:5:"he_IL";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 19:32:58";s:12:"english_name";s:6:"Hebrew";s:11:"native_name";s:16:"עִבְרִית";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/he_IL.zip";s:3:"iso";a:1:{i:1;s:2:"he";}s:7:"strings";a:1:{s:8:"continue";s:12:"להמשיך";}}s:2:"hr";a:8:{s:8:"language";s:2:"hr";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-27 08:22:08";s:12:"english_name";s:8:"Croatian";s:11:"native_name";s:8:"Hrvatski";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/hr.zip";s:3:"iso";a:2:{i:1;s:2:"hr";i:2;s:3:"hrv";}s:7:"strings";a:1:{s:8:"continue";s:7:"Nastavi";}}s:5:"hu_HU";a:8:{s:8:"language";s:5:"hu_HU";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 06:43:50";s:12:"english_name";s:9:"Hungarian";s:11:"native_name";s:6:"Magyar";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/hu_HU.zip";s:3:"iso";a:2:{i:1;s:2:"hu";i:2;s:3:"hun";}s:7:"strings";a:1:{s:8:"continue";s:7:"Tovább";}}s:5:"id_ID";a:8:{s:8:"language";s:5:"id_ID";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 07:07:32";s:12:"english_name";s:10:"Indonesian";s:11:"native_name";s:16:"Bahasa Indonesia";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/id_ID.zip";s:3:"iso";a:2:{i:1;s:2:"id";i:2;s:3:"ind";}s:7:"strings";a:1:{s:8:"continue";s:9:"Lanjutkan";}}s:5:"is_IS";a:8:{s:8:"language";s:5:"is_IS";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-27 11:14:20";s:12:"english_name";s:9:"Icelandic";s:11:"native_name";s:9:"Íslenska";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/is_IS.zip";s:3:"iso";a:2:{i:1;s:2:"is";i:2;s:3:"isl";}s:7:"strings";a:1:{s:8:"continue";s:6:"Áfram";}}s:5:"it_IT";a:8:{s:8:"language";s:5:"it_IT";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-23 17:17:36";s:12:"english_name";s:7:"Italian";s:11:"native_name";s:8:"Italiano";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/it_IT.zip";s:3:"iso";a:2:{i:1;s:2:"it";i:2;s:3:"ita";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continua";}}s:2:"ja";a:8:{s:8:"language";s:2:"ja";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-15 08:57:03";s:12:"english_name";s:8:"Japanese";s:11:"native_name";s:9:"日本語";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/ja.zip";s:3:"iso";a:1:{i:1;s:2:"ja";}s:7:"strings";a:1:{s:8:"continue";s:9:"続ける";}}s:5:"ko_KR";a:8:{s:8:"language";s:5:"ko_KR";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 06:57:22";s:12:"english_name";s:6:"Korean";s:11:"native_name";s:9:"한국어";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/ko_KR.zip";s:3:"iso";a:2:{i:1;s:2:"ko";i:2;s:3:"kor";}s:7:"strings";a:1:{s:8:"continue";s:6:"계속";}}s:5:"lt_LT";a:8:{s:8:"language";s:5:"lt_LT";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:08";s:12:"english_name";s:10:"Lithuanian";s:11:"native_name";s:15:"Lietuvių kalba";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/lt_LT.zip";s:3:"iso";a:2:{i:1;s:2:"lt";i:2;s:3:"lit";}s:7:"strings";a:1:{s:8:"continue";s:6:"Tęsti";}}s:5:"my_MM";a:8:{s:8:"language";s:5:"my_MM";s:7:"version";s:5:"4.1.5";s:7:"updated";s:19:"2015-03-26 15:57:42";s:12:"english_name";s:17:"Myanmar (Burmese)";s:11:"native_name";s:15:"ဗမာစာ";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.1.5/my_MM.zip";s:3:"iso";a:2:{i:1;s:2:"my";i:2;s:3:"mya";}s:7:"strings";a:1:{s:8:"continue";s:54:"ဆက်လက်လုပ်ေဆာင်ပါ။";}}s:5:"nb_NO";a:8:{s:8:"language";s:5:"nb_NO";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-27 10:29:43";s:12:"english_name";s:19:"Norwegian (Bokmål)";s:11:"native_name";s:13:"Norsk bokmål";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/nb_NO.zip";s:3:"iso";a:2:{i:1;s:2:"nb";i:2;s:3:"nob";}s:7:"strings";a:1:{s:8:"continue";s:8:"Fortsett";}}s:5:"nl_NL";a:8:{s:8:"language";s:5:"nl_NL";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 06:59:29";s:12:"english_name";s:5:"Dutch";s:11:"native_name";s:10:"Nederlands";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/nl_NL.zip";s:3:"iso";a:2:{i:1;s:2:"nl";i:2;s:3:"nld";}s:7:"strings";a:1:{s:8:"continue";s:8:"Doorgaan";}}s:5:"nn_NO";a:8:{s:8:"language";s:5:"nn_NO";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:09";s:12:"english_name";s:19:"Norwegian (Nynorsk)";s:11:"native_name";s:13:"Norsk nynorsk";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/nn_NO.zip";s:3:"iso";a:2:{i:1;s:2:"nn";i:2;s:3:"nno";}s:7:"strings";a:1:{s:8:"continue";s:9:"Hald fram";}}s:3:"oci";a:8:{s:8:"language";s:3:"oci";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-25 19:53:10";s:12:"english_name";s:7:"Occitan";s:11:"native_name";s:7:"Occitan";s:7:"package";s:61:"http://downloads.wordpress.org/translation/core/4.2.2/oci.zip";s:3:"iso";a:2:{i:1;s:2:"oc";i:2;s:3:"oci";}s:7:"strings";a:1:{s:8:"continue";s:9:"Contunhar";}}s:5:"pl_PL";a:8:{s:8:"language";s:5:"pl_PL";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-09 10:15:05";s:12:"english_name";s:6:"Polish";s:11:"native_name";s:6:"Polski";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/pl_PL.zip";s:3:"iso";a:2:{i:1;s:2:"pl";i:2;s:3:"pol";}s:7:"strings";a:1:{s:8:"continue";s:9:"Kontynuuj";}}s:2:"ps";a:8:{s:8:"language";s:2:"ps";s:7:"version";s:5:"4.1.5";s:7:"updated";s:19:"2015-03-29 22:19:48";s:12:"english_name";s:6:"Pashto";s:11:"native_name";s:8:"پښتو";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.1.5/ps.zip";s:3:"iso";a:1:{i:1;s:2:"ps";}s:7:"strings";a:1:{s:8:"continue";s:8:"دوام";}}s:5:"pt_PT";a:8:{s:8:"language";s:5:"pt_PT";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-27 09:25:14";s:12:"english_name";s:21:"Portuguese (Portugal)";s:11:"native_name";s:10:"Português";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/pt_PT.zip";s:3:"iso";a:1:{i:1;s:2:"pt";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"pt_BR";a:8:{s:8:"language";s:5:"pt_BR";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 06:44:19";s:12:"english_name";s:19:"Portuguese (Brazil)";s:11:"native_name";s:20:"Português do Brasil";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/pt_BR.zip";s:3:"iso";a:2:{i:1;s:2:"pt";i:2;s:3:"por";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"ro_RO";a:8:{s:8:"language";s:5:"ro_RO";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-21 15:14:01";s:12:"english_name";s:8:"Romanian";s:11:"native_name";s:8:"Română";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/ro_RO.zip";s:3:"iso";a:2:{i:1;s:2:"ro";i:2;s:3:"ron";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuă";}}s:5:"ru_RU";a:8:{s:8:"language";s:5:"ru_RU";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:08";s:12:"english_name";s:7:"Russian";s:11:"native_name";s:14:"Русский";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/ru_RU.zip";s:3:"iso";a:2:{i:1;s:2:"ru";i:2;s:3:"rus";}s:7:"strings";a:1:{s:8:"continue";s:20:"Продолжить";}}s:5:"sk_SK";a:8:{s:8:"language";s:5:"sk_SK";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 09:29:23";s:12:"english_name";s:6:"Slovak";s:11:"native_name";s:11:"Slovenčina";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/sk_SK.zip";s:3:"iso";a:2:{i:1;s:2:"sk";i:2;s:3:"slk";}s:7:"strings";a:1:{s:8:"continue";s:12:"Pokračovať";}}s:5:"sl_SI";a:8:{s:8:"language";s:5:"sl_SI";s:7:"version";s:5:"4.1.5";s:7:"updated";s:19:"2015-03-26 16:25:46";s:12:"english_name";s:9:"Slovenian";s:11:"native_name";s:13:"Slovenščina";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.1.5/sl_SI.zip";s:3:"iso";a:2:{i:1;s:2:"sl";i:2;s:3:"slv";}s:7:"strings";a:1:{s:8:"continue";s:10:"Nadaljujte";}}s:2:"sq";a:8:{s:8:"language";s:2:"sq";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-05 22:47:02";s:12:"english_name";s:8:"Albanian";s:11:"native_name";s:5:"Shqip";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/sq.zip";s:3:"iso";a:2:{i:1;s:2:"sq";i:2;s:3:"sqi";}s:7:"strings";a:1:{s:8:"continue";s:6:"Vazhdo";}}s:5:"sr_RS";a:8:{s:8:"language";s:5:"sr_RS";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 16:55:54";s:12:"english_name";s:7:"Serbian";s:11:"native_name";s:23:"Српски језик";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/sr_RS.zip";s:3:"iso";a:2:{i:1;s:2:"sr";i:2;s:3:"srp";}s:7:"strings";a:1:{s:8:"continue";s:14:"Настави";}}s:5:"sv_SE";a:8:{s:8:"language";s:5:"sv_SE";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 07:08:28";s:12:"english_name";s:7:"Swedish";s:11:"native_name";s:7:"Svenska";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/sv_SE.zip";s:3:"iso";a:2:{i:1;s:2:"sv";i:2;s:3:"swe";}s:7:"strings";a:1:{s:8:"continue";s:9:"Fortsätt";}}s:2:"th";a:8:{s:8:"language";s:2:"th";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 15:16:26";s:12:"english_name";s:4:"Thai";s:11:"native_name";s:9:"ไทย";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/th.zip";s:3:"iso";a:2:{i:1;s:2:"th";i:2;s:3:"tha";}s:7:"strings";a:1:{s:8:"continue";s:15:"ต่อไป";}}s:5:"tr_TR";a:8:{s:8:"language";s:5:"tr_TR";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-26 07:01:28";s:12:"english_name";s:7:"Turkish";s:11:"native_name";s:8:"Türkçe";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/tr_TR.zip";s:3:"iso";a:2:{i:1;s:2:"tr";i:2;s:3:"tur";}s:7:"strings";a:1:{s:8:"continue";s:5:"Devam";}}s:5:"ug_CN";a:8:{s:8:"language";s:5:"ug_CN";s:7:"version";s:5:"4.1.5";s:7:"updated";s:19:"2015-03-26 16:45:38";s:12:"english_name";s:6:"Uighur";s:11:"native_name";s:9:"Uyƣurqə";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.1.5/ug_CN.zip";s:3:"iso";a:2:{i:1;s:2:"ug";i:2;s:3:"uig";}s:7:"strings";a:1:{s:8:"continue";s:26:"داۋاملاشتۇرۇش";}}s:2:"uk";a:8:{s:8:"language";s:2:"uk";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-05-28 13:43:48";s:12:"english_name";s:9:"Ukrainian";s:11:"native_name";s:20:"Українська";s:7:"package";s:60:"http://downloads.wordpress.org/translation/core/4.2.2/uk.zip";s:3:"iso";a:2:{i:1;s:2:"uk";i:2;s:3:"ukr";}s:7:"strings";a:1:{s:8:"continue";s:20:"Продовжити";}}s:5:"zh_TW";a:8:{s:8:"language";s:5:"zh_TW";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-29 06:37:03";s:12:"english_name";s:16:"Chinese (Taiwan)";s:11:"native_name";s:12:"繁體中文";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/zh_TW.zip";s:3:"iso";a:2:{i:1;s:2:"zh";i:2;s:3:"zho";}s:7:"strings";a:1:{s:8:"continue";s:6:"繼續";}}s:5:"zh_CN";a:8:{s:8:"language";s:5:"zh_CN";s:7:"version";s:5:"4.2.2";s:7:"updated";s:19:"2015-04-23 15:23:08";s:12:"english_name";s:15:"Chinese (China)";s:11:"native_name";s:12:"简体中文";s:7:"package";s:63:"http://downloads.wordpress.org/translation/core/4.2.2/zh_CN.zip";s:3:"iso";a:2:{i:1;s:2:"zh";i:2;s:3:"zho";}s:7:"strings";a:1:{s:8:"continue";s:6:"继续";}}}', 'yes');
INSERT INTO `wp_options` VALUES(250, '_transient_is_multi_author', '0', 'yes');
INSERT INTO `wp_options` VALUES(189, 'theme_mods_twentythirteen', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1432904464;s:4:"data";a:3:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";N;}}}', 'yes');
INSERT INTO `wp_options` VALUES(168, 'current_theme', 'Twenty Fifteen', 'yes');
INSERT INTO `wp_options` VALUES(169, 'theme_mods_store-wp', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1432900115;s:4:"data";a:7:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:24:"first-footer-widget-area";N;s:25:"second-footer-widget-area";N;s:24:"third-footer-widget-area";N;s:25:"fourth-footer-widget-area";N;s:12:"sidebar-shop";N;}}}', 'yes');
INSERT INTO `wp_options` VALUES(170, 'theme_switched', '', 'yes');
INSERT INTO `wp_options` VALUES(171, 'igthemes-optionsframework', 'a:1:{s:2:"id";s:8:"store-wp";}', 'yes');
INSERT INTO `wp_options` VALUES(176, '_transient_igthemes_categories', '1', 'yes');
INSERT INTO `wp_options` VALUES(179, 'theme_mods_twentyfourteen', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1433276740;s:4:"data";a:4:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";N;s:9:"sidebar-3";N;}}}', 'yes');
INSERT INTO `wp_options` VALUES(185, 'widget_nav_menu', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(186, 'widget_pages', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(187, 'widget_tag_cloud', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(209, 'widget_widget_twentyfourteen_ephemera', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes');
INSERT INTO `wp_options` VALUES(214, 'wpts_bncid', 'O:29:"WPtouchDefaultSettingsBNCID30":9:{s:5:"bncid";s:0:"";s:19:"wptouch_license_key";s:0:"";s:16:"license_accepted";b:0;s:21:"license_accepted_time";i:0;s:22:"next_update_check_time";i:1432953902;s:15:"license_expired";s:1:"0";s:19:"license_expiry_date";i:0;s:16:"referral_user_id";b:0;s:15:"current_version";s:5:"3.7.9";}', 'yes');
INSERT INTO `wp_options` VALUES(215, '_transient_timeout_wptouch_update_info', '1432953904', 'no');
INSERT INTO `wp_options` VALUES(216, '_transient_wptouch_update_info', '1', 'no');
INSERT INTO `wp_options` VALUES(245, '_transient_twentyfourteen_category_count', '1', 'yes');
INSERT INTO `wp_options` VALUES(223, 'WPLANG', '', 'yes');
INSERT INTO `wp_options` VALUES(226, '_transient_timeout_settings_errors', '1432922902', 'no');
INSERT INTO `wp_options` VALUES(227, '_transient_settings_errors', 'a:1:{i:0;a:4:{s:7:"setting";s:7:"general";s:4:"code";s:16:"settings_updated";s:7:"message";s:15:"Settings saved.";s:4:"type";s:7:"updated";}}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` VALUES(1, 2, '_wp_page_template', 'default');
INSERT INTO `wp_postmeta` VALUES(3, 4, '_edit_last', '1');
INSERT INTO `wp_postmeta` VALUES(5, 4, '_edit_lock', '1432897485:1');
INSERT INTO `wp_postmeta` VALUES(6, 5, '_wp_attached_file', '2015/05/jay1.jpg');
INSERT INTO `wp_postmeta` VALUES(7, 5, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1600;s:6:"height";i:1200;s:4:"file";s:16:"2015/05/jay1.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:16:"jay1-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:16:"jay1-300x225.jpg";s:5:"width";i:300;s:6:"height";i:225;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:17:"jay1-1024x768.jpg";s:5:"width";i:1024;s:6:"height";i:768;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";d:3.20000000000000017763568394002504646778106689453125;s:6:"credit";s:0:"";s:6:"camera";s:5:"N70-1";s:7:"caption";s:0:"";s:17:"created_timestamp";i:1215162582;s:9:"copyright";s:0:"";s:12:"focal_length";s:3:"4.5";s:3:"iso";s:3:"200";s:13:"shutter_speed";s:8:"0.059213";s:5:"title";s:0:"";s:11:"orientation";i:1;}}');
INSERT INTO `wp_postmeta` VALUES(12, 7, '_edit_last', '1');
INSERT INTO `wp_postmeta` VALUES(11, 2, '_edit_lock', '1432899960:1');
INSERT INTO `wp_postmeta` VALUES(13, 7, '_edit_lock', '1432907304:1');
INSERT INTO `wp_postmeta` VALUES(14, 8, '_wp_attached_file', '2015/05/jay2.jpg');
INSERT INTO `wp_postmeta` VALUES(15, 8, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1600;s:6:"height";i:1200;s:4:"file";s:16:"2015/05/jay2.jpg";s:5:"sizes";a:5:{s:9:"thumbnail";a:4:{s:4:"file";s:16:"jay2-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:16:"jay2-300x225.jpg";s:5:"width";i:300;s:6:"height";i:225;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:17:"jay2-1024x768.jpg";s:5:"width";i:1024;s:6:"height";i:768;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:16:"jay2-672x372.jpg";s:5:"width";i:672;s:6:"height";i:372;s:9:"mime-type";s:10:"image/jpeg";}s:25:"twentyfourteen-full-width";a:4:{s:4:"file";s:17:"jay2-1038x576.jpg";s:5:"width";i:1038;s:6:"height";i:576;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";d:3.20000000000000017763568394002504646778106689453125;s:6:"credit";s:0:"";s:6:"camera";s:5:"N70-1";s:7:"caption";s:0:"";s:17:"created_timestamp";i:1215162600;s:9:"copyright";s:0:"";s:12:"focal_length";s:3:"4.5";s:3:"iso";s:3:"320";s:13:"shutter_speed";s:8:"0.059213";s:5:"title";s:0:"";s:11:"orientation";i:1;}}');
INSERT INTO `wp_postmeta` VALUES(19, 10, '_edit_lock', '1432906362:1');
INSERT INTO `wp_postmeta` VALUES(18, 10, '_edit_last', '1');
INSERT INTO `wp_postmeta` VALUES(20, 11, '_wp_attached_file', '2015/05/jay3.jpg');
INSERT INTO `wp_postmeta` VALUES(21, 11, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1216;s:6:"height";i:912;s:4:"file";s:16:"2015/05/jay3.jpg";s:5:"sizes";a:5:{s:9:"thumbnail";a:4:{s:4:"file";s:16:"jay3-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:16:"jay3-300x225.jpg";s:5:"width";i:300;s:6:"height";i:225;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:17:"jay3-1024x768.jpg";s:5:"width";i:1024;s:6:"height";i:768;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:16:"jay3-672x372.jpg";s:5:"width";i:672;s:6:"height";i:372;s:9:"mime-type";s:10:"image/jpeg";}s:25:"twentyfourteen-full-width";a:4:{s:4:"file";s:17:"jay3-1038x576.jpg";s:5:"width";i:1038;s:6:"height";i:576;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";d:3.20000000000000017763568394002504646778106689453125;s:6:"credit";s:0:"";s:6:"camera";s:5:"N70-1";s:7:"caption";s:0:"";s:17:"created_timestamp";i:1214394522;s:9:"copyright";s:0:"";s:12:"focal_length";s:3:"4.5";s:3:"iso";s:3:"160";s:13:"shutter_speed";s:8:"0.059213";s:5:"title";s:0:"";s:11:"orientation";i:1;}}');
INSERT INTO `wp_postmeta` VALUES(22, 12, '_edit_last', '1');
INSERT INTO `wp_postmeta` VALUES(23, 12, '_edit_lock', '1432908628:1');
INSERT INTO `wp_postmeta` VALUES(24, 13, '_wp_attached_file', '2015/05/jay4.jpg');
INSERT INTO `wp_postmeta` VALUES(25, 13, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:202;s:6:"height";i:237;s:4:"file";s:16:"2015/05/jay4.jpg";s:5:"sizes";a:1:{s:9:"thumbnail";a:4:{s:4:"file";s:16:"jay4-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:11:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;}}');
INSERT INTO `wp_postmeta` VALUES(29, 16, '_edit_lock', '1433278004:1');
INSERT INTO `wp_postmeta` VALUES(28, 16, '_edit_last', '1');
INSERT INTO `wp_postmeta` VALUES(33, 18, '_edit_lock', '1433278536:1');
INSERT INTO `wp_postmeta` VALUES(32, 18, '_edit_last', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` VALUES(1, 1, '2015-05-24 19:08:36', '2015-05-24 19:08:36', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2015-05-24 19:08:36', '2015-05-24 19:08:36', '', 0, 'http://localhost/wordpress/?p=1', 0, 'post', '', 2);
INSERT INTO `wp_posts` VALUES(2, 1, '2015-05-24 19:08:36', '2015-05-24 19:08:36', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://localhost/wordpress/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'open', 'open', '', 'sample-page', '', '', '2015-05-24 19:08:36', '2015-05-24 19:08:36', '', 0, 'http://localhost/wordpress/?page_id=2', 0, 'page', '', 0);
INSERT INTO `wp_posts` VALUES(15, 1, '2015-06-02 20:08:37', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-06-02 20:08:37', '0000-00-00 00:00:00', '', 0, 'http://localhost/wordpress/?p=15', 0, 'post', '', 0);
INSERT INTO `wp_posts` VALUES(4, 1, '2015-05-29 11:05:27', '2015-05-29 11:05:27', '<a href="http://localhost/wordpress/wp-content/uploads/2015/05/jay1.jpg"><img class="alignnone size-medium wp-image-5" src="http://localhost/wordpress/wp-content/uploads/2015/05/jay1-300x225.jpg" alt="jay1" width="300" height="225" /></a>', 'aaaaaaa', '', 'publish', 'open', 'open', '', 'aaaaaaa', '', '', '2015-05-29 11:05:27', '2015-05-29 11:05:27', '', 0, 'http://localhost/wordpress/?p=4', 0, 'post', '', 0);
INSERT INTO `wp_posts` VALUES(5, 1, '2015-05-29 11:05:09', '2015-05-29 11:05:09', '', 'jay1', '', 'inherit', 'open', 'open', '', 'jay1', '', '', '2015-05-29 11:05:09', '2015-05-29 11:05:09', '', 4, 'http://localhost/wordpress/wp-content/uploads/2015/05/jay1.jpg', 0, 'attachment', 'image/jpeg', 0);
INSERT INTO `wp_posts` VALUES(6, 1, '2015-05-29 11:05:27', '2015-05-29 11:05:27', '<a href="http://localhost/wordpress/wp-content/uploads/2015/05/jay1.jpg"><img class="alignnone size-medium wp-image-5" src="http://localhost/wordpress/wp-content/uploads/2015/05/jay1-300x225.jpg" alt="jay1" width="300" height="225" /></a>', 'aaaaaaa', '', 'inherit', 'open', 'open', '', '4-revision-v1', '', '', '2015-05-29 11:05:27', '2015-05-29 11:05:27', '', 4, 'http://localhost/wordpress/2015/05/29/4-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `wp_posts` VALUES(7, 1, '2015-05-29 13:26:12', '2015-05-29 13:26:12', '<a href="http://localhost/wordpress/wp-content/uploads/2015/05/jay2.jpg"><img class="alignnone size-medium wp-image-8" src="http://localhost/wordpress/wp-content/uploads/2015/05/jay2-300x225.jpg" alt="jay2" width="300" height="225" /></a>\r\n\r\njay2 test', 'jay2', '', 'publish', 'open', 'open', '', 'jay2', '', '', '2015-05-29 13:26:12', '2015-05-29 13:26:12', '', 0, 'http://localhost/wordpress/?p=7', 0, 'post', '', 0);
INSERT INTO `wp_posts` VALUES(8, 1, '2015-05-29 13:25:57', '2015-05-29 13:25:57', '', 'jay2', '', 'inherit', 'open', 'open', '', 'jay2', '', '', '2015-05-29 13:25:57', '2015-05-29 13:25:57', '', 7, 'http://localhost/wordpress/wp-content/uploads/2015/05/jay2.jpg', 0, 'attachment', 'image/jpeg', 0);
INSERT INTO `wp_posts` VALUES(9, 1, '2015-05-29 13:26:12', '2015-05-29 13:26:12', '<a href="http://localhost/wordpress/wp-content/uploads/2015/05/jay2.jpg"><img class="alignnone size-medium wp-image-8" src="http://localhost/wordpress/wp-content/uploads/2015/05/jay2-300x225.jpg" alt="jay2" width="300" height="225" /></a>\r\n\r\njay2 test', 'jay2', '', 'inherit', 'open', 'open', '', '7-revision-v1', '', '', '2015-05-29 13:26:12', '2015-05-29 13:26:12', '', 7, 'http://localhost/wordpress/2015/05/29/7-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `wp_posts` VALUES(10, 1, '2015-05-29 13:32:42', '0000-00-00 00:00:00', '', 'jay3', '', 'draft', 'open', 'open', '', '', '', '', '2015-05-29 13:32:42', '2015-05-29 13:32:42', '', 0, 'http://localhost/wordpress/?p=10', 0, 'post', '', 0);
INSERT INTO `wp_posts` VALUES(11, 1, '2015-05-29 13:33:03', '2015-05-29 13:33:03', '', 'jay3', '', 'inherit', 'open', 'open', '', 'jay3', '', '', '2015-05-29 13:33:03', '2015-05-29 13:33:03', '', 10, 'http://localhost/wordpress/wp-content/uploads/2015/05/jay3.jpg', 0, 'attachment', 'image/jpeg', 0);
INSERT INTO `wp_posts` VALUES(12, 1, '2015-05-29 13:52:04', '2015-05-29 13:52:04', '<a href="/wordpress/wp-content/uploads/2015/05/jay4.jpg"><img class="alignnone size-medium wp-image-13" src="/wordpress/wp-content/uploads/2015/05/jay4.jpg" alt="jay4" width="202" height="237" /></a>\r\n\r\njay3', 'jay3', '', 'publish', 'open', 'open', '', 'jay3', '', '', '2015-05-29 13:52:04', '2015-05-29 13:52:04', '', 0, 'http://localhost/wordpress/?p=12', 0, 'post', '', 0);
INSERT INTO `wp_posts` VALUES(13, 1, '2015-05-29 13:51:27', '2015-05-29 13:51:27', '', 'jay4', '', 'inherit', 'open', 'open', '', 'jay4', '', '', '2015-05-29 13:51:27', '2015-05-29 13:51:27', '', 12, 'http://localhost/wordpress/wp-content/uploads/2015/05/jay4.jpg', 0, 'attachment', 'image/jpeg', 0);
INSERT INTO `wp_posts` VALUES(14, 1, '2015-05-29 13:52:04', '2015-05-29 13:52:04', '<a href="/wordpress/wp-content/uploads/2015/05/jay4.jpg"><img class="alignnone size-medium wp-image-13" src="/wordpress/wp-content/uploads/2015/05/jay4.jpg" alt="jay4" width="202" height="237" /></a>\r\n\r\njay3', 'jay3', '', 'inherit', 'open', 'open', '', '12-revision-v1', '', '', '2015-05-29 13:52:04', '2015-05-29 13:52:04', '', 12, 'http://localhost/wordpress/2015/05/29/12-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `wp_posts` VALUES(16, 1, '2015-06-02 20:48:56', '2015-06-02 20:48:56', 'I am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.', 'Post4', '', 'publish', 'open', 'open', '', 'post4', '', '', '2015-06-02 20:48:56', '2015-06-02 20:48:56', '', 0, 'http://localhost/wordpress/?p=16', 0, 'post', '', 0);
INSERT INTO `wp_posts` VALUES(17, 1, '2015-06-02 20:48:56', '2015-06-02 20:48:56', 'I am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.\r\n\r\nI am post 4 posting here.', 'Post4', '', 'inherit', 'open', 'open', '', '16-revision-v1', '', '', '2015-06-02 20:48:56', '2015-06-02 20:48:56', '', 16, 'http://localhost/wordpress/2015/06/02/16-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `wp_posts` VALUES(18, 1, '2015-06-02 20:49:34', '2015-06-02 20:49:34', 'I am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.', 'Post5', '', 'publish', 'open', 'open', '', 'post5', '', '', '2015-06-02 20:49:34', '2015-06-02 20:49:34', '', 0, 'http://localhost/wordpress/?p=18', 0, 'post', '', 0);
INSERT INTO `wp_posts` VALUES(19, 1, '2015-06-02 20:49:34', '2015-06-02 20:49:34', 'I am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.\r\n\r\nI am post 5 posting here.', 'Post5', '', 'inherit', 'open', 'open', '', '18-revision-v1', '', '', '2015-06-02 20:49:34', '2015-06-02 20:49:34', '', 18, 'http://localhost/wordpress/2015/06/02/18-revision-v1/', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` VALUES(1, 'Uncategorized', 'uncategorized', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` VALUES(1, 1, 0);
INSERT INTO `wp_term_relationships` VALUES(4, 1, 0);
INSERT INTO `wp_term_relationships` VALUES(7, 1, 0);
INSERT INTO `wp_term_relationships` VALUES(10, 1, 0);
INSERT INTO `wp_term_relationships` VALUES(12, 1, 0);
INSERT INTO `wp_term_relationships` VALUES(16, 1, 0);
INSERT INTO `wp_term_relationships` VALUES(18, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` VALUES(1, 1, 'category', '', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` VALUES(1, 1, 'nickname', 'admin');
INSERT INTO `wp_usermeta` VALUES(2, 1, 'first_name', '');
INSERT INTO `wp_usermeta` VALUES(3, 1, 'last_name', '');
INSERT INTO `wp_usermeta` VALUES(4, 1, 'description', '');
INSERT INTO `wp_usermeta` VALUES(5, 1, 'rich_editing', 'true');
INSERT INTO `wp_usermeta` VALUES(6, 1, 'comment_shortcuts', 'false');
INSERT INTO `wp_usermeta` VALUES(7, 1, 'admin_color', 'fresh');
INSERT INTO `wp_usermeta` VALUES(8, 1, 'use_ssl', '0');
INSERT INTO `wp_usermeta` VALUES(9, 1, 'show_admin_bar_front', 'true');
INSERT INTO `wp_usermeta` VALUES(10, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}');
INSERT INTO `wp_usermeta` VALUES(11, 1, 'wp_user_level', '10');
INSERT INTO `wp_usermeta` VALUES(12, 1, 'dismissed_wp_pointers', 'wp360_locks,wp390_widgets,wp410_dfw');
INSERT INTO `wp_usermeta` VALUES(13, 1, 'show_welcome_panel', '1');
INSERT INTO `wp_usermeta` VALUES(14, 1, 'session_tokens', 'a:2:{s:64:"5b8dee03ff77d46d3a8c62d997fc0180bf0e0aff23780078901187eb1faf3f91";a:4:{s:10:"expiration";i:1433589715;s:2:"ip";s:3:"::1";s:2:"ua";s:81:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:38.0) Gecko/20100101 Firefox/38.0";s:5:"login";i:1433416915;}s:64:"247c133eb7867d1957219a242ec6d6aa57c2afdb06ed4f4baf5ce48036d3f8b7";a:4:{s:10:"expiration";i:1433709230;s:2:"ip";s:3:"::1";s:2:"ua";s:81:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:38.0) Gecko/20100101 Firefox/38.0";s:5:"login";i:1433536430;}}');
INSERT INTO `wp_usermeta` VALUES(15, 1, 'wp_dashboard_quick_press_last_post_id', '15');
INSERT INTO `wp_usermeta` VALUES(16, 1, 'wp_user-settings', 'mfold=o&libraryContent=browse&editor=tinymce');
INSERT INTO `wp_usermeta` VALUES(17, 1, 'wp_user-settings-time', '1432908769');
INSERT INTO `wp_usermeta` VALUES(18, 1, 'wp_media_library_mode', 'grid');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` VALUES(1, 'admin', '$P$B/O46wQsWNwJOvS9zGs6amfMR0a8VL0', 'admin', 'jaybharatjay@gmail.com', '', '2015-05-24 19:08:36', '', 0, 'admin');
