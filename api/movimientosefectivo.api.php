<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT pagos.id,metodo_p,simbolo_moneda,monto,iso_moneda,signo,correlativo FROM pagos LEFT JOIN remesas ON pagos.remesas_id = remesas.id WHERE metodo_p = 'Efectivo'");
$stmt->execute();
$monedas = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($monedas);
exit();