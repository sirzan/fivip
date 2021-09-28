<?php
class ControladorRecargas{

//crear monedas
static public function ctrCrearRecarga(){
   
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
            $respuesta = ModeloRecarga::mdlIngresarRecarga($tabla, $datos);
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
static public function ctrMostrarRecarga($item,$valor){
    $tabla = 'monto_recarga_m';
            
    $respuesta = ModeloRecarga::mdlMostrarRecarga($tabla, $item, $valor);

    return $respuesta;
}



//Editar Moneda

static public function ctrEditarTasa(){
    if(isset($_POST['editarMoneda'])){
     
            
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