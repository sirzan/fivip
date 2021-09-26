<?php
require_once 'conexion.php';

class ReporteDia{

    static public function apiReporte(){

        $stmt = Conexion::conectar()->prepare("SELECT id,correlativo,pais,nombre_moneda,iso_moneda,simbolo_moneda,total_envio,tasa,total_remesa,iso_tasa,simbolo_tasa FROM remesas WHERE DATE_FORMAT(remesas.created_at, '%Y-%m-%d') = CURDATE()");
         
        $stmt -> execute();
        return $stmt -> fetchAll();
        
        $stmt->close();   

        $stmt = null;
    }
    static public function apiReportemontoTotales(){

        $stmt = Conexion::conectar()->prepare("SELECT SUM(total_envio)AS total,iso_moneda,simbolo_moneda FROM remesas WHERE DATE_FORMAT(remesas.created_at, '%Y-%m-%d') = CURDATE() GROUP BY iso_moneda");
         
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }
    static public function apiReporteremesaTotales(){

        $stmt = Conexion::conectar()->prepare("SELECT SUM(total_remesa) AS total,iso_tasa,simbolo_tasa FROM remesas WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE()  GROUP BY iso_tasa");
         
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt->close();   

        $stmt = null;
    }

}