<?php

class ControladorCategorias {

  /* -------------------------------------------------------------------------- */
  /*                             MOSTRAR CATEGORIAS                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarCategorias($item, $valor) {
    $tabla = 'categorias';
    $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------ End of MOSTRAR CATEGORIAS ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              CREAR CATEGORIAS                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearCategoria() {

    if (isset($_POST['tituloCategoria'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['tituloCategoria'])) {

        if ($_POST['descripcionCategoria'] != '') {

          /* -------------------------------------------------------------------------- */
          /*                           VALIDAR IMAGEN PORTADA                           */
          /* -------------------------------------------------------------------------- */

          $rutaPortada = 'vistas/img/cabeceras/default/default.jpg';

          if (isset($_FILES['fotoPortada']['tmp_name']) && !empty($_FILES['fotoPortada']['tmp_name'])) {

            /* -------------------------------------------------------------------------- */
            /*                            DEFINIMOS LAS MEDIDAS                           */
            /* -------------------------------------------------------------------------- */

            list($ancho, $alto) = getimagesize($_FILES['fotoPortada']['tmp_name']);
            $nuevoAncho = 1280;
            $nuevoAlto = 720;

            /* ---------------------- End of DEFINIMOS LAS MEDIDAS ---------------------- */

            /* -------------------------------------------------------------------------- */
            /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
            /* -------------------------------------------------------------------------- */

            if ($_FILES['fotoPortada']['type'] == 'image/jpeg') {

              /* -------------------------------------------------------------------------- */
              /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
              /* -------------------------------------------------------------------------- */

              $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaCategoria'].'.jpg';
              $origen = imagecreatefromjpeg($_FILES['fotoPortada']['tmp_name']);
              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
              imagejpeg($destino, $rutaPortada);

              /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

            }

            if ($_FILES['fotoPortada']['type'] == 'image/png') {

              /* -------------------------------------------------------------------------- */
              /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
              /* -------------------------------------------------------------------------- */

              $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaCategoria'].'.png';
              $origen = imagecreatefrompng($_FILES['fotoPortada']['tmp_name']);
              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
              imagealphablending($destino, FALSE);
              imagesavealpha($destino, TRUE);
              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
              imagepng($destino, $rutaPortada);

              /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

            }

            /* --- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP --- */

          }

          /* ---------------------- End of VALIDAR IMAGEN PORTADA --------------------- */

          /* -------------------------------------------------------------------------- */
          /*                    PREGUNTAMOS SI VIENE OFERTA EN CAMINO                   */
          /* -------------------------------------------------------------------------- */

          if ($_POST['selActivarOferta'] == 'oferta') {

          $datos = array('categoria'=>mb_strtoupper($_POST['tituloCategoria']),
                        'ruta'=>$_POST['rutaCategoria'],
                        'estado'=> 1,
                        'titulo'=>$_POST['tituloCategoria'],
                        'descripcion'=> $_POST['descripcionCategoria'],
                        'palabrasClaves'=>$_POST['pClavesCategoria'],
                        'imgPortada'=>$rutaPortada,
                        'oferta'=>1,
                        'precioOferta'=>$_POST['precioOferta'],
                        'descuentoOferta'=>$_POST['descuentoOferta'],
                        'finOferta'=>$_POST['finOferta']);


          } else {

            $datos = array('categoria'=>mb_strtoupper($_POST['tituloCategoria']),
                          'ruta'=>$_POST['rutaCategoria'],
                          'estado'=> 1,
                          'titulo'=>$_POST['tituloCategoria'],
                          'descripcion'=> $_POST['descripcionCategoria'],
                          'palabrasClaves'=>$_POST['pClavesCategoria'],
                          'imgPortada'=>$rutaPortada,
                          'oferta'=>0,
                          'precioOferta'=>0,
                          'descuentoOferta'=>0,
                          'finOferta'=>'');

          }

          /* -------------- End of PREGUNTAMOS SI VIENE OFERTA EN CAMINO -------------- */

          ModeloCabeceras::mdlIngresarCabecera('cabeceras', $datos);
          $respuesta = ModeloCategorias::mdlIngresarCategoria('categorias', $datos);

          if ($respuesta == 'ok') {

            echo'<script>

            Swal.fire({
              title: "¡Guardado!",
              text: "La categoría ha sido guardada correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "categorias";
              }
            })

