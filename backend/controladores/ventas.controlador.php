<?php

class ControladorVentas {

  /* -------------------------------------------------------------------------- */
  /*                            MOSTRAR TOTAL VENTAS                            */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarTotalVentas() {
    $tabla = 'compras';
    $respuesta = ModeloVentas::mdlMostrarTotalVentas($tabla);
    return $respuesta;
  }

  /* ----------------------- End of MOSTRAR TOTAL VENTAS ---------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               MOSTRAR VENTAS                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarVentas($modo) {
    $tabla = 'compras';
    $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $modo);
    return $respuesta;
  }

  /* -------------------------- End of MOSTRAR VENTAS ------------------------- */

}