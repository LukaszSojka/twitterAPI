

This is application which get and display tweets from twitter


Requirements
1. Apache
2. Php
3. Mysql DB


DB structure

CREATE TABLE IF NOT EXISTS `twitts` (
  `twittid` int(10) unsigned NOT NULL auto_increment,
  `created_at` varchar(355) NOT NULL,
  `id` bigint(21) NOT NULL,
  `text` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `retweeted_status` varchar(255) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `profile_image_url0` varchar(255) NOT NULL,
  `profile_image_url` varchar(255) NOT NULL,
  `createtime` datetime NOT NULL,
  PRIMARY KEY  (`twittid`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


To get tweets you need to run cron process
cron/cron.php - get tweets into DB

Cron can be run every 60 sec, because you can call twitter API 200 times and hour

