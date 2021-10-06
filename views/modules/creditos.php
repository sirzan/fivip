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
                    <th>Saldo pendiente</th>
                    <th>Condición</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $creditos = CreditosController::ctrMostrarCreditos($item,$valor);
                    foreach ($creditos as $key => $value) {
              
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['correlativo'].'</td>
                     <td>'.$value['nombres'].''.$value['apellidos'].'</td>
                     <td>'.$value['simbolo_moneda'].''.$value['total_envio'].' ('.$value['iso_moneda'].')</td>
                     <td>'.$value['metodo_pago_entrada'].'</td>
                     <td> 
                   

                       <button type="submit" data-toggle="modal" data-target="#modal-credito" class="btn btn-success btn-sm btnCreditos" idPagos="'.$value['remesas_id'].'"><i class="fas fa-money-bill-alt"></i> Pagar</button>
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
        <div class="modal-dialog">
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
                      <div class="col-md-12">
                        <div class="card-body">
                          <div>
        
                            <strong>N° Remesa <span id="numero-remesa"></span></strong><br>
                            <strong><i class="fas fa-user"></i> Cliente  <span id="numero-remesa"></span></strong>
                        
                                <div id="cliente"></div>
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
                <div class="col-md-12">

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
                          
                        </div>
                        <div class="off">
                       
                        </div>
                </div>
                
            </div>


                </div>
                <div class="modal-footer justify-content-between">
                  <input type="hidden" id="remesas_id" name="remesas_id">
                  <button type="submit" class="btn btn-primary btn-lg">Pagar Saldo</button>
                </div>
                <?php

                  $pagaRemesa = new CreditosController();
                  $pagaRemesa -> ctrIngresarCredito();

                ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->

