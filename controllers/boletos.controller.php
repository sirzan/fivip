<?php

class BoletosController {

    
    ///////////////////////////////////
    //mostrar boleto en el inicio  //
    //////////////////////////////////
    static public function ctrMostrarBoleto($item,$valor){
        $tabla ='boletos';

       $respuesta = BoletoModal::mdlMostrar($tabla,$item,$valor);

       return $respuesta;
    }
    ///////////////////////////////////
    //mostrar boleto Creditos//
    //////////////////////////////////
    static public function ctrMostrarBoletoCredito($item,$valor){
        $tabla ='pagos_boletos';

       $respuesta = BoletoModal::mdlMostrarCreditos($tabla,$item,$valor);

       return $respuesta;
    }


    ///////////////////////////////////
    //sumar de cuanta que deposito  //
    //////////////////////////////////
 static   public function Ingresopago($data,$id){
    $tabla_movi = 'movimientos_bancarios';
    $datos = json_decode($data[0]['metodo'], true);


if ($data[0]['tipoBancoEntradaBoleto'] == "inter") {
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
                        "operacion" => "Cobro de Boleto (Viaje)",
                        "c_transfer_vene_id" => null,
                        "pago_remesa_id" => null,
                        "boleto_id" =>  $id,
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
                             "saldo" =>$saldoEntrada[$v]['saldo'] + $datos[$i]['monto']
                       ] ;

                       $movimientoDataEntrada[]=[
                        'id_cuenta'=>  $saldoEntrada[$v]['id_cuenta'],
                        "monto" => $datos[$i]['monto'],
                        "monto_actual" => $saldoEntrada[$v]['saldo']+$datos[$i]['monto'],
                        "operacion" => "Cobro de Boleto (Viaje)",
                        "c_transfer_vene_id" => null,
                        "pago_remesa_id" => null,
                        "boleto_id" =>  $id,
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

    static public function ingresarBoletos($data){



        $tabla ='boletos';
        $tabla2 ='pagos_boletos';
        $datos = json_decode($data['datos'], true);
        $datosPagos = json_decode( $datos[0]['metodo'], true);
        $rutaD = json_encode($datos[0]['rutaD'], true);
        $rutaS = json_encode($datos[0]['rutaS'], true);
        $fechaHoraR =date('Y-m-d H:i:s' ,strtotime($datos[0]['fechaR']));
        $fechaHoraS =date('Y-m-d H:i:s' ,strtotime($datos[0]['fechaS']));
        $item='iso';
        $idMoneda=MonedaController::ctrMostrarMonedas($item,$datos[0]['idMoneda']);
        $valor=[
            'cliente_id'=>$datos[0]['cliente'],
            'correlativo'=>$datos[0]['correlativo'],
            'fecha_r'=> $fechaHoraR,
            'fecha_s'=> $fechaHoraS,
            'obs'=>$datos[0]['obs'],
            'costo'=>$datos[0]['costo'],
            'moneda_id'=>$idMoneda['id'],
            'promotor'=>$datos[0]['promotor'],
            'ruta_d'=>$rutaD,
            'ruta_s'=>$rutaS,
            'sa'=>$datos[0]['sa'],
            'user_id'=>$datos[0]['user_id'],
            'estado'=>($datos[0]['tipopago'] == "Credito")?0:1
        ];
        
        $respuesta = BoletoModal::mdlIngresar($tabla,$valor);
        $idBoleto = BoletoModal::mdlMostrarUltimoId($tabla);

        $dataPagoBoletos= json_decode($datos[0]['metodo'],true);
        $pagoBoleto=[];
        foreach ($dataPagoBoletos as $dato) {

            array_push($pagoBoleto,array(
                "cuenta_vene_id" => ($dato['tipoBanco'] == 'inter')?null:$dato['banco'],
                "cuenta_inter_id"=>($dato['tipoBanco'] == 'inter')?$dato['banco']:null,
                "monto"=>$dato['monto'],
                "n_ope"=>$dato['nOperacion'],
                "metodo_p"=>$dato['metodo'],
                "boleto_id"=>$idBoleto['id'],
                "signo" =>'+'
            ));
        }
        foreach ($pagoBoleto as $val) {
            PagoBoletoModel::mdlIngresar($tabla2,$val);
        }
        
     
        BoletosController::Ingresopago($datos,$idBoleto['id']);
        
        $respuesta=[
            'respuesta' => 'ok',
            'id' => $idBoleto['id']
        ];

        return  $respuesta;
        // return  $respuesta;
       


    }

}