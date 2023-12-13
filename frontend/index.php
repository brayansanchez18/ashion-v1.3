<?php

require_once 'controladores/plantilla.controlador.php';
require_once 'controladores/productos.controlador.php';
require_once 'controladores/banner.controlador.php';
require_once 'controladores/usuarios.controlador.php';
require_once 'controladores/carrito.controlador.php';
require_once 'modelos/plantilla.modelo.php';
require_once 'modelos/productos.modelo.php';
require_once 'modelos/banner.modelo.php';
require_once 'modelos/usuarios.modelo.php';
require_once 'modelos/carrito.modelo.php';
require_once 'controladores/rutas.php';

require_once 'extensiones/vendor/autoload.php';

$plantilla = new ControladorPlantilla();
$plantilla -> plantilla();