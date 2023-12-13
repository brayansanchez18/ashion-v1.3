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
          <h1>Gestor Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Usuarios</li>
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
        <a href="vistas/modulos/reportes.php?reporte=usuarios">
          <button class="btn btn-success">Descargar reporte de Excel</button>
        </a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaUsuarios" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Foto</th>
              <th>Estado</th>
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