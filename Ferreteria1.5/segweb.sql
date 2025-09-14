-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2020 a las 20:15:24
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `segweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

CREATE TABLE `aplicacion` (
  `Codigo` varchar(4) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Usuario_Crea` varchar(15) DEFAULT NULL,
  `Usuario_Modifica` varchar(15) DEFAULT NULL,
  `Usuario_Anula` varchar(15) DEFAULT NULL,
  `Fecha_Crea` datetime DEFAULT NULL,
  `Fecha_Modifica` datetime DEFAULT NULL,
  `Fecha_Anula` datetime DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aplicacion`
--

INSERT INTO `aplicacion` (`Codigo`, `Descripcion`, `Usuario_Crea`, `Usuario_Modifica`, `Usuario_Anula`, `Fecha_Crea`, `Fecha_Modifica`, `Fecha_Anula`, `Estado`) VALUES
('001', 'Molino', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('002', 'Compresor', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('003', 'Ventilador', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('004', 'Bomba Centrifuga', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('005', 'Bomba de Vacio', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('006', 'Polipasto', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('007', 'Centrifuga', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('008', 'Elevador', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('009', 'Turbo Generacion', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('010', 'Conjunto Electrogeno', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('011', 'Bandas Transportadoras', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('012', 'Desfibradora / Picadora', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('013', 'Extrusora', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A'),
('014', 'Otros', '31968445', NULL, NULL, '2014-06-01 00:00:00', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit`
--

CREATE TABLE `audit` (
  `registry_number` int(10) UNSIGNED NOT NULL,
  `entry_number` varchar(15) NOT NULL,
  `document_number` varchar(15) NOT NULL,
  `date` date DEFAULT NULL,
  `time_update` time DEFAULT NULL,
  `team` varchar(100) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `menu_option` varchar(100) DEFAULT NULL,
  `process` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `Nit_Empresa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costumer`
--

CREATE TABLE `costumer` (
  `nit_costumer` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `lastname_customer` varchar(50) DEFAULT NULL,
  `phone_customer` int(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `code_way_pay` int(11) DEFAULT NULL,
  `Column 9` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platform`
--

CREATE TABLE `platform` (
  `Id_platform` int(11) DEFAULT NULL,
  `plataform` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `platform`
--

INSERT INTO `platform` (`Id_platform`, `plataform`) VALUES
(1, 'Nintendo'),
(2, 'Xbox'),
(3, 'Play Station');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `code_product` int(11) NOT NULL,
  `product` varchar(50) DEFAULT NULL,
  `product_status` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`code_product`, `product`, `product_status`, `price`, `amount`, `description`) VALUES
(0, 'yyyy', 'Existente', 1, 123, '123'),
(9, '9', 'Existente', 99, 9, '123'),
(123, '123', 'Existente', 123, 1, ''),
(126, '123', 'Existente', 123, 1, '123'),
(213, '231', 'Existente', 234, 2, 'rwerwe'),
(321, '123', 'Existente', 123, 11, 'eso'),
(555, '5', 'Existente', 6, 1, 'qew'),
(777, '7', 'Existente', 7, 1, 'wertyu'),
(987, 'nintendo super', 'Existente', 5000000, 2, 'vea pues');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id_perfil` int(11) DEFAULT NULL,
  `profile_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `role` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `last_name` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `attempt` int(11) NOT NULL DEFAULT 0,
  `recover_acount` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `question` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `image_user` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role`, `name`, `last_name`, `status`, `email`, `attempt`, `recover_acount`, `question`, `answer`, `image_user`) VALUES
(1, 'prueba', '$2y$10$2a6123b6986029a2a4cf3uJs1yy39WHmi0mbwFSnpp2FlhB0xnOka', '2', 'best', 'decoder', 'A', 'jjdd1997@hotmail.com', 0, NULL, NULL, NULL, 'Naruto-imagen-prueba.jpg'),
(2, 'jose', '$2y$10$6fdc6d9b2828586040a24ONw0H.pv07dVV4ANlW7F6ypQfj3xBmF.', '1', 'Jose Daniel', 'Grijalba Osorio', 'A', 'jose.jdgo97@gmail.com', 0, NULL, NULL, NULL, 'Naruto-imagen-jose.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videogames`
--

CREATE TABLE `videogames` (
  `id` int(11) NOT NULL,
  `manufacturer` varchar(50) DEFAULT NULL,
  `game_mode` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `official_web` varchar(150) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `max_players` varchar(20) DEFAULT NULL,
  `release_year` varchar(20) DEFAULT NULL,
  `videogame_genre` varchar(50) DEFAULT NULL,
  `clasification` varchar(50) DEFAULT NULL,
  `difficulty` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `videogames`
--

INSERT INTO `videogames` (`id`, `manufacturer`, `game_mode`, `platform`, `name`, `official_web`, `image`, `description`, `max_players`, `release_year`, `videogame_genre`, `clasification`, `difficulty`) VALUES
(1, NULL, NULL, NULL, 'Mario Bros ', NULL, NULL, 'es un juego de aventuras donde vas en busca de salvar a la princesa peach', '4', '1995', 'aventura', '-18', '4'),
(2, 'Nintendo', '2d', 'Nintendo', 'Naruto', 'http://ww.nintendo.com', 'https://as.com/meristation/juegos/naruto_ultimate_ninja_storm/', 'Origen anime', '3', '2003', 'Accion', '18', '8'),
(3, 'EA', '3persona', 'Play Station', 'Fifa19', 'https://www.ea.com/es-es/games/fifa/fifa-19', 'https://i11b.3djuegos.com/juegos/15475/fifa_19/fotos/ficha/fifa_19-4645889.jpg', '', '1', '2019', 'arcade', '1-18', '8'),
(4, 'Rockstar Games', '1persona', 'Xbox', 'GTA5', 'https://www.rockstargames.com/V/restricted-content/agegate/form?redirect=https%3A%2F%2Fwww.rockstarg', 'https://hb.imgix.net/ad3f96dfd21531e24ab72c3821a01049c8484982.jpg?auto=compress,format&fit=crop&h=35', 'Es un juego no apto para todo el publico ya que contiene escenas de sexo y violencia', '2', '2014', 'Accion', '+18', '1-10'),
(8, 'Activision', '1persona', 'Play Station', 'Call Of Duty Black ops 3', 'https://www.callofduty.com/es/blackops3', 'https://s1.gaming-cdn.com/images/products/1302/orig/call-of-duty-black-ops-iii-nuketown-cover.jpg', 'Es un juego relativamente sangriento', '10', '2017', 'Accion', '+18', '1-10'),
(10, 'dfgh', 'vbnm', 'Nintendo', 'ertyu', 'vbnm', 'bnm', 'nm,', 'ghj', 'fghjk', 'erty', '6', '45678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`nit_costumer`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`code_product`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `videogames`
--
ALTER TABLE `videogames`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `videogames`
--
ALTER TABLE `videogames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
