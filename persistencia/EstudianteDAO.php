<?php

/**
 * Archivo de conexión a la base de datos
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';

/**
 * Archivo de entidad
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Estudiante.php';

/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los estudiantes
 */
class EstudianteDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $conexion;

	/**
	 * Objeto de la clase estudianteDAO
	 * @var [estudianteDAO]
	 */
	private static $estudianteDAO;


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
	 * @param  [int] $codigo [Código del estudiante a consultar]
	 * @return [estudiante] estudiante encontrado
	 */
	public function consultar($codigo)
	{
		$sentencia = "SELECT * FROM `estudiante` WHERE id_estudiante = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("i", $codigo);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $nombre, $apellido, $correo, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		while ($stmt->fetch()) {
			$estudiante = new Estudiante();
			$estudiante->setId($id);
			$estudiante->setNombre($nombre);
			$estudiante->setApellido($apellido);
			$estudiante->setEmail($correo);
			$estudiante->setFechaCreacion($fecha_creacion);
			$estudiante->setFechaActualizacion($fecha_actualizacion);
			$estudiante->setEstado($estado);
		}
		$stmt->close();
		return $estudiante;
	}


	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [estudiante]         estudiante encontrado
	 */
	public function consultarEmail($email)
	{
		$sentencia = "SELECT * FROM `estudiante` WHERE correo_estudiante = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("s", $email);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $nombre, $apellido, $correo, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		while ($stmt->fetch()) {
			$estudiante = new Estudiante();
			$estudiante->setId($id);
			$estudiante->setNombre($nombre);
			$estudiante->setApellido($apellido);
			$estudiante->setEmail($correo);
			$estudiante->setFechaCreacion($fecha_creacion);
			$estudiante->setFechaActualizacion($fecha_actualizacion);
			$estudiante->setEstado($estado);
		}
		$stmt->close();
		return $estudiante;
	}


	/**
	 * Crea una nuevo estudiante en la base de datos
	 * @param  estudiante $estudianteNuevo
	 * @return void
	 */
	public function crear($estudianteNuevo)
	{
		$sentencia = "INSERT INTO `estudiante` (`nombre_estudiante`, `apellido_estudiante`,`correo_estudiante`, `fecha_creacion_estudiante`, `fecha_actualizacion_estudiante`, `estado_estudiante`) VALUES (?,?,?,?,?,?);";

		$stmt = $this->conexion->prepare($sentencia);

		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}

		$nombre = $estudianteNuevo->getNombre();
		$apellido = $estudianteNuevo->getApellido();
		$email = $estudianteNuevo->getEmail();
		$estado = $estudianteNuevo->getEstado();
		$dateC = $estudianteNuevo->getFechaCreacion();
		$dateA = $estudianteNuevo->getFechaActualizacion();
		$stmt->bind_param("ssssss", $nombre, $apellido, $email, $dateC, $dateA, $estado);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Modifica una estudiante ingresado por parámetro
	 * @param  estudiante $estudiante estudiante ingresado por parámetro
	 * @return void
	 */
	public function modificar($estudiante, $contrasena = false)
	{
		if ($contrasena) $estudiante->setContrasena(password_hash($estudiante->getContrasena(), PASSWORD_BCRYPT));

		$date = date('Y-m-d H:i:s');

		$sentencia = " UPDATE `estudiante` SET `nombre_estudiante`=?, `apellido_estudiante`=?, `correo_estudiante`=?, `fecha_actualizacion_estudiante`=?, `estado_estudiante`=? WHERE `id_estudiante`=?;";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$nombre = $estudiante->getNombre();
		$apellido = $estudiante->getApellido();
		$email = $estudiante->getEmail();
		$estado = $estudiante->getEstado();
		$id = $estudiante->getId();
		$stmt->bind_param("sssssi", $nombre, $apellido, $email, $date, $estado, $id);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Lista todos los objetos que se están en la tabla de estudiante
	 * @return [estudiantes]
	 */
	public function listarTodo()
	{
		$estudiantes = array();

		$sentencia = "SELECT * FROM  `estudiante`;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->execute();

		$stmt->bind_result($id, $nombre, $apellido, $correo, $fecha_creacion, $fecha_actualizacion, $estado);

		while ($stmt->fetch()) {
			$estudiante = new Estudiante();
			$estudiante->setId($id);
			$estudiante->setNombre($nombre);
			$estudiante->setApellido($apellido);
			$estudiante->setEmail($correo);
			$estudiante->setFechaCreacion($fecha_creacion);
			$estudiante->setFechaActualizacion($fecha_actualizacion);
			$estudiante->setEstado($estado);

			array_push($estudiantes, $estudiante);
		}
		$stmt->close();

		return $estudiantes;
	}

	/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function obtenerestudianteDAO($conexion_bd)
	{
		if (self::$estudianteDAO == null) {
			self::$estudianteDAO = new estudianteDAO($conexion_bd);
		}

		return self::$estudianteDAO;
	}
}
