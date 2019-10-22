<?php  
/**
 * Clase del vehiculo
 */
include_once '../model/CarModel.php';
class CarController 
{
	protected $model;
	function __construct()
	{
		$this->model = new CarModel();
	}

	public function getCars()
	{
		return $this->model->getCars();
	}
	public function getMarcas()
	{
		return $this->model->getMarcas();
	}
	public function getTipos()
	{
		return $this->model->getTipos();
	}
	public function getPlacas($term)
	{
		return $this->model->getPlacas($term);
	}
	public function getVehiculo($term)
	{
		return $this->model->getVehiculo($term);
	}
	public function saveCar($post)
	{
		/*Validar la informacion*/
		try {
			if ( isset($post['m_veh']) AND empty($post['m_veh']) ) {
				throw new Exception("DEBE DE SELECCIONAR UNA MARCA DE VEHÍCULO", 1);
			}
			if ( isset($post['t_veh']) AND empty($post['t_veh']) ) {
				throw new Exception("DEBE DE SELECCIONAR UN TIPO DE VEHÍCULO", 1);
			}
			if ( isset($post['placas']) AND empty($post['placas']) ) {
				throw new Exception("DEBE ESCRIBIR TODOS LOS NÚMEROS Y LETRAS DE LA PLACA", 1);
			}
			if ( isset($post['reguardo']) AND empty($post['reguardo']) ) {
				throw new Exception("DEBE DE ESCRIBIR UN NÚMERO DE RESGUARDO DEL VEHÍCULO", 1);
			}
			if ( isset($post['niv']) AND empty($post['niv']) ) {
				throw new Exception("DEBE ESCRIBIR EL NÚMERO DE IDENTIFICACIÓN VEHICULAR", 1);
			}
			if ( isset($post['cilindros']) AND empty($post['cilindros']) ) {
				throw new Exception("DEBE DE SELECCIONAR UN TIPO DE VEHÍCULO", 1);
			}
			if ( isset($post['n_motor']) AND empty($post['n_motor']) ) {
				throw new Exception("DEBE ESCRIBIR EL NÚMERO DE MOTOR", 1);
			}
			if ( isset($post['modelo']) AND empty($post['modelo']) ) {
				throw new Exception("DEBE ESCRIBIR UN MODELO DE VEHÍCULO", 1);
			}
			if ( isset($post['color']) AND empty($post['color']) ) {
				throw new Exception("DEBE SELECCIONAR UN COLOR.", 1);
			}
			return $this->model->saveCar($post);
			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
}


?>