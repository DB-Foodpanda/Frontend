-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: foodpanda
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

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
-- Current Database: `foodpanda`
--


--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `ID_address` int(11) NOT NULL AUTO_INCREMENT,
  `A_detail` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`ID_address`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'หอพักนักศึกษามจพ กรุงเทพฯ'),(2,'หอ The Curve Salcha 316/73 ห้อง 302 ซ.วงสว่าง11 แขวงวงศ์สว่าง เขตบางซื่อ จ.กรุงเทพมหานคร 10800 เขตบา'),(3,'389 หอพักทรัพย์ทวีรุ่งเรือง ห้อง 602 ซ.7 วงศ์สว่าง ถ.วงศ์สว่าง เขตบางซื่อ แขวงบางซื่อ กรุงเทพฯ 10800');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `C_id` int(11) NOT NULL AUTO_INCREMENT,
  `C_username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `C_password` varchar(10) CHARACTER SET utf8 NOT NULL,
  `C_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `C_surname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `C_tel` char(10) CHARACTER SET utf8 NOT NULL,
  `C_creditcard_no` char(16) CHARACTER SET utf8 NOT NULL,
  `C_creditcard_exp` date NOT NULL,
  `C_creditcard_cvv` int(3) NOT NULL,
  PRIMARY KEY (`C_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'๊Bell','abc1234','Emma','Olivia','0817854327','1234567890123456','2024-09-03',567),(2,'James','fgh5679','Hello','It\'s me','0956783456','2345678902736483','2023-07-24',568),(3,'Pop','hjk@erwer','Kojo','Shinobu','0993241234','1429472550247590','2025-04-24',789);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver` (
  `D_id` int(11) NOT NULL AUTO_INCREMENT,
  `D_username` varchar(20) NOT NULL,
  `D_password` varchar(20) NOT NULL,
  `D_name` varchar(50) NOT NULL,
  `D_surname` varchar(50) NOT NULL,
  `D_tel` char(10) NOT NULL,
  `D_earnacc_no` varchar(13) NOT NULL,
  `D_earnprice` double NOT NULL,
  `D_workstatus` bit(1) NOT NULL,
  `D_rate` double NOT NULL,
  PRIMARY KEY (`D_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6549 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
INSERT INTO `driver` VALUES (5648,'cat245','123453453j','catmash','meow','0993265478','4598762103549',100,'',15),(5778,'dog5648','13284535hp','corndog','mashita','0994568712','2655598443018',525,'\0',78.75),(6548,'payut112','23154513','payut','oho','0123456789','1654028793125',250,'\0',37.5);
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food` (
  `Food_id` int(11) NOT NULL AUTO_INCREMENT,
  `Food_name` varchar(70) CHARACTER SET utf8 NOT NULL,
  `Food_size` varchar(5) CHARACTER SET utf8 NOT NULL,
  `Food_price` double NOT NULL,
  `Food_image` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Food_detail` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Food_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Food_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1124 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (1121,'ข้าวผัดเเมว','พิเศษ',150,'','ไม่ใส่ไข่เเมว','ผัด'),(1122,'เเมวทอดกระเทียม','ปกติ',100,'','เเมวทุกตัวสะอาด(เเมววัด)','ทอด'),(1123,'อึ่งทอดผัดกระเพรา','ปกติ',100,'','อึ่งตัวโตๆน่ากิน','ผัด');
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `ID_orders` int(11) NOT NULL,
  `O_paytype` bit(1) NOT NULL,
  `P_totalprice` double NOT NULL,
  `O_vat` double NOT NULL,
  `O_datestartsend` datetime NOT NULL,
  `O_dateendsend` datetime NOT NULL,
  `P_number` int(100) NOT NULL,
  PRIMARY KEY (`ID_orders`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'\0',100,7,'2021-09-12 16:56:20','2021-09-12 17:12:25',1),(2,'',180,12.6,'2021-09-12 16:58:14','2021-09-12 17:25:22',2),(3,'\0',200,14,'2021-09-12 16:59:14','2021-09-12 17:31:08',3);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status` (
  `ID_O_status` int(11) NOT NULL,
  `O_statusname` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_O_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES (0,'on hold'),(1,'complete'),(2,'pending');
/*!40000 ALTER TABLE `orders_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop` (
  `ID_shop` int(11) NOT NULL AUTO_INCREMENT,
  `S_username` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `S_password` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `S_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `S_address` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `S_tel` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `S_workstatus` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `S_earnacc_no` varchar(13) CHARACTER SET utf8mb4 NOT NULL,
  `S_earnprice` float NOT NULL,
  `S_openday` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `S_opentime` time NOT NULL,
  `S_closetime` time NOT NULL,
  `S_rate` float NOT NULL,
  `S_image` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`ID_shop`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop`
--

LOCK TABLES `shop` WRITE;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;
INSERT INTO `shop` VALUES (1,'p_porn','1996e__','ร้านอาหารสารพัดนึก','ปากซอยวงศ์สว่าง21,บางซื่อ,บางซื่อ,กรุงเทพมหานคร,10',2.6,'0890000000','ปิด','7660000000',1209,'จ-ศ','09:30:00','21:30:00',4.9,'IMG20210906123922.jpg'),(2,'cat_U','03012544','เรื่องแมวๆ','1518 ถนนประชาราษฎ์1,วงศ์สว่าง,บางซื่อ,กรุงเทพมหานค',3.9,'0954567891','เปิด','9071234567897',2546,'จ-ศ','10:00:00','21:00:00',4.8,'IMG202110091709.jpg'),(3,'inti_01','03012544','วอเตอร์','ปากซอยวงศ์สว่าง11,วงศ์สว่าง,บางซื่อ,กรุงเทพมหานค',1.5,'0954567891','เปิด','9071234567897',2546,'จ-ศ','08:30:00','21:00:00',4.8,'IMG202110091709.jpg');
/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-20 20:29:19

