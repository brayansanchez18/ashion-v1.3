<?php

$base = 0;
$tope = 12;

$ordenar = "id";
$item = 'estado';
$valor = 1;
$modo = 'DESC';
$productos_tienda = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb__links">
          <a href="<?=$frontend?>"><i class="fa fa-home"></i> INICIO</a>
          <span>TIENDA</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3">
        <div class="shop__sidebar">
          <div class="sidebar__categories">
            <div class="section-title">
              <h4>CATEGORIAS</h4>
            </div>

            <?php
            $item = null;
            $valor = null;
            $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);
            ?>

            <div class="categories__accordion">
              <div class="accordion" id="accordionExample">

                <?php foreach ($categorias as $key => $value): ?>
                  <?php if($value['estado'] != 0): ?>
                    <div class="card">
                      <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapse<?=$key?>"><?=$value['categoria']?></a>
                      </div>

                      <?php
                      $item = "id_categoria";
                      $valor = $value['id'];
                      $subCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
                      ?>

                      <div id="collapse<?=$key?>" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">
                          <ul>
                            <?php foreach ($subCategorias as $key => $value): ?>
                              <?php if($value['estado'] != 0): ?>
                                <li><a href="<?=$frontend.$value['ruta']?>"><?=$value['subcategoria']?></a></li>
                              <?php endif ?>
                            <?php endforeach ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  <?php endif ?>
                <?php endforeach ?>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-9 col-md-9">
        <div class="row">

          <?php foreach ($productos_tienda as $key => $value): ?>
            <?php if ($value['estado'] != 0): ?>
              <div class="col-lg-4 col-md-6">
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
                        <div class="product__price">$ <?=number_format($value['precioOferta'],2)?> <?=$divisa?> <span>$ <?=$value['precio']?></span></div>
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
      </div>
    </div>
  </div>
</section>
<!-- Shop Section End -->