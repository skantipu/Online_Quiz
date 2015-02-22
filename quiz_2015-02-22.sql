# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: quiz
# Generation Time: 2015-02-22 20:51:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table hint_design_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hint_design_tbl`;

CREATE TABLE `hint_design_tbl` (
  `id` tinyint(3) unsigned NOT NULL,
  `hint_design_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `hint_design_tbl` WRITE;
/*!40000 ALTER TABLE `hint_design_tbl` DISABLE KEYS */;

INSERT INTO `hint_design_tbl` (`id`, `hint_design_desc`)
VALUES
	(1,'on demand'),
	(2,'showing hints after some time'),
	(3,'fixed number of hints');

/*!40000 ALTER TABLE `hint_design_tbl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table hint_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hint_tbl`;

CREATE TABLE `hint_tbl` (
  `h_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `h_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `hint_tbl` WRITE;
/*!40000 ALTER TABLE `hint_tbl` DISABLE KEYS */;

INSERT INTO `hint_tbl` (`h_id`, `h_desc`)
VALUES
	(35,'Time duration from noon to 5 is 5 hours'),
	(36,'Angle traced by hour hand in 12 hours is 360 degrees'),
	(37,'There are two series here'),
	(38,'2, 10, 18, 26, ... (increase by 8)'),
	(39,'There are two series here'),
	(40,'2, 6, 10, ... (adding 4)'),
	(41,'what is 6 * 6 * 6?'),
	(42,'7 = (2 * 2 * 2) - 1'),
	(43,'Think in terms of cubes'),
	(44,'What is (1 * 1 * 1) + (2 * 2 * 2)?'),
	(45,'Think in terms of squares'),
	(46,'What is a palindrome?'),
	(47,'1 is not a prime number'),
	(48,'There are 9 prime numbers between 1 and 27');

/*!40000 ALTER TABLE `hint_tbl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table metrics_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `metrics_tbl`;

CREATE TABLE `metrics_tbl` (
  `s_id` int(11) unsigned NOT NULL,
  `q_id` int(11) unsigned NOT NULL,
  `hint_design_id` tinyint(3) unsigned NOT NULL,
  `q_score` tinyint(4) DEFAULT NULL,
  `time_q_sec` float DEFAULT NULL,
  `time_hint1_sec` float DEFAULT NULL,
  `time_hint2_sec` float DEFAULT NULL,
  `q_no` tinyint(2) NOT NULL,
  PRIMARY KEY (`s_id`,`q_id`),
  KEY `q_id` (`q_id`),
  KEY `hint_design_id` (`hint_design_id`),
  CONSTRAINT `metrics_tbl_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `session_tbl` (`id`),
  CONSTRAINT `metrics_tbl_ibfk_2` FOREIGN KEY (`q_id`) REFERENCES `question_tbl` (`q_id`),
  CONSTRAINT `metrics_tbl_ibfk_3` FOREIGN KEY (`hint_design_id`) REFERENCES `hint_design_tbl` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table option_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `option_tbl`;

CREATE TABLE `option_tbl` (
  `o_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `o_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `option_tbl` WRITE;
/*!40000 ALTER TABLE `option_tbl` DISABLE KEYS */;

INSERT INTO `option_tbl` (`o_id`, `o_desc`)
VALUES
	(147,'145'),
	(148,'150'),
	(149,'155'),
	(150,'160'),
	(151,'52'),
	(152,'56'),
	(153,'64'),
	(154,'48'),
	(155,'18'),
	(156,'0'),
	(157,'-6'),
	(158,'3'),
	(159,'58'),
	(160,'62'),
	(161,'63'),
	(162,'72'),
	(163,'90'),
	(164,'93'),
	(165,'89'),
	(166,'91'),
	(167,'91'),
	(168,'51'),
	(169,'18'),
	(170,'0'),
	(171,'0.67'),
	(172,'0.33'),
	(173,'0.75'),
	(174,'0.5');

/*!40000 ALTER TABLE `option_tbl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table question_answer_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `question_answer_tbl`;

CREATE TABLE `question_answer_tbl` (
  `q_id` int(11) unsigned NOT NULL,
  `a_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`q_id`,`a_id`),
  KEY `a_id` (`a_id`),
  CONSTRAINT `question_answer_tbl_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `option_tbl` (`o_id`),
  CONSTRAINT `question_answer_tbl_ibfk_2` FOREIGN KEY (`q_id`) REFERENCES `question_tbl` (`q_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `question_answer_tbl` WRITE;
/*!40000 ALTER TABLE `question_answer_tbl` DISABLE KEYS */;

INSERT INTO `question_answer_tbl` (`q_id`, `a_id`)
VALUES
	(58,148),
	(59,151),
	(60,157),
	(61,161),
	(62,166),
	(63,169),
	(64,172);

/*!40000 ALTER TABLE `question_answer_tbl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table question_hint_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `question_hint_tbl`;

CREATE TABLE `question_hint_tbl` (
  `q_id` int(11) unsigned NOT NULL,
  `h_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`q_id`,`h_id`),
  KEY `h_id` (`h_id`),
  CONSTRAINT `question_hint_tbl_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `question_tbl` (`q_id`),
  CONSTRAINT `question_hint_tbl_ibfk_2` FOREIGN KEY (`h_id`) REFERENCES `hint_tbl` (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `question_hint_tbl` WRITE;
/*!40000 ALTER TABLE `question_hint_tbl` DISABLE KEYS */;

INSERT INTO `question_hint_tbl` (`q_id`, `h_id`)
VALUES
	(58,35),
	(58,36),
	(59,37),
	(59,38),
	(60,39),
	(60,40),
	(61,41),
	(61,42),
	(62,43),
	(62,44),
	(63,45),
	(63,46),
	(64,47),
	(64,48);

/*!40000 ALTER TABLE `question_hint_tbl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table question_option_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `question_option_tbl`;

CREATE TABLE `question_option_tbl` (
  `q_id` int(11) unsigned NOT NULL,
  `o_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`q_id`,`o_id`),
  KEY `o_id` (`o_id`),
  CONSTRAINT `question_option_tbl_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `question_tbl` (`q_id`),
  CONSTRAINT `question_option_tbl_ibfk_2` FOREIGN KEY (`o_id`) REFERENCES `option_tbl` (`o_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `question_option_tbl` WRITE;
/*!40000 ALTER TABLE `question_option_tbl` DISABLE KEYS */;

INSERT INTO `question_option_tbl` (`q_id`, `o_id`)
VALUES
	(58,147),
	(58,148),
	(58,149),
	(58,150),
	(59,151),
	(59,152),
	(59,153),
	(59,154),
	(60,155),
	(60,156),
	(60,157),
	(60,158),
	(61,159),
	(61,160),
	(61,161),
	(61,162),
	(62,163),
	(62,164),
	(62,165),
	(62,166),
	(63,167),
	(63,168),
	(63,169),
	(63,170),
	(64,171),
	(64,172),
	(64,173),
	(64,174);

/*!40000 ALTER TABLE `question_option_tbl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table question_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `question_tbl`;

CREATE TABLE `question_tbl` (
  `q_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `q_desc` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `question_tbl` WRITE;
/*!40000 ALTER TABLE `question_tbl` DISABLE KEYS */;

INSERT INTO `question_tbl` (`q_id`, `q_desc`)
VALUES
	(58,'A clock is started at noon. By 5, the hour hand has turned through ___  degrees?'),
	(59,'Find the missing number in the series: 2, 7, 10, 22, 18, 37, 26, ___ ?'),
	(60,'Find the missing number in the series: 2, 3, 6, 0, 10, -3, 14, ___ ?'),
	(61,'Find the missing number in the series: 7, 26, ___, 124, 215 ?'),
	(62,'Find the missing number in the series: 9, 35, ___, 189, 341, 559 ?'),
	(63,'Find the missing number in the series: 61, 52, 63, 94, 46, ___, 001 ?'),
	(64,'What is the probability of picking a prime number between 1 and 27 inclusive?');

/*!40000 ALTER TABLE `question_tbl` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table session_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `session_tbl`;

CREATE TABLE `session_tbl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `session` varchar(255) DEFAULT NULL,
  `ip_remote_address` varchar(55) DEFAULT NULL,
  `ip_proxy_address` varchar(55) DEFAULT NULL,
  `variant` tinyint(2) NOT NULL,
  `session_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(55) DEFAULT NULL,
  `age_group` varchar(55) DEFAULT NULL,
  `personality_type` varchar(55) DEFAULT NULL,
  `education` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
