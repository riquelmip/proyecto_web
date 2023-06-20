<?php

class Conexion
{

	static public function conectar()
	{

		$link = new PDO(
			"mysql:host=localhost;dbname=armonico_prueba",
			"root",
			""
		);

		// $link = new PDO(
		// 	"mysql:host=localhost;dbname=ELNOMBREDELABDD",
		// 	"ELNOMBREDELUSUARIODELABDD",
		// 	"CONTRASENADELUSUARIDELABDD"
		// );

		$link->exec("set names utf8");

		return $link;
	}
}
