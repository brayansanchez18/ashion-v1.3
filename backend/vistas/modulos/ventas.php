<?php
if ($_SESSION['perfil'] != 'administrador') {
echo '<script>
  window.location = "inicio";
</script>';
return;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestor Ventas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Ventas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <?php include_once 'inicio/grafico-ventas.php'; ?>
      </div>
      <div class="card-body">
        <div class="card-tools">
          <a href="vistas/modulos/reportes.php?reporte=compras">
            <button class="btn btn-success">Descargar reporte de Excel</button>
          </a>
        </div>
        <br>

        <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Producto</th>
              <th>Imagen Producto</th>
              <th>Detalles</th>
              <th>Cantidad</th>
              <th>Cliente</th>
              <th>Foto Cliente</th>
              <th>Venta</th>
              <th>Proceso de envío</th>
              <th>Correo Electronico</th>
              <th>Dirección de envio</th>
              <th>País</th>
              <th>Fecha</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->