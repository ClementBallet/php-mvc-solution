-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 déc. 2022 à 15:30
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'International'),
(2, 'Sport'),
(3, 'Economie');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext,
  `author` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `author`, `category_id`, `created_at`, `modified_at`) VALUES
(1, 'Mon super article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum facilisis eleifend mattis. Sed in lectus ut metus dictum fringilla. Aenean quam sapien, elementum at suscipit vel, scelerisque vitae massa. Mauris et odio dolor. Nunc gravida porta lorem et egestas. Sed ultricies vehicula diam, at viverra nibh ullamcorper ut. Vivamus et tortor rutrum, hendrerit justo eget, iaculis enim. Sed bibendum vel lorem eget aliquet.\r\n\r\nVivamus commodo dictum magna et dignissim. Aliquam vulputate vitae lectus eu consectetur. Sed leo tellus, pellentesque in nisl ut, condimentum luctus erat. Donec ac vehicula quam, non euismod justo. Nullam eu urna euismod, ultrices neque ac, lobortis leo. Quisque quis ligula vel mi consequat gravida. Vestibulum faucibus dolor quis semper aliquet. Mauris elementum justo sit amet lectus efficitur, vel iaculis velit sagittis.\r\n\r\nPraesent vestibulum sapien vel justo ultrices efficitur. Aenean nec tincidunt ante, vitae semper tortor. Vivamus non ligula eu purus tempor fermentum. Duis porttitor dui convallis, euismod diam non, luctus ante. Phasellus quis ullamcorper leo, vitae molestie tellus. Quisque ultrices nulla ut sem posuere, eu vulputate felis fringilla. Vivamus varius dui ligula, sit amet facilisis massa lobortis laoreet. Curabitur mollis magna id dui pellentesque, in rutrum tortor euismod.\r\n\r\nAenean vulputate tellus eu ante aliquet varius. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec volutpat non est non consectetur. In hac habitasse platea dictumst. Praesent in eros fermentum, luctus ligula quis, vestibulum mi. Sed at finibus dui. Maecenas accumsan lorem ac laoreet laoreet. Aliquam in est eget justo vehicula imperdiet. Sed tristique tempor dui rhoncus ultrices. Phasellus at massa sapien. Cras dui dui, vulputate sit amet faucibus quis, sagittis ac justo. Mauris sodales aliquam facilisis. Morbi sollicitudin sem dignissim consequat ultricies. Cras in purus tempor, fringilla mauris ut, sollicitudin ex.\r\n\r\nIn orci nulla, dictum vitae semper non, consequat ut ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed fringilla nec enim vitae dignissim. Quisque ut ipsum leo. Etiam ultrices sollicitudin enim eget dignissim. Curabitur ornare placerat tempus. Nam egestas faucibus arcu, quis auctor lectus aliquam ac. Donec dictum mauris orci, lobortis venenatis metus maximus ac. Ut aliquam blandit eros, vitae tempus nibh ultricies non. Praesent mattis nisl nibh, et fermentum quam pharetra eu. Morbi quis dolor a elit lacinia pulvinar. Pellentesque posuere quam non tristique luctus. Nulla congue, metus vel fermentum iaculis, mi leo commodo dolor, quis convallis eros diam id turpis. Nullam luctus, tortor ac aliquam porttitor, felis justo commodo orci, vel fermentum ligula sapien a magna. Vivamus quis felis lobortis, pulvinar lorem ut, iaculis lorem.', 'Clément', 1, '2022-11-28', NULL),
(2, 'Mon 2e article', 'Un texte', 'Moi', 2, '2022-11-29', NULL),
(3, 'C\'est un autre article...', 'Et il est incroyable', 'Toujours moi', 1, '2022-11-30', NULL),
(4, 'Mon article parlant d\'un sujet très intéressant', 'Qu\'est-ce que le Lorem Ipsum?\r\nLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'Toto', 3, '2022-12-07', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
