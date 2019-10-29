<?php 
/**
 * Clase modelo del objeto persona
 */
include_once 'conection.php';

class PersonModel extends Conection
{
	public $sql;
	public $stmt;
	public $result;
	public function getPerfil()
	{
		try {
			session_start();
			$persona = $_SESSION['person_id'];
			
			$this->sql = "SELECT CONCAT(nombre,' ',ap_pat,' ',SUBSTRING(ap_mat,1,1),'.') AS full_name FROM personal WHERE id = ?";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$persona,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
			$_SESSION['full_name'] = $this->result->full_name;
			
			return json_encode($_SESSION);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}
}
?>