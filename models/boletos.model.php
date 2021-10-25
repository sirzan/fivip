<?php
require_once 'conexion.php';

class BoletoModal{

    static public function mdlMostrar($tabla,$item,$valor){
            try {
                if ($item!=null) {
                    $stmt= Conexion::conectar()->prepare("SELECT T1.id,T1.correlativo,T1.fecha_r,T1.fecha_s,T1.obs,T1.promotor,
                    T1.sa,T1.estado,T1.user_id,T1.created_at,
                    T2.name AS estado_d,
                    T3.name AS pais_d,
                    T4.name AS estado_s,
                    T5.name AS pais_s,
                    concat(T6.nombres,' ',T6.apellidos) AS cliente,T6.tipo_doc,T6.documento,T6.telefono,T7.rol,T8.simbolo,T1.costo,T8.iso
                    FROM (SELECT * from $tabla)T1
                    left JOIN (SELECT * from estados)T2 on JSON_EXTRACT(T1.ruta_d, '$.estado') = T2.id
                    LEFT JOIN (SELECT * from paises)T3 ON JSON_EXTRACT(T1.ruta_d, '$.pais')=T3.id
                    left JOIN (SELECT * from estados)T4 on JSON_EXTRACT(T1.ruta_s, '$.estado') = T4.id
                    LEFT JOIN (SELECT * from paises)T5 ON JSON_EXTRACT(T1.ruta_s, '$.pais')=T5.id
                    LEFT JOIN (SELECT *FROM clientes)T6 ON T1.cliente_id =T6.id
                    LEFT JOIN (SELECT *  FROM usuarios)T7 ON T1.user_id = T7.id
                    LEFT JOIN (SELECT * FROM monedas)T8 ON T1.moneda_id = T8.id WHERE T1.$item = :$item");
                    $stmt->bindParam(':'.$item,$valor,PDO::PARAM_INT);
                    $stmt->execute();
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt->closeCursor();  
                
                    $stmt = null;
                }else {
                    $stmt= Conexion::conectar()->prepare("SELECT T1.id,T1.correlativo,T1.fecha_r,T1.fecha_s,T1.obs,T1.promotor,
                    T1.sa,T1.estado,T1.user_id,T1.created_at,
                    T2.name AS estado_d,
                    T3.name AS pais_d,
                    T4.name AS estado_s,
                    T5.name AS pais_s,
                    concat(T6.nombres,' ',T6.apellidos) AS cliente,T6.tipo_doc,T6.documento,T6.telefono,T7.rol,T8.simbolo,T1.costo,T8.iso
                    FROM (SELECT * from $tabla)T1
                    left JOIN (SELECT * from estados)T2 on JSON_EXTRACT(T1.ruta_d, '$.estado') = T2.id
                    LEFT JOIN (SELECT * from paises)T3 ON JSON_EXTRACT(T1.ruta_d, '$.pais')=T3.id
                    left JOIN (SELECT * from estados)T4 on JSON_EXTRACT(T1.ruta_s, '$.estado') = T4.id
                    LEFT JOIN (SELECT * from paises)T5 ON JSON_EXTRACT(T1.ruta_s, '$.pais')=T5.id
                    LEFT JOIN (SELECT *FROM clientes)T6 ON T1.cliente_id =T6.id
                    LEFT JOIN (SELECT *  FROM usuarios)T7 ON T1.user_id = T7.id
                    LEFT JOIN (SELECT * FROM monedas)T8 ON T1.moneda_id = T8.id");
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $stmt->closeCursor();  
                
                    $stmt = null;
                }
                                
            } catch (\Throwable $th) {
                echo "Mensaje de Error: " . $th->getMessage();
            }
    }

    static public function mdlIngresar($tabla,$datos){
       try{

           $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cliente_id,correlativo,fecha_r,fecha_s,obs,promotor,ruta_d,ruta_s,sa,user_id,estado,costo,moneda_id) 
            VALUES(:cliente_id,:correlativo,:fecha_r,:fecha_s,:obs,:promotor,:ruta_d,:ruta_s,:sa,:user_id,:estado,:costo,:moneda_id)");
    
            $stmt->bindParam(":cliente_id",$datos['cliente_id'],PDO::PARAM_INT);
            $stmt->bindParam(":correlativo",$datos['correlativo'],PDO::PARAM_STR);
            $stmt->bindParam(":fecha_r",$datos['fecha_r'],PDO::PARAM_STR);
            $stmt->bindParam(":fecha_s",$datos['fecha_s'],PDO::PARAM_STR);
            $stmt->bindParam(":obs",$datos['obs'],PDO::PARAM_STR);
            $stmt->bindParam(":costo",$datos['costo'],PDO::PARAM_STR);
            $stmt->bindParam(":moneda_id",$datos['moneda_id'],PDO::PARAM_INT);
            $stmt->bindParam(":promotor",$datos['promotor'],PDO::PARAM_STR);
            $stmt->bindParam(":ruta_d",$datos['ruta_d'],PDO::PARAM_STR);
            $stmt->bindParam(":ruta_s",$datos['ruta_s'],PDO::PARAM_STR);
            $stmt->bindParam(":sa",$datos['sa'],PDO::PARAM_STR);
            $stmt->bindParam(":user_id",$datos['user_id'],PDO::PARAM_INT);
            $stmt->bindParam(":estado",$datos['estado'],PDO::PARAM_INT);
            $stmt->execute();
           
        
            return "ok";
            
            $stmt->closeCursor();  
        
            $stmt = null;
        }catch (\Throwable $th){
            echo "Mensaje de Error: " . $th->getMessage();
        } 
    }


    static public function mdlMostrarUltimoId($tabla){
        try {
            $stmt = Conexion::conectar()->prepare("SELECT id from $tabla order by id desc");
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor(); 
            $stmt = null;
        } catch (\Throwable $th) {
            echo "Mensaje de Error: " . $th->getMessage();
        }
    }


    static public function mdlMostrarCreditos($tabla,$item,$valor){
      try {
          if ($item!=null) {
           
            $stmt= Conexion::conectar()->prepare("SELECT $tabla.id,sum(monto) abonado,boleto_id,correlativo,costo-sum(monto) AS restante,simbolo,iso,concat(nombres,' ',apellidos) as cliente,telefono FROM $tabla LEFT JOIN boletos ON $tabla.boleto_id = boletos.id
            LEFT JOIN monedas ON boletos.moneda_id = monedas.id
            LEFT JOIN clientes ON boletos.cliente_id = clientes.id
            WHERE estado = 0 and $item = :$item GROUP BY boleto_id ");
            $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();  
            $stmt = null;

        }else{
            
            $stmt= Conexion::conectar()->prepare("SELECT $tabla.id,concat(simbolo,sum(monto),' (',iso,')') abonado,boleto_id,correlativo,concat(simbolo,costo-sum(monto),' (',iso,')') AS restante,concat(nombres,' ',apellidos) as cliente,telefono FROM $tabla LEFT JOIN boletos ON $tabla.boleto_id = boletos.id
            LEFT JOIN monedas ON boletos.moneda_id = monedas.id
            LEFT JOIN clientes ON boletos.cliente_id = clientes.id
            WHERE estado = 0 GROUP BY boleto_id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();  
            $stmt = null;

          }

      } catch (\Throwable $th) {
        echo "Mensaje de Error: " . $th->getMessage();
      }
    }



    

    static public function mdlEditarBoletoEstado($tabla2, $datos2){
    
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla2 SET `estado` = :estado WHERE `id` = :id");

        $stmt->bindParam(":estado", $datos2["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos2["id"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();   

        $stmt = null;
        }

}