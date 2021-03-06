<?php

require_once "conexion.php";

class ModeloBancoCuentaInter{

    static public function mdlIngresarCuenta($tabla, $datos,$info){
        try {
            
            $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(n_titular_inter, a_titular_inter, banco_inter_id) VALUES(:n_titular_inter, :a_titular_inter, :banco_inter_id)");

            $stmt->bindParam(":n_titular_inter", $datos["n_titular_inter"], PDO::PARAM_STR);
            $stmt->bindParam(":a_titular_inter", $datos["a_titular_inter"], PDO::PARAM_STR);
            $stmt->bindParam(":banco_inter_id", $datos["banco_inter_id"], PDO::PARAM_INT);
    
            $stmt->execute();
                return "ok";
        
            $stmt->closeCursor();   
    
            $stmt = null;
        } catch (\Throwable $th) {
            echo "Mensaje de error: ".$th->getMessage();
        }
 
}

    static public function mdlMostrarCuenta($tabla, $item, $valor,$info){
        if ($item != null) {
            $stmt = Conexion::conectar($info)->prepare("SELECT $tabla.id AS cuenta_inter_id,estado,n_titular_inter,a_titular_inter,saldo_inter,saldo_cuenta_inter.id AS id_saldo,banco_inter_id,nombre,moneda,simbolo,iso FROM saldo_cuenta_inter  
            LEFT JOIN $tabla ON saldo_cuenta_inter.cuenta_inter_id = $tabla.id LEFT JOIN banco_inter ON  $tabla.banco_inter_id = banco_inter.id
            LEFT JOIN monedas ON saldo_cuenta_inter.moneda_inter_id = monedas.id WHERE $tabla.$item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);
           } else {
        $stmt = Conexion::conectar($info)->prepare("SELECT $tabla.id AS cuenta_inter_id,estado,n_titular_inter,a_titular_inter,saldo_inter,saldo_cuenta_inter.id AS id_saldo,banco_inter_id,nombre,moneda,simbolo,iso FROM saldo_cuenta_inter  
        LEFT JOIN $tabla ON saldo_cuenta_inter.cuenta_inter_id = $tabla.id LEFT JOIN banco_inter ON  $tabla.banco_inter_id = banco_inter.id
        LEFT JOIN monedas ON saldo_cuenta_inter.moneda_inter_id = monedas.id ");
            
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
           }

        $stmt->close();   

        $stmt = null;
    }

    static public function mdlMostrarUltimaCuenta($info){
        try {
            $stmt = Conexion::conectar($info)->prepare("SELECT * from cuenta_banco_inter order by id DESC  limit 1;");
			$stmt -> execute();
			return $stmt -> fetch(PDO::FETCH_ASSOC);
     
             $stmt->closeCursor();   

              $stmt = null;
        } catch (\Throwable $th) {
            echo "Mensaje de error: ".$th->getMessage();
        }
           
    }





}