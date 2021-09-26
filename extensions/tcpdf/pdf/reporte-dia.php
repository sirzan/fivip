<?php

require_once "../../../models/reporte-dia.api.php";

class imprimirFactura{


public function traerImpresionFactura(){

$respuesta = new ReporteDia();
$data1 = $respuesta->apiReporte();
$data2 =$respuesta->apiReportemontoTotales();
$data3 =$respuesta->apiReporteremesaTotales();

// var_dump($respuesta);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
$medidas = array(80, 1000);
// $pdf = new TCPDF('P', 'mm', $medidas, true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$fecha=date("Y-m-d H:i:s");  
$pdf->AddPage('P', $medidas );

//---------------------------------------------------------
$pdf->Image('../../../views/img/logo-ticket.png', 12, 3,0, 25, 'PNG');
// create some HTML content



$bloque1 = <<<EOF

<table style="font-size:8px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
			<br><br><br><br><br>
				Corporativo FIVIP SAC
				<br>
				RUC: 20607982873

				<br>
				Fecha: $fecha
				<br>
			REPORTE DIARIO


			</div>

		</td>

	</tr>


</table>

EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
$pdf->Ln(2);
foreach ($data1 as $key => $value) {

	$serie=$value['correlativo'];
	$pais=$value['pais'];
	$monto=number_format($value['total_envio'],2,',','.');
	$simbolo=$value['simbolo_moneda'];
	$iso=$value['iso_moneda'];
	$tasa=number_format($value['tasa'],2,',','.');
	$iso_tasa=$value['iso_tasa'];
	$simbolo_tasa=$value['simbolo_tasa'];
	$total_remesa=number_format($value['total_remesa'],2,',','.');
	$bloque2 = <<<EOF

<table style="font-size:7px;">
<tr>
	
<td style="width:100px; text-align:left">
	Correlativo: $serie
</td>

<td style="width:100px;">
Pais: $pais 
</td>
</tr>


	<tr>
	
		<td style="width:90px;">
	Monto:  $simbolo$monto ($iso)
		</td>

		<td style="width:100px;">
		Tasa: $simbolo_tasa$tasa ($iso_tasa)
		</td>
	</tr>


	
	<tr>
	
		<td style="width:160px; text-align:left">
		Total:  $simbolo_tasa$total_remesa ($iso_tasa)
		</td>

	</tr>


</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');
$pdf->Ln(2);
}

$bloque3 = <<<EOF

<table style="font-size:8px;">

	<tr>
		<td style="width:160px; text-align:left">
		---------------------------------------
		</td>
	</tr>



</table>

EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

foreach ($data2 as $key => $value) {
	$monto_total=number_format($value['total'],2,',','.');
	$iso_total=$value['iso_moneda'];
	$simbolo_total=$value['simbolo_moneda'];
	$bloque2 = <<<EOF

<table style="font-size:8px;">

	
	<tr>
		<td style="width:160px; text-align:left">
			Total Monto: $simbolo_total$monto_total ($iso_total)
		</td>
	</tr>


</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');
}



$bloque5 = <<<EOF

<table style="font-size:8px;">

	<tr>
		<td style="width:160px; text-align:left">
		---------------------------------------
		</td>
	</tr>



</table>

EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');

foreach ($data3 as $key => $value) {
	$monto_total=number_format($value['total'],2,',','.');
	$iso_total=$value['iso_tasa'];
	$simbolo_total=$value['simbolo_tasa'];
	$bloque4 = <<<EOF

<table style="font-size:8px;">

	
	<tr>
		<td style="width:160px; text-align:left">
			Total Monto: $simbolo_total$monto_total ($iso_total)
		</td>
	</tr>


</table>

EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
}



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

// $pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();

$factura -> traerImpresionFactura();

?>