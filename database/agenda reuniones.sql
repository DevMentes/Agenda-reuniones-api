CREATE DATABASE  IF NOT EXISTS `agenda_reuniones_ciisa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `agenda_reuniones_ciisa`;
-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: agenda_reuniones_ciisa
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `meeting_user`
--

DROP TABLE IF EXISTS `meeting_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `meeting_user` (
  `meeting_id` varchar(36) NOT NULL COMMENT 'uuid for meeting',
  `user_id` varchar(36) NOT NULL COMMENT 'user identifier',
  `role` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Rol del usuario para esa reunion\n0 - organizador\n1 - invitado',
  `isConfirmed` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Indica si el usuario ha confirmado la invitacion o no\n\n0 - recibida\n1 - aceptada\n2 - rechazada',
  `assistence` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Asistencia del usuario a la reunion\n0 - asistio a la reunion.\n1 - no asistio a la reunion.\n2 - dejo la reunion',
  KEY `meeting_id` (`meeting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `meeting_user_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `meeting_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `meetings` (
  `id` varchar(36) NOT NULL COMMENT 'uuid for meeting',
  `date` date NOT NULL COMMENT 'fecha de la reunion',
  `start_at` time NOT NULL COMMENT 'Hora de inicio de la reunion\n',
  `finish_at` time NOT NULL COMMENT 'hora de termino de la reunion',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `restricted_hours`
--

DROP TABLE IF EXISTS `restricted_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `restricted_hours` (
  `id` varchar(36) NOT NULL COMMENT 'restricted_hour identifier',
  `user_id` varchar(36) NOT NULL COMMENT 'user identifier',
  `weekday` varchar(20) NOT NULL,
  `finish_at` time NOT NULL COMMENT 'finish hour fot restricted time',
  `start_at` time NOT NULL COMMENT 'start hour for restrict\n',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `restricted_hours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` varchar(36) NOT NULL COMMENT 'user identifier',
  `name` varchar(30) NOT NULL COMMENT 'Nombre del usuario',
  `surnames` varchar(60) NOT NULL COMMENT 'apellidos del usuario',
  `email` varchar(40) NOT NULL COMMENT 'Email del usuario',
  `password` varchar(300) NOT NULL COMMENT 'password de acceso',
  `type` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Tipo de usuario:\n\n0 - Normal\n1 - Administrador',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/* Create default admin user
    admin@email.com
    00000000
*/

INSERT INTO users (id, name, surnames, email, password, type)
VALUES (
           '71a0fd3d-54fe-4a86-9dac-5d732b0234b5',
           'admin',
           'ciisa admin',
           'admin@email.com',
           '$2y$10$2Le2nEvGsY166gQa7.q3SepEu4b6N20l8pTliYEpRTUSOwGo3zFGC',
           1
           );


-- Dump completed on 2018-12-06 16:58:15




