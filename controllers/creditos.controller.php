
 <?php

class CreditosController{

    //mostrar monedas en la tabla
  static public function ctrMostrarCreditos($item,$valor,$info){
      $tabla = 'pagos';
      $respuesta = ModeloCredito::mdlMostrarCreditos($tabla, $item, $valor,$info);
      return $respuesta;
        }
  
  // ingresar credito

  static public function ctrIngresarAbono($data){


            $tablaRemesa = 'remesas';
            $tabla='pagos';
            $tabla_movi = 'movimientos_bancarios';
            $datos = json_decode($data['metodo'], true);
            $valor=[];

        ///////////////////////
          //ingreso de pago//
        ///////////////////////
        foreach ($datos as $dato) {
                    
            array_push($valor,array(
                "cuenta_vene_id" => ($dato['tipoBanco'] == 'inter')?null:$dato['banco'],
                "cuenta_inter_id"=>($dato['tipoBanco'] == 'inter')?$dato['banco']:null,
                "monto"=>$dato['monto'],
                "n_ope"=>$dato['nOperacion'],
                "metodo_p"=>$dato['metodo'],
                "remesas_id"=>$dato['id_remesa'],
                "signo" =>'+'
            ));
        }
 
        foreach ($valor as $val) {
            $respuesta = PagosPModel::mdlIngresarPagos($tabla,$val,$data['info']);
        }
    
        
        ///////////////////////
          //ingreso de pago end//
        ///////////////////////
          ///////////////////////////////////
        //sumar de cuanta que deposito  //
        //////////////////////////////////

        if ($data['tipoBancoEntrada'] == "inter") {
            $tabla_saldo_inter_entrada = 'saldo_cuenta_inter';
            $item_inter_entrada ='id';
            $saldoEntrada=array();
            $saldoIngreso=[];
            $movimientoDataEntrada=[];
            //interar array para consulta saldo
            $d=count($datos);
            for ($i=0; $i < $d; $i++) { 
               array_push($saldoEntrada,CuentaBancoInterController::ctrMostrarCuenta($item_inter_entrada, $datos[$i]['banco'],$data['info']));
                for ($v=0; $v< count($saldoEntrada); $v++) { 
                    if (isset($saldoEntrada[$v]['id_saldo'])) {
                    if ($saldoEntrada[$v]['cuenta_inter_id'] == $datos[$i]['banco']) {
                        # code...
                            $saldoIngreso[]= [ "id" => $saldoEntrada[$v]['id_saldo'],
                            "saldo_inter" =>$saldoEntrada[$v]['saldo_inter']+$datos[$i]['monto']
                               ] ;

                               $movimientoDataEntrada[]=[
                                'id_cuenta'=>  null,
                                "monto" => $datos[$i]['monto'],
                                "monto_actual" => $saldoEntrada[$v]['saldo_inter']+$datos[$i]['monto'],
                                "operacion" => "Abono de Remesa a cr??dito",
                                "c_transfer_vene_id" => null,
                                "pago_remesa_id" =>  $datos[$i]['id_remesa'],
                                "cuenta_banco_inter_id" =>  $saldoEntrada[$v]['cuenta_inter_id'],
                                "signo" =>  '+'
                            ] ;
            
                     
                            
                    
                        }
                    }
                 }
            }
            foreach ($saldoIngreso as $value) {
                $sumarsaldo = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_saldo_inter_entrada,$value ,$data['info']); 
            }


            //movimientos//
            foreach ($movimientoDataEntrada as $value) {
                $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value,$data['info']);
            }


        }else if($data['tipoBancoEntrada'] == "vene") {
            $tabla_saldo_vene_entrada = 'saldo_cuenta_vene';
            $item_inter_entrada ='id';
            $saldoEntrada=array();
            $saldoIngreso=[];
            $movimientoDataEntrada=[];
            //interar array para consulta saldo
            $d=count($datos);
            for ($i=0; $i < $d; $i++) { 
               array_push($saldoEntrada,CuentaBancoVeneController::ctrMostrarCuenta($item_inter_entrada, $datos[$i]['banco'],$data['info']));
                for ($v=0; $v< count($saldoEntrada); $v++) { 
                    if (isset($saldoEntrada[$v]['id_saldo'])) {
                    if ($saldoEntrada[$v]['cuenta_id'] == $datos[$i]['banco']) {
                        # code...
                            $saldoIngreso[]= [ "id" => $saldoEntrada[$v]['id_saldo'],
                                     "saldo" =>$saldoEntrada[$v]['saldo']+$datos[$i]['monto']
                               ] ;

                               $movimientoDataEntrada[]=[
                                'id_cuenta'=>  $saldoEntrada[$v]['id_cuenta'],
                                "monto" => $datos[$i]['monto'],
                                "monto_actual" => $saldoEntrada[$v]['saldo']+$datos[$i]['monto'],
                                "operacion" => "Abono de Remesa a cr??dito",
                                "c_transfer_vene_id" => null,
                                "pago_remesa_id" =>  $data['remesa_id'],
                                "cuenta_banco_inter_id" => null,
                                "signo" =>  '+'
                            ] ;
            
                        }
                    }
                 }
            }
            foreach ($saldoIngreso as $value) {
                $sumarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_saldo_vene_entrada,$value,$data['info'] ); 
            }

    
            //movimientos//
            foreach ($movimientoDataEntrada as $value) {
                $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value,$data['info']);
            }

        }

