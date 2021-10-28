<?php
require_once '../models/conexion.php';

try {
    // Obtener registros
$stmt = Conexion::conectar($_POST['info'])->prepare("SELECT * FROM banco_vene WHERE nombre = :id");
$stmt->bindParam(":id", $_POST['bancoselect'], PDO::PARAM_STR);
$stmt->execute();
$bancoselect = $stmt->fetch(PDO::FETCH_ASSOC);


echo json_encode($bancoselect);
exit();
    
} catch (\Throwable $th) {
   echo "Mensaje de error: ".$th->getMessage();
}
