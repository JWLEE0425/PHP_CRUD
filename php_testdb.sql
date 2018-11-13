-- --------------------------------------------------------
-- host:                          127.0.0.1
-- server version:                10.2.5-MariaDB - mariadb.org binary distribution
-- server OS:                     Win64
-- HeidiSQL version:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- php_testdbのデータベースです。
CREATE DATABASE IF NOT EXISTS `php_testdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `php_testdb`;

CREATE TABLE IF NOT EXISTS `board` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `nickname` varchar(50) NOT NULL DEFAULT '0',
  `content` varchar(255) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(20) NOT NULL,
  `pw` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
