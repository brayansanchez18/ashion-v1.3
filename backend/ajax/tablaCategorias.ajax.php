<?php

require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';
require_once '../controladores/cabeceras.controlador.php';
require_once '../modelos/cabeceras.modelo.php';

class TablaCategorias {

  /* -------------------------------------------------------------------------- */
  /*                       MOSTRAR LA TABLA DE CATEGORÍAS                       */
  /* -------------------------------------------------------------------------- */

  public function mostrarTabla() {

    $item = null;
    $valor = null;

    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

    // echo json_encode($categorias);
    // return;

    $datosJson = '{ "data": [ ';

      for ($i = 0; $i < count($categorias); $i++) {

        /* -------------------------------------------------------------------------- */
        /*                               REVISAR ESTADO                               */
        /* -------------------------------------------------------------------------- */

        if ( $categorias[$i]['estado'] == 0) {

          $colorEstado = "btn-danger";
          $textoEstado = "Desactivado";
          $estadoCategoria = 1;

        } else {

          $colorEstado = "btn-success";
          $textoEstado = "Activado";
          $estadoCategoria = 0;

        }

        $estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoCategoria='".$estadoCategoria."' idCategoria='".$categorias[$i]['id']."'>".$textoEstado."</button>";

        /* -------------------------- End of REVISAR ESTADO ------------------------- */

        /* -------------------------------------------------------------------------- */
        /*                           REVISAR IMAGEN PORTADA                           */
        /* -------------------------------------------------------------------------- */

        $item = 'ruta';
        $valor = $categorias[$i]['ruta'];

        $cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item, $valor);

        if (is_array($cabeceras) && $cabeceras['portada'] != '') {
          $imgPortada = "<img class='img-thumbnail imgPortadaCategorias' src='".$cabeceras['portada']."' width='100px'>";
        } else {
          $imgPortada = "<img class='img-thumbnail imgPortadaCategorias' src='vistas/img/cabeceras/default/default.jpg' width='100px'>";
        }

        /* ---------------------- End of REVISAR IMAGEN PORTADA --------------------- */

        /* -------------------------------------------------------------------------- */
        /*                               REVISAR OFERTAS                              */
        /* -------------------------------------------------------------------------- */

        if ($categorias[$i]['oferta'] != 0) {

          if ($categorias[$i]['precioOferta'] != 0) {
            $tipoOferta = 'PRECIO';
            $valorOferta = "$ ".number_format($categorias[$i]['precioOferta'],2);
          } else {
            $tipoOferta = 'DESCUENTO';
            $valorOferta = $categorias[$i]['descuentoOferta']." %";
          }

        } else {

          $tipoOferta = 'No Tiene Oferta';
          $valorOferta = 0;

        }

        /* ------------------------- End of REVISAR OFERTAS ------------------------- */

        $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria' idCategoria='".$categorias[$i]['id']."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarCategoria' idCategoria='".$categorias[$i]['id']."' imgPortada='".(is_array($cabeceras) ? $cabeceras['portada'] : 'vistas/img/cabeceras/default/default.jpg')."'  rutaCabecera='".$categorias[$i]['ruta']."'><i class='fa fa-times'></i></button></div>";

        if (is_array($cabeceras)) {

          if (strlen($cabeceras['descripcion']) > 80) {
            $descripcion = substr($cabeceras['descripcion'], 0, 80) . '...';
          } else {
            $descripcion = $cabeceras['descripcion'];
          }

        } else {
          $descripcion = 'Sin descripción';
        }

        $datosJson	 .= '[
          "'.($i+1).'",
          "'.$categorias[$i]['categoria'].'",
          "'.$categorias[$i]['ruta'].'",
          "'. $estado.'",
          "' . $descripcion . '",
          "' . (is_array($cabeceras) ? $cabeceras['palabrasClaves'] : 'Sin palabras clave') . '",
          "'.$imgPortada.'",
          "'.$tipoOferta.'",
          "'.$valorOferta.'",
          "'.$categorias[$i]['finOferta'].'",
          "'.$acciones.'"
        ],';

      }

    $datosJson = substr($datosJson, 0, -1);

    $datosJson.=  '] }';

    echo $datosJson;

  }

  /* ------------------ End of MOSTRAR LA TABLA DE CATEGORÍAS ----------------- */

}

/* -------------------------------------------------------------------------- */
/*                         ACTIVAR TABLA DE CATEGORÍAS                        */
/* -------------------------------------------------------------------------- */

$activar = new TablaCategorias();
$activar -> mostrarTabla();

/* ------------------- End of ACTIVAR TABLA DE CATEGORÍAS ------------------- */