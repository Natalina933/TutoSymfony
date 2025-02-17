-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 fév. 2025 à 18:41
-- Version du serveur : 8.3.0
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tutosymfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `duration` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`, `duration`) VALUES
(1, 'Spaghetti Bolognaise', 'spaghetti-bolognaise', 'Faites revenir l\'\'oignon et l\'\'ail dans l\'\'huile d\'\'olive. Ajoutez la viande hachée et faites-la brunir. Incorporez les tomates concassées, le concentré de tomate, les herbes et assaisonnez. Laissez mijoter 30 minutes. Servez sur des spaghettis al dente.', '2025-02-10 14:30:00', '2025-02-17 09:15:00', 45),
(2, 'Quiche Lorraine', 'quiche-lorraine', 'Étalez la pâte dans un moule. Mélangez les œufs, la crème, le lait, le sel et le poivre. Ajoutez les lardons préalablement dorés et le fromage râpé. Versez dans la pâte et cuisez 30-35 minutes à 180°C.', '2025-02-17 18:33:08', '2025-02-17 18:33:08', 50),
(3, 'Spaghetti Bolognaise', 'spaghetti-bolognaise', 'Faites revenir l\'\'oignon et l\'\'ail dans l\'\'huile d\'\'olive. Ajoutez la viande hachée et faites-la brunir. Incorporez les tomates concassées, le concentré de tomate, les herbes et assaisonnez. Laissez mijoter 30 minutes. Servez sur des spaghettis al dente.', '2025-02-10 14:30:00', '2025-02-17 09:15:00', 45),
(4, 'Quiche Lorraine', 'quiche-lorraine', 'Étalez la pâte dans un moule. Mélangez les œufs, la crème, le lait, le sel et le poivre. Ajoutez les lardons préalablement dorés et le fromage râpé. Versez dans la pâte et cuisez 30-35 minutes à 180°C.', '2025-02-17 18:33:08', '2025-02-17 18:33:08', 50),
(5, 'Salade César', 'salade-cesar', 'Grillez le poulet assaisonné. Préparez la sauce en mélangeant mayonnaise, ail, jus de citron, sauce Worcestershire et parmesan. Mélangez la laitue romaine avec la sauce, ajoutez le poulet, les croûtons et le parmesan.', '2025-02-17 18:40:32', '2025-02-17 18:40:32', 25),
(6, 'Ratatouille Provençale', 'ratatouille-provencale', 'Coupez les légumes en dés. Faites-les revenir séparément dans l\'\'huile d\'\'olive. Commencez par l\'\'oignon et l\'\'ail, puis les poivrons, les courgettes, et enfin les aubergines. Ajoutez les tomates et les herbes. Laissez mijoter à feu doux pendant 1 heure.', '2025-02-17 18:40:32', '2025-02-17 18:40:32', 90);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
