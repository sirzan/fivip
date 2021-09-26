<?php

require_once "conexion.php";

class ModeloMoneda{
    static public function mdlIngresarMoneda($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(moneda, simbolo, iso, pais) VALUES(:moneda, :simbolo, :iso, :pais )");

        $stmt->bindParam(":moneda", $datos["moneda"], PDO::PARAM_STR);
        $stmt->bindParam(":simbolo", $datos["simbolo"], PDO::PARAM_STR);
        $stmt->bindParam(":iso", $datos["iso"], PDO::PARAM_STR);
        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);

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


    static public function mdlEditarMoneda($tabla, $datos){
        // var_dump($datos["password"]);
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `moneda` = :moneda, `simbolo` = :simbolo, `iso` = :iso, `pais` = :pais WHERE `id` = :id");

            $stmt->bindParam(":moneda", $datos["moneda"], PDO::PARAM_STR);
            $stmt->bindParam(":simbolo", $datos["simbolo"], PDO::PARAM_STR);
            $stmt->bindParam(":iso", $datos["iso"], PDO::PARAM_STR);
            $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt->close();   

            $stmt = null;
    }

    static public function mdlBorrarMoneda($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
    }

}