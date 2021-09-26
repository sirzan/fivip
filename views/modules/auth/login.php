<div id="back"></div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card-header text-center">
    <img src="views/img/logo.png" width="250" alt="">
  </div>
  <div class="card card-outline card-primary">
    <div class="card-body">

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="user" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
       
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>


        <?php

            $login = new ControladorUsuarios();
            $login -> ctrInicioSesion();
        ?>

      </form>

    

      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->