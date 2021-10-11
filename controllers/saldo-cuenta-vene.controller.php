<?php

class SaldoCuentaVeneController{



//Carga descarga banco

static public function ctrSumaRestaSaldo(){
    if(isset($_POST['saldoRecarga'])){
   
                $tabla = 'saldo_cuenta_vene';
                $tabla2 = 'movimientos_bancarios';
                if($_POST['operacion'] == 'recarga'){
                    $saldo = $_POST['saldoActual'] + $_POST["saldoRecarga"];
                    $monto=$_POST["saldoRecarga"];
                    $signo ='+';
                }else if($_POST['operacion'] == 'descargar'){
                    $saldo = $_POST['saldoActual'] - $_POST["saldoRecarga"];
                    $monto=$_POST["saldoRecarga"];
                    $signo ='-';
                }

                if(isset($_POST["idcuentaActualRecarga"])){
                    $id_cuenta_actual =$_POST["idcuentaActualRecarga"];
                }else if(isset($_POST["idcuentaActualDescarga"])) {
                    $id_cuenta_actual =$_POST["idcuentaActualDescarga"];
                } 
                $datos = array(
                    "id" => $_POST["idSaldo"],
                    "saldo" => $saldo,
                    'id_cuenta'=>  $id_cuenta_actual,
                    "monto" => $monto,
                    "monto_actual" => $saldo,
                    "operacion" => $_POST["operacion"],
                    "pago_remesa_id" =>  null,
                    "cuenta_banco_inter_id" =>  null,
                    "signo" =>  $signo
                );
                if($_POST['operacion'] == 'recarga'){
                        $respuesta = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla, $datos);
                        $respuesta2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla2, $datos);
                        if($respuesta=="ok"){

                            echo '<script>
            
                            swal({
                                    type: "success",
                                    title: "¡Se ha recargado '.$_POST["simboloRecarga"].''.number_format($_POST["saldoRecarga"],2,',','.').' a su cuenta!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                    
                                }).then((result)=>{
                    
                                if(result.value){
                    
                                    window.location = "banco-cuentas-venezuela";
                    
                                }
                    
                                });
                        
                        </script>';
                        }
    
                  } else if ($_POST['operacion'] == 'descargar' &&  $_POST["saldoRecarga"] <= $_POST['saldoActual'] ) {
              
                   
                       $respuesta = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla, $datos);
                       $respuesta2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla2, $datos);
                    if($respuesta=="ok"){
    
                        echo '<script>
        
                          swal({
                                  type: "success",
                                  title: "¡Se ha recargado '.$_POST["simboloRecarga"].''.number_format($_POST["saldoRecarga"],2,',','.').' a su cuenta!",
                                  showConfirmButton: true,
                                  confirmButtonText: "Cerrar",
                                  closeOnConfirm: false
                  
                              }).then((result)=>{
                  
                              if(result.value){
                  
                                  window.location = "banco-cuentas-venezuela";
                  
                              }
                  
                              });
                      
                      </script>';
                    }

                  } else {
                    echo '<script>

                    swal({
                            type: "error",
                            title: "¡El saldo a descargar no puede ser mayor al saldo actual!",
                            text: "Por favor verifique nuevamente los montos",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "banco-cuentas-venezuela";
            
                        }
            
                        });
                
                </script>';
                  }
                
            } 
     
           
        }

