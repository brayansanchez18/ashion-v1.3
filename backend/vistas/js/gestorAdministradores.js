/* -------------------------------------------------------------------------- */
/*                          TALBA DE ADMINISTRADORES                          */
/* -------------------------------------------------------------------------- */

$(".tablaPerfiles").DataTable({
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }

});

/* --------------------- End of TALBA DE ADMINISTRADORES -------------------- */

/* -------------------------------------------------------------------------- */
/*                               ACTIVAR PERFIL                               */
/* -------------------------------------------------------------------------- */

$(".tablaPerfiles").on("click", ".btnActivar", function() {

  var idPerfil = $(this).attr("idPerfil");
  var estadoPerfil = $(this).attr("estadoPerfil");

  var datos = new FormData();
  datos.append("activarId", idPerfil);
  datos.append("activarPerfil", estadoPerfil);

  $.ajax({
    url:"ajax/administradores.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {}
  })

  if (estadoPerfil == 0) {
    $(this).removeClass('btn-success');
    $(this).addClass('btn-danger');
    $(this).html('Desactivado');
    $(this).attr('estadoPerfil',1);
  } else {
    $(this).addClass('btn-success');
    $(this).removeClass('btn-danger');
    $(this).html('Activado');
    $(this).attr('estadoPerfil',0);
  }

})

$('.adminag').on("click", ".per", function() {
  $(".previsualizar").attr("src", '');
  $(".previsualizar").attr("src", 'vistas/img/perfiles/default/anonymous.png');
})

/* -------------------------- End of ACTIVAR PERFIL ------------------------- */

/* -------------------------------------------------------------------------- */
/*                         SUBIENDO LA FOTO DEL PERFIL                        */
/* -------------------------------------------------------------------------- */

$(".nuevaFoto").change(function() {

  var imagen = this.files[0];

  /* -------------------------------------------------------------------------- */
  /*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
  /* -------------------------------------------------------------------------- */

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

    $(".nuevaFoto").val("");

    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen debe estar en formato JPG o PNG",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

  }

  /* --------- End of VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG --------- */

  /* -------------------------------------------------------------------------- */
  /*                      VALIDAMOS EL TAMAÑO DE LA IMAGEN                      */
  /* -------------------------------------------------------------------------- */

  else if (imagen["size"] > 4000000) {

    $(".nuevaFoto").val("");

    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen no debe pesar más de 4MB",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

  }

  /* ----------------- End of VALIDAMOS EL TAMAÑO DE LA IMAGEN ---------------- */

  /* -------------------------------------------------------------------------- */
  /*                           VISUALIZAMOS LA IMAGEN                           */
  /* -------------------------------------------------------------------------- */

  else {

    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event) {
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    })

  }

  /* ---------------------- End of VISUALIZAMOS LA IMAGEN --------------------- */

})

/* ------------------- End of SUBIENDO LA FOTO DEL PERFIL ------------------- */

/* -------------------------------------------------------------------------- */
/*                                EDITAR PERFIL                               */
/* -------------------------------------------------------------------------- */

$(".tablaPerfiles").on("click", ".btnEditarPerfil", function() {

  $(".previsualizar").attr("src","vistas/img/perfiles/default/anonymous.png");

  var idPerfil = $(this).attr("idPerfil");

  var datos = new FormData();
  datos.append("idPerfil", idPerfil);

  $.ajax({
    url:"ajax/administradores.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      $("#editarNombre").val(respuesta["nombre"]);
      $("#idPerfil").val(respuesta["id"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#editarPerfil").html(respuesta["perfil"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#fotoActual").val(respuesta["foto"]);
      $("#passwordActual").val(respuesta["pass"]);

      if (respuesta["foto"] != "") { $(".previsualizar").attr("src", respuesta["foto"]); }
    }
  })

})

/* -------------------------- End of EDITAR PERFIL -------------------------- */

/* -------------------------------------------------------------------------- */
/*                              ELIMINAR USUARIO                              */
/* -------------------------------------------------------------------------- */

$(".tablaPerfiles").on("click", ".btnEliminarPerfil", function() {
  var idPerfil = $(this).attr("idPerfil");
  var fotoPerfil = $(this).attr("fotoPerfil");

  Swal.fire({
    title: "¿Está seguro de borrar el perfil?",
    text: "Si no lo está puede cancelar la accíón",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar perfil!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=perfiles&idPerfil="+idPerfil+"&fotoPerfil="+fotoPerfil;
    }
  })

})

/* ------------------------- End of ELIMINAR USUARIO ------------------------ */