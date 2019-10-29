<?php
/**
 * Clase del objeto persona 
 */
include_once '../model/PersonModel.php';
class PersonController
{
	protected $model;
	function __construct()
	{
		$this->model = new PersonModel();
	}
	public function getPerfil()
	{
		return $this->model->getPerfil();
	}
}
?>