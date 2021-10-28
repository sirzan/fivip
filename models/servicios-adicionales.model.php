<?php

require_once "conexion.php";

class ServiciosModel{
    static public function mdlIngresar($tabla, $datos,$info){
        try {
            $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(description) VALUES(:description)");

            $stmt->bindParam(":description", $datos["servicios"], PDO::PARAM_STR);
    
            $stmt->execute();
                return "ok";
           
    
            $stmt->closeCursor();   
    
            $stmt = null;
        } catch (\Throwable $th) {
           echo "Mensaje de error: ".$th->getMessage();
        }
 
}


static public function mdlMostrar($tabla, $item, $valor,$info){
    if ($item != null) {
        $stmt = Conexion::conectar($info)->prepare("SELECT * from $tabla WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
       } else {
            $stmt = Conexion::conectar($info)->prepare("SELECT * FROM $tabla");
                
            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
       }

    $stmt->close();   

    $stmt = null;
}


static public function mdlBorrar($tabla, $datos,$info){
    try {
        $stmt = Conexion::conectar($info)->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
        $stmt->execute();
            return "ok";
       
    
        $stmt->closeCursor();   
    
        $stmt = null;
    } catch (\Throwable $th) {
        echo "Mensaje de error: ".$th->getMessage();
    }
 
}
}