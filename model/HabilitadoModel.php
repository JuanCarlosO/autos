<?php 
/**
 * Habilitado vehicular modelo
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class HabilitadoModel extends Conection
{
	private $sql;
	private $stmt;
	public $result;
	private function saveCar()
	{
		try {
			$this->sql = "INSERT INTO ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=>'AUTOMOVIL ALMACENADO CORRECTAMENTE.') );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	
}
?>