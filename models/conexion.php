<?php

class Conexion{

    static public function userConectar(){
        
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        
        try {
            $link = new PDO("mysql:host=$servidor;dbname=config_system", $usuario, $password);      
            $link -> exec("set names utf8");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexión realizada Satisfactoriamente";

            return $link;

          }catch(PDOException $e)
          {
          echo "La conexión ha fallado: " . $e->getMessage();
          }
    }

    static public function conectar($database){

        $servidor = "localhost";
        $usuario = "root";
        $password = "";

        try {
            $link = new PDO("mysql:host=$servidor;dbname=$database", $usuario, $password);      
            $link -> exec("set names utf8");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // // echo "Conexión realizada Satisfactoriamente";

            return $link;

          }catch(PDOException $e)
          {
          echo "La conexión ha fallado: " . $e->getMessage();
          }
     
      

    }

}