  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link"><?php echo $_SESSION["rol"];?></a>
      </li>
    
    </ul>

    <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge totalnoti"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">  <span class="right badge badge-danger totalnoti"></span> Notificaciones</span>
          <div class="dropdown-divider"></div>
          <a href="pagos-pendientes" class="dropdown-item">
            <i class="fas fa-cash-register mr-3"></i>  Pagos Pendientes <span class="ml-3 notipago"></span> 
          </a>
          <div class="dropdown-divider"></div>
          <a href="creditos" class="dropdown-item">
          <i class="fas fa-coins mr-3"></i>  Creditos <span class="ml-3 noticredi"></span>
           
          </a>
          <div class="dropdown-divider"></div>
    
       
      </li>

  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    
    </ul>
  </nav>
  <!-- /.navbar -->


