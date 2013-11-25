-- MySQL dump 10.13  Distrib 5.6.10, for osx10.7 (x86_64)
--
-- Host: localhost    Database: binluu
-- ------------------------------------------------------
-- Server version 5.6.10

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adviser_id` int(11) DEFAULT NULL,
  `status` enum('A','C') CHARACTER SET utf8 DEFAULT 'A',
  `credits` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `adviser_id`, `status`, `credits`) VALUES (1,1,'A',0);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adviser_properties`
--

DROP TABLE IF EXISTS `adviser_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adviser_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adviser_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `latitude` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `longitude` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adviser_properties`
--

LOCK TABLES `adviser_properties` WRITE;
/*!40000 ALTER TABLE `adviser_properties` DISABLE KEYS */;
INSERT INTO `adviser_properties` (`id`, `adviser_id`, `description`, `latitude`, `longitude`, `address`) VALUES (1,'1','Propiedad 1','19.161819869398563','-99.6160951629281',NULL);
/*!40000 ALTER TABLE `adviser_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advisers`
--

DROP TABLE IF EXISTS `advisers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advisers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `web` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisers`
--

LOCK TABLES `advisers` WRITE;
/*!40000 ALTER TABLE `advisers` DISABLE KEYS */;
INSERT INTO `advisers` (`id`, `user_id`, `company`, `web`, `phone`) VALUES (1,2,'zumo inmobiliaria','zumoinmobiliaria.com.mx','');
/*!40000 ALTER TABLE `advisers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_tags`
--

DROP TABLE IF EXISTS `category_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interest_category_id` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_tags`
--

LOCK TABLES `category_tags` WRITE;
/*!40000 ALTER TABLE `category_tags` DISABLE KEYS */;
INSERT INTO `category_tags` (`id`, `interest_category_id`, `name`) VALUES (1,1,'Bebidas alcohólicas'),(2,1,'Películas de acción'),(3,1,'Deportes'),(4,1,'Música');
/*!40000 ALTER TABLE `category_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credit_transactions`
--

DROP TABLE IF EXISTS `credit_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credit_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` enum('A','C') CHARACTER SET utf8 DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit_transactions`
--

LOCK TABLES `credit_transactions` WRITE;
/*!40000 ALTER TABLE `credit_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `credit_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_profiles`
--

DROP TABLE IF EXISTS `event_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` enum('M','F') CHARACTER SET utf8 DEFAULT NULL,
  `ocupation` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `interests` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `budget` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_profiles`
--

LOCK TABLES `event_profiles` WRITE;
/*!40000 ALTER TABLE `event_profiles` DISABLE KEYS */;
INSERT INTO `event_profiles` (`id`, `event_id`, `age`, `sex`, `ocupation`, `interests`, `budget`) VALUES (1,1,24,'M',NULL,NULL,4000);
/*!40000 ALTER TABLE `event_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adviser_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `name` varchar(240) CHARACTER SET utf8 DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `property_description` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `adviser_id`, `property_id`, `name`, `date`, `property_description`) VALUES (1,1,1,'Evento 1','2013-11-16 00:00:00','Evento de prueba');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ideal_properties`
--

DROP TABLE IF EXISTS `ideal_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ideal_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `latitude` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `longitude` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(460) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ideal_properties`
--

LOCK TABLES `ideal_properties` WRITE;
/*!40000 ALTER TABLE `ideal_properties` DISABLE KEYS */;
/*!40000 ALTER TABLE `ideal_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interest_categories`
--

DROP TABLE IF EXISTS `interest_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interest_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) DEFAULT NULL,
  `description` varchar(460) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interest_categories`
--

LOCK TABLES `interest_categories` WRITE;
/*!40000 ALTER TABLE `interest_categories` DISABLE KEYS */;
INSERT INTO `interest_categories` (`id`, `name`, `description`) VALUES (1,'Intereses','Categoría de intereses'),(2,'Medio de transporte','Categoría de medios de transporte'),(3,'Ocupación','Categoría de ocupación');
/*!40000 ALTER TABLE `interest_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `from` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `to` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `subject` varchar(240) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `sended` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mails`
--

LOCK TABLES `mails` WRITE;
/*!40000 ALTER TABLE `mails` DISABLE KEYS */;
INSERT INTO `mails` (`id`, `user_id`, `from`, `to`, `subject`, `content`, `sended`) VALUES (4,2,'info@zumoinmobiliaria.com.mx','ricardo_soulost@hotmail.com','Te han invitado a un evento','El usuario Inmobiliaria te ha invitado a asistir al evento Evento 1.\nVer el evento: http://binluu.com.mx/index.php/Event/view/baZ6enc3hEsiqNG-dRxrjpTEysOrcRpVMAhSRWBPM_EkJD63k2yW8_yGg_kXTFVMvGMYxgtMKyTy0Lqk8qyzSXyZ',1),(5,2,'info@zumoinmobiliaria.com.mx','rgarcia.cejudo@gmail.com','Te han invitado a un evento','El usuario Inmobiliaria te ha invitado a asistir al evento Evento 1.\nVer el evento: http://binluu.com.mx/index.php/Event/view/v3yjEQ_7lpOEXw85PGZmfPBKEGG1S5bwnyTVSfLN9q0kJAmUFB5tLBxppgiPV23-LjbsP2KIljpi6WFMS0Po4Q3H',1),(6,3,'ricardo_soulost@hotmail.com','ricardo_soulost@hotmail.com','Han aceptado una invitación','El usuario usuario 1  ha confirmado su asistencia al evento Evento 1.\nVer evento: http://binluu.com.mx/index.php/Event/view/M7KEHYzhz3OBDOiNjUPYxbDy7PMU2lOnu8Oc_ezcSRUkJGwAWFzLbaJ7y6Nj1BK8ETRel9NCiROv_H8SH_oBZbhx',1),(7,3,'ricardo_soulost@hotmail.com','ricardo_soulost@hotmail.com','Han cancelado una invitación','El usuario usuario 1  ha cancelado su asistencia al evento Evento 1.\nVer evento: http://binluu.com.mx/index.php/Event/view/WUGgNRsz_m42lPjGsvm-am1JSr0hVjrDKdlPrm-KPyQkJLJt79pu7zacQY_FG-L_5TQanRBgDUHXTS_iaz_zsVn8',1),(8,4,'rgarcia.cejudo@gmail.com','ricardo_soulost@hotmail.com','Han aceptado una invitación','El usuario usuario 2  ha confirmado su asistencia al evento Evento 1.\nVer evento: http://binluu.com.mx/index.php/Event/view/gqMp3_avauchLsU7YvQwn4N_bzOjOjCDyTmK0qC5BaEkJMNqqTBGqFHUVvtK_jc1LEHtOw_ECP3cIbGC7D4IQDGp',1);
/*!40000 ALTER TABLE `mails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` (`id`, `user_id`) VALUES (1,3),(2,4);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_profile_tags`
--

DROP TABLE IF EXISTS `person_profile_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person_profile_tags` (
  `person_profile_id` int(11) DEFAULT NULL,
  `category_tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_profile_tags`
--

LOCK TABLES `person_profile_tags` WRITE;
/*!40000 ALTER TABLE `person_profile_tags` DISABLE KEYS */;
INSERT INTO `person_profile_tags` (`person_profile_id`, `category_tag_id`) VALUES (1,3),(1,4),(2,1),(2,2);
/*!40000 ALTER TABLE `person_profile_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_profiles`
--

DROP TABLE IF EXISTS `person_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `ocupation` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `interests` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `sex` enum('M','F') CHARACTER SET utf8 DEFAULT NULL,
  `budget` float DEFAULT NULL,
  `alow_both_sex` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_profiles`
--

LOCK TABLES `person_profiles` WRITE;
/*!40000 ALTER TABLE `person_profiles` DISABLE KEYS */;
INSERT INTO `person_profiles` (`id`, `person_id`, `age`, `ocupation`, `interests`, `sex`, `budget`, `alow_both_sex`) VALUES (1,1,24,'Ingeniero',NULL,'M',4000,1),(2,2,24,'Ingeniero',NULL,'M',4000,1);
/*!40000 ALTER TABLE `person_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_images`
--

DROP TABLE IF EXISTS `property_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adviser_property_id` int(11) DEFAULT NULL,
  `image` varchar(480) DEFAULT NULL,
  `type` enum('default','description') DEFAULT 'description',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_images`
--

LOCK TABLES `property_images` WRITE;
/*!40000 ALTER TABLE `property_images` DISABLE KEYS */;
INSERT INTO `property_images` (`id`, `adviser_property_id`, `image`, `type`) VALUES (1,1,'Foto2.jpg','default'),(2,1,'Foto1.jpg','description'),(3,1,'la foto 1.JPG','description'),(4,1,'la foto 2.JPG','description'),(5,1,'la foto 3.JPG','description');
/*!40000 ALTER TABLE `property_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('A','C','N') CHARACTER SET utf8 DEFAULT 'N',
  `notified_by_mail` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` (`id`, `person_id`, `event_id`, `date`, `status`, `notified_by_mail`) VALUES (7,1,1,'2013-11-16','C',0),(8,2,1,'2013-11-16','A',0);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `mail_confirmed` tinyint(1) DEFAULT NULL,
  `rol` enum('Person','Adviser','Admin') CHARACTER SET utf8 DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `image` varchar(280) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_name`, `mail_confirmed`, `rol`, `last_login`, `active`, `image`) VALUES (1,'rgarcia@mail.com','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','ricardo','garcía',1,'Admin','2013-11-20 22:29:12',1,NULL),(2,'ricardo_soulost@hotmail.com','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','Inmobiliaria','Zumo',1,'Adviser','2013-11-23 13:21:11',1,NULL),(3,'ricardo_soulost@hotmail.com','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','usuario 1',NULL,1,'Person','2013-11-16 16:46:40',1,'Foto2.jpg'),(4,'rgarcia.cejudo@gmail.com','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','usuario 2',NULL,1,'Person','2013-11-24 15:19:53',1,NULL);
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

-- Dump completed on 2013-11-24 18:06:07
