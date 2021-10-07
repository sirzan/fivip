
   
   
   
   
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="views/img/logo-mini.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">FIVIP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" style="padding-right:10px;" ><?php echo $_SESSION["usuario"]; ?> <a href="sign-off"> <i class="fas fa-sign-out-alt"></i> </a></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
               <li class="nav-item">
            <a href="inicio" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>
                Remesas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-remesa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrar Remesa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="enviar-remesas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enviar Remesa</p>
                </a>
              </li>
                 <?php if($_SESSION["rol"] == 'administrador' || $_SESSION["rol"] == 'especial') {
            echo '<li class="nav-item">
            <a href="tasa" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tasa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="reporte-remesa" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Reportes de remesas</p>
            </a>
          </li>';
          } ?>
            
            </ul>
          </li>
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-mobile-alt"></i>
              <p>
                Recargas Moviles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-recargas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin. Recargas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-monto" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Montos</p>
                </a>
              </li>
               
            
            </ul>
          </li>
          <?php if($_SESSION["rol"] == 'administrador') {
            echo '       <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Pagos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pagos-pendientes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="notipago">Pendientes</p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="creditos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="noticredi">Créditos</p>
                </a>
              </li>
              
              <li class="nav-item">
              <a href="pagos-adicionales" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pagos adicionales</p>
              </a>
            </li>
            </ul>
          </li>';
          } ?>
     
     
     <?php if($_SESSION["rol"] == 'administrador') {
            echo '     <li class="nav-header">AJUSTES</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Bancos
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              
              <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                 Cuentas bancarias
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="banco-cuentas-venezuela" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cuentas de Venezuela</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="banco-cuentas-inter" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cuentas Internacionales</p>
                  </a>
                </li>
              </ul>
            </li>
                <li class="nav-item">
                  <a href="banco-venezuela" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bancos Venezuela</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="banco" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bancos internacionales</p>
                  </a>
                </li>
              </ul>
            </li>    
            <li class="nav-item">
            <a href="moneda" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Monedas
              </p>
            </a>
          </li>';
          } ?>
         
      
          <li class="nav-item">
            <a href="clientes" class="nav-link">
            <i class=" nav-icon fas fa-address-card	"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>


          <?php if($_SESSION["rol"] == 'administrador') {
            echo '     <li class="nav-item">
            <a href="usuario" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>';
          } ?>
     

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>