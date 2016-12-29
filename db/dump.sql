-- MySQL dump 10.13  Distrib 5.6.22, for osx10.8 (x86_64)
--
-- Host: localhost    Database: klevers
-- ------------------------------------------------------
-- Server version	5.6.22

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
-- Table structure for table `about_blocks`
--

DROP TABLE IF EXISTS `about_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `heading` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `body_text` text COLLATE utf8_danish_ci,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `video_url` varchar(512) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_blocks`
--

LOCK TABLES `about_blocks` WRITE;
/*!40000 ALTER TABLE `about_blocks` DISABLE KEYS */;
INSERT INTO `about_blocks` VALUES (1,'2016-06-17 14:48:11','2016-08-31 07:32:27',7,5,'1','5d55083bab517fbb02d36f2b32a509bd','jpeg','2127','1412','Cras Pharetra','Donec ullamcorper nulla non metus auctor fringilla. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus,\n\nnisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue. Sed posuere consectetur est at lobortis.',0,'https://player.vimeo.com/external/180742892.sd.mp4?s=2491cd1991a29f2e8743a2fcf95139041f7e39b1&profile_id=165');
INSERT INTO `about_blocks` VALUES (2,'2016-06-17 14:48:21','2016-08-31 07:32:22',6,1,'2','1043a4391695089fa260781790b6712d','jpeg','2500','2433',NULL,NULL,1,'https://player.vimeo.com/external/180742892.sd.mp4?s=2491cd1991a29f2e8743a2fcf95139041f7e39b1&profile_id=165');
INSERT INTO `about_blocks` VALUES (3,'2016-06-17 14:48:33','2016-06-20 06:23:58',4,0,NULL,NULL,NULL,NULL,NULL,'asdf','asdf',2,NULL);
INSERT INTO `about_blocks` VALUES (4,'2016-06-21 07:53:43','2016-06-21 08:09:53',4,2,'6','a7b74adb0f64ebcce5551ea26085c1f8','jpeg','1920','1200',NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `about_blocks` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `about_blocks_BeforeInsert`
				BEFORE INSERT
				ON `about_blocks`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `about_blocks_BeforeUpdate`
				BEFORE UPDATE
				ON `about_blocks`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `login` varchar(32) COLLATE utf8_danish_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_danish_ci NOT NULL DEFAULT '',
  `full_name` varchar(64) COLLATE utf8_danish_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_danish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES (1,'2010-10-31 07:31:19','2013-06-06 17:01:34',19,'alex','$1$9VceWPte$HmjiR.429nV1RH.HNGw.d.','Alex Ostapov','ostapov@gmail.com');
INSERT INTO `administrators` VALUES (2,'2010-10-31 07:31:19','2016-06-09 13:27:40',12,'izaika','$1$Tut510rV$egStZcr3v9vwIWliwruJw1','Igor Zaika','igor@modulez.no');
INSERT INTO `administrators` VALUES (3,'2010-10-31 07:31:19','2011-11-28 09:03:12',3,'sh','$1$EmDD20CR$th8Yv4dpcWHeREAFo4rmS.','Sigbjørn Hagaseth','sh@modulez.no');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `administrators_BeforeInsert` BEFORE INSERT ON `administrators` FOR EACH ROW SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `administrators_BeforeUpdate` BEFORE UPDATE ON `administrators` FOR EACH ROW SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `article_images`
--

DROP TABLE IF EXISTS `article_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `use_video` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `video_url` varchar(512) COLLATE utf8_danish_ci DEFAULT NULL,
  `embedded_video_link` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `article_images_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_images`
--

LOCK TABLES `article_images` WRITE;
/*!40000 ALTER TABLE `article_images` DISABLE KEYS */;
INSERT INTO `article_images` VALUES (1,'2016-07-07 12:33:54','2016-09-05 10:15:22',18,0,'1','c90bfb8261471bcf7e721dcd8ceb83e4','jpeg','1920','1200',6,1,NULL,'https://www.youtube.com/watch?v=ZqaPgwTV1Gc');
INSERT INTO `article_images` VALUES (2,'2016-07-07 12:34:06','2016-07-07 12:35:20',2,1,'2','c09831b0c04a8cf237991bf67e092208','jpeg','2560','1600',6,0,NULL,NULL);
INSERT INTO `article_images` VALUES (3,'2016-09-01 08:12:36',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `article_images` VALUES (4,'2016-09-01 08:12:37',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `article_images` VALUES (5,'2016-09-01 08:12:38',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `article_images` VALUES (9,'2016-09-06 08:10:45','2016-11-18 12:34:05',2,0,'fotolia_test-tube','628ca9b429b2dc8b8289481e5bb8a8a3','jpeg','3900','2600',8,1,NULL,'https://vimeo.com/180705110');
INSERT INTO `article_images` VALUES (10,'2016-11-18 13:21:12','2016-11-18 13:21:16',2,1,'1','e1261a158bed784952fdaca721aab9f8','jpeg','1440','738',8,1,NULL,'https://vimeo.com/180742892');
/*!40000 ALTER TABLE `article_images` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `article_images_BeforeInsert`
				BEFORE INSERT
				ON `article_images`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `article_images_BeforeUpdate`
				BEFORE UPDATE
				ON `article_images`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `heading` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `body_text` text COLLATE utf8_danish_ci,
  `public_date` date DEFAULT NULL,
  `is_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`),
  KEY `is_new` (`is_new`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'2016-06-08 08:30:25','2016-06-08 12:03:49',4,0,'1','6cc009c14730db4f2ab3c380043180e0','jpeg','2127','1412','Nullam id dolor id nibh','<p>Donec ullamcorper nulla non metus auctor fringilla. Donec ullamcorper nulla non metus auctor fringilla. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>\n<p>Nulla vitae elit libero, a pharetra augue. Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis consectetur purus sit amet fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>','2016-06-01',0);
INSERT INTO `articles` VALUES (2,'2016-06-08 08:31:10','2016-06-08 12:03:43',3,-1,'2','74cdd59be5e8cb86b3db50a4e7d197e6','jpeg','2500','2433','Aenean lacinia bibendum','<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>\n<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>\n<p>Nullam id dolor id nibh ultricies vehicula ut id elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>','2016-06-02',0);
INSERT INTO `articles` VALUES (3,'2016-06-08 08:39:13','2016-06-08 12:03:37',2,-2,'3','7357c44b496187902af28e38a7af3629','jpeg','1920','1200','Donec id elit non','<p>Cras mattis consectetur purus sit amet fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper. Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>','2016-06-03',0);
INSERT INTO `articles` VALUES (4,'2016-06-08 08:39:46','2016-06-08 12:03:31',3,-3,'4','17fe82c58a88e74170b43aa74011b9a2','jpeg','4967','3508','Nullam id dolor','<p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>\n<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor. Aenean lacinia bibendum nulla sed consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\n<p>Aenean lacinia bibendum nulla sed consectetur. Maecenas faucibus mollis interdum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>','2016-06-04',0);
INSERT INTO `articles` VALUES (5,'2016-06-08 08:40:37','2016-06-08 12:03:26',5,-4,NULL,NULL,NULL,'2400','1599','Cum sociis natoque','<p>Donec ullamcorper nulla non metus auctor fringilla. Donec id elit non mi porta gravida at eget metus.</p>\n<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur. Donec sed odio dui.</p>\n<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>\n<p>Sed posuere consectetur est at lobortis. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>','2016-06-05',0);
INSERT INTO `articles` VALUES (6,'2016-06-08 08:41:17','2016-08-29 14:08:21',6,-5,'6','0e52e3921e6efd534c0383991c123769','jpeg','1920','1200','Maecenfaucibus','<p>Vestibulum id ligula porta felis euismod semper. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Vestibulum id ligula porta felis euismod semper. Etiam porta sem malesuada magna mollis euismod.</p>\n<p>Maecenas faucibus mollis interdum. Donec id elit non mi porta gravida at eget metus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Curabitur blandit tempus porttitor. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</p>','2016-06-08',0);
INSERT INTO `articles` VALUES (8,'2016-09-06 08:09:10','2016-09-06 08:10:47',1,-6,NULL,NULL,NULL,NULL,NULL,'asdf','<p>asdf</p>','2016-09-07',0);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `articles_BeforeInsert`
				BEFORE INSERT
				ON `articles`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `articles_BeforeUpdate`
				BEFORE UPDATE
				ON `articles`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `articles_tags`
--

DROP TABLE IF EXISTS `articles_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_tags`
--

LOCK TABLES `articles_tags` WRITE;
/*!40000 ALTER TABLE `articles_tags` DISABLE KEYS */;
INSERT INTO `articles_tags` VALUES (24,5,18);
INSERT INTO `articles_tags` VALUES (25,5,21);
INSERT INTO `articles_tags` VALUES (26,4,19);
INSERT INTO `articles_tags` VALUES (27,4,20);
INSERT INTO `articles_tags` VALUES (28,2,17);
INSERT INTO `articles_tags` VALUES (29,2,18);
INSERT INTO `articles_tags` VALUES (30,2,12);
INSERT INTO `articles_tags` VALUES (31,1,13);
INSERT INTO `articles_tags` VALUES (38,6,22);
INSERT INTO `articles_tags` VALUES (39,6,21);
INSERT INTO `articles_tags` VALUES (41,7,23);
INSERT INTO `articles_tags` VALUES (42,7,24);
/*!40000 ALTER TABLE `articles_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `heading` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `description` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `url_title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_title` (`url_title`),
  KEY `ord` (`ord`),
  KEY `category_id` (`category_id`),
  KEY `is_new` (`is_new`,`category_id`),
  KEY `is_new_2` (`is_new`,`url_title`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (13,'2016-12-27 13:36:41','2016-12-27 14:03:28',4,0,'Средства защиты растений','Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam id dolor id nibh ultricies vehicula ut id elit. Cras mattis consectetur purus sit amet fermentum.','средства-защиты-растений',NULL,0);
INSERT INTO `categories` VALUES (14,'2016-12-27 13:38:22','2016-12-27 14:10:08',3,1,'Семена и посевной материал','Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.','семена-и-посевной-материал',NULL,0);
INSERT INTO `categories` VALUES (15,'2016-12-27 13:39:29','2016-12-27 14:11:08',3,2,'Газонные травы','Donec id elit non mi porta gravida at eget metus. Curabitur blandit tempus porttitor. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Praesent commodo cursus magna, vel scelerisque nisl cons','газонные-травы',NULL,0);
INSERT INTO `categories` VALUES (16,'2016-12-27 13:39:52','2016-12-27 14:11:52',3,3,'Техника и садовый инструмент','Vestibulum id ligula porta felis euismod semper. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere vel','техника-и-садовый-инструмент',NULL,0);
INSERT INTO `categories` VALUES (17,'2016-12-27 13:40:19','2016-12-27 14:12:47',3,4,'Для дачи и отдыха','Donec id elit non mi porta gravida at eget metus. Donec id elit non mi porta gravida at eget metus. Donec sed odio dui. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed conse','для-дачи-и-отдыха',NULL,0);
INSERT INTO `categories` VALUES (19,'2016-12-27 14:01:02',NULL,0,0,'Гербициды','Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas sed diam eget risus varius blandit sit amet non magna. Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Maecenas fa','гербициды',13,0);
INSERT INTO `categories` VALUES (20,'2016-12-27 14:01:41',NULL,0,1,'Инсектициды','Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur blandit tempus porttitor. Donec ullamcorper nulla non metus auctor fringil','инсектициды',13,0);
INSERT INTO `categories` VALUES (21,'2016-12-27 14:02:07',NULL,0,2,'Фунгициды','Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit. Etiam porta sem malesuada magna mollis euismod. Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit temp','фунгициды',13,0);
INSERT INTO `categories` VALUES (22,'2016-12-27 14:02:24',NULL,0,3,'Протравители','Donec sed odio dui. Sed posuere consectetur est at lobortis. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. V','протравители',13,0);
INSERT INTO `categories` VALUES (23,'2016-12-27 14:02:50',NULL,0,4,'Родентициды','Maecenas faucibus mollis interdum. Aenean lacinia bibendum nulla sed consectetur. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor.','родентициды',13,0);
INSERT INTO `categories` VALUES (24,'2016-12-27 14:03:11',NULL,0,5,'Прилипатели','Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.','прилипатели',13,0);
INSERT INTO `categories` VALUES (25,'2016-12-27 14:03:21',NULL,0,6,'Биопрепараты','Donec sed odio dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur blandit tempus porttitor. Maecenas sed diam eget risus varius blandit sit amet non magna. Duis mollis, est non commodo luctus, nisi erat por','биопрепараты',13,0);
INSERT INTO `categories` VALUES (26,'2016-12-27 14:06:12','2016-12-27 14:07:15',2,5,'Саженцы деревьев и растений','Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam quis risus eget urna mollis ornare vel eu leo. Nulla vitae elit libero, a pharetra augue. Maecenas faucibus mollis interdum.','саженцы-деревьев-и-растений',NULL,0);
INSERT INTO `categories` VALUES (27,'2016-12-27 14:06:56',NULL,0,0,'Яблоня','Sed posuere consectetur est at lobortis. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Morbi leo risus, porta ac consectetur ac','яблоня',26,0);
INSERT INTO `categories` VALUES (28,'2016-12-27 14:07:08',NULL,0,1,'Груша','Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Etiam porta sem malesuada magna mollis euismod. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas faucibus mollis interdum. Vivamus sagittis lacus vel augue laoreet rutrum','груша',26,0);
INSERT INTO `categories` VALUES (30,'2016-12-27 14:09:46',NULL,0,0,'Баклажан','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vivamus sagittis lacus vel augue laoreet rutr','баклажан',14,0);
INSERT INTO `categories` VALUES (31,'2016-12-27 14:09:55',NULL,0,1,'Горох','Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui. Nullam id dolor id nibh ultricies vehicula ut id elit. Maecenas se','горох',14,0);
INSERT INTO `categories` VALUES (32,'2016-12-27 14:10:04',NULL,0,2,'Дыня','Nullam id dolor id nibh ultricies vehicula ut id elit. Curabitur blandit tempus porttitor. Sed posuere consectetur est at lobortis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.','дыня',14,0);
INSERT INTO `categories` VALUES (34,'2016-12-27 14:11:18',NULL,0,0,'Секаторы','Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec ullamcorper nulla non metus auctor fringilla. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum mass','секаторы',16,0);
INSERT INTO `categories` VALUES (35,'2016-12-27 14:11:24','2016-12-27 14:11:31',1,1,'Системы полива','Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam quis risus eget urna mollis ornare vel eu leo. Sed posuere consectetur est at lobortis. Maecenas faucibus mollis interdum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget l','системы-полива',16,0);
INSERT INTO `categories` VALUES (36,'2016-12-27 14:11:47',NULL,0,2,'Агроволокно','Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.','агроволокно',16,0);
INSERT INTO `categories` VALUES (37,'2016-12-27 14:12:22',NULL,0,0,'Защита от грызунов','Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean','защита-от-грызунов',17,0);
INSERT INTO `categories` VALUES (38,'2016-12-27 14:12:33',NULL,0,1,'Защита от кротов','Etiam porta sem malesuada magna mollis euismod. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas sed diam eget risus varius blandit sit amet non magna. Etiam porta sem malesuada magna mollis euismod. Integer posuere erat a ante venena','защита-от-кротов',17,0);
INSERT INTO `categories` VALUES (39,'2016-12-27 14:12:46',NULL,0,2,'Защита от насекомых','Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur blandit tempus porttitor. Cum sociis natoq','защита-от-насекомых',17,0);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `categories_BeforeInsert`
				BEFORE INSERT
				ON `categories`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `categories_BeforeUpdate`
				BEFORE UPDATE
				ON `categories`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `categories_projects`
--

DROP TABLE IF EXISTS `categories_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `category_id` (`category_id`,`is_featured`),
  CONSTRAINT `categories_projects_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `categories_projects_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_projects`
--

LOCK TABLES `categories_projects` WRITE;
/*!40000 ALTER TABLE `categories_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_projects` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `categories_projects_BeforeInsert`
				BEFORE INSERT
				ON `categories_projects`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `categories_projects_BeforeUpdate`
				BEFORE UPDATE
				ON `categories_projects`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `cp_items`
--

DROP TABLE IF EXISTS `cp_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cp_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `heading` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `short_text` varchar(700) COLLATE utf8_danish_ci DEFAULT '',
  `num` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cp_items`
--

LOCK TABLES `cp_items` WRITE;
/*!40000 ALTER TABLE `cp_items` DISABLE KEYS */;
INSERT INTO `cp_items` VALUES (2,'2016-06-20 07:13:48',NULL,0,0,'STEG ÉN','Lorem ipsum dolor sit amet, duo ea duis novum, volutpat erroribus  Maiestatis pero cipitur eum ut. E nominavi scribentur est, eos ea tollit senserit aliquando.','01');
INSERT INTO `cp_items` VALUES (3,'2016-06-20 07:14:09','2016-06-20 07:14:14',1,1,'STEG TO','Eius offendit concludaturque id tetuer, et sea denique perseque ris. Ex usu probatus indoctum mediocritatem, per error possi mconcm etu larone baro','02');
INSERT INTO `cp_items` VALUES (4,'2016-06-20 07:14:47',NULL,0,2,'STEG TRE','Maiestatis percipitur eum late ut. Ea nominavi scribentur est, eos offendit conclud turque id eum, cum iuvaret consectetuer, et sea denique perseq.','03');
INSERT INTO `cp_items` VALUES (5,'2016-06-20 07:15:32',NULL,0,3,'STEG FIRE','Ea nominavi scribentur est, eos ea tollit senserit aliquando. Eius \nturque id eum, cumelo ene iuna varet conse tetuer, et sea  eda denique eto persequeris.','04');
INSERT INTO `cp_items` VALUES (6,'2016-06-20 07:15:54',NULL,0,4,'STEG FEM','Eius offendit concludaturque id eum, cum ne iuvaret tetuer, et sean denique persequeris. Ex usu probatus indoctum mediocri al tatem, per error possim conc.','05');
INSERT INTO `cp_items` VALUES (7,'2016-06-30 09:01:08',NULL,0,5,'asd','asdf','asdf');
/*!40000 ALTER TABLE `cp_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cp_items_BeforeInsert`
				BEFORE INSERT
				ON `cp_items`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cp_items_BeforeUpdate`
				BEFORE UPDATE
				ON `cp_items`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `info` varchar(700) COLLATE utf8_danish_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'2016-06-20 07:32:30','2016-06-20 07:32:30',1,0,'1','f6b72e41ad9d362cd2ed3255faf4ffe9','jpeg','400','500','Peter Aasen','<p>Siv.ark,<br>MNAL,<br>Partner,<br>Daglig leder</p>');
INSERT INTO `employees` VALUES (2,'2016-06-20 07:35:38','2016-06-20 07:35:41',2,1,'1','6c10c6bbc0353423e6e112c4ae1a3df8','jpeg','400','500','Herman Fuglu','<p>Siv.ark,<br>MNAL,<br>Partner</p>');
INSERT INTO `employees` VALUES (3,'2016-06-20 07:36:12','2016-06-20 07:36:15',2,2,'2','126c15c60360e2b738d308676a6028de','jpeg','400','400','Soléy Karlsdottir','<p>Siv.ark,<br>MNAL</p>');
INSERT INTO `employees` VALUES (4,'2016-06-20 07:36:34','2016-06-20 07:36:38',2,3,'2','037f4ac144fde6c7b2554ed71600cd80','jpeg','400','400','Mari Hansæl','<p>Siv.ark,<br>MNAL</p>');
INSERT INTO `employees` VALUES (5,'2016-06-20 07:37:05','2016-06-20 07:37:09',2,4,'1','0d174ebe6eac6d71c4e3e015d98c47e4','jpeg','400','500','Øyvind Pharo Odden','<p>Siv.ark,<br>MNAL</p>');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `employees_BeforeInsert`
				BEFORE INSERT
				ON `employees`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `employees_BeforeUpdate`
				BEFORE UPDATE
				ON `employees`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `pdf_filename` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `pdf_filesize` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `pdf_uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `pdf_title` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,'2016-11-18 13:47:47','2016-11-18 14:37:10',9,0,'fotolia_test-tube.jpeg','6979534','218055097cbbbe27d8d509964a1d897e',NULL);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `files_BeforeInsert`
				BEFORE INSERT
				ON `files`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `files_BeforeUpdate`
				BEFORE UPDATE
				ON `files`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `homeprojects`
--

DROP TABLE IF EXISTS `homeprojects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homeprojects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `homeprojects_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homeprojects`
--

LOCK TABLES `homeprojects` WRITE;
/*!40000 ALTER TABLE `homeprojects` DISABLE KEYS */;
INSERT INTO `homeprojects` VALUES (1,'2016-07-08 11:24:20','2016-07-08 12:04:20',4,0,1099);
INSERT INTO `homeprojects` VALUES (2,'2016-07-08 11:27:43','2016-07-08 11:39:03',4,-1,1123);
INSERT INTO `homeprojects` VALUES (3,'2016-07-08 11:27:46','2016-07-08 12:04:20',6,1,1116);
/*!40000 ALTER TABLE `homeprojects` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `homeprojects_BeforeInsert`
				BEFORE INSERT
				ON `homeprojects`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `homeprojects_BeforeUpdate`
				BEFORE UPDATE
				ON `homeprojects`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `homeslides`
--

DROP TABLE IF EXISTS `homeslides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homeslides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homeslides`
--

LOCK TABLES `homeslides` WRITE;
/*!40000 ALTER TABLE `homeslides` DISABLE KEYS */;
INSERT INTO `homeslides` VALUES (6,'2016-12-27 07:35:06','2016-12-27 09:33:14',3,-3,'1','af5629a4dec04093e191270916ae0e31','jpeg','1920','1200');
INSERT INTO `homeslides` VALUES (7,'2016-12-27 07:35:14','2016-12-27 09:33:14',2,-1,'2','3a014942940db77cd75742b4b343b5dd','jpeg','2560','1600');
INSERT INTO `homeslides` VALUES (8,'2016-12-27 07:35:26','2016-12-27 09:33:14',2,-2,'3','bd993e9921e1131fef606fcd99a03494','png','1920','1200');
/*!40000 ALTER TABLE `homeslides` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `homeslides_BeforeInsert`
				BEFORE INSERT
				ON `homeslides`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `homeslides_BeforeUpdate`
				BEFORE UPDATE
				ON `homeslides`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=2352 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keywords`
--

LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
INSERT INTO `keywords` VALUES (2345,'2016-07-05 10:49:47',NULL,0,'nuno');
INSERT INTO `keywords` VALUES (2346,'2016-07-05 10:49:47',NULL,0,'architekt');
INSERT INTO `keywords` VALUES (2347,'2016-07-05 10:49:47',NULL,0,'projects keywords');
INSERT INTO `keywords` VALUES (2348,'2016-07-05 10:49:47',NULL,0,'about keywords');
INSERT INTO `keywords` VALUES (2349,'2016-07-05 10:49:47',NULL,0,'blog keywords');
INSERT INTO `keywords` VALUES (2350,'2016-07-05 10:49:47',NULL,0,'contact keywords');
INSERT INTO `keywords` VALUES (2351,'2016-07-05 10:49:47',NULL,0,'search keywords');
/*!40000 ALTER TABLE `keywords` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `keywords_BeforeInsert` BEFORE INSERT ON `keywords` FOR EACH ROW SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `keywords_BeforeUpdate` BEFORE UPDATE ON `keywords` FOR EACH ROW SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `message_templates`
--

DROP TABLE IF EXISTS `message_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `str_id` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  `group_title` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `note` text COLLATE utf8_danish_ci,
  `is_from_required` tinyint(4) DEFAULT '0',
  `from_name` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  `from_address` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  `is_to_required` tinyint(4) DEFAULT '0',
  `to_name` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  `to_address` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  `cc_addresses` text COLLATE utf8_danish_ci,
  `subject` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `body` mediumtext COLLATE utf8_danish_ci,
  `macro_description` text COLLATE utf8_danish_ci,
  PRIMARY KEY (`id`),
  KEY `str_id` (`str_id`),
  KEY `group_title` (`group_title`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_templates`
--

LOCK TABLES `message_templates` WRITE;
/*!40000 ALTER TABLE `message_templates` DISABLE KEYS */;
INSERT INTO `message_templates` VALUES (1,'2011-06-08 15:00:00','2015-05-18 09:16:00',17,'REMIND_ADMIN_PASSWORD','System messages','Remind admin password email','This email is sent to administrator on \"forgot my password\" request',1,'Brandpeople booking admin panel','noreply@nodomain.no',0,'','',NULL,'Brandpeople booking admin password reminder','Hei!\n\nHer er påloggingsinformasjonen til din administratorkonto i Brandpeople booking\n\nbrukernavn: \"<%login%>\"\npassord: \"<%password%>\"\n\nHa en fortsatt fin dag!\n\nMed vennlig hilsen\nBrandpeople booking Support','The following macros can be used in the email body\n<%login%> - user login\n<%password%> - user password');
/*!40000 ALTER TABLE `message_templates` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `message_templates_BeforeInsert` BEFORE INSERT ON `message_templates` FOR EACH ROW SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `message_templates_BeforeUpdate` BEFORE UPDATE ON `message_templates` FOR EACH ROW SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `project_blocks`
--

DROP TABLE IF EXISTS `project_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `size` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `side` tinyint(1) unsigned DEFAULT '0',
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `body_text` text COLLATE utf8_danish_ci,
  `use_in_pdf` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `video_url` varchar(512) COLLATE utf8_danish_ci DEFAULT NULL,
  `embedded_video_link` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_blocks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_blocks`
--

LOCK TABLES `project_blocks` WRITE;
/*!40000 ALTER TABLE `project_blocks` DISABLE KEYS */;
INSERT INTO `project_blocks` VALUES (1,'2016-06-03 10:58:24','2016-08-31 12:30:28',23,2,1099,0,0,0,'1','bd6d7025ef5667badb6aad0f9dd02935','jpeg','1920','1200','<p>INTENSJON hello<br>Det er lagt vekt på å utvikle et bærekraftig miljøprosjekt som tar vare på og reflekterer den jomfruelige beliggenheten oppe på Valdresflya.</p>\n<p>хуй</p>\n<p>SITUASJON<br>Utforming av en ”skyss-stasjon” med kafeteria, overnatting og offentlig tilgjengelig rasteplass med toalett-tilbud og parkering for turgåere.</p>\n<p>*split*</p>\n<p>UTFORMING<br>Bygningsutrykket er basert på et sterkt formalt grepmed en klar dentitet som anonserer og eksponerer seg i landskapet. Takets bue symboliserer landskapet og de åpne fasadene mot øst og vest gir de besøkende nærkontakt med høyfjellet.</p>\n<p>MATERIALBRUK<br>Materialbruken framhever byggets skulpturelle form som vil stå i kontrast til, og samspille med det naturgitte barske og røffe landskapet.</p>',1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (3,'2016-06-03 11:15:54','2016-06-09 14:39:51',14,3,1099,2,0,1,'1','12358789af8b472a7797675985822cd2','jpeg','2127','1412',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (4,'2016-06-03 11:16:13','2016-07-08 14:25:44',21,4,1099,0,0,1,NULL,NULL,NULL,NULL,NULL,'<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean lacinia bibendum nulla sed consectetur. Maecenas faucibus mollis interdum.</p>\n<p>*split*</p>\n<p>Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo.</p>',1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (5,'2016-06-03 11:16:40','2016-06-09 14:40:37',21,5,1099,2,1,0,'2','08bdda0d67051abadc0be93886915aca','jpeg','1920','1200',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (6,'2016-06-03 11:16:58','2016-06-09 14:40:42',20,8,1099,2,1,0,'4','a851b1f719803814d51ad72587123e1b','jpeg','4967','3508',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (7,'2016-06-03 14:41:27','2016-06-09 14:40:59',12,9,1099,2,0,0,'2','2dc5223786e1f63df3db798d60c18413','jpeg','2500','2433',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (8,'2016-06-03 14:41:41','2016-06-09 14:41:05',23,10,1099,1,0,0,NULL,NULL,NULL,NULL,NULL,'<p>Takets bue symboliserer landskapet, og de åpne fasadene mot øst og vest gir nærkontakt med høyfjellet.</p>',1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (9,'2016-06-03 14:43:02','2016-06-15 12:23:36',26,11,1099,3,0,0,NULL,NULL,NULL,NULL,NULL,'<p>Areal BTA: 2500 m2<br>Framdrift: Regulering 2008<br>Byggherre: Grønolen/ Leithe Gruppen/ Statens<br>Vegvesen<br>Turistvegprosjekt<br>Publisert: Dagens Næringsliv D2 Magasinet 16.05 2008<br>Byggeindustrien 04.07 2008/ Arkitektnytt 20.08 2008</p>',1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (10,'2016-06-03 14:43:46','2016-09-04 08:10:15',22,15,1099,4,0,1,'1','563ad04dd9974dcd187a4e5d5b7d4e74','jpeg','2127','1412',NULL,1,'https://player.vimeo.com/external/167247397.sd.mp4?s=5f4999afec665deed719bdf80c5826de2f1e966c&profile_id=165','https://www.youtube.com/watch?v=XQv4GCte3XE');
INSERT INTO `project_blocks` VALUES (11,'2016-06-03 14:43:55','2016-09-04 07:37:52',39,13,1099,4,0,1,'546','fca242332bee2576f2e58a96409c0547','jpeg','1920','1200',NULL,1,'https://player.vimeo.com/external/167247397.sd.mp4?s=5f4999afec665deed719bdf80c5826de2f1e966c&profile_id=165','https://vimeo.com/181058967');
INSERT INTO `project_blocks` VALUES (12,'2016-06-03 14:44:09','2016-09-04 07:23:15',26,25,1099,2,0,1,'4','3b3eabc5761c6f04d4636d2e076bdfb0','jpeg','4967','3508',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (16,'2016-06-10 07:23:58','2016-06-10 13:27:47',65,46,1098,0,0,0,NULL,NULL,NULL,NULL,NULL,'<p>INTENSJON<br>Det er lagt vekt på å utvikle et bærekraftig miljøprosjekt som tar vare på og reflekterer den jomfruelige beliggenheten oppe på Valdresflya.</p>\n<p>SITUASJON<br>Utforming av en ”skyss-stasjon” med kafeteria, overnatting og offentlig tilgjengelig rasteplass med toalett-tilbud og parkering for turgåere.</p>\n<p>UTFORMING<br>Bygningsutrykket er basert på et sterkt formalt grepmed en klar dentitet som anonserer og eksponerer seg i landskapet. Takets bue symboliserer landskapet og de åpne fasadene mot øst og vest gir de besøkende nærkontakt med høyfjellet.</p>\n<p>MATERIALBRUK<br>Materialbruken framhever byggets skulpturelle form som vil stå i kontrast til, og samspille med det naturgitte barske og røffe landskapet.</p>',1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (17,'2016-06-10 07:55:55','2016-06-10 13:27:55',70,47,1098,2,0,1,'1','f6d0dd18b4e6c5ef02c7fcfcad6e6277','jpeg','2127','1412',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (18,'2016-06-10 07:56:07','2016-06-10 13:27:55',109,56,1098,1,0,1,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (19,'2016-06-10 07:57:28','2016-06-10 13:27:55',118,57,1098,2,1,NULL,'2','7a4d855a750720744cfeb6d53c76b4fb','jpeg','2500','2433',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (20,'2016-06-10 07:58:24','2016-06-10 13:27:55',108,111,1098,2,1,1,'3','bbcf45a6d46cf027bb0dbab7e89f6710','jpeg','1920','1200',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (21,'2016-06-10 07:58:59','2016-06-10 13:27:55',108,112,1098,2,0,0,'4','b24feee0604caf3fc1cbbb961f15051e','jpeg','4967','3508',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (22,'2016-06-10 07:59:19','2016-06-10 13:27:55',109,114,1098,2,0,1,'5','20c136c16a9cc9368dd73cbfa9f6776a','jpeg','2400','1599',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (23,'2016-06-10 07:59:37','2016-06-10 13:27:55',108,115,1098,1,0,1,NULL,NULL,NULL,NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (26,'2016-06-15 12:23:15','2016-06-15 12:23:41',3,12,1099,3,0,0,NULL,NULL,NULL,NULL,NULL,'<p>Landskapsarkitekt: Multiconsult avd 13.3 v/ Bjarne Aasen<br>RIV: Multiconsult AS<br>Klima: Asplan Viak AS</p>',0,NULL,NULL);
INSERT INTO `project_blocks` VALUES (38,'2016-06-23 06:39:27',NULL,0,0,1137,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (39,'2016-06-23 06:39:27',NULL,0,1,1137,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (40,'2016-06-23 06:39:27','2016-06-23 07:02:59',6,2,1137,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (41,'2016-06-23 06:39:27','2016-06-23 07:02:59',2,5,1137,2,1,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (42,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,8,1137,2,1,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (43,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,9,1137,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (44,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,10,1137,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (45,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,11,1137,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (46,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,12,1137,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (47,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,13,1137,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (48,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,14,1137,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (49,'2016-06-23 06:39:27','2016-06-23 07:02:59',4,15,1137,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (86,'2016-07-07 12:34:06',NULL,0,NULL,NULL,0,0,0,'2','1acdcd531e7b7c6113fd1db67ba8e026','jpeg','2560','1600',NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (111,'2016-07-15 11:25:32',NULL,0,0,1143,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (112,'2016-07-15 11:25:32',NULL,0,1,1143,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (113,'2016-07-15 11:25:32',NULL,0,2,1143,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (114,'2016-07-15 11:25:32',NULL,0,3,1143,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (115,'2016-07-15 11:25:32',NULL,0,4,1143,2,1,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (116,'2016-07-15 11:25:32',NULL,0,5,1143,2,1,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (117,'2016-07-15 11:25:32',NULL,0,6,1143,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (118,'2016-07-15 11:25:32',NULL,0,7,1143,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (119,'2016-07-15 11:25:32',NULL,0,8,1143,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `project_blocks` VALUES (120,'2016-07-15 11:25:32',NULL,0,9,1143,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (121,'2016-07-15 11:25:32',NULL,0,10,1143,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
INSERT INTO `project_blocks` VALUES (122,'2016-07-15 11:25:32',NULL,0,11,1143,2,0,1,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `project_blocks` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project_blocks_BeforeInsert`
				BEFORE INSERT
				ON `project_blocks`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `project_blocks_BeforeUpdate`
				BEFORE UPDATE
				ON `project_blocks`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `ord` int(11) DEFAULT NULL,
  `is_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `heading` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `name` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `location` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `address` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `ingress` varchar(512) COLLATE utf8_danish_ci DEFAULT NULL,
  `url_title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `seo_title` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `seo_description` varchar(150) COLLATE utf8_danish_ci DEFAULT NULL,
  `is_online` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `preview_title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `preview_uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `preview_ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `preview_width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `preview_height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `use_video` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `video_url` varchar(512) COLLATE utf8_danish_ci DEFAULT NULL,
  `embedded_video_link` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_title` (`url_title`),
  KEY `ord` (`ord`),
  KEY `is_new` (`is_new`),
  KEY `is_new_2` (`is_new`,`is_online`),
  KEY `is_new_3` (`is_new`,`is_online`,`url_title`)
) ENGINE=InnoDB AUTO_INCREMENT=1144 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1090,NULL,'2016-06-15 11:25:05',1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1094,'2016-06-03 07:32:10','2016-06-15 13:48:29',14,3,0,'1','dec4bb4373dfde674558d5161e49c5b5','jpeg','2127','1412','Nullam quis risus eget urna mollis ornare vel eu leo.','Euismod Pharetra','Riksveg 51, Valdresflya turistveg',NULL,NULL,'nullam-quis-risus-eget-urna-mollis-ornare-vel-eu-leo','Nullam quis risus eget urna mollis ornare vel eu leo.','Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec id elit non mi porta gravida at eget metus.',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1095,'2016-06-03 07:32:33','2016-07-15 11:12:00',16,2,0,'2','c18b65eee14d4b13f3b150844ff9b1e0','jpeg','2500','2433','Nulla vitae elit libero.','Condimentum Fusce','Riksveg 51, Valdresflya turistveg',NULL,NULL,'nulla-vitae-elit-libero-a-pharetra-augue','Nulla vitae elit libero, a pharetra augue.','Aenean lacinia bibendum nulla sed consectetur. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Sed posuere consectetur est at lobortis.',0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1096,'2016-06-03 07:32:52','2016-06-15 13:48:29',12,1,0,'3','529f098dbd60c23942d5bdefa0169057','jpeg','1920','1200','Cras mattis consectetur.','Justo Fringilla','Riksveg 51, Valdresflya turistveg',NULL,NULL,'cras-mattis-consectetur-purus-sit-amet-fermentum','Cras mattis consectetur purus sit amet fermentum.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed posuere consectetur est at lobortis. Vestibulum id ligula porta felis euismod semper. Cum',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1097,'2016-06-03 07:33:09','2016-07-15 11:11:55',15,0,0,'4','72183838200fd93dc39a5e1a515e86e0','jpeg','4967','3508','Vestibulum id euismod semper.','Ornare Fermentum','Riksveg 51, Valdresflya turistveg',NULL,NULL,'vestibulum-id-ligula-porta-felis-euismod-semper','Vestibulum id ligula porta felis euismod semper.','Nullam quis risus eget urna mollis ornare vel eu leo. Donec sed odio dui. Maecenas faucibus mollis interdum. Cum sociis natoque penatibus et magnis di',0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1098,'2016-06-03 07:33:25','2016-06-15 13:48:29',16,-2,0,'5','f42289cc5cdbc0a6c7dc3c64fb125ae6','jpeg','2400','1599','Donec id elit non eget metus.','Ipsum Bibendum','Riksveg 51, Valdresflya turistveg',NULL,NULL,'donec-id-elit-non-mi-porta-gravida-at-eget-metus','Donec id elit non mi porta gravida at eget metus.','Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Praesent c',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1099,'2016-06-03 07:33:41','2016-09-04 08:41:32',69,-30,0,'6','f4c0185c6f1065265313130ff5f9d793','jpeg','1920','1200','Med utsikt\ntil månen','Amet Mollis',';adsfj','sadhflksadhf','Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean lacinia bibendum nulla sed consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit.','aenean-eu-leo-quam-pellentesque-ornare-sem-lacinia-quam-venenatis-vestibulum','Med utsikt til månen','Nulla vitae elit libero, a pharetra augue. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus sagittis lacu',1,'6','b322aa0897d8dea6553aba93021f8e7c','jpeg','1920','1200',1,'https://player.vimeo.com/external/167247397.sd.mp4?s=5f4999afec665deed719bdf80c5826de2f1e966c&profile_id=165','https://www.youtube.com/watch?v=KJoPIgg17U4');
INSERT INTO `projects` VALUES (1101,'2016-06-15 12:50:42','2016-06-15 13:48:29',5,-5,0,'1','454ef1ec3659ff21d9243d4b2ff4b7b9','jpeg','2127','1412','Donec sed odio dui.','Donec sed odio dui.','Donec sed odio dui.',NULL,NULL,'donec-sed-odio-dui','Donec sed odio dui.','Donec sed odio dui.',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1102,'2016-06-15 12:51:25','2016-06-15 13:48:29',5,-6,0,'2','751cf8688eb1cb4cadd52007d23a736c','jpeg','2500','2433','Donec ullamcorper nulla non metus auctor fringilla.','Donec ullamcorper nulla non metus auctor fringilla.','Donec ullamcorper nulla non metus auctor fringilla.',NULL,NULL,'donec-ullamcorper-nulla-non-metus-auctor-fringilla','Donec ullamcorper nulla non metus auctor fringilla.','Donec ullamcorper nulla non metus auctor fringilla.',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1103,'2016-06-15 12:51:42','2016-06-15 13:48:29',5,-7,0,'3','308ffbe034f787adcf3d9f45f1a2b31f','jpeg','1920','1200','Nullam id dolor id nibh ultricies vehicula ut id elit.','Nullam id dolor id nibh ultricies vehicula ut id elit.','Nullam id dolor id nibh ultricies vehicula ut id elit.',NULL,NULL,'nullam-id-dolor-id-nibh-ultricies-vehicula-ut-id-elit','Nullam id dolor id nibh ultricies vehicula ut id elit.','Nullam id dolor id nibh ultricies vehicula ut id elit.',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1104,'2016-06-15 12:52:04','2016-06-15 13:48:29',5,-8,0,'4','2b865bc3cf25a52e6b23ec4218a2f8fb','jpeg','4967','3508','Inceptos Vehicula','Inceptos Vehicula','Inceptos Vehicula',NULL,NULL,'inceptos-vehicula','Inceptos Vehicula','Inceptos Vehicula',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1105,'2016-06-15 12:52:40','2016-06-15 13:48:29',5,-9,0,'6','a5e03c2397fa21e5919d84ca53ff40fd','jpeg','1920','1200','Tellus Malesuada','Tellus Malesuada','Tellus Malesuada',NULL,NULL,'tellus-malesuada','Tellus Malesuada','Tellus Malesuada',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1106,'2016-06-15 12:55:59','2016-06-15 13:48:29',5,-10,0,'1','209c40d77930ed7e74de5b2e57443d43','jpeg','2127','1412','Euismod Ipsum','Euismod Ipsum','Euismod Ipsum',NULL,NULL,'euismod-ipsum','Euismod Ipsum','Euismod Ipsum',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1107,'2016-06-15 12:56:16','2016-08-31 14:48:00',6,-11,0,'2','b7d1043727420d4c45d8c7b12ab11417','jpeg','2500','2433','Ullamcorper Adipiscing Fermentum','Ullamcorper Adipiscing Fermentum','Ullamcorper Adipiscing Fermentum',NULL,NULL,'ullamcorper-adipiscing-fermentum','Ullamcorper Adipiscing Fermentum','Ullamcorper Adipiscing Fermentum',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1108,'2016-06-15 12:56:34','2016-06-15 13:48:29',5,-12,0,'3','abfe6cf9ffcc39056a3da00059a5469c','jpeg','1920','1200','Etiam Ultricies Quam','Etiam Ultricies Quam','Etiam Ultricies Quam',NULL,NULL,'etiam-ultricies-quam','Etiam Ultricies Quam','Etiam Ultricies Quam',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1109,'2016-06-15 12:56:54','2016-06-15 13:48:29',5,-13,0,'4','847c439cc459d866bc24b8c2179d3074','jpeg','4967','3508','Nulla vitae elit libero, a pharetra augue.','Nulla vitae elit libero, a pharetra augue.','Nulla vitae elit libero, a pharetra augue.',NULL,NULL,'nulla-vitae-elit-libero-a-pharetra-augue0','Nulla vitae elit libero, a pharetra augue.','Nulla vitae elit libero, a pharetra augue.',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1111,'2016-06-15 12:58:05','2016-06-15 13:48:29',5,-15,0,'5','ba7286b3ff7e3716c39339b09bf9a4af','jpeg','2400','1599','Nulla vitae elit libero, a pharetra augue.','Bibendum Inceptos','Bibendum Inceptos',NULL,NULL,'nulla-vitae-elit-libero-a-pharetra-augue1','Nulla vitae elit libero, a pharetra augue.','Bibendum Inceptos',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1112,'2016-06-15 13:01:41','2016-06-15 13:48:29',5,-16,0,'6','8cbf2b609c0d57a39323dad6a6a66e35','jpeg','1920','1200','Aenean lacinia bibendum nulla sed consectetur.','Aenean lacinia bibendum nulla sed consectetur.','Aenean lacinia bibendum nulla sed consectetur.',NULL,NULL,'aenean-lacinia-bibendum-nulla-sed-consectetur','Aenean lacinia bibendum nulla sed consectetur.','Aenean lacinia bibendum nulla sed consectetur.',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1113,'2016-06-15 13:15:48','2016-06-15 13:48:29',5,-17,0,'1','3d47017ebea11aab81df0949914d29a8','jpeg','2127','1412','Ullamcorper Elit','Ullamcorper Elit','Ullamcorper Elit',NULL,NULL,'ullamcorper-elit','Ullamcorper Elit','Ullamcorper Elit',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1114,'2016-06-15 13:16:11','2016-06-15 13:48:29',5,-18,0,'2','50a559323e38bcd8ceec8aed5dab4d9d','jpeg','2500','2433','Justo Cursus','Justo Cursus','Justo Cursus',NULL,NULL,'justo-cursus','Justo Cursus','Justo Cursus',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1115,'2016-06-15 13:16:26','2016-06-15 13:48:29',5,-19,0,'3','dfd51317381e898afcd677c231fe75a8','jpeg','1920','1200','Condimentum Elit','Condimentum Elit','Condimentum Elit',NULL,NULL,'condimentum-elit','Condimentum Elit','Condimentum Elit',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1116,'2016-06-15 13:16:41','2016-06-15 13:48:29',5,-20,0,'4','225597193ce3b09f93f06b7cb9eb3a67','jpeg','4967','3508','Condimentum Pharetra','Condimentum Pharetra','Condimentum Pharetra',NULL,NULL,'condimentum-pharetra','Condimentum Pharetra','Condimentum Pharetra',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1117,'2016-06-15 13:17:02','2016-06-15 13:48:29',5,-21,0,'5','e190ec9451904cc16fc890cc4171d898','jpeg','2400','1599','Fringilla Vehicula','Fringilla Vehicula','Fringilla Vehicula',NULL,NULL,'fringilla-vehicula','Fringilla Vehicula','Fringilla Vehicula',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1118,'2016-06-15 13:17:16','2016-06-15 13:48:29',5,-22,0,'6','d5f1f8d857ae10920575d722cdf212e9','jpeg','1920','1200','Pharetra Justo','Pharetra Justo','Pharetra Justo',NULL,NULL,'pharetra-justo','Pharetra Justo','Pharetra Justo',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1119,'2016-06-15 13:46:16','2016-06-15 13:48:50',5,-23,0,'1','200bcf48fef289a55b8d23220b2b55ba','jpeg','2127','1412','Dapibus Vehicula Porta','Dapibus Vehicula Porta','Dapibus Vehicula Porta',NULL,NULL,'dapibus-vehicula-porta','Dapibus Vehicula Porta','Dapibus Vehicula Porta',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1120,'2016-06-15 13:46:39','2016-06-15 13:48:50',5,-24,0,'2','3295fecc108607a8c7d4647f85e20839','jpeg','2500','2433','Consectetur Inceptos Egestas','Consectetur Inceptos Egestas','Consectetur Inceptos Egestas',NULL,NULL,'consectetur-inceptos-egestas','Consectetur Inceptos Egestas','Consectetur Inceptos Egestas',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1121,'2016-06-15 13:46:56','2016-06-15 13:48:50',4,-26,0,'3','c36bf63bc4f076a39191a80aeb2e387d','jpeg','1920','1200','Nibh Sollicitudin Vestibulum','Nibh Sollicitudin Vestibulum','Nibh Sollicitudin Vestibulum',NULL,NULL,'nibh-sollicitudin-vestibulum','Nibh Sollicitudin Vestibulum','Nibh Sollicitudin Vestibulum',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1122,'2016-06-15 13:47:11','2016-07-08 08:33:58',5,-27,0,'4','21167ee1ef44fc327dd003d4076fec3b','jpeg','4967','3508','Nibh Fringilla Sit','Nibh Fringilla Sit',NULL,'Nibh Fringilla Sit',NULL,'nibh-fringilla-sit','Nibh Fringilla Sit','Nibh Fringilla Sit',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1123,'2016-06-15 13:47:38','2016-07-08 10:42:38',13,-28,0,'5','9be5103276136e6bd413207eef6e6a0b','jpeg','2400','1599','Ipsum Porta Euismod','Ipsum Porta Euismod','Ipsum Porta Euismod',NULL,NULL,'ipsum-porta-euismod','Ipsum Porta Euismod','Ipsum Porta Euismod',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1124,'2016-06-15 13:47:57','2016-06-15 13:48:52',6,-25,0,'6','c35e6401ae806a9790d6cb8254cd2174','jpeg','1920','1200','Justo Purus Ultricies','Justo Purus Ultricies','Justo Purus Ultricies',NULL,NULL,'justo-purus-ultricies','Justo Purus Ultricies','Justo Purus Ultricies',1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
INSERT INTO `projects` VALUES (1137,'2016-06-23 06:39:27','2016-11-18 12:29:57',9,-43,0,'4','134424529c3b58a6d63862aa86790759','jpeg','4967','3508','Curabitur blandit tempus porttitor.','Consectetur\nPorta','Consectetur Porta',NULL,'asdfasdf','consectetur-porta','Consectetur Porta','asdfasdf',1,NULL,NULL,NULL,NULL,NULL,1,'https://player.vimeo.com/external/180742892.sd.mp4?s=2491cd1991a29f2e8743a2fcf95139041f7e39b1&profile_id=165','https://vimeo.com/180742892');
INSERT INTO `projects` VALUES (1143,'2016-07-15 11:25:32','2016-07-15 11:26:01',3,-49,0,'3','d8c88dc24d4cfe5098a5f530733920e5','jpeg','1920','1200','asfd','asdf',NULL,NULL,NULL,'asdf','asdf','asdf',0,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `projects_BeforeInsert`
				BEFORE INSERT
				ON `projects`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `projects_BeforeUpdate`
				BEFORE UPDATE
				ON `projects`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `projects_tags`
--

DROP TABLE IF EXISTS `projects_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `projects_tags_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `projects_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_tags`
--

LOCK TABLES `projects_tags` WRITE;
/*!40000 ALTER TABLE `projects_tags` DISABLE KEYS */;
INSERT INTO `projects_tags` VALUES (54,1098,14);
INSERT INTO `projects_tags` VALUES (73,1096,13);
INSERT INTO `projects_tags` VALUES (74,1096,12);
INSERT INTO `projects_tags` VALUES (75,1096,14);
INSERT INTO `projects_tags` VALUES (267,1097,16);
INSERT INTO `projects_tags` VALUES (268,1095,16);
INSERT INTO `projects_tags` VALUES (269,1095,13);
INSERT INTO `projects_tags` VALUES (270,1095,12);
INSERT INTO `projects_tags` VALUES (271,1095,14);
INSERT INTO `projects_tags` VALUES (297,1099,12);
INSERT INTO `projects_tags` VALUES (298,1099,13);
INSERT INTO `projects_tags` VALUES (299,1099,14);
INSERT INTO `projects_tags` VALUES (300,1099,15);
INSERT INTO `projects_tags` VALUES (301,1099,16);
/*!40000 ALTER TABLE `projects_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `session_id` varchar(24) COLLATE utf8_danish_ci NOT NULL,
  `last_active` int(10) unsigned NOT NULL,
  `contents` text COLLATE utf8_danish_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_active` (`last_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('5861253caf3a83-58001261',1482822661,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0ODI4MjI2NjE7fQ==');
INSERT INTO `sessions` VALUES ('586213c70b8f81-36188656',1482822828,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0ODI4MjI4Mjg7fQ==');
INSERT INTO `sessions` VALUES ('586214125a32e0-43058850',1482822674,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDgyODIyNjc0O30=');
INSERT INTO `sessions` VALUES ('5862141261eee5-90371197',1482822674,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDgyODIyNjc0O30=');
INSERT INTO `sessions` VALUES ('5862141e9b2bb3-56400563',1482938119,'YToxNjp7czo2OiJjYXRfaWQiO2k6MDtzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDgyOTM4MTE5O3M6MTM6ImFkbWluOnVzZXJfaWQiO3M6MToiMyI7czoxNDoiZmlsZV91cGxvYWRfaWQiO2k6MTA7czozNzoiQmFja2VuZF9Ib21lX1NsaWRlc2hvd19HcmlkLnBhZ2VyLm51bSI7aToxO3M6Mzg6IkJhY2tlbmRfSG9tZV9TbGlkZXNob3dfR3JpZC5wYWdlci5zaXplIjtpOjEwO3M6Mzg6IkJhY2tlbmRfSG9tZV9TbGlkZXNob3dfR3JpZC5zb3J0ZXIuZGlyIjtOO3M6Mzk6IkJhY2tlbmRfSG9tZV9TbGlkZXNob3dfR3JpZC5zb3J0ZXIubmFtZSI7TjtzOjMzOiJCYWNrZW5kX0NhdGVnb3JpZXNfR3JpZC5wYWdlci5udW0iO2k6MTtzOjM0OiJCYWNrZW5kX0NhdGVnb3JpZXNfR3JpZC5wYWdlci5zaXplIjtpOjEwO3M6MzQ6IkJhY2tlbmRfQ2F0ZWdvcmllc19HcmlkLnNvcnRlci5kaXIiO047czozNToiQmFja2VuZF9DYXRlZ29yaWVzX0dyaWQuc29ydGVyLm5hbWUiO047czo0NzoiQmFja2VuZF9DYXRlZ29yaWVzX1N1YmNhdGVnb3JpZXNfR3JpZC5wYWdlci5udW0iO2k6MTtzOjQ4OiJCYWNrZW5kX0NhdGVnb3JpZXNfU3ViY2F0ZWdvcmllc19HcmlkLnBhZ2VyLnNpemUiO2k6MTA7czo0ODoiQmFja2VuZF9DYXRlZ29yaWVzX1N1YmNhdGVnb3JpZXNfR3JpZC5zb3J0ZXIuZGlyIjtOO3M6NDk6IkJhY2tlbmRfQ2F0ZWdvcmllc19TdWJjYXRlZ29yaWVzX0dyaWQuc29ydGVyLm5hbWUiO047fQ==');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `title` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (12,'2016-06-08 08:00:05',NULL,0,'house');
INSERT INTO `tags` VALUES (13,'2016-06-08 08:00:05',NULL,0,'building');
INSERT INTO `tags` VALUES (14,'2016-06-08 08:00:05',NULL,0,'home');
INSERT INTO `tags` VALUES (15,'2016-06-08 08:00:05',NULL,0,'architecture');
INSERT INTO `tags` VALUES (16,'2016-06-08 08:00:05',NULL,0,'city');
INSERT INTO `tags` VALUES (17,'2016-06-08 08:31:10',NULL,0,'blog article');
INSERT INTO `tags` VALUES (18,'2016-06-08 08:31:10',NULL,0,'blog');
INSERT INTO `tags` VALUES (19,'2016-06-08 08:39:47',NULL,0,'tag');
INSERT INTO `tags` VALUES (20,'2016-06-08 08:39:47',NULL,0,'example');
INSERT INTO `tags` VALUES (21,'2016-06-08 08:40:37',NULL,0,'article');
INSERT INTO `tags` VALUES (22,'2016-06-08 08:41:17',NULL,0,'latest');
INSERT INTO `tags` VALUES (24,'2016-09-01 08:36:31',NULL,0,'ghbdtn');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tags_BeforeInsert`
				BEFORE INSERT
				ON `tags`
					FOR EACH ROW
						SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tags_BeforeUpdate`
				BEFORE UPDATE
				ON `tags`
					FOR EACH ROW
						SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modify_count` int(11) NOT NULL DEFAULT '0',
  `str_id` varchar(64) COLLATE utf8_danish_ci DEFAULT NULL,
  `kind` varchar(16) COLLATE utf8_danish_ci DEFAULT NULL,
  `char_val` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `text_val` mediumtext COLLATE utf8_danish_ci,
  `int_val` int(11) DEFAULT NULL,
  `datetime_val` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `str_id` (`str_id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variables`
--

LOCK TABLES `variables` WRITE;
/*!40000 ALTER TABLE `variables` DISABLE KEYS */;
INSERT INTO `variables` VALUES (1,'2011-06-09 05:30:00','2016-12-26 15:40:22',140,'gc_datetime','datetime',NULL,NULL,NULL,'2016-12-26 17:40:22');
INSERT INTO `variables` VALUES (2,'2011-06-09 05:30:00','2016-07-05 10:49:47',75,'global_keywords','char','nuno,architekt',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (3,'2011-06-09 05:30:00','2016-04-11 13:05:32',76,'ga_id','char',NULL,NULL,NULL,NULL);
INSERT INTO `variables` VALUES (77,'2016-04-12 11:04:02','2016-07-05 10:49:47',11,'global_description','char','nuno',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (78,'2016-04-12 11:04:10','2016-07-05 10:49:47',11,'global_title','char','Nuno',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (109,'2016-05-27 06:36:58','2016-08-29 08:45:18',4,'facebook_url','char','https://www.facebook.com/',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (110,'2016-05-27 06:37:05','2016-08-29 08:45:18',4,'instagram_url','char','https://www.instagram.com/',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (111,'2016-05-27 10:41:20','2016-05-27 10:47:20',1,'homepage_quote','char','Vi utfordrer våre kunder \ntil å utvikle opplevelsesrike,  \ninnovative og bærekraftige\nprosjekter med oss',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (112,'2016-05-27 12:11:08','2016-05-27 12:17:21',1,'contact_phone','char','23 01 40 20',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (113,'2016-05-27 12:11:15','2016-05-27 12:17:21',1,'contact_email','char','firmapost@nunoarkitektur.no',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (114,'2016-05-30 08:19:37',NULL,0,'projects_seo_title','char',NULL,NULL,NULL,NULL);
INSERT INTO `variables` VALUES (115,'2016-05-30 08:19:47',NULL,0,'projects_seo_keywords','char',NULL,NULL,NULL,NULL);
INSERT INTO `variables` VALUES (116,'2016-05-30 08:19:56',NULL,0,'projects_seo_description','char',NULL,NULL,NULL,NULL);
INSERT INTO `variables` VALUES (117,'2016-06-17 08:01:46','2016-09-01 14:34:08',10,'about_quote','char','NUNO HAR FOKUS\nPÅ Å SKAPE INNOVATIV\nARKITEKTUR SOM IVARETAR\nDE STRENGESTE KRAV TIL\nENERGI OG MILJØ',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (118,'2016-06-20 08:47:12','2016-09-01 14:44:40',2,'about_competence_text','text',NULL,'<p>Lorem ipsum dolor sit amet, duo ea duis novum, volutpat erro ribus in usu, est cibo platonem cu. Maiestatis pero cipitur eum ut. E nominavi scribentur est, eos ea tollit senserit aliquando. Lorem ipsum dolor sit amet, duo ea duis novum, volutpat erro ribus in usu, est cibo platonem cu. Maiestatis pero cipitur eum ut. El nominavi scribentur est, eos ea tollit senserit aliquando. ttt</p>',NULL,NULL);
INSERT INTO `variables` VALUES (119,'2016-07-05 10:41:02','2016-07-05 10:49:47',6,'projects_title','char','Projects',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (120,'2016-07-05 10:41:23','2016-07-05 10:49:47',5,'projects_keywords','char','projects keywords',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (121,'2016-07-05 10:41:32','2016-07-05 10:49:47',5,'projects_description','char','projects description',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (122,'2016-07-05 10:42:51','2016-07-05 10:49:47',5,'about_title','char','About',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (123,'2016-07-05 10:43:01','2016-07-05 10:49:47',4,'about_keywords','char','about keywords',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (124,'2016-07-05 10:43:08','2016-07-05 10:49:47',4,'about_description','char','about description',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (125,'2016-07-05 10:45:29','2016-07-05 10:49:47',3,'blog_title','char','Blog',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (126,'2016-07-05 10:45:37','2016-07-05 10:49:47',3,'blog_keywords','char','blog keywords',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (127,'2016-07-05 10:45:45','2016-07-05 10:49:47',3,'blog_description','char','blog description',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (128,'2016-07-05 10:47:01','2016-07-05 10:49:47',2,'contact_title','char','Contact',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (129,'2016-07-05 10:47:11','2016-07-05 10:49:47',2,'contact_keywords','char','contact keywords',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (130,'2016-07-05 10:47:21','2016-07-05 10:49:47',2,'contact_description','char','contact description',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (131,'2016-07-05 10:48:36','2016-07-05 10:49:47',1,'search_title','char','Search',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (132,'2016-07-05 10:48:44','2016-07-05 10:49:47',1,'search_keywords','char','search keywords',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (133,'2016-07-05 10:48:51','2016-07-05 10:49:47',1,'search_description','char','search description',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (134,'2016-08-29 08:43:39','2016-08-29 08:45:18',1,'linkedin_url','char','https://www.linkedin.com/',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (135,'2016-08-30 06:10:03','2016-09-01 14:52:52',3,'about_bottom_heading','char','last test',NULL,NULL,NULL);
INSERT INTO `variables` VALUES (136,'2016-08-30 06:10:16','2016-09-01 14:52:52',3,'about_bottom_text','text',NULL,'<p>Nullam quis risus eget urna mollis ornare vel eu leo. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor. last last test</p>\n<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Aenean lacinia bibendum nulla sed consectetur.</p>',NULL,NULL);
/*!40000 ALTER TABLE `variables` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `variables_BeforeInsert` BEFORE INSERT ON `variables` FOR EACH ROW SET NEW.`created` = IFNULL(NEW.`created`, NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `variables_BeforeUpdate` BEFORE UPDATE ON `variables` FOR EACH ROW SET NEW.`modify_count` = OLD.`modify_count` + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-29 17:39:35
