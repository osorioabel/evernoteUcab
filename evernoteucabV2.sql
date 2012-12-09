-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2012 at 12:48 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `adjunto`
--

INSERT INTO `adjunto` (`id_adjunto`, `link`, `nombre`) VALUES
(1, '5_b.jpg', '5_b.jpg'),
(2, '5_b1.jpg', '5_b1.jpg'),
(3, '5_b2.jpg', '5_b2.jpg'),
(4, '5_b3.jpg', '5_b3.jpg'),
(5, '5_b.jpg', '5_b.jpg'),
(6, '5_b.jpg', '5_b.jpg'),
(7, '8_b.jpg', '8_b.jpg'),
(8, '8_b.jpg', '8_b.jpg'),
(9, '8_b.jpg', '8_b.jpg'),
(10, '8_b.jpg', '8_b.jpg'),
(11, '8_b.jpg', '8_b.jpg'),
(12, '6_b.jpg', '6_b.jpg'),
(13, '7_b.jpg', '7_b.jpg'),
(14, '8_b.jpg', '8_b.jpg'),
(15, '6_b.jpg', '6_b.jpg'),
(16, '7_b.jpg', '7_b.jpg'),
(17, '8_b.jpg', '8_b.jpg'),
(18, '8_b.jpg', '8_b.jpg'),
(19, '8_b.jpg', '8_b.jpg'),
(20, '8_b.jpg', '8_b.jpg'),
(21, '8_b.jpg', '8_b.jpg'),
(22, '8_b.jpg', '8_b.jpg'),
(23, '8_b.jpg', '8_b.jpg'),
(24, '8_b.jpg', '8_b.jpg'),
(25, '8_b.jpg', '8_b.jpg'),
(26, './subidos/5_b.jpg', './subidos/5_b.jpg'),
(27, '/subidos/5_b.jpg', '/subidos/5_b.jpg'),
(28, '/Applications/XAMPP/xamppfiles/htdocs/evernoteUcab/subidos/5_b.jpg', '/Applications/XAMPP/xamppfiles/htdocs/evernoteUcab/subidos/5_b.jpg'),
(29, '6_b.jpg', '6_b.jpg'),
(30, '7_b.jpg', '7_b.jpg'),
(31, '8_b.jpg', '8_b.jpg'),
(32, 'travel_0045.jpg', 'travel_0045.jpg'),
(33, 'travel_0083.jpg', 'travel_0083.jpg'),
(34, 'travel_0033.jpg', 'travel_0033.jpg'),
(35, 'travel_0017.jpg', 'travel_0017.jpg'),
(36, 'travel_00171.jpg', 'travel_00171.jpg'),
(37, 'travel_0001.jpg', 'travel_0001.jpg'),
(38, 'travel_00172.jpg', 'travel_00172.jpg'),
(39, 'travel_0028.jpg', 'travel_0028.jpg'),
(40, 'travel_00331.jpg', 'travel_00331.jpg'),
(41, 'travel_0001.jpg', 'travel_0001.jpg'),
(42, 'travel_00831.jpg', 'travel_00831.jpg'),
(43, 'travel_0001.jpg', 'travel_0001.jpg'),
(44, 'travel_0001.jpg', 'travel_0001.jpg'),
(45, 'travel_0001.jpg', 'travel_0001.jpg'),
(46, 'travel_0001.jpg', 'travel_0001.jpg'),
(47, 'travel_0017.jpg', 'travel_0017.jpg'),
(48, 'travel_0017.jpg', 'travel_0017.jpg'),
(49, 'travel_0001.jpg', 'travel_0001.jpg'),
(50, 'travel_0017.jpg', 'travel_0017.jpg'),
(51, 'travel_0028.jpg', 'travel_0028.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `id_etiqueta` int(3) NOT NULL AUTO_INCREMENT,
  `texto` varchar(30) NOT NULL,
  PRIMARY KEY (`id_etiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `etiqueta`
--

INSERT INTO `etiqueta` (`id_etiqueta`, `texto`) VALUES
(9, 'zzzz'),
(10, 'nada'),
(11, 'zzzz');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

--
-- Dumping data for table `libreta`
--

INSERT INTO `libreta` (`id_libreta`, `fk_usuario`, `nombre`, `fecha`, `descripcion`) VALUES
(1, 31, 'Mi Diario', '2012-12-08', 'Mi Dia a Dia '),
(24, 1, 'Diario', '2012-12-07', 'mis cosas personales'),
(999, 1, 'Prueba Unitaria', '2012-12-08', 'Parte de Las Pruebas Unitarias');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=236 ;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `titulo`, `texto`, `fecha_creacion`, `id_libreta`) VALUES
(31, 'Primera z', 'hola que tal ', '2012-12-07', 24),
(32, 'zzz', 'jjjajajaja', '2012-12-07', 24),
(33, 'assassa', 'asdasadddda', '2012-12-07', 24),
(49, 'prueba para busqueda', 'esta es la prueba de las pruebas ', '2012-12-08', 24),
(75, 'Lunes 2 de julio', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-07-02', 1),
(76, 'Martes 3 de julio', 'Me gane en un concurso un helado gratis y me lo comí antes de entrar a clase', '2012-07-03', 1),
(77, 'Miercoles 4 de julio', 'Llegue un poco tarde a la clase de Gestion el profesor no me dejo pasar, debo cuidarme de las inasistencias', '2012-07-04', 1),
(78, 'Jueves 5 de julio', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-07-05', 1),
(79, 'Viernes 6 de julio', 'Hoy hice ejercicio fui al gimnasio y trote en los proceres, me estoy preparando para la proxima carrera', '2012-07-06', 1),
(80, 'Sabado 7 de julio', 'Jugue futbolito en las horas libres con mis amigos de la universidad', '2012-07-07', 1),
(81, 'Domingo 8 de julio', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-07-08', 1),
(82, 'Lunes 9 de julio', 'Reserve las canchas de Directv para jugar el fin de semana con mis panas del edificio', '2012-07-07', 1),
(83, 'Martes 10 de julio', 'Fui al cine a ver la película de estreno', '2012-07-10', 1),
(84, 'Miercoles 11 de julio', 'Fui al Sambil a comprarme un par de zapatos nuevo, aprovechando los descuentos', '2012-07-11', 1),
(85, 'Jueves 12 de julio', 'Fui a almorzar en avila burguer y pedi mi hamburguesa favorita que tiene cebolla caramelizada', '2012-07-12', 1),
(86, 'Viernes 13 de julio', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-07-13', 1),
(87, 'Sabado 14 de julio', 'Fue un dia lluvioso por lo cual el trafico estuvo intratable todo el dia', '2012-07-14', 1),
(88, 'Domingo 15 de julio', 'Me toco hacer las labores de la casa, tuve que planchar, lavar la ropa y cocinar', '2012-07-15', 1),
(89, 'Lunes 16 de julio', 'Fui a mi restaurant favorito (Conos Temakeria) ubicado en las mercedes', '2012-07-16', 1),
(90, 'Martes 17 de julio', 'Falte a clases el cansancio acumulado no me permitio levantarme temprano', '2012-07-17', 1),
(91, 'Miercoles 18 de julio', 'En la noche jugue mis partidos correspondientes a el torneo de FIFA al que estoy inscrito', '2012-07-18', 1),
(92, 'Jueves 19 de julio', 'Lleve al carro a balancear y alinear los cauchos, aproveche en revisarle el aceite', '2012-07-19', 1),
(93, 'Viernes 20 de julio', 'Fui al banco a cancelar la deuda de las tarjetas de credito', '2012-07-20', 1),
(94, 'Sabado 21 de julio', 'Descubri una nueva red social y me cree una cuenta para experimentar que tal es', '2012-07-21', 1),
(95, 'Domingo 22 de julio', 'Me gane en un concurso un helado gratis y me lo comí antes de entrar a clase', '2012-07-22', 1),
(96, 'Lunes 23 de julio', 'Vi los episodios de mi serie favorita The Walking Dead que tenia grabados en mi decodificador', '2012-07-23', 1),
(97, 'Martes 24 de julio', 'Hoy hice ejercicio fui al gimnasio y trote en los proceres, me estoy preparando para la proxima carrera', '2012-07-24', 1),
(98, 'Miercoles 25 de julio', 'Me toco llevar a mi hermano a su entrenamiento de futbol', '2012-07-25', 1),
(99, 'Jueves 26 de julio', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-07-26', 1),
(100, 'Viernes 27 de julio', 'Visite a mi abuela, siempre es bueno compartir un poco con ella', '2012-07-27', 1),
(101, 'Sabado 28 de julio', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-07-28', 1),
(102, 'Domingo 29 de julio', 'Me reuni en lab de lab  a dedicarle horas a la programacion', '2012-07-29', 1),
(103, 'Lunes 30 de julio', 'Me toco hacer las labores de la casa, tuve que planchar, lavar la ropa y cocinar', '2012-07-30', 1),
(104, 'Martes 31 de julio', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-07-31', 1),
(105, 'Miercoles 1 de agosto', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-08-27', 1),
(106, 'Jueves 2 de agosto', 'Me reuni en lab de lab  a dedicarle horas a la programacion', '2012-08-27', 1),
(107, 'Viernes 3 de agosto', 'Fue un dia lluvioso por lo cual el trafico estuvo intratable todo el dia', '2012-08-27', 1),
(108, 'Sabado 4 de agosto', 'Fui a mi restaurant favorito (Conos Temakeria) ubicado en las mercedes', '2012-08-27', 1),
(109, 'Domingo 5 de agosto', 'Hoy hice ejercicio fui al gimnasio y trote en los proceres, me estoy preparando para la proxima carrera', '2012-08-27', 1),
(110, 'Lunes 6 de agosto', 'Falte a clases el cansancio acumulado no me permitio levantarme temprano', '2012-08-27', 1),
(111, 'Martes 7 de agosto', 'Fui al Sambil a comprarme un par de zapatos nuevo, aprovechando los descuentos', '2012-08-27', 1),
(112, 'Miercoles 8 de agosto', 'Llegue un poco tarde a la clase de Gestion el profesor no me dejo pasar, debo cuidarme de las inasistencias', '2012-08-27', 1),
(113, 'Jueves 9 de agosto', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-08-27', 1),
(114, 'Viernes 10 de agosto', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-08-27', 1),
(115, 'Sabado 11 de agosto', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-08-27', 1),
(116, 'Domingo 12 de agosto', 'Fui con mi primo a ver un partido de baseball de los leones del caracas', '2012-08-27', 1),
(117, 'Lunes 13 de agosto', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-08-27', 1),
(118, 'Martes 14 de agosto', 'Fue un dia lluvioso por lo cual el trafico estuvo intratable todo el dia', '2012-08-27', 1),
(119, 'Miercoles 15 de agosto', 'Vi los episodios de mi serie favorita The Walking Dead que tenia grabados en mi decodificador', '2012-08-27', 1),
(120, 'Jueves 16 de agosto', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-08-27', 1),
(121, 'Viernes 17 de agosto', 'Fui al cine a ver la película de estreno', '2012-08-27', 1),
(122, 'Sabado 18 de agosto', 'Falte a clases el cansancio acumulado no me permitio levantarme temprano', '2012-08-27', 1),
(123, 'Domingo 19 de agosto', 'Llegue un poco tarde a la clase de Gestion el profesor no me dejo pasar, debo cuidarme de las inasistencias', '2012-08-27', 1),
(124, 'Lunes 20 de agosto', 'Visite a mi abuela, siempre es bueno compartir un poco con ella', '2012-08-27', 1),
(125, 'Martes 21 de agosto', 'Jugue futbolito en las horas libres con mis amigos de la universidad', '2012-08-27', 1),
(126, 'Miercoles 22 de agosto', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-08-27', 1),
(127, 'Jueves 23 de agosto', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-08-27', 1),
(128, 'Viernes 24 de agosto', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-08-27', 1),
(129, 'Sabado 25 de agosto', 'En la noche jugue mis partidos correspondientes a el torneo de FIFA al que estoy inscrito', '2012-08-27', 1),
(130, 'Domingo 26 de agosto', 'Porfin logre subir un nivel en el juego de los Simpsons, cada vez son mas caras las cosas', '2012-08-27', 1),
(131, 'Lunes 27 de agosto', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-08-27', 1),
(132, 'Martes 28 de agosto', 'Me gane en un concurso un helado gratis y me lo comí antes de entrar a clase', '2012-08-27', 1),
(133, 'Miercoles 29 de agosto', 'Fui al banco a cancelar la deuda de las tarjetas de credito', '2012-08-31', 1),
(134, 'Jueves 30 de agosto', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-08-31', 1),
(135, 'Viernes 31 de agosto', 'Fui a mi restaurant favorito (Conos Temakeria) ubicado en las mercedes', '2012-08-31', 1),
(136, 'Sabado 1 de septiembre', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-09-27', 1),
(137, 'Domingo 2 de septiembre', 'Me toco hacer las labores de la casa, tuve que planchar, lavar la ropa y cocinar', '2012-09-27', 1),
(138, 'Lunes 3 de septiembre', 'Fui a almorzar en avila burguer y pedi mi hamburguesa favorita que tiene cebolla caramelizada', '2012-09-27', 1),
(139, 'Martes 4 de septiembre', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-09-27', 1),
(140, 'Miercoles 5 de septiembre', 'Visite a mi abuela, siempre es bueno compartir un poco con ella', '0000-00-00', 1),
(141, 'Jueves 6 de septiembre', 'Fue un dia lluvioso por lo cual el trafico estuvo intratable todo el dia', '0000-00-00', 1),
(142, 'Viernes 7 de septiembre', 'En la noche jugue mis partidos correspondientes a el torneo de FIFA al que estoy inscrito', '0000-00-00', 1),
(143, 'Sabado 8 de septiembre', 'Me reuni en lab de lab  a dedicarle horas a la programacion', '2012-09-27', 1),
(144, 'Domingo 9 de septiembre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-09-27', 1),
(145, 'Lunes 10 de septiembre', 'Falte a clases el cansancio acumulado no me permitio levantarme temprano', '2012-09-27', 1),
(146, 'Martes 11 de septiembre', 'Llegue un poco tarde a la clase de Gestion el profesor no me dejo pasar, debo cuidarme de las inasistencias', '2012-09-27', 1),
(147, 'Miercoles 12 de septiembre', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '0000-00-00', 1),
(148, 'Jueves 13 de septiembre', 'Fui a almorzar en avila burguer y pedi mi hamburguesa favorita que tiene cebolla caramelizada', '0000-00-00', 1),
(149, 'Viernes 14 de septiembre', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '0000-00-00', 1),
(150, 'Sabado 15 de septiembre', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-09-27', 1),
(151, 'Domingo 16 de septiembre', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-09-27', 1),
(152, 'Lunes 17 de septiembre', 'Me toco hacer las labores de la casa, tuve que planchar, lavar la ropa y cocinar', '2012-09-27', 1),
(153, 'Martes 18 de septiembre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-09-27', 1),
(154, 'Miercoles 19 de septiembre', 'Visite a mi abuela, siempre es bueno compartir un poco con ella', '0000-00-00', 1),
(155, 'Jueves 20 de septiembre', 'Fui al cine a ver la película de estreno', '0000-00-00', 1),
(156, 'Viernes 21 de septiembre', 'Vi los episodios de mi serie favorita The Walking Dead que tenia grabados en mi decodificador', '0000-00-00', 1),
(157, 'Sabado 22 de septiembre', 'En la noche jugue mis partidos correspondientes a el torneo de FIFA al que estoy inscrito', '2012-09-27', 1),
(158, 'Domingo 23 de septiembre', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-09-27', 1),
(159, 'Lunes 24 de septiembre', 'Descubri una nueva red social y me cree una cuenta para experimentar que tal es', '2012-09-27', 1),
(160, 'Martes 25 de septiembre', 'Fui a mi restaurant favorito (Conos Temakeria) ubicado en las mercedes', '2012-09-27', 1),
(161, 'Miercoles 26 de septiembre', 'Hice las tareas pendientes de Gestion de Proyectos', '2012-09-28', 1),
(162, 'Jueves 27 de septiembre', 'Jugue futbolito en las horas libres con mis amigos de la universidad', '2012-09-28', 1),
(163, 'Viernes 28 de septiembre', 'Pague la renta de mi celular', '2012-09-28', 1),
(164, 'Sabado 29 de septiembre', 'Me reuni en lab de lab  a dedicarle horas a la programacion', '2012-09-29', 1),
(165, 'Domingo 30 de septiembre', 'Hoy hice ejercicio fui al gimnasio y trote en los proceres, me estoy preparando para la proxima carrera', '0000-00-00', 1),
(166, 'Lunes 1 de octubre', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-10-22', 1),
(167, 'Martes 2 de octubre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-10-22', 1),
(168, 'Miercoles 3 de octubre', 'Fui con mi primo a ver un partido de baseball de los leones del caracas', '2012-10-22', 1),
(169, 'Jueves 4 de octubre', 'Fue un dia lluvioso por lo cual el trafico estuvo intratable todo el dia', '2012-10-22', 1),
(170, 'Viernes 5 de octubre', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-10-22', 1),
(171, 'Sabado 6 de octubre', 'Hoy hice ejercicio fui al gimnasio y trote en los proceres, me estoy preparando para la proxima carrera', '2012-10-22', 1),
(172, 'Domingo 7 de octubre', 'Porfin logre subir un nivel en el juego de los Simpsons, cada vez son mas caras las cosas', '2012-10-22', 1),
(173, 'Lunes 8 de octubre', 'Me toco llevar a mi hermano a su entrenamiento de futbol', '2012-10-22', 1),
(174, 'Martes 9 de octubre', 'Fui a almorzar en avila burguer y pedi mi hamburguesa favorita que tiene cebolla caramelizada', '2012-10-22', 1),
(175, 'Miercoles 10 de octubre', 'Fui a almorzar en avila burguer y pedi mi hamburguesa favorita que tiene cebolla caramelizada', '2012-10-22', 1),
(176, 'Jueves 11 de octubre', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-10-22', 1),
(177, 'Viernes 12 de octubre', 'Visite a mi abuela, siempre es bueno compartir un poco con ella', '2012-10-22', 1),
(178, 'Sabado 13 de octubre', 'Llegue un poco tarde a la clase de Gestion el profesor no me dejo pasar, debo cuidarme de las inasistencias', '2012-10-22', 1),
(179, 'Domingo 14 de octubre', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-10-22', 1),
(180, 'Lunes 15 de octubre', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-10-22', 1),
(181, 'Martes 16 de octubre', 'Hoy hice ejercicio fui al gimnasio y trote en los proceres, me estoy preparando para la proxima carrera', '2012-10-22', 1),
(182, 'Miercoles 17 de octubre', 'Vi los episodios de mi serie favorita The Walking Dead que tenia grabados en mi decodificador', '2012-10-22', 1),
(183, 'Jueves 18 de octubre', 'Falte a clases el cansancio acumulado no me permitio levantarme temprano', '2012-10-22', 1),
(184, 'Viernes 19 de octubre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-10-22', 1),
(185, 'Sabado 20 de octubre', 'En la noche jugue mis partidos correspondientes a el torneo de FIFA al que estoy inscrito', '2012-10-22', 1),
(186, 'Domingo 21 de octubre', 'Fui al cine a ver la película de estreno', '2012-10-22', 1),
(187, 'Lunes 22 de octubre', 'Vi el partido del real madrid', '2012-10-22', 1),
(188, 'Martes 23 de octubre', 'Fui a mi restaurant favorito (Conos Temakeria) ubicado en las mercedes', '2012-10-25', 1),
(189, 'Miercoles 24 de octubre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-10-25', 1),
(190, 'Jueves 25 de octubre', 'Llegue un poco tarde a la clase de Gestion el profesor no me dejo pasar, debo cuidarme de las inasistencias', '2012-10-25', 1),
(191, 'Viernes 26 de octubre', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-10-29', 1),
(192, 'Sabado 27 de octubre', 'Me reuni en lab de lab  a dedicarle horas a la programacion', '2012-10-29', 1),
(193, 'Domingo 28 de octubre', 'En la noche jugue mis partidos correspondientes a el torneo de FIFA al que estoy inscrito', '2012-10-29', 1),
(194, 'Lunes 22 de octubre', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-10-22', 1),
(195, 'Martes 23 de octubre', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-10-25', 1),
(196, 'Miercoles 24 de octubre', 'Fue un dia lluvioso por lo cual el trafico estuvo intratable todo el dia', '2012-10-25', 1),
(197, 'Jueves 25 de octubre', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-10-25', 1),
(198, 'Viernes 26 de octubre', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-10-29', 1),
(199, 'Sabado 27 de octubre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-10-29', 1),
(200, 'Domingo 28 de octubre', 'Visite a mi abuela, siempre es bueno compartir un poco con ella', '2012-10-29', 1),
(201, 'Lunes 29 de octubre', 'Me toco hacer las labores de la casa, tuve que planchar, lavar la ropa y cocinar', '2012-10-29', 1),
(202, 'Martes 30 de octubre', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-10-30', 1),
(203, 'Miercoles 31 de octubre', 'Hice las tareas pendientes de Gestion de Proyectos', '2012-10-31', 1),
(204, 'Jueves 1 de noviembre', 'Reserve las canchas de Directv para jugar el fin de semana con mis panas del edificio', '2012-11-25', 1),
(205, 'Viernes 2 de noviembre', 'Vi los episodios de mi serie favorita The Walking Dead que tenia grabados en mi decodificador', '2012-11-29', 1),
(206, 'Sabado 3 de noviembre', 'Falte a clases el cansancio acumulado no me permitio levantarme temprano', '2012-11-29', 1),
(207, 'Domingo 4 de noviembre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-11-29', 1),
(208, 'Lunes 29 de noviembre', 'Fui a almorzar en avila burguer y pedi mi hamburguesa favorita que tiene cebolla caramelizada', '2012-10-29', 1),
(209, 'Martes 30 de noviembre', 'Descubri una nueva red social y me cree una cuenta para experimentar que tal es', '2012-10-30', 1),
(210, 'Miercoles 31 de noviembre', 'Pague la renta de mi celular', '2012-10-31', 1),
(211, 'Jueves 1 de noviembre', 'Porfin logre subir un nivel en el juego de los Simpsons, cada vez son mas caras las cosas', '2012-11-25', 1),
(212, 'Viernes 2 de noviembre', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-11-29', 1),
(213, 'Sabado 3 de noviembre', 'Fue un dia lluvioso por lo cual el trafico estuvo intratable todo el dia', '2012-11-29', 1),
(214, 'Domingo 4 de noviembre', 'Fui al cine a ver la película de estreno', '2012-11-29', 1),
(215, 'Lunes 5 de noviembre', 'Fui al Sambil a comprarme un par de zapatos nuevo, aprovechando los descuentos', '2012-11-29', 1),
(216, 'Martes 6 de noviembre', 'Fue un dia con mucho trafico en caracas me tomo 3 horas llegar a mi casa', '2012-11-29', 1),
(217, 'Miercoles 7 de noviembre', 'Hice las tareas pendientes de Gestion de Proyectos', '2012-11-29', 1),
(218, 'Jueves 8 de noviembre', 'Hoy  fue dia de ir al mercado y comprar las cosas necesarias en la casa', '2012-11-29', 1),
(219, 'Viernes 9 de noviembre', 'Me reuni en lab de lab  a dedicarle horas a la programacion', '2012-11-29', 1),
(220, 'Sabado 10 de noviembre', 'En la noche jugue mis partidos correspondientes a el torneo de FIFA al que estoy inscrito', '2012-11-29', 1),
(221, 'Domingo 11 de noviembre', 'Fui al banco a cancelar la deuda de las tarjetas de credito', '2012-11-29', 1),
(222, 'Lunes 12 de noviembre', 'Me gane en un concurso un helado gratis y me lo comí antes de entrar a clase', '2012-11-29', 1),
(223, 'Martes 13 de noviembre', 'Jugue futbolito en las horas libres con mis amigos de la universidad', '2012-11-29', 1),
(224, 'Miercoles 14 de noviembre', 'Lleve al carro a balancear y alinear los cauchos, aproveche en revisarle el aceite', '2012-11-29', 1),
(225, 'Jueves 15 de noviembre', 'Tuve examen, estuvo algo complicado espero haber aprobado', '2012-11-29', 1),
(226, 'Viernes 16 de noviembre', 'Fui al cine a ver la película de estreno', '2012-11-29', 1),
(227, 'Sabado 17 de noviembre', 'Fui a almorzar en avila burguer y pedi mi hamburguesa favorita que tiene cebolla caramelizada', '2012-11-29', 1),
(228, 'Domingo 19 de noviembre', 'Reserve las canchas de Directv para jugar el fin de semana con mis panas del edificio', '2012-11-29', 1),
(229, 'Lunes 20 de noviembre', 'Llegue un poco tarde a la clase de Gestion el profesor no me dejo pasar, debo cuidarme de las inasistencias', '2012-11-29', 1),
(230, 'Martes 21 de noviembre', 'Falte a clases el cansancio acumulado no me permitio levantarme temprano', '2012-11-29', 1),
(231, 'Miercoles 22 de noviembre', 'Fui a mi restaurant favorito (Conos Temakeria) ubicado en las mercedes', '2012-11-29', 1),
(232, 'Jueves 23 de noviembre', 'Hoy hice ejercicio fui al gimnasio y trote en los proceres, me estoy preparando para la proxima carrera', '2012-11-29', 1),
(233, 'Viernes 24 de noviembre', 'Me toca ir a reunirme para terminar el proyecto de Distribuidos', '2012-11-29', 1),
(234, 'Sabado 25 de noviembre', 'Se fue la luz durante todo el dia, no pude trabajar con mi computadora', '2012-11-29', 1),
(235, 'Domingo 26 de noviembre', 'Me toco hacer las labores de la casa, tuve que planchar, lavar la ropa y cocinar', '2012-11-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nota_adjunto`
--

CREATE TABLE IF NOT EXISTS `nota_adjunto` (
  `fk_nota` int(11) NOT NULL,
  `fk_adjunto` int(11) NOT NULL,
  `fecha_adjunto` date NOT NULL,
  KEY `fk_nota` (`fk_nota`),
  KEY `fk_adjunto` (`fk_adjunto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_adjunto`
--

INSERT INTO `nota_adjunto` (`fk_nota`, `fk_adjunto`, `fecha_adjunto`) VALUES
(33, 6, '2012-12-08'),
(33, 25, '2012-12-08'),
(33, 26, '2012-12-08'),
(33, 27, '2012-12-08'),
(33, 28, '2012-12-08'),
(33, 29, '2012-12-08'),
(33, 30, '2012-12-08'),
(33, 31, '2012-12-08'),
(33, 32, '2012-12-08'),
(33, 33, '2012-12-08'),
(33, 34, '2012-12-08'),
(33, 35, '2012-12-08'),
(49, 36, '2012-12-09'),
(49, 37, '2012-12-09'),
(49, 38, '2012-12-09'),
(49, 39, '2012-12-09'),
(49, 40, '2012-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `nota_etiqueta`
--

CREATE TABLE IF NOT EXISTS `nota_etiqueta` (
  `fk_nota` int(11) NOT NULL,
  `fk_etiqueta` int(11) NOT NULL,
  KEY `fk_nota` (`fk_nota`),
  KEY `fk_etiqueta` (`fk_etiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_etiqueta`
--

INSERT INTO `nota_etiqueta` (`fk_nota`, `fk_etiqueta`) VALUES
(31, 9),
(32, 10),
(33, 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `username`, `email`, `password`, `oauth_token`, `oauth_token_secret`) VALUES
(1, 'abel', 'osorio', 'osorioabel', 'osorioabel@gmail.com', '490263', 'jngv108o72d124y', 'jzh7todplgmjf2p'),
(29, 'hector', 'matheus', 'hjmatheus', 'hjmatheus@hotmail.com', '123456', '37mtzwo6zn7t57p', 'bo9k7ehha4o2mwe'),
(30, 'luis', 'tovar', 'lucholj', 'lucholj@gmail.com', '123456', 'whor45awf4x9mjp', 'hlwqcfzseas0thd'),
(31, 'Carlos', 'Barroeta', 'carlosdbm.ucab', 'carlosdbm.ucab@gmail.com', '12345678', '1r8fiilhgehyc0i', 'o7nsi633jmxh9te');

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
