<?php

class PagosController{


//mostrar monedas en la tabla
static public function ctrMostrarPagos($item,$valor,$info){
    $tabla = 'remesas';
            
    $respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor,$info);

    return $respuesta;
}
//mostrar monedas en la tabla
static public function ctrMostrarCreditos($item,$valor,$info){
    $tabla = 'pagos';
            
    $respuesta = ModeloPagos::mdlMostrarCreditos($tabla, $item, $valor,$info);

    return $respuesta;
}


//mostrar pagos Procesados
static public function ctrMostrarPagosProcesados($item,$valor){
    $tabla = 'remesas';
            
    $respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

    return $respuesta;
}
    

}


