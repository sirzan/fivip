<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class RemesasController{

       //crear monedas
       static public function ctrCrearRemesa(){
   
         
           if(isset($_POST['idVendedor'])){
           
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

            $respuesta = ModeloRemesas::mdlIngresarRemesas($tabla, $datos);
          
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
                    $remesa = ModeloRemesas::mdlMostrarRemesas($tabla2, $item3, $valor3);

                   

                    echo '<script>
    
                    swal({
                            type: "success",
                            title: "¡Se envio la remesa correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
                           window.open("extensions/tcpdf/pdf/factura.php?id="+'.$remesa['id'].', "_blank");
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
static public function ctrMostrarRemesas($item,$valor){
    $tabla = 'remesas';
            
    $respuesta = ModeloRemesas::mdlMostrarRemesas($tabla, $item, $valor);

    return $respuesta;
}

static public function ctrBorrarRemesas(){
    if(isset($_GET["idRemesa"])){
        $tabla="remesas";
        $tabla2="pagos_remesas";
        $id = $_GET["idRemesa"];  
        $item = "remesas_id";



        $mostrar_pagos = ModeloPagos::mdlMostrarPagosProcesados( $tabla2,$item, $id);
   

        ////////////////////////////////////////////////
        ///////          Restar saldos      //////////
        ////////////////////////////////////////////////

        if (isset($mostrar_pagos['cuenta_entrada_id'])) {

            $tabla_vene = "saldo_cuenta_vene";
                $item = 'id';
                $valor = $mostrar_pagos['cuenta_entrada_id'];

               $cuenta_recargar= CuentaBancoVeneController::ctrMostrarCuenta($item,$valor);
                $saldo_nuevo= $cuenta_recargar['saldo'] - $mostrar_pagos['monto_entrada']; 
               $datos = array(
                //cargar saldo
                "id" => $cuenta_recargar['id_saldo'],
                "saldo" => $saldo_nuevo, 
                     );
            $respuesta = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene, $datos);

        } else if (isset($mostrar_pagos['cuenta_entrada_inter_id'])) {
            $tabla_inter = "saldo_cuenta_inter";
                $item = 'id';
                $valor = $mostrar_pagos['cuenta_entrada_inter_id'];

               $cuenta_recargar= CuentaBancoInterController::ctrMostrarCuenta($item,$valor);
               $saldo_nuevo= $cuenta_recargar['saldo_inter'] - $mostrar_pagos['monto_entrada']; 
               $datos = array(
                //cargar saldo
                "id" => $cuenta_recargar['id_saldo'],
                "saldo_inter" =>$saldo_nuevo, 
                     );

            $respuesta = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter, $datos);
                  

        }



    ////////////////////////////////////////////////
        ///////          sumar saldos      //////////
        ////////////////////////////////////////////////

        if (isset($mostrar_pagos['cuenta_salida_id'])) {
           
             $tabla_vene = "saldo_cuenta_vene";
                $item = 'id';
                $valor = $mostrar_pagos['cuenta_salida_id'];

                $cuenta_recargar= CuentaBancoVeneController::ctrMostrarCuenta($item,$valor);
                if ($mostrar_pagos['metodo_pago_salida'] =='transferencia digital' || $mostrar_pagos['metodo_pago_salida'] =='pago movil') {
                
                    $saldo_nuevo= $cuenta_recargar['saldo'] + $mostrar_pagos['monto_salida'] + ($mostrar_pagos['monto_salida']*0.003); 
                }else {
                    $saldo_nuevo= $cuenta_recargar['saldo'] + $mostrar_pagos['monto_salida']; 
                  
                }

                $datos = array(
                //cargar saldo
                "id" => $cuenta_recargar['id_saldo'],
                "saldo" => $saldo_nuevo
                     );
               
                     $respuesta = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene, $datos);

        }else if(isset($mostrar_pagos['cuenta_salida_inter_id'])){
            
            $tabla_inter = "saldo_cuenta_inter";
            $item = 'id';
            $valor = $mostrar_pagos['cuenta_salida_inter_id'];

            $cuenta_recargar= CuentaBancoVeneController::ctrMostrarCuenta($item,$valor);
            $saldo_nuevo= $cuenta_recargar['saldo_inter'] + $mostrar_pagos['monto_salida']; 

            $datos = array(
            //cargar saldo
            "id" => $cuenta_recargar['id_saldo'],
            "saldo_inter" => $saldo_nuevo
                 );
                //  var_dump($respuesta);
             $respuesta = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter, $datos);
        }






        $respuesta = ModeloRemesas::mdlBorrarRemesas($tabla, $id);
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

//mostrar monedas en la tabla
static public function ctrRengoFechaRemesas($fechaInicial,$fechaFinal){
    $tabla = 'remesas';
            
    $respuesta = ModeloRemesas::mdlRengoFechaRemesas($tabla, $fechaInicial, $fechaFinal);

    return $respuesta;
}


}


