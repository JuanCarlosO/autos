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
			$edo 		= $post['estado'] ;
			$this->sql = "INSERT INTO talleres (id,r_social,contacto,telefono,correo,domicilio,estado) VALUES ('',?,?,?,?,?,?);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$razon,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$contacto,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$tel,PDO::PARAM_STR);
			$this->stmt->bindParam(4,$email,PDO::PARAM_STR);
			$this->stmt->bindParam(5,$dir,PDO::PARAM_STR);
			$this->stmt->bindParam(6,$edo,PDO::PARAM_STR);
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
			$edo 		= $post['estado'] ;

			$this->sql = "UPDATE talleres SET r_social=?,contacto = ?,telefono = ?, correo = ? , domicilio = ? , estado = ? WHERE id = ?;";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$razon,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$contacto,PDO::PARAM_STR);
			$this->stmt->bindParam(3,$tel,PDO::PARAM_STR);
			$this->stmt->bindParam(4,$email,PDO::PARAM_STR);
			$this->stmt->bindParam(5,$dir,PDO::PARAM_STR);
			$this->stmt->bindParam(6,$edo,PDO::PARAM_INT);
			$this->stmt->bindParam(7,$id,PDO::PARAM_INT);
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
			$this->sql = "SELECT COUNT(*) AS cuenta FROM talleres WHERE".$wh."";
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
			$this->sql = "UPDATE  talleres SET estado = 2 WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$t,PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=>'EL TALLER SE HA DADO DE BAJA CORRECTAMENTE.' ) );
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
				/* Si es que hay filtro, tenemos que crear un WHERE dinámico */
			   $wh = "v.id > 0";

			   foreach($anexgrid->filtros as $f)
			   {
			       $wh .= " AND ".$f['columna'] ." LIKE '%". $f['valor'] . "%'";
			   }
				
				
			}else
			{
				$wh = " 1=1 ";
			}
			
			$this->sql = "
			SELECT s.*,m.nom AS marca,t.nom AS tipo, v.placas, v.modelo, v.niv, CONCAT(p.nombre, ' ', p.ap_pat,' ',p.ap_mat) AS full_name FROM solicitudes AS s
			INNER JOIN vehiculos AS v ON v.id = s.vehiculo
			LEFT JOIN personal AS p ON p.id = s.solicitante
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
			LEFT JOIN personal AS p ON p.id = s.solicitante
			INNER JOIN tipos_v AS t ON t.id = v.tipo
			INNER JOIN marcas AS m ON m.id = v.marca WHERE $wh";
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
			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			$aseguradora 	= mb_strtoupper($post['name_aseguradora'],'utf-8');
			$observaciones =(isset($post['observaciones'])) ? mb_strtoupper($post['observaciones'],'utf-8') : NULL ;
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
			}
			else
			{
				if ( $type != 'application/pdf' ) 
				{
					throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "INSERT INTO siniestros (
						id,
						aseguradora,
						f_hechos,
						f_entrada,
						f_salida,
						observaciones,
						solicitud_id,
						estatus,
						archivo
					) VALUES 
					(
						'',
						?,
						?,
						?,
						?,
						?,
						?,
						1,
						'".$content."'
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
					$ultimo = $this->pdo->lastInsertId();
					#Insertar a los tecnicos
					$this->sql = "INSERT INTO personal_tecnico (id,nombre,siniestro_id) VALUES ('',?,?)";
					$this->stmt = $this->pdo->prepare($this->sql);
					for ($i=0; $i < count($post['tecnico']) ; $i++) { 
						$tecnico = mb_strtoupper($post['tecnico'][$i],'utf-8');
						$this->stmt->bindParam(1,$tecnico,PDO::PARAM_STR);
						$this->stmt->bindParam(2,$ultimo,PDO::PARAM_INT);
						$this->stmt->execute();
					}
					unlink($destiny.$name);
					return json_encode( array('status'=>'success','message'=>'SINIESTRO ALMACENADO CORRECTAMENTE.') );
				}
			}

			
			
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	/*Recuperar toda la info de una solicitud*/
	public function getDetalleSol($sol)
	{
		try {

			$detalle = array();		
			$this->sql = "
				SELECT s.*,CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS name_sol, a.nombre AS area FROM solicitudes AS s
				INNER JOIN personal AS p ON p.id = s.solicitante
				INNER JOIN area AS a ON a.id = p.area_id
				WHERE s.id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($sol));
			$solicitud = $this->stmt->fetch(PDO::FETCH_OBJ);
			$auto = $solicitud->vehiculo;

			#recuperar los datos del vehiculo
			$this->sql = "
				SELECT v.*,CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS name_reguardatario 
				FROM vehiculos AS v
				INNER JOIN personal AS p ON p.id=v.resguardatario
				WHERE v.id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($auto));
			$vehiculo = $this->stmt->fetch(PDO::FETCH_ASSOC);
			
			#recupera las reparaciones 
			$this->sql = "
				SELECT UPPER(c.nombre) AS falla, t.r_social AS taller 
				FROM reparaciones AS r 
				INNER JOIN catalogo_fallas AS c ON c.id = r.falla 
				INNER JOIN talleres AS t ON t.id = r.taller 
				WHERE r.solicitud = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($sol));
			$reparaciones = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

			#RECUPERAR INFO DE LA SOLICITUD ATENDIDA
			$this->sql = "
				SELECT *
				FROM ingreso_taller
				WHERE solicitud = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($sol));
			$atendidas = $this->stmt->fetch(PDO::FETCH_ASSOC);
			#Recuperar info de las entregas de vehiculos
			$this->sql = "
				SELECT *
				FROM entrega_vehiculos
				WHERE ingreso = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($atendidas['id']));
			$cuenta_ev = $this->stmt->rowCount();
			$e_vehiculo = $this->stmt->fetch(PDO::FETCH_ASSOC);

			#RECUPERAR LOS SINIESTROS 
			$this->sql = "
				SELECT id, aseguradora, f_hechos, f_entrada, f_salida, observaciones, solicitud_id, estatus
				FROM siniestros
				WHERE solicitud_id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($sol));
			$siniestros = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

			if ( isset($solicitud) && !empty($solicitud) ) {
				$detalle['solicitud'] 	= $solicitud;
			}else{
				$solicitud = array('estado'=>'empty','message'=>'Sin atender');
				$detalle['solicitud'] 	= $solicitud;
			}
			if ( isset($vehiculo) && !empty($vehiculo) ) {
				$detalle['vehiculo'] 	= $vehiculo;
			}else{
				$vehiculo = array('estado'=>'empty','message'=>'Sin atender');
				$detalle['vehiculo'] 	= $vehiculo;
			}
			
			if ( isset($atendidas) && !empty($atendidas) ) {
				$detalle['atendida'] = $atendidas;
			}else{
				$atendidas = array('estado'=>'empty','message'=>'Sin atender');
				$detalle['atendida'] = $atendidas;
			}

			if ( $cuenta_ev > 0  ) {
				$detalle['e_vehiculo'] = $e_vehiculo;
			}else{
				$e_vehiculo = array('estado'=>'empty','message'=>'Sin atender');
				$detalle['e_vehiculo'] = $e_vehiculo;
			}

			if ( isset($siniestros) && !empty($siniestros) ) {
				$detalle['siniestro'] = $siniestros;
			}else{
				$siniestros = array('estado'=>'empty','message'=>'Sin siniestros');
				$detalle['siniestro'] = $siniestros;
			}
			for ($i=0; $i < count($reparaciones) ; $i++) { 
				$detalle['reparaciones'][$i] = $reparaciones[$i];
			}
			#Agregar las garantias 
			$this->sql = "
				SELECT *
				FROM garantias
				WHERE solicitud = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($sol));
			$garantias = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			if ( isset($garantias) && !empty($garantias) ) {
				$detalle['garantias'] = $garantias;
			}else{
				$garantias = array('estado'=>'empty','message'=>'Sin garantias');
				$detalle['garantias'] = $garantias;
			}
			#Agregar las entregas del taller 
			
			return json_encode($detalle);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}

	/*Guardar el siniestro*/
	public function saveAtencion($post)
	{
		try {
			
			$obs = ( isset($post['observaciones']) ) ? mb_strtoupper($post['observaciones'],'utf-8') : NULL ;
			$this->sql = "
			INSERT INTO solicitudes_atendidas (id,solicitud,entrada_taller,salida_taller,entrada_uai,observaciones) 
			VALUES ('',?,?,?,?,?);
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['solicitud_id'],PDO::PARAM_INT);
			$this->stmt->bindParam(2,$post['f_entrada'],PDO::PARAM_STR);
			$this->stmt->bindParam(3,$post['f_salida'],PDO::PARAM_STR);
			$this->stmt->bindParam(4,$post['entrada_uai'],PDO::PARAM_STR);
			$this->stmt->bindParam(5,$obs,PDO::PARAM_STR);
			$this->stmt->execute();
			#Actualizar el estatus en la tabla de solicitudes
			$this->sql = "
			UPDATE solicitudes SET estado = 2 WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['solicitud_id'],PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=>'SE ATENDIO CORRECTAMENTE LA SOLICITUD.') );

		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	/*recuperar los tipos de fallas */
	public function getTipoFalla()
	{
		try {
			$this->sql = "
			SELECT id,UPPER(nombre) AS nombre FROM tipo_fallas 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}

	/*recuperar el catalogo_fallas*/
	public function getFallas($t)
	{
		try {
			$this->sql = "
			SELECT id, UPPER(nombre) AS nombre FROM catalogo_fallas WHERE tipo_id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$t);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			/*Carga de anexGrid*/
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}
	/*recuperar talleres*/
	public function getListTalleres()
	{
		try {
			$this->sql = "
			SELECT id,r_social AS nombre FROM talleres 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			/*Carga de anexGrid*/
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}

	public function saveReparacion($post)
	{
		try {
			$solicitud 	= $post['solicitud_id'];
			$falla 		= $post['falla'];
			$taller 	= $post['taller'];
			
			$this->sql = "
			INSERT INTO reparaciones (id,falla,solicitud,taller) 
			VALUES ('',?,?,?);
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$falla,PDO::PARAM_INT);
			$this->stmt->bindParam(2,$solicitud,PDO::PARAM_INT);
			$this->stmt->bindParam(3,$taller,PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode( array('status'=>'success','message'=>'REPARACIÓN AGREGADA CORRECTAMENTE.') );

		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function saveFallas($post)
	{
		try {
			$this->sql = "
			INSERT INTO tipo_fallas (id,nombre) VALUES ('',?);
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['tipo_falla'],PDO::PARAM_STR);
			$this->stmt->execute();
			#Recuperar el ID del Tipo de falla nuevo 
			$falla = "%".$post['tipo_falla']."%";
			$this->sql = "SELECT id FROM tipo_fallas WHERE nombre LIKE ? ;";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$falla,PDO::PARAM_STR);
			$this->stmt->execute();
			$falla = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			#Insertar las fallas
			$this->sql = "INSERT INTO catalogo_fallas (id,nombre,tipo_id) VALUES ('',?,?); ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			for ($i=0; $i < count($post['fallas']) ; $i++) { 
				$this->stmt->bindParam(1,$post['fallas'][$i],PDO::PARAM_STR);
				$this->stmt->bindParam(2,$falla->id,PDO::PARAM_STR);
				$this->stmt->execute();
			}

			return json_encode( array('status'=>'success','message'=>'EL GRUPO DE FALLA Y SUS FALLAS HAN SIDO AGREGADOS EXITOSAMENTE.') );

		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage()) );
		}
	}
	public function saveIngreso($post)
	{
		try {
			$obs 		= mb_strtoupper($post['observaciones'],'utf-8');
			$p_recibe 	= mb_strtoupper($post['p_recibe'],'utf-8');
			$this->sql = "UPDATE solicitudes SET estado = 1 WHERE id = ?;";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['solicitud_id'],PDO::PARAM_INT);
			$this->stmt->execute();

			$this->sql = "INSERT INTO ingreso_taller (id, solicitud, taller, f_ingreso, h_ingreso, p_recibe, observaciones) VALUES 
			(
				'', 
				?,
				?,
				?,
				?,
				?,
				?
			)";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['solicitud_id'],PDO::PARAM_INT);
			$this->stmt->bindParam(2,$post['ingreso_taller'],PDO::PARAM_INT);
			$this->stmt->bindParam(3,$post['f_ingreso'],PDO::PARAM_STR);
			$this->stmt->bindParam(4,$post['h_ingreso'],PDO::PARAM_STR);
			$this->stmt->bindParam(5,$p_recibe,PDO::PARAM_STR);
			$this->stmt->bindParam(6,$obs,PDO::PARAM_STR);
			$this->stmt->execute();
			return json_encode(array('status'=>'success','message'=> 'SE INGRESÓ EL VEHÍCULO AL TALLER CORRECTAMENTE. ' ));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function saveSalida($post)
	{
		try {
			$solicitud_id = ( isset( $_POST['solicitud_id'] ) ) ? $_POST['solicitud_id'] : 0; 
			if ( $solicitud_id == 0  ) {
				throw new Exception("NO SE RECUPERO LA SOLICITUD. \nNOTIFIQUE ESTO AL ÁREA DE SISTEMAS.", 1);
			}
			$this->sql  = " SELECT id FROM ingreso_taller WHERE solicitud = ? ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$solicitud_id,PDO::PARAM_STR);
			$this->stmt->execute();
			$ingreso = $this->stmt->fetch(PDO::FETCH_OBJ);

			#Recuperar las observaciones antes escritas.
			$this->sql = "SELECT observaciones FROM ingreso_taller WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute( array( $ingreso->id ) );
			$o = $this->stmt->fetch( PDO::FETCH_OBJ ); 
			$obs = "";
			$obs .= "AL INGRESO DEL TALLER: ".$o->observaciones."<br>";
			
			$obs 		.= "AL SALIR DEL TALLER:".mb_strtoupper($post['observaciones'],'utf-8');
			$p_entrega 	= mb_strtoupper($post['p_entrega'],'utf-8');
			$this->sql = "
			UPDATE ingreso_taller SET f_salida = ?, h_salida= ? , p_entrega = ? , estado = 1, observaciones = ? WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$post['f_salida'],PDO::PARAM_STR);
			$this->stmt->bindParam(2,$post['h_salida'],PDO::PARAM_STR);
			$this->stmt->bindParam(3,$p_entrega,PDO::PARAM_STR);
			$this->stmt->bindParam(4,$obs,PDO::PARAM_STR);
			$this->stmt->bindParam(5,$post['ingreso_id'],PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode(array('status'=>'success','message'=> 'SE A GENERADO LA SALIDA DEL TALLER DE MANERA EXITOSA.' ));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function saveEvent($post)
	{
		try {
			#Poner en mayusculas titulo y comentarios
			$titulo = (isset($post['title'])) ? mb_strtoupper($post['title'],'utf-8') : 'SIN TÍTULO' ;
			$comentario = (isset($post['comentario'])) ? mb_strtoupper($post['comentario'],'utf-8') : 'SIN TÍTULO' ;
			$this->sql = "INSERT INTO eventos (id, titulo, fecha, comentarios, tipo_evento) VALUES ('',?,?,?,?);";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$titulo,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$post['fecha'],PDO::PARAM_STR);
			$this->stmt->bindParam(3,$comentario,PDO::PARAM_STR);
			$this->stmt->bindParam(4,$post['t_evento'],PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode(array('status'=>'success','message'=>'EVENTO ALMACENADO.' ));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getEvents()
	{
		try {
			$this->sql = "SELECT * FROM eventos";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$eventos = $this->stmt->fetchAll( PDO::FETCH_OBJ ); 
			return json_encode( $eventos );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function entregaAuto($s)
	{
		try {
			$this->sql = "UPDATE ingreso_taller SET estado = 2 WHERE solicitud = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($s));
			return json_encode(array('status'=>'error','message'=>'EL ESTADO DE LA REPARACIÓN CAMBIO A:  ENTREGADO AL RESGUARDATARIO'));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function saveCotizacion()
	{
		try {
			#Validar que la reparacion no sea mayor al 30% del vehiculo
			$cv =(int) $_POST['costo_veh'];
			$cc =(int) $_POST['costo'];
			$limite = (($cv * 35 )/100);
			if ( $cc > $limite ) {
				throw new Exception("EL COSTO DE LA REPARACIÓN EXCEDE EL 35%", 1);
			}
			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
			}
			else
			{
				if ( $type != 'application/pdf' ) 
				{
					throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "
					INSERT INTO 
					cotizaciones 
						(id, solicitud, fecha, monto, comentario, archivo)
					VALUES 
						('',?, ?, ?, ?, '".$content."');
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$_POST['solicitud_id'],PDO::PARAM_STR);
					$this->stmt->bindParam(2,$_POST['fecha'],PDO::PARAM_STR);
					$this->stmt->bindParam(3,$_POST['costo'],PDO::PARAM_STR);
					$this->stmt->bindParam(4,$_POST['comentario'],PDO::PARAM_STR);
					//$this->stmt->bindParam(5,$content,PDO::PARAM_LOB);
					$this->stmt->execute();
					unlink($destiny.$name);
					return json_encode(array('status'=>'success','message'=>'SE GUARDO LA COTIZACIÓN EXITOSAMENTE'));
				}
			}			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function saveEntrega()
	{
		try {
			#Rastrear el ID del ingreso al taller
			$solicitud_id = ( isset( $_POST['solicitud_id'] ) ) ? $_POST['solicitud_id'] : 0; 
			if ( $solicitud_id == 0  ) {
				throw new Exception("NO SE RECUPERO LA SOLICITUD. \nNOTIFIQUE ESTO AL ÁREA DE SISTEMAS.", 1);
			}
			$this->sql = "UPDATE ingreso_taller SET estado = 2 WHERE solicitud = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($solicitud_id));

			$this->sql  = " SELECT id FROM ingreso_taller WHERE solicitud = ? LIMIT 1";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$solicitud_id,PDO::PARAM_STR);
			$this->stmt->execute();
			$ingreso = $this->stmt->fetch(PDO::FETCH_OBJ);
			
			$motivo = ( isset($_POST['txt_motivo']) ) ? mb_strtoupper($_POST['txt_motivo']) : NULL ; 
			$this->sql = " INSERT INTO entrega_vehiculos (
				id, 
				fecha, 
				hora, 
				prueba, 
				sp_entrega, 
				sp_recibe, 
				acepta_sp, 
				ingreso, 
				motivo
			) VALUES (
				'',
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?
				
			); ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$_POST['fecha'],PDO::PARAM_STR);
			$this->stmt->bindParam(2,$_POST['hora'],PDO::PARAM_STR);
			$this->stmt->bindParam(3,$_POST['test'],PDO::PARAM_INT);
			$this->stmt->bindParam(4,$_POST['spe_id'],PDO::PARAM_INT);
			$this->stmt->bindParam(5,$_POST['spr_id'],PDO::PARAM_INT);
			$this->stmt->bindParam(6,$_POST['s_aceptacion'],PDO::PARAM_INT);
			$this->stmt->bindParam(7,$ingreso->id,PDO::PARAM_INT);
			$this->stmt->bindParam(8,$motivo,PDO::PARAM_LOB);
			$this->stmt->execute();
			return json_encode(array('status'=>'success','message'=>'SE ENTREGO EL VEHÍCULO CORRECTAMENTE.'));			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function saveBaja()
	{
		try {
			$motivo 	= ( isset($_POST['motivo']) ) ? mb_strtoupper($_POST['motivo']) : '' ;
			$vehiculo 	= ( isset($_POST['vehiculo_id']) ) ? (int)$_POST['vehiculo_id'] : 0 ;
			$causa 		= ( isset($_POST['causa']) ) ? (int)$_POST['causa'] : 0 ;
			if ( $vehiculo == 0 ) {
				throw new Exception("NO SE INDENTIFCO EL VEHICULO QUE DESEA DAR DE BAJA.", 1);
			}
			if ( empty($motivo) ) {
				throw new Exception("SE CONSIDERA INDISPENSABLE UNA RAZÓN DEL PORQUE EL BIEN SERÁ DADO DE BAJA.", 1);
			}
			/*INSERTAR LA INFO DE LA TABLA DE baja_vehiculos*/
			$this->sql 	= "INSERT INTO baja_vehiculos (id,motivo,vehiculo,causa) VALUES ('',?,?,?);";
			$this->stmt = $this->pdo->prepare($this->sql);
			
			$this->stmt->bindParam(1,$motivo,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$vehiculo,PDO::PARAM_INT);
			$this->stmt->bindParam(3,$causa,PDO::PARAM_INT);
			$this->stmt->execute();
			#RECUPERAR EL ID DEL ULTIMO REGISTRO GUARDADO 
			$ultimo = $this->pdo->lastInsertId();
			#PONER EN ESTATUS DE BAJA EL VEHICULO
			$this->sql 	= "UPDATE vehiculos SET estado = 3 WHERE id = ? ";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$vehiculo,PDO::PARAM_INT);
			$this->stmt->execute();
			#####################################
			if ( empty($ultimo) ) {
				throw new Exception("NO SE PUDO DAR DE BAJA AL VEHÍCULO. ", 1);
			}
			
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			for ($i=0; $i < count($_FILES['archivo']['name']) ; $i++) { 
				$size = $_FILES['archivo']['size'][$i];
				$type = $_FILES['archivo']['type'][$i];
				$name = $_FILES['archivo']['name'][$i];
				$t_doc = $_POST['t_doc'][$i];
				#NOMENCATURA PARA EL NOMBRE DEL DOCUMENTO QUE SE ALAMCENA 
				#t_doc+$ultimo+fecha
				$aux = "";
				if ( $t_doc == 1 ) {
					$aux = "ACTA_BAJA";
				}else if ( $t_doc == 2 ){
					$aux = "DOCUMENTO_SINIESTRO";
				}else{
					$aux = "DICTAMEN_TALLER";
				}
				$name_doc = $aux."_".$ultimo."_".date('Y')."_".date('m')."_".date('d');
				if ( $size > 10485760 ) 
				{
					throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
				}
				else
				{
					if ( $type != 'application/pdf' ) 
					{
						throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
					}
					else
					{
						#convertir a bytes
						move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$destiny.$name);
						$file = fopen($destiny.$name,'r');
						$content = fread($file,$size);
						$content = addslashes($content);
						fclose($file);
						#Insertar en la BD
						$this->sql = "
						INSERT INTO 
						baja_documentos 
							(id, baja, tipo, nombre	, archivo)
						VALUES 
							('', ?, ?, ?, '".$content."');
						";
						$this->stmt = $this->pdo->prepare( $this->sql );
						$this->stmt->bindParam(1,$ultimo,PDO::PARAM_INT);
						$this->stmt->bindParam(2,$t_doc,PDO::PARAM_INT);
						$this->stmt->bindParam(3,$name_doc,PDO::PARAM_STR);
						//$this->stmt->bindParam(4,$content,PDO::PARAM_LOB);
						$this->stmt->execute();
						unlink($destiny.$name);
						
					}
				}
			}
			return json_encode(array('status'=>'success','message'=>'SE A DADO DE BAJA EL VEHÍCULO DE MANERA EXITOSA.'));		
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function saveSolHistorica()
	{
		try {
			#print_r( $_POST['t_doc'] );exit;
			#print_r($_POST['tipo_doc'][0]);exit;
			$folio 		= $_POST['folio'];
			$placa 		= $_POST['auto'];
			$falla 		= $_POST['falla_h'];
			$compuesto 	= "";
			$compuesto .= "Fecha de la reparación: ".$_POST['fecha'].PHP_EOL;
			
			#Buscar el ID del vehículo 
			$this->sql = "SELECT id FROM vehiculos WHERE placas LIKE '%".$placa."%'";
			$this->stmt = $this->pdo->prepare( $this->sql ) ;
			$this->stmt->execute();
			$auto = $this->stmt->fetch( PDO::FETCH_OBJ );
			if ( empty( $auto->id ) ) {
				throw new Exception("NO SE ENCONTRO LA PLACA DEL VEHÍCULO, INTENTE DE NUEVO.", 1);
			}
			
			$vehiculo = $auto->id;
			#recuperar el texto de la falla
			$this->sql = "SELECT nombre FROM catalogo_fallas WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql ) ;
			$this->stmt->bindParam(1,$falla , PDO::PARAM_STR);
			$this->stmt->execute();
			$falla = $this->stmt->fetch( PDO::FETCH_OBJ );
			if ( empty( $falla->nombre ) ) {
				throw new Exception("NO SE ENCONTRO LA FALLA SELECCIONADA.", 1);
			}
			$compuesto .= 'La falla que se presento fue: '.$falla->nombre.PHP_EOL;
			$compuesto .= 'El costo de la reparación fue: '.$_POST['costo'].PHP_EOL;
			$compuesto .= 'Observaciones: '.$_POST['obs'].PHP_EOL;
			
			/*INSERTAR solicitud historica*/
			$this->sql 	= "INSERT INTO solicitudes (id, folio, f_sol, km, solicitante, vehiculo, estado, descripcion ) VALUES ('', ?, ?, NULL, NULL, ?, 3, ? );";
			$this->stmt = $this->pdo->prepare($this->sql);
			$this->stmt->bindParam(1,$folio,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$_POST['fecha'],PDO::PARAM_STR);
			$this->stmt->bindParam(3,$vehiculo,PDO::PARAM_INT);
			$this->stmt->bindParam(4,$compuesto,PDO::PARAM_STR);
			$this->stmt->execute();
			$ultima = $this->pdo->lastInsertId();
			
			#Insertar los documentos 
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			for ($i=0; $i < count($_FILES['archivo']['name']) ; $i++) { 
				$size 	= $_FILES['archivo']['size'][$i];
				$type 	= $_FILES['archivo']['type'][$i];
				$name 	= $_FILES['archivo']['name'][$i];
				$t_doc 	= $_POST['tipo_doc'][$i];
							
				if ( $size > 10485760 ) 
				{
					throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
				}
				else
				{
					if ( $type != 'application/pdf' ) 
					{
						throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
					}
					else
					{
						#convertir a bytes
						move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$destiny.$name);
						$file = fopen($destiny.$name,'r');
						$content = fread($file,$size);
						$content = addslashes($content);
						fclose($file);
						#Insertar en la BD
						$this->sql = "
						INSERT INTO 
						solicitud_documentos 
							(id, solicitud, tipo_doc,formato, archivo)
						VALUES 
							('', ?, ?, ?, '".$content."');
						";
						$this->stmt = $this->pdo->prepare( $this->sql );
						$this->stmt->bindParam(1,$ultima,PDO::PARAM_INT);
						$this->stmt->bindParam(2,$t_doc,PDO::PARAM_INT);
						$this->stmt->bindParam(3,$type,PDO::PARAM_STR);
						//$this->stmt->bindParam(4,$content,PDO::PARAM_LOB);
						$this->stmt->execute();
						unlink($destiny.$name);
						
					}
				}
			}
			return json_encode(array('status'=>'success','message'=>'SE AGREGO UNA SOLICITUD HISTORICA DE MANERA EXITOSA.'));		
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function getTiposDoc()
	{
		try {
			$this->sql = "SELECT * FROM t_doc";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	public function saveChofer()
	{
		try {
			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			$f_exp = ( isset($_POST['f_exp']) ) ? $_POST['f_exp'] : NULL;
			$f_ven = ( isset($_POST['f_ven']) ) ? $_POST['f_ven'] : NULL;
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
			}
			else
			{
				if ( $type != 'application/pdf' ) 
				{
					
					throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "
					INSERT INTO 
					licencias 
						(id, persona, f_expedicion, f_vencimiento, tipo, numero, archivo,vigencia)
					VALUES 
						('',?, ?, ?, ?, ?, '".$content."',?);
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$_POST['sp_id'],PDO::PARAM_INT);
					$this->stmt->bindParam(2,$f_exp,PDO::PARAM_STR);
					$this->stmt->bindParam(3,$f_ven,PDO::PARAM_STR);
					$this->stmt->bindParam(4,$_POST['tipo'],PDO::PARAM_INT);
					$this->stmt->bindParam(5,$_POST['num_lic'],PDO::PARAM_STR);
					$this->stmt->bindParam(6,$_POST['vigencia'],PDO::PARAM_INT);
					//$this->stmt->bindParam(6,$content,PDO::PARAM_LOB);
					$this->stmt->execute();
					unlink($destiny.$name);
					return json_encode(array('status'=>'success','message'=>'SE GUARDO EL CONDUCTOR EXITOSAMENTE'));
				}
			}
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage()));
		}
	}
	/*Listar las solicitudes*/
	public function getChoferes()
	{
		try {
			$anexgrid = new AnexGrid();
			/*Definir el Where*/
			$wh = "1=1";
			$folio = "";
			if ( count($anexgrid->filtros) >= 1 ) {
					#$wh .= $v->columna." LIKE '%".$v->valor."%'";
				foreach ($anexgrid->filtros as $key => $v) {
					if ( $v['columna'] == 'chofer' ) {
						$wh .= " AND CONCAT( p.nombre,' ',p.ap_pat,' ',p.ap_mat ) LIKE '%".$v['valor']."%' ";
					}elseif( $v['columna'] == 'estado' ){
						if ( $v['valor'] == 2 ) {//A punto de expirar 
							$wh .= " AND DATEDIFF( l.f_vencimiento,DATE(NOW()) ) > 0 AND DATEDIFF( l.f_vencimiento,DATE(NOW()) ) <= 15";
						}elseif( $v['valor'] == 3 ){//Vencidas
							$wh .= " AND DATEDIFF( l.f_vencimiento,DATE(NOW()) ) = 0";
						}
					}else{
						$wh .= " AND ".$v['columna']." LIKE '%".$v['valor']."%' ";
					}
					
				}
			}
			$this->sql = "
				SELECT CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS chofer, a.nombre AS area, 
					l.id,l.persona,l.f_expedicion,l.f_vencimiento,l.tipo,l.numero,
					IF ( l.f_vencimiento <= DATE(NOW()),'VENCIDA','ACTIVA' ) AS estado,
					DATEDIFF( l.f_vencimiento,DATE(NOW()) ) AS diferencia, p.id AS sp_id
				FROM licencias AS l
				INNER JOIN personal AS p ON p.id = l.persona 
				INNER JOIN area AS a ON a.id = p.area_id
				WHERE $wh
				 ORDER BY $anexgrid->columna $anexgrid->columna_orden
            			LIMIT $anexgrid->pagina, $anexgrid->limite
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$modulos = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			//print_r($modulos);exit;
			$this->sql = "SELECT COUNT(*) AS cuenta FROM licencias AS l
				INNER JOIN personal AS p ON p.id = l.persona 
				INNER JOIN area AS a ON a.id = p.area_id
				WHERE $wh";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$cuenta = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			/*Carga de anexGrid*/
			return $anexgrid->responde($modulos, $cuenta);
		} catch (Exception $e) {
			return json_encode( array('status'=>'error','message'=>$e->getMessage() ) );
		}
	}
	
	public function saveSolicitud($f_sol,$km,$solicitante,$resguardatario,$placa,$desc,$folio)
	{
		try {
			$desc = mb_strtoupper($desc,'utf-8');
			#VALIDAR QUE NO TENGA LA LICENCIA VENCIDA
			/*$this->sql = "SELECT IF( f_vencimiento <= DATE(NOW()),'denegado','permitido') AS permiso FROM licencias WHERE persona = ? ";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$solicitante,PDO::PARAM_INT);
			$this->stmt->execute();
			$permiso = $this->stmt->fetch(PDO::FETCH_OBJ);

			if (  !empty($permiso->permiso) AND $permiso->permiso == 'denegado' ) {
				throw new Exception("LICENCIA DE CONDUCIR VENCIDA. DEBE RENOVAR SU LICENCIA DE CONDUCIR PARA PODER GENERAR SOLICITUDES.", 1);
			}else if( empty($permiso) || !isset($permiso) ){
				throw new Exception("AÚN NO CUENTAS CON EL PERMISO DE CONDUCIR UNA UNIDAD OFICIAL.", 1);
			}*/

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
	public function saveEvidencia()
	{
		try {

			$evento = $_POST['evento'];
			for ($i=0; $i < count($_FILES['archivo']['name']); $i++) { 
				$size = $_FILES['archivo']['size'][$i];
				$type = $_FILES['archivo']['type'][$i];
				$name = $_FILES['archivo']['name'][$i];
				$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
				#print_r( $_FILES['archivo']['type'][$i] );exit;
				if ( $size > 10485760 ) 
				{
					throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
				}
				else
				{

					if ( $type != 'application/pdf' AND $type != 'image/png' AND $type != 'image/jpeg' ) 
					{
						throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
					}
					else
					{
						#convertir a bytes
						move_uploaded_file($_FILES['archivo']['tmp_name'][$i],$destiny.$name);
						$file = fopen($destiny.$name,'r');
						$content = fread($file,$size);
						$content = addslashes($content);
						fclose($file);
						#Insertar en la BD
						$this->sql = "
						INSERT INTO eventos_evidencia(id,tipo,archivo,evento) 
						VALUES ('',?,?,?);
						";
						$this->stmt = $this->pdo->prepare( $this->sql );
						$this->stmt->bindParam(1,$type,PDO::PARAM_STR);
						$this->stmt->bindParam(2,$content,PDO::PARAM_LOB);
						$this->stmt->bindParam(3,$evento,PDO::PARAM_INT);
						$this->stmt->execute();
						unlink($destiny.$name);
						return json_encode(array('status'=>'success','message'=>'LA EVIDENCIA SE GUARDO CON ÉXITO.' ));
					}
				}
			}			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getEvidencia()
	{
		try {
			$evidencia = "";
			$evento = $_POST['evento'];
			$this->sql = "
			SELECT * FROM eventos_evidencia WHERE evento = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$evento,PDO::PARAM_STR);
			$this->stmt->execute();			
			$datos_image = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$cuenta = $this->stmt->rowCount();
			if ($cuenta >= 1) {
				foreach ($datos_image as $key => $val) {
					if ( $val->tipo == "image/jpeg" || $val->tipo == "image/png") {
						$evidencia .= '<img class="img-responsive pad" src="data:'.$val->tipo.';base64,'.base64_encode(stripslashes($val->archivo)) .' "/>';
					}else{
						$evidencia.= '<embed src="data:'.$val->tipo.';base64,'.base64_encode(stripslashes($val->archivo)).'" type="'.$val->tipo.'" width="100%" height="600px" />';
					}
				}
				return $evidencia;
			}else{
				return "<h3> NO HAY EVIDENCIA </h3>";
			}
			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}

	public function cancelarSolicitud()
	{
		try {
			$evidencia = $_POST['observaciones'];
			$solicitud = $_POST['solicitud_id'];
			$fecha = $_POST['fecha'];

			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
			}
			else
			{
				if ( $type != 'application/pdf' ) 
				{
					throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					
					$this->sql = "
					UPDATE solicitudes SET estado = 4 WHERE id = ?
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$solicitud,PDO::PARAM_INT);
					$this->stmt->execute();			
					
					$this->sql = "
					INSERT INTO cancelaciones (id,solicitud,fecha,observaciones,archivo)
					VALUES 
					('',?,?,?,'".$content."');";

					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$solicitud,PDO::PARAM_INT);
					$this->stmt->bindParam(2,$fecha,PDO::PARAM_STR);
					$this->stmt->bindParam(3,$evidencia,PDO::PARAM_STR);
					$this->stmt->execute();	

					unlink($destiny.$name);
					return json_encode(array('status'=>'success','message'=>'SOLICITUD CANCELADA DE MANERA EXITOSA' ));
				}
			}
			#-------------------------------------------------------------------------------------------
			
			
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function savePDFSolicitud()
	{
		try {
			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
			}
			else
			{
				if ( $type != 'application/pdf' AND $type != 'image/png' AND $type != 'image/jpeg' ) 
				{
					throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "
					INSERT INTO solicitud_documentos(id,solicitud,tipo_doc,formato,archivo) 
					VALUES ('',?,?,?,'".$content."');
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$_POST['solicitud_id'],PDO::PARAM_STR);
					$this->stmt->bindParam(2,$_POST['t_sol'],PDO::PARAM_LOB);
					$this->stmt->bindParam(3,$type,PDO::PARAM_STR);
					//$this->stmt->bindParam(4,$content,PDO::PARAM_INT);
					$this->stmt->execute();
					unlink($destiny.$name);
					return json_encode(array('status'=>'success','message'=>'LA EVIDENCIA SE GUARDO CON ÉXITO.' ));
				}
			}
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function finalizarGarantia()
	{
		try {
			#finalizar en la BD
			$this->sql = "
			UPDATE garantias SET f_salida = DATE(NOW()) WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$_POST['id'],PDO::PARAM_INT);
			$this->stmt->execute();
			return json_encode(array('status'=>'success','message'=>'LA GARANTIA FINALIZÓ CON ÉXITO.' ));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function saveGarantia()
	{
		try {
			$o = mb_strtoupper($_POST['observaciones'],'utf-8');
			$this->sql = "
			INSERT INTO garantias(id, solicitud, f_entrada, f_salida, observaciones) 
			VALUES 
			(
				'',
				?,
				?,
				NULL,
				?
			)
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$_POST['solicitud_id'],PDO::PARAM_INT);
			$this->stmt->bindParam(2,$_POST['f_entrada'],PDO::PARAM_STR);
			$this->stmt->bindParam(3,$o,PDO::PARAM_STR);
			$this->stmt->execute();
			return json_encode(array('status'=>'success','message'=>'LA GARANTIA SE CREÓ CON ÉXITO.' ));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function generalDocumentacion()
	{
		try {
			$auto = $_POST['placa_h'];

			$resultados = array();
			$this->sql = "
				SELECT COUNT(*) AS cuenta FROM vehiculo_documentos WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();
			$docs = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta; 
			if ( !empty($docs) ) {
				$resultados['docs'] = $docs;
			}else{
				$resultados['docs'] = '0';
			}

			$this->sql = "
			SELECT COUNT(*) AS cuenta FROM asegurados WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();
			$polizas = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta; 			
			if ( !empty($polizas) ) {
				$resultados['polizas'] = $polizas;
			}else{
				$resultados['polizas'] = '0';
			}
			$this->sql = "
				SELECT id FROM baja_vehiculos WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();

			$ids_res =  $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$ids = array();
			foreach ($ids_res as $key => $val) {# code...
				array_push($ids, $val->id);
			}				
			$ids = implode(',',$ids);
			if ( !empty($ids) ) {
				$this->sql = "
					SELECT COUNT(*) AS cuenta FROM baja_documentos WHERE baja IN (".$ids.") 
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$bajas = $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta; 
				if ( !empty($bajas) ) {
					$resultados['bajas'] = $bajas;
				}else{
					$resultados['bajas'] = '0';
				}
			}else{
				$resultados['bajas'] = '0';
			}
#******************************************************************************************************
			$this->sql = "
				SELECT id FROM solicitudes WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();

			$ids_res =  $this->stmt->fetchAll(PDO::FETCH_OBJ);

			$ids = array();
			foreach ($ids_res as $key => $val) {# code...
				array_push($ids, $val->id);
			}				
			$ids = implode(',',$ids);
			if (!empty($ids)) {
				$this->sql = "
					SELECT COUNT(*) AS cuenta FROM cotizaciones WHERE solicitud IN (".$ids.") 
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$resultados['cotizaciones'] =  $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			}else{
				$resultados['cotizaciones'] =  '0';
			}
			#----------------------------------------------------------------------------------------------
			if (!empty($ids)) {
				$this->sql = "
					SELECT COUNT(*) AS cuenta FROM solicitud_documentos WHERE solicitud IN (".$ids.") 
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$resultados['docs_solicitudes'] =  $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			}else{
				$resultados['docs_solicitudes'] =  '0';
			}	
			#----------------------------------------------------------------------------------------------
			if (!empty($ids)) {
				$this->sql = "
					SELECT COUNT(*) AS cuenta FROM siniestros WHERE solicitud_id IN (".$ids.") 
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->execute();
				$resultados['siniestros'] =  $this->stmt->fetch(PDO::FETCH_OBJ)->cuenta;
			}else{
				$resultados['siniestros'] =  '0';
			}			
			return json_encode( $resultados );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getDocumentos()
	{
		try {
			$auto = $_POST['placa'];
			$doc = "";
			$this->sql = "
			SELECT * FROM vehiculo_documentos WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			#$vueltas = $this->stmt->columnCount();
			foreach ($this->result as $key => $value) {
				$doc .= "<div class='row'>";
					$doc .= "<div class='col-md-12'>";
						$doc .= '<object data="data:application/pdf;base64,'.base64_encode($value->archivo).'" type="application/pdf" style="height:500px;width:100%"></object>';
					$doc .= "</div>";
				$doc .= "</div>";
			}
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getPolizas()
	{
		try {
			$auto = $_POST['placa'];
			$doc = "";
			$this->sql = "
			SELECT * FROM asegurados WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			foreach ($this->result as $key => $value) {
				$doc .= "<div class='row'>";
					$doc .= "<div class='col-md-12'>";
					$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($value->archivo).'" type="application/pdf" width="100%" height="600px" />';
					$doc .= "</div>";
				$doc .= "</div>";
			}
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getBajasDocs()
	{
		try {
			$auto = $_POST['placa'];
			$doc = "";
			$this->sql = "
				SELECT id FROM baja_vehiculos WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();

			$ids_res =  $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$ids = array();
			foreach ($ids_res as $key => $val) {# code...
				array_push($ids, $val->id);
			}				
			$ids = implode(',',$ids);
			
			$this->sql = "
				SELECT * FROM baja_documentos WHERE baja IN (".$ids.") 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			foreach ($this->result as $key => $value) {
				$doc .= "<div class='row'>";
					$doc .= "<div class='col-md-12'>";
					$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($value->archivo).'" type="application/pdf" width="100%" height="600px" />';
					$doc .= "</div>";
				$doc .= "</div>";
			}
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getDocsCotizaciones()
	{
		try {
			$auto = $_POST['placa'];
			$doc = "";
			$this->sql = "
				SELECT id FROM solicitudes WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();

			$ids_res =  $this->stmt->fetchAll(PDO::FETCH_OBJ);
			$ids = array();
			foreach ($ids_res as $key => $val) {# code...
				array_push($ids, $val->id);
			}				
			$ids = implode(',',$ids);
			
			$this->sql = "
				SELECT * FROM cotizaciones WHERE solicitud IN (".$ids.") 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			foreach ($this->result as $key => $value) {
				$doc .= "<div class='row'>";
					$doc .= "<div class='col-md-12'>";
					$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($value->archivo).'" type="application/pdf" width="100%" height="600px" />';
					$doc .= "</div>";
				$doc .= "</div>";
			}
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getCarEspecifico($id)
	{
		try {
			$auto = $_POST['placa'];
			$doc = "";
			$this->sql = "
			SELECT *,m.nom AS 'marca_name', t.nom AS 'tipo_name', CONCAT(p.nombre,' ',p.ap_pat,' ', p.ap_mat) AS name_reguardatario
			FROM vehiculos AS v
			INNER JOIN marcas AS m ON m.id = v.marca
			INNER JOIN tipos_v AS t ON t.id = v.tipo
			INNER JOIN personal AS p ON p.id = v.resguardatario
			WHERE v.id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ); 
						
			return $this->result;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getAseguradoras()
	{
		try {
			
			$this->sql = "
			SELECT * FROM aseguradoras
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function deleteChofer()
	{
		try {
			$id = $_POST['chofer'];
			$this->sql = "DELETE FROM licencias WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$cuenta = $this->stmt->rowCount();
			if ( $cuenta > 0 ) {
				return json_encode(array('status'=>'success','message'=>'CONDUCTOR ELIMINADO EXITOSAMENTE.' ));
			}else{
				throw new Exception("NO SE PUDO ELMINAR EL REGISTRO.", 1);
				
			}
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	
	public function savePoliza()
	{
		try {
			header("Content-type:application/pdf");

			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
			}
			else
			{
				if ( $type != 'application/pdf' AND $type != 'image/png' AND $type != 'image/jpeg' ) 
				{
					throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "
					INSERT INTO asegurados(id,afianzadora,monto,cobertura,vehiculo,archivo) 
					VALUES ('',?,?,?,?,'".$content."');
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$_POST['afianzador'],PDO::PARAM_INT);
					$this->stmt->bindParam(2,$_POST['monto'],PDO::PARAM_STR);
					$this->stmt->bindParam(3,$_POST['cobertura'],PDO::PARAM_INT);
					$this->stmt->bindParam(4,$_POST['vehiculo_id'],PDO::PARAM_INT);
					//$this->stmt->bindParam(5,$content,PDO::PARAM_LOB);
					$this->stmt->execute();
					//unlink($destiny.$name);
					return json_encode(array('status'=>'success','message'=>'LA EVIDENCIA DEL SEGURO SE GUARDO CON ÉXITO.' ));
				}
			}

			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function saveAviso()
	{
		try {
			$desc = mb_strtoupper($_POST['desc'],'utf-8');

			if ( empty($_FILES['archivo']['name']) ) {
				$this->sql = "
				INSERT INTO licencias_avisos(id,persona,tipo_doc,archivo,descripcion) 
				VALUES ('',?,?,NULL,?);
				";
				$this->stmt = $this->pdo->prepare( $this->sql );
				$this->stmt->bindParam(1,$_POST['sp_id'],PDO::PARAM_INT);
				$this->stmt->bindParam(2,$_POST['t_aviso'],PDO::PARAM_STR);
				$this->stmt->bindParam(3,$desc,PDO::PARAM_STR);
				$this->stmt->execute();
				return json_encode(array('status'=>'success','message'=>'LA EVIDENCIA DEL SEGURO SE GUARDO CON ÉXITO SIN DOCUMENTO.' ));
			}else{
				$size = $_FILES['archivo']['size'];
				$type = $_FILES['archivo']['type'];
				$name = $_FILES['archivo']['name'];
				$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
				
				if ( $size > 10485760 ) 
				{
					throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
				}
				else
				{
					if ( $type != 'application/pdf' ) 
					{
						throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
					}
					else
					{
						#convertir a bytes
						move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
						$file = fopen($destiny.$name,'r');
						$content = fread($file,$size);
						$content = addslashes($content);
						fclose($file);
						#Insertar en la BD
						$this->sql = "
						INSERT INTO licencias_avisos(id,persona,tipo_doc,archivo) 
						VALUES ('',?,?,'".$content."',?);
						";
						$this->stmt = $this->pdo->prepare( $this->sql );
						$this->stmt->bindParam(1,$_POST['sp_id'],PDO::PARAM_INT);
						$this->stmt->bindParam(2,$_POST['t_aviso'],PDO::PARAM_STR);
						$this->stmt->bindParam(3,$_POST['desc'],PDO::PARAM_STR);
						$this->stmt->execute();
						//unlink($destiny.$name);
						return json_encode(array('status'=>'success','message'=>'LA EVIDENCIA DEL SEGURO SE GUARDO CON ÉXITO.' ));
					}
				}
			}
			
			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function list_avisos()
	{
		try {
			$avisos = array();
			$this->sql = "
			SELECT l.id,l.tipo_doc,l.created_at,CONCAT(p.nombre,' ',p.ap_pat,' ',p.ap_mat) AS full_name, l.descripcion FROM licencias_avisos  AS l
			INNER JOIN personal AS p ON p.id = l.persona
			WHERE persona = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$_POST['sp'],PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			$avisos['sp'] = $this->result[0]->full_name;
			$avisos['archivos'] = $this->result;
			
			return json_encode( $avisos );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getAvisoPDF()
	{
		try {
			$aviso = $_POST['id'];
			$doc="";
			$this->sql = "
				SELECT archivo FROM licencias_avisos  WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$aviso,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ); 
			$doc .= "<div class='row'>";
				$doc .= "<div class='col-md-12'>";
				$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($this->result->archivo).'" type="application/pdf" width="100%" height="600px" />';
				$doc .= "</div>";
			$doc .= "</div>";
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getNombreFacturas()
	{
		try {
			$solicitud = $_POST['solicitud'];

			$this->sql = "
				SELECT id,name,total,solicitud,created_at FROM facturas WHERE solicitud = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$solicitud,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			
			return json_encode($this->result);
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}

	public function saveFactura()
	{
		try {
			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
			}
			else
			{
				if ( $type != 'application/pdf') 
				{
					throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "
					INSERT INTO facturas (id,name,total,solicitud,archivo) 
					VALUES ('',?,?,?,'".$content."');
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$_POST['name_doc'],PDO::PARAM_STR);
					$this->stmt->bindParam(2,$_POST['costo'],PDO::PARAM_STR);
					$this->stmt->bindParam(3,$_POST['solicitud_id'],PDO::PARAM_INT);
					$this->stmt->execute();
					unlink($destiny.$name);
					return json_encode(array('status'=>'success','message'=>'LA FACTURA SE GUARDO CON ÉXITO.' ));
				}
			}

			return json_encode( $this->result );
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}

	public function getFacturaPDF()
	{
		try {
			$id = $_POST['id'];
			$doc="";
			$this->sql = "
				SELECT archivo FROM facturas  WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ); 
			$doc .= "<div class='row'>";
				$doc .= "<div class='col-md-12'>";
				$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($this->result->archivo).'" type="application/pdf" width="100%" height="600px" />';
				$doc .= "</div>";
			$doc .= "</div>";
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getDocumentosSolicitud()
	{
		try {
			#con el vehiculo obtener las solciitudes
			$auto = $_POST['auto'];
			$this->sql = "
				SELECT id FROM solicitudes WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();

			$ids_res =  $this->stmt->fetchAll(PDO::FETCH_OBJ);

			$ids = array();
			foreach ($ids_res as $key => $val) {# code...
				array_push($ids, $val->id);
			}				
			$ids = implode(',',$ids);
			
			$doc="";
			$this->sql = "
				SELECT s.*,t.nom AS documento,folio FROM solicitud_documentos AS s
				INNER JOIN t_doc AS t ON t.id = s.tipo_doc  
				INNER JOIN solicitudes AS so ON so.id = s.solicitud
				WHERE s.solicitud IN (".$ids.") 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			$doc .= "<ol>";
			foreach ($this->result as $key => $value) {
				if( $value->formato == 'application/pdf' ){
					$formato = "(PDF)";
				}elseif ($value->formato == 'image/png' OR $value->formato == 'image/jpeg') {
					$formato = "(IMAGEN)";
				}else{
					$formato = "(DESCONOCIDO)";
				}
				if ($formato != "(DESCONOCIDO)") {
					$doc .= "<li>"."<a href='#documentacion_vehicular' onclick='ver_documento_solicitud(".$value->id.")'>"."<b>".$value->folio."</b> - ".$value->documento." - ".$formato."</a>"."</li>";
				}else{
					$doc .= "<li>".$value->documento." - ".$formato."</li>";
				}
				
			}
			$doc .= "</ol>";
			$doc .= "<div id='archivo_solicitud'></div>";
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function documentoSolicitud()
	{
		try {
			#con el vehiculo obtener las solciitudes
			$id = $_POST['id'];
			$doc="";
			$this->sql = "
				SELECT * FROM solicitud_documentos WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ); 
			if($this->result->formato == 'application/pdf'){
				$doc .= "<div class='row'>";
					$doc .= "<div class='col-md-12'>";
					$doc.= '<embed src="data:'.$this->result->formato.';base64,'.base64_encode($this->result->archivo).'" type="'.$this->result->formato.'" width="100%" height="600px" />';
					$doc .= "</div>";
				$doc .= "</div>";
			}else{
				$doc .= "<div class='row'>";
					$doc .= "<div class='col-md-12'>";
					$doc.= "<img class='img-responsive pad' src='data:".$this->result->formato.";base64,".base64_encode(stripslashes($this->result->archivo))."' alt='Evidencia' />";
					$doc .= "</div>";
				$doc .= "</div>";
			}
			
			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getIMGEventos()
	{
		try {
			$f_ini = $_POST['f_ini'];
			$f_fin = $_POST['f_fin'];

			$doc="";
			$this->sql = "
				SELECT * FROM eventos WHERE  fecha BETWEEN ? AND ?; 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$f_ini,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$f_fin,PDO::PARAM_STR);
			$this->stmt->execute();

			$ids_res =  $this->stmt->fetchAll(PDO::FETCH_OBJ);

			$ids = array();
			foreach ($ids_res as $key => $val) {# code...
				array_push($ids, $val->id);
			}				
			$ids = implode(',',$ids);
			
			$this->sql = "
				SELECT ev.*,e.titulo FROM eventos_evidencia AS ev 
				INNER JOIN eventos AS e ON e.id = ev.evento
				WHERE ev.evento IN (".$ids.") 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			#print_r($this->result[0]->archivo);exit;
			foreach ($this->result as $key => $value) {
				
				if( $value->tipo != 'application/pdf' ){
					$doc .= "<div class='col-md-3'>";
                       	$doc .=	"<img class='img-responsive pad' src='data:".$value->tipo.";base64,".base64_encode(stripslashes($value->archivo))."' alt='Evidencia' width='700' height='700'>";

                        $doc .= "<p class='text-center'>";
                          	$doc .= $value->titulo;
                        $doc .= "</p>";
                     $doc .= "</div>";
				}else{
					$doc .= "<div class='col-md-6'>";
                       	
                       	$doc.= '<embed src="data:'.$value->tipo.';base64,'.base64_encode(stripslashes($value->archivo)).'" type="'.$value->tipo.'" width="100%" height="600px" />';

                        $doc .= "<p class='text-center'>";
                          	$doc .= $value->titulo;
                        $doc .= "</p>";
                     $doc .= "</div>";
				}
				
			}			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getDocSiniestros()
	{
		try {

			$auto = $_POST['auto'];
			$this->sql = "
				SELECT id FROM solicitudes WHERE vehiculo = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$auto,PDO::PARAM_INT);
			$this->stmt->execute();

			$ids_res =  $this->stmt->fetchAll(PDO::FETCH_OBJ);

			$ids = array();
			foreach ($ids_res as $key => $val) {# code...
				array_push($ids, $val->id);
			}				
			$ids = implode(',',$ids);
			$doc = "";
			$this->sql = "
				SELECT * FROM siniestros WHERE solicitud_id IN (".$ids.") 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ); 
			#print_r($this->result);exit;
			foreach ($this->result as $key => $value) {
				$doc .= "<div class='col-md-6'>";
                   	$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($value->archivo).'" type="application/pdf" width="100%" height="600px" />';
                 $doc .= "</div>";
				
			}			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getSolcitudEsp($s)
	{
		try {
			$this->sql = "
				SELECT
				  s.folio,
				  CONCAT(
				    p.nombre,
				    ' ',
				    p.ap_pat,
				    ' ',
				    p.ap_mat
				  ) AS solicitante_name,
				  v.*,
				  (
				  SELECT CONCAT
				    (nombre,
				    ' ',
				    ap_pat,
				    ' ',
				    ap_mat)
				  FROM
				    personal as per
				  WHERE
				    per.id = v.resguardatario
				) AS reguardatario_name,
				m.nom AS marca_name,
				tv.nom AS tipo_name,
				s.km AS kilo,
				(
				  SELECT UPPER(a.nombre) as area
				  FROM
				    personal as pe
				  INNER JOIN area as a on a.id = pe.area_id
				  WHERE
				    pe.id = v.resguardatario
				) AS area,
				s.f_sol
				FROM
				  solicitudes AS s
				INNER JOIN
				  personal AS p ON p.id = s.solicitante
				INNER JOIN
				  vehiculos AS v ON v.id = s.vehiculo
				INNER JOIN
				  marcas AS m ON m.id = v.marca
				INNER JOIN
				  tipos_v AS tv ON tv.id = v.tipo
				WHERE
				  s.id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$s,PDO::PARAM_INT);
			$this->stmt->execute();	
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);	

			return $this->result;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getReparaciones($s)
	{
		try {
			$this->sql = "
				SELECT
				  cf.nombre
				FROM
				  reparaciones AS r
				INNER JOIN
				  catalogo_fallas AS cf ON cf.id = r.falla
				WHERE
				  r.solicitud = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$s,PDO::PARAM_INT);
			$this->stmt->execute();	
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);	

			return $this->result;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}

	public function delFactura()
	{
		try {
			$f = ( isset($_POST) ) ? $_POST['factura']:0 ;
			if ($f == 0) {
				throw new Exception("NO SE ENCONTRO LA FACTURA SELECCIONADA.", 1);
			}
			$this->sql = "
				DELETE FROM facturas WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$f,PDO::PARAM_INT);
			$this->stmt->execute();	

			return json_encode(array('status'=>'success','message'=>'LA FACTURA A SIDO ELIMINADA EXITOSAMENTE.'));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function delEvento()
	{
		try {
			$evento = ( isset($_POST) ) ? $_POST['e']:0 ;
			if ($evento == 0) {
				throw new Exception("NO SE ENCONTRO EL EVENTO SELECCIONADO.", 1);
			}
			$this->sql = "
				DELETE FROM eventos_evidencia WHERE evento = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$evento,PDO::PARAM_INT);
			$this->stmt->execute();	
			$this->sql = "
				DELETE FROM eventos WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$evento,PDO::PARAM_INT);
			$this->stmt->execute();	
			
			return json_encode(array('status'=>'success','message'=>'EL EVENTO A SIDO ELIMINADO EXITOSAMENTE.'));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function reactiveSol()
	{
		try {
			$s = ( isset($_POST) ) ? $_POST['s']:0 ;
			if ($s == 0) {
				throw new Exception("NO SE ENCONTRO LA SOLICITUD SELECCIONADA.", 1);
			}
			$this->sql = "
				DELETE FROM cancelaciones WHERE solicitud = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$s,PDO::PARAM_INT);
			$this->stmt->execute();	

			$this->sql = "
				UPDATE solicitudes SET estado = 1 WHERE id = ?
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$s,PDO::PARAM_INT);
			$this->stmt->execute();	
			return json_encode(array('status'=>'success','message'=>'LA SOLICITUD SE A REACTIVADO EXITOSAMENTE.'));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function addFalla()
	{
		try {
			#print_r( $_POST );exit;
			if (!isset($_POST['val'])) {
				throw new Exception("DEBE DE ESCRIBIR UNA FALLA.", 1);
			}
			if (!isset($_POST['g'])) {
				throw new Exception("NO SE ENCONTRO EL GRUPO DE LAS FALLAS.", 1);
			}
			$v = $_POST['val'];
			$g = $_POST['g'];
			
			$this->sql = "
				INSERT INTO catalogo_fallas(id, nombre, tipo_id) VALUES ('',?,?)
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$v,PDO::PARAM_STR);
			$this->stmt->bindParam(2,$g,PDO::PARAM_INT);
			$this->stmt->execute();	

			return json_encode(array('status'=>'success','message'=>'EL NUEVO TIPO DE FALLA SE INSERTÓ EXITOSAMENTE.'));
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}

	public function getLicencia()
	{
		try {
			$doc  = "";
			$id = $_POST['id'];
			$this->sql = "
				SELECT archivo FROM licencias WHERE id	 = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$res = $this->stmt->fetch( PDO::FETCH_OBJ );
			$doc .= "<div class='col-md-12'>";
               	$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($res->archivo).'" type="application/pdf" width="100%" height="600px" />';
            $doc .= "</div>";			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function updateLicencia()
	{
		try {
			#print_r( $_POST );exit;

			$size = $_FILES['archivo']['size'];
			$type = $_FILES['archivo']['type'];
			$name = $_FILES['archivo']['name'];
			$destiny = $_SERVER['DOCUMENT_ROOT'].'/autos/uploads/';
			
			if ( $size > 10485760 ) 
			{
				throw new Exception("EL ARCHIVO EXCEDE EL TAMAÑO ADMITIDO (10MB)", 1);
			}
			else
			{
				if ( $type != 'application/pdf') 
				{
					throw new Exception("EL FORMATO DEL ARCHIVO ES INCORRECTO.", 1);
				}
				else
				{
					#convertir a bytes
					move_uploaded_file($_FILES['archivo']['tmp_name'],$destiny.$name);
					$file = fopen($destiny.$name,'r');
					$content = fread($file,$size);
					$content = addslashes($content);
					fclose($file);
					#Insertar en la BD
					$this->sql = "
					UPDATE licencias SET f_expedicion = ?, f_vencimiento = ?, archivo='".$content."', tipo = ? WHERE id = ? 
					";
					$this->stmt = $this->pdo->prepare( $this->sql );
					$this->stmt->bindParam(1,$_POST['f_exp'],PDO::PARAM_STR);
					$this->stmt->bindParam(2,$_POST['f_ven'],PDO::PARAM_STR);
					$this->stmt->bindParam(3,$_POST['tipo'],PDO::PARAM_INT);
					$this->stmt->bindParam(4,$_POST['l_id'],PDO::PARAM_INT);
					$this->stmt->execute();
					unlink($destiny.$name);
					return json_encode(array('status'=>'success','message'=>'LICENCIA ACTUALIZADA DE MANERA EXITOSA.'));
				}
			}
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function getDocsSol()
	{
		try {
			$id = $_POST['id'];
			$this->sql = "
				SELECT sd.id, sd.solicitud, sd.tipo_doc,td.nom AS tipo_d FROM solicitud_documentos AS sd
				INNER JOIN t_doc AS td ON td.id = sd.tipo_doc
				WHERE sd.solicitud = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			
			if ( count($this->result) == 0 ) {
				return json_encode(array('status'=>'empty','message'=>'NO HAY DOCUMENTOS PARA MOSTRAR.'));
			}else{
				return json_encode( $this->result );
			}
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	public function verDocSol()
	{
		try {
			$id = $_POST['id'];
			$doc = "";
			$this->sql = "
				SELECT archivo FROM solicitud_documentos
				WHERE id = ? 
			";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->bindParam(1,$id,PDO::PARAM_INT);
			$this->stmt->execute();
			$res = $this->stmt->fetch( PDO::FETCH_OBJ );
			$doc .= "<div class='col-md-12'>";
               	$doc.= '<embed src="data:application/pdf;base64,'.base64_encode($res->archivo).'" type="application/pdf" width="100%" height="600px" />';
            $doc .= "</div>";			
			return $doc;
		} catch (Exception $e) {
			return json_encode(array('status'=>'error','message'=>$e->getMessage() ));
		}
	}
	
}
?>