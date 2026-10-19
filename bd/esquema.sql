-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: terapia_ocupacional
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `testimonios`
--

DROP TABLE IF EXISTS `testimonios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `mensaje` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonios`
--

LOCK TABLES `testimonios` WRITE;
/*!40000 ALTER TABLE `testimonios` DISABLE KEYS */;
INSERT INTO `testimonios` VALUES (1,'Verónica Paredes','Mi hijo de 6 años mejoró su atención y sus rutinas de la mañana. La paciencia y el trato con toda la familia marcan la diferencia.','2026-10-14 10:12:00'),(2,'Tomás Ríos','Tras un año de ansiedad, reordenamos rutinas y hábitos. Sentí un plan pensado para mí y no una receta genérica.','2026-10-09 17:40:00'),(3,'Elena Vargas','Acompañaron a mi madre mayor para mantener su autonomía y evitar caídas. Explican todo con claridad y mucha calidez.','2026-10-02 09:25:00'),(4,'Ricardo Salas','Terapia para la mano tras un accidente laboral. Recuperé el agarre y pude reincorporarme al trabajo. Muy agradecido.','2026-09-25 16:05:00'),(5,'Paola Sánchez','La fisura de muñeca me dejaba sin fuerza. Con ejercicios guiados volví a pintar y a cargar a mi bebé sin miedo.','2026-09-18 11:30:00'),(6,'Andrés Herrera','La evaluaron a fondo antes de tratarla, algo que no vimos en otros lados. Su plan fue realista y los avances medibles mes a mes.','2026-09-10 15:18:00'),(7,'Carla Domínguez','Un espacio seguro y muy bien adaptado. Mi hija con autismo empezó a comunicarse mejor y nosotros aprendimos a apoyarla en casa.','2026-09-01 12:47:00'),(8,'Lucía Martínez','Después del ACV de mi papá, la terapia le devolvió la independencia para vestirse y comer solo. Acompañamiento humano y profesional.','2026-08-24 18:20:00'),(9,'Jorge Andrade','Llegué con dolor de espalda por el trabajo y en pocas semanas recuperé movilidad y postura. Las recomendaciones para casa fueron muy útiles.','2026-08-15 08:55:00'),(10,'María Fernanda Ruiz','Mi hijo mejoró muchísimo su motricidad fina y ahora escribe sin frustrarse. Cada sesión fue paciente, clara y con objetivos concretos.','2026-08-06 14:33:00');
/*!40000 ALTER TABLE `testimonios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-16 14:21:32
