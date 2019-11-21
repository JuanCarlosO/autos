<?php 
error_reporting(E_ALL);

include 'Security.php';
spl_autoload_register(function ($class) {
    include $class.'.php';
});
/*DECLARACIÓN DE LAS CLASES*/
$car 	= new CarController;
$sol 	= new SolicitanteController;
$person = new PersonController;
$hab 	= new HabilitadoController;
$vig 	= new VigilanteController;
$rm 	= new RMController;
$dir 	= new DirectivoController;
/***/


if ( isset( $_POST['option'] ) ) 
{

	$option = $_POST['option'] ;

	switch ( $option ) {
		case '1':
			session_start();
			session_destroy();
			# Buscar que el usuario y contraseña exista en la BD 
			$acceso = new Security();
						
			$nick = isset($_POST['username']) ? $_POST['username'] : 0;
			$pass = isset($_POST['userpass']) ? $_POST['userpass'] : 0;
			
			if ( $nick != '0' AND $pass != '0' ) 
			{
				$result = $acceso->search_data_login($nick,$pass);
				
				if (is_object($result)) 
				{

					session_start();
					$_SESSION['user_id'] =  $result->id;
					$_SESSION['person_id'] = $result->person_id;
					$_SESSION['perfil'] = $result->perfil;
					$_SESSION['area_id'] = $result->area_id;
					$_SESSION['status'] = $result->status;
					/*Generar funcion que permita definir los modulos de acceso*/
					$_SESSION['modulos'] = $acceso->getModulos( $result->id );

					header('Location: ../index.php?menu=general');
				}
				else
				{
					header('Location: ../login.php?err=deny-access');
				}
			}
			else
			{
				if ( $nick == 0 ) 
				{
					header('Location: ../login.php?err=userempty');
				}
				if ( $pass == 0 ) 
				{
					header('Location: ../login.php?err=passempty');
				}

			}

			break;
		case '2':
			echo $car->getMarcas();
			break;
		case '3':
			echo $car->getTipos();
			break;
		case '4':
			echo $car->saveCar($_POST);
			break;
		case '5':
			echo $car->getVehiculo($_POST['v']);
			break;
		case '6':
			echo $sol->saveSolicitud($_POST);
			break;
		case '7':
			echo $sol->getFolio($_POST['p']);
			break;
		case '8':
			echo $ha->saveCar($_POST['p']);
			break;
		case '9':
			echo $car->getMarcas();
			break;
		case '10':
			echo $car->saveTipov($_POST);#guardar tipo de vehiculo
			break;
		case '11':
			echo $car->saveMarcav($_POST);#guardar marca de vehiculo
			break;
		case '12':
			echo $car->updateStatus($_POST['v']);#guardar marca de vehiculo
			break;
		case '13':
			echo $person->getPerfil();#Recuperar la informacion del usuario logeado
			break;
		case '14':
			echo $hab->saveTaller($_POST);#Recuperar la informacion del usuario logeado
			break;
		case '15':
			echo $hab->delTaller($_POST['t']);#Dar de baja el taller
			break;
		case '16':
			echo $hab->saveConductor( $_POST );#SIN FUNCIONAMIENTO 
			break;
		case '17':
			echo $hab->saveSiniestro($_POST);
			break;
		case '18':
			echo $hab->getDetalleSol($_POST['sol']);
			break;
		case '19':
			echo $hab->saveAtencion($_POST);
			break;
		case '20':
			echo $hab->getFallas($_POST['t']);
			break;
		case '21':
			echo $hab->getTipoFalla();
			break;
		case '22':
			echo $hab->getListTalleres();
			break;
		case '23':
			echo $hab->saveReparacion($_POST);
			break;
		case '24':
			echo $hab->saveFallas($_POST);
			break;
		case '25':
			echo $hab->saveIngreso($_POST);
			break;
		case '26':
			echo $hab->saveSalida($_POST);
			break;
		case '27':
			echo $hab->saveEvent($_POST);
			break;
		case '28':
			echo $hab->getEvents();
			break;
		case '29':
			echo $hab->entregaAuto($_POST['s']);
			break;
		case '30':
			echo $hab->saveCotizacion();
			break;
		case '31':
			echo $hab->saveEntrega();
			break;
		case '32':
			echo $hab->saveBaja();
			break;
		case '33':
			echo $hab->saveSolHistorica();
			break;
		case '34':
			echo $hab->getTiposDoc();
			break;
		case '35':
			echo $vig->saveSalida();
			break;
		case '36':
			echo $dir->getAutoMasCaro();
			break;
		
			
		default:
			echo json_encode(array('estado'=>'error','message'=>'El puente en POST no encontro la ruta a la que desea enlazarse.'));
			break;
	}
}
elseif( isset($_GET) )
{
	$option = ( isset($_GET['option']) ) ? $_GET['option'] : $_REQUEST['parametros']['option'];

	switch ( $option ) {
		case '1':
			# Anexgrid de Listado de Vehiculos
			echo $sol->getSolicitudes();
			break;
		case '2':
			# Editar una solicitud;
			echo $sol->ModifySolicitud($_GET['sol']);
			break;
		case '3':
			# Consultar la tabla de personal
			echo $sol->autocomplete_personal($_REQUEST['term']);
			break;
		case '4':
			# Consultar la tabla de personal
			echo $car->getPlacas($_REQUEST['term']);
			break;
		case '5':
			echo $car->getMarcas();
			break;
		case '6':
			echo $car->getCars();
			break;
		case '7':
			echo $hab->getTalleres();
			break;
		case '8':
			echo $hab->getSolicitudes();
			break;
		case '9':
			echo $person->autoPersonal($_REQUEST);
			break;
		case '10':
			echo $car->getESToday();
			break;
		case '11':
			echo $car->autoPlacas();
			break;
		case '12':
			echo $vig->getES();
			break;
		case '13':
			echo $rm->getSolicitudes(); ;
			break;
		case '14':
			echo $dir->getSolicitudes(); ;
			break;
		case '15':
			echo $dir->getVehiculosByPlaca(); ;
			break;
		case '16':
			echo $dir->getSolicitudesEsp();
			break;
		default:
			echo json_encode(array('estado'=>'error','message'=>'El puente en GET no encontro la ruta a la que desea enlazarse.'));
			break;
	}
}
elseif( isset($_REQUEST['parametros']['option']) ) 
{	
	echo 'Viene todo de Anexgrid';
}
else
{
	print_r ( array( 'message'=>'La opción del puente no existe. Verifique con Desarrollo de Sistemas' ) );exit;
}


?>