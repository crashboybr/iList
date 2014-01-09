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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_images`
--

LOCK TABLES `ad_images` WRITE;
/*!40000 ALTER TABLE `ad_images` DISABLE KEYS */;
INSERT INTO `ad_images` VALUES (44,58,'ads/images/image_52b39e93636a6.jpeg',1,'2013-12-19 23:34:11','2013-12-19 23:34:11'),(45,58,'initial',2,'2013-12-19 23:34:11','2013-12-19 23:34:11'),(46,58,'initial',3,'2013-12-19 23:34:11','2013-12-19 23:34:11'),(47,59,'ads/images/image_52b3a16e27b7d.jpeg',1,'2013-12-19 23:46:22','2013-12-19 23:46:22'),(48,59,'initial',2,'2013-12-19 23:46:22','2013-12-19 23:46:22'),(49,59,'initial',3,'2013-12-19 23:46:22','2013-12-19 23:46:22'),(50,60,'ads/images/image_52c5f1cd820d8.jpeg',1,'2014-01-02 21:10:05','2014-01-02 21:10:05'),(51,60,'ads/images/image_52c5f1cdd4e57.jpeg',2,'2014-01-02 21:10:05','2014-01-02 21:10:05'),(52,60,'ads/images/image_52c5f1cdd51a3.jpeg',3,'2014-01-02 21:10:05','2014-01-02 21:10:05'),(53,61,'ads/images/image_52c9da34dfcd1.jpeg',1,'2014-01-05 20:18:29','2014-01-05 20:18:29'),(54,61,'ads/images/image_52c9da3515cf1.jpeg',2,'2014-01-05 20:18:29','2014-01-05 20:18:29'),(55,61,'ads/images/image_52c9da3515fb6.mp4',3,'2014-01-05 20:18:29','2014-01-05 20:18:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_msgs`
--

