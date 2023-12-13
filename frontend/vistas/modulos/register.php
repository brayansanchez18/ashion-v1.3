<?php $contactenos = ControladorPlantilla::ctrMostrarContacto(); $correo = $contactenos['correo'];?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="header__logo">
      <a href="<?=$frontend?>"><img src="<?=$frontend?>vistas/img/logo.png" class="logo" alt=""></a>
    </div>

    <!-- Login Form -->
    <form method="post" onsubmit="return registroUsuario()">
      <input type="text" id="regUsuario" class="fadeIn second" name="regUsuario" placeholder="Nombre Completo" required>
      <input type="email" id="regEmail" class="fadeIn second" name="regEmail" placeholder="Correo Electronico" required>
      <input type="password" id="regPassword" class="fadeIn third" name="regPassword" placeholder="Contraseña" required>
      <br>

      <div class="checkBox">
        <label>
          <input id="regPoliticas" type="checkbox">
          <small>
            Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad
            <br>
            <a href="https://www.iubenda.com/privacy-policy/70339171" class="iubenda-white iubenda-embed" title="condiciones de uso y políticas de privacidad ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
          </small>
        </label>
      </div>

      <?php
      $registro = new ControladorUsuario();
      $registro -> ctrRegistroUsuario($correo);
      ?>

      <input type="submit" class="fadeIn fourth" value="Registrarse">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter" style="color:b00b0b;">
      <a class="underlineHover" href="<?=$frontend?>login" style="color:b00b0b;">Ya tienes una cuenta? Ingresa aqui</a>
    </div>

  </div>
</div>