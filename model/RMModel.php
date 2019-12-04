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
			
			$wh_auto = " 1=1 ";
			$wh_falla = " 1=1 ";
			$wh_fact = " 1=1 ";
			for ($i=0; $i <count($anexgrid->filtros) ; $i++) { 
				if( $anexgrid->filtros[$i]['columna'] == 'placa' 
					OR $anexgrid->filtros[$i]['columna'] == 'resguardatario' 

				){
					$wh_auto .= " AND ".$anexgrid->filtros[$i]['columna']. " LIKE '%".$anexgrid->filtros[$i]['valor']."%' ";
				}elseif ( $anexgrid->filtros[$i]['columna'] == 'km' ) {
					$wh_auto .= " AND ".$anexgrid->filtros[$i]['columna']. " >= ".$anexgrid->filtros[$i]['valor']."";
				}elseif ( $anexgrid->filtros[$i]['columna'] == 'r.falla'
					OR $anexgrid->filtros[$i]['columna'] == 'r.taller' 
				) {
					$wh_falla .= " AND ".$anexgrid->filtros[$i]['columna']. " = ".$anexgrid->filtros[$i]['valor']."";

				}elseif( $anexgrid->filtros[$i]['columna'] == 'estado' ){
					if($anexgrid->filtros[$i]['valor'] == ''){
						$wh_fact .= "";
					}elseif ($anexgrid->filtros[$i]['valor'] == '2') {
						$wh_fact .= " AND ".$anexgrid->filtros[$i]['columna']. " != 1";
					}
					else{
						$wh_fact .= " AND ".$anexgrid->filtros[$i]['columna']. " = ".$anexgrid->filtros[$i]['valor']."";
					}
					
				}
			}
			
			#buscar vehiculo
			$aux =array();
			$this->sql = "SELECT id FROM vehiculos WHERE $wh_auto ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$vehiculos = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			foreach ($vehiculos as $key => $value) {
				array_push($aux,$value->id);
			}
			$vehiculos = implode(',',$aux);
			$wh = " vehiculo IN ($vehiculos)";

			$this->sql = "SELECT * FROM solicitudes 
			WHERE $wh
			ORDER BY $anexgrid->columna $anexgrid->columna_orden
            LIMIT $anexgrid->pagina, $anexgrid->limite ";
            
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$solicitudes = $this->stmt->fetchAll( PDO::FETCH_OBJ );	
			$this->sql = "SELECT count(*) as cuenta FROM solicitudes WHERE $wh  ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			#---------------------------------------------------------------------------------------------
			$nuevo = array();
			foreach ($solicitudes as $key => $val) {
				#-----------------------------------------------------------------------------------------
				#Datos de las cotizaciones
				$this->sql = "SELECT monto FROM cotizaciones WHERE solicitud = ?;";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array($val->id));
				if( $this->stmt->rowCount() > 0  ){
					$cotizacion = $this->stmt->fetch( PDO::FETCH_ASSOC );	
				}else{
					$cotizacion =array('estado'=>'vacio','message'=>'Sin registrar');
				}
				$nuevo[$key]['cotizacion'] = $cotizacion;/**/
				#AGREGAR DATOS DEL INGRESO AL TALLER
				$this->sql = "SELECT * FROM ingreso_taller WHERE solicitud = ?;";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array($val->id));
				if( $this->stmt->rowCount() > 0  ){
					$ingreso_taller = $this->stmt->fetchAll( PDO::FETCH_ASSOC );	
				}else{
					$ingreso_taller =array('estado'=>'vacio','message'=>'Sin registrar');
				}
				$nuevo[$key]['ingreso_taller'] = $ingreso_taller;
				#AGREGAR LAS FALLAS
				$this->sql = "SELECT r.id,f.nombre,t.r_social FROM reparaciones AS r 
				INNER JOIN catalogo_fallas AS f ON f.id = r.falla 
				INNER JOIN talleres AS t ON t.id = r.taller
				WHERE r.solicitud = ?;";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array($val->id));
				if( $this->stmt->rowCount() > 0  ){
					$fallas = $this->stmt->fetchAll( PDO::FETCH_ASSOC );	
				}else{
					$fallas =array('estado'=>'vacio','message'=>'Sin registrar');
				}
				$nuevo[$key]['fallas'] = $fallas;
				
				#-----------------------------------------------------------------------------------------
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
				$this->sql  = "SELECT v.*, m.nom AS marca_name,t.nom AS tipo_name, CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS res_name FROM vehiculos AS v 
				INNER JOIN marcas AS m ON m.id = v.marca
				INNER JOIN tipos_v AS t ON t.id = v.tipo
				INNER JOIN personal AS p ON p.id = v.resguardatario
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
					WHERE r.solicitud = ? and $wh_falla
				";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array( $val->vehiculo ));
				$reparaciones = $this->stmt->fetchAll( PDO::FETCH_ASSOC );	
				$nuevo[$key]['data_reparaciones'] = $reparaciones;
				#-----------------------------------------------------------------------------------------
				#Datos de las facturas
				$this->sql = "SELECT id, name, total, solicitud, created_at, estado FROM facturas WHERE solicitud = ? AND $wh_fact;";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array($val->id));
				if( $this->stmt->rowCount() > 0  ){
					$factura = $this->stmt->fetch( PDO::FETCH_ASSOC );	
				}else{
					$factura =array('estado'=>'vacio','message'=>'Sin registrar');
				}
				$nuevo[$key]['factura'] = $factura;/**/
				
			}
			#---------------------------------------------------------------------------------------------
			return $anexgrid->responde($nuevo, $cuenta);
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getPDFCotizacion()
	{
		try {
			$doc ="";
			$s = $_POST['s'];
			$this->sql  = "
				SELECT * FROM cotizaciones WHERE solicitud = ?
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array( $s ));
			
			if( $this->stmt->rowCount() > 0 ){
				$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
				$doc .= '<object data="data:application/pdf;base64,'.base64_encode($this->result->archivo).'" type="application/pdf" style="height:500px;width:100%"></object>';
			}else{
				$doc .= '<H1 class="text-center">NO SE A ALMACENADO NINGUN DOCUMENTO</H1>';
			}
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getPDFactura()
	{
		try {
			$doc ="";
			$s = $_POST['s'];
			$this->sql  = "
				SELECT * FROM facturas WHERE solicitud = ? 
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array( $s ));
			
			if( $this->stmt->rowCount() > 0 ){
				$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
				$doc .= '<object data="data:application/pdf;base64,'.base64_encode($this->result->archivo).'" type="application/pdf" style="height:500px;width:100%"></object>';
			}else{
				$doc .= '<H1 class="text-center">NO SE A ALMACENADO NINGUN DOCUMENTO</H1>';
			}
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getJSONPersonal()
	{
		try {
			$this->sql  = "
				SELECT id AS valor , CONCAT( nombre,' ',ap_pat,' ',ap_mat ) AS contenido FROM personal 
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getJSONFallas()
	{
		try {
			$this->sql  = "
				SELECT id AS valor ,TRIM(nombre) AS contenido FROM catalogo_fallas 
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getJSONTalleres()
	{
		try {
			$this->sql  = "
				SELECT id AS valor ,TRIM(r_social) AS contenido FROM talleres 
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function pagarSolicitud()
	{
		try {
			$id = $_POST['sol'];
			$this->sql  = "
				SELECT * FROM facturas WHERE solicitud = ?
			";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute(array($id));
			
			if ( $this->stmt->rowCount()>0 ) {
				$this->sql  = "
					UPDATE facturas SET estado = 1 WHERE solicitud = ?
				";
				$this->stmt = $this->pdo->prepare($this->sql);
				$this->stmt->execute(array($id));
				return json_encode(array('status'=>'success','message'=>'FACTURA PAGADA CON ÉXITO.'));
			}else{
				throw new Exception("Debe de comunicarle al Habilitado Vehicular que adjunte las facturas para esta solicitud.", 1);
			}

			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	
}
?>