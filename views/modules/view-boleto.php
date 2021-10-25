
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
            $item2='boleto_id';
            $valor=$_GET['id'];
            $boletos = BoletosController::ctrMostrarBoleto($item,$valor);
            
            $dataBoleto=[
                'correlativo' => $boletos['correlativo'],
                'created_at' => $boletos['created_at'],
                'cliente' => $boletos['cliente'],
                'tipo_doc' => $boletos['tipo_doc'],
                'documento' => $boletos['documento'],
                'telefono' => $boletos['telefono'],
                'estado' => $boletos['estado'],
                'obs' => $boletos['obs'],
                'fecha_s' => $boletos['fecha_s'],
                'promotor' => $boletos['promotor'],
                'costo' => $boletos['costo'],
                'simbolo' => $boletos['simbolo'],
                'iso' => $boletos['iso'],
                'sa' => $boletos['sa'],
                'pais_s' => $boletos['pais_s'],
                'estado_s' => $boletos['estado_s'],
                'pais_d' => $boletos['pais_d'],
                'estado_d' => $boletos['estado_d']
            ];


    if($dataBoleto['estado'] == 0){
              echo ' <div class="ribbon-wrapper ribbon-xl"><div class="ribbon bg-warning text-xl">
                     Crédito
                    </div>
                  </div>
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <img src="views/img/logo-ticket.png" width="250" alt="">';
            }
            else{
                echo '
                <div class="ribbon-wrapper ribbon-xl"><div class="ribbon bg-success text-xl">
                     Pagado
                    </div>
                  </div>
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <img src="views/img/logo-ticket.png" width="250" alt="">';
            }

            // var_dump( $remesas);
                  echo  '<small class="float-left"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                 
                  <address>
                    <strong>CLIENTE: </strong><br>
                   <span style="font-size:25px;"> '.$dataBoleto['cliente'].'</span>  <br>
                    DOCUMENTO: <br>
                    '.$dataBoleto['tipo_doc'].': '.$dataBoleto['documento'].'<br>
                    TELEFONO: '.$dataBoleto['telefono'].'<br>
                  </address>
                </div>
    
                <div class="col-sm-6 invoice-col">
                  <b>Fecha de venta: '.$dataBoleto['created_at'].'</b><br>
                  <b>Correlativo: '.$dataBoleto['correlativo'].'</b><br><br>
                  <b>Fecha de Salida: '.$dataBoleto['fecha_s'].'</b><br>
                  <b>Servicios Adicionales: '.$dataBoleto['sa'].'</b><br>
                  <b>Promotor: '.$dataBoleto['promotor'].'</b><br>
                
           
                </div>
              
                <div class="p-2 mt-3 col-sm-4 invoice-col">
                  <b>Pais de Salida</b><br>
                  <b style="font-size:20px;">'.$dataBoleto['pais_s'].'</b> - <b style="font-size:20px;">'.$dataBoleto['estado_s'].'</b><br>
           
                </div>

                <div class="p-2 mt-3 col-sm-4 invoice-col">
                  <b>Pais de Destino</b><br>
                  <b style="font-size:20px;">'.$dataBoleto['pais_d'].'</b> - <b style="font-size:20px;">'.$dataBoleto['estado_d'].'</b><br>
           
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->


              
                <!-- accepted payments column -->
                <div class="col-md-8">
                  <p class="lead">Observacion:</p>
                 

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  '.$dataBoleto['obs'].'
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                <div class="row">
                <div class="col-md-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Metodo de Cobro</th>
                      <th>Monto Cobro</th>
                      <th>Acción</th>
                      <th>Fecha</th>
                 
       
                     
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    
                    
                    foreach ($metodos_pagos as $key => $value) {
                      echo '<tr>

                      <td>
                      '.$value['metodo_p'].'
                      <a type="button"  data-toggle="modal" data-target="#entrada'.$value['id'].'">
                         	<i class="fas fa-eye text-primary"></i>
                      </a>
                                            <!-- Modal -->
                      <div class="modal fade" id="entrada'.$value['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            
                            <div class="modal-body">
                            Banco: '.$value['nombre'].' | Titular:  '.$value['n_titular'].' '.$value['a_titular'].'
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      </td>
                        
                      <td>
                        '.$value['simbolo'].''.number_format(bcdiv($value['monto'],'1',2),2,',','.').' ('.$value['iso'].')
                    </td>';
                    if ($value['signo']=='+') {
                    
                      echo
                     '<td>
                     <span class="text-success">CREDITO</span>
                   </td>';
                    }else {
                      echo
                      '<td>
                      <span class="text-danger">DEBITO</span>
                    </td>';
                    }
                  echo '    <td>
                        '.$value['created_at'].'
                    </td>
              
                     
                    </tr>';
                    }
                   


                   echo '</tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>

                  <div class="col-md-8 table-responsive">
                    <table class="table">
                      <tbody><tr> 
                        <th style="width:20px; font-size:30px">Costo: </th>
                        <td style="font-size:30px">'.$dataBoleto['simbolo'].''.number_format($dataBoleto['costo'],2,',','.').' ('.$dataBoleto['iso'].')</td>
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