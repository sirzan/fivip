<?php
require_once '../models/conexion.php';
try {
    // Obtener registros
$stmt = Conexion::conectar($_POST['info'])->prepare("SELECT count(id) AS remesa FROM remesas");
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();
} catch (\Throwable $th) {
   echo "Mensaje de error: ".$th->getMessage();
}
