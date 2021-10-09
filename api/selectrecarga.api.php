<?php
require_once "../controllers/recargas.controller.php";
require_once "../models/recargas.model.php";
class ApiMontoR
{
    
//editar tasa
    public $idMontoR;

    public function apiEditarRecarga(){
        $item = null;
        $valor = null;
        $respuesta = ControladorMontoRecargas::ctrMostrarMontoRecarga($item,$valor);
        echo json_encode($respuesta);
    }
   
}

    $editar = new ApiMontoR;
    $editar ->apiEditarRecarga();

