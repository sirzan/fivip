<?php
require_once '../models/conexion.php';

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT T1.created_at,T2.nombre AS banco,T2.n_titular,T2.a_titular,T4.nombre AS banco_transfer,T4.n_titular AS n_transfer,T4.a_titular AS a_transfer,T3.nombre AS banco_inter,T3.n_titular_inter,T3.a_titular_inter,
CONCAT(T2.simbolo,'',T1.monto)AS monto,CONCAT(T3.simbolo,'',T1.monto) AS monto_inter,CONCAT(T4.simbolo,'',T1.monto) AS monto_transfer,T1.operacion,T1.signo

FROM (SELECT * FROM movimientos_bancarios)T1 

left JOIN (SELECT cuenta_banco_vene.id,n_titular,a_titular,nombre,moneda,simbolo,iso FROM saldo_cuenta_vene  
            LEFT JOIN cuenta_banco_vene ON saldo_cuenta_vene.cuenta_id = cuenta_banco_vene.id
            LEFT JOIN banco_vene ON  cuenta_banco_vene.banco_id = banco_vene.id
            LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id)T2 ON T1.cuenta_banco_vene_id = T2.id
 left JOIN (SELECT cuenta_banco_vene.id,n_titular,a_titular,nombre,moneda,simbolo,iso FROM saldo_cuenta_vene  
            LEFT JOIN cuenta_banco_vene ON saldo_cuenta_vene.cuenta_id = cuenta_banco_vene.id
            LEFT JOIN banco_vene ON  cuenta_banco_vene.banco_id = banco_vene.id
            LEFT JOIN monedas ON saldo_cuenta_vene.moneda_id = monedas.id)T4 ON T1.c_transfer_vene_id = T4.id
left JOIN (SELECT cuenta_banco_inter.id,n_titular_inter,a_titular_inter,nombre,moneda,simbolo,iso FROM saldo_cuenta_inter  
            LEFT JOIN cuenta_banco_inter ON saldo_cuenta_inter.cuenta_inter_id = cuenta_banco_inter.id
            LEFT JOIN banco_inter ON  cuenta_banco_inter.banco_inter_id = banco_inter.id
            LEFT JOIN monedas ON saldo_cuenta_inter.moneda_inter_id = monedas.id)T3 ON T1.cuenta_banco_inter_id = T3.id 
            ORDER BY T1.created_at DESC LIMIT 300");
$stmt->execute();
$monedas = $stmt->fetchAll();


echo json_encode($monedas);
exit();