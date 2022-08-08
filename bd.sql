-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for prueba
CREATE DATABASE IF NOT EXISTS `prueba` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prueba`;

-- Dumping structure for table prueba.administrador
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nombre_admin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `apellido_admin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `correo_admin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `contrasena_admin` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha_creacion_admin` datetime DEFAULT NULL,
  `fecha_actualizacion_admin` datetime DEFAULT NULL,
  `estado_admin` enum('A','I') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table prueba.administrador: 1 rows
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` (`id_admin`, `nombre_admin`, `apellido_admin`, `correo_admin`, `contrasena_admin`, `fecha_creacion_admin`, `fecha_actualizacion_admin`, `estado_admin`) VALUES
	(1, 'jorge', 'grimaldos', 'jorgegrimaldos85@gmail.com', '$2y$10$bfR0SY.o0HHbbjwBcuJcu.6GknAnxb8Zczv5rvdb6X7ixkElrSd3W', NULL, NULL, 'A');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;

-- Dumping structure for table prueba.estudiante
CREATE TABLE IF NOT EXISTS `estudiante` (
  `id_estudiante` int NOT NULL AUTO_INCREMENT,
  `nombre_estudiante` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `apellido_estudiante` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `correo_estudiante` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha_creacion_estudiante` datetime DEFAULT NULL,
  `fecha_actualizacion_estudiante` datetime DEFAULT NULL,
  `estado_estudiante` enum('A','I') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_estudiante`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table prueba.estudiante: 6 rows
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` (`id_estudiante`, `nombre_estudiante`, `apellido_estudiante`, `correo_estudiante`, `fecha_creacion_estudiante`, `fecha_actualizacion_estudiante`, `estado_estudiante`) VALUES
	(1, 'juan', 'rrrr', 'pruebaemail@dasda.com', '2022-08-06 01:40:39', '2022-08-07 02:40:25', 'I'),
	(2, 'jorge', 'cambio', 'test@test.com', '2022-08-06 01:40:59', '2022-08-07 06:23:28', 'A'),
	(3, 'prueba1', 'registro', 'asdasdasd@gmail.com', '2022-08-06 02:51:01', '2022-08-06 02:51:01', 'A'),
	(4, 'prueba2', 'registro', 'asdasdasd@gmail.com', '2022-08-06 02:51:01', '2022-08-06 02:51:01', 'A'),
	(5, 'prueba3', 'registro', 'asdasdasd@gmail.com', '2022-08-06 02:51:01', '2022-08-06 02:51:01', 'A'),
	(6, 'prueba4', 'registro', 'asdasdasd@gmail.com', '2022-08-06 02:51:01', '2022-08-06 02:51:01', 'A'),
	(7, 'juan ', 'rodriguez', 'jrr@gmail.com', '2022-08-07 06:25:06', '2022-08-07 06:25:29', 'A');
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;

