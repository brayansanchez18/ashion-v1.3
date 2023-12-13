<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestor Productos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Productos</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          Agregar producto
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Titulo</th>
              <th>Ruta</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Estado</th>
              <th>Descripción</th>
              <th>Palabras Claves</th>
              <th>Portada</th>
              <th>Imagen Principal</th>
              <th>Multimedia</th>
              <th>Detalles</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Peso</th>
              <th>Tiempo de Entrega</th>
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
/*                         MODAL PARA AGREGAR PRODUCTOS                         */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="tituloProducto">Nombre del Producto</label>
          <input type="text" class="form-control input-lg validarProducto tituloProducto" placeholder="Ingresar Nombre Producto" required>
        </div>

        <div class="form-group">
          <label for="rutaProducto">Ruta del Producto</label>
          <input type="text" class="form-control input-lg rutaProducto" placeholder="Ruta del Producto" readonly>
        </div>

        <div class="form-group agregarMultimedia">
          <label for="multimediaProducto">Multimedia del Producto</label>
          <div class="multimediaFisica needsclick dz-clickable">
            <div class="dz-message needsclick">
              Arrastrar o dar click para subir imagenes.
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="detallesFisicos">
            <label for="detallesProducto">Detalles del Producto</label>

            <div class="form-group row">
              <div class="col-3">
                <input class="form-control input-lg" type="text" value="Talla" readonly>
              </div>

              <div class="col-9">
                <input class="form-control input-lg tagsInput detalleTalla" data-role="tagsinput" type="text" placeholder="Separe valores con coma">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-3">
                <input class="form-control input-lg" type="text" value="Color" readonly>
              </div>

              <div class="col-9">
                  <input class="form-control input-lg tagsInput detalleColor" data-role="tagsinput" type="text" placeholder="Separe valores con coma">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="seleccionarCategoria">Categoria del Producto</label>
          <select class="form-control input-lg seleccionarCategoria">
            <option value="">Selecionar categoría</option>
            <?php $item = null; $valor = null; $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor); ?>

            <?php foreach ($categorias as $key => $value): ?>
              <option value="<?=$value['id']?>"><?=$value['categoria']?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group  entradaSubcategoria" style="display:none">
          <label for="seleccionarCategoria">Subcategoria del Producto</label>
          <select class="form-control input-lg seleccionarSubCategoria"></select>
        </div>

        <div class="form-group">
          <label for="descripcionProducto">Descripcion del Producto</label>
          <div id="descripcionProducto"></div>
          <input type="hidden" id="descripcionProducto" value="">
        </div>

        <div class="form-group">
          <label for="pClavesProducto">Palabras clave del Producto</label>
          <input type="text" class="form-control input-lg tagsInput pClavesProducto" data-role="tagsinput"  placeholder="Ingresar palabras claves">
        </div>

        <div class="form-group">
          <label for="fotoPortada">Subir foto de portada</label>
          <input type="file" class="form-control fotoPortada" name="fotoPortada">
          <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 4MB</p>
          <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">
        </div>

        <div class="form-group">
          <label for="fotoPortada">Subir imagen principal del producto</label>
          <input type="file" class="form-control fotoPrincipal">
          <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 4MB</p>
          <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">
        </div>

        <div class="form-group row">
          <div class="col-12 col-md-6">
            <div class="panel">PRECIO</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="ion ion-social-usd"></i></span>
              </div>
              <input type="number" class="form-control input-lg precio" min="0" step="any" value="0">
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="panel">PESO (kg)</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-balance-scale"></i></span>
              </div>
              <input type="number" class="form-control input-lg peso" min="1" step="any" value="0">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-12 col-md-6">
            <div class="panel">DÍAS DE ENTREGA</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-truck"></i></span>
              </div>
              <input type="number" class="form-control input-lg entrega" min="1" value="0">
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="panel">STOCK</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
              </div>
              <input type="number" class="form-control input-lg stock" min="1" value="0">
            </div>
          </div>
        </div>

        <div class="form-group">
          <select class="form-control input-lg selActivarOferta">
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
                <input class="form-control input-lg valorOferta precioOferta" tipo="oferta" type="number" value="0" min="0" placeholder="Precio">
              </div>
            </div>

            <div class="col-6">
              <div class="input-group">
                <input class="form-control input-lg valorOferta descuentoOferta" tipo="descuento" type="number" value="0"  min="0" placeholder="Descuento">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group date">
              <input type='text' class="form-control datepicker input-lg valorOferta finOferta">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary guardarProducto">Guardar Producto</button>
      </div>
    </div>
  </div>
