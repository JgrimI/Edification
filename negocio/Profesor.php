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
     * Método para obtener la contraseña del Administrador
     * @return [Integer] contraseña del Administrador
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }


    /**
     * Método para cambiar la contraseña del Administrador
     * @param [Integer] contraseña del Administrador
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
        return $this;
    }
}
