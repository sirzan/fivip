<?php
require_once "../controllers/banco-inter.controller.php";
require_once "../models/banco-inter.model.php";
class ApiBancoInter
{
    
//editar bancos de 
    public $idBancoInter;

    public function apiEditarBancoInter(){
        $item = "id";
        $valor = $this->idBancoInter;
        $respuesta = BancoInterController::ctrMostrarBancoInter($item,$valor);
        echo json_encode($respuesta);
    }


   
}

if (isset($_POST['idBancoInter'])) {
    $editar = new ApiBancoInter;
    $editar -> idBancoInter = $_POST["idBancoInter"];
    $editar ->apiEditarBancoInter();
}

