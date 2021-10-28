<?php

require_once "../controllers/remesas.controller.php";
require_once "../models/remesas.model.php";


class ApiRemesas{

	public $info;

	public function listaremesas(){
		$item=null;
		$valor=null;
		$info=$this->info;
		$remesas = RemesasController::ctrMostrarRemesas($item, $valor,$info);
		$respuesta['data']=$remesas;
		echo json_encode($respuesta);
	}
}
if (isset($_POST['remesas'])) {
	$remesas = new ApiRemesas();
	$remesas->info=$_POST['info'];
	$remesas->listaremesas();
}
