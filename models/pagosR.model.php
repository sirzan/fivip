<?php

require_once 'conexion.php';

class PagosPModel{
    static public function mdlIngresarPagos($tabla, $datos,$info){
        try {
            date_default_timezone_set('America/Lima');

            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
    
            $fechaActual = $fecha.' '.$hora;
            // var_dump($datos["password"]);
                $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(cuenta_vene_id,cuenta_inter_id,monto,n_ope,metodo_p,remesas_id,signo,created_at)
                 VALUES(:cuenta_vene_id,:cuenta_inter_id,:monto,:n_ope,:metodo_p,:remesas_id,:signo,:created_at)");
    
                $stmt->bindParam(":cuenta_vene_id", $datos["cuenta_vene_id"], PDO::PARAM_INT);
                $stmt->bindParam(":cuenta_inter_id", $datos["cuenta_inter_id"], PDO::PARAM_INT);
                $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
                $stmt->bindParam(":n_ope", $datos["n_ope"], PDO::PARAM_STR);
                $stmt->bindParam(":metodo_p", $datos["metodo_p"], PDO::PARAM_STR);
                $stmt->bindParam(":remesas_id", $datos["remesas_id"], PDO::PARAM_INT);
                $stmt->bindParam(":signo", $datos["signo"], PDO::PARAM_STR);
                $stmt->bindParam(":created_at",  $fechaActual, PDO::PARAM_STR);
                $stmt->execute();
                return "ok";
        }catch (\Throwable $th){
            echo "Mensaje de Error: " . $th->getMessage();
        }
       
      
    }


    static public function mdlEditarRemesaEstado($tabla2, $datos2,$info){
    
        $stmt = Conexion::conectar($info)->prepare("UPDATE $tabla2 SET `estado` = :estado WHERE `id` = :id");

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

}