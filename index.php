<?php
#Importar los modelos necesarios
include_once 'model/conection.php';

session_start();
if ( isset( $_SESSION['user_id'] ) )
{
	include_once 'view/principal.php';
}
else
{
	header('Location: login.php');
}

?>
