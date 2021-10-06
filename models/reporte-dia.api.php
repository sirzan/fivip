<?php
require_once 'conexion.php';
           

class ReporteDia{

    static public function apiReporte(){
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;
        $stmt = Conexion::conectar()->prepare("SELECT remesas.id,correlativo,remesas.pais,nombre_moneda,iso_moneda,simbolo_moneda,total_envio,tasa,total_remesa,iso_tasa,simbolo_tasa,nombres,apellidos FROM remesas LEFT JOIN clientes on remesas.cliente_id = clientes.id  WHERE DATE_FORMAT(remesas.fecha, '%Y-%m-%d') = DATE_FORMAT(:fecha, '%Y-%m-%d')");
        $stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
         
        $stmt -> execute();
        return $stmt -> fetchAll();
        
        $stmt->close();   

        $stmt = null;
    }
    static public function apiReporteRango($fechaInicio,$fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT remesas.id,correlativo,remesas.pais,nombre_moneda,iso_moneda,simbolo_moneda,total_envio,tasa,total_remesa,iso_tasa,simbolo_tasa,nombres,apellidos FROM remesas LEFT JOIN clientes on remesas.cliente_id = clientes.id  WHERE DATE_FORMAT(remesas.fecha, '%Y-%m-%d') BETWEEN :fechaInicial AND :fechaFinal");
        $stmt->bindParam(":fechaInicial", $fechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
         
        $stmt -> execute();
        return $stmt -> fetchAll();
        
        $stmt->close();   

        $stmt = null;
    }
    static public function apiReportemontoTotalesRando($fechaInicio,$fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT SUM(total_envio) AS total,iso_moneda,simbolo_moneda FROM remesas WHERE DATE_FORMAT(remesas.fecha, '%Y-%m-%d') BETWEEN :fechaInicial AND :fechaFinal GROUP BY iso_moneda");
        $stmt->bindParam(":fechaInicial", $fechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }
    static public function apiReportemontoTotales(){
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;
        $stmt = Conexion::conectar()->prepare("SELECT SUM(total_envio)AS total,iso_moneda,simbolo_moneda FROM remesas WHERE DATE_FORMAT(remesas.fecha, '%Y-%m-%d') =DATE_FORMAT(:fecha, '%Y-%m-%d') GROUP BY iso_moneda");
        $stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }
    static public function apiReporteremesaTotales(){
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;
        $stmt = Conexion::conectar()->prepare("SELECT SUM(total_remesa) AS total,iso_tasa,simbolo_tasa FROM remesas WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = DATE_FORMAT(:fecha, '%Y-%m-%d')  GROUP BY iso_tasa");
        $stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }
    static public function apiReporteremesaTotalesRango($fechaInicio,$fechaFinal){
      
        $stmt = Conexion::conectar()->prepare("SELECT SUM(total_remesa) AS total,iso_tasa,simbolo_tasa FROM remesas WHERE DATE_FORMAT(remesas.fecha, '%Y-%m-%d') BETWEEN :fechaInicial AND :fechaFinal  GROUP BY iso_tasa");
        $stmt->bindParam(":fechaInicial", $fechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }
    static public function apiReporteremesaComision(){
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;
        $stmt = Conexion::conectar()->prepare("SELECT sum(monto) AS monto_comision,simbolo,iso FROM movimientos_bancarios 
        LEFT JOIN cuenta_banco_vene ON movimientos_bancarios.cuenta_banco_vene_id = cuenta_banco_vene.id
        LEFT JOIN saldo_cuenta_vene ON cuenta_banco_vene.id = saldo_cuenta_vene.cuenta_id
        LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id
        WHERE operacion IN  ('Comisión por Transferencia Bancaria Digital','Comisión pago movil') and DATE_FORMAT(movimientos_bancarios.created_at, '%Y-%m-%d') = DATE_FORMAT(:fecha, '%Y-%m-%d') GROUP BY iso ");
        $stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }
    static public function apiReporteremesaComisionRango($fechaInicio,$fechaFinal){
  
        $stmt = Conexion::conectar()->prepare("SELECT sum(monto) AS monto_comision,simbolo,iso FROM movimientos_bancarios 
        LEFT JOIN cuenta_banco_vene ON movimientos_bancarios.cuenta_banco_vene_id = cuenta_banco_vene.id
        LEFT JOIN saldo_cuenta_vene ON cuenta_banco_vene.id = saldo_cuenta_vene.cuenta_id
        LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id
        WHERE operacion IN  ('Comisión por Transferencia Bancaria Digital','Comisión pago movil') and  DATE_FORMAT(movimientos_bancarios.created_at, '%Y-%m-%d') BETWEEN :fechaInicial AND :fechaFinal  GROUP BY iso ");
       $stmt->bindParam(":fechaInicial", $fechaInicio, PDO::PARAM_STR);
       $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }

}