<?php 
/**
 * Modelo de Recursos Materiales
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class RMModel extends Conection
{
	private $sql;
	private $stmt;
	public $result;
	public function getSolicitudes()
	{
		try {
			$full_result = array();
			$anexgrid = new AnexGrid();
			$this->sql = "SELECT * FROM solicitudes ORDER BY $anexgrid->columna $anexgrid->columna_orden
            LIMIT $anexgrid->pagina, $anexgrid->limite ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$solicitudes = $this->stmt->fetchAll( PDO::FETCH_OBJ );	
			$this->sql = "SELECT count(*) as cuenta FROM solicitudes  ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			#---------------------------------------------------------------------------------------------
			$nuevo = array();
			foreach ($solicitudes as $key => $val) {

				$nuevo[$key]['solicitudes'] = $val;
				$this->sql  = "SELECT * FROM vehiculos WHERE id = ? ";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array( $val->vehiculo ));
				$vehiculos 	= $this->stmt->fetchAll( PDO::FETCH_ASSOC );	
				$nuevo[$key]['data_vehiculo'] = $vehiculos;
				
			}
			#---------------------------------------------------------------------------------------------
			return $anexgrid->responde($nuevo, $cuenta);
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
}
?>