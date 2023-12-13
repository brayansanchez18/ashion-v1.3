<?php

require_once '../controladores/subcategorias.controlador.php';
require_once '../modelos/subcategorias.modelo.php';
require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';
require_once '../controladores/cabeceras.controlador.php';
require_once '../modelos/cabeceras.modelo.php';

class TablaSubCategorias {

  /* -------------------------------------------------------------------------- */
  /*                      MOSTRAR LA TABLA DE SUBCATEGORÍAS                     */
  /* -------------------------------------------------------------------------- */

  public function mostrarTablaSubCategoria() {

    $item = null;
    $valor = null;
    $subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor);

    $datosJson = '{"data": [ ';

    for ($i = 0; $i < count($subcategorias); $i++) {

      /* -------------------------------------------------------------------------- */
      /*                            TRAER LAS CATEGORÍAS                            */
      /* -------------------------------------------------------------------------- */

      $item = 'id';
      $valor = $subcategorias[$i]['id_categoria'];
      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
      $categoria = (is_array($categorias) ? $categorias['categoria'] : 'SIN CATEGORÍA');

      /* ----------------------- End of TRAER LAS CATEGORÍAS ---------------------- */

      /* -------------------------------------------------------------------------- */
      /*                               REVISAR ESTADO                               */
      /* -------------------------------------------------------------------------- */

      if ( $subcategorias[$i]['estado'] == 0) {
        $colorEstado = 'btn-danger';
        $textoEstado = 'Desactivado';
        $estadoSubCategoria = 1;
      } else {
        $colorEstado = 'btn-success';
        $textoEstado = 'Activado';
        $estadoSubCategoria = 0;
      }

      $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idSubCategoria='". $subcategorias[$i]['id']."' estadoSubCategoria='".$estadoSubCategoria."'>".$textoEstado."</button>";

      /* -------------------------- End of REVISAR ESTADO ------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                           REVISAR IMAGEN PORTADA                           */
      /* -------------------------------------------------------------------------- */

      $item2 = 'ruta';
      $valor2 = $subcategorias[$i]['ruta'];
      $cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item2, $valor2);

      if (is_array($cabeceras) && $cabeceras['portada'] != '') {
        $imagenPortada = "<img src='".$cabeceras['portada']."' class='img-thumbnail imgPortadaSubCategorias' width='100px'>";
      } else {
        $imagenPortada = "<img src='vistas/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaSubCategorias' width='100px'>";
      }

      /* ---------------------- End of REVISAR IMAGEN PORTADA --------------------- */

      /* -------------------------------------------------------------------------- */
      /*                               REVISAR OFERTAS                              */
      /* -------------------------------------------------------------------------- */

      if ($subcategorias[$i]['oferta'] != 0) {

        if ($subcategorias[$i]['precioOferta'] != 0) {
          $tipoOferta = 'PRECIO';
          $valorOferta = '$ '.number_format($subcategorias[$i]['precioOferta'],2);
        } else {
          $tipoOferta = 'DESCUENTO';
          $valorOferta = $subcategorias[$i]['descuentoOferta'].' %';
        }

      } else {
        $tipoOferta = 'No tiene oferta';
        $valorOferta = 0;
      }

      /* ------------------------- End of REVISAR OFERTAS ------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                             CREAR LAS ACCIONES                             */
      /* -------------------------------------------------------------------------- */

      $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarSubCategoria' idSubCategoria='".$subcategorias[$i]['id']."' data-toggle='modal' data-target='#modalEditarSubCategoria'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarSubCategoria' idSubCategoria='".$subcategorias[$i]['id']."' rutaCabecera='".$subcategorias[$i]['ruta']."' imgPortada='".(is_array($cabeceras) ? $cabeceras['portada'] : 'vistas/img/cabeceras/default/default.jpg')."'><i class='fa fa-times'></i></button></div>";

      /* ------------------------ End of CREAR LAS ACCIONES ----------------------- */

      if (is_array($cabeceras)) {

        if (strlen($cabeceras['descripcion']) > 80) {
          $descripcion = substr($cabeceras['descripcion'], 0, 80) . '...';
        } else {
          $descripcion = $cabeceras['descripcion'];
        }

      } else {
        $descripcion = 'Sin descripción';
      }

      $datosJson .=  '
      [
        "'.($i+1).'",
        "'.$subcategorias[$i]['subcategoria'].'",
        "'.$subcategorias[$i]['ruta'].'",
        "'.$categoria.'",
        "'.$estado.'",
        "' . $descripcion . '",
        "' . (is_array($cabeceras) ? $cabeceras['palabrasClaves'] : 'Sin palabras clave') . '",
        "'.$imagenPortada.'",
        "'.$tipoOferta.'",
        "'.$valorOferta.'",
        "'.$subcategorias[$i]['finOferta'].'",
        "'.$acciones.'"
      ],';

    }

    $datosJson =  substr($datosJson, 0, -1);
    $datosJson .=  ']}';

    echo $datosJson;

  }


  /* ---------------- End of MOSTRAR LA TABLA DE SUBCATEGORÍAS ---------------- */

}

/* -------------------------------------------------------------------------- */
/*                       ACTIVAR TABLA DE SUBCATEGORÍAS                       */
/* -------------------------------------------------------------------------- */

$activarSubcategoria = new TablaSubCategorias();
$activarSubcategoria -> mostrarTablaSubCategoria();

/* ------------------ End of ACTIVAR TABLA DE SUBCATEGORÍAS ----------------- */