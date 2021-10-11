<?php

class PagosController{


//mostrar monedas en la tabla
static public function ctrMostrarPagos($item,$valor){
    $tabla = 'remesas';
            
    $respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

    return $respuesta;
}


static public function ctrIngresarPago(){
    if(isset($_POST['id_remesa'])){

            $tabla = 'pagos_remesas';
            $tabla2 = 'remesas';
            $tabla_movi = 'movimientos_bancarios';
           
    
            if(isset($_POST['n-op-salida'])){
                $nOpSalida = $_POST['n-op-salida'];
            }else {
                $nOpSalida = null;
            }

                //cuentas de entrada sumar saldo 
                if (isset($_POST['tipo_cuenta_entrada'])) {
                    if ($_POST['tipo_cuenta_entrada'] == "vene") {
                       $cuentaVeneEntrada = $_POST['seleccionarBancoInter2'];
                        $cuentaInterEntrada = null;

                        $item3 ='id';
                        $valor3 =$cuentaVeneEntrada;

                        $tabla_vene = 'saldo_cuenta_vene';
                        $saldo_alctual_entrada = CuentaBancoVeneController::ctrMostrarCuenta($item3, $valor3);
                       
                        $valor_saldo_entrada= $saldo_alctual_entrada['saldo'];
                        $saldo_final_entrada =$valor_saldo_entrada +$_POST['pago-efectivo'];
                        $id_saldo_actual= $saldo_alctual_entrada['id_saldo'];
                    
                        $datos3 = array(
                            "id" => $id_saldo_actual,
                            "saldo" => $saldo_final_entrada,
                     
                        );

                     
                        
                    }else {
                        $cuentaVeneEntrada =null;
                        $cuentaInterEntrada = $_POST['seleccionarBancoInter2'];
                        
                       
                        $item3 ='id';
                        $valor3 =$cuentaInterEntrada;
                        
                        $tabla_inter = 'saldo_cuenta_inter';
                        $saldo_alctual_entrada = CuentaBancoInterController::ctrMostrarCuenta($item3, $valor3);
                       
                        $valor_saldo_entrada= $saldo_alctual_entrada['saldo_inter'];
                        $saldo_final_entrada =$valor_saldo_entrada + $_POST['pago-efectivo'];
                        $id_saldo_actual= $saldo_alctual_entrada['id_saldo'];

                        $datos3 = array(
                            "id" => $id_saldo_actual,
                            "saldo_inter" => $saldo_final_entrada,
                     
                        );
                                       
                                }
                        }else {
                            $cuentaVeneEntrada =null;
                            $cuentaInterEntrada = null;
                        }



                        //cuentas de salida restar saldo
                    if ($_POST['tipo_cuenta_salida'] == "vene") {
                        $cuentaVeneSalida =$_POST['seleccionarBancoTransfer'];
                        $cuentaInterSalida = null;

                        $tabla_vene_salida = 'saldo_cuenta_vene';
                        $item4 ='id';
                        $valor4 =$cuentaVeneSalida;
                        $saldo_alctual_salida = CuentaBancoVeneController::ctrMostrarCuenta($item4, $valor4);
                        if ($_POST['metodoPagoTransfer'] == 'tn') {
                          
                            $valor_saldo_salida= $saldo_alctual_salida['saldo'];
                            $saldo_final_salida =$valor_saldo_salida - $_POST['monto-transferencia'];
                        }else {
                            $valor_comision = $_POST['monto-transferencia'] * 0.003;
                            $valor_saldo_salida= $saldo_alctual_salida['saldo'];
                            $saldo_final_salida =$valor_saldo_salida - $_POST['monto-transferencia'] -  $valor_comision;
                            
                        }
                       
                    
                        $datos4 = array(
                            "id" => $saldo_alctual_salida['id_saldo'],
                            "saldo" => $saldo_final_salida,
                           
                        );

                    }else {
                        $cuentaVeneSalida =null;
                        $cuentaInterSalida = $_POST['seleccionarBancoTransfer'] ;

                        
                        $tabla_inter_salida = 'saldo_cuenta_inter';
                        $item4 ='id';
                        $valor4 =$cuentaInterSalida;
                        $saldo_alctual_salida = CuentaBancoInterController::ctrMostrarCuenta($item4, $valor4);

                        $valor_saldo_salida_inter= $saldo_alctual_salida['saldo_inter'];
                        $saldo_final_salida = $valor_saldo_salida_inter - $_POST['monto-transferencia'];
                        $saldo_alctual_salida['id_saldo'];

                        $datos4 = array(
                            "id" =>  $saldo_alctual_salida['id_saldo'],
                            "saldo_inter" => $saldo_final_salida,
                      
                        );
                    }
                  
                   
                  
          
        
            $datos = array(
                "remesas_id" => $_POST['id_remesa'],
                "cuenta_entrada_id" => $cuentaVeneEntrada,
                "cuenta_entrada_inter_id" => $cuentaInterEntrada,
                "monto_entrada" =>  $_POST['pago-efectivo'],
                "metodo_pago_entrada" =>  $_POST['metodoPagoRemeda2'],
                "n_operacion_entrada" =>  $nOpSalida,
                "cuenta_salida_id" =>  $cuentaVeneSalida,
                "cuenta_salida_inter_id" =>  $cuentaInterSalida,
                "monto_salida" =>  $_POST['monto-transferencia'],
                "metodo_pago_salida" =>  $_POST['metodoPagoTransfer'],
                "n_operacion_salida" =>  $_POST['n_operacion_salida']
            );
            $datos2 = array(
                "id" =>  $_POST['id_remesa'],
                "estado" => 1
            );

 

            /////////////////////////////////
            //proceso de entrada de datos///
            ////////////////////////////////
      
                if (isset($valor_saldo_salida)) {
                    if ($valor_saldo_salida < $_POST['monto-transferencia']) {
                        echo '<script>

                        swal({
                                type: "error",
                                title: "¡El saldo de '.$saldo_alctual_salida['nombre'].' - '.$saldo_alctual_salida['n_titular'].' '.$saldo_alctual_salida['a_titular'].' es insuficiente!",
                                text: "Verique los montos y vuelva a intentarlo",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                
                            }).then((result)=>{
                
                            if(result.value){
                
                                window.location = "pagos-pendientes";
                
                            }
                
                            });
                    
                    </script>';
                    }else {
                        
                        $respuesta = ModeloPagos::mdlIngresarPagos($tabla, $datos);
                        $respuesta2 = ModeloPagos::mdlEditarRemesaEstado($tabla2, $datos2);
                        $restarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene_salida, $datos4);  
                                if ($_POST['metodoPagoTransfer'] == 'transferencia digital') {
                                        
                                //movimiento pago de remesa venezuela
                                $datos_movimientos = array(
                                    array(//movimeintos
                                        'id_cuenta'=>  $cuentaVeneSalida,
                                        "monto" => $_POST['monto-transferencia'],
                                        "monto_actual" => $valor_saldo_salida - $_POST['monto-transferencia'],
                                        "operacion" => "Pago de Remesa",
                                        "c_transfer_vene_id" => null,
                                        "pago_remesa_id" =>  $_POST['id_remesa'],
                                        "cuenta_banco_inter_id" =>  null,
                                        "signo" =>  '-'),
                                        //array comision bancaria
                                    array(
                                
                                'id_cuenta'=>  $cuentaVeneSalida,
                                "monto" =>   ($_POST['monto-transferencia'] * 0.003),
                                "monto_actual" => $valor_saldo_salida - ($_POST['monto-transferencia'] * 0.003),
                                "operacion" => 'Comisión por Transferencia Bancaria Digital',
                                'c_transfer_vene_id'=> null,
                                "pago_remesa_id" =>  $_POST['id_remesa'],
                                "cuenta_banco_inter_id" =>  null,
                                "signo" =>  '-'
                                    )
                                        
                                    );
                                    //movimiento pago de remesa venezuela end
                                    foreach ($datos_movimientos as $value) {
                                     
                                        $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
                                    }
                                }else if($_POST['metodoPagoTransfer'] =='pago movil'){
                                              //movimiento pago de remesa venezuela
                                $datos_movimientos = array(
                                    array(//movimeintos
                                        'id_cuenta'=>  $cuentaVeneSalida,
                                        "monto" => $_POST['monto-transferencia'],
                                        "monto_actual" => $valor_saldo_salida - $_POST['monto-transferencia'],
                                        "operacion" => "Pago de Remesa",
                                        "c_transfer_vene_id" => null,
                                        "pago_remesa_id" =>  $_POST['id_remesa'],
                                        "cuenta_banco_inter_id" =>  null,
                                        "signo" =>  '-'),
                                        //array comision bancaria
                                    array(
                                
                                'id_cuenta'=>  $cuentaVeneSalida,
                                "monto" =>  ($_POST['monto-transferencia'] * 0.003),
                                "monto_actual" => $valor_saldo_salida - ($_POST['monto-transferencia'] * 0.003),
                                "operacion" => 'Comisión pago movil',
                                'c_transfer_vene_id'=> null,
                                "pago_remesa_id" =>  $_POST['id_remesa'],
                                "cuenta_banco_inter_id" =>  null,
                                "signo" =>  '-'
                                    )
                                        
                                    );
                                    //movimiento pago de remesa venezuela end
                                    foreach ($datos_movimientos as $value) {
                                     
                                        $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $value);
                                    }
                                }else {

                                    $datos_movimientos = array(
                                       //movimeintos
                                            'id_cuenta'=>  $cuentaVeneSalida,
                                            "monto" => $_POST['monto-transferencia'],
                                            "monto_actual" => $valor_saldo_salida - $_POST['monto-transferencia'],
                                            "operacion" => "Pago de Remesa",
                                            "c_transfer_vene_id" => null,
                                            "pago_remesa_id" =>  $_POST['id_remesa'],
                                            "cuenta_banco_inter_id" =>  null,
                                            "signo" =>  '-'
                                        );

                                    $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $datos_movimientos);
                                    # code...
                                }

                          // suma del pago
                          if (isset($_POST['tipo_cuenta_entrada'])) {
                            
                              if ($_POST['tipo_cuenta_entrada'] == "vene") {
      
                                  $sumarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene,  $datos3);
                                  //movimiento cobro de remesa venezuela
                                      $datos_movimientos = array(
                                      //movimeintos
                                      'id_cuenta'=>  $cuentaVeneEntrada,
                                      "monto" => $_POST['pago-efectivo'],
                                      "monto_actual" =>  $valor_saldo_entrada + $_POST['pago-efectivo'],
                                      "operacion" => "Cobro de Remesa",
                                      "c_transfer_vene_id" => null,
                                      "pago_remesa_id" =>  $_POST['id_remesa'],
                                      "cuenta_banco_inter_id" =>  null,
                                      "signo" =>  '+'
                                  );
                                  //movimiento pago de remesa venezuela end
      
                                  $movimientos2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $datos_movimientos);
      
                              }else {
      
                                  $sumarsaldo = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter, $datos3); 
      
