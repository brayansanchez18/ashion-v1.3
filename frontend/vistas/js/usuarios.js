/* -------------------------------------------------------------------------- */
/*                               CAPTURA DE RUTA                              */
/* -------------------------------------------------------------------------- */

var rutaActual = location.href;

$(".btnIngreso").click(function () {
  localStorage.setItem("rutaActual", rutaActual);
});

$("#btnCheckoutIngreso").click(function () {
  localStorage.setItem("rutaActual", rutaActual);
});

$(".agregarGratis").click(function () {
  localStorage.setItem("rutaActual", rutaActual);
});

/* ------------------------- End of CAPTURA DE RUTA ------------------------- */

/* -------------------------------------------------------------------------- */
/*                             FORMATEAR LOS IPUNT                            */
/* -------------------------------------------------------------------------- */

$("input").focus(function () {
  $(".alert").remove();
});

/* ----------------------- End of FORMATEAR LOS IPUNT ----------------------- */

/* -------------------------------------------------------------------------- */
/*                           VALIDAR EMAIL REPETIDO                           */
/* -------------------------------------------------------------------------- */

var validarEmailRepetido = false;

$("#regEmail").change(function () {
  var email = $("#regEmail").val();

  var datos = new FormData();
  datos.append("validarEmail", email);

  $.ajax({
    url: rutaOculta + "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == "false") {
        $(".alert").remove();
        validarEmailRepetido = false;
      } else {
        var modo = JSON.parse(respuesta).modo;

        if (modo == "directo") {
          modo = "esta página";
        }

        $("#regEmail")
          .parent()
          .before(
            '<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, fue registrado a través de ' +
              modo +
              ", por favor ingrese otro diferente</div>"
          );

        validarEmailRepetido = true;
      }
    },
  });
});

/* ---------------------- End of VALIDAR EMAIL REPETIDO --------------------- */

/* -------------------------------------------------------------------------- */
/*                       VALIDAR EL REGISTRO DE USUARIO                       */
/* -------------------------------------------------------------------------- */
function registroUsuario() {
  /* -------------------------------------------------------------------------- */
  /*                       VALIDAR POLÍTICAS DE PRIVACIDAD                      */
  /* -------------------------------------------------------------------------- */

  var politicas = $("#regPoliticas:checked").val();

  if (politicas != "on") {
    $("#regPoliticas")
      .parent()
      .before(
        '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>'
      );

    return false;
  }

  /* ----------------- End of VALIDAR POLÍTICAS DE PRIVACIDAD ----------------- */

  /* -------------------------------------------------------------------------- */
  /*                              VALIDAR EL NOMBRE                             */
  /* -------------------------------------------------------------------------- */

  var nombre = $("#regUsuario").val();

  if (nombre != "") {
    var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

    if (!expresion.test(nombre)) {
      $("#regUsuario")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>'
        );

      return false;
    }
  } else {
    $("#regUsuario")
      .parent()
      .before(
        '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>'
      );

    return false;
  }

  /* ------------------------ End of VALIDAR EL NOMBRE ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                              VALIDAR EL EMAIL                              */
  /* -------------------------------------------------------------------------- */

  var email = $("#regEmail").val();

  if (email != "") {
    var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    if (!expresion.test(email)) {
      $("#regEmail")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>'
        );

      return false;
    }

    if (validarEmailRepetido) {
      $("#regEmail")
        .parent()
        .before(
          '<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>'
        );

      return false;
    }
  } else {
    $("#regEmail")
      .parent()
      .before(
        '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>'
      );

    return false;
  }

  /* ------------------------- End of VALIDAR EL EMAIL ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                             VALIDAR CONTRASEÑA                             */
  /* -------------------------------------------------------------------------- */

  var password = $("#regPassword").val();

  if (password != "") {
    var expresion = /^[a-zA-Z0-9]*$/;

    if (!expresion.test(password)) {
      $("#regPassword")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>'
        );

      return false;
    }
  } else {
    $("#regPassword")
      .parent()
      .before(
        '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>'
      );

    return false;
  }

  /* ------------------------ End of VALIDAR CONTRASEÑA ----------------------- */

  return true;
}

/* ------------------ End of VALIDAR EL REGISTRO DE USUARIO ----------------- */

/* -------------------------------------------------------------------------- */
/*                                CAMBIAR FOTO                                */
/* -------------------------------------------------------------------------- */

$("#btnCambiarFoto").click(function () {
  $("#imgPerfil").toggle();
  $("#subirImagen").toggle();
});

$("#datosImagen").change(function () {
  var imagen = this.files[0];

  /*=========================================================
    =            VALIDAMOS EL FORMATO DE LA IMAGEN            =
    =========================================================*/

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $("#datosImagen").val("");

    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen debe estar en formato JPG o PNG",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    }).then((isConfirm) => {
      if (isConfirm) {
        window.location = rutaOculta + "perfil";
      }
    });
  } else if (Number(imagen["size"]) > 5000000) {
    $("#datosImagen").val("");

    Swal.fire({
      title: "¡Error al subir la imagen!",
      text: "La imagen no debe pesar más de 5 MB",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    }).then((isConfirm) => {
      if (isConfirm) {
        window.location = rutaOculta + "perfil";
      }
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    });
  }

  /*=====  End of VALIDAMOS EL FORMATO DE LA IMAGEN  ======*/
});

