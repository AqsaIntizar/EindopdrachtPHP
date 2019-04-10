-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 apr 2019 om 22:02
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `includefood`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img_dir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `img_dir`) VALUES
(1, 'Aqsa', 'Intizar', 'r0720901', 'aqsatje@live.ve', '$2y$12$axbOyWVcYxKA3SkXBYjkPOMVUDFGW9430s..66KpcwCsGCBc0v23i', ''),
(2, 'wesley', 'wijsen', 'tester', 'wesleywijsen@hotmail.com', '$2y$12$UkyX8GzgnLhTUMHOqUGBVezjjAMrvhWkk/rFyRwMtk6UpKNlTVc5K', 'images/profilePics/four_horsemen.png'),
(3, 'John', 'Doe', 'Jonnyy', 'johnDoe@hotmail.com', '$2y$12$08MFHXwNbRvKmzufOI5Wf.VcDP2SD6DNULJmRYk3BRSJL4d4yoy4m', 'images/profilePics/1920x1080NoCal.png'),
(4, 'test', 'tester', 'tstrrrr', 'test@test.com', '$2y$12$8LNPa.2bIzi5FQJltuw4ZurvpfRSr.UFV7nYaGqvzIIHvdzDVF16m', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
includefood