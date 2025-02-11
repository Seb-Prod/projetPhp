-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 11 fév. 2025 à 14:10
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `base_voiture`
--

-- --------------------------------------------------------

--
-- Structure de la table `voitures_photos`
--

CREATE TABLE `voitures_photos` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `voitures_photos`
--
ALTER TABLE `voitures_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_photo` (`id_photo`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `voitures_photos`
--
ALTER TABLE `voitures_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `voitures_photos`
--
ALTER TABLE `voitures_photos`
  ADD CONSTRAINT `voitures_photos_ibfk_1` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`ID`),
  ADD CONSTRAINT `voitures_photos_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
