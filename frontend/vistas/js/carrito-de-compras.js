/* -------------------------------------------------------------------------- */
/*                 VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS                 */
/* -------------------------------------------------------------------------- */

if (localStorage.getItem("cantidadCesta") != null) {
  $(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
} else {
  $(".cantidadCesta").html("0");
}

/* ------------ End of VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS ----------- */

/* -------------------------------------------------------------------------- */
/*                   VISUALIZAR LOS PRODUCTOS EN EL CARRITO                   */
/* -------------------------------------------------------------------------- */

if (localStorage.getItem("listaProductos") != null) {
  var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

  listaCarrito.forEach(funcionForEach);

  function funcionForEach(item, index) {
    var datosProducto = new FormData();
    var precio = 0;
    datosProducto.append("id", item.idProducto);

    $.ajax({
      url: rutaOculta + "ajax/producto.ajax.php",
      method: "POST",
      data: datosProducto,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        if (respuesta["precioOferta"] == 0) {
          precio = respuesta["precio"];
        } else {
          precio = respuesta["precioOferta"];
        }

        $(".cuerpoCarrito").append(
          "<tr>" +
            '<td class="cart__product__item">' +
            '<img src="' +
            item.imagen +
            '" alt="' +
            item.titulo +
            '" style="width:70px;">' +
            '<div class="cart__product__item__title">' +
            '<h6 class="tituloCarritoCompra">' +
            item.titulo +
            "</h6>" +
            "</div>" +
            "</td>" +
            '<td class="cart__price">$ <span>' +
            precio +
            "</span></td>" +
            '<td class="cart__quantity">' +
            '<div class="pro-qty d-flex">' +
            '<input class="cantidadItem" type="number" min="1" value="' +
            item.cantidad +
            '" precio="' +
            precio +
            '" idProducto="' +
            item.idProducto +
            '" item="' +
            index +
            '">' +
            "</div>" +
            "</td>" +
            '<td class="cart__total subtotal' +
            index +
            ' subTotales">$ <span>' +
            Number(item.cantidad) * Number(precio) +
            "</span></td>" +
            '<td class="cart__close"><span class="icon_close quitarItemCarrito" idProducto="' +
            item.idProducto +
            '" peso="' +
            item.peso +
            '"></span></td>' +
            "</tr>"
        );

        $(".cantidadItem[precio=0]").attr("readonly", "true");

        /* -------------------------------------------------------------------------- */
        /*                             ACTUALIZAR SUBTOTAL                            */
        /* -------------------------------------------------------------------------- */

        var precioCarritoCompra = $(".cuerpoCarrito .cart__price span");
        cestaCarrito(precioCarritoCompra.length);
        sumaSubTotales();

        /* ----------------------- End of ACTUALIZAR SUBTOTAL ----------------------- */
      },
    });
  }
} else {
  $(".cuerpoCarrito").html(
    '<div class="well">Aún no hay productos en el carrito de compras.</div>'
  );
  $(".sumaCarrito").hide();
}

/* -------------- End of VISUALIZAR LOS PRODUCTOS EN EL CARRITO ------------- */

/* -------------------------------------------------------------------------- */
/*                        AGREGAR AL CARRITO DE COMPRAS                       */
/* -------------------------------------------------------------------------- */

