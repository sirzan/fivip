<?php

class Conexion{

    static public function conectar(){

        $servidor = "localhost";
        $usuario = "root";
        $password = "";

        try {
            $link = new PDO("mysql:host=$servidor;dbname=fivip", $usuario, $password);      
            $link -> exec("set names utf8");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexión realizada Satisfactoriamente";

            return $link;

          }catch(PDOException $e)
          {
          echo "La conexión ha fallado: " . $e->getMessage();
          }
        // $link = new PDO("mysql:host=localhost;dbname=fivip",
        //                 "root",
        //                 "1234");

        // $link -> exec("set names utf8");
        // return $link;
      

    }

}