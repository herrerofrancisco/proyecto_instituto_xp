<?php
require_once "GUIPreceptor.class.php";
if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Instituto Nuestra Señora | Sistema de Inasistencias</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- links -->
  <link rel="stylesheet" href="../recursos/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="../recursos/dist/css/Style.css">
  <link rel="stylesheet" href="../recursos/dist/css/skins/_all-skins.min.css">
  <link rel="icon" type="image/png" sizes="192x192"  href="../recursos/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../recursos/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../recursos/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../recursos/favicon/favicon-16x16.png">
</head>

<body class="hold-transition skin-red-light sidebar-mini" >
<div class="wrapper">

  <header class="main-header">
    
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>

      </a>
      <a href="home.php" class="logo">
        <span class="logo-mini" style="margin-left: 0px; margin-right: 0px; font-size: 20px; "> 
          <strong>INS</strong> Nuestra Señora
        </span>
        <span class="logo-lg"><strong>INS</strong> Nuestra Señora</span>
           
      </a>

       <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
         
          <!-- cerrar sesion -->
          <li class="dropdown user user-menu">
            <a href="home.php" class="dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-off"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../recursos/imagenes/logo_user.png" class="img-circle" alt="User Image">

                <p style="text-transform: capitalize;">
                  <?php
                  /**
                   * Se consultan los datos de los usuarios para que aparezcan en dropdown, al cerrar sesión.
                   * @author Navarro Karen y Piñero Luciana
                   * @version 1.0
                   */
                  require_once "../persistencia/conexionBD.php";

                  $db=conexionBD::getConexion();
                  //session_start();
                  $tipo=$_SESSION["tipo"];
                  $usuario=$_SESSION["usuario"];
                  if($tipo=="tutor")
                  {
                    $consulta="select * from tutor where email='".$usuario."'";              
                    $resultado = $db -> recuperarAsociativo($consulta);
                    $nombre=$resultado [0]['nombre'];
                    $apellido=$resultado [0]['apellido'];
                    printf($nombre.' '. $apellido);
                  }
                  else if($tipo=="preceptor"){
                    $consulta="select * from preceptor where id_usuario='".$usuario."'";              
                    $resultado = $db -> recuperarAsociativo($consulta);
                    $nombre=$resultado [0]['nombre'];
                    $apellido=$resultado [0]['apellido'];
                    printf($nombre.' '. $apellido);
                  }
                  else if($tipo=="rector")
                  {
                    printf($usuario);
                    
                  }
                  
                  
                  ?>
                 <!--Usuario-->
                  <small><?php printf($tipo); ?></small>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                 
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
           
        </ul>
      </div>
    </nav>
  </header>

<?php
} 
else {
  header('location: ../presentacion/login.php');
}
