<?php
require_once "../controllers/tasa.controller.php";
require_once "../models/tasa.model.php";
class ApiTasa
{
    
//editar tasa
    public $idTasa;

    public function apiEditarTasa(){
        $item = "id";
        $valor = $this->idTasa;
        $respuesta = TasaController::ctrMostrarTasa($item,$valor);
        echo json_encode($respuesta);
    }
   
}

//editar moneda
if (isset($_POST['idTasa'])) {
    $editar = new ApiTasa;
    $editar -> idTasa = $_POST["idTasa"];
    $editar ->apiEditarTasa();
}
