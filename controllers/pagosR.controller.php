<?php

class PagosPController{
    ///////////////////////////////////
      //resta de cuanta que transfiere//
      //////////////////////////////////
  static  public function SalidaTransf($data){
        $tabla_movi = 'movimientos_bancarios';

      if ($data['tipoBancoSalida'] == "inter") {
        $tabla_saldo_inter = 'saldo_cuenta_inter';
        $item_inter ='id';
        $valor_inter=$data['BancoTransfer'];
        $saldo = CuentaBancoInterController::ctrMostrarCuenta($item_inter, $valor_inter);
        $t=$saldo['saldo_inter']-$data['monto-salida'];
        $saldo_tranferencia = array(
            "id" =>  $saldo['id_saldo'],
            "saldo_inter" =>$t
        );
  
        $restarsaldo = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_saldo_inter, $saldo_tranferencia); 

        //ingresando movimientos//
        $value=array(//movimeintos
            'id_cuenta'=>  null,
            "monto" => $data['monto-salida'],
            "monto_actual" => $t,
            "operacion" => "Pago de Remesa",
            "c_transfer_vene_id" => null,
            "pago_remesa_id" =>  $data['remesa_id'],
            "cuenta_banco_inter_id" => $saldo['cuenta_inter_id'],
            "signo" =>  '-');
        $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
        //ingresando movimientos end//

}else if ($data['tipoBancoSalida'] == "vene"){
        $tabla_saldo_vene = 'saldo_cuenta_vene';
        $item ='id';
        $valor =$data['BancoTransfer'];
        $saldo = CuentaBancoVeneController::ctrMostrarCuenta($item, $valor);
        if ($data['metodoPagosalida'] == 'transferencia digital' || $data['metodoPagosalida'] == 'pago movil') {
            $comision = $data['monto-salida'] * 0.003;
            $t=($saldo['saldo']-$data['monto-salida']) - bcdiv($comision,'1',2);
        }else {
            $t=($saldo['saldo']-$data['monto-salida']);
        }
        $saldo_tranferencia = array(
            "id" =>  $saldo['id_saldo'],
            "saldo" =>$t
        );   
        $restarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_saldo_vene, $saldo_tranferencia);  
        $movimientoData=[];
        //ingresando movimientos//

        if ($data['metodoPagosalida'] == 'transferencia digital' || $data['metodoPagosalida'] == 'pago movil') {
                $comi = $data['monto-salida'] * 0.003;
            $movimientoData[]=[
                'id_cuenta'=>  $saldo['id_cuenta'],
                "monto" =>   bcdiv($comi,'1',2),
                "monto_actual" => ($saldo['saldo']-$data['monto-salida']) - bcdiv($comi,'1',2),
                "operacion" => ($data['metodoPagosalida'] == 'transferencia digital')?'Comisión por Transferencia Bancaria Digital':'Comisión por Pago Movil',
                'c_transfer_vene_id'=> null,
                "pago_remesa_id" => $data['remesa_id'],
                "cuenta_banco_inter_id" =>  null,
                "signo" =>  '-'
            ] ; 
        }

            $movimientoData[]=[
                'id_cuenta'=>  $saldo['id_cuenta'],
                "monto" => $data['monto-salida'],
                "monto_actual" => $saldo['saldo']-$data['monto-salida'],
                "operacion" => "Pago de Remesa",
                "c_transfer_vene_id" => null,
                "pago_remesa_id" =>  $data['remesa_id'],
                "cuenta_banco_inter_id" =>  null,
                "signo" =>  '-'
            ]   ;

     
            
        foreach ($movimientoData as $value) {
            $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
        }
      
        //ingresando movimientos end//
        
}

    }
///////////////////////////////////////
//resta de cuanta que transfiere end//
//////////////////////////////////////

    ///////////////////////////////////
    //sumar de cuanta que deposito  //
    //////////////////////////////////
 static   public function Ingresopago($data){
        $tabla_movi = 'movimientos_bancarios';
        $datos = json_decode($data['metodo'], true);


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
                            "operacion" => "Cobro de Remesa",
                            "c_transfer_vene_id" => null,
                            "pago_remesa_id" =>  $data['remesa_id'],
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


    }else {
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
                            "operacion" => "Cobro de Remesa",
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

    }


    
///////////////////////////////////
//sumar de cuanta que deposito end //
//////////////////////////////////

   static  public function ctrIngresarPago($data){
 
       

            $tablaRemesa = 'remesas';
            $tabla='pagos';
            $tabla_movi = 'movimientos_bancarios';
            $datos = json_decode($data['metodo'], true);
            $valor=[];
            // Total de pago
            // $total=0;
            // foreach ($datos as $val) {
            //     $total=$total+$val['monto'];
            // }
            // $total;  

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
            array_push($valor, array(
                "cuenta_vene_id" => ($data['tipoBancoSalida'] == 'inter') ? null : $data['BancoTransfer'],
                "cuenta_inter_id"=> ($data['tipoBancoSalida'] == 'inter') ? $data['BancoTransfer'] : null,
                "monto"=>$data['monto-salida'],
                "n_ope"=>$data['nOpeSalida'],
                "metodo_p"=>$data['metodoPagosalida'],
                "remesas_id"=>$data['remesa_id'],
                "signo" =>'-'
            ));
            foreach ($valor as $val) {
                // return $val;
                $respuesta = PagosPModel::mdlIngresarPagos($tabla,$val);
            }

        ///////////////////////
        //ingreso de pago end//
        ///////////////////////

        PagosPController::Ingresopago($data);

        PagosPController::SalidaTransf($data);
     

    
            if ($datos[0]['metodo']=='Credito') {
                $estadoRemesa = array(
                    "id" =>  $data['remesa_id'],
                    "estado" => -1
                );
            }else{
                $estadoRemesa = array(
                    "id" =>  $data['remesa_id'],
                    "estado" => 1
                );
            }
                $respuesta2 = PagosPModel::mdlEditarRemesaEstado($tablaRemesa, $estadoRemesa);
                return $respuesta;
                // return $respuesta;
      

        }

      


}