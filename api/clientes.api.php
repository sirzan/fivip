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
        $data=$valor['data'];
        $idCliente=$valor['idCliente'];
        $respuesta = ClientesController::ctrMostrarClientes($item,$idCliente,$data);
        echo json_encode($respuesta);
    }


}

//editar cliente
if (isset($_POST['idCliente'])) {
    $editar = new ApiClientes;
    $editar -> idCliente = $_POST;
    $editar ->apiEditarClientes();
}

