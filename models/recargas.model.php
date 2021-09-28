<?php

require_once "conexion.php";

class ModeloRecarga{
    static public function mdlIngresarRecarga($tabla, $datos){

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


static public function mdlMostrarRecarga($tabla, $item, $valor){
    if ($item != null) {
        $stmt = Conexion::conectar()->prepare("SELECT T1.id,T1.operadora,T1.monto,T1.total_recarga,T2.moneda AS moneda_monto,T2.simbolo AS simbolo_monto,T2.iso AS iso_monto,T2.pais,T3.moneda AS moneda_monto_r,T3.simbolo AS simbolo_monto_r,T3.iso AS iso_monto_r,T3.pais AS pais_r,T1.created_at FROM 
        (SELECT * FROM $tabla)T1 LEFT JOIN (SELECT * from monedas)T2 ON T1.moneda_id = T2.id 
        LEFT JOIN (SELECT * from monedas)T3 ON T1.moneda_recarga_id = T3.id WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
       } else {
            $stmt = Conexion::conectar()->prepare("SELECT T1.id,T1.operadora,T1.monto,T1.total_recarga,T2.moneda AS moneda_monto,T2.simbolo AS simbolo_monto,T2.iso AS iso_monto,T2.pais,T3.moneda AS moneda_monto_r,T3.simbolo AS simbolo_monto_r,T3.iso AS iso_monto_r,T3.pais AS pais_r,T1.created_at FROM 
            (SELECT * FROM $tabla)T1 LEFT JOIN (SELECT * from monedas)T2 ON T1.moneda_id = T2.id 
            LEFT JOIN (SELECT * from monedas)T3 ON T1.moneda_recarga_id = T3.id");
                
            $stmt -> execute();

            return $stmt -> fetchAll();
       }

    $stmt->close();   

    $stmt = null;
}



static public function mdlEditarTasa($tabla, $datos){
    // var_dump($datos["password"]);
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `pais` = :pais, `tasa_c` = :tasa_c, `moneda_id` = :moneda_id, `moneda_t_id` =:moneda_t_id WHERE `id` = :id");

        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
        $stmt->bindParam(":tasa_c", $datos["tasa_c"], PDO::PARAM_STR);
        $stmt->bindParam(":moneda_id", $datos["moneda_id"], PDO::PARAM_STR);
        $stmt->bindParam(":moneda_t_id", $datos["moneda_t_id"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}

static public function mdlBorrarTasa($tabla, $datos){

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