CREATE DATABASE IF NOT EXISTS `Kursevi_jezika` DEFAULT CHARACTER SET utf8mb4;

USE `Kursevi_jezika`;



/*Table structure for table `Nivo` */

DROP TABLE IF EXISTS `Nivo`;

CREATE TABLE `Nivo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pun_naziv` varchar(20) NOT NULL,
  `skraceni_naziv` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `Nivo` */

INSERT  INTO `Nivo`(`pun_naziv`,`skraceni_naziv`) VALUES 
('Beginner','A1'),
('Elementary','A2'),
('Intermediate','B1'),
('Upper Intermediate','B2'),
('Advanced','C1'),
('Proficiency','C2');



/*Table structure for table `Predavac` */

DROP TABLE IF EXISTS `Predavac`;

CREATE TABLE `Predavac` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ime` varchar(40) NOT NULL,
  `prezime` varchar(40) NOT NULL,
  `godine_iskustva` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `Predavac` */

INSERT  INTO `Predavac`(`ime`,`prezime`,`godine_iskustva`) VALUES 
('Janko','Ilic',4),
('Petar','Petrovic',5),
('Ivona','Aleksic',6);



/*Table structure for table `Kurs_jezika` */

DROP TABLE IF EXISTS `Kurs_jezika`;

CREATE TABLE `Kurs_jezika` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jezik` varchar(40) NOT NULL,
  `trajanje_meseci` int NOT NULL,
  `nivo_id` int NOT NULL,
  `predavac_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_nivo_id` FOREIGN KEY (`nivo_id`) REFERENCES `Nivo` (`id`),
  CONSTRAINT `fk_predavac_id` FOREIGN KEY (`predavac_id`) REFERENCES `Predavac` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `Kurs_jezika` */

INSERT  INTO `Kurs_jezika`(`jezik`,`trajanje_meseci`,`nivo_id`,`predavac_id`) VALUES 
('Italijanski', 3, 1, 1),
('Italijanski', 3, 2, 1),
('Francuski', 6, 3, 2),
('Japanski', 12, 5, 3);
