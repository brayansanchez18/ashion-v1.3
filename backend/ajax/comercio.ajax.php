<?php

require_once '../controladores/comercio.controlador.php';
require_once '../modelos/comercio.modelo.php';

class AjaxComercio {

  /* -------------------------------------------------------------------------- */
  /*                              CAMBIAR LOGOTIPO                              */
  /* -------------------------------------------------------------------------- */

  public $imagenLogo;

	public function ajaxCambiarLogotipo() {
		$item = 'logo';
		$valor = $this->imagenLogo;
		$respuesta = ControladorComercio::ctrActualizarLogoIcono($item, $valor);
		echo $respuesta;
	}

  /* ------------------------- End of CAMBIAR LOGOTIPO ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                                CAMBIAR ICONO                               */
  /* -------------------------------------------------------------------------- */

  public $imagenIcono;

	public function ajaxCambiarIcono() {
		$item = 'icono';
		$valor = $this->imagenIcono;
		$respuesta = ControladorComercio::ctrActualizarLogoIcono($item, $valor);
		echo $respuesta;
	}

  /* -------------------------- End of CAMBIAR ICONO -------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                           CAMBIAR REDES SOCIALES                           */
	/* -------------------------------------------------------------------------- */

	public $redesSociales;

	public function ajaxCambiarRedes() {
		$item = 'redesSociales';
		$valor = $this->redesSociales;
		$respuesta = ControladorComercio::ctrActualizarLogoIcono($item, $valor);
		echo $respuesta;
	}

	/* ---------------------- End of CAMBIAR REDES SOCIALES --------------------- */

	/* -------------------------------------------------------------------------- */
	/*                               CAMBIAR SCRIPT                               */
	/* -------------------------------------------------------------------------- */

	public $apiFacebook;
	public $frameMaps;

	public function ajaxCambiarScript() {

	$datos = array('apiFacebook'=>$this->apiFacebook,
								'frameMaps'=>$this->frameMaps);

		$respuesta = ControladorComercio::ctrActualizarScript($datos);

		echo $respuesta;

	}

	/* -------------------------- End of CAMBIAR SCRIPT ------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                             CAMBIAR INFORMACIÓN                            */
	/* -------------------------------------------------------------------------- */

	public $divisa;
	public $impuesto;
	public $envioNacional;
	public $envioInternacional;
	public $tasaMinimaNal;
	public $tasaMinimaInt;
	public $seleccionarPais;
	public $modoPaypal;
	public $clienteIdPaypal;
	public $llaveSecretaPaypal;

	public function ajaxCambiarInformacion() {

		$datos = array('divisa'=>$this->divisa,
						'impuesto'=>$this->impuesto,
						'envioNacional'=>$this->envioNacional,
						'envioInternacional'=>$this->envioInternacional,
						'tasaMinimaNal'=>$this->tasaMinimaNal,
						'tasaMinimaInt'=>$this->tasaMinimaInt,
						'seleccionarPais'=>$this->seleccionarPais,
						'modoPaypal'=>$this->modoPaypal,
						'clienteIdPaypal'=>$this->clienteIdPaypal,
						'llaveSecretaPaypal'=>$this->llaveSecretaPaypal);

		$respuesta = ControladorComercio::ctrActualizarInformacion($datos);

		echo $respuesta;

	}


	/* ----------------------- End of CAMBIAR INFORMACIÓN ----------------------- */

	/* -------------------------------------------------------------------------- */
	/*                        CAMBIAR INFORMACIÓN CONTACTO                        */
	/* -------------------------------------------------------------------------- */

	public $numerow;
	public $correo;
	public $direccion;

	public function ajaxActualizarContacto() {

		$datos = array('numerow'=>$this->numerow,
										'correo'=>$this->correo,
										'direccion'=>$this->direccion);

		$respuesta = ControladorComercio::ctrActalizarInfoContacto($datos);
		echo $respuesta;

	}

	/* ------------------- End of CAMBIAR INFORMACIÓN CONTACTO ------------------ */

}

/* -------------------------------------------------------------------------- */
/*                              CAMBIAR LOGOTIPO                              */
/* -------------------------------------------------------------------------- */

if (isset($_FILES['imagenLogo'])) {
	$logotipo = new AjaxComercio();
	$logotipo -> imagenLogo = $_FILES['imagenLogo'];
	$logotipo -> ajaxCambiarLogotipo();
}

/* ------------------------- End of CAMBIAR LOGOTIPO ------------------------ */

/* -------------------------------------------------------------------------- */
/*                                CAMBIAR ICONO                               */
/* -------------------------------------------------------------------------- */

if (isset($_FILES['imagenIcono'])) {
	$icono = new AjaxComercio();
	$icono -> imagenIcono = $_FILES['imagenIcono'];
	$icono -> ajaxCambiarIcono();
}

/* -------------------------- End of CAMBIAR ICONO -------------------------- */

/* -------------------------------------------------------------------------- */
/*                           CAMBIAR REDES SOCIALES                           */
/* -------------------------------------------------------------------------- */

if (isset($_POST["redesSociales"])) {
	$redesSociales = new AjaxComercio();
	$redesSociales -> redesSociales = $_POST["redesSociales"];
	$redesSociales -> ajaxCambiarRedes();
}

/* ---------------------- End of CAMBIAR REDES SOCIALES --------------------- */

/* -------------------------------------------------------------------------- */
/*                               CAMBIAR SCRIPT                               */
/* -------------------------------------------------------------------------- */

if (isset($_POST['apiFacebook'])) {
	$script = new AjaxComercio();
	$script -> apiFacebook = $_POST['apiFacebook'];
	$script -> frameMaps = $_POST['frameMaps'];
	$script -> ajaxCambiarScript();
}

/* -------------------------- End of CAMBIAR SCRIPT ------------------------- */

/* -------------------------------------------------------------------------- */
/*                             CAMBIAR INFORMACION                            */
/* -------------------------------------------------------------------------- */

if (isset($_POST['divisa'])) {
	$informacion = new AjaxComercio();
	$informacion -> divisa = $_POST['divisa'];
	$informacion -> impuesto = $_POST['impuesto'];
	$informacion -> envioNacional = $_POST['envioNacional'];
	$informacion -> envioInternacional = $_POST['envioInternacional'];
	$informacion -> tasaMinimaNal = $_POST['tasaMinimaNal'];
	$informacion -> tasaMinimaInt = $_POST['tasaMinimaInt'];
	$informacion -> seleccionarPais = $_POST['seleccionarPais'];
	$informacion -> modoPaypal = $_POST['modoPaypal'];
	$informacion -> clienteIdPaypal = $_POST['clienteIdPaypal'];
	$informacion -> llaveSecretaPaypal = $_POST['llaveSecretaPaypal'];
	$informacion -> ajaxCambiarInformacion();
}


/* ----------------------- End of CAMBIAR INFORMACION ----------------------- */

/* -------------------------------------------------------------------------- */
/*                        CAMBIAR INFORMACIÓN CONTACTO                        */
/* -------------------------------------------------------------------------- */

if (isset($_POST['numerow'])) {
	$actualizarFooter = new AjaxComercio();
	$actualizarFooter -> numerow = $_POST['numerow'];
	$actualizarFooter -> correo = $_POST['correo'];
	$actualizarFooter -> direccion = $_POST['direccion'];
	$actualizarFooter -> ajaxActualizarContacto();
}

/* ------------------- End of CAMBIAR INFORMACIÓN CONTACTO ------------------ */