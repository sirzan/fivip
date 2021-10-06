<?php

require_once "conexion.php";


class SaldoCuentaVeneModel{

    static public function mdlRecargarSaldo($tabla, $datos){
        // var_dump($datos["password"]);
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `saldo` = :saldo WHERE `id` = :id");

            $stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt->close();   

            $stmt = null;
    }

  
    static public function mdlBorrarCuenta($tabla, $datos){

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