<?php

class ControladorSubCategorias {

  /* -------------------------------------------------------------------------- */
  /*                            MOSTRAR SUBCATEGORIAS                           */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarSubCategorias($item, $valor) {
    $tabla = 'subcategorias';
    $respuesta = ModeloSubCategorias::mdlMostrarSubCategorias($tabla, $item, $valor);
    return $respuesta;
  }

  /* ---------------------- End of MOSTRAR SUBCATEGORIAS ---------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             CREAR SUBCATEGORIA                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearSubCategoria() {

    if (isset($_POST['tituloSubcategoria'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['tituloSubcategoria'])) {

        if ($_POST['descripcionSubcategoria'] != '') {

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

              $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaSubcategoria'].'.jpg';
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

              $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaSubcategoria'].'.png';
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
          /*                    PREGUNTAMOS SI VIENE OFERTE EN CAMINO                   */
          /* -------------------------------------------------------------------------- */

          if ($_POST['selActivarOferta'] == 'oferta') {

            $datos = array('subcategoria'=>$_POST['tituloSubcategoria'],
                          'idCategoria'=>$_POST['seleccionarCategoria'],
                          'ruta'=>$_POST['rutaSubcategoria'],
                          'estado'=> 1,
                          'titulo'=>$_POST['tituloSubcategoria'],
                          'descripcion'=> $_POST['descripcionSubcategoria'],
                          'palabrasClaves'=> $_POST['pClavesSubcategoria'],
                          'imgPortada'=>$rutaPortada,
                          'oferta'=>1,
                          'precioOferta'=>$_POST['precioOferta'],
                          'descuentoOferta'=>$_POST['descuentoOferta'],
                          'finOferta'=>$_POST['finOferta']);

          } else {

            $datos = array('subcategoria'=>$_POST['tituloSubcategoria'],
                          'idCategoria'=>$_POST['seleccionarCategoria'],
                          'ruta'=>$_POST['rutaSubcategoria'],
                          'estado'=> 1,
                          'titulo'=>$_POST['tituloSubcategoria'],
                          'descripcion'=> $_POST['descripcionSubcategoria'],
                          'palabrasClaves'=> $_POST['pClavesSubcategoria'],
                          'imgPortada'=>$rutaPortada,
                          'oferta'=>0,
                          'precioOferta'=>0,
                          'descuentoOferta'=>0,
                          'finOferta'=>'');

          }

          /* -------------- End of PREGUNTAMOS SI VIENE OFERTE EN CAMINO -------------- */

          ModeloCabeceras::mdlIngresarCabecera('cabeceras', $datos);
          $respuesta = ModeloSubCategorias::mdlIngresarSubCategoria('subcategorias', $datos);

          if ($respuesta == 'ok') {

            echo'<script>

            Swal.fire({
              title: "¡OK!",
              text: "La subcategoría ha sido guardada correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "subcategorias";
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
                window.location = "subcategorias";
              }
            })

          </script>';

