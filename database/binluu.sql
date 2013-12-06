-- MySQL dump 10.13  Distrib 5.5.32, for Linux (x86_64)
--
-- Host: localhost    Database: binluu
-- ------------------------------------------------------
-- Server version	5.5.32-log

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
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
  `latitude` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `longitude` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adviser_properties`
--

LOCK TABLES `adviser_properties` WRITE;
/*!40000 ALTER TABLE `adviser_properties` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisers`
--

LOCK TABLES `advisers` WRITE;
/*!40000 ALTER TABLE `advisers` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_tags`
--

LOCK TABLES `category_tags` WRITE;
/*!40000 ALTER TABLE `category_tags` DISABLE KEYS */;
INSERT INTO `category_tags` VALUES (5,1,'Bebidas alcohólicas'),(6,1,'Películas de acción'),(7,1,'Deportes'),(8,1,'Música'),(9,1,'Danza'),(10,1,'Naturaleza'),(11,1,'Videojuegos'),(12,1,'Filosofía'),(13,1,'Psicología'),(14,1,'Fotografía'),(15,1,'Ciencia ficción'),(16,1,'Tecnología'),(17,1,'Historia '),(18,1,'Animales '),(19,1,'Arte'),(20,1,'Libros '),(21,1,'Automóviles '),(22,1,'Caricaturas'),(23,1,'Películas de comedia'),(24,1,'Computadoras '),(25,1,'Diseño'),(26,1,'Finanzas'),(27,1,'Negocios '),(28,1,'Deportes extremos'),(29,1,'Salud'),(30,1,'Gadgets'),(31,1,'Comida '),(32,1,'Humor'),(33,1,'Internet'),(34,1,'Cine'),(35,1,'Religión'),(36,1,'Televisión'),(37,1,'Viajes'),(38,1,'Tatuajes'),(39,1,'Futbol soccer'),(40,2,'Auto propio'),(41,2,'Motocicleta'),(42,2,'Bicicleta'),(43,2,'A pie'),(44,2,'Metro'),(45,2,'Transporte público'),(46,3,'Estudiante'),(47,3,'Profesionista'),(48,3,'Ventas '),(49,3,'Empleado general'),(50,3,'Administrador'),(51,3,'CEO,CTO'),(52,3,'FreeLance'),(53,3,'Gerente'),(54,3,'Consultor'),(55,3,'Medio tiempo');
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
  `min_budget` float DEFAULT NULL,
  `max_budget` float DEFAULT NULL,
  `transport` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_profiles`
--

LOCK TABLES `event_profiles` WRITE;
/*!40000 ALTER TABLE `event_profiles` DISABLE KEYS */;
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
  `status` enum('canceled','concretized','standby') DEFAULT 'standby',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interest_categories`
--

LOCK TABLES `interest_categories` WRITE;
/*!40000 ALTER TABLE `interest_categories` DISABLE KEYS */;
INSERT INTO `interest_categories` VALUES (1,'Intereses','Categoría de intereses'),(2,'Medio de transporte','Categoría de medios de transporte'),(3,'Ocupación','Categoría de ocupación');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mails`
--

LOCK TABLES `mails` WRITE;
/*!40000 ALTER TABLE `mails` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
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
  `category_tag_id` int(11) DEFAULT NULL,
  `tag` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_profile_tags`
--

LOCK TABLES `person_profile_tags` WRITE;
/*!40000 ALTER TABLE `person_profile_tags` DISABLE KEYS */;
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
  `sex` enum('M','F') CHARACTER SET utf8 DEFAULT NULL,
  `transport` varchar(180) DEFAULT NULL,
  `min_budget` float DEFAULT NULL,
  `max_budget` float DEFAULT NULL,
  `alow_both_sex` tinyint(1) DEFAULT NULL,
  `budget` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_profiles`
--

LOCK TABLES `person_profiles` WRITE;
/*!40000 ALTER TABLE `person_profiles` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_images`
--

LOCK TABLES `property_images` WRITE;
/*!40000 ALTER TABLE `property_images` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2013-12-06 11:21:37
