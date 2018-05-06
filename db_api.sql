-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Apr 2018 um 11:23
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_api`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `booking_type_id` int(11) DEFAULT NULL,
  `arrival` datetime NOT NULL,
  `depature` datetime NOT NULL,
  `expiration_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `booking`
--

INSERT INTO `booking` (`id`, `guest_id`, `booking_type_id`, `arrival`, `depature`, `expiration_date`, `created`, `updated`) VALUES
(1, 6, 3, '2019-01-17 11:21:55', '2019-01-30 11:21:55', '2018-04-27 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(2, 11, 1, '2018-12-18 11:21:55', '2018-12-27 11:21:55', '2018-05-02 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(3, 3, 3, '2019-02-20 11:21:55', '2019-02-23 11:21:55', '2018-05-07 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(4, 6, 2, '2018-11-20 11:21:55', '2018-12-03 11:21:55', '2018-05-02 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(5, 6, 3, '2018-06-14 11:21:55', '2018-06-22 11:21:55', '2018-04-27 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(6, 10, 1, '2018-06-13 11:21:55', '2018-06-16 11:21:55', '2018-05-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(7, 7, 1, '2018-05-16 11:21:55', '2018-05-30 11:21:55', '2018-05-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(8, 3, 1, '2018-07-20 11:21:55', '2018-07-31 11:21:55', '2018-04-25 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(9, 9, 1, '2019-02-14 11:21:55', '2019-02-27 11:21:55', '2018-05-11 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(10, 15, 2, '2018-08-15 11:21:55', '2018-08-23 11:21:55', '2018-05-07 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(11, 7, 1, '2018-05-21 11:21:55', '2018-05-26 11:21:55', '2018-04-22 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(12, 19, 3, '2019-02-20 11:21:55', '2019-03-01 11:21:55', '2018-05-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(13, 17, 3, '2018-08-21 11:21:55', '2018-08-25 11:21:55', '2018-05-03 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(14, 18, 1, '2018-08-20 11:21:55', '2018-08-29 11:21:55', '2018-04-28 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(15, 7, 2, '2018-09-14 11:21:55', '2018-09-28 11:21:55', '2018-05-06 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(16, 11, 2, '2019-01-22 11:21:55', '2019-01-25 11:21:55', '2018-05-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(17, 18, 2, '2018-05-20 11:21:55', '2018-05-26 11:21:55', '2018-04-23 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(18, 5, 1, '2018-10-20 11:21:55', '2018-10-25 11:21:55', '2018-05-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(19, 8, 1, '2018-12-18 11:21:55', '2018-12-23 11:21:55', '2018-05-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(20, 1, 2, '2018-05-16 11:21:55', '2018-05-22 11:21:55', '2018-05-10 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `booking_room`
--

CREATE TABLE `booking_room` (
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `booking_room`
--

INSERT INTO `booking_room` (`booking_id`, `room_id`) VALUES
(1, 5),
(2, 13),
(3, 1),
(3, 9),
(3, 10),
(3, 15),
(4, 1),
(4, 6),
(4, 8),
(4, 10),
(4, 11),
(4, 13),
(5, 8),
(5, 11),
(6, 1),
(6, 4),
(6, 5),
(6, 10),
(6, 12),
(6, 14),
(6, 15),
(7, 2),
(7, 4),
(7, 6),
(7, 8),
(7, 9),
(7, 12),
(7, 14),
(8, 3),
(8, 6),
(8, 9),
(8, 10),
(8, 13),
(9, 9),
(10, 10),
(10, 13),
(11, 7),
(11, 8),
(11, 11),
(11, 14),
(11, 15),
(12, 2),
(12, 3),
(12, 4),
(12, 8),
(12, 10),
(12, 13),
(13, 3),
(13, 10),
(14, 4),
(14, 11),
(14, 13),
(15, 5),
(15, 9),
(15, 10),
(15, 12),
(15, 14),
(16, 7),
(16, 13),
(17, 1),
(17, 4),
(17, 9),
(17, 11),
(17, 14),
(18, 3),
(18, 4),
(18, 7),
(18, 9),
(18, 11),
(18, 14),
(18, 15),
(19, 5),
(19, 15),
(20, 2),
(20, 8),
(20, 13);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `booking_type`
--

CREATE TABLE `booking_type` (
  `id` int(11) NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `can_expire` tinyint(1) NOT NULL,
  `dummy` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `booking_type`
--

INSERT INTO `booking_type` (`id`, `type`, `can_expire`, `dummy`, `created`, `updated`) VALUES
(1, 'Booking', 0, 0, '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(2, 'Reservation', 1, 0, '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(3, 'Blocked', 0, 1, '2018-04-12 11:21:55', '2018-04-12 11:21:55');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `guest`
--

INSERT INTO `guest` (`id`, `firstname`, `lastname`, `email`, `phone`, `created`, `updated`) VALUES
(1, 'Max', 'Stroetmann', 'max.stroetmann@no-mail.com', '01779535622', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(2, 'Helmut', 'Kruse', 'helmut.kruse@no-mail.com', '01468730397', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(3, 'Max', 'Stroetmann', 'max.stroetmann@no-mail.com', '01789493208', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(4, 'Dora', 'Fischer', 'dora.fischer@no-mail.com', '01270974177', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(5, 'Tom', 'Kader', 'tom.kader@no-mail.com', '01552321050', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(6, 'Dora', 'Mustermann', 'dora.mustermann@no-mail.com', '01816623755', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(7, 'Tom', 'Fischer', 'tom.fischer@no-mail.com', '01358247479', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(8, 'Max', 'Kader', 'max.kader@no-mail.com', '01269742369', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(9, 'Helmut', 'Mustermann', 'helmut.mustermann@no-mail.com', '01853950924', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(10, 'Dora', 'Kader', 'dora.kader@no-mail.com', '01708745178', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(11, 'Max', 'Fischer', 'max.fischer@no-mail.com', '01306597235', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(12, 'Helga', 'Kader', 'helga.kader@no-mail.com', '01666192455', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(13, 'Tom', 'Mustermann', 'tom.mustermann@no-mail.com', '01500653558', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(14, 'Dora', 'Mustermann', 'dora.mustermann@no-mail.com', '01276627280', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(15, 'Max', 'Kruse', 'max.kruse@no-mail.com', '01303760805', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(16, 'Helmut', 'Fischer', 'helmut.fischer@no-mail.com', '01345299780', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(17, 'Tom', 'Fischer', 'tom.fischer@no-mail.com', '01253366235', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(18, 'Aleyna', 'Mustermann', 'aleyna.mustermann@no-mail.com', '01662703281', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(19, 'Helga', 'Mustermann', 'helga.mustermann@no-mail.com', '01651352622', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(20, 'Tom', 'Kruse', 'tom.kruse@no-mail.com', '01926067268', '2018-04-12 11:21:55', '2018-04-12 11:21:55');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180314194447'),
('20180325160238'),
('20180329073554'),
('20180411112551');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `room`
--

INSERT INTO `room` (`id`, `room_type_id`, `name`, `valid_from`, `valid_to`, `created`, `updated`) VALUES
(1, 3, 'room 0', '2018-04-05 11:21:55', '2014-05-11 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(2, 1, 'room 1', '2018-04-10 11:21:55', '2012-04-03 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(3, 3, 'room 2', '2018-04-06 11:21:55', '2011-07-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(4, 1, 'room 3', '2018-04-08 11:21:55', '2013-04-08 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(5, 2, 'room 4', '2018-04-09 11:21:55', '2012-06-07 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(6, 5, 'room 5', '2018-04-11 11:21:55', '2013-05-11 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(7, 5, 'room 6', '2018-04-03 11:21:55', '2015-05-11 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(8, 2, 'room 7', '2018-04-11 11:21:55', '2011-07-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(9, 4, 'room 8', '2018-04-09 11:21:55', '2014-05-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(10, 2, 'room 9', '2018-04-08 11:21:55', '2014-05-10 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(11, 4, 'room 10', '2018-04-10 11:21:55', '2014-07-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(12, 3, 'room 11', '2018-04-06 11:21:55', '2012-06-11 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(13, 2, 'room 12', '2018-04-06 11:21:55', '2012-06-09 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(14, 5, 'room 13', '2018-04-07 11:21:55', '2011-05-05 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(15, 3, 'room 14', '2018-04-08 11:21:55', '2012-06-02 11:21:55', '2018-04-12 11:21:55', '2018-04-12 11:21:55');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room_type`
--

CREATE TABLE `room_type` (
  `id` int(11) NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `room_type`
--

INSERT INTO `room_type` (`id`, `type`, `capacity`, `created`, `updated`) VALUES
(1, 'roomType 0', 3, '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(2, 'roomType 1', 4, '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(3, 'roomType 2', 4, '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(4, 'roomType 3', 6, '2018-04-12 11:21:55', '2018-04-12 11:21:55'),
(5, 'roomType 4', 3, '2018-04-12 11:21:55', '2018-04-12 11:21:55');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `roles`, `email`, `is_active`, `created`, `updated`) VALUES
(1, 'admin', '$2y$13$qCIc0S6jiXUpL2e9IBBY7uAEsKtOWEwidhEHNtDIVuJjUhZQLZAUS', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'admin@no-mail.com', 1, '2018-04-12 11:21:54', '2018-04-12 11:21:54'),
(2, 'user', '$2y$13$I6472kAKOKXQtlHvHd.RdOzLay7SRVgu1xQbRVcFptW7cH8muGs9G', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'user@no-mail.com', 1, '2018-04-12 11:21:55', '2018-04-12 11:21:55');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E00CEDDE9A4AA658` (`guest_id`),
  ADD KEY `IDX_E00CEDDE9FF2C9B3` (`booking_type_id`);

--
-- Indizes für die Tabelle `booking_room`
--
ALTER TABLE `booking_room`
  ADD PRIMARY KEY (`booking_id`,`room_id`),
  ADD KEY `IDX_6A0E73D53301C60` (`booking_id`),
  ADD KEY `IDX_6A0E73D554177093` (`room_id`);

--
-- Indizes für die Tabelle `booking_type`
--
ALTER TABLE `booking_type`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_729F519B5E237E06` (`name`),
  ADD KEY `IDX_729F519B296E3073` (`room_type_id`);

--
-- Indizes für die Tabelle `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `booking_type`
--
ALTER TABLE `booking_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_E00CEDDE9A4AA658` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`),
  ADD CONSTRAINT `FK_E00CEDDE9FF2C9B3` FOREIGN KEY (`booking_type_id`) REFERENCES `booking_type` (`id`);

--
-- Constraints der Tabelle `booking_room`
--
ALTER TABLE `booking_room`
  ADD CONSTRAINT `FK_6A0E73D53301C60` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6A0E73D554177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_729F519B296E3073` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
