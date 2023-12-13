<?php

class ControladorProductos {

  /* -------------------------------------------------------------------------- */
  /*                           MOSTRAR TOTAL PRODUCTOS                          */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarTotalProductos($orden){
    $tabla = 'productos';
    $respuesta = ModeloProductos::mdlMostrarTotalProductos($tabla, $orden);
    return $respuesta;
  }

  /* --------------------- End of MOSTRAR TOTAL PRODUCTOS --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              MOSTRAR PRODUCTOS                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarProductos($item, $valor) {
    $tabla = 'productos';
    $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------ End of MOSTRAR PRODUCTOS ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                              SUBIR MULTIMEDIA                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrSubirMultimedia($datos, $ruta) {

    if (isset($datos['tmp_name']) && !empty($datos['tmp_name'])) {

      /* -------------------------------------------------------------------------- */
      /*                            DEFINIMOS LAS MEDIDAS                           */
      /* -------------------------------------------------------------------------- */

      list($ancho, $alto) = getimagesize($datos['tmp_name']);
			$nuevoAncho = 1000;
			$nuevoAlto = 1000;

      /* ---------------------- End of DEFINIMOS LAS MEDIDAS ---------------------- */

      /* -------------------------------------------------------------------------- */
      /*          CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA MULTIMEDIA         */
      /* -------------------------------------------------------------------------- */

      $directorio = '../vistas/img/multimedia/'.$ruta;

      /* ---- End of CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA MULTIMEDIA ---- */

      /* -------------------------------------------------------------------------- */
      /*       PREGUNTAMOS SI EXISTE UN DIRECTORIO DE MULTIMEDIA CON ESTA RUTA      */
      /* -------------------------------------------------------------------------- */

      if (!file_exists($directorio)) { mkdir($directorio, 0755); }

      /* - End of PREGUNTAMOS SI EXISTE UN DIRECTORIO DE MULTIMEDIA CON ESTA RUTA - */

      /* -------------------------------------------------------------------------- */
      /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
      /* -------------------------------------------------------------------------- */

      if ($datos['type'] == 'image/jpeg') {

        /* -------------------------------------------------------------------------- */
        /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
        /* -------------------------------------------------------------------------- */

        $rutaMultimedia = $directorio.'/'.$datos['name'];
        $origen = imagecreatefromjpeg($datos['tmp_name']);
        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
        imagejpeg($destino, $rutaMultimedia);

        /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

      }

      if ($datos['type'] == 'image/png') {

        /* -------------------------------------------------------------------------- */
        /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
        /* -------------------------------------------------------------------------- */

        $rutaMultimedia = $directorio.'/'.$datos['name'];
        $origen = imagecreatefrompng($datos['tmp_name']);
        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        imagealphablending($destino, FALSE);
        imagesavealpha($destino, TRUE);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
        imagepng($destino, $rutaMultimedia);

        /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

      }

      return $rutaMultimedia;

