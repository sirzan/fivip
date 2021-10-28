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
         <h3>Remesas a Créditos</h3>
        </div>
        <div class="card-body">
        <table id="user" class="table table-bordered table-striped tablas">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Correlativo</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Saldo abonado</th>
                    <th>Saldo Pendiente</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $info=$_SESSION['info'];
                    $creditos = CreditosController::ctrMostrarCreditos($item,$valor,$info);
                    foreach ($creditos as $key => $value) {
              
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['correlativo'].'</td>
                     <td>'.$value['nombres'].''.$value['apellidos'].'</td>
                     <td>'.$value['telefono'].'</td>
                     <td style="color:green">'.$value['simbolo_moneda'].''.number_format(bcdiv($value['abonado'],'1',2),2,',','.').' ('.$value['iso_moneda'].')</td>
                     <td style="color:red">'.$value['simbolo_moneda'].''.number_format(bcdiv($value['total_envio'],'1',2),2,',','.').' ('.$value['iso_moneda'].')</td>
              
                     <td> 
                   

                       <button type="submit" data-toggle="modal" data-target="#modal-credito" class="btn btn-success btn-sm btnCreditos" idCreditos="'.$value['remesas_id'].'" info="'.$info.'"><i class="fas fa-money-bill-alt"></i> Pagar</button>
                       <button type="submit" class="btn btn-primary btn-sm btnverPago" idPagos="'.$value['remesas_id'].'"><i class="fas fa-eye"></i></button>
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
  <div class="modal fade" id="modal-credito">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form role="form" method="post" class="formularioCredito">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Pagar saldo pendiente</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                    <div class="row" id="datos-receptor">
                      <div class="col-md-12">
                        <div class="card-body">
                        <div class="row">

                             <div class="col-md-4">
                              <div class="card-body">
                                  <strong>N° Remesa: <span id="correlativo"></span></strong><br>
                                  <strong><i class="fas fa-user"></i> Cliente </strong>
                                      <div id="clienteC"></div>
                                    </div>
                              </div>

                                <div class="col-md-8">
                                  <div class="card-body">
                                                <div id="deuda"></div>
                                    </div>
                                </div>

                            </div>
                            <hr>

                            <div class="row">
                                        <div class="col-md-12 p-3 card order-md-2">
                                <div class="mb-3">
                                      <a class="btn btn-success mr-1" id="m-efectivoC">Efectivo <i class="fas fa-plus-square"></i></a>
                                      <a class="btn btn-primary mr-1" id="m-dtC">Deposito o Transferencia <i class="fas fa-plus-square"></i></a>
                            
                                    </div>

                                    <!-- METODO DE DEPOSITO -->
                                    <div class="off-deposito-credito">
                                      <div class="contenedor-texto">
                                        <h5><i class="fas fa-arrow-alt-circle-down text-success"></i> Cuenta Depósito</h5>
                                      </div>

                                
                                  
                                    </div>
                                    <!-- METODO DE DEPOSITO END-->
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                <input type="hidden" id="tipoBancoEntrada" >
                  <input type="hidden" id="id_remesa" name="id_remesa">
                  <input type="hidden" id="abonadototal" name="abonadototal">
                  <button type="submit" class="btn btn-primary btn-lg">Abonar</button>
                </div>
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->

