<div class="content-wrapper">

      <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Enviar Remesas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Tablero</li>
             
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
     
        <div class="card card-primary card-outline">
          
          <div class="card-header"></div>

          <form role="form" method="POST"  class="formularioVenta">

            <div class="card-body">
  
           

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
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

                </div> 

             



                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group row">
                  
           
                  
                  <div class="input-group mb-3 col-md-9">
                  <!-- <div class="input-group-prepend mb-3 ">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                    <span class="input-group-prepend"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-editar-cliente" data-dismiss="modal">Nuevo cliente</button></span>
                  </div> -->
                 
                  
                  <select class="form-control select2 select2bs4" style="width: 100%;" id="seleccionarCliente" name="seleccionarCliente" required>
                    <option value="" selected="selected">Seleccione un cliente</option>
           
                  </select>
                </div>
                <div class="input-group mb-3 col-md-3 pl-4" >
                  <div class="input-group-prepend ">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                    <span class="input-group-prepend"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-agregar-cliente" data-dismiss="modal">Nuevo cliente</button></span>
                  </div>
                </div>
                
              


                  <div class="input-group mb-3 col-md-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nuevoreceptor" name="nuevoreceptor" placeholder="Nombre del receptor" >
                 
                </div>

                <div class="input-group mb-3 col-md-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                  </div>
                    
                    <select class="form-control" id="nuevotipodocumento" name="nuevotipodocumento" required>

                    <option selected>-- Seleccione Documento --</option>
                    <option value="Pasaporte">Pasaporte</option>
                    <option value="Carnet E.">Carnet E.</option>
                    <option value="DNI">DNI</option>
                    <option value="Cedula de Identidad">Cedula de Identidad</option>
         

                    </select>
                    
                  </div>

                  <div class="input-group mb-3 col-md-3">
                  <input type="number" class="form-control" id="nuevoNumeroDocumento" name="nuevoNumeroDocumento" placeholder="Numero de Documento" >
                  
                </div>
                
                <!-- validar los bancos -->
                <div class="col-md-12" id="divRadios">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="bancovene" value="bancovene" name="banco" >
                        <label >
                          Bancos de Venezuela
                        </label>
                      </div>
                 
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="bancointer" value="bancointer" name="banco">
                        <label>
                         Bancos Internacionales
                        </label>
                      </div>
                    </div>
                  </div>
                <!-- validar end -->

                <div class="input-group mb-3 col-md-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                  </div>
                    
                    <select class="form-control bancoselect" id="seleccionarBanco" name="seleccionarBanco" required>

                    <option value="" selected>-- Seleccionar banco --</option>


                    </select>
                    
                  </div>

                  <div class="input-group mb-3 col-md-2 bancocode">
                  
                  <input type="text" class="form-control" id="bancocode" name="bancocode" placeholder="codigo banco" readonly>
                  
                </div>
                  <div class="input-group mb-3 col-md-4">
                  
                  <input type="number" class="form-control" id="cuenta-banco" name="cuenta-banco" placeholder="Cuenta bancaria">
                  
                </div>

           
                <div class="input-group mb-3 col-md-6 bancomovil-off" style="display: none;">
                  <div class="input-group-prepend colocarpagomovil">
                    <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                  </div>
                    
                 
                    
                  </div>


                <div class="input-group mb-3 col-md-12">
               
                        <label>Observación</label>
                        <textarea class="form-control" rows="3" id="observacion" name="observacion" placeholder="Escriba alguna observación..." style="margin-top: 0px; margin-bottom: 0px; width: 100%"></textarea>
                      
                 
                </div>

                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                    <div id="pedre">

                      <div class="form-group row" id="nuevoProducto">
      
                     
                         
                    
      
                      </div>
                    </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <!-- <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button> -->

                

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-mb-12">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Cantido de envio</th>
                          <th>Envio total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td>
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="pagoremesa" name="pagoremesa" placeholder="0" required>

                              <!-- <span class="input-group-addon"><i class="fa fa-percent"></i></span> -->
                        
                            </div>

                          </td>

                           <td>
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="number" class="form-control input-lg" id="totalremesa" step="any" name="totalremesa"  placeholder="0" readonly  required>

                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
            
                <div class="form-group row">
            
                     <div class="input-group mb-3 col-md-3 pagometodo">
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="" selected>Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Desposito">Deposito</option>
                        <option value="Transferencia">Transferencia</option>                  
                        <option value="Por verificar">Por Verificar</option>                  
                      </select>    

                    </div>


                    </div>

               

               

                <br>
      
              

          </div>

          <div class="card-footer">

            <button type="submit" id="idboton" class="btn btn-primary pull-right">Enviar Remesa</button>

            <!-- <button type="submit" class="btn btn-primary pull-right" name="imprimirTicket">Enviar Remesa - Imprimir ticket</button> -->

          </div>

         
        </form>

        <?php
            
            $crearRemesa = new RemesasController();
            $crearRemesa -> ctrCrearRemesa();

            ?> 

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
      <div class="card card-warning card-outline">
          
          <div class="card-header"></div>

          <div class="card-body">
            
          <table id="user" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Pais</th>
                    <th>Moneda</th>
                    <th>Simbolo</th>
                    <th>Iso</th>
                    <th>Tasa Cambio</th>
                    <th>Simbolo Tasa</th>
                    <th>Iso Tasa</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $tasas = TasaController::ctrMostrarTasa($item,$valor);
         
                    foreach ($tasas as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['pais'].'</td>
                     <td>'.$value['moneda'].'</td>
                     <td>'.$value['simbolo'].'</td>
                     <td>'.$value['iso'].'</td>
                     <td>'.number_format($value['tasa_c'],4,'.','').'</td>
                     <td>'.$value['simbolo_tasa'].'</td>
      
                     <td>'.$value['iso_tasa'].'</td>

                     <td> 
                     <button type="submit" class="btn btn-primary btn-sm botonagregar" selectTasa="'.$value['id'].'">Agregar</button>
                     
                   </td>
                   </tr>';
                    }
                    ?>
        
                  </tbody>
                </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

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
                            <input type="text" class="form-control" name="telefonoCliente" data-inputmask='"mask": "(+99) 999-999-999"' data-mask placeholder="Escriba el teléfono de contacto">
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
                  <button type="submit" class="btn btn-primary">Registrar Cliente</button>
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