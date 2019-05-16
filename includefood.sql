-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 mei 2019 om 21:02
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
(67, 0, 12, 'klzscaklc'),
(68, 1, 13, 'Test'),
(69, 1, 13, 'yeet'),
(70, 1, 13, ''),
(71, 2, 13, 'yeeet'),
(72, 36, 12, 'ziet er goed uit'),
(73, 38, 15, 'etst'),
(74, 38, 12, 'tester'),
(75, 37, 12, 'anders'),
(76, 37, 12, 'nog een comment'),
(77, 51, 12, 'test'),
(78, 62, 20, 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `follower`
--

CREATE TABLE `follower` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `follows` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `follower`
--

INSERT INTO `follower` (`id`, `follower`, `follows`, `type`, `date_created`) VALUES
(1, 1, 2, 1, '0000-00-00 00:00:00'),
(2, 3, 4, 1, '0000-00-00 00:00:00'),
(3, 3, 1, 1, '0000-00-00 00:00:00'),
(4, 12, 15, 0, '2019-05-11 22:54:56'),
(5, 12, 14, 0, '2019-05-12 16:01:35'),
(6, 12, 12, 0, '2019-05-14 21:38:22'),
(7, 18, 15, 0, '2019-05-11 23:46:22'),
(8, 18, 12, 0, '2019-05-11 23:46:18'),
(9, 12, 11, 0, '2019-05-12 15:37:58'),
(10, 12, 6, 0, '2019-05-14 21:38:26');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `type`, `date_created`) VALUES
(26, 12, 38, 0, '2019-05-11 18:48:29'),
(27, 12, 37, 1, '2019-05-11 23:43:02'),
(28, 12, 35, 1, '2019-05-11 16:35:58'),
(29, 12, 34, 1, '2019-05-11 16:48:32'),
(30, 12, 36, 1, '2019-05-11 23:43:04'),
(31, 12, 20, 1, '2019-05-11 22:53:09'),
(32, 12, 10, 1, '2019-05-11 22:54:24'),
(33, 12, 5, 1, '2019-05-11 22:54:36'),
(34, 12, 32, 1, '2019-05-12 15:38:23'),
(35, 12, 31, 1, '2019-05-12 15:46:49'),
(36, 12, 51, 1, '2019-05-14 22:27:22');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img_dir` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `post_description` text CHARACTER SET utf8mb4 NOT NULL,
  `date_created` datetime NOT NULL,
  `color1` varchar(255) NOT NULL,
  `color2` varchar(255) NOT NULL,
  `color3` varchar(255) NOT NULL,
  `color4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img_dir`, `post_description`, `date_created`, `color1`, `color2`, `color3`, `color4`) VALUES
(1, 5, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'anders', '0000-00-00 00:00:00', '', '', '', ''),
(2, 5, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'een andere beschrijving', '0000-00-00 00:00:00', '', '', '', ''),
(3, 5, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'sommige dagen zijn beter dan andere', '0000-00-00 00:00:00', '', '', '', ''),
(4, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'lekker hoor', '0000-00-00 00:00:00', '', '', '', ''),
(5, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some text', '0000-00-00 00:00:00', '', '', '', ''),
(6, 6, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'some other text', '0000-00-00 00:00:00', '', '', '', ''),
(7, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some other text', '0000-00-00 00:00:00', '', '', '', ''),
(8, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some other text', '0000-00-00 00:00:00', '', '', '', ''),
(9, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'truturturtu', '0000-00-00 00:00:00', '', '', '', ''),
(10, 11, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'dsfdfsdfdf', '0000-00-00 00:00:00', '', '', '', ''),
(11, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'heggdsfgdsgf', '0000-00-00 00:00:00', '', '', '', ''),
(12, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'iets nieuws', '0000-00-00 00:00:00', '', '', '', ''),
(13, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'new', '0000-00-00 00:00:00', '', '', '', ''),
(14, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'iets', '0000-00-00 00:00:00', '', '', '', ''),
(15, 11, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '?', '0000-00-00 00:00:00', '', '', '', ''),
(16, 11, 'images/posts/four_horsemen.png', '👀', '0000-00-00 00:00:00', '', '', '', ''),
(17, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;', '0000-00-00 00:00:00', '', '', '', ''),
(18, 14, 'images/posts/apache.jpg', '#wow #food #beautiful This is so cool!', '0000-00-00 00:00:00', '', '', '', ''),
(19, 14, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(20, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(21, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#wow #food #beautiful This is so cool!', '0000-00-00 00:00:00', '', '', '', ''),
(23, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'so #cool', '0000-00-00 00:00:00', '', '', '', ''),
(24, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#test', '0000-00-00 00:00:00', '', '', '', ''),
(25, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(26, 14, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(27, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(28, 14, 'images/posts/four_horsemen.png', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(29, 14, 'images/posts/four_horsemen.png', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(30, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#food', '0000-00-00 00:00:00', '', '', '', ''),
(31, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#food', '2019-05-08 13:43:48', '', '', '', ''),
(32, 14, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#cool', '2019-05-08 13:55:16', '', '', '', ''),
(33, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#food', '2019-05-08 14:10:35', '', '', '', ''),
(34, 14, 'images/posts/africa-animal-animals-417142.jpg', '#wow #food #beautiful This is so cool!', '2019-05-08 18:38:17', '', '', '', ''),
(35, 14, '9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#food', '2019-05-08 20:49:52', '', '', '', ''),
(36, 12, '12_1557431023.jpg', 'lekker lekker 👀', '2019-05-09 21:43:43', '', '', '', ''),
(37, 12, '12_1557433470.jpg', 'trolololo', '2019-05-09 22:24:30', '', '', '', ''),
(38, 15, '15_1557436116.jpg', 'mijn nieuwste foto 🤣', '2019-05-09 23:08:36', '', '', '', ''),
(39, 12, '12_1557862760.jpg', 'lekker', '2019-05-14 21:39:20', '', '', '', ''),
(40, 7, '7_1557864266.jpg', 'new content', '2019-05-14 22:04:26', '', '', '', ''),
(41, 7, '7_1557864295.png', 'other content', '2019-05-14 22:04:55', '', '', '', ''),
(42, 10, '10_1557864354.jpg', 'ergsg 😂', '2019-05-14 22:05:54', '', '', '', ''),
(43, 10, '10_1557864370.jpg', 'nog is', '2019-05-14 22:06:10', '', '', '', ''),
(44, 10, '10_1557864391.png', 'wefds', '2019-05-14 22:06:31', '', '', '', ''),
(46, 10, '10_1557864579.jpg', 'test', '2019-05-14 22:09:39', '', '', '', ''),
(47, 12, '12_1557864851.jpg', 'andere', '2019-05-14 22:14:11', '', '', '', ''),
(48, 12, '12_1557865056.png', 'lol', '2019-05-14 22:17:36', '', '', '', ''),
(49, 12, '12_1557865071.jpg', 'nog 1', '2019-05-14 22:17:51', '', '', '', ''),
(50, 12, '12_1557865089.jpg', 'een andere', '2019-05-14 22:18:09', '', '', '', ''),
(51, 12, '12_1557865107.jpg', 'nog wat zout erop!!!!', '2019-05-14 22:18:27', '', '', '', ''),
(52, 19, '19_1557956656.jpg', 'test voor color extractie', '2019-05-15 23:44:16', '8164259', '5322273', '3886684', '9993043'),
(53, 19, '19_1557957142.png', 'testerkeee', '2019-05-15 23:52:22', '9331774', '2436400', '12560468', '3473409'),
(54, 19, '19_1557957274.jpg', 'nieuwe test 👀', '2019-05-15 23:54:34', '#E38200', '#973F00', '#2A0F04', '#FFE598'),
(55, 19, '19_1557958165.jpg', 'fdghjnkml', '2019-05-16 00:09:25', '#66000E', '#B55700', '#151A1D', '#9E697B'),
(56, 19, '19_1557958202.jpg', 'test', '2019-05-16 00:10:02', '#E38200', '#973F00', '#2A0F04', '#FFE598'),
(57, 19, '19_1557959709.png', 'ergrerr', '2019-05-16 00:35:09', '#8E643E', '#252D30', '#BFA854', '#350001'),
(58, 19, '19_1557959735.jpg', 'nog is', '2019-05-16 00:35:35', '#E38200', '#973F00', '#2A0F04', '#FFE598'),
(59, 19, '19_1557959768.jpg', 'en nog een post', '2019-05-16 00:36:08', '#E38200', '#973F00', '#2A0F04', '#FFE598'),
(60, 19, '19_1558009875.jpg', 'test', '2019-05-16 14:31:15', '#EF973E', '#000000', '#8E5B2C', '#F2E795'),
(61, 19, '19_1558009907.jpg', 'uhfuuy', '2019-05-16 14:31:47', '#E38200', '#973F00', '#2A0F04', '#FFE598'),
(62, 19, '19_1558012882.jpg', 'test', '2019-05-16 15:21:22', '#66000E', '#B55700', '#151A1D', '#9E697B');

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
(12, 'weske', 'wke', 'wwke', 'wwke@test.com', '$2y$12$3TEOxS5IWM6KXa/EW.D3ee4B7Svsy65mbNhZZgwFs1ysye7NeZNZW', '12_1557668399.jpg', 'mijn beschrijving is als volgt: dat was het 😂'),
(13, 'newT', 'est', 'newTest', 'newTest@hotmail.com', '$2y$12$lQamSQx7r6YbRvYUxS1hHu8QB75ZB7/BoXm6jC6N9pJHvqZvMJqe2', '', ''),
(14, 'Ruben', 'Pieters', 'Ruben', 'pietersruben@hotmail.com', '$2y$10$aw8OWiPi1crtYgx0qO5C7eVPZGNErCzaE56B0fQ.ph7WSBO8w271m', 'images/profilePics/FeelsGood.png', 'Ruben Pieters'),
(15, 'nieuw', 'ste', 'nieuwste', 'nieuwste@test.com', '$2y$10$Ip3jSXiNFD17qGBke0GRfufnbtof5V/bb/zkqtPyTKqRNhatI9OX6', '', ''),
(16, 'een', 'naam', 'enaam', 'eennaam@test.com', '$2y$10$TZXdwt6dFPh5U7i19MvaA.Xiwn7A/wdchUuN0KnHHdbQkDCvF9iiq', '', ''),
(17, 'piet', 'snot', 'piot', 'poit@test.com', '$2y$10$lQ3IFcANxmwhePg1Ph7S2ezkBeF6t9R0TZsux1CJOb2Sc8o802wse', '', ''),
(18, 'Don', 'Amigo', 'DAmigo', 'DAmigo@test.com', '$2y$10$yHn6O6p2suuwy13ocsdIqubnnDsBN68BOuJ/gFyrsakLP7O0mXps2', '18_1557613857.png', ''),
(19, 'wesni', 'zwijsen', 'niesen', 'niesen@test.com', '$2y$10$.7H1yfBkiQ9wTllBnecw1uAFig6AKi0zXZm0K37n2r.f5qPTuqWiS', '', ''),
(20, 'wesken', 'wijsken', 'wesken', 'wesken@test.com', '$2y$10$INg/ZbtwwA4zGub/Qhepl.3gfOK7xsHFduiMKNWb0Qkj37ROnRYrW', 'default.png', ''),
(21, 'jos', 'vermeulen', 'foodKing', 'foodKing@test.com', '$2y$10$RVE/t5ZTjGNjWBDJ1ISBS.biFJprXhVyE4bRPUNwcscf/UY9dfoie', '21_1558016587.jpg', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT voor een tabel `follower`
--
ALTER TABLE `follower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