-- Dumping structure for table prueba.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `id_profesor` int NOT NULL AUTO_INCREMENT,
  `nombre_profesor` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `apellido_profesor` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `correo_profesor` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `contrasena_profesor` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha_creacion_profesor` datetime DEFAULT NULL,
  `fecha_actualizacion_profesor` datetime DEFAULT NULL,
  `estado_profesor` enum('A','I') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_profesor`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table prueba.profesor: 9 rows
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` (`id_profesor`, `nombre_profesor`, `apellido_profesor`, `correo_profesor`, `contrasena_profesor`, `fecha_creacion_profesor`, `fecha_actualizacion_profesor`, `estado_profesor`) VALUES
	(1, 'test', 'test', 'test@test.com', NULL, '2022-08-05 06:36:07', '2022-08-05 06:36:07', 'A'),
	(2, 'asd', 'adsd', NULL, '$2y$10$vYcRmhSIW0Dqp3uUO3XYrOV4B4HEBOJap7deVHTl/dduud9lEmC.W', '2022-08-06 00:03:22', '2022-08-06 00:16:24', 'I'),
	(3, 'asd', 'adsd', 'sd@d', '$2y$10$YKp6zHUdIPrSisvsqxuLo.JeKG/g7WvePLDtFeArEBQrtuO.V7Ugu', '2022-08-06 00:05:00', '2022-08-06 00:16:25', 'I'),
	(4, 'asd', '123', 'jorgegrimaldos85@gmail.com', '$2y$10$2L3ECBA35Wb6WNoDCG0lpeos3RsnwA1J6nCBbXmjRV4qP6Xmcrwou', '2022-08-06 00:06:00', '2022-08-06 00:16:42', 'A'),
	(5, 'asd', '123', 'jorgegrimaldos85@gmail.com', '$2y$10$RrQIouzCCL1uMSYScy/8xeYQJVE1.inv2Fp05i9Sq3o4SHiZ/dq96', '2022-08-06 00:11:39', '2022-08-06 01:07:45', 'A'),
	(6, 'asd', '123', 'ddad@d.com', '$2y$10$nBWozWVckg8nK.U9OEWGUOwczQtnsrd0TJyrdJjDHJxfHr/NdjqqW', '2022-08-06 00:12:23', '2022-08-06 00:16:16', 'I'),
	(7, 'asd', 'das', 'albertogrimal2@hotmail.com', '$2y$10$VpXkaz3i7gHPzffdrhgW2u4S/LiailyNhfh8WM50qhmlykX/VsnV.', '2022-08-06 00:14:35', '2022-08-06 00:14:35', 'A'),
	(8, 'asd', 'asasda', 'albertogrimal2@hotmail.com', '$2y$10$rIOgqUfnt1V0EN2tMzJ8Yuqd96qws1Necdm14dTj2rHcYj6yZ0Ex2', '2022-08-06 00:15:11', '2022-08-06 00:16:27', 'I'),
	(9, 'asd', '123', 'ddad@d.com', '$2y$10$t7OKcYi/U8f/5x4Ak9GZDu6xuKYop0.3ulhofkHBf2kLqGOXRbrqi', '2022-08-06 00:16:05', '2022-08-06 00:16:19', 'I');
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;

-- Dumping structure for table prueba.rel_estudiante_salon
CREATE TABLE IF NOT EXISTS `rel_estudiante_salon` (
  `id_estudiante` int NOT NULL,
  `id_salon` int NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `estado` enum('A','I') DEFAULT NULL,
  PRIMARY KEY (`id_estudiante`,`id_salon`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- Dumping data for table prueba.rel_estudiante_salon: 12 rows
/*!40000 ALTER TABLE `rel_estudiante_salon` DISABLE KEYS */;
INSERT INTO `rel_estudiante_salon` (`id_estudiante`, `id_salon`, `fecha_creacion`, `fecha_actualizacion`, `estado`) VALUES
	(2, 6, NULL, NULL, 'A'),
	(1, 6, NULL, '2022-08-06 05:55:17', 'I'),
	(3, 6, NULL, '2022-08-06 05:54:33', 'I'),
	(4, 6, '2022-08-06 05:51:24', '2022-08-06 05:55:17', 'I'),
	(0, 6, '2022-08-06 05:51:35', '2022-08-06 05:55:17', 'A'),
	(3, 13, '2022-08-07 01:41:23', '2022-08-07 02:28:42', 'I'),
	(5, 13, '2022-08-07 01:41:23', '2022-08-07 02:25:58', 'I'),
	(1, 13, '2022-08-07 01:55:05', '2022-08-07 02:28:42', 'I'),
	(2, 13, '2022-08-07 01:58:45', '2022-08-07 02:29:58', 'A'),
	(4, 13, '2022-08-07 02:01:55', '2022-08-07 02:36:51', 'A'),
	(0, 13, '2022-08-07 02:07:38', '2022-08-07 02:25:58', 'I'),
	(6, 13, '2022-08-07 02:26:07', '2022-08-07 02:28:42', 'I');
/*!40000 ALTER TABLE `rel_estudiante_salon` ENABLE KEYS */;

-- Dumping structure for table prueba.salon
CREATE TABLE IF NOT EXISTS `salon` (
  `id_salon` int NOT NULL AUTO_INCREMENT,
  `id_profesor` int DEFAULT NULL,
  `nombre_salon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `descripcion_salon` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fecha_creacion_salon` datetime DEFAULT NULL,
  `fecha_actualizacion_salon` datetime DEFAULT NULL,
  `estado_salon` enum('A','I') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_salon`),
  KEY `FK_salon_profesor` (`id_profesor`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table prueba.salon: 7 rows
/*!40000 ALTER TABLE `salon` DISABLE KEYS */;
INSERT INTO `salon` (`id_salon`, `id_profesor`, `nombre_salon`, `descripcion_salon`, `fecha_creacion_salon`, `fecha_actualizacion_salon`, `estado_salon`) VALUES
	(1, 1, 'asdasd', NULL, '2022-08-06 00:55:48', '2022-08-06 01:10:18', 'A'),
	(2, 2, '222', '', '2022-08-06 00:58:19', '2022-08-07 02:29:05', 'A'),
	(3, 1, 'das', NULL, '2022-08-06 03:24:21', '2022-08-06 03:24:21', 'A'),
	(4, 1, 'das', '', '2022-08-06 03:24:37', '2022-08-06 03:24:37', 'A'),
	(5, 1, 'dasasdasd', 'ddddddddddd', '2022-08-06 03:25:00', '2022-08-06 03:25:00', 'A'),
	(6, 6, 'dasasdasd', 'asds', '2022-08-06 03:30:46', '2022-08-06 05:55:17', 'A'),
	(13, 5, 'prueba cambio', '', '2022-08-07 01:41:23', '2022-08-07 02:36:51', 'A');
/*!40000 ALTER TABLE `salon` ENABLE KEYS */;

-- Dumping structure for table prueba.token
CREATE TABLE IF NOT EXISTS `token` (
  `id_token` int unsigned NOT NULL AUTO_INCREMENT,
  `api_key` varchar(200) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `estado` enum('A','I') DEFAULT NULL,
  PRIMARY KEY (`id_token`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table prueba.token: 0 rows
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` (`id_token`, `api_key`, `fecha_creacion`, `fecha_actualizacion`, `estado`) VALUES
	(1, 'dasdasdasd123sadasd', NULL, NULL, 'A');
/*!40000 ALTER TABLE `token` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
