<?php

require_once "../controladores/banner.controlador.php";
require_once "../modelos/banner.modelo.php";

class AjaxBanner {

  /* -------------------------------------------------------------------------- */
  /*                                EDITAR BANNER                               */
  /* -------------------------------------------------------------------------- */

  public $idBanner;

  public function ajaxEditarBanner() {
    $item = 'id';
    $valor = $this->idBanner;
    $respuesta = ControaldorBanner::ctrMostrarBanner($item, $valor);
    echo json_encode($respuesta);
  }

  /* -------------------------- End of EDITAR BANNER -------------------------- */

}

/* -------------------------------------------------------------------------- */
/*                                EDITAR BANNER                               */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idBanner'])) {
  $editar = new AjaxBanner();
  $editar -> idBanner = $_POST['idBanner'];
  $editar -> ajaxEditarBanner();
}

/* -------------------------- End of EDITAR BANNER -------------------------- */