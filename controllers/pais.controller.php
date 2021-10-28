<?php

class PaisController{
        //mostrar Bancos de venezuela
        static public function ctrMostrarApiPais($data){
            $tabla = 'pais';
                    
            $respuesta = PaisModel::mdlMostrarPais($tabla, $data);
    
            return $respuesta;
        }
}

