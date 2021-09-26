<?php
require_once "../controllers/moneda.controller.php";
require_once "../models/moneda.model.php";
class ApiMonedas
{
    
//editar moneda
    public $idMoneda;

    public function apiEditarMoneda(){
        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = MonedaController::ctrMostrarMonedas($item,$valor);
        echo json_encode($respuesta);
    }


    //validar moneda
    public $validarMoneda;

    public function apiValidarMoneda(){
         $item = "moneda";
         $valor = $this->validarMoneda;
         $respuesta = MonedaController::ctrMostrarMonedas($item,$valor);
         echo json_encode($respuesta);
     }

 
   
}

//editar moneda
if (isset($_POST['idMoneda'])) {
    $editar = new ApiMonedas;
    $editar -> idUsuario = $_POST["idMoneda"];
    $editar ->apiEditarMoneda();
}

//validar moneda

if(isset($_POST['validarMoneda'])){

    $activarUsuario = new ApiMonedas();
    $activarUsuario->validarMoneda = $_POST["validarMoneda"];
    $activarUsuario->apiValidarMoneda();

}