-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for debian-linux-gnueabihf (armv7l)
--
-- Host: localhost    Database: aquatech
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jour`
--

DROP TABLE IF EXISTS `jour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jour` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `jour` varchar(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `evp` float NOT NULL,
  `precip` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jour`
--

LOCK TABLES `jour` WRITE;
/*!40000 ALTER TABLE `jour` DISABLE KEYS */;
INSERT INTO `jour` VALUES (1,'lundi','2019-05-13 10:35:00',0.2,0),(2,'jeudi','2019-06-06 14:21:00',0.3,0.1),(3,'vendredi','2019-06-14 08:09:00',0.3,0),(4,'jeudi','2019-06-20 15:40:00',0.1,5),(5,'vendredi','2019-06-21 10:22:38',0.2,15.1);
/*!40000 ALTER TABLE `jour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trame`
--

DROP TABLE IF EXISTS `trame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trame`
--

LOCK TABLES `trame` WRITE;
/*!40000 ALTER TABLE `trame` DISABLE KEYS */;
INSERT INTO `trame` VALUES (1,'000000000');
/*!40000 ALTER TABLE `trame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permissions` int(1) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kyllian','$2y$10$Dh1apHGtxR3MrzQ5vkNcR.GzhacZA4aHA/neK3VIwaEXfnsUiYEGC',1,'2019-05-28 08:35:06'),(2,'enzolepd','$2y$10$n5ZqGFAkh4TCc9qQcYI/b./lip6gKOawyzdCNTiIuuQF/jmU8UOom',0,'2019-05-28 09:36:06'),(3,'Fabien','$2y$10$GeV3eAKUlg6tPSaGiM28H.v9fJGLix14BnR/d5kOyR8wigj4m.nfu',0,'2019-05-28 13:40:00');
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

-- Dump completed on 2019-06-21 11:18:55
