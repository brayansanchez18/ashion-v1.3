/* -------------------------------------------------------------------------- */
/*                    CARGAR LA TABLA DINÁMICA DE PRODUCTOS                   */
/* -------------------------------------------------------------------------- */

// $.ajax({

// 	url:"ajax/tablaProductos.ajax.php",
// 	success:function(respuesta) {
// 		console.log('%cMyProject%cline:8%crespuesta', 'color:#fff;background:#ee6f57;padding:3px;border-radius:2px', 'color:#fff;background:#1f3c88;padding:3px;border-radius:2px', 'color:#fff;background:rgb(248, 147, 29);padding:3px;border-radius:2px', respuesta)
// 	}

// })

$(".tablaProductos").DataTable({
	"ajax": "ajax/tablaProductos.ajax.php",
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

/* -------------- End of CARGAR LA TABLA DINÁMICA DE PRODUCTOS -------------- */

/* -------------------------------------------------------------------------- */
/*                              ACTIVAR PRODUCTO                              */
/* -------------------------------------------------------------------------- */

$('.tablaProductos tbody').on("click", ".btnActivar", function() {

	var idProducto = $(this).attr("idProducto");
	var estadoProducto = $(this).attr("estadoProducto");

	var datos = new FormData();
	datos.append("activarId", idProducto);
	datos.append("activarProducto", estadoProducto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){}
	})

	if (estadoProducto == 0) {
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoProducto',1);
	} else {
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoProducto',0);
	}

})

/* ------------------------- End of ACTIVAR PRODUCTO ------------------------ */

/* -------------------------------------------------------------------------- */
/*                         EDITOR DE TEXTO ENRIQUZIDO                         */
/* -------------------------------------------------------------------------- */

var quill = new Quill('#descripcionProducto', {
	theme: 'snow'
});

quill.on('text-change', function() {
	var contenido = $('#descripcionProducto .ql-editor').html();
	$("#modalAgregarProducto #descripcionProducto").val(contenido);
});

var quill = new Quill('#descripcionEditarProducto', {
	theme: 'snow'
});

quill.on('text-change', function() {
	var contenido = $('#descripcionEditarProducto .ql-editor').html();
	$("#modalEditarProducto #descripcionEditarProductoIput").val(contenido);
});

/* -------------------- End of EDITOR DE TEXTO ENRIQUZIDO ------------------- */

/* -------------------------------------------------------------------------- */
/*                 REVISAR SI EL TITULO DEL PRODUCTO YA EXISTE                */
/* -------------------------------------------------------------------------- */

$(".validarProducto").change(function() {

	$(".alert").remove();
	var producto = $(this).val();
	var datos = new FormData();
	datos.append("validarProducto", producto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta) {

			if (respuesta.length != 0) {

				$(".validarProducto").parent().after('<div class="alert alert-warning">Este producto ya existe, intente con un nombre diferente</div>');
				$(".validarProducto").val("");

			}

		}

	})

})

/* ----------- End of REVISAR SI EL TITULO DEL PRODUCTO YA EXISTE ----------- */

/* -------------------------------------------------------------------------- */
/*                                RUTA PRODUCTO                               */
/* -------------------------------------------------------------------------- */

function limpiarUrl(texto) {
  var texto = texto.toLowerCase();
  texto = texto.replace(/[á]/, 'a');
  texto = texto.replace(/[é]/, 'e');
  texto = texto.replace(/[í]/, 'i');
  texto = texto.replace(/[ó]/, 'o');
  texto = texto.replace(/[ú]/, 'u');
  texto = texto.replace(/[ñ]/, 'n');
  texto = texto.replace(/ /g, "-")
  return texto;
}

$(".tituloProducto").change(function(){ $(".rutaProducto").val(limpiarUrl($(".tituloProducto").val())); })

/* -------------------------- End of RUTA PRODUCTO -------------------------- */

/* -------------------------------------------------------------------------- */
/*                       AGREGAR MULTIMEDIA CON DROPZONE                      */
/* -------------------------------------------------------------------------- */

var arrayFiles = [];

$(".multimediaFisica").dropzone({
	url: "https://localhost/ashion/backend/",
	addRemoveLinks: true,
	acceptedFiles: "image/jpeg, image/png",
	maxFilesize: 2,
	maxFiles: 10,
	init: function() {

		this.on("addedfile", function(file) { arrayFiles.push(file); })

		this.on("removedfile", function(file) {
			var index = arrayFiles.indexOf(file);
			arrayFiles.splice(index, 1);
		})

	}

})

