<?php 
/**
 * Controllador de Recursos Materiales
 */
include_once '../model/RMModel.php';
class RMController
{
	protected $model;
	function __construct()
	{
		$this->model = new RMModel();
	}
	public function getSolicitudes()
	{
		return $this->model->getSolicitudes();
	}
	public function getPDFCotizacion()
	{
		return $this->model->getPDFCotizacion();
	}
	public function getPDFactura()
	{
		return $this->model->getPDFactura();
	}
	
}
?>