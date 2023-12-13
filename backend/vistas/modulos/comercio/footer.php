<?php $footer = ControladorComercio::ctrMostrarInfoContacto(); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Información de Contacto</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="form-group">
      <label for="usr">Numero de Whatsapp:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fab fa-whatsapp"></i></span>
        <input type="text" class="form-control cambioInformacionFooter" id="numerow" value="<?=$footer['numeroWhatsapp']?>">
      </div>
    </div>

    <div class="form-group">
      <label for="usr">Correo Electrónico de Contacto:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="far fa-envelope"></i></span>
        <input type="text" class="form-control cambioInformacionFooter" id="correo" value="<?=$footer['correo']?>">
      </div>
    </div>

    <div class="form-group">
      <label for="usr">Direccion del Establecimiento:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fas fa-map-marker-alt"></i></span>
        <input type="text" class="form-control cambioInformacionFooter" id="direccion" value="<?=$footer['direccion']?>">
      </div>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="button" id="guardarInformacionFooter" class="btn btn-primary float-right">Guardar</button>
  </div>
</div>
<!-- /.card -->