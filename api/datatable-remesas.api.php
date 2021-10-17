<?php
session_start();

require_once "../controllers/remesas.controller.php";
require_once "../models/remesas.model.php";





class TablaRemesas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaRemesas(){

		$item = null;
    	$valor = null;

  		$remesas = RemesasController::ctrMostrarRemesas($item, $valor);
	

			  if(count($remesas) == 0){
	
				  echo '{"data": []}';
	
				  return;
			  }	
			
			  $datosJson = '{
			  "data": [';
	
			  for($i = 0; $i < count($remesas); $i++){
				if ($_SESSION["rol"] == 'administrador') {
					if($_SESSION["rol"] == 'administrador'){
	  
						$botones =  "<div class='btn-group'><button class='btn btn-primary btnVer' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-eye'></i></button><div class='btn-group'><button class='btn btn-success btnImprimirFactura' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-file-pdf'></i></button><button class='btn btn-danger btnEliminarRemesas' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-trash-alt'></i></button></div>"; 
					  }else{
						  $botones =  "<div class='btn-group'><button class='btn btn-primary btnVer' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-eye'></i></button><div class='btn-group'><button class='btn btn-success btnImprimirFactura' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-file-pdf'></i></button></div>"; 
					  }
					  if($remesas[$i]["estado"] == 1){
						$estado = "<span class='badge badge-success'>Procesado</span>";
					}else if($remesas[$i]["estado"] == -1){
						$estado = "<span class='badge badge-warning'>Crédito</span>";
					}else {
						$estado = "<span class='badge badge-secondary'>Sin verificar</span>";
					}
		  
					  
					   $datosJson .='[
						   "'.$remesas[$i]["id"].'",
						   "'.$remesas[$i]["correlativo"].'",
						   "'.$remesas[$i]["CONCAT(nombres,' ',apellidos)"].'",
						   "'.$remesas[$i]["rol"].'",
						   "'.$remesas[$i]["pais"].'",
						   "'.number_format(bcdiv($remesas[$i]["tasa"],'1',4),4,',','.').' '.$remesas[$i]["simbolo_tasa"].'",
						   "'.number_format(bcdiv($remesas[$i]["total_envio"],'1',2),2,',','.').' '.$remesas[$i]["simbolo_moneda"].'",
						   "'.number_format(bcdiv($remesas[$i]["total_remesa"],'1',2),2,',','.').' '.$remesas[$i]["simbolo_tasa"].'",
						   "'.$remesas[$i]["fecha"].'",
						   "'.$estado.'",
		 
						   "'.$botones.'"
						 ],';
				}else {
					# code...
					if ($_SESSION["id"]== $remesas[$i]["id_user"]){
	
						# code...
						/*=============================================
						TRAEMOS LAS ACCIONES
						=============================================*/ 
					  
		  
						if($_SESSION["rol"] == 'administrador'){
		  
							$botones =  "<div class='btn-group'><button class='btn btn-primary btnVer' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-eye'></i></button><div class='btn-group'><button class='btn btn-success btnImprimirFactura' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-file-pdf'></i></button><button class='btn btn-danger btnEliminarRemesas' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-trash-alt'></i></button></div>"; 
						  }else{
							  $botones =  "<div class='btn-group'><button class='btn btn-primary btnVer' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-eye'></i></button><div class='btn-group'><button class='btn btn-success btnImprimirFactura' idRemesa='".$remesas[$i]["id"]."'><i class='fas fa-file-pdf'></i></button></div>"; 
						  }
					  
		  
							if($remesas[$i]["estado"] == 1){
								$estado = "<span class='badge badge-success'>Procesado</span>";
							}else if($remesas[$i]["estado"] == -1){
								$estado = "<span class='badge badge-warning'>Crédito</span>";
							}else {
								$estado = "<span class='badge badge-secondary'>Sin verificar</span>";
							}
			  
						  
						   $datosJson .='[
							   "'.$remesas[$i]["id"].'",
							   "'.$remesas[$i]["correlativo"].'",
							   "'.$remesas[$i]["CONCAT(nombres,' ',apellidos)"].'",
							   "'.$remesas[$i]["rol"].'",
							   "'.$remesas[$i]["pais"].'",
							   "'.number_format(bcdiv($remesas[$i]["tasa"],'1',4),4,',','.').' '.$remesas[$i]["simbolo_tasa"].'",
							   "'.number_format(bcdiv($remesas[$i]["total_envio"],'1',2),2,',','.').' '.$remesas[$i]["simbolo_moneda"].'",
							   "'.number_format(bcdiv($remesas[$i]["total_remesa"],'1',2),2,',','.').' '.$remesas[$i]["simbolo_tasa"].'",
							   "'.$remesas[$i]["fecha"].'",
							   "'.$estado.'",
			 
							   "'.$botones.'"
							 ],';
					}else {
						$datosJson .='[
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							""
						],';
					}
					
				}
				
				 
	
			  }
	
			  $datosJson = substr($datosJson, 0, -1);
	
			 $datosJson .=   '] 
	
			 }';
			
			echo $datosJson;
		  


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaRemesas();
$activarProductos -> mostrarTablaRemesas();

