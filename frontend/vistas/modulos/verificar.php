<?php

$usuarioVerificado = false;
$item = "EmailEncriptado";
$valor =  $rutas[1];
$respuesta = ControladorUsuario::ctrMostrarUsuario($item, $valor);

if (is_array($respuesta) && $valor == $respuesta['emailEncriptado']) {
  $id = $respuesta["id"];
  $item2 = "verificacion";
  $valor2 = 0;
  $respuesta2 = ControladorUsuario::ctrActualizarUsuario($id, $item2, $valor2);

  if ($respuesta2 == "ok") {
    $usuarioVerificado = true;
  }
}

?>

<div class="container">
  <div class="row">
    <div class="col-12 text-center verificar">
      <?php if ($usuarioVerificado): ?>
        <br>
        <h3>¡Gracias!</h3>
        <h2><small>Hemos verificado su correo electrónico, ya puede ingresar al sistema</small></h2>
        <br><br>
        <a href="<?=$frontend?>login"><button class="btn btn-lg btn-danger">INGRESAR</button></a>
      <?php else: ?>
        <br>
        <h3>¡Error!</h3>
        <h2><small>No se ha podido verificar el correo electrónico,  vuelva a registrarse</small></h2>
        <br>
        <a href="<?=$frontend?>register"><button class="btn btn-lg btn-danger">REGISTRARSE</button></a>
      <?php endif ?>
    </div>
  </div>
</div>