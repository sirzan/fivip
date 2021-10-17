<?php

require_once "conexion.php";

class ModeloPagos{
   

    static public function mdlMostrarPagos($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla LEFT JOIN clientes ON $tabla.cliente_id = clientes.id LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id WHERE $tabla.estado = 0 and $tabla.id= :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);
           } else {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla LEFT JOIN clientes ON $tabla.cliente_id = clientes.id LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id WHERE $tabla.estado = 0");
            
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
           }

        $stmt->close();   

        $stmt = null;
    }




    //pagar creditos

    static public function mdlMostrarCreditos($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("	SELECT $tabla.id,simbolo_moneda,sum(monto) AS abonado,total_envio,iso_moneda,remesas_id,signo,correlativo,nombres,apellidos,telefono FROM $tabla 
            LEFT JOIN remesas ON $tabla.remesas_id= remesas.id
            LEFT JOIN clientes ON remesas.cliente_id = clientes.id
             WHERE estado=-1 and signo = '+' and remesas_id= :$item GROUP BY remesas_id ");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);
           } else {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,simbolo_moneda,sum(monto) AS abonado,total_envio,iso_moneda,remesas_id,signo,correlativo,nombres,apellidos,telefono FROM $tabla 
        LEFT JOIN remesas ON $tabla.remesas_id= remesas.id
        LEFT JOIN clientes ON remesas.cliente_id = clientes.id
         WHERE estado=-1 and signo = '+' GROUP BY remesas_id");
            
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
           }

        $stmt->close();   

        $stmt = null;
    }





    static public function mdlIngresarPagos($tabla, $datos){
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;
        // var_dump($datos["password"]);
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(remesas_id,cuenta_entrada_id,cuenta_entrada_inter_id,monto_entrada,metodo_pago_entrada,n_operacion_entrada,cuenta_salida_id,cuenta_salida_inter_id,monto_salida,metodo_pago_salida,n_operacion_salida,created_at)
             VALUES(:remesas_id,:cuenta_entrada_id,:cuenta_entrada_inter_id,:monto_entrada,:metodo_pago_entrada,:n_operacion_entrada,:cuenta_salida_id,:cuenta_salida_inter_id,:monto_salida,:metodo_pago_salida,:n_operacion_salida,:created_at)");

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
            $stmt->bindParam(":created_at",  $fechaActual, PDO::PARAM_STR);

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
        $stmt = Conexion::conectar()->prepare("SELECT * FROM pagos WHERE $item= :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
       } else {
    $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla 
    LEFT JOIN clientes ON $tabla.cliente_id = clientes.id 
    LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id
    WHERE $tabla.estado = 0");
        
    $stmt -> execute();

    return $stmt -> fetchAll();
       }

    $stmt->close();   

    $stmt = null;
}



static public function mdlMostrarPagosRealizados($item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT T1.id,T1.remesas_id,
        if(T1.signo = '+',T4.simbolo_moneda,T4.simbolo_tasa) AS simbolo,
        T1.monto,
        if(T1.signo = '+',T4.iso_moneda,T4.iso_tasa) AS iso,
        T1.n_ope,T1.metodo_p,T1.signo,T1.created_at,
        if(T2.n_titular_inter Is NULL,T3.n_titular,T2.n_titular_inter) AS n_titular,
        if(T2.a_titular_inter Is NULL,T3.a_titular,T2.a_titular_inter) AS a_titular ,
        if(T2.nombre IS NULL , T3.nombre,T2.nombre) AS nombre
        
        FROM (SELECT * from pagos)T1
        LEFT JOIN (SELECT * FROM remesas)T4 ON T1.remesas_id = T4.id
        LEFT JOIN (SELECT cuenta_banco_inter.id,n_titular_inter,a_titular_inter,nombre from cuenta_banco_inter LEFT JOIN banco_inter ON cuenta_banco_inter.banco_inter_id = banco_inter.id)T2 ON T1.cuenta_inter_id = T2.id
        LEFT JOIN (SELECT cuenta_banco_vene.id,n_titular,a_titular,nombre FROM cuenta_banco_vene LEFT JOIN banco_vene ON cuenta_banco_vene.banco_id = banco_vene.id)T3 ON T1.cuenta_vene_id = T3.id
        WHERE  T1.remesas_id= :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

             $stmt->close();   

         $stmt = null;
}


}