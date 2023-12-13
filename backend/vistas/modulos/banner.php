<?php $item = ''; $valor = ''; $banner = ControaldorBanner::ctrMostrarBanner($item, $valor);?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestor Banner</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$backend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Gestor Banner</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaBanner" width="100%">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Imagen</th>
              <th>Titulo</th>
              <th>Texto</th>
              <th>Boton</th>
              <th>URL Boton</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <?php foreach($banner as $key => $value): ?>
                <th><?=$value['nombre']?></th>
                <th><img class="img-thumbnail" style="width:200px;" src="<?=$value['imgFondo']?>"></th>
                <th><?=$value['titulo']?></th>
                <?php if (strlen($value['texto']) > 100): ?>
                  <th><?=substr($value['texto'], 0, 100) . '...'?></th>
                <?php else: ?>
                  <th><?=$value['texto']?></th>
                <?php endif ?>
                <?php if ($value['boton'] != ''): ?>
                  <th><?=$value['boton']?></th>
                  <th><?=$value['ruta']?></th>
                <?php else: ?>
                  <th>Sin Texto para el Boton</th>
                  <th>Sin ruta para el boton</th>
                <?php endif ?>
                <th>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarBanner" idBanner="<?=$value['id']?>" data-toggle="modal" data-target="#modalEditarBanner">
                      <i class="fa fa-edit"></i>
                    </button>
                  </div>
                </th>
              <?php endforeach ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL PARA EDITAR BANNER -->
<div class="modal fade" id="modalEditarBanner" tabindex="-1" role="dialog" aria-labelledby="modalEditarBanner" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nombreBanner">Nombre del Banner</label>
          <input type="text" class="form-control nombreBanner" id="nombreBanner" name="nombreBanner" value="" required>
          <input type="hidden" id="idBanner" name="idBanner">
        </div>
        <div class="form-group">
          <label for="imagenBanner">Imagen del Banner</label>
          <input type="file" class="form-control nuevaFotoBanner" id="imagenBanner" name="imagenBanner">
          <p class="note-help-block">Peso máximo de la foto 10MB</p>
          <img class="img-thumbnail previsualizarBanner" style="width:200px;" src="vistas/img/banner/lorem.jpg">
          <input type="hidden" name="imgBannerActual" id="imgBannerActual">
        </div>
        <div class="form-group">
          <label for="tiutloBanner">Tiulo del Banner</label>
          <input type="text" class="form-control" id="tiutloBanner" name="tiutloBanner" value="" required>
        </div>
        <div class="form-group">
          <label for="textoBanner">Texto del Banner</label>
          <div id="editor">
            <p>Se recomienda usar un máximo de 200 palabras para no deformar el diseño del bannner</p>
          </div>
          <input type="hidden" id="textoBannerActual" name="textoBannerActual" value="">
          <input type="hidden" id="textonuevo" name="textonuevo" value="">
        </div>
        <div class="form-group">
          <label for="textoBoton">Texto Boton</label>
          <input type="text" class="form-control" id="textoBoton" name="textoBoton" value="">
        </div>
        <div class="form-group">
          <label for="rutaBoton">URL del Boton</label>
          <input type="text" class="form-control" id="rutaBoton" name="rutaBoton" value="">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>

      <?php $editarBanner = new ControaldorBanner(); $editarBanner -> ctrEditarBanner(); ?>
      </form>
    </div>
  </div>
</div>
<!-- End of MODAL PARA EDITAR BANNER -->