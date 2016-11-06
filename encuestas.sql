-- phpMyAdmin SQL Dump
-- version 4.4.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 04, 2015 at 03:59 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sa_lili`
--

-- --------------------------------------------------------

--
-- Table structure for table `encuesta`
--

CREATE TABLE IF NOT EXISTS `encuesta` (
  `id` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `hora_alta` time NOT NULL,
  `servicio` int(1) NOT NULL,
  `comida` int(1) NOT NULL,
  `limpieza` int(1) NOT NULL,
  `precio` int(1) NOT NULL,
  `edad` int(1) NOT NULL,
  `genero` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `encuesta`
--

INSERT INTO `encuesta` (`id`, `fecha_alta`, `hora_alta`, `servicio`, `comida`, `limpieza`, `precio`, `edad`, `genero`) VALUES
(1, '2015-11-03', '15:49:43', 3, 3, 3, 3, 3, 2),
(2, '2015-11-03', '15:50:01', 2, 3, 3, 3, 5, 1),
(3, '2015-11-03', '15:58:14', 3, 2, 4, 1, 4, 2),
(4, '2015-11-03', '17:22:07', 2, 4, 1, 5, 2, 2),
(5, '2015-11-03', '17:27:06', 5, 5, 5, 5, 2, 1),
(6, '2015-11-03', '17:30:14', 2, 4, 1, 1, 4, 2),
(7, '2015-11-03', '17:53:01', 5, 1, 4, 3, 2, 1),
(8, '2015-11-03', '17:53:10', 3, 4, 2, 5, 1, 1),
(9, '2015-11-03', '17:54:35', 4, 2, 5, 5, 3, 2),
(10, '2015-11-03', '17:54:44', 2, 5, 4, 5, 3, 2),
(11, '2015-11-03', '18:12:56', 4, 1, 5, 3, 3, 2),
(12, '2015-11-03', '18:52:54', 4, 4, 4, 4, 2, 2),
(13, '2015-11-03', '18:53:44', 2, 1, 1, 1, 2, 2),
(14, '2015-11-03', '19:06:47', 4, 2, 2, 5, 4, 2),
(15, '2015-11-03', '21:55:05', 2, 1, 5, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `contrasenia` varchar(32) NOT NULL,
  `esttaus` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
