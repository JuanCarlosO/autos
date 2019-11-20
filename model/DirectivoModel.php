<?php 
/**
 * Clase Modelo del vehiculo.
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class DirectivoModel extends Conection
{
	public $sql;
	public $stmt;
	public $result;

	public function getSolicitudes()
	{
		try {
			
			$anexgrid = new AnexGrid();
			$this->sql = "
			SELECT s.id, s.descripcion, i.observaciones FROM solicitudes AS s
			INNER JOIN ingreso_taller AS i ON i.solicitud = s.id
			WHERE 1 = 1
				ORDER BY $anexgrid->columna $anexgrid->columna_orden
            			LIMIT $anexgrid->pagina, $anexgrid->limite 
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			
			$this->stmt->execute();
			$es = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->sql = "SELECT COUNT(*) AS  cuenta FROM solicitudes AS s
			INNER JOIN ingreso_taller AS i ON i.solicitud = s.id WHERE 1=1";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			return $anexgrid->responde($es, $cuenta);
			
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}

	
}
?>