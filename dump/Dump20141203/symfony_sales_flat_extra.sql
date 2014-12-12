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
-- Table structure for table `sales_flat_extra`
--

DROP TABLE IF EXISTS `sales_flat_extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_flat_extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `qty` int(11) DEFAULT NULL,
  `row_total` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F8BBCDDA8D9F6D38` (`order_id`),
  CONSTRAINT `FK_F8BBCDDA8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `sales_flat_order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_flat_extra`
--

LOCK TABLES `sales_flat_extra` WRITE;
/*!40000 ALTER TABLE `sales_flat_extra` DISABLE KEYS */;
INSERT INTO `sales_flat_extra` VALUES (1,NULL,'2014-05-14 23:00:24','2014-05-14 23:00:24','Pinata',NULL,3,NULL),(2,NULL,'2014-05-14 23:16:35','2014-05-14 23:16:35','Pinata',NULL,2,NULL),(3,NULL,'2014-05-14 23:16:35','2014-05-14 23:16:35','Test2',NULL,2,NULL),(4,NULL,'2014-05-14 23:20:46','2014-05-14 23:20:46','Test2',NULL,2,NULL),(5,16,'2014-05-14 23:24:40','2014-05-14 23:24:40','Pinata',NULL,2,NULL),(6,17,'2014-05-14 23:36:33','2014-05-14 23:36:33','Test2',NULL,2,14),(7,18,'2014-05-14 23:54:16','2014-05-14 23:54:16','Test2',NULL,3,NULL),(8,19,'2014-05-20 23:52:06','2014-05-20 23:52:06','Pinata',NULL,20,20),(9,19,'2014-05-20 23:52:06','2014-05-20 23:52:06','test',NULL,20,20),(10,20,'2014-05-21 00:04:15','2014-05-21 00:04:15','Pinata',NULL,20,300),(11,21,'2014-05-21 00:15:42','2014-05-21 00:15:42','test',NULL,1,12),(12,22,'2014-05-21 00:25:45','2014-05-21 00:25:45','test',NULL,1,12),(13,23,'2014-05-21 00:31:20','2014-05-21 00:31:20','Pinata',NULL,1,15),(14,25,'2014-05-22 23:31:57','2014-05-22 23:31:57','Pinata',NULL,3,45),(15,26,'2014-05-25 22:25:34','2014-05-25 22:25:34','Pinata',NULL,2,30),(16,26,'2014-05-25 22:25:34','2014-05-25 22:25:34','New contrib',NULL,1,15),(17,27,'2014-05-25 22:59:43','2014-05-25 22:59:43','Pinata',NULL,50,750),(18,28,'2014-05-26 19:50:45','2014-05-26 19:50:45','Pinata',NULL,2,30),(19,29,'2014-05-26 20:00:27','2014-05-26 20:00:27','Test2',NULL,5,75),(20,30,'2014-05-26 22:31:39','2014-05-26 22:31:39','Pinata',NULL,4,60),(21,31,'2014-06-01 22:48:18','2014-06-01 22:48:18','Pinata',NULL,2,30),(22,32,'2014-06-01 22:56:29','2014-06-01 22:56:29','test',NULL,4,48),(23,33,'2014-06-02 20:11:16','2014-06-02 20:11:16','Pinata',NULL,3,45),(24,34,'2014-06-02 22:45:29','2014-06-02 22:45:29','New contrib',NULL,10,150),(25,NULL,'2014-06-02 23:05:54','2014-06-02 23:05:54','Pinata',NULL,2,NULL),(26,NULL,'2014-06-02 23:22:06','2014-06-02 23:22:06','Pinata',NULL,10,NULL),(27,37,'2014-06-02 23:40:17','2014-06-02 23:40:17','Pinata',NULL,2,30),(28,38,'2014-06-21 16:13:16','2014-06-21 16:13:16','Pinata',NULL,4,60),(29,38,'2014-06-21 16:13:16','2014-06-21 16:13:16','New contrib',NULL,7,105),(30,38,'2014-06-21 16:13:16','2014-06-21 16:13:16','Test2',NULL,3,45),(31,39,'2014-06-22 11:47:03','2014-06-22 11:47:03','Pinata',NULL,4,60),(32,40,'2014-06-22 12:41:19','2014-06-22 12:41:19','Pinata',NULL,52,780),(33,41,'2014-06-22 12:58:38','2014-06-22 12:58:38','Pinata',NULL,10,150),(34,42,'2014-08-03 16:18:51','2014-08-03 16:18:51','New contrib',NULL,20,300),(35,44,'2014-08-03 21:39:44','2014-08-03 21:39:44','Pinata',NULL,5,75),(36,45,'2014-08-03 21:59:53','2014-08-03 21:59:53','test',NULL,580,6960),(37,46,'2014-08-03 22:15:37','2014-08-03 22:15:37','test',NULL,5,60),(38,46,'2014-08-03 22:15:37','2014-08-03 22:15:37','New contrib',NULL,5,75),(39,47,'2014-08-03 22:30:15','2014-08-03 22:30:15','Pinata',NULL,10,150),(40,48,'2014-11-30 21:51:16','2014-11-30 21:51:16','Pinata',NULL,5,75),(41,48,'2014-11-30 21:51:16','2014-11-30 21:51:16','Test2',NULL,2,30),(42,48,'2014-11-30 21:51:16','2014-11-30 21:51:16','New contrib',NULL,4,60),(43,49,'2014-11-30 22:08:11','2014-11-30 22:08:11','New contrib',NULL,7,105),(44,49,'2014-11-30 22:08:11','2014-11-30 22:08:11','Pinata',NULL,5,75),(45,51,'2014-11-30 23:04:53','2014-11-30 23:04:53','test',NULL,5,60),(46,52,'2014-11-30 23:15:38','2014-11-30 23:15:38','Pinata',NULL,2,30),(47,52,'2014-11-30 23:15:38','2014-11-30 23:15:38','Test2',NULL,8,120),(48,53,'2014-12-01 00:56:02','2014-12-01 00:56:02','New contrib',NULL,6,90);
/*!40000 ALTER TABLE `sales_flat_extra` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-03 21:59:35