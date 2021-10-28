<?php

require_once "conexion.php";

class ModeloMoneda{
    static public function mdlIngresarMoneda($tabla, $datos,$info){

        $stmt = Conexion::conectar($info)->prepare("INSERT INTO $tabla(moneda, simbolo, iso, pais) VALUES(:moneda, :simbolo, :iso, :pais )");

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

    static public function mdlMostrarMonedas($tabla, $item, $valor,$info){
        if ($item != null) {
            $stmt = Conexion::conectar($info)->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);
           } else {
        $stmt = Conexion::conectar($info)->prepare("SELECT $tabla.id,moneda,simbolo,iso,nombre as pais FROM $tabla LEFT JOIN pais ON $tabla.pais = pais.id");
            
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
           }

        $stmt->close();   

        $stmt = null;
    }


    static public function mdlEditarMoneda($tabla, $datos,$info){
        try {
            //code...
            $stmt = Conexion::conectar($info)->prepare("UPDATE $tabla SET `moneda` = :moneda, `simbolo` = :simbolo, `iso` = :iso, `pais` = :pais WHERE `id` = :id");

            $stmt->bindParam(":moneda", $datos["moneda"], PDO::PARAM_STR);
            $stmt->bindParam(":simbolo", $datos["simbolo"], PDO::PARAM_STR);
            $stmt->bindParam(":iso", $datos["iso"], PDO::PARAM_STR);
            $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

                 $stmt->execute();
                return "ok";

                $stmt->closeCursor();  
                $stmt = null;
        } catch (\Throwable $th) {
            echo "Mensaje de Error: " . $th->getMessage();
        }
    }

    static public function mdlBorrarMoneda($tabla, $datos,$info){

        $stmt = Conexion::conectar($info)->prepare("DELETE FROM $tabla WHERE id = :id");
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