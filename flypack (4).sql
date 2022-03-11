-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2022 at 02:17 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flypack`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city`) VALUES
(1, 'SANTIAGO');

-- --------------------------------------------------------

--
-- Table structure for table `communes`
--

CREATE TABLE `communes` (
  `id` int(11) NOT NULL,
  `commune` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communes`
--

INSERT INTO `communes` (`id`, `commune`, `city_id`) VALUES
(1, 'LAS CONDES', 1),
(2, 'COLINA', 1),
(3, 'HUECHURABA', 1),
(4, 'LA REINA', 1),
(5, 'LO BARNECHEA', 1),
(6, 'MACUL', 1),
(7, 'NUÑOA', 1),
(8, 'PEÑALOLEN', 1),
(9, 'PROVIDENCIA', 1),
(10, 'RECOLETA', 1),
(11, 'VITACURA', 1),
(12, 'CONCHALI', 1),
(13, 'INDEPENDENCIA', 1),
(14, 'LA CISTERNA', 1),
(15, 'LA FLORIDA', 1),
(16, 'LA GRANJA', 1),
(17, 'LA PINTANA', 1),
(18, 'PEDRO AGUIRRE CERDA', 1),
(19, 'SAN JOAQUIN', 1),
(20, 'SAN MIGUEL', 1),
(21, 'SAN RAMON', 1),
(22, 'SANTIAGO', 1),
(23, 'CERRILLOS', 1),
(24, 'CERRO NAVIA', 1),
(25, 'EL BOSQUE', 1),
(26, 'ESTACION CENTRAL', 1),
(27, 'LO ESPEJO', 1),
(28, 'LO PRADO', 1),
(29, 'PUENTE ALTO', 1),
(30, 'QUILICURA', 1),
(31, 'QUINTA NORMAL', 1),
(32, 'RENCA', 1),
(33, 'MAIPU', 1),
(34, 'PUDAHUEL', 1),
(35, 'SAN BERNARDO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `rut` int(10) DEFAULT NULL,
  `dv` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fantasy` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `communes_id` int(11) DEFAULT NULL,
  `companies_state_id` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `rut`, `dv`, `razon`, `fantasy`, `address`, `city_id`, `communes_id`, `companies_state_id`) VALUES
(1, 11111111, '1', 'RAZON SOCIAL 1', 'NOMBRE FANTASIA 1', 'DIRECCION 1', 1, 1, 1),
(2, 76993984, '7', 'Anza SpA', 'BPLAYER', 'Av. Providencia 1208 Of 1603', 1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies_state`
--

CREATE TABLE `companies_state` (
  `id` int(11) NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies_state`
--

INSERT INTO `companies_state` (`id`, `state`) VALUES
(1, 'ACTIVO'),
(2, 'SUSPENDIDO'),
(3, 'ELIMINADO'),
(4, 'BLOQUEADO');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `rut` int(10) DEFAULT NULL,
  `dv` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `people_states_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `rut`, `dv`, `name`, `lastname`, `address`, `city`, `commune`, `email`, `phone`, `profile_id`, `people_states_id`, `created`, `modified`) VALUES
(1, 22221960, '4', 'Melody', 'Romero', 'Los alerces 2363 depto 202', 'CURICO', 'nunoa', 'mromerodev@gmail.com', '+569 958098890', 1, 1, '2022-01-03 02:48:47', '2022-01-03 02:48:47'),
(2, 17795600, '1', 'Matias Sabino', 'Quezada Sanhueza', 'Manuel correa 1', 'Curico', 'Curico', 'el_mts@hotmail.com', '+56979852140', 1, 1, '2022-01-03 14:53:57', NULL),
(3, 21242087, '2', 'Juan', 'Perez', 'Siempreviva 123', 'Curico', 'Rauco', 'xemail@gmail.com', '+569680998830', 2, 1, '2022-01-03 15:25:02', NULL),
(4, 25574390, '2', 'Kevin', 'Lopez Echeverria', 'Chiloe sin numero', 'Chiloe', 'Chiloe', 'kevinlopez@gmail.com', '+569680998830', 3, 1, '2022-01-03 15:36:38', NULL),
(5, 15338558, '1', 'Antonio Alejandro', 'Farías Mira', 'Paicaví 2721', 'Santiago', 'La Florida', 'antonio.flypack@gmail.com', '978612572', 1, 1, '2022-01-07 14:14:48', NULL),
(6, 14141551, '1', 'Fernando Esteban', 'Monserrat Torres', 'Mario Recordón 8457', 'Santiago', 'La Florida', 'nano3dfx@gmail.com', '976452986', 3, 1, '2022-01-07 14:26:22', NULL),
(7, 17517750, '1', 'Constanza', 'Pfeifer', 'Oceano Artico', 'Santiago', 'Peñalolen', 'pfeifer.constanza@gmail.com', '+56989069423', 1, 1, '2022-01-07 16:00:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `people_states`
--

CREATE TABLE `people_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people_states`
--

INSERT INTO `people_states` (`id`, `state`) VALUES
(1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `profile` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `profile`, `created`, `modified`) VALUES
(1, 'ADMINISTRADOR', NULL, NULL),
(2, 'CLIENTE', NULL, NULL),
(3, 'REPARTIDOR', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `from` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `companies_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `from`, `to`, `value`, `companies_id`) VALUES
(1, 'LAS CONDES', 'LAS CONDES', 3100, 2),
(2, 'LAS CONDES', 'COLINA', 3500, 2),
(3, 'LAS CONDES', 'HUECHURABA', 3500, 2),
(4, 'LAS CONDES', 'LA REINA', 3500, 2),
(5, 'LAS CONDES', 'LO BARNECHEA', 3500, 2),
(6, 'LAS CONDES', 'MACUL', 3500, 2),
(7, 'LAS CONDES', 'NUNOA', 3500, 2),
(8, 'LAS CONDES', 'PENALOLEN', 3500, 2),
(9, 'LAS CONDES', 'PROVIDENCIA', 3500, 2),
(10, 'LAS CONDES', 'RECOLETA', 3500, 2),
(11, 'LAS CONDES', 'VITACURA', 3500, 2),
(12, 'LAS CONDES', 'CONCHALI', 4000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'CLIENTE'),
(3, 'REPARTIDOR');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `order_nro` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quadmins_code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `delivery_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_date` datetime DEFAULT NULL,
  `shipping_states_id` int(11) DEFAULT NULL,
  `companies_id` int(11) DEFAULT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_mail` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `origin` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destiny` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `order_nro`, `quadmins_code`, `shipping_type`, `total_amount`, `delivery_name`, `shipping_date`, `shipping_states_id`, `companies_id`, `sender`, `address`, `receiver_name`, `receiver_phone`, `receiver_mail`, `observation`, `label`, `created`, `modified`, `origin`, `destiny`) VALUES
