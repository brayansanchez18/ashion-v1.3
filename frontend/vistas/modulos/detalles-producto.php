<?php

$item = 'ruta';
$valor = $rutas[0];
$infoproducto = ControladorProductos::ctrMostrarInfoproducto($item, $valor);
$multimedia = json_decode($infoproducto['multimedia'], true);

$item = 'id';
$valor = $infoproducto['id_subcategoria'];
$rutaDestacados = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb__links">
          <a href="<?=$frontend?>"><i class="fa fa-home"></i> Inicio</a>
          <span><?=$infoproducto['titulo']?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="product__details__pic">
          <div class="product__details__pic__left product__thumb nice-scroll" style="height:100%;">
            <?php if ($multimedia != null): ?>
              <?php for ($i=0; $i < count($multimedia); $i++): ?>
                <a class="pt" href="#product-<?=($i+1)?>">
                  <img src="<?=$backend.$multimedia[$i]['foto']?>" alt="<?=$infoproducto['titulo']?>">
                </a>
              <?php endfor ?>
            <?php endif ?>
          </div>

          <div class="product__details__slider__content">
            <div class="product__details__pic__slider owl-carousel" style="width: 100%; height:100%;">
              <?php if ($multimedia != null): ?>
                <?php for ($i=0; $i < count($multimedia); $i++): ?>
                  <img data-hash="product-<?=($i+1)?>" class="product__big__img" src="<?=$backend.$multimedia[$i]['foto']?>" alt="<?=$infoproducto['titulo']?>">
                <?php endfor ?>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="product__details__text">
          <h3><?=$infoproducto['titulo']?></h3>
          <?php if($infoproducto['precio'] == 0): ?>
            <div class="product__details__price">GRATIS</div>
          <?php else: ?>
            <?php if ($infoproducto['oferta'] == 0): ?>
              <div class="product__details__price">$ <?=number_format($infoproducto['precio'],2)?> <?=$divisa?></div>
            <?php else: ?>
              <div class="product__details__price">$ <?=number_format($infoproducto['precioOferta'],2)?> <span> $ <?=number_format($infoproducto['precio'],2)?> <?=$divisa?></span></div>
            <?php endif ?>
          <?php endif ?>

          <div class="product__details__widget">
            <ul>
              <li style="margin-top:-20px;">
                <?php if ($infoproducto['stock'] != 0): ?>
                  <span>Unidades:</span> <?=$infoproducto['stock']?>
                <?php else: ?>
                  <span>Unidades:</span> SIN STOCK
                <?php endif ?>
              </li>
              <hr>
              <br>
              <?php if ($infoproducto['stock'] != 0): ?>
                <?php if ($infoproducto['detalles'] != null): ?>
                  <?php $detalles = json_decode($infoproducto['detalles'], true); ?>
                  <li class="d-flex">
                  <?php if ($detalles['Talla'] != null): ?>
                    <div class="form-group ">
                      <div class="col-12">
                        <select class="form-control seleccionarDetalle" id="seleccionarTalla">
                        <option value="">Talla</option>
                        <?php for ($i = 0; $i < count($detalles['Talla']); $i++): ?>
                          <option value="<?=$detalles['Talla'][$i]?>"><?=$detalles['Talla'][$i]?></option>
                        <?php endfor ?>
                        </select>
                      </div>
                    </div>
                  <?php endif ?>

                  <?php if ($detalles['Color'] != null): ?>
                    <div class="form-group ">
                      <div class="col-12">
                        <select class="form-control seleccionarDetalle" id="seleccionarColor">
                          <option value="">Color</option>
                          <?php for ($i = 0; $i < count($detalles["Color"]); $i++): ?>
                            <option value="<?=$detalles['Color'][$i]?>"><?=$detalles['Color'][$i]?></option>
                          <?php endfor ?>
                        </select>
                      </div>
                    </div>
                  <?php endif ?>
                  </li>
                <?php endif ?>
              <?php endif ?>
            </ul>
          </div>

          <!-- -------------------------------------------------------------------------- */
          /*                                   ENTREGA                                  */
          /* -------------------------------------------------------------------------- -->

          <?php if ($infoproducto['stock'] != 0): ?>
            <?php if ($infoproducto["precio"] == 0): ?>
              <h4 class="col-lg-0 col-md-0 col-xs-12">
                <small>
                  <i class="fa fa-clock-o" style="margin-right:5px;margin-left:2px;"></i>
                  <?=$infoproducto["entrega"]?> días hábiles para la entrega  <br>

                  <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                  <?=$infoproducto["ventas"]?> solicitudes  <br>

                  <i class="fa fa-eye" style="margin:0px 5px"></i>
                  Visto por <span class="vistas" tipo="<?=$infoproducto["precio"]?>"><?=$infoproducto["vistasGratis"]?> </span> personas
                </small>
              </h4>
            <?php else: ?>
              <hr>
                <h4 class="col-lg-0 col-md-0 col-xs-12" style="font-size:20px;">
                  <small>
                    <i class="fa fa-clock-o" style="margin-right:5px;margin-left:4px;"></i>
                    <?=$infoproducto['entrega']?> días hábiles para la entrega <br>

                    <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                    <?=$infoproducto['ventas']?> ventas <br>

                    <i class="fa fa-eye" style="margin:0px 5px"></i>
                    Visto por <span class="vistas" tipo="<?=$infoproducto['precio']?>"><?=$infoproducto['vistas']?></span> personas
                  </small>
                </h4>
              <hr>
            <?php endif ?>
          <?php endif ?>

          <!-- ----------------------------- End of ENTREGA ----------------------------- -->

          <?php if ($infoproducto["precio"]==0): ?>
            <?php if (isset($_SESSION['validarSesion']) && $_SESSION['validarSesion'] == 'ok'): ?>
              <?php if ($infoproducto['stock'] != 0): ?>
                <div class="product__details__button mb-4">
                  <a style="color:#fff;cursor:pointer;" class="cart-btn agregarCarrito agregarFisicosGratis" idProducto="<?=$infoproducto['id']?>" imagen="<?=$backend.$infoproducto['portada']?>" titulo="<?=$infoproducto['titulo']?>" precio="<?=$infoproducto['precioOferta']?>" peso="<?=$infoproducto['peso']?>" idUsuario="<?=$_SESSION['id']?>"><span class="icon_bag_alt"></span> SOLICITAR PRODUCTO</a>

                  <ul>
                    <li class="deseos" style="cursor:pointer;"><a><span class="icon_heart_alt" idProducto="<?=$infoproducto['id']?>"></span></a></li>
                  </ul>
                </div>

                <div class="card border-dark mb-3" style="">
                  <div class="card-body text-dark">
                    <h5 class="card-title">¡Atención!</h5>
                    <p class="card-text">El producto a solicitar es totalmente gratuito y se enviará a la dirección solicitada, sólo se cobrará los cargos de envío. Solo es permitido y sera enviado un producto por cliente</p>
                  </div>
                </div>
              <?php endif ?>
            <?php else: ?>
              <div class="product__details__button mb-4">
                <a href="<?=$frontend?>login" style="color:#fff;" class="cart-btn"><span class="icon_bag_alt"></span> SOLICITAR PRODUCTO</a>

                <ul>
                  <li><a><span class="icon_heart_alt deseos" idProducto="<?=$infoproducto['id']?>"></span></a></li>
                </ul>
              </div>

              <div class="card border-dark mb-3" style="">
                <div class="card-body text-dark">
                  <h5 class="card-title">¡Atención!</h5>
                  <p class="card-text">El producto a solicitar es totalmente gratuito y se enviará a la dirección solicitada, sólo se cobrará los cargos de envío. Solo es permitido y sera enviado un producto por cliente</p>
                </div>
              </div>
            <?php endif ?>
          <?php else: ?>
            <?php if ($infoproducto['stock'] != 0): ?>
              <?php if ($infoproducto['oferta'] != 0): ?>
                <div class="product__details__button mb-4">
                  <a style="color:#fff;cursor:pointer;" class="cart-btn agregarCarrito" idProducto="<?=$infoproducto['id']?>" imagen="<?=$backend.$infoproducto['portada']?>" titulo="<?=$infoproducto['titulo']?>" precio="<?=$infoproducto['precioOferta']?>" peso="<?=$infoproducto['peso']?>"><span class="icon_bag_alt"></span> Añadir al carrito</a>

                  <ul>
                    <li class="deseos" style="cursor:pointer;"><a><span class="icon_heart_alt" idProducto="<?=$infoproducto['id']?>"></span></a></li>
                  </ul>
                </div>
              <?php else: ?>
                <div class="product__details__button mb-4">
                  <a style="color:#fff;cursor:pointer;" class="cart-btn agregarCarrito" idProducto="<?=$infoproducto['id']?>" imagen="<?=$backend.$infoproducto['portada']?>" titulo="<?=$infoproducto['titulo']?>" precio="<?=$infoproducto['precio']?>" peso="<?=$infoproducto['peso']?>"><span class="icon_bag_alt"></span> Añadir al carrito</a>

                  <ul>
                    <li class="deseos" style="cursor:pointer;"><a><span class="icon_heart_alt" idProducto="<?=$infoproducto['id']?>"></span></a></li>
                  </ul>
                </div>
              <?php endif ?>
            <?php else: ?>
              <div class="product__details__button mb-4">
                <a style="color:#fff;cursor:pointer;" class="cart-btn deseos" idProducto="<?=$infoproducto['id']?>"><span class="icon_heart_alt"></span> Añadir a lista de deseos</a>
              </div>
            <?php endif ?>
          <?php endif ?>
        </div>
      </div>

      <div class="col-lg-12 text-center">
        <h4 style="color: #a91b08;">Descripcion del Producto</h2>
        <hr>
        <p><?=$infoproducto['descripcion']?></p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="related__title">
          <hr>
          <h5><a href="<?=$frontend.$rutaDestacados[0]['ruta']?>" style="color: #a91b08;">PRODUCTOS RELACIONADOS</a></h5>
        </div>
      </div>

      <?php
        $ordenar = '';
        $item = 'id_subcategoria';
        $valor = $infoproducto['id_subcategoria'];
        $base = 0;
        $tope = 4;
        $modo = 'Rand()';

        $relacionados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);
      ?>

      <?php if (!$relacionados): ?>
        <div class="col-12 text-center">
          <h1><small>¡Oops!</small></h1>
          <h2>No hay productos relacionados</h2>
        </div>
      <?php else: ?>
        <?php foreach ($relacionados as $key => $value): ?>
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
                    <li class="deseos" style="cursor:pointer;"><a><span class="icon_heart_alt" idProducto="<?=$value['id']?>"></span></a></li>
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
                      <div class="product__price">$ <?=number_format($value['precioOferta'],2)?> <?=$divisa?> <span>$ <?=number_format($value['precio'],2)?></span></div>
                    <?php else: ?>
                      <div class="product__price">$ <?=number_format($value['precio'],2)?> <?=$divisa?></div>
                    <?php endif ?>
                  <?php endif ?>
                </div>
              </div>
            </div>
          <?php endif ?>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</section>
<!-- Product Details Section End -->