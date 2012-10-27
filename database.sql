-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2012 at 07:24 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evernoteucab`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjunto`
--

CREATE TABLE IF NOT EXISTS `adjunto` (
  `id_adjunto` int(3) NOT NULL AUTO_INCREMENT,
  `link` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_adjunto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `adjunto`
--

INSERT INTO `adjunto` (`id_adjunto`, `link`, `nombre`) VALUES
(1, 'prueba', 'prueba'),
(2, 'travel_0045.jpg', 'travel_0045.jpg'),
(3, 'travel_0040.jpg', 'travel_0040.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `id_etiqueta` int(3) NOT NULL AUTO_INCREMENT,
  `texto` varchar(30) NOT NULL,
  PRIMARY KEY (`id_etiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `etiqueta`
--


-- --------------------------------------------------------

--
-- Table structure for table `libreta`
--

CREATE TABLE IF NOT EXISTS `libreta` (
  `id_libreta` int(3) NOT NULL AUTO_INCREMENT,
  `fk_usuario` int(3) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(3000) NOT NULL,
  PRIMARY KEY (`id_libreta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `libreta`
--

INSERT INTO `libreta` (`id_libreta`, `fk_usuario`, `nombre`, `fecha`, `descripcion`) VALUES
(17, 1, 'Nota De Prueba', '2012-10-27', 'Esta Nota tiene como finalidad una prueba del funcionamiento de la creacion de libretas'),
(18, 30, 'Prueba de Notas de Luis', '2012-10-27', 'Esta es una Libreta de prueba de Luis'),
(20, 29, 'Nota De Prueba', '2012-10-27', 'prueba');

-- --------------------------------------------------------

--
-- Table structure for table `libreta_nota`
--

CREATE TABLE IF NOT EXISTS `libreta_nota` (
  `fk_libreta` int(11) NOT NULL,
  `fk_nota` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  KEY `fk_libreta` (`fk_libreta`),
  KEY `fk_nota` (`fk_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libreta_nota`
--


-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `id_nota` int(3) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) NOT NULL,
  `texto` varchar(5000) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `id_libreta` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `id_libreta` (`id_libreta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `titulo`, `texto`, `fecha_creacion`, `id_libreta`) VALUES
(1, 'Nota de Prueba', 'Esta nota es una prueba del funcionamiento de a creacion de las notas ', '2012-10-27', 17),
(4, 'Nota de Prueba para Luis', 'Nota de prueba de luis', '2012-10-27', 18),
(6, 'prueba', 'prueba', '2012-10-27', 20);

-- --------------------------------------------------------

--
-- Table structure for table `nota_adjunto`
--

CREATE TABLE IF NOT EXISTS `nota_adjunto` (
  `fk_nota` int(11) NOT NULL,
  `fk_adjunto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  KEY `fk_nota` (`fk_nota`),
  KEY `fk_adjunto` (`fk_adjunto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_adjunto`
--


-- --------------------------------------------------------

--
-- Table structure for table `nota_etiqueta`
--

CREATE TABLE IF NOT EXISTS `nota_etiqueta` (
  `cantidad` int(11) NOT NULL,
  `fk_nota` int(11) NOT NULL,
  `fk_etiqueta` int(11) NOT NULL,
  KEY `fk_nota` (`fk_nota`),
  KEY `fk_etiqueta` (`fk_etiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_etiqueta`
--


-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `oauth_token` varchar(50) NOT NULL,
  `oauth_token_secret` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `username`, `email`, `password`, `oauth_token`, `oauth_token_secret`) VALUES
(1, 'abel', 'osorio', 'osorioabel', 'osorioabel@gmail.com', '490263', 'wmy42p83xmd0ym0', 'pagkcmhogvvslfh'),
(29, 'hector', 'matheus', 'hjmatheus', 'hjmatheus@hotmail.com', '123456', '37mtzwo6zn7t57p', 'bo9k7ehha4o2mwe'),
(30, 'luis', 'tovar', 'lucholj', 'lucholj@gmail.com', '123456', 'whor45awf4x9mjp', 'hlwqcfzseas0thd');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `libreta_nota`
--
ALTER TABLE `libreta_nota`
  ADD CONSTRAINT `libreta_nota_ibfk_5` FOREIGN KEY (`fk_libreta`) REFERENCES `libreta` (`id_libreta`) ON DELETE CASCADE,
  ADD CONSTRAINT `libreta_nota_ibfk_6` FOREIGN KEY (`fk_nota`) REFERENCES `nota` (`id_nota`) ON DELETE CASCADE;

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_libreta`) REFERENCES `libreta` (`id_libreta`) ON DELETE CASCADE;

--
-- Constraints for table `nota_adjunto`
--
ALTER TABLE `nota_adjunto`
  ADD CONSTRAINT `nota_adjunto_ibfk_1` FOREIGN KEY (`fk_nota`) REFERENCES `nota` (`id_nota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_adjunto_ibfk_2` FOREIGN KEY (`fk_adjunto`) REFERENCES `adjunto` (`id_adjunto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nota_etiqueta`
--
ALTER TABLE `nota_etiqueta`
  ADD CONSTRAINT `nota_etiqueta_ibfk_3` FOREIGN KEY (`fk_nota`) REFERENCES `nota` (`id_nota`) ON DELETE CASCADE,
  ADD CONSTRAINT `nota_etiqueta_ibfk_4` FOREIGN KEY (`fk_etiqueta`) REFERENCES `etiqueta` (`id_etiqueta`) ON DELETE CASCADE;
