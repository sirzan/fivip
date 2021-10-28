<?php
require_once "../models/servicios-adicionales.model.php";
class ApiServi
{
    
//editar tasa
    public $servicioA;

    public function apiAgregarS(){
       
        $valor = $this->servicioA;
        $idData=$valor['servicios'];
        $info=$valor['info'];
        $tabla='servicios_adicionales';
        $respuesta = ServiciosModel::mdlIngresar($tabla,$valor,$info);
        echo json_encode($respuesta);
    }
    public function apiMostrar(){
       
     
        $tabla='servicios_adicionales';
        $item=null;
        $valor=null;
        $info=$this->servicioA['info'];
        $respuesta = ServiciosModel::mdlMostrar($tabla,$item,$valor,$info);
        echo json_encode($respuesta);
    }
    public function apiEliminar(){
       
        $valor = $this->servicioA;
        $tabla='servicios_adicionales';
        $idData=$valor['eliminar'];
        $info=$valor['info'];
        $respuesta = ServiciosModel::mdlBorrar($tabla,$idData,$info);
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
    $agregar -> servicioA = $_POST;
    $agregar ->apiMostrar();
}else if(isset($_POST['eliminar'])){
    $agregar = new ApiServi;
    $agregar -> servicioA = $_POST;
    $agregar ->apiEliminar();
}
