-- MySQL dump 10.11
--
-- Host: localhost    Database: courier
-- ------------------------------------------------------
-- Server version	5.0.77

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
-- Table structure for table `Courier_Info`
--

DROP TABLE IF EXISTS `Courier_Info`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Courier_Info` (
  `courier_id` int(11) NOT NULL auto_increment,
  `courier_type` varchar(30) default NULL,
  `student_name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `sender_add` varchar(40) NOT NULL,
  `taken` int(11) NOT NULL,
  `room` varchar(20) NOT NULL,
  `overlap` int(11) default NULL,
  `matched` varchar(20) NOT NULL,
  PRIMARY KEY  (`courier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21527 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Student` (
  `roll_no` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(60) default NULL,
  `room_no` varchar(30) default NULL,
  `phone` varchar(12) default NULL,
  `otheremail` varchar(60) default NULL,
  PRIMARY KEY  (`roll_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `account` (
  `name` varchar(30) default NULL,
  `roomno` varchar(10) default NULL,
  `hostel` varchar(10) default NULL,
  `rollno` bigint(20) default NULL,
  `email` varchar(50) default NULL,
  `passwd` varchar(50) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `courier`
--

DROP TABLE IF EXISTS `courier`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `courier` (
  `courierid` int(11) default NULL,
  `name` varchar(30) default NULL,
  `roomno` varchar(10) default NULL,
  `hostel` varchar(10) default NULL,
  `type` varchar(20) default NULL,
  `fromaddr` varchar(100) default NULL,
  `date_arrvd` date default NULL,
  `recvd` varchar(5) default 'no',
  `receiver` varchar(30) default 'none'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `information` (
  `username` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `pt`
--

DROP TABLE IF EXISTS `pt`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pt` (
  `rollno` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_entered` date NOT NULL,
  PRIMARY KEY  (`rollno`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-31 13:24:52
