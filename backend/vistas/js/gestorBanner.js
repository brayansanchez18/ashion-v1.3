$(".tablaBanner").DataTable({
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

var quill = new Quill('#editor', {
    theme: 'snow'
  });

/* -------------------------------------------------------------------------- */
/*                          SUBIENDO FOTO DEL BANNER                          */
/* -------------------------------------------------------------------------- */

$(".nuevaFotoBanner").change(function() {

  var imagen = this.files[0];

  /* -------------------------------------------------------------------------- */
  /*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
  /* -------------------------------------------------------------------------- */

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaFotoBanner").val("");

		Swal.fire({
			title: "¡Error al subir la imagen!",
			text: "La imagen debe estar en formato JPG o PNG",
			icon: "error",
			confirmButtonText: "Cerrar",
			closeOnConfirm: false,
		}).then((isConfirm) => {
			if (isConfirm) {
				//window.location = rutaOculta;
			}
		});

	}

	/* --------- End of VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG --------- */

	/* -------------------------------------------------------------------------- */
	/*           VALIDAMOS QUE EL PESO DE LA IMAGEN NO SEA MAYOR A 10MB           */
	/* -------------------------------------------------------------------------- */

	else if (imagen["size"] > 10000000) {

		$(".nuevaFotoBanner").val("");

		Swal.fire({
			title: "¡Error al subir la imagen!",
			text: "La imagen no debe pesar más de 10MB",
			icon: "error",
			confirmButtonText: "Cerrar",
			closeOnConfirm: false,
		}).then((isConfirm) => {
			if (isConfirm) {
				//window.location = rutaOculta;
			}
		});

	}

	/* ------ End of VALIDAMOS QUE EL PESO DE LA IMAGEN NO SEA MAYOR A 10MB ----- */

	/* -------------------------------------------------------------------------- */
	/*                          PREVISUALIZAMOS LA IMAGEN                         */
	/* -------------------------------------------------------------------------- */

	else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event) {
			var rutaImagen = event.target.result;
			$(".previsualizarBanner").attr("src", rutaImagen);
		})

	}

	/* -------------------- End of PREVISUALIZAMOS LA IMAGEN -------------------- */
})

quill.on('text-change', function() {
	var contenido = $('#editor .ql-editor').html();
	$("#modalEditarBanner #textonuevo").val(contenido);
});

/* --------------------- End of SUBIENDO FOTO DEL BANNER -------------------- */

/* -------------------------------------------------------------------------- */
/*                                EDITAR BANNER                               */
/* -------------------------------------------------------------------------- */

$(".tablaBanner tbody").on("click", ".btnEditarBanner", function() {

	var idBanner = $(this).attr("idBanner");

	var datos = new FormData();
	datos.append("idBanner", idBanner);

	$.ajax({
		url:"ajax/banner.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$("#modalEditarBanner #idBanner").val(respuesta["id"]);
			$("#modalEditarBanner #imgBannerActual").val(respuesta["imgFondo"]);
			$("#modalEditarBanner .nombreBanner").val(respuesta["nombre"]);
			if (respuesta["imgFondo"] != "") {
				$("#modalEditarBanner .previsualizarBanner").attr("src", respuesta["imgFondo"]);
			}
			$("#modalEditarBanner #tiutloBanner").val(respuesta["titulo"]);
			$("#modalEditarBanner #textoBoton").val(respuesta["boton"]);
			$("#modalEditarBanner #rutaBoton").val(respuesta["ruta"]);
			$("#modalEditarBanner #textoBannerActual").val(respuesta["texto"]);


		}

	})

})

/* -------------------------- End of EDITAR BANNER -------------------------- */