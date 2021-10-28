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
        $info =$valor['info'];
        $data = $valor['idBancoInter'];
        $respuesta = BancoInterController::ctrMostrarBancoInter($item,$data,$info);
        echo json_encode($respuesta);
    }


   
}

if (isset($_POST['idBancoInter'])) {
    $editar = new ApiBancoInter;
    $editar -> idBancoInter = $_POST;
    $editar ->apiEditarBancoInter();
}

