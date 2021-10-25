<?php

require_once "conexion.php";

class ServiciosModel{
    static public function mdlIngresar($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(description) VALUES(:description)");

        $stmt->bindParam(":description", $datos["servicios"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}


static public function mdlMostrar($tabla, $item, $valor){
    if ($item != null) {
        $stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
       } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                
            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
       }

    $stmt->close();   

    $stmt = null;
}


static public function mdlBorrar($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
    if($stmt->execute()){
        return "ok";
    }else{
        return "error";
    }

    $stmt->close();   

    $stmt = null;
}
}