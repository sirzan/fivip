<?php
require_once "../controllers/creditos.controller.php";
require_once "../models/creditos.model.php";
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

class ApiCredito{
    public $respuesPost;

    public function apiIngresoCredito(){
        $data = $this->respuesPost;
        $respuesta = CreditosController::ctrIngresarAbono($data);
        echo json_encode($respuesta);

    }

}
if (isset($_POST)) {
    $credito = new ApiCredito();
    $credito->respuesPost = $_POST;
    $credito->apiIngresoCredito();
}
