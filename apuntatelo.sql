-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-06-2024 a las 16:56:53
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apuntatelo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidad`
--

DROP TABLE IF EXISTS `cantidad`;
CREATE TABLE IF NOT EXISTS `cantidad` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `cant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `cantidad`
--

INSERT INTO `cantidad` (`id`, `cant`) VALUES
(1, 4),
(2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carpetas`
--

DROP TABLE IF EXISTS `carpetas`;
CREATE TABLE IF NOT EXISTS `carpetas` (
  `id_carpeta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) UNSIGNED NOT NULL COMMENT 'Usuario al cual pertenece la carpeta',
  `nom_carpeta` text NOT NULL COMMENT 'Nombre de la carpeta',
  PRIMARY KEY (`id_carpeta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` tinyint(3) NOT NULL AUTO_INCREMENT,
  `nom_categoria` varchar(20) DEFAULT NULL,
  `imagen` varchar(30) DEFAULT NULL,
  `link_categoria` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nom_categoria`, `imagen`, `link_categoria`) VALUES
(1, 'Apuntes', 'Apuntes.png', 'Apuntes'),
(2, 'Ebooks', 'Ebooks.png', 'Ebooks'),
(3, 'Ex&aacute;menes', 'Examenes.png', 'Examenes'),
(4, 'Info', 'Info-Universidades.png', 'Info-Universidades'),
(5, 'Soft', 'Softs-Estudiantiles.png', 'Softs-Estudiantiles'),
(6, 'Videos', 'Videos.png', 'Videos'),
(7, 'Biograf&iacute;as', 'Biografias.png', 'Biografias'),
(8, 'Tutoriales', 'Tutoriales.png', 'Tutoriales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `id_post` bigint(20) NOT NULL DEFAULT '0',
  `categoria` tinyint(4) NOT NULL DEFAULT '0',
  `id_autor` bigint(20) NOT NULL DEFAULT '0',
  `autor` varchar(25) NOT NULL DEFAULT '',
  `comentario` text NOT NULL,
  `elim` tinyint(4) NOT NULL DEFAULT '0',
  `id_modera` bigint(20) DEFAULT NULL,
  `modera` varchar(25) DEFAULT NULL,
  `causa` varchar(40) NOT NULL DEFAULT '',
  `fecha` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_post`, `categoria`, `id_autor`, `autor`, `comentario`, `elim`, `id_modera`, `modera`, `causa`, `fecha`) VALUES
