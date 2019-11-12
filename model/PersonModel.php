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
	public function autoPersonal()
	{
		try {
			$data = "%".$_REQUEST['term']."%";
			$this->sql = "SELECT CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS value , id FROM personal WHERE nombre LIKE ? OR ap_pat LIKE ? OR ap_mat = ? ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$data,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$data,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$data,PDO::PARAM_STR);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}
}
?>