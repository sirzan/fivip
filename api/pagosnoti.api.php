<?php
require_once '../models/conexion.php';

try {
  // Obtener registros
$stmt = Conexion::conectar($_POST['info'])->prepare("SELECT count(id) AS pagos FROM remesas WHERE estado = 0");
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();
} catch (\Throwable $th) {
   echo "Mensaje de error: ".$th->getMessage();
}
