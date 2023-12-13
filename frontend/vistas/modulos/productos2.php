<?php

$base = 0;
$tope = 12;

$ordenar = "id";
$item = 'estado';
$valor = 1;
$modo = 'DESC';
$productos_tienda = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

if (isset($rutas[1])) {

  if (isset($rutas[2])) {

    if ($rutas[2] == 'antiguos') {
      $modo = 'ASC';
      $_SESSION['ordenar'] = $modo;
    } else {
      $modo = 'DESC';
      $_SESSION['ordenar'] = $modo;
    }

  } else {

    if(isset($_SESSION['ordenar'])){
      $modo = $_SESSION['ordenar'];
    }else{
      $modo = 'DESC';
    }

  }

  $base = ($rutas[1] - 1) * 12;
  $tope = 12;
} else {
  $rutas[1] = 1;
  $base = 0;
  $tope = 12;
  $modo = 'DESC';
}

if ($rutas[0] == 'articulos-recientes') {
  $item2 = 'estado';
  $valor2 = 1;
  $ordenar = 'id';
} else if ($rutas[0] == 'lo-mas-vendido') {
  $item2 = 'estado';
  $valor2 = 1;
  $ordenar = 'ventas';
} else if ($rutas[0] == 'lo-mas-visto') {
  $item2 = 'estado';
  $valor2 = 1;
  $ordenar = 'vistas';
} else {
  $ordenar = 'id';
  $item1 = 'ruta';
  $valor1 = $rutas[0];
  $categoria = ControladorProductos::ctrMostrarCategorias($item1, $valor1);

  if (!$categoria) {
    $subCategoria = ControladorProductos::ctrMostrarSubCategorias($item1, $valor1);
    $item2 = 'id_subcategoria';
    $valor2 = $subCategoria[0]['id'];
  } else {
    $item2 = 'id_categoria';
    $valor2 = $categoria['id'];
  }

}

$productos = ControladorProductos::ctrMostrarProductos($ordenar, $item2, $valor2, $base, $tope, $modo);
$listaProductos = ControladorProductos::ctrListarProductos($ordenar, $item2, $valor2);

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb__links">
          <a href="<?=$frontend?>"><i class="fa fa-home"></i> INICIO</a>
          <?php if ($rutas[0] == 'articulos-recientes'): ?>
            <span>ARTICULOS RECIENTES</span>
          <?php elseif ($rutas[0] == 'lo-mas-vendido'): ?>
            <span>LO MÁS VENDIDO</span>
          <?php elseif ($rutas[0] == 'lo-mas-visto'): ?>
            <span>LO MÁS VISTO</span>
          <?php else: ?>
            <?php if (!$categoria): ?>
              <span class="text-uppercase"><?=$subCategoria[0]['subcategoria']?></span>
            <?php else: ?>
              <span class="text-uppercase"><?=$categoria['categoria']?></span>
            <?php endif ?>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<?php if (!$productos): ?>
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
                                <li><a href="<?=$frontend.$value['ruta']?>"><?=$value['subcategoria']?></a></li>
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

        <div class="col-xs-12 error404 text-center">
          <h1><small>¡Oops!</small></h1>
          <h2>Aùn no hay productos en esta secciòn</h2>
        </div>
    </div>
  </section>
<?php else: ?>
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
                                <li><a href="<?=$frontend.$value['ruta']?>"><?=$value['subcategoria']?></a></li>
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

            <?php foreach ($productos as $key => $value): ?>
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

            <!-- -------------------------------------------------------------------------- */
            /*                                  PAGINATION                                  */
            /* -------------------------------------------------------------------------- -->

            <div class="col-lg-12 text-center">
              <div class="pagination__option">
                <?php if (count($listaProductos) != 0): ?>
                  <?php $pagProductos = ceil(count($listaProductos)/12); ?>
                  <?php if ($pagProductos > 4): ?>
                    <?php if($rutas[1] == 1): ?>
                      <?php for ($i = 1; $i <= 4; $i ++): ?>
                        <a href="<?=$frontend.$rutas[0]?>/<?=$i?>"><?=$i?></a>
                      <?php endfor ?>
                      <a>...</a>
                      <a href="<?=$frontend.$rutas[0]?>/<?=$pagProductos?>"><?=$pagProductos?></a>
                      <a href="<?=$frontend.$rutas[0]?>/2"><i class="fa fa fa-angle-right"></i></a>
                    <?php elseif($rutas[1] != $pagProductos && $rutas[1] != 1 && $rutas[1] <  ($pagProductos/2) && $rutas[1] < ($pagProductos-3)): ?>
                      <?php $numPagActual = $rutas[1]; ?>
                      <a href="<?=$frontend.$rutas[0]?>/<?=($numPagActual-1)?>"><i class="fa fa-angle-left"></i></a>

                      <?php for ($i = $numPagActual; $i <= ($numPagActual+3); $i ++): ?>
                        <a href="<?=$frontend.$rutas[0]?>/<?=$i?>"><?=$i?></a>
                      <?php endfor ?>
                      <a>...</a>
                      <a href="<?=$frontend.$rutas[0]?>/<?=$pagProductos?>"><?=$pagProductos?></a>
                      <a href="<?=$frontend.$rutas[0]?>/<?=($numPagActual+1)?>"><i class="fa fa-angle-right"></i></a>
                    <?php elseif($rutas[1] != $pagProductos && $rutas[1] != 1 && $rutas[1] >=  ($pagProductos/2) && $rutas[1] < ($pagProductos-3)): ?>
                      <?php $numPagActual = $rutas[1]; ?>
                      <a href="<?=$frontend.$rutas[0]?>/<?=($numPagActual-1)?>"><i class="fa fa-angle-left"></i></a>
                      <a href="<?=$frontend.$rutas[0]?>/1">1</a>
                      <a>...</a>

                      <?php for($i = $numPagActual; $i <= ($numPagActual+3); $i ++): ?>
                        <a href="<?=$frontend.$rutas[0]?>/'<?=$i?>"><?=$i?></a>
                      <?php endfor ?>
                      <a href="<?=$frontend.$rutas[0]?>/<?=($numPagActual+1)?>"><i class="fa fa-angle-right"></i></a>
                    <?php else: ?>
                      <?php $numPagActual = $rutas[1]; ?>
                      <a href="<?=$frontend.$rutas[0]?>/<?=($numPagActual-1)?>"><i class="fa fa-angle-left"></i></a>
                      <a href="<?=$frontend.$rutas[0]?>/1">1</a>
                      <a>...</a>

                      <?php for($i = ($pagProductos-3); $i <= $pagProductos; $i ++): ?>
                        <a href="<?=$frontend.$rutas[0]?>/<?=$i?>"><?=$i?></a>
                      <?php endfor ?>
                    <?php endif ?>
                  <?php else: ?>
                    <?php for($i = 1; $i <= $pagProductos; $i ++): ?>
                      <a href="<?=$frontend.$rutas[0]?>/<?=$i?>"><?=$i?></a>
                    <?php endfor ?>
                  <?php endif ?>
                <?php endif ?>
              </div>
            </div>

            <!-- ---------------------------- End of PAGINATION --------------------------- -->

          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif ?>