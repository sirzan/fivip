<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class RemesasController{

       //crear monedas
       static public function ctrCrearRemesa($info){
   
         
           if(isset($_POST['idVendedor'])){
           $base=$info;
            $tabla = 'remesas';

            if($_POST['banco'] == 'bancovene'){
                $cuenta_banco = $_POST['bancocode'].' '.$_POST['cuenta-banco'];
            }else{
                $cuenta_banco = $_POST['cuenta-banco'];
            }
       
            if (isset($_POST['bancopagomovil'])) {
                $bancoPagoMovil = $_POST['bancopagomovil'];
          
            }else{
                $bancoPagoMovil = null;
            }
     
          
            
            date_default_timezone_set('America/Lima');

            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

            $fechaActual = $fecha.' '.$hora;
     
            $datos = array(
                "correlativo" =>  $_POST['nuevaserie'],
                "cliente_id" =>  $_POST['seleccionarCliente'],
                "receptor" =>  $_POST['nuevoreceptor'],
                "tipo_doc" => $_POST['nuevotipodocumento'],
                "n_doc" => $_POST['nuevoNumeroDocumento'],
                "banco" => $_POST['seleccionarBanco'],
                "ban_pa_m" => $bancoPagoMovil,
                "n_cuenta" => $cuenta_banco,
                "obs" => $_POST['observacion'],
                "nombre_moneda" => $_POST['agregarmoneda'],
                "pais" => $_POST['agregarpais'],
                "iso_moneda" => $_POST['agregariso'],
                "simbolo_moneda" => $_POST['agregarsimbolo'],
                "total_envio" => $_POST['pagoremesa'],
                "tasa" => $_POST['agregartasa'],
                "total_remesa" => $_POST['totalremesa'],
                "simbolo_tasa" => $_POST['agregarsimboloTasa'],
                "iso_tasa" => $_POST['agregarisoTasa'],
                "total_remesa" => $_POST['totalremesa'],
                "vendedor_id" => $_POST['idVendedor'],
                "fecha" => $fechaActual,
                "estado" => 0
            );

            $respuesta = ModeloRemesas::mdlIngresarRemesas($tabla, $datos,$info);
          
            // $item="id";
            // $valor=$datos['cliente_id'];
            // $tabla_cliente = 'clientes';
            // $cliente = ModeloCliente::mdlMostrarClientes($tabla_cliente, $item, $valor);

            // $item2="id";
            // $valor2=$datos['banco'];
            // $tabla_banco_vene = 'banco_vene';
            // $bancos_vene = ModeloBancoVene::mdlMostrarBancoVene($tabla_banco_vene, $item2, $valor2);
           
    
                if($respuesta=="ok"){
                   // imprimir ticket con driver local
                    // if(isset($_POST['imprimirTicket'])){
                    //     $impresora = 'IMPRESORA GENERICA';
                    //     try {
                    //         date_default_timezone_set('America/Lima');

                    //         $fecha = date('Y-m-d');
                    //         $hora = date('H:i:s');
                
                    //         $fechaActual = $fecha.' '.$hora;
                    //         // Enter the share name for your USB printer here
                    //         $connector = new WindowsPrintConnector($impresora);
                    //         $printer = new Printer($connector);
                        
                    //         /* Print some bold text */
                    //         // $printer -> setEmphasis(true);
                    //         $logo = EscposImage::load("views/img/logo-ticket.png", false);
                    //         $printer->setJustification(Printer::JUSTIFY_CENTER);
                    //         $printer->bitImage($logo);
                    //         $printer -> text("Corporativo FIVIP SAC\n");
                    //         $printer -> text("RUC: 20607982873\n");
                    //         $printer->text('N° de Serie: ' .  $datos['correlativo'] . "\n");
                    //         $printer->text('Fecha: ' .  $fechaActual . "\n");
                    //         $printer->setJustification(Printer::JUSTIFY_LEFT);
                    //         $printer->text('Remesa: ' .  $datos['pais']." - ". 'Venezuela'. "\n");
                    //         if($datos['banco_vene_id'] == 8){
                    //             $printer->text($bancos_vene['nombre'].": ". $datos['n_cuenta']. "\n".$datos['ban_pa_m']. "\n");
                    //         }else{
                    //             $printer->text($bancos_vene['nombre'].": ". $datos['n_cuenta']. "\n");   
                    //         }
                    //         $printer->text($datos['tipo_doc'].": ". $datos['n_doc']. "\n");
                    //         $printer->text("Nombre".": ". $datos['receptor']. "\n");
                    //         $printer->text("Monto".": ".$datos['total_envio'] .$datos['simbolo_moneda']." (".$datos['iso_moneda'].") ". "\n");
                    //         $printer->text("Tasa".": ". $datos['tasa']. "Bs.". "\n");
                    //         $printer->text("Total".": ". $datos['total_remesa']. "Bs.". "\n");
                    //         // $printer -> setEmphasis(false);
                    //         // $printer -> feed();
                    //         $printer->setJustification(Printer::JUSTIFY_RIGHT);
                    //         $printer->text("--------------------------\n");
                    //         $printer->text("Cliente".": ". $cliente['nombres']." ".$cliente['apellidos']. "\n");
                    //         $printer->text("Teléfono".": ". $cliente['telefono']. "\n");
                    //         $printer->text("Terminos de la empresa". "\n");
                    //         $printer -> qrCode("Link de los terminos de la empresa FIVIP",Printer::QR_ECLEVEL_L, 3);
                    //         // $printer -> text("Receipt for whatever\n");
                    //         $printer -> feed(4);
                    //         $printer->cut();
                    //         $printer->pulse();
                        
                            
                    //         /* Close printer */
                    //         $printer -> close();
                    //     } catch(Exception $e) {
                    //         echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
                    //     }
    
                    // }
                   
                    $tabla2 = 'remesas';
                    $item3='correlativo';
                    $valor3=  $_POST['nuevaserie'];
                    $remesa = ModeloRemesas::mdlMostrarRemesas($tabla2, $item3, $valor3,$info);
                  
                   

                    echo '<script>
    
                    swal({
                            type: "success",
                            title: "¡Se envio la remesa correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
                           
                          
                            window.location = "admin-remesa";
            
                        }
            
                        });
                
                      
                </script>';
                }
    
             else{
                echo '<script>
    
                swal({
                        type: "error",
                        title: "¡Algo salio mal con el registro!",
                        text: "Todos los campos son obligatorios",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "enviar-remesas";
        
                    }
        
                    });
            
            </script>';

        }

        }
    }
    
