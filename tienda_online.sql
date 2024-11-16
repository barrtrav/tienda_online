-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2024 at 10:47 PM
-- Server version: 8.3.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `bag`
--

DROP TABLE IF EXISTS `bag`;
CREATE TABLE IF NOT EXISTS `bag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  `distribution_center_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1B2268418D9F6D38` (`order_id`),
  KEY `IDX_1B2268411EA5B36B` (`distribution_center_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bag_product`
--

DROP TABLE IF EXISTS `bag_product`;
CREATE TABLE IF NOT EXISTS `bag_product` (
  `bag_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`bag_id`,`product_id`),
  KEY `IDX_A738278F6F5D8297` (`bag_id`),
  KEY `IDX_A738278F4584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bag_reception`
--

DROP TABLE IF EXISTS `bag_reception`;
CREATE TABLE IF NOT EXISTS `bag_reception` (
  `id` int NOT NULL AUTO_INCREMENT,
  `distribution_center_id` int NOT NULL,
  `bag_id` int NOT NULL,
  `bag_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reception_date` date NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5503C60F1EA5B36B` (`distribution_center_id`),
  KEY `IDX_5503C60F6F5D8297` (`bag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distribution_center`
--

DROP TABLE IF EXISTS `distribution_center`;
CREATE TABLE IF NOT EXISTS `distribution_center` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bags_delivered` int NOT NULL,
  `delivery_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distribution_center`
--

INSERT INTO `distribution_center` (`id`, `name`, `responsable`, `bags_delivered`, `delivery_date`) VALUES
(11, 'Flatley-Thompson', 'Mrs. Georgette Trantow', 379, '2023-06-15'),
(12, 'Cremin-Heathcote', 'Beatrice Hansen', 334, '2024-08-16'),
(13, 'Champlin, Stamm and Marks', 'Jade Jacobson', 244, '2024-07-16'),
(14, 'Beahan and Sons', 'Eva Ratke', 178, '2023-02-17'),
(15, 'Schneider, Cole and Kshlerin', 'Demarco Mohr', 329, '2023-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241116154629', '2024-11-16 15:46:48', 69),
('DoctrineMigrations\\Version20241116171504', '2024-11-16 17:15:11', 87),
('DoctrineMigrations\\Version20241116173355', '2024-11-16 17:34:01', 67),
('DoctrineMigrations\\Version20241116201535', '2024-11-16 20:15:43', 774),
('DoctrineMigrations\\Version20241116202136', '2024-11-16 20:21:45', 378);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `purchase_date` date NOT NULL,
  `approval_date` date DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_items` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `purchase_date`, `approval_date`, `province`, `municipality`, `address`, `total_items`, `total_amount`) VALUES
(1, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(2, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(3, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(4, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(5, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(6, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(7, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(8, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(9, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(10, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(11, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(12, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(13, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(14, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 18.99),
(15, 3, '2024-11-16', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 20.55);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE IF NOT EXISTS `order_product` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `IDX_2530ADE68D9F6D38` (`order_id`),
  KEY `IDX_2530ADE64584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_translate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wight` decimal(10,2) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `temperature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D34A04AD77153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `creation_date`, `name`, `name_translate`, `wight`, `volume`, `brand`, `description`, `temperature`, `price`) VALUES
