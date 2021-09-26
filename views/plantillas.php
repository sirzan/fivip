<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FIVIP sistema</title>

   <!-- =============================
            ARCHIVOS CSS
    ============================== -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/adminlte.css">




     <!-- DataTables -->
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="views/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="views/plugins/daterangepicker/daterangepicker.css">
 
    <link rel="stylesheet" href="views/plugins/morris/morris.css">
        <!-- ============================
             ARCHIVOS JS
    ============================== -->

  
    <!-- jQuery -->
    <script src="views/plugins/jquery/jquery.min.js"></script>
   
    <!-- Bootstrap 4 -->
    <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="views/plugins/select2/js/select2.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script> -->
<script src="views/js/sweetalert2.all.js"></script>

<!-- InputMask -->
<script src="views/plugins/moment/moment.min.js"></script>
<script src="views/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="views/plugins/daterangepicker/daterangepicker.js"></script>

<!-- morris -->
<script src="views/plugins/morris/raphael-min.js"></script>
<script src="views/plugins/morris/morris.min.js"></script>

</head>
<body class="hold-transition sidebar-collapse sidebar-mini login-page">


 <?php
 
 if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
//  if($_SESSION["iniciarSesion"] == "ol"){
    echo '<div class="wrapper">';
  
    // Navegador principal
    // Navegador sidebar
    include "views/modules/layouts.php";
    include "views/modules/sidebar.php";

    if(isset($_GET["ruta"])){
        if(
            $_GET["ruta"]== "inicio" || 
            $_GET["ruta"]== "usuario"|| 
            $_GET["ruta"]== "admin-remesa"|| 
            $_GET["ruta"]== "banco-venezuela"|| 
            $_GET["ruta"]== "banco"|| 
            $_GET["ruta"]== "pagos-pendientes"|| 
            $_GET["ruta"]== "enviar-remesas"|| 
            $_GET["ruta"]== "reporte-remesa"|| 
            $_GET["ruta"]== "moneda"|| 
            $_GET["ruta"]== "invoice"|| 
            $_GET["ruta"]== "clientes"|| 
            $_GET["ruta"]== "tasa"
        
        ){
            include "views/modules/".$_GET["ruta"].".php";
        }else if($_GET["ruta"] == "sign-off"){
            include "views/modules/auth/".$_GET["ruta"].".php";
        }else{
            include "views/modules/404.php";
       
    }} else{
        include "views/modules/inicio.php";
    }

    // Navegador pie de pagina
    include "views/modules/footer.php";
    echo '</div>';
    

 } else{
    
         include "views/modules/auth/login.php";
    
 }
   
 ?>



    <!-- ./wrapper -->
    <!-- InputMask -->


<script src="views/js/plantilla.js"></script>
<script src="views/js/remesas.js"></script>
<script src="views/js/pagos.js"></script>


</body>
</html>
