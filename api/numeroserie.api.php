<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT correlativo FROM remesas ORDER BY ID DESC LIMIT 1");
// $stmt->bindParam(":id", $_POST['bancoselect'], PDO::PARAM_STR);
$stmt->execute();
$bancoselect = $stmt->fetch();


echo json_encode($bancoselect);
exit();