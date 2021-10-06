<?php

require_once "conexion.php";

class ModeloBancoCuentaVene{
    static public function mdlIngresarCuenta($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(n_titular, a_titular, banco_id) VALUES(:n_titular, :a_titular, :banco_id)");

        $stmt->bindParam(":n_titular", $datos["n_titular"], PDO::PARAM_STR);
        $stmt->bindParam(":a_titular", $datos["a_titular"], PDO::PARAM_STR);
        $stmt->bindParam(":banco_id", $datos["banco_id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}

    static public function mdlMostrarCuenta($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.id AS id_cuenta,n_titular,a_titular,saldo,saldo_cuenta_vene.id AS id_saldo,estado,banco_id,nombre,moneda,simbolo,iso FROM saldo_cuenta_vene  
            LEFT JOIN $tabla ON saldo_cuenta_vene.cuenta_id = $tabla.id
            LEFT JOIN banco_vene ON  $tabla.banco_id = banco_vene.id
            LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id WHERE $tabla.$item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();
           } else {
        $stmt = Conexion::conectar()->prepare("SELECT $tabla.id AS id_cuenta,n_titular,a_titular,saldo,saldo_cuenta_vene.id AS id_saldo,estado,banco_id,nombre,moneda,simbolo,iso FROM saldo_cuenta_vene  
        LEFT JOIN $tabla ON saldo_cuenta_vene.cuenta_id = $tabla.id
        LEFT JOIN banco_vene ON  $tabla.banco_id = banco_vene.id
        LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id");
            
        $stmt -> execute();

        return $stmt -> fetchAll();
           }

        $stmt->close();   

        $stmt = null;
    }





}