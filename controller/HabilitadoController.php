<?php 
/**
 * Habilitado vehicular
 */
include_once '../model/CarModel.php';
class HabilitadoController
{
	protected $model;
	function __construct()
	{
		$this->model = new HabilitadoModel();
	}
	
}
?>