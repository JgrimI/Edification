<?php
/*
clase que representa a la entidad Salon
*/

class Salon
{

    //----------------------------
    //Constructor
    //----------------------------
    /*
    Representa un constructor vacio para la clase Salon
    */
    function __construct()
    {
    }
    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa el id del Salon
    */
    private $id;
    /*
    Representa el id del Salon
    */
    private $id_profesor;
    /*
    Representa el nombre del Salon
    */
    private $nombre;
    /*
    Representa el descripcion del Salon
    */
    private $descripcion;
    /*
    Representa la fecha de creacion del Salon
    */
    private $fechaCreacion;
    /*
    Representa la fecha de actualización del Salon
    */
    private $fechaActualizacion;
    /*
    Representa el estado del Salon: activo/inactivo
    */
    private $estado;


    /**
     * Método para obtener el id del Salon
     * @return [Integer] el id del Salon
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método para asignar el id del Salon
     * @param [String] id del Salon
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * Método para obtener el id del Profesor
     * @return [Integer] el id del Profesor
     */
    public function getIdProfesor()
    {
        return $this->id_profesor;
    }

    /**
     * Método para asignar el id del Profesor asignado al salon
     * @param [String] id del Profesor
     */
    public function setIdProfesor($id_profesor)
    {
        $this->id_profesor = $id_profesor;
    }

    /**
     * Método para obtener  el nombre del Salon
     * @return [String] nombre del Salon
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Método para cambiar  el nombre del Salon
     * @param [String] nombre del Salon
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    /**
     * Método para obtener  la descripcion del Salon
     * @return [String] descripcion del Salon
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Método para cambiar la descripcion del Salon
     * @param [String] descripcion del Salon
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Método para obtener la fecha de creacion del Salon
     * @return [Date] fecha de creacion del Salon
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Método para asignar la fecha de creacion del Salon
     * @param [Date] fecha de creacion del Salon
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * Método para obtener la fecha de creacion del Salon
     * @return [Date] fecha de creacion del Salon
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Método para asignar la fecha de actualización del Salon
     * @param [Date] fecha de actualización del Salon
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }


    /**
     * Método para obtener el estado del Salon (1:Activo/0:Inactivo)
     * @return [integer] estado del Salon
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Método para cambiar el estado del Salon 
     * @param [integer] estado del Salon
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}
