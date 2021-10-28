<?php

require_once 'conexion.php';

class PagoBoletoModel{

    static public function mdlIngresar($tabla,$datos,$info){
       try {
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;
        $stmt = Conexion::conectar($info)->prepare("INSERT INTO 
        $tabla(
            cuenta_vene_id,
            cuenta_inter_id,
            monto,
            n_ope,
            metodo_p,
            boleto_id,
            signo,
            created_at) 
        VALUES(
            :cuenta_vene_id,
            :cuenta_inter_id,
            :monto,
            :n_ope,
            :metodo_p,
            :boleto_id,
            :signo,
            :created_at)");
        
        
        $stmt->bindParam(":cuenta_vene_id",$datos['cuenta_vene_id'],PDO::PARAM_INT);
        $stmt->bindParam(":cuenta_inter_id",$datos['cuenta_inter_id'],PDO::PARAM_INT);
        $stmt->bindParam(":monto",$datos['monto'],PDO::PARAM_STR);
        $stmt->bindParam(":n_ope",$datos['n_ope'],PDO::PARAM_STR);
        $stmt->bindParam(":metodo_p",$datos['metodo_p'],PDO::PARAM_STR);
        $stmt->bindParam(":boleto_id",$datos['boleto_id'],PDO::PARAM_INT);
        $stmt->bindParam(":signo",$datos['signo'],PDO::PARAM_STR);
        $stmt->bindParam(":created_at",$fechaActual,PDO::PARAM_STR);
        $stmt->execute();
        return "ok";
        $stmt->closeCursor();  
        $stmt = null;

       } catch (\Throwable $th) {
            echo "Mensaje de Error: " . $th->getMessage();
       }
       
       
    }

}
