<?php
require_once '../models/conexion.php';

            date_default_timezone_set('America/Lima');

            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

            $fechaActual = $fecha.' '.$hora;
// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT SUM(total_envio) AS total,simbolo_moneda,iso_moneda FROM remesas WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = DATE_FORMAT(:fecha, '%Y-%m-%d')   GROUP BY iso_moneda ");
$stmt -> bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();