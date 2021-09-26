<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT count(id) AS remesa FROM remesas");
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();