///////////////////////////////////
    //sumar de cuanta que deposito end //
    //////////////////////////////////
        if ($data['abonocompleto'] == 0) {
            $estadoRemesa = array(
                "id" =>  $data['id_remesa'],
                "estado" => 1
            );
            $respuesta2 = PagosPModel::mdlEditarRemesaEstado($tablaRemesa, $estadoRemesa,$data['info']);
        }
        return $respuesta;

  }


  // ingresar credito boleto

  static public function ctrIngresarAbonoBoleto($data){


            $tablaBoleto = 'boletos';
            $tabla='pagos_boletos';
            $tabla_movi = 'movimientos_bancarios';
            $datos = json_decode($data, true);;
            $metodo = json_decode( $datos[0]['metodo'], true);
            $valor=[];

//         ///////////////////////
//           //ingreso de pago//
//         ///////////////////////
        foreach ($metodo as $dato) {
                    
    
            array_push($valor,array(
                "cuenta_vene_id" => ($dato['tipoBanco'] == 'inter')?null:$dato['banco'],
                "cuenta_inter_id"=>($dato['tipoBanco'] == 'inter')?$dato['banco']:null,
                "monto"=>$dato['monto'],
                "n_ope"=>$dato['nOperacion'],
                "metodo_p"=>$dato['metodo'],
                "boleto_id"=>$dato['id_remesa'],
                "signo" =>'+'
            ));
        }
 
        foreach ($valor as $val) {
          $respuesta=  PagoBoletoModel::mdlIngresar($tabla,$val);
        }
    
        
//         ///////////////////////
//           //ingreso de pago end//
//         ///////////////////////
//           ///////////////////////////////////
//         //sumar de cuanta que deposito  //
//         //////////////////////////////////

        if ($datos[0]['tipoBancoEntrada'] == "inter") {
            $tabla_saldo_inter_entrada = 'saldo_cuenta_inter';
            $item_inter_entrada ='id';
            $saldoEntrada=array();
            $saldoIngreso=[];
            $movimientoDataEntrada=[];
            //interar array para consulta saldo
            $d=count($metodo);
            for ($i=0; $i < $d; $i++) { 
               array_push($saldoEntrada,CuentaBancoInterController::ctrMostrarCuenta($item_inter_entrada, $metodo[$i]['banco']));
                for ($v=0; $v< count($saldoEntrada); $v++) { 
                    if (isset($saldoEntrada[$v]['id_saldo'])) {
                    if ($saldoEntrada[$v]['cuenta_inter_id'] ==  $metodo[$i]['banco']) {
                        # code...
                            $saldoIngreso[]= [ "id" => $saldoEntrada[$v]['id_saldo'],
                            "saldo_inter" =>$saldoEntrada[$v]['saldo_inter']+ $metodo[$i]['monto']
                               ] ;

                               $movimientoDataEntrada[]=[
                                'id_cuenta'=>  null,
                                "monto" =>  $metodo[$i]['monto'],
                                "monto_actual" => $saldoEntrada[$v]['saldo_inter']+ $metodo[$i]['monto'],
                                "operacion" => "Abono de Boleto (viaje) a cr??dito",
                                "c_transfer_vene_id" => null,
                                "pago_remesa_id" =>  null,
                                "boleto_id" => $datos[0]['boleto_id'],
                                "cuenta_banco_inter_id" =>  $saldoEntrada[$v]['cuenta_inter_id'],
                                "signo" =>  '+'
                            ] ;
            
                     
                            
                    
                        }
                    }
                 }
            }
            foreach ($saldoIngreso as $value) {
                $sumarsaldo = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_saldo_inter_entrada,$value ); 
            }


            //movimientos//
            foreach ($movimientoDataEntrada as $value) {
                $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
            }


        }else if($datos[0]['tipoBancoEntrada'] == "vene") {
            $tabla_saldo_vene_entrada = 'saldo_cuenta_vene';
            $item_inter_entrada ='id';
            $saldoEntrada=array();
            $saldoIngreso=[];
            $movimientoDataEntrada=[];
            //interar array para consulta saldo
            $d=count($metodo);
            for ($i=0; $i < $d; $i++) { 
               array_push($saldoEntrada,CuentaBancoVeneController::ctrMostrarCuenta($item_inter_entrada,  $metodo[$i]['banco']));
                for ($v=0; $v< count($saldoEntrada); $v++) { 
                    if (isset($saldoEntrada[$v]['id_saldo'])) {
                    if ($saldoEntrada[$v]['cuenta_id'] ==  $metodo[$i]['banco']) {
                        # code...
                            $saldoIngreso[]= [ "id" => $saldoEntrada[$v]['id_saldo'],
                                     "saldo" =>$saldoEntrada[$v]['saldo']+ $metodo[$i]['monto']
                               ] ;

                               $movimientoDataEntrada[]=[
                                'id_cuenta'=>  $saldoEntrada[$v]['id_cuenta'],
                                "monto" =>  $metodo[$i]['monto'],
                                "monto_actual" => $saldoEntrada[$v]['saldo']+$metodo[$i]['monto'],
                                "operacion" => "Abono de Remesa a cr??dito",
                                "c_transfer_vene_id" => null,
                                "pago_remesa_id" =>  null,
                                "boleto_id" =>   $datos[0]['boleto_id'],
                                "cuenta_banco_inter_id" => null,
                                "signo" =>  '+'
                            ] ;
            
                        }
                    }
                 }
            }
            foreach ($saldoIngreso as $value) {
                $sumarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_saldo_vene_entrada,$value ); 
            }

    
            //movimientos//
            foreach ($movimientoDataEntrada as $value) {
                $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
            }

        }

// ///////////////////////////////////
//     //sumar de cuanta que deposito end //
//     //////////////////////////////////
        if ($datos[0]['abonocompleto'] == 0) {
            $estadoRemesa = array(
                "id" =>  $datos[0]['boleto_id'],
                "estado" => 1
            );
            $respuesta2 = BoletoModal::mdlEditarBoletoEstado($tablaBoleto, $estadoRemesa);
        }
        return  $respuesta;
        // return  $respuesta;

  }

  



}