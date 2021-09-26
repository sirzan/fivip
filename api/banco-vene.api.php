<?php
require_once "../controllers/banco-vene.controller.php";
require_once "../models/banco-vene.model.php";
class ApiBancoVene
{
    
//editar bancos de venezuela
    public $idBancoVene;

    public function apiEditarBancoVene(){
        $item = "id";
        $valor = $this->idBancoVene;
        $respuesta = BancoVeneController::ctrMostrarBancoVene($item,$valor);
        echo json_encode($respuesta);
    }


   
}

//editar moneda
if (isset($_POST['idBancoVene'])) {
    $editar = new ApiBancoVene;
    $editar -> idBancoVene = $_POST["idBancoVene"];
    $editar ->apiEditarBancoVene();
}

