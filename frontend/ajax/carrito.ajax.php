<?php

require_once '../extensiones/paypal/paypal.controlador.php';

require_once '../controladores/carrito.controlador.php';
require_once '../modelos/carrito.modelo.php';

require_once '../controladores/productos.controlador.php';
require_once '../modelos/productos.modelo.php';

class AjaxCarrito {

  /* -------------------------------------------------------------------------- */
  /*                                METODO PAYAPL                               */
  /* -------------------------------------------------------------------------- */

  public $divisa;
	public $total;
	public $totalEncriptado;
	public $impuesto;
	public $envio;
	public $subtotal;
	public $tituloArray;
	public $cantidadArray;
	public $valorItemArray;
	public $idProductoArray;

  public function ajaxEnviarPaypal() {

    if (md5($this->total) == $this->totalEncriptado) {

      $datos = array(
        "divisa"=>$this->divisa,
        "total"=>$this->total,
        "impuesto"=>$this->impuesto,
        "envio"=>$this->envio,
        "subtotal"=>$this->subtotal,
        "tituloArray"=>$this->tituloArray,
        "cantidadArray"=>$this->cantidadArray,
        "valorItemArray"=>$this->valorItemArray,
        "idProductoArray"=>$this->idProductoArray,
      );

      $respuesta = Paypal::mdlPagoPaypal($datos);

      echo $respuesta;

    }

  }

  /* -------------------------- End of METODO PAYAPL -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO                */
  /* -------------------------------------------------------------------------- */

  public $idUsuario;
	public $idProducto;

	public function ajaxVerificarProducto() {

		$datos = array('idUsuario'=>$this->idUsuario,
                    'idProducto'=>$this->idProducto);
		$respuesta = ControladorCarrito::ctrVerificarProducto($datos);
		echo json_encode($respuesta);

	}

  /* ----------- End of VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO ---------- */

}

/* -------------------------------------------------------------------------- */
/*                                METODO PAYPAL                               */
/* -------------------------------------------------------------------------- */

if (isset($_POST['divisa'])) {

  $idProductos = explode(',' , $_POST['idProductoArray']);
  $cantidadProductos = explode(',' , $_POST['cantidadArray']);
  $precioProductos = explode(',' , $_POST['valorItemArray']);

  $item = "id";

  for ($i = 0; $i < count($idProductos); $i ++) {

    $valor = $idProductos[$i];
    $verificarProductos = ControladorProductos::ctrMostrarInfoproducto($item, $valor);

    if ($verificarProductos["precioOferta"] == 0) {
      $precio = number_format($verificarProductos['precio'], 2);
    } else {
      $precio = number_format($verificarProductos['precioOferta'], 2);
    }

    $verificarSubTotal = $cantidadProductos[$i]*$precio;

    if ($verificarSubTotal != $precioProductos[$i]) {
      echo "carrito-de-compras";
      return;
    }

	}

  $paypal = new AjaxCarrito();
	$paypal -> divisa = $_POST['divisa'];
	$paypal -> total = $_POST['total'];
	$paypal -> totalEncriptado = $_POST["totalEncriptado"];
	$paypal -> impuesto = $_POST['impuesto'];
	$paypal -> envio = $_POST['envio'];
	$paypal -> subtotal = $_POST['subtotal'];
	$paypal -> tituloArray = $_POST['tituloArray'];
	$paypal -> cantidadArray = $_POST['cantidadArray'];
	$paypal -> valorItemArray = $_POST['valorItemArray'];
	$paypal -> idProductoArray = $_POST['idProductoArray'];

	$paypal -> ajaxEnviarPaypal();

}

/* -------------------------- End of METODO PAYPAL -------------------------- */

/* -------------------------------------------------------------------------- */
/*                VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO                */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idUsuario'])) {
	$deseo = new AjaxCarrito();
	$deseo -> idUsuario = $_POST['idUsuario'];
	$deseo -> idProducto = $_POST['idProducto'];
	$deseo ->ajaxVerificarProducto();
}

/* ----------- End of VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO ---------- */