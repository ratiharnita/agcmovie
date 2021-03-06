-- ================================================================
--
-- @version $Id: structure.sql 2014-11-06 12:46:05
-- @package OcimPress
-- @copyright 2014.
--
-- ================================================================
-- Database structure
-- ================================================================

--
-- Table structure for table `oc_comments`
--

CREATE TABLE IF NOT EXISTS `oc_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `oc_terms`
--

CREATE TABLE IF NOT EXISTS `oc_terms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `child` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

--
-- Dumping data for table `oc_terms`
--

INSERT INTO `oc_terms` (`id`, `name`, `description`, `slug`, `child`, `sort`, `type`) VALUES
(1, 'Uncategorized', '', 'uncategorized', 0, 0, 1);
--
-- Table structure for table `oc_plugins`
--

CREATE TABLE IF NOT EXISTS `oc_plugins` (
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `action` tinyint(1) DEFAULT '0',
  `plugin_name` text COLLATE utf8_bin NOT NULL,
  `plugin_description` text COLLATE utf8_bin NOT NULL,
  `plugin_author` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`filename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `oc_posts`
--

CREATE TABLE IF NOT EXISTS `oc_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `pubdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `guid` text NOT NULL,
  `permalink` text NOT NULL,
  `terms` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `tags` text NOT NULL,
  `images` text NOT NULL,
  `sticky`int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `pinged` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `oc_options`
--

CREATE TABLE IF NOT EXISTS `oc_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL,
  `active` int(11) unsigned NOT NULL,  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=20;

--
-- Dumping data for table `oc_options`
--

INSERT INTO `oc_options` (`id`, `option_name`, `option_value`, `autoload`, `active`) VALUES
(1, 'url', '', '', '0'),(2, 'name', 'OcimPress', '', '0'),(3, 'description', 'Just Another OcimPress', '', '0'),(4, 'email', '', '', '0'),(5, 'keyword', 'ocimpress', '', '0'),(6, 'stylesheet_url', '/oc-content/themes/arsa', '', '0'),(7, 'theme', 'arsa', '', '0'),(8, 'users_can_register', '0', '', '0'),(9, 'posts_per_page', '10', '', '0'),(10, 'posts_per_rss', '10', '', '0'),(11, 'default_role', 'subscriber', '', '0'),(12, 'blog_public', 'index', '', '0'),(13, 'custom_permalink', '3', '', '0'),(14, 'timezone_string', 'Asia/Jakarta', '', '0'),(15, 'default_comment_status', '1', '', '0'),(16, 'comment_moderation', '1', '', '0'),(17, 'comment_registration', '1', '', '0'),(18, 'blacklist_keys', 'cache:,site:,utm_source,sex,porn,gamble,xxx,nude,squirt,gay,abortion,attack,bomb,casino,cocaine,death,erection,gambling,heroin,marijuana,masturbation,pedophile,penis,poker,pussy,terrorist,judi,taruhan,togel', '', '0'),(19, 'posts_default', '1', '', '0'),(20, 'permalink_structure', '', '', '0'),(21, 'blog_charset', 'utf8', '', '0'),(22, 'dmca', '', '', '0');

--
-- Table structure for table `oc_users`
--

CREATE TABLE IF NOT EXISTS `oc_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `role` varchar(100) NOT NULL DEFAULT '',
  `online` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` int(11) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `birth` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(50) NOT NULL DEFAULT '',
  `country` varchar(100) NOT NULL DEFAULT '',
  `avatar` varchar(250) NOT NULL DEFAULT '',
  `navbar` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;