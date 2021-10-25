<?php
    
    require_once "../controllers/boletos.controller.php";
    require_once "../models/boletos.model.php";

class ApiBoletosSelect
{
    
//editar cliente
    public $idBoleto;

    public function apiBorrarBoleto(){
    
        $item = "id";
        $valor = $this->idBoleto;
        $respuesta = BoletosController::ctrMostrarBoleto($item,$valor);
        echo json_encode($respuesta);
    
    }
    
    public function apiListaBoletos(){
    
        $item = null;
        $valor = null;
        $respuesta = BoletosController::ctrMostrarBoleto($item,$valor);
        $arreglo['data']=$respuesta;
        echo json_encode($arreglo);
    
    }
    
    public function apiListaBoletosCreditos(){
        
        $item = null;
        $valor = null;
        $respuesta = BoletosController::ctrMostrarBoletoCredito($item,$valor);
        $arreglo['data']=$respuesta;
        echo json_encode($arreglo);
    
    }
    
    public function apiIdBoletosCreditos(){
        
        $item = "boleto_id";
        $valor = $this->idBoleto;
        $respuesta = BoletosController::ctrMostrarBoletoCredito($item,$valor);
        echo json_encode($respuesta);

    }


}

//editar cliente
if (isset($_POST['idBoleto'])) {

    $id = new ApiBoletosSelect;
    $id -> idBoleto = $_POST["idBoleto"];
    $id ->apiBorrarBoleto();

}else if(isset($_POST['all'])){

    $all = new ApiBoletosSelect;
    $all ->apiListaBoletos();

}else if(isset($_POST['credito'])){

    $all = new ApiBoletosSelect;
    $all ->apiListaBoletosCreditos();

}else if(isset($_POST['idCredito'])){

    $all = new ApiBoletosSelect;
    $all->idBoleto = $_POST["idCredito"];
    $all->apiIdBoletosCreditos();

}