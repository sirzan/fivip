<?php
require_once '../models/conexion.php';

// Obtener registros
date_default_timezone_set('America/Lima');

$fecha = date('Y-m-d');
$hora = date('H:i:s');

$fechaActual = $fecha.' '.$hora;
$stmt = Conexion::conectar()->prepare("SELECT count(id) AS remesa FROM remesas WHERE DATE_FORMAT(remesas.fecha, '%Y-%m-%d') =DATE_FORMAT(:fecha, '%Y-%m-%d')");
$stmt->bindParam(":fecha", $fechaActual, PDO::PARAM_STR);
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();