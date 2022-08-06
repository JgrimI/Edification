<?php

/**
 * Archivo de conexión a la base de datos
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';

/**
 * Archivo de entidad
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Administrador.php';

/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los administradors
 */
class AdministradorDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $conexion;

	/**
	 * Objeto de la clase administradorDAO
	 * @var [administradorDAO]
	 */
	private static $administradorDAO;


	/**
	 * Constructor de la clase
	 */

	private function __construct($conexion)
	{
		$this->conexion = $conexion;
		$this->conexion->set_charset("utf8");
	}

	/**
	 * Realiza la consulta de un objeto
	 * @param  [string] $id [Id del objeto a consultar]
	 * @return [administrador] administrador encontrado
	 */
	public function consultar($id)
	{
		$sentencia = "SELECT * FROM administrador WHERE id_admin =? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("i", $id);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $nombre, $apellido, $correo, $contrasena, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		$administrador = false;

		while ($stmt->fetch()) {
			$administrador = new Administrador();
			$administrador->setId($id);
			$administrador->setNombre($nombre);
			$administrador->setApellido($apellido);
			$administrador->setEmail($correo);
			$administrador->setContrasena($contrasena);
			$administrador->setFechaCreacion($fecha_creacion);
			$administrador->setFechaActualizacion($fecha_actualizacion);
			$administrador->setEstado($estado);
		}
		$stmt->close();
		return $administrador;
	}


	/**
	 * Realiza la consulta de un objeto
	 * @param  [string] $email [Email del objeto a consultar]
	 * @return [administrador] administrador encontrado
	 */
	public function consultarEmail($email)
	{
		$sentencia = "SELECT * FROM administrador WHERE correo_admin =? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("s", $email);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $nombre, $apellido, $correo, $contrasena, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		$administrador = false;
		while ($stmt->fetch()) {
			$administrador = new Administrador();
			$administrador->setId($id);
			$administrador->setNombre($nombre);
			$administrador->setApellido($apellido);
			$administrador->setEmail($correo);
			$administrador->setContrasena($contrasena);
			$administrador->setFechaCreacion($fecha_creacion);
			$administrador->setFechaActualizacion($fecha_actualizacion);
			$administrador->setEstado($estado);
		}
		$stmt->close();
		return $administrador;
	}

	/**
	 * Crea una nuevo administrador en la base de datos
	 * @param  administrador $administradorNuevo
	 * @return void
	 */
	public function crear($administradorNuevo)
	{
		$administradorNuevo->setContrasena(password_hash($administradorNuevo->getContrasena(), PASSWORD_BCRYPT));

		$date = date('Y-m-d H:i:s');

		$sentencia = " INSERT INTO `administrador` (`nombre_admin`, `apellido_admin`, `correo_admin`, `contrasena_admin`, `fecha_creacion_admin`, `fecha_actualizacion_admin`, `estado_admin`) VALUES(?,?,?,?,?,?,?);";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}

		$stmt->bind_param("sssssss",  $administradorNuevo->getNombre(), $administradorNuevo->getApellido(), $administradorNuevo->getEmail(), $administradorNuevo->getContrasena(), $date, $date, $administradorNuevo->getEstado());

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Modifica una administrador ingresado por parámetro
	 * @param  administrador $administrador administrador ingresado por parámetro
	 * @return void
	 */
	public function modificar($administrador, $contrasena = false)
	{
		if ($contrasena) $administrador->setContrasena(password_hash($administrador->getContrasena(), PASSWORD_BCRYPT));

		$date = date('Y-m-d H:i:s');

		$sentencia = " UPDATE `administrador` SET `nombre_admin`=?, `apellido_admin`=?, `correo_admin`=?, `contrasena_admin`=?, `fecha_actualizacion_admin`=?, `estado_admin`=? WHERE `id_admin`=?;";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}

		$stmt->bind_param("ssssssi",  $administrador->getNombre(), $administrador->getApellido(), $administrador->getEmail(), $administrador->getContrasena(), $date, $administrador->getEstado(), $administrador->getId());

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Lista todos los objetos que se están en la tabla de administrador
	 * @return [administradors]
	 */
	public function listarTodo()
	{
		$administradors = array();

		$sentencia = "SELECT * FROM `administrador`;";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->execute();

		$stmt->bind_result($id, $nombre, $apellido, $correo, $contrasena, $fecha_creacion, $fecha_actualizacion, $estado);

		while ($stmt->fetch()) {
			$administrador = new Administrador();
			$administrador->setId($id);
			$administrador->setNombre($nombre);
			$administrador->setApellido($apellido);
			$administrador->setEmail($correo);
			$administrador->setContrasena($contrasena);
			$administrador->setFechaCreacion($fecha_creacion);
			$administrador->setFechaActualizacion($fecha_actualizacion);
			$administrador->setEstado($estado);

			array_push($administradors, $administrador);
		}
		$stmt->close();

		return $administradors;
	}

	/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function obteneradministradorDAO($conexion_bd)
	{
		if (self::$administradorDAO == null) {
			self::$administradorDAO = new administradorDAO($conexion_bd);
		}

		return self::$administradorDAO;
	}
}
