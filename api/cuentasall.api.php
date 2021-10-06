<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT cuenta_banco_vene.id AS id_cuenta,saldo_cuenta_vene.id AS id_saldo,saldo,n_titular,a_titular,banco_id,nombre,moneda_id,moneda,simbolo,iso FROM saldo_cuenta_vene  
left join  cuenta_banco_vene ON saldo_cuenta_vene.cuenta_id =cuenta_banco_vene.id
LEFT JOIN banco_vene ON cuenta_banco_vene.banco_id = banco_vene.id
LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id

UNION ALL 

SELECT cuenta_banco_inter.id AS id_cuenta,saldo_cuenta_inter.id AS id_saldo,saldo_inter,n_titular_inter,a_titular_inter,banco_inter_id,nombre,moneda_inter_id,moneda,simbolo,iso FROM saldo_cuenta_inter 
left join  cuenta_banco_inter ON saldo_cuenta_inter.cuenta_inter_id = cuenta_banco_inter.id
LEFT JOIN banco_inter ON cuenta_banco_inter.banco_inter_id = banco_inter.id
LEFT JOIN monedas ON saldo_cuenta_inter.moneda_inter_id = monedas.id");
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();