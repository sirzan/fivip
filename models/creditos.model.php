<?php

require_once "conexion.php";

class ModeloCredito{







    static public function mdlMostrarCreditos($tabla, $item, $valor){

            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("SELECT $tabla.id AS id,remesas_id,monto_entrada,metodo_pago_entrada,correlativo,nombre_moneda,remesas.pais,iso_moneda, simbolo_moneda,total_envio,nombres,apellidos
                FROM $tabla LEFT JOIN remesas ON $tabla.remesas_id = remesas.id LEFT JOIN clientes ON remesas.cliente_id = clientes.id WHERE $item = :$item and metodo_pago_entrada = 'credito'");
                
                $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
                $stmt -> execute();
        
                return $stmt -> fetch();
               } 
               
               else 
               
               {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.id as id, remesas_id,monto_entrada,metodo_pago_entrada,correlativo,nombre_moneda,remesas.pais,iso_moneda, simbolo_moneda,total_envio,nombres,apellidos
            FROM $tabla LEFT JOIN remesas ON $tabla.remesas_id = remesas.id LEFT JOIN clientes ON remesas.cliente_id = clientes.id WHERE metodo_pago_entrada = 'credito'");
                
            $stmt -> execute();
        
            return $stmt -> fetchAll();

               }
        
            $stmt->close();   
        
            $stmt = null;
        }


        static public function mdlPagoCredito($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `metodo_pago_entrada` = :metodo_pago_entrada, `n_operacion_entrada` = :n_operacion_entrada,`cuenta_entrada_id` = :cuenta_entrada_id,`cuenta_entrada_inter_id` = :cuenta_entrada_inter_id,`monto_entrada` = :monto_entrada WHERE `remesas_id` = :remesas_id");
           
            $stmt->bindParam(":remesas_id", $datos['remesas_id'], PDO::PARAM_INT);
            $stmt->bindParam(":metodo_pago_entrada", $datos['metodo_pago_entrada'], PDO::PARAM_STR);
            $stmt->bindParam(":n_operacion_entrada", $datos['n_operacion_entrada'], PDO::PARAM_INT);
            $stmt->bindParam(":cuenta_entrada_id", $datos['cuenta_entrada_id'], PDO::PARAM_INT);
            $stmt->bindParam(":cuenta_entrada_inter_id", $datos['cuenta_entrada_inter_id'], PDO::PARAM_INT);
            $stmt->bindParam(":monto_entrada", $datos['monto_entrada'], PDO::PARAM_STR);
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }
    
            $stmt->close();   
    
            $stmt = null;
        }


}


