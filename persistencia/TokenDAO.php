<?php

/**
 * Archivo de conexión a la base de datos
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';

/**
 * Archivo de entidad
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Token.php';

/**
 * Interfaz DAO
 */
require_once('DAO.php');

/**
 * Dao para los tokens
 */
class TokenDAO implements DAO
{
	/**
	 * Conexión a la base de datos
	 * @var [Object]
	 */
	private $conexion;

	/**
	 * Objeto de la clase tokenDAO
	 * @var [tokenDAO]
	 */
	private static $tokenDAO;


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
	 * @param  [int] $codigo [Código del token a consultar]
	 * @return [token] token encontrado
	 */
	public function consultar($codigo)
	{
		$sentencia = "SELECT * FROM `token` WHERE `id_token` = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("i", $codigo);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $api_key, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		while ($stmt->fetch()) {
			$token = new Token();
			$token->setId($id);
			$token->setApiKey($api_key);
			$token->setFechaCreacion($fecha_creacion);
			$token->setFechaActualizacion($fecha_actualizacion);
			$token->setEstado($estado);
		}
		$stmt->close();
		return $token;
	}


	/**
	 * Realiza la consulta de un objeto
	 * @param  [int] $codigo [Código del objeto a consultar]
	 * @return [token] token encontrado
	 */
	public function consultarApiKey($key)
	{
		$sentencia = "SELECT * FROM `token` WHERE `api_key` = ? ;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->bind_param("s", $key);
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $api_key, $fecha_creacion, $fecha_actualizacion, $estado);

		/* fetch values */
		while ($stmt->fetch()) {
			$token = new Token();
			$token->setId($id);
			$token->setApiKey($api_key);
			$token->setFechaCreacion($fecha_creacion);
			$token->setFechaActualizacion($fecha_actualizacion);
			$token->setEstado($estado);
		}
		$stmt->close();
		if (!isset($token)) $token = false;
		return $token;
	}


	/**
	 * Crea una nuevo token en la base de datos
	 * @param  token $tokenNuevo
	 * @return void
	 */
	public function crear($tokenNuevo)
	{
		$sentencia = "INSERT INTO `token` (`api_key`, `fecha_creacion`, `fecha_actualizacion`, `estado`) VALUES (?,?,?,?);";

		$stmt = $this->conexion->prepare($sentencia);

		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}

		$api_key = $tokenNuevo->getApiKey();
		$estado = $tokenNuevo->getEstado();
		$dateC = $tokenNuevo->getFechaCreacion();
		$dateA = $tokenNuevo->getFechaActualizacion();
		$stmt->bind_param("ssssss", $api_key, $dateC, $dateA, $estado);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Modifica una token ingresado por parámetro
	 * @param  token $token token ingresado por parámetro
	 * @return void
	 */
	public function modificar($token, $contrasena = false)
	{
		$date = date('Y-m-d H:i:s');

		$sentencia = " UPDATE `token` SET `api_key`=?, `fecha_actualizacion_token`=?, `estado_token`=? WHERE `id_token`=?;";

		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$api_key = $token->getApiKey();
		$estado = $token->getEstado();
		$id = $token->getId();
		$stmt->bind_param("sssi", $api_key, $apellido, $email, $date, $estado, $id);

		$stmt->execute();
		// if ($stmt->affected_rows === 0) exit('No rows updated');
		$stmt->close();
	}

	/**
	 * Lista todos los objetos que se están en la tabla de token
	 * @return [tokens]
	 */
	public function listarTodo()
	{
		$tokens = array();

		$sentencia = "SELECT * FROM  `token`;";
		$stmt = $this->conexion->prepare($sentencia);
		if (false === $stmt) {
			die('prepare() failed: ' . htmlspecialchars($this->conexion->error));
		}
		$stmt->execute();

		$stmt->bind_result($id, $api_key, $fecha_creacion, $fecha_actualizacion, $estado);

		while ($stmt->fetch()) {
			$token = new Token();
			$token->setId($id);
			$token->setApiKey($api_key);
			$token->setFechaCreacion($fecha_creacion);
			$token->setFechaActualizacion($fecha_actualizacion);
			$token->setEstado($estado);
			array_push($tokens, $token);
		}
		$stmt->close();

		return $tokens;
	}

	/*
	*Obtiene el objeto de esta clase
	*
	*@param $conexion
	*@return void
	*/
	public static function obtenertokenDAO($conexion_bd)
	{
		if (self::$tokenDAO == null) {
			self::$tokenDAO = new tokenDAO($conexion_bd);
		}

		return self::$tokenDAO;
	}
}
