-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2024 a las 05:21:39
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reto_free`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armas`
--

CREATE TABLE `armas` (
  `id_arma` int(11) NOT NULL,
  `id_tipo_arma` int(11) NOT NULL,
  `nomb_arma` varchar(20) NOT NULL,
  `dano` int(11) NOT NULL,
  `cant_balas` int(11) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `puntos` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `armas`
--

INSERT INTO `armas` (`id_arma`, `id_tipo_arma`, `nomb_arma`, `dano`, `cant_balas`, `imagen`, `puntos`, `id_estado`) VALUES
(1, 1, 'Puño', 1, 999, '../../../img/armas/puño.png', 1, 5),
(2, 2, 'Pistola', 2, 20, '../../../img/armas/pistola.png', 2, 5),
(3, 4, 'Ametralladora', 10, 15, '../../../img/armas/ametralladora.png', 10, 6),
(4, 6, 'Francotirador', 20, 8, '../../../img/armas/franco.png', 20, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avatares`
--

CREATE TABLE `avatares` (
  `id_avatar` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `avatares`
--

INSERT INTO `avatares` (`id_avatar`, `nombre`, `imagen`) VALUES
(1, 'La chiqui', '../../../img/avatares/la chiqui.jpg'),
(2, 'Ninja', '../../../img/avatares/Ninja.jpg'),
(3, 'Kual', '../../../img/avatares/El brayan.jpg'),
(4, 'Xhao', '../../../img/avatares/dib.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Vivo'),
(4, 'Eliminado'),
(5, 'Disponible'),
(6, 'No disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jug` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `vida` int(11) NOT NULL,
  `dano_real` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mundos`
--

CREATE TABLE `mundos` (
  `id_mundo` int(11) NOT NULL,
  `nomb_mundo` varchar(20) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mundos`
--

INSERT INTO `mundos` (`id_mundo`, `nomb_mundo`, `imagen`, `id_estado`) VALUES
(1, 'Bermuda', '../../../img/mapas/bermuda.jpg', 5),
(2, 'Purgatorio', '../../../img/mapas/purgatorio.jpg', 6),
(3, 'Nexterra', '../../../img/mapas/nexterra.png', 6),
(4, 'Alpes', '../../../img/mapas/alpes.jpg', 6),
(5, 'Kalahari', '../../../img/mapas/kalahari.jpg', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id_partida` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `puntos` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `duracion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id_partida`, `id_sala`, `username`, `puntos`, `kills`, `duracion`) VALUES
(25, 34, 'cielito', 0, 0, '00:00:00'),
(26, 34, 'cielito', 0, 1, '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rangos`
--

CREATE TABLE `rangos` (
  `id_rango` int(11) NOT NULL,
  `nomb_rango` varchar(20) NOT NULL,
  `imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rangos`
--

INSERT INTO `rangos` (`id_rango`, `nomb_rango`, `imagen`) VALUES
(1, 'Oro I', '../../../img/rangos/oro.png'),
(2, 'Platino', '../../../img/rangos/platino.png'),
(3, 'Diamante', '../../../img/rangos/diamante.png'),
(4, 'Heroico', '../../../img/rangos/Heroico.png'),
(5, 'Maestro', '../../../img/rangos/gran maestro.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_mundo` int(11) NOT NULL,
  `id_arma` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `punt_obten` int(11) NOT NULL,
  `tiros_cabeza` int(11) NOT NULL,
  `tiros_cuerpo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id_sala` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `num_jug` int(11) NOT NULL,
  `id_mundo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id_sala`, `nivel`, `num_jug`, `id_mundo`) VALUES
(33, 1, 4, 2),
(34, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_armas`
--

CREATE TABLE `tipo_armas` (
  `id_tipo_arma` int(11) NOT NULL,
  `tipo_arma` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_armas`
--

INSERT INTO `tipo_armas` (`id_tipo_arma`, `tipo_arma`) VALUES
(1, 'cuerpo a cuerpo'),
(2, 'pistola'),
(3, 'asalto'),
(4, 'Ametralladora'),
(5, 'escopeta'),
(6, 'francotirador'),
(7, 'pesada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_user`
--

CREATE TABLE `tipo_user` (
  `id_tipo_user` int(11) NOT NULL,
  `tipo_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_user`
--

INSERT INTO `tipo_user` (`id_tipo_user`, `tipo_user`) VALUES
(1, 'administrador'),
(2, 'jugador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `username` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL,
  `id_avatar` varchar(200) NOT NULL,
  `id_rango` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `f_ingreso` date NOT NULL,
  `token` varchar(20) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`username`, `edad`, `id_avatar`, `id_rango`, `puntos`, `nivel`, `correo`, `contrasena`, `f_ingreso`, `token`, `id_estado`, `id_tipo_user`) VALUES
('cielito', 48, '1', 1, 0, 1, 'cielito@gmail.com', '$2y$10$B.ZVSi9c5JO3eiHyVtlCxOEL03VYqn0ylRWGcz0grbbdfBTWRIxA2', '2024-04-08', '', 1, 2),
('jeferson', 18, '2', 1, 0, 1, 'jefryoffroad@gmail.com', '$2y$10$hfjhvnD/IvKvUEDF96EK3u1jymllzXa90/7n3kcNOYE.wYtJOxUnq', '2024-04-22', '', 1, 1),
('pablito', 45, '2', 1, 0, 1, 'yiycardenal@gmail.com', '$2y$10$4OXLqXDpfWdXxCf6ElFbC.fF/iAUEVaRXmUCzPFW/RBLgqqOloeqm', '2024-04-08', '', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `armas`
--
ALTER TABLE `armas`
  ADD PRIMARY KEY (`id_arma`);

--
-- Indices de la tabla `avatares`
--
ALTER TABLE `avatares`
  ADD PRIMARY KEY (`id_avatar`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jug`);

--
-- Indices de la tabla `mundos`
--
ALTER TABLE `mundos`
  ADD PRIMARY KEY (`id_mundo`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id_partida`);

--
-- Indices de la tabla `rangos`
--
ALTER TABLE `rangos`
  ADD PRIMARY KEY (`id_rango`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id_sala`);

--
-- Indices de la tabla `tipo_armas`
--
ALTER TABLE `tipo_armas`
  ADD PRIMARY KEY (`id_tipo_arma`);

--
-- Indices de la tabla `tipo_user`
--
ALTER TABLE `tipo_user`
  ADD PRIMARY KEY (`id_tipo_user`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `armas`
--
ALTER TABLE `armas`
  MODIFY `id_arma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `avatares`
--
ALTER TABLE `avatares`
  MODIFY `id_avatar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `mundos`
--
ALTER TABLE `mundos`
  MODIFY `id_mundo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `rangos`
--
ALTER TABLE `rangos`
  MODIFY `id_rango` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `tipo_armas`
--
ALTER TABLE `tipo_armas`
  MODIFY `id_tipo_arma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_user`
--
ALTER TABLE `tipo_user`
  MODIFY `id_tipo_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
