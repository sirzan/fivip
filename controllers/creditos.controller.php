
 <?php

class CreditosController{

    //mostrar monedas en la tabla
  static public function ctrMostrarCreditos($item,$valor){
      $tabla = 'pagos';
      $respuesta = ModeloCredito::mdlMostrarCreditos($tabla, $item, $valor);
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
            $respuesta = PagosPModel::mdlIngresarPagos($tabla,$val);
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
               array_push($saldoEntrada,CuentaBancoInterController::ctrMostrarCuenta($item_inter_entrada, $datos[$i]['banco']));
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
                                "operacion" => "Abono de Remesa a crédito",
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
                $sumarsaldo = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_saldo_inter_entrada,$value ); 
            }


            //movimientos//
            foreach ($movimientoDataEntrada as $value) {
                $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
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
               array_push($saldoEntrada,CuentaBancoVeneController::ctrMostrarCuenta($item_inter_entrada, $datos[$i]['banco']));
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
                                "operacion" => "Abono de Remesa a crédito",
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
                $sumarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_saldo_vene_entrada,$value ); 
            }

    
            //movimientos//
            foreach ($movimientoDataEntrada as $value) {
                $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
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
            $respuesta2 = PagosPModel::mdlEditarRemesaEstado($tablaRemesa, $estadoRemesa);
        }
        return $respuesta;

  }

  



}