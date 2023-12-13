/* -------------------------------------------------------------------------- */
/*                               SUBIR LOGOTIPO                               */
/* -------------------------------------------------------------------------- */

$("#subirLogo").change(function() {

  var imagenLogo = this.files[0];

  /* -------------------------------------------------------------------------- */
  /*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
  /* -------------------------------------------------------------------------- */

  if (imagenLogo["type"] != "image/jpeg" && imagenLogo["type"] != "image/png") {

    $("#subirLogo").val("");

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

  else if (imagenLogo["size"] > 10000000) {

    $("#subirLogo").val("");

    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen no debe pesar más de 10MB",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

  }

  /* ----------------- End of VALIDAMOS EL TAMAÑO DE LA IMAGEN ---------------- */

  /* -------------------------------------------------------------------------- */
  /*                          PREVISUALIZAMOS LA IMAGEN                         */
  /* -------------------------------------------------------------------------- */

  else {

    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagenLogo);

    $(datosImagen).on("load", function(event){
      var rutaImagen = event.target.result;
      $(".previsualizarLogo").attr("src", rutaImagen);
    })

  }

  /* -------------------- End of PREVISUALIZAMOS LA IMAGEN -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             GUARDAR EL LOGOTIPO                            */
  /* -------------------------------------------------------------------------- */

  $("#guardarLogo").click(function() {

    var datos = new FormData();
    datos.append("imagenLogo", imagenLogo);

    $.ajax({
      url:"ajax/comercio.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta) {
        if (respuesta == "ok") {
          Swal.fire({
            title: "¡Cambios guardados!",
            text: "La plantilla ha sido actualizada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = 'comercio';
            }
          });
        }
      }
    })

  })

  /* ----------------------- End of GUARDAR EL LOGOTIPO ----------------------- */

})

/* -------------------------- End of SUBIR LOGOTIPO ------------------------- */

/* -------------------------------------------------------------------------- */
/*                                 SUBIR ICONO                                */
/* -------------------------------------------------------------------------- */

$("#subirIcono").change(function() {
  var imagenIcono = this.files[0];

  /* -------------------------------------------------------------------------- */
  /*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
  /* -------------------------------------------------------------------------- */

  if (imagenIcono["type"] != "image/jpeg" && imagenIcono["type"] != "image/png") {

    $("#subirIcono").val("");

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

  else if(imagenIcono["size"] > 10000000) {

    $("#subirLogo").val("");

    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen no debe pesar más de 10MB",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

  }

  /* ----------------- End of VALIDAMOS EL TAMAÑO DE LA IMAGEN ---------------- */

  /* -------------------------------------------------------------------------- */
  /*                          PREVISUALIZAMOS LA IMAGEN                         */
  /* -------------------------------------------------------------------------- */

  else {

    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagenIcono);

    $(datosImagen).on("load", function(event) {
      var rutaImagen = event.target.result;
      $(".previsualizarIcono").attr("src", rutaImagen);
    })

  }

  /* -------------------- End of PREVISUALIZAMOS LA IMAGEN -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              GUARDAR EL ICONO                              */
  /* -------------------------------------------------------------------------- */

  $("#guardarIcono").click(function() {

    var datos = new FormData();
		datos.append("imagenIcono", imagenIcono);

    $.ajax({

			url:"ajax/comercio.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
        if (respuesta == "ok") {
          Swal.fire({
            title: "¡Cambios guardados!",
            text: "La plantilla ha sido actualizada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = 'comercio';
            }
          });
        }
			}
		});

  })

  /* ------------------------- End of GUARDAR EL ICONO ------------------------ */

})

/* --------------------------- End of SUBIR ICONO --------------------------- */

/* -------------------------------------------------------------------------- */
/*                         CAMBIAR URL REDES SOCIALES                         */
/* -------------------------------------------------------------------------- */

var checkBox = $(".seleccionarRed");

$(".cambiarUrlRed").change(function() {
	var cambiarUrlRed = $(".cambiarUrlRed");

	for (var i = 0; i < cambiarUrlRed.length; i++) {
		$(checkBox[i]).attr("ruta", $(cambiarUrlRed[i]).val());
	}

	crearDatosJsonRedes();

})

/* -------------------- End of CAMBIAR URL REDES SOCIALES ------------------- */

/* -------------------------------------------------------------------------- */
/*                              QUITAR RED SOCIAL                             */
/* -------------------------------------------------------------------------- */

$(".seleccionarRed").on("ifUnchecked",function() {
	$(this).attr("validarRed","");
	crearDatosJsonRedes();
})

