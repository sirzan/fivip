<?php

require_once "conexion.php";

class ModeloPagos{
   

    static public function mdlMostrarPagos($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla LEFT JOIN clientes ON $tabla.cliente_id = clientes.id LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id WHERE $tabla.estado = 0 and $tabla.id= :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
           } else {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,rol,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,$tabla.estado,receptor,$tabla.tipo_doc,n_doc,banco,n_cuenta,ban_pa_m FROM $tabla LEFT JOIN clientes ON $tabla.cliente_id = clientes.id LEFT JOIN usuarios ON $tabla.vendedor_id = usuarios.id WHERE $tabla.estado = 0");
            
        $stmt -> execute();

        return $stmt -> fetchAll();
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
        $stmt = Conexion::conectar()->prepare("SELECT * FROM pagos_remesas WHERE $item= :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
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

        $stmt = Conexion::conectar()->prepare("SELECT T1.remesas_id,
        T1.metodo_pago_entrada,
        if(T2.nombre is null,T3.nombre,T2.nombre) as banco_entrada,
        if(T2.n_titular is null,T3.n_titular_inter,T2.n_titular) as n_titular_entrada,
        if(T2.a_titular is null,T3.a_titular_inter,T2.a_titular) as a_titular_entrada,
        if(T2.simbolo is null,T3.simbolo,T2.simbolo) as simbolo_entrada,
        T1.monto_entrada,
        if(T2.iso is null,T3.iso,T2.iso) as iso_entrada,
        T1.metodo_pago_salida,
        if(T4.nombre is null,T5.nombre,T4.nombre) as banco_salida,
        if(T4.n_titular is NULL,T5.n_titular_inter,T4.n_titular) as n_titular_salida,
        if(T4.a_titular is null,T5.a_titular_inter,T4.a_titular) as a_titular_salida,
        if(T4.simbolo is NULL,T5.simbolo,T4.simbolo) as simbolo_salida,
        T1.monto_salida,
        if(T4.iso is NULL,T5.iso,T4.iso) as iso_salida  FROM (SELECT * FROM pagos_remesas)T1 
        
        
        LEFT JOIN (SELECT cuenta_banco_vene.id,n_titular,a_titular,moneda,simbolo,iso,nombre FROM saldo_cuenta_vene 
        LEFT JOIN cuenta_banco_vene ON saldo_cuenta_vene.cuenta_id = cuenta_banco_vene.id
        LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id
        LEFT JOIN banco_vene ON cuenta_banco_vene.banco_id =banco_vene.id)T2
        ON T1.cuenta_entrada_id = T2.id 
        
        
        LEFT JOIN (SELECT cuenta_banco_inter.id,n_titular_inter,a_titular_inter,moneda,simbolo,iso,nombre FROM saldo_cuenta_inter 
        LEFT JOIN cuenta_banco_inter ON saldo_cuenta_inter.cuenta_inter_id = cuenta_banco_inter.id
        LEFT JOIN monedas ON saldo_cuenta_inter.moneda_inter_id = monedas.id
        LEFT JOIN banco_inter ON cuenta_banco_inter.banco_inter_id =banco_inter.id)T3 
        ON T1.cuenta_entrada_inter_id = T3.id 
        
        
        LEFT JOIN (SELECT cuenta_banco_vene.id,n_titular,a_titular,moneda,simbolo,iso,nombre FROM saldo_cuenta_vene 
        LEFT JOIN cuenta_banco_vene ON saldo_cuenta_vene.cuenta_id = cuenta_banco_vene.id
        LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id
        LEFT JOIN banco_vene ON cuenta_banco_vene.banco_id =banco_vene.id)T4
        ON T1.cuenta_salida_id = T4.id 
        
        
        LEFT JOIN (SELECT cuenta_banco_inter.id,n_titular_inter,a_titular_inter,moneda,simbolo,iso,nombre FROM saldo_cuenta_inter 
        LEFT JOIN cuenta_banco_inter ON saldo_cuenta_inter.cuenta_inter_id = cuenta_banco_inter.id
        LEFT JOIN monedas ON saldo_cuenta_inter.moneda_inter_id = monedas.id
        LEFT JOIN banco_inter ON cuenta_banco_inter.banco_inter_id =banco_inter.id)T5
        ON T1.cuenta_salida_inter_id = T5.id  WHERE T1.$item= :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

             $stmt->close();   

         $stmt = null;
}


}