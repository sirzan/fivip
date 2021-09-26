<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT SUM(total_envio) AS total,simbolo_moneda,iso_moneda FROM remesas WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE()  GROUP BY iso_moneda ");
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();