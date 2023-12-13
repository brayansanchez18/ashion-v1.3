<?php $item = $_SESSION['id']; $deseos = ControladorUsuario::ctrMostrarDeseos($item);?>

<section class="shop spad">
  <div class="container">
    <div class="row">

      <?php if (!$deseos): ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center error404">
          <h1><small>¡Oops!</small></h1>
          <h2>Aún no tiene productos en su lista de deseos</h2>
        </div>
      <?php else: ?>
        <?php foreach ($deseos as $key => $value1): ?>
          <?php
          $ordenar = "id";
          $valor = $value1["id_producto"];
          $item = "id";

          $productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);
          ?>
          <?php foreach ($productos as $key => $value2): ?>
            <div class="col-lg-3 col-md-6">
              <?php if ($value2['oferta'] != 0): ?>
                <div class="product__item sale">
              <?php else: ?>
                <div class="product__item">
              <?php endif ?>
                <div class="product__item__pic set-bg" data-setbg="<?=$backend.$value2['portada']?>">
                  <ul class="product__hover">
                    <li><a href="<?=$backend.$value2['portada']?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                    <li><a class="quitarDeseo" idDeseo="<?=$value1['id']?>"><span class="fa fa-times"></span></a></li>
                  </ul>
                  <?php if ($value2['oferta'] != 0): ?>
                    <div class="label sale">En Oferta</div>
                  <?php endif ?>

                  <?php if ($value2['stock'] == 0): ?>
                    <div class="label stockout stockblue">Sin Stock</div>
                  <?php endif ?>
                </div>

                <div class="product__item__text">
                  <h6><a href="<?=$frontend.$value2['ruta']?>"><?=$value2['titulo']?></a></h6>
                  <hr>
                  <?php if ($value2['precio'] == 0): ?>
                    <div class="product__price">GRATIS</div>
                  <?php else: ?>
                    <?php if ($value2['oferta'] != 0): ?>
                      <div class="product__price">$ <?=number_format($value2['precioOferta'],2)?> <?=$divisa?> <span>$ <?=number_format($value2['precio'],2)?></span></div>
                    <?php else: ?>
                      <div class="product__price">$ <?=number_format($value2['precio'],2)?> <?=$divisa?></div>
                    <?php endif ?>
                  <?php endif ?>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</section>