                                              //movimiento cobro de remesa internacional
                                              $datos_movimientos = array(
                                                  //movimeintos
                                                  'id_cuenta'=>  null,
                                                  "monto" => $_POST['pago-efectivo'],
                                                  "monto_actual" => $valor_saldo_entrada + $_POST['pago-efectivo'],
                                                  "operacion" => "Cobro de Remesa",
                                                  "c_transfer_vene_id" => null,
                                                  "pago_remesa_id" =>  $_POST['id_remesa'],
                                                  "cuenta_banco_inter_id" =>  $cuentaInterEntrada,
                                                  "signo" =>  '+'
                                              );
                                              //movimiento pago de remesa internacional end
                  
                                              $movimientos2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $datos_movimientos);
      
                              }
                          }

                        if($respuesta=="ok"){
                            echo '<script>
        
                            swal({
                                    type: "success",
                                    title: "¡El pago se registro correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                    
                                }).then((result)=>{
                    
                                if(result.value){
                    
                                    window.location = "pagos-pendientes";
                    
                                }
                    
                                });
                        
                        </script>';
                        }
                    }
                  
                }else if (isset($valor_saldo_salida_inter)){
                    if ($valor_saldo_salida_inter < $_POST['monto-transferencia']) {
                        echo '<script>

                        swal({
                                type: "error",
                                title: "¡El saldo de '.$saldo_alctual_salida['nombre'].' - '.$saldo_alctual_salida['n_titular_inter'].' '.$saldo_alctual_salida['a_titular_inter'].' es insuficiente!",
                                text: "Verique los montos y vuelva a intentarlo",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                
                            }).then((result)=>{
                
                            if(result.value){
                
                                window.location = "pagos-pendientes";
                
                            }
                
                            });
                    
                    </script>';
                    }else {
                        $respuesta = ModeloPagos::mdlIngresarPagos($tabla, $datos);
                        $respuesta2 = ModeloPagos::mdlEditarRemesaEstado($tabla2, $datos2);
                        $restarsaldo = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter_salida, $datos4); 

                        //movimiento pago de remesa internacional
                        $datos_movimientos = array(
                            //movimeintos
                            'id_cuenta'=>  null,
                            "monto" => $_POST['monto-transferencia'],
                            "monto_actual" => $valor_saldo_salida_inter - $_POST['monto-transferencia'],
                            "operacion" => "Pago de Remesa",
                            "c_transfer_vene_id" => null,
                            "pago_remesa_id" =>  $_POST['id_remesa'],
                            "cuenta_banco_inter_id" =>  $cuentaInterSalida,
                            "signo" =>  '-'
                        );
                        $movimientos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $datos_movimientos);
                        //movimiento pago de remesa internacional end

                        // suma del pago
                        if ($_POST['tipo_cuenta_entrada'] == "vene") {

                            $sumarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene,  $datos3);

                            $sumarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene,  $datos3);
                            //movimiento cobro de remesa venezuela
                                $datos_movimientos = array(
                                //movimeintos
                                'id_cuenta'=>  $cuentaVeneEntrada,
                                "monto" => $_POST['pago-efectivo'],
                                "monto_actual" => $valor_saldo_entrada + $_POST['pago-efectivo'],
                                "operacion" => "Cobro de Remesa",
                                "c_transfer_vene_id" => null,
                                "pago_remesa_id" =>  $_POST['id_remesa'],
                                "cuenta_banco_inter_id" =>  null,
                                "signo" =>  '+'
                            );
                            //movimiento pago de remesa venezuela end

                            $movimientos2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $datos_movimientos);

                        }else {
                            $sumarsaldo = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter, $datos3); 
                             //movimiento cobro de remesa internacional
                             $datos_movimientos = array(
                                //movimeintos
                                'id_cuenta'=>  null,
                                "monto" => $_POST['pago-efectivo'],
                                "monto_actual" =>  $valor_saldo_entrada + $_POST['pago-efectivo'],
                                "operacion" => "Cobro de Remesa",
                                "c_transfer_vene_id" => null,
                                "pago_remesa_id" =>  $_POST['id_remesa'],
                                "cuenta_banco_inter_id" =>  $cuentaInterEntrada,
                                "signo" =>  '+'
                            );
                            //movimiento pago de remesa internacional end

                            $movimientos2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi, $datos_movimientos);
                        }
                             

                        if($respuesta=="ok"){
                            echo '<script>
        
                            swal({
                                    type: "success",
                                    title: "¡El pago se registro correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                    
                                }).then((result)=>{
                    
                                if(result.value){
                    
                                    window.location = "pagos-pendientes";
                    
                                }
                    
                                });
                        
                        </script>';
                        }
                    }
                }
           
            
     
           
        }
    }





//mostrar pagos Procesados
static public function ctrMostrarPagosProcesados($item,$valor){
    $tabla = 'remesas';
            
    $respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

    return $respuesta;
}
    

}


