-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2024 at 11:35 PM
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
  `distribution_center_id` int DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1B2268418D9F6D38` (`order_id`),
  KEY `IDX_1B2268411EA5B36B` (`distribution_center_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bag`
--

INSERT INTO `bag` (`id`, `order_id`, `distribution_center_id`, `code`, `creation_date`) VALUES
(5, 3, NULL, '673a6785031d0', '2024-11-17'),
(6, 3, NULL, '673a678509f43', '2024-11-17'),
(7, 4, NULL, '673a6e375161d', '2024-11-17'),
(8, 4, NULL, '673a6e3760b5d', '2024-11-17');

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

--
-- Dumping data for table `bag_product`
--

INSERT INTO `bag_product` (`bag_id`, `product_id`) VALUES
(5, 1),
(5, 3),
(6, 2),
(7, 1),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bag_reception`
--

DROP TABLE IF EXISTS `bag_reception`;
CREATE TABLE IF NOT EXISTS `bag_reception` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bag_id` int NOT NULL,
  `distribution_center_id` int NOT NULL,
  `bag_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reception_date` date NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5503C60F6F5D8297` (`bag_id`),
  KEY `IDX_5503C60F1EA5B36B` (`distribution_center_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bag_reception`
--

INSERT INTO `bag_reception` (`id`, `bag_id`, `distribution_center_id`, `bag_code`, `reception_date`, `responsable`, `qr_code`) VALUES
(5, 5, 9, '673a6785031d0', '2024-11-17', 'Mr. Misael Jenkins', 'QR_673a678507f92'),
(6, 6, 1, '673a678509f43', '2024-11-17', 'Dr. Eliezer Runte PhD', 'QR_673a67850a431'),
(7, 7, 9, '673a6e375161d', '2024-11-17', 'Mr. Misael Jenkins', 'QR_673a6e3756028'),
(8, 8, 1, '673a6e3760b5d', '2024-11-17', 'Dr. Eliezer Runte PhD', 'QR_673a6e3761177');

-- --------------------------------------------------------

--
-- Table structure for table `distribution_center`
--

DROP TABLE IF EXISTS `distribution_center`;
CREATE TABLE IF NOT EXISTS `distribution_center` (
  `id` int NOT NULL AUTO_INCREMENT,
  `warehouse_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bags_delivered` int NOT NULL,
  `delivery_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2457472E5080ECDE` (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distribution_center`
--

INSERT INTO `distribution_center` (`id`, `warehouse_id`, `name`, `responsable`, `bags_delivered`, `delivery_date`) VALUES
(1, 1, 'Orn Group', 'Dr. Eliezer Runte PhD', 214, '2024-01-09'),
(2, 2, 'Fay, Cremin and Douglas', 'Mr. Darren Crist PhD', 240, '2023-02-11'),
(3, 3, 'Predovic, Bogisich and Kovacek', 'Annamarie Steuber II', 278, '2024-09-04'),
(4, 4, 'Klein Ltd', 'Cleo Watsica III', 490, '2023-09-02'),
(5, 5, 'Beier-Moen', 'Prof. Osborne Volkman', 309, '2023-11-19'),
(6, 6, 'Morissette and Sons', 'Jacinthe Rosenbaum', 274, '2023-01-14'),
(7, 7, 'Beahan, Cremin and Stracke', 'Reba Hirthe DVM', 225, '2024-04-06'),
(8, 8, 'Emmerich, Feil and West', 'Prof. Brooklyn Will PhD', 484, '2024-01-28'),
(9, 9, 'Stroman Inc', 'Mr. Misael Jenkins', 207, '2023-03-22'),
(10, 10, 'McLaughlin-Bahringer', 'Marilie Parker', 181, '2024-05-23');

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
('DoctrineMigrations\\Version20241117212351', '2024-11-17 21:23:56', 952);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `purchase_date`, `approval_date`, `province`, `municipality`, `address`, `total_items`, `total_amount`) VALUES
(3, 2, '2024-11-17', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 3, 171.33),
(4, 2, '2024-11-17', NULL, 'La Habana', 'La Lisa', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', 2, 160.36);

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
  `warehouse_id` int NOT NULL,
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
  UNIQUE KEY `UNIQ_D34A04AD77153098` (`code`),
  KEY `IDX_D34A04AD5080ECDE` (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `warehouse_id`, `code`, `creation_date`, `name`, `name_translate`, `wight`, `volume`, `brand`, `description`, `temperature`, `price`) VALUES
(1, 9, 'PR758', '2024-02-08', 'Televisor LED', 'unde', 9.50, 3.14, 'Halvorson-Runolfsson', 'Corporis dicta doloribus non omnis temporibus eos fugiat.', 'Frozen', 96.48),
(2, 1, 'PR498', '2024-07-12', 'Lavadora Automática', 'vero', 3.14, 1.13, 'Lemke Inc', 'Voluptatum nostrum atque voluptatem sint voluptatum.', 'Chilled', 63.88),
(3, 9, 'PR110', '2024-03-30', 'Refrigerador', 'exercitationem', 6.65, 1.40, 'Grant-Johns', 'Eos incidunt dolorem est pariatur dolore voluptate quasi.', 'Chilled', 10.97),
(4, 1, 'PR363', '2024-01-11', 'Microondas', 'minima', 6.68, 5.94, 'Monahan PLC', 'A eos doloribus id minus praesentium.', 'Frozen', 34.12),
(5, 8, 'PR566', '2024-04-14', 'Aspiradora', 'necessitatibus', 2.21, 7.51, 'Hessel, Pouros and Stiedemann', 'Pariatur quibusdam fugiat minus.', 'Frozen', 15.29),
(6, 2, 'PR962', '2024-08-06', 'Cafetera', 'quisquam', 1.68, 3.24, 'Lesch, Schroeder and Mertz', 'Sapiente accusantium in et quos et.', 'Chilled', 14.53),
(7, 10, 'PR913', '2024-08-14', 'Licuadora', 'omnis', 8.16, 2.77, 'Rosenbaum, Dickinson and Schultz', 'Voluptate autem eos nesciunt ut quibusdam et temporibus.', 'Frozen', 29.87),
(8, 2, 'PR639', '2024-03-16', 'Tostadora', 'qui', 0.64, 4.54, 'Beer-Collins', 'Magnam vel repellat totam blanditiis quam.', 'Ambient', 20.81),
(9, 3, 'PR090', '2024-08-24', 'Plancha', 'architecto', 9.60, 0.62, 'O\'Kon LLC', 'Aliquam dolor vero dolorum enim.', 'Frozen', 63.23),
(10, 7, 'PR979', '2024-07-11', 'Secadora de Ropa', 'et', 6.79, 7.99, 'Frami-Schultz', 'Optio quis ipsum perspiciatis quaerat reiciendis odit omnis nobis.', 'Chilled', 41.77),
(11, 5, 'PR355', '2024-01-28', 'Ventilador', 'culpa', 6.93, 7.97, 'Purdy, Hessel and Leffler', 'Nihil voluptatem excepturi itaque quasi adipisci.', 'Ambient', 50.33),
(12, 4, 'PR423', '2024-10-09', 'Aire Acondicionado', 'explicabo', 0.66, 2.66, 'Corwin and Sons', 'Fuga est quo dignissimos laboriosam ex accusantium enim.', 'Frozen', 38.80),
(13, 1, 'PR376', '2024-10-15', 'Calefactor', 'officia', 5.31, 0.98, 'Balistreri, Williamson and Beier', 'Rerum laudantium ut vero eligendi quam porro illum.', 'Chilled', 87.67),
(14, 4, 'PR385', '2024-03-13', 'Horno Eléctrico', 'similique', 4.61, 8.21, 'Kshlerin LLC', 'Autem quia est neque non in voluptate voluptatem quod.', 'Chilled', 15.93),
(15, 6, 'PR152', '2024-11-07', 'Batidora', 'qui', 3.19, 6.16, 'Gerlach-Lowe', 'Ea veniam consectetur voluptatem accusantium.', 'Ambient', 30.98),
(16, 3, 'PR685', '2024-08-04', 'Exprimidor de Jugos', 'id', 6.32, 9.15, 'Weissnat LLC', 'Explicabo sit eum autem placeat.', 'Chilled', 10.41),
(17, 6, 'PR258', '2024-11-16', 'Freidora de Aire', 'quos', 3.80, 6.79, 'Predovic Inc', 'Beatae voluptatem aut occaecati suscipit.', 'Ambient', 25.29),
(18, 9, 'PR461', '2024-05-11', 'Máquina de Coser', 'quisquam', 8.59, 3.52, 'Hermiston, Stokes and Conroy', 'Iure pariatur nesciunt consequatur blanditiis ab.', 'Frozen', 96.72),
(19, 4, 'PR361', '2024-07-22', 'Robot de Cocina', 'atque', 5.86, 1.76, 'Lueilwitz and Sons', 'Et eius vel et voluptate voluptate quo aut.', 'Chilled', 23.89),
(20, 5, 'PR117', '2023-12-26', 'Humidificador', 'ab', 3.82, 8.08, 'Goodwin, Grady and Hirthe', 'Deleniti et atque incidunt repellat.', 'Chilled', 39.32),
(21, 1, 'PR042', '2023-12-25', 'Deshumidificador', 'deleniti', 6.44, 8.32, 'Cummerata, Ferry and Kuhlman', 'Veritatis veritatis deleniti molestiae eius consequatur.', 'Frozen', 37.38),
(22, 9, 'PR977', '2024-08-26', 'Purificador de Aire', 'reprehenderit', 6.58, 8.53, 'DuBuque Inc', 'Qui molestiae maxime harum magni.', 'Ambient', 63.52),
(23, 2, 'PR247', '2024-11-06', 'Termo Eléctrico', 'sapiente', 0.32, 2.58, 'Heidenreich, Nader and Hauck', 'Officia dolore dolorum laudantium itaque.', 'Chilled', 51.79),
(24, 10, 'PR848', '2024-08-25', 'Estufa de Gas', 'iure', 7.03, 3.45, 'Dare Ltd', 'Vel eos cumque cupiditate accusamus odio molestiae vel.', 'Chilled', 64.59),
(25, 1, 'PR073', '2024-06-18', 'Lavavajillas', 'vitae', 2.77, 1.98, 'Leuschke Ltd', 'Ad sit quo in reprehenderit voluptates.', 'Chilled', 41.52),
(26, 4, 'PR246', '2024-09-25', 'Helado de Vainilla', 'alias', 7.51, 2.78, 'Graham, Baumbach and Braun', 'Tempore recusandae laborum rerum ab iure est.', 'Frozen', 7.40),
(27, 7, 'PR104', '2024-03-28', 'Pizza Congelada', 'et', 1.92, 7.57, 'Yost, Greenfelder and Boehm', 'Ea et magni quaerat est perspiciatis.', 'Ambient', 23.06),
(28, 8, 'PR370', '2024-08-23', 'Carne de Res', 'rem', 6.84, 6.70, 'Shanahan, Ziemann and Kunde', 'Ut assumenda sit qui dolorem nulla repellat illo.', 'Ambient', 3.79),
(29, 5, 'PR523', '2024-07-30', 'Pescado', 'maxime', 5.24, 4.49, 'Homenick-Schulist', 'Enim sit aspernatur quaerat non.', 'Frozen', 16.52),
(30, 3, 'PR303', '2024-02-01', 'Pollo', 'eum', 9.41, 3.88, 'Okuneva Group', 'Quae quasi porro quisquam officiis maxime doloremque.', 'Frozen', 84.46),
(31, 5, 'PR755', '2024-10-09', 'Ensalada', 'ut', 3.06, 8.76, 'Sanford, Denesik and Connelly', 'Enim ex doloremque sed.', 'Chilled', 92.54),
(32, 5, 'PR666', '2024-06-10', 'Frutas Frescas', 'perferendis', 9.39, 1.01, 'Zemlak, Macejkovic and Swaniawski', 'Et culpa ducimus ut magni adipisci.', 'Chilled', 12.86),
(33, 8, 'PR660', '2024-06-28', 'Verduras Congeladas', 'quo', 7.61, 5.38, 'O\'Kon, Cole and Lind', 'Voluptatibus sit mollitia tenetur iure.', 'Chilled', 45.95),
(34, 3, 'PR425', '2024-08-06', 'Yogur', 'sit', 3.08, 4.57, 'Ernser, Hettinger and Aufderhar', 'Voluptatum labore quam id qui.', 'Chilled', 46.85),
(35, 2, 'PR582', '2024-09-06', 'Queso', 'veniam', 2.85, 3.57, 'Hodkiewicz and Sons', 'Eius aut omnis dolores mollitia et.', 'Chilled', 88.60),
(36, 7, 'PR154', '2023-11-19', 'Leche', 'est', 3.42, 8.91, 'Rutherford-Beahan', 'Quo ea earum qui.', 'Ambient', 92.51),
(37, 10, 'PR447', '2024-02-10', 'Pan', 'possimus', 8.59, 3.17, 'Schumm-Adams', 'Aut saepe distinctio est ut ea odio.', 'Chilled', 42.80),
(38, 10, 'PR814', '2024-05-19', 'Galletas', 'dolore', 0.55, 7.35, 'Cummerata-Raynor', 'Recusandae laudantium delectus facere nesciunt quibusdam tempora.', 'Ambient', 5.82),
(39, 5, 'PR221', '2023-11-25', 'Cereal', 'necessitatibus', 9.58, 5.18, 'Nader-Olson', 'Nemo ut modi quis doloremque placeat neque dolores adipisci.', 'Frozen', 36.50);

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
(2, 'reinaldo@gmail.com', '[]', '$2y$13$RmQWultkRMNpLFK5zJiSlO5yoFbkAXlWcdNRiR0SVTmrOjMzzVjXy', 'Reinaldo', 'Barrera', 'Ave 61 e/ 330 y 332, edif 5 apt 12, La Concepccion, La Lisa, La Habana', '54293768'),
(3, 'juan@gmail.com', '[]', '$2y$13$UrVgniMyBq2LQ0ncd6X3keHJ9Rrrgth7/K2QROuMMAoCr48DNWBbq', 'Juan', 'Perez', 'aVE lA HABANA', '58296874');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `creation_date`, `name`, `code`, `phone`, `address`, `active`, `latitude`, `longitude`) VALUES
(1, '2022-12-10', 'Friesen-Schiller', 'WH510', '+1-680-506-5690', '1703 Schoen Trail Suite 491\nLake Carmellaland, SC 38981-7341', 0, 15.45418900, 99.99999999),
(2, '2023-07-12', 'Herzog-Kiehn', 'WH018', '(831) 250-7531', '3501 Coby Lake Suite 370\nKrisstad, NY 41317', 1, -80.28279300, 74.49689300),
(3, '2023-08-27', 'Okuneva, Leuschke and Reichel', 'WH920', '952.934.0558', '665 Elza Neck\nPort Elmer, CA 21753', 0, 78.43367000, 74.91685300),
(4, '2023-05-11', 'Blanda, Kuvalis and Zieme', 'WH977', '1-903-415-8734', '761 Considine Stream Apt. 150\nLake Alford, IL 69268', 1, -19.32610900, 28.87883100),
(5, '2023-06-18', 'Murray, Christiansen and Adams', 'WH573', '+1-407-958-5487', '165 Lisandro Land\nChasityton, ID 75170-0009', 0, -47.97635100, -99.99999999),
(6, '2023-03-11', 'Hyatt LLC', 'WH333', '321-997-8059', '44401 Stoltenberg Mews\nNorth Lorenza, NV 84053-4161', 1, -57.75051700, -99.99999999),
(7, '2024-07-02', 'Hammes, Langworth and Grady', 'WH184', '(986) 583-5029', '62302 Erna Bridge Suite 432\nColeview, NJ 31417-9365', 1, -13.43342100, 3.47730100),
(8, '2024-01-14', 'Harber Group', 'WH336', '539.468.9274', '13293 Tremblay Oval\nDonmouth, SD 53356-7536', 0, -51.30649300, -74.96598100),
(9, '2024-05-29', 'Botsford-Kunze', 'WH263', '360-772-3962', '3524 Diamond Freeway\nRogahnfurt, RI 18372-0335', 0, -60.63260800, 99.99999999),
(10, '2023-11-01', 'Rippin, Mitchell and Stracke', 'WH457', '(831) 863-4868', '36276 Dewitt Manor Suite 292\nAngieberg, NE 28566-8777', 0, 7.91652700, 77.38899400);

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
-- Constraints for table `distribution_center`
--
ALTER TABLE `distribution_center`
  ADD CONSTRAINT `FK_2457472E5080ECDE` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`);

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

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD5080ECDE` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
