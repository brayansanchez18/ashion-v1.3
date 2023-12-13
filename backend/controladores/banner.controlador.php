<?php

class ControaldorBanner {

  /* -------------------------------------------------------------------------- */
  /*                               MOSTRAR BANNER                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarBanner($item, $valor) {
    $tabla = 'slide';
    $respuesta = ModeloSlide::mdlMostrarSlide($tabla, $item, $valor);
    return $respuesta;
  }

  /* -------------------------- End of MOSTRAR BANNER ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                                EDITAR BANNER                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrEditarBanner() {

    if (isset($_POST['idBanner'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nombreBanner'])) {

        /* -------------------------------------------------------------------------- */
        /*                               VALIDAR IMAGEN                               */
        /* -------------------------------------------------------------------------- */

        $ruta = $_POST['imgBannerActual'];

        if (isset($_FILES['imagenBanner']['tmp_name']) && !empty($_FILES['imagenBanner']['tmp_name'])) {

          list($ancho, $alto) = getimagesize($_FILES['imagenBanner']['tmp_name']);

          $nuevoAncho = 955;
          $nuevoAlto = 638;

          /* -------------------------------------------------------------------------- */
          /*             PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD             */
          /* -------------------------------------------------------------------------- */

          if (!empty($_POST['imgBannerActual'])) {
            unlink($_POST['imgBannerActual']);
          } else {
            mkdir($directorio, 0755);
          }

          /* -------- End of PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD ------- */

          /* -------------------------------------------------------------------------- */
          /*      DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO      */
          /* -------------------------------------------------------------------------- */

          if ($_FILES['imagenBanner']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
						$ruta = 'vistas/img/banner/'.$aleatorio.'.jpg';
						$origen = imagecreatefromjpeg($_FILES['imagenBanner']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($_FILES['imagenBanner']['type'] == 'image/png') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
						$ruta = 'vistas/img/banner/'.$aleatorio.'.png';
						$origen = imagecreatefrompng($_FILES['imagenBanner']['tmp_name']);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          /* -- End DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO -- */

        }

        /* -------------------------- ENd of VALIDAR IMAGEN ------------------------- */

        if ($_POST['textonuevo'] == '') {
          $texto = $_POST['textoBannerActual'];
        } else {
          $texto = $_POST['textonuevo'];
        }

        $tabla = 'slide';

        $datos = array('id' => 1,
                      'nombre' => $_POST['nombreBanner'],
                      'imgFondo' => $ruta,
                      'titulo' => $_POST['tiutloBanner'],
                      'texto' => $texto,
                      'boton' => $_POST['textoBoton'],
                      'ruta' => $_POST['rutaBoton']
                    );

        $respuesta = ModeloSlide::mdlEditarBanner($tabla, $datos);

        if ($respuesta == 'ok') {

          echo '<script>

          Swal.fire({
            title: "¡OK!",
            text: "El Banner ha sido editado correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "banner";
            }
          });

          </script>';

        }

      } else {

        echo '<script>

        Swal.fire({
            title: "¡ERROR!",
            text: "El nombre del banner no puede tener caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "banner";
            }
          });

        </script>';

      }

    }

  }

  /* -------------------------- End of EDITAR BANNER -------------------------- */

}