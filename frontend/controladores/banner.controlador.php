<?php

class ControladorSlide {

  /* -------------------------------------------------------------------------- */
  /*                              BANNER DE INICIO                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarSlide() {
		$tabla = 'slide';
		$respuesta = ModeloSlide::mdlMostrarSlide($tabla);
		return $respuesta;
	}

  /* ------------------------- End of BANNER DE INICIO ------------------------ */

}