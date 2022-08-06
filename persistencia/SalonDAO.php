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
		$sentencia = "SELECT id_estudiante FROM rel_estudiante_salon WHERE estado = 'A' AND id_salon = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("i", $codigo);
		$stmt->execute();

		$stmt->bind_result($id_estudante);

		$estudiantes = [];

		while ($stmt->fetch()) {
			$estudiantes[] = $id_estudante;
		}

		$stmt->close();

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
			$salon->setEstudiantes($estudiantes);
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
		$estudiantes = $salonNuevo->getEstudiantes();

		$stmt->bind_param("isssss", $id_profesor, $nombre, $descripcion, $dateC, $dateA, $estado);

		$stmt->execute();

		$id_salon = $stmt->insert_id;


		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
		if ($estudiantes != null) {
			foreach ($estudiantes as $est) {

				$sentencia = "INSERT INTO `rel_estudiante_salon` (`id_estudiante`, `id_salon`, `fecha_creacion`, `fecha_actualizacion`, `estado`) VALUES (?,?,?,?,?) ;";

				$stmt = $this->conexion->prepare($sentencia);

				if (false === $stmt) {
					die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
				}

				$stmt->bind_param("iisss", $est, $id_salon, $dateC, $dateC, $estado);

				$stmt->execute();

				$stmt->close();
			}
		}
	}

	/**
	 * Modifica una salon ingresado por parámetro
	 * @param  salon $salon salon ingresado por parámetro
	 * @return void
	 */
	public function modificar($salon)
	{

		$date = date('Y-m-d H:i:s');
		$id_salon = $salon->getId();
		if ($salon->getEstudiantes() != '') {
			$arr = explode('#', $salon->getEstudiantes());

			$estudiantesAdd = explode(',', $arr[0]);
			$estudiantesDel = explode(',', $arr[1]);
			$sentencia = "SELECT id_estudiante FROM  `rel_estudiante_salon` WHERE id_salon = ?;";
			$stmt = $this->conexion->prepare($sentencia);
			if (false === $stmt) {
				die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
			}
			$stmt->bind_param("i",  $id_salon);

			$stmt->execute();
			$est = [];
			$stmt->bind_result($idest);

			/* fetch values */
			while ($stmt->fetch()) {
				$est[] = $idest;
			}
			$stmt->close();

			if (!empty($est)) {
				$estado = 'A';
				foreach ($estudiantesAdd as $key) {
					if (in_array($key, $est)) {
						$sentencia = " UPDATE `rel_estudiante_salon` SET `estado`=?, `fecha_actualizacion` =? WHERE `id_estudiante` = ? AND `id_salon`=?;";

						$stmt = $this->conexion->prepare($sentencia);
						if (false === $stmt) {
							die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
						}

						$stmt->bind_param("ssii", $estado, $date, $key, $id_salon);

						$stmt->execute();
						// if ($stmt->affected_rows === 0) exit('No rows updated');
						$stmt->close();
					} else {
						$sentencia = "INSERT INTO `rel_estudiante_salon` (`id_estudiante`, `id_salon`, `fecha_creacion`, `fecha_actualizacion`, `estado`) VALUES (?,?,?,?,?) ;";

						$stmt = $this->conexion->prepare($sentencia);

						if (false === $stmt) {
							die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
						}

						$stmt->bind_param("iisss", $key, $id_salon, $date, $date, $estado);

						$stmt->execute();

						$stmt->close();
					}
				}
				$estado = 'I';
				foreach ($estudiantesDel as $key) {
					if (in_array($key, $est)) {
						$sentencia = " UPDATE `rel_estudiante_salon` SET `estado`=?, `fecha_actualizacion`=? WHERE `id_estudiante` = ? AND `id_salon`=?;";

						$stmt = $this->conexion->prepare($sentencia);
						if (false === $stmt) {
							die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
						}

						$stmt->bind_param("ssii", $estado, $date, $key, $id_salon);

						$stmt->execute();
						// if ($stmt->affected_rows === 0) exit('No rows updated');
						$stmt->close();
					}
				}
			} {
				foreach ($estudiantesAdd as $key) {
					$sentencia = " UPDATE `rel_estudiante_salon` SET `estado`=?, `fecha_actualizacion` =? WHERE `id_estudiante` = ? AND `id_salon`=?;";

					$stmt = $this->conexion->prepare($sentencia);
					if (false === $stmt) {
						die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
					}

					$stmt->bind_param("ssii", $estado, $date, $key, $id_salon);

					$stmt->execute();
					// if ($stmt->affected_rows === 0) exit('No rows updated');
					$stmt->close();
				}
			}
		}
		$sentencia = " UPDATE `salon` SET `nombre_salon`=?,`id_profesor`=?, `descripcion_salon`=?, `fecha_actualizacion_salon`=?, `estado_salon`=? WHERE `id_salon`=?;";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$nombre = $salon->getNombre();
		$id_profesor = $salon->getIdProfesor();
		$descripcion = $salon->getDescripcion();
		$estado = $salon->getEstado();
		$stmt->bind_param("sisssi", $nombre, $id_profesor, $descripcion, $date, $estado, $id_salon);

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
		foreach ($salones as &$salon) {
			$codigo = $salon->getId();
			$sentencia = "SELECT id_estudiante FROM rel_estudiante_salon WHERE estado = 'A' AND id_salon = ? ;";
			$stmt = $this->conexion->prepare($sentencia);
			if (false === $stmt) {
				die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
			}
			$stmt->bind_param("i", $codigo);
			$stmt->execute();

			$stmt->bind_result($id_estudante);

			$estudiantes = [];

			while ($stmt->fetch()) {
				$estudiantes[] = $id_estudante;
			}
			$salon->setEstudiantes($estudiantes);
			$stmt->close();
		}


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
