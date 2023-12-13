<?php $frontend = Ruta::ctrRuta(); $backend = Ruta::ctrRutaServidor(); session_start();?>
<?php $plantilla = ControladorPlantilla::ctrEstiloPlantilla(); ?>
<?php $comercio = ControladorPlantilla::ctrMostrarDivisa(); $divisa = $comercio['divisa']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Ashion Template">
  <meta name="keywords" content="Ashion, unica, creative, html">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="shortcut icon" href="<?=$backend.$plantilla['icono']?>" />

  <?php

	/*============================================
	=            MARCADO DE CABECERAS            =
	============================================*/

	$rutas = array();

	if (isset($_GET['ruta'])) {
		$rutas = explode("/", $_GET["ruta"]);
		$ruta = $rutas[0];
	} else {
		$ruta = 'inicio';
	}

	$cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);

	if (!is_array($cabeceras)) {
		$ruta = 'inicio';
		$cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);
	}

	/*=====  End of MARCADO DE CABECERAS  ======*/

	?>

	<!--===================================
	=            Marcado HTML5            =
	====================================-->

	<meta name="title" content="<?=$cabeceras['titulo']?>">
	<meta name="keyword" content="<?=$cabeceras['palabrasClaves']?>">

	<title><?=$cabeceras['titulo']?></title>

	<!--====  End of Marcado HTML5  ====-->

	<!--====================================================
	=            Marcado de Open Graph FACEBOOK            =
	=====================================================-->

	<meta property="og:title" content="<?=$cabeceras['titulo']?>">
	<meta property="og:url" content="<?=$frontend.$cabeceras['ruta']?>">
  <meta property="og:description" content="<?=$cabeceras['descripcion']?>">
	<meta property="og:image" content="<?=$backend.$cabeceras['portada']?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="<?=$backend.$plantilla['logo']?>">
	<meta property="og:locale" content="es_MX">

	<!--====  End of Marcado de Open Graph FACEBOOK  ====-->

	<!--========================================
	=            Marcado de TWITTER            =
	=========================================-->

	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?=$cabeceras['titulo']?>">
	<meta name="twitter:url" content="<?=$frontend.$cabeceras['ruta']?>">
	<meta name="twitter:description" content="<?=$cabeceras['descripcion']?>">
	<meta name="twitter:image" content="<?=$cabeceras['portada']?>">
	<meta name="twitter:site" content="@tu-usuario">

	<!--====  End of Marcado de TWITTER  ====-->

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
  rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/style.css" type="text/css">
  <link rel="stylesheet" href="<?=$frontend?>vistas/css/estilos.css" type="text/css">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?=$frontend?>vistas/js/plugins/md5-min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
</head>
<body>
  <!-- Page Preloder -->
  <div id="preloder"><div class="loader"></div></div>

  <?php
    include_once 'modulos/header.php';

    $rutas = array();
    $ruta = null;
    $infoProductos = null;

    if (isset($_GET['ruta'])) {

      $rutas = explode('/', $_GET['ruta']);

      $item = "ruta";
      $valor = $rutas[0];

      $rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

      if (is_array($rutaCategorias) && $valor == $rutaCategorias['ruta'] && $rutaCategorias['estado'] == 1) {
        $ruta = $valor;
      }

      $rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

      foreach ($rutaSubCategorias as $key => $value) {
        if (is_array($value) && $valor == $value['ruta'] && $value['estado'] == 1) {
          $ruta = $valor;
        }
      }

      $rutaProductos = ControladorProductos::ctrMostrarInfoproducto($item, $valor);

      if (is_array($rutaProductos) && $rutas[0] == $rutaProductos['ruta'] && $rutaProductos['estado'] == 1) {
        $infoProductos = $valor;
      }

      if ($ruta != null || $rutas[0] == 'articulos-recientes' || $rutas[0] == 'lo-mas-vendido' || $rutas[0] == 'lo-mas-visto') {
        include 'modulos/productos2.php';
      }
      else if ($infoProductos != null) {
        include_once 'modulos/detalles-producto.php';
      }
      else if ($rutas[0] == 'buscador' || $rutas[0] == 'verificar' || $rutas[0] == 'salir' || $rutas[0] == 'perfil' || $rutas[0] == 'carrito-de-compras' || $rutas[0] == 'error' || $rutas[0] == 'finalizar-compra' || $rutas[0] == 'contacto' || $rutas[0] == 'cancelado' || $rutas[0] == 'tienda' || $rutas[0] == 'login' || $rutas[0] == 'register' || $rutas[0] == 'olvidopassword' || $rutas[0] == 'lista-deseos') {
        include 'modulos/'.$rutas[0].'.php';
      }
      else if ($rutas[0] == 'inicio') {
        include_once 'modulos/banner1.php';
        include_once 'modulos/productos.php';
      }
      else {
        include 'modulos/error404.php';
      }

    } else {
      include_once 'modulos/banner1.php';
      include_once 'modulos/productos.php';
    }

    include_once 'modulos/footer.php';
  ?>

  <input type="hidden" value="<?=$frontend?>" id="rutaOculta">

  <!-- Js Plugins -->
  <script src="<?=$frontend?>vistas/js/jquery-3.3.1.min.js"></script>
  <script src="<?=$frontend?>vistas/js/bootstrap.min.js"></script>
  <script src="<?=$frontend?>vistas/js/jquery.magnific-popup.min.js"></script>
  <script src="<?=$frontend?>vistas/js/jquery-ui.min.js"></script>
  <script src="<?=$frontend?>vistas/js/mixitup.min.js"></script>
  <script src="<?=$frontend?>vistas/js/jquery.countdown.min.js"></script>
  <script src="<?=$frontend?>vistas/js/jquery.slicknav.js"></script>
  <script src="<?=$frontend?>vistas/js/owl.carousel.min.js"></script>
  <script src="<?=$frontend?>vistas/js/jquery.nicescroll.min.js"></script>
  <script src="<?=$frontend?>vistas/js/main.js"></script>
  <script src="<?=$frontend?>vistas/js/buscador.js"></script>
  <script src="<?=$frontend?>vistas/js/infoproducto.js"></script>
  <script src="<?=$frontend?>vistas/js/usuarios.js"></script>
  <script src="<?=$frontend?>vistas/js/sweetalert2.all.min.js"></script>
  <script src="<?=$frontend?>vistas/js/carrito-de-compras.js"></script>

  <!-- -------------------------------------------------------------------------- */
	/*                             SCRIPT DE FACEBOOK                             */
	/* -------------------------------------------------------------------------- -->

	<?=$plantilla['apiFacebook']?>

	<!-- ------------------------ End of SCRIPT DE FACEBOOK ----------------------- -->
</body>
</html>