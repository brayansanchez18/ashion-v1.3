/* -------------------------------------------------------------------------- */
/*                   CARGAR LA TABLA DINÁMICA DE CATEGORÍAS                   */
/* -------------------------------------------------------------------------- */

// $.ajax({

// 	url:"ajax/tablaCategorias.ajax.php",
// 	success:function(respuesta) {
// 		console.log('%cMyProject%cline:8%crespuesta', 'color:#fff;background:#ee6f57;padding:3px;border-radius:2px', 'color:#fff;background:#1f3c88;padding:3px;border-radius:2px', 'color:#fff;background:rgb(248, 147, 29);padding:3px;border-radius:2px', respuesta)
// 	}

// })

$(".tablaCategorias").DataTable({
	"ajax": "ajax/tablaCategorias.ajax.php",
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

/* -------------- End of CARGAR LA TABLA DINÁMICA DE CATEGORÍAS ------------- */

/* -------------------------------------------------------------------------- */
/*                         EDITOR DE TEXTO ENRIQUZIDO                         */
/* -------------------------------------------------------------------------- */

var quill = new Quill('#editorCrearCategoria', {
	theme: 'snow'
});

var quillEditar = new Quill('#editarCategoria', {
	theme: 'snow'
});

/* -------------------- End of EDITOR DE TEXTO ENRIQUZIDO ------------------- */

/* -------------------------------------------------------------------------- */
/*                              ACTIVAR CATEGORÍA                             */
/* -------------------------------------------------------------------------- */

$(".tablaCategorias tbody").on("click", ".btnActivar", function(){

	var idCategoria = $(this).attr("idCategoria");
	var estadoCategoria = $(this).attr("estadoCategoria");

	var datos = new FormData();
	datos.append("activarId", idCategoria);
		datos.append("activarCategoria", estadoCategoria);

		$.ajax({

			url:"ajax/categorias.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta) {}
		});

		if (estadoCategoria == 0) {

			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
			$(this).html('Desactivado');
			$(this).attr('estadoCategoria',1);

		} else {

			$(this).addClass('btn-success');
			$(this).removeClass('btn-danger');
			$(this).html('Activado');
			$(this).attr('estadoCategoria',0);

		}

})

/* ------------------------ End of ACTIVAR CATEGORÍA ------------------------ */

/* -------------------------------------------------------------------------- */
/*                      REVISAR SI LA CATEGORÍA YA EXISTE                     */
/* -------------------------------------------------------------------------- */

$(".validarCategoria").change(function() {

	$(".alert").remove();

	var categoria = $(this).val();
	var datos = new FormData();
	datos.append("validarCategoria", categoria);

	$.ajax({
		url:"ajax/categorias.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta) {

			if (respuesta) {
				$(".validarCategoria").parent().after('<div class="alert alert-warning">Esta categoría ya existe</div>')
				$(".validarCategoria").val("");
			}

		}

	})

});

/* ---------------- End of REVISAR SI LA CATEGORÍA YA EXISTE ---------------- */

/* -------------------------------------------------------------------------- */
/*                               RUTA CATEGORÍA                               */
/* -------------------------------------------------------------------------- */

function limpiarUrl(texto) {
	var texto = texto.toLowerCase();
	texto = texto.replace(/[á]/, 'a');
	texto = texto.replace(/[é]/, 'e');
	texto = texto.replace(/[í]/, 'i');
	texto = texto.replace(/[ó]/, 'o');
	texto = texto.replace(/[ú]/, 'u');
	texto = texto.replace(/[ñ]/, 'n');
	texto = texto.replace(/ /g, '-');
	return texto;
}

$(".tituloCategoria").change(function() {
	$(".rutaCategoria").val(limpiarUrl($(".tituloCategoria").val()));
})

/* -------------------------- End of RUTA CATEGORÍA ------------------------- */

/* -------------------------------------------------------------------------- */
/*                            DESCRIPCION CATEGORIA                           */
/* -------------------------------------------------------------------------- */

quill.on('text-change', function() {
	var contenido = $('#editorCrearCategoria .ql-editor').html();
	$("#modalAgregarCategoria #descripcionCategoria").val(contenido);
});

quillEditar.on('text-change', function() {
	var contenido = $('#editarCategoria .ql-editor').html();
	$("#modalEditarCategoria #descripcionEditarCategoria").val(contenido);
});

/* ---------------------- End of DESCRIPCION CATEGORIA ---------------------- */

/* -------------------------------------------------------------------------- */
/*                         SUBIENDO LA FOTO DE PORTADA                        */
/* -------------------------------------------------------------------------- */

$(".fotoPortada").change(function() {

	var imagen = this.files[0];

	/* -------------------------------------------------------------------------- */
	/*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
	/* -------------------------------------------------------------------------- */

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".fotoPortada").val("");

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

		return;

	}

	/* --------- End of VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG --------- */

	/* -------------------------------------------------------------------------- */
	/*                      VALIDAMOS EL TAMAÑO DE LA IMAGEN                      */
	/* -------------------------------------------------------------------------- */

	else if(imagen["size"] > 4000000) {

		$(".fotoPortada").val("");

		Swal.fire({
			title: "¡Error al subir la imagen!",
			text: "La imagen no debe pesar más de 4MB",
			icon: "error",
			confirmButtonText: "Cerrar",
			closeOnConfirm: false,
		}).then((isConfirm) => {
			if (isConfirm) {
				//window.location = rutaOculta;
			}
		});

		return;

	}

	/* ----------------- End of VALIDAMOS EL TAMAÑO DE LA IMAGEN ---------------- */

	else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){
			var rutaImagen = event.target.result;
			$(".previsualizarPortada").attr("src", rutaImagen);
		})
	}

})

