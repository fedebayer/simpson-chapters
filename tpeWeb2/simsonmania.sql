-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2021 a las 18:45:54
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simsonmania`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo`
--

CREATE TABLE `capitulo` (
  `id_capitulo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `temporada` varchar(100) NOT NULL,
  `estreno` date NOT NULL,
  `gag` text NOT NULL,
  `id_director` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `capitulo`
--

INSERT INTO `capitulo` (`id_capitulo`, `nombre`, `temporada`, `estreno`, `gag`, `id_director`) VALUES
(2, 'La casita del horror VII', 'Temporada 8', '1996-10-27', 'La muerte está sentada en el sofá, y mata a la familia a medida que llegan.', 1),
(3, 'El cuarteto de Homero', 'Temporada 5', '1993-09-30', 'Salen tres tomas de diferentes gags, de los cuales todos acaban mal: Primero: Todos cuando se chocan se rompen, Segundo: Todo ropa y cuerpo cambia de lugar y está enredado y Tercero: Todos cuando chocan explotan.', 1),
(44, 'asfasgfas', 'aaaaa', '2021-09-09', 's', 2),
(45, 'Quimica', 'aaa', '2021-09-01', 'sss', 9),
(87, 'testeado', 'testeado', '2021-10-27', 'testeado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE `director` (
  `id_director` int(11) NOT NULL,
  `nombre_director` varchar(100) NOT NULL,
  `biografia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `director`
--

INSERT INTO `director` (`id_director`, `nombre_director`, `biografia`) VALUES
(1, 'Mike B. Anderson', 'es un director de televisión estadounidense, reconocido principalmente por su trabajo en la serie animada Los Simpson. Ha dirigido varios episodios del programa, e incluso fue animado en el episodio La guerra secreta de Lisa Simpson como el cadete Anderson.'),
(2, 'Mark Kirkland', 'Mark Kirkland es el director de numerosos episodios de la serie animada Los Simpson. En 2005, había dirigido 58 episodios, más que cualquier otro director, siendo una cantidad similar a los episodios escritos por John Swartzwelder. También estuvo trabajando en el programa como director durante más tiempo que el resto de los creadores, con la excepción de David Silverman, ya que dirigió episodios desde la segunda temporada. '),
(7, 'PruebaDirector1', 'aaaaaaaaaaaaaaa'),
(9, 'PruebaDirector3', 'bbbbbbbbbbbbbbbbbbb'),
(14, 'aaaasss', 'aaaaaassss');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guionista`
--

CREATE TABLE `guionista` (
  `id_guionista` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `guionista`
--

INSERT INTO `guionista` (`id_guionista`, `nombre`) VALUES
(1, 'Ken Keeler'),
(2, 'Dan Greaney'),
(3, 'David S. Cohen'),
(4, 'Jeff Martin'),
(5, 'ads');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guionista_de_x_capitulo`
--

CREATE TABLE `guionista_de_x_capitulo` (
  `id_guionista_x_capitulo` int(11) NOT NULL,
  `id_capitulo` int(11) NOT NULL,
  `id_guionista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `guionista_de_x_capitulo`
--

INSERT INTO `guionista_de_x_capitulo` (`id_guionista_x_capitulo`, `id_capitulo`, `id_guionista`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 45, 5),
(6, 45, 2),
(21, 87, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `capitulo`
--
ALTER TABLE `capitulo`
  ADD PRIMARY KEY (`id_capitulo`),
  ADD KEY `fk_capitulos_directores` (`id_director`);

--
-- Indices de la tabla `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `guionista`
--
ALTER TABLE `guionista`
  ADD PRIMARY KEY (`id_guionista`);

--
-- Indices de la tabla `guionista_de_x_capitulo`
--
ALTER TABLE `guionista_de_x_capitulo`
  ADD PRIMARY KEY (`id_guionista_x_capitulo`),
  ADD KEY `fk_guionistas_de_x_capitulo_guionistas` (`id_guionista`),
  ADD KEY `fk_guionistas_de_x_capitulo_capitulos` (`id_capitulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `capitulo`
--
ALTER TABLE `capitulo`
  MODIFY `id_capitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `director`
--
ALTER TABLE `director`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `guionista`
--
ALTER TABLE `guionista`
  MODIFY `id_guionista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `guionista_de_x_capitulo`
--
ALTER TABLE `guionista_de_x_capitulo`
  MODIFY `id_guionista_x_capitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capitulo`
--
ALTER TABLE `capitulo`
  ADD CONSTRAINT `fk_capitulos_directores` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`);

--
-- Filtros para la tabla `guionista_de_x_capitulo`
--
ALTER TABLE `guionista_de_x_capitulo`
  ADD CONSTRAINT `fk_guionistas_de_x_capitulo_capitulos` FOREIGN KEY (`id_capitulo`) REFERENCES `capitulo` (`id_capitulo`),
  ADD CONSTRAINT `fk_guionistas_de_x_capitulo_guionistas` FOREIGN KEY (`id_guionista`) REFERENCES `guionista` (`id_guionista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