/* ----------------- End of AGREGAR MULTIMEDIA CON DROPZONE ----------------- */

/* -------------------------------------------------------------------------- */
/*                          SELECCIONAR SUBCATEGORÍA                          */
/* -------------------------------------------------------------------------- */

$(".seleccionarCategoria").change(function() {

	var categoria = $(this).val();
	$(".seleccionarSubCategoria").html("");
	$("#modalEditarProducto .seleccionarSubCategoria").html("");

	var datos = new FormData();
	datos.append("idCategoria", categoria);

	$.ajax({
		url:"ajax/subCategorias.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta) {

			$(".entradaSubcategoria").show();
			respuesta.forEach(funcionForEach);

			function funcionForEach(item, index) {
				$(".seleccionarSubCategoria").append( '<option value="'+item["id"]+'">'+item["subcategoria"]+'</option>' )
			}

		}

	})

})

/* --------------------- End of SELECCIONAR SUBCATEGORÍA -------------------- */

/* -------------------------------------------------------------------------- */
/*                         SUBIENDO LA FOTO DE PORTADA                        */
/* -------------------------------------------------------------------------- */

var imagenPortada = null;

$(".fotoPortada").change(function() {
	imagenPortada = this.files[0];

	/* -------------------------------------------------------------------------- */
	/*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
	/* -------------------------------------------------------------------------- */

	if (imagenPortada["type"] != "image/jpeg" && imagenPortada["type"] != "image/png") {

		$(".fotoPortada").val("");

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
	/*                     VALIDAMOS EL EL TAMAÑO DE LA IMAGEN                    */
	/* -------------------------------------------------------------------------- */

	else if (imagenPortada["size"] > 4000000) {

		$(".fotoPortada").val("");

		Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen no debe pesar más de 4MB",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

	}

	/* --------------- End of VALIDAMOS EL EL TAMAÑO DE LA IMAGEN --------------- */

	/* -------------------------------------------------------------------------- */
	/*                            VISUALIZAR LA IMAGEN                            */
	/* -------------------------------------------------------------------------- */

	else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagenPortada);

		$(datosImagen).on("load", function(event) {
			var rutaImagen = event.target.result;
			$(".previsualizarPortada").attr("src", rutaImagen);
		})

	}

	/* ----------------------- End of VISUALIZAR LA IMAGEN ---------------------- */

})

/* ------------------- End of SUBIENDO LA FOTO DE PORTADA ------------------- */

/* -------------------------------------------------------------------------- */
/*                         SUBIENDO LA FOTO PRINCIPAL                         */
/* -------------------------------------------------------------------------- */

var imagenFotoPrincipal = null;

$(".fotoPrincipal").change(function() {

	imagenFotoPrincipal = this.files[0];

	/* -------------------------------------------------------------------------- */
	/*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
	/* -------------------------------------------------------------------------- */

	if (imagenFotoPrincipal["type"] != "image/jpeg" && imagenFotoPrincipal["type"] != "image/png") {

		$(".fotoPrincipal").val("");

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
	/*                     VALIDAMOS EL EL TAMAÑO DE LA IMAGEN                    */
	/* -------------------------------------------------------------------------- */

	else if (imagenFotoPrincipal["size"] > 4000000) {

		$(".fotoPrincipal").val("");

		Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen no debe pesar más de 4MB",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

	}

	/* --------------- End of VALIDAMOS EL EL TAMAÑO DE LA IMAGEN --------------- */

	/* -------------------------------------------------------------------------- */
	/*                            VISUALIZAR LA IMAGEN                            */
	/* -------------------------------------------------------------------------- */

	else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagenFotoPrincipal);

		$(datosImagen).on("load", function(event) {
			var rutaImagen = event.target.result;
			$(".previsualizarPrincipal").attr("src", rutaImagen);
		})

	}

	/* ----------------------- End of VISUALIZAR LA IMAGEN ---------------------- */

})

/* -------------------- End of SUBIENDO LA FOTO PRINCIPAL ------------------- */

/* -------------------------------------------------------------------------- */
/*                               ACTIVAR OFERTA                               */
/* -------------------------------------------------------------------------- */

