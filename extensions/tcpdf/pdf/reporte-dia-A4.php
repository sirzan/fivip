<?php
require_once "../../../models/reporte-dia.api.php";


// Include the main TCPDF library (search for installation path).


$respuesta = new ReporteDia();
$data1 = $respuesta->apiReporte($_GET['info']);
$data2 =$respuesta->apiReportemontoTotales($_GET['info']);
$data3 =$respuesta->apiReporteremesaTotales($_GET['info']);
$data4 =$respuesta->apiReporteremesaComision($_GET['info']);
// var_dump($_GET);
// var_dump($data4);
// $comision =$respuesta->apiReporteremesaComision($_GET['info']);
require_once('tcpdf_include.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
		date_default_timezone_set('America/Lima');
		$fecha=date("Y-m-d H:i:s");
        $image_file = K_PATH_IMAGES.'logo.PNG';
        $this->Image($image_file, 10, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 15, 'CORPORATIVO FIVIP', 0, false, 'R', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);
        $this->Cell(0, 15, 'RUC: 20607982873', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'N', 10);
		$this->Ln(4);
        $this->Cell(0, 15, ' Fecha:'.$fecha, 0, false, 'R', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font

// add a page
$pdf->AddPage('P','A4');
$pdf->Image('images/logo2.png', 30, 120, 150, '', '', '', '', false, 300);

$pdf->SetFont('helvetica', 'B', 15);
$pdf->Ln(4);
$pdf->Cell(0, 15, 'REPORTES TOTALES DEL DIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Ln(6);
$pdf->Cell(0, 15, 'TOTALES POR TASA', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(4);
$pdf->SetFont('helvetica', 'N', 10);

// set some text to print

foreach ($data2 as $value) {
	$html = '
	<table border="1" cellpadding="5">
	<thead>
	
	<tr>
	<th>'.$value['simbolo_tasa'].''.number_format($value['tasa'],4,',','.').' ('.$value['iso_tasa'].') x '.$value['simbolo_moneda'].''.number_format($value['total_envio'],2,',','.').' ('.$value['iso_moneda'].')</th>
	<th>Total: '.$value['simbolo_tasa'].''.number_format($value['total_remesa'],2,',','.').' ('.$value['iso_tasa'].')</th>

	</tr>
	
	<thead>

	
	</table>
	
	';
	
	
	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->Ln(-3);
}
$pdf->Ln(4);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 15, 'TOTALES POR GENERALES', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->Ln(8);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->Cell(65, 15, 'TOTALES RECIBIDOS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(65, 15, 'TOTALES ENVIADOS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(8);
$pdf->SetFont('helvetica', 'N', 10);
foreach ($data3 as $value) {
	$pdf->Cell(65, 7, $value['simbolo_moneda'].''.number_format($value['total_envio'],2,',','.').' ('.$value['iso_moneda'].')', 1, false, 'L', 0, '', 0, false, 'M', 'M');
	$pdf->Cell(65, 7, $value['simbolo_tasa'].''.number_format($value['total_remesa'],2,',','.').' ('.$value['iso_tasa'].')', 1, false, 'L', 0, '', 0, false, 'M', 'M');
	$pdf->Ln(8);
}
$pdf->Ln(10);
if(isset($data)){
	$pdf->Cell(0, 15, 'TOTAL DE COMISIONES BANCARIAS', 0, false, 'L', 0, '', 0, false, 'M', 'M');
	$pdf->Ln(8);
	$pdf->Cell(65, 7, $data4['simbolo'].''.number_format($data4['monto_comision'],2,',','.').' ('.$data4['iso'].')', 1, false, 'L', 0, '', 0, false, 'M', 'M');
}
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
