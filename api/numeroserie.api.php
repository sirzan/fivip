<?php
require_once '../models/conexion.php';

try {
    $info=$_POST['info'];

        
    $stmt = Conexion::conectar($info)->prepare("SELECT correlativo FROM remesas ORDER BY ID DESC LIMIT 1");
    // $stmt->bindParam(":id", $_POST['bancoselect'], PDO::PARAM_STR);
    $stmt->execute();
    $bancoselect = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    echo json_encode($bancoselect);
    exit();

} catch (\Throwable $th) {

    echo "Mensaje de error: ".$th->getMessage();
}
