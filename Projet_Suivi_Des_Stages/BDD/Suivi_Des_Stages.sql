-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 01 juin 2023 à 10:35
-- Version du serveur : 10.5.19-MariaDB-0+deb11u2
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Suivi_Des_Stages`
--
CREATE DATABASE IF NOT EXISTS `Suivi_Des_Stages` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Suivi_Des_Stages`;

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des administrateurs';

-- --------------------------------------------------------

--
-- Structure de la table `annees`
--

DROP TABLE IF EXISTS `annees`;
CREATE TABLE IF NOT EXISTS `annees` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Annee` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des années d''étude';

--
-- Déchargement des données de la table `annees`
--

INSERT INTO `annees` (`id`, `Annee`) VALUES
(1, '1er année');

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `classe` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tables des classes';

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `classe`, `description`) VALUES
(1, 'BTS SIO', 'Développeurs / Bancheurs de câbles');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `numero` varchar(32) NOT NULL,
  `mail` varchar(32) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `ville` smallint(6) NOT NULL,
  `service` smallint(6) NOT NULL,
  `tuteur` smallint(6) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Ville` (`ville`),
  KEY `Service` (`service`),
  KEY `tuteur` (`tuteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des entreprises';

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `dateNaissance` date NOT NULL,
  `classe` smallint(6) NOT NULL,
  `option_` smallint(6) NOT NULL,
  `annee` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classe` (`classe`),
  KEY `annee` (`annee`),
  KEY `option_` (`option_`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des étudiants';

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(32) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifiant` (`identifiant`),
  KEY `mdp` (`mdp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de connexion';

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `option` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TAble des options des BTS';

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `option`, `description`) VALUES
(1, 'SLAM', 'Développeurs'),
(2, 'SISR', 'Brancheurs de câbles');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `service` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des services des entreprises';

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `service`, `description`) VALUES
(1, 'Développement web', ''),
(2, 'Développement d\'applications', '');

-- --------------------------------------------------------

--
-- Structure de la table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `etudiant` int(11) NOT NULL,
  `entreprise` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiant` (`etudiant`),
  KEY `entreprise` (`entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des stages';

-- --------------------------------------------------------

--
-- Structure de la table `tuteurs`
--

DROP TABLE IF EXISTS `tuteurs`;
CREATE TABLE IF NOT EXISTS `tuteurs` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mail` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des villes';

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `nom`, `codePostal`, `description`) VALUES
(1, 'Tours', '', ''),
(2, 'Paris', '', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD CONSTRAINT `administrateurs_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_ibfk_1` FOREIGN KEY (`service`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `entreprises_ibfk_2` FOREIGN KEY (`ville`) REFERENCES `villes` (`id`),
  ADD CONSTRAINT `entreprises_ibfk_3` FOREIGN KEY (`tuteur`) REFERENCES `tuteurs` (`id`);

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_ibfk_1` FOREIGN KEY (`option_`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `lien_annee` FOREIGN KEY (`annee`) REFERENCES `annees` (`id`),
  ADD CONSTRAINT `lien_classe` FOREIGN KEY (`classe`) REFERENCES `classes` (`id`);

--
-- Contraintes pour la table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_ibfk_1` FOREIGN KEY (`etudiant`) REFERENCES `etudiants` (`id`),
  ADD CONSTRAINT `stages_ibfk_2` FOREIGN KEY (`entreprise`) REFERENCES `entreprises` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;