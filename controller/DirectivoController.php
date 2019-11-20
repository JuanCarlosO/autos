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
		$this->model = new CarModel();
	}
	public function getSolicitudes()
	{
		$this->model->getSolicitudes();
	}
}


?>