$(".agregarCarrito").click(function () {
  var idProducto = $(this).attr("idProducto");
  var imagen = $(this).attr("imagen");
  var titulo = $(this).attr("titulo");
  var precio = $(this).attr("precio");
  var peso = $(this).attr("peso");
  var agregarAlcarrito = false;

  /* -------------------------------------------------------------------------- */
  /*                              CAPTURAR DETALLES                             */
  /* -------------------------------------------------------------------------- */

  var seleccionarDetalle = $(".seleccionarDetalle");

  for (var i = 0; i < seleccionarDetalle.length; i++) {
    if ($(seleccionarDetalle[i]).val() == "") {
      Swal.fire({
        title: "¡Debe seleccionar Talla y Color!",
        text: "",
        icon: "warning",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Seleccionar",
        closeOnConfirm: false,
      });

      return;
    } else {
      titulo = titulo + "-" + $(seleccionarDetalle[i]).val();

      agregarAlcarrito = true;
    }
  }

  /* ------------------------ End of CAPTURAR DETALLES ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*      ALAMACENAR EN EL LOCALSTORAGE LOS PRODUCTOS AGREGADOS AL CARRITO      */
  /* -------------------------------------------------------------------------- */

  if (agregarAlcarrito) {
    /* -------------------------------------------------------------------------- */
    /*                  RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE                 */
    /* -------------------------------------------------------------------------- */

    if (localStorage.getItem("listaProductos") == null) {
      listaCarrito = [];
    } else {
      var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

      for (var i = 0; i < listaProductos.length; i++) {
        if (
          listaProductos[i]["idProducto"] == idProducto &&
          listaProductos[i]["precio"] == 0
        ) {
          Swal.fire({
            title: "El producto ya está agregado al carrito de compras",
            text: "",
            icon: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "¡Volver",
            closeOnConfirm: false,
          });

          return;
        }
      }

      listaCarrito.concat(localStorage.getItem("listaProductos"));
    }

    /* ------------ End of RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE ------------ */

    listaCarrito.push({
      idProducto: idProducto,
      imagen: imagen,
      titulo: titulo,
      precio: precio,
      peso: peso,
      cantidad: "1",
    });

    localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

    /* -------------------------------------------------------------------------- */
    /*                              ACTUALIZAR CESTA                              */
    /* -------------------------------------------------------------------------- */

    var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
    $(".cantidadCesta").html(cantidadCesta);
    localStorage.setItem("cantidadCesta", cantidadCesta);

    /* ------------------------- End fo ACTUALIZAR CESTA ------------------------ */

    /* -------------------------------------------------------------------------- */
    /*                  ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO                 */
    /* -------------------------------------------------------------------------- */

    Swal.fire({
      title: "AGREGADO",
      text: "El producto se ha agregado al carrito de compras",
      icon: "success",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "Continuar comprando",
      confirmButtonText: "Ir al carrito de compras",
      closeOnConfirm: false,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        window.location = rutaOculta + "carrito-de-compras";
      }
    });

    /* ------------ End of ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO ------------ */
  }

  /* -End of ALAMACENAR EN EL LOCALSTORAGE LOS PRODUCTOS AGREGADOS AL CARRITO- */
});

/* ------------------ Enf of AGREGAR AL CARRITO DE COMPRAS ------------------ */

/* -------------------------------------------------------------------------- */
/*                   QUITAR PRODUCTOS DE CARRITO DE COMPRAS                   */
/* -------------------------------------------------------------------------- */

$(document).on("click", ".quitarItemCarrito", function () {
  $(this).parent().parent().remove();

  var idProducto = $(".quitarItemCarrito");
  var imagen = $(".cuerpoCarrito .cart__product__item img");
  var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
  var precio = $(".cuerpoCarrito .cart__price span");
  var cantidad = $(".cuerpoCarrito .cantidadItem");

  /* -------------------------------------------------------------------------- */
  /*     SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)    */
  /* -------------------------------------------------------------------------- */

  listaCarrito = [];

  if (idProducto.length != 0) {
    for (var i = 0; i < idProducto.length; i++) {
      var idProductoArray = $(idProducto[i]).attr("idProducto");
      var imagenArray = $(imagen[i]).attr("src");
      var tituloArray = $(titulo[i]).html();
      var precioArray = $(precio[i]).html();
      var pesoArray = $(idProducto[i]).attr("peso");
      var cantidadArray = $(cantidad[i]).val();

      listaCarrito.push({
        idProducto: idProductoArray,
        imagen: imagenArray,
        titulo: tituloArray,
        precio: precioArray,
        peso: pesoArray,
        cantidad: cantidadArray,
      });
    }

    localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

    sumaSubTotales();
    cestaCarrito(listaCarrito.length);
  } else {
    /* -------------------------------------------------------------------------- */
    /*               SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO               */
    /* -------------------------------------------------------------------------- */

    localStorage.removeItem("listaProductos");
    localStorage.setItem("cantidadCesta", "0");

    $(".cantidadCesta").html("0");

    $(".cuerpoCarrito").html(
      '<div class="well">Aún no hay productos en el carrito de compras.</div>'
    );
    $(".sumaCarrito").hide();

    /* ---------- End of SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO --------- */
  }

  /* ----- End of SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO... ----- */
});