function activarOferta(event) {

	if (event == "oferta") {
		$(".datosOferta").show();
		$(".valorOferta").prop("required",true);
		$(".valorOferta").val("");
	} else {
		$(".datosOferta").hide();
		$(".valorOferta").prop("required",false);
		$(".valorOferta").val("");
	}

}


$(".selActivarOferta").change(function() { activarOferta($(this).val()) })

/* -------------------------- End of ACTIVAR OFERTA ------------------------- */

/* -------------------------------------------------------------------------- */
/*                                VALOR OFERTA                                */
/* -------------------------------------------------------------------------- */

$("#modalAgregarProducto .valorOferta").change(function() {

	if ($(".precio").val()!= 0) {

		if ($(this).attr("tipo") == "oferta") {

			var descuento = 100 - (Number($(this).val())*100/Number($(".precio").val()));

			$(".precioOferta").prop("readonly",true);
			$(".descuentoOferta").prop("readonly",false);
			$(".descuentoOferta").val(Math.ceil(descuento));

		}

		if ($(this).attr("tipo") == "descuento") {

			var oferta = Number($(".precio").val())-(Number($(this).val())*Number($(".precio").val())/100);

			$(".descuentoOferta").prop("readonly",true);
			$(".precioOferta").prop("readonly",false);
			$(".precioOferta").val(oferta);

		}

	} else {

		Swal.fire({
      title: "¡Error al agregar la oferta!",
      text: "Primero agregue un precio al producto",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

		$(".precioOferta").val(0);
		$(".descuentoOferta").val(0);
		$(".finOferta").val('');

		return;

	}

})

/* --------------------------- End of VALOR OFERTA -------------------------- */

/* -------------------------------------------------------------------------- */
/*                              CAMBIAR EL PRECIO                             */
/* -------------------------------------------------------------------------- */

$(".precio").change(function() {
	$(".precioOferta").val(0);
	$(".descuentoOferta").val(0);
})

/* ------------------------ End of CAMBIAR EL PRECIO ------------------------ */

/* -------------------------------------------------------------------------- */
/*                             GUARDAR EL PRODUCTO                            */
/* -------------------------------------------------------------------------- */

var multimediaFisica = null;

$(".guardarProducto").click(function() {

	/* -------------------------------------------------------------------------- */
	/*             PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS            */
	/* -------------------------------------------------------------------------- */

	if ($(".tituloProducto").val() != "" &&
			$(".seleccionarCategoria").val() != "" &&
			$(".seleccionarSubCategoria").val() != "" &&
			$("#descripcionProducto").val() != "" &&
			$(".pClavesProducto").val() != "") {

		/* -------------------------------------------------------------------------- */
		/*               PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA               */
		/* -------------------------------------------------------------------------- */

		if ($(".rutaProducto").val() != "") {

			if (arrayFiles.length > 0) {

				var listaMultimedia = [];
				var finalFor = 0;

				for (var i = 0; i < arrayFiles.length; i++) {

					var datosMultimedia = new FormData();
					datosMultimedia.append("file", arrayFiles[i]);
					datosMultimedia.append("ruta", $(".rutaProducto").val());

					$.ajax({
						url:"ajax/productos.ajax.php",
						method: "POST",
						data: datosMultimedia,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function() {

							$(".modal-footer .preload").html(`
								<center>
									<img src="vistas/img/plantilla/status.gif" id="status" />
									<br>
								</center>`);

						}, success: function(respuesta) {

							$("#status").remove();
							listaMultimedia.push({"foto" : respuesta.substr(3)})
							multimediaFisica = JSON.stringify(listaMultimedia);

							if ((finalFor + 1) == arrayFiles.length) {
								agregarMiProducto(multimediaFisica);
								finalFor = 0;
							}

							finalFor++;

						}

					})

				}

			} else {

				Swal.fire({
					title: "¡Llenar todos los campos!",
					text: "El campo multimedia no puede ir vacio",
					icon: "error",
					confirmButtonText: "Cerrar",
					closeOnConfirm: false,
				});

			}

		}

		/* ---------- End of PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA --------- */

	} else {

		Swal.fire({
      title: "¡Llenar todos los campos!",
      text: "Todos los campos son obligatorios",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

	}

	/* ------- End of PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS ------- */

})

function agregarMiProducto(imagen) {

	var tituloProducto = $(".tituloProducto").val();
	var rutaProducto = $(".rutaProducto").val();
	var seleccionarCategoria = $(".seleccionarCategoria").val();
	var seleccionarSubCategoria = $(".seleccionarSubCategoria").val();
	var descripcionProducto = $("#descripcionProducto").val();
	var pClavesProducto = $(".pClavesProducto").val();
	var precio = $(".precio").val();
	var peso = $(".peso").val();
	var entrega = $(".entrega").val();
	var stock = $(".stock").val();
	var selActivarOferta = $(".selActivarOferta").val();
	var precioOferta = $(".precioOferta").val();
	var descuentoOferta = $(".descuentoOferta").val();
	var finOferta = $(".finOferta").val();

	var detalles = {"Talla": $(".detalleTalla").tagsinput('items'),
									"Color": $(".detalleColor").tagsinput('items')};

	var detallesString = JSON.stringify(detalles);

	var datosProducto = new FormData();
	datosProducto.append("tituloProducto", tituloProducto);
	datosProducto.append("rutaProducto", rutaProducto);
	datosProducto.append("detalles", detallesString);
	datosProducto.append("seleccionarCategoria", seleccionarCategoria);
	datosProducto.append("seleccionarSubCategoria", seleccionarSubCategoria);
	datosProducto.append("descripcionProducto", descripcionProducto);
	datosProducto.append("pClavesProducto", pClavesProducto);
	datosProducto.append("precio", precio);
	datosProducto.append("peso", peso);
	datosProducto.append("entrega", entrega);
	datosProducto.append("stock", stock);
	datosProducto.append("multimedia", imagen);
	datosProducto.append("fotoPortada", imagenPortada);
	datosProducto.append("fotoPrincipal", imagenFotoPrincipal);
	datosProducto.append("selActivarOferta", selActivarOferta);
	datosProducto.append("precioOferta", precioOferta);
	datosProducto.append("descuentoOferta", descuentoOferta);
	datosProducto.append("finOferta", finOferta);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datosProducto,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			if (respuesta == "ok") {

				Swal.fire({
					title: "¡GUARDADO!",
					text: "El producto ha sido guardado correctamente",
					icon: "success",
					confirmButtonText: "Cerrar",
					closeOnConfirm: false,
				}).then((isConfirm) => {
					if (isConfirm) {
						window.location = "productos";
					}
				})

			}

		}

	})

}

/* ----------------------- End of GUARDAR EL PRODUCTO ----------------------- */

/* -------------------------------------------------------------------------- */
/*                               EDITAR PRODUCTO                              */
/* -------------------------------------------------------------------------- */

$('.tablaProductos tbody').on("click", ".btnEditarProducto", function() {

	$(".previsualizarImgFisico").html("");

	var idProducto = $(this).attr("idProducto");
	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$("#modalEditarProducto .idProducto").val(respuesta[0]["id"]);
			$("#modalEditarProducto .tituloProducto").val(respuesta[0]["titulo"]);
			$("#modalEditarProducto .rutaProducto").val(respuesta[0]["ruta"]);

			if (respuesta[0]["multimedia"] != "") {

				var imagenesMultimedia = JSON.parse(respuesta[0]["multimedia"]);

				for (var i = 0; i < imagenesMultimedia.length; i++) {

					$(".previsualizarImgFisico").append(
						'<div class="col-md-3">'+
							'<div class="thumbnail text-center">'+
								'<img class="imagenesRestantes" src="'+imagenesMultimedia[i].foto+'" style="width:100%">'+
								'<div class="removerImagen" style="cursor:pointer">Remover</div>'+
							'</div>'+
						'</div>');

					localStorage.setItem("multimediaFisica", JSON.stringify(imagenesMultimedia));

				}

				/* -------------------------------------------------------------------------- */
				/*                  CUANDO ELIMINAMOS UNA IMAGEN DE LA LISTA                  */
				/* -------------------------------------------------------------------------- */

				$(".removerImagen").click(function() {

					$(this).parent().parent().remove();

					var imagenesRestantes = $(".imagenesRestantes");
					var arrayImgRestantes = [];

					for (var i = 0; i < imagenesRestantes.length; i++) {
						arrayImgRestantes.push({"foto":$(imagenesRestantes[i]).attr("src")})
					}

					localStorage.setItem("multimediaFisica", JSON.stringify(arrayImgRestantes));

				})

				/* ------------- End of CUANDO ELIMINAMOS UNA IMAGEN DE LA LISTA ------------ */

			}

			var detalles = JSON.parse(respuesta[0]["detalles"]);

			$(".editarTalla").html(
				'<input class="form-control input-lg tagsInput detalleTalla" value="'+detalles.Talla+'" data-role="tagsinput" type="text" style="padding:20px">'
			)

			$("#modalEditarProducto .detalleTalla").tagsinput('items');

			$(".editarColor").html(
				'<input class="form-control input-lg tagsInput detalleColor" value="'+detalles.Color+'" data-role="tagsinput" type="text" style="padding:20px">'
			)

			$("#modalEditarProducto .detalleColor").tagsinput('items');

			$(".bootstrap-tagsinput").css({"padding":"12px",
																		"width":"110%"})

			/* -------------------------------------------------------------------------- */
			/*                            TRAEMOS LA CATEGORIA                            */
			/* -------------------------------------------------------------------------- */

			if (respuesta[0]["id_categoria"] != 0) {

				var datosCategoria = new FormData();
				datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);

				$.ajax({
					url:"ajax/categorias.ajax.php",
					method: "POST",
					data: datosCategoria,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta) {
						$("#modalEditarProducto .seleccionarCategoria").val(respuesta["id"]);
						$("#modalEditarProducto .optionEditarCategoria").html(respuesta["categoria"]);
					}

				})

			} else {
				$("#modalEditarProducto .optionEditarCategoria").html("SIN CATEGORÍA");
			}

			/* ----------------------- End of TRAEMOS LA CATEGORIA ---------------------- */

			/* -------------------------------------------------------------------------- */
			/*                           TRAEMOS LA SUBCATEGORIA                          */
			/* -------------------------------------------------------------------------- */

			if (respuesta[0]["id_subcategoria"] != 0) {

				var datosSubCategoria = new FormData();
				datosSubCategoria.append("idSubCategoria", respuesta[0]["id_subcategoria"]);

				$.ajax({
					url:"ajax/subcategorias.ajax.php",
					method: "POST",
					data: datosSubCategoria,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta) {

						$("#modalEditarProducto .optionEditarSubCategoria").val(respuesta[0]["id"]);
						$("#modalEditarProducto .optionEditarSubCategoria").html(respuesta[0]["subcategoria"]);

						var datosCategoria = new FormData();
						datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);

						$.ajax({
							url:"ajax/subcategorias.ajax.php",
							method: "POST",
							data: datosCategoria,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "json",
							success: function(respuesta) {

								respuesta.forEach(funcionForEach);

								function funcionForEach(item, index) {
									$("#modalEditarProducto .seleccionarSubCategoria").append(
										'<option value="'+item["id"]+'">'+item["subcategoria"]+'</option>'
									)

								}

							}

						})

					}

				})

			} else {
				$("#modalEditarProducto  .optionEditarSubCategoria").html("SIN SUBCATEGORÍA");
			}

			/* --------------------- End of TRAEMOS LA SUBCATEGORIA --------------------- */

			/* -------------------------------------------------------------------------- */
			/*                          TRAEMOS DATOS DE CABECERA                         */
			/* -------------------------------------------------------------------------- */

			var datosCabecera = new FormData();
			datosCabecera.append("ruta", respuesta[0]["ruta"]);

			$.ajax({
				url:"ajax/cabeceras.ajax.php",
				method: "POST",
				data: datosCabecera,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$("#modalEditarProducto .idCabecera").val(respuesta["id"]);
					$("#modalEditarProducto #antiguaDescripcionProducto").val(respuesta["descripcion"]);

					/* -------------------------------------------------------------------------- */
					/*                        CARGAMOS LAS PALABRAS CLAVES                        */
					/* -------------------------------------------------------------------------- */

					if (respuesta["palabrasClaves"] != null) {

						$("#modalEditarProducto .editarPalabrasClaves").html(
							'<label for="pClavesProducto">Palabras clave del Producto</label>'+
							'<input type="text" class="form-control input-lg tagsInput pClavesProducto" value="'+respuesta["palabrasClaves"]+'" data-role="tagsinput"  placeholder="Ingresar palabras claves"></input>');

						$("#modalEditarProducto .pClavesProducto").tagsinput('items');

					} else {

						$("#modalEditarProducto .editarPalabrasClaves").html(
							'<label for="pClavesProducto">Palabras clave del Producto</label>'+
							'<input type="text" class="form-control input-lg tagsInput pClavesProducto" value="" data-role="tagsinput"  placeholder="Ingresar palabras claves"></input>');

						$("#modalEditarProducto .pClavesProducto").tagsinput('items');

					}

					/* ------------------- End of CARGAMOS LAS PALABRAS CLAVES ------------------ */

					/* -------------------------------------------------------------------------- */
					/*                        CARGAMOS LA IMAGEN DE PORTADA                       */
					/* -------------------------------------------------------------------------- */

					$("#modalEditarProducto .previsualizarPortada").attr("src", respuesta["portada"]);
					$("#modalEditarProducto .antiguaFotoPortada").val(respuesta["portada"]);

					/* ------------------ End of CARGAMOS LA IMAGEN DE PORTADA ------------------ */

				}

			})

			/* -------------------- End of TRAEMOS DATOS DE CABECERA -------------------- */

			/* -------------------------------------------------------------------------- */
			/*                        CARGAMOS LA IMAGEN PRINCIPAL                        */
			/* -------------------------------------------------------------------------- */

			$("#modalEditarProducto .previsualizarPrincipal").attr("src", respuesta[0]["portada"]);
			$("#modalEditarProducto .antiguaFotoPrincipal").val(respuesta[0]["portada"]);

			/* ------------------- End of CARGAMOS LA IMAGEN PRINCIPAL ------------------ */

			/* -------------------------------------------------------------------------- */
			/*              CARGAMOS EL PRECIO, PESO, DIAS DE ENTREGA y STOCK             */
			/* -------------------------------------------------------------------------- */

			$("#modalEditarProducto .precio").val(respuesta[0]["precio"]);
			$("#modalEditarProducto .peso").val(respuesta[0]["peso"]);
			$("#modalEditarProducto .entrega").val(respuesta[0]["entrega"]);
			$("#modalEditarProducto .stock").val(respuesta[0]["stock"]);

			/* -------- End of CARGAMOS EL PRECIO, PESO, DIAS DE ENTREGA y STOCK -------- */

			/* -------------------------------------------------------------------------- */
			/*                         PREGUNTAMOS SI EXITE OFERTA                        */
			/* -------------------------------------------------------------------------- */

			if (respuesta[0]["oferta"] != 0) {

				$("#modalEditarProducto .selActivarOferta").val("oferta");
				$("#modalEditarProducto .datosOferta").show();
				$("#modalEditarProducto .valorOferta").prop("required",true);
				$("#modalEditarProducto .precioOferta").val(respuesta[0]["precioOferta"]);
				$("#modalEditarProducto .descuentoOferta").val(respuesta[0]["descuentoOferta"]);

				if (respuesta[0]["precioOferta"] != 0) {
					$("#modalEditarProducto .precioOferta").prop("readonly",true);
					$("#modalEditarProducto .descuentoOferta").prop("readonly",false);
				}

				if (respuesta[0]["descuentoOferta"] != 0) {
					$("#modalEditarProducto .descuentoOferta").prop("readonly",true);
					$("#modalEditarProducto .precioOferta").prop("readonly",false);
				}

				$("#modalEditarProducto .finOferta").val(respuesta[0]["finOferta"]);

			} else {

				$("#modalEditarProducto .selActivarOferta").val("");
				$("#modalEditarProducto .datosOferta").hide();
				$("#modalEditarProducto .valorOferta").prop("required",false);

			}

			/* ------------------- End of PREGUNTAMOS SI EXITE OFERTA ------------------- */

			/* -------------------------------------------------------------------------- */
			/*                        CREAR NUEVA OFERTA AL EDITAR                        */
			/* -------------------------------------------------------------------------- */

			$("#modalEditarProducto .selActivarOferta").change(function(){ activarOferta($(this).val()) })

			$("#modalEditarProducto .valorOferta").change(function() {

				if ($(this).attr("tipo") == "oferta") {

					var descuento = 100-(Number($(this).val())*100/Number($("#modalEditarProducto .precio").val()));
					$("#modalEditarProducto .precioOferta").prop("readonly",true);
					$("#modalEditarProducto .descuentoOferta").prop("readonly",false);
					$("#modalEditarProducto .descuentoOferta").val(Math.ceil(descuento));

				}

				if ($(this).attr("tipo") == "descuento") {
					var oferta = Number($("#modalEditarProducto .precio").val())-(Number($(this).val())*Number($("#modalEditarProducto .precio").val())/100);
					$("#modalEditarProducto .descuentoOferta").prop("readonly",true);
					$("#modalEditarProducto .precioOferta").prop("readonly",false);
					$("#modalEditarProducto .precioOferta").val(oferta);
				}

			})

			/* ------------------- End of CREAR NUEVA OFERTA AL EDITAR ------------------ */

			/* -------------------------------------------------------------------------- */
			/*                        GUARDAR CAMBIOS DEL PRODUCTO                        */
			/* -------------------------------------------------------------------------- */

			var multimediaFisica = null;

			$(".guardarCambiosProducto").click(function() {

				/* -------------------------------------------------------------------------- */
				/*             PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS            */
				/* -------------------------------------------------------------------------- */

				if ($("#modalEditarProducto .tituloProducto").val() != "" &&
				$("#modalEditarProducto .seleccionarCategoria").val() != "" &&
				$("#modalEditarProducto .seleccionarSubCategoria").val() != "" &&
				$("#modalEditarProducto #antiguaDescripcionProducto").val() != "" &&
				$("#modalEditarProducto .pClavesProducto").val() != "") {

					/* -------------------------------------------------------------------------- */
					/*               PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA               */
					/* -------------------------------------------------------------------------- */

					if (arrayFiles.length > 0 && $("#modalEditarProducto .rutaProducto").val() != "") {

						var listaMultimedia = [];
						var finalFor = 0;

						for (var i = 0; i < arrayFiles.length; i++) {

							var datosMultimedia = new FormData();
							datosMultimedia.append("file", arrayFiles[i]);
							datosMultimedia.append("ruta", $("#modalEditarProducto .rutaProducto").val());

							$.ajax({
								url:"ajax/productos.ajax.php",
								method: "POST",
								data: datosMultimedia,
								cache: false,
								contentType: false,
								processData: false,
								beforeSend: function() {

									$(".modal-footer .preload").html(`
										<center>
											<img src="vistas/img/plantilla/status.gif" id="status" />
											<br>
										</center>`);

								},success: function(respuesta) {

									$("#status").remove();

									listaMultimedia.push({"foto" : respuesta.substr(3)});
									multimediaFisica = JSON.stringify(listaMultimedia);

									if (localStorage.getItem("multimediaFisica") != null) {
										var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));
										var jsonMultimediaFisica = listaMultimedia.concat(jsonLocalStorage);
										multimediaFisica = JSON.stringify(jsonMultimediaFisica);
									}


									if (multimediaFisica == null) {

										Swal.fire({
											title: "¡ERROR!",
											text: "El campo multimedia no puede estar vacio",
											icon: "error",
											confirmButtonText: "Cerrar",
											closeOnConfirm: false,
										})

										return;

									}

									if ((finalFor + 1) == arrayFiles.length) {
										editarMiProducto(multimediaFisica);
										finalFor = 0;
									}

									finalFor++;

								}

							})

						}

					} else {
						var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));
						multimediaFisica = JSON.stringify(jsonLocalStorage);
						editarMiProducto(multimediaFisica);
					}

					/* ---------- End of PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA --------- */

				} else {

					Swal.fire({
						title: "¡ERROR!",
						text: "Llena todos los campos",
						icon: "error",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false,
					})

					return;

				}

				/* ------- End of PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS ------- */

			})

			/* ------------------- End of GUARDAR CAMBIOS DEL PRODUCTO ------------------ */

		}

	})

})

