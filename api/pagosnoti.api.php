<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT count(id) AS pagos FROM remesas WHERE estado = 0");
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();