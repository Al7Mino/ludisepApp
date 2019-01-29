-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 01 Septembre 2018 à 18:28
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ludisep`
--

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `Isn_Id` int(11) NOT NULL,
  `Isn_Qst_Id` int(11) NOT NULL,
  `Isn_Per_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`Isn_Id`, `Isn_Qst_Id`, `Isn_Per_Id`) VALUES
(17, 4, 12);

-- --------------------------------------------------------

--
-- Structure de la table `liste_etat`
--

CREATE TABLE `liste_etat` (
  `Lse_Id` int(11) NOT NULL,
  `Lse_etat` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `liste_etat`
--

INSERT INTO `liste_etat` (`Lse_Id`, `Lse_etat`) VALUES
(1, 'À venir'),
(2, 'En cours'),
(3, 'Terminée');

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `Per_Id` int(11) NOT NULL,
  `Per_Utl_Id` int(11) NOT NULL,
  `Per_nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `Per_description` text COLLATE utf8_bin,
  `Per_imagePath` varchar(535) COLLATE utf8_bin DEFAULT NULL,
  `Per_fichePath` varchar(535) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Contenu de la table `personnage`
--

INSERT INTO `personnage` (`Per_Id`, `Per_Utl_Id`, `Per_nom`, `Per_description`, `Per_imagePath`, `Per_fichePath`) VALUES
(12, 1, 'Raven', 'Description du personnage', 'files/personnages/Raven/moine.jpg', 'files/personnages/Raven/Fiche Perso Raven (Alban Deniau).docx'),
(13, 2, 'JCVD', 'Description du personnage', NULL, NULL),
(14, 2, 'JCVD2', 'Description du personnage', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `quete`
--

CREATE TABLE `quete` (
  `Qst_Id` int(11) NOT NULL,
  `Qst_titre` varchar(255) COLLATE utf8_bin NOT NULL,
  `Qst_description` text COLLATE utf8_bin NOT NULL,
  `Qst_etat` int(11) NOT NULL,
  `Qst_auteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `quete`
--

INSERT INTO `quete` (`Qst_Id`, `Qst_titre`, `Qst_description`, `Qst_etat`, `Qst_auteur`) VALUES
(3, 'Repr&eacute;senter​ la guilde !', 'Une académie militaire vient d\'ouvrir à proximité d\'Isep Town. Cela fait suite à des demandes des habitants de la ville qui veulent une protection quand la guilde ne peut leur en fournir parce qu\'elle est en déplacement par exemple. La guilde de l\'Isep est invité à célébrer l\'inauguration du bâtiment. Elle a de fait besoin de quelques représentants. Franchement sur une mission si simple que pourrait-il arriver de mal ?', 2, 1),
(4, 'Éradication', 'Hummmm... Étrange mais cest un problème de type libraire... Quête donné par un archimage. Aucune spécification au niveau des classes. Origine du problème inconnu. Éradiquez la source du désastre crée. Récompense 1200 golds et éventuelle \"babiole\" magique.', 2, 3),
(6, 'La mort des retrouvailles', 'Par la présente je confie à l’ISEP la tache de constituer un groupe d’aventuriers compétents et diplomates en vue d’une collaboration avec nos services de police : Au cours de la nuit précédant l’écriture de ce texte mes services ont retrouvé le cadavre d’un de nos concitoyens. En raison de la nature particulière du crime, car a n’en pas douter nous avons affaire ici à un meurtre, je prévois qu’une compagnie plus polyvalente et plus robuste que d’accoutumée sera nécessaire à la résolution de cette affaire. J’espère que cette occasion, malheureusement sordide, permettra de resserrer encore d’avantage les liens qui unissent nos deux guildes.', 2, 1),
(7, 'Blablabla', 'Sed tamen haec cum ita tutius observentur, quidam vigore artuum inminuto rogati ad nuptias ubi aurum dextris manibus cavatis offertur, inpigre vel usque Spoletium pergunt. haec nobilium sunt instituta.<br />\n<br />\nPrimi igitur omnium statuuntur Epigonus et Eusebius ob nominum gentilitatem oppressi. praediximus enim Montium sub ipso vivendi termino his vocabulis appellatos fabricarum culpasse tribunos ut adminicula futurae molitioni pollicitos.', 3, 1),
(8, 'Ablablabla', 'Sed tamen haec cum ita tutius observentur, quidam vigore artuum inminuto rogati ad nuptias ubi aurum dextris manibus cavatis offertur, inpigre vel usque Spoletium pergunt. haec nobilium sunt instituta. <br />\nPrimi igitur omnium statuuntur Epigonus et Eusebius ob nominum gentilitatem oppressi. praediximus enim Montium sub ipso vivendi termino his vocabulis appellatos fabricarum culpasse tribunos ut adminicula futurae molitioni pollicitos.', 3, 1),
(9, 'La meilleure quête du monde !', 'Haec ubi latius fama vulgasset missaeque relationes adsiduae Gallum Caesarem permovissent, quoniam magister equitum longius ea tempestate distinebatur, iussus comes orientis Nebridius contractis undique militaribus copiis ad eximendam periculo civitatem amplam et oportunam studio properabat ingenti, quo cognito abscessere latrones nulla re amplius memorabili gesta, dispersique ut solent avia montium petiere celsorum!', 1, 1),
(11, 'Une autre nouvelle quête', 'Haec ubi latius fama vulgasset missaeque relationes adsiduae Gallum Caesarem permovissent, quoniam magister equitum longius ea tempestate distinebatur, iussus comes orientis Nebridius contractis undique militaribus copiis ad eximendam periculo civitatem amplam et oportunam studio properabat ingenti, quo cognito abscessere latrones nulla re amplius memorabili gesta, dispersique ut solent avia montium petiere celsorum', 3, 1),
(12, 'Coucou c\'est moi ahahahahahahahahahahahahahah', 'Haec ubi latius fama vulgasset missaeque relationes adsiduae Gallum Caesarem permovissent, quoniam magister equitum longius ea tempestate distinebatur, iussus comes orientis Nebridius contractis undique militaribus copiis ad eximendam periculo civitatem amplam et oportunam <br />\nc\'est studio properabat ingenti, quo cognito abscessere latrones nulla re amplius memorabili gesta, dispersique ut solent avia montium petiere celsorum', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `role_utilisateur`
--

CREATE TABLE `role_utilisateur` (
  `Rol_Id` int(11) NOT NULL,
  `Rol_role` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `role_utilisateur`
--

INSERT INTO `role_utilisateur` (`Rol_Id`, `Rol_role`) VALUES
(1, 'Joueur'),
(2, 'Maître de jeu'),
(3, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Utl_Id` int(11) NOT NULL,
  `Utl_login` varchar(255) COLLATE utf8_bin NOT NULL,
  `Utl_mdp` varchar(255) COLLATE utf8_bin NOT NULL,
  `Utl_nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `Utl_prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `Utl_mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `Utl_avatar` varchar(535) COLLATE utf8_bin DEFAULT NULL,
  `Utl_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Utl_Id`, `Utl_login`, `Utl_mdp`, `Utl_nom`, `Utl_prenom`, `Utl_mail`, `Utl_avatar`, `Utl_role`) VALUES
(1, 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'NOM', 'Prenom', 'test@test.com', 'files/users/07854d21a5245b6ad88ca196e5c06e6f.jpg', 3),
(2, 'joueur', '69781af08345a5073959189230512ce7aab7d5e163ed23cf233c0c12bd7f24be', 'Van Damme', 'J-C', 'jcvd@test.com', NULL, 1),
(3, 'mj', 'a3f9e2bcd804ec65d1ea4fc63a74e7f02a08e63ffd0b803a8f250236f5602405', 'Deus', 'Scénarium', 'deus@test.com', NULL, 2),
(4, 'al', '6351825030155836664876686dcff61b6a91254a0458537072a1b26ad151b5ce', 'Deniau', 'Alban', 'alban.deniau@isep.fr', NULL, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`Isn_Id`),
  ADD KEY `Fk_Isn_Qst_Id_Qst_Id` (`Isn_Qst_Id`),
  ADD KEY `fk_Isn_Per_Id_Per_Id` (`Isn_Per_Id`);

--
-- Index pour la table `liste_etat`
--
ALTER TABLE `liste_etat`
  ADD PRIMARY KEY (`Lse_Id`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`Per_Id`),
  ADD KEY `Fk_Per_Utl_Id_Utl_Id` (`Per_Utl_Id`);

--
-- Index pour la table `quete`
--
ALTER TABLE `quete`
  ADD PRIMARY KEY (`Qst_Id`),
  ADD KEY `Fk_Qst_etat_Lse_Id` (`Qst_etat`),
  ADD KEY `Fk_Qst_auteur_Utl_Id` (`Qst_auteur`);

--
-- Index pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  ADD PRIMARY KEY (`Rol_Id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Utl_Id`),
  ADD KEY `fk_Utl_role_Rol_Id` (`Utl_role`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `Isn_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `liste_etat`
--
ALTER TABLE `liste_etat`
  MODIFY `Lse_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `Per_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `quete`
--
ALTER TABLE `quete`
  MODIFY `Qst_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  MODIFY `Rol_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `Utl_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `Fk_Isn_Qst_Id_Qst_Id` FOREIGN KEY (`Isn_Qst_Id`) REFERENCES `quete` (`Qst_Id`),
  ADD CONSTRAINT `fk_Isn_Per_Id_Per_Id` FOREIGN KEY (`Isn_Per_Id`) REFERENCES `personnage` (`Per_Id`);

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `Fk_Per_Utl_Id_Utl_Id` FOREIGN KEY (`Per_Utl_Id`) REFERENCES `utilisateur` (`Utl_Id`);

--
-- Contraintes pour la table `quete`
--
ALTER TABLE `quete`
  ADD CONSTRAINT `Fk_Qst_auteur_Utl_Id` FOREIGN KEY (`Qst_auteur`) REFERENCES `utilisateur` (`Utl_Id`),
  ADD CONSTRAINT `Fk_Qst_etat_Lse_Id` FOREIGN KEY (`Qst_etat`) REFERENCES `liste_etat` (`Lse_Id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_Utl_role_Rol_Id` FOREIGN KEY (`Utl_role`) REFERENCES `role_utilisateur` (`Rol_Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
