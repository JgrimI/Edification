<?php

/**
 * Importe de clases
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/TokenDAO.php';

class ManejoToken
{

    /**
     * Atributo para la conexión a la base de datos
     */
    private static $conexionBD;

    function __construct()
    {
    }

    /**
     * Obtiene un token
     * @param  [String] $token [id del token a buscar]
     * @return [Token] Token encontrado
     */
    public static function consultarToken($token)
    {

        $tokenDAO = TokenDAO::obtenertokenDAO(self::$conexionBD);
        $token = $tokenDAO->consultar($token);
        return $token;
    }

    /**
     * Obtiene un token a traves del api key
     * @param  [String] $apikey [apikey del token a buscar]
     * @return [Token] Token encontrado
     */
    public static function consultarApiKey($apikey)
    {

        $tokenDAO = TokenDAO::obtenertokenDAO(self::$conexionBD);
        $token = $tokenDAO->consultarApiKey($apikey);

        return $token;
    }

    /**
     * Crea un nuevo token
     * @param Token Token a ingresar
     * @return void
     */
    public static function crearToken($token)
    {
        $tokenDAO = TokenDAO::obtenertokenDAO(self::$conexionBD);
        $tokenDAO->crear($token);
    }

    /**
     * Lista todos los tokens
     * @return Token[] Lista de todos los tokens de la base de datos
     */
    public  static function listarTokens()
    {
        $tokenDAO = TokenDAO::obtenertokenDAO(self::$conexionBD);
        $tokens = $tokenDAO->listarTodo();
        return $tokens;
    }

    /**
     * Modifica un token
     * @param Token Token a modificar
     * @return void
     */
    public static function modificarToken($token)
    {
        $tokenDAO = TokenDAO::obtenertokenDAO(self::$conexionBD);
        $tokenDAO->modificar($token);
    }

    /**
     * Cambia la conexión
     */
    public static function setConexionBD($conexionBD)
    {
        self::$conexionBD = $conexionBD;
    }
    public static function contraseniaAleatoria()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
