-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2024 a las 18:38:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `daño` int(11) NOT NULL,
  `cant_balas` int(11) NOT NULL,
  `arma` varchar(200) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `armas`
--

INSERT INTO `armas` (`id_arma`, `id_tipo_arma`, `nomb_arma`, `daño`, `cant_balas`, `arma`, `id_estado`) VALUES
(1, 1, 'Puño', 5, 999, 'imagen puño', 5),
(2, 1, 'Cuchillo', 5, 999, 'imagen cuchillo', 5),
(3, 1, 'espada', 5, 999, 'imagen espada', 5),
(4, 2, 'revolver', 8, 15, 'imagen revolver', 5),
(5, 2, 'Walther', 8, 20, 'imagen walther', 5),
(6, 2, 'jericho', 8, 20, 'imagen jerich', 5),
(7, 3, 'ametralladora ligera', 15, 16, 'imagen ame_ligera', 5),
(8, 3, 'AK 47', 15, 20, 'imagen ak', 5),
(9, 3, 'Ametralladora', 15, 20, 'imagen ametra', 5),
(10, 4, 'uzi', 12, 20, 'imagen uzi', 6),
(11, 4, 'mini uzi', 12, 20, 'imagen mini', 6),
(12, 4, 'MP 40', 12, 20, 'imagen MP', 6),
(13, 5, 'monotiro', 20, 8, 'imagen mono', 6),
(14, 5, 'semiautomatica', 20, 8, 'imagen semiauto', 6),
(15, 5, 'escopeta recortada', 20, 12, 'imagen esco_recort', 6),
(16, 6, 'Franco cerrojo', 20, 8, 'imagen_cerrojo', 6),
(17, 6, 'rifle Francotirador', 20, 8, 'imagen franco', 6),
(18, 6, 'FrancoEscopeta', 20, 8, 'imagen francoesco', 6),
(19, 7, 'lanza cohetes', 25, 6, 'imagen lanza_co', 6),
(20, 7, 'Minigum', 25, 6, 'imagen minigum', 6),
(21, 7, 'lanzallamas', 25, 6, 'imagen lanza', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avatares`
--

CREATE TABLE `avatares` (
  `id_avatar` int(11) NOT NULL,
  `avatar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `avatares`
--

INSERT INTO `avatares` (`id_avatar`, `avatar`) VALUES
(1, 'imagen avatar 1'),
(2, 'Imagen avatar 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Vivo'),
(4, 'Eliminado'),
(5, 'disponible'),
(6, 'No disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jug` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `vida` int(11) NOT NULL,
  `id_arma` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mundos`
--

CREATE TABLE `mundos` (
  `id_mundo` int(11) NOT NULL,
  `nomb_mundo` varchar(20) NOT NULL,
  `mundo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `mundos`
--

INSERT INTO `mundos` (`id_mundo`, `nomb_mundo`, `mundo`) VALUES
(1, 'Bermuda', 'Imagen B'),
(2, 'Purgatorio', 'imagen P'),
(3, 'Nexterra', 'imagen N'),
(4, 'Alpes', 'imagen A'),
(5, 'Kalahari', 'imagen K');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id_partida` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_mundo` int(11) NOT NULL,
  `duracion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rangos`
--

CREATE TABLE `rangos` (
  `id_rango` int(11) NOT NULL,
  `nomb_rango` varchar(20) NOT NULL,
  `rango` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rangos`
--

INSERT INTO `rangos` (`id_rango`, `nomb_rango`, `rango`) VALUES
(1, 'Oro 1', 'fsasafsafa'),
(2, 'Oro 2', 'safjksalfkaslf');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id_sala` int(11) NOT NULL,
  `max_jug` int(11) NOT NULL,
  `num_jug` int(11) NOT NULL,
  `id_mundo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id_sala`, `max_jug`, `num_jug`, `id_mundo`) VALUES
(1, 5, 5, 1),
(2, 5, 1, 2),
(3, 5, 0, 3),
(4, 5, 0, 4),
(5, 5, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_armas`
--

CREATE TABLE `tipo_armas` (
  `id_tipo_arma` int(11) NOT NULL,
  `tipo_arma` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_armas`
--

INSERT INTO `tipo_armas` (`id_tipo_arma`, `tipo_arma`) VALUES
(1, 'cuerpo a cuerpo'),
(2, 'pistola'),
(3, 'asalto'),
(4, 'subfusil'),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL,
  `id_avatar` varchar(200) NOT NULL,
  `id_rango` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `f_ingreso` date NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `username`, `edad`, `id_avatar`, `id_rango`, `puntos`, `nivel`, `correo`, `contrasena`, `f_ingreso`, `id_estado`, `id_tipo_user`) VALUES
(1, 'pablito', 45, '2', 1, 0, 12, 'yiycardenal@gmail.com', '$2y$10$4OXLqXDpfWdXxCf6ElFbC.fF/iAUEVaRXmUCzPFW/RBLgqqOloeqm', '2024-04-08', 1, 2),
(2, 'cielito', 48, '1', 1, 0, 18, 'cielito@gmail.com', '$2y$10$B.ZVSi9c5JO3eiHyVtlCxOEL03VYqn0ylRWGcz0grbbdfBTWRIxA2', '2024-04-08', 1, 2);

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
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `armas`
--
ALTER TABLE `armas`
  MODIFY `id_arma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `avatares`
--
ALTER TABLE `avatares`
  MODIFY `id_avatar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `mundos`
--
ALTER TABLE `mundos`
  MODIFY `id_mundo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rangos`
--
ALTER TABLE `rangos`
  MODIFY `id_rango` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
