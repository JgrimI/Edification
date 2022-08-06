<?php

/**
 * Archivo de conexión a la base de datos
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';

/**
 * Archivo de entidad
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Profesor.php';

/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los profesores
 */
class ProfesorDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $conexion;

	/**
	 * Objeto de la clase profesorDAO
	 * @var [profesorDAO]
	 */
	private static $profesorDAO;


	/**
	 * Constructor de la clase
	 */

	private function __construct($conexion)
	{
		$this->conexion = $conexion;
		mysqli_set_charset($this->conexion, "utf8");
	}


	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del profesor a consultar]
	 * @return [profesor]         profesor encontrado
	 */
	public function consultar($codigo)
	{
		$sentencia = "SELECT * FROM profesor WHERE id_profesor = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("i", $codigo);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $nombre, $apellido, $correo, $contrasena, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		$profesor = false;

		while ($stmt->fetch()) {
			$profesor = new Profesor();
			$profesor->setId($id);
			$profesor->setNombre($nombre);
			$profesor->setApellido($apellido);
			$profesor->setEmail($correo);
			$profesor->setContrasena($contrasena);
			$profesor->setFechaCreacion($fecha_creacion);
			$profesor->setFechaActualizacion($fecha_actualizacion);
			$profesor->setEstado($estado);
		}
		$stmt->close();
		return $profesor;
	}


	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [profesor]         profesor encontrado
	 */
	public function consultarEmail($email)
	{
		$sentencia = "SELECT * FROM profesor WHERE correo_profesor = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("s", $email);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $nombre, $apellido, $correo, $contrasena, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		$profesor = false;

		while ($stmt->fetch()) {
			$profesor = new Profesor();
			$profesor->setId($id);
			$profesor->setNombre($nombre);
			$profesor->setApellido($apellido);
			$profesor->setEmail($correo);
			$profesor->setContrasena($contrasena);
			$profesor->setFechaCreacion($fecha_creacion);
			$profesor->setFechaActualizacion($fecha_actualizacion);
			$profesor->setEstado($estado);
		}
		$stmt->close();
		return $profesor;
	}


	/**
	 * Crea una nuevo profesor en la base de datos
	 * @param  profesor $profesorNuevo
	 * @return void
	 */
	public function crear($profesorNuevo)
	{
		$profesorNuevo->setContrasena(password_hash($profesorNuevo->getContrasena(), PASSWORD_BCRYPT));


		$sentencia = "INSERT INTO `profesor` (`nombre_profesor`, `apellido_profesor`, `correo_profesor`, `contrasena_profesor`, `fecha_creacion_profesor`, `fecha_actualizacion_profesor`, `estado_profesor`) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$nombre = $profesorNuevo->getNombre();
		$apellido = $profesorNuevo->getApellido();
		$email = $profesorNuevo->getEmail();
		$contrasena = $profesorNuevo->getContrasena();
		$estado = $profesorNuevo->getEstado();
		$dateC = $profesorNuevo->getFechaCreacion();
		$dateA = $profesorNuevo->getFechaActualizacion();
		$stmt->bind_param("sssssss", $nombre, $apellido, $email, $contrasena, $dateC, $dateA, $estado);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Modifica una profesor ingresado por parámetro
	 * @param  profesor $profesor profesor ingresado por parámetro
	 * @return void
	 */
	public function modificar($profesor, $contrasena = false)
	{
		if ($contrasena) $profesor->setContrasena(password_hash($profesor->getContrasena(), PASSWORD_BCRYPT));

		$date = date('Y-m-d H:i:s');

		$sentencia = " UPDATE `profesor` SET `nombre_profesor`=?, `apellido_profesor`=?, `correo_profesor`=?, `contrasena_profesor`=?, `fecha_actualizacion_profesor`=?, `estado_profesor`=? WHERE `id_profesor`=?;";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$nombre = $profesor->getNombre();
		$apellido = $profesor->getApellido();
		$email = $profesor->getEmail();
		$contrasena = $profesor->getContrasena();
		$estado = $profesor->getEstado();
		$id = $profesor->getId();
		$stmt->bind_param("ssssssi", $nombre, $apellido, $email, $contrasena, $date, $estado, $id);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Lista todos los objetos que se están en la tabla de profesor
	 * @return [profesores]
	 */
	public function listarTodo()
	{
		$profesors = array();

		$sentencia = "SELECT * FROM  `profesor`;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->execute();

		$stmt->bind_result($id, $nombre, $apellido, $correo, $contrasena, $fecha_creacion, $fecha_actualizacion, $estado);

		while ($stmt->fetch()) {
			$profesor = new Profesor();
			$profesor->setId($id);
			$profesor->setNombre($nombre);
			$profesor->setApellido($apellido);
			$profesor->setEmail($correo);
			$profesor->setContrasena($contrasena);
			$profesor->setFechaCreacion($fecha_creacion);
			$profesor->setFechaActualizacion($fecha_actualizacion);
			$profesor->setEstado($estado);

			array_push($profesors, $profesor);
		}
		$stmt->close();

		return $profesors;
	}

	/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function obtenerprofesorDAO($conexion_bd)
	{
		if (self::$profesorDAO == null) {
			self::$profesorDAO = new profesorDAO($conexion_bd);
		}

		return self::$profesorDAO;
	}
}
