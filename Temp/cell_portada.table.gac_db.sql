DROP TABLE IF EXISTS `cu_neg_cell_portada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_neg_cell_portada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cell` int(11) NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `textoCorto` text,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

