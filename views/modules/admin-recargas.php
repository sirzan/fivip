<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrador de Recargas Moviles</h1>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar-monto">Recargar Movil</button>
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
          
                  <div class="form-group row">

                      <div class="input-group mb-3 col-md-12">
                        <!-- <div class="input-group-prepend mb-3 ">
                          <span class="input-group-text"><i class="fas fa-users"></i></span>
                          <span class="input-group-prepend"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-editar-cliente" data-dismiss="modal">Nuevo cliente</button></span>
                        </div> -->
                        <label>Cliente</label>
                        
                        <select class="form-control select2 select2bs4" style="width: 100%;" id="seleccionarCliente" name="seleccionarCliente" required>
                          <option value="" selected="selected">Seleccione un cliente</option>
                 
                        </select>
                      </div>
                      <div class="input-group mb-3 col-md-12">
 
                         <select class="form-control" id="nuevaMonedaRecarga" name="nuevaMonedaRecarga">
                           <option selected>-- Seleccione un Recarga --</option>
                          
                           <?php 
                 
                           $valor=null;
                           $item=null;
                           $recarga = ControladorMontoRecargas::ctrMostrarMontoRecarga($item,$valor);
                           // var_dump($bancosvene);
                           if($monedas){
                             foreach ($recarga as $key => $value) {
                             echo '<option value="'.$value["id"].'">'.$value['operadora'].' - '.$value['simbolo_monto'].''.number_format($value['monto'],2,',','.').' ('.$value['iso_monto'].') '.$value['simbolo_monto_r'].''.number_format($value['total_recarga'],2,',','.').' ('.$value['iso_monto_r'].')</option>';
                             }
                           }else{
                            echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                           }
                           ?>
                           
                         </select>
                        </div>
                      <div class="input-group mb-3 col-md-12">
                      <select class="form-control bancoselect" id="seleccionarBanco" name="seleccionarBanco" required>
                            <option value="" selected>-- Seleccionar banco para recarga --</option>
                      <?php 
                    
                    $valor=null;
                    $item=null;
                    $bancosvene = BancoVeneController::ctrMostrarBancoVene($item,$valor);
                    foreach ($bancosvene as $key => $value) {
                     echo '<option value="'.$value['id'].'" >'.$value['nombre'].'</option>';
                    }
                    ?>

                        </select>

                        </div>
                      
                  </div>

                  
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Registrar Recarga</button>
                </div>
         
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->

