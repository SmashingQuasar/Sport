-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 21 mars 2019 à 11:03
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sport`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

DROP TABLE IF EXISTS `adherents`;
CREATE TABLE IF NOT EXISTS `adherents` (
  `id_adherent` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(45) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `date_naissance` date NOT NULL,
  `genre` enum('M','F') NOT NULL,
  PRIMARY KEY (`id_adherent`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adherents`
--

INSERT INTO `adherents` (`id_adherent`, `prenom`, `nom`, `date_naissance`, `genre`) VALUES
(1, 'elie', 'bismuth', '1995-03-19', 'M'),
(2, 'bryan', 'ohayon', '1997-02-19', 'M'),
(3, 'alan', 'toledano', '2005-03-05', 'M'),
(4, 'yael', 'sebag', '2003-03-05', 'F'),
(5, 'joyce', 'elmaleh', '1920-01-14', 'F'),
(12, 'Jhon', 'Doe', '1990-02-19', 'M'),
(11, 'Harry', 'Said', '1996-02-28', 'M'),
(22, 'Rafael', 'Attias', '1960-02-18', 'M'),
(19, 'Jhon', 'Doe', '2002-03-28', 'M'),
(23, 'Jhon', 'Doe', '1965-02-28', 'M'),
(24, 'Rafael', 'Attias', '1970-03-04', 'F'),
(25, 'test', 'Test', '1996-03-28', 'M');

-- --------------------------------------------------------

--
-- Structure de la table `adherents_est_inscrit`
--

DROP TABLE IF EXISTS `adherents_est_inscrit`;
CREATE TABLE IF NOT EXISTS `adherents_est_inscrit` (
  `id_adherent` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `annee_de_licence` varchar(4) NOT NULL,
  PRIMARY KEY (`id_adherent`,`id_club`),
  KEY `id_club` (`id_club`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adherents_est_inscrit`
--

INSERT INTO `adherents_est_inscrit` (`id_adherent`, `id_club`, `date_inscription`, `annee_de_licence`) VALUES
(1, 1, '2019-03-06', '2019'),
(1, 2, '2019-03-11', '1996'),
(2, 3, '2019-01-21', '1997'),
(5, 5, '2018-08-22', '2010'),
(2, 5, '2019-01-21', '1997'),
(5, 1, '2018-08-22', '2010'),
(5, 4, '2019-03-05', '1994'),
(4, 3, '2019-03-05', '2017'),
(12, 5, '2019-03-10', '2015'),
(11, 2, '2019-03-10', '2015'),
(3, 4, '2019-03-12', '1998'),
(22, 5, '2019-03-14', '1995'),
(19, 3, '2019-03-13', '2014'),
(23, 3, '2019-03-18', '2000'),
(24, 2, '2019-03-18', '2000'),
(25, 4, '2019-03-21', '1996');

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

DROP TABLE IF EXISTS `clubs`;
CREATE TABLE IF NOT EXISTS `clubs` (
  `id_club` int(11) NOT NULL AUTO_INCREMENT,
  `nom_club` varchar(45) NOT NULL,
  `code_postal` varchar(45) NOT NULL,
  `ville` varchar(45) NOT NULL,
  PRIMARY KEY (`id_club`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id_club`, `nom_club`, `code_postal`, `ville`) VALUES
(1, 'Toutou', '94700', 'Maisons Alfort'),
(2, 'Les petits chamois', '45678', 'Brest'),
(3, 'Les skieurs du dimanche', '76588', 'Dijon'),
(4, 'ToutSchuss', '32000', 'Perpignan'),
(5, 'SkieursToutTerrain', '75000', 'Paris');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