        return;

        }

      } else {

        echo'<script>

          Swal.fire({
              title: "¡ERROR!",
              text: "La subcategoría no puede ir vacía o llevar caracteres especiales",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "subcategorias";
              }
            })

          </script>';

        return;

      }

    }

  }

  /* ------------------------ End of CREAR SUBCATEGORIA ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             EDITAR SUBCATEGORIA                            */
  /* -------------------------------------------------------------------------- */

  static public function ctreditarSubCategoria() {

    if (isset($_POST['editarTituloSubCategoria'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarTituloSubCategoria'])) {

        /* -------------------------------------------------------------------------- */
        /*                           VALIDAR IMAGEN PORTADA                           */
        /* -------------------------------------------------------------------------- */

        $rutaPortada = $_POST['antiguaFotoPortada'];

        if (isset($_FILES['fotoPortada']['tmp_name']) && !empty($_FILES['fotoPortada']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                        BORRAMOS ANTIGUA FOTO PORTADA                       */
          /* -------------------------------------------------------------------------- */

          unlink($_POST['antiguaFotoPortada']);

          /* ------------------ End of BORRAMOS ANTIGUA FOTO PORTADA ------------------ */

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

            $aleatorio = mt_rand(100,999);
            $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaSubcategoria'].'.jpg';
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

            $aleatorio = mt_rand(100,999);
            $rutaPortada = 'vistas/img/cabeceras/'.$_POST['rutaSubcategoria'].'.png';
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
        /*                    PREGUNTAMOS SI VIENE OFERTE EN CAMINO                   */
        /* -------------------------------------------------------------------------- */

        if ($_POST['editarDescripcionSubcategoria'] != '') {
          $texto = $_POST['editarDescripcionSubcategoria'];
        } else {
          $texto = $_POST['descripcionAntiguaSubCategoria'];
        }

        if ($_POST['selActivarOferta'] == 'oferta') {

          $datos = array('id'=>$_POST['editarIdSubCategoria'],
                        'subcategoria'=>$_POST['editarTituloSubCategoria'],
                        'idCategoria'=>$_POST['seleccionarCategoria'],
                        'ruta'=>$_POST['rutaSubcategoria'],
                        'estado'=> 1,
                        'idCabecera'=>$_POST['editarIdCabecera'],
                        'titulo'=>$_POST['editarTituloSubCategoria'],
                        'descripcion'=> $texto,
                        'palabrasClaves'=> $_POST['pClavesSubCategoria'],
                        'imgPortada'=>$rutaPortada,
                        'oferta'=>1,
                        'precioOferta'=>$_POST['precioOferta'],
                        'descuentoOferta'=>$_POST['descuentoOferta'],
                        'finOferta'=>$_POST['finOferta']);

        } else {

          $datos = array('id'=>$_POST['editarIdSubCategoria'],
                        'subcategoria'=>$_POST['editarTituloSubCategoria'],
                        'idCategoria'=>$_POST['seleccionarCategoria'],
                        'ruta'=>$_POST['rutaSubcategoria'],
                        'estado'=> 1,
                        'idCabecera'=>$_POST['editarIdCabecera'],
                        'titulo'=>$_POST['editarTituloSubCategoria'],
                        'descripcion'=> $texto,
                        'palabrasClaves'=> $_POST['pClavesSubCategoria'],
                        'imgPortada'=>$rutaPortada,
                        'oferta'=>0,
                        'precioOferta'=>0,
                        'descuentoOferta'=>0,
                        'finOferta'=>'');

        }

        /* -------------- End of PREGUNTAMOS SI VIENE OFERTE EN CAMINO -------------- */

        $traerProductos = ModeloProductos::mdlMostrarProductos('productos', 'id_subcategoria', $datos['id']);

        foreach ($traerProductos as $key => $value) {

          if ($value['precio'] != 0) {

            if ($datos['oferta'] != 0 && $datos['precioOferta'] == 0) {
              $precioOfertaActualizado = $value['precio']-($value['precio']*$datos['descuentoOferta']/100);
              $descuentoOfertaActualizado = $datos['descuentoOferta'];
            }

            if ($datos['oferta'] != 0 && $datos['descuentoOferta'] == 0) {
              $precioOfertaActualizado = $datos['precioOferta'];
              $descuentoOfertaActualizado = 100 - ($datos['precioOferta']*100/$value['precio']);
            }

          }

          ModeloProductos::mdlActualizarOfertaProductos('productos', $datos, 'ofertadoPorSubCategoria', $precioOfertaActualizado, $descuentoOfertaActualizado, $value['id']);

        }

        ModeloCabeceras::mdlEditarCabecera('cabeceras', $datos);
        $respuesta = ModeloSubCategorias::mdleditarSubCategoria('subcategorias', $datos);

        if ($respuesta == 'ok') {

          echo'<script>

          Swal.fire({
            title: "¡OK!",
            text: "La subcategoría ha sido editada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "subcategorias";
            }
          })

          </script>';

        }

      } else {

        echo'<script>

            Swal.fire({
              title: "¡ERROR!",
              text: "La subcategoría no puede ir vacía o llevar caracteres especiales",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "subcategorias";
              }
            })

          </script>';

      }

    }

  }

  /* ----------------------- End of EDITAR SUBCATEGORIA ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                            ELIMINAR SUBCATEGORIA                           */
  /* -------------------------------------------------------------------------- */

  static public function ctrEliminarSubCategoria() {

    if (isset($_GET['idSubCategoria'])) {

      $respuesta = ModeloProductos::mdlMostrarProductos('productos', 'id_subcategoria', $_GET['idSubCategoria']);

      if (count($respuesta) == 0) {

        $datos = $_GET['idSubCategoria'];

        /* -------------------------------------------------------------------------- */
        /*                              ELIMINAR CABECERA                             */
        /* -------------------------------------------------------------------------- */

        if($_GET['imgPortada'] != '' && $_GET['imgPortada'] != 'vistas/img/cabeceras/default/default.jpg'){
          unlink($_GET['imgPortada']);
        }

        ModeloCabeceras::mdlEliminarCabecera('cabeceras', $_GET['rutaCabecera']);

        /* ------------------------ End of ELIMINAR CABECERA ------------------------ */

        /* -------------------------------------------------------------------------- */
        /*                  QUITAR LAS SUBATEGORIAS DE LOS PRODUCTOS                  */
        /* -------------------------------------------------------------------------- */

        $traerProductos = ModeloProductos::mdlMostrarProductos('productos', 'id_subcategoria', $_GET['idSubCategoria']);

        foreach ($traerProductos as $key => $value) {
          $item1 = 'id_subcategoria';
          $valor1 = 0;
          $item2 = 'id';
          $valor2 = $value['id'];
          ModeloProductos::mdlActualizarProductos('productos', $item1, $valor1, $item2, $valor2);
        }

        /* ------------- End of QUITAR LAS SUBATEGORIAS DE LOS PRODUCTOS ------------ */

        $respuesta = ModeloSubCategorias::mdlEliminarSubCategoria('subcategorias', $datos);

        if ($respuesta == 'ok') {

          echo'<script>

              Swal.fire({
                title: "¡OK!",
                text: "La subcategoría ha sido borrada correctamente",
                icon: "success",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false,
              }).then((isConfirm) => {
                if (isConfirm) {
                  window.location = "subcategorias";
                }
              })

          </script>';

        }

      } else {

        echo'<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "La subcategoría no puede ser eliminada por que contiene productos",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "subcategorias";
            }
          })
        </script>';

      }

    }

  }

  /* ---------------------- End of ELIMINAR SUBCATEGORIA ---------------------- */

}