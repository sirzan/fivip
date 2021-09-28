<?php

require_once "conexion.php";

class ModeloMontoRecarga{
    static public function mdlIngresarMontoRecarga($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(operadora, monto, moneda_id, total_recarga, moneda_recarga_id,created_at) VALUES(:operadora, :monto, :moneda_id, :total_recarga, :moneda_recarga_id,:created_at)");

        $stmt->bindParam(":operadora", $datos["operadora"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_INT);
        $stmt->bindParam(":moneda_id", $datos["moneda_id"], PDO::PARAM_INT);
        $stmt->bindParam(":total_recarga", $datos["total_recarga"], PDO::PARAM_INT);
        $stmt->bindParam(":moneda_recarga_id", $datos["moneda_recarga_id"], PDO::PARAM_INT);
        $stmt->bindParam(":created_at", $datos["created_at"], PDO::PARAM_STR);
       

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}


static public function mdlMostrarMontoRecarga($tabla, $item, $valor){
    if ($item != null) {
        $stmt = Conexion::conectar()->prepare("SELECT T1.id,T1.operadora,T1.monto,T1.total_recarga,T2.moneda AS moneda_monto,T2.simbolo AS simbolo_monto,T2.iso AS iso_monto,T2.pais,T2.id as id_moneda_monto,T3.moneda AS moneda_monto_r,T3.simbolo AS simbolo_monto_r,T3.iso AS iso_monto_r,T3.pais AS pais_r,T1.created_at,T3.id as id_moneda_r  FROM 
        (SELECT * FROM $tabla)T1 LEFT JOIN (SELECT * from monedas)T2 ON T1.moneda_id = T2.id 
        LEFT JOIN (SELECT * from monedas)T3 ON T1.moneda_recarga_id = T3.id WHERE T1.$item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
       } else {
            $stmt = Conexion::conectar()->prepare("SELECT T1.id,T1.operadora,T1.monto,T1.total_recarga,T2.moneda AS moneda_monto,T2.simbolo AS simbolo_monto,T2.iso AS iso_monto,T2.pais,T2.id as id_moneda_monto,T3.moneda AS moneda_monto_r,T3.simbolo AS simbolo_monto_r,T3.iso AS iso_monto_r,T3.pais AS pais_r,T1.created_at,T3.id as id_moneda_r FROM 
            (SELECT * FROM $tabla)T1 LEFT JOIN (SELECT * from monedas)T2 ON T1.moneda_id = T2.id 
            LEFT JOIN (SELECT * from monedas)T3 ON T1.moneda_recarga_id = T3.id");
                
            $stmt -> execute();

            return $stmt -> fetchAll();
        }
        $stmt->close();   
        $stmt = null;


}



static public function mdlEditarMontoRecarga($tabla, $datos){
    // var_dump($datos["password"]);
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `operadora` = :operadora, `monto` = :monto, `moneda_id` = :moneda_id, `total_recarga` =:total_recarga, `moneda_recarga_id` =:moneda_recarga_id WHERE `id` = :id");

        $stmt->bindParam(":operadora", $datos["operadora"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
        $stmt->bindParam(":moneda_id", $datos["moneda_id"], PDO::PARAM_INT);
        $stmt->bindParam(":total_recarga", $datos["total_recarga"], PDO::PARAM_STR);
        $stmt->bindParam(":moneda_recarga_id", $datos["moneda_recarga_id"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}

static public function mdlBorrarMontoRecarga($tabla, $datos){

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