            </script>';

          }

        } else {

          echo'<script>

          Swal.fire({
              title: "¡ERROR!",
              text: "La descripcion no puede ir vacía",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "categorias";
              }
            })

          </script>';

        return;

        }

      } else {

        echo'<script>

          Swal.fire({
              title: "¡ERROR!",
              text: "La categoría no puede ir vacía o llevar caracteres especiales",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "categorias";
              }
            })

          </script>';

        return;

      }

    }

  }

  /* ------------------------- End of CREAR CATEGORIAS ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                              EDITAR CATEGORIA                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrEditarCategoria() {

    if (isset($_POST['editarTituloCategoria'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarTituloCategoria'])) {

        /* -------------------------------------------------------------------------- */
        /*                           VALIDAR IMAGEN PORTADA                           */
        /* -------------------------------------------------------------------------- */

        $rutaPortada = $_POST['antiguaFotoPortada'];

        if (isset($_FILES['fotoPortada']['tmp_name']) && !empty($_FILES['fotoPortada']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                       BORRAMOS ANTIGUA FORTO PORTADA                       */
          /* -------------------------------------------------------------------------- */

          unlink($_POST['antiguaFotoPortada']);

          /* ------------------ End of BORRAMOS ANTIGUA FORTO PORTADA ----------------- */

          /* -------------------------------------------------------------------------- */
          /*                            DEFINIMOS LAS MEDIDAS                           */
          /* -------------------------------------------------------------------------- */

          list($ancho, $alto) = getimagesize($_FILES['fotoPortada']['tmp_name']);
          $nuevoAncho = 1280;
          $nuevoAlto = 720;

          /* ---------------------- End of DEFINIMOS LAS MEDIDAS ---------------------- */

          /* -------------------------------------------------------------------------- */
          /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
          /* -------------------------------------------------------------------------- */

          if ($_FILES['fotoPortada']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaCategoria'].'.jpg';
            $origen = imagecreatefromjpeg($_FILES['fotoPortada']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $rutaPortada);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($_FILES['fotoPortada']['type'] == 'image/png') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaCategoria'].'.png';
            $origen = imagecreatefrompng($_FILES['fotoPortada']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagealphablending($destino, FALSE);
            imagesavealpha($destino, TRUE);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $rutaPortada);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          /* --- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP --- */

        }

        /* ---------------------- End of VALIDAR IMAGEN PORTADA --------------------- */

        /* -------------------------------------------------------------------------- */
        /*                    PREGUNTAMOS SI VIENE OFERTA EN CAMINO                   */
        /* -------------------------------------------------------------------------- */

        if ($_POST['descripcionEditarCategoria'] == '') {
          $texto = $_POST['descripcionAntiguaCategoria'];
        } else {
          $texto = $_POST['descripcionEditarCategoria'];
        }

        if ($_POST['selActivarOferta'] == 'oferta') {

        $datos = array('id'=>$_POST['editarIdCategoria'],
                      'categoria'=>mb_strtoupper($_POST['editarTituloCategoria']),
                      'ruta'=>$_POST['rutaCategoria'],
                      'estado'=> 1,
                      'idCabecera'=>$_POST['editarIdCabecera'],
                      'titulo'=>$_POST['editarTituloCategoria'],
                      'descripcion'=> $texto,
                      'palabrasClaves'=>$_POST['pClavesCategoria'],
                      'imgPortada'=>$rutaPortada,
                      'oferta'=>1,
                      'precioOferta'=>$_POST['precioOferta'],
                      'descuentoOferta'=>$_POST['descuentoOferta'],
                      'finOferta'=>$_POST['finOferta']);


        } else {

          $datos = array('id'=>$_POST['editarIdCategoria'],
                        'categoria'=>mb_strtoupper($_POST['editarTituloCategoria']),
                        'ruta'=>$_POST['rutaCategoria'],
                        'estado'=> 1,
                        'idCabecera'=>$_POST['editarIdCabecera'],
                        'titulo'=>$_POST['editarTituloCategoria'],
                        'descripcion'=> $texto,
                        'palabrasClaves'=>$_POST['pClavesCategoria'],
                        'imgPortada'=>$rutaPortada,
                        'oferta'=>0,
                        'precioOferta'=>0,
                        'descuentoOferta'=>0,
                        'finOferta'=>'');

        }

        /* -------------- End of PREGUNTAMOS SI VIENE OFERTA EN CAMINO -------------- */

        ModeloSubCategorias::mdlActualizarOfertaSubcategorias('subcategorias', $datos, 'ofertadoPorCategoria');
        $traerProductos = ModeloProductos::mdlMostrarProductos('productos', 'id_categoria', $datos['id']);

        foreach ($traerProductos as $key => $value) {

          if ($datos['oferta'] != 0 && $datos['precioOferta'] == 0) {

            if ($value['precio'] != 0) {
              $precioOfertaActualizado = $value['precio']-($value['precio']*$datos['descuentoOferta']/100);
              $descuentoOfertaActualizado = $datos['descuentoOferta'];
            } else {
              $precioOfertaActualizado = 0;
              $descuentoOfertaActualizado = 0;
            }

          }

          if ($datos['oferta'] != 0 && $datos['descuentoOferta'] == 0) {

            if ($value['precio'] != 0) {
              $precioOfertaActualizado = $datos['precioOferta'];
              $descuentoOfertaActualizado = 100 - ($datos['precioOferta']*100/$value['precio']);
            } else {
              $precioOfertaActualizado = 0;
              $descuentoOfertaActualizado = 0;
            }

          }

          ModeloProductos::mdlActualizarOfertaProductos('productos', $datos, 'ofertadoPorCategoria', $precioOfertaActualizado, $descuentoOfertaActualizado, $value['id']);

				}

        ModeloCabeceras::mdlEditarCabecera('cabeceras', $datos);
				$respuesta = ModeloCategorias::mdlEditarCategoria('categorias', $datos);

        if ($respuesta == 'ok') {

          echo'<script>

          Swal.fire({
            title: "¡Guardado!",
            text: "La categoría ha sido editada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "categorias";
            }
          })

          </script>';

        }

      } else {

        echo'<script>

          Swal.fire({
              title: "¡ERROR!",
              text: "La categoría no puede ir vacía o llevar caracteres especiales",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "categorias";
              }
            })

          </script>';

        return;

      }

    }

  }

  /* ------------------------- End of EDITAR CATEGORIA ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                             ELIMINAR CATEGORIA                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrEliminarCategoria() {

    if (isset($_GET['idCategoria'])) {

      $respuesta = ModeloSubCategorias::mdlMostrarSubCategorias('subcategorias', 'id_categoria', $_GET['idCategoria']);

      if (count($respuesta) == 0) {

        /* -------------------------------------------------------------------------- */
        /*                              ELIMINAR CABECERA                             */
        /* -------------------------------------------------------------------------- */

        if ($_GET['imgPortada'] != '' && $_GET['imgPortada'] != 'vistas/img/cabeceras/default/default.jpg') {
          unlink($_GET['imgPortada']);
        }

        ModeloCabeceras::mdlEliminarCabecera('cabeceras', $_GET['rutaCabecera']);

        /* ------------------------ End of ELIMINAR CABECERA ------------------------ */

        /* -------------------------------------------------------------------------- */
        /*                 QUITAR LAS CATEGORIAS DE LAS SUBCATEGORIAS                 */
        /* -------------------------------------------------------------------------- */

        $traerSubCategorias = ModeloSubCategorias::mdlMostrarSubCategorias('subcategorias',  'id_categoria', $_GET['idCategoria']);

        if ($traerSubCategorias) {

          foreach ($traerSubCategorias as $key => $value) {

            $item1 = 'id_categoria';
            $valor1 = 0;
            $item2 = 'id';
            $valor2 = $value['id'];

            ModeloSubCategorias::mdlActualizarSubCategorias('subcategorias', $item1, $valor1, $item2, $valor2);

          }

        }

        /* ------------ End of QUITAR LAS CATEGORIAS DE LAS SUBCATEGORIAS ----------- */

        /* -------------------------------------------------------------------------- */
        /*                   QUITAR LAS CATEGORIAS DE LOS PRODUCTOS                   */
        /* -------------------------------------------------------------------------- */

        $traerProductos = ModeloProductos::mdlMostrarProductos('productos', 'id_categoria', $_GET['idCategoria']);

        if ($traerProductos) {

          foreach ($traerProductos as $key => $value) {

            $item1 = 'id_categoria';
            $valor1 = 0;
            $item2 = 'id';
            $valor2 = $value['id'];

            ModeloProductos::mdlActualizarProductos('productos', $item1, $valor1, $item2, $valor2);

          }

        }

        $respuesta = ModeloCategorias::mdlEliminarCategoria('categorias', $_GET['idCategoria']);

        if ($respuesta == 'ok') {

          echo'<script>

          Swal.fire({
            title: "¡OK!",
            text: "La categoría ha sido borrada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "categorias";
            }
          });

          </script>';

        }

        /* -------------- End of QUITAR LAS CATEGORIAS DE LOS PRODUCTOS ------------- */

      } else {

        echo'<script>

        Swal.fire({
          title: "¡ERROR!",
          text: "La categoría no puede ser eliminada por que aun existen subcategorias",
          icon: "error",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        }).then((isConfirm) => {
          if (isConfirm) {
            window.location = "categorias";
          }
        })

        </script>';

      }

		}

	}

  /* ------------------------ End of ELIMINAR CATEGORIA ----------------------- */

}