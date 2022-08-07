<?php
/*
clase que representa a la entidad Token
*/

class Token
{

    //----------------------------
    //Constructor
    //----------------------------
    /*
    Representa un constructor vacio para la clase Token
    */
    function __construct()
    {
    }
    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa el id del Token
    */
    private $id;
    /*
    Representa el id del Token
    */
    private $api_key;
    /*
    Representa la fecha de creacion del Token
    */
    private $fechaCreacion;
    /*
    Representa la fecha de actualización del Token
    */
    private $fechaActualizacion;
    /*
    Representa el estado del Token: activo/inactivo
    */
    private $estado;

    /**
     * Método para obtener el id del Token
     * @return [Integer] el id del Token
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método para asignar el id del Token
     * @param [String] id del Token
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * Método para obtener el id del Profesor
     * @return [Integer] el id del Profesor
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * Método para asignar el id del Profesor asignado al salon
     * @param [String] id del Profesor
     */
    public function setApiKey($key)
    {
        $this->api_key = $key;
    }

    /**
     * Método para obtener la fecha de creacion del Token
     * @return [string] fecha de creacion del Token
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Método para asignar la fecha de creacion del Token
     * @param [string] fecha de creacion del Token
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * Método para obtener la fecha de creacion del Token
     * @return [string] fecha de creacion del Token
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Método para asignar la fecha de actualización del Token
     * @param [string] fecha de actualización del Token
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }


    /**
     * Método para obtener el estado del Token (1:Activo/0:Inactivo)
     * @return [string] estado del Token
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Método para cambiar el estado del Token 
     * @param [string] estado del Token
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}
