<?php

require_once "conexion.php";

class ModeloClientes
{

	/*=============================================
	MOSTRAR PAISES
	=============================================*/

	static public function mdlMostrarPaises($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}


	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT c.id, c.nombre_cliente, c.email_contacto, c.id_pais, p.nombre as pais FROM $tabla c INNER JOIN paises p ON p.id = c.id_pais");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}

	static public function mdlMostrarCliente($tabla, $valor)
	{



		$stmt = Conexion::conectar()->prepare("SELECT c.id, c.nombre_cliente, c.email_contacto, c.id_pais, p.nombre as pais FROM $tabla c INNER JOIN paises p ON p.id = c.id_pais WHERE c.id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
		


		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	REGISTRO DE CLIENTES
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_cliente, email_contacto, id_pais) VALUES (:nombre_cliente, :email_contacto, :id_pais)");

		$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":email_contacto", $datos["email_contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_pais", $datos["id_pais"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	EDITAR CLIENTES
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_cliente = :nombre_cliente, email_contacto = :email_contacto, id_pais = :id_pais WHERE id = :id");

		$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":email_contacto", $datos["email_contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_pais", $datos["id_pais"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}


	/*=============================================
	BORRAR CLIENTE
	=============================================*/

	static public function mdlBorrarCliente($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
