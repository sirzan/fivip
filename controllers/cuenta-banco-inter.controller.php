<?php

class CuentaBancoInterController{

//crear cuenta bancaria internacional
    static public function ctrCrearCuenta($info){
   
        if(isset($_POST['nuevoNombreTitularInter'])){
       
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreTitularInter"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoTitularInter"])) 
            {
              
            
                $tabla = 'cuenta_banco_inter';
                $tabla2 = 'saldo_cuenta_inter';
    
    
                $datos = array(
                    "n_titular_inter" => $_POST["nuevoNombreTitularInter"],
                    "a_titular_inter" => $_POST["nuevoApellidoTitularInter"],
                    "banco_inter_id" => $_POST["seleccionarBancoInter"]
                );

                //crear cuenta saldo 
                $respuesta = ModeloBancoCuentaInter::mdlIngresarCuenta($tabla, $datos,$info);
            

                 $respuesta2 = ModeloBancoCuentaInter::mdlMostrarUltimaCuenta($info);
                  
                 $datos2 = array(
                     "saldo_inter" => 0,
                     "cuenta_inter_id" => $respuesta2['id'],
                     "moneda_inter_id" => $_POST["seleccionarMonedaInter"]
                    );
              
                $respuesta3 =  ModeloSaldoCuentaInter::mdlCrearSaldo($tabla2, $datos2,$info);
                    
                if($respuesta=="ok"){
                    echo '<script>
    
                    swal({
                            type: "success",
                            title: "¡La cuenta ha sido creada correctamente!",
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
    
            } else{
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
        
                        window.location = "banco-cuentas-inter";
        
                    }
        
                    });
            
            </script>';
           
            }
           
        }
    }

//Mostrar cuenta bancaria internacional
    static public function ctrMostrarCuenta($item,$valor,$info){
        $tabla = 'cuenta_banco_inter';
                
        $respuesta = ModeloBancoCuentaInter::mdlMostrarCuenta($tabla, $item, $valor,$info);
        
        return $respuesta;
    }





 

}