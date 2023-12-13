<div class="container-fluid">
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="nav-link active mt-4 mb-4"><a data-toggle="tab" href="#compras" style="color:#000;"><i class="fa fa-list-ul"></i> MIS COMPRAS</a></li>
      <li class="nav-link ml-4 mt-4 mb-4"><a data-toggle="tab" href="#perfil" style="color:#000;"><i class="fa fa-user"></i> EDITAR PERFIL</a></li>
    </ul>

    <div class="tab-content">

      <!-- -------------------------------------------------------------------------- */
      /*                               PESTAÑA COMPRAS                              */
      /* -------------------------------------------------------------------------- -->

      <div id="compras" class="tab-pane active">
        <div class="panel-group">
          <?php
          $item = 'id_usuario';
          $valor = $_SESSION['id'];
          $compras = ControladorUsuario::ctrMostrarCompras($item, $valor);
          ?>

          <?php if (!$compras): ?>
            <div class="col-xs-12 text-center error404">
              <h1><small>¡Oops!</small></h1>
              <h2>Aún no tienes compras realizadas en esta tienda</h2>
            </div>
          <?php else: ?>
            <?php foreach ($compras as $key => $value1): ?>
              <?php
              $ordenar = 'id';
              $item = 'id';
              $valor = $value1['id_producto'];
              $productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);
              ?>

              <?php foreach ($productos as $key => $value2): ?>

                <div class="panel panel-default">
                  <div class="panel-body  d-lg-flex">
                    <div class="col-12 col-lg-2">
                      <a href="<?=$frontend.$value2['ruta']?>">
                        <figure>
                          <img class="img-thumbnail" src="<?=$backend.$value2['portada']?>">
                        </figure>
                      </a>
                    </div>

                    <div class="col-12 col-lg-10">
                      <h1><small><?=$value1['cantidad'].' x '.$value1['detalle']?></small></h1>

                      <h6>Proceso de entrega: <?=$value2['entrega']?> días hábiles</h6>

                      <?php if ($value1['envio'] == 0): ?>
                        <div class="progress" style="height:30px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width:33.33%">
                            Despachado
                          </div>

                          <div class="progress-bar bg-info" role="progressbar" style="width:33.33%">
                            Enviando
                          </div>

                          <div class="progress-bar bg-info" role="progressbar" style="width:33.33%">
                            Entregado
                          </div>
                        </div>
                      <?php endif ?>

                      <?php if ($value1['envio'] == 1): ?>
                        <div class="progress" style="height:30px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width:33.33%">
                            Despachado
                          </div>

                          <div class="progress-bar bg-success" role="progressbar" style="width:33.33%">
                            Enviando
                          </div>

                          <div class="progress-bar bg-info" role="progressbar" style="width:33.33%">
                            Entregado
                          </div>
                        </div>
                      <?php endif ?>

                      <?php if ($value1['envio'] == 2): ?>
                        <div class="progress" style="height:30px;">
                          <div class="progress-bar bg-success" role="progressbar" style="width:33.33%">
                            Despachado
                          </div>

                          <div class="progress-bar bg-success" role="progressbar" style="width:33.33%">
                            Enviando
                          </div>

                          <div class="progress-bar bg-success" role="progressbar" style="width:33.33%">
                            Entregado
                          </div>
                        </div>
                      <?php endif ?>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            <?php endforeach ?>
          <?php endif ?>
        </div>
      </div>

      <!-- ------------------------- End of PESTAÑA COMPRAS ------------------------- -->

      <!-- -------------------------------------------------------------------------- */
      /*                               PESTAÑA PERFIL                               */
      /* -------------------------------------------------------------------------- -->

      <div id="perfil" class="tab-pane">
        <div class="row">
          <div class="col-12 col-md-6 text-center">
            <form method="post" enctype="multipart/form-data">
              <br>
              <figure id="imgPerfil">
                <input type="hidden" value="<?=$_SESSION['id']?>" id="idUsuario" name="idUsuario">
                <input type="hidden" value="<?=$_SESSION['password']?>" name="passUsuario">
                <input type="hidden" value="<?=$_SESSION['foto']?>" name="fotoUsuario" id="fotoUsuario">
                <input type="hidden" value="<?=$_SESSION['modo']?>" name="modoUsuario" id="modoUsuario">

                <?php if ($_SESSION['modo'] == 'directo'): ?>
                  <?php if ($_SESSION['foto'] != ''): ?>
                    <img src="<?=$frontend.$_SESSION['foto']?>" class="img-thumbnail">
                  <?php else: ?>
                    <img src="<?=$backend?>vistas/img/usuarios/default/anonymous.png" class="img-thumbnail">
                  <?php endif ?>
                <?php endif ?>
              </figure>
              <br>

              <?php if ($_SESSION['modo'] == 'directo'): ?>
                <button type="button" class="btn btn-secondary" id="btnCambiarFoto"> Cambiar foto de perfil</button>
              <?php endif ?>

              <div id="subirImagen">
                <input type="file" class="form-control" id="datosImagen" name="datosImagen">
                <img class="previsualizar">
              </div>
            </div>

            <div class="col-12 col-md-6">
              <br>

              <?php if ($_SESSION['modo'] == 'directo'): ?>
                <label class="control-label text-muted text-uppercase" for="editarNombre">Cambiar Nombre:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control text-uppercase" id="editarNombre" name="editarNombre" value="<?=$_SESSION['nombre']?>">
                  </div>
                  <br>

                  <label class="control-label text-muted text-uppercase" for="editarEmail">Cambiar Correo Electrónico:</label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="text" class="form-control" id="editarEmail" name="editarEmail" value="<?=$_SESSION['email']?>">
                  </div>
                  <br>

                  <label class="control-label text-muted text-uppercase" for="editarPassword">Cambiar Contraseña:</label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escribe la nueva contraseña">
                  </div>
                  <br>

                  <button type="submit" class="btn btn-secondary btn-md pull-left">Actualizar Datos</button>
              <?php endif ?>
            </div>

            <?php $actualizarPerfil = new ControladorUsuario(); $actualizarPerfil->ctrActualizarPerfil(); ?>

          </form>

          <a href="<?=$frontend?>salir"><button class="mt-5 btn btn-info btn-md pull-right">Cerrar sesion</button></a>
          <button class="mt-5 ml-auto btn btn-danger btn-md pull-right" id="eliminarUsuario">Eliminar cuenta</button>

          <?php $borrarUsuario = new ControladorUsuario(); $borrarUsuario -> ctrEliminarUsuario(); ?>

        </div>
      </div>

      <!-- -------------------------- End of PESTAÑA PERFIL ------------------------- -->
  </div>
</div>