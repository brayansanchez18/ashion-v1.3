<?php $comercio = ControladorComercio::ctrSeleccionarComercio(); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Información de Comercio</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- DIVISA -->
    <div class="form-group">
      <label for="usr">Divisa:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fas fa-dollar-sign"></i></span>
        <input type="hidden" id="coddivisa" value="<?=$comercio['divisa']?>">
        <select class="form-control cambioInformacion" id="seleccionarDivisa">
          <option id="divisaSeleccionada"></option>
        </select>
      </div>
    </div>
    <!-- /DIVISA -->

    <!-- IMPUESTO -->
    <div class="form-group">
      <label for="usr">Impuesto:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fas fa-percent"></i></span>
        <input type="number" min="1" class="form-control cambioInformacion" id="impuesto" value="<?=$comercio['impuesto']?>">
      </div>
    </div>
    <!-- /IMPUESTO -->

    <!-- ENVÍO NACIONAL -->
    <div class="form-group">
      <label for="usr">Envío Nacional:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fas fa-dollar-sign"></i></span>
        <input type="number" min="1" class="form-control cambioInformacion" id="envioNacional" value="<?=$comercio['envioNacional']?>">
      </div>
    </div>
    <!-- /ENVÍO NACIONAL -->

    <!-- ENVÍO INTERNACIONAL -->
    <div class="form-group">
      <label for="usr">Envío Internacional:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fas fa-dollar-sign"></i></span>
        <input type="number" min="1" class="form-control cambioInformacion" id="envioInternacional" value="<?=$comercio['envioInternacional']?>">
      </div>
    </div>
    <!-- /ENVÍO INTERNACIONAL -->

    <!-- TASA MÍNIMA NACIONAL -->
    <div class="form-group">
      <label for="usr">Tasa Mínima Nacional:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fas fa-dollar-sign"></i></span>
        <input type="number" min="1" class="form-control cambioInformacion" id="tasaMinimaNal" value="<?=$comercio['tasaMinimaNal']?>">
      </div>
    </div>
    <!-- /TASA MÍNIMA NACIONAL -->

    <!-- TASA MÍNIMA INTERNACIONAL -->
    <div class="form-group">
      <label for="usr">Tasa Mínima Internacional:</label>
      <div class="input-group">
        <span class="input-group-addon ml-2 mr-2 mt-auto mb-auto"><i class="fas fa-dollar-sign"></i></span>
        <input type="number" min="1" class="form-control cambioInformacion" id="tasaMinimaInt" value="<?=$comercio['tasaMinimaInt']?>">
      </div>
    </div>
    <!-- /TASA MÍNIMA INTERNACIONAL -->

    <!-- SELECCIONAR PAÍS -->
    <div class="form-group">
      <label for="sel1">Seleccione País:</label>
      <input type="hidden" id="codigoPais" value="<?=$comercio['pais']?>">
      <select class="form-control cambioInformacion" id="seleccionarPais">
        <option id="paisSeleccionado"></option>
      </select>
    </div>
    <!-- /SELECCIONAR PAÍS -->

    <!-- PASARELA DE PAGO PAYPAL -->
    <div class="panel panel-default">
			<div class="panel-heading">
        <h4 class="text-uppercase">Configuración Paypal</h4>
      </div>

      <div class="panel-body">
        <div class="form-group row">
          <div class="col-12 col-md-3">
            <label>Modo:</label>
            <br>
            <?php if ($comercio["modoPaypal"]=="sandbox"): ?>
              <label class="checkbox">
                <input type="radio" class="cambioInfo" name="modoPaypal" value="sandbox" checked> Sandbox
              </label>
              <br>
              <label class="checkbox">
                <input type="radio" class="cambioInfo" name="modoPaypal" value="live"> Live
              </label>
            <?php else: ?>
              <label class="checkbox">
                <input type="radio" class="cambioInfo" name="modoPaypal" value="sandbox"> Sandbox
              </label>
              <br>
              <label class="checkbox">
                <input type="radio" class="cambioInfo" name="modoPaypal" value="live" checked> Live
              </label>
            <?php endif ?>
          </div>

          <div class="col-12 col-md-4">
            <label for="comment">Cliente:</label>
            <input type="text" class="form-control cambioInformacion" id="clienteIdPaypal" value="<?=$comercio['clienteIdPaypal']?>">
          </div>

          <div class="col-12 col-md-5">
            <label for="comment">Llave Secreta:</label>
            <input type="text" class="form-control cambioInformacion" id="llaveSecretaPaypal" value="<?=$comercio['llaveSecretaPaypal']?>">
          </div>
        </div>
      </div>
    </div>
    <!-- /PASARELA DE PAGO PAYPAL -->
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="button" id="guardarInformacion" class="btn btn-primary float-right">Guardar</button>
  </div>
</div>
<!-- /.card -->