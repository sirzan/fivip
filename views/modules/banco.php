  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bancos Internacionales</h1>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar">Agregar Banco</button>
        </div>
        <div class="card-body">
        <table id="user" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
       
                  <?php 
                    
                    $valor=null;
                    $item=null;
                    $info=$_SESSION['info'];
                    $bancosvene = BancoInterController::ctrMostrarBancoInter($item,$valor,$info);
                    foreach ($bancosvene as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['nombre'].'</td>
               

                     <td> 
                     <button type="submit" data-toggle="modal" data-target="#modal-editar" class="btn btn-success btn-sm btnEditarBancoInter" idBancoInter="'.$value['id'].'" info="'.$_SESSION['info'].'"><i class="fas fa-edit"></i></button>
                     <button type="submit" class="btn btn-danger btn-sm btnEliminarBancoInter" idBancoInter="'.$value['id'].'" info="'.$_SESSION['info'].'"><i class="fas fa-trash-alt"></i></button>
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
  <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Agregar nuevo banco</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                      <div class="form-group">
                        <label for="nuevoBancoVene">Nombre del banco</label>
                        <input type="text" class="form-control" id="nuevoBancoInter" name="nuevoBancoInter" placeholder="Escriba el nombre del banco">
           
                      </div>
                    
                    
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Agregar Banco</button>
                </div>
      
  
              <?php
    $info=$_SESSION['info'];
    $crearBanco = new BancoInterController();
    $crearBanco -> ctrCrearBancoInter($info);

  ?> 
            </form>
              </div>
        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->


 
 <!--MODAL EDITAR USUARIOS -->

  <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Editar Tasa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="editarBancoInter">Nombre del banco</label>
                        <input type="text" class="form-control" id="editarBancoInter" name="editarBancoInter">
                      </div>
              
                    
                </div>
                <div class="modal-footer justify-content-between">
                <input type="hidden" id="editarIdBancoInter" name="editarIdBancoInter">
                  <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                <?php
    $info=$_SESSION['info'];
    $editarBanco = new BancoInterController();
    $editarBanco -> ctrEditarBancoInter($info);

?> 

  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 <!--MODAL editar USUARIOS END-->


 <?php
 $borrarBanco = new BancoInterController();
 $borrarBanco->ctrBorrarBancoInter();
 ?>