<?php
/*
clase que representa a la entidad Profesor
*/
require_once('Usuario.php');

class Profesor extends Usuario
{
    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa el usuario del profesor
    */
    /*
    Representa la contraseña del usuario del Profesor
    */
    private $contrasena;

    /**
     * Método para obtener la contraseña del Profesor
     * @return [Integer] contraseña del Profesor
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }


    /**
     * Método para cambiar la contraseña del Profesor
     * @param [Integer] contraseña del Profesor
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
        return $this;
    }
}
