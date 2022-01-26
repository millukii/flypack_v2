/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.22-MariaDB : Database - flypack
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`flypack` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `flypack`;

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `city` */

insert  into `city`(`id`,`city`) values (1,'SANTIAGO');

/*Table structure for table `communes` */

DROP TABLE IF EXISTS `communes`;

CREATE TABLE `communes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commune` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `communes` */

insert  into `communes`(`id`,`commune`,`city_id`) values (1,'LAS CONDES',1),(2,'COLINA',1),(3,'HUECHURABA',1),(4,'LA REINA',1),(5,'LO BARNECHEA',1),(6,'MACUL',1),(7,'NUÑOA',1),(8,'PEÑALOLEN',1),(9,'PROVIDENCIA',1),(10,'RECOLETA',1),(11,'VITACURA',1),(12,'CONCHALI',1),(13,'INDEPENDENCIA',1),(14,'LA CISTERNA',1),(15,'LA FLORIDA',1),(16,'LA GRANJA',1),(17,'LA PINTANA',1),(18,'PEDRO AGUIRRE CERDA',1),(19,'SAN JOAQUIN',1),(20,'SAN MIGUEL',1),(21,'SAN RAMON',1),(22,'SANTIAGO',1),(23,'CERRILLOS',1),(24,'CERRO NAVIA',1),(25,'EL BOSQUE',1),(26,'ESTACION CENTRAL',1),(27,'LO ESPEJO',1),(28,'LO PRADO',1),(29,'PUENTE ALTO',1),(30,'QUILICURA',1),(31,'QUINTA NORMAL',1),(32,'RENCA',1),(33,'MAIPU',1),(34,'PUDAHUEL',1),(35,'SAN BERNARDO',1);

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(10) DEFAULT NULL,
  `dv` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fantasy` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `communes_id` int(11) DEFAULT NULL,
  `companies_state_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `companies` */

insert  into `companies`(`id`,`rut`,`dv`,`razon`,`fantasy`,`address`,`city_id`,`communes_id`,`companies_state_id`) values (1,11111111,'1','RAZON SOCIAL 1','NOMBRE FANTASIA 1','DIRECCION 1',1,1,1),(2,76993984,'7','Anza SpA','BPLAYER','Av. Providencia 1208 Of 1603',1,9,1);

/*Table structure for table `companies_state` */

DROP TABLE IF EXISTS `companies_state`;

