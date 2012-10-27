-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2012 at 06:13 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `titulo`, `texto`, `fecha_creacion`, `id_libreta`) VALUES
(1, 'Nota de Prueba', 'Esta nota es una prueba del funcionamiento de a creacion de las notas ', '2012-10-27', 17),
(4, 'Nota de Prueba para Luis', 'Nota de prueba de luis', '2012-10-27', 18),
(5, 'Nota de Prueba para Hector', 'Prueba de Nota ', '2012-10-27', 19);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_libreta`) REFERENCES `libreta` (`id_libreta`) ON DELETE CASCADE;
