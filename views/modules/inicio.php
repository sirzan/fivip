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

        <div class="card-header">

          <div class="input-group">
            <button type="button" id="btnReporteDia" class="btn btn-success float-right">
              <i class="fas fa-print"></i> Reporte del dia
            </button>
          </div>
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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->