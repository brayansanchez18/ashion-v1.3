<?php $productos = ControladorProductos::ctrMostrarTotalProductos('fecha'); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Productos agregados recientemente</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <ul class="products-list product-list-in-card pl-2 pr-2">
      <?php for ($i = 0; $i < 5; $i++): ?>
        <li class="item">
          <div class="product-img">
            <img src="<?=$productos[$i]['portada']?>" alt="<?=$productos[$i]['titulo']?>" class="img-size-50">
          </div>
          <div class="product-info">
            <a class="product-title"><?=$productos[$i]['titulo']?>
            <?php if ($productos[$i]['precio'] == 0): ?>
              <span class="badge badge-warning float-right">GRATIS</span>
            <?php else: ?>
              <?php if ($productos[$i]['oferta'] == 0): ?>
                <span class="badge badge-warning float-right">$<?=$productos[$i]['precio']?></span>
              <?php else: ?>
                <span class="badge badge-warning float-right">$<?=$productos[$i]['precioOferta']?></span>
              <?php endif ?>
            <?php endif ?>
            </a>
          </div>
        </li>
      <?php endfor ?>
      <!-- /.item -->
      <!-- <li class="item">
        <div class="product-img">
          <img src="vistas/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
        </div>
        <div class="product-info">
          <a style="cursor:pointer;" class="product-title">Bicycle
            <span class="badge badge-info float-right">$700</span></a>
        </div>
      </li> -->
      <!-- /.item -->
      <!-- <li class="item">
        <div class="product-img">
          <img src="vistas/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
        </div>
        <div class="product-info">
          <a style="cursor:pointer;" class="product-title">
            Xbox One <span class="badge badge-danger float-right">
            $350
          </span>
          </a>
        </div>
      </li> -->
      <!-- /.item -->
      <!-- <li class="item">
        <div class="product-img">
          <img src="vistas/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
        </div>
        <div class="product-info">
          <a style="cursor:pointer;" class="product-title">PlayStation 4
            <span class="badge badge-success float-right">$399</span></a>
        </div>
      </li> -->
      <!-- /.item -->
    </ul>
  </div>
  <!-- /.card-body -->
  <div class="card-footer text-center">
    <a href="<?=$backend?>productos" class="uppercase">Ver Productos</a>
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->