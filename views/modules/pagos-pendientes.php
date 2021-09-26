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

                <div class="card card-primary">
            
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-money-bill-alt"></i> Saldo Pendiente</strong>
                    <div id="saldo">

                    </div>
              

                <hr>

            
              </div>
              <!-- /.card-body -->
            </div>
                             <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
            
                <div class="form-group row">
            
                     <div class="input-group mb-3 col-md-3 pagometodo">
                      <select class="form-control" id="MetodoPago" name="MetodoPago" required>
                        <option value="" selected>Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Desposito">Deposito</option>
                        <option value="Transferencia">Transferencia</option>                  
                                     
                      </select>    

                    </div>
                    <input type="hidden" name="idPagoRemesa" id="idPagoRemesa">
                    </div>
                
                    
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Pagar Saldo</button>
                </div>
                <?php

                  $pagaRemesa = new PagosController();
                  $pagaRemesa -> ctrEditarUsuarios();

                ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->


