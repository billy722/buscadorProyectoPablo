-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: pdisospechosos
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Temporary view structure for view `mostrarultimaimagen`
--

DROP TABLE IF EXISTS `mostrarultimaimagen`;
/*!50001 DROP VIEW IF EXISTS `mostrarultimaimagen`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `mostrarultimaimagen` AS SELECT 
 1 AS `nombre_imagen`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `registro_acciones`
--

DROP TABLE IF EXISTS `registro_acciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro_acciones` (
  `id_registro_acciones` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `direccion_ip` varchar(200) DEFAULT NULL,
  `tipo_accion` int(11) NOT NULL,
  `registro_accionescol` varchar(45) DEFAULT NULL,
  `run_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_registro_acciones`),
  KEY `fk_tipo_accion_registro_registroacciones_idx` (`tipo_accion`),
  CONSTRAINT `fk_tipo_accion_registro_registroacciones` FOREIGN KEY (`tipo_accion`) REFERENCES `tipo_accion_registro` (`id_tipoAccion`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_acciones`
--

LOCK TABLES `registro_acciones` WRITE;
/*!40000 ALTER TABLE `registro_acciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro_acciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cicatriz`
--

DROP TABLE IF EXISTS `tb_cicatriz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cicatriz` (
  `id_lugarCicatriz` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_lugarCicatriz` varchar(50) NOT NULL,
  PRIMARY KEY (`id_lugarCicatriz`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cicatriz`
--

LOCK TABLES `tb_cicatriz` WRITE;
/*!40000 ALTER TABLE `tb_cicatriz` DISABLE KEYS */;
INSERT INTO `tb_cicatriz` VALUES (1,'Brazos'),(2,'Manos'),(3,'Torso'),(4,'Espalda'),(5,'Rostro');
/*!40000 ALTER TABLE `tb_cicatriz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cicatrizsospechoso`
--

DROP TABLE IF EXISTS `tb_cicatrizsospechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cicatrizsospechoso` (
  `id_lugarCicatriz` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  PRIMARY KEY (`id_lugarCicatriz`,`run`),
  KEY `run` (`run`),
  CONSTRAINT `tb_cicatrizsospechoso_ibfk_1` FOREIGN KEY (`id_lugarCicatriz`) REFERENCES `tb_cicatriz` (`id_lugarCicatriz`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_cicatrizsospechoso_ibfk_2` FOREIGN KEY (`run`) REFERENCES `tb_sospechoso` (`run`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cicatrizsospechoso`
--

LOCK TABLES `tb_cicatrizsospechoso` WRITE;
/*!40000 ALTER TABLE `tb_cicatrizsospechoso` DISABLE KEYS */;
INSERT INTO `tb_cicatrizsospechoso` VALUES (1,9180376),(1,10763461),(3,12557469),(1,17913128),(1,18273352),(1,18319075),(1,18805897);
/*!40000 ALTER TABLE `tb_cicatrizsospechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_colorojos`
--

DROP TABLE IF EXISTS `tb_colorojos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_colorojos` (
  `id_colorOjos` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_colorOjos` varchar(100) NOT NULL,
  PRIMARY KEY (`id_colorOjos`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_colorojos`
--

LOCK TABLES `tb_colorojos` WRITE;
/*!40000 ALTER TABLE `tb_colorojos` DISABLE KEYS */;
INSERT INTO `tb_colorojos` VALUES (1,'Negro'),(2,'Cafe'),(3,'Verdes'),(4,'Azules');
/*!40000 ALTER TABLE `tb_colorojos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_colorpelo`
--

DROP TABLE IF EXISTS `tb_colorpelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_colorpelo` (
  `id_colorPelo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_colorPelo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_colorPelo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_colorpelo`
--

LOCK TABLES `tb_colorpelo` WRITE;
/*!40000 ALTER TABLE `tb_colorpelo` DISABLE KEYS */;
INSERT INTO `tb_colorpelo` VALUES (1,'Rubio'),(2,'Cafe'),(3,'Negro'),(4,'Canoso'),(5,'Colorin');
/*!40000 ALTER TABLE `tb_colorpelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_contextura`
--

DROP TABLE IF EXISTS `tb_contextura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_contextura` (
  `id_contextura` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_contextura` varchar(50) NOT NULL,
  PRIMARY KEY (`id_contextura`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_contextura`
--

LOCK TABLES `tb_contextura` WRITE;
/*!40000 ALTER TABLE `tb_contextura` DISABLE KEYS */;
INSERT INTO `tb_contextura` VALUES (1,'Delgada'),(2,'Media'),(3,'Gorda');
/*!40000 ALTER TABLE `tb_contextura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_delito`
--

DROP TABLE IF EXISTS `tb_delito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_delito` (
  `id_delito` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_delito` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_delito`),
  KEY `fk_tb_delito_estado_idx` (`estado`),
  CONSTRAINT `fk_estados_delitos` FOREIGN KEY (`estado`) REFERENCES `tb_estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_delito`
--

LOCK TABLES `tb_delito` WRITE;
/*!40000 ALTER TABLE `tb_delito` DISABLE KEYS */;
INSERT INTO `tb_delito` VALUES (1,'Hurto',1),(3,'robo por sorpresa',1),(4,'robo en bienes nacionales de uso publico',1),(5,'agresion a funcionario policial',1),(6,'secuestro',1),(7,'robo en lugar habitado',1),(8,'robo en lugar no habitado',1),(9,'abigeato',1),(10,'receptacion',1),(11,'consumo de drogas en via publica',1),(12,'estafas y otros delitos economicos',1),(13,'robo de vehiculo motorizado',1),(14,'homicidio',1),(15,'lesiones',1),(16,'porte elemento para cometer delito',1),(17,'abuso sexual',1),(18,'violacion',1),(19,'porte de arma cortopunzante',1),(25,'delito ley de drogas',1);
/*!40000 ALTER TABLE `tb_delito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_delitosopechoso`
--

DROP TABLE IF EXISTS `tb_delitosopechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_delitosopechoso` (
  `id_delito` int(11) NOT NULL,
  `run_sospechoso` int(11) NOT NULL,
  PRIMARY KEY (`id_delito`,`run_sospechoso`),
  KEY `run_sospechoso` (`run_sospechoso`),
  CONSTRAINT `tb_delitosopechoso_ibfk_2` FOREIGN KEY (`run_sospechoso`) REFERENCES `tb_sospechoso` (`run`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_delitosopechoso_ibfk_3` FOREIGN KEY (`id_delito`) REFERENCES `tb_delito` (`id_delito`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_delitosopechoso`
--

LOCK TABLES `tb_delitosopechoso` WRITE;
/*!40000 ALTER TABLE `tb_delitosopechoso` DISABLE KEYS */;
INSERT INTO `tb_delitosopechoso` VALUES (12,5408097),(17,6145579),(12,8099623),(17,8179904),(17,8435656),(1,9180376),(12,10617764),(12,10696620),(1,10763461),(17,11701575),(12,11962718),(12,12060734),(17,12324745),(12,12557469),(12,12558726),(12,13391186),(12,13802201),(1,13817003),(17,14067417),(17,14070013),(17,15206774),(12,15208211),(17,15629203),(12,16063221),(12,16284345),(12,16983118),(12,17217406),(1,17913128),(1,18273352),(1,18319075),(1,18344985),(17,18344985),(12,18800292),(1,18805897);
/*!40000 ALTER TABLE `tb_delitosopechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_equipofutbol`
--

DROP TABLE IF EXISTS `tb_equipofutbol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_equipofutbol` (
  `id_equipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_equipo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_equipo`),
  KEY `fk_estado_equipofutbol_idx` (`estado`),
  CONSTRAINT `fk_estado_equipofutbol` FOREIGN KEY (`estado`) REFERENCES `tb_estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_equipofutbol`
--

LOCK TABLES `tb_equipofutbol` WRITE;
/*!40000 ALTER TABLE `tb_equipofutbol` DISABLE KEYS */;
INSERT INTO `tb_equipofutbol` VALUES (1,'Colo-Colo',1),(2,'U de Chile',3),(3,'Catolica',1),(4,'Iberia',1),(5,'Barcelona',1),(6,'Real Madrid',1),(9,'klkl',1);
/*!40000 ALTER TABLE `tb_equipofutbol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_equiposospechoso`
--

DROP TABLE IF EXISTS `tb_equiposospechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_equiposospechoso` (
  `id_equipo` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  PRIMARY KEY (`id_equipo`,`run`),
  KEY `run` (`run`),
  CONSTRAINT `tb_equiposospechoso_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `tb_equipofutbol` (`id_equipo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_equiposospechoso_ibfk_2` FOREIGN KEY (`run`) REFERENCES `tb_sospechoso` (`run`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_equiposospechoso`
--

LOCK TABLES `tb_equiposospechoso` WRITE;
/*!40000 ALTER TABLE `tb_equiposospechoso` DISABLE KEYS */;
INSERT INTO `tb_equiposospechoso` VALUES (2,6145579),(6,8179904),(1,9180376),(1,10763461),(5,15206774),(4,16983118),(3,17217406),(1,17913128),(1,18273352),(1,18319075),(1,18805897);
/*!40000 ALTER TABLE `tb_equiposospechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estadocivil`
--

DROP TABLE IF EXISTS `tb_estadocivil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_estadocivil` (
  `id_estadoCivil` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estadoCivil` varchar(20) NOT NULL,
  PRIMARY KEY (`id_estadoCivil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estadocivil`
--

LOCK TABLES `tb_estadocivil` WRITE;
/*!40000 ALTER TABLE `tb_estadocivil` DISABLE KEYS */;
INSERT INTO `tb_estadocivil` VALUES (1,'soltero'),(2,'casado'),(3,'separado'),(4,'viudo');
/*!40000 ALTER TABLE `tb_estadocivil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estados`
--

DROP TABLE IF EXISTS `tb_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estados`
--

LOCK TABLES `tb_estados` WRITE;
/*!40000 ALTER TABLE `tb_estados` DISABLE KEYS */;
INSERT INTO `tb_estados` VALUES (1,'Activo'),(2,'Inactivo'),(3,'Eliminado');
/*!40000 ALTER TABLE `tb_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_grupoprivilegio`
--

DROP TABLE IF EXISTS `tb_grupoprivilegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_grupoprivilegio` (
  `id_privilegio` int(11) NOT NULL,
  `id_grupoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id_privilegio`,`id_grupoUsuario`),
  KEY `id_grupoUsuario` (`id_grupoUsuario`),
  CONSTRAINT `tb_grupoprivilegio_ibfk_1` FOREIGN KEY (`id_privilegio`) REFERENCES `tb_privilegios` (`id_privilegios`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_grupoprivilegio_ibfk_2` FOREIGN KEY (`id_grupoUsuario`) REFERENCES `tb_grupousuario` (`id_grupoUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_grupoprivilegio`
--

LOCK TABLES `tb_grupoprivilegio` WRITE;
/*!40000 ALTER TABLE `tb_grupoprivilegio` DISABLE KEYS */;
INSERT INTO `tb_grupoprivilegio` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(1,4);
/*!40000 ALTER TABLE `tb_grupoprivilegio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_grupousuario`
--

DROP TABLE IF EXISTS `tb_grupousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_grupousuario` (
  `id_grupoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_grupoUsuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id_grupoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_grupousuario`
--

LOCK TABLES `tb_grupousuario` WRITE;
/*!40000 ALTER TABLE `tb_grupousuario` DISABLE KEYS */;
INSERT INTO `tb_grupousuario` VALUES (1,'Administrador'),(4,'Buscador');
/*!40000 ALTER TABLE `tb_grupousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_imagen`
--

DROP TABLE IF EXISTS `tb_imagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_imagen` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_imagen` text NOT NULL,
  `fecha_imagen` date NOT NULL,
  `foto_principal` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imagen`
--

LOCK TABLES `tb_imagen` WRITE;
/*!40000 ALTER TABLE `tb_imagen` DISABLE KEYS */;
INSERT INTO `tb_imagen` VALUES (1,'JOFRE ZUNIGA PASCUAL JESUS.jpg','2016-05-31',1),(2,'ROA PILAR JUAN ANTONIO.jpg','2015-01-01',1),(3,'JOFRE ZUNIGA PASCUAL JESUS.jpg','2016-01-01',1),(4,'ORTIZ URIBE GERARDO ANDRES.jpg','2016-01-01',1),(5,'RUIZ FIGUEROA SERGIO ARNOLDO.jpg','2016-01-01',1),(6,'MARIN CALABRANO VICTOR FERNANDO.jpg','2016-01-01',1),(7,'QUEZADA LEON LUIS ANTONIO.jpg','2016-01-01',1),(8,'MONTOYA SAAVEDRA BENJAMIN.jpg','2016-01-01',1),(9,'BASCUR GUTIERREZ HIPOLITO RAMON.jpg','2016-01-01',1),(10,'CABEZAS RETAMAL RAMON HECTOR.jpg','2015-01-01',1),(11,'NAVARRETE ESPINOZA JOSE MAURICIO.jpg','2016-01-01',1),(12,'CAMPOS CACERES DIEGO ARMANDO.jpg','2016-01-01',1),(13,'NUÑEZ APABLAZA NICOLE ALEJANDRA.jpg','2016-01-01',1),(14,'NUÑEZ APABLAZA NICOLE ALEJANDRA.jpg','2016-01-01',1),(15,'SALAZAR CANDIA MARWIN EDGARDO.jpg','2016-01-01',1),(16,'GARCIA GONZALEZ SEBASTIAN ANDRES.jpg','2016-01-01',1),(17,'OSOSRIO PINO CRISTIAN NIVALDO.jpg','2016-01-01',1),(18,'OYARCE MORAGA MIGUEL ANGEL.jpg','2016-01-01',1),(19,'SAN MARTIN PABLO RAUL.jpg','2016-01-01',1),(20,'PINO ETTER MAURICIO ANTONIO.jpg','2016-01-01',1),(21,'PAREDES CARRASCO ALEX ROBERTO.jpg','2016-01-01',1),(22,'BELTRAN JOFRE WALDO HERNAN.jpg','2016-01-01',1),(23,'ESCOBAR BELTRAN PATRICIO HERNAN.jpg','2016-01-01',1),(24,'SANDOVAL CUEVAS JUAN CARLOS.jpg','2016-01-01',1),(25,'SOTO ORMEÑO CARLOS RODRIGO.jpg','2016-01-01',1),(26,'HERRERA GARRIDO LISARDO ELEUTERIO.jpg','2016-01-01',1),(27,'CASTRO PIZARRO CARLOS IGNACIO.jpg','2016-01-01',1),(30,'ARAYA SALAS RODRIGO IVAN.jpg','2016-01-06',1),(31,'ACENCIO SOARZO BRENDA ODETTE 01.jpg','2015-10-02',2),(32,'ACENCIO SOARZO BRENDA ODETTE 02.jpg','2014-01-01',1),(33,'Alejandro Meza.jpg','2016-11-14',1),(34,'WhatsApp Image 2016-10-26 at 10.41.08.jpeg','1992-05-03',1),(35,'reja3.png','1992-12-05',1),(36,'16395524-08-2015_18-48-596,2 24-08-15.jpg','2016-05-02',1),(37,'palta.jpg','2015-12-13',1);
/*!40000 ALTER TABLE `tb_imagen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_imagensospechoso`
--

DROP TABLE IF EXISTS `tb_imagensospechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_imagensospechoso` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `run_sospechoso` int(11) NOT NULL,
  PRIMARY KEY (`id_imagen`,`run_sospechoso`),
  KEY `run_sospechoso` (`run_sospechoso`),
  CONSTRAINT `tb_imagensospechoso_ibfk_2` FOREIGN KEY (`run_sospechoso`) REFERENCES `tb_sospechoso` (`run`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_imagensospechoso_ibfk_3` FOREIGN KEY (`id_imagen`) REFERENCES `tb_imagen` (`id_imagen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_imagensospechoso`
--

LOCK TABLES `tb_imagensospechoso` WRITE;
/*!40000 ALTER TABLE `tb_imagensospechoso` DISABLE KEYS */;
INSERT INTO `tb_imagensospechoso` VALUES (27,5408097),(10,6145579),(26,8099623),(9,8179904),(8,8435656),(24,10617764),(25,10696620),(36,10763461),(7,11701575),(23,11962718),(21,12060734),(6,12324745),(30,12557469),(20,12558726),(19,13391186),(22,13802201),(31,13817003),(32,13817003),(5,14067417),(4,14070013),(2,15206774),(18,15208211),(11,15629203),(17,16063221),(16,16284345),(15,16983118),(13,17217406),(14,17217406),(1,18344985),(3,18344985),(12,18800292),(37,91804567);
/*!40000 ALTER TABLE `tb_imagensospechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_piercing`
--

DROP TABLE IF EXISTS `tb_piercing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_piercing` (
  `id_lugarPiercing` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_lugarPiercing` varchar(50) NOT NULL,
  PRIMARY KEY (`id_lugarPiercing`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_piercing`
--

LOCK TABLES `tb_piercing` WRITE;
/*!40000 ALTER TABLE `tb_piercing` DISABLE KEYS */;
INSERT INTO `tb_piercing` VALUES (1,'Oreja'),(2,'Nariz'),(3,'Labio'),(4,'Ceja');
/*!40000 ALTER TABLE `tb_piercing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_piercingsospechoso`
--

DROP TABLE IF EXISTS `tb_piercingsospechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_piercingsospechoso` (
  `id_lugarPiercing` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  PRIMARY KEY (`id_lugarPiercing`,`run`),
  KEY `run` (`run`),
  CONSTRAINT `tb_piercingsospechoso_ibfk_1` FOREIGN KEY (`id_lugarPiercing`) REFERENCES `tb_piercing` (`id_lugarPiercing`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_piercingsospechoso_ibfk_2` FOREIGN KEY (`run`) REFERENCES `tb_sospechoso` (`run`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_piercingsospechoso`
--

LOCK TABLES `tb_piercingsospechoso` WRITE;
/*!40000 ALTER TABLE `tb_piercingsospechoso` DISABLE KEYS */;
INSERT INTO `tb_piercingsospechoso` VALUES (1,9180376),(1,10763461),(1,11701575),(1,17217406),(1,17913128),(1,18273352),(1,18319075),(1,18805897);
/*!40000 ALTER TABLE `tb_piercingsospechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_poblacion`
--

DROP TABLE IF EXISTS `tb_poblacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_poblacion` (
  `id_poblacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_poblacion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_poblacion`),
  KEY `estado` (`estado`),
  CONSTRAINT `tb_poblacion_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `tb_estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_poblacion`
--

LOCK TABLES `tb_poblacion` WRITE;
/*!40000 ALTER TABLE `tb_poblacion` DISABLE KEYS */;
INSERT INTO `tb_poblacion` VALUES (1,'Ohigginssss',1),(2,'Santiago Bueras',3),(3,'Contrera Gomez',1),(8,'Villa España',1),(10,'villa los profesores',1),(11,'Paillihue',1),(13,'billy',1),(14,'billy',1),(15,'bbb',1),(16,'llllll',1),(18,',m,ads',1),(22,'villa españa',1);
/*!40000 ALTER TABLE `tb_poblacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_poblacionsospechoso`
--

DROP TABLE IF EXISTS `tb_poblacionsospechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_poblacionsospechoso` (
  `id_poblacion` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  PRIMARY KEY (`id_poblacion`,`run`),
  KEY `run` (`run`),
  CONSTRAINT `tb_poblacionsospechoso_ibfk_1` FOREIGN KEY (`id_poblacion`) REFERENCES `tb_poblacion` (`id_poblacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_poblacionsospechoso_ibfk_2` FOREIGN KEY (`run`) REFERENCES `tb_sospechoso` (`run`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_poblacionsospechoso`
--

LOCK TABLES `tb_poblacionsospechoso` WRITE;
/*!40000 ALTER TABLE `tb_poblacionsospechoso` DISABLE KEYS */;
INSERT INTO `tb_poblacionsospechoso` VALUES (2,6145579),(1,9180376),(1,10763461),(1,17913128),(1,18273352),(1,18319075),(1,18805897);
/*!40000 ALTER TABLE `tb_poblacionsospechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_poblacionzonas`
--

DROP TABLE IF EXISTS `tb_poblacionzonas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_poblacionzonas` (
  `id_poblacion` int(11) NOT NULL,
  `id_zona` int(11) NOT NULL,
  PRIMARY KEY (`id_poblacion`,`id_zona`),
  KEY `fk_zona_poblacionzonas_idx` (`id_zona`),
  CONSTRAINT `fk_poblacion_poblacionzonas` FOREIGN KEY (`id_poblacion`) REFERENCES `tb_poblacion` (`id_poblacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_zona_poblacionzonas` FOREIGN KEY (`id_zona`) REFERENCES `tb_zona` (`id_zona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_poblacionzonas`
--

LOCK TABLES `tb_poblacionzonas` WRITE;
/*!40000 ALTER TABLE `tb_poblacionzonas` DISABLE KEYS */;
INSERT INTO `tb_poblacionzonas` VALUES (1,3),(2,3),(3,3),(3,4),(10,4),(8,5);
/*!40000 ALTER TABLE `tb_poblacionzonas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_privilegios`
--

DROP TABLE IF EXISTS `tb_privilegios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_privilegios` (
  `id_privilegios` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_privilegios` varchar(50) NOT NULL,
  PRIMARY KEY (`id_privilegios`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_privilegios`
--

LOCK TABLES `tb_privilegios` WRITE;
/*!40000 ALTER TABLE `tb_privilegios` DISABLE KEYS */;
INSERT INTO `tb_privilegios` VALUES (1,'Filtrar Sospechosos'),(2,'Mantenedor Sospechosos'),(3,'Ingresar Sospechoso'),(4,'Modificar Sospechoso'),(5,'Configuraciones'),(6,'Mantenedor Usuarios'),(7,'Mantenedor Privilegios'),(8,'Mantenedor Delitos'),(9,'Mantenedor Zonas'),(10,'Mantenedor Poblaciones'),(11,'Mantenedor Equipos');
/*!40000 ALTER TABLE `tb_privilegios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_rangoedad`
--

DROP TABLE IF EXISTS `tb_rangoedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_rangoedad` (
  `id_rangoEdad` int(11) NOT NULL AUTO_INCREMENT,
  `limite_inferior` int(11) NOT NULL,
  `limite_superior` int(11) NOT NULL,
  PRIMARY KEY (`id_rangoEdad`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_rangoedad`
--

LOCK TABLES `tb_rangoedad` WRITE;
/*!40000 ALTER TABLE `tb_rangoedad` DISABLE KEYS */;
INSERT INTO `tb_rangoedad` VALUES (1,0,14),(2,14,20),(3,21,25),(4,26,30),(5,31,35),(6,36,40),(7,41,45),(8,46,50),(9,51,55),(10,56,60),(11,61,100);
/*!40000 ALTER TABLE `tb_rangoedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_rangoestatura`
--

DROP TABLE IF EXISTS `tb_rangoestatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_rangoestatura` (
  `id_rangoEstatura` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_rangoEstatura` varchar(20) NOT NULL,
  `limite_inferior` float NOT NULL,
  `limite_superior` float NOT NULL,
  PRIMARY KEY (`id_rangoEstatura`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_rangoestatura`
--

LOCK TABLES `tb_rangoestatura` WRITE;
/*!40000 ALTER TABLE `tb_rangoestatura` DISABLE KEYS */;
INSERT INTO `tb_rangoestatura` VALUES (1,'Bajo',150,160),(2,'Medio',161,175),(3,'Alto',176,200);
/*!40000 ALTER TABLE `tb_rangoestatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sexo`
--

DROP TABLE IF EXISTS `tb_sexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_sexo` (
  `id_sexo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_sexo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sexo`
--

LOCK TABLES `tb_sexo` WRITE;
/*!40000 ALTER TABLE `tb_sexo` DISABLE KEYS */;
INSERT INTO `tb_sexo` VALUES (1,'femenino'),(2,'masculino');
/*!40000 ALTER TABLE `tb_sexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sospechoso`
--

DROP TABLE IF EXISTS `tb_sospechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_sospechoso` (
  `run` int(11) NOT NULL,
  `dv` varchar(1) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `lugar_deNacimiento` varchar(150) DEFAULT NULL,
  `id_colorPelo` int(11) DEFAULT NULL,
  `id_contextura` int(11) DEFAULT NULL,
  `id_estadoCivil` int(11) DEFAULT NULL,
  `id_sexo` int(11) DEFAULT NULL,
  `id_tezPiel` int(11) DEFAULT NULL,
  `id_tipoOjos` int(11) DEFAULT NULL,
  `id_tipoPelo` int(11) DEFAULT NULL,
  `antecedentes_penales` tinyint(1) DEFAULT NULL,
  `apodos` text,
  `barba` tinyint(1) DEFAULT NULL,
  `lentes` tinyint(1) DEFAULT NULL,
  `pecas` tinyint(1) DEFAULT NULL,
  `acne` tinyint(1) DEFAULT NULL,
  `bigote` tinyint(1) DEFAULT NULL,
  `manchas` tinyint(1) DEFAULT NULL,
  `estatura` float DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`run`),
  KEY `id_colorpelo` (`id_colorPelo`),
  KEY `id_estadocivl` (`id_estadoCivil`),
  KEY `id_sexo` (`id_sexo`),
  KEY `id_tezpiel` (`id_tezPiel`),
  KEY `id_tipoojos` (`id_tipoOjos`),
  KEY `id_tipopelo` (`id_tipoPelo`),
  KEY `id_contextura` (`id_contextura`),
  CONSTRAINT `tb_sospechoso_ibfk_1` FOREIGN KEY (`id_colorPelo`) REFERENCES `tb_colorpelo` (`id_colorPelo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_sospechoso_ibfk_3` FOREIGN KEY (`id_estadoCivil`) REFERENCES `tb_estadocivil` (`id_estadoCivil`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_sospechoso_ibfk_4` FOREIGN KEY (`id_sexo`) REFERENCES `tb_sexo` (`id_sexo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_sospechoso_ibfk_5` FOREIGN KEY (`id_tezPiel`) REFERENCES `tb_tezpiel` (`id_tezPiel`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_sospechoso_ibfk_6` FOREIGN KEY (`id_tipoOjos`) REFERENCES `tb_colorojos` (`id_colorOjos`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_sospechoso_ibfk_7` FOREIGN KEY (`id_tipoPelo`) REFERENCES `tb_tipopelo` (`id_tipoPelo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_sospechoso_ibfk_8` FOREIGN KEY (`id_contextura`) REFERENCES `tb_contextura` (`id_contextura`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sospechoso`
--

LOCK TABLES `tb_sospechoso` WRITE;
/*!40000 ALTER TABLE `tb_sospechoso` DISABLE KEYS */;
INSERT INTO `tb_sospechoso` VALUES (1791128,'5','PRUEBA&#39;','PRUEBA&#39;','PRUEBA&#39;','PRUEBA&#39;',1,1,1,1,1,1,1,0,'PRUEBA&#39;',0,0,0,0,0,0,546,'2013-12-04'),(5408097,'2','Carlos Ignacio','CASTRO','PIZARRO','Coquimbo',4,2,3,2,2,1,2,1,'',2,2,1,2,2,2,0,'1951-11-23'),(6145579,'5','Ramon Hector','CABEZAS ','RETAMAL','Los Angeles',4,1,1,2,1,2,3,1,'',2,2,2,2,2,2,0,'1948-08-31'),(8099623,'3','Lisardo Eleuterio','HERRERA','GARRIDO','Cunco',4,2,2,2,1,2,3,1,'',2,2,2,2,2,2,0,'1960-01-29'),(8179904,'0','Hipolito Ramon','BASCUR ','GUTIERREZ','Quilleco',4,1,1,2,1,2,3,1,'',2,2,2,2,1,2,0,'1956-09-10'),(8435656,'5','Benjamin ','Montoya','Saavedra','Pucon',4,2,2,2,1,2,3,1,'',2,2,2,2,2,2,0,'2016-10-10'),(9180376,'3','JONATHAN ','CEA','CEA','ANGOL',1,1,1,1,1,1,1,1,'JOHNNY',0,0,0,1,0,0,169,'1993-01-01'),(10617764,'3','Juan Carlos','SANDOVAL','CUEVAS','Los Angeles',3,2,2,2,2,2,3,1,'',2,2,2,2,2,2,0,'1969-06-27'),(10696620,'6','Carlos Rodrigo','SOTO','ORMENO','Independencia',3,1,2,2,2,1,3,1,'',1,2,2,2,2,2,0,'1968-01-16'),(10763461,'4','Ximena','rios','MORALES','MULCHEN',1,1,1,1,1,1,1,0,'XIME',0,0,0,0,0,0,160,'1963-11-02'),(11154404,'2','pablo','salce','sa','Santab',1,1,1,1,1,1,1,0,'pablo',0,0,0,0,0,0,154,'1992-02-02'),(11243784,'3','Pablo','salcedo','sep','',1,1,1,1,1,1,1,0,'',0,0,0,0,0,0,0,'1992-04-02'),(11701575,'0','Luis Antonio','Quezada ','leon','Mulchen',2,1,2,2,1,2,3,1,'',2,2,2,2,2,2,0,'1971-10-22'),(11962718,'4','Patricio Hernan','ESCOBAR ','BELTRAN','Los Angeles',3,2,2,2,1,2,3,1,'',1,1,2,2,1,2,0,'1972-07-30'),(12060734,'0','Alex Roberto','PAREDES','CARRASCO','Castro',3,1,3,2,2,1,3,1,'',2,1,2,2,2,2,0,'1973-07-26'),(12324745,'0','Victor','Marin','Marin','Rinconada del Laja',3,1,1,2,2,2,3,1,'',1,1,2,2,2,2,0,'1973-06-02'),(12326063,'5','Pablo','salcedo','sep','',1,1,1,1,1,1,1,0,'',0,0,0,0,0,0,0,'1992-04-02'),(12557469,'6','Rodrigo Ivan','ARAYA','SALAS','Los Angeles',3,2,2,2,1,1,1,1,'',1,2,2,2,2,2,177,'1973-10-17'),(12558726,'7','Mauricio Antonio','PINO','ETTER','Los Angeles',2,1,3,2,2,1,3,1,'',2,2,1,2,2,2,0,'1974-07-18'),(13391186,'3','Pablo Raul','PERALTA','SAN MARTIN','Santa Barabara',3,2,2,2,2,1,3,1,'',1,2,2,2,2,2,0,'1978-07-02'),(13802201,'3','Waldo Hernan','BELTRAN ','JOFRE','Los Angeles',3,2,3,2,1,2,3,1,'',2,2,2,2,2,2,0,'1972-10-29'),(13817003,'9','Brenda Odette','ACENCIO','SOARZO','Los Lagos',1,1,1,1,1,2,2,1,'',2,2,2,2,2,2,157,'1980-01-14'),(14067417,'6','Sergio Arnoldo','Ruiz','Figueroa','Los Angeles',2,1,3,2,1,2,3,1,'',1,2,2,2,1,2,0,'1980-12-16'),(14070013,'4','Gerardo Andres','ORTIZ','URIBE','Los Angeles',3,2,2,2,1,2,3,1,'',2,2,2,2,2,2,0,'1981-11-24'),(15206774,'7','Juan Antobio','Roa ','Pila','Los Angeles',3,2,2,2,2,1,3,1,'',2,2,2,2,2,2,0,'1982-06-08'),(15208211,'8','Miguel Angel','OYARCE','MORAGA','Los Angeles',1,1,1,2,1,2,3,1,'',1,2,2,2,1,2,0,'1982-07-01'),(15629203,'6','Jose Mauricio','NAVARRETE ','ESPINOZA','Los Angeles',3,1,1,2,2,1,3,1,'',2,2,1,2,2,2,0,'1983-11-07'),(16063221,'6','Cristian Nivaldo','OSORIO ','PINO','Los Angeles',3,1,1,2,1,1,3,1,'',1,2,1,2,2,2,0,'1985-09-23'),(16284345,'1','Sebastian Andres','GARCIA','GONZALEZ','Concepcion',1,1,1,2,1,4,3,1,'',1,2,1,2,1,2,0,'1986-12-02'),(16983118,'1','Marwin Egardo','SALAZAR','CANDIA','Los Angeles',3,1,1,2,1,1,3,1,'',2,2,1,2,2,2,0,'1988-09-26'),(17217406,'K','Nicole Alejandra','NUNEZ','APABLAZA','Los Angeles',3,2,1,1,1,2,2,1,'',2,2,2,2,2,2,0,'1989-12-06'),(17913128,'5','JONATHAN ','CEA','CEA','ANGOL',1,1,1,1,1,1,1,1,'JOHNNY',0,0,0,1,0,0,169,'1993-01-01'),(18273352,'0','Billy','salazar','RIOS','MULCHEN',1,1,1,1,1,1,1,1,'BILLY',0,1,0,2,0,1,164,'1992-06-22'),(18319075,'k','JONATHAN ','CEA','CEA','ANGOL',1,1,1,1,1,1,1,1,'JOHNNY',0,0,0,1,0,0,169,'1993-01-01'),(18344985,'0','Pascual Jesus','Jofre','Zuñiga','Los Angeles',2,1,1,2,1,2,3,1,'',0,0,1,0,0,0,0,'1992-12-10'),(18800292,'7','Diego Armando','CAMPOS','CACERES','',3,1,1,2,2,1,3,1,'',2,2,2,2,2,2,0,'1994-11-14'),(18805897,'3','BILLY','SALAZAR','RIOS','MULCHEN',1,1,1,1,1,1,1,1,'BILLY',0,1,0,1,1,0,164,'1992-06-22'),(91804567,'4','Eduardo&#39;','salazar&#39;','MORALES&#39;','MULCHEN&#39;',1,1,1,1,1,1,1,0,'LALO&#39;',0,0,0,0,0,0,160,'2016-12-31');
/*!40000 ALTER TABLE `tb_sospechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tatuaje`
--

DROP TABLE IF EXISTS `tb_tatuaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tatuaje` (
  `id_lugarTatuaje` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_lugarTatuaje` varchar(50) NOT NULL,
  PRIMARY KEY (`id_lugarTatuaje`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tatuaje`
--

LOCK TABLES `tb_tatuaje` WRITE;
/*!40000 ALTER TABLE `tb_tatuaje` DISABLE KEYS */;
INSERT INTO `tb_tatuaje` VALUES (1,'Rostro'),(2,'Brazos'),(3,'Manos'),(4,'Torso'),(5,'Espalda');
/*!40000 ALTER TABLE `tb_tatuaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tatuajesospechoso`
--

DROP TABLE IF EXISTS `tb_tatuajesospechoso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tatuajesospechoso` (
  `id_lugarTatuaje` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  PRIMARY KEY (`id_lugarTatuaje`,`run`),
  KEY `run` (`run`),
  CONSTRAINT `tb_tatuajesospechoso_ibfk_1` FOREIGN KEY (`id_lugarTatuaje`) REFERENCES `tb_tatuaje` (`id_lugarTatuaje`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_tatuajesospechoso_ibfk_2` FOREIGN KEY (`run`) REFERENCES `tb_sospechoso` (`run`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tatuajesospechoso`
--

LOCK TABLES `tb_tatuajesospechoso` WRITE;
/*!40000 ALTER TABLE `tb_tatuajesospechoso` DISABLE KEYS */;
INSERT INTO `tb_tatuajesospechoso` VALUES (1,9180376),(1,10763461),(1,17913128),(1,18273352),(1,18319075),(1,18805897);
/*!40000 ALTER TABLE `tb_tatuajesospechoso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tezpiel`
--

DROP TABLE IF EXISTS `tb_tezpiel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tezpiel` (
  `id_tezPiel` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tezPiel` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tezPiel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tezpiel`
--

LOCK TABLES `tb_tezpiel` WRITE;
/*!40000 ALTER TABLE `tb_tezpiel` DISABLE KEYS */;
INSERT INTO `tb_tezpiel` VALUES (1,'Clara'),(2,'Morena'),(3,'Negra');
/*!40000 ALTER TABLE `tb_tezpiel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipopelo`
--

DROP TABLE IF EXISTS `tb_tipopelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tipopelo` (
  `id_tipoPelo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipoPelo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipoPelo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipopelo`
--

LOCK TABLES `tb_tipopelo` WRITE;
/*!40000 ALTER TABLE `tb_tipopelo` DISABLE KEYS */;
INSERT INTO `tb_tipopelo` VALUES (1,'calvo'),(2,'largo'),(3,'corto');
/*!40000 ALTER TABLE `tb_tipopelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usuarios` (
  `run` int(11) NOT NULL,
  `dv` char(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(50) NOT NULL,
  `apellidoMaterno` varchar(50) NOT NULL,
  `clave` text NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `id_grupoUsuario` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`run`),
  KEY `id_grupoUsuario` (`id_grupoUsuario`),
  KEY `fk_estado_usuarios_idx` (`estado`),
  CONSTRAINT `fk_estado_usuarioestado` FOREIGN KEY (`estado`) REFERENCES `tb_estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_grupoUsuario`) REFERENCES `tb_grupousuario` (`id_grupoUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (9180376,'3','Eduardo','Salazar','Morales','$2y$10$LP1EVC6.j0AmfUyeSRNUiuS20/8QqpYaiAieP0QSSFkhhxM4RM4fO','987546','billxy@perez.cl',1,1),(10761461,'4','Ximena','Rios','Morales','$2y$10$ivUIK1nH8Ow5lCiZLuP7ueD2QrsTz5endCi93tp9uxmQ547lEfc9.','126456','ximena@morales.cl',1,1),(15553901,'1','Arturo','Rivas','Huanquilef','$2y$10$fktDQlEkHfQsycj4v8m5kur5UAfvpHcitlom0xrrGDaDKQdCKGYx6','97373883','arivash@investigaciones.cl',1,2),(18273352,'0','Billy ','Salazar','rios','$2y$10$hQ3/AfaI6PP9wW5dPU3EpuE4DvwNAuWXmRWf614AQCNRYm7UzF9.e','789456','billy@perez.cl',1,1),(18805897,'3','Pablo','Salcedo','Sepulveda','$2y$10$1gWsn/miLpYlNZjUwsCru.vXao2AqOwwQEFMqREqFiJaBCNzyNpXe','123','pablo@hotmail.com',4,1);
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_zona`
--

DROP TABLE IF EXISTS `tb_zona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_zona` (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_zona` varchar(20) NOT NULL,
  PRIMARY KEY (`id_zona`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_zona`
--

LOCK TABLES `tb_zona` WRITE;
/*!40000 ALTER TABLE `tb_zona` DISABLE KEYS */;
INSERT INTO `tb_zona` VALUES (3,'Zona 3'),(4,'zona 4'),(5,'nose');
/*!40000 ALTER TABLE `tb_zona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_accion_registro`
--

DROP TABLE IF EXISTS `tipo_accion_registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_accion_registro` (
  `id_tipoAccion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_accion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipoAccion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_accion_registro`
--

LOCK TABLES `tipo_accion_registro` WRITE;
/*!40000 ALTER TABLE `tipo_accion_registro` DISABLE KEYS */;
INSERT INTO `tipo_accion_registro` VALUES (1,'Accede a login'),(2,'Datos incorrectos al ingresar'),(3,'Realiza busqueda');
/*!40000 ALTER TABLE `tipo_accion_registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_privilegios`
--

DROP TABLE IF EXISTS `vista_privilegios`;
/*!50001 DROP VIEW IF EXISTS `vista_privilegios`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_privilegios` AS SELECT 
 1 AS `id_privilegios`,
 1 AS `run`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vistadelitos`
--

DROP TABLE IF EXISTS `vistadelitos`;
/*!50001 DROP VIEW IF EXISTS `vistadelitos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vistadelitos` AS SELECT 
 1 AS `id_delito`,
 1 AS `descripcion_delito`,
 1 AS `estado`,
 1 AS `descripcion_estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vistaequipos`
--

DROP TABLE IF EXISTS `vistaequipos`;
/*!50001 DROP VIEW IF EXISTS `vistaequipos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vistaequipos` AS SELECT 
 1 AS `id_equipo`,
 1 AS `descripcion_equipo`,
 1 AS `estado`,
 1 AS `descripcion_estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vistapoblaciones`
--

DROP TABLE IF EXISTS `vistapoblaciones`;
/*!50001 DROP VIEW IF EXISTS `vistapoblaciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vistapoblaciones` AS SELECT 
 1 AS `id_poblacion`,
 1 AS `descripcion_poblacion`,
 1 AS `estado`,
 1 AS `descripcion_estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vistasospechoso`
--

DROP TABLE IF EXISTS `vistasospechoso`;
/*!50001 DROP VIEW IF EXISTS `vistasospechoso`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vistasospechoso` AS SELECT 
 1 AS `solorrun`,
 1 AS `run`,
 1 AS `nombres`,
 1 AS `apellido_paterno`,
 1 AS `apellido_materno`,
 1 AS `lugar_deNacimiento`,
 1 AS `descripcion_colorPelo`,
 1 AS `descripcion_contextura`,
 1 AS `descripcion_estadoCivil`,
 1 AS `descripcion_sexo`,
 1 AS `campoBuscar`,
 1 AS `antecedentes`,
 1 AS `estatura`,
 1 AS `fecha_nacimiento`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vistausuarios`
--

DROP TABLE IF EXISTS `vistausuarios`;
/*!50001 DROP VIEW IF EXISTS `vistausuarios`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vistausuarios` AS SELECT 
 1 AS `run`,
 1 AS `nombre`,
 1 AS `apellidoPaterno`,
 1 AS `apellidoMaterno`,
 1 AS `telefono`,
 1 AS `correo`,
 1 AS `id_grupoUsuario`,
 1 AS `descripcion_grupoUsuario`,
 1 AS `id_estado`,
 1 AS `descripcion_estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'pdisospechosos'
--

--
-- Dumping routines for database 'pdisospechosos'
--
/*!50003 DROP FUNCTION IF EXISTS `edad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `edad`(fechaNacimiento date) RETURNS int(11)
BEGIN
RETURN (select truncate(datediff( CURDATE(),fechaNacimiento)/365 ,0));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `comprobarDatosIngreso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobarDatosIngreso`(IN `rut` INT)
BEGIN
select run,clave,nombre,apellidoPaterno,apellidoMaterno,
id_grupoUsuario
 from tb_usuarios
 where tb_usuarios.run=rut
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `guardarImagen` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardarImagen`(direccionImagen text,fecha date,tipo int,run int)
BEGIN
declare idNuevaImagen int;
set idNuevaImagen=(select if(max(id_imagen) is null,1,max(id_imagen)+1) as id from tb_imagen);	
	
insert into tb_imagen values(idNuevaImagen,direccionImagen,fecha,tipo);
insert into tb_imagensospechoso values(idNuevaImagen,run);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertarModificarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarModificarUsuario`(
arg_run int,
arg_dv char,
arg_nombre varchar(50),
arg_apellidoPaterno varchar(50),
arg_apellidoMaterno varchar(50),
arg_clave TEXT,
arg_telefono varchar(45),
arg_correo varchar(200),
arg_grupoUsuario int,
arg_estado int
)
BEGIN
declare existeUsuario int;
set existeUsuario= (select run from tb_usuarios where run=arg_run);
    
		if existeUsuario is null then
			insert into tb_usuarios
			(run,dv,nombre,apellidoPaterno,apellidoMaterno,clave,telefono,correo,id_grupoUsuario,estado)
			values(arg_run,
            arg_dv,
            arg_nombre,
            arg_apellidoPaterno,
            arg_apellidoMaterno,
            arg_clave,arg_telefono,
            arg_correo,
            arg_grupoUsuario,
            arg_estado);
            
            select 2 as res;/*agregado*/
		else
			update tb_usuarios 
			set nombre=arg_nombre,
				apellidoPaterno=arg_apellidoPaterno,
                apellidoMaterno=arg_apellidoMaterno,
                clave=arg_clave,
				correo=arg_correo,
                telefono=arg_telefono,
				id_grupoUsuario=arg_grupoUsuario,
                estado=arg_estado
				where run=arg_run;
             
             select 3 as res;/*modificado*/   
		end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `privilegios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `privilegios`(run int)
BEGIN
declare grupo int;
set grupo = (select id_grupoUsuario from tb_usuarios where tb_usuarios.run=run);
SELECT id_privilegios,descripcion_privilegios FROM tb_privilegios
inner join tb_grupoprivilegio on tb_privilegios.id_privilegios=tb_grupoprivilegio.id_privilegio
where tb_grupoprivilegio.id_grupoUsuario=grupo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `mostrarultimaimagen`
--

/*!50001 DROP VIEW IF EXISTS `mostrarultimaimagen`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mostrarultimaimagen` AS select `tb_imagen`.`nombre_imagen` AS `nombre_imagen` from (`tb_imagensospechoso` join `tb_imagen` on((`tb_imagensospechoso`.`id_imagen` = `tb_imagen`.`id_imagen`))) where ((`tb_imagensospechoso`.`run_sospechoso` = 18273352) and (`tb_imagen`.`fecha_imagen` = (select max(`tb_imagen`.`fecha_imagen`) from (`tb_imagensospechoso` join `tb_imagen` on((`tb_imagensospechoso`.`id_imagen` = `tb_imagen`.`id_imagen`))) where (`tb_imagensospechoso`.`run_sospechoso` = 18273352)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_privilegios`
--

/*!50001 DROP VIEW IF EXISTS `vista_privilegios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_privilegios` AS select `tb_privilegios`.`id_privilegios` AS `id_privilegios`,`tb_usuarios`.`run` AS `run` from (((`tb_privilegios` join `tb_grupoprivilegio` on((`tb_privilegios`.`id_privilegios` = `tb_grupoprivilegio`.`id_privilegio`))) join `tb_grupousuario` on((`tb_grupoprivilegio`.`id_grupoUsuario` = `tb_grupousuario`.`id_grupoUsuario`))) join `tb_usuarios` on((`tb_grupousuario`.`id_grupoUsuario` = `tb_usuarios`.`id_grupoUsuario`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vistadelitos`
--

/*!50001 DROP VIEW IF EXISTS `vistadelitos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vistadelitos` AS select `tb_delito`.`id_delito` AS `id_delito`,`tb_delito`.`descripcion_delito` AS `descripcion_delito`,`tb_delito`.`estado` AS `estado`,`tb_estados`.`descripcion_estado` AS `descripcion_estado` from (`tb_delito` join `tb_estados` on((`tb_estados`.`id_estado` = `tb_delito`.`estado`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vistaequipos`
--

/*!50001 DROP VIEW IF EXISTS `vistaequipos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vistaequipos` AS select `tb_equipofutbol`.`id_equipo` AS `id_equipo`,`tb_equipofutbol`.`descripcion_equipo` AS `descripcion_equipo`,`tb_equipofutbol`.`estado` AS `estado`,`tb_estados`.`descripcion_estado` AS `descripcion_estado` from (`tb_equipofutbol` join `tb_estados` on((`tb_estados`.`id_estado` = `tb_equipofutbol`.`estado`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vistapoblaciones`
--

/*!50001 DROP VIEW IF EXISTS `vistapoblaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vistapoblaciones` AS select `tb_poblacion`.`id_poblacion` AS `id_poblacion`,`tb_poblacion`.`descripcion_poblacion` AS `descripcion_poblacion`,`tb_poblacion`.`estado` AS `estado`,`tb_estados`.`descripcion_estado` AS `descripcion_estado` from (`tb_poblacion` join `tb_estados` on((`tb_estados`.`id_estado` = `tb_poblacion`.`estado`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vistasospechoso`
--

/*!50001 DROP VIEW IF EXISTS `vistasospechoso`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vistasospechoso` AS select `tb_sospechoso`.`run` AS `solorrun`,concat(`tb_sospechoso`.`run`,'-',`tb_sospechoso`.`dv`) AS `run`,`tb_sospechoso`.`nombres` AS `nombres`,`tb_sospechoso`.`apellido_paterno` AS `apellido_paterno`,`tb_sospechoso`.`apellido_materno` AS `apellido_materno`,`tb_sospechoso`.`lugar_deNacimiento` AS `lugar_deNacimiento`,`tb_colorpelo`.`descripcion_colorPelo` AS `descripcion_colorPelo`,`tb_contextura`.`descripcion_contextura` AS `descripcion_contextura`,`tb_estadocivil`.`descripcion_estadoCivil` AS `descripcion_estadoCivil`,`tb_sexo`.`descripcion_sexo` AS `descripcion_sexo`,concat(concat(`tb_sospechoso`.`run`,'-',`tb_sospechoso`.`dv`),' ',`tb_sospechoso`.`nombres`,' ',`tb_sospechoso`.`apellido_paterno`,' ',`tb_sospechoso`.`apellido_materno`,' ',`tb_sospechoso`.`lugar_deNacimiento`,' ',`tb_sospechoso`.`apodos`,' ',`tb_sospechoso`.`fecha_nacimiento`) AS `campoBuscar`,if((`tb_sospechoso`.`antecedentes_penales` = 1),'Si','No') AS `antecedentes`,`tb_sospechoso`.`estatura` AS `estatura`,`tb_sospechoso`.`fecha_nacimiento` AS `fecha_nacimiento` from ((((`tb_sospechoso` join `tb_colorpelo` on((`tb_sospechoso`.`id_colorPelo` = `tb_colorpelo`.`id_colorPelo`))) join `tb_contextura` on((`tb_sospechoso`.`id_contextura` = `tb_contextura`.`id_contextura`))) join `tb_estadocivil` on((`tb_sospechoso`.`id_estadoCivil` = `tb_estadocivil`.`id_estadoCivil`))) join `tb_sexo` on((`tb_sospechoso`.`id_sexo` = `tb_sexo`.`id_sexo`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vistausuarios`
--

/*!50001 DROP VIEW IF EXISTS `vistausuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vistausuarios` AS select concat(`tb_usuarios`.`run`,'-',`tb_usuarios`.`dv`) AS `run`,`tb_usuarios`.`nombre` AS `nombre`,`tb_usuarios`.`apellidoPaterno` AS `apellidoPaterno`,`tb_usuarios`.`apellidoMaterno` AS `apellidoMaterno`,`tb_usuarios`.`telefono` AS `telefono`,`tb_usuarios`.`correo` AS `correo`,`tb_usuarios`.`id_grupoUsuario` AS `id_grupoUsuario`,`tb_grupousuario`.`descripcion_grupoUsuario` AS `descripcion_grupoUsuario`,`tb_usuarios`.`estado` AS `id_estado`,`tb_estados`.`descripcion_estado` AS `descripcion_estado` from ((`tb_usuarios` join `tb_estados` on((`tb_usuarios`.`estado` = `tb_estados`.`id_estado`))) join `tb_grupousuario` on((`tb_usuarios`.`id_grupoUsuario` = `tb_grupousuario`.`id_grupoUsuario`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-13  3:43:26
