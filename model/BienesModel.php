<?php 
public function getBienes()
	{
		try {
			session_start();
			$anexgrid = new AnexGrid();
			$person_id = $_SESSION['person_id'];
			#Buscar el area a la que pertence la persona
			$this->sql = "SELECT area_id FROM personal WHERE id = ?";
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute(array($person_id));
			$area_id = $this->stmt->fetch( PDO::FETCH_OBJ );
			$grupos = '';
			if ($area_id->area_id == '4') 
			{
				$grupos = '1,3,5,7';
			}
			if ($area_id->area_id == '25') 
			{
				$grupos = '1,2,4,6';
			}
			
			$this->sql = "
			SELECT
			    b.id,
			    b.descripcion,
			    b.serie,
			    b.status,
			    b.inventario,
			    b.desc_ub,
			    m.nombre AS marca,
			    g.nombre AS grupo,
			    t.nombre AS tipo,
			    mo.nombre AS modelo,
			    b.fecha_reg AS registro,
			    b.fecha_adq AS adquisicion,
			    UPPER(c.nombre) AS color,
			    ma.nombre AS material,
			    p.nombre AS proveedor,
			    CONCAT(
			        pe.nombre,
			        ' ',
			        pe.ap_pat,
			        ' ',
			        pe.ap_mat
			    ) AS asignadoa
			FROM
			    bienes AS b
			LEFT JOIN marcas AS m
			ON
			    m.id = b.marca_id
			LEFT JOIN grupos AS g
			ON
			    g.id = b.grupo_id
			LEFT JOIN t_bienes AS t
			ON
			    t.id = b.tipo_id
			LEFT JOIN modelos AS mo
			ON
			    mo.id = b.modelo_id
			LEFT JOIN color AS c
			ON
			    c.id = b.color_id
			LEFT JOIN materiales AS ma
			ON
			    ma.id = b.material_id
			LEFT JOIN proveedores AS p
			ON
			    p.id = b.pro_id
			LEFT JOIN asignacion AS a
			ON
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			";
			/*Agregar where de anexgrid*/
			/*Agregar where de anexgrid*/
			$this->sql .= "ORDER BY ".$anexgrid->columna." ".$anexgrid->columna_orden;
			$this->sql .= " LIMIT ".$anexgrid->pagina.",".$anexgrid->limite;

			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$this->result = $this->stmt->fetchAll( PDO::FETCH_OBJ );
			/*Obtener el total*/
			$this->sql = "
			SELECT
			    COUNT(b.id) AS Total
			FROM
			    bienes AS b
			LEFT JOIN marcas AS m
			ON
			    m.id = b.marca_id
			LEFT JOIN grupos AS g
			ON
			    g.id = b.grupo_id
			LEFT JOIN t_bienes AS t
			ON
			    t.id = b.tipo_id
			LEFT JOIN modelos AS mo
			ON
			    mo.id = b.modelo_id
			LEFT JOIN color AS c
			ON
			    c.id = b.color_id
			LEFT JOIN materiales AS ma
			ON
			    ma.id = b.material_id
			LEFT JOIN proveedores AS p
			ON
			    p.id = b.pro_id
			LEFT JOIN asignacion AS a
			ON
			    a.bien_id = b.id AND a.status = 1
			LEFT JOIN personal AS pe
			ON
			    pe.id = a.personal_id
			";
			
			$this->stmt = $this->pdo->prepare( $this->sql );
			$this->stmt->execute();
			$total = $this->stmt->fetch( PDO::FETCH_OBJ );
			
			echo $anexgrid->responde( $this->result,$total->Total );
			#return json_encode($this->result) ;
		} catch (Exception $e) {
			$this->result = array('error' => $e->getMessage()  );
		}
	}
?>