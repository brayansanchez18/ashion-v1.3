/* -------------------------------------------------------------------------- */
/*                             CONTADOR DE VISTAS                             */
/* -------------------------------------------------------------------------- */

var rutaOculta = $("#rutaOculta").val();
var contador = 0;

$(window).on("load", function () {
  var vistas = $("span.vistas").html();
  var precio = $("span.vistas").attr("tipo");

  contador = Number(vistas) + 1;

  $("span.vistas").html(contador);

  // EVALUAMOS EL PRECIO PARA DEFINIR CAMPO A ACTUALIZAR

  if (precio == 0) {
    var item = "vistasGratis";
  } else {
    var item = "vistas";
  }

  // EVALUAMOS LA RUTA PARA DEFINIR EL PRODUCTO A ACTUALIZAR

  var urlActual = location.pathname;
  var ruta = urlActual.split("/");

  var datos = new FormData();

  datos.append("valor", contador);
  datos.append("item", item);
  datos.append("ruta", ruta.pop());

  $.ajax({
    url: rutaOculta + "ajax/producto.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {},
  });
});

/* ------------------------ End of CONTADOR DE VISTAS ----------------------- */
