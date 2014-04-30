-- MySQL dump 10.13  Distrib 5.6.13, for osx10.7 (x86_64)
--
-- Host: localhost    Database: ilist
-- ------------------------------------------------------
-- Server version	5.6.13

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
-- Table structure for table `DeletedReason`
--

DROP TABLE IF EXISTS `DeletedReason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DeletedReason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DeletedReason`
--

LOCK TABLES `DeletedReason` WRITE;
/*!40000 ALTER TABLE `DeletedReason` DISABLE KEYS */;
/*!40000 ALTER TABLE `DeletedReason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MemoryRam`
--

DROP TABLE IF EXISTS `MemoryRam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MemoryRam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MemoryRam`
--

LOCK TABLES `MemoryRam` WRITE;
/*!40000 ALTER TABLE `MemoryRam` DISABLE KEYS */;
INSERT INTO `MemoryRam` VALUES (1,'4Gb'),(2,'8Gb'),(3,'12gb'),(4,'16gb');
/*!40000 ALTER TABLE `MemoryRam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Processor`
--

DROP TABLE IF EXISTS `Processor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Processor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Processor`
--

LOCK TABLES `Processor` WRITE;
/*!40000 ALTER TABLE `Processor` DISABLE KEYS */;
INSERT INTO `Processor` VALUES (1,'i3'),(2,'i5'),(3,'i7');
/*!40000 ALTER TABLE `Processor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ScreenSize`
--

DROP TABLE IF EXISTS `ScreenSize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ScreenSize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ScreenSize`
--

LOCK TABLES `ScreenSize` WRITE;
/*!40000 ALTER TABLE `ScreenSize` DISABLE KEYS */;
INSERT INTO `ScreenSize` VALUES (1,'11'),(2,'15'),(3,'17');
/*!40000 ALTER TABLE `ScreenSize` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Search`
--

DROP TABLE IF EXISTS `Search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Search`
--

LOCK TABLES `Search` WRITE;
/*!40000 ALTER TABLE `Search` DISABLE KEYS */;
INSERT INTO `Search` VALUES (1,'teste','127.0.0.1','2014-04-05 22:44:02'),(2,'buscando','127.0.0.1','2014-04-05 22:44:07'),(3,'bombando','127.0.0.1','2014-04-05 22:44:13');
/*!40000 ALTER TABLE `Search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_images`
--

DROP TABLE IF EXISTS `ad_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7DF0A99F4F34D596` (`ad_id`),
  CONSTRAINT `FK_7DF0A99F4F34D596` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_images`
--

LOCK TABLES `ad_images` WRITE;
/*!40000 ALTER TABLE `ad_images` DISABLE KEYS */;
INSERT INTO `ad_images` VALUES (323,151,'initial',1,'2014-04-05 18:18:57','2014-04-05 18:18:57'),(324,151,'initial',2,'2014-04-05 18:18:57','2014-04-05 18:18:57'),(325,151,'initial',3,'2014-04-05 18:18:57','2014-04-05 18:18:57'),(326,152,NULL,1,'2014-04-05 18:22:08','2014-04-05 18:25:17'),(327,152,NULL,2,'2014-04-05 18:22:08','2014-04-05 18:25:17'),(328,152,NULL,3,'2014-04-05 18:22:08','2014-04-05 18:25:17'),(329,153,'ads/images/image_53408a94b9f0e.jpeg',1,'2014-04-05 19:58:28','2014-04-05 19:58:28'),(330,153,'ads/images/image_53408a94cfb9d.jpeg',2,'2014-04-05 19:58:28','2014-04-05 19:58:28'),(331,153,'initial',3,'2014-04-05 19:58:28','2014-04-05 19:58:28'),(332,154,'initial',1,'2014-04-05 21:53:48','2014-04-05 21:53:48'),(333,154,'initial',2,'2014-04-05 21:53:48','2014-04-05 21:53:48'),(334,154,'initial',3,'2014-04-05 21:53:48','2014-04-05 21:53:48'),(335,155,'initial',1,'2014-04-05 21:54:26','2014-04-05 21:54:26'),(336,155,'initial',2,'2014-04-05 21:54:26','2014-04-05 21:54:26'),(337,155,'initial',3,'2014-04-05 21:54:26','2014-04-05 21:54:26'),(338,156,'upload/ads/images/image_5341c1c72604b.jpeg',1,'2014-04-06 18:06:15','2014-04-06 18:06:15'),(339,156,'initial',2,'2014-04-06 18:06:15','2014-04-06 18:06:15'),(340,156,'initial',3,'2014-04-06 18:06:15','2014-04-06 18:06:15'),(341,157,'initial',1,'2014-04-10 21:22:37','2014-04-10 21:22:37'),(342,157,'initial',2,'2014-04-10 21:22:37','2014-04-10 21:22:37'),(343,157,'initial',3,'2014-04-10 21:22:37','2014-04-10 21:22:37'),(344,158,'initial',1,'2014-04-10 21:37:47','2014-04-10 21:37:47'),(345,158,'initial',2,'2014-04-10 21:37:47','2014-04-10 21:37:47'),(346,158,'initial',3,'2014-04-10 21:37:47','2014-04-10 21:37:47'),(347,159,'initial',1,'2014-04-24 20:40:11','2014-04-24 23:04:42'),(348,159,'initial',2,'2014-04-24 20:40:11','2014-04-24 23:04:42'),(349,159,'initial',3,'2014-04-24 20:40:11','2014-04-24 23:04:42'),(350,160,NULL,1,'2014-04-24 21:21:56','2014-04-24 22:15:15'),(351,160,NULL,2,'2014-04-24 21:21:56','2014-04-24 22:15:15'),(352,160,NULL,3,'2014-04-24 21:21:56','2014-04-24 22:15:15'),(353,161,'initial',1,'2014-04-24 22:08:04','2014-04-24 22:08:04'),(354,161,'initial',2,'2014-04-24 22:08:04','2014-04-24 22:08:04'),(355,161,'initial',3,'2014-04-24 22:08:04','2014-04-24 22:08:04');
/*!40000 ALTER TABLE `ad_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_msgs`
--

DROP TABLE IF EXISTS `ad_msgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) DEFAULT NULL,
  `ad_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E5C0A9482130303A` (`from_user_id`),
  KEY `IDX_E5C0A9484F34D596` (`ad_id`),
  KEY `IDX_E5C0A94829F6EE60` (`to_user_id`),
  CONSTRAINT `FK_E5C0A9482130303A` FOREIGN KEY (`from_user_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_E5C0A94829F6EE60` FOREIGN KEY (`to_user_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_E5C0A9484F34D596` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_msgs`
--

LOCK TABLES `ad_msgs` WRITE;
/*!40000 ALTER TABLE `ad_msgs` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_msgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_queues`
--

DROP TABLE IF EXISTS `ad_queues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_queues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `declined_msg_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_queues`
--

LOCK TABLES `ad_queues` WRITE;
/*!40000 ALTER TABLE `ad_queues` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_queues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (1,'admin','','40bd001563085fc35165329ea1ff5c5ecbdbbeef',1,'2014-01-01 00:00:00','2014-01-01 00:00:00','2014-01-01 00:00:00');
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ad_type` int(11) NOT NULL,
  `product_type` int(11) DEFAULT NULL,
  `neighbourhood` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `processor_id` int(11) DEFAULT NULL,
  `memory_id` int(11) DEFAULT NULL,
  `deleted_reason_id` int(11) DEFAULT NULL,
  `city_slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7EC9F620A76ED395` (`user_id`),
  KEY `IDX_7EC9F62012469DE2` (`category_id`),
  KEY `IDX_7EC9F6205DC6FE57` (`subcategory_id`),
  KEY `IDX_7EC9F6204584665A` (`product_id`),
  KEY `IDX_7EC9F620498DA827` (`size_id`),
  KEY `IDX_7EC9F6207ADA1FB5` (`color_id`),
  KEY `IDX_7EC9F62041A67722` (`screen_id`),
  KEY `IDX_7EC9F62037BAC19A` (`processor_id`),
  KEY `IDX_7EC9F620CCC80CB3` (`memory_id`),
  KEY `IDX_7EC9F62058B3E8E7` (`deleted_reason_id`),
  CONSTRAINT `FK_7EC9F62012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_7EC9F62037BAC19A` FOREIGN KEY (`processor_id`) REFERENCES `Processor` (`id`),
  CONSTRAINT `FK_7EC9F62041A67722` FOREIGN KEY (`screen_id`) REFERENCES `ScreenSize` (`id`),
  CONSTRAINT `FK_7EC9F6204584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_7EC9F620498DA827` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`),
  CONSTRAINT `FK_7EC9F62058B3E8E7` FOREIGN KEY (`deleted_reason_id`) REFERENCES `deleted_reason` (`id`),
  CONSTRAINT `FK_7EC9F6205DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`),
  CONSTRAINT `FK_7EC9F6207ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  CONSTRAINT `FK_7EC9F620A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  CONSTRAINT `FK_7EC9F620CCC80CB3` FOREIGN KEY (`memory_id`) REFERENCES `MemoryRam` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (151,9,1,2,NULL,'Teste teste','alow alow 2 brasil',123,'RJ','Niterói','24360100','Rua General Rondon',NULL,-1000,'2014-04-05 18:18:57','2014-04-06 15:07:40','teste-teste-',1,1,'São Francisco','initial',1,NULL,NULL,NULL,NULL,2,'sao-goncalo'),(152,9,1,2,NULL,'Teste teste 2','alow alow 2 brasil',123,'RJ','Niterói','24360100','Rua General Rondon',NULL,-1000,'2014-04-05 18:22:08','2014-04-06 14:24:40','teste-teste-2-152',1,1,'São Francisco','initial',1,NULL,NULL,NULL,NULL,NULL,'sao-goncalo'),(153,9,1,2,NULL,'iPod - Bem interessante','Vendo ipod bla bla bla',123,'RJ','Niterói','24360100','Rua General Rondon',NULL,-1000,'2014-04-05 19:58:28','2014-04-06 15:08:45','ipod-bem-interessante-153',1,1,'São Francisco','ads/images/image_53408a94b9f0e.jpeg',1,2,NULL,NULL,NULL,2,'sao-goncalo'),(154,9,1,3,NULL,'Ipod 22123','oaeaieioaeoaeieaoaeoeaoaeioaeae',12,'RJ','Niterói','24360100','Rua General Rondon',NULL,1,'2014-04-05 21:53:48','2014-04-05 21:54:49','ipod-22123-154',1,1,'São Francisco','initial',4,1,NULL,NULL,NULL,NULL,'sao-goncalo'),(155,9,1,4,NULL,'Ipod 4S bombando','Vem q vem q vem',120,'RJ','Niterói','24360100','Rua General Rondon',NULL,1,'2014-04-05 21:54:26','2014-04-05 21:54:57','ipod-4s-bombando-155',1,1,'São Francisco','initial',NULL,NULL,NULL,NULL,NULL,NULL,'sao-goncalo'),(156,9,1,2,NULL,'Apple Modem Baratinho','huhruhrhuruhhurahuhuahuhu',120,'RJ','Niterói','24360100','Rua General Rondon',NULL,1,'2014-04-06 18:06:15','2014-04-06 18:06:26','apple-modem-baratinho-156',1,1,'São Francisco','upload/ads/images/image_5341c1c72604b.jpeg',1,1,NULL,NULL,NULL,NULL,'sao-goncalo'),(157,9,4,20,NULL,'Vem q vem q vem','ahuahea eaeuh aeuhae uaeh uehae uh',20,'RJ','São Gonçalo','24420580','Rua Maria Adelaide','205',1,'2014-04-10 21:22:37','2014-04-10 21:22:48','vem-q-vem-q-vem-157',1,1,'Rocha','initial',4,NULL,1,NULL,1,NULL,'sao-goncalo'),(158,9,1,1,NULL,'Iphone 4S bombando','vem q vem ae aeaeeaeeae',120,'RJ','São Gonçalo','24420580','Rua Maria Adelaide',NULL,1,'2014-04-10 21:37:47','2014-04-10 21:39:51','iphone-4s-bombando-158',1,1,'Rocha','initial',NULL,NULL,NULL,NULL,NULL,NULL,'sao-goncalo'),(159,9,1,2,NULL,'aejaehuhueaeuhhaeuauehauehaeuhea','aeaeaeaeaeaeaeaeae',123,'RJ','Niterói','24360100','Rua General Rondon',NULL,1,'2014-04-24 20:40:11','2014-04-24 23:06:53','apple-modem-baratinho12-159-159-159-159',1,1,'São Francisco','initial',1,1,NULL,NULL,NULL,NULL,'niteroi'),(160,9,1,5,NULL,'Iphone 4S bombando 2','aeeeaaeaeejnejnejnaejnenjjn',212,'RJ','Niterói','24360100','Rua General Rondon',NULL,1,'2014-04-24 21:21:56','2014-04-24 22:15:30','iphone-4s-bombando-160-160-160',1,1,'São Francisco','upload/ads/images/image_5359aaa4712d5.jpeg',1,NULL,NULL,NULL,NULL,NULL,'niteroi'),(161,9,4,20,NULL,'Apple Modem Baratinho','wet wetwetw twe twe wewetw we we we',123,'RJ','Niterói','24360100','Rua General Rondon',NULL,0,'2014-04-24 22:08:04','2014-04-24 22:08:54','apple-modem-baratinho-161-161',1,1,'São Francisco','initial',NULL,NULL,NULL,NULL,NULL,NULL,'niteroi');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'iPod',1),(2,'iPhone',1),(3,'iPad',1),(4,'MacBook',1),(5,'iMac',1),(6,'Acessórios',1),(7,'Teste',1),(8,'Vai',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_colors`
--

DROP TABLE IF EXISTS `category_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_colors` (
  `category_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`color_id`),
  KEY `IDX_CD5609E412469DE2` (`category_id`),
  KEY `IDX_CD5609E47ADA1FB5` (`color_id`),
  CONSTRAINT `FK_CD5609E412469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CD5609E47ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_colors`
--

LOCK TABLES `category_colors` WRITE;
/*!40000 ALTER TABLE `category_colors` DISABLE KEYS */;
INSERT INTO `category_colors` VALUES (1,1),(1,2),(2,1),(2,2);
/*!40000 ALTER TABLE `category_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_memories`
--

DROP TABLE IF EXISTS `category_memories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_memories` (
  `category_id` int(11) NOT NULL,
  `memoryram_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`memoryram_id`),
  KEY `IDX_B88656FE12469DE2` (`category_id`),
  KEY `IDX_B88656FE6E199298` (`memoryram_id`),
  CONSTRAINT `FK_B88656FE12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B88656FE6E199298` FOREIGN KEY (`memoryram_id`) REFERENCES `MemoryRam` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_memories`
--

LOCK TABLES `category_memories` WRITE;
/*!40000 ALTER TABLE `category_memories` DISABLE KEYS */;
INSERT INTO `category_memories` VALUES (4,1),(4,2),(4,3),(4,4);
/*!40000 ALTER TABLE `category_memories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_processors`
--

DROP TABLE IF EXISTS `category_processors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_processors` (
  `category_id` int(11) NOT NULL,
  `processor_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`processor_id`),
  KEY `IDX_56520EC712469DE2` (`category_id`),
  KEY `IDX_56520EC737BAC19A` (`processor_id`),
  CONSTRAINT `FK_56520EC712469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_56520EC737BAC19A` FOREIGN KEY (`processor_id`) REFERENCES `Processor` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_processors`
--

LOCK TABLES `category_processors` WRITE;
/*!40000 ALTER TABLE `category_processors` DISABLE KEYS */;
INSERT INTO `category_processors` VALUES (4,1),(4,2),(4,3);
/*!40000 ALTER TABLE `category_processors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_screens`
--

DROP TABLE IF EXISTS `category_screens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_screens` (
  `category_id` int(11) NOT NULL,
  `screensize_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`screensize_id`),
  KEY `IDX_FAD0F3B812469DE2` (`category_id`),
  KEY `IDX_FAD0F3B8C172CD0D` (`screensize_id`),
  CONSTRAINT `FK_FAD0F3B812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FAD0F3B8C172CD0D` FOREIGN KEY (`screensize_id`) REFERENCES `ScreenSize` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_screens`
--

LOCK TABLES `category_screens` WRITE;
/*!40000 ALTER TABLE `category_screens` DISABLE KEYS */;
INSERT INTO `category_screens` VALUES (4,1),(4,2),(4,3);
/*!40000 ALTER TABLE `category_screens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_sizes`
--

DROP TABLE IF EXISTS `category_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_sizes` (
  `category_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`size_id`),
  KEY `IDX_5EADC82012469DE2` (`category_id`),
  KEY `IDX_5EADC820498DA827` (`size_id`),
  CONSTRAINT `FK_5EADC82012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5EADC820498DA827` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_sizes`
--

LOCK TABLES `category_sizes` WRITE;
/*!40000 ALTER TABLE `category_sizes` DISABLE KEYS */;
INSERT INTO `category_sizes` VALUES (1,1),(1,4),(2,1),(2,2),(2,3),(4,4);
/*!40000 ALTER TABLE `category_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'Branco'),(2,'Preto'),(3,'Amarelo');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `declined_ads`
--

DROP TABLE IF EXISTS `declined_ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `declined_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `declined_msg_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C3C5952B4F34D596` (`ad_id`),
  KEY `IDX_C3C5952BCF186FB3` (`declined_msg_id`),
  CONSTRAINT `FK_C3C5952B4F34D596` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`),
  CONSTRAINT `FK_C3C5952BCF186FB3` FOREIGN KEY (`declined_msg_id`) REFERENCES `declined_msgs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `declined_ads`
--

LOCK TABLES `declined_ads` WRITE;
/*!40000 ALTER TABLE `declined_ads` DISABLE KEYS */;
INSERT INTO `declined_ads` VALUES (3,160,1,'2014-04-24 21:28:45','2014-04-24 21:28:45'),(4,160,1,'2014-04-24 21:28:55','2014-04-24 21:28:55'),(5,161,1,'2014-04-24 22:08:54','2014-04-24 22:08:54');
/*!40000 ALTER TABLE `declined_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `declined_msgs`
--

DROP TABLE IF EXISTS `declined_msgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `declined_msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `declined_msgs`
--

LOCK TABLES `declined_msgs` WRITE;
/*!40000 ALTER TABLE `declined_msgs` DISABLE KEYS */;
INSERT INTO `declined_msgs` VALUES (1,'Nao quero');
/*!40000 ALTER TABLE `declined_msgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleted_reason`
--

DROP TABLE IF EXISTS `deleted_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deleted_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleted_reason`
--

LOCK TABLES `deleted_reason` WRITE;
/*!40000 ALTER TABLE `deleted_reason` DISABLE KEYS */;
INSERT INTO `deleted_reason` VALUES (1,'Vendi o produto'),(2,'Desisti de vender'),(3,'Nao gostei do site'),(4,'Outro');
/*!40000 ALTER TABLE `deleted_reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebookId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighbourhood` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (5,'bernardo','bernardo','bernardo@gmail.com','bernardo@gmail.com',1,'r24naritdqsoggwc4ko8ss848wg0sg0','Mko1jBLEbMWEL0lTZlhKSWOcg3PPTET/w6kaOR52afCLRHh0aJ/5L8X3DCEJ6YBCa6rQIsQ6OCUFMwQo5PesCw==','2013-12-03 12:23:03',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Bernardo','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'bernardao','bernardao','bernardo@gmail.com.br','bernardo@gmail.com.br',1,'enlyz40il4gs88w0owo44k4kgcwk8o0','fLOnvXzs5rLt4eTnD7t/75Fnh8E2CHKbKNb8TVpaFUGJdM30yTdjo/G8um7lgIxNLdUpNlFaGaUBxhHe8CvZlQ==','2013-12-03 17:03:25',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Agoravai','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'teste','teste','bernardo@aaa.com','bernardo@aaa.com',1,'l2r7j4jjplccgkskgg4gk4so4owko0k','88JBSK/RZUwyT00+4WWuGtZV6vGSQq0c81viwE3ICLo6FklRHmCnnKyYbMx775MZqaj84YntMFuDis41D3GxXg==','2013-12-03 17:04:06',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Joao','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'bernardooo','bernardooo','be@be.com','be@be.com',1,'b82a6flpznk0g8ossg4g04swcwkw4ko','KNwQVdX9g+SKx+Nxooq8fWbtrnicydRrgskNFZrgR4+UXnmwsKYwSvsA+E+Gsojm1l6dM03eVjDRnar4kfGA1A==','2013-12-15 14:43:40',0,0,NULL,'prxeChEK769XdjioYG7LH6tt8jC393ZFV2Gr-od25ic','2013-12-07 22:49:39','a:0:{}',0,NULL,'bernardo','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'bernardo123','bernardo123','bernardoniteroi@gmail.com','bernardoniteroi@gmail.com',1,'mdv0eaurhogwg4wcgoowg0cgc0o44g0','VN5GWvNSSOhOjaIiBNf5Qnv7UoYKPeYDMbnrrbiGH1mbGF/VPL2hX8nA7349wcdGJ/5zr/gQzns6sjhoMW16QQ==','2014-04-05 17:30:52',0,0,NULL,'RzfHaFiAoxokv8NMja--qy997jZa3PrhEnoVxTjszFw','2014-03-07 13:33:21','a:0:{}',0,NULL,'bernardo dantas','(21) 9797-9121','','','','RJ','Niterói','24360100','115.555.097-89',NULL,NULL,NULL),(10,'gusmao','gusmao','bernardo.d.alves@gmail.com','bernardo.d.alves@gmail.com',1,'fvzzbclwd68sc44g4ok4cc888kccwwo','H9/eGhCUxf7HqWgzjVW/SkEGppFznysV7TVCMGD6LX/apMwdwaCUDNTnaacJlR46pEMh6cbzoIeCe3Su3LQOzQ==','2014-01-03 23:03:08',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Gusmao',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'gusmao1','gusmao1','gusmao@gusmao.com','gusmao@gusmao.com',0,'hv6we1598g000g80w40gk484sokok0c','uU6A/Xq+jppEa3sSyZKrlt7Le4pydJz0Qvf63XzlO9NWPzD15bgcAB653YEB5VEanwp3KevDa52VwBgYa3IOJA==',NULL,0,0,NULL,'v0WXCo62KQPqMrnUWiKK5_mtIZXdZGNEneKAbzJtUB4',NULL,'a:0:{}',0,NULL,'gusmao',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'crashboy','crashboy','crashboynit@gmail.com','crashboynit@gmail.com',1,'1nagosjunqskwo8wo8csswcs0k4os8g','A/1Flh3BYK5vdDqUCggXEFBOQZcADzdxRQloRcBXle+LebhiAc1lQ1vnOz6j+k7t7lPbKIZi7CuOiy9msQmMPQ==','2014-01-25 18:17:27',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'crashboy',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'bernardao1','bernardao1','bernardo.alves@lasallerj.edu.br','bernardo.alves@lasallerj.edu.br',1,'obowux8aw7k8koc4g8wggsww0gsoc4s','kDVJsbT9Z4P9RHsjPK+8z7jRHIcqR2P3Wue706WbcRr7eVqPEpRWn52Cndy6RMGJPxGDWY88YtP+IWBNtTCaiw==','2014-01-25 18:36:13',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Geraldo Da Silva',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'bernardo123123','bernardo123123','bernardoniteroi2@gmail.com','bernardoniteroi2@gmail.com',0,'7xqlf3l3pugwccooo4kg44wgg4gog8o','9ArhzQTrazQbafitTD2xp+kVSygXQ/Z+4f0VjgP+XiskgHJDnt1kJzh3tL3tCiSQbslJCXbtplL9lvjKeuWuyQ==',NULL,0,0,NULL,'NfnKOBXis_CltBIrVK-cjLHerWnxlH0jqCyE160etqc',NULL,'a:0:{}',0,NULL,'bernardo dantas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'bernardo123123123','bernardo123123123','bernardoniteroi1232@gmail.com','bernardoniteroi1232@gmail.com',0,'kwd17im1u74ggcso0co88804os48cwk','53Kq2PXT5joWkz1VsfWw2H1o/8ntNOM8MItINF2MMgPd8vgi8NkoxZn1PaADN9RDik49Mq4jI+26d+JbvZSs4g==',NULL,0,0,NULL,'3HZG-xloOSDMWcvbRZMQsrVQ11knl2sC7FksSRh96zo',NULL,'a:0:{}',0,NULL,'bernardo dantas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'bernardo1231231233','bernardo1231231233','bernardoniteroi12332@gmail.com','bernardoniteroi12332@gmail.com',0,'b21jrxzzmw8o8ow4cwc8k0o8kwskwkc','34UF22ZLgZkJ0nrUnYaP6xxCPMUHzRkqR9f5+PidJtIO7mSaFK5EoRc88FuEbKiq7UDcVtB7gSrv8PczOX1pHw==',NULL,0,0,NULL,'Vo3JpSOF5Uh2slVRPsxawRbX2TFTHq1-3ENJxQA2gzs',NULL,'a:0:{}',0,NULL,'bernardo dantas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'user1','user1','user@user.com','user@user.com',0,'7tm721gwb6gwcks44g4k8w0gkss0g08','hteC3tLqDsypr/fQwzD3XB5ojsvTJ7BTT60I6gr/DmRcPknzmLGkooS0aWboVDpjc5gzsDJ3Xhgwy3gAOSbqqw==',NULL,0,0,NULL,'wKmsZYx-ipMNGy5_7mMic98VFy4JblqrQJimzIG06Nw',NULL,'a:0:{}',0,NULL,'bernardo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'user2','user2','user@user2.com','user@user2.com',0,'gwtaomez9dwg84kwo0kkscgwog4ww44','esraSDqx0cMU7QZv9Q0yz/7+/Gp70LOjKfBatWnOde54Ay4sDJnnH48zoIX1lzt5WpIL8I9UW/QWe5yKecik8A==',NULL,0,0,NULL,'UomRGlx4rsPHvEdfbtIjY3-5K3vjPPMiNc8leG1uTig',NULL,'a:0:{}',0,NULL,'berrrrr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'user23','user23','user@user32.com','user@user32.com',0,'i5kik4y0dlskk0s4c00kkw40gg8sow4','kdaejYUhmVaTYsNcMAIKce8g64VpDtH3O9UQ5EX6h4OozwDQ/wNExxnm1h2j2hanhxYmuQnnuiAuLYzVeTlx1Q==',NULL,0,0,NULL,'NSkPP7OepJ3stPcanSEYsUftG2YQWBe0BHeGVqg0ZUI',NULL,'a:0:{}',0,NULL,'berrrrr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'user232','user232','user@user322.com','user@user322.com',0,'ayma8mkkgeo8400wg0swcw8gok404gk','9MJ4ivk1Q2FCLgMiV2BbQ4jVoCc01tUtqoGlBmoj7bX0fvG52USLjhs1ZzD4YOHLtd6JenFoXom8XyOFjpyQLg==',NULL,0,0,NULL,'RbNzC7EEqgvJ0FsmEUiNxo5rBsqmVK9ZnOJUPQN5BJA',NULL,'a:0:{}',0,NULL,'berrrrr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'oiooioioi','oiooioioi','admin@aoaoaoao.com','admin@aoaoaoao.com',0,'kdi5q9b02tsc04088w48ggcg0c88kgo','FX16OOcqGNd1QOpebxdL3RKrPYEPeeI6jVE2+gurtdj2i/NA1lKNuAo70Ic1yV5vW+XFs2ONzrVOnUbsCkMB5A==',NULL,0,0,NULL,'Uf3nYs4yfY8Fksuh_8RowwaTEa9VnJ_cx2ll-auk-bk',NULL,'a:0:{}',0,NULL,'earaerae',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'testeteste','testeteste','tese@testete.com','tese@testete.com',0,'7dampyfqas4cg4gkook08s048sw4kgo','kk4Sv462W3jVo0+GexK64NbQz1PWLLPMIEVF5KUP6E48V0NvUSB7ISZE7iywx/WNmaT8BWSiCuPzimIjpGmR0Q==',NULL,0,0,NULL,'3SAYtva8z7umSc32VZUtHIK-r5RL825XXzZE4XnTtnQ',NULL,'a:0:{}',0,NULL,'testando',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'testeteste2','testeteste2','tese@testete2.com','tese@testete2.com',0,'114a9c43pl5ww4kscokcc8s8cokc4cs','73IBqML2TzZUfbKeT0xzOukKHHDpm6I+xtCRAh022DT2bGEfJyN+TMZNQiLHKhZtIwFIJfpHGdz5uV5wPS5BIQ==',NULL,0,0,NULL,'HTtJBcKejQf4kXswQq0RiWvazh4oyUprnpKciEl7U44',NULL,'a:0:{}',0,NULL,'testando',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'testeteste23','testeteste23','tese@testete33.com','tese@testete33.com',0,'bzhwfm1yc5c08o844csk8skscgo008g','vZaQRhSpbaGT32qEB8hwh3uf7P9Pdhg+cLY7BqpRxDh6OIwB8cfrMtCHisepCSz5MsE1FzV/TmdMbbuppVRL6g==',NULL,0,0,NULL,'FVUQv4MYb5wjtKCqWASBHJNjuLouWAS3jvQ_eBbNgno',NULL,'a:0:{}',0,NULL,'testando',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'testeteste232','testeteste232','tese@testete323.com','tese@testete323.com',0,'cuq4ypa3jxssc8o00kcwss0w44sgw48','+EPJgLYn8yrSGdqwrkYbd7dVDmVwZwnc2KvgTS2NI1HC05IuI9By+fclV9eXY3F8FjnI/YTLdASccN9EFm8khQ==',NULL,0,0,NULL,'2ZGEi-JlyOguMOYJBemLMhy-q7qShOAlL4BSINYou10',NULL,'a:0:{}',0,NULL,'testando',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'bernardo123222','bernardo123222','rt@tea.cm','rt@tea.cm',0,'h5y03xfaqo004sowc0w8ckg40ckw4gw','l6ITXdbwucQybPI1B3FhS1JhU2fWfjohhTIRFk+HfYAroKBLnXoizLyCDu7mgvOYCHP+/P04elSL56oO9pvmNw==',NULL,0,0,NULL,'TEZaIUgqg0iNlZYvMpbSBuyZamBPEVfQKU6kJjYO-q8',NULL,'a:0:{}',0,NULL,'bernardo dantas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,'123321','123321','aaa@aaa.com','aaa@aaa.com',0,'age5vbh98ow0ccwkc08skkcsww4owws','YmQw1LXp/lyagjbzb8TCHs+I8FWkyjkeaII017XZI6HNQfGFKmhRtdNJNTYmDqeB/5VIa/2fYX17w5yys+XXyQ==',NULL,0,0,NULL,'dD3Rc-As98QjXhUs1Bu004RUYuu0Q38fOEiMWgLseEc',NULL,'a:0:{}',0,NULL,'bernardo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'123123123123','123123123123','123@123.com','123@123.com',0,'4hkec6c0iq040wocosokoks0go48w00','lwDT4ZnyQcvIYo6KnXLQphUm7+MkYlYXLvQmCr2JdYSP1yCiA0V3tiDkSHqgTqpXUy9Ewus4Ena2tlsxrshb4Q==',NULL,0,0,NULL,'ocxB_8CsagyYsxaNlKs-7CFgy21OY6hoqKfey7TD2p0',NULL,'a:0:{}',0,NULL,'bernardo dantas',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,'ahahahahahahhh','ahahahahahahhh','122@222.com','122@222.com',0,'i1ebwx67xvs4ww4sso40cgggs4cgc0c','3LePFbHCfSLCQx7QUJAcPOTfnQaQnyWi0zHkusNgWxEvjMdckK24yubyW3i4tRMcbFvapLgAbkDEqO49ndQDQQ==',NULL,0,0,NULL,'TNSSBTxxEsL3-cxibh8NOOTcvO4xXs7tQ7_oqK8WaE8',NULL,'a:0:{}',0,NULL,'gusmao',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,'okk','okk','ok@ok.com','ok@ok.com',0,'5gvv4no340sg0ksksgk04kg480w0kos','J1zxOoLF4g09aHwZgsHVrFa6t743QTr+fF+D8X/GzN7yzBnfVYYUQdPFKZ8IeD7dp+eemG/+hogWo7oB+ejb5Q==',NULL,0,0,NULL,'kX7_CTMfqT5cITjkqvG8qTzPLE7At8_I7HBjZx6CV98',NULL,'a:0:{}',0,NULL,'ok ok ok',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,'okk22','okk22','ok2@ok.com','ok2@ok.com',0,'7i243qn0y78kk4004so80ss8osk0c4c','5V+3NaGpi2x6y7SkMm2QpwKqZnDZ0fMrSU1mukcu9U9WZ8tMDz1s2mlSzHzXLJ5cSiuJZVUeBdErHCU9AeKPbg==',NULL,0,0,NULL,'3lMcLK5O97qaueXqvwUG17OAKyf-maRcmFWsK2s_Eeg',NULL,'a:0:{}',0,NULL,'okokokok',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,'okk223','okk223','ok2@ok23.com','ok2@ok23.com',0,'fhdx8p8f0k0884oww0swcccwsosc8w0','+J3RHjlfc+4AyeOGvTAuVKjCrJIgb/WJ66IX1+cC9z3DFzF0k4ZMcY5tHSOs+s3kCw2UMaGjJiwAaxgk6x+Bng==',NULL,0,0,NULL,'A0MKYoKsF2yBpopoCgEmMZrVgXu-SqWFp8b-BbGWoSw',NULL,'a:0:{}',0,NULL,'okokokok',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,'bezzzon','bezzzon','oi@oi.com','oi@oi.com',0,'lcp4w0bglu88kg8kwcwosksc0kckk0w','ptESJz+hf8A/JlpB6WGRhf52JxAW0bzMOC9ssthnPDrOwZ7KtGFfZ64OXStK9mebIWur+bUr4wk4p8OfhAoOxQ==',NULL,0,0,NULL,'CAVV7zgYtshLA5wGcBnFCixGgSYnd-aBzo0kTss1asY',NULL,'a:0:{}',0,NULL,'okk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generations`
--

DROP TABLE IF EXISTS `generations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generations`
--

LOCK TABLES `generations` WRITE;
/*!40000 ALTER TABLE `generations` DISABLE KEYS */;
INSERT INTO `generations` VALUES (1,'1a'),(2,'2a'),(3,'3a'),(4,'4a'),(5,'5a'),(6,'6a');
/*!40000 ALTER TABLE `generations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_colors` (
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`color_id`),
  KEY `IDX_A0C2823B4584665A` (`product_id`),
  KEY `IDX_A0C2823B7ADA1FB5` (`color_id`),
  CONSTRAINT `FK_A0C2823B4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A0C2823B7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_colors`
--

LOCK TABLES `product_colors` WRITE;
/*!40000 ALTER TABLE `product_colors` DISABLE KEYS */;
INSERT INTO `product_colors` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1),(4,2),(5,1),(5,2),(6,1),(6,2),(7,1),(7,2),(8,1),(8,2),(9,1),(9,2),(16,1),(16,2),(17,1),(17,2),(18,1),(18,2),(19,1),(19,2);
/*!40000 ALTER TABLE `product_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_generations`
--

DROP TABLE IF EXISTS `product_generations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_generations` (
  `product_id` int(11) NOT NULL,
  `generation_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`generation_id`),
  KEY `IDX_6F99E5C4584665A` (`product_id`),
  KEY `IDX_6F99E5C553A6EC4` (`generation_id`),
  CONSTRAINT `FK_6F99E5C4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6F99E5C553A6EC4` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_generations`
--

LOCK TABLES `product_generations` WRITE;
/*!40000 ALTER TABLE `product_generations` DISABLE KEYS */;
INSERT INTO `product_generations` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(2,1),(10,1),(11,2),(12,3),(13,4),(14,4),(15,1),(15,2),(16,1),(16,2),(16,3),(16,4),(17,1),(17,2),(17,3),(17,4),(17,5),(17,6),(18,1),(18,2),(18,3),(18,4),(18,5),(18,6),(19,1),(19,2),(19,3),(19,4),(19,5),(19,6);
/*!40000 ALTER TABLE `product_generations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_sizes` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`size_id`),
  KEY `IDX_17C2FC354584665A` (`product_id`),
  KEY `IDX_17C2FC35498DA827` (`size_id`),
  CONSTRAINT `FK_17C2FC354584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_17C2FC35498DA827` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_sizes`
--

LOCK TABLES `product_sizes` WRITE;
/*!40000 ALTER TABLE `product_sizes` DISABLE KEYS */;
INSERT INTO `product_sizes` VALUES (1,1),(1,2),(1,3),(2,1),(3,1),(3,2),(4,1),(4,2),(5,1),(5,2),(6,1),(6,2),(7,1),(7,2),(8,1),(8,2),(9,1),(9,2),(10,1),(10,2),(10,3),(11,1),(11,2),(11,3),(12,1),(12,2),(12,3),(13,1),(13,2),(13,3),(14,1),(14,2),(14,3),(15,1),(15,2),(15,3),(16,1),(16,2),(16,3),(17,1),(17,2),(17,3),(18,1),(18,2),(18,3),(19,1),(19,2),(19,3);
/*!40000 ALTER TABLE `product_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5A12469DE2` (`category_id`),
  KEY `IDX_B3BA5A5A5DC6FE57` (`subcategory_id`),
  CONSTRAINT `FK_B3BA5A5A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_B3BA5A5A5DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'iPod Classic',1,1),(2,2,'iPhone (1a Geração)',1,7),(3,2,'Iphone 3G',1,8),(4,2,'Iphone 3GS',1,9),(5,2,'Iphone 4',1,10),(6,2,'Iphone 4S',1,11),(7,2,'Iphone 5',1,12),(8,2,'Iphone 5s',1,13),(9,2,'Iphone 5c',1,14),(10,3,'iPad 1',1,15),(11,3,'iPad 2',1,16),(12,3,'iPad 3',1,17),(13,3,'iPad 4',1,18),(14,3,'iPad Mini',1,19),(15,1,'iPod Mini',1,2),(16,1,'iPod Shuffle',1,3),(17,1,'iPod Nano',1,4),(18,1,'iPod Touch',1,5),(19,1,'iPod Outros',1,6);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `session_id` varchar(255) NOT NULL,
  `session_value` text NOT NULL,
  `session_time` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES ('akp42h2nv638936o7o01hn6dt2','X3NmMl9hdHRyaWJ1dGVzfGE6MTM6e3M6MTQ6Il9zZWN1cml0eV9tYWluIjtzOjY0NDoiQzo2ODoiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxBdXRoZW50aWNhdGlvblxUb2tlblxSZW1lbWJlck1lVG9rZW4iOjU2Mjp7YTozOntpOjA7czo0MDoiNWM5OTkwM2NmNDFiM2IzMWQ2OGM0YWUxY2MzMWFiMGZlNjk4Mjg3MiI7aToxO3M6NDoibWFpbiI7aToyO3M6NDc2OiJhOjQ6e2k6MDtDOjMxOiJpTGlzdFxCYWNrZW5kQnVuZGxlXEVudGl0eVxVc2VyIjoyNjU6e2E6Mjp7aTowO3M6MDoiIjtpOjE7czoyMzU6ImE6OTp7aTowO3M6ODg6IlZONUdXdk5TU09oT2phSWlCTmY1UW52N1VvWUtQZVlETWJucnJiaUdIMW1iR0YvVlBMMmhYOG5BNzM0OXdjZEdKLzV6ci9nUXpuczZzamhvTVcxNlFRPT0iO2k6MTtzOjMxOiJtZHYwZWF1cmhvZ3dnNHdjZ29vd2cwY2djMG80NGcwIjtpOjI7czoxMToiYmVybmFyZG8xMjMiO2k6MztzOjExOiJiZXJuYXJkbzEyMyI7aTo0O2I6MDtpOjU7YjowO2k6NjtiOjA7aTo3O2I6MTtpOjg7aTo5O30iO319aToxO2I6MTtpOjI7YToxOntpOjA7Tzo0MToiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUiOjE6e3M6NDc6IgBTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZQByb2xlIjtzOjk6IlJPTEVfVVNFUiI7fX1pOjM7YTowOnt9fSI7fX0iO3M6MTg6Il9jc3JmL3JlZ2lzdHJhdGlvbiI7czo0MzoiLW5rRGE5RTRRZVktOXlDOEJmR2ZqdTZCT2RkNnl4S2Z4UUwtZFAzaHg3RSI7czoyOToiX2NzcmYvaWxpc3RfZnJvbnRlbmRidW5kbGVfYWQiO3M6NDM6InM5Q2dTNkhLWEFtM1FuaTdHaS1hSXJzTURYUG83bjZ2dzU3c0lJTzBqeVUiO3M6Mjg6Il9zZWN1cml0eV9hZG1pbl9zZWN1cmVkX2FyZWEiO3M6Mzc0OiJDOjc0OiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXEF1dGhlbnRpY2F0aW9uXFRva2VuXFVzZXJuYW1lUGFzc3dvcmRUb2tlbiI6Mjg2OnthOjM6e2k6MDtOO2k6MTtzOjE4OiJhZG1pbl9zZWN1cmVkX2FyZWEiO2k6MjtzOjIzMToiYTo0OntpOjA7QzozNjoiaUxpc3RcQmFja2VuZEJ1bmRsZVxFbnRpdHlcQWRtaW5Vc2VyIjoxNDp7YToxOntpOjA7aToxO319aToxO2I6MTtpOjI7YToxOntpOjA7Tzo0MToiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUiOjE6e3M6NDc6IgBTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZQByb2xlIjtzOjEwOiJST0xFX0FETUlOIjt9fWk6MzthOjA6e319Ijt9fSI7czo0MDoiX2NzcmYvaWxpc3RfZnJvbnRlbmRidW5kbGVfaXBob25lX2ZpbHRlciI7czo0MzoiSlA4S29SWWJfZ29MLS1uMFFCdW15T05PdGdpZ0tJLXZCZVo0SV9KdVVvQSI7czozODoiX2NzcmYvaWxpc3RfZnJvbnRlbmRidW5kbGVfaXBhZF9maWx0ZXIiO3M6NDM6Ilp0TkVWMlhNa3BMQTJ6Q2xUelA5QmVCdnlxejRDbUxvbnVNcXFLSjZ0WTQiO3M6MzM6Il9jc3JmL2lsaXN0X2Zyb250ZW5kYnVuZGxlX2FkX21zZyI7czo0MzoiN0J2bHNJbFk2am9WMlpXQXhKN29ZbUdpTFdpanczWHhHNmV0eXM4V1pNSSI7czoxMDoiX2NzcmYvZm9ybSI7czo0MzoiemU2Q0lBdFNmQzlRQ3R5X3FobDZxeE9DTGNnTlVER0dOcnFCcnE0emc2VSI7czozMToiX2NzcmYvaWxpc3RfZnJvbnRlbmRidW5kbGVfdXNlciI7czo0MzoiWkl3UjBkZThfbVJLb213WTZuYV8xX2pMMFQzSG53SUR5d2hWd2Fpc2JpTSI7czozOToiX2NzcmYvaWxpc3RfYmFja2VuZGJ1bmRsZV9kZWxldGVkcmVhc29uIjtzOjQzOiItUkVIY0lWVVZoU2VUV2dLXzVxLTMxYU43RUx2LVRzdWwwbUhYZER6LVVvIjtzOjQyOiJfY3NyZi9pbGlzdF9mcm9udGVuZGJ1bmRsZV9kZWxldGVkX3JlYXNvbjIiO3M6NDM6IjhQX3oxdlZRZC02NTdlT1BLSW5RSUhGcjdxVnRTckE4YklSdUpfdFRYLXciO3M6NDE6Il9jc3JmL2lsaXN0X2Zyb250ZW5kYnVuZGxlX2RlbGV0ZWRfcmVhc29uIjtzOjQzOiIyV0w1SzJkWEZYbUJ4UjAtQUJ5REh1RmlnZElnb29taWJLU1MyLXhHcjV3IjtzOjQxOiJfY3NyZi9pbGlzdF9mcm9udGVuZGJ1bmRsZV9tYWNib29rX2ZpbHRlciI7czo0MzoiWUplNHVocDJCSVpDVExXd0tFVjQ5UE53QXlUVEQ2VmtEVmtfLVR2ZUFySSI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTM5ODcxNjI1MztzOjE6ImMiO2k6MTM5NjcyOTg1MjtzOjE6ImwiO3M6MToiMCI7fQ==',1398716254);
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,'16'),(2,'32'),(3,'64'),(4,'128');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_723649C912469DE2` (`category_id`),
  CONSTRAINT `FK_723649C912469DE2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,'Classic',1,1),(2,'Mini',1,1),(3,'Shuffle',1,1),(4,'Nano',1,1),(5,'Touch',1,1),(6,'Outros',1,1),(7,'1a Geração',1,2),(8,'3G',1,2),(9,'3GS',1,2),(10,'4',1,2),(11,'4S',1,2),(12,'5',1,2),(13,'5S',1,2),(14,'5C',1,2),(15,'1',1,3),(16,'2',1,3),(17,'3',1,3),(18,'4',1,3),(19,'Mini',1,3),(20,'Pro',1,4),(21,'Air',1,4),(22,'Apple TV',1,6),(23,'Apple Modem',1,6),(24,'Carregadores',1,6),(25,'Cabos',1,6),(26,'Fones de Ouvido',1,6),(27,'Impressoras',1,6),(28,'Fones de Ouvido',1,6),(29,'Memórias',1,6),(30,'Mouses',1,6),(31,'Servidores',1,6),(32,'Serviços',1,6),(33,'Softwares',1,6),(34,'Teclado',1,6);
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-30  9:29:09
