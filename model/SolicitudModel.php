<?php 
/**
 * Clase Modelo del vehiculo.
 */
include_once 'conection.php';
#include_once 'anexgrid.php';
class SolicitudModel extends Conection
{
	public $sql;
	public $stmt;
	public $result;
	
	public function getSolicitud($id)
	{
		try {
			$this->sql = "SELECT * FROM solicitudes WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($id));
			$this->result = $this->stmt->fetch( PDO::FETCH_OBJ );
			return $this->result;
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
}
?>