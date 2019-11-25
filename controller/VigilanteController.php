<?php
/**
 * Controlador de los vigilantes
 */
include_once '../model/VigilanteModel.php';
class VigilanteController
{
	protected $model;
	function __construct()
	{
		$this->model = new VigilanteModel();
	}
	public function saveSalida()
	{
		return $this->model->saveSalida();
	}
	public function getES()
	{
		return $this->model->getES();
	}
	public function saveEntrada()
	{
		return $this->model->saveEntrada();
	}
	
}
 ?>