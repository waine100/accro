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
-- Table structure for table `sales_flat_order`
--

DROP TABLE IF EXISTS `sales_flat_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_flat_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `state` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `base_total` decimal(10,0) DEFAULT NULL,
  `base_total_paid` decimal(10,0) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `checkout_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_40AD5327A76ED395` (`user_id`),
  CONSTRAINT `FK_40AD5327A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_flat_order`
--

LOCK TABLES `sales_flat_order` WRITE;
/*!40000 ALTER TABLE `sales_flat_order` DISABLE KEYS */;
INSERT INTO `sales_flat_order` VALUES (1,'2014-02-12 16:28:28','2014-02-12 16:28:28',NULL,'0',20,NULL,'2014-02-14',NULL,NULL,NULL,1,NULL),(2,'2014-02-25 10:45:44','2014-02-25 10:45:44',NULL,'2',450,NULL,'2014-02-26',NULL,NULL,NULL,1,NULL),(3,'2014-02-25 12:18:15','2014-02-25 12:18:15',NULL,'2',210,NULL,'2014-02-26',NULL,NULL,NULL,1,NULL),(4,'2014-02-25 17:31:47','2014-02-25 17:31:47',NULL,'2',105,NULL,'2014-02-27',NULL,NULL,NULL,1,'140225000001'),(5,'2014-02-25 17:33:31','2014-02-25 17:33:31',NULL,'2',140,NULL,'2014-02-28',NULL,NULL,NULL,1,'140225000002'),(6,'2014-03-04 19:41:43','2014-03-04 19:41:43',NULL,'2',195,NULL,'2014-03-06',NULL,NULL,NULL,2,'140304000001'),(7,'2014-05-01 22:40:05','2014-05-01 22:40:05',NULL,'2',70,NULL,'2014-05-02',NULL,NULL,NULL,1,'140501000001'),(8,'2014-05-01 23:19:35','2014-05-01 23:19:35',NULL,'2',600,NULL,'2014-05-02',NULL,NULL,NULL,1,'140501000002'),(9,'2014-05-01 23:23:27','2014-05-01 23:23:27',NULL,'2',300,NULL,'2014-05-02',NULL,NULL,NULL,1,'140501000003'),(10,'2014-05-01 23:40:28','2014-05-01 23:40:28',NULL,'2',210,NULL,'2014-05-06',NULL,NULL,NULL,1,'140501000004'),(11,'2014-05-01 23:50:05','2014-05-01 23:50:05',NULL,'2',375,NULL,'2014-05-06',NULL,NULL,NULL,1,'140501000005'),(12,'2014-05-02 00:04:14','2014-05-02 00:04:14',NULL,'2',70,NULL,'2014-05-06',NULL,NULL,NULL,1,'140502000001'),(13,'2014-05-14 23:00:24','2014-05-14 23:00:24',NULL,'2',100,NULL,'2014-05-15',NULL,NULL,NULL,1,'140514000001'),(14,'2014-05-14 23:16:35','2014-05-14 23:16:35',NULL,'2',60,NULL,'2014-05-15',NULL,NULL,NULL,1,'140514000002'),(15,'2014-05-14 23:20:46','2014-05-14 23:20:46',NULL,'2',330,NULL,'2014-05-15',NULL,NULL,NULL,1,'140514000003'),(16,'2014-05-14 23:24:40','2014-05-14 23:24:40',NULL,'2',90,NULL,'2014-05-15',NULL,NULL,NULL,1,'140514000004'),(17,'2014-05-14 23:36:33','2014-05-14 23:36:33',NULL,'2',84,NULL,'2014-05-15',NULL,NULL,NULL,1,'140514000005'),(18,'2014-05-14 23:54:16','2014-05-14 23:54:16',NULL,'2',300,NULL,'2014-05-15',NULL,NULL,NULL,1,'140514000006'),(19,'2014-05-20 23:52:06','2014-05-20 23:52:06',NULL,'2',30,NULL,'2014-05-15',NULL,NULL,NULL,1,'140520000001'),(20,'2014-05-21 00:04:15','2014-05-21 00:04:15',NULL,'2',300,NULL,'2014-05-14',NULL,NULL,NULL,1,'140521000001'),(21,'2014-05-21 00:15:42','2014-05-21 00:15:42',NULL,'2',15,NULL,'2014-05-15',NULL,NULL,NULL,1,'140521000002'),(22,'2014-05-21 00:25:45','2014-05-21 00:25:45',NULL,'2',30,NULL,'2014-05-15',NULL,NULL,NULL,1,'140521000003'),(23,'2014-05-21 00:31:20','2014-05-21 00:31:20',NULL,'2',165,NULL,'2014-05-15',NULL,NULL,NULL,1,'140521000004'),(25,'2014-05-22 23:31:57','2014-05-22 23:31:57',NULL,'2',90,NULL,'2014-05-15',NULL,NULL,NULL,1,'140522000001'),(26,'2014-05-25 22:25:34','2014-05-25 22:25:34',NULL,'2',195,NULL,'2014-05-15',NULL,NULL,NULL,2,'140525000001'),(27,'2014-05-25 22:59:43','2014-05-25 22:59:43',NULL,'2',780,NULL,'2014-05-15',NULL,NULL,NULL,1,'140525000002'),(28,'2014-05-26 19:50:45','2014-05-26 19:50:45',NULL,'2',75,NULL,'2014-05-15','at_arrival',NULL,NULL,2,'140526000001'),(29,'2014-05-26 20:00:27','2014-05-26 20:00:27',NULL,'2',105,NULL,'2014-05-15','cb',NULL,NULL,3,'140526000002'),(30,'2014-05-26 22:31:39','2014-05-26 22:31:39',NULL,'7',75,NULL,'2014-05-14','cb',NULL,NULL,3,'140526000003'),(31,'2014-06-01 22:48:18','2014-06-01 22:48:18',NULL,'7',60,NULL,'2014-05-15','cb',NULL,NULL,1,'140601000001'),(32,'2014-06-01 22:56:29','2014-06-01 22:56:29',NULL,'7',78,NULL,'2014-04-27','cb',NULL,NULL,1,'140601000002'),(33,'2014-06-02 20:11:16','2014-06-02 20:11:16',NULL,'7',90,NULL,'2014-06-05','cb',NULL,NULL,1,'140602000001'),(34,'2014-06-02 22:45:29','2014-06-02 22:45:29',NULL,'6',210,120,'2014-06-05','at_arrival',NULL,NULL,1,'140602000002'),(35,'2014-06-02 23:05:54','2014-06-02 23:05:54',NULL,'6',30,NULL,'2014-06-05','at_arrival',NULL,NULL,1,'140602000003'),(36,'2014-06-02 23:22:06','2014-06-02 23:22:06',NULL,'6',30,NULL,'2014-06-05','at_arrival',NULL,NULL,1,'140602000004'),(37,'2014-06-02 23:40:17','2014-06-02 23:40:17',NULL,'6',60,NULL,'2014-06-05','at_arrival',NULL,NULL,2,'140602000005'),(38,'2014-06-21 16:13:16','2014-06-21 16:13:16',NULL,'7',460,NULL,'2014-06-12','cb',NULL,NULL,3,'140621000001'),(39,'2014-06-22 11:47:03','2014-06-22 11:47:03',NULL,'7',210,NULL,'2014-06-22','cb',NULL,NULL,1,'140622000001'),(40,'2014-06-22 12:41:19','2014-06-22 12:41:19',NULL,'7',830,NULL,'2014-06-22','cb',NULL,NULL,3,'140622000002'),(41,'2014-06-22 12:58:38','2014-06-22 12:58:38',NULL,'7',250,NULL,'2014-06-22','cb',NULL,NULL,2,'140622000003'),(42,'2014-08-03 16:18:51','2014-08-03 16:18:51',NULL,'6',400,NULL,'2014-08-03','at_arrival',NULL,NULL,3,'140803000001'),(43,'2014-08-03 20:59:43','2014-08-03 20:59:43',NULL,'6',100,NULL,'2014-08-03','at_arrival',NULL,NULL,1,'140803000002'),(44,'2014-08-03 21:39:44','2014-08-03 21:39:44',NULL,'6',375,NULL,'2014-08-03','at_arrival',NULL,NULL,3,'140803000003'),(45,'2014-08-03 21:59:53','2014-08-03 21:59:53',NULL,'6',7110,NULL,'2014-08-03','at_arrival',NULL,NULL,3,'140803000004'),(46,'2014-08-03 22:15:37','2014-08-03 22:15:37',NULL,'6',285,NULL,'2014-08-03','at_arrival',NULL,NULL,3,'140803000005'),(47,'2014-08-03 22:30:15','2014-08-03 22:30:15',NULL,'6',300,NULL,'2014-08-03','at_arrival',NULL,NULL,1,'140803000006'),(48,'2014-11-30 21:51:16','2014-11-30 21:51:16',NULL,'6',240,NULL,'2014-11-30','at_arrival',NULL,NULL,1,'141130000001'),(49,'2014-11-30 22:08:11','2014-11-30 22:08:11',NULL,'6',230,NULL,'2014-12-07','at_arrival',NULL,NULL,3,'141130000002'),(50,'2014-11-30 22:37:41','2014-11-30 22:37:41',NULL,'6',100,NULL,'2014-11-30','at_arrival',NULL,NULL,3,'141130000003'),(51,'2014-11-30 23:04:53','2014-11-30 23:04:53',NULL,'6',220,NULL,'2014-11-30','at_arrival',NULL,NULL,1,'141130000004'),(52,'2014-11-30 23:15:38','2014-11-30 23:15:38',NULL,'6',250,NULL,'2014-11-30','at_arrival',NULL,NULL,3,'141130000005'),(53,'2014-12-01 00:56:02','2014-12-01 00:56:02',NULL,'6',190,NULL,'2014-12-11','at_arrival',NULL,NULL,1,'141201000001');
/*!40000 ALTER TABLE `sales_flat_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-03 21:59:36
