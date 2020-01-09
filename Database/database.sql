-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2020 at 04:08 PM
-- Server version: 8.0.18-0ubuntu0.19.10.1
-- PHP Version: 7.2.24-0ubuntu0.19.04.1

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbDottMarcoDonati`
--
CREATE DATABASE IF NOT EXISTS `dbDottMarcoDonati` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `dbDottMarcoDonati`;

-- --------------------------------------------------------

--
-- Table structure for table `Messaggi`
--
-- Creation: Jan 09, 2020 at 03:02 PM
--

DROP TABLE IF EXISTS `Messaggi`;
CREATE TABLE `Messaggi` (
  `EmailUtente` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TimeInvio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Messaggio` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `IsDottore` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Messaggi`:
--   `EmailUtente`
--       `Utenti` -> `Email`
--

--
-- Truncate table before insert `Messaggi`
--

TRUNCATE TABLE `Messaggi`;
--
-- Dumping data for table `Messaggi`
--

INSERT INTO `Messaggi` (`EmailUtente`, `TimeInvio`, `Messaggio`, `IsDottore`) VALUES
('user@user.com', '2020-01-09 15:41:26', 'Buongiorno dottore,\r<br />Vorrei chiederle un informazione. Posso scriverle qua?\r<br />\r<br />Saluti,\r<br />User user', 0),
('user@user.com', '2020-01-09 15:43:21', 'Buongiorno user,\r<br />Tranquillo, chiedi pure.\r<br />\r<br />Saluti, Dott. Marco Donati', 1),
('user@user.com', '2020-01-09 15:43:43', 'Posso prendere un\'aspirina?', 0),
('user@user.com', '2020-01-09 15:43:54', 'Certo prendi pure', 1),
('user2@user.com', '2020-01-09 15:45:24', 'Buongiorno Dottore,\r<br />Ho appena prenotato una visita. Devo portare anche le carte delle visite fatte in precedenza?\r<br />Saluti, user2', 0),
('user2@user.com', '2020-01-09 15:47:15', 'Salve user2,\r<br />Se può potrebbero tornarmi utili, quindi le porti pure che poi le guardo.\r<br />\r<br />Saluti, l\'attendo prossimamente alla visita,\r<br />Dott. Marco Donati', 1),
('user2@user.com', '2020-01-09 15:47:35', 'Grazie mille.', 0),
('user2@user.com', '2020-01-09 15:47:58', 'Molto gentile, e grazie della disponibilità', 0),
('user2@user.com', '2020-01-09 15:48:11', 'Si figuri, è un piacere', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Notizie`
--
-- Creation: Jan 09, 2020 at 03:02 PM
-- Last update: Jan 09, 2020 at 03:02 PM
--

