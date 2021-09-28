  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Monedas</h1>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar-moneda">Agregar Moneda</button>
        </div>
        <div class="card-body">
        <table id="user" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Moneda</th>
                    <th>Simbolo</th>
                    <th>iso</th>
                    <th>Pais</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
       
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $monedas = MonedaController::ctrMostrarMonedas($item,$valor);
                    foreach ($monedas as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['moneda'].'</td>
                     <td>'.$value['simbolo'].'</td>
                     <td>'.$value['iso'].'</td>
                     <td>'.$value['pais'].'</td>

                     <td> 
                       <button type="submit" data-toggle="modal" data-target="#modal-editar-moneda" class="btn btn-success btn-sm btnEditarMoneda" idMoneda="'.$value['id'].'"><i class="fas fa-edit"></i></button>
                       <button type="submit" class="btn btn-danger btn-sm btnEliminarMoneda" idMoneda="'.$value['id'].'"><i class="fas fa-trash-alt"></i></button>
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
  <div class="modal fade" id="modal-agregar-moneda">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Agregar nueva moneda</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                <label>Pais</label>
                            <select class="form-control" id="nuevoPais" name="nuevoPais">
                              <option selected>-- Seleccione un Pais --</option>
                          
                       <?php 
             
             $pais = PaisController::ctrMostrarApiPais();
             // var_dump($pais);
         
             if($pais){
               foreach ($pais as $key => $value) {
               echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
               }
             }else{
              echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
             }
             ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="nuevoMoneda">Moneda</label>
                            <input type="text" class="form-control" id="nuevoMoneda" name="nuevoMoneda" placeholder="Nombre de la moneda">
                        </div>
                          <div class="form-group">
                            <label for="nuevoSimbolo">Simbolo</label>
                            <input type="text" class="form-control" id="nuevoSimbolo" name="nuevoSimbolo" placeholder="Simbolo de la moneda">
                        </div>
                          <div class="form-group">
                            <label for="nuevoIso">Iso</label>
                            <input type="text" class="form-control" id="nuevoIso" name="nuevoIso" placeholder="Escriba el ISO de la moneda">
                        </div>

                      
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Registrar Moneda</button>
                </div>
                <?php
  
                $crearMoneda = new MonedaController();
                $crearMoneda -> ctrCrearMoneda();

              ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->


 
 <!--MODAL EDITAR USUARIOS -->

  <div class="modal fade" id="modal-editar-moneda">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Editar Moneda</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                <label>Pais</label>
                            <select class="form-control" id="editarPais" name="editarPais">
                              <option selected>-- Seleccione un Pais --</option>
                           
                                    <?php 
                          
                                    $pais = PaisController::ctrMostrarApiPais();
                                    // var_dump($pais);
                                
                                    if($pais){
                                      foreach ($pais as $key => $value) {
                                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                      }
                                    }else{
                                      echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                                    }
                                    ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="nuevoMoneda">Moneda</label>
                            <input type="text" class="form-control" id="editarMoneda" name="editarMoneda">
                        </div>
                          <div class="form-group">
                            <label for="nuevoSimbolo">Simbolo</label>
                            <input type="text" class="form-control" id="editarSimbolo" name="editarSimbolo">
                        </div>
                          <div class="form-group">
                            <label for="nuevoIso">Iso</label>
                            <input type="text" class="form-control" id="editarIso" name="editarIso">
                            <input type="hidden" class="form-control" id="editarIdMoneda" name="editarIdMoneda">
                        </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Guardar Modificaciones</button>
                </div>
                 <?php
  
                  $crearUsuario = new MonedaController();
                  $crearUsuario -> ctrEditarMoneda();
  
                ?> 
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 <!--MODAL editar USUARIOS END-->


 <?php
 $borrarUsuario = new MonedaController();
 $borrarUsuario->ctrBorrarMoneda();
 ?>