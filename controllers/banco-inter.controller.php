<?php

class BancoInterController{



//crear Bancos de venezuela
    static public function ctrCrearBancoInter(){
   
        if(isset($_POST['nuevoBancoInter'])){
       
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoBancoInter"])) 
            {
              
            
                $tabla = 'banco_inter';
    
    
                $datos = array(
                    "nombre" => $_POST["nuevoBancoInter"]
                );
    
                $respuesta = ModeloBancoInter::mdlIngresarBancoInter($tabla, $datos);
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
            
                            window.location = "banco";
            
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
        
                        window.location = "banco";
        
                    }
        
                    });
            
            </script>';
           
            }
     
           
        }
    }
    

    //mostrar Bancos de venezuela
    static public function ctrMostrarBancoInter($item,$valor){
        $tabla = 'banco_inter';
                
        $respuesta = ModeloBancoInter::mdlMostrarBancoInter($tabla, $item, $valor);

        return $respuesta;
    }


    
//Editar  Bancos de venezuela

static public function ctrEditarBancoInter(){
    if(isset($_POST['editarBancoInter'])){
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarBancoInter"])) 
            {
              
               
              
                $tabla = 'banco_inter';

                $datos = array(
                    "nombre" => $_POST["editarBancoInter"],
                    "id" => $_POST["editarId"]
                
                );
    
               
                $respuesta = ModeloBancoInter::mdlEditarBancoInter($tabla, $datos);
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
            
                            window.location = "banco";
            
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
        
                        window.location = "banco";
        
                    }
        
                    });
            
            </script>';
           
                }
     
           
        }
    }

//borrar bancos de venezuela
    static public function ctrBorrarBancoInter(){
        if(isset($_GET["idBancoInter"])){
            $tabla="banco_inter";
            $datos = $_GET["idBancoInter"];

            $respuesta = ModeloBancoInter::mdlBorrarBancoInter($tabla, $datos);
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
        
                        window.location = "banco";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }
}