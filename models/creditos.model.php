<?php

require_once "conexion.php";

class ModeloCredito{


    static public function mdlMostrarCreditos($tabla, $item, $valor,$info){

            if ($item != null) {
                $stmt = Conexion::conectar($info)->prepare("SELECT $tabla.id,simbolo_moneda,telefono,sum(monto) AS abonado,total_envio,iso_moneda,remesas_id,signo,correlativo,nombres,apellidos FROM $tabla 
                LEFT JOIN remesas ON $tabla.remesas_id= remesas.id
                LEFT JOIN clientes ON remesas.cliente_id = clientes.id
                 WHERE estado=-1 and signo = '+' GROUP BY remesas_id and $item = :$item");
                
                $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
                $stmt -> execute();
        
                return $stmt -> fetch(PDO::FETCH_ASSOC);
               } 
               
               else 
               
               {
            $stmt = Conexion::conectar($info)->prepare("SELECT $tabla.id,simbolo_moneda,sum(monto) AS abonado,telefono,total_envio,iso_moneda,remesas_id,signo,correlativo,nombres,apellidos FROM $tabla 
            LEFT JOIN remesas ON $tabla.remesas_id= remesas.id
            LEFT JOIN clientes ON remesas.cliente_id = clientes.id
             WHERE estado=-1 and signo = '+' GROUP BY remesas_id");
                
            $stmt -> execute();
        
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

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


