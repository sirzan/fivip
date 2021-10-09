<?php
class ControladorMontoRecargas{

//crear monedas
static public function ctrCrearMontoRecarga(){
   
    if(isset($_POST['operadora'])){
   
  
          
        
            $tabla = 'monto_recarga_m';

            date_default_timezone_set('America/Lima');

            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

            $fechaActual = $fecha.' '.$hora;
            $datos = array(
                "operadora" => $_POST["operadora"],
                "moneda_id" => $_POST["nuevaMonedaMonto"],
                "monto" => $_POST["nuevoMonto"],
                "total_recarga" => $_POST['nuevoRecarga'],
                "moneda_recarga_id" => $_POST['nuevaMonedaRecarga'],
                "created_at" =>  $fechaActual
            );
            // var_dump($datos);
            $respuesta = ModeloMontoRecarga::mdlIngresarMontoRecarga($tabla, $datos);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡Se registro el monto correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "crear-monto";
        
                    }
        
                    });
            
            </script>';
            }

     
 
       
    }
}


//mostrar tasas en la tabla
static public function ctrMostrarMontoRecarga($item,$valor){
    $tabla = 'monto_recarga_m';
            
    $respuesta = ModeloMontoRecarga::mdlMostrarMontoRecarga($tabla, $item, $valor);

    return $respuesta;
}



//Editar Moneda

static public function ctrEditarMontoRecarga(){
    if(isset($_POST['editaroperadora'])){
     
            
            $tabla = 'monto_recarga_m';


            $datos = array(
                "operadora" => $_POST["editaroperadora"],
                "monto" => $_POST["editarMonto"],
                "moneda_id" => $_POST["editarMonedaMonto"],
                "total_recarga" => $_POST["editarRecarga"],
                "moneda_recarga_id" => $_POST['editarMonedaRecarga'],
                "id" => $_POST['idMonto_r']
            );
    
                $respuesta = ModeloMontoRecarga::mdlEditarMontoRecarga($tabla, $datos);
                if($respuesta=="ok"){
                    echo '<script>

                    swal({
                            type: "success",
                            title: "¡Se actualizo correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "crear-monto";
            
                        }
            
                        });
                
                </script>';
                }

     
           
        }
    }

    static public function ctrBorrarMontoRecarga(){
        if(isset($_GET["idMontoR"])){
           
            $tabla="monto_recarga_m";
      
            $id = $_GET["idMontoR"];


            $respuesta = ModeloMontoRecarga::mdlBorrarMontoRecarga($tabla, $id);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡El monto ha sido borrada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "crear-monto";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }



    //////////////////////
    //admin de recargar //
    //////////////////////

    static public function ctrIngresarRecarga(){
        if (isset($_POST['nuevaMonedaRecarga'])) {
            
            //ingreso en base de datos recarga
            $tabla = 'recargas';
            $tabla_movi = 'movimientos_bancarios';

            $cuenta_vene = $_POST['seleccionarBancoTransfer'];
            $cuenta_inter = $_POST['seleccionarBancoInter2'];
            $datos = array(
                'cliente_id'=> $_POST['seleccionarCliente'],
                'operadora'=> $_POST['operadora'],
                'tel_r'=> $_POST['telefonoRecarga'],
                'cuenta_inter_id'=> $cuenta_inter,
                'n_dep_inter'=> $_POST['n-op-entrada'],
                'monto'=> $_POST['pago-monto'],
                'moneda_monto_id'=> $_POST['idMonedaMonto'],
                'cuenta_vene_id'=> $cuenta_vene,
                'n_dep_vene'=> $_POST['n-op-salida'],
                'recarga'=> $_POST['pago-recarga'],
                'moneda_recarga_id'=> $_POST['idMonedaR'],
                'user_id'=> $_POST['idUser'],
            );

           $respuesta = ModeloMontoRecarga::mdlIngresarRecarga($tabla, $datos);

           $r_ultima_rec = ModeloMontoRecarga::mdlMostrarRecargaOne();
          
        //    var_dump($r_ultima_rec);
            //ingresar movimientos bancarios
            $datos_movi = array(
                array('id_cuenta' => null,
                'c_transfer_vene_id' => null,
                'cuenta_banco_inter_id' => $cuenta_inter,
                'monto' => $_POST['pago-monto'],
                'pago_remesa_id' => null,
                'recargas_id' => $r_ultima_rec['id'],
                'operacion' => 'Cobro recarga '.$_POST['operadora'],
                'signo' => '+',),

                array('id_cuenta' => $cuenta_vene,
                'c_transfer_vene_id' => null,
                'cuenta_banco_inter_id' => null,
                'monto' => $_POST['pago-recarga'],
                'pago_remesa_id' => null,
                'recargas_id' => $r_ultima_rec['id'],
                'operacion' => 'Pago recarga '.$_POST['operadora'],
                'signo' => '-',),
            );
            foreach ($datos_movi as $value) {
                $movi_bancos = ModeloMovimientosBancarios::mdlIngresarMovimiento($tabla_movi,$value);
            }


            //cobros y pago de las cuentas bancarias

            $tabla_inter_entrada = 'saldo_cuenta_inter';
            $item4 ='id';
            $valor4 =$cuenta_inter;
            $saldo_alctual_entrada = CuentaBancoInterController::ctrMostrarCuenta($item4, $valor4);

            $valor_saldo_entrada_inter= $saldo_alctual_entrada['saldo_inter'];
            $saldo_final_entrada = $valor_saldo_entrada_inter +  $_POST['pago-monto'];
            
            $sumar_r = array(
                "id" => $saldo_alctual_entrada["id_saldo"],
                "saldo_inter" => $saldo_final_entrada
            );
            $sumar = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter_entrada, $sumar_r);

            $tabla_vene_salida = 'saldo_cuenta_vene';
            $item3 ='id';
            $valor3 =$cuenta_vene;
            $saldo_alctual_salida = CuentaBancoVeneController::ctrMostrarCuenta($item3, $valor3);
            $valor_saldo_salida= $saldo_alctual_salida['saldo'];
            $saldo_final_salida =$valor_saldo_salida - $_POST['pago-recarga'];

            $restar_r = array(
                "id" =>$saldo_alctual_salida["id_saldo"],
                "saldo" => $saldo_final_salida
            );
            $restar = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene_salida, $restar_r);

            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡Se agrego la recarga correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "admin-recargas";
        
                    }
        
                    });
            
            </script>';
            }
       
        }
    }


    
