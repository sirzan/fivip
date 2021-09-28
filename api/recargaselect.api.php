<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT T1.id,T1.operadora,T1.monto,T1.total_recarga,T2.moneda AS moneda_monto,T2.simbolo AS simbolo_monto,T2.iso AS iso_monto,T2.pais,T3.moneda AS moneda_monto_r,T3.simbolo AS simbolo_monto_r,T3.iso AS iso_monto_r,T3.pais AS pais_r,T1.created_at,T2.id AS id_moneda_monto,T3.id AS id_moneda_recarga FROM 
(SELECT * FROM monto_recarga_m)T1 LEFT JOIN (SELECT * from monedas)T2 ON T1.moneda_id = T2.id 
LEFT JOIN (SELECT * from monedas)T3 ON T1.moneda_recarga_id = T3.id
 WHERE T1.id = :id");
$stmt->bindParam(":id", $_POST['recargaselect'], PDO::PARAM_STR);
$stmt->execute();
$recargaselect = $stmt->fetch();


echo json_encode($recargaselect);
exit();