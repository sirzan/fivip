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
          <button type="button" class="btn btn-primary btn-sm" id="enviar-recarga" data-toggle="modal" data-target="#modal-agregar-monto">Recargar Movil</button>
        </div>
        <div class="card-body">
        <table id="recargas" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Cliente</th>
                    <th>Operadora</th>
                    <th>Numero de Recarga</th>
                    <th>Monto</th>
                    <th>Total Recarga</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $recargas_all = ControladorMontoRecargas::ctrMostrarRecargaAll();
                    foreach ($recargas_all as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['nombres'].' '.$value['apellidos'].'</td>
                     <td>'.$value['operadora'].'</td>
                     <td>'.$value['telefono'].'</td>
                     <td>'.$value['simbolo_monto'].number_format($value['monto'],2,',','.').' ('.$value['iso_monto'].')</td>
                     <td>'.$value['simbolo_r'].number_format($value['recarga'],2,',','.').' ('.$value['iso_r'].')</td>

                     <td> 
                    <button class="btn btn-primary btn-sm btnVerRecarga" idRecargas="'.$value['id'].'"><i class="fas fa-eye"></i></button>
                       <button type="submit" class="btn btn-danger btn-sm btnEliminarRecargas" idRecargas="'.$value['id'].'"><i class="fas fa-trash-alt"></i></button>
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
 <div class="modal fade" id="modal-agregar-monto">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Enviar Recarga</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
          
                  <div class="form-group row">

                      <div class="input-group mb-3 col-md-12">
          
                        <label>Cliente</label>
                        
                        <select class="form-control select2 select2bs4" style="width: 100%;" id="seleccionarCliente" name="seleccionarCliente" required>
                          <option value="" selected="selected">Seleccione un cliente</option>
                 
                        </select>
                      </div>

                                  <!-- validar los bancos -->
                <div class="col-md-12" id="divRadios">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="movistar" value="Movistar" name="operadora" >
                        <label >
                          Movistar
                        </label>
                      </div>
                 
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="digitel" value="Digitel" name="operadora">
                        <label>
                        Digitel
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="digitel" value="Movilnet" name="operadora">
                        <label>
                        Movilnet
                        </label>
                      </div>
                    </div>
                  </div>
                <!-- validar end -->
                      <div class="input-group mb-3 col-md-12">
               
                         <select class="form-control" id="nuevaMonedaRecarga" name="nuevaMonedaRecarga"> </select>
                        </div>
                        <div class="input-group mb-3 col-md-12">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="telefonoRecarga" data-inputmask='"mask": "(+99) 999-999-9999"' data-mask placeholder="Ingrese el telefono a recargar" required>
                        </div>
                        <hr>
                      <div class="input-group mb-3 col-md-12 off"></div>
                        <hr>
                      <div class="input-group mb-3 col-md-12 off2"></div>
                      <input type="hidden" name="idUser" value="<?php echo $_SESSION["id"]; ?>">
                  </div>

                  
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Registrar Recarga</button>
                </div>
                <?php
                       $recarga = new ControladorMontoRecargas();
                       $recarga ->ctrIngresarRecarga();
                ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->
<?php
  $borrarRecarga = new ControladorMontoRecargas();
  $borrarRecarga -> ctrBorrarRecarga();

?>