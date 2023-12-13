<?php
require_once '../controladores/administradores.controlador.php';
require_once '../modelos/administradores.modelo.php';

class AjaxAdministradores {

  /* -------------------------------------------------------------------------- */
  /*                               ACTIVAR PERFIL                               */
  /* -------------------------------------------------------------------------- */

  public $activarPerfil;
  public $activarId;

  public function ajaxActivarPerfil() {
    $tabla = 'administradores';
    $item1 = 'estado';
    $valor1 = $this->activarPerfil;
    $item2 = 'id';
    $valor2 = $this->activarId;
    $respuesta = ModeloAdministradores::mdlActualizarPerfil($tabla, $item1, $valor1, $item2, $valor2);
    echo $respuesta;
  }

  /* -------------------------- End of ACTIVAR PERFIL ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                                EDITAR PERFIL                               */
  /* -------------------------------------------------------------------------- */

  public $idPerfil;

  public function ajaxEditarPerfil() {
    $item = 'id';
    $valor = $this->idPerfil;
    $respuesta = ControladorAdministradores::ctrMostrarAdministradores($item, $valor);
    echo json_encode($respuesta);
  }

  /* -------------------------- End of EDITAR PERFIL -------------------------- */

}

/* -------------------------------------------------------------------------- */
/*                               ACTIVAR PERFIL                               */
/* -------------------------------------------------------------------------- */

if (isset($_POST['activarPerfil'])) {
  $activarPerfil = new AjaxAdministradores();
  $activarPerfil -> activarPerfil = $_POST['activarPerfil'];
  $activarPerfil -> activarId = $_POST['activarId'];
  $activarPerfil -> ajaxActivarPerfil();
}

/* -------------------------- End of ACTIVAR PERFIL ------------------------- */

/* -------------------------------------------------------------------------- */
/*                                EDITAR PERFIL                               */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idPerfil'])) {
  $editar = new AjaxAdministradores();
  $editar -> idPerfil = $_POST['idPerfil'];
  $editar -> ajaxEditarPerfil();
}

/* -------------------------- End of EDITAR PERFIL -------------------------- */