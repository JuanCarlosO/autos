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
			SELECT s.id, UPPER(s.descripcion) AS solicitante, UPPER(i.observaciones) AS habilitado FROM solicitudes AS s
			INNER JOIN ingreso_taller AS i ON i.solicitud = s.id
				ORDER BY $anexgrid->columna $anexgrid->columna_orden
            	LIMIT $anexgrid->pagina, $anexgrid->limite 
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			
			$this->stmt->execute();
			$es = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->sql = "SELECT COUNT(*) AS  cuenta FROM solicitudes AS s
			INNER JOIN ingreso_taller AS i ON i.solicitud = s.id ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			return $anexgrid->responde($es, $cuenta);
			
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}

	public function getVehiculosByPlaca()
	{
		try {
			$text = "%".$_REQUEST['term']."%";
			$this->sql = "
			SELECT id, placas AS value FROM vehiculos WHERE placas LIKE ?
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$text);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
			
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function getSolicitudesEsp()
	{
		try {
			$anexgrid = new AnexGrid();
			$wh = "";
			if (isset($_REQUEST['parametros']['f_ini']) AND isset($_REQUEST['parametros']['f_fin']) ) {
				if (!empty($_REQUEST['parametros']['f_ini']) AND !empty($_REQUEST['parametros']['f_fin']) ){
					$wh .= " AND f_sol BETWEEN :ini AND :fin ";
				}
			}else{
				throw new Exception("DEBE DE SELECCIONAR UN RANGO DE FECHAS", 1);
			}
			if (isset($_REQUEST['parametros']['placa']) ) {
				if (!empty($_REQUEST['parametros']['placa']) ){
					$wh .= " AND vehiculo = :auto";
				}
			}else{
				throw new Exception("VUELVA A BUSCAR EL NÚMERO DE PLACA.", 1);
			}
			
			$this->sql = "
			SELECT s.*,c.monto FROM solicitudes AS s 
			INNER JOIN cotizaciones AS c ON c.solicitud = s.id 
			WHERE 1=1 $wh
			ORDER BY s.$anexgrid->columna $anexgrid->columna_orden
            LIMIT $anexgrid->pagina, $anexgrid->limite 
			";

			$this->stmt = $this->pdo->prepare($this->sql);
			if (isset($_REQUEST['parametros']['f_ini']) AND isset($_REQUEST['parametros']['f_fin']) ) {
				if (!empty($_REQUEST['parametros']['f_ini']) AND !empty($_REQUEST['parametros']['f_fin']) ){
					$this->stmt->bindParam(':ini',$_REQUEST['parametros']['f_ini']);
					$this->stmt->bindParam(':fin',$_REQUEST['parametros']['f_fin']);
				}
			}
			if (isset($_REQUEST['parametros']['placa'])) {
				if (!empty($_REQUEST['parametros']['placa'])){
					$this->stmt->bindParam(':auto',$_REQUEST['parametros']['placa']);
				}
			}
			
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			

			$this->sql = "SELECT COUNT(*) AS cuenta FROM solicitudes AS s 
			INNER JOIN cotizaciones AS c ON c.solicitud = s.id 
			WHERE 1=1 $wh ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			if (isset($_REQUEST['parametros']['f_ini']) AND isset($_REQUEST['parametros']['f_fin']) ) {
				if (!empty($_REQUEST['parametros']['f_ini']) AND !empty($_REQUEST['parametros']['f_fin']) ){
					$this->stmt->bindParam(':ini',$_REQUEST['parametros']['f_ini']);
					$this->stmt->bindParam(':fin',$_REQUEST['parametros']['f_fin']);
				}
			}
			if (isset($_REQUEST['parametros']['placa'])) {
				if (!empty($_REQUEST['parametros']['placa'])){
					$this->stmt->bindParam(':auto',$_REQUEST['parametros']['placa']);
				}
			}
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;

			echo $anexgrid->responde($this->result, $cuenta);

		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function getAutoMasCaro()
	{
		try {
			#Top 10 de los vehiculos que mas se caro an salido sus reparaciones
			$this->sql = "
			SELECT s.id AS solictud,s.vehiculo,COUNT(vehiculo) AS cuenta_v,SUM(c.monto) AS sumatoria, v.placas FROM solicitudes AS s
				INNER JOIN cotizaciones AS c ON c.solicitud = s.id
				INNER JOIN vehiculos AS v ON v.id = s.vehiculo
			GROUP BY vehiculo
			ORDER BY sumatoria DESC
			LIMIT 0,10
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}

	
}
?>