/* -------------- End of QUITAR PRODUCTOS DE CARRITO DE COMPRAS ------------- */

/* -------------------------------------------------------------------------- */
/*                GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD                */
/* -------------------------------------------------------------------------- */

$(document).on("change", ".cantidadItem", function () {
  var cantidad = $(this).val();
  var precio = $(this).attr("precio");
  var idProducto = $(this).attr("idProducto");
  var item = $(this).attr("item");

  $(".subtotal" + item).html("$ <span>" + cantidad * precio + "</span>");

  /* -------------------------------------------------------------------------- */
  /*                  ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE                 */
  /* -------------------------------------------------------------------------- */

  var idProducto = $(".quitarItemCarrito");
  var imagen = $(".cuerpoCarrito .cart__product__item img");
  var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
  var precio = $(".cuerpoCarrito .cart__price span");
  var cantidad = $(".cuerpoCarrito .cantidadItem");

  listaCarrito = [];

  for (var i = 0; i < idProducto.length; i++) {
    var idProductoArray = $(idProducto[i]).attr("idProducto");
    var imagenArray = $(imagen[i]).attr("src");
    var tituloArray = $(titulo[i]).html();
    var precioArray = $(precio[i]).html();
    var pesoArray = $(idProducto[i]).attr("peso");
    var cantidadArray = $(cantidad[i]).val();

    listaCarrito.push({
      idProducto: idProductoArray,
      imagen: imagenArray,
      titulo: tituloArray,
      precio: precioArray,
      peso: pesoArray,
      cantidad: cantidadArray,
    });
  }

  localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));
  sumaSubTotales();
  cestaCarrito(listaCarrito.length);

  /* ------------ End of ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE ------------ */
});

/* ----------- End of GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD ---------- */

/* -------------------------------------------------------------------------- */
/*                        SUMA DE TODOS LOS SUBTOTALES                        */
/* -------------------------------------------------------------------------- */

function sumaSubTotales() {
  var subtotales = $(".subTotales span");
  var arraySumaSubtotales = [];

  for (var i = 0; i < subtotales.length; i++) {
    var subtotalesArray = $(subtotales[i]).html();
    arraySumaSubtotales.push(Number(subtotalesArray));
  }

  function sumaArraySubtotales(total, numero) {
    return total + numero;
  }

  var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);

  $(".sumaSubTotal").html(
    "Total <span>" +
      $("#divisa").val() +
      ' $<span class="spanprecio">' +
      sumaTotal.toFixed(2) +
      "</span></span>"
  );
}

/* ------------------- End of SUMA DE TODOS LOS SUBTOTALES ------------------ */

/* -------------------------------------------------------------------------- */
/*                    ACTUALIZAR CESTA AL CAMBIAR CANTIDAD                    */
/* -------------------------------------------------------------------------- */

function cestaCarrito(cantidadProductos) {
  /*======================================================
	=            SI HAY PRODUCTOS EN EL CARRITO            =
	======================================================*/

  if (cantidadProductos != 0) {
    var cantidadItem = $(".cuerpoCarrito .cantidadItem");

    var arraySumaCantidades = [];

    for (var i = 0; i < cantidadItem.length; i++) {
      var cantidadItemArray = $(cantidadItem[i]).val();
      arraySumaCantidades.push(Number(cantidadItemArray));
    }

    function sumaArrayCantidades(total, numero) {
      return total + numero;
    }

    var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);

    $(".cantidadCesta").html(sumaTotalCantidades);
    localStorage.setItem("cantidadCesta", sumaTotalCantidades);
  }

  /*=====  End of SI HAY PRODUCTOS EN EL CARRITO  ======*/
}

/* --------------- End of ACTUALIZAR CESTA AL CAMBIAR CANTIDAD -------------- */

/* -------------------------------------------------------------------------- */
/*                                  CHECKOUT                                  */
/* -------------------------------------------------------------------------- */

