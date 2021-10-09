
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vista previa</h1>
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

        <div class="card-body container">
        <div class="invoice p-3 mb-3">
       
                
                    <?php 

                     
            $item='id';
            $item2='remesas_id';
            $valor=$_GET['id'];
            $remesas = RemesasController::ctrMostrarRemesas($item,$valor);
            $valor2=$remesas['id'];
            $metodos_pagos = ModeloPagos::mdlMostrarPagosRealizados($item2,$valor2);
       
            if ($remesas['estado'] == 0) {
             echo ' <div class="ribbon-wrapper ribbon-xl"><div class="ribbon bg-danger text-xl">
                      No Pagada
                    </div>
                  </div>
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <img src="views/img/logo-ticket.png" width="250" alt="">';
            }else{
                echo '
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <img src="views/img/logo-ticket.png" width="250" alt="">';
            }

            // var_dump( $remesas);
                  echo  '<small class="float-right">Fecha: '.$remesas['fecha'].'</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                 
                  <address>
                    <strong>Envio a: '.$remesas['receptor'].'</strong><br>
                    '.$remesas['tipo_documento'].':  '.$remesas['n_doc'].'<br>
                    Banco: '.$remesas['banco'].'<br>
                    N° Cuenta: '.$remesas['n_cuenta'].'<br>
                    Banco Pago Movil: '.$remesas['ban_pa_m'].'
                  </address>
                </div>
    
                <div class="col-sm-6 invoice-col">
                  <b>Correlativo: '.$remesas['correlativo'].'</b><br>
                  <br>
                  <b>Cliente:</b> '.$remesas["CONCAT(nombres,' ',apellidos)"].'<br>
                  <b>Teléfono:</b> '.$remesas["telefono"].'
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->


              
                <!-- accepted payments column -->
                <div class="col-md-8">
                  <p class="lead">Observacion:</p>
                 

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  '.$remesas["obs"].'
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                <div class="row">
                <div class="col-md-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Metodo de Cobro</th>
                      <th>Monto Cobro</th>
                      <th>Metodo de Pago</th>
                      <th>Monto Pago</th>
                     
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>'.$metodos_pagos['metodo_pago_entrada'].' 
                      <a type="button"  data-toggle="modal" data-target="#entrada">
                         	<i class="fas fa-eye text-primary"></i>
                      </a>
                                            <!-- Modal -->
                      <div class="modal fade" id="entrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            
                            <div class="modal-body">
                            Banco: '.$metodos_pagos['banco_entrada'].' | Titular: '.$metodos_pagos['n_titular_entrada'].' '.$metodos_pagos['a_titular_entrada'].'
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      </td>
                      <td>'.$metodos_pagos['simbolo_entrada'].''.number_format($metodos_pagos['monto_entrada'],2,',','.').' ('.$metodos_pagos['iso_entrada'].')</td>
                      <td>'.$metodos_pagos['metodo_pago_salida'].'
                      
                      <a type="button"  data-toggle="modal" data-target="#salida">
                      <i class="fas fa-eye text-primary"></i>
                 </a>
                                       <!-- Modal -->
                 <div class="modal fade" id="salida" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                   <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                       
                       <div class="modal-body">
                       Banco: '.$metodos_pagos['banco_salida'].' | Titular: '.$metodos_pagos['n_titular_salida'].' '.$metodos_pagos['a_titular_salida'].'
                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                       </div>
                     </div>
                   </div>
                 </div>

                      </td>
                      <td>'.$metodos_pagos['simbolo_salida'].''.number_format($metodos_pagos['monto_salida'],2,',','.').' ('.$metodos_pagos['iso_salida'].')</td>
                     
                    </tr>
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>

                  <div class="col-md-6 table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Tasa: </th>
                        <td>'.$remesas["simbolo_tasa"].''.number_format($remesas["tasa"],2,',','.').' ('.$remesas["iso_tasa"].')</td>
                      </tr>
                      <tr>
                        <th>Monto</th>
                        <td>'.$remesas["simbolo_moneda"].''.number_format($remesas["total_envio"],2,',','.').' ('.$remesas["iso_moneda"].')</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>'.$remesas["simbolo_tasa"].''.number_format($remesas["total_remesa"],2,',','.').' ('.$remesas["iso_tasa"].')</td>
                      </tr>
                   
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
             

              <!-- this row will not appear when printing -->
         
            </div>
        </div>
        <!-- /.card-body -->';
        ?>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->