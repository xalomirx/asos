-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: asos
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(32) NOT NULL,
  `age` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'xalomirx@gmail.com','SpiceCowboy','1c63129ae9db9c60c3e8aa94d3e00495','22'),(2,'xalomirx@gmail.com','SpiceCowboy','1c63129ae9db9c60c3e8aa94d3e00495','22'),(3,'petuch@gmail.com','PapaCock','1c63129ae9db9c60c3e8aa94d3e00495',''),(4,'','','d41d8cd98f00b204e9800998ecf8427e',''),(5,'','','d41d8cd98f00b204e9800998ecf8427e',''),(6,'','','d41d8cd98f00b204e9800998ecf8427e',''),(7,'','','d41d8cd98f00b204e9800998ecf8427e',''),(8,'','','d41d8cd98f00b204e9800998ecf8427e',''),(9,'','','d41d8cd98f00b204e9800998ecf8427e',''),(10,'','','d41d8cd98f00b204e9800998ecf8427e',''),(11,'','','d41d8cd98f00b204e9800998ecf8427e',''),(12,'','','d41d8cd98f00b204e9800998ecf8427e',''),(13,'','','d41d8cd98f00b204e9800998ecf8427e',''),(14,'','','d41d8cd98f00b204e9800998ecf8427e',''),(15,'','','d41d8cd98f00b204e9800998ecf8427e',''),(16,'horror@core.cz','Rezznik','1c63129ae9db9c60c3e8aa94d3e00495','29'),(17,'emo@hc.us','EmoWar','1c63129ae9db9c60c3e8aa94d3e00495','16'),(18,'Alomir@bk.com','Alomir','1c63129ae9db9c60c3e8aa94d3e00495','16'),(19,'saha@pd.re','Owner','1c63129ae9db9c60c3e8aa94d3e00495','11'),(20,'Maksim228@bk.com','MaksNAGIBATOR','1c63129ae9db9c60c3e8aa94d3e00495','26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-16 22:06:24
