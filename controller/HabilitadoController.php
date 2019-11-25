<?php 
/**
 * Habilitado vehicular
 */
include_once '../model/HabilitadoModel.php';
include_once 'pdf/fpdf.php';
class HabilitadoController
{
	protected $model;
	function __construct()
	{
		$this->model = new HabilitadoModel();
	}

	public function saveTaller($post)
	{
		if (isset($post['id'])) {
			return $this->model->updateTaller($post);
		}else{
			return $this->model->saveTaller($post);
		}
	}
	public function getTalleres()
	{
		return $this->model->getTalleres();
	}
	public function delTaller($t)
	{
		return $this->model->delTaller($t);
	}
	public function getTaller($t)
	{
		return $this->model->getTaller($t);
	}
	public function saveConductor($post)
	{
		return $this->model->saveConductor($post);
	}
	public function getSolicitudes()
	{
		return $this->model->getSolicitudes();
	}
	public function saveSiniestro($post)
	{
		return $this->model->saveSiniestro($post);
	}
	public function getDetalleSol($sol)
	{
		return $this->model->getDetalleSol($sol);
	}
	public function saveAtencion($post)
	{
		return $this->model->saveAtencion($post);
	}
	public function getFallas($t)
	{
		return $this->model->getFallas($t);
	}
	public function getTipoFalla()
	{
		return $this->model->getTipoFalla();
	}
	public function getListTalleres()
	{
		return $this->model->getListTalleres();
	}
	public function saveReparacion($post)
	{
		return $this->model->saveReparacion($post);
	}
	public function saveFallas($post)
	{
		return $this->model->saveFallas($post);
	}
	public function saveIngreso($post)
	{
		return $this->model->saveIngreso($post);
	}
	public function saveSalida($post)
	{
		return $this->model->saveSalida($post);
	}
	public function saveEvent($post)
	{
		return $this->model->saveEvent($post);
	}
	public function getEvents()
	{
		return $this->model->getEvents();
	}
	public function entregaAuto($s)
	{
		return $this->model->entregaAuto($s);
	}
	public function saveCotizacion()
	{
		
		return $this->model->saveCotizacion();
	}
	public function saveEntrega()
	{
		return $this->model->saveEntrega();
	}
	public function saveBaja()
	{
		return $this->model->saveBaja();
	}
	public function saveSolHistorica()
	{
		return $this->model->saveSolHistorica();
	}
	public function getTiposDoc()
	{
		return $this->model->getTiposDoc();
	}
	public function saveChofer()
	{
		return $this->model->saveChofer();
	}
	public function getChoferes()
	{
		return $this->model->getChoferes();
	}
	public function saveSolicitud()
	{
		try {
			
			if ( !isset($_POST['f_sol']) && !empty($_POST['f_sol']) ) {
				throw new Exception("DEBE ELEGIR UNA FECHA DE SOLICITUD.", 1);
			}
			$f_sol = $_POST['f_sol'];
			if ( !isset($_POST['km']) && !empty($_POST['km']) ) {
				throw new Exception("DEBE ESCRIBIR EL KILOMETRAJE ACTUAL DEL VEHÍCULO.", 1);
			}
			$km = $_POST['km'];
			if ( !isset($_POST['solicitante_h']) && !empty($_POST['solicitante_h']) ) {
				throw new Exception("DEBE DE BUSCAR Y SELECCIONAR A UNA PERSONA.", 1);
			}
			$solicitante = $_POST['solicitante_h'];
			if ( !isset($_POST['resguardatario_h']) && !empty($_POST['resguardatario_h']) ) {
				throw new Exception("NO SE ENCONTRO RESGUARDATARIO.", 1);
			}
			$resguardatario = $_POST['resguardatario_h'];
			if ( !isset($_POST['placa_h']) && !empty($_POST['placa_h']) ) {
				throw new Exception("NO SE ENCONTRO NÚMERO DE PLACA.", 1);
			}
			$placa 	= $_POST['placa_h'];
			$desc 	= $_POST['desc'];
			$folio 	= $_POST['folio'];
			
			return $this->model->saveSolicitud($f_sol,$km,$solicitante,$resguardatario,$placa,$desc,$folio);
		} catch (Exception $e) {
			return json_encode(array('status'=>'error', 'message'=>$e->getMessage() ));
		}
		
	}
	public function saveEvidencia()
	{
		return $this->model->saveEvidencia();
	}
	public function getEvidencia()
	{
		return $this->model->getEvidencia();
	}

	public function generateBitacora()
	{
		#Recuperar el ID de la solicitud 
		#$solicitud = $this->model->getSolcitudEsp($s);

		$pdf = new PDF2('L','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
    	// Arial bold 15
        $pdf->SetFont('Arial','B',14);
    	
    	// Título
        $pdf->Cell(260,5,utf8_decode('BITÁCORA DE REPARACIÓN Y MANTENIMIENTO DEL PARQUE VEHÍCULAR DE LA UAI'),0,1,'C');
    	// Salto de línea
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(48,5,'Marca:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Modelo:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Tipo:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Placas:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'No. serie:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'No. inventario:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Nombre del resguardatario:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Fecha de resguardo:',0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(48,5,utf8_decode('Período de actualización:'),0,0,'R');
		$pdf->Cell(148,5,'','B',0,'R');
		$pdf->Ln(10);
		#AGREGAR la tabla 
		$pdf->Cell(265,5,utf8_decode('R E P A R A C I Ó N   Y   M A N T E N I M I E N T O'),1,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(10,5,'#',1,0,'C');
		$pdf->Cell(15,5,utf8_decode('Kilometraje'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('# solicitud'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('F. solicitud'),1,0,'C');
		$pdf->Cell(15,5,utf8_decode('Área sol.'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('F. auto'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('Proveedor'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('# de factura'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('F. factura'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('Importe'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('F. ent. taller'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('Descripción'),1,0,'C');
		$pdf->Cell(20,5,utf8_decode('# tarjeton'),1,0,'C');
		$pdf->Cell(25,5,utf8_decode('Comentarios'),1,0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','',5);
		for ($i=0; $i < 15 ; $i++) { 
			$pdf->Cell(10,5,($i+1),1,0,'C');
			$pdf->Cell(15,5,'123456',1,0,'C');
			$pdf->Cell(20,5,utf8_decode('001-2019'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('2019-11-01'),1,0,'C');
			$pdf->Cell(15,5,utf8_decode('DDS'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('2019-11-01'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('Proveedor'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('123456'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('Fecha factura'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('10,000'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('F. entrada taller'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('Descripción'),1,0,'C');
			$pdf->Cell(20,5,utf8_decode('No de tarjeton'),1,0,'C');
			$pdf->Cell(25,5,utf8_decode('Lorem'),1,0,'C');
			$pdf->Ln(5);
		}
		$pdf->Output();
	}
	
	
}

class PDF2 extends FPDF
{
	// Cabecera de página
	function Header()
	{
	    // Logo
	    $this->Image('pdf/img/header.png',0,-6,270,30);
	    // Arial bold 15
	    $this->SetFont('Arial','B',15);
	    
	    // Salto de línea
	    $this->Ln(7);
	}

	// Pie de página
	function Footer(){
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Image('pdf/img/footer.png',1,197,282,18);
	    $this->Cell(0,5,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
	}
}
?>