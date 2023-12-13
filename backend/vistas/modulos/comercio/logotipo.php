
<?php $plantilla = ControladorComercio::ctrSeleccionarPlantilla(); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">LOGOTIPO</h3>
  </div>
  <!-- /.card-header -->
  <div class="box-body p-4">
    <div class="form-group">
      <label>Cambiar logotipo</label>
      <p class="float-right">
        <img src="<?=$plantilla['logo']?>" class="img-thumbnail previsualizarLogo" width="200px">
      </p>

      <input type="file" id="subirLogo">
      <p class="help-block">Tamaño recomendado 500px * 100px</p>
    </div>
	</div>
  <!-- /.card-body -->

  <div class="box-footer p-4">
		<button type="button" id="guardarLogo" class="btn btn-primary float-right">Guardar Logotipo</button>
	</div>

  <div class="card-header">
    <h3 class="card-title">ICONO</h3>
  </div>

  <div class="box-body p-4">
    <div class="form-group">
      <label>Cambiar icono</label>
      <br>
      <p class="float-right">
        <img src="<?=$plantilla['icono']?>" class="img-thumbnail previsualizarIcono" width="100px">
      </p>

      <input type="file" id="subirIcono">
      <p class="help-block">Tamaño recomendado 100px * 100px</p>
    </div>
  </div>

  <div class="box-footer p-4">
    <button type="button" id="guardarIcono" class="btn btn-primary float-right">Guardar Icono</button>
  </div>
</div>
<!-- /.card -->