function editarMiProducto(imagen) {

	var idProducto = $("#modalEditarProducto .idProducto").val();
	var tituloProducto = $("#modalEditarProducto .tituloProducto").val();
	var rutaProducto = $("#modalEditarProducto .rutaProducto").val();
	var seleccionarCategoria = $("#modalEditarProducto .seleccionarCategoria").val();
	var seleccionarSubCategoria = $("#modalEditarProducto .seleccionarSubCategoria").val();

	if ($("#modalEditarProducto #descripcionEditarProductoIput").val() == "") {
		var descripcionProducto = $("#modalEditarProducto #antiguaDescripcionProducto").val();
	} else {
		var descripcionProducto = $("#modalEditarProducto #descripcionEditarProductoIput").val();
	}

	var pClavesProducto = $("#modalEditarProducto .pClavesProducto").val();
	var precio = $("#modalEditarProducto .precio").val();
	var stock = $("#modalEditarProducto .stock").val();
	var peso = $("#modalEditarProducto .peso").val();
	var entrega = $("#modalEditarProducto .entrega").val();
	var selActivarOferta = $("#modalEditarProducto .selActivarOferta").val();
	var precioOferta = $("#modalEditarProducto .precioOferta").val();
	var descuentoOferta = $("#modalEditarProducto .descuentoOferta").val();
	var finOferta = $("#modalEditarProducto .finOferta").val();

	var detalles = {"Talla": $("#modalEditarProducto .detalleTalla").tagsinput('items'),
									"Color": $("#modalEditarProducto .detalleColor").tagsinput('items')};

	var detallesString = JSON.stringify(detalles);
	var antiguaFotoPortada = $("#modalEditarProducto .antiguaFotoPortada").val();
	var antiguaFotoPrincipal = $("#modalEditarProducto .antiguaFotoPrincipal").val();
	var idCabecera = $("#modalEditarProducto .idCabecera").val();

	var datosProducto = new FormData();
	datosProducto.append("id", idProducto);
	datosProducto.append("editarProducto", tituloProducto);
	datosProducto.append("rutaProducto", rutaProducto);
	datosProducto.append("detalles", detallesString);
	datosProducto.append("seleccionarCategoria", seleccionarCategoria);
	datosProducto.append("seleccionarSubCategoria", seleccionarSubCategoria);
	datosProducto.append("descripcionProducto", descripcionProducto);
	datosProducto.append("pClavesProducto", pClavesProducto);
	datosProducto.append("precio", precio);
	datosProducto.append("peso", peso);
	datosProducto.append("stock", stock);
	datosProducto.append("entrega", entrega);

	if (imagen == null) {
		multimediaFisica = localStorage.getItem("multimediaFisica");
		datosProducto.append("multimedia", multimediaFisica);
	} else {
		datosProducto.append("multimedia", imagen);
	}

	datosProducto.append("fotoPortada", imagenPortada);
	datosProducto.append("fotoPrincipal", imagenFotoPrincipal);
	datosProducto.append("selActivarOferta", selActivarOferta);
	datosProducto.append("precioOferta", precioOferta);
	datosProducto.append("descuentoOferta", descuentoOferta);
	datosProducto.append("finOferta", finOferta);
	datosProducto.append("antiguaFotoPortada", antiguaFotoPortada);
	datosProducto.append("antiguaFotoPrincipal", antiguaFotoPrincipal);
	datosProducto.append("idCabecera", idCabecera);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datosProducto,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			if (respuesta == "ok") {

				Swal.fire({
					title: "¡EDITADO!",
					text: "El producto ha sido cambiado correctamente",
					icon: "success",
					confirmButtonText: "Cerrar",
					closeOnConfirm: false,
				}).then((isConfirm) => {
					if (isConfirm) {
						localStorage.removeItem("multimediaFisica");
						localStorage.clear();
						window.location = "productos";
					}

				});

				}

			}

	})

}

/* ------------------------- End of EDITAR PRODUCTO ------------------------- */

/*=========================================
=            ELIMINAR PRODUCTO            =
=========================================*/

$('.tablaProductos tbody').on("click", ".btnEliminarProducto", function() {

  var idProducto = $(this).attr("idProducto");
  var imgOferta = $(this).attr("imgOferta");
  var rutaCabecera = $(this).attr("rutaCabecera");
  var imgPortada = $(this).attr("imgPortada");
  var imgPrincipal = $(this).attr("imgPrincipal");

  Swal.fire({
		title: "¿Está seguro de borrar el producto?",
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
      window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imgOferta="+imgOferta+"&rutaCabecera="+rutaCabecera+"&imgPortada="+imgPortada+"&imgPrincipal="+imgPrincipal;
    }
  })

})

/*=====  End of ELIMINAR PRODUCTO  ======*/