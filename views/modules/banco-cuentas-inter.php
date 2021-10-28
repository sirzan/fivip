<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cuentas bancarias Internacionales</h1>
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
        $info=$_SESSION['info'];
        $respuesta =  CuentaBancoInterController::ctrMostrarCuenta($item, $valor,$info);
  // var_dump($respuesta);
        foreach ($respuesta as $key => $value) {
   
            echo' <div class="col-md-3">
                  <div class="card card-danger card-outline">
                        <div class="card-body box-profile">
                          <h2 class="profile-username text-center">'.$value['nombre'].'</h2>
          
                          <p class="text-muted text-center">'.$value['n_titular_inter'].' '.$value['a_titular_inter'].'<a href="#" style="text-decoration: none;color:black"> <i class="fas fa-edit"></i></a></p>
          
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>Saldo</b> <a class="float-right">'.$value['simbolo'].' '.number_format($value['saldo_inter'],2,',','.').'</a>
                            </li>
                          </ul>
                          <a href="#" class="btn btn-outline-primary btn-block"><b>	<i class="fas fa-eye"></i> Movimientos</b></a>
                          <button type="submit" class="btn btn-success btn-block recargarCuentaInter" idCuenta="'.$value['cuenta_inter_id'].'" info="'. $info.'" data-toggle="modal" data-target="#modal-recarga"><b><i class="fas fa-arrow-alt-circle-up"></i> Recargar Saldo</b></button>
                          <button type="submit" class="btn btn-secondary btn-block descargarCuentaInter" idCuenta="'.$value['cuenta_inter_id'].'" info="'. $info.'" data-toggle="modal" data-target="#modal-recarga"><b><i class="fas fa-arrow-alt-circle-down"></i> Descargar Saldo</b></button>
                         ';
                        if($value['estado'] == 0){

                          echo' <button type="submit" class="btn btn-danger btn-block eliminarCuentaInter" idCuenta="'.$value['cuenta_inter_id'].'" idCuentaSaldo="'.$value['id_saldo'].'" estado="'.$value['estado'].'" info="'. $info.'" ><b> 	<i class="fas fa-trash-alt"></i> Eliminar cuenta</b></button>';
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
            <div class="modal-header card-danger card-outline">
              <h4 class="modal-title">Crear Cuenta Bancaria</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nuevoNombreTitular">Nombre del titular</label>
                    <input type="text" class="form-control" id="nuevoNombreTitularInter" name="nuevoNombreTitularInter" placeholder="Escribir nombre del titular" required>
                  </div>
                  <div class="form-group">
                    <label for="nuevoApellidoTitular">Apellido del titular</label>
                    <input type="text" class="form-control" id="nuevoApellidoTitularInter" name="nuevoApellidoTitularInter" placeholder="Escribir Apellido del titular" required>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Bancos de Internacionales</label>
                  <select class="form-control bancoselect" id="seleccionarBancoInter" name="seleccionarBancoInter" required>
                            <option value="" selected>-- Seleccionar banco para recarga --</option>
                      <?php 
                    
                    $valor=null;
                    $item=null;
                    $bancosvene = BancoInterController::ctrMostrarBancoInter($item,$valor,$info);
                    foreach ($bancosvene as $key => $value) {
                     echo '<option value="'.$value['id'].'" >'.$value['nombre'].'</option>';
                    }
                    ?>

                        </select>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Moneda de la cuenta</label>
                  <select class="form-control bancoselect" id="seleccionarMonedaInter" name="seleccionarMonedaInter" required>
                            <option value="" selected>-- Seleccionar una moneda --</option>
                      <?php 
                    
                    $valor=null;
                    $item=null;
                    $bancosvene = MonedaController::ctrMostrarMonedas($item,$valor,$info);
                    foreach ($bancosvene as $key => $value) {
                     echo '<option value="'.$value['id'].'" >'.$value['moneda'].'</option>';
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
            $crearBanco = new CuentaBancoInterController();
            $crearBanco->ctrCrearCuenta($info);
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
            $sumarestaCuenta = new SaldoCuentaInterController();
            $sumarestaCuenta->ctrSumaRestaSaldo($info);
            ?>
        </form>
        </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- /.modal -->

      <?php
 $borrarCuenta = new SaldoCuentaInterController();
 $borrarCuenta->ctrBorrarCuenta();
 ?>
