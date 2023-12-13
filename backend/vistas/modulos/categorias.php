<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestor Categorias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Categorias</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar categoría
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Categoría</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th>Descripción</th>
              <th>Palabras Claves</th>
              <th>Portada</th>
              <th>Tipo de Oferta</th>
              <th>Valor Oferta</th>
              <th>Fin Oferta</th>
              <th>Acciones</th>
            </tr>
          </thead>
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
/*                           MODAL AGREGAR CATEGORIA                          */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCategoria" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR CATEGORÍA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="tituloCategoria">Nombre de la Categoría</label>
            <input type="text" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoria" name="tituloCategoria" required>
          </div>

          <div class="form-group">
            <label for="descripcionCategoria">Ruta de la Categoría</label>
            <input type="text" class="form-control input-lg rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly>
          </div>

          <div class="form-group">
            <label for="nombreBanner">Descripción</label>
            <div id="editorCrearCategoria"></div>
            <input type="hidden" name="descripcionCategoria" id="descripcionCategoria" value="">
          </div>

          <div class="form-group">
            <label for="pClavesCategoria">Palabras clave</label>
            <input type="text" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsinput" placeholder="Ingresar palabras claves" name="pClavesCategoria" required>
          </div>

          <div class="form-group">
            <label for="fotoPortada">Subir foto de portada</label>
            <input type="file" class="form-control fotoPortada" name="fotoPortada">
            <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 4MB</p>
            <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">
          </div>

          <div class="form-group">
            <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
              <option value="">No tiene oferta</option>
              <option value="oferta">Activar oferta</option>
            </select>
          </div>

          <div class="datosOferta" style="display:none">
            <div class="form-group row">
              <div class="col-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ion ion-social-usd"></i></span>
                  </div>
                  <input type="number" class="form-control valorOferta" id="precioOferta" name="precioOferta" min="0" step="any" placeholder="Precio">
                </div>
              </div>

              <div class="col-6">
                <div class="input-group">
                  <input type="number" class="form-control valorOferta" id="descuentoOferta" name="descuentoOferta" min="0" max="100" placeholder="Descuento">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group date">
                <input type='text' class="form-control datepicker input-lg valorOferta" name="finOferta">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar categoría</button>
        </div>
      </form>

      <?php $crearCategoria = new ControladorCategorias(); $crearCategoria -> ctrCrearCategoria(); ?>
    </div>
  </div>
</div>

<!-- --------------------- End of MODAL AGREGAR CATEGORIA --------------------- -->

<!-- -------------------------------------------------------------------------- */
/*                           MODAL EDITAR CATEGORIA                           */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalEditarCategoria" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">EDITAR CATEGORÍA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="editarTituloCategoria">Nombre de la Categoría</label>
            <input type="text" class="form-control input-lg validarCategoria editarTituloCategoria" placeholder="Ingresar Categoria" name="editarTituloCategoria" required>
            <input type="hidden" class="editarIdCategoria" name="editarIdCategoria">
            <input type="hidden" class="editarIdCabecera" name="editarIdCabecera">
          </div>

          <div class="form-group">
            <label for="descripcionCategoria">Ruta de la Categoría</label>
            <input type="text" class="form-control input-lg rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly>
          </div>

          <div class="form-group">
            <label for="nombreBanner">Descripción</label>
            <div id="editarCategoria"></div>
            <input type="hidden" name="descripcionEditarCategoria" id="descripcionEditarCategoria" value="">
            <input type="hidden" name="descripcionAntiguaCategoria" id="descripcionAntiguaCategoria" value="">
          </div>

          <div class="form-group editarPalabrasClaves"></div>

          <div class="form-group">
            <label for="fotoPortada">Subir foto de portada</label>
            <input type="file" class="form-control fotoPortada" name="fotoPortada">
            <input type="hidden" class="antiguaFotoPortada" name="antiguaFotoPortada">
            <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 4MB</p>
            <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">
          </div>

          <div class="form-group">
            <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
              <option value="">No tiene oferta</option>
              <option value="oferta">Activar oferta</option>
            </select>
          </div>

          <div class="datosOferta" style="display:none">
            <div class="form-group row">
              <div class="col-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ion ion-social-usd"></i></span>
                  </div>
                  <input type="number" class="form-control valorOferta" id="precioOferta" name="precioOferta" min="0" step="any" placeholder="Precio">
                </div>
              </div>

              <div class="col-6">
                <div class="input-group">
                  <input type="number" class="form-control valorOferta" id="descuentoOferta" name="descuentoOferta" min="0" max="100" placeholder="Descuento">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group date">
                <input type='text' class="form-control datepicker input-lg finOferta" name="finOferta">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>

      <?php $editarCategoria = new ControladorCategorias(); $editarCategoria -> ctrEditarCategoria(); ?>
    </div>
  </div>
</div>

<!-- ---------------------- End of MODAL EDITAR CATEGORIA --------------------- -->

<?php $eliminarCategoria = new ControladorCategorias(); $eliminarCategoria -> ctrEliminarCategoria(); ?>

<script> $(document).keydown(function(e){if (e.keyCode == 13) {e.preventDefault();}})</script>