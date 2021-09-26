<?php

class PaisController{
        //mostrar Bancos de venezuela
        static public function ctrMostrarApiPais(){
            $tabla = 'pais';
                    
            $respuesta = PaisModel::mdlMostrarPais($tabla);
    
            return $respuesta;
        }
}