DROP TABLE IF EXISTS `Notizie`;
CREATE TABLE `Notizie` (
  `id` int(11) NOT NULL,
  `Data` date DEFAULT NULL,
  `Titolo` varchar(75) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Contenuto` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Notizie`:
--

--
-- Truncate table before insert `Notizie`
--

TRUNCATE TABLE `Notizie`;
--
-- Dumping data for table `Notizie`
--

INSERT DELAYED INTO `Notizie` (`id`, `Data`, `Titolo`, `Contenuto`) VALUES
(1, '2020-01-23', 'Attivato il nuovo servizio consulti <span xml:lang=\"en\">online</span>', 'Il servizio gratuito è rivolto a tutti i pazienti registrati che desiderano una valutazione o un\r\n                consiglio, da parte del <abbr title=\"Dottor\">Dott.</abbr>Marco Donati, su disturbi o patologie di\r\n                pertinenza otorinolaringoiatrica e sui disturbi dell’equilibrio. <br />\r\n                Per accedervi basta seguire questo <span xml:lang=\"en\">link</span> e registrarsi al sito <a\r\n                    href=\"consultionline.php\">Consulti <span xml:lang=\"en\">Online</span></a>'),
(2, '2020-01-16', 'Annuncio nuova Terapia', 'Dal giorno 10 Febbraio 2020 sarà disponibile per la prenotazione una nuova terapia nell\'ambito della\r\n                citologianasale.<br />\r\n                Per ogni comunicazione potete chiamare al numero 0491234567 o scrivere una mail ad\r\n                info@dottormarcodonati.it'),
(3, '2019-12-22', 'Chiusura attività studio', 'Dal giorno 24 Dicembre al giorno 26 Dicembre 2019 l’attività ambulatoriale è momentaneamente sospesa.\r\n                Per ogni comunicazione potete chiamare dal 27 Agosto 2019 al numero 0491234567 o scrivere una <span xml:lang=\"en\">mail</span> ad\r\n                info@dottormarcodonati.it'),
(4, '2020-01-09', 'Testo a caso', 'Incredibile, del buon e sano testo a caso');

-- --------------------------------------------------------

--
-- Table structure for table `Utenti`
--
-- Creation: Jan 09, 2020 at 03:02 PM
-- Last update: Jan 09, 2020 at 03:02 PM
--

DROP TABLE IF EXISTS `Utenti`;
CREATE TABLE `Utenti` (
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Cognome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Utenti`:
--

--
-- Truncate table before insert `Utenti`
--

TRUNCATE TABLE `Utenti`;
--
-- Dumping data for table `Utenti`
--

/*
Le password sono:
admin@admin.com     =>      admin
user@user.com       =>      user
user2@user.com       =>      user
*/

INSERT DELAYED INTO `Utenti` (`Email`, `Nome`, `Cognome`, `Telefono`, `Password`) VALUES
('admin@admin.com', 'Marco', 'Donati', '3450178933', 'D033E22AE348AEB5660FC2140AEC35850C4DA997'),
('user@user.com', 'user', 'user', '+39123456789', '12dea96fec20593566ab75692c9949596833adc9'),
('user2@user.com', 'user2', 'user2', '+39987654321', '12dea96fec20593566ab75692c9949596833adc9');

-- --------------------------------------------------------

--
-- Table structure for table `Visite`
--
-- Creation: Jan 09, 2020 at 03:02 PM
--

DROP TABLE IF EXISTS `Visite`;
CREATE TABLE `Visite` (
  `id` int(11) NOT NULL,
  `Giorno` date NOT NULL,
  `Ora` time NOT NULL,
  `Tipologia` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EmailUtente` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Visite`:
--   `EmailUtente`
--       `Utenti` -> `Email`
--

--
-- Truncate table before insert `Visite`
--

TRUNCATE TABLE `Visite`;
--
-- Dumping data for table `Visite`
--

INSERT DELAYED INTO `Visite` (`id`, `Giorno`, `Ora`, `Tipologia`, `EmailUtente`) VALUES
(1, '2020-01-15', '10:00:00', 'Impedenzometria', 'user2@user.com'),
(2, '2020-01-16', '18:00:00', 'Otomicroscopia', 'user2@user.com'),
(3, '2020-01-17', '09:00:00', 'Posturografia', 'user2@user.com'),
(4, '2020-01-18', '08:00:00', 'Impedenzometria', 'user2@user.com'),
(5, '2020-01-20', '11:00:00', 'Otomicroscopia', 'user2@user.com'),
(6, '2020-01-22', '18:00:00', 'Otomicroscopia', 'user2@user.com'),
(7, '2020-01-28', '08:00:00', 'Otomicroscopia', 'user2@user.com'),
(8, '2020-02-01', '18:00:00', 'Impedenzometria', 'user2@user.com'),
(9, '2020-02-04', '18:00:00', 'Otomicroscopia', 'user2@user.com'),
(10, '2020-02-08', '16:00:00', 'Citologianasale', 'user2@user.com'),
(11, '2020-01-21', '17:00:00', 'Impedenzometria', 'user@user.com'),
(12, '2020-01-22', '10:00:00', 'Citologianasale', 'user@user.com'),
(13, '2020-01-25', '17:00:00', 'Posturografia', 'user@user.com'),
(14, '2020-01-29', '10:00:00', 'Impedenzometria', 'user@user.com'),
(15, '2020-02-01', '09:00:00', 'Otomicroscopia', 'user@user.com'),
(16, '2020-02-02', '10:00:00', 'Otomicroscopia', 'user@user.com'),
(17, '2020-02-04', '17:00:00', 'Impedenzometria', 'user@user.com'),
(18, '2020-02-10', '10:00:00', 'Impedenzometria', 'user@user.com'),
(19, '2020-02-17', '17:00:00', 'Impedenzometria', 'user@user.com'),
(20, '2020-02-28', '17:00:00', 'Impedenzometria', 'user@user.com'),
(21, '2020-02-29', '08:00:00', 'Impedenzometria', 'user@user.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD PRIMARY KEY (`EmailUtente`,`TimeInvio`);

--
-- Indexes for table `Notizie`
--
ALTER TABLE `Notizie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `Visite`
--
ALTER TABLE `Visite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Giorno` (`Giorno`,`Ora`),
  ADD KEY `Visite-Utente` (`EmailUtente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Notizie`
--
ALTER TABLE `Notizie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Visite`
--
ALTER TABLE `Visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD CONSTRAINT `Messaggio-Utente` FOREIGN KEY (`EmailUtente`) REFERENCES `Utenti` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Visite`
--
ALTER TABLE `Visite`
  ADD CONSTRAINT `Visite-Utente` FOREIGN KEY (`EmailUtente`) REFERENCES `Utenti` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
