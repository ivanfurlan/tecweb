/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

SET GLOBAL log_bin_trust_function_creators = 1;



CREATE DATABASE /*!32312 IF NOT EXISTS*/`database` /*!40100 DEFAULT CHARACTER SET latin1 */;


USE `database`;


DROP TABLE IF EXISTS `UTENTI`;

CREATE TABLE `UTENTI` (
`Email` VARCHAR(55) NOT NULL,
`Nome` VARCHAR(55) NOT NULL,
`Cognome` VARCHAR(55) NOT NULL,
`Telefono` VARCHAR(55) NOT NULL,
`Password` VARCHAR(55) NOT NULL,
PRIMARY KEY (`Email`))
ENGINE=InnoDB;


INSERT INTO `UTENTI` (`Email`,`Nome`,`Cognome`,`Telefono`,`Password`)
VALUES
('francescobari@gmail.com','Francesco','Bari', '3490011234','psw1'),
('samueledegrandi@gmail.com','Samuele','De Grandi', '3459184440','psw2'),
('enricograzioli@gmail.com','Enrico','Grazioli', '3460010229','psw3'),
('sofiabianchi@gmail.com','Sofia','Bianchi', '3496682884','psw4'),
('admin@admin.com','Marco','Donati', '3450178933','admin');

--

DROP TABLE IF EXISTS `VISITE`;

CREATE TABLE `VISITE` (
`IdVisita` VARCHAR(55) NOT NULL,
`Giorno` SMALLINT NOT NULL,
`Mese` VARCHAR(55) NOT NULL,
`Anno` SMALLINT NOT NULL,
`Orario` TIME NOT NULL,
`Tipologia` VARCHAR(55) NOT NULL,
`EmailUtente` VARCHAR(55) NOT NULL,
PRIMARY KEY (`IdVisita`)
FOREIGN KEY (`EmailUtente`)
REFERENCES `UTENTI`(`Email`)
ON DELETE RESTRICT
ON UPDATE CASCADE)
ENGINE=InnoDB;


INSERT INTO `VISITE` (`IdVisita`, `Giorno`, `Mese`, `Anno`, `Orario`, `Tipologia`, `EmailUtente`)
VALUES
('11020','12','Aprile','2020','08:00:00','Posturografia','francescobari@gmail.com'),
('10020','13','Ottobre','2019','09:00:00','Otomicroscopia','samueledegrandi@gmail.com'),
('10000','17','Gennaio','2020','15:00:00','Impedenzometria','francescobari@gmail.com'),
('19999','20','Febbraio','2020','18:00:00','Posturografia','jessicariva@gmail.com'),
('11111','1','Aprile','2020','08:00:00','Impedenzometria','enricograzioli@gmail.com');

--

DROP TABLE IF EXISTS `MESSAGGI`;

CREATE TABLE `MESSAGGI` (
`EmailUtente` VARCHAR(55) NOT NULL,
`TimestampInvio` TIMESTAMP NOT NULL,
`Messaggio` VARCHAR(512) NOT NULL,
`IsDottore` BOOLEAN,
PRIMARY KEY (`EmailUtente` , `TimestampInvio`),
FOREIGN KEY (`EmailUtente`)
REFERENCES `UTENTI`(`Email`)
ON DELETE RESTRICT
ON UPDATE CASCADE)
ENGINE=InnoDB;


INSERT INTO `MESSAGGI` (`EmailUtente`,`TimestampInvio`,`Messaggio`,`IsDottore`)
VALUES
('francescobari@gmail.com','2019-12-03 12:10:02','Ciao dottore!', 'false'),
('samueledegrandi@gmail.com','2019-04-21 20:00:00','We grandissimo!', 'false'),
('enricograzioli@gmail.com','2019-05-15 16:15:02','Bomber tutto bene?', 'false'),
('sofiabianchi@gmail.com','2019-07-30 14:45:22','Uela vecchia volpe', 'false'),
('admin@admin.com','2019-11-28 18:12:58','RIP', 'true');

--


DROP TABLE IF EXISTS `NOTIZIE`;

CREATE TABLE `NOTIZIE` (
`IdNotizia` VARCHAR(55) NOT NULL,
`Titolo` VARCHAR(55) NOT NULL,
`Contenuto` VARCHAR(512) NOT NULL,
PRIMARY KEY (`IdNotizia`))
ENGINE=InnoDB;


INSERT INTO `NOTIZIE` (`IdNotizia`,`Titolo`,`Contenuto`)
VALUES
('001','Apertura straordinaria','Incredibile, siamo aperti!')
('002','Chiusura','Siamo in ferie, ciao')
('003','Nuovo corso su posturografia','Venite a vederlo, molto bello')
('004','Testo a caso','Incredibile, del buon e sano testo a caso')


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
