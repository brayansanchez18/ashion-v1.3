<?php $contactenos = ControladorPlantilla::ctrMostrarContacto(); $correo = $contactenos['correo'] ?>
<?php $plantilla = ControladorPlantilla::ctrEstiloPlantilla();?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb__links">
          <a href="<?=$frontend?>"><i class="fa fa-home"></i> Inicio</a>
          <span>Contacto</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<!-- Contact Section Begin -->
<section class="contact spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="contact__content">
          <div class="contact__address">
            <h5>Contactanos</h5>
            <ul>
              <li>
                <h6><i class="fa fa-map-marker"></i> Direccion</h6>
                <p><?=$contactenos['direccion']?></p>
              </li>

              <li>
                <h6><i class="fa fa-whatsapp"></i> WhatsApp</h6>
                <p><span><?=$contactenos['numeroWhatsapp']?></span></p>
              </li>

              <li>
                <h6><i class="fa fa-headphones"></i> Soporte</h6>
                <p><?=$contactenos['correo']?></p>
              </li>
            </ul>
          </div>

          <?php if (isset($_SESSION['validarSesion'])): ?>
            <?php if ($_SESSION['validarSesion'] == 'ok'): ?>
              <div class="contact__form">
                <h5>Deja un mensaje</h5>
                <form role="form" method="post" onsubmit="return validarContactenos()">
                  <input type="text" id="nombreContactenos" name="nombreContactenos" placeholder="Nombre Completo" value="<?=$_SESSION['nombre']?>" required>
                  <input type="email" id="emailContactenos" name="emailContactenos" placeholder="Correo Electronico" value="<?=$_SESSION['email']?>" required>
                  <textarea id="mensajeContactenos" name="mensajeContactenos" placeholder="Mensaje" required></textarea>
                  <button type="submit" class="site-btn">Enviar</button>
                </form>
              </div>
            <?php endif ?>
          <?php else: ?>
            <div class="contact__form">
              <h5>Deja un mensaje</h5>
              <form role="form" method="post" onsubmit="return validarContactenos()">
                <input type="text" id="nombreContactenos" name="nombreContactenos" placeholder="Nombre Completo" required>
                <input type="email" id="emailContactenos" name="emailContactenos" placeholder="Correo Electronico" required>
                <textarea id="mensajeContactenos" name="mensajeContactenos" placeholder="Mensaje" required></textarea>
                <button type="submit" class="site-btn">Enviar</button>
              </form>
            </div>
          <?php endif ?>
        </div>
      </div>

      <?php $contactenos = new ControladorUsuario(); $contactenos -> ctrFormularioContactenos($correo); ?>

      <div class="col-lg-6 col-md-6">
        <div class="contact__map">
          <?=$plantilla['frameGoogleMaps']?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Contact Section End -->