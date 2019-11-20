<?php 
/**
 * Entidad para los datos de un vehículo 
 */
class UserEntity
{
	public $id;
	public $tipo;
	public $marca;
	public $placas;
	public $n_resguardo;
	public $color;
	public $niv;
	public $n_motor;
	public $modelo;
	public $cil;
	public $estado;
	public $created_at;

	public function __GET($attr)
	{
		return $this->$attr;
	}

	public function __SET($attr,$value='')
	{
		$this->$attr = $value;
	}
}
?>