<?php

require_once 'conexion.php';

class ModeloAdministradores {

  /* -------------------------------------------------------------------------- */
  /*                           MOSTRAR ADMINISTRADORES                          */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarAdministradores($tabla, $item, $valor) {

    if ($item != null) {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      $stmt -> execute();
      return $stmt -> fetch();

    } else {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }

    $stmt-> close();
    $stmt = null;

	}

  /* --------------------- End of MOSTRAR ADMINISTRADORES --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              ACTUALIZAR PERFIL                             */
  /* -------------------------------------------------------------------------- */

  static public function mdlActualizarPerfil($tabla, $item1, $valor1, $item2, $valor2) {
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
    $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

    if ($stmt -> execute()) { return "ok"; } else { return "error"; }

    $stmt -> close();
    $stmt = null;
  }

  /* ------------------------ End of ACTUALIZAR PERFIL ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                             REGISTRO DE PERFIL                             */
  /* -------------------------------------------------------------------------- */

  static public function mdlIngresarPerfil($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, email, pass, foto, perfil, estado) VALUES (:nombre, :email, :pass, :foto, :perfil, :estado)");

    $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
    $stmt->bindParam(':pass', $datos['password'], PDO::PARAM_STR);
    $stmt->bindParam(':perfil', $datos['perfil'], PDO::PARAM_STR);
    $stmt->bindParam(':foto', $datos['foto'], PDO::PARAM_STR);
    $stmt->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);

    if ($stmt->execute()) { return 'ok'; } else { return 'error'; }

    $stmt->close();
    $stmt = null;

  }

  /* ------------------------ End of REGISTRO DE PERFIL ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                                EDITAR PERFIL                               */
  /* -------------------------------------------------------------------------- */

  static public function mdlEditarPerfil($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, pass = :pass, foto = :foto, perfil = :perfil WHERE id = :id");
    $stmt -> bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
    $stmt -> bindParam(':email', $datos['email'], PDO::PARAM_STR);
    $stmt -> bindParam(':pass', $datos['password'], PDO::PARAM_STR);
    $stmt -> bindParam(':perfil', $datos['perfil'], PDO::PARAM_STR);
    $stmt -> bindParam(':foto', $datos['foto'], PDO::PARAM_STR);
    $stmt -> bindParam(':id', $datos['id'], PDO::PARAM_INT);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;

  }

  /* -------------------------- End of EDITAR PERFIL -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               ELIMINAR PERFIL                              */
  /* -------------------------------------------------------------------------- */

  static public function mdlEliminarPerfil($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    $stmt -> bindParam(':id', $datos, PDO::PARAM_INT);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error';	}

    $stmt -> close();
    $stmt = null;

	}

  /* ------------------------- End of ELIMINAR PERFIL ------------------------- */

}