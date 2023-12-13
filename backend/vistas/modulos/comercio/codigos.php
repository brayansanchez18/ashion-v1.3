<?php $plantilla = ControladorComercio::ctrSeleccionarPlantilla(); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Codigos</h3>
  </div>

  <div class="card-body p-8">
    <div class="form-group">
      <label>Api de Facebook:</label>
      <textarea class="form-control cambioScript" rows="5" id="apiFacebook"">
      <?=$plantilla['apiFacebook']?>
      </textarea>
    </div>
  </div>

  <div class="card-body p-8">
    <div class="form-group">
      <label>Codigo de Google Maps:</label>
      <textarea class="form-control cambioScript" rows="5" id="frameMaps">
      <?=$plantilla['frameGoogleMaps']?>
      </textarea>
    </div>
  </div>

  <!-- /.card-body -->
  <div class="card-footer">
    <button type="button" id="guardarScript" class="btn btn-primary float-right">Guardar</button>
  </div>
</div>