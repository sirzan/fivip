<?php
require_once "../controllers/pagos.controller.php";
require_once "../models/pagos.model.php";
class ApiTasa
{
    
//editar tasa
    public $idPagos;

    public function apiPagar(){
        $item = "id";
        $valor = $this->idPagos;
        $respuesta = PagosController::ctrMostrarPagos($item,$valor);
        echo json_encode($respuesta);
    }
   
}

//editar moneda
if (isset($_POST['idPagos'])) {
    $editar = new ApiTasa;
    $editar -> idPagos = $_POST["idPagos"];
    $editar ->apiPagar();
}
