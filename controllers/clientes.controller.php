<?php

class ClientesController{

        //crear monedas
    static public function ctrCrearCliente(){
   
        if(isset($_POST['nuevoNombrecliente'])){
       
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombrecliente"])
        && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidocliente"])
        &&preg_match('/^[0-9]*$/', $_POST["numeroDocumento"])) 
            {
              
            
                $tabla = 'clientes';
    
    
                $datos = array(
                    "nombres" => $_POST["nuevoNombrecliente"],
                    "apellidos" => $_POST['nuevoApellidocliente'],
                    "tipo_doc" => $_POST["tipoDocumento"],
                    "documento" => $_POST["numeroDocumento"],
                    "telefono" => $_POST['telefonoCliente'],
                    "pais" => $_POST['paisCliente'],
                );
    
                $respuesta = ModeloCliente::mdlIngresarCliente($tabla, $datos);
                if($respuesta=="ok"){
                    echo '<script>
    
                    swal({
                            type: "success",
                            title: "¡El Cliente se registro correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "clientes";
            
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
        
                        window.location = "clientes";
        
                    }
        
                    });
            
            </script>';
           
            }
     
           
        }
    }


    
//mostrar monedas en la tabla
static public function ctrMostrarClientes($item,$valor){
    $tabla = 'clientes';
            
    $respuesta = ModeloCliente::mdlMostrarClientes($tabla, $item, $valor);

    return $respuesta;
}


//Editar Moneda

static public function ctrEditarClientes(){
    if(isset($_POST['editarNombrecliente'])){
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombrecliente"])
        && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidocliente"])
        &&preg_match('/^[0-9]*$/', $_POST["editarnumeroDocumento"])) 
            {
              
               
              
                $tabla = 'clientes';

                $datos = array(
                    "nombres" => $_POST["editarNombrecliente"],
                    "apellidos" => $_POST['editarApellidocliente'],
                    "tipo_doc" => $_POST["editarTipoDocumento"],
                    "documento" => $_POST["editarnumeroDocumento"],
                    "telefono" => $_POST['editartelefonoCliente'],
                    "pais" => $_POST['editarpaisCliente'],
                    "id" => $_POST['editarIdCliente'],
                );
    
               
                $respuesta = ModeloCliente::mdlEditarCliente($tabla, $datos);
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
            
                            window.location = "clientes";
            
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
        
                        window.location = "clientes";
        
                    }
        
                    });
            
            </script>';
           
                }
     
           
        }
    }


    static public function ctrBorrarCliente(){
        if(isset($_GET["idCliente"])){
            $tabla="clientes";
            $datos = $_GET["idCliente"];

            $respuesta = ModeloCliente::mdlBorrarCliente($tabla, $datos);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡El Cliente ha sido borrado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "clientes";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }

}
