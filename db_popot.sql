-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 19 jan. 2018 à 14:41
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_popot`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `libelle`, `description`) VALUES
(1, 'CÃ©rÃ©ales', 'graines'),
(2, 'Liquides', 'lait'),
(3, 'LÃ©gumes', 'Frais'),
(4, 'Tubercules', 'locaux uniquement');

-- --------------------------------------------------------

--
-- Structure de la table `condiments`
--

CREATE TABLE `condiments` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `stockmax` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_categories` int(11) NOT NULL,
  `id_unites` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `condiments`
--

INSERT INTO `condiments` (`id`, `designation`, `stockmax`, `stock`, `image`, `id_categories`, `id_unites`) VALUES
(1, 'Manioc', 50, 22, 'meter.jpg', 4, 2),
(2, 'Lait', 5, 3, 'cis.png', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE `unites` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `abreviation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `unites`
--

INSERT INTO `unites` (`id`, `libelle`, `abreviation`) VALUES
(1, 'Litres', 'L'),
(2, 'Kilogramme', 'Kg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `condiments`
--
ALTER TABLE `condiments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Condiments_1` (`id_categories`),
  ADD KEY `FK_Condiments_2` (`id_unites`);

--
-- Index pour la table `unites`
--
ALTER TABLE `unites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `condiments`
--
ALTER TABLE `condiments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `unites`
--
ALTER TABLE `unites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `condiments`
--
ALTER TABLE `condiments`
  ADD CONSTRAINT `FK_Condiments_1` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_Condiments_2` FOREIGN KEY (`id_unites`) REFERENCES `unites` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
