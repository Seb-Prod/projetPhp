-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 11 fév. 2025 à 14:18
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
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `date_commentaire` date NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `couleurs`
--

CREATE TABLE `couleurs` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `couleurs`
--

INSERT INTO `couleurs` (`ID`, `nom`) VALUES
(6, 'Rouge'),
(7, 'Vert'),
(8, 'Blanc'),
(9, 'Noir');

-- --------------------------------------------------------

--
-- Structure de la table `jantes`
--

CREATE TABLE `jantes` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jantes`
--

INSERT INTO `jantes` (`ID`, `nom`) VALUES
(4, '16 pouces'),
(5, '18 pouces'),
(6, '19 pouces');

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`ID`, `nom`) VALUES
(5, 'Nissan'),
(6, 'Fiat');

-- --------------------------------------------------------

--
-- Structure de la table `moteurs`
--

CREATE TABLE `moteurs` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `moteurs`
--

INSERT INTO `moteurs` (`ID`, `nom`) VALUES
(7, 'Essence'),
(8, 'Diesel'),
(9, 'Electrique');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`ID`, `nom`) VALUES
(19, 'SUV'),
(20, 'Breack'),
(21, 'Berline'),
(22, 'Roadster');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `nom`, `prenom`, `pseudo`, `password`, `admin`) VALUES
(25, 'Drillaud', 'Sébastien', 'root', '$2y$10$0XrkV9C/iqLC7xVg5jLlPOpcg9Z4DLm.ydJExui1riFLG56/YWjDu', 1),
(26, 'bob', 'bob', 'bob', '$2y$10$paLgfUP.jx7p7d3T1b8i7.TSdZrOQM6sDnGUie.OogT8PKY3q4Qr.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_marque` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `date_sortie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`ID`, `nom`, `id_type`, `id_marque`, `description`, `date_sortie`) VALUES
(61, 'Aryia', 19, 5, '', '2025-01-27'),
(62, '500', 21, 6, '', '2025-01-06');

-- --------------------------------------------------------

--
-- Structure de la table `voitures_couleurs`
--

CREATE TABLE `voitures_couleurs` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_couleur` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures_couleurs`
--

INSERT INTO `voitures_couleurs` (`id`, `id_voiture`, `id_couleur`, `prix`) VALUES
(3, 61, 6, 0),
(4, 61, 8, 1000),
(5, 61, 7, 500),
(6, 62, 6, 0),
(7, 62, 8, 0),
(8, 62, 7, 0);

-- --------------------------------------------------------

--
-- Structure de la table `voitures_jantes`
--

CREATE TABLE `voitures_jantes` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_jante` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures_jantes`
--

INSERT INTO `voitures_jantes` (`id`, `id_voiture`, `id_jante`, `prix`) VALUES
(2, 61, 6, 500),
(3, 61, 5, 0),
(4, 62, 4, 200),
(5, 62, 5, 500);

-- --------------------------------------------------------

--
-- Structure de la table `voitures_moteurs`
--

CREATE TABLE `voitures_moteurs` (
  `ID` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_moteur` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures_moteurs`
--

INSERT INTO `voitures_moteurs` (`ID`, `id_voiture`, `id_moteur`, `prix`) VALUES
(12, 61, 9, 45000),
(13, 62, 7, 35000),
(14, 62, 9, 45000);

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
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `couleurs`
--
ALTER TABLE `couleurs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `jantes`
--
ALTER TABLE `jantes`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `moteurs`
--
ALTER TABLE `moteurs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_marque` (`id_marque`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `voitures_couleurs`
--
ALTER TABLE `voitures_couleurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_couleur` (`id_couleur`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `voitures_jantes`
--
ALTER TABLE `voitures_jantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jante` (`id_jante`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `voitures_moteurs`
--
ALTER TABLE `voitures_moteurs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_moteur` (`id_moteur`),
  ADD KEY `id_voiture` (`id_voiture`);

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
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `couleurs`
--
ALTER TABLE `couleurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `jantes`
--
ALTER TABLE `jantes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `moteurs`
--
ALTER TABLE `moteurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `voitures_couleurs`
--
ALTER TABLE `voitures_couleurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `voitures_jantes`
--
ALTER TABLE `voitures_jantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `voitures_moteurs`
--
ALTER TABLE `voitures_moteurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `voitures_photos`
--
ALTER TABLE `voitures_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`);

--
-- Contraintes pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD CONSTRAINT `voitures_ibfk_1` FOREIGN KEY (`id_marque`) REFERENCES `marques` (`ID`),
  ADD CONSTRAINT `voitures_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `types` (`ID`);

--
-- Contraintes pour la table `voitures_couleurs`
--
ALTER TABLE `voitures_couleurs`
  ADD CONSTRAINT `voitures_couleurs_ibfk_1` FOREIGN KEY (`id_couleur`) REFERENCES `couleurs` (`ID`),
  ADD CONSTRAINT `voitures_couleurs_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`);

--
-- Contraintes pour la table `voitures_jantes`
--
ALTER TABLE `voitures_jantes`
  ADD CONSTRAINT `voitures_jantes_ibfk_1` FOREIGN KEY (`id_jante`) REFERENCES `jantes` (`ID`),
  ADD CONSTRAINT `voitures_jantes_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`);

--
-- Contraintes pour la table `voitures_moteurs`
--
ALTER TABLE `voitures_moteurs`
  ADD CONSTRAINT `voitures_moteurs_ibfk_1` FOREIGN KEY (`id_moteur`) REFERENCES `moteurs` (`ID`),
  ADD CONSTRAINT `voitures_moteurs_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`);

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
