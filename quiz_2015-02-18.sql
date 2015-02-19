# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: quiz
# Generation Time: 2015-02-19 06:49:01 +0000
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
	(23,'Note that primitive int keyword starts with a lowercase i. Also, virtual is a keyword in C++.'),
	(24,'constant is not a keyword'),
	(25,'int array can\'t be initialized with string literals.'),
	(26,'Curly braces have to be used for array initialization, and also, for 2-D array initialization, initial values for both dimensions have to be provided.'),
	(27,'Class types are not keywords and Float is a class. Also, although \"String\" is a class type in Java, \"string\" is not a keyword.'),
	(28,'unsigned is a keyword in C/C++, not in java'),
	(29,'null can\'t be enclosed in single quotes'),
	(30,'options 3 and 4 look fishy!'),
	(31,'Each number is one half of the previous number'),
	(32,'Half of 1/4 is 1/8'),
	(33,'This is a simple alternating addition and subtraction series.'),
	(34,'In the first pattern, 3 is added; in the second, 2 is subtracted.');

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

LOCK TABLES `metrics_tbl` WRITE;
/*!40000 ALTER TABLE `metrics_tbl` DISABLE KEYS */;

INSERT INTO `metrics_tbl` (`s_id`, `q_id`, `hint_design_id`, `q_score`, `time_q_sec`, `time_hint1_sec`, `time_hint2_sec`, `q_no`)
VALUES
	(21,50,1,1,10.51,0,0,3),
	(21,51,1,1,9.919,0,0,2),
	(21,56,1,1,6.318,3.819,0,1),
	(21,57,1,1,2.525,0,0,4),
	(22,50,2,1,21.778,5.764,8.449,1),
	(22,52,2,0,6.32,0,0,2),
	(22,55,2,0,2.345,0,0,4),
	(22,57,2,1,2.216,0,0,3),
	(23,51,3,1,4.952,0,0,3),
	(23,55,3,0,5.988,4.026,4.974,1),
	(23,56,3,0,5.098,1.225,0,2),
	(23,57,3,1,2.134,0,0,4);

/*!40000 ALTER TABLE `metrics_tbl` ENABLE KEYS */;
UNLOCK TABLES;


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
	(119,'class, if, void, long, Int, continue'),
	(120,'goto, instanceof, native, finally, default, throws'),
	(121,'try, virtual, throw, final, volatile, transient'),
	(122,'strictfp, constant, super, implements, do'),
	(123,'int [ ] myList = {\"1\", \"2\", \"3\"};'),
	(124,'int [ ] myList = (5, 8, 2);'),
	(125,'int myList [ ] [ ] = {4,9,7,0};'),
	(126,'int myList [ ] = {4, 3, 7};'),
	(127,'interface'),
	(128,'string'),
	(129,'Float'),
	(130,'unsigned'),
	(135,'String s1 = null;'),
	(136,'String s2 = \'null\';'),
	(137,'String s3 = (String) \'abc\';'),
	(138,'String s4 = (String) \'\\ufeed\';'),
	(139,'(1/3)'),
	(140,'(1/8)'),
	(141,'(2/8)'),
	(142,'(2/15)'),
	(143,'7'),
	(144,'10'),
	(145,'12'),
	(146,'13');

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
	(50,120),
	(51,126),
	(52,127),
	(55,135),
	(56,140),
	(57,144);

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
	(50,23),
	(50,24),
	(51,25),
	(51,26),
	(52,27),
	(52,28),
	(55,29),
	(55,30),
	(56,31),
	(56,32),
	(57,33),
	(57,34);

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
	(50,119),
	(50,120),
	(50,121),
	(50,122),
	(51,123),
	(51,124),
	(51,125),
	(51,126),
	(52,127),
	(52,128),
	(52,129),
	(52,130),
	(55,135),
	(55,136),
	(55,137),
	(55,138),
	(56,139),
	(56,140),
	(56,141),
	(56,142),
	(57,143),
	(57,144),
	(57,145),
	(57,146);

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
	(50,'Which one of these lists contains only Java programming language keywords?'),
	(51,'Which will legally declare, construct, and initialize an array in Java?'),
	(52,'Which is a valid keyword in java?'),
	(55,'Which is a valid declaration <br>of a String in Java?'),
	(56,'Look at this series: 2, 1, (1/2), (1/4), ... What number should come next?'),
	(57,'Look at this series: 7, 10, 8, 11, 9, 12, ... What number should come next?');

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

LOCK TABLES `session_tbl` WRITE;
/*!40000 ALTER TABLE `session_tbl` DISABLE KEYS */;

INSERT INTO `session_tbl` (`id`, `session`, `ip_remote_address`, `ip_proxy_address`, `variant`, `session_date`, `gender`, `age_group`, `personality_type`, `education`)
VALUES
	(21,'905fd03a68c5c585f5dabc3af2f65e75','::1','',1,'2015-02-17 15:29:17','dnd','22 to 34','extroverted','masters'),
	(22,'8274394479f61d1dfc45189a2eb7827f','::1','',2,'2015-02-17 15:30:13','','','',''),
	(23,'0559228043445a4ba49a800d1c4760fd','::1','',3,'2015-02-17 15:31:06','male','35 to 44','somewhere in between','doctorate');

/*!40000 ALTER TABLE `session_tbl` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