//mostrar recargas en la tabla
static public function ctrMostrarRecargaAll(){
    $tabla = 'recargas';
            
    $respuesta = ModeloMontoRecarga::mdlMostrarRecargaAll($tabla);

    return $respuesta;
}




static public function ctrBorrarRecarga(){
    if(isset($_GET["idRecargas"])){
       
        $tabla="recargas";
  
        $id = $_GET["idRecargas"];
        $item = "id";

        $mostrar_pagos = ModeloMontoRecarga::mdlMostrarRecargaId($tabla,$item, $id);



        $tabla_inter = "saldo_cuenta_inter";
        $item_restar = 'id';
        $valor = $mostrar_pagos['cuenta_inter_id'];

        $cuenta_restar= CuentaBancoInterController::ctrMostrarCuenta($item_restar,$valor);
        $saldo_nuevo= $cuenta_restar['saldo_inter'] - $mostrar_pagos['monto']; 
        $datos = array(
            //cargar saldo
            "id" => $cuenta_restar['id_saldo'],
            "saldo_inter" =>$saldo_nuevo, 
                );

        $restar = ModeloSaldoCuentaInter::mdlRecargarSaldo($tabla_inter, $datos);

        $tabla_vene = "saldo_cuenta_vene";
        $item_sumar = 'id';
        $valor2 = $mostrar_pagos['cuenta_vene_id'];

        $cuenta_recargar= CuentaBancoVeneController::ctrMostrarCuenta($item_sumar,$valor2);
        $saldo_nuevo2= $cuenta_recargar['saldo'] + $mostrar_pagos['recarga']; 
        $datos2 = array(
        //cargar saldo
        "id" => $cuenta_recargar['id_saldo'],
        "saldo" => $saldo_nuevo2
             );
         
           $sumar = SaldoCuentaVeneModel::mdlRecargarSaldo($tabla_vene, $datos2);
        


      
        $respuesta = ModeloMontoRecarga::mdlBorrarRecarga($tabla, $id);
        if($respuesta=="ok"){
            echo '<script>

            swal({
                    type: "success",
                    title: "¡La recarga ha sido borrada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
    
                }).then((result)=>{
    
                if(result.value){
    
                    window.location = "admin-recargas";
    
                }
    
                });
        
        </script>';
        }
    }
}



}