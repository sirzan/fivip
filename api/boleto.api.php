<?php
require_once '../controllers/boletos.controller.php';
require_once '../models/boletos.model.php';
require_once '../models/pagos-boletos.model.php';

require_once "../controllers/moneda.controller.php";
require_once "../models/moneda.model.php";
require_once "../controllers/cuenta-banco-inter.controller.php";
require_once "../controllers/cuenta-banco-vene.controller.php";
require_once "../controllers/saldo-cuenta-inter.controller.php";
require_once "../controllers/saldo-cuenta-vene.controller.php";
require_once "../models/saldo-cuenta-inter.model.php";
require_once "../models/saldo-cuenta-vene.model.php";
require_once "../models/cuenta-banco-inter.model.php";
require_once "../models/cuenta-banco-vene.model.php";
require_once "../models/movimientos-bancarios.model.php";

class ApiBoleto{

    public $boleto;

     public function apiBoletoIngreso(){
       $datos = $this->boleto;
      // echo json_encode($datos['datos']);
       $respuesta= BoletosController::ingresarBoletos($datos);
     echo json_encode($respuesta);
    }

}

if (isset($_POST)) {
   $ingreso = new ApiBoleto();
   $ingreso->boleto = $_POST;
   $ingreso->apiBoletoIngreso();
}