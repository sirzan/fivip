<?php

require_once "conexion.php";

class ModeloCliente{

    static public function mdlIngresarCliente($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombres, apellidos, tipo_doc, documento,telefono,pais,direccion) VALUES(:nombres, :apellidos, :tipo_doc, :documento,:telefono,:pais, null)");

        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}


static public function mdlMostrarClientes($tabla, $item, $valor){
    if ($item != null) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
       } else {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        
    $stmt -> execute();

    return $stmt -> fetchAll();
       }

    $stmt->close();   

    $stmt = null;
}


static public function mdlEditarCliente($tabla, $datos){
    // var_dump($datos["password"]);
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET `nombres` = :nombres, `apellidos` = :apellidos, `tipo_doc` = :tipo_doc, `documento` = :documento,`telefono` = :telefono,`pais` = :pais WHERE `id` = :id");

        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
}

static public function mdlBorrarCliente($tabla, $datos){

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