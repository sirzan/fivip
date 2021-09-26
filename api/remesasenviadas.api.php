<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT SUM(total_remesa) AS total,iso_tasa,simbolo_tasa FROM remesas WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE()  GROUP BY iso_tasa ");
$stmt->execute();
$remesa = $stmt->fetchAll();


echo json_encode($remesa);
exit();