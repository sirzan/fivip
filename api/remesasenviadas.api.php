<?php
require_once '../models/conexion.php';
date_default_timezone_set('America/Lima');

$fecha = date('Y-m-d');
$hora = date('H:i:s');

$fechaActual = $fecha.' '.$hora;
// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT SUM(total_remesa) AS total,iso_tasa,simbolo_tasa FROM remesas WHERE DATE_FORMAT(fecha, '%Y-%m-%d') = DATE_FORMAT(:fecha, '%Y-%m-%d')  GROUP BY iso_tasa ");
$stmt -> bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
$stmt->execute();
$remesa = $stmt->fetchAll();


echo json_encode($remesa);
exit();