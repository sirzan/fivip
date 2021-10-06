
<?php
require_once "../controllers/creditos.controller.php";
require_once "../models/creditos.model.php";
class ApiCredito
{
    
//editar cliente
    public $idCredito;

    public function apiMostrarCredito(){
        $item = "remesas_id";
        $valor = $this->idCredito;
        $respuesta = CreditosController::ctrMostrarCreditos($item,$valor);
        echo json_encode($respuesta);
    }


}

//editar cliente
if (isset($_POST['idPagos'])) {
    $editar = new ApiCredito;
    $editar -> idCredito = $_POST["idPagos"];
    $editar ->apiMostrarCredito();
}