-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 16 avr. 2020 à 20:04
-- Version du serveur :  8.0.13
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bilemo`
--

-- --------------------------------------------------------

--
-- Structure de la table `characteristics`
--

DROP TABLE IF EXISTS `characteristics`;
CREATE TABLE IF NOT EXISTS `characteristics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7037B1564584665A` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `characteristics`
--

INSERT INTO `characteristics` (`id`, `product_id`, `designation`, `value`) VALUES
(3, 3, 'prix', '669 euros'),
(4, 3, 'couleurs', 'mauve/rouge/noir/blanc'),
(5, 3, 'stockages', '256Go/128Go'),
(6, 3, 'capteur principal', '12Mpx'),
(7, 3, 'taille d\'écran', '6.1 pouces'),
(8, 3, 'processeur', 'apple A13 Bionic\r\n'),
(9, 4, 'capteur principal', '108 Mpx'),
(10, 4, 'taille d\'écran', '6.7 pouces'),
(11, 4, 'prix', '1050 euros'),
(12, 4, 'processeur', 'Qualcomm SDM 865 Rogue dragon'),
(13, 5, 'processeur', 'kirin 980'),
(14, 5, 'taille d\'écran', '6.1 pouces'),
(15, 5, 'capteur photo', '40 Mpx'),
(16, 5, 'capteur secondaire', '16 Mpx'),
(17, 5, 'prix', '410 euros'),
(18, 6, 'capteur photo', '108 Mpx'),
(19, 6, 'taille d\'écran', '6.47 pouces'),
(20, 6, 'processeur', 'Snapdragon 730 G'),
(21, 6, 'prix', '462 euros'),
(22, 6, 'mémoire vive', '12Go ');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` json NOT NULL,
  `business` varchar(100) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C7440455E7927C74` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `email`, `password`, `roles`, `business`, `name`, `firstname`, `address`, `country`) VALUES
(1, 'mickdu62200@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$OTBnZnhtV2k5Vk9RdlByOQ$7qokTGc6TuH/XIKMsm4QaXbAzXL8UzeS2zag8VRzGkw', '\"ROLE_USER\"', 'MGCorporation', 'garret', 'michael', '52 allée des jardins 49400 Saumur', ' France'),
(2, 'mentor@openclassrooms.com', '$argon2i$v=19$m=1024,t=2,p=2$QjFCNGI5VXp6NG9jeVFQcw$wgltsyFoGyRHxy5xHIYsnAiSyeueLiK3EhnsdIET3tw', '\"ROLE_USER\"', 'OpenClassrooms', 'mentor', 'mentor', 'paris', 'france');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F7C2FC04584665A` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`id`, `product_id`, `name`, `extension`, `description`) VALUES
(5, 3, 'iPhone_11_1', 'jpg', 'iPhone 11 picture one'),
(6, 3, 'iPhone_11_2', 'jpg', 'iPhone 11 picture two'),
(7, 3, 'iPhone_11_3', 'jpg', 'iPhone_11 picture three'),
(8, 4, 'galaxy_s11_1', 'jpeg', 'picture galaxy s11 number one'),
(9, 4, 'galaxy_s11_2', 'jpg', 'picture number two of galaxy s 11'),
(10, 5, 'huawei_p30_1', 'jpg', 'picture of cell phone huawei p30 '),
(11, 5, 'huawei_p30_2', 'jpg', 'picture number two huawei p30'),
(12, 5, 'huawei_p30_3', 'jpg', 'huawei p30 '),
(13, 6, 'xiaomi_note_10_1', 'jpg', 'cellphone Xiaomi note 10'),
(14, 6, 'xiaomi_note_10_2', 'jpg', 'Xiaomi note 10 picture number two'),
(15, 6, 'xiaomi_note_10_3', 'jpg', 'picture of cellphone Xiaomi note 10');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `content`) VALUES
(3, 'BileMo iphone 11', 'Un nouveau double appareil photo conçu pour élargir vos horizons. Une puce plus rapide que toutes les autres puces de smart­phone. Une autonomie d’une journée, pour passer plus de temps à faire ce que vous aimez et moins à recharger. Et la meilleure qualité vidéo sur smartphone, pour embellir tous vos souvenirs.'),
(4, 'BileMo galaxy s11', 'Le nouveau BileMo Galaxy S11 est doté d’un grand écran Infinity 6,1’’ avec capteur photo et lecteur d’empreinte intégré sous l’écran. Il est en plus équipé d’un triple appareil photo avec grand angle et zoom optique.'),
(5, 'BileMo huawei p30', 'Des clichés plus lumineux, plus larges, plus proches. Le HUAWEI P30 vous fait voir le monde sous de nouvelles perspectives. Changez les règles de la photographie et transformez chaque moment en un souvenir impérissable. '),
(6, 'BileMo note 10', 'Le Note 10 possède un appareil photo 108 MP, avec une résolution photo unique allant jusqu\'à 12032 x 9024, 12 fois la résolution 4K ! Avec un capteur d\'image extra large de 1 / 1,33\" , l\'appareil photo du Mi Note 10 surpasse la plupart des appareils photo');

-- --------------------------------------------------------

--
-- Structure de la table `refresh_tokens`
--

DROP TABLE IF EXISTS `refresh_tokens`;
CREATE TABLE IF NOT EXISTS `refresh_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refresh_token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9BACE7E1C74F2195` (`refresh_token`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `country` varchar(60) NOT NULL,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `client_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_create` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8D93D64919EB6921` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `address`, `country`, `name`, `firstname`, `client_id`, `email`, `date_create`) VALUES
(47, 'boulogne', 'france', 'mart', 'loic', 1, 'mart.loic@gmail.com', '2020-04-14 08:27:45'),
(50, '2 allée des jardin', 'france', 'selvia', 'lois', 1, 'lois_stelvia@gmail.com', '2020-04-16 00:00:00'),
(51, '26 nelson mandela ', 'paris', 'macley', 'salie', 2, 'macley@hotmail.com', '2020-04-16 04:00:00'),
(52, '4 route de la liberté', 'marseille', 'lima', 'serge', 2, 'serge_m@gmail.com', '2020-04-16 00:00:26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
