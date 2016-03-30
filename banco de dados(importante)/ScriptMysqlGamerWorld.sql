-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: gw
-- ------------------------------------------------------
-- Server version	5.7.9-log

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

CREATE DATABASE GamerWorld;

USE GamerWorld;

DROP TABLE IF EXISTS `amigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amigos` (
  `id_usuario` int(255) DEFAULT NULL,
  `id_amigo` int(255) DEFAULT NULL,
  KEY `amigos_ibfk_1` (`id_usuario`),
  KEY `amigos_ibfk_2` (`id_amigo`),
  CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuarios`),
  CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`id_amigo`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amigos`
--

LOCK TABLES `amigos` WRITE;
/*!40000 ALTER TABLE `amigos` DISABLE KEYS */;
/*!40000 ALTER TABLE `amigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avaliacao` (
  `idavaliacao` int(255) NOT NULL AUTO_INCREMENT,
  `jogabilidade` int(11) DEFAULT NULL,
  `grafico` int(11) DEFAULT NULL,
  `trilha` int(11) DEFAULT NULL,
  `historia` int(11) DEFAULT NULL,
  `id_review` int(11) DEFAULT NULL,
  PRIMARY KEY (`idavaliacao`),
  KEY `id_review` (`id_review`),
  CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_review`) REFERENCES `review` (`idreview`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capas`
--

DROP TABLE IF EXISTS `capas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capas` (
  `idcapas` int(255) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `capa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcapas`),
  UNIQUE KEY `idcapas_UNIQUE` (`idcapas`),
  UNIQUE KEY `capa_UNIQUE` (`capa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capas`
--

LOCK TABLES `capas` WRITE;
/*!40000 ALTER TABLE `capas` DISABLE KEYS */;
/*!40000 ALTER TABLE `capas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desenvolvedoras`
--

DROP TABLE IF EXISTS `desenvolvedoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desenvolvedoras` (
  `iddesenvolvedoras` int(255) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `nascimento` varchar(4) DEFAULT NULL,
  `origem` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddesenvolvedoras`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desenvolvedoras`
--

LOCK TABLES `desenvolvedoras` WRITE;
/*!40000 ALTER TABLE `desenvolvedoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `desenvolvedoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jogo_tem_plataforma`
--

DROP TABLE IF EXISTS `jogo_tem_plataforma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jogo_tem_plataforma` (
  `id_jogo` int(255) DEFAULT NULL,
  `id_plataforma` int(255) DEFAULT NULL,
  KEY `id_jogo` (`id_jogo`),
  KEY `id_plataforma` (`id_plataforma`),
  CONSTRAINT `jogo_tem_plataforma_ibfk_1` FOREIGN KEY (`id_jogo`) REFERENCES `jogos` (`idjogos`),
  CONSTRAINT `jogo_tem_plataforma_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`idplataforma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jogo_tem_plataforma`
--

LOCK TABLES `jogo_tem_plataforma` WRITE;
/*!40000 ALTER TABLE `jogo_tem_plataforma` DISABLE KEYS */;
/*!40000 ALTER TABLE `jogo_tem_plataforma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jogos`
--

DROP TABLE IF EXISTS `jogos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jogos` (
  `idjogos` int(255) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `id_desenvolvedora` int(255) DEFAULT NULL,
  `id_capa` int(255) DEFAULT NULL,
  `lanc` date DEFAULT NULL,
  PRIMARY KEY (`idjogos`),
  KEY `fk_jogos_desenvolvedoras1_idx` (`id_desenvolvedora`),
  KEY `id_capa` (`id_capa`),
  CONSTRAINT `jogos_ibfk_2` FOREIGN KEY (`id_desenvolvedora`) REFERENCES `desenvolvedoras` (`iddesenvolvedoras`),
  CONSTRAINT `jogos_ibfk_4` FOREIGN KEY (`id_capa`) REFERENCES `capas` (`idcapas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jogos`
--

LOCK TABLES `jogos` WRITE;
/*!40000 ALTER TABLE `jogos` DISABLE KEYS */;
/*!40000 ALTER TABLE `jogos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `idlogin` int(255) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`idlogin`),
  UNIQUE KEY `user_UNIQUE` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensagem`
--

DROP TABLE IF EXISTS `mensagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensagem` (
  `idmensagem` int(255) NOT NULL AUTO_INCREMENT,
  `idremetente` int(255) DEFAULT NULL,
  `iddestinatario` int(255) DEFAULT NULL,
  `mensagem` text,
  `status` int(2) DEFAULT '0',
  PRIMARY KEY (`idmensagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagem`
--

LOCK TABLES `mensagem` WRITE;
/*!40000 ALTER TABLE `mensagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plataforma`
--

DROP TABLE IF EXISTS `plataforma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plataforma` (
  `idplataforma` int(255) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idplataforma`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plataforma`
--

LOCK TABLES `plataforma` WRITE;
/*!40000 ALTER TABLE `plataforma` DISABLE KEYS */;
/*!40000 ALTER TABLE `plataforma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `idreview` int(255) NOT NULL AUTO_INCREMENT,
  `review` text,
  `id_jogo` int(255) DEFAULT NULL,
  `id_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`idreview`),
  KEY `id_login` (`id_login`),
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_login`) REFERENCES `login` (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trailers`
--

DROP TABLE IF EXISTS `trailers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trailers` (
  `idtrailers` int(255) NOT NULL AUTO_INCREMENT,
  `jogo` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_jogos` int(255) DEFAULT NULL,
  PRIMARY KEY (`idtrailers`),
  UNIQUE KEY `idtrailers_UNIQUE` (`idtrailers`),
  UNIQUE KEY `link_UNIQUE` (`link`),
  KEY `trailers_ibfk_1` (`id_jogos`),
  CONSTRAINT `trailers_ibfk_1` FOREIGN KEY (`id_jogos`) REFERENCES `jogos` (`idjogos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trailers`
--

LOCK TABLES `trailers` WRITE;
/*!40000 ALTER TABLE `trailers` DISABLE KEYS */;
/*!40000 ALTER TABLE `trailers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ufs`
--

DROP TABLE IF EXISTS `ufs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ufs` (
  `iduf` int(255) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`iduf`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  UNIQUE KEY `uf_UNIQUE` (`uf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ufs`
--

LOCK TABLES `ufs` WRITE;
/*!40000 ALTER TABLE `ufs` DISABLE KEYS */;
/*!40000 ALTER TABLE `ufs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_tem_jogo`
--

DROP TABLE IF EXISTS `usuario_tem_jogo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_tem_jogo` (
  `id_usuario` int(255) DEFAULT NULL,
  `id_jogo` int(255) DEFAULT NULL,
  KEY `usuario_tem_jogo_ibfk_1` (`id_usuario`),
  KEY `usuario_tem_jogo_ibfk_2` (`id_jogo`),
  CONSTRAINT `usuario_tem_jogo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuarios`),
  CONSTRAINT `usuario_tem_jogo_ibfk_2` FOREIGN KEY (`id_jogo`) REFERENCES `jogos` (`idjogos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_tem_jogo`
--

LOCK TABLES `usuario_tem_jogo` WRITE;
/*!40000 ALTER TABLE `usuario_tem_jogo` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_tem_jogo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_tem_plataforma`
--

DROP TABLE IF EXISTS `usuario_tem_plataforma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_tem_plataforma` (
  `id_usuario` int(255) DEFAULT NULL,
  `id_plataforma` int(255) DEFAULT NULL,
  KEY `usuario_tem_plataforma_ibfk_1` (`id_usuario`),
  KEY `usuario_tem_plataforma_ibfk_2` (`id_plataforma`),
  CONSTRAINT `usuario_tem_plataforma_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuarios`),
  CONSTRAINT `usuario_tem_plataforma_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`idplataforma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_tem_plataforma`
--

LOCK TABLES `usuario_tem_plataforma` WRITE;
/*!40000 ALTER TABLE `usuario_tem_plataforma` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_tem_plataforma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(255) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `dnasc` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `id_ufs` int(255) DEFAULT NULL,
  `id_login` int(255) DEFAULT NULL,
  PRIMARY KEY (`idusuarios`),
  KEY `usuarios_ibfk_3` (`id_ufs`),
  KEY `usuarios_ibfk_5` (`id_login`),
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_ufs`) REFERENCES `ufs` (`iduf`),
  CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_ufs`) REFERENCES `ufs` (`iduf`),
  CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_login`) REFERENCES `login` (`idlogin`),
  CONSTRAINT `usuarios_ibfk_5` FOREIGN KEY (`id_login`) REFERENCES `login` (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'gw'
--

--
-- Dumping routines for database 'gw'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-25 16:04:27
