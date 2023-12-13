<?php

require_once 'conexion.php';

class ModeloComercio {

	/* -------------------------------------------------------------------------- */
	/*                            SELECCIONAR PLANTILLA                           */
	/* -------------------------------------------------------------------------- */

	static public function mdlSeleccionarPlantilla($tabla) {
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

  /* ---------------------- End of SELECCIONAR PLANTILLA ---------------------- */

	/* -------------------------------------------------------------------------- */
	/*                           ACTUALIZAR LOGO O ICONO                          */
	/* -------------------------------------------------------------------------- */

	static public function mdlActualizarLogoIcono($tabla, $id, $item, $valor) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}

	/* --------------------- End of ACTUALIZAR LOGO O ICONO --------------------- */

	/* -------------------------------------------------------------------------- */
	/*                              ACTUALIZAR SCRIPT                             */
	/* -------------------------------------------------------------------------- */

	static public function mdlActualizarScript($tabla, $id, $datos) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET apiFacebook = :apiFacebook, frameGoogleMaps = :frameGoogleMaps WHERE id = :id");

		$stmt->bindParam(':apiFacebook', $datos['apiFacebook'], PDO::PARAM_STR);
		$stmt->bindParam(':frameGoogleMaps', $datos['frameMaps'], PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}

		$stmt->close();
		$stmt = null;

	}

	/* ------------------------ End of ACTUALIZAR SCRIPT ------------------------ */

	/* -------------------------------------------------------------------------- */
	/*                            SELECCIONAR COMERCIO                            */
	/* -------------------------------------------------------------------------- */

	static public function mdlSeleccionarComercio($tabla) {
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	/* ----------------------- End of SELECCIONAR COMERCIO ---------------------- */

	/* -------------------------------------------------------------------------- */
	/*                           ACTUALIZAR INFORMACION                           */
	/* -------------------------------------------------------------------------- */

	static public function mdlActualizarInformacion($tabla, $id, $datos) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET divisa = :divisa, impuesto = :impuesto,
		envioNacional = :envioNacional, envioInternacional = :envioInternacional, tasaMinimaNal = :tasaMinimaNal, tasaMinimaInt = :tasaMinimaInt, pais = :pais,
		modoPaypal = :modoPaypal, clienteIdPaypal = :clienteIdPaypal, llaveSecretaPaypal = :llaveSecretaPaypal WHERE id = :id");

		$stmt->bindParam(':divisa', $datos['divisa'], PDO::PARAM_STR);
		$stmt->bindParam(':impuesto', $datos['impuesto'], PDO::PARAM_STR);
		$stmt->bindParam(':envioNacional', $datos['envioNacional'], PDO::PARAM_STR);
		$stmt->bindParam(':envioInternacional', $datos['envioInternacional'], PDO::PARAM_STR);
		$stmt->bindParam(':tasaMinimaNal', $datos['tasaMinimaNal'], PDO::PARAM_STR);
		$stmt->bindParam(':tasaMinimaInt', $datos['tasaMinimaInt'], PDO::PARAM_STR);
		$stmt->bindParam(':pais', $datos['seleccionarPais'], PDO::PARAM_STR);
		$stmt->bindParam(':modoPaypal', $datos['modoPaypal'], PDO::PARAM_STR);
		$stmt->bindParam(':clienteIdPaypal', $datos['clienteIdPaypal'], PDO::PARAM_STR);
		$stmt->bindParam(':llaveSecretaPaypal', $datos['llaveSecretaPaypal'], PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}

		$stmt->close();
		$stmt = null;

	}

	/* ---------------------- End of ACTUALIZAR INFORMACION --------------------- */

	/* -------------------------------------------------------------------------- */
	/*                      TRAER LA INFORMACION DE CONTACTO                      */
	/* -------------------------------------------------------------------------- */

	static public function mdlMostrarInfoContacto($tabla) {
		$stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	/* ----------------- End of TRAER LA INFORMACION DE CONTACTO ---------------- */

	/* -------------------------------------------------------------------------- */
	/*                    ACTUALIZAR LA INFORMACION DE CONTACTO                   */
	/* -------------------------------------------------------------------------- */

	static public function mdlActalizarInfoContacto($tabla, $datos) {
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numeroWhatsapp = :numeroWhatsapp, correo = :correo, direccion = :direccion");
		$stmt->bindParam(':numeroWhatsapp', $datos['numerow'], PDO::PARAM_STR);
		$stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
		$stmt->bindParam(':direccion', $datos['direccion'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}

		$stmt->close();
		$stmt = null;

	}

	/* -------------- End of ACTUALIZAR LA INFORMACION DE CONTACTO -------------- */

}