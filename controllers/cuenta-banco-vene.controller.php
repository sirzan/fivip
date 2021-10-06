<?php

class CuentaBancoVeneController{

//crear monedas
    static public function ctrCrearCuenta(){
   
        if(isset($_POST['nuevoNombreTitular'])){
       
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreTitular"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoTitular"])) 
            {
              
            
                $tabla = 'cuenta_banco_vene';
    
    
                $datos = array(
                    "n_titular" => $_POST["nuevoNombreTitular"],
                    "a_titular" => $_POST["nuevoApellidoTitular"],
                    "banco_id" => $_POST["seleccionarBanco"]
                );
    
                $respuesta = ModeloBancoCuentaVene::mdlIngresarCuenta($tabla, $datos);
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
            
                            window.location = "banco-cuentas-venezuela";
            
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
        
                        window.location = "banco-cuentas-venezuela";
        
                    }
        
                    });
            
            </script>';
           
            }
     
           
        }
    }

//mostrar monedas en la tabla
    static public function ctrMostrarCuenta($item,$valor){
        $tabla = 'cuenta_banco_vene';
                
        $respuesta = ModeloBancoCuentaVene::mdlMostrarCuenta($tabla, $item, $valor);

        return $respuesta;
    }





 

}