<?php

class ControladorUsuarios{
    
    static public function ctrInicioSesion(){
        if(isset($_POST['user'])){

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["user"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])){

                $tabla = 'usuarios';
                
                $item = 'usuario';
                $info= null;
                $valor = $_POST["user"];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla,$item,$valor,$info);

                // var_dump($respuesta["password"]);

                
                if($respuesta && $respuesta["usuario"] == $_POST["user"] && password_verify($_POST["password"], $respuesta["password"])){
                  
                    if($respuesta["estado"] == 1){

                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["usuario"] = $respuesta["nom_user"];
                        $_SESSION["rol"] = $respuesta["rol"];
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["info"] = $respuesta["info"];
                        $_SESSION["iso"] = $respuesta["iso"];
    
                        date_default_timezone_set('America/Lima');

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');

                        $fechaActual = $fecha.' '.$hora;

                       $item1 = 'login_time';
                       $valor1 = $fechaActual;

                       $item2 = 'id';
                       $valor2 = $respuesta["id"];

                        $ultimo_login = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
                        if($ultimo_login == 'ok'){
                            echo '<script>
                            window.location = "inicio";
                            </script>';
                        }
                            
                    }else{
                        echo '<br><div class="alert alert-danger">El usuario no se encuentra activado</div>';
                    }
                }else{
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
        }
        }

    }

    static public function ctrCrearUsuario($info){
   
        if(isset($_POST['nuevoUsuario'])){
       
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
         preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) 
            {
              
            
                $tabla = 'usuarios';

                $contraseña = password_hash($_POST["nuevoPassword"], PASSWORD_BCRYPT);

                $datos = array(
                    "usuario" => $_POST['iso'].$_POST["nuevoUsuario"],
                    "rol" => $_POST["rol"],
                    "nom_user" => $_POST["nuevoNombre"],
                    "password" => $contraseña,
                    "info"=>$info
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
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
            
                            window.location = "usuario";
            
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
        
                        window.location = "usuario";
        
                    }
        
                    });
            
            </script>';
           
            }
     
           
        }
    }

    static public function ctrMostrarUsuarios($item, $valor,$info){
        $tabla = 'usuarios';
                
        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor,$info);

        return $respuesta;
    }

    static public function ctrEditarUsuarios(){
        if(isset($_POST['editarUsuario'])){
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
             preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"])) 
                {
                  
                    if($_POST["editarPassword"] != ""){

                        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPassword'])) {
                          
                         
                          $contraseña = password_hash($_POST["editarPassword"], PASSWORD_BCRYPT);
                        //   $tabla = 'usuarios';

              
  
                        //   $datos = array(
                        //       "usuario" => $_POST["editarUsuario"],
                        //       "rol" => $_POST["editarRol"],
                        //       "nom_user" => $_POST["editarNombre"],
                        //       "password" => $contraseña,
                        //   );
                        // //   var_dump($datos);
                        //   $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
                        //   if($respuesta=="ok"){
                        //       echo '<script>
          
                        //       swal({
                        //               type: "success",
                        //               title: "¡El usuario se registro correctamente!",
                        //               showConfirmButton: true,
                        //               confirmButtonText: "Cerrar",
                        //               closeOnConfirm: false
                      
                        //           }).then((result)=>{
                      
                        //           if(result.value){
                      
                        //               window.location = "usuario";
                      
                        //           }
                      
                        //           });
                          
                        //   </script>';
                        //   }
    
                        }else{
                            echo'<script>
    
                            swal({
                                  type: "error",
                                  title: "¡La contraseña no puede llevar caracteres especiales!",
                                  showConfirmButton: true,
                                  confirmButtonText: "Cerrar"
                                  }).then(function(result){
                                    if (result.value) {

                                    window.location = "usuario";

                                    }
                                })

                          </script>';
                           
                        }
    
                    }else{
    
                        $contraseña = $_POST["actualPassword"];
                      
                    }
                  
                    $tabla = 'usuarios';

                    $datos = array(
                        "usuario" => $_POST["editarUsuario"],
                        "rol" => $_POST["editarRol"],
                        "nom_user" => $_POST["editarNombre"],
                        "password" => $contraseña,
                    );
                   
                    $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
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
                
                                window.location = "usuario";
                
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
            
                            window.location = "usuario";
            
                        }
            
                        });
                
                </script>';
               
                    }
         
               
            }
        }
    static public function ctrBorrarUsuario(){
        if(isset($_GET["idUsuario"])){
            $tabla="usuarios";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);
            if($respuesta=="ok"){
                echo '<script>

                swal({
                        type: "success",
                        title: "¡El usuario ha sido borrado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
        
                    }).then((result)=>{
        
                    if(result.value){
        
                        window.location = "usuario";
        
                    }
        
                    });
            
            </script>';
            }
        }
    }

}