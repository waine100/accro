CREATE DATABASE  IF NOT EXISTS `symfony` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `symfony`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: accro.fiducial.dom    Database: symfony
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.13.10.1

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
-- Table structure for table `Booking`
--

DROP TABLE IF EXISTS `Booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `the_date` date NOT NULL,
  `parc_id` int(11) DEFAULT NULL,
  `typicalDay_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2FB1D442812D24CA` (`parc_id`),
  KEY `IDX_2FB1D442951F48DA` (`typicalDay_id`),
  CONSTRAINT `FK_2FB1D442812D24CA` FOREIGN KEY (`parc_id`) REFERENCES `Parc` (`id`),
  CONSTRAINT `FK_2FB1D442951F48DA` FOREIGN KEY (`typicalDay_id`) REFERENCES `TypicalDay` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Booking`
--

LOCK TABLES `Booking` WRITE;
/*!40000 ALTER TABLE `Booking` DISABLE KEYS */;
INSERT INTO `Booking` VALUES (4,'2014-01-01',1,1),(5,'2014-01-02',1,1),(6,'2014-01-03',1,1),(7,'2014-01-10',1,1),(8,'2014-01-09',1,1),(9,'2014-01-08',1,1),(10,'2014-01-15',1,1),(11,'2014-01-22',1,1),(12,'2014-02-01',1,1),(13,'2014-02-07',1,1),(14,'2014-02-08',1,1),(15,'2014-02-06',1,1),(16,'2014-02-05',1,1),(17,'2014-02-13',1,1),(18,'2014-02-14',1,1),(19,'2014-02-15',1,1),(20,'2014-02-22',1,1),(21,'2014-02-21',1,1),(22,'2014-04-05',1,1),(23,'2014-04-12',1,1),(24,'2014-04-19',1,1),(25,'2014-04-17',1,1),(26,'2014-02-28',1,1),(27,'2014-02-02',1,1),(28,'2014-02-09',1,1),(29,'2014-02-16',1,1),(30,'2014-02-23',1,1),(31,'2014-02-20',1,1),(32,'2014-02-27',1,1),(33,'2014-02-26',1,1),(34,'2014-02-25',1,1),(35,'2014-02-24',1,1),(36,'2014-02-04',1,1),(37,'2014-02-03',1,1),(38,'2014-02-17',1,1),(39,'2014-02-18',1,1),(40,'2014-02-19',1,1),(41,'2014-04-18',1,1),(42,'2014-03-16',1,1),(43,'2014-03-15',1,2),(44,'2014-03-22',1,1),(45,'2014-03-23',1,1),(46,'2014-03-09',3,2),(47,'2014-03-08',3,2),(48,'2014-03-15',3,2),(49,'2014-03-16',3,2),(50,'2014-03-22',3,2),(51,'2014-03-30',3,2),(52,'2014-03-23',3,2),(53,'2014-03-29',3,2),(54,'2014-03-01',3,2),(55,'2014-03-02',3,2),(56,'2014-03-07',3,1),(57,'2014-03-21',3,1),(58,'2014-03-28',3,1),(59,'2014-03-27',3,1),(60,'2014-03-13',3,1),(61,'2014-03-12',3,1),(62,'2014-03-05',3,1),(63,'2014-03-19',3,1),(64,'2014-03-11',3,1),(65,'2014-03-04',3,1),(66,'2014-03-17',3,1),(67,'2014-03-24',3,1),(68,'2014-03-26',3,1),(69,'2014-03-20',3,1),(71,'2014-03-06',3,1),(72,'2014-03-18',3,1),(73,'2014-03-25',3,1),(74,'2014-03-03',3,1),(75,'2014-03-10',3,1),(76,'2014-03-31',3,1),(77,'2014-04-02',3,1),(78,'2014-05-01',3,1),(79,'2014-04-24',3,1),(80,'2014-04-25',3,1),(81,'2014-04-23',3,1),(82,'2014-04-22',3,1),(83,'2014-04-26',3,1),(84,'2014-04-27',3,1),(85,'2014-04-28',3,1),(86,'2014-04-29',3,1),(87,'2014-04-30',3,1),(88,'2014-05-03',3,1),(89,'2014-05-02',3,1),(90,'2014-05-04',3,1),(91,'2014-05-05',3,1),(92,'2014-05-06',3,1),(93,'2014-05-07',3,1),(94,'2014-05-08',3,1),(95,'2014-05-09',3,1),(96,'2014-05-10',3,1),(97,'2014-05-12',3,1),(98,'2014-05-11',3,1),(99,'2014-05-13',3,1),(100,'2014-05-14',3,1),(101,'2014-05-15',3,1),(102,'2014-06-03',3,1),(103,'2014-06-04',3,1),(104,'2014-06-05',3,1),(105,'2014-06-12',3,1),(106,'2014-06-11',3,1),(107,'2014-06-10',3,1),(108,'2014-06-21',3,1),(109,'2014-06-20',3,1),(110,'2014-06-22',3,1),(111,'2014-06-24',3,1),(112,'2014-06-23',3,1),(113,'2014-06-26',3,1),(114,'2014-06-25',3,1),(115,'2014-06-27',3,1),(116,'2014-06-28',3,1),(117,'2014-06-29',3,1),(118,'2014-06-30',3,1),(119,'2014-08-01',3,1),(120,'2014-08-02',3,1),(121,'2014-08-03',3,1),(122,'2014-08-05',3,1),(123,'2014-08-04',3,1),(124,'2014-08-06',3,1),(125,'2014-08-07',3,1),(126,'2014-08-08',3,1),(127,'2014-08-09',3,1),(128,'2014-08-11',3,1),(129,'2014-08-10',3,1),(130,'2014-08-12',3,1),(131,'2014-08-13',3,1),(132,'2014-08-14',3,1),(133,'2014-08-15',3,1),(134,'2014-08-16',3,2),(135,'2014-08-17',3,2),(136,'2014-08-19',3,2),(137,'2014-08-18',3,2),(138,'2014-08-21',3,2),(139,'2014-08-20',3,2),(140,'2014-08-22',3,2),(141,'2014-08-23',3,2),(142,'2014-08-24',3,2),(143,'2014-11-30',3,1),(144,'2014-12-01',3,1),(145,'2014-12-02',3,1),(146,'2014-12-03',3,1),(147,'2014-12-04',3,1),(148,'2014-12-05',3,1),(149,'2014-12-06',3,1),(150,'2014-12-07',3,2),(151,'2014-12-08',3,2),(152,'2014-12-09',3,2),(153,'2014-12-10',3,2),(154,'2014-12-11',3,2),(155,'2014-12-12',3,2),(156,'2014-12-13',3,2),(157,'2014-12-14',3,2);
/*!40000 ALTER TABLE `Booking` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-03 21:59:38