/* ------------------------ End of QUITAR RED SOCIAL ------------------------ */

/* -------------------------------------------------------------------------- */
/*                             AGREGAR RED SOCIAL                             */
/* -------------------------------------------------------------------------- */

$(".seleccionarRed").on("ifChecked",function() {
	$(this).attr("validarRed", $(this).attr("red"));
	crearDatosJsonRedes();
})

/* ------------------------ End of AGREGAR RED SOCIAL ----------------------- */

/* -------------------------------------------------------------------------- */
/*                    CREAR DATOS JSON PARA ALMACENAR EN BD                   */
/* -------------------------------------------------------------------------- */

function crearDatosJsonRedes() {

  var redesSociales = [];

  for (var i = 0; i < checkBox.length; i++) {

    if ($(checkBox[i]).attr("validarRed") != "") {

      redesSociales.push({"red": $(checkBox[i]).attr("red"),
                          "url": $(checkBox[i]).attr("ruta"),
                          "activo": 1})


    } else {

      redesSociales.push({"red": $(checkBox[i]).attr("red"),
                          "url": $(checkBox[i]).attr("ruta"),
                          "activo": 0})

    }

    $("#valorRedesSociales").val(JSON.stringify(redesSociales));

  }

}

/* -------------- End of CREAR DATOS JSON PARA ALMACENAR EN BD -------------- */

/* -------------------------------------------------------------------------- */
/*                           GUARDAR REDES SOCIALES                           */
/* -------------------------------------------------------------------------- */

$("#guardarRedesSociales").click(function(){

  var valorRedesSociales = $("#valorRedesSociales").val();

  var datos = new FormData();
  datos.append("redesSociales", valorRedesSociales);

  $.ajax({

    url:"ajax/comercio.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){
      if (respuesta == "ok") {
          Swal.fire({
            title: "¡Cambios guardados!",
            text: "La plantilla ha sido actualizada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = 'comercio';
            }
          });
        }
    }

  })

})

/* ---------------------- End of GUARDAR REDES SOCIALES --------------------- */

/* -------------------------------------------------------------------------- */
/*                               CAMBIAR CÓDIGOS                              */
/* -------------------------------------------------------------------------- */

$(".cambioScript").change(function() {

  var apiFacebook = $("#apiFacebook").val();
  var frameMaps = $("#frameMaps").val();

  $("#guardarScript").click(function() {

    var datos = new FormData();
    datos.append("apiFacebook", apiFacebook);
    datos.append("frameMaps", frameMaps);

    $.ajax({

      url:"ajax/comercio.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta) {

        if (respuesta == "ok") {
          Swal.fire({
            title: "¡Cambios guardados!",
            text: "La plantilla ha sido actualizada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = 'comercio';
            }
          });
        }

      }

    })

  })

})

/* ------------------------- End of CAMBIAR CÓDIGOS ------------------------- */

/* -------------------------------------------------------------------------- */
/*                             SELECCIONAR DIVISA                             */
/* -------------------------------------------------------------------------- */

$.ajax({
	url:"vistas/js/divisas.json",
	type: "GET",
	cache: false,
	contentType: false,
	processData:false,
	dataType:"json",
	success: function(respuesta) {

		respuesta.forEach(seleccionarDivisa);

		function seleccionarDivisa(item, index) {

			var divisa = item.name;
			var coddivisa = item.code;

			if ($("#coddivisa").val() == coddivisa) {

				$("#divisaSeleccionada").attr("value",coddivisa);
				$("#divisaSeleccionada").html(divisa);

			}

			$("#seleccionarDivisa").append('<option value="'+coddivisa+'">'+divisa+'</option>');

		}

	}

})

/* ------------------------ End of SELECCIONAR DIVISA ----------------------- */

/* -------------------------------------------------------------------------- */
/*                              SELECCIONAR PAIS                              */
/* -------------------------------------------------------------------------- */

$.ajax({
	url:"vistas/js/countries.json",
	type: "GET",
	cache: false,
	contentType: false,
	processData:false,
	dataType:"json",
	success: function(respuesta) {

		respuesta.forEach(seleccionarPais);

		function seleccionarPais(item, index) {

			var pais = item.name;
			var codPais = item.code;

			if ($("#codigoPais").val() == codPais) {

				$("#paisSeleccionado").attr("value",codPais);
				$("#paisSeleccionado").html(pais);

			}

			$("#seleccionarPais").append('<option value="'+codPais+'">'+pais+'</option>');

		}

	}

})

