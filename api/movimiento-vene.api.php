<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar($_POST["info"])->prepare("SELECT T1.id,T1.cuenta_banco_vene_id,T2.nombre,T2.n_titular,T2.a_titular,T3.simbolo,T1.monto,T3.iso,T1.monto_actual,T1.operacion,signo,T1.created_at FROM 
(SELECT * from movimientos_bancarios)T1 LEFT JOIN (SELECT cuenta_banco_vene.id,n_titular,a_titular,nombre FROM cuenta_banco_vene LEFT JOIN banco_vene ON cuenta_banco_vene.banco_id = banco_vene.id)T2 ON T1.cuenta_banco_vene_id = T2.id
LEFT JOIN (SELECT saldo_cuenta_vene.id,cuenta_id,simbolo,iso FROM saldo_cuenta_vene LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id)T3 ON T2.id = T3.cuenta_id
WHERE cuenta_banco_vene_id = :id");
$stmt->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
$stmt->execute();
$movimientosVene = $stmt->fetchAll(PDO::FETCH_ASSOC);

$arreglo['data']=$movimientosVene;
echo json_encode($arreglo);

exit();