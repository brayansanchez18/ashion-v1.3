<?php

class ControladorUsuarios {

  /* -------------------------------------------------------------------------- */
  /*                           MOSTRAR TOTAL USUARIOS                           */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarTotalUsuarios($orden) {
    $tabla = 'usuarios';
    $respuesta = ModeloUsuarios::mdlMostrarTotalUsuarios($tabla, $orden);
    return $respuesta;
  }

  /* ---------------------- End of MOSTRAR TOTAL USUARIOS --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              MOSTRAR USUARIOS                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarUsuarios($item, $valor){
    $tabla = 'usuarios';
    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------- End of MOSTRAR USUARIOS ------------------------ */

}