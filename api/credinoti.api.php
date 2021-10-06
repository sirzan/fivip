<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT count(id) AS creditos FROM pagos_remesas WHERE metodo_pago_entrada = 'credito'");
$stmt->execute();
$creditos = $stmt->fetchAll();


echo json_encode($creditos);
exit();