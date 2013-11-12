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
  `status` enum('A','C') DEFAULT 'A',
  `credits` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `adviser_id`, `status`, `credits`) VALUES (1,2,'A',0);
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
  `adviser_id` varchar(45) DEFAULT NULL,
  `description` text,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adviser_properties`
--

LOCK TABLES `adviser_properties` WRITE;
/*!40000 ALTER TABLE `adviser_properties` DISABLE KEYS */;
INSERT INTO `adviser_properties` (`id`, `adviser_id`, `description`, `latitude`, `longitude`) VALUES (2,'1','Propiedad de prueba','19.16187054143172','-99.61611662060022');
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
  `company` varchar(200) DEFAULT NULL,
  `web` varchar(80) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisers`
--

LOCK TABLES `advisers` WRITE;
/*!40000 ALTER TABLE `advisers` DISABLE KEYS */;
INSERT INTO `advisers` (`id`, `user_id`, `company`, `web`, `phone`) VALUES (1,3,'Zumo Inmobiliaria','zumoinmobiliaria.com.mx','7221715341'),(2,4,'Otra Inmobiliaria','otra.com','');
/*!40000 ALTER TABLE `advisers` ENABLE KEYS */;
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
  `status` enum('A','C') DEFAULT 'A',
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
  `sex` enum('M','F') DEFAULT NULL,
  `ocupation` varchar(400) DEFAULT NULL,
  `interests` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_profiles`
--

LOCK TABLES `event_profiles` WRITE;
/*!40000 ALTER TABLE `event_profiles` DISABLE KEYS */;
INSERT INTO `event_profiles` (`id`, `event_id`, `age`, `sex`, `ocupation`, `interests`) VALUES (1,2,24,'M','Ingeniero','Libros Música'),(2,3,24,'M','Ingeniero','Música Libros Vino Deportes');
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
  `name` varchar(240) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `property_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `adviser_id`, `property_id`, `name`, `date`, `property_description`) VALUES (2,1,2,'Evento 1','2013-11-09','Evento de prueba'),(3,1,2,'Evento 2','2013-11-12','Evento para invitar usuarios');
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
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `address` varchar(460) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ideal_properties`
--

LOCK TABLES `ideal_properties` WRITE;
/*!40000 ALTER TABLE `ideal_properties` DISABLE KEYS */;
INSERT INTO `ideal_properties` (`id`, `person_id`, `latitude`, `longitude`, `address`) VALUES (1,1,'19.16187054143172','-99.61611662060022',NULL);
/*!40000 ALTER TABLE `ideal_properties` ENABLE KEYS */;
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
  `from` varchar(120) DEFAULT NULL,
  `to` varchar(120) DEFAULT NULL,
  `subject` varchar(240) DEFAULT NULL,
  `content` text,
  `sended` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mails`
--

LOCK TABLES `mails` WRITE;
/*!40000 ALTER TABLE `mails` DISABLE KEYS */;
INSERT INTO `mails` (`id`, `user_id`, `from`, `to`, `subject`, `content`, `sended`) VALUES (1,1,'rgarcia.cejudo@gmail.com','rgarcia.cejudo@gmail.com','Confirmación de correo','Hola, Ricardo, para confirmar tu correo da clic en la siguiente dirección: http://binluu.com.mx/index.php/User/confirm/6ONcIKOuoaKz-p9MJ2MlwH3h3wFBXbFtwPiVdsfSe8gkJEZetM3NeJzdwUEZv_mKfbB5F0KGiuSCzOLssyTCRuNZ',1),(2,2,'ricardo_soulost@hotmail.com','ricardo_soulost@hotmail.com','Confirmación de correo','Hola, Usuario 1, para confirmar tu correo da clic en la siguiente dirección: http://binluu.com.mx/index.php/User/confirm/SBg8cqYrlRdasmLskmpb3i29s9XjtJN1c8YJbJV8Q9UkJMkro8moNTztdCLBxjUch1OqdIdh3gdDsID6cf37lJo8',1),(3,3,'info@zumoinmobiliaria.com.mx','rgarcia.cejudo@gmail.com','Te han invitado a un evento','El usuario Promotor 1 te ha invitado a asistir al evento Evento 1.\nVer el evento: http://binluu.com.mx/index.php/Event/view/s3jJPE0lr3xBE3bemfA78Yz8gKNWSwCNp1AfCS28aHYkJPCOjuznB7HJLAlZQSDznCPI1EcGTp_8M9Pq5MU29iti',1);
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
INSERT INTO `people` (`id`, `user_id`) VALUES (1,2),(2,5);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
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
  `ocupation` varchar(400) DEFAULT NULL,
  `interests` varchar(400) DEFAULT NULL,
  `sex` enum('M','F') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_profiles`
--

LOCK TABLES `person_profiles` WRITE;
/*!40000 ALTER TABLE `person_profiles` DISABLE KEYS */;
INSERT INTO `person_profiles` (`id`, `person_id`, `age`, `ocupation`, `interests`, `sex`) VALUES (1,1,24,'Ingeniero','Música\r\nLibros\r\nVino','M'),(2,2,24,'Ingeniero','Vino Musica','M');
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
INSERT INTO `property_images` (`id`, `adviser_property_id`, `image`, `type`) VALUES (1,2,'ROCKE35660_5b_slide1.jpg','default'),(2,2,'Foto2.jpg_0','description'),(3,2,'ROCKE35660_5b_slide1.jpg_1','description'),(4,2,'la foto 3.JPG_2','description'),(5,2,'la foto 2.JPG_3','description');
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
  `status` enum('A','C','N') DEFAULT 'N',
  `notified_by_mail` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` (`id`, `person_id`, `event_id`, `date`, `status`, `notified_by_mail`) VALUES (12,1,2,'2013-11-12','N',0),(13,2,2,'2013-11-12','N',0);
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
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `last_name` varchar(120) DEFAULT NULL,
  `mail_confirmed` tinyint(1) DEFAULT NULL,
  `rol` enum('Person','Adviser','Admin') DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `image` varchar(280) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_name`, `mail_confirmed`, `rol`, `last_login`, `active`, `image`) VALUES (1,'rgarcia.cejudo@gmail.com','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','Ricardo','',1,'Admin','2013-11-09 12:10:02',1,NULL),(2,'ricardo_soulost@hotmail.com','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','Usuario 1','',1,'Person',NULL,1,'user_profile_2.jpeg'),(3,'info@zumoinmobiliaria.com.mx','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','Promotor 1','',1,'Adviser','2013-11-11 21:59:44',1,'user_profile_3.jpeg'),(4,'ricardo@wowinteractive.com.mx','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','Promotor 2','',NULL,'Adviser',NULL,1,NULL),(5,'rgarcia.cejudo@gmail.com','5dc21f42ee6e71cb135bbdbd5b12e3601986ce71','Usuario 2',NULL,1,NULL,NULL,1,'user_profile_2.jpeg');
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

-- Dump completed on 2013-11-11 23:58:14
