-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 24 nov. 2020 à 13:33
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livreor`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(1, 'C\'est incroyable mec', 1, '2020-11-20'),
(2, 'Comment ça va', 2, '2020-11-20'),
(3, 'Vers l\'infini et au delas', 3, '2020-11-20'),
(4, 'y\'a que les con qui changent pas d\'avis\r\n', 5, '2020-11-20'),
(6, 'ça marcheeeeeeeeeeee', 5, '2020-11-20'),
(7, 'prout', 16, '2020-11-23'),
(8, 'qdqdzdqzdqzd', 1, '2020-11-23'),
(9, 'salut comment sa vaaaaaaaaaa\r\n', 1, '2020-11-23'),
(10, 'salut comment sa vaaaaaaaaaa\r\n', 1, '2020-11-23'),
(11, 'salut comment sa vaaaaaaaaaa\r\n', 1, '2020-11-23'),
(12, 'Wassup BRO', 18, '2020-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'yaya', 'yaya'),
(2, 'david', 'fincher'),
(3, 'mac', 'giver'),
(4, 'forest', 'whitaker'),
(5, 'cameron ', 'diaz'),
(6, 'lulu', 'lulu'),
(9, 'jeje', 'jeje'),
(10, 'QSFSfsqffFFGHHJHJJ', 'lamachine13300'),
(11, 'sdsfdsfdsf', 'cacaprout13'),
(13, 'tttt', 'tttt'),
(14, 'jaja', 'jaja'),
(15, 'admin', 'admin'),
(16, 'aicha', 'pumba'),
(17, 'vava', 'vava'),
(18, 'toto', 'toto');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