// transferencia bancarias 
static public function ctrTransferenciaSaldo(){
    if(isset($_POST['saldoTransferencia'])){
   
                $tabla = 'saldo_cuenta_vene';
                $tabla2 = 'movimientos_bancarios';
                $saldo_comision = $_POST["saldoTransferencia"] * 0.003;
                $saldo_comision_apply = $_POST["saldoTransferencia"];
                $saldo_debito = $_POST['saldoActual'] - $_POST["saldoTransferencia"];
                $salto_transferencia = $_POST["saldoTransferencia"] + $_POST["saldoCuentaTransferir"];
               
                $datos = array(
                      //cuenta que recibe
                      array(
                        "id" =>  $_POST["cuentasBancariasId"],
                        'id_cuenta'=> $_POST["cuentaId"],
                        'c_transfer_vene_id'=>$_POST["idCuentaactual"],
                        "saldo" =>  $salto_transferencia,
                        "monto" =>  $_POST["saldoTransferencia"],
                        "monto_actual" => $salto_transferencia,
                        "operacion" =>  $_POST["operacion2"],
                        "pago_remesa_id" =>  null,
                        "cuenta_banco_inter_id" =>  null,
                        "signo" =>  '+'
                    ),
                       
                    //cuenta que transfiere
                    array(
                        "id" => $_POST["idSaldo"],
                        'id_cuenta'=> $_POST["idCuentaactual"],
                        'c_transfer_vene_id'=> $_POST["cuentaId"],
                        "saldo" => $saldo_debito,
                        "monto" =>  $saldo_comision_apply,
                        "monto_actual" =>  $saldo_debito,
                        "operacion" => $_POST["operacion"],
                        "pago_remesa_id" =>  null,
                        "cuenta_banco_inter_id" =>  null,
                        "signo" =>  '-'
                    )
                  
                );


                if(isset($_POST["cuentasBancariasId"])){
                if ($_POST["saldoTransferencia"] + $saldo_comision <= $_POST['saldoActual']) {
                    foreach ($datos as $value) {
                        $respuesta = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla, $value);
                        $respuesta2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla2, $value);
                    }

             

                if ($_POST["codigobanco"] != $_POST["codigobanco2"]) {
                           
                $tabla_inter_salida = 'saldo_cuenta_vene';
                $item4 ='id';
                $valor4 =$_POST["idCuentaactual"];
                $saldo_alctual_salida = CuentaBancoVeneController::ctrMostrarCuenta($item4, $valor4);
    
                    //array comision bancaria
                    $data_comisiones = array(
                        "id" => $_POST["idSaldo"],
                        'id_cuenta'=> $_POST["idCuentaactual"],
                        'c_transfer_vene_id'=> null,
                        "saldo" => $saldo_alctual_salida['saldo'] - $saldo_comision,
                        "monto" =>  $saldo_comision,
                        "monto_actual" =>  $saldo_alctual_salida['saldo'] - $saldo_comision,
                        "operacion" => 'Comision por Transferencia Bancaria',
                        "pago_remesa_id" =>  null,
                        "cuenta_banco_inter_id" =>  null,
                        "signo" =>  '-'
                    );
                    
                    $respuesta4 = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla, $data_comisiones);
                    $respuesta3 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla2, $data_comisiones);
                }


                    if($respuesta=="ok"){
    
                        echo '<script>
        
                          swal({
                                  type: "success",
                                  title: "¡Transferencia exitosa!",
                                  showConfirmButton: true,
                                  confirmButtonText: "Cerrar",
                                  closeOnConfirm: false
                  
                              }).then((result)=>{
                  
                              if(result.value){
                  
                                  window.location = "banco-cuentas-venezuela";
                  
                              }
                  
                              });
                      
                      </script>';
                    }
                }else {
                    echo '<script>

                    swal({
                            type: "error",
                            title: "¡El saldo es insuficiente!",
                            text: "Por favor verifique nuevamente los montos",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "banco-cuentas-venezuela";
            
                        }
            
                        });
                
                </script>';
                  }
                }else {
                    echo '<script>

                    swal({
                            type: "error",
                            title: "¡Debe seleccionar la cuenta a transferir!",
                            text: "Todos los campos son obligatorios",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "banco-cuentas-venezuela";
            
                        }
            
                        });
                
                </script>';
                  }
             
              
            } 
     
           
        }
        static public function ctrBorrarCuenta(){
            if(isset($_GET["idCuentaSaldo"])){
                $tabla="saldo_cuenta_vene";
                $tabla2="cuenta_banco_vene";
                $item = "id";
                $datos = $_GET["idCuentaSaldo"];
                $valor = $_GET["idCuenta"];
                $estado = $_GET["estado"];

                $cuenta_vene = ModeloBancoCuentaVene::mdlMostrarCuenta($tabla2, $item, $valor);

                if ($estado == $cuenta_vene['estado']) {
                    
                    $respuesta = SaldoCuentaVeneModel::mdlBorrarCuenta($tabla, $datos);
                    if($respuesta=="ok"){
                        echo '<script>
        
                        swal({
                                type: "success",
                                title: "¡La cuenta ha sido borrada correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                
                            }).then((result)=>{
                
                            if(result.value){
                
                                window.location = "banco-cuentas-venezuela";
                
                            }
                
                            });
                    
                    </script>';
                    }
                }else {
                    echo'<script>
    
                    swal({
                          type: "error",
                          title: "¡La cuenta ya no puede ser eliminado!",
                          text: "La cuenta que tienen movimientos no pueden ser eliminadas",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {

                            window.location = "banco-cuentas-venezuela";

                            }
                        })

                  </script>';
                }
            }
        }


}