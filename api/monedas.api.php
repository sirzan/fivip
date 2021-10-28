<?php
require_once "../controllers/moneda.controller.php";
require_once "../models/moneda.model.php";
class ApiMonedas
{
    
//editar moneda
    public $idMoneda;

    public function apiEditarMoneda(){
        $item = "id";
        $valor = $this->idMoneda;
        $info = $valor['info'];
        $idMon = $valor['idMoneda'];
        $respuesta = MonedaController::ctrMostrarMonedas($item,$idMon,$info);
        echo json_encode($respuesta);
    }


    //validar moneda
    public $validarMoneda;

    public function apiValidarMoneda(){
         $item = "moneda";
         $valor = $this->validarMoneda;
         $info=$valor['info'];
         $data=$valor['validarMoneda'];
         $respuesta = MonedaController::ctrMostrarMonedas($item,$data,$info);
         echo json_encode($respuesta);
     }
  
}

//editar moneda
if (isset($_POST['idMoneda'])) {
    $editar = new ApiMonedas;
    $editar -> idMoneda = $_POST;
    $editar ->apiEditarMoneda();
}

//validar moneda

if(isset($_POST['validarMoneda'])){

    $activarUsuario = new ApiMonedas();
    $activarUsuario->validarMoneda = $_POST;
    $activarUsuario->apiValidarMoneda();

}