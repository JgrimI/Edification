<?php

/**
 * Clase que realiza la conexión a la base de datos
 */
class Conexion
{

	/**
	 * Conecta con la base de datos
	 * @return Object $conexion Devuelve un objeto para conectar con la base de datos en caso de éxito y false en caso de error
	 */
	public function conectarBD()
	{
		$server = "127.0.0.1";
		$user = "root";
		$pass = "";


		$bd = "prueba";
		$port = "3306";
		$conexion = new mysqli($server, $user, $pass, $bd, $port)
			or die("Ha sucedido un error inesperado en la conexion de la base de datos");

		return $conexion;
	}

	/**
	 * Cierra la conexión a la base de datos
	 * @param  Object $conexion Conexión a la base de datos
	 * @return boolean $cerrar Devuelve true en caso de éxito y false en caso de error
	 */
	public function desconectarBD($conexion)
	{

		$cerrar = mysqli_close($conexion)
			or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

		return $cerrar;
	}
}