(1, 1, 0, 1, 'Miguelithox', '', 1, 1, 'Miguelithox', 'Comentario vac&iacute;o.', '2024-05-16 11:40:54'),
(2, 1, 0, 1, 'Miguelithox', '', 1, 1, 'Miguelithox', 'Comentario vac&iacute;o.', '2024-05-16 11:41:04'),
(3, 1, 0, 1, 'Miguelithox', '', 1, 1, 'Miguelithox', 'Comentario vac&iacute;o.', '2024-05-16 11:43:26'),
(4, 1, 0, 1, 'Miguelithox', '', 1, 1, 'Miguelithox', 'Comentario vac&iacute;o.', '2024-05-16 11:44:35'),
(5, 1, 0, 1, 'Miguelithox', '', 1, 1, 'Miguelithox', 'Comentario vac&iacute;o.', '2024-05-16 11:44:54'),
(6, 1, 0, 1, 'Miguelithox', ' 8| ', 0, NULL, NULL, '', '2024-05-16 12:28:24'),
(7, 1, 0, 1, 'Miguelithox', 'Esto es un [b]comentario[/b] de tipo prueba. :bye: ', 0, NULL, NULL, '', '2024-05-16 12:28:43'),
(8, 1, 0, 1, 'Miguelithox', ':off-topic:', 0, NULL, NULL, '', '2024-05-16 12:34:58'),
(9, 2, 0, 1, 'Miguelithox', '8|', 1, 1, 'Miguelithox', 'Cara sorpresa.', '2024-05-16 17:06:21'),
(10, 2, 0, 1, 'Miguelithox', 'Soy un segundo comentario.  :embarrass:', 0, NULL, NULL, '', '2024-05-16 18:32:19'),
(11, 3, 0, 1, 'Miguelithox', ':angel: Miguel', 0, NULL, NULL, '', '2024-05-18 16:03:13'),
(12, 4, 0, 1, 'Miguelithox', ':sorry:', 0, NULL, NULL, '', '2024-05-19 00:14:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_post` bigint(11) DEFAULT NULL,
  `id_usuario` bigint(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_post`, `id_usuario`, `fecha`) VALUES
(4, 1, 1, '2024-05-16 11:30:52'),
(5, 2, 1, '2024-05-16 17:05:54'),
(6, 3, 1, '2024-05-16 17:08:50'),
(7, 4, 1, '2024-05-19 14:49:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_mensaje` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_emisor` bigint(11) DEFAULT NULL,
  `id_receptor` bigint(11) DEFAULT NULL,
  `asunto` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `contenido` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `papelera_emisor` tinyint(1) DEFAULT '0',
  `papelera_receptor` tinyint(1) DEFAULT '0',
  `eliminado_emisor` tinyint(1) DEFAULT '0',
  `eliminado_receptor` tinyint(1) DEFAULT '0',
  `id_carpeta` bigint(11) DEFAULT '0',
  `leido_emisor` tinyint(1) DEFAULT '0',
  `leido_receptor` tinyint(1) DEFAULT '0',
  `fecha` datetime DEFAULT NULL,
  `fecha_papelera` datetime DEFAULT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_emisor`, `id_receptor`, `asunto`, `contenido`, `papelera_emisor`, `papelera_receptor`, `eliminado_emisor`, `eliminado_receptor`, `id_carpeta`, `leido_emisor`, `leido_receptor`, `fecha`, `fecha_papelera`) VALUES
(1, 1, 1, 'test', 'Esto es una prueba.', 0, 1, 0, 0, 0, 1, 1, '2024-05-22 23:40:20', '2024-05-22 23:58:11'),
(2, 1, 1, 'RE: test', 'asdasdasdasdasda', 0, 1, 1, 0, 0, 1, 1, '2024-05-22 23:44:06', '2024-05-22 23:58:01'),
(3, 1, 1, 'Sin t&iacute;tulo', 'Esto es otra prueba', 0, 1, 1, 0, 0, 1, 1, '2024-05-22 23:45:45', '2024-05-22 23:56:59'),
(4, 1, 1, 'Sin tÃ­tulo', 'A ver qu&eacute; es lo que dice esto...', 0, 0, 0, 0, 0, 1, 1, '2024-05-22 23:46:17', NULL),
(5, 1, 1, 'Sin tÃ­tulo', '', 0, 1, 0, 0, 0, 1, 1, '2024-05-22 23:47:06', '2024-05-23 18:09:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_autor` bigint(11) DEFAULT NULL,
  `pedido` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `fecha` datetime DEFAULT NULL,
  `completo` tinyint(1) DEFAULT '0',
  `id_post` bigint(11) DEFAULT NULL,
  `id_comp` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `elim` tinyint(4) NOT NULL DEFAULT '0',
  `id_autor` bigint(20) NOT NULL DEFAULT '0',
  `titulo` varchar(170) NOT NULL DEFAULT '',
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `privado` tinyint(4) NOT NULL DEFAULT '0',
  `coments` tinyint(4) NOT NULL DEFAULT '0',
  `puntos` bigint(20) NOT NULL DEFAULT '0',
  `comentarios` int(11) NOT NULL DEFAULT '0',
  `visitas` bigint(20) NOT NULL DEFAULT '0',
  `tags` text NOT NULL,
  `categoria` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `elim`, `id_autor`, `titulo`, `contenido`, `fecha`, `privado`, `coments`, `puntos`, `comentarios`, `visitas`, `tags`, `categoria`) VALUES
(1, 0, 1, '&iquest;C&oacute;mo empezar en eXtreme Zone?', 'Antes que nada les voy a comentar acerca de qu&eacute; trata eXtreme Zone, la idea es compartir mediante [b]posts[/b] hechos por ustedes mismos las herramientas que les parezcan interesantes a aquellos que siguen una carrera, ya sean apuntes, libros, programas, etc.\n\n[align=center][b]&iquest;C&oacute;mo hacer un posts?[/b][/align]\n\nPrimeramente tienes que estar registrado, para eso hace click en [url=http://localhost/apuntatelo/registro/]Registrarse[/url] y completa los datos, luego de completar los datos y aceptar el [url=http://localhost/apuntatelo/protocolo/]Protocolo[/url], te va a llegar un mail para que confirmes el registro, una vez que estemos registrados, con el usuario y contrase&ntilde;a vamos a poder loguearnos.\n\nUna vez logueados vamos a [url=http://localhost/apuntatelo/agregar_post/]Agregar[/url], y entramos al editor de post.\n\n[b]1.[/b] [color=green][b]Titulo[/b][/color]: L&oacute;gicamente ir&iacute;a el T&iacute;tulo del post.\n\n[b]2.[/b] [color=green][b]Barra de Personalizaci&oacute;n de texto.[/b][/color]\n[img]http://localhost/apuntatelo/imagenes/tutorial/1.png[/img]\n\n[b]2.1[/b] Texto alineado hacia la Izquierda\n[b]2.2[/b] Texto centrado\n[b]2.3 [/b]Texto alineado hacia la Derecha\n[b]2.4[/b] Texto en [b]Negrita[/b]\n[b]2.5[/b] Texto en [i]Cursiva[/i]\n[b]2.6[/b] Texto con [u]Subrayado[/u]\n[b]2.7 [/b]Texto Coloreado\n[b]2.8[/b] Texto con Tama&ntilde;o\n[b]2.9[/b] Introducir un Video de Youtube\n[img]http://localhost/apuntatelo/imagenes/tutorial/2.PNG[/img]\n[swf=http://www.youtube.com/v/8GouKe4Osc8]\n[b]2.10[/b] Introducir una Imagen\n[img]http://localhost/apuntatelo/imagenes/tutorial/3.PNG[/img]\n[b]2.11[/b] Introducir un Enlace\n[img]http://localhost/apuntatelo/imagenes/tutorial/4.PNG[/img]\n[url=/]eXtreme Zone[/url]\n\n[b]3.[/b] [b][color=green]Lista de Iconos[/color][/b]\n[img]http://localhost/apuntatelo/imagenes/tutorial/5.PNG[/img]\n\nPara usarlos, debes hacer click encima del Icono que quieras. Si quieres ver m&aacute;s haz click en &quot;M&aacute;s&quot;.\n\n[b]4.[/b] [b][color=green]Categor&iacute;as[/color][/b]\n[img]http://localhost/apuntatelo/imagenes/tutorial/6.PNG[/img]\n\nElige la categor&iacute;a correspondiente para tu posts.\n\n[b]5.[/b] [b][color=green]Tags[/color][/b]\n[img]http://localhost/apuntatelo/imagenes/tutorial/7.PNG[/img]\n\nEscribe 3 tags o m&aacute;s que represente a tu Post, separado por coma\nEjemplo: eXtreme, Zone, Comunidad, Linksharing\n\n[b]6.[/b] [b][color=green]Opciones[/color][/b]\n[img]http://localhost/apuntatelo/imagenes/tutorial/8.PNG[/img]\n\nSi seleccionas la casilla [b]Privado[/b], tu post solamente lo podr&aacute;n ver usuarios registrados.\nSi seleccionas la casilla [b]Cerrar los comentarios[/b], tu post no podr&aacute; tener comentarios.\n[b]\nEspero que les haya gustado este tutorial.\nSaludos.[/b]', '2009-03-13 19:50:56', 0, 0, 0, 13, 159, 'Empezar, eXtreme, Zone, Novato', 4),
(2, 0, 1, 'Soy una publicaci&oacute;n de prueba', '[size=24]Testing...[/size]\r\nEsto es una publicaci&oacute;n nueva de [u][b]prueba 2[/b][/u]. [b]Veremos[/b] c&oacute;mo se comporta esto.\r\n\r\n :ok:\r\n\r\n :ok:  8|  :))', '2024-05-16 16:51:17', 0, 0, 0, 2, 1, 'prueba, publicacion, nueva, veremos, comportamiento', 4),
(3, 0, 1, 'Soy otro post de prueba', '[size=24]Prueba de nuevo post[/size]\r\n\r\nLas pruebas no se pueden acabar todav&iacute;a...\r\n\r\nA&uacute;n nos falta redactar m&aacute;s a&uacute;n.  :ok:', '2024-05-16 17:07:41', 0, 0, 0, 1, 1, 'otro, post, prueba', 6),
(4, 0, 1, 'Soy un post privado', 'Hola, soy un post que [b]s&oacute;lo puede ser visto[/b] por usuarios registrados.\r\n\r\nVersi&oacute;n 2', '2024-05-18 16:07:47', 1, 0, 0, 1, 1, 'post, privado, prueba, visto, usuarios, registrados', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts_eliminados`
--

DROP TABLE IF EXISTS `posts_eliminados`;
CREATE TABLE IF NOT EXISTS `posts_eliminados` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modera` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `causa` varchar(210) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

DROP TABLE IF EXISTS `puntos`;
CREATE TABLE IF NOT EXISTS `puntos` (
  `num` bigint(20) NOT NULL DEFAULT '0',
  `id_punteador` bigint(20) NOT NULL DEFAULT '0',
  `puntos` bigint(20) NOT NULL DEFAULT '0',
  `fecha` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stickies`
--

DROP TABLE IF EXISTS `stickies`;
CREATE TABLE IF NOT EXISTS `stickies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden` smallint(2) DEFAULT NULL,
  `id_post` bigint(20) NOT NULL DEFAULT '0',
  `elim` tinyint(4) NOT NULL DEFAULT '0',
  `creador` varchar(25) DEFAULT NULL,
  `modera` varchar(25) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `stickies`
--

INSERT INTO `stickies` (`id`, `orden`, `id_post`, `elim`, `creador`, `modera`, `fecha`) VALUES
(1, 3, 1, 0, 'Miguelithox', NULL, '2024-05-18 22:19:45'),
(2, 1, 3, 1, 'Miguelithox', 'Miguelithox', '2024-05-18 22:26:43'),
(3, 2, 3, 0, 'Miguelithox', NULL, '2024-05-18 22:47:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suspendidos`
--

DROP TABLE IF EXISTS `suspendidos`;
CREATE TABLE IF NOT EXISTS `suspendidos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) NOT NULL DEFAULT '',
  `modera` varchar(20) DEFAULT NULL,
  `activa` varchar(20) DEFAULT NULL,
  `causa` text NOT NULL,
  `fecha1` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha2` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activo` int(11) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_secret` varchar(40) NOT NULL DEFAULT '',
  `activacion` tinyint(4) NOT NULL DEFAULT '0',
  `ban` tinyint(4) NOT NULL DEFAULT '0',
  `rango` varchar(25) NOT NULL DEFAULT '',
  `nombre` varchar(40) NOT NULL DEFAULT '',
  `nick` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `puntos` bigint(20) NOT NULL DEFAULT '0',
  `puntosdar` smallint(6) NOT NULL DEFAULT '0',
  `mail` varchar(45) NOT NULL DEFAULT '',
  `avatar` varchar(160) NOT NULL DEFAULT '',
  `pais` tinytext NOT NULL,
  `ciudad` varchar(55) NOT NULL DEFAULT '0',
  `sexo` tinytext NOT NULL,
  `dia` tinyint(4) NOT NULL DEFAULT '0',
  `mes` tinyint(4) NOT NULL DEFAULT '0',
  `ano` smallint(6) NOT NULL DEFAULT '0',
  `mensajero` varchar(45) DEFAULT NULL,
  `mensaje` varchar(110) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numposts` bigint(20) NOT NULL DEFAULT '0',
  `numcomentarios` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_secret`, `activacion`, `ban`, `rango`, `nombre`, `nick`, `password`, `puntos`, `puntosdar`, `mail`, `avatar`, `pais`, `ciudad`, `sexo`, `dia`, `mes`, `ano`, `mensajero`, `mensaje`, `fecha`, `numposts`, `numcomentarios`) VALUES
(1, 'eaf110c2475386ad64fd270b4f331c11', 1, 0, 'Administrador', 'Miguel Gonz&aacute;lez', 'Miguelithox', 'e10adc3949ba59abbe56e057f20f883e', 0, 30, 'miguel.gonzalez.93@gmail.com', 'https://kdrenski.com/angular/assets/svg/php.svg', 'cl', 'Vi&ntilde;a del Mar', 'm', 15, 11, 1993, 'miguel.gonzalez.93@gmail.com', 'Bienvenido a Apunt&aacute;telo', '2009-03-08 18:56:50', 5, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

DROP TABLE IF EXISTS `visitas`;
CREATE TABLE IF NOT EXISTS `visitas` (
  `id_post` bigint(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_post`, `ip`, `fecha`) VALUES
(1, '::1', '2024-05-14 13:26:23'),
(2, '::1', '2024-05-16 16:52:08'),
(3, '::1', '2024-05-16 17:07:50'),
(4, '::1', '2024-05-18 16:07:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
