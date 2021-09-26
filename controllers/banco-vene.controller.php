<?php

class BancoVeneController{



//crear Bancos de venezuela
    static public function ctrCrearBancoVene(){
   
        if(isset($_POST['nuevoBancoVene'])){
       
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoBancoVene"])) 
            {
              
            
                $tabla = 'banco_vene';
    
    
                $datos = array(
                    "nombre" => $_POST["nuevoBancoVene"],
                    "codigo" => $_POST["nuevoCodigo"],
                );
    
                $respuesta = ModeloBancoVene::mdlIngresarBancoVene($tabla, $datos);
                if($respuesta=="ok"){
                    echo '<script>
    
                    swal({
                            type: "success",
                            title: "¡El banco se registro correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "banco-venezuela";
            
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
        
                        window.location = "banco-venezuela";
        
                    }
        
                    });
            
            </script>';
           
            }
     
           
        }
    }
    

    //mostrar Bancos de venezuela
    static public function ctrMostrarBancoVene($item,$valor){
        $tabla = 'banco_vene';
                
        $respuesta = ModeloBancoVene::mdlMostrarBancoVene($tabla, $item, $valor);

        return $respuesta;
    }


    
//Editar  Bancos de venezuela

static public function ctrEditarBancoVene(){
    if(isset($_POST['editarBancoVene'])){
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarBancoVene"])) 
            {
              
               
              
                $tabla = 'banco_vene';

                $datos = array(
                    "nombre" => $_POST["editarBancoVene"],
                    "codigo" => $_POST["editarCodigo"],
                    "id" => $_POST["editarId"]
                
                );
    
               
                $respuesta = ModeloBancoVene::mdlEditarBancoVene($tabla, $datos);
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
            
                            window.location = "banco-venezuela";
            
                        }
            
                        });
                
                </script>';
                }
            } else{
                echo '<script>

                swal({
                        type: "error",
                        title: "¡Algo salio mal con el registro!",
                        text: "El los campos no deben ir vacios",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "banco-venezuela";
        
                    }
        
                    });
            
            </script>';
           
                }
     
           
        }
    }

//borrar bancos de venezuela
    static public function ctrBorrarBancoVene(){
        if(isset($_GET["idBancoVene"])){
            $tabla="banco_vene";
            $datos = $_GET["idBancoVene"];

            $respuesta = ModeloBancoVene::mdlBorrarBancoVene($tabla, $datos);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡El Banco ha sido borrado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "banco-venezuela";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }
}