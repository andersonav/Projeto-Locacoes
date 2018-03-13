-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: projeto_locacoes
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
  `amb_ativo` int(11) NOT NULL,
  PRIMARY KEY (`amb_eve_id`),
  KEY `fk_blo_eve_id_idx` (`amb_blo_eve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf16;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambiente_evento`
--

LOCK TABLES `ambiente_evento` WRITE;
/*!40000 ALTER TABLE `ambiente_evento` DISABLE KEYS */;
INSERT INTO `ambiente_evento` VALUES (1,'Ambulatorio',1,1),(2,'Area de Circulacao',1,1),(3,'Auditorio',1,1),(4,'Auditorio - Foyer',1,1),(5,'Auditorio - Sala do Palco',1,1),(6,'Auditorio - WC Masculino',1,1),(7,'Auditorio - WC Feminino',1,1),(8,'Gabinete - Chefia de Gabinete',1,1),(9,'Gabinete - Direcao-geral',1,1),(10,'Gabinete - Recepcao',1,1),(11,'Coordenacao de Almoxarifado e Patrimonio',1,1),(12,'Coordenacao de Aquisicoes',1,1),(13,'Coordenacao de Assuntos Estudantis',1,1),(14,'Coordenacao de Contratos',1,1),(15,'Coordenacao de Controle Academico',1,1),(16,'Coordenacao de Execucao Orcamentaria e Financ',1,1),(17,'Coordenacao de Gestao de Pessoas',1,1),(18,'Coordenacao de Tecnologia da Informacao',1,1),(19,'Coordenacao Tecnico-Pedagogica',1,1),(20,'Copa - Pavimento Inferior',1,1),(21,'Copa - Pavimento Superior',1,1),(22,'Diretoria de Administracao e Planejamento (DI',1,1),(23,'Diretoria de Ensino (DIREN)',1,1),(24,'DEPPI',1,1),(25,'Edificacoes / Seguranca',1,1),(26,'Enfermagem',1,1),(27,'Guarita',1,1),(28,'Informatica',1,1),(29,'NPCR - Nucleo de Prospeccao e Captacao de Rec',1,1),(30,'PPGER - Programa de Pos-graduacao em Energias',1,1),(31,'Psicologia',1,1),(32,'Recepcao Central',1,1),(33,'Refeitorio',1,1),(34,'Reprografia',1,1),(35,'Sala de Reunioes',1,1),(36,'SEARA / Limpeza',1,1),(37,'Servico Social',1,1),(38,'Setor de Estagio',1,1),(39,'Vestiario Feminino',1,1),(40,'Vestiario Masculino',1,1),(41,'Video Conferencia',1,1),(42,'WC Feminino - Pavimento Inferior',1,1),(43,'WC Feminino - Pavimento Superior',1,1),(44,'WC Masculino - Pavimento Inferior',1,1),(45,'WC Masculino - Pavimento Superior',1,1),(46,'WC Portadores de Deficiencia - Pavimento Supe',1,1),(47,'Almoxarifado',2,1),(48,'Area de Lanche',2,1),(49,'Camara Fria',2,1),(50,'Cozinha',2,1),(51,'Sala do Nutricionista',2,1),(52,'Comunicacao Social',3,1),(53,'Coordenacao da Biblioteca',3,1),(54,'Coordenadoria de EAD',3,1),(55,'Patio dos Livros',3,1),(56,'Processamento Tecnico',3,1),(57,'Recepcao',3,1),(58,'Sala de Computadores',3,1),(59,'Sala de Estudos em Grupo 1',3,1),(60,'Sala de Estudos em Grupo 2',3,1),(61,'Sala de Estudos em Grupo 3',3,1),(62,'Sala de Estudos Individual',3,1),(63,'Atendimento ao Aluno',4,1),(64,'Coordenacao de Formacao de Professores',4,1),(65,'Coordenacao Do Eixo da Quimica e Meio Ambient',4,1),(66,'Gabinete de Professores',4,1),(67,'Laboratorio de Bioquimica e Fisiologia Ambien',4,1),(68,'Laboratorio de Hidrologia - LH',4,1),(69,'Laboratorio de Tecnologias de Convivencia com',4,1),(70,'Laboratorio de Praticas Pedagogicas - LAPP',4,1),(71,'Lab de Quimica Analitica e Microbiologia Ambi',4,1),(72,'Laboratorio de Quimica Organica e Inorganica ',4,1),(73,'Laboratorio de Tecnologia em Processos Ambien',4,1),(74,'Laboratorio de Informatica - LI',4,1),(75,'Programa de Pos-graduacao em Ensino de Cienci',4,1),(76,'Sala de Aula 01',4,1),(77,'Sala de Aula 02',4,1),(78,'Sala de Aula 03',4,1),(79,'Sala de Aula 04',4,1),(80,'Sala de Aula 05',4,1),(81,'Sala de Aula 06',4,1),(82,'Sala de Aula 07',4,1),(83,'Equipamentos',4,1),(84,'WC Feminino - Pavimento Inferior',4,1),(85,'WC Feminino - Pavimento Superior',4,1),(86,'WC Masculino - Pavimento Inferior',4,1),(87,'WC Masculino - Pavimento Superior',4,1),(88,'Coordenadoria da Industria',5,1),(89,'Gabinete de Professores',5,1),(90,'GPSI (Grupo de Pesquisa em Sistemas Inteligen',5,1),(91,'Laboratorio de Prototipos',5,1),(92,'LAMEP (Laboratorio de Acionamento de Maquinas',5,1),(93,'LAPISCO (Laboratorio de Processamento de Imag',5,1),(94,'LEE (Laboratorio de Eletro-eletronica)',5,1),(95,'LIA (Laboratorio de Informatica Aplicada)',5,1),(96,'LIAF (Laboratorio de Inspecao e Analise de Fa',5,1),(97,'LINC (Laboratorio de Instrumentacao e Control',5,1),(98,'LMAT (Laboratorio de Materiais)',5,1),(99,'LMET (Laboratorio de Metrologia Dimensional)',5,1),(100,'LSHIP (Laboratorio de Sistemas Hidraulicos e ',5,1),(101,'LTF (Laboratorio de Maquinas Termicas e de Fl',5,1),(102,'Sala de Aula 1',5,1),(103,'Sala de Aula 2',5,1),(104,'Sala de Aula 3',5,1),(105,'Sala de Aula 4',5,1),(106,'Sala de Aula 5',5,1),(107,'Sala de Aula 6',5,1),(108,'Sala de Aula 7',5,1),(109,'Sala de Aula 8',5,1),(110,'Sala de Aula 9',5,1),(111,'Sala de Aula 10',5,1),(112,'Sala de Professores',5,1),(113,'WC Feminino - Pavimento Inferior',5,1),(114,'WC Feminino - Pavimento Superior',5,1),(115,'WC Masculino - Pavimento Inferior',5,1),(116,'WC Masculino - Pavimento Superior',5,1),(117,'Coordenacoes',6,1),(118,'Gabinete Prof Adriano Freitas e Anderson de C',6,1),(119,'Gabinete Prof Ajalmar Rocha',6,1),(120,'Gabinete Prof Amauri Holanda e Prof Inacio Al',6,1),(121,'Gabinete Prof Corneli Junior',6,1),(122,'Gabinete Prof Daniel Freitas e Igor Valente',6,1),(123,'Gabinete Prof Eugenio Barreto e Prof Teofilo ',6,1),(124,'Gabinete Prof Jean Marcelo e Prof Wellington ',6,1),(125,'Gabinete Prof Nivando Bezerra',6,1),(126,'Gabinete Prof Sandro Juca e Prof Elder Texeir',6,1),(127,'Gabinete Prof Siqueira e Werther',6,1),(128,'Laboratorio de Hardware',6,1),(129,'Laboratorio de Informatica 1',6,1),(130,'Laboratorio de Informatica 2',6,1),(131,'Laboratorio de Informatica 3',6,1),(132,'Laboratorio de Redes 1',6,1),(133,'Laboratorio de Redes 2',6,1),(134,'Laboratorio de Redes Sem Fio',6,1),(135,'LabVICIA (Laboratorio de Visao Computacional ',6,1),(136,'LAESE (Laboratorio de Eletronica e Sistemas E',6,1),(137,'LaTIM (Laboratorio de Tecnologia da Informaca',6,1),(138,'LECOMP (Laboratorio de Eletricidade e Eletron',6,1),(139,'LMD (Laboratorio de Midias Digitais)',6,1),(140,'LSD (Laboratorio de Sistemas Digitais)',6,1),(141,'Sala de Aula 1',6,1),(142,'Sala de Aula 2',6,1),(143,'Sala de Aula 3',6,1),(144,'Sala de Aula 4',6,1),(145,'Sala de Aula 5',6,1),(146,'Sala de Aula 6',6,1),(147,'Sala de Aula 7',6,1),(148,'Sala de Aula 8',6,1),(149,'Sala de Aula 9',6,1),(150,'Sala de Aula 10',6,1),(151,'Sala de Equipamentos',6,1),(152,'Sala de Estudos 1',6,1),(153,'Sala de Estudos 2',6,1),(154,'Sala de Estudos 3',6,1),(155,'Sala de Professores',6,1),(156,'WC Feminino - Pavimento Inferior',6,1),(157,'WC Feminino - Pavimento Superior',6,1),(158,'WC Masculino - Pavimento Inferior',6,1),(159,'WC Masculino - Pavimento Superior',6,1),(160,'Ambulatorio',7,1),(161,'Coordenadoria do SEFE (Setor de Educacao Fisi',7,1),(162,'Enfermagem',7,1),(163,'Sala dos Motoristas',7,1),(164,'Secretaria do SEFE (Setor de Educacao Fisica ',7,1),(165,'Servicos Gerais',7,1),(166,'Vestiario Feminino',7,1),(167,'Vestiario Masculino',7,1),(168,'Piscina',8,1),(169,'Casa de bombas',8,1),(170,'Area comum',8,1),(171,'fsds',3,1),(172,'dfddfd',1,0);
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
  `blo_ativo` int(11) NOT NULL,
  PRIMARY KEY (`blo_eve_id`),
  KEY `fk_bloco_evento_setor_evento1_idx` (`blo_set_eve_id`),
  CONSTRAINT `fk_bloco_evento_setor_evento1` FOREIGN KEY (`blo_set_eve_id`) REFERENCES `setor_evento` (`set_eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bloco_evento`
--

LOCK TABLES `bloco_evento` WRITE;
/*!40000 ALTER TABLE `bloco_evento` DISABLE KEYS */;
INSERT INTO `bloco_evento` VALUES (1,1,'Bloco Administrativo',1),(2,1,'Restaurante Academico',1),(3,2,'Biblioteca',1),(4,2,'Bloco Didatico I',1),(5,2,'Bloco Didatico II',1),(6,2,'Bloco Didatico III',1),(7,3,'Ginasio',1),(8,3,'Piscina',1),(9,3,'teste',0),(10,2,'Teste',0),(11,1,'Opa',0),(12,1,'Teste',0);
/*!40000 ALTER TABLE `bloco_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamentos_evento`
--

DROP TABLE IF EXISTS `equipamentos_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipamentos_evento` (
  `equi_eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `equi_eve_desc` varchar(45) NOT NULL,
  `equi_eve_qtd` char(10) NOT NULL,
  `equi_eve_email` char(45) DEFAULT NULL,
  PRIMARY KEY (`equi_eve_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamentos_evento`
--

LOCK TABLES `equipamentos_evento` WRITE;
/*!40000 ALTER TABLE `equipamentos_evento` DISABLE KEYS */;
INSERT INTO `equipamentos_evento` VALUES (1,'Microfones','100','alveesbezerra13@gmail.com'),(2,'DataShow','200','anderson.alvesprogrammer@gmail.com');
/*!40000 ALTER TABLE `equipamentos_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_aula`
--

DROP TABLE IF EXISTS `evento_aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_aula` (
  `eve_aula_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_aula_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`eve_aula_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_aula`
--

LOCK TABLES `evento_aula` WRITE;
/*!40000 ALTER TABLE `evento_aula` DISABLE KEYS */;
INSERT INTO `evento_aula` VALUES (1,'Sim'),(2,'Nao');
/*!40000 ALTER TABLE `evento_aula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_aula_detalhes`
--

DROP TABLE IF EXISTS `evento_aula_detalhes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_aula_detalhes` (
  `eve_aula_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_aula_det_fkeve_id` int(11) NOT NULL,
  `eve_aula_det_fkaula_id` int(11) NOT NULL,
  `eve_aula_det_pro` varchar(45) NOT NULL,
  PRIMARY KEY (`eve_aula_det_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_aula_detalhes`
--

LOCK TABLES `evento_aula_detalhes` WRITE;
/*!40000 ALTER TABLE `evento_aula_detalhes` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento_aula_detalhes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_equipamento_utilizado`
--

DROP TABLE IF EXISTS `evento_equipamento_utilizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_equipamento_utilizado` (
  `eve_equi_uti_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_equi_uti_fkeve_id` int(11) NOT NULL,
  `eve_equi_uti_fkequi_id` int(11) NOT NULL,
  `eve_equi_uti_qtd` char(50) NOT NULL,
  `eve_equi_uti_data_inicio` datetime NOT NULL,
  `eve_equi_uti_data_fim` datetime NOT NULL,
  PRIMARY KEY (`eve_equi_uti_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_equipamento_utilizado`
--

LOCK TABLES `evento_equipamento_utilizado` WRITE;
/*!40000 ALTER TABLE `evento_equipamento_utilizado` DISABLE KEYS */;
INSERT INTO `evento_equipamento_utilizado` VALUES (1,1,0,'-','2018-03-14 08:00:00','2018-03-14 11:00:00');
/*!40000 ALTER TABLE `evento_equipamento_utilizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_refeicao_utilizado`
--

DROP TABLE IF EXISTS `evento_refeicao_utilizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_refeicao_utilizado` (
  `eve_ref_uti_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_ref_uti_fkeve_id` int(11) NOT NULL,
  `eve_ref_uti_fkref_id` int(11) NOT NULL,
  `eve_ref_uti_qtd` char(45) NOT NULL,
  `eve_ref_uti_data_inicio` datetime NOT NULL,
  `eve_ref_uti_data_fim` datetime NOT NULL,
  PRIMARY KEY (`eve_ref_uti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_refeicao_utilizado`
--

LOCK TABLES `evento_refeicao_utilizado` WRITE;
/*!40000 ALTER TABLE `evento_refeicao_utilizado` DISABLE KEYS */;
INSERT INTO `evento_refeicao_utilizado` VALUES (1,1,0,'-','2018-03-14 08:00:00','2018-03-14 11:00:00');
/*!40000 ALTER TABLE `evento_refeicao_utilizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_servico_utilizado`
--

DROP TABLE IF EXISTS `evento_servico_utilizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_servico_utilizado` (
  `eve_ser_uti_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_ser_uti_fkeve_id` int(11) NOT NULL,
  `eve_ser_uti_fkser_id` int(11) NOT NULL,
  `eve_ser_uti_data_inicio` datetime NOT NULL,
  `eve_ser_uti_data_fim` datetime NOT NULL,
  PRIMARY KEY (`eve_ser_uti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_servico_utilizado`
--

LOCK TABLES `evento_servico_utilizado` WRITE;
/*!40000 ALTER TABLE `evento_servico_utilizado` DISABLE KEYS */;
INSERT INTO `evento_servico_utilizado` VALUES (1,1,0,'2018-03-14 08:00:00','2018-03-14 11:00:00');
/*!40000 ALTER TABLE `evento_servico_utilizado` ENABLE KEYS */;
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
INSERT INTO `evento_tipo_repeticao` VALUES (1,'Nao'),(2,'Periodico'),(3,'Semestre');
/*!40000 ALTER TABLE `evento_tipo_repeticao` ENABLE KEYS */;
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
  `eve_sol_tel` varchar(45) NOT NULL,
  `eve_sol_email` varchar(45) NOT NULL,
  `eve_data_inicio` datetime DEFAULT NULL,
  `eve_data_fim` datetime DEFAULT NULL,
  `eve_comeco` datetime DEFAULT NULL,
  `eve_fim` datetime DEFAULT NULL,
  `eve_tip_rep_id` int(11) NOT NULL,
  `eve_aula_id` int(11) NOT NULL,
  `eve_amb_id` int(11) NOT NULL,
  `eve_usu_id` int(11) NOT NULL,
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
INSERT INTO `eventos` VALUES (1,'Teste de Evento','Teste de Evento','Anderson','(85) 98888-8888','anderson@gmail.com','2018-03-14 08:00:00','2018-03-14 11:00:00','2018-03-14 08:00:00','2018-03-14 11:00:00',1,2,1,1);
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refeicoes_evento`
--

DROP TABLE IF EXISTS `refeicoes_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refeicoes_evento` (
  `ref_eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_eve_desc` varchar(45) NOT NULL,
  `ref_eve_qtd` varchar(45) NOT NULL,
  `ref_eve_email` char(45) NOT NULL,
  PRIMARY KEY (`ref_eve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refeicoes_evento`
--

LOCK TABLES `refeicoes_evento` WRITE;
/*!40000 ALTER TABLE `refeicoes_evento` DISABLE KEYS */;
INSERT INTO `refeicoes_evento` VALUES (2,'Teste','21','teste@gmail.com');
/*!40000 ALTER TABLE `refeicoes_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semestres`
--

DROP TABLE IF EXISTS `semestres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semestres` (
  `sem_id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_nome` varchar(45) NOT NULL,
  `sem_data_inicio` datetime DEFAULT NULL,
  `sem_data_fim` datetime DEFAULT NULL,
  `sem_atual` int(11) NOT NULL,
  PRIMARY KEY (`sem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semestres`
--

LOCK TABLES `semestres` WRITE;
/*!40000 ALTER TABLE `semestres` DISABLE KEYS */;
INSERT INTO `semestres` VALUES (1,'2017.2','2017-10-31 00:00:00','2018-04-14 00:00:00',1);
/*!40000 ALTER TABLE `semestres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos_evento`
--

DROP TABLE IF EXISTS `servicos_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos_evento` (
  `ser_eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `ser_eve_desc` varchar(45) NOT NULL,
  `ser_eve_email` char(45) NOT NULL,
  PRIMARY KEY (`ser_eve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos_evento`
--

LOCK TABLES `servicos_evento` WRITE;
/*!40000 ALTER TABLE `servicos_evento` DISABLE KEYS */;
INSERT INTO `servicos_evento` VALUES (1,'Limpeza Total','imatheusmoreira@gmail.com'),(2,'Limpeza apenas','alveesbezerra13@gmail.com'),(3,'teste','123');
/*!40000 ALTER TABLE `servicos_evento` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setor_evento`
--

LOCK TABLES `setor_evento` WRITE;
/*!40000 ALTER TABLE `setor_evento` DISABLE KEYS */;
INSERT INTO `setor_evento` VALUES (1,'Administracao'),(2,'Educacao'),(3,'Esportes');
/*!40000 ALTER TABLE `setor_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `tip_usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_usu_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`tip_usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador'),(2,'Servidor');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nome` varchar(45) NOT NULL,
  `usu_login` varchar(45) NOT NULL,
  `usu_senha` varchar(45) NOT NULL,
  `usu_email` varchar(45) NOT NULL,
  `usu_tip_id` int(11) NOT NULL,
  `usu_ativo` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `fk_usuario_tipo_idx` (`usu_tip_id`),
  CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`usu_tip_id`) REFERENCES `tipo_usuario` (`tip_usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Anderson','anderson','21232f297a57a5a743894a0e4a801fc3','anderson.alvesprogrammer@gmail.com',1,1),(2,'Thiago','thivalente','21232f297a57a5a743894a0e4a801fc3','thivalente@gmail.com',1,1),(3,'Matheus ','imatheusmoreira','21232f297a57a5a743894a0e4a801fc3','imatheusmoreira@gmail.com',1,1),(4,'Emerson','emerson','21232f297a57a5a743894a0e4a801fc3','emerson.henrique@ifce.edu.br',1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-13 16:39:36
