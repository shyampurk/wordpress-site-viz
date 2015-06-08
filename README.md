# wordpress-site-viz
Bird's eye view of a wordpress blog site by means of force directed 

For Iport the post:
1.Hi Please download and install the plugin: importPosts
2.Create a table struucture is given below:
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



3.Call this function from your activated theme: importPosts('all');
