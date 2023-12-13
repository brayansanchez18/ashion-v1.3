<?php $plantilla = ControladorComercio::ctrSeleccionarPlantilla(); $redSocial = json_decode($plantilla['redesSociales'], true); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Redes Sociales</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-8">
    <?php foreach ($redSocial as $key => $value): ?>
    <div class="form-group row">
      <div class="col-10">
        <div class="input-group">
          <span class="input-group-addon ml-4 mr-4"><i class="fab <?=$value['red']?>"></i></span>
          <input type="text" class="cambiarUrlRed form-control input-lg mr-4" value="<?=$value['url']?>">
        </div>
      </div>

      <div class="col-2">
        <?php if ($value['activo'] != 0): ?>
          <input type="checkbox" class="seleccionarRed" ruta="<?=$value['url']?>" red="<?=$value['red']?>" validarRed="<?=$value['red']?>" checked>
        <?php else: ?>
          <input type="checkbox" class="seleccionarRed" ruta="<?=$value['url']?>" red="<?=$value['red']?>" validarRed="">
        <?php endif ?>
      </div>
    </div>
    <?php endforeach ?>

    <input type="hidden" id="valorRedesSociales" value="<?=$plantilla['redesSociales']?>">
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="button" id="guardarRedesSociales" class="btn btn-primary float-right">Guardar</button>
  </div>
</div>
<!-- /.card -->