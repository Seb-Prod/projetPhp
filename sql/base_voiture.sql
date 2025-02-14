-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 14 fév. 2025 à 11:37
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
(7, 'Ferrari'),
(8, 'Porsche'),
(9, 'Fiat'),
(10, 'Ford'),
(11, 'Honda'),
(12, 'Hyundai'),
(13, 'Kia'),
(14, 'Mazda'),
(15, 'Nissan'),
(16, 'Opel'),
(17, 'Volvo'),
(18, 'Alfa Romeo'),
(19, 'Land Rover'),
(20, 'Mini'),
(21, 'Seat'),
(22, 'Skoda');

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
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`ID`, `nom`) VALUES
(4, 'image_67ac54d1e47ff0.10198538.jpg'),
(5, 'image_67ac54d1e4c520.69692613.jpg'),
(6, 'image_67ac55218e13b0.10178956.jpg'),
(7, 'image_67ac682020b793.76770636.png'),
(8, 'image_67ac68ff441dc9.36635181.png'),
(9, 'image_67af131591bab6.53820431.png'),
(10, 'image_67af17a7c3a500.84194415.jpg'),
(11, 'image_67af17a7c4d449.28265549.jpg'),
(12, 'image_67af1977b9cbf8.95239938.jpg'),
(13, 'image_67af1977bab676.42564296.jpg'),
(14, 'image_67af1a348d02a9.14898541.jpg');

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
(20, 'Break'),
(21, 'Berline'),
(22, 'Roadster'),
(23, 'Citadine');

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
(26, 'bob', 'bob', 'bob', '$2y$10$paLgfUP.jx7p7d3T1b8i7.TSdZrOQM6sDnGUie.OogT8PKY3q4Qr.', 0),
(28, 'drillaud', 'Sébastien', 'boby', '$2y$10$uV4LHJHcOui5kDMMitXwE.QQwkp3EeaCvcgXh1pExys8WNWo2lZ/O', 0);

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
(125, 'GT3RS', 22, 8, 'Les athlètes le savent : les meilleures performances exigent plus que des conditions idéales et de la chance. Il faut vouloir, à tout prix, devenir plus rapide et plus fort à chaque entraînement. Tout remettre en question, surtout soi-même. Et apprendre de chaque erreur. Dans cet esprit, Porsche continue de repousser les limites du possible et améliore encore ses performances sur circuit. Découvrez la nouvelle 911 GT3 RS, au meilleur de sa forme.', '2013-01-12'),
(126, 'Ariya', 19, 15, 'Ce véhicule représente la vision de Nissan pour l&#039;avenir de la mobilité électrique et se positionne comme concurrent direct de modèles comme le Tesla Model Y ou le Volkswagen ID.4.', '2021-04-15'),
(127, '500', 23, 9, 'Petite citadine de chez FIAT', '2025-02-01');

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
(18, 125, 5, 0),
(19, 126, 6, 2000),
(20, 126, 5, 1500),
(21, 127, 4, 0);

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
(73, 125, 7, 245000),
(74, 126, 9, 35000),
(75, 127, 7, 15000),
(76, 127, 9, 22000),
(77, 127, 8, 18000);

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
-- Déchargement des données de la table `voitures_photos`
--

INSERT INTO `voitures_photos` (`id`, `id_voiture`, `id_photo`) VALUES
(8, 125, 10),
(9, 125, 11),
(10, 126, 12),
(11, 126, 13),
(12, 127, 14);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `moteurs`
--
ALTER TABLE `moteurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT pour la table `voitures_couleurs`
--
ALTER TABLE `voitures_couleurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `voitures_jantes`
--
ALTER TABLE `voitures_jantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `voitures_moteurs`
--
ALTER TABLE `voitures_moteurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `voitures_photos`
--
ALTER TABLE `voitures_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `voitures_couleurs_ibfk_1` FOREIGN KEY (`id_couleur`) REFERENCES `couleurs` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `voitures_couleurs_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `voitures_jantes`
--
ALTER TABLE `voitures_jantes`
  ADD CONSTRAINT `voitures_jantes_ibfk_1` FOREIGN KEY (`id_jante`) REFERENCES `jantes` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `voitures_jantes_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `voitures_moteurs`
--
ALTER TABLE `voitures_moteurs`
  ADD CONSTRAINT `voitures_moteurs_ibfk_1` FOREIGN KEY (`id_moteur`) REFERENCES `moteurs` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `voitures_moteurs_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `voitures_photos`
--
ALTER TABLE `voitures_photos`
  ADD CONSTRAINT `voitures_photos_ibfk_1` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `voitures_photos_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
