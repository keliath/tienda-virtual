-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2019 a las 02:11:17
-- Versión del servidor: 5.6.15-log
-- Versión de PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `protienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `id_carrit` int(11) NOT NULL AUTO_INCREMENT,
  `usu_mail` varchar(128) NOT NULL,
  `pro_codigo` varchar(32) NOT NULL,
  `car_cantid` int(11) NOT NULL,
  PRIMARY KEY (`id_carrit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `pro_codigo` varchar(32) NOT NULL,
  `com_precio` double NOT NULL,
  `com_pvp` double NOT NULL,
  `com_cantid` int(11) NOT NULL,
  `com_fecha` date NOT NULL,
  PRIMARY KEY (`id_compra`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denvio`
--

CREATE TABLE IF NOT EXISTS `denvio` (
  `id_denvio` int(11) NOT NULL AUTO_INCREMENT,
  `usu_mail` varchar(128) NOT NULL,
  `den_provin` varchar(64) NOT NULL,
  `den_ciudad` varchar(64) NOT NULL,
  `den_direcc` varchar(256) NOT NULL,
  `den_telefo` varchar(16) NOT NULL,
  PRIMARY KEY (`id_denvio`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id_factur` int(11) NOT NULL AUTO_INCREMENT,
  `usu_mail` varchar(128) NOT NULL,
  `fac_pagado` int(11) DEFAULT '0',
  `fac_fecha` date NOT NULL,
  PRIMARY KEY (`id_factur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodospago`
--

CREATE TABLE IF NOT EXISTS `metodospago` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `id_factur` int(11) NOT NULL,
  `met_nombre` varchar(32) NOT NULL,
  PRIMARY KEY (`id_pago`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `pro_codigo` varchar(32) NOT NULL,
  `pro_nombre` varchar(32) NOT NULL,
  `pro_descri` varchar(128) DEFAULT NULL,
  `pro_img` varchar(8) NOT NULL,
  `pro_catego` varchar(32) NOT NULL,
  `pro_fecha` date NOT NULL,
  PRIMARY KEY (`pro_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_mail` varchar(128) NOT NULL,
  `usu_nombre` varchar(32) NOT NULL,
  `usu_pass` varchar(128) NOT NULL,
  `usu_vercod` varchar(128) NOT NULL,
  `usu_activa` int(1) NOT NULL,
  `usu_nivel` varchar(32) NOT NULL,
  `usu_status` int(11) NOT NULL,
  `usu_change` int(11) NOT NULL,
  PRIMARY KEY (`usu_mail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_mail`, `usu_nombre`, `usu_pass`, `usu_vercod`, `usu_activa`, `usu_nivel`, `usu_status`, `usu_change`) VALUES
('mail1@gmail.com', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '1', 1, '0', 0, 0),
('mail2@gmail.com', 'user1', '81dc9bdb52d04dc20036dbd8313ed055', '1', 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `usu_mail` varchar(128) NOT NULL,
  `ven_fecha` date NOT NULL,
  `ven_cantid` int(11) NOT NULL,
  PRIMARY KEY (`id_venta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
