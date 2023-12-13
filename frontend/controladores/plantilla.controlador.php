<?php

class ControladorPlantilla {

  /* -------------------------------------------------------------------------- */
  /*                            LLAMAMOS LA PLANTILLA                           */
  /* -------------------------------------------------------------------------- */

  static public function plantilla() {
    include_once 'vistas/plantilla.php';
  }

  /* ---------------------- End of LLAMAMOS LA PLANTILLA ---------------------- */

  /* -------------------------------------------------------------------------- */
  /*                TRAEMOS LOS ESTILOS DINAMICOS DE LA PLANTILLA               */
  /* -------------------------------------------------------------------------- */

	static public function ctrEstiloPlantilla() {
		$tabla = 'plantilla';
		$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);
		return $respuesta;
	}

	/* ---------- End of TRAEMOS LOS ESTILOS DINAMICOS DE LA PLANTILLA ---------- */

  /* -------------------------------------------------------------------------- */
  /*                            TRAEMOS LAS CABECERAS                           */
  /* -------------------------------------------------------------------------- */

  static public function ctrTraerCabeceras($ruta) {
		$tabla = 'cabeceras';
		$respuesta = ModeloPlantilla::mdlTraerCabeceras($tabla, $ruta);
		return $respuesta;
	}

  /* -------------------------- TRAEMOS LAS CABECERAS ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                     MOSTRAMOS INFORMACION PARA CONTACTO                    */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarContacto() {
		$tabla = 'footer';
		$respuesta = ModeloPlantilla::mdlMostrarContacto($tabla);
		return $respuesta;
	}

  /* --------------- End of MOSTRAMOS INFORMACION PARA CONTACTO --------------- */

  /* -------------------------------------------------------------------------- */
  /*                       TRAER DIVISA DE MANERA DINAMICA                      */
  /* -------------------------------------------------------------------------- */

	static public function ctrMostrarDivisa() {
		$tabla = 'comercio';
		$respuesta = ModeloPlantilla::mdlMostrarDivisa($tabla);
		return $respuesta;
	}

	/* ----------------- End of TRAER DIVISA DE MANERA DINAMICA ----------------- */
}