      /* --- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP --- */

    }

  }

  /* ------------------------- End of SUBIR MULTIMEDIA ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                               CREAR PRODUCTOS                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearProducto($datos) {

    if (isset($datos['tituloProducto'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos['tituloProducto'])) {

        /* -------------------------------------------------------------------------- */
        /*                           VALIDAR IMAGEN PORTADA                           */
        /* -------------------------------------------------------------------------- */

        $rutaPortada = '../vistas/img/cabeceras/default/default.jpg';

				if (isset($datos['fotoPortada']['tmp_name']) && !empty($datos['fotoPortada']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                            DEFINIMOS LAS MEDIDAS                           */
          /* -------------------------------------------------------------------------- */

          list($ancho, $alto) = getimagesize($datos['fotoPortada']['tmp_name']);
          $nuevoAncho = 1280;
          $nuevoAlto = 720;

          /* ---------------------- End of DEFINIMOS LAS MEDIDAS ---------------------- */

          /* -------------------------------------------------------------------------- */
          /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
          /* -------------------------------------------------------------------------- */

          if ($datos['fotoPortada']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $rutaPortada = '../vistas/img/cabeceras/'.$datos['rutaProducto'].'.jpg';
            $origen = imagecreatefromjpeg($datos['fotoPortada']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $rutaPortada);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($datos['fotoPortada']['type'] == 'image/png') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $rutaPortada = '../vistas/img/cabeceras/'.$datos['rutaProducto'].'.png';
            $origen = imagecreatefrompng($datos['fotoPortada']['tmp_name']);
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
        /*                          VALIDAR IMAGEN PRINCIPAL                          */
        /* -------------------------------------------------------------------------- */

        $rutaFotoPrincipal = '../vistas/img/productos/default/default.jpg';

        if (isset($datos['fotoPrincipal']['tmp_name']) && !empty($datos['fotoPrincipal']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                            DEFINIMOS LAS MEDIDAS                           */
          /* -------------------------------------------------------------------------- */

          list($ancho, $alto) = getimagesize($datos['fotoPrincipal']['tmp_name']);
          $nuevoAncho = 400;
          $nuevoAlto = 450;

          /* ---------------------- End of DEFINIMOS LAS MEDIDAS ---------------------- */

          /* -------------------------------------------------------------------------- */
          /*          DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES PHP          */
          /* -------------------------------------------------------------------------- */

          if ($datos['fotoPrincipal']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $rutaFotoPrincipal = '../vistas/img/productos/'.$datos['rutaProducto'].'.jpg';
            $origen = imagecreatefromjpeg($datos['fotoPrincipal']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $rutaFotoPrincipal);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($datos['fotoPrincipal']['type'] == 'image/png') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $rutaFotoPrincipal = '../vistas/img/productos/'.$datos['rutaProducto'].'.png';
            $origen = imagecreatefrompng($datos['fotoPrincipal']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagealphablending($destino, FALSE);
            imagesavealpha($destino, TRUE);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $rutaFotoPrincipal);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          /* ----- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES PHP ---- */

        }

        /* --------------------- End of VALIDAR IMAGEN PRINCIPAL -------------------- */

        /* -------------------------------------------------------------------------- */
        /*                    PREGUNTAMOS SI VIENE OFERTE EN CAMINO                   */
        /* -------------------------------------------------------------------------- */

        if ($datos['selActivarOferta'] == 'oferta') {

          $datosProducto = array(
            'titulo'=>$datos['tituloProducto'],
            'idCategoria'=>$datos['categoria'],
            'idSubCategoria'=>$datos['subCategoria'],
            'detalles'=>$datos['detalles'],
            'multimedia'=>$datos['multimedia'],
            'ruta'=>$datos['rutaProducto'],
            'estado'=> 1,
            'descripcion'=> $datos['descripcionProducto'],
            'palabrasClaves'=> $datos['pClavesProducto'],
            'precio'=> $datos['precio'],
            'peso'=> $datos['peso'],
            'entrega'=> $datos['entrega'],
            'stock'=> $datos['stock'],
            'imgPortada'=>substr($rutaPortada,3),
            'imgFotoPrincipal'=>substr($rutaFotoPrincipal,3),
            'oferta'=>1,
            'precioOferta'=>$datos['precioOferta'],
            'descuentoOferta'=>$datos['descuentoOferta'],
            'finOferta'=>$datos['finOferta']
          );

        } else {

          $datosProducto = array(
            'titulo'=>$datos['tituloProducto'],
            'idCategoria'=>$datos['categoria'],
            'idSubCategoria'=>$datos['subCategoria'],
            'detalles'=>$datos['detalles'],
            'multimedia'=>$datos['multimedia'],
            'ruta'=>$datos['rutaProducto'],
            'estado'=> 1,
            'descripcion'=> $datos['descripcionProducto'],
            'palabrasClaves'=> $datos['pClavesProducto'],
            'precio'=> $datos['precio'],
            'peso'=> $datos['peso'],
            'entrega'=> $datos['entrega'],
            'stock'=> $datos['stock'],
            'imgPortada'=>substr($rutaPortada,3),
            'imgFotoPrincipal'=>substr($rutaFotoPrincipal,3),
            'oferta'=>0,
            'precioOferta'=>0,
            'descuentoOferta'=>0,
            'finOferta'=>''
          );

        }

        ModeloCabeceras::mdlIngresarCabecera('cabeceras', $datosProducto);
        $respuesta = ModeloProductos::mdlIngresarProducto('productos', $datosProducto);
        return $respuesta;

        /* -------------- End of PREGUNTAMOS SI VIENE OFERTE EN CAMINO -------------- */

      } else {

        echo '<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El nombre del producto no puede ir vacío",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "productos";
            }
          })
        </script>';

        return;

      }

    }

  }

  /* ------------------------- End of CREAR PRODUCTOS ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              EDITAR PRODUCTOS                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrEditarProducto($datos) {

    if (isset($datos['idProducto'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos['tituloProducto'])) {

        /* -------------------------------------------------------------------------- */
        /*               ELIMINAR LAS FOTOS DE MULTIMEDIA DE LA CARPETA               */
        /* -------------------------------------------------------------------------- */

        $item = 'id';
        $valor = $datos['idProducto'];

        $traerProductos = ModeloProductos::mdlMostrarProductos('productos', $item, $valor);

        foreach ($traerProductos as $key => $value) {

          $multimediaBD = json_decode($value['multimedia'],true);
          $multimediaEditar = json_decode($datos['multimedia'],true);

          $objectMultimediaBD = array();
          $objectMultimediaEditar = array();

          foreach ($multimediaBD as $key => $value) { array_push($objectMultimediaBD, $value['foto']); }

          foreach ($multimediaEditar as $key => $value) { array_push($objectMultimediaEditar, $value['foto']); }

          $borrarFoto = array_diff($objectMultimediaBD, $objectMultimediaEditar);

          foreach ($borrarFoto as $key => $value) { unlink('../'.$value); }

        }

        /* ---------- End of ELIMINAR LAS FOTOS DE MULTIMEDIA DE LA CARPETA --------- */

        /* -------------------------------------------------------------------------- */
        /*                           VALIDAR IMAGEN PORTADA                           */
        /* -------------------------------------------------------------------------- */

        $rutaPortada = '../'.$datos['antiguaFotoPortada'];

        if (isset($datos['fotoPortada']['tmp_name']) && !empty($datos['fotoPortada']['tmp_name'])) {

          /*=============================================
          BORRAMOS ANTIGUA FOTO PORTADA
          =============================================*/

          unlink('../'.$datos['antiguaFotoPortada']);

          /*=============================================
          DEFINIMOS LAS MEDIDAS
          =============================================*/

          list($ancho, $alto) = getimagesize($datos['fotoPortada']['tmp_name']);	
          $nuevoAncho = 1280;
          $nuevoAlto = 720;

          /*=============================================
          DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
          =============================================*/

          if ($datos['fotoPortada']['type'] == 'image/jpeg') {

            /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

            $aleatorio = mt_rand(100,999);
            $rutaPortada = '../vistas/img/cabeceras/'.$datos['rutaProducto'].'.jpg';
            $origen = imagecreatefromjpeg($datos['fotoPortada']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $rutaPortada);

          }

          if ($datos['fotoPortada']['type'] == 'image/png') {

            /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

            $aleatorio = mt_rand(100,999);
            $rutaPortada = '../vistas/img/cabeceras/'.$datos['rutaProducto'].'.png';
            $origen = imagecreatefrompng($datos['fotoPortada']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagealphablending($destino, FALSE);
            imagesavealpha($destino, TRUE);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $rutaPortada);

          }

        }

        /* ---------------------- End of VALIDAR IMAGEN PORTADA --------------------- */

        /*=============================================
        VALIDAR IMAGEN PRINCIPAL
        =============================================*/

        $rutaFotoPrincipal = '../'.$datos['antiguaFotoPrincipal'];

        if (isset($datos['fotoPrincipal']['tmp_name']) && !empty($datos['fotoPrincipal']['tmp_name'])) {

          /*=============================================
          BORRAMOS ANTIGUA FOTO PRINCIPAL
          =============================================*/

          unlink('../'.$datos['antiguaFotoPrincipal']);

          /*=============================================
          DEFINIMOS LAS MEDIDAS
          =============================================*/

          list($ancho, $alto) = getimagesize($datos['fotoPrincipal']['tmp_name']);
          $nuevoAncho = 400;
          $nuevoAlto = 450;

          /*=============================================
          DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
          =============================================*/

          if ($datos['fotoPrincipal']['type'] == 'image/jpeg') {

            /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

            $aleatorio = mt_rand(100,999);
            $rutaFotoPrincipal = '../vistas/img/productos/'.$datos['rutaProducto'].'.jpg';
            $origen = imagecreatefromjpeg($datos['fotoPrincipal']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $rutaFotoPrincipal);

          }

          if ($datos['fotoPrincipal']['type'] == 'image/png') {

            /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

            $aleatorio = mt_rand(100,999);
            $rutaFotoPrincipal = '../vistas/img/productos/'.$datos['rutaProducto'].'.png';
            $origen = imagecreatefrompng($datos['fotoPrincipal']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagealphablending($destino, FALSE);
            imagesavealpha($destino, TRUE);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $rutaFotoPrincipal);

          }

        }

        /*=============================================
        PREGUNTAMOS SI VIENE OFERTE EN CAMINO
        =============================================*/

        if ($datos['selActivarOferta'] == 'oferta') {

          $datosProducto = array(
            'id'=>$datos['idProducto'],
            'titulo'=>$datos['tituloProducto'],
            'idCategoria'=>$datos['categoria'],
            'idSubCategoria'=>$datos['subCategoria'],
            'detalles'=>$datos['detalles'],
            'multimedia'=>$datos['multimedia'],
            'ruta'=>$datos['rutaProducto'],
            'estado'=> 1,
            'idCabecera'=>$datos['idCabecera'],
            'descripcion'=> $datos['descripcionProducto'],
            'palabrasClaves'=> $datos['pClavesProducto'],
            'precio'=> $datos['precio'],
            'stock'=> $datos['stock'],
            'peso'=> $datos['peso'],
            'entrega'=> $datos['entrega'],
            'imgPortada'=>substr($rutaPortada,3),
            'imgFotoPrincipal'=>substr($rutaFotoPrincipal,3),
            'oferta'=>1,
            'precioOferta'=>$datos['precioOferta'],
            'descuentoOferta'=>$datos['descuentoOferta'],
            'finOferta'=>$datos['finOferta']
          );

        } else {

          $datosProducto = array(
            'id'=>$datos['idProducto'],
            'titulo'=>$datos['tituloProducto'],
            'idCategoria'=>$datos['categoria'],
            'idSubCategoria'=>$datos['subCategoria'],
            'detalles'=>$datos['detalles'],
            'multimedia'=>$datos['multimedia'],
            'ruta'=>$datos['rutaProducto'],
            'estado'=> 1,
            'idCabecera'=>$datos['idCabecera'],
            'descripcion'=> $datos['descripcionProducto'],
            'palabrasClaves'=> $datos['pClavesProducto'],
            'precio'=> $datos['precio'],
            'stock'=> $datos['stock'],
            'peso'=> $datos['peso'],
            'entrega'=> $datos['entrega'],
            'imgPortada'=>substr($rutaPortada,3),
            'imgFotoPrincipal'=>substr($rutaFotoPrincipal,3),
            'oferta'=>0,
            'precioOferta'=>0,
            'descuentoOferta'=>0,
            'finOferta'=>''
          );

        }

        ModeloCabeceras::mdlEditarCabecera("cabeceras", $datosProducto);
        $respuesta = ModeloProductos::mdlEditarProducto("productos", $datosProducto);
        return $respuesta;

      } else {

        echo '<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El nombre del producto no puede ir vacío o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "productos";
            }
          })
        </script>';

        return;

      }

    }

  }

  /* ------------------------- End of EDITAR PRODUCTOS ------------------------ */

  /*=========================================
  =            ELIMINAR PRODUCTO            =
  =========================================*/

  static public function ctrEliminarProducto() {

    if (isset($_GET['idProducto'])) {

      $datos = $_GET['idProducto'];

      /*=============================================
      ELIMINAR MULTIMEDIA
      =============================================*/

      $borrar = glob('vistas/img/multimedia/'.$_GET['rutaCabecera'].'/*');
      foreach($borrar as $file){ unlink($file); }
      rmdir('vistas/img/multimedia/'.$_GET['rutaCabecera']);

      /*=============================================
      ELIMINAR FOTO PRINCIPAL
      =============================================*/

      if ($_GET['imgPrincipal'] != '' && $_GET['imgPrincipal'] != 'vistas/img/productos/default/default.jpg') {
        unlink($_GET['imgPrincipal']);
      }

      /*=============================================
      ELIMINAR OFERTA
      =============================================*/

      if ($_GET['imgOferta'] != '') { unlink($_GET['imgOferta']); }

      /*=============================================
      ELIMINAR CABECERA
      =============================================*/

      if($_GET['imgPortada'] != '' && $_GET['imgPortada'] != 'vistas/img/cabeceras/default/default.jpg'){
        unlink($_GET['imgPortada']);
      }

      ModeloCabeceras::mdlEliminarCabecera('cabeceras', $_GET['rutaCabecera']);
      $respuesta = ModeloProductos::mdlEliminarProducto('productos', $datos);

      if ($respuesta == 'ok') {

        echo '<script>
          Swal.fire({
            title: "¡BORRADO!",
            text: "El producto ha sido borrado correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "productos";
            }
          })
        </script>';

      }

    }

  }

  /*=====  End of ELIMINAR PRODUCTO  ======*/

}