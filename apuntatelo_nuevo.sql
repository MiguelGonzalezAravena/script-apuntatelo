-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-05-2009 a las 01:52:45
-- Versión del servidor: 5.1.33
-- Versión de PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `apuntatelo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidad`
--

CREATE TABLE IF NOT EXISTS `cantidad` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `cant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` tinyint(3) NOT NULL AUTO_INCREMENT,
  `nom_categoria` varchar(20) DEFAULT NULL,
  `imagen` varchar(30) DEFAULT NULL,
  `link_categoria` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `categorias`
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
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_post` bigint(11) DEFAULT NULL,
  `id_usuario` bigint(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_mensaje` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_emisor` bigint(11) DEFAULT NULL,
  `id_receptor` bigint(11) DEFAULT NULL,
  `asunto` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `contenido` text COLLATE latin1_general_ci,
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
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `id_autor` bigint(11) DEFAULT NULL,
  `pedido` text COLLATE latin1_general_ci,
  `fecha` datetime DEFAULT NULL,
  `completo` tinyint(1) DEFAULT '0',
  `id_post` bigint(11) DEFAULT NULL,
  `id_comp` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `posts`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `elim`, `id_autor`, `titulo`, `contenido`, `fecha`, `privado`, `coments`, `puntos`, `comentarios`, `visitas`, `tags`, `categoria`) VALUES
(1, 0, 1, '&iquest;C&oacute;mo empezar en eXtreme Zone?', 'Antes que nada les voy a comentar acerca de qu&eacute; trata eXtreme Zone, la idea es compartir mediante [b]posts[/b] hechos por ustedes mismos las herramientas que les parezcan interesantes a aquellos que siguen una carrera, ya sean apuntes, libros, programas, etc.\r\n\r\n[align=center][b]&iquest;C&oacute;mo hacer un posts?[/b][/align]\r\n\r\nPrimeramente tienes que estar registrado, para eso hace click en [url=/registro/]Registrarse[/url] y completa los datos, luego de completar los datos y aceptar el [url=/protocolo.php]Protocolo[/url], te va a llegar un mail para que confirmes el registro, una vez que estemos registrados, con el usuario y contrase&ntilde;a vamos a poder loguearnos.\r\n\r\nUna vez logueados vamos a [url=/agregar_post/]Agregar[/url], y entramos al editor de post.\r\n\r\n[b]1.[/b] [color=green][b]Titulo[/b][/color]: L&oacute;gicamente ir&iacute;a el T&iacute;tulo del post.\r\n\r\n[b]2.[/b] [color=green][b]Barra de Personalizaci&oacute;n de texto.[/b][/color]\r\n[img]/imagenes/tutorial/1.png[/img]\r\n\r\n[b]2.1[/b] Texto alineado hacia la Izquierda\r\n[b]2.2[/b] Texto centrado\r\n[b]2.3 [/b]Texto alineado hacia la Derecha\r\n[b]2.4[/b] Texto en [b]Negrita[/b]\r\n[b]2.5[/b] Texto en [i]Cursiva[/i]\r\n[b]2.6[/b] Texto con [u]Subrayado[/u]\r\n[b]2.7 [/b]Texto Coloreado\r\n[b]2.8[/b] Texto con Tama&ntilde;o\r\n[b]2.9[/b] Introducir un Video de Youtube\r\n[img]/imagenes/tutorial/2.PNG[/img]\r\n[swf=http://www.youtube.com/v/8GouKe4Osc8]\r\n[b]2.10[/b] Introducir una Imagen\r\n[img]/imagenes/tutorial/3.PNG[/img]\r\n[b]2.11[/b] Introducir un Enlace\r\n[img]/imagenes/tutorial/4.PNG[/img]\r\n[url=/]eXtreme Zone[/url]\r\n\r\n[b]3.[/b] [b][color=green]Lista de Iconos[/color][/b]\r\n[img]/imagenes/tutorial/5.PNG[/img]\r\n\r\nPara usarlos, debes hacer click encima del Icono que quieras. Si quieres ver m&aacute;s haz click en &quot;M&aacute;s&quot;.\r\n\r\n[b]4.[/b] [b][color=green]Categor&iacute;as[/color][/b]\r\n[img]/imagenes/tutorial/6.PNG[/img]\r\n\r\nElige la categor&iacute;a correspondiente para tu posts.\r\n\r\n[b]5.[/b] [b][color=green]Tags[/color][/b]\r\n[img]/imagenes/tutorial/7.PNG[/img]\r\n\r\nEscribe 3 tags o m&aacute;s que represente a tu Post, separado por coma\r\nEjemplo: eXtreme, Zone, Comunidad, Linksharing\r\n\r\n[b]6.[/b] [b][color=green]Opciones[/color][/b]\r\n[img]/imagenes/tutorial/8.PNG[/img]\r\n\r\nSi seleccionas la casilla [b]Privado[/b], tu post solamente lo podr&aacute;n ver usuarios registrados.\r\nSi seleccionas la casilla [b]Cerrar los comentarios[/b], tu post no podr&aacute; tener comentarios.\r\n[b]\r\nEspero que les haya gustado este tutorial.\r\nSaludos.[/b]', '2009-03-13 19:50:56', 0, 0, 0, 5, 158, 'Empezar, eXtreme, Zone, Novato', 4);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts_eliminados`
--

CREATE TABLE IF NOT EXISTS `posts_eliminados` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modera` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `causa` varchar(210) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE IF NOT EXISTS `puntos` (
  `num` bigint(20) NOT NULL DEFAULT '0',
  `id_punteador` bigint(20) NOT NULL DEFAULT '0',
  `puntos` bigint(20) NOT NULL DEFAULT '0',
  `fecha` datetime DEFAULT '0000-00-00 00:00:00'
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `stickies`
--

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
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `suspendidos`
--

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
) TYPE=MyISAM;

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_extreme` varchar(40) NOT NULL DEFAULT '',
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
  `fecha` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `numposts` bigint(20) NOT NULL DEFAULT '0',
  `numcomentarios` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_extreme`, `activacion`, `ban`, `rango`, `nombre`, `nick`, `password`, `puntos`, `puntosdar`, `mail`, `avatar`, `pais`, `ciudad`, `sexo`, `dia`, `mes`, `ano`, `mensajero`, `mensaje`, `fecha`, `numposts`, `numcomentarios`) VALUES
(1, 'd1813fab4e6cdd9eeb4697952224c3fc', 1, 0, 'Administrador', 'Miguel Gonz&aacute;lez', 'Miguelithox', 'e10adc3949ba59abbe56e057f20f883e', 0, 30, 'miguel.gonzalez.93@gmail.com', 'http://127.0.0.1/imagenes/smileys/icon_cheesygrin.gif', 'cl', 'Vi&ntilde;a Del Mar', 'm', 15, 11, 1993, 'miguelithox@extreme-zone.cl', 'Bienvenido', '2009-03-08 18:56:50', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
  `id_post` bigint(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) TYPE=MyISAM;
