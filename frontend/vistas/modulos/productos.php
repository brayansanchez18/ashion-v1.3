<?php

$titulosModulos = array('ARTÍCULOS RECIENTES', 'LO MÁS VENDIDO', 'LO MÁS VISTO');
$rutaModulos = array('articulos-recientes','lo-mas-vendido','lo-mas-visto');

$base = 0;
$tope = 8;

if($titulosModulos[0] == 'ARTÍCULOS RECIENTES'){
  $ordenar = 'id';
  $item = 'estado';
  $valor = 1;
  $modo = 'DESC';
  $recientes = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);
}

if($titulosModulos[1] == 'LO MÁS VENDIDO') {
  $ordenar = 'ventas';
  $item = 'estado';
  $valor = 1;
  $modo = 'DESC';
  $ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);
}

if($titulosModulos[2] == 'LO MÁS VISTO') {
  $ordenar = 'vistas';
  $item = 'estado';
  $valor = 1;
  $modo = 'DESC';
  $vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);
}

$modulos = array($recientes, $ventas, $vistas);

?>

<?php for ($i=0; $i < count($titulosModulos); $i++): ?>
  <section class="product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="section-title">
            <h4><a href="<?=$frontend.$rutaModulos[$i]?>" class="linkdestacados"><?=$titulosModulos[$i]?></a></h4>
          </div>
        </div>
      </div>

      <?php if ($modulos[$i]): ?>
        <div class="row property__gallery">

          <?php foreach ($modulos[$i] as $key => $value): ?>
            <?php if ($value['estado'] != 0): ?>
              <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <?php if ($value['oferta'] != 0): ?>
                  <div class="product__item sale">
                <?php else: ?>
                  <div class="product__item">
                <?php endif ?>
                  <div class="product__item__pic set-bg" data-setbg="<?=$backend.$value['portada']?>">
                    <ul class="product__hover">
                      <li><a href="<?=$backend.$value['portada']?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                      <li><a><span class="icon_heart_alt deseos" idProducto="<?=$value['id']?>"></span></a></li>
                    </ul>
                    <?php if ($value['oferta'] != 0): ?>
                      <div class="label sale">En Oferta</div>
                    <?php endif ?>

                    <?php if ($value['stock'] == 0): ?>
                      <div class="label stockout stockblue">Sin Stock</div>
                    <?php endif ?>
                  </div>

                  <div class="product__item__text">
                    <h6><a href="<?=$frontend.$value['ruta']?>"><?=$value['titulo']?></a></h6>
                    <hr>
                    <?php if ($value['precio'] == 0): ?>
                      <div class="product__price">GRATIS</div>
                    <?php else: ?>
                      <?php if ($value['oferta'] != 0): ?>
                        <div class="product__price">$ <?=number_format($value['precioOferta'],2)?> <?=$divisa?> <span>$ <?=number_format($value['precio'])?></span></div>
                      <?php else: ?>
                        <div class="product__price">$ <?=number_format($value['precio'],2)?> <?=$divisa?></div>
                      <?php endif ?>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
      <?php else: ?>
        <div class="col-xs-12 error404 text-center"><h2>¡Oops! Aùn no hay productos en esta secciòn</h2></div>
      <?php endif ?>
    </div>
  </section>
<?php endfor ?>