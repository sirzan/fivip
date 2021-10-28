<?php

require_once "conexion.php";

class ModeloUsuarios{
    
static public function mdlMostrarUsuarios($tabla, $item, $valor,$info){
        
           if ($item != null) {
               if ($info == null) {
                   $stmt = Conexion::userConectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
                }else {
                   $stmt = Conexion::userConectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and `info`=:info");
                   $stmt -> bindParam(":info", $info, PDO::PARAM_STR);
               }
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        

			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);
           } else {

            $stmt = Conexion::userConectar()->prepare("SELECT * FROM $tabla where `info` = :info");
            $stmt -> bindParam(":info", $info, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

           }

            $stmt->close();   

            $stmt = null;
    }

    static public function mdlIngresarUsuario($tabla, $datos){
        try {
            $stmt = Conexion::userConectar()->prepare("INSERT INTO $tabla(usuario, rol, nom_user, `password`,`info`) VALUES(:usuario, :rol, :nombre, :password,:info)");

            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nom_user"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":info", $datos['info'], PDO::PARAM_STR);

            $stmt->execute();
            
                return "ok";
                $stmt->closeCursor();  
                $stmt = null;
        } catch (\Throwable $th) {
            echo "Mensaje de Error: " . $th->getMessage();
        }
    
    }

    static public function mdlEditarUsuario($tabla, $datos){
        // var_dump($datos["password"]);
            $stmt = Conexion::userConectar()->prepare("UPDATE $tabla SET `usuario` = :user, `nom_user` = :nombre, `password` = :password, `rol` = :rol WHERE `usuario` = :usuario");

            $stmt->bindParam(":user", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nom_user"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }

            $stmt->close();   

            $stmt = null;
    }

    static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

        $stmt = Conexion::userConectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
    }

    static public function mdlBorrarUsuario($tabla, $datos){

        $stmt = Conexion::userConectar()->prepare("DELETE FROM $tabla WHERE id = :id");
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