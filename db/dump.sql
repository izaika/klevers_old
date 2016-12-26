-- MySQL dump 10.13  Distrib 5.6.22, for osx10.8 (x86_64)
--
-- Host: localhost    Database: nuno
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `about_blocks_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `about_blocks_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `article_images_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `article_images_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `articles_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `articles_BeforeUpdate`
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
  `icon_filename` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `icon_filesize` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `icon_uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `animation_property` tinyint(1) NOT NULL DEFAULT '0',
  `pdf_filename` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `pdf_filesize` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `pdf_uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `pdf_title` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'2016-06-09 06:32:57','2016-07-08 10:45:52',49,-7,'Bad','Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Null','bad.svg','3206','5ebbfa83101b907a0c8dce8a1a3b23a1',0,'3.jpg','562735','8e8301dcc1ba56f40c130a656f959220','Inceptos Ornare');
INSERT INTO `categories` VALUES (2,'2016-06-09 06:33:32','2016-08-30 13:52:17',23,-6,'Bolig','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam quis risus eget urna mollis ornare vel eu leo. Integer posuere erat a ante venenatis dapibus posuere velit alique','Bolig.svg','1117','16f7f8883177a0caea7ca93691b4db09',0,'pdf-test.pdf','20597','ec5ac1eae7695967981fc18c97c03d1b','Inceptos Ornare');
INSERT INTO `categories` VALUES (3,'2016-06-09 06:34:19','2016-08-30 13:54:05',28,-3,'Bruer','Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucib','bruer.svg','1883','93cf04494ad035122dd6de160cf637b6',0,'pdf-test.pdf','20597','968b100d8e66aa0771edaacbe148bdde','Inceptos Ornare');
INSERT INTO `categories` VALUES (4,'2016-06-09 06:34:34','2016-06-30 08:22:14',17,-2,'Helse og omsorg','Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Curabitur blandit tempus porttitor. Etiam porta','helse.svg','1448','fcf8576ea7d989c7e987b36d6d6f7cb2',0,'pdf-test.pdf','20597','5b8ac88e78796be32974e29e36a88748','Inceptos Ornare');
INSERT INTO `categories` VALUES (5,'2016-06-09 06:34:45','2016-08-30 13:47:56',20,-1,'Næring','Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cum sociis','ARBEIDSPLASSER.svg','2616','6ad0a8c4b532349b834701735b303f90',0,'pdf-test.pdf','20597','7985c38f3ab1bce1cc5b29e58412ba98','Inceptos Ornare');
INSERT INTO `categories` VALUES (6,'2016-06-09 06:34:55','2016-06-29 12:05:24',15,0,'Kultur','Donec sed odio dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Etiam porta sem malesuada magna mollis e','kultur.svg','754','2c424d6c061c0330f2dbcf670cf7cd00',1,'pdf-test.pdf','20597','b6c3f5e8259be16d674d078885359139','Inceptos Ornare');
INSERT INTO `categories` VALUES (7,'2016-06-09 06:35:03','2016-06-29 12:05:24',16,1,'Plan','Etiam porta sem malesuada magna mollis euismod. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec id elit non mi porta gravida at eget metus. Aenean lacinia bibendum nulla sed consectetur. Nullam id dolo','plan.svg','1557','4ba5b5afc49f457d00e47fd9875bf7a5',1,'pdf-test.pdf','20597','15aaf7b2bc0e2560dc591dd78760071e','Inceptos Ornare');
INSERT INTO `categories` VALUES (8,'2016-06-09 06:35:13','2016-08-30 13:59:56',20,2,'Infrastruktur','Sed posuere consectetur est at lobortis. Nullam quis risus eget urna mollis ornare vel eu leo. Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Lorem i','Infrastructure_Blue.svg','1066','4025f1e0b5c9225d6374f992043b8314',0,'pdf-test.pdf','20597','f2ed9f35c6824242a008d0d0baa2356f','Inceptos Ornare');
INSERT INTO `categories` VALUES (9,'2016-06-09 06:35:23','2016-06-29 12:05:24',15,3,'Undervisning','Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed diam eget risus varius blandit sit amet non magna. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam.','undervisning.svg','687','29e2c284c05d767e839e9f18c9517595',1,'pdf-test.pdf','20597','2a72e0091c430727e185f734a09add37','Inceptos Ornare');
INSERT INTO `categories` VALUES (12,'2016-06-29 12:04:50','2016-08-30 13:55:26',6,-5,'Enebolig / Hytte','Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras justo odio, dapibus ac facilis','enebolig.svg','1454','573b3ddd107994d6eac8d546a41400c5',0,'5.JPG','4222290','4fdb35c65a165f3bbdef9d931e86e7ac','pdf title example');
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `categories_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `categories_BeforeUpdate`
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
INSERT INTO `categories_projects` VALUES (6,'2016-06-20 07:32:31','2016-06-22 12:21:49',2,1098,3,0);
INSERT INTO `categories_projects` VALUES (14,'2016-06-20 07:32:30','2016-06-30 08:21:54',2,1096,2,1);
INSERT INTO `categories_projects` VALUES (52,'2016-06-20 07:32:30','2016-06-30 08:32:33',3,1094,1,0);
INSERT INTO `categories_projects` VALUES (68,'2016-06-20 07:32:30','2016-06-30 08:21:55',2,1101,2,1);
INSERT INTO `categories_projects` VALUES (69,'2016-06-20 07:32:30','2016-06-30 08:22:05',2,1101,3,1);
INSERT INTO `categories_projects` VALUES (73,'2016-06-20 07:32:30','2016-06-30 08:22:06',2,1102,3,1);
INSERT INTO `categories_projects` VALUES (74,'2016-06-20 07:32:30','2016-06-22 12:21:15',1,1102,4,0);
INSERT INTO `categories_projects` VALUES (75,'2016-06-20 07:32:30','2016-06-30 08:22:11',2,1103,4,1);
INSERT INTO `categories_projects` VALUES (76,'2016-06-20 07:32:30','2016-06-22 12:21:19',1,1103,5,0);
INSERT INTO `categories_projects` VALUES (77,'2016-06-20 07:32:30','2016-06-30 08:22:18',2,1104,5,1);
INSERT INTO `categories_projects` VALUES (78,'2016-06-20 07:32:30','2016-06-22 12:21:20',1,1104,6,0);
INSERT INTO `categories_projects` VALUES (79,'2016-06-20 07:32:30','2016-06-22 12:21:21',1,1105,6,0);
INSERT INTO `categories_projects` VALUES (80,'2016-06-20 07:32:30','2016-06-22 12:21:22',1,1105,7,0);
INSERT INTO `categories_projects` VALUES (91,'2016-06-20 07:32:30','2016-06-30 08:22:19',2,1112,5,1);
INSERT INTO `categories_projects` VALUES (92,'2016-06-20 07:32:30','2016-06-30 08:22:13',2,1111,4,1);
INSERT INTO `categories_projects` VALUES (93,'2016-06-20 07:32:30','2016-06-22 12:21:23',1,1109,3,0);
INSERT INTO `categories_projects` VALUES (94,'2016-06-20 07:32:30','2016-06-22 12:21:24',1,1108,2,0);
INSERT INTO `categories_projects` VALUES (96,'2016-06-20 07:32:30','2016-06-22 12:21:25',1,1106,8,0);
INSERT INTO `categories_projects` VALUES (97,'2016-06-20 07:32:30','2016-06-22 12:21:26',1,1106,9,0);
INSERT INTO `categories_projects` VALUES (104,'2016-06-20 07:32:30','2016-06-22 12:21:26',1,1113,9,0);
INSERT INTO `categories_projects` VALUES (105,'2016-06-20 07:32:30','2016-06-22 12:21:27',1,1114,8,0);
INSERT INTO `categories_projects` VALUES (106,'2016-06-20 07:32:30','2016-06-22 12:21:27',1,1115,7,0);
INSERT INTO `categories_projects` VALUES (107,'2016-06-20 07:32:30','2016-06-22 12:21:28',1,1116,6,0);
INSERT INTO `categories_projects` VALUES (108,'2016-06-20 07:32:30','2016-06-30 08:22:20',2,1117,5,1);
INSERT INTO `categories_projects` VALUES (109,'2016-06-20 07:32:30','2016-06-22 12:21:29',1,1118,4,0);
INSERT INTO `categories_projects` VALUES (110,'2016-06-20 07:32:30','2016-06-22 12:21:32',1,1119,3,0);
INSERT INTO `categories_projects` VALUES (111,'2016-06-20 07:32:30','2016-06-22 12:21:33',1,1120,4,0);
INSERT INTO `categories_projects` VALUES (112,'2016-06-20 07:32:30','2016-06-22 12:21:34',1,1121,5,0);
INSERT INTO `categories_projects` VALUES (116,'2016-06-20 07:32:30','2016-06-22 12:21:35',1,1124,7,0);
INSERT INTO `categories_projects` VALUES (117,'2016-06-20 07:32:30','2016-06-22 12:21:35',1,1124,8,0);
INSERT INTO `categories_projects` VALUES (118,'2016-06-20 07:32:30','2016-06-22 12:21:36',1,1124,9,0);
INSERT INTO `categories_projects` VALUES (168,'2016-07-08 08:33:58',NULL,0,1122,6,0);
INSERT INTO `categories_projects` VALUES (172,'2016-07-08 10:42:38',NULL,0,1123,8,0);
INSERT INTO `categories_projects` VALUES (173,'2016-07-08 10:42:38',NULL,0,1123,9,0);
INSERT INTO `categories_projects` VALUES (189,'2016-07-15 11:11:55',NULL,0,1097,2,0);
INSERT INTO `categories_projects` VALUES (190,'2016-07-15 11:12:00',NULL,0,1095,1,0);
INSERT INTO `categories_projects` VALUES (200,'2016-08-31 14:48:00',NULL,0,1107,1,0);
INSERT INTO `categories_projects` VALUES (201,'2016-08-31 14:48:00',NULL,0,1107,2,0);
INSERT INTO `categories_projects` VALUES (202,'2016-08-31 14:48:00',NULL,0,1107,7,0);
INSERT INTO `categories_projects` VALUES (209,'2016-09-04 08:41:32',NULL,0,1099,1,0);
INSERT INTO `categories_projects` VALUES (210,'2016-09-04 08:41:33',NULL,0,1099,2,0);
INSERT INTO `categories_projects` VALUES (211,'2016-09-04 08:41:33',NULL,0,1099,7,0);
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `categories_projects_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `categories_projects_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `cp_items_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `cp_items_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `employees_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `employees_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `files_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `files_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `homeprojects_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `homeprojects_BeforeUpdate`
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
  `project_id` int(11) DEFAULT NULL,
  `link_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `heading` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `subheading` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `url` varchar(256) COLLATE utf8_danish_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_danish_ci DEFAULT NULL,
  `uid` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `ext` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `width` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `height` varchar(5) COLLATE utf8_danish_ci DEFAULT NULL,
  `open_link_in_new_window` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `video_url` varchar(512) COLLATE utf8_danish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ord` (`ord`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `homeslides_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homeslides`
--

LOCK TABLES `homeslides` WRITE;
/*!40000 ALTER TABLE `homeslides` DISABLE KEYS */;
INSERT INTO `homeslides` VALUES (1,'2016-06-06 07:09:46','2016-09-05 08:25:37',8,-1,1099,1,NULL,'Pharetra Ridiculus',NULL,NULL,NULL,NULL,NULL,NULL,0,'https://player.vimeo.com/external/180742892.sd.mp4?s=2491cd1991a29f2e8743a2fcf95139041f7e39b1&profile_id=165');
INSERT INTO `homeslides` VALUES (4,'2016-06-06 08:23:58','2016-06-20 14:46:58',7,0,NULL,0,'Nulla vitae elit libero, a pharetra augue.','Cursus Nibh',NULL,'2','558d4b9c0580fac68c7e9c93740c6291','jpeg','2500','2433',0,NULL);
INSERT INTO `homeslides` VALUES (5,'2016-06-06 08:24:38','2016-06-06 10:42:36',5,1,NULL,2,'Morbi leo risus, porta ac consectetur ac, vestibulum at eros.','Vehicula Ligula','http://idangero.us/swiper/api/','3','51aad8581c91a1cde5fdf42e80a379e5','jpeg','1920','1200',1,NULL);
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `homeslides_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `homeslides_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `project_blocks_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `project_blocks_BeforeUpdate`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `projects_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `projects_BeforeUpdate`
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
INSERT INTO `sessions` VALUES ('580e12e80f1a11-33491737',1477317359,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczMTczNTk7fQ==');
INSERT INTO `sessions` VALUES ('580efd874c6ed4-72143419',1477377415,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzc0MTU7fQ==');
INSERT INTO `sessions` VALUES ('580efdb171c628-28821238',1477377458,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzc0NTg7fQ==');
INSERT INTO `sessions` VALUES ('580efedab16a50-80487834',1477377754,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzc3NTQ7fQ==');
INSERT INTO `sessions` VALUES ('580eff065f6386-92941918',1477377799,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzc3OTk7fQ==');
INSERT INTO `sessions` VALUES ('580eff4395add0-67839226',1477377860,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzc4NjA7fQ==');
INSERT INTO `sessions` VALUES ('580eff86672d18-11194452',1477377927,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzc5Mjc7fQ==');
INSERT INTO `sessions` VALUES ('580effffe64f48-89902420',1477378054,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzgwNTQ7fQ==');
INSERT INTO `sessions` VALUES ('580f001f704dd4-87612828',1477378083,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzgwODM7fQ==');
INSERT INTO `sessions` VALUES ('580f010a8c1272-14920076',1477378314,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczNzgzMTQ7fQ==');
INSERT INTO `sessions` VALUES ('580f0cb52b95d1-84795435',1477381301,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczODEzMDE7fQ==');
INSERT INTO `sessions` VALUES ('580f0cd07fc543-52357072',1477381328,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczODEzMjg7fQ==');
INSERT INTO `sessions` VALUES ('580f3c17c36124-36090254',1477393431,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTM0MzE7fQ==');
INSERT INTO `sessions` VALUES ('580f3cd3b3c4b9-61130871',1477393619,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTM2MTk7fQ==');
INSERT INTO `sessions` VALUES ('580f3cdae65c39-19626747',1477393626,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTM2MjY7fQ==');
INSERT INTO `sessions` VALUES ('580f3d0ba4e2c9-78713413',1477393675,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTM2NzU7fQ==');
INSERT INTO `sessions` VALUES ('580f3d2a2b7ec2-98540480',1477393706,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTM3MDY7fQ==');
INSERT INTO `sessions` VALUES ('580f3d4ad97e87-92782451',1477393738,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTM3Mzg7fQ==');
INSERT INTO `sessions` VALUES ('580f457dbf0a60-98288259',1477395837,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTU4Mzc7fQ==');
INSERT INTO `sessions` VALUES ('580f459889c756-19151594',1477395864,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTU4NjQ7fQ==');
INSERT INTO `sessions` VALUES ('580f45ad007528-53432960',1477395885,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTU4ODU7fQ==');
INSERT INTO `sessions` VALUES ('580f45d5b4f303-98889328',1477395925,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTU5MjU7fQ==');
INSERT INTO `sessions` VALUES ('580f45e003fc47-75886562',1477395936,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTU5MzY7fQ==');
INSERT INTO `sessions` VALUES ('580f45e90c0d22-57531120',1477395945,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTU5NDU7fQ==');
INSERT INTO `sessions` VALUES ('580f46210eb4e1-77409237',1477396001,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTYwMDE7fQ==');
INSERT INTO `sessions` VALUES ('580f462d097398-22344101',1477396013,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTYwMTM7fQ==');
INSERT INTO `sessions` VALUES ('580f463ac2ff80-82550137',1477396026,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTYwMjY7fQ==');
INSERT INTO `sessions` VALUES ('580f463ea1f210-62706040',1477396030,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTYwMzA7fQ==');
INSERT INTO `sessions` VALUES ('580f468e85f3e7-08060036',1477396110,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzczOTYxMTA7fQ==');
INSERT INTO `sessions` VALUES ('580f6fe7261385-99331324',1477406695,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDY2OTU7fQ==');
INSERT INTO `sessions` VALUES ('580f70dcc2a4b9-18585058',1477406940,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDY5NDA7fQ==');
INSERT INTO `sessions` VALUES ('580f70f3e6ff07-69333660',1477406963,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDY5NjM7fQ==');
INSERT INTO `sessions` VALUES ('580f7109e45435-65248013',1477406985,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDY5ODU7fQ==');
INSERT INTO `sessions` VALUES ('580f711b3d24b4-70470854',1477407003,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcwMDM7fQ==');
INSERT INTO `sessions` VALUES ('580f718f9c1df4-90094351',1477407119,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcxMTk7fQ==');
INSERT INTO `sessions` VALUES ('580f71a68a2183-66935305',1477407142,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcxNDI7fQ==');
INSERT INTO `sessions` VALUES ('580f71c2933598-86165532',1477407170,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcxNzA7fQ==');
INSERT INTO `sessions` VALUES ('580f71d75d3249-11321260',1477407191,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcxOTE7fQ==');
INSERT INTO `sessions` VALUES ('580f71e03ad2f9-01740323',1477407200,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcyMDA7fQ==');
INSERT INTO `sessions` VALUES ('580f71f5587571-28208283',1477407221,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcyMjE7fQ==');
INSERT INTO `sessions` VALUES ('580f720e99de40-71422860',1477407246,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDcyNDY7fQ==');
INSERT INTO `sessions` VALUES ('580f742a6eda73-10164750',1477407786,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0MDc3ODY7fQ==');
INSERT INTO `sessions` VALUES ('58104c299b6c54-99347284',1477463081,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjMwODE7fQ==');
INSERT INTO `sessions` VALUES ('581053050188d6-81062435',1477464837,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ4Mzc7fQ==');
INSERT INTO `sessions` VALUES ('58105315017699-23383047',1477464853,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ4NTM7fQ==');
INSERT INTO `sessions` VALUES ('5810532b24d904-26303473',1477464875,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ4NzU7fQ==');
INSERT INTO `sessions` VALUES ('5810534ba40965-61328954',1477464907,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ5MDc7fQ==');
INSERT INTO `sessions` VALUES ('581053519201f0-38244457',1477464913,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ5MTM7fQ==');
INSERT INTO `sessions` VALUES ('58105356b3d8a5-47069963',1477464918,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ5MTg7fQ==');
INSERT INTO `sessions` VALUES ('58105373b81822-03218028',1477464947,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ5NDc7fQ==');
INSERT INTO `sessions` VALUES ('58105382b6e3a4-07530752',1477464962,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjQ5NjI7fQ==');
INSERT INTO `sessions` VALUES ('581053ba10d4d7-47981375',1477465018,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjUwMTg7fQ==');
INSERT INTO `sessions` VALUES ('58106076ed6f07-88144050',1477468279,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjgyNzk7fQ==');
INSERT INTO `sessions` VALUES ('58106082ac76f5-83305177',1477468290,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjgyOTA7fQ==');
INSERT INTO `sessions` VALUES ('581060bdc2dc93-96682429',1477468349,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjgzNDk7fQ==');
INSERT INTO `sessions` VALUES ('581060d2997ab1-33421783',1477468370,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjgzNzA7fQ==');
INSERT INTO `sessions` VALUES ('5810620be19051-51481478',1477468684,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njg2ODQ7fQ==');
INSERT INTO `sessions` VALUES ('5810622213e808-17224080',1477468706,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njg3MDY7fQ==');
INSERT INTO `sessions` VALUES ('581062e02e8198-73844356',1477468896,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njg4OTY7fQ==');
INSERT INTO `sessions` VALUES ('58106310cb4936-15039319',1477468944,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njg5NDQ7fQ==');
INSERT INTO `sessions` VALUES ('581063148ec0e6-19894399',1477468948,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njg5NDg7fQ==');
INSERT INTO `sessions` VALUES ('5810631f9c9c67-27974542',1477468959,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njg5NTk7fQ==');
INSERT INTO `sessions` VALUES ('5810632eb91f00-23919616',1477468974,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njg5NzQ7fQ==');
INSERT INTO `sessions` VALUES ('5810635fdb5585-68390546',1477469023,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjkwMjM7fQ==');
INSERT INTO `sessions` VALUES ('5810638c4b47d6-03764265',1477469068,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjkwNjg7fQ==');
INSERT INTO `sessions` VALUES ('581064487bcde4-31656144',1477469256,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjkyNTY7fQ==');
INSERT INTO `sessions` VALUES ('581064ce546419-67461755',1477469390,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NjkzOTA7fQ==');
INSERT INTO `sessions` VALUES ('581064fdcc72f1-52519241',1477469437,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk0Mzc7fQ==');
INSERT INTO `sessions` VALUES ('581065269e4140-46441007',1477469478,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk0Nzg7fQ==');
INSERT INTO `sessions` VALUES ('5810653b753c85-58053455',1477469499,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk0OTk7fQ==');
INSERT INTO `sessions` VALUES ('581066303815e1-11922056',1477469744,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk3NDQ7fQ==');
INSERT INTO `sessions` VALUES ('58106653b38162-03581598',1477469779,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk3Nzk7fQ==');
INSERT INTO `sessions` VALUES ('581066a89f85b7-45850508',1477469864,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk4NjQ7fQ==');
INSERT INTO `sessions` VALUES ('581066bb856608-18134077',1477469883,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk4ODM7fQ==');
INSERT INTO `sessions` VALUES ('581066e5650d68-66083604',1477469925,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Njk5MjU7fQ==');
INSERT INTO `sessions` VALUES ('58106748a24167-99939543',1477470024,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzAwMjQ7fQ==');
INSERT INTO `sessions` VALUES ('58106784a47a08-69089407',1477470084,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzAwODQ7fQ==');
INSERT INTO `sessions` VALUES ('581067a5b428d3-33109002',1477470117,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzAxMTc7fQ==');
INSERT INTO `sessions` VALUES ('581068c785a019-08148091',1477470407,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzA0MDc7fQ==');
INSERT INTO `sessions` VALUES ('581069588a2340-93199502',1477470552,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzA1NTI7fQ==');
INSERT INTO `sessions` VALUES ('581069a5644556-24897231',1477470629,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzA2Mjk7fQ==');
INSERT INTO `sessions` VALUES ('58106a1d34db12-28842686',1477470749,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzA3NDk7fQ==');
INSERT INTO `sessions` VALUES ('58106a28949211-37503921',1477470760,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzA3NjA7fQ==');
INSERT INTO `sessions` VALUES ('58106a63d088e6-76238214',1477470819,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzA4MTk7fQ==');
INSERT INTO `sessions` VALUES ('58106a9032c6a2-91945294',1477470864,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzA4NjQ7fQ==');
INSERT INTO `sessions` VALUES ('58106c19b4d312-58772208',1477471257,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzEyNTc7fQ==');
INSERT INTO `sessions` VALUES ('58106c28248139-07571686',1477471272,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzEyNzI7fQ==');
INSERT INTO `sessions` VALUES ('58106c3a16ebe6-84212932',1477471290,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzEyOTA7fQ==');
INSERT INTO `sessions` VALUES ('58106c47eb59f4-90632014',1477471304,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzEzMDQ7fQ==');
INSERT INTO `sessions` VALUES ('58108338639f69-53531332',1477477176,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzcxNzY7fQ==');
INSERT INTO `sessions` VALUES ('581083448dc4d5-53269986',1477477188,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzcxODg7fQ==');
INSERT INTO `sessions` VALUES ('58108ba08e94b2-06427905',1477479328,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0NzkzMjg7fQ==');
INSERT INTO `sessions` VALUES ('58108c0185f763-12238143',1477479425,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Nzk0MjU7fQ==');
INSERT INTO `sessions` VALUES ('58108c1c7dad55-86642862',1477479452,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0Nzk0NTI7fQ==');
INSERT INTO `sessions` VALUES ('58109339084025-75863720',1477481273,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODEyNzM7fQ==');
INSERT INTO `sessions` VALUES ('58109347a403e5-55514789',1477481287,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODEyODc7fQ==');
INSERT INTO `sessions` VALUES ('5810934f012bb0-22777214',1477481295,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODEyOTU7fQ==');
INSERT INTO `sessions` VALUES ('5810935b44c420-49293930',1477481307,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODEzMDc7fQ==');
INSERT INTO `sessions` VALUES ('581093a6888744-27423128',1477481382,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODEzODI7fQ==');
INSERT INTO `sessions` VALUES ('581093bad82319-57715146',1477481402,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODE0MDI7fQ==');
INSERT INTO `sessions` VALUES ('581093c7158e61-24464221',1477481415,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODE0MTU7fQ==');
INSERT INTO `sessions` VALUES ('581093e237e894-82627798',1477481442,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODE0NDI7fQ==');
INSERT INTO `sessions` VALUES ('581093efd63c28-20358410',1477481455,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODE0NTU7fQ==');
INSERT INTO `sessions` VALUES ('581094166290d8-98404933',1477481494,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODE0OTQ7fQ==');
INSERT INTO `sessions` VALUES ('5810a232d0e457-54390678',1477485107,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODUxMDc7fQ==');
INSERT INTO `sessions` VALUES ('5810a2f2b9ec68-00071892',1477485298,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODUyOTg7fQ==');
INSERT INTO `sessions` VALUES ('5810a440471238-28050357',1477485632,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODU2MzI7fQ==');
INSERT INTO `sessions` VALUES ('5810a44d86cd51-01497010',1477485645,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODU2NDU7fQ==');
INSERT INTO `sessions` VALUES ('5810a462a429b1-83056349',1477485666,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODU2NjY7fQ==');
INSERT INTO `sessions` VALUES ('5810a493275541-39882257',1477485715,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODU3MTU7fQ==');
INSERT INTO `sessions` VALUES ('5810a4c05081e1-28738530',1477485760,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODU3NjA7fQ==');
INSERT INTO `sessions` VALUES ('5810acfaabed47-19510673',1477487866,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODc4NjY7fQ==');
INSERT INTO `sessions` VALUES ('5810ad410c8a73-44264066',1477487937,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODc5Mzc7fQ==');
INSERT INTO `sessions` VALUES ('5810ad4e45d6e9-34256011',1477487950,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODc5NTA7fQ==');
INSERT INTO `sessions` VALUES ('5810adf21e9a31-85383831',1477488114,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgxMTQ7fQ==');
INSERT INTO `sessions` VALUES ('5810ae334d7849-08469420',1477488179,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgxNzk7fQ==');
INSERT INTO `sessions` VALUES ('5810ae401e2447-35238026',1477488192,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgxOTI7fQ==');
INSERT INTO `sessions` VALUES ('5810ae72163fb1-71794545',1477488242,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgyNDI7fQ==');
INSERT INTO `sessions` VALUES ('5810ae86492cd7-25141149',1477488262,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgyNjI7fQ==');
INSERT INTO `sessions` VALUES ('5810aeac167f74-76468313',1477488300,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgzMDA7fQ==');
INSERT INTO `sessions` VALUES ('5810aed52147d7-37681821',1477488341,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgzNDE7fQ==');
INSERT INTO `sessions` VALUES ('5810af0d260050-27677662',1477488397,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODgzOTc7fQ==');
INSERT INTO `sessions` VALUES ('5810af27f33ac0-81077303',1477488424,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODg0MjQ7fQ==');
INSERT INTO `sessions` VALUES ('5810af5a3b0673-55730616',1477488474,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODg0NzQ7fQ==');
INSERT INTO `sessions` VALUES ('5810b434e900d6-52048920',1477489717,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODk3MTc7fQ==');
INSERT INTO `sessions` VALUES ('5810b457042f46-44298167',1477489751,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0ODk3NTE7fQ==');
INSERT INTO `sessions` VALUES ('5810b6d2e49304-55833693',1477490386,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTAzODY7fQ==');
INSERT INTO `sessions` VALUES ('5810b757aa57a5-71879646',1477490519,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTA1MTk7fQ==');
INSERT INTO `sessions` VALUES ('5810b7a18b2c20-35904896',1477490593,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTA1OTM7fQ==');
INSERT INTO `sessions` VALUES ('5810c00c0ba0a9-44382633',1477492748,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTI3NDg7fQ==');
INSERT INTO `sessions` VALUES ('5810c0213e2480-17267541',1477492769,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTI3Njk7fQ==');
INSERT INTO `sessions` VALUES ('5810c0b9108625-48837204',1477492921,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTI5MjE7fQ==');
INSERT INTO `sessions` VALUES ('5810c0cc2d4714-91884480',1477492940,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTI5NDA7fQ==');
INSERT INTO `sessions` VALUES ('5810c0de898a49-52733455',1477492958,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTI5NTg7fQ==');
INSERT INTO `sessions` VALUES ('5810c11686ada6-12397692',1477493014,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTMwMTQ7fQ==');
INSERT INTO `sessions` VALUES ('5810c14a3bf831-17487156',1477493066,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTMwNjY7fQ==');
INSERT INTO `sessions` VALUES ('5810c16a801ad9-63482289',1477493098,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTMwOTg7fQ==');
INSERT INTO `sessions` VALUES ('5810c19756a154-46841334',1477493143,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTMxNDM7fQ==');
INSERT INTO `sessions` VALUES ('5810c26f62fce1-97046389',1477493359,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc0OTMzNTk7fQ==');
INSERT INTO `sessions` VALUES ('58119c17297c83-35736746',1477549079,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDkwNzk7fQ==');
INSERT INTO `sessions` VALUES ('58119c5fa621e3-04399526',1477549151,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDkxNTE7fQ==');
INSERT INTO `sessions` VALUES ('58119c8d7dfc37-06487381',1477549197,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDkxOTc7fQ==');
INSERT INTO `sessions` VALUES ('58119cd8d8dcb8-93504572',1477549272,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDkyNzI7fQ==');
INSERT INTO `sessions` VALUES ('58119cefa3ee18-63790944',1477549295,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDkyOTU7fQ==');
INSERT INTO `sessions` VALUES ('58119d27c65895-55187720',1477549351,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDkzNTE7fQ==');
INSERT INTO `sessions` VALUES ('58119d3c5af643-61788406',1477549372,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDkzNzI7fQ==');
INSERT INTO `sessions` VALUES ('58119e3fd77c88-25556174',1477549632,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk2MzI7fQ==');
INSERT INTO `sessions` VALUES ('58119e4b2c9727-76144417',1477549643,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk2NDM7fQ==');
INSERT INTO `sessions` VALUES ('58119e64a963c4-37751594',1477549668,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk2Njg7fQ==');
INSERT INTO `sessions` VALUES ('58119e7ca68e13-67054279',1477549692,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk2OTI7fQ==');
INSERT INTO `sessions` VALUES ('58119e912c45f6-46905526',1477549713,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk3MTM7fQ==');
INSERT INTO `sessions` VALUES ('58119ec15ae9c3-72293495',1477549761,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk3NjE7fQ==');
INSERT INTO `sessions` VALUES ('58119ee67f46e7-01200841',1477549798,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk3OTg7fQ==');
INSERT INTO `sessions` VALUES ('58119f22dd1535-13762161',1477549859,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk4NTk7fQ==');
INSERT INTO `sessions` VALUES ('58119f47c3a665-28908210',1477549895,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk4OTU7fQ==');
INSERT INTO `sessions` VALUES ('58119f4e6952a3-55299827',1477549902,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk5MDI7fQ==');
INSERT INTO `sessions` VALUES ('58119f6102e261-55132240',1477549921,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk5MjE7fQ==');
INSERT INTO `sessions` VALUES ('58119f7fd9eb41-39393717',1477549951,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk5NTE7fQ==');
INSERT INTO `sessions` VALUES ('58119f8b43c7b0-92971665',1477549963,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk5NjM7fQ==');
INSERT INTO `sessions` VALUES ('58119fa1b17d19-35425831',1477549985,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk5ODU7fQ==');
INSERT INTO `sessions` VALUES ('58119fac716f82-27926733',1477549996,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NDk5OTY7fQ==');
INSERT INTO `sessions` VALUES ('58119fc5431ad3-74785739',1477550021,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTAwMjE7fQ==');
INSERT INTO `sessions` VALUES ('58119fcf17f0e7-14676456',1477550031,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTAwMzE7fQ==');
INSERT INTO `sessions` VALUES ('5811a071569a75-48415512',1477550193,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTAxOTM7fQ==');
INSERT INTO `sessions` VALUES ('5811a08743f1b4-48554828',1477550215,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTAyMTU7fQ==');
INSERT INTO `sessions` VALUES ('5811a098c9f2f5-62405220',1477550232,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTAyMzI7fQ==');
INSERT INTO `sessions` VALUES ('5811a0a76e1501-30279589',1477550247,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTAyNDc7fQ==');
INSERT INTO `sessions` VALUES ('5811a0e3d293a5-55833177',1477550307,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTAzMDc7fQ==');
INSERT INTO `sessions` VALUES ('5811a4f7a79c53-81979646',1477551351,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTEzNTE7fQ==');
INSERT INTO `sessions` VALUES ('5811a53cf09691-73705395',1477551421,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTE0MjE7fQ==');
INSERT INTO `sessions` VALUES ('5811a558e66987-59826517',1477551448,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTE0NDg7fQ==');
INSERT INTO `sessions` VALUES ('5811a56e5dee28-78489770',1477551470,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTE0NzA7fQ==');
INSERT INTO `sessions` VALUES ('5811ad1a315ec9-80750874',1477553434,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTM0MzQ7fQ==');
INSERT INTO `sessions` VALUES ('5811ae6601a4b8-14329477',1477553766,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTM3NjY7fQ==');
INSERT INTO `sessions` VALUES ('5811b03dc94236-91937390',1477554237,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTQyMzc7fQ==');
INSERT INTO `sessions` VALUES ('5811b28f2dffc1-81982077',1477554831,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTQ4MzE7fQ==');
INSERT INTO `sessions` VALUES ('5811b8446ee2c9-19047831',1477556292,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTYyOTI7fQ==');
INSERT INTO `sessions` VALUES ('5811b8595c2cf7-71488399',1477556313,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTYzMTM7fQ==');
INSERT INTO `sessions` VALUES ('5811b8a528d6e3-79209418',1477556389,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTYzODk7fQ==');
INSERT INTO `sessions` VALUES ('5811b8efb45fa3-79727658',1477556463,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY0NjM7fQ==');
INSERT INTO `sessions` VALUES ('5811b90aa86924-45031847',1477556490,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY0OTA7fQ==');
INSERT INTO `sessions` VALUES ('5811b922a04286-00291996',1477556514,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY1MTQ7fQ==');
INSERT INTO `sessions` VALUES ('5811b93aee4a79-94458519',1477556539,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY1Mzk7fQ==');
INSERT INTO `sessions` VALUES ('5811b956a895c3-96505074',1477556566,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY1NjY7fQ==');
INSERT INTO `sessions` VALUES ('5811b971612cd0-85464432',1477556593,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY1OTM7fQ==');
INSERT INTO `sessions` VALUES ('5811ba29577fe3-56031418',1477556777,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY3Nzc7fQ==');
INSERT INTO `sessions` VALUES ('5811ba32a93ff3-03135068',1477556786,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY3ODY7fQ==');
INSERT INTO `sessions` VALUES ('5811ba4c016438-33276667',1477556812,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NTY4MTI7fQ==');
INSERT INTO `sessions` VALUES ('5811d18ea93413-09195969',1477562766,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjI3NjY7fQ==');
INSERT INTO `sessions` VALUES ('5811d1e4a10ce2-32039411',1477562852,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjI4NTI7fQ==');
INSERT INTO `sessions` VALUES ('5811d1e8e15f72-13090827',1477562856,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjI4NTY7fQ==');
INSERT INTO `sessions` VALUES ('5811d1f97104f5-13033710',1477562873,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjI4NzM7fQ==');
INSERT INTO `sessions` VALUES ('5811d23019d034-73480869',1477562928,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjI5Mjg7fQ==');
INSERT INTO `sessions` VALUES ('5811d24f126bc6-66161353',1477562959,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjI5NTk7fQ==');
INSERT INTO `sessions` VALUES ('5811d54b32e8c4-14432504',1477563723,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjM3MjM7fQ==');
INSERT INTO `sessions` VALUES ('5811d86f2a2d69-14011888',1477564527,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjQ1Mjc7fQ==');
INSERT INTO `sessions` VALUES ('5811d88109ce77-41969750',1477564545,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjQ1NDU7fQ==');
INSERT INTO `sessions` VALUES ('5811d88b8effa2-54692026',1477564555,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjQ1NTU7fQ==');
INSERT INTO `sessions` VALUES ('5811d891ec8158-69194656',1477564561,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjQ1NjE7fQ==');
INSERT INTO `sessions` VALUES ('5811d8bc8f84e3-14756878',1477564604,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjQ2MDQ7fQ==');
INSERT INTO `sessions` VALUES ('5811d8c617a306-27787679',1477564614,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjQ2MTQ7fQ==');
INSERT INTO `sessions` VALUES ('5811d8aa4854f2-48597110',1477564586,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjQ1ODY7fQ==');
INSERT INTO `sessions` VALUES ('5811e18fe72948-19769356',1477566864,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjY4NjQ7fQ==');
INSERT INTO `sessions` VALUES ('5811e1b77a38e9-52568093',1477566903,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjY5MDM7fQ==');
INSERT INTO `sessions` VALUES ('5811e1f3b43a57-11946161',1477566963,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjY5NjM7fQ==');
INSERT INTO `sessions` VALUES ('5811e1fcd332f5-54327549',1477566972,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjY5NzI7fQ==');
INSERT INTO `sessions` VALUES ('5811e230b4afc6-55319923',1477567024,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NjcwMjQ7fQ==');
INSERT INTO `sessions` VALUES ('5811ee3509c339-74715929',1477570101,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzAxMDE7fQ==');
INSERT INTO `sessions` VALUES ('5811f187e351a1-11371886',1477570952,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzA5NTI7fQ==');
INSERT INTO `sessions` VALUES ('5811fb4cc14540-24304476',1477573452,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM0NTI7fQ==');
INSERT INTO `sessions` VALUES ('5811fbf81c1412-66561844',1477573624,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM2MjQ7fQ==');
INSERT INTO `sessions` VALUES ('5811fc33b1a243-97403448',1477573683,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM2ODM7fQ==');
INSERT INTO `sessions` VALUES ('5811fc41e721b3-83758095',1477573697,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM2OTc7fQ==');
INSERT INTO `sessions` VALUES ('5811fc65edeb75-52563193',1477573734,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM3MzQ7fQ==');
INSERT INTO `sessions` VALUES ('5811fc831f7f90-37321900',1477573763,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM3NjM7fQ==');
INSERT INTO `sessions` VALUES ('5811fc933139b7-26619926',1477573779,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM3Nzk7fQ==');
INSERT INTO `sessions` VALUES ('5811fca85a0341-52013298',1477573800,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM4MDA7fQ==');
INSERT INTO `sessions` VALUES ('5811fcb18b6a91-25728540',1477573809,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM4MDk7fQ==');
INSERT INTO `sessions` VALUES ('5811fcb892dd53-43951848',1477573816,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM4MTY7fQ==');
INSERT INTO `sessions` VALUES ('5811fcd53373f6-93883085',1477573845,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM4NDU7fQ==');
INSERT INTO `sessions` VALUES ('5811fcefd1d827-04494520',1477573871,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM4NzE7fQ==');
INSERT INTO `sessions` VALUES ('5811fd09d82c92-59761636',1477573897,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM4OTc7fQ==');
INSERT INTO `sessions` VALUES ('5811fd3c422067-19902269',1477573948,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM5NDg7fQ==');
INSERT INTO `sessions` VALUES ('5811fd3ee21a24-20496245',1477573950,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM5NTA7fQ==');
INSERT INTO `sessions` VALUES ('5811fd5922d9c2-32366429',1477573977,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM5Nzc7fQ==');
INSERT INTO `sessions` VALUES ('5811fd69df2739-88676821',1477573993,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzM5OTM7fQ==');
INSERT INTO `sessions` VALUES ('5811fda0571640-17041807',1477574048,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzQwNDg7fQ==');
INSERT INTO `sessions` VALUES ('5811fdeec0e2e5-08801150',1477574126,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzQxMjY7fQ==');
INSERT INTO `sessions` VALUES ('5811fe00ca5424-08899402',1477574144,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzQxNDQ7fQ==');
INSERT INTO `sessions` VALUES ('5811fe23b9db32-02061752',1477574179,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzQxNzk7fQ==');
INSERT INTO `sessions` VALUES ('5811fe36ed0d99-05019379',1477574199,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1NzQxOTk7fQ==');
INSERT INTO `sessions` VALUES ('58120f2221dee7-27067928',1477578530,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc1Nzg1MzA7fQ==');
INSERT INTO `sessions` VALUES ('5812f0fb3a4f68-26103992',1477636347,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzYzNDc7fQ==');
INSERT INTO `sessions` VALUES ('5812f46dd8a849-12596905',1477637230,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzcyMzA7fQ==');
INSERT INTO `sessions` VALUES ('5812f48ca9a1f0-66467511',1477637260,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzcyNjA7fQ==');
INSERT INTO `sessions` VALUES ('5812f492424dc7-49140471',1477637266,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzcyNjY7fQ==');
INSERT INTO `sessions` VALUES ('5812f4a00cd794-72765215',1477637280,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzcyODA7fQ==');
INSERT INTO `sessions` VALUES ('5812f4ac82c994-75569507',1477637292,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzcyOTI7fQ==');
INSERT INTO `sessions` VALUES ('5812f4bee12c92-41150189',1477637310,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzczMTA7fQ==');
INSERT INTO `sessions` VALUES ('5812f4e4193475-83419246',1477637348,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2MzczNDg7fQ==');
INSERT INTO `sessions` VALUES ('5812f53c7377f8-04023410',1477637436,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2Mzc0MzY7fQ==');
INSERT INTO `sessions` VALUES ('5812f547838820-76633553',1477637447,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2Mzc0NDc7fQ==');
INSERT INTO `sessions` VALUES ('5812f54bb11309-84544816',1477637451,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2Mzc0NTE7fQ==');
INSERT INTO `sessions` VALUES ('5812f578411350-80007292',1477637496,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2Mzc0OTY7fQ==');
INSERT INTO `sessions` VALUES ('5812f59bba14f1-54402940',1477637531,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2Mzc1MzE7fQ==');
INSERT INTO `sessions` VALUES ('5812f5a40eb673-66670511',1477637540,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2Mzc1NDA7fQ==');
INSERT INTO `sessions` VALUES ('5813027c3e16f8-64995362',1477640828,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDA4Mjg7fQ==');
INSERT INTO `sessions` VALUES ('5813028414fe21-27529830',1477640836,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDA4MzY7fQ==');
INSERT INTO `sessions` VALUES ('581302bf46d290-82673321',1477640895,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDA4OTU7fQ==');
INSERT INTO `sessions` VALUES ('581302e898a4b0-30239417',1477640936,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDA5MzY7fQ==');
INSERT INTO `sessions` VALUES ('58130329df1f50-40281929',1477641002,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDEwMDI7fQ==');
INSERT INTO `sessions` VALUES ('581307851a25c5-80746796',1477642117,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDIxMTc7fQ==');
INSERT INTO `sessions` VALUES ('58130793e6fcd2-03901169',1477642131,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDIxMzE7fQ==');
INSERT INTO `sessions` VALUES ('581307bd4f6f05-02256333',1477642173,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDIxNzM7fQ==');
INSERT INTO `sessions` VALUES ('581307d28c6872-67136951',1477642194,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDIxOTQ7fQ==');
INSERT INTO `sessions` VALUES ('581307d84f5537-37173613',1477642200,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDIyMDA7fQ==');
INSERT INTO `sessions` VALUES ('58130928275694-74335828',1477642536,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDI1MzY7fQ==');
INSERT INTO `sessions` VALUES ('58130954636320-43384902',1477642580,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDI1ODA7fQ==');
INSERT INTO `sessions` VALUES ('58130b7f647633-35586820',1477643135,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDMxMzU7fQ==');
INSERT INTO `sessions` VALUES ('58130b9081b844-70391062',1477643152,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDMxNTI7fQ==');
INSERT INTO `sessions` VALUES ('58130bf5e56ba4-28011949',1477643253,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDMyNTM7fQ==');
INSERT INTO `sessions` VALUES ('58130c0d89d765-83725863',1477643277,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDMyNzc7fQ==');
INSERT INTO `sessions` VALUES ('58130c216f5cf5-92415108',1477643297,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDMyOTc7fQ==');
INSERT INTO `sessions` VALUES ('58130c5d925035-21468596',1477643357,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDMzNTc7fQ==');
INSERT INTO `sessions` VALUES ('58130c8bb3d395-40713452',1477643403,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDM0MDM7fQ==');
INSERT INTO `sessions` VALUES ('58130cae5c7364-34211183',1477643438,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDM0Mzg7fQ==');
INSERT INTO `sessions` VALUES ('58130ccb121d37-43990422',1477643467,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDM0Njc7fQ==');
INSERT INTO `sessions` VALUES ('58130cea874480-36677124',1477643498,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDM0OTg7fQ==');
INSERT INTO `sessions` VALUES ('58130d003b83c1-34980564',1477643520,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NDM1MjA7fQ==');
INSERT INTO `sessions` VALUES ('58132a00368822-03586329',1477650944,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTA5NDQ7fQ==');
INSERT INTO `sessions` VALUES ('581338a2c18070-06952319',1477654690,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTQ2OTA7fQ==');
INSERT INTO `sessions` VALUES ('581338a78a2a89-53868230',1477654695,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTQ2OTU7fQ==');
INSERT INTO `sessions` VALUES ('581338fdc430c0-41242686',1477654782,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTQ3ODI7fQ==');
INSERT INTO `sessions` VALUES ('58133bb0086238-98963487',1477655472,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU0NzI7fQ==');
INSERT INTO `sessions` VALUES ('58133bc4e3b243-16672222',1477655492,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU0OTI7fQ==');
INSERT INTO `sessions` VALUES ('58133bcfb66bf8-81977153',1477655503,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU1MDM7fQ==');
INSERT INTO `sessions` VALUES ('58133bda8646e1-46284580',1477655514,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU1MTQ7fQ==');
INSERT INTO `sessions` VALUES ('58133c079c9045-04796426',1477655559,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU1NTk7fQ==');
INSERT INTO `sessions` VALUES ('58133c4b29f8c9-30518391',1477655627,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU2Mjc7fQ==');
INSERT INTO `sessions` VALUES ('58133c536ca890-42442327',1477655635,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU2MzU7fQ==');
INSERT INTO `sessions` VALUES ('58133c9d15a983-64359763',1477655709,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU3MDk7fQ==');
INSERT INTO `sessions` VALUES ('58133cbbc2a092-61848217',1477655739,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU3Mzk7fQ==');
INSERT INTO `sessions` VALUES ('58133d17665630-97318180',1477655831,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU4MzE7fQ==');
INSERT INTO `sessions` VALUES ('58133d25290f70-34255590',1477655845,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU4NDU7fQ==');
INSERT INTO `sessions` VALUES ('58133d3667d175-47547651',1477655862,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU4NjI7fQ==');
INSERT INTO `sessions` VALUES ('58133d5312ff96-09769321',1477655891,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU4OTE7fQ==');
INSERT INTO `sessions` VALUES ('58133d9329a646-73823643',1477655955,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU5NTU7fQ==');
INSERT INTO `sessions` VALUES ('58133dab60aa57-92430505',1477655979,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTU5Nzk7fQ==');
INSERT INTO `sessions` VALUES ('58133dca0d07e1-67553098',1477656010,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTYwMTA7fQ==');
INSERT INTO `sessions` VALUES ('58133dd6109da4-02626141',1477656022,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTYwMjI7fQ==');
INSERT INTO `sessions` VALUES ('58133de2085a68-05160684',1477656034,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTYwMzQ7fQ==');
INSERT INTO `sessions` VALUES ('58133ded87bae4-27277090',1477656045,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTYwNDU7fQ==');
INSERT INTO `sessions` VALUES ('58133e080d63e8-58044079',1477656072,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTYwNzI7fQ==');
INSERT INTO `sessions` VALUES ('58133e0b5631c7-17416533',1477656075,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTYwNzU7fQ==');
INSERT INTO `sessions` VALUES ('58133e10d80398-21920915',1477656080,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTYwODA7fQ==');
INSERT INTO `sessions` VALUES ('58133ff9bee353-20185718',1477656569,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY1Njk7fQ==');
INSERT INTO `sessions` VALUES ('5813400bdb0c04-44712259',1477656587,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY1ODc7fQ==');
INSERT INTO `sessions` VALUES ('5813404a48e220-86693105',1477656650,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY2NTA7fQ==');
INSERT INTO `sessions` VALUES ('5813404eac8459-96143422',1477656654,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY2NTQ7fQ==');
INSERT INTO `sessions` VALUES ('581340609018f2-13141628',1477656672,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY2NzI7fQ==');
INSERT INTO `sessions` VALUES ('5813415ea8bd68-35431154',1477656926,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY5MjY7fQ==');
INSERT INTO `sessions` VALUES ('58134160f18d14-77330070',1477656929,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY5Mjk7fQ==');
INSERT INTO `sessions` VALUES ('58134178cfa941-55848123',1477656952,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY5NTI7fQ==');
INSERT INTO `sessions` VALUES ('58134187ab7d61-63703413',1477656967,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY5Njc7fQ==');
INSERT INTO `sessions` VALUES ('581341984d2e88-10530096',1477656984,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTY5ODQ7fQ==');
INSERT INTO `sessions` VALUES ('5813431a72c709-61414246',1477657371,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTczNzE7fQ==');
INSERT INTO `sessions` VALUES ('581343283a5212-83265261',1477657385,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTczODU7fQ==');
INSERT INTO `sessions` VALUES ('58134339924b73-84574027',1477657401,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc0MDE7fQ==');
INSERT INTO `sessions` VALUES ('5813435fd231c9-66636445',1477657439,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc0Mzk7fQ==');
INSERT INTO `sessions` VALUES ('58134362d03dd6-42533911',1477657442,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc0NDI7fQ==');
INSERT INTO `sessions` VALUES ('58134384828147-01486188',1477657476,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc0NzY7fQ==');
INSERT INTO `sessions` VALUES ('581343da561566-23622638',1477657562,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc1NjI7fQ==');
INSERT INTO `sessions` VALUES ('581343ea4c6a85-44587519',1477657578,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc1Nzg7fQ==');
INSERT INTO `sessions` VALUES ('58134404643095-82493912',1477657604,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc2MDQ7fQ==');
INSERT INTO `sessions` VALUES ('581344486245e9-62784921',1477657672,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc2NzI7fQ==');
INSERT INTO `sessions` VALUES ('5813445d1d9a32-34535819',1477657693,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc2OTM7fQ==');
INSERT INTO `sessions` VALUES ('581344980dafa2-25816620',1477657752,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc3NTI7fQ==');
INSERT INTO `sessions` VALUES ('581344a8f0ee16-71968124',1477657769,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc3Njk7fQ==');
INSERT INTO `sessions` VALUES ('581344d89bb081-92140223',1477657816,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc4MTY7fQ==');
INSERT INTO `sessions` VALUES ('5813450ecfb570-63052114',1477657870,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc4NzA7fQ==');
INSERT INTO `sessions` VALUES ('58134511875008-03210292',1477657873,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc4NzM7fQ==');
INSERT INTO `sessions` VALUES ('58134522c65916-73094074',1477657890,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc4OTA7fQ==');
INSERT INTO `sessions` VALUES ('581345587c0b06-16273056',1477657944,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTc5NDQ7fQ==');
INSERT INTO `sessions` VALUES ('5813475d78d853-53368309',1477658461,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTg0NjE7fQ==');
INSERT INTO `sessions` VALUES ('58134773449f88-48525663',1477658483,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTg0ODM7fQ==');
INSERT INTO `sessions` VALUES ('581347808199e3-21051661',1477658496,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTg0OTY7fQ==');
INSERT INTO `sessions` VALUES ('58134792a9aa94-61656991',1477658514,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTg1MTQ7fQ==');
INSERT INTO `sessions` VALUES ('581347ad659835-73121735',1477658541,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTg1NDE7fQ==');
INSERT INTO `sessions` VALUES ('581347c9e219c5-67896781',1477658569,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTg1Njk7fQ==');
INSERT INTO `sessions` VALUES ('58134a15f0bc71-90965819',1477659158,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkxNTg7fQ==');
INSERT INTO `sessions` VALUES ('58134a4ed20095-89708315',1477659214,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkyMTQ7fQ==');
INSERT INTO `sessions` VALUES ('58134a68a29075-89176574',1477659240,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkyNDA7fQ==');
INSERT INTO `sessions` VALUES ('58134a6e8de962-78348942',1477659246,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkyNDY7fQ==');
INSERT INTO `sessions` VALUES ('58134a73cf6ad0-64100880',1477659251,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkyNTE7fQ==');
INSERT INTO `sessions` VALUES ('58134a7b9aec90-93337526',1477659259,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkyNTk7fQ==');
INSERT INTO `sessions` VALUES ('58134a7e0ed209-62907570',1477659262,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkyNjI7fQ==');
INSERT INTO `sessions` VALUES ('58134aa4aeb129-96118269',1477659300,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc2NTkzMDA7fQ==');
INSERT INTO `sessions` VALUES ('5816edb4dd4708-17263486',1477897653,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc2NTM7fQ==');
INSERT INTO `sessions` VALUES ('5816edfa29be63-82610758',1477897722,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc3MjI7fQ==');
INSERT INTO `sessions` VALUES ('5816ee36c19032-67369306',1477897782,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc3ODI7fQ==');
INSERT INTO `sessions` VALUES ('5816ee55967fd2-23165132',1477897813,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc4MTM7fQ==');
INSERT INTO `sessions` VALUES ('5816ee605a9cf3-75538902',1477897824,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc4MjQ7fQ==');
INSERT INTO `sessions` VALUES ('5816ee7807ec78-35534716',1477897848,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc4NDg7fQ==');
INSERT INTO `sessions` VALUES ('5816eeb2aab482-88466997',1477897906,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc5MDY7fQ==');
INSERT INTO `sessions` VALUES ('5816eed9efb901-38952700',1477897946,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc5NDY7fQ==');
INSERT INTO `sessions` VALUES ('5816eeff2c6be0-27172448',1477897983,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTc5ODM7fQ==');
INSERT INTO `sessions` VALUES ('5816ef5fa9d3d6-36820424',1477898079,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgwNzk7fQ==');
INSERT INTO `sessions` VALUES ('5816ef72cb5d06-98417018',1477898098,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgwOTg7fQ==');
INSERT INTO `sessions` VALUES ('5816ef7f763d40-08320397',1477898111,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgxMTE7fQ==');
INSERT INTO `sessions` VALUES ('5816ef9c3308e1-20724440',1477898140,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgxNDA7fQ==');
INSERT INTO `sessions` VALUES ('5816efa421c024-39552037',1477898148,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgxNDg7fQ==');
INSERT INTO `sessions` VALUES ('5816eff964dcc0-23295212',1477898233,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgyMzM7fQ==');
INSERT INTO `sessions` VALUES ('5816f00fb70dd8-91743161',1477898255,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgyNTU7fQ==');
INSERT INTO `sessions` VALUES ('5816f017b94983-93924535',1477898263,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgyNjM7fQ==');
INSERT INTO `sessions` VALUES ('5816f02a0b7584-25600819',1477898282,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgyODI7fQ==');
INSERT INTO `sessions` VALUES ('5816f03ebaf222-66813809',1477898302,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTgzMDI7fQ==');
INSERT INTO `sessions` VALUES ('5816f276b77aa7-30313153',1477898870,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTg4NzA7fQ==');
INSERT INTO `sessions` VALUES ('5816f28d1a77c3-04019597',1477898893,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTg4OTM7fQ==');
INSERT INTO `sessions` VALUES ('5816f292bb1f00-82010780',1477898898,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTg4OTg7fQ==');
INSERT INTO `sessions` VALUES ('5816f2e0f0aa44-12902684',1477898977,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTg5Nzc7fQ==');
INSERT INTO `sessions` VALUES ('5816f2f4d21b45-42737124',1477898996,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTg5OTY7fQ==');
INSERT INTO `sessions` VALUES ('5816f300292657-05257012',1477899008,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTkwMDg7fQ==');
INSERT INTO `sessions` VALUES ('5816f3092c4fb9-43453656',1477899017,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTkwMTc7fQ==');
INSERT INTO `sessions` VALUES ('5816f32bf009d0-11656542',1477899052,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTkwNTI7fQ==');
INSERT INTO `sessions` VALUES ('5816f453511e41-65832710',1477899347,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTkzNDc7fQ==');
INSERT INTO `sessions` VALUES ('5816f4702ce064-92079805',1477899376,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTkzNzY7fQ==');
INSERT INTO `sessions` VALUES ('5816f48003c163-72569998',1477899392,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTkzOTI7fQ==');
INSERT INTO `sessions` VALUES ('5816f4a94d36a0-43285518',1477899433,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk0MzM7fQ==');
INSERT INTO `sessions` VALUES ('5816f4d903b5c2-42216348',1477899481,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk0ODE7fQ==');
INSERT INTO `sessions` VALUES ('5816f4f805e7d9-74491320',1477899512,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk1MTI7fQ==');
INSERT INTO `sessions` VALUES ('5816f51fe31480-62109947',1477899551,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk1NTE7fQ==');
INSERT INTO `sessions` VALUES ('5816f548132419-62256689',1477899592,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk1OTI7fQ==');
INSERT INTO `sessions` VALUES ('5816f5569c74f4-72145016',1477899606,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk2MDY7fQ==');
INSERT INTO `sessions` VALUES ('5816f5666db108-16457887',1477899622,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk2MjI7fQ==');
INSERT INTO `sessions` VALUES ('5816f577772aa4-21754867',1477899639,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc4OTk2Mzk7fQ==');
INSERT INTO `sessions` VALUES ('5816f7e59d9ff0-00398790',1477900261,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDAyNjE7fQ==');
INSERT INTO `sessions` VALUES ('5816f7efc57b05-77282463',1477900271,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDAyNzE7fQ==');
INSERT INTO `sessions` VALUES ('5816f8155ed4e5-54256329',1477900309,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDAzMDk7fQ==');
INSERT INTO `sessions` VALUES ('5816f83426bcd0-19778661',1477900340,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDAzNDA7fQ==');
INSERT INTO `sessions` VALUES ('5816f84218c361-42216255',1477900354,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDAzNTQ7fQ==');
INSERT INTO `sessions` VALUES ('5816f892a49df4-57282060',1477900434,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA0MzQ7fQ==');
INSERT INTO `sessions` VALUES ('5816f8a1dc8350-58557762',1477900449,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA0NDk7fQ==');
INSERT INTO `sessions` VALUES ('5816f8a9da2e44-75719252',1477900457,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA0NTc7fQ==');
INSERT INTO `sessions` VALUES ('5816f8b317fa86-95103316',1477900467,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA0Njc7fQ==');
INSERT INTO `sessions` VALUES ('5816f8d62589d1-49139840',1477900502,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA1MDI7fQ==');
INSERT INTO `sessions` VALUES ('5816f8f2d07ba7-81445989',1477900530,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA1MzA7fQ==');
INSERT INTO `sessions` VALUES ('5816f926f3e0b2-23727115',1477900583,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA1ODM7fQ==');
INSERT INTO `sessions` VALUES ('5816f94294d3c0-44967162',1477900610,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA2MTA7fQ==');
INSERT INTO `sessions` VALUES ('5816f9572d6cb3-87484659',1477900631,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA2MzE7fQ==');
INSERT INTO `sessions` VALUES ('5816f97b210570-06719585',1477900667,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA2Njc7fQ==');
INSERT INTO `sessions` VALUES ('5816f9cb225c98-11935228',1477900747,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA3NDc7fQ==');
INSERT INTO `sessions` VALUES ('5816f9ee93c205-03521826',1477900782,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA3ODI7fQ==');
INSERT INTO `sessions` VALUES ('5816f9f6a1a658-89250789',1477900790,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA3OTA7fQ==');
INSERT INTO `sessions` VALUES ('5816fa0111d042-14921577',1477900801,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA4MDE7fQ==');
INSERT INTO `sessions` VALUES ('5816fa1418ade4-62396947',1477900820,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA4MjA7fQ==');
INSERT INTO `sessions` VALUES ('5816fa3480e784-66687107',1477900852,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA4NTI7fQ==');
INSERT INTO `sessions` VALUES ('5816fa482385b4-21362745',1477900872,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA4NzI7fQ==');
INSERT INTO `sessions` VALUES ('5816fa5b9d5ce2-21395865',1477900891,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA4OTE7fQ==');
INSERT INTO `sessions` VALUES ('5816fa67669243-20805030',1477900903,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA5MDM7fQ==');
INSERT INTO `sessions` VALUES ('5816fa86a01c44-36313527',1477900934,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDA5MzQ7fQ==');
INSERT INTO `sessions` VALUES ('5816faf85a4854-75578715',1477901048,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDEwNDg7fQ==');
INSERT INTO `sessions` VALUES ('5816fb15d97406-08842072',1477901077,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDEwNzc7fQ==');
INSERT INTO `sessions` VALUES ('5816fb3573e166-83532125',1477901109,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDExMDk7fQ==');
INSERT INTO `sessions` VALUES ('5816fb977e6368-07394113',1477901207,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDEyMDc7fQ==');
INSERT INTO `sessions` VALUES ('5816fbaa6f6020-49442607',1477901226,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDEyMjY7fQ==');
INSERT INTO `sessions` VALUES ('5816fc2e914903-20038954',1477901358,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDEzNTg7fQ==');
INSERT INTO `sessions` VALUES ('5816fc40274f84-80057545',1477901376,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDEzNzY7fQ==');
INSERT INTO `sessions` VALUES ('5816fc612c5558-41626088',1477901409,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDE0MDk7fQ==');
INSERT INTO `sessions` VALUES ('5816fc6c58ff17-24690467',1477901420,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDE0MjA7fQ==');
INSERT INTO `sessions` VALUES ('581709e54461e0-04382142',1477904869,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDQ4Njk7fQ==');
INSERT INTO `sessions` VALUES ('581710fd597ad6-89664381',1477906685,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MDY2ODU7fQ==');
INSERT INTO `sessions` VALUES ('58172735f124d2-99934133',1477912374,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTIzNzQ7fQ==');
INSERT INTO `sessions` VALUES ('581727fc7b2583-17839646',1477912572,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTI1NzI7fQ==');
INSERT INTO `sessions` VALUES ('581728230fa176-02859748',1477912611,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTI2MTE7fQ==');
INSERT INTO `sessions` VALUES ('58172bbaabd2b8-48150885',1477913530,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTM1MzA7fQ==');
INSERT INTO `sessions` VALUES ('58172bd6e90468-56388183',1477913558,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTM1NTg7fQ==');
INSERT INTO `sessions` VALUES ('58173339b62b56-76307570',1477915450,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTU0NTA7fQ==');
INSERT INTO `sessions` VALUES ('5817350b6c72d6-39160175',1477915915,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTU5MTU7fQ==');
INSERT INTO `sessions` VALUES ('58173a9a85d288-11152233',1477917338,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTczMzg7fQ==');
INSERT INTO `sessions` VALUES ('58173ab0dd5f61-29217132',1477917360,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTczNjA7fQ==');
INSERT INTO `sessions` VALUES ('58173ab86e8232-42972986',1477917368,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTczNjg7fQ==');
INSERT INTO `sessions` VALUES ('58173ac1b96cd9-72147742',1477917377,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTczNzc7fQ==');
INSERT INTO `sessions` VALUES ('58173accc7b612-77922659',1477917388,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTczODg7fQ==');
INSERT INTO `sessions` VALUES ('58173ad3766d94-15051032',1477917395,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTczOTU7fQ==');
INSERT INTO `sessions` VALUES ('58173b04e3e280-64898874',1477917444,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTc0NDQ7fQ==');
INSERT INTO `sessions` VALUES ('58173b47e24e97-30900898',1477917511,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTc1MTE7fQ==');
INSERT INTO `sessions` VALUES ('58173b67c4d6e7-35712964',1477917543,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTc1NDM7fQ==');
INSERT INTO `sessions` VALUES ('5817439a018a78-73293491',1477919642,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTk2NDI7fQ==');
INSERT INTO `sessions` VALUES ('5817446c85a238-46232653',1477919852,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTk4NTI7fQ==');
INSERT INTO `sessions` VALUES ('5817447ae16c10-44386251',1477919866,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTk4NjY7fQ==');
INSERT INTO `sessions` VALUES ('5817448f4bd180-54107789',1477919887,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MTk4ODc7fQ==');
INSERT INTO `sessions` VALUES ('58174634d5eb10-41702057',1477920308,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjAzMDg7fQ==');
INSERT INTO `sessions` VALUES ('5817465935b6c5-84187616',1477920345,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjAzNDU7fQ==');
INSERT INTO `sessions` VALUES ('58174799312507-60016352',1477920665,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjA2NjU7fQ==');
INSERT INTO `sessions` VALUES ('58174885c3afb1-72858232',1477920901,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjA5MDE7fQ==');
INSERT INTO `sessions` VALUES ('58174894d34f88-32534542',1477920916,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjA5MTY7fQ==');
INSERT INTO `sessions` VALUES ('58174925d30966-95295228',1477921062,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjEwNjI7fQ==');
INSERT INTO `sessions` VALUES ('581749568be444-67705997',1477921110,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjExMTA7fQ==');
INSERT INTO `sessions` VALUES ('5817495f7bb779-01649447',1477921119,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjExMTk7fQ==');
INSERT INTO `sessions` VALUES ('5817499cb99a07-45329998',1477921180,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjExODA7fQ==');
INSERT INTO `sessions` VALUES ('581749b2833163-16427406',1477921202,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjEyMDI7fQ==');
INSERT INTO `sessions` VALUES ('581749bd3e43c5-14536825',1477921213,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjEyMTM7fQ==');
INSERT INTO `sessions` VALUES ('58174a3a59c796-60450041',1477921338,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjEzMzg7fQ==');
INSERT INTO `sessions` VALUES ('58174a8010cb59-53050463',1477921408,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjE0MDg7fQ==');
INSERT INTO `sessions` VALUES ('58174ceec07595-81755930',1477922030,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjIwMzA7fQ==');
INSERT INTO `sessions` VALUES ('5817561dbce294-06065489',1477924381,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjQzODE7fQ==');
INSERT INTO `sessions` VALUES ('581756c5dc7198-80100378',1477924550,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjQ1NTA7fQ==');
INSERT INTO `sessions` VALUES ('581756d02af650-56946642',1477924560,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjQ1NjA7fQ==');
INSERT INTO `sessions` VALUES ('581756d95dacf6-28264719',1477924569,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjQ1Njk7fQ==');
INSERT INTO `sessions` VALUES ('581756e66e7229-71578865',1477924582,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjQ1ODI7fQ==');
INSERT INTO `sessions` VALUES ('5817570b3d5bc2-85537358',1477924619,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjQ2MTk7fQ==');
INSERT INTO `sessions` VALUES ('58175b8fdc31a8-18000431',1477925776,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5MjU3NzY7fQ==');
INSERT INTO `sessions` VALUES ('5818467fe689c5-54283040',1477985920,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODU5MjA7fQ==');
INSERT INTO `sessions` VALUES ('581846848b6d00-28614804',1477985924,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODU5MjQ7fQ==');
INSERT INTO `sessions` VALUES ('5818468daa9ce4-19693886',1477985933,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODU5MzM7fQ==');
INSERT INTO `sessions` VALUES ('581846bd9363d2-95170019',1477985981,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODU5ODE7fQ==');
INSERT INTO `sessions` VALUES ('581846ffc811d8-05739796',1477986048,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYwNDg7fQ==');
INSERT INTO `sessions` VALUES ('5818473e82d496-34679049',1477986110,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYxMTA7fQ==');
INSERT INTO `sessions` VALUES ('5818479a823ce6-07350983',1477986202,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYyMDI7fQ==');
INSERT INTO `sessions` VALUES ('581847b68e4052-93083268',1477986230,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYyMzA7fQ==');
INSERT INTO `sessions` VALUES ('581847c32ef656-02472314',1477986243,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYyNDM7fQ==');
INSERT INTO `sessions` VALUES ('58184849dd7494-55841554',1477986378,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYzNzg7fQ==');
INSERT INTO `sessions` VALUES ('5818484dd5e333-45411056',1477986381,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYzODE7fQ==');
INSERT INTO `sessions` VALUES ('58184852e98b83-57596564',1477986387,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODYzODc7fQ==');
INSERT INTO `sessions` VALUES ('5818487848e235-41393266',1477986424,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY0MjQ7fQ==');
INSERT INTO `sessions` VALUES ('581848947d6d99-72929947',1477986452,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY0NTI7fQ==');
INSERT INTO `sessions` VALUES ('581848c9773916-61184554',1477986505,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY1MDU7fQ==');
INSERT INTO `sessions` VALUES ('581848fc054b43-12452404',1477986556,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY1NTY7fQ==');
INSERT INTO `sessions` VALUES ('58184902a996c2-18804428',1477986562,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY1NjI7fQ==');
INSERT INTO `sessions` VALUES ('5818493ccd80b5-69263590',1477986620,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY2MjA7fQ==');
INSERT INTO `sessions` VALUES ('5818495687f860-46502406',1477986646,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY2NDY7fQ==');
INSERT INTO `sessions` VALUES ('58184972b5f1b2-29913506',1477986674,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY2NzQ7fQ==');
INSERT INTO `sessions` VALUES ('5818499ea79271-66249743',1477986718,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY3MTg7fQ==');
INSERT INTO `sessions` VALUES ('581849bab661a3-41899215',1477986746,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY3NDY7fQ==');
INSERT INTO `sessions` VALUES ('58184a5d253925-92235751',1477986909,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODY5MDk7fQ==');
INSERT INTO `sessions` VALUES ('58184b9cdcc3c8-36904746',1477987229,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODcyMjk7fQ==');
INSERT INTO `sessions` VALUES ('58185064eba915-01804492',1477988453,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg0NTM7fQ==');
INSERT INTO `sessions` VALUES ('581850679df5f8-18185411',1477988455,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg0NTU7fQ==');
INSERT INTO `sessions` VALUES ('58185070b5c409-18759302',1477988464,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg0NjQ7fQ==');
INSERT INTO `sessions` VALUES ('581850dc3aebe6-84793493',1477988572,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg1NzI7fQ==');
INSERT INTO `sessions` VALUES ('581851012e6b16-49327285',1477988609,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg2MDk7fQ==');
INSERT INTO `sessions` VALUES ('5818510490c0b7-56028869',1477988612,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg2MTI7fQ==');
INSERT INTO `sessions` VALUES ('5818510b92df36-13007662',1477988619,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg2MTk7fQ==');
INSERT INTO `sessions` VALUES ('581851e4cedc87-77408573',1477988837,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg4Mzc7fQ==');
INSERT INTO `sessions` VALUES ('581852089d4998-21583715',1477988872,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg4NzI7fQ==');
INSERT INTO `sessions` VALUES ('5818521bc18b65-09709672',1477988891,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg4OTE7fQ==');
INSERT INTO `sessions` VALUES ('581852466a5297-62649115',1477988934,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg5MzQ7fQ==');
INSERT INTO `sessions` VALUES ('5818524883c877-34742819',1477988936,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg5MzY7fQ==');
INSERT INTO `sessions` VALUES ('5818527fd63c63-74754939',1477988991,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODg5OTE7fQ==');
INSERT INTO `sessions` VALUES ('581852b9b61d07-05526451',1477989049,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODkwNDk7fQ==');
INSERT INTO `sessions` VALUES ('5818534c63ace8-83077293',1477989196,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODkxOTY7fQ==');
INSERT INTO `sessions` VALUES ('581854fc7b7e02-21126216',1477989628,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5ODk2Mjg7fQ==');
INSERT INTO `sessions` VALUES ('58185fdcacb526-88503630',1477992412,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzc5OTI0MTI7fQ==');
INSERT INTO `sessions` VALUES ('581885dd4d5d14-43294826',1478002141,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIxNDE7fQ==');
INSERT INTO `sessions` VALUES ('581885f87d0a96-45770858',1478002168,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIxNjg7fQ==');
INSERT INTO `sessions` VALUES ('5818861c921326-34707796',1478002204,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIyMDQ7fQ==');
INSERT INTO `sessions` VALUES ('5818865e8335d2-11752540',1478002270,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIyNzA7fQ==');
INSERT INTO `sessions` VALUES ('581886681bd603-61755360',1478002280,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIyODA7fQ==');
INSERT INTO `sessions` VALUES ('58188670a666d7-81332130',1478002288,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIyODg7fQ==');
INSERT INTO `sessions` VALUES ('5818867679be33-72854507',1478002294,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIyOTQ7fQ==');
INSERT INTO `sessions` VALUES ('58188690922728-16810832',1478002320,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIzMjA7fQ==');
INSERT INTO `sessions` VALUES ('5818869f476d61-18933676',1478002335,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIzMzU7fQ==');
INSERT INTO `sessions` VALUES ('581886a9c39ca3-07823468',1478002345,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIzNDU7fQ==');
INSERT INTO `sessions` VALUES ('581886afca8f12-26971487',1478002351,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIzNTE7fQ==');
INSERT INTO `sessions` VALUES ('581886b9a30b11-93397089',1478002361,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDIzNjE7fQ==');
INSERT INTO `sessions` VALUES ('581886eb106390-13469535',1478002411,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI0MTE7fQ==');
INSERT INTO `sessions` VALUES ('581886f9c0a386-28808621',1478002425,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI0MjU7fQ==');
INSERT INTO `sessions` VALUES ('5818870448af12-96807243',1478002436,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI0MzY7fQ==');
INSERT INTO `sessions` VALUES ('5818870ec40ed3-81564406',1478002446,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI0NDY7fQ==');
INSERT INTO `sessions` VALUES ('58188741e2f418-56353666',1478002497,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI0OTc7fQ==');
INSERT INTO `sessions` VALUES ('5818875a2163e7-65847621',1478002522,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI1MjI7fQ==');
INSERT INTO `sessions` VALUES ('581887bd1cef98-38472976',1478002621,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI2MjE7fQ==');
INSERT INTO `sessions` VALUES ('581887de8a18c6-19879607',1478002654,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDI2NTQ7fQ==');
INSERT INTO `sessions` VALUES ('5818899cc50fd2-93177629',1478003100,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDMxMDA7fQ==');
INSERT INTO `sessions` VALUES ('58188af260c852-38275952',1478003442,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDM0NDI7fQ==');
INSERT INTO `sessions` VALUES ('58188afb495b66-04084997',1478003451,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDM0NTE7fQ==');
INSERT INTO `sessions` VALUES ('58188b2775a4e4-78934575',1478003495,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDM0OTU7fQ==');
INSERT INTO `sessions` VALUES ('58188b5650e9b5-84200409',1478003542,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDM1NDI7fQ==');
INSERT INTO `sessions` VALUES ('58188ea3082f42-75538553',1478004387,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQzODc7fQ==');
INSERT INTO `sessions` VALUES ('58188eb1669cf1-73777632',1478004401,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ0MDE7fQ==');
INSERT INTO `sessions` VALUES ('58188ebbdf4f79-14302633',1478004411,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ0MTE7fQ==');
INSERT INTO `sessions` VALUES ('58188ede0e1170-40093865',1478004446,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ0NDY7fQ==');
INSERT INTO `sessions` VALUES ('58188ee9a508c2-19168735',1478004457,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ0NTc7fQ==');
INSERT INTO `sessions` VALUES ('58188ef8782a55-42510019',1478004472,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ0NzI7fQ==');
INSERT INTO `sessions` VALUES ('58188efcbe40b7-82769002',1478004476,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ0NzY7fQ==');
INSERT INTO `sessions` VALUES ('58188f0c80a298-04383561',1478004492,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ0OTI7fQ==');
INSERT INTO `sessions` VALUES ('58188f1def3bd2-30541970',1478004510,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ1MTA7fQ==');
INSERT INTO `sessions` VALUES ('58188f26f11316-03314247',1478004519,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ1MTk7fQ==');
INSERT INTO `sessions` VALUES ('5818901dd8dc22-64072027',1478004765,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ3NjU7fQ==');
INSERT INTO `sessions` VALUES ('5818903bba9283-01129348',1478004795,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ3OTU7fQ==');
INSERT INTO `sessions` VALUES ('581890520a70c7-06416911',1478004818,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ4MTg7fQ==');
INSERT INTO `sessions` VALUES ('5818909fceaec0-87319604',1478004895,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ4OTU7fQ==');
INSERT INTO `sessions` VALUES ('581890c93a1e36-73943965',1478004937,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDQ5Mzc7fQ==');
INSERT INTO `sessions` VALUES ('581892b4125456-79169324',1478005428,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDU0Mjg7fQ==');
INSERT INTO `sessions` VALUES ('58189435d136a8-83746795',1478005814,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDU4MTQ7fQ==');
INSERT INTO `sessions` VALUES ('5818943bc3e665-04693744',1478005819,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDU4MTk7fQ==');
INSERT INTO `sessions` VALUES ('5818959ab747e3-25992034',1478006170,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDYxNzA7fQ==');
INSERT INTO `sessions` VALUES ('581895a7504b79-07474284',1478006183,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDYxODM7fQ==');
INSERT INTO `sessions` VALUES ('581895bb0a3443-76638734',1478006203,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDYyMDM7fQ==');
INSERT INTO `sessions` VALUES ('581895bfb97630-25173206',1478006207,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDYyMDc7fQ==');
INSERT INTO `sessions` VALUES ('581895de54b515-08255225',1478006238,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDYyMzg7fQ==');
INSERT INTO `sessions` VALUES ('581895e58657e3-38832510',1478006245,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDYyNDU7fQ==');
INSERT INTO `sessions` VALUES ('581895ebaf0af0-30675759',1478006251,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDYyNTE7fQ==');
INSERT INTO `sessions` VALUES ('5818978a5915c3-70367775',1478006666,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDY2NjY7fQ==');
INSERT INTO `sessions` VALUES ('581897dad95379-57913403',1478006747,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDY3NDc7fQ==');
INSERT INTO `sessions` VALUES ('58189a48ed0293-72616164',1478007369,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDczNjk7fQ==');
INSERT INTO `sessions` VALUES ('58189a61edf462-16216049',1478007394,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDczOTQ7fQ==');
INSERT INTO `sessions` VALUES ('58189b1026ca16-20446242',1478007568,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDc1Njg7fQ==');
INSERT INTO `sessions` VALUES ('58189b330c7d61-02302628',1478007603,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDc2MDM7fQ==');
INSERT INTO `sessions` VALUES ('58189b56ac7eb8-93981047',1478007638,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDc2Mzg7fQ==');
INSERT INTO `sessions` VALUES ('58189b6ae1f378-65301497',1478007658,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDc2NTg7fQ==');
INSERT INTO `sessions` VALUES ('58189b71a29f33-14979408',1478007665,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDc2NjU7fQ==');
INSERT INTO `sessions` VALUES ('58189c7d195675-18192612',1478007933,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDc5MzM7fQ==');
INSERT INTO `sessions` VALUES ('58189e64eb8db4-85648159',1478008421,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg0MjE7fQ==');
INSERT INTO `sessions` VALUES ('58189e70b1b090-94942151',1478008432,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg0MzI7fQ==');
INSERT INTO `sessions` VALUES ('58189ebdc191a2-69200337',1478008509,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg1MDk7fQ==');
INSERT INTO `sessions` VALUES ('58189ee443d0f3-70992115',1478008548,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg1NDg7fQ==');
INSERT INTO `sessions` VALUES ('58189f06488d47-66433684',1478008582,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg1ODI7fQ==');
INSERT INTO `sessions` VALUES ('58189f10e8f910-93371020',1478008592,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg1OTI7fQ==');
INSERT INTO `sessions` VALUES ('58189f14710a40-57351177',1478008596,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg1OTY7fQ==');
INSERT INTO `sessions` VALUES ('58189f194ca8e5-10886834',1478008601,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0NzgwMDg2MDE7fQ==');
INSERT INTO `sessions` VALUES ('582ee5ffe2cd40-41323953',1479468757,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0Njg3NTc7fQ==');
INSERT INTO `sessions` VALUES ('582ee6da3051c3-59450419',1479468762,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDY4NzYyO30=');
INSERT INTO `sessions` VALUES ('582ee70e56c815-59217433',1479470256,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDcwMjU2O3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582eecc74fee32-41631169',1479470279,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzAyNzk7fQ==');
INSERT INTO `sessions` VALUES ('582eecc78cbe36-59991442',1479470318,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzAzMTg7fQ==');
INSERT INTO `sessions` VALUES ('582eed3d2c5159-16497567',1479471964,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDcxOTY0O30=');
INSERT INTO `sessions` VALUES ('582ef0cb2e05e4-87794087',1479474244,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0MjQ0O30=');
INSERT INTO `sessions` VALUES ('582ef3f6a2a9a1-56225965',1479472118,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzIxMTg7fQ==');
INSERT INTO `sessions` VALUES ('582ef3f7075211-99545705',1479472119,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzIxMTk7fQ==');
INSERT INTO `sessions` VALUES ('582ef3f877b200-33517343',1479472165,'YTo4OntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzIxNjU7czoxMzoiYWRtaW46dXNlcl9pZCI7czoxOiIzIjtzOjE0OiJmaWxlX3VwbG9hZF9pZCI7aTozO3M6Mzc6IkJhY2tlbmRfUHJvamVjdHNfSXRlbXNfR3JpZC5wYWdlci5udW0iO2k6MTtzOjM4OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0dyaWQucGFnZXIuc2l6ZSI7aToxMDtzOjM4OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0dyaWQuc29ydGVyLmRpciI7TjtzOjM5OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0dyaWQuc29ydGVyLm5hbWUiO047fQ==');
INSERT INTO `sessions` VALUES ('582ef43058f2f3-13211932',1479472176,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDcyMTc2O3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582ef43c3e4b79-00562997',1479472197,'YToxMTp7czoxMToibGFzdF9hY3RpdmUiO2k6MTQ3OTQ3MjE5NztzOjEzOiJhZG1pbjp1c2VyX2lkIjtzOjE6IjMiO3M6MTQ6ImZpbGVfdXBsb2FkX2lkIjtpOjM7czozNzoiQmFja2VuZF9Qcm9qZWN0c19JdGVtc19HcmlkLnBhZ2VyLm51bSI7aToxO3M6Mzg6IkJhY2tlbmRfUHJvamVjdHNfSXRlbXNfR3JpZC5wYWdlci5zaXplIjtpOjEwO3M6Mzg6IkJhY2tlbmRfUHJvamVjdHNfSXRlbXNfR3JpZC5zb3J0ZXIuZGlyIjtOO3M6Mzk6IkJhY2tlbmRfUHJvamVjdHNfSXRlbXNfR3JpZC5zb3J0ZXIubmFtZSI7TjtzOjQ0OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0Jsb2Nrc19HcmlkLnBhZ2VyLm51bSI7aToxO3M6NDU6IkJhY2tlbmRfUHJvamVjdHNfSXRlbXNfQmxvY2tzX0dyaWQucGFnZXIuc2l6ZSI7aToxMDtzOjQ1OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0Jsb2Nrc19HcmlkLnNvcnRlci5kaXIiO047czo0NjoiQmFja2VuZF9Qcm9qZWN0c19JdGVtc19CbG9ja3NfR3JpZC5zb3J0ZXIubmFtZSI7Tjt9');
INSERT INTO `sessions` VALUES ('582ef446c94f13-99184541',1479472242,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDcyMjQyO3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582ef531f1e025-60872536',1479472445,'YToxMTp7czoxMToibGFzdF9hY3RpdmUiO2k6MTQ3OTQ3MjQ0NTtzOjEzOiJhZG1pbjp1c2VyX2lkIjtzOjE6IjMiO3M6MTQ6ImZpbGVfdXBsb2FkX2lkIjtpOjE7czozMToiQmFja2VuZF9BcnRpY2xlc19HcmlkLnBhZ2VyLm51bSI7aToxO3M6MzI6IkJhY2tlbmRfQXJ0aWNsZXNfR3JpZC5wYWdlci5zaXplIjtpOjI1O3M6MzI6IkJhY2tlbmRfQXJ0aWNsZXNfR3JpZC5zb3J0ZXIuZGlyIjtOO3M6MzM6IkJhY2tlbmRfQXJ0aWNsZXNfR3JpZC5zb3J0ZXIubmFtZSI7TjtzOjM4OiJCYWNrZW5kX0FydGljbGVzX0ltYWdlc19HcmlkLnBhZ2VyLm51bSI7aToxO3M6Mzk6IkJhY2tlbmRfQXJ0aWNsZXNfSW1hZ2VzX0dyaWQucGFnZXIuc2l6ZSI7aToxMDtzOjM5OiJCYWNrZW5kX0FydGljbGVzX0ltYWdlc19HcmlkLnNvcnRlci5kaXIiO047czo0MDoiQmFja2VuZF9BcnRpY2xlc19JbWFnZXNfR3JpZC5zb3J0ZXIubmFtZSI7Tjt9');
INSERT INTO `sessions` VALUES ('582ef545044164-25801547',1479472791,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzI3OTE7fQ==');
INSERT INTO `sessions` VALUES ('582ef69b75fbd2-41075036',1479474134,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzQxMzQ7fQ==');
INSERT INTO `sessions` VALUES ('582efbdb59d208-67908014',1479474141,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0MTQxO30=');
INSERT INTO `sessions` VALUES ('582efbe5a71b54-47979662',1479474338,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0MzM4O3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582efcab23d235-81846159',1479474350,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0MzUwO3M6MTM6ImFkbWluOnVzZXJfaWQiO3M6MToiMyI7fQ==');
INSERT INTO `sessions` VALUES ('582efcaff0eb00-44362064',1479474352,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0MzUyO30=');
INSERT INTO `sessions` VALUES ('582efcb1a619c4-69656847',1479474355,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0MzU1O3M6MTM6ImFkbWluOnVzZXJfaWQiO3M6MToiMyI7fQ==');
INSERT INTO `sessions` VALUES ('582efcbe8b1335-65690009',1479474419,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0NDE5O3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582efcfdce6138-57937912',1479474570,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0NTcwO3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582efd901183f0-82558578',1479474587,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc0NTg3O3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582efeb993c0e5-02619276',1479474873,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzQ4NzM7fQ==');
INSERT INTO `sessions` VALUES ('582efeb9d587a4-65511716',1479475283,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzUyODM7fQ==');
INSERT INTO `sessions` VALUES ('582f00251d0f09-49311814',1479475276,'YToxNjp7czo2OiJjYXRfaWQiO2k6MDtzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc1Mjc2O3M6MTM6ImFkbWluOnVzZXJfaWQiO3M6MToiMyI7czoxNDoiZmlsZV91cGxvYWRfaWQiO2k6NDtzOjM3OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0dyaWQucGFnZXIubnVtIjtpOjE7czozODoiQmFja2VuZF9Qcm9qZWN0c19JdGVtc19HcmlkLnBhZ2VyLnNpemUiO2k6MTA7czozODoiQmFja2VuZF9Qcm9qZWN0c19JdGVtc19HcmlkLnNvcnRlci5kaXIiO047czozOToiQmFja2VuZF9Qcm9qZWN0c19JdGVtc19HcmlkLnNvcnRlci5uYW1lIjtOO3M6MzE6IkJhY2tlbmRfQXJ0aWNsZXNfR3JpZC5wYWdlci5udW0iO2k6MTtzOjMyOiJCYWNrZW5kX0FydGljbGVzX0dyaWQucGFnZXIuc2l6ZSI7aToyNTtzOjMyOiJCYWNrZW5kX0FydGljbGVzX0dyaWQuc29ydGVyLmRpciI7TjtzOjMzOiJCYWNrZW5kX0FydGljbGVzX0dyaWQuc29ydGVyLm5hbWUiO047czozODoiQmFja2VuZF9BcnRpY2xlc19JbWFnZXNfR3JpZC5wYWdlci5udW0iO2k6MTtzOjM5OiJCYWNrZW5kX0FydGljbGVzX0ltYWdlc19HcmlkLnBhZ2VyLnNpemUiO2k6MTA7czozOToiQmFja2VuZF9BcnRpY2xlc19JbWFnZXNfR3JpZC5zb3J0ZXIuZGlyIjtOO3M6NDA6IkJhY2tlbmRfQXJ0aWNsZXNfSW1hZ2VzX0dyaWQuc29ydGVyLm5hbWUiO047fQ==');
INSERT INTO `sessions` VALUES ('582f0060c0da81-86702534',1479475309,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzUzMDk7fQ==');
INSERT INTO `sessions` VALUES ('582f02562c5ac1-10590094',1479475798,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc1Nzk4O30=');
INSERT INTO `sessions` VALUES ('582f0257e43a85-25249447',1479479830,'YToyMDp7czo2OiJjYXRfaWQiO2k6MDtzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc5ODMwO3M6MTM6ImFkbWluOnVzZXJfaWQiO3M6MToiMyI7czoxNDoiZmlsZV91cGxvYWRfaWQiO2k6NDU7czozMzoiQmFja2VuZF9DYXRlZ29yaWVzX0dyaWQucGFnZXIubnVtIjtpOjE7czozNDoiQmFja2VuZF9DYXRlZ29yaWVzX0dyaWQucGFnZXIuc2l6ZSI7aToyNTtzOjM0OiJCYWNrZW5kX0NhdGVnb3JpZXNfR3JpZC5zb3J0ZXIuZGlyIjtOO3M6MzU6IkJhY2tlbmRfQ2F0ZWdvcmllc19HcmlkLnNvcnRlci5uYW1lIjtOO3M6Mzc6IkJhY2tlbmRfUHJvamVjdHNfSXRlbXNfR3JpZC5wYWdlci5udW0iO2k6MTtzOjM4OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0dyaWQucGFnZXIuc2l6ZSI7aToxMDtzOjM4OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0dyaWQuc29ydGVyLmRpciI7TjtzOjM5OiJCYWNrZW5kX1Byb2plY3RzX0l0ZW1zX0dyaWQuc29ydGVyLm5hbWUiO047czozNzoiQmFja2VuZF9Ib21lX1NsaWRlc2hvd19HcmlkLnBhZ2VyLm51bSI7aToxO3M6Mzg6IkJhY2tlbmRfSG9tZV9TbGlkZXNob3dfR3JpZC5wYWdlci5zaXplIjtpOjI1O3M6Mzg6IkJhY2tlbmRfSG9tZV9TbGlkZXNob3dfR3JpZC5zb3J0ZXIuZGlyIjtOO3M6Mzk6IkJhY2tlbmRfSG9tZV9TbGlkZXNob3dfR3JpZC5zb3J0ZXIubmFtZSI7TjtzOjQyOiJCYWNrZW5kX0NhdGVnb3JpZXNfUHJvamVjdHNfR3JpZC5wYWdlci5udW0iO2k6MTtzOjQzOiJCYWNrZW5kX0NhdGVnb3JpZXNfUHJvamVjdHNfR3JpZC5wYWdlci5zaXplIjtpOjEwO3M6NDM6IkJhY2tlbmRfQ2F0ZWdvcmllc19Qcm9qZWN0c19HcmlkLnNvcnRlci5kaXIiO047czo0NDoiQmFja2VuZF9DYXRlZ29yaWVzX1Byb2plY3RzX0dyaWQuc29ydGVyLm5hbWUiO047fQ==');
INSERT INTO `sessions` VALUES ('582f034039b0d6-42496465',1479476035,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc2MDM1O3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582f0353c884f4-16879156',1479476054,'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc2MDU0O30=');
INSERT INTO `sessions` VALUES ('582f03e7e6ed38-77169089',1479476213,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0NzYyMTM7fQ==');
INSERT INTO `sessions` VALUES ('582f058ca31d63-80221171',1479479744,'YToyOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxNDc5NDc5NzQ0O3M6NjoiY2F0X2lkIjtpOjA7fQ==');
INSERT INTO `sessions` VALUES ('582f11c3a4f6a6-22313492',1479479858,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0Nzk4NTg7fQ==');
INSERT INTO `sessions` VALUES ('582f1273b36332-53620621',1479479923,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0Nzk5MjM7fQ==');
INSERT INTO `sessions` VALUES ('582f127b6bd924-45514374',1479479931,'YToyOntzOjY6ImNhdF9pZCI7aTowO3M6MTE6Imxhc3RfYWN0aXZlIjtpOjE0Nzk0Nzk5MzE7fQ==');
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `tags_BeforeInsert`
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
/*!50003 CREATE*/ /*!50017 DEFINER=`nuno`@`%`*/ /*!50003 TRIGGER `tags_BeforeUpdate`
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
INSERT INTO `variables` VALUES (1,'2011-06-09 05:30:00','2016-11-18 12:26:05',139,'gc_datetime','datetime',NULL,NULL,NULL,'2016-11-18 14:26:05');
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

-- Dump completed on 2016-11-18 16:39:06
