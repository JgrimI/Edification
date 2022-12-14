<?php

/**
 * Interfaz: Uso de patron singleton para los DAO
 */
interface DAO
{

    /** 
     * Realiza la consulta de un elemento específico a partir de su código 
     * @param  [int] $codigo [código del objeto a buscar]
     * @return [objeto]         [Objeto encontrado]
     */
    public function consultar($codigo);

    /**
     * Crea un nuevo objeto 
     * @param  [Objeto] $objeto [Nuevo objeto]
     * @return [void]         
     */
    public function crear($objeto);


    /**
     * Modifica el objeto ingresado por parámetro
     * @param  [Objeto] $objeto 
     * @return [void]
     */
    public function modificar($objeto);

    /**
     * Lista todos los elementos de la tabla consultada
     * @return [Objeto[]] 
     */
    public function listarTodo();
}