/* --------------------------- End of CAMBIAR FOTO -------------------------- */

/* -------------------------------------------------------------------------- */
/*                               LISTA DE DESEOS                              */
/* -------------------------------------------------------------------------- */

$(".deseos").click(function () {
  var idProducto = $(this).attr("idProducto");
  var idUsuario = localStorage.getItem("usuario");

  if (idUsuario == null) {
    Swal.fire({
      title: "¡Debe ingresar al sistema!",
      text: "Para agregar un producto a la 'lista de deseos' debe primero ingresar al sistema",
      icon: "warning",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    }).then((isConfirm) => {
      if (isConfirm) {
        //window.location = rutaOculta;
      }
    });
  } else {
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("idProducto", idProducto);

    $.ajax({
      url: rutaOculta + "ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        if (respuesta == "existe") {
          Swal.fire({
            title: "¡PRODUCTO DUPLICADO!",
            text: "Este producto ya se encuentra registrado en la lista de deseos",
            icon: "warning",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              //window.location = rutaOculta;
            }
          });
        } else if (respuesta == "ok") {
          Swal.fire({
            title: "¡AGREGADO!",
            text: "El producto se ha agregado a la lista de deseos",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              //window.location = rutaOculta;
            }
          });
        }
      },
    });
  }
});

/* ------------------------- End of LISTA DE DESEOS ------------------------- */

/* -------------------------------------------------------------------------- */
/*                    BORRAR PRODUCTO DE LA LISTA DE DESEOS                   */
/* -------------------------------------------------------------------------- */

$(".quitarDeseo").click(function () {
  var idDeseo = $(this).attr("idDeseo");

  $(this).parent().parent().parent().parent().parent().remove();

  var datos = new FormData();
  datos.append("idDeseo", idDeseo);

  $.ajax({
    url: rutaOculta + "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {},
  });
});

/* -------------- End of BORRAR PRODUCTO DE LA LISTA DE DESEOS -------------- */

/* -------------------------------------------------------------------------- */
/*                              ELIMINAR USUARIO                              */
/* -------------------------------------------------------------------------- */

$("#eliminarUsuario").click(function () {
  var id = $("#idUsuario").val();

  if ($("#modoUsuario").val() == "directo") {
    if ($("#fotoUsuario").val() != "") {
      var foto = $("#fotoUsuario").val();
    }
  }

  Swal.fire({
    title: "¿Está usted seguro(a) de eliminar su cuenta?",
    text: "Si borrar esta cuenta ya no se puede recuperar los datos",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Si, borrar cuenta!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=perfil&id=" + id + "&foto=" + foto;
    }
  });
});

/* ------------------------- End of ELIMINAR USUARIO ------------------------ */

/* -------------------------------------------------------------------------- */
/*                      VALIDAR EL FORMULARIO DE CONTACTO                     */
/* -------------------------------------------------------------------------- */

function validarContactenos() {
  var nombre = $("#nombreContactenos").val();
  var email = $("#emailContactenos").val();
  var mensaje = $("#mensajeContactenos").val();

  /* -------------------------------------------------------------------------- */
  /*                            VALIDACIÓN DEL NOMBRE                           */
  /* -------------------------------------------------------------------------- */

  if (nombre == "") {
    $("#nombreContactenos").before(
      '<h6 class="alert alert-danger">Escriba por favor el nombre</h6>'
    );

    return false;
  } else {
    var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

    if (!expresion.test(nombre)) {
      $("#nombreContactenos").before(
        '<h6 class="alert alert-danger">Escriba por favor sólo letras, sin caracteres especiales</h6>'
      );

      return false;
    }
  }

  /* ---------------------- End of VALIDACIÓN DEL NOMBRE ---------------------- */

  /* -------------------------------------------------------------------------- */
  /*                            VALIDACIÓN DEL EMAIL                            */
  /* -------------------------------------------------------------------------- */

  if (email == "") {
    $("#emailContactenos").before(
      '<h6 class="alert alert-danger">Escriba por favor el email</h6>'
    );

    return false;
  } else {
    var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    if (!expresion.test(email)) {
      $("#emailContactenos").before(
        '<h6 class="alert alert-danger">Escriba por favor correctamente el correo electrónico</h6>'
      );

      return false;
    }
  }

  /* ----------------------- End of VALIDACIÓN DEL EMAIL ---------------------- */

  /* -------------------------------------------------------------------------- */
  /*                           VALIDACIÓN DEL MENSAJE                           */
  /* -------------------------------------------------------------------------- */

  if (mensaje == "") {
    $("#mensajeContactenos").before(
      '<h6 class="alert alert-danger">Escriba por favor un mensaje</h6>'
    );

    return false;
  } else {
    var expresion = /^[,\r\n \\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

    if (!expresion.test(mensaje)) {
      $("#mensajeContactenos").before(
        '<h6 class="alert alert-danger">Escriba el mensaje sin caracteres especiales</h6>'
      );

      return false;
    }
  }

  /* ---------------------- End of VALIDACIÓN DEL MENSAJE --------------------- */

  return true;
}

/* ---------------- End of VALIDAR EL FORMULARIO DE CONTACTO ---------------- */
