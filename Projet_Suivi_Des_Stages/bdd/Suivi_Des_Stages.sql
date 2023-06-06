-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 06 juin 2023 à 18:39
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des administrateurs';

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `prenom`) VALUES
(1, 'AL GALMASH', 'Yahya'),
(2, 'toto', 'toto');

-- --------------------------------------------------------

--
-- Structure de la table `annees`
--

DROP TABLE IF EXISTS `annees`;
CREATE TABLE IF NOT EXISTS `annees` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `annee` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des années d''étude';

--
-- Déchargement des données de la table `annees`
--

INSERT INTO `annees` (`id`, `annee`) VALUES
(1, '1er année'),
(2, 'Deuxième année');

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

DROP TABLE IF EXISTS `avoir`;
CREATE TABLE IF NOT EXISTS `avoir` (
  `classse` smallint(6) NOT NULL,
  `_option` smallint(6) NOT NULL,
  PRIMARY KEY (`classse`,`_option`),
  KEY `_option` (`_option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table associative entre classes et options';

--
-- Déchargement des données de la table `avoir`
--

INSERT INTO `avoir` (`classse`, `_option`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `classe` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tables des classes';

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `classe`, `description`) VALUES
(1, 'BTS SIO', 'Développeurs / Bancheurs de câbles'),
(2, 'blabla', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `ville` varchar(32) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mail` varchar(32) NOT NULL,
  `service` smallint(6) NOT NULL,
  `siteWeb` varchar(64) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Service` (`service`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des entreprises';

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `adresse`, `ville`, `codePostal`, `telephone`, `mail`, `service`, `siteWeb`, `description`) VALUES
(1, 'blabla', 'rerfreer', 'zeffe', '37000', '1111111111', 'toto@gmail.com', 1, 'RGRSTGSRTG', NULL),
(2, 'yahya ', 'rfrtftr', 'Tours', '37000', '0751068721', 'algalmash@gmail.com', 1, 'https://www.youtube.com', NULL),
(3, 'yahya ', 'rfrtftr', 'Tours', '37000', '0751068721', 'algalmash@gmail.com', 1, 'https://www.bidule.com', NULL),
(4, 'grtrtg', 'rtgrtgrt', 'rtbrtgrt', '37000', '4545454545', 'algalmash@gmail.com', 3, 'REGRTGRTG', NULL),
(5, 'THYTHJ', 'TSRHBDT', 'RTGBTYN', '37000', '4545454545', 'dggtrgrth@gmail.com', 3, 'yujuyujyjG', NULL),
(6, 'THYTHJ', 'TSRHBDT', 'RTGBTYN', '37000', '4545454545', 'dggtrgrth@gmail.com', 1, 'yujuyujyjG', NULL),
(7, 'rtgrtgrt', 'rgtrt', 'rtrgtgrt', '37000', '2323232323', 'algalmash@gmail.com', 2, 'ERRTGGTRGRT', NULL),
(8, 'rvrvrgvg', 'rvrbvrg', 'rtrtvvrvr', '37000', '0751068721', 'algalmash@gmail.com', 2, 'https://www.youtube.com', NULL),
(10, 'yahya AL_GALMASH', '2 Rue Du Docteur LECCIA', 'Tours', '37000', '0751068721', 'algalmash@gmail.com', 1, 'fvrggrfgvgfv', NULL);

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
  `_option` smallint(6) NOT NULL,
  `annee` tinyint(4) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `mail` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classe` (`classe`),
  KEY `annee` (`annee`),
  KEY `_option` (`_option`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des étudiants';

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `prenom`, `dateNaissance`, `classe`, `_option`, `annee`, `telephone`, `mail`) VALUES
(23, 'AL GALMASH', 'yahya', '2023-06-08', 1, 1, 2, '0751068721', 'algalmash@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de connexion';

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `identifiant`, `mdp`) VALUES
(1, 'yalgalmash', 'C1test'),
(2, 'toto', 'toto');

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `option` varchar(32) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TAble des options des BTS';

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `option`, `description`) VALUES
(1, 'SLAM', 'Développeurs'),
(2, 'SISR', 'Brancheurs de câbles'),
(3, 'blabla', NULL),
(4, 'blabla', NULL),
(5, 'blabla', NULL),
(6, '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `service` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des services des entreprises';

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `service`, `description`) VALUES
(1, 'Développement web', ''),
(2, 'Développement d applications', ''),
(3, 'Informatique', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `etudiant` int(11) NOT NULL,
  `entreprise` int(11) NOT NULL,
  `tuteur` smallint(6) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiant` (`etudiant`),
  KEY `entreprise` (`entreprise`),
  KEY `tuteur` (`tuteur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des stages';

--
-- Déchargement des données de la table `stages`
--

INSERT INTO `stages` (`id`, `etudiant`, `entreprise`, `tuteur`, `dateDebut`, `dateFin`) VALUES
(1, 23, 6, 1, '2023-06-06', '2023-06-30');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tuteurs`
--

INSERT INTO `tuteurs` (`id`, `nom`, `prenom`, `telephone`, `mail`) VALUES
(1, 'toto', 'toto', '1111111111', 'toto@gmail.com');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `avoir_ibfk_1` FOREIGN KEY (`classse`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `avoir_ibfk_2` FOREIGN KEY (`_option`) REFERENCES `options` (`id`);

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_ibfk_1` FOREIGN KEY (`service`) REFERENCES `services` (`id`);

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_ibfk_1` FOREIGN KEY (`_option`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `lien_annee` FOREIGN KEY (`annee`) REFERENCES `annees` (`id`),
  ADD CONSTRAINT `lien_classe` FOREIGN KEY (`classe`) REFERENCES `classes` (`id`);

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id`) REFERENCES `administrateurs` (`id`);

--
-- Contraintes pour la table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_ibfk_1` FOREIGN KEY (`etudiant`) REFERENCES `etudiants` (`id`),
  ADD CONSTRAINT `stages_ibfk_2` FOREIGN KEY (`entreprise`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `stages_ibfk_3` FOREIGN KEY (`tuteur`) REFERENCES `tuteurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
