<?php
/*
clase que representa a la entidad Administrador
*/
require_once('Usuario.php');

class Administrador extends Usuario
{
    //-------------------------
    //Atributos
    //-------------------------
    /*
    Representa el usuario del administrador
    */
    /*
    Representa la contraseña del usuario del administrador
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
