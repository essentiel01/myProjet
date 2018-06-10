-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 27 mai 2018 à 10:50
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
-- Structure de la table `audios`
--

CREATE TABLE `audios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carousel`
--

CREATE TABLE `carousel` (
  `slideId` int(11) NOT NULL,
  `slideName` varchar(100) NOT NULL,
  `slideLabel` varchar(100) NOT NULL,
  `slideDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `user_id` int(11) NOT NULL,
  `chronicCountry` int(11) NOT NULL,
  `chronicCategory` int(11) NOT NULL,
  `posted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `posted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chronics_comments`
--

CREATE TABLE `chronics_comments` (
  `commentId` int(11) NOT NULL,
  `commentContent` text NOT NULL,
  `commentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parentCommentId` int(11) NOT NULL,
  `chronicId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chronics_favorites`
--

CREATE TABLE `chronics_favorites` (
  `userId` int(11) NOT NULL,
  `chronicId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
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
-- Structure de la table `debats`
--

CREATE TABLE `debats` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `person_1` varchar(100) NOT NULL,
  `person_2` varchar(100) NOT NULL,
  `avatar_1` varchar(255) NOT NULL,
  `avatar_2` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_at` datetime DEFAULT NULL,
  `posted` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `decodage_actu`
--

CREATE TABLE `decodage_actu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postedAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `posted` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `how_it_work` text NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `postTitle` varchar(255) NOT NULL,
  `postSlug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `postContent` text NOT NULL,
  `postAudio` varchar(255) NOT NULL,
  `postSource` text NOT NULL,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postCreatingDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postUpdatingDate` datetime DEFAULT NULL,
  `postCategory` int(11) NOT NULL,
  `postCountry` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `posted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts_comments`
--

CREATE TABLE `posts_comments` (
  `commentId` int(11) NOT NULL,
  `commentContent` text NOT NULL,
  `commentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parentCommentId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts_favorites`
--

CREATE TABLE `posts_favorites` (
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts_images`
--

CREATE TABLE `posts_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions_answers`
--

CREATE TABLE `questions_answers` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer_1` text NOT NULL,
  `answer_2` text NOT NULL,
  `debat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userFirstName` varchar(100) NOT NULL,
  `userLastName` varchar(100) NOT NULL,
  `userLogin` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userAvatar` varchar(100) NOT NULL DEFAULT 'default.png',
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`slideId`);

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
  ADD KEY `chronicWriter` (`user_id`);

--
-- Index pour la table `chronics_comments`
--
ALTER TABLE `chronics_comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `chronicId` (`chronicId`);

--
-- Index pour la table `chronics_favorites`
--
ALTER TABLE `chronics_favorites`
  ADD KEY `userId` (`userId`),
  ADD KEY `chronicId` (`chronicId`);

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryId`);

--
-- Index pour la table `debats`
--
ALTER TABLE `debats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `decodage_actu`
--
ALTER TABLE `decodage_actu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`),
  ADD UNIQUE KEY `postSlug` (`postSlug`),
  ADD KEY `postCategory` (`postCategory`),
  ADD KEY `postCountry` (`postCountry`),
  ADD KEY `postWriter` (`user_id`);

--
-- Index pour la table `posts_comments`
--
ALTER TABLE `posts_comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `posts_favorites`
--
ALTER TABLE `posts_favorites`
  ADD KEY `userId` (`userId`),
  ADD KEY `postId` (`postId`);

--
-- Index pour la table `posts_images`
--
ALTER TABLE `posts_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Index pour la table `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debat_id` (`debat_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `slideId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `chronics`
--
ALTER TABLE `chronics`
  MODIFY `chronicId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `chronics_comments`
--
ALTER TABLE `chronics_comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `countries`
--
ALTER TABLE `countries`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `debats`
--
ALTER TABLE `debats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `decodage_actu`
--
ALTER TABLE `decodage_actu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `posts_comments`
--
ALTER TABLE `posts_comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `posts_images`
--
ALTER TABLE `posts_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `questions_answers`
--
ALTER TABLE `questions_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chronics`
--
ALTER TABLE `chronics`
  ADD CONSTRAINT `chronics_ibfk_1` FOREIGN KEY (`chronicCountry`) REFERENCES `countries` (`countryId`),
  ADD CONSTRAINT `chronics_ibfk_2` FOREIGN KEY (`chronicCategory`) REFERENCES `categories` (`categoryId`),
  ADD CONSTRAINT `chronics_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`);

--
-- Contraintes pour la table `chronics_comments`
--
ALTER TABLE `chronics_comments`
  ADD CONSTRAINT `chronics_comments_ibfk_1` FOREIGN KEY (`chronicId`) REFERENCES `chronics` (`chronicId`),
  ADD CONSTRAINT `chronics_comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Contraintes pour la table `chronics_favorites`
--
ALTER TABLE `chronics_favorites`
  ADD CONSTRAINT `chronics_favorites_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `chronics_favorites_ibfk_2` FOREIGN KEY (`chronicId`) REFERENCES `chronics` (`chronicId`);

--
-- Contraintes pour la table `debats`
--
ALTER TABLE `debats`
  ADD CONSTRAINT `debats_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`);

--
-- Contraintes pour la table `decodage_actu`
--
ALTER TABLE `decodage_actu`
  ADD CONSTRAINT `decodage_actu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`postCountry`) REFERENCES `countries` (`countryId`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`postCategory`) REFERENCES `categories` (`categoryId`),
  ADD CONSTRAINT `posts_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`);

--
-- Contraintes pour la table `posts_comments`
--
ALTER TABLE `posts_comments`
  ADD CONSTRAINT `posts_comments_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `posts` (`postId`),
  ADD CONSTRAINT `posts_comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Contraintes pour la table `posts_favorites`
--
ALTER TABLE `posts_favorites`
  ADD CONSTRAINT `posts_favorites_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `posts_favorites_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `posts` (`postId`);

--
-- Contraintes pour la table `posts_images`
--
ALTER TABLE `posts_images`
  ADD CONSTRAINT `posts_images_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `posts_images_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`postId`);

--
-- Contraintes pour la table `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD CONSTRAINT `questions_answers_ibfk_1` FOREIGN KEY (`debat_id`) REFERENCES `debats` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
