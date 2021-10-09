  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Pagos</h1>
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
         <h3>Pagos pendientes</h3>
        </div>
        <div class="card-body">
        <table id="user" class="table table-bordered table-striped tablas">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Correlativo</th>
                    <th>Saldo pendiente</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
          
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $monedas = PagosController::ctrMostrarPagos($item,$valor);
                    foreach ($monedas as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['correlativo'].'</td>
                     <td>'.$value['simbolo_moneda'].''.$value['total_envio'].' ('.$value['iso_moneda'].')</td>
                     <td>'.$value['cliente'].'</td>
                     <td>'.$value['telefono'].'</td>

                     <td> 
                   

                       <button type="submit" data-toggle="modal" data-target="#modal-pagar" class="btn btn-success btn-sm btnPagar" idPagos="'.$value['id'].'"><i class="fas fa-money-bill-alt"></i> Pagar</button>
                       <button type="submit" class="btn btn-primary btn-sm btnverPago" idPagos="'.$value['id'].'"><i class="fas fa-eye"></i></button>
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
  <div class="modal fade" id="modal-pagar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form role="form" method="post" class="formularioRemesa">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Pagar Saldo pendiente</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="datos-receptor">
                      <div class="col-md-6 p-3">
                        <div class="card-body">
                          <div>
        
                            <strong>N° Remesa <span id="numero-remesa"></span></strong><br>
                            <strong><i class="fas fa-user"></i> Cliente  <span id="numero-remesa"></span></strong>
                        
                                <div id="cliente"></div>
                            <hr>
                          </div>
                          </div>
                      </div>
                      <div class="col-md-6 p-3">
                        <div class="card-body">
                          <div>
        
                            <strong> Titular: <span class="datos" id="titular-receptor"></span></strong><br>  
                            <strong>Doc.: <span class="datos" id="titular-documento"></span> - <span class="datos" id="numero-documento"></span></strong><br>  
                            <strong>Banco: <span class="datos" id="banco-receptor"></span></strong><br>
                            <strong>Cuenta <span class="datos" id="cuenta-receptor"></span></strong>
                            <hr>
                          </div>
                          </div>
                      </div>
                    </div>


              <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
            <div class="row">
              <!-- cuentas de Deposito -->
                <div class="col-md-6 p-2" style="border-right: 2px solid #ffc107;">

                <div class="card card-primary">
                  <div class="card-body">
                    <strong><i class="fas fa-money-bill-alt"></i> Saldo a Recibir</strong>
                        <div id="saldo"></div>
                    <hr>
                  </div>
                </div>
                        <div class="mb-3">
                          <a class="btn btn-success mr-1" id="m-efectivo">Efectivo</a>
                          <a class="btn btn-primary mr-1" id="m-dt">Deposito o Transferencia</a>
                          <a class="btn btn-secondary" id="m-cred">Crédito</a>
                        </div>
                        <div class="off">
                       
                        </div>
                </div>
                  <!-- cuentas de tranferencia -->
                    <div class="col-md-6 p-2">
                          <div class="card card-primary">
                        <div class="card-body">
                          <strong><i class="fas fa-money-bill-alt"></i> Saldo a Transferir</strong>
                              <div id="transferir"></div>
                          <hr>
                        </div>
                      </div>

                      <h4><i class="fas fa-arrow-alt-circle-up text-danger"></i> Cuenta Transferencia</h4>
             
                      <div class="form-group">
                        <div class="input-form">
                            <label for="exampleInputEmail1">Bancos de Internacionales</label>
                            <select class="form-control bancoselect" id="seleccionarBancoTransfer" name="seleccionarBancoTransfer" required>
                                      <option value="" selected>-- Seleccionar un banco --</option>
                            </select>
                        </div>
                    </div>

                        <div class="form-group row">
                          <div class="input-form col-md-6">
                            <label for="exampleInputEmail1">Metodo de Pago</label>
                            <select class="form-control bancoselect" id="metodoPagoTransfer" name="metodoPagoTransfer" required>
                              <option value="" selected>-- Seleccionar un Metodo --</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">N° de Trans.</label>
                            <div class="input-group ">
                              <input type="number" id="n_operacion_salida"  name="n_operacion_salida" class="form-control" >
                            </div>
                          </div>

                          <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Monto a Transferir</label>
                            <div class="input-group ">
                              <input type="number" id="monto-transferencia" step="any" name="monto-transferencia" class="form-control" >
                              <!-- id de la remesa -->
                              <input type="hidden" id="id_remesa" name="id_remesa" class="form-control" >
                              <input type="hidden" id="tipo_cuenta_salida" name="tipo_cuenta_salida" class="form-control" >
                            </div>
                          </div>
                      </div>

                  </div>
            </div>


                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary btn-lg">Pagar Saldo</button>
                </div>
                <?php

                  $pagaRemesa = new PagosController();
                  $pagaRemesa -> ctrIngresarPago();

                ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->

