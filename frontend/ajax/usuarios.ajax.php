<?php

require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';

class AjaxUsuarios {

  /* -------------------------------------------------------------------------- */
  /*                           VALIDAR EMAIL EXISTENTE                          */
  /* -------------------------------------------------------------------------- */

  public $validarEmail;

  public function ajaxValidarEmail() {

    $datos = $this->validarEmail;
    $respuesta = ControladorUsuario::ctrMostrarUsuario('email', $datos);
    echo json_encode($respuesta);

  }

  /* --------------------- End of VALIDAR EMAIL EXISTENTE --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                          AGREGAR A LISTA DE DESEOS                         */
  /* -------------------------------------------------------------------------- */

  public $idUsuario;
  public $idProducto;

  public function ajaxAgregarDeseo() {

    $datos = array("idUsuario"=>$this->idUsuario,
              "idProducto"=>$this->idProducto);

    $respuesta = ControladorUsuario::ctrAgregarDeseo($datos);

    echo $respuesta;

  }

  /* -------------------- End of AGREGAR A LISTA DE DESEOS -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                     QUITAR PRODUCTO DE LISTA DE DESEOS                     */
  /* -------------------------------------------------------------------------- */

  public $idDeseo;

  public function ajaxQuitarDeseo() {

    $datos = $this->idDeseo;
    $respuesta = ControladorUsuario::ctrQuitarDeseo($datos);
    echo $respuesta;

  }

  /* ---------------- End of QUITAR PRODUCTO DE LISTA DE DESEOS --------------- */

}

/* -------------------------------------------------------------------------- */
/*                           VALIDAR EMAIL EXISTENTE                          */
/* -------------------------------------------------------------------------- */

if (isset($_POST['validarEmail'])) {
  $valEmail = new AjaxUsuarios();
  $valEmail -> validarEmail = $_POST['validarEmail'];
  $valEmail -> ajaxValidarEmail();
}

/* --------------------- End of VALIDAR EMAIL EXISTENTE --------------------- */

/* -------------------------------------------------------------------------- */
/*                          AGREGAR A LISTA DE DESEOS                         */
/* -------------------------------------------------------------------------- */

if (isset($_POST["idUsuario"])) {
  $deseo = new AjaxUsuarios();
  $deseo -> idUsuario = $_POST["idUsuario"];
  $deseo -> idProducto = $_POST["idProducto"];
  $deseo ->ajaxAgregarDeseo();
}

/* -------------------- End of AGREGAR A LISTA DE DESEOS -------------------- */

/* -------------------------------------------------------------------------- */
/*                     QUITAR PRODUCTO DE LISTA DE DESEOS                     */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idDeseo'])) {
  $quitarDeseo = new AjaxUsuarios();
  $quitarDeseo -> idDeseo = $_POST['idDeseo'];
  $quitarDeseo ->ajaxQuitarDeseo();
}

/* ---------------- End of QUITAR PRODUCTO DE LISTA DE DESEOS --------------- */