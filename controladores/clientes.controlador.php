<?php

class ControladorClientes
{

	static public  function alertaError($msg)
	{
		return
			'<script>

				swal({

					type: "error",
					title: \'' . $msg .
			'\',
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "clientes";

					}

				});


			</script>';
	}

	static public function ctrMostrarPaises()
	{

		$tabla = "paises";

		$respuesta = ModeloClientes::MdlMostrarPaises($tabla);

		return $respuesta;
	}

	/*=============================================
	REGISTRO DE CLIENTE
	=============================================*/

	static public function ctrCrearCliente()
	{

		if (isset($_POST["nuevoNombre"]) && isset($_POST["nuevoEmail"]) && isset($_POST["nuevoPais"])) {
			if (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])) {
				echo self::alertaError('Revise el campo de nombre');
			} else if (!filter_var($_POST["nuevoEmail"], FILTER_VALIDATE_EMAIL)) {
				echo self::alertaError('El campo email debe ser un email');
			} else if (intval($_POST["nuevoPais"]) == 0) {
				echo self::alertaError('Debe seleccionar un pais');
			} else {
				
				$tabla = "clientes";

				$datos = array(
					"nombre_cliente" => $_POST["nuevoNombre"],
					"email_contacto" => $_POST["nuevoEmail"],
					"id_pais" => $_POST["nuevoPais"]
				);

				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({

						type: "success",
						title: "¡El cliente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

					</script>';
				}
			}
		}
	}

	/*=============================================
	MOSTRAR CLIENTE
	=============================================*/

	static public function ctrMostrarClientes()
	{

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla);

		return $respuesta;
	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente()
	{

		if (isset($_POST["editarNombre"]) && isset($_POST["editarEmail"]) && isset($_POST["editarPais"])) {
			if (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {
				echo self::alertaError('Revise el campo de nombre');
			} else if (!filter_var($_POST["editarEmail"], FILTER_VALIDATE_EMAIL)) {
				echo self::alertaError('El campo email debe ser un email');
			} else if (intval($_POST["editarPais"]) == 0) {
				echo self::alertaError('Debe seleccionar un pais');
			} else {

				$tabla = "clientes";

				$datos = array(
					'id' => $_POST["idCliente"],
					"nombre_cliente" => $_POST["editarNombre"],
					"email_contacto" => $_POST["editarEmail"],
					"id_pais" => $_POST["editarPais"]
				);

				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				if ($respuesta == "ok") {

					echo
					'<script>

					swal({

						type: "success",
						title: "¡El cliente ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

					</script>';
				}
			}
		}

	}

	/*=============================================
	BORRAR CLIENTE
	=============================================*/

	static public function ctrBorrarCliente()
	{

		if (isset($_GET["idCliente"])) {

			$tabla = "clientes";
			$datos = $_GET["idCliente"];


			$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR CLIENTE
	=============================================*/

	static public function ctrMostrarCliente($valor)
	{

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarCliente($tabla, $valor);

		return $respuesta;
	}
}
