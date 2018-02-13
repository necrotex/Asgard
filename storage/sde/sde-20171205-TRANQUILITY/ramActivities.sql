-- MySQL dump 10.13  Distrib 5.6.12, for Linux (x86_64)
--
-- Host: localhost    Database: sdeyaml
-- ------------------------------------------------------
-- Server version	5.6.12

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
-- Table structure for table `ramActivities`
--

DROP TABLE IF EXISTS `ramActivities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ramActivities` (
  `activityID` int(11) NOT NULL,
  `activityName` varchar(100) DEFAULT NULL,
  `iconNo` varchar(5) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`activityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ramActivities`
--

LOCK TABLES `ramActivities` WRITE;
/*!40000 ALTER TABLE `ramActivities` DISABLE KEYS */;
INSERT INTO `ramActivities` VALUES (0,'None',NULL,'No activity',1),(1,'Manufacturing','18_02','Manufacturing',1),(2,'Researching Technology','33_02','Technological research',0),(3,'Researching Time Efficiency','33_02','Researching time efficiency',1),(4,'Researching Material Efficiency','33_02','Researching material efficiency',1),(5,'Copying','33_02','Copying',1),(6,'Duplicating',NULL,'The process of creating an item, by studying an already existing item.',0),(7,'Reverse Engineering','33_02','The process of creating a blueprint from an item.',1),(8,'Invention','33_02','The process of creating a more advanced item based on an existing item',1),(11,'Reactions','18_02','The process of combining raw and intermediate materials to create advanced components',1);
/*!40000 ALTER TABLE `ramActivities` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-05 17:36:29
