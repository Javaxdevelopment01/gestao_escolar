CREATE DATABASE  IF NOT EXISTS `gestao_escolar` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gestao_escolar`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: gestao_escolar
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aluno` (
  `id_aluno` int NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sobrenome_aluno` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bi_aluno` varchar(14) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_aluno` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_matricula_aluno` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provincia_regidencia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `municipio_regidencia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bairro_regidencia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_aluno` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'Activo',
  `id_turma` int NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `img` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_aluno`),
  UNIQUE KEY `bi_aluno` (`bi_aluno`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno`
--

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` VALUES (7,'Gabriel','Pedro','005544354BO032','gabrielpedroaurelio@gmail.com','5500','934519321','Icole e Bengo','Kifangondo','Anjos',NULL,'Frequentando',1,'2025-08-19 21:27:07','../../assets/_uploads/fotosAlunos/Gabriel005544354BO032.jpg'),(8,'Erneto','Buka','003243542354LA','erneto@gmail.com','5503','936355102','Icole e Bengo','Funda','Casas Novas',NULL,'Frequentando',1,'2025-08-19 21:44:44','../../assets/_uploads/fotosAlunos/Erneto003243542354LA045.jpg'),(9,'Erneto','Buka','033542354LA045','erneto@gmail.com','5503','936355102','Icole e Bengo','Funda','Casas Novas',NULL,'Frequentando',1,'2025-08-19 21:49:50','../../assets/_uploads/fotosAlunos/Erneto033542354LA045.jpg');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area_formacao`
--

DROP TABLE IF EXISTS `area_formacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area_formacao` (
  `id_area_formacao` int NOT NULL AUTO_INCREMENT,
  `area_formacao` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_area_formacao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_formacao`
--

LOCK TABLES `area_formacao` WRITE;
/*!40000 ALTER TABLE `area_formacao` DISABLE KEYS */;
INSERT INTO `area_formacao` VALUES (1,'Informática','2025-08-19 20:33:24'),(2,'Administração ','2025-08-19 20:33:24');
/*!40000 ALTER TABLE `area_formacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boletim`
--

DROP TABLE IF EXISTS `boletim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boletim` (
  `id_boletim` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `data_emissao` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_turma` int DEFAULT NULL,
  `media_final_boletim` decimal(2,1) DEFAULT NULL,
  `numero_escola` int DEFAULT NULL,
  `id_funcionario` int DEFAULT NULL,
  PRIMARY KEY (`id_boletim`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `numero_escola` (`numero_escola`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `boletim_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  CONSTRAINT `boletim_ibfk_2` FOREIGN KEY (`numero_escola`) REFERENCES `escola` (`numero_escola`),
  CONSTRAINT `boletim_ibfk_3` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `boletim_ibfk_4` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boletim`
--

LOCK TABLES `boletim` WRITE;
/*!40000 ALTER TABLE `boletim` DISABLE KEYS */;
/*!40000 ALTER TABLE `boletim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classe`
--

DROP TABLE IF EXISTS `classe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classe` (
  `id_classe` int NOT NULL AUTO_INCREMENT,
  `classe` int DEFAULT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classe`
--

LOCK TABLES `classe` WRITE;
/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
INSERT INTO `classe` VALUES (1,10),(2,11),(3,12),(4,13);
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `curso` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_area_formacao` int NOT NULL,
  `duracao` int DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_curso`),
  KEY `id_area_formacao` (`id_area_formacao`),
  CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_area_formacao`) REFERENCES `area_formacao` (`id_area_formacao`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (1,'Informática ',1,4,'2025-08-19 20:34:49'),(2,'Informática de Gestão',1,4,'2025-08-19 20:34:49'),(3,'Contabilidade Empresarial',2,4,'2025-08-19 20:34:49'),(4,'Gestão Empresal',2,4,'2025-08-19 20:34:49');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `id_departamento` int NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disciplina` (
  `id_disciplina` int NOT NULL AUTO_INCREMENT,
  `nome_disciplina` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_curso` int NOT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documento` (
  `id_documento` int NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(55) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  `id_funcionario` int DEFAULT NULL,
  `data_emissao` datetime DEFAULT CURRENT_TIMESTAMP,
  `caminho_arquivo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_documento`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_funcionario` (`id_funcionario`),
  CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escola`
--

DROP TABLE IF EXISTS `escola`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `escola` (
  `numero_escola` int NOT NULL AUTO_INCREMENT,
  `nome_escola` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria` enum('Ensino Médio','Ensino Superior') COLLATE utf8mb4_general_ci DEFAULT 'Ensino Médio',
  `provincia_localizacao` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `municipio_localizacao` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bairro_localizacao` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_funcionario_derectorPedagogico` int NOT NULL,
  `id_funcionario_derector` int NOT NULL,
  PRIMARY KEY (`numero_escola`),
  KEY `id_funcionario_derectorPedagogico` (`id_funcionario_derectorPedagogico`),
  KEY `id_funcionario_derector` (`id_funcionario_derector`),
  CONSTRAINT `escola_ibfk_1` FOREIGN KEY (`id_funcionario_derectorPedagogico`) REFERENCES `funcionario` (`id_funcionario`),
  CONSTRAINT `escola_ibfk_2` FOREIGN KEY (`id_funcionario_derector`) REFERENCES `funcionario` (`id_funcionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escola`
--

LOCK TABLES `escola` WRITE;
/*!40000 ALTER TABLE `escola` DISABLE KEYS */;
/*!40000 ALTER TABLE `escola` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `falta_aluno`
--

DROP TABLE IF EXISTS `falta_aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `falta_aluno` (
  `id_falta` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `id_disciplina` int NOT NULL,
  `id_turma` int NOT NULL,
  `data_falta` date NOT NULL,
  `justificada` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_falta`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_disciplina` (`id_disciplina`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `falta_aluno_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `falta_aluno_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  CONSTRAINT `falta_aluno_ibfk_3` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `falta_aluno`
--

LOCK TABLES `falta_aluno` WRITE;
/*!40000 ALTER TABLE `falta_aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `falta_aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `falta_professor`
--

DROP TABLE IF EXISTS `falta_professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `falta_professor` (
  `id_falta_professor` int NOT NULL AUTO_INCREMENT,
  `id_funcionario` int NOT NULL,
  `id_disciplina` int NOT NULL,
  `id_turma` int NOT NULL,
  `data_falta` date NOT NULL,
  `justificada` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_falta_professor`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_disciplina` (`id_disciplina`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `falta_professor_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  CONSTRAINT `falta_professor_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  CONSTRAINT `falta_professor_ibfk_3` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `falta_professor`
--

LOCK TABLES `falta_professor` WRITE;
/*!40000 ALTER TABLE `falta_professor` DISABLE KEYS */;
/*!40000 ALTER TABLE `falta_professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `id_funcionario` int NOT NULL AUTO_INCREMENT,
  `bilhete_funcionario` varchar(14) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_funcionario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sobrenome_funcionario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_funcionario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provincia_regidencia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `municipio_regidencia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bairro_regidencia` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_aluno` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'Activo',
  `descricao` text COLLATE utf8mb4_general_ci,
  `id_departamento` int DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`),
  KEY `id_departamento` (`id_departamento`),
  CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico`
--

DROP TABLE IF EXISTS `historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historico` (
  `id_historico` int NOT NULL AUTO_INCREMENT,
  `id_funcionario` int NOT NULL,
  `tabela` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_dado` int DEFAULT NULL,
  `acao` enum('Inserir','Actualizar','Deletar') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dados_anteriore` text COLLATE utf8mb4_general_ci,
  `dados_novos` text COLLATE utf8mb4_general_ci,
  `data_hora` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historico`),
  KEY `id_funcionario` (`id_funcionario`),
  CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico`
--

LOCK TABLES `historico` WRITE;
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_login`
--

DROP TABLE IF EXISTS `historico_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historico_login` (
  `id_historico_login` int NOT NULL AUTO_INCREMENT,
  `id_funcionario` int NOT NULL,
  `hora_entrada` datetime DEFAULT CURRENT_TIMESTAMP,
  `hora_saida` datetime DEFAULT NULL,
  PRIMARY KEY (`id_historico_login`),
  KEY `id_funcionario` (`id_funcionario`),
  CONSTRAINT `historico_login_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_login`
--

LOCK TABLES `historico_login` WRITE;
/*!40000 ALTER TABLE `historico_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro`
--

DROP TABLE IF EXISTS `livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livro` (
  `id_livro` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `editora` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_funcionario` int DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  `caminho_arquivo` text COLLATE utf8mb4_general_ci,
  `id_categoria` int DEFAULT NULL,
  `data_upload` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_livro`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro`
--

LOCK TABLES `livro` WRITE;
/*!40000 ALTER TABLE `livro` DISABLE KEYS */;
/*!40000 ALTER TABLE `livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota`
--

DROP TABLE IF EXISTS `nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nota` (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `id_disciplina` int NOT NULL,
  `id_professor` int NOT NULL,
  `id_turma` int NOT NULL,
  `tipo_avaliacao` enum('Prova','Trabalho','Teste','Oral') COLLATE utf8mb4_general_ci NOT NULL,
  `valor_nota` decimal(5,2) DEFAULT NULL,
  `data_lancamento` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nota`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_disciplina` (`id_disciplina`),
  KEY `id_professor` (`id_professor`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  CONSTRAINT `nota_ibfk_3` FOREIGN KEY (`id_professor`) REFERENCES `funcionario` (`id_funcionario`),
  CONSTRAINT `nota_ibfk_4` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota`
--

LOCK TABLES `nota` WRITE;
/*!40000 ALTER TABLE `nota` DISABLE KEYS */;
/*!40000 ALTER TABLE `nota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodo` (
  `id_periodo` int NOT NULL AUTO_INCREMENT,
  `periodo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'Manhã'),(2,'Tarde'),(3,'Noite');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor_disciplina`
--

DROP TABLE IF EXISTS `professor_disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor_disciplina` (
  `id_professor_disciplina` int NOT NULL AUTO_INCREMENT,
  `id_funcionario` int NOT NULL,
  `id_disciplina` int NOT NULL,
  `id_turma` int NOT NULL,
  PRIMARY KEY (`id_professor_disciplina`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_disciplina` (`id_disciplina`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `professor_disciplina_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  CONSTRAINT `professor_disciplina_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  CONSTRAINT `professor_disciplina_ibfk_3` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor_disciplina`
--

LOCK TABLES `professor_disciplina` WRITE;
/*!40000 ALTER TABLE `professor_disciplina` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor_disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sala` (
  `id_sala` int NOT NULL AUTO_INCREMENT,
  `numero_sala` tinyint DEFAULT NULL,
  `localizacao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capacidade_de_alunos` int DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala`
--

LOCK TABLES `sala` WRITE;
/*!40000 ALTER TABLE `sala` DISABLE KEYS */;
INSERT INTO `sala` VALUES (1,1,'Primeiro Corredor',60,'2025-08-19 20:37:44'),(2,2,'Primeiro Corredor',60,'2025-08-19 20:37:44'),(3,3,'Primeiro Corredor',60,'2025-08-19 20:37:44'),(4,4,'Primeiro Corredor',60,'2025-08-19 20:37:44'),(5,5,'Primeiro Corredor',60,'2025-08-19 20:37:44'),(6,6,'Primeiro Corredor',60,'2025-08-19 20:37:44'),(7,7,'Primeiro Corredor',60,'2025-08-19 20:37:44'),(8,8,'Segundo Corredor',60,'2025-08-19 20:37:44'),(9,9,'Segundo Corredor',60,'2025-08-19 20:37:44'),(10,10,'Segundo Corredor',60,'2025-08-19 20:37:44'),(11,11,'Segundo Corredor',60,'2025-08-19 20:37:44'),(12,12,'Segundo Corredor',60,'2025-08-19 20:37:44');
/*!40000 ALTER TABLE `sala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turma`
--

DROP TABLE IF EXISTS `turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turma` (
  `id_turma` int NOT NULL AUTO_INCREMENT,
  `turma` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `id_sala` int NOT NULL,
  `id_curso` int NOT NULL,
  `id_classe` int NOT NULL,
  `id_periodo` int NOT NULL,
  `ano` year DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_turma`),
  UNIQUE KEY `turma` (`turma`),
  KEY `id_sala` (`id_sala`),
  KEY `id_classe` (`id_classe`),
  KEY `id_curso` (`id_curso`),
  KEY `id_periodo` (`id_periodo`),
  CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id_sala`),
  CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`),
  CONSTRAINT `turma_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  CONSTRAINT `turma_ibfk_4` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turma`
--

LOCK TABLES `turma` WRITE;
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` VALUES (1,'03IG12T24',3,2,3,2,2025,'2025-08-19 21:18:50');
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'gestao_escolar'
--

--
-- Dumping routines for database 'gestao_escolar'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-20  6:04:14
