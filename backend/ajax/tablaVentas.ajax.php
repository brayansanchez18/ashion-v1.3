<?php

require_once '../controladores/ventas.controlador.php';
require_once '../controladores/productos.controlador.php';
require_once '../controladores/usuarios.controlador.php';
require_once '../controladores/rutas.php';
require_once '../modelos/ventas.modelo.php';
require_once '../modelos/productos.modelo.php';
require_once '../modelos/usuarios.modelo.php';

class TablaVentas {

  /* -------------------------------------------------------------------------- */
  /*                         MOSTRAR LA TABLA DE VENTAS                         */
  /* -------------------------------------------------------------------------- */

  public function mostrarTabla() {

    $modo = 'DESC';
    $frontend = Ruta::ctrRuta();
    $backend = Ruta::ctrRutaServidor();
    $ventas = ControladorVentas::ctrMostrarVentas($modo);

    $datosJson = '{"data": [ ';

    for ($i = 0; $i < count($ventas); $i++) {

      /* -------------------------------------------------------------------------- */
      /*                               TRAER PRODUCTO                               */
      /* -------------------------------------------------------------------------- */

      $item = 'id';
      $valor = $ventas[$i]['id_producto'];
      $traerProducto = ControladorProductos::ctrMostrarProductos($item, $valor);

      if (is_array($traerProducto)) {
        if ($traerProducto != null) {
          $producto = $traerProducto[0]['titulo'];
          $imgProducto = "<img class='img-thumbnail' src='".$traerProducto[0]['portada']."' width='100px'>";
        } else {
          $producto = "PRODUCTO ELIMINADO";
          $imgProducto = "<img class='img-thumbnail' src='vistas/img/productos/default/default.jpg' width='100px'>";
        }
      }

      /* -------------------------- End of TRAER PRODUCTO ------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                                TRAER CLIENTE                               */
      /* -------------------------------------------------------------------------- */

      $item2 = 'id';
      $valor2 = $ventas[$i]['id_usuario'];

      $traerCliente = ControladorUsuarios::ctrMostrarUsuarios($item2, $valor2);

      if (is_array($traerCliente)) {
        $cliente = $traerCliente['nombre'];
      }

      /* -------------------------- End of TRAER CLIENTE -------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                             TRAER FOTO CLIENTE                             */
      /* -------------------------------------------------------------------------- */

      if (is_array($traerCliente) && $traerCliente['foto'] != '') {
        $imgCliente = "<img class='img-circle' src='".$frontend.$traerCliente['foto']."' width='70px'>";
      } else {
        $imgCliente = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='70px'>";
      }

      /* ------------------------ End of TRAER FOTO CLIENTE ----------------------- */

      /* -------------------------------------------------------------------------- */
      /*                             TRAER EMAIL CLIENTE                            */
      /* -------------------------------------------------------------------------- */

      $email = $traerCliente['email'];

      /* ----------------------- End of TRAER EMAIL CLIENTE ----------------------- */

      /* -------------------------------------------------------------------------- */
      /*                           TRAER PROCESO DE ENVÍO                           */
      /* -------------------------------------------------------------------------- */

      if ($ventas[$i]['envio'] == 0) {
        $envio ="<button class='btn btn-danger btn-xs btnEnvio' idVenta='".$ventas[$i]['id']."' etapa='1'>Despachando el producto</button>";
      } else if($ventas[$i]['envio'] == 1) {
        $envio = "<button class='btn btn-warning btn-xs btnEnvio' idVenta='".$ventas[$i]['id']."' etapa='2'>Producto en camino</button>";
      } else {
        $envio = "<button class='btn btn-success btn-xs'>Producto entregado</button>";
      }

      /* ---------------------- End of TRAER PROCESO DE ENVÍO --------------------- */

      /* -------------------------------------------------------------------------- */
      /*                             DEVOLVER DATOS JSON                            */
      /* -------------------------------------------------------------------------- */

      if ($ventas[$i]['pago'] == 0) {
        $venta = 'PRODUCTO GRATIS';
      } else {
        $venta = '$ '.number_format($ventas[$i]['pago'],2);
      }

      $datosJson	 .= '[
              "'.($i+1).'",
              "'.$producto.'",
              "'.$imgProducto.'",
              "'.$ventas[$i]['detalle'].'",
              "'.$ventas[$i]['cantidad'].'",
              "'.$cliente.'",
              "'.$imgCliente.'",
              "'.$venta.'",
              "'.$envio.'",
              "'.$email.'",
              "'.$ventas[$i]['direccion'].'",
              "'.$ventas[$i]['pais'].'",
              "'.$ventas[$i]['fecha'].'"
              ],';

      /* ----------------------- End of DEVOLVER DATOS JSON ----------------------- */

    }

    $datosJson = substr($datosJson, 0, -1);

    $datosJson.=  ']}';
    echo $datosJson;

  }

  /* -------------------- End of MOSTRAR LA TABLA DE VENTAS ------------------- */

}

/* -------------------------------------------------------------------------- */
/*                           ACTIVAR TABLA DE VENTAS                          */
/* -------------------------------------------------------------------------- */

$activar = new TablaVentas();
$activar -> mostrarTabla();

/* --------------------- End of ACTIVAR TABLA DE VENTAS --------------------- */