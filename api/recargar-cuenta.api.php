<?php
require_once "../controllers/cuenta-banco-vene.controller.php";
require_once "../models/cuenta-banco-vene.model.php";
class ApiRecargarCuenta
{
    
//editar tasa
    public $idCuenta;

    public function apiRecargar(){
        $item = "id";
        $valor = $this->idCuenta;
        $idcuenta = $valor['idCuenta'];
        $info = $valor['info'];
   
        $respuesta = CuentaBancoVeneController::ctrMostrarCuenta($item,$idcuenta,$info);
        echo json_encode($respuesta);
    }
   
}

//editar moneda
if (isset($_POST['idCuenta'])) {
    $editar = new ApiRecargarCuenta;
    $editar -> idCuenta = $_POST;
    $editar ->apiRecargar();
}

