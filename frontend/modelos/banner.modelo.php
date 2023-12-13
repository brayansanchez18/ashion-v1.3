<?php

require_once 'conexion.php';

class ModeloSlide {

  /* -------------------------------------------------------------------------- */
  /*                              BANNER DE INICIO                              */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarSlide($tabla) {
		$stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt ->fetchAll();
		$stmt -> close();
		$stmt = null;
	}

  /* ------------------------- End of BANNER DE INICIO ------------------------ */

}