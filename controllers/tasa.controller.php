<?php
class TasaController{

//crear monedas
static public function ctrCrearTasa(){
   
    if(isset($_POST['tasaCambio'])){
   
    if (preg_match('/^[0-9]*$/', $_POST["tasaCambio"])) 
        {
          
        
            $tabla = 'tasas';


            $datos = array(
                "pais" => $_POST["nuevoPaisTasa"],
                "moneda_id" => $_POST["nuevaMoneda"],
                "tasa_c" => $_POST["tasaCambio"],
                "moneda_t_id" => $_POST['monedaTasa']
            );

            $respuesta = ModeloTasa::mdlIngresarTasa($tabla, $datos);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡Se registro la tasa correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "tasa";
        
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
    
                    window.location = "tasa";
    
                }
    
                });
        
        </script>';
       
        }
 
       
    }
}


//mostrar tasas en la tabla
static public function ctrMostrarTasa($item,$valor){
    $tabla = 'tasas';
            
    $respuesta = ModeloTasa::mdlMostrarTasa($tabla, $item, $valor);

    return $respuesta;
}



//Editar Moneda

static public function ctrEditarTasa(){
    if(isset($_POST['editarMoneda'])){
        if (preg_match('/^[0-9]*$/', $_POST["editarMoneda"])) 
            {
              
            
            $tabla = 'tasas';


            $datos = array(
                "pais" => $_POST["editarPaisTasa"],
                "moneda_id" => $_POST["editarMoneda"],
                "moneda_t_id" => $_POST["editarmonedaTasa"],
                "tasa_c" => $_POST["editartasaCambio"],
                "id" => $_POST['editarIdTasa']
            );
    
               
                $respuesta = ModeloTasa::mdlEditarTasa($tabla, $datos);
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
            
                            window.location = "tasa";
            
                        }
            
                        });
                
                </script>';
                }
            } else{
                echo '<script>

                swal({
                        type: "error",
                        title: "¡Algo salio mal con el registro!",
                        text: "Los campos no deben ir vacios",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "tasa";
        
                    }
        
                    });
            
            </script>';
           
                }
     
           
        }
    }

    static public function ctrBorrarTasa(){
        if(isset($_GET["idTasa"])){
            $tabla="tasas";
            $datos = $_GET["idTasa"];

            $respuesta = ModeloTasa::mdlBorrarTasa($tabla, $datos);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡La tasa ha sido borrada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "tasa";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }

}