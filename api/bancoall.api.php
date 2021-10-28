<?php
require_once '../models/conexion.php';

try {
  // Obtener registros
$stmt = Conexion::conectar($_POST['info'])->prepare("SELECT * FROM banco_inter");
$stmt->execute();
$bancoselect = $stmt-> fetchAll(PDO::FETCH_ASSOC);


echo json_encode($bancoselect);
exit();
} catch (\Throwable $th) {
  echo "Mensaje de error: ".$th->getMessage();
}
