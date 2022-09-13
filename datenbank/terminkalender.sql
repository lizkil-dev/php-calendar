-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Sep 2022 um 11:32
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `terminkalender`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termine`
--

CREATE TABLE `termine` (
  `TerminID` int(4) NOT NULL,
  `Titel` varchar(50) NOT NULL,
  `Datum` date NOT NULL,
  `Start` time NOT NULL,
  `Ende` time NOT NULL,
  `Beschreibung` varchar(200) NOT NULL,
  `Monat` tinyint(2) NOT NULL,
  `Jahr` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `termine`
--

INSERT INTO `termine` (`TerminID`, `Titel`, `Datum`, `Start`, `Ende`, `Beschreibung`, `Monat`, `Jahr`) VALUES
(1, 'Zahnarzt', '2022-08-18', '10:50:00', '11:50:00', 'Aua', 8, 2022),
(2, 'Schwimmen', '2022-08-08', '17:00:00', '18:00:00', 'Freibad Mombach', 8, 2022),
(3, 'Kino', '2022-09-05', '22:52:00', '23:52:00', 'mit Esther', 9, 2022),
(4, 'Essen', '2022-08-16', '18:00:00', '20:00:00', 'Ristorane Pipikacka', 8, 2022),
(6, 'Projekt abgeben', '2022-09-02', '12:00:00', '15:00:00', 'yipee', 9, 2022),
(20, 'Urlaub!', '2022-09-17', '14:00:00', '00:00:00', 'Koffer packen!!', 9, 2022),
(22, 'Kino', '2022-08-31', '20:00:00', '23:55:00', 'Ich liebe euch!', 8, 2022),
(27, 'Theater', '2022-10-13', '20:00:00', '22:00:00', 'Don Giovanni', 10, 2022);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `userID` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userID`, `name`, `password`) VALUES
(1, 'Lisa', '$2y$10$wcZi7L50m9K89J6LMd6ohOkxvxrqoHHUUHfCv1O5vSkFgm.ZZVFeu');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `termine`
--
ALTER TABLE `termine`
  ADD PRIMARY KEY (`TerminID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `termine`
--
ALTER TABLE `termine`
  MODIFY `TerminID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
