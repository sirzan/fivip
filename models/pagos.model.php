<?php

require_once "conexion.php";

class ModeloPagos{
   

    static public function mdlMostrarPagos($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,estado FROM $tabla LEFT JOIN clientes ON $tabla.cliente_id = clientes.id WHERE estado = 0 and $tabla.id= :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
           } else {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id,correlativo,total_envio,$tabla.pais,iso_moneda,simbolo_moneda,tasa,total_remesa,iso_tasa,simbolo_tasa,concat(nombres,' ',apellidos) AS cliente, telefono,estado FROM $tabla LEFT JOIN clientes ON $tabla.cliente_id = clientes.id WHERE estado = 0");
            
        $stmt -> execute();

        return $stmt -> fetchAll();
           }

        $stmt->close();   

        $stmt = null;
    }


    static public function mdlEditarPagos($tabla, $datos){
        // var_dump($datos["password"]);
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `metodo_pago` = :metodo_pago, `pago_m_p` = :pago_m_p, `n_trans` = :n_trans, `banco_trans` = :banco_trans, `estado` = :estado WHERE `id` = :id");

            $stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
            $stmt->bindParam(":pago_m_p", $datos["pago_m_p"], PDO::PARAM_INT);
            $stmt->bindParam(":n_trans", $datos["n_trans"], PDO::PARAM_INT);
            $stmt->bindParam(":banco_trans", $datos["banco_trans"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt->close();   

            $stmt = null;
    }



}