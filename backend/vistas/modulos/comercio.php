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
          <h1>Gestor Comercio</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Comercio</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <section class="col-lg-6">
          <?php include_once 'comercio/logotipo.php'; ?>
          <?php include_once 'comercio/redes-solciales.php'; ?>
          <?php include_once 'comercio/footer.php'; ?>
        </section>

        <section class="col-lg-6">
          <?php include_once 'comercio/codigos.php'; ?>
          <?php include_once 'comercio/informacion.php'; ?>
        </section>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
<!-- /.content-wrapper -->