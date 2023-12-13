<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="header__logo">
      <a href="<?=$frontend?>"><img src="<?=$frontend?>vistas/img/logo.png" class="logo" alt=""></a>
    </div>

    <!-- Login Form -->
    <form method="post">
      <input type="email" id="ingEmail" class="fadeIn second" name="ingEmail" placeholder="Correo Electronico" required>
      <input type="password" id="ingPassword" class="fadeIn third" name="ingPassword" placeholder="Contraseña" required>
      <?php $ingreso = new ControladorUsuario(); $ingreso -> ctrIngresoUsuario(); ?>
      <input type="submit" class="fadeIn fourth" value="Ingresar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter" style="color:b00b0b;">
      <a class="underlineHover" href="<?=$frontend?>olvidopassword" style="color:b00b0b;">Olvidaste tu contraseña?</a><br>
      <a class="underlineHover" href="<?=$frontend?>register" style="color:b00b0b;">No tienes una cuenta? Registrate aqui</a>
    </div>

  </div>
</div>