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
          <h1>Gestor Perfiles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Perfiles</li>
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
        <button class="btn btn-primary per" data-toggle="modal" data-target="#modalAgregarPerfil">
          Agregar perfil
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaPerfiles" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $item = null;
            $valor = null;
            $perfiles = ControladorAdministradores::ctrMostrarAdministradores($item, $valor); ?>

            <?php foreach ($perfiles as $key => $value): ?>
              <tr>
                <td><?=($key+1)?></td>
                <td class="text-capitalize"><?=$value['nombre']?></td>
                <td><?=$value['email']?></td>

                <?php if ($value['foto'] != ''): ?>
                  <td><img src="<?=$value['foto']?>" class="img-thumbnail" width="40px"></td>
                <?php else: ?>
                  <td><img src="vistas/img/perfiles/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <?php endif ?>
                <td class="text-capitalize"><?=$value['perfil']?></td>

                <?php if ($value['estado'] != 0): ?>
                  <td><button class="btn btn-success btn-xs btnActivar" id="btnactivar" idPerfil="<?=$value['id']?>" estadoPerfil="0">Activado</button></td>
                <?php else: ?>
                  <td><button class="btn btn-danger btn-xs btnActivar" id="btnactivar" idPerfil="<?=$value['id']?>" estadoPerfil="1">Desactivado</button></td>
                <?php endif ?>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarPerfil" idPerfil="<?=$value['id']?>" data-toggle="modal" data-target="#modalEditarPerfil"><i class="fa fa-edit"></i></button>

                    <button class="btn btn-danger btnEliminarPerfil" idPerfil="<?=$value['id']?>" fotoPerfil="<?=$value['foto']?>"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- -------------------------------------------------------------------------- */
/*                            MODAL AGREGAR PERFIL                            */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarPerfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Email" id="nuevoEmail" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
            </div>
            <select class="form-control input-lg" name="nuevoPerfil">
              <option value="">Selecionar perfil</option>
              <option value="administrador">Administrador</option>
              <option value="editor">Editor</option>
            </select>
          </div>

          <div class="mb-2">
            <div class="panel">SUBIR FOTO</div>
            <input type="file" class="form-control input-lg nuevaFoto" name="nuevaFoto">
            <p class="help-block">Peso máximo de la foto 4MB</p>
            <img src="vistas/img/perfiles/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Crear Perfil</button>
        </div>
        <?php $crearPerfil = new ControladorAdministradores(); $crearPerfil -> ctrCrearPerfil(); ?>
      </form>
    </div>
  </div>
</div>

<!-- ----------------------- End of MODAL AGREGAR PERFIL ---------------------- -->

<!--- -------------------------------------------------------------------------- */
/*                             MODAL EDITAR PERFIL                            */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalEditarPerfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
            <input type="hidden" id="idPerfil" name="idPerfil">
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" value="" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
            <input type="hidden" id="passwordActual" name="passwordActual">
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
            </div>
            <select class="form-control input-lg" name="editarPerfil">
              <option value="" id="editarPerfil"></option>
              <option value="administrador">Administrador</option>
              <option value="editor">Editor</option>
            </select>
          </div>

          <div class="mb-2">
            <div class="panel">SUBIR FOTO</div>
            <input type="file" class="form-control input-lg nuevaFoto" name="editarFoto">
            <p class="help-block">Peso máximo de la foto 4MB</p>
            <img src="vistas/img/perfiles/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">
            <input type="hidden" name="fotoActual" id="fotoActual">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Perfil</button>
        </div>
        <?php $editarPerfil = new ControladorAdministradores(); $editarPerfil -> ctrEditarPerfil(); ?>
      </form>
    </div>
  </div>
</div>

<!-- ----------------------- End of MODAL EDITAR PERFIL ----------------------- -->

<?php $eliminarPerfil = new ControladorAdministradores(); $eliminarPerfil -> ctrEliminarPerfil(); ?>