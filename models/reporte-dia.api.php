<?php
require_once 'conexion.php';
           

class ReporteDia{

    static public function apiReporte(){
        date_default_timezone_set('America/Lima');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;
        $stmt = Conexion::conectar()->prepare("SELECT id,correlativo,pais,nombre_moneda,iso_moneda,simbolo_moneda,total_envio,tasa,total_remesa,iso_tasa,simbolo_tasa FROM remesas WHERE DATE_FORMAT(remesas.fecha, '%Y-%m-%d') = DATE_FORMAT(:fecha, '%Y-%m-%d')");
        $stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
         
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

}