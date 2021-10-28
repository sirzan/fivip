<?php

require_once "conexion.php";


class SaldoCuentaVeneModel{

    static public function mdlRecargarSaldo($tabla, $datos,$info){
      try {
        
          $stmt = Conexion::conectar($info)->prepare("UPDATE $tabla SET `saldo` = :saldo WHERE `id` = :id");

          $stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);
          $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

          $stmt->execute();
              return "ok";
         

          $stmt->closeCursor();   

          $stmt = null;
      } catch (\Throwable $th) {
         echo "Mensaje de error: ".$th->getMessage();
      }
    }

  
    static public function mdlBorrarCuenta($tabla, $datos,$info){

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