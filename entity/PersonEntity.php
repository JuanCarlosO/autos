<?php 
/**
 * Entidad de los datos de una persona
 */
class PersonEntity
{
	public $id;	
	public $nombre
	public $ap_pat;
	public $ap_mat;
	public $clave;
	public $area_id;
	public $status;
	public $genero;
	
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