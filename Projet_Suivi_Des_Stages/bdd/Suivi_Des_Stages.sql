-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 16 juin 2023 à 20:41
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des entreprises';

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `adresse`, `ville`, `codePostal`, `telephone`, `mail`, `service`, `siteWeb`, `description`) VALUES
(23, '9Fw9G3dvFA+s/XnBVVrst01nTvTGqIAkCYI/9Ggr/LU=', 'dfgfdfdf', 'dgdf', 'dff', 'DJ1/cj+fHIVdDzKY3MbtT6kFnpbN8Cd/Jf8IOpvkrwA=', 'TC9fFju3XrKwxoFXYke5j+oq70dvtDP1oddggAWmfb0=', 3, 'erergerg', NULL),
(24, 'pH1ewMi9MrQjtbu0CE38w2Y9d75S6UhfpObmkECGeu0=', 'dfgfdfdf', 'dgdf', 'dff', 'ULHuHbv2iFN727majEmjIdi8/++zh8pZALNx2ytv30A=', 'VFjJNx+C+Ya5KaT3HKS8rb5NmfRHdkf2fe3gxgSCRp0=', 3, 'erergerg', NULL),
(25, 'elGbcp1d4PgGzeqfq28IfUctKhhePBy5K2g4XbkWsfE=', '123 Rue Principale', 'Villeville', '12345', 'om1Ih/UGRWSh99Rq0Jtb0mARrZQAfvHAEuyb7zcO0ZI=', 'z1QN+eO+4Im6OjxbcSqPCvhzaxmHniyUm+MN2a0qpt65x3QG2/m5FszuBxZIXKy0', 2, 'www.abccorp.com', NULL),
(29, 'Sie843Cb6LUb2eAwgV1/bjX65kbgSR6o6U7/WWcJn0f737F8kWx5RRYwaTxy1kU4', '123 Avenue de l\\\'Innovation', 'Techville', '98765', 'qP9fZTYR7tFyVmalyKRJXCy+TuFwDByocpG1E33aN3Q=', 'RLUAuGivLxqFPyg/HG2Nvy1Sa7xJaDJdPhIjRByRQPAALR8RPaFRysJjxtpvvSR5', 2, 'www.technosoft.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `dateNaissance` varchar(256) NOT NULL,
  `classe` smallint(6) NOT NULL,
  `_option` smallint(6) NOT NULL,
  `annee` tinyint(4) NOT NULL,
  `telephone` varchar(256) NOT NULL,
  `mail` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classe` (`classe`),
  KEY `annee` (`annee`),
  KEY `_option` (`_option`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des étudiants';

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `prenom`, `dateNaissance`, `classe`, `_option`, `annee`, `telephone`, `mail`) VALUES
(60, 'Y+F79VFzRHuGLsouda5VZpbW19GEL8ne7dgs1sCSsNw=', 'QBUgr5+uohchCTyZ5dvnjeP2EC6+UD+Vf3aSwv9GFGc=', '2023-06-12', 1, 1, 1, '0751068721', 'algalmash@gmail.com'),
(61, 'BCo5JDAgRWOyDQBpalR3PoD/tkLj0jS7Tq22xlHp2eY=', 'GILRm66sfZl77XDn2Lx/wAmdvxOl+t5fQuu0yHvY22U=', '/GHaRmx8qlGbGvlQ5cz+71IFZIv6fX52JjKog7X/Z3A=', 2, 2, 2, 'YoS21lxozJD4sNqUVnt8y14PI2cyeO6gmUmOD5FWUsw=', 'MwHalfaShtF0PYxxcncyrIYiIO5Cyouoe2l5r2ZZq1M='),
(62, '6zTM6zB7shS32W1aEmwqN2NKzbEFdAb2Odd1nG9oxrk=', 'VjVDVlxTMAv+QdK8qU96KZq3HpbLJRUgcghtjnNEGdI=', 'pnFOC8PF3ZfIYULl4P0g/xsypS9A/ZvqMKcDjnknw5c=', 2, 2, 2, 'KHMruDTJjCBxHzgpwdG5K4Kt+QH9+d4AXuN0m30mHaE=', 'DPIVGXJ6V0oWmU3VkA/rag7SsNIm0dTvi8phwpb+uZ4cPQczy0cpvrFkvJOjTK+U'),
(63, 'ityeh033dLkDvizq0kdVa5uIW2WSHSbHWjL/B/qaoMw=', 'HlQQhdAV54wSil/07O5WVwrhku3xyowQUkw9x4D4uHE=', 'g7sPkKckkrWXgt+J4+gVbVHL10pR7j9v9VAoJ6SJuB0=', 2, 2, 2, 'BB7o2fJD6TNWLF9ndgeMzixZddezB+rMqok8+Ouh2cw=', 'rglyltyeItiRhLk5os2+GkfrgFnayew84Gl6TExQ/zDHF+zAhOspICQzjmV7nt7w');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TAble des options des BTS';

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `option`, `description`) VALUES
(1, 'SLAM', 'Développeurs'),
(2, 'SISR', 'Brancheurs de câbles'),
(7, 'blabla', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des stages';

--
-- Déchargement des données de la table `stages`
--

INSERT INTO `stages` (`id`, `etudiant`, `entreprise`, `tuteur`, `dateDebut`, `dateFin`) VALUES
(13, 60, 23, 2, '2023-06-06', '2023-06-30');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tuteurs`
--

INSERT INTO `tuteurs` (`id`, `nom`, `prenom`, `civilite`, `fonction`, `telephone`, `mail`) VALUES
(1, 'toto', 'toto', '', '', '1111111111', 'toto@gmail.com'),
(2, 'bidul', 'bidul', '', '', '1111111111', 'bidul@gmail.com'),
(3, 'blabla', 'blabla', '', '', '12121212', 'blabla@gmail.com'),
(4, 'jaja', 'jaja', '', '', 'dcerv', 'jaja@gmail.com'),
(5, 'cfzde', 'zezed', '', '', 'zecfze', 'ezdez@zed'),
(6, 'AL GALMASH', 'yahya', '', '', '0751068721', 'jaja@gmail.com'),
(7, 'test', 'test', 'monsieur', 'test', 'efhfeh', 'hhh@njj'),
(8, 'bgrgvf', 'evfvf', 'madame', 'efvfb', 'bvrf', 'vvf@vv'),
(9, 'dccsd', 'sccsd', 'monsieur', 'sdczsdc', 'cszde', 'csdez@sdcdsc'),
(10, 'ujgyuuy', 'g,u,', 'madame', 'jujrt', 'ryfujuyj', 'uyjy@uyuyj'),
(11, 'hhhh', 'g,u,', 'madame', 'jujrt', '1111111122', 'uyjy@uyuyj.dd'),
(12, 'cjnkfdvkjnfdv', 'fehvefn', 'madame', 'ecdfv', '7474747474', 'eferf@erfre.fze'),
(13, 'efcrf', 'ercrrc', 'monsieur', 'ecefcd', '0751068721', 'dreddre@dd.dd'),
(14, 'efcrf', 'ercrrc', 'monsieur', 'ecefcd', '0751068721', 'dreddre@dd.dd'),
(22, 'Dupont', 'Alice', 'madame', 'Responsable', '0123456789', 'alice.dupont@example.com'),
(23, 'Dupont', 'Alice', 'madame', 'Responsable', '0123456789', 'alice.dupont@example.com'),
(24, 'Dupont', 'Alice', 'madame', 'Responsable', '0123456789', 'alice.dupont@example.com'),
(25, 'Dupont', 'Alice', 'madame', 'Responsable', '0123456789', 'alice.dupont@example.com'),
(26, 'tartempion', 'maurice', 'madame', 'cascadeur', '0987654321', 'a@a.a'),
(27, 'AL GALMASH', 'yahya', 'monsieur', 'xwcsc', '0751068721', 'sdvvc@ccd.d'),
(28, 'AL GALMASH', 'yahya', 'monsieur', 'xwcsc', '0751068721', 'sdvvc@ccd.d'),
(29, 'AL GALMASH', 'yahya', 'monsieur', 'xwcsc', '0751068721', 'sdvvc@ccd.d'),
(30, 'sdfsdf', 'sdfdsf', 'monsieur', 'dsfdsfs', '0751068721', 'dd@dd.dd'),
(31, 'sdfsdf', 'sdfdsf', 'monsieur', 'dsfdsfs', '0751068721', 'dd@dd.dd');

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
  ADD CONSTRAINT `entreprises_ibfk_1` FOREIGN KEY (`service`) REFERENCES `activite` (`id`);

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
