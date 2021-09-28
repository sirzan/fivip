<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Recargas Moviles</h1>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar-monto">Crear Monto</button>
        </div>
        <div class="card-body">
        <table id="user" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Operadora</th>
                    <th>Monto</th>
                    <th>Total Recarga</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $recargas = ControladorMontoRecargas::ctrMostrarMontoRecarga($item,$valor);
            
                    foreach ($recargas as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['operadora'].'</td>
                     <td>'.$value['simbolo_monto'].''.number_format($value['monto'],2,',','.').' ('.$value['iso_monto'].')</td>
                     <td>'.$value['simbolo_monto_r'].''.number_format($value['total_recarga'],2,',','.').' ('.$value['iso_monto_r'].')</td>
                     <td> 
                       <button type="submit" data-toggle="modal" data-target="#modal-editar-monto" class="btn btn-success btn-sm btnEditarMontoR" idMontoR="'.$value['id'].'"><i class="fas fa-edit"></i></button>
                       <button type="submit" class="btn btn-danger btn-sm btnEliminarMontoRecarga" idMontoR="'.$value['id'].'"><i class="fas fa-trash-alt"></i></button>
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

  
 <!--MODAL AGREGAR  MONTO RECARGA -->
 <div class="modal fade" id="modal-agregar-monto">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Agregar Nuevo Usuario</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
          
                  
                    <div class="form-group">
                            <label>Operadoras</label>
                            <select class="form-control" id="operadora" name="operadora">
                              <option selected>-- Seleccione una operadora --</option>
                              <option value="Movistar">Movistar</option>
                              <option value="Digital">Digital</option>
                              <option value="Movilnet">Movilnet</option>
                            </select>
                    </div>
                    <div class="form-group">
                            <label>Moneda</label>
                         
                            <select class="form-control" id="nuevaMonedaMonto" name="nuevaMonedaMonto">
                              <option selected>-- Seleccione un Moneda --</option>
                             
                              <?php 
                    
                              $valor=null;
                              $item=null;
                              $monedas = MonedaController::ctrMostrarMonedas($item,$valor);
                              // var_dump($bancosvene);
                              if($monedas){
                                foreach ($monedas as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["moneda"].'</option>';
                                }
                              }else{
                               echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                              }
                              ?>
                              
                            </select>
                          </div>
                    <div class="form-group">
                        <label for="nuevoMonto">Monto</label>
                        <input type="number" class="form-control" id="nuevoMonto"  step="any" name="nuevoMonto" placeholder="Ingre el monto">
                        <input type="number" class="form-control" id="nuevoMonto"  step="any" name="nuevoMonto" placeholder="Ingre el monto">
                      </div>

                    <div class="form-group">
                        <label for="nuevoRecarga">Total Recarga</label>
                        <input type="number" class="form-control" id="nuevoRecarga" step="any" name="nuevoRecarga" placeholder="Ingre el monto a recargar">
                    </div>
                    <div class="form-group">
                            <label>Moneda Recarga</label>
                         
                            <select class="form-control" id="nuevaMonedaRecarga" name="nuevaMonedaRecarga">
                              <option selected>-- Seleccione un Moneda --</option>
                             
                              <?php 
                    
                              $valor=null;
                              $item=null;
                              $monedas = MonedaController::ctrMostrarMonedas($item,$valor);
                              // var_dump($bancosvene);
                              if($monedas){
                                foreach ($monedas as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["moneda"].'</option>';
                                }
                              }else{
                               echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                              }
                              ?>
                              
                            </select>
                          </div>
                  
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Registrar Monto de Recarga</button>
                </div>
                <?php
  
                  $crearRecarga = new ControladorMontoRecargas();
                  $crearRecarga -> ctrCrearMontoRecarga();
  
                ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR MONTO RECARGA END-->


 <!--MODAL EDITAR MONTO RECARGA -->
 <div class="modal fade" id="modal-editar-monto">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Editar Monto de Recargas</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
          
                  
                    <div class="form-group">
                            <label>Operadoras</label>
                            <select class="form-control" id="editaroperadora" name="editaroperadora">
                              <option selected>-- Seleccione una operadora --</option>
                              <option value="Movistar">Movistar</option>
                              <option value="Digital">Digital</option>
                              <option value="Movilnet">Movilnet</option>
                            </select>
                    </div>
                    <div class="form-group">
                            <label>Moneda</label>
                         
                            <select class="form-control" id="editarMonedaMonto" name="editarMonedaMonto">
                              <option selected>-- Seleccione un Moneda --</option>
                             
                              <?php 
                    
                              $valor=null;
                              $item=null;
                              $monedas = MonedaController::ctrMostrarMonedas($item,$valor);
                              // var_dump($bancosvene);
                              if($monedas){
                                foreach ($monedas as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["moneda"].'</option>';
                                }
                              }else{
                               echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                              }
                              ?>
                              
                            </select>
                          </div>
                    <div class="form-group">
                        <label for="nuevoMonto">Monto</label>
                        <input type="number" class="form-control" id="editarMonto" step="any" name="editarMonto">
                    </div>

                    <div class="form-group">
                        <label for="nuevoRecarga">Total Recarga</label>
                        <input type="number" class="form-control" id="editarRecarga" step="any" name="editarRecarga">
                    </div>
                    <div class="form-group">
                            <label>Moneda Recarga</label>
                         
                            <select class="form-control" id="editarMonedaRecarga" name="editarMonedaRecarga">
                              <option selected>-- Seleccione un Moneda --</option>
                             
                              <?php 
                    
                              $valor=null;
                              $item=null;
                              $monedas = MonedaController::ctrMostrarMonedas($item,$valor);
                              // var_dump($bancosvene);
                              if($monedas){
                                foreach ($monedas as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["moneda"].'</option>';
                                }
                              }else{
                               echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                              }
                              ?>
                              
                            </select>
                            <input type="hidden" class="form-control" id="idMonto_r"  name="idMonto_r">
                          </div>
                  
                </div>
                <div class="modal-footer justify-content-between">
          
                  <button type="submit" class="btn btn-primary">Guardar Modificaciones</button>
                </div>
                <?php
  
          $crearRecarga = new ControladorMontoRecargas();
          $crearRecarga -> ctrEditarMontoRecarga();

                ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL EDITAR MONTO END-->


 <?php
 $borrarMonto = new ControladorMontoRecargas();
 $borrarMonto->ctrBorrarMontoRecarga();
 ?>