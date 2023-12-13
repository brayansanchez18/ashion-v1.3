<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Panel de Control</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Panel de Control</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php include_once 'inicio/cajas-superiores.php' ?>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <!-- <section class="col-lg-6"> -->
        <section class="col-12">
          <?php include_once 'inicio/grafico-ventas.php'; ?>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
      <div class="row">
        <section class="col-lg-6">
          <?php include_once 'inicio/ultimos-usuarios.php'; ?>
        </section>

        <section class="col-lg-6">
          <?php include_once 'inicio/mas-vendidos.php'; ?>
          <?php include_once 'inicio/productos-recientes.php'; ?>
        </section>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>