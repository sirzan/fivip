  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tasas</h1>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar">Agregar Tasa</button>
        </div>
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
   
                    <th>Iso tasa</th>
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
                     <td>'.number_format($value['tasa_c']).' '.$value['simbolo_tasa'].'</td>
      
                     <td>'.$value['iso_tasa'].'</td>

                     <td> 
                       <button type="submit" data-toggle="modal" data-target="#modal-editar" class="btn btn-success btn-sm btnEditarTasa" idTasa="'.$value['id'].'"><i class="fas fa-edit"></i></button>
                       <button type="submit" class="btn btn-danger btn-sm btnEliminarTasa" idTasa="'.$value['id'].'"><i class="fas fa-trash-alt"></i></button>
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

 <!--MODAL AGREGAR TASA -->
  <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Agregar nueva Tasa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                            <label>Pais</label>
                     
                            <select class="form-control" id="nuevoPaisTasa" name="nuevoPaisTasa">
                              <option selected>-- Seleccione un Pais --</option>
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
                  <div class="form-group">
                            <label>Moneda</label>
                         
                            <select class="form-control" id="nuevaMoneda" name="nuevaMoneda">
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
                        <label for="nuevoNombre">Tasa de cambio</label>
                        <input type="number" class="form-control" id="tasaCambio" name="tasaCambio" step="any" placeholder="Escriba el monto de cambio">
                      </div>
                      <div class="form-group">
                            <label>Moneda Tasa</label>
                         
                            <select class="form-control" id="monedaTasa" name="monedaTasa">
                              <option selected>-- Seleccione una moneda --</option>
                             
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
                  <button type="submit" class="btn btn-primary">Registrar Tasa</button>
                </div>
                <?php
  
                    $crearTasa = new TasaController();
                    $crearTasa -> ctrCrearTasa();

                  ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR TASA END-->


 
 <!--MODAL EDITAR TASA -->

  <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Editar Tasa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                <label>Pais</label>
                     
                     <select class="form-control" id="editarPaisTasa" name="editarPaisTasa">
                       <option selected>-- Seleccione un Pais --</option>
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
           <div class="form-group">
                     <label>Moneda</label>
                  
                     <select class="form-control" id="editarMoneda" name="editarMoneda">
                       <option selected>-- Seleccione una Moneda --</option>
                      
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
                 <label for="nuevoNombre">Tasa de cambio</label>
                 <input type="number" class="form-control" id="editartasaCambio" name="editartasaCambio">
                 <input type="hidden" class="form-control" id="editarIdTasa" name="editarIdTasa">
               </div>
               <div class="form-group">
                            <label>Moneda Tasa</label>
                         
                            <select class="form-control" id="editarmonedaTasa" name="editarmonedaTasa">
                              <option selected>-- Seleccione una moneda --</option>
                             
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
           <button type="submit" class="btn btn-primary">Guardas Cambios</button>
         </div>
         <?php

             $crearTasa = new TasaController();
             $crearTasa -> ctrEditarTasa();

           ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 <!--MODAL editar TASA END-->

 <?php
 $borrarTasa= new TasaController();
 $borrarTasa->ctrBorrarTasa();
 ?>