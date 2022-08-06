<?php

/**
 * Importe de clases
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/ProfesorDAO.php';

class ManejoProfesor
{

    /**
     * Atributo para la conexión a la base de datos
     */
    private static $conexionBD;

    function __construct()
    {
    }

    /**
     * Obtiene un profesor
     * @param  [String] $id [Id del profesor a buscar]
     * @return [Profesor] Profesor encontrado
     */
    public static function consultarProfesor($id)
    {

        $profesorDAO = ProfesorDAO::obtenerprofesorDAO(self::$conexionBD);
        $profesor = $profesorDAO->consultar($id);
        return $profesor;
    }

    /**
     * Obtiene un profesor
     * @param  [String] $email [Email del profesor a buscar]
     * @return [Profesor] Profesor encontrado
     */
    public static function consultarProfesorPorEmail($email)
    {

        $profesorDAO = ProfesorDAO::obtenerprofesorDAO(self::$conexionBD);
        $profesor = $profesorDAO->consultarEmail($email);
        return $profesor;
    }

    /**
     * Crea un nuevo profesor
     * @param Profesor Profesor a ingresar
     * @return void
     */
    public static function crearProfesor($profesor)
    {
        $profesorDAO = ProfesorDAO::obtenerprofesorDAO(self::$conexionBD);
        $profesorDAO->crear($profesor);
    }

    /**
     * Verifica el inicio de sesion de un profesor
     * @param  [String] $email [Email del profesor a buscar]
     * @param  [String] $contrasenia [Contraseña del profesor a buscar]
     * @return [Boolean] true en Profesor encontrado o false en caso contrario
     */
    public static function iniciarSesion($email, $contrasenia)
    {
        $profesorDAO = ProfesorDAO::obtenerprofesorDAO(self::$conexionBD);
        $prof = $profesorDAO->consultarEmail($email);
        if ($prof !== false) {
            $pass = $prof->getContrasena();
            $identificadorContrasena = substr($pass, 0, 1);
            $arrayRta = array();

            if ($identificadorContrasena == "#") {
                $password = substr($pass, 1, strlen($pass) - 1);
                $arrayRta[] = $prof;
                $arrayRta[] = 1;
            } else {
                $password = $pass;
                $arrayRta[] = $prof;
                $arrayRta[] = 0;
            }

            if ($prof == null) {
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
     * Lista todos los profesores
     * @return Profesor[] Lista de todos los profesores de la base de datos
     */
    public  static function listarProfesores()
    {
        $profesorDAO = ProfesorDAO::obtenerprofesorDAO(self::$conexionBD);
        $profesores = $profesorDAO->listarTodo();
        return $profesores;
    }


    /**
     * Modifica un profesor
     * @param Profesor Profesor a modificar
     * @return void
     */
    public static function modificarProfesor($profesor)
    {
        $profesorDAO = ProfesorDAO::obtenerprofesorDAO(self::$conexionBD);
        $profesorDAO->modificar($profesor);
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
