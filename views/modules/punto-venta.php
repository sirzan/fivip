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

        <!-- Default box -->
        <div class="card col-md-8 col-sm-12 order-sm-2">
          <div class="card-header">
            <h3 class="card-title">Lista de Boletos vendidos</h3>
    
          </div>
          <div class="card-body">
          
              <table id="user" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width:10px">#</th>
                      <th>Usuario</th>
                      <th>Nombre Usuario</th>
                      <th>rol</th>
                      <th>estado</th>
                      <th>Ultimo Login</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
         
                      
                    
                    </tbody>
                  </table>
             
              
          </div>
    
        </div>
        
            <div class="col-md-4 col-sm-12 order-sm-1">
        
                <!-- Default box -->
                <div class="card">
                  <div class="card-header bg-primary">
                    <h3 class="card-title">Punto de venta para Viajes</h3>   
                  </div>
                  <div class="card-body">
                      <div class="card card-primary">   
                        <div class="card-body">
                            <form action="">
                            <div class="form-group row">
          
                              <div class="input-group mb-3 col-md-6">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control" value="<?php echo $_SESSION["rol"]; ?>" readonly>
                              <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                              </div>
          
                                  <!--=====================================
                                  ENTRADA DEL CÓDIGO
                                  ======================================--> 
                                  <div class="input-group mb-3 col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                  </div>
          
                                  <input type="text" class="form-control" id="nuevaserie" name="nuevaserie" readonly>
          
                                  </div>
          
          
          
                              <div class="input-group mb-3 col-md-9">
          
                              <select class="form-control select2 select2bs4" style="width: 100%;" id="seleccionarCliente" name="seleccionarCliente" required>
                              <option value="" selected="selected">Seleccione un cliente</option>
                              </select>
                              </div>
          
                              <div class="input-group mb-3 col-md-3" >
          
                              <div class="input-group-prepend ">
          
                              <span class="input-group-text"><i class="fas fa-users"></i></span>
                              <span class="input-group-prepend"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-agregar-cliente" data-dismiss="modal">Nuevo cliente</button></span>
                              </div>
                              </div>
                              <div class="input-group mb-3 col-md-6">
                              <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                              </div>
          
                              <select class="form-control" id="nuevotipodocumento" name="nuevotipodocumento" required>
          
                              <option selected>-- Tipo de Documento --</option>
                              <option value="Pasaporte">Pasaporte</option>
                              <option value="Carnet E.">Carnet E.</option>
                              <option value="DNI">DNI</option>
                              <option value="Cedula de Identidad">Cedula de Identidad</option>
          
          
                              </select>
          
                              </div>
          
                              <div class="input-group mb-3 col-md-6">
                              <input type="number" class="form-control" id="nuevoNumeroDocumento" name="nuevoNumeroDocumento" placeholder="Numero de Documento" >
          
                              </div>
                              </div>
                                <input type="datetime-local"class="form-control" name="fechahora" id="fechahora">
                              <div class="form-group row">
                              <div class="input-group mb-3 col-md-6">
                              <label>Fecha y hora de Reservación:</label>
                              <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                              <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                              </div>
                              </div>
                              <div class="input-group mb-3 col-md-6">
                              <label>Fecha y hora de salida:</label>
                              <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                              <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                              </div>
                              </div>

                              </div>


                                <div class="form-group row">

                                <div class="col-md-12">
                                          <h5 class="text-center"><i class="fas fa-map-marked-alt"></i> Rutas de Salida</h5>
                                      </div>

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

                                <div class="col-md-12">
                                          <h5 class="text-center"><i class="fas fa-map-marked-alt"></i> Rutas de Destino</h5>
                                      </div>
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

                            <div class="form-group col-md-12">
                        <label>Serivicios adicionales</label>
                        <select class="form-control">
                          <option selected class="text-center">--- Seleccione un servicio -----</option>
                          <option>Con Guía</option>
                          <option>Sin Guía</option>
                        </select>
                      </div>
                            <div class="form-group col-md-12">
                                
                            <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="promotor">
                            <label class="custom-control-label" for="promotor">Añadir Promotor</label>
                            </div>
                 
                             </div>

                            <div class="form-group col-md-12 promotor">
                          
                 
                             </div>

                                </div>
                 

                                  <div class="form-group row d-flex justify-content-center">
                                      <div class="col-md-12">
                                          <h4 class="text-center"><i class="fas fa-arrow-alt-circle-down text-success"></i> Metodo de Pago</h4>
                                      </div>
                                      <div class="input-group col-md-3">
                                              <a href="" id="efectivo-viaje" class="btn btn-dark btn-block">Efectivo</a>
                                      </div>
                                      <div class="input-group col-md-6">
                                              <a href="" id="td-viaje" class="btn btn-dark btn-block">Transferencia / Deposito</a>
                                      </div>
                                      <div class="input-group col-md-3">
                                              <a href="" id="credito-viaje" class="btn btn-secondary btn-block">Credito</a>
                                      </div>
                                  </div>

                                  <div class="off-pago-viaje">

                                  </div>

                                  <div class="pt-2 mt-4" style="border-top:0.2px solid #CECECE;">
                                      <div class="form-group d-flex justify-content-center">
                                          <div class="input-group col-md-6">
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

 
 <!--MODAL AGREGAR USUARIOS -->
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
 <!--MODAL AGREGAR USUARIOS END-->