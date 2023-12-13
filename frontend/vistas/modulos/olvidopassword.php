<?php $contactenos = ControladorPlantilla::ctrMostrarContacto(); $correo = $contactenos['correo'];?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="header__logo">
      <a href="<?=$frontend?>"><img src="<?=$frontend?>vistas/img/logo.png" class="logo" alt=""></a>
    </div>

    <!-- Login Form -->
    <form method="post">
      <p>Ingresa tu correo electronico y te mandaremos una nueva contraseña, una vez dentro del sistema podras ingresar a tu perfil y cambiarla.</p>
      <input type="email" id="passEmail" class="fadeIn second" name="passEmail" placeholder="Correo Electronico" required>
      <br><br>
      <?php $password = new ControladorUsuario(); $password -> ctrOlvidoPassword($correo); ?>
      <input type="submit" class="fadeIn fourth" value="Recuperar Contraseña">
    </form>

  </div>
</div>