<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT * FROM banco_vene");
$stmt->execute();
$bancoselect = $stmt-> fetchAll();


echo json_encode($bancoselect);
exit();