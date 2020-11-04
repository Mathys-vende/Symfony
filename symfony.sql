-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 04 nov. 2020 à 11:52
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `montant`
--

DROP TABLE IF EXISTS `montant`;
CREATE TABLE IF NOT EXISTS `montant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Montant` float NOT NULL,
  `Part` int(11) NOT NULL,
  `idSoiree` int(11) NOT NULL,
  `idPersonne` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idSoiree` (`idSoiree`),
  UNIQUE KEY `idPersonne` (`idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) DEFAULT NULL,
  `Prenom` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `soiree`
--

DROP TABLE IF EXISTS `soiree`;
CREATE TABLE IF NOT EXISTS `soiree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `Personne` FOREIGN KEY (`id`) REFERENCES `montant` (`idPersonne`);

--
-- Contraintes pour la table `soiree`
--
ALTER TABLE `soiree`
  ADD CONSTRAINT `Soiree` FOREIGN KEY (`id`) REFERENCES `montant` (`idSoiree`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
