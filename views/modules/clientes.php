  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestor de Clientes</h1>
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

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar">Agregar Clientes</button>
        </div>
        <div class="card-body">
        <table id="cliente" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Cliente</th>
                    <th>Documento</th>
                    <th>Teléfono</th>
                    <th>Pais</th>
                
                    <th>cantivad de envios</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
      
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $data=$_SESSION['info'];
                    
                    $clientes = ClientesController::ctrMostrarClientes($item,$valor,$data);
               
                    foreach ($clientes as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['nombres'].' '.$value['apellidos'].'</td>
                     <td>'.$value['tipo_doc'].': '.$value['documento'].'</td>
                     <td>'.$value['telefono'].'</td>
                     <td>'.$value['pais'].'</td>
                     <td>'.$value['cantidad_env'].'</td>

                     <td> 
                       <button type="submit" data-toggle="modal" data-target="#modal-editar" class="btn btn-success btn-sm btnEditarCliente" idCliente="'.$value['id'].'" info="'.$data.'"><i class="fas fa-edit"></i></button>
                       <button type="submit" class="btn btn-danger btn-sm btnEliminarCliente" idCliente="'.$value['id'].'" info="'.$data.'"><i class="fas fa-trash-alt"></i></button>
                     </td>
                   </tr>';
                    }
                    ?>

                  </tbody>
                </table>
        </div>
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <!--MODAL AGREGAR USUARIOS -->
  <div class="modal fade" id="modal-agregar">
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
                                    $data=$_SESSION['info'];
                                $pais = PaisController::ctrMostrarApiPais($data);
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
         $data=$_SESSION['info'];
        $crearMoneda = new ClientesController();
        $crearMoneda -> ctrCrearCliente($data);

        ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->


 
 <!--MODAL EDITAR USUARIOS -->

  <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Editar Cliente</h4>
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
                   <select class="form-control" name="editarTipoDocumento" id="editarTipoDocumento">
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
                            <input type="number" class="form-control" name="editarnumeroDocumento" id="editarnumeroDocumento">
                        </div>
                    </div>
                 </div>
              
                   <div class="form-group">
                   <label>Nombres</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-id-badge"></i></span>
                            </div>
                            <input type="text" class="form-control" name="editarNombrecliente" id="editarNombrecliente">
                        </div>
                    </div>
                   <div class="form-group">
                   <label>Apellidos</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-id-badge"></i></span>
                            </div>
                            <input type="text" class="form-control" name="editarApellidocliente" id="editarApellidocliente">
                        </div>
                    </div>

                   <div class="form-group">
                   <label>Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="editartelefonoCliente" id="editartelefonoCliente" data-inputmask='"mask": "(+99) 999-999-999"' data-mask>
                        </div>
                    </div>
                  
                   <div class="form-group">
                   <label>Pais</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            </div>
                           <select class="form-control" name="editarpaisCliente" id="editarpaisCliente">
                               <option selected>-- Seleccione un pais --</option>
                               <?php 
                                    $data=$_SESSION['info'];
                                $pais = PaisController::ctrMostrarApiPais($data);
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
                           <input type="hidden" id="editarIdCliente" name="editarIdCliente">
                        </div>
                    </div>
                
              
                </div>
                    
             
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Registrar Tasa</button>
                </div>
          
                <?php
               $data=$_SESSION['info'];
                $editarCliente = new ClientesController();
                $editarCliente -> ctrEditarClientes($data);

                ?>  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 <!--MODAL editar USUARIOS END-->

 <?php
$borrarCliente = new ClientesController();
$borrarCliente->ctrBorrarCliente();
 ?>

