# Host: localhost  (Version 5.5.5-10.1.13-MariaDB)
# Date: 2019-03-20 09:48:08
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tarefa"
#

DROP TABLE IF EXISTS `tarefa`;
CREATE TABLE `tarefa` (
  `cod_tarefa` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `desc_tarefa` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  PRIMARY KEY (`cod_tarefa`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "tarefa"
#

INSERT INTO `tarefa` VALUES (1,'Tarefa1','Descrição teste Informacao','Aberto','2019-03-19 08:00:00'),(2,'Teste informação2','Descrição teste5','Em andamento','2019-03-17 08:00:00'),(3,'Teste informação4','Descrição teste2','Concluido','2019-03-16 08:00:00'),(4,'Teste informação3','Descrição teste1','Cancelado','2019-03-08 08:00:00'),(5,'Teste information','Testando a informação ','Aberto','2019-03-19 19:20:54'),(6,'Cadastrando a tarefa em ','Testando a informaÃ§Ã£oÃ§Ã£oÃ£Ã£Ã£teste informacao','Concluido','2019-03-19 19:22:31'),(9,'Informação tarefa','Testando tarefa','Concluido','2019-03-20 09:44:26');
