-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2023 a las 19:42:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ashion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `foto` text NOT NULL,
  `perfil` text NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `email`, `pass`, `foto`, `perfil`, `estado`, `fecha`) VALUES
(4, 'Brayan Sanchez', 'admin@admin.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', '', 'administrador', 1, '2021-11-18 01:02:33'),
(6, 'Victor Gabriel', 'victor.contato@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', '', 'administrador', 1, '2021-11-18 01:04:01'),
(8, 'Jorge Sánchez de Leon', 'jorge@correo.com', '$2a$07$asxx54ahjppf45sd87a5au6fAHIlFrQ7jQ4XHf7fycZYUNBysO4Bq', 'vistas/img/perfiles/318.png', 'editor', 1, '2021-11-18 01:40:59'),
(9, 'Jesus Herrera', 'jesus@correo.com', '$2a$07$asxx54ahjppf45sd87a5auwfiwafDOnQL4qIHucfFNVGXBONzt/Ge', 'vistas/img/perfiles/618.jpg', 'editor', 1, '2023-12-13 18:12:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabeceras`
--

CREATE TABLE `cabeceras` (
  `id` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `palabrasClaves` text NOT NULL,
  `portada` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cabeceras`
--

INSERT INTO `cabeceras` (`id`, `ruta`, `titulo`, `descripcion`, `palabrasClaves`, `portada`, `fecha`) VALUES
(1, 'inicio', 'Tienda Virtual', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam accusantium enim esse eos officiis sit officia', 'Lorem ipsum, dolor sit amet, consectetur, adipisicing, elit, Quisquam, accusantium, enim, esse', 'vistas/img/cabeceras/default.jpg', '2017-11-17 14:58:16'),
(32, 'ropa', 'ROPA', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/ropa.jpg', '2021-11-19 22:40:04'),
(33, 'accesorios', 'accesorios', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/accesorios.jpg', '2021-11-19 22:41:53'),
(34, 'tecnologia', 'TECNOLOGIA', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/tecnologia.jpg', '2021-11-19 22:42:49'),
(35, 'ropa-para-dama', 'Ropa para Dama', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/ropa-para-dama.jpg', '2021-11-19 22:44:00'),
(36, 'ropa-para-hombre', 'Ropa para Hombre', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'dolor,sit,amet', 'vistas/img/cabeceras/ropa-para-hombre.jpg', '2021-11-19 22:44:49'),
(37, 'relojes', 'Relojes', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/relojes.jpg', '2021-11-19 22:45:40'),
(38, 'cinturones-para-hombre', 'Cinturones para hombre', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/cinturones-para-hombre.jpg', '2021-11-19 22:47:27'),
(39, 'laptops', 'Laptops', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/default/default.jpg', '2021-11-19 22:48:43'),
(40, 'blusa-para-dama-1', 'Blusa para dama 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lore,ipsum,dolor,dit amet', 'vistas/img/cabeceras/blusa-para-dama-1.jpg', '2021-11-19 22:51:37'),
(41, 'camiza-para-hombre-1', 'Camiza para Hombre 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,dit,amet', 'vistas/img/cabeceras/camiza-para-hombre-1.jpg', '2021-11-19 22:54:38'),
(42, 'vestido-para-dama-1', 'Vestido para dama 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/vestido-para-dama-1.jpg', '2021-11-19 22:56:29'),
(43, 'camiza-para-hombre-2', 'Camiza para hombre 2', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lore,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/default/default.jpg', '2021-11-19 22:59:26'),
(44, 'camiza-para-hombre-3', 'Camiza para Hombre 3', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lore,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/default/default.jpg', '2021-11-19 23:12:25'),
(45, 'blusa-para-dama-2', 'Blusa para dama 2', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/default/default.jpg', '2021-11-19 23:19:26'),
(47, 'camiza-para-hombre-4', 'Camiza para hombre 4', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/default/default.jpg', '2021-11-19 23:22:45'),
(48, 'reloj-1', 'Reloj 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/default/default.jpg', '2021-11-19 23:25:10'),
(49, 'cinturon-para-hombre-1', 'Cinturon para hombre 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', 'lorem,ipsum,dolor,sit,amet', 'vistas/img/cabeceras/default/default.jpg', '2021-11-19 23:26:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text NOT NULL,
  `ruta` text NOT NULL,
  `estado` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `precioOferta` float NOT NULL,
  `descuentoOferta` int(11) NOT NULL,
  `imgOferta` text NOT NULL,
  `finOferta` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `ruta`, `estado`, `oferta`, `precioOferta`, `descuentoOferta`, `imgOferta`, `finOferta`, `fecha`) VALUES
(12, 'ROPA', 'ropa', 1, 0, 0, 0, '', '0000-00-00 00:00:00', '2023-12-13 18:09:51'),
(13, 'ACCESORIOS', 'accesorios', 1, 0, 0, 0, '', '0000-00-00 00:00:00', '2021-11-19 22:41:53'),
(14, 'TECNOLOGIA', 'tecnologia', 1, 0, 0, 0, '', '0000-00-00 00:00:00', '2021-11-19 22:42:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercio`
--

CREATE TABLE `comercio` (
  `id` int(11) NOT NULL,
  `divisa` text NOT NULL,
  `impuesto` float NOT NULL,
  `envioNacional` float NOT NULL,
  `envioInternacional` float NOT NULL,
  `tasaMinimaNal` float NOT NULL,
  `tasaMinimaInt` float NOT NULL,
  `pais` text NOT NULL,
  `modoPaypal` text NOT NULL,
  `clienteIdPaypal` text NOT NULL,
  `llaveSecretaPaypal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comercio`
--

INSERT INTO `comercio` (`id`, `divisa`, `impuesto`, `envioNacional`, `envioInternacional`, `tasaMinimaNal`, `tasaMinimaInt`, `pais`, `modoPaypal`, `clienteIdPaypal`, `llaveSecretaPaypal`) VALUES
(1, 'USD', 30, 10, 15, 19, 30, 'MX', 'sandbox', 'Ab5Jul632s-Z4-RTMvcVrbU_WiAb6URApVZTSxDRkkA-3fiA-sI0fl86v3-LYVjeSj21eIA-wf3GwweN', 'EDpU9-3ijLsXBoZE4QrQaYqRIkCJO_cjcrO66PPRP28aZdYIj05oN2-A8MWxpbQHlq5jU3YRt-l3dsN9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `envio` int(11) NOT NULL,
  `metodo` text NOT NULL,
  `email` text NOT NULL,
  `direccion` text NOT NULL,
  `pais` text NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `pago` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_usuario`, `id_producto`, `envio`, `metodo`, `email`, `direccion`, `pais`, `cantidad`, `detalle`, `pago`, `fecha`) VALUES
(137, 23, 527, 0, 'paypal', 'sb-o4tfl1928157@personal.example.com', '1 Main St, San Jose, CA, 95131', 'US', 1, 'Cinturon para hombre 1-mediano-negro', '40', '2023-10-20 00:10:31'),
(138, 23, 524, 0, 'paypal', 'sb-o4tfl1928157@personal.example.com', '1 Main St, San Jose, CA, 95131', 'US', 1, 'Vestido para dama 2-mediano-blanco', '200', '2023-10-20 00:10:32'),
(139, 23, 518, 2, 'paypal', 'sb-o4tfl1928157@personal.example.com', '1 Main St, San Jose, CA, 95131', 'US', 1, 'Blusa para dama 1- Mediana-Gris', '2100', '2023-10-12 18:56:58'),
(143, 24, 525, 0, 'paypal', 'sb-jfl5k1923667@business.example.com', '1 Main St, San Jose, CA, 95131', 'US', 1, 'Camiza para hombre 4-grande-blanco', '90', '2023-10-13 17:41:23'),
(144, 24, 527, 1, 'paypal', 'sb-jfl5k1923667@business.example.com', '1 Main St, San Jose, CA, 95131', 'US', 2, 'Cinturon para hombre 1-mediano-negro', '69', '2023-10-13 17:41:42'),
(145, 24, 526, 2, 'paypal', 'sb-jfl5k1923667@business.example.com', '1 Main St, San Jose, CA, 95131', 'US', 1, 'Reloj 1-mediano-negro', '500', '2023-11-13 17:41:47'),
(146, 24, 528, 2, 'paypal', 'sb-jfl5k1923667@business.example.com', '1 Main St, San Jose, CA, 95131', 'US', 6, 'producto de prueba-10-color1', '63.36', '2023-12-13 17:56:29'),
(147, 24, 526, 0, 'paypal', 'sb-jfl5k1923667@business.example.com', '1 Main St, San Jose, CA, 95131', 'US', 2, 'Reloj 1-mediano-negro', '1000', '2023-12-13 18:00:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deseos`
--

CREATE TABLE `deseos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `deseos`
--

INSERT INTO `deseos` (`id`, `id_usuario`, `id_producto`, `fecha`) VALUES
(37, 18, 522, '2021-11-20 01:25:27'),
(38, 18, 521, '2021-11-20 01:25:34'),
(39, 18, 520, '2021-11-20 01:25:38'),
(40, 21, 527, '2021-12-01 21:48:22'),
(41, 21, 526, '2021-12-01 21:48:27'),
(43, 24, 527, '2023-12-12 17:35:15'),
(44, 24, 526, '2023-12-12 17:35:19'),
(45, 24, 525, '2023-12-12 17:35:21'),
(46, 24, 521, '2023-12-12 17:35:26'),
(47, 24, 522, '2023-12-12 17:35:28'),
(48, 24, 523, '2023-12-12 17:35:31'),
(49, 24, 518, '2023-12-12 17:35:37'),
(50, 24, 519, '2023-12-12 17:35:40'),
(51, 24, 520, '2023-12-12 17:35:42'),
(52, 1, 0, '2023-12-12 18:39:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `numeroWhatsapp` text NOT NULL,
  `correo` text NOT NULL,
  `direccion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `footer`
--

INSERT INTO `footer` (`id`, `numeroWhatsapp`, `correo`, `direccion`, `fecha`) VALUES
(1, '(+52) 722-883-8661', 'brayan.sanchez.contacto@gmail.com', 'Toluca de Lerdo - Estado De México - México ', '2021-10-07 22:52:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE `plantilla` (
  `id` int(11) NOT NULL,
  `logo` text NOT NULL,
  `icono` text NOT NULL,
  `redesSociales` text NOT NULL,
  `apiFacebook` text NOT NULL,
  `frameGoogleMaps` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `plantilla`
--

INSERT INTO `plantilla` (`id`, `logo`, `icono`, `redesSociales`, `apiFacebook`, `frameGoogleMaps`, `fecha`) VALUES
(1, 'vistas/img/plantilla/logo.png', 'vistas/img/plantilla/icono.png', '[{\"red\":\"fa-facebook\",\"url\":\"http://facebook.com/asdf\",\"activo\":1},{\"red\":\"fa-youtube\",\"url\":\"http://youtube.com/\",\"activo\":1},{\"red\":\"fa-twitter\",\"url\":\"http://twitter.com/\",\"activo\":1},{\"red\":\"fa-instagram\",\"url\":\"http://instagram.com/\",\"activo\":1},{\"red\":\"fa-whatsapp\",\"url\":\"http://instagram.com/\",\"activo\":1},{\"red\":\"fa-linkedin\",\"url\":\"http://instagram.com/\",\"activo\":1},{\"red\":\"fa-github\",\"url\":\"http://instagram.com/\",\"activo\":1}]', '      <script> 	  window.fbAsyncInit = function() { 	    FB.init({ 	      appId      : \'404069350870215\', 	      cookie     : true, 	      xfbml      : true, 	      version    : \'v9.0\' 	    }); 	       	    FB.AppEvents.logPageView(); 	       	  };  	(function(d, s, id){ 		var js, fjs = d.getElementsByTagName(s)[0]; 		if (d.getElementById(id)) {return;} 		js = d.createElement(s); js.id = id; 		js.src = \"https://connect.facebook.net/en_US/sdk.js\"; 		fjs.parentNode.insertBefore(js, fjs); 	}(document, \'script\', \'facebook-jssdk\'));  	</script>\r\n      		\r\n      		\r\n      		\r\n      		      ', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.963989397167!2d-99.591188124024!3d19.283932145410454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd8af63723c9b5%3A0xf97a582edc0f6a03!2sChapultepec%2010%2C%20San%20Jeronimo%20Chicahualco%2C%2052170%20San%20Jer%C3%B3nimo%20Chicahualco%2C%20M%C3%A9x.!5e0!3m2!1ses!2smx!4v1702491801072!5m2!1ses!2smx\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>\r\n  			\r\n  			    \r\n  			    \r\n  			      ', '2023-12-13 18:23:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `estado` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `multimedia` text NOT NULL,
  `detalles` text NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `portada` text NOT NULL,
  `vistas` int(11) NOT NULL,
  `ventas` int(11) NOT NULL,
  `vistasGratis` int(11) NOT NULL,
  `ventasGratis` int(11) NOT NULL,
  `ofertadoPorCategoria` int(11) NOT NULL,
  `ofertadoPorSubCategoria` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `precioOferta` float NOT NULL,
  `descuentoOferta` int(11) NOT NULL,
  `finOferta` datetime NOT NULL,
  `nuevo` int(11) NOT NULL,
  `peso` float NOT NULL,
  `entrega` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_subcategoria`, `ruta`, `estado`, `titulo`, `descripcion`, `multimedia`, `detalles`, `precio`, `stock`, `portada`, `vistas`, `ventas`, `vistasGratis`, `ventasGratis`, `ofertadoPorCategoria`, `ofertadoPorSubCategoria`, `oferta`, `precioOferta`, `descuentoOferta`, `finOferta`, `nuevo`, `peso`, `entrega`, `fecha`) VALUES
(518, 12, 31, 'blusa-para-dama-1', 1, 'Blusa para dama 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/blusa-para-dama-1/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/blusa-para-dama-1/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/blusa-para-dama-1/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/blusa-para-dama-1/product-3.jpg\"}]', '{\"Talla\":[\"Chica\",\" Mediana\",\"Grande\"],\"Color\":[\"Amarillo\",\"Blanco\",\"Gris\",\"Negro\"]}', 21, 99, 'vistas/img/productos/blusa-para-dama-1.jpg', 2, 1, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 12, '2023-12-13 18:10:17'),
(519, 12, 32, 'camiza-para-hombre-1', 1, 'Camiza para Hombre 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-1/product-3.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-1/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-1/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-1/product-2.jpg\"}]', '{\"Talla\":[\"Chico\",\"Mediano\",\"Grande\"],\"Color\":[\"Blanco\",\"Negro\",\"Azul\"]}', 35, 100, 'vistas/img/productos/camiza-para-hombre-1.jpg', 4, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 40, '2023-12-13 18:09:51'),
(520, 12, 31, 'vestido-para-dama-1', 1, 'Vestido para dama 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/vestido-para-dama-1/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/vestido-para-dama-1/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/vestido-para-dama-1/product-3.jpg\"},{\"foto\":\"vistas/img/multimedia/vestido-para-dama-1/product-1.jpg\"}]', '{\"Talla\":[\"Chico\",\"Mediano\",\"Grande\"],\"Color\":[\"Blanco\",\"Negro\",\"Azul\"]}', 50, 100, 'vistas/img/productos/vestido-para-dama-1.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 12, '2023-12-13 18:10:17'),
(521, 12, 32, 'camiza-para-hombre-2', 1, 'Camiza para hombre 2', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-3.jpg\"}]', '{\"Talla\":[\"Chico\",\"Mediano\",\"Grande\"],\"Color\":[\"Blanco\",\"Negro\",\"Verde\",\"Azul\"]}', 12, 100, 'vistas/img/productos/camiza-para-hombre-2.jpg', 2, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 12, '2023-12-13 18:09:51'),
(522, 12, 32, 'camiza-para-hombre-3', 1, 'Camiza para Hombre 3', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-2/product-3.jpg\"}]', '{\"Talla\":[\"Chico\",\"Mediano\",\"Grande\"],\"Color\":[\"Blanco\",\"Negro\"]}', 77, 10, 'vistas/img/productos/camiza-para-hombre-3.jpg', 1, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 12, '2023-12-13 18:09:51'),
(523, 12, 31, 'blusa-para-dama-2', 1, 'Blusa para dama 2', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/blusa-para-dama-2/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/blusa-para-dama-2/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/blusa-para-dama-2/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/blusa-para-dama-2/product-3.jpg\"}]', '{\"Talla\":[\"chico\",\" mediano\",\"grandem\"],\"Color\":[\"blanco\",\"negro\"]}', 20, 100, 'vistas/img/productos/blusa-para-dama-2.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 11, 12, '2023-12-13 18:10:17'),
(525, 12, 32, 'camiza-para-hombre-4', 1, 'Camiza para hombre 4', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-4/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-4/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-4/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/camiza-para-hombre-4/product-3.jpg\"}]', '{\"Talla\":[\"chico\",\"mediano\",\"grande\"],\"Color\":[\"blanco\",\"negro\"]}', 90, 98, 'vistas/img/productos/camiza-para-hombre-4.jpg', 4, 2, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 23, '2023-12-13 18:09:51'),
(526, 13, 33, 'reloj-1', 1, 'Reloj 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/reloj-1/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/reloj-1/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/reloj-1/product-3.jpg\"},{\"foto\":\"vistas/img/multimedia/reloj-1/product-4.jpg\"}]', '{\"Talla\":[\"mediano\"],\"Color\":[\"negro\"]}', 500, 96, 'vistas/img/productos/reloj-1.jpg', 1, 4, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 40, '2023-12-13 18:11:09'),
(527, 13, 34, 'cinturon-para-hombre-1', 1, 'Cinturon para hombre 1', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>', '[{\"foto\":\"vistas/img/multimedia/cinturon-para-hombre-1/product-4.jpg\"},{\"foto\":\"vistas/img/multimedia/cinturon-para-hombre-1/product-2.jpg\"},{\"foto\":\"vistas/img/multimedia/cinturon-para-hombre-1/product-1.jpg\"},{\"foto\":\"vistas/img/multimedia/cinturon-para-hombre-1/product-3.jpg\"}]', '{\"Talla\":[\"mediano\",\"grande\"],\"Color\":[\"cafe\",\"negro\",\"rosa\"]}', 34.5, 95, 'vistas/img/productos/cinturon-para-hombre-1.jpg', 6, 5, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, 12, '2023-12-13 17:41:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `imgFondo` text NOT NULL,
  `titulo` text NOT NULL,
  `texto` text NOT NULL,
  `boton` text NOT NULL,
  `ruta` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `slide`
--

INSERT INTO `slide` (`id`, `nombre`, `imgFondo`, `titulo`, `texto`, `boton`, `ruta`, `fecha`) VALUES
(1, 'MUJER', 'vistas/img/banner/556.jpg', 'Moda de Verano', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur iusto, repudiandae provident commodi praesentium dolores enim earum, repellendus quidem vitae esse in magni quasi!</p>', 'VER PRODUCTO', 'https://localhost/ashion/frontend/vestido-blanco-para-dama', '2021-11-19 22:24:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `subcategoria` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `estado` int(11) NOT NULL,
  `ofertadoPorCategoria` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `precioOferta` float NOT NULL,
  `descuentoOferta` int(11) NOT NULL,
  `imgOferta` text NOT NULL,
  `finOferta` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `subcategoria`, `id_categoria`, `ruta`, `estado`, `ofertadoPorCategoria`, `oferta`, `precioOferta`, `descuentoOferta`, `imgOferta`, `finOferta`, `fecha`) VALUES
(31, 'Ropa para Dama', 12, 'ropa-para-dama', 1, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '2023-12-13 18:10:17'),
(32, 'Ropa para Hombre', 12, 'ropa-para-hombre', 1, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '2023-12-13 18:09:51'),
(33, 'Relojes', 13, 'relojes', 1, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '2021-11-19 22:45:41'),
(34, 'Cinturones para hombre', 13, 'cinturones-para-hombre', 1, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '2021-11-19 22:48:02'),
(35, 'Laptops', 14, 'laptops', 1, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '2021-11-19 22:48:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `modo` text NOT NULL,
  `foto` text NOT NULL,
  `verificacion` int(11) NOT NULL,
  `emailEncriptado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `email`, `modo`, `foto`, `verificacion`, `emailEncriptado`, `fecha`) VALUES
(18, 'Brayan Sánchez', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'bs6961204@gmail.com', 'directo', 'vistas/img/usuarios/18/404.jpg', 0, '6d5ae2821c4b29a19571416e8e3bbbb8', '2021-11-20 01:27:07'),
(19, 'Victor Sánchez', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'victor@correo.com', 'directo', '', 1, '0d985f7f1614e83cfe2595d669359534', '2021-11-20 00:17:42'),
(20, 'Jorge Sánchez', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'jorge@gmail.com', 'directo', '', 1, '5565d5bd5a11eabd173c312ae2b04e3f', '2021-11-20 00:48:41'),
(21, 'sergio mendez', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'sergio@correo.com', 'directo', '', 1, 'a452d782cf2fc2236caec81acab88e88', '2021-11-20 00:54:23'),
(23, 'Gabriela Ramirez', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'gaby@correo.com', 'directo', '', 0, 'ccda938adbae5adf16550f6f0254f4fa', '2021-11-20 01:07:03'),
(24, 'usuario prueba', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'usuario_prueba@gmail.com', 'directo', 'vistas/img/usuarios/24/110.png', 0, '5947b99986d19ce11c27fc5dab0fc51e', '2023-12-13 18:09:00'),
(25, 'usuario prueba', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'usuario_prueba@gmail.com', 'directo', '', 1, '5947b99986d19ce11c27fc5dab0fc51e', '2023-12-12 17:30:06'),
(26, 'usuario prueba', '$2a$07$asxx54ahjppf45sd87a5au9qVvwX8gFJUBxfGfDrhdF9F0ilMkf..', 'usuario_prueba@gmail.com', 'directo', '', 1, '5947b99986d19ce11c27fc5dab0fc51e', '2023-12-12 18:59:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cabeceras`
--
ALTER TABLE `cabeceras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comercio`
--
ALTER TABLE `comercio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deseos`
--
ALTER TABLE `deseos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cabeceras`
--
ALTER TABLE `cabeceras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `comercio`
--
ALTER TABLE `comercio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de la tabla `deseos`
--
ALTER TABLE `deseos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=529;

--
-- AUTO_INCREMENT de la tabla `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
