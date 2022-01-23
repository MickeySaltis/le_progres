-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 23 jan. 2022 à 18:27
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `le_progres`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(250) CHARACTER SET latin1 NOT NULL,
  `username` varchar(250) CHARACTER SET latin1 NOT NULL,
  `password` varchar(250) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `username`, `password`) VALUES
(1, 'Journaliste', '1er', 'test', '$2y$10$KmVEzlO4OsUUnCAE.twZpeHaisem9ItxQH1Lmo8F9bx3N2ObGBQry'),
(2, 'Admin', '2', 'Second', '$2y$10$KmVEzlO4OsUUnCAE.twZpeHaisem9ItxQH1Lmo8F9bx3N2ObGBQry');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(250) CHARACTER SET latin1 NOT NULL,
  `type` varchar(250) CHARACTER SET latin1 NOT NULL,
  `contenu` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `type`, `contenu`, `image`, `id_admin`) VALUES
(1, 'Article 1', 'autres', 'Les logiciels et applications qui constituent notre environnement, que ce soit sur votre smartphone, votre ordinateur ou sous forme de pages internet sont créés à partir de langages informatiques dont la matrice est appelée code source.Bien entendu, les langages modernes sont efficaces et normés, et si l\'on peut écrire un programme de plusieurs façons pour aboutir au même résultat, jusqu\'à présent, il n\'était pas possible de le formuler avec fantaisie ou poésie (d\'un point de vue littéraire) dans le code source. Comme l\'on peut apprécier la pureté et la simplicité d\'une démonstration mathématique élégante, on peut apprecier l\'efficacité et la clarté d\'un programme à son code source...à condition de pouvoir le comprendre.Ainsi, le fameux ', '61ed79b8ec9f7.jpeg', 1),
(2, 'Article 2', 'sport', 'Résumé', '61ed79b2d85f9.jpeg', 1),
(3, 'Article 3', 'faits-divers', 'Résumé', '61ed79a5c4979.jpeg', 1),
(4, 'Article 4', 'politique', 'Résumé', 'https://upload.wikimedia.org/wikipedia/commons/9/9a/Gull_portrait_ca_usa.jpg', 2),
(7, 'ajout+', 'autres', 'ajout d\'une image', '61ed63c6883fe.jpeg', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
