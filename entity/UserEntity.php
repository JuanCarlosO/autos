<?php 
/**
 * Entidad para los datos de un usuario 
 */
class UserEntity
{
	public $id;
	public $nick;
	public $pass;
	public $person_id;
	public $area_id;
	public $perfil;
	public $status;

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