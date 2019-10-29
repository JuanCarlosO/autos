<?php 
/**
 * Habilitado vehicular modelo
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class HabilitadoModel extends Conection
{
	private $sql;
	private $stmt;
	public $result;
	public function saveTaller($post)
	{
		try {
			$razon 		= mb_strtoupper($post['r_social'],'utf-8');
			$contacto 	= mb_strtoupper($post['contacto'],'utf-8');
			$tel 		= $post['tel'] ;
			$email 		= mb_strtolower($post['email'],'utf-8');
			$dir 		= mb_strtoupper($post['direccion'],'utf-8');
			$this->sql = "INSERT INTO talleres (id,r_social,contacto,telefono,correo,domicilio) VALUES ('',?,?,?,?,?);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$razon,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$contacto,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$tel,PDO::PARAM_STR);
			$this->stmt->bindParam(4,$email,PDO::PARAM_STR);
			$this->stmt->bindParam(5,$dir,PDO::PARAM_STR);
			$this->stmt->execute();

			return json_encode( array('status'=>'success','message'=>'TALLER ALMACENADO CORRECTAMENTE.') );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function updateTaller($post)
	{
		try {
			$razon 		= mb_strtoupper($post['r_social'],'utf-8');
			$contacto 	= mb_strtoupper($post['contacto'],'utf-8');
			$tel 		= $post['tel'] ;
			$email 		= mb_strtolower($post['email'],'utf-8');
			$dir 		= mb_strtoupper($post['direccion'],'utf-8');
			$id 		= $post['id'];
			$this->sql = "UPDATE talleres SET r_social=?,contacto = ?,telefono = ?, correo = ? , domicilio = ? WHERE id = ?;";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$razon,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$contacto,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$tel,PDO::PARAM_STR);
			$this->stmt->bindParam(4,$email,PDO::PARAM_STR);
			$this->stmt->bindParam(5,$dir,PDO::PARAM_STR);
			$this->stmt->bindParam(6,$id,PDO::PARAM_INT);
			$this->stmt->execute();

			return json_encode( array('status'=>'success','message'=>'TALLER ACTUALIZADO CORRECTAMENTE.') );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}

	public function getTalleres()
	{
		try {
			$anexgrid = new AnexGrid();
			/*Definir el Where*/
			if ( isset($_REQUEST['filtros']) ) {
				$filtros = (object)$_REQUEST['filtros'];
				#print_r($filtros);exit;
				$wh = " 1=1 ";
				foreach ($filtros as $key => $filtro) {
					$wh .= " AND ".$filtro['columna']." LIKE "."'%".$filtro['valor']."%'";
				}
			}else
			{
				$wh = " 1=1 ";
			}
			
			$this->sql = "SELECT * FROM talleres 
						WHERE".$wh." ORDER BY $anexgrid->columna $anexgrid->columna_orden
            			LIMIT $anexgrid->pagina, $anexgrid->limite ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$modulos = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$this->sql = "SELECT COUNT(*) AS cuenta FROM modulos ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			/*Carga de anexGrid*/
			return $anexgrid->responde($modulos, $cuenta);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}

	public function delTaller($t)
	{
		try {
			$this->sql = "DELETE FROM talleres WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$t,PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=>'TALLER ELIMINADO CORRECTAMENTE.' ) );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}

	public function getTaller($t)
	{
		try {
			$this->sql = "SELECT * FROM talleres 
						WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$t,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			
			return $this->result;
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}

	/*Guardar el conductor*/
	public function saveConductor($post)
	{
		try {
			$this->sql = "INSERT INTO talleres (id,r_social,contacto,telefono,correo,domicilio) VALUES ('',?,?,?,?,?);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$razon,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$contacto,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$tel,PDO::PARAM_STR);
			$this->stmt->bindParam(4,$email,PDO::PARAM_STR);
			$this->stmt->bindParam(5,$dir,PDO::PARAM_STR);
			$this->stmt->execute();

			return json_encode( array('status'=>'success','message'=>'TALLER ALMACENADO CORRECTAMENTE.') );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}

	/*Listar las solicitudes*/
	public function getSolicitudes()
	{
		try {
			$anexgrid = new AnexGrid();
			/*Definir el Where*/
			$folio = "";
			if ( isset($_REQUEST['filtros']) ) {
				$filtros = (object)$_REQUEST['filtros'][0];
				$wh = $filtros->columna." LIKE '%".$filtros->valor."%'";
			}else
			{
				$wh = " 1=1 ";
			}
			
			$this->sql = "
			SELECT s.*,m.nom AS marca,t.nom AS tipo, v.placas, v.modelo, v.niv, CONCAT(p.nombre, ' ', p.ap_pat,' ',p.ap_mat) AS full_name FROM solicitudes AS s
			INNER JOIN vehiculos AS v ON v.id = s.vehiculo
			INNER JOIN personal AS p ON p.id = s.solicitante
			INNER JOIN tipos_v AS t ON t.id = v.tipo
			INNER JOIN marcas AS m ON m.id = v.marca
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
	/*Guardar el siniestro*/
	public function saveSiniestro($post)
	{
		try {

			$aseguradora 	= mb_strtoupper($post['name_aseguradora'],'utf-8');
			$observaciones  = (isset($post['observaciones'])) ? mb_strtoupper($post['observaciones'],'utf-8') : NULL ;;
			$this->sql = "INSERT INTO siniestros (
				id,
				aseguradora,
				f_hechos,
				f_entrada,
				f_salida,
				obseraciones,
				solicitud_id,
				estatus
			) VALUES 
			(
				'',
				?,
				?,
				?,
				?,
				?,
				?,
				1
			);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$aseguradora,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$post['f_hechos'],PDO::PARAM_STR);
			$this->stmt->bindParam(3,$post['f_entrada'],PDO::PARAM_STR);
			$this->stmt->bindParam(4,$post['f_salida'],PDO::PARAM_STR);
			$this->stmt->bindParam(5,$observaciones,PDO::PARAM_STR);
			$this->stmt->bindParam(6,$post['solicitud_id'],PDO::PARAM_INT);			
			$this->stmt->execute();

			#Recuperar el ultimo siniestro en el que se dio de alta 
			$this->sql = "SELECT MAX(id) AS ultimo FROM siniestros";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->execute();
			$ultimo = $this->stmt->fetch(PDO::FETCH_OBJ);

			#Insertar a los tecnicos
			$this->sql = "INSERT INTO personal_tecnico (id,nombre,siniestro_id) VALUES ('',?,?)";
			$this->stmt = $this->pdo->prepare($this->sql);
			for ($i=0; $i < count($post['tecnico']) ; $i++) { 
				$tecnico = mb_strtoupper($post['tecnico'][$i],'utf-8');
				$this->stmt->bindParam(1,$tecnico,PDO::PARAM_STR);
				$this->stmt->bindParam(2,$ultimo->ultimo,PDO::PARAM_INT);
				$this->stmt->execute();
			}

			return json_encode( array('status'=>'success','message'=>'SINIESTRO ALMACENADO CORRECTAMENTE.') );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	
}
?>