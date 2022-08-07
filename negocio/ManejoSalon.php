<?php

/**
 * Importe de clases
 */
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/SalonDAO.php';

class ManejoSalon
{

    /**
     * Atributo para la conexión a la base de datos
     */
    private static $conexionBD;

    function __construct()
    {
    }

    /**
     * Obtiene un salon
     * @param  [String] $usuario [Nombre de usuario del salon a buscar]
     * @return [Salon] Salon encontrado
     */
    public static function consultarSalon($usuario)
    {

        $salonDAO = SalonDAO::obtenersalonDAO(self::$conexionBD);
        $salon = $salonDAO->consultar($usuario);
        return $salon;
    }

    /**
     * Obtiene un salon a traves del email
     * @param  [String] $correo [Correo del salon a buscar]
     * @return [Salon] Salon encontrado
     */
    public static function consultarEmail($correo)
    {

        $salonDAO = SalonDAO::obtenersalonDAO(self::$conexionBD);
        $salon = $salonDAO->consultarEmail($correo);

        return $salon;
    }

    /**
     * Crea un nuevo salon
     * @param Salon Salon a ingresar
     * @return void
     */
    public static function crearSalon($salon)
    {
        $salonDAO = SalonDAO::obtenersalonDAO(self::$conexionBD);
        $salonDAO->crear($salon);
    }

    /**
     * Verifica el inicio de sesion de un salon
     * @param  [String] $email [Email del salon a buscar]
     * @param  [String] $contrasenia [Contraseña del salon a buscar]
     * @return [Boolean] true en Salon encontrado o false en caso contrario
     */
    public static function iniciarSesion($email, $contrasenia)
    {
        $salonDAO = SalonDAO::obtenersalonDAO(self::$conexionBD);
        $admin = $salonDAO->consultarEmail($email);
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
     * Lista todos los salones
     * @return Salon[] Lista de todos los salones de la base de datos
     */
    public  static function listarSalones()
    {
        $salonDAO = SalonDAO::obtenersalonDAO(self::$conexionBD);
        $salones = $salonDAO->listarTodo();
        return $salones;
    }

    /**
     * Lista todos los salones por profesor dado
     * @param string codigo del profesor del salon
     * @return Salon[] Lista de todos los salones de la base de datos
     */
    public  static function listarSalonesProfesor($id_profesor)
    {
        $salonDAO = SalonDAO::obtenersalonDAO(self::$conexionBD);
        $salones = $salonDAO->listarTodoProfesor($id_profesor);
        return $salones;
    }

    /**
     * Modifica un salon
     * @param Salon Salon a modificar
     * @return void
     */
    public static function modificarSalon($salon)
    {
        $salonDAO = SalonDAO::obtenersalonDAO(self::$conexionBD);
        $salonDAO->modificar($salon);
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
