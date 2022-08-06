<?php

/**
 * Archivo de conexión a la base de datos
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';

/**
 * Archivo de entidad
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Salon.php';

/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los salones
 */
class SalonDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $conexion;

	/**
	 * Objeto de la clase salonDAO
	 * @var [salonDAO]
	 */
	private static $salonDAO;


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
	 * @param  [int] $codigo [Código del salon a consultar]
	 * @return [salon]         salon encontrado
	 */
	public function consultar($codigo)
	{
		$sentencia = "SELECT * FROM salon WHERE id_salon = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("i", $codigo);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $id_profesor, $nombre, $descripcion, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		while ($stmt->fetch()) {
			$salon = new Salon();
			$salon->setId($id);
			$salon->setIdProfesor($id);
			$salon->setNombre($nombre);
			$salon->setDescripcion($descripcion);
			$salon->setFechaCreacion($fecha_creacion);
			$salon->setFechaActualizacion($fecha_actualizacion);
			$salon->setEstado($estado);
		}
		$stmt->close();
		return $salon;
	}


	/**
	 * Crea una nuevo salon en la base de datos
	 * @param  salon $salonNuevo
	 * @return void
	 */
	public function crear($salonNuevo)
	{
		$sentencia = "INSERT INTO `salon` (`id_profesor`,`nombre_salon`, `descripcion_salon`, `fecha_creacion_salon`, `fecha_actualizacion_salon`, `estado_salon`) VALUES (?,?,?,?,?,?);";

		$stmt = $this->conexion->prepare($sentencia);

		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}

		$nombre = $salonNuevo->getNombre();
		$descripcion = $salonNuevo->getDescripcion();
		$id_profesor = $salonNuevo->getIdProfesor();
		$estado = $salonNuevo->getEstado();
		$dateC = $salonNuevo->getFechaCreacion();
		$dateA = $salonNuevo->getFechaActualizacion();
		$stmt->bind_param("isssss", $id_profesor, $nombre, $descripcion, $dateC, $dateA, $estado);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Modifica una salon ingresado por parámetro
	 * @param  salon $salon salon ingresado por parámetro
	 * @return void
	 */
	public function modificar($salon, $contrasena = false)
	{

		$date = date('Y-m-d H:i:s');

		$sentencia = " UPDATE `salon` SET `nombre_salon`=?,`id_profesor`=?, `descripcion_salon`=?, `fecha_actualizacion_salon`=?, `estado_salon`=? WHERE `id_salon`=?;";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$nombre = $salon->getNombre();
		$id_profesor = $salon->getIdProfesor();
		$descripcion = $salon->getDescripcion();
		$estado = $salon->getEstado();
		$id = $salon->getId();
		$stmt->bind_param("sisssi", $nombre, $id_profesor, $descripcion, $date, $estado, $id);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Lista todos los objetos que se están en la tabla de salon
	 * @return [salones]
	 */
	public function listarTodo()
	{
		$salones = array();

		$sentencia = "SELECT * FROM  `salon`;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->execute();

		$stmt->bind_result($id, $id_profesor, $nombre, $descripcion, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		while ($stmt->fetch()) {
			$salon = new Salon();
			$salon->setId($id);
			$salon->setIdProfesor($id);
			$salon->setNombre($nombre);
			$salon->setDescripcion($descripcion);
			$salon->setFechaCreacion($fecha_creacion);
			$salon->setFechaActualizacion($fecha_actualizacion);
			$salon->setEstado($estado);
			array_push($salones, $salon);
		}
		$stmt->close();

		return $salones;
	}

	/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function obtenersalonDAO($conexion_bd)
	{
		if (self::$salonDAO == null) {
			self::$salonDAO = new salonDAO($conexion_bd);
		}

		return self::$salonDAO;
	}
}
