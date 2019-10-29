<?php 
/**
 * Clase Modelo del vehiculo.
 */
include_once 'conection.php';
include_once 'anexgrid.php';
class CarModel extends Conection
{
	public $sql;
	public $stmt;
	public $result;
	

	public function getCars()
	{
		try {
			$anexgrid = new AnexGrid();
			/*Definir el Where*/
			if ( isset($_REQUEST['filtros']) ) {
				$filtros = (object)$_REQUEST['filtros'][0];
				print_r( $filtros );exit;
			}else
			{
				$wh = " 1=1 ";
			}
			
			$this->sql = "SELECT v.*, m.nom AS mar, t.nom AS tip FROM vehiculos AS v
							INNER JOIN marcas AS m ON m.id = v.marca
							INNER JOIN tipos_v AS t ON t.id = v.tipo 
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
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}

	public function getMarcas()
	{
		try {
			$this->sql = "SELECT * FROM marcas";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function getTipos()
	{
		try {
			$this->sql = "SELECT * FROM tipos_v";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function getPlacas($term)
	{
		try {
			$valor = "%".$term."%";
			$this->sql = "
			SELECT
			    id,
			    placas AS value 
			FROM
			    vehiculos
			WHERE
			    placas LIKE :term 
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
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getVehiculo($v)
	{
		try {
			$valor = $v;
			$this->sql = "
			SELECT
			    v.*,
			    m.nom AS marca_name,
			    t.nom AS tipo_name,
			    CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS resguardatario,
			    p.id AS resguardatario_id

			FROM
			    vehiculos AS v
			INNER JOIN tipos_v AS t
			ON
			    t.id = v.tipo
			INNER JOIN marcas AS m
			ON
			    m.id = v.marca
			LEFT JOIN resguardatario AS r
			ON
			    r.vehiculo = v.id
			RIGHT JOIN personal AS p ON p.id= r.persona
			WHERE v.id = :id";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(':id',$valor,PDO::PARAM_STR);
			$this->stmt->execute();
			$this->result = $this->stmt->fetch( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function saveCar($post)
	{
		try {
			$this->sql = "INSERT INTO vehiculos (
				id,
				tipo,
				marca,
				placas,
				n_resguardo,
				color,
				niv,
				n_motor,
				modelo,
				cil,
				estado,
				observaciones
			) VALUES (
				'',
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				'1',
				?
				
			);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['t_veh'],PDO::PARAM_INT);
			$this->stmt->bindParam(2,$post['m_veh'],PDO::PARAM_INT);
			$this->stmt->bindParam(3,$post['placas'],PDO::PARAM_STR);
			$this->stmt->bindParam(4,$post['resguardo'],PDO::PARAM_STR);
			$this->stmt->bindParam(5,$post['color'],PDO::PARAM_STR);
			$this->stmt->bindParam(6,$post['niv'],PDO::PARAM_STR);
			$this->stmt->bindParam(7,$post['n_motor'],PDO::PARAM_STR);
			$this->stmt->bindParam(8,$post['modelo'],PDO::PARAM_STR);
			$this->stmt->bindParam(9,$post['cilindros'],PDO::PARAM_INT);
			$this->stmt->bindParam(10,$post['obs'],PDO::PARAM_STR);
			
			$this->stmt->execute();

			return json_encode( array('status'=>'success','message'=>'SE A GUARDADO EL VEHÍCULO CORRECTAMENTE.' ) );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function saveTipov($post)
	{
		try {
			/*Validar que no exista el criterio*/
			$term = "%".$post['tipo_nvo']."%";
			$this->sql = "SELECT COUNT(*) AS cuenta FROM tipos_v WHERE nom LIKE ?;";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$term,PDO::PARAM_STR);
			$this->stmt->execute();
			$match = $this->stmt->fetch(PDO::FETCH_OBJ);
			$cuenta = (int)$match->cuenta ;
			if ( $cuenta > 0  ) {
				throw new Exception("NO SE PUEDE INSERTAR!\nYA EXISTE UNA OPCIÓN SIMILAR O IGUAL.", 1);
			}else{
				$nom = mb_strtoupper($post['tipo_nvo'],'utf-8');
				$this->sql = "INSERT INTO tipos_v (id,nom) VALUES ('',?);";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$nom,PDO::PARAM_STR);
				$this->stmt->execute();
				return json_encode( array('status'=>'success','message'=>'EL TIPO DE VEHÍCULO SE A INSERTADO CON ÉXITO.') );
			}
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function saveMarcav($post)
	{
		try {
			/*Validar que no exista el criterio*/
			$term = "%".$post['marca_nvo']."%";
			$this->sql = "SELECT COUNT(*) AS cuenta FROM marcas WHERE nom LIKE ?;";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$term,PDO::PARAM_STR);
			$this->stmt->execute();
			$match = $this->stmt->fetch(PDO::FETCH_OBJ);
			$cuenta = (int)$match->cuenta ;

			if ( $cuenta > 0 ) {
				throw new Exception("NO SE PUEDE INSERTAR!\nYA EXISTE UNA OPCIÓN SIMILAR O IGUAL.", 1);
			}else{
				$nom = mb_strtoupper($post['marca_nvo'],'utf-8');
				$this->sql = "INSERT INTO marcas (id,nom) VALUES ('',?);";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$nom,PDO::PARAM_STR);
				$this->stmt->execute();
				return json_encode( array('status'=>'success','message'=>'LA MARCA DE VEHÍCULO SE A INSERTADO CON ÉXITO.') );
			}
			
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function updateStatus($v)
	{
		try {
			$this->sql = "UPDATE vehiculos SET ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
}
?>