<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-body">
      <p class="login-box-msg">Ingresa al panel de Control</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" name="ingEmail" class="form-control" placeholder="Correo Electronico" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="ingPassword" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4 m-auto">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>

        <?php $login = new ControladorAdministradores(); $login -> ctrIngresoAdministrador(); ?>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>