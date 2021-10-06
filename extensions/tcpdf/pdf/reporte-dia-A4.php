<?php
require_once "../../../models/reporte-dia.api.php";

class imprimirFacturaA4{


public function traerImpresionFactura(){
    $respuesta = new ReporteDia();
    $data1 = $respuesta->apiReporte();
    $data2 =$respuesta->apiReportemontoTotales();
    $data3 =$respuesta->apiReporteremesaTotales();
    $comision =$respuesta->apiReporteremesaComision();

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();
$pdf->Image('images/logo2.png', 30, 120, 150, '', '', '', '', false, 300);

// ---------------------------------------------------------
$fecha=date("Y-m-d H:i:s"); 
$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo.png"></td>



			<td style="width:350px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
                <br>
                Fecha: $fecha
					<br>
					<strong style="font-size: 12px;">CORPORATIVO FIVIP</strong>

					<br>
					RUC: 20607982873

				</div>
				
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque3 = <<<EOF

	<table>
		
		<tr>
			

			<td style="width:330px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
             
					<strong style="font-size: 12px;">REPORTE DEL DIA</strong>


				</div>
				
			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
$pdf->Ln(2);
// ---------------------------------------------------------
foreach ($data1 as $key => $value) {
    $serie=$value['correlativo'];
    $cliente=$value['nombres'].' '.$value['apellidos'];
	$pais=$value['pais'];
	$monto=number_format($value['total_envio'],2,',','.');
	$simbolo=$value['simbolo_moneda'];
	$iso=$value['iso_moneda'];
	$tasa=number_format($value['tasa'],2,',','.');
	$iso_tasa=$value['iso_tasa'];
	$simbolo_tasa=$value['simbolo_tasa'];
	$total_remesa=number_format($value['total_remesa'],2,',','.');
$bloque2 = <<<EOF



	<table style="font-size:9px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Correlativo: $serie Cliente: $cliente

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Pais: $pais

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:180px">Monto: $simbolo$monto ($iso)</td>
			<td style="border: 1px solid #666; background-color:white; width:180px">Tasa: $simbolo_tasa$tasa ($iso_tasa)</td>
			<td style="border: 1px solid #666; background-color:white; width:180px">Total: $simbolo_tasa$total_remesa ($iso_tasa)</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
$pdf->Ln(3);
}

// ---------------------------------------------------------

$bloque6 = <<<EOF


	<table style="font-size:9px; padding:5px 10px;">
	


		<tr>
		
			<td style=" width:180px">Total de remesas recibidas</td>
			

		</tr>


	</table>


EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');
foreach ($data2 as $key => $value) {
	$monto_total = number_format($value['total'],2,',','.');
	$iso_total=$value['iso_moneda'];
	$simbolo_total=$value['simbolo_moneda'];
$bloque4 = <<<EOF

	<table style="font-size:9px; padding:5px 10px;">
	


		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:200px">Monto: $simbolo_total $monto_total ($iso_total)</td>
			

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
$pdf->Ln(3);
}

// ---------------------------------------------------------


$bloque7 = <<<EOF


	<table style="font-size:9px; padding:5px 10px;">
	


		<tr>
		
			<td style=" width:180px">Total de remesas enviadas</td>
			

		</tr>


	</table>


EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');
foreach ($data3 as $key => $value) {
	$monto_total=number_format($value['total'],2,',','.');
	$iso_total=$value['iso_tasa'];
	$simbolo_total=$value['simbolo_tasa'];
$bloque5 = <<<EOF


	<table style="font-size:9px; padding:5px 10px;">
	


		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:200px">Monto: $simbolo_total $monto_total ($iso_total)</td>
			

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
$pdf->Ln(2);
}
// ---------------------------------------------------------


$bloque8 = <<<EOF


	<table style="font-size:9px; padding:5px 10px;">
	


		<tr>
		
			<td style=" width:180px">Total de comisiones bancarias por transferencias o pago movil</td>
			

		</tr>


	</table>


EOF;

$pdf->writeHTML($bloque8, false, false, false, false, '');
foreach ($comision as $key => $value) {
	$monto_total=number_format($value['monto_comision'],2,',','.');
	$iso_total=$value['iso'];
	$simbolo_total=$value['simbolo'];
$bloque9 = <<<EOF


	<table style="font-size:9px; padding:5px 10px;">
	


		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:200px">Monto: $simbolo_total $monto_total ($iso_total)</td>
			

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque9, false, false, false, false, '');
$pdf->Ln(2);
}


// ---------------------------------------------------------


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte-diario.pdf');

}

}

$factura = new imprimirFacturaA4();
$factura -> traerImpresionFactura();

?>