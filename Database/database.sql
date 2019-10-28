-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ott 24, 2019 alle 14:42
-- Versione del server: 5.7.27-0ubuntu0.19.04.1
-- Versione PHP: 7.2.19-0ubuntu0.19.04.2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--
CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `database`;

-- --------------------------------------------------------

--
-- Struttura della tabella `Messaggi`
--
-- Creazione: Ott 24, 2019 alle 12:41
-- Ultimo aggiornamento: Ott 24, 2019 alle 12:41
--

DROP TABLE IF EXISTS `Messaggi`;
CREATE TABLE `Messaggi` (
  `EmailUtente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TimeInvio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Messaggio` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `IsDottore` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Messaggi`:
--   `EmailUtente`
--       `Utenti` -> `Email`
--

--
-- Svuota la tabella prima dell'inserimento `Messaggi`
--

TRUNCATE TABLE `Messaggi`;
--
-- Dump dei dati per la tabella `Messaggi`
--

INSERT INTO `Messaggi` (`EmailUtente`, `TimeInvio`, `Messaggio`, `IsDottore`) VALUES
('francescobari@gmail.com', '2019-11-28 17:12:58', 'RIP', 1),
('francescobari@gmail.com', '2019-12-03 11:10:02', 'Ciao dottore!', 0),
('samueledegrandi@gmail.com', '2019-04-21 18:00:00', 'We grandissimo!', 0),
('samueledegrandi@gmail.com', '2019-05-15 14:15:02', 'Bomber tutto bene?', 1),
('sofiabianchi@gmail.com', '2019-07-30 12:45:22', 'Uela vecchia volpe', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Notizie`
--
-- Creazione: Ott 24, 2019 alle 12:41
-- Ultimo aggiornamento: Ott 24, 2019 alle 12:35
--

DROP TABLE IF EXISTS `Notizie`;
CREATE TABLE `Notizie` (
  `id` int(11) NOT NULL,
  `Data` date DEFAULT NULL,
  `Titolo` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Contenuto` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Notizie`:
--

--
-- Svuota la tabella prima dell'inserimento `Notizie`
--

TRUNCATE TABLE `Notizie`;
--
-- Dump dei dati per la tabella `Notizie`
--

INSERT INTO `Notizie` (`id`, `Data`, `Titolo`, `Contenuto`) VALUES
(1, NULL, 'Apertura straordinaria', 'Incredibile, siamo aperti!'),
(2, NULL, 'Chiusura', 'Siamo in ferie, ciao'),
(3, NULL, 'Nuovo corso su posturografia', 'Venite a vederlo, molto bello'),
(4, NULL, 'Testo a caso', 'Incredibile, del buon e sano testo a caso');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--
-- Creazione: Ott 24, 2019 alle 12:41
-- Ultimo aggiornamento: Ott 24, 2019 alle 12:41
--

DROP TABLE IF EXISTS `Utenti`;
CREATE TABLE `Utenti` (
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Cognome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Utenti`:
--

--
-- Svuota la tabella prima dell'inserimento `Utenti`
--

TRUNCATE TABLE `Utenti`;
--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`Email`, `Nome`, `Cognome`, `Telefono`, `Password`) VALUES
('admin@admin.com', 'Marco', 'Donati', '3450178933', 'admin'),
('enricograzioli@gmail.com', 'Enrico', 'Grazioli', '3460010229', 'psw3'),
('francescobari@gmail.com', 'Francesco', 'Bari', '3490011234', 'psw1'),
('samueledegrandi@gmail.com', 'Samuele', 'De Grandi', '3459184440', 'psw2'),
('sofiabianchi@gmail.com', 'Sofia', 'Bianchi', '3496682884', 'psw4');

-- --------------------------------------------------------

--
-- Struttura della tabella `Visite`
--
-- Creazione: Ott 24, 2019 alle 12:41
-- Ultimo aggiornamento: Ott 24, 2019 alle 12:41
--

DROP TABLE IF EXISTS `Visite`;
CREATE TABLE `Visite` (
  `id` int(11) NOT NULL,
  `GiornoOra` datetime NOT NULL,
  `Tipologia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EmailUtente` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `Visite`:
--   `EmailUtente`
--       `Utenti` -> `Email`
--

--
-- Svuota la tabella prima dell'inserimento `Visite`
--

TRUNCATE TABLE `Visite`;
--
-- Dump dei dati per la tabella `Visite`
--

INSERT INTO `Visite` (`id`, `GiornoOra`, `Tipologia`, `EmailUtente`) VALUES
(1, '2020-04-13 08:00:00', 'Posturografia', 'francescobari@gmail.com'),
(2, '2019-10-13 09:00:00', 'Otomicroscopia', 'samueledegrandi@gmail.com'),
(3, '2020-01-17 00:00:00', 'Impedenzometria', 'francescobari@gmail.com'),
(4, '2020-02-20 18:00:00', 'Posturografia', 'sofiabianchi@gmail.com');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD PRIMARY KEY (`EmailUtente`,`TimeInvio`);

--
-- Indici per le tabelle `Notizie`
--
ALTER TABLE `Notizie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `Visite`
--
ALTER TABLE `Visite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `GiornoOra` (`GiornoOra`),
  ADD KEY `Visite-Utente` (`EmailUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Notizie`
--
ALTER TABLE `Notizie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `Visite`
--
ALTER TABLE `Visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Messaggi`
--
ALTER TABLE `Messaggi`
  ADD CONSTRAINT `Messaggio-Utente` FOREIGN KEY (`EmailUtente`) REFERENCES `Utenti` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Visite`
--
ALTER TABLE `Visite`
  ADD CONSTRAINT `Visite-Utente` FOREIGN KEY (`EmailUtente`) REFERENCES `Utenti` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;