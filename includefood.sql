-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                5.6.34-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Versie:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Databasestructuur van includefood wordt geschreven
CREATE DATABASE IF NOT EXISTS `includefood` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `includefood`;

-- Structuur van  tabel includefood.comments wordt geschreven
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel includefood.comments: ~24 rows (ongeveer)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
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
	(71, 2, 13, 'yeeet');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Structuur van  tabel includefood.likes wordt geschreven
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel includefood.likes: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;

-- Structuur van  tabel includefood.posts wordt geschreven
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_img_dir` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `post_description` text CHARACTER SET utf8mb4 NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel includefood.posts: ~28 rows (ongeveer)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `user_id`, `post_img_dir`, `post_description`, `date_created`) VALUES
	(1, 5, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'anders', '0000-00-00 00:00:00'),
	(2, 5, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'een andere beschrijving', '0000-00-00 00:00:00'),
	(3, 5, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'sommige dagen zijn beter dan andere', '0000-00-00 00:00:00'),
	(4, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'lekker hoor', '0000-00-00 00:00:00'),
	(5, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some text', '0000-00-00 00:00:00'),
	(6, 6, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'some other text', '0000-00-00 00:00:00'),
	(7, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some other text', '0000-00-00 00:00:00'),
	(8, 6, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'some other text', '0000-00-00 00:00:00'),
	(9, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'truturturtu', '0000-00-00 00:00:00'),
	(10, 11, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', 'dsfdfsdfdf', '0000-00-00 00:00:00'),
	(11, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'heggdsfgdsgf', '0000-00-00 00:00:00'),
	(12, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'iets nieuws', '0000-00-00 00:00:00'),
	(13, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'new', '0000-00-00 00:00:00'),
	(14, 11, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', 'iets', '0000-00-00 00:00:00'),
	(15, 11, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '?', '0000-00-00 00:00:00'),
	(16, 11, 'images/posts/four_horsemen.png', '👀', '0000-00-00 00:00:00'),
	(17, 11, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '&lt;SCRIPT SRC=http://xss.rocks/xss.js&gt;&lt;/SCRIPT&gt;', '0000-00-00 00:00:00'),
	(18, 14, 'images/posts/apache.jpg', '#wow #food #beautiful This is so cool!', '0000-00-00 00:00:00'),
	(19, 14, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#food', '0000-00-00 00:00:00'),
	(20, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#food', '0000-00-00 00:00:00'),
	(21, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#wow #food #beautiful This is so cool!', '0000-00-00 00:00:00'),
	(23, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', 'so #cool', '0000-00-00 00:00:00'),
	(24, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#test', '0000-00-00 00:00:00'),
	(25, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#food', '0000-00-00 00:00:00'),
	(26, 14, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#food', '0000-00-00 00:00:00'),
	(27, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#food', '0000-00-00 00:00:00'),
	(28, 14, 'images/posts/four_horsemen.png', '#food', '0000-00-00 00:00:00'),
	(29, 14, 'images/posts/four_horsemen.png', '#food', '0000-00-00 00:00:00'),
	(30, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#food', '0000-00-00 00:00:00'),
	(31, 14, 'images/posts/one_pot_chorizo_and_15611_16x9.jpg', '#food', '2019-05-08 13:43:48'),
	(32, 14, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#cool', '2019-05-08 13:55:16'),
	(33, 14, 'images/posts/636674359927753055-0717-NEW-STATEFAIR-FOODS-00029.jpg', '#food', '2019-05-08 14:10:35'),
	(34, 14, 'images/posts/africa-animal-animals-417142.jpg', '#wow #food #beautiful This is so cool!', '2019-05-08 18:38:17'),
	(35, 14, 'images/posts/9-Foods-You-Should-Never-Eat-Before-Bed-760x506.jpg', '#food', '2019-05-08 20:49:52');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Structuur van  tabel includefood.users wordt geschreven
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img_dir` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumpen data van tabel includefood.users: ~14 rows (ongeveer)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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
	(13, 'newT', 'est', 'newTest', 'newTest@hotmail.com', '$2y$12$lQamSQx7r6YbRvYUxS1hHu8QB75ZB7/BoXm6jC6N9pJHvqZvMJqe2', '', ''),
	(14, 'Ruben', 'Pieters', 'Ruben', 'pietersruben@hotmail.com', '$2y$10$aw8OWiPi1crtYgx0qO5C7eVPZGNErCzaE56B0fQ.ph7WSBO8w271m', 'images/profilePics/FeelsGood.png', 'Ruben Pieters');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
