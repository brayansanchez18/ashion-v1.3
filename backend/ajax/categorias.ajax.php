<?php

require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';
require_once '../controladores/subcategorias.controlador.php';
require_once '../modelos/subcategorias.modelo.php';
require_once '../controladores/productos.controlador.php';
require_once '../modelos/productos.modelo.php';

class AjaxCategorias {

  /* -------------------------------------------------------------------------- */
  /*                              ACTIVAR CATEGORIA                             */
  /* -------------------------------------------------------------------------- */

  public $activarCategoria;
  public $activarId;

  public function ajaxActivarCategoria() {
    ModeloSubCategorias::mdlActualizarSubCategorias('subcategorias', 'estado', $this->activarCategoria, 'id_categoria', $this->activarId);
    ModeloProductos::mdlActualizarProductos('productos', 'estado', $this->activarCategoria, 'id_categoria', $this->activarId);
    $respuesta = ModeloCategorias::mdlActualizarCategoria('categorias', 'estado', $this->activarCategoria, 'id', $this->activarId);
    echo $respuesta;
  }

  /* ------------------------ ENd of ACTIVAR CATEGORIA ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                        VALIDAR NO REPETIR CATEGORÍA                        */
  /* -------------------------------------------------------------------------- */

  public $validarCategoria;

  public function ajaxValidarCategoria() {
    $item = 'categoria';
    $valor = $this->validarCategoria;
    $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
    echo json_encode($respuesta);
  }

  /* ------------------- End of VALIDAR NO REPETIR CATEGORÍA ------------------ */

  /* -------------------------------------------------------------------------- */
  /*                              EDITAR CATEGORIA                              */
  /* -------------------------------------------------------------------------- */

  public $idCategoria;

  public function ajaxEditarCategoria() {
    $item = 'id';
    $valor = $this->idCategoria;
    $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
    echo json_encode($respuesta);
  }

  /* ------------------------- End of EDITAR CATEGORIA ------------------------ */

}

/* -------------------------------------------------------------------------- */
/*                              ACTIVAR CATEGORIA                             */
/* -------------------------------------------------------------------------- */

if (isset($_POST['activarCategoria'])) {
  $activarCategoria = new AjaxCategorias();
  $activarCategoria -> activarCategoria = $_POST['activarCategoria'];
  $activarCategoria -> activarId = $_POST['activarId'];
  $activarCategoria -> ajaxActivarCategoria();
}

/* ------------------------ End of ACTIVAR CATEGORIA ------------------------ */

/* -------------------------------------------------------------------------- */
/*                        VALIDAR NO REPETIR CATEGORÍA                        */
/* -------------------------------------------------------------------------- */

if (isset( $_POST['validarCategoria'])) {
  $valCategoria = new AjaxCategorias();
  $valCategoria -> validarCategoria = $_POST['validarCategoria'];
  $valCategoria -> ajaxValidarCategoria();
}

/* ------------------- End of VALIDAR NO REPETIR CATEGORÍA ------------------ */

/* -------------------------------------------------------------------------- */
/*                              EDITAR CATEGORIA                              */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idCategoria'])) {
  $editar = new AjaxCategorias();
  $editar -> idCategoria = $_POST['idCategoria'];
  $editar -> ajaxEditarCategoria();
}

/* ------------------------- End of EDITAR CATEGORIA ------------------------ */