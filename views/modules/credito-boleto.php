
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrador de Créditos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">

      <div class="card">
        <div class="card-header">
         <h3>Boletos a Créditos</h3>
        </div>
        <div class="card-body">
        <table id="credito-boleto" class="table table-bordered table-striped tablas">
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
           
                </table>
        </div>
       
      </div>
    </section>

  </div>


 <!--MODAL AGREGAR USUARIOS -->
  <div class="modal fade" id="modal-credito">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form role="form" method="post" class="formularioCreditoBoleto">
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
                                  <strong>N° Boleto: <span id="correlativo"></span></strong><br>
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
                  <input type="hidden" id="boleto_id" name="boleto_id">
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

