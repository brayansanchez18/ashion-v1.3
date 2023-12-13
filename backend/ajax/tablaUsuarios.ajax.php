<?php

require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';
require_once '../controladores/rutas.php';

class TablaUsuarios {

  /* -------------------------------------------------------------------------- */
  /*                        MOSTRAR LA TABLA DE USUARIOS                        */
  /* -------------------------------------------------------------------------- */

  public function mostrarTabla() {

    $frontend = Ruta::ctrRuta();
    $item = null;
    $valor = null;
    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

    $datosJson = '{"data": [ ';

    for ($i = 0; $i < count($usuarios); $i++) {

      /* -------------------------------------------------------------------------- */
      /*                             TRAER FOTO USUARIO                             */
      /* -------------------------------------------------------------------------- */

      if ($usuarios[$i]['foto'] != '' ) {
        $foto = "<img class='img-circle' src='".$frontend.$usuarios[$i]['foto']."' width='60px'>";
      } else {
        $foto = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='60px'>";
      }

      /* ------------------------ End of TRAER FOTO USUARIO ----------------------- */

      /* -------------------------------------------------------------------------- */
      /*                               REVISAR ESTADO                               */
      /* -------------------------------------------------------------------------- */

      if ($usuarios[$i]['modo'] == 'directo') {

        if ( $usuarios[$i]['verificacion'] == 1) {
          $colorEstado = 'btn-danger';
          $textoEstado = 'Desactivado';
          $estadoUsuario = 0;
        } else {
          $colorEstado = 'btn-success';
          $textoEstado = 'Activado';
          $estadoUsuario = 1;
        }

        $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idUsuario='". $usuarios[$i]['id']."' estadoUsuario='".$estadoUsuario."'>".$textoEstado."</button>";

      } else {
        $estado = "<button class='btn btn-xs btn-info'>Activado</button>";
      }

      /* -------------------------- End of REVISAR ESTADO ------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                             DEVOLVER DATOS JSON                            */
      /* -------------------------------------------------------------------------- */

      $datosJson	 .= '[
            "'.($i+1).'",
            "'.$usuarios[$i]['nombre'].'",
            "'.$usuarios[$i]['email'].'",
            "'.$foto.'",
            "'.$estado.'",
            "'.$usuarios[$i]['fecha'].'"
          ],';

      /* ----------------------- End of DEVOLVER DATOS JSON ----------------------- */

    }

    $datosJson = substr($datosJson, 0, -1);
    $datosJson.=  ']}';
    echo $datosJson;

  }

  /* ------------------- End of MOSTRAR LA TABLA DE USUARIOS ------------------ */

}

/* -------------------------------------------------------------------------- */
/*                        MOSTRAR LA TABLA DE USUARIOS                        */
/* -------------------------------------------------------------------------- */

$activar = new TablaUsuarios();
$activar -> mostrarTabla();

/* ------------------- End of MOSTRAR LA TABLA DE USUARIOS ------------------ */