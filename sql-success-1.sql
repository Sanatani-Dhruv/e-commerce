/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ProjectDB
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

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
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `cart_items_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `cart_items_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginfo`
--

DROP TABLE IF EXISTS `loginfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginfo` (
  `loginfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `loginfo_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`loginfo_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `loginfo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginfo`
--

LOCK TABLES `loginfo` WRITE;
/*!40000 ALTER TABLE `loginfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status` enum('success','fail','online') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method` enum('cash_on_delivery','upi','credit_card','debit_card') DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) NOT NULL,
  `product_shortdesc` varchar(400) NOT NULL,
  `product_longdesc` varchar(2000) NOT NULL,
  `product_stock` varchar(11) NOT NULL,
  `product_price` varchar(11) NOT NULL,
  `product_imagepath` varchar(200) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name` (`product_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,'Intel Core i3-13100 CPU','Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds','Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds','250','2459','images/products/13th-Gen-Intel-Core-2-740x416.jpg'),
(2,'DDR4 Intel Ram 9th Gen','DDR4 Intel Ram 9th Gen','DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen','20','1499','images/products/DDR4 Intel Ram 9th Gen .jpeg'),
(3,'DD2 Gen 2 Old HD RAM','(FROM W3M)DD4 HD Ram From Old Gen','DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen\r\n ~/Desktop/HTML-CSS-PRACTICE/MAIN/images/products/DDR4 Intel Ram 9th Gen .jpeg','0','1250','images/products/DDR4 Intel Ram 9th Gen .jpeg'),
(4,'CORSAIR Vengeance LPX DDR4 RAM 32GB (2x16GB) 3200MHz','CORSAIR Vengeance LPX DDR4 RAM 32GB (2x16GB) 3200MHz CL16-20-20-38 1.35V Intel AMD Desktop Computer Memory - Black (CMK32GX4M2E3200C16)','VENGEANCE LPX memory is designed for high-performance overclocking. The heatspreader is made of pure aluminum for faster heat dissipation, and the eight-layer PCB helps manage heat and provides superior overclocking headroom. DESIGNED FOR HIGH-PERFORMANCE OVERCLOCKING VENGEANCE LPX memory is designed for high-performance overclocking. The heatspreader is made of pure aluminum for faster heat dissipation, and the custom performance PCB helps manage heat and provides superior overclocking headroom. Each IC is individually screened for peak performance potential. COMPATIBILITY TESTED Part of our exhaustive testing process includes performance and compatibility testing on nearly every motherboard on the market - and a few that aren&#039;t. DESIGNED FOR HIGH-PERFORMANCE OVERCLOCKING Each VENGEANCE LPX module is built from an custom performance PCB and highly-screened memory ICs. The efficient heat spreader provides effective cooling to improve overclocking potential. XMP 2.0 SUPPORT One setting is all it takes to automatically adjust to the fastest safe speed for your VENGEANCE LPX kit. You&#039;ll get amazing, reliable performance without lockups or other strange behavior. LOW-PROFILE DESIGN The small form factor makes it ideal for smaller cases or any system where internal space is at a premium. ALUMINUM HEAT SPREADER Overclocking overhead is limited by operating temperature. The unique design of the VENGEANCE LPX heat spreader optimally pulls heat away from the ICs and into your system&#039;s cooling path, so you can push it harder. MATCH YOUR SYSTEM The best high-performance systems look as good as they run. VENGEANCE LPX is available in several colors to match your motherboard, your other components, your case -- or just your favorite color. The DDR4 form factor is optimized for the latest DDR4 systems and offers higher frequencies, greater bandwidth, and lower power','156','10119','images/products/61wCOVcyvFL._AC_SX466_.jpg');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) NOT NULL,
  `service_shortdesc` varchar(100) NOT NULL,
  `service_longdesc` varchar(500) NOT NULL,
  `service_price` varchar(11) NOT NULL,
  `service_status` enum('available','not_available') DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  UNIQUE KEY `service_name` (`service_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_number` varchar(20) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  PRIMARY KEY (`user_id`,`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'admin','dhruvdds125@gmail.com','6352733627','$2y$12$m30vretxmfy50yhUKf7eneutuMoEKbEZdk0qQGAncBK8hfFnXNxmi'),
(2,'deadster125','dhruvdds125@gmail.com','6352733627','$2y$12$7.pf1miNtT3pZsYG.39bB.uf/6fOMLmNjs.KGL6BoulAVTh61mmiq');
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

-- Dump completed on 2025-10-29 16:15:44
