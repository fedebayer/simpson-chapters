-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< Updated upstream
-- Generation Time: Oct 15, 2021 at 12:44 AM
=======
-- Generation Time: Nov 19, 2021 at 12:25 PM
>>>>>>> Stashed changes
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simsonmania`
--

-- --------------------------------------------------------

--
-- Table structure for table `capitulo`
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
-- Dumping data for table `capitulo`
--

INSERT INTO `capitulo` (`id_capitulo`, `nombre`, `temporada`, `estreno`, `gag`, `id_director`) VALUES
(2, 'La casita del horror VII', 'Temporada 8', '1996-10-27', 'La muerte está sentada en el sofá, y mata a la familia a medida que llegan.', 1),
(3, 'El cuarteto de Homero', 'Temporada 5', '1993-09-30', 'Salen tres tomas de diferentes gags, de los cuales todos acaban mal: Primero: Todos cuando se chocan se rompen, Segundo: Todo ropa y cuerpo cambia de lugar y está enredado y Tercero: Todos cuando chocan explotan.', 1),
(94, 'El patriotismo de Lisa', 'Temporada 3', '1991-09-26', 'La familia se sienta, y después Homer saca a Ayudante de Santa de debajo suyo.', 17),
(95, 'Tres sueños frustrados', 'Temporada 32', '2020-11-22', 'La familia se apresura a ir a casa a su sofá y este les dice rápidamente que \"vayan a dormir a la cama\" \r\ny se marchan con tristeza.', 18),
(96, 'Un momento de decisión', 'Temporada 1', '1990-03-18', 'Una escena conmovedora, en la que vemos a Homero y Marge reconciliándose, \r\ny además de la clara parodia a \"Un reto al destino.', 19),
(97, 'Tardes de Trueno', 'Temporada 3', '1991-11-14', 'Los almohadones no están, así que la familia cae dentro del mismo.', 20),
(98, 'Nuestros años felices', 'Temporada 2', '1991-03-28', 'La familia se encuentra al Abuelo dormido en el sillón.', 19);

-- --------------------------------------------------------

--
<<<<<<< Updated upstream
=======
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `comentarios` text NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `id_capitulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `comentarios`, `puntuacion`, `id_capitulo`, `id_usuario`) VALUES
(2, 'prueba1', 5, 3, 2);

-- --------------------------------------------------------

--
>>>>>>> Stashed changes
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id_director` int(11) NOT NULL,
  `nombre_director` varchar(100) NOT NULL,
  `biografia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`id_director`, `nombre_director`, `biografia`) VALUES
(1, 'Mike B. Anderson', 'Mike B. Anderson, en ocasiones conocido bajo el pseudónimo de Mikel B. Anderson, es un director de televisión estadounidense, reconocido principalmente por su trabajo en la serie animada Los Simpson.'),
(2, 'Mark Kirkland', 'Mark Kirkland es el director de numerosos episodios de la serie animada Los Simpson. En 2005, había dirigido 58 episodios, más que cualquier otro director, siendo una cantidad similar a los episodios escritos por John Swartzwelder. También estuvo trabajando en el programa como director durante más tiempo que el resto de los creadores, con la excepción de David Silverman, ya que dirigió episodios desde la segunda temporada. '),
(17, 'Wes Archer', 'Wesley Wes Meyer Archer es un director de televisión. Fue uno de los encargados de animación originales (junto con David Silverman y Bill Kopp) con los cortos de Los Simpson.'),
(18, 'Steven Dean Moore', 'Steven Dean Moore es un director de animación estadounidense, cuyo principal trabajo ha sido el de director en la serie de animación Los Simpson y en la película de la serie Los Simpson: la película.'),
(19, 'David Silverman', 'David Silverman es un productor y director de cine y televisión. Generalmente trabaja con películas con animación en 2D y 3D. Silverman se hizo conocido por su labor en la reconocida Serie animada Los Simpson en donde sirve como productor y director.'),
(20, 'Jim Reardon', 'Jim Reardon es un director y guionista reconocido por su trabajo en la serie animada Los Simpson. Ha dirigido más de treinta episodios de la serie y fue el director principal desde la novena temporada hasta la decimoquinta.');

