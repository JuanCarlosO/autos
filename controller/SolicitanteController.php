<?php  
/**
 * Clase del vehiculo
 */
include_once '../model/SolicitanteModel.php';
include_once 'pdf/fpdf.php';
class SolicitanteController 
{
	protected $model;
	function __construct()
	{
		$this->model = new SolicitanteModel();
	}
	public function getSolicitudes()
	{
		return $this->model->getSolicitudes();
	}
	public function ModifySolicitud()
	{
		return $this->model->ModifySolicitud();
	}
	public function autocomplete_personal($term)
	{
		return $this->model->autocomplete_personal($term);
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
	public function getFolio($person)
	{
		return $this->model->getFolio($person);
	}

	public function generatePDF($s)
	{
		#Recuperar el ID de la solicitud 
		$solicitud = $this->model->getSolcitudEsp($s);

		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
    	// Arial bold 15
        $pdf->SetFont('Arial','B',14);
    	
    	// Título
        $pdf->Cell(190,5,utf8_decode('SOLICITUD INTERNA DE SERVICIO AUTOMOTRIZ Y SALIDA DE VEHÍCULO'),0,1,'C');
    	// Salto de línea
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(110,10,'',0,0,'C');
		$pdf->Cell(30,7,utf8_decode('Folio:'),1,0,'C');
		$pdf->Cell(50,7,$solicitud->folio,1,0,'C');
		$pdf->Ln(7);
		$pdf->Cell(110,10,'',0,0,'C');
		$pdf->Cell(30,7,'Fecha',1,0,'C');
		$pdf->SetFont('Arial','I',8);
		$pdf->Cell(50,7,$solicitud->f_sol,1,0,'L');
		$pdf->Ln(10);
		#AGREGAR DATOS DEL SOLICITANTE
		
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(190,7,utf8_decode('DATOS DEL SOLICITANTE'),1,1,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(130,30,'',1,0,'L');
		$pdf->Text(12,55,utf8_decode('SOLICITANTE:'));
		$pdf->Text(15,60,$solicitud->solicitante_name);
		$pdf->Text(12,65,utf8_decode('ÁREA:'));
		$pdf->Text(15,70, utf8_decode($solicitud->area_name) );
		$pdf->Text(12,75,utf8_decode('RESGUARDATARIO:'));
		$pdf->Text(40,75,utf8_decode($solicitud->solicitante_name));
		$pdf->Cell(60,30,'',1,0);
		$pdf->Text(142,65,utf8_decode('KILOMETRAJE'));
		$pdf->Text(142,75,$solicitud->km);
		$pdf->Ln(30);
		#DATOS DEL VEHICULO 
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(190,7,utf8_decode('DATOS DEL VEHÍCULO'),1,1,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(190,20,'',1,0,'L');	
		$pdf->Text(12,95,utf8_decode('AUTOMOVIL: ')); 
		$pdf->Text(50,95, $solicitud->tipo);
		$pdf->Text(12,100,utf8_decode('PLACAS: '));
		$pdf->Text(50,100,$solicitud->placas);
		$pdf->Text(12,105,utf8_decode('MARCA: '));
		$pdf->Text(50,105,$solicitud->marca);
		$pdf->Ln(20);
		#AGREGAR LA DESCRIPCION DEL SERVICIO
		#$pdf->Cell(190,7,'',1,0);
		$pdf->Ln(0);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(190,7,utf8_decode('DESCRIPCIÓN DEL SERVICIO'),1,0,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		$pdf->MultiCell(190,7,utf8_decode($solicitud->descripcion),1,'J',false);
		#celda del reguardatario
		$pdf->Ln(0);
		$pdf->Cell(95,20,'',1,0);
		$pdf->Cell(95,20,'',1,0);
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(95,10,'NOMBRE Y FIRMA DE USUARIO Y/O RESGUARDATARIO',0,0,'C');
		$pdf->Cell(95,10,'FIRMA VO. BO. DIRECTOR O JEFE INMEDIATO SUPERIOR',0,0,'C');
		$pdf->Ln(10);
		$pdf->Cell(95,30,'',1,0);
		$pdf->Cell(95,30,'',1,0);
		$pdf->Ln(0);
		$pdf->Cell(95,7,'FECHA Y HORA DE INGRESO AL TALLER:',0,0,'L');
		$pdf->Cell(95,7,'FECHA Y HORA DE SALIDA DE TALLER:',0,0,'L');
		$pdf->Ln(9);
		$pdf->Cell(95,7,'NOMBRE:',0,0,'L');
		$pdf->Cell(95,7,'NOMBRE:',0,0,'L');
		$pdf->Ln(9);
		$pdf->Cell(95,7,'FIRMA Y TALLER:',0,0,'L');
		$pdf->Cell(95,7,'FIRMA Y TALLER:',0,0,'L');
		$pdf->Ln(12);
		$pdf->Cell(190,30,'',1,0);
		$pdf->Ln(0);
		$pdf->Cell(190,7,'AUTORIZO SALIDA A TALLER',0,0,'C');
		$pdf->Ln(15);
		$pdf->Cell(190,7,'_______________________________________________________________',0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(190,7,'L.C SERGIO LARA AHUATZI',0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(190,7,'TITULAR DE LA UNIDAD DE APOYO ADMINISTRATIVO',0,0,'C');
		$pdf->Output();
	}
	
}

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
	    // Logo
	    $this->Image('pdf/img/header.png',0,-6,210,30);
	    // Arial bold 15
	    $this->SetFont('Arial','B',15);
	    
	    // Salto de línea
	    $this->Ln(7);
	}

	// Pie de página
	function Footer()
	{
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Image('pdf/img/footer.png',1,255,217,20);
	    $this->Cell(0,5,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
	}
}

?>