LOCK TABLES `ad_msgs` WRITE;
/*!40000 ALTER TABLE `ad_msgs` DISABLE KEYS */;
INSERT INTO `ad_msgs` VALUES (1,9,60,'Nova Mensagem - Gusmao vende rapido','Oi gusmao faz por qto?','bernardo','bernardoniteroi@gmail.com',NULL,10,-1,'2014-01-02 21:10:53','2014-01-02 21:10:53'),(2,9,60,'Nova Mensagem - Gusmao vende rapido','Oi gusmao faz por qto?','bernardo','bernardoniteroi@gmail.com',NULL,10,-1,'2014-01-02 21:12:03','2014-01-02 21:12:03'),(3,10,59,'Nova Mensagem - Iphone 4S','oi ta qto amigao','Gusmao','bernardo.d.alves@gmail.com',NULL,9,-1,'2014-01-02 21:12:57','2014-01-02 21:12:57'),(4,10,59,'Nova Mensagem - Iphone 4S','queria mto pra mim','Gusmao','bernardo.d.alves@gmail.com',NULL,9,-1,'2014-01-02 22:41:18','2014-01-02 22:41:18'),(5,10,58,'Nova Mensagem - Testando iPhone','quero 50','Gusmao','bernardo.d.alves@gmail.com',NULL,9,-1,'2014-01-03 23:03:29','2014-01-03 23:03:29'),(6,9,59,'RE: Iphone 4S','aeaeae','bernardo','bernardoniteroi@gmail.com',NULL,10,-1,'2014-01-03 23:55:53','2014-01-03 23:55:53'),(7,10,59,'RE: Iphone 4S','show de bola','Gusmao','bernardo.d.alves@gmail.com',NULL,9,-1,'2014-01-03 23:56:15','2014-01-03 23:56:15'),(8,9,59,'RE: Iphone 4S','vai querer?','bernardo','bernardoniteroi@gmail.com',NULL,10,-1,'2014-01-04 00:01:18','2014-01-04 00:01:18'),(9,10,59,'RE: Iphone 4S','sim.. qdo tu pode entregar?','Gusmao','bernardo.d.alves@gmail.com',NULL,9,-1,'2014-01-04 00:01:35','2014-01-04 00:01:35'),(10,9,59,'RE: Iphone 4S','Amanha ja eh?','bernardo','bernardoniteroi@gmail.com',NULL,10,-1,'2014-01-04 00:02:12','2014-01-04 00:02:12'),(11,10,59,'RE: Iphone 4S','ja eh irmao eh nois','Gusmao','bernardo.d.alves@gmail.com',NULL,9,-1,'2014-01-04 00:03:27','2014-01-04 00:03:27'),(12,9,59,'RE: Iphone 4S','com certeza! nois q ta','bernardo','bernardoniteroi@gmail.com',NULL,10,-1,'2014-01-04 00:04:01','2014-01-04 00:04:01');
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
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `IDX_7EC9F620A76ED395` (`user_id`),
  KEY `IDX_7EC9F62012469DE2` (`category_id`),
  KEY `IDX_7EC9F6205DC6FE57` (`subcategory_id`),
  KEY `IDX_7EC9F6204584665A` (`product_id`),
  KEY `IDX_7EC9F620498DA827` (`size_id`),
  KEY `IDX_7EC9F6207ADA1FB5` (`color_id`),
  CONSTRAINT `FK_7EC9F62012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_7EC9F6204584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_7EC9F620498DA827` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`),
  CONSTRAINT `FK_7EC9F6205DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`),
  CONSTRAINT `FK_7EC9F6207ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  CONSTRAINT `FK_7EC9F620A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (58,9,2,9,1,'Testando iPhone','bla bla bla',200,'RJ','Niterói','24360100','Rua General Rondon','29A',0,'2013-12-19 23:34:11','2014-01-05 20:03:50','testando-iphone-58-58-58',1,1,'São Francisco','ads/images/image_52b39e93636a6.jpeg',2,2),(59,9,2,11,NULL,'Iphone 4S','vem q vem',229,'RJ','Niterói','24360100','Rua General Rondon','29',1,'2013-12-19 23:46:22','2014-01-05 20:03:57','iphone-4s-59',1,1,'São Francisco','ads/images/image_52b3a16e27b7d.jpeg',1,1),(60,10,1,1,NULL,'Gusmao vende rapido','vem qvem porra ta facil pa caramba',123,'RJ','Niterói','24360100','Rua General Rondon','29',1,'2014-01-02 21:10:05','2014-01-05 20:04:53','gusmao-vende-rapido-60',1,1,'São Francisco','ads/images/image_52c5f1cd820d8.jpeg',1,1),(61,9,1,3,10,'VAI QUE VAI','halowww whauah aehae aehae aehae hae aehae aeh',900,'RJ','Niterói','24360100','Rua General Rondon','29',1,'2014-01-05 20:18:28','2014-01-05 20:20:44','vai-que-vai-61',1,2,'São Francisco','ads/images/image_52c9da34dfcd1.jpeg',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'iPod',1),(2,'iPhone',1),(3,'iPad',1),(4,'MacBook',1),(5,'iMac',1),(6,'Acessorios',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
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
  CONSTRAINT `FK_C3C5952BCF186FB3` FOREIGN KEY (`declined_msg_id`) REFERENCES `declined_msgs` (`id`),
  CONSTRAINT `FK_C3C5952B4F34D596` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `declined_ads`
--

LOCK TABLES `declined_ads` WRITE;
/*!40000 ALTER TABLE `declined_ads` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `declined_msgs`
--

LOCK TABLES `declined_msgs` WRITE;
/*!40000 ALTER TABLE `declined_msgs` DISABLE KEYS */;
/*!40000 ALTER TABLE `declined_msgs` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (5,'bernardo','bernardo','bernardo@gmail.com','bernardo@gmail.com',1,'r24naritdqsoggwc4ko8ss848wg0sg0','Mko1jBLEbMWEL0lTZlhKSWOcg3PPTET/w6kaOR52afCLRHh0aJ/5L8X3DCEJ6YBCa6rQIsQ6OCUFMwQo5PesCw==','2013-12-03 12:23:03',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Bernardo',''),(6,'bernardao','bernardao','bernardo@gmail.com.br','bernardo@gmail.com.br',1,'enlyz40il4gs88w0owo44k4kgcwk8o0','fLOnvXzs5rLt4eTnD7t/75Fnh8E2CHKbKNb8TVpaFUGJdM30yTdjo/G8um7lgIxNLdUpNlFaGaUBxhHe8CvZlQ==','2013-12-03 17:03:25',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Agoravai',''),(7,'teste','teste','bernardo@aaa.com','bernardo@aaa.com',1,'l2r7j4jjplccgkskgg4gk4so4owko0k','88JBSK/RZUwyT00+4WWuGtZV6vGSQq0c81viwE3ICLo6FklRHmCnnKyYbMx775MZqaj84YntMFuDis41D3GxXg==','2013-12-03 17:04:06',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Joao',''),(8,'bernardooo','bernardooo','be@be.com','be@be.com',1,'b82a6flpznk0g8ossg4g04swcwkw4ko','KNwQVdX9g+SKx+Nxooq8fWbtrnicydRrgskNFZrgR4+UXnmwsKYwSvsA+E+Gsojm1l6dM03eVjDRnar4kfGA1A==','2013-12-15 14:43:40',0,0,NULL,'prxeChEK769XdjioYG7LH6tt8jC393ZFV2Gr-od25ic','2013-12-07 22:49:39','a:0:{}',0,NULL,'bernardo',''),(9,'bernardo123','bernardo123','bernardoniteroi@gmail.com','bernardoniteroi@gmail.com',1,'mdv0eaurhogwg4wcgoowg0cgc0o44g0','VN5GWvNSSOhOjaIiBNf5Qnv7UoYKPeYDMbnrrbiGH1mbGF/VPL2hX8nA7349wcdGJ/5zr/gQzns6sjhoMW16QQ==','2014-01-05 20:26:31',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'bernardo',''),(10,'gusmao','gusmao','bernardo.d.alves@gmail.com','bernardo.d.alves@gmail.com',1,'fvzzbclwd68sc44g4ok4cc888kccwwo','H9/eGhCUxf7HqWgzjVW/SkEGppFznysV7TVCMGD6LX/apMwdwaCUDNTnaacJlR46pEMh6cbzoIeCe3Su3LQOzQ==','2014-01-03 23:03:08',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL,'Gusmao',NULL);
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
INSERT INTO `session` VALUES ('3o8v8plhij1cmto236btldpu50','X3NmMl9hdHRyaWJ1dGVzfGE6MTp7czoxNDoiX3NlY3VyaXR5X21haW4iO3M6NTc0OiJDOjc0OiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXEF1dGhlbnRpY2F0aW9uXFRva2VuXFVzZXJuYW1lUGFzc3dvcmRUb2tlbiI6NDg2OnthOjM6e2k6MDtOO2k6MTtzOjQ6Im1haW4iO2k6MjtzOjQ0NjoiYTo0OntpOjA7QzozMToiaUxpc3RcQmFja2VuZEJ1bmRsZVxFbnRpdHlcVXNlciI6MjM1OnthOjk6e2k6MDtzOjg4OiJWTjVHV3ZOU1NPaE9qYUlpQk5mNVFudjdVb1lLUGVZRE1ibnJyYmlHSDFtYkdGL1ZQTDJoWDhuQTczNDl3Y2RHSi81enIvZ1F6bnM2c2pob01XMTZRUT09IjtpOjE7czozMToibWR2MGVhdXJob2d3ZzR3Y2dvb3dnMGNnYzBvNDRnMCI7aToyO3M6MTE6ImJlcm5hcmRvMTIzIjtpOjM7czoxMToiYmVybmFyZG8xMjMiO2k6NDtiOjA7aTo1O2I6MDtpOjY7YjowO2k6NztiOjE7aTo4O2k6OTt9fWk6MTtiOjE7aToyO2E6MTp7aTowO086NDE6IlN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlIjoxOntzOjQ3OiIAU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUAcm9sZSI7czo5OiJST0xFX1VTRVIiO319aTozO2E6MDp7fX0iO319Ijt9X3NmMl9mbGFzaGVzfGE6MDp7fV9zZjJfbWV0YXxhOjM6e3M6MToidSI7aToxMzg5MjcwMTQ3O3M6MToiYyI7aToxMzg4OTYwNzcwO3M6MToibCI7czoxOiIwIjt9',1389270147),('45qb4642os13g7o66pobgekr46','X3NmMl9hdHRyaWJ1dGVzfGE6MTp7czoyNjoiX3NlY3VyaXR5Lm1haW4udGFyZ2V0X3BhdGgiO3M6Mzc6Imh0dHA6Ly9pbGlzdC5kZXYvYXBwX2Rldi5waHAvYWNjb3VudC8iO31fc2YyX2ZsYXNoZXN8YTowOnt9X3NmMl9tZXRhfGE6Mzp7czoxOiJ1IjtpOjEzODg5NjA3ODQ7czoxOiJjIjtpOjEzODg5NjA3NzA7czoxOiJsIjtzOjE6IjAiO30=',1388960784),('8dvjdqc24uvcf7e3fjeech5b43','X3NmMl9hdHRyaWJ1dGVzfGE6MTp7czoyNjoiX3NlY3VyaXR5Lm1haW4udGFyZ2V0X3BhdGgiO3M6Mzc6Imh0dHA6Ly9pbGlzdC5kZXYvYXBwX2Rldi5waHAvYWNjb3VudC8iO31fc2YyX2ZsYXNoZXN8YTowOnt9X3NmMl9tZXRhfGE6Mzp7czoxOiJ1IjtpOjEzODg3OTczODQ7czoxOiJjIjtpOjEzODg3OTczODI7czoxOiJsIjtzOjE6IjAiO30=',1388797384),('bcjhig99ubik6cnt0fndffm9v5','X3NmMl9hdHRyaWJ1dGVzfGE6MTp7czozODoiZm9zX3VzZXJfc2VuZF9jb25maXJtYXRpb25fZW1haWwvZW1haWwiO3M6MjY6ImJlcm5hcmRvLmQuYWx2ZXNAZ21haWwuY29tIjt9X3NmMl9mbGFzaGVzfGE6MTp7czo3OiJzdWNjZXNzIjthOjE6e2k6MDtzOjM0OiJPIHVzdcOhcmlvIGZvaSBjcmlhZG8gY29tIHN1Y2Vzc28uIjt9fV9zZjJfbWV0YXxhOjM6e3M6MToidSI7aToxMzg4NzA0MDAwO3M6MToiYyI7aToxMzg4NzAzNzYzO3M6MToibCI7czoxOiIwIjt9',1388704004),('g3slitm8pnpuhure2vsqdl3n81','X3NmMl9hdHRyaWJ1dGVzfGE6MTp7czoxNDoiX3NlY3VyaXR5X21haW4iO3M6NTYzOiJDOjc0OiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXEF1dGhlbnRpY2F0aW9uXFRva2VuXFVzZXJuYW1lUGFzc3dvcmRUb2tlbiI6NDc1OnthOjM6e2k6MDtOO2k6MTtzOjQ6Im1haW4iO2k6MjtzOjQzNToiYTo0OntpOjA7QzozMToiaUxpc3RcQmFja2VuZEJ1bmRsZVxFbnRpdHlcVXNlciI6MjI0OnthOjk6e2k6MDtzOjg4OiJIOS9lR2hDVXhmN0hxV2d6alZXL1NrRUdwcEZ6bnlzVjdUVkNNR0Q2TFgvYXBNd2R3YUNVRE5UbmFhY0psUjQ2cEVNaDZjYnpvSWVDZTNTdTNMUU96UT09IjtpOjE7czozMToiZnZ6emJjbHdkNjhzYzQ0ZzRvazRjYzg4OGtjY3d3byI7aToyO3M6NjoiZ3VzbWFvIjtpOjM7czo2OiJndXNtYW8iO2k6NDtiOjA7aTo1O2I6MDtpOjY7YjowO2k6NztiOjE7aTo4O2k6MTA7fX1pOjE7YjoxO2k6MjthOjE6e2k6MDtPOjQxOiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZSI6MTp7czo0NzoiAFN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlAHJvbGUiO3M6OToiUk9MRV9VU0VSIjt9fWk6MzthOjA6e319Ijt9fSI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTM4ODgwMTA0NztzOjE6ImMiO2k6MTM4ODc5NzM4MjtzOjE6ImwiO3M6MToiMCI7fQ==',1388801047),('v016lfu3e68o4ki4jjhhspu4o7','X3NmMl9hdHRyaWJ1dGVzfGE6Mjp7czozODoiZm9zX3VzZXJfc2VuZF9jb25maXJtYXRpb25fZW1haWwvZW1haWwiO3M6MjY6ImJlcm5hcmRvLmQuYWx2ZXNAZ21haWwuY29tIjtzOjE0OiJfc2VjdXJpdHlfbWFpbiI7czo1NjM6IkM6NzQ6IlN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcQXV0aGVudGljYXRpb25cVG9rZW5cVXNlcm5hbWVQYXNzd29yZFRva2VuIjo0NzU6e2E6Mzp7aTowO047aToxO3M6NDoibWFpbiI7aToyO3M6NDM1OiJhOjQ6e2k6MDtDOjMxOiJpTGlzdFxCYWNrZW5kQnVuZGxlXEVudGl0eVxVc2VyIjoyMjQ6e2E6OTp7aTowO3M6ODg6Ikg5L2VHaENVeGY3SHFXZ3pqVlcvU2tFR3BwRnpueXNWN1RWQ01HRDZMWC9hcE13ZHdhQ1VETlRuYWFjSmxSNDZwRU1oNmNiem9JZUNlM1N1M0xRT3pRPT0iO2k6MTtzOjMxOiJmdnp6YmNsd2Q2OHNjNDRnNG9rNGNjODg4a2Njd3dvIjtpOjI7czo2OiJndXNtYW8iO2k6MztzOjY6Imd1c21hbyI7aTo0O2I6MDtpOjU7YjowO2k6NjtiOjA7aTo3O2I6MTtpOjg7aToxMDt9fWk6MTtiOjE7aToyO2E6MTp7aTowO086NDE6IlN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlIjoxOntzOjQ3OiIAU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUAcm9sZSI7czo5OiJST0xFX1VTRVIiO319aTozO2E6MDp7fX0iO319Ijt9X3NmMl9mbGFzaGVzfGE6MDp7fV9zZjJfbWV0YXxhOjM6e3M6MToidSI7aToxMzg4NzEwODUzO3M6MToiYyI7aToxMzg4NzAzNzYzO3M6MToibCI7czoxOiIwIjt9',1388710853);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,'16'),(2,'32'),(3,'64');
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
  CONSTRAINT `FK_723649C912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,'Classic',1,1),(2,'Mini',1,1),(3,'Shuffle',1,1),(4,'Nano',1,1),(5,'Touch',1,1),(6,'Outros',1,1),(7,'1a Geração',1,2),(8,'3G',1,2),(9,'3GS',1,2),(10,'4',1,2),(11,'4S',1,2),(12,'5',1,2),(13,'5S',1,2),(14,'5C',1,2),(15,'1',1,3),(16,'2',1,3),(17,'3',1,3),(18,'4',1,3),(19,'Mini',1,3);
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

-- Dump completed on 2014-01-09 10:38:00
