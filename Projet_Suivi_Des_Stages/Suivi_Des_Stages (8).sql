-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 04 juin 2024 à 10:49
-- Version du serveur : 10.5.21-MariaDB-0+deb11u1
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
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `service` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des services des entreprises';

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id`, `service`, `description`) VALUES
(1, 'Développement web', ''),
(2, 'Développement d applications', ''),
(3, 'Informatique', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `anneeScolaire`
--

DROP TABLE IF EXISTS `anneeScolaire`;
CREATE TABLE IF NOT EXISTS `anneeScolaire` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `annee` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des années d''étude';

--
-- Déchargement des données de la table `anneeScolaire`
--

INSERT INTO `anneeScolaire` (`id`, `annee`) VALUES
(5, '2023-2024');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tables des classes';

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `classe`, `description`) VALUES
(6, '1 DNMADE', NULL),
(7, '2 DNMADE', NULL),
(8, '1 TS ASS', NULL),
(9, '2 TS ASS', NULL),
(10, '1 TS CG', NULL),
(11, '2 TS CG', NULL),
(12, '1 TS CI', NULL),
(13, '2 TS CI', NULL),
(14, '1 TS COM', NULL),
(15, '2 TS COM', NULL),
(16, '1 TS GPME', NULL),
(17, '2 TS GPME', NULL),
(18, '1 TS MCO', NULL),
(19, '2 TS MCO', NULL),
(20, '1 TS NDRC', NULL),
(21, '2 TS NDRC', NULL),
(22, '1 TS SIO', NULL),
(23, '2 TS SIO', NULL),
(33, 'lib_court_classe', NULL),
(34, 'DNMADE', NULL),
(35, 'blabla', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `ville` varchar(32) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `telephone` varchar(256) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `service` smallint(6) NOT NULL,
  `siteWeb` varchar(64) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Service` (`service`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des entreprises';

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `adresse`, `ville`, `codePostal`, `telephone`, `mail`, `service`, `siteWeb`, `description`) VALUES
(23, 'VNwKqkmBtIwqeOGyAMdze/iFfukE/eGR2pQ2JMddnOM=', '1 rue Horizon Vert', 'Chambray-lès-Tours', '37176', 'rsd/75HEN+ju6Z0/bWtWpaxdpCTAGVRsTsReX6HcwK0=', 'lAoVD/4oq3kq5ir/XAr1oDH9kk5C9p1BrAXmK24JMFSU/EM7RMriMxtMKeeHhysr', 3, 'www.sfda37.fr', NULL),
(33, 'bHdf7Obv9Yp581pzDW+ZA/LFPR8taeIyylUr226xN/A=', '5 Rue Jules Favre', 'Tours', '37000', 'MN748B4Tqc/OJFf3E320whC5zHtn/SRZ9HGz81cU2ck=', 'RHtiGU3hr6FXT/yBcoR4t9kyc9vBSS248bU00EI20DQ9YX02HeXT/p6gXRb3v+1X', 1, 'creatisweb.net', NULL),
(34, 'FFlT0yflpOiAp12AlRttZ5PGPlfEQWac6FdJidyymaA=', '27 Rue Giraudeau', 'Tours', '37000', 'KZQ/0+G4HZASfqaoGoXpNfehxBJiHgfWvF1bG53cQMc=', 'XxZ+47TeY5DB6srEU3rH4vEuSwY3ByvX+sZdLQhmqweDjUzIQLTsmTn+c7GMXVTW', 1, 'webuz.fr', NULL),
(35, '/y94Au6nUyjnA6eli0ne19UAOsKPyvy2plLRHBv7N9Q=', '4 Rue Gambetta', 'Tours', '37000', 'yRlLQa9VUM8sHCZNV5rcP2nohKwbGBqroWDQeU/F3gE=', 'IxXr1GjyY+n1PexXybbNvhE7qrdHhVDBJ6cG44jUYGdsDihwpSTr9JG+76GVfWeW', 1, 'antadis.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `etudiant` int(11) NOT NULL,
  `classe` smallint(6) NOT NULL,
  `anneeScolaire` smallint(6) NOT NULL,
  PRIMARY KEY (`etudiant`,`classe`,`anneeScolaire`),
  KEY `anneeScolaire` (`anneeScolaire`),
  KEY `classe` (`classe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(128) NOT NULL,
  `mdp` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifiant` (`identifiant`),
  KEY `mdp` (`mdp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de connexion';

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `identifiant`, `mdp`) VALUES
(5095, 'toto@toto.com', 'toto'),
(5155, 'isLtQr/sKso0JEwkf52+/9h8kvmAfTDKMQDoSpgKVZbO8TkyO7ltFXDhXyi44ox3', '1LMP250TBu9FHZy15tknQ8IlkZTDRKcZon5oaVtWpC8=');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `role` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table des rôles';

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'étudiant'),
(2, 'professeur '),
(3, 'admin'),
(4, 'superAdmin');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des stages';

-- --------------------------------------------------------

--
-- Structure de la table `tuteurs`
--

DROP TABLE IF EXISTS `tuteurs`;
CREATE TABLE IF NOT EXISTS `tuteurs` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `civilite` varchar(256) NOT NULL,
  `fonction` varchar(64) NOT NULL,
  `telephone` varchar(256) NOT NULL,
  `mail` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `dateNaissance` varchar(256) NOT NULL,
  `idUnique` varchar(256) DEFAULT NULL,
  `classe` smallint(6) DEFAULT NULL,
  `anneeScolaire` smallint(6) DEFAULT NULL,
  `role` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classe` (`classe`),
  KEY `annee` (`anneeScolaire`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=5158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des étudiants';

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `dateNaissance`, `idUnique`, `classe`, `anneeScolaire`, `role`) VALUES
(5095, 'totos', 'toto', '22/09/2002', NULL, NULL, NULL, 3),
(5131, 'n9bdtnNJiiGS1dtfknlXAtGdFN9b/2JCugHi71GarBw=', 'JS60LhDoYdLPWWSJbUAKVE+Gto8sfrdhJH2+C7TWP3A=', 'Lolv35OrsO0eUr+SnAP2/Fugc9cv3w92Qx4pEvOe2oo=', NULL, 6, 5, 1),
(5132, 'OCk5dFhXt3SiHQnPY9ERAUbpZjijvyxsoNXXeM2qQzs=', 'GdLofDEyoyJavEDJfr2iBryQFtIfKv0BlcPTGobK1c4=', '10Hl3N5dMrJeKTN9aKlO6cdwnXDXla3Axcl4DxGt5Pk=', NULL, 8, 5, 1),
(5133, 'yTlcct6xFZIM3kBAuFCHyMok7i/emiBVP6Vj+AdD6PE=', 'hrUJ2/cM01vGsL5eryrIlOufyv0efBfLf1HM1muXeN4=', 'hBceUlvYNY7xDOUzE7Jm04+iJz1jlsk3qajXBtzP2A8=', NULL, 10, 5, 1),
(5134, 'bUXVW6VJHmbbFI7HqZdxzmfIg8dBYZzbYPCaPVDBH7g=', 'KGZWD0gv7+lNNLovZLw4qWH7vT4LxAHOB+RPg0vjmv4=', 'YcGutSefWf0AdTYA0NZ/TVoOd1LZTJaVEotLy7ajJJc=', NULL, NULL, 5, 1),
(5135, 'o1U/YGee+GxpnOmhfiWC2Zpij40vvCSFVJPbKiPEhXk=', 'gKKDu1faa6eI22pXwQShmFRCYNn5K7xJu0S+N9u9RBk=', 'HANxcOsWnffaRWxNnFjY4QSLXqIH1iJgY17leace7G8=', NULL, 14, 5, 1),
(5137, 'YhxoUTPmYeCme4OzVE82KqBhPXq3OI75kiTTn2aWD6g=', 'IXAhZ02cZwt5mxJnOEpBiF7Am3TzHi9VxMb/QjlgI4k=', 'k/vH8ePZ8gG07wNCkq7ZQTOCN2NrYMu+P9LzwZNnw7M=', NULL, 19, 5, 1),
(5138, 'JFzpdC2D9iXgGpKm+Gmt4DJpAdftPGhmD/mYvPh4zSg=', '7AR4VJc7A2hxSEYwL4aBR/AbBEKok+6eVFXBSh4bxUo=', 'BqdnTzcqgDoUVlpMrUriqft2E04JbtOH8V6/zrwvYKI=', NULL, 20, 5, 1),
(5140, 'FM8WFNnYQiG+sRQP28T56jr0Ilvn0pw/JlZWd5lRcjw=', 'J5377U0FxOlxNsplzN+NSzmel7/wvwqXum0Hrb7UtFM=', 'kuZ50/+QylzCGlNeyUHgx2kW1/vsbijE2nTtncJ5z9g=', NULL, 7, 5, 1),
(5144, 'YA7SHdCQ/Q/iYrBVpTdlAL2eyMxsHOt1Zr5StwL5ilQ=', 'kdS2gYc1Uuwz+n8btQUmM4dRfPidKxI4+caOXuH0OAY=', 'cFkyuHRdfLFfCD2+j+dnqdr6c543gITN5wmOEpVjJiQ=', NULL, 15, 5, 1),
(5145, '2CTZazWomfXM6+BsHWi6WvbmjBR13TEHvwgdi0GokbU=', 'XU4P6OAubAT5GjzrTsX00+3rEgh7QdlTsgkoo1DmEiU=', 'xhj0O9J6y/B6dtTeErPMObQFz9vypz8Ecbd/5Kx1k+s=', NULL, 16, 5, 1),
(5146, 'lo+ck7BI/Vt7bGkXz+MCNACEtnVQ4RqYTKLgp5OW6ms=', 'yEHX8fF5y463fiPSuajMMyw15HbxdY22E0Tosec+xAQ=', 'FqtppwKW0NZkCb5lpi+GAx0UoFNcFWg4jaVh0RPKojw=', NULL, 19, 5, 1),
(5147, 'zXpx9VehKtiIRPko5SMlFtL+f/IPZy4pGHt+ksCzgSo=', 'CoJpq0f/b89XM4OM6iuV7zFfdz4/8sPzN8HZTqarEvI=', 'h2+foniEURY4Ocnrenrv0aqEuQw/qkUexVAlgbeWnwI=', NULL, 21, 5, 1),
(5149, '8/czCX4il+AQ6FuxVcfT+niPWwuaCxL+zB8OPA1a8BU=', '3R2G0UAy4aovcLEqvy2x9UHeQAzneXPfr6Am054Q2Js=', 'VMlRg2hEnZyrUe+MiwQVIf9DZUP4BEqYyTtwyiZ5PVQ=', NULL, 12, 5, 1),
(5150, '0S/NaFC9OHEQORGQvGWkVazY6frvoh81y1Rqgbanc8s=', 'lJ9fXUiKC7kP1k+pi+nQIwMLd/YJDpD28HWEhrZZ1mw=', 'nfKEX9LB1cSbLYEt6a4iPkeFn2mDABExKZbPxr9gpew=', NULL, 16, 5, 1),
(5151, 'DQ1zzLoRnR8pKaI/9y/vOUSJmwj8X46BtZU2wSkZ61U=', 'EMSBqDM3UaJa1jPcWoTwb7sJ00RfCrcF6PfVAmCJbyg=', 'W9uf1Mm3fEBsi1R61GFdNL4Z7X4E+oK2maq5UXL5ohg=', NULL, 18, 5, 1),
(5152, 'tBWOntkzzrQCodP4hS2wOYsL9MLUMlH9cWg1YY7iTaI=', 'qqgWu7Gp6OTdO02A0b8ZvAwCfh8/RRVeOafFuboEmdU=', '2IPoiwYjXJdM2Kbc9KuvZG4bPyE9/xgkMve4MsZ/iTk=', NULL, 9, 5, 1),
(5153, 'XCdpjzXXVoTAty96a+YlfN0qaTuEjkl+/xVER1LuHuI=', 'LnhcFm+4OJzJ5E/RODc2znzQxBi2LuvXpDtaZUEnptA=', 'iAWPrgvjCRCbW3auylsU5t7NR6s/yRgIyAasUHmWfMY=', NULL, 11, 5, 1),
(5154, 'MDjLx4aCY126rHsdDBL47lzXghf6/juUmXbdf16Himg=', 'TJF1rIot84xJSZVLrP7+7uZ6tg7fc43NFJVvbtbi/PM=', 'hpxAsgMbkRKxLYAgJbFILlzL03m9pDChXQuwF4msxBM=', NULL, 13, 5, 1),
(5155, 'DOR6kGkTRgWcDe3Ly/Orkaow795c0qYDGwTO8RmomWA=', 'yx2Q0MxRgiqmoxNRxDQWg0D1pyy5clpUacY3SN0Pg54=', 'yHYQ1BPurpDn2GN7GSxoJX9G/dCUar0NWRrU8PL5ZSo=', NULL, 23, 5, 1),
(5156, 'oLCj7SiHGeYEdp3dbJngTDa3QbsxorwjwNbbAKpQX4I=', 'ZT0f3by4avkJnZg+AQgXK1XPdt8SyFCX8+F8OsBgZ60=', 'q1Sif1iMo2dZoGHXY9NP6HZHhKnNext0z5so7kc/p8E=', NULL, 22, 5, 1),
(5157, '9H8hb2BgD4mTZ0qC5E15/ZZXcz3Ygm1N8j+VCUn+cLY=', 'lKEbC1c2BpagACg9+1F0N25SiUu2weWX9dNJrrlGNg0=', 'GP8hQVbFkdETj4YwTdDHD25yXD8FLRo5f8MNxWi5kBA=', NULL, 17, 5, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_ibfk_1` FOREIGN KEY (`service`) REFERENCES `activite` (`id`);

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_ibfk_1` FOREIGN KEY (`etudiant`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `stages_ibfk_2` FOREIGN KEY (`entreprise`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `stages_ibfk_3` FOREIGN KEY (`tuteur`) REFERENCES `tuteurs` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `lien_classe` FOREIGN KEY (`classe`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`anneeScolaire`) REFERENCES `anneeScolaire` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
