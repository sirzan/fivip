<?php

require_once "conexion.php";

class ModeloRemesas{

    static public function mdlIngresarRemesas($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(correlativo, 
        cliente_id, 
        receptor, 
        tipo_doc, 
        n_doc, 
        banco, 
        ban_pa_m,
        n_cuenta,
        obs,
        nombre_moneda,
        pais,
        iso_moneda,
        simbolo_moneda,
        total_envio,
        tasa,
        total_remesa,
        iso_tasa,
        simbolo_tasa,
        vendedor_id,
        fecha,
        estado
        ) 
        
        VALUES(:correlativo, 
        :cliente_id, 
        :receptor, 
        :tipo_doc, 
        :n_doc, 
        :banco, 
        :ban_pa_m,
        :n_cuenta,
        :obs,
        :nombre_moneda,
        :pais,
        :iso_moneda,
        :simbolo_moneda,
        :total_envio,
        :tasa,
        :total_remesa,
        :iso_tasa,
        :simbolo_tasa,
        :vendedor_id,
        :fecha,
        :estado)");

        $stmt->bindParam(":correlativo", $datos["correlativo"], PDO::PARAM_STR);

        $stmt->bindParam(":cliente_id", $datos["cliente_id"], PDO::PARAM_INT);

        $stmt->bindParam(":receptor", $datos["receptor"], PDO::PARAM_STR);

        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);

        $stmt->bindParam(":n_doc", $datos["n_doc"], PDO::PARAM_INT);

        $stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);

        $stmt->bindParam(":ban_pa_m", $datos["ban_pa_m"], PDO::PARAM_STR);

        $stmt->bindParam(":n_cuenta", $datos["n_cuenta"], PDO::PARAM_STR);

        $stmt->bindParam(":obs", $datos["obs"], PDO::PARAM_STR);

        $stmt->bindParam(":nombre_moneda", $datos["nombre_moneda"], PDO::PARAM_STR);

        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);

        $stmt->bindParam(":iso_moneda", $datos["iso_moneda"], PDO::PARAM_STR);

        $stmt->bindParam(":simbolo_moneda", $datos["simbolo_moneda"], PDO::PARAM_STR);

        $stmt->bindParam(":total_envio", $datos["total_envio"], PDO::PARAM_STR);
        
        $stmt->bindParam(":tasa", $datos["tasa"], PDO::PARAM_STR);

        $stmt->bindParam(":total_remesa", $datos["total_remesa"], PDO::PARAM_STR);

        $stmt->bindParam(":iso_tasa", $datos["iso_tasa"], PDO::PARAM_STR);
        $stmt->bindParam(":simbolo_tasa", $datos["simbolo_tasa"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor_id", $datos["vendedor_id"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);


        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }


        $stmt->close();   

        $stmt = null;
}




    static public function mdlMostrarRemesas($tabla, $item, $valor){

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT remesas.id,rol,correlativo,receptor,remesas.tipo_doc AS tipo_documento,n_doc,ban_pa_m,obs,nombre_moneda,remesas.pais,iso_moneda,simbolo_moneda,total_envio,tasa,total_remesa,remesas.estado,remesas.fecha,banco,n_cuenta,CONCAT(nombres,' ',apellidos),documento,telefono,rol,simbolo_tasa,iso_tasa,usuarios.id as id_user FROM $tabla
            LEFT JOIN clientes ON remesas.cliente_id = clientes.id
            LEFT JOIN usuarios ON remesas.vendedor_id = usuarios.id WHERE $tabla.$item = :$item ");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();
        } 
        else {
        $stmt = Conexion::conectar()->prepare("SELECT remesas.id,rol,correlativo,receptor,remesas.tipo_doc AS tipo_documento,n_doc,ban_pa_m,obs,nombre_moneda,remesas.pais,iso_moneda,simbolo_moneda,total_envio,tasa,total_remesa,remesas.estado,remesas.fecha,banco,n_cuenta,CONCAT(nombres,' ',apellidos),documento,telefono,rol,simbolo_tasa,iso_tasa,usuarios.id as id_user FROM $tabla
        LEFT JOIN clientes ON remesas.cliente_id = clientes.id
        LEFT JOIN usuarios ON remesas.vendedor_id = usuarios.id");
            
        $stmt -> execute();

        return $stmt -> fetchAll();
        }

        $stmt->close();   

        $stmt = null;
    }


    
static public function mdlBorrarRemesas($tabla, $datos){

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

