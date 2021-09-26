<?php
require_once "../controllers/clientes.controller.php";
require_once "../models/clientes.model.php";
class ApiClientes
{
    
//editar cliente
    public $idCliente;

    public function apiEditarClientes(){
        $item = "id";
        $valor = $this->idCliente;
        $respuesta = ClientesController::ctrMostrarClientes($item,$valor);
        echo json_encode($respuesta);
    }


}

//editar cliente
if (isset($_POST['idCliente'])) {
    $editar = new ApiClientes;
    $editar -> idCliente = $_POST["idCliente"];
    $editar ->apiEditarClientes();
}

