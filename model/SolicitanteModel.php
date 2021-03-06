<?php 
/**
 * Clase Modelo del vehiculo.
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class SolicitanteModel extends Conection
{
	public $sql;
	public $stmt;
	public $result;
	
	public function getSolicitudes()
	{
		try {
			session_start(); 
			#print_r( $_SESSION );die();

			$anexgrid = new AnexGrid();
			/*Definir el Where*/
			if ( isset($_REQUEST['filtros']) ) {
				$filtros = (object)$_REQUEST['filtros'][0];
				print_r( $filtros );exit;
			}else
			{
				$wh = " 1=1 ";
			}
			if ( $_SESSION['perfil'] == 'Solicitante' ) {
				$wh .= " AND s.solicitante = ".$_SESSION['person_id']." ";
			}
			
			$this->sql = "
			SELECT s.*,m.nom AS marca,t.nom AS tipo, v.placas, v.modelo, v.niv, CONCAT(p.nombre, ' ', p.ap_pat,' ',p.ap_mat) AS full_name , i.observaciones AS opinion_hv
			FROM solicitudes AS s
			INNER JOIN vehiculos AS v ON v.id = s.vehiculo
			INNER JOIN personal AS p ON p.id = s.solicitante
			INNER JOIN tipos_v AS t ON t.id = v.tipo
			INNER JOIN marcas AS m ON m.id = v.marca
			INNER JOIN ingreso_taller AS i ON i.solicitud = s.id
			WHERE
			".$wh." ORDER BY $anexgrid->columna $anexgrid->columna_orden
            LIMIT $anexgrid->pagina, $anexgrid->limite ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$modulos = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$this->sql = "SELECT COUNT(*) AS cuenta FROM solicitudes AS s
			INNER JOIN vehiculos AS v ON v.id = s.vehiculo
			INNER JOIN personal AS p ON p.id = s.solicitante
			INNER JOIN tipos_v AS t ON t.id = v.tipo
			INNER JOIN marcas AS m ON m.id = v.marca";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			/*Carga de anexGrid*/
			return $anexgrid->responde($modulos, $cuenta);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}

	public function ModifySolicitud($sol='')
	{
		try {
			if ( empty($sol) ) {
				throw new Exception("No se a capturado el ID de la solicitud", 1);
			}else{
				json_encode(array('status'=>'error','message'=>'Modificado'));
			}
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}

	public function autocomplete_personal($term)
	{
		try {
			$valor = "%".$term."%";
			$this->sql = "
			SELECT
			    id,
			    CONCAT(nombre, ' ', ap_pat, ' ', ap_mat) AS value 
			FROM
			    personal
			WHERE
			    (nombre LIKE :term OR ap_pat LIKE :term OR ap_mat LIKE :term) #AND status = 'ALTA'
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(':term',$valor,PDO::PARAM_STR);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			if ( count($this->result) == 0) {
				$res[0]['id']= 0;
				$res[0]['value']= 'NO SE ENCONTRARON RESULTADOS.';
				return json_encode($res); 
			}else{
				return json_encode( $this->result );
			}
			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}

	public function saveSolicitud($f_sol,$km,$solicitante,$resguardatario,$placa,$desc,$folio)
	{
		try {
			$desc = mb_strtoupper($desc,'utf-8');
			#VALIDAR QUE NO TENGA LA LICENCIA VENCIDA
			$this->sql = "SELECT IF( f_vencimiento <= DATE(NOW()),'denegado','permitido') AS permiso FROM licencias WHERE persona = ? ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$solicitante,PDO::PARAM_INT);
			$this->stmt->execute();
			$permiso = $this->stmt->fetch(PDO::FETCH_OBJ);

			if (  !empty($permiso->permiso) AND $permiso->permiso == 'denegado' ) {
				throw new Exception("LICENCIA DE CONDUCIR VENCIDA. DEBE RENOVAR SU LICENCIA DE CONDUCIR PARA PODER GENERAR SOLICITUDES.", 1);
			}else if( empty($permiso) || !isset($permiso) ){
				throw new Exception("AÚN NO CUENTAS CON EL PERMISO DE CONDUCIR UNA UNIDAD OFICIAL.", 1);
			}

			$this->sql = "INSERT INTO solicitudes(
				id,folio,f_sol,km,solicitante,vehiculo,estado ,descripcion
				) VALUES (
					'',
					?,
					?,
					?,
					?,
					?,
					1,
					?
				);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$folio,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$f_sol,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$km,PDO::PARAM_INT);
			$this->stmt->bindParam(4,$solicitante,PDO::PARAM_INT);
			$this->stmt->bindParam(5,$placa,PDO::PARAM_INT);
			$this->stmt->bindParam(6,$desc,PDO::PARAM_STR);
			$this->stmt->execute();
			return json_encode(array('status'=>'success','message'=>'LA SOLICITUD SE A INSERTADO CON ÉXITO.' ));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}

	public function getFolio($p)
	{
		try {
			$this->sql = "SELECT COUNT(id) AS cuenta FROM solicitudes WHERE YEAR(f_sol) = YEAR(NOW())";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$p,PDO::PARAM_INT);
			$this->stmt->execute();	
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
			if ( isset($this->result->cuenta) ) {
				#echo "SI HUBO EN LA BASE DE DATOS";
				$this->result = $this->result ;
			}else{
				#echo "NO HUBO EN LA BASE DE DATOS";
				$this->result = (object)array('cuenta'=>0);

			}
			#exit;
			$conteo = (int)$this->result->cuenta +1 ;
			return $conteo;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getSolcitudEsp($s)
	{
		try {
			$this->sql = "
			SELECT s.*,CONCAT(p.nombre, ' ',p.ap_pat,' ',p.ap_mat) AS solicitante_name ,
			a.nombre AS area_name,v.placas, m.nom AS marca, 
			tv.nom AS tipo
			FROM solicitudes AS s 
			INNER JOIN personal AS p ON p.id = s.solicitante
			INNER JOIN area AS a ON a.id = p.area_id
			INNER JOIN vehiculos AS v ON v.id = s.vehiculo
			INNER JOIN marcas AS m ON m.id = v.marca
			INNER JOIN tipos_v AS tv ON tv.id = v.tipo
			WHERE s.id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$s,PDO::PARAM_INT);
			$this->stmt->execute();	
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
			
			return $this->result;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}	
}
?>