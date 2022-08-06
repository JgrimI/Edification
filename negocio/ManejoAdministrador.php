<?php

/**
 * Importe de clases
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/AdministradorDAO.php';

class ManejoAdministrador
{

    /**
     * Atributo para la conexión a la base de datos
     */
    private static $conexionBD;

    function __construct()
    {
    }

    /**
     * Obtiene un administrador
     * @param  [String] $email [Nombre de email del administrador a buscar]
     * @return [Administrador] Administrador encontrado
     */
    public static function consultarAdministrador($email)
    {

        $administradorDAO = AdministradorDAO::obteneradministradorDAO(self::$conexionBD);
        $administrador = $administradorDAO->consultar($email);
        return $administrador;
    }


    /**
     * Crea un nuevo administrador
     * @param Administrador Administrador a ingresar
     * @return void
     */
    public static function crearAdministrador($administrador)
    {
        $administradorDAO = AdministradorDAO::obteneradministradorDAO(self::$conexionBD);
        $administradorDAO->crear($administrador);
    }

    /**
     * Verifica el inicio de sesion de un administrador
     * @param  [String] $email [Email del administrador a buscar]
     * @param  [String] $contrasenia [Contraseña del administrador a buscar]
     * @return [Boolean] true en Administrador encontrado o false en caso contrario
     */
    public static function iniciarSesion($email, $contrasenia)
    {
        $administradorDAO = AdministradorDAO::obteneradministradorDAO(self::$conexionBD);
        $admin = $administradorDAO->consultarEmail($email);
        if ($admin !== false) {
            $pass = $admin->getContrasena();
            $identificadorContrasena = substr($pass, 0, 1);
            $arrayRta = array();

            if ($identificadorContrasena == "#") {
                $password = substr($pass, 1, strlen($pass) - 1);
                $arrayRta[] = $admin;
                $arrayRta[] = 1;
            } else {
                $password = $pass;
                $arrayRta[] = $admin;
                $arrayRta[] = 0;
            }

            if ($admin == null) {
                return null;
            } else {
                if (password_verify($contrasenia, $password)) {
                    return $arrayRta;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
    /**
     * Lista todos los administradores
     * @return Administrador[] Lista de todos los administradores de la base de datos
     */
    public  static function listarAdministradores()
    {
        $administradorDAO = AdministradorDAO::obtenerAdministradorDAO(self::$conexionBD);
        $administradores = $administradorDAO->listarTodo();
        return $administradores;
    }


    /**
     * Modifica un administrador
     * @param Administrador Administrador a modificar
     * @return void
     */
    public static function modificarAdministrador($administrador)
    {
        $administradorDAO = AdministradorDAO::obteneradministradorDAO(self::$conexionBD);
        $administradorDAO->modificar($administrador);
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
