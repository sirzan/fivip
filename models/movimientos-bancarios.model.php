<?php

require_once "conexion.php";

class ModeloMovimientosBancarios{
    static public function mdlIngresarMovimiento($tabla, $datos){
          
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cuenta_banco_vene_id, c_transfer_vene_id, cuenta_banco_inter_id, monto, pago_remesa_id,operacion,signo,recargas_id,created_at) VALUES(:cuenta_banco_vene_id, :c_transfer_vene_id, :cuenta_banco_inter_id, :monto, :pago_remesa_id,:operacion,:signo,:recargas_id,:created_at)");

        $stmt->bindParam(":cuenta_banco_vene_id", $datos["id_cuenta"], PDO::PARAM_INT);
        $stmt->bindParam(":cuenta_banco_inter_id", $datos["cuenta_banco_inter_id"], PDO::PARAM_INT);
        $stmt->bindParam(":c_transfer_vene_id", $datos["c_transfer_vene_id"], PDO::PARAM_INT);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
        $stmt->bindParam(":pago_remesa_id", $datos["pago_remesa_id"], PDO::PARAM_INT);
        $stmt->bindParam(":operacion", $datos["operacion"], PDO::PARAM_STR);
        $stmt->bindParam(":signo", $datos["signo"], PDO::PARAM_STR);
        $stmt->bindParam(":recargas_id", $datos["recargas_id"], PDO::PARAM_INT);
        $stmt->bindParam(":created_at",  $fechaActual, PDO::PARAM_STR);

        if($stmt->execute()){
         return "ok";
        }else{
         return "error";
        }

        $stmt->close();   

        $stmt = null;
}

    static public function mdlMostrarMonedas($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
           } else {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,moneda,simbolo,iso,nombre as pais FROM $tabla LEFT JOIN pais ON $tabla.pais = pais.id");
            
        $stmt -> execute();

        return $stmt -> fetchAll();
           }

        $stmt->close();   

        $stmt = null;
    }



  

}