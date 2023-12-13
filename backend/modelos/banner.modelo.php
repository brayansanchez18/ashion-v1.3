<?php

require_once 'conexion.php';

class ModeloSlide {

  /* -------------------------------------------------------------------------- */
  /*                              BANNER DE INICIO                              */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarSlide($tabla, $item, $valor) {

    if ($item != null) {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      $stmt -> execute();
      return $stmt -> fetch();

    } else {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();

    }

    $stmt = null;
	}

  /* ------------------------- End of BANNER DE INICIO ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                                EDITAR BANNER                               */
  /* -------------------------------------------------------------------------- */

  static public function mdlEditarBanner($tabla, $datos) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, imgFondo = :imgFondo, titulo = :titulo, texto = :texto, boton = :boton, ruta = :ruta WHERE id = 1");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":imgFondo", $datos["imgFondo"], PDO::PARAM_STR);
		$stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":texto", $datos["texto"], PDO::PARAM_STR);
		$stmt -> bindParam(":boton", $datos["boton"], PDO::PARAM_STR);
    $stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt -> close();
		$stmt = null;
  }

  /* -------------------------- End of EDITAR BANNER -------------------------- */

}