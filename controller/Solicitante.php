<?php 
require_once '../model/SolicitanteModel.php';
/**
 * Clase contenedora de los metodos del solicitante
 */
class Solicitante
{
	protected $model;
	function __construct()
	{
		$this->model = new SolicitanteModel();
	}
	public function save_fail($post)
	{
		$falla = $post['textarea_descripcion'];
		#Quitar espacios en blanco
		$falla = trim($falla);
		if ( preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ _]+$/',$falla) ) 
		{
			return $this->model->SaveFail($falla);
		}
		else
		{
			return json_encode( array('status'=>'500','mensaje'=>'El formato de su texto no es legible. Intente nuevamente.') );
		}
	}
	/*Lista del personal de St*/
	public function getPersonST()
	{
		return $this->model->getPersonST();
	}
	/*Obtener la lista de solicitudes*/
	public function getList($post)
	{
		return $this->model->getList($post);
	}
	/*Recuperar mi nombre de usuario*/
	public function getName()
	{
		session_start();
		return $this->model->getName($_SESSION['person_id']);	
	}
	public function listGeneral()
	{
		session_start();
		return $this->model->listGeneral( $_SESSION['person_id'] );	
	}
	public function calificarService($post)
	{
		return $this->model->calificarService( $post );	
	}
}

?>