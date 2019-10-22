<?php  
date_default_timezone_set('America/Mexico_City');

?>
<?php include 'view/pages/head.php'; ?>
<body class="hold-transition skin-green sidebar-mini ">
	<div class="wrapper">
		<!-- Main Header -->
		<?php include_once 'view/pages/navbar.php'; ?>
		<!-- Left side column. contains the logo and sidebar -->
		<?php include_once 'view/pages/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?php
			
			if (  isset($_SESSION['perfil']) )
			{
				$perfil = $_SESSION['perfil'];
				#redireccionaro de acuerdo al nivel del perfil
				switch ( $perfil ) {
					case 'Solicitante': #Perfil Solicitante
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
							  	case 'add_sol':
							  		include 'view/pages/solicitante/content_header/header_add_sol.php';
							  		include 'view/pages/solicitante/content_main/content_add_sol.php';
							  		break;
							  	case 'general':
							  		include 'view/pages/solicitante/content_header/header_general.php';
							  		include 'view/pages/solicitante/content_main/content_general.php';
							  		break;
							  	case 'list_sol':
							  		include 'view/pages/solicitante/content_header/header_general.php';
							  		include 'view/pages/solicitante/content_main/content_general.php';
							  		break;
							  	default:
							  		echo " <script> location.href = 'http://localhost/autos/denegado.php' </script> ";
							  		die();
							  		break;
							}
						}
						else
						{
							echo " <script> location.href = 'http://localhost/autos/denegado.php' </script> ";
						}
						break;
					case 'Habilitado':#Perfil Habilitado Vehicular
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
							  	case 'general':
							  		include 'view/pages/habilitado_v/content_header/header_general.php';
							  		include 'view/pages/habilitado_v/content_main/content_general.php';
							  		break;
							  	case 'list_car':
							  		include 'view/pages/habilitado_v/content_header/header_general.php';
							  		include 'view/pages/habilitado_v/content_main/content_general.php';
							  		break;
							  	case 'add_car':
							  		include 'view/pages/habilitado_v/content_header/header_add_car.php';
							  		include 'view/pages/habilitado_v/content_main/content_add_car.php';
							  		break;
							  	case 'list_sol':
							  		include 'view/pages/solicitante/content_header/header_general.php';
							  		include 'view/pages/solicitante/content_main/content_general.php';
							  		break;
							}
						}
						else
						{
							echo " <script> location.href = 'http://localhost/aut/denegado.php' </script> ";
						}
						break;
					default:
						echo " <script> alert('El perfil logeado no existe'); location.href = 'http://localhost/autos/denegado.php'; </script> ";
						break;
				}

			}
			?>
		</div>
		<?php include 'view/pages/footer.php'; ?>
		<?php include 'view/pages/aside_lateral.php'; ?>
  	<div class="control-sidebar-bg"></div>
  </div>
<?php include 'view/pages/scripts.php'; ?>
