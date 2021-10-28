<?php
require_once '../models/conexion.php';

try {
   // Obtener registros
$stmt = Conexion::conectar($_POST['info'])->prepare("SELECT count(pagos.id) AS creditos, estado FROM pagos left join remesas on pagos.remesas_id =remesas.id WHERE signo ='+' and estado = -1");
$stmt->execute();
$creditos = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($creditos);
exit();
} catch (\Throwable $th) {
    echo "Mensaje de error: ".$th->getMessage();
}
