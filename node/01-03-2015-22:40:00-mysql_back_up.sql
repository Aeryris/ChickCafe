-- MySQL dump 10.13  Distrib 5.5.38, for osx10.6 (i386)
--
-- Host: localhost    Database: chickcafe
-- ------------------------------------------------------
-- Server version	5.5.38

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
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `time` time NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
INSERT INTO `backup` VALUES (199,0,'10:15:00',NULL),(200,0,'00:00:00',NULL),(201,0,'22:40:00',NULL);
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `basket`
--

DROP TABLE IF EXISTS `basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basket` (
  `basket_id` int(11) NOT NULL AUTO_INCREMENT,
  `basket_owner_id` int(11) NOT NULL,
  `basket_active` enum('true','false') NOT NULL DEFAULT 'true',
  PRIMARY KEY (`basket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basket`
--

LOCK TABLES `basket` WRITE;
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
INSERT INTO `basket` VALUES (2,4,'true'),(3,3,'true');
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `basket_items`
--

DROP TABLE IF EXISTS `basket_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basket_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `basket_items_id` int(11) NOT NULL,
  `basket_items_item_id` int(11) NOT NULL,
  `basket_items_quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basket_items`
--

LOCK TABLES `basket_items` WRITE;
/*!40000 ALTER TABLE `basket_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `basket_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_user_id` int(11) NOT NULL,
  `customer_register_date` datetime DEFAULT NULL,
  `customer_spending_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`customer_user_id`),
  CONSTRAINT `fk_customer_user1` FOREIGN KEY (`customer_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (3,'2015-03-21 18:35:14',0),(4,'2015-03-21 18:38:20',0);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `chickcafe`.`customer_AFTER_INSERT` AFTER INSERT ON `customer` FOR EACH ROW
    BEGIN
		
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `customer_order`
--

DROP TABLE IF EXISTS `customer_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `refund_refund_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orderId_idx` (`order_id`),
  KEY `fk_customer_order_refund1_idx` (`refund_refund_id`),
  KEY `ordercustID` (`customer_id`),
  CONSTRAINT `fk_customer_order_refund1` FOREIGN KEY (`refund_refund_id`) REFERENCES `refund` (`refund_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `orderOrderId` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_order`
--

LOCK TABLES `customer_order` WRITE;
/*!40000 ALTER TABLE `customer_order` DISABLE KEYS */;
INSERT INTO `customer_order` VALUES (7,1,19,NULL),(8,4,20,NULL),(9,4,21,NULL),(10,4,22,NULL),(11,4,23,NULL);
/*!40000 ALTER TABLE `customer_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_spending`
--

DROP TABLE IF EXISTS `customer_spending`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_spending` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_spending`
--

LOCK TABLES `customer_spending` WRITE;
/*!40000 ALTER TABLE `customer_spending` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_spending` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_vip`
--

DROP TABLE IF EXISTS `customer_vip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_vip` (
  `customer_vip_id` int(11) NOT NULL,
  `customer_vip_type` varchar(45) DEFAULT NULL,
  `customer_vip_status` enum('a','e','d') DEFAULT 'd' COMMENT 'Active\nExpired\nDisabled\n',
  PRIMARY KEY (`customer_vip_id`),
  CONSTRAINT `fk_vip` FOREIGN KEY (`customer_vip_id`) REFERENCES `customer` (`customer_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_vip`
--

LOCK TABLES `customer_vip` WRITE;
/*!40000 ALTER TABLE `customer_vip` DISABLE KEYS */;
INSERT INTO `customer_vip` VALUES (3,'','d'),(4,'','d');
/*!40000 ALTER TABLE `customer_vip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredient` (
  `ingredient_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_name` varchar(45) DEFAULT NULL,
  `ingredient_stock` int(45) DEFAULT NULL,
  `ingredient_available` int(11) NOT NULL,
  `ingredient_img_src` varchar(255) DEFAULT NULL,
  `ingredient_stock_notification` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
INSERT INTO `ingredient` VALUES (1,'Onion',10,10,NULL,1),(2,'Chicken',15,10,NULL,1);
/*!40000 ALTER TABLE `ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(45) DEFAULT NULL,
  `item_description` text,
  `item_stock` int(11) DEFAULT NULL,
  `item_available` tinyint(1) DEFAULT NULL,
  `item_price` decimal(13,2) DEFAULT NULL,
  `item_preptime` int(11) DEFAULT NULL,
  `item_img` varchar(255) DEFAULT NULL,
  `item_stock_notification` tinyint(1) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Oreo','Oreo',100,10,2.99,1,NULL,0),(2,'Doritos','Doritos',100,0,2.99,1,NULL,1),(3,'Pizza','Peperoni pizza',10,10,5.99,10,NULL,0),(4,'Cesar Salad','Cesar Salad',9,0,6.99,15,NULL,1);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_ingredients`
--

DROP TABLE IF EXISTS `item_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_ingredients` (
  `item_ingredients_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ingredient_quantity` decimal(10,0) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_ingredients_id`),
  KEY `fk_item_ingredients_ingredient1_idx` (`ingredient_id`),
  CONSTRAINT `fk_item_ingredients_ingredient1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_ingredients`
--

LOCK TABLES `item_ingredients` WRITE;
/*!40000 ALTER TABLE `item_ingredients` DISABLE KEYS */;
INSERT INTO `item_ingredients` VALUES (20,1,1,10),(21,2,1,4),(22,2,2,1),(23,1,3,2);
/*!40000 ALTER TABLE `item_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_time_start` datetime DEFAULT NULL,
  `menu_time_end` datetime DEFAULT NULL,
  `menu_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Break Fast','2015-03-21 00:00:00','2015-04-30 23:00:00',0),(2,'Lunch','2015-03-21 00:00:00','2015-04-01 23:00:00',0),(3,'Dinner','2015-03-21 00:00:00','2015-04-01 23:00:00',0),(4,'Drinks','2015-03-21 00:00:00','2015-04-01 23:00:00',0),(5,'New','2016-00-00 00:00:00','0000-00-00 00:00:00',NULL),(6,'New','2015-04-05 16:00:00','2015-04-30 17:00:00',NULL),(7,'New menu','2015-04-05 16:00:00','2015-04-05 18:00:00',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `menu_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_items_id`),
  KEY `menu_id_idx` (`menu_id`),
  KEY `item_id_idx` (`item_id`),
  CONSTRAINT `menu_items_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `meun_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (3,2,1),(4,2,4),(9,1,4),(11,1,3);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_type`
--

DROP TABLE IF EXISTS `menu_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_type_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_type`
--

LOCK TABLES `menu_type` WRITE;
/*!40000 ALTER TABLE `menu_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_types`
--

DROP TABLE IF EXISTS `menu_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_types`
--

LOCK TABLES `menu_types` WRITE;
/*!40000 ALTER TABLE `menu_types` DISABLE KEYS */;
INSERT INTO `menu_types` VALUES (1,'Breakfast'),(2,'Lunch'),(3,'Dinner'),(4,'Drinks');
/*!40000 ALTER TABLE `menu_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `notification_type` varchar(45) DEFAULT NULL,
  `notification_msg` varchar(255) NOT NULL,
  `notification_read` tinyint(1) NOT NULL DEFAULT '0',
  `notification_user_id` int(11) DEFAULT NULL,
  `notification_user_type` char(2) DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,'2015-04-02 23:00:00','N','Test User Notification',1,4,'C'),(2,'2015-04-02 23:20:00','N','Another User Notification',1,4,'C'),(3,'2015-04-30 08:00:00','N','Test real-time',1,NULL,'M'),(29,'2015-03-05 21:37:51','N','Doritos stock is empty',1,NULL,'M'),(30,'2015-03-05 21:37:51','N','Cesar Salad stock is empty',1,NULL,'M'),(31,'2015-03-05 21:42:41','N','Onion stock is empty',1,NULL,'M'),(32,'2015-03-05 21:42:41','N','Chicken stock is empty',1,NULL,'M'),(33,'2015-03-05 22:37:41','N','Onion stock is empty',1,NULL,'M');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_items_id`),
  KEY `item_id_idx` (`item_id`),
  KEY `order_id_idx` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (11,1,19),(12,2,19),(13,1,20),(14,4,20),(15,2,21),(16,1,21),(17,1,22),(18,2,22),(19,3,23);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_payment`
--

DROP TABLE IF EXISTS `order_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_payment` (
  `order_id` int(11) NOT NULL,
  `order_payment_name` varchar(255) NOT NULL,
  `order_payment_number` varchar(255) NOT NULL,
  `order_payment_cvc` varchar(255) NOT NULL,
  `order_payment_expiry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_payment`
--

LOCK TABLES `order_payment` WRITE;
/*!40000 ALTER TABLE `order_payment` DISABLE KEYS */;
INSERT INTO `order_payment` VALUES (23,'B T KLISZCZYK','4600 0000 0000 0000','984','10 / 20');
/*!40000 ALTER TABLE `order_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_datetime` datetime DEFAULT NULL,
  `order_price` decimal(13,2) DEFAULT NULL,
  `order_priority` int(11) DEFAULT NULL,
  `order_type` varchar(45) DEFAULT NULL,
  `order_staff_id` int(11) NOT NULL,
  `order_notification_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_order_notification1_idx` (`order_notification_id`),
  KEY `staff_id_idx` (`order_staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (19,'0000-00-00 00:00:00',299.00,NULL,NULL,0,0),(20,'0000-00-00 00:00:00',12.97,NULL,NULL,0,0),(21,'0000-00-00 00:00:00',17.94,NULL,NULL,0,0),(22,'0000-00-00 00:00:00',38.87,NULL,NULL,0,0),(23,'2015-04-06 22:24:10',NULL,NULL,NULL,0,0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_customer_id` int(11) DEFAULT NULL,
  `payment_time` datetime DEFAULT NULL,
  `payment_price` decimal(13,2) DEFAULT NULL,
  `payment_order_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_type` varchar(45) DEFAULT NULL,
  `payment_info` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `orderId_idx` (`payment_order_id`),
  CONSTRAINT `custId` FOREIGN KEY (`payment_order_id`) REFERENCES `customer` (`customer_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orderId` FOREIGN KEY (`payment_order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refund`
--

DROP TABLE IF EXISTS `refund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refund` (
  `refund_id` int(11) NOT NULL,
  `refund_order` varchar(45) DEFAULT NULL,
  `refund_date` datetime DEFAULT NULL,
  `refund_amount` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`refund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refund`
--

LOCK TABLES `refund` WRITE;
/*!40000 ALTER TABLE `refund` DISABLE KEYS */;
/*!40000 ALTER TABLE `refund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `report_title` varchar(45) DEFAULT NULL,
  `report_date` datetime DEFAULT NULL,
  `staff_staff_id` int(11) NOT NULL,
  PRIMARY KEY (`report_id`,`staff_staff_id`),
  KEY `fk_report_staff1_idx` (`staff_staff_id`),
  CONSTRAINT `fk_report_staff1` FOREIGN KEY (`staff_staff_id`) REFERENCES `staff` (`staff_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_user_id` int(11) NOT NULL,
  `staff_role` varchar(45) DEFAULT NULL,
  `staff_salary` decimal(13,2) DEFAULT NULL,
  `staff_phone_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`staff_user_id`),
  CONSTRAINT `fk_staff_user1` FOREIGN KEY (`staff_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (5,'Retail',100.00,'11111');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_performance`
--

DROP TABLE IF EXISTS `staff_performance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_performance` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_performance`
--

LOCK TABLES `staff_performance` WRITE;
/*!40000 ALTER TABLE `staff_performance` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_performance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_order_items`
--

DROP TABLE IF EXISTS `stock_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_order_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_order_items`
--

LOCK TABLES `stock_order_items` WRITE;
/*!40000 ALTER TABLE `stock_order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_orders`
--

DROP TABLE IF EXISTS `stock_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_orders`
--

LOCK TABLES `stock_orders` WRITE;
/*!40000 ALTER TABLE `stock_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('C','S','A','M','O') DEFAULT 'C' COMMENT 'CustomerStaffAdminManagerOwner',
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_salt` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `id_UNIQUE` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'S','Staff',' Account','aeryris@gmail.com','c325548aeb62d63bd5bddcddc33fe096',''),(4,'M','Bartek','Kliszczyk','bartek.kliszczyk@gmail.com','244a51054bbe285676d4ba106442d2f5',''),(5,'S','Bartek','Lastname','email@email.com','password','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `userRole` AFTER INSERT
	ON `user` FOR EACH ROW
    BEGIN
		IF NEW.user_type = 'C' THEN
			INSERT INTO customer VALUES(NEW.user_id, NOW(), 0);
            INSERT INTO customer_vip values(NEW.user_id, "", 'D');
		ELSEIF NEW.user_type = 'S' || NEW.user_type = 'A' THEN
			INSERT INTO staff(staff_user_id) VALUES (NEW.user_id);
		END IF;
    END */;;
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

-- Dump completed on 2015-04-06 22:40:00