(116, 'PR284', '2024-04-07', 'Televisor LED', 'Emilia', 8.59, 9.14, 'Reprehenderit autem.', 'Est aliquid sed vitae commodi et.', 'Ambient', 69.98),
(117, 'PR221', '2024-07-30', 'Lavadora Automática', 'Terrill', 1.90, 1.94, 'Fugit magni qui.', 'Amet eum earum fugit molestiae cumque.', 'Ambient', 5.14),
(118, 'PR805', '2024-07-01', 'Refrigerador', 'Frederique', 9.64, 9.10, 'Adipisci et.', 'Hic excepturi ab autem illum qui.', 'Chilled', 30.67),
(119, 'PR663', '2024-04-15', 'Microondas', 'Andy', 2.54, 5.09, 'Repudiandae magni.', 'Dolorem ut suscipit et sed fugiat vel natus.', 'Ambient', 87.25),
(120, 'PR226', '2024-01-19', 'Aspiradora', 'Kelvin', 1.28, 5.31, 'Qui harum et.', 'Recusandae ut non est reiciendis.', 'Ambient', 53.30),
(121, 'PR098', '2024-10-01', 'Cafetera', 'Mikel', 9.16, 9.77, 'Sapiente magni.', 'Eius nostrum cumque sint et.', 'Ambient', 54.12),
(122, 'PR819', '2023-12-16', 'Licuadora', 'Pablo', 6.56, 9.45, 'Molestiae quisquam.', 'Maiores illum voluptatem ut ipsa in aut.', 'Ambient', 4.99),
(123, 'PR279', '2024-11-15', 'Tostadora', 'Hattie', 3.76, 6.12, 'Voluptates.', 'Dolores porro tenetur a harum ipsa.', 'Ambient', 1.56),
(124, 'PR100', '2024-05-21', 'Plancha', 'Vance', 3.01, 7.67, 'Distinctio omnis.', 'Quibusdam quis voluptatem amet consequatur.', 'Ambient', 28.62),
(125, 'PR716', '2024-05-14', 'Secadora de Ropa', 'Phoebe', 6.92, 9.31, 'Doloribus itaque ut.', 'Excepturi impedit dolor est dolorem tempore et.', 'Ambient', 88.75),
(126, 'PR985', '2024-06-28', 'Ventilador', 'Germaine', 6.87, 5.34, 'Deserunt non libero.', 'Voluptatum ea assumenda vero a libero delectus.', 'Ambient', 72.11),
(127, 'PR162', '2024-03-18', 'Aire Acondicionado', 'Godfrey', 6.66, 4.41, 'Pariatur voluptatum.', 'Maxime autem a est reiciendis.', 'Chilled', 25.31),
(128, 'PR657', '2024-01-16', 'Calefactor', 'Dean', 9.84, 1.17, 'Facilis asperiores.', 'Velit enim nulla et ut quisquam.', 'Ambient', 64.18),
(129, 'PR350', '2024-05-24', 'Horno Eléctrico', 'Rickie', 9.34, 7.02, 'Tempore fugit.', 'Impedit et fugit impedit at doloremque.', 'Ambient', 76.77),
(130, 'PR155', '2024-11-09', 'Batidora', 'Keegan', 7.81, 6.79, 'Quidem modi.', 'Sed ab ut et sint neque non.', 'Ambient', 8.21),
(131, 'PR159', '2023-11-23', 'Exprimidor de Jugos', 'Carey', 7.89, 5.88, 'Est hic.', 'Eum est eius itaque repellat sapiente sed saepe.', 'Ambient', 27.51),
(132, 'PR764', '2024-10-25', 'Freidora de Aire', 'Cale', 0.97, 5.36, 'Quia odit unde.', 'Mollitia quos sint fuga quia sit consequatur.', 'Ambient', 16.97),
(133, 'PR709', '2024-04-07', 'Máquina de Coser', 'Maude', 4.57, 7.83, 'Neque quae saepe ut.', 'Alias natus voluptatem accusamus laudantium.', 'Ambient', 33.69),
(134, 'PR445', '2024-05-12', 'Robot de Cocina', 'Stanley', 4.29, 2.35, 'Magnam delectus.', 'Odio eveniet sint quibusdam impedit autem.', 'Ambient', 31.62),
(135, 'PR453', '2024-04-05', 'Humidificador', 'Randal', 9.39, 6.01, 'Accusamus magni.', 'Mollitia quod dolorum facilis suscipit sit optio.', 'Ambient', 68.60),
(136, 'PR182', '2024-06-10', 'Deshumidificador', 'Shanel', 8.77, 5.18, 'Necessitatibus.', 'Facilis sequi et aut cum. Ea id nostrum expedita.', 'Ambient', 78.58),
(137, 'PR757', '2024-03-01', 'Purificador de Aire', 'Cara', 9.40, 0.54, 'Fugiat et voluptas.', 'At enim autem et voluptas repellat dolores eos.', 'Ambient', 69.72),
(138, 'PR520', '2024-08-28', 'Termo Eléctrico', 'Mireille', 6.66, 4.66, 'Sed eum et optio.', 'Fuga exercitationem sit id odio adipisci.', 'Ambient', 96.72),
(139, 'PR611', '2024-10-30', 'Estufa de Gas', 'Alexys', 9.44, 7.23, 'Reiciendis quam qui.', 'Officia unde sed quia atque omnis itaque rerum.', 'Ambient', 46.57),
(140, 'PR416', '2024-06-05', 'Lavavajillas', 'Herminia', 4.34, 3.61, 'Id qui non voluptas.', 'Accusantium vel perspiciatis et est et.', 'Ambient', 21.54),
(141, 'PR509', '2024-05-18', 'Helado de Vainilla', 'Giuseppe', 0.49, 0.43, 'Aut autem eaque.', 'Optio earum aut ut corrupti est in.', 'Frozen', 32.97),
(142, 'PR539', '2024-07-17', 'Pizza Congelada', 'Audreanne', 5.95, 6.20, 'Ratione pariatur id.', 'Est dignissimos dolor non omnis blanditiis quasi.', 'Frozen', 72.09),
(143, 'PR428', '2024-02-07', 'Carne de Res', 'Myrtice', 1.65, 7.30, 'Ex optio et.', 'Error amet ut ipsum qui reprehenderit esse.', 'Frozen', 18.99),
(144, 'PR370', '2023-11-30', 'Pescado', 'Molly', 6.65, 1.27, 'Suscipit laboriosam.', 'Animi odit corporis beatae qui autem ad.', 'Frozen', 67.14),
(145, 'PR779', '2024-08-27', 'Pollo', 'Felicity', 9.59, 1.15, 'Autem voluptatem.', 'Recusandae voluptatibus quia illum.', 'Frozen', 5.01),
(146, 'PR216', '2024-07-21', 'Ensalada', 'Sonya', 4.53, 8.35, 'Ratione aut a.', 'Non incidunt molestiae omnis ab.', 'Chilled', 92.06),
(147, 'PR009', '2023-11-17', 'Frutas Frescas', 'Sean', 9.16, 6.10, 'Commodi nihil.', 'Qui exercitationem nulla qui rem.', 'Chilled', 35.21),
(148, 'PR554', '2024-08-01', 'Verduras Congeladas', 'Flavie', 2.81, 4.78, 'Beatae similique.', 'Odit tenetur ab saepe.', 'Frozen', 74.74),
(149, 'PR038', '2023-12-20', 'Yogur', 'Paige', 2.30, 6.19, 'Est vero sunt iste.', 'Sed dolorum voluptatibus et et sunt.', 'Chilled', 22.43),
(150, 'PR274', '2024-05-03', 'Queso', 'Diego', 9.68, 2.90, 'In minima quaerat.', 'Consequatur esse repudiandae nulla.', 'Chilled', 31.46),
(151, 'PR893', '2024-10-14', 'Leche', 'Dillon', 5.95, 8.09, 'Non natus suscipit.', 'Nihil odio quae aliquid. Inventore qui quo est.', 'Chilled', 89.95),
(152, 'PR210', '2024-03-26', 'Pan', 'Jermain', 4.40, 3.26, 'Harum non ipsam.', 'Eveniet enim eum sed aperiam numquam non dolorem.', 'Ambient', 89.99),
(153, 'PR648', '2024-06-30', 'Galletas', 'Kane', 4.35, 8.71, 'Mollitia impedit.', 'Voluptates labore quis vel nemo.', 'Ambient', 39.01),
(154, 'PR302', '2024-11-09', 'Cereal', 'Alisa', 4.48, 0.13, 'Qui aut aut omnis.', 'Ipsam enim odit non eligendi et.', 'Ambient', 20.90);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `address`, `phone_number`) VALUES
(3, 'reinaldo@gmail.com', '[]', '$2y$13$3YSxqOgT8WAsa7fteZO/9eEM2FdX4uvsRF1Eattu1K7VTK8UdWNjy', 'Reinaldo', 'Barrera', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', '54293768');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE IF NOT EXISTS `warehouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `creation_date` date NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_ECB38BFC77153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `creation_date`, `name`, `code`, `phone`, `address`, `active`, `latitude`, `longitude`) VALUES
(21, '2024-10-23', 'Haag, Boyer and Daniel', 'WH441', '765-515-9474', '675 Roob Mill Suite 309\nNorth Ariane, OK 22486', 1, -9.97732300, -99.99999999),
(22, '2023-04-11', 'Hand-Heathcote', 'WH335', '+1-541-801-3654', '8404 Senger Mission\nVeumfort, IA 12888-2050', 0, 33.91462900, -99.99999999),
(23, '2024-05-22', 'Kilback, Hirthe and Hyatt', 'WH760', '(667) 881-6151', '3916 Rath Turnpike\nScottyland, NC 11346-2782', 0, -7.92787100, 91.67483400),
(24, '2022-12-04', 'Zieme-Stoltenberg', 'WH601', '838-719-8326', '690 Brown Street\nReillyville, DC 67860-8360', 0, 29.97199000, 14.83361700),
(25, '2023-10-05', 'Halvorson, Beer and Effertz', 'WH208', '+18646180860', '9657 Gerlach Motorway Apt. 433\nNew Jedidiah, MO 72685', 1, -21.62654400, 55.29459900),
(26, '2024-07-15', 'Nader-Considine', 'WH359', '(585) 892-2315', '43995 Kattie Greens\nHoraceton, MI 03998-2497', 1, 55.67776000, 99.99999999),
(27, '2024-03-08', 'Fadel-Homenick', 'WH910', '+14146172245', '2152 Hane Burg\nWest Karelle, PA 52392', 0, -5.11406700, -78.90243200),
(28, '2024-07-14', 'Moen PLC', 'WH616', '714-300-4299', '253 Dante Heights\nCorwinfurt, HI 60795-3644', 1, 13.41883600, -99.99999999),
(29, '2024-04-27', 'Runte-O\'Hara', 'WH582', '+18502794237', '41598 Keely Station Suite 183\nMcDermottstad, PA 42243', 1, 74.63764900, 41.60742700),
(30, '2024-02-25', 'Dooley PLC', 'WH316', '1-650-933-4390', '93285 Parker Hill Suite 009\nLake Benside, DC 66093', 1, -22.05837700, -80.90609200);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bag`
--
ALTER TABLE `bag`
  ADD CONSTRAINT `FK_1B2268411EA5B36B` FOREIGN KEY (`distribution_center_id`) REFERENCES `distribution_center` (`id`),
  ADD CONSTRAINT `FK_1B2268418D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `bag_product`
--
ALTER TABLE `bag_product`
  ADD CONSTRAINT `FK_A738278F4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A738278F6F5D8297` FOREIGN KEY (`bag_id`) REFERENCES `bag` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bag_reception`
--
ALTER TABLE `bag_reception`
  ADD CONSTRAINT `FK_5503C60F1EA5B36B` FOREIGN KEY (`distribution_center_id`) REFERENCES `distribution_center` (`id`),
  ADD CONSTRAINT `FK_5503C60F6F5D8297` FOREIGN KEY (`bag_id`) REFERENCES `bag` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `FK_2530ADE64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2530ADE68D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
