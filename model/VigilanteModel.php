<?php  
/**
 * Modelo de los vigilantes
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class VigilanteModel extends Conection
{
	public $sql;
	public $stmt;
	public $result;
	public function saveSalida(){
		try {
			$vigilante 	= $_POST['vigilante_id'];
			$placa 		= $_POST['placa_id'];
			$conductor 	= $_POST['chofer_id'];
			$gas 		= (int)$_POST['nivel_gas'];
			$kms 		= $_POST['km_salida'];

			$this->sql = "INSERT INTO registro_es (id,registra,vehiculo,conductor,gas_salida,km_salida,estado) 
			VALUES ('',?, ?, ?, ?, ?, 1);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$vigilante,PDO::PARAM_INT);
			$this->stmt->bindParam(2,$placa,PDO::PARAM_INT);
			$this->stmt->bindParam(3,$conductor,PDO::PARAM_INT);
			$this->stmt->bindParam(4,$gas,PDO::PARAM_STR);
			$this->stmt->bindParam(5,$kms,PDO::PARAM_STR);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=>'REGISTRO DE SALIDA DE VEHÍCULO EXITOSO.' ) );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function getES(){
			try {
				$wh = ' 1 = 1 ';
				$anexgrid = new AnexGrid();
				$this->sql = "
				SELECT 
					r.*,
					(SELECT CONCAT(nombre,' ',ap_pat,' ',ap_mat ) AS full_name FROM personal WHERE id = r.registra) AS registro,
					(SELECT CONCAT(nombre,' ',ap_pat,' ',ap_mat ) AS full_name FROM personal WHERE id = r.conductor) AS chofer,
					tv.nom AS t_vehiculo,
					m.nom AS marca,
					v.placas AS placa
				FROM registro_es AS r
				INNER JOIN vehiculos AS v ON v.id = r.vehiculo
				LEFT JOIN tipos_v AS tv ON tv.id = v.tipo  
				LEFT JOIN marcas AS m ON m.id = v.marca  
					WHERE ".$wh."
					ORDER BY $anexgrid->columna $anexgrid->columna_orden
	            			LIMIT $anexgrid->pagina, $anexgrid->limite 
				";
				$this->stmt = $this->pdo->prepare($this->sql);
				
				$this->stmt->execute();
				$es = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
				$this->sql = "SELECT COUNT(*) AS cuenta FROM registro_es AS r
				INNER JOIN vehiculos AS v ON v.id = r.vehiculo
				LEFT JOIN tipos_v AS tv ON tv.id = v.tipo  
				LEFT JOIN marcas AS m ON m.id = v.marca  
					WHERE ".$wh;
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
				return $anexgrid->responde($es, $cuenta);
				
			} catch (Exception $e) {
				return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
			}
	}
	public function saveEntrada(){
		try {
			$id 	= $_POST['registro'];
			$gas 	= $_POST['nivel_gas'];
			$ent 	= $_POST['f_entrada'].' '.$_POST['hora'].':00';
			$km 	= $_POST['km'];
			$this->sql = "UPDATE registro_es SET entrada = ?,gas_entrada = ? , km_entrada = ? WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$ent,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$gas,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$km,PDO::PARAM_INT);
			$this->stmt->bindParam(4,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=> 'LA ENTRADA DEL VEHÍCULO A SIDO REGISTRADA CON ÉXITO.' ) );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	
}
?>