$("#btnCheckout").click(function () {
  $(".listaProductos table.tablaProductos tbody").html("");

  var idUsuario = $(this).attr("idUsuario");
  var peso = $(".cuerpoCarrito .cart__close span");
  var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
  var cantidad = $(".cuerpoCarrito .cantidadItem");
  var subtotal = $(".cuerpoCarrito .subTotales span");
  var cantidadPeso = [];

  /* -------------------------------------------------------------------------- */
  /*                                SUMA SUBTOTAL                               */
  /* -------------------------------------------------------------------------- */

  var sumaSubTotal = $(".sumaSubTotal span.spanprecio");
  $(".valorSubtotal").html($(sumaSubTotal).html());
  $(".valorSubtotal").attr("valor", $(sumaSubTotal).html());

  /* -------------------------- End of SUMA SUBTOTAL -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              TASAS DE IMPUESTO                             */
  /* -------------------------------------------------------------------------- */

  var impuestoTotal =
    ($(".valorSubtotal").html() * $("#tasaImpuesto").val()) / 100;

  $(".valorTotalImpuesto").html(impuestoTotal.toFixed(2));
  $(".valorTotalImpuesto").attr("valor", impuestoTotal.toFixed(2));

  sumaTotalCompra();

  /* ------------------------ End of TASAS DE IMPUESTO ------------------------ */

  for (var i = 0; i < titulo.length; i++) {
    var pesoArray = $(peso[i]).attr("peso");
    var tituloArray = $(titulo[i]).html();
    var cantidadArray = $(cantidad[i]).val();
    var subtotalArray = $(subtotal[i]).html();

    /* -------------------------------------------------------------------------- */
    /*            EVALUAR EL PESO DE ACUERDO A LA CANTIDAD DE PRODUCTOS           */
    /* -------------------------------------------------------------------------- */

    cantidadPeso[i] = pesoArray * cantidadArray;

    function sumaArrayPeso(total, numero) {
      return total + numero;
    }

    var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);

    /* ------ End of EVALUAR EL PESO DE ACUERDO A LA CANTIDAD DE PRODUCTOS ------ */

    /* -------------------------------------------------------------------------- */
    /*                   MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR                  */
    /* -------------------------------------------------------------------------- */

    $(".listaProductos table.tablaProductos tbody").append(
      "<tr>" +
        '<td class="valorTitulo">' +
        tituloArray +
        "</td>" +
        '<td class="valorCantidad">' +
        cantidadArray +
        "</td>" +
        '<td>$<span class="valorItem" valor="' +
        subtotalArray +
        '">' +
        subtotalArray +
        "</span></td>" +
        "<tr>"
    );

    /* ------------- End of MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR ------------- */
  }

  /* -------------------------------------------------------------------------- */
  /*                        SELECCIONAR EL PAIS DE ENVIO                        */
  /* -------------------------------------------------------------------------- */

  $(".seleccionePais").html(
    '<select class="form-control" id="seleccionarPais" required>' +
      '<option value="">Seleccione Pais</option>' +
      "</select>"
  );

  $.ajax({
    url: rutaOculta + "vistas/js/plugins/countries.json",
    type: "GET",
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      respuesta.forEach(seleccionarPais);

      function seleccionarPais(item, index) {
        var pais = item.name;
        var codPais = item.code;

        $("#seleccionarPais").append(
          '<option value="' + codPais + '">' + pais + "</option>"
        );
      }
    },
  });

  /* ------------------- End of SELECCIONAR EL PAIS DE ENVIO ------------------ */

  /* -------------------------------------------------------------------------- */
  /*                           EVALUAR TASAS DE ENVÍO                           */
  /* -------------------------------------------------------------------------- */

  $("#seleccionarPais").change(function () {
    $(".alertapais").remove();

    var pais = $(this).val();
    var tasaPais = $("#pais").val();

    if (pais == tasaPais) {
      var resultadoPeso = sumaTotalPeso * $("#envioNacional").val();

      if (resultadoPeso < $("#tasaMinimaNal").val()) {
        $(".valorTotalEnvio").html($("#tasaMinimaNal").val());
        $(".valorTotalEnvio").attr("valor", $("#tasaMinimaNal").val());
      } else {
        $(".valorTotalEnvio").html(resultadoPeso);
        $(".valorTotalEnvio").attr("valor", resultadoPeso);
      }
    } else {
      var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val();

      if (resultadoPeso < $("#tasaMinimaInt").val()) {
        $(".valorTotalEnvio").html($("#tasaMinimaInt").val());
        $(".valorTotalEnvio").attr("valor", $("#tasaMinimaInt").val());
      } else {
        $(".valorTotalEnvio").html(resultadoPeso);
        $(".valorTotalEnvio").attr("valor", resultadoPeso);
      }
    }

    sumaTotalCompra();
  });

  /* ---------------------- End of EVALUAR TASAS DE ENVÍO --------------------- */
});

