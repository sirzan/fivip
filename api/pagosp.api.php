<?php
require_once "../controllers/pagosR.controller.php";
require_once "../models/pagosR.model.php";
require_once "../controllers/cuenta-banco-inter.controller.php";
require_once "../controllers/cuenta-banco-vene.controller.php";
require_once "../controllers/saldo-cuenta-inter.controller.php";
require_once "../controllers/saldo-cuenta-vene.controller.php";
require_once "../models/saldo-cuenta-inter.model.php";
require_once "../models/saldo-cuenta-vene.model.php";
require_once "../models/cuenta-banco-inter.model.php";
require_once "../models/cuenta-banco-vene.model.php";
require_once "../models/movimientos-bancarios.model.php";


class ApiPagos{
    public $respuesPost;

    public function apiIngresoPago(){
        $data = $this->respuesPost;
        $respuesta = PagosPController::ctrIngresarPago($data);
        echo json_encode($respuesta);
        // die(json_encode($data));
    }

}
if (isset($_POST)) {
    # code...
    $activarUsuario = new ApiPagos();
    $activarUsuario->respuesPost = $_POST;
    $activarUsuario->apiIngresoPago();
}

