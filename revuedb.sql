-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 14 fév. 2018 à 14:28
-- Version du serveur :  5.6.34-log
-- Version de PHP :  7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `revuedb`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chronics`
--

CREATE TABLE `chronics` (
  `chronicId` int(11) NOT NULL,
  `chronicTitle` varchar(100) NOT NULL,
  `chronicSlug` varchar(100) NOT NULL,
  `chronicContent` text NOT NULL,
  `chronicDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chronicWriter` int(11) NOT NULL,
  `chronicCountry` int(11) NOT NULL,
  `chronicCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `countryId` int(11) NOT NULL,
  `countryName` varchar(100) NOT NULL,
  `countryFlag` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `postTitle` varchar(255) NOT NULL,
  `postSlug` varchar(255) NOT NULL,
  `postContent` text NOT NULL,
  `postSource` text NOT NULL,
  `postPublishingDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postCreatingDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postUpdatingDate` datetime DEFAULT NULL,
  `postCategory` int(11) NOT NULL,
  `postCountry` int(11) NOT NULL,
  `postWriter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `writers`
--

CREATE TABLE `writers` (
  `writerId` int(11) NOT NULL,
  `writerFisrtName` varchar(100) NOT NULL,
  `writerLastName` varchar(100) NOT NULL,
  `writerLogin` varchar(100) NOT NULL,
  `writerEmail` varchar(100) NOT NULL,
  `writerPassword` varchar(20) NOT NULL,
  `writerAvatar` varchar(100) NOT NULL,
  `writerRegisterDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `writerCountry` int(11) NOT NULL,
  `writerCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Index pour la table `chronics`
--
ALTER TABLE `chronics`
  ADD PRIMARY KEY (`chronicId`),
  ADD KEY `chronicCountry` (`chronicCountry`),
  ADD KEY `chronicCategory` (`chronicCategory`),
  ADD KEY `chronicWriter` (`chronicWriter`);

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryId`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `postCategory` (`postCategory`),
  ADD KEY `postCountry` (`postCountry`),
  ADD KEY `postWriter` (`postWriter`);

--
-- Index pour la table `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`writerId`),
  ADD KEY `writerCountry` (`writerCountry`),
  ADD KEY `writerCategory` (`writerCategory`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `chronics`
--
ALTER TABLE `chronics`
  MODIFY `chronicId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `countries`
--
ALTER TABLE `countries`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `writers`
--
ALTER TABLE `writers`
  MODIFY `writerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chronics`
--
ALTER TABLE `chronics`
  ADD CONSTRAINT `chronics_ibfk_1` FOREIGN KEY (`chronicCountry`) REFERENCES `countries` (`countryId`),
  ADD CONSTRAINT `chronics_ibfk_2` FOREIGN KEY (`chronicCategory`) REFERENCES `categories` (`categoryId`),
  ADD CONSTRAINT `chronics_ibfk_3` FOREIGN KEY (`chronicWriter`) REFERENCES `writers` (`writerId`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`postCountry`) REFERENCES `countries` (`countryId`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`postWriter`) REFERENCES `writers` (`writerId`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`postCategory`) REFERENCES `categories` (`categoryId`);

--
-- Contraintes pour la table `writers`
--
ALTER TABLE `writers`
  ADD CONSTRAINT `writers_ibfk_1` FOREIGN KEY (`writerCountry`) REFERENCES `countries` (`countryId`),
  ADD CONSTRAINT `writers_ibfk_2` FOREIGN KEY (`writerCategory`) REFERENCES `categories` (`categoryId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