/* ----------------------------- End of CHECKOUT ---------------------------- */

/* -------------------------------------------------------------------------- */
/*                           SUMA TOTAL DE LA COMPRA                          */
/* -------------------------------------------------------------------------- */

function sumaTotalCompra() {
  var sumaTotalTasas =
    Number($(".valorSubtotal").html()) +
    Number($(".valorTotalEnvio").html()) +
    Number($(".valorTotalImpuesto").html());

  $(".valorTotalCompra").html(sumaTotalTasas.toFixed(2));
  $(".valorTotalCompra").attr("valor", sumaTotalTasas.toFixed(2));

  localStorage.setItem("total", hex_md5($(".valorTotalCompra").html()));
}

/* --------------------- End of SUMA TOTAL DE LA COMPRA --------------------- */

/* -------------------------------------------------------------------------- */
/*                             BOTON PAGAR PAYPAL                             */
/* -------------------------------------------------------------------------- */

$(".btnPagar").click(function () {
  if ($("#seleccionarPais").val() == "") {
    $(".btnPagar").after(
      '<div class="alert alert-warning alertapais">No ha seleccionado el pais para el envío</div>'
    );

    return;
  }

  var divisa = $("#divisa").val();
  var total = $(".valorTotalCompra").html();
  var totalEncriptado = localStorage.getItem("total");
  var impuesto = $(".valorTotalImpuesto").html();
  var envio = $(".valorTotalEnvio").html();
  var subtotal = $(".valorSubtotal").html();
  var titulo = $(".valorTitulo");
  var cantidad = $(".valorCantidad");
  var valorItem = $(".valorItem");
  var idProducto = $(".quitarItemCarrito");

  var tituloArray = [];
  var cantidadArray = [];
  var valorItemArray = [];
  var idProductoArray = [];

  for (var i = 0; i < titulo.length; i++) {
    tituloArray[i] = $(titulo[i]).html();
    cantidadArray[i] = $(cantidad[i]).html();
    valorItemArray[i] = $(valorItem[i]).html();
    idProductoArray[i] = $(idProducto[i]).attr("idProducto");
  }

  var datos = new FormData();

  datos.append("divisa", divisa);
  datos.append("total", total);
  datos.append("totalEncriptado", totalEncriptado);
  datos.append("impuesto", impuesto);
  datos.append("envio", envio);
  datos.append("subtotal", subtotal);
  datos.append("tituloArray", tituloArray);
  datos.append("cantidadArray", cantidadArray);
  datos.append("valorItemArray", valorItemArray);
  datos.append("idProductoArray", idProductoArray);

  $.ajax({
    url: rutaOculta + "ajax/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log("respuesta", respuesta);

      window.location = respuesta;
    },
  });
});

/* ------------------------ End of BOTON PAGAR PAYPAL ----------------------- */

/* -------------------------------------------------------------------------- */
/*                VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO                */
/* -------------------------------------------------------------------------- */

$(".agregarFisicosGratis").click(function () {
  var idProducto = $(this).attr("idProducto");
  var idUsuario = $(this).attr("idUsuario");

  var datos = new FormData();

  datos.append("idUsuario", idUsuario);
  datos.append("idProducto", idProducto);

  $.ajax({
    url: rutaOculta + "ajax/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta != "false") {
        Swal.fire({
          title: "¡Usted ya adquirió este producto!",
          text: "",
          icon: "warning",
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Volver",
          closeOnConfirm: false,
        });
      }
    },
  });
});

/* ----------- End of VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO ---------- */
