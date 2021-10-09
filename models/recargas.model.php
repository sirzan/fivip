<?php

require_once "conexion.php";

class ModeloMontoRecarga{
    static public function mdlIngresarMontoRecarga($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(operadora, monto, moneda_id, total_recarga, moneda_recarga_id,created_at) VALUES(:operadora, :monto, :moneda_id, :total_recarga, :moneda_recarga_id,:created_at)");

        $stmt->bindParam(":operadora", $datos["operadora"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_INT);
        $stmt->bindParam(":moneda_id", $datos["moneda_id"], PDO::PARAM_INT);
        $stmt->bindParam(":total_recarga", $datos["total_recarga"], PDO::PARAM_STR);
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
    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
    if($stmt->execute()){
        return "ok";
    }else{
        return "error";
    }

    $stmt->close();   

    $stmt = null;
}


//////////////////////////////////////
/////     ingresar recarga      /////
/////////////////////////////////////

static public function mdlIngresarRecarga($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cliente_id, operadora, cuenta_inter_id, n_dep_inter, monto,moneda_monto_id,cuenta_vene_id,n_dep_vene,recarga,moneda_recarga_id,user_id,tel_r,created_at) VALUES(:cliente_id, :operadora, :cuenta_inter_id, :n_dep_inter, :monto,:moneda_monto_id,:cuenta_vene_id,:n_dep_vene,:recarga,:moneda_recarga_id,:user_id,:tel_r,:created_at)");
  
    date_default_timezone_set('America/Lima');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fechaActual = $fecha.' '.$hora;

    $stmt->bindParam(":cliente_id", $datos["cliente_id"], PDO::PARAM_INT);
    $stmt->bindParam(":operadora", $datos["operadora"], PDO::PARAM_STR);
    $stmt->bindParam(":tel_r", $datos["tel_r"], PDO::PARAM_STR);
    $stmt->bindParam(":cuenta_inter_id", $datos["cuenta_inter_id"], PDO::PARAM_INT);
    $stmt->bindParam(":n_dep_inter", $datos["n_dep_inter"], PDO::PARAM_INT);
    $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
    $stmt->bindParam(":moneda_monto_id", $datos["moneda_monto_id"], PDO::PARAM_INT);
    $stmt->bindParam(":cuenta_vene_id", $datos["cuenta_vene_id"], PDO::PARAM_INT);
    $stmt->bindParam(":n_dep_vene", $datos["n_dep_vene"], PDO::PARAM_INT);
    $stmt->bindParam(":recarga", $datos["recarga"], PDO::PARAM_STR);
    $stmt->bindParam(":moneda_recarga_id", $datos["moneda_recarga_id"], PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $datos["user_id"], PDO::PARAM_INT);
    $stmt->bindParam(":created_at", $fechaActual, PDO::PARAM_STR);
   

    if($stmt->execute()){
        return "ok";
    }else{
        return "error";
    }

    $stmt->close();   
    $stmt = null;
}

static public function mdlMostrarRecargaAll(){
 
        $stmt = Conexion::conectar()->prepare("SELECT T1.id AS id,T1.operadora,T1.tel_r AS telefono,T2.nombres,T2.apellidos,T4.n_titular_inter,T4.a_titular_inter,T4.nombre,T5.simbolo AS simbolo_monto,T1.monto,T5.iso AS iso_monto ,T3.n_titular,T3.a_titular,T3.nombre,T6.simbolo AS simbolo_r,T1.recarga,t6.iso AS iso_r,T1.user_id FROM (SELECT *  FROM recargas)T1 
        LEFT JOIN (SELECT * from clientes)T2 ON T1.cliente_id = T2.id
        LEFT JOIN (SELECT cuenta_banco_vene.id,n_titular,a_titular,nombre FROM cuenta_banco_vene lEFT JOIN banco_vene ON cuenta_banco_vene.banco_id = banco_vene.id)T3 
        on T1.cuenta_vene_id = T3.id
        LEFT JOIN (SELECT  cuenta_banco_inter.id,n_titular_inter,a_titular_inter,nombre  FROM cuenta_banco_inter lEFT JOIN banco_inter ON cuenta_banco_inter.banco_inter_id = banco_inter.id)T4 ON T1.cuenta_inter_id = T4.id
        LEFT JOIN (SELECT * FROM monedas)T5 ON T1.moneda_monto_id = T5.id
        LEFT JOIN (SELECT * FROM monedas)T6 ON T1.moneda_recarga_id = T6.id ");
        

        $stmt -> execute();

        return $stmt -> fetchAll();
        
        $stmt->close();   
        $stmt = null;
}


static public function mdlMostrarRecargaId($tabla, $item, $valor){
    if ($item != null) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
       } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                
            $stmt -> execute();

            return $stmt -> fetchAll();
        }
        $stmt->close();   
        $stmt = null;


}


static public function mdlMostrarRecargaOne(){

        $stmt = Conexion::conectar()->prepare("SELECT id FROM recargas ORDER BY id desc limit 1");

        $stmt -> execute();

        return $stmt -> fetch();
 
        $stmt->close();   
        $stmt = null;
}


static public function mdlBorrarRecarga($tabla, $datos){

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