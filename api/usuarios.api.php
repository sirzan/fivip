<?php
require_once "../controllers/usuarios.controller.php";
require_once "../models/usuario.model.php";
class ApiUsuarios 
{
    

    public $idUsuario;

    public function apiEditarUsuario(){
        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
        echo json_encode($respuesta);
    }

    public $activarId;
    public $activarUsuario;

    public function apiActivarUsuario(){

        $tabla='usuarios';

        $item1='estado';
        $valor1=$this->activarUsuario;

        $item2='id';
        $valor2=$this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

    }

    public $validarUsuario;

   public function apiValidarUsuario(){
        $item = "usuario";
        $valor = $this->validarUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
        echo json_encode($respuesta);
    }
   
}

if (isset($_POST['idUsuario'])) {
    $editar = new ApiUsuarios;
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar ->apiEditarUsuario();
}

//activar usuario

if(isset($_POST['activarUsuario'])){

        $activarUsuario = new ApiUsuarios();
        $activarUsuario->activarUsuario = $_POST["activarUsuario"];
        $activarUsuario->activarId = $_POST["activarId"];
        $activarUsuario->apiActivarUsuario();

}

//validar usuario

if(isset($_POST['validarUsuario'])){

    $activarUsuario = new ApiUsuarios();
    $activarUsuario->validarUsuario = $_POST["validarUsuario"];
    $activarUsuario->apiValidarUsuario();

}