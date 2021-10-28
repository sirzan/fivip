<?php

require_once "conexion.php";

class ModeloBancoVene{


    
        static public function mdlIngresarBancoVene($tabla, $datos){
    
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, codigo) VALUES(:nombre,:codigo)");
    
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }
    
            $stmt->close();   
    
            $stmt = null;
    }


    static public function mdlMostrarBancoVene($tabla, $item, $valor,$info){
        if ($item != null) {
            $stmt = Conexion::conectar($info)->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            
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

    static public function mdlEditarBancoVene($tabla, $datos){
    
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `nombre` = :nombre, `codigo` = :codigo WHERE `id` = :id");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt->close();   

            $stmt = null;
    }


    static public function mdlBorrarBancoVene($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
    }

}