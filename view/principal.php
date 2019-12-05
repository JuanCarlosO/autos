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
							  		include 'view/pages/habilitado_v/modals/modal_baja_vehiculo.php';
							  		include 'view/pages/habilitado_v/modals/modal_generate_bitacora.php';
							  		include 'view/pages/habilitado_v/modals/modal_seguros.php';
							  		break;
							  	case 'list_car':
							  		include 'view/pages/habilitado_v/content_header/header_general.php';
							  		include 'view/pages/habilitado_v/content_main/content_general.php';
							  		include 'view/pages/habilitado_v/modals/modal_baja_vehiculo.php';
							  		include 'view/pages/habilitado_v/modals/modal_generate_bitacora.php';
							  		include 'view/pages/habilitado_v/modals/modal_seguros.php';

							  		break;
							  	case 'add_car':
							  		include 'view/pages/habilitado_v/content_header/header_add_car.php';
							  		include 'view/pages/habilitado_v/content_main/content_add_car.php';
							  		break;
							  	case 'list_sol':
							  		include 'view/pages/habilitado_v/content_header/header_list_solicitud.php';
							  		include 'view/pages/habilitado_v/content_main/content_list_solicitud.php';
							  		include 'view/pages/habilitado_v/modals/modal_detalle_solicitud.php';
							  		include 'view/pages/habilitado_v/modals/modal_siniestros.php';
							  		include 'view/pages/habilitado_v/modals/modal_add_reparacion.php';
							  		include 'view/pages/habilitado_v/modals/modal_add_fallas.php';
							  		include 'view/pages/habilitado_v/modals/modal_ingreso_taller.php';
							  		include 'view/pages/habilitado_v/modals/modal_finalizar_ingreso.php';
							  		include 'view/pages/habilitado_v/modals/modal_entrega_resguardatario.php';
							  		include 'view/pages/habilitado_v/modals/modal_subir_solicitud.php';
							  		include 'view/pages/habilitado_v/modals/modal_cancelar_solicitud.php';
							  		#LISTA DE MODALES PARA LA COTIZACION Y FACTURACIÓN
							  		include 'view/pages/habilitado_v/modals/modal_cotizacion.php';
							  		include 'view/pages/habilitado_v/modals/modal_facturas.php';
							  		include 'view/pages/habilitado_v/modals/modal_vista_factura.php';
							  		#
							  		include 'view/pages/habilitado_v/modals/modal_solicitud_historica.php';
							  		include 'view/pages/habilitado_v/modals/modal_add_garantia.php';
							  		break;
							  	case 'add_taller':
							  		include 'view/pages/habilitado_v/content_header/header_add_taller.php';
							  		include 'view/pages/habilitado_v/content_main/content_add_taller.php';
							  		break;
							  	case 'list_taller':
							  		include 'view/pages/habilitado_v/content_header/header_list_taller.php';
							  		include 'view/pages/habilitado_v/content_main/content_list_taller.php';
							  		break;
							  	case 'cedula_sol':
							  		include 'view/pages/habilitado_v/content_header/header_cedula_sol.php';
							  		include 'view/pages/habilitado_v/content_main/content_cedula_sol.php';
							  		break;
							  	case 'add_chofer':
							  		include 'view/pages/habilitado_v/content_header/header_add_chofer.php';
							  		include 'view/pages/habilitado_v/content_main/content_add_chofer.php';
							  		break;
							  	case 'eventos':
							  		include 'view/pages/habilitado_v/content_header/header_eventos.php';
							  		include 'view/pages/habilitado_v/content_main/content_eventos.php';
							  		include 'view/pages/habilitado_v/modals/modal_eventos.php';
							  		include 'view/pages/habilitado_v/modals/modal_action_evidencia.php';
							  		include 'view/pages/habilitado_v/modals/modal_add_evidencia.php';
							  		include 'view/pages/habilitado_v/modals/modal_view_evidencia.php';
							  		break;
							  	case 'es':
							  		include 'view/pages/habilitado_v/content_header/header_registro_es.php';
							  		include 'view/pages/habilitado_v/content_main/content_registro_es.php';
							  		break;
							  	case 'list_chofer':
							  		include 'view/pages/habilitado_v/content_header/header_list_chofer.php';
							  		include 'view/pages/habilitado_v/content_main/content_list_chofer.php';
							  		include 'view/pages/habilitado_v/modals/modal_actualiza_licencia.php';
							  		include 'view/pages/habilitado_v/modals/modal_avisos.php';
							  		include 'view/pages/habilitado_v/modals/modal_vista_avisos.php';
							  		break;
							  	case 'add_solicitud':
							  		include 'view/pages/habilitado_v/content_header/header_add_solicitud.php';
							  		include 'view/pages/habilitado_v/content_main/content_add_solicitud.php';
							  		break;
							  	case 'c_digital':
							  		include 'view/pages/habilitado_v/content_header/header_carpeta_digital.php';
							  		include 'view/pages/habilitado_v/content_main/content_carpeta_digital.php';
							  		break;	
							}
						}
						else
						{
							echo " <script> location.href = 'http://localhost/aut/denegado.php' </script> ";
						}
						break;
					case 'Vigilancia':#Perfil Vigilancia
						#--------------------------------------------------------------------------------------
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
								case 'general':
							  		include 'view/pages/vigilancia/content_header/header_general.php';
							  		include 'view/pages/vigilancia/content_main/content_general.php';
							  		break;
							  	case 'listado':
							  		include 'view/pages/vigilancia/content_header/header_listado.php';
							  		include 'view/pages/vigilancia/content_main/content_listado.php';
							  		include 'view/pages/vigilancia/modals/modal_entrada_vehicular.php';
							  		break;
							}
						}
						
					  		
					  	#--------------------------------------------------------------------------------------
						break;
					case 'Recursos Materiales':#Perfil RM
						#--------------------------------------------------------------------------------------
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
								case 'general':
							  		include 'view/pages/recursos_mat/content_header/header_general.php';
							  		include 'view/pages/recursos_mat/content_main/content_general.php';
							  		include 'view/pages/recursos_mat/modals/modal_solicitud_docs.php';
							  		include 'view/pages/recursos_mat/modals/modal_documento.php';
							  		break;
							  	case 'listado_es':
							  		include 'view/pages/recursos_mat/content_header/header_registro_es.php';
							  		include 'view/pages/recursos_mat/content_main/content_registro_es.php';
							  		break;
							}
						}
					  	#--------------------------------------------------------------------------------------
						break;	
					case 'Directivo':#Perfil Directivo
						#--------------------------------------------------------------------------------------
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
								case 'general':
							  		include 'view/pages/directivo/content_header/header_general.php';
							  		include 'view/pages/directivo/content_main/content_general.php';
							  		break;
							  	case 'historic':
							  		include 'view/pages/directivo/content_header/header_historic.php';
							  		include 'view/pages/directivo/content_main/content_historic.php';
							  		break;
							  	case 'estadistic':
							  		include 'view/pages/directivo/content_header/header_estadistic.php';
							  		include 'view/pages/directivo/content_main/content_estadistic.php';
							  		break;
							}
						}
					  	#--------------------------------------------------------------------------------------
						break;
					case 'Sistemas':#Perfil Directivo
						#--------------------------------------------------------------------------------------
						if ( isset($_GET['menu'] ) )
						{
							switch ( $_GET['menu'] )
							{
								case 'general':
							  		include 'view/pages/sistemas/content_header/header_general.php';
							  		include 'view/pages/sistemas/content_main/content_general.php';
							  		break;
							  	
							}
						}
					  	#--------------------------------------------------------------------------------------
						break;
					default:
						echo " <script> alert('El perfil logeado no existe'); location.href = 'http://localhost/autos/denegado.php'; </script> ";
						break;
				}

			}
			?>
		</div>
		<?php include 'view/pages/footer.php'; ?>
  	<div class="control-sidebar-bg"></div>
  </div>
<?php include 'view/pages/scripts.php'; ?>
