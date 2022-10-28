-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: epayco2
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `document` varchar(45) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clients_users1_idx` (`users_id`),
  CONSTRAINT `fk_clients_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'186719869','4145138790',9,'leonardo'),(2,'18671986333','4145138790',10,'leonardo'),(6,'18671986','4145138790',14,'leonardo'),(13,'18671982','4145138793',21,'leonardo'),(14,'18671985','4145138797',22,'cantinflas');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `symbol` varchar(10) DEFAULT NULL,
  `symbol_iso` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'Dolares','$','USD');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `expires_at` timestamp NULL DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `clients_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_sessions_clients1_idx` (`clients_id`),
  CONSTRAINT `fk_sessions_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (1,'2022-10-27 14:52:53','1ed56352-2844-63d2-9e0d-00090faa0001',50.00,6,0),(2,'2022-10-28 00:26:53','1ed5635b-1a70-6036-80b6-00090faa0001',50.00,6,1),(3,'2022-10-28 01:21:42','1ed56398-c413-6d12-bf60-00090faa0001',50.00,6,1),(4,'2022-10-28 05:01:18','1ed5642e-2b40-6a9a-a9ab-00090faa0001',100.00,6,0),(5,'2022-10-28 05:02:01','1ed5642f-c4db-63fc-95f3-00090faa0001',100.00,6,0),(6,'2022-10-28 05:04:22','1ed56435-02a7-642e-9cb2-00090faa0001',100.00,6,0),(7,'2022-10-28 05:05:08','1ed56436-bc25-601c-87e9-00090faa0001',100.00,6,0),(8,'2022-10-28 05:06:22','1ed56439-7cb3-6cdc-8aad-00090faa0001',100.00,6,0),(9,'2022-10-28 05:06:46','1ed5643a-5bc0-638a-900d-00090faa0001',100.00,6,0),(10,'2022-10-28 05:07:47','1ed5643c-a734-67d8-a998-00090faa0001',100.00,6,0),(11,'2022-10-28 05:09:13','1ed5643f-d700-6446-80da-00090faa0001',100.00,6,0),(12,'2022-10-28 05:09:30','1ed56440-7f96-64a2-98ee-00090faa0001',100.00,6,0),(13,'2022-10-28 05:10:03','1ed56441-b676-6912-8582-00090faa0001',100.00,6,0),(14,'2022-10-28 05:10:14','1ed56442-2225-6bea-87e5-00090faa0001',100.00,6,0),(15,'2022-10-28 05:10:33','1ed56442-d78d-60b4-b253-00090faa0001',100.00,6,0),(16,'2022-10-28 06:32:25','1ed5657b-de9e-61c0-b1f9-00090faa0001',15.00,14,0);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `balance` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `clients_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_transactions_clients_idx` (`clients_id`),
  CONSTRAINT `fk_transactions_clients` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (2,2000.00,2000.00,6,'2022-10-27 15:10:19'),(3,4000.00,2000.00,6,'2022-10-27 15:10:19'),(4,6000.00,2000.00,6,'2022-10-27 15:10:24'),(5,4000.00,-2000.00,6,'2022-10-27 15:10:57'),(6,2000.00,-2000.00,6,'2022-10-27 15:15:00'),(7,0.00,-2000.00,6,'2022-10-27 15:23:07'),(8,-2000.00,-2000.00,6,'2022-10-27 15:23:10'),(9,3000.00,5000.00,6,'2022-10-27 16:21:00'),(10,8000.00,5000.00,6,'2022-10-27 16:21:03'),(11,13000.00,5000.00,6,'2022-10-27 18:30:14'),(12,18000.00,5000.00,6,'2022-10-27 18:31:21'),(13,23000.00,5000.00,6,'2022-10-27 18:35:04'),(14,28000.00,5000.00,6,'2022-10-27 18:38:39'),(15,33000.00,5000.00,6,'2022-10-27 18:40:27'),(16,38000.00,5000.00,6,'2022-10-27 18:49:34'),(17,43000.00,5000.00,6,'2022-10-27 18:50:17'),(18,48000.00,5000.00,6,'2022-10-27 18:51:08'),(19,53000.00,5000.00,6,'2022-10-27 18:51:41'),(20,58000.00,5000.00,6,'2022-10-27 18:53:02'),(21,63000.00,5000.00,6,'2022-10-27 18:53:33'),(22,63050.00,50.00,6,'2022-10-28 01:21:42'),(23,61050.00,-2000.00,6,'2022-10-28 01:36:39'),(24,66050.00,5000.00,6,'2022-10-28 03:36:51'),(25,71050.00,5000.00,6,'2022-10-28 03:37:54'),(26,76050.00,5000.00,6,'2022-10-28 03:38:08'),(27,74050.00,-2000.00,6,'2022-10-28 01:38:28'),(28,79050.00,5000.00,6,'2022-10-28 03:52:05'),(29,84050.00,5000.00,6,'2022-10-28 03:59:27'),(30,89050.00,5000.00,6,'2022-10-28 03:59:47'),(31,94050.00,5000.00,6,'2022-10-28 04:00:17'),(32,99050.00,5000.00,6,'2022-10-28 04:00:45'),(33,104050.00,5000.00,6,'2022-10-28 04:01:19'),(34,109050.00,5000.00,6,'2022-10-28 04:02:02'),(35,114050.00,5000.00,6,'2022-10-28 04:04:23'),(36,119050.00,5000.00,6,'2022-10-28 04:05:09'),(37,124050.00,5000.00,6,'2022-10-28 04:06:23'),(38,129050.00,5000.00,6,'2022-10-28 04:06:46'),(39,134050.00,5000.00,6,'2022-10-28 04:07:48'),(40,139050.00,5000.00,6,'2022-10-28 04:09:13'),(41,144050.00,5000.00,6,'2022-10-28 04:09:31'),(42,149050.00,5000.00,6,'2022-10-28 04:10:04'),(43,154050.00,5000.00,6,'2022-10-28 04:10:15'),(44,159050.00,5000.00,6,'2022-10-28 04:10:34'),(45,1500.00,1500.00,14,'2022-10-28 06:26:08'),(46,1515.00,15.00,14,'2022-10-28 06:32:25');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `add_recharge` BEFORE INSERT ON `transactions` FOR EACH ROW BEGIN
UPDATE wallets SET balance=balance+NEW.amount WHERE clients_id=NEW.clients_id;

SET NEW.balance=(SELECT balance FROM wallets WHERE clients_id=NEW.clients_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'','test',NULL),(2,'','test',NULL),(3,'','test',NULL),(4,'','test',NULL),(9,'ds000082223122@gmail.com','test',NULL),(10,'ds0000822222222@gmail.com','test',NULL),(14,'ds000082@gmail.com','test','961218'),(21,'corporacionlemez@gmail.com','test',NULL),(22,'webmasterscity@hotmail.com','test','519081');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `balance` decimal(10,2) DEFAULT 0.00,
  `currencies_id` bigint(20) NOT NULL DEFAULT 1,
  `clients_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wallets_currencies1_idx` (`currencies_id`),
  KEY `fk_wallets_clients1_idx` (`clients_id`),
  CONSTRAINT `fk_wallets_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_wallets_currencies1` FOREIGN KEY (`currencies_id`) REFERENCES `currencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,159050.00,1,6),(2,0.00,1,13),(3,1515.00,1,14);
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-27 21:43:12
