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
	/*Recuperar los datos de 1 vehiculo*/
	public function getCarEspecifico($id)
	{
		return $this->model->getCarEspecifico($id);
	}

	public function generateBitacora()
	{
		#Recuperar el ID de la solicitud 
		$auto = $this->model->getCarEspecifico($_POST['placa_h']);
		/*
		 [id] => 3 [tipo] => 1 [marca] => 1 [placas] => MAL8690 [n_resguardo] => 23456789 [color] => VINO [niv] => 987456321 [n_motor] => 567892340987 [modelo] => 2010 [cil] => 4 [resguardatario] => 51 [estado] => ACTIVO [observaciones] => Lorem
		 */
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
		$pdf->Cell(148,5, $auto->marca_name ,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Modelo:',0,0,'R');
		$pdf->Cell(148,5,$auto->modelo,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Tipo:',0,0,'R');
		$pdf->Cell(148,5,$auto->tipo_name,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Placas:',0,0,'R');
		$pdf->Cell(148,5,$auto->placas,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'No. serie:',0,0,'R');
		$pdf->Cell(148,5,$auto->niv,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'No. Resguardo:',0,0,'R');
		$pdf->Cell(148,5,$auto->n_resguardo,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Nombre del resguardatario:',0,0,'R');
		$pdf->Cell(148,5,$auto->name_reguardatario,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,'Fecha de resguardo:',0,0,'R');
		$pdf->Cell(148,5,$auto->created_at,'B',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(48,5,utf8_decode('Período de actualización:'),0,0,'R');
		$pdf->Cell(148,5,'','B',0,'C');
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
		for ($i=0; $i < 7 ; $i++) { 
			$pdf->Cell(10,15,($i+1),1,0,'C');
			$pdf->Cell(15,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(15,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(20,15,'',1,0,'C');
			$pdf->Cell(25,15,'',1,0,'C');
			$pdf->Ln(15);
		}
		$pdf->Output();
	}
	public function generateFullSol()
	{
		#Recuperar el ID de la solicitud 
		$s = $_POST['solicitud_id'];
		$solicitud = $this->model->getSolcitudEsp($s);
		$reparaciones = $this->model->getReparaciones($s);

		$pdf = new PDF3('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
    	// Arial bold 15
        $pdf->SetFont('Arial','B',14);
    	
    	// Título
        $pdf->Cell(195,5,utf8_decode('SOLICITUD DE MANTENIMIENTO PREVENTIVO	 Y/O CORRECTIVO'),0,1,'C');
    	// Salto de línea
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica','',8);
        $pdf->Cell(148,5,'',0,0,'R');
        $pdf->Cell(20,5,'Fecha:',1,0,'R');
		$pdf->Cell(30,5, date('d-m-Y') ,1,0,'R');
		$pdf->Ln(5);
		$pdf->Cell(148,5,'',0,0,'R');
        $pdf->Cell(20,5,'Folio:',1,0,'R');
		$pdf->Cell(30,5, $solicitud->folio ,1,0,'R');
		$pdf->Ln(10);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->SetFillColor(105, 227, 251);
		$pdf->Cell(192	,5,utf8_decode('ADSCRIPCIÓN DEL VEHÍCULO'),1,0,'C',true);
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(60,5,utf8_decode('Dirección general:'),1,0,'R');
		$pdf->SetFont('Helvetica','',12 );
		$pdf->Cell(132,5,utf8_decode('Unidad de Asuntos Internos'),1,0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(60,5,utf8_decode('Area:'),1,0,'R');
		$pdf->SetFont('Helvetica','',12 );
		$pdf->Cell(132,5,utf8_decode(''),1,0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(60,5,utf8_decode('Localidad:'),1,0,'R');
		$pdf->SetFont('Helvetica','',12 );
		$pdf->Cell(132,5,utf8_decode('Metepec;Estado de México'),1,0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(60,5,utf8_decode('Resguardatario:'),1,0,'R');
		$pdf->SetFont('Helvetica','',12 );
		$pdf->Cell(132,5,utf8_decode($solicitud->reguardatario_name),1,0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(60,5,utf8_decode('Nombre de usuario:'),1,0,'R');
		$pdf->SetFont('Helvetica','',12 );
		$pdf->Cell(132,5,utf8_decode($solicitud->solicitante_name),1,0,'C');
		$pdf->Ln(5);
		$pdf->SetFillColor(105, 227, 251);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(192,5,'',1,0,'R',1);
		$pdf->SetFont('Helvetica','',7 );
		$pdf->Ln(5);
		$pdf->Cell(48,8,"# Resguardo:\n".PHP_EOL.$solicitud->n_resguardo,1,0,'R');
		$pdf->Cell(48,8,"Placas: ".$solicitud->placas,1,0,'R');
		$pdf->Cell(48,8,"Marca: ".$solicitud->marca_name,1,0,'R');
		$pdf->Cell(48,8,"Tipo: ".$solicitud->tipo_name,1,0,'R');
		$pdf->Ln(8);
		$pdf->Cell(48,8,"Modelo: ".$solicitud->modelo,1,0,'R');
		$pdf->Cell(48,8,"Motor: ".utf8_decode($solicitud->n_motor),1,0,'R');
		$pdf->Cell(48,8,"Serie: ".$solicitud->niv,1,0,'R');
		$pdf->Cell(48,8,'Combustible: Gasolina',1,0,'R');
		$pdf->Ln(8);
		$pdf->Cell(48,8,"Cilindros: ".$solicitud->cil,1,0,'R');
		$pdf->Cell(48,8,"KM: ".utf8_decode($solicitud->km),1,0,'R');
		$pdf->Cell(48,8,"Uso: Oficial",1,0,'R');
		$pdf->Cell(48,8,'',1,0,'R');
		$pdf->Ln(8);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(192,5,'SERVICIO SOLICITADO',1,0,'C',1);
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','',10);
		$pdf->Cell(48,12,utf8_decode('TRANSMISIÓN'),1,0,'R');
		$pdf->Cell(48,12,'FRENOS',1,0,'R');
		$pdf->Cell(48,12,'LLANTAS',1,0,'R');
		$pdf->Cell(48,12,utf8_decode('SUSPENSIÓN'),1,0,'R');
		$pdf->Ln(12);
		$pdf->Cell(48,12,utf8_decode('VERIFICACIÓN'),1,0,'R');
		$pdf->Cell(48,12,utf8_decode('AFINACIÓN MENOR'),1,0,'R');
		$pdf->Cell(48,12,utf8_decode('AFINACIÓN MAYOR'),1,0,'R');
		$pdf->Cell(48,12,utf8_decode('HOJALATERÍA Y PINTURA'),1,0,'R');
		$pdf->Ln(12);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(192,5,'OTRAS REPARACIONES',1,0,'C',1);
		$pdf->Ln(5);
		$pdf->SetFont('Helvetica','',8);
		foreach ($reparaciones as $key => $value) {
			$pdf->MultiCell(192,8,(++$key).".- ".utf8_decode($value->nombre),1);
		}
		$pdf->SetFont('Helvetica','B',12);
		$pdf->Cell(192,5,'FIRMAS',1,0,'C',1);
		$pdf->SetFont('Helvetica','',10);
		$pdf->Ln(5);
		$pdf->MultiCell(95,12,utf8_decode('Elaboró'.PHP_EOL.'C. Gerardo López Salazar '.PHP_EOL.'Habilitado de control vehicular'),1,'C');
		$x=$pdf->GetX();
		$y=$pdf->GetY();
		$pdf->SetXY($x+96,$y-36);
		$pdf->MultiCell(96,12,utf8_decode('Autorizó'.PHP_EOL.'Sergio Lara Ahuatzi'.PHP_EOL.'Titular de apoyo administrativo.'),1,'C');
		$pdf->MultiCell(192,12,utf8_decode('Vo. Bo. '.PHP_EOL.'Mtra. Maria de la Luz Nuñes Camacho'.PHP_EOL.'Titular de la UAI'),1,'C');
		
		$pdf->Output();
	}
	public function cancelarSolicitud()
	{
		return $this->model->cancelarSolicitud();
	}
	public function savePDFSolicitud()
	{
		return $this->model->savePDFSolicitud();
	}
	public function finalizarGarantia()
	{
		return $this->model->finalizarGarantia();
	}
	public function saveGarantia()
	{
		return $this->model->saveGarantia();
	}
	public function generalDocumentacion()
	{
		return $this->model->generalDocumentacion();
	}
	public function getDocumentos()
	{
		return $this->model->getDocumentos();
	}
	public function getAseguradoras()
	{
		return $this->model->getAseguradoras();
	}
	public function savePoliza()
	{
		return $this->model->savePoliza();
	}
	public function getPolizas()
	{
		return $this->model->getPolizas();
	}
	public function getBajasDocs()
	{
		return $this->model->getBajasDocs();
	}
	public function getDocsCotizaciones()
	{
		return $this->model->getDocsCotizaciones();
	}
	public function deleteChofer()
	{
		return $this->model->deleteChofer();
	}
	public function saveAviso()
	{
		return $this->model->saveAviso();
	}
	public function list_avisos()
	{
		return $this->model->list_avisos();
	}
	public function getAvisoPDF()
	{
		return $this->model->getAvisoPDF();
	}
	public function saveFactura()
	{
		return $this->model->saveFactura();
	}
	public function getNombreFacturas()
	{
		return $this->model->getNombreFacturas();
	}
	public function getFacturaPDF()
	{
		return $this->model->getFacturaPDF();
	}
	public function getDocumentosSolicitud()
	{
		return $this->model->getDocumentosSolicitud();
	}
	public function documentoSolicitud()
	{
		return $this->model->documentoSolicitud();
	}
	public function getIMGEventos()
	{
		return $this->model->getIMGEventos();
	}
	public function getDocSiniestros()
	{
		return $this->model->getDocSiniestros();
	}
	public function delFactura()
	{
		return $this->model->delFactura();
	}
	public function reactiveSol()
	{
		return $this->model->reactiveSol();
	}
	public function delEvento()
	{
		return $this->model->delEvento();
	}
	public function addFalla()
	{
		return $this->model->addFalla();
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

class PDF3 extends FPDF
{
	// Cabecera de página
	function Header()
	{
	    // Logo
	    $this->Image('pdf/img/header.png',0,-6,215,30);
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
	    $this->Image('pdf/img/footer.png',1,252,217,25);
	    $this->Cell(0,5,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
	}
}
?>