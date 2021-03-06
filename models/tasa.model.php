<?php

require_once "conexion.php";

class ModeloTasa{
    static public function mdlIngresarTasa($tabla, $datos,$info){
        try {
            $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(pais, tasa_c, moneda_id, moneda_t_id) VALUES(:pais, :tasa_c, :moneda_id, :moneda_t_id)");

            $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
            $stmt->bindParam(":tasa_c", $datos["tasa_c"], PDO::PARAM_STR);
            $stmt->bindParam(":moneda_id", $datos["moneda_id"], PDO::PARAM_STR);
            $stmt->bindParam(":moneda_t_id", $datos["moneda_t_id"], PDO::PARAM_STR);
    
            $stmt->execute();
                return "ok";
 
            $stmt->closeCursor();   

            $stmt = null;
        } catch (\Throwable $th) {
            echo "Mensaje de error: ".$th->getMessage();
        }
 
}


static public function mdlMostrarTasa($tabla, $item, $valor,$info){
    if ($item != null) {
        $stmt = Conexion::conectar($info)->prepare("SELECT T1.id,T1.pais,T2.id AS id_moneda,T2.moneda,T2.simbolo,T2.iso,T1.tasa_c,T3.id AS id_tasa,T3.moneda AS moneda_tasa, T3.simbolo AS simbolo_tasa, T3.iso AS iso_tasa FROM (SELECT * FROM $tabla)T1 
        LEFT JOIN (SELECT * FROM monedas)T2 ON T1.moneda_id = T2.id 
        LEFT JOIN (SELECT * FROM monedas)T3 ON T1.moneda_t_id =T3.id WHERE T1.id = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
       } else {
            $stmt = Conexion::conectar($info)->prepare("SELECT T1.id,T1.pais,T2.id AS id_moneda,T2.moneda,T2.simbolo,T2.iso,T1.tasa_c,T3.id AS id_tasa,T3.moneda AS moneda_tasa, T3.simbolo AS simbolo_tasa, T3.iso AS iso_tasa FROM (SELECT * FROM $tabla)T1 
            LEFT JOIN (SELECT * FROM monedas)T2 ON T1.moneda_id = T2.id 
            LEFT JOIN (SELECT * FROM monedas)T3 ON T1.moneda_t_id =T3.id");
                
            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
       }

    $stmt->close();   

    $stmt = null;
}



static public function mdlEditarTasa($tabla, $datos,$info){
   
    try {
        $stmt = Conexion::conectar($info)->prepare("UPDATE $tabla SET `pais` = :pais, `tasa_c` = :tasa_c, `moneda_id` = :moneda_id, `moneda_t_id` =:moneda_t_id WHERE `id` = :id");

        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
        $stmt->bindParam(":tasa_c", $datos["tasa_c"], PDO::PARAM_STR);
        $stmt->bindParam(":moneda_id", $datos["moneda_id"], PDO::PARAM_STR);
        $stmt->bindParam(":moneda_t_id", $datos["moneda_t_id"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        $stmt->execute();
            return "ok";
       
        $stmt->closeCursor();   

        $stmt = null;
    } catch (\Throwable $th) {
       echo "Mensaje de error: ".$th->getMessage();
    }

}

static public function mdlBorrarTasa($tabla, $datos,$info){

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