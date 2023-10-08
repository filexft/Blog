-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 08, 2023 at 03:07 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `categories` int NOT NULL,
  `pseudo` int NOT NULL,
  `commentaire` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`pseudo`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `categories`, `pseudo`, `commentaire`) VALUES
(54, 'alex ', 'how to animate with alex', 0, 25, 0),
(48, 'Kat', 'kat article', 0, 24, 0),
(47, 'ft', 'alex and sami', 0, 10, 0),
(46, 'a', 'a', 0, 10, 0),
(45, 'a', 'a', 0, 10, 0),
(44, 't', 't', 0, 10, 0),
(43, 'first ', 'first article\r\n', 0, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `articles_category`
--

DROP TABLE IF EXISTS `articles_category`;
CREATE TABLE IF NOT EXISTS `articles_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles_category`
--

INSERT INTO `articles_category` (`id`, `article_id`, `category_id`) VALUES
(14, 47, 13),
(13, 46, 14),
(12, 46, 11),
(11, 45, 9),
(10, 44, 9),
(9, 43, 12),
(8, 43, 9),
(15, 47, 14),
(16, 48, 11),
(17, 48, 12),
(18, 49, 17),
(19, 50, 22),
(20, 51, 2),
(21, 51, 22),
(22, 54, 17),
(23, 54, 18);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `articles` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `articles`) VALUES
(22, 'test', 0),
(17, 'java', 0),
(18, 'C', 0);

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `article` int NOT NULL,
  `pseudo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id`, `description`, `article`, `pseudo`) VALUES
(7, 'speed', 43, 18),
(4, 'this post is good to for good read', 43, 18),
(5, 'test', 43, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `pseudo` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `mdp`, `pseudo`, `admin`) VALUES
(1, 'filex@gmail.com', 'ft10', 'ft', 1),
(2, 'test', 'mdp', '', 0),
(3, 'form@gmail.com', 'form', '', 0),
(4, '', '', '', 0),
(5, 'samiabbas@yabc.com', 'faefé\"', '', 0),
(6, 'test@sami.com', 'bigD', '', 0),
(7, 'sami@gmail.com', 'bigD', '', 0),
(8, 'gat@gmail.com', 'gatta', '', 0),
(9, 'abdu@gmail.com', 'abdu', '', 0),
(10, 'a@gmail.com', 'a', 'a', 0),
(11, 'b@gmail.com', 'b', '', 0),
(12, 'c@gmail.com', 'c', '', 0),
(13, 'd@gmail.com', 'd', '', 0),
(14, 'zzo@gail.com', 'huhuhuhuhuhuhuhuhuhuhuhuhuhuhuhu', '', 0),
(15, 'aziz@gmail.com', 'a', '', 0),
(16, 'f@gmail.com', 'f', '', 0),
(19, 'toto@yop.fr', 'fr', '', 0),
(18, 'admin@localhost.fr', 'admin69IUT', 'BOSS', 1),
(20, 'mm@gmail.com', 'mm', '', 0),
(21, 'p@gmail.com', 'a', '', 0),
(25, 'alex@gmail.com', 'alex', 'alex', 0),
(22, 's@gmail.com', 's', 'sam', 0),
(23, 'g@gmail.com', 'g', '', 0),
(24, 'k@gmail.com', 'k', 'kat', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