(1, '1', '1', 'dfds', 2, 'ere', '2021-12-08 04:34:58', 2, 1, 'werw', 'ewr', 'werw', 'wer', 'wer', 'ewrw', 'wer', '2021-12-08 04:34:58', '2021-12-08 04:34:58', '', ''),
(12, '2', '2', 'COMPR', 0, '000000000', '0000-00-00 00:00:00', 1, 1, 'Melody Romero', 'Manuel correa 1', 'Melody Romero', '958098890', 'mromerodev@gmail.com', 'Compra mayorista', NULL, '2021-12-19 01:22:53', NULL, '', ''),
(13, '2', 'N/A', 'X', 1233, '000000000', '0000-00-00 00:00:00', 1, 1, 'Melody Romero', 'Osvaldo Marquez', 'Melody Romero', '958098890', 'mromerodev@gmail.com', 'Compra mayorista', NULL, '2022-03-02 02:45:34', NULL, '', ''),
(14, '3', 'N/A', 'X', 343434, '000000000', '0000-00-00 00:00:00', 1, 0, 'Melody Romero', 'Osvaldo Marquez', 'Melody Romero', '958098890', 'mromerodev@gmail.com', 'Compra mayorista', NULL, '2022-03-02 02:56:37', NULL, '', ''),
(15, '2', 'N/A', 'X', 1233, '000000000', '0000-00-00 00:00:00', 1, 0, 'Melody Romero', 'Manuel correa 1', 'Melody Romero', '958098890', 'mromerodev@gmail.com', 'fdgt', NULL, '2022-03-06 12:06:23', NULL, '', ''),
(16, '2', 'N/A', 'X', 1233, '000000000', '0000-00-00 00:00:00', 1, 0, 'Melody Romero', 'Manuel correa 1', 'Melody Romero', '958098890', 'mromerodev@gmail.com', 'fdgt', NULL, '2022-03-06 12:08:15', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_delivery`
--

CREATE TABLE `shipping_delivery` (
  `id` int(11) NOT NULL,
  `shipping` int(11) NOT NULL,
  `delivery_man` int(11) NOT NULL,
  `assigned_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_states`
--

CREATE TABLE `shipping_states` (
  `id` int(11) NOT NULL,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_states`
--

INSERT INTO `shipping_states` (`id`, `state`) VALUES
(1, 'RECIBIDO'),
(2, 'ELIMINADO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `user_state_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companies_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `rol_id`, `user_state_id`, `name`, `lastname`, `email`, `phone`, `companies_id`, `created`, `modified`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, 'ADMIN', 'ADMIN', 'admin@gmail.com', '+569 123456789', 1, '2022-01-01 19:42:52', '2022-01-01 19:42:52'),
(2, 'BPlayer', '7aa31a570f3d61ea96bcd7f06bb8a7d2', 2, 1, 'Antonio', 'Farías', 'tiendabplayer@gmail.com', '978612572', 2, '2022-01-17 20:09:44', '2022-01-17 20:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_state`
--

CREATE TABLE `user_state` (
  `id` int(11) NOT NULL,
  `state` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_state`
--

INSERT INTO `user_state` (`id`, `state`) VALUES
(1, 'ACTIVO'),
(2, 'SUSPENDIDO'),
(3, 'ELIMINADO'),
(4, 'BLOQUEADO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communes`
--
ALTER TABLE `communes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies_state`
--
ALTER TABLE `companies_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people_states`
--
ALTER TABLE `people_states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state` (`state`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_delivery`
--
ALTER TABLE `shipping_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_states`
--
ALTER TABLE `shipping_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_state`
--
ALTER TABLE `user_state`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `communes`
--
ALTER TABLE `communes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies_state`
--
ALTER TABLE `companies_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `people_states`
--
ALTER TABLE `people_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shipping_delivery`
--
ALTER TABLE `shipping_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_states`
--
ALTER TABLE `shipping_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_state`
--
ALTER TABLE `user_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
