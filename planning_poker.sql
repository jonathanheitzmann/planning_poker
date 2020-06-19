-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Jun 2020 um 19:33
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `planning_poker`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `nutzer_ID` int(11) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `registrierungsdatum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`nutzer_ID`, `vorname`, `nachname`, `email`, `nutzername`, `passwort`, `registrierungsdatum`) VALUES
(1, 'Max', 'Maier', 'Max@online.com', 'Max', 'oi.k21NBmv812', '2020-06-06 16:53:45'),
(2, 'Tina', 'Vogel', 'Tina@gmx.de', 'Tina', 'oi1Q9vIboc4Fo', '2020-06-06 16:54:35'),
(3, 'Fritz', 'Klein', 'Fritz@gmail.com', 'Fritzle', 'oiNt6u0QqaNjA', '2020-06-06 16:56:30');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiel`
--

CREATE TABLE `spiel` (
  `spiel_ID` int(11) NOT NULL,
  `einrichtungsdatum` timestamp NOT NULL DEFAULT current_timestamp(),
  `task` varchar(255) NOT NULL,
  `beschreibung` varchar(255) NOT NULL,
  `spiel_admin` varchar(11) NOT NULL,
  `ergebnis` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `spiel`
--

INSERT INTO `spiel` (`spiel_ID`, `einrichtungsdatum`, `task`, `beschreibung`, `spiel_admin`, `ergebnis`) VALUES
(1, '2020-06-06 17:04:17', 'Task 1', 'Das ist die Beschreibung zum ersten Task. Bitte spielt alle mit.', 'Max@online.', 0),
(2, '2020-06-06 17:05:51', 'Task 2', ' Ein anderer Task.', 'Tina@gmx.de', 4.5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zuordnung`
--

CREATE TABLE `zuordnung` (
  `spiel_ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `karte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `zuordnung`
--

INSERT INTO `zuordnung` (`spiel_ID`, `email`, `karte`) VALUES
(1, 'Max@online.com', 0),
(1, 'Fritz@gmail.com', 0),
(1, 'Tina@gmx.de', 0),
(2, 'Fritz@gmail.com', 5),
(2, 'Tina@gmx.de', 4);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`nutzer_ID`),
  ADD UNIQUE KEY `Mailadresse` (`email`);

--
-- Indizes für die Tabelle `spiel`
--
ALTER TABLE `spiel`
  ADD PRIMARY KEY (`spiel_ID`),
  ADD UNIQUE KEY `task` (`task`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `nutzer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `spiel`
--
ALTER TABLE `spiel`
  MODIFY `spiel_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
