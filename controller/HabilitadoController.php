<?php 
/**
 * Habilitado vehicular
 */
include_once '../model/HabilitadoModel.php';
class HabilitadoController
{
	protected $model;
	function __construct()
	{
		$this->model = new HabilitadoModel();
	}

	public function saveTaller($post)
	{
		if (isset($post['id'])) {
			return $this->model->updateTaller($post);
		}else{
			return $this->model->saveTaller($post);
		}
	}
	public function getTalleres()
	{
		return $this->model->getTalleres();
	}
	public function delTaller($t)
	{
		return $this->model->delTaller($t);
	}
	public function getTaller($t)
	{
		return $this->model->getTaller($t);
	}
	public function saveConductor($post)
	{
		return $this->model->saveConductor($post);
	}
	public function getSolicitudes()
	{
		return $this->model->getSolicitudes();
	}
	public function saveSiniestro($post)
	{
		return $this->model->saveSiniestro($post);
	}
	public function getDetalleSol($sol)
	{
		return $this->model->getDetalleSol($sol);
	}
	public function saveAtencion($post)
	{
		return $this->model->saveAtencion($post);
	}
	public function getFallas($t)
	{
		return $this->model->getFallas($t);
	}
	public function getTipoFalla()
	{
		return $this->model->getTipoFalla();
	}
	public function getListTalleres()
	{
		return $this->model->getListTalleres();
	}
	public function saveReparacion($post)
	{
		return $this->model->saveReparacion($post);
	}
	public function saveFallas($post)
	{
		return $this->model->saveFallas($post);
	}
	public function saveIngreso($post)
	{
		return $this->model->saveIngreso($post);
	}
	public function saveSalida($post)
	{
		return $this->model->saveSalida($post);
	}
	public function saveEvent($post)
	{
		return $this->model->saveEvent($post);
	}
	public function getEvents()
	{
		return $this->model->getEvents();
	}
	public function entregaAuto($s)
	{
		return $this->model->entregaAuto($s);
	}
	public function saveCotizacion()
	{
		
		return $this->model->saveCotizacion();
	}
	public function saveEntrega()
	{
		return $this->model->saveEntrega();
	}
	public function saveBaja()
	{
		return $this->model->saveBaja();
	}
	
	
}
?>