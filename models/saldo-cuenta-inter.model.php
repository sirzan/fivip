<?php

require_once "conexion.php";

class ModeloSaldoCuentaInter{
    static public function mdlCrearSaldo($tabla, $datos,$info){

        try {
            $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(saldo_inter, cuenta_inter_id, moneda_inter_id) VALUES(:saldo_inter, :cuenta_inter_id, :moneda_inter_id)");
            $stmt->bindParam(":saldo_inter", $datos["saldo_inter"], PDO::PARAM_STR);
            $stmt->bindParam(":cuenta_inter_id", $datos["cuenta_inter_id"], PDO::PARAM_INT);
            $stmt->bindParam(":moneda_inter_id", $datos["moneda_inter_id"], PDO::PARAM_INT);
    
            $stmt->execute();
                return "ok";
           
            $stmt->closeCursor();   

            $stmt = null;
        } catch (\Throwable $th) {
           echo "Mensaje de error: ".$th->getMessage();
        }
   
}


static public function mdlRecargarSaldo($tabla, $datos,$info){
  
      try {
        $stmt = Conexion::conectar($info)->prepare("UPDATE $tabla SET `saldo_inter` = :saldo_inter WHERE `id` = :id");

        $stmt->bindParam(":saldo_inter", $datos["saldo_inter"], PDO::PARAM_STR);
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
    try {
        $stmt = Conexion::conectar($info)->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_STR);
        $stmt->execute();
            return "ok";
    
        $stmt->closeCursor();   
    
        $stmt = null;
    } catch (\Throwable $th) {
        echo "Mensaje de error: ".$th->getMessage();
    }

}


}