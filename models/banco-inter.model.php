<?php

require_once "conexion.php";

class ModeloBancoInter{


    
        static public function mdlIngresarBancoInter($tabla, $datos,$info){
    
            $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(nombre) VALUES(:nombre)");
    
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }
    
            $stmt->close();   
    
            $stmt = null;
    }


    static public function mdlMostrarBancoInter($tabla, $item, $valor,$info){
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

    static public function mdlEditarBancoInter($tabla, $datos,$info){
    
        try {
            //code...
            $stmt = Conexion::conectar($info)->prepare("UPDATE $tabla SET `nombre` = :nombre WHERE `id` = :id");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            $stmt->execute();
                return "ok";
    
                $stmt->closeCursor();  
                $stmt = null;
        } catch (\Throwable $th) {
            echo "Mensaje de Error: " . $th->getMessage();
        }
    }


    static public function mdlBorrarBancoInter($tabla, $datos,$info){

        $stmt = Conexion::conectar($info)->prepare("DELETE FROM $tabla WHERE id = :id");
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