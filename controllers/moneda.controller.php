<?php

class MonedaController{

//crear monedas
    static public function ctrCrearMoneda(){
   
        if(isset($_POST['nuevoMoneda'])){
       
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoMoneda"])) 
            {
              
            
                $tabla = 'monedas';
    
    
                $datos = array(
                    "moneda" => $_POST["nuevoMoneda"],
                    "simbolo" => $_POST["nuevoSimbolo"],
                    "iso" => $_POST["nuevoIso"],
                    "pais" => $_POST['nuevoPais'],
                );
    
                $respuesta = ModeloMoneda::mdlIngresarMoneda($tabla, $datos);
                if($respuesta=="ok"){
                    echo '<script>
    
                    swal({
                            type: "success",
                            title: "¡El usuario se registro correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "moneda";
            
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
        
                        window.location = "moneda";
        
                    }
        
                    });
            
            </script>';
           
            }
     
           
        }
    }

//mostrar monedas en la tabla
    static public function ctrMostrarMonedas($item,$valor){
        $tabla = 'monedas';
                
        $respuesta = ModeloMoneda::mdlMostrarMonedas($tabla, $item, $valor);

        return $respuesta;
    }




//Editar Moneda

static public function ctrEditarMoneda(){
    if(isset($_POST['editarMoneda'])){
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMoneda"])) 
            {
              
               
              
                $tabla = 'monedas';

                $datos = array(
                    "moneda" => $_POST["editarMoneda"],
                    "simbolo" => $_POST["editarSimbolo"],
                    "iso" => $_POST["editarIso"],
                    "pais" => $_POST['editarPais'],
                    "id" => $_POST['editarIdMoneda'],
                );
    
               
                $respuesta = ModeloMoneda::mdlEditarMoneda($tabla, $datos);
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
            
                            window.location = "moneda";
            
                        }
            
                        });
                
                </script>';
                }
            } else{
                echo '<script>

                swal({
                        type: "error",
                        title: "¡Algo salio mal con el registro!",
                        text: "El usuario o el nombre no deben ir vacios",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "moneda";
        
                    }
        
                    });
            
            </script>';
           
                }
     
           
        }
    }

    static public function ctrBorrarMoneda(){
        if(isset($_GET["idMoneda"])){
            $tabla="monedas";
            $datos = $_GET["idMoneda"];

            $respuesta = ModeloMoneda::mdlBorrarMoneda($tabla, $datos);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡La moneda ha sido borrada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "moneda";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }

}