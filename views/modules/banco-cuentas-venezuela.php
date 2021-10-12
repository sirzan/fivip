<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cuentas bancarias venezuela</h1>
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

   
    <div class="container-fluid">
   
         <div class="card-header mb-3">
         <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Crear Cuenta</button>
        </div>

        <div class="row">
        <?php
        $item = null;
        $valor = null;

        $respuesta =  CuentaBancoVeneController::ctrMostrarCuenta($item, $valor);

        foreach ($respuesta as $key => $value) {
   
            echo '<div class="col-md-3">
                  <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                          <h2 class="profile-username text-center">'.$value['nombre'].'</h2>
          
                          <p class="text-muted text-center">'.$value['n_titular'].' '.$value['a_titular'].'<a href="#" style="text-decoration: none;color:black"> <i class="fas fa-edit"></i></a></p>
          
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>Saldo</b> <a class="float-right">'.$value['simbolo'].' '.number_format($value['saldo'],2,',','.').'</a>
                            </li>
                          </ul>
                          <button type="submit" class="btn btn-outline-primary btn-block verMovimientos" idCuenta="'.$value['id_cuenta'].'" data-toggle="modal" data-target="#modal-xl"><b>	<i class="fas fa-eye"></i> Movimientos</b></button>
                          <button type="submit" class="btn btn-success btn-block recargarCuenta" idCuenta="'.$value['id_cuenta'].'" data-toggle="modal" data-target="#modal-recarga"><b><i class="fas fa-arrow-alt-circle-up"></i> Recargar Saldo</b></button>
                          <button type="submit" class="btn btn-secondary btn-block descargarCuenta" idCuenta="'.$value['id_cuenta'].'" data-toggle="modal" data-target="#modal-recarga"><b><i class="fas fa-arrow-alt-circle-down"></i> Descargar Saldo</b></button>
                          <button type="submit" class="btn btn-warning btn-block TransferirSaldo" data-toggle="modal" data-target="#modal-transferencia" idCuenta="'.$value['id_cuenta'].'"><b><i class="fas fa-exchange-alt"></i> Transferir saldo</b></button>
                         ';
                        if($value['estado'] == 0){
                          echo' <button type="submit" class="btn btn-danger btn-block eliminarCuenta" idCuenta="'.$value['id_cuenta'].'" idCuentaSaldo="'.$value['id_saldo'].'" estado="'.$value['estado'].'"><b> 	<i class="fas fa-trash-alt"></i> Eliminar cuenta</b></button>';
                        }
                    
                         echo' </div>
      
                      </div>
              </div>';
        }
        ?>
           
        </div>
    </div>
  
      
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
            <div class="modal-header">
              <h4 class="modal-title">Crear Cuenta Bancaria</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nuevoNombreTitular">Nombre del titular</label>
                    <input type="text" class="form-control" id="nuevoNombreTitular" name="nuevoNombreTitular" placeholder="Escribir nombre del titular" required>
                  </div>
                  <div class="form-group">
                    <label for="nuevoApellidoTitular">Apellido del titular</label>
                    <input type="text" class="form-control" id="nuevoApellidoTitular" name="nuevoApellidoTitular" placeholder="Enter email" required>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Bancos de Venezuela</label>
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
                <!-- /.card-body -->

                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Crear Cuenta</button>
                <div class="col-md-12 alert alert-warning" role="alert">
                Nota: Una vez creada la cuenta y de tener movimientos en el sistema no podra ser eliminada.
              </div>
            </div>
            <?php
            $crearBanco = new CuentaBancoVeneController();
            $crearBanco->ctrCrearCuenta();
            ?>
        </form>
              
        </div>
     
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- /.modal -->



<!-- Recargando y Descargar saldo a las cuentas -->

  <div class="modal fade" id="modal-recarga">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">

                <div class="info-box infocuenta">
                </div>
                  <div class="form-group row">
                    <div class="input-form col-md-10">
                      <label for="">Ingrese el saldo</label>
                      <input type="number" class="form-control" step="any"  style="text-align:end;font-size:40px;padding:20px;border:none; border-bottom: 1px solid;" placeholder="Bs. 0" id="saldoRecarga" name="saldoRecarga" required>
                      <input type="hidden" step="any" id="saldoActual" name="saldoActual">
                      <div id="camposocultos"></div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->  
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary btnModal"></button>
            </div>
            <?php
            $sumarestaCuenta = new SaldoCuentaVeneController();
            $sumarestaCuenta->ctrSumaRestaSaldo();
            ?>
        </form>
        </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- /.modal -->




<!-- Transferencia de saldo -->

<div class="modal fade" id="modal-transferencia">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
            <div class="modal-header">
              <h4 class="modal-title"> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                <div class="info-box infocuenta">
                </div>
                  <div class="form-group row">
                    <div class="input-form col-md-10">
                      <label for="">Monto a transferir</label>
                      <input type="number" class="form-control" step="any"  style="text-align:end;font-size:40px;padding:20px;border:none; border-bottom: 1px solid;" placeholder="Bs. 0" id="saldoTransferencia" name="saldoTransferencia" required>
                      <input type="hidden" step="any" id="saldoActual2" name="saldoActual">
                      <div id="camposocultos2"></div>
                    </div>
                  </div>
                  <div class="form-group row">

                    <label>Cuenta a transferir</label>
                  <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                	    <i class="fas fa-university"></i>
                    </span>
                  </div>
                 
                  
                  <select class="form-control" id="cuentasBancarias" name="cuentasBancarias">
                    <option selected>-- Seleccione una cuenta --</option>
                   
                    <?php 
          
                    $valor=null;
                    $item=null;
                    $cuentas = CuentaBancoVeneController::ctrMostrarCuenta($item,$valor);
                    // var_dump($bancosvene);
                    if($cuentas){
                      foreach ($cuentas as $key => $value) {
                      echo '<option value="'.$value["id_cuenta"].'">'.$value["nombre"].' - '.$value["n_titular"].''.$value["a_titular"].'</option>';
                      }
                    }else{
                     echo'<option disabled>-- No hay monedas creadas, vaya a la seccion de monedas --</option>';
                    }
                    ?>
                    
                  </select>
               
                </div>
                  </div>
                  <div class="form-group row">
                    <div class="input-form col-md-10">
                    </div>
                  </div>
          
                </div>
                <!-- /.card-body -->  
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary btnModal"></button>
                <div class="col-md-12 alert alert-warning" role="alert">
                Nota: Las transferencias entre cuentas distintas contiene un consumo adicional del 0.3% de comisiones bacarias.
              </div>
            </div>
            <?php
            $crearBanco = new SaldoCuentaVeneController();
            $crearBanco->ctrTransferenciaSaldo();
            ?>
        </form>
      
        </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- /.modal -->


<?php
 $borrarCuenta = new SaldoCuentaVeneController();
 $borrarCuenta->ctrBorrarCuenta();
 ?>





      <!-- /.modal -->

      <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Movimientos Bancarios</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <table id="movimientos" class="table table-bordered table-striped display responsive">
                  <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Operación</th>
                    <th>Débito / Crédito</th>
                    <th>Monto</th>
                    <th>Saldo</th>
             
                  </tr>
                  </thead>
               
                </table>
            </div>
      
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->