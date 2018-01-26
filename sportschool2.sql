-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 25 jan 2018 om 11:14
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
  `meter_distance` int(11) NOT NULL,
  `weight` float NOT NULL,
  `floors` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Utrecht', 'Eerste sportschool van Benno', '2349AJ', 18);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sports_device`
--

CREATE TABLE `sports_device` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `session_max_minutes` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '2018-01-25 10:17:18', '2018-01-25 10:20:18', 1, 1),
(2, '2018-01-25 10:19:18', '2018-01-25 10:22:20', 1, 1);

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
  `card` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `name`, `insertion`, `lastname`, `birthday`, `email`, `phone`, `street`, `house_number`, `postal_code`, `role`, `card`) VALUES
(1, 'santino', '71aac40d41fee6ee9da5a83b74af85ed817f9ae73944a08e6d29d4f79dd47781', '5a68f06d637c8', 'Santino', 'den', 'Brave', '1995-09-11', 'test@test.com', '0612345678', 'Daltonlaan', '200', '2349GA', 'user', NULL),
(2, 'benno', 'd2c79a011f403206a21c0ce86d3b7bfe921f5c4fd4d80b5907ff6750045ad7c9', '5a699fade8744', 'Benno', 'de', 'Sportschoolman', '1982-02-02', 'benno@sportschool.com', '0612312312', 'Sportschoolstraat', '12', '1234AB', 'admin', NULL);

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
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card` (`card`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `device_session`
--
ALTER TABLE `device_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `sports_device`
--
ALTER TABLE `sports_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `sport_session`
--
ALTER TABLE `sport_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
