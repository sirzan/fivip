<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT * FROM banco_vene WHERE nombre = :id");
$stmt->bindParam(":id", $_POST['bancoselect'], PDO::PARAM_STR);
$stmt->execute();
$bancoselect = $stmt->fetch();


echo json_encode($bancoselect);
exit();