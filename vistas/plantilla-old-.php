<?php 
session_start(['name'=>'TOR']); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="www.softwarecristina.com">
  <meta name="author" content="www.softwarecristina.com">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo COMPANY; ?></title>

  <?php include "./vistas/inc/Link.php"; ?>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body id="mimin" class="dashboard">
    <?php
		$peticionAjax=false;
		require_once "./controladores/vistasControlador.php";
		$IV = new vistasControlador();

		$vistas=$IV->obtener_vistas_controlador();

		if($vistas=="login" || $vistas=="404" || $vistas=="inscripcion-new"){
			
                    if($vistas=="inscripcion-new"){
                            include "./vistas/inc/link_formulario.php";
                            
                           require_once "./vistas/contenidos/".$vistas."-view.php"; 
                           
                        }else{
                            require_once "./vistas/contenidos/".$vistas."-view.php";
                        }

		}else{
                    
                   $pagina=explode("/", $_GET['views']);
                   require_once "./controladores/loginControlador.php";
                   $lc = new loginControlador();
                    
                   if(!isset($_SESSION['token_tor']) || !isset($_SESSION['usuario_tor']) || !isset($_SESSION['privilegio_tor']) || !isset($_SESSION['id_tor'])){
                      // Comento las siguientes lineas para poder entrar y crear mi primer usuario
                       $lc->forzar_cierre_sesion_controlador();
                       exit(); 
                    }
	?>
    
    
      <!-- start: Header -->
      <?php include "./vistas/inc/NavHeader.php"; ?>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
            <?php include "./vistas/inc/NavLeftMenu.php"; ?>
          <!-- end: Left Menu -->
          <!-- INICIO DEL AREA PARA COLOCAR LAS DIFERENTES VISTAS EN LA APP-->
          <!-- start: Content -->
      		<div id="content">
            
                    <?php 
				include  $vistas;
		    ?>
                    
      		</div>
          <!-- end: Content -->

          <!-- start: right menu -->
           <?php  include "./vistas/inc/NavRightMenu.php"; ?>
          <!-- end: right menu -->
          
      </div>

      <!-- start: Mobile -->
      <?php include "./vistas/inc/NavMobile.php"; ?>
       <!-- end: Mobile -->

                <?php }
                include "./vistas/inc/LogOut.php";
                include "./vistas/inc/Script.php"; ?>
       
  </body>
</html>