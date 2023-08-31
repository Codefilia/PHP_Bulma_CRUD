<?php require "./inc/session_start.php";
ob_start();?>
<head>
<?php include "./inc/head.php";?>
</head>
<body>
   <?php 
      /*== Conexion de la pagina con las vistas ==*/
      if(!isset($_GET['vista']) || $_GET['vista']==""){
            $_GET['vista']="login";
          }

      if(is_file("./html/".$_GET['vista'].".php") && $_GET['vista']!="login" 
        && $_GET['vista']!="404"){

            /*== Cerrar Sesion de Manera Forzosa ==*/
          if((!isset($_SESSION['id']) || $_SESSION['id']=="" || (!isset($_SESSION['usuario']))
          || $_SESSION['usuario']=="")){
            include "./html/logout.php";
            exit();
          }

          /*== Inicializando Barra de Navegacion y Vista Login ==*/
          include "./inc/navbar.php";
          include "./html/".$_GET['vista'].".php";
          include "./inc/script.php";

      }else{
          if($_GET['vista']=="login"){
            include "./html/login.php";
          }else{
            include "./html/error_404.php";
          } 
        }?>
</body>
</html>