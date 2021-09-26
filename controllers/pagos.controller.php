<?php

class PagosController{

//mostrar monedas en la tabla
static public function ctrMostrarPagos($item,$valor){
    $tabla = 'remesas';
            
    $respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

    return $respuesta;
}
static public function ctrEditarUsuarios(){
    if(isset($_POST['MetodoPago'])){
    
 
                $tabla = 'remesas';

                if (isset($_POST['numero_deposito'])) {
                    $nDeposito =$_POST['numero_deposito'];
                }else{
                    $nDeposito =null;
                }
                if (isset($_POST['bancoTrans'])) {
                    $bTrans =$_POST['bancoTrans'];
                }else{
                    $bTrans =null;
                }
               
            
                $datos = array(
                    "metodo_pago" => $_POST['MetodoPago'],
                    "pago_m_p" => $_POST["pagoefectivo"],
                    "n_trans" =>  $nDeposito,
                    "banco_trans" =>  $bTrans,
                    "id" =>  $_POST['idPagoRemesa'],
                    "estado" =>  1
                );
               var_dump( $datos);
                $respuesta = ModeloPagos::mdlEditarPagos($tabla, $datos);
                if($respuesta=="ok"){
                    echo '<script>

                    swal({
                            type: "success",
                            title: "¡El pago se registro correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
            
                        }).then((result)=>{
            
                        if(result.value){
            
                            window.location = "pagos-pendientes";
            
                        }
            
                        });
                
                </script>';
                }
            
     
           
        }
    }



    

}


