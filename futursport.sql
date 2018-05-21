-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2018 a las 13:19:02
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `futursport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comarques`
--

CREATE TABLE `comarques` (
  `id` int(11) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comarques`
--

INSERT INTO `comarques` (`id`, `id_provincia`, `name`) VALUES
(1, 1, 'Alt Camp'),
(2, 1, 'Baix Camp'),
(3, 1, 'Baix Ebre'),
(4, 1, 'Baix Penedés'),
(5, 1, 'Conca de Barberà'),
(6, 1, 'Montsià'),
(7, 1, 'Priorat'),
(9, 1, 'Ribera d\'Ebre'),
(10, 1, 'Tarragonès'),
(11, 1, 'Terra Alta'),
(12, 2, 'Alt Empordà '),
(13, 2, 'Baix Empordà'),
(14, 2, 'Cerdanya'),
(15, 2, 'Garrotxa'),
(16, 2, 'Gironés'),
(17, 2, 'Pla de l\'Estany'),
(18, 2, 'Ripollés'),
(19, 2, 'Selva'),
(20, 3, 'Alt Penedés'),
(21, 3, 'Anoia'),
(22, 3, 'Bages'),
(23, 3, 'Baix Llobregat'),
(24, 3, 'Barcelonés'),
(25, 3, 'Berguedà'),
(26, 3, 'Garraf'),
(27, 3, 'Maresme'),
(28, 3, 'Osona'),
(29, 3, 'Solsonés'),
(30, 3, 'Vallés Occidental'),
(31, 3, 'Vallés Oriental'),
(32, 4, 'Alt Urgell'),
(33, 4, 'Alta Ribagorça'),
(34, 4, 'Garrigues'),
(35, 4, 'Noguera'),
(36, 4, 'Pallars Jussà'),
(37, 4, 'Pallars Sobirà'),
(38, 4, 'Pla d\'Urgell'),
(39, 4, 'Segarra'),
(40, 4, 'Segrià'),
(41, 4, 'Urgell'),
(42, 4, 'Val d\'Aran');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id_user` int(11) NOT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `id_provincia` int(11) NOT NULL,
  `id_comarca` int(11) DEFAULT NULL,
  `poblacio` varchar(200) DEFAULT NULL,
  `direccio` varchar(200) DEFAULT NULL,
  `telefon` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id_user`, `photo`, `id_provincia`, `id_comarca`, `poblacio`, `direccio`, `telefon`) VALUES
(21, 'C:\\xampp\\htdocs\\practicaFinal\\projecteFinal\\public\\img\\21\\', 2, 15, 'L', 'casdsfda', '973570123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincies`
--

CREATE TABLE `provincies` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincies`
--

INSERT INTO `provincies` (`id`, `name`) VALUES
(1, 'Tarragona'),
(2, 'Girona'),
(3, 'Barcelona'),
(4, 'Lleida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`, `description`) VALUES
(1, 'admin', 'administrador del sistema, pot gestionar els usuaris, les notices, en general totes les dades de l\'aplicació'),
(2, 'jugador', 'es l\'usuari estrella, l\'aplicació gira entron aquest tipus de usuari. Es tracta que aquest ususari és promocioni'),
(3, 'aficionat', 'És un altre tipus d\'usuari, aquest usuari seguirà les aventures i desventures dels seus jugadors favorits');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol_id`, `username`, `password`, `name`, `surname`) VALUES
(3, 3, 'aficionat@aficionat.com', '$2y$10$nmxCsUq/78Zew4h9xZTJ.u1b/E9RnAvDDs5ocJfix4C3TQTw3DyXK', 'aficionagt', 'fanatic'),
(5, 1, 'admin@admin.com', '$2y$10$B7RR9FmUDO3jUe1mKwFW8O/YAjeB1JqfwH7N55UzShZhu70pzx1XG', 'administrador', 'administrador'),
(6, 2, 'jugador@jugador.com', '$2y$10$VRIU8wNjIy0p3Mx70T9ZzOkY5htaZoOC3Pyz4LRBikboCpK48jWQS', 'jugad', 'jugador'),
(21, 2, 'prova@perfil.com', '$2y$10$iyUD.sH4mMAKfy/4.1s2TON47odxP4zEkxwzOFdApUaBUBZkcmTPq', 'Marta', 'Farre Llordes');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comarques`
--
ALTER TABLE `comarques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_provincies` (`id_provincia`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `provincies`
--
ALTER TABLE `provincies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comarques`
--
ALTER TABLE `comarques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `provincies`
--
ALTER TABLE `provincies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comarques`
--
ALTER TABLE `comarques`
  ADD CONSTRAINT `comarques_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincies` (`id`);

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
