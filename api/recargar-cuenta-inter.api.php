<?php
require_once "../controllers/cuenta-banco-inter.controller.php";
require_once "../models/cuenta-banco-inter.model.php";
class ApiRecargarCuenta
{
    
//editar tasa
    public $idCuenta;

    public function apiRecargar(){
        $item = "id";
        $valor = $this->idCuenta;
        $respuesta = CuentaBancoInterController::ctrMostrarCuenta($item,$valor);
        echo json_encode($respuesta);
    }
   
}

//editar moneda
if (isset($_POST['idCuenta'])) {
    $editar = new ApiRecargarCuenta;
    $editar -> idCuenta = $_POST["idCuenta"];
    $editar ->apiRecargar();
}

