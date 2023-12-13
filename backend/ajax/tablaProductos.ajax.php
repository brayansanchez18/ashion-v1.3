<?php
require_once '../controladores/productos.controlador.php';
require_once '../controladores/categorias.controlador.php';
require_once '../controladores/subcategorias.controlador.php';
require_once '../controladores/cabeceras.controlador.php';
require_once '../modelos/productos.modelo.php';
require_once '../modelos/categorias.modelo.php';
require_once '../modelos/subcategorias.modelo.php';
require_once '../modelos/cabeceras.modelo.php';

class TablaProductos {

  /* -------------------------------------------------------------------------- */
  /*                        MOSTRAR LA TABLA DE PRODUCTOS                       */
  /* -------------------------------------------------------------------------- */

  public function mostrarTablaProductos() {

    $item = null;
    $valor = null;

    $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

    if (count($productos) == 0) {
      echo '{"data": []}';
      return;
    }

    $datosJson = '{"data":[';

    for ($i = 0; $i < count($productos); $i++) {

      /* -------------------------------------------------------------------------- */
      /*                            TRAER LAS CATEGORÍAS                            */
      /* -------------------------------------------------------------------------- */

      $item = 'id';
      $valor = $productos[$i]['id_categoria'];
      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

      if (is_array($categorias) && $categorias['categoria'] == '') {
        $categoria = 'SIN CATEGORÍA';
      } else {
        $categoria = $categorias['categoria'];
      }

      /* ----------------------- End of TRAER LAS CATEGORIAS ---------------------- */

      /* -------------------------------------------------------------------------- */
      /*                           TRAER LAS SUBCATEGORÍAS                          */
      /* -------------------------------------------------------------------------- */

      $item2 = 'id';
      $valor2 = $productos[$i]['id_subcategoria'];
      $subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item2, $valor2);
      if (is_array($categorias) && $subcategorias[0]['subcategoria'] == '') {
        $subcategoria = 'SIN SUBCATEGORÍA';
      } else {
        $subcategoria = $subcategorias[0]['subcategoria'];
      }

      /* --------------------- End of TRAER LAS SUBCATEGORÍAS --------------------- */

      /* -------------------------------------------------------------------------- */
      /*                         AGREGAR ETIQUETAS DE ESTADO                        */
      /* -------------------------------------------------------------------------- */

      if ($productos[$i]['estado'] == 0) {
        $colorEstado = 'btn-danger';
        $textoEstado = 'Desactivado';
        $estadoProducto = 1;
      } else {
        $colorEstado = 'btn-success';
        $textoEstado = 'Activado';
        $estadoProducto = 0;
      }

      $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$productos[$i]['id']."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";

      /* ------------------- End of AGREGAR ETIQUETAS DE ESTADO ------------------- */

      /* -------------------------------------------------------------------------- */
      /*                             TRAER LAS CABECERAS                            */
      /* -------------------------------------------------------------------------- */

      $item3 = 'ruta';
      $valor3 = $productos[$i]['ruta'];
      $cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item3, $valor3);

      if (is_array($cabeceras) && $cabeceras['portada'] != '') {
        $imagenPortada = "<img src='".$cabeceras['portada']."' class='img-thumbnail imgPortadaProductos' width='100px'>";
      } else {
        $imagenPortada = "<img src='vistas/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaProductos' width='100px'>";
      }

      /* ----------------------- End of TRAER LAS CABECERAS ----------------------- */

      /* -------------------------------------------------------------------------- */
      /*                           TRAER IMAGEN PRINCIPAL                           */
      /* -------------------------------------------------------------------------- */

      $imagenPrincipal = "<img src='".$productos[$i]['portada']."' class='img-thumbnail imgTablaPrincipal' width='100px'>";

      /* ---------------------- End of TRAER IMAGEN PRINCIPAL --------------------- */

      /* -------------------------------------------------------------------------- */
      /*                              TRAER MULTIMEDIA                              */
      /* -------------------------------------------------------------------------- */

      if ($productos[$i]['multimedia'] != "[]") {
        $multimedia = json_decode($productos[$i]['multimedia'],true);
        $vistaMultimedia = "<img src='".$multimedia[0]['foto']."' class='img-thumbnail imgTablaMultimedia' width='100px'>";
      } else {
        $vistaMultimedia = "<img src='vistas/img/multimedia//default/default.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";
      }

      /* ------------------------- End of TRAER MULTIMEDIA ------------------------ */

