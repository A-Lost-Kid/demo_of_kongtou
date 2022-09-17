DROP TABLE IF EXISTS Post;

CREATE TABLE `Post` (
  `postid` varchar(30) NOT NULL,
  `type` text NOT NULL,
  `content` text NOT NULL,
  `images` text NOT NULL,
  `video` text NOT NULL,
  `sender` text NOT NULL,
  `look` text NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`postid`),
  UNIQUE KEY `postid` (`postid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS User;

CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `username` text NOT NULL,
  `avatar` text NOT NULL,
  `pass` text NOT NULL,
  `key` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9476809 DEFAULT CHARSET=utf8;



