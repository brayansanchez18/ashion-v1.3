<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestor Subcategorias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Subcategorias</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubCategoria">
          Agregar Subcategoría
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaSubCategorias" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Subcategoria</th>
              <th>Ruta</th>
              <th>Categoría</th>
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
/*                         MODAL AGREGAR SUBCATEGORIA                         */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarSubCategoria" tabindex="-1" role="dialog" aria-labelledby="modalAgregarSubCategoria" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR SUBCATEGORÍA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="tituloSubcategoria">Nombre de la Subcategoría</label>
            <input type="text" class="form-control input-lg validarSubCategoria tituloSubcategoria" placeholder="Ingresar Subcategoria" name="tituloSubcategoria" required>
          </div>

          <div class="form-group">
            <label for="rutaSubcategoria">Ruta de la Subcategoría</label>
            <input type="text" class="form-control input-lg rutaSubcategoria" placeholder="Ruta url para la Subcategoría" name="rutaSubcategoria" readonly>
          </div>

          <div class="form-group">
            <label for="rutaSubcategoria">Selecionar categoría</label>

            <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
              <option value="">Selecionar categoría</option>

              <?php
              $item = null;
              $valor = null;
              $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
              ?>

              <?php foreach ($categorias as $key => $value): ?>
                <option value="<?=$value['id']?>"><?=$value['categoria']?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="descripcionSubcategoria">Descripción</label>
            <div id="editorCrearSubCategoria"></div>
            <input type="hidden" name="descripcionSubcategoria" id="descripcionSubcategoria" value="">
          </div>

          <div class="form-group">
            <label for="pClavesSubcategoria">Palabras clave</label>
            <input type="text" class="form-control input-lg pClavesSubcategoria tagsInput" data-role="tagsinput" placeholder="Ingresar palabras claves" name="pClavesSubcategoria" required>
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
          <button type="submit" class="btn btn-primary">Guardar subcategoría</button>
        </div>

        <?php $crearSubCategoria = new ControladorSubCategorias(); $crearSubCategoria -> ctrCrearSubCategoria(); ?>
      </form>
    </div>
  </div>
</div>

<!-- -------------------- End of MODAL AGREGAR SUBCATEGORIA ------------------- -->

<!-- -------------------------------------------------------------------------- */
/*                          MODAL EDITAR SUBCATEGORIA                         */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalEditarSubCategoria" tabindex="-1" role="dialog" aria-labelledby="modalEditarSubCategoria" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">EDITAR SUBCATEGORÍA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="editarTituloSubCategoria">Nombre de la Subcategoría</label>
            <input type="text" class="form-control input-lg validarSubCategoria editarTituloSubCategoria" placeholder="Ingresar Subcategoria" name="editarTituloSubCategoria" required>
            <input type="hidden" class="editarIdSubCategoria" name="editarIdSubCategoria">
            <input type="hidden" class="editarIdCabecera" name="editarIdCabecera">
          </div>

          <div class="form-group">
            <label for="rutaSubcategoria">Ruta de la Subcategoría</label>
            <input type="text" class="form-control input-lg rutaSubcategoria" placeholder="Ruta url para la Subcategoría" name="rutaSubcategoria" readonly>
          </div>

          <div class="form-group">
            <label for="rutaSubcategoria">Selecionar categoría</label>

            <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
              <option class="optionEditarCategoria"></option>

              <?php
              $item = null;
              $valor = null;
              $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
              ?>

              <?php foreach ($categorias as $key => $value): ?>
                <option value="<?=$value['id']?>"><?=$value['categoria']?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="editarDescripcionSubcategoria">Descripción</label>
            <div id="editorEditarSubCategoria"></div>
            <input type="hidden" name="editarDescripcionSubcategoria" id="editarDescripcionSubcategoria" value="">
            <input type="hidden" name="descripcionAntiguaSubCategoria" id="descripcionAntiguaSubCategoria" value="">
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

        <?php $crearCategoria = new ControladorSubCategorias(); $crearCategoria -> ctrEditarSubCategoria(); ?>
      </form>
    </div>
  </div>
</div>

<!-- -------------------- End of MODAL EDITAR SUBCATEGORIA -------------------- -->

<?php $eliminarCategoria = new ControladorSubCategorias(); $eliminarCategoria -> ctrEliminarSubCategoria(); ?>
<script> $(document).keydown(function(e){ if(e.keyCode == 13){ e.preventDefault(); } }) </script>