      /* -------------------------------------------------------------------------- */
      /*                               TRAER DETALLES                               */
      /* -------------------------------------------------------------------------- */

      $detalles = json_decode($productos[$i]["detalles"],true);

      $talla = json_encode($detalles['Talla']);
      $color = json_encode($detalles['Color']);

      $vistaDetalles = "Talla: ".str_replace(array("[","]",'"'), "", $talla)." - Color: ".str_replace(array("[","]",'"'), "", $color);

      /* -------------------------- End of TRAER DETALLES ------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                                TRAER PRECIO                                */
      /* -------------------------------------------------------------------------- */

      if ($productos[$i]['precio'] == 0) {
        $precio = 'Gratis';
      } else {
        $precio = "$ ".number_format($productos[$i]['precio'],2);
      }

      /* --------------------------- End of TRAER PRECIO -------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                                TRAER ENTREGA                               */
      /* -------------------------------------------------------------------------- */

      if ($productos[$i]['entrega'] == 0) {
        $entrega = 'Inmediata';
      } else {
        $entrega = $productos[$i]['entrega']. ' días hábiles';
      }

      /* -------------------------- End of TRAER ENTREGA -------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                           REVISAR SI HAY OFERTAS                           */
      /* -------------------------------------------------------------------------- */

      if ($productos[$i]['oferta'] != 0) {

        if ($productos[$i]['precioOferta'] != 0) {
          $tipoOferta = 'PRECIO';
          $valorOferta = '$ '.number_format($productos[$i]['precioOferta'],2);
        } else {
          $tipoOferta = 'DESCUENTO';
          $valorOferta = $productos[$i]['descuentoOferta'].' %';
        }

      } else {
        $tipoOferta = 'No tiene oferta';
        $valorOferta = 0;
      }

      /* ---------------------- End of REVISAR SI HAY OFERTAS --------------------- */

      /* -------------------------------------------------------------------------- */
      /*                             TRAER LAS ACCIONES                             */
      /* -------------------------------------------------------------------------- */

      $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]['id']."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]['id']."' rutaCabecera='".$productos[$i]['ruta']."' imgPortada='".(is_array($cabeceras) ? $cabeceras['portada'] : 'vistas/img/cabeceras/default/default.jpg')."' imgPrincipal='".$productos[$i]['portada']."'><i class='fa fa-times'></i></button></div>";

      /* ------------------------ End of TRAER LAS ACCIONES ----------------------- */

      /* -------------------------------------------------------------------------- */
      /*                          CONSTRUIR LOS DATOS JSON                          */
      /* -------------------------------------------------------------------------- */

      if (is_array($cabeceras)) {

        if (strlen($cabeceras['descripcion']) > 80) {
          $descripcion = substr($cabeceras['descripcion'], 0, 80) . '...';
        } else {
          $descripcion = $cabeceras['descripcion'];
        }

      } else {
        $descripcion = 'Sin descripción';
      }

      $datosJson .='[
          "'.($i+1).'",
          "'.$productos[$i]['titulo'].'",
          "'.$productos[$i]['ruta'].'",
          "'.$categoria.'",
          "'.$subcategoria.'",
          "'.$estado.'",
          "'.$descripcion.'",
          "' . (is_array($cabeceras) ? $cabeceras['palabrasClaves'] : 'Sin palabras clave') . '",
          "'.$imagenPortada.'",
          "'.$imagenPrincipal.'",
          "'.$vistaMultimedia.'",
          "'.$vistaDetalles.'",
          "'.$precio.'",
          "'.$productos[$i]['stock'].'",
          "'.$productos[$i]['peso'].' kg",
          "'.$entrega.'",
          "'.$tipoOferta.'",
          "'.$valorOferta.'",
          "'.$productos[$i]['finOferta'].'",
          "'.$acciones.'"

			],';

      /* --------------------- End of CONSTRUIR LOS DATOS JSON -------------------- */

    }

    $datosJson = substr($datosJson, 0, -1);
    $datosJson .= ']}';
    echo $datosJson;

  }

  /* ------------------ End of MOSTRAR LA TABLA DE PRODUCTOS ------------------ */

}

/* -------------------------------------------------------------------------- */
/*                         ACTIVAR TABLA DE PRODUCTOS                         */
/* -------------------------------------------------------------------------- */

$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

/* -------------------- End of ACTIVAR TABLA DE PRODUCTOS ------------------- */