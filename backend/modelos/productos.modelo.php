<?php

require_once 'conexion.php';

class ModeloProductos {

  /* -------------------------------------------------------------------------- */
  /*                           MOSTRAR TOTAL PRODUCTOS                          */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarTotalProductos($tabla, $orden) {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt-> close();
    $stmt = null;
  }

  /* --------------------- End of MOSTRAR TOTAL PRODUCTOS --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                            ACTUALIZAR PRODUCTOS                            */
  /* -------------------------------------------------------------------------- */

  static public function mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
    $stmt -> bindParam(':'.$item1, $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(':'.$item2, $valor2, PDO::PARAM_STR);

    if ($stmt -> execute()) {
      return 'ok';
    } else {
      return 'error';
    }

    $stmt -> close();
    $stmt = null;

  }

  /* ----------------------- End of ACTUALIZAR PRODUCTOS ---------------------- */

  /* -------------------------------------------------------------------------- */
  /*                         ACTUALIZAR OFERTA PRODUCTOS                        */
  /* -------------------------------------------------------------------------- */

  static public function mdlActualizarOfertaProductos($tabla, $datos, $ofertadoPor, $precioOfertaActualizado, $descuentoOfertaActualizado, $idOferta) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $ofertadoPor = :$ofertadoPor, oferta = :oferta, precioOferta = :precioOferta, descuentoOferta = :descuentoOferta, finOferta = :finOferta WHERE id = :id");

    $stmt->bindParam(':'.$ofertadoPor, $datos['oferta'], PDO::PARAM_STR);
    $stmt->bindParam(':oferta', $datos['oferta'], PDO::PARAM_STR);
    $stmt->bindParam(':precioOferta', $precioOfertaActualizado, PDO::PARAM_STR);
    $stmt->bindParam(':descuentoOferta', $descuentoOfertaActualizado, PDO::PARAM_STR);
    $stmt->bindParam(':finOferta', $datos['finOferta'], PDO::PARAM_STR);
    $stmt -> bindParam(':id', $idOferta, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return 'ok';
    } else {
      return 'error';
    }

    $stmt->close();
    $stmt = null;

  }

  /* ------------------- End of ACTUALIZAR OFERTA PRODUCTOS ------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              MOSTRAR PRODUCTOS                             */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarProductos($tabla, $item, $valor) {

    if ($item != null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      $stmt -> execute();
      return $stmt -> fetchAll();
    } else {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");
      $stmt -> execute();
      return $stmt -> fetchAll();
    }

    $stmt -> close();
    $stmt = null;

	}

  /* ------------------------ End of MOSTRAR PRODUCTOS ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                               CREAR PRODUCTO                               */
  /* -------------------------------------------------------------------------- */

  static public function mdlIngresarProducto($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_subcategoria, ruta, estado, titulo, descripcion, multimedia, detalles, precio, stock, portada, oferta, precioOferta, descuentoOferta, finOferta, peso, entrega) VALUES (:id_categoria, :id_subcategoria, :ruta, :estado, :titulo, :descripcion, :multimedia, :detalles, :precio, :stock, :portada, :oferta, :precioOferta, :descuentoOferta, :finOferta,  :peso, :entrega)");

    $stmt->bindParam(':id_categoria', $datos['idCategoria'], PDO::PARAM_STR);
    $stmt->bindParam(':id_subcategoria', $datos['idSubCategoria'], PDO::PARAM_STR);
    $stmt->bindParam(':ruta', $datos['ruta'], PDO::PARAM_STR);
    $stmt->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);
    $stmt->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
    $stmt->bindParam(':multimedia', $datos['multimedia'], PDO::PARAM_STR);
    $stmt->bindParam(':detalles', $datos['detalles'], PDO::PARAM_STR);
    $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
    $stmt->bindParam(':stock', $datos['stock'], PDO::PARAM_STR);
    $stmt->bindParam(':portada', $datos['imgFotoPrincipal'], PDO::PARAM_STR);
    $stmt->bindParam(':oferta', $datos['oferta'], PDO::PARAM_STR);
    $stmt->bindParam(':precioOferta', $datos['precioOferta'], PDO::PARAM_STR);
    $stmt->bindParam(':descuentoOferta', $datos['descuentoOferta'], PDO::PARAM_STR);
    $stmt->bindParam(':finOferta', $datos['finOferta'], PDO::PARAM_STR);
    $stmt->bindParam(':peso', $datos['peso'], PDO::PARAM_STR);
    $stmt->bindParam(':entrega', $datos['entrega'], PDO::PARAM_STR);

    if ($stmt->execute()) { return 'ok'; }else{ return 'error'; }

    $stmt->close();
    $stmt = null;

  }

  /* -------------------------- End of CREAR PRODUCTO ------------------------- */

  /*=======================================
  =            EDITAR PRODUCTO            =
  =======================================*/

  static public function mdlEditarProducto($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, id_subcategoria = :id_subcategoria, ruta = :ruta, estado = :estado, titulo = :titulo, descripcion = :descripcion, multimedia = :multimedia, detalles = :detalles, precio = :precio, stock = :stock, portada = :portada, oferta = :oferta, precioOferta = :precioOferta, descuentoOferta = :descuentoOferta, finOferta = :finOferta, peso = :peso, entrega = :entrega WHERE id = :id");

    $stmt->bindParam(':id_categoria', $datos['idCategoria'], PDO::PARAM_STR);
    $stmt->bindParam(':id_subcategoria', $datos['idSubCategoria'], PDO::PARAM_STR);
    $stmt->bindParam(':ruta', $datos['ruta'], PDO::PARAM_STR);
    $stmt->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);
    $stmt->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
    $stmt->bindParam(':multimedia', $datos['multimedia'], PDO::PARAM_STR);
    $stmt->bindParam(':detalles', $datos['detalles'], PDO::PARAM_STR);
    $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
    $stmt->bindParam(':stock', $datos['stock'], PDO::PARAM_STR);
    $stmt->bindParam(':portada', $datos['imgFotoPrincipal'], PDO::PARAM_STR);
    $stmt->bindParam(':oferta', $datos['oferta'], PDO::PARAM_STR);
    $stmt->bindParam(':precioOferta', $datos['precioOferta'], PDO::PARAM_STR);
    $stmt->bindParam(':descuentoOferta', $datos['descuentoOferta'], PDO::PARAM_STR);
    $stmt->bindParam(':finOferta', $datos['finOferta'], PDO::PARAM_STR);
    $stmt->bindParam(':peso', $datos['peso'], PDO::PARAM_STR);
    $stmt->bindParam(':entrega', $datos['entrega'], PDO::PARAM_STR);
    $stmt -> bindParam(':id', $datos['id'], PDO::PARAM_INT);

    if ($stmt->execute()) { return 'ok'; } else { return 'error'; }

    $stmt->close();
    $stmt = null;

  }

  /*=====  End of EDITAR PRODUCTO  ======*/

  /*=========================================
  =            ELIMINAR PRODUCTO            =
  =========================================*/

  static public function mdlEliminarProducto($tabla, $datos) {
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    $stmt -> bindParam(':id', $datos, PDO::PARAM_INT);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;
  }

  /*=====  End of ELIMINAR PRODUCTO  ======*/

}