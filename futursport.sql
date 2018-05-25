-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2018 a las 09:42:47
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
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_competicio` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `cat_competicio`) VALUES
(4, 'Babys', NULL),
(5, 'Pre-benjamí', NULL),
(6, 'Benjamí', NULL),
(7, 'Aleví', NULL),
(8, 'Infantil', 1),
(9, 'Cadet', 1),
(10, 'Juvenils', 1),
(11, 'Amateur', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comarques`
--

CREATE TABLE `comarques` (
  `id` int(11) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
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
-- Estructura de tabla para la tabla `competicio`
--

CREATE TABLE `competicio` (
  `id` int(11) NOT NULL,
  `cat_competicio` tinyint(1) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `competicio`
--

INSERT INTO `competicio` (`id`, `cat_competicio`, `name`) VALUES
(1, 1, 'Divisió d\'Honor'),
(2, 1, 'Nacionals'),
(3, 1, 'Preferent'),
(4, 1, 'Primera '),
(5, 1, 'Segona'),
(6, 2, '1era Divisió'),
(7, 2, '2ona Divisió A'),
(8, 2, '2ona Divisió B'),
(9, 2, '3era Divisio'),
(10, 2, '1era Catalana'),
(11, 2, '2ona Catalana'),
(12, 2, '3era Catalana'),
(13, 2, '4rta Catalana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `body` text CHARACTER SET utf8,
  `img` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `id_user`, `body`, `img`, `url`, `date`) VALUES
(1, 27, 'Hola prova de nomes text', NULL, NULL, '2018-05-25 05:42:15'),
(2, 27, '', '/img/news/27IMAG1191_BURST002.jpg', NULL, '2018-05-25 05:42:39'),
(6, 27, '', NULL, '3R4jRKAORFI', '2018-05-25 05:46:43'),
(11, 27, 'text', '/img/news/27IMAG0229_BURST001.jpg', '3R4jRKAORFI', '2018-05-25 05:55:36'),
(12, 27, 'text', '/img/news/27IMAG0229_BURST001.jpg', NULL, '2018-05-25 05:55:47'),
(13, 27, 'text', NULL, '3R4jRKAORFI', '2018-05-25 05:55:53'),
(15, 27, 'dsddfsdfs', NULL, NULL, '2018-05-25 06:01:54'),
(16, 27, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estÃ¡ndar de las industrias desde el aÃ±o 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usÃ³ una galerÃ­a de textos y los mezclÃ³ de tal manera que logrÃ³ hacer un libro de textos especimen. No sÃ³lo sobreviviÃ³ 500 aÃ±os, sino que tambien ingresÃ³ como texto de relleno en documentos electrÃ³nicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creaciÃ³n de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y mÃ¡s recientemente con software de autoediciÃ³n, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', NULL, NULL, '2018-05-25 06:02:25'),
(20, 27, 'Es un hecho establecido hace demasiado tiempo que un lector se distraerÃ¡ con el contenido del texto de un sitio mientras que mira su diseÃ±o. El punto de usar Lorem Ipsum es que tiene una distribuciÃ³n mÃ¡s o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquÃ­, contenido aquÃ­\". Estos textos hacen parecerlo un espaÃ±ol que se puede leer. Muchos paquetes de autoediciÃ³n y editores de pÃ¡ginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una bÃºsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a travÃ©s de los aÃ±os, algunas veces por accidente, otras veces a propÃ³sito (por ejemplo insertÃ¡ndole humor y cosas por el estilo).', NULL, 'kb1Nzg13lL0', '2018-05-25 06:35:04'),
(21, 27, 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayorÃ­a sufriÃ³ alteraciones en alguna manera, ya sea porque se le agregÃ³ humor, o palabras aleatorias que no parecen ni un poco creÃ­bles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitÃ¡s estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el Ãºnico generador verdadero (vÃ¡lido) en la Internet. Usa un diccionario de mas de 200 palabras provenientes del latÃ­n, combinadas con estructuras muy Ãºtiles de sentencias, para generar texto de Lorem Ipsum que parezca razonable. Este Lorem Ipsum generado siempre estarÃ¡ libre de repeticiones, humor agregado o palabras no caracterÃ­sticas del lenguaje, etc.', NULL, NULL, '2018-05-25 06:35:21'),
(22, 27, 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayorÃ­a sufriÃ³ alteraciones en alguna manera, ya sea porque se le agregÃ³ humor, o palabras aleatorias que no parecen ni un poco creÃ­bles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitÃ¡s estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el Ãºnico generador verdadero (vÃ¡lido) en la Internet. Usa un diccionario de mas de 200 palabras provenientes del latÃ­n, combinadas con estructuras muy Ãºtiles de sentencias, para generar texto de Lorem Ipsum que parezca razonable. Este Lorem Ipsum generado siempre estarÃ¡ libre de repeticiones, humor agregado o palabras no caracterÃ­sticas del lenguaje, etc.', NULL, NULL, '2018-05-25 06:36:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player_position`
--

CREATE TABLE `player_position` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `player_position`
--

INSERT INTO `player_position` (`id`, `name`) VALUES
(1, 'Porter'),
(2, 'Lliure'),
(3, 'Central'),
(4, 'Lateral dret'),
(5, 'Lateral esquerra'),
(6, 'Pivot defenciu'),
(7, 'Interior dret'),
(8, 'Interior esquerra'),
(9, 'Extrem dret'),
(10, 'Extrem esquerra'),
(11, 'Delanter centre'),
(12, 'Mitja-punta'),
(13, 'Carrilero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player_profile`
--

CREATE TABLE `player_profile` (
  `id_user` int(11) NOT NULL,
  `team` varchar(100) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_competicio` int(11) DEFAULT NULL,
  `id_position` int(11) DEFAULT NULL,
  `age` smallint(2) DEFAULT NULL,
  `weight` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `player_profile`
--

INSERT INTO `player_profile` (`id_user`, `team`, `id_categoria`, `id_competicio`, `id_position`, `age`, `weight`) VALUES
(6, 'Escola de futbol Urgel', 8, 2, NULL, 14, 52.00),
(25, 'CE La Fuliola', 10, 3, NULL, 16, 95.00);

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
(5, '/img/5/2018-05-21_12h24_50.png', 2, 15, 'dfadfas', 'fasdfa', '973570123'),
(6, '/img/6/robin.jpg', 1, 2, 'La Fuliola', 'c/ arraval 34', '649008763'),
(24, '/img/24/nami.jpg', 1, 5, 'jjojio', 'huihiu', '973570123'),
(25, '/img/perfilAnonim.jpg', 4, 41, 'La Fuliola', 'c/ arraval 34', '669785232'),
(27, '/img/27/IMAG1191_BURST002.jpg', 2, 13, 'La Fuliola', 'c/ arraval 34', '649008763');

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
-- Estructura de tabla para la tabla `relations`
--

CREATE TABLE `relations` (
  `user_fan` int(11) NOT NULL,
  `user_pichichi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `relations`
--

INSERT INTO `relations` (`user_fan`, `user_pichichi`) VALUES
(5, 3),
(5, 6),
(5, 23),
(5, 24),
(5, 25),
(5, 26);

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
(3, 3, 'aficionat@aficionat.com', '$2y$10$EUr8dKecc16KYJlhk9c3EuqJH0M4oliZCIDVA1hAZqbpZZzWE1S66', 'aficionagt', 'fanatic'),
(5, 1, 'admin@admin.com', '$2y$10$B7RR9FmUDO3jUe1mKwFW8O/YAjeB1JqfwH7N55UzShZhu70pzx1XG', 'administrador', 'administrador'),
(6, 2, 'jugador@jugador.com', '$2y$10$VRIU8wNjIy0p3Mx70T9ZzOkY5htaZoOC3Pyz4LRBikboCpK48jWQS', 'jugad', 'jugador'),
(23, 2, 'prova@prova.com', '$2y$10$VAi04YtqFSjCd.MwwD/p2eL9f55WAsfg6a9nbe9bn9j2MszBF20DW', 'fadsafsd', 'fsadfa'),
(24, 3, 'estherfarre711@hotmail.com', '$2y$10$xEzb1ioEEvvA5tsB0z3PXeOdiFFXhUfntnkvO0X/04fuBtmmnTLjO', 'Marta', 'Fadsfasf'),
(25, 2, 'estic_com_una_puta_cabra@hotmail.com', '$2y$10$lSD0KL1NTe3EBFF4RGyn7.Dr7lgevVF75.J5irDsroxatCCGpL9Mi', 'Manel', 'Torres'),
(26, 3, 'esfa@gmai.com', '$2y$10$jmzE/.McvTuzbOTU0yv7lOQtdw/UDjOisXnU5cjNWsx5FpUy1u.wm', 'afdafdsa', 'fdsafa'),
(27, 2, 'prova@noticia.com', '$2y$10$nkPwhLdq2636AqCE0FEZx.PP71iF47ehyIGj9JVJMm/B7rOrOrNUO', 'marta', 'farre');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_competicio` (`cat_competicio`);

--
-- Indices de la tabla `comarques`
--
ALTER TABLE `comarques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_provincies` (`id_provincia`);

--
-- Indices de la tabla `competicio`
--
ALTER TABLE `competicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_competicio` (`cat_competicio`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `player_position`
--
ALTER TABLE `player_position`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `player_profile`
--
ALTER TABLE `player_profile`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `player_profile_ibfk_1` (`id_position`),
  ADD KEY `id_competicio` (`id_competicio`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_comarca` (`id_comarca`),
  ADD KEY `id_provincia` (`id_provincia`);

--
-- Indices de la tabla `provincies`
--
ALTER TABLE `provincies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `relations`
--
ALTER TABLE `relations`
  ADD KEY `user_fan` (`user_fan`),
  ADD KEY `user_pichichi` (`user_pichichi`);

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
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `comarques`
--
ALTER TABLE `comarques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `competicio`
--
ALTER TABLE `competicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `player_position`
--
ALTER TABLE `player_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comarques`
--
ALTER TABLE `comarques`
  ADD CONSTRAINT `comarques_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `player_profile`
--
ALTER TABLE `player_profile`
  ADD CONSTRAINT `player_profile_ibfk_1` FOREIGN KEY (`id_position`) REFERENCES `player_position` (`id`),
  ADD CONSTRAINT `player_profile_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `player_profile_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `player_profile_ibfk_4` FOREIGN KEY (`id_competicio`) REFERENCES `competicio` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profiles_ibfk_2` FOREIGN KEY (`id_comarca`) REFERENCES `comarques` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `profiles_ibfk_3` FOREIGN KEY (`id_provincia`) REFERENCES `provincies` (`id`);

--
-- Filtros para la tabla `relations`
--
ALTER TABLE `relations`
  ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`user_fan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`user_pichichi`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
