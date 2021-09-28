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
            $datos = $_GET["idMontoR"];

            $respuesta = ModeloMontoRecarga::mdlBorrarMontoRecarga($tabla, $datos);
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
        
                        window.location = "crear-monto";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }

}