-- --------------------------------------------------------

--
-- Table structure for table `guionista`
--

CREATE TABLE `guionista` (
  `id_guionista` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guionista`
--

INSERT INTO `guionista` (`id_guionista`, `nombre`) VALUES
(1, 'Ken Keeler'),
(2, 'Dan Greaney'),
(3, 'David S. Cohen'),
(4, 'Jeff Martin'),
(17, 'George Meyer'),
(18, 'Danielle Weisberg'),
(19, 'John Swartzwelder'),
(20, 'Ken Levine'),
(21, 'David Isaacs'),
(22, 'Jay Kogen'),
(23, 'Wallace Wolodarsky');

-- --------------------------------------------------------

--
-- Table structure for table `guionista_de_x_capitulo`
--

CREATE TABLE `guionista_de_x_capitulo` (
  `id_guionista_x_capitulo` int(11) NOT NULL,
  `id_capitulo` int(11) NOT NULL,
  `id_guionista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guionista_de_x_capitulo`
--

INSERT INTO `guionista_de_x_capitulo` (`id_guionista_x_capitulo`, `id_capitulo`, `id_guionista`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(39, 94, 17),
(40, 95, 18),
(41, 96, 19),
(42, 97, 20),
(43, 97, 21),
(44, 98, 22),
(45, 98, 23);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `rol`) VALUES
(2, 'prueba1@gmail.com', '$2y$10$c8IfwjqJZbajZlyN2HavYu3su8WqG/r56cWy5EKCU3R9966vSM7RG', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `capitulo`
--
ALTER TABLE `capitulo`
  ADD PRIMARY KEY (`id_capitulo`),
  ADD KEY `fk_capitulos_directores` (`id_director`);

--
<<<<<<< Updated upstream
=======
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_comentario_usuario` (`id_usuario`),
  ADD KEY `fk_comentario_capitulo` (`id_capitulo`);

--
>>>>>>> Stashed changes
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id_director`);

--
-- Indexes for table `guionista`
--
ALTER TABLE `guionista`
  ADD PRIMARY KEY (`id_guionista`);

--
-- Indexes for table `guionista_de_x_capitulo`
--
ALTER TABLE `guionista_de_x_capitulo`
  ADD PRIMARY KEY (`id_guionista_x_capitulo`),
  ADD KEY `fk_guionistas_de_x_capitulo_guionistas` (`id_guionista`),
  ADD KEY `fk_guionistas_de_x_capitulo_capitulos` (`id_capitulo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `capitulo`
--
ALTER TABLE `capitulo`
  MODIFY `id_capitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
<<<<<<< Updated upstream
=======

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
>>>>>>> Stashed changes

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `guionista`
--
ALTER TABLE `guionista`
  MODIFY `id_guionista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `guionista_de_x_capitulo`
--
ALTER TABLE `guionista_de_x_capitulo`
  MODIFY `id_guionista_x_capitulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `capitulo`
--
ALTER TABLE `capitulo`
  ADD CONSTRAINT `fk_capitulos_directores` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`);

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_capitulo` FOREIGN KEY (`id_capitulo`) REFERENCES `capitulo` (`id_capitulo`),
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `guionista_de_x_capitulo`
--
ALTER TABLE `guionista_de_x_capitulo`
  ADD CONSTRAINT `fk_guionistas_de_x_capitulo_capitulos` FOREIGN KEY (`id_capitulo`) REFERENCES `capitulo` (`id_capitulo`),
  ADD CONSTRAINT `fk_guionistas_de_x_capitulo_guionistas` FOREIGN KEY (`id_guionista`) REFERENCES `guionista` (`id_guionista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
