  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte de Remesa</h1>
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
      <div class='card'>
  <div class="card-body">
    
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">     <button type="button" class="btn btn-default float-right" id="daterange-btn">
            <span>
              <i class="far fa-calendar-alt"></i> Rango de Fechas
            </span>
                      <i class="fas fa-caret-down"></i>
                    </button></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>


          <div class="card-body">
              <?php 
              
              include 'reportes/grafico-remesa.php';

              ?>
            <!-- /.card -->
          </div>
          <!-- /.card-body -->
        </div>
  </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->