//mostrar monedas en la tabla
static public function ctrMostrarRemesas($item,$valor,$info){
    $tabla = 'remesas';
            
    $respuesta = ModeloRemesas::mdlMostrarRemesas($tabla, $item, $valor,$info);

    return $respuesta;
}

static public function ctrBorrarRemesas(){
    if(isset($_GET["idRemesa"])){
        $tabla="remesas";
        $tabla2="pagos";
        $id = $_GET["idRemesa"];  
        $info = $_GET["info"];  
        $item = "remesas_id";



        $mostrar_pagos = ModeloPagos::mdlMostrarPagosProcesados( $tabla2,$item, $id,$info);
   
// var_dump($mostrar_pagos);
     
        foreach ($mostrar_pagos as $key => $value) {


               ////////////////////////////////////////////////
                ///////          Restar saldos      //////////
                ////////////////////////////////////////////////

           if ($value['signo'] == '+') {
                
                if (isset($value['cuenta_vene_id'])) {

                    $tabla_vene = "saldo_cuenta_vene";
                        $item = 'id';
                
        
                    $cuenta_recargar= CuentaBancoVeneController::ctrMostrarCuenta($item, $value['cuenta_vene_id'],$info);
                    $datos = array(
                        //cargar saldo
                        "id" => $cuenta_recargar['id_saldo'],
                        "saldo" => $cuenta_recargar['saldo'] - $value['monto'], 
                            );
                    $respuesta = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene, $datos,$info);
        
                } else if (isset($value['cuenta_inter_id'])) {
                    $tabla_inter = "saldo_cuenta_inter";
                        $item = 'id';
                       
                    $cuenta_recargar= CuentaBancoInterController::ctrMostrarCuenta($item,$value['cuenta_inter_id'],$info);
                    $datos = array(
                        //cargar saldo
                        "id" => $cuenta_recargar['id_saldo'],
                        "saldo_inter" =>$cuenta_recargar['saldo_inter'] - $value['monto'], 
                            );
        
                    $respuesta = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter, $datos,$info);
                        
                }
           }

                 ////////////////////////////////////////////////
                ///////          Restar saldos  end    //////////
                ////////////////////////////////////////////////

       
        }


   
        foreach ($mostrar_pagos as $key => $value) {

               ////////////////////////////////////////////////
        ///////          sumar saldos      //////////
        ////////////////////////////////////////////////
 

            if ($value['signo'] == '-') {
                
                if (isset($value['cuenta_vene_id'])) {
    
                    $tabla_vene = "saldo_cuenta_vene";
                        $item = 'id';
                
        
                    $cuenta_recargar= CuentaBancoVeneController::ctrMostrarCuenta($item, $value['cuenta_vene_id'],$info);
                     if  ($value['metodo_p'] =='transferencia digital' || $value['metodo_p'] =='pago movil'){
                        $comi=bcdiv($value['monto']*0.003,'1',2);
                    }else {
                        $comi=0;
                    }
                    $datos = array(
                        //cargar saldo
                        "id" => $cuenta_recargar['id_saldo'],
                        "saldo" => $cuenta_recargar['saldo'] + $value['monto'] + $comi, 
                            );
                    $respuesta = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene, $datos,$info);
        
                } else if (isset($value['cuenta_inter_id'])) {
                    $tabla_inter = "saldo_cuenta_inter";
                        $item = 'id';
                       
                    $cuenta_recargar= CuentaBancoInterController::ctrMostrarCuenta($item,$value['cuenta_inter_id'],$info);
                    $datos = array(
                        //cargar saldo
                        "id" => $cuenta_recargar['id_saldo'],
                        "saldo_inter" =>$cuenta_recargar['saldo_inter'] + $value['monto'], 
                            );
        
                    $respuesta = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter, $datos,$info);
                        
                }
           }
    
        }
      


        $respuesta = ModeloRemesas::mdlBorrarRemesas($tabla, $id,$info);
        if($respuesta=="ok"){
            echo '<script>

            swal({
                    type: "success",
                    title: "¡La Remesa ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
    
                }).then((result)=>{
    
                if(result.value){
    
                    window.location = "admin-remesa";
    
                }
    
                });
        
        </script>';
        }
        
    }
}



}


