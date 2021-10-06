  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pagina de inicio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">inicio</a></li>
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

        <div class="card-header clearfix">

          <?php if($_SESSION["rol"] == 'administrador') {
            echo '  <button type="button" id="btnReporteDia" class="btn btn-success float-left">
            <i class="fas fa-print"></i> Reporte del dia
          </button> <button type="button" id="btnReporteDiaA4" class="btn btn-success float-left ml-3">
          <i class="fas fa-print"></i> Reporte del dia (A4)
        </button>  <button type="button" class="btn btn-primary float-right" id="daterange-btn">
          <span><i class="far fa-calendar-alt"></i> Rango de Fechas</span> <i class="fas fa-caret-down"></i>
        </button>';
          } ?>
          
      
                
                
              
                </div>


        <div class="card-body">
        <h3>Remesas Recibidas</h3>
        <div class="row totalRecibidas"></div>

        </div>
        <div class="card-body">
        <h3>Remesas Enviadas</h3>
   
        <div class="row totalEnviadas"></div>
        </div>
        <!-- /.card-body -->
      
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      <!-- Default box -->
      <div class="card">

        <div class="card-header">
          <h3>Informes</h3>
          
        </div>

        <div class="card-body">
        <div class="row totalCliente">
    
        
        </div>
        </div>
        <!-- /.card-body -->
      
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->



      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Movimientos bancarios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Banco</th>
                      <th>Titular</th>
                      <th>Monto</th>
                      <th>Operacion</th>
                      <th>accion</th>
                    </tr>
                  </thead>
                  <tbody id="tbody-movimientos">
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->