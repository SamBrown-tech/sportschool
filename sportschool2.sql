-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 jan 2018 om 10:49
-- Serverversie: 5.7.14
-- PHP-versie: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportschool2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `device_session`
--

CREATE TABLE `device_session` (
  `id` int(11) NOT NULL,
  `sports_device` int(11) NOT NULL,
  `sport_session` int(11) NOT NULL,
  `session_start` time NOT NULL,
  `session_end` time NOT NULL,
  `meter_distance` int(11) DEFAULT NULL,
  `sets` float DEFAULT NULL,
  `floors` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `device_session`
--

INSERT INTO `device_session` (`id`, `sports_device`, `sport_session`, `session_start`, `session_end`, `meter_distance`, `sets`, `floors`) VALUES
(1, 1, 3, '11:10:00', '11:20:00', 130, NULL, NULL),
(2, 2, 3, '11:25:00', '11:52:14', NULL, 0.4, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `street` varchar(45) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `house_number` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `location`
--

INSERT INTO `location` (`id`, `name`, `street`, `postal_code`, `house_number`) VALUES
(1, 'Utrecht', 'Eerste sportschool van Benno', '2349AJ', 18),
(2, 'Rotterdam', 'Tweede sportschool', '1234AB', 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sports_device`
--

CREATE TABLE `sports_device` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `session_max_minutes` int(11) NOT NULL,
  `calories_per_minute` float NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sports_device`
--

INSERT INTO `sports_device` (`id`, `name`, `session_max_minutes`, `calories_per_minute`, `description`) VALUES
(1, 'Hometrainer', 120, 12, 'Een hometrainer is het meest bekende fitnessapparaat.'),
(2, 'Leg extension machine', 120, 4.7, 'De leg extension machine is een machine waarmee je geisoleerd de quadriceps in de benen kunt trainen.De quadriceps zijn de spieren aan de voorkant van je bovenbenen.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sport_session`
--

CREATE TABLE `sport_session` (
  `id` int(11) NOT NULL,
  `session_start` datetime NOT NULL,
  `session_end` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `sport_session`
--

INSERT INTO `sport_session` (`id`, `session_start`, `session_end`, `user`, `location`) VALUES
(3, '2018-01-26 11:00:00', '2018-01-26 12:00:00', 1, 1),
(4, '2018-01-26 14:39:00', '2018-01-26 15:45:00', 1, 2),
(5, '2018-01-26 08:14:05', '2018-01-26 10:14:05', 3, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `subscription`
--

INSERT INTO `subscription` (`id`, `name`, `price`) VALUES
(1, 'student', 15),
(2, 'daluur', 20),
(3, 'onbeperkt', 30);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `insertion` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `street` varchar(45) NOT NULL,
  `house_number` varchar(5) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `role` varchar(20) NOT NULL,
  `iban` varchar(18) NOT NULL,
  `subscription` int(11) DEFAULT NULL,
  `card` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `name`, `insertion`, `lastname`, `birthday`, `email`, `phone`, `street`, `house_number`, `postal_code`, `role`, `iban`, `subscription`, `card`) VALUES
(1, 'santino', '097f74cfaf6a0c27dc94bae2031ce60c543b530983dd28129ee3a11971d26daf', '5a6b170dde658', 'santino', 'den', 'brave', '1995-09-11', 'santino@mail.com', '0612312312', 'Street', '12', '1234AB', 'user', 'NL99RABO123456890', 3, NULL),
(2, 'Benno', '9bf1eb457f1baa73e32f1c1c9372579d87ae28da58441ff3d152103ef2f996e2', '5a6b203ae9f78', 'Benno', 'de', 'Jong', '1982-09-11', 'benno@sportschool.com', '0612312312', 'street', '12', '1234AB', 'admin', '', NULL, NULL),
(3, 'user2', '84c5519b47c5fabbe728875c06d820b5e597ab0b2f3ec9acf88b0bb90b2806b6', '5a6b240d3775c', 'User', 'test', 'user', '1998-09-12', 'test@user.com', '0612345678', 'Straatnaam', '123', '2319GA', 'user', 'NL99ABN1231231231', 2, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `device_session`
--
ALTER TABLE `device_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sports_device` (`sports_device`),
  ADD KEY `sport_session` (`sport_session`);

--
-- Indexen voor tabel `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `sports_device`
--
ALTER TABLE `sports_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `sport_session`
--
ALTER TABLE `sport_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `location` (`location`);

--
-- Indexen voor tabel `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card` (`card`),
  ADD KEY `abonnement` (`subscription`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `device_session`
--
ALTER TABLE `device_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `sports_device`
--
ALTER TABLE `sports_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `sport_session`
--
ALTER TABLE `sport_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `device_session`
--
ALTER TABLE `device_session`
  ADD CONSTRAINT `device_session_ibfk_1` FOREIGN KEY (`sport_session`) REFERENCES `sport_session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_session_ibfk_2` FOREIGN KEY (`sports_device`) REFERENCES `sports_device` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `sport_session`
--
ALTER TABLE `sport_session`
  ADD CONSTRAINT `sport_session_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sport_session_ibfk_2` FOREIGN KEY (`location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`subscription`) REFERENCES `subscription` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
