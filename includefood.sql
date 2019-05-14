-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2019 at 10:00 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
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
(77, 40, 14, 'thats lit'),
(78, 45, 14, 'wow'),
(79, 46, 14, 'kewl'),
(80, 46, 14, 'hallo');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `follows` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id`, `follower`, `follows`, `type`, `date_created`) VALUES
(1, 1, 2, 1, '0000-00-00 00:00:00'),
(2, 3, 4, 1, '0000-00-00 00:00:00'),
(3, 3, 1, 1, '0000-00-00 00:00:00'),
(4, 12, 15, 0, '2019-05-11 22:54:56'),
(5, 12, 14, 0, '2019-05-12 16:01:35'),
(6, 12, 12, 0, '2019-05-11 23:08:50'),
(7, 18, 15, 0, '2019-05-11 23:46:22'),
(8, 18, 12, 0, '2019-05-11 23:46:18'),
(9, 12, 11, 0, '2019-05-12 15:37:58'),
(10, 12, 6, 1, '2019-05-12 15:58:32'),
(11, 14, 14, 1, '2019-05-14 20:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
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
(36, 14, 40, 1, '2019-05-14 21:10:46'),
(37, 14, 45, 1, '2019-05-14 21:57:31'),
(38, 14, 39, 0, '2019-05-14 21:58:05'),
(39, 14, 46, 1, '2019-05-14 23:36:25'),
(40, 14, 44, 1, '2019-05-14 22:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img_dir` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `post_description` text CHARACTER SET utf8mb4 NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img_dir`, `post_description`, `date_created`) VALUES
(39, 14, '14_1557856616.jpg', 'so #cool', '2019-05-14 19:56:56'),
(40, 14, '14_1557856712.jpg', '#space', '2019-05-14 19:58:32'),
(41, 14, '14_1557857272.jpg', '#cool', '2019-05-14 20:07:52'),
(42, 14, '14_1557857286.png', '#OMEGALUL', '2019-05-14 20:08:06'),
(44, 14, '14_1557857324.jpg', '#cool', '2019-05-14 20:08:44'),
(45, 14, '14_1557857361.jpg', '#space', '2019-05-14 20:09:21'),
(46, 14, '14_1557863871.jpg', '#cool', '2019-05-14 21:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `post_id`, `user_id`, `date_created`) VALUES
(1, 42, 14, '2019-05-14 23:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
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
(14, 'Ruben', 'Pieters', 'Ruben', 'pietersruben@hotmail.com', '$2y$10$aw8OWiPi1crtYgx0qO5C7eVPZGNErCzaE56B0fQ.ph7WSBO8w271m', '14_1557856658.jpg', 'RubaDubDub'),
(15, 'nieuw', 'ste', 'nieuwste', 'nieuwste@test.com', '$2y$10$Ip3jSXiNFD17qGBke0GRfufnbtof5V/bb/zkqtPyTKqRNhatI9OX6', '', ''),
(16, 'een', 'naam', 'enaam', 'eennaam@test.com', '$2y$10$TZXdwt6dFPh5U7i19MvaA.Xiwn7A/wdchUuN0KnHHdbQkDCvF9iiq', '', ''),
(17, 'piet', 'snot', 'piot', 'poit@test.com', '$2y$10$lQ3IFcANxmwhePg1Ph7S2ezkBeF6t9R0TZsux1CJOb2Sc8o802wse', '', ''),
(18, 'Don', 'Amigo', 'DAmigo', 'DAmigo@test.com', '$2y$10$yHn6O6p2suuwy13ocsdIqubnnDsBN68BOuJ/gFyrsakLP7O0mXps2', '18_1557613857.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`,`post_id`,`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
