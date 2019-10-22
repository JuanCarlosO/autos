<?php  
/**
 * Clase del vehiculo
 */
include_once '../model/SolicitanteModel.php';
class SolicitanteController 
{
	protected $model;
	function __construct()
	{
		$this->model = new SolicitanteModel();
	}
	public function getSolicitudes()
	{
		return $this->model->getSolicitudes();
	}
	public function ModifySolicitud()
	{
		return $this->model->ModifySolicitud();
	}
	public function autocomplete_personal($term)
	{
		return $this->model->autocomplete_personal($term);
	}
	public function saveSolicitud()
	{
		try {
			
			if ( !isset($_POST['f_sol']) && !empty($_POST['f_sol']) ) {
				throw new Exception("DEBE ELEGIR UNA FECHA DE SOLICITUD.", 1);
			}
			$f_sol = $_POST['f_sol'];
			if ( !isset($_POST['km']) && !empty($_POST['km']) ) {
				throw new Exception("DEBE ESCRIBIR EL KILOMETRAJE ACTUAL DEL VEHÍCULO.", 1);
			}
			$km = $_POST['km'];
			if ( !isset($_POST['solicitante_h']) && !empty($_POST['solicitante_h']) ) {
				throw new Exception("DEBE DE BUSCAR Y SELECCIONAR A UNA PERSONA.", 1);
			}
			$solicitante = $_POST['solicitante_h'];
			if ( !isset($_POST['resguardatario_h']) && !empty($_POST['resguardatario_h']) ) {
				throw new Exception("NO SE ENCONTRO RESGUARDATARIO.", 1);
			}
			$resguardatario = $_POST['resguardatario_h'];
			if ( !isset($_POST['placa_h']) && !empty($_POST['placa_h']) ) {
				throw new Exception("NO SE ENCONTRO NÚMERO DE PLACA.", 1);
			}
			$placa 	= $_POST['placa_h'];
			$desc 	= $_POST['desc'];
			$folio 	= $_POST['folio'];
			
			return $this->model->saveSolicitud($f_sol,$km,$solicitante,$resguardatario,$placa,$desc,$folio);
		} catch (Exception $e) {
			return json_encode(array('status'=>'error', 'message'=>$e->getMessage() ));
		}
		
	}
	public function getFolio($person)
	{
		return $this->model->getFolio($person);
	}
	
}


?>