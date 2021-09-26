  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrador de Remesas</h1>
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
          <a href="enviar-remesas" class="btn btn-primary btn-sm">Agregar Remesa</a>

     

        </div>
        <div class="card-body">
        <table id="remesas" class="table table-bordered table-striped tablas">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Taquilla</th>
                    <th>Forma de pago</th>
                    <th>Pais</th>
                    <th>Tasa</th>
                    <th>Pago</th>
                    <th>Envio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  
                </table>
        </div>
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
 $borrarRemesa = new RemesasController();
 $borrarRemesa->ctrBorrarRemesas();
 ?>

