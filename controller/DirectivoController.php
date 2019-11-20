<?php  
/**
 * Clase del vehiculo
 */
include_once '../model/DirectivoModel.php';
class DirectivoController 
{
	protected $model;
	function __construct()
	{
		$this->model = new DirectivoModel();
	}
	public function getSolicitudes()
	{
		return $this->model->getSolicitudes();
	}
	public function getVehiculosByPlaca()
	{
		return $this->model->getVehiculosByPlaca();
	}
	public function getSolicitudesEsp()
	{
		return $this->model->getSolicitudesEsp();
	}
	
}


?>