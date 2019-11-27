<?php
/**
 * Cargar de datos del solicitante
 */
class SolicitudEntity
{
	
	public $id;	
	public $folio;
	public $fecha;
	public $ap_mat;
	public $km;
	public $solicitante;
	public $placa;
	public $descripcion;
	
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