CREATE TABLE `companies_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `companies_state` */

insert  into `companies_state`(`id`,`state`) values (1,'ACTIVO'),(2,'SUSPENDIDO'),(3,'ELIMINADO'),(4,'BLOQUEADO');

/*Table structure for table `people` */

DROP TABLE IF EXISTS `people`;

CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` int(10) DEFAULT NULL,
  `dv` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `people_states_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `people` */

insert  into `people`(`id`,`rut`,`dv`,`name`,`lastname`,`address`,`city`,`commune`,`email`,`phone`,`profile_id`,`people_states_id`,`created`,`modified`) values (1,22221960,'4','Melody','Romero','Los alerces 2363 depto 202','CURICO','nunoa','mromerodev@gmail.com','+569 958098890',1,1,'2022-01-03 02:48:47','2022-01-03 02:48:47'),(2,17795600,'1','Matias Sabino','Quezada Sanhueza','Manuel correa 1','Curico','Curico','el_mts@hotmail.com','+56979852140',1,1,'2022-01-03 14:53:57',NULL),(3,21242087,'2','Juan','Perez','Siempreviva 123','Curico','Rauco','xemail@gmail.com','+569680998830',2,1,'2022-01-03 15:25:02',NULL),(4,25574390,'2','Kevin','Lopez Echeverria','Chiloe sin numero','Chiloe','Chiloe','kevinlopez@gmail.com','+569680998830',3,1,'2022-01-03 15:36:38',NULL),(5,15338558,'1','Antonio Alejandro','Farías Mira','Paicaví 2721','Santiago','La Florida','antonio.flypack@gmail.com','978612572',1,1,'2022-01-07 14:14:48',NULL),(6,14141551,'1','Fernando Esteban','Monserrat Torres','Mario Recordón 8457','Santiago','La Florida','nano3dfx@gmail.com','976452986',3,1,'2022-01-07 14:26:22',NULL),(7,17517750,'1','Constanza','Pfeifer','Oceano Artico','Santiago','Peñalolen','pfeifer.constanza@gmail.com','+56989069423',1,1,'2022-01-07 16:00:55',NULL);

/*Table structure for table `people_states` */

DROP TABLE IF EXISTS `people_states`;

CREATE TABLE `people_states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `state` (`state`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `people_states` */

insert  into `people_states`(`id`,`state`) values (1,'ACTIVO');

/*Table structure for table `profiles` */

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `profiles` */

insert  into `profiles`(`id`,`profile`,`created`,`modified`) values (1,'ADMINISTRADOR',NULL,NULL),(2,'CLIENTE',NULL,NULL),(3,'REPARTIDOR',NULL,NULL);

/*Table structure for table `rates` */

DROP TABLE IF EXISTS `rates`;

CREATE TABLE `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `companies_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rates` */

insert  into `rates`(`id`,`from`,`to`,`value`,`companies_id`) values (1,'LAS CONDES','LAS CONDES',3100,2),(2,'LAS CONDES','COLINA',3500,2),(3,'LAS CONDES','HUECHURABA',3500,2),(4,'LAS CONDES','LA REINA',3500,2),(5,'LAS CONDES','LO BARNECHEA',3500,2),(6,'LAS CONDES','MACUL',3500,2),(7,'LAS CONDES','NUNOA',3500,2),(8,'LAS CONDES','PENALOLEN',3500,2),(9,'LAS CONDES','PROVIDENCIA',3500,2),(10,'LAS CONDES','RECOLETA',3500,2),(11,'LAS CONDES','VITACURA',3500,2),(12,'LAS CONDES','CONCHALI',4000,2);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`rol`) values (1,'ADMINISTRADOR'),(2,'CLIENTE'),(3,'REPARTIDOR');

/*Table structure for table `shipping` */

DROP TABLE IF EXISTS `shipping`;

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_nro` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quadmins_code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `delivery_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_date` datetime DEFAULT NULL,
  `shipping_states_id` int(11) DEFAULT NULL,
  `companies_id` int(11) DEFAULT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_mail` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `shipping` */

insert  into `shipping`(`id`,`order_nro`,`quadmins_code`,`shipping_type`,`total_amount`,`delivery_name`,`shipping_date`,`shipping_states_id`,`companies_id`,`sender`,`address`,`receiver_name`,`receiver_phone`,`receiver_mail`,`observation`,`label`,`created`,`modified`) values (1,'1','1','dfds',2,'ere','2021-12-08 04:34:58',2,1,'werw','ewr','werw','wer','wer','ewrw','wer','2021-12-08 04:34:58','2021-12-08 04:34:58'),(12,'2','2','COMPR',0,'000000000','0000-00-00 00:00:00',1,1,'Melody Romero','Manuel correa 1','Melody Romero','958098890','mromerodev@gmail.com','Compra mayorista',NULL,'2021-12-19 01:22:53',NULL);

/*Table structure for table `shipping_delivery` */

DROP TABLE IF EXISTS `shipping_delivery`;

CREATE TABLE `shipping_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping` int(11) NOT NULL,
  `delivery_man` int(11) NOT NULL,
  `assigned_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `shipping_delivery` */

/*Table structure for table `shipping_states` */

DROP TABLE IF EXISTS `shipping_states`;

CREATE TABLE `shipping_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `shipping_states` */

insert  into `shipping_states`(`id`,`state`) values (1,'RECIBIDO'),(2,'ELIMINADO');

/*Table structure for table `user_state` */

DROP TABLE IF EXISTS `user_state`;

CREATE TABLE `user_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_state` */

insert  into `user_state`(`id`,`state`) values (1,'ACTIVO'),(2,'SUSPENDIDO'),(3,'ELIMINADO'),(4,'BLOQUEADO');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `user_state_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companies_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`user`,`password`,`rol_id`,`user_state_id`,`name`,`lastname`,`email`,`phone`,`companies_id`,`created`,`modified`) values (1,'admin','827ccb0eea8a706c4c34a16891f84e7b',1,1,'ADMIN','ADMIN','admin@gmail.com','+569 123456789',1,'2022-01-01 19:42:52','2022-01-01 19:42:52'),(2,'BPlayer','7aa31a570f3d61ea96bcd7f06bb8a7d2',2,1,'Antonio','Farías','tiendabplayer@gmail.com','978612572',2,'2022-01-17 20:09:44','2022-01-17 20:14:37');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
