-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: riva_auth
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
-- Table structure for table `AccountAuths`
--

DROP TABLE IF EXISTS `AccountAuths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountAuths` (
  `accountID` int(11) NOT NULL,
  `secretKey` char(16) DEFAULT NULL,
  PRIMARY KEY (`accountID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountAuths`
--

LOCK TABLES `AccountAuths` WRITE;
/*!40000 ALTER TABLE `AccountAuths` DISABLE KEYS */;
INSERT INTO `AccountAuths` VALUES (0,'VNMDYCJYEIWOF66G'),(1,'VNMDYCJYEIWOF66G');
/*!40000 ALTER TABLE `AccountAuths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AccountContactInfo`
--

DROP TABLE IF EXISTS `AccountContactInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountContactInfo` (
  `accountID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  PRIMARY KEY (`accountID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountContactInfo`
--

LOCK TABLES `AccountContactInfo` WRITE;
/*!40000 ALTER TABLE `AccountContactInfo` DISABLE KEYS */;
INSERT INTO `AccountContactInfo` VALUES (34,'Necati Mert','U??uz','+905325931527');
/*!40000 ALTER TABLE `AccountContactInfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AccountNoticationInfo`
--

DROP TABLE IF EXISTS `AccountNoticationInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountNoticationInfo` (
  `accountID` int(11) NOT NULL,
  `lastReadDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`accountID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountNoticationInfo`
--

LOCK TABLES `AccountNoticationInfo` WRITE;
/*!40000 ALTER TABLE `AccountNoticationInfo` DISABLE KEYS */;
INSERT INTO `AccountNoticationInfo` VALUES (1,'2021-11-22 10:02:26'),(34,'2022-05-13 21:24:11');
/*!40000 ALTER TABLE `AccountNoticationInfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AccountOneSignalInfo`
--

DROP TABLE IF EXISTS `AccountOneSignalInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountOneSignalInfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `oneSignalID` char(36) NOT NULL DEFAULT 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `oneSignalID` (`oneSignalID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountOneSignalInfo`
--

LOCK TABLES `AccountOneSignalInfo` WRITE;
/*!40000 ALTER TABLE `AccountOneSignalInfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `AccountOneSignalInfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AccountRecovers`
--

DROP TABLE IF EXISTS `AccountRecovers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountRecovers` (
  `accountID` int(11) NOT NULL,
  `recoverToken` char(32) DEFAULT NULL,
  `creationIP` varchar(40) NOT NULL DEFAULT '127.0.0.1',
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`accountID`) USING BTREE,
  UNIQUE KEY `recoverToken` (`recoverToken`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountRecovers`
--

LOCK TABLES `AccountRecovers` WRITE;
/*!40000 ALTER TABLE `AccountRecovers` DISABLE KEYS */;
INSERT INTO `AccountRecovers` VALUES (1,'00867c0b6eae1311e5582f6333c0d868','78.166.174.103','2021-11-12 00:26:35','2021-11-11 23:26:36'),(14,'d03462050c5768552da2b2f1c0d86789','24.133.24.98','2021-11-10 04:33:39','2021-11-10 03:33:40');
/*!40000 ALTER TABLE `AccountRecovers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AccountSessions`
--

DROP TABLE IF EXISTS `AccountSessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountSessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `loginToken` char(32) DEFAULT NULL,
  `creationIP` varchar(40) NOT NULL DEFAULT '127.0.0.1',
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `loginToken` (`loginToken`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountSessions`
--

LOCK TABLES `AccountSessions` WRITE;
/*!40000 ALTER TABLE `AccountSessions` DISABLE KEYS */;
INSERT INTO `AccountSessions` VALUES (5,2,'bed7a48b5d9439d871b7e4994d7ae050','78.190.140.76','2021-09-25 20:53:26','2021-09-25 20:29:05'),(11,5,'0524de7a11163dc988b349f9b2c71ced','88.245.196.144','2021-09-26 19:03:41','2021-09-26 18:37:57'),(13,6,'6716c6d10761c6792951241a4d2b797d','78.190.158.26','2021-09-28 15:05:07','2021-09-28 14:40:18'),(18,7,'a1803000e291af135b5dad1f04fc9b95','88.245.224.159','2022-09-29 00:17:53','2021-09-29 00:17:53'),(27,8,'46e4997066ae90ce05ba5e2a5cd222b5','85.104.227.199','2021-10-01 03:50:46','2021-10-01 02:38:16'),(32,10,'b8cda01ba4e8dd017c8b6ea268711aa6','88.230.146.239','2021-10-02 01:19:05','2021-10-02 00:54:56'),(33,9,'cdd0e40ef02a0beacc9a12c28221c84b','85.106.36.130','2022-10-02 11:54:09','2021-10-02 11:54:09'),(46,11,'904e01a0805d88c86f39134167b65881','95.10.230.79','2021-10-03 12:25:13','2021-10-03 12:00:51'),(47,12,'07b5bfb589b0d653cf3224f5fd9dbd69','88.232.221.74','2021-10-03 21:00:28','2021-10-03 20:32:10'),(51,0,'d908c0d521a12d86326cef678ce2cea7','24.133.24.98','2021-10-05 02:38:47','2021-10-05 02:14:48'),(52,0,'929023af2857804bba2abfa731bfb813','24.133.24.98','2021-10-05 02:40:07','2021-10-05 02:16:08'),(55,15,'9f078991898ca0617f6dedab589d4a75','172.16.162.240','2021-10-05 14:20:41','2021-10-05 13:44:52'),(58,18,'834e6c914e6d0616f5218dca00526f58','31.206.66.201','2021-10-06 17:26:38','2021-10-06 17:01:10'),(63,14,'61a1e60e6bc304dcd36b832ec28aba8d','24.133.24.98','2022-10-06 17:31:48','2021-10-06 17:31:48'),(76,20,'44c49d9337dd1668023b1a278d20e223','46.155.0.7','2021-10-07 18:59:39','2021-10-07 18:19:21'),(77,21,'4f4a7eb296a54078b100c8006f979242','88.230.137.228','2021-10-08 00:21:53','2021-10-07 23:56:16'),(109,25,'3dc82be7870398c52393e41009817e64','188.119.60.228','2021-11-17 14:40:17','2021-11-17 12:59:06'),(115,27,'918e790372300554b778494424ec6bcf','94.123.202.110','2022-11-20 10:01:13','2021-11-20 10:01:13'),(124,4,'a63e601164c2ae7fb9bfe770e7ed3cbf','88.246.95.209','2022-11-25 11:07:09','2021-11-25 11:07:09'),(131,29,'d0cf48a1b6f455ed6eb9feac5ca7873c','88.232.170.204','2021-12-05 22:30:54','2021-12-05 22:06:02'),(138,32,'74f54e9d87b2517d93954be00a92a481','88.248.40.59','2021-12-20 19:39:32','2021-12-20 19:15:22'),(140,31,'71246527c4e1d5b9fad8155573545791','85.104.224.227','2022-12-21 11:40:04','2021-12-21 11:40:04'),(168,38,'51c2878f9bba42bbdded0048a80a974c','24.133.249.85','2022-01-04 16:05:58','2022-01-04 15:41:35'),(171,39,'24a5e178cb488f007127f782f0b3d490','159.146.41.58','2022-01-22 19:02:37','2022-01-22 18:24:06'),(176,41,'b010c089d8b4ce2b6f5e462541574c90','188.43.136.33','2022-02-08 10:21:12','2022-02-08 09:48:09'),(192,35,'52364cb8196669481147b82cbef6911c','24.133.49.148','2023-02-24 18:10:55','2022-02-24 18:10:55'),(211,43,'1cc997c2fcde0bfec4156feaec56cbcf','78.166.142.206','2022-04-14 07:20:36','2022-04-14 06:54:45'),(213,44,'decbf36902918a632b9677ee8bff57be','24.133.24.98','2022-04-14 16:19:41','2022-04-14 15:53:10'),(218,45,'cba04be19f38e86541197931844e0a26','188.119.39.156','2022-04-21 09:58:37','2022-04-21 09:34:06'),(219,37,'79f79c6ed34ed12a1a512b67fbe4d91d','78.162.54.249','2022-04-21 10:25:45','2022-04-21 10:01:26'),(230,34,'a88d966687f8412072c3475c37f0d7d6','95.7.203.182','2023-05-25 02:56:50','2022-05-25 02:56:50');
/*!40000 ALTER TABLE `AccountSessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AccountSocialMedia`
--

DROP TABLE IF EXISTS `AccountSocialMedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountSocialMedia` (
  `accountID` int(11) NOT NULL,
  `skype` varchar(255) NOT NULL DEFAULT '0',
  `discord` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`accountID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountSocialMedia`
--

LOCK TABLES `AccountSocialMedia` WRITE;
/*!40000 ALTER TABLE `AccountSocialMedia` DISABLE KEYS */;
INSERT INTO `AccountSocialMedia` VALUES (1,'0','0');
/*!40000 ALTER TABLE `AccountSocialMedia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AccountTFARecovers`
--

DROP TABLE IF EXISTS `AccountTFARecovers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AccountTFARecovers` (
  `accountID` int(11) NOT NULL,
  `recoverToken` char(32) DEFAULT NULL,
  `creationIP` varchar(40) NOT NULL DEFAULT '127.0.0.1',
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`accountID`) USING BTREE,
  UNIQUE KEY `recoverToken` (`recoverToken`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AccountTFARecovers`
--

LOCK TABLES `AccountTFARecovers` WRITE;
/*!40000 ALTER TABLE `AccountTFARecovers` DISABLE KEYS */;
/*!40000 ALTER TABLE `AccountTFARecovers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Accounts`
--

DROP TABLE IF EXISTS `Accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT 'your@email.com',
  `password` varchar(255) NOT NULL,
  `verify` enum('0','1') NOT NULL DEFAULT '1',
  `lastlogin` bigint(20) DEFAULT '0',
  `x` double NOT NULL DEFAULT '0',
  `y` double NOT NULL DEFAULT '0',
  `z` double NOT NULL DEFAULT '0',
  `world` varchar(255) DEFAULT 'world',
  `isLogged` smallint(6) NOT NULL DEFAULT '0',
  `hasSession` smallint(6) NOT NULL DEFAULT '0',
  `credit` int(5) unsigned NOT NULL DEFAULT '0',
  `permission` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0',
  `authStatus` enum('0','1') NOT NULL DEFAULT '0',
  `creationIP` varchar(40) NOT NULL DEFAULT '127.0.0.1',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `ip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `regdate` bigint(20) NOT NULL DEFAULT '0',
  `regip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `yaw` float DEFAULT NULL,
  `pitch` float DEFAULT NULL,
  `totp` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Accounts`
--

LOCK TABLES `Accounts` WRITE;
/*!40000 ALTER TABLE `Accounts` DISABLE KEYS */;
INSERT INTO `Accounts` VALUES (34,'rivadarlin','RivaDarlin','necatiu56@gmail.com','$SHA$8ExsGAJUVz7f0WCl$7d5d47e060bded4a5450819ca55836b7a5ef2b88e13f8dffe4c108d071a068e2','0',1653429487046,0,0,0,'world',0,1,451,'1','0','85.104.224.227','2021-12-21 11:45:49','95.7.203.182',0,NULL,NULL,NULL,NULL),(35,'ivanilya','IVanilya','wqadsa9@gmail.com','$SHA$hnRc8uJr0Q41tg5K$deadd5f104aed53afc0cb0185745efa4d8263345763af99a39003c9fc991687a','0',1645710549838,0,0,0,'world',0,1,475,'1','0','24.133.49.148','2021-12-21 11:46:48','24.133.49.148',0,NULL,NULL,NULL,NULL),(36,'zbeeftacos','zBeefTacos','your@email.com','$SHA$7e15abfdfe7fd718$4172c30c41c6a02c157f5f9a939013a55b62060914746f9781f2611f1390320f','1',1653265694435,0,0,0,'world',0,1,0,'0','0','127.0.0.1','1000-01-01 00:00:00','88.238.200.96',1640116019146,'88.238.207.13',NULL,NULL,NULL),(37,'xegosmenss','xEgosMenSS','egemen.aslan009@gmail.com','$SHA$qcZUpFkfVK20L2KL$77b7e2db1e09a340d2789f0f83f42636e12a633a864d207a032ddafe80d31358','0',1653527541729,0,0,0,'world',0,1,384,'1','0','88.248.40.59','2021-12-21 22:53:58','78.164.59.107',0,NULL,NULL,NULL,NULL),(38,'reign','reigN','yusuf.islek0014@gmail.com','$SHA$5KHeZf8ZDGuAh2p6$b9f6bf1d513b88e8e7af1ef165cc597ebbacef2e9347d97047fa97c1875cd312','0',1641306231432,0,0,0,'world',0,1,0,'2','0','24.133.249.85','2022-01-04 15:41:35','24.133.249.85',0,NULL,NULL,NULL,NULL),(40,'sabo','Sabo','your@email.com','$SHA$1ecc7d039267a56e$8cf00d67ed2d41fbdf25cf6b4e1d563493f0d7108782db3010e884f741ddea6f','1',1643637310860,0,0,0,'world',0,0,0,'0','0','127.0.0.1','1000-01-01 00:00:00','81.215.234.211',1643629312594,'81.215.234.211',NULL,NULL,NULL),(42,'beeftacos','BeefTacos','your@email.com','$SHA$9225bcc345529916$5a566a0e1fd8f48745b6d75a74ba8d701e7a52275d90b1bef8425e7cd2934c05','1',1653230328521,0,0,0,'world',0,1,0,'0','0','127.0.0.1','1000-01-01 00:00:00','88.238.207.179',1645557609228,'88.238.207.172',NULL,NULL,NULL),(43,'rivanetwork','RivaNetwork','mertyldrm151@gmail.com','$SHA$MSqyQ6ORz44Gw40k$29732036450ee0998a9ae231bb7c17f6545432e9fbfa2bcca84f97c3e4da2550','0',0,0,0,0,'world',0,0,0,'0','0','78.166.142.206','2022-04-14 06:54:45',NULL,0,NULL,NULL,NULL,NULL),(44,'xryzerk','xRyZerK','xryzerk@gmail.com','$SHA$3UzdoGxnjawDy0Np$f9058165fc239089dfcdedb510afdc82808234d269a04eb03d6b82367340e297','0',0,0,0,0,'world',0,0,0,'0','0','24.133.24.98','2022-04-14 15:53:10',NULL,0,NULL,NULL,NULL,NULL),(45,'redoerdo','redoerdo','redoerdo@gmail.com','$SHA$Tytdi4fMyR38wVl5$dfa8ec87fa0acbd74f7c845fffac8ef4daa54ed2cce234a870da1e1b911ac6d0','0',0,0,0,0,'world',0,0,0,'1','0','188.119.39.156','2022-04-21 09:34:06',NULL,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BannedAccounts`
--

DROP TABLE IF EXISTS `BannedAccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BannedAccounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `categoryID` enum('1','2','3') NOT NULL DEFAULT '1',
  `reasonID` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1',
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BannedAccounts`
--

LOCK TABLES `BannedAccounts` WRITE;
/*!40000 ALTER TABLE `BannedAccounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `BannedAccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Broadcast`
--

DROP TABLE IF EXISTS `Broadcast`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Broadcast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '#',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Broadcast`
--

LOCK TABLES `Broadcast` WRITE;
/*!40000 ALTER TABLE `Broadcast` DISABLE KEYS */;
/*!40000 ALTER TABLE `Broadcast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ChatHistory`
--

DROP TABLE IF EXISTS `ChatHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ChatHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `message` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChatHistory`
--

LOCK TABLES `ChatHistory` WRITE;
/*!40000 ALTER TABLE `ChatHistory` DISABLE KEYS */;
INSERT INTO `ChatHistory` VALUES (2,34,'s','2022-05-14 23:49:35'),(3,34,'selam :)','2022-05-15 23:15:00'),(4,34,'ahhhhh','2022-05-23 02:22:02');
/*!40000 ALTER TABLE `ChatHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chests`
--

DROP TABLE IF EXISTS `Chests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Chests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `isLocked` enum('0','1') NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chests`
--

LOCK TABLES `Chests` WRITE;
/*!40000 ALTER TABLE `Chests` DISABLE KEYS */;
INSERT INTO `Chests` VALUES (1,1,2,'0','0','2021-09-25 18:38:49'),(2,34,1,'1','0','2022-02-13 19:11:20'),(3,34,1,'1','0','2022-02-13 19:12:40'),(4,34,1,'1','0','2022-02-13 19:14:31'),(5,37,1,'1','0','2022-02-13 19:15:31'),(6,37,1,'1','0','2022-02-13 19:17:06'),(7,35,1,'0','0','2022-02-24 18:11:03'),(8,34,1,'0','0','2022-04-21 09:20:13');
/*!40000 ALTER TABLE `Chests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ChestsHistory`
--

DROP TABLE IF EXISTS `ChestsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ChestsHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `chestID` int(11) NOT NULL,
  `type` enum('1','2','3') NOT NULL DEFAULT '1',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChestsHistory`
--

LOCK TABLES `ChestsHistory` WRITE;
/*!40000 ALTER TABLE `ChestsHistory` DISABLE KEYS */;
INSERT INTO `ChestsHistory` VALUES (1,34,2,'1','2022-02-13 19:11:25'),(2,34,3,'1','2022-02-13 19:12:45'),(3,37,5,'1','2022-02-13 19:15:41'),(4,37,6,'1','2022-02-13 19:17:11'),(5,34,4,'1','2022-02-21 15:11:54');
/*!40000 ALTER TABLE `ChestsHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConsoleHistory`
--

DROP TABLE IF EXISTS `ConsoleHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConsoleHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `serverID` int(11) NOT NULL,
  `command` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConsoleHistory`
--

LOCK TABLES `ConsoleHistory` WRITE;
/*!40000 ALTER TABLE `ConsoleHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `ConsoleHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CreditHistory`
--

DROP TABLE IF EXISTS `CreditHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CreditHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `paymentID` varchar(255) NOT NULL DEFAULT '0',
  `paymentAPI` varchar(255) NOT NULL DEFAULT 'other',
  `paymentStatus` enum('0','1') NOT NULL DEFAULT '0',
  `type` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1',
  `price` int(4) unsigned NOT NULL DEFAULT '0',
  `earnings` int(4) unsigned NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CreditHistory`
--

LOCK TABLES `CreditHistory` WRITE;
/*!40000 ALTER TABLE `CreditHistory` DISABLE KEYS */;
INSERT INTO `CreditHistory` VALUES (1,1,'0','','1','1',100,100,'2021-09-25 18:38:10');
/*!40000 ALTER TABLE `CreditHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CustomPages`
--

DROP TABLE IF EXISTS `CustomPages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CustomPages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CustomPages`
--

LOCK TABLES `CustomPages` WRITE;
/*!40000 ALTER TABLE `CustomPages` DISABLE KEYS */;
INSERT INTO `CustomPages` VALUES (1,'KVKK','kvkk','<div class=\"line\"><br></div><div class=\"sub-title\"><h1>K??????SEL VER??LER??N ????LENMES??NE ??L????K??N AYDINLATMA METN??</h1></div><p>????bu Ayd??nlatma Metni, Riva Network taraf??ndan Riva Network &uuml;yelerinin 6698 say??l?? Ki??isel Verilerin Korunmas?? Kanunu (&ldquo;<strong>Kanun</strong>&rdquo;) kapsam??nda ki??isel verilerinin Riva Network taraf??ndan i??lenmesine ili??kin olarak ayd??nlat??lmas?? amac??yla haz??rlanm????t??r.</p><ol><li><div class=\"line\"><br></div><div class=\"sub-title\"><strong>a) Ki??isel Verilerin Elde Edilme Y&ouml;ntemleri ve Hukuki Sebepleri</strong></div></li></ol><p>Ki??isel verileriniz, elektronik ortamda toplanmaktad??r. ????bu Ayd??nlatma Metni&rsquo;nde belirtilen hukuki sebeplerle toplanan ki??isel verileriniz Kanun&rsquo;un 5. ve 6. maddelerinde belirtilen ki??isel veri i??leme ??artlar?? &ccedil;er&ccedil;evesinde i??lenebilmekte ve payla????labilmektedir.</p><ol><li><div class=\"line\"><br></div><div class=\"sub-title\"><strong>b) Ki??isel Verilerin ????leme Ama&ccedil;lar??</strong></div></li></ol><p>Ki??isel verileriniz, Kanun&rsquo;un 5. ve 6. maddelerinde belirtilen ki??isel veri i??leme ??artlar?? &ccedil;er&ccedil;evesinde Riva Network taraf??ndan sunulan &uuml;r&uuml;n ve hizmetlerin ilgili ki??ilerin be??eni, kullan??m al????kanl??klar?? ve ihtiya&ccedil;lar??na g&ouml;re &ouml;zelle??tirilerek ilgili ki??ilere &ouml;nerilmesi ve tan??t??lmas?? i&ccedil;in gerekli olan aktivitelerin planlanmas?? ve icras??, Riva Network taraf??ndan sunulan &uuml;r&uuml;n ve hizmetlerden ilgili ki??ileri faydaland??rmak i&ccedil;in gerekli &ccedil;al????malar??n i?? birimleri taraf??ndan yap??lmas?? ve ilgili i?? s&uuml;re&ccedil;lerinin y&uuml;r&uuml;t&uuml;lmesi, Riva Network taraf??ndan y&uuml;r&uuml;t&uuml;len ticari faaliyetlerin ger&ccedil;ekle??tirilmesi i&ccedil;in ilgili i?? birimleri taraf??ndan gerekli &ccedil;al????malar??n yap??lmas?? ve buna ba??l?? i?? s&uuml;re&ccedil;lerinin y&uuml;r&uuml;t&uuml;lmesi, Riva Network&#39;&uuml;n ticari ve/veya i?? stratejilerinin planlanmas?? ve icras?? ve Riva Network&#39;&uuml;n ve Riva Network ile i?? ili??kisi i&ccedil;erisinde olan ilgili ki??ilerin hukuki, teknik ve ticari-i?? g&uuml;venli??inin temini ama&ccedil;lar??yla i??lenmektedir.</p><ol><li><div class=\"line\"><br></div><div class=\"sub-title\"><strong>c) Ki??isel Verilerin Payla????labilece??i Taraflar ve Payla????m Ama&ccedil;lar??</strong></div></li></ol><p>Ki??isel verileriniz, Kanun&rsquo;un 8. ve 9. maddelerinde belirtilen ki??isel veri i??leme ??artlar?? ve ama&ccedil;lar?? &ccedil;er&ccedil;evesinde, Riva Network taraf??ndan sunulan &uuml;r&uuml;n ve hizmetlerin ilgili ki??ilerin be??eni, kullan??m al????kanl??klar?? ve ihtiya&ccedil;lar??na g&ouml;re &ouml;zelle??tirilerek ilgili ki??ilere &ouml;nerilmesi ve tan??t??lmas?? i&ccedil;in gerekli olan aktivitelerin planlanmas?? ve icras??, Riva Network taraf??ndan sunulan &uuml;r&uuml;n ve hizmetlerden ilgili ki??ileri faydaland??rmak i&ccedil;in gerekli &ccedil;al????malar??n i?? birimleri taraf??ndan yap??lmas?? ve ilgili i?? s&uuml;re&ccedil;lerinin y&uuml;r&uuml;t&uuml;lmesi, Riva Network taraf??ndan y&uuml;r&uuml;t&uuml;len ticari faaliyetlerin ger&ccedil;ekle??tirilmesi i&ccedil;in ilgili i?? birimleri taraf??ndan gerekli &ccedil;al????malar??n yap??lmas?? ve buna ba??l?? i?? s&uuml;re&ccedil;lerinin y&uuml;r&uuml;t&uuml;lmesi, Riva Network&#39;&uuml;n ticari ve/veya i?? stratejilerinin planlanmas?? ve icras?? ve Riva Network&#39;&uuml;n ve Riva Network ile i?? ili??kisi i&ccedil;erisinde olan ilgili ki??ilerin hukuki, teknik ve ticari-i?? g&uuml;venli??inin temini ama&ccedil;lar?? dahilinde Riva Network&lsquo;nun i?? ortaklar?? ve tedarik&ccedil;ileri ile hukuken yetkili kurum ve kurulu??lar ile hukuken yetkili &ouml;zel hukuk t&uuml;zel ki??ileriyle payla????labilecektir.</p><ol><li><div class=\"line\"><br></div><div class=\"sub-title\"><strong>d) Veri Sahiplerinin Haklar?? ve Bu Haklar??n Kullan??lmas??</strong></div></li></ol><p>Ki??isel veri sahipleri olarak a??a????da belirtilen haklar??n??za ili??kin taleplerinizi **Veri Sahipleri Taraf??ndan Haklar??n Kullan??lmas?? ba??l?????? alt??nda **belirtilen y&ouml;ntemlerle Riva Network&rsquo;ya iletmeniz durumunda talepleriniz Riva Network taraf??ndan m&uuml;mk&uuml;n olan en k??sa s&uuml;rede ve her halde 30 (otuz) g&uuml;n i&ccedil;erisinde de??erlendirilerek sonu&ccedil;land??r??lacakt??r.</p><p>Kanun&rsquo;un 11. maddesi uyar??nca ki??isel veri sahibi olarak a??a????daki haklara sahipsiniz:</p><ul><li>Ki??isel verilerinizin i??lenip i??lenmedi??ini &ouml;??renme,</li><li>Ki??isel verileriniz i??lenmi??se buna ili??kin bilgi talep etme,</li><li>Ki??isel verilerinizin i??lenme amac??n?? ve bunlar??n amac??na uygun kullan??l??p kullan??lmad??????n?? &ouml;??renme,</li><li>Yurt i&ccedil;inde veya yurt d??????nda ki??isel verilerinizin aktar??ld?????? &uuml;&ccedil;&uuml;nc&uuml; ki??ileri bilme,</li><li>Ki??isel verilerinizin eksik veya yanl???? i??lenmi?? olmas?? h&acirc;linde bunlar??n d&uuml;zeltilmesini isteme ve bu kapsamda yap??lan i??lemin ki??isel verilerin aktar??ld?????? &uuml;&ccedil;&uuml;nc&uuml; ki??ilere bildirilmesini isteme,</li><li>Kanun ve ilgili di??er kanun h&uuml;k&uuml;mlerine uygun olarak i??lenmi?? olmas??na ra??men, i??lenmesini gerektiren sebeplerin ortadan kalkmas?? h&acirc;linde ki??isel verilerinizin silinmesini veya yok edilmesini isteme ve bu kapsamda yap??lan i??lemin ki??isel verilerin aktar??ld?????? &uuml;&ccedil;&uuml;nc&uuml; ki??ilere bildirilmesini isteme,</li><li>????lenen verilerinizin m&uuml;nhas??ran otomatik sistemler vas??tas??yla analiz edilmesi suretiyle ki??inin kendisi aleyhine bir sonucun ortaya &ccedil;??kmas??na itiraz etme,</li><li>Ki??isel verilerinizin kanuna ayk??r?? olarak i??lenmesi sebebiyle zarara u??ramas?? h&acirc;linde zarar??n giderilmesini talep etme.</li><li>Kanun&rsquo;un 28. maddesinin 2. f??kras?? veri sahiplerinin talep hakk?? bulunmayan halleri s??ralam???? olup bu kapsamda;</li><li>Ki??isel veri i??lemenin su&ccedil; i??lenmesinin &ouml;nlenmesi veya su&ccedil; soru??turmas?? i&ccedil;in gerekli olmas??,</li><li>??lgili ki??inin kendisi taraf??ndan alenile??tirilmi?? ki??isel verilerin i??lenmesi,</li><li>Ki??isel veri i??lemenin kanunun verdi??i yetkiye dayan??larak g&ouml;revli ve yetkili kamu kurum ve kurulu??lar?? ile kamu kurumu niteli??indeki meslek kurulu??lar??nca, denetleme veya d&uuml;zenleme g&ouml;revlerinin y&uuml;r&uuml;t&uuml;lmesi ile disiplin soru??turma veya kovu??turmas?? i&ccedil;in gerekli olmas??,</li><li>Ki??isel veri i??lemenin b&uuml;t&ccedil;e, vergi ve mali konulara ili??kin olarak Devletin ekonomik ve mali &ccedil;??karlar??n??n korunmas?? i&ccedil;in gerekli olmas??,</li><li>hallerinde verilere y&ouml;nelik olarak yukar??da belirlenen haklar kullan??lamayacakt??r.</li><li>Kanun&rsquo;un 28. maddesinin 1. f??kras??na g&ouml;re ise a??a????daki durumlarda veriler Kanun kapsam?? d??????nda olaca????ndan, veri sahiplerinin talepleri bu veriler bak??m??ndan da i??leme al??nmayacakt??r:</li><li>Ki??isel verilerin, &uuml;&ccedil;&uuml;nc&uuml; ki??ilere verilmemek ve veri g&uuml;venli??ine ili??kin y&uuml;k&uuml;ml&uuml;l&uuml;klere uyulmak kayd??yla ger&ccedil;ek ki??iler taraf??ndan tamamen kendisiyle veya ayn?? konutta ya??ayan aile fertleriyle ilgili faaliyetler kapsam??nda i??lenmesi.</li><li>Ki??isel verilerin resmi istatistik ile anonim h&acirc;le getirilmek suretiyle ara??t??rma, planlama ve istatistik gibi ama&ccedil;larla i??lenmesi.</li><li>Ki??isel verilerin mill&icirc; savunmay??, mill&icirc; g&uuml;venli??i, kamu g&uuml;venli??ini, kamu d&uuml;zenini, ekonomik g&uuml;venli??i, &ouml;zel hayat??n gizlili??ini veya ki??ilik haklar??n?? ihlal etmemek ya da su&ccedil; te??kil etmemek kayd??yla, sanat, tarih, edebiyat veya bilimsel ama&ccedil;larla ya da ifade &ouml;zg&uuml;rl&uuml;??&uuml; kapsam??nda i??lenmesi.</li><li>Ki??isel verilerin mill&icirc; savunmay??, mill&icirc; g&uuml;venli??i, kamu g&uuml;venli??ini, kamu d&uuml;zenini veya ekonomik g&uuml;venli??i sa??lamaya y&ouml;nelik olarak kanunla g&ouml;rev ve yetki verilmi?? kamu kurum ve kurulu??lar?? taraf??ndan y&uuml;r&uuml;t&uuml;len &ouml;nleyici, koruyucu ve istihbari faaliyetler kapsam??nda i??lenmesi.</li><li>Ki??isel verilerin soru??turma, kovu??turma, yarg??lama veya infaz i??lemlerine ili??kin olarak yarg?? makamlar?? veya infaz mercileri taraf??ndan i??lenmesi.</li></ul><p><strong>Veri Sahipleri Taraf??ndan Haklar??n Kullan??lmas??</strong></p><ul><li>Veri sahipleri, yukar??da bahsi ge&ccedil;en haklar?? kullanmak i&ccedil;in a??a????da yer alan &ldquo; _Ki??isel Veri Sahibi Taraf??ndan Veri Sorumlusuna Yap??lacak Ba??vurulara ili??kin Form _&rdquo;u kullanabileceklerdir.</li><li>Ba??vurular, ilgili veri sahibinin kimli??ini tespit edecek belgelerle birlikte, a??a????daki y&ouml;ntem ile ger&ccedil;ekle??tirilecektir:</li><li>Formun adresine g&ouml;nderilmesi.</li><li>Riva Network, Kanun&rsquo;da &ouml;ng&ouml;r&uuml;lm&uuml;?? s??n??rlar &ccedil;er&ccedil;evesinde s&ouml;z konusu haklar?? kullanmak isteyen veri sahiplerine, yine Kanun&rsquo;da &ouml;ng&ouml;r&uuml;len ??ekilde azami otuz (30) g&uuml;n i&ccedil;erisinde cevap vermektedir. Ki??isel veri sahipleri ad??na &uuml;&ccedil;&uuml;nc&uuml; ki??ilerin ba??vuru talebinde bulunabilmesi i&ccedil;in veri sahibi taraf??ndan ba??vuruda bulunacak ki??i ad??na noter kanal??yla d&uuml;zenlenmi?? &ouml;zel vek&acirc;letname bulunmal??d??r.</li><li>Veri sahibi ba??vurular?? kural olarak &uuml;cretsiz olarak i??leme al??nmakla birlikte, Ki??isel Verileri Koruma Kurulu taraf??ndan &ouml;ng&ouml;r&uuml;len &uuml;cret tarifesi[1] &uuml;zerinden &uuml;cretlendirme yap??labilecektir.</li><li>Riva Network, ba??vuruda bulunan ki??inin ki??isel veri sahibi olup olmad??????n?? tespit etmek ad??na ilgili ki??iden bilgi talep edebilir, ba??vuruda belirtilen hususlar?? netle??tirmek ad??na, ki??isel veri sahibine ba??vurusu ile ilgili soru y&ouml;neltebilir.</li></ul><p>[1] 10.03.2018 tarih ve 30356 say??l?? Resmi Gazete&rsquo;de yay??nlanan &ldquo;Veri Sorumlusuna Ba??vuru Usul ve Esaslar?? Hakk??nda Tebli??&rdquo; uyar??nca, veri sahiplerinin ba??vurusuna yaz??l?? olarak cevap verilecekse, on sayfaya kadar &uuml;cret al??nmaz. On sayfan??n &uuml;zerindeki her sayfa i&ccedil;in 1 T&uuml;rk Liras?? i??lem &uuml;creti al??nabilir. Ba??vuruya cevab??n CD, flash bellek gibi bir kay??t ortam??nda verilmesi halinde <strong>Kurum</strong> taraf??ndan talep edilebilecek &uuml;cret kay??t ortam??n??n maliyetini ge&ccedil;emez.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h1>Ki??isel Veri Sahibi Taraf??ndan Veri Sorumlusuna Yap??lacak Ba??vurulara ili??kin Form</h1></div><p>Yukar??da belirtilen haklar??n??z?? kullanma ile ilgili talebinizi, 6698 say??l?? Kanunu&rsquo;nun 13. maddesinin 1. f??kras?? ve 30356 say??l?? ve 10.03.2018 tarihli Veri Sorumlusuna Ba??vuru Usul ve Esaslar?? Hakk??nda Tebli?? gere??ince T&uuml;rk&ccedil;e ve yaz??l?? olarak veya kay??tl?? elektronik posta (KEP) adresi, g&uuml;venli elektronik imza, mobil imza ya da Riva Network kay??tlar??nda mevcut elektronik posta adresinizi kullanmak suretiyle iletebilirsiniz. Riva Network&#39;&uuml;n cevap vermeden &ouml;nce kimli??inizi do??rulama hakk?? sakl??d??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>Ba??vurunuzda;</h2></div><p>a) Ad??n??z??n, soyad??n??z??n ve ba??vuru yaz??l?? ise imzan??z??n,</p><p>b) T&uuml;rkiye Cumhuriyeti vatanda??lar?? i&ccedil;in T.C. kimlik numaran??z??n, yabanc?? iseniz uyru??unuzun, pasaport numaran??z??n veya varsa kimlik numaran??z??n,</p><p>c) Tebligata esas yerle??im yeri veya i?? yeri adresinizin,</p><p>&ccedil;) Varsa bildirime esas elektronik posta adresi, telefon ve faks numaran??z??n,</p><p>d) Talep konunuzun bulunmas?? zorunlu olup varsa konuya ili??kin bilgi ve belgelerin de ba??vuruya eklenmesi gerekmektedir.</p><p>E-posta yoluyla yapmak istedi??iniz ba??vurular??n??z?? e-posta adresine yapabilirsiniz.</p><p>Bu formun ve talebinizin niteli??ine g&ouml;re bilgi ve belgelerin eksiksiz ve do??ru olarak taraf??m??za ula??t??r??lmas?? gerekmektedir. ??stenilen bilgi ve belgelerin gere??i gibi ula??t??r??lmamas?? durumunda, Riva Network taraf??ndan talebinize istinaden yap??lacak ara??t??rmalar??n tam ve nitelikli ??ekilde y&uuml;r&uuml;t&uuml;lmesinde aksakl??klar ya??anabilecektir. Bu durumda, Riva Network kanuni haklar??n?? sakl?? tuttu??unu beyan eder.</p>','2021-11-25 15:10:40'),(2,'Gizlilik Politikas??','gizlilik-politikasi','<div class=\"line\"><br></div><div class=\"sub-title\"><h1>Riva Network Gizlilik Politikas??</h1></div><p>????bu gizlilik politikas?? (&ldquo;Gizlilik Politikas??&rdquo;) ile, Riva Network taraf??ndan size oyunlar??m??z??, uygulamalar??m??z??, internet sitelerimizi ve ve mobil cihazlar veya masa&uuml;st&uuml; cihazlar kullanarak gibi nas??l eri??ti??iniz dikkate al??nmaks??z??n hizmetlerimizi (&ldquo;Riva Network Hizmetleri&rdquo;) kullanman??z s??ras??nda ne gibi bilgileri toplad??????m??z ve bunlar?? nas??l kullanabilece??imizi a&ccedil;??klamaktad??r. Bunlara ek bilgiler i&ccedil;in Ki??isel Verilerin Korunmas?? Kanunu sayfam??za g&ouml;z at??n.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>1) TOPLADI??IMIZ B??LG??LER</h2></div><div class=\"line\"><br></div><div class=\"sub-title\"><h3><strong>1.1) Riva Network Hizmetleri kullan??m??n??z s??ras??nda bilgi giri??i yaparak sa??lad??????n??z bilgileri topluyoruz. A??a????dakiler bunlar aras??ndad??r:</strong></h3></div><ul><li>E-posta adresiniz, do??um tarihiniz, oyun i&ccedil;i ad??n??z (rumuz) ve benzer ileti??im bilgileriniz.</li><li>Riva Network Hizmetleri&rsquo;ne eri??imin g&uuml;venli??ini sa??lamam??z i&ccedil;in bize yard??mc?? olan kullan??c?? ad??n??z ve oturum a&ccedil;ma tarihleriniz, IP adresleriniz gibi ayr??nt??lar.</li><li>Sat??n al??mlar??n??z??n i??lenmesinde yard??mc?? olmas?? i&ccedil;in ad??n??z, fatura adresiniz, telefon numaran??z, &ouml;deme methodunuz ve ba??ka ayr??nt??lar.</li><li>Yard??m Merkezi ile ilgili bilgileriniz. Yard??ma ihtiyac??n??z oldu??u konular, destek talepleriniz, hesap ve sipari?? ayr??nt??lar??n??z.</li><li>Tercihleriniz, ilgi alanlar??n??z ve genel demografik bilgiler.</li><li>Yar????ma veya &ccedil;ekili??lerle ba??lant??l?? olarak bizimle payla??t??????n??z bilgiler.</li><li>Riva Network hesab?? bilgileriniz.</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><h4><strong>1.2) Riva Network Hizmetleri kullan??m??n??z s??ras??nda kullan??m deneyiminizi, birtak??m bilgiler topluyoruz. A??a????dakiler bunlar aras??ndad??r:</strong></h4></div><ul><li>Riva Network Hizmetleri&rsquo;ni kullanman??z s??ras??ndaki zaman damgalar??, g&ouml;z atma s&uuml;releri, t??klamalar, kayd??rmalar, y&ouml;nlendirme/&ccedil;??k???? sayfalar?? ve oyun i&ccedil;i faaliyetler.</li><li>Bilgisayar??n??z??n benzersiz ID&rsquo;leri, markas??, modeli, donan??m &ouml;zellikleri, ip adresiniz, konumunuz, &ccedil;&ouml;z&uuml;n&uuml;rl&uuml;??&uuml;n&uuml;z.</li><li>Taray??c?? s&uuml;r&uuml;m&uuml;n&uuml;z, i??letim sisteminiz ve s&uuml;r&uuml;m&uuml;, internet servis sa??lay??c??n??z.</li><li>Riva Network Hizmetleri kullan??m?? s??ras??nda ald??????n??z performans bilgileri. FPS durumunuz, ping durumunuz.</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><h2>2) B??LG??LER?? NASIL TOPLADI??IMIZ</h2></div><p>Sizin sa??lad??????n??z bilgilere ek olarak Riva Network Hizmetleri kullan??m??n??z s??ras??nda baz?? verileri otomatik olarak topluyor ve kaydediyoruz. Bu bilgiler Riva Network Hizmetleri&rsquo;nin sa??lanabilmesi i&ccedil;in gerekli bilgilerdir.</p><ul><li>&Ccedil;erezler ve ba??lant??l?? teknolojiler ile.</li><li>Web sitelerimiz arac??l??????yla.</li><li>Oyun istemcimizden ve programlar??m??zdan.</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><h2>3) B??LG??LER?? NASIL KULLANDI??IMIZ</h2></div><p>Bilgileri Riva Network Hizmetleri&rsquo;nin tedarik edilmesi, geli??tirilmesi, iyile??tirilmesi, daha iyi kullan??c?? deneyimleri olu??turma, pazarlama konular??nda bize yard??mc?? olmalar?? i&ccedil;in a??a????daki yasal dayanaklara uygun olarak kullan??yor ve payla????yoruz.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h3><strong>3.1) Yasal Dayanak</strong></h3></div><ul><li>Hizmet ??artlar??&rsquo;n??n uygulanmas?? ve Riva Network Hizmetleri&rsquo;nin tedariki i&ccedil;in gerekli oldu??u ??ekillerde.</li><li>Bilgilerinizin i??lenmesi i&ccedil;in muvafakat verdi??iniz hallerde.</li><li>Riva Network&rsquo;nun yasal zorunlulu??a veya bir mahkeme karar??na uymas?? veya yasal hakk??n?? kullanmas?? ve savunmas?? i&ccedil;in.</li><li>Sizin ve ba??kalar??n??n ya??amsal &ccedil;??karlar??n?? korumak i&ccedil;in.</li><li>Kamu yarar?? i&ccedil;in gerekli olan durumlarda.</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><h3><strong>3.2) Bilgilerin Kullan??lmas??</strong></h3></div><p>Toplad??????m??z bilgileri Riva Network Hizmetleri&rsquo;nin tedariki, hizmetlerin geli??tirilmesi ve iyile??tirilmesi, sizinle ileti??imimizi y&uuml;r&uuml;tmemizde ve reklam faaliyetlerimizi d&uuml;zenlememizde yard??mc?? olmas?? i&ccedil;in kullan??yoruz.</p><p>Ayr??ca gerekli veya uygun oldu??u hallerde (yasal y&uuml;k&uuml;ml&uuml;l&uuml;k, me??ru bir &ccedil;??kar, kamu yarar?? i&ccedil;in, sizin veya 3. ??ah??slar??n ya??amsal &ccedil;??karlar??n?? korumak i&ccedil;in) de bilgileri kullanabilir ve if??a ve muhafaza edebiliriz. A??a????dakiler bu gibi durumlara &ouml;rnektir:</p><ul><li>Kanunlar??n gere??i yerine getirmek veya bir yasal s&uuml;rece kar????l??k vermek.</li><li>Riva Network Hizmetleri&rsquo;nin g&uuml;venli bir ??ekilde y&uuml;r&uuml;t&uuml;lmesini sa??lamak.</li><li>Kullan??c??lar?? veya &uuml;&ccedil;&uuml;nc&uuml; ??ah??slar?? korumak i&ccedil;in.</li><li>Kendi haklar??m??z??, faaliyetlerimizi ve m&uuml;lkiyetlerimizi korumak i&ccedil;in.</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><h3><strong>3.3) Bilgilerin Payla????lmas??</strong></h3></div><p>??leti??im bilgilerinizi (e-posta adresiniz veya ev adresiniz gibi) sizin bilginiz olmadan ba????ms??z &uuml;&ccedil;&uuml;nc&uuml; ??ah??slarla payla??m??yoruz.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h3><strong>3.4) Sohbet ve Oyuncu Davran????lar??</strong></h3></div><p>Oyuncular??m??z??n oyun i&ccedil;i davran????lar??n??n Hizmet ??artlar??, Kullan??m Kurallar?? ve T&uuml;rkiye Cumhuriyeti kanunlar??na uygunlu??unu denetlemek i&ccedil;in &ouml;zel veya kamuya a&ccedil;??k mesajlar??n??z, hareket kal??plar??n??z, t??klamalar??n??z gibi verileri manuel ara&ccedil;lar veya teknikler (destek sistemimizden bize bildirmeniz veya oyuncular?? denetlemesi i&ccedil;in g&ouml;revlendirdi??imiz &ccedil;al????anlar gibi) ile veya otomatik sistemler (oyuncu davran????lar??n?? inceleyen yapay zeka sistemler veya mesaj aktivitelerini denetleyen sistemler gibi) arac??l??????yla inceliyor ve i??liyoruz.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>4) &Uuml;&Ccedil;&Uuml;NC&Uuml; ??AHIS WEB S??TELER?? VE H??ZMETLER??</h2></div><p>Tecr&uuml;benizi daha iyi k??lmak, kullan??c?? davran????lar??n?? daha iyi anlamak veya pazarlama stratejilerimize yard??mc?? olmalar?? i&ccedil;in &uuml;&ccedil;&uuml;nc&uuml; ??ah??slarla etkile??imlerinize izin veriyoruz ancak politikam??z, sahibi olmad??????m??z, kontrol&uuml;m&uuml;zde olmayan ve talimat vermedi??imiz kurumlar i&ccedil;in ge&ccedil;erli de??ildir ve hi&ccedil;bir ??ekilde ge&ccedil;erli olmas??na imkan yoktur. Ba????ms??z &uuml;&ccedil;&uuml;nc&uuml; ??ah??slar??n bizimle ayn?? uygulamalar?? benimsemi?? olmalar??na dair bir garanti vermemize imkan yoktur</p>','2021-11-25 15:23:43'),(3,'Hizmet ??artlar?? ve ??yelik S??zle??mesi','hizmet-sartlari-ve-??yelik-s??zlesmesi','<div class=\"line\"><br></div><div class=\"sub-title\">RivaNetwork Hizmet ??artlar?? ve &Uuml;yelik S&ouml;zle??mesi</div><p>Son g&uuml;ncelleme: %updated_at%</p><p>????bu hizmet ??artlar?? ve &uuml;yelik s&ouml;zle??mesi (&ldquo;Hizmet ??artlar??&rdquo;) ile, Riva Network taraf??ndan size oyunlar??m??z??, uygulamalar??m??z??, internet sitelerimizi ve ba??ka hizmetlerimizi (&ldquo;Riva Network Hizmetleri&rdquo;) kullanma ve onlardan yararlanma izni verilmesinin ??artlar?? belirlenmektedir. &ldquo;Riva Network&rdquo; ifadesi, RIVADEV YAZILIM S??STEMLER?? LTD. ??T??. anlam??nda olup i??bu Hizmet ??artlar?? siz ile s&ouml;z konusu kurulu?? aras??nda bir s&ouml;zle??me niteli??indedir.</p><div class=\"line\"><br></div><div class=\"sub-title\">Sanal ??&ccedil;erik.</div><p>Sanal ??&ccedil;erik sat??n almak, kazanmak veya hediye olarak almak &uuml;zere t??klad??????n??zda, sadece Sanal ??&ccedil;erik&rsquo;e eri??menize imk&acirc;n veren bir lisans elde etmi?? olursunuz. Edindi??iniz Sanal ??&ccedil;erik &uuml;zerinde hi&ccedil;bir m&uuml;lkiyet hakk??n??z yoktur ve bunlar?? ba??kas??na devredemezsiniz. Sanal ??&ccedil;erik&rsquo;in hi&ccedil;bir parasal de??eri yoktur, genel olarak oyuna &ouml;zg&uuml;d&uuml;r ve bunu &ldquo;ger&ccedil;ek d&uuml;nya&rdquo; paras?? ile de??i??tiremezsiniz.</p><div class=\"line\"><br></div><div class=\"sub-title\">1) HESAP</div><p>1.1) Hesap olu??turmam??n &ouml;n&uuml;nde bir engel var m??? Riva Network&rsquo;de hesap olu??turabilmeniz i&ccedil;in 13 ya????n &uuml;zerinde olman??z veya ebeveyniniz/yasal vasinizin iznine sahip olman??z gerekir. 13 ya????n &uuml;zerinde olmaman??z durumunda olu??turulan hesab??n t&uuml;m aktivitelerinin sorumlulu??u ebeveyniniz/yasal vasiniz ve sizdedir.<br><br>1.2) Ger&ccedil;ek bilgilerimi vermek zorunda m??y??m? Evet. Riva Network&#39;de yapaca????n??z i??lemler i&ccedil;in sizden istendi??inde ger&ccedil;ek bilgilerinizi vermek zorundas??n??z. Buna ad??n??z ve soyad??n??z da dahildir.<br><br>1.3) Hesab??m?? takas edebilir veya satabilir miyim? Hay??r. Hesap olu??turdu??unuz anda a??a????daki ??artlar?? kabul etmi?? say??l??rs??n??z:<br><br>Hesap bilgilerinizi/hesab??n??z?? kimseyle payla??amazs??n??z. Hesap bilgilerinizi/hesab??n??z?? satamazs??n??z veya devredemezsiniz. Hesap bilgilerinizi gizli tutmal??s??n??z. Hesap bilgilerinizin if??a olmas?? veya ba??kas?? taraf??ndan &ouml;??renildi??ini d&uuml;??&uuml;nmeniz durumunda derhal bize bildirmelisiniz. Hesab??n??z?? ba??kas??yla payla??man??z veya hesab??n??z??n g&uuml;venli??ini yeterince sa??layamaman??z durumunda meydana gelebilecek yetkisiz eri??im ve kay??plardan (Sanal ??&ccedil;erik kay??plar?? da dahil olmak &uuml;zere) siz sorumlusunuz.</p><div class=\"line\"><br></div><div class=\"sub-title\">2) HESABIN FESH??</div><h3><strong>2.1) Hesab??n ask??ya al??nmas?? ve feshi.</strong></h3><p><strong>2.1.1) Siz.</strong> Hesab??n??z??n ask??ya al??nmas?? veya silinmesi i&ccedil;in talepte bulunabilirsiniz. Bunun i&ccedil;in siteden destek a&ccedil;arak bizimle ileti??ime ge&ccedil;melisiniz.</p><p><strong>2.1.2) Biz.</strong> ??u h&acirc;llerde yeterli ??&uuml;phe olu??mas?? durumunda hesab??n??z?? size haber vermeksizin ask??ya alabilir veya silebiliriz:</p><ul><li>Hizmet ??artlar??&rsquo;n?? veya Kullan??m Kurallar??&rsquo;n?? ihl&acirc;l ettiyseniz.</li><li>Yasal gerek&ccedil;eler, 3. ??ah??slar??n haklar??n??n korunmas?? veya Riva Network menfaati gerek&ccedil;esiyle hesab??n aktivitelerinin sonland??r??lmas?? gerekli ise.</li><li>Yapt??????n??z &ouml;demenin bir ??ekilde &ouml;deme arac??s?? taraf??ndan geri &ccedil;ekilmesi durumunda birilerine para iadesi yapmam??z gerekir ise.</li><li>Ba??ka birisinin &ouml;deme y&ouml;ntemlerini izinsiz kullanm???? iseniz.</li></ul><p>Bu tespitleri yapabilmek i&ccedil;in otomatik sistemler veya i??birli??i yapt??????m??z ki??ilerin verdi??i bilgileri kullanabiliriz. Yan??ld??????m??z?? d&uuml;??&uuml;n&uuml;rseniz Yard??m Merkezi&rsquo;mizden hi&ccedil;bir detay?? atlamadan bizimle ileti??im ge&ccedil;in.</p><h3><strong>2.2) Hesab??m sonsuza kadar muhafaza edilecek mi?</strong></h3><p>Bunun garantisini veremeyiz. Hesab??n??z??n uzun s&uuml;re inaktif olmas?? durumunda hesab?? feshetme veya ask??ya alma hakk??m??z?? sakl?? tutar??z.</p><h3><strong>2.3) Hesab??m feshedilirse ne olur?</strong></h3><p>Hesab??n??za tan??mlanm???? olan t&uuml;m kay??tlar silinir ve bunlara eri??emezsiniz. Buna Sanal ??&ccedil;erik (sat??n ald??????n??z &uuml;r&uuml;nler) de dahildir.</p><ul><li>Paran??z??n iadesini isteyemezsiniz.</li><li>Olu??turdu??unuz di??er hesaplar??n da feshedilebilece??ini anl??yor ve kabul ediyorsunuz.</li></ul><p>Hesab??n??z??n Riva Network taraf??ndan Hizmet ??artlar?? &ccedil;er&ccedil;evesinde her zaman feshedilebilece??inin riskinin bulundu??unu biliyor ve bu ??artlara g&ouml;re davranaca????n??z?? kabul ediyorsunuz.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>3) SINIRLAMALAR</h2></div><h3><strong>3.1) Riva Network Hizmetleri ile neler yapabilirim?</strong></h3><p>Riva Network Hizmetleri&rsquo;ni ve Sanal ??&ccedil;erik&rsquo;leri sadece ??ahsi ve ticari olmayan ama&ccedil;lar??n??z i&ccedil;in kullanabilirsiniz. Herhangi bir Riva Network Hizmeti&rsquo;nden gelir elde edemez veya Sanal ??&ccedil;erik&rsquo;lerin takas??n??/sat??????n?? yapamazs??n??z. Sanal ??&ccedil;erik&rsquo;leriniz devredilemez ve Riva Network taraf??ndan geri al??nabilir. Hesab??n??z??n feshedilmesi veya ask??ya al??nmas?? durumunda Sanal ??&ccedil;erik&rsquo;leriniz de sonland??r??labilir. Aksi, s&ouml;zle??meler ile taraf??m??zca belirtilmedik&ccedil;e hi&ccedil;bir Riva Network Hizmeti &uuml;zerinden gelir sa??layamaz, sistemlerimiz &uuml;zerinde tersine m&uuml;hendislik uygulayamaz, kaynak koda d&ouml;n&uuml;??t&uuml;remez veya modifikasyonlar yapamazs??n??z.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>4) SANAL ??&Ccedil;ER??KLER, OYUN PARASI VE SATIN ALIMLAR</h2></div><h3><strong>4.1) Sanal ??&ccedil;erik&rsquo;in tan??m??.</strong></h3><p>Sanal ??&ccedil;erik Riva Network Hizmet&rsquo;lerinde size sunulan &uuml;yelik paketleri, kitler, spawnerler , kozmetik &uuml;r&uuml;nleri (Sanal &Uuml;r&uuml;nler) vb. veya krediler, coin (Oyun Paras??) (topluca &ldquo;Sanal ??&ccedil;erik&rdquo;) gibi ??eylerin tamam??d??r. Sat??n alma esnas??nda aksi belirtilmedik&ccedil;e sat??n al??nan Sanal &Uuml;r&uuml;nler veya Oyun Paras?? yaln??zca hangi oyun i&ccedil;in sat??n al??nm????sa o oyun i&ccedil;in kullan??labilir.</p><h3><strong>4.2) Sanal ??&ccedil;erikleri nas??l edinirim?</strong></h3><p>Sanal ??&ccedil;erik&rsquo;leri elde edebilmeniz i&ccedil;in birden &ccedil;ok yol vard??r.</p><ul><li>Kredi kart??, banka kart??, ininal kart veya mobil &ouml;deme gibi yollarla sat??n alabilirsiniz.</li><li>Riva Network etkinliklerinden, g&ouml;revlerinden veya &ccedil;ekili??lerinden kazanabilirsiniz.</li><li>Ba??ka bir oyuncu taraf??ndan size hediye edilebilir. (Hediye Rivalet y&uuml;klemesi gibi)</li></ul><h3><strong>4.3) Sahip oldu??um Sanal ??&ccedil;erik&rsquo;in m&uuml;lkiyeti bana m?? ait?</strong></h3><p>Hay??r. Sanal ??&ccedil;erik &uuml;zerinde hi&ccedil;bir m&uuml;lkiyet hakk??n??z yoktur. Sat??n ald??????n??z Sanal ??&ccedil;erik&rsquo;lerin hi&ccedil;bir parasal de??eri yoktur ve sahip oldu??unuz t&uuml;m Sanal ??&ccedil;erik&rsquo;lerin m&uuml;lkiyeti Riva Network&rsquo;ya aittir. Sahip oldu??unuz Sanal ??&ccedil;erik Riva Network taraf??ndan geri al??nabilir, limitlenebilir veya de??i??tirilebilir.</p><p>Hizmet ??artlar??&rsquo;nda aksi y&ouml;nde bir ifade bulunsa dahi, hesab??n??z &uuml;zerinde hi&ccedil;bir m&uuml;lkiyet hakk??n??z??n olmad??????n?? ve olmayaca????n??, buna ba??l?? b&uuml;t&uuml;n haklar??n Riva Network&rsquo;ya ait oldu??unu ve Riva Network &ccedil;??karlar??na i??leyece??ini ve bundan sonra da her zaman Riva Network&rsquo;ya ait olup onun &ccedil;??kar??na i??leyece??ini biliyor ve kabul ediyorsunuz.</p><h3><strong>4.4) Sanal ??&ccedil;erik&rsquo;imi her zaman kullanabilecek miyim?</strong></h3><p>Sanal ??&ccedil;erik&rsquo;inizi kullanabilmeniz veya eri??ebilmeniz her zaman i&ccedil;in m&uuml;mk&uuml;n olmayabilir. Riva Network Hizmetleri&rsquo;nin e??lence ve g&uuml;venli??ini art??rmak veya korumak maksad??yla, oyun i&ccedil;eriklerinin veya Sanal ??&ccedil;erikler&rsquo;in t&uuml;m&uuml;n&uuml; veya bir k??sm??n?? &ouml;nceden haber vermeksizin ve hi&ccedil;bir sorumluluk alt??na girmeden iptal etme, limitleme veya de??i??tirme hakk??m??z vard??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>5) &Ouml;DEME VE VERG??LER</h2></div><h3><strong>5.1) Riva Network Hizmetleri tamamen &uuml;cretsiz mi?</strong></h3><p>Riva Network Hizmetleri&rsquo;nin baz?? i??levleri &uuml;cretli olabilir. Bu durumda bize veya kulland??????m??z &ouml;deme arac?? firmalara do??ru ve eksiksiz &ouml;deme bilgileri vermeyi kabul ediyorsunuz. Ayr??ca hesab??n??zda yapt??????n??z harcamalar ve &ouml;demeler ile ilgili &uuml;cret ve (gerekiyorsa) vergileri de &ouml;demeyi kabul ediyorsunuz. Riva Network Hizmetleri&rsquo;nin herhangi bir &uuml;r&uuml;n&uuml; veya i&ccedil;eri??i i&ccedil;in &uuml;cretlendirmeler &uuml;zerinde de??i??iklik yapma hakk?? vard??r. Bu Oyun Paran??z??n &uuml;r&uuml;nler kar????s??ndaki al??m g&uuml;c&uuml;n&uuml; de??i??tirebilir. Sanal ??&ccedil;erik sat??n al??mlar?? i&ccedil;in &uuml;cret pe??in yap??l??r ve iade edilmez. Hesab??n??zda yap??lan yetkisiz &ouml;demeler de dahil olmak &uuml;zere b&uuml;t&uuml;n &ouml;demelerden tamamen siz sorumlusunuz.</p><h3><strong>5.2) &Ouml;deme s??ras??ndaki sorumluluklar??m nelerdir?</strong></h3><p>&Ouml;deme i??lemi s??ras??nda hesab??n??za tan??mlanan Sanal ??&ccedil;erik&rsquo;in do??ru olup olmad??????n?? kontrol etmeniz gerekir. Bir hata farkederseniz zaman kaybetmeden bizimle ileti??im kurun.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>6) KULLANICI TARAFINDAN OLU??TURULAN ??&Ccedil;ER??KLER</h2></div><h3><strong>6.1) Riva Network Hizmetleri i&ccedil;erisinde yay??nlad??????m i&ccedil;eriklerden sorumlu muyum?</strong></h3><p>Evet. Riva Network Hizmetleri i&ccedil;erisinde yay??nlad??????n??z t&uuml;m mesajlar, i&ccedil;erikler, metinler, sesler, g&ouml;r&uuml;nt&uuml;ler ve her t&uuml;rl&uuml; ileti??iminizden (&ldquo;??&ccedil;erikleriniz&rdquo;) siz sorumlusunuz.</p><p>??&ccedil;erikleriniz&rsquo;i ancak ??u ??artlar?? kabul ediyorsan??z yay??nlayabilirsiniz:</p><ul><li>??&ccedil;erikleriniz&rsquo;i y&uuml;kledi??iniz veya yay??nlad??????n??z andan itibaren, yay??nlad??????n??z veya y&uuml;kledi??iniz ??&ccedil;erikleriniz&rsquo;in da????tma, yay??nlama, uyarlama, &ccedil;o??altma, de??i??tirme, t&uuml;revlerini &uuml;retme ve t&uuml;m telif haklar??n?? s&uuml;resiz ve &uuml;cretsiz olarak Riva Network&rsquo;ya vermi?? oldu??unuzu kabul ediyorsunuz.</li><li>??&ccedil;erikleriniz&rsquo;in &uuml;zerindeki t&uuml;m haklar??n??zdan T&uuml;rkiye Cumhuriyeti kanunlar??n??n izin verdi??i &ouml;l&ccedil;&uuml;de feragat ediyorsunuz. Aksi durumda ??&ccedil;erikleriniz&rsquo;i ad??n??z veya rumuzunuz ile veya ad??n??z veya rumuzunuz olmadan kullanma ve de??i??tirme hakk??n?? Riva Network&rsquo;ya verdi??inizi kabul ediyorsunuz.</li><li>??&ccedil;erikleriniz&rsquo;in hi&ccedil;birinin Riva Network&rsquo;ya hi&ccedil;bir gizlilik y&uuml;k&uuml;ml&uuml;l&uuml;??&uuml;, eser sahibini zikretme y&uuml;k&uuml;ml&uuml;l&uuml;??&uuml; veya ba??ka y&uuml;k&uuml;ml&uuml;l&uuml;k getirmedi??ini ve ??&ccedil;erikleriniz&rsquo;in herhangi bir kullan??m veya if??as??ndan dolay?? Riva Network&rsquo;nun sorumlu tutulamayaca????n?? beyan, taahh&uuml;t ve kabul diyorsunuz.</li><li>??&ccedil;erikleriniz&rsquo;in hi&ccedil;bir &uuml;&ccedil;&uuml;nc&uuml; ??ahs??n haklar??na tecav&uuml;z etmeyece??ini beyan, taahh&uuml;t ve kabul ediyorsunuz.</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><h2>7) G&Ouml;ZET??M VE TAK??P</h2></div><h3><strong>7.1) Riva Network Hizmetleri&rsquo;ni kullan??rken Riva Network beni g&ouml;zetim alt??nda tutuyor mu?</strong></h3><p>Evet. Uygunsuz davran????lar?? tespit etmek ve s??n??rlamak, hileyi ve bilgisayar korsanl??????n?? &ouml;nlemek ve Riva Network Hizmetleri&rsquo;ni iyile??tirmek amac??yla bilgisayar??n??zda veya cihaz??n??zda aktif bir ??ekilde sizi g&ouml;zetim alt??nda tutabiliriz. Riva Network Hizmetleri&rsquo;ni kullanman??zla ilgili bilgileri nas??l toplad??????m??z ve i??ledi??imiz konusunda daha fazla bilgi almak i&ccedil;in Gizlilik Politikas??&rsquo;na g&ouml;z at??n??z.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>8) TEL??F HAKKI ??HLALLER??N??N B??LD??R??LMES??</h2></div><h3><strong>8.1) Birisi telif haklar?? ile korunan bir eserimin haklar??n?? Riva Network Hizmetleri&rsquo;nde ihlal etmi??se ne yapmam gerekir?</strong></h3><p>Riva Network Hizmetleri i&ccedil;erisinde ihlal edilen bir telif hakk??n??z oldu??unu d&uuml;??&uuml;n&uuml;yorsan??z bunun i&ccedil;in info@rivanetwork.com.tr adresine telif hakk??yla korunan eserin hangi eser oldu??u veya ad??, telefon numaran??z ve e-posta adresiniz ile bildirebilirsiniz. Yaln??zca ilgili eserin telif haklar?? sizdeyse veya sahibi ad??na hareket etmenizi sa??layan vekaletiniz varsa bildirebilirsiniz.</p><p>S&ouml;z konusu bildirim bir yasal bildirimdir ve gerekti??inde ihlal etti??inden ??&uuml;phelenilen ki??i ile payla????labilece??ini bildirmek isteriz.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h5>????BU H??ZMET ??ARTLARI&rsquo;NI OKUYUP ANLADI??INIZI VE R??VA NETWORK H??ZMETLER??&rsquo;N?? KULLANDI??INIZ VEYA ONLARA<br>ER????T??????N??ZDE ????BU H??ZMET ??ARTLARI&rsquo;NIN &Uuml;ZER??N??ZDE BA??LAYICI HALE GELD??????N?? B??L??YOR VE KABUL ED??YORSUNUZ.</h5></div>','2022-03-08 04:38:09'),(4,'????erik ??retici Politikas??','icerik-??retici-politikasi','<p>&lt;p&gt;Harika bir Youtube kanal??n varsa ve SonOyuncu&amp;rsquo;da kanal??n??n ayr??cal??klar??ndan faydalanmak istiyorsan YouTuber rol&amp;uuml;m&amp;uuml;z tam sana g&amp;ouml;re. A??a????daki ??artlar?? kar????l??yorsan veya kar????lamamana ra??men ger&amp;ccedil;ekten m&amp;uuml;thi?? bir YouTuber oldu??unu d&amp;uuml;??&amp;uuml;n&amp;uuml;yorsan yine a??a????da bulabilece??in ba??vuru kurallar??na g&amp;ouml;re YouTuber ba??vurunu yapabilirsin.&lt;/p&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;YouTuber rol&amp;uuml;n&amp;uuml;n avantajlar?? neler?&lt;/div&gt;</p><p><br></p><p>&lt;ul&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;En pahal?? VIP paketi ayr??cal??klar??.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Sana &amp;ouml;zel temsilci ile birebir h??zl?? ileti??im.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;G&amp;uuml;ncellemeler ve yenilikleri ilk &amp;ouml;nce deneme imkan??.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Hediye kodlar?? ve etkinlik imkanlar??.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Ultra s&amp;uuml;per gizli mod (disguise).&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;??sminin &amp;ouml;n&amp;uuml;nde mega haval?? &amp;ldquo;YouTuber&amp;rdquo; etiketi.&lt;/li&gt;</p><p>&lt;/ul&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;YouTube ??&amp;ccedil;erik &amp;Uuml;retici ??artlar??&lt;/div&gt;</p><p><br></p><p>&lt;ul&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Aktif olarak i&amp;ccedil;erik &amp;uuml;retiyor olmak.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Kanal??nda sadece Minecraft i&amp;ccedil;erikleri &amp;uuml;retiyorsan en az 30 bin abone.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Kanal??n sadece Minecraft i&amp;ccedil;eriklerine sahip de??ilse ve aral??klarla Minecraft videosu &amp;ccedil;ekiliyorsa 70 bin abone.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Videolar??n y&amp;uuml;klenmesinden itibaren 1 hafta i&amp;ccedil;inde en az 6000 izlenme.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Hizmet ??artlar?? ve &amp;Uuml;yelik S&amp;ouml;zle??mesi&amp;rsquo;nin daha &amp;ouml;nce &amp;ccedil;ok kez ihlal edilmemi?? olmas??.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Tatl?? olmak, nazik olmak, pon&amp;ccedil;ik olmak.&lt;/li&gt;</p><p>&lt;/ul&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;Kanal??m i&amp;ccedil;erik &amp;uuml;retici ??artlar??n?? kar????l??yor. YouTuber rol&amp;uuml; alabilecek miyim?&lt;/div&gt;</p><p><br></p><p>&lt;p&gt;Hem evet, hem hay??r. Kanal??n??n i&amp;ccedil;erik &amp;uuml;retici ??artlar??m??z?? kar????lamas?? YouTuber rol&amp;uuml; alman?? garantilemez. Duruma g&amp;ouml;re herhangi bir sebeple rol talebin reddedilebilir. Buna &amp;uuml;retti??in sak??ncal?? i&amp;ccedil;erikler, dil kullan??m??n veya ge&amp;ccedil;mi??te Hizmet ??artlar?? ihlallerin sebep olabilir ve bunlarla s??n??rl?? de??ildir.&lt;/p&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;Sak??ncal?? i&amp;ccedil;erikler nelerdir?&lt;/div&gt;</p><p><br></p><p>&lt;p&gt;Sak??ncal?? i&amp;ccedil;erikler olarak telaffuz etti??imiz i&amp;ccedil;erik tipleri a??a???? yukar?? belirtilenler gibidir ve bunlarla s??n??rl?? de??ildir.&lt;/p&gt;</p><p><br></p><p>&lt;ul&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Hile, suistimal, ayaklanma veya buna benzer di??er aktivitelere te??vik edici i&amp;ccedil;erikler.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Hakaret i&amp;ccedil;eren, k??r??c??, hedef alan dil kullan??m?? i&amp;ccedil;eren i&amp;ccedil;erikler.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;??llegal olarak kabul edilen veya T&amp;uuml;rk kanunlar??n?? ihlal eden i&amp;ccedil;erikler.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;SonOyuncu Hizmet ??artlar??&amp;rsquo;n?? ihlal eden veya ihlal etmeye te??vik eden i&amp;ccedil;erikler.&lt;/li&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;li&gt;&amp;bull;&amp;nbsp;Yeti??kinlere y&amp;ouml;nelik i&amp;ccedil;erikler veya oyuncu kitlemiz i&amp;ccedil;in uygun g&amp;ouml;rmedi??imiz i&amp;ccedil;erikler.&lt;/li&gt;</p><p>&lt;/ul&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;YouTuber rol&amp;uuml;m&amp;uuml; ald??m. Sonsuza kadar benim!&lt;/div&gt;</p><p><br></p><p>&lt;p&gt;Hay??r de??il. Yukar??da belirtilen veya belirtilmeyen sebepler ile rol&amp;uuml;n geri al??nabilir. YouTuber rol&amp;uuml; bir hak de??ildir ve SonOyuncu Hizmet ??artlar?? veya di??er belirtilmemi?? gerek&amp;ccedil;elerle rol&amp;uuml;n&amp;uuml; alabiliriz.&lt;/p&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;Ba??vurumu yapt??m, kabul edilmesem bile cevap alabilecek miyim?&lt;/div&gt;</p><p><br></p><p>&lt;p&gt;Ba??vuru yo??unlu??u veya ??artlardan &amp;ccedil;ok uzak olunmas?? gibi durumlarda olumsuz cevaplar?? veremeyebiliyoruz. Ba??vurun onaylan??rsa bizim i&amp;ccedil;in b??rakt??????n ileti??im yollar??ndan ileti??ime ge&amp;ccedil;eriz.&lt;/p&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;Ne kadar s&amp;uuml;rede cevap al??r??m?&lt;/div&gt;</p><p><br></p><p>&lt;p&gt;Duruma g&amp;ouml;re de??i??ir. Genellikle 2 hafta i&amp;ccedil;erisinde ba??vurunla ilgili cevap alman?? sa??lar??z.&lt;/p&gt;</p><p>&lt;div class=&quot;line&quot;&gt;</p><p>&nbsp; &nbsp;&nbsp;&lt;br&gt;</p><p>&lt;/div&gt;</p><p>&lt;div class=&quot;sub-title&quot;&gt;Ba??vurumu nas??l yapaca????m?&lt;/div&gt;</p><p><br></p><p>&lt;p&gt;Ba??vurunu &lt;a href=&quot;#&quot;&gt;partner@sonoyuncu.com.tr&lt;/a&gt; adresine iletebilirsin. E-posta i&amp;ccedil;eri??inde kanal??n??n ba??lant??s??, oyun i&amp;ccedil;i kullan??c?? ad??n??n olmas??na l&amp;uuml;tfen &amp;ouml;zen g&amp;ouml;ster. E-postay?? kanal??n??n i?? sorgular?? i&amp;ccedil;in kay??tl?? olan e-posta adresinden g&amp;ouml;nderirsen sahipli??ini do??rulama s&amp;uuml;recini olduk&amp;ccedil;a h??zland??rabilirsin&lt;/p&gt;</p><p><br></p>','2021-11-25 13:52:51');
/*!40000 ALTER TABLE `CustomPages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Downloads`
--

DROP TABLE IF EXISTS `Downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `downloadURL` text NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Downloads`
--

LOCK TABLES `Downloads` WRITE;
/*!40000 ALTER TABLE `Downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `Downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Games`
--

DROP TABLE IF EXISTS `Games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `imageID` char(32) NOT NULL,
  `imageType` varchar(6) NOT NULL DEFAULT 'jpg',
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Games`
--

LOCK TABLES `Games` WRITE;
/*!40000 ALTER TABLE `Games` DISABLE KEYS */;
INSERT INTO `Games` VALUES (2,'BedWars','bedwars','3d70785c68153acd63b28cf6ec2d93a3','png','<p>#</p>','2021-09-29 00:10:51'),(3,'SkyWars','skywars','267110b33f528b052bf7889d8fcfaf3e','png','<p>#</p>','2021-09-29 00:11:18'),(4,'UHC','uhc','b82c825c647779dcc07bc02d33e455fd','png','<p>#</p>','2021-09-29 00:11:26'),(5,'EggWars','eggwars','9edbd8077d5779b3e0e1f14e29f907d4','png','<p>#</p>','2021-09-29 00:11:38'),(6,'Skyblock','skyblock','f867a4aed2af24a9c9009f4ea2b2e3df','jpg','<p>#</p>','2021-09-29 00:11:48'),(7,'Survival','survival','733d7e77ced7b9dc110aac5c4e5bb1d9','png','<p>#</p>','2021-09-29 00:12:09'),(8,'Katil Kim','katil-kim','cbc2e7cf03dc3aaa692161453910fb86','png','<p>#</p>','2021-09-29 00:12:28'),(9,'Build Battle','build-battle','97ad183d35e5e3fce0dbc1c5bba8015f','jpg','<p>#</p>','2021-09-29 00:12:53'),(10,'Survival Games','survival-games','75482df7846e66798c97b7a3767702f6','png','<p>#</p>','2021-09-29 00:13:03'),(11,'SkyFight','skyfight','2041428cc2afca05ac0d093db5e645a9','png','<p>#</p>','2021-09-29 00:13:16'),(12,'Creative','creative','feb5cef811526f1015309f04bf494154','jpg','<p>#</p>','2021-09-29 00:13:31'),(13,'Herobrine Chamber','herobrine-chamber','8e2edd7aea740a7ea97ce0048d10d5a3','jpg','<p>#</p>','2021-09-29 00:13:47'),(14,'The Pit','the-pit','3c0c02a65a7732d3ea7b6e538948d301','png','<p>#</p>','2021-09-29 00:14:19'),(15,'The Bridge','the-bridge','c0a463f633d201ccd2186c5904675b25','png','<p>#</p>','2021-09-29 00:14:43'),(16,'Speed Builders','speed-builders','740cab785cefbecf68fadaad31a39252','png','<p>#</p>','2021-09-29 00:15:09'),(17,'Faction','faction','d29e621149b25ec49edb38a550c5b7c4','png','<p>#</p>','2021-09-29 00:15:58');
/*!40000 ALTER TABLE `Games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Leaderboards`
--

DROP TABLE IF EXISTS `Leaderboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Leaderboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serverName` varchar(255) NOT NULL,
  `serverSlug` varchar(255) NOT NULL,
  `mysqlServer` varchar(255) NOT NULL DEFAULT '0',
  `mysqlPort` int(11) NOT NULL,
  `mysqlUsername` varchar(255) NOT NULL,
  `mysqlPassword` varchar(255) NOT NULL,
  `mysqlDatabase` varchar(255) NOT NULL,
  `mysqlTable` varchar(255) NOT NULL,
  `usernameColumn` varchar(255) NOT NULL,
  `tableTitles` text NOT NULL,
  `tableData` text NOT NULL,
  `sorter` varchar(255) NOT NULL,
  `dataLimit` enum('10','25','50','100') NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Leaderboards`
--

LOCK TABLES `Leaderboards` WRITE;
/*!40000 ALTER TABLE `Leaderboards` DISABLE KEYS */;
INSERT INTO `Leaderboards` VALUES (1,'S??ralama','siralama','0',0,'0','0','0','Accounts','realname','S??ralama,Oyuncu,??ld??rme,??lme,Kazanma,Puan','credit,credit,credit,credit,credit,credit','ID','10');
/*!40000 ALTER TABLE `Leaderboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Lotteries`
--

DROP TABLE IF EXISTS `Lotteries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Lotteries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` int(4) unsigned NOT NULL DEFAULT '5',
  `duration` int(4) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lotteries`
--

LOCK TABLES `Lotteries` WRITE;
/*!40000 ALTER TABLE `Lotteries` DISABLE KEYS */;
/*!40000 ALTER TABLE `Lotteries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LotteryAwards`
--

DROP TABLE IF EXISTS `LotteryAwards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LotteryAwards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lotteryID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `chance` int(3) unsigned NOT NULL,
  `awardType` enum('1','2','3') NOT NULL DEFAULT '1',
  `award` int(11) NOT NULL,
  `color` varchar(32) NOT NULL DEFAULT '#000000',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LotteryAwards`
--

LOCK TABLES `LotteryAwards` WRITE;
/*!40000 ALTER TABLE `LotteryAwards` DISABLE KEYS */;
/*!40000 ALTER TABLE `LotteryAwards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LotteryHistory`
--

DROP TABLE IF EXISTS `LotteryHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LotteryHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `lotteryAwardID` int(11) unsigned NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LotteryHistory`
--

LOCK TABLES `LotteryHistory` WRITE;
/*!40000 ALTER TABLE `LotteryHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `LotteryHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `News`
--

DROP TABLE IF EXISTS `News`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `News` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `imageID` char(32) NOT NULL,
  `imageType` varchar(6) NOT NULL DEFAULT 'jpg',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `commentsStatus` enum('0','1') NOT NULL DEFAULT '1',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `News`
--

LOCK TABLES `News` WRITE;
/*!40000 ALTER TABLE `News` DISABLE KEYS */;
INSERT INTO `News` VALUES (1,1,2,'2c1518040ee1b2cbda4a1c9bcb4753cf','png','(G)OLD ROZET??!','g-old-rozeti','<div data-author-id=\"780797080448401418\" data-is-author-friend=\"true\" data-list-item-id=\"chat-messages___chat-messages-902294284533903390\" tabindex=\"-1\"><strong>(G)OLD ROZET??!&nbsp;</strong><br><br>Evet! Burada daha sunucu a&ccedil;??lmadan bizi destekleyen insanlar i&ccedil;in g&uuml;zel bir hediyemiz, zamanla daha da de??erli olacak bir hediyemiz var.<br><br>Peki nedir bu?<br><br>Tam olarak ??&ouml;yle: Minecraft sunucumuzda, Web sitemizde, Mobil uygulamam??zda ve Discord sunucumuzda olan profil kimli??inizde, &uuml;st&uuml;nde &quot;Eskilerin eskisi o bir (G)OLD&quot; yazan ve haval?? bir g&ouml;r&uuml;n&uuml;m&uuml; olan, harika bir ROZET!<br>Bu rozeti sunucu a&ccedil;??lana dek discord sunucumuzda bulunan herkes alabilir. ??imdilik sadece discord sunucumuzda bir ROL olarak verilecektir...<br>(G)OLD rozeti aday?? olmak isteyen herkes bilgiler kanl??na g&ouml;z ats??n.<br><br>Not: Minecraft sunucumuz a&ccedil;??ld??????nda (G)OLD rol&uuml; olmayan hi&ccedil; kimse bu rozeti alamayacak.<br><br>RIVA NETWORK&reg;??? &lt;|&gt; Senin d&uuml;nyan..</div>',249,'0','2021-09-25 18:14:36','2021-09-25 18:14:36'),(2,1,3,'a3c0c84c0429a5f8d0e93cfaa3855c7d','png','NELER OLUYOR?','neler-oluyor','<p style=\"text-align: center;\">RIVA NETWORK&reg;???</p><p style=\"text-align: center;\"><br>Ekibi olarak 7/24 &ccedil;al????malara devam ediyor ve her t&uuml;rl&uuml; fedakarl?????? yap??yoruz. Ancak sizler tam olarak nas??l bir sunucu ile kar????la??aca????n??z?? bilmiyorsunuz. Bu y&uuml;zden sunucu hakk??nda biraz bilgi vermek istedik!<br><br>&Ouml;ncelikle biz bir Minecraft sunucusundan fazlas??n?? hedefliyoruz sosyal bir ortam, bir Metaverse yarat??yoruz. Sunucumuzda sadece oyun oynamayacaks??n??z arkada??l??klar, gruplar, ili??kiler ve tak??mlar olu??turacaks??n??z. Her oyuncunun kendine ait bir profili, bir kimli??i olacak! K&uuml;resel olarak yapt??????n??z sohbetlerin yan??nda kurdu??unuz veya bulundu??unuz ekip ile ayr?? sohbetler olu??turacak, bir solukta g&uuml;n&uuml; bitireceksiniz :)<br><br>Evet! ??imdi gelelim oyun detaylar??na... Sunucumuzda FactionX, SkyBlockX, SurvivalX, Creative ve SkyFight olmak &uuml;zere 5 ana oyun, MurderMystery, EggWars, BedWars, SkyWars, LuckyIslands ve MinerWare olmak &uuml;zere 6 mini oyun bulunacak bu oyunlar normal hallerinden biraz farkl?? tabii ki bunu oynay??nca anlayacaks??n??z.<br><br>Ekibimizde 4 Java geli??tiricisi, 2 Web geli??tiricisi, 2 Tasar??mc?? ve 1 Mobil geli??tirici sizler i&ccedil;in &ccedil;al??????yor.<br><br>Biz sunucumuzun ismine de??il! Kendisine g&uuml;veniyoruz.<br><br>RIVA NETWORK&reg;??? &lt;|&gt; Senin d&uuml;nyan...<br><br></p>',161,'0','2021-09-25 18:15:03','2021-09-25 18:15:03'),(3,34,3,'992926711445cdb90296c107e25f408b','png','(G)OLD ROZET??!','g-old-rozeti','<p>Evet! Burada daha sunucu a&ccedil;??lmadan bizi destekleyen insanlar i&ccedil;in g&uuml;zel bir hediyemiz, zamanla daha da de??erli olacak bir hediyemiz var. &nbsp;</p><p><br>Peki nedir bu? Tam olarak ??&ouml;yle: Minecraft sunucumuzda, Web sitemizde, Mobil uygulamam??zda ve Discord sunucumuzda olan profil kimli??inizde, &uuml;st&uuml;nde &quot;Eskilerin eskisi o bir (G)OLD&quot; yazan ve haval?? bir g&ouml;r&uuml;n&uuml;m&uuml; olan, harika bir ROZET! &nbsp;</p><p><br></p><p>Bu rozeti sunucu a&ccedil;??lana dek discord sunucumuzda bulunan herkes alabilir. ??imdilik sadece discord sunucumuzda bir ROL olarak verilecektir... (G)OLD rozeti aday?? olmak isteyen herkes <span tabindex=\"0\"><img data-fr-image-pasted=\"true\" src=\"https://discord.com/assets/5f8aee4f266854e41de9778beaf7abca.svg\" alt=\"',6,'0','2021-12-27 21:42:37','2021-12-27 21:42:37'),(4,34,3,'c8aeef1344047139d8b23d2f03412488','png','NELER OLUYOR?','neler-oluyor','<p style=\"text-align: center;\">RIVA NETWORK</p><p style=\"text-align: center;\">&nbsp;<br>Ekibi olarak 7/24 &ccedil;al????malara devam ediyor ve her t&uuml;rl&uuml; fedakarl?????? yap??yoruz. Ancak sizler tam olarak nas??l bir sunucu ile kar????la??aca????n??z?? bilmiyorsunuz. Bu y&uuml;zden sunucu hakk??nda biraz bilgi vermek istedik!<br><br>&Ouml;ncelikle biz bir Minecraft sunucusundan fazlas??n?? hedefliyoruz sosyal bir ortam, bir Metaverse yarat??yoruz. Sunucumuzda sadece oyun oynamayacaks??n??z arkada??l??klar, gruplar, ili??kiler ve tak??mlar olu??turacaks??n??z. Her oyuncunun kendine ait bir profili, bir kimli??i olacak! K&uuml;resel olarak yapt??????n??z sohbetlerin yan??nda kurdu??unuz veya bulundu??unuz ekip ile ayr?? sohbetler olu??turacak, bir solukta g&uuml;n&uuml; bitireceksiniz :).<br><br>Evet! ??imdi gelelim oyun detaylar??na... Sunucumuzda FactionX, SkyBlockX, SurvivalX, Creative ve SkyFight olmak &uuml;zere 5 ana oyun, MurderMystery, EggWars, BedWars, SkyWars, LuckyIslands ve MinerWare olmak &uuml;zere 6 mini oyun bulunacak bu oyunlar normal hallerinden biraz farkl?? tabii ki bunu oynay??nca anlayacaks??n??z :).<br><br>Ekibimizde 4 Java geli??tiricisi, 2 Web geli??tiricisi, 2 Tasar??mc?? ve 1 Mobil geli??tirici sizler i&ccedil;in &ccedil;al??????yor :).<br><br>Biz sunucumuzun ismine de??il! Kendisine g&uuml;veniyoruz<br><br>RIVA NETWORK&reg;??? <br><br></p>',13,'0','2021-12-27 21:44:28','2021-12-27 21:44:28');
/*!40000 ALTER TABLE `News` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NewsCategories`
--

DROP TABLE IF EXISTS `NewsCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NewsCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color` varchar(20) NOT NULL DEFAULT '#fd6565',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NewsCategories`
--

LOCK TABLES `NewsCategories` WRITE;
/*!40000 ALTER TABLE `NewsCategories` DISABLE KEYS */;
INSERT INTO `NewsCategories` VALUES (2,'G??ncelleme','guncelleme','#23e564'),(3,'Duyuru','duyuru','#379bff');
/*!40000 ALTER TABLE `NewsCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NewsComments`
--

DROP TABLE IF EXISTS `NewsComments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NewsComments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `newsID` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NewsComments`
--

LOCK TABLES `NewsComments` WRITE;
/*!40000 ALTER TABLE `NewsComments` DISABLE KEYS */;
/*!40000 ALTER TABLE `NewsComments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NewsTags`
--

DROP TABLE IF EXISTS `NewsTags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NewsTags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NewsTags`
--

LOCK TABLES `NewsTags` WRITE;
/*!40000 ALTER TABLE `NewsTags` DISABLE KEYS */;
INSERT INTO `NewsTags` VALUES (5,2,'riva','riva'),(6,2,'riva network','riva-network'),(7,2,'rivanetwork','rivanetwork'),(8,2,'rivadev','rivadev'),(39,1,'riva','riva'),(40,1,'riva network','riva-network'),(41,1,'rivanetwork','rivanetwork'),(42,1,'client','client'),(43,1,'minecraft','minecraft');
/*!40000 ALTER TABLE `NewsTags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notifications`
--

DROP TABLE IF EXISTS `Notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `type` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `variables` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notifications`
--

LOCK TABLES `Notifications` WRITE;
/*!40000 ALTER TABLE `Notifications` DISABLE KEYS */;
INSERT INTO `Notifications` VALUES (1,1,'4','test,VIP+','2021-09-25 18:38:49'),(2,4,'1','1','2021-10-06 17:54:32'),(3,1,'1','2','2021-11-10 03:04:05'),(4,1,'1','3','2021-11-10 03:05:09'),(5,1,'1','4','2021-11-10 15:12:40'),(6,29,'1','5','2021-12-02 21:53:36'),(7,34,'4','LOBI,VIP','2022-02-13 19:11:20'),(8,34,'4','LOBI,VIP','2022-02-13 19:12:40'),(9,34,'4','LOBI,VIP','2022-02-13 19:14:31'),(10,37,'4','LOBI,VIP','2022-02-13 19:15:31'),(11,37,'4','LOBI,VIP','2022-02-13 19:17:06'),(12,35,'4','VIP,VIP','2022-02-24 18:11:03'),(13,34,'4','VIP,VIP','2022-04-21 09:20:13');
/*!40000 ALTER TABLE `Notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OnlineAccountsHistory`
--

DROP TABLE IF EXISTS `OnlineAccountsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OnlineAccountsHistory` (
  `accountID` int(11) NOT NULL,
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`accountID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OnlineAccountsHistory`
--

LOCK TABLES `OnlineAccountsHistory` WRITE;
/*!40000 ALTER TABLE `OnlineAccountsHistory` DISABLE KEYS */;
INSERT INTO `OnlineAccountsHistory` VALUES (1,'2021-12-20 18:40:45','2021-12-20 18:35:46'),(4,'2021-11-11 23:32:02','2021-11-11 23:27:03'),(7,'2021-09-29 00:29:56','2021-09-29 00:24:57'),(14,'2021-10-10 16:30:17','2021-10-10 16:25:18'),(25,'2021-11-17 13:45:42','2021-11-17 13:40:43'),(29,'2021-12-05 22:11:48','2021-12-05 22:06:49'),(31,'2021-12-21 11:44:57','2021-12-21 11:39:58'),(34,'2022-05-25 03:05:18','2022-05-25 03:00:19'),(37,'2021-12-28 03:46:35','2021-12-28 03:41:36');
/*!40000 ALTER TABLE `OnlineAccountsHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pages`
--

DROP TABLE IF EXISTS `Pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pages`
--

LOCK TABLES `Pages` WRITE;
/*!40000 ALTER TABLE `Pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Payment`
--

DROP TABLE IF EXISTS `Payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apiID` varchar(255) NOT NULL DEFAULT 'other',
  `title` varchar(255) NOT NULL,
  `type` enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Payment`
--

LOCK TABLES `Payment` WRITE;
/*!40000 ALTER TABLE `Payment` DISABLE KEYS */;
INSERT INTO `Payment` VALUES (1,'paytr','Kredi Kart??','2'),(2,'paywant','Havale','3'),(3,'paytr','Mobil ??deme','2'),(4,'paytr','Yurt D??????','2');
/*!40000 ALTER TABLE `Payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PaymentSettings`
--

DROP TABLE IF EXISTS `PaymentSettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PaymentSettings` (
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `variables` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`slug`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PaymentSettings`
--

LOCK TABLES `PaymentSettings` WRITE;
/*!40000 ALTER TABLE `PaymentSettings` DISABLE KEYS */;
INSERT INTO `PaymentSettings` VALUES ('Batihost','batihost','{\"batihostID\":null,\"batihostEmail\":null,\"batihostToken\":null}','0'),('EFT (IBAN)','eft','{\"bankAccounts\":[]}','1'),('Ininal','ininal','{\"ininalBarcodes\":[]}','0'),('Keyubu','keyubu','{\"keyubuID\":null,\"keyubuToken\":null}','0'),('Papara','papara','{\"paparaNumbers\":[]}','0'),('Paylith','paylith','{\"paylithAPIKey\":\"3d6f6fa7482a9ba17cca684bd851cf1e\",\"paylithAPISecretKey\":\"QWZl1zokAJLs54ri4E4u5edGf\"}','1'),('PayTR','paytr','{\"paytrID\":\"245884\",\"paytrAPIKey\":\"B5dNE2K5pwmu5DrD\",\"paytrAPISecretKey\":\"BttuCyCBd6G21QYR\"}','1'),('Paywant','paywant','{\"paywantAPIKey\":\"LUDQ-PAY-WANT-2NU6RYL3-UAFG\",\"paywantAPISecretKey\":\"9RAL6K49KUBO\",\"paywantCommissionType\":\"1\"}','1'),('Rabisu','rabisu','{\"rabisuID\":null,\"rabisuToken\":null}','0'),('Shipy','shipy','{\"shipyAPIKey\":null}','0'),('Shopier','shopier','{\"shopierAPIKey\":\"b377726349e3cb551cb5547d0f379248\",\"shopierAPISecretKey\":\"0d4d6be369e21b014fbe010987bbef4e\"}','0'),('SlimmWeb','slimmweb','{\"slimmwebPaymentID\":null,\"slimmwebToken\":null}','0');
/*!40000 ALTER TABLE `PaymentSettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductCategories`
--

DROP TABLE IF EXISTS `ProductCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serverID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `imageID` char(32) NOT NULL,
  `imageType` varchar(6) NOT NULL DEFAULT 'jpg',
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductCategories`
--

LOCK TABLES `ProductCategories` WRITE;
/*!40000 ALTER TABLE `ProductCategories` DISABLE KEYS */;
INSERT INTO `ProductCategories` VALUES (1,1,0,'Kozmetik','kozmetik','eff2549d2429f6d0b11a5e30c96c7130','png','0');
/*!40000 ALTER TABLE `ProductCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductCommands`
--

DROP TABLE IF EXISTS `ProductCommands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductCommands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `command` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductCommands`
--

LOCK TABLES `ProductCommands` WRITE;
/*!40000 ALTER TABLE `ProductCommands` DISABLE KEYS */;
INSERT INTO `ProductCommands` VALUES (18,1,'lp u %username% parent addtemp vip 30d '),(20,2,'lp u %username% parent addtemp vip+ 30d '),(21,3,'lp u %username% parent addtemp mvip 30d '),(25,6,'lp u %username% parent addtemp rvip+ 120d'),(26,5,'lp u %username% parent addtemp rvip 90d'),(27,4,'lp u %username% parent addtemp mvip+ 30d ');
/*!40000 ALTER TABLE `ProductCommands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductCoupons`
--

DROP TABLE IF EXISTS `ProductCoupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductCoupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `products` text NOT NULL,
  `discount` int(3) unsigned NOT NULL DEFAULT '0',
  `piece` int(6) unsigned NOT NULL DEFAULT '0',
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductCoupons`
--

LOCK TABLES `ProductCoupons` WRITE;
/*!40000 ALTER TABLE `ProductCoupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProductCoupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductCouponsHistory`
--

DROP TABLE IF EXISTS `ProductCouponsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductCouponsHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `couponID` int(11) unsigned NOT NULL DEFAULT '0',
  `productID` int(11) unsigned NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductCouponsHistory`
--

LOCK TABLES `ProductCouponsHistory` WRITE;
/*!40000 ALTER TABLE `ProductCouponsHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProductCouponsHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductGifts`
--

DROP TABLE IF EXISTS `ProductGifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductGifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `giftType` enum('1','2') NOT NULL DEFAULT '1',
  `gift` int(11) NOT NULL,
  `piece` int(6) unsigned NOT NULL,
  `expiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductGifts`
--

LOCK TABLES `ProductGifts` WRITE;
/*!40000 ALTER TABLE `ProductGifts` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProductGifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductGiftsHistory`
--

DROP TABLE IF EXISTS `ProductGiftsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductGiftsHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `giftID` int(11) unsigned NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductGiftsHistory`
--

LOCK TABLES `ProductGiftsHistory` WRITE;
/*!40000 ALTER TABLE `ProductGiftsHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProductGiftsHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `serverID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `imageID` char(32) NOT NULL,
  `imageType` varchar(6) NOT NULL DEFAULT 'jpg',
  `details` text NOT NULL,
  `price` int(4) unsigned NOT NULL DEFAULT '0',
  `discountedPrice` int(4) unsigned NOT NULL DEFAULT '0',
  `discountExpiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `duration` int(4) NOT NULL,
  `stock` int(5) NOT NULL DEFAULT '-1',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,0,1,'VIP','52f68433437c1eb3c620a9b74440b0ea','png','<p>VIP</p>',25,0,'1000-01-01 00:00:00',30,-1,'2021-09-25 18:27:32'),(2,0,1,'VIP+','eefca722b7d0a822499342a1e7c8e7cd','png','<p>VIP+</p>',35,0,'1000-01-01 00:00:00',30,-1,'2021-09-25 18:28:04'),(3,0,1,'MVIP','4148f7f4f23384a481c9cb68bb7c68e8','png','<p>MVIP</p>',45,0,'1000-01-01 00:00:00',30,-1,'2021-09-25 18:29:10'),(4,0,1,'MVIP+','1d217c59197693bcfc0801a9656da845','png','<p>mvip+</p>',70,0,'1000-01-01 00:00:00',30,-1,'2022-02-13 19:21:26'),(5,0,1,'RVIP','667c462d54338eb68dc98521dcca098d','png','<p>RVIP</p>',250,0,'1000-01-01 00:00:00',90,200,'2022-02-13 19:23:17'),(6,0,1,'RVIP+','8c4f5bcc8c7662601daeee64b3e89e81','png','<p>RVIP+</p>',350,0,'1000-01-01 00:00:00',120,200,'2022-02-13 19:24:07');
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Servers`
--

DROP TABLE IF EXISTS `Servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `port` int(11) NOT NULL,
  `consoleID` enum('1','2','3') NOT NULL DEFAULT '1',
  `consolePort` int(11) NOT NULL,
  `consolePassword` varchar(255) NOT NULL,
  `imageID` char(32) NOT NULL,
  `imageType` varchar(6) NOT NULL DEFAULT 'jpg',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Servers`
--

LOCK TABLES `Servers` WRITE;
/*!40000 ALTER TABLE `Servers` DISABLE KEYS */;
/*!40000 ALTER TABLE `Servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Settings`
--

DROP TABLE IF EXISTS `Settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serverName` varchar(255) NOT NULL,
  `serverIP` varchar(255) NOT NULL,
  `serverVersion` varchar(255) NOT NULL,
  `siteSlogan` varchar(32) NOT NULL,
  `siteDescription` varchar(155) DEFAULT NULL,
  `siteTags` text,
  `rules` text NOT NULL,
  `supportMessageTemplate` text NOT NULL,
  `footerFacebook` varchar(255) NOT NULL DEFAULT '0',
  `footerTwitter` varchar(255) NOT NULL DEFAULT '0',
  `footerInstagram` varchar(255) NOT NULL DEFAULT '0',
  `footerYoutube` varchar(255) NOT NULL DEFAULT '0',
  `footerDiscord` varchar(255) NOT NULL DEFAULT '0',
  `footerEmail` varchar(255) NOT NULL DEFAULT '0',
  `footerPhone` varchar(255) NOT NULL DEFAULT '0',
  `footerWhatsapp` varchar(255) NOT NULL DEFAULT '0',
  `footerAboutText` varchar(255) NOT NULL DEFAULT '0',
  `recaptchaPagesStatus` text NOT NULL,
  `recaptchaPublicKey` varchar(255) NOT NULL DEFAULT '0',
  `recaptchaPrivateKey` varchar(255) NOT NULL DEFAULT '0',
  `analyticsUA` varchar(255) NOT NULL DEFAULT '0',
  `tawktoID` varchar(255) NOT NULL DEFAULT '0',
  `bonusCredit` int(3) unsigned NOT NULL DEFAULT '0',
  `oneSignalAppID` varchar(255) NOT NULL DEFAULT '0',
  `oneSignalAPIKey` varchar(255) NOT NULL DEFAULT '0',
  `headerLogoType` enum('1','2') NOT NULL DEFAULT '1',
  `topSalesStatus` enum('0','1') NOT NULL DEFAULT '1',
  `avatarAPI` enum('1','2') NOT NULL DEFAULT '1',
  `onlineAPI` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1',
  `passwordType` enum('1','2') NOT NULL DEFAULT '1',
  `sslStatus` enum('0','1') NOT NULL DEFAULT '0',
  `maintenanceStatus` enum('0','1') NOT NULL DEFAULT '0',
  `creditStatus` enum('0','1') NOT NULL DEFAULT '1',
  `giftStatus` enum('0','1') NOT NULL DEFAULT '1',
  `authStatus` enum('0','1') NOT NULL DEFAULT '0',
  `preloaderStatus` enum('0','1') NOT NULL DEFAULT '0',
  `debugModeStatus` enum('0','1') NOT NULL DEFAULT '0',
  `registerLimit` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `newsLimit` enum('3','6','9','12') NOT NULL DEFAULT '6',
  `commentsStatus` enum('0','1') NOT NULL DEFAULT '1',
  `storeDiscount` int(3) unsigned NOT NULL DEFAULT '0',
  `storeDiscountExpiryDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `storeDiscountProducts` text NOT NULL,
  `minPay` int(5) unsigned NOT NULL DEFAULT '1',
  `maxPay` int(5) unsigned NOT NULL DEFAULT '100',
  `smtpServer` varchar(255) DEFAULT NULL,
  `smtpPort` varchar(255) DEFAULT NULL,
  `smtpSecure` enum('1','2') NOT NULL DEFAULT '1',
  `smtpUsername` varchar(255) DEFAULT NULL,
  `smtpPassword` varchar(255) DEFAULT NULL,
  `smtpPasswordTemplate` text NOT NULL,
  `smtpTFATemplate` text NOT NULL,
  `mailVerifyTemplate` text NOT NULL,
  `webhookCreditURL` varchar(255) NOT NULL DEFAULT '0',
  `webhookStoreURL` varchar(255) NOT NULL DEFAULT '0',
  `webhookSupportURL` varchar(255) NOT NULL DEFAULT '0',
  `webhookNewsURL` varchar(255) NOT NULL DEFAULT '0',
  `webhookLotteryURL` varchar(255) NOT NULL DEFAULT '0',
  `webhookCreditTitle` varchar(255) NOT NULL DEFAULT 'Kredi',
  `webhookStoreTitle` varchar(255) NOT NULL DEFAULT 'Ma??aza',
  `webhookSupportTitle` varchar(255) NOT NULL DEFAULT 'Destek',
  `webhookNewsTitle` varchar(255) NOT NULL DEFAULT 'Haberler',
  `webhookLotteryTitle` varchar(255) NOT NULL DEFAULT '??ark??felek',
  `webhookCreditMessage` text NOT NULL,
  `webhookStoreMessage` text NOT NULL,
  `webhookSupportMessage` text NOT NULL,
  `webhookNewsMessage` text NOT NULL,
  `webhookLotteryMessage` text NOT NULL,
  `webhookCreditEmbed` text NOT NULL,
  `webhookStoreEmbed` text NOT NULL,
  `webhookSupportEmbed` text NOT NULL,
  `webhookNewsEmbed` text NOT NULL,
  `webhookLotteryEmbed` text NOT NULL,
  `webhookCreditImage` varchar(255) NOT NULL DEFAULT '0',
  `webhookStoreImage` varchar(255) NOT NULL DEFAULT '0',
  `webhookSupportImage` varchar(255) NOT NULL DEFAULT '0',
  `webhookNewsImage` varchar(255) NOT NULL DEFAULT '0',
  `webhookLotteryImage` varchar(255) NOT NULL DEFAULT '0',
  `webhookCreditColor` char(6) NOT NULL DEFAULT '000000',
  `webhookStoreColor` char(6) NOT NULL DEFAULT '000000',
  `webhookSupportColor` char(6) NOT NULL DEFAULT '000000',
  `webhookNewsColor` char(6) NOT NULL DEFAULT '000000',
  `webhookLotteryColor` char(6) NOT NULL DEFAULT '000000',
  `webhookCreditAdStatus` enum('0','1') NOT NULL DEFAULT '1',
  `webhookStoreAdStatus` enum('0','1') NOT NULL DEFAULT '1',
  `webhookSupportAdStatus` enum('0','1') NOT NULL DEFAULT '1',
  `webhookNewsAdStatus` enum('0','1') NOT NULL DEFAULT '1',
  `webhookLotteryAdStatus` enum('0','1') NOT NULL DEFAULT '1',
  `lastCheckAccounts` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `totalAccountCount` int(11) unsigned NOT NULL DEFAULT '0',
  `thisYearAccountCount` int(11) unsigned NOT NULL DEFAULT '0',
  `thisMonthAccountCount` int(11) unsigned NOT NULL DEFAULT '0',
  `lastMonthAccountCount` int(11) unsigned NOT NULL DEFAULT '0',
  `languageID` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Settings`
--

LOCK TABLES `Settings` WRITE;
/*!40000 ALTER TABLE `Settings` DISABLE KEYS */;
INSERT INTO `Settings` VALUES (1,'Riva Network','185.255.94.196','RivaClient','Riva Network, say??s??z oyun modun','Riva Network, say??s??z oyun moduna sahip, oynamas?? ??cretsiz bir minecraft sunucusudur. Hemen Riva Launcher indir ve aram??za kat??l!','riva,rivanetwork,network,minigames,client,launcher,en iyi client,riva network,en iyi sunucu!,g??ncelleme,duyuru,minecraft,minecraft en iyi sunucular!,minecraft sunucular,minecraft hile korumas??, bedwars, skywars, eggwars, survival, hayatta kalma, t??rk sunucu, oyna, minecraft oyna, eggwars oyna, bedwars oyna, skywars oyna, skyblock sunucusu','<div class=\"line\"><br></div><div class=\"sub-title\"><strong>H??LE VE MOD KULLANIMI</strong></div><p>Riva Network olarak en &ccedil;ok &ouml;nem verdi??imiz kurald??r ve aff?? yoktur. Tespit edilmesi durumunda, ayn?? adres &uuml;zerindeki b&uuml;t&uuml;n hesaplar engellenecektir.</p><p>Oyuna ek m&uuml;dahale edebilecek mod veya hile kullan??m?? yasakt??r. Hesab??n ak??beti, hile kullan??lmas?? durumunda s&uuml;resiz engel ile sonu&ccedil;lanacakt??r.</p><p>??unlar da dahildir;</p><ul><li>Di??er oyunculara haks??z avantaj sa??layan mod kullan??m??.</li><li>Hile yaz??l??mlar?? ile haks??z avantaj sa??lamak.</li><li>Regedit kullanarak haks??z avantaj sa??lamak.</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><strong>DOLANDIRMA &amp; TUZAK</strong></div><p>Oyun i&ccedil;i ba??ka oyuncular?? kand??rmak ve s&ouml;z verip tutmamak su&ccedil;tur, ve yasakt??r.\r\nBuna ek olarak doland??r??lan ki??iye e??yas?? geri verilmez.\r\nAyr??ca, ??????nlanma tuza???? yasak de??ildir.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>??LLEGAL OYUN</strong></div><p>Oyunlarda illegal yollar kullanarak haks??z rekabet sa??lamak yasakt??r.</p><p>??llegal oyuna ??unlar dahildir;</p><ul><li>Birden fazla hesap a&ccedil;arak payla????ml?? istatistik kazan??lmas??. (haks??z rekabet)</li><li>Birden fazla hesap ile ayn?? arenaya giri?? yap??p tek bir hesaba istatistik sa??lanmas?? (&ouml;rg&uuml;tlenmek)</li><li>Haks??z rekabet unsurlar?? kullanarak normal standartlar??n &uuml;zerinde istatistik kazan??lmas??. (haks??z rekabet)</li></ul><div class=\"line\"><br></div><div class=\"sub-title\"><strong>SOLO &amp; TAKIM KURALLARI</strong></div><p>Solo oyun modlar??nda herkes tektir ve tak??m olmak yasakt??r.<br>Tak??m oyun modlar??nda herkes kendi tak??m arkada????yla tak??m olmak zorundad??r.<br>Rakip tak??m ile tak??m olmak yasakt??r. Cezas?? 7 g&uuml;n solo oyun engelidir.<br>Tak??m &uuml;yelerine zarar vermek yasakt??r, cezas?? 7 g&uuml;n oyun engelidir.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>HESAP G&Uuml;VENL??????</strong></div><p>Hesap g&uuml;venli??i oyuncunun kendisine aittir. Herhangi bir ??ekilde ??ifre payla????m?? (Oyun i&ccedil;i veya d??????) hesab??n &ccedil;al??nma riskini artt??racakt??r. Bu ve bunun gibi olaylarda y&ouml;netim sorumlu tutulamaz, bundan dolay?? hesab??n??z??n ??ifresini kimseyle payla??may??n ve farkl?? sunucularda kullanmay??n. ??ifrenizin g&uuml;vende oldu??undan ve hi&ccedil; kimseye vermedi??inizden emin olun.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>UYGUNSUZ ??S??M/N??CK KULLANIMI</strong></div><p>Uygunsuz, k&uuml;f&uuml;rl&uuml; veya nefret i&ccedil;erikli kullan??c?? isimleriyle kay??t olmak yasakt??r.<br>Bu t&uuml;r hesaplara s&uuml;resiz engel at??lmaktad??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>YETK??L?? EK??BE SAYGI</strong></div><p>Oyun i&ccedil;i veya Discord ortam??nda yetkili ki??ilere kar???? sayg??l?? olun, sayg??s??zl??k yapman??z engellenmenize sebep olacakt??r.<br>Ayr??ca, yetkili ki??ileri rahats??z etmek, oyalamak ve bir konu hakk??nda yalan s&ouml;ylemek yasakt??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>T&Uuml;M KULLANICILARA SAYGI</strong></div><p>Oyun i&ccedil;i veya Discord ortam??nda insanlara kar???? sayg??l?? olun, internet ortam??nda bulunman??z istedi??iniz gibi davranabilece??iniz anlam??na gelmez. Sayg??s??zl??k yapan kullan??c??lar sunucudan engellenecektir.<br>&Uuml;stteki maddeye ek olarak;\r\nDil, din, ??rk, cinsiyet&ccedil;ilik, ya??l??l??k ve &ouml;z&uuml;rl&uuml;l&uuml;k gibi k&uuml;stah&ccedil;a bir dil kullan??m??na izin verilmeyecektir.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>&Ouml;ZEL HAYATIN G??ZL??L??????</strong></div><p>Oyun i&ccedil;i veya Riva Network sunucusuna ait platformlarda herhangi bir ki??inin &ouml;zel hayat??yla ilgili bilgi, g&ouml;r&uuml;nt&uuml; veya ses payla??mak b&uuml;y&uuml;k bir su&ccedil;tur.<br>Bu su&ccedil;u i??leyenler sunucudan s&uuml;resiz olarak engellenir ve gerekti??inde hakk??nda hukuki i??lem ba??lat??l??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>OYUN ??&Ccedil;?? &amp; DISCORD SOHBET</strong></div><p>Oyun sohbetini kullan??rken s&uuml;rekli ayn?? mesaj?? yazmay??n, reklam yapmay??n ve k&uuml;f&uuml;r kullanmay??n.<br>K&uuml;stah, uygunsuz dil ve i&ccedil;erik kesinlikle yasakt??r.<br>NOT: &Ouml;zel mesajla??malar (/ark mesaj, /ark duyuru, /msg, /pm) dahil de??ildir.<br>Buna ek olarak siyaset yapmak yasakt??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>OYUN ??&Ccedil;?? &amp; D??SCORD HESAP/E??YA SATMAK</strong></div><p>Oyun i&ccedil;inde hesap veya buna benzer sat????lar??n tamam?? ve bu sat????lara te??vik etmek yasakt??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>DESTEK S??STEM??</strong></div><p>Destek sistemini k&ouml;t&uuml;ye kullanan, ayn?? talebi &uuml;st &uuml;ste atan veya at??lmas?? i&ccedil;in ba??kalar??n?? &ouml;rg&uuml;tleyen kullan??c??lar hakk??nda s&uuml;resiz hesap ve talep atma engeli uygulan??r.<br>Destek sisteminde talep yollarken sahte, &uuml;zerinde oynanm????, de??i??tirilmi?? ve kas??tl?? kan??t yollayan kullan??c??lar hakk??nda s&uuml;resiz engel uygulan??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><strong>ENGELLENEN HESAPLAR</strong></div><p>&Uuml;zerinden 1 ay ge&ccedil;mi?? engellenen hesaplar??n itiraz?? kabul edilmemektedir.<br>Bundan dolay?? itiraz hakk?? bulunmamaktad??r.</p><p style=\"font-style: italic;\">Riva Network sunucusuna kay??t olan her kullan??c?? bu kurallar?? kabul etmi?? say??l??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>1- OYUN KURALLARI</h2></div><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.1 - UYGUNSUZ KULLANICI ADLARI/SK??NLER??</h4></div><p>Yetkililer taraf??ndan uygun g&ouml;r&uuml;lmeyen herhangi bir kullan??c?? ad?? veya skin, de??i??tirilinceye kadar sunucudan yasaklanacakt??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.2 - YASADI??I CL??ENT VEYA MOD KULLANIMI (H??LE KULLANIMI)</h4></div><p>Farkl?? bir ??ekilde oyun oynama avantaj?? sa??layan herhangi bir client/mod kullanmak yasakt??r. Yasad?????? client veya modlar kullanmak kesinlikle yasakt??r. Kill aura, anti-knockback, x-rayler, auto-clickerlar, makro bas????lar??, freecamlar, oyuncu lokasyonunu g&ouml;steren mapler, u&ccedil;mak yasad?????? modlara &ouml;rneklerdir. Regedit de buna dahil (Kay??t defterini d&uuml;zenleme). Bile bile yasad?????? modlar kullanan ki??iler ile tak??m olmak sizin de yasaklanman??za neden olabilir.</p><p><strong>Ceza s??ras??:</strong> 7 g&uuml;n yasaklanma (Sadece sentinel) -&gt; 30 g&uuml;n yasaklanma -&gt; Kal??c?? yasaklanma.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.3 - BUTTERFLY/DRAG TIKLAMASI</h4></div><p>Butterfly t??klamas?? saniyede t??klaman??z?? artt??rmak i&ccedil;in iki veya daha fazla parma????n??z?? kullanmak olarak tan??mlan??r. Drag t??klamas?? farenin d&uuml;??mesi boyunca s&uuml;r&uuml;klemek veya t??klama tu??unu s&uuml;r&uuml;kleme d&uuml;??mesi ile birle??tirmek olarak tan??mlan??r. Butterfly ve drag t??klamas??n??n her ikiside yasakt??r ve Sentinel taraf??ndan yasaklanmak ile sonu&ccedil;lanabilir.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.4 - Tak??m olmak/&Ccedil;apraz tak??m olmak</h4></div><p>Tak??m olmak kasten d&uuml;??man bir oyuncu ile solo mod olan bir oyunda birlikte olmak olarak tan??mlan??r. &Ccedil;apraz tak??m olmak ise kasten d&uuml;??man bir oyuncu ile tak??m modunda bir oyunda tak??m olmak olarak tan??mlan??r. Tak??m olmak ve &ccedil;apraz tak??m olmak solo ve tak??m modu olan oyunlarda kesinlikle yasakt??r.</p><p><strong>Ceza s??ras??:</strong> 7 g&uuml;n yasaklanma (Sadece sentinel) -&gt; 30 g&uuml;n yasaklanma -&gt; Kal??c?? yasaklanma.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.5 - TROLLEMEK</h4></div><p>Trollemek kasten ba??ka bir oyuncuya kar???? tek amac?? can s??kmak, &uuml;zmek, veya zorbal??k yapmak olmak olarak tan??mlan??r. Trollemek kesinlikle yasakt??r. Trollemek tak??m arkada????n?? &ouml;ld&uuml;rmek/zarar vermek, tak??m arkada??lar??ndan &ccedil;almak i&ccedil;in crafting tablelar?? k??rmak, Blockwars gibi oyunlarda sebepsiz yere savunmalar?? k??rmak, bir oyuncuyu arkada??/party davetleri ile spamlamak veya Tower Defense oyun modunda kasten tak??m arkada??lar??n??n kule yapmalar??n?? engellemek gibi bir&ccedil;ok ??ekilde olabilir. Trollemek ayr??ca Eggwars&#39;ta oyuncular?? obsidian ile kill farm?? yapmak i&ccedil;in engellemek yada sadece onlar?? s??k????t??rmak i&ccedil;in ve yumurtalar??n?? k??rmamak olarak kullan??labilir.</p><p><strong>Ceza s??ras??:</strong> 7 g&uuml;n yasaklanma (Sadece sentinel) -&gt; 30 g&uuml;n yasaklanma -&gt; Kal??c?? yasaklanma.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.6 - KAMP YAPMAK</h4></div><p>Kamp yapmak kas??tl?? olarak oyuncular??n size ula??mas??n??n imkans??z olaca???? ??ekilde oyundan ka&ccedil;mak olarak tan??mlan??r. Kamp yapmak kesinlikle yasakt??r. Kamp yapmak skybase yapmak, normal oyun alan??ndan uzakla??an yap??lar yapmak, lav gibi tehlikelerle kendinizi korumak, di??erlerinin size eri??ememesi gibi ??ekillerde olabilir. Asassins de shop kamp?? yapmak yasak de??ildir, ancak oyuncular aras??nda k??rg??nl????a neden olaca???? i&ccedil;in tavsiye edilmez. Eggwars oyununda kamp yapmak &uuml;reticiler i&ccedil;in veya yumurtalar??n?? savunmak i&ccedil;in farm yapanlar i&ccedil;in ge&ccedil;erli de??ildir.</p><p><strong>Ceza s??ras??:</strong> 7 g&uuml;n yasaklanma (Sadece sentinel) -&gt; 30 g&uuml;n yasaklanma -&gt; Kal??c?? yasaklanma.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.7 - BUG&#39;UN K&Ouml;T&Uuml;YE KULLANIMI</h4></div><p>Bug k&ouml;t&uuml;ye kullan??m?? kasten bir bugu veya hatay?? her t&uuml;rl&uuml; ??ekilde kullanmak olarak tan??mlan??r. Bug k&ouml;t&uuml;ye kullan??m?? kesinlikle yasakt??r. Buglar sitemizdeki Destek sayfas??ndan rapor edilebilir. Bilerek bug k&ouml;t&uuml;ye kullanan birisi ile birlikte &ccedil;al??????rsan??z sizde ceza ile sonu&ccedil;lanabilirsiniz.</p><p><strong>Ceza s??ras??:</strong> 7 g&uuml;n yasaklanma (Sadece sentinel) -&gt; 30 g&uuml;n yasaklanma -&gt; Kal??c?? yasaklanma.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.8 - CEZADAN KA&Ccedil;MAK</h4></div><p>Yapt??r??mlar??n ka&ccedil;??n??m??, ba??ka bir hesab?? kullanarak kendi yapt??r??m??n?? engelleyecek ??ekilde tan??mlan??r. Bir cezay?? ka&ccedil;??nmak, Kullan??c?? adlar??n??n ve uygunsuz derinin yasaklar??n??n d??????nda, di??er hesab??n??za uygulanmas?? i&ccedil;in ayn?? cezaya neden olacakt??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.9 - SAHTE KANIT SUNMAK</h4></div><p>Yetkili ekibe olayla ilgili kan??t istenildi??inde sahte kan??tlar??n g&ouml;nderilmesi yasakt??r. Sahte kan??tlar yetkili ekip taraf??ndan tespit edilirse kullan??c?? sunucudan uzakla??t??r??l??r.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>1.10 - HAKSIZ KAZAN&Ccedil; VEYA T??CARET HK.</h4></div><p>Oyunla ba??lant??s?? olan herhangi bir ??eyi ger&ccedil;ek para kar????l??????nda satmak kal??c?? uzakla??t??rma veya &uuml;r&uuml;n&uuml;n kar????l??k verilmeden geri al??nmas?? demektir.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h2>2 - SOHBET KURALLARI</h2></div><p>Sunucu sohbeti kurallar??, grup sohbeti ve &ouml;zel mesajlar dahil t&uuml;m sunucu sohbeti i&ccedil;in ge&ccedil;erlidir.</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>2.1 - K&Uuml;F&Uuml;R/HAKARET/ARGO/K&Ouml;T&Uuml; S&Ouml;Z KULLANIMI</h4></div><p>K&uuml;f&uuml;r etmek nefret dolu konu??malar veya di??er kullan??c??lar?? k&uuml;&ccedil;&uuml;msemek, rahats??z etmek veya &uuml;zmek amac??yla kullan??lan diller gibi sald??rgan bir dil kullan??lmas?? olarak tan??mlanmaktad??r. K&uuml;f&uuml;r etmek kesinlikle yasakt??r.</p><p><strong>Ceza s??ras??:</strong> Uyar?? -&gt; 3 g&uuml;n susturulma -&gt; 7 g&uuml;n susturulma -&gt; 30 g&uuml;n susturulma -&gt; Kal??c?? susturulma</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>2.2 - TEHD??TLER</h4></div><p>K&uuml;f&uuml;r etmek nefret dolu konu??malar veya di??er kullan??c??lar?? k&uuml;&ccedil;&uuml;msemek, rahats??z etmek veya &uuml;zmek amac??yla kullan??lan diller gibi sald??rgan bir dil kullan??lmas?? olarak tan??mlanmaktad??r. K&uuml;f&uuml;r etmek kesinlikle yasakt??r.</p><p><strong>Ceza s??ras??:</strong> 30 g&uuml;n susturulma -&gt; Kal??c?? susturulma</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>2.3 - SOHBET TROLLEMES??</h4></div><p>Sohbet trollemesi di??er oyuncular?? ??a????rtmak, kand??rmak veya di??er oyuncular?? trollemek i&ccedil;in kullan??lan bir dil olarak tan??mlan??r. Bu oyunculara Alt+F4 yapmalar??n?? s&ouml;ylemek, sahte gizli mesajlar yapmak i&ccedil;in renk kodlar?? kullanmak, ve di??erlerini trollemek gibi hileleri i&ccedil;erir. Sohbet trollemesi kesinlikle yasakt??r.</p><p><strong>Ceza s??ras??:</strong> Uyar?? -&gt; 1 g&uuml;n susturulma -&gt; 3 g&uuml;n susturulma -&gt; 7 g&uuml;n susturulma -&gt; 30 g&uuml;n susturulma -&gt; Kal??c?? susturulma</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>2.4 - SPAM YAPMAK</h4></div><p>Spam yapmak k??sa bir s&uuml;re i&ccedil;inde istenmeyen veya gereksiz mesajlar?? s??kl??kla g&ouml;ndermek olarak tan??mlan??r. Spam yapmak, rastgele emojilerden olu??an metinler payla??mak, tekrar tekrar ayn?? mesaj?? kullanmak, bedava rank istemek, ve di??er ??eyleri i&ccedil;erir. Spam yapmak kesinlikle yasakt??r.</p><p><strong>Ceza s??ras??:</strong> Uyar?? -&gt; 1 g&uuml;n msusturulma -&gt; 7 g&uuml;n susturulma -&gt; 30 g&uuml;n susturulma -&gt; Kal??c?? susturulma</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>2.5 - K??ML??????E B&Uuml;R&Uuml;NME</h4></div><p>Kimli??e b&uuml;r&uuml;nmek, di??er oyuncular?? sizi bir yetkili veya bir YouTuber oldu??unuza inand??rmaya zorlamaya &ccedil;al????mak olarak tan??mlan??r. Kimli??e b&uuml;r&uuml;nme kesin olarak yasakt??r.</p><p><strong>Ceza s??ras??:</strong> Uyar?? -&gt; 1 g&uuml;n susturulma -&gt; 7 g&uuml;n susturulma -&gt; 30 g&uuml;n susturulma -&gt; Kal??c?? susturulma</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>2.6 - DOLANDIRICILIK</h4></div><p>Doland??r??c??l??k bir oyuncuyu ??ifresi, ev adresi, finansal bilgileri veya daha fazlas?? gibi bilgileri if??a etmesi i&ccedil;in onlar?? kand??rmak olarak tan??mlan??r. Doland??r??c??l??k kesinlikle yasakt??r. Doland??r??c??l??k an??nda kal??c?? susturulman??za neden olacakt??r.</p><p><strong>Ceza s??ras??:</strong> Kal??c?? susturulma</p><div class=\"line\"><br></div><div class=\"sub-title\"><h4>2.7 - REKLAM</h4></div><p>Reklamc??l??k di??er sunucular??n, sosyal medya hesaplar??n??n, Youtube/Twitch hesaplar??n??n veya di??er herhangi mal veya hizmetin tan??t??m?? olarak tan??mlan??r. Youtube&#39;un veya yay??n yapman??n hafif reklamlar??na izin verilir, ancak spam yap??l??r veya k&ouml;t&uuml;ye kullan??lmas?? durumunda ceza ile sonu&ccedil;lanacakt??r. YouTuber rol&uuml;ne sahip kullan??c??lar kendi kanallar??n?? veya di??er sosyal medya hesaplar??n?? reklam yapabilir.</p><p><strong>Ceza s??ras??:</strong> Uyar?? (sadece Youtube, Twitch, veya di??er sosyal medya hesaplar??) -&gt; 1 g&uuml;n susturulma -&gt; 7 g&uuml;n susturulma -&gt; 30 g&uuml;n susturulma -&gt; Kal??c?? susturulma</p>','<p style=\"text-align: right;\">Merhaba <strong><span class=\"text-primary\">%username%</span></strong>,</p><p style=\"text-align: right;\">%message%</p>','https://www.facebook.com/rivadev.net','https://twitter.com/rivanetwork','https://www.instagram.com/rivanetwork/','https://www.youtube.com/channel/UCFTJ0JmTSqXz_dEoRuolhMg/featured','https://discord.gg/wWZ3Q4PPs6','info@rivanetwork.com.tr','0','0','Riva Network, say??s??z oyun moduna sahip, oynamas?? ??cretsiz bir minecraft sunucusudur. Hemen Riva Launcher indir ve aram??za kat??l!','{\"loginPage\":\"1\",\"registerPage\":\"1\",\"recoverPage\":\"1\",\"newsPage\":\"0\",\"supportPage\":\"0\",\"tfaPage\":\"0\"}','6LcjzI0cAAAAAJ51DmvwXOwpQNeUybC293Jy0SDV','6LcjzI0cAAAAAIF5nOc3cJNMeO98H-lipu_Nl1Yz','0','0',0,'0','0','2','0','1','1','1','0','0','0','0','1','0','1','0','6','0',0,'1000-01-01 00:00:00','0',10,900,'smtp.yandex.com.tr','465','1','activation@rivanetwork.com.tr','Sn14075381346','<table cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;margin:0;padding:0;width:100%;\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:0;padding:0;width:100%;\" width=\"100%\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';padding:25px 0;text-align:center;\"><a href=\"#\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:#fff;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block;\" target=\"_blank\"><img src=\"https://www.rivanetwork.com.tr/apps/main/public/assets/img/uploads/7779734e15ed4016da243df3c7f92a9c722b3219.png\" style=\"width: 300px;\" class=\"fr-fic fr-dib\"></a><div><a href=\"#\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:#fff;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block;\" target=\"_blank\">Riva Network&nbsp;</a></div></td></tr><tr><td cellpadding=\"0\" cellspacing=\"0\" style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; background-color: rgb(31, 41, 51); border-bottom: 1px solid rgb(31, 41, 51); border-top: 1px solid rgb(31, 41, 51); margin: 0px; padding: 0px; width: 100%; text-align: center;\' width=\"100%\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;border-color:#fff;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px;\" width=\"570\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><span class=\"im\"><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; font-size: 18px; line-height: 1.5em; margin-top: 0px; text-align: center; color: rgb(255, 255, 255);\'>Hesab??n i&ccedil;in bir ??ifre s??f??rlama iste??i ald??????m??z i&ccedil;in bu e-postay?? al??yorsun.</p><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:30px auto;padding:0;text-align:center;width:100%;\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><div><a href=\"%url%\" rel=\"noopener\" style=\"font-size:18px;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';border-radius:4px;color:#fff;margin-top: 20px;display:inline-block;overflow:hidden;text-decoration:none;text-align:center;background:linear-gradient(180deg, #28b5f4 0%, #3758ff 100%);padding:15px 25px;\">??ifre S??f??rla</a></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; font-size: 18px; line-height: 1.5em; margin-top: 0px; text-align: center; color: rgb(255, 255, 255);\'>Bu ??ifre s??f??rlama linki 60 dakika sonra ge&ccedil;erlili??ini yitirecektir.</p><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; font-size: 18px; line-height: 1.5em; margin-top: 0px; text-align: center; color: rgb(255, 255, 255);\'>Bir parola s??f??rlama iste??inde bulunmad??ysan??z, ba??ka bir i??lem yapman??z gerekmez.</p><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; font-size: 18px; line-height: 1.5em; margin-top: 0px; text-align: center; color: rgb(255, 255, 255);\'>Sevgiler,<br>&copy; Riva Network</p>&nbsp;</span><table cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';border-top:1px solid #e8e5ef;margin-top:25px;padding-top:25px;\" width=\"100%\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; line-height: 1.5em; margin-top: 0px; text-align: center; font-size: 16px; color: rgb(255, 255, 255);\'><span style=\"color: rgb(239, 239, 239);\">&quot;??ifre S??f??rla&quot; d&uuml;??mesine t??klamakta sorun ya????yorsan a??a????daki adresi kopyalay??p internet taray??c??n??n adres k??sm??na yap????t??rabilirsin</span><br><br><span style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';word-break:break-all;\">%url%&nbsp;</span></p></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:0 auto;padding:0;text-align:center;width:570px;\" width=\"570\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><p style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';line-height:1.5em;margin-top:0;color:#ffffff60;font-size:14px;text-align:center;\"><span style=\"color: rgb(239, 239, 239);\">&copy; 2021 Riva Network. T&uuml;m haklar?? sakl??d??r.</span></p></td></tr><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><a href=\"#\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:rgba(255, 255, 255, 0.486);font-size:13px;text-decoration:underline;\" target=\"_blank\"><span style=\"color: rgb(239, 239, 239);\">RivaNetwork Resmi Web Sitesi</span></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>','<table cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;margin:0;padding:0;width:100%;\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:0;padding:0;width:100%;\" width=\"100%\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';padding:25px 0;text-align:center;\"><a href=\"%url%\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:#fff;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block;\" target=\"_blank\">&nbsp;<img src=\"https://www.rivanetwork.com.tr/apps/main/public/assets/img/uploads/7067d1ab67e33485c3903d76ba4e2995d7a53522.png\" style=\"width: 167px;\" class=\"fr-fic fr-dib\"></a><br><a href=\"%url%\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:#fff;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block;\" target=\"_blank\">Riva Network&nbsp;</a></td></tr><tr><td cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;border-bottom:1px solid #1f2933;border-top:1px solid #1f2933;margin:0;padding:0;width:100%;\" width=\"100%\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;border-color:#fff;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px;\" width=\"570\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><span class=\"im\">&nbsp;<p style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';font-size:18px;line-height:1.5em;margin-top:0;text-align:center;color:#fff;\"><b style=\"color:#3758ff;text-align:center;\"><span style=\"color: rgb(204, 204, 204);\">Merhaba %username%,</span></b></p>&nbsp;<p style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';font-size:18px;line-height:1.5em;margin-top:0;text-align:center;color:#fff;\">??ki ad??ml?? do??rulamay?? s??f??rlama iste??ini ald??k, a??a????daki ba??lant??y?? kullanarak iki ad??ml?? do??rulamay?? s??f??rlayabilirsin.</p>&nbsp;<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:30px auto;padding:0;text-align:center;width:100%;\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><div><a href=\"%url%\" rel=\"noopener\" style=\"font-size:18px;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';border-radius:4px;color:#fff;margin-top: 20px;display:inline-block;overflow:hidden;text-decoration:none;text-align:center;background:linear-gradient(180deg, #28b5f4 0%, #3758ff 100%);padding:15px 25px;\">SIFIRLA</a></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>&nbsp;</span><table cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';border-top:1px solid #e8e5ef;margin-top:25px;padding-top:25px;\" width=\"100%\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; line-height: 1.5em; margin-top: 0px; text-align: center; font-size: 16px; color: rgb(255, 255, 255);\'>Butona t??klamakta sorun ya????yorsan a??a????daki adresi kopyalay??p internet taray??c??n??n adres k??sm??na yap????t??rabilirsin</p><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; line-height: 1.5em; margin-top: 0px; text-align: center; font-size: 16px; color: rgb(255, 255, 255);\'><span style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';word-break:break-all;\"><a href=\"%url%\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:#28b5f4;\">%url%</a>&nbsp;</span></p></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:0 auto;padding:0;text-align:center;width:570px;\" width=\"570\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><p style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';line-height:1.5em;margin-top:0;color:#ffffff60;font-size:14px;text-align:center;\"><span style=\"color: rgb(255, 255, 255);\">&copy; 2022 Riva Network. T&uuml;m haklar?? sakl??d??r.</span></p></td></tr><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><a href=\"https://www.rivanetwork.com.tr/\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:rgba(255, 255, 255, 0.486);font-size:13px;text-decoration:underline;\"><span style=\"color: rgb(255, 255, 255);\">RivaNetwork Resmi Web Sitesi</span></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>','<table cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;margin:0;padding:0;width:100%;\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:0;padding:0;width:100%;\" width=\"100%\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';padding:25px 0;text-align:center;\"><a href=\"%url%\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:#fff;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block;\"></a><img src=\"https://www.rivanetwork.com.tr/apps/main/public/assets/img/uploads/cd09715ea92c457bd00ba113996647f53562230d.png\" style=\"width: 165px;\" class=\"fr-fic fr-dib\">&nbsp;Riva Network</td></tr><tr><td cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;border-bottom:1px solid #1f2933;border-top:1px solid #1f2933;margin:0;padding:0;width:100%;\" width=\"100%\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';background-color:#1f2933;border-color:#fff;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px;\" width=\"570\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><span class=\"im\">&nbsp;<p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; font-size: 18px; line-height: 1.5em; margin-top: 0px; text-align: center; color: rgb(255, 255, 255);\'>L&uuml;tfen e-posta adresini do??rulamak i&ccedil;in a??a????daki butona t??kla.</p>&nbsp;<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:30px auto;padding:0;text-align:center;width:100%;\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\" width=\"100%\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><div><a href=\"%url%\" rel=\"noopener\" style=\"font-size:18px;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';border-radius:4px;color:#fff;margin-top: 20px;display:inline-block;overflow:hidden;text-decoration:none;text-align:center;background:linear-gradient(180deg, #28b5f4 0%, #3758ff 100%);padding:15px 25px;\">E-Posta Adresini Do??rula</a></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>&nbsp;<p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; font-size: 18px; line-height: 1.5em; margin-top: 0px; text-align: center; color: rgb(255, 255, 255);\'>Bir hesap olu??turmad??ysan??z, ba??ka bir i??lem yapman??z gerekmez.</p>&nbsp;<p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; font-size: 18px; line-height: 1.5em; margin-top: 0px; text-align: center; color: rgb(255, 255, 255);\'>Sevgiler,<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Riva Network | T&uuml;m haklar?? sakl??d??r! </p>&nbsp;</span><table cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';border-top:1px solid #e8e5ef;margin-top:25px;padding-top:25px;\" width=\"100%\"><tbody><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; line-height: 1.5em; margin-top: 0px; text-align: center; font-size: 16px; color: rgb(255, 255, 255);\'>&quot;E-posta Adresini Do??rula&quot; d&uuml;??mesine t??klamakta sorun ya????yorsan a??a????daki adresi kopyalay??p internet taray??c??n??n adres k??sm??na yap????t??rabilirsin.</p><p style=\'box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; line-height: 1.5em; margin-top: 0px; text-align: center; font-size: 16px; color: rgb(255, 255, 255);\'><span style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';word-break:break-all;\"><a href=\"%url%\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:#28b5f4;\">%url%</a>&nbsp;</span></p></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';\"><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';margin:0 auto;padding:0;text-align:center;width:570px;\" width=\"570\"><tbody><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><p style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';line-height:1.5em;margin-top:0;color:#ffffff60;font-size:14px;text-align:center;\"><span style=\"color: rgb(255, 255, 255);\">&copy; 2022 Riva Network T&uuml;m haklar?? sakl??d??r.</span></p></td></tr><tr><td align=\"center\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';max-width:100vw;padding:32px;\"><a href=\"https://www.rivanetwork.com.tr/\" style=\"box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif,\'Apple Color Emoji\',\'Segoe UI Emoji\',\'Segoe UI Symbol\';color:rgba(255, 255, 255, 0.486);font-size:13px;text-decoration:underline;\"><span style=\"color: rgb(255, 255, 255);\">RivaNetwork\r\nResmi Web Sitesi</span></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>','0','0','0','0','0','Kredi','Ma??aza','Destek','Haberler','??ark??felek','@everyone','@everyone','@everyone','@everyone','@everyone','**%username%** adl?? kullan??c?? **%credit% kredi** (%money% TL) y??kledi.','**%username%** adl?? kullan??c?? **%server%** sunucusundan **%product%** ??r??n??n?? sat??n ald??.','**%username%** adl?? kullan??c?? destek mesaj?? g??nderdi.\n%panelurl%','**%username%** adl?? kullan??c?? habere yorum yapt??.\n%posturl%\n%panelurl%','**%username%** adl?? kullan??c?? **%lottery%** adl?? ??ark??felekten **%award%** adl?? ??d??l?? kazand??.','0','0','0','0','0','000000','000000','000000','000000','000000','1','1','1','1','1','2022-05-25 02:56:54',10,4,0,3,1);
/*!40000 ALTER TABLE `Settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Slider`
--

DROP TABLE IF EXISTS `Slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '#',
  `imageID` char(32) NOT NULL,
  `imageType` varchar(6) NOT NULL DEFAULT 'jpg',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Slider`
--

LOCK TABLES `Slider` WRITE;
/*!40000 ALTER TABLE `Slider` DISABLE KEYS */;
INSERT INTO `Slider` VALUES (1,'NELER OLUYOR?','RIVA NETWORK????? Ekibi olarak 7/24 ??al????malara devam ediyor ve her t??rl?? fedakarl?????? yap??yoruz. Ancak sizler tam olarak nas??l bir sunucu ile kar????la??aca????n??z?? bilmiyorsunuz. Bu y??zden sunucu hakk??nda biraz bilgi vermek istedik!','https://www.rivanetwork.com.tr/haber/2/neler-oluyor','988e2dfeccf091978e8d3ff2731a8bfe','png'),(2,'(G)OLD ROZET??!','Evet! Burada daha sunucu a????lmadan bizi destekleyen insanlar i??in g??zel bir hediyemiz, zamanla daha da de??erli olacak bir hediyemiz var.','https://www.rivanetwork.com.tr/haber/1/guncelleme','d0eef3caaeb2100914eeac6ebd126157','png');
/*!40000 ALTER TABLE `Slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StoreHistory`
--

DROP TABLE IF EXISTS `StoreHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StoreHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `serverID` int(11) NOT NULL,
  `price` int(4) unsigned NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StoreHistory`
--

LOCK TABLES `StoreHistory` WRITE;
/*!40000 ALTER TABLE `StoreHistory` DISABLE KEYS */;
INSERT INTO `StoreHistory` VALUES (1,1,2,1,1,'2021-09-25 18:38:49');
/*!40000 ALTER TABLE `StoreHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SupportAnswers`
--

DROP TABLE IF EXISTS `SupportAnswers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SupportAnswers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SupportAnswers`
--

LOCK TABLES `SupportAnswers` WRITE;
/*!40000 ALTER TABLE `SupportAnswers` DISABLE KEYS */;
/*!40000 ALTER TABLE `SupportAnswers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SupportCategories`
--

DROP TABLE IF EXISTS `SupportCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SupportCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SupportCategories`
--

LOCK TABLES `SupportCategories` WRITE;
/*!40000 ALTER TABLE `SupportCategories` DISABLE KEYS */;
INSERT INTO `SupportCategories` VALUES (1,'test'),(2,'test');
/*!40000 ALTER TABLE `SupportCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SupportMessages`
--

DROP TABLE IF EXISTS `SupportMessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SupportMessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `supportID` int(11) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `writeLocation` enum('1','2') NOT NULL DEFAULT '1',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SupportMessages`
--

LOCK TABLES `SupportMessages` WRITE;
/*!40000 ALTER TABLE `SupportMessages` DISABLE KEYS */;
INSERT INTO `SupportMessages` VALUES (8,1,5,'<p>asdasdas</p>','2','2021-12-02 21:53:52');
/*!40000 ALTER TABLE `SupportMessages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Supports`
--

DROP TABLE IF EXISTS `Supports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Supports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `serverID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `statusID` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `readStatus` enum('0','1') NOT NULL DEFAULT '0',
  `updateDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `creationDate` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `yetkili` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Supports`
--

LOCK TABLES `Supports` WRITE;
/*!40000 ALTER TABLE `Supports` DISABLE KEYS */;
INSERT INTO `Supports` VALUES (5,29,1,1,'Egemen o??tur','egemenin anas?? oruspu mu abi ?','2','0','2021-12-02 21:53:52','2021-12-02 21:53:36','RivaDarlin');
/*!40000 ALTER TABLE `Supports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Theme`
--

DROP TABLE IF EXISTS `Theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themeID` enum('0','1','2') NOT NULL DEFAULT '1',
  `colorID` enum('0','1','2','3','4') NOT NULL DEFAULT '1',
  `colors` text NOT NULL,
  `header` text NOT NULL,
  `customCSS` text,
  `broadcastStatus` enum('0','1') NOT NULL DEFAULT '0',
  `sliderStatus` enum('0','1') NOT NULL DEFAULT '0',
  `sliderStyle` enum('1','2') NOT NULL DEFAULT '1',
  `serverOnlineInfoStatus` enum('0','1') NOT NULL DEFAULT '1',
  `headerTheme` enum('1','2','3') NOT NULL DEFAULT '1',
  `headerStyle` enum('1','2') NOT NULL DEFAULT '1',
  `sidebarStatus` enum('0','1') NOT NULL DEFAULT '0',
  `newsCardStyle` enum('1','2') NOT NULL DEFAULT '1',
  `discordThemeID` enum('1','2') NOT NULL DEFAULT '1',
  `discordServerID` varchar(32) NOT NULL DEFAULT '0',
  `recaptchaThemeID` enum('1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Theme`
--

LOCK TABLES `Theme` WRITE;
/*!40000 ALTER TABLE `Theme` DISABLE KEYS */;
INSERT INTO `Theme` VALUES (1,'2','1','{\"body\":{\"background-color\":\"#12263f\"},\"a\":{\"color\":\"#ffffff\"},\"a:active, a:hover, a:focus\":{\"color\":\"#95aac9\"},\".color-main\":{\"color\":\"#5e72e4\"},\".color-main:hover\":{\"color\":\"#324cdd\"},\".color-primary\":{\"color\":\"#5e72e4\"},\".color-primary:hover\":{\"color\":\"#324cdd\"},\".color-success\":{\"color\":\"#2dce89\"},\".color-success:hover\":{\"color\":\"#24a46d\"},\".color-danger\":{\"color\":\"#f5365c\"},\".color-danger:hover\":{\"color\":\"#ec0c38\"},\".color-warning\":{\"color\":\"#fb6340\"},\".color-warning:hover\":{\"color\":\"#fa3a0e\"},\".color-info\":{\"color\":\"#11cdef\"},\".color-info:hover\":{\"color\":\"#0da5c0\"},\".btn-primary, .badge-primary, .alert-primary, .bg-primary\":{\"background-color\":\"#5e72e4\"},\".btn-success, .badge-success, .alert-success, .bg-success\":{\"background-color\":\"#2dce89\"},\".btn-danger, .badge-danger, .alert-danger, .bg-danger\":{\"background-color\":\"#f5365c\"},\".btn-warning, .badge-warning, .alert-warning, .bg-warning\":{\"background-color\":\"#fb6340\"},\".btn-info, .badge-info, .alert-info, .bg-info\":{\"background-color\":\"#11cdef\"},\".text-primary\":{\"color\":\"#5e72e4 !important\"},\".text-success\":{\"color\":\"#2dce89 !important\"},\".text-danger\":{\"color\":\"#f5365c !important\"},\".text-warning\":{\"color\":\"#fb6340 !important\"},\".text-info\":{\"color\":\"#11cdef !important\"},\".btn-primary\":{\"border-color\":\"#5e72e4\"},\".btn-primary.active, .btn-primary:active, .btn-primary:hover, .btn-primary:focus\":{\"border-color\":\"#324cdd\",\"background-color\":\"#324cdd\"},\".btn-success\":{\"border-color\":\"#2dce89\"},\".btn-success.active, .btn-success:active, .btn-success:hover, .btn-success:focus\":{\"border-color\":\"#24a46d\",\"background-color\":\"#24a46d\"},\".btn-danger\":{\"border-color\":\"#f5365c\"},\".btn-danger.active, .btn-danger:active, .btn-danger:hover, .btn-danger:focus\":{\"border-color\":\"#ec0c38\",\"background-color\":\"#ec0c38\"},\".btn-warning\":{\"border-color\":\"#fb6340\"},\".btn-warning.active, .btn-warning:active, .btn-warning:hover, .btn-warning:focus\":{\"border-color\":\"#fa3a0e\",\"background-color\":\"#fa3a0e\"},\".btn-info\":{\"border-color\":\"#11cdef\"},\".btn-info.active, .btn-info:active, .btn-info:hover, .btn-info:focus\":{\"border-color\":\"#0da5c0\",\"background-color\":\"#0da5c0\"},\".custom-control-input:checked~.custom-control-label::before\":{\"border-color\":\"#5e72e4\",\"background-color\":\"#5e72e4\"},\".broadcast\":{\"background-color\":\"#12263f\"},\".broadcast-link\":{\"color\":\"#ffffff !important\"},\".navbar-server\":{\"color\":\"#ffffff\",\"background-color\":\"#f5365c\"},\".navbar-server.active\":{\"background-color\":\"#02b875\"},\".server-online-info\":{\"color\":\"#ffffff\",\"background-color\":\"#f5365c\"},\".server-online-info.active\":{\"background-color\":\"#02b875\"},\".navbar-dark\":{\"background-color\":\"#152e4d\"},\".navbar-dark .navbar-nav .nav-link\":{\"color\":\"#ffffff !important\"},\".navbar-dark .navbar-nav .nav-item.active .nav-link, .navbar-dark .navbar-nav .nav-item:hover .nav-link, .navbar-dark .navbar-nav .nav-item:focus .nav-link\":{\"color\":\"#ffffff !important\",\"border-color\":\"#5e72e4\",\"background-color\":\"#5e72e4\"},\".navbar-dark .navbar-buttons .nav-item .nav-link\":{\"border-color\":\"#5e72e4\"},\".nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active\":{\"border-color\":\"#5e72e4\"},\".search-icon\":{\"color\":\"#ffffff\",\"background-color\":\"#5e72e4\"},\".footer-top\":{\"background-color\":\"#152e4d\"},\".footer-top, .footer-top ul li a\":{\"color\":\"#95aac9\"},\".footer-bottom\":{\"background-color\":\"#1e3a5c\"},\".card-header:first-child, .modal-header\":{\"background-color\":\"#5e72e4\"},\".pagination .page-item.active .page-link, .pagination .page-item.active .page-link:hover\":{\"border-color\":\"#5e72e4\",\"background-color\":\"#5e72e4\"},\".search-cancel:hover, .search-cancel:focus, .search-cancel:active\":{\"color\":\"#f5365c\"},\"#preloader .spinner-border\":{\"color\":\"#5e72e4\"},\"#scrollUp:hover\":{\"background-color\":\"#5e72e4\"},\".theme-color\":{\"background-color\":\"#5e72e4\"},\".theme-color.text-primary\":{\"color\":\"#5e72e4 !important\",\"background-color\":\"transparent\"},\".theme-color.btn, .theme-color.badge\":{\"border-color\":\"#5e72e4\"},\".theme-color.btn.active, .theme-color.btn:active, .theme-color.btn:hover, .theme-color.btn:focus\":{\"border-color\":\"#324cdd\",\"background-color\":\"#324cdd\"}}','[{\"id\":\"d3bed789aa7a396d9b1852db1cdcaa59\",\"title\":\"Ana Sayfa\",\"icon\":\"fa fa-home\",\"url\":\"/\",\"tabstatus\":\"0\",\"pagetype\":\"home\"},{\"id\":\"4749bca22ce57fa132550ce8425e3d03\",\"title\":\"Ma??aza\",\"icon\":\"fa fa-shopping-cart\",\"url\":\"/magaza\",\"tabstatus\":\"0\",\"pagetype\":\"store\"},{\"id\":\"5b62ee31e4f1ec89f41938c32656db56\",\"title\":\"S??ralama\",\"icon\":\"fa fa-trophy\",\"url\":\"/siralama\",\"tabstatus\":\"0\",\"pagetype\":\"leaderboards\"},{\"id\":\"970f6683937a425b67e8ed880df099b7\",\"title\":\"Destek\",\"icon\":\"fa fa-life-ring\",\"url\":\"/destek\",\"tabstatus\":\"0\",\"pagetype\":\"support\"},{\"id\":\"99efd820bb9bda04cfa41bbbf27c4fd6\",\"title\":\"Oyunlar\",\"icon\":\"fa fa-gamepad\",\"url\":\"/oyun\",\"tabstatus\":\"0\",\"pagetype\":\"games\"}]','','1','1','2','0','2','2','1','2','1','827627182506508299','2');
/*!40000 ALTER TABLE `Theme` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-26 21:54:32
