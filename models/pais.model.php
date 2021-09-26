<?php

require_once "conexion.php";

class PaisModel{
    
    static public function mdlMostrarPais($tabla){
    
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            
        $stmt -> execute();

        return $stmt -> fetchAll();
 
        $stmt->close();   

        $stmt = null;
    }

}