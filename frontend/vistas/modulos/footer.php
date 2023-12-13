<?php $social = ControladorPlantilla::ctrEstiloPlantilla(); $jsonRedesSociales = json_decode($social['redesSociales'], true); ?>
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="footer__about">
          <div class="footer__payment">
            <a class="cursor-pointer"><img src="<?=$frontend?>vistas/img/payment/payment-4.png" alt="PayPal"></a>
            <a class="cursor-pointer"><img src="<?=$frontend?>vistas/img/payment/payment-1.png" alt="Master Card"></a>
            <a class="cursor-pointer"><img src="<?=$frontend?>vistas/img/payment/payment-2.png" alt="Visa"></a>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="footer__newslatter">
          <h6>SIGUENOS EN NUESTRAS REDES SOCIALES</h6>
          <div class="footer__social">

            <?php foreach ($jsonRedesSociales as $key => $value): ?>
              <?php if ($value['activo'] != 0): ?>
                <a href="<?=$value['url']?>" target="_blank"><i class="fa <?=$value['red']?>"></i></a>
              <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3. -->
        <div class="footer__copyright__text">
          <a>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> and developed by <a href="https://colorlib.com" target="_blank">Brayan Sánchez</a></p>
        </div>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3. -->
      </div>
    </div>
  </div>
</footer>