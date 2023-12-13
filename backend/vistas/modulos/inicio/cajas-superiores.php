<?php
$ventas = ControladorVentas::ctrMostrarTotalVentas();
$usuarios = ControladorUsuarios::ctrMostrarTotalUsuarios('id');
$totalUsuarios = count($usuarios);
$productos = ControladorProductos::ctrMostrarTotalProductos('id');
$totalProductos = count($productos);
?>

<div class="col-lg-4 col-12">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3>$<?=Number_format($ventas['total'], 2)?></h3>
      <p>Ventas</p>
    </div>
    <div class="icon">
      <i class="fas fa-dollar-sign"></i>
    </div>
    <a href="<?=$backend?>ventas" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <h3><?=number_format($totalUsuarios)?></h3>
      <p>Usuarios Registrados</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
    <a href="<?=$backend?>usuarios" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3><?=number_format($totalProductos)?></h3>
      <p>Productos</p>
    </div>
    <div class="icon">
      <i class="fas fa-boxes"></i>
    </div>
    <a href="<?=$backend?>productos" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->