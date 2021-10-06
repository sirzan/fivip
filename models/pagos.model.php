<?php

require_once "conexion.php";

class ModeloPagos{
   

    static public function mdlMostrarPagos($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,.$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla 
            LEFT JOIN clientes ON $tabla.cliente_id = clientes.id 
            LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id
            WHERE $tabla.estado = 0 and $tabla.id= :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
           } else {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,.$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla 
        LEFT JOIN clientes ON $tabla.cliente_id = clientes.id 
        LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id
        WHERE $tabla.estado = 0");
            
        $stmt -> execute();

        return $stmt -> fetchAll();
           }

        $stmt->close();   

        $stmt = null;
    }




    static public function mdlIngresarPagos($tabla, $datos){
        // var_dump($datos["password"]);
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(remesas_id,cuenta_entrada_id,cuenta_entrada_inter_id,monto_entrada,metodo_pago_entrada,n_operacion_entrada,cuenta_salida_id,cuenta_salida_inter_id,monto_salida,metodo_pago_salida,n_operacion_salida)
             VALUES(:remesas_id,:cuenta_entrada_id,:cuenta_entrada_inter_id,:monto_entrada,:metodo_pago_entrada,:n_operacion_entrada,:cuenta_salida_id,:cuenta_salida_inter_id,:monto_salida,:metodo_pago_salida,:n_operacion_salida)");

            $stmt->bindParam(":remesas_id", $datos["remesas_id"], PDO::PARAM_INT);
            $stmt->bindParam(":cuenta_entrada_id", $datos["cuenta_entrada_id"], PDO::PARAM_INT);
            $stmt->bindParam(":cuenta_entrada_inter_id", $datos["cuenta_entrada_inter_id"], PDO::PARAM_INT);
            $stmt->bindParam(":monto_entrada", $datos["monto_entrada"], PDO::PARAM_STR);
            $stmt->bindParam(":metodo_pago_entrada", $datos["metodo_pago_entrada"], PDO::PARAM_STR);
            $stmt->bindParam(":n_operacion_entrada", $datos["n_operacion_entrada"], PDO::PARAM_INT);
            $stmt->bindParam(":cuenta_salida_id", $datos["cuenta_salida_id"], PDO::PARAM_INT);
            $stmt->bindParam(":cuenta_salida_inter_id", $datos["cuenta_salida_inter_id"], PDO::PARAM_INT);
            $stmt->bindParam(":monto_salida", $datos["monto_salida"], PDO::PARAM_STR);
            $stmt->bindParam(":metodo_pago_salida", $datos["metodo_pago_salida"], PDO::PARAM_STR);
            $stmt->bindParam(":n_operacion_salida", $datos["n_operacion_salida"], PDO::PARAM_INT);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt->close();   

            $stmt = null;
    }


    

static public function mdlEditarRemesaEstado($tabla2, $datos2){
    
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla2 SET `estado` = :estado WHERE `id` = :id");

        $stmt->bindParam(":estado", $datos2["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos2["id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}




static public function mdlMostrarPagosProcesados($tabla, $item, $valor){
    if ($item != null) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM pagos_remesas WHERE $item= :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
       } else {
    $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,.$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla 
    LEFT JOIN clientes ON $tabla.cliente_id = clientes.id 
    LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id
    WHERE $tabla.estado = 0");
        
    $stmt -> execute();

    return $stmt -> fetchAll();
       }

    $stmt->close();   

    $stmt = null;
}



}