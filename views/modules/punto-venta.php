<style>
  .tooltip {
    display:inline-block;
    position:relative;
    border-bottom:1px dotted #666;
    text-align:left;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Venta de Boletas de Viajes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div>
        </div> -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


    <div class="row">


        
            <div class="col-md-8 col-sm-12 m-auto">
        
                <!-- Default box -->
                <div class="card">
                  <div class="card-header bg-primary">
                    <h3 class="card-title">Punto de venta para Viajes</h3>   
                  </div>
                  <div class="card-body">
                      <div class="card card-primary">   
                        <div class="card-body">
                            <form action="" method="POST" id="formulario-boletos">
                            <div class="form-group row">
          
                              <div class="input-group mb-3 col-md-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control" value="<?php echo $_SESSION["rol"]; ?>" readonly>
                              <input type="hidden" name="idVendedor" id="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                              </div>
          
                                  <!--=====================================
                                  ENTRADA DEL CÓDIGO
                                  ======================================--> 
                                  <div class="input-group mb-3 col-md-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                  </div>
          
                                  <input type="text" class="form-control" id="nuevaserieViaje" name="nuevaserieViaje" readonly>
          
                                  </div>
          
          
          
                              <div class="input-group mb-3 col-md-8">
          
                              <select class="form-control select2 select2bs4" style="width: 100%;" id="seleccionarCliente" name="seleccionarCliente" required>
                              <option value="" selected="selected">Seleccione un cliente</option>
                              </select>
                              </div>
          
                              <div class="input-group mb-3 col-md-2" >
          
                              <div class="input-group-prepend ">
          
                              <span class="input-group-text"><i class="fas fa-users"></i></span>
                              <span class="input-group-prepend"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-agregar-cliente" data-dismiss="modal">Nuevo cliente</button></span>
                              </div>
                              </div>
                      
          
                           
                              </div>
                                <hr>
                              <div class="form-group row">

                              <div class="input-group mb-3 col-md-3">
                                <label>Fecha y hora de Reservación:</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="datetime-local"class="form-control" name="fechahoraR" id="fechahoraR">
                              
                                </div>
                              </div>

                              <div class="input-group mb-3 col-md-3">
                                <label>Fecha y hora de salida:</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="datetime-local"class="form-control" name="fechahoraS" id="fechahoraS">
                            
                                </div>
                              </div>

                              </div>

                              <hr>
                                <div class="form-group row">
                                  <div class="col-md-6">

                                    <div class="col-md-12">
                                              <h5 class="text-center"><i class="fas fa-map-marked-alt"></i> Rutas de Salida</h5>
                                          </div>
    
                                          <div class="row">

                                            <div class="input-group mb-3 col-md-6">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                </div>
                                              <select class="form-control" name="paisClienteSalida" id="paisClienteSalida">
                                                  <option selected>-- Pais de Salida --</option>
                                                
                                              </select>
                                            </div>
                                            <div class="input-group mb-3 col-md-6">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                </div>
                                              <select class="form-control" name="estadoClienteSalida" id="estadoClienteSalida">
                                                  <option selected>-- Estado de Salida --</option>
                                                
                                              </select>
                                            </div>
                                          </div>
    
                                    
                                  </div>
                                  <div class="col-md-6" style="border-left: 2px solid #007bff !important;">
                                      <div class="col-md-12">
                                              <h5 class="text-center"><i class="fas fa-map-marked-alt"></i> Rutas de Destino</h5>
                                      </div>
                                      <div class="row">
                                        <div class="input-group mb-3 col-md-6">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                        </div>
                                                    <select class="form-control" name="paisClienteDestino" id="paisClienteDestino">
                                                        <option selected>-- Pais de Destino --</option>
                                              
                                                    </select>
                                        </div>
                                        <div class="input-group mb-3 col-md-6">
                             
                                                  
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                        </div>
                                                    <select class="form-control" name="estadoClienteDestino" id="estadoClienteDestino">
                                                        <option selected>-- Estado de Destino --</option>
                                              
                                                    </select>
                                        </div>
                                      </div>
                                  </div>
                                  
                                </div>
                                <hr>
                        <div class="row">

                            <div class="form-group col-md-6">
                              <label>Serivicios adicionales</label>
                              <select class="form-control" name="serviciosA" id="serviciosA">
                                <option selected class="text-center">--- Seleccione un servicio -----</option>
                              </select>
                            </div>

                            <div class="col-md-2" style="margin-top:28px">
                                <button type="button" class="btn btn-primary btn-lg " style="font-size: 17px;" data-toggle="modal" data-target="#agregarServicios"> <i class="fas fa-plus-square"></i></button>
                                <button type="button" class="btn btn-danger btn-lg " style="font-size: 17px;" data-toggle="modal" data-target="#eliminarServicios"> <i class="fas fa-minus-square"></i></button>
                            </div>

                       

                        </div>

                      <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Observación</label>
                        <textarea class="form-control" rows="3" name="obs" id="obs"></textarea>
                      </div>
                    </div>
                            <div class="form-group col-md-12">
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="promotor">
                                  <label class="custom-control-label" for="promotor">Añadir Promotor</label>
                              </div>
                            </div>

                            <div class="form-group col-md-6 promotor"></div>
                            
                            <div class="row">

                              <div class="input-group mb-3 col-md-6">
                                  
                                   <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                                    </div>
                                                <select class="form-control" name="tipoMoneda" id="tipoMoneda">
                                                    <option value="" selected>-- Tipo de moneda --</option>
                                                    <?php 
               
                                                    $valor=null;
                                                    $item=null;
                                                    $monedas = MonedaController::ctrMostrarMonedas($item,$valor);
                                                    // var_dump($bancosvene);
                                                    if($monedas){
                                                      foreach ($monedas as $key => $value) {
                                                      echo '<option value="'.$value["iso"].'">'.$value["moneda"].' ('.$value["iso"].')</option>';
                                                      }
                                                    }else{
                                                      echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                                                    }
                                                    ?>
                                                </select>        
                                           </div>
                                              <div class="form-group col-md-2 ">
                        
                                                  <div class="input-group ">
                                                  <div class="input-group-prepend">
                                                  <span class="input-group-text tipo-moneda"></span>
                                                </div>
                                                  <input type="number" step="any" name="costo" class="form-control costo" placeholder="Ingrese el costo">
                                              
                                             
                                                  </div>
                                                  </div>

                                            </div>


                                  <div class="form-group row">
                                  <div class="col-md-12 p-3 card order-md-2">
                                      <div class="mb-3 d-flex justify-content-center">
                                            <a class="btn btn-dark mr-1 col-md-3" id="m-efectivoP">Efectivo <i class="fas fa-plus-square"></i></a>
                                            <a class="btn btn-dark mr-1 col-md-5" id="m-dtP">Deposito o Transferencia <i class="fas fa-plus-square"></i></a>
                                            <a class="btn btn-secondary col-md-3" id="m-credP">Crédito</a>
                                          </div>

                                          <!-- METODO DE DEPOSITO -->
                                          <div class="off-deposito-pago">
                                            <div class="contenedor-texto">
                                              <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>
                                            </div>

                                          </div>
                                          <!-- METODO DE DEPOSITO END-->
                                      </div>



                                  </div>


                                  <div class="pt-2 mt-4" style="border-top:0.2px solid #CECECE;">
                                      <div class="form-group d-flex justify-content-center">
                                          <div class="input-group col-md-6">
                                          <input type="hidden" id="tipoBancoEntradaBoleto">
                                          <input type="hidden" id="tipoPagoBtn">
                                                  <button type="submit" class="btn btn-success btn-block p-2"><strong style="font-size: 20px;">Registrar Boleto</strong></button>
                                          </div>
                                      </div>
                                </div>

                            </form>
                         
          
                        </div>
                        <!-- /.card-body -->
                      </div>
          
              
          
                  </div>
          
                </div>
                <!-- /.card -->
            </div>
        <!-- /.card -->
    </div>


    </section>
    <!-- /.content -->
  </div>




  
<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

 
 <!--MODAL AGREGAR CLIENTE -->
 <div class="modal fade" id="modal-agregar-cliente">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Agregar nueva cliente</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <div class="row">
                 <div class="form-group col-md-6">
                <label>Tipo de documento</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                    </div>
                   <select class="form-control" name="tipoDocumento" id="tipoDocumento">
                       <option selected>-- Seleccione un tipo de documento --</option>
                       <option value="Pasaporte">Pasaporte</option>
                       <option value="DNI">DNI</option>
                       <option value="Carnet Ext.">Carnet de Extranjeria</option>
                       <option value="Cedula de Identidad">Cedula de Identidad</option>
                   </select>
                </div>
            </div>
                   <div class="form-group col-md-6">
                   <label>N° de documento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                            </div>
                            <input type="number" class="form-control" name="numeroDocumento" id="numeroDocumento" placeholder="Numero de documento">
                        </div>
                    </div>
                 </div>
              
                   <div class="form-group">
                   <label>Nombres</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-id-badge"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nuevoNombrecliente" id="nuevoNombrecliente" placeholder="Escriba el nombre del cliente">
                        </div>
                    </div>
                   <div class="form-group">
                   <label>Apellidos</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-id-badge"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nuevoApellidocliente" id="nuevoApellidocliente" placeholder="Escriba el apellido del cliente">
                        </div>
                    </div>

                   <div class="form-group">
                   <label>Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="telefonoCliente" data-inputmask='"mask": "(+99) 999-999-9999"' data-mask placeholder="Escriba el teléfono de contacto">
                        </div>
                    </div>
                  
                   <div class="form-group">
                   <label>Pais</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            </div>
                           <select class="form-control" name="paisCliente" id="paisCliente">
                               <option selected>-- Seleccione un pais --</option>
                               <?php 
                                
                                $pais = PaisController::ctrMostrarApiPais();
                                // var_dump($pais);
                            
                                if($pais){
                                foreach ($pais as $key => $value) {
                                echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
                                }
                                }else{
                                echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                                }
                                ?>
                           </select>
                        </div>
                    </div>
                
              
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" name="registerBoleto" class="btn btn-primary">Registrar Cliente</button>
                </div>
                        <?php
        
        $crearMoneda = new ClientesController();
        $crearMoneda -> ctrCrearCliente();

        ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR CLIENTE END-->


    <!-----------------------  -->
    <!-- AGREGAR NUEVO SERVICIOS -->
    <!-----------------------  -->
 <!-- Modal -->
<div class="modal fade" id="agregarServicios" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
          <form  method="POST" id="form-servicios">
            <div class="modal-header bg-primary">
              <h5 class="modal-title" id="exampleModalLongTitle">Agregar servicio adicional</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="text" class="form-control" id="serviciosAdicional" name="serviciosAdicional" placeholder="Ingrese la descripcion del servicios">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
      </form>             

    </div>
  </div>
</div>


    <!-----------------------  -->
    <!-- ELIMINAR SERVICIOS -->
    <!-----------------------  -->
 <!-- Modal -->
<div class="modal fade" id="eliminarServicios" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar servicio adicional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body table-responsive p-0" style="height: 200px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                   
                      <th>Descripción</th>
                      <th>Accion</th>
               
                    </tr>
                  </thead>
                  <tbody id="listaServicios">
                    
                  </tbody>
                </table>
              </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>