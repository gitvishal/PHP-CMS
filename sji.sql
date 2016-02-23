-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: CMS
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `comment` text,
  `p_id` int(11) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `response` text,
  `response_date` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `pages` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'guest','fgggsss',150,'2016-02-22 13:09:27','fgfgg','2016-02-23 08:24:44'),(2,'guest','trew',150,'2016-02-22 13:14:15',NULL,NULL),(3,'guest','www',146,'2016-02-23 12:35:37',NULL,NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_us` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `content` text,
  `ph_no` varchar(15) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` VALUES (1,'vishal k','gitvishalkerkar@gmail.com','ff','ff',NULL),(2,'ddd ddd','git@gmail.com','dfdfdfdfdfd','1111111111',NULL);
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `data` text,
  `rank` enum('1','2','3') DEFAULT NULL,
  `child` int(11) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` enum('NEW','DRAFT') DEFAULT NULL,
  `publish` datetime DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (143,'c','','1',NULL,'2016-02-19 18:45:58','2016-02-19 18:46:00',1,0,'NEW','2015-04-15 05:03:00'),(144,'a','','2',NULL,'2016-02-19 18:46:16','2016-02-19 18:46:20',1,143,'NEW','2015-04-15 05:03:00'),(146,'vf','','3',NULL,'2016-02-19 18:49:22','2016-02-19 18:49:29',1,144,'NEW','2015-04-15 05:03:00'),(147,'s','','2',NULL,'2016-02-19 18:49:46','2016-02-19 18:50:10',1,143,'DRAFT','2015-04-15 05:03:00'),(148,'kt','','2',NULL,'2016-02-19 18:50:18','2016-02-19 18:50:42',1,143,'NEW','2015-04-15 05:03:00'),(150,'vishal3','<p>ffffffffbbtgttttt</p>\r\n','3',NULL,'2016-02-19 19:15:49','2016-02-20 19:07:38',1,148,'NEW','2015-04-15 05:03:00'),(154,'vm','<p>ggg</p>\r\n','3',NULL,'2016-02-20 18:55:24','2016-02-20 19:06:37',1,148,'NEW','2015-04-15 05:03:00'),(155,'t3','<p>33</p>\r\n','2',NULL,'2016-02-20 18:55:56','2016-02-20 19:03:32',1,143,'NEW','2015-04-15 05:03:00'),(163,'vishal59','','1',NULL,'2016-02-23 12:17:39','2016-02-23 12:18:01',1,0,'DRAFT','2015-04-15 05:03:00');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','*4ACFE3202A5FF5CF467898FC58AAB1D615029441');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-23 18:27:04
