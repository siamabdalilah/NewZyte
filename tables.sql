CREATE TABLE `users` (
  `user_name` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 

CREATE TABLE `stories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner` varchar(50) NOT NULL,
  `stories` mediumtext,
  `title` varchar(150) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `link` varchar(200) DEFAULT NULL,
  `hidd` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`),
  CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8

CREATE TABLE `comments` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `story` int(10) unsigned NOT NULL,
  `owner` varchar(50) NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8