</div>

<!-- ------------------- End of MODAL PARA AGREGAR PRODUCTOS ------------------ -->

<!-- -------------------------------------------------------------------------- */
/*                          MODAL PARA EDITAR PRODUCTOS                         */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">EDITAR PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="tituloProducto">Nombre del Producto</label>
          <input type="text" class="form-control input-lg validarProducto tituloProducto" readonly>
          <input type="hidden" class="idProducto">
          <input type="hidden" class="idCabecera">
        </div>

        <div class="form-group">
          <label for="rutaProducto">Ruta del Producto</label>
          <input type="text" class="form-control input-lg rutaProducto" readonly>
        </div>

        <div class="form-group agregarMultimedia">
          <label for="multimediaProducto">Multimedia del Producto</label>
          <div class="row previsualizarImgFisico"></div>
          <div class="multimediaFisica needsclick dz-clickable">
            <div class="dz-message needsclick">
              Arrastrar o dar click para subir imagenes.
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="detallesFisicos">
            <label for="detallesProducto">Detalles del Producto</label>

            <div class="form-group row">
              <div class="col-3">
                <input class="form-control input-lg" type="text" value="Talla" readonly>
              </div>

              <div class="col-9 editarTalla"></div>
            </div>

            <div class="form-group row">
              <div class="col-3">
                <input class="form-control input-lg" type="text" value="Color" readonly>
              </div>

              <div class="col-9 editarColor"></div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="seleccionarCategoria">Categoria del Producto</label>
          <select class="form-control input-lg seleccionarCategoria">
            <option value="">Selecionar categoría</option>
            <?php $item = null; $valor = null; $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor); ?>

            <?php foreach ($categorias as $key => $value): ?>
              <option value="<?=$value['id']?>"><?=$value['categoria']?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group entradaSubcategoria">
          <label for="seleccionarCategoria">Subcategoria del Producto</label>
          <select class="form-control input-lg seleccionarSubCategoria">
            <option class="optionEditarSubCategoria"></option>
          </select>
        </div>

        <div class="form-group">
          <label for="descripcionProducto">Descripcion del Producto</label>
          <div id="descripcionEditarProducto"></div>
          <input type="hidden" id="descripcionEditarProductoIput" value="">
          <input type="hidden" id="antiguaDescripcionProducto" value="">
        </div>

        <div class="form-group editarPalabrasClaves"></div>

        <div class="form-group">
          <label for="fotoPortada">Subir foto de portada</label>
          <input type="file" class="form-control fotoPortada" name="fotoPortada">
          <input type="hidden" class="antiguaFotoPortada">
          <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 4MB</p>
          <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">
        </div>

        <div class="form-group">
          <label for="fotoPortada">Subir imagen principal del producto</label>
          <input type="file" class="form-control fotoPrincipal">
          <input type="hidden" class="antiguaFotoPrincipal">
          <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 4MB</p>
          <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">
        </div>

        <div class="form-group row">
          <div class="col-12 col-md-6">
            <div class="panel">PRECIO</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="ion ion-social-usd"></i></span>
              </div>
              <input type="number" class="form-control input-lg precio" min="0" step="any" value="0">
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="panel">PESO (kg)</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-balance-scale"></i></span>
              </div>
              <input type="number" class="form-control input-lg peso" min="1" step="any" value="0">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-12 col-md-6">
            <div class="panel">DÍAS DE ENTREGA</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-truck"></i></span>
              </div>
              <input type="number" class="form-control input-lg entrega" min="1" value="0">
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="panel">STOCK</div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
              </div>
              <input type="number" class="form-control input-lg stock" min="1" value="0">
            </div>
          </div>
        </div>

        <div class="form-group">
          <select class="form-control input-lg selActivarOferta">
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
                <input class="form-control input-lg valorOferta precioOferta" tipo="oferta" type="number" value="0" min="0" placeholder="Precio">
              </div>
            </div>

            <div class="col-6">
              <div class="input-group">
                <input class="form-control input-lg valorOferta descuentoOferta" tipo="descuento" type="number" value="0"  min="0" placeholder="Descuento">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group date">
              <input type='text' class="form-control datepicker input-lg valorOferta finOferta">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary guardarCambiosProducto">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- ------------------- End of MODAL PARA EDITAR PRODUCTOS ------------------- -->

<?php $eliminarProducto = new ControladorProductos(); $eliminarProducto -> ctrEliminarProducto(); ?>