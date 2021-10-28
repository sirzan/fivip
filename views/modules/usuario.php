  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Usuarios</h1>
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
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar-usuario">Agregar Usuario</button>
        </div>
        <div class="card-body">
        <table id="user" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">#</th>
                    <th>Usuario</th>
                    <th>Nombre Usuario</th>
                    <th>rol</th>
                    <th>estado</th>
                    <th>Ultimo Login</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    
                    $item = null;
                    $valor = null;
                    $info= $_SESSION['info'];

                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor,$info);
                    foreach ($usuarios as $key => $value) {
                     echo '<tr>
                     <td>'.$value['id'].'</td>
                     <td>'.$value['usuario'].'</td>
                     <td>'.$value['nom_user'].'</td>
                     <td>'.$value['rol'].'</td>';
                      if($value['estado'] == 1){
                      echo'<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value['id'].'" estadoUsuario="0">activado</button></td>';
                      }else{
                        echo'<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value['id'].'" estadoUsuario="1">Desactivado</button></td>';
                      }
                     
                     echo '<td>'.$value['login_time'].'</td>
                     <td> 
                       <button type="submit" data-toggle="modal" data-target="#modal-editar-usuario" class="btn btn-success btn-sm btnEditarUsuario" idUsuario="'.$value['id'].'" info="'.$_SESSION['info'].'"><i class="fas fa-edit"></i></button>
                       <button type="submit" class="btn btn-danger btn-sm btnEliminarUsuario" idUsuario="'.$value['id'].'" info="'.$_SESSION['info'].'"><i class="fas fa-trash-alt"></i></button>
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
  <div class="modal fade" id="modal-agregar-usuario">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Agregar Nuevo Usuario</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="">Usuario</label>
                  </div>
                <div class="form-group row">
                  <div class="col-md-2">
                    <input type="text" class="form-control" id="iso" name="iso" value="<?php echo $_SESSION['iso'] ?>" readonly>
                  </div>
                  <div class="col-md-6">
                   
                    <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" placeholder="Escriba el nombre de usuario">
                    <input type="hidden" class="form-control" id="info" value="<?php echo $_SESSION['info'] ?>">
                  </div>
                      </div>
                      <div class="form-group">
                        <label for="nuevoNombre">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Escriba el nombre del usuario">
                      </div>
                      <div class="form-group">
                            <label>Rol de usuario</label>
                            <select class="form-control" id="rol" name="rol">
                              <option selected>-- Seleccione un rol --</option>
                              <option value="administrador">Administrador</option>
                              <option value="taquilla">Taquilla</option>
                              <option value="especial">Especial</option>
                            </select>
                          </div>
                      <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="nuevoPassword" name="nuevoPassword" placeholder="Escriba la contraseña">
                      </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                </div>
                <?php
                  $info=$_SESSION['info'];
                  $crearUsuario = new ControladorUsuarios();
                  $crearUsuario -> ctrCrearUsuario($info);
                ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->


 
 <!--MODAL EDITAR USUARIOS -->
 <div class="modal fade" id="modal-editar-usuario">
        <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post">
                <div class="modal-header" style="background:#ffc107">
                  <h4 class="modal-title">Editar Usuario</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="editarUsuario" name="editarUsuario">
                      </div>
                      <div class="form-group">
                        <label for="nuevoNombre">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="editarNombre" name="editarNombre">
                      </div>
                      <div class="form-group">
                            <label>Rol de usuario</label>
                            <select class="form-control" id="rol" name="editarRol">
                              <option value="" id="editarPerfil"></option>
                              <option value="administrador">Administrador</option>
                              <option value="taquilla">Taquilla</option>
                              <option value="especial">Especial</option>
                            </select>
                          </div>
                      <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escriba la nueva contraseña">
                        <input type="hidden" class="form-control" id="actualPassword" name="actualPassword">
                      </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                </div>
                    <?php
                      $editarUsuario = new ControladorUsuarios();
                      $editarUsuario -> ctrEditarUsuarios();
                    ?>
  
            </form>
              </div>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!--MODAL AGREGAR USUARIOS END-->


 <?php
 $borrarUsuario = new ControladorUsuarios();
 $borrarUsuario->ctrBorrarUsuario();
 ?>