-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 09 Septembre 2018 à 21:20
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `php_cs`
--

-- --------------------------------------------------------

--
-- Structure de la table `chefdeservice`
--

CREATE TABLE IF NOT EXISTS `chefdeservice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prime` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `chefdeservice`
--

INSERT INTO `chefdeservice` (`id`, `id_prime`, `id_users`) VALUES
(2, 250, 1);

-- --------------------------------------------------------

--
-- Structure de la table `permis`
--

CREATE TABLE IF NOT EXISTS `permis` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `tuto` varchar(50) NOT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `permis`
--

INSERT INTO `permis` (`users_id`, `tuto`) VALUES
(4, 'dsdsds');

-- --------------------------------------------------------

--
-- Structure de la table `prime`
--

CREATE TABLE IF NOT EXISTS `prime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` varchar(50) NOT NULL,
  `lot` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=250 ;

--
-- Contenu de la table `prime`
--

INSERT INTO `prime` (`id`, `users_id`, `lot`, `photo`) VALUES
(232, '4', '', 'n'),
(233, '0', '', 'bgbgrb'),
(242, '1', '', 'total'),
(245, '1', '', 'tuto'),
(246, '2', '', 'toyota'),
(247, '2', '', 'mazda'),
(248, '1', '', 'herijaona3@gmail.com'),
(249, '52', '', 'kaki@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `saisie`
--

CREATE TABLE IF NOT EXISTS `saisie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_prime` int(11) NOT NULL,
  `description` text NOT NULL,
  `temperature` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `saisie`
--

INSERT INTO `saisie` (`id`, `id_users`, `id_prime`, `description`, `temperature`) VALUES
(18, 52, 242, 'fdf', 4),
(19, 52, 242, 'asooc bonjour ', 25),
(20, 52, 248, 'kolotsaina', 78),
(21, 52, 248, 'kolotsaina', 78),
(22, 52, 248, 'kolotsaina', 78),
(23, 52, 248, 'kolotsaina', 78),
(24, 52, 248, 'kolotsaina', 78),
(25, 52, 248, 'kolotsaina', 78),
(26, 52, 248, 'kolotsaina', 78),
(27, 52, 248, 'kolotsaina', 78),
(28, 52, 248, 'kolotsaina', 78),
(29, 52, 248, 'kolotsaina', 78);

-- --------------------------------------------------------

--
-- Structure de la table `sendmail`
--

CREATE TABLE IF NOT EXISTS `sendmail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prime` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `sendmail`
--

INSERT INTO `sendmail` (`id`, `id_prime`, `email`, `users_id`) VALUES
(1, '245', 'herijaona3@gmail.com', 0),
(2, '245', 'herijaona3@gmail.com', 1),
(3, '242', 'herijaona3@gmail.com', 1),
(4, '242', 'herijaona3@gmail.com', 1),
(5, '242', 'herijaona3@gmail.com', 1),
(6, '242', 'herijaona3@gmail.com', 1),
(7, '242', 'herijaona3@gmail.com', 1),
(8, '242', 'herijaona3@gmail.com', 1),
(9, '242', 'herijaona3@gmail.com', 1),
(10, '242', 'herijaona3@gmail.com', 1),
(11, '249', 'kaki@gmail.com', 51);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `test` text NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_code` text NOT NULL,
  `access_level` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='admin and customer users' AUTO_INCREMENT=54 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `test`, `password`, `access_code`, `access_level`, `status`, `created`, `modified`) VALUES
(2, 'tonton', 'tonton', 'tonton@gmail.com', '45t', 'tulear', '', '$2y$10$vChVQ4SvEbMBeFYvQTeTM.RDvOMZWrc10FNxkrpgUwnz7WdoegNTC', '', 'admin', 4, '2018-08-23 16:20:17', '2018-09-05 18:10:35'),
(43, '', '', 'test@gmail.com', '', '', '', '', '', 'admin', 0, '0000-00-00 00:00:00', '2018-09-05 18:36:21'),
(53, 'herijaona', 'herijaona', 'herijaona3@gmail.com', '54', 'hj', '', '$2y$10$FVa9IoMVuDyphYsXPKKc3OWnl8tIc5a.MxnhPdPt/JmbRUX5bIt0G', '', 'admin', 1, '2018-09-09 03:24:26', '2018-09-08 19:24:26'),
(51, 'coco', 'coco', 'coco@gmail.com', '45', 'coco', '', '$2y$10$shcONqzzWJLgqndxIcbRyuYMe03Kfxv3c802AmrBX4AK66WbkMLvi', '', 'technicien', 1, '2018-09-06 03:32:43', '2018-09-05 19:34:00'),
(52, '', '', 'kaki@gmail.com', '', '', '', '$2y$10$L7fF.x1fnVzqHFXaLkQ0MuHOQTojUTlinhSiuzkoEcsJD4vTrdtZ6', '', 'chefdeservice', 1, '0000-00-00 00:00:00', '2018-09-05 19:39:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
