-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 apr 2019 om 15:00
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
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `text`) VALUES
(46, 1, 12, '😂'),
(47, 1, 12, 'efsd'),
(48, 1, 12, 'cdsvd'),
(49, 1, 12, 'sfcs'),
(50, 2, 12, ''),
(51, 2, 12, 'test'),
(52, 4, 12, 'new'),
(53, 1, 12, '🎂'),
(54, 1, 12, 'iest'),
(55, 10, 12, 'ziet er lekker uit!!!! 👀👀👀'),
(58, 1, 12, '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;'),
(59, 2, 12, '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;'),
(60, 4, 12, '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;'),
(61, 5, 12, ''),
(62, 5, 12, ''),
(63, 3, 12, ''),
(64, 4, 12, ''),
(65, 5, 12, '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;'),
(66, 7, 12, '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;'),
(67, 0, 12, 'klzscaklc');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img_dir` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `post_description` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img_dir`, `post_description`) VALUES
(1, 5, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'anders'),
(2, 5, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'een andere beschrijving'),
(3, 5, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'sommige dagen zijn beter dan andere'),
(4, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'lekker hoor'),
(5, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some text'),
(6, 6, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'some other text'),
(7, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some other text'),
(8, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some other text'),
(9, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'truturturtu'),
(10, 11, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'dsfdfsdfdf'),
(11, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'heggdsfgdsgf'),
(12, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'iets nieuws'),
(13, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'new'),
(14, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'iets'),
(15, 11, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '?'),
(16, 11, 'images/posts/four_horsemen.png', '👀'),
(17, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;');

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
  `img_dir` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `img_dir`, `description`) VALUES
(1, 'Aqsa', 'Intizar', 'r0720901', 'aqsatje@live.ve', '$2y$12$axbOyWVcYxKA3SkXBYjkPOMVUDFGW9430s..66KpcwCsGCBc0v23i', '', ''),
(2, 'wesley', 'wijsen', 'tester', 'weske@hotmail.com', '$2y$12$YRlSUzO8rBLhzmjVKODT5.i0i18u.2HCzQrxkiKwWvN6vnTV8uAKG', 'images/profilePics/four_horsemen.png', 'xss security in ordde!!! 😎'),
(3, 'John', 'Doe', 'Jonnyy', 'johnDoe@hotmail.com', '$2y$12$08MFHXwNbRvKmzufOI5Wf.VcDP2SD6DNULJmRYk3BRSJL4d4yoy4m', 'images/profilePics/four_horsemen.png', ''),
(4, 'test', 'tester', 'tstrrrr', 'test@test.com', '$2y$12$8LNPa.2bIzi5FQJltuw4ZurvpfRSr.UFV7nYaGqvzIIHvdzDVF16m', '', ''),
(5, 'iemand', 'anders', 'ieANd', 'iemand@test.com', '$2y$12$iZlZeHy5FkibRE0bnAhO2.FA65jdfogy4pfK57NFHELrdZMf7zOdC', 'images/profilePics/four_horsemen.png', 'dit is een nieuwe beschrijving 😁'),
(6, 'somebody', 'toKnow', 'useToKnow', 'somebody@test.com', '$2y$12$97OYk2gt8JYkujsg7pY0y.vkJgnSt2ftHM6l4qSJ7ilYE.JXZXiva', '', ''),
(7, 'new', 'test', 'newtester', 'newtester@sest.be', '$2y$12$WqLFkqy0J9clSF5VGzkLBOv30zhB6NUG2NNgOQ7Saig3qi4fmhtkW', '', ''),
(8, 'nog', 'eens', 'nogeens', 'nogeens@test.com', '$2y$12$Ygq3Shy/qOnFkZi9IyB5buwppfpJlWIgJTqeOWkUNkrAyp7q36AiO', 'images/profilePics/four_horsemen.png', ''),
(9, 'em', 'ail', 'emAil', 'Email.test.com', '$2y$12$2pevnrnzAqdZitcU.Vo2Gudl9xddS0ocYUbmF6SJJ5VioGWA50rda', 'images/profilePics/four_horsemen.png', 'aardappelhoofd 😂'),
(10, 'voor', 'email', 'voMail', 'vomail@test.be', '$2y$12$83U3sPLppzk7OAj6J.eArOGUfHxl0v/lo.PCHD7I0iTDs1ztnWJ7u', 'images/profilePics/four_horsemen.png', 'een beschrijving voor VoMail'),
(11, 'new', 'Post', 'newPost', 'newpost@hotmail.com', '$2y$12$JW8X5/PoQsABMuBBL2Hfb.atAdPPkF5HkyYEAufMDLTN5dR98wSXC', 'images/profilePics/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'this is my new description 👀'),
(12, 'weske', 'wke', 'wwke', 'wwke@test.com', '$2y$12$3TEOxS5IWM6KXa/EW.D3ee4B7Svsy65mbNhZZgwFs1ysye7NeZNZW', '', ''),
(13, 'newT', 'est', 'newTest', 'newTest@hotmail.com', '$2y$12$lQamSQx7r6YbRvYUxS1hHu8QB75ZB7/BoXm6jC6N9pJHvqZvMJqe2', '', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
