
 <?php

class CreditosController{

    //mostrar monedas en la tabla
  static public function ctrMostrarCreditos($item,$valor){
      $tabla = 'pagos_remesas';
      $respuesta = ModeloCredito::mdlMostrarCreditos($tabla, $item, $valor);
      return $respuesta;
  }
  
  
  //mostrar monedas en la tabla
  
      static public function ctrIngresarCredito(){
  
        if(isset($_POST['remesas_id'])){

            
            $tabla = 'pagos_remesas';
            $tabla_movi = 'movimientos_bancarios';

            //numero de operacion
            if(isset($_POST['n-op-entrada'])){
                $nOpEntrada = $_POST['n-op-entrada'];
            }else {
                $nOpEntrada = null;
            }



            //cuentas de entrada sumar saldo 
            if (isset($_POST['tipo_cuenta_entrada'])) {
                if ($_POST['tipo_cuenta_entrada'] == "vene") {
                $cuentaVeneEntrada = $_POST['seleccionarBancoInter2'];
                    $cuentaInterEntrada = null;

                    $item3 ='id';
                    $valor3 =$cuentaVeneEntrada;

                    $tabla_vene = 'saldo_cuenta_inter';
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



                $datos = array(
                    "remesas_id" =>  $_POST['remesas_id'],
                    "metodo_pago_entrada" =>  $_POST['metodoPagoRemeda2'],
                    "cuenta_entrada_id" => $cuentaVeneEntrada,
                    "cuenta_entrada_inter_id" => $cuentaInterEntrada,
                    "n_operacion_entrada" => $nOpEntrada,
                    "monto_entrada" => $_POST['pago-efectivo']
                );





                  /////////////////////////////////
                //proceso de entrada de datos///
                ////////////////////////////////
      
        
                    
                    $respuesta = ModeloCredito::mdlPagoCredito($tabla, $datos);
                          var_dump($respuesta);
                      // suma del pago
                      if (isset($_POST['tipo_cuenta_entrada'])) {
                        
                          if ($_POST['tipo_cuenta_entrada'] == "vene") {
  
                              $sumarsaldo = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene,  $datos3);
                              //movimiento cobro de remesa venezuela
                                  $datos_movimientos = array(
                                  //movimeintos
                                  'id_cuenta'=>  $cuentaVeneEntrada,
                                  "monto" => $_POST['pago-efectivo'],
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





        }


}