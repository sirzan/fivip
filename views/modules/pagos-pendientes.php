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
        <table id="pagosR" class="table table-bordered table-striped tablas">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Correlativo</th>
                    <th>Cobro</th>
                    <th>Pago</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
          
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $info=$_SESSION['info'];
                    $monedas = PagosController::ctrMostrarPagos($item,$valor,$info);
                    foreach ($monedas as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['correlativo'].'</td>
                     <td>'.$value['simbolo_moneda'].''.number_format(bcdiv($value['total_envio'],'1',2),2,',','.').' ('.$value['iso_moneda'].')</td>
                     <td>'.$value['simbolo_moneda'].''.number_format(bcdiv($value['total_remesa'],'1',2),2,',','.').' ('.$value['iso_moneda'].')</td>
                     <td>'.$value['cliente'].'</td>
                     <td>'.$value['telefono'].'</td>

                     <td> 
                   

                       <button type="submit" data-toggle="modal" data-target="#modal-pagarP" class="btn btn-success btn-sm btnPagarP" idPagosP="'.$value['id'].'" info="'.$info.'"><i class="fas fa-money-bill-alt"></i> Pagar</button>
        
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


<!-- ----------------------------------- -->
<!-- METODO DE PAGOS MULTIPLE (PRUEBA)  -->
<!-- ----------------------------------- -->

<div class="modal fade" id="modal-pagarP">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <form action="" id="form-pago">

          
            <div class="modal-header card-warning card-outline">
              <h4 class="modal-title">Pagos Pendientes</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                     <div class="col-md-4">
                        <div class="card-body">
                            <strong>N° Remesa: <span id="correlativo"></span></strong><br>
                            <strong><i class="fas fa-user"></i> Cliente </strong>
                                <div id="clienteP"></div>
                          </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card-body receptor">
                     
                        </div>
                     </div>
                    <div class="col-md-4">
                      <div class="card-body saldoTransferencia">
                      <strong><i class="fas fa-money-bill-alt"></i> Saldo a Transferir</strong>
                                    <div id="transferir"></div>
                        </div>
                     </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 p-3 card order-md-2">
                    <div class="mb-3">
                          <a class="btn btn-success mr-1" id="m-efectivoP">Efectivo <i class="fas fa-plus-square"></i></a>
                          <a class="btn btn-primary mr-1" id="m-dtP">Deposito o Transferencia <i class="fas fa-plus-square"></i></a>
                          <a class="btn btn-secondary" id="m-credP">Crédito</a>
                        </div>

                        <!-- METODO DE DEPOSITO -->
                        <div class="off-deposito-pago">
                          <div class="contenedor-texto">
                            <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>
                          </div>

                     
                       
                        </div>
                         <!-- METODO DE DEPOSITO END-->
                    </div>
                    <div class="col-md-12 p-3 card order-md-1">
                         
                              <h5><i class="fas fa-arrow-alt-circle-up text-danger"></i> Cuenta Transferencia</h5>

                          <div class="form-group row">
                            <div class="input-form col-md-4">
                                <label for="exampleInputEmail1">Bancos de transferencia</label>
                                <select class="form-control bancoselect" id="BancoTransfer" name="BancoTransfer" required>
                                       
                                </select>
                            </div>
                            <div class="input-form col-md-4">
                                <label for="exampleInputEmail1">Metodo de Pago</label>
                                <select class="form-control" id="metodoPagosalida" name="metodoPagosalida" required>
                                  <option value="" selected>-- Seleccionar un Metodo --</option>
                                </select>
                              </div>
                  
                              <div class="form-group col-md-2 float-right">
                                <label for="exampleInputEmail1">N° de Trans.</label>
                                <div class="input-group ">
                                  <input type="number" id="nOpeSalida"  name="nOpeSalida" class="form-control" >
                                </div>
                              </div>
                              <div class="form-group col-md-2 float-right">
                                <label for="exampleInputEmail1">Monto a Transferir</label>
                                <div class="input-group ">     <div class="input-group-prepend">
                                      <span class="input-group-text tipo-moneda"></span>
                                    </div>
                                <input type="number" id="monto-salida" step="any" name="monto-salida" class="form-control" readonly>
                                <input type="hidden" id="monto-cobro" step="any">
                                <input type="hidden" id="remesa_id" >
                                <input type="hidden" id="tipoBancoSalida" >
                                <input type="hidden" id="tipoBancoEntrada" >
                                </div>
                              </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-primary btn-lg">Pagar Remesa</button>
            </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- ----------------------------------- -->
<!-- METODO DE PAGOS MULTIPLE (PRUEBA)  -->
<!-- ----------------------------------- -->
