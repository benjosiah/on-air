-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2020 at 03:13 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `on_air`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 14, 7, 'this is mad', '2020-01-26 17:23:50'),
(2, 14, 7, 'you are mad', '2020-01-26 17:25:02'),
(3, 14, 7, 'hi', '2020-01-26 17:26:05'),
(4, 14, 7, 'ðŸ˜ðŸ˜ðŸ˜ðŸ˜ðŸ˜ðŸ˜', '2020-01-26 17:36:11'),
(5, 14, 7, 'i am on my way', '2020-01-26 17:37:11'),
(6, 14, 7, 'nothing', '2020-01-26 17:37:38'),
(7, 14, 7, 'amen', '2020-01-26 17:37:57'),
(8, 14, 7, 'i can\'t', '2020-01-26 17:38:42'),
(9, 14, 7, 'i can\'t', '2020-01-26 17:38:58'),
(10, 14, 7, 'no more3', '2020-01-26 17:39:21'),
(11, 13, 8, 'no more o', '2020-01-26 18:42:00'),
(12, 13, 8, 'no way', '2020-01-26 18:57:21'),
(13, 6, 8, 'popstar\r\n', '2020-01-26 18:59:15'),
(14, 6, 8, 'are you ok\r\n', '2020-01-26 19:00:10'),
(15, 6, 8, 'mad o', '2020-01-26 19:00:27'),
(16, 6, 8, 'come on', '2020-01-26 19:05:46'),
(17, 7, 7, 'nice one', '2020-01-26 19:08:50'),
(18, 13, 8, 'nice one', '2020-01-26 19:18:16'),
(19, 7, 7, 'no more', '2020-01-26 19:21:59'),
(20, 7, 7, 'vtfgy', '2020-01-26 19:24:52'),
(21, 15, 7, 'on no no no', '2020-01-26 20:03:57'),
(22, 5, 7, 'i have\'nt seen anything like this before.\r\ni actually thoughtit was realðŸ¤£ðŸ¤£ðŸ¤£ðŸ¤£', '2020-01-28 06:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `Follower_id` int(4) NOT NULL,
  `following_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(43, 12, 8, '2020-01-28 06:32:35'),
(42, 4, 7, '2020-01-27 20:44:47'),
(41, 5, 7, '2020-01-27 20:44:38'),
(40, 9, 7, '2020-01-27 20:27:01'),
(39, 11, 7, '2020-01-27 17:43:59'),
(38, 12, 7, '2020-01-27 17:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `post` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post`, `created_at`) VALUES
(3, 8, ' 			  	jmhgfvdcdvghj	', '2020-01-24 18:13:56'),
(4, 8, 'i love the lord 			  		', '2020-01-24 18:16:33'),
(5, 8, ' 			jklkiuhjkm;l  		', '2020-01-24 18:22:28'),
(6, 8, ' popokhjhvhjjk			  		', '2020-01-24 22:24:56'),
(7, 8, ' 			  The value of an object can be measured in its monetary worth, full recovered worth or its importance, but in this case, we are not dealing with objects, but with humans. How can you as a human being analyse or determine your worth? Not everybody knows this. Some people think there worth is determine by the amount they have in their bank, some others rate themselves based on the connections they have and others, on physical and material features. Itâ€™s actually such a pity that people go about thinking they worth much when actually they worth little, and some others think they worth little not realising they worth more. The true value of a man can be measured base on two important factors, which are;\r\n\r\n		', '2020-01-25 05:26:57'),
(8, 8, '', '2020-01-25 05:39:17'),
(9, 8, ' 			  		i\'m good', '2020-01-25 05:40:34'),
(10, 8, ' 			  	kmjvgvhuj\r\n\r\n\r\n jk j jlkkk kimk\r\n\r\nkjklkm	', '2020-01-25 07:40:59'),
(11, 8, ' 			 	muytcyrcvio                            vctctyvhtuc               vtctcuyvhv	', '2020-01-25 07:58:49'),
(12, 8, ' gcvhjhvjj', '2020-01-25 08:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `created_at`, `id`) VALUES
(' ben', ' benny@yahoo.com', ' 1234', '2020-01-24 15:52:17', 10),
(' ben', 'ben@yahoo.com', ' 1234', '2020-01-24 15:50:06', 9),
(' benjosiah', 'popstar@gmail.com', ' 1234', '2020-01-22 21:38:49', 8),
(' popstar', 'benjosiah90@gmail.com', '1234', '2020-01-22 16:17:43', 7),
(' popstar', '', ' 1234', '2020-01-24 17:45:59', 12),
(' popstar', 'pophstar@gmail.com', ' 1234', '2020-01-24 17:47:17', 13),
(' popstar', '                 jjjj@tt.com', ' 1234', '2020-01-24 17:49:19', 14),
(' popstar', ' tjjjj@tt.com', '', '2020-01-24 17:49:45', 15);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
