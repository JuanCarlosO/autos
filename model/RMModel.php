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
			$this->sql = "SELECT * FROM solicitudes 
			ORDER BY $anexgrid->columna $anexgrid->columna_orden
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
				#Buscar datos del solictante
				$this->sql  = "SELECT CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS full_name, area_id  FROM personal WHERE id = ? ";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array( $val->solicitante ));
				$sol 	= $this->stmt->fetch( PDO::FETCH_ASSOC );	
				$nuevo[$key]['solicitudes']->solicitante_name = $sol['full_name'];
				#Buscar los datos del area
				$this->sql  = "SELECT nombre FROM area WHERE id = ? ";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array( $sol['area_id'] ));
				$area 	= $this->stmt->fetch( PDO::FETCH_ASSOC );	
				$nuevo[$key]['solicitudes']->area_sol = $area['nombre'];
				#------AGREGAR LOS VEHICULOS---------------------------------------------------------
				$this->sql  = "SELECT v.*, m.nom AS marca_name,t.nom AS tipo_name FROM vehiculos AS v 
				INNER JOIN marcas AS m 
				INNER JOIN tipos_v AS t
				WHERE v.id = ? ";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array( $val->vehiculo ));
				$vehiculos 	= $this->stmt->fetchAll( PDO::FETCH_ASSOC );	
				$nuevo[$key]['data_vehiculo'] = $vehiculos;		
				#Agregar las reparaciones		
				$this->sql  = "
					SELECT cf.nombre AS falla, t.r_social FROM reparaciones AS r
					INNER JOIN catalogo_fallas AS cf ON cf.id = r.falla
					INNER JOIN talleres AS t ON t.id = r.taller
					WHERE r.solicitud = ?
				";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array( $val->vehiculo ));
				$reparaciones = $this->stmt->fetchAll( PDO::FETCH_ASSOC );	
				$nuevo[$key]['data_reparaciones'] = $reparaciones;
			}
			#---------------------------------------------------------------------------------------------
			return $anexgrid->responde($nuevo, $cuenta);
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
}
?>