/* ------------------------- End of SELECCIONAR PAIS ------------------------ */

/* -------------------------------------------------------------------------- */
/*                             CAMBIAR INFORMACIÓN                            */
/* -------------------------------------------------------------------------- */

var divisa = $("#coddivisa").val();
var impuesto = $("#impuesto").val();
var envioNacional = $("#envioNacional").val();
var envioInternacional = $("#envioInternacional").val();
var tasaMinimaNal = $("#tasaMinimaNal").val();
var tasaMinimaInt = $("#tasaMinimaInt").val();
var seleccionarPais = $("#codigoPais").val();
var clienteIdPaypal = $("#clienteIdPaypal").val();
var llaveSecretaPaypal = $("#llaveSecretaPaypal").val();

/* ----------------------- End of CAMBIAR INFORMACIÓN ----------------------- */

/* -------------------------------------------------------------------------- */
/*                             CAMBIAR MODO PAYPAL                            */
/* -------------------------------------------------------------------------- */

$("input[name='modoPaypal']").on("ifChecked",function() {

	var modoPaypal = $(this).val();

	$("#guardarInformacion").click(function() {
		cambiarInformacion(modoPaypal);
	});

})

/* ----------------------- End of CAMBIAR MODO PAYPAL ----------------------- */

/* -------------------------------------------------------------------------- */
/*                           GUARDAR LA INFORMACION                           */
/* -------------------------------------------------------------------------- */

$(".cambioInformacion").change(function() {
	divisa = $("#seleccionarDivisa").val();
	impuesto = $("#impuesto").val();
	envioNacional = $("#envioNacional").val();
	envioInternacional = $("#envioInternacional").val();
	tasaMinimaNal = $("#tasaMinimaNal").val();
	tasaMinimaInt = $("#tasaMinimaInt").val();
	seleccionarPais = $("#seleccionarPais").val();
	modoPaypal = $("input[name='modoPaypal']:checked").val();
	clienteIdPaypal = $("#clienteIdPaypal").val();
	llaveSecretaPaypal = $("#llaveSecretaPaypal").val();

	$("#guardarInformacion").click(function() {
		cambiarInformacion(modoPaypal);
	})
})

/* ---------------------- End of GUARDAR LA INFORMACION --------------------- */

/* -------------------------------------------------------------------------- */
/*                     FUNCIÓN PARA CAMBIAR LA INFORMACIÓN                    */
/* -------------------------------------------------------------------------- */

function cambiarInformacion(modoPaypal) {

	var datos = new FormData();
	datos.append("divisa", divisa);
	datos.append("impuesto", impuesto);
	datos.append("envioNacional", envioNacional);
	datos.append("envioInternacional", envioInternacional);
	datos.append("tasaMinimaNal", tasaMinimaNal);
	datos.append("tasaMinimaInt", tasaMinimaInt);
	datos.append("seleccionarPais", seleccionarPais);
	datos.append("modoPaypal", modoPaypal);
	datos.append("clienteIdPaypal", clienteIdPaypal);
	datos.append("llaveSecretaPaypal", llaveSecretaPaypal);

	$.ajax({

		url:"ajax/comercio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

      if (respuesta == "ok") {
        Swal.fire({
          title: "¡Cambios guardados!",
          text: "La plantilla ha sido actualizada correctamente",
          icon: "success",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        }).then((isConfirm) => {
          if (isConfirm) {
            window.location = 'comercio';
          }
        });
      }

		}

	})

}

/* --------------- End of FUNCIÓN PARA CAMBIAR LA INFORMACIÓN --------------- */

/* -------------------------------------------------------------------------- */
/*                        CAMBIAR INFORMACIÓN CONTACTO                        */
/* -------------------------------------------------------------------------- */

$("#guardarInformacionFooter").click(function(){

var numerow = $("#numerow").val();
var correo = $("#correo").val();
var direccion = $("#direccion").val();
var datos = new FormData();
datos.append("numerow", numerow);
datos.append("correo", correo);
datos.append("direccion", direccion);

$.ajax({

		url:"ajax/comercio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
      if (respuesta == "ok") {
        Swal.fire({
          title: "¡Cambios guardados!",
          text: "La plantilla ha sido actualizada correctamente",
          icon: "success",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        }).then((isConfirm) => {
          if (isConfirm) {
            window.location = 'comercio';
          }
        });
      }

		}

	})

})

/* ------------------- End of CAMBIAR INFORMACIÓN CONTACTO ------------------ */