/* ------------------- End of SUBIENDO LA FOTO DE PORTADA ------------------- */

/* -------------------------------------------------------------------------- */
/*                               ACTIVAR OFERTA                               */
/* -------------------------------------------------------------------------- */

function activarOferta(evento) {

	if (evento == "oferta") {
		$(".datosOferta").show();
		$(".valorOferta").prop("required",true);
		$(".valorOferta").val("");
	} else {
		$(".datosOferta").hide();
		$(".valorOferta").prop("required",false);
		$(".valorOferta").val("");
	}

}

$(".selActivarOferta").change(function() {activarOferta($(this).val());})

/* -------------------------- End of ACTIVAR OFERTA ------------------------- */

/* -------------------------------------------------------------------------- */
/*                               ACTIVAR OFERTA                               */
/* -------------------------------------------------------------------------- */

function activarOferta(evento) {

	if (evento == "oferta") {
		$(".datosOferta").show();
		$(".valorOferta").prop("required",true);
		$(".valorOferta").val("");
	} else {
		$(".datosOferta").hide();
		$(".valorOferta").prop("required",false);
		$(".valorOferta").val("");
	}

}

$(".selActivarOferta").change(function() {
	activarOferta($(this).val());
})

/* -------------------------- End of ACTIVAR OFERTA ------------------------- */

/* -------------------------------------------------------------------------- */
/*                                VALOR OFERTA                                */
/* -------------------------------------------------------------------------- */

$(".valorOferta").change(function() {

	if ($(this).attr("id") == "precioOferta") {
		$("#precioOferta").prop("readonly",true);
		$("#descuentoOferta").prop("readonly",false);
		$("#descuentoOferta").val(0);
	}

	if ($(this).attr("id") == "descuentoOferta") {
		$("#descuentoOferta").prop("readonly",true);
		$("#precioOferta").prop("readonly",false);
		$("#precioOferta").val(0);
	}

})

/* --------------------------- End of VALOR OFERTA -------------------------- */

/* -------------------------------------------------------------------------- */
/*                              EDITAR CATEGORÍA                              */
/* -------------------------------------------------------------------------- */

$(".tablaCategorias tbody").on("click", ".btnEditarCategoria", function() {

	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url:"ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$("#modalEditarCategoria .editarIdCategoria").val(respuesta["id"]);
			$("#modalEditarCategoria .editarTituloCategoria").val(respuesta["categoria"]);
			$("#modalEditarCategoria .rutaCategoria").val(respuesta["ruta"]);

			/* -------------------------------------------------------------------------- */
			/*                       EDITAR NOMBRE CATEGORÍA Y RUTA                       */
			/* -------------------------------------------------------------------------- */

			$("#modalEditarCategoria .editarTituloCategoria").change(function() {
				$("#modalEditarCategoria .rutaCategoria").val(limpiarUrl($("#modalEditarCategoria .editarTituloCategoria").val()));
			})

			/* ------------------ End of EDITAR NOMBRE CATEGORÍA Y RUTA ----------------- */

			/* -------------------------------------------------------------------------- */
			/*                          TRAEMOS DATOS DE CABECERA                         */
			/* -------------------------------------------------------------------------- */

			var datosCabecera = new FormData();
			datosCabecera.append("ruta", respuesta["ruta"]);

			$.ajax({
				url:"ajax/cabeceras.ajax.php",
				method: "POST",
				data: datosCabecera,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$("#modalEditarCategoria .editarIdCabecera").val(respuesta["id"]);

					/* -------------------------------------------------------------------------- */
					/*                            CARGAMOS DESCRIPCION                            */
					/* -------------------------------------------------------------------------- */

					$("#modalEditarCategoria #descripcionAntiguaCategoria").val(respuesta['descripcion']);

					/* ----------------------- End of CARGAMOS DESCRIPCION ---------------------- */

					/* -------------------------------------------------------------------------- */
					/*                        CARGAMOS LAS PALABRAS CLAVES                        */
					/* -------------------------------------------------------------------------- */

					if (respuesta["palabrasClaves"] != null) {

						$(".editarPalabrasClaves").html(

							'<div class="input-group">'+
								'<label for="pClavesCategoria">Palabras clave</label>'+
								'<input type="text" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsinput" placeholder="Ingresar palabras claves" name="pClavesCategoria" value="'+respuesta["palabrasClaves"]+'" required>'+
							'</div>'

						);

						$("#modalEditarCategoria .pClavesCategoria").tagsinput('items');

						$(".bootstrap-tagsinput").css({"padding":"11px",
																					"width":"100%",
																					"border-radius":"3px"})

					} else {

						$(".editarPalabrasClaves").html(
							'<div class="input-group">'+
								'<label for="pClavesCategoria">Palabras clave</label>'+
								'<input type="text" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsinput" value="" placeholder="Ingresar palabras claves"  name="pClavesCategoria" required>'+
							'</div>'
						);

						$("#modalEditarCategoria .pClavesCategoria").tagsinput('items');

						$(".bootstrap-tagsinput").css({"padding":"11px",
																					"width":"100%",
																					"border-radius":"3px"})

					}

					/* ------------------- End of CARGAMOS LAS PALABRAS CLAVES ------------------ */

					/* -------------------------------------------------------------------------- */
					/*                        CARGAMOS LA IMAGEN DE PORTADA                       */
					/* -------------------------------------------------------------------------- */

					$("#modalEditarCategoria .previsualizarPortada").attr("src", respuesta["portada"]);
					$("#modalEditarCategoria .antiguaFotoPortada").val(respuesta["portada"]);

					/* ------------------ End of CARGAMOS LA IMAGEN DE PORTADA ------------------ */

				}

			})

			/* -------------------- End of TRAEMOS DATOS DE CABECERA -------------------- */

			/* -------------------------------------------------------------------------- */
			/*                         PREGUNTAMOS SI EXITE OFERTA                        */
			/* -------------------------------------------------------------------------- */

			if (respuesta["oferta"] != 0) {

				$("#modalEditarCategoria .selActivarOferta").val("oferta");
				$("#modalEditarCategoria .datosOferta").show();
				$("#modalEditarCategoria .valorOferta").prop("required",true);
				$("#modalEditarCategoria #precioOferta").val(respuesta["precioOferta"]);
				$("#modalEditarCategoria #descuentoOferta").val(respuesta["descuentoOferta"]);

				if (respuesta["precioOferta"] != 0) {
					$("#modalEditarCategoria #precioOferta").prop("readonly",true);
					$("#modalEditarCategoria #descuentoOferta").prop("readonly",false);
				}

				if (respuesta["descuentoOferta"] != 0) {
					$("#modalEditarCategoria #precioOferta").prop("readonly",false);
					$("#modalEditarCategoria #descuentoOferta").prop("readonly",true);
				}

				$("#modalEditarCategoria .finOferta").val(respuesta["finOferta"]);

			} else {

				$("#modalEditarCategoria .selActivarOferta").val("");
				$("#modalEditarCategoria .datosOferta").hide();
				$("#modalEditarCategoria .valorOferta").prop("required",false);

			}

			/* ------------------- End of PREGUNTAMOS SI EXITE OFERTA ------------------- */

			/* -------------------------------------------------------------------------- */
			/*                        CREAR NUEVA OFERTA AL EDITAR                        */
			/* -------------------------------------------------------------------------- */

			$("#modalEditarCategoria .selActivarOferta").change(function() {
				activarOferta($(this).val());
			})

			$("#modalEditarCategoria .valorOferta").change(function() {

				if ($(this).attr("id") == "precioOferta") {
					$("#modalEditarCategoria #precioOferta").prop("readonly",true);
					$("#modalEditarCategoria #descuentoOferta").prop("readonly",false);
					$("#modalEditarCategoria #descuentoOferta").val(0);
				}

				if ($(this).attr("id") == "descuentoOferta") {
					$("#modalEditarCategoria #descuentoOferta").prop("readonly",true);
					$("#modalEditarCategoria #precioOferta").prop("readonly",false);
					$("#modalEditarCategoria #precioOferta").val(0);
				}

			})

			/* ------------------- End of CREAR NUEVA OFERTA AL EDITAR ------------------ */

		}

	})

})

/* ------------------------- End of EDITAR CATEGORÍA ------------------------ */

/* -------------------------------------------------------------------------- */
/*                             ELIMINAR CATEGORIA                             */
/* -------------------------------------------------------------------------- */

$(".tablaCategorias tbody").on("click", ".btnEliminarCategoria", function() {

	var idCategoria = $(this).attr("idCategoria");
	var imgOferta = $(this).attr("imgOferta");
	var rutaCabecera = $(this).attr("rutaCabecera");
	var imgPortada = $(this).attr("imgPortada");

	Swal.fire({
		title: "¿Está seguro de borrar la categoría?",
		text: "Si no lo está puede cancelar la accíón",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, borrar',
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
	}).then((result) => {
		if (result.isConfirmed) {
			window.location = "index.php?ruta=categorias&idCategoria="+idCategoria+"&rutaCabecera="+rutaCabecera+"&imgPortada="+imgPortada;
		}
	})

})

/* ------------------------ End of ELIMINAR CATEGORIA ----------------------- */