<?php

require_once "conexion.php";

class ModeloSaldoCuentaInter{
    static public function mdlCrearSaldo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(saldo_inter, cuenta_inter_id, moneda_inter_id) VALUES(:saldo_inter, :cuenta_inter_id, :moneda_inter_id)");
        $stmt->bindParam(":saldo_inter", $datos["saldo_inter"], PDO::PARAM_STR);
        $stmt->bindParam(":cuenta_inter_id", $datos["cuenta_inter_id"], PDO::PARAM_INT);
        $stmt->bindParam(":moneda_inter_id", $datos["moneda_inter_id"], PDO::PARAM_INT);
  

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}


static public function mdlRecargarSaldo($tabla, $datos){
    // var_dump($datos["password"]);
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `saldo_inter` = :saldo_inter WHERE `id` = :id");

        $stmt->bindParam(":saldo_inter", $datos["saldo_inter"], PDO::PARAM_STR);
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