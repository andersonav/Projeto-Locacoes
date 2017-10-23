-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: projeto_locacoes
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `ambiente_evento`
--

DROP TABLE IF EXISTS `ambiente_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ambiente_evento` (
  `amb_eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `amb_eve_desc` varchar(45) NOT NULL,
  `amb_blo_eve_id` int(11) NOT NULL,
  PRIMARY KEY (`amb_eve_id`),
  KEY `fk_blo_eve_id_idx` (`amb_blo_eve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf16;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambiente_evento`
--

LOCK TABLES `ambiente_evento` WRITE;
/*!40000 ALTER TABLE `ambiente_evento` DISABLE KEYS */;
INSERT INTO `ambiente_evento` VALUES (1,'Ambulatorio',1),(2,'Area de Circulacao',1),(3,'Auditorio',1),(4,'Auditorio - Foyer',1),(5,'Auditorio - Sala do Palco',1),(6,'Auditorio - WC Masculino',1),(7,'Auditorio - WC Feminino',1),(8,'Gabinete - Chefia de Gabinete',1),(9,'Gabinete - Direcao-geral',1),(10,'Gabinete - Recepcao',1),(11,'Coordenacao de Almoxarifado e Patrimonio',1),(12,'Coordenacao de Aquisicoes',1),(13,'Coordenacao de Assuntos Estudantis',1),(14,'Coordenacao de Contratos',1),(15,'Coordenacao de Controle Academico',1),(16,'Coordenacao de Execucao Orcamentaria e Financ',1),(17,'Coordenacao de Gestao de Pessoas',1),(18,'Coordenacao de Tecnologia da Informacao',1),(19,'Coordenacao Tecnico-Pedagogica',1),(20,'Copa - Pavimento Inferior',1),(21,'Copa - Pavimento Superior',1),(22,'Diretoria de Administracao e Planejamento (DI',1),(23,'Diretoria de Ensino (DIREN)',1),(24,'DEPPI',1),(25,'Edificacoes / Seguranca',1),(26,'Enfermagem',1),(27,'Guarita',1),(28,'Informatica',1),(29,'NPCR - Nucleo de Prospeccao e Captacao de Rec',1),(30,'PPGER - Programa de Pos-graduacao em Energias',1),(31,'Psicologia',1),(32,'Recepcao Central',1),(33,'Refeitorio',1),(34,'Reprografia',1),(35,'Sala de Reunioes',1),(36,'SEARA / Limpeza',1),(37,'Servico Social',1),(38,'Setor de Estagio',1),(39,'Vestiario Feminino',1),(40,'Vestiario Masculino',1),(41,'Video Conferencia',1),(42,'WC Feminino - Pavimento Inferior',1),(43,'WC Feminino - Pavimento Superior',1),(44,'WC Masculino - Pavimento Inferior',1),(45,'WC Masculino - Pavimento Superior',1),(46,'WC Portadores de Deficiencia - Pavimento Supe',1),(47,'Almoxarifado',2),(48,'Area de Lanche',2),(49,'Camara Fria',2),(50,'Cozinha',2),(51,'Sala do Nutricionista',2),(52,'Comunicacao Social',3),(53,'Coordenacao da Biblioteca',3),(54,'Coordenadoria de EAD',3),(55,'Patio dos Livros',3),(56,'Processamento Tecnico',3),(57,'Recepcao',3),(58,'Sala de Computadores',3),(59,'Sala de Estudos em Grupo 1',3),(60,'Sala de Estudos em Grupo 2',3),(61,'Sala de Estudos em Grupo 3',3),(62,'Sala de Estudos Individual',3),(63,'Atendimento ao Aluno',4),(64,'Coordenacao de Formacao de Professores',4),(65,'Coordenacao Do Eixo da Quimica e Meio Ambient',4),(66,'Gabinete de Professores',4),(67,'Laboratorio de Bioquimica e Fisiologia Ambien',4),(68,'Laboratorio de Hidrologia - LH',4),(69,'Laboratorio de Tecnologias de Convivencia com',4),(70,'Laboratorio de Praticas Pedagogicas - LAPP',4),(71,'Lab de Quimica Analitica e Microbiologia Ambi',4),(72,'Laboratorio de Quimica Organica e Inorganica ',4),(73,'Laboratorio de Tecnologia em Processos Ambien',4),(74,'Laboratorio de Informatica - LI',4),(75,'Programa de Pos-graduacao em Ensino de Cienci',4),(76,'Sala de Aula 01',4),(77,'Sala de Aula 02',4),(78,'Sala de Aula 03',4),(79,'Sala de Aula 04',4),(80,'Sala de Aula 05',4),(81,'Sala de Aula 06',4),(82,'Sala de Aula 07',4),(83,'Equipamentos',4),(84,'WC Feminino - Pavimento Inferior',4),(85,'WC Feminino - Pavimento Superior',4),(86,'WC Masculino - Pavimento Inferior',4),(87,'WC Masculino - Pavimento Superior',4),(88,'Coordenadoria da Industria',5),(89,'Gabinete de Professores',5),(90,'GPSI (Grupo de Pesquisa em Sistemas Inteligen',5),(91,'Laboratorio de Prototipos',5),(92,'LAMEP (Laboratorio de Acionamento de Maquinas',5),(93,'LAPISCO (Laboratorio de Processamento de Imag',5),(94,'LEE (Laboratorio de Eletro-eletronica)',5),(95,'LIA (Laboratorio de Informatica Aplicada)',5),(96,'LIAF (Laboratorio de Inspecao e Analise de Fa',5),(97,'LINC (Laboratorio de Instrumentacao e Control',5),(98,'LMAT (Laboratorio de Materiais)',5),(99,'LMET (Laboratorio de Metrologia Dimensional)',5),(100,'LSHIP (Laboratorio de Sistemas Hidraulicos e ',5),(101,'LTF (Laboratorio de Maquinas Termicas e de Fl',5),(102,'Sala de Aula 1',5),(103,'Sala de Aula 2',5),(104,'Sala de Aula 3',5),(105,'Sala de Aula 4',5),(106,'Sala de Aula 5',5),(107,'Sala de Aula 6',5),(108,'Sala de Aula 7',5),(109,'Sala de Aula 8',5),(110,'Sala de Aula 9',5),(111,'Sala de Aula 10',5),(112,'Sala de Professores',5),(113,'WC Feminino - Pavimento Inferior',5),(114,'WC Feminino - Pavimento Superior',5),(115,'WC Masculino - Pavimento Inferior',5),(116,'WC Masculino - Pavimento Superior',5),(117,'Coordenacoes',6),(118,'Gabinete Prof Adriano Freitas e Anderson de C',6),(119,'Gabinete Prof Ajalmar Rocha',6),(120,'Gabinete Prof Amauri Holanda e Prof Inacio Al',6),(121,'Gabinete Prof Corneli Junior',6),(122,'Gabinete Prof Daniel Freitas e Igor Valente',6),(123,'Gabinete Prof Eugenio Barreto e Prof Teofilo ',6),(124,'Gabinete Prof Jean Marcelo e Prof Wellington ',6),(125,'Gabinete Prof Nivando Bezerra',6),(126,'Gabinete Prof Sandro Juca e Prof Elder Texeir',6),(127,'Gabinete Prof Siqueira e Werther',6),(128,'Laboratorio de Hardware',6),(129,'Laboratorio de Informatica 1',6),(130,'Laboratorio de Informatica 2',6),(131,'Laboratorio de Informatica 3',6),(132,'Laboratorio de Redes 1',6),(133,'Laboratorio de Redes 2',6),(134,'Laboratorio de Redes Sem Fio',6),(135,'LabVICIA (Laboratorio de Visao Computacional ',6),(136,'LAESE (Laboratorio de Eletronica e Sistemas E',6),(137,'LaTIM (Laboratorio de Tecnologia da Informaca',6),(138,'LECOMP (Laboratorio de Eletricidade e Eletron',6),(139,'LMD (Laboratorio de Midias Digitais)',6),(140,'LSD (Laboratorio de Sistemas Digitais)',6),(141,'Sala de Aula 1',6),(142,'Sala de Aula 2',6),(143,'Sala de Aula 3',6),(144,'Sala de Aula 4',6),(145,'Sala de Aula 5',6),(146,'Sala de Aula 6',6),(147,'Sala de Aula 7',6),(148,'Sala de Aula 8',6),(149,'Sala de Aula 9',6),(150,'Sala de Aula 10',6),(151,'Sala de Equipamentos',6),(152,'Sala de Estudos 1',6),(153,'Sala de Estudos 2',6),(154,'Sala de Estudos 3',6),(155,'Sala de Professores',6),(156,'WC Feminino - Pavimento Inferior',6),(157,'WC Feminino - Pavimento Superior',6),(158,'WC Masculino - Pavimento Inferior',6),(159,'WC Masculino - Pavimento Superior',6),(160,'Ambulatorio',7),(161,'Coordenadoria do SEFE (Setor de Educacao Fisi',7),(162,'Enfermagem',7),(163,'Sala dos Motoristas',7),(164,'Secretaria do SEFE (Setor de Educacao Fisica ',7),(165,'Servicos Gerais',7),(166,'Vestiario Feminino',7),(167,'Vestiario Masculino',7),(168,'Piscina',8),(169,'Casa de bombas',8),(170,'Area comum',8);
/*!40000 ALTER TABLE `ambiente_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bloco_evento`
--

DROP TABLE IF EXISTS `bloco_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bloco_evento` (
  `blo_eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `blo_set_eve_id` int(11) NOT NULL,
  `blo_eve_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`blo_eve_id`),
  KEY `fk_bloco_evento_setor_evento1_idx` (`blo_set_eve_id`),
  CONSTRAINT `fk_bloco_evento_setor_evento1` FOREIGN KEY (`blo_set_eve_id`) REFERENCES `setor_evento` (`set_eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bloco_evento`
--

LOCK TABLES `bloco_evento` WRITE;
/*!40000 ALTER TABLE `bloco_evento` DISABLE KEYS */;
INSERT INTO `bloco_evento` VALUES (1,1,'Bloco Administrativo'),(2,1,'Restaurante Academico'),(3,2,'Biblioteca'),(4,2,'Bloco Didatico I'),(5,2,'Bloco Didatico II'),(6,2,'Bloco Didatico III'),(7,3,'Ginasio'),(8,3,'Piscina');
/*!40000 ALTER TABLE `bloco_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_tipo_repeticao`
--

DROP TABLE IF EXISTS `evento_tipo_repeticao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_tipo_repeticao` (
  `eve_tip_rep_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_tip_rep_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`eve_tip_rep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_tipo_repeticao`
--

LOCK TABLES `evento_tipo_repeticao` WRITE;
/*!40000 ALTER TABLE `evento_tipo_repeticao` DISABLE KEYS */;
INSERT INTO `evento_tipo_repeticao` VALUES (1,'Não'),(2,'Semana'),(3,'Semestre');
/*!40000 ALTER TABLE `evento_tipo_repeticao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_tipos`
--

DROP TABLE IF EXISTS `evento_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_tipos` (
  `eve_tip_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_tip_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`eve_tip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_tipos`
--

LOCK TABLES `evento_tipos` WRITE;
/*!40000 ALTER TABLE `evento_tipos` DISABLE KEYS */;
INSERT INTO `evento_tipos` VALUES (1,'Administração'),(2,'Educação'),(3,'Esportes');
/*!40000 ALTER TABLE `evento_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_nome` varchar(45) DEFAULT NULL,
  `eve_desc` varchar(200) DEFAULT NULL,
  `eve_solicitante` varchar(45) DEFAULT NULL,
  `eve_data_inicio` datetime DEFAULT NULL,
  `eve_data_fim` datetime DEFAULT NULL,
  `eve_tip_rep_id` int(11) NOT NULL,
  `eve_amb_id` int(11) NOT NULL,
  PRIMARY KEY (`eve_id`),
  KEY `fk_eventos_evento_tipo_repeticao1_idx` (`eve_tip_rep_id`),
  KEY `fk_eventos_ambiente_evento_idx` (`eve_amb_id`),
  CONSTRAINT `fk_eventos_ambiente_evento` FOREIGN KEY (`eve_amb_id`) REFERENCES `ambiente_evento` (`amb_eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_evento_tipo_repeticao1` FOREIGN KEY (`eve_tip_rep_id`) REFERENCES `evento_tipo_repeticao` (`eve_tip_rep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,'Teste','Um evento de teste de Anderson','Anderson','2017-10-22 07:30:00','2017-10-22 10:00:00',1,1);
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setor_evento`
--

DROP TABLE IF EXISTS `setor_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setor_evento` (
  `set_eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `set_eve_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`set_eve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setor_evento`
--

LOCK TABLES `setor_evento` WRITE;
/*!40000 ALTER TABLE `setor_evento` DISABLE KEYS */;
INSERT INTO `setor_evento` VALUES (1,'Administracao'),(2,'Educacao'),(3,'Esportes');
/*!40000 ALTER TABLE `setor_evento` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-23  1:14:06
