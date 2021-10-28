<?php

class SaldoCuentaInterController{



//Carga descarga banco

static public function ctrSumaRestaSaldo($info){
    if(isset($_POST['saldoRecarga'])){
   
                $tabla = 'saldo_cuenta_inter';
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
                    //cargar saldo
                    "id" => $_POST["idSaldo"],
                    "saldo_inter" => $saldo,
                    //movimientos
                    'id_cuenta'=>  null,
                    "monto" => $monto,
                    "operacion" => $_POST["operacion"],
                    "pago_remesa_id" =>  null,
                    "cuenta_banco_inter_id" =>  $id_cuenta_actual,
                    "signo" =>  $signo
                );
       var_dump( $datos);
                if($_POST['operacion'] == 'recarga'){
                        $respuesta = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla, $datos,$info);
                        $respuesta2 =   ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla2, $datos,$info);
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
                    
                                    window.location = "banco-cuentas-inter";
                    
                                }
                    
                                });
                        
                        </script>';
                        }
    
                  } else if ($_POST['operacion'] == 'descargar' &&  $_POST["saldoRecarga"] <= $_POST['saldoActual'] ) {
              
                   
                       $respuesta = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla, $datos,$info);
                       $respuesta2 = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla2, $datos,$info);
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
                  
                                  window.location = "banco-cuentas-inter";
                  
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
            
                            window.location = "banco-cuentas-inter";
            
                        }
            
                        });
                
                </script>';
                  }
                
            } 
     
           
        }

        static public function ctrBorrarCuenta(){
            if(isset($_GET["idCuentaSaldo"])){
                $tabla="saldo_cuenta_inter";
                $tabla2="cuenta_banco_inter";
                $item="id";
                $datos = $_GET["idCuentaSaldo"];
                $valor = $_GET["idCuenta"];
                $estado = $_GET["estado"];
                $info = $_GET["info"];

                $cuenta_inter =  ModeloBancoCuentaInter::mdlMostrarCuenta($tabla2, $item, $valor,$info);
            
                if ($estado == $cuenta_inter['estado']) {
                    
                    $respuesta = ModeloSaldoCuentaInter::mdlBorrarCuenta($tabla, $datos,$info);
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
                
                                window.location = "banco-cuentas-inter";
                
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

                            window.location = "banco-cuentas-inter";

                            }
                        })

                  </script>';
                }
            }
        }


}