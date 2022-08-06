<?php

/**
 * Importe de clases
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/EstudianteDAO.php';

class ManejoEstudiante
{

    /**
     * Atributo para la conexión a la base de datos
     */
    private static $conexionBD;

    function __construct()
    {
    }

    /**
     * Obtiene un estudiante
     * @param  [String] $usuario [Nombre de usuario del estudiante a buscar]
     * @return [Estudiante] Estudiante encontrado
     */
    public static function consultarEstudiante($usuario)
    {

        $estudianteDAO = EstudianteDAO::obtenerestudianteDAO(self::$conexionBD);
        $estudiante = $estudianteDAO->consultar($usuario);
        return $estudiante;
    }

    /**
     * Obtiene un estudiante a traves del email
     * @param  [String] $correo [Correo del estudiante a buscar]
     * @return [Estudiante] Estudiante encontrado
     */
    public static function consultarEmail($correo)
    {

        $estudianteDAO = EstudianteDAO::obtenerestudianteDAO(self::$conexionBD);
        $estudiante = $estudianteDAO->consultarEmail($correo);

        return $estudiante;
    }

    /**
     * Crea un nuevo estudiante
     * @param Estudiante Estudiante a ingresar
     * @return void
     */
    public static function crearEstudiante($estudiante)
    {
        $estudianteDAO = EstudianteDAO::obtenerestudianteDAO(self::$conexionBD);
        $estudianteDAO->crear($estudiante);
    }

    /**
     * Verifica el inicio de sesion de un estudiante
     * @param  [String] $email [Email del estudiante a buscar]
     * @param  [String] $contrasenia [Contraseña del estudiante a buscar]
     * @return [Boolean] true en Estudiante encontrado o false en caso contrario
     */
    public static function iniciarSesion($email, $contrasenia)
    {
        $estudianteDAO = EstudianteDAO::obtenerestudianteDAO(self::$conexionBD);
        $admin = $estudianteDAO->consultarEmail($email);
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
    }
    /**
     * Lista todos los estudiantes
     * @return Estudiante[] Lista de todos los estudiantes de la base de datos
     */
    public  static function listarEstudiantes()
    {
        $estudianteDAO = EstudianteDAO::obtenerestudianteDAO(self::$conexionBD);
        $estudiantes = $estudianteDAO->listarTodo();
        return $estudiantes;
    }


    /**
     * Modifica un estudiante
     * @param Estudiante Estudiante a modificar
     * @return void
     */
    public static function modificarEstudiante($estudiante)
    {
        $estudianteDAO = EstudianteDAO::obtenerestudianteDAO(self::$conexionBD);
        $estudianteDAO->modificar($estudiante);
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
