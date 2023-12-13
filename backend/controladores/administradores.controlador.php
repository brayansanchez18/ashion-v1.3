<?php

class ControladorAdministradores {

  /* -------------------------------------------------------------------------- */
  /*                          INGRESO DE ADMINISTRADOR                          */
  /* -------------------------------------------------------------------------- */

  public function ctrIngresoAdministrador() {

    if (isset($_POST['ingEmail'])) {

      if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['ingEmail']) &&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {

        $encriptar = crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $tabla = 'administradores';
        $item = 'email';
        $valor = $_POST['ingEmail'];

        $respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);

        if (is_array($respuesta) && $respuesta['email'] == $_POST['ingEmail'] && $respuesta['pass'] == $encriptar) {

          if ($respuesta['estado'] == 1) {

            $_SESSION['validarSesionBackend'] = 'ok';
            $_SESSION['id'] = $respuesta['id'];
            $_SESSION['nombre'] = $respuesta['nombre'];
            $_SESSION['foto'] = $respuesta['foto'];
            $_SESSION['email'] = $respuesta['email'];
            $_SESSION['password'] = $respuesta['pass'];
            $_SESSION['perfil'] = $respuesta['perfil'];

            echo '<script>
              window.location = "inicio";
            </script>';

          } else {

            echo '<script>
                    Swal.fire({
                      title: "¡NO PUEDES INGRESAR!",
                      text: "Por favor vea que su cuenta este verificada para poder ingresar al sistema",
                      icon: "warning",
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false,
                    }).then((isConfirm) => {
                      if (isConfirm) {}
                    });
                  </script>';

          }

        } else {

          echo '<script>
                  Swal.fire({
                    title: "¡NO PUEDES INGRESAR!",
                    text: "Por favor verifique que usted forme parte del equipo de administradores, para poder ingresar al sistema",
                    icon: "error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                  }).then((isConfirm) => {
                    if (isConfirm) {}
                  });
                </script>';

        }

      }

    }

  }

  /* --------------------- End of INGRESO DE ADMINISTRADOR -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                           MOSTRAR ADMINISTRADORES                          */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarAdministradores($item, $valor) {
    $tabla = 'administradores';
    $respuesta = ModeloAdministradores::MdlMostrarAdministradores($tabla, $item, $valor);
    return $respuesta;
  }

  /* --------------------- End of MOSTRAR ADMINISTRADORES --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             REGISTRO DE PERFIL                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearPerfil() {

    if (isset($_POST['nuevoPerfil'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])) {

        /* -------------------------------------------------------------------------- */
        /*                               VALIDAR IMAGEN                               */
        /* -------------------------------------------------------------------------- */

        $ruta = '';

        if (isset($_FILES['nuevaFoto']['tmp_name']) && !empty($_FILES['nuevaFoto']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                              DEFINIMOS MEDIDAS                             */
          /* -------------------------------------------------------------------------- */

          list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);
          $nuevoAncho = 500;
          $nuevoAlto = 500;

          /* ------------------------ End of DEFINIMOS MEDIDAS ------------------------ */

          /* -------------------------------------------------------------------------- */
          /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
          /* -------------------------------------------------------------------------- */

          if ($_FILES['nuevaFoto']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/perfiles/'.$aleatorio.'.jpg';
            $origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($_FILES['nuevaFoto']['type'] == 'image/png') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/perfiles/'.$aleatorio.'.png';
            $origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          /* --- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP --- */

        }

        /* -------------------------- End of VALIDAR IMAGEN ------------------------- */

        $tabla = 'administradores';

        $encriptar = crypt($_POST['nuevoPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $datos = array('nombre' => $_POST['nuevoNombre'],
                        'email' => $_POST['nuevoEmail'],
                        'password' => $encriptar,
                        'perfil' => $_POST['nuevoPerfil'],
                        'foto'=>$ruta,
                        'estado' => 1);

        $respuesta = ModeloAdministradores::mdlIngresarPerfil($tabla, $datos);

        if ($respuesta == 'ok') {

          echo '<script>
            Swal.fire({
              title: "¡GUARDADO!",
              text: "El perfil ha sido guardado correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "perfiles";
              }
            })
          </script>';

        }

      } else {

        echo '<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El nombre de perfil y/o contraseña no puede ir vacío o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "perfiles";
            }
          })
        </script>';

      }

    }

  }

  /* ------------------------ End of REGISTRO DE PERFIL ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                                EDITAR PERFIL                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrEditarPerfil() {

    if (isset($_POST['idPerfil'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])) {

        /* -------------------------------------------------------------------------- */
        /*                               VALIDAR IMAGEN                               */
        /* -------------------------------------------------------------------------- */

        $ruta = $_POST['fotoActual'];

        if (isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES['editarFoto']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                            DEFINIMOS LAS MEDIDAS                           */
          /* -------------------------------------------------------------------------- */

          list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);
          $nuevoAncho = 500;
          $nuevoAlto = 500;

          /* ---------------------- End of DEFINIMOS LAS MEDIDAS ---------------------- */

          /* -------------------------------------------------------------------------- */
          /*             PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD             */
          /* -------------------------------------------------------------------------- */

          if (!empty($_POST['fotoActual'])) { unlink($_POST['fotoActual']); } else { mkdir($directorio, 0755); }

          /* -------- End of PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD ------- */

          /* -------------------------------------------------------------------------- */
          /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
          /* -------------------------------------------------------------------------- */

          if ($_FILES['editarFoto']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/perfiles/'.$aleatorio.'.jpg';
            $origen = imagecreatefromjpeg($_FILES['editarFoto']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($_FILES['editarFoto']['type'] == 'image/png') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/perfiles/'.$aleatorio.'.png';
            $origen = imagecreatefrompng($_FILES['editarFoto']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          /* --- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP --- */

        }

        /* -------------------------- End of VALIDAR IMAGEN ------------------------- */

        $tabla = 'administradores';

        if ($_POST['editarPassword'] != '') {

          if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPassword'])) {

            $encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

          } else {

            echo '<script>
              Swal.fire({
                title: "¡ERROR!",
                text: "La contraseña no puede ir vacía o llevar caracteres especiales",
                icon: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false,
              }).then((isConfirm) => {
                if (isConfirm) {
                  window.location = "perfiles";
                }
              })
            </script>';

          }

        } else {

          $encriptar = $_POST['passwordActual'];

        }

        $datos = array('id' => $_POST['idPerfil'],
                      'nombre' => $_POST['editarNombre'],
                      'email' => $_POST['editarEmail'],
                      'password' => $encriptar,
                      'perfil' => $_POST['editarPerfil'],
                      'foto' => $ruta);

        $respuesta = ModeloAdministradores::mdlEditarPerfil($tabla, $datos);

        if ($respuesta == 'ok') {

          echo '<script>
            Swal.fire({
              title: "¡EDITADO!",
              text: "El perfil ha sido editado correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "perfiles";
              }
            })
          </script>';

        }

      } else {

        echo '<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El nombre no puede ir vacío o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "perfiles";
            }
          })
        </script>';

      }

    }

  }

  /* -------------------------- End of EDITAR PERFIL -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               ELIMINAR PERFIL                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrEliminarPerfil() {

    if (isset($_GET['idPerfil'])) {

      $tabla ='administradores';
      $datos = $_GET['idPerfil'];

      if ($_GET['fotoPerfil'] != '') { unlink($_GET['fotoPerfil']); }

      $respuesta = ModeloAdministradores::mdlEliminarPerfil($tabla, $datos);

      if ($respuesta == 'ok') {

        echo '<script>
          Swal.fire({
            title: "¡BORRADO!",
            text: "El perfil ha sido borrado correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "perfiles";
            }
          })
        </script>';

      }

    }

  }

  /* ------------------------- End of ELIMINAR PERFIL ------------------------- */

}