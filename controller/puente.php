<?php 
error_reporting(E_ALL);

include 'Security.php';
spl_autoload_register(function ($class) {
    include $class.'.php';
});
/*DECLARACIÓN DE LAS CLASES*/
$car = new CarController;
$sol = new SolicitanteController;
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
		
		default:
			echo json_encode(array('estado'=>'error','message'=>'El puente no encontro la ruta a la que desea enlazarse.'));
			break;
	}
}
elseif( isset($_GET) )
{
	$option = $_GET['option'];
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
		default:
			echo json_encode(array('estado'=>'error','message'=>'El puente no encontro la ruta a la que desea enlazarse.'));
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