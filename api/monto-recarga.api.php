<?php
require_once "../controllers/recargas.controller.php";
require_once "../models/recargas.model.php";
class ApiMontoR
{
    
//editar tasa
    public $idMontoR;

    public function apiEditarRecarga(){
        $item = "id";
        $valor = $this->idMontoR;
        $respuesta = ControladorMontoRecargas::ctrMostrarMontoRecarga($item,$valor);
        echo json_encode($respuesta);
    }
   
}

//editar moneda
if (isset($_POST['idMontoR'])) {
    $editar = new ApiMontoR;
    $editar -> idMontoR = $_POST["idMontoR"];
    $editar ->apiEditarRecarga();
}



