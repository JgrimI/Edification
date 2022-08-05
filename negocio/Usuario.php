<?php
/*
clase que representa a la entidad Usuario
*/
abstract class Usuario
{

    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa el id del Usuario
    */
    private $id;
    /*
    Representa el nombre del Usuario
    */
    private $nombre;
    /*
    Representa el apellido del Usuario
    */
    private $apellido;
    /*
    Representa el correo electronico del Usuario
    */
    private $email;
    /*
    Representa la fecha de creacion del Usuario
    */
    private $fechaCreacion;
    /*
    Representa la fecha de actualización del Usuario
    */
    private $fechaActualizacion;/*
    Representa el estado del Usuario: activo/inactivo
    */
    private $estado;


    //----------------------------
    //Constructor
    //----------------------------
    /*
    Representa un constructor vacio para la clase Usuario
    */
    function __construct()
    {
    }

    /**
     * Método para obtener el id del Usuario
     * @return [Integer] el id del Usuario
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método para asignar el id del Usuario
     * @param [String] id del Usuario
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Método para obtener  el nombre del Usuario
     * @return [String] nombre del Usuario
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Método para cambiar  el nombre del Usuario
     * @param [String] nombre del Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Método para obtener  el apellido del Usuario
     * @return [String] apellido del Usuario
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Método para cambiar  el apellido del Usuario
     * @param [String] apellido del Usuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * Método para obtener el correo electronico del Usuario
     * @return [String] correo del Usuario
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Método para obtener el correo electronico del Usuario
     * @param [String] correo del Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Método para obtener la fecha de creacion del Usuario
     * @return [Date] fecha de creacion del Usuario
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Método para asignar la fecha de creacion del Usuario
     * @param [Date] fecha de creacion del Usuario
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * Método para obtener la fecha de creacion del Usuario
     * @return [Date] fecha de creacion del Usuario
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Método para asignar la fecha de actualización del Usuario
     * @param [Date] fecha de actualización del Usuario
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    /**
     * Método para obtener el estado del Usuario (1:Activo/0:Inactivo)
     * @return [integer] estado del Usuario
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Método para cambiar el estado del Usuario 
     * @param [integer] estado del Usuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}
