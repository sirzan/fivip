<?php

require_once "conexion.php";

class ModeloBancoCuentaVene{
    static public function mdlIngresarCuenta($tabla, $datos,$info){
        try {
            $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(n_titular, a_titular, banco_id) VALUES(:n_titular, :a_titular, :banco_id)");

        $stmt->bindParam(":n_titular", $datos["n_titular"], PDO::PARAM_STR);
        $stmt->bindParam(":a_titular", $datos["a_titular"], PDO::PARAM_STR);
        $stmt->bindParam(":banco_id", $datos["banco_id"], PDO::PARAM_INT);

        $stmt->execute();
            return "ok";
    
        $stmt->closeCursor();   

        $stmt = null;
        } catch (\Throwable $th) {
           echo "Mensaje de errer: ". $th->getMessage();
        }
     
}

    static public function mdlMostrarCuenta($tabla, $item, $valor,$info){
        if ($item != null) {
            $stmt = Conexion::conectar($info)->prepare("SELECT $tabla.id AS id_cuenta,codigo,n_titular,a_titular,saldo,saldo_cuenta_vene.id AS id_saldo,estado,banco_id,nombre,moneda,simbolo,iso FROM saldo_cuenta_vene  
            LEFT JOIN $tabla ON saldo_cuenta_vene.cuenta_id = $tabla.id
            LEFT JOIN banco_vene ON  $tabla.banco_id = banco_vene.id
            LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id WHERE $tabla.$item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);
           } else {
        $stmt = Conexion::conectar($info)->prepare("SELECT $tabla.id AS id_cuenta,n_titular,a_titular,saldo,saldo_cuenta_vene.id AS id_saldo,estado,banco_id,nombre,moneda,simbolo,iso FROM saldo_cuenta_vene  
        LEFT JOIN $tabla ON saldo_cuenta_vene.cuenta_id = $tabla.id
        LEFT JOIN banco_vene ON  $tabla.banco_id = banco_vene.id
        LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id");
            
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
           }

        $stmt->close();   

        $stmt = null;
    }





}