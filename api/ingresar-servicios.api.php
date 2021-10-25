<?php
require_once "../models/servicios-adicionales.model.php";
class ApiServi
{
    
//editar tasa
    public $servicioA;

    public function apiAgregarS(){
       
        $valor = $this->servicioA;
        $tabla='servicios_adicionales';
        $respuesta = ServiciosModel::mdlIngresar($tabla,$valor);
        echo json_encode($respuesta);
    }
    public function apiMostrar(){
       
     
        $tabla='servicios_adicionales';
        $item=null;
        $valor=null;
        $respuesta = ServiciosModel::mdlMostrar($tabla,$item,$valor);
        echo json_encode($respuesta);
    }
    public function apiEliminar(){
       
        $valor = $this->servicioA;
        $tabla='servicios_adicionales';
   
        $respuesta = ServiciosModel::mdlBorrar($tabla,$valor);
        echo json_encode($respuesta);
    }
   
}

//editar moneda
if (isset($_POST['servicios'])) {
    $agregar = new ApiServi;
    $agregar -> servicioA = $_POST;
    $agregar ->apiAgregarS();
}else if(isset($_POST['mostrar'])){
    $agregar = new ApiServi;
    $agregar ->apiMostrar();
}else if(isset($_POST['eliminar'])){
    $agregar = new ApiServi;
    $agregar -> servicioA = $_POST['eliminar'];